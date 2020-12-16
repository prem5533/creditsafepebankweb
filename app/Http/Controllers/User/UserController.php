<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Auth, Session;

class UserController extends Controller
{
    public function showLoginForm(Request $request)
    {
        if(!(Session::has('access_token')))
            return view('auth.login');
       return redirect(route('dashboard'));
    }
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'optionChecked' => 'required',
            'mobile' 		=> 'required',
            'password'		=> 'required|min:6',
        ],[
            'optionChecked' => 'Partner/Member must be selected',
        	'mobile' => 'Partner/Member Id is missing',
        	'password' => 'Password is missing',
        ]);
        if($validation->fails())
            return sendErrorResponse(__('message.missing_data'),$validation->errors());
    	$response = callAPI('post','loginSSVUser',[],['mobile'=>$request->mobile,'password'=>$request->password,'optionChecked'=>$request->optionChecked]);
    	if($response['status']===true){
            $status_code = $response['status_code'];
    		Session::put('access_token',$response['access_token']);
            $response = callAPI('get','getSSVUser');
            if($response['status']===true){
                Session::put('user',$response['user']);
            }
	    	return sendResponse('Login successfull',['status_code'=>$status_code]);
    	}
    	return sendErrorResponse($response['message']);
    }
    public function logout(Request $request)
    {
        $response = callAPI('post','logout');
        if($response['status']===true){
            Session::flush();
            Session::regenerate();
            return redirect(route('login'))->with(['status'=>true, 'message'=>$response['message']]);
        }
        return back()->with(['status'=>false, 'message'=>$response['message']]);
    }
    public function logoutAlldevices(Request $request)
    {
        $response = callAPI('post','logoutAlldevices');
        if($response['status']===true){
            Session::flush();
            Session::regenerate();
            return redirect(route('login'))->with(['status'=>true, 'message'=>$response['message']]);
        }
        return back()->with(['status'=>false, 'message'=>$response['message']]);
    }

    public function saveSSVPasscode(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'passcode'		=> 'required',
        ],[
        	'passcode' => 'Passcode is missing',
        ]);
        if($validation->fails())
            return sendErrorResponse(__('message.missing_data'),$validation->errors());

    	$response = callAPI('post','saveSSVPasscode',null,$request->all());
    	if($response['status']===true){
	    	return sendResponse($response['message']);
    	}
    	return sendErrorResponse($response['message']);
    }
    public function verifySSVPasscode(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'passcode'		=> 'required',
        ],[
        	'passcode' => 'Passcode is missing',
        ]);
        if($validation->fails())
            return sendErrorResponse(__('message.missing_data'),$validation->errors());

    	$response = callAPI('post','verifySSVPasscode',null,$request->all());
    	if($response['status']===true){
	    	return sendResponse($response['message']);
    	}
    	return sendErrorResponse($response['message']);
    }
    public function ssvUpdatePassword(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'current'                => ['required', 'string'],
            'password'              => ['required','min:4'],
            'password_confirmation' => 'required_with:password|same:password|min:4'
        ]);
        if($validation->fails())
            return sendErrorResponse(__('message.missing_data'),$validation->errors());

    	$response = callAPI('post','ssvUpdatePassword',null,$request->all());
    	if($response['status']===true){
	    	return sendResponse($response['message']);
    	}
    	return sendErrorResponse($response['message']);
    }
    public function checkSSVReferralCode(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'referral_code'  => ['required', 'string'],
        ]);
        if($validation->fails())
            return sendErrorResponse(__('message.missing_data'),$validation->errors());

        $response = callAPI('post','checkSSVReferralCode',null,$request->all());
        if($response['status']===true){
            return sendResponse($response['message']);
        }
        return sendErrorResponse($response['message']);
    }
    public function ssvNewMember(Request $request)
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(),[
            // 'referral_code'     => 'required_without:mobile',
            'first_name'        => 'required|string',
            'last_name'         => 'required|string',
            'dob'               => 'required',
            'fatherName'        => 'required|string',
            'mobile'            => 'required|string|min:10',
            'email'             => 'required_if:isCP,2|email',
            'branchName'        => 'required',
            'occupationId'      => 'required',
            'nomineeName'       => 'required',
            'nomineeRelationId' => 'required',
            'nomineeAge'        => 'required',
            'payment_mode'      => 'required',
            'isCP'              => 'required',
        ]);
        if($validation->fails())
            return sendErrorResponse(__('message.missing_data'),$validation->errors());
        $response = callAPI('post','createSSVNewMember',null,$request->all());
        if($response['status']===true){
            return sendResponse($response['message'],["password"=>$response["password"]]);
        }
        return sendErrorResponse($response['message']);
    }
    public function sendSSVOTP(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'mobile'        => 'required|string',
            'isCP'      => 'required|string',
        ],[
            'mobile' => 'Mobile/Email is required',
            'isCP' => 'Membership type is required',
        ]);
        if($validation->fails())
            return sendErrorResponse(__('message.missing_data'),$validation->errors());
        
        $response = callAPI('post','sendSSVOTP',null,['mobile'=>$request->mobile,'userType'=>$request->isCP]);
        if($response['status']===true){
            return sendResponse($response['message']);
        }
        return sendErrorResponse($response['message']);
    }
    public function verifySSVOTP(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'mobile'        => 'required|string',
            'otp'      => 'required|string',
        ],[
            'mobile' => 'Mobile/Email is required',
            'otp' => 'OTP is required',
        ]);
        if($validation->fails())
            return sendErrorResponse(__('message.missing_data'),$validation->errors());
        
        $response = callAPI('post','verifySSVOTP',null,$request->all());
        if($response['status']===true){
            return sendResponse($response['message']);
        }
        return sendErrorResponse($response['message']);
    }
    public function cashfreeOrderToken(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'amount'        => 'required',
        ],[
            'mobile' => 'Amount is required',
        ]);
        if($validation->fails())
            return sendErrorResponse(__('message.missing_data'),$validation->errors());
        
        $response = callAPI('post','cashfreeOrderToken',null,$request->all());
        if($response['status']===true){
            return sendResponse($response['message'],$response['data']['orderrequest']);
        }
        return sendErrorResponse($response['message']);
    }
    public function dashboard(Request $request)
    {
        return view('user.dashboard');
    }
    public function ssvProfile(Request $request)
    {
        $response = callAPI('get','ssvProfile');
        if($response['status']===true){
            $data = $response['data'];
            return view('user.profile',compact('data'));
        }
        return back()->with(['status'=>false,'message'=>$response['message']]);
    }
    public function ssvMemberJoinReport(Request $request)
    {
        $response = callAPI('get','ssvAllList');
        if($response['status']===true){
            $branch = $response['data']['branch'];
            $memberType = $response['data']['memberType'];
            return view('user.memberJoinReport',compact('branch','memberType'));
        }
        return back()->with(['status'=>false,'message'=>$response['message']]);
    }
    public function joinMemberReport(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'start_date' => 'required',
            'end_date' => 'required',
            'branch' => 'required',
            'memberType' => 'required',
        ],[
            'start_date' => 'Start Date is required',
            'end_date' => 'End Date is required',
            'branch' => 'Branch is required',
            'memberType' => 'Membership is required',
        ]);
        if($validation->fails())
            return sendErrorResponse(__('message.missing_data'),$validation->errors());
        
        $response = callAPI('post','joinMemberReport',null,$request->all());
        if($response['status']===true){
            $finalList = [];
            foreach ($response['data']['userlist'] as $key => $value) {
                $finalList[] = [
                                    'name' => ucfirst($value['user']['first_name']) . ' ' . ucfirst($value['user']['last_name']),
                                    'memberId' => $value['memberId'], 
                                    'cpId' => $value['cpId'], 
                                    'rank' => $value['rank'], 
                                    'doj' => date('dS M, Y',strtotime($value['joiningDate'])), 
                                ];
            }
            return sendResponse($response['message'],$finalList);
        }
        return sendErrorResponse($response['message']);
    }
    public function ssvSelfCollection(Request $request)
    {
        return view('user.ssvSelfCollection');   
    }
    public function ssvSelfCollectionReport(Request $request)
    {
        $response = callAPI('get','ssvAllList');
        if($response['status']===true){
            $branch = $response['data']['branch'];
            $planid = $response['data']['schemes'];
            return view('user.ssvSelfCollectionReport',compact('branch','planid'));
        }
        return back()->with(['status'=>false,'message'=>$response['message']]);
    }

    public function selfCollectionReport(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'start_date' => 'required',
            'end_date'   => 'required',
            'branch'     => 'required',
            'collectionType' => 'required',
            'searchText' => 'required_unless:seacrhBy,1',
        ],[
            'start_date' => 'Start Date is required',
            'end_date' => 'End Date is required',
            'searchText'  => 'Search text is required for Search By is selected',
        ]);
        if($validation->fails())
            return sendErrorResponse(__('message.missing_data'),$validation->errors());
        if(strtotime($request->start_date) > strtotime($request->end_date))
            return sendErrorResponse(__('Start date should be after end date'));
        $response = callAPI('post','selfCollectionReport',null,$request->all());
        if($response['status']===true){
            $finalList = [];
            foreach ($response['data']['policyList'] as $key => $value) {
                $finalList[] = [
                                    'policyno' => $value['safepetransactionId'], 
                                    'plan' => $value['policy_plan']['name'],
                                    'memberId' => $value['ssv_user']['memberId'],
                                    'memberName' => ucfirst($value['ssv_user']['user']['first_name']) . ' ' . ucfirst($value['ssv_user']['user']['last_name']),
                                    'dob' => date('dS M, Y',strtotime($value['ssv_user']['user']['dob'])), 
                                    'amount' => '<i class="fas fa-rupee-sign"></i> ' . $value['package_amount'],
                                ];
            }
            return sendResponse($response['message'],$finalList);
        }
        return sendErrorResponse($response['message']);
    }
    public function selfCollectionDetails(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'start_date' => 'required',
            'end_date' => 'required',
        ],[
            'start_date' => 'Start Date is required',
            'end_date' => 'End Date is required',
        ]);
        if($validation->fails())
            return sendErrorResponse(__('message.missing_data'),$validation->errors());
        if(strtotime($request->start_date) > strtotime($request->end_date))
            return sendErrorResponse(__('Start date should be after end date'));
        $response = callAPI('post','selfCollectionReport',null,$request->all());
        if($response['status']===true){
            $finalList = [];
            foreach ($response['data']['policyList'] as $key => $value) {
                $list = [
                            'applicantname' => ucfirst($value['ssv_user']['user']['first_name']) . ' ' . ucfirst($value['ssv_user']['user']['last_name']),
                            'plan' => $value['policy_plan']['name'],
                            'branch' => $value['branchName'],
                            'policyno' => $value['safepetransactionId'], 
                            'maturityDate' => date('dS M, Y',strtotime($value['maturityDate'])),
                            'maturityAmount' => '<i class="fas fa-rupee-sign"></i> ' . $value['total'],
                            'memberId' => $value['ssv_user']['memberId'],
                            'membername' => ucfirst($value['ssv_user']['user']['first_name']) . ' ' . ucfirst($value['ssv_user']['user']['last_name']),
                            'nextPremiumDate' => $value['nextPremimumDate'],
                            'totalTerm' => $value['termPeriod'] .' Months',
                            'totalPaidTerm' => $value['totalPaidTerm'] .' Months',
                            'paymentOption' => '',
                            'premiumAmount' => '<i class="fas fa-rupee-sign"></i> ' . $value['package_amount'],
                            'totalPremiumAmount'=> '<i class="fas fa-rupee-sign"></i> ' .$value['totalPremiumAmount'],
                            'fine'          =>   '<i class="fas fa-rupee-sign"></i> ' . $value['fine'],
                            'discount'      =>   '<i class="fas fa-rupee-sign"></i> ' . $value['discount'],
                            'totalAmount'   =>   '<i class="fas fa-rupee-sign"></i> ' . $value['total_amount'],
                            'purchasedBy'   => ucfirst($value['paid_by']['user']['first_name'].' '. $value['paid_by']['user']['last_name']) . ' (' . $value['paid_by']['cpId'].')',
                        ];
                $finalList[] = [
                                    'policyno' => $value['safepetransactionId'], 
                                    'mobile' => $value['ssv_user']['user']['mobile'], 
                                    'dob' => date('dS M, Y',strtotime($value['ssv_user']['user']['dob'])), 
                                    'amount' => '<i class="fas fa-rupee-sign"></i> ' . $value['package_amount'],
                                    'details' => $list,
                                ];
            }
            return sendResponse($response['message'],$finalList);
        }
        return sendErrorResponse($response['message']);
    }

    public function ssvTeamCollection(Request $request)
    {
        $response = callAPI('get','ssvAllList');
        if($response['status']===true){
            $branch = $response['data']['branch'];
            $planid = $response['data']['schemes'];
            return view('user.ssvTeamCollection',compact('branch','planid'));
        }
        return back()->with(['status'=>false,'message'=>$response['message']]);
    }
    public function teamCollectionReport(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'start_date' => 'required',
            'end_date'   => 'required',
            'branch'     => 'required',
            'collectionType' => 'required',
            'searchText' => 'required_unless:seacrhBy,1',
        ],[
            'start_date' => 'Start Date is required',
            'end_date' => 'End Date is required',
            'searchText'  => 'Search text is required for Search By is selected',
        ]);
        if($validation->fails())
            return sendErrorResponse(__('message.missing_data'),$validation->errors());
        if(strtotime($request->start_date) > strtotime($request->end_date))
            return sendErrorResponse(__('Start date should be after end date'));
        $response = callAPI('post','teamCollectionReport',null,$request->all());
        if($response['status']===true){
            $finalList = [];
            foreach ($response['data']['policyList'] as $key => $value) {
                $finalList[] = [
                                    'policyno' => $value['safepetransactionId'], 
                                    'plan' => $value['policy_plan']['name'],
                                    'memberId' => $value['ssv_user']['memberId'],
                                    'memberName' => ucfirst($value['ssv_user']['user']['first_name']) . ' ' . ucfirst($value['ssv_user']['user']['last_name']),
                                    'dob' => date('dS M, Y',strtotime($value['ssv_user']['user']['dob'])), 
                                    'amount' => '<i class="fas fa-rupee-sign"></i> ' . $value['package_amount'],
                                ];
            }
            return sendResponse($response['message'],$finalList);
        }
        return sendErrorResponse($response['message']);
    }

    public function ssvKyc(Request $request)
    {
        $response = callAPI('get','statusSSVKyc');
        if($response['status']===true){
            return view('user.kyc');
        }
        return redirect(route('dashboard'))->with(['status'=>true,'message'=>$response['message']]);
    }
    public function registerSSVKyc(Request $request)
    {
        $validation = Validator::make($request->all(),[
          'memberid' => 'required_without:cpId',
          'cpId' => 'required_without:memberid',
        ],[
            'memberId' => 'Member Id is required',
            'cpId' => 'Partner Id is required',
        ]);
        if($validation->fails())
            return back()->with(['status'=>false,'message'=>$validation->errors()]);
        $images = ['panCard_img'=>$_FILES['panCard_img'],'adharCard_img'=>$_FILES['adharCard_img'],'adharCardBack_img'=>$_FILES['adharCardBack_img'],'User_img'=>$_FILES['User_img']];
        $data = ['cpId'=>$request->cpId,'memberId'=>$request->memberId];
        $response = callAPIImageUpload('post','registerSSVKyc',[],$images,$data);
        if($response['status']===true){
            return redirect(route('ssvKyc'))->with(['status'=>true,'message'=>$response['message']]);
        }
        return back()->with(['status'=>false,'message'=>$response['message']]);
    }
}
