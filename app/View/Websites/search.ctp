<script>
setCookie('currentaudio', '', 1);
console.log("Setting Cookies : currentaudio = " );
</script>
<?php
echo $this->Html->script('jwplayer');
?>
<script>jwplayer.key="O+FYs7sL4MmPQTrTnzu4GnKoKGao3KAW+AQ/PA==";</script>
<script>
$(document).ready(function(){
        $("[rel^='lightbox']").prettyPhoto();
 });

</script>
 <div class="recentgallery wow fadeInUp" id="maincontent">
              <ul class="thumbnails">
			  <?php 
$flashplayerpath = Router::url('/', true)."js/jwplayer/player.swf";
$imagepath = Router::url('/', true)."assets/default/audio_default.png";
$pdfdefault = Router::url('/', true)."assets/default/pdf_default.png";
 $worddefault = Router::url('/', true)."assets/default/word_thumb.png";
if(count($searchmedia)>0)
{
foreach($searchmedia  as $mediarecent )	
{			
			 $usermedia_id = $mediarecent['UserMedia']['usermedia_id'];
			 $user_id = $mediarecent['UserMedia']['user_id'];
			$usermedia_path = Router::url('/', true).$mediarecent['UserMedia']['usermedia_path'];
			$thumbnail_path = Router::url('/', true)."files/medium/".$user_id."/".$mediarecent['UserMedia']['usermedia_title'];
			$usermedia_title = $mediarecent['UserMedia']['usermedia_title'];
			$vid_thumbnail_path = Router::url('/', true).$mediarecent['UserMedia']['video_thumbnail'];
			$imageusermedia_path = $usermedia_path;
			$usermedia_name = $mediarecent['UserMedia']['usermedia_name'];
			$usermedia_type = $mediarecent['UserMedia']['usermedia_type'];
			$arraymediatype = explode('/',$usermedia_type);
			$userfname = $mediarecent['users']['user_fname'];
			$userlname = $mediarecent['users']['user_lname'];
			$coverid = $mediarecent['UserMedia']['cover_id'];
			if($mediarecent['users']['user_display_name']!="")
			{
				$username = $mediarecent['users']['user_display_name'];
			}
			else
			{
				$username = $userfname." ".$userlname;
			}
			
			$retuser_id = $mediarecent['users']['user_id'];
			$categoryname = $mediarecent['category']['category_name'];
			$subcategoryname = $mediarecent['subcategory']['subcategory_name'];
			$subsubcategoryname = $mediarecent['subsubcategory']['subsubcategory_name'];
			
			$ext = pathinfo($mediarecent['UserMedia']['usermedia_title'], PATHINFO_EXTENSION);
			$audioextarray = array('mp3','wav','aiff','flac','MP3','WAV','AIFF','FLAC','m4a','M4A','f4a','F4A','aac','AAC','ogg','OGG','oga','OGA');
			$videoextarray = array('mp4','wav','mkv','flv','WAV','avi','3gp','MP4','MKV','FLV','AVI','3GP','mov','MOV','m4v','f4v','M4V','F4V','WebM','webm');
			$imageextarray = array('jpeg','jpg','png','JPEG','JPG','PNG');
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
			
			
			 if($coverid>0)
			 {
			 
			 	$imageusermedia_path = Router::url('/', true).$mediarecent['usermedia_cover']['usermedia_path'];
			  	 $thumbnail_path = Router::url('/', true)."files/medium/".$retuser_id."/".$mediarecent['usermedia_cover']['usermedia_title'];
				$imageusermedia_path = $thumbnail_path;
				$imagepath = $thumbnail_path;
				$pdfdefault = $thumbnail_path;
				$worddefault = $thumbnail_path;
				$vid_thumbnail_path = $thumbnail_path;
			 }
			 else
			 {
				$imagepath = Router::url('/', true)."assets/default/".lcfirst($categoryname)."_default.png";
				$pdfdefault = Router::url('/', true)."assets/default/".lcfirst($categoryname)."_default.png";
				$worddefault = Router::url('/', true)."assets/default/".lcfirst($categoryname)."_default.png";
			 }
			 
			
			?>
                <li class="col-md-3">
				<?php
			switch($mediatype)
			{
			case "image":
			?>
                        <a rel="lightbox[group]" href="<?php echo $imageusermedia_path;?>"><img class="group1" src="<?php echo $imageusermedia_path;?>" title="Image Title" style="height:210px;width:100%;" /></a>
			  <?php
			break;	
			case "audio":
			case "video":	
					if($mediatype=="video")
					{
					  $imagepath=$vid_thumbnail_path;
					}					
					?>	
				<div id='searchpage<?php echo $usermedia_id;?>' style="position: relative; height: 170px;">Loading the player...</div>	

						<script type='text/javascript'>
					var playerInstance7 = jwplayer('searchpage<?php echo $usermedia_id;?>');
					playerInstance7.setup({
					  flashplayer: '<?php echo $flashplayerpath;?>',
					  file:'<?php echo $usermedia_path;?>',
					
					  'dock': 'false',
					   'width': '100%', 'height': '210',					 
						aspectratio: "4:3",
					   image:'<?php echo $imagepath;?>',
					  class:'thumbnail audiocheck',
					   hide: true,
					  'plugins': { 'viral-2': {'oncomplete':'False','onpause':'False','functions':'All'} }
					  
				   });
				   playerInstance7.onPlay(function(e) {
					//alert('<?php echo $usermedia_id;?>');		
					 var audioFile = getCookie("currentaudio");
					
					// alert(audioFile);
					  if (audioFile != "" && audioFile !='searchpage<?php echo $usermedia_id;?>') {
						
						
						  jwplayer(audioFile).pause(true);
						
						  //alert('paused');
					  }
							//document.cookie = 'currentaudio=; expires=Thu, 01 Jan 1970 00:00:00 UTC;';	
							//setCookie("currentaudio", "<?php echo $usermedia_id;?>", 365);
							var cookieVal='searchpage<?php print($usermedia_id);?>';
							setCookie('currentaudio', cookieVal, 1);
							console.log("Setting Cookies : currentaudio = <?php echo $usermedia_id;?>" );
					});				
					</script>	
					
				<?php
					break;	
					
					case "pdf":  
				
					$url = Router::url('/', true).'websites/pdfReader/'.$usermedia_id;
					?>
					
					<a href="<?php echo $url;?>"  target="_blank"><img src="<?php echo $pdfdefault;?>" style="height:210px;width:100%;"/></a> 
					
					<?php
					break;
					
				case "word":
				?>
				<a target="_blank" href="http://docs.google.com/viewer?url=<?php echo Router::url('/',true).$usermedia_path;?>"  ><img src="<?php echo $worddefault;?>" style="height:210px;width:100%;"/></a> 
				<?php
				break;	
			}
			?>				
			<div class="gallerytext">
						<div class="medianame">
							<?php echo $this->Html->link($usermedia_name, array('controller'=>'users','action' => "art", $usermedia_id), array( 'id'=>'msg-name', 'escape' => false)); ?> <span class="pull-right">
							<?php echo $categoryname;?><?php if($subcategoryname!=""){ echo '-'.mb_strimwidth($subcategoryname,0, 12, "..");}?><?php if($subsubcategoryname!=""){ echo '-'.mb_strimwidth($subsubcategoryname,0, 12, "..");}?></span>
						</div>
						<div class="socialmedia">
						<?php echo $this->Html->link($username, array('controller'=>'users','action' => "artist", $retuser_id), array( 'id'=>'msg-name', 'escape' => false)); ?>
						
						 <div class="social-network pull-right">

                         
						
						 <div class="social-network pull-right">

                                       	<?php echo $this->Form->button('<i class="fa fa-facebook fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class', 'id'=>'facebook','value'=>'socialfacebook'.$usermedia_id, 'escape' => false)); 
												$strFURL = "https://www.facebook.com/sharer.php?u=".$usermedia_path."&t=".$usermedia_name."";
												echo $this->Form->hidden('',array('id'=>'socialfacebook'.$usermedia_id.'_process_url', 'value'=>$strFURL));?>
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
						</div>
				</div>
             </li> <!--end thumb -->
              
				<?php
			
				
	}
?>				  
             
            </ul><!--end thumbnails -->
			
			<div class="pagination pagination-large">
					<ul class="pagination">
							<?php
								echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
								echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
								echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
							?>
						</ul>
					</div>	
					<?php
}
else
{
 echo "<div class='no-result-found'>";
echo "No Items match your result";
    echo "</div>";
}
?>
        </div> <!-- /container -->

<?php 
 echo $this->Html->script('modal'); 
?>
<?php echo $this->element('mainmodallogin'); ?>
<?php echo $this->element('userLogin'); ?>
<?php echo $this->element('artistLogin'); ?>
<?php echo $this->element('forgotpass'); ?>
<?php echo $this->element('changepass'); ?>
<?php echo $this->element('artistregister'); ?>
<?php echo $this->element('userregister'); ?>
<?php echo $this->element('mainmodalregister'); ?>

 