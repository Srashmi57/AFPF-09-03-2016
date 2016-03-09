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
class UsertypesController extends AppController {
var $name = 'Usertype';
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
	public function index()
	{
			$this->set('usertypes', $this->Usertype->find('all'));
	}
	public function add(){
	$this->loadModel('Usertype');	
		if (!empty($this->data)) {
			
			
            if ($this->Usertype->save($this->data)) {
                $this->Session->setFlash('Your user data has been saved.');
                $this->redirect(array('action' => 'index'));
            }
        }
			
	}
	
	//Update user data function (U)
	
	function edit($id = null) {
	
	$this->loadModel('Usertype');	

   
		$arrTocheckExistence = $this->Usertype->find('all',array('conditions'=>array('usertypeid'=>$id)));
		if($arrTocheckExistence)
		{
			$boolUpdateUser = $this->Usertype->updateAll(
									array('Usertype.usertypeid' => $id)
							);
		}
        
    }
	
	// Delete user data function (D)
    function delete($id)
    {
	
			$this->loadModel('Usertype');
			$boolDeletUser = $this->Usertype->deleteAll(array('Usertype.usertypeid' => $id),false);
			
			if($boolDeletUser)
			{
				$RespArray = array();
				$RespArray['status'] = "success";
				$RespArray['message'] = "Delete User Process Has Been Successful.";
			}
			else
			{  
				$RespArray = array();
				$RespArray['status'] = "fail";
				$RespArray['message'] = "Delete User Process Has Been Failed";
			}
				$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-success'));
			$this->redirect(array( 'action' => 'index'));
       
    }
	
	
	
			
			
			
			
	
	
	

}
