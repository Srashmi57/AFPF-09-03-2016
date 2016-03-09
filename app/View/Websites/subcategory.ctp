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
					<a href="<?php echo Router::url('/',true)?>websites/category/<?php echo ($parentcategory_name['cat']['category_id']) ?>"> <?php echo ($parentcategory_name['cat']['category_name']);?></a> / <?php print_r($category_name);?>
					<span class="category-icon"><img src="<?php echo Router::url('/',true)?>images/categories-icon.png"/></span>
			</div>
			<?php
			if(count($activesubsubcatlist)>0)
			{
				?>
				<ul class="catmenus">
					<?php
						foreach($activesubsubcatlist as $subsubcatlist)
						{		
							$imagename = $subsubcatlist['cat']['category_image'];
							$subsubcategory_id = $subsubcatlist['Subsubcategory']['subsubcategory_id'];
							$category_id = $subsubcatlist['cat']['category_id'];
							if($imagename!="")
							{
								$imagepath = Router::url('/',true)."assets/subsubcategory/".$subsubcatlist['Subsubcategory']['subsubcategory_image'];
							}
							else
							{
							   $imagepath = "";
							}
							$subsubcategoryUrl = Router::url(array('controller'=>'websites','action'=>'subsubcategory'),true)."/".$subsubcategory_id;
							?>
							<li>
								<a href="<?php echo $subsubcategoryUrl;?>"><img src="<?php echo $imagepath; ?>" /> <span class="figcaption">
								<?php echo $subsubcatlist['Subsubcategory']['subsubcategory_name'];?></span></a>
							</li>
							<?php
						}
					?>
				</ul>
				<?php
			}
			else
			{
				echo "<div class='categories-screensaver'>";
				if($parentcategory_name['cat']['category_id']==1)
				{					
					echo "<img src='".Router::url('/',true)."/assets/default/music_categories-screensaver.png'/>";
				
				}
				if($parentcategory_name['cat']['category_id']==2)
				{					
					echo "<img src='".Router::url('/',true)."/assets/default/dance_categories-screensaver.png'/>";
				
				}
				if($parentcategory_name['cat']['category_id']==4)
				{					
					echo "<img src='".Router::url('/',true)."/assets/default/photography_categories-screensaver.png'/>";				
				}
				if($parentcategory_name['cat']['category_id']==5)
				{					
					echo "<img src='".Router::url('/',true)."/assets/default/freestyle_categories-screensaver.png'/>";				
				}
				if($parentcategory_name['cat']['category_id']==6)
				{					
					echo "<img src='".Router::url('/',true)."/assets/default/other_categories-screensaver.png'/>";				
				}
				if($parentcategory_name['cat']['category_id']==7)
				{					
					echo "<img src='".Router::url('/',true)."/assets/default/litrature_categories-screensaver.png'/>";				
				}
				if($parentcategory_name['cat']['category_id']==8)
				{					
					echo "<img src='".Router::url('/',true)."/assets/default/art_categories-screensaver.png'/>";				
				}
				if($parentcategory_name['cat']['category_id']==9)
				{					
					echo "<img src='".Router::url('/',true)."/assets/default/personality_categories-screensaver.png'/>";				
				}
				/*else
				{
					echo "<img src='".Router::url('/',true)."/assets/default/categories-screensaver.png'/>";
				}*/
				echo "</div>";
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
					echo $this->element('view_media_details');
				?>
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