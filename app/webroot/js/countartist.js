

function getfollowerslist(userid)
{
			$.ajax({ 
			type: "POST",
			url: strGlobalSiteBasePath+"users/listallfollowers/"+userid,
			dataType: "json",
			cache: false,
			success: function(data)
			{
				$('#followermodel .modal-body').html(data.content);
				$('#followermodel').modal('show');
				 
			}
	});
	
	
}

function getfollowinglist(userid)
{
			$.ajax({ 
			type: "POST",
			url: strGlobalSiteBasePath+"users/listallfollowing/"+userid,
			dataType: "json",
			cache: false,
			success: function(data)
			{
				
				$('#followingmodel .modal-body').html(data.content);
				$('#followingmodel').modal('show');
				 
			}
	});
	
	
}

function getlikelist(userid)
{
			$.ajax({ 
			type: "POST",
			url: strGlobalSiteBasePath+"users/listalllikes/"+userid,
			dataType: "json",
			cache: false,
			success: function(data)
			{
				$('#likemodel .modal-body').html(data.content);
				$('#likemodel').modal('show');
				 
			}
	});
	
	
}

function deletecomment(mediacomment_id)
{
	
			$.ajax({ 
			type: "POST",
			url: strGlobalSiteBasePath+"users/deletecomment/"+mediacomment_id,
			dataType: "json",
			cache: false,
			success: function(data)
			{
				if(data.status=="success")
				{
					//bootbox.alert(""+mediacomment_id+"");
					$("#comment"+mediacomment_id).remove();
					$("#recentCommentmodal #comment"+mediacomment_id).remove();
					//$("#comment"+mediacomment_id).css('display','none');
					
					bootbox.alert("comment deleted successfully");
				}
				else
				{
					bootbox.alert("comment deletion failed");
				}
				
			}
	});
	
	
}
function deletepopcomment(mediacomment_id)
{
	
			$.ajax({ 
			type: "POST",
			url: strGlobalSiteBasePath+"users/deletecomment/"+mediacomment_id,
			dataType: "json",
			cache: false,
			success: function(data)
			{
				if(data.status=="success")
				{
					
					$("#comment"+mediacomment_id).css('display','none');
					bootbox.alert("comment deleted successfully");
				}
				else
				{
					bootbox.alert("comment deletion failed");
				}
				
			}
	});
	
	
}


function updatecomment(mediacomment_id)
{
	
			$.ajax({ 
			type: "POST",
			url: strGlobalSiteBasePath+"users/updatecomment/"+mediacomment_id,
			dataType: "json",
			cache: false,
			success: function(data)
			{
				
				if(data.status=="success")
				{
					document.getElementById('updateusermediaid').value= data.mediacomment_id;
					document.getElementById('txtupdatecomment').value = data.usermedia_comment;
					$('#uartistmediatitle').text(data.usermedia_name)
					$("#updatecommentmodal").modal('show');
					$('#recentCommentmodal').modal('hide');
					
				}
				
			}
	});
	
	
}
function updatecomment1(mediacomment_id)
{
	
			$.ajax({ 
			type: "POST",
			url: strGlobalSiteBasePath+"users/updatecomment/"+mediacomment_id,
			dataType: "json",
			cache: false,
			success: function(data)
			{
				
				if(data.status=="success")
				{
					document.getElementById('updateusermediaid1').value= data.mediacomment_id;
					document.getElementById('txtupdatecomment1').value = data.usermedia_comment;
					$('#uartistmediatitle007').text(data.usermedia_name)
					$("#updatecommentmodal007").modal('show');
					$('#recentCommentmodal').modal('hide');
					
				}
				
			}
	});
	
	
}

function updatecommentprocess()
{
		var isValidated = jQuery('#frmupateartistcomment').validationEngine('validate');
	if(isValidated == false)
		{
			return false;
		}
		else
		{
		
		$('.cms-bgloader-mask').show();//show loader mask
	 	    $('.cms-bgloader').show(); //show loading image
		var url = strGlobalSiteBasePath+"users/fnUpdateCommentProcess";
		var type = "POST";
		var options = { 
		//target:        '#output2',   // target element(s) to be updated with server response 
		success:	function(responseText, statusText, xhr, $form) {
			
			$('.cms-bgloader-mask').hide();//show loader mask
	 	    $('.cms-bgloader').hide(); //show loading image
			
				if(responseText.status == "success")
				{
						var username = "";
						var commentid = responseText.mediacomment_id;
						var user_image = responseText.user_image;
						var user_comment = responseText.user_comment;
						var user_fname = responseText.user_fname;
						var user_lname = responseText.user_lname;
						var hrefuser = responseText.hrefuser;
						var user_display_name = responseText.user_display_name;
						if(user_display_name)
						{
							username = user_display_name;
						}
						else
						{
							username = user_fname + user_lname;
						}
						$('#updatecommentmodal').modal('hide');
						$("#comment"+commentid).css('display','none');
						$( "<div class='media' id='comment"+commentid+"'><a class='media-left' href="+hrefuser+"><img width='28px' height='25px' class='img-circle' src='"+user_image+"' alt='...'></a><div class='media-body'><h4 class='media-text'>"+user_comment+"</h4><p><span class='pull-left'><a href='javascript:void(0);' onclick='return deletecomment("+commentid+");'><i class='fa fa-trash-o'></i></a>&nbsp;<a onclick='return updatecomment("+commentid+");' href='javascript:void(0);'><i class='fa fa-edit'></i></a></span><a href="+hrefuser+"><span class='pull-right'>"+username+"</span></a></p></div></div>" ).insertAfter( "#addcomment" );
						bootbox.alert("comment Updated successfully");
				}
				else
				{
					bootbox.alert("comment Updated failed");
				}
				
				
			},								
				 
			// other available options: 
			url:       url,         // override for form's 'action' attribute 
			type:      type,        // 'get' or 'post', override for form's 'method' attribute 
			dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
		} 
			$('#frmupateartistcomment').ajaxSubmit(options); 
			// !!! Important !!! 
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		}
}
function updatecommentprocess007()
{
		var isValidated = jQuery('#frmupateartistcomment1').validationEngine('validate');
	if(isValidated == false)
		{
			return false;
		}
		else
		{
		
		$('.cms-bgloader-mask').show();//show loader mask
	 	    $('.cms-bgloader').show(); //show loading image
		var url = strGlobalSiteBasePath+"users/fnUpdateCommentProcess";
		var type = "POST";
		var options = { 
		//target:        '#output2',   // target element(s) to be updated with server response 
		success:	function(responseText, statusText, xhr, $form) {
			
			$('.cms-bgloader-mask').hide();//show loader mask
	 	    $('.cms-bgloader').hide(); //show loading image
			
				if(responseText.status == "success")
				{
						var username = "";
						var commentid = responseText.mediacomment_id;
						var user_image = responseText.user_image;
						var user_comment = responseText.user_comment;
						var user_fname = responseText.user_fname;
						var user_lname = responseText.user_lname;
						var hrefuser = responseText.hrefuser;
						var user_display_name = responseText.user_display_name;
						if(user_display_name)
						{
							username = user_display_name;
						}
						else
						{
							username = user_fname + user_lname;
						}
						$('#updatecommentmodal007').modal('hide');
						$("#comment"+commentid).css('display','none');
						$( "<div class='media' id='comment"+commentid+"'><a class='media-left' href="+hrefuser+"><img width='28px' height='25px' class='img-circle' src='"+user_image+"' alt='...'></a><div class='media-body'><h4 class='media-text'>"+user_comment+"</h4><p><span class='pull-left'><a href='javascript:void(0);' onclick='return deletecomment("+commentid+");'><i class='fa fa-trash-o'></i></a>&nbsp;<a onclick='return updatecomment("+commentid+");' href='javascript:void(0);'><i class='fa fa-edit'></i></a></span><a href="+hrefuser+"><span class='pull-right'>"+username+"</span></a></p></div></div>" ).insertAfter( "#addcomment2" );
						$('#popup').hide();
						bootbox.alert("comment Updated successfully");
				}
				else
				{
					bootbox.alert("comment Updated failed");
				}
				
				
			},								
				 
			// other available options: 
			url:       url,         // override for form's 'action' attribute 
			type:      type,        // 'get' or 'post', override for form's 'method' attribute 
			dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
		} 
			$('#frmupateartistcomment1').ajaxSubmit(options); 
			// !!! Important !!! 
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		}
}
function updateMedianame(mediaid)
{
	
	var media	= $(".artist-detail-height .col-md-6 h3").text();
	//alert(media);
	media = $.trim(media);
	$("#medianame").val(media);
	$("#medianameid").val(mediaid);
	$("#medianamemodal").modal('show');
	
}


function updateMedianamebyupload(mediaid)
{
	var media	= $('#medianame'+mediaid).text();
	
	$("#medianame").val(media);
	$("#medianameid").val(mediaid);
	$("#medianamemodal").modal('show');
	
}
function updateMedianameprocess()
{
		var isValidated = jQuery('#frmmedianame').validationEngine('validate');
	if(isValidated == false)
		{
			return false;
		}
		else
		{
		$('.cms-bgloader-mask').show();//show loader mask
	 	$('.cms-bgloader').show(); //show loading image
		var url = strGlobalSiteBasePath+"users/fnUpdateMedianameProcess";
		var type = "POST";
		var options = { 
		//target:        '#output2',   // target element(s) to be updated with server response 
		success:	function(responseText, statusText, xhr, $form) {
			
			$('.cms-bgloader-mask').hide();//show loader mask
	 	    $('.cms-bgloader').hide(); //show loading image
			
				if(responseText.status == "success")
				{
				
					var media_name = responseText.media_name;
					var media_name_id = responseText.medianameid;	
						
					$( ".artistupload  h3" ).replaceWith( "<h3>"+media_name+"<a href='javascript:void(0);' onclick='return updateMedianame("+media_name_id+")'><i class='fa fa-edit pull-right'></i></a></h3>" );
					
					$(".performer-info .infotext  .row"+media_name_id+"").html("<a id="+media_name_id+" onclick='return fnartistmediatitle("+media_name_id+")' class='artistmediatitle'>"+media_name+"</a>");
						$('#medianame'+media_name_id).text(media_name);
						$('#medianamemodal').modal('hide');
						bootbox.alert("Media name updated successfully");
				}
				else
				{
					bootbox.alert("Media name update failed");
				}
				
				
			},								
				 
			// other available options: 
			url:       url,         // override for form's 'action' attribute 
			type:      type,        // 'get' or 'post', override for form's 'method' attribute 
			dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
		} 
			$('#frmmedianame').ajaxSubmit(options); 
			// !!! Important !!! 
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		}
}


// function for like Artist
function likeartist(user_id)
{

		$('.cms-bgloader-mask').show();//show loader mask
	 	$('.cms-bgloader').show(); //show loading image
		
		$.ajax({
		type: "POST",
		url: strGlobalSiteBasePath+"/users/likeToartistProcess",
		data:{'artist_id':user_id},
		dataType:  'json',
		cache: false,
		success: function(data)
		{
				var count  = $("#likecount").text();
			 var increment = 1;
			 var likecount=0;
					$('.cms-bgloader-mask').hide();//hide loader mask
					$('.cms-bgloader').hide(); //hide loading image
					//window.location = strGlobalSiteBasePath+"users/artist/"+user_id;
					if(data.status=="like")
					{
						bootbox.alert("Artist liked successfully");
						$("#likebutton").text('Unlike');
						likecount = +count + +increment;
					
						$("#likecount").text(likecount);
						
					}
					else if(data.status=="unlike")
					{
						bootbox.alert("Artist unliked successfully");
						$("#likebutton").text('Like');
								likecount = count-increment;
						$("#likecount").text(likecount);
						
					}
					else
					{
						bootbox.alert("Something wrong happen");
					}
					
		}
		
	});
		


}



// function for follow Artist
function followartist(user_id)
{

		$('.cms-bgloader-mask').show();//show loader mask
	 	$('.cms-bgloader').show(); //show loading image
		
		$.ajax({
		type: "POST",
		url: strGlobalSiteBasePath+"/users/followToartistProcess",
		data:{'artist_id':user_id},
		cache: false,
		dataType:  'json',
		success: function(data)
		{
			 var count  = $("#followercount").text();
			 var increment = 1;
			 var followercount=0;
					$('.cms-bgloader-mask').hide();//hide loader mask
					$('.cms-bgloader').hide(); //hide loading image
					//window.location = strGlobalSiteBasePath+"users/artist/"+user_id;
					if(data.status=="follow")
					{
						bootbox.alert("Artist followed successfully");
						$("#followbutton").text('Unfollow');
						followercount = +count + +increment;
					
						$("#followercount").text(followercount);
						
					}
					else if(data.status=="unfollow")
					{
						bootbox.alert("Artist unfollowed successfully");
						$("#followbutton").text('Follow');
								followercount = count-increment;
						$("#followercount").text(followercount);
						
					}
					else
					{
						bootbox.alert("Something wrong happen");
					}
					
					
		}
		
	});
		

}


// function for like media
function likemedia(usermedia_id)
{

		$('.cms-bgloader-mask').show();//show loader mask
	 	$('.cms-bgloader').show(); //show loading image
		
		$.ajax({
		type: "POST",
		url: strGlobalSiteBasePath+"/users/likeTomediaProcess",
		data:{'usermedia_id':usermedia_id},
		dataType:  'json',
		cache: false,
		success: function(data)
		{
				var count  = $("#likecount").text();
			 var increment = 1;
			 var likecount=0;
					$('.cms-bgloader-mask').hide();//hide loader mask
					$('.cms-bgloader').hide(); //hide loading image
					//window.location = strGlobalSiteBasePath+"users/artist/"+user_id;
					if(data.status=="like")
					{
						bootbox.alert("media liked successfully");
						$("#likemediabutton").text('Unlike');
						
						
					}
					else if(data.status=="unlike")
					{
						bootbox.alert("media unliked successfully");
						$("#likemediabutton").text('Like');
						
					}
					else
					{
						bootbox.alert("Something wrong happen");
					}
					
		}
		
	});
		


}

// function for save comment
function fnsavecomment()
{

var isValidated = jQuery('#frmartistcomment').validationEngine('validate');
	if(isValidated == false)
		{
			return false;
		}
		else
		{
		$('.cms-bgloader-mask').show();//show loader mask
	 	$('.cms-bgloader').show(); //show loading image
		var url = strGlobalSiteBasePath+"users/fnUserCommentProcess";
		var type = "POST";
		var options = { 
		//target:        '#output2',   // target element(s) to be updated with server response 
		success:	function(responseText, statusText, xhr, $form) {
			$('.cms-bgloader-mask').hide();//hide loader mask
			$('.cms-bgloader').hide(); //hide loading image
				if(responseText.status == "success")
				{
					    var username = "";
						var commentid = responseText.mediacomment_id;
						var user_image = responseText.user_image;
						var user_comment = responseText.user_comment;
						var user_fname = responseText.user_fname;
						var user_lname = responseText.user_lname;
						var user_display_name = responseText.user_display_name;
						
						if(user_display_name)
						{
							username = user_display_name;
						}
						else
						{
							username = user_fname + user_lname;
						}
						var hrefuser = responseText.hrefuser;
						$('#commentmodal').modal('hide');
				$( "<div class='media' id='comment"+commentid+"'><a class='media-left' href="+hrefuser+"><img width='28px' height='25px' class='img-circle' src='"+user_image+"' alt='...'></a><div class='media-body'><h4 class='media-text'>"+user_comment+"</h4><p><span class='pull-left'><a href='javascript:void(0);' onclick='return deletecomment("+commentid+");'><i class='fa fa-trash-o'></i></a>&nbsp;<a onclick='return updatecomment("+commentid+");' href='javascript:void(0);'><i class='fa fa-edit'></i></a></span><a href="+hrefuser+"><span class='pull-right'>"+username+" </span></a></p></div></div>" ).insertAfter( "#addcomment" );
							
				$("#txtcomment").val('');
					bootbox.alert("comment added successfully");
				}
				else
				{
					
					  document.getElementById('errormsg').innerHTML="<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a><strong> Error </strong> something wrong happen.</div>";
					  bootbox.alert("comment added failed");
				}
			
			},								
				 
			// other available options: 
			url:       url,         // override for form's 'action' attribute 
			type:      type,        // 'get' or 'post', override for form's 'method' attribute 
			dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
		} 
			$('#frmartistcomment').ajaxSubmit(options); 
			// !!! Important !!! 
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		}


}
// function for save comment
function fnsavecomment2()
{

var isValidated = jQuery('#frmartistcomment2').validationEngine('validate');
	if(isValidated == false)
		{
			return false;
		}
		else
		{
		//$('.cms-bgloader-mask').show();//show loader mask
	 	//$('.cms-bgloader').show(); //show loading image
		var url = strGlobalSiteBasePath+"users/fnUserCommentProcess2";
		var type = "POST";
		var options = { 
		//target:        '#output2',   // target element(s) to be updated with server response 
		success:	function(responseText, statusText, xhr, $form) {
			$('.cms-bgloader-mask').hide();//hide loader mask
			$('.cms-bgloader').hide(); //hide loading image
				if(responseText.status == "success")
				{
					    var username = "";
						var commentid = responseText.mediacomment_id;
						var user_image = responseText.user_image;
						var user_comment = responseText.user_comment;
						var user_fname = responseText.user_fname;
						var user_lname = responseText.user_lname;
						var user_display_name = responseText.user_display_name;
						
						if(user_display_name)
						{
							username = user_display_name;
						}
						else
						{
							username = user_fname + user_lname;
						}
						var hrefuser = responseText.hrefuser;
						//$('#recentCommentmodal').modal('hide');
				$( "<div class='media' id='comment"+commentid+"'><a class='media-left' href="+hrefuser+"><img width='28px' height='25px' class='img-circle' src='"+user_image+"' alt='...'></a><div class='media-body'><h4 class='media-text'>"+user_comment+"</h4><p><span class='pull-left'><a href='javascript:void(0);' onclick='return deletecomment("+commentid+");' style='color:black'><i class='fa fa-trash-o'></i></a>&nbsp;<a onclick='return updatecomment1("+commentid+");' href='javascript:void(0);' style='color:black'><i class='fa fa-edit'></i></a></span><a href="+hrefuser+" style='color:black'><span class='pull-right'>"+username+" </span></a></p></div></div>" ).insertAfter( "#addcomment2" );
							
				$("#txtcomment2").val('');
					bootbox.alert("comment added successfully");
					$('#popup').hide();
				}
				else
				{
					
					  document.getElementById('errormsg').innerHTML="<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a><strong> Error </strong> something wrong happen.</div>";
					  bootbox.alert("comment added failed");
				}
			
			},								
				 
			// other available options: 
			url:       url,         // override for form's 'action' attribute 
			type:      type,        // 'get' or 'post', override for form's 'method' attribute 
			dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
		} 
			$('#frmartistcomment2').ajaxSubmit(options); 
			// !!! Important !!! 
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		}


}
$(".artistmediatitle").on('click',function()
{
   var uploadedmediaid = $(this).attr('id');
	$('.cms-bgloader-mask').show();//show loader mask
	 	$('.cms-bgloader').show(); //show loading image
   	$.ajax({ 
			type: "GET",
			url: strGlobalSiteBasePath+"users/getartistmedia/"+uploadedmediaid,
			dataType: 'json',
			data:"",
			cache:false,
			success: function(data)
			{
			$('.cms-bgloader-mask').hide();//hide loader mask
			$('.cms-bgloader').hide(); //hide loading image
				if(data.status == "success")
				{
							
					$('.tabloader').hide();
					$('.media-details').html(data.content);
					//$('#contact_loaded').val('1');
				}
				else
				{
					bootbox.alert("fail");
				}
			}
	});
});

function fndeletemedia(usermediaid,type)
{
	bootbox.confirm("Are you sure you want to delete the media?", function(confirmed) {
       if(confirmed) {
        	$.ajax({ 
			type: "GET",
			url: strGlobalSiteBasePath+"websites/deleteusermedia/"+usermediaid+"/"+type,
			dataType: 'json',
			data:"",
			cache:false,
			success: function(data)
			{
			
				if(data.status == "success")
				{
						bootbox.alert('media deleted successfully');
					
					$('#media'+usermediaid).hide();
				}
				else
				{
					bootbox.alert("fail");
				}
			}
	});
        }
    });
}
	