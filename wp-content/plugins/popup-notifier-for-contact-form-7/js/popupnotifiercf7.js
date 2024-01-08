//
//	Define variables
//

var isAutoClose = PopUpParamsCF7.popupnotifiercf7_option_isAutoClose == 1 ? true : false;
var isConfirmButton = PopUpParamsCF7.popupnotifiercf7_option_isConfirmButton == 1 ? true : false;
var isShowIcon = PopUpParamsCF7.popupnotifiercf7_option_isShowIcon == 1 ? true : false;
var customSeconds = PopUpParamsCF7.popupnotifiercf7_option_customSeconds ? PopUpParamsCF7.popupnotifiercf7_option_customSeconds : 2500;
customSeconds = isAutoClose ? customSeconds : undefined;
var customTextButton = PopUpParamsCF7.popupnotifiercf7_option_customTextButton ? PopUpParamsCF7.popupnotifiercf7_option_customTextButton : 'Close';
var customTextButtonBackground = PopUpParamsCF7.popupnotifiercf7_option_customTextButtonBackground;

//
//	Sweetalert
//

document.addEventListener( 'wpcf7mailsent', function( event ) {
	Swal.fire({
	  title: event.detail.apiResponse.message,
	  icon: isShowIcon ? 'success' : undefined,
	  showConfirmButton: isConfirmButton,
	  timer: customSeconds,
	  confirmButtonText: customTextButton,
	  confirmButtonColor: customTextButtonBackground,
	})
}, false );

document.addEventListener( 'wpcf7invalid', function( event ) {
	Swal.fire({
	  title: event.detail.apiResponse.message,
	  icon: isShowIcon ? 'error' : undefined,
	  showConfirmButton: isConfirmButton,
	  timer: customSeconds,
	  confirmButtonText: customTextButton,
	  confirmButtonColor: customTextButtonBackground,
	})
}, false );

document.addEventListener( 'wpcf7spam', function( event ) {
	Swal.fire({
	  title: event.detail.apiResponse.message,
	  icon: isShowIcon ? 'warning' : undefined,
	  showConfirmButton: isConfirmButton,
	  timer: customSeconds,
	  confirmButtonText: customTextButton,
	  confirmButtonColor: customTextButtonBackground,
	})
}, false );

document.addEventListener( 'wpcf7mailfailed', function( event ) {
	Swal.fire({
	  title: event.detail.apiResponse.message,
	  icon: isShowIcon ? 'warning' : undefined,
	  showConfirmButton: isConfirmButton,
	  timer: customSeconds,
	  confirmButtonText: customTextButton,
	  confirmButtonColor: customTextButtonBackground,
	})
}, false );

document.addEventListener( 'wpcf7submit', function( event ) {
	var divsToHide = document.getElementsByClassName("wpcf7-response-output");
	for(var i = 0; i < divsToHide.length; i++){
	    divsToHide[i].style.visibility = "hidden";
	    divsToHide[i].style.display = "none";
	}
}, false );

