<?php

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* ADVANCED */
$integration = "cakephp";
define('SET_SESSION_NAME','CAKEPHP');	// Session name
define('SWITCH_ENABLED','0');
define('INCLUDE_JQUERY','1');
define('FORCE_MAGIC_QUOTES','0');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* DATABASE */
/*
if(file_exists(dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."Config".DIRECTORY_SEPARATOR."database.php")) {
    include_once(dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."Config".DIRECTORY_SEPARATOR."database.php");
} elseif(file_exists(dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."database.php")) {
    include_once(dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."database.php");
} else {
    echo "Please check if CometChat is installed in the correct directory.<br /> The 'cometchat' folder should be placed at <CAKEPHP_WEBROOT_DIRECTORY>/cometchat";
    exit;
}

$config = new DATABASE_CONFIG();*/

// DO NOT EDIT DATABASE VALUES BELOW
// DO NOT EDIT DATABASE VALUES BELOW
// DO NOT EDIT DATABASE VALUES BELOW
/*
define('DB_SERVER',				$config->default['host']	            );
define('DB_PORT',				'3306'									);
define('DB_USERNAME',				$config->default['login']				);
define('DB_PASSWORD',				$config->default['password']			);
define('DB_NAME',				$config->default['database']			);
if(defined('USE_CCAUTH') && USE_CCAUTH == '0'){
define('TABLE_PREFIX',				$config->default['prefix']				);
define('DB_USERTABLE',				"users"									);
define('DB_USERTABLE_USERID',           	"id"								    );
define('DB_USERTABLE_NAME',			"username"								);
define('DB_AVATARTABLE',                        " "										);
define('DB_AVATARFIELD',                        " ".TABLE_PREFIX.DB_USERTABLE.".avatar ");
*/
/*'host' => 'localhost',
		'login' => 'artformp_user',
		'password' => 'afpf@2015',
		'database' => 'artformp_afpf15',
		'prefix' => 'appap14_',
*/

define('DB_SERVER',				'localhost'	            );
define('DB_PORT',				'3306'									);
define('DB_USERNAME',				'artformp_user'				);
define('DB_PASSWORD',				'afpf@2015'			);
define('DB_NAME',				'artformp_afpf15'			);
if(defined('USE_CCAUTH') && USE_CCAUTH == '0'){
define('TABLE_PREFIX',				'appap14_'				);
define('DB_USERTABLE',				"users"									);
define('DB_USERTABLE_USERID',           	"user_id"								    );
define('DB_USERTABLE_NAME',			"user_fname"								);
define('DB_AVATARTABLE',                        " "										);
define('DB_AVATARFIELD',                        " ".TABLE_PREFIX.DB_USERTABLE.".user_image ");
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* FUNCTIONS */


	function getUserID() {
		$userid = 0;
		if (!empty($_SESSION['basedata']) && $_SESSION['basedata'] != 'null') {
			$_REQUEST['basedata'] = $_SESSION['basedata'];
		}

		if (!empty($_REQUEST['basedata'])) {
			if (function_exists('mcrypt_encrypt') && defined('ENCRYPT_USERID') && ENCRYPT_USERID == '1') {
				$key = "";
				if( defined('KEY_A') && defined('KEY_B') && defined('KEY_C') ){
					$key = KEY_A.KEY_B.KEY_C;
				}
				$uid = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode(rawurldecode($_REQUEST['basedata'])), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
				if (intval($uid) > 0) {
					$userid = $uid;
				}
			} else {
				$userid = $_REQUEST['basedata'];
			}
		}
		if (!empty($_SESSION['Auth']['User']['id'])) {
			$userid = $_SESSION['Auth']['User']['id'];
		}
		if (!empty($_SESSION[Auth][WebsitesUser][user_id])) {
			$userid = $_SESSION[Auth][WebsitesUser][user_id];
		}
		
		//echo($_SESSION[Auth][WebsitesUser][user_id]);
		//print_r($_SESSION);
		$userid = intval($userid);
		//echo "test".$userid;
		//echo getFriendsList($userid,time());
		return $userid;
	}

	function chatLogin($userName,$userPass) {
		$userid = 0;
		global $guestsMode;
		if (filter_var($userName, FILTER_VALIDATE_EMAIL)) {
			$sql = ("SELECT * FROM ".TABLE_PREFIX.DB_USERTABLE." WHERE email = '".mysqli_real_escape_string($GLOBALS['dbh'],$userName)."'");
		} else {
			$sql = ("SELECT * FROM ".TABLE_PREFIX.DB_USERTABLE." WHERE username = '".mysqli_real_escape_string($GLOBALS['dbh'],$userName)."'");
		}
		$result = mysqli_query($GLOBALS['dbh'],$sql);
		$row = mysqli_fetch_assoc($result);
		$salt = 'DYhG93b0qyJfIxfs2guVoUubWwvniR2G0FgaC9mis';
		if($row['password'] == sha1($salt.$userPass)){
			$userid = $row['id'];
		}
		if(!empty($userName) && !empty($_REQUEST['social_details'])) {
			$social_details = json_decode($_REQUEST['social_details']);
			$userid = socialLogin($social_details);
		}
		if(!empty($_REQUEST['guest_login']) && $userPass == "CC^CONTROL_GUEST" && $guestsMode == 1){
			$userid = getGuestID($userName);
		}
		if(!empty($userid) && isset($_REQUEST['callbackfn']) && $_REQUEST['callbackfn'] == 'mobileapp'){
			$sql = ("insert into cometchat_status (userid,isdevice) values ('".mysqli_real_escape_string($GLOBALS['dbh'],$userid)."','1') on duplicate key update isdevice = '1'");
                mysqli_query($GLOBALS['dbh'], $sql);
		}
		if($userid && function_exists('mcrypt_encrypt') && defined('ENCRYPT_USERID') && ENCRYPT_USERID == '1'){
			$key = "";
				if( defined('KEY_A') && defined('KEY_B') && defined('KEY_C') ){
					$key = KEY_A.KEY_B.KEY_C;
				}
			$userid = rawurlencode(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $userid, MCRYPT_MODE_CBC, md5(md5($key)))));
		}

		return $userid;
	}

	function getFriendsList($userid,$time) {
		global $hideOffline;
		$offlinecondition = '';
		if ($hideOffline) {
			$offlinecondition = "where ((cometchat_status.lastactivity > (".mysqli_real_escape_string($GLOBALS['dbh'],$time)."-".((ONLINE_TIMEOUT)*2).")) OR cometchat_status.isdevice = 1) and (cometchat_status.status IS NULL OR cometchat_status.status <> 'invisible' OR cometchat_status.status <> 'offline')";
		}
		$sql = ("select DISTINCT ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." userid, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." username, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." link, ".DB_AVATARFIELD." avatar, cometchat_status.lastactivity lastactivity, cometchat_status.lastseen lastseen, cometchat_status.lastseensetting lastseensetting, cometchat_status.status, cometchat_status.message, cometchat_status.isdevice from ".TABLE_PREFIX.DB_USERTABLE." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid ".DB_AVATARTABLE." ".$offlinecondition." order by username asc");

		return $sql;
	}

	function getFriendsIds($userid) {
		
		//$sql = ("select ".TABLE_PREFIX."friends.friend_user_id friendid from ".TABLE_PREFIX."friends where ".TABLE_PREFIX."friends.initiator_user_id = '".mysqli_real_escape_string($GLOBALS['dbh'],$userid)."' and is_confirmed = 1 union select ".TABLE_PREFIX."friends.initiator_user_id friendid from ".TABLE_PREFIX."friends where ".TABLE_PREFIX."friends.friend_user_id = '".mysqli_real_escape_string($GLOBALS['dbh'],$userid)."' and is_confirmed = 1");
		$sql = "select DISTINCT appap14_users.user_id userid from appap14_users";
		return $sql;
	}

	function getUserDetails($userid) {
		$sql = ("select ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." userid, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." username, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." link, ".DB_AVATARFIELD." avatar, cometchat_status.lastactivity lastactivity, cometchat_status.lastseen lastseen, cometchat_status.lastseensetting lastseensetting, cometchat_status.status, cometchat_status.message, cometchat_status.isdevice from ".TABLE_PREFIX.DB_USERTABLE." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid ".DB_AVATARTABLE." where ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = '".mysqli_real_escape_string($GLOBALS['dbh'],$userid)."'");

		return $sql;
	}

	function getUserStatus($userid) {
		 $sql = ("select cometchat_status.message, cometchat_status.status from cometchat_status where userid = '".mysqli_real_escape_string($GLOBALS['dbh'],$userid)."'");

		 return $sql;
	}

	function fetchLink($link) {
	        return '';
	}

	function getAvatar($image) {
		$cc_url = (defined('CC_SITE_URL') ? CC_SITE_URL : BASE_URL);
		if ($image) {
			
			$temp = "/afpf/assets/websiteuser/".$image;
			if (@getimagesize('http://artformplatform.com/afpf/assets/websiteuser/'.$image)) {
				return "/afpf/assets/websiteuser/".$image;
			}else{
				return '/afpf/cometchat/images/noavatar.png';	
			}		
			
		} else {
			return '/afpf/cometchat/images/noavatar.png';
		}
	}

	function getTimeStamp() {
		return time();
	}

	function processTime($time) {
		return $time;
	}

	if (!function_exists('getLink')) {
	  	function getLink($userid) { return fetchLink($userid); }
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/* HOOKS */

	function hooks_message($userid,$to,$unsanitizedmessage) {

	}

	function hooks_forcefriends() {

	}

	function hooks_updateLastActivity($userid) {

	}

	function hooks_statusupdate($userid,$statusmessage) {

	}

	function hooks_activityupdate($userid,$status) {

	}

}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* LICENSE */

include_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'license.php');
$x = "\x62a\x73\x656\x34\x5fd\x65c\157\144\x65";
eval($x('JHI9ZXhwbG9kZSgnLScsJGxpY2Vuc2VrZXkpOyRwXz0wO2lmKCFlbXB0eSgkclsyXSkpJHBfPWludHZhbChwcmVnX3JlcGxhY2UoIi9bXjAtOV0vIiwnJywkclsyXSkpOw'));

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
