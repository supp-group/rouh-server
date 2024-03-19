 
$(document).ready(function () {
//alert( countryurl);
 
 
  

		$('#sel_side').on('change', function () {
			var option = $(this).find(":selected").val();
			ClearErrors();
			$('#sel_side_val').html('<option title="اختر" value="0"  class="text-muted">اختر</option>');
if(option!="0"){	 
	var formData = 'sel_side='+option;
	urlval = blncesidurl;
		$.ajax({
		url: urlval,
		type: "GET",
	 	data: formData,
	//	contentType: false,
	//	processData: false,
		//contentType: 'application/json',
		success: function (data) {			 
			if (data.length == 0) {			 
			} else   {
				datalist=data;
				$(data).each(function(index, item) {
					$('#sel_side_val').append('<option value="'+ item.id +'" >'+ item.name +'</option>');
			});		 
			}		 
		}, error: function (errorresult) {		 
		 
		 
		} 
		/*
		error: function(jqXHR, textStatus, errorThrown) {
		 alert(jqXHR.responseText);
		  // $('#errormsg').html(jqXHR.responseText);
		  //$('#errormsg').html("Error");
		  $('#error').text(jqXHR.responseText);
		}
		*/

	});
}	
		});

		
		$('#sel_side_val').on('change', function () {
			var option = $(this).find(":selected").val();
	//var blc=	datalist.name;
	var blc = datalist.filter(function(x){ return x.id == option }) ;
	var blcval=  blc[0].balance;
	$('#p_show_balance').show();
	$('#balance_val').html(blcval);
	
		});

		function ClearErrors() {

			$('.parsley-required').html('');
			$(":input").removeClass('parsley-error');
			$("#mobile_num").removeClass('parsley-error');
		} 
});

///////////////////////////////////////////////////////
 


