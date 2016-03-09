<style type="text/css">
.group1{height: 210px !important;}
</style>
<?php echo  $this->Html->script('jwplayer');?>
<script>jwplayer.key="O+FYs7sL4MmPQTrTnzu4GnKoKGao3KAW+AQ/PA==";</script>
<script>

setCookie('currentaudio', '', 1);
console.log("Setting Cookies : currentaudio = " );
</script>
<?php echo  $this->Html->script('countartist');?>
<div class="container gallery myuploads">
<ul class="thumbnails">
<?php 
$flashplayerpath = Router::url('/', true)."js/jwplayer/player.swf";

foreach($uploadeddata as $usermedia )	
{			
			$usermedia_id = $usermedia['UserMedia']['usermedia_id'];
			$user_id = $usermedia['UserMedia']['user_id'];
			$usermedia_path = Router::url('/', true).$usermedia['UserMedia']['usermedia_path'];
			$thumbnail_path = Router::url('/', true)."files/medium/".$user_id."/".$usermedia['UserMedia']['usermedia_title'];
			$vid_thumbnail_path = Router::url('/', true).$usermedia['UserMedia']['video_thumbnail'];
			$imageusermedia_path = $usermedia_path;
			$usermedia_title = $usermedia['UserMedia']['usermedia_title'];
			$usermedia_name = $usermedia['UserMedia']['usermedia_name'];
			$usermedia_type = $usermedia['UserMedia']['usermedia_type'];
			$arraymediatype = explode('/',$usermedia_type);
			$coverid = $usermedia['UserMedia']['cover_id'];
			$usermedia_date = $usermedia['UserMedia']['usermedia_date'];
			 $categoryname = $usermedia['category']['category_name'];
				$now = date('Y-m-d H:i:s');		
				$days	= $this->Caldays->checkdates($now,$usermedia_date);	
			$ext = pathinfo($usermedia['UserMedia']['usermedia_title'], PATHINFO_EXTENSION);
			$audioextarray = array('mp3','wav','aiff','flac','MP3','WAV','AIFF','FLAC','m4a','M4A','f4a','F4A','aac','AAC','ogg','OGG','oga','OGA');
			$videoextarray = array('mp4','wav','mkv','flv','WAV','avi','3gp','MP4','MKV','FLV','AVI','3GP','mov','MOV','m4v','f4v','M4V','F4V','WebM','webm');
			$imageextarray = array('jpeg','jpg','png','JPEG','JPG','PNG','gif','GIF');
			$pdfarray = array('pdf','PDF');
			$docxarray = array('docx','doc','DOCX','DOC');
			$loggeduserid = $this->Session->read('Auth.WebsitesUser.user_id');
			$retuser_id = $this->Session->read('Auth.WebsitesUser.user_id');
			$user_display_name = $this->Session->read('Auth.WebsitesUser.user_display_name');
				
				if($user_display_name!="")
				{
					$username = $user_display_name;
				}
				else
				{
					$userfname = $this->Session->read('Auth.WebsitesUser.userfname');
					$user_lname = $this->Session->read('Auth.WebsitesUser.user_lname');
					$username = $userfname." ".$userlname;
				}
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
			
			
			 if($coverid>0)
			 {
				$imageusermedia_path = Router::url('/', true).$usermedia['children']['UserMedia']['usermedia_path'];
			  	$thumbnail_path = Router::url('/', true)."files/medium/".$user_id."/".$usermedia['children']['UserMedia']['usermedia_title'];
				$imagepath = $thumbnail_path;
				$audioimagepath = $thumbnail_path;
				$pdfdefault = $thumbnail_path;
				$worddefault = $thumbnail_path;
				$vid_thumbnail_path = $thumbnail_path;
				$imageusermedia_path = $thumbnail_path;
			 }
			 else
			 {
				$imagepath = $thumbnail_path;
				$audioimagepath = Router::url('/', true)."assets/default/".lcfirst($categoryname)."_default.jpg";
				$pdfdefault = Router::url('/', true)."assets/default/".lcfirst($categoryname)."_default.jpg";
				$worddefault = Router::url('/', true)."assets/default/".lcfirst($categoryname)."_default.jpg";
			 }
			?>
			<li class="col-md-3" id="media<?php echo $usermedia_id?>" >
			<div class="gallerytext">
						<div class="medianame" style="border-bottom:none;">
							<a id="medianame<?php echo $usermedia_id?>"><?php echo $usermedia_name?></a> <span class="pull-right"><a onClick="return updateMedianamebyupload(<?php echo $usermedia_id;?>)" href="javascript:void(0);"><i class="fa fa-edit "></i></a></span>
						</div>
						
				</div>
			<?php
			switch($mediatype)
			{
		case "image":
		?>  
                
				    <a href="<?php echo $imagepath;?>" rel="lightbox[group]"><img title="Image Title" src="<?php echo $imageusermedia_path;?>" class="group1" style="height:180px;width:100%;"></a>
                      <div class="deletemedia">
						<a href="javascript:void(0);" onclick="return fndeletemedia(<?php echo $usermedia_id?>,'');"><i class="btn btn-danger glyphicon glyphicon-trash"></i></a>
					  </div>
			
				
			<?php
			break;
			case "audio": 
			case "video":
				if($mediatype=="video")
					{
					  $audioimagepath=$vid_thumbnail_path;
					}		
					?>	
				
						<div id='myupload<?php echo $usermedia_id;?>' style="position: relative; height: 170px;">Loading the player...</div>
						 <div class="deletemedia">
						<a href="javascript:void(0);" onclick="return fndeletemedia(<?php echo $usermedia_id?>,'');"><i class="btn btn-danger glyphicon glyphicon-trash"></i></a>
					  </div>
					
					
					<script type='text/javascript'>
					playerInstance6 = jwplayer('myupload<?php echo $usermedia_id?>');
playerInstance6.setup({
  flashplayer: '<?php echo $flashplayerpath;?>',
  file:'<?php echo $usermedia_path;?>',
  height: 210,
  width:'100%',
  image:'<?php echo $audioimagepath;?>',
  class:"thumbnail",
   hide: true,
  'plugins': { 'viral-2': {'oncomplete':'False','onpause':'False','functions':'All'} }
   });
   	playerInstance6.onPlay(function(e) {
											//alert('<?php echo $usermedia_id;?>');		
											 var audioFile = getCookie("currentaudio");
											 //alert(audioFile);
											  if (audioFile != "" && audioFile !='myupload<?php echo $usermedia_id;?>') {
												 // alert('yes pause previous');
												
													jwplayer(audioFile).pause(true);
												

												  //alert('paused');
											  }
													//document.cookie = 'currentaudio=; expires=Thu, 01 Jan 1970 00:00:00 UTC;';	
													//setCookie("currentaudio", "<?php echo $usermedia_id;?>", 365);
													var cookieVal='myupload<?php print($usermedia_id);?>';
													setCookie('currentaudio', cookieVal, 1);
													console.log("Setting Cookies : currentaudio = <?php echo $usermedia_id;?>" );
									});

</script>
					
				<?php 
			     break;
				
								
			 case "pdf":  
				
					$url = Router::url('/', true).'websites/pdfReader/'.$usermedia_id;
					?>
					
						<a href="<?php echo $url;?>"  target="_blank"><img src="<?php echo $pdfdefault;?>" style="height:210px;width:100%;" /></a> 
							<div class="deletemedia">
							<a href="javascript:void(0);" onclick="return fndeletemedia(<?php echo $usermedia_id?>,'');"><i class="btn btn-danger glyphicon glyphicon-trash"></i></a>
							
							 </div>
					
					<?php	
					break;
				
			 case "word":  
			 ?>
			 
					<a  target="_blank" href="http://docs.google.com/viewer?url=<?php echo Router::url('/',true).$usermedia_path;?>"  ><img src="<?php echo $worddefault;?>" style="height:210px;width:100%;"/></a> 
					<div class="deletemedia">
						<a href="javascript:void(0);" onclick="return fndeletemedia(<?php echo $usermedia_id?>,'');"><i class="btn btn-danger glyphicon glyphicon-trash"></i></a>
					 </div>
				
				<?php
				
				break;
				
			}
		?>
		<div class="gallerytext">
				<div class="medianame">
					<?php 
						echo $this->Html->link(mb_strimwidth($usermedia_name,0, 12, ".."), array('controller'=>'users','action' => "art", $usermedia_id), array( 'id'=>'msg-name', 'escape' => false)); ?> <div class="pull-right"><?php echo $categoryname;?> <?php if($susubcategoryname!=""){echo " - <span class='subsubcat_name'>".$susubcategoryname."</sapn>";}?></div> &nbsp;
						
					<?php 
					if($loggeduserid>0)
					{					
											echo $this->Html->link(
											   $this->Html->tag('i', '', array('class' => 'fa fa-comment fa-1x')) ,
											   array('controller'=>'users','action' => 'artist',$retuser_id),
											   array('class' => 'button_class button comment_class', 'escape' => false)
											);
					}
					
				?>
				</div>	
				<div class="socialmedia">
					<?php 
						echo $this->Html->link(mb_strimwidth($username,0, 12, ".."), array('controller'=>'users','action' => "artist", $retuser_id), array( 'id'=>'msg-name', 'escape' => false)); 
					?>
					<div class="social-network pull-right">
						<?php echo $this->Form->button('<i class="fa fa-facebook fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class', 'id'=>'facebook','value'=>'socialfacebook'.$usermedia_id, 'escape' => false)); 
						$strFURL = "https://www.facebook.com/sharer.php?u=".$usermedia_path."&t=".$usermedia_name."";
						echo $this->Form->hidden('',array('id'=>'socialfacebook'.$usermedia_id.'_process_url', 'value'=>$strFURL));
						?>
						<?php							
							echo $this->Form->button('<i class="fa fa-linkedin fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class','id'=>'linkedin','value'=>'sociallinkedin'.$usermedia_id)); 
							$strFURL = "http://www.linkedin.com/shareArticle?mini=true&url=".$usermedia_path."";
							echo $this->Form->hidden('',array('id'=>'sociallinkedin'.$usermedia_id.'_process_url', 'value'=>$strFURL));
													
						?>
						<?php							
							echo $this->Form->button('<i class="fa fa-google-plus fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class','id'=>'gmail', 'value'=>'socialgmail'.$usermedia_id)); 
							$strFURL = "https://plus.google.com/share?url=".$usermedia_path."&hl=en";
							echo $this->Form->hidden('',array('id'=>'socialgmail'.$usermedia_id.'_process_url', 'value'=>$strFURL));
						?>					
						<?php							
							echo $this->Form->button('<i class="fa fa-twitter fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class','id'=>'twitter', 'value'=>'socialtwitter'.$usermedia_id)); 
							$strFURL = "http://www.twitter.com/share?url=".$usermedia_path."&text=".$usermedia_name."";
							echo $this->Form->hidden('',array('id'=>'socialtwitter'.$usermedia_id.'_process_url', 'value'=>$strFURL));												
						?>					
					</div>
					<div class="publish-date"><?php echo $days; ?> </div>
				</div>
			</div>
			</li>
			<?php
	}
	?>
	</ul> 
	</div>

	
	
