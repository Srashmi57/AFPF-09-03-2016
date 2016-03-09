<?php
	include_once(dirname(__FILE__).DIRECTORY_SEPARATOR."cometchat_init.php");
	include_once(dirname(__FILE__).DIRECTORY_SEPARATOR."extensions".DIRECTORY_SEPARATOR."desktop".DIRECTORY_SEPARATOR."config.php");
	include_once(dirname(__FILE__).DIRECTORY_SEPARATOR."extensions".DIRECTORY_SEPARATOR."desktop".DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR."en.php");
	if (file_exists(dirname(__FILE__).DIRECTORY_SEPARATOR."extensions".DIRECTORY_SEPARATOR."desktop".DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR.$lang.".php")) {
	include_once(dirname(__FILE__).DIRECTORY_SEPARATOR."extensions".DIRECTORY_SEPARATOR."desktop".DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR.$lang.".php");
	}
	$username=$desktop_language[0];
	$password=$desktop_language[1];
	$remember=$desktop_language[2];
	$login=$desktop_language[3];
	$forgot=$desktop_language[4];
    $register=$desktop_language[5];

    $forgot_link='';
    $signUp_link='';
    $logo_url='';

	if(!empty($_GET['process']) && $_GET['process']=="1"){
		if(!empty($_REQUEST['username']) && (!empty($_REQUEST['password']) || $_REQUEST['social_details'])) {
			$userid = chatLogin($_REQUEST['username'], $_REQUEST['password']);
			if($userid=="0" || $userid==null){
				$response = array();
				$response['basedata'] = strval($userid);
				$response['version'] = $currentversion;
				echo json_encode($response);exit;
			}else{
				if(!empty($_REQUEST['v3'])){
					$response = array();
					$response['basedata'] = strval($userid);
					$response['version'] = $currentversion;
					echo json_encode($response);
				} else {
					$response = array();
					$response['basedata'] = strval($userid);
					$response['version'] = $currentversion;
					echo json_encode($response);
				}
			exit;
			}
		}
	}
	if(!empty($forgot_url)){
$forgot_link = "
		<div id='forgotBox' class='divBox'>
			<span id='forgotPass' name='remember'>{$forgot}</span>
		</div>";
	}
	if(!empty($signUp_url)){
$signUp_link = "
		<div id='signUpBox'  class='divBox'>
			<span id='signUpSpan'>
			    <input type='submit' id='signUp' name='signUp' value='{$register}'/>
			</span>
		</div>";
	}
	if($branded){
		$logo_url="http://chat.phpchatsoftware.com/extensions/desktop/images/logo_login.png";
	}else{
		$logo_url=BASE_URL."extensions/desktop/images/logo_login.png";
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>CometChat Messenger</title>
		<script src="js.php?type=core&name=jquery" type="text/javascript"></script>
		<style>
			body{
				height:100%;
				width: 100%;
				background-color: <?php echo $login_background; ?>;
			}
			#mainContainer {
				overflow: hidden;
				background: white;
				position: absolute;
				background-color: <?php echo $login_background; ?>;
			}
			#companyLogoDiv {
				float: left;
				width: 100%;
				margin-top: 40px;
				margin-bottom: 20px;
				margin-left: 15px;
			}
			#companyLogoSpan {
				margin: 0 auto;
			    width: 200px;
			}
			.divBox {
				float: left;
				width: 100%;
				margin:5px auto;
			}
			#forgotPasswordSpan {
				float: left;
				width: 100%;
				text-align: center;
				font-size: 11px;
			}
			#signInSpan {
				float: left;
				width: 100%;
				text-align: center;
			}
			#username {
				height: 18px;
				width: 160px;
				border: none;
				color: <?php echo $login_foreground_text; ?>;
				background-color: <?php echo $login_background; ?>;
			}
			#userNameBox{
				border: 0px solid #000000;
			    border-bottom-width: 1px;
			    background-color: transparent;
			}
			#userNameSpan {
				height: 25px;
				line-height: 25px;
			}
			#password{
				height: 18px;
				width: 160px;
				border: none;
				color: <?php echo $login_foreground_text; ?>;
				background-color: <?php echo $login_background; ?>;
			}
			#passwordBox{
				border: 0px solid #000000;
			    border-bottom-width: 1px;
			    background-color: transparent;
			}
			#passwordSpan {
				height: 25px;
				line-height: 25px;
			}
			#signIn {
				margin: 0 auto;
				width: 180px;
				font-weight: bold;
				border : none;
				padding: 5px;
				background-color: <?php echo $login_button_pressed; ?>;
				color : <?php echo $login_button_text; ?>;
			}
			#loginInfoContainer {
				margin: 0 auto;
				width: 180px;
				height: 226px;
				font: 15px arial,sans-serif;
				font-size: 12px;
				color : <?php echo $login_button_text; ?>;
			}
			.rememberPasswordSpan {
				margin: 0 auto;
				float: left;
				height: 20px;
				color: <?php echo $login_button_pressed; ?>
			}
			#companyLogoDiv img{
				margin-left: 6px;
			}
			#clear{
				margin-bottom: 10px;
			}
			#username,#password,#signIn:focus {
			  outline:none;
			}
			#loadingDiv{
				visibility: hidden;
			}
			img{
				display:block;
				margin: 0 auto;
				cursor: pointer;
			}
			#remember,#remPass,#signIn:hover,#forgot:hover,#signUp:hover,#forgotPass:hover {
				cursor: pointer;
			}
			#remember,#remPass,#signIn:hover,#forgot:hover,#signUp:hover,#forgotPass:hover {
				outline: none;
			}
			#remember{
				margin-left: 0px;
			}
			#forgot {
                margin: 0 auto;
                width: 180px;
                font-weight: bold;
                border : none;
                padding: 5px;
                background-color: <?php echo $login_button_pressed; ?>;
                color : <?php echo $login_button_text; ?>;
            }
            #forgotBox {
            	text-align: center;
                color: <?php echo $login_button_pressed; ?>
            }
            #signUpSpan {
                float: left;
                width: 100%;
                text-align: center;
            }
            #signUp {
                margin: 0 auto;
                width: 180px;
                font-weight: bold;
                padding: 5px;
                color: <?php echo $login_button_pressed; ?>;
                background-color : <?php echo $login_button_text; ?>;
                border: 2px solid <?php echo $login_button_pressed; ?>;
            }
			::-webkit-input-placeholder { /* WebKit, Blink, Edge */
			    color: <?php echo $login_placeholder; ?>;
			}
		</style>
	</head>
	<body>
		<div id="mainContainer">
			<div id="companyLogoDiv"  unselectable="on">
				<div id="companyLogoSpan" unselectable="on"><img id="comapanyImage" src="<?php echo $logo_url;?>" width="150px" heigth="100px" alt="Company Logo" oncontextmenu="return false;" unselectable="on"/>
				</div>
			</div>
			<div id="loginInfoContainer">
					<div id="userNameBox" class="divBox">
						<input type="text" id="username" name="username" placeholder="<?php echo $username;?>"/>
					</div>
					<div id="passwordBox" class="divBox">
						<input type="password" id="password" name="password" placeholder="<?php echo $password;?>"/>
					</div>
					<div  class="divBox">
						<span class="rememberPasswordSpan">
							<input id="remember" type="checkbox" name="rem_pswd" value="password" />
						</span>
						<span id="remPass" name="remember" class="rememberPasswordSpan" style="line-height:20px;"><?php echo $remember;?></span>
					</div>
					<div id="signInBox"  class="divBox">
						<span id="signInSpan">
							<input type="submit" id="signIn" name="Login" value="<?php echo $login;?>"/>
						</span>
					</div>
					<?php echo $forgot_link; ?>
					<div id="loadingDiv" class="divBox">
    					<img id="loading" src="<?php echo BASE_URL; ?>extensions/desktop/images/loading.gif" alt="loading"/>
    				</div>
					<?php echo $signUp_link; ?>
			</div>
		</div>
		<script>
		document.addEventListener("dragover",function(e){
		   e = e || event;
		   e.preventDefault();
		},false);
		document.addEventListener("drop",function(e){
			e = e || event;
			e.preventDefault();
		},false);
		</script>
		<script>
		var basepath = '<?php echo BASE_URL; ?>';
		jqcc(function() {
		    jqcc(window).on('resize', function resize()  {
		        jqcc(window).off('resize', resize);
		        setTimeout(function () {
		            var content = jqcc('#mainContainer');
		            var top = (window.innerHeight - content.height()) / 2;
		            var left = (window.innerWidth - content.width()) / 2;
		            content.css('top', Math.max(0, top) + 'px');
		            content.css('left', Math.max(0, left) + 'px');
		            jqcc(window).on('resize', resize);
		        }, 50);
		    }).resize();
		});
		jqcc("#password").keydown(function(e) {
			var message = jqcc('#site_url').val();
			if (e.keyCode == 13) {
				chatboxkeyDown(message);
			}
		});
		jqcc('#username, #password').keyup(function(e){
			if (e.keyCode != 13) {
				if(jqcc('#main_error').length>0){
					jqcc('#main_error').remove();
				}
			}
		})
		jqcc('#remPass').click(function(){
			if(jqcc("#remember").is(':checked')){
				jqcc('#remember').attr('checked', false);
			}else{
				jqcc('#remember').attr('checked', true);
			}
		});
		jqcc('#signIn').live('click',function(event){
			var message = jqcc('#site_url').val();
			chatboxkeyDown(message);

		});
		jqcc('#forgotPass').click(function(){
			var forgot_url = "<?php echo $forgot_url; ?>";
			var controlparameters = {"type":"extensions", "name":"desktop", "method":"forgot_pass", "params":{"forgot_url":forgot_url}};
			controlparameters = JSON.stringify(controlparameters);
			parent.postMessage('CC^CONTROL_'+controlparameters,'*');
		});
		jqcc('#signUp').live('click',function(event){
			var signUp_url = "<?php echo $signUp_url; ?>";
			var controlparameters = {"type":"extensions", "name":"desktop", "method":"signup", "params":{"signup_url":signUp_url}};
			controlparameters = JSON.stringify(controlparameters);
			parent.postMessage('CC^CONTROL_'+controlparameters,'*');
		});
		function chatboxkeyDown(message) {
			var uName = jqcc('#username').val();
			var password = jqcc('#password').val();
			if(uName!="" && password==""){
				jqcc('#password').val('');
				if(jqcc('#main_error').length==0){
					jqcc('#passwordBox').append('<div id="main_error" style="display:inline"><div id="error" style="float:right; display:inline-block;height:16px;width:16px;"><img src="'+basepath+'extensions/desktop/images/error.png" height="16px" width="16px"></img></div><div class="arrow-up" style="width: 0;height: 0;border-left: 5px solid transparent;border-right: 5px solid transparent;border-bottom: 5px solid red;position: relative; float: right;right: 3px;"><hr style="border-color: red;border-style: inset;border-width: 1px;margin: 0px;width: 132px;float: right;position: relative;top: 6px;right:-8px;"><div id="error" style="float:right; display:inline-block;position: relative;height: 17px;width: 128px;color: #fff;background-color: #000;z-index: 10000;padding:3px;top:6px;right:-8px;">Please enter password</div></div>');
				}
			}else if(uName=="" && password!=""){
				jqcc('#username').val('');
				jqcc('#password').val('');
				if(jqcc('#main_error').length==0){
					jqcc('#userNameBox').append('<div id="main_error" style="display:inline"><div id="error" style="float:right; display:inline-block;height:16px;width:16px;"><img src="'+basepath+'extensions/desktop/images/error.png" height="16px" width="16px"></img></div><div class="arrow-up" style="width: 0;height: 0;border-left: 5px solid transparent;border-right: 5px solid transparent;border-bottom: 5px solid red;position: relative; float: right;right: 3px;"><hr style="border-color: red;border-style: inset;border-width: 1px;margin: 0px;width: 138px;float: right;position: relative;top: 6px;right:-8px;"><div id="error" style="float:right; display:inline-block;position: relative;height: 17px;width: 132px;color: #fff;background-color: #000;z-index: 10000;padding:3px;top:6px;right:-8px;">Please enter username</div></div>');
				}
			}else if(uName!="" && password!=""){
				jqcc("#loadingDiv").css('visibility','visible');
				setTimeout(function(){
					jqcc.ajax({
						data:{username: uName, password: password, process: 1, callbackfn:'desktop'},
						success: function(data){
							data = JSON.parse(data);
							data=data.basedata;
							if(data!=0){
								if(jqcc("#remember").is(':checked')){
									var controlparameters = {"type":"extensions", "name":"desktop", "method":"login", "params":{"dm_id":data}};
			            			controlparameters = JSON.stringify(controlparameters);
			            			parent.postMessage('CC^CONTROL_'+controlparameters,'*');
		            			}
		            			window.location.href=basepath+'cometchat_popout.php?basedata='+data+'&callbackfn=desktop';
							}else{
								jqcc("#loadingDiv").css('visibility','hidden');
								jqcc('#username').val('');
								jqcc('#password').val('');
								if(jqcc('#main_error').length==0){
								jqcc('#userNameBox').append('<div id="main_error" style="display:inline"><div id="error" style="float:right; display:inline-block;height:16px;width:16px;"><img src="'+basepath+'extensions/desktop/images/error.png" height="16px" width="16px"></img></div><div class="arrow-up" style="width: 0;height: 0;border-left: 5px solid transparent;border-right: 5px solid transparent;border-bottom: 5px solid red;position: relative; float: right;right: 3px;"><hr style="border-color: red;border-style: inset;border-width: 1px;margin: 0px;width: 125px;float: right;position: relative;top: 6px;right:-8px;"><div id="error" style="float:right; display:inline-block;position: relative;height: 17px;width: 121px;color: #fff;background-color: #000;z-index: 10000;padding:3px;top:6px;right:-8px;">Check your username</div></div>');
								}
							}
						}
					});
				},3000);
			}else{
				jqcc('#username').val('');
				jqcc('#password').val('');
				if(jqcc('#main_error').length==0){
				jqcc('#userNameBox').append('<div id="main_error" style="display:inline"><div id="error" style="float:right; display:inline-block;height:16px;width:16px;"><img src="'+basepath+'extensions/desktop/images/error.png" height="16px" width="16px"></img></div><div class="arrow-up" style="width: 0;height: 0;border-left: 5px solid transparent;border-right: 5px solid transparent;border-bottom: 5px solid red;position: relative; float: right;right: 3px;"><hr style="border-color: red;border-style: inset;border-width: 1px;margin: 0px;width: 132px;float: right;position: relative;top: 6px;right:-8px;"><div id="error" style="float:right; display:inline-block;position: relative;height: 17px;width: 128px;color: #fff;background-color: #000;z-index: 10000;padding:3px;top:6px;right:-8px;">Please enter username</div></div>');
				}
			}
		}
		</script>
	</body>
</html>