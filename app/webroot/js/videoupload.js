
// function for update package
function uploadVideo()
{
	var isValidated = jQuery('#frmvideoupload').validationEngine('validate');

	if(isValidated == false)
		{
			return false;
		}
		else
		{
		$('.cms-bgloader-mask').show();//show loader mask
	 	$('.cms-bgloader').show(); //show loading image
		var url = strGlobalSiteBasePath+"websites/videouploadprocess";
		var type = "POST";
		var options = { 
		//target:        '#output2',   // target element(s) to be updated with server response 
		success:	function(responseText, statusText, xhr, $form) {
				if(responseText.status == "success")
				{
				
					$('.cms-bgloader-mask').hide();//hide loader mask
					$('.cms-bgloader').hide(); //hide loading image
					window.location = strGlobalSiteBasePath+"admins/banner";
				}
			
			},								
				 
			// other available options: 
			url:       url,         // override for form's 'action' attribute 
			type:      type,        // 'get' or 'post', override for form's 'method' attribute 
			dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
		} 
			$('#frmvideoupload').ajaxSubmit(options); 
			// !!! Important !!! 
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		}


}
$(document).ready(function(){

	$('.featured-artist li').mouseover(function()
		{
			$(this).children('.deletemedia').css('opacity','1');
		});
	$('.featured-artist li').mouseout(function()
		{
			$(this).children('.deletemedia').css('opacity','0');
		});

});

