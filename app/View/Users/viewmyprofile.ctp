<?php 
echo $this->Html->css('bootstrap-editable');

echo $this->Html->script('bootstrap-editable.min');
echo $this->Html->script('countartist');

echo $this->Html->css('cropper.min');
echo $this->Html->css('main_crop');
echo $this->Html->script('main');
echo $this->Html->script('cropper.min');
?>

<div class="container" id="profilecontent">
<div class="row myprofile">
	<div class="col-md-8">
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
			 $userclass= "style='display:none;'";
		 }
		 else
		 {
			 $title = "USER";
			 $artistclass = "style='display:none;'";
			 $userclass="";
		 }
        
         $profileUrl = Router::url(array('controller'=>'users','action'=>'myprofile'),true);?>

			<h4 class="modal-title"><?php echo $title;?> DETAILS <span class="pull-right"><button class="btn btn-sm btn-danger " style="margin-top:-6px;" onclick="location.href='<?php echo $profileUrl; ?>'"><i class="fa fa-edit"></i> UPDATE </button></span></h4>
		</div>
        <div class="col-md-12 artist-profile">
	 <label>Tagline :&nbsp;</label> <a href="#" id="user_moodmsg" data-type="text"  data-title="Enter username" data-value="<?php echo $moodmsg;?>" ></a>
      </div>
				<div class="col-md-12 artist-profile">
				<div class="col-md-3">Name</div>
				<div class="col-md-3"><?php echo ucfirst($arrUser_Profile['Users']['user_fname'])." ".ucfirst($arrUser_Profile['Users']['user_lname']);?></div>
				<div class="col-md-3">Email </div>
                	<div class="col-md-3"><?php echo $arrUser_Profile['Users']['user_emailid'];?></div>
				</div>
				
					
                <div class="col-md-12 artist-profile">
				<div class="col-md-3"  >Category</div>
				<div class="col-md-3" ><?php
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
				?></div>
				<div class="col-md-3">Mobile Number</div>
				<div class="col-md-3"><?php echo $arrUser_Profile['Users']['user_mobileno'];?></div>
				</div>
                   
                		  <?php
         if($usertype_id==3)
		 {
			?>
				<div class="col-md-12 artist-profile">
			
					<div class="col-md-3"  >Sub-Category</div>
					<div class="col-md-3" >
					<?php
					$count=0;
						foreach($arr_usersubCategory as $usercat)
						{
							$count++;
							$catname	= $usercat['subcat']['subcategory_name'];
							if(count($arr_usersubCategory)==$count)
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
					<div class="col-md-3"  >Subsub-Category</div>
					<div class="col-md-3" >
					<?php
					$count=0;
						foreach($arr_usersubsubCategory as $usercat)
						{
							$count++;
							$catname	= $usercat['subsubcat']['subsubcategory_name'];
							if(count($arr_usersubsubCategory)==$count)
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
									<?php
		}?>
					
				<div class="col-md-12 artist-profile">
					<div class="col-md-3">Age</div>
					<?php 
				
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
						<div class="col-md-3"><?php echo $age;?> </div>
					<div class="col-md-3">Birth date</div>
						<div class="col-md-3"><?php echo $birthdate;?></div>
					</div>
				<div class="col-md-12 artist-profile">
				<div class="col-md-3">Nationality </div>
					<div class="col-md-3"><?php echo $arrUser_Profile['Users']['user_nationality'];?></div>
					<div class="col-md-3">Display Name</div>
					<div class="col-md-3"><?php echo $arrUser_Profile['Users']['user_display_name'];?></div>
				</div>
							<div class="col-md-12 artist-profile">
				<div class="col-md-3">Sex</div>
					<div class="col-md-3"><?php echo ucfirst($arrUser_Profile['Users']['user_sex']);?></div>
					</div>
				<div class="col-md-12 artist-profile">
					<div class="col-md-3">Biography</div>
					<div class="col-md-9"><?php echo $arrUser_Profile['Users']['user_biography'];?></div>
				
				</div>
	 
	 

	</div>

				<div class="col-md-4 profile-image" style="background-color:#f5f3f4;">
				<div class="modal-header">
               <?php  echo "<h4 class='modal-title'>Profile Picture</h4>";?>
			   </div>
				<div class="row text-center">
                <div class="cms-bgloader-mask"></div>
				<div class="cms-bgloader"></div>
                <div  >
                    <div class="col-md-12 fileupload-new" align="center">
                    
                    <?php
						  $userfileimage = $arrUser_Profile['Users']['user_image'];
						 $userfileimagepath = Router::url('/', true).'assets/websiteuser/'.$userfileimage;
						
						if(file_exists("assets/websiteuser/".$userfileimage) && $userfileimage!="")
						{
							$imagepath = $userfileimagepath;
							$id = "imgc";
							
							$cssstyle = "";
						
							?>
							 
							<?php
						}
						else
						{
							$imagepath = Router::url('/', true).'assets/default/user-icon-ap.png';
							$id="";
							$cssstyle = "style='display:none'";
							
						}
						
						
					
						
                   ?>
				   	 <div  id="crop-avatar">
						
    <!-- Current avatar -->
    <div class="avatar-view" >
	<?php echo "<img style='' src='".$imagepath."' id=".$id."  >";?>
     <button class="image-upload" >Change Profile</button>
    </div>

    <!-- Cropping modal -->
    <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form class="avatar-form"  enctype="multipart/form-data" method="post" id="avatarform">
            <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="<?php echo Router::url('/',true)?>images/close-icon.png" width="60" height="50px"></button>
              <h4 class="modal-title" id="avatar-modal-label">Change Profile Picture</h4>
            </div>
            <div class="modal-body">
              <div class="avatar-body">

                <!-- Upload image and data -->
                <div class="avatar-upload">
                  <input class="avatar-src" name="avatar_src" type="hidden">
                  <input class="avatar-data" name="avatar_data" type="hidden">
                  <label for="avatarInput">Upload Picture</label>
                  <input class="avatar-input" id="avatarInput" name="avatar_file" type="file">
                </div>

                <!-- Crop and preview -->
                <div class="row">
                  <div class="col-md-9">
                    <div class="avatar-wrapper"></div>
                  </div>
                  <div class="col-md-3">
                    <div class="avatar-preview preview-lg"></div>
                   
                  </div>
                </div>

                <div class="row avatar-btns">
                  <div class="col-md-9">
                    <div class="btn-group">
                      <button class="btn btn-default" data-method="rotate" data-option="-90" type="button" title="Rotate -90 degrees">Rotate Left</button>
                     
                    </div>
                    <div class="btn-group">
                      <button class="btn btn-default" data-method="rotate" data-option="90" type="button" title="Rotate 90 degrees">Rotate Right</button>
                     
                    </div>
                  </div>
                  <div class="col-md-3">
                    <button class="btn btn-success btn-block avatar-save"  id="updateprofpic"  type="button">Done</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="modal-footer">
              <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
            </div> -->
          </form>
        </div>
      </div>
    </div><!-- /.modal -->

    <!-- Loading state -->
    <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
	</div>

			 
                    </div>
                 
                    
                </div>
				
				<?php
			
				if($current_user['usertype_id']==2)
				{
				 
				?>
				<div class="col-md-4 row text-center follower-mar border-right">
						<div class="col-md-12">
							<?php echo $followerscount; ?>
						</div>
						<div class="col-md-12">
							<ul id="navlist">
								<li><a href="javascript:void(0);" <?php echo $followerscount>0? "onClick= 'return getfollowerslist(".$userid.")'":"";?>>Followers</a>
							
									<ul id="subnavlist">
									<?php 
									
									foreach($followersarray as $followfarray)
									{
										$user_fname = $followfarray['users']['user_fname'];
										$user_lname = $followfarray['users']['user_lname'];
										$user_id = $followfarray['users']['user_id'];
										$usertype_id = $followfarray['users']['usertype_id'];
										$usertypehref = $usertype_id==2?Router::url('/', true).'users/artist/'.$user_id:'javascript:void(0)';

									?>
									<li id="subactive"><a href="<?php echo $usertypehref;?>" ><?php echo $user_fname." ".$user_lname;?></a></li>
									<?php 
									}
									echo $followerscount>count($followersarray)?"<li>and more</li>":'';
									?>
										</ul>
								</li>
							</ul>
						</div>
				</div>
				<div class="col-md-4 row text-center follower-mar border-right">
						<div class="col-md-12">
						
						<?php echo $cntArtistfollowing; ?>
						</div>
						<div class="col-md-12">
							<ul id="navlist">
								<li><a href="javascript:void(0);" <?php echo $cntArtistfollowing>0? "onClick= 'return getfollowinglist(".$userid.")'":"";?>>Following</a>
							
									<ul id="subnavlist">
									<?php 
									
									foreach($arrArtistfollowing as $arrayfollowing)
									{
										$user_fname = $arrayfollowing['users']['user_fname'];
										$user_lname = $arrayfollowing['users']['user_lname'];
										$user_id = $arrayfollowing['users']['user_id'];
										$usertype_id = $arrayfollowing['users']['usertype_id'];
										$usertypehref = $usertype_id==2?Router::url('/', true).'users/artist/'.$user_id:'javascript:void(0)';
									?>
									<li id="subactive"><a href="<?php echo $usertypehref;?>" ><?php echo $user_fname." ".$user_lname;?></a></li>
									<?php 
									}
									echo $cntArtistfollowing>count($arrArtistfollowing)?"<li>and more</li>":'';
									?>
										</ul>
								</li>
							</ul>
						</div>
						</div>
						
						
						
				<div class="col-md-4 row text-center follower-mar">
					<div class="col-md-12">
						<?php echo $likescount; ?>
					</div>
					<div class="col-md-12">
							
							<ul id="navlist">
								<li><a href="javascript:void(0);" <?php echo $likescount>0? "onClick= 'return getlikelist(".$userid.")'":"";?>>Likes</a>
							
									<ul id="subnavlist">
									<?php 
									
									foreach($likesarray as $likeartistarray)
									{
										$user_fname = $likeartistarray['users']['user_fname'];
										$user_lname = $likeartistarray['users']['user_lname'];
										$user_id = $likeartistarray['users']['user_id'];
										$usertype_id = $likeartistarray['users']['usertype_id'];
										$usertypehref = $usertype_id==2?Router::url('/', true).'users/artist/'.$user_id:'javascript:void(0)';
									?>
									<li id="subactive"><a href="<?php echo $usertypehref;?>" ><?php echo $user_fname." ".$user_lname;?></a></li>
									<?php 
									}
									echo $likescount>count($likesarray)?"<li>and more</li>":'';
									?>
										</ul>
								</li>
							</ul>
					
					
					
					</div>
					
					
				</div>
				<?php
				}
				else
				{?>
				<div class="col-md-12" style="margin-top:15px;margin-bottom:15px;">
					<button class="btn btn-file btn-lg btn-block image-upload" type="button" name="updateMembership" id="updateMembership" onclick="return fnBecomeArtist();">Become an Artist</button>
					</div>
					
				<div class="col-md-12">
						<div class="col-md-6">
							<ul id="navlist">
									<li><a href="javascript:void(0);" <?php echo $cntArtistfollowing>0? "onClick= 'return getfollowinglist(".$userid.")'":"";?>>Following</a>
								
												<ul id="subnavlist">
														<?php 
														
														foreach($arrArtistfollowing as $arrayfollowing)
														{
															$user_fname = $arrayfollowing['users']['user_fname'];
															$user_lname = $arrayfollowing['users']['user_lname'];
															$user_id = $arrayfollowing['users']['user_id'];
															$usertype_id = $arrayfollowing['users']['usertype_id'];
															$usertypehref = $usertype_id==2?Router::url('/', true).'users/artist/'.$user_id:'javascript:void(0)';
														?>
														<li id="subactive"><a href="<?php echo $usertypehref;?>" ><?php echo $user_fname." ".$user_lname;?></a></li>
														<?php 
														}
														echo $cntArtistfollowing>count($arrArtistfollowing)?"<li>and more</li>":'';
														?>
												</ul>
									</li>
							</ul>
						</div> 
						
					<div class="col-md-6"><?php echo $cntArtistfollowing; ?>		
						</div> 
				</div>
			
				<?php
				}?>
            
				</div>
				

</div>

<?php
if(count($userdetail)>0)
{?>
<div class="col-md-12 wow fadeInUp voted-artists">
				
				<div class="latest-album">
                        <div class="heading"><h2><span class="color">Voted </span> Artist</h2></div>
                        <div class="minus-margin">
						<?php   
				
				foreach($userdetail as $userdata)
				{
					$userfname = $userdata['users']['user_fname'];
					$userlname = $userdata['users']['user_lname'];
					$userimage = $userdata['users']['user_cropped_image'];
					$user_id = $userdata['users']['user_id'];
					$usertype_id = $userdata['users']['usertype_id'];
					$category_name = $userdata['category']['category_name'];
					
					$usertypehref = $usertype_id==2?Router::url('/', true).'users/artist/'.$user_id:'javascript:void(0)';
						 $userimagepath = Router::url('/', true).'assets/websiteuser/'.$userimage;
						if(file_exists("assets/websiteuser/".$userimage) && $userimage!="")
						{
							$imagepath = $userimagepath;
							$imgstyle='';
						}
						else
						{
							$imagepath = Router::url('/', true).'assets/default/user-icon-ap.png';
							$imgstyle="style='border:1px solid #aaa;background-color:#aaa'";
						}
					?>
                            <article>
                                <figure <?php echo $imgstyle;?>><a href="<?php echo $usertypehref;?>"><img src="<?php echo $imagepath;?>" alt="" height="160px"></a></figure>
                                <div class="text webkit">
                                    <div class="left-sec">
                                        <h3><a href="<?php echo $usertypehref;?>"><?php echo $userfname." ".$userlname;?></a></h3>
                                        <p><?php echo $category_name;?></p>
                                    </div>
                                    
                                </div>
                            </article>
                 <?php
				}?>
                        </div>
                    </div>
		</div>
		<?php
		}?>
	</div>
</div>
<script type="text/javascript" language="javascript">

jQuery(document).ready(function() { 
       //edit form style - popup or inline
        $.fn.editable.defaults.mode = 'inline';
        $('#user_moodmsg').editable({
            validate: function(value) {
                if($.trim(value) == '') 
                    return 'Value is required.';
        },
        type: 'text',
		placeholder:'Whats in your mind!',
        url:strGlobalSiteBasePath+"<?php echo $current_controller;?>/UpdateUserMoodMsg/",
		 title: 'Enter username',
        send:'always',
        ajaxOptions: {
        dataType: 'json'
		
        },
		

	error: function (xhr, status, error) {
					
				   location.reload();
				}
		 })
	 
	 }); 
	 
	 
	

$('#updateprofpic').on('click',function()
	{
			
	var user_id = '<?php  echo $this->Session->read('Auth.WebsitesUser.user_id');?>';
	
	$('.cms-bgloader-mask').show();//show loader mask
	$('.cms-bgloader').show(); //show loading image
	
	var url = strGlobalSiteBasePath+"<?php echo $current_controller;?>/UpdateWebsiteProfpic/"+user_id+"/";
		
		var type = "POST";
		
		var options = { 
		//target:        '#output2',   // target element(s) to be updated with server response 
		success:	function(responseText, statusText, xhr, $form) {
			
				$('.cms-bgloader-mask').hide();//show loader mask
				$('.cms-bgloader').hide(); //show loading image
				if(responseText.status="success")
				{
					
					$("#avatar-modal").modal('hide');
					window.location.reload();
				
						
					
				}
				
			},	
			// other available options: 
			url:       url,         // override for form's 'action' attribute 
			type:      type,        // 'get' or 'post', override for form's 'method' attribute 
			 dataType:  'json'    // 'xml', 'script', or 'json' (expected server response type) 
		} 
			$('#avatarform').ajaxSubmit(options); 
			// !!! Important !!! 
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		
		});
	
	
</script>
<?php echo $this->element('changepass');?>
<?php echo $this->element('followermodel'); ?>
<?php echo $this->element('followingmodel'); ?>
<?php echo $this->element('likemodel'); ?>
<?php echo $this->element('becomeartmodal'); ?>

