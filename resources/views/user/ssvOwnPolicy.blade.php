@extends('layout.template')
@section('pagestyle')
<style>
    #policyList {
        width: 100%!important;
    }
    #policyList thead tr th {
        border: 1px solid #000;
        text-align: center;
    }
    #policyList tbody tr td {
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
                    <h2 class="text-center">{{ __('Profile') }}</h2>
                </div>
                <br>
                <div class="card-body">
                	<table id="policyList" class="table table-responsive">
                		<thead>
                			<tr>
                				<th>Sl. No.</th>
                				<th>Policy No.</th>
                				<th>Policy Plan</th>
                				<th>Premiun Amount</th>
                				<th>Term Period</th>
                				<th>Pdf</th>
                				<th>Status</th>
                			</tr>
                		</thead>
                		<tbody>
                			@if(count($policyList))
                				@foreach($policyList as $key => $value)
                					<tr>
                						<td>{{$key+1}}</td>
                						<td>{{$value['safepetransactionId']}}</td>
                						<td>{{$value['policy_plan']['name']}}</td>
                						<td><i class="fas fa-rupee-sign"></i>{{$value['package_amount']}}</td>
                						<td>{{$value['termPeriod']}} Months</td>
                						<td><a href="{{imageList($value['pdfFile'])}}" target="_blank">view</a></td>
                						<td>
                							@php
                								if(ucfirst($value['status'])=='Rejected') $status = 'danger';
                								elseif(ucfirst($value['status'])=='Approved') $status = 'success';
                								else $status = 'warning';
                							@endphp
                								<a href="#" class="btn btn-sm btn-{{$status}}">{{$value['status']}}</a>
                						</td>
                					</tr>
                				@endforeach
                			@endif
                		</tbody>
                	</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pagescript')
@endsection