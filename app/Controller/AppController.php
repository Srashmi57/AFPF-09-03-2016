<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $components = array(
		'Session',
		'FbRegister',
		'Auth',
		'Email',
		'Cookie'
	
    );

	public function isAuthorized($user) 
	{
        return true;
    }
	
	public function beforeFilter() 
	{
		
		$this->set('cookieHelper', $this->Cookie);
		Security::setHash('md5',true);
		//echo $cookieValue = 'cookie'.$this->Cookie->read('rememberMe');
			$arraycontrollers = array('websites','users','social');
			$intusertypeId=0;
			$userverified=0;
		if(in_array($this->params['controller'], $arraycontrollers))
		{
			if(isset($this->request->data['usertypeid']))
				{
					 $intusertypeId = $this->request->data['usertypeid'];
					 
				}
				else if(isset($_SESSION['SOCIALREGISTRATIONDETAILS']['usertype_id']))
				{
				  $intusertypeId = $_SESSION['SOCIALREGISTRATIONDETAILS']['usertype_id'];
				 
				}
				else if(isset($_SESSION['regSuccess']['usertype_id']))
				{
				  $intusertypeId = $_SESSION['regSuccess']['usertype_id'];

				}
				
				$this->Auth->authenticate = array('Form'=>array('userModel'=>'Users','fields'=>array('username'=>'user_emailid','password'=>'user_password'),'scope'=>array('usertype_id'=>$intusertypeId,'user_verified'=>1)));
				AuthComponent::$sessionKey = 'Auth.WebsitesUser';
				$this->Auth->loginAction = array('controller' => 'websites', 'action' => 'index');
				$this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'mypage');
				$this->Auth->logoutRedirect = array('controller'=>'websites','action'=>'index');
				$this->Auth->authError = "You cant access that page";
				$this->Auth->flash['params']['class'] = 'alert alert-danger';
				$this->Auth->authorize = array('Controller');
				$this->Auth->allow('index','fnToGetAllSubCategoriesList','fnToGetAllSubSubCategoryList','fnAddUserProcess','category','subcategory','subsubcategory','logingplus','test','share','fnForgotPasswordProcess','getAvgartistmedia','aboutus','fnsearchProcess','search','artist','art','getartistmedia','pdfReader','listallfollowers','listallfollowing','listalllikes','getRecentMedia','sitemap','terms','privacypolicy','getSubcategoriesList','sendContactProcess');
				$this->categories = $this->Components->load('category');
				$this->set('categories',$this->categories->detailcategories());
		}				
		else
		{
			
				$this->Auth->authenticate = array('Form'=>array('userModel'=>'Admin','fields'=>array('username'=>'admin_email','password'=>'admin_password')));
				AuthComponent::$sessionKey = 'Auth.BackendUser';
				$this->Auth->loginAction = array('controller' => 'admins', 'action' => 'index');
				$this->Auth->loginRedirect = array('controller' => 'admins', 'action' => 'dashboard');
				$this->Auth->logoutRedirect = array('controller'=>'admins','action'=>'index');
				$this->Auth->authError = "You can't access this page";
				$this->Auth->flash['params']['class'] = 'alert alert-danger';
				$this->Auth->authorize = array('Controller');
				$this->Auth->allow('index','fnToGetAllSubCategoriesList','fnToGetAllSubSubCategoryList','fnAddUserProcess','activate','getSubcategoriesList');
				$arrLoggedUser = $this->Auth->user();
				$arrCountusers = $this->GetRegisterdUserCount();
				$this->set('countusers',$arrCountusers);
				$arrCountusers = $this->GetLatestRegisterdUsers();
				$this->set('regusers',$arrCountusers);
		}
		
			$this->set('logged_in',$this->Auth->loggedIn());
			$this->set('current_user',$this->Auth->user());
	
			if($this->Auth->loggedIn())
			{
				$currentController = $this->params['controller'];
				$this->set('current_controller',$currentController);
				
				$currentAction = $this->params['action'];
				$this->set('current_action',$currentAction);
				$this->loadModel('Usertype');
				$currentusertype = $this->Usertype->find('first',array('fields'=>array('usertype_name'),'conditions'=> array('usertype_id' =>$this->Auth->user('usertype_id'))));    
				$this->set('currentusertype',$currentusertype);
			}		
		
			
			
					
			
		switch($this->params['controller'])
		{
			case "admins":
							$this->layout = "admin";
							break;
							
			case "categories":
							$this->layout = "admin";
							break;	
			case "packages":
							 $this->layout = "admin";
							break;	
			case "websites":
			
							if($this->params['action'] == "pdfReader"||$this->params['action'] == "docviewer")
							{
								$this->layout = "";
								break;	
							}
								
							
		}
	}
	
	
	
	public function	fnToGetAllUserTypeListforadmin(){
		
		$arr_UserTypeList = array();
			$this->loadModel('Usertype');
			$arr_UserTypeList = $this->Usertype->find('list',array(
																		'fields'=>array('Usertype.usertype_id',
																		'Usertype.usertype_name'),
																		'conditions' => array( 'Usertype.usertype_id >' => 3
  
  ))
																);
			$arr_UserTypeList[""] = "Please Select User Type";
			ksort($arr_UserTypeList);			
		return $arr_UserTypeList;
		
	}
	
	
	
	//update status
	public function UpdateStatus()
	{
		$model= $_POST["model"];
		$this->loadModel($model);
		$id = $_POST["id"];
		$status = $_POST["status"];
		
			$boolCatprocessSaved= $this->$model->updateAll(
   			 array($model.'_status' => "'$status'"),
   			 array($model.'_id' => $id)
	
			);	
			
			switch($model)
			{  
				case "Admin":
				$modelmsg = $status>0?"Admin User Status Has Been Activated Successfully":"Admin User Status Has Been Deactivated Successfully";
				break;
				
				case "banner":
				$modelmsg = $status>0?"Website Banner Has Been Activated Successfully":"Website Banner Has Been Deactivated Successfully";
				break;
				
				case "Category":
				$modelmsg = $status>0?"Category Status Has Been Activated Successfully":"Category Status Has Been Deactivated Successfully";
				break;
				
				case "Subcategory":
				$modelmsg = $status>0?"Sub Category Status Has Been Activated Successfully":"Sub Category Status Has Been Deactivated Successfully";
				break;
				
				case "Subsubcategory":
				$modelmsg = $status>0?"Sub SubCategory Status Has Been Activated Successfully":"Sub SubCategory Status Has Been Deactivated Successfully";
				break;
				case "Package":
				$modelmsg = $status>0?"Package Has Been Activated Successfully":"Package Has Been Deactivated Successfully";
				break;
			}
			if($boolCatprocessSaved)
			{
				$RespArray = array();
				$RespArray['status'] = "success";
				$RespArray['message'] = "$modelmsg ";
			}
			else
			{  
				$RespArray = array();
				$RespArray['status'] = "fail";
				$RespArray['message'] = "$modelmsg";
			}
				
				$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-success'));
				echo json_encode($RespArray);
					exit;
			
	}	
	
	
		// Delete user data function (D)
    function delete($id,$model)
    {
	
			$this->loadModel($model);
			 $boolDeletUser = $this->$model->deleteAll(array($model.".".$model."_id" => $id),false);
			
			
				$modelmsg = "$model Has Been Deleted Successfully";
			
			if($boolDeletUser)
			{
				$RespArray = array();
				$RespArray['status'] = "success";
				
			}
			else
			{  
				$RespArray = array();
				$RespArray['status'] = "fail";
				$modelmsg	=	"$model Deletion Has Been Failed";	
			}
				
				
		switch($model)
		{
			case "Category":
			case "Package":
							$action='index';
							break;
							
			case "Subcategory":
							$action='subcategories';
							
							break;	
							
			case "Subsubcategory":
							$action='subsubcategories';
							
							break;	
							
			case "Admin":
							$action='Users';
							$modelmsg = $boolDeletUser>0?"Admin User Profile Has Been Deleted Successfully":"Admin User Profile Deletion Has Been Failed";
							
							break;	
			case "User":
							$action='websiteusers';
							$modelmsg = $boolDeletUser>0?"Website User Profile Has Been Deleted Successfully":"Website User Profile Deletion Has Been Failed";
							
							break;	
			
			case "banner":
							$modelmsg = $boolDeletUser>0?"Website Banner Has Been Deleted Successfully":"Website Banner Deletion Has Been Failed";
							$action='banner';
							break;	
			case "MediaComment":
							$modelmsg = $boolDeletUser>0?"User Comment Has Been Deleted Successfully":"User Comment Deletion Has Been Failed";
							$action='mediacomments';
						
							break;	
			case "UserMedia":
							$modelmsg = $boolDeletUser>0?"User Media Has Been Deleted Sucessfully":"User Media Deletion Has Been Failed";
							$action='usermedia';
							break;					
			default:		
			
		}
		
		$this->Session->setFlash($modelmsg,'default',array('class' => 'alert alert-success'));
		$this->redirect(array( 'action' => $action));
		
    }
	
	public function GetUsertype()		
	{
			$this->loadModel('Usertype');
			$getUsertype = $this->Usertype->find(array('fields'=>'Usertype.usertype_name'),array('conditions'=>array('usertype_id'=>1)));
			return $getUsertype;
	}
	
	public function GetRegisterdUserCount()		
	{
			$this->loadModel('Users');
			$arrCountusers  = $this->Users->find('count',array('conditions'=>array('user_notify'=>0,'usertype_id'=>2)));
			return $arrCountusers;
	}
	
	public function GetLatestRegisterdUsers()
	{
		$this->loadModel('Users');
		  $arr_UserData = $this->Users->find('all',array('conditions'=>array(
													'user_notify'=>0,'usertype_id'=>2,'user_status'=>1),'order'=>'Users.created DESC',
                        'limit'=>5));
		return $arr_UserData;
	}
	
	// Function To Show subCategories select list (Dropdown list)
	public function fnToGetAllSubCategoriesList(){
		
			$getCategoryId = $_POST["category_id"];
		
			$arr_subCategoriesList = array();
			$modelSubcategory = ClassRegistry::init('Subcategory');
			$arr_subCategoriesList = $modelSubcategory->find('list',array(
																	'fields'=>array('subcategory_id',
																					'subcategory_name'),
																	'conditions'=>array('category_id'=>$getCategoryId, 'subcategory_status'=>1)
																)
													);
													
			$arr_subCategoriesList["0"] = "Please Select Subcategory";
		
			ksort($arr_subCategoriesList);
			echo json_encode($arr_subCategoriesList);
				exit;
	}
	
	public function fnToGetAllSubSubCategoryList(){
					
					 $getsubCategoryId = $_POST["subcategory_id"];
					
		
			$arr_subsubCategoriesList = array();
		
			$modelSubsubcategory = ClassRegistry::init('Subsubcategory');
			$arr_subsubCategoriesList = $modelSubsubcategory->find('list',array(
																	'fields'=>array('subsubcategory_id',
																					'subsubcategory_name'),
																	'conditions'=>array('subcategory_id'=>$getsubCategoryId, 'subsubcategory_status'=>1)
																)
													);
													
			$arr_subsubCategoriesList["0"] = "Please Select Subsubcategory";
		
			ksort($arr_subsubCategoriesList);
			echo json_encode($arr_subsubCategoriesList);
				exit;
				
	}
	public function sendregistrationEmail($user_emailid,$subject,$name,$activate_url) {
		
      /* load CakePHP Email component */
      App::uses('CakeEmail', 'Network/Email');
		
      /* instantiate CakeEmail class */
        $Email = new CakeEmail();
	    $Email->config('smtp');
		$Email->sender('admin@artformplatform.com', 'AfPf@admin123');
		$Email->from("admin@artformplatform.com");
		$Email->to($user_emailid);
		$Email->subject($subject);
		$Email->emailFormat('html');
	   	$Email->template('user_registration', 'default');
		$Email->viewVars(array('name' => $name));
		$Email->viewVars(array('activate_url' => $activate_url));
		
		if($Email->send())
		{
			return true;
			
		}
		else
		{
			return true;
		}
     
	 
    }
	

	public function sendForgotPassEmail($user_emailid,$subject,$name,$password)
	{
		  /* load CakePHP Email component */
      App::uses('CakeEmail', 'Network/Email');
		
      /* instantiate CakeEmail class */
       $Email = new CakeEmail();
		$Email->config('smtp');
		$Email->sender('admin@artformplatform.com', 'AfPf@admin123');
		$Email->from(array('admin@artformplatform.com' => 'Artform Platform'));
		$Email->to($user_emailid);
		$Email->subject($subject);
		$Email->emailFormat('html');
		$Email->template('forgot_password', 'default');
		$Email->viewVars(array('name' => $name));
		$Email->viewVars(array('email' => $user_emailid));
		$Email->viewVars(array('password' => $password));
		
		if($Email->send())
		{
			return true;
			
		}
		else
		{
			return true;
		}
	}
	
	
function curl_get($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    $return = curl_exec($curl);
    curl_close($curl);
    return $return;
}

	public function sendConatactEmail($user_emailid,$name,$message,$subject) {
		
      /* load CakePHP Email component */
      App::uses('CakeEmail', 'Network/Email');
		
      /* instantiate CakeEmail class */
       $Email = new CakeEmail();
	   $Email->config('smtp');
		$Email->sender('admin@artformplatform.com', 'AfPf@admin123');
		$Email->from($user_emailid);
		$Email->to('admin@artformplatform.com');
		$Email->subject($subject);
		$Email->emailFormat('html');
	   	$Email->template('user_contact', 'default');
		$Email->viewVars(array('name' => $name));
		$Email->viewVars(array('message' => $message));
		
		if($Email->send())
		{
			return true;
			
		}
		else
		{
			return true;
		}
     
	 
    }

}
