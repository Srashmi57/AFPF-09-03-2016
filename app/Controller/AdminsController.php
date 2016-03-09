<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class AdminsController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function index(){
		
			//loading default admin login page
			//content coming from model
			//passing content to home view
			
			//$content = "Hi, Welcome To Winner Car Zone Admin Panel.";
			//$this->set("view_content",$content);
			
			if($this->Auth->loggedIn())
			{
				$this->redirect(array('controller'=>'admins','action'=>'dashboard'));
			}

			if($this->request->is('post'))
			{
				$this->loadModel('Admin');
				
				$this->request->data['Admin']['admin_email'] = addslashes(trim($this->request->data['Admin']['email']));
				$this->request->data['Admin']['admin_password'] = addslashes(trim($this->request->data['Admin']['password']));
								
				$this->Admin->set($this->request->data);
				
				if($this->Admin->validates())
				{
					if($this->Auth->login())
					{
				
						if($this->Auth->user('admin_status') == 0)
						{
							//$this->Session->setFlash('Welcome To WCZ');
							
						
							$this->redirect($this->Auth->redirectUrl());
						}
						else
						{
							$this->Session->setFlash('Your account has been disabled, please contact with support.');
							$this->redirect($this->Auth->logout());
						}
					}
					else
					{
						//$this->Session->setFlash('Your username and password combination was incorrect');
						$this->Session->setFlash('Your username and password combination was incorrect.', 'default', array('class' => 'alert alert-danger'));
					}
				}
				else
				{
					$errors = $this->Admin->invalidFields();
					$strRegerrorMessage = "";
					if(is_array($errors) && (count($errors)>0))
					{
						foreach($errors as $errorVal)
						{
							$strRegerrorMessage .= "<br> Error: ".$errorVal['0'];
						}
						
						$this->Session->setFlash($strRegerrorMessage);
					}	
				}
				
				
			}
			
	}
	
	public function dashboard()
	{
		//get last 3 registerd artist 
		
			$this->loadModel('Users'); // Load model
			$this->set('page_title','Dashboard');
													
			$arr_ArtistData= $this->Users->find('all', array('conditions'=>array('Users.usertype_id'=>2),'fields' => array('Users.user_id','Users.user_fname','Users.user_lname','Users.user_image','Users.user_biography','Users.created'), 'order' => array('Users.created DESC'),'limit' => 3));
	
		//get last 3 registerd users
		
		$arr_userData= $this->Users->find('all', array('conditions'=>array('Users.usertype_id'=>3),'fields' => array('Users.user_id','Users.user_fname','Users.user_lname','Users.user_image','Users.user_biography','Users.created'), 'order' => array('Users.created DESC'),'limit' => 3));
		
		 $this->set('arr_ArtistData',$arr_ArtistData);
		 $this->set('arr_userData',$arr_userData);
	}
	
	public function profile()
	{
	}
	
	public function Users(){
	
		// Admins List View
		$this->loadModel('Admin'); // Load model
		$this->set('page_title','Admin Users');
		$this->set('arr_UserTypeList',$this->fnToGetAllUserTypeListforadmin());
		
		 $condition = '';
			if($this->request->is('post')) 
			{
				$searchtext = addslashes(trim($_POST['txtsearch']));
				$condition = 'and (Admin.admin_fname  Like "%'.addslashes($searchtext).'%" Or Admin.admin_lname Like "%'.addslashes($searchtext).'%" or concat(Admin.admin_fname," ",Admin.admin_lname) Like "%'.addslashes($searchtext).'%" )';
			}
			
		$this->paginate = array(
					 'fields' => array('usertype.usertype_name', 'Admin.*'),
				    'joins' => array(array('alias' => 'usertype','table' => 'usertype','type' => 'INNER','conditions' => '`Admin`.`usertype_id` = `usertype`.`usertype_id`')),
					'conditions' => '`Admin`.`usertype_id!=` 1 '.$condition.'' , 'limit' => 5);
					
		 $this->set( 'users', $this->paginate() ); 
		 $this->categories = $this->Components->load('category');
		 $this->set('arr_CategoryList',$this->categories->fnToGetAllCategoryList());
	}
	
	public function fnToAddAdminProcess(){
		
		
		
		if($this->request->is('post'))
		{
			/*print("<pre>");
			print_r($this->request->data);
			exit;*/
			
			$this->loadModel('Admin');
			$admin_email = addslashes(trim($_POST['txtEmail'])); // To check existence
			
			$arrCountTocheckExistence = $this->Admin->find('count',array('conditions'=>array('admin_email'=>$admin_email)));
			
			if($arrCountTocheckExistence > 0)
			{
					$RespArray = array();
					$RespArray['status'] = "alreadyexist";
					$RespArray['message'] = "Provided email id is already exist.";
					$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-warning'));
					echo json_encode($RespArray);
					exit;
			}
			else
			{
			
				$this->request->data['Admin']['admin_fname'] = addslashes(trim($_POST['txtFirstName']));
				$this->request->data['Admin']['admin_lname'] = addslashes(trim($_POST['txtLastName']));
				$this->request->data['Admin']['admin_email'] = $admin_email;
				
				$this->request->data['Admin']['usertype_id'] = addslashes(trim($this->request->data['usertype_list']));
				
			
				$this->Admin->set($this->request->data);
				$boolAdminSaved = $this->Admin->save($this->request->data);
				
			 	$getInsertid_adminID = $this->Admin->getLastInsertID();
			 
				if($boolAdminSaved)
				{
					
					
					if(is_array($_FILES) && (count($_FILES)>0))
					{
						if($_FILES['userimage']['name'] != "")
						{
							$this->loadModel('Admin');
							 $intFilesCount = count($_FILES['userimage']['name']);
							
							
								 $strUserimageName = $_FILES['userimage']['name'];
								
								 $strFileExt = pathinfo($strUserimageName);
								 $imageName = 'user_image_'.$getInsertid_adminID.'.'.$strFileExt['extension'];
								
								$strUserimageTmpName = $_FILES['userimage']['tmp_name'];
								
								move_uploaded_file($strUserimageTmpName,WWW_ROOT . 'assets/admin/'.$imageName);
								
								$this->request->data['Admin']['admin_id'] = $getInsertid_adminID;
								$this->request->data['Admin']['userimage'] = $imageName;
							
								$this->Admin->set($this->request->data);
								$boolCatImageSaved = $this->Admin->fnUpdateAdminImage($this->request->data['Admin']);
							
						}
					}
					
					
					
					
				}
				if($boolAdminSaved)
				{
					$RespArray = array();
					$RespArray['status'] = "success";
					$RespArray['message'] = "New Admin User Has Been Added Successfully";
				}
				else
				{  
					$RespArray = array();
					$RespArray['status'] = "fail";
					$RespArray['message'] = "Add Admin User Process Has Been Failed.";
				}
					$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-success'));
					echo json_encode($RespArray);
					exit;
			}
		}
		else
		{  
			$RespArray = array();
			$RespArray['status'] = "fail";
			$RespArray['message'] = "Add To New Sub-Admin Process Has Been Failed.";
			$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-danger'));
			echo json_encode($RespArray);
			exit;
		}
		
	}
	
	
	public function admindeleteusermedia($usermedia_id,$type=Null)
	{
	
			$compFileUploader = $this->Components->load('Fileupload');
			$booldeletemedia = $compFileUploader->admindeletemedia($usermedia_id,$type);
			$modelusermedia = ClassRegistry::init('UserMedia');
			$usermedia_path =  $modelusermedia->field('usermedia_path', array('usermedia_id' => $usermediaid));
			
			if($booldeletemedia)
			{
				$RespArray = array();
				$RespArray['status'] = "success";
				$RespArray['message'] = "Delete media  Process Has Been Successful.";
				
			}
			else
			{  
				$RespArray = array();
				$RespArray['status'] = "fail";
				$RespArray['message'] = "Delete media Process Has Been Failed";
			
			}
			$filepath= $usermedia_path;
		unlink($filepath);
				echo json_encode($RespArray);
					exit;
	}
	
	public function getSubAdminUpdateData(){
	
		$this->layout = NULL;
		$this->autoRender = NULL;
		
		if($this->request->is('post'))
		{
			$this->loadModel('Admin');
			$admin_id = $_POST['admin_id'];
						
			$arr_AdminData = $this->Admin->find('all',array('conditions'=>array(
													'admin_id'=>$admin_id)));
			
				$arrAdminData = array();
				$arrAdminData['status'] = 'success';
				$arrAdminData['admin_id'] = $arr_AdminData[0]['Admin']['admin_id'];
				$arrAdminData['admin_fname'] = $arr_AdminData[0]['Admin']['admin_fname'];
				$arrAdminData['admin_lname'] = $arr_AdminData[0]['Admin']['admin_lname'];
				$arrAdminData['admin_email'] = $arr_AdminData[0]['Admin']['admin_email'];
				$arrAdminData['admin_password'] = $arr_AdminData[0]['Admin']['admin_password'];
				$arrAdminData['usertype_id'] = $arr_AdminData[0]['Admin']['usertype_id'];
				$arrAdminData['admin_status'] = $arr_AdminData[0]['Admin']['admin_status'];
				
				if($arr_AdminData[0]['Admin']['admin_image']!=""&&file_exists('assets/admin/'.$arr_AdminData[0]['Admin']['admin_image']))
				{
					$arrAdminData['admin_image'] = Router::url('/', true).'assets/admin/'.$arr_AdminData[0]['Admin']['admin_image'];
				}
				else
				{
					$arrAdminData['admin_image']=  Router::url('/', true).'assets/default/user-icon-ap.png';
				}
				echo json_encode($arrAdminData);
				exit;								
		}
	}
	
	public function fnToUpdateSubAdminProfile(){
	
		$this->layout = NULL;
		$this->autoRender = NULL;
		
		if($this->request->is('post'))
		{
			
			$this->loadModel('Admin');
			$intGetAdmin_Id = addslashes(trim($this->request->data['update_admin_id']));
			$strGetAdmin_email = addslashes(trim($this->request->data['update_admin_email'])); // To check existence
			$strGetAdmin_fname = addslashes(trim($this->request->data['update_admin_fname']));
			$strGetAdmin_lname = addslashes(trim($this->request->data['update_admin_lname']));
			$arrCountTocheckExistence = $this->Admin->find('count',array('conditions'=>array('admin_email'=>$strGetAdmin_email,'NOT' => array( 
      'admin_id' => $intGetAdmin_Id
    ))));
			
			
				
				
				if($arrCountTocheckExistence > 0)
				{
					$RespArray = array();
					$RespArray['status'] = "alreadyexist";
					$RespArray['message'] = "Provided email id is already exist.";
					$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-info'));
					echo json_encode($RespArray);
					exit;
				}
				else
				{
					$boolUpdateSubAdmin = $this->Admin->updateAll(array(
											'Admin.admin_fname' => "'".$strGetAdmin_fname."'",
											'Admin.admin_lname' => "'".$strGetAdmin_lname."'",
											'Admin.admin_email' => "'".$strGetAdmin_email."'"
											
										),
									array('Admin.admin_id' => $intGetAdmin_Id)
							);
						if($this->request->data['update_admin_password']!="")
						{
							$strGetAdmin_orgpassword = addslashes(trim($this->request->data['update_admin_password']));
							$strGetAdmin_password = AuthComponent::password(addslashes(trim($this->request->data['update_admin_password'])));
										
														$boolUpdateSubAdmin = $this->Admin->updateAll(array(
														'Admin.admin_orgpassword' => "'".$strGetAdmin_orgpassword."'",
														'Admin.admin_password' => "'".$strGetAdmin_password."'"
														
													),
												array('Admin.admin_id' => $intGetAdmin_Id)
										);
						}
					$this->Session->write('Auth.BackendUser.admin_fname', $strGetAdmin_fname); //updating first_name only   
					$this->Session->write('Auth.BackendUser.admin_lname', $strGetAdmin_lname); //updating last name   
					$this->Session->write('Auth.BackendUser.admin_email', $strGetAdmin_email);
					
					if($boolUpdateSubAdmin)
					{
						if(is_array($_FILES) && (count($_FILES)>0))
							{
								if($_FILES['userimage']['name'] != "")
								{
									$this->loadModel('Admin');
									 $intFilesCount = count($_FILES['userimage']['name']);
									
									
										 $strUserimageName = $_FILES['userimage']['name'];
										
										 $strFileExt = pathinfo($strUserimageName);
										 $imageName = 'user_image_'.$intGetAdmin_Id.rand().'.'.$strFileExt['extension'];
										
										$strUserimageTmpName = $_FILES['userimage']['tmp_name'];
										
										move_uploaded_file($strUserimageTmpName,WWW_ROOT . 'assets/admin/'.$imageName);
										
										$this->request->data['Admin']['admin_id'] = $intGetAdmin_Id;
										$this->request->data['Admin']['userimage'] = $imageName;
										
										$this->Admin->set($this->request->data);
										$boolCatImageSaved = $this->Admin->fnUpdateAdminImage($this->request->data['Admin']);
										$this->Session->write('Auth.BackendUser.admin_image', $imageName); //updating User Image 
								}
							}
						
						$RespArray = array();
						$RespArray['status'] = "success";
						$RespArray['message'] = "Your Profile Updated Successful.";
					}
					else
					{  
						$RespArray = array();
						$RespArray['status'] = "fail";
						$RespArray['message'] = "Profile Update Process Has Been Failed";
					}
						$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-success'));
						echo json_encode($RespArray);
						exit;
				}
			
		}
		else
		{  
			$RespArray = array();
			$RespArray['status'] = "fail";
			$RespArray['message'] = "Update User Process Has Been Failed";
			$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-danger'));
			echo json_encode($RespArray);
			exit;
		}
	
	}
	
	public function fnToUpdateSubAdmin(){
	
		$this->layout = NULL;
		$this->autoRender = NULL;
		
		if($this->request->is('post'))
		{
			/*print("<pre>");
			print_r($this->request->data);
			exit;*/
			
			$this->loadModel('Admin');
			$intGetAdmin_Id = addslashes(trim($this->request->data['update_admin_id']));
			//$strGetAdmin_email = addslashes(trim($this->request->data['update_admin_email'])); // To check existence
			$strGetAdmin_fname = addslashes(trim($this->request->data['update_admin_fname']));
			$strGetAdmin_lname = addslashes(trim($this->request->data['update_admin_lname']));
			$intGetAdmin_Usertypeid = addslashes(trim($this->request->data['usertype_list']));
		
			
			//$arrTocheckExistence = $this->Admin->find('all',array('conditions'=>array('admin_id'=>$intGetAdmin_Id)));
			//$adminsExistEmailID = $arrTocheckExistence[0]['Admin']['admin_email'];
			
			
				$boolUpdateSubAdmin = $this->Admin->updateAll(array(
										'Admin.admin_fname' => "'".$strGetAdmin_fname."'",
										'Admin.admin_lname' => "'".$strGetAdmin_lname."'",
										'Admin.usertype_id' => "'".$intGetAdmin_Usertypeid."'"
										
									),
								array('Admin.admin_id' => $intGetAdmin_Id)
						);
			
				if($boolUpdateSubAdmin)
				{
					if(is_array($_FILES) && (count($_FILES)>0))
						{
							if($_FILES['userimage']['name'] != "")
							{
								$this->loadModel('Admin');
								 $intFilesCount = count($_FILES['userimage']['name']);
								
								
									 $strUserimageName = $_FILES['userimage']['name'];
									
									 $strFileExt = pathinfo($strUserimageName);
									 $imageName = 'user_image_'.$intGetAdmin_Id.'.'.$strFileExt['extension'];
									
									$strUserimageTmpName = $_FILES['userimage']['tmp_name'];
									
									move_uploaded_file($strUserimageTmpName,WWW_ROOT . 'assets/admin/'.$imageName);
									
									$this->request->data['Admin']['admin_id'] = $intGetAdmin_Id;
									$this->request->data['Admin']['userimage'] = $imageName;
								
									$this->Admin->set($this->request->data);
									$boolCatImageSaved = $this->Admin->fnUpdateAdminImage($this->request->data['Admin']);
								
							}
						}
					
					$RespArray = array();
					$RespArray['status'] = "success";
					$RespArray['message'] = "Admin User Profile Has Been Updated Successfully";
				}
				else
				{  
					$RespArray = array();
					$RespArray['status'] = "fail";
					$RespArray['message'] = "Update User Process Has Been Failed";
				}
					$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-success'));
					echo json_encode($RespArray);
					exit;
			
			
		}
		else
		{  
			$RespArray = array();
			$RespArray['status'] = "fail";
			$RespArray['message'] = "Update User Process Has Been Failed";
			$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-danger'));
			echo json_encode($RespArray);
			exit;
		}
	
	}
	
	public function logout(){
		
		$this->redirect($this->Auth->logout());
	
	}
	
	public function fnToChangeAdminStatus() {
	
		$this->layout = NULL;
		$this->autoRender = NULL;
		
		if($this->request->is('post'))
		{
			$admin_id = $_POST['admin_id'];
			$admin_status = $_POST['admin_status'];
			
			$this->loadModel('Admin');
			$adminStatChange = $this->Admin->updateAll(array('Admin.admin_status' => $admin_status),
															array('Admin.admin_id =' => $admin_id));
			
			if($adminStatChange)
			{ 
				$RespArray = array();
				$RespArray['status'] = "success";
			}
			else
			{  
				$RespArray = array();
				$RespArray['status'] = "fail";
			}
				echo json_encode($RespArray);
				exit;
		}
	}
	
	public function WebsiteUsers()
	{
		//website users List View
		$this->loadModel('Users'); // Load model
		$this->set('page_title','Website Users');
		$this->set('arr_UserTypeList',$this->fnToGetAllUserTypeListforadmin());
		
		//get count artist count 

			$arrcountartist = $this->Users->find('count',array('conditions'=>array('usertype_id'=>2)));
		// get user count
		$arrcountuser = $this->Users->find('count',array('conditions'=>array('usertype_id'=>3)));
		 $condition = '';
			if($this->request->is('post')) 
			{
				$searchtext = addslashes(trim($_POST['txtsearch']));
				$condition = ' (Users.user_fname  Like "%'.$searchtext.'%" Or Users.user_lname Like "%'.$searchtext.'%" or concat(Users.user_fname," ",Users.user_lname) Like "%'.addslashes($searchtext).'%")';
			}
	
		$this->paginate = array(
					 'fields' => array('usertype.usertype_name', 'Users.*'),
				    'joins' => array(array('alias' => 'usertype','table' => 'usertype','type' => 'INNER','conditions' => '`Users`.`usertype_id` = `usertype`.`usertype_id`')),
					'conditions' => $condition , 'limit' => 10);
					 
		  $this->set('websiteusers',$this->paginate('Users'));
		  $this->set('arrcountartist',$arrcountartist);
		  $this->set('arrcountuser',$arrcountuser);
		
	}
	
	public function banner()
	{
		$this->loadModel('banner'); // Load model
		$this->set('page_title','Website Banners');
		$this->categories = $this->Components->load('category');
	
		 $this->set('arr_CategoryList',$this->categories->fnToGetAllCategoryList());
		 $condition = '';
			if($this->request->is('post')) 
			{
				$searchtext = addslashes(trim($_POST['txtsearch']));
				$condition = ' (banner.banner_title  Like "%'.$searchtext.'%" Or banner.banner_subtitle Like "%'.$searchtext.'%")';
			}
			
			$this->paginate = array(
					 'fields' => array( 'banner.*','cat.category_name'),
					 'joins' => array(array('alias' => 'cat','table' => 'category','type' => 'INNER','conditions' => '`banner`.`category_id` = `cat`.`category_id`')),
					'conditions' => $condition ,'order'=>'created Desc', 'limit' => 10);
					 
		  $this->set('websitebanners',$this->paginate('banner'));
	}
	
	public function fnToAddBannerProcess()
	{
		
		if($this->request->is('post'))
		{
			
			
			$this->loadModel('banner');
			
				$this->request->data['banner']['banner_title'] = addslashes(trim($_POST['txtBannerTitle']));
				$this->request->data['banner']['banner_subtitle'] = addslashes(trim($_POST['txtBannerSubTitle']));
				$this->request->data['banner']['category_id'] = $this->request->data['category_list'];
				
				$this->banner->set($this->request->data);
				
					
					if(is_array($_FILES) && (count($_FILES)>0))
					{
						if($_FILES['bannerimage']['name'] != "")
						{
							$this->loadModel('banner');
							 $intFilesCount = count($_FILES['bannerimage']['name']);
							
							
								  $strBannerimageName = $_FILES['bannerimage']['name'];
								 
								list($original_width, $original_height) = getimagesize($_FILES['bannerimage']['tmp_name']);
								if($original_width <1920 && $original_height <300)
								{
									
										$RespArray = array();
										$RespArray['status'] = "image";
										$RespArray['message'] = "Image width greater than 1920 or height greater than 300.";
										$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-danger'));
										echo json_encode($RespArray);
											exit;
								}
								else
								{
									$strFileExt = pathinfo($strBannerimageName);
									$boolbannerSaved = $this->banner->save($this->request->data);
									$getInsertid_bannerID = $this->banner->getLastInsertID();
									 $imageName = 'banner_image_'.$getInsertid_bannerID.'.'.$strFileExt['extension'];
									
									$strBannerimageTmpName = $_FILES['bannerimage']['tmp_name'];
									$Image = $this->Components->load('Image');
									
									 $imageName = $Image->resize(1920,300,$_FILES['bannerimage']['tmp_name'],$strFileExt['extension'],'assets/banner/',$getInsertid_bannerID);
									
									//move_uploaded_file($strBannerimageTmpName,WWW_ROOT . 'assets/banner/'.$imageName);
									
									$this->request->data['banner']['banner_id'] = $getInsertid_bannerID;
									$this->request->data['banner']['bannerimage'] = $imageName;
									$this->banner->set($this->request->data);
									 $boolCatImageSaved = $this->banner->fnUpdateBannerImage($this->request->data['banner']);
									
									
									if($boolbannerSaved)
									{
										$RespArray = array();
										$RespArray['status'] = "success";
										$RespArray['message'] = "New Website Banner Has Been Added Successfully";
										$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-success'));
										echo json_encode($RespArray);
											exit;
									}
									else
									{  
										$RespArray = array();
										$RespArray['status'] = "fail";
										$RespArray['message'] = "Add banner Process Has Been Failed.";
										$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-success'));
										echo json_encode($RespArray);
											exit;
									}
									
							    }
							
						}
					}
					
					
		}
		else
		{  
			$RespArray = array();
			$RespArray['status'] = "fail";
			$RespArray['message'] = "Add banner Process Has Been Failed.";
			$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-danger'));
			echo json_encode($RespArray);
			exit;
		}
		
	
	}
	
	public function Updatewebsitebanner()
	{
	
			$this->loadModel('banner');
			
			   $banner_id = $_POST["banner_id"];
			  
			
				$arr_bannerData = $this->banner->find('first',array('conditions'=>array(
													'banner_id'=>$banner_id)));
			
			
			//print_r($arr_bannerData);
			//exit();
				$arr_bannernewData = array();
				$arr_bannernewData['status'] = 'success';
				$arr_bannernewData['banner_id'] = $arr_bannerData['banner']['banner_id'];
				$arr_bannernewData['banner_title'] = $arr_bannerData['banner']['banner_title'];
				$arr_bannernewData['category_id'] = $arr_bannerData['banner']['category_id'];
				$arr_bannernewData['banner_subtitle'] = $arr_bannerData['banner']['banner_subtitle'];
				$arr_bannernewData['banner_image'] = Router::url('/', true).'assets/banner/'.$arr_bannerData['banner']['banner_image'];
				
			
			$arr_bannernewData  = json_encode($arr_bannernewData);
			echo $arr_bannernewData;
			exit();
			
			

		
	}	
	
	
	
	public function fnToUpdateBannerprocess(){
	
		if($this->request->is('post'))
		{
			$this->loadModel('banner');
			 $intGetbannerid = addslashes(trim($this->request->data['update_bannerid']));
			
			 $strGetBannerTitle = addslashes(trim($this->request->data['update_banner_title'])); 
			 $strGetBannersubTitle = addslashes(trim($this->request->data['update_banner_subtitle'])); 
			   $strGetBannercatid = addslashes(trim($this->request->data['update_cat_list'])); 
			  

					if(is_array($_FILES) && (count($_FILES)>0))
					{
						if($_FILES['bannerimage']['name'] != "")
						{
							$this->loadModel('banner');
							 $intFilesCount = count($_FILES['bannerimage']['name']);
							list($original_width, $original_height) = getimagesize($_FILES['bannerimage']['tmp_name']);
								if($original_width <1920 && $original_height <300)
								{
									
										$RespArray = array();
										$RespArray['status'] = "image";
										$RespArray['message'] = "Image width greater than 1920 or height greater than 300.";
										$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-danger'));
										echo json_encode($RespArray);
										exit;
								}
								else
								{
									$boolUpdatebanner = $this->banner->updateAll(array(
														'banner.banner_title' => "'".$strGetBannerTitle."'"	,
														'banner.banner_subtitle' => "'".$strGetBannersubTitle."'",
														'banner.category_id' => "'".$strGetBannercatid."'"
													),
												array('banner.banner_id' => $intGetbannerid)
										);
										
										
									  $oldbannerimagename = $this->banner->field('banner_image', array('banner_id' => $intGetbannerid));
									
											if($oldbannerimagename!="")
											{
												 $imapath = WWW_ROOT."assets/banner/".$oldbannerimagename;
													unlink($imapath);
											}
								
										
											 $strBannerimageName = $_FILES['bannerimage']['name'];
											
											 $strFileExt = pathinfo($strBannerimageName);
											// $imageName = 'banner_image_'.$intGetbannerid.'.'.$strFileExt['extension'];
											
											$strBannerimageTmpName = $_FILES['bannerimage']['tmp_name'];
											$Image = $this->Components->load('Image');
									
											$imageName = $Image->resize(1920,300,$_FILES['bannerimage']['tmp_name'],$strFileExt['extension'],'assets/banner/',$intGetbannerid);
									
											//move_uploaded_file($strBannerimageTmpName,WWW_ROOT . 'assets/banner/'.$imageName);
								
											$this->request->data['banner']['banner_id'] = $intGetbannerid;
											$this->request->data['banner']['bannerimage'] = $imageName;
										
											$this->banner->set($this->request->data);
											$boolCatImageSaved = $this->banner->fnUpdateBannerImage($this->request->data['banner']);
																		
												if($boolUpdatebanner)
												{
													$RespArray = array();
													$RespArray['status'] = "success";
													$RespArray['message'] = "Website Banner Has Been Updated Successfully";
													$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-success'));
													echo json_encode($RespArray);
														exit;
												}
												else
												{  
													$RespArray = array();
													$RespArray['status'] = "fail";
													$RespArray['message'] = "Website Banner Update Has Been Failed";
													$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-danger'));
													echo json_encode($RespArray);
													exit;
												}
											
								}
							
						}
					}
					else
					{
						$boolUpdatebanner = $this->banner->updateAll(array(
														'banner.banner_title' => "'".$strGetBannerTitle."'"	,
														'banner.banner_subtitle' => "'".$strGetBannersubTitle."'"	,
														'banner.category_id' => "'".$strGetBannercatid."'"														
													),
												array('banner.banner_id' => $intGetbannerid)
										);
										
						if($boolUpdatebanner)
							{
								$RespArray = array();
								$RespArray['status'] = "success";
								$RespArray['message'] = "Update Banner Process Has Been Successful.";
								$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-success'));
								echo json_encode($RespArray);
									exit;
							}
							else
							{  
								$RespArray = array();
								$RespArray['status'] = "fail";
								$RespArray['message'] = "Update Banner Process Has Been Failed";
								$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-danger'));
								echo json_encode($RespArray);
								exit;
							}
					}
					
					
			
		}
		else
		{  
			$RespArray = array();
			$RespArray['status'] = "fail";
			$RespArray['message'] = "Update banner Process Has Been Failed.";
			$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-danger'));
			echo json_encode($RespArray);
			exit;
		}
	}
	
	
	public function mediacomments()
	{
		$this->loadModel('MediaComment'); // Load model
		$this->set('page_title','Media comments');
		 $condition = '';
			if($this->request->is('post')) 
			{
				$searchtext = addslashes(trim($_POST['txtsearch']));
				$condition = ' (MediaComment.usermedia_comment  Like "%'.$searchtext.'%" OR usermedia.usermedia_title Like "%'.$searchtext.'%" OR  users.user_fname Like "%'.$searchtext.'%" OR users.user_lname Like "%'.$searchtext.'%" or concat(users.user_fname," ",users.user_lname) Like "%'.addslashes($searchtext).'%")';
			}
		$this->paginate = array(
					 'fields' => array( 'MediaComment.usermedia_comment','MediaComment.mediacomment_id','MediaComment.mediacomment_status','users.user_fname','users.user_lname','usermedia.usermedia_title','usermedia.usermedia_name','usertype.usertype_name'),
					  'joins' => array(array('alias' => 'users','table' => 'users','type' => 'INNER','conditions' => '`users`.`user_id` = `MediaComment`.`user_id`'),
					  array('alias' => 'usermedia','table' => 'usermedia','type' => 'INNER','conditions' => '`usermedia`.`usermedia_id` = `MediaComment`.`usermedia_id`'),
					  array('alias' => 'usertype','table' => 'usertype','type' => 'INNER','conditions' => '`users`.`usertype_id` = `usertype`.`usertype_id`')),
					'conditions' => $condition , 'order'=>'MediaComment.created desc','limit' => 10);
					 
		  $this->set('mediacomments',$this->paginate('MediaComment'));
		 
		
		
	}
	
	public function usermedia()
	{
		$this->loadModel('UserMedia'); // Load model
		$this->set('page_title','User Media');
		 $condition = '';
			if($this->request->is('post')) 
			{
				$searchtext = addslashes(trim($_POST['txtsearch']));
				$condition = ' (UserMedia.usermedia_title Like "%'.$searchtext.'%" OR  users.user_fname Like "%'.$searchtext.'%" OR users.user_lname Like "%'.$searchtext.'%" or concat(users.user_fname," ",users.user_lname) Like "%'.addslashes($searchtext).'%" )';
			}
		$this->paginate = array(
					 'fields' => array('users.user_fname','users.user_lname','UserMedia.usermedia_id','UserMedia.usermedia_title','UserMedia.usermedia_name','UserMedia.usermedia_status','UserMedia.usermedia_id','UserMedia.usermedia_type','UserMedia.usermedia_path','users.user_id','category.category_name'),
					  'joins' => array(
					  array('alias' => 'users','table' => 'users','type' => 'INNER','conditions' => '`users`.`user_id` = `UserMedia`.`user_id`'),
					 array('alias' => 'category','table' => 'category','type' => 'INNER','conditions' => '`UserMedia`.`category_id` = `category`.`category_id`') ),
					'conditions' => $condition , 'order'=>'UserMedia.usermedia_date desc','limit' => 10);
					 
		  $this->set('usermedia',$this->paginate('UserMedia'));
		 
	}
}
