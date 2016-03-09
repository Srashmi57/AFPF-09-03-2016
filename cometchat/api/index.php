<?php

include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."config.php");
include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."cometchat_init.php");

$userid = 0;
$apikeyvalue = null;
$username = null;
$avatarfile = null;
$apikeyvalue = null;
$avatarlink = null;
$username = null;
$password = null;
$newpassword = null;
$displayname = null;
$profilelink = null;
$friends = null;

if($userid == 0){
	if(!empty($_REQUEST['userid'])){
		$userid = $_REQUEST['userid'];
	} elseif(!empty($_REQUEST['basedata']) && !empty($_REQUEST['action']) && $_REQUEST['action']!= 'removeuser') {
		$userid = getUserID();
	}
}

if(isset($_FILES["Filedata"]) && $_FILES["Filedata"]['name'] != ''){
	$avatarfile = $_FILES["Filedata"];
}
if(isset($_REQUEST['api-key'])){
	$apikeyvalue = $_REQUEST['api-key'];
}
if(isset($_FILES["avatar"])&& $_FILES["avatar"]['name'] != ''){
	$avatarfile = $_FILES["avatar"];
}
if(isset($_REQUEST['avatar']) && $_REQUEST['avatar']!=''){
	$avatarlink = $_REQUEST['avatar'];
}
if(isset($_REQUEST['username'])){
	$username = $_REQUEST['username'];
}
if(isset($_REQUEST['password'])){
	$password = $_REQUEST['password'];
}
if(isset($_REQUEST['newpassword'])){
	$newpassword = $_REQUEST['newpassword'];
}
if(isset($_REQUEST['displayname'])){
	$displayname = $_REQUEST['displayname'];
}
if(isset($_REQUEST['link'])){
	$profilelink = $_REQUEST['link'];
}
if(isset($_REQUEST['friends'])){
	$friends = $_REQUEST['friends'];
}


if(isset($_REQUEST['action'])) {
	switch ($_REQUEST['action']) {
		case 'createuser':
		createUser($apikeyvalue, $username, $password, $displayname, $avatarfile, $avatarlink, $profilelink);
		break;
		case 'updateuser':
		updateuser($apikeyvalue, $userid, $username, $password, $newpassword, $displayname, $avatarfile, $avatarlink, $profilelink);
		break;
		case 'addfriend':
		addFriend($apikeyvalue, $userid, $friends);
		break;
		case 'removefriend':
		removeFriend($apikeyvalue, $userid, $friends);
		break;
		case 'getfriend':
		getfriend($apikeyvalue, $userid);
		break;
		case 'checkAPIKEY':
		checkAPIKEY($apikeyvalue);
		break;
		case 'checkpassword':
		checkpassword($apikeyvalue, $password);
		break;
		case 'authenticateUser':
		authenticateUser($apikeyvalue, $username, $password);
		break;
		case 'removeuser':
		removeuser($apikeyvalue, $userid);
		default:
		echo 'Invalid Action';
		exit;
		break;
	}
}

/* FUNCTIONS */

function checkAPIKEY($keyvalue) {
	global $apikey;
	if(!empty($keyvalue) && !empty($apikey)) {
		if($apikey == $keyvalue) {
			return 1; // key verified
		}
		$msg = 'Incorrect API KEY.';
		$response = array('failed' => array('status' => '1011', 'message' => $msg));
		echo json_encode($response); exit; // Incorrect API KEY
	}
	$msg = 'Invalid API KEY.';
	$response = array('failed' => array('status' => '1010', 'message' => $msg));
	echo json_encode($response); exit; // Invalid API KEY
}

function checkpassword($apikeyvalue, $password) {
	global $userid;
	$status = 0; // invalid password or userid

	checkAPIKEY($apikeyvalue);

	if(empty($password)||empty($userid)) {
		return $status;
	} else {
		$password = md5($password);
	}

	$sql = ("select id, password from cometchat_users where id = ".$userid."");

	if($query = mysqli_query($GLOBALS['dbh'],$sql)) {
		$result = mysqli_fetch_assoc($query);
		if($result['id'] == $userid && $result['password'] == $password) {
			$status = 1; // password authenticated
		}
	}
	return $status;
}

function createuser($apikeyvalue, $username, $password, $displayname, $avatarfile, $avatarlink, $profilelink) {
	$msg = '';
	checkAPIKEY($apikeyvalue);

	if(!isset($profilelink)) {
		$profilelink = '';
	}

	if(!isset($username) || $username == "") {
		$msg = 'Invalid Username.';
		$response = array('failed' => array('status' => '1007', 'message' => $msg));
		echo json_encode($response); exit;
	}

	if(!isset($displayname) || $displayname == "") {
		$displayname = $username;
	}

	if(!isset($password) || $password == "") {
		$msg = 'Invalid Password.';
		$response = array('failed' => array('status' => '1009', 'message' => $msg));
		echo json_encode($response); exit;
	}

	$password_md5 = md5($password);

	$sql = ("select username from cometchat_users where username = '".mysqli_real_escape_string($GLOBALS['dbh'],$username)."'");
	$query = mysqli_query($GLOBALS['dbh'],$sql);

	if(mysqli_num_rows($query) > 0) {
		$msg = 'username already exists';
		$response = array('failed' => array('status' => '1001', 'message' => $msg));
		echo json_encode($response); exit;
	} else {
		$sql = ("insert into cometchat_users (username,password,displayname,link) values ('".mysqli_real_escape_string($GLOBALS['dbh'],$username)."','".mysqli_real_escape_string($GLOBALS['dbh'],$password_md5)."','".mysqli_real_escape_string($GLOBALS['dbh'],$displayname)."','".mysqli_real_escape_string($GLOBALS['dbh'],$profilelink)."')");

		if($query = mysqli_query($GLOBALS['dbh'],$sql)) {
			$user_id = mysqli_insert_id($GLOBALS['dbh']);

			if(isset($avatarfile)) {

				$filename = '';
				$avatarlink = '';
				$isImage = false;

				$filename = preg_replace("/[^a-zA-Z0-9\. ]/", "", mysqli_real_escape_string($GLOBALS['dbh'],$avatarfile['name']));
				$filename = str_replace(" ", "_",$filename);
				$path = pathinfo($filename);

				if(strtolower($path['extension']) == 'jpg' || strtolower($path['extension']) == 'jpeg' || strtolower($path['extension']) == 'png' || strtolower($path['extension']) == 'gif') {
					$isImage = true;
				}

				$md5filename = md5(str_replace(" ", "_",str_replace(".","",$filename))."cometchat".time());
				if ($isImage){
					$md5filename .= ".".strtolower($path['extension']);
					if (!empty($avatarfile) && is_uploaded_file($avatarfile['tmp_name'])) {
						if (move_uploaded_file($avatarfile['tmp_name'], dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'avatars'.DIRECTORY_SEPARATOR. $md5filename)) {
							$avatarlink = $_SERVER['SERVER_NAME'].BASE_URL.'images/avatars/'.$md5filename;
						}
					}
				}
			}

			if(isset($avatarlink) && $avatarlink != '') {
				$sql = ("update cometchat_users set avatar = '".mysqli_real_escape_string($GLOBALS['dbh'],$avatarlink)."' where userid = '".mysqli_real_escape_string($GLOBALS['dbh'],$user_id)."'");
				if(!mysqli_query($GLOBALS['dbh'],$sql)) {
					$msg = 'Failed to update avatar.';
					$response = array('failed' => array('status' => '1014', 'message' => $msg));
					echo json_encode($response); exit;
				} else {
					$msg = 'Avatar updated successfully!';
					$response = array('success' => array('status' => '1000', 'message' => $msg));
				}
			} elseif(isset($avatarlink) && $avatarlink == '') {
				$msg = 'Failed to update avatar.';
				$response = array('failed' => array('status' => '1014', 'message' => $msg));
				echo json_encode($response); exit;
			}

			$msg = 'User created successfully!';
			$response = array('success' => array('status' => '1000', 'message' => $msg));
			echo json_encode($response); exit;
		} else {
			$msg = 'Failed to create user.';
			$response = array('failed' => array('status' => '1016', 'message' => $msg));
			echo json_encode($response); exit;
		}
	}

}




function updateuser($apikeyvalue, $userid, $username, $password, $newpassword, $displayname, $avatarfile, $avatarlink, $profilelink) {
	$msg = '';
	$response = array();
	checkAPIKEY($apikeyvalue);
	$changed = 0;
	$sql = ("select count(userid) as count from cometchat_users where userid = '".mysqli_real_escape_string($GLOBALS['dbh'],$userid)."'"); /*check logged in user with userid exists*/
	$query = mysqli_query($GLOBALS['dbh'],$sql);
	$result = mysqli_fetch_assoc($query);
	if(empty($result['count'])){
		$msg = 'Invalid user ID';
		$response = array('failed' => array('status' => '1007', 'message' => $msg));
		echo json_encode($response); exit;
	}
    if(!empty($userid)) {
    	if(isset($newpassword) && $newpassword != '') {
    		$password_md5 = md5($newpassword);
    		$sql = ("update cometchat_users set password = '".mysqli_real_escape_string($GLOBALS['dbh'],$password_md5)."' where userid = ".mysqli_real_escape_string($GLOBALS['dbh'],$userid));
    		$query = mysqli_query($GLOBALS['dbh'],$sql);
    		if(!$query) {
    			$msg = 'Failed to update password.';
    			$response = array('failed' => array('status' => '1014', 'message' => $msg));
    			echo json_encode($response); exit;
    		} else {
    			$msg = 'Password updated successfully!';
    			$changed = 1;
    		}
    	}

    	if(isset($username) && $username != '') {
    		$sql = ("update cometchat_users set username = '".mysqli_real_escape_string($GLOBALS['dbh'],$username)."' where userid = '".mysqli_real_escape_string($GLOBALS['dbh'],$userid)."'");
    		if(!mysqli_query($GLOBALS['dbh'],$sql)) {
    			$msg = 'Failed to update username. Invalid username or username already exists.';
    			$response =  array('failed' => array('status' => '1014', 'message' => $msg));
    			echo json_encode($response); exit;
    		} else {
    			$msg = 'username updated successfully!';
    			$changed = 1;
    		}
    	}

    	if(isset($displayname)) {
    		$sql = ("update cometchat_users set displayname = '".mysqli_real_escape_string($GLOBALS['dbh'],$displayname)."' where userid = '".mysqli_real_escape_string($GLOBALS['dbh'],$userid)."'");

    		if(!mysqli_query($GLOBALS['dbh'],$sql)) {
    			$msg = 'Failed to update displayname.';
    			$response = array('failed' => array('status' => '1014', 'message' => $msg));
    			echo json_encode($response); exit;
    		} else {
    			$msg = 'displayname updated successfully!';
    			$changed = 1;
    		}
    	}

    	if(isset($profilelink)) {
    		$sql = ("update cometchat_users set link = '".$profilelink."' where userid = '".mysqli_real_escape_string($GLOBALS['dbh'],$userid)."'");
    		if(!mysqli_query($GLOBALS['dbh'],$sql)) {
    			$msg = 'Failed to update link.';
    			$response = array('failed' => array('status' => '1014', 'message' => $msg));
    			echo json_encode($response); exit;
    		} else {
    			$msg = 'Profile link updated successfully!';
    			$changed = 1;
    		}
    	}

    	if(!empty($avatarfile)) {
    		$filename = '';
    		$avatarlink = '';
    		$isImage = false;

    		$filename = preg_replace("/[^a-zA-Z0-9\. ]/", "", mysqli_real_escape_string($GLOBALS['dbh'],$avatarfile['name']));
    		$filename = str_replace(" ", "_",$filename);
    		$path = pathinfo($filename);

    		if(strtolower($path['extension']) == 'jpg' || strtolower($path['extension']) == 'jpeg' || strtolower($path['extension']) == 'png' || strtolower($path['extension']) == 'gif') {
    			$isImage = true;
    		}

    		$md5filename = md5(str_replace(" ", "_",str_replace(".","",$filename))."cometchat".time());
    		if ($isImage){

    			$md5filename .= ".".strtolower($path['extension']);
    			if (!empty($avatarfile) && is_uploaded_file($avatarfile['tmp_name'])) {
    				if (move_uploaded_file($avatarfile['tmp_name'],dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'images'
    					.DIRECTORY_SEPARATOR.'avatars'.DIRECTORY_SEPARATOR. $md5filename)) {
    					$avatarlink = $_SERVER['SERVER_NAME'].BASE_URL.'images/avatars/'.$md5filename;
    				}
    			}
    		}
    	}

    	if(isset($avatarlink) && $avatarlink != '') {
    		$sql = ("update cometchat_users set avatar = '".mysqli_real_escape_string($GLOBALS['dbh'],$avatarlink)."' where userid = '".mysqli_real_escape_string($GLOBALS['dbh'],$userid)."'");
    		if(!mysqli_query($GLOBALS['dbh'],$sql)) {
    			$msg = 'Failed to update avatar.';
    			$response = array('failed' => array('status' => '1014', 'message' => $msg));
    			echo json_encode($response); exit;
    		} else {
    			$msg = 'Avatar updated successfully!';
    			$changed = 1;
    		}
    	} elseif(isset($avatarlink) && $avatarlink == '') {
    		$msg = 'Failed to update avatar.';
    		$response = array('failed' => array('status' => '1014', 'message' => $msg));
    		echo json_encode($response); exit;
    	}
    } else {
    	$msg = 'Failed to update details.';
    	$response = array('failed' => array('status' => '1016', 'message' => $msg));
    	echo json_encode($response); exit;
    }

    if($changed == 1){
    	$msg = 'Details updated successfully!';
    	$response = array('success' => array('status' => '1000', 'message' => $msg));
    	echo json_encode($response); exit;
    }else{
    	$msg = 'Failed to update details.';
    	$response = array('failed' => array('status' => '1016', 'message' => $msg));
    	echo json_encode($response); exit;
    }
}


function addfriend($apikeyvalue, $userid, $friends) {
	$msg = '';
	$response = array();
	checkAPIKEY($apikeyvalue);

	if(!empty($userid) && !empty($friends)) {
		if(!is_array($friends)) {
			$friends = trim($friends);
			if(strpos($friends,'[') !== false){
				$friends = substr($friends, 1, -1);
			}elseif (strpos($friends,'(') !== false) {
				$friends = substr($friends, 1, -1);
			}
			$friends = explode(',',$friends);
		}
		$final_friends_list = array();
		$db_friend_list = array();
		$added_friends = array();

		$sql = ("select count(userid) as count from cometchat_users where userid = '".mysqli_real_escape_string($GLOBALS['dbh'],$userid)."'"); /*check logged in user with userid exists*/
		$result = mysqli_query($GLOBALS['dbh'],$sql);
		$fromuser = mysqli_fetch_assoc($result);
		if(!empty($fromuser['count'])){
			foreach ($friends as $to) {
				if(!empty($to)) {
					if($userid != $to) {
						$column_name = is_numeric($to)?'userid':'username';
						$sql = ("select count(userid) as count from cometchat_users where ".$column_name." = '".mysqli_real_escape_string($GLOBALS['dbh'],$to)."'"); /*check whether the requested friend exists or not */
						$result = mysqli_query($GLOBALS['dbh'],$sql);
						$touser = mysqli_fetch_assoc($result);
						if(!empty($touser['count'])) {
							$sql = ("select friends from cometchat_users where userid = '".mysqli_real_escape_string($GLOBALS['dbh'],$userid)."'");
							$result = mysqli_query($GLOBALS['dbh'],$sql);
							$db_friend_list = mysqli_fetch_assoc($result);
							if(!empty($db_friend_list['friends'])){
								$db_friend_array = explode(",",$db_friend_list['friends']);
								/*check if already friends*/
								if(!in_array($to,$db_friend_array)) {
									$added_friends[] = $to;
								}else{
									$failed_id[] = $to;
								}
							}else {
								$added_friends[] = $to;
							}
						}else {
							$failed_id[] = $to;
						}
					}else{
						$failed_id[] = $userid;
					}
				}
			}

			if(!empty($added_friends)) {
				$final_friends_list = !empty($db_friend_array)?array_merge($db_friend_array,$added_friends):$added_friends;
				$friends_list = implode(",",$final_friends_list);

				$list = implode(',',$added_friends);
				$sql = ("update cometchat_users set friends = '".mysqli_real_escape_string($GLOBALS['dbh'],$friends_list)."' where userid = '".$userid."'");
				mysqli_query($GLOBALS['dbh'],$sql);
				$msg = 'Friends added successfully!';
				$response = array('success' => array('status' => '1000', 'message' => $msg,'data' => array($column_name => $list)));
				echo json_encode($response); exit;
			}

			if(!empty($failed_id)){
				$list = implode(",",$failed_id);
				$msg = 'Failed to add friend.';
				$response = array('failed' => array('status' => '1006', 'message' => $msg));
				echo json_encode($response); exit;
			}
		}else{
			$msg = 'Invalid user ID';
			$response = array('failed' => array('status' => '1007', 'message' => $msg));
			echo json_encode($response); exit;
		}
	} else {
		$msg = 'Invalid input';
		$response = array('failed' => array('status' => '1005', 'message' => $msg));
		echo json_encode($response); exit;
	}
	echo json_encode($response); exit;
}

function removefriend($apikeyvalue, $userid, $friends) {
	$msg = '';
	$response = array();
	checkAPIKEY($apikeyvalue);

	if(!empty($userid) && !empty($friends)) {
		if(!is_array($friends)) {
			$friends = trim($friends);
			if(strpos($friends,'[') !== false){
				$friends = substr($friends, 1, -1);
			}elseif (strpos($friends,'(') !== false) {
				$friends = substr($friends, 1, -1);
			}
			$friends = explode(',',$friends);
		}
		$friends_list = '';
		/*logged in user does not exist*/
		$sql = ("select count(userid) as count from cometchat_users where userid = '".mysqli_real_escape_string($GLOBALS['dbh'],$userid)."'");
		$result = mysqli_query($GLOBALS['dbh'],$sql);
		$user = mysqli_fetch_assoc($result);
		if(!empty($user['count'])){
			$sql = ("select friends from cometchat_users where userid = '".mysqli_real_escape_string($GLOBALS['dbh'],$userid)."'");
			$result = mysqli_query($GLOBALS['dbh'],$sql);
			$friends_id = mysqli_fetch_assoc($result);
			if(!empty($friends_id['friends'])){
				$db_friend_list = explode(",",$friends_id['friends']);
				foreach ($friends as $to) {
					if(!empty($to)) {
						$column_name = is_numeric($to)?'id':'username';
						/*check if user is a friends*/
						if (($key = array_search($to, $db_friend_list)) !== false) {
							$removed_friends[] = $to;
							unset($db_friend_list[$key]);
						}else{
							$not_friends[] = $to;
						}
					}
				}
				if(!empty($db_friend_list)) {
					$friends_list = implode(",",$db_friend_list);
				}
			}

			if(!empty($removed_friends)) {
				$list = implode(',',$db_friend_list);
				$sql = ("update cometchat_users set friends = '".mysqli_real_escape_string($GLOBALS['dbh'],$friends_list)."'  where userid = '".$userid."'");

				mysqli_query($GLOBALS['dbh'],$sql);
				$msg = 'Friends removed successfully!';
				$removed_friends = implode(',',$removed_friends);
				$response = array('success' => array('status' => '1000', 'message' => $msg,'data' => array($column_name => $removed_friends)));
			}else {
				if(!empty($not_friends)) {
					$list = implode(',',$not_friends);
					$msg = 'Failed to remove friends!';
					$response = array('failed' => array('status' => '1002', 'message' => $msg));
					echo json_encode($response); exit;

				}else{
					$msg = 'Failed to remove friends!';
					$response = array('failed' => array('status' => '1002', 'message' => $msg));
					echo json_encode($response); exit;
				}
			}
			echo json_encode($response); exit;
		}else{
			$response['failed'] = array('status' => '1007','message' => 'Invalid user ID');
			$msg = 'Invalid user ID';
			$response = array('failed' => array('status' => '1002', 'message' => $msg));
			echo json_encode($response); exit;
		}
	} else {
		$msg = 'Invalid input';
		$response = array('failed' => array('status' => '1005', 'message' => $msg));
	}
	echo json_encode($response); exit;
}


function getfriend($apikeyvalue, $userid) {
	$msg = '';

	checkAPIKEY($apikeyvalue);

	if(!empty($userid)) {
		/*logged in user does not exist*/
		$sql = ("select username from cometchat_users where userid = '".mysqli_real_escape_string($GLOBALS['dbh'],$userid)."'");
		$result = mysqli_query($GLOBALS['dbh'],$sql);
		$user = mysqli_fetch_array($result);
		if(!empty($user)) {
			$sql = ("select friends from cometchat_users where userid = '".mysqli_real_escape_string($GLOBALS['dbh'],$userid)."'");
			if($result = mysqli_query($GLOBALS['dbh'],$sql)) {
				$db_friend_list = mysqli_fetch_array($result);
				$friend_list = $db_friend_list[0];
				$msg = 'Friend list fetched successfully!';
				$response = array('success' => array('status' => '1000', 'message' => $msg, 'data' => $friend_list));
				echo json_encode($response); exit;
			} else {
				$msg = 'Error fetching friends';
				$response = array('failed' => array('status' => '1007', 'message' => $msg));
				echo json_encode($response); exit;
			}
		} else {
			$msg = 'Invalid user ID';
			$response = array('failed' => array('status' => '1007', 'message' => $msg));
			echo json_encode($response); exit;
		}
	} else {
		$msg = 'Invalid input';
		$response = array('failed' => array('status' => '1005', 'message' => $msg));
		echo json_encode($response); exit;
	}
}

function authenticateUser($apikeyvalue, $username, $password) {
	$msg = '';

	checkAPIKEY($apikeyvalue);

	if(isset($password) && $password != '') {
		$password = md5($password);
	} else {
		$msg = 'Invalid Password.';
		$response = array('failed' => array('status' => '1009', 'message' => $msg));
		echo json_encode($response); exit;
	}

	if(!isset($username) || $username == '') {
		$msg = 'Invalid username.';
		$response = array('failed' => array('status' => '1007', 'message' => $msg));
		echo json_encode($response); exit;
	}

	if(!empty($username) && !empty($password)) {

		$sql = ("select userid from cometchat_users where username = '".$username."' and password = '".$password."'" );

		if($query = mysqli_query($GLOBALS['dbh'],$sql)) {
			$result = mysqli_fetch_assoc($query);
			if(mysqli_num_rows($query)> 0 && $result['userid'] > 0) {
				$msg = 'Login successfull';
				$userid = $result['userid'];
				$response = array('success' => array('status' => '1000', 'message' => $msg, 'userid' => $userid));
				echo json_encode($response); exit;
			} else {
				$msg = 'Incorrect username/password combination.';
				$response = array('failed' => array('status' => '1017', 'message' => $msg));
				echo json_encode($response, JSON_UNESCAPED_SLASHES); exit;
			}
		} else {
			$msg = 'Error occurred. Please try again.';
			$response = array('failed' => array('status' => '1012', 'message' => $msg));
			echo json_encode($response); exit;
		}
	} else {
		$msg = 'Invalid input';
		$response = array('failed' => array('status' => '1005', 'message' => $msg));
		echo json_encode($response); exit;
	}
}

function removeuser($apikeyvalue, $userid) {
	$msg = '';

	checkAPIKEY($apikeyvalue);

	if(!empty($userid)) {
		/*logged in user does not exist*/
		$sql = ("select username from cometchat_users where userid = '".mysqli_real_escape_string($GLOBALS['dbh'],$userid)."'");
		$result = mysqli_query($GLOBALS['dbh'],$sql);
		$user = mysqli_fetch_array($result);
		if(!empty($user)) {
			$sql = ("DELETE FROM `cometchat_users` WHERE `userid` = '".mysqli_real_escape_string($GLOBALS['dbh'],$userid)."'");
			if(mysqli_query($GLOBALS['dbh'],$sql)) {
				$msg = 'User removed successfully!';
				$response = array('success' => array('status' => '1000', 'message' => $msg));
				echo json_encode($response); exit;
			} else {
				$msg = 'Remove user failed';
				$response = array('failed' => array('status' => '1007', 'message' => $msg));
				echo json_encode($response); exit;
			}
		} else {
			$msg = 'Invalid user ID';
			$response = array('failed' => array('status' => '1007', 'message' => $msg));
			echo json_encode($response); exit;
		}
	} else {
		$msg = 'Invalid input';
		$response = array('failed' => array('status' => '1005', 'message' => $msg));
		echo json_encode($response); exit;
	}
}

?>