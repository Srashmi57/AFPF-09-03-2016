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
                <!-- Span12 Start -->
               
                <div class="col-md-4 category"  >
                    <div class="category-text">
				<a href="<?php echo Router::url('/',true)?>websites"> Home</a> / <?php echo $category_name;?>
                 <span class="category-icon"><img src="<?php echo Router::url('/',true)?>images/categories-icon.png"/></span>
                   </div>
            	   <?php
			 if(count($activesubcatlist)>0)
			{?>
            <ul class="catmenus">
            <?php
			
		       foreach($activesubcatlist as $subcatlist)
			   {		
			 		   $imagename = $subcatlist['cat']['category_image'];
					   $category_id = $subcatlist['cat']['category_id'];
					   $subcategory_id = $subcatlist['Subcategory']['subcategory_id'];
					   if($imagename!="")
					   {
						   $imagepath = Router::url('/',true)."assets/subcategory/".$subcatlist['Subcategory']['subcategory_image'];
					   }
					   else
					   {
						   $imagepath = "";
					   }
					   $subcategoryUrl = Router::url(array('controller'=>'websites','action'=>'subcategory'),true)."/".$subcategory_id;
				   ?>
                    <li><a href="<?php echo $subcategoryUrl;?>"><img src="<?php echo $imagepath; ?>" /> <span class="figcaption"><?php echo $subcatlist['Subcategory']['subcategory_name'];?></span></a></li>
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
									 <span class="video-section-icon">
                                    <img src="<?php echo Router::url('/',true)?>images/video-icon.png"/>
									</span>
                            </div>
				<div class="gallry-details videosection-scroller">
				  
                             <?php
									echo $this->element('view_media_details');?>
                   </div>
                           
                            
                            
                 	 </div>
                     
                     
                     
                </div>
                <!-- Span12 End -->
            </div>

	<div class="recentupload wow fadeInUp">
	<p>RECENT UPLOADS</p>
</div>
 <div class="recentgallery">
			
			 <ul class="thumbnails" > 
			 <?php echo $this->element('recentuploads'); ?>
			 </ul>
			</div>

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
<?php echo $this->element('updatecommentmodal'); ?>