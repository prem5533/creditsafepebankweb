@extends('layout.template')
@section('pagestyle')
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">{{ __('Profile') }}</h2>
                </div>
                <br>
                <div class="card-body">
                	<fieldset>
                		<legend>{{__('Personal Details')}}</legend>
	                	<div class="row">
	                		<label class="col-md-6">Name</label>
	                		<label class="col-md-6">{{ucfirst($data['user']['first_name']) . ' ' . ucfirst($data['user']['last_name'])}}</label>
	                	</div>
	                	<div class="row">
	                		<label class="col-md-6">Father/Husband Name</label>
	                		<label class="col-md-6">{{ucfirst($data['fatherName'])}}</label>
	                	</div>
	                	<div class="row">
	                		<label class="col-md-6">Email</label>
	                		<label class="col-md-6">{{$data['user']['email']}}</label>
	                	</div>
	                	<div class="row">
	                		<label class="col-md-6">Mobile</label>
	                		<label class="col-md-6">{{$data['user']['mobile']}}</label>
	                	</div>
	                	<div class="row">
	                		<label class="col-md-6">Date Of Birth</label>
	                		<label class="col-md-6">{{$data['user']['dob'] ? date('dS F, Y',strtotime($data['user']['dob'])) : 'NA'}}</label>
	                	</div>
	                	<div class="row">
	                		<label class="col-md-6">Address</label>
	                		<label class="col-md-6">{{ucfirst($data['user']['user_address']['location']) . ' ' .  ucfirst($data['user']['user_address']['city']) . ' ' . ucfirst($data['user']['user_address']['state']) . ' ' . ucfirst($data['user']['user_address']['country']) .' ' . $data['user']['user_address']['pin']}}</label>
	                	</div>
	                	<div class="row">
	                		<label class="col-md-6">Joining Date</label>
	                		<label class="col-md-6">{{date('dS F,Y',strtotime($data['created_at']))}}</label>
	                	</div>
	                </fieldset>
                	<fieldset>
                		<legend>{{__('Business Details')}}</legend>
	                	<div class="row">
	                		<label class="col-md-6">Member Id</label>
	                		<label class="col-md-6">{{$data['memberId']}}</label>
	                	</div>
	                	<div class="row">
	                		<label class="col-md-6">Partner Id</label>
	                		<label class="col-md-6">{{$data['cpId'] ? $data['cpId']  : 'Not Partner'}}</label>
	                	</div>
	                	<div class="row">
	                		<label class="col-md-6">Rank</label>
	                		<label class="col-md-6">{{$data['rank']}}</label>
	                	</div>
                	</fieldset>
	                <fieldset>
	                	<legend>{{__('Introducer Details')}}</legend>
 		                <div class="row">
	                		<label class="col-md-6">Member Id</label>
	                		<label class="col-md-6">{{$data['sponsor']['memberId']}}</label>
	                	</div>
	                	<div class="row">
	                		<label class="col-md-6">Introducer Name</label>
	                		<label class="col-md-6">{{ucfirst($data['sponsor']['user']['first_name']. ' ' . $data['sponsor']['user']['last_name'])}}</label>
	                	</div>
	                </fieldset>
                	<fieldset>
                		<legend>{{__('Account Details')}}</legend>
	                	<div class="row">
	                		<label class="col-md-6">Branch</label>
	                		<label class="col-md-6">{{ucfirst($data['branchName'])}}</label>
	                	</div>
	                	<div class="row">
	                		<label class="col-md-6">Account Number</label>
	                		<label class="col-md-6">{{$data['safepeAccountNumber']}}</label>
	                	</div>
                	</fieldset>
                	<fieldset>
                		<legend>{{__('Nominee Details')}}</legend>
	                	<div class="row">
	                		<label class="col-md-6">Name</label>
	                		<label class="col-md-6">{{ucfirst($data['nomineeName'])}}</label>
	                	</div>
	                	<div class="row">
	                		<label class="col-md-6">Relationship</label>
	                		<label class="col-md-6">{{ucfirst($data['nominee_relation']['name'])}}</label>
	                	</div>
	                	<div class="row">
	                		<label class="col-md-6">Age</label>
	                		<label class="col-md-6">{{$data['nomineeAge']}}</label>
	                	</div>
                	</fieldset>
                	<fieldset>
                		<legend>{{__('KYC Detail')}}</legend>
	                	<div class="row">
	                		<label class="col-md-6">Pancard No</label>
	                		<label class="col-md-6">{{ucfirst($data['user']['kyc']['pancardNo'])}}</label>
	                	</div>
	                	<div class="row">
	                		<label class="col-md-6">Aadhar No</label>
	                		<label class="col-md-6">{{$data['user']['kyc']['aadharcardNo']}}</label>
	                	</div>
                	</fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pagescript')
@endsection