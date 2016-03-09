<?php
	
class SocialController extends AppController 
{
	var $helpers = array ('Html','Form');
	var $name = 'Social';
	
	//var $layout = NULL;
	
	public function beforeFilter()
	{
		//$this->Auth->autoRedirect = false;
		parent::beforeFilter();
		$this->Auth->allow('index','social');
	}
	
	public function social($strPlugin = "", $strSocialMedia = "",$usertype_id)
	{
	
		$this->layout = NULL;
		
		if($strPlugin && $strSocialMedia)
		{
			if($strPlugin == "register")
			{
				switch($strSocialMedia)
				{
					case "facebook": $this->SocialRegister = $this->Components->load('FbRegister'); 
									 $this->SocialRegister->fnGetFbUserDetails($usertype_id);
									 break;
									 
					case "gmail":   								
					                 $this->SocialRegister = $this->Components->load('FbRegister'); 
									 $this->SocialRegister->fnGetGmailUserDetails($usertype_id);
									 break;
									 
					case "linkedin":  $this->SocialRegister = $this->Components->load('FbRegister'); 
									 $this->SocialRegister->fnGetLinkedInUserDetails($usertype_id);
									 break;
				}				
			}
			
			if($strPlugin == "login")
			{
				switch($strSocialMedia)
				{
					case "facebook": $this->SocialRegister = $this->Components->load('FbRegister'); 
									 $this->SocialRegister->fnGetFbUserDetails($intPortalId,"1");
									 break;
					/*case "twitter":  $this->SocialRegister = $this->Components->load('FbRegister'); 
									 $this->SocialRegister->fnGetTwitterUserDetails($intPortalId,"1");
									 break;*/
				}				
			}
			
			if($strPlugin == "resetregister")
			{
				switch($strSocialMedia)
				{
					case "facebook": $this->Session->delete('SOCIALREGISTRATIONDETAILS');
									 $this->Session->delete('fb_'.Configure::read('Social.FbApkey').'_code');
									 $this->Session->delete('fb_'.Configure::read('Social.FbApkey').'_access_token');
									 $this->Session->delete('fb_'.Configure::read('Social.FbApkey').'_user_id');
									 $this->redirect(array('controller'=>'websites','action'=>'index'));
									 break;
				}
			}
		}
	}

	
    public function share($strSocialMedia = "")
	{
	
			switch($strSocialMedia)
				{
					case "facebook": $this->SocialRegister = $this->Components->load('FbRegister'); 
									 $this->SocialRegister->fnShareUserdataOnFacebook();
									 break;
									 
					case "gmail":   								
					                 $this->SocialRegister = $this->Components->load('FbRegister'); 
									 $this->SocialRegister->fnShareUserdataOnGplus();
									 break;
									 
					case "linkedin":  $this->SocialRegister = $this->Components->load('FbRegister'); 
									 $this->SocialRegister->fnShareUserdataOnLinkedIn();
									 break;
				}				
	}	
}
?>