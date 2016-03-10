//Function For Add New user

function fnAddUser()
{
	
	var isValidated = jQuery('#addNewUser').validationEngine('validate');
	if(isValidated == false)
		{
			return false;
		}
		else
		{
		
		var url = strGlobalSiteBasePath+"users/fnAddUserProcess";
		var type = "POST";
		var options = { 
		//target:        '#output2',   // target element(s) to be updated with server response 
		success:	function(responseText, statusText, xhr, $form) {
			
				if(responseText.status == "success")
				{
					window.location = strGlobalSiteBasePath+"users";
				}
				
			},								
				 
			// other available options: 
			url:       url,         // override for form's 'action' attribute 
			type:      type,        // 'get' or 'post', override for form's 'method' attribute 
			dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
		} 
			$('#addNewUser').ajaxSubmit(options); 
			// !!! Important !!! 
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		}
}




///function to add subadmins


//Function For Add New user

function fnToAddAdmin()
{
	
	var isValidated = jQuery('#addNewAdmin').validationEngine('validate');
	if(isValidated == false)
		{
			return false;
		}
		else
		{
		
		var url = strGlobalSiteBasePath+"admins/fnToAddAdminProcess";
		var type = "POST";
		var options = { 
		//target:        '#output2',   // target element(s) to be updated with server response 
		success:	function(responseText, statusText, xhr, $form) {
			
				if(responseText.status == "success")
				{
					window.location = strGlobalSiteBasePath+"admins/Users";
				}
				
			},								
				 
			// other available options: 
			url:       url,         // override for form's 'action' attribute 
			type:      type,        // 'get' or 'post', override for form's 'method' attribute 
			dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
		} 
			$('#addNewAdmin').ajaxSubmit(options); 
			// !!! Important !!! 
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		}
}



//Function Add Categories 
function fnAddCategory()
{

	var isValidated = jQuery('#addCategory').validationEngine('validate');
	if(isValidated == false)
		{
			return false;
		}
		else
		{
		
		var url = strGlobalSiteBasePath+"categories/fnAddCategory";
		var type = "POST";
		var options = { 
		//target:        '#output2',   // target element(s) to be updated with server response 
		success:	function(responseText, statusText, xhr, $form) {
				if(responseText.status == "success")
				{
			
					window.location = strGlobalSiteBasePath+"categories";
				}
				
			},								
				 
			// other available options: 
			url:       url,         // override for form's 'action' attribute 
			type:      type,        // 'get' or 'post', override for form's 'method' attribute 
			dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
		} 
			$('#addCategory').ajaxSubmit(options); 
			// !!! Important !!! 
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		}
}

//Function Update Categories 
function fnUpdateCategory()
{

	var isValidated = jQuery('#editCategory').validationEngine('validate');
	if(isValidated == false)
		{
			return false;
		}
		else
		{
		
		var url = strGlobalSiteBasePath+"categories/fnCategoryUpdateProcess";
		var type = "POST";
		var options = { 
		//target:        '#output2',   // target element(s) to be updated with server response 
		success:	function(responseText, statusText, xhr, $form) {
				if(responseText.status == "success")
				{
			
					window.location = strGlobalSiteBasePath+"categories";
				}
				
			},								
				 
			// other available options: 
			url:       url,         // override for form's 'action' attribute 
			type:      type,        // 'get' or 'post', override for form's 'method' attribute 
			dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
		} 
			$('#editCategory').ajaxSubmit(options); 
			// !!! Important !!! 
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		}
}




//function to SubCategory
function fnAddSubCategory()
{

	var isValidated = jQuery('#addSubCategory').validationEngine('validate');
	if(isValidated == false)
		{
			return false;
		}
		else
		{
		
		var url = strGlobalSiteBasePath+"categories/fnAddSubCategories";
		var type = "POST";
		var options = { 
		//target:        '#output2',   // target element(s) to be updated with server response 
		success:	function(responseText, statusText, xhr, $form) {
				if(responseText.status == "success")
				{
			
					window.location = strGlobalSiteBasePath+"Subcategories";
				}
				
			},								
				 
			// other available options: 
			url:       url,         // override for form's 'action' attribute 
			type:      type,        // 'get' or 'post', override for form's 'method' attribute 
			dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
		} 
			$('#addSubCategory').ajaxSubmit(options); 
			// !!! Important !!! 
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		}
}

//function to SubSubCategory
function fnAddSubSubCategory()
{

	var isValidated = jQuery('#addSubSubCategory').validationEngine('validate');
	if(isValidated == false)
		{
			return false;
		}
		else
		{
		
		var url = strGlobalSiteBasePath+"categories/fnAddSubSubCategories";
		var type = "POST";
		var options = { 
		//target:        '#output2',   // target element(s) to be updated with server response 
		success:	function(responseText, statusText, xhr, $form) {
				if(responseText.status == "success")
				{
			
					window.location = strGlobalSiteBasePath+"subsubcategories";
				}
				
			},								
				 
			// other available options: 
			url:       url,         // override for form's 'action' attribute 
			type:      type,        // 'get' or 'post', override for form's 'method' attribute 
			dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
		} 
			$('#addSubSubCategory').ajaxSubmit(options); 
			// !!! Important !!! 
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		}
}


//Function Update Subcategory 
function fnUpdateSubCategory()
{

	var isValidated = jQuery('#editSubCategory').validationEngine('validate');
	if(isValidated == false)
		{
			return false;
		}
		else
		{
		
		var url = strGlobalSiteBasePath+"subcategories/fnSubCategoryUpdateProcess";
		var type = "POST";
		var options = { 
		//target:        '#output2',   // target element(s) to be updated with server response 
		success:	function(responseText, statusText, xhr, $form) {
				if(responseText.status == "success")
				{
			
					window.location = strGlobalSiteBasePath+"subcategories";
				}
				
			},								
				 
			// other available options: 
			url:       url,         // override for form's 'action' attribute 
			type:      type,        // 'get' or 'post', override for form's 'method' attribute 
			dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
		} 
			$('#editSubCategory').ajaxSubmit(options); 
			// !!! Important !!! 
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		}
}





//Function for Add Package
function fnAddPackage ()
{
alert("hi");
var isValidated = jQuery('#addPackage').validationEngine('validate');
	if(isValidated == false)
		{
			return false;
		}
		else
		{
		
		var url = strGlobalSiteBasePath+"packages/fnAddPackage";
		var type = "POST";
		var options = { 
		//target:        '#output2',   // target element(s) to be updated with server response 
		success:	function(responseText, statusText, xhr, $form) {
				if(responseText.status == "success")
				{
			
					window.location = strGlobalSiteBasePath+"packages";
				}
				else
				{
					
				}
			},								
				 
			// other available options: 
			url:       url,         // override for form's 'action' attribute 
			type:      type,        // 'get' or 'post', override for form's 'method' attribute 
			dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
		} 
			$('#addPackage').ajaxSubmit(options); 
			// !!! Important !!! 
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		}
}


 

// function for update package
function fnUpdatePackage()
{

var isValidated = jQuery('#editPackage').validationEngine('validate');
	if(isValidated == false)
		{
			return false;
		}
		else
		{
		
		var url = strGlobalSiteBasePath+"packages/fnUpdatePackageProcess";
		var type = "POST";
		var options = { 
		//target:        '#output2',   // target element(s) to be updated with server response 
		success:	function(responseText, statusText, xhr, $form) {
				if(responseText.status == "success")
				{
			
					window.location = strGlobalSiteBasePath+"packages";
				}
			
			},								
				 
			// other available options: 
			url:       url,         // override for form's 'action' attribute 
			type:      type,        // 'get' or 'post', override for form's 'method' attribute 
			dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
		} 
			$('#editPackage').ajaxSubmit(options); 
			// !!! Important !!! 
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		}


}

 function ChangeStatus( getcontrol, id,  status)
{
		
		$.ajax({
		type: "POST",
		url: strGlobalSiteBasePath+getcontrol+"/UpdateStatus",
		data: {"id" : id, "status":status},
		cache: false,
		dataType: 'json',
		success: function(data)
		{
				Respstatus = data.status;
					if(Respstatus == "success")
					{
					
						window.location = strGlobalSiteBasePath+getcontrol;
					
					
					}
					else
					{
						
						alert("Failed");
						return false;
					}
		}
	});
}


// Get subcategorylist 
function fnGetSubcategoryList(categoryid)
{
	var intCategory_id = categoryid;

	var datastr = 'category_id='+intCategory_id;
	
	if(intCategory_id=="")
	{
		
		$('#subcatlist').append($("<option></option>"));
		
	}
	else
	{
	$.ajax({ 
			type: "POST",
			url: strGlobalSiteBasePath+"/App/fnToGetAllSubCategoriesList",
			 data: {category_id:intCategory_id},
			dataType: "json",
			cache: false,
			success: function(data)
			{
				var items = [];
				  $.each( data, function( key, val ) {
					items.push('<option value="'+ key +'">'+ val +'</option>');
				  });
				  $('#subcatlist').html(items); 
				 
			}
	});
	}
}

