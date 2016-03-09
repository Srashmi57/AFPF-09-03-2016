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
	<title>Artform Platform</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		// Bootstrap
		 echo $this->Html->css('bootstrap.min');
		  echo $this->Html->css('website');
		echo $this->Html->script('jquery.min');
		echo $this->Html->script('jquery-1.10.2.min');
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('jquery-ui.min');
		echo $this->Html->script('bootbox');
		echo $this->Html->css('ionicons.min');
		echo $this->Html->css('font-awesome.min');
		echo $this->Html->css('style');
		echo $this->Html->css('media');
		echo $this->Html->css('jquery.bxslider');
		echo $this->Html->script('jquery.form');
		echo $this->Html->script('jquery.bxslider.min');
		echo $this->Html->script('common');
		echo $this->Html->script('stickup');
		echo $this->Html->script('functions');
		// Validation Engine for form validations
		echo $this->Html->script('validationplugin/validationengine/js/languages/jquery.validationEngine-en'); // Form Validations
		echo $this->Html->script('validationplugin/validationengine/js/jquery.validationEngine'); // Form Validations
		echo $this->Html->css('jqueryvalidationplugin/validationEngine.jquery'); // Form Validations CSS
		?>

	

	
	<script type="text/javascript">


function loginValidation() 
	{
	
	   var isValidated = jQuery('#login').validationEngine('validate');
	   //alert('in');
	 	
	   if(isValidated == false)
		{
			return false;
		}
		else
		{
			$('.cms-bgloader-mask').show();//show loader mask
	 	    $('.cms-bgloader').show(); //show loading image
		   var url = "<?php echo Router::url('/', true).$this->params['controller']."/login/"; ?>";
	
		   var type = "POST";
			var options = { 
			success: function(responseText, statusText, xhr, $form) {
			$('.cms-bgloader-mask').hide();//show loader mask
	  			 $('.cms-bgloader').hide(); //show loading image
				//alert(responseText.status);
				if(responseText.status == "success")
				{
					window.location.reload(true);
				}
				if(responseText.status == "fail")
				{
					document.getElementById('errormsg').innerHTML="<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a><strong>Error! </strong> Invalid Username or password .</div>";
					
				}
			
			},								
			// other available options: 
			url:       url,         // override for form's 'action' attribute 
			type:      type,        // 'get' or 'post', override for form's 'method' attribute 
			dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
		} 
	
	$('#login').ajaxSubmit(options);
	// !!! Important !!! 
	// always return false to prevent standard browser submit and page navigation 
	return false; 
	
		}
	    
}


</script>

<script type="text/javascript">
var strGlobalSiteBasePath ='<?php echo Router::url('/',true); ?>';
</script>

</head>
<body>

    
<?php
$strBasePath = Router::url('/',true);
?>
	<!-- Start Header Tag -->
	<body>
    
    <div class="wrapper">
	<!-- Header Start -->
	<header id="header">
        <!-- Header Middle Section Start -->
        <div class="head-middle-sec">
            <!-- Container Start -->
            <div class="container">
                <!-- Logo Start -->
                <div class="logo">
                    <a href="index.html"><img alt="" src="<?php echo Router::url('/',true)?>images/logo.png"></a>
                </div>
                <!-- Logo End -->
				<!-- Social Icons -->
				<div class="social-network">
                    <a data-original-title="Facebook" title="" data-placement="top" data-rel="tooltip" href="#" rel="tooltip"><i class="fa fa-facebook fa-1x"></i></a>
                    <a data-original-title="Linkedin" title="" data-placement="top" data-rel="tooltip" href="#" rel="tooltip"><i class="fa fa-linkedin fa-1x"></i></a>
                    <a data-original-title="Twitter" title="" data-placement="top" data-rel="tooltip" href="#" rel="tooltip"><i class="fa fa-twitter fa-1x"></i></a>
					<a data-original-title="Pinterest" title="" data-placement="top" data-rel="tooltip" href="#" rel="tooltip"><i class="fa fa-pinterest fa-1x"></i></a>
					<a data-original-title="Github" title="" data-placement="top" data-rel="tooltip" href="#" rel="tooltip"><i class="fa fa-github fa-1x"></i></a>
                </div>
            </div>
            <!-- Container End -->
        </div>
        <!-- Header Middle Section End -->
        <!-- Navigation Start -->
        <div class="navigation stuckMenu isStuck" role="navigation" style="position: relative; top: 0px;">
            <div class="container">
				 <a class="cs-click-menu webkit"><i class="fa fa-bars"></i></a>
                <ul id="menus">
                    <li class="active"><a href="#">Home</a></li>
                     <li><a href="#">About Us</a></li>
                       <li><a href="#">Category</a>
                       <ul>
                       <?php
					 $oldcategory = 0;
					 $oldsubcategory = 0;
					 $categoryarray = array();
					 $subcategoryarray = array();
					 
					 foreach($categories as $category)
					 {
					   $categoryname = $category['Category']['category_name'];
					   $categoryid = $category['Category']['category_id'];
					   $categoryUrl = Router::url(array('controller'=>'websites','action'=>'category'),true)."/".$categoryid;
					  
					   if(count($category['Category']['children'])>0)
					   {?>
								<li class="hassub"> <a href="<?php echo $categoryUrl;?>"><?php echo $categoryname;?></a>
								<ul>
							<?php		
								foreach ($category['Category']['children'] as $child )
								{
								  $subcategoryname = $child['Subcategory']['subcategory_name'];
								$subcategory_id = $child['Subcategory']['subcategory_id'];
								$subcategoryUrl = Router::url(array('controller'=>'websites','action'=>'subcategory'),true)."/".$subcategory_id;
								  if(count($category['Category']['subchildren'])>0)
								  {
								  ?>
								  <li class="hassub"><a href="<?php echo $subcategoryUrl;?>"><?php echo $subcategoryname;?></a>
                                      <ul>
                                       <?php
                                         foreach ($category['Category']['subchildren'] as $subchild )
										 {
											 $subsubcategoryname = $subchild['Subsubcategory']['subsubcategory_name'];
											  $subsubcategory_id = $subchild['Subsubcategory']['subsubcategory_id'];
											$subsubcategoryUrl = Router::url(array('controller'=>'websites','action'=>'subsubcategory'),true)."/".$subsubcategory_id;
											 ?>
											 <li > <a href="<?php echo $subsubcategoryUrl;?>"><?php echo $subsubcategoryname;?></a></li>
                                             <?php
										 }
										 ?>
                                    </ul>
                                </li>
								<?php
								  }
                                  else
									{
										?>
										  <li class="hassub"><a href="<?php echo $subcategoryUrl;?>"><?php echo $subcategoryname;?></a></li>
										  <?php
									}
								}
								?>
								</ul>
						</li> 
					<?php
						}
						else
						{
						?>
						<li> <a href="<?php echo $categoryUrl;?>"><?php echo $categoryname;?></a></li>
						<?php 
						}
						
					 }

				?>
						</ul></li>
                     
                  
                </ul>
                
           		   <ul class="menus  navbar-right" id="rightmenus" >
            <li><a data-target="#modalLogin" data-toggle="modal"><i class="fa fa-sign-in"></i>SIGN IN</a></li>
                    <li><a data-target="#mainmodalregister" data-toggle="modal"><i class="fa fa-user"></i>CREATE ACCOUNT</a></li>
                    <div class="col-sm-3 col-md-3">
                    <form class="sidebar-form " method="get" action="#">
                        <div class="input-group">
                            <input type="text" placeholder="Search..." class="" name="q">
                            <span class="input-group-btn">
                                <button class="btn btn-flat" id="search-btn" name="seach" type="submit"><i class="fa fa-search"></i></button>
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
	<div class="banner">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="<?php echo Router::url('/',true)?>images/banner1.png" alt="...">
      <div class="carousel-caption">
	  <div class="slider-heading">
       <h1>TONIGHT I AM LOVIN YOU</h1>
        <p>Cape town electronic music festival 2013 cape town electronic music festival 2013</p>
		</div>
      </div>
    </div>
    <div class="item">
      <img src="<?php echo Router::url('/',true)?>images/banner1.png" alt="...">
      <div class="carousel-caption">
	  <div class="slider-heading">
       <h1>ONE DIRECTION ELECTRONIC</h1>
        <p>Cape town electronic music festival 2013 cape town electronic music festival 2013</p>
	   </div>
      </div>
    </div>
	<div class="item">
      <img src="<?php echo Router::url('/',true)?>images/banner1.png" alt="...">
      <div class="carousel-caption">
	  <div class="slider-heading">
       <h1>ROCK THIS NIGHT</h1>
        <p>Cape town electronic music festival 2013 cape town electronic music festival 2013</p>
	   </div>
      </div>
    </div>
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
   
    </div>
    
    <div class="content">
        <!-- Container Start -->
        <?php echo $this->Session->flash(); ?>
	<?php echo $this->fetch('content'); ?>
            <!-- Row End -->
                <footer id="webfooter">
                        <!-- CopyRight Start -->
     <div class="copyright">
                            <div class="container">
                               
                                <p>Copyright &copy; 2014 | All rights reserved
                                <span>Sitemap | Privacy Policy</span>
                              
                                </p>
                            </div>
                        </div>
                        <!-- CopyRight End -->
                    </footer>            
        </div>
	</body>

	
    <!-- End Header Tag -->
	
	<div class="modal fade" id="modalLogin">
  <div class="modal-dialog">
    <div class="modal-content">
           <div class="cms-bgloader-mask"></div>
<div class="cms-bgloader"></div>
      <form name="login" id="login" method="post">
      <div class="modal-header">
	  <img src="<?php echo Router::url('/',true)?>images/artist-icon.png" width="70" height="50" style="float:left;padding:5px;">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="images/close-icon.png" width="60" height="50px"></button>
        <h4 class="modal-title">LOGIN</h4>
      </div>
			  <div class="modal-body">
					<div id="errormsg"></div>
						  <div class="form-group col-sm-12 col-md-offset-2">
								<label  for="inputEmail3" class="col-sm-2 control-lable">Email </label>
								<div class="col-sm-6">
								<input type="email" class="form-control validate[required]" id="txtusername" name="txtusername" />
								</div>
							</div>
							
								<div class="form-group col-sm-12 col-md-offset-2">
								<label  for="inputPassword3" class="col-sm-2 control-lable">Password</label>
								<div class="col-sm-6">
								<input type="password"  id="txtpassword" name="txtpassword" class="form-control validate[required]" />
								</div> 
								</div>
							
							  <div class="col-sm-12 col-md-offset-4">
							  <div class="col-sm-offset col-sm-6">
							  <p><a href="#" id="showmodalPassword">I forgot my password ?</a></p>
							  </div>
							  </div>
							  
							  <div class="form-group col-sm-12 col-md-offset-4">
							  <div class="col-sm-offset col-sm-6">
							  <button type="submit" class="btn btn-primary btn-lg btn-block submit-button" onclick="return loginValidation();" id="addItem">SUBMIT</button>
							  </div>
							  </div>
							  
							  <div class="form-group col-sm-12 col-md-offset-4">
							  <label id="showmodalregister">Create an account</label>
							  <div class="col-sm-offset col-sm-3">
							  <button type="submit" class="btn btn-primary btn-lg btn-block register-button" >REGISTER</button>
							  </div>
							  </div>
							
				</div>
      
      <div class="modal-footer poup-footer">
			<div class="margin text-center col-sm-8 col-md-offset-1">
                <span>Login using social networks</span>
        <div class="social-network popup-social">
                    <a data-original-title="Facebook" title="" data-placement="top" data-rel="tooltip" href="#" rel="tooltip"><i class="fa fa-facebook fa-1x"></i></a>
                    <a data-original-title="Linkedin" title="" data-placement="top" data-rel="tooltip" href="#" rel="tooltip"><i class="fa fa-linkedin fa-1x"></i></a>
                    <a data-original-title="Twitter" title="" data-placement="top" data-rel="tooltip" href="#" rel="tooltip"><i class="fa fa-twitter fa-1x"></i></a>
                </div>
			</div>
      </div>
	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div>




 <!------ Forgot password Modal ----->
 
 <div class="modal fade" id="modalforgotpassword">
  <div class="modal-dialog">
    <div class="modal-content">
      <form name="frmforgotpassword" id="frmforgotpassword" method="post">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="images/close-icon.png" width="60" height="50px"></button>
        <h4 class="modal-title">Forgot Password</h4>
      </div>
      <div class="modal-body">
      
       <div class="form-group col-sm-12 col-md-offset-2">
								<label  for="Email" class="col-sm-2 control-lable">Email </label>
								<div class="col-sm-6">
								 <input type="email" name="txtUsername" id="txtUsername" class="form-control validate[required]" placeholder="Email"/>
								</div>
							</div>
     
                </div>
      
      <div class="modal-footer poup-footer">
			<div class="margin text-center col-sm-8 col-md-offset-1">
        
			</div>
      </div>
	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div>
  
  
  
  <!------ Register Modal ----->
  <div class="modal fade" id="modalartistRegister">
  <div class="modal-dialog">
    <div class="modal-content">
      <form name="frmRegister" id="frmRegister" method="post">
      <div class="modal-header">
         <div class="cms-bgloader-mask"></div>
  		  <div class="cms-bgloader"></div>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Register</h4>
      </div>
      <div class="modal-body">
			
                <div class="form-group col-sm-12">
            		    <div class="col-sm-6">
						  <label  for="Name">First Name  </label>
				 <input type="text" name="txtFirstName" id="txtFirstName" class="form-control validate[required]" placeholder="First Name"/>
								</div> 
                       <div class="col-sm-6">
								<label  for="Name">Last Name  </label>
								 <input type="email" name="txtLastName" id="txtLastName" class="form-control validate[required]" placeholder="Last Name"/>
								</div> 
						</div>
      
				 <div class="form-group col-sm-12">
	                   <div class="col-sm-6">
						<label  for="Name">Email  </label>
                        <input type="email" name="txtUsername" id="txtUsername" class="form-control validate[required]" placeholder="Email"/>
                        </div>
                         <div class="col-sm-6">
                         <label  for="Name">Phone Number  </label>
                        <input type="text" name="txtphonenumber" id="txtphonenumber" class="form-control validate[required]" placeholder="Phone Number"/>
                         </div>
                    </div>
                 
                
                    <div class="form-group col-sm-12 ">
                        <div class="col-sm-6">
						<label  for="Name">Password  </label>
                        <input type="Password" name="txtPassword" id="txtPassword" class="form-control validate[required]" placeholder="Password"/>
                        </div>
                           <div class="col-sm-6">
                          	<label  for="Name">Confirm Password  </label>
                        <input type="Password" name="txtConfirmPassword" id="txtConfirmPassword" class="form-control validate[required]" placeholder="Confirm Password"/>
                          </div>
                    </div>
               
                    <div class="form-group col-sm-12">
                      <div class="col-sm-6">
				 <label  for="Name"> Category </label>
		
				<?php    echo $this->Form->input('category_list',array('label'=>false,'type'=>'select','options'=>$arr_CategoryList,'class'=>'validate[required] form-control','onChange'=>'fnGetSubcategoryList(this.value)'));
?>
                        </div>
                          <div class="col-sm-6">
                          	<label  for="Name">Subcategory  </label>
                       <?php       echo $this->Form->input('subcategory_id',array('label'=>false,'type'=>'select','options' => array(
            '0' => 'Please select subcategory'
        ), 'class'=>'validate[required] form-control subcatlist','onChange'=>'fnGetSubSubcategoryList(this.value)'));
?>
                          </div>
                    </div>
               
                    
                   <div class="form-group col-sm-12">
                      <div class="col-sm-6">
				 <label  for="Name"> Subsubcategory </label>
		
                       <?php       echo $this->Form->input('subsubcategory_id',array('label'=>false,'type'=>'select', 'options' => array(
            '0' => 'Please select subsubcategory'
        ),'class'=>'validate[required] form-control subsubcatlist'));
?>
                        </div>
               <div class="col-sm-6">
				 <label  for="Name"> Sex </label>
		
                <select id="selectssex" name="selectssex" class="form-control"/>
                <option value="0">Please Select Sex</option>
                    <option value="male">Male</option>
                     <option value="female">Female</option>
                </select>
                        </div>
                          
                    </div>
               
                   
                   
             <div class="form-group col-sm-12 ">
              <h5><a  id="showmodallogin" href="#" class="text-olive">I already have a member</a></h5>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning" onclick="return siteRegister();" id="addItem" >Register</button>
         </div>
                </div>
      
      <div class="modal-footer poup-footer">
			<div class="margin text-center col-sm-8 col-md-offset-1">
                <span>Login using social networks</span>
        <div class="social-network popup-social">
                    <a data-original-title="Facebook" title="" data-placement="top" data-rel="tooltip" href="#" rel="tooltip"><i class="fa fa-facebook fa-1x"></i></a>
                    <a data-original-title="Linkedin" title="" data-placement="top" data-rel="tooltip" href="#" rel="tooltip"><i class="fa fa-linkedin fa-1x"></i></a>
                    <a data-original-title="Twitter" title="" data-placement="top" data-rel="tooltip" href="#" rel="tooltip"><i class="fa fa-twitter fa-1x"></i></a>
                </div>
			</div>
      </div>
      
	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div>
  
  
  <div class="modal fade" id="modaluserRegister">
  <div class="modal-dialog">
    <div class="modal-content">
      <form name="frmRegister" id="frmRegister" method="post">
      <div class="modal-header">
         <div class="cms-bgloader-mask"></div>
  		  <div class="cms-bgloader"></div>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Register</h4>
      </div>
      <div class="modal-body">
			
                <div class="form-group col-sm-12">
            		    <div class="col-sm-6">
						  <label  for="Name">First Name  </label>
				 <input type="text" name="txtFirstName" id="txtFirstName" class="form-control validate[required]" placeholder="First Name"/>
								</div> 
                       <div class="col-sm-6">
								<label  for="Name">Last Name  </label>
								 <input type="email" name="txtLastName" id="txtLastName" class="form-control validate[required]" placeholder="Last Name"/>
								</div> 
						</div>
      
				 <div class="form-group col-sm-12">
	                   <div class="col-sm-6">
						<label  for="Name">Email  </label>
                        <input type="email" name="txtUsername" id="txtUsername" class="form-control validate[required]" placeholder="Email"/>
                        </div>
                         <div class="col-sm-6">
                         <label  for="Name">Phone Number  </label>
                        <input type="text" name="txtphonenumber" id="txtphonenumber" class="form-control validate[required]" placeholder="Phone Number"/>
                         </div>
                    </div>
                 
                
                    <div class="form-group col-sm-12 ">
                        <div class="col-sm-6">
						<label  for="Name">Password  </label>
                        <input type="Password" name="txtPassword" id="txtPassword" class="form-control validate[required]" placeholder="Password"/>
                        </div>
                           <div class="col-sm-6">
                          	<label  for="Name">Confirm Password  </label>
                        <input type="Password" name="txtConfirmPassword" id="txtConfirmPassword" class="form-control validate[required]" placeholder="Confirm Password"/>
                          </div>
                    </div>
               
                    <div class="form-group col-sm-12">
                      <div class="col-sm-6">
				 <label  for="Name"> Category </label>
		
				<?php    echo $this->Form->input('category_list',array('label'=>false,'type'=>'select','options'=>$arr_CategoryList,'class'=>'validate[required] form-control','onChange'=>'fnGetSubcategoryList(this.value)'));
?>
                        </div>
                          <div class="col-sm-6">
                          	<label  for="Name">Subcategory  </label>
                       <?php       echo $this->Form->input('subcategory_id',array('label'=>false,'type'=>'select','options' => array(
            '0' => 'Please select subcategory'
        ), 'class'=>'validate[required] form-control subcatlist','onChange'=>'fnGetSubSubcategoryList(this.value)'));
?>
                          </div>
                    </div>
               
                    
                   <div class="form-group col-sm-12">
                      <div class="col-sm-6">
				 <label  for="Name"> Subsubcategory </label>
		
                       <?php       echo $this->Form->input('subsubcategory_id',array('label'=>false,'type'=>'select', 'options' => array(
            '0' => 'Please select subsubcategory'
        ),'class'=>'validate[required] form-control subsubcatlist'));
?>
                        </div>
               <div class="col-sm-6">
				 <label  for="Name"> Sex </label>
		
                <select id="selectssex" name="selectssex" class="form-control"/>
                <option value="0">Please Select Sex</option>
                    <option value="male">Male</option>
                     <option value="female">Female</option>
                </select>
                        </div>
                          
                    </div>
               
                   
                   
             <div class="form-group col-sm-12 ">
              <h5><a  id="showmodallogin" href="#" class="text-olive">I already have a member</a></h5>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning" onclick="return siteRegister();" id="addItem" >Register</button>
         </div>
                </div>
      
      <div class="modal-footer poup-footer">
			<div class="margin text-center col-sm-8 col-md-offset-1">
                <span>Login using social networks</span>
        <div class="social-network popup-social">
                    <a data-original-title="Facebook" title="" data-placement="top" data-rel="tooltip" href="#" rel="tooltip"><i class="fa fa-facebook fa-1x"></i></a>
                    <a data-original-title="Linkedin" title="" data-placement="top" data-rel="tooltip" href="#" rel="tooltip"><i class="fa fa-linkedin fa-1x"></i></a>
                    <a data-original-title="Twitter" title="" data-placement="top" data-rel="tooltip" href="#" rel="tooltip"><i class="fa fa-twitter fa-1x"></i></a>
                </div>
			</div>
      </div>
      
	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div>
  
  <div class="modal fade" id="mainmodalregister">
 <div class="modal-dialog">
  <div class="modal-content">
           <div class="cms-bgloader-mask"></div>
    <div class="cms-bgloader"></div>
    <form name="login" id="login" method="post">
     <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="<?php echo Router::url('/',true)?>images/close-icon.png" width="60" height="50px"></button>
     <h4 class="modal-title">REGISTER</h4>
     </div>
  <div class="modal-body">
    <div class="form-group col-sm-12 col-md-offset-2">
     <div class="col-sm-4 text-center"><a href="#" id="showusermodal" ><img src="<?php echo Router::url('/',true)?>images/artist1-icon.png" height="100" width="100"></a><div class="regptext"><p>USER</p></div></div>
     <div class="col-sm-4 text-center"><a  data-target="#modaluserRegister" data-toggle="modal" id="showartistmodal"><img src="<?php echo Router::url('/',true)?>images/user-icon.png" height="100" width="100"></a><div class="regptext"><p>ARTIST</p></div></div>
     
    </div>           
  </div>
    </form>
   </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div>


 <?php echo $this->element('sql_dump'); ?>

<script type="text/javascript" language="javascript">


	$(document).ready(function() {
  $(".delete-link").on("click", function () {
 
	var location = $(this).attr('href');
	
    bootbox.confirm("Are you sure you want to delete?", function(confirmed) {
       if(confirmed) {
        window.location.replace(location);
        }
    });
    
});
});

 $("a.logout").click(function(e) {
    e.preventDefault();
	var location = $(this).attr('href');
    bootbox.confirm("Are you sure want to logout?", function(confirmed) {
       if(confirmed) {
        window.location.replace(location);
        }
    });
	

});

	$("#showmodallogin").click(function(e)
	{
		$('#modalRegister').modal('hide');
		$('#modalLogin').modal('show');
	});
	
	$("#showmodalregister").click(function(e)
	{
		$('#modalLogin').modal('hide');
		$('#mainmodalregister').modal('show');
	});
	
	
	$("#showartistmodal").click(function(e)
	{
		$('#mainmodalregister').modal('hide');
		$('#modalartistRegister').modal('show');
	});
	
	$("#showusermodal").click(function(e)
	{
		$('#mainmodalregister').modal('hide');
		$('#modaluserRegister').modal('show');
	});
	
	$("#showmodalPassword").click(function(e)
	{
		$('#modalLogin').modal('hide');
		$('#modalforgotpassword').modal('show');
	});
	
	
</script>

</body>
</html>
	
	
	