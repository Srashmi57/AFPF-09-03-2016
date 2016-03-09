<?php
App::uses('Component', 'Controller');
class FileuploadComponent extends Component 
{
    public $components = array('Session');
	
	protected $options;
	
	public function startup(Controller $controller) 
	{
		$this->Controller = $controller;
	}

	
    // PHP File Upload error message codes:
    // http://php.net/manual/en/features.file-upload.errors.php
    protected $error_messages = array(
        1 => 'The uploaded file size is too big',
        2 => 'The uploaded file size is too big',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk',
        8 => 'A PHP extension stopped the file upload',
        'post_max_size' => 'The uploaded file size is too big',
        'max_file_size' => 'File is too big',
        'min_file_size' => 'File is too small',
        'accept_file_types' => 'This format is not supported. Convert it to mp3/mp4 and try uplaoding again',
        'max_number_of_files' => 'Maximum number of files exceeded',
        'max_width' => 'Image exceeds maximum width',
        'min_width' => 'Image requires a minimum width 569',
        'max_height' => 'Image exceeds maximum height',
        'min_height' => 'Image requires a minimum height 364',
        'abort' => 'File upload aborted',
        'image_resize' => 'Failed to resize image'
    );

    protected $image_objects = array();

    function __construct($options = null, $initialize = false, $error_messages = null) {
	
		$this->options = array(
            'script_url' => Router::url('/',true).'websites/uploadfile',
            'upload_dir' => 'files/',
            'upload_url' => Router::url('/',true).'files/'.CakeSession::read('Auth.WebsitesUser.user_id').'/',
            'user_dirs' => false,
            'mkdir_mode' => 0755,
            'param_name' => 'files',
            // Set the following option to 'POST', if your server does not support
            // DELETE requests. This is a parameter sent to the client:
            'delete_type' => 'DELETE',
            'access_control_allow_origin' => '*',
            'access_control_allow_credentials' => false,
            'access_control_allow_methods' => array(
                'OPTIONS',
                'HEAD',
                'GET',
                'POST',
                'PUT',
                'PATCH',
                'DELETE'
            ),
            'access_control_allow_headers' => array(
                'Content-Type',
                'Content-Range',
                'Content-Disposition'
            ),
            // Enable to provide file downloads via GET requests to the PHP script:
            //     1. Set to 1 to download files via readfile method through PHP
            //     2. Set to 2 to send a X-Sendfile header for lighttpd/Apache
            //     3. Set to 3 to send a X-Accel-Redirect header for nginx
            // If set to 2 or 3, adjust the upload_url option to the base path of
            // the redirect parameter, e.g. '/files/'.
            'download_via_php' => false,
            // Read files in chunks to avoid memory limits when download_via_php
            // is enabled, set to 0 to disable chunked reading of files:
            'readfile_chunk_size' => 10 * 1024 * 1024, // 10 MiB
            // Defines which files can be displayed inline when downloaded:
            'inline_file_types' => '/\.(gif|jpe?g|png)$/i',
            // Defines which files (based on their names) are accepted for upload:
            'accept_file_types' => '/.(gif|jpe?g|png|pdf|mp3|mp4|mov|wav|docx|pdf|m4v|f4v|m4a|aac|f4a|WebM|ogg|avi)+$/i',
            // The php.ini settings upload_max_filesize and post_max_size
            // take precedence over the following max_file_size setting: 'max_file_size' => 50000000
            'max_file_size' => 5000000000,
            'min_file_size' => 1,
            // The maximum number of files for the upload directory:
            'max_number_of_files' => 500,
            // Defines which files are handled as image files:
            'image_file_types' => '/\.(gif|jpe?g|png|tif)$/i',
            // Image resolution restrictions:
            'max_width' => 0,
            'max_height' => 0,
            'min_width' => 569,
            'min_height' => 364,
            // Set the following option to false to enable resumable uploads:
            'discard_aborted_uploads' => true,
            // Set to 0 to use the GD library to scale and orient images,
            // set to 1 to use imagick (if installed, falls back to GD),
            // set to 2 to use the ImageMagick convert binary directly:
            'image_library' => 1,
            // Uncomment the following to define an array of resource limits
            // for imagick:
            /*
            'imagick_resource_limits' => array(
                imagick::RESOURCETYPE_MAP => 32,
                imagick::RESOURCETYPE_MEMORY => 32
            ),
            */
            // Command or path for to the ImageMagick convert binary:
            'convert_bin' => 'convert',
            // Uncomment the following to add parameters in front of each
            // ImageMagick convert call (the limit constraints seem only
            // to have an effect if put in front):
            /*
            'convert_params' => '-limit memory 32MiB -limit map 32MiB',
            */
            // Command or path for to the ImageMagick identify binary:
            'identify_bin' => 'identify',
            'image_versions' => array(
                // The empty image version key defines options for the original image:
                '' => array(
                    // Automatically rotate images based on EXIF meta data:
                    'auto_orient' => true
                ),
                // Uncomment the following to create medium sized images:
                'large' => array(
                    'max_width' => 569,
                    'max_height' => 364
                ),
                'medium' => array(
                    'max_width' => 429,
                    'max_height' => 382
                )
				
              
            )
        );
		
		
		if(isset($_GET['uploadfor']) && ($_GET['uploadfor']))
		{
				$this->options = array(
				'script_url' => Router::url('/',true).'websites/uploadfile',
				'upload_dir' => 'files/',
				'upload_url' => Router::url('/',true).'files/'.CakeSession::read('Auth.WebsitesUser.user_id').'/',
				'user_dirs' => false,
				'mkdir_mode' => 0755,
				'param_name' => 'files',
				// Set the following option to 'POST', if your server does not support
				// DELETE requests. This is a parameter sent to the client:
				'delete_type' => 'DELETE',
				'access_control_allow_origin' => '*',
				'access_control_allow_credentials' => false,
				'access_control_allow_methods' => array(
					'OPTIONS',
					'HEAD',
					'GET',
					'POST',
					'PUT',
					'PATCH',
					'DELETE'
				),
				'access_control_allow_headers' => array(
					'Content-Type',
					'Content-Range',
					'Content-Disposition'
				),
				// Enable to provide file downloads via GET requests to the PHP script:
				//     1. Set to 1 to download files via readfile method through PHP
				//     2. Set to 2 to send a X-Sendfile header for lighttpd/Apache
				//     3. Set to 3 to send a X-Accel-Redirect header for nginx
				// If set to 2 or 3, adjust the upload_url option to the base path of
				// the redirect parameter, e.g. '/files/'.
				'download_via_php' => false,
				// Read files in chunks to avoid memory limits when download_via_php
				// is enabled, set to 0 to disable chunked reading of files:
				'readfile_chunk_size' => 10 * 1024 * 1024, // 10 MiB
				// Defines which files can be displayed inline when downloaded:
				'inline_file_types' => '/\.(gif|jpe?g|png)$/i',
				// Defines which files (based on their names) are accepted for upload:
				'accept_file_types' => '/.(gif|jpe?g|png|pdf|3gp|wmv|mp3|mp4|mov|flv|docx|pdf|avi)+$/i',
				// The php.ini settings upload_max_filesize and post_max_size
				// take precedence over the following max_file_size setting:
				'max_file_size' => 5000000000 ,
				'min_file_size' => 1,
				// The maximum number of files for the upload directory:
				'max_number_of_files' => 500,
				// Defines which files are handled as image files:
				'image_file_types' => '/\.(gif|jpe?g|png)$/i',
				// Image resolution restrictions:
				'max_width' => null,
				'max_height' => null,
				'min_width' => 569,
				'min_height' => 364,
				// Set the following option to false to enable resumable uploads:
				'discard_aborted_uploads' => true,
				// Set to 0 to use the GD library to scale and orient images,
				// set to 1 to use imagick (if installed, falls back to GD),
				// set to 2 to use the ImageMagick convert binary directly:
				'image_library' => 1,
				// Uncomment the following to define an array of resource limits
				// for imagick:
				/*
				'imagick_resource_limits' => array(
					imagick::RESOURCETYPE_MAP => 32,
					imagick::RESOURCETYPE_MEMORY => 32
				),
				*/
				// Command or path for to the ImageMagick convert binary:
				'convert_bin' => 'convert',
				// Uncomment the following to add parameters in front of each
				// ImageMagick convert call (the limit constraints seem only
				// to have an effect if put in front):
				/*
				'convert_params' => '-limit memory 32MiB -limit map 32MiB',
				*/
				// Command or path for to the ImageMagick identify binary:
				'identify_bin' => 'identify',
				'image_versions' => array(
					// The empty image version key defines options for the original image:
					'' => array(
						// Automatically rotate images based on EXIF meta data:
						'auto_orient' => true
					),
					// Uncomment the following to create medium sized images:
					'large' => array(
						'max_width' => 569,
						'max_height' => 364
					),
					'medium' => array(
						'max_width' => 429,
						'max_height' => 382
					)
					
				  
				)
			);
		}
		
		
        /*if ($options) {
            $this->options = $options + $this->options;
        }*/
        if ($error_messages) {
            $this->error_messages = $error_messages + $this->error_messages;
        }
        if ($initialize) {
            $this->bootup();
        }
    }

    public function bootup() {
	

        switch ($this->get_server_var('REQUEST_METHOD')) {
            case 'OPTIONS':
            case 'HEAD':
                $this->head();
                break;
            case 'GET':
                $this->get();
                break;
            case 'PATCH':
            case 'PUT':
            case 'POST':
                $this->post();
                break;
            case 'DELETE':
                $this->delete();
                break;
            default:
                $this->header('HTTP/1.1 405 Method Not Allowed');
        }
    }

    protected function get_full_url() {
        $https = !empty($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'on') === 0;
        return
            ($https ? 'https://' : 'http://').
            (!empty($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'].'@' : '').
            (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'].
            ($https && $_SERVER['SERVER_PORT'] === 443 ||
            $_SERVER['SERVER_PORT'] === 80 ? '' : ':'.$_SERVER['SERVER_PORT']))).
            substr($_SERVER['SCRIPT_NAME'],0, strrpos($_SERVER['SCRIPT_NAME'], '/'));
    }

    protected function get_user_id() {
        @session_start();
        return session_id();
    }

    protected function get_user_path() {
        if ($this->options['user_dirs']) {
            return $this->get_user_id().'/';
        }
        return '';
    }

    protected function get_upload_path($file_name = null, $version = null) {
        $file_name = $file_name ? $file_name : '';
		 $current_user_id = CakeSession::read('Auth.WebsitesUser.user_id');
        if (empty($version)) {
            $version_path = '';
        } else {
            $version_dir = @$this->options['image_versions'][$version]['upload_dir'];
            if ($version_dir) {
                return $version_dir.$this->get_user_path().$current_user_id."/".$file_name;
            }
            $version_path = $version.'/';
        }
        return $this->options['upload_dir'].$this->get_user_path()
            .$version_path.$current_user_id."/".$file_name;
    }

    protected function get_query_separator($url) {
        return strpos($url, '?') === false ? '?' : '&';
    }

    protected function get_download_url($file_name, $version = null, $direct = false) {
        if (!$direct && $this->options['download_via_php']) {
            $url = $this->options['script_url']
                .$this->get_query_separator($this->options['script_url'])
                .$this->get_singular_param_name()
                .'='.rawurlencode($file_name);
            if ($version) {
                $url .= '&version='.rawurlencode($version);
            }
            return $url.'&download=1';
        }
        if (empty($version)) {
            $version_path = '';
        } else {
            $version_url = @$this->options['image_versions'][$version]['upload_url'];
            if ($version_url) {
                return $version_url.$this->get_user_path().rawurlencode($file_name);
            }
            $version_path = rawurlencode($version).'/';
        }
        return $this->options['upload_url'].$this->get_user_path()
            .$version_path.rawurlencode($file_name);
    }

    protected function set_additional_file_properties($file) {
        $file->deleteUrl = $this->options['script_url']
            .$this->get_query_separator($this->options['script_url'])
            .$this->get_singular_param_name()
            .'='.rawurlencode($file->id);
        $file->deleteType = $this->options['delete_type'];
        if ($file->deleteType !== 'DELETE') {
            $file->deleteUrl .= '&_method=DELETE';
        }
        if ($this->options['access_control_allow_credentials']) {
            $file->deleteWithCredentials = true;
        }
    }

    // Fix for overflowing signed 32 bit integers,
    // works for sizes up to 2^32-1 bytes (4 GiB - 1):
    protected function fix_integer_overflow($size) {
        if ($size < 0) {
            $size += 2.0 * (PHP_INT_MAX + 1);
        }
        return $size;
    }

    protected function get_file_size($file_path, $clear_stat_cache = false) {
        if ($clear_stat_cache) {
            if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
                clearstatcache(true, $file_path);
            } else {
                clearstatcache();
            }
        }
        return $this->fix_integer_overflow(filesize($file_path));
    }

    protected function is_valid_file_object($file_name) {
        $file_path = $this->get_upload_path($file_name);
        if (is_file($file_path) && $file_name[0] !== '.') {
            return true;
        }
        return false;
    }

    protected function get_file_object($file_name) {
        if ($this->is_valid_file_object($file_name)) {
            $file = new \stdClass();
            $file->name = $file_name;
            $file->size = $this->get_file_size(
                $this->get_upload_path($file_name)
            );
            $file->url = $this->get_download_url($file->name);
            foreach($this->options['image_versions'] as $version => $options) {
                if (!empty($version)) {
                    if (is_file($this->get_upload_path($file_name, $version))) {
                        $file->{$version.'Url'} = $this->get_download_url(
                            $file->name,
                            $version
                        );
                    }
                }
            }
            $this->set_additional_file_properties($file);
            return $file;
        }
        return null;
    }

    protected function get_file_objects($iteration_method = 'get_file_object') {
        $upload_dir = $this->get_upload_path();
        if (!is_dir($upload_dir)) {
            return array();
        }
        return array_values(array_filter(array_map(
            array($this, $iteration_method),
            scandir($upload_dir)
        )));
    }

    protected function count_file_objects() {
        return count($this->get_file_objects('is_valid_file_object'));
    }

    protected function get_error_message($error) {
        return array_key_exists($error, $this->error_messages) ?
            $this->error_messages[$error] : $error;
    }

    function get_config_bytes($val) {
        $val = trim($val);
        $last = strtolower($val[strlen($val)-1]);
        switch($last) {
            case 'g':
                $val *= 1024;
            case 'm':
                $val *= 1024;
            case 'k':
                $val *= 1024;
        }
        return $this->fix_integer_overflow($val);
    }

    protected function validate($uploaded_file, $file, $error, $index) {
        if ($error) {
            $file->error = $this->get_error_message($error);
            return false;
        }
        $content_length = $this->fix_integer_overflow(intval(
            $this->get_server_var('CONTENT_LENGTH')
        ));
        $post_max_size = $this->get_config_bytes(ini_get('post_max_size'));
        if ($post_max_size && ($content_length > $post_max_size)) {
            $file->error = $this->get_error_message('post_max_size');
            return false;
        }
        if (!preg_match($this->options['accept_file_types'], $file->name)) {
            $file->error = $this->get_error_message('accept_file_types');
            return false;
        }
        if ($uploaded_file && is_uploaded_file($uploaded_file)) {
            $file_size = $this->get_file_size($uploaded_file);
        } else {
            $file_size = $content_length;
        }
        if ($this->options['max_file_size'] && (
                $file_size > $this->options['max_file_size'] ||
                $file->size > $this->options['max_file_size'])
            ) {
            $file->error = $this->get_error_message('max_file_size');
            return false;
        }
        if ($this->options['min_file_size'] &&
            $file_size < $this->options['min_file_size']) {
            $file->error = $this->get_error_message('min_file_size');
            return false;
        }
        if (is_int($this->options['max_number_of_files']) &&
                ($this->count_file_objects() >= $this->options['max_number_of_files']) &&
                // Ignore additional chunks of existing files:
                !is_file($this->get_upload_path($file->name))) {
            $file->error = $this->get_error_message('max_number_of_files');
            return false;
        }
        $max_width = @$this->options['max_width'];
        $max_height = @$this->options['max_height'];
        $min_width = @$this->options['min_width'];
        $min_height = @$this->options['min_height'];
        if (($max_width || $max_height || $min_width || $min_height)
           && preg_match($this->options['image_file_types'], $file->name)) {
            list($img_width, $img_height) = $this->get_image_size($uploaded_file);
        }
        if (!empty($img_width)) {
            if ($max_width && $img_width > $max_width) {
                $file->error = $this->get_error_message('max_width');
                return false;
            }
            if ($max_height && $img_height > $max_height) {
                $file->error = $this->get_error_message('max_height');
                return false;
            }
            if ($min_width && $img_width < $min_width) {
                $file->error = $this->get_error_message('min_width');
                return false;
            }
            if ($min_height && $img_height < $min_height) {
                $file->error = $this->get_error_message('min_height');
                return false;
            }
        }
        return true;
    }

    protected function upcount_name_callback($matches) {
        $index = isset($matches[1]) ? intval($matches[1]) + 1 : 1;
        $ext = isset($matches[2]) ? $matches[2] : '';
        return ' ('.$index.')'.$ext;
    }

    protected function upcount_name($name) {
        return preg_replace_callback(
            '/(?:(?: \(([\d]+)\))?(\.[^.]+))?$/',
            array($this, 'upcount_name_callback'),
            $name,
            1
        );
    }

    protected function get_unique_filename($file_path, $name, $size, $type, $error,
            $index, $content_range) {
        while(is_dir($this->get_upload_path($name))) {
            $name = $this->upcount_name($name);
        }
        // Keep an existing filename if this is part of a chunked upload:
        $uploaded_bytes = $this->fix_integer_overflow(intval($content_range[1]));
        while(is_file($this->get_upload_path($name))) {
            if ($uploaded_bytes === $this->get_file_size(
                    $this->get_upload_path($name))) {
                break;
            }
            $name = $this->upcount_name($name);
        }
        return $name;
    }

    protected function trim_file_name($file_path, $name, $size, $type, $error,
            $index, $content_range) {
        // Remove path information and dots around the filename, to prevent uploading
        // into different directories or replacing hidden system files.
        // Also remove control characters and spaces (\x00..\x20) around the filename:
        $name = trim(basename(stripslashes($name)), ".\x00..\x20");
        // Use a timestamp for empty filenames:
        if (!$name) {
            $name = str_replace('.', '-', microtime(true));
        }
        // Add missing file extension for known image types:
        if (strpos($name, '.') === false &&
                preg_match('/^image\/(gif|jpe?g|png)/', $type, $matches)) {
            $name .= '.'.$matches[1];
        }
        if (function_exists('exif_imagetype')) {
            switch(@exif_imagetype($file_path)){
                case IMAGETYPE_JPEG:
                    $extensions = array('jpg', 'jpeg');
                    break;
                case IMAGETYPE_PNG:
                    $extensions = array('png');
                    break;
                case IMAGETYPE_GIF:
                    $extensions = array('gif');
                    break;
            }
            // Adjust incorrect image file extensions:
            if (!empty($extensions)) {
                $parts = explode('.', $name);
                $extIndex = count($parts) - 1;
                $ext = strtolower(@$parts[$extIndex]);
                if (!in_array($ext, $extensions)) {
                    $parts[$extIndex] = $extensions[0];
                    $name = implode('.', $parts);
                }
            }
        }
        return $name;
    }

    protected function get_file_name($file_path, $name, $size, $type, $error,
            $index, $content_range) {
        return $this->get_unique_filename(
            $file_path,
            $this->trim_file_name($file_path, $name, $size, $type, $error,
                $index, $content_range),
            $size,
            $type,
            $error,
            $index,
            $content_range
        );
    }

    protected function handle_form_data($file, $index) {
        // Handle form data, e.g. $_REQUEST['description'][$index]
    }

    protected function get_scaled_image_file_paths($file_name, $version) {
        $file_path = $this->get_upload_path($file_name);
        if (!empty($version)) {
            $version_dir = $this->get_upload_path(null, $version);
            if (!is_dir($version_dir)) {
                mkdir($version_dir, $this->options['mkdir_mode'], true);
            }
            $new_file_path = $version_dir.'/'.$file_name;
        } else {
            $new_file_path = $file_path;
        }
        return array($file_path, $new_file_path);
    }

    protected function gd_get_image_object($file_path, $func, $no_cache = false) {
        if (empty($this->image_objects[$file_path]) || $no_cache) {
            $this->gd_destroy_image_object($file_path);
            $this->image_objects[$file_path] = $func($file_path);
        }
        return $this->image_objects[$file_path];
    }

    protected function gd_set_image_object($file_path, $image) {
        $this->gd_destroy_image_object($file_path);
        $this->image_objects[$file_path] = $image;
    }

    protected function gd_destroy_image_object($file_path) {
        $image = @$this->image_objects[$file_path];
        return $image && imagedestroy($image);
    }

    protected function gd_imageflip($image, $mode) {
        if (function_exists('imageflip')) {
            return imageflip($image, $mode);
        }
        $new_width = $src_width = imagesx($image);
        $new_height = $src_height = imagesy($image);
        $new_img = imagecreatetruecolor($new_width, $new_height);
        $src_x = 0;
        $src_y = 0;
        switch ($mode) {
            case '1': // flip on the horizontal axis
                $src_y = $new_height - 1;
                $src_height = -$new_height;
                break;
            case '2': // flip on the vertical axis
                $src_x  = $new_width - 1;
                $src_width = -$new_width;
                break;
            case '3': // flip on both axes
                $src_y = $new_height - 1;
                $src_height = -$new_height;
                $src_x  = $new_width - 1;
                $src_width = -$new_width;
                break;
            default:
                return $image;
        }
        imagecopyresampled(
            $new_img,
            $image,
            0,
            0,
            $src_x,
            $src_y,
            $new_width,
            $new_height,
            $src_width,
            $src_height
        );
        return $new_img;
    }

    protected function gd_orient_image($file_path, $src_img) {
        if (!function_exists('exif_read_data')) {
            return false;
        }
        $exif = @exif_read_data($file_path);
        if ($exif === false) {
            return false;
        }
        $orientation = intval(@$exif['Orientation']);
        if ($orientation < 2 || $orientation > 8) {
            return false;
        }
        switch ($orientation) {
            case 2:
                $new_img = $this->gd_imageflip(
                    $src_img,
                    defined('IMG_FLIP_VERTICAL') ? IMG_FLIP_VERTICAL : 2
                );
                break;
            case 3:
                $new_img = imagerotate($src_img, 180, 0);
                break;
            case 4:
                $new_img = $this->gd_imageflip(
                    $src_img,
                    defined('IMG_FLIP_HORIZONTAL') ? IMG_FLIP_HORIZONTAL : 1
                );
                break;
            case 5:
                $tmp_img = $this->gd_imageflip(
                    $src_img,
                    defined('IMG_FLIP_HORIZONTAL') ? IMG_FLIP_HORIZONTAL : 1
                );
                $new_img = imagerotate($tmp_img, 270, 0);
                imagedestroy($tmp_img);
                break;
            case 6:
                $new_img = imagerotate($src_img, 270, 0);
                break;
            case 7:
                $tmp_img = $this->gd_imageflip(
                    $src_img,
                    defined('IMG_FLIP_VERTICAL') ? IMG_FLIP_VERTICAL : 2
                );
                $new_img = imagerotate($tmp_img, 270, 0);
                imagedestroy($tmp_img);
                break;
            case 8:
                $new_img = imagerotate($src_img, 90, 0);
                break;
            default:
                return false;
        }
        $this->gd_set_image_object($file_path, $new_img);
        return true;
    }

    protected function gd_create_scaled_image($file_name, $version, $options) {
        if (!function_exists('imagecreatetruecolor')) {
            error_log('Function not found: imagecreatetruecolor');
            return false;
        }
        list($file_path, $new_file_path) =
            $this->get_scaled_image_file_paths($file_name, $version);
        $type = strtolower(substr(strrchr($file_name, '.'), 1));
        switch ($type) {
            case 'jpg':
            case 'jpeg':
                $src_func = 'imagecreatefromjpeg';
                $write_func = 'imagejpeg';
                $image_quality = isset($options['jpeg_quality']) ?
                    $options['jpeg_quality'] : 75;
                break;
            case 'gif':
                $src_func = 'imagecreatefromgif';
                $write_func = 'imagegif';
                $image_quality = null;
                break;
            case 'png':
                $src_func = 'imagecreatefrompng';
                $write_func = 'imagepng';
                $image_quality = isset($options['png_quality']) ?
                    $options['png_quality'] : 9;
                break;
            default:
                return false;
        }
        $src_img = $this->gd_get_image_object(
            $file_path,
            $src_func,
            !empty($options['no_cache'])
        );
        $image_oriented = false;
        if (!empty($options['auto_orient']) && $this->gd_orient_image(
                $file_path,
                $src_img
            )) {
            $image_oriented = true;
            $src_img = $this->gd_get_image_object(
                $file_path,
                $src_func
            );
        }
        $max_width = $img_width = imagesx($src_img);
        $max_height = $img_height = imagesy($src_img);
        if (!empty($options['max_width'])) {
            $max_width = $options['max_width'];
        }
        if (!empty($options['max_height'])) {
            $max_height = $options['max_height'];
        }
        $scale = min(
            $max_width / $img_width,
            $max_height / $img_height
        );
        if ($scale >= 1) {
            if ($image_oriented) {
                return $write_func($src_img, $new_file_path, $image_quality);
            }
            if ($file_path !== $new_file_path) {
                return copy($file_path, $new_file_path);
            }
            return true;
        }
        if (empty($options['crop'])) {
            $new_width = $img_width * $scale;
            $new_height = $img_height * $scale;
            $dst_x = 0;
            $dst_y = 0;
            $new_img = imagecreatetruecolor(569, 364);
        } else {
            if (($img_width / $img_height) >= ($max_width / $max_height)) {
                $new_width = $img_width / ($img_height / $max_height);
                $new_height = $max_height;
            } else {
                $new_width = $max_width;
                $new_height = $img_height / ($img_width / $max_width);
            }
            $dst_x = 0 - ($new_width - $max_width) / 2;
            $dst_y = 0 - ($new_height - $max_height) / 2;
            $new_img = imagecreatetruecolor(569, 364);
        }
        // Handle transparency in GIF and PNG images:
        switch ($type) {
            case 'gif':
            case 'png':
                imagecolortransparent($new_img, imagecolorallocate($new_img, 0, 0, 0));
            case 'png':
                imagealphablending($new_img, false);
                imagesavealpha($new_img, true);
                break;
        }
        $success = imagecopyresampled(
            $new_img,
            $src_img,
            $dst_x,
            $dst_y,
            0,
            0,
           569,
           364,
            $img_width,
            $img_height
        ) && $write_func($new_img, $new_file_path, $image_quality);
        $this->gd_set_image_object($file_path, $new_img);
        return $success;
    }

    protected function imagick_get_image_object($file_path, $no_cache = false) {
        if (empty($this->image_objects[$file_path]) || $no_cache) {
            $this->imagick_destroy_image_object($file_path);
            $image = new \Imagick();
            if (!empty($this->options['imagick_resource_limits'])) {
                foreach ($this->options['imagick_resource_limits'] as $type => $limit) {
                    $image->setResourceLimit($type, $limit);
                }
            }
            $image->readImage($file_path);
            $this->image_objects[$file_path] = $image;
        }
        return $this->image_objects[$file_path];
    }

    protected function imagick_set_image_object($file_path, $image) {
        $this->imagick_destroy_image_object($file_path);
        $this->image_objects[$file_path] = $image;
    }

    protected function imagick_destroy_image_object($file_path) {
        $image = @$this->image_objects[$file_path];
        return $image && $image->destroy();
    }

    protected function imagick_orient_image($image) {
        $orientation = $image->getImageOrientation();
        $background = new \ImagickPixel('none');
        switch ($orientation) {
            case \imagick::ORIENTATION_TOPRIGHT: // 2
                $image->flopImage(); // horizontal flop around y-axis
                break;
            case \imagick::ORIENTATION_BOTTOMRIGHT: // 3
                $image->rotateImage($background, 180);
                break;
            case \imagick::ORIENTATION_BOTTOMLEFT: // 4
                $image->flipImage(); // vertical flip around x-axis
                break;
            case \imagick::ORIENTATION_LEFTTOP: // 5
                $image->flopImage(); // horizontal flop around y-axis
                $image->rotateImage($background, 270);
                break;
            case \imagick::ORIENTATION_RIGHTTOP: // 6
                $image->rotateImage($background, 90);
                break;
            case \imagick::ORIENTATION_RIGHTBOTTOM: // 7
                $image->flipImage(); // vertical flip around x-axis
                $image->rotateImage($background, 270);
                break;
            case \imagick::ORIENTATION_LEFTBOTTOM: // 8
                $image->rotateImage($background, 270);
                break;
            default:
                return false;
        }
        $image->setImageOrientation(\imagick::ORIENTATION_TOPLEFT); // 1
        return true;
    }

    protected function imagick_create_scaled_image($file_name, $version, $options) {
        list($file_path, $new_file_path) =
            $this->get_scaled_image_file_paths($file_name, $version);
        $image = $this->imagick_get_image_object(
            $file_path,
            !empty($options['no_cache'])
        );
        if ($image->getImageFormat() === 'GIF') {
            // Handle animated GIFs:
            $images = $image->coalesceImages();
            foreach ($images as $frame) {
                $image = $frame;
                $this->imagick_set_image_object($file_name, $image);
                break;
            }
        }
        $image_oriented = false;
        if (!empty($options['auto_orient'])) {
            $image_oriented = $this->imagick_orient_image($image);
        }
        $new_width = $max_width = $img_width = $image->getImageWidth();
        $new_height = $max_height = $img_height = $image->getImageHeight();
        if (!empty($options['max_width'])) {
            $new_width = $max_width = $options['max_width'];
        }
        if (!empty($options['max_height'])) {
            $new_height = $max_height = $options['max_height'];
        }
        if (!($image_oriented || $max_width < $img_width || $max_height < $img_height)) {
            if ($file_path !== $new_file_path) {
                return copy($file_path, $new_file_path);
            }
            return true;
        }
        $crop = !empty($options['crop']);
        if ($crop) {
            $x = 0;
            $y = 0;
            if (($img_width / $img_height) >= ($max_width / $max_height)) {
                $new_width = 0; // Enables proportional scaling based on max_height
                $x = ($img_width / ($img_height / $max_height) - $max_width) / 2;
            } else {
                $new_height = 0; // Enables proportional scaling based on max_width
                $y = ($img_height / ($img_width / $max_width) - $max_height) / 2;
            }
        }
        $success = $image->resizeImage(
            $new_width,
            $new_height,
            isset($options['filter']) ? $options['filter'] : \imagick::FILTER_LANCZOS,
            isset($options['blur']) ? $options['blur'] : 1,
            $new_width && $new_height // fit image into constraints if not to be cropped
        );
        if ($success && $crop) {
            $success = $image->cropImage(
                $max_width,
                $max_height,
                $x,
                $y
            );
            if ($success) {
                $success = $image->setImagePage($max_width, $max_height, 0, 0);
            }
        }
        $type = strtolower(substr(strrchr($file_name, '.'), 1));
        switch ($type) {
            case 'jpg':
            case 'jpeg':
                if (!empty($options['jpeg_quality'])) {
                    $image->setImageCompression(\imagick::COMPRESSION_JPEG);
                    $image->setImageCompressionQuality($options['jpeg_quality']);
                }
                break;
        }
        if (!empty($options['strip'])) {
            $image->stripImage();
        }
        return $success && $image->writeImage($new_file_path);
    }

    protected function imagemagick_create_scaled_image($file_name, $version, $options) {
        list($file_path, $new_file_path) =
            $this->get_scaled_image_file_paths($file_name, $version);
        $resize = @$options['max_width']
            .(empty($options['max_height']) ? '' : 'X'.$options['max_height']);
        if (!$resize && empty($options['auto_orient'])) {
            if ($file_path !== $new_file_path) {
                return copy($file_path, $new_file_path);
            }
            return true;
        }
        $cmd = $this->options['convert_bin'];
        if (!empty($this->options['convert_params'])) {
            $cmd .= ' '.$this->options['convert_params'];
        }
        $cmd .= ' '.escapeshellarg($file_path);
        if (!empty($options['auto_orient'])) {
            $cmd .= ' -auto-orient';
        }
        if ($resize) {
            // Handle animated GIFs:
            $cmd .= ' -coalesce';
            if (empty($options['crop'])) {
                $cmd .= ' -resize '.escapeshellarg($resize.'>');
            } else {
                $cmd .= ' -resize '.escapeshellarg($resize.'^');
                $cmd .= ' -gravity center';
                $cmd .= ' -crop '.escapeshellarg($resize.'+0+0');
            }
            // Make sure the page dimensions are correct (fixes offsets of animated GIFs):
            $cmd .= ' +repage';
        }
        if (!empty($options['convert_params'])) {
            $cmd .= ' '.$options['convert_params'];
        }
        $cmd .= ' '.escapeshellarg($new_file_path);
        exec($cmd, $output, $error);
        if ($error) {
            error_log(implode('\n', $output));
            return false;
        }
        return true;
    }

    protected function get_image_size($file_path) {
        if ($this->options['image_library']) {
            if (extension_loaded('imagick')) {
                $image = new \Imagick();
                try {
                    if (@$image->pingImage($file_path)) {
                        $dimensions = array($image->getImageWidth(), $image->getImageHeight());
                        $image->destroy();
                        return $dimensions;
                    }
                    return false;
                } catch (Exception $e) {
                    error_log($e->getMessage());
                }
            }
            if ($this->options['image_library'] === 2) {
                $cmd = $this->options['identify_bin'];
                $cmd .= ' -ping '.escapeshellarg($file_path);
                exec($cmd, $output, $error);
                if (!$error && !empty($output)) {
                    // image.jpg JPEG 1920x1080 1920x1080+0+0 8-bit sRGB 465KB 0.000u 0:00.000
                    $infos = preg_split('/\s+/', $output[0]);
                    $dimensions = preg_split('/x/', $infos[2]);
                    return $dimensions;
                }
                return false;
            }
        }
        if (!function_exists('getimagesize')) {
            error_log('Function not found: getimagesize');
            return false;
        }
        return @getimagesize($file_path);
    }

    protected function create_scaled_image($file_name, $version, $options) {
        if ($this->options['image_library'] === 2) {
            return $this->imagemagick_create_scaled_image($file_name, $version, $options);
        }
        if ($this->options['image_library'] && extension_loaded('imagick')) {
            return $this->imagick_create_scaled_image($file_name, $version, $options);
        }
        return $this->gd_create_scaled_image($file_name, $version, $options);
    }

    protected function destroy_image_object($file_path) {
        if ($this->options['image_library'] && extension_loaded('imagick')) {
            return $this->imagick_destroy_image_object($file_path);
        }
    }

    protected function is_valid_image_file($file_path) {
        if (!preg_match($this->options['image_file_types'], $file_path)) {
            return false;
        }
        if (function_exists('exif_imagetype')) {
            return @exif_imagetype($file_path);
        }
        $image_info = $this->get_image_size($file_path);
        return $image_info && $image_info[0] && $image_info[1];
    }

    protected function handle_image_file($file_path, $file) {
        $failed_versions = array();
        foreach($this->options['image_versions'] as $version => $options) {
            if ($this->create_scaled_image($file->name, $version, $options)) {
                if (!empty($version)) {
                    $file->{$version.'Url'} = $this->get_download_url(
                        $file->name,
                        $version
                    );
                } else {
                    $file->size = $this->get_file_size($file_path, true);
                }
            } else {
                $failed_versions[] = $version ? $version : 'original';
            }
        }
        if (count($failed_versions)) {
            $file->error = $this->get_error_message('image_resize')
                    .' ('.implode($failed_versions,', ').')';
        }
        // Free memory:
        $this->destroy_image_object($file_path);
    }

    protected function handle_file_upload($uploaded_file, $name, $size, $type, $error,
            $index = null, $content_range = null) {
		$file = new stdClass();
        $file->name = $this->get_file_name($uploaded_file, $name, $size, $type, $error,
            $index, $content_range);
			$ext = pathinfo($file->name, PATHINFO_EXTENSION);
			$filename = pathinfo($file->name, PATHINFO_FILENAME);
		
			$filename = strlen($filename)>5?substr($filename,0,5):$filename;
			$num_str = sprintf("%05d", mt_rand(1, 99999));
		 $file->name = $num_str.".".$ext;
		
        $file->size = $this->fix_integer_overflow(intval($size));
        $file->type = $type;
		//print_R($type)
		$typemedia = array();
		$typemedia = explode('/',$type);
		
			$videoextarray = array('mp4','mkv','flv','avi','3gp','MP4','MKV','FLV','AVI','3GP','mov','MOV');
        if ($this->validate($uploaded_file, $file, $error, $index)) {
           
			$modelContentMedia = ClassRegistry::init('UserMedia');
			//$filename = $file->name;
			$current_user_id = CakeSession::read('Auth.WebsitesUser.user_id');
			 $intContentMediaCount = $modelContentMedia->find('count',array('conditions'=>array('usermedia_name'=>$filename,'user_id'=>$current_user_id)));
			$category_id = $_POST['categoryid'];
			$subcategory_id = $_POST['subcategoryid'];
			$subsubcategory_id = $_POST['subsubcategoryid'];
			$medianame = $_POST['medianame'];
			if(trim($medianame)=="")
			{
				$medianame = $filename;
			}
					
			if($intContentMediaCount)
			{
				$file->error = "This File already exists";
			}
			else
			{
				App::import('Vendor', 'ffmpeg/ffmpeg');
				/*if(in_array($ext, $videoextarray))
				{
					App::import('Vendor', 'vimeo/vimeo');
					App::import('Vendor', 'vimeo/cache'); 
					
					$api = $this->api();
				  $video_id = $api->upload($uploaded_file);  
				  $videotitle = "";  
				  $videodesc = "";
				 if ($video_id) 
				  {  
					$sUploadResult = 'Your video has been uploaded and available <a href="http://vimeo.com/'.$video_id.'">here</a> !';  
					$api->call('vimeo.videos.setTitle', array('title' =>$videotitle, 'video_id' => $video_id));  
					$api->call('vimeo.videos.setDescription', array('description' => $videodesc, 'video_id' => $video_id));  
					$videoID = $video_id;   
					//get video image
					$link = "http://vimeo.com/api/v2/video/".$video_id.".php&rel=0";
					$html_returned = unserialize(file_get_contents($link));
					$thumb_url = $html_returned[0]['thumbnail_medium'];
					//$filename = time().'_hbk.jpg';
					//$fullpath = WWW_ROOT.'assets/user/'.$filename;
					//file_put_contents ($fullpath,file_get_contents($thumb_url));
					
					$file_path = "http://vimeo.com/".$video_id;
					//$this->getcropimage($link, $filename); 
					
				  }   
				 else   
				 {  
					  $arry['data']['flag'] = false;  
					  $file_path="";
					  $arry['data']['msg'] = "Not able to retrieve the video status information yet. " ."Please try again later.\n";  
				 } 				  
					
				}
				else
				{*/
					
					$video_id="";
					$this->handle_form_data($file, $index);
					$upload_dir = $this->get_upload_path();
					if (!is_dir($upload_dir)) {
						mkdir($upload_dir, $this->options['mkdir_mode'], true);
					}
					$file_path = $this->get_upload_path($file->name);
				
					$append_file = $content_range && is_file($file_path) &&
						$file->size > $this->get_file_size($file_path);
					if ($uploaded_file && is_uploaded_file($uploaded_file)) {
						// multipart/formdata uploads (POST method uploads)
						if ($append_file) {
							file_put_contents(
								$file_path,
								fopen($uploaded_file, 'r'),
								FILE_APPEND
							);
						} else {
							move_uploaded_file($uploaded_file, $file_path);
							$current_user_id = CakeSession::read('Auth.WebsitesUser.user_id');
							$img_name='IMG_'.date('Y-m-dHis');
							$arr=explode('.', $file->name);
							$img_path='files/'.$current_user_id.'/'.$arr[0].'/00000001.jpg';
							exec('mplayer -ss 2 /home/artformp/public_html/afpf/app/webroot/'.$file_path.' -frames 1 -nosound -vo jpeg:outdir=/home/artformp/public_html/afpf/app/webroot/files/'.$current_user_id.'/'.$arr[0], $output);
							//exec('ffmpeg -ss 4 -i /home/artformp/public_html/afpf/app/webroot/'.$file_path.' output_%04d.png', $output);
							//home/artformp/public_html/afpf/app/webroot/files/3/
						}
					} else {
						// Non-multipart uploads (PUT method support)
						file_put_contents(
							$file_path,
							fopen('php://input', 'r'),
							$append_file ? FILE_APPEND : 0
						);
					}
				
					
					
					$file_size = $this->get_file_size($file_path, $append_file);
					if ($file_size === $file->size) {
						$file->url = $this->get_download_url($file->name);
						if ($this->is_valid_image_file($file_path)) {
							$this->handle_image_file($file_path, $file);
						}
					} else {
						$file->size = $file_size;
						if (!$content_range && $this->options['discard_aborted_uploads']) {
							unlink($file_path);
							$file->error = $this->get_error_message('abort');
						}
					}
				
					if(in_array($ext, $videoextarray))
					{
						$frame_count=1;
						$ffmpeg = new ffmpeg();
						$ffmpeg->ffmpeg_screens('files/3/25863.avi', 'check', 2);
						
					}
					
					
			  /*}*/
					
					$arrFileUploadData = array();
					
					
					
					$arrFileUploadData['UserMedia']['user_id'] = $current_user_id;
					$arrFileUploadData['UserMedia']['category_id'] = $category_id;
					$arrFileUploadData['UserMedia']['subcategory_id'] = $subcategory_id;
					$arrFileUploadData['UserMedia']['subsubcategory_id'] = $subsubcategory_id;
					$arrFileUploadData['UserMedia']['usermedia_name'] = $medianame;
					
					$arrFileUploadData['UserMedia']['usermedia_title'] = $file->name;
					$arrFileUploadData['UserMedia']['usermedia_path'] = $file_path;
					$arrFileUploadData['UserMedia']['usermedia_type'] = $file->type;
					$arrFileUploadData['UserMedia']['video_thumbnail'] = $img_path;
					
					$arrFileUploadData['UserMedia']['usermedia_date'] = date('Y-m-d H:i:s');
					if(isset($_GET['uploadfor']) && ($_GET['uploadfor']))
					{
						$arrFileUploadData['UserMedia']['user_id'] = '';
					}
					
					
					$intFileUploaded = $modelContentMedia->save($arrFileUploadData);
					$file->id = $modelContentMedia->getLastInsertID();
					if($intFileUploaded)
					{
						if(isset($_GET['uploadfor']) && ($_GET['uploadfor']))
						{
							$boolUpdated = $modelContentMedia->updateAll(
								array('cover_id' => "'".$modelContentMedia->getLastInsertID()."'"),
								array('usermedia_id =' => $_GET['uploadfor'])
							);
						}
					}
					
					$this->set_additional_file_properties($file);					
		   }
        }
        return $file;
    }

    protected function readfile($file_path) {
        $file_size = $this->get_file_size($file_path);
        $chunk_size = $this->options['readfile_chunk_size'];
        if ($chunk_size && $file_size > $chunk_size) {
            $handle = fopen($file_path, 'rb');
            while (!feof($handle)) {
                echo fread($handle, $chunk_size);
                @ob_flush();
                @flush();
            }
            fclose($handle);
            return $file_size;
        }
        return readfile($file_path);
    }

    protected function body($str) {
        echo $str;
    }
    
    protected function header($str) {
        header($str);
    }

    protected function get_server_var($id) {
        return isset($_SERVER[$id]) ? $_SERVER[$id] : '';
    }

    protected function generate_response($content, $print_response = true) {
        if ($print_response) {
            $json = json_encode($content);
            $redirect = isset($_REQUEST['redirect']) ?
                stripslashes($_REQUEST['redirect']) : null;
            if ($redirect) {
                $this->header('Location: '.sprintf($redirect, rawurlencode($json)));
                return;
            }
            $this->head();
            if ($this->get_server_var('HTTP_CONTENT_RANGE')) {
                $files = isset($content[$this->options['param_name']]) ?
                    $content[$this->options['param_name']] : null;
                if ($files && is_array($files) && is_object($files[0]) && $files[0]->size) {
                    $this->header('Range: 0-'.(
                        $this->fix_integer_overflow(intval($files[0]->size)) - 1
                    ));
                }
            }
            $this->body($json);
        }
        return $content;
    }

    protected function get_version_param() {
        return isset($_GET['version']) ? basename(stripslashes($_GET['version'])) : null;
    }

    protected function get_singular_param_name() {
        return substr($this->options['param_name'], 0, -1);
    }

    protected function get_file_name_param() {
        $name = $this->get_singular_param_name();
        return isset($_REQUEST[$name]) ? basename(stripslashes($_REQUEST[$name])) : null;
    }

    protected function get_file_names_params() {
        $params = isset($_REQUEST[$this->options['param_name']]) ?
            $_REQUEST[$this->options['param_name']] : array();
        foreach ($params as $key => $value) {
            $params[$key] = basename(stripslashes($value));
        }
        return $params;
    }

    protected function get_file_type($file_path) {
        switch (strtolower(pathinfo($file_path, PATHINFO_EXTENSION))) {
            case 'jpeg':
            case 'jpg':
                return 'image/jpeg';
            case 'png':
                return 'image/png';
            case 'gif':
                return 'image/gif';
            default:
                return '';
        }
    }

    protected function download() {
        switch ($this->options['download_via_php']) {
            case 1:
                $redirect_header = null;
                break;
            case 2:
                $redirect_header = 'X-Sendfile';
                break;
            case 3:
                $redirect_header = 'X-Accel-Redirect';
                break;
            default:
                return $this->header('HTTP/1.1 403 Forbidden');
        }
        $file_name = $this->get_file_name_param();
        if (!$this->is_valid_file_object($file_name)) {
            return $this->header('HTTP/1.1 404 Not Found');
        }
        if ($redirect_header) {
            return $this->header(
                $redirect_header.': '.$this->get_download_url(
                    $file_name,
                    $this->get_version_param(),
                    true
                )
            );
        }
        $file_path = $this->get_upload_path($file_name, $this->get_version_param());
        // Prevent browsers from MIME-sniffing the content-type:
        $this->header('X-Content-Type-Options: nosniff');
        if (!preg_match($this->options['inline_file_types'], $file_name)) {
            $this->header('Content-Type: application/octet-stream');
            $this->header('Content-Disposition: attachment; filename="'.$file_name.'"');
        } else {
            $this->header('Content-Type: '.$this->get_file_type($file_path));
            $this->header('Content-Disposition: inline; filename="'.$file_name.'"');
        }
        $this->header('Content-Length: '.$this->get_file_size($file_path));
        $this->header('Last-Modified: '.gmdate('D, d M Y H:i:s T', filemtime($file_path)));
        $this->readfile($file_path);
    }

    protected function send_content_type_header() {
        $this->header('Vary: Accept');
        if (strpos($this->get_server_var('HTTP_ACCEPT'), 'application/json') !== false) {
            $this->header('Content-type: application/json');
        } else {
            $this->header('Content-type: text/plain');
        }
    }

    protected function send_access_control_headers() {
        $this->header('Access-Control-Allow-Origin: '.$this->options['access_control_allow_origin']);
        $this->header('Access-Control-Allow-Credentials: '
            .($this->options['access_control_allow_credentials'] ? 'true' : 'false'));
        $this->header('Access-Control-Allow-Methods: '
            .implode(', ', $this->options['access_control_allow_methods']));
        $this->header('Access-Control-Allow-Headers: '
            .implode(', ', $this->options['access_control_allow_headers']));
    }

    public function head() {
        $this->header('Pragma: no-cache');
        $this->header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->header('Content-Disposition: inline; filename="files.json"');
        // Prevent Internet Explorer from MIME-sniffing the content-type:
        $this->header('X-Content-Type-Options: nosniff');
        if ($this->options['access_control_allow_origin']) {
            $this->send_access_control_headers();
        }
        $this->send_content_type_header();
    }

    public function get($print_response = true) {
        if ($print_response && isset($_GET['download'])) {
            return $this->download();
        }
        $file_name = $this->get_file_name_param();
        if ($file_name) {
            $response = array(
                $this->get_singular_param_name() => $this->get_file_object($file_name)
            );
        } else {
            $response = array(
                $this->options['param_name'] => $this->get_file_objects()
            );
        }
        return $this->generate_response($response, $print_response);
    }

    public function post($print_response = true) {
	
	
        if (isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE') {
            return $this->delete($print_response);
        }
         $upload = isset($_FILES[$this->options['param_name']]) ?
		
            $_FILES[$this->options['param_name']] : null;
			
        // Parse the Content-Disposition header, if available:
        $file_name = $this->get_server_var('HTTP_CONTENT_DISPOSITION') ?
            rawurldecode(preg_replace(
                '/(^[^"]+")|("$)/',
                '',
                $this->get_server_var('HTTP_CONTENT_DISPOSITION')
            )) : null;
			
        // Parse the Content-Range header, which has the following form:
        // Content-Range: bytes 0-524287/2000000
        $content_range = $this->get_server_var('HTTP_CONTENT_RANGE') ?
            preg_split('/[^0-9]+/', $this->get_server_var('HTTP_CONTENT_RANGE')) : null;
        $size =  $content_range ? $content_range[3] : null;
        $files = array();
        if ($upload && is_array($upload['tmp_name'])) {
            // param_name is an array identifier like "files[]",
            // $_FILES is a multi-dimensional array:
			
            foreach ($upload['tmp_name'] as $index => $value) {				
				$files[] = $this->handle_file_upload(
                    $upload['tmp_name'][$index],
                    $file_name ? $file_name : $upload['name'][$index],
                    $size ? $size : $upload['size'][$index],
                    $upload['type'][$index],
                    $upload['error'][$index],
                    $index,
                    $content_range
                );
            }
        } else {
            // param_name is a single object identifier like "file",
            // $_FILES is a one-dimensional array:
            $files[] = $this->handle_file_upload(
                isset($upload['tmp_name']) ? $upload['tmp_name'] : null,
                $file_name ? $file_name : (isset($upload['name']) ?
                        $upload['name'] : null),
                $size ? $size : (isset($upload['size']) ?
                        $upload['size'] : $this->get_server_var('CONTENT_LENGTH')),
                isset($upload['type']) ?
                        $upload['type'] : $this->get_server_var('CONTENT_TYPE'),
                isset($upload['error']) ? $upload['error'] : null,
                null,
                $content_range
            );
        }
        return $this->generate_response(
            array($this->options['param_name'] => $files),
            $print_response
        );
    }

    public function delete($print_response = true) {
        $file_names = $this->get_file_names_params();
        if (empty($file_names)) {
            $file_names = array($this->get_file_name_param());
        }
        $response = array();
		$modelContentMedia = ClassRegistry::init('UserMedia');
        foreach($file_names as $file_name) {
			$arrFileDetail = $modelContentMedia->find('all',array('conditions'=>array('usermedia_id'=>$file_name)));
			if(is_array($arrFileDetail) && (count($arrFileDetail)>0))
			{
				$arraymediatype = explode('/',$arrFileDetail[0]['UserMedia']['usermedia_type']);
				 if($arraymediatype[0]=="video")
				 {
					 $success='success';
						$this->deletemedia($file_name,"video");
					 $response[$strFileName] = $success;
				 }
				 else
				 {
					$strFileName = $arrFileDetail[0]['UserMedia']['usermedia_title'];
					 $file_path = $this->get_upload_path($strFileName);
					
					$success = is_file($file_path) && $strFileName[0] !== '.' && unlink($file_path);
					if ($success) {
						foreach($this->options['image_versions'] as $version => $options) {
							if (!empty($version)) {
								$file = $this->get_upload_path($strFileName, $version);
								if (is_file($file)) {
									unlink($file);
								}
							}
						}
						$modelContentMedia->deleteAll(array('usermedia_id' => $file_name),false);
					}
					$response[$strFileName] = $success;
				 }
					
			}
			else
			{
				continue;
			}
           
        }
        return $this->generate_response($response, $print_response);
    }

    public function getMedia()
	{
		$current_user_id = CakeSession::read('Auth.WebsitesUser.user_id');
		$modelusermedia = ClassRegistry::init('UserMedia');
		
		$arrFileDetail = $modelusermedia->find('all',array( 
   'fields' => array('UserMedia.*','category.category_name'),
  'joins' => array(
      
	   array(
            'table' => 'category',
            'alias' => 'category',
            'type' => 'inner',
			'recursive' => -1,
            'conditions'=> array('UserMedia.category_id = category.category_id')
      )
    ), 'conditions' =>  array('UserMedia.user_id'=>$current_user_id),'order' => 'UserMedia.usermedia_date desc'));
		
		if(count($arrFileDetail))
		{

		
			foreach($arrFileDetail as $mediakey=>$medialist)
			{
				 $retcover_id = $medialist['UserMedia']['cover_id'];
				
				if($retcover_id>0)
				{
					$arrFileDetail[$mediakey]['children'] = $modelusermedia->find('first',array('fields' => array('UserMedia.usermedia_title','UserMedia.usermedia_path'),'conditions'=>array('usermedia_id'=>$retcover_id)));
					//$arrmediaDetail[$mediakey]['children']= $modelusermedia->find('first', array('fields' => array('UserMedia.usermedia_path','UserMedia.usermedia_title'),array('conditions'=>array('UserMedia./cover_id'=>$retcover_id))));	
				}
				else
				{
					$arrFileDetail[$mediakey]['children']= array();
				}
				
				
			}

		}
	/* 	print_R($arrFileDetail);
		exit(); */
		return $arrFileDetail;
	}
	
	public function deletemedia($usermediaid,$type=NULL)
	{
		
		
		$current_user_id = CakeSession::read('Auth.WebsitesUser.user_id');
		$modelusermedia = ClassRegistry::init('UserMedia');
		$usermedia_path =  $modelusermedia->field('usermedia_path', array('usermedia_id' => $usermediaid));
		/* 
		if($type=="video")
		{
			
				App::import('Vendor', 'vimeo/vimeo');
				App::import('Vendor', 'vimeo/cache');	 
				
				 $usermedia_path =  $modelusermedia->field('usermedia_path', array('usermedia_id' => $usermediaid));
				
				  $videoid = str_replace("http://vimeo.com/",'',$usermedia_path);
				
			try
				{
					
				
					$api = $this->api();
					
					$method = 'vimeo.videos.delete';

					$query = array();
					
					$query['video_id'] = $videoid;

					$r = $api->call($method, $query);

        
				}
				catch (VimeoAPIException $e)
				{
						
						 echo "Encountered an API error -- code {$e->getCode()} - {$e->getMessage()}";
				}	
			
		} */
		
		$filepath= $usermedia_path;
		$arr=explode('.', $filepath);
		unlink($filepath);
		unlink($arr[0]);
		$boolDeletmedia = $modelusermedia->deleteAll(array('user_id'=> $current_user_id ,'usermedia_id'=> $usermediaid ),false);
		return $boolDeletmedia;
	}
	
	public function admindeletemedia($usermediaid,$type=NULL)
	{
		
		$modelusermedia = ClassRegistry::init('UserMedia');
		$usermedia_path =  $modelusermedia->field('usermedia_path', array('usermedia_id' => $usermediaid));
		$filepath= $usermedia_path;
		unlink($filepath);
		
		$boolDeletmedia = $modelusermedia->deleteAll(array('usermedia_id'=> $usermediaid ),false);
		return $boolDeletmedia;
	}
	
	
	public function getRecentMedia()
	{
		$current_user_id = CakeSession::read('Auth.WebsitesUser.user_id');
		$modelusermedia = ClassRegistry::init('UserMedia');
		//$arrmediaDetail = $modelusermedia->find('all',array('conditions'=>array('NOT' => array('user_id'=>$current_user_id)),'order' => 'usermedia_date desc','limit' => 8));
		
		$arrmediaDetail = $modelusermedia->find('all',array( 
   'fields' => array('UserMedia.*','users.user_fname','users.user_lname','users.user_id','category.category_name'),
  'joins' => array(
        array(
            'table' => 'users',
            'alias' => 'users',
            'type' => 'inner',
			'recursive' => -1,
            'conditions'=> array('users.user_id = UserMedia.user_id')
      ),
	   array(
            'table' => 'category',
            'alias' => 'category',
            'type' => 'inner',
			'recursive' => -1,
            'conditions'=> array('users.category_id = category.category_id')
      )
    ), 'conditions' =>  array(),'order' => 'UserMedia.usermedia_date desc','limit' => 8));
	/* echo "<pre>";
	print_r($arrmediaDetail);
	exit(); */
		return $arrmediaDetail;	
}

public function getmyrecentuploads()
{
			$current_user_id = CakeSession::read('Auth.WebsitesUser.user_id');
			$usertype_id = CakeSession::read('Auth.WebsitesUser.usertype_id');
			
		$modelusermedia = ClassRegistry::init('UserMedia');
		//$arrmediaDetail = $modelusermedia->find('all',array('conditions'=>array('NOT' => array('user_id'=>$current_user_id)),'order' => 'usermedia_date desc','limit' => 8));
		if($usertype_id==2)
		{
			$condition = "UserMedia.user_id=".$current_user_id;
		}
		else if($usertype_id==3)
		{
			 $modelusermediacat = ClassRegistry::init('usercategories');
			 $catDetail = $modelusermediacat->find('all',array('fields' =>array('category_id'),'conditions'=>array('user_id'=>$current_user_id)));
			 foreach($catDetail as $cats)
			 {
		
		        $catarray[] = $cats['usercategories']['category_id'];
				
		
			 }
			 //$condition = array('IN' => array('category.category_id'=>$catarray));
			 $condition = array('UserMedia.category_id' => $catarray);
		}
		
		
		$arrmediaDetail = $modelusermedia->find('all',array( 
   'fields' => array('UserMedia.*','users.user_fname','users.user_lname','users.user_id','users.user_display_name','category.category_name'),
  'joins' => array(
        array(
            'table' => 'users',
            'alias' => 'users',
            'type' => 'inner',
			'recursive' => -1,
            'conditions'=> array('users.user_id = UserMedia.user_id')
      ),
	   array(
            'table' => 'category',
            'alias' => 'category',
            'type' => 'inner',
			'recursive' => -1,
            'conditions'=> array('UserMedia.category_id = category.category_id')
      )
    ), 'conditions' =>  array($condition),'order' => 'UserMedia.usermedia_date desc','limit' => 20));
	
	if(count($arrmediaDetail))
	{

	
		foreach($arrmediaDetail as $mediakey=>$medialist)
		{
			 $retcover_id = $medialist['UserMedia']['cover_id'];
			 		
			$condition = "UserMedia.cover_id=".$retcover_id;
			if($retcover_id>0)
			{
				$arrmediaDetail[$mediakey]['children'] = $modelusermedia->find('first',array('fields' => array('UserMedia.usermedia_title','UserMedia.usermedia_path'),'conditions'=>array('usermedia_id'=>$retcover_id)));
				
			}
			else
			{
				$arrmediaDetail[$mediakey]['children']= array();
			}
			
			
		}

		
		
		
	}

		return $arrmediaDetail;	
}



public function getartistrecentuploads($current_user_id )
{
			
		$modelusermedia = ClassRegistry::init('UserMedia');
		//$arrmediaDetail = $modelusermedia->find('all',array('conditions'=>array('NOT' => array('user_id'=>$current_user_id)),'order' => 'usermedia_date desc','limit' => 8));
		$condition = "UserMedia.user_id=".$current_user_id;
		$arrmediaDetail = $modelusermedia->find('all',array( 
   'fields' => array('UserMedia.*','users.user_fname','users.user_lname','users.user_id','users.user_display_name','category.category_name','subcategory.subcategory_name','subsubcategory.subsubcategory_name'),
  'joins' => array(
        array(
            'table' => 'users',
            'alias' => 'users',
            'type' => 'inner',
			'recursive' => -1,
            'conditions'=> array('users.user_id = UserMedia.user_id')
      ),
	   array(
            'table' => 'category',
            'alias' => 'category',
            'type' => 'inner',
			'recursive' => -1,
            'conditions'=> array('UserMedia.category_id = category.category_id')
      ),
	   array(
            'table' => 'subcategory',
            'alias' => 'subcategory',
            'type' => 'left',
			'recursive' => -1,
            'conditions'=> array('UserMedia.subcategory_id = subcategory.subcategory_id')
      ),
	    array(
            'table' => 'subsubcategory',
            'alias' => 'subsubcategory',
            'type' => 'left',
			'recursive' => -1,
            'conditions'=> array('UserMedia.subsubcategory_id = subsubcategory.subsubcategory_id')
      )
    ), 'conditions' =>  array($condition),'order' => 'UserMedia.usermedia_date desc','limit' => 20));
	
	if(count($arrmediaDetail))
	{

	
		foreach($arrmediaDetail as $mediakey=>$medialist)
		{
			 $retcover_id = $medialist['UserMedia']['cover_id'];
			 		
			$condition = "UserMedia.cover_id=".$retcover_id;
			if($retcover_id>0)
			{
				$arrmediaDetail[$mediakey]['children'] = $modelusermedia->find('first',array('fields' => array('UserMedia.usermedia_title','UserMedia.usermedia_path'),'conditions'=>array('usermedia_id'=>$retcover_id)));
				
			}
			else
			{
				$arrmediaDetail[$mediakey]['children']= array();
			}
			
			
		}

		
		
		
	}

		return $arrmediaDetail;	
}



public function getCheckRecentMedia()
	{
		
		$page					=	intval( $_POST['page'] );
	
		$current_page			=	$page;
		 $records_per_page		=	8; // records to show per page
		 //$start					=	$current_page * $records_per_page;
		 
		 if($page==0)
		 {
			 $start=0;
			
		 }
		 else if($page==1)
		 {
			 $start=8;
			
		 }
		 else if($page>=2)
		 {
			$start = $page*8;
			
		 }
		
		$current_user_id = CakeSession::read('Auth.WebsitesUser.user_id');
		$modelusermedia = ClassRegistry::init('UserMedia');
		
		//$arrmediaDetail = $modelusermedia->find('all',array('conditions'=>array('NOT' => array('user_id'=>$current_user_id)),'order' => 'usermedia_date desc','limit' => 8));
		 $strQuery="Select UserMedia . * , users.user_fname, users.user_lname, users.user_display_name, users.user_id, category.category_name, category.category_id, subsubcategory.subsubcategory_name from appap14_usermedia as UserMedia inner join appap14_users  as users  on users.user_id = UserMedia.user_id inner join appap14_category as category on  UserMedia.category_id = category.category_id 
		 left join appap14_subsubcategory as subsubcategory on UserMedia.subsubcategory_id = subsubcategory.subsubcategory_id
		 order by UserMedia.usermedia_date desc limit $start, 8";

		
		
		
			$arrmediaDetail = $modelusermedia->query($strQuery);
			
		
		/*$arrmediaDetail = $modelusermedia->find('all',array( 
   'fields' => array('UserMedia.*','users.user_fname','users.user_lname','users.user_display_name','users.user_id','category.category_name'),
  'joins' => array(
        array(
            'table' => 'users',
            'alias' => 'users',
            'type' => 'inner',
			'recursive' => -1,
            'conditions'=> array('users.user_id = UserMedia.user_id')
      ),
	   array(
            'table' => 'category',
            'alias' => 'category',
            'type' => 'inner',
			'recursive' => -1,
            'conditions'=> array('UserMedia.category_id = category.category_id')
      )
	 
    ), 'conditions' =>  array(),'order' => 'UserMedia.usermedia_date desc', 'limit' => $start.','.$end));*/
	

	
	if(count($arrmediaDetail))
	{

	
		foreach($arrmediaDetail as $mediakey=>$medialist)
		{
			 $retcover_id = $medialist['UserMedia']['cover_id'];
			 		
			$condition = "UserMedia.cover_id=".$retcover_id;
			if($retcover_id>0)
			{
				$arrmediaDetail[$mediakey]['children'] = $modelusermedia->find('first',array('fields' => array('UserMedia.usermedia_title','UserMedia.usermedia_path'),'conditions'=>array('usermedia_id'=>$retcover_id)));
				
			}
			else
			{
				$arrmediaDetail[$mediakey]['children']= array();
			}
			
			
		}

		
		
		
	}
	return $arrmediaDetail;
	
	
	
}

public function getRecentMediabyCategory($categoryid,$catname)
{
	
	switch($catname)
	{
		 case 'category':
		         $condition = "UserMedia.category_id =".$categoryid;
				 break;
		
		case 'subcategory':
		         $condition = "UserMedia.subcategory_id =".$categoryid;
				 break;
				 
		case 'subsubcategory':
		
		         $condition = "UserMedia.subsubcategory_id =".$categoryid;
				 break;	 
		
	}
		$current_user_id = CakeSession::read('Auth.WebsitesUser.user_id');
		$modelusermedia = ClassRegistry::init('UserMedia');
		//$arrmediaDetail = $modelusermedia->find('all',array('conditions'=>array('NOT' => array('user_id'=>$current_user_id)),'order' => 'usermedia_date desc','limit' => 8));
		
		$arrmediaDetail = $modelusermedia->find('all',array( 
   'fields' => array('UserMedia.*','users.user_fname','users.user_lname','users.user_display_name','users.user_id','category.category_name','subcategory.subcategory_name','subsubcategory.subsubcategory_name'),
  'joins' => array(
        array(
            'table' => 'users',
            'alias' => 'users',
            'type' => 'inner',
			'recursive' => -1,
            'conditions'=> array('users.user_id = UserMedia.user_id')
      ),
	   array(
            'table' => 'category',
            'alias' => 'category',
            'type' => 'inner',
			'recursive' => -1,
            'conditions'=> array('UserMedia.category_id = category.category_id')
      ),array(
            'table' => 'subcategory',
            'alias' => 'subcategory',
            'type' => 'left',
			'recursive' => -1,
            'conditions'=> array('UserMedia.subcategory_id = subcategory.subcategory_id')
      ),
	   array(
            'table' => 'subsubcategory',
            'alias' => 'subsubcategory',
            'type' => 'left',
			'recursive' => -1,
            'conditions'=> array('UserMedia.subsubcategory_id = subsubcategory.subsubcategory_id')
      )
    ), 'conditions' =>  array($condition),'order' => 'UserMedia.usermedia_date desc','limit' => 8));
	
	/* print_r($arrmediaDetail);
	exit(); */
//	return $arrmediaDetail;	
	if(count($arrmediaDetail))
	{

	
		foreach($arrmediaDetail as $mediakey=>$medialist)
		{
			 $retcover_id = $medialist['UserMedia']['cover_id'];
			 		
			$condition = "UserMedia.cover_id=".$retcover_id;
			if($retcover_id>0)
			{
				$arrmediaDetail[$mediakey]['children'] = $modelusermedia->find('first',array('fields' => array('UserMedia.usermedia_title','UserMedia.usermedia_path'),'conditions'=>array('usermedia_id'=>$retcover_id)));
				//$arrmediaDetail[$mediakey]['children']= $modelusermedia->find('first', array('fields' => array('UserMedia.usermedia_path','UserMedia.usermedia_title'),array('conditions'=>array('UserMedia./cover_id'=>$retcover_id))));	
			}
			else
			{
				$arrmediaDetail[$mediakey]['children']= array();
			}
			
			
		}

		
		
		
	}
	/* print_r($arrmediaDetail);
	exit(); */
	return $arrmediaDetail;
	
}


public function fnaverageratedmedia($catname,$categoryid,$limit)
{
	$modelusermedia = ClassRegistry::init('UserMedia');
	$condition = "";
	switch($catname)
	{
		 case 'category':
		         $condition = "UserMedia.category_id =".$categoryid;
				 		 
				 break;
		
		case 'subcategory':
	         $condition = "UserMedia.subcategory_id =".$categoryid;
			
				 break;
				 
		case 'subsubcategory':
		
		         $condition = "UserMedia.subsubcategory_id =".$categoryid;
				 break;
		case '':
		         $condition = 1;
				
				 break;	 				 
		
	}
	$arrmediaDetail =	$modelusermedia->topuseraveragemedia($condition,$limit);
	/*  echo "<pre>";
	print_r($arrmediaDetail);
	exit(); */
		
		
	return $arrmediaDetail;	
}

	public function fntopaveragedmedia($catname,$categoryid,$limit)
	{
		$condition = "";
			switch($catname)
			{
				case 'category':
		         $condition = "UserMedia.category_id =".$categoryid;
				
				 
				 break;
		
		case 'subcategory':
		         $condition = "UserMedia.subcategory_id =".$categoryid;
					
				 break;
				 
		case 'subsubcategory':
		
		         $condition = "UserMedia.subsubcategory_id =".$categoryid;
					
				 break;
		default:
		         $condition = 1;
						 
		         break;		
			}
	
		$modelusermedia = ClassRegistry::init('UserMedia');
		$modelmediacomment = ClassRegistry::init('MediaComment');
		
		
	$arrmediaDetail =	$modelusermedia->topaveragemedia($condition,$limit);
/*    echo "<pre>";
	print_r($arrmediaDetail);
	exit();   */
	
	if(count($arrmediaDetail))
	{
			 $retusermedia_id	= $arrmediaDetail[0]['UserMedia']['usermedia_id'];
			
				$arrmediaDetail['children']= $modelmediacomment->find('all',array( 
	   'fields' => array('MediaComment.usermedia_comment', 'MediaComment.mediacomment_id', 'Users.user_fname','Users.user_lname','Users.user_display_name', 'Users.user_id','Users.usertype_id','Users.user_image','Users.user_cropped_image'),
	  'joins' => array(
			array(
				'table' => 'users',
				'alias' => 'Users',
				'type' => 'inner',
				'recursive' => -1,
				'conditions'=> array('Users.user_id = MediaComment.user_id')
			)
			), 'conditions' =>  array('MediaComment.usermedia_id' =>$retusermedia_id ), 'order'=>array('MediaComment.created DESC'), 'limit'=>100));
		/* echo "<pre>";
		print_r($arrmediaDetail);
		exit(); */
	}
	return $arrmediaDetail;	
}
	
	
	
	 public function getMediaPath($usermedia_id)
	{
		$modelusermedia = ClassRegistry::init('UserMedia');
		$userpath = $modelusermedia->find('first',array('conditions'=>array('usermedia_id'=>$usermedia_id)));
		return $userpath['UserMedia']['usermedia_path'];
		
	}
	
	public function uploadedmediabyuser($userid)
	{
		$modelusermedia = ClassRegistry::init('UserMedia');
		$modelrating = ClassRegistry::init('MediaRating');
		
		$current_user_id = CakeSession::read('Auth.WebsitesUser.user_id');
		$condition = "UserMedia.user_id =".$userid;
		$arrmediaDetail = $modelusermedia->useraveragemedia($userid,10);
		/*  echo "<pre>";
		print_r($arrmediaDetail);
		exit();  */
		foreach($arrmediaDetail as $mediakey=>$medialist)
		{
			$retmediaid = $medialist['UserMedia']['usermedia_id'];
			$condition = " usermedia_id=".$retmediaid;
			$condition = $current_user_id>0?$condition." and user_id =".$current_user_id:$condition;
		$arrmediaDetail[$mediakey]['children']	= $modelrating->find('first',array( 
		   'fields' => array('avg(media_rating) as media_rating','mediarating_id'),'conditions' =>  $condition));	
		}
	
		return $arrmediaDetail;
	}
	
	
	public function mypageuploadedmediabyuser($userid)
	{
		$modelusermedia = ClassRegistry::init('UserMedia');
		$modelrating = ClassRegistry::init('MediaRating');
		
		$current_user_id = CakeSession::read('Auth.WebsitesUser.user_id');
		$condition = "UserMedia.user_id =".$userid;
		$arrmediaDetail = $modelusermedia->useraveragemedia($userid,100);

		foreach($arrmediaDetail as $mediakey=>$medialist)
		{
			$retmediaid = $medialist['UserMedia']['usermedia_id'];
			$condition = " usermedia_id=".$retmediaid;
			
			$arrmediaDetail[$mediakey]['children']	= $modelrating->find('first',array( 
		   'fields' => array('avg(media_rating) as media_rating','mediarating_id'),'conditions' =>  $condition));	
		}
		
 
		return $arrmediaDetail;
	}
	public function uploadedavgmediabyuser($userid)
	{
		$modelusermedia = ClassRegistry::init('UserMedia');
		
		$current_user_id = CakeSession::read('Auth.WebsitesUser.user_id');
	
     $modelmediacomment = ClassRegistry::init('MediaComment');
	 $condition = "UserMedia.user_id =".$userid;
	 
	$arrmediaDetail = $modelusermedia->useraveragemedia($userid,1);

	if(count($arrmediaDetail))
	{
			 $retusermedia_id	= $arrmediaDetail[0]['UserMedia']['usermedia_id'];
			
				$arrmediaDetail['children']= $modelmediacomment->find('all',array( 
	   'fields' => array('MediaComment.usermedia_comment', 'MediaComment.mediacomment_id', 'Users.user_fname','Users.user_lname', 'Users.user_display_name',  'Users.user_id','Users.usertype_id','Users.user_image','Users.user_cropped_image'),
	  'joins' => array(
			array(
				'table' => 'users',
				'alias' => 'Users',
				'type' => 'inner',
				'recursive' => -1,
				'conditions'=> array('Users.user_id = MediaComment.user_id')
			)
			), 'conditions' =>  array('MediaComment.usermedia_id' =>$retusermedia_id ), 'order'=>array('MediaComment.created DESC'), 'limit'=>100));
		 
	}
	/*  echo "<pre>";
		print_r($arrmediaDetail);
		exit();  */
		return $arrmediaDetail;
	}
	
	public function avgmediabyuserdetails($usermedia_id)
	{
		$modelusermedia = ClassRegistry::init('UserMedia');
		
		$current_user_id = CakeSession::read('Auth.WebsitesUser.user_id');
	
     $modelmediacomment = ClassRegistry::init('MediaComment');
 $condition = "UserMedia.usermedia_id =".$usermedia_id;
	
	$arrmediaDetail = $modelusermedia->find('all',array( 
   'fields' => array('UserMedia.*','mrate.media_rating as totalrating','cat.category_name','subcat.subcategory_name','subsubcat.subsubcategory_name','DATEDIFF(CURDATE(),date(UserMedia.usermedia_date)) AS DiffDate','usermedia_cover.usermedia_title','usermedia_cover.usermedia_path'),
  'joins' => array(
       
	  array(
            'table' => 'mediarating',
            'alias' => 'mrate',
            'type' => 'left',
			'recursive' => -1,
            'conditions'=> array('mrate.usermedia_id = UserMedia.usermedia_id')
      ),
	 array(
            'table' => 'category',
            'alias' => 'cat',
            'type' => 'inner',
			'recursive' => -1,
            'conditions'=> array('UserMedia.category_id = cat.category_id')
      ),
	  array(
            'table' => 'subcategory',
            'alias' => 'subcat',
            'type' => 'left',
			'recursive' => -1,
            'conditions'=> array('UserMedia.subcategory_id = subcat.subcategory_id')
      ),
	   array(
            'table' => 'subsubcategory',
            'alias' => 'subsubcat',
            'type' => 'left',
			'recursive' => -1,
            'conditions'=> array('UserMedia.subsubcategory_id = subsubcat.subsubcategory_id')
      ),
	   array(
            'table' => 'usermedia',
            'alias' => 'usermedia_cover',
            'type' => 'left',
			'recursive' => -1,
            'conditions'=> array('UserMedia.cover_id = usermedia_cover.usermedia_id')
      ),
	  array(
				'table' => 'medialikes',
				'alias' => 'medialikes',
				'type' => 'left',
				'recursive' => -1,
				'conditions'=> array('UserMedia.usermedia_id = medialikes.usermedia_id')
			),
	    array(
            'table' => 'mediacomment',
            'alias' => 'mediacomment',
            'type' => 'left',
			'recursive' => -1,
            'conditions'=> array('UserMedia.usermedia_id = mediacomment.usermedia_id')
      )
 
    ),
	 'group' => '`UserMedia`.`usermedia_id`',
	'conditions' =>  array($condition),'order' => 'case 
        when DiffDate=0 then avg(mrate.media_rating)*0.5+ count(mediacomment.user_id)*0.2+ count(medialikes.user_id)*0.3
        when DiffDate>0 then avg(mrate.media_rating)*0.5+ count(mediacomment.user_id)*0.2+ count(medialikes.user_id)*0.3/DiffDate
    end desc','limit' =>1));
/*  echo "<pre>";
		print_r($arrmediaDetail);
		exit();  */
	if(count($arrmediaDetail))
	{
			 $retusermedia_id	= $arrmediaDetail[0]['UserMedia']['usermedia_id'];
			
				$arrmediaDetail['children']= $modelmediacomment->find('all',array( 
	   'fields' => array('MediaComment.usermedia_comment', 'MediaComment.mediacomment_id', 'Users.user_fname','Users.user_lname', 'Users.user_display_name', 'Users.user_id','Users.usertype_id','Users.user_image','Users.user_cropped_image'),
	  'joins' => array(
			array(
				'table' => 'users',
				'alias' => 'Users',
				'type' => 'inner',
				'recursive' => -1,
				'conditions'=> array('Users.user_id = MediaComment.user_id')
			)
			), 'conditions' =>  array('MediaComment.usermedia_id' =>$retusermedia_id ), 'order'=>array('MediaComment.created DESC'), 'limit'=>100));
		
	}
	/* echo "<pre>";
		print_r($arrmediaDetail);
		exit(); */ 	return $arrmediaDetail;
	}
	
	public function uploadedrelatedmedia($usermedia_id)
	{
		$modelusermedia = ClassRegistry::init('UserMedia');
		$modelrating = ClassRegistry::init('MediaRating');
		
		$current_user_id = CakeSession::read('Auth.WebsitesUser.user_id');
		
		
	$retcategory_id = $modelusermedia->field('category_id', array('usermedia_id'=>$usermedia_id));
	 $condition = "UserMedia.category_id =".$retcategory_id." and UserMedia.usermedia_id not in (".$usermedia_id.")";
	 
	 
		$arrmediaDetail = $modelusermedia->find('all',array( 
   'fields' => array('UserMedia.*','avg(mrate.media_rating) as totalrating','cat.category_name','DATEDIFF(CURDATE(),date(UserMedia.usermedia_date)) AS DiffDate'),
  'joins' => array(
       
	  array(
            'table' => 'mediarating',
            'alias' => 'mrate',
            'type' => 'left',
			'recursive' => -1,
            'conditions'=> array('mrate.usermedia_id = UserMedia.usermedia_id')
      ),
	     array(
            'table' => 'category',
            'alias' => 'cat',
            'type' => 'inner',
			'recursive' => -1,
            'conditions'=> array('UserMedia.category_id = cat.category_id')
      ),
	  array(
				'table' => 'medialikes',
				'alias' => 'medialikes',
				'type' => 'left',
				'recursive' => -1,
				'conditions'=> array('UserMedia.usermedia_id = medialikes.usermedia_id')
			),
	    array(
            'table' => 'mediacomment',
            'alias' => 'mediacomment',
            'type' => 'left',
			'recursive' => -1,
            'conditions'=> array('UserMedia.usermedia_id = mediacomment.usermedia_id')
      )
 
    ),
	 'group' => '`UserMedia`.`usermedia_id`',
	'conditions' =>  array($condition),'order' => 'case 
        when DiffDate=0 then avg(mrate.media_rating)*0.5+ count(mediacomment.user_id)*0.2+ count(medialikes.user_id)*0.3
        when DiffDate>0 then avg(mrate.media_rating)*0.5+ count(mediacomment.user_id)*0.2+ count(medialikes.user_id)*0.3/DiffDate
    end desc','limit' =>100));


		foreach($arrmediaDetail as $mediakey=>$medialist)
		{
			$retmediaid = $medialist['UserMedia']['usermedia_id'];
			$condition = " usermedia_id=".$retmediaid;
			$condition = $current_user_id>0?$condition." and user_id =".$current_user_id:$condition;
		$arrmediaDetail[$mediakey]['children']	= $modelrating->find('first',array( 
		   'fields' => array('media_rating','mediarating_id'),'conditions' =>  $condition));	
		}

		return $arrmediaDetail;
	}
	
	
	
	public function uservotedArtist($userid)
	{
		$modelMediaRating = ClassRegistry::init('MediaRating');
		$condition="MediaRating.user_id=".$userid;
		$arrRatingDetail = $modelMediaRating->find('all',array( 
		   'fields' => array('users.user_fname','users.user_lname','users.user_id','users.usertype_id','users.user_cropped_image','category.category_name'),
		  'joins' => array(
				array(
					'table' => 'usermedia',
					'alias' => 'usermedia',
					'type' => 'inner',
					'recursive' => -1,
					'conditions'=> array('MediaRating.usermedia_id = usermedia.usermedia_id')
			  )
			  ,
			  array(
					'table' => 'users',
					'alias' => 'users',
					'type' => 'inner',
					'recursive' => -1,
					'conditions'=> array('users.user_id = usermedia.user_id')
			  ),
			  array(
					'table' => 'category',
					'alias' => 'category',
					'type' => 'inner',
					'recursive' => -1,
					'conditions'=> array('users.category_id = category.category_id')
			  )
			), 
			'group'=>array('usermedia.user_id'),
			'conditions' =>  array($condition),'order' => 'count(MediaRating.media_rating) desc'));
			/*  print_R($arrRatingDetail);
			exit();  */
		return $arrRatingDetail;	
	}
	
	public function fnToGetSubCategoryList($current_user_id)
	{	
		$id=$current_user_id;
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
	
	public function getsearchmedia($searchtext)
	{
			$modelusermedia = ClassRegistry::init('UserMedia');
			$condition = "UserMedia.usermedia_name like '%".$searchtext."%' OR users.user_fname like '%".$searchtext."%' OR users.user_lname like '%".$searchtext."%'";
			$arrmediaDetail = $modelusermedia->find('all',array( 
		   'fields' => array('UserMedia.*','users.user_fname','users.user_lname','users.user_id'),
		  'joins' => array(
				array(
					'table' => 'users',
					'alias' => 'users',
					'type' => 'inner',
					'recursive' => -1,
					'conditions'=> array('users.user_id = UserMedia.user_id')
			  )
			), 'conditions' =>  array($condition),'order' => 'UserMedia.usermedia_date desc','limit' => 10));
			
			
			
			/* echo "<pre>";
			print_r($arrmediaDetail);
			exit(); */ 
				return $arrmediaDetail;	
	}

	
	
	public function api()
	{
		$consumer_key = 'e36dbc96a6248db612e7e8ec9163589f63bc0c12';  
		$consumer_secret = '33db24dc51a539d018c8c5658e0d1e5f816e74d4';  
		$oauth_access_token = '3e8fd05f20417228f49d6ff16f8aa011';  
		$oauth_request_token_secret = 'bc660e740777d58d87d1b6b37de3cc5c9f73012d';  
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

		    
		}

		
	}
?>