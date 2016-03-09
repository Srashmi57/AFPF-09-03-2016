<script>
setCookie('currentaudio', '', 1);
console.log("Setting Cookies : currentaudio = " );
</script>
<script>jwplayer.key="O+FYs7sL4MmPQTrTnzu4GnKoKGao3KAW+AQ/PA==";</script>
<?php echo $this->Html->css('bootstrap-fileupload');
echo $this->Html->script('bootstrap-fileupload');
echo $this->Html->css('bootstrap-editable');
echo $this->Html->script('bootstrap-editable.min');
echo $this->Html->script('jwplayer');
echo $this->Html->css('jRating.jquery');
echo $this->Html->script('jRating.jquery');
echo $this->Html->script('common'); 
echo $this->Html->script('readmore.min');
echo $this->Html->css('common');
echo $this->Html->script('countartist');
$isloggedclass = $islogin>0?'':"disabled='disabled'";
echo $this->Html->script('countartist');
?>

<div class="content art_bg" id="maincontent" style="min-height: 400px;">

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="margin-top:25px;">
	<div class="col-md-12">
	<div class="panel panel-default">
		<div class="modal-header">
        
        <?php $usertype_id = $arrUser_Profile['Users']['usertype_id'];
		if(trim($arrUser_Profile['Users']['user_moodmsg'])!='')
		{
			$moodmsg = $arrUser_Profile['Users']['user_moodmsg'];
		}
		else
		{
			$moodmsg = 'Enter mood message';
		}
		?>
        <?php
         if($usertype_id==2)
		 {
			 $title= "ARTIST";
			 $artistclass = "";
			  if(count($averagemedia)>0)
				{
				  foreach($averagemedia as $avgmedia)
					{
					  $finalrate007 += round($avgmedia[0]['totalrating']);
					  
					}
				}else{
					$finalrate007 = 0;
				}
		 }
		 else
		 {
			 $title = "USER";
			 //$artistclass = "style='display:none;'";
			 $artistclass = "";
		 }
       
         $profileUrl = Router::url(array('controller'=>'users','action'=>'myprofile'),true);?>
			
			<h4 class="modal-title"><?php echo $title;?> DETAILS </h4>
		</div>
		
 <div class="userinfo">
		
						<div class="col-md-6 artist-detail-maim">
                 <form name="frmwebuserprofpic" id="frmwebuserprofpic" method="post">
				<div class="row text-center">
                
                <div class="fileupload fileupload-new col-md-4" data-provides="fileupload">
                    <div class="fileupload-new ">
                    
                    <?php
						  $userfileimage = $arrUser_Profile['Users']['user_image'];
						 $userfileimagepath = Router::url('/', true).'assets/websiteuser/'.$userfileimage;
						if(file_exists("assets/websiteuser/".$userfileimage) && $userfileimage!="")
						{
							$imagepath = $userfileimagepath;
						}
						else
						{
							$imagepath = Router::url('/', true).'assets/default/user-icon-ap.png';
						}
                   ?>
                   <img src="<?php echo $imagepath;?>" height="170" width="170" />
				     <?php 
		
		if(trim($arrUser_Profile['Users']['user_moodmsg'])!='')
		{
		 $moodmsg = $arrUser_Profile['Users']['user_moodmsg'];?>
		 
		 <?php
		}
		else
		{
			echo $moodmsg = '';
		}
		?>
                    </div>
                 
                </div>
			<div class="cms-bgloader-mask"></div>
			<div class="cms-bgloader"></div>
			
				<div class="col-md-8 follower-top-margin">
				
				<div class="col-md-<?php if($title=='USER'){?>5<?php }else{?>4<?php }?> row text-center follower-mar border-right ">
						<div class="col-md-12" id="followercount">
							<?php echo $followerscount; ?>
						</div>
						<div class="col-md-12">
							<ul id="navlist">
								<li><a href="javascript:void(0);"  id="listfollower"   <?php echo $followerscount>0? "onClick= 'return getfollowerslist(".$userid.")'":"";?>>Followers</a>
							
									<ul id="subnavlist">
									<?php 
									
									foreach($followersarray as $followfarray)
									{
										$user_fname = $followfarray['users']['user_fname'];
										$user_display_name = $followfarray['users']['user_display_name'];
										$user_lname = $followfarray['users']['user_lname'];
										if($user_display_name!="")
										{
											$username = $user_display_name;
										}
										else
										{
											$username = $user_fname." ".$user_lname;
										}
										$user_id = $followfarray['users']['user_id'];
										$usertype_id = $followfarray['users']['usertype_id'];
										$usertypehref = $usertype_id==2?Router::url('/', true).'users/artist/'.$user_id:'javascript:void(0)';
									?>
									<li id="subactive"><a href="<?php echo $usertypehref;?>" ><?php echo $username;?></a></li>
									<?php 
									}
									echo $followerscount>count($followersarray)?"<li>and more</li>":'';
									?>
										</ul>
								</li>
							</ul>
						</div>
				</div>
				<div <?php if($title=='USER'){?>class="col-md-5 row text-center follower-mar "<?php }else{?>class="col-md-4 row text-center follower-mar border-right"<?php } ?>>
						<div class="col-md-12" id="followercount">
							 <?php echo $cntArtistfollowing; ?>
						</div>
						<div class="col-md-12">
							<ul id="navlist">
								<li><a href="javascript:void(0);" <?php echo $cntArtistfollowing>0? "onClick= 'return getfollowinglist(".$userid.")'":"";?>>Following </a>
							
									<ul id="subnavlist">
									<?php 
									
									foreach($arrArtistfollowing as $arrayfollowing)
									{
										$user_fname = $arrayfollowing['users']['user_fname'];
										$user_lname = $arrayfollowing['users']['user_lname'];
										$user_display_name = $followfarray['users']['user_display_name'];
										if($user_display_name!="")
										{
											$username = $user_display_name;
										}
										else
										{
											$username = $user_fname." ".$user_lname;
										}
										$user_id = $arrayfollowing['users']['user_id'];
										$usertype_id = $arrayfollowing['users']['usertype_id'];
										$usertypehref = $usertype_id==2?Router::url('/', true).'users/artist/'.$user_id:'javascript:void(0)';
									?>
									<li id="subactive"><a href="<?php echo $usertypehref;?>" ><?php echo $username;?></a></li>
									<?php 
									}
									echo $cntArtistfollowing>count($arrArtistfollowing)?"<li>and more</li>":'';
									?>
										</ul>
								</li>
							</ul>
						</div>
						</div>
						
						
				<?php if($title=='ARTIST'){?>		
				  <div class="col-md-4 row text-center follower-mar ">
						<div class="col-md-12" id="followercount">
									 <?php 
									 //echo $likescount; 
									 echo $finalrate007;
									 ?>
								</div>
					<div class="col-md-12 total_likes_padding">
							
							<ul id="navlist">
								<li>
								<!-- <a href="javascript:void(0);" <?php echo $likescount>0? "onClick= 'return getlikelist(".$userid.")'":"";?>></a> --> Total votes
							
									<!-- <ul id="subnavlist">
									<?php 
									
									foreach($likesarray as $likeartistarray)
									{
										$user_fname = $likeartistarray['users']['user_fname'];
										$user_lname = $likeartistarray['users']['user_lname'];
										$user_display_name = $followfarray['users']['user_display_name'];
										if($user_display_name!="")
										{
											$username = $user_display_name;
										}
										else
										{
											$username = $user_fname." ".$user_lname;
										}
										$user_id = $likeartistarray['users']['user_id'];
										$usertype_id = $likeartistarray['users']['usertype_id'];
										$usertypehref = $usertype_id==2?Router::url('/', true).'users/artist/'.$user_id:'javascript:void(0)';
									?>
									<li id="subactive"><a href="<?php echo $usertypehref;?>" ><?php echo $username;?></a></li>
									<?php 
									}
									echo $likescount>count($likesarray)?"<li>and more</li>":'';
									?>
										</ul> -->
								</li>
							</ul>
					
					
					
					</div>
					
					
				</div>
				<?php } ?>
				
				</div>
				
             </form>
	</div>
			<div class="col-md-12 moodmessage"><label>Tagline :&nbsp;</label> <?php echo $arrUser_Profile['Users']['user_moodmsg']; ?></div>


</div>


		
	<div class="col-md-6 artist-detail-maim">
		
        <div class="artist-detail-bg">
      
        <?php
         
        
         $profileUrl = Router::url(array('controller'=>'users','action'=>'myprofile'),true);?>
			
		
		
      
				<div class="col-md-12 artist-profile">
				<div class="col-md-3">Name</div>
				<div class="col-md-6"><?php echo ucfirst($arrUser_Profile['Users']['user_fname']);?> <?php echo ucfirst($arrUser_Profile['Users']['user_lname']);?></div>
				<div class="col-md-3 edit_button"><a href="<?php echo $profileUrl;?>"><i class="fa fa-edit"></i> Edit profile</a></div>
				</div>
			
                
                <div class="col-md-12 artist-profile" <?php echo $artistclass; ?>>
				<div class="col-md-3">Category</div>
				<div class="col-md-7">
				<?php
				$count=0;
				foreach($arr_userCategory as $usercat)
				{
					$count++;
					$catname	= $usercat['cat']['category_name'];
					if(count($arr_userCategory)==$count)
					{
						$catname = $catname.". ";
					}
					else
					{	$catname = $catname.", ";
						
					}
					echo $catname;
				}
				?>
				</div>
				
                  </div>
                
				<div class="col-md-12 artist-profile">
				<div class="col-md-3">Age</div>
				<div class="col-md-3">	<?php 
				
					if($arrUser_Profile['Users']['user_birth']=="0000-00-00")
					{
						$age = "";
						$birthdate="";
						
					}
					else
					{
						$now = date('Y-m-d H:i:s');
						
						$age	= $this->Caldays->GetUserAge($now,$arrUser_Profile['Users']['user_birth']);
						
						$birthdate = date('d M Y',strtotime($arrUser_Profile['Users']['user_birth']));
					}
						
					?>
					<?php echo $age;?></div>
				<div class="col-md-3">Sex : <?php echo ucfirst($arrUser_Profile['Users']['user_sex']);?></div>
				<!-- <div class="col-md-3"><?php echo ucfirst($arrUser_Profile['Users']['user_sex']);?></div> -->
				</div>
				<div class="col-md-12 col-md-12 artist-profile artist-profile-last" >
				<div class="col-md-3">Biography</div>
				<div class="col-md-9"><span class="more"><?php echo $arrUser_Profile['Users']['user_biography'];?></span></div>
				
				</div>
	 
		</div>
	</div>

	<div class="clear"></div>
	</div>
	</div>
</div>
</div>
<div class="clear"></div>
<?php
if($arrUser_Profile['Users']['usertype_id']==2)
{ 
?>
<div class="artistupload wow fadeInUp col-md-12">

<?php
if(count($uploadedmediadata)>0)
		{?>
<div class="col-md-4 top-performer">
				<div class="artist-chart">
					<span class="performer-icon">
                 	  Artist Chart
					  <span class="top-performer-icon-new">
                   	 <img src="<?php echo Router::url('/',true)?>images/performer1_new.png"/></span>
					 </span>
				</div>
				<div class="related_uploads_scroller">
                 <?php 
					 $count=0;
					$retmediarating=0;
						$mediarating_id=0;
			
					 foreach($uploadedmediadata as $mediadata)
					 {
					 
					  $usermedia_id = $mediadata['UserMedia']['usermedia_id'];
					  $usermedia_path = Router::url('/', true).$mediadata['UserMedia']['usermedia_path'];
					  $usermedia_title = $mediadata['UserMedia']['usermedia_title'];
					  $usermedia_name = $mediadata['UserMedia']['usermedia_name'];
					  $usermedia_type = $mediadata['UserMedia']['usermedia_type'];
					  $arraymediatype = explode('/',$usermedia_type);
					  $retuser_id = $mediadata['UserMedia']['user_id'];
					  $category_image = $mediadata['cat']['category_image'];
					  $category_name = $mediadata['cat']['category_name'];

						//media rating 
					 $mediadata['0']['avgrate'];
						
						$count++;
						$retmediarating=0;
						if(count($mediadata['children'])>0)
						{
										
							$retmediarating = $mediadata['children']['0']['media_rating'];
							$retmediarating = $retmediarating>0?$retmediarating:0;
							$mediarating_id = $mediadata['children']['MediaRating']['mediarating_id'];
						}
						
						if(($islogin>0)&&($retuser_id==$islogin))
						{
							$isDisabled=1;
							$votedisable='true';
						}
						else if(($islogin>0)&&$retmediarating>0)
						{
							$isDisabled=1;
							$votedisable=false;
						}
						else if($islogin>0)
						{
							$votedisable=false;
						}
						else
						{
							$isDisabled=1;
							$votedisable=false;
						}
						
							//$finalrate = round($mediadata[0]['avgrate']*70);
						    $finalrate = round($mediadata[0]['totalrating']);
						
					?>
						
						  <div class="performer-info">
						 
							  <div class="col-md-1 playtext">
							 
							   <?php echo $count;?>
							
								 </div>
								 <div class="col-md-4 infotext">
								 <div class="col-md-9">
								 
								 <div class="row">
												<a class="artistmediatitle" onClick="return fnartistmediatitle(<?php echo $usermedia_id;?>);" id="<?php echo mb_strimwidth($usermedia_id,0, 12, "..");?>" style="text-align: left;"><?php echo $usermedia_name;?></a>
												</div> 
												
												<div class="row artistname">
												<?php 
												$user_display_name = $this->Session->read('Auth.WebsitesUser.user_display_name');
				
												if($user_display_name!="")
												{
													$username = $user_display_name;
												}
												else
												{
													$userfname = $this->Session->read('Auth.WebsitesUser.userfname');
													$user_lname = $this->Session->read('Auth.WebsitesUser.user_lname');
													$username = $userfname." ".$user_lname;
												}
												?>
												<a class="artistmediatitle" onClick="return fnartistmediatitle(<?php echo $usermedia_id;?>);" id="<?php echo  $usermedia_id;?>" style="text-align: left;"><?php 
												
													echo mb_strimwidth($username,0, 12, "..");
																						
												?></a> 
												</div>
										
									</div>
								
								</div>
								<div class="col-md-2 likes_count">
								<span class="glyphicon glyphicon-heart"></span>
								<div class="count"><?php echo $finalrate;?></div>
								</div>
								<div class="col-md-2 topperformer_play">
								<?php 
								$arraymediatype = explode('/',$usermedia_type);
								$currentmediaType = $arraymediatype[0];
								if($currentmediaType=="video"||$currentmediaType=="audio")
								{
								   $class="playpauseaudio";
								}
								else
								{
									$class="mediatitle";
								}
								
								?>
								<a class="<?php echo $class?>" play="0" id="<?php echo  $usermedia_id;?>" ><img class="playpauseimg<?php echo  $usermedia_id;?>" src="<?php echo Router::url('/',true)?>images/play_new.png"/></a>
								</div>
								<div class="col-md-2 top_info">
											<img src="<?php echo Router::url('/',true)."assets/category/".$category_image;?>" height="60px" width="60px;"/>
											<span class="figcaption"><?php echo $category_name;?></span>
								</div>
							 </div>
							
							
						 
						   <?php 
						   }?>
                         
                 	 </div>
					 </div>
					

	<?php
		}
		else{
			?>
			<!-- <div class="upload_message">
				<p>Please upload media file to view Artist details.</p>
			</div> -->
			
			<?php
		}
		
		?>	
		<?php
if(count($artistmediaDetails)>0)
		{?>

	<div class="col-md-8 media-details">
	
		<?php 

			echo $this->element('view_artist_details'); 
			
		?>
			
		
	</div>
	<?php
	}?>
 </div>
<?php } ?>
 </div>
 			<script>
			 function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
	console.log(getCookie("currentaudio"));
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}

</script>
 </div>	

     <div class="recentupload wow fadeInUp">
	<p>RECENT UPLOADS</p>
</div>
 <div class="recentgallery">
			
			 <ul class="thumbnails" > 
			 <?php 
			 
			  if($title=='USER'){
			   echo $this->element('recentuploadsmypage');
			 }else{
			   echo $this->element('recentuploads');
			 }
			 
			 ?>
			 </ul>
			</div>				 




<script type="text/javascript">
$(document).ready(function() {
    // Configure/customize these variables.
    var showChar = 120; // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Show more";
    var lesstext = "Show less";
    

    $('.more').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
 
            $(this).html(html);
        }
 
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});
function fnartistmediatitle(uploadedmediaid)
{
   
   $('.cms-bgloader-mask').show();//show loader mask
	  $('.cms-bgloader').show(); //show loading image
   	$.ajax({ 
			type: "GET",
			url: strGlobalSiteBasePath+"users/getartistmedia/"+uploadedmediaid+"/<?php echo $showedit;?>",
			dataType: 'json',
			data:"",
			cache:false,
			success: function(data)
			{
			 $('.cms-bgloader-mask').hide();//show loader mask
	  $('.cms-bgloader').hide(); //show loading image
				if(data.status == "success")
				{
			
					
					$('.tabloader').hide();
					$('.media-details').html(data.content);
					//$('#contact_loaded').val('1');
				}
				else
				{
					alert("fail");
				}
			}
	});
}

$(".playpauseaudio").on('click',function()
{
   var uploadedmediaid = $(this).attr('id');
   var fileplaying = 'mediaaudio'+uploadedmediaid;
  
			var isplaying = $(this).attr('play');
			//alert(isplaying);
				if(isplaying==1)
				{
					var audioFile = getCookie("currentaudio");
					//alert(audioFile);
					 if (audioFile != "" ) {
						 // alert('yes pause previous');
						
									jwplayer(audioFile).pause(true);
						$('.playpauseaudio').attr('play','0');
						$('.playpauseaudio img').attr('src','<?php echo Router::url('/',true)?>images/play_new.png');
						 $(this).attr( 'play','2');
						 $('.playpauseimg'+uploadedmediaid).attr('src','<?php echo Router::url('/',true)?>images/play_new.png');
						  //alert('paused');
					  }
					  else
					  {
					    isplaying=0;
					  }
					
				}
				if(isplaying==2)
				{
					var audioFile = getCookie("currentaudio");
					 if (audioFile != "" ) {
						 // alert('yes pause previous');
						
									jwplayer(audioFile).play(true);
									$('.playpauseaudio').attr('play','0');
						$('.playpauseaudio img').attr('src','<?php echo Router::url('/',true)?>images/play_new.png');
						 $(this).attr( 'play','1');
						 $('.playpauseimg'+uploadedmediaid).attr('src','<?php echo Router::url('/',true)?>images/pause_new.png');
						  //alert('paused');
					  }
					  else
					  {
					    isplaying=0;
					  }
					  
				}
				 if(isplaying==0)
				{
				$('.playpauseaudio').attr('play','0');
						$('.playpauseaudio img').attr('src','<?php echo Router::url('/',true)?>images/play_new.png');
					$(this).attr( 'play','1');
					$('.playpauseimg'+uploadedmediaid).attr('src','<?php echo Router::url('/',true)?>images/pause_new.png');
							$(".gallry-details").html("");
				$('.performer-info').removeClass('active');
				$(this).parents('.performer-info').addClass('active');
				
				$('.cms-bgloader-mask').show();//show loader mask
				  $('.cms-bgloader').show(); //show loading image
				$.ajax({ 
						type: "GET",
						url: strGlobalSiteBasePath+"users/getartistmedia/"+uploadedmediaid+"/<?php echo $showedit;?>",
						dataType: 'json',
						data:"",
						cache:false,
						success: function(data)
						{
						
							if(data.status == "success")
							{
							
								$('.media-details').html(data.content);
								//$('#contact_loaded').val('1');
								$('.cms-bgloader-mask').hide();//show loader mask
								$('.cms-bgloader').hide(); //show loading image
								
							}
							else
							{
								alert("fail");
							}
						}
				});
			}
});


$(".mediatitle").on('click',function()
{
   var uploadedmediaid = $(this).attr('id');
   	$(".gallry-details").html("");
    $('.performer-info').removeClass('active');
	$(this).parents('.performer-info').addClass('active');
	
	$('.cms-bgloader-mask').show();//show loader mask
	  $('.cms-bgloader').show(); //show loading image
   	$.ajax({ 
			type: "GET",
			url: strGlobalSiteBasePath+"users/getartistmedia/"+uploadedmediaid+"/<?php echo $showedit;?>",
			dataType: 'json',
			data:"",
			cache:false,
			success: function(data)
			{
			
				if(data.status == "success")
				{
				
					$('.media-details').html(data.content);
					//$('#contact_loaded').val('1');
					$('.cms-bgloader-mask').hide();//show loader mask
				$('.cms-bgloader').hide(); //show loading image
					
				}
				else
				{
					alert("fail");
				}
			}
	});
});


function fnaddComment(user_mediaid)
{
	$('.cms-bgloader-mask').hide();//show loader mask
	  $('.cms-bgloader').hide(); //show loading image
	$.ajax({ 
			type: "GET",
			url: strGlobalSiteBasePath+"users/getartistmedianame/"+user_mediaid,
			dataType: 'json',
			data:"",
			cache:false,
			success: function(data)
			{
				 $('.cms-bgloader-mask').hide();//show loader mask
	  $('.cms-bgloader').hide(); //show loading image
				if(data.status == "success")
				{
				
			
					$("#artistmediatitle").text(data.content);
					$("#usermediaid").val(user_mediaid);
					$("#txtcomment").val('');
					$("#commentmodal").modal('show');
				}
				else
				{
					alert("fail");
				}
			}
	});
	

}

</script>

<?php echo $this->element('changepass');?>
<?php echo $this->element('commentmodal');?>
<?php 
 echo $this->Html->script('modal'); 
?>

<?php echo $this->element('followermodel'); ?>
<?php echo $this->element('followingmodel'); ?>
<?php echo $this->element('likemodel'); ?>
<?php echo $this->element('updatecommentmodal'); ?>
<?php echo $this->element('medianame'); ?>