@extends('layout.template')
@section('pagestyle')
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">{{ __('KYC') }}</h2>
                </div>
                <br>
                <div class="card-body">
                    <form class="form form-horizontal" id="registerSSVKycForm" method="POST" action="{{ route('registerSSVKyc') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-5">
                                <input id="memberid" type="text" class="form-control @error('memberid') is-invalid @enderror" name="memberid" value="{{ old('memberid') }}" placeholder="Member Id" autofocus>
                                @error('memberid')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-2"><span><strong><em><u>Or</u></em></strong></span></div>
                            <div class="col-sm-5">
                                <input id="cpId" type="text" class="form-control @error('cpId') is-invalid @enderror" name="cpId" value="{{ old('cpId') }}" placeholder="Partner Id" autofocus>
                                @error('cpId')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <p>{{__('Upload documents')}}</p>
                        <div class="form-group row">
                            <label for="isCP" class="col-md-6 col-form-label text-md-left">{{ __('Pancard') }}</label>
                            <div class="col-sm-6">
                                <input id="panCard_img" type="file" class="form-control @error('panCard_img') is-invalid @enderror" name="panCard_img" value="{{ old('panCard_img') }}" required autofocus>
                                @error('panCard_img')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="isCP" class="col-md-6 col-form-label text-md-left">{{ __('Aadhar card front cover') }}</label>
                            <div class="col-sm-6">
                                <input id="adharCard_img" type="file" class="form-control @error('adharCard_img') is-invalid @enderror" name="adharCard_img" value="{{ old('adharCard_img') }}" required autofocus>
                                @error('adharCard_img')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="isCP" class="col-md-6 col-form-label text-md-left">{{ __('Aadhar card back cover') }}</label>
                            <div class="col-sm-6">
                                <input id="adharCardBack_img" type="file" class="form-control @error('adharCardBack_img') is-invalid @enderror" name="adharCardBack_img" value="{{ old('adharCardBack_img') }}"  required autofocus>
                                @error('adharCardBack_img')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="isCP" class="col-md-6 col-form-label text-md-left">{{ __('Upload Your Image') }}</label>
                            <div class="col-sm-6">
                                <input id="User_img" type="file" class="form-control @error('User_img') is-invalid @enderror" name="User_img" value="{{ old('User_img') }}" required autofocus>
                                @error('User_img')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-1 offset-sm-10 text-right">
                                <button id="submitRegisterSSVKycForm" type="button" class="btn btn-sm btn-primary"><i class="fas fa-sign-in-alt"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pagescript')
<script>
    $(function(){
        $(document).on('click','#submitRegisterSSVKycForm',function(e){
            e.preventDefault();
            var memberid = $('#registerSSVKycForm').find('input[name="memberid"]').val();
            var cpId = $('#registerSSVKycForm').find('input[name="cpId"]').val();
            if(memberid=='' && cpId==''){
                sweetAlert("<h1>Errors</h1>", "<p>Please provide atlest of Member Id or Partner Id.</p>", "error");
                return false;
            }
            $('#registerSSVKycForm').submit();
        });
    });
</script>
@endsection