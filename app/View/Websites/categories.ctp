<section class="blog-small-thumbail">
	<div class="container">

		<div class="row pagetitle">
			<div class="col-xs-12">
				<h2>Categories</h2>
			</div>
		</div>	

		<div class="row">
			<div class="col-md-9">
				<div class="grid" id="resent">
					<?php		
						if(is_array($arrcategoryList) && (count($arrcategoryList) > 0))
							{	
							foreach($arrcategoryList as $val)
								{
									$strvendorUrl = Router::url(array('controller'=>'websites','action'=>'vendorslist'),true)."/".$val['wcz_categories']['category_id'];
									echo'<a href='.$strvendorUrl.'>';
										echo'<div class="item-grid">';
										
												$all = $val['wcz_categories']['category_name'];
												$string = substr($all,0,17);
												
												if($val['wcz_categories']['category_icon']=="")
												{
													echo $this->Html->image('/img/admin_img/no_imageavaialable_big.png',array('height'=>'210px'));
												}
												else
												{
													echo $this->Html->image('/websitedata/services_images/categories_icons/'.$val['wcz_categories']['category_icon'],array('height'=>'210px'));
												}
												
												echo'<p style="text-align:center">'.$string.'</p>';
										echo'</div>';
									echo'</a>';
								}
							}
					?>
				</div>
			</div>
			
			<div style="float:left;width:292px;">		
				<?php echo $this->Html->image('/websitedata/winner_car_zone_add.png');?>
			</div>	
			
		</div>
				
	</div>
</section>
	
<?php //echo $this->element('sql_dump'); ?>
	
<?php
echo'<script>window.jQuery || document.write("<script src=\"'.Router::url('/',true).'js/websitejs/jquery.min.1.9.1.js\"")</script>';

//Respond.js media queries for IE8
echo $this->Html->script('websitejs/respond.min');

// Bootstrap 
echo $this->Html->script('websitejs/bootstrap.min');

// Retina.js
echo $this->Html->script('websitejs/retina');

//Placeholder.js http://widgetulous.com/placeholderjs/
echo $this->Html->script('websitejs/placeholder');

// Go to top
echo $this->Html->script('websitejs/jquery.scrollTo-1.4.3.1-min');


//echo $this->Html->script('websitejs/fancybox/jquery.fancybox');

// Slider Revolution
echo $this->Html->script('websitejs/plugins/revolution/js/jquery.themepunch.plugins.min');
echo $this->Html->script('websitejs/plugins/revolution/js/jquery.themepunch.revolution.min');

// Custom
echo $this->Html->script('websitejs/script');
echo $this->Html->script('jquery/jquery.form');	
echo $this->Html->script('http://maps.google.com/maps/api/js?latitude=18.566644,longitude=73.915407&sensor=true', false);
?>