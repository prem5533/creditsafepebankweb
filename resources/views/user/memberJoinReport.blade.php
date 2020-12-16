@extends('layout.template')
@section('pagestyle')
<style>
    #memberreport {
        width: 100%!important;
    }
    #memberreport thead tr th {
        border: 1px solid #000;
        text-align: center;
    }
    #memberreport tbody tr td {
        border: 1px solid #000;
        text-align: left;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">{{ __('Member Join Report') }}</h2>
                </div>
                <br>
                <div class="card-body">
                    <form class="form form-horizontal" id="joinMemberReport" method="POST" action="{{ route('joinMemberReport') }}" onsubmit="return false;">
                        @csrf
                        <div class="form-group row">
                            <label for="start_date" class="col-md-6 col-form-label text-md-left">{{ __('Start Date') }}</label>
                            <div class="col-sm-6">
                                <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date') }}" placeholder="Partner Id" autofocus required>
                                @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="end_date" class="col-md-6 col-form-label text-md-left">{{ __('End Date') }}</label>
                            <div class="col-sm-6">
                                <input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date') }}" placeholder="Partner Id" autofocus required>
                                @error('end_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="branch" class="col-md-6 col-form-label text-md-left">{{ __('Policy Scheme') }}</label>
                            <div class="col-sm-6">
                                <select id="branch" name="branch" class="form-control @error('branch') is-invalid @enderror select2" required>
                                    @if(count($branch))
                                        @foreach($branch as $value)
                                            <option value="{{$value['name']}}" selected>{{$value['name']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('branch')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="memberType" class="col-md-6 col-form-label text-md-left">{{ __('Policy Scheme') }}</label>
                            <div class="col-sm-6">
                                <select id="memberType" name="memberType" class="form-control @error('memberType') is-invalid @enderror select2" required>
                                    @if(count($memberType))
                                        @foreach($memberType as $value)
                                            <option value="{{$value['id']}}" selected>{{$value['name']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('memberType')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cpid" class="col-md-6 col-form-label text-md-left">{{ __('Partner Id in Team') }}</label>
                            <div class="col-sm-6">
                                <input id="cpid" type="text" class="form-control @error('cpid') is-invalid @enderror" name="cpid" value="{{ old('cpid') }}" placeholder="Partner Id in Team" autofocus>
                                @error('cpid')
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
                    <div class="mt-3">
                        <table id="memberreport">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Member Id</th>
                                    <th>Partner Id</th>
                                    <th>Rank</th>
                                    <th>Date of Joining</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pagescript')
<script>
    $(function(){
        $(document).on('submit','#joinMemberReport',function(e){
            e.preventDefault();
            $.post($(this).attr('action'),$(this).serialize(),function(res){
                console.log(res);
                if(res.status){
                    var html = '';
                    if(res.data){
                        $.each(res.data,function(index,value){
                            html += '<tr><td>'+  value.name  + '</td><td>'+  value.memberId  + '</td><td>'+  value.cpId  + '</td><td>'+  value.rank  + '</td><td>'+  value.doj  + '</td></tr>';
                        });
                    } else {
                        html = '<tr><td class="text-center" colspan="5">No data found</td></tr>';
                    }
                    $('#memberreport tbody').html(html);
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