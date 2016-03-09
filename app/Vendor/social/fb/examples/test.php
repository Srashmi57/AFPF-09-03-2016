<?php
	if(isset($_REQUEST['state']) && isset($_REQUEST['code']))
	{
		?>
			<script type="text/javascript">
				window.close();
				window.opener.location.reload();
				//alert("Hello");
			</script>
		
		<?php
	}



require '../src/facebook.php';
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


if ($user) 
{
  $base_url='http://'.$_SERVER['HTTP_HOST'].'/';
  $params = array('next' => $base_url.'fregistration/examples/logout.php');
  $logoutUrl = $facebook->getLogoutUrl($params);
} 
else 
{
  $loginUrl = $facebook->getLoginUrl();
}

if ($user):
?>
	
<?php
	/* print("<pre>");
	print_r($user_profile); */
?>
	<div>
		<div>Register Yourself</div>
		<div>&nbsp;</div>
			<form method="POST" action="">
				<div>Name:</div>
				<div><input type="text" name="name" id="name" value="<?php echo $user_profile['name']; ?>" /></div>
				<div>&nbsp;</div>
				<div>Email:</div>
				<div><input type="text" name="email" id="email" value="<?php echo $user_profile['email']; ?>" /></div>
				<div>&nbsp;</div>
				<div>Password:</div>
				<div><input type="text" name="pass" id="pass" value="" /></div>
				<div>&nbsp;</div>
				<div>
					<input type="submit" name="submit" Value="Register"/>&nbsp; <a href="<?php echo $logoutUrl; ?>">Reset</a>
				</div>
			</form>
	</div>
	<!--<img src="https://graph.facebook.com/<?php echo $user; ?>/picture">-->
<?php
else:
?>
	<div>
		<div>Register Yourself</div>
		<div>&nbsp;</div>
			<form method="POST" action="">
				<div>Name:</div>
				<div><input type="text" name="name" id="name" value="" /></div>
				<div>&nbsp;</div>
				<div>Email:</div>
				<div><input type="text" name="email" id="email" value="" /></div>
				<div>&nbsp;</div>
				<div>Password:</div>
				<div><input type="text" name="pass" id="pass" value="" /></div>
				<div>&nbsp;</div>
				<div><input type="submit" name="submit" Value="Register"/>&nbsp; OR &nbsp;<a href="javascript:void(0);" onclick="fnLoginWindow()">Register with Facebook</a></div>
			</form>
	</div>
	
	<!--<a href="<?php echo $loginUrl; ?>">Login with Facebook</a>-->
	
	<input type='hidden' name='login_url' id='login_url' value='<?php echo $loginUrl; ?>' />
<?php
	endif
?>
<script type='text/javascript'>
function fnLoginWindow()
{
	var strUrl = document.getElementById('login_url').value;
	window.open(strUrl,'Login','width=500,height=500');
}
</script>