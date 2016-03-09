<?php

App::uses('Component', 'Controller');
App::import('Model', 'Category');

class categoryComponent extends Component  
{
/* CHANGE THESE VALUES !! */
 public $components = array('Session','Auth');
	
	public function startup(Controller $controller) {
		$this->Controller = $controller;
	}
	
	//Get navination on all pages
	public function detailcategories()
		{
			$arr_detailCategoryList = array();
			$modelCategory = ClassRegistry::init('Category');
			$modelSubcategory = ClassRegistry::init('Subcategory');
			$modelSubsubcategory = ClassRegistry::init('Subsubcategory');
			
				$subcategoryarray=array();
			
	$categories = $modelCategory->find('all', array( 'fields' => array('Category.category_id','Category.category_name'), 'conditions' => array('Category.category_status' => 1),'order'=>'category_order'));		
	$html= "<ul>";
	$count=0;
    foreach ($categories as $catKey => $detailcatlist) {

			$categoryname = $detailcatlist['Category']['category_name'];
			$categoryid = $detailcatlist['Category']['category_id'];
		   $categoryUrl = Router::url(array('controller'=>'websites','action'=>'category'),true)."/".$categoryid;
		   
		  
        $detailsubacategories = $modelSubcategory->find('all', array( 'fields' => array('Subcategory.subcategory_id','Subcategory.subcategory_name'), 'conditions' => array('Subcategory.subcategory_status' => 1,'Subcategory.category_id' => $categoryid )));
		
		if(count($detailsubacategories)>0)
		{
		$html.="<li class='hassub'> <a href=".$categoryUrl.">".$categoryname."</a>
								<ul>";
			foreach($detailsubacategories as $subcatKey => $detailsubcatlist)
			{
				 
				  $subcategoryname  = $detailsubcatlist['Subcategory']['subcategory_name'];
				 $textsubcategory_id = $detailsubcatlist['Subcategory']['subcategory_id'];
				 $subcategoryUrl = Router::url(array('controller'=>'websites','action'=>'subcategory'),true)."/".$textsubcategory_id;
				$newsubdetaicategories	= $modelSubsubcategory->find('all', array( 'fields' => array('Subsubcategory.subsubcategory_id','Subsubcategory.subsubcategory_name'), 'conditions' => array('Subsubcategory.subsubcategory_status' => 1,'Subsubcategory.subcategory_id' => $textsubcategory_id)));		
				if(count($newsubdetaicategories)>0)
				{
				$html.="<li class='hassub'><a href=".$subcategoryUrl.">".$subcategoryname."</a>
                                      <ul>";
									  
					foreach($newsubdetaicategories as $subsubcat=> $subsubcatlist)
					{
					   $subsubcategoryname = $subsubcatlist['Subsubcategory']['subsubcategory_name'];
					    $subsubcategoryid = $subsubcatlist['Subsubcategory']['subsubcategory_id'];
						
						$subsubcategoryUrl = Router::url(array('controller'=>'websites','action'=>'subsubcategory'),true)."/".$subsubcategoryid;
						$html.="<li><a href=".$subsubcategoryUrl.">".$subsubcategoryname."</a></li>";
					}
					$html.="</ul>";
					$html.="</li>";
				}
				 else
				{
					$html.="<li><a href=".$subcategoryUrl.">".$subcategoryname."</a></li>";
				}
			}
		$html.="</ul>";
		$html.="</li>";
		}
		else
		{
			$html.="<li> <a href=".$categoryUrl.">".$categoryname."</a>";
		}
		}
    
$html.="</ul>";


			return $html;
}


//get all categories on home page
	public function GetAllCategories()
	{
			
				$arr_AllCategoryList = array();
				
				$modelCategory = ClassRegistry::init('Category');
				$arr_AllCategoryList = $modelCategory->find('all',array('conditions'=>array('Category.category_status'=>1),'order'=>'category_order asc'));
				return $arr_AllCategoryList;
	}
		
		// function get all subcategories related with categoryid
		
	public function GetAllSubCategories($categoryid)
	{
		
		$arr_AllSubCategoryList = array();
		
		$modelSubcategory = ClassRegistry::init('Subcategory');
				
		$arr_AllSubCategoryList = $modelSubcategory->find('all',array('fields' => array('cat.category_id','cat.category_image','Subcategory.subcategory_id','Subcategory.subcategory_name','Subcategory.subcategory_image'),'joins' => array(array('table' => 'category','alias' => 'cat',
            'type' => 'inner','recursive' => -1,'conditions'=> array('cat.category_id = Subcategory.category_id')), 
    ), 'conditions' =>  array('Subcategory.category_id' => $categoryid,'Subcategory.subcategory_status'=>1)));
	
			
		return $arr_AllSubCategoryList;
	}

	
	
	
	public function GetAllsubsubCategories($subcategoryid){
		
			
				$arr_AllSubsubCategoryList = array();
				$modelSubsubcategory = ClassRegistry::init('Subsubcategory');
				
				$arr_AllSubsubCategoryList = $modelSubsubcategory->find('all',array('fields' => array('cat.category_id','cat.category_image','Subsubcategory.subsubcategory_id','Subsubcategory.subsubcategory_name','Subsubcategory.subsubcategory_image'),'joins' => array(array('table' => 'category','alias' => 'cat',
            'type' => 'inner','recursive' => -1,'conditions'=> array('cat.category_id = Subsubcategory.category_id')), 
    ), 'conditions' =>  array('Subsubcategory.subcategory_id' => $subcategoryid,'Subsubcategory.subsubcategory_status'=>1)));
					
				return $arr_AllSubsubCategoryList;
		}
		
		//Get all Website Banners
		public function Getwebsitebanners($catgoryid=null)
		{
			$condition="banner_status = 1";
			
			if($catgoryid>0)
			{
				 $condition.=" and category_id=".$catgoryid;
			}
			$modelBanner = ClassRegistry::init('banner');
			$arr_bannerData = $modelBanner->find('all',array('conditions'=>array($condition),'order' => 'rand() Desc'));
			
			return $arr_bannerData;
		}
		
		
		//Get all Website Banners by categories
		public function Getwebsitesubcatbanners($subcatgoryid)
		{
			
			
			$modelBanner = ClassRegistry::init('banner');
			$arr_bannerData = $modelBanner->find('all',array('fields' => array('banner.*'),'joins' => array(
			array(
			'table' => 'category',
			'alias' => 'cat',
            'type' => 'inner',
			'recursive' => -1,
			'conditions'=> array('cat.category_id = banner.category_id')
			),
			array(
			'table' => 'subcategory',
			'alias' => 'subcat',
            'type' => 'inner',
			'recursive' => -1,
			'conditions'=> array('cat.category_id = subcat.category_id')
			)
			), 'conditions'=>array('banner.banner_status'=>1,'subcat.subcategory_id'=>$subcatgoryid),'order' => 'rand() Desc'));
			
			return $arr_bannerData;
		}
		
		public function Getwebsitesubsubcatbanners($subsubcategory_id)
		{
			
			
			$modelBanner = ClassRegistry::init('banner');
			$arr_bannerData = $modelBanner->find('all',array('fields' => array('banner.*'),'joins' => array(
			array(
			'table' => 'category',
			'alias' => 'cat',
            'type' => 'inner',
			'recursive' => -1,
			'conditions'=> array('cat.category_id = banner.category_id')
			),
			array(
			'table' => 'subsubcategory',
			'alias' => 'subsubcat',
            'type' => 'inner',
			'recursive' => -1,
			'conditions'=> array('cat.category_id = subsubcat.category_id')
			)
			), 'conditions'=>array('banner.banner_status'=>1,'subsubcat.subsubcategory_id'=>$subsubcategory_id),'order' => 'rand() Desc'));
			
			return $arr_bannerData;
		}
		
		
		public function fnToGetAllCategoryList()
		{
			
				$arr_CategoryList = array();
				$modelCategory = ClassRegistry::init('Category');
				$arr_CategoryList = $modelCategory->find('list',array('fields'=>array('category_id','category_name'),'conditions'=>array('category_status'=>1),'order'=>array('category_order'=>'asc')));
																
				
			return $arr_CategoryList;
		}
		
		
		public function fnToGetSubCategoryList($current_user_id)
		{	
			$id=$current_user_id;
			//echo $id;
			
			$arr_Sub_CategoryList = array();
			$modelCategory = ClassRegistry::init('Users');
			$subcategory_id = $modelCategory->field('subcategory_id',array('user_id' => $id));
			$sub_cat_name= $this->fnGetSubCategoryParent($subcategory_id);
			return  $sub_cat_name;
			
		}
		public function fnGetSubCategoryParent($subcategory_id)
		{
			$modelsubCategory = ClassRegistry::init('Subcategory');
			
			$catname = $modelsubCategory->field('subcategory_name',array('subcategory_id' => $subcategory_id));
			return $catname;
		}
		
		public function fnToGetSubCategoryallList($current_user_id)
		{	
			$id=$current_user_id;
			//echo $id;
			
			$arr_Sub_CategoryList = array();
			$modelCategory = ClassRegistry::init('Users');
			$category_id = $modelCategory->field('category_id',array('user_id' => $id));
			$sub_cat_name= $this->fnGetCategoryParent($category_id);
			return  $sub_cat_name;
			
		}
		
		public function fnGetCategoryParent($category_id)
		{
			$modelsubCategory = ClassRegistry::init('Subcategory');
			
			$catname = $modelsubCategory->field('subcategory_name',array('category_id' => $category_id));
			return $catname;
		}
		
	public function fnToGetAllsubCategoryList(){
		
			$arr_SubcategoryList = array();
			
			$modelSubcategory = ClassRegistry::init('Subcategory');
			$arr_SubcategoryList = $modelSubcategory->find('list',array('fields'=>array('Subcategory.subcategory_id','Subcategory.subcategory_name'),'conditions'=>array('Subcategory.Subcategory_status'=>1))
																);
			
			ksort($arr_SubcategoryList);			
		return $arr_SubcategoryList;
	}
	
	public function fnToGetSubSubCategoryList(){
		
			$arr_SubcategoryList = array();
			
			$modelSubsubcategory = ClassRegistry::init('Subsubcategory');
			$arr_SubcategoryList = $modelSubsubcategory->find('list',array('fields'=>array('Subsubcategory.subsubcategory_id','Subsubcategory.subsubcategory_name'),'conditions'=>array('Subsubcategory.subsubcategory_status'=>1)));
			$arr_SubcategoryList[""] = "Please Select subsubcategory";
			ksort($arr_SubcategoryList);			
		return $arr_SubcategoryList;
	}

	public function fnToGetCategoryName($category_id)
	{
		$modelCategory = ClassRegistry::init('Category');
		$catname = $modelCategory->field('category_name',array('category_id' => $category_id));
		return $catname;
	}
	
	
	
	public function fnGetSubsubCategoryParent($subsubcategory_id)
	{
		$modelsubsubCategory = ClassRegistry::init('Subsubcategory');
			$catname = $modelsubsubCategory->field('subsubcategory_name',array('subsubcategory_id' => $subsubcategory_id));
		return $catname;
	}
	
	public function GetSubCategoryParentcat($subcategory_id)
	{
		$modelsubCategory = ClassRegistry::init('Subcategory');
		
		$arr_catname = $modelsubCategory->find('first',array('fields' => array('cat.category_name','cat.category_id'),'joins' => array(array('table' => 'category','alias' => 'cat',
            'type' => 'inner','recursive' => -1,'conditions'=> array('Subcategory.category_id = cat.category_id')), 
    ), 'conditions' =>  array('Subcategory.subcategory_id' => $subcategory_id)));
		return $arr_catname;
	}
	
	public function GetSubsubCategoryParentcat($subsubcategory_id)
	{
		$modelsubsubCategory = ClassRegistry::init('Subsubcategory');
			$arr_catname = $modelsubsubCategory->find('first',array('fields' => array('subcat.subcategory_name','subcat.subcategory_id'),'joins' => array(array('table' => 'subcategory','alias' => 'subcat',
				'type' => 'inner','recursive' => -1,'conditions'=> array('Subsubcategory.subcategory_id = subcat.subcategory_id')), 
		), 'conditions' =>  array('Subsubcategory.subsubcategory_id' => $subsubcategory_id)));
		return $arr_catname;
	}
	
	public function GetAllUserCategoryList()
	{
			$current_user_id = CakeSession::read('Auth.WebsitesUser.user_id');
				$arr_AllCategoryList = array();
				
				$modelusercategory = ClassRegistry::init('usercategory');
			$arr_AllCategoryList = $modelusercategory->find('list',array('fields' => array('cat.category_id','cat.category_name'),'joins' => array(array('table' => 'category','alias' => 'cat',
            'type' => 'inner','recursive' => -1,'conditions'=> array('cat.category_id = usercategory.category_id')), 
    ), 'conditions' =>  array('usercategory.user_id' => $current_user_id,'cat.category_status'=>1)));
	$arr_AllCategoryList["0"] = "Please Select category";
			ksort($arr_AllCategoryList);			
		return $arr_AllCategoryList;
			
	}
	
	public function fnGetUserCategory($userid)
	{
		$modeluserCategory = ClassRegistry::init('UserCategory');
		
	$usercatlist = $modeluserCategory->find('all',array('fields' => array('cat.category_name','UserCategory.category_id'),'joins' => array(array('table' => 'category','alias' => 'cat',
            'type' => 'inner','recursive' => -1,'conditions'=> array('UserCategory.category_id = cat.category_id')), 
    ), 'conditions' =>  array('UserCategory.user_id' => $userid)));
	
		return $usercatlist;
	
		
	}
	
		public function fnGetUserSubCategory($userid)
	{
		$modelusersubCategory = ClassRegistry::init('UserSubCategory');
		
	$usercatlist = $modelusersubCategory->find('all',array('fields' => array('subcat.subcategory_name','subcat.subcategory_id'),'joins' => array(array('table' => 'subcategory','alias' => 'subcat',
            'type' => 'inner','recursive' => -1,'conditions'=> array('UserSubCategory.subcategory_id = subcat.subcategory_id')), 
    ), 'conditions' =>  array('UserSubCategory.user_id' => $userid)));
	
	
		return $usercatlist;

	
		
	}
	
		public function fnGetUserSubSubCategory($userid)
	{
		$modelusersubCategory = ClassRegistry::init('UserSubSubCategory');
		
	$usercatlist = $modelusersubCategory->find('all',array('fields' => array('subsubcat.subsubcategory_name','subsubcat.subsubcategory_id'),'joins' => array(array('table' => 'subsubcategory','alias' => 'subsubcat',
            'type' => 'inner','recursive' => -1,'conditions'=> array('UserSubSubCategory.subsubcategory_id = subsubcat.subsubcategory_id')), 
    ), 'conditions' =>  array('UserSubSubCategory.user_id' => $userid)));
	
	
		return $usercatlist;

	
		
	}
		
}?>
