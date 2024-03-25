var urlval = "";
var urlshowinput = "";
var urlshowexpert = "";
var delinputurl = "";


$(document).ready(function () {

	 
	$('#btn_del_record').on('click', function (e) {
		e.preventDefault();	 
		sendform('#del_record_form','form');
		});

	function sendform(formid) {
		startLoading();
	//	ClearErrors();
	//	$formid='#create_form';
		 
		var form = $(formid)[0];
		var formData = new FormData(form);
		urlval = $(formid).attr("action")
	 

		$.ajax({
			url: urlval,
			type: "POST",

			data: formData,
			contentType: false,
			processData: false,
			//contentType: 'application/json',
			success: function (data) {
				//	alert(data);
				endLoading();
				//$('#errormsg').html('');
				//$('#sortbody').html('');
				if (data.length == 0) {
					noteError();
				} else if (data == "ok") {
					$('#div_record').remove();
					noteSuccess();	
								
				
					
				//	ClearErrors();
				}

				// $('.alert').html(result.success);
			}, error: function (errorresult) {
				endLoading();
				var response = $.parseJSON(errorresult.responseText);
				// $('#errormsg').html( errorresult );
				noteError();
			

			}, finally: function () {
				endLoading();

			}
		 

		});


	 
	}
 

	});
	 
///////////////////////////////////////////////////////

 
$("#email").focusout(function (e) {
	if (!validatempty($(this))) {
		return false;
	}
	else if (!validateinputemail($(this), emailmsg)) {
		return false;

	} else {

		return true;
	}
});



 