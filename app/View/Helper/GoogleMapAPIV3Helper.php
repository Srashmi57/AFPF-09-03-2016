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
class GoogleMapAPIV3Helper extends AppHelper {
	
		public function get_LatLng_By_Address($get_address){
			
			$filter_address = str_replace(' ','+',$get_address);
			$get_filter_address = str_replace(',','+',$filter_address);
			
			$url = "http://maps.googleapis.com/maps/api/geocode/json?address=$get_filter_address&sensor=false";

			// Make the HTTP request
			$data = @file_get_contents($url);
			// Parse the json response
			$jsondata = json_decode($data,true);

			// If the json data is invalid, return empty array
			//if (!check_status($jsondata)) return array();

			$LatLng = array(
				'lat' => $jsondata["results"][0]["geometry"]["location"]["lat"],
				'lng' => $jsondata["results"][0]["geometry"]["location"]["lng"],
			);

			return $LatLng;
		}

	
}
