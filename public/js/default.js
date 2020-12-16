/**
 * Custom Scripts
 *
 *
 * @package Banking
 * @author SWS
 * @version 1.0.0
 */
  function cashfreeOrderToken(amount) {
    $.post('cashfreeOrderToken',{amount:amount},function(res){
        if(res.status===false) {
            sweetAlert("<h1>Errors</h1>", "<p>{{__('message.general_error')}}</p>", "error");
        } else {
          var ele = $('#orderForm');
          ele.find('input[name="appId"]').val(res.data.appId);
          ele.find('input[name="orderId"]').val(res.data.orderId);
          ele.find('input[name="orderAmount"]').val(amount);
          ele.find('input[name="orderCurrency"]').val(res.data.orderCurrency);
          ele.find('input[name="orderNote"]').val(res.data.orderNote);
          ele.find('input[name="customerName"]').val(res.data.customerName);
          ele.find('input[name="customerEmail"]').val(res.data.customerEmail);
          ele.find('input[name="customerPhone"]').val(res.data.customerPhone);
          ele.find('input[name="token"]').val(res.data.token);
        }
    });
  }
  function show_errors(jqXHR, textStatus){
      var error_msg_string = "{{__('message.general_error')}}";
      if(jqXHR.status == 400){
          error_msg_string = jqXHR.responseJSON.message; 
      }
      if(jqXHR.status == 402 || jqXHR.status == 401){
          error_msg_string = jqXHR.responseJSON.message; 
      }
      if (jqXHR.status == 404) {
          error_msg_string = "Record Not Found"; 
      }
      if(jqXHR.status == 422 ){
        error_msg_string = '';
        $.each(jqXHR.responseJSON.errors, function (key, item) {
            error_msg_string += item+'\n';
        });
      }
      if(jqXHR.status == 500 ){
          error_msg_string = "Error 500: Internal Server Error";
      }
    sweetAlert("<h1>OOPS!! Errors</h1>", "<p>"+ error_msg_string + "</p>", "error");
  }
$(function () {
  $('[data-toggle="tooltip"]').tooltip({ boundary: 'window' });
  $("input[type=number]").on("focus", function() {
    $(this).on("keydown", function(event) {
        if (event.keyCode === 38 || event.keyCode === 40) {
            event.preventDefault();
        }
     });
   });
	$(document).on('click','.languagechange',function(e){
  		e.preventDefault();
  		$.ajax({
        url : $(this).prop('href'),
  			method:"post",
  			data: { lang: $(this).data('lang') },
  			dataType: "json",
        headers:{
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
  			success:function(res){
				  sweetAlert("", "<p>"+ res.message + "</p>", "success");
  			}
  		});
	});
});