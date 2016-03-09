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
	<?php echo $this->Html->charset(); ?>
	<title> Admin </title>
	<?php
		echo $this->Html->meta('icon');
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

	
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('admin');
		echo $this->Html->css('ionicons.min');
		echo $this->Html->css('font-awesome.min');
		
		echo $this->Html->script('jquery.min');
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('jquery-ui.min');
		
		echo $this->Html->script('bootbox');
		echo $this->Html->script('common');
		echo $this->Html->script('admin/app');
		echo $this->Html->css('bootstrap-fileupload');
		echo $this->Html->script('bootstrap-fileupload');
 
 		echo $this->Html->script('jquery.form');
		echo $this->Html->script('jquery.prettyPhoto');
		// Validation Engine for form validations
		echo $this->Html->script('validationplugin/validationengine/js/languages/jquery.validationEngine-en'); // Form Validations
		echo $this->Html->script('validationplugin/validationengine/js/jquery.validationEngine'); // Form Validations
		echo $this->Html->css('jqueryvalidationplugin/validationEngine.jquery'); // Form Validations CSS
	?>
	
   <script type="text/javascript">
	
		var strGlobalSiteBasePath = '<?php echo Router::url('/',true); ?>';
		jQuery('.search').validationEngine('validate');
		</script>
	</head>
	<?php 
	if(!$logged_in)
	{?>
		<body class="bg-black">
	<?php
	}
	else
	{?>
   <body class="skin-blue  fixed pace-done">
   

	   <header class="header">
            <a href="javascript:void(0);" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Artform Partform 
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                      <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                                <span class="label label-warning"><?php echo $countusers;?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header"> <?php echo $countusers;?> new artist joined</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                    <?php
									foreach ($regusers as $row)
									{?>
                                    <li><a href="#"><i class="ion ion-ios7-person info"></i><?php echo ucfirst($row['Users']['user_fname']); ?> &nbsp;<?php echo ucfirst($row['Users']['user_lname']); ?></a></li>
                                        <?php
									}?>
                                    </ul>
                                </li>
                                <li class="footer"><a href="javascript:void(0);" onclick="return changeNotify();">View all</a></li>
                            </ul>
                        </li>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>  <?php echo ucfirst($current_user['admin_fname']); ?> <?php echo ucfirst($current_user['admin_lname']); ?>  <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo Router::url('/',true)."assets/admin/".$current_user['admin_image'];?>" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo ucfirst($current_user['admin_fname']); ?> <?php echo ucfirst($current_user['admin_lname']); ?> 
                                        <small><?php echo $currentusertype['Usertype']['usertype_name'];?></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
  
                                        <a adminid="<?php echo $current_user['admin_id'];?>"  id="updateprofile" class="btn btn-default btn-flat updateprofile">Update Profile</a>
                                    </div>
                                    <div class="pull-right">
                                       <!-- <a href="#" class="btn btn-default btn-flat">Sign out</a>-->
                                            <?php echo $this->Html->link(
   'Sign out',array('controller'=>'admins','action'=>'logout'),array('escape'=>false,'class'=>'btn btn-default btn-flat logout'));
?> 
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                        
                            <img src="<?php echo Router::url('/',true)."assets/admin/".$current_user['admin_image'];?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php echo ucfirst($current_user['admin_fname']); ?></p>
                            
                            <a href="#"><i class="fa fa-circle text-success"></i><?php echo $currentusertype['Usertype']['usertype_name'];?></a>
                        </div>
                    </div>
                    <!-- search form -->
                  <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="<?php echo ($current_controller == 'admins' && $current_action == 'dashboard' ? 'active' : ''); ?>">
                             <?php echo $this->Html->link(
   '<i class="fa fa-dashboard"></i> <span>Dashboard</span>',array('controller'=>'admins','action'=>'dashboard'),array('escape'=>false));
?>
                        </li>
                        <li class="<?php echo ($current_controller == 'admins' && $current_action == 'Users' ? 'active' : ''); ?>">
                        <?php echo $this->Html->link(
   '<i class="fa fa-user"></i> <span>Admin Users</span>',array('controller'=>'admins','action'=>'Users'),array('escape'=>false));
?>
                        </li>
                        
                           <li class="<?php echo ($current_controller == 'admins' && $current_action == 'websiteusers' ? 'active' : ''); ?>">
                        <?php echo $this->Html->link(
   '<i class="fa fa-user"></i> <span>Website Users</span>',array('controller'=>'admins','action'=>'websiteusers'),array('escape'=>false));
?>
                        </li>
						
                        
                        <li class="<?php echo ($current_controller == 'admins' && $current_action == 'banner' ? 'active' : ''); ?>">
                        <?php echo $this->Html->link(
   '<i class="fa fa-user"></i> <span>Website Banners</span>',array('controller'=>'admins','action'=>'banner'),array('escape'=>false));
?>
                        </li>
						
						 <li class="<?php echo ($current_controller == 'admins' && $current_action == 'usermedia' ? 'active' : ''); ?>">
                        <?php echo $this->Html->link(
   '<i class="fa fa-user"></i> <span>User Media</span>',array('controller'=>'admins','action'=>'usermedia'),array('escape'=>false));
?>
                        </li>
						
						 <li class="<?php echo ($current_controller == 'admins' && $current_action == 'mediacomments' ? 'active' : ''); ?>">
                        <?php echo $this->Html->link(
   '<i class="fa fa-comment"></i> <span>Media Comments</span>',array('controller'=>'admins','action'=>'mediacomments'),array('escape'=>false));
?>
                        </li>
                          <li class="<?php echo ($current_controller == 'packages' && $current_action == 'index' ? 'active' : ''); ?>">
           <?php echo $this->Html->link(
   '<i class="fa fa-angle-double-right"></i> Package',array('controller'=>'packages','action'=>'index'),array('escape'=>false));
?>
							 </li>
                        <li class="treeview <?php echo (($current_controller == 'categories' ) && ( $current_action == 'index'||'subcategories'||'subsubcategories') ? 'active' : ''); ?>">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>Manage Categories </span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                      	  <li class="<?php echo ($current_controller == 'categories' && $current_action == 'index' ? 'active' : ''); ?>">
           <?php echo $this->Html->link(
   '<i class="fa fa-angle-double-right"></i> Category',array('controller'=>'categories','action'=>'index'),array('escape'=>false));
?>
							 </li>
                              <li class="<?php echo ($current_controller == 'categories' && $current_action == 'subcategories' ? 'active' : ''); ?>">
           <?php echo $this->Html->link(
   '<i class="fa fa-angle-double-right"></i> Subcategory',array('controller'=>'categories','action'=>'subcategories'),array('escape'=>false));
?>
							 </li>
							 
							 <li class="<?php echo ($current_controller == 'categories' && $current_action == 'subsubcategories' ? 'active' : ''); ?>">
           <?php echo $this->Html->link(
   '<i class="fa fa-angle-double-right"></i> Subsubcategory',array('controller'=>'categories','action'=>'subsubcategories'),array('escape'=>false));
?>
							 </li>
                             
                         
                            </ul>
                        </li>
               
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1> <?php echo $page_title;?> </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo Router::url('/',true)."admins/dashboard";?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"><?php echo $this->params['action']=='index'? ucfirst($this->params['controller']):ucfirst($this->params['action']);?></li>
                    </ol>
                </section>
                 
		
			         <!-- Main content -->
                <section class="content">
                <?php

}?>
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                       <?php echo $this->Session->flash(); ?>

					<?php echo $this->fetch('content'); ?>
					
				   </div><!-- /.row -->

                    <!-- Main row -->
                
		</section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

      
      
 <div class="modal fade" id="modalUpdateProfile">
  <div class="modal-dialog">
    <div class="modal-content">
      <form name="frmUpdateProfile" id="frmUpdateProfile" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Update Profile</h4>
      </div>
      <div class="modal-body">
	
      
            <div class="form-group">
                <label  for="Name">First Name  </label>
                     <input type="hidden" name="data[update_admin_id]" class="form-control validate[required]" id="update_admin_id" placeholder="Category name"/>
                    <input type="text" id="update_admin_fname" name="data[update_admin_fname]" class="form-control validate[required,custom[onlyLetterSp]]" placeholder="First name"/>
                </div>
                
                 <div class="form-group">
                <label  for="Name">Last Name  </label>
                    
                    <input type="text" name="data[update_admin_lname]" id="update_admin_lname" class="form-control validate[required,custom[onlyLetterSp]]" placeholder="Last name"/>
                </div>
                
				  <div class="form-group">
						<label  for="Name">Username  </label>
                        <input type="email" name="data[update_admin_email]" id="update_admin_email" class="form-control form-control validate[required,[funcCall[validateEmail]]]" placeholder="Username"/>
                    </div>
                      
					<div class="form-group">
						<label  for="Name">Password  </label>
                        <input type="password" name="data[update_admin_password]" id="update_admin_password" class="form-control form-control validate[minSize[6]]" placeholder="Password"/>
                    </div>
                      
                    <div class="form-group">
						<label  for="Name">Confirm Password  </label>
                        <input type="password" name="data[update_admin_confirmpassword]" id="update_admin_confirmpassword" class="form-control validate[equals[update_admin_password]]" placeholder="Confirm Password"/>
                    </div>
					
                   <div class="form-group">
	 					<label  for="Name"> Image </label>
			           <input type="file" name="userimage"  placeholder="Upload image..."  >
                         <img id="showcatImage" src="" height="200px" width="200px" class="img-responsive thumbnail" style="margin-top:20px;"/>
	               </div>
                   
     
                </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="return fnToUpdateAdminProfile();" id="addItem" >Save changes</button>
      </div>
	  </form>
	  </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->     
        
<?php echo $this->element('sql_dump'); ?>
<?php echo $strActionScript; ?>

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
    bootbox.confirm("Are you sure you want to logout?", function(confirmed) {
       if(confirmed) {
        window.location.replace(location);
        }
    });
});
</script>


	
</body>
</html>