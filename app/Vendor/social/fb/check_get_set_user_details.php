<?php
session_start();
require 'src/facebook.php';
$facebook = new Facebook(array(
  'appId'  => '213601475483889',
  'secret' => 'f4f1ad2b4ffd45cf3dfa939a7d843228',
));

$user = $facebook->getUser();
if ($user) 
{
  try 
  {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } 
  catch (FacebookApiException $e) 
  {
    error_log($e);
    $user = null;
  }
}
$base_url='http://'.$_SERVER['HTTP_HOST'].'/';
if ($user) 
{
	$base_url='http://'.$_SERVER['HTTP_HOST'].'/';
	$params = array('next' => $base_url.'social/reset_user_details.php');
	$logoutUrl = $facebook->getLogoutUrl($params);
	$arrUserArray = $user_profile;
	$arrUserArray['social_user'] = "fb";
	$arrUserArray['logout_url'] = $logoutUrl;
	$_SESSION['USER'] = $arrUserArray;

	?>
		<script type="text/javascript">
			window.close();
			window.opener.location.reload();
		</script>
	<?php
  /* print("<pre>");
  print_r($user_profile);
  exit; */
} 
else 
{
  $loginUrl = $facebook->getLoginUrl();
  header('Location: '.$loginUrl);
}
?>