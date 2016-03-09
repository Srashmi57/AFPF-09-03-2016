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
	<meta name="description" content="Welcome to artformplatform.com">
	<meta name="keywords" content="">
	<meta name="google-site-verification" content="tRj1Ao56Nvuntnazz5pXP3M8_v34klJOxjmz690WxPs" />
	<meta name="author" content="">
	<link rel="canonical" href="<?php echo Router::url('/',true); ?>"/>
	<title>Artform Platform</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
		// Bootstrap
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('website');
		//echo $this->Html->script('jquery.min');
		echo $this->Html->script('jquery-1.10.2.min');
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('jquery-ui.min');
		echo $this->Html->script('bootbox');
		echo $this->Html->css('ionicons.min');
		echo $this->Html->css('font-awesome.min');
		echo $this->Html->css('style.min');
		echo $this->Html->css('main.min');
		echo $this->Html->css('media');
		echo $this->Html->css('jquery.bxslider');
		echo $this->Html->script('jquery.form');
		echo $this->Html->script('jquery.bxslider.min');
		echo $this->Html->script('jwplayer');
		
		echo $this->Html->script('jquery.prettyPhoto');
		echo $this->Html->script('common');
		echo $this->Html->script('stickup');
		echo $this->Html->script('functions');
		echo $this->Html->script('jquery.wait');
		echo $this->Html->script('fappear');
		echo $this->Html->script('imagesloaded.pkgd.min');
		echo $this->Html->script('wow');
		 echo $this->Html->script('custom');
		
		
		// Validation Engine for form validations
		echo $this->Html->script('validationplugin/validationengine/js/languages/jquery.validationEngine-en'); // Form Validations
		echo $this->Html->script('validationplugin/validationengine/js/jquery.validationEngine'); // Form Validations
		echo $this->Html->css('jqueryvalidationplugin/validationEngine.jquery'); // Form Validations CSS
		?>
	
	
	<script type="text/javascript">

			 function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
	console.log(getCookie("currentaudio"));
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}



function loginValidation(logtype) 
	{
	
	   var isValidated = jQuery('#'+logtype+'login').validationEngine('validate');
	   //alert('in');
	 	
	   if(isValidated == false)
		{
			return false;
		}
		else
		{
			$('.cms-bgloader-mask').show();//show loader mask
	 	    $('.cms-bgloader').show(); //show loading image
		   var url = "<?php echo Router::url('/', true)."websites/login/"?>";
		var type = "POST";
			var options = { 
			success: function(responseText, statusText, xhr, $form) {
			$('.cms-bgloader-mask').hide();//show loader mask
	  			 $('.cms-bgloader').hide(); //show loading image
				//alert(responseText.status);
				if(responseText.status == "success")
				{
					$('.modal').modal('hide');
					window.location = strGlobalSiteBasePath+"users/mypage";
				}
				if(responseText.status == "fail")
				{
					$('.errormsg').html("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a><strong>Error! </strong> Invalid Username or password .</div>");
					
				}
			
			},								
			// other available options: 
			url:       url,         // override for form's 'action' attribute 
			type:      type,        // 'get' or 'post', override for form's 'method' attribute 
			dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
		} 
	
	$('#'+logtype+'login').ajaxSubmit(options);
	// !!! Important !!! 
	// always return false to prevent standard browser submit and page navigation 
	return false; 
	
		}
	    
}


</script>

<script type="text/javascript">
var strGlobalSiteBasePath ='<?php echo Router::url('/',true); ?>';
</script>
<link type="text/css" href="/cometchat/cometchatcss.php" rel="stylesheet" charset="utf-8">
	<script type="text/javascript" src="/cometchat/cometchatjs.php" charset="utf-8"></script>
</head>
<body>

    
<?php
$strBasePath = Router::url('/',true);
//current controller and current Action
$controllersarray = array('users','websites');

$controllersaction = array();

		if(in_array($this->params['controller'],$controllersarray)&& in_array($this->params['action'],$controllersaction))
		{
		   $showbanner = 0;
		}
		else
		{
			$showbanner = 1;
		}

		$homeUrl = Router::url(array('controller'=>'websites','action'=>'index'),true);
		$aboutusUrl = Router::url(array('controller'=>'websites','action'=>'aboutus'),true);
		$sitemapUrl = Router::url(array('controller'=>'websites','action'=>'sitemap'),true);
		$privacyUrl = Router::url(array('controller'=>'websites','action'=>'privacypolicy'),true);
			$loggedusertypeid = $this->Session->read('Auth.WebsitesUser.usertype_id');
			if($this->Session->read('Auth.WebsitesUser.user_display_name')!="")
			{
				$loggeduserfname = $this->Session->read('Auth.WebsitesUser.user_display_name');
			}
			else
			{
				$loggeduserfname = $this->Session->read('Auth.WebsitesUser.user_fname');
			}
			
			$loggeduserid = $this->Session->read('Auth.WebsitesUser.user_id');
	
		$logout_url = Router::url(array('controller'=>'websites','action'=>'logout'),true);

		$artistpageurl = Router::url(array('controller'=>'users','action'=>'mypage'),true);
		
		

?>
	<!-- Start Header Tag -->
	<body>
    <div class="page-mask">
            <div class="page-loader">
                <div class="spinner"></div>
               
            </div>
        </div>
		  <div class="cms-bgloader-mask"></div>
				<div class="cms-bgloader"></div>
    <div class="wrapper wow fadeInUp">
	<!-- Header Start -->
	<header id="header">
	
        <!-- Header Middle Section Start -->
        <div class="head-middle-sec">
            <!-- Container Start -->
            <div class="container">
                <!-- Logo Start -->
                <div class="logo">
                    <a href="<?php echo $homeUrl;?>"><img alt="" src="<?php echo Router::url('/',true)?>images/logo.png"></a>
                </div>
                <!-- Logo End -->
				<!-- Social Icons -->
				<div class="social-network">
				<div class="social-network-bg">
                    <a data-original-title="Facebook" title="" data-placement="top" data-rel="tooltip" href="https://www.facebook.com/ArtformPlatform" target="_blank" rel="tooltip"><i class="fa fa-facebook fa-1x"></i></a>
                    <a data-original-title="Linkedin" title="" data-placement="top" data-rel="tooltip" href="#"  rel="tooltip"><i class="fa fa-linkedin fa-1x"></i></a>
                    <a data-original-title="Twitter" title="" data-placement="top" data-rel="tooltip" href="https://twitter.com/ArtformPlatform"  target="_blank" rel="tooltip"><i class="fa fa-twitter fa-1x"></i></a>
					<a data-original-title="Pinterest" title="" data-placement="top" data-rel="tooltip" href="https://in.pinterest.com/artformplatform/" target="_blank" rel="tooltip"><i class="fa fa-pinterest fa-1x"></i></a>
					<a data-original-title="Instagram" title="" data-placement="top" data-rel="tooltip" href="https://instagram.com/artformplatform"  target="_blank" rel="tooltip"><i class="fa fa-instagram fa-1x"></i></a>
                </div>
				</div>
            </div>
            <!-- Container End -->
        </div>
			<?php
	if($showbanner>0)
	{
		// echo $this->element('banner'); 
	}
	?>
        <!-- Header Middle Section End -->
        <!-- Navigation Start -->
        <div class="navigation stuckMenu isStuck" role="navigation" style="position: relative; top: 0px;">
            <div class="container">
				 <a class="cs-click-menu webkit"><i class="fa fa-bars"></i></a>
                <ul id="menus">
				<?php $catarray = array('category','subcategory','subsubcategory');?>
                    <li class="<?php echo ($this->params['controller'] == 'websites' && $this->params['action'] == "index" ? 'active' : ''); ?>"><a href="<?php echo $homeUrl;?>">Home</a></li>
                     <li class="<?php echo ($this->params['controller'] == 'websites' && $this->params['action'] == "aboutus" ? 'active' : ''); ?>"><a href="<?php echo $aboutusUrl;?>">About Us</a></li>
                       <li class="<?php echo ($this->params['controller'] == 'websites' && in_array($this->params['action'],$catarray)  ? 'active' : ''); ?>"><a href="javascript:void(0);">Category</a>
					   <?php echo $categories;?>
                       </li>
							<?php
					if($loggedusertypeid==2)
						{
						  $uploadurl = Router::url(array('controller'=>'websites','action'=>'upload'),true);
						?>
						 <li><a  onclick="return checkCategory();" href="javascript:void(0);">Upload</a></li>
						<?php
						}?>
                    
                  
                </ul>
                
           		   <ul class="menus  navbar-right" id="rightmenus" >
                   <?php
				 
				  if($loggeduserid>0)
				   {
						   $profileUrl = Router::url(array('controller'=>'users','action'=>'viewmyprofile'),true);
							$user_cropimage = $this->Session->read('Auth.WebsitesUser.user_cropped_image');
					
						  if($user_cropimage!="")
						  {
						     $cropimageurl= Router::url('/', true)."assets/websiteuser/".$user_cropimage;
							 
							 $cropimage="<img src ='$cropimageurl' height='22px' width='25px'/>";
						  }
						 else
						 {
						    $cropimage = "<i class='fa fa-user'></i>";
						 }
						  
						   ?>
					<li class="<?php echo ($this->params['controller'] == 'users' && ($this->params['action'] == 'artist' || $this->params['action'] == 'myprofile')  ? 'active' : ''); ?>"><a href="<?php echo $artistpageurl;?>"> <?php echo $cropimage;?> <?php echo ucfirst($loggeduserfname); ?></a></li>
                       <li><a ><i class="fa fa-cog"></i>Setting</a>
    	                   <ul>
                   <!-- <li class="<?php echo ($this->params['controller'] == 'users' && ($this->params['action'] == 'viewmyprofile' || $current_action == 'myprofile')  ? 'active' : ''); ?>"><a href="<?php echo $profileUrl;?>">Profile</a></li>-->
	    	                   <li><a onClick="return changepass();">Change Password</a></li>
				               <li> <a onClick="return logout();" >Logout</a></li>
            	           </ul>
                       </li>
				   <?php
				   }
				   else
				   {?>
                        <li><a data-target="#mainmodallogin" data-toggle="modal"><i class="fa fa-sign-in"></i>SIGN IN</a></li>
                        <li><a data-target="#mainmodalregister" data-toggle="modal"><i class="fa fa-user"></i>CREATE ACCOUNT</a></li>
                   <?php
				   }
				   ?>
                    <div class="col-sm-3 col-md-3">
					<?php $searchUrl = Router::url(array('controller'=>'websites','action'=>'search'),true);?>
                    <form class="sidebar-form" id="sidebarform" method="post" action="<?php echo $searchUrl;?>">
                        <div class="input-group">
                            <input type="text" placeholder="Search..." class="" name="txtsearch">
                            <span class="input-group-btn">
                                <button class="btn btn-flat" id="search-btn" name="seach" type="submit" ><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    </div>
      </ul>
           
        </div>
		</div>
        <!-- Navigation End -->
    </header>
	        
    <!--- Header End -->
    <div class="clear"></div>
	<!--- Banner Start -->
	<?php echo $this->Session->flash(); ?>

	<!-- banner end-->
   

    </div>
    
    <div class="content">
        <!-- Container Start -->

	<?php echo $this->fetch('content'); ?>
            <!-- Row End -->
		</div>
                <footer id="webfooter" >
                        <!-- CopyRight Start -->
     <div class="copyright">
                            <div class="container">
							<div class="col-md-4 coneectwithus">
							<h3><a href="http://artformplatform.com/afpf/websites/aboutus">About Us</p></h3>
							<h3><a href="http://artformplatform.com/afpf/websites/terms">Terms & Conditions</a></h3>
							<h3><a href="http://artformplatform.com/afpf/websites/privacypolicy">Privacy Policy</a></h3>
							<h3><a href="http://artformplatform.com/afpf/websites/sitemap">Sitemap</a></h3>
							
							</div>
							<div class="col-md-4 coneectwithus">
							<h3>Connect with us</h3>
							<div class="social">
								<ul>
								<li><a href="https://www.facebook.com/ArtformPlatform" target="_blank"><i class="fa fa-lg fa-facebook"></i></a></li>
								<li><a data-original-title="Linkedin" title="" data-placement="top" data-rel="tooltip" href="#" rel="tooltip"><i class="fa fa-linkedin fa-1x" style="padding-top: 8px;"></i></a></li>
								
								<li><a href="https://twitter.com/ArtformPlatform"  target="_blank"><i class="fa fa-lg fa-twitter"></i></a></li>
								<!-- <li><a href="#"><i class="fa fa-lg fa-google-plus"></i></a></li> -->
								<a data-original-title="Pinterest" title="" data-placement="top" data-rel="tooltip" href="https://in.pinterest.com/artformplatform/" target="_blank" rel="tooltip"><i class="fa fa-pinterest fa-1x" style="padding-top: 8px;"></i></a>
								 <li><a href="https://instagram.com/artformplatform"  target="_blank"><i class="fa fa-lg fa-instagram"></i></a></li>
								</ul>
							</div>
							<h3>Newsletter Signup</h3>
							<p>Sign up for the latest artwork news and inspiration from every artist around the corner</p>
							<form class="form-inline">
							  <div class="form-group">
								<label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
								<div class="input-group">
								  <input type="text" class="form-control" id="exampleInputAmount" placeholder="Email">
								  <div class="input-group-addon">Sign up</div>
								</div>
							  </div>
							</form>
							
							</div>
							<div class="col-md-4 contactus">
							<h3>Contact us</h3>
							<form class="form-horizontal" name="contactForm" id="contactForm">
							  <div class="form-group">
								<div class="col-sm-10">
								  <input type="text" class="form-control validate[required]" name="txtcontactname" id="inputEmail3" placeholder="Name">
								</div>
							  </div>
							  <div class="form-group">
								<div class="col-sm-10">
								  <input type="email" class="form-control validate[required,custom[email]]" name="txtemail" id="inputPassword3" placeholder="Email">
								</div>
							  </div>
							  <div class="form-group">
								<div class="col-sm-10">
								  <textarea class="form-control validate[required]" rows="4" name="txtMessage" id="txtMessage" placeholder="Message"></textarea>
								</div>
							  </div>
							  <div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
								  <button type="button" class="btn btn-default" onClick="return sendContact();">Send</button>
								</div>
							  </div>
							  
							</form>
							</div>
                               
								<!--<ul class="pull-right">
								<li><a href="<?php echo $sitemapUrl;?>">Sitemap</a></li>
								<li class="last"><a href="<?php echo $privacyUrl;?>">Privacy Policy</a></li>
								</ul> -->
								
								
                            </div>
							 <div class="copyright-text"><span>Copyright &copy; <?php echo date('Y'); ?> | All rights reserved</span></div>
                        </div>
                        <!-- CopyRight End --><link type="text/css" href="/afpf/cometchat/cometchatcss.php" rel="stylesheet" charset="utf-8">
<script type="text/javascript" src="/afpf/cometchat/cometchatjs.php" charset="utf-8"></script>

                    </footer>            
        
	</body>

	

 <?php echo $this->element('sql_dump'); ?>

<?php echo $this->element('updatecategory'); ?>

</body>
</html>
	
	
	