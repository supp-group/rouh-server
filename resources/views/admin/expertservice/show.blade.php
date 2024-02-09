@foreach ($selectedexperts as $selectedexpert)                                  
<form class="form-horizontal delete-expert-form" name="delete_expert_form"
action="{{ url('admin/service/expert/deleteselected', $selectedexpert->id) }}" method="POST"
id="delete_expert_form">
@csrf
<div class="mb-2">
    <div class="mb-3">
        <div class="service-field row">
            <div class="col-8">
                <p>{{ $selectedexpert->expert->user_name }}</p>
            </div>   
                      <div class="col-4">
                <div class="form-horizontal d-inline-block">
                    <div class="form-group">
                        <button type="submit" class="btn ripple btn-danger btn-delete-expert"
                            id="expert-{{ $selectedexpert->expert->id }}"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endforeach

<script>

$(document).ready(function() {
    $('.btn-delete-expert').on('click', function (e) {
		e.preventDefault();
		var thisform = $(this).parents('form:first');
		startLoading();
		//ClearErrors();
		//var fdata = $( "#create_form" ).serialize();
		
		var form = thisform[0];
		var formData = new FormData(form);
		urlval = thisform.attr("action")
		//var urlval ='{{url("admin/user")}}';
		//const formData = new FormData("#create_form");
		//  alert(formData.toString());

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
					//ClearErrors();					
					loadexperts();
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
			/*
			error: function(jqXHR, textStatus, errorThrown) {
			 alert(jqXHR.responseText);
			  // $('#errormsg').html(jqXHR.responseText);
			  //$('#errormsg').html("Error");
			  $('#error').text(jqXHR.responseText);
			}
			*/

		});


});
//////
function loadexperts() {


//var formData = 21;

//var urlval ='{{url("admin/user")}}';


$.ajax({
    url: urlshowexpert,
    type: "GET",

    //	data: formData,
    //	contentType: false,
    //processData: false,
    //contentType: 'application/json',
    success: function (data) {

        //$('#errormsg').html('');
        //$('#sortbody').html('');
        if (data.length == 0) {
            //	noteError();
        } else {
            $('#div_selectedexpert').html(data);

        }

        // $('.alert').html(result.success);
    }, error: function (errorresult) {
        //endLoading();
        var response = $.parseJSON(errorresult.responseText);
        // $('#errormsg').html( errorresult );


    }, finally: function () {
        //endLoading();

    }
});
}
</script>