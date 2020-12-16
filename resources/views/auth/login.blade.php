@php
    $pagetitle = 'Login';
    $version = getVersion();
@endphp
@extends('layout.template')
@section('pagestyle')
<style>
    #optionCheckedSpan {
        color: green;
        margin-top: 10px;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">{{ __('Register') }}</h2>
                </div>
                <br>
                <div class="card-body">
                    <form class="form form-horizontal" id="loginForm" method="POST" action="{{ route('login') }}" onsubmit="return false;">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <select name="optionChecked" id="optionChecked" class="form-control @error('optionChecked') is-invalid @enderror" required>
                                    <option value="1" data-title="{{$version['member']}}">Member</option>
                                    <option value="2" data-title="{{$version['partner']}}" selected>Partner</option>
                                </select>
                                <span id="optionCheckedSpan">{{$version['partner']}}</span>
                               @error('optionChecked')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" placeholder="Member/Partner Id" required autofocus>
                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" placeholder="Password" required autofocus>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-1 offset-sm-10 text-right">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-sign-in-alt"></i></button>
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
        $(document).on('change','#optionChecked',function(e){
            var val = $('#optionChecked option:selected').data('title');
            $('#optionCheckedSpan').text(val);
        });
        $(document).on('submit','#loginForm',function(e){
            e.preventDefault();
            $.post($(this).attr('action'),$(this).serialize(),function(res){
                if(res.status){
                    sweetAlert("<h1>Login</h1>", "<p>"+ res.message + "</p>", "success");
                    location.href="/dashboard";
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
        });
    });
</script>
@endsection