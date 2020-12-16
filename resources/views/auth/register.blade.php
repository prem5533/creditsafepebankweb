@php
    $pagetitle = 'Create New Member';
    $version = getVersion();
    $ssvAllList = ssvAllList();
@endphp
@extends('layout.template')
@section('pagestyle')
<style>
    #optionCheckedSpan {
        color: green;
        width: 100%;
        margin-top: 20px;
    }
    #walletBalance {
        color: green;
        width: 100%;
        font-size: 18px;
        margin-top: 10px;
    }
    .select2 {
        height: 24px;
    }
    .indent-12 {
        text-indent: 12px;
    }
    .resendMobile, .resendEmail {
        display: none;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                <div class="card-body">
                    <form id="registerForm" method="POST" action="{{ route('register') }}" onsubmit="return false;">
                        @csrf
                        <div class="form-group row">
                            <label for="isCP" class="col-md-4 col-form-label text-md-right">{{ __('Membership') }}</label>
                            <div class="col-md-6">
                                <select id="isCP" name="isCP" class="form-control @error('isCP') is-invalid @enderror select2" required>
                                @php
                                    if(count($ssvAllList['registerMember'])){
                                        foreach($ssvAllList['registerMember'] as $value){
                                            $title = array_key_exists(strtolower($value['name']),$version) ? ucfirst($version[strtolower($value['name'])]) : '';
                                            $title .= '. Membership registration charge is Rs.' . $value['amount'] . '/-';
                                @endphp
                                            <option value="{{$value['id']}}" data-title="{{$title}}" data-amount="{{$value['amount']}}" selected>{{$value['name']}}</option>
                                @php
                                        }
                                    }
                                @endphp
                                </select>
                                <br>
                                <span class="mt-2" id="optionCheckedSpan">{{$title}}</span>
                                @error('isCP')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>
                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>
                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-sm resendEmail" data-title="email">Send OTP</button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('Mobile') }}</label>
                            <div class="col-md-6">
                                <input id="mobile" type="number" class="form-control @error('mobile') is-invalid @enderror" name="mobile" required autocomplete="mobile">
                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-sm resendMobile" data-title="mobile">Send OTP</button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('DOB') }}</label>
                            <div class="col-md-6">
                                <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" required >
                                @error('dob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fatherName" class="col-md-4 col-form-label text-md-right">{{ __('Father Name') }}</label>
                            <div class="col-md-6">
                                <input id="fatherName" type="text" class="form-control @error('fatherName') is-invalid @enderror" name="fatherName" required >
                                @error('fatherName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="occupationId" class="col-md-4 col-form-label text-md-right">{{ __('Occupation') }}</label>
                            <div class="col-md-6">
                                <select id="occupationId" name="occupationId" class="form-control @error('occupationId') is-invalid @enderror select2" required>
                                    @if(count($ssvAllList['occupation']))
                                        @foreach($ssvAllList['occupation'] as $value)
                                            <option value="{{$value['id']}}" selected>{{$value['name']}}</option>
                                        @endforeach
                                    @endif                                    
                                </select>
                                @error('occupationId')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nomineeName" class="col-md-4 col-form-label text-md-right">{{ __('Nominee Name') }}</label>
                            <div class="col-md-6">
                                <input id="nomineeName" type="text" class="form-control @error('nomineeName') is-invalid @enderror" name="nomineeName" required >
                                @error('nomineeName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nomineeAge" class="col-md-4 col-form-label text-md-right">{{ __('Nominee Age') }}</label>
                            <div class="col-md-6">
                                <input id="nomineeAge" type="number" class="form-control @error('nomineeAge') is-invalid @enderror" name="nomineeAge" required >
                                @error('nomineeAge')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nomineeRelationId" class="col-md-4 col-form-label text-md-right">{{ __('Nominee Relation') }}</label>
                            <div class="col-md-6">
                                <select id="nomineeRelationId" name="nomineeRelationId" class="form-control @error('nomineeRelationId') is-invalid @enderror select2" required>
                                    @if(count($ssvAllList['nominee']))
                                        @foreach($ssvAllList['nominee'] as $value)
                                            <option value="{{$value['id']}}" selected>{{$value['name']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('nomineeRelationId')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="branchName" class="col-md-4 col-form-label text-md-right">{{ __('Branch') }}</label>
                            <div class="col-md-6">
                                <select id="branchName" name="branchName" class="form-control @error('branchName') is-invalid @enderror select2" required>
                                    @if(count($ssvAllList['branch']))
                                        @foreach($ssvAllList['branch'] as $value)
                                            <option value="{{$value['name']}}"  selected>{{$value['name']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('branchName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="payment_mode" class="col-md-4 col-form-label text-md-right">{{ __('Payment Method') }}</label>
                            <div class="col-md-6">
                                <select id="payment_mode" name="payment_mode" class="form-control @error('payment_mode') is-invalid @enderror select2" required>
                                    @if(count($ssvAllList['paymentMethod']))
                                        @foreach($ssvAllList['paymentMethod'] as $value)
                                            @if($value['id']=='5')
                                                <option value="{{$value['id']}}" selected>{{$value['name']}}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                                <div id="walletBalance">Wallet Balance - <i class="fas fa-rupee-sign"></i>{{number_format($ssvAllList['ssvwalletamount'],2)}}</div>
                                @error('payment_mode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade modal-quick-view" id="companyBankModal" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog" style="width: 50%;">
        <div class="modal-content">
            <button type="button" class="close modal-close-btn ml-auto" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('Company Banks')}}</h4>
                    </div>
                    <div class="card-body">
                        @if(count($ssvAllList['companyBank']))
                            @foreach($ssvAllList['companyBank'] as $value)
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h3><img src="{{imageList($value['bank_logo'])}}" width="70" class="img img-responsive">{{$value['bank_name']}}</h3>
                                        <p class="indent-12">{{$value['account_holder_name']}}</p>
                                        <p class="indent-12">{{$value['account_number']}}</p>
                                        <p class="indent-12">{{$value['ifsc_code']}}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade modal-quick-view" id="verifyOTPModal" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog" style="width: 50%;">
        <div class="modal-content">
            <button type="button" class="close modal-close-btn ml-auto" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('Verify OTP')}}</h4>
                    </div>
                    <div class="card-body">
                        <form id="verifySSVOTP" class="form form-inline" method="post" action="verifySSVOTP" onsubmit="return false;">
                            @csrf
                            <input type="text" name="otp" value="" required>
                            <input type="hidden" name="mobile" value="" data-title="" required>
                            <button type="submit" class="btn btn-primary btn-sm ml-2">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form id="orderForm" method="post" action="https://test.cashfree.com/billpay/checkout/post/submit">
    @csrf
    <input type="hidden" name="appId" value=""/>
    <input type="hidden" name="orderId" value="order{{mt_rand(100000,999999)}}"/>
    <input type="hidden" name="orderAmount" value=""/>
    <input type="hidden" name="orderCurrency" value="INR"/>
    <input type="hidden" name="orderNote" value=""/>
    <input type="hidden" name="customerName" value=""/>
    <input type="hidden" name="customerEmail" value=""/>
    <input type="hidden" name="customerPhone" value=""/>
    <input type="hidden" name="returnUrl" value=""/>
    <input type="hidden" name="notifyUrl" value=""/>
    <input type="hidden" name="token" value=""/>
    <input type="hidden" name="signature" value=""/>
  </form>
@endsection
@section('pagescript')
<script src="{{asset('js/clipboard.min.js')}}"></script>
<script>
    $(function(){ 
        $('.select2').select2();
        var mobilevalidity = emailvalidity = false;
        $(document).on('change','select[name="isCP"]',function(e){
            var val = $('select[name="isCP"] option:selected').data('title');
            $('#optionCheckedSpan').text(val);
        });
        $(document).on('change','#payment_mode',function(e){
            var val = $('#payment_mode option:selected').val();
            if(val=='2') $('#companyBankModal').modal();
            if(val=='5') $('#walletBalance').show();
            else $('#walletBalance').hide();
        });
        $(document).on('change','#registerForm input[name="mobile"]',function(e){
            if($(this).val()=='')
                $('#registerForm').find('.resendMobile').hide();
            else{
                mobilevalidity = false;
                $('#registerForm').find('.resendMobile').show();
            }
        });
        $(document).on('change','#registerForm input[name="email"]',function(e){
            if($(this).val()=='')
                $('#registerForm').find('.resendEmail').hide();
            else{
                emailvalidity = false;
                $('#registerForm').find('.resendEmail').show();
            }
        });
        $(document).on('click','.resendMobile,.resendEmail',function(e){
            e.preventDefault();
            var title = $(this).data('title');
            var isCP = $('#registerForm').find('select[name="isCP"]').val();
            var mobile = $('#registerForm').find('input[name="'+  title + '"]').val();
            if(!mobile){
                sweetAlert("<h1>Errors</h1>", "<p>"+ title + " is required </p>", "error");
                return false;
            }
            $.post('sendSSVOTP',{mobile:mobile,isCP:isCP},function(res){
                if(res.status){
                    sweetAlert("<h1>OTP</h1>", "<p>"+ res.message + "</p>", "success");
                    $('#verifySSVOTP').find('input[name="mobile"]').data('title',title);
                    $('#verifySSVOTP').find('input[name="mobile"]').val(mobile);
                    $('#verifyOTPModal').modal();
                }
                else {
                    var msg = res.message;
                    if(res.data){
                        msg ='<ul>';
                        $.each(res.data,function(index,val){
                            msg += '<li>' + val[0] + '</li>';
                        });
                        msg += '</ul>';
                    }
                    sweetAlert("<h1>Errors</h1>", "<p>"+ msg + "</p>", "error");
                }
            });
        })
        $(document).on('submit','#verifySSVOTP',function(e){
            e.preventDefault();
            var title = $('#verifySSVOTP').find('input[name="mobile"]').data('title'); 
            $.post('verifySSVOTP',$(this).serialize(),function(res){
                if(res.status){
                    sweetAlert("<h1>OTP Verification</h1>", "<p>"+ res.message + "</p>", "success");
                    $('#verifySSVOTP').trigger("reset");
                    if(title=='email') emailvalidity = true;
                    else if(title=='mobile') mobilevalidity = true;
                    $('#verifyOTPModal').modal('hide');
                }
                else {
                    var msg = res.message;
                    if(res.data){
                        msg ='<ul>';
                        $.each(res.data,function(index,val){
                            msg += '<li>' + val[0] + '</li>';
                        });
                        msg += '</ul>';
                    }
                    sweetAlert("<h1>Errors</h1>", "<p>"+ msg + "</p>", "error");
                    if($(this).data('title')=='email') emailvalidity = false;
                    else if($(this).data('title')=='mobile') mobilevalidity = false;
                }
            });
        });
        $(document).on('submit','#registerForm',function(e){
            e.preventDefault();
            var isCP = $(this).find('select[name="isCP"] option:selected').val();
            if(!emailvalidity) {
                sweetAlert("<h1>Errors</h1>", "<p>Please verify your email</p>", "error");
                return false;
            }
            if(!mobilevalidity) {
                sweetAlert("<h1>Errors</h1>", "<p>Please verify your mobile</p>", "error");
                return false;
            }
            var payment_mode = $(this).find('select[name="payment_mode"] option:selected').val();
            $.post('register',$(this).serialize(),function(res){
                var msg = res.message;
                if(res.status){
                    msg += '<br><input id="password" type="text" value="'+ res.data.password + '" readonly ><button id="passwordCopy" class="btn" data-clipboard-action="copy" data-clipboard-target="#password"><img width="30px" src="images/clippy.svg" alt="Copy to clipboard"></button>';
                    sweetAlert("<h1>Member Registeration</h1>", "<p>"+ msg + "</p>", "success");
                    var clipboard = new ClipboardJS('#passwordCopy');
                    $('#registerForm').trigger("reset");
                    $('#registerForm').find('.resendEmail').hide();
                    $('#registerForm').find('.resendMobile').hide();
                    mobilevalidity = emailvalidity = false;
                }
                else {
                    if(res.data){
                        msg ='<ul>';
                        $.each(res.data,function(index,val){
                            msg += '<li>' + val[0] + '</li>';
                        });
                        msg += '</ul>';
                    }
                    sweetAlert("<h1>Errors</h1>", "<p>"+ msg + "</p>", "error");
                }
            });
 
        });

    });
</script>
@endsection