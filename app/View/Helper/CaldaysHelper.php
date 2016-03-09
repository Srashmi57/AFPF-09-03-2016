<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
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
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class CaldaysHelper extends AppHelper {
	
	
	public function checkdates($now,$usermedia_date){
			$seconds  = strtotime($now) - strtotime($usermedia_date);

				$months = floor($seconds / (3600*24*30));
				$day = floor($seconds / (3600*24));
				$hours = floor($seconds / 3600);
				$mins = floor(($seconds - ($hours*3600)) / 60);
				$secs = floor($seconds % 60);
				
				if($day<=50)
				{
					if($seconds < 60)
						$time = $secs." seconds ago";
					else if($seconds < 60*60 )
						$time = $mins." mins ago";
					else if($seconds < 24*60*60)
						$time = $hours." hours ago";
					else 
						$time = $day." days ago";
					
					return $time;
				}
				else
				{
					 $currentdate = date('d-m-Y',strtotime($now));
					$date1 = date_create($currentdate);
					$created = date('d-m-Y',strtotime($usermedia_date));
					$date2 = date_create($created);
					$diff12 = date_diff($date2, $date1);
					$days = $diff12->d;
					$months = $diff12->m;
					$years = $diff12->y;
					
						if($years>0)
						{
							return $years." years ago";
						}
						else 
						{
							 return $months." months ago";
						}
			}
			
			
	}
	
	public function GetUserAge($now,$birthdate)
	{
		
					 $currentdate = date('d-m-Y',strtotime($now));
					$date1 = date_create($currentdate);
					$created = date('d-m-Y',strtotime($birthdate));
					$date2 = date_create($created);
					$diff12 = date_diff($date2, $date1);
					
					$years = $diff12->y;
					
					return 	$years." Years";
			
			
			
	}
	
	public function getsubcategories($categoryid)
	{
		    $modelsubCategory = ClassRegistry::init('Subcategory');
			  $arr_AllSubCategoryList =  $modelsubCategory->find('list',array(
																	'fields'=>array('subcategory_id',
																					'subcategory_name'),
																	'conditions'=>array('category_id'=>$categoryid, 'subcategory_status'=>1)
																)
													);
	
			
		return $arr_AllSubCategoryList;
	}
	public function getsubsubcategories($subcategoryid)
	{
		$modelSubsubcategory = ClassRegistry::init('Subsubcategory');
			$arr_subsubCategoriesList = $modelSubsubcategory->find('list',array(
																	'fields'=>array('subsubcategory_id',
																					'subsubcategory_name'),
																	'conditions'=>array('subcategory_id'=>$subcategoryid, 'subsubcategory_status'=>1)
																)
													);
													
			return $arr_subsubCategoriesList;
	}
	
}
