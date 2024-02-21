var urlval = "";
var urlshowinput = "";
var urlshowexpert = "";
var delinputurl = "";


$(document).ready(function () {



	$('#btn_update_state').on('click', function (e) {
		e.preventDefault();
		sendform('#update_form');
		});
	 
		$('#btn_answer_state').on('click', function (e) {
			e.preventDefault();
			sendform('#answer_form');
			});
		 
	 
	function ClearErrors() {

		$('.parsley-required').html('');
		$(":input").removeClass('parsley-error');
	}
  
	function sendform(formid) {
		startLoading();
		ClearErrors();
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
					noteSuccess();

					ClearErrors();
				}

				// $('.alert').html(result.success);
			}, error: function (errorresult) {
				endLoading();
				var response = $.parseJSON(errorresult.responseText);
				// $('#errormsg').html( errorresult );
				noteError();
				$.each(response.errors, function (key, val) {
					$("#" + key + "_error").text(val[0]);
					$("#" + key).addClass('parsley-error');
					//$('#error').append(key+"-"+ val[0] +"/");
				});

			}, finally: function () {
				endLoading();

			}
		 

		});


	 
	}
	$('#form_state').on('change', function () {
		var option = $(this).find(":selected").val();
		if (option == 'reject') { 
			$('#reason-div').show();	 
		} else if (option == 'agree') {		 
			$('#reason-div').hide();		 
		}  else{
			$('#reason-div').hide();
		}
	});
	});
	 
	 

 


 

///////////////////////////////////////////////////////

 
 
function noteSuccess() {
	notif({
		msg: "تمت الاضافة بنجاح ",
		type: "success"
	});
}
function noteError() {
	notif({
		msg: "لم تنجح العملية !",
		position: "right",
		type: "error",
		bottom: '10'
	});
}
 
 
function resetexpertForm() {
	jQuery('#expert_form')[0].reset();


	/*
	$('#imgshow').attr("src", emptyimg);
	$('#iconshow').attr("src", emptyimg);
	*/
}
 

 
 
