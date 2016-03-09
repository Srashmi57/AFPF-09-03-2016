<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
        <?php echo "Winner Car Zone"; ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<?php
		echo $this->Html->meta('icon');
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
		// Bootstrap
		echo $this->Html->css('websitecss/bootstrap');
		
		// Slider Revolution
		echo $this->Html->css('websitecss/plugins/revolution/css/settings');
		
		// Font icons
		echo $this->Html->css('websitecss/fontello');
		
		// [if IE 7]
		//echo $this->Html->css('websitecss/fontello-ie7');
		echo $this->Html->css('websitecss/styles');
		echo $this->Html->css('websitecss/media-queries');
	?>
<?php //$brandName = $arrVehicleBrandList['wcz_brand']['brand_id']; ?>
	
	<script type="text/javascript">
function test() 
	{
	    //alert('hi');
            var id = '#bybrandpopup';
	    var maskHeight = $(document).height();
            var maskWidth = $(window).width();

            $('#QRmask').css({ 'width': maskWidth, 'height': maskHeight });

            $('#QRmask').fadeIn(1000);
            $('#QRmask').fadeTo("slow", 0.8);

            var winH = $(window).height();
            var winW = $(window).width();

            $(id).css('top', winH / 2 - $(id).height() / 2);
            $(id).css('left', winW / 2 - $(id).width() / 2);

            $(id).fadeIn(200);
            //alert(strMsg);
            //$('span#lblAlertMsg').val(strMsg);
            return false;
        }	
	
	function price() 
	{
	    //alert('hi');
            
	    var id = '#byprice';
            var maskHeight = $(document).height();
            var maskWidth = $(window).width();

            $('#QRmask').css({ 'width': maskWidth, 'height': maskHeight });

            $('#QRmask').fadeIn(1000);
            $('#QRmask').fadeTo("slow", 0.8);

            var winH = $(window).height();
            var winW = $(window).width();

            $(id).css('top', winH / 2 - $(id).height() / 2);
            $(id).css('left', winW / 2 - $(id).width() / 2);

            $(id).fadeIn(200);
            //alert(strMsg);
            //$('span#lblAlertMsg').val(strMsg);
            return false;
        }
	function year() 
	{
	    //alert('hi');
            
	    var id = '#byyear';
            var maskHeight = $(document).height();
            var maskWidth = $(window).width();

            $('#QRmask').css({ 'width': maskWidth, 'height': maskHeight });

            $('#QRmask').fadeIn(1000);
            $('#QRmask').fadeTo("slow", 0.8);

            var winH = $(window).height();
            var winW = $(window).width();

            $(id).css('top', winH / 2 - $(id).height() / 2);
            $(id).css('left', winW / 2 - $(id).width() / 2);

            $(id).fadeIn(200);
            //alert(strMsg);
            //$('span#lblAlertMsg').val(strMsg);
            return false;
        }
	function kilometers() 
	{
	    //alert('hi');
            
	    var id = '#bykilometers';
            var maskHeight = $(document).height();
            var maskWidth = $(window).width();

            $('#QRmask').css({ 'width': maskWidth, 'height': maskHeight });

            $('#QRmask').fadeIn(1000);
            $('#QRmask').fadeTo("slow", 0.8);

            var winH = $(window).height();
            var winW = $(window).width();

            $(id).css('top', winH / 2 - $(id).height() / 2);
            $(id).css('left', winW / 2 - $(id).width() / 2);

            $(id).fadeIn(200);
            //alert(strMsg);
            //$('span#lblAlertMsg').val(strMsg);
            return false;
        }
	
	function fuel() 
	{
	    //alert('hi');
            
	    var id = '#byfuel';
            var maskHeight = $(document).height();
            var maskWidth = $(window).width();

            $('#QRmask').css({ 'width': maskWidth, 'height': maskHeight });

            $('#QRmask').fadeIn(1000);
            $('#QRmask').fadeTo("slow", 0.8);

            var winH = $(window).height();
            var winW = $(window).width();

            $(id).css('top', winH / 2 - $(id).height() / 2);
            $(id).css('left', winW / 2 - $(id).width() / 2);

            $(id).fadeIn(200);
            //alert(strMsg);
            //$('span#lblAlertMsg').val(strMsg);
            return false;
        }
	function fnByBrandProcessClose()
	{
		$('#bybrandpopup').hide();
        return false;
	
	}
	function fnByFuelProcessClose()
	{
		$('#byfuel').hide();
        return false;
	
	}
	function fnByPriceProcessClose()
	{
		$('#byprice').hide();
        return false;
	
	}
	function fnByKiloProcessClose()
	{
		$('#bykilometers').hide();
        return false;
	
	}
	function fnByYearProcessClose()
	{
		$('#byyear').hide();
        return false;
	
	}

	
</script>

<script type="text/javascript">
	
		var strGlobalSiteBasePath = '<?php echo Router::url('/',true); ?>';
    
    </script>
</head>
<body>
    <div id="bybrandpopup" class="alertgeneric-popup">
    	<?php 
		$strSearchBrandUrl = Router::url(array('controller'=>'websites','action'=>'searchbybrand'),true);
		//echo $this->Form->create('Search',array('action'=>$strSearchBrandUrl));
	?>
	<form name="searchbrandform" id="searchbrandform" action="<?php echo $strSearchBrandUrl; ?>" method="POST">
		<label>please select</label>
		<?php  echo $this->Form->input('brand',array('id'=>'VehicleVehicleBrand','label'=>'Brand','type'=>'select','options'=>$arrVehicleBrandList,'onChange'=>'fnGetModelList(this.value)'));?></br>
		<?php  echo $this->Form->input('model',array('id'=>'VehicleVehicleModel','label'=>'Model','type'=>'select','options'=>$arrVehicleModelList,'onChange'=>'fnGetVariantList(this.value)'));?></br>
		<?php  echo $this->Form->input('variant',array('id'=>'VehicleVehicleVariant','label'=>'Variant','type'=>'select','options'=>$arrVehicleVariantList));?></br>
		<input type="submit" name="submit" id="submit" value="Submit Information" />
		<input type="button" name="Cancel" value="Cancel" onclick="fnByBrandProcessClose();" class="alertgeneric_pop_cancel" />
	</form>
 
  </div>  
  
  <div id="byprice" class="alertgeneric-popup">
    	<?php 
		$strSearchBrandUrl = Router::url(array('controller'=>'websites','action'=>'searchbyprice'),true);
		//echo $this->Form->create('Search',array('action'=>$strSearchBrandUrl));
	?>
	<form name="searchpriceform" id="searchpriceform" action="<?php echo $strSearchBrandUrl; ?>" method="POST">
		<?php echo $this->Form->input('price',array('class' => 'form-control','label'=>'Price ranges','type'=>'select','options'=>array('1-100000'=>'less than 1 lac','100000-200000'=>'1 to 2 lac','200000-300000'=>'2 to 3 lac','300000-400000'=>'3 to 4 lac')));?>
		<input type="submit" name="submit" id="submit" value="Submit Information" class="btn" />
		<input type="button" name="Cancel" value="Cancel" onclick="fnByPriceProcessClose();" class="alertgeneric_pop_cancel" />
	</form>
 
  </div>  
  
  <div id="byyear" class="alertgeneric-popup">
    	<?php 
		$strSearchBrandUrl = Router::url(array('controller'=>'websites','action'=>'searchbyyear'),true);
		//echo $this->Form->create('Search',array('action'=>$strSearchBrandUrl));
	?>
	<form name="searchyearform" id="searchyearform" action="<?php echo $strSearchBrandUrl; ?>" method="POST">
		<?php echo $this->Form->input('year',array('class' => 'form-control','label'=>'Years','type'=>'select','options'=>array('2003'=>'2003','2004'=>'2004','2005'=>'2005','2006'=>'2006','2007'=>'2007','2008'=>'2008','2009'=>'2009','2010'=>'2010','2011'=>'2011','2012'=>'2012','2013'=>'2013')));?>
		<input type="submit" name="submit" id="submit" value="Submit Information" class="btn" />
		<input type="button" name="Cancel" value="Cancel" onclick="fnByYearProcessClose();" class="alertgeneric_pop_cancel" />
	</form>
 
  </div>  
  
  <div id="bykilometers" class="alertgeneric-popup">
    	<?php 
		$strSearchBrandUrl = Router::url(array('controller'=>'websites','action'=>'searchbykilo'),true);
		//echo $this->Form->create('Search',array('action'=>$strSearchBrandUrl));
	?>
	<form name="searchkilometersform" id="searchkilometersform" action="<?php echo $strSearchBrandUrl; ?>" method="POST">
		<?php echo $this->Form->input('kilometers',array('class' => 'form-control','label'=>'kilometers','type'=>'select','options'=>array('0-5000'=>'0 to 5 thousand','5000-10000'=>'5 to 10 thousands','10000-20000'=>'10 to 20 thousands','20000-30000'=>'20 to 30 thousands')));?>
		<input type="submit" name="submit" id="submit" value="Submit Information" class="btn" />
		<input type="button" name="Cancel" value="Cancel" onclick="fnByKiloProcessClose();" class="alertgeneric_pop_cancel" />
	</form>
 
  </div>  
  
  <div id="byfuel" class="alertgeneric-popup">
    	<?php 
		$strSearchBrandUrl = Router::url(array('controller'=>'websites','action'=>'searchbyfuel'),true);
		//echo $this->Form->create('Search',array('action'=>$strSearchBrandUrl));
	?>
	<form name="searchfuelform" id="searchfuelform" action="<?php echo $strSearchBrandUrl; ?>" method="POST">
		<?php echo $this->Form->input('fuel',array('class' => 'form-control','label'=>'Fual Type &nbsp;<span>*</span>','type'=>'select','options'=>array('Petrol'=>'Petrol','Diesel'=>'Diesel','LPG'=>'LPG','CNG'=>'CNG')));?>
		<input type="submit" name="submit" id="submit" value="Submit Information" class="btn" />
		<input type="button" name="Cancel" value="Cancel" onclick="fnByFuelProcessClose();" class="alertgeneric_pop_cancel" />
	</form>
 
  </div>  
  
    <?php
		$strBasePath = Router::url('/',true);
	?>
	<!-- Start Header Tag -->
	<header>
		<html>
<!-- begin Top Bar -->
		<div class="topbar" >
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<ul id="topmenu">
						<li><a href="#">Login</a></li>
						<!--<li><a href="#">About</a></li>-->
						<!--<li><a href="#">Sitemap</a></li>-->
						<!--<li><a href="contact.html">Contact</a></li>-->
						<!---<li><a href="#">Locate a Store</a></li>-->
						<li><a href="#">Live Chat</a></li>
						<li><a href="#">Call us: +5656 4848 155</a></li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="col-sm-6 col-offset-sm-4 col-md-3">
					<ul id="topsocial">
						<li><a href="#"><i class="icon-facebook"></i></a></li>
						<li><a href="#"><i class="icon-gplus"></i></a></li>
						<li><a href="#"><i class="icon-linkedin"></i></a></li>
						<li><a href="#"><i class="icon-twitter"></i></a></li>
					</ul>
				</div>
				<!--<div class="col-sm-2 col-md-1">
					<div class="dropdown pull-right" id="language" >
						<a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#" class="btn_lang en_gb"><span class="sr-only">United Kingdom</span><span class="caret"></span></a>
						
						<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
							<li role="presentation"><a role="menuitem" href="#" class="en_gb">English</a></li>
							<li role="presentation"><a role="menuitem" href="#" class="es_es">Español</a></li>
							<li role="presentation"><a role="menuitem" href="#" class="fr_fr">Français</a></li>
							<li role="presentation"><a role="menuitem" href="#" class="pt_br">Português</a></li>
						</ul>
					</div>
				</div>-->
			</div>

		</div>
		</div>
		</html>
		<!-- end Top Bar -->
		<!-- begin NavBar -->
		<nav class="navbar" role="navigation">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.html"></a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<li class="active">
                    <?php echo $this->Html->link('Home',array('controller'=>'websites','action'=>'index')); ?>
                    <!-- <a href="index.html">Home</a></li>-->
					<li class="buy" >
						<a href="buy.html">Buy a Car</a>
						<div class="menu-buy">
							<span class="arrow"></span>
							<button class="btn btn-sm red">View all vehicles</button>
							<div class="clearfix"></div>
							<div class="items">
								<a 
									href="car.html"
									data-title="2013 Volvo V40 Cross"
									data-desc= "Plenty of smart and fun options to make you fall in love with your car."
									data-img = "<?php echo Router::url('/',true); ?>img/vimages/buy/car-menu01.jpg"
								>
									<img src="<?php echo Router::url('/',true); ?>img/vimages/buy/car-menu01.jpg" alt="//">
									<strong>Volvo V40</strong>
									<span>Starting at $26,000</span>
								</a>
								<a 
									href="car.html"
									data-title="2014 Mercedes A45 AMG"
									data-desc= "Plenty of smart and fun options to make you fall in love with your car."
									data-img = "<?php echo Router::url('/',true); ?>img/vimages/buy/car-menu02.jpg"
								>
									<img src="<?php echo Router::url('/',true); ?>img/vimages/buy/car-menu02.jpg" alt="//">
									<strong>Mercedes A45</strong>
									<span>Starting at $26,000</span>
								</a>
								<a 
									href="car.html"
									data-title="2014 Kia Koup Turbo"
									data-desc= "Plenty of smart and fun options to make you fall in love with your car."
									data-img = "<?php echo Router::url('/',true); ?>img/vimages/buy/car-menu03.jpg"
								>
									<img src="<?php echo Router::url('/',true); ?>img/vimages/buy/car-menu03.jpg" alt="//">
									<strong>Kia Koup</strong>
									<span>Starting at $26,000</span>
								</a>
								<a 
									href="car.html"
									data-title="2013 Peugeot RCZ"
									data-desc= "Plenty of smart and fun options to make you fall in love with your car."
									data-img = "<?php echo Router::url('/',true); ?>img/vimages/buy/car-menu04.jpg"
								>
									<img src="<?php echo Router::url('/',true); ?>img/vimages/buy/car-menu04.jpg" alt="//">
									<strong>Peugeot RCZ</strong>
									<span>Starting at $26,000</span>
								</a>
								<a 
									href="car.html"
									data-title="2013 Ford Kuga"
									data-desc= "Plenty of smart and fun options to make you fall in love with your car."
									data-img = "<?php echo Router::url('/',true); ?>img/vimages/buy/car-menu05.jpg"
								>
									<img src="<?php echo $this->Html->url; ?>img/vimages/buy/car-menu05.jpg" alt="//">
									<strong>Ford Kuga</strong>
									<span>Starting at $26,000</span>
								</a>
								<a 
									href="car.html"
									data-title="2014 Peugeot RCZ"
									data-desc= "Plenty of smart and fun options to make you fall in love with your car."
									data-img = "<?php echo Router::url('/',true); ?>img/vimages/vimages/buy/car-menu01.jpg"
								>
									<img src="<?php echo Router::url('/',true); ?>img/vimages/buy/car-menu01.jpg" alt="//">
									<strong>Peugeot RCZ</strong>
									<span>Starting at $26,000</span>
								</a>
								<a 
									href="car.html"
									data-title="2014 Kia Koup Turbo"
									data-desc= "Plenty of smart and fun options to make you fall in love with your car."
									data-img = "<?php echo Router::url('/',true); ?>img/vimages/buy/car-menu02.jpg"
								>
									<img src="<?php echo Router::url('/',true); ?>img/vimages/buy/car-menu02.jpg" alt="//">
									<strong>Kia Koup Turbo</strong>
									<span>Starting at $26,000</span>
								</a>
							</div>
							<div class="car">
								<strong>Kia Koup Turbo</strong>
								<span>Plenty of smart and fun options to make you fall in love with your car.</span>
								<img src="<?php echo Router::url('/',true); ?>img/vimages/buy/car-menu01.jpg" alt="//">
							</div>
						</div>
					</li>
					<!--<li ><a href="rent.html">Rent a Car</a></li>-->
					<li >
						<?php echo $this->Html->link('Sell your Car',array('controller'=>'websites','action'=>'sell')); ?>
                    <!-- <a href="sell.html">Sell your Car</a>-->
                    </li>
					<li class="dropdown ">
						<a href="" class="dropdown-toggle" data-toggle="dropdown">Search Car<i class="icon-down-open-big"></i></a>
						<ul class="dropdown-menu">
							
							
							<li><a onclick="test();">By Brand</a></li>
							<li><a onclick="price();">By Budget</a></li>
							<li><a onclick="year();">By Year</a></li>
							<li><a onclick="kilometers();">By KM</a></li>
							<li><a onclick="fuel();">By Fuel Type</a></li>							
							<!--<li><a href="pricing-page.html">Pricing Table</a></li>-->
						</ul>
					</li>
					<li class="dropdown ">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Services<i class="icon-down-open-big"></i></a>
						<ul class="dropdown-menu">
							<li><a href="news-01-rightsidebar.html">Get Evaluated</a></li>
							<li><a href="news-01-leftsidebar.html">Get Insured</a></li>
							<li><a href="news-02-rightsidebar.html">Get Financed</a></li>
							<li><a href="news-02-leftsidebar.html">Get Technical Help</a></li>
							<!--<li ><a href="single-news.html">Single News</a></li>-->							
						</ul>
					</li>					
					<!--<li ><a href="sell.html">Search Car</a></li>-->
					<!--<li><a href="services.html">Services</a></li>-->
				</ul>
				<form class="navbar-form navbar-right" role="search">
					<div class="form-group">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search your car...">
							<span class="input-group-btn">
								<button class="btn" type="button"><i class="icon-search"></i></button>
							</span>
						</div>
					</div>
					<a href="advanced-search.html" class="btn advanced" data-toggle="tooltip" title="Advanced Search"><i class="icon-search"></i><i class="icon-plus"></i></a>
				</form>
			</div><!-- /.navbar-collapse -->
		</nav>
		<!-- end NavBar -->

		<!-- begin Sub Bar -->
		<div class="subbar" >
		<div class="container">
			<div id="carousel-top" class="carousel slide">
				<!-- Wrapper for slides -->
				<div class="carousel-inner">

                
		             <?php
							
						if(is_array($arrWebHomeSalestock) && (count($arrWebHomeSalestock) > 0))
							{
							
							//print_r($val);
						$intVehilcleImageCnt = 0;
						
						//print_r($val);
						//$strVehicleDetilUrl = Router::url(array('controller'=>'websites','action'=>'detail'),true)."/".$arrWebHomeSalestock['0']['wcz_vehicle']['vid'];
						//$srno = 1;
							foreach($arrWebHomeSalestock as $val)
								{
								//print_r(count($val));
								//print_r($intVehilcleImageCnt++);
								$intVehilcleImageCnt++;
								//$val=$arrWebHomeSalestock[0]['wcz_vehicle']['images'];

								//$vid=count($arrWebHomeSalestock[0]['wcz_vehicle']['vid']);
								//$cn=count($vid);
								//print_r($cn);
								//$strVehicleDetilUrl = Router::url(array('controller'=>'websites','action'=>'detail'),true)."/".$val['wcz_vehicle']['vid'];
								//print_r($arrWebHomeSalestock[4]['wcz_vehicle']['images']);
								//$val=$arrWebHomeSalestock[0]['wcz_vehicle']['images'];
								
								//print_r($val);
								//print_r($val);
					
								//echo 'hi';
								
								//$cn=count($val['wcz_vehicle']['vid']);
								//print_r($cn);
								if($intVehilcleImageCnt<=4)
								{
								  
								echo '<div class="item active"><a  href="'.Router::url('/',true).'/vehicledata/SalesStockimages/'.$val['wcz_vehicle']['images'].'" class="offer" alt="//">';
								if($val['wcz_vehicle']['images']=="")
								{
								echo $this->Html->image('/vehicledata/PreProcEnquiry/vehicle_imgs/buy00.jpg');
								}
								else
								{
								echo $this->Html->image('/vehicledata/SalesStockimages/'.$val['wcz_vehicle']['images']);
								}
								echo'<span><strong>2014 spark</strong>"'.$val['wcz_vehicle']['vid'].'"</span>';
								echo '</a></div>';
								}
								
								
								echo '<div class="item"><a  href="'.Router::url('/',true).'/vehicledata/SalesStockimages/'.$val['wcz_vehicle']['images'].'" class="offer" alt="//">';
								if($val['wcz_vehicle']['images']=="")
								{
								echo $this->Html->image('/vehicledata/PreProcEnquiry/vehicle_imgs/buy00.jpg');
								}
								else
								{
								echo $this->Html->image('/vehicledata/SalesStockimages/'.$val['wcz_vehicle']['images']);
								}
								
								
								echo'<span><strong>2014 spark</strong>"'.$val['wcz_vehicle']['vid'].'"</span>';
								echo '</a></div>';
								
								
								//print_r($intVehilcleImageCnt);
								/*echo '<div class="item"><a  href="'.Router::url('/',true).'/vehicledata/SalesStockimages/'.$val['wcz_vehicle']['images'].'" class="offer" alt="//">';
								echo $this->Html->image('/vehicledata/SalesStockimages/'.$val['wcz_vehicle']['images']);
								//echo'<span><strong>2014 spark</strong>"'.$val['wcz_vehicle']['vid'].'"</span>';
								echo '</a></div>';*/

								
								
									
							}	
						}	
									
						
					?>
					
				</div>

				<!-- Controls -->
				<a class="carousel-control" href="#carousel-top" data-slide="prev">
					<span class="icon-left-circled"></span>
				</a>
				<a class="carousel-control next" href="#carousel-top" data-slide="next">
					<span class="icon-right-circled"></span>
				</a>

			</div>
		</div>
		</div>
		<!-- end Sub Bar -->		
	
	</header>
    <!-- End Header Tag -->
	<?php echo $this->Session->flash(); ?>
	<?php echo $this->fetch('content'); 
	//echo $this->Html->css('admins');
	echo $this->Html->script('websitejs/jquery.min.1.9.1');
	echo $this->Html->script('jquery/jquery-1.9.1');
	echo $this->Html->script('call_commonfn');
	//echo $this->Html->script('websitejs/jquery.min.1.9.1');
	//echo $this->Html->script('jquery/jquery-1.9.1');
	?>
</body>
</html>
