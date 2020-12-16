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
                    <h2 class="text-center">{{ __('Self Collection Details') }}</h2>
                </div>
                <br>
                <div class="card-body">
                    <form class="form form-horizontal" id="selfCollectionDetails" method="POST" action="{{ route('selfCollectionDetails') }}" onsubmit="return false;">
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
                                    <th>Policy No</th>
                                    <th>Mobile</th>
                                    <th>Date Of Birth</th>
                                    <th>Amount</th>
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
<div class="modal fade modal-quick-view" id="memberreportViewModal" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog" style="max-width: 50%;">
        <div class="modal-content px-3 py-2">
            <button type="button" class="close modal-close-btn ml-auto" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <div class="row">
                    <fieldset class="col-sm-12">
                        <legend>{{__('Policy Detail')}}</legend>
                        <div class="row">
                            <label class="col-md-6">Applicant Name</label>
                            <label class="col-md-6" id="applicantname"></label>
                        </div>
                        <div class="row">
                            <label class="col-md-6">Plan</label>
                            <label class="col-md-6" id="plan"></label>
                        </div>
                        <div class="row">
                            <label class="col-md-6">Branch</label>
                            <label class="col-md-6" id="branch"></label>
                        </div>
                        <div class="row">
                            <label class="col-md-6">Policy No</label>
                            <label class="col-md-6" id="policyno"></label>
                        </div>
                        <div class="row">
                            <label class="col-md-6">Maturity Date</label>
                            <label class="col-md-6" id="maturityDate"></label>
                        </div>
                        <div class="row">
                            <label class="col-md-6">Maturity Amount</label>
                            <label class="col-md-6" id="maturityAmount"></label>
                        </div>
                        <div class="row">
                            <label class="col-md-6">Member Id</label>
                            <label class="col-md-6" id="memberId"></label>
                        </div>
                        <div class="row">
                            <label class="col-md-6">Member Name</label>
                            <label class="col-md-6" id="membername"></label>
                        </div>
                        <div class="row">
                            <label class="col-md-6">Purchased By</label>
                            <label class="col-md-6" id="purchasedBy"></label>
                        </div>
                        <div class="row">
                            <label class="col-md-6">Next Premium Date</label>
                            <label class="col-md-6" id="nextPremiumDate"></label>
                        </div>
                    </fieldset>
                    <fieldset class="col-sm-12">
                        <legend>Payment Detail</legend>
                        <div class="row">
                            <label class="col-md-6">Total Term</label>
                            <label class="col-md-6" id="totalTerm"></label>
                        </div>
                        <div class="row">
                            <label class="col-md-6">Total Paid Term</label>
                            <label class="col-md-6" id="totalPaidTerm"></label>
                        </div>
                        <div class="row">
                            <label class="col-md-6">Payment Option</label>
                            <label class="col-md-6" id="paymentOption"></label>
                        </div>
                        <div class="row">
                            <label class="col-md-6">Premium amount</label>
                            <label class="col-md-6" id="premiumAmount"></label>
                        </div>
                        <div class="row">
                            <label class="col-md-6">Tptal premium amount</label>
                            <label class="col-md-6" id="totalPremiumAmount"></label>
                        </div>
                        <div class="row">
                            <label class="col-md-6">Fine</label>
                            <label class="col-md-6" id="fine"></label>
                        </div>
                        <div class="row">
                            <label class="col-md-6">Discount</label>
                            <label class="col-md-6" id="discount"></label>
                        </div>
                        <div class="row">
                            <label class="col-md-6">Total Amount</label>
                            <label class="col-md-6" id="totalAmount"></label>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('pagescript')
<script>
    $(function(){
        var detail = [];
        $(document).on('submit','#selfCollectionDetails',function(e){
            detail = [];
            e.preventDefault();
            $.post($(this).attr('action'),$(this).serialize(),function(res){
                if(res.status){
                    var html = '';
                    if(res.data){
                        $.each(res.data,function(index,value){
                            html += '<tr><td>'+  value.policyno  + '</td><td>'+  value.mobile  + '</td><td>'+  value.dob  + '</td><td class="text-right">'+  value.amount  + '</td><td><a href="" class="viewDetail" data-id="' + index + '" >View</a></td></tr>';
                            detail.push(value.details);
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
        $(document).on('click','.viewDetail',function(e){
            e.preventDefault();
            var temp = detail[$(this).data('id')];
            $.each(temp,function(index,value){
                $('#'+index).html(value);
            });
            $('#memberreportViewModal').modal();
        });
    });
</script>
@endsection