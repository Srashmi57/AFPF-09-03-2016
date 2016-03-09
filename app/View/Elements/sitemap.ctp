<div class="container" id="maincontent">
            <!-- Row Start -->
            <div class="row homecontent">
                <!-- Span12 Start -->
               <?php
			   $privacyUrl = Router::url(array('controller'=>'websites','action'=>'privacypolicy'),true);
		$aboutusUrl = Router::url(array('controller'=>'websites','action'=>'aboutus'),true);?>
<div class="container">
            <div class="sitemap">

				<ul class="sitemap">
				<li><a href="<?php echo $aboutusUrl;?>">About Us</a></li>
				<li><a href="<?php echo $privacyUrl;?>">Privacy Policy</a></li>
				<?php
				
				foreach($arr_CategoryList as $catkey => $catvalue)
				{
					$category_id = $catkey;
					$category_name = $catvalue;
					$catUrl = "websites/category/".$category_id;
					if($catkey!=0)
					{
					?>
						<li><a href="<?php echo Router::url('/', true)."".$catUrl?>"><?php echo $category_name;?></a></li>
					<?php
					}
				}
				?>
				</ul>
					
			
			
			</div>
			                    
					</div>    
                </div>
                <!-- Span12 End -->
          </div>