<!-- Vendor JS Files -->
<script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/all.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>
<script src="{{asset('js/select2.min.js')}}"></script>
<script src="{{asset('js/default.js')}}"></script>
<script type="text/javascript">
var base_url = $('meta[name="base_url"]').attr('content');
var csrf_token = $('meta[name="csrf-token"]').attr('content');
$('[data-toggle="tooltip"]').tooltip({ boundary: 'window' });
@if(\Session::has('message'))
	@if(\Session::get('status'))
		  sweetAlert("Safepe Credit", "<p>{{Session::get('message')}}</p>", "success");
	@else
		  sweetAlert("Safepe Credit", "<p>{{Session::get('message')}}</p>", "error");
	@endif
@endif
</script>
@yield('pagescript')