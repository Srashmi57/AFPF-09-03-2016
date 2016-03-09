<?php
class categoryComponent extends Component 
{
/* CHANGE THESE VALUES !! */
 
	public function GetAllCategories(){
			
				$arr_AllCategoryList = array();
				$this->loadModel('Category');
				$arr_AllCategoryList = $this->Category->find('all',array('conditions'=>array('Category.category_status'=>1)));
				return $arr_AllCategoryList;
		}
	public function GetAllSubCategories($categoryid){
		
			
				$arr_AllSubCategoryList = array();
				$this->loadModel('Subcategory');
				$arr_AllSubCategoryList = $this->Subcategory->find('all',array('conditions'=>array('Subcategory.category_id'=>$categoryid)));
				return $arr_AllSubCategoryList;
		}
		public function GetAllsubsubCategories($subcategoryid){
		
			
				$arr_AllSubsubCategoryList = array();
				$this->loadModel('Subsubcategory');
				$arr_AllSubsubCategoryList = $this->Subsubcategory->find('all',array('conditions'=>array('Subsubcategory.subcategory_id'=>$subcategoryid)));
				return $arr_AllSubsubCategoryList;
		}
		
		
		public function detailcategories()
		{
			$arr_detailCategoryList = array();
			$this->loadModel('Category');
			$this->loadModel('Subcategory');
			$this->loadModel('Subsubcategory');
			$condition = '';
			
			
			$categories = $this->Category->find('all',array('fields'=>'Category.category_name,Category.category_id'), array('conditions' => array('category_status'=>1)));
			
    foreach ($categories as $catKey => $catlist) {
		
        $categories[$catKey]['Category']['children'] = $this->Subcategory->find('all', array('conditions' => array('category_id'=>$catlist['Category']['category_id'],'subcategory_status'=>1)));
    }         
  
   foreach ($categories as $catKey => $subcatlist) {
		
        $categories[$catKey]['Category']['subchildren'] = $this->Subsubcategory->find('all', array('conditions' => array('category_id'=>$subcatlist['Category']['category_id'],'subsubcategory_status'=>1)));
    }    
			return $categories;
		}
 
}?>