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
class CategoriesController extends AppController {
var $name = 'category';
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
		
		
		 $condition = '';
		 $this->loadModel('Category');
		 $this->set('page_title','Category');
			if($this->request->is('post'))
			{
				$searchtext = addslashes(trim($_POST['txtsearch']));
				$condition = 'Category.category_name  Like "%'.$searchtext.'%"';
				
			}
			$this->paginate = array('order' => array('Category.category_id' => 'desc'),'conditions' => $condition,'limit' => 10);
				
			$this->set('category', $this->paginate());
			
	}

	
	public function fnAddCategory(){
			
		$this->layout = NULL;
		$this->autoRender = NULL;

		
			if($this->request->is('post'))
			{
				$this->loadModel('Category');	
				
				$this->request->data['Category']['category_name'] = addslashes(trim($_POST['category']));
			
			
				$boolCatprocessSaved = $this->Category->save($this->request->data);
				  $getInsertid_categoryID = $this->Category->getLastInsertID();
				
				
				if($boolCatprocessSaved)
				{
					if(is_array($_FILES) && (count($_FILES)>0))
					{
						if($_FILES['catimage']['name'] != "")
						{
							$this->loadModel('Category');
							
								$strCatimageName = $_FILES['catimage']['name'];
								$randnumber = rand();
								 $strFileExt = pathinfo($strCatimageName);
								 $imageName = 'Category_image_'.$randnumber.'.'.$strFileExt['extension'];
								
								$strCatimageTmpName = $_FILES['catimage']['tmp_name'];
								
								move_uploaded_file($strCatimageTmpName,WWW_ROOT . 'assets/category/'.$imageName);
								
								$boolCatImageSaved = $this->Category->updateAll(array('category_image' => "'$imageName'"),array('category_id' => $getInsertid_categoryID));	
						}
						
					}
					
		
				}
				
			if($boolCatprocessSaved)
			{
				$RespArray = array();
				$RespArray['status'] = "success";
				$RespArray['message'] = "New Category Has Been Added Successfully";
			}
			else
			{  
				$RespArray = array();
				$RespArray['status'] = "fail";
				$RespArray['message'] = "Category Add Process Has Been Failed";
			}
				$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-success'));
				echo json_encode($RespArray);
					exit;
			
			}
			
			
		
		
	}
	
	
	public function fnCategoryUpdateProcess(){
	
		if($this->request->is('post'))
		{
					
			$this->loadModel('Category');
			$intGetCategoryid = addslashes(trim($this->request->data['update_categoryid']));
			$strGetCategoryName = addslashes(trim($this->request->data['update_category'])); // To check existence

			$boolUpdateCat = $this->Category->updateAll(array(
										'Category.category_name' => "'".$strGetCategoryName."'"									
									),
								array('Category.category_id' => $intGetCategoryid)
						);
						
					  $oldcatimagename = $this->Category->field('category_image', array('category_id' => $intGetCategoryid));
							
			if($boolUpdateCat)
				{
					if(is_array($_FILES) && (count($_FILES)>0))
					{
						if($_FILES['catimage']['name'] != "")
						{
							$this->loadModel('Category');
							 $intFilesCount = count($_FILES['catimage']['name']);
							
							if($oldcatimagename!="")
							{
								 $imapath = WWW_ROOT."assets/category/".$oldcatimagename;
									unlink($imapath);
							}
								 $strCatimageName = $_FILES['catimage']['name'];
								$randnumber = rand();
								 $strFileExt = pathinfo($strCatimageName);
								 $imageName = 'Category_image_'.$randnumber.'.'.$strFileExt['extension'];
								
								$strCatimageTmpName = $_FILES['catimage']['tmp_name'];
								
								move_uploaded_file($strCatimageTmpName,WWW_ROOT . 'assets/category/'.$imageName);
								
								
								$boolCatImageSaved = $this->Category->updateAll(array('category_image' => "'$imageName'"),array('category_id' => $intGetCategoryid));	
								
							
						}
					}
				}
			
				if($boolUpdateCat)
				{
					$RespArray = array();
					$RespArray['status'] = "success";
					$RespArray['message'] = "Category Has Been Updated Successfully.";
				}
				else
				{  
					$RespArray = array();
					$RespArray['status'] = "fail";
					$RespArray['message'] = "Category Update Has Been Failed";
				}
					$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-success'));
					echo json_encode($RespArray);
					exit;
			
		}
	}
	
	public function UpdateCategoryData()
	{
	
			$this->loadModel('Category');
			
			  $category_id = $_POST["categoryid"];
			
			
				$arr_CatData = $this->Category->find('all',array('conditions'=>array(
													'category_id'=>$category_id)));
													
			
				$arrCatData = array();
				$arrCatData['status'] = 'success';
				$arrCatData['category_id'] = $arr_CatData[0]['Category']['category_id'];
				$arrCatData['category_name'] = $arr_CatData[0]['Category']['category_name'];
				$arrCatData['category_image'] = Router::url('/', true).'assets/category/'.$arr_CatData[0]['Category']['category_image'];
				
			
			$arrCatData  = json_encode($arrCatData);
			echo $arrCatData;
			exit();
			
		
	}
	
	public function fnSearchCategoryProcess()
	{
			if($this->request->is('post'))
			{
				$this->loadModel('Category');
					
				$searchtext = addslashes(trim($_POST['txtsearch']));
				$this->paginate = array(
					 'conditions' => array('category.category_name ="'.$searchtext.'"'),
				   );
				  
				$this->set('category', $this->paginate());
				$arrSearchData = array();
				$arrSearchData['status'] = 'success';
				
				$arrSearchData  = json_encode($arrSearchData);
				echo $arrSearchData;
				exit();
				
			}
		
	}
	
		
	/* Subcategory section here*/

	public function subcategories(){
		
		// Users List View
		$this->loadModel('Subcategory'); // Load model
		$this->loadModel('Category');
		 $this->set('page_title','Sub Category');
		$this->categories = $this->Components->load('category');
	
		 $this->set('arr_CategoryList',$this->categories->fnToGetAllCategoryList());
		 $condition='';
			if($this->request->is('post'))
			{
				$searchtext = addslashes(trim($_POST['txtsearch']));
				$condition = ' (Category.category_name Like "%'.$searchtext.'%" OR subcategory.subcategory_name Like "%'.$searchtext.'%")';
				
			}

				$this->paginate = array(
					 'fields' => array('Category.category_name', 'subcategory.*'),
				    'joins' => array(array('alias' => 'subcategory','table' => 'subcategory','type' => 'INNER','conditions' => '`Category`.`category_id` = `subcategory`.`category_id` ')),'conditions' =>$condition,'order' => 'subcategory.subcategory_id Desc','limit' => 10);
					
					
			 $this->set( 'subcategory', $this->paginate() ); 
		 
	}
	
	
	public function fnAddSubCategories()
	{
			
		$this->layout = NULL;
		$this->autoRender = NULL;

		
			if($this->request->is('post'))
			{
				$this->loadModel('Subcategory');	
				
				$this->request->data['Subcategory']['subcategory_name'] = addslashes(trim($_POST['subcategory']));
				$this->request->data['Subcategory']['category_id'] = $this->request->data['category_list'];
				
				$boolCatprocessSaved = $this->Subcategory->save($this->request->data);
				
			    $getInsertid_subcategoryID = $this->Subcategory->getLastInsertID();
				
				if($boolCatprocessSaved)
				{
					if(is_array($_FILES) && (count($_FILES)>0))
					{
						if($_FILES['subcatimage']['name'] != "")
						{
							$this->loadModel('Subcategory');
							 $intFilesCount = count($_FILES['subcatimage']['name']);
							
							
								 $strCatimageName = $_FILES['subcatimage']['name'];
								$randnumber = rand();
								 $strFileExt = pathinfo($strCatimageName);
								 $imageName = 'subcategory_image_'.$randnumber.'.'.$strFileExt['extension'];
								
								$strCatimageTmpName = $_FILES['subcatimage']['tmp_name'];
								
								move_uploaded_file($strCatimageTmpName,WWW_ROOT . 'assets/subcategory/'.$imageName);
								
								$this->request->data['Subcategory']['subcategory_id'] = $getInsertid_subcategoryID;
								$this->request->data['Subcategory']['subcatimage'] = $imageName;
							
								$this->Subcategory->set($this->request->data);
								$boolCatImageSaved = $this->Subcategory->fnUpdateSubCartegoryImage($this->request->data['Subcategory']);
							
						}
					}
					
		
				}
				
			if($boolCatprocessSaved)
			{
				$RespArray = array();
				$RespArray['status'] = "success";
				$RespArray['message'] = "New Sub Category Has Been Added Successfully";
			}
			else
			{  
				$RespArray = array();
				$RespArray['status'] = "fail";
				$RespArray['message'] = "Subcategory Add Process Has Been Failed";
			}
			
			
				$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-success'));
				echo json_encode($RespArray);
				exit;
			}
			
			
		
		
	}
	
	
	
	public function fnSubCategoryUpdateProcess(){

	if($this->request->is('post'))
	{
		
		$this->loadModel('Subcategory');
		$intGetSubCategoryid = addslashes(trim($this->request->data['update_subcategoryid']));
		$strGetSubCategoryName = addslashes(trim($this->request->data['update_subcategory']));
		$intGetCategoryid = addslashes(trim($this->request->data['category_list']));

					
		
		
			$boolUpdateCat = $this->Subcategory->updateAll(array(
									'Subcategory.subcategory_name' => "'".$strGetSubCategoryName."'"	,	
									'Subcategory.category_id' => "'".$intGetCategoryid."'"								
								),
							array('Subcategory.subcategory_id' => $intGetSubCategoryid)
					);
					
				  $oldsubcatimagename = $this->Subcategory->field('subcategory_image', array('subcategory_id' => $intGetSubCategoryid));
			
				
		
			if($boolUpdateCat)
			{
				if(is_array($_FILES) && (count($_FILES)>0))
				{
					if($_FILES['subcatimage']['name'] != "")
					{
						$this->loadModel('Subcategory');
						 $intFilesCount = count($_FILES['subcatimage']['name']);
						
						if($oldsubcatimagename!="")
						{
							 $imapath = WWW_ROOT."assets/subcategory/".$oldsubcatimagename;
								
						}
							 $strSubCatimageName = $_FILES['subcatimage']['name'];
							$randnumber = rand();
							 $strFileExt = pathinfo($strSubCatimageName);
							 $imageName = 'subcategory_image_'.$randnumber.'.'.$strFileExt['extension'];
							
							$strsubCatimageTmpName = $_FILES['subcatimage']['tmp_name'];
							
							move_uploaded_file($strsubCatimageTmpName,WWW_ROOT . 'assets/subcategory/'.$imageName);
							
							$this->request->data['Subcategory']['subcategory_id'] = $intGetSubCategoryid;
							$this->request->data['Subcategory']['subcatimage'] = $imageName;
						
							$this->Subcategory->set($this->request->data);
							$boolCatImageSaved = $this->Subcategory->fnUpdateSubCartegoryImage($this->request->data['Subcategory']);
						
					}
				}
			}
			
			if($boolUpdateCat)
			{
				$RespArray = array();
				$RespArray['status'] = "success";
				$RespArray['message'] = "Sub Category Has Been Updated Successfully";
			}
			else
			{  
				$RespArray = array();
				$RespArray['status'] = "fail";
				$RespArray['message'] = "SubCategory Update Process Has Been Failed";
			}
				$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-success'));
				echo json_encode($RespArray);
				exit;
		
	}
}

	
			
	public function UpdateSubCategoryData()
	{
	
			$this->loadModel('Subcategory');
			
			  $subcategory_id = $_POST["subcategoryid"];
			
			
			
				
					$arr_SubCatData = $this->Subcategory->find('all',array('joins' => array(array('table' => 'category','alias' => 'category',
            'type' => 'inner','recursive' => -1,'conditions'=> array('Subcategory.category_id = category.category_id')), 
    ), 'conditions' =>  array('Subcategory.subcategory_id' => $subcategory_id,'Subcategory.subcategory_status'=>1)));			
			/*$arr_SubCatData = $this->Subcategory->find('all',array('conditions'=>array(
													'subcategory_id'=>$subcategory_id)));*/
				$arrsubCatData = array();
				$arrsubCatData['status'] = 'success';
				$arrsubCatData['subcategory_id'] = $arr_SubCatData[0]['Subcategory']['subcategory_id'];
				$arrsubCatData['subcategory_name'] = $arr_SubCatData[0]['Subcategory']['subcategory_name'];
				$arrsubCatData['category_id'] = $arr_SubCatData[0]['Subcategory']['category_id'];
				$arrsubCatData['subcategory_image'] = Router::url('/', true).'assets/subcategory/'.$arr_SubCatData[0]['Subcategory']['subcategory_image'];
				
			
			$arrsubCatData  = json_encode($arrsubCatData);
			echo $arrsubCatData;
			exit();
			
			

		
	}		
		
	
	/* subsubcategory section here*/

	public function subsubcategories(){
		$condition='';
		
		
		// Users List View
		$this->loadModel('Subsubcategory'); // Load model
		$this->set('page_title','Sub Subcategory');
		$this->categories = $this->Components->load('category');
		$this->set('arr_CategoryList',$this->categories->fnToGetAllCategoryList());
		$this->set('arr_subCategoryList',$this->categories->fnToGetAllsubCategoryList());
		
		if($this->request->is('post'))
			{
				$searchtext = addslashes(trim($_POST['txtsearch']));
			$condition = '(Category.category_name Like "%'.$searchtext.'%" OR subcat.subcategory_name Like "%'.$searchtext.'%" OR subsubcat.subsubcategory_name Like "%'.$searchtext.'%")';
			}
			
	 
  $this->paginate = array( 
   'fields' => array('subsubcat.*', 'subcat.subcategory_name','Category.category_name'),
  'joins' => array(
        array(
            'table' => 'subsubcategory',
            'alias' => 'subsubcat',
            'type' => 'inner',
			'recursive' => -1,
            'conditions'=> array('Category.category_id = subsubcat.category_id')
        	),
        array(
            'table' => 'subcategory',
            'alias' => 'subcat',
            'type' => 'left',
			'recursive' => -1,
            'conditions'=> array(
             'subcat.subcategory_id = subsubcat.subcategory_id'
             )
        )
    ), 'order' => 'subsubcat.subsubcategory_id Desc' 
	
	,'conditions' => $condition, 'limit' => 10);

			
		
	//$arr_AllSubsubcategory = $this->Subsubcategory->fnToShowAllsubsubcategories(); // Call to function to get All SubsubcategoriesList
	
			
		
		$this->set('subsubcategory',$this->paginate());
			
		
	}
	
	
	public function fnAddSubSubCategories()
	{
		
			if($this->request->is('post'))
			{
				$this->loadModel('Subsubcategory');	
				
				$this->request->data['Subsubcategory']['subsubcategory_name'] = addslashes(trim($_POST['subsubcategory']));
				$this->request->data['Subsubcategory']['category_id'] = $this->request->data['category_list'];
				$this->request->data['Subsubcategory']['subcategory_id'] = $_POST['subcategory_id'];
				
				
				$boolCatprocessSaved = $this->Subsubcategory->save($this->request->data);
				
			    $getInsertid_subsubcategoryID = $this->Subsubcategory->getLastInsertID();
				
				 if($boolCatprocessSaved)
				{
					if(is_array($_FILES) && (count($_FILES)>0))
					{
						if($_FILES['subsubcatimage']['name'] != "")
						{
							$this->loadModel('Subsubcategory');
							 $intFilesCount = count($_FILES['subsubcatimage']['name']);
							
							
								 $strCatimageName = $_FILES['subsubcatimage']['name'];
								$randnumber = rand();
								 $strFileExt = pathinfo($strCatimageName);
								 $imageName = 'subsubcategory_image_'.$randnumber.'.'.$strFileExt['extension'];
								
								$strCatimageTmpName = $_FILES['subsubcatimage']['tmp_name'];
								
								move_uploaded_file($strCatimageTmpName,WWW_ROOT . 'assets/subsubcategory/'.$imageName);
								
								$this->request->data['Subsubcategory']['subsubcategory_id'] = $getInsertid_subsubcategoryID;
								$this->request->data['Subsubcategory']['subsubcatimage'] = $imageName;
							
								$this->Subsubcategory->set($this->request->data);
								$boolCatImageSaved = $this->Subsubcategory->fnUpdateSubSubCartegoryImage($this->request->data['Subsubcategory']);
							
						}
					}
					
		
				}
				
			if($boolCatprocessSaved)
			{
				$RespArray = array();
				$RespArray['status'] = "success";
				$RespArray['message'] = "Subsubcategory has Been Added Successfully";
			}
			else
			{  
				$RespArray = array();
				$RespArray['status'] = "fail";
				$RespArray['message'] = "Subsubcategory Add Has Been Failed";
			}
			
			
				$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-success'));
				echo json_encode($RespArray);
				exit;
			}
			
		
	}
	
	
	
	public function fnEditSubsubcategory()
	{

	if($this->request->is('post'))
	{
		
		$this->loadModel('Subsubcategory');
		$intGetSubCategoryid = addslashes(trim($this->request->data['update_subsubcategory_id']));
		$strGetSubCategoryName = addslashes(trim($this->request->data['update_subsubcategoryname']));
		$intGetCategoryid = addslashes(trim($this->request->data['category_listid']));
		$intGetsubCategoryid = addslashes(trim($this->request->data['subcategory_id']));

					
		
		
			$boolUpdateCat = $this->Subsubcategory->updateAll(array(
									'Subsubcategory.subsubcategory_name' => "'".$strGetSubCategoryName."'"	,	
									'Subsubcategory.category_id' => "'".$intGetCategoryid."'",
									'Subsubcategory.subcategory_id' => "'".$intGetsubCategoryid."'"									
								),
							array('Subsubcategory.subsubcategory_id' => $intGetSubCategoryid)
					);
					
				$oldsubcatimagename = $this->Subsubcategory->field('subsubcategory_image', array('subsubcategory_id' => $intGetSubCategoryid));
			
				
		
			if($boolUpdateCat)
			{
				if(is_array($_FILES) && (count($_FILES)>0))
				{
					if($_FILES['subsubcatimage']['name'] != "")
					{
						$this->loadModel('Subsubcategory');
						 $intFilesCount = count($_FILES['subsubcatimage']['name']);
						
						if($oldsubcatimagename!="")
						{
							 $imapath = WWW_ROOT."assets/subsubcategory/".$oldsubcatimagename;
								
						}
							 $strSubCatimageName = $_FILES['subsubcatimage']['name'];
							$randnumber = rand();
							 $strFileExt = pathinfo($strSubCatimageName);
							 $imageName = 'subsubcategory_image_'.$randnumber.'.'.$strFileExt['extension'];
							
							$strsubCatimageTmpName = $_FILES['subsubcatimage']['tmp_name'];
							
							move_uploaded_file($strsubCatimageTmpName,WWW_ROOT . 'assets/subsubcategory/'.$imageName);
							
							$this->request->data['Subsubcategory']['subsubcategory_id'] = $intGetSubCategoryid;
							$this->request->data['Subsubcategory']['subsubcatimage'] = $imageName;
						
							$this->Subsubcategory->set($this->request->data);
							$boolCatImageSaved = $this->Subsubcategory->fnUpdateSubSubCartegoryImage($this->request->data['Subsubcategory']);
						
					}
				}
			}
		
			if($boolUpdateCat)
			{
				$RespArray = array();
				$RespArray['status'] = "success";
				$RespArray['message'] = "Subsubcategory Has Been Updated Successfully";
			}
			else
			{  
				$RespArray = array();
				$RespArray['status'] = "fail";
				$RespArray['message'] = "Subsubcategory Update Has Been Failed";
			}
				$this->Session->setFlash($RespArray['message'],'default',array('class' => 'alert alert-success'));
				echo json_encode($RespArray);
				exit;
		
	}
}

	
			
	public function UpdateSubSubCategoryData()
	{
	
			$this->loadModel('Subsubcategory');
			
			   $subsubcategory_id = $_POST["subsubcategory_id"];
			  
			
		
			/*	$arr_SubCatData = $this->Subsubcategory->find('all',array('conditions'=>array(
													'subsubcategory_id'=>$subsubcategory_id)));*/
						$arr_SubCatData = $this->Subsubcategory->find('all',array('joins' => array(array('table' => 'subcategory','alias' => 'subcategory',
            'type' => 'inner','recursive' => -1,'conditions'=> array('Subsubcategory.subcategory_id = subcategory.subcategory_id')), 
    ), 'conditions' =>  array('Subsubcategory.subsubcategory_id' => $subsubcategory_id,'Subsubcategory.subsubcategory_status'=>1)));
													
			
				$arrsubCatData = array();
				$arrsubCatData['status'] = 'success';
				$arrsubCatData['subsubcategory_id'] = $arr_SubCatData[0]['Subsubcategory']['subsubcategory_id'];
				$arrsubCatData['subsubcategory_name'] = $arr_SubCatData[0]['Subsubcategory']['subsubcategory_name'];
				$arrsubCatData['category_id'] = $arr_SubCatData[0]['Subsubcategory']['category_id'];
				$arrsubCatData['subcategory_id'] = $arr_SubCatData[0]['Subsubcategory']['subcategory_id'];
				$arrsubCatData['subsubcategory_image'] = Router::url('/', true).'assets/subsubcategory/'.$arr_SubCatData[0]['Subsubcategory']['subsubcategory_image'];
				
			
			$arrsubCatData  = json_encode($arrsubCatData);
			echo $arrsubCatData;
			exit();
			
			

		
	}		

}
