<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
class PolicyController extends Controller
{
	public function ssvSchemePlan(Request $request)
	{
        $validation = Validator::make($request->all(),[
          'schemeId' => 'required',
        ],[
            'schemeId' => 'Policy Id is required',
        ]);
        if($validation->fails())
            return sendErrorResponse(__('message.missing_data'),$validation->errors());
        $response = callAPI('post','ssvSchemePlan',null,['id'=>$request->schemeId]);
        if($response['status']===true){
            return sendResponse($response['message'],$response['data']['schemePlan']);
        }
        return sendErrorResponse($response['message']);
		
	}
    public function ssvCalculator(Request $request)
    {
        $response = callAPI('get','ssvAllList');
        if($response['status']===true){
        	$schemes = $response['data']['schemes'];
	    	return view('user.calculator',compact('schemes'));
        }
        return back()->with(['status'=>false,'message'=>__('message.general_error')]);
    }
    public function calculateMaturity(Request $request)
    {
        $validation = Validator::make($request->all(),[
          'planid' => 'required',
          'amount' => 'required',
        ],[
            'planid' => 'Policy Plan is required',
            'amount' => 'Amount is required',
        ]);
        if($validation->fails())
            return sendErrorResponse(__('message.missing_data'),$validation->errors());
        $response = callAPI('post','ssvCalculate',null,$request->all());
        if($response['status']===true){
            return sendResponse($response['message'],$response['data']);
        }
        return sendErrorResponse($response['message']);
    }
    public function ssvOwnPolicy(Request $request)
    {
        $response = callAPI('get','ownSSVPolicy');
        if($response['status']===true){
            $policyList = $response['data']['policyList'];
            return view('user.ssvOwnPolicy',compact('policyList'));
        }
        return back()->with(['status'=>false,'message'=>__('message.general_error')]);
    }
    public function ssviewPolicy(Request $request)
    {
        $response = callAPI('get','ssvPolicySearchList');
        if($response['status']===true){
            $policySearch = $response['data']['policySearch'];
            return view('user.ssviewPolicy',compact('policySearch'));
        }
        return back()->with(['status'=>false,'message'=>__('message.general_error')]);
    }
    public function searchSSVPolicy(Request $request)
    {
        $validation = Validator::make($request->all(),[
          'numberType' => 'required',
          'number' => 'required',
        ],[
            'numberType' => 'Search type is required',
            'number' => 'Search text is required',
        ]);
        if($validation->fails())
            return sendErrorResponse(__('message.missing_data'),$validation->errors());
        $response = callAPI('post','searchSSVPolicy',null,$request->all());
        if($response['status']===true){
            $finalList = [];
            foreach ($response['data']['policyList'] as $key => $value) {
                $finalList[] = [
                                    'policyno' => $value['safepetransactionId'], 
                                    'memberId' => $value['ssv_user']['memberId'],
                                    'mobile' => $value['ssv_user']['user']['mobile'],
                                    'memberName' => ucfirst($value['ssv_user']['user']['first_name']) . ' ' . ucfirst($value['ssv_user']['user']['last_name']),
                                    'pdf' => imageList($value['pdfFile']),
                                ];
            }
            return sendResponse($response['message'],$finalList);
        }
        return sendErrorResponse($response['message']);
    }
    public function ssvCollectPremium(Request $request)
    {
        
    }
}
