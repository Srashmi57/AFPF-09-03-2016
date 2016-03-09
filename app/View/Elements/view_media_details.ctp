<script>jwplayer.key="O+FYs7sL4MmPQTrTnzu4GnKoKGao3KAW+AQ/PA==";</script>
<?php 
echo $this->Html->script('countartist');
$txtfollow = $isloggedfollowed>0?'Unfollow':'Follow';
?>
<?php 
    $browserPath = Router::url('/', true );
	$count=0;
	$retmediarating=0;
	$mediarating_id=0;			
	$isloggedclass = $islogin>0?'':"disabled='disabled'";
	$cmtclass = $islogin>0?'':"display:none";
	if(count($artistmediaDetails)>0)
	{
		$category_name = $artistmediaDetails[0]['cat']['category_name'];
		$retuser_id = $artistmediaDetails[0]['UserMedia']['user_id'];
		$pdfdefault = Router::url('/', true)."assets/default/pdf-gallery-thumb.png";
		$worddefault = Router::url('/', true)."assets/default/word_thumb.png";
		$retcover_id = $artistmediaDetails[0]['UserMedia']['cover_id'];
		$vid_thumbnail_path = Router::url('/', true).$artistmediaDetails[0]['UserMedia']['video_thumbnail'];
		$imageusermedia_path = Router::url('/', true).$artistmediaDetails[0]['UserMedia']['usermedia_path'];
		$retuser_id = $artistmediaDetails[0]['UserMedia']['user_id'];
		if($retuser_id==$islogin)
		{
			$likedisable="style='display:none;'";
		}
		else
		{
			$likedisable="";
		}
		if($retcover_id>0)
		{
			$imageusermedia_path = Router::url('/', true).$artistmediaDetails[0]['usermedia_cover']['usermedia_path'];
			$thumbnail_path = Router::url('/', true)."files/medium/".$retuser_id."/".$artistmediaDetails[0]['usermedia_cover']['usermedia_title'];
			$imagepath = $thumbnail_path;
			$pdfdefault = $thumbnail_path;
			$worddefault = $thumbnail_path;
			$vid_thumbnail_path = Router::url('/', true)."files/".$retuser_id."/".$artistmediaDetails[0]['usermedia_cover']['usermedia_title'];
			$audioimagepath = Router::url('/', true)."files/".$retuser_id."/".$artistmediaDetails[0]['usermedia_cover']['usermedia_title'];
			$imageusermedia_path = $thumbnail_path;
		}
		else
		{
			$audioimagepath = Router::url('/', true)."assets/default/".lcfirst($category_name)."_default_new.jpg";
			$imagepath = Router::url('/', true)."assets/default/".lcfirst($category_name)."_default_new.jpg";
			$pdfdefault = Router::url('/', true)."assets/default/".lcfirst($category_name)."_default_new.jpg";
			$worddefault = Router::url('/', true)."assets/default/".lcfirst($category_name)."_default_new.jpg";
			$thumbnail_path = Router::url('/', true)."files/large/".$retuser_id."/".$artistmediaDetails[0]['UserMedia']['usermedia_title'];
			$imageusermedia_path = Router::url('/', true).$artistmediaDetails[0]['UserMedia']['usermedia_path'];
		}			
		if(($islogin>0)&&($retuser_id==$islogin))
		{
			$medialikestatus = "disabled='disabled;'";
		}
		else if($islogin>0)
		{
			$medialikestatus='';
		}
		else
		{
			$medialikestatus="disabled='disabled;'";
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
		<div class="col-md-12">
			<div id="video-tag">
				<?php echo mb_strimwidth($artistmediaDetails[0]['UserMedia']['usermedia_name'],0, 12, "..");?>(<?php echo $category_name;?>)
				<?php 
					$flashplayerpath = Router::url('/', true)."js/jwplayer/player.swf";
				?>
				<div style="/* position: absolute !important; *//* right: 14px; *//* top: 250px; */width: 161px;float: right;">
				<span style="font-size: 15px;">Vote</span>
				<div id="jRate_index<?php echo $artistmediaDetails[0]['UserMedia']['usermedia_id'];?>" <?php echo $isloggedclass; ?> data-average="<?php echo $viewmediarateing;?>" data-id="<?php echo $viewmediarateid;?>" class="jRate_index">
					<script type="text/javascript">
						var umid =  <?php echo $artistmediaDetails[0]['UserMedia']['usermedia_id']?>;
						var login = <?php echo $islogin>0?1:0?>;
						if(login==0)
						{
							$("#jRate_index<?php echo $artistmediaDetails[0]['UserMedia']['usermedia_id'];?>").jRating({
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
							$("#jRate_index<?php echo $artistmediaDetails[0]['UserMedia']['usermedia_id'];?>").jRating({
								step:true,
								length : 5,
								rateMax : 5,
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
													url: '<?php echo Router::url('/',true);?>users/saveuserrating/<?php echo $artistmediaDetails[0]['UserMedia']['usermedia_id'];?>',
													type: 'post',
													data: {'rate': rate},
													dataType:'json',
													success: function (data) {
														bootbox.alert(data.message);
														window.location = '<?php echo $browserPath; ?>';
													}
												});
											}
										}); 
									}
									else
									{
										$.ajax({
											url: '<?php echo Router::url('/',true);?>users/saveuserrating/<?php echo $artistmediaDetails[0]['UserMedia']['usermedia_id'];?>',
											type: 'post',
											data: {'rate': rate},
											dataType:'json',
											success: function (data) {
												bootbox.alert(data.message);
												window.location = '<?php echo $browserPath; ?>';
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
					$ext = pathinfo($artistmediaDetails[0]['UserMedia']['usermedia_title'], PATHINFO_EXTENSION);
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
								<a  rel="lightbox[group]" href="<?php echo $imageusermedia_path;?>"><img class="group1" src="<?php echo $imageusermedia_path;?>" title="Image Title" style="height:210px;width:100%;" /></a>
							<?php
						break;						 
						case "pdf": 
							$url = Router::url('/', true).'websites/pdfReader/'.$usermedia_id;
							?>
								<a href="<?php echo $url;?>" class="thumbnail" ><img src="<?php echo $pdfdefault; ?>"  style="height:210px;width:100%;"/></a> 
							<?php	
						break;
						case "word":  
							?>
								<a href="http://docs.google.com/viewer?url=<?php echo Router::url('/',true).$artistmediaDetails[0]['UserMedia']['usermedia_path'];?>"  ><img src="<?php echo $worddefault;?>" style="height:210px;width:100%;"/></a> 
							<?php	
						break;
						case "audio": 
						case "video":
						$randnumber = rand();
						if($mediatype=="video")
							{
										$audioimagepath=$vid_thumbnail_path;
							}
							?>	
					<div id='viewmediaaudio<?php echo $randnumber;?>' style="position: relative; height: 170px;">Loading the player...</div>	
					
			<script type="text/javascript">
			var playerInstance2 = jwplayer('viewmediaaudio<?php echo $randnumber;?>');
					playerInstance2.setup({
					  flashplayer: '<?php echo $flashplayerpath;?>',
					  file:'<?php echo Router::url('/',true).$artistmediaDetails[0]['UserMedia']['usermedia_path'];?>',
					  height: 210,
					  width:'100%',
					  image:'<?php echo $audioimagepath;?>',
					  class:'thumbnail',
					   hide: true,
					  'plugins': { 'viral-2': {'oncomplete':'False','onpause':'False','functions':'All'} }
					   });
					   
					       playerInstance2.onPlay(function(e) {
					//alert(' <?php echo $randnumber;?>');		
					 var audioFile = getCookie("currentaudio");
					 //alert(audioFile);
					  if (audioFile != "" && audioFile !='viewmediaaudio<?php echo $randnumber;?>') {
						 // alert('yes pause previous');
							
										jwplayer(audioFile).pause(true);
									
						  //alert('paused');
					  }
							//document.cookie = 'currentaudio=; expires=Thu, 01 Jan 1970 00:00:00 UTC;';	
							//setCookie("currentaudio", "<?php echo $randnumber;?>", 365);
							var cookieVal='viewmediaaudio<?php print($randnumber);?>';
							setCookie('currentaudio', cookieVal, 365);
							console.log("Setting Cookies : currentaudio = <?php echo $randnumber;?>" );
					});		

					</script>					
				<?php
					break;
					
								
							}
							?>
								
                              
                    </div>
                            <div class="comment-section">
							   <div class="media"><a class="media-left" href="javascript:void(0);" <?php  if(!$islogin>0)
{?> onClick="javascript:bootbox.alert('Please login to comment');" <?php } else{ echo "style='cursor:none;'";}?>>
<i class="fa fa-comment fa-2x" style="float: left;padding-right: 10px;"></i></a></a>
                                		<div class="media-body">
                                			<h4 class="media-heading">Comments </h4>
											<!-- Artist follow -->
											<button id="followbutton" class='btn btn-success' <?php echo $isloggedclass;?> type="button" onclick="return followartist(<?php echo $retuser_id;?>);" style="float: right;"><?php echo $txtfollow;?></button>
											<div class="col-md-12" id="followercount" style="color:white;position: absolute;left: 10px;top: -14px;">
												<?php echo $followerscount; ?>
											</div>
											<!-- End here -->
											 <!-- <div class="likemedia_new" <?php echo $likedisable;?> style="margin-top: -8px;">
						<button   onclick="<?php echo $islogin>0?'return likemedia('.$artistmediaDetails[0]['UserMedia']['usermedia_id'].');':"bootbox.alert('Please Login to do like');"?>" type="button" class="btn" > <span class="glyphicon glyphicon-thumbs-up"></span> <span id="likemediabutton"> <?php echo $mediatext;?></span></button>
					
											</div> -->
											
                                	</div>
									<?php 
									//if($retuser_id!=$islogin)
									if($islogin>0)
									{
									
									?>
									<div class="media row" id="addcomment" style="<?php echo $cmtclass;?>">
									
	   	 <form name="frmartistcomment" id="frmartistcomment" method="post">

								<div class="form-group">
								
								<div class="col-sm-12">
							<textarea name="txtcomment" id="txtcomment" class="form-control validate[required]" rows="3"></textarea>
							<input type="hidden" name="usermediaid" id="usermediaid" value="<?php echo $artistmediaDetails[0]['UserMedia']['usermedia_id']?>"/>
								</div> 
								</div>
						
			<div class="col-md-3 pull-right">
			
			  
							  <button type="submit" class="btn btn-success" onclick="return fnsavecomment();" id="addItem">SUBMIT</button>
				 
			
      </div>	
	 </form>
	 
	 </div>
	 <?php
	 }
	 	elseif(!$islogin>0)
			{
			  //echo "<p>Please login to do comments</p>";
			}?>
	 
                                </div>
                              <?php
	foreach($artistmediaDetails['children'] as $usercomments)
	{
	$usercomment = $usercomments['MediaComment']['usermedia_comment'];
	$mediacomment_id = $usercomments['MediaComment']['mediacomment_id'];
	$retusertype_id = $usercomments['Users']['usertype_id'];
	$retuser_id = $usercomments['Users']['user_id'];
	 $user_image = $usercomments['Users']['user_cropped_image'];
	 $user_fname = $usercomments['Users']['user_fname'];
	 $user_lname = $usercomments['Users']['user_lname'];
	 $user_display_name = $usercomments['Users']['user_display_name'];
	 if($user_display_name!="")
	 {
		$displayname = $usercomments['Users']['user_display_name'];
	 }
	 else
	 {
		$displayname =  $user_fname." ".$user_lname;
	 }
	 
	 
	 
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
		$link="javascript:void(0)";
	}
		?>
	<div class="media col-md-12" id="comment<?php echo $mediacomment_id;?>">
				<a href="<?php echo $link;?>" class="media-left"><img alt="..." src="<?php echo $retuser_imagepath;?>" height="25px" width="28px" class="<?php echo $imagecircle; ?>"></a>
				
                  	<div class="media-body">
                           <h4 class="media-text"><?php echo $usercomment;?></h4>
						  
						   <?php
						   if($retuser_id == $islogin)
						   {?>
							<p><span class="pull-left" <?php echo $isloggedclass;?>><a onClick="return deletecomment(<?php echo $mediacomment_id;?>);" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a>&nbsp;<a  href="javascript:void(0);" onClick="return updatecomment(<?php echo $mediacomment_id;?>);"><i class="fa fa-edit"></i></a></span><a href="<?php echo $link;?>"></a></p>
						   <?php
						   }?>
						   <span class='pull-right'><a href="<?php echo $link;?>"><?php echo $displayname; ?></a></span>
                	</div>
		</div>
				  <?php
	}
	?>
                                </div>
                                
                                 
    </div>
	<?php
	}
	else
	{
	 echo "<div class='video--player-screensaver'>";
    echo "<img src='".Router::url('/',true)."/assets/default/video--player-screensaver.png'/>";
    echo "</div>";
	}?>
                            
                           
                            
                            
      
                     
                  
