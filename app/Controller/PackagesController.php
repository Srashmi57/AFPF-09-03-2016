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
class PackagesController extends AppController {
var $name = 'Package';
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
		
		$this->set('page_title','Packages');
			//$this->set('packages', $this->Package->find('all'));
		 $condition = '';
			if($this->request->is('post'))
			{
				$searchtext = addslashes(trim($_POST['txtsearch']));
				$condition = 'package.package_name  Like "%'.$searchtext.'%" Or package.package_price Like "%'.$searchtext.'%"';
			}
			
			$this->paginate = array('order' => array('package.package_id' => 'desc'),'conditions' => $condition,'limit' => 10);
			$this->set('packages', $this->paginate());
	}

	

	
	
	
	public function fnAddPackage(){
			
		$this->layout = NULL;
		$this->autoRender = NULL;

		
			if($this->request->is('post'))
			{
				$this->loadModel('Package');	
				
				 $this->request->data['Package']['package_name'] = addslashes(trim($_POST['package_name']));
				$this->request->data['Package']['package_price'] = addslashes(trim($_POST['package_price']));
			
		
				$boolProcpayprocessSaved = $this->Package->save($this->request->data);
				if($boolProcpayprocessSaved)
				{
					$RespArray = array();
					$RespArray['status'] = "success";
					$RespArray['message'] = "New Package Has Been Added Successfully";
				}
				else
				{  
					$RespArray = array();
					$RespArray['status'] = "fail";
					$RespArray['message'] = "Add Package Process Has Been Failed";
				}
					$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-success'));
					echo json_encode($RespArray);
					exit;
			}
		
		
	}
	
	
		public function fnUpdatePackageProcess(){
	
		$this->layout = NULL;
		$this->autoRender = NULL;
		
		if($this->request->is('post'))
		{
			
			
			$this->loadModel('Package');
			$intGetPackageId = addslashes(trim($this->request->data['update_packageid']));
			$strGetPackageName = addslashes(trim($this->request->data['update_pack_name'])); // To check existence
			$intGetPackagePrice = addslashes(trim($this->request->data['update_pack_price']));
			
			
			
				$boolUpdateSubAdmin = $this->Package->updateAll(array(
										'Package.package_name' => "'".$strGetPackageName."'",
										'Package.package_price' => "'".$intGetPackagePrice."'"
									
									),
								array('Package.package_id' => $intGetPackageId)
						);
			
				if($boolUpdateSubAdmin)
				{
					$RespArray = array();
					$RespArray['status'] = "success";
					$RespArray['message'] = "Package Has Been Updated Successfully";
				}
				else
				{  
					$RespArray = array();
					$RespArray['status'] = "fail";
					$RespArray['message'] = "Package Update Process Has Been Failed";
				}
					$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-success'));
					echo json_encode($RespArray);
					exit;
			
		}
	}
	
	public function UpdatePackageData()
	{
	
			$this->loadModel('Package');
			
			  $package_id = $_POST["package_id"];
			
			
				$arr_PackData = $this->Package->find('all',array('conditions'=>array(
													'package_id'=>$package_id)));
													
			
				$arrPackData = array();
				$arrPackData['status'] = 'success';
				$arrPackData['package_id'] = $arr_PackData[0]['Package']['package_id'];
				$arrPackData['package_name'] = $arr_PackData[0]['Package']['package_name'];
				$arrPackData['package_price'] = $arr_PackData[0]['Package']['package_price'];
				
			
			$arrPackData  = json_encode($arrPackData);
			echo $arrPackData;
			exit();
			
		
	}
	
	public function UpdateStatus()
	{
		$this->loadModel('Package');
		$id = $_POST["id"];
		$status = $_POST["status"];
		
			$boolCatprocessSaved= $this->Package->updateAll(
   			 array('package_status' => "'$status'"),
   			 array('packageid' => $id)
	
			);	
			
			
			if($boolCatprocessSaved)
			{
				$RespArray = array();
				$RespArray['status'] = "success";
				$RespArray['message'] = "Package Status has Been Updated Successful.";
			}
			else
			{  
				$RespArray = array();
				$RespArray['status'] = "fail";
				$RespArray['message'] = "Package Status Update Process Has Been Failed";
			}
				
				$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-success'));
				echo json_encode($RespArray);
					exit;
			
	}			
	
	

}
