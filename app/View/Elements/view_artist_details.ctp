<script>jwplayer.key="O+FYs7sL4MmPQTrTnzu4GnKoKGao3KAW+AQ/PA==";</script>
 <script>
$(document).ready(function(){
	$("[rel^='lightbox']").prettyPhoto();
	//document.cookie = "currentaudio = ;";
 });
</script>
<?php 
	$browserPath = $this->request->here;
	$isloggedclass = $islogin>0?'':"style='display:none;'";
	$loggedclass = $islogin>0?'':"disabled='disabled'";
	$usermedia_type = $artistmediaDetails[0]['UserMedia']['usermedia_type'];
	$vid_thumbnail_path = Router::url('/', true).$artistmediaDetails[0]['UserMedia']['video_thumbnail'];
	$usermedia_id = $artistmediaDetails[0]['UserMedia']['usermedia_id'];
	$retuser_id = $artistmediaDetails[0]['UserMedia']['user_id'];
	$category_name = $artistmediaDetails[0]['cat']['category_name'];
	/*$subcategory_id = $artistmediaDetails[0]['UserMedia']['subcategory_id'];	
	$subsubcategory_id = $artistmediaDetails[0]['UserMedia']['subsubcategory_id'];	
	$medialikestatus = $islogin>0?"":"disabled='disabled;'";
	print("<pre>");
	print_r($artistmediaDetails);
	exit;*/
	$category_id = $artistmediaDetails[0]['UserMedia']['category_id'];
	if(!$viewmediarateing>0)
	{
	$viewmediarateing=0;
	}
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
<div class="modal-header">
							<h4 class="modal-title player_title" style="text-align: left;width: 100px;float: left;">&nbsp;&nbsp;PLAYER
							</h4>
							<div class="play_button_icon"><img src="http://artformplatform.com/afpf/images/video-play-icon-new.png"></div>
							<span style="float: right; text-transform: capitalize; font-size: 16px;color: white;width:80%; text-align:center;line-height: 46px;">
								<!-- <img src="http://artformplatform.com/afpf/assets/category/Category_image_<?php echo $category_id;?>.png" height="40px" width="40px;"> -->
								Category:
								<?php 
									echo  $artistmediaDetails[0]['cat']['category_name'];
									if($artistmediaDetails[0]['subcat']['subcategory_name'] !="")
									{
										echo " / ";
										echo $artistmediaDetails[0]['subcat']['subcategory_name'];
									}
									if($artistmediaDetails[0]['subsubcat']['subsubcategory_name'] !="")
									{
										echo " / ";
										echo $artistmediaDetails[0]['subsubcat']['subsubcategory_name'];
									}
								?>	
							</span>
							
							
						</div>
<div class="modal-body artist-detail-height">
<div class="col-md-6 ">
	<h3>
		<?php 
			echo $artistmediaDetails[0]['UserMedia']['usermedia_name'];
		?>
		<a 
			<?php echo $showedit>0?"":"style='display:none'";?> <?php echo $isloggedclass;?>onClick="return updateMedianame(<?php echo $usermedia_id;?>)" href="javascript:void(0);"><i class="fa fa-edit pull-right" style="color:#000;"></i>
		</a>
	</h3>
	<?php
	//print("<pre>");
	//print_r($artistmediaDetails);
	
		$flashplayerpath = Router::url('/', true)."js/jwplayer/player.swf";
		
		$arraymediatype = explode('/',$usermedia_type);
		$coverid = $artistmediaDetails[0]['UserMedia']['cover_id'];
		if($coverid>0)
		{
			$imageusermedia_path = Router::url('/', true).$artistmediaDetails[0]['usermedia_cover']['usermedia_path'];
			$thumbnail_path = Router::url('/', true)."files/medium/".$retuser_id."/".$artistmediaDetails[0]['usermedia_cover']['usermedia_title'];
			$imagepath = $thumbnail_path;
			$pdfdefault = $thumbnail_path;
			$worddefault = $thumbnail_path;
			$vid_thumbnail_path = Router::url('/', true)."files/".$retuser_id."/".$artistmediaDetails[0]['usermedia_cover']['usermedia_title'];
			$imageusermedia_path = $thumbnail_path;
			$audioimagepath = Router::url('/', true)."files/".$retuser_id."/".$artistmediaDetails[0]['usermedia_cover']['usermedia_title'];
		}
		else
		{
			$imageusermedia_path = Router::url('/', true).$artistmediaDetails[0]['UserMedia']['usermedia_path'];
			$imagepath = Router::url('/', true)."assets/default/".lcfirst($category_name)."_default_new.jpg";
			$pdfdefault = Router::url('/', true)."assets/default/".lcfirst($category_name)."_default_new.jpg";
			$worddefault = Router::url('/', true)."assets/default/".lcfirst($category_name)."_default_new.jpg";
			$audioimagepath = Router::url('/', true)."assets/default/".lcfirst($category_name)."_default_new.jpg";
		}
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
					<a  rel="lightbox[group]" href="<?php echo $imageusermedia_path;?>"><img  class="img-responsive"  src="<?php echo $imageusermedia_path;?>" style="height:210px;width:100%;"/></a>
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
					<div id='viewartistaudio<?php echo $randnumber;?>' style="position: relative; width: 390px; height: 267px;">Loading the player...</div>
					<script type='text/javascript'>
					var playerInstance3 = jwplayer('viewartistaudio<?php echo $randnumber;?>');
						playerInstance3.setup({
							flashplayer: '<?php echo $flashplayerpath;?>',
							file:'<?php echo Router::url('/',true).$artistmediaDetails[0]['UserMedia']['usermedia_path'];?>',
							height: 210,
							width:'100%',
							image:'<?php echo $audioimagepath;?>',
							class:'thumbnail',
							hide: true,
							'plugins': { 'viral-2': {'oncomplete':'False','onpause':'False','functions':'All'} }
						});
						playerInstance3.onPlay(function(e) {
											//alert('<?php echo $randnumber;?>');		
											 var audioFile = getCookie("currentaudio");
											 //alert(audioFile);
											  if (audioFile != "" && audioFile !='viewartistaudio<?php echo $randnumber;?>') {
												 // alert('yes pause previous');
												 
														jwplayer(audioFile).pause(true);
													
												  //alert('paused');
											  }
													//document.cookie = 'currentaudio=; expires=Thu, 01 Jan 1970 00:00:00 UTC;';	
													//setCookie("currentaudio", "<?php echo $randnumber;?>", 365);
													var cookieVal='viewartistaudio<?php print($randnumber);?>';
													setCookie('currentaudio', cookieVal, 365);
													console.log("Setting Cookies : currentaudio = <?php echo $randnumber;?>" );
									});
					</script>			
				<?php
			break;	
			
								 
			case "pdf":
				$url = Router::url('/', true).'websites/pdfReader/'.$usermedia_id;
				?>
					<a href="<?php echo $url;?>"  target="_blank"><img src="<?php echo $pdfdefault?>" style="height:210px;width:100%;" /></a> 
				<?php
			break;
			case "word":
				?>
					<a target="_blank" href="http://docs.google.com/viewer?url=<?php echo Router::url('/',true).$artistmediaDetails[0]['UserMedia']['usermedia_path'];?>"  ><img src="<?php echo $worddefault; ?>" style="height:210px;width:100%;"/></a> 
				<?php
			break;
		}
	?>
	<!-- <div class="likemedia_new" style="margin-top:15px;" <?php echo $likedisable;?> >
		<button   onclick="<?php echo $islogin>0?'return likemedia('.$usermedia_id.');':"bootbox.alert('Please Login to do like');"?>" type="button" class="btn" > <span class="glyphicon glyphicon-thumbs-up"></span> <span id="likemediabutton"> <?php echo $mediatext;?></span></button>
	</div>	-->			
</div>
<div class="col-md-6 viewcomment">
	<div class="col-md-12 comment-section">
		<div class="media" id="medtitle">
			<a href="javascript:void(0);"  class="media-left">
			<img alt="..." src="<?php echo Router::url('/',true)?>images/chat-icon.png"></a>
			<div class="media-body">
				<h4 class="media-heading" >Comments </h4>
				<span class="pull-right" style="width: 155px;">
				<span style="font-size: 14px;float:left;margin-right: 7px;">Vote</span>
					<div id="jRateview<?php echo $usermedia_id;?>" <?php echo $loggedclass; ?> data-average="<?php echo $viewmediarateing;?>" data-id="<?php echo $viewmediarateid;?>">
						<script type="text/javascript">
							var umid =  <?php echo $usermedia_id?>;
							var login = <?php echo $islogin>0?1:0?>;
							if(login==0)
							{
								$("#jRateview<?php echo $usermedia_id;?>").jRating({
								  step:false,
								  length : 5,
								  nbRates : 3,
								   bigStarsPath:'<?php echo Router::url('/',true);?>icons/stars.png',
								  showRateInfo:false,
								  
								  canRateAgain : false,
								 onClick : function(element,rate) {
									bootbox.alert('Please login to do rate');
									}	
								});
							}
							else
							{						
								$("#jRateview<?php echo $usermedia_id;?>").jRating({
									step:true,
									length : 5,
									phpPath:'<?php echo Router::url('/',true);?>users/saveuserrating/'+umid,
									nbRates : 3,
									sendRequest:false,
									bigStarsPath:'<?php echo Router::url('/',true);?>icons/stars.png',
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
												url: '<?php echo Router::url('/',true);?>users/saveuserrating/<?php echo $usermedia_id;?>',
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
					</div>
				</span>
			</div>
		</div>
		  	<?php
			//if($retuser_id!=$islogin)
			if($islogin>0)
									{
									
									?>
	   <div class="media row" id="addcomment" <?php echo $isloggedclass;?>>
	 
			<form name="frmartistcomment" id="frmartistcomment" method="post">
				<div class="form-group">
					<div class="col-sm-12">
						<textarea name="txtcomment" id="txtcomment" class="form-control validate[required]" rows="5"></textarea>
						<input type="hidden" name="usermediaid" id="usermediaid" value="<?php echo $usermedia_id?>"/>
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
			  //echo "<p>You need to login, to give comment</p>";
			}?>
		<?php
		$link="javascript:void(0)";
		foreach($artistmediaDetails['children'] as $usercomments)
		{
			$usercomment = $usercomments['MediaComment']['usermedia_comment'];
			$mediacomment_id = $usercomments['MediaComment']['mediacomment_id'];
			$retusertype_id = $usercomments['Users']['usertype_id'];
			$retuser_id = $usercomments['Users']['user_id'];
			$user_image = $usercomments['Users']['user_cropped_image'];
			$user_fname = $usercomments['Users']['user_fname'];
			$user_lname = $usercomments['Users']['user_lname'];
			$user_display_name = stripslashes($usercomments['Users']['user_display_name']);	  
			if($user_display_name!="")
			{
				$username = $usercomments['Users']['user_display_name'];
			}
			else
			{
				$username = $user_fname." ".$user_lname;
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
					{
						?>
							<p><span class="pull-left" <?php echo $isloggedclass;?>><a onClick="return deletecomment(<?php echo $mediacomment_id;?>);" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a>&nbsp;<a  href="javascript:void(0);" onClick="return updatecomment(<?php echo $mediacomment_id;?>);"><i class="fa fa-edit"></i></a></span><a href="<?php echo $link;?>"></a></p>
					   <?php
					}
					?>
					<span class='pull-right'><?php echo $username; ?></span>
				</div>
			</div>
			<?php
		}
		?>
	</div>
</div>
</div>