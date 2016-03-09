<script>jwplayer.key="O+FYs7sL4MmPQTrTnzu4GnKoKGao3KAW+AQ/PA==";</script>
 <script>
$(document).ready(function(){
	$("[rel^='lightbox']").prettyPhoto();
	//document.cookie = "currentaudio = ;";
 });
</script>

<?php 
$url_id = $artistmediaDetails['UserMedia']['user_id'];
$browserPath = Router::url('/', true)."users/artist/".$url_id;
$flashplayerpath = Router::url('/', true)."js/jwplayer/player.swf";
$imagepath = Router::url('/', true)."assets/default/music-gallery-thumb.png";
$isloggedclass = $islogin>0?'':"style='display:none;'";
$retuser_id = $artistmediaDetails['UserMedia']['user_id'];
$category_id = $artistmediaDetails['UserMedia']['category_id'];
$medialikestatus = $islogin>0?"":"disabled='disabled;'";
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
<div class="modal-header">
							<h4 class="modal-title player_title" style="text-align: left;width: 100px;float: left;">&nbsp;&nbsp;PLAYER </h4>
							<div class="play_button_icon"><img src="http://artformplatform.com/afpf/images/video-play-icon-new.png"></div>
							<span style="float: right; text-transform: capitalize; font-size: 16px;color: #fff;width:80%;text-align:center;line-height: 46px;">
							
								<!-- <img src="http://artformplatform.com/afpf/assets/category/Category_image_<?php echo $category_id;?>.png" height="40px" width="40px;"> -->
								Category:
								<?php 
									echo  $artistmediaDetails['cat']['category_name'];
									if($artistmediaDetails['subcat']['subcategory_name'] !="")
									{
										echo " / ";
										echo $artistmediaDetails['subcat']['subcategory_name'];
									}
									if($artistmediaDetails['subsubcat']['subsubcategory_name'] !="")
									{
										echo " / ";
										echo $artistmediaDetails['subsubcat']['subsubcategory_name'];
									}
								?>	
							</span>
							
							
						</div>
<div class="modal-body artist-detail-height">
<div class="col-md-6 ">

<h3><?php echo $artistmediaDetails['UserMedia']['usermedia_name'];?><a <?php echo $showedit>0?"":"style='display:none'";?><?php echo $isloggedclass;?> onClick="return updateMedianame(<?php echo $usermedia_id;?>)" href="javascript:void(0);"><i class="fa fa-edit pull-right" style="color:#000;"></i></a></h3>


<?php 
								  $usermedia_type = $artistmediaDetails['UserMedia']['usermedia_type'];
								$category_name = $artistmediaDetails['cat']['category_name'];
								 $arraymediatype = explode('/',$usermedia_type);
								$coverid = $artistmediaDetails['UserMedia']['cover_id'];
								$vid_thumbnail_path = Router::url('/', true).$artistmediaDetails['UserMedia']['video_thumbnail'];
			 if($coverid>0)
			 {
				$imageusermedia_path = Router::url('/', true).$artistmediaDetails['usermedia_cover']['usermedia_path'];
			  	//$thumbnail_path = Router::url('/', true)."files/medium/".$retuser_id."/".$artistmediaDetails['usermedia_cover']['usermedia_title'];
				$thumbnail_path = Router::url('/', true)."files/medium/".$retuser_id."/".$artistmediaDetails['usermedia_cover']['usermedia_title'];

				$imagepath = $thumbnail_path;
				$pdfdefault = $thumbnail_path;
				$worddefault = $thumbnail_path;
				$vid_thumbnail_path = $thumbnail_path;
				$imageusermedia_path = Router::url('/', true)."files/medium/".$retuser_id."/".$artistmediaDetails['usermedia_cover']['usermedia_title'];			
			 }
			 else
			 {
			 	$imageusermedia_path = Router::url('/', true).$artistmediaDetails['UserMedia']['usermedia_path'];
				$thumbnail_path = $imageusermedia_path;
				$imagepath = Router::url('/', true)."assets/default/".lcfirst($category_name)."_default_new.jpg";
				$pdfdefault = Router::url('/', true)."assets/default/".lcfirst($category_name)."_default_new.jpg";
				$worddefault = Router::url('/', true)."assets/default/".lcfirst($category_name)."_default_new.jpg";
			 }
			 
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
                      			 <a  rel="lightbox[group]" href="<?php echo $thumbnail_path;?>"><img  class="img-responsive"  src="<?php echo $imageusermedia_path;?>" style="height:210px;width:100%;"/></a>
								<?php
								break;
								case "pdf":  
								
									$url = Router::url('/', true).'websites/pdfReader/'.$usermedia_id;
									?>
									
										<a href="<?php echo $url;?>" class="thumbnail" target="_blank"><img src="<?php echo $pdfdefault;?>" style="height:210px;width:100%;" /></a> 
										
									<?php
								break;	
							case "word":								
								?>
								
							
									<a target="_blank" href="http://docs.google.com/viewer?url=<?php echo Router::url('/',true).$artistmediaDetails['UserMedia']['usermedia_path'];?>" class="thumbnail" ><img src="<?php echo $worddefault;?>" style="height:210px;width:100%;"/></a> 
									
									
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
								<div id='artistaudio<?php echo $randnumber?>' style="position: relative; height: 170px;">Loading the player...</div>	

									<script type='text/javascript'>
									playerInstance4 = jwplayer('artistaudio<?php echo $randnumber?>');
									playerInstance4.setup({
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
									playerInstance4.onPlay(function(e) {
											//alert(' <?php echo $usermedia_id;?>');		
											 var audioFile = getCookie("currentaudio");
											 //alert(audioFile);
											  if (audioFile != "" && audioFile !='artistaudio<?php echo $randnumber;?>') {
												 // alert('yes pause previous');
												
														jwplayer(audioFile).pause(true);
												 
												  //alert('paused');
											  }
													//document.cookie = 'currentaudio=; expires=Thu, 01 Jan 1970 00:00:00 UTC;';	
													//setCookie("currentaudio", "<?php echo $randnumber;?>", 365);
													var cookieVal='artistaudio<?php print($randnumber);?>';
													setCookie('currentaudio', cookieVal, 1);
													console.log("Setting Cookies : currentaudio = <?php echo $randnumber;?>" );
									});

									</script>						
								<?php
							break;
							
							}
							?>
							<!-- <div class="likemedia" <?php echo $likedisable;?> >
						<button <?php echo $medialikestatus;?>  onclick="return likemedia(<?php echo $usermedia_id;?>);" type="button" class="btn btn-success" > <span class="glyphicon glyphicon-thumbs-up"></span> <span id="likemediabutton"> <?php echo $mediatext;?></span></button>
					  </div> -->
</div>
<div class="col-md-6 viewcomment">
<div class="col-md-12 comment-section">
   <div class="media" id="medtitle"><a href="javascript:void(0);"  class="media-left" >
   <img alt="..." src="<?php echo Router::url('/',true)?>images/chat-icon.png"></a>
                        		<div class="media-body">
  <h4 class="media-heading" >Comments</h4><span class="pull-right" style="width: 155px;">
  <span style="font-size: 15px;float:left;margin-right: 7px;"><b>Vote</b></span>
  <div id="jRateview<?php echo $usermedia_id;?>" <?php echo $medialikestatus; ?> data-average="<?php echo $viewmediarateing;?>" data-id="<?php echo $viewmediarateid;?>">
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
															//window.location = '<?php echo $browserPath; ?>';
															location.reload();
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
															//window.location = '<?php echo $browserPath; ?>';
															location.reload();
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
								</div></span>
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
			  // echo "<p>You need to login, to give comment</p>";
			}?>
	<?php
	
	foreach($arrUserComments as $usercomments)
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
		<div class="media" id="comment<?php echo $mediacomment_id;?>">
		<a href="<?php echo $link;?>" class="media-left"><img alt="..." src="<?php echo $retuser_imagepath;?>" height="25px" width="28px" class="<?php echo $imagecircle; ?>"></a>
                  	<div class="media-body">
                           <h4 class="media-text"><?php echo $usercomment;?></h4>
						   <?php
						   if($retuser_id == $islogin)
						   {?>
						   <p><span class="pull-left" <?php echo $isloggedclass;?>><a onClick="return deletecomment(<?php echo $mediacomment_id;?>);" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a>&nbsp;<a  href="javascript:void(0);" onClick="return updatecomment(<?php echo $mediacomment_id;?>);"><i class="fa fa-edit"></i></a></span><a href="<?php echo $link;?>"></a></p>
						   <?php
						   }?>
						   <span class='pull-right'><?php echo $username; ?></span>
                	</div>
		</div>
				  <?php
	}
	?>
	</div>
</div>
</div>