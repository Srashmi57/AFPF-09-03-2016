// website registration
function siteRegister()
{
	
	var isValidated = jQuery('#frmRegister').validationEngine('validate');
	if(isValidated == false)
		{
			return false;
		}
		else
		{
		
		var url = strGlobalSiteBasePath+"Users/fnAddUserProcess";
		
		var type = "POST";
		var options = { 
		//target:        '#output2',   // target element(s) to be updated with server response 
		success:	function(responseText, statusText, xhr, $form) {
			
				if(responseText.status == "success")
				{
					window.location = strGlobalSiteBasePath;
				}
				
			},								
				 
			// other available options: 
			url:       url,         // override for form's 'action' attribute 
			type:      type,        // 'get' or 'post', override for form's 'method' attribute 
			dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
		} 
			$('#frmRegister').ajaxSubmit(options); 
			// !!! Important !!! 
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		}
}

function websitelogin()
{
	   
	var isValidated = jQuery('#frmLogin').validationEngine('validate');
	if(isValidated == false)
	{
			return false;
	}
	else
	{
	   //alert('in');
	   var url = strGlobalSiteBasePath+"Websites/login";
	   
		//alert(url);
		var type = "POST";
		var options = { 
		//target:        '#output2',   // target element(s) to be updated with server response 
		success: function(responseText, statusText, xhr, $form) {
			
				//alert(responseText.status);
				if(responseText.status == "success")
				{
					
					window.location.reload(true);
					
				}
				if(responseText.status == "fail")
				{
					
					
				}
			
			},								
				 
			// other available options: 
			url:       url,         // override for form's 'action' attribute 
			type:      type,        // 'get' or 'post', override for form's 'method' attribute 
			dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
		} 
		
	
	
	$('#frmLogin').ajaxSubmit(options);
	// !!! Important !!! 
	// always return false to prevent standard browser submit and page navigation 
	return false; 
	
	}
	    

}

