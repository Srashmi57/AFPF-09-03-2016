<?php
if(!empty($_REQUEST['basedata'])&&!empty($_REQUEST['ccmobileauth'])){
	$ccmobileauth = md5($_REQUEST['basedata'].'cometchat');
	$cookiePrefix = $_REQUEST['cookiePrefix'];
	if($_REQUEST['ccmobileauth'] == $ccmobileauth){
		setcookie($cookiePrefix.'data',$_REQUEST['basedata'],0,'/');
		setcookie($cookiePrefix.'mobilewebapp_open',1,0,'/');
	}else{
		$_REQUEST['basedata'] = 0;
		setcookie($cookiePrefix.'data',0,0,'/');
	}
}

include_once(dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."modules.php");
include_once(dirname(__FILE__).DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR."en.php");
include_once(dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."modules".DIRECTORY_SEPARATOR."chatrooms".DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR."en.php");
include_once(dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."modules".DIRECTORY_SEPARATOR."chatrooms".DIRECTORY_SEPARATOR."config.php");
include_once(dirname(__FILE__).DIRECTORY_SEPARATOR."config.php");

if (file_exists(dirname(__FILE__).DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR.$lang.".php")) {
	include_once(dirname(__FILE__).DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR.$lang.".php");
}
if (file_exists (dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."modules".DIRECTORY_SEPARATOR."chatrooms".DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR.$lang.".php")) {
	include_once(dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."modules".DIRECTORY_SEPARATOR."chatrooms".DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR.$lang.".php");
}
if(!(in_array('mobilewebapp',$extensions))){
	echo $mobilewebapp_language[33];
	exit;
}

?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta name="viewport" content="user-scalable=0,width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0" />
		<link rel="apple-touch-icon" href="images/apple-touch-icon.png"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $mobilewebapp_language[0]; ?></title>

		<link type="text/css" href="../../css.php?type=extension&name=mobilewebapp" rel="stylesheet" charset="utf-8">

		<script type="text/javascript" charset="utf-8" src="../../js.php?type=core&name=jquery"></script>
		<script>
			$ = jQuery = jqcc;
		</script>
		<script type="text/javascript" charset="utf-8" src="../../js.php?type=extension&name=mobilewebapp&callbackfn=mobilewebapp"></script>
		<script type="text/javascript" charset="utf-8" src="../../js.php?type=module&name=chatrooms&callbackfn=mobilewebapp"></script>
		<script>
            var isPhoneTouched = 0;
            document.addEventListener('touchstart', function() {
                if (isPhoneTouched == 0) {
                    document.getElementsByTagName('audio')[0].play();
                    document.getElementsByTagName('audio')[0].pause();
                    isPhoneTouched = 1;
                }
            });

			$("#buddy_link").live('click', function() {
				$('.chatlink_icon').html('<span class="notifier">0</span>');
				$("#footer #footerbtns .button-group li").find('#buddy_link').addClass('btn-active');
				$("#footer #footerbtns .button-group li").find('#chatroomlink').removeClass('btn-active');
				jqcc.mobilewebapp.pathRedirect('#buddy');
			});
			$("#chatroomlink").live('click', function() {
				$("#footer #footerbtns .button-group li").find("#chatroomlink").addClass('btn-active');
				$("#footer #footerbtns .button-group li").find('#buddy_link').removeClass('btn-active');
				jqcc.mobilewebapp.pathRedirect('#lobby');
			});
			function logoutmobilewebapp() {
			    jqcc.cookie('<?php echo $cookiePrefix?>data', null);
			    jqcc.cookie('<?php echo $cookiePrefix?>mobilewebapp_open', null);
			}
			$(function() {
				var enableType = '<?php echo $enableType ?>';
				$('#options').on('click', function() {
					$('#cometchat_container_report .cometchat_container_title .cometchat_closebox').click();
					if($("#opt").is(':visible')) {
						$('#opt').css('display','none');
					} else {
						$('#opt').css('display','block');
					}
				});
				$('#chatcontent').on('click', function() {
					$('#opt').css('display','none');
				});
				$("#chatroommessage").on('click', function() {
					setTimeout(function () {jqcc.mobilewebapp.crscrollToBottom();},700);
				});
				$("#chatmessage").on('click', function() {
					setTimeout(function () {jqcc.mobilewebapp.scrollToBottom();},700);
				});
				$("#chatroommessage").keyup(function(event) {
					if($("#chatroommessage").val() !== '' && event.keyCode == 13 && event.shiftKey == 0) {
						$("#chatroom_send").click();
					}
				});
			});
        </script>
	</head>

	<body onbeforeunload="return logoutmobilewebapp()" onunload="return logoutmobilewebapp()">
		<?php if($enableType == 0 OR $enableType == 2):?>
        <div id="buddy" style="background:inherit;width:100% !important;" class="displaynone">
            <nav class="top-bar" id="header">
				<div class="small-3 columns" id="home">
					<a id="buddyhome">
					<div class="home_icon">
						<div class="arrow-up"></div>
						<div class="rect1"></div>
						<div class="rect2"></div>
					</div>
					</a>
				</div>
				<div class="small-6 columns" id="createheader">
					<h1><?php echo $mobilewebapp_language[18]; ?></h1>
					<audio style="display:none">
						<source src="mp3/beep.mp3" type="audio/mpeg">
					</audio>
				</div>
				<div class="small-3 columns">
					<?php if(USE_CCAUTH == 1):?>
					<a id="buddylogout">
					<div class="logout_icon">
						<img src="images/logout.png">
					</div>
					</a>
					<?php endif;?>
				</div>
            </nav>
			<div id="wocontent">
                <div id="woscroll">
					<div class="row" id="search">
						<input  type="text" id="searchtxt" onKeyup="jqcc.mobilewebapp.get_user();" placeholder="<?php echo $mobilewebapp_language[15]; ?>">
					</div>
					<div class="row" id="userlist">
						<ul id="wolist" class="small-12 columns">
						</ul>
						<div id="endoftext"></div>
					</div>
                </div>
            </div>
			<?php if($enableType == 0):?>
			<div id="footer" class="row">
				<div class="small-12 columns" id="footerbtns">
					<ul class="button-group">
						<li><a href="#buddy" id="buddy_link" class="small button chatlink"><div class="chatlink_icon"><span class="notifier">0</span></div><div class="chatlink_txt"><?php echo $mobilewebapp_language[20]; ?></div></a></li>
						<li><a href="#lobby" id="chatroomlink" class="small button chatroomlink"><div class="chatroomlink_icon"></div><div class="chatroomlink_txt"><?php echo $mobilewebapp_language[21]; ?></div></a></li>
					</ul>
				</div>
			</div>
			<?php endif;?>
        </div>
		<?php endif;?>


		<div id="chat" style="background:inherit;width:100% !important;" class="displaynone">
			<div id="cheader">
				<div class="row" id="chatheader">
					<div class="small-3 columns">
						<a id="backbtnChat" onclick="javascript:jqcc.mobilewebapp.loadChatboxReverse()">
							<div class="back_icon">
								<div class="arrow-left"></div>
								<div class="rectangle"></div>
							</div>
						</a>
					</div>
					<div class="small-6 columns" id="createheader">
						<h1></h1>
					</div>
					<div class="small-3 columns chatoptions">
						<a id="options">
						<div class="option_icon">
							<div class="bar1"></div>
							<div class="bar2"></div>
							<div class="bar3"></div>
						</div>
						</a>
					</div>
				</div>
			</div>
			<div id="opt">
				<div id="clear"><img src="images/clearconversation.png"/>&nbsp;&nbsp;&nbsp;<?php echo $mobilewebapp_language[30]; ?></div>
				<div id="report"><img src="images/report.png"/>&nbsp;&nbsp;<?php echo $mobilewebapp_language[31]; ?></div>
			</div>
			<div id="chatcontent">
				<div id="scroller">
				</div>
				<div id="endoftext"></div>
			</div>
			<div id="chatfooter">
				<div id="chatmessageForm" onclick="" data-ajax="false">
					<div class="small-9 columns" id="chattxt">
						<input id="chatmessage" type="text" name="chatmessage" onFocus="jqcc.mobilewebapp.txtfocus();" placeholder="<?php echo $mobilewebapp_language[9]; ?>"/>
					</div>
					<div class="small-3 columns" id="chatsendbutton">
						<a id="chat_send" class="mobile_send small alert button"><?php echo $mobilewebapp_language[25]; ?></a>
					</div>
				</div>
			</div>
		</div>

		<?php if($enableType == 0 OR $enableType == 1):?>
        <div id="lobby" style="background:inherit;width:100% !important;" class="displaynone">
			<nav class="top-bar" id="header">
				<div class="row">
					<div class="small-3 columns" id="home">
						<a id="lobbyhome">
						<div class="home_icon">
							<div class="arrow-up"></div>
							<div class="rect1"></div>
							<div class="rect2"></div>
						</div>
						</a>
					</div>
					<div class="small-6 columns" id="crheader">
						<h1><?php echo $mobilewebapp_language[19]; ?></h1>
					</div>
					<div class="small-3 columns" id="adddiv">
						<?php if ($allowUsers == '1'): ?>
							<a id="addchatroom" href="javascript:void(0);" onclick="javascript:jqcc.mobilewebapp.createChatroom()">
							<div class="add_icon">
								<div class="vertrect"></div>
								<div class="horirect"></div>
							</div>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</nav>
			<div id="lobbycontent">
                <div id="lobbyscroller">
					<div class="row" id="search">
						<input type="text" id="searchtxtCR" onKeyup="jqcc.mobilewebapp.get_chatroom();" placeholder="<?php echo $mobilewebapp_language[16]; ?>">
					</div>
					<div class="row" id="chatroomlist">
						<ul id="lobbylist" class="small-12 columns">
						</ul>
					</div>
                </div>
            </div>
			<?php if($enableType == 0):?>
			<div id="footer" class="row">
				<div class="small-12 columns" id="footerbtns">
					<ul class="button-group">
						<li><a href="#buddy" id="buddy_link" class="small button chatlink"><div class="chatlink_icon"></div><div class="chatlink_txt"><?php echo $mobilewebapp_language[20]; ?></div></a></li>
						<li><a href="#lobby" id="chatroomlink" class="small button chatroomlink"><div class="chatroomlink_icon"></div><div class="chatroomlink_txt"><?php echo $mobilewebapp_language[21]; ?></div></a></li>
					</ul>
				</div>
			</div>
			<?php endif;?>
        </div>
		<?php endif;?>


		<div id="chatroom" style="background:inherit;width:100% !important;" class="displaynone">
 			<div id="crheadertop">
				<div class="row" id="chatroomheader">
					<div class="small-3 columns">
						<a id="backbtnChatroom" onclick="javascript:jqcc.mobilewebapp.mobileleaveChatroom();jqcc.mobilewebapp.loadLobbyReverse();" class="small alert button bck">
						<div class="back_icon">
							<div class="arrow-left"></div>
							<div class="rectangle"></div>
						</div>

						</a>
					</div>
					<div class="small-6 columns" id="createheader">
						<span id="chatroomName"></span>
					</div>
					<div class="small-3 columns">
						<a id="showUserButton" onclick="javascript:jqcc.mobilewebapp.showChatroomUser();">
						<div class="user_icon">
							<div class="user_right">
								<div class="circleBase3 type3"></div>
								<div class="circleBase4 type4"></div>
							</div>
							<div class="user_left">
								<div class="circleBase5 type5"></div>
								<div class="circleBase6 type6"></div>
							</div>
							<div class="user_main">
								<div class="circleBase1 type1"></div>
								<div class="circleBase2 type2"></div>
							</div>
						</div>
						</a>
					</div>
				</div>
			</div>
            <div id="chatroomcontent" >
                <div id="crscroller">
                </div>
                <div id="endoftext"></div>
            </div>
  			<div id="chatroomfooter" class="row">
                <div id="chatroommessageForm" onsubmit="#" data-ajax="false">
					<div class="small-9 columns" id="chattxt">
						<input id="chatroommessage" type="text" name="chatmessage" placeholder="<?php echo $mobilewebapp_language[9]; ?>"/>
					</div>
					<div class="small-3 columns" id="chatsendbutton">
						<a id="chatroom_send" class="mobile_send small alert button" onclick="javascript:jqcc.mobilewebapp.sendchatroommessage($('#chatroommessage'));"><?php echo $mobilewebapp_language[25]; ?></a>
					</div>
                </div>
            </div>
        </div>


        <div id="chatroomuser" style="background:inherit;width:100% !important;" class="displaynone">
			<nav class="top-bar" id="header">
				<div class="row" id="chatroomuserheader">
					<div class="small-3 columns">
						<a id="backbtnChatroomuser" onclick="javascript:jqcc.mobilewebapp.loadChatroomReverse();jqcc.mobilewebapp.crscrollToBottom();" >
							<div class="back_icon">
							<div class="arrow-left"></div>
							<div class="rectangle"></div>
							</div>
						</a>
					</div>
					<div class="small-6 columns" id="createheader">
						<span id="chatroomUserName" style="margin:0 auto;padding:0 10px;height:inherit;display:inline-block;"></span>
					</div>
					<div class="small-3 columns">&nbsp;</div>
				</div>
			</nav>
			<div class="row" id="chatroomusercontent">
				<div id="cruserScroll">
					<ul id="currentroom_users" class="small-12 columns">
					</ul>
				</div>
			</div>
        </div>


        <div id="createChatroom" style="background:inherit;width:100% !important;" class="displaynone">
			<nav  id="header">
				<div class="row">
					<div class="small-3 columns">
						<a id="backbtnCreateChatroom" onclick="javascript:jqcc.mobilewebapp.loadLobbyReverse()" class="small alert button bck">
						<div class="back_icon">
							<div class="arrow-left"></div>
							<div class="rectangle"></div>
						</div>
						</a>
					</div>
					<div class="small-6 columns" id="createheader">
						<h1><?php echo $mobilewebapp_language[22]; ?></h1>
					</div>
					<div class="small-3 columns">&nbsp;</div>
				</div>
			</nav>
            <div style="font-size:13px;">
                <form id="createChatroomForm"  onsubmit="return false" data-ajax="false">
                    <div class="row" id="crname" >
						<div class="small-4 columns" id="labelname">
							<label class="chatroomedit" for="name"><?php echo $chatrooms_language[27]; ?></label>
						</div>
                        <div class="small-8 columns">
							<input type="text" name="name" id="name" value="" />
						</div>
                    </div>
                    <div class="row" id="crtype" >
                        <div class="small-4 columns">
							<label class="chatroomedit" for="type" class="select"><?php echo $chatrooms_language[28]; ?></label>
						</div>
						<div class="small-8 columns">
							<select name="type" id="type" onchange="javascript:jqcc.mobilewebapp.checkDropDown(this)">
								<option value="0"><?php echo $chatrooms_language[29]; ?></option>
								<option value="1"><?php echo $chatrooms_language[30]; ?></option>
							</select>
						</div>
                    </div>
					<div class="row" id="chatroomPassword">
						<div class="small-4 columns" id="labelname">
							<label for="password"><?php echo $chatrooms_language[32]; ?></label>
						</div>
                        <div class="small-8 columns">
							<input type="password" name="password" id="password" value="" />
						</div>
                    </div>
					<div class="row" id="createbtn">
						<div id="createChatroomField" class="small-12 columns">
							<a id="createChatroomButton" class="small button success radius" onclick="javascript:jqcc.mobilewebapp.mobilecreateChatroomSubmit()"><?php echo $chatrooms_language[33]; ?></a>
						</div>
					</div>
                </form>
            </div>
        </div>
	</body>

	<script type="text/javascript">
		var reportPlugin = 0;
		var clearPlugin = 0;
		var plugins = <?php echo json_encode($plugins); ?>;
		if(plugins.indexOf("report") != -1) {
			reportPlugin = 1;
		}
		if(plugins.indexOf("clearconversation") != -1) {
			clearPlugin = 1;
		}
		if(clearPlugin == 0 && reportPlugin == 0) {
			$("#options").css('display','none');
		}
		if(clearPlugin == 1 && reportPlugin == 0) {
			$("#report").css('display','none')
			$("#opt").css('height','35px');
		}
		if(clearPlugin == 0 && reportPlugin == 1) {
			$("#clear").css('display','none')
			$("#opt").css('height','35px');
		}

        $('#buddyhome').css('display','block');
        $('#lobbyhome').css('display','block');
        function ccWebappHome(){
        	 window.location.href = '<?php if(!empty($_SERVER["HTTP_REFERER"])){echo $_SERVER["HTTP_REFERER"];}else{echo $_SERVER["REQUEST_SCHEME"]."://".$_SERVER["HTTP_HOST"];}?>';
        }
        $('#buddyhome').click(function() {ccWebappHome();});
        $('#lobbyhome').click(function() {ccWebappHome();});

		if(enableType == 2){
			jqcc.mobilewebapp.pathRedirect('#buddy');
		} else if(enableType == 1){
			jqcc.mobilewebapp.pathRedirect('#lobby');
		} else{
			jqcc.mobilewebapp.pathRedirect('#buddy');
		}

		jqcc.mobilewebapp.addscroll();
		logout_click();
        function logout_click(){
        	$('#buddylogout .logout_icon').click(function(){
        		$('#buddylogout .logout_icon').unbind('click');
        		$('#buddylogout img').attr('src','images/loading.gif');
				jqcc.ajax({
		            url: jqcc.cometchat.getBaseUrl()+'functions/login/logout.php',
		            dataType: 'jsonp',
                    success: function(){
                    	clearTimeout(jqcc.cometchat.getCcvariable().heartbeatTimer);
		                $('#buddylogout img').attr('src','images/logout.png');
		                logout_click();
		                jqcc.mobilewebapp.loggedOut();
	                    jqcc.cometchat.setThemeVariable('loggedout', 1);
		            },
		            error: function(){
		            	logout_click();
		                alert('<?php echo $language[81];?>');
		            }
		        });
			});
	    }
	</script>
</html>