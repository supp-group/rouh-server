 
$(document).ready(function () {
//alert( countryurl);
 
	$.getJSON(countryurl, function(data){
	//	console.log(data.countries);  
		$.each(data.countries, function( key,value) {
			$("#country_num").append('<option value="' + value.dialCode + '">' + value.dialCode +' '+ + '</option>');
		}); // close each()
	}).fail(function(){
		console.log("An error has occurred.");
	});
 

	$('#field_type').on('change', function () {
		var option = $(this).find(":selected").val();
		if (option == 'list') {
			//$('#list_option').show();
			$('#btn_add_option').show();
			//$('#bool_field').hide();
			$('#option_append').show();
		} else {
			$('#btn_add_option').hide();
			$('#option_append').hide();
		}

	});
 
 
});

///////////////////////////////////////////////////////
 

