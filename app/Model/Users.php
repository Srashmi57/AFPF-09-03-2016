<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class Users extends Model {

	var $useTable = 'users';
	var $name = 'Users';
	
		
	var $validate = array(
							 'user_name' => array(
														'alphaNumeric' => array('rule' => 'notEmpty',
														'message' => 'Email cannot be empty.')
													),
							'user_password'=> array(
														"password" => array('rule' => 'notEmpty',
														"message"=>"Password cannot be empty")
													)
									
					);
	

	public function fnUpdateUserImage($userImage = array())
	{
		if(count($userImage)>0)
		{
			  $strQuery = "Update appap14_users SET	user_image = '".$userImage['profile_pic']."' where userid='".$userImage['userid']."'";
		
			
			$userid = $this->query($strQuery);
			return $userid;
		}
	}
	
	public function updateMessage($userdata = array())
	{
		if(count($userdata)>0)
		{
			   $strQuery = "Update appap14_users SET user_moodmsg = '".addslashes($userdata['value'])."' where user_id='".$userdata['user_id']."'";
			
			
			$userid = $this->query($strQuery);
			return $userid;
		}
	}
	
	function getActivationHash($user_id)
    {
		$sql="select created from appap14_users where user_id=".$user_id;	
		$data = $this->query($sql);
		$created	= $data[0]['appap14_users']['created'];
		return  substr(Security::hash(Configure::read('Security.salt').$created.$user_id), 0, 8);

    }
	 
	function savesocialdata($userdata = array()) 
	{
		   $SOCIALUSERFNAME = addslashes($userdata['user_fname']);
			$SOCIALUSERLNAME = addslashes($userdata['user_lname']);
			$SOCIALpassword = $userdata['user_password'];
			$SOCIALorgpassword = $userdata['user_orgpassword'];
			$SOCIALUSEREMAIL = addslashes($userdata['user_emailid']);
			$SOCIALUSERGENDER = addslashes($userdata['user_sex']);
			$user_social_Id = addslashes($userdata['SOCIALUSERID']);
			$user_social_type = addslashes($userdata['SOCIALUSERTYPE']);
			$user_biography = addslashes($userdata['user_biography']);
			$usertype_id = addslashes($userdata['usertype_id']);
			$strQuery = "Insert into  appap14_users (user_fname,user_lname,user_password,user_orgpassword, user_emailid,user_sex,user_social_Id,usertype_id,user_biography,user_social_type,user_verified) values('$SOCIALUSERFNAME','$SOCIALUSERLNAME','$SOCIALpassword','$SOCIALorgpassword','$SOCIALUSEREMAIL','$SOCIALUSERGENDER','$user_social_Id','$usertype_id','$user_biography','$user_social_type',1)";
			 $this->query($strQuery);
			$arrayid = $this->query('select last_insert_id() as id;');
			return $arrayid;
	}
	
	
	 public function saveusercategory($catdata = array())
   {
       $strQuery = "insert into  appap14_usercategory (user_id,category_id) values( '".$catdata['user_id']."','".$catdata['category_id']."')";
	 
	   $usercategory_id = $this->query($strQuery);
	   return $usercategory_id;
	
   }
   
    public function checkusercategorycount($userid)
   {
       $strQuery = "select count(*) as catcount from  appap14_usercategory where user_id=".$userid;
	 
	   $countusercats = $this->query($strQuery);
	   
	   if($countusercats[0]['0']['catcount']>0)
		{
		 return  $countusercats[0]['0']['catcount'];
		}
		else
		{
			 return 0;
		}
	   
	
   }

	


}