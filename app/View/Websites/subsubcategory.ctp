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
				<a href="<?php echo Router::url('/',true)?>websites/subcategory/<?php echo ($parentcategory_name['subcat']['subcategory_id']) ?>"> <?php echo ($parentcategory_name['subcat']['subcategory_name']);?></a> / <?php print_r($category_name);?>
				<span class="category-icon"><img src="<?php echo Router::url('/',true)?>images/categories-icon.png"/></span>
			</div>
            <ul class="catmenus">       
            </ul>
			<?php
			echo "<div class='empty-category'>";
			if($parentcategory_name['subcat']['subcategory_id'] == 1 || $parentcategory_name['subcat']['subcategory_id'] == 2 || $parentcategory_name['subcat']['subcategory_id'] == 3 || $parentcategory_name['subcat']['subcategory_id'] == 4 || $parentcategory_name['subcat']['subcategory_id'] == 5 || $parentcategory_name['subcat']['subcategory_id'] == 6 || $parentcategory_name['subcat']['subcategory_id'] == 9 || $parentcategory_name['subcat']['subcategory_id'] == 10 || $parentcategory_name['subcat']['subcategory_id'] == 11)
			{
				echo "<img src='".Router::url('/',true)."/assets/default/music_categories-screensaver.png'/>";
			}
			if($parentcategory_name['subcat']['subcategory_id'] == 25 || $parentcategory_name['subcat']['subcategory_id'] == 26 || $parentcategory_name['subcat']['subcategory_id'] == 27 || $parentcategory_name['subcat']['subcategory_id'] == 79 || $parentcategory_name['subcat']['subcategory_id'] == 80)
			{
				echo "<img src='".Router::url('/',true)."/assets/default/film_categories-screensaver.png'/>";
			}
			if($parentcategory_name['subcat']['subcategory_id'] == 45 || $parentcategory_name['subcat']['subcategory_id'] == 46 || $parentcategory_name['subcat']['subcategory_id'] == 47 || $parentcategory_name['subcat']['subcategory_id'] == 48 || $parentcategory_name['subcat']['subcategory_id'] == 49)
			{
				echo "<img src='".Router::url('/',true)."/assets/default/litrature_categories-screensaver.png'/>";
			}
			
			if($parentcategory_name['subcat']['subcategory_id'] == 54)
			{
				echo "<img src='".Router::url('/',true)."/assets/default/art_categories-screensaver.png'/>";
			}
			echo "</div>";			
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