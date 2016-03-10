
$(document).ready(function() {
	$(".showusermodallogin").click(function(e)
	{
		$('#userLogin').validationEngine('hideAll');
		//$('#userLogin .modal-body').find("input,textarea,select").val('');
		$("#usertypeid").val('3');
		$(".errormsg").html('');
		$('#userLogin').modal('show');
		
		$('#mainmodallogin').modal('hide');
		$('#modaluserRegister').modal('hide');
		
	});
	
	$(".showartistmodallogin").click(function(e)
	{
		$('#artistLogin').validationEngine('hideAll');
		//$('#artistLogin .modal-body').find("input,textarea,select").val('');
		$(".artistLogin #usertypeid").val('2');
		$(".errormsg").html('');
		
		$('#artistLogin').modal('show');
		
		$('#mainmodallogin').modal('hide');
		$('#modalartistRegister').modal('hide');
	});
	
	$(".showmodalPassword").click(function(e)
	{
		$('#modalforgotpassword').validationEngine('hideAll');
		$('#userLogin').modal('hide');
		$('#artistLogin').modal('hide');
		
		$('#modalforgotpassword .modal-body').find("input,textarea,select").val('');
		$('#modalforgotpassword').modal('show');
	});
	
	$(".showLogin").click(function(e)
	{
		$('#mainmodallogin').validationEngine('hideAll');
		$('#mainmodallogin .modal-body').find("input,textarea,select").val('');
		$('#mainmodallogin').modal('show');
		$('#modalforgotpassword').modal('hide');
	});
	
	$(".showusermodal").click(function(e)
	{
		$('#modaluserRegister').validationEngine('hideAll');
		$('#mainmodalregister').modal('hide');
		$('#modaluserRegister #txtFirstName').val('');
		$('#modaluserRegister #txtLastName').val('');
		$('#modaluserRegister #txtUsername').val('');
		$('#modaluserRegister #txtphonenumber').val('');
		$('#modaluserRegister #txtUserPassword').val('');
		$('#modaluserRegister #txtConfirmPassword').val('');
		$('#modaluserRegister #userdisplayname').val('');
		
		$('#usererrormsg').html('');
		$('#modaluserRegister .modal-body').find("input[type='text'],textarea").val('');
		 $('#modaluserRegister .dropdown .mutliSelect input[type=checkbox]').checked =false;
		  $("input[type=checkbox]").each(function () {
                $(this).checked=false;
            });
		$('#modaluserRegister .modal-body').find("select").val('0');
		$('.userRegister #txtUsertype').val('3');
		$('#modaluserRegister').modal('show');
		$('#userLogin').modal('hide');
		
	});
	
	$(".showartistmodal").click(function(e)
	{
		$('#modalartistRegister').validationEngine('hideAll');
		  $('#category_list').selectpicker('val', '');
		$('#mainmodalregister').modal('hide');
		//$('#modalartistRegister .fileupload-preview').css('display','none');
		$('#modalartistRegister .fileupload img').remove();
	
		$("#modalartistRegister .dropdown input:checkbox:checked").each(function(){ $(this).checked=false; });
		$('#modalartistRegister .modal-body').find("textarea").val('');
		$('#modalartistRegister #txtFirstName').val('');
		$('#modalartistRegister #txtLastName').val('');
		$('#modalartistRegister #txtUsername').val('');
		$('#modalartistRegister #txtphonenumber').val('');
		$('#modalartistRegister #txtPassword').val('');
		$('#modalartistRegister #txtConfirmPassword').val('');
		$('#modalartistRegister #txtNationality').val('');
		$('#modalartistRegister #txtBirth').val('');
		$('#modalartistRegister .modal-body').find("select").val('0');
		$('#txtUsertype').val('2');
		$('#artisterrormsg').html('');
		$('#modalartistRegister').modal('show');
		$('#artistLogin').modal('hide');
	});
	$('#modaluserRegister').on('hidden.bs.modal', function () {
		$('#modaluserRegister').validationEngine('hideAll');
	});
	$('#modalartistRegister').on('hidden.bs.modal', function () {
		$('#modalartistRegister').validationEngine('hideAll');
	});
	
});


function fnSocialRegister(element)
{
	var strURLElementId = $(element).val()+"_process_url";	
	


	strUrl = $('#'+strURLElementId).val();


	window.open(strUrl,'Login','width=500,height=1000');
}

function uploadMedia()
{
	$('#mymediaModal .modal-body').find("select").val('0');
	$('#mymediaModal .modal-body').find("input").val('');
	$('#mymediaModal .fileupload-buttonbar').css('display','none');
	//$("body").css('overflow','hidden');
	$("#mymediaModal").modal('show');
}