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
        text-align: center;
        padding: 5px;
    }
    #searchTextDiv {
        display: none;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">{{ __('Team Collection Report') }}</h2>
                </div>
                <br>
                <div class="card-body">
                    <form class="form form-horizontal" id="teamCollectionReport" method="POST" action="{{ route('teamCollectionReport') }}" onsubmit="return false;">
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
                            <label for="branch" class="col-md-6 col-form-label text-md-left">{{ __('Branch') }}</label>
                            <div class="col-sm-6">
                                <select id="branch" name="branch" class="form-control @error('branch') is-invalid @enderror select2">
                                    @if(count($branch))
                                        @foreach($branch as $value)
                                            <option value="{{$value['id']}}" selected>{{$value['name']}}</option>
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
                            <label for="collectionType" class="col-md-6 col-form-label text-md-left">{{ __('Collection Type') }}</label>
                            <div class="col-sm-6">
                                <select id="collectionType" name="collectionType" class="form-control @error('collectionType') is-invalid @enderror select2">
                                    <option value="1" selected>Show All</option>
                                    <option value="2">Fresh</option>
                                    <option value="3">Renewal</option>
                                </select>
                                @error('collectionType')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="seacrhBy" class="col-md-6 col-form-label text-md-left">{{ __('Search By') }}</label>
                            <div class="col-sm-6">
                                <select id="seacrhBy" name="seacrhBy" class="form-control @error('seacrhBy') is-invalid @enderror select2">
                                    <option value="1" selected>Show All</option>
                                    <option value="2">Policy No</option>
                                    <option value="3">Member Id</option>
                                    <option value="4">Member Name</option>
                                </select>
                                @error('seacrhBy')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="searchTextDiv">
                            <label for="searchText" class="col-md-6 col-form-label text-md-left">{{ __('Search') }}</label>
                            <div class="col-md-6">
                                <input id="searchText" type="text" class="form-control @error('searchText') is-invalid @enderror" name="searchText" value="{{ old('searchText') }}" placeholder="Search" autofocus>
                                @error('searchText')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="planid" class="col-md-6 col-form-label text-md-left">{{ __('Policy Scheme') }}</label>
                            <div class="col-sm-6">
                                <select id="planid" name="planid" class="form-control @error('planid') is-invalid @enderror select2">
                                    @if(count($planid))
                                        @foreach($planid as $value)
                                            <option value="{{$value['id']}}" selected>{{$value['fullname'].'('. $value['name'] . ')'}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('planid')
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
                                    <th>Sl No</th>
                                    <th>Policy No</th>
                                    <th>Policy Scheme</th>
                                    <th>Member Id</th>
                                    <th>Member Name</th>
                                    <th>Date Of Birth</th>
                                    <th>Amount</th>
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
        $(document).on('change','select[name="seacrhBy"]',function(e){
            if($(this).val()!='1') $('#searchTextDiv').css('display','flex');
            else $('#searchTextDiv').hide();
        });
        $(document).on('submit','#teamCollectionReport',function(e){
            e.preventDefault();
            var seacrhBy = $(this).find('select[name="seacrhBy"]').val();
            var searchText = $(this).find('input[name="searchText"]').val();
            if(seacrhBy!='1' && searchText==''){
                sweetAlert("<h1>Errors</h1>", "<p>Search text is required</p>", "error");
                $(this).find('input[name="searchText"]').focus();
                return false;
            }
            $.post($(this).attr('action'),$(this).serialize(),function(res){
                if(res.status){
                    var html = '';
                    if(res.data){
                        $.each(res.data,function(index,value){
                            html += '<tr><td>'+ (index+1)  + '</td><td>'+  value.policyno  + '</td><td>'+  value.plan  + '</td><td>'+  value.memberId  + '</td><td>'+  value.memberName  + '</td><td>'+  value.dob  + '</td><td class="text-right">'+  value.amount  + '</td></tr>';
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
                    $('#memberreport tbody').html('');
                }
            });
        });
    });
</script>
@endsection