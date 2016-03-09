<?php

/*

CometChat
Copyright (c) 2014 Inscripts

CometChat ('the Software') is a copyrighted work of authorship. Inscripts
retains ownership of the Software and any copies of it, regardless of the
form in which the copies may exist. This license is not a sale of the
original Software or any copies.

By installing and using CometChat on your server, you agree to the following
terms and conditions. Such agreement is either on your own behalf or on behalf
of any corporate entity which employs you or which you represent
('Corporate Licensee'). In this Agreement, 'you' includes both the reader
and any Corporate Licensee and 'Inscripts' means Inscripts (I) Private Limited:

CometChat license grants you the right to run one instance (a single installation)
of the Software on one web server and one web site for each license purchased.
Each license may power one instance of the Software on one domain. For each
installed instance of the Software, a separate license is required.
The Software is licensed only to you. You may not rent, lease, sublicense, sell,
assign, pledge, transfer or otherwise dispose of the Software in any form, on
a temporary or permanent basis, without the prior written consent of Inscripts.

The license is effective until terminated. You may terminate it
at any time by uninstalling the Software and destroying any copies in any form.

The Software source code may be altered (at your risk)

All Software copyright notices within the scripts must remain unchanged (and visible).

The Software may not be used for anything that would represent or is associated
with an Intellectual Property violation, including, but not limited to,
engaging in any activity that infringes or misappropriates the intellectual property
rights of others, including copyrights, trademarks, service marks, trade secrets,
software piracy, and patents held by individuals, corporations, or other entities.

If any of the terms of this Agreement are violated, Inscripts reserves the right
to revoke the Software license at any time.

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

*/

if (!defined('CCADMIN')) { echo "NO DICE"; exit; }

global $getstylesheet;
include_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'config.php');

$invalidfile ='';
$changeimage='';
if($branded==0){
	$changeimage='<br><h3 style="border-bottom:0px"><a href="?module=dashboard&amp;action=loadexternal&amp;type=extension&amp;name=desktop&amp;uploadimages=true">Click here</a> to set header images for your white-labelled Desktop Messenger</h3><br>';
}
if(!empty($_REQUEST['invalidfile'])){
	if($_REQUEST['invalidfile'] == 'fileformat'){
    	$invalidfile = '<div>Invalid file or file format. Please try again.</div><div style="clear:both;padding:5px;"></div>';
	}
	if($_REQUEST['invalidfile'] == 'filedimensions'){
    	$invalidfile = '<div>Invalid file dimensions. Please upload files with appropriate dimensions.</div><div style="clear:both;padding:5px;"></div>';
	}
}

if(!empty($_GET['uploadimageprocess'])){
	$allowedExts = array("png","jpg", "jpeg");
	$folderarray=array("size");
	$size = array(200,60);
	$flag = 1;

	if(!empty($_FILES["file"]["name"])){
    	$filename = $_FILES["file"]["name"];
    	$filesize = getimagesize($_FILES["file"]["tmp_name"]);
    	if(($filesize[0] == $size[0]) && ($filesize[1] == $size[1])){
			    $temp = explode(".", $filename);
			    $extension = end($temp);
			    if (!in_array($extension, $allowedExts)) {
			        header("Location:?module=dashboard&action=loadexternal&type=extension&uploadimages=true&name=desktop&invalidfile=fileformat");
			        exit;
			    }
		}else{
			header("Location:?module=dashboard&action=loadexternal&type=extension&uploadimages=true&name=desktop&invalidfile=filedimensions");
		    exit;
		}
	}
	$foldername = $folderarray[0];
	if(!empty($_FILES["file"]["name"])){
	    if ($_FILES["file"]["error"] > 0) {
	    } else {
	        if (file_exists(dirname(__FILE__)."/images/logo_login.png")) {
	        	unlink(dirname(__FILE__)."/images/logo_login.png");
			}
			if (file_exists(dirname(__FILE__)."/images/logo_login.png.jpg")) {
	        	unlink(dirname(__FILE__)."/images/logo_login.jpg");
			}
			if (file_exists(dirname(__FILE__)."/images/logo_login.jpeg")) {
	        	unlink(dirname(__FILE__)."/images/logo_login.jpeg");
			}
	        if(move_uploaded_file($_FILES["file"]["tmp_name"],dirname(__FILE__)."/images/logo_login.$extension")){
	        	$_SESSION['cometchat']['error'] = 'File uploaded successfully';
	        	echo '<script type="text/javascript">window.opener.location.reload();window.close();</script>';
	    	}
	    }
	}
    exit;
}

if(!empty($_GET['uploadimages'])){
	echo <<<EOD
	<!DOCTYPE html>
	$getstylesheet
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<link href="../css.php?admin=1" media="all" rel="stylesheet" type="text/css" />
	<style type="text/css" rel="stylesheet">
	.red{
		color:#F00;
	}
	form{
		padding: 5px;
	}
	.title.device_type{
		padding-top:6px;
		width: 115px;
	}
	</style>
	<script src="../js.php?admin=1"></script>
	<script type="text/javascript" language="javascript">
	    function resizeWindow() {
	        window.resizeTo((510), (($('form').outerHeight(false)+window.outerHeight-window.innerHeight)));
	    }
	    $(function() {
			setTimeout(function(){
				resizeWindow();
			},200);
		});
	</script>
	<form style="height:100%" action="?module=dashboard&action=loadexternal&type=extension&name=desktop&uploadimageprocess=true" method="post" enctype="multipart/form-data">
		<div id="content" style="width:auto">
			<h2>Only for white-labelled Desktop Messenger</h2>
			<br>
			<h3>If you would like to use your own images and colors for the Desktop Messenger, you can make necessary changes here.</h3>
			<label style="color:#F00; font-size:18px">{$invalidfile}</label>
		    <label>Choose Header Image Icon for your Desktop Messenger (Only .png & .jpeg files supported):</label>
            <div style="clear:both;padding:15px;"></div>
            <span class="title device_type">Upload Image Here :</span>
            <input type="file" name="file" id="logo">
            <label><span class="red">* </span>200px x 60px</label><br>
		    <div style="clear:both;padding:15px;"></div>
		    <label style="display:none;"><span class="red">* </span>250px x 50px</label><br>
		    <label style="display:block;float:right">Fields marked with <span class="red">* </span>are compulsory</label>
			<input type="submit" value="Update Settings" class="button">&nbsp;&nbsp;or <a href="?module=dashboard&amp;action=loadexternal&amp;type=extension&amp;name=desktop">Back</a>
		</div>
	</form>
	<script type="text/javascript" language="javascript"> resizeWindow(); </script>
EOD;
exit;
}

if (empty($_GET['process'])) {
echo <<<EOD
<!DOCTYPE html>

$getstylesheet
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<link href="../css.php?admin=1" media="all" rel="stylesheet" type="text/css" />
<style rel="stylesheet" type="text/css">
	html{
		overflow-y: hidden;
	}
	form{
		padding: 5px;
	}
	#content{
		margin: 0;
	}
</style>
<script src="../js.php?admin=1"></script>
<script type="text/javascript" language="javascript">
    function resizeWindow() {
    	window.resizeTo((510), (($('form').outerHeight(false)+window.outerHeight-window.innerHeight)));
    }
    function reset_colors(){
    	$('#login_background_field').val('#FFFFFF');
    	$('#login_placeholder_field').val('#777788');
    	$('#login_button_pressed_field').val('#002832');
    	$('#login_button_text_field').val('#FFFFFF');
    	$('#login_foreground_text_field').val('#000000');
    	$('#dm_details').submit()
    }
    var arr = ['#login_background','#login_placeholder','#login_button_pressed','#login_button_text','#login_foreground_text'];
    var arrColor = ['$login_background','$login_placeholder','$login_button_pressed','$login_button_text','$login_foreground_text'];
    $(function() {

    	$.each(arr,function(i,val){
    		$(val).ColorPicker({
				color: arrColor[i],
				onShow: function (colpkr) {
					$(colpkr).fadeIn(500);
					return false;
				},
				onHide: function (colpkr) {
					$(colpkr).fadeOut(500);
					return false;
				},
				onChange: function (hsb, hex, rgb) {
					$(val+' div').css('backgroundColor', '#' + hex);
					$(val).attr('newcolor','#'+hex);
					$(val+'_field').val('#'+hex.toUpperCase());
				}
			});
    	}) ;

		setTimeout(function(){
			resizeWindow();
		},200);
	});
</script>
<form id="dm_details" action="?module=dashboard&action=loadexternal&type=extension&name=desktop&process=true" method="post" enctype="multipart/form-data">
	<div id="content" style="width:auto;height:100%;">
		<h2>Settings</h2>
		<br>
		<h3>If you would like to use your own images and colors for the Desktop Messenger, you can make necessary changes here.</h3>
		<div>
			<div id="centernav" style="float:none;overflow:hidden;">
				<div class="title" style="padding-top:14px;">Login Color :</div>
				<div class="element">
					<input type="text" class="inputbox themevariables" id="login_background_field" name="login_background" value="$login_background" style="float: right;width: 100px;height:28px" required="true">
					<div class="colorSelector themeSettings" field="login_background" id="login_background">
						<div style="background:$login_background">
						</div>
					</div>
				</div>
			</div>
			<div id="centernav" style="float:none;overflow:hidden;">
				<div class="title" style="padding-top:14px;">Login text hint</div>
				<div class="element">
					<input type="text" class="inputbox themevariables" id="login_placeholder_field" name="login_placeholder" value="$login_placeholder" style="float: right;width: 100px;height:28px" required="true">
					<div class="colorSelector themeSettings" field="login_placeholder" id="login_placeholder">
						<div style="background:$login_placeholder">
						</div>
				</div>
			</div>

			<div id="centernav" style="float:none;overflow:hidden;">
				<div class="title" style="padding-top:14px;">Login button</div>
				<div class="element">
					<input type="text" class="inputbox themevariables" id="login_button_pressed_field" name="login_button_pressed" value="$login_button_pressed" style="float: right;width: 100px;height:28px" required="true">
					<div class="colorSelector themeSettings" field="login_button_pressed" id="login_button_pressed">
						<div style="background:$login_button_pressed">
						</div>
				</div>
			</div>

			<div id="centernav" style="float:none;overflow:hidden;">
				<div class="title" style="padding-top:14px;">Login button text</div>
				<div class="element">
					<input type="text" class="inputbox themevariables" id="login_button_text_field" name="login_button_text" value="$login_button_text" style="float: right;width: 100px;height:28px" required="true">
					<div class="colorSelector themeSettings" field="login_button_text" id="login_button_text">
						<div style="background:$login_button_text">
						</div>
				</div>
			</div>

			<div id="centernav" style="float:none;overflow:hidden;">
				<div class="title" style="padding-top:14px;">Login text</div>
				<div class="element">
					<input type="text" class="inputbox themevariables" id="login_foreground_text_field" name="login_foreground_text" value="$login_foreground_text" style="float: right;width: 100px;height:28px" required="true">
					<div class="colorSelector themeSettings" field="login_foreground_text" id="login_foreground_text">
						<div style="background:$login_foreground_text">
						</div>
				</div>
			</div>
		</div>
		<div>
		    <br>
		    <h3 style="border-bottom:0px"><a href="javascript:reset_colors();">Reset to default</a></h3>
		    {$changeimage}
		    <input type="submit" value="Update Settings" class="button">&nbsp;&nbsp;or <a href="javascript:window.close();">cancel or close</a>
	    </div>
	</div>
</form>
EOD;
} else {
	$data = '';

	foreach ($_POST as $field => $value) {
		$data .= '$'.$field.' = \''.$value.'\';'."\r\n";
	}

	configeditor('SETTINGS',$data,0,dirname(__FILE__).DIRECTORY_SEPARATOR.'config.php');
	header("Location:?module=dashboard&action=loadexternal&type=extension&name=desktop");
}