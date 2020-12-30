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
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">{{ __('Search Policy') }}</h2>
                </div>
                <br>
                <div class="card-body">
                    <form class="form form-horizontal" id="searchSSVPolicy" method="POST" action="{{ route('searchSSVPolicy') }}" onsubmit="return false;">
                        @csrf
                        <div class="form-group row">
                            <label for="numberType" class="col-md-6 col-form-label text-md-left">{{ __('Search By') }}</label>
                            <div class="col-sm-6">
                                <select id="numberType" name="numberType" class="form-control @error('policySearch') is-invalid @enderror select2" required>
                                    @if(count($policySearch))
                                        @foreach($policySearch as $value)
                                            <option value="{{$value['id']}}" selected>{{$value['name']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('numberType')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="number" class="col-md-6 col-form-label text-md-left">{{ __('Search') }}</label>
                            <div class="col-sm-6">
                                <input id="number" type="text" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ old('number') }}" placeholder="Partner Id" autofocus required>
                                @error('number')
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
                                    <th>Member Id</th>
                                    <th>Member Name</th>
                                    <th>Policy No</th>
                                    <th>Mobile</th>
                                    <th>View Details</th>
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
        $(document).on('submit','#searchSSVPolicy',function(e){
            e.preventDefault();
            $.post($(this).attr('action'),$(this).serialize(),function(res){
                if(res.status){
                    var html = '';
                    if(res.data){
                        $.each(res.data,function(index,value){
                            html += '<tr><td>'+  value.memberId  + '</td><td>'+  value.memberName  + '</td><td>'+  value.policyno  + '</td><td class="text-right">'+  value.mobile  + '</td><td><a href="'+ value.pdf +'" class="btn btn-primary btn-sm" target="_blank">View</a></td></tr>';
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