var urlval = "";
var urlshowinput = "";
var urlshowexpert = "";
var delinputurl = "";


$(document).ready(function () {

	 
 

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


 