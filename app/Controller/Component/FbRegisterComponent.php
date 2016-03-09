<?php
App::uses('Component', 'Controller');
App::import('Model', 'Users');
class FbRegisterComponent extends Component 
{
    public $components = array('Session','Auth');
	
	public function startup(Controller $controller) {
		$this->Controller = $controller;
	}
	
	
	public function fnShareUserdataOnFacebook()
	{
	
		App::import('Vendor', 'social/fb/src/facebook');
		$facebook = new Facebook(array(
		  'appId'  => Configure::read('Social.FbApkey'),
		  'secret' => Configure::read('Social.FbSecretkey'),
		));
		
		 $user = $facebook->getUser();
		
		if($user) 
		{
		  try 
		  {
		 
			// Proceed knowing you have a logged in user who's authenticated.
			$user_profile = $facebook->api('/me');
			
		

			$ret = $facebook->api("/me/feed", "post", array('message'=>'This is a test 
message', 'caption'=>'test message'));
		
		?>
		<script type="text/javascript">
					window.close();
					window.reload();
			</script>
		<?php	
		  } 
		  catch (FacebookApiException $e) 
		  {
			$user = null;
		  }
		}
		else 
		{
		  $strRedirctUri = "http://".$_SERVER['HTTP_HOST'].$this->Controller->params->here;
		  $loginUrl = $facebook->getLoginUrl( array('redirect_uri'=>$strRedirctUri));
		 
		  $this->Controller->redirect($loginUrl);
		}
	}
	
	public function fnGetFbUserDetails($usertype_id,$boolForLogin="")
	{
	
		App::import('Vendor', 'social/fb/src/facebook');
		$facebook = new Facebook(array(
		  'appId'  => Configure::read('Social.FbApkey'),
		  'secret' => Configure::read('Social.FbSecretkey'),
		));
		
		$user = $facebook->getUser();
		if($user) 
		{
		  try 
		  {
			// Proceed knowing you have a logged in user who's authenticated.
			
			$user_profile = $facebook->api('/me');
			
		  } 
		  catch (FacebookApiException $e) 
		  {
			$user = null;
		  }
		}
		
		if($user) 
		{
			
			$boolSocialSessionExists = $this->Session->check('SOCIALREGISTRATIONDETAILS');
			if($boolSocialSessionExists)
			{
				$arrExistSocialSession = $this->Session->read('SOCIALREGISTRATIONDETAILS');
				
				if(isset($arrExistSocialSession['SOCIALUSERTYPE']))
				{
					if($arrExistSocialSession['SOCIALUSERTYPE'] == "twitter")
					{
						// run the facebook logout url in background
						$this->Session->delete('twitter');
						
					}
					if($arrExistSocialSession['SOCIALUSERTYPE'] == "linkedin")
					{
						// run the facebook logout url in background
						$this->Session->delete('linkedin');
						
					}
					$this->Session->delete('SOCIALREGISTRATIONDETAILS');
				}
			}
		
		    $password = time().'_'.rand();
			$password = substr($password,0,8);
				
			$arrUserArray['SOCIALUSERID'] = $user_profile['id'];
			$arrUserArray['user_fname'] = $user_profile['first_name'];
			$arrUserArray['user_lname'] = $user_profile['last_name'];
			$arrUserArray['user_password'] = AuthComponent::password(addslashes(trim($password)));
			$arrUserArray['user_orgpassword'] = $password;
			$arrUserArray['user_fullname'] = $user_profile['name'];
			$arrUserArray['user_emailid'] = $user_profile['email'];
			$arrUserArray['user_sex'] = $user_profile['gender'];
			$arrUserArray['SOCIALUSERVERIFIED'] = $user_profile['verified'];
			$arrUserArray['usertype_id']= $usertype_id ;
			$arrUserArray['user_biography'] = "";
			$arrUserArray['SOCIALUSERTYPE'] = "facebook";
			$arrUserArray['user_orgpassword'] = $password;
			$modelUser = ClassRegistry::init('Users');
			
			$user_social_Id = $user_profile['id'];
			$retuser_id = $modelUser->field('user_id', array('user_emailid' => $arrUserArray['user_emailid']));
			if($retuser_id > 0)
			{
				$userarray = $modelUser->find('all', array('conditions' => array('user_id' => $retuser_id), 'fields' => array('user_id','user_orgpassword')));
				
				$arrUserArray['user_id']	= $userarray[0]['Users']['user_id'];
				$arrUserArray['user_orgpassword']	= $userarray[0]['Users']['user_orgpassword'];
				
			}
			else
			{
				$arrayid = $modelUser->savesocialdata($arrUserArray);
				$userid = $arrayid[0][0]['id'];
				$arrUserArray['user_id']= $userid;
				$imgname = 'user_image_'.$userid.'.jpg';
				$img = file_get_contents('https://graph.facebook.com/'.$user_profile['id'].'/picture?type=large',true);
				$file = WWW_ROOT.'assets/websiteuser/user_image_'.$userid.'.jpg';
				file_put_contents($file, $img);
				$boolupdatepass = $modelUser->updateAll(array('user_image' => "'$imgname'",'user_cropped_image' =>"'$imgname'"),array('user_id' => $userid));	
	       	 }
			if($boolForLogin)
			{
				$strLogoutUrl = Router::url(array('controller' => 'websites', 'action' => 'index'),true);
			}
			else
			{
				$strLogoutUrl = Router::url(array('controller' => 'social', 'action' => 'social','resetregister','facebook'),true);
			}
			$params = array('next'=>$strLogoutUrl);
			$logoutUrl = $facebook->getLogoutUrl($params);
			$arrUserArray['logout_url'] = $logoutUrl;
			 //print("<pre>");
			//print_r($arrUserArray);
			//exit;
			$loginurl = Router::url(array('controller' => 'websites', 'action' => 'login'),true);
			
			$this->Session->write('SOCIALREGISTRATIONDETAILS',$arrUserArray);
			?>
				<script type="text/javascript">
				
					window.close();
					window.opener.document.location.href = "<?php echo $loginurl;?>";
				</script>
			<?php
		} 
		else 
		{
		  $strRedirctUri = "http://".$_SERVER['HTTP_HOST'].$this->Controller->params->here;
		  $loginUrl = $facebook->getLoginUrl(array('scope' => 'email','redirect_uri'=>$strRedirctUri));
		 
		  $this->Controller->redirect($loginUrl);
		}
	}
	
	public function fnGetLinkedInUserDetails($usertype_id )
	{
	   //ini_set("session.cookie_domain", ".artformplatform.com");
		App::import('Vendor', 'social/linkedin/linkedin');
		$API_CONFIG = array(
			'appKey'       => Configure::read('Social.LinkedInApkey'),
			  'appSecret'    => Configure::read('Social.LinkedInSecretkey'),
			  'callbackUrl'  => NULL 
		);
		
		/* print("<pre>");
		print_r($_SESSION); */
		
		if(isset($_SESSION['linkedin']['authorized']))
		{
			//echo "My";exit;
			// user details here
			if($_SESSION['linkedin']['authorized'] === TRUE) 
			{
			
				$OBJ_linkedin = new LinkedIn($API_CONFIG);
				$OBJ_linkedin->setTokenAccess($_SESSION['linkedin']['access']);
				$OBJ_linkedin->setResponseFormat('JSON');
				$response = $OBJ_linkedin->profile('~:(id,first-name,last-name,picture-url,email-address,phone-numbers,location,summary,formatted-name)');
				
				if($response['success'] === TRUE) 
				{
				  //$response['linkedin'] = new SimpleXMLElement($response['linkedin']);
				  $response['linkedin'] = json_decode($response['linkedin']);
				    
				  $boolSocialSessionExists = $this->Session->check('SOCIALREGISTRATIONDETAILS');
				  if($boolSocialSessionExists)
				  {
					$arrExistSocialSession = $this->Session->read('SOCIALREGISTRATIONDETAILS');
					if(isset($arrExistSocialSession['SOCIALUSERTYPE']))
					{
						if($arrExistSocialSession['SOCIALUSERTYPE'] == "twitter")
						{
							// run the facebook logout url in background
							$this->Session->delete('twitter');
							
						}
						
						if($arrExistSocialSession['SOCIALUSERTYPE'] == "facebook")
						{
							// run the facebook logout url in background
							$this->Session->delete('fb_'.Configure::read('Social.FbApkey').'_access_token');
							$this->Session->delete('fb_'.Configure::read('Social.FbApkey').'_code');
							$this->Session->delete('fb_'.Configure::read('Social.FbApkey').'_user_id');
						}
						
						$this->Session->delete('SOCIALREGISTRATIONDETAILS');
					}
				  }
				   $password = time().'_'.rand();
				   $password = substr($password,0,8);
				
				   $modelUser = ClassRegistry::init('Users');
				   $checkemail = $response['linkedin']->emailAddress;
				   $retuser_id = $modelUser->field('user_id', array('user_emailid' => $checkemail));
				   $fname = $response['linkedin']->firstName;
				   $lname = $response['linkedin']->lastName;
				    $linksocialid = $response['linkedin']->id;
					$arrUserArray['SOCIALUSERID'] = $response['linkedin']->id;
					$arrUserArray['user_fname'] = $response['linkedin']->firstName;
					$arrUserArray['user_lname'] = $response['linkedin']->lastName;
					$arrUserArray['user_fullname'] = $response['linkedin']->formattedName;
					$arrUserArray['SOCIALUSERNAME'] = "";
					 $arrUserArray['user_emailid'] = $response['linkedin']->emailAddress;
					$arrUserArray['user_password'] = AuthComponent::password(addslashes(trim($password)));
					$arrUserArray['user_orgpassword'] = $password;
					if(isset($response['linkedin']->summary))
					{
						$arrUserArray['user_biography'] = $response['linkedin']->summary;
					}
					else
					{
						$arrUserArray['user_biography'] = "";
					}
					$arrUserArray['user_sex'] = "";
					$arrUserArray['SOCIALUSERLOCATION'] = $response['linkedin']->location->name;
					$arrUserArray['SOCIALUSERVERIFIED'] = "1";
					$arrUserArray['logout_url'] = Router::url(array('controller' => 'websites', 'action' => 'reset'),true);
					$arrUserArray['SOCIALUSERTYPE'] = "linkedin";
					$arrUserArray['usertype_id']= $usertype_id ;
					
					
				 if( $retuser_id>0)
				 {
			
					$userarray = $modelUser->find('all', array('conditions' => array('user_id' => $retuser_id), 'fields' => array('user_id','user_orgpassword')));
					$arrUserArray['user_id']	= $userarray[0]['Users']['user_id'];
			     	$arrUserArray['user_orgpassword']	= $userarray[0]['Users']['user_orgpassword'];
					
				}
				else
				{
					$arrayid = $modelUser->savesocialdata($arrUserArray);
					$userid = $arrayid[0][0]['id'];
					$arrUserArray['user_id']= $userid;
					$imgname = 'user_image_'.$userid.'.jpg';
					
					//$img = file_get_contents('https://graph.facebook.com/'.$user_profile['id'].'/picture?type=large',true);
						//$file = WWW_ROOT.'assets/user/user_image_'.$userid.'.jpg';
						//file_put_contents($file, $img);
						//$boolupdatepass = $modelUser->updateAll(array('user_image' => "'$imgname'"),array('user_id' => $userid));	
	       	
				}
			
		
					$this->Session->write('SOCIALREGISTRATIONDETAILS',$arrUserArray);
					$loginurl = Router::url(array('controller' => 'websites', 'action' => 'login'),true);
					?>
						<script type="text/javascript">
							//window.close();
							window.location.href = "<?php echo $loginurl;?>";
						</script>
					<?php
				  
				}
				else
				{
					unset($_SESSION['linkedin']);
					?>
						<script type="text/javascript">
							window.close();
							window.opener.location.reload();
						</script>
					<?php
				}
			}
			else
			{
				unset($_SESSION['linkedin']);
				?>
					<script type="text/javascript">
						window.close();
						window.opener.location.reload();
					</script>
				<?php
			}
		}
		else
		{
			// request token and access token
			$API_CONFIG['callbackUrl'] = "http://".$_SERVER['HTTP_HOST'].$this->Controller->params->here;
			$OBJ_linkedin = new LinkedIn($API_CONFIG);
			
			if(isset($_SESSION['linkedin']['request']))
			{
				
				//echo "----".$_REQUEST['oauth_verifier'];exit;
				$response = $OBJ_linkedin->retrieveTokenAccess($_SESSION['linkedin']['request']['oauth_token'], $_SESSION['linkedin']['request']['oauth_token_secret'], $_GET['oauth_verifier']);
				
				if($response['success'] === TRUE) 
				{
					
					$_SESSION['linkedin']['access'] = $response['linkedin'];
					$_SESSION['linkedin']['authorized'] = TRUE;
					$strRedirctUri = "http://".$_SERVER['HTTP_HOST'].$this->Controller->params->here;
					
					?>
						<script type="text/javascript">
							
							window.location.href = "<?php echo $strRedirctUri;?>";
							
						</script>
					<?php
					//$this->Controller->redirect($strRedirctUri);
				}
				else
				{
					unset($_SESSION['linkedin']);
					?>
						<script type="text/javascript">
							window.close();
							window.opener.location.reload();
						</script>
					<?php
				}
			}
			else
			{
				
				$response = $OBJ_linkedin->retrieveTokenRequest();
				if($response['success'] === TRUE)
				{
					$_SESSION['linkedin']['request'] = $response['linkedin'];
					 $url = LINKEDIN::_URL_AUTH . $response['linkedin']['oauth_token'];
					?>
						<script type="text/javascript">
							window.close();
							window.opener.document.location.href = "<?php echo $url;?>";
						</script>
					<?php
					//$this->Controller->redirect($url);
				}
				else
				{
					unset($_SESSION['linkedin']);
					?>
						<script type="text/javascript">
							window.close();
							window.opener.location.reload();
						</script>
					<?php
				}
			}
		}
		
		
	}
	
	
	
	public function fnGetGmailUserDetails($usertype_id)
	{
	   App::import('Vendor', 'social/gplus/src/Google_Client');
	   App::import('Vendor', 'social/gplus/src/contrib/Google_Oauth2Service');
	   
	   
		
		if($usertype_id==2)
		{
			 //$google_client_id 		= '659221128839-cokkrd1aul2l46af214r1absko752bvj.apps.googleusercontent.com';
			 //$google_client_secret 	= 'OMqJGmLzXydYu8ydxR90qLTJ';
			 $google_client_id 		= '561877826067-rm754fsdsfocvdptjlfm6tcuibo4lpni.apps.googleusercontent.com';
			 $google_client_secret 	= 'Psp9_vcObJsmpn4Vj6x2dKBw';
		}
		else
		{
			 //$google_client_id 		= '659221128839-e1eeq134tj9551oovpiqsf4ebbsuhmaf.apps.googleusercontent.com';
			 //$google_client_secret 	= '1wySlHff4pi88Zk2d6cG3FxO';
			 $google_client_id 		= '561877826067-s5tmdu8g71sos9pbrov82a30ugl5c041.apps.googleusercontent.com';
			 $google_client_secret 	= 'Nhf-_Uky57w1ManD85M1X6Ie';
		}
		$google_redirect_url 	= 'http://www.artformplatform.com/social/social/register/gmail/'.$usertype_id; //path to your script
		//$google_developer_key 	= 'AIzaSyAu-MRbSR9tccEVTU5dMdhgKDCv3HpegKw';
		$google_developer_key 	= 'AIzaSyDmW9grABPtBOeBoYI8dq_6KILCyLX36lc';


		$gClient = new Google_Client();
		$gClient->setApplicationName('Login to ArtForm PlatForm');
		$gClient->setClientId($google_client_id);
		$gClient->setClientSecret($google_client_secret);
		$gClient->setRedirectUri($google_redirect_url);
		$gClient->setDeveloperKey($google_developer_key);
		
		
       $google_oauthV2 = new Google_Oauth2Service($gClient);

//If user wish to log out, we just unset Session variable
	if (isset($_REQUEST['reset'])) 
	{
	  unset($_SESSION['token']);
	  $gClient->revokeToken();
	  header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL)); //redirect user back to page
	}

//If code is empty, redirect user to google authentication page for code.
//Code is required to aquire Access Token from google
//Once we have access token, assign token to session variable
//and we can redirect user back to page and login.
	if (isset($_GET['code'])) 
	{ 
	
		$gClient->authenticate($_GET['code']);
	    $_SESSION['token'] = $gClient->getAccessToken();
		 
			$loginurl = Router::url(array('controller' => 'websites', 'action' => 'login'),true);
			
		header('Location: ' .filter_var($google_redirect_url, FILTER_SANITIZE_URL));
		
		?>
		<script type="text/javascript">
							window.close();
							window.opener.document.location.href = "<?php echo $loginurl;?>";
						</script>
						<?php
	}	


	if (isset($_SESSION['token'])) 
	{ 
		$gClient->setAccessToken($_SESSION['token']);
	}

	if ($this->Session->read('token'))
	{
			$gClient->setAccessToken($this->Session->read('token'));
	}
	if ($gClient->getAccessToken()) 
	{
		  //For logged in user, get details from google using access token
		   $user 				= $google_oauthV2->userinfo->get();
		  
		  $user_id 				= $user['id'];
		  $user_name 			= filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
		  $email 				= filter_var($user['email'], FILTER_SANITIZE_EMAIL);
		  $firstName 			= filter_var($user['given_name'], FILTER_SANITIZE_SPECIAL_CHARS);
		  $lastName 			= filter_var($user['family_name'], FILTER_SANITIZE_SPECIAL_CHARS);
		    
		 $profile_image_url 	= filter_var($user['picture'], FILTER_VALIDATE_URL);
		 $personMarkup 		= "$email<div><img src='$profile_image_url?sz=50'></div>";
		 
			$this->Session->write('token', $gClient->getAccessToken());
				
				 $password = time().'_'.rand();
				 $password = substr($password,0,8);
				
					$arrUserArray['SOCIALUSERID'] = $user_id;
					$arrUserArray['user_fname'] = $firstName;
					$arrUserArray['user_lname'] = $lastName;
					$arrUserArray['user_fullname'] = $user_name;
					$arrUserArray['user_password'] = AuthComponent::password(addslashes(trim($password)));
					$arrUserArray['user_emailid'] = $email;
					$arrUserArray['user_sex'] = "";
					$arrUserArray['SOCIALUSERVERIFIED'] = "1";
					$arrUserArray['logout_url'] = Router::url(array('controller' => 'websites', 'action' => 'reset'),true);
					$arrUserArray['SOCIALUSERTYPE'] = "gmail";
					$arrUserArray['usertype_id']= $usertype_id ;
					$arrUserArray['user_biography'] = "";
					$arrUserArray['user_verified'] = 1;
					$arrUserArray['user_orgpassword'] = $password;
					$modelUser = ClassRegistry::init('Users');
					 $checkemail = $email;
				   $retuser_id = $modelUser->field('user_id', array('user_emailid' => $checkemail));
				   if($retuser_id>0)
				    {
					$arrUserArray['user_id']= $retuser_id;
				
					$userarray = $modelUser->find('all', array('conditions' => array('user_id' => $retuser_id), 'fields' => array('user_id','user_orgpassword')));
					$arrUserArray['user_id']	= $userarray[0]['Users']['user_id'];
			     	$arrUserArray['user_orgpassword']	= $userarray[0]['Users']['user_orgpassword'];
				
					
						
					}
					else
					{
				     	$arrayid = $modelUser->savesocialdata($arrUserArray);
					    $userid = $arrayid[0][0]['id'];
					    $arrUserArray['user_id']= $userid;
						
						$imgname = 'user_image_'.$userid.'.jpg';
						 $img = file_get_contents($profile_image_url,true);
						
						$file = WWW_ROOT.'assets/websiteuser/user_image_'.$userid.'.jpg';
						file_put_contents($file, $img);
						$boolupdatepass = $modelUser->updateAll(array('user_image' => "'$imgname'",'user_cropped_image' => "'$imgname'"),array('user_id' => $userid));	
					}
		
		
					 $this->Session->write('SOCIALREGISTRATIONDETAILS',$arrUserArray);
					 $loginurl = Router::url(array('controller' => 'websites', 'action' => 'login'),true);
					
					?>
							
						<script type="text/javascript">
						   window.opener.location.href = "<?php echo $loginurl;?>";
							window.close();
							//window.opener.document.location.href = "<?php echo $loginurl;?>";
						</script>
						<?php
	}
		else
		{
			
		//For Guest user, get google login url
			 $authUrl = $gClient->createAuthUrl();
		return $this->Controller->redirect($authUrl);
			?>
						
					<?php
	 
			
				
		}
	
	
	
	}

    
	
}
?>