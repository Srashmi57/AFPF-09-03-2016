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
	var $components = array('Facebook.Connect','Auth','category','video','Cookie'); 
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
								/* Remember me */
								if ($this->request->data['remember_me'] == 1) {
									
									if($this->request->data['usertypeid'] == 3){
										
										$this->Session->write('UPerson.rememberMe', $this->request->data['remember_me']);
										$this->Session->write('UPerson.txtusername', $this->request->data['txtusername']);
										$this->Session->write('UPerson.txtpassword', $this->request->data['txtpassword']);
										
									} else {
										
										$this->Session->write('APerson.rememberMe', $this->request->data['remember_me']);
										$this->Session->write('APerson.txtusername', $this->request->data['txtusername']);
										$this->Session->write('APerson.txtpassword', $this->request->data['txtpassword']);
										
									}
									
									
								} else {
									
									if($this->request->data['usertypeid'] == 3){
										
										$this->Session->write('UPerson.rememberMe', '');
										$this->Session->write('UPerson.txtusername', '');
										$this->Session->write('UPerson.txtpassword', '');
										
									} else {
										
										$this->Session->write('APerson.rememberMe', '');
										$this->Session->write('APerson.txtusername', '');
										$this->Session->write('APerson.txtpassword', '');
										
									}
									//$this->Cookie->destroy('rememberMe');
								}
								/* end here */
	
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
					
					$this->redirect(array('controller'=>'users','action'=>'mypage'));
					
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
		$this->Session->setFlash('<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>  You have Signed Out. Sign In to enjoy New Artworks.</div></div>');
		$this->redirect($this->Auth->logout());
		
	}

	public function index($socialfb=null)
	{
	    $this->loadModel('Users');
		$this->loadModel('MediaRating');
		$this->loadModel('MediaLikes');
		
       //For User
		$this->Cookie->write('UrememberMe', $this->Session->read('UPerson.rememberMe'), true, '2 weeks');
		$this->Cookie->write('Utxtusername', $this->Session->read('UPerson.txtusername'), true, '2 weeks');
		$this->Cookie->write('Utxtpassword', $this->Session->read('UPerson.txtpassword'), true, '2 weeks');
		
		//For Artist
		$this->Cookie->write('ArememberMe', $this->Session->read('APerson.rememberMe'), true, '2 weeks');
		$this->Cookie->write('Atxtusername', $this->Session->read('APerson.txtusername'), true, '2 weeks');
		$this->Cookie->write('Atxtpassword', $this->Session->read('APerson.txtpassword'), true, '2 weeks');
		//$cookieValue = $this->Cookie->read('rememberMe');
		
		$current_user_id = $this->Session->read('Auth.WebsitesUser.user_id');
		$this->set('activecatlist',$this->categories->GetAllCategories());
		 $this->set('arr_CategoryList',$this->categories->fnToGetAllCategoryList());
		$this->set('websitebanners',$this->categories->Getwebsitebanners());
		$this->set('islogin',$current_user_id);
		$compFileUploader = $this->Components->load('Fileupload');
		$arrFileDetail = $compFileUploader->fnaverageratedmedia($catname="",$id=0,10);
		$this->set('averagemedia',$arrFileDetail);
		$arrSingleFileDetail = $compFileUploader->fntopaveragedmedia($catname="",$id=0,1);
		/* Get followers count */
		$componentusers = $this->Components->load('users');
		$arrUser_Profile = $componentusers->myprofile($current_user_id);
		$this->set('arrUser_Profile',$arrUser_Profile );
			/* Get cat by selected */
			if($arrUser_Profile['Users']['usertype_id']==3){
			$arrrecentuploadsbyselected = $compFileUploader->getmyrecentuploadsbyselected();
			
			$this->set('arrrecentuploadsbyselected',$arrrecentuploadsbyselected);
			}
			/* end here */
		
		$artist_id = $arrSingleFileDetail[0]['UserMedia']['user_id'];
		$followerscount	= $componentusers->getcountArtistfollowers($artist_id);
		$this->set('followerscount',$followerscount);
		
		//logged user has followed this artist
		
	    $this->loadModel('Followers');
		$arrloggedfollowed = $this->Followers->find('count',array('conditions'=>array('artist_id'=>$artist_id,'user_id'=>$current_user_id)));
		$this->set('isloggedfollowed',$arrloggedfollowed );
		/* end here */
		$this->set('iscatdata', count($arrSingleFileDetail));
		$this->set('artistmediaDetails',$arrSingleFileDetail);
		
		$medialikes_id = $this->MediaLikes->field('medialikes_id', array('user_id' => $current_user_id,'usermedia_id'=>$arrSingleFileDetail[0]['UserMedia']['usermedia_id']));
	$mediatext = $medialikes_id>0?'Unlike':'Like';		
	$this->set('mediatext',$mediatext);	
	
	if($current_user_id>0)
	{
		//check logged user have given how many rates to art piece
		$MediaRating = $this->MediaRating->find('first', array('conditions' => array('user_id' => $current_user_id,'usermedia_id'=>$arrSingleFileDetail[0]['UserMedia']['usermedia_id'])));
	}
	else
	{
		$MediaRating = $this->MediaRating->find('first', array('fields'=>array('avg(media_rating) as media_rating','mediarating_id'),'conditions' => array('usermedia_id'=>$arrSingleFileDetail[0]['UserMedia']['usermedia_id'])));
		
	}
	
		if(count($MediaRating)>0 && $current_user_id>0)
			{
				$this->set('viewmediarateid',$MediaRating['MediaRating']['mediarating_id']);	
				$this->set('viewmediarateing',$MediaRating['MediaRating']['media_rating']);	
			}
			else if(count($MediaRating)>0)
			{
				if($MediaRating[0]['media_rating']>0)
				{
					$this->set('viewmediarateid',0);	
					$this->set('viewmediarateing',$MediaRating[0]['media_rating']);	
				}
				else
				{
					$this->set('viewmediarateid',0);	
					$this->set('viewmediarateing',0);	
				}
			
			}
			else
			{
					$this->set('viewmediarateid',0);	
					$this->set('viewmediarateing',0);	
			}
		
	}
	
	public function getRecentMedia()
	{
		$MediaRating = array();
		$getMediaRating = array();
		$this->loadModel('MediaRating');
		$current_user_id = $this->Session->read('Auth.WebsitesUser.user_id');
		$this->set('islogin',$current_user_id);
		$compFileUploader = $this->Components->load('Fileupload');
		$arrMediaDetail = $compFileUploader->getCheckRecentMedia();
		
		/* Get rating */
		if($current_user_id>0)
		{
			//check logged user have given how many rates to art piece
			foreach($arrMediaDetail as $gid){
			$usermedia_ID = $gid['UserMedia']['usermedia_id'];
			$getMediaRating = $this->MediaRating->find('all', array('conditions' => array('user_id' => $current_user_id,'usermedia_id'=>$usermedia_ID)));
			 array_push($MediaRating,$getMediaRating);
			}
		}
		else
		{
			foreach($arrMediaDetail as $gid){
			$usermedia_ID = $gid['UserMedia']['usermedia_id'];
			$getMediaRating = $this->MediaRating->find('all', array('conditions' => array('usermedia_id'=>$usermedia_ID)));
			 array_push($MediaRating,$getMediaRating);
			}
			
		}
		/* end */
		
		$view = new View($this, false);
		$view->set('recentmedia',$arrMediaDetail);
		$view->set('MediaRating',$MediaRating);
		/* if(count($MediaRating)>0 && $current_user_id>0)
			{
				$view->set('viewmediarateid',$MediaRating['MediaRating']['mediarating_id']);	
				$view->set('viewmediarateing',$MediaRating['MediaRating']['media_rating']);	
			}
			else if(count($MediaRating)>0)
			{
				if($MediaRating[0]['media_rating']>0)
				{
					$view->set('viewmediarateid',0);	
					$view->set('viewmediarateing',$MediaRating[0]['media_rating']);	
				}
				else
				{
					$view->set('viewmediarateid',0);	
					$view->set('viewmediarateing',0);	
				}
			
			}
			else
			{
					$view->set('viewmediarateid',0);	
					$view->set('viewmediarateing',0);	
			} */
		
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
			$this->loadModel('Category');
			$this->loadModel('MediaRating');
			$this->loadModel('MediaLikes');
			$subcategorylist = $this->categories->GetAllsubCategories($categoryid);
			$current_user_id = $this->Session->read('Auth.WebsitesUser.user_id');
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
			$arrFileDetail = $compFileUploader->fnaverageratedmedia($catname="category",$id=$categoryid,10);
			$this->set('averagemedia',$arrFileDetail);
		
			$arrSingleFileDetail = $compFileUploader->fntopaveragedmedia($catname="category",$id=$categoryid,1);
			$this->set('islogin',$current_user_id);
			
			$this->set('iscatdata', count($arrSingleFileDetail));
			$this->set('artistmediaDetails',$arrSingleFileDetail);
			
			$medialikes_id = $this->MediaLikes->field('medialikes_id', array('user_id' => $current_user_id,'usermedia_id'=>$arrSingleFileDetail[0]['UserMedia']['usermedia_id']));
			$mediatext = $medialikes_id>0?'Unlike':'Like';		
			$this->set('mediatext',$mediatext);	
			
			if($current_user_id>0)
			{
				//check logged user have given how many rates to art piece
				$MediaRating = $this->MediaRating->find('first', array('conditions' => array('user_id' => $current_user_id,'usermedia_id'=>$arrSingleFileDetail[0]['UserMedia']['usermedia_id'])));
			}
			else
			{
				$MediaRating = $this->MediaRating->find('first', array('fields'=>array('avg(media_rating) as media_rating','mediarating_id'),'conditions' => array('usermedia_id'=>$arrSingleFileDetail[0]['UserMedia']['usermedia_id'])));
				
			}
			
				if(count($MediaRating)>0 && $current_user_id>0)
					{
						$this->set('viewmediarateid',$MediaRating['MediaRating']['mediarating_id']);	
						$this->set('viewmediarateing',$MediaRating['MediaRating']['media_rating']);	
					}
					else if(count($MediaRating)>0)
					{
						if($MediaRating[0]['media_rating']>0)
						{
							$this->set('viewmediarateid',0);	
							$this->set('viewmediarateing',$MediaRating[0]['media_rating']);	
						}
						else
						{
							$this->set('viewmediarateid',0);	
							$this->set('viewmediarateing',0);	
						}
					
					}
					else
					{
							$this->set('viewmediarateid',0);	
							$this->set('viewmediarateing',0);	
					}
	
	}
	
	public function subcategory($subcategoryid) 
	{
		
			$this->loadModel('MediaRating');
			$this->loadModel('MediaLikes');
			$this->set('arr_CategoryList',$this->categories->fnToGetAllCategoryList());
			$subsubcategorylist = $this->categories->GetAllsubsubCategories($subcategoryid);
			$this->set('activesubsubcatlist', $subsubcategorylist);
			$this->set('category_name',$this->categories->fnGetSubCategoryParent($subcategoryid));
			$this->set('parentcategory_name',$this->categories->GetSubCategoryParentcat($subcategoryid));
			 //get uploaded banners
			$this->set('websitebanners',$this->categories->Getwebsitesubcatbanners($subcategoryid));
			$current_user_id = $this->Session->read('Auth.WebsitesUser.user_id');
			//get recent media
			$MediaRating = array();		
			$compFileUploader = $this->Components->load('Fileupload');
			
			$arrMediaDetail = $compFileUploader->getRecentMediabyCategory($subcategoryid,'subcategory');
			$this->set('recentmedia',$arrMediaDetail);
			$this->set('islogin',$current_user_id);
			//get average rated media
			$arrFileDetail = $compFileUploader->fnaverageratedmedia($catname="subcategory",$id=$subcategoryid,10);
			$this->set('averagemedia',$arrFileDetail);
			$arrSingleFileDetail = $compFileUploader->fntopaveragedmedia($catname="subcategory",$id=$subcategoryid,1);
			$this->set('iscatdata', count($arrSingleFileDetail));
			$this->set('artistmediaDetails',$arrSingleFileDetail);
			
		if(count($arrSingleFileDetail)>0)
		{
			$medialikes_id = $this->MediaLikes->field('medialikes_id', array('user_id' => $current_user_id,'usermedia_id'=>$arrSingleFileDetail[0]['UserMedia']['usermedia_id']));
			$mediatext = $medialikes_id>0?'Unlike':'Like';		
			$this->set('mediatext',$mediatext);	
			
			if($current_user_id>0)
			{
				//check logged user have given how many rates to art piece
				$MediaRating = $this->MediaRating->find('first', array('conditions' => array('user_id' => $current_user_id,'usermedia_id'=>$arrSingleFileDetail[0]['UserMedia']['usermedia_id'])));
			}
			else
			{
				$MediaRating = $this->MediaRating->find('first', array('fields'=>array('avg(media_rating) as media_rating','mediarating_id'),'conditions' => array('usermedia_id'=>$arrSingleFileDetail[0]['UserMedia']['usermedia_id'])));
				
			}
		}
			
				if(count($MediaRating)>0 && $current_user_id>0)
					{
						$this->set('viewmediarateid',$MediaRating['MediaRating']['mediarating_id']);	
						$this->set('viewmediarateing',$MediaRating['MediaRating']['media_rating']);	
					}
					else if(count($MediaRating)>0)
					{
						if($MediaRating[0]['media_rating']>0)
						{
							$this->set('viewmediarateid',0);	
							$this->set('viewmediarateing',$MediaRating[0]['media_rating']);	
						}
						else
						{
							$this->set('viewmediarateid',0);	
							$this->set('viewmediarateing',0);	
						}
					
					}
					else
					{
							$this->set('viewmediarateid',0);	
							$this->set('viewmediarateing',0);	
					}
	}
	
	public function subsubcategory($subsubcategoryid) 
	{
		$this->loadModel('MediaRating');
		$this->loadModel('MediaLikes');
		$MediaRating = array();
		$this->set('arr_CategoryList',$this->categories->fnToGetAllCategoryList());
		$current_user_id = $this->Session->read('Auth.WebsitesUser.user_id');
		 //get uploaded banners
		$this->set('websitebanners',$this->categories->Getwebsitesubsubcatbanners($subsubcategoryid));
		
		$compFileUploader = $this->Components->load('Fileupload');
		$this->set('category_name',$this->categories->fnGetSubsubCategoryParent($subsubcategoryid));
		$this->set('parentcategory_name',$this->categories->GetSubsubCategoryParentcat($subsubcategoryid));
		//get recent media
		$arrMediaDetail = $compFileUploader->getRecentMediabyCategory($subsubcategoryid,'subsubcategory');
		$this->set('recentmedia',$arrMediaDetail);
		
		//get average rated media
		$arrFileDetail = $compFileUploader->fnaverageratedmedia($catname="subsubcategory",$id=$subsubcategoryid,10);
		$this->set('averagemedia',$arrFileDetail);
		
		$arrSingleFileDetail = $compFileUploader->fntopaveragedmedia($catname="subsubcategory",$id=$subsubcategoryid,1);
		$this->set('iscatdata', count($arrSingleFileDetail));
		$this->set('artistmediaDetails',$arrSingleFileDetail);
	
			$this->set('islogin',$current_user_id);
		if(count($arrSingleFileDetail)>0)
		{
			$medialikes_id = $this->MediaLikes->field('medialikes_id', array('user_id' => $current_user_id,'usermedia_id'=>$arrSingleFileDetail[0]['UserMedia']['usermedia_id']));
			$mediatext = $medialikes_id>0?'Unlike':'Like';		
			$this->set('mediatext',$mediatext);	
			
			if($current_user_id>0)
			{
				//check logged user have given how many rates to art piece
				$MediaRating = $this->MediaRating->find('first', array('conditions' => array('user_id' => $current_user_id,'usermedia_id'=>$arrSingleFileDetail[0]['UserMedia']['usermedia_id'])));
			}
			else
			{
				$MediaRating = $this->MediaRating->find('first', array('fields'=>array('avg(media_rating) as media_rating','mediarating_id'),'conditions' => array('usermedia_id'=>$arrSingleFileDetail[0]['UserMedia']['usermedia_id'])));
				
			}
		}
		
		if(count($MediaRating)>0 && $current_user_id>0)
			{
				$this->set('viewmediarateid',$MediaRating['MediaRating']['mediarating_id']);	
				$this->set('viewmediarateing',$MediaRating['MediaRating']['media_rating']);	
			}
			else if(count($MediaRating)>0)
			{
				if($MediaRating[0]['media_rating']>0)
				{
					$this->set('viewmediarateid',0);	
					$this->set('viewmediarateing',$MediaRating[0]['media_rating']);	
				}
				else
				{
					$this->set('viewmediarateid',0);	
					$this->set('viewmediarateing',0);	
				}
			
			}
			else
			{
					$this->set('viewmediarateid',0);	
					$this->set('viewmediarateing',0);	
			}
		
		
	}
	
	public function aboutus()
	{
			$this->set('websitebanners',$this->categories->Getwebsitebanners());
			$this->set('arr_CategoryList',$this->categories->fnToGetAllCategoryList());
	}
	
	public function sitemap()
	{
			$this->set('websitebanners',$this->categories->Getwebsitebanners());
			$this->set('arr_CategoryList',$this->categories->fnToGetAllCategoryList());
			
	}
	public function privacypolicy()
	{
			$this->set('websitebanners',$this->categories->Getwebsitebanners());
			$this->set('arr_CategoryList',$this->categories->fnToGetAllCategoryList());
	}
	
	public function terms()
	{
			$this->set('websitebanners',$this->categories->Getwebsitebanners());
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
				$this->set('websitebanners',$this->categories->Getwebsitebanners());
				if ($this->request->is('post')) {
				 $searchtext = addslashes(trim($_POST['txtsearch']));
				 
				 $condition = 'UserMedia.usermedia_name like "%'.$searchtext.'%" OR category.category_name like "%'.$searchtext.'%" OR users.user_display_name like "%'.$searchtext.'%" OR users.user_fname like "%'.$searchtext.'%" OR users.user_lname like "%'.$searchtext.'%" OR concat(users.user_fname," ",users.user_lname) Like "%'.$searchtext.'%" OR subsubcategory.subsubcategory_name like "%'.$searchtext.'%" OR subcategory.subcategory_name like "%'.$searchtext.'%"';
				 $this->paginate = array(
					 'fields' => array('UserMedia.*','usermedia_cover.usermedia_title','usermedia_cover.usermedia_path','users.user_fname','users.user_lname','users.user_id','users.user_display_name','category.category_name','subcategory.subcategory_name','subsubcategory.subsubcategory_name'),
				    'joins' => array(array('alias' => 'users','table' => 'users','type' => 'INNER','conditions' => 'users.user_id = UserMedia.user_id '),
					array('alias' => 'category','table' => 'category','type' => 'INNER','conditions' => 'UserMedia.category_id = category.category_id '),array('alias' => 'usermedia_cover','table' => 'usermedia','type' => 'left','conditions' => 'UserMedia.cover_id = usermedia_cover.usermedia_id '),array('alias' => 'subsubcategory','table' => 'appap14_subsubcategory
','type' => 'INNER','conditions' => 'UserMedia.subsubcategory_id = subsubcategory.subsubcategory_id '),array('alias' => 'subcategory','table' => 'appap14_subcategory
','type' => 'INNER','conditions' => 'UserMedia.subcategory_id = subcategory.subcategory_id ')),'conditions' =>$condition,'order' => 'UserMedia.usermedia_date desc','limit' => 12);
				
					$this->Session->write('paginate', $this->paginate);
					/*print_r($_SESSION['paginate']);
					exit();*/
				}
				
				$this->paginate = $this->Session->read('paginate');
				
				$searchmedia = $this->paginate('UserMedia');
				/* echo "<pre>";
				print_r($searchmedia);
				exit(); */
				$this->set('searchmedia', $searchmedia);
			
	}
	
	public function sendContactProcess()
	{



		//get logged user

		if($this->request->is('post'))
		{
			$contactname = addslashes($this->request->data['txtcontactname']);
			$email = addslashes($this->request->data['txtemail']);
			$Message = addslashes($this->request->data['txtMessage']);
				$Message = trim($Message);
				 $emailarray = array();
				$Message = stripslashes($Message);
				$Message = htmlspecialchars($Message);
			$subject= "Contact us from ".$contactname." artformplatform";
			
			$issend = $this->sendConatactEmail($email,$contactname,$Message,$subject);

			if($issend)
			{
				$data[] = $email;
				$this->Session->write('email', $data);
				
				$RespnewArray['status'] = "success";
				$RespnewArray['message'] = "Email Set successfully.";
				$RespnewArray  = json_encode($RespnewArray);
				echo $RespnewArray;
				exit();
			}
			else
			{
				$RespnewArray['status'] = "fail";
				$RespnewArray['message'] = "Error Please try again.";
				$RespnewArray = json_encode($RespnewArray);
				echo $RespnewArray;
				exit;
			}



		}

	}


	
}
			