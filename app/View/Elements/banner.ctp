<div class="banner wow fadeInLeft" >
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  
  <ol class="carousel-indicators indicators">
  <?php
  for($i=0;$i<count($websitebanners);$i++)
  {
	 $activeclass = $i==0? 'active':  '';
	?>
    <li data-target="#carousel-example-generic" data-slide-to="0" class="<?php echo $activeclass; ?>"></li>
   
   
	<?php
  }?>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
  <?php
  $count=0;
  foreach($websitebanners as $banners)
  {
	   $bannertitle = stripslashes($banners['banner']['banner_title']);
	   $banner_id = $banners['banner']['banner_id'];
	   $bannersubtitle = stripslashes($banners['banner']['banner_subtitle']);
	   $bannerimage = $banners['banner']['banner_image'];
	   
	   $activeclass = $count==0? 'active':  '';
	   $bannerimagepath = Router::url('/',true)."assets/banner/".$bannerimage;
 ?>
    <div class="item <?php echo $activeclass;?>">
      <img src="<?php echo $bannerimagepath;?>" alt="...">
    <!--   <div class="carousel-caption">
	 <div class="slider-heading">
       <h1><?php echo $bannertitle;?></h1>
        <p><?php echo $bannersubtitle;?></p>
		</div>
      </div> -->
    </div>
    <?php
	$count++;
     }
  ?>
    
    
	
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <!-- <span class="glyphicon glyphicon-chevron-left"></span> -->
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <!-- <span class="glyphicon glyphicon-chevron-right"></span> -->
    <span class="sr-only">Next</span>
  </a>
</div>

    </div>
