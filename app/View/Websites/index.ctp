<script>

setCookie('currentaudio', '', 1);
console.log("Setting Cookies : currentaudio = " );
</script>
<?php
echo $this->Html->css('star-rating');
echo $this->Html->script('star-rating');
$isloggedclass = $islogin>0?'':"disabled='disabled'";
echo $this->Html->script('common'); 
echo $this->Html->css('common');
echo $this->Html->css('jRating.jquery');
echo $this->Html->script('jRating.jquery');		
echo $this->Html->script('countartist');
?>
<div class="container" id="maincontent">
            <!-- Row Start -->
            <div class="row homecontent">
			<div class="homecontent_bg">
                <!-- Span12 Start -->
               
                <div class="col-md-4 category"  >
                    <div class="category-text">
                 Categories
                 <span class="category-icon"><img src="images/categories-icon.png"/></span>
                   </div>
				   <?php
			 if(count($activecatlist)>0)
			{?>
            <ul class="catmenus">
            <?php
			
		       foreach($activecatlist as $catlist)
			   {		
			 		   $imagename = $catlist['Category']['category_image'];
					   $category_id = $catlist['Category']['category_id'];
					   if($imagename!="")
					   {
						   $imagepath = Router::url('/',true)."assets/category/".$catlist['Category']['category_image'];
					   }
					   else
					   {
						   $imagepath = "";
					   }
					     $categoryUrl = Router::url(array('controller'=>'websites','action'=>'category'),true)."/".$category_id;
				   ?>
                    <li><a href="<?php echo $categoryUrl;?>"><img src="<?php echo $imagepath; ?>" /> <span class="figcaption"><?php echo $catlist['Category']['category_name'];?></span></a></li>
                   <?php
			   }
			
			   ?>
               
            </ul>
			<?php
			}
			else
			{
			 echo "<img src='".Router::url('/',true)."/assets/default/categories-screensaver.png'/>";
			}
			?>
                </div>
                  <?php echo $this->element('averageratemedia'); ?>  
                     
                     <div class="col-md-4 video-section">
                            <div class="video-text">
                                    
                                     Gallery
								<span class="video-section-icon"><img src="images/video-icon.png"></span>
									 <!--<span class="video-icon">
                                    <img src="<?php echo Router::url('/',true)?>images/video-icon.png"/></span>-->
                            </div>
				<div class="gallry-details videosection-scroller">
                   
                           <?php
							echo $this->element('view_media_details');
							?>
									
                   </div>
							
                 	 </div>
                     
                     
                     
                </div>     
                </div>
                <!-- Span12 End -->
            </div>
		
			<div class="recentupload wow fadeInUp">
	<p>RECENT UPLOADS</p>
</div>
<?php $usertype_id = $arrUser_Profile['Users']['usertype_id']; ?>
<?php
if(isset($islogin) && $usertype_id==33333){
echo '<div class="recentgallery">
 <ul class="thumbnails" id="thumbnails">';
echo $this->element('recentuploadsmypage'); 
echo '</ul></div>';
?>
<?php }else{?>
 <div class="recentgallery">
 <ul class="thumbnails" id="thumbnails"> 
 </ul>
 </div>
<?php } ?>
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
<?php echo $this->element('mainmodalregister'); 
 echo $this->Html->script('load-more');?>

<?php echo $this->element('updatecommentmodal'); ?>