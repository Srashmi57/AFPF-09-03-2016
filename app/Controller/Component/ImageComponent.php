<?php
class ImageComponent extends Component {



/**
 * Image resize
 * @param int $width
 * @param int $height
 */
	public function resize($width, $height,$filepath,$ext,$path,$id){
	
	
		// some settings
		$max_upload_width = $width;
		$max_upload_height = $height;
		
		// if uploaded image was JPG/JPEG
		if($ext == "jpeg" || $ext == "jpg"){	
			$image_source = imagecreatefromjpeg($filepath);
		}		
		// if uploaded image was GIF
		if($ext== "gif"){	
			$image_source = imagecreatefromgif($filepath);
		}	
		// BMP doesn't seem to be supported so remove it form above image type test (reject bmps)	
		// if uploaded image was BMP
		if($ext == "bmp"){	
			$image_source = imagecreatefromwbmp($filepath);
		}			
		// if uploaded image was PNG
		if($ext == "png"){
			$image_source = imagecreatefrompng($filepath);
		}
		
		$remote_file = $path.'image_'.$id.''.$width.'.'.$ext;
		$imagename = 'image_'.$id.''.$width.'.'.$ext;
		imagejpeg($image_source,$remote_file,100);
		chmod($remote_file,0644);
	
		// get width and height of original image
		list($image_width, $image_height) = getimagesize($remote_file);
	
		if($image_width>$max_upload_width || $image_height >$max_upload_height){
			$proportions = $image_width/$image_height;
			
			if($image_width>$image_height){
				$new_width = $max_upload_width;
				$new_height = round($max_upload_width/$proportions);
			}		
			else{
				$new_height = $max_upload_height;
				$new_width = round($max_upload_height*$proportions);
			}		
			
			
			$new_image = imagecreatetruecolor($new_width , $new_height);
			$image_source = imagecreatefromjpeg($remote_file);
			
			imagecopyresampled($new_image, $image_source, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height);
			imagejpeg($new_image,$remote_file,100);
			
			imagedestroy($new_image);
		}
		
		imagedestroy($image_source);
		
		
  
  return $imagename;
 
	}
	

}
