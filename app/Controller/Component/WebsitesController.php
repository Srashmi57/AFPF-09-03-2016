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
class WebsitesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();
	var $components = array('Facebook.Connect','Auth','category','video'); 
    var $helpers    = array('Facebook.Facebook');

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	

	public function beforeFilter()
	{
		//$this->Auth->autoRedirect = false;
		parent::beforeFilter();
		$this->Auth->allow('index','login');
	}
	
		
	public function login()
	{
		$this->layout = NULL;
		$this->autoRender = NULL;
		 
		
		if($this->request->is('post'))
		{
				
					 if(isset($_SESSION['regSuccess']))
					{
				
						$email = $_SESSION['regSuccess']['user_emailid'];
						$password = $_SESSION['regSuccess']['user_orgpassword'];
						$usertypeid = $_SESSION['regSuccess']['usertype_id'];
					
				
					 // $password =   AuthComponent::password(trim($socialpassword));
					 
					
						  $this->request->data['Users']['user_emailid'] = $email;
						  $this->request->data['Users']['user_password'] = $password;
						 $this->request->data['Users']['usertype_id'] = $usertypeid;
						  

						$this->loadModel('Users');
						$this->Users->set($this->request->data);
						
						if($this->Auth->login())
							{
								
								$loginstatus['status']="success";
							}
							else
							{
								
								
								$loginstatus['status']="fail";
								$loginstatus['msg']="No User exist";
							}
							echo json_encode($loginstatus);
								exit;
				   }
				   else
				   {
								 $this->request->data['Users']['user_emailid'] = $this->request->data['txtusername'];
								
								$this->request->data['Users']['user_password'] = $this->request->data['txtpassword'];
								AuthComponent::password($this->request->data['txtpassword']);
								$this->request->data['Users']['usertype_id'] = $this->request->data['usertypeid'];
								
	
								//unset($this->request->data['mobile_no']);
								unset($this->request->data['submit']);
								
								//print_r($this->request->data);
								//exit;
								$this->loadModel('Users');
								$this->Users->set($this->request->data);
								/*print_r($this->request->data);
								exit;*/
								
								$loginstatus = array();
								if($this->Users->validates())
								{
								
									if($this->Auth->login())
									{
										
										$loginstatus['status']="success";
										
										
									}
									else
									{
										$loginstatus['status']="fail";
										$loginstatus['msg']="No User exist";
									}
								}
								else
								{
										
										$loginstatus['status']="fail";
										
													
								}
								echo json_encode($loginstatus);
								exit;
				   }
		}
	
	   else if(isset($_SESSION['SOCIALREGISTRATIONDETAILS']))
	   {
	      $socialemail = $_SESSION['SOCIALREGISTRATIONDETAILS']['user_emailid'];
		  $socialpassword = $_SESSION['SOCIALREGISTRATIONDETAILS']['user_orgpassword'];
		   $usertypeid = $_SESSION['SOCIALREGISTRATIONDETAILS']['usertype_id'];
		
		
		 // $password =   AuthComponent::password(trim($socialpassword));
		 
		
			  $this->request->data['Users']['user_emailid'] = $socialemail;
		 	  $this->request->data['Users']['user_password'] = $socialpassword;
			 $this->request->data['Users']['usertype_id'] = $usertypeid;

			$this->loadModel('Users');
			$this->Users->set($this->request->data);
			
			if($this->Auth->login())
				{
					
					$this->redirect(array('controller'=>'users','action'=>'viewmyprofile'));
					
				}
				else
				{
				 $this->Session->setFlash('Login failed','default',array('class' => 'alert alert-danger'));
				 $this->redirect(array('controller'=>'websites','action'=>'index'));
				}
	   }
	      
	  
	}		
	
	
	public function logout()
	{
		$this->reset();
		
		$this->redirect($this->Auth->logout());
		
	}

	public function index($socialfb=null)
	{
		$this->set('activecatlist',$this->categories->GetAllCategories());
		 $this->set('arr_CategoryList',$this->categories->fnToGetAllCategoryList());
		$this->set('websitebanners',$this->categories->Getwebsitebanners());
		$compFileUploader = $this->Components->load('Fileupload');
		$arrFileDetail = $compFileUploader->fnaverageratedmedia($catname="",$id=0,8);
		$this->set('averagemedia',$arrFileDetail);
		$arrSingleFileDetail = $compFileUploader->fntopaveragedmedia($catname="",$id=0,1);
		$this->set('iscatdata', count($arrSingleFileDetail));
		$this->set('artistmediaDetails',$arrSingleFileDetail);
		
		
	}
	
	public function getRecentMedia()
	{
		$compFileUploader = $this->Components->load('Fileupload');
		$arrMediaDetail = $compFileUploader->getCheckRecentMedia();
		$view = new View($this, false);
		$view->set('recentmedia',$arrMediaDetail);
		$strrecentHtml = $view->element('recentuploads');
		if($strrecentHtml)
		{
			$arrResponse['status'] = "success";
			$arrResponse['content'] = $strrecentHtml;
		}
		else
		{
			$arrResponse['status'] = "fail";
		}
		echo json_encode($arrResponse);
		exit;
	}
	
	public function logingplus()
	{
	
	}
	
	public function fnUpdateNotify()
	{
		$this->loadModel('Users');
		$boolUpdatenotify = $this->Users->updateAll(array(
										'Users.user_notify' => 1										
									),array('Users.usertype_id' => 2));
									
		if($boolUpdatenotify)
			{
					$RespArray = array();
					$RespArray['status'] = "success";
					
					echo json_encode($RespArray);
					exit;
			}
			else
			{
					$RespArray = array();
					$RespArray['status'] = "fail";
					
					echo json_encode($RespArray);
					exit;
			}
									
	}
	
	public function category($categoryid) 
	{
			$subcategorylist = $this->categories->GetAllsubCategories($categoryid);
			$this->set('activesubcatlist', $subcategorylist);
			 $this->set('arr_CategoryList',$this->categories->fnToGetAllCategoryList());
			  $this->set('category_name',$this->categories->fnToGetCategoryName($categoryid));
			 //get uploaded banners
			$this->set('websitebanners',$this->categories->Getwebsitebanners($categoryid));
			
			//get recent media
			$compFileUploader = $this->Components->load('Fileupload');
			$arrMediaDetail = $compFileUploader->getRecentMediabyCategory($categoryid,'category');
			$this->set('recentmedia',$arrMediaDetail);
			//get average rated media
			$arrFileDetail = $compFileUploader->fnaverageratedmedia($catname="category",$id=$categoryid,8);
			$this->set('averagemedia',$arrFileDetail);
		
			$arrSingleFileDetail = $compFileUploader->fntopaveragedmedia($catname="category",$id=$categoryid,1);
			
			$this->set('iscatdata', count($arrSingleFileDetail));
			$this->set('artistmediaDetails',$arrSingleFileDetail);
	
	}
	
	public function subcategory($subcategoryid) 
	{
			$this->set('arr_CategoryList',$this->categories->fnToGetAllCategoryList());
			$subsubcategorylist = $this->categories->GetAllsubsubCategories($subcategoryid);
			$this->set('activesubsubcatlist', $subsubcategorylist);
			$this->set('category_name',$this->categories->fnGetSubCategoryParent($subcategoryid));
			$this->set('parentcategory_name',$this->categories->GetSubCategoryParentcat($subcategoryid));
			 //get uploaded banners
			$this->set('websitebanners',$this->categories->Getwebsitesubcatbanners($subcategoryid));
			
			//get recent media
					
			$compFileUploader = $this->Components->load('Fileupload');
			
			$arrMediaDetail = $compFileUploader->getRecentMediabyCategory($subcategoryid,'subcategory');
			$this->set('recentmedia',$arrMediaDetail);
			
			//get average rated media
			$arrFileDetail = $compFileUploader->fnaverageratedmedia($catname="subcategory",$id=$subcategoryid,8);
			$this->set('averagemedia',$arrFileDetail);
			$arrSingleFileDetail = $compFileUploader->fntopaveragedmedia($catname="subcategory",$id=$subcategoryid,1);
			$this->set('iscatdata', count($arrSingleFileDetail));
			$this->set('artistmediaDetails',$arrSingleFileDetail);
			
	}
	
	public function subsubcategory($subsubcategoryid) 
	{
		$this->set('arr_CategoryList',$this->categories->fnToGetAllCategoryList());
		
		 //get uploaded banners
		$this->set('websitebanners',$this->categories->Getwebsitesubsubcatbanners($subsubcategoryid));
		
		$compFileUploader = $this->Components->load('Fileupload');
		$this->set('category_name',$this->categories->fnGetSubsubCategoryParent($subsubcategoryid));
		$this->set('parentcategory_name',$this->categories->GetSubsubCategoryParentcat($subsubcategoryid));
		//get recent media
		$arrMediaDetail = $compFileUploader->getRecentMediabyCategory($subsubcategoryid,'subsubcategory');
		$this->set('recentmedia',$arrMediaDetail);
		
		//get average rated media
		$arrFileDetail = $compFileUploader->fnaverageratedmedia($catname="subsubcategory",$id=$subsubcategoryid,8);
		$this->set('averagemedia',$arrFileDetail);
		
		$arrSingleFileDetail = $compFileUploader->fntopaveragedmedia($catname="subsubcategory",$id=$subsubcategoryid,1);
		$this->set('iscatdata', count($arrSingleFileDetail));
			$this->set('artistmediaDetails',$arrSingleFileDetail);
		
		
	}
	
	public function aboutus()
	{
			$this->set('arr_CategoryList',$this->categories->fnToGetAllCategoryList());
	}
	
	public function sitemap()
	{
			$this->set('arr_CategoryList',$this->categories->fnToGetAllCategoryList());
	}
	public function privacypolicy()
	{
			$this->set('arr_CategoryList',$this->categories->fnToGetAllCategoryList());
	}
	
	
	
	public function reset()
	{
		$arrExistSocialSession = $this->Session->read('SOCIALREGISTRATIONDETAILS');
		 $arrExistregisterSession = $this->Session->read('regSuccess');
		
		if(is_array($arrExistSocialSession) && (count($arrExistSocialSession)>0))
		{
			if(isset($arrExistSocialSession['SOCIALUSERTYPE']))
			{
				if($arrExistSocialSession['SOCIALUSERTYPE'] == "facebook")
				{
					// run the facebook logout url in background
					$this->Session->delete('fb_'.Configure::read('Social.FbApkey').'_access_token');
					$this->Session->delete('fb_'.Configure::read('Social.FbApkey').'_code');
					$this->Session->delete('fb_'.Configure::read('Social.FbApkey').'_user_id');
				}
				if($arrExistSocialSession['SOCIALUSERTYPE'] == "twitter")
				{
					$this->Session->delete('twitter');
					$this->Session->delete('SOCIALREGISTRATIONDETAILS');
				}
				if($arrExistSocialSession['SOCIALUSERTYPE'] == "linkedin")
				{
					$this->Session->delete('linkedin');
					$this->Session->delete('SOCIALREGISTRATIONDETAILS');
				}
			}
			
		}
		if(count($arrExistregisterSession)>0)
		{
			$this->Session->delete('regSuccess');
		}
		
	}
	public function test() {

	}
	
	public function upload() 
	{
		
			$this->set('arr_CategoryList',$this->categories->fnToGetAllCategoryList());
			 $this->set('arr_userCategoryList',$this->categories->GetAllUserCategoryList());
			$this->set('websitebanners',$this->categories->Getwebsitebanners());
			$strActionScript="";
			
			$strActionScript .= '<script type="text/javascript" src="http://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>';
			$strActionScript .= '<script type="text/javascript" src="http://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>';
			$strActionScript .= '<script type="text/javascript" src="http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>';
			$strActionScript .= '<script type="text/javascript" src="'.Router::url('/js/fileuploaderjs/vendor/jquery.ui.widget.js').'"></script>';
			$strActionScript .= '<script type="text/javascript" src="'.Router::url('/js/fileuploaderjs/jquery.iframe-transport.js').'"></script>';
			$strActionScript .= '<script type="text/javascript" src="'.Router::url('/js/fileuploaderjs/jquery.fileupload.js').'"></script>';
			$strActionScript .= '<script type="text/javascript" src="'.Router::url('/js/fileuploaderjs/jquery.fileupload-process.js').'"></script>';
			$strActionScript .= '<script type="text/javascript" src="'.Router::url('/js/fileuploaderjs/jquery.fileupload-image.js').'"></script>';
			$strActionScript .= '<script type="text/javascript" src="'.Router::url('/js/fileuploaderjs/jquery.fileupload-image.js').'"></script>';
			$strActionScript .= '<script type="text/javascript" src="'.Router::url('/js/fileuploaderjs/jquery.fileupload-audio.js').'"></script>';
			$strActionScript .= '<script type="text/javascript" src="'.Router::url('/js/fileuploaderjs/jquery.fileupload-video.js').'"></script>';
			$strActionScript .= '<script type="text/javascript" src="'.Router::url('/js/fileuploaderjs/jquery.fileupload-validate.js').'"></script>';
			$strActionScript .= '<script type="text/javascript" src="'.Router::url('/js/fileuploaderjs/jquery.fileupload-ui.js').'"></script>';
			$this->set('strActionScript',$strActionScript);
			
			//get users uploaded media
			
			$compFileUploader = $this->Components->load('Fileupload');
			$arrFileDetail = $compFileUploader->getMedia();
			$this->set('uploadeddata',$arrFileDetail);
}



	public function uploadfile()
		{
			$this->autoRender = false;
			$this->layout = NULL;
		
		
			$compFileUploader = $this->Components->load('Fileupload');
			 $compFileUploader->bootup();
			

			 
		}
	
	public function pdfReader($usermedia_id)
	{
		$compFileUploader = $this->Components->load('Fileupload');
		$mediapath = $compFileUploader->getMediaPath($usermedia_id);
		$pdfpath = Router::url('/', true).$mediapath;
		$this->set('pdfpath',$pdfpath);
	}
	
	public function docviewer()
	{
	
	}
	
	public function videouploadprocess()
	{	
		$this->uploadvideo = $this->Components->load('video');
		$this->uploadvideo->fnuploadvideo();
	}
	
	public function videodeleteprocess()
	{	
		$this->uploadvideo = $this->Components->load('video');
		$this->uploadvideo->deleteAction(116147520);
	}
	
	public function deleteusermedia($usermedia_id,$type=Null)
	{
	
			$compFileUploader = $this->Components->load('Fileupload');
			$booldeletemedia = $compFileUploader->deletemedia($usermedia_id,$type);
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
				echo json_encode($RespArray);
					exit;
	}

	
	public function search()
	{
		$this->set('arr_CategoryList',$this->categories->fnToGetAllCategoryList());
				$this->loadModel('UserMedia');	
				$view = new View($this, false);
				if ($this->request->is('post')) {
				 $searchtext = addslashes(trim($_POST['txtsearch']));
				 
				 $condition = 'UserMedia.usermedia_name like "%'.$searchtext.'%" OR category.category_name like "%'.$searchtext.'%"  OR users.user_fname like "%'.$searchtext.'%" OR users.user_lname like "%'.$searchtext.'%" OR concat(users.user_fname," ",users.user_lname) Like "%'.$searchtext.'%"';
				 $this->paginate = array(
					 'fields' => array('UserMedia.*','usermedia_cover.usermedia_title','usermedia_cover.usermedia_path','users.user_fname','users.user_lname','users.user_id','users.user_display_name','category.category_name'),
				    'joins' => array(array('alias' => 'users','table' => 'users','type' => 'INNER','conditions' => 'users.user_id = UserMedia.user_id '),
					array('alias' => 'category','table' => 'category','type' => 'INNER','conditions' => 'UserMedia.category_id = category.category_id '),array('alias' => 'usermedia_cover','table' => 'usermedia','type' => 'left','conditions' => 'UserMedia.cover_id = usermedia_cover.usermedia_id ')),'conditions' =>$condition,'order' => 'UserMedia.usermedia_date desc','limit' => 12);
				
					$this->Session->write('paginate', $this->paginate);
					/*print_r($_SESSION['paginate']);
					exit();*/
				}
				
				$this->paginate = $this->Session->read('paginate');
				
				$searchmedia = $this->paginate('UserMedia');
				echo "<pre>";
				print_r($searchmedia);
				exit();
				$this->set('searchmedia', $searchmedia);
			
	}
	
}
			