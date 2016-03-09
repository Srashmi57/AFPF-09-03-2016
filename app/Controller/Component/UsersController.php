<?php
App::uses('CropAvatar', 'Lib');
class UsersController extends AppController 
{
	
	var $name = 'Users';

	var $components = array ('Email','RequestHandler','category');

    // Display user data (R)
	function index()
    {
		$this->set('arr_UserTypeList',$this->fnToGetAllUserTypeList());
	 
		
	}
	
	public function fnAddUserProcess()
	{
				
			if($this->request->is('post'))
			{
				$this->loadModel('Users');	
				$this->loadModel('UserCategory');	
				
				 $user_email = addslashes(trim($_POST['txtUsername']));
						
				$arrCountTocheckExistence = $this->Users->find('count',array('conditions'=>array('user_emailid'=>$user_email)));
				$usertype_id = addslashes(trim($_POST['txtUsertype']));
				
			if($arrCountTocheckExistence > 0)
			{
					$RespArray = array();
					$RespArray['status'] = "exists";
					echo json_encode($RespArray);
					exit;
			}
			else
			{
				
							
				$this->request->data['Users']['user_fname'] = addslashes(trim($_POST['txtFirstName']));
				$this->request->data['Users']['user_lname'] = addslashes(trim($_POST['txtLastName']));
				$this->request->data['Users']['user_emailid'] = $user_email;
				$this->request->data['Users']['usertype_id'] = $usertype_id;
				
				if($usertype_id==2)
				{
					
					if($this->request->data['txtBirth']!="")
					{
						$birth_date = isset($this->request->data['txtBirth'])? date('Y-m-d',strtotime($this->request->data['txtBirth'])):'0000-00-00';
					}
					else
					{
						$birth_date = "0000-00-00";
					}
					
					$password = addslashes(trim($_POST['txtPassword']));
					$this->request->data['Users']['user_orgpassword'] = $password;
					$this->request->data['Users']['user_password'] = AuthComponent::password(addslashes(trim($_POST['txtPassword'])));
					if(isset($_POST["selectssex"]))
					{
						$sex=$_POST["selectssex"];
						if($sex==0)
						{
							$sex='';
						}
					}
					else{
						$sex='';
					}
					$this->request->data['Users']['user_sex']= $sex;
					$this->request->data['Users']['user_nationality']= isset($this->request->data['txtNationality'])?$this->request->data['txtNationality']:'';
					$this->request->data['Users']['user_birth']= $birth_date;
					$this->request->data['Users']['user_display_name'] = addslashes(trim($_POST['displayname']));			
					$this->request->data['Users']['category_id'] = $this->request->data['category_list']['0'];
				}
				else
				{					
					$password = addslashes(trim($_POST['txtUserPassword']));
					$this->request->data['Users']['user_orgpassword'] = $password;
					$this->request->data['Users']['user_password'] = AuthComponent::password(addslashes(trim($_POST['txtUserPassword'])));
					$this->request->data['Users']['user_display_name'] = addslashes(trim($_POST['userdisplayname']));
					$this->request->data['Users']['subcategory_id']=addslashes(trim($_POST['data']['subcategory_id']));	
					$this->request->data['Users']['category_id'] = $this->request->data['category_list']['0'];
				//	$this->request->data['Users']['subcategory_id'] = $this->request->data['subcategory'];
				}
					$this->request->data['Users']['user_mobileno'] = addslashes(trim($_POST['txtphonenumber']));
					$this->request->data['Users']['created'] = date('Y-m-d H:i:s');
				
			  
				 $boolUserprocessSaved = $this->Users->save($this->request->data);
				 $getInsertid_UsersID = $this->Users->getLastInsertID();
				

				if($boolUserprocessSaved)
				{
					//print("<pre>");
					//print_r($boolUserprocessSaved);
					//print_r($_FILES);
					//echo "hello";
					//exit;
					 $activationcode =  $this->Users->getActivationHash($getInsertid_UsersID);
						$activate_url = "http://".env('SERVER_NAME')."/afpf/Users/activate/".$getInsertid_UsersID."/".$activationcode;
					 //$activate_url ='' . env('SERVER_NAME') . '/afpf/Users/activate/' . $getInsertid_UsersID. '/' . $activationcode;
					
				
					$name = $_POST['txtFirstName'];
					
					$subject= 'Activation link from Artform Platform';
					
					$issend = $this->sendregistrationEmail($user_email,$subject,$name,$activate_url);
					
					if($usertype_id==2)
					{
					
						$catdata = array();
						if(count($this->request->data['category_list'])>0)
						{
							
							foreach($this->request->data['category_list'] as $catid)
							{
									 $catdata['category_id']= $catid;
									 $catdata['user_id'] = $getInsertid_UsersID;
									
							        $usercategory_id = $this->UserCategory->saveusercategory($catdata);
									
							}
						}
					
						if(is_array($_FILES) && (count($_FILES)>0))
						{
							if($_FILES['artistimage']['name'] != "")
							{
							
								$this->loadModel('Users');
								$Image = $this->Components->load('Image');
								 $intFilesCount = count($_FILES['artistimage']['name']);
								
									 $strUserimageName = $_FILES['artistimage']['name'];
								
									
									 $strFileExt = pathinfo($strUserimageName);
									  $imageName = 'user_image_'.$getInsertid_UsersID.'.'.$strFileExt['extension'];
									
									$strUserimageTmpName = $_FILES['artistimage']['tmp_name'];
									 $imageName = $Image->resize(350,200,$_FILES['artistimage']['tmp_name'],$strFileExt['extension'],'assets/websiteuser/',$getInsertid_UsersID);
									$cropimage = $Image->resize(100,65,$_FILES['artistimage']['tmp_name'],$strFileExt['extension'],'assets/websiteuser/',$getInsertid_UsersID);
									
									move_uploaded_file($strUserimageTmpName, 'assets/websiteuser/'.$imageName);
									$boolimagesaved = $this->Users->updateAll(array('user_image' => "'$imageName'",'user_cropped_image' => "'$cropimage'"),array('user_id' => $getInsertid_UsersID));	
									//$this->Session->write('Auth.WebsitesUser.user_cropped_image', "");
							}
						}
					}
					else{
					$catdata = array();
						if(count($this->request->data['category_list1'])>0)
						{
							
							foreach($this->request->data['category_list1'] as $catid)
							{
									 $catdata['category_id']= $catid;
									 $catdata['user_id'] = $getInsertid_UsersID;
									
							        $usercategory_id = $this->UserCategory->saveusercategory($catdata);
									
							}
						}
					}
					
					//$arrUserArray['user_fname'] = addslashes(trim($_POST['txtFirstName']));
					//$arrUserArray['user_lname'] = addslashes(trim($_POST['txtLastName']));
					//$arrUserArray['user_emailid'] = $user_email;
					//$arrUserArray['user_orgpassword'] = $password;
					//$arrUserArray['usertype_id']= $usertype_id ;
				//	$this->Session->write('regSuccess',$arrUserArray);
					// $this->set('boollogsuccess', $this->requestAction('/websites/login'));
					if($boolUserprocessSaved)
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
						$RespArray['message'] = "Registration has been failed";
						$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-danger'));
						echo json_encode($RespArray);
						exit;
					}
				
				}
				else
				{  
					$RespArray = array();
					$RespArray['status'] = "fail";
					$RespArray['message'] = "Registration Process Has Been Failed";
					$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-danger'));
					echo json_encode($RespArray);
					exit;
				}
			
				
			}
		}
			
	}
	
	
	public function UpdateUserData()
	{
	
			$this->loadModel('Users');
			
			  $userid = $_POST["userid"];
			  $arr_UserData = $this->Users->find('all',array('conditions'=>array(
													'userid'=>$userid)));
				$arrUserData = array();
				$arrUserData['status'] = 'success';
				$arrUserData['user_fname'] = $arr_UserData[0]['User']['user_fname'];
				$arrUserData['user_lname'] = $arr_UserData[0]['User']['user_lname'];
				$arrUserData['usertype_id'] = $arr_UserData[0]['User']['usertype_id'];
				$arrUserData['category_id'] = $arr_UserData[0]['User']['category_id'];
				$arrUserData['user_name'] = $arr_UserData[0]['User']['user_name'];
				$arrUserData['user_password'] = $arr_UserData[0]['User']['user_password'];
				$arrUserData['subcategory_id'] = $arr_UserData[0]['User']['subcategory_id'];
				$arrUserData['user_image'] = Router::url('/', true).'assets/user/'.$arr_UserData[0]['User']['user_image'];
				
			
			$arrUserData  = json_encode($arrUserData);
			echo $arrUserData;
			exit();
			
		
	}	
	
	public function myprofile() 
	{
		 $current_user_id = $this->Session->read('Auth.WebsitesUser.user_id');
		 $arrLoggedInUser = $this->Auth->user();
	     $this->loadModel('Users');
		 $categories = $this->Components->load('category');
	    
		 $this->set('arr_CategoryList',$categories->fnToGetAllCategoryList());
		 $this->set('arr_subCategoryList',$categories->fnToGetAllsubCategoryList() );
		
		$this->set('arr_subsubCategoriesList',$categories->fnToGetSubSubCategoryList());	
		 $arrWebUser_Profile = $this->Users->find('first', array('conditions' => array('Users.user_id' => $current_user_id)));
		$this->set('arr_userCategory',$categories->fnGetUserCategory($current_user_id));
		
		 $this->set('arrWebUserProfile',$arrWebUser_Profile );
		 
		
		 if($this->request->is('post'))
		{
			//print("<pre>");
			//print_r($_POST);
			//exit;			
			$this->loadModel('Users');
			$this->loadModel('UserCategory');
			$user_id = $arrLoggedInUser['user_id'];
			$fname =$this->request->data['firstname'];
			$lname = $this->request->data['lastname'];
			$displayname = $this->request->data['displayname'];
			$phonenumber = $this->request->data['phonenumber'];
			if(isset($this->request->data['category_list']))
			{
				$category_id = $this->request->data['category_list'];
				$subcategory_id = $this->request->data['subcategory'];
				$subsubcategory_id = '0';
			}
			else
			{
				$category_id=0;
				$subcategory_id=0;
				$subsubcategory_id=0;
			}
			
						$catdata = array();
					
						if($this->request->data['artistcategory_list']!="")
						{
						
							
							$this->UserCategory->deleteAll(array('user_id'=> $user_id),false);
							foreach($this->request->data['artistcategory_list'] as $catid)
							{
									 $catdata['category_id']= $catid;
									 $catdata['user_id'] = $user_id;
									
							        $usercategory_id = $this->UserCategory->saveusercategory($catdata);
									
							}
						}
			$usernationlity = $this->request->data['usernationlity'];
			$userSex = $this->request->data['userSex'];
			$user_biography = $this->request->data['biography'];
			if(isset($this->request->data['birthdate']))
			{
				$user_birth_date =$this->request->data['birthdate'];
				$user_birth_date = date('Y-m-d',strtotime($user_birth_date));
			}
			$boolprofileSaved = $this->Users->updateAll(array('user_fname' => "'".$fname."'",'user_lname' => "'".$lname."'",'user_display_name' => "'".$displayname."'",'user_mobileno' => "'".$phonenumber."'",'category_id' => "'".$category_id."'",'subcategory_id' => "'".$subcategory_id."'",'subsubcategory_id' => "'".$subsubcategory_id."'",'user_nationality' => "'".$usernationlity."'",'user_sex' => "'".$userSex."'",'user_biography' => "'".$user_biography."'",'user_birth' => "'".$user_birth_date."'"),
					
					array('user_id' => $user_id));
				
					$this->Session->write('Auth.WebsitesUser.user_fname', $fname); //updating first_name only   
				$this->Session->write('Auth.WebsitesUser.user_lname', $lname); //updating last name   
				$this->Session->write('Auth.WebsitesUser.user_display_name', $displayname); //updating display name   
			
					
			if($boolprofileSaved)
			{
			$this->Session->setFlash('<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>  Profile Updated successfully.</div></div>');
				$this->redirect(array('action'=>'viewmyprofile'));
			}
			else
			{
			
			$this->Session->setFlash('<div class="row">
					<article>
						<!-- main -->	
						<div class="col-md-9">

							<div class="alert alert-warning"><i class="icon-info-circled"></i>'.$strRegerrorMessage.'</div></div></article></div>');
			
			//$this->redirect(array('action'=>'myprofile'));
			}
		}
	}	
	
	
	public function fnupdatecategoryprocess()
	{
		
			$this->loadModel('Users');	
				$this->loadModel('UserCategory');	
				 $current_user_id = $this->Session->read('Auth.WebsitesUser.user_id');
					$catdata = array();
					if(count($this->request->data['category_list'])>0)
					{
						
						foreach($this->request->data['category_list'] as $catid)
						{
								 $catdata['category_id']= $catid;
								 $catdata['user_id'] = $current_user_id;
								
								$usercategory_id = $this->UserCategory->saveusercategory($catdata);
								
						}
					}
					
					if(count($catdata)>0)
					{
						$RespArray = array();
						$RespArray['status'] = "success";
						$RespArray['message'] = "Category has been updated successfully";
						$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-success'));
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
		
	public function UpdateWebsiteUserProfpic($user_id)
	{
		
		
		if($this->request->is('post'))
		{
			$this->loadModel('Users');
					
		//check user existence				
		 $arrCountTocheckExistence = $this->Users->find('count',array('conditions'=>array('user_id'=>$user_id)));
		
			
			if($arrCountTocheckExistence>0)
			{
				 $olduser_image =  $this->Users->field('user_image', array('user_id' => $user_id));
				 $oldimagepath = 'assets/websiteuser/'.$olduser_image;
				
					if(file_exists($oldimagepath)&&$olduser_image!="")
					{
						unlink($oldimagepath);
					}
				
						
					if(is_array($_FILES) && (count($_FILES)>0))
					{
						if($_FILES['userimage']['name'] != "")
						{
							$this->loadModel('Users');
							$Image = $this->Components->load('Image');
							 $intFilesCount = count($_FILES['userimage']['name']);
							
								 $strUserimageName = $_FILES['userimage']['name'];
							
								
								 $strFileExt = pathinfo($strUserimageName);
								  $imageName = 'user_image_'.$user_id.'.'.$strFileExt['extension'];
								
								$strUserimageTmpName = $_FILES['userimage']['tmp_name'];
								 $imageName = $Image->resize(350,263,$_FILES['userimage']['tmp_name'],$strFileExt['extension'],'assets/websiteuser/',$user_id);
								$cropimage = "";
								
								//move_uploaded_file($strUserimageTmpName, 'assets/websiteuser/'.$imageName);
								$boolimagesaved = $this->Users->updateAll(array('user_image' => "'$imageName'",'user_cropped_image' => "'$cropimage'"),array('user_id' => $user_id));	
								$this->Session->write('Auth.WebsitesUser.user_cropped_image', "");
						}
					}
					
			}
			
				if($boolimagesaved)
				{
					$RespnewArray = array();
					$RespnewArray['status'] = "success";
					$RespnewArray['image'] = $imageName;
					$RespnewArray['message'] = "Profile Update Has Been Successful.";
					$this->Session->setFlash($RespnewArray['message'],'default',array('class' => 'alert alert-success'));
				}
				else
				{  
					$RespnewArray = array();
					$RespnewArray['status'] = "fail";
					$RespnewArray['message'] = "Profile Update Process Has Been Failed.";
					$this->Session->setFlash($RespnewArray['message'],'default',array('class' => 'alert alert-success'));
				}
				$RespnewArray = json_encode($RespnewArray);
				echo $RespnewArray;
				exit;
			
											
		}
	}
	
	public function UpdateWebsiteProfpic($user_id)
	{
			$this->loadModel('Users');
		
		if($this->request->is('post'))
		{
		
			
			 $crop = new CropAvatar($_POST['avatar_src'], $_POST['avatar_data'], $_FILES['avatar_file']);
			
			 $crop -> getMsg();
			 $newresult = $crop -> getResult();
			$newarray	= explode('/',$newresult);
			
			
			  $response = array(
				'state'  => 200,
				'message' => $crop -> getMsg(),
				'result' => $crop -> getResult()
			  );
			  $olduser_image =  $this->Users->field('user_image', array('user_id' => $user_id));
				 $oldimagepath = 'assets/websiteuser/'.$olduser_image;
				
					if(file_exists($oldimagepath)&&$olduser_image!="")
					{
						unlink($oldimagepath);
					}
				$boolimagesaved = $this->Users->updateAll(array('user_image' => "'$newarray[2]'",'user_cropped_image' => "'$newarray[2]'"),array('user_id' => $user_id));	
				$this->Session->write('Auth.WebsitesUser.user_cropped_image', $newarray[2]);
				echo json_encode($response);
					exit();
											
		}
	}
	
	
	
	
public function SavecroppedImage()
	{
		  $user_id = $this->Session->read('Auth.WebsitesUser.user_id');
		
		
		if($this->request->is('post'))
		{
			$this->loadModel('Users');
			
				//check user existence				
					$targ_w = $targ_h = 150;
					$jpeg_quality = 90;
			
					$newImgName = "user_cropimage_".$user_id.".jpg"; 
					
						//uploads path
						$path = "assets/websiteuser/";
						 $img = $this->request->data['imgName'];
						
						 $ext = pathinfo($path.$img, PATHINFO_EXTENSION);
					
						if($ext=="jpg" || $ext=="jpeg" ){
							$img_r = imagecreatefromjpeg($path.$img);
						}
						else if($ext=="png"){
							$img_r = imagecreatefrompng($path.$img);
						}
						else {
							$img_r = imagecreatefromgif($path.$img);
						}
					
						$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
						imagecopyresampled($dst_r,$img_r,0,0,$this->request->data['x'],$this->request->data['y'],$targ_w,$targ_h,$this->request->data['w'],$this->request->data['h']);
					 imagejpeg($dst_r,$path.$newImgName,$jpeg_quality);
						$boolimagesaved = $this->Users->updateAll(array('user_cropped_image' => "'$newImgName'"),array('user_id' => $user_id));	
							$this->Session->write('Auth.WebsitesUser.user_cropped_image', $newImgName);
			
				if($boolimagesaved)
				{
					$RespnewArray = array();
					$RespnewArray['status'] = "success";
				
					$RespnewArray['message'] = "Image cropped Successfully.";
					$this->Session->setFlash($RespnewArray['message'],'default',array('class' => 'alert alert-success'));
				}
				else
				{  
					$RespnewArray = array();
					$RespnewArray['status'] = "fail";
					$RespnewArray['message'] = "Image crop Has Been Failed.";
					$this->Session->setFlash($RespnewArray['message'],'default',array('class' => 'alert alert-success'));
				}
				$RespnewArray = json_encode($RespnewArray);
				echo $RespnewArray;
				exit;
			
											
		}
	}
	
	public function activate($user_id = null, $in_hash = null)
	{
		$this->loadModel('Users');
			
			 $arrCountTocheckExistence = $this->Users->find('count',array('conditions'=>array('user_id'=>$user_id)));
				 
				
			if ($arrCountTocheckExistence>0)
			{
					// Update the active flag in the database
					$boolupdatepass = $this->Users->updateAll(array('user_verified' => 1),array('user_id' => $user_id));	
				
				//$this->Users->saveField('user_verified', 1);

				// Let the user know he can now log in!
				$this->Session->setFlash('Your account has been activated, please log in','default',array('class' => 'alert alert-success'));
				$this->redirect(array("controller" => "websites",  "action" => "index"));
				
			}
			else
			{
				// Let the user know they can now log in!
				$this->Session->setFlash('Your account activation has been failed','default',array('class' => 'alert alert-danger'));
				$this->redirect(array("controller" => "websites","action" => "index"));
			}
    
	}

	public function viewmyprofile()
	{
		$this->loadModel('Users');
		$current_user_id = $this->Session->read('Auth.WebsitesUser.user_id');
		
		$componentusers = $this->Components->load('users');
		$arrUser_Profile = $componentusers->myprofile($current_user_id);
		$this->set('userid',$current_user_id );
		$this->set('arr_userCategory',$this->categories->fnGetUserCategory($current_user_id));
		$this->set('arr_CategoryList',$this->categories->fnToGetAllCategoryList());
		$this->set('sub_cat_name',$this->categories->fnToGetSubCategoryList($current_user_id));
	
		//$arrUser_Profile = $this->Users->find('first', array('conditions' => array('Users.user_id' => $current_user_id)));
		
		$this->set('arrUser_Profile',$arrUser_Profile );
		
		/// how many followed to artist
		$arrCountartistfollowers = $componentusers->getArtistfollowers($current_user_id,10);
		$this->set('followersarray',$arrCountartistfollowers );
		$followerscount	= $componentusers->getcountArtistfollowers($current_user_id);
		$this->set('followerscount',$followerscount);
		
		// how many liked to artist
		$arrCountartistlikes = $componentusers->getArtistLikes($current_user_id,10);
		$this->set('likesarray',$arrCountartistlikes );
		$likescount = $componentusers->getcountArtistLikes($current_user_id);
		$this->set('likescount',$likescount );
		
		
		// view artist followed how many other artist
		$arrArtistfollowing = $componentusers->getuserfollowing($current_user_id,10);
		$this->set('arrArtistfollowing',$arrArtistfollowing );
		$cntArtistfollowing	= $componentusers->getcountuserfollowing($current_user_id);
		$this->set('cntArtistfollowing',$cntArtistfollowing );
		
		//get list of artist to user voted him 
		
		$compFileUploader = $this->Components->load('Fileupload');
		$userdetail = $compFileUploader->uservotedArtist($current_user_id);
			$this->set('userdetail',$userdetail );
			
	}
	 
	 public function UpdateUserMoodMsg()
	 {
		 $this->loadModel('Users');
		 $current_user_id = $this->Session->read('Auth.WebsitesUser.user_id');

		 $value = $_POST['value'];
		 $userdata = array();
		 $userdata["user_id"]= $current_user_id;
		 $userdata["value"]= $value;
			 
		$this->Users->updateMessage($userdata);	
		
		$RespnewArray = array();
		
		$RespnewArray['status'] = "success";
		$RespnewArray['value'] = $value;
		$RespnewArray = json_encode($RespnewArray);
			echo $RespnewArray;
			exit;
	 }
	 
	public function fnForgotPasswordProcess()
	 {
			$this->loadModel('Users');
			
			//check user existence		
			
			 if($this->request->is('post'))
			{
				$Username = addslashes($this->request->data['txtUsername']);

				//check user name exists
				 $user_id = $this->Users->field('user_id', array('user_emailid' => $Username));
				 
					 if($user_id >0)
					 {
						 $arrWebUser_Profile = $this->Users->find('first', array('conditions' => array('Users.user_id' => $user_id)));
						 $userfname = $arrWebUser_Profile['Users']['user_fname'];
						 $userlname = $arrWebUser_Profile['Users']['user_lname'];
						  $user_password = $arrWebUser_Profile['Users']['user_orgpassword'];
						  $name = $userfname;
						   $subject= 'Requested Login details from Artform Platform';
						
						$issend = $this->sendForgotPassEmail($Username,$subject,$userfname,$user_password);
						if($issend)
						{
							$RespnewArray = array();
							$RespnewArray['status'] = "success";
							$RespnewArray['message'] = "Please check Email for login details.";
							$this->Session->setFlash($RespnewArray['message'],'default',array('class' => 'alert alert-success'));
						}
						else
						{
							$RespnewArray = array();
							$RespnewArray['status'] = "fail";
							$RespnewArray['message'] = "Something wrong happened.";
							//	$this->Session->setFlash($RespnewArray['message'],'default',array('class' => 'alert alert-danger'));
						}
					 }
					 
					else
					{  
						$RespnewArray = array();
						$RespnewArray['status'] = "notfound";
						$RespnewArray['message'] = "User Not found.";
						//$this->Session->setFlash($RespnewArray['message'],'default',array('class' => 'alert alert-success'));
					}
					
					$RespnewArray = json_encode($RespnewArray);
					echo $RespnewArray;
					exit;
			}
	 }
	 
 public function fnToUpdatechangePassword()
 {
		$this->loadModel('Users');
		$current_user_id = $this->Session->read('Auth.WebsitesUser.user_id');
		//check user existence		
		
		 if($this->request->is('post'))
		{
			 $oldpassword = addslashes($this->request->data['txtOldPassword']);
			
			 $newpassword = AuthComponent::password(addslashes(trim($this->request->data['txtNewPassword'])));
			$db_password	= $this->request->data['txtNewPassword'];
			 $oldpassword =	AuthComponent::password(addslashes(trim($oldpassword)));
			//Get Old Password
			
			  $dbuser_password = $this->Users->field('user_password', array('user_id' => $current_user_id));
			
			 $userexist = $dbuser_password == $oldpassword? 1:0;
			$RespnewArray = array();
				 if($userexist >0)
				 {					 			 
					$boolupdatepass = $this->Users->updateAll(array('user_password' => "'$newpassword'", 'user_orgpassword' => "'$db_password'"),array('user_id' => $current_user_id));	
					if($boolupdatepass)
					{
						
						$RespnewArray['status'] = "success";
						$RespnewArray['message'] = "Password changed Successfully";
						$this->Session->setFlash($RespnewArray['message'],'default',array('class' => 'alert alert-success'));	
					}
					else
					{  
						$RespnewArray['status'] = "fail";
						$RespnewArray['message'] = "Error Please try again.";
						
					}
				 }
				else
				{  
					$RespnewArray['status'] = "fail";
					$RespnewArray['message'] = "Wrong old Password.";
					
				}
				
				$RespnewArray = json_encode($RespnewArray);
				echo $RespnewArray;
				exit;
		}
 }

public function artist($artist_id)
 {
	   $this->loadModel('Users');
	   $this->loadModel('MediaLikes');
	   $this->loadModel('MediaRating');
	   $current_user_id = $this->Session->read('Auth.WebsitesUser.user_id');
	 
	 $this->set('islogin',$current_user_id);
	 $this->set('showedit',0);
	$componentusers = $this->Components->load('users');
	$arrUser_Profile = $componentusers->myprofile($artist_id);
	$this->set('arr_CategoryList',$this->categories->fnToGetAllCategoryList());
	
	//get my rank
	$rank = $componentusers->getMyRank($artist_id);
	$this->set('rank',$rank);
	
	$this->set('arrUser_Profile',$arrUser_Profile );
	$this->set('userid',$artist_id);
	
	//get user categories in which he is registered
	
	 
	$this->set('arr_userCategory',$this->categories->fnGetUserCategory($artist_id));
	
	/// how many followed to artist
	$arrCountartistfollowers = $componentusers->getArtistfollowers($artist_id,10);
	$followerscount	= $componentusers->getcountArtistfollowers($artist_id);
	$this->set('followersarray',$arrCountartistfollowers);
	$this->set('followerscount',$followerscount);

	// how many liked to artist
	$arrCountartistlikes = $componentusers->getArtistLikes($artist_id,10);
	$likescount = $componentusers->getcountArtistLikes($artist_id);
	$this->set('likesarray',$arrCountartistlikes );
	$this->set('likescount',$likescount);
	
	// view artist followed how many other artist
	$arrArtistfollowing = $componentusers->getuserfollowing($artist_id,10);
	$this->set('arrArtistfollowing',$arrArtistfollowing);
	$cntArtistfollowing	= $componentusers->getcountuserfollowing($artist_id);
	$this->set('cntArtistfollowing',$cntArtistfollowing );
	
	// get count of likes and foolwers of artist
	
	$this->loadModel('Followers');
	
	//logged user has followed this artist
	$arrloggedfollowed = $this->Followers->find('count',array('conditions'=>array('artist_id'=>$artist_id,'user_id'=>$current_user_id)));
	$this->set('isloggedfollowed',$arrloggedfollowed );
	
	$this->loadModel('Likes');
	
	//logged user has liked this artist
	 $arrloggedlike = $this->Likes->find('count',array('conditions'=>array('artist_id'=>$artist_id,'user_id'=>$current_user_id)));
	$this->set('isloggedlike',$arrloggedlike);

		
	//get ratings of per item
	
	//media component
	$compFileUploader = $this->Components->load('Fileupload');
	$arrFileDetail = $compFileUploader->uploadedmediabyuser($artist_id);
	$this->set('uploadedmediadata',$arrFileDetail);
	
	
	$artistmediaDetails = $compFileUploader->uploadedavgmediabyuser($artist_id);
	$this->set('artistmediaDetails',$artistmediaDetails);
	
	//check looged user has liked this current media
			
	$medialikes_id = $this->MediaLikes->field('medialikes_id', array('user_id' => $current_user_id,'usermedia_id'=>$artistmediaDetails[0]['UserMedia']['usermedia_id']));
	$mediatext = $medialikes_id>0?'Unlike':'Like';		
	$this->set('mediatext',$mediatext);	
	if($current_user_id>0)
	{
		//check logged user have given how many rates to art piece
		$MediaRating = $this->MediaRating->find('first', array('conditions' => array('user_id' => $current_user_id,'usermedia_id'=>$artistmediaDetails[0]['UserMedia']['usermedia_id'])));
	}
	else
	{
		$MediaRating = $this->MediaRating->find('first', array('fields'=>array('avg(media_rating) as media_rating','mediarating_id'),'conditions' => array('usermedia_id'=>$artistmediaDetails[0]['UserMedia']['usermedia_id'])));
		
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
	//get artist recent uploaded
		
				$arrrecentuploads = $compFileUploader->getartistrecentuploads($artist_id);
			$this->set('recentmedia',$arrrecentuploads);

 }

public function followToartistProcess()
  {
	  
	  $this->loadModel('Followers');
	  //get logged user
		
		$current_user_id = $this->Session->read('Auth.WebsitesUser.user_id');
		  $artist_id = $_POST['artist_id'];
		
		//check user has allready follow to artist
		 //$arrCountTocheckExistence = $this->Followers->find('count',array('conditions'=>array('user_id'=>$current_user_id,'artist_id'=>$artist_id)));
		 $followers_id = $this->Followers->field('followers_id', array('user_id' => $current_user_id,'artist_id'=>$artist_id));
		
	  //user follow to artist
	if($followers_id>0)
	{
			$boolDeletfollower = $this->Followers->deleteAll(array('followers_id'=> $followers_id),false);
		  	 $RespnewArray = array();
			 if($boolDeletfollower)
			 {
				  $RespnewArray['status'] = "unfollow";
				  $RespnewArray['message'] = "You are successfully unfolowed to artist.";
				 
			 }
			 else
			 {
				   $RespnewArray['status'] = "fail";
				  $RespnewArray['message'] = "Error during unfolowing to artist.";
				 
			 }
	}
	else
	{
		$this->request->data['Followers']['artist_id'] = $artist_id;
		$this->request->data['Followers']['user_id'] = $current_user_id;
		$boolFollowprocessSaved = $this->Followers->save($this->request->data);
		
	  if($boolFollowprocessSaved)
	  {
		  $RespnewArray = array();
		  $RespnewArray['status'] = "follow";
		  $RespnewArray['message'] = "Follow to artist successfully.";
		 
	  }
	  else
	  {
		  $RespnewArray = array();
		  $RespnewArray['status'] = "fail";
		  $RespnewArray['message'] = "Follow to artist Failed.";
		
	  }
	}
	 $RespnewArray = json_encode($RespnewArray);
	echo $RespnewArray;
	exit;
	  
  }
  
		public function likeToartistProcess()
		{

		$this->loadModel('Likes');
		//get logged user

		$current_user_id = $this->Session->read('Auth.WebsitesUser.user_id');

		//user follow to artist
		$artist_id = $_POST['artist_id'];
		//check user has allready follow to artist
		// $arrCountTocheckExistence = $this->Likes->find('count',array('conditions'=>array('user_id'=>$current_user_id,'artist_id'=>$artist_id)));
		$likes_id = $this->Likes->field('likes_id', array('user_id' => $current_user_id,'artist_id'=>$artist_id));


		if($likes_id >0)
		{

			$boolDeletlike = $this->Likes->deleteAll(array('likes_id'=> $likes_id),false);

			if($boolDeletlike)
			{
				$RespnewArray = array();
				$RespnewArray['status'] = "unlike";
				$RespnewArray['message'] = "Artist like successfully";
				
			}
			else
			{
				$RespnewArray = array();
				$RespnewArray['status'] = "error";
				$RespnewArray['message'] = "Artist unlike successfully.";
			
			}
		}
		else
		{
			$this->request->data['Likes']['artist_id'] = $artist_id;
			$this->request->data['Likes']['user_id'] = $current_user_id;
			$boolFollowprocessSaved = $this->Likes->save($this->request->data);
			if($boolFollowprocessSaved)
			{
				$RespnewArray = array();
				$RespnewArray['status'] = "like";
				$RespnewArray['message'] = "Like to artist successfully.";
				
			}
			else
			{
				$RespnewArray = array();
				$RespnewArray['status'] = "fail";
				$RespnewArray['message'] = "Like to artist Failed.";
				
			}

		}
		$RespnewArray = json_encode($RespnewArray);
		echo $RespnewArray;
		exit;

		}

		
  
		public function likeTomediaProcess()
		{

			$this->loadModel('MediaLikes');
		//get logged user

			$current_user_id = $this->Session->read('Auth.WebsitesUser.user_id');

		//user likes to media
		$usermedia_id = $_POST['usermedia_id'];
		//check user has allready likes to media
		// $arrCountTocheckExistence = $this->Likes->find('count',array('conditions'=>array('user_id'=>$current_user_id,'artist_id'=>$artist_id)));
		$medialikes_id = $this->MediaLikes->field('medialikes_id', array('user_id' => $current_user_id,'usermedia_id'=>$usermedia_id));


		if($medialikes_id >0)
		{

			$boolDeletlike = $this->MediaLikes->deleteAll(array('medialikes_id'=> $medialikes_id),false);

			if($boolDeletlike)
			{
				$RespnewArray = array();
				$RespnewArray['status'] = "unlike";
				$RespnewArray['message'] = "Media liked successfully";
				
			}
			else
			{
				$RespnewArray = array();
				$RespnewArray['status'] = "error";
				$RespnewArray['message'] = "Media unliked successfully.";
			
			}
		}
		else
		{
			$this->request->data['MediaLikes']['usermedia_id'] = $usermedia_id;
			$this->request->data['MediaLikes']['user_id'] = $current_user_id;
			$boolFollowprocessSaved = $this->MediaLikes->save($this->request->data);
			if($boolFollowprocessSaved)
			{
				$RespnewArray = array();
				$RespnewArray['status'] = "like";
				$RespnewArray['message'] = "Like to media successfully.";
				
			}
			else
			{
				$RespnewArray = array();
				$RespnewArray['status'] = "fail";
				$RespnewArray['message'] = "Like to media Failed.";
				
			}

		}
		$RespnewArray = json_encode($RespnewArray);
		echo $RespnewArray;
		exit;

		}

		
		public function listallfollowers($userid)
		{
		$this->loadModel('Users');
		$componentusers = $this->Components->load('users');

		$arrCountartistfollowers = $componentusers->getArtistfollowers($userid);
	
		$view = new View($this, false);
		$view->set('followersarray',$arrCountartistfollowers);
		$strContactHtml = $view->element('followers_details');	
		if($strContactHtml)
		{

		$arrResponse['status'] = "success";
		$arrResponse['content'] = $strContactHtml;
		}
		else
		{
		$arrResponse['status'] = "fail";
		}
		echo json_encode($arrResponse);
		exit;
		}


		public function listallfollowing($userid)
		{
		$this->loadModel('Users');
		$componentusers = $this->Components->load('users');

		$arrCountartistfollowing = $componentusers->getuserfollowing($userid);
		$view = new View($this, false);
		$view->set('arrArtistfollowing',$arrCountartistfollowing);
		$strContactHtml = $view->element('following_details');	
		if($strContactHtml)
		{

		$arrResponse['status'] = "success";
		$arrResponse['content'] = $strContactHtml;
		}
		else
		{
		$arrResponse['status'] = "fail";
		}
		echo json_encode($arrResponse);
		exit;
		}

		public function listalllikes($userid)
		{
		$this->loadModel('Users');
		$componentusers = $this->Components->load('users');

		$arrCountartistlikes = $componentusers->getArtistLikes($userid);
		$view = new View($this, false);
		$view->set('arrlikesarray',$arrCountartistlikes);
		$strContactHtml = $view->element('like_details');	
		if($strContactHtml)
		{

		$arrResponse['status'] = "success";
		$arrResponse['content'] = $strContactHtml;
		}
		else
		{
		$arrResponse['status'] = "fail";
		}
		echo json_encode($arrResponse);
		exit;
		}
		public function  mypage()
		{
			$this->loadModel('Users');
			$this->loadModel('MediaLikes');
			$this->loadModel('MediaRating');
			$current_user_id = $this->Session->read('Auth.WebsitesUser.user_id');
			$this->set('islogin',$current_user_id);

			$componentusers = $this->Components->load('users');
			$arrUser_Profile = $componentusers->myprofile($current_user_id);
			$this->set('userid',$current_user_id );
			$this->set('showedit',1);
			$this->set('arrUser_Profile',$arrUser_Profile );
			$this->set('arr_userCategory',$this->categories->fnGetUserCategory($current_user_id));
		
			$arrCountartistfollowers = $componentusers->getArtistfollowers($current_user_id,10);
			$this->set('followersarray',$arrCountartistfollowers );
			$followerscount	= $componentusers->getcountArtistfollowers($current_user_id);
			$this->set('followerscount',$followerscount);
			$this->set('arr_CategoryList',$this->categories->fnToGetAllCategoryList());
			// how many liked to artist
			$arrCountartistlikes = $componentusers->getArtistLikes($current_user_id,10);
			$this->set('likesarray',$arrCountartistlikes );
			$likescount = $componentusers->getcountArtistLikes($current_user_id);
			$this->set('likescount',$likescount );


			// view artist followed how many other artist
			$arrArtistfollowing = $componentusers->getuserfollowing($current_user_id,10);
			$this->set('arrArtistfollowing',$arrArtistfollowing );
			$cntArtistfollowing	= $componentusers->getcountuserfollowing($current_user_id);
			$this->set('cntArtistfollowing',$cntArtistfollowing );

				//media component
				$compFileUploader = $this->Components->load('Fileupload');
			$arrFileDetail = $compFileUploader->uploadedmediabyuser($current_user_id);
			$this->set('uploadedmediadata',$arrFileDetail);
			
			//get recent uploads by artist
			
			
			$arrrecentuploads = $compFileUploader->getmyrecentuploads();
			$this->set('recentmedia',$arrrecentuploads);
			
			$artistmediaDetails = $compFileUploader->uploadedavgmediabyuser($current_user_id);
			$this->set('artistmediaDetails',$artistmediaDetails);
			
			
			//check looged user has liked this current media
			if(count($artistmediaDetails)>0)
			{
				$medialikes_id = $this->MediaLikes->field('medialikes_id', array('user_id' => $current_user_id,'usermedia_id'=>$artistmediaDetails[0]['UserMedia']['usermedia_id']));
				$mediatext = $medialikes_id>0?'Unlike':'Like';		
				$this->set('mediatext',$mediatext);	
			}
			
			//$MediaRating = $this->MediaRating->find('first', array( 'fields' => array('avg(media_rating) as media_rating','mediarating_id'), 'conditions' => array('user_id' => $current_user_id,'usermedia_id'=>$artistmediaDetails[0]['UserMedia']['usermedia_id'])));
			
			
	if($current_user_id>0)
	{
		//check logged user have given how many rates to art piece
		$MediaRating = $this->MediaRating->find('first', array('conditions' => array('user_id' => $current_user_id,'usermedia_id'=>$artistmediaDetails[0]['UserMedia']['usermedia_id'])));
	}
	else
	{
		$MediaRating = $this->MediaRating->find('first', array('fields'=>array('avg(media_rating) as media_rating','mediarating_id'),'conditions' => array('usermedia_id'=>$artistmediaDetails[0]['UserMedia']['usermedia_id'])));
		
	}
			
			
		if(count($MediaRating)>0)
			{
				$this->set('viewmediarateid',$MediaRating['MediaRating']['mediarating_id']);	
				$this->set('viewmediarateing',$MediaRating[0]['media_rating']);	
			}
			else
			{
				$this->set('viewmediarateid',0);	
				$this->set('viewmediarateing',0);	
			}	
		}

		public function getartistmedia($usermedia_id,$shoedit)
		{
			$this->loadModel('UserMedia');
			$this->loadModel('MediaComment');
			$this->loadModel('MediaLikes');
			$this->loadModel('MediaRating');
			
			$view = new View($this, false);

			//get usermedia uploaded by user 
			$current_user_id = $this->Session->read('Auth.WebsitesUser.user_id');

			$artistmediaDetails = $this->UserMedia->find('first', array(
			'fields' => array('UserMedia.usermedia_title','UserMedia.usermedia_name','UserMedia.usermedia_path','UserMedia.usermedia_type','UserMedia.user_id','UserMedia.cover_id','usermedia_cover.usermedia_title','usermedia_cover.usermedia_path','cat.category_name as category_name'),
				'joins' => array(
				array(
				'table' => 'usermedia',
				'alias' => 'usermedia_cover',
				'type' => 'left',
				'recursive' => -1,
				'conditions'=> array('UserMedia.cover_id = usermedia_cover.usermedia_id')
				),
				array(
					'table' => 'category',
					'alias' => 'cat',
					'type' => 'inner',
					'recursive' => -1,
					'conditions'=> array('UserMedia.category_id = cat.category_id')
			  )),
			'conditions' =>array('UserMedia.usermedia_id ='.$usermedia_id)));


			//get comments placed to given media
			$arrUser_Comments = $this->MediaComment->find('all',array( 
			'fields' => array('MediaComment.*','Users.user_fname','Users.user_lname','Users.user_display_name','Users.usertype_id','Users.user_image','Users.user_cropped_image','Users.user_id'),
			'joins' => array(
			array(
			'table' => 'users',
			'alias' => 'Users',
			'type' => 'inner',
			'recursive' => -1,
			'conditions'=> array('Users.user_id = MediaComment.user_id')
			)), 'conditions' =>  array('MediaComment.usermedia_id' => $usermedia_id), 'order'=>array('MediaComment.created DESC'), 'limit'=>5));

			if($current_user_id>0)
			{
			//check looged user has liked this current media
				$MediaRating = $this->MediaRating->find('first', array('conditions' => array('user_id' => $current_user_id,'usermedia_id'=>$usermedia_id)));
			}
			else
			{
				$MediaRating = $this->MediaRating->find('first', array('fields'=>array('avg(media_rating) as media_rating','mediarating_id'),'conditions' => array('usermedia_id'=>$usermedia_id)));
				
			}
			
	
			$medialikes_id = $this->MediaLikes->field('medialikes_id', array('user_id' => $current_user_id,'usermedia_id'=>$usermedia_id));
			$mediatext = $medialikes_id>0?'Unlike':'Like';
			$view->set('artistmediaDetails',$artistmediaDetails);
			$view->set('arrUserComments',$arrUser_Comments);
			$view->set('usermedia_id',$usermedia_id);
			$view->set('islogin',$current_user_id);
			$view->set('showedit',$shoedit);
			$view->set('mediatext',$mediatext);
			if(count($MediaRating)>0 && $current_user_id>0)
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
			}
			
			$strContactHtml = $view->element('artist_details');	


			if($strContactHtml)
			{

			$arrResponse['status'] = "success";
			$arrResponse['content'] = $strContactHtml;
			}
			else
			{
			$arrResponse['status'] = "fail";
			}
			echo json_encode($arrResponse);
			exit;
		}	



		public function getAvgartistmedia($usermedia_id,$catname)
		{
			$this->loadModel('UserMedia');
			$this->loadModel('MediaComment');
			$this->loadModel('MediaLikes');
			$this->loadModel('MediaRating');

			$view = new View($this, false);
			
			
			switch($catname)
			{
				 case 'category':
						 
						 $catname = "cat.category_name as category_name";
						 $catarray= array(
					'table' => 'category',
					'alias' => 'cat',
					'type' => 'inner',
					'recursive' => -1,
					'conditions'=> array('UserMedia.category_id = cat.category_id')
			  );
						 break;
				
				case 'subcategory':
						
						 $catname = "subcat.subcategory_name as category_name";
						 $catarray= array(
					'table' => 'subcategory',
					'alias' => 'subcat',
					'type' => 'inner',
					'recursive' => -1,
					'conditions'=> array('UserMedia.subcategory_id = subcat.subcategory_id')
			  );
						 break;
						 
				case 'subsubcategory':
				
						 
						 $catname = "subsubcat.subsubcategory_name as category_name";
						$catarray = array(
					'table' => 'subsubcategory',
					'alias' => 'subsubcat',
					'type' => 'inner',
					'recursive' => -1,
					'conditions'=> array('UserMedia.subsubcategory_id = subsubcat.subsubcategory_id')
			  );
						 break;
				 default:
						 
						  $catname = "cat.category_name as category_name";
						 $catarray = array(
					'table' => 'category',
					'alias' => 'cat',
					'type' => 'inner',
					'recursive' => -1,
					'conditions'=> array('UserMedia.category_id = cat.category_id')
			  );
						 break;	 				 
				
			}
			//get usermedia uploaded by user 
			$current_user_id = $this->Session->read('Auth.WebsitesUser.user_id');
			$current_user_id= $current_user_id>0?$current_user_id:0;
			$artistmediaDetails = $this->UserMedia->find('first', array(
			'fields' => array('UserMedia.usermedia_title','UserMedia.usermedia_name','UserMedia.user_id','UserMedia.cover_id','UserMedia.usermedia_path','UserMedia.usermedia_type','usermedia_cover.usermedia_title','usermedia_cover.usermedia_path','avg(mrate.media_rating) as totalrating',$catname,'users.user_fname','count(medialikes.medialikes_id) as mediacount'),
			'joins' => array(
			array(
				'table' => 'mediarating',
				'alias' => 'mrate',
				'type' => 'left',
				'recursive' => -1,
				'conditions'=> array('mrate.usermedia_id = UserMedia.usermedia_id')
			),
			array(
				'table' => 'users',
				'alias' => 'users',
				'type' => 'inner',
				'recursive' => -1,
				'conditions'=> array('users.user_id = UserMedia.user_id')
			),
			array(
				'table' => 'usermedia',
				'alias' => 'usermedia_cover',
				'type' => 'left',
				'recursive' => -1,
				'conditions'=> array('UserMedia.cover_id = usermedia_cover.usermedia_id')
			),
			array(
				'table' => 'medialikes',
				'alias' => 'medialikes',
				'type' => 'left',
				'recursive' => -1,
				'conditions'=> array('medialikes.usermedia_id ='.$usermedia_id)
			),
			$catarray),
			'conditions' =>array('UserMedia.usermedia_id ='.$usermedia_id)));

			//get comments placed to given media
			$arrUser_Comments = $this->MediaComment->find('all',array( 
			'fields' => array('MediaComment.*','Users.user_fname','Users.user_lname','Users.user_image','Users.user_display_name','Users.user_cropped_image','Users.usertype_id','Users.user_id'),
			'joins' => array(
			array(
				'table' => 'users',
				'alias' => 'Users',
				'type' => 'inner',
				'recursive' => -1,
				'conditions'=> array('Users.user_id = MediaComment.user_id')
				)), 'conditions' =>  array('MediaComment.usermedia_id' => $usermedia_id), 'order'=>array('MediaComment.created DESC'), 'limit'=>5));


				
				$medialikes_id = $this->MediaLikes->field('medialikes_id', array('user_id' => $current_user_id,'usermedia_id'=>$usermedia_id));
				$mediatext = $medialikes_id>0?'Unlike':'Like';
				
				
			if($current_user_id>0)
			{
				//check logged user have given how many rates to art piece
				$MediaRating = $this->MediaRating->find('first', array('conditions' => array('user_id' => $current_user_id,'usermedia_id'=>$usermedia_id)));
			}
			else
			{
				$MediaRating = $this->MediaRating->find('first', array('fields'=>array('avg(media_rating) as media_rating','mediarating_id'),'conditions' => array('usermedia_id'=>$usermedia_id)));
				
		}
	
		if(count($MediaRating)>0 && $current_user_id>0)
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
			}
		
				$view->set('artistmediaDetails',$artistmediaDetails);
				$view->set('arrUserComments',$arrUser_Comments);
				$view->set('islogin',$current_user_id);
				$view->set('mediatext',$mediatext);
				$view->set('usermedia_id',$usermedia_id);
				$strContactHtml = $view->element('media_details');	


			if($strContactHtml)
			{

				$arrResponse['status'] = "success";
				$arrResponse['content'] = $strContactHtml;
			}
			else
			{
				$arrResponse['status'] = "fail";
			}
			echo json_encode($arrResponse);
			exit;
		}


		public function	getartistmedianame($usermedia_id) 
		{

		$this->loadModel('UserMedia');

		$artistmedianame = $this->UserMedia->field('UserMedia.usermedia_name','UserMedia.usermedia_id ='.$usermedia_id);
		$arrResponse['status'] = "success";
		$arrResponse['content'] = $artistmedianame;
		echo json_encode($arrResponse);
		exit;
		}


		public function fnUserCommentProcess()
		{


		$this->loadModel('MediaComment');
		//get logged user

		if($this->request->is('post'))
		{
			$usermediaid = addslashes($this->request->data['usermediaid']);

			$comment = $this->request->data['txtcomment'];
			//get usermedia uploaded by user 
			$current_user_id = $this->Session->read('Auth.WebsitesUser.user_id');
			$this->request->data['MediaComment']['user_id'] = $current_user_id;	 
			$this->request->data['MediaComment']['usermedia_id'] = $usermediaid;
			$this->request->data['MediaComment']['usermedia_comment'] = $comment;	 
			$this->request->data['MediaComment']['created'] = date('Y-m-d H:i:s');	 
			$boolCommentprocessSaved = $this->MediaComment->save($this->request->data);
			$getInsertid_UsersID = $this->MediaComment->getLastInsertID();


		if($boolCommentprocessSaved)
		{

			$this->loadModel('Users');
				$arrWebUser_Profile = $this->Users->find('first', array('fields'=>array('user_fname','user_lname','user_display_name','user_image','user_cropped_image','usertype_id','user_id'),'conditions' => array('Users.user_id' => $current_user_id)));

			$arrUserData = array();
			$arrUserData['status'] = 'success';
			$arrUserData['user_fname'] = $arrWebUser_Profile['Users']['user_fname'];
			$arrUserData['mediacomment_id'] = $getInsertid_UsersID;
			$arrUserData['user_lname'] = $arrWebUser_Profile['Users']['user_lname'];
			$arrUserData['user_display_name'] = $arrWebUser_Profile['Users']['user_display_name'];
			

			if($arrWebUser_Profile['Users']['usertype_id']==2)
			{
				$hrefuser = Router::url('/', true).'users/artist/'.$arrWebUser_Profile['Users']['user_id'];
			}
			else
			{
				$hrefuser="javascript:void(0)";
			}

			if(file_exists("assets/websiteuser/".$arrWebUser_Profile['Users']['user_cropped_image'])&&$arrWebUser_Profile['Users']['user_cropped_image']!="")
			{
				$imagepath = Router::url('/', true)."assets/websiteuser/".$arrWebUser_Profile['Users']['user_cropped_image'];
			}
			else
			{
				$imagepath =Router::url('/', true)."images/user-comment.png";
			}
			$arrUserData['user_image'] = $imagepath;
			$arrUserData['user_comment'] = $comment;
			$arrUserData['hrefuser'] = $hrefuser;
			$arrUserData  = json_encode($arrUserData);
			echo $arrUserData;
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



		public function fnUpdateCommentProcess()
		{

				$this->loadModel('MediaComment');
				$this->loadModel('Users');
				if($this->request->is('post'))
				{
				$comment = addslashes($this->request->data['txtupdatecomment']);

				$updateusermediaid = $this->request->data['updateusermediaid'];

				$boolupdatecmt = $this->MediaComment->updateAll(array('usermedia_comment' => "'$comment'"),array('mediacomment_id' => $updateusermediaid));	
				if($boolupdatecmt)
				{
				$retuser_id = $this->MediaComment->field('user_id','mediacomment_id ='.$updateusermediaid);

				$arrWebUser_Profile = $this->Users->find('first', array('fields'=>array('user_fname','user_lname','user_display_name','user_image','user_cropped_image','usertype_id','user_id'),'conditions' => array('Users.user_id' => $retuser_id)));

				$arrUserData = array();
				$arrUserData['status'] = 'success';
				$arrUserData['user_fname'] = $arrWebUser_Profile['Users']['user_fname'];
				$arrUserData['mediacomment_id'] = $updateusermediaid;
				$arrUserData['user_lname'] = $arrWebUser_Profile['Users']['user_lname'];
				$arrUserData['user_display_name'] = $arrWebUser_Profile['Users']['user_display_name'];

				if($arrWebUser_Profile['Users']['usertype_id']==2)
				{
					$hrefuser = Router::url('/', true).'users/artist/'.$arrWebUser_Profile['Users']['user_id'];
				}
				else
				{
					$hrefuser="javascript:void(0)";
				}

				if(file_exists("assets/websiteuser/".$arrWebUser_Profile['Users']['user_cropped_image']) && ($arrWebUser_Profile['Users']['user_cropped_image']!=""))
				{
					$imagepath = Router::url('/', true)."assets/websiteuser/".$arrWebUser_Profile['Users']['user_cropped_image'];
				}
				else
				{
				  $imagepath = Router::url('/', true)."images/user-comment.png";
				}
				$arrUserData['user_image'] = $imagepath;
				$arrUserData['user_comment'] = $comment;
				$arrUserData['hrefuser'] = $hrefuser;
				$arrUserData  = json_encode($arrUserData);
				echo $arrUserData;
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


		public function deletecomment($mediacomment_id)
		{

		$this->loadModel('MediaComment');
		$booldeletecmtprocess = $this->MediaComment->deleteAll(array('mediacomment_id'=> $mediacomment_id),false);
		//$this->MediaComment->deleteAll(array('mediacomment_id' => $mediacomment_id ));
		if($booldeletecmtprocess)
		{
		$RespnewArray['status'] = "success";
		$RespnewArray['message'] = "Media comment deleted Successfully";

		}
		else
		{
		$RespnewArray['status'] = "fail";
		$RespnewArray['message'] = "Media comment deleted failed";
		}
		$RespnewArray = json_encode($RespnewArray);
		echo $RespnewArray;
		exit;
		}
		
		public function updatemedianame($media_id)
		{

		$this->loadModel('MediaComment');

		$mediacommentnamearr = $this->MediaComment->find('first',array( 
				'fields' => array('MediaComment.usermedia_comment','MediaComment.mediacomment_id','usermedia.usermedia_name'),
				'joins' => array(
				array(
				'table' => 'usermedia',
				'alias' => 'usermedia',
				'type' => 'inner',
				'recursive' => -1,
				'conditions'=> array('MediaComment.usermedia_id = usermedia.usermedia_id')
				)
				), 'conditions' =>  array('MediaComment.mediacomment_id' => $mediacomment_id)));
			$arrCommentData = array();

			$arrCommentData['status'] = 'success';
			$arrCommentData['usermedia_comment'] = $mediacommentnamearr['MediaComment']['usermedia_comment'];
			$arrCommentData['mediacomment_id'] = $mediacommentnamearr['MediaComment']['mediacomment_id'];
			$arrCommentData['usermedia_name'] = $mediacommentnamearr['usermedia']['usermedia_name'];
			$RespnewArray = json_encode($arrCommentData);
			echo $RespnewArray;
			exit;
		}
		

		public function updatecomment($mediacomment_id)
		{

		$this->loadModel('MediaComment');

		$mediacommentnamearr = $this->MediaComment->find('first',array( 
				'fields' => array('MediaComment.usermedia_comment','MediaComment.mediacomment_id','usermedia.usermedia_name'),
				'joins' => array(
				array(
				'table' => 'usermedia',
				'alias' => 'usermedia',
				'type' => 'inner',
				'recursive' => -1,
				'conditions'=> array('MediaComment.usermedia_id = usermedia.usermedia_id')
				)
				), 'conditions' =>  array('MediaComment.mediacomment_id' => $mediacomment_id)));
			$arrCommentData = array();

			$arrCommentData['status'] = 'success';
			$arrCommentData['usermedia_comment'] = $mediacommentnamearr['MediaComment']['usermedia_comment'];
			$arrCommentData['mediacomment_id'] = $mediacommentnamearr['MediaComment']['mediacomment_id'];
			$arrCommentData['usermedia_name'] = $mediacommentnamearr['usermedia']['usermedia_name'];
			$RespnewArray = json_encode($arrCommentData);
			echo $RespnewArray;
			exit;
		}

		public function saveuserrating($usermediaid)
		{

				$this->loadModel('MediaRating');
				$current_user_id = $this->Session->read('Auth.WebsitesUser.user_id');

				 $rate = floatval($_POST['rate']);
				
				 $mediarating_id = intval($_POST['idBox']);
				

				  $arrCountTocheckExistence = $this->MediaRating->find('count',array('conditions'=>array('usermedia_id'=>$usermediaid,'user_id'=>$current_user_id)));
				 
				
				if($arrCountTocheckExistence>0)
				{
						$boolMRsaved = $this->MediaRating->updateAll(array('media_rating' =>$rate),array('usermedia_id' => $usermediaid,'user_id'=>$current_user_id));	

						
						if($boolMRsaved)
						{
							$RespnewArray['status'] = "success";
							$RespnewArray['message'] = "Your vote updated successfully";
						
						}
						else
						{
							$RespnewArray['status'] = "error";
							$RespnewArray['message'] = "Media rating error occurred";
						
						}
				}
				else
				{
						$this->request->data['MediaRating']['user_id'] = $current_user_id;
						$this->request->data['MediaRating']['usermedia_id'] = $usermediaid;	
						$this->request->data['MediaRating']['media_rating'] = $rate;	
						$this->request->data['MediaRating']['created'] = date('Y-m-d H:i:s');	 
						$boolMRprocessSaved = $this->MediaRating->save($this->request->data);
					if($boolMRprocessSaved)
					{
						$RespnewArray['status'] = "success";
						$RespnewArray['message'] = "Your vote saved Successfully";
						//$this->Session->setFlash($RespnewArray['message'],'default',array('class' => 'alert alert-success'));	
					}
					else
					{
						$RespnewArray['status'] = "fail";
						$RespnewArray['message'] = "Error Please try again.";
						$this->Session->setFlash($RespnewArray['message'],'default',array('class' => 'alert alert-success'));
					}

				}

					$RespnewArray = json_encode($RespnewArray);
					echo $RespnewArray;
					exit;
		}
	
	public function fncheckCategory()
	{
		$this->loadModel('UserCategory');
		$current_user_id = $this->Session->read('Auth.WebsitesUser.user_id');	
		
		 $arrCountTocheckExistence = $this->UserCategory->find('count',array('conditions'=>array('user_id'=>$current_user_id)));
		
			$RespnewArray['status'] = "success";
			$RespnewArray['cat'] = $arrCountTocheckExistence;
			$RespnewArray = json_encode($RespnewArray);
			echo $RespnewArray;
			exit;
	}
	
	public function fnUpdateMedianameProcess()
		{

				$this->loadModel('UserMedia');
				if($this->request->is('post'))
				{
					 $medianame = addslashes($this->request->data['medianame']);

					$medianameid = $this->request->data['medianameid'];

					$boolupdatemedia = $this->UserMedia->updateAll(array('usermedia_name' => "'$medianame'"),array('usermedia_id' => $medianameid));	
					if($boolupdatemedia)
					{
				
							$arrUserData = array();
							$arrUserData['status'] = 'success';
							$arrUserData['media_name'] = $medianame;
							$arrUserData['medianameid'] = $medianameid;
							$arrUserData  = json_encode($arrUserData);
							echo $arrUserData;
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
		
		public function fnBecomeArtistProcess()
		{
			$this->loadModel('Users');
			 $current_user_id = $this->Session->read('Auth.WebsitesUser.user_id');
		
			$boolupdateuser = $this->Users->updateAll(array('usertype_id' => "2"),array('user_id' => $current_user_id));	
			$this->Session->write('Auth.WebsitesUser.usertype_id', 2);
			if($boolupdateuser)
			{
				$RespnewArray['status'] = "success";
				$RespnewArray['message'] = "You are successfully become an artist";
				$this->Session->setFlash($RespnewArray['message'],'default',array('class' => 'alert alert-success'));
				$RespnewArray = json_encode($RespnewArray);
				echo $RespnewArray;
				exit;
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
		
public function art($usermedia_id)
 {
	   $this->loadModel('Users');
	   $this->loadModel('MediaLikes');
	   $this->loadModel('MediaRating');
	   
	   $current_user_id = $this->Session->read('Auth.WebsitesUser.user_id');
	 
	 $this->set('islogin',$current_user_id);
	 $this->set('showedit',0);

	//check looged user has liked this current media
	
	$compFileUploader = $this->Components->load('Fileupload');
	$artistmediaDetails = $compFileUploader->avgmediabyuserdetails($usermedia_id);
	$this->set('artistmediaDetails',$artistmediaDetails);
	
	$subcategoryDetails = $compFileUploader->fnToGetSubCategoryList($current_user_id);
	$this->set('sub_cat_name',$subcategoryDetails);
	//$this->set('sub_cat_name',$this->categories->fnToGetSubCategoryList($current_user_id));
		
	$arrFileDetail = $compFileUploader->uploadedrelatedmedia($usermedia_id);
	$this->set('uploadedmediadata',$arrFileDetail);
	
	
	$medialikes_id = $this->MediaLikes->field('medialikes_id', array('user_id' => $current_user_id,'usermedia_id'=>$usermedia_id));
	$mediatext = $medialikes_id>0?'Unlike':'Like';		
	$this->set('mediatext',$mediatext);	
	
	//check logged user have given how many rates to art piece
	
	if($current_user_id>0)
	{
		//check logged user have given how many rates to art piece
		$MediaRating = $this->MediaRating->find('first', array('conditions' => array('user_id' => $current_user_id,'usermedia_id'=>$artistmediaDetails[0]['UserMedia']['usermedia_id'])));
	}
	else
	{
		$MediaRating = $this->MediaRating->find('first', array('fields'=>array('avg(media_rating) as media_rating','mediarating_id'),'conditions' => array('usermedia_id'=>$artistmediaDetails[0]['UserMedia']['usermedia_id'])));
		
	}
	//$media_rating = $this->MediaRating->find(,array('user_id' => $current_user_id,'usermedia_id'=>$artistmediaDetails['UserMedia']['usermedia_id']));
	//$MediaRating = $this->MediaRating->find('first', array('conditions' => array('user_id' => $current_user_id,'usermedia_id'=>$artistmediaDetails[0]['UserMedia']['usermedia_id'])));
	

			
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
 public function getSubcategoriesList($selectedCategories){
	
			$arr_SubcategoryList = array();
			$arr_SubcategoryList = $selectedCategories;
		
			
		
			$modelSubcategory = ClassRegistry::init('Subcategory');
			$arr_subCategoriesList = $modelSubcategory->find('list',array(
																	'fields'=>array('subcategory_id',
																					'subcategory_name'),
																	'conditions'=>array('category_id'=>$arr_SubcategoryList, 'subcategory_status'=>1)
																)
													);
													
			$arr_subCategoriesList["0"] = "Please Select Subcategory";
		
			ksort($arr_subCategoriesList);
			echo json_encode($arr_subCategoriesList);
				exit;
	}

		
		
}
?>
