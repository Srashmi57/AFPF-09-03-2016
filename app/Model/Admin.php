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
class Admin extends Model {
	var $useTable = 'admin';
	var $name = 'Admin';
	
	var $validate = array(
							 'admin_email' => array(
														'alphaNumeric' => array('rule' => 'notEmpty',
														'message' => 'Email cannot be empty.')
													),
							'admin_password'=> array(
														"password" => array('rule' => 'notEmpty',
														"message"=>"Password cannot be empty")
													)
									
					);
	
	
	
	
	public function fnUpdateAdminImage($adminImage = array())
	{
		if(count($adminImage)>0)
		{
			 $strQuery = "Update appap14_admin SET	admin_image = '".$adminImage['userimage']."' where admin_id='".$adminImage['admin_id']."'";
			
			
			
			$admin_id = $this->query($strQuery);
			return $admin_id;
		}
	}

}
