<?php
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR."cometchat_init.php";

	$userid = mysqli_real_escape_string($GLOBALS['dbh'],$_REQUEST['from']);
	$to = mysqli_real_escape_string($GLOBALS['dbh'],$_REQUEST['to']);

	$_SESSION['cometchat']['cometchat_user_'.$to] =array();

	$sql1 = "UPDATE cometchat SET cometchat.direction = 1 WHERE cometchat.from = ".mysqli_real_escape_string($GLOBALS['dbh'],$userid)." AND cometchat.direction = 0 AND cometchat.to = ".mysqli_real_escape_string($GLOBALS['dbh'],$to);

	$sql2 = "UPDATE cometchat SET cometchat.direction = 2 WHERE cometchat.from = ".mysqli_real_escape_string($GLOBALS['dbh'],$to)." AND cometchat.direction = 0 AND cometchat.to = ".mysqli_real_escape_string($GLOBALS['dbh'],$userid);

	$sql3 = "UPDATE cometchat SET cometchat.direction = 3  WHERE cometchat.direction = 1 AND cometchat.from=".mysqli_real_escape_string($GLOBALS['dbh'],$to)." AND cometchat.to = ".mysqli_real_escape_string($GLOBALS['dbh'],$userid);

	$sql4 = "UPDATE cometchat SET cometchat.direction = 3 WHERE cometchat.direction = 2 AND cometchat.from=".mysqli_real_escape_string($GLOBALS['dbh'],$userid)." AND cometchat.to = ".mysqli_real_escape_string($GLOBALS['dbh'],$to);

	$query = mysqli_query($GLOBALS['dbh'],$sql1);
	$query = mysqli_query($GLOBALS['dbh'],$sql2);
	$query = mysqli_query($GLOBALS['dbh'],$sql3);
	$query = mysqli_query($GLOBALS['dbh'],$sql4);

	$error = mysqli_error($GLOBALS['dbh']);

	$response = array();
	$response['id'] = $to;
	if (!empty($error) ) {
		$response['result'] = "0";
		header('content-type: application/json; charset=utf-8');
		$response['error'] = mysqli_error($GLOBALS['dbh']);
		echo json_encode($response);
		exit;
	}

	header('content-type: application/json; charset=utf-8');

	$response['result'] = "1";
	echo json_encode($response);
?>

