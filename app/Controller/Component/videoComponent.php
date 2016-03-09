<?php

App::uses('Component', 'Controller');
App::import('Model', 'UserMedia');

class videoComponent extends Component  
{
/* CHANGE THESE VALUES !! */
 public $components = array('Session','Auth');
	
	public function startup(Controller $controller) {
		$this->Controller = $controller;
	}
	
	public function fnuploadvideo()
	{
	App::import('Vendor', 'vimeo/vimeo');
	  	App::import('Vendor', 'vimeo/cache');
		
		ini_set('max_execution_time', 500); 
		ini_set('memory_limit', '96M');
		ini_set('post_max_size', '20M');
		ini_set('upload_max_filesize', '20M');
		set_time_limit(1080000);

if(isset($_FILES["FileInput"]) && $_FILES["FileInput"]["error"]== UPLOAD_ERR_OK)
{
	//Is file size is less than allowed size.
		if ($_FILES["FileInput"]["size"] > 5555242880) {
			die("File size is too big!");
		}
	
	$File_Name          = strtolower($_FILES['FileInput']['name']);
	$File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
	$Random_Number      = rand(0, 9999999999); //Random number to be added to name.
	$NewFileName 		= $Random_Number.$File_Ext; //new file name


			 try  
			 {  
				  
				  $api = $this->api();
				  $video_id = $api->upload($_FILES['FileInput']['tmp_name']);  
				 $videotitle = $_POST['title'];  
				  $videodesc = $_POST['desc'];  
				  if ($video_id) 
				  {  
					$sUploadResult = 'Your video has been uploaded and available <a href="http://vimeo.com/'.$video_id.'">here</a> !';  
					$api->call('vimeo.videos.setTitle', array('title' =>$videotitle, 'video_id' => $video_id));  
					$api->call('vimeo.videos.setDescription', array('description' => $videodesc, 'video_id' => $video_id));  
					$videoID = $video_id;   
				  }   
				 else   
				 {  
					  $arry['data']['flag'] = false;  
					  $arry['data']['msg'] = "Not able to retrieve the video status information yet. " ."Please try again later.\n";  
				 }  
			 }  
			 catch(Exception $e)  
			 {  
				  $arry['data']['flag'] = false;  
				  $arry['data']['msg'] = $e->getMessage();  
			 }       
      if($video_id)  
      {  
                $arry['data']['flag'] = true;  
                $arry['data']['url'] = $video_id;
      }  
      else  
      {  
           $arry['data']['flag'] = false;  
      }  
      if($arry['data']['msg'] == 'Invalid signature')  
      {  
           $arry['data']['msg'] = 'Invalid Secret or oauth_request_token_secret';  
      }  
      if($arry['data']['msg'] == 'Permission Denied')  
      {  
           $arry['data']['msg'] = 'Invalid oauth_access_token';  
      }  
     echo "<pre>";  
      print_r($arry);  
	    echo $video_id;
	  
		
}
	else
	{
		die('Something wrong with upload! Is "upload_max_filesize" set correctly?');
	}  
			
}


public function api()
{
	$consumer_key = 'e36dbc96a6248db612e7e8ec9163589f63bc0c12';  
	$consumer_secret = '33db24dc51a539d018c8c5658e0d1e5f816e74d4';  
    $oauth_access_token = '6419f184304ccce970fcf4b0d9f55a1e';  
    $oauth_request_token_secret = '9f0072271fcf97b5b9f74077aaee475ff3968fc3';  
    $vimeo = new phpVimeo($consumer_key, $consumer_secret);
    $vimeo->setToken($oauth_access_token, $oauth_request_token_secret);

    return $vimeo;
}


public function deleteAction( $id)
{
	App::import('Vendor', 'vimeo/vimeo');
	App::import('Vendor', 'vimeo/cache');
			try
			{
				$api = $this->api();
				
				$method = 'vimeo.videos.delete';

				$query = array();
				
				$query['video_id'] = $id;

				$r = $api->call($method, $query);

			}
			catch (VimeoAPIException $e)
			{
					echo "Encountered an API error -- code {$e->getCode()} - {$e->getMessage()}";
			}
			
			return $this->redirect($this->generateUrl('video',array('result'=> $r)));        
}




}?>