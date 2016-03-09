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
class Subcategory extends Model {
	var $useTable = 'subcategory';
	var $name = 'Subcategory';
	public function fnUpdateSubCartegoryImage($subcategoryImage = array())
	{
		if(count($subcategoryImage)>0)
		{
		 $strQuery = "Update appap14_subcategory SET  subcategory_image = '".$subcategoryImage['subcatimage']."' where subcategory_id='".$subcategoryImage['subcategory_id']."'"; 
		
			
			$subcategoryid = $this->query($strQuery);
			return $subcategoryid;
		}
	}
		public $virtualFields = array(
'catsubname' => 'CONCAT(Subcategory.subcategory_name, " - (", category.category_name,")")'
);

  
}