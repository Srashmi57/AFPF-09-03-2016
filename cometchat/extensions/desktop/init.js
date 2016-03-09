<?php

	include_once(dirname(__FILE__).DIRECTORY_SEPARATOR."config.php");

?>

/*
 * CometChat
 * Copyright (c) 2014 Inscripts - support@cometchat.com | http://www.cometchat.com | http://www.inscripts.com
*/

(function($){
	$.ccdesktop = (function () {
		var title = 'Desktop Extension';
        return {
			getTitle: function() {
				return title;
			},
			init: function() {
			},
			logout: function(){
				window.location.href='cometchat_login.php';
			}
        };
    })();
})(jqcc);