<style type="text/css">
#addcomment2{margin-top:0% !important;}
</style>
<script>jwplayer.key="O+FYs7sL4MmPQTrTnzu4GnKoKGao3KAW+AQ/PA==";</script> 
							<?php 
							$count=0;
					
					
								$isloggedclass = $islogin>0?'':"disabled='disabled'";
									 if(isset($artistmediaDetails['subcat']['category_name']))
										{
											$category_name = $artistmediaDetails['subcat']['category_name'];
										
										}
										else if(isset($artistmediaDetails['subsubcat']['category_name']))
										{
											$category_name = $artistmediaDetails['subsubcat']['category_name'];
										}
										else
										{
											$category_name = $artistmediaDetails['cat']['category_name'];
										}
										$cmtclass = $islogin>0?'':"display:none";
										$retuser_id = $artistmediaDetails['UserMedia']['user_id'];
										if($retuser_id==$islogin)
										{
										  $likedisable="style='display:none;'";
										}
										else
										{
										$likedisable="";
										}
								
									
									if(($islogin>0)&&($retuser_id==$islogin))
						{
							$isDisabled=1;
							
							$votedisable='true';
						}
						else if(($islogin>0)&&$viewmediarateing>0)
						{
							$isDisabled=1;
							$votedisable=false;
						}
						else if($islogin>0)
						{
							$isDisabled=0;
							$votedisable=false;
						}
						else
						{
							$isDisabled=1;
							$votedisable='true';
						}
						
										?>
				 <div class="cms-bgloader-mask"></div>
				<div class="cms-bgloader"></div>
                    <div class="col-md-12" style="padding:0px">
                                <div id="video-tag" style="width: 100%;margin: 0 auto;display: none;">
								
																	<?php 
					$flashplayerpath = Router::url('/', true)."js/jwplayer/player.swf";
?>	
                                  	 <?php //echo $artistmediaDetails['UserMedia']['usermedia_name'];?> <?php //echo $category_name;?>
									 <div style="position: absolute !important;right: 14px;top: 250px;">
									 	<div id="jRate_viewindexs<?php echo $usermedia_id;?>" <?php echo $isloggedclass; ?> data-average="<?php echo $viewmediarateing;?>" data-id="<?php echo $viewmediarateid;?>" class="jRate_viewindex">
									 
					<script type="text/javascript">
								var umid =  <?php echo $usermedia_id?>;
								var login = <?php echo $islogin>0?1:0?>;
									 if(login==0)
											{
												$("#jRate_viewindexs<?php echo $usermedia_id;?>").jRating({
												  step:false,
												  length : 5,
												  nbRates : 3,
												   bigStarsPath:'<?php echo Router::url('/',true);?>icons/whitestar.png',
												  showRateInfo:false,
													canRateAgain : false,
													onClick : function(element,rate) {
													bootbox.alert('Please login to do rate');
													}	
														});
											}
											else
											{
											
											$("#jRate_viewindexs<?php echo $usermedia_id;?>").jRating({
													  step:true,
													  length : 5,
													  phpPath:'<?php echo Router::url('/',true);?>users/saveuserrating/'+umid,
													  nbRates : 3,
													  sendRequest:false,
													   bigStarsPath:'<?php echo Router::url('/',true);?>icons/whitestar.png',
													  showRateInfo:false,
													  canRateAgain : true,
													  isDisabled:'<?php echo $votedisable;?>',
													  onClick:function(element,rate){
													
													 	
													var isDisabled  = <?php echo $isDisabled?>;
													 
													if(isDisabled>0)
													{
													
													bootbox.confirm("New vote will outcast their earlier vote?", function(result) {
													
													if(result){
													$.ajax({
															url: '<?php echo Router::url('/',true);?>users/saveuserrating/<?php echo $usermedia_id;?>',
															type: 'post',
															 data: {'rate': rate},
															 dataType:'json',
															success: function (data) {
															bootbox.alert(data.message)
															}
														});
													}
												}); 
													}
													else
													{
													
													$.ajax({
															url: '<?php echo Router::url('/',true);?>users/saveuserrating/<?php echo $usermedia_id;?>',
															type: 'post',
															 data: {'rate': rate},
															 dataType:'json',
															success: function (data) {
															bootbox.alert(data.message)
															}
														});
													}									
																							 
													  },
														onSuccess : function(data){
													  
															alert(data.message)
														  },
														  onError : function(){
															alert('Error : please retry');
														  }
													});
							
									}
									
				</script>
				
                            	 </div></div>
								
								 
								 <?php 
								  $usermedia_type = $artistmediaDetails['UserMedia']['usermedia_type'];
								  $vid_thumbnail_path = Router::url('/', true).$artistmediaDetails['UserMedia']['video_thumbnail'];
								$user_id = $artistmediaDetails['UserMedia']['user_id'];
								$retcover_id = $artistmediaDetails['UserMedia']['cover_id'];
									if($retcover_id>0)
									{
										$imageusermedia_path = Router::url('/', true).$artistmediaDetails['usermedia_cover']['usermedia_path'];
										$thumbnail_path = Router::url('/', true)."files/large/".$user_id."/".$artistmediaDetails['usermedia_cover']['usermedia_title'];
										$imagepath = $thumbnail_path;
										$pdfdefault = $thumbnail_path;
										$worddefault = $thumbnail_path;
										$vid_thumbnail_path = $thumbnail_path;
										$imageusermedia_path = $thumbnail_path;
									}
									else
									{
										$thumbnail_path = Router::url('/', true)."files/large/".$user_id."/".$artistmediaDetails['UserMedia']['usermedia_title'];
										$imagepath = Router::url('/', true)."assets/default/".lcfirst($category_name)."_default_new.jpg";
										$pdfdefault = Router::url('/', true)."assets/default/".lcfirst($category_name)."_default_new.jpg";
										$worddefault = Router::url('/', true)."assets/default/".lcfirst($category_name)."_default_new.jpg";
										$imageusermedia_path = Router::url('/', true).$artistmediaDetails['UserMedia']['usermedia_path'];
									}
								
								 $arraymediatype = explode('/',$usermedia_type);
								 
								 $ext = pathinfo($artistmediaDetails['UserMedia']['usermedia_title'], PATHINFO_EXTENSION);
								$audioextarray = array('mp3','wav','aiff','flac','MP3','WAV','AIFF','FLAC','m4a','M4A','f4a','F4A','aac','AAC','ogg','OGG','oga','OGA');
								$videoextarray = array('mp4','wav','mkv','flv','WAV','avi','3gp','MP4','MKV','FLV','AVI','3GP','mov','MOV','m4v','f4v','M4V','F4V','WebM','webm');
							$imageextarray = array('jpeg','jpg','png','JPEG','JPG','PNG','gif','GIF');
							$pdfarray = array('pdf','PDF');
							$docxarray = array('docx','doc','DOCX','DOC');
								if (in_array($ext, $audioextarray))
								{
								   $mediatype = 'audio';
								}
								else if (in_array($ext, $videoextarray))
								{
								   $mediatype = 'video';
								}
								else if (in_array($ext, $imageextarray))
								{
								   $mediatype = 'image';
								}
								else if (in_array($ext, $pdfarray))
								{
								   $mediatype = 'pdf';
								}
								else if (in_array($ext, $docxarray))
								{
								   $mediatype = 'word';
								}
									
								switch($mediatype)
								{
								case "image":
								?>  
                      			
								 <!-- <a  rel="lightbox[group]" href="<?php echo $imageusermedia_path;?>"><img class="group1" src="<?php echo $imageusermedia_path;?>" title="Image Title" style="height:210px;width:100%;" /></a> -->
								<?php
								break;
								 
								case "pdf":  
									$url = Router::url('/', true).'websites/pdfReader/'.$usermedia_id;
									?>
									
										<a href="<?php echo $url;?>"  target="_blank"><img src="<?php echo $pdfdefault;?>" style="height:210px;width:100%;" /></a> 
										
									<?php	
								break;
									 
								case "word":  
								?>
								<!-- <a target="_blank" href="http://docs.google.com/viewer?url=<?php echo Router::url('/',true).$artistmediaDetails['UserMedia']['usermedia_path'];?>"  ><img src="<?php echo $worddefault;?>"  style="height:210px;width:100%;"/></a> -->
									<?php
							
								break;
								case "audio": 
								case "video":
									$randnumber = rand();
									if($mediatype=="video")
									{
												$imagepath=$vid_thumbnail_path;
									}
					?>	
				<div id='mediaaudio<?php echo $randnumber?>' style="position: relative; height: 170px;">Loading the player...</div>	

					<script type='text/javascript'>
					playerInstance5 = jwplayer('mediaaudio<?php echo $randnumber?>');
					playerInstance5.setup({
					  flashplayer: '<?php echo $flashplayerpath;?>',
					  file:'<?php echo Router::url('/',true).$artistmediaDetails['UserMedia']['usermedia_path'];?>',
					  height: 210,
					  width:'100%',
					   autostart: true,
					  image:'<?php echo $imagepath;?>',
					  class:'thumbnail',
					   hide: true,
					  'plugins': { 'viral-2': {'oncomplete':'False','onpause':'False','functions':'All'} }
					   });
					   
					    playerInstance5.onPlay(function(e) {
					//alert('<?php echo $randnumber;?>');		
					 var audioFile = getCookie("currentaudio");
					 //alert(audioFile);
					  if (audioFile != "" && audioFile !='mediaaudio<?php echo $randnumber;?>') {
						 // alert('yes pause previous');
						
									jwplayer(audioFile).pause(true);
						 
						  //alert('paused');
					  }
							//document.cookie = 'currentaudio=; expires=Thu, 01 Jan 1970 00:00:00 UTC;';	
							//setCookie("currentaudio", "<?php echo $randnumber;?>", 365);
							var cookieVal='mediaaudio<?php print($randnumber);?>';
							setCookie('currentaudio', cookieVal, 1);
							console.log("Setting Cookies : currentaudio = <?php echo $randnumber;?>" );
					});		
					   

					</script>						
				<?php
					break;
						
							}
							?>
                    </div>
                            <div class="comment-section">
							   <div class="media">
                                		<div class="media-body" style="margin-top: -4%;">
										<?php if($retuser_id==$islogin){?>
										<!-- <center><h4 style="margin-top: 4%;">You can't comment to your artwork</h4></center> -->
										<?php } ?>
										<!-- <a  style="float:left" href="javascript:void(0);" <?php if( $islogin>0){ echo "style='cursor:none;'";} ?> onclick="<?php echo $islogin>0?'javascript:void(0);':"bootbox.alert('You need to login, to give comment');"?>" >
										<img src="<?php echo Router::url('/',true)?>images/chat-icon.png" alt="..." ></a>
										<h4 class="media-heading">Comments -->
												<!-- <div class="likemedia_new" <?php echo $likedisable;?> >
						<button   onclick="<?php echo $islogin>0?'return likemedia('.$usermedia_id.');':"bootbox.alert('Please Login to do like');"?>" type="button" class="btn" > <span class="glyphicon glyphicon-thumbs-up"></span> <span id="likemediabutton"> <?php echo $mediatext;?></span></button>
						
												</div> -->
												</h4>
												
                                	</div>
									 	<?php 
										//if($retuser_id!=$islogin)
										if($islogin>0)
									{
									
									?>
							<div class="media row" id="addcomment2" style="<?php echo $cmtclass;?>">
						 <form name="frmartistcomment2" id="frmartistcomment2" method="post">

												<div class="form-group">
												
												<div class="col-sm-12">
											<textarea name="txtcomment2" id="txtcomment2" class="form-control validate[required]" rows="6"></textarea>
											<input type="hidden" name="usermediaid2" id="usermediaid" value="<?php echo $usermedia_id?>"/>
												</div> 
												</div>
										
							<div class="col-md-3 pull-right" style="margin-right:5%;text-align: right;">
							
							  
											  <button type="submit" class="btn btn-success" onclick="return fnsavecomment2();" id="addItem">SUBMIT</button>
								 
							
					  </div>	
					 </form>
					 </div>
					 <?php
					 }
					 elseif(!$islogin>0)
			{
			  echo "<p>Please login to do comments</p>";
			}?>
                                </div>
                              <?php
							 
	foreach($arrUserComments as $usercomments)
	{
	$usercomment = $usercomments['MediaComment']['usermedia_comment'];
	$mediacomment_id = $usercomments['MediaComment']['mediacomment_id'];
	$userfname = $usercomments['Users']['user_fname'];
	$userlname = $usercomments['Users']['user_lname'];
	 $user_image = $usercomments['Users']['user_cropped_image'];
	 $user_display_name = $usercomments['Users']['user_display_name'];
	 if($user_display_name!="")
	 {
		$displayname = $usercomments['Users']['user_display_name'];
	 }
	 else
	 {
		$displayname =  $userfname." ".$userlname;
	 }
	$retusertype_id = $usercomments['Users']['usertype_id'];
	$retuser_id = $usercomments['Users']['user_id'];
	$user_imagepath = "assets/websiteuser/".$user_image;
	if(file_exists($user_imagepath)&&$user_image!='')
	{
	  $retuser_imagepath =  Router::url('/',true).$user_imagepath;
	  $imagecircle='img-circle';
	}
	else
	{
		$retuser_imagepath =  Router::url('/',true)."images/user-comment.png";
		 $imagecircle = '';
	}
	if($retusertype_id==2)
	{
	   $link= Router::url('/',true)."users/artist/".$retuser_id;
	}
	else
	{
		$link="javascript:void(0);";
	}
		?>
		<div class="media" id="comment<?php echo $mediacomment_id;?>">
		<img alt="..." src="<?php echo $retuser_imagepath;?>" height="25px" width="28px" class="<?php echo $imagecircle; ?>">
		<div class="media-body">
                           <h4 class="media-text"><?php echo $usercomment;?></h4>
						   <?php
						   if($retuser_id == $islogin)
						   {?>
						   <p><span class="pull-left" <?php echo $isloggedclass;?>><a onClick="return deletecomment(<?php echo $mediacomment_id;?>);" href="javascript:void(0);" style="color:black"><i class="fa fa-trash-o"></i></a>&nbsp;<a  href="javascript:void(0);" onClick="return updatecomment1(<?php echo $mediacomment_id;?>);" style="color:black"><i class="fa fa-edit"></i></a></span><a href="<?php echo $link;?>"></a></p>
						   <?php
						   }?>
						   <span class='pull-right'><a href="<?php echo $link;?>" style="color:black"><?php echo $displayname; ?></a></span>
                	</div>
		</div>
				  <?php
	}
	?>
                                </div>
                                
                                 
    </div>
             
 <script>
$(document).ready(function(){
        $("[rel^='lightbox']").prettyPhoto();
 });
 </script>
                     
                  

				  