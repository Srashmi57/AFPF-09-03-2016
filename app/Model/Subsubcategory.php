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
class Subsubcategory extends Model {
	var $useTable = 'subsubcategory';
	var $name = 'subsubcategory';
	public function fnUpdateSubSubCartegoryImage($subsubcategoryImage = array())
	{
		if(count($subsubcategoryImage)>0)
		{
		 $strQuery = "Update appap14_subsubcategory SET  subsubcategory_image = '".$subsubcategoryImage['subsubcatimage']."' where subsubcategory_id='".$subsubcategoryImage['subsubcategory_id']."'"; 
			
			$subcategoryid = $this->query($strQuery);
			return $subcategoryid;
		}
	}
	public function fnToShowAllsubsubcategories()
	{
		
		
		$arrsubsubcategoriesList = $this->query("select subsubcat.*,cat.category_name,subcat.subcategory_name from appap14_subsubcategory as subsubcat  inner join appap14_category as cat on subsubcat.category_id = cat.category_id
left join appap14_subcategory as subcat on subsubcat.subcategory_id = subcat.subcategory_id");
		 
		return $arrsubsubcategoriesList;
	}
		public $virtualFields = array(
'catsubsubname' => 'CONCAT(Subsubcategory.subsubcategory_name, " - (", subcategory.subcategory_name,")")'
);
  
}