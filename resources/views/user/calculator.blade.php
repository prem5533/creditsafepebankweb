@extends('layout.template')
@section('pagestyle')
<style>
    #maturity ,#monthly {
        display: none;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">{{ __('Policy Maturity Calculator') }}</h2>
                </div>
                <br>
                <div class="card-body">
                    <form class="form form-horizontal" id="calculateMaturity" method="POST" action="{{ route('calculateMaturity') }}" onsubmit="return false;">
                        @csrf
                        <div class="form-group row">
                            <label for="schemeId" class="col-md-6 col-form-label text-md-left">{{ __('Policy Scheme') }}</label>
                            <div class="col-sm-6">
                                <select id="schemeId" name="schemeId" class="form-control @error('schemeId') is-invalid @enderror select2">
                                    @if(count($schemes))
                                        @foreach($schemes as $value)
                                            <option value="{{$value['id']}}" selected>{{$value['fullname'].'('. $value['name'] . ')'}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('schemeId')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="planid" class="col-md-6 col-form-label text-md-left">{{ __('Policy Plan') }}</label>
                            <div class="col-sm-6">
                                <select id="planid" name="planid" class="form-control @error('planid') is-invalid @enderror select2" required>
                                </select>
                                @error('planid')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="amount" class="col-md-6 col-form-label text-md-left">{{ __('Amount') }}</label>
                            <div class="col-sm-6">
                                <input type="number" name="amount" value="" required>
                                @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="maturity">
                            <label class="col-md-6 col-form-label text-md-left">{{__('Maturity Amount')}}</label>
                            <label class="col-md-5 col-form-label text-md-left"><i class="fas fa-rupee-sign"></i><span></span></label>
                        </div>
                        <div class="form-group row" id="monthly">
                            <label class="col-md-6 col-form-label text-md-left">{{__('Monthly Income')}}</label>
                            <label class="col-md-5 col-form-label text-md-left"><i class="fas fa-rupee-sign"></i><span></span></label>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-1 offset-sm-10 text-right">
                                <button type="submit" class="btn btn-sm btn-primary">{{__('Calculate')}}</button>
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
    function changeplan() {
        var schemeId = $('select[name="schemeId"]').val();
        $.post('ssvSchemePlan',{schemeId:schemeId,_token:csrf_token},function(res){
            if(res.status){
                var html = '';
                if(res.data.length){
                    $.each(res.data,function(index,value){
                        html += '<option value="'+ value.id +'">'+ value.name  +'</option>';
                    });
                }
                $('#planid').html(html);
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
    }
    $(function(){
        changeplan();
        $(document).on('change','select[name="schemeId"]',function(e){
            $('#maturity').hide();
            $('#monthly').hide();
            $('#maturity').find('span').text('');
            $('#monthly').find('span').text('');
            changeplan();
        });
        $(document).on('submit','#calculateMaturity',function(e){
            e.preventDefault();
            $.post($(this).attr('action'),$(this).serialize(),function(res){
                console.log(res);
                if(res.status){
                    $('#maturity').find('span').text(res.data.maturity);
                    $('#maturity').show();
                    if(res.data.isMonthly){
                        $('#monthly').find('span').text(res.data.monthly);
                        $('#monthly').show();
                    } else {
                        $('#monthly').find('span').text('');
                        $('#monthly').hide();
                    }
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