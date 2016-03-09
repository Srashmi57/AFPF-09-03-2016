<style type="text/css">
.jw-reset{background-position: 0% 0% !important;}
.recent_cat_text{    
color: #fff;
    font-size: 9px;
    font-weight: 700;
    position: absolute;
    display: block;
    width: 75px;
    text-transform: uppercase;
    top: 57px;
    text-align: center;}
.recent_cat_img{    
width:120px;height:120px;position: absolute;top: 9%;
}
.recent_cat_star{    
	width:90.5%;height:33px;position: absolute !important;left:15px;z-index: 101;background: #2e2e2e;padding: 5px;
}
@-moz-document url-prefix() {
   .recent_cat_star{    
	width:90.5%;height:25px;position: absolute !important;left:15px;z-index: 101;background: #2e2e2e;
	.jRate_viewindex{width:115px !important}
}
}
#popup {
    position: absolute;
    display: none;
    z-index: 120;
    
}
.jRate_viewindex{width:113px !important}
</style>
<script>jwplayer.key="O+FYs7sL4MmPQTrTnzu4GnKoKGao3KAW+AQ/PA==";</script>
 <script>
$(document).ready(function(){
	$("[rel^='lightbox']").prettyPhoto();
	//document.cookie = "currentaudio = ;";
 });
</script>

<?php 
	$flashplayerpath = Router::url('/', true)."js/jwplayer/player.swf";
	
    $p=0;	
	foreach($recentmedia as $mediarecent )	
	{	
		$umedia_id = $mediarecent['UserMedia']['usermedia_id'];
		$user_id = $mediarecent['UserMedia']['user_id'];
	    if($MediaRating[$p][0]['MediaRating']['usermedia_id']==$umedia_id){
			$viewmediarateid = $MediaRating[$p][0]['MediaRating']['mediarating_id'];
		    $viewmediarateing = $MediaRating[$p][0]['MediaRating']['media_rating'];
		 } else {
		 
			$viewmediarateid = 0;
		    $viewmediarateing = 0;
		 }
         
		
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
										if($user_id==$islogin)
										{
										  $likedisable="style='display:none;'";
										}
										else
										{
										$likedisable="";
										}
								
									
						if(($islogin>0)&&($user_id==$islogin))
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
		$days=0;
		$usermedia_id = $mediarecent['UserMedia']['usermedia_id'];
		$user_id = $mediarecent['UserMedia']['user_id'];
		$usermedia_path = Router::url('/', true).$mediarecent['UserMedia']['usermedia_path'];
		$thumbnail_path = Router::url('/', true)."files/medium/".$user_id."/".$mediarecent['UserMedia']['usermedia_title'];
		$vid_thumbnail_path = Router::url('/', true).$mediarecent['UserMedia']['video_thumbnail'];
		$usermedia_title = $mediarecent['UserMedia']['usermedia_title'];			
		$usermedia_name = $mediarecent['UserMedia']['usermedia_name'];
		$usermedia_type = $mediarecent['UserMedia']['usermedia_type'];
		$arraymediatype = explode('/',$usermedia_type);
		$userfname = $mediarecent['users']['user_fname'];
		$usermedia_date = $mediarecent['UserMedia']['usermedia_date'];
		$coverid = $mediarecent['UserMedia']['cover_id'];
		$ratecoverid = $mediarecent['UserMedia']['cover_id'];
		$categoryname = $mediarecent['category']['category_name'];
		$subcategoryname = $mediarecent['subcategory']['subcategory_name'];
		$susubcategoryname = $mediarecent['subsubcategory']['subsubcategory_name'];
		$imageusermedia_path = $thumbnail_path;
		if($coverid>0)
		{
			//$imageusermedia_path = Router::url('/', true).$mediarecent['children']['UserMedia']['usermedia_path'];
			$thumbnail_path = Router::url('/', true)."files/medium/".$user_id."/".$mediarecent['children']['UserMedia']['usermedia_title'];
			$imageusermedia_path = $thumbnail_path;
			
			$pdfdefault = $thumbnail_path;
			 $audioimagepath = Router::url('/', true)."files/".$user_id."/".$mediarecent['children']['UserMedia']['usermedia_title'];;
			 $vid_thumbnail_path = Router::url('/', true)."files/".$user_id."/".$mediarecent['children']['UserMedia']['usermedia_title'];;
			$worddefault = $thumbnail_path;
			$thumbnail_path =Router::url('/', true)."files/medium/".$user_id."/".$mediarecent['UserMedia']['usermedia_title'];
		}
		else
		{
			$imageusermedia_path = $thumbnail_path;
			$audioimagepath = Router::url('/', true)."assets/default/".lcfirst($categoryname)."_default.jpg";
			$pdfdefault = Router::url('/', true)."assets/default/".lcfirst($categoryname)."_default.jpg";
			if($categoryname=='Literature'){
				$worddefault = Router::url('/', true)."assets/default/".lcfirst($categoryname)."_default007.jpg";
			}else{
			$worddefault = Router::url('/', true)."assets/default/".lcfirst($categoryname)."_default.jpg";
			}
		}
		
		$ext = pathinfo($mediarecent['UserMedia']['usermedia_title'], PATHINFO_EXTENSION);
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
		$now = date('Y-m-d H:i:s');		
		$days	= $this->Caldays->checkdates($now,$usermedia_date);				
		$userlname = $mediarecent['users']['user_lname'];		
		if($mediarecent['users']['user_display_name']!="")
		{
			$username = $mediarecent['users']['user_display_name'];
		}
		else
		{
			$username = $userfname." ".$userlname;
		}
		$retuser_id = $mediarecent['users']['user_id'];	

		$loggeduserid = $this->Session->read('Auth.WebsitesUser.user_id');		
		?>
		<li class="col-md-3">
		<?php 
		if($ratecoverid>0 || $mediatype=='image' || $mediatype=='video')
		{
		?>
		 <img src="http://artformplatform.com/afpf/assets/recent/Category_image_<?php echo $mediarecent['UserMedia']['category_id'];?>.png" class="recent_cat_img" style="z-index: 100;"/>
		 <!-- <span class="figcaption recent_cat_text"><?php echo $categoryname;?></span> -->
		 <?php 
		 } ?>
		 <div class="recent_cat_star">
			
			<!-- star functionality -->
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
												   bigStarsPath:'<?php echo Router::url('/',true);?>icons/star_new.png',
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
													   bigStarsPath:'<?php echo Router::url('/',true);?>icons/star_new.png',
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
				
                            	 </div>
			<!-- End here -->
		 </div>
			<?php
			switch($mediatype)
			{
				case "image":
					?>
					     <a rel="lightbox[group]" href="<?php echo $thumbnail_path;?>"><img class="group1" src="<?php echo $imageusermedia_path;?>" title="Image Title"  style="height:210px;width:100%;"/></a>
					<?php
				break;	
				case "audio": 
				case "video":	
				$usermedia_path = Router::url('/', true).$mediarecent['UserMedia']['usermedia_path'];
				if($mediatype=="video")
					{
					  $audioimagepath = $vid_thumbnail_path;
					}
					
					?>	
					<div id='indexhome<?php echo $usermedia_id;?>' class='audiocheck'>Loading the player...</div>	
					<script type='text/javascript'>
						var playerInstance1 = jwplayer('indexhome<?php echo $usermedia_id;?>');
						
						playerInstance1.setup({
							flashplayer: '<?php echo $flashplayerpath;?>',
							file:'<?php echo $usermedia_path;?>',				
							'dock': 'false',
							'controls':'true',
							'width': '100%', 'height': '100%',					 
							aspectratio: "4:3",
							playButton: '<?php echo Router::url('/', true);?>play_icon.png',
							image:'<?php echo $audioimagepath;?>',
							class:'thumbnail audiocheck',
							hide: true,
							'plugins': { 'viral-2': {'oncomplete':'False','onpause':'False','functions':'All'} }				  
						});
						
						playerInstance1.onPlay(function(e) {
							//alert('<?php echo $usermedia_id;?>');		
							var audioFile = getCookie("currentaudio");
							$('.playpauseaudio').attr('play','0');
					$('.playpauseaudio img').attr('src','<?php echo Router::url('/',true)?>images/play_new.png');
							//alert(audioFile);
							if (audioFile != "" && audioFile !='indexhome<?php echo $usermedia_id;?>') {
								//alert('yes pause previous');
							//	alert(audioFile.indexOf("indexhome"));
							
								
									
								 
								 
									jwplayer(audioFile).pause();
								 
								
								
								
							//	alert('paused');
							}
							//document.cookie = 'currentaudio=; expires=Thu, 01 Jan 1970 00:00:00 UTC;';	
							//setCookie("currentaudio", "<?php echo $usermedia_id;?>", 365);
							var cookieVal='indexhome<?php print($usermedia_id);?>';
							setCookie('currentaudio', cookieVal, 365);
							console.log("Setting Cookies : currentaudio = <?php echo $usermedia_id;?>" );
						});				
					</script>						
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
						<a target="_blank" href="http://docs.google.com/viewer?url=<?php echo $usermedia_path;?>"  ><img src="<?php echo $worddefault;?>" style="height:210px;width:100%;" /></a>
					<?php	
				break;
			}		
			?>				
			<div class="gallerytext">
				<div class="medianame" id="getpos_<?php echo $usermedia_id;?>">
					<?php 
						echo $this->Html->link(mb_strimwidth($usermedia_name,0, 12, ".."), array('controller'=>'users','action' => "art", $usermedia_id), array( 'id'=>'msg-name', 'escape' => false)); ?> <div class="pull-right media-name"> <?php echo $categoryname;?> <?php if($susubcategoryname!=""){echo " - <span class='subsubcat_name'>".mb_strimwidth($susubcategoryname,0, 12, "..")."</span>";}else{{echo " - <span class='subsubcat_name'>".mb_strimwidth($subcategoryname,0, 12, "..")."</span>";}}?> </div> &nbsp;
						
					<?php 
if($loggeduserid>0)
{					
						/* echo $this->Html->link(
						   $this->Html->tag('i', '', array('class' => 'fa fa-comment fa-1x')) ,
						   array('controller'=>'users','action' => 'artist',$retuser_id),
						   array('class' => 'button_class button comment_class', 'escape' => false)
						); */
						echo '<a class="popClass" id="'.$usermedia_id.'" onclick="showPoPdiv(event,'.$usermedia_id.')"><i class="fa fa-comment fa-1x"></i></a>';
}
else
{
?>

<?php
			 echo $this->Form->button('<i class="fa fa-comment fa-1x"></i>', array('type'=>'button','onclick'=>"javascript:bootbox.alert('Please login to comment');",'name'=>'comment', 'escape' => false)); 

			 ?>
			 
			 			 <?php

					
}

					?>
					
				</div>	
				<div class="socialmedia">
					<?php 
						echo $this->Html->link($username, array('controller'=>'users','action' => "artist", $retuser_id), array( 'id'=>'msg-name', 'escape' => false)); 
					?>
					<div class="social-network pull-right">
						<?php echo $this->Form->button('<i class="fa fa-facebook fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class', 'id'=>'facebook','value'=>'socialfacebook'.$usermedia_id, 'escape' => false)); 
						$strFURL = "https://www.facebook.com/sharer.php?u=".$usermedia_path."&t=".$usermedia_name."";
						echo $this->Form->hidden('',array('id'=>'socialfacebook'.$usermedia_id.'_process_url', 'value'=>$strFURL));
						?>
						<?php	
							
							//echo $this->Form->button('<i class="fa fa-linkedin fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class','id'=>'linkedin','value'=>'sociallinkedin'.$usermedia_id)); 
							$strFURL = "http://www.linkedin.com/shareArticle?mini=true&url=".$usermedia_path."";
							echo $this->Form->hidden('',array('id'=>'sociallinkedin'.$usermedia_id.'_process_url', 'value'=>$strFURL));
													
						?>
						<?php							
							//echo $this->Form->button('<i class="fa fa-google-plus fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class','id'=>'gmail', 'value'=>'socialgmail'.$usermedia_id)); 
							$strFURL = "https://plus.google.com/share?url=".$usermedia_path."&hl=en";
							echo $this->Form->hidden('',array('id'=>'socialgmail'.$usermedia_id.'_process_url', 'value'=>$strFURL));
						?>					
						<?php							
							echo $this->Form->button('<i class="fa fa-twitter fa-1x"></i>', array('type'=>'button','onclick'=>'fnSocialRegister(this)','name'=>'social_media_button','class'=>'button_class','id'=>'twitter', 'value'=>'socialtwitter'.$usermedia_id)); 
							$strFURL = "http://www.twitter.com/share?url=".$usermedia_path."&text=".$usermedia_name."";
							echo $this->Form->hidden('',array('id'=>'socialtwitter'.$usermedia_id.'_process_url', 'value'=>$strFURL));												
						?>
                       <a data-original-title="Pinterest" title="" data-placement="top" data-rel="tooltip" href="https://in.pinterest.com/artformplatform/" target="_blank" rel="tooltip"><i class="fa fa-pinterest fa-1x"></i></a>
                       <a data-original-title="Instagram" title="" data-placement="top" data-rel="tooltip" href="https://instagram.com/artformplatform" target="_blank" rel="tooltip"><i class="fa fa-instagram fa-1x"></i></a>					   
					</div>
					<div class="publish-date"><?php echo $days; ?> </div>
				</div>
			</div>
		</li> <!--end thumb -->
		<?php
		$p++;
	}
?>
<div id="popup" class="col-md-3">
  <div class="modal-dialog">
    <div class="modal-content" style="width: 326px;">
         
      
      <div class="modal-header">
	      <button type="button" class="close" onclick="hidediv();" style="height: 28px;margin-top: 9px;"><img src="<?php echo Router::url('/',true)?>images/close-icon.png" width="30" height="30px" style="margin-top: -24px;"></button>
        <h4 class="modal-title" style="padding: 2px 4px;">Give comment</h4>
      </div>
			  <div class="modal-body showRecentPost" style="max-height: 185px;background-color: #CCC;">
                
			</div>
      

	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div>
  
  
<script type="text/javascript">
function showPoPdiv(e,e1){
 
 var evt = e ? e:window.event;
 var clickX=0, clickY=0;
 var yy=0, xx=0;
 if ((evt.clientX || evt.clientY) &&
     document.body &&
     document.body.scrollLeft!=null) {
  clickX = evt.clientX + document.body.scrollLeft;
  clickY = evt.clientY + document.body.scrollTop;
 }
 if ((evt.clientX || evt.clientY) &&
     document.compatMode=='CSS1Compat' && 
     document.documentElement && 
     document.documentElement.scrollLeft!=null) {
  clickX = evt.clientX + document.documentElement.scrollLeft;
  clickY = evt.clientY + document.documentElement.scrollTop;
 }
 if (evt.pageX || evt.pageY) {
  clickX = evt.pageX;
  clickY = evt.pageY;
 }
 
 /* alert (evt.type.toUpperCase() + ' mouse event:'
  +'\n pageX = ' + clickX
  +'\n pageY = ' + clickY 
  +'\n clientX = ' + evt.clientX
  +'\n clientY = '  + evt.clientY 
  +'\n screenX = ' + evt.screenX 
  +'\n screenY = ' + evt.screenY
 ) */
  $('#popup').hide(); 
   // var uploadedmediaid = $(this).attr('id');
	var uploadedmediaid = e1;
    $(".showRecentPost").html("");
    $('.performer-info').removeClass('active');
	$(this).parents('.performer-info').addClass('active');
	
	$('.cms-bgloader-mask').show();//show loader mask
	$('.cms-bgloader').show(); //show loading image
   	$.ajax({ 
			type: "GET",
			url: strGlobalSiteBasePath+"users/showAvgartistmediaPopup/"+uploadedmediaid+"/<?php echo $this->request->params['action']; ?>",
			dataType: 'json',
			data:"",
			cache:false,
			success: function(data)
			{
			
				if(data.status == "success")
				{
				   //alert(e.pageY);
				   //alert(e.pageX);
					 yy = clickY;
					 xx = clickX - 92;
					//$("#popup").modal('show');
			        $('#popup').css({ top: yy, left:  xx}).show(); 
					$('.showRecentPost').html(data.content);
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
function hidediv(){
$('#popup').hide();
}

</script>