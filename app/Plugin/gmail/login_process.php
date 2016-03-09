<?php
include('lightopenid.php');
$callback_website_url='http://localhost/google/google_landing.php';
googleAuthenticate($callback_website_url);

function googleAuthenticate($callback_website_url) {
    $openid = new lightopenid;
    $openid->identity = 'https://www.google.com/accounts/o8/id';
    $openid->returnUrl = $callback_website_url;
    $endpoint = $openid->discover('https://www.google.com/accounts/o8/id');
    $fields ='?openid.ns=' . urlencode('http://specs.openid.net/auth/2.0') .
		'&openid.return_to=' . urlencode($openid->returnUrl) .
		'&openid.claimed_id=' . urlencode('http://specs.openid.net/auth/2.0/identifier_select') .
		'&openid.identity=' . urlencode('http://specs.openid.net/auth/2.0/identifier_select') .
		'&openid.mode=' . urlencode('checkid_setup') .
		'&openid.ns.ax=' . urlencode('http://openid.net/srv/ax/1.0') .
		'&openid.ax.mode=' . urlencode('fetch_request') .
		'&openid.ax.required=' . urlencode('email,firstname,lastname') .
		'&openid.ax.type.firstname=' . urlencode('http://axschema.org/namePerson/first') .
		'&openid.ax.type.lastname=' . urlencode('http://axschema.org/namePerson/last') .
		'&openid.ax.type.email=' . urlencode('http://axschema.org/contact/email');
		header('location:'.$endpoint . $fields);            
}
?>