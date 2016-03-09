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

include_once((dirname(__FILE__)).DIRECTORY_SEPARATOR.'cometchat_init.php');

$files = array('config.php','colors/synergy.php','cache/','modules/','plugins/','temp/','lang/','themes/','plugins/handwrite/uploads/','plugins/filetransfer/uploads/','images/smileys/');
$extra = '';

$unwritable = '';
foreach ($files as $file) {
	if (iswritable(dirname(__FILE__).'/'.$file)) {
	} else {
		$unwritable .= '<br/>'.$file;
	}
}

if (!empty($unwritable)) {
	$extra = "<br/><br/><strong>Please CHMOD the following files<br/>and folders to 777:</strong><br/>$unwritable";
}

function iswritable($path) {

	if ($path{strlen($path)-1}=='/')
		return iswritable($path.uniqid(mt_rand()).'.tmp');

	if (file_exists($path)) {
		if (!($f = @fopen($path, 'r+')))
			return false;
		fclose($f);
		return true;
	}

	if (!($f = @fopen($path, 'w')))
		return false;
	fclose($f);
	unlink($path);
	return true;
}

$body = '';
$path = '';

$rollback = 0;
$errors = '';
$cometchat_chatrooms_users = '';
$sql = mysqli_query($GLOBALS['dbh'],'select 1 from `cometchat_chatrooms_users`');

if($sql == TRUE) {
    $sql = ("show FULL columns from cometchat_chatrooms_users");
    $res = mysqli_query($GLOBALS['dbh'],$sql);
    $row = mysqli_fetch_assoc($res);

    if(!isset($row['isbanned'])) {
        $cometchat_chatrooms_users = "ALTER TABLE cometchat_chatrooms_users ADD COLUMN isbanned int(1) default 0;";
    }
} else {
    $cometchat_chatrooms_users = "CREATE TABLE IF NOT EXISTS `cometchat_chatrooms_users` (
  `userid` int(10) unsigned NOT NULL,
  `chatroomid` int(10) unsigned NOT NULL,
  `lastactivity` int(10) unsigned NOT NULL,
  PRIMARY KEY  USING BTREE (`userid`,`chatroomid`),
  `isbanned` int(1) default 0,
  KEY `chatroomid` (`chatroomid`),
  KEY `lastactivity` (`lastactivity`),
  KEY `userid` (`userid`),
  KEY `userid_chatroomid` (`chatroomid`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
}
$cometchat_messages_old = "cometchat_messages_old_".time();
$content = <<<EOD
RENAME TABLE `cometchat` to `{$cometchat_messages_old}`;

CREATE TABLE  `cometchat` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `from` int(10) unsigned NOT NULL,
  `to` int(10) unsigned NOT NULL,
  `message` text NOT NULL,
  `sent` int(10) unsigned NOT NULL default '0',
  `read` tinyint(1) unsigned NOT NULL default '0',
  `direction` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `to` (`to`),
  KEY `from` (`from`),
  KEY `direction` (`direction`),
  KEY `read` (`read`),
  KEY `sent` (`sent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cometchat_announcements` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `announcement` text NOT NULL,
  `time` int(10) unsigned NOT NULL,
  `to` int(10) NOT NULL,
  `recd` int(1) NOT NULL DEFAULT 0,

  PRIMARY KEY  (`id`),
  KEY `to` (`to`),
  KEY `time` (`time`),
  KEY `to_id` (`to`,`id`)
) ENGINE=InnoDB AUTO_INCREMENT = 5000 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `cometchat_chatroommessages` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `userid` int(10) unsigned NOT NULL,
  `chatroomid` int(10) unsigned NOT NULL,
  `message` text NOT NULL,
  `sent` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `userid` (`userid`),
  KEY `chatroomid` (`chatroomid`),
  KEY `sent` (`sent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cometchat_chatrooms` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `lastactivity` int(10) unsigned NOT NULL,
  `createdby` int(10) unsigned NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `vidsession` varchar(512) default NULL,
  PRIMARY KEY  (`id`),
  KEY `lastactivity` (`lastactivity`),
  KEY `createdby` (`createdby`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cometchat_status` (
  `userid` int(10) unsigned NOT NULL,
  `message` text,
  `status` enum('available','away','busy','invisible','offline') default NULL,
  `typingto` int(10) unsigned default NULL,
  `typingtime` int(10) unsigned default NULL,
  `isdevice` int(1) unsigned NOT NULL default '0',
  `lastactivity` int(10) unsigned NOT NULL default '0',
  `lastseen` int(10) unsigned NOT NULL default '0',
  `lastseensetting` int(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`userid`),
  KEY `typingto` (`typingto`),
  KEY `typingtime` (`typingtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `cometchat_status`
add column(
`lastseen` int(10) unsigned NOT NULL default '0',
`lastseensetting` int(1) unsigned NOT NULL default '0'
);

CREATE TABLE IF NOT EXISTS `cometchat_videochatsessions` (
  `username` varchar(255) NOT NULL,
  `identity` varchar(255) NOT NULL,
  `timestamp` int(10) unsigned default 0,
  PRIMARY KEY  (`username`),
  KEY `username` (`username`),
  KEY `identity` (`identity`),
  KEY `timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cometchat_block` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `fromid` int(10) unsigned NOT NULL,
  `toid` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fromid` (`fromid`),
  KEY `toid` (`toid`),
  KEY `fromid_toid` (`fromid`,`toid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cometchat_guests` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lastactivity` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `lastactivity` (`lastactivity`)
) ENGINE=InnoDB AUTO_INCREMENT=10000001 DEFAULT CHARSET=utf8;

INSERT INTO `cometchat_guests` (`id`, `name`, `lastactivity`) VALUES ('10000000', 'guest-10000000', '0');

CREATE TABLE IF NOT EXISTS `cometchat_session` (
  `session_id` char(32) NOT NULL,
  `session_data` text NOT NULL,
  `session_lastaccesstime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cometchat_users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `displayname` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `avatar` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL,
  `grp` varchar(25) NOT NULL,
  `friends` text NOT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

{$cometchat_chatrooms_users}

EOD;

	$q = preg_split('/;[\r\n]+/',$content);

	foreach ($q as $query) {
		if (strlen($query) > 4) {
		$result = mysqli_query($GLOBALS['dbh'],$query);
			if (!$result) {
				$rollback = 1;
				$errors .= mysqli_error($GLOBALS['dbh'])."<br/>\n";
			}
		}
	}



	$sql = ("show table status where name = '".TABLE_PREFIX.DB_USERTABLE."'");
	$query = mysqli_query($GLOBALS['dbh'],$sql);
	$result = mysqli_fetch_assoc($query);

	$table_co = $result['Collation'];

	$sql = ("show FULL columns from ".TABLE_PREFIX.DB_USERTABLE." where field = '".DB_USERTABLE_NAME."'");
	$query = mysqli_query($GLOBALS['dbh'],$sql);
	echo mysqli_error($GLOBALS['dbh']);
	$result = mysqli_fetch_assoc($query);

	$field_co = $result['Collation'];

	$field_cs = explode('_',$field_co);
	$field_cs = $field_cs[0];

	if (!empty($table_co)) {
		$result = mysqli_query($GLOBALS['dbh'],"alter table cometchat_guests default collate ".$table_co);
	}

	if (!$result) { $errors .= mysqli_error($GLOBALS['dbh'])."<br/>\n"; }

	if (!empty($field_cs) && !empty($field_co)) {
		$result = mysqli_query($GLOBALS['dbh'],"alter table cometchat_guests convert to character set ".$field_cs." collate ".$field_co);
	}

	if (!$result) { $errors .= mysqli_error($GLOBALS['dbh'])."<br/>\n"; }

        $sql = ("SHOW FULL COLUMNS FROM `cometchat_status` WHERE field = 'isdevice' or field = 'lastactivity'");
        $query = mysqli_query($GLOBALS['dbh'],$sql);
	echo mysqli_error($GLOBALS['dbh']);
	$result = mysqli_fetch_assoc($query);
        if (!($result)) {
            $sql = ("RENAME TABLE `cometchat_status` to `cometchat_status_old`");
            $query = mysqli_query($GLOBALS['dbh'],$sql);

            $sql = ("CREATE TABLE  IF NOT EXISTS `cometchat_status` (
                `userid` int(10) unsigned NOT NULL,
                `message` text,
                `status` enum('available','away','busy','invisible','offline') default NULL,
                `typingto` int(10) unsigned default NULL,
                `typingtime` int(10) unsigned default NULL,
                `isdevice` int(1) unsigned NOT NULL default '0',
                `lastactivity` int(10) unsigned NOT NULL default '0',
                `lastseen` int(10) unsigned NOT NULL default '0',
                `lastseensetting` int(1) unsigned NOT NULL default '0',
                PRIMARY KEY  (`userid`),
                KEY `typingto` (`typingto`),
                KEY `typingtime` (`typingtime`)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
            $query = mysqli_query($GLOBALS['dbh'],$sql);

            $sql = ("INSERT INTO `cometchat_status` (`userid`, `message`, `status`, `typingto`, `typingtime`, `isdevice`, `lastactivity`, `lastseen`, `lastseensetting`) SELECT *, NULL, NULL from `cometchat_status_old`");
            $query = mysqli_query($GLOBALS['dbh'],$sql);
        }

	$baseurl = '/cometchat/';

	if (!empty($_SERVER['DOCUMENT_ROOT']) && !empty($_SERVER['SCRIPT_FILENAME'])) {
		$baseurl = preg_replace('/install.php/i','',str_replace($_SERVER['DOCUMENT_ROOT'],'',$_SERVER['SCRIPT_FILENAME']));
	}

	$baseurl = str_replace('\\','/',$baseurl);

	if ($baseurl[0] != '/') {
		$baseurl = '/'.$baseurl;
	}

	if ($baseurl[strlen($baseurl)-1] != '/') {
		$baseurl = $baseurl.'/';
	}

	$file = 'config.php';
	$content = @file_get_contents($file);

	if ($content != '') {

		$myvar = "define('BASE_URL','{$baseurl}');";

		$content = str_replace("define('BASE_URL','/cometchat/');",$myvar, $content);

		$f = @fopen($file,'w');
		if($f) {
		  @fwrite($f, $content);
		  @fclose($f);
		} else {
		  $extra .= "<br/><br/><strong>Unable to edit config.php.</strong> Find the BASE_URL line in config.php and replace it with:<br/><br/>define('BASE_URL','{$baseurl}');";
		}

		if(empty($apikey)){
		  $apikey = md5(time().$_SERVER['SERVER_NAME']);
		  $content = @file_get_contents($file);
		  $myvar = '$apikey = \''.$apikey.'\';';

		  $content = str_replace('$apikey = \'\';',$myvar, $content);

		  $f = @fopen($file,'w');
		  if($f) {
		    @fwrite($f, $content);
		    @fclose($f);
		  }
		}
	}

	$codeA = '<link type="text/css" href="'.$baseurl.'cometchatcss.php" rel="stylesheet" charset="utf-8">'."\r\n".'<script type="text/javascript" src="'.$baseurl.'cometchatjs.php" charset="utf-8"></script>';

	$codeB = '<script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>'."\r\n".'<script>jqcc=jQuery.noConflict(true);</script>';

	$embedcode = '&lt;div id="cometchat_embed_synergy_container" style="max-width:100%;" >&lt;/div&gt;&lt;script src="'.$baseurl.'js.php?type=core&name=embedcode" type="text/javascript"&gt;&lt;/script&gt;&lt;script&gt;var iframeObj = {};iframeObj.module="synergy";iframeObj.style="min-height:420px;min-width:300px;";iframeObj.src="'.$baseurl.'cometchat_popout.php"; if(typeof(addEmbedIframe)=="function"){addEmbedIframe(iframeObj);}&lt;/script&gt;';

	if (defined('INCLUDE_JQUERY') && INCLUDE_JQUERY == 1) {
		$body = "<div id='install_success'><strong>Installation complete.</strong> Did you expect something more complicated?</div><br/><div id='docked_code'><strong>1. For Docked theme: </strong><br/><br/> Add the following immediately after <strong>&lt;head&gt;</strong> tag in your site template:<br/><br/><textarea readonly id=\"code\" onclick=\"copycode('code')\"  class=\"textarea\" name=\"code\">$codeA</textarea><br/><br/></div><div id='embeded_code'><strong>2. For Embedded theme: </strong><br/><br/> Add the following code in your site's HTML code to embed the chat: <br/><br/><textarea readonly id=\"embedcode\" rows=\"7\" style=\"height:auto;\" onclick=\"copycode('embedcode')\"  class=\"textarea\" name=\"embedcode\">$embedcode</textarea></div>$extra";
	} else {
		$body = "<div id='install_success'><strong>Installation complete.</strong> Did you expect something more complicated?</div><br/><div id='docked_code'><strong>1. For Docked theme: </strong><br/><br/>Add the following immediately after <strong>&lt;head&gt;</strong> tag in your site template:<br/><br/><textarea readonly id=\"codeJ\" onclick=\"copycodeJ()\"  class=\"textarea\" name=\"codeJ\">$codeB</textarea><br/><br/>Add the following immediately before <strong>&lt;/body&gt;</strong> tag in your site template:<br/><br/><textarea readonly id=\"code\" onclick=\"copycode('code')\"  class=\"textarea\" name=\"code\">$codeA</textarea><br/><br/></div><div id='embeded_code'><strong>2. For Embedded theme: </strong><br/><br/> Add the following code in your site's HTML code where you want to embed the chat: <br/><br/><textarea readonly id=\"embedcode\" rows=\"7\" style=\"height:auto;\" onclick=\"copycode('embedcode')\"  class=\"textarea\" name=\"embedcode\">$embedcode</textarea></div>$extra";
	}


?>
<!DOCTYPE HTML>
<html>

	<head>

		<title>CometChat Installation</title>

		<style type="text/css">
			html,body {
				background: #f9f9f9;
				overflow: hidden;
			}
			#container { margin-top: 15px; }
			#box { padding:0px; width:475px; margin:0 auto; }
			#boxtop {
				background: url(images/install_top.png);
				width: auto;
				height: 53px;
				-webkit-border-top-left-radius: 4px;
				-webkit-border-top-right-radius: 4px;
				-moz-border-radius-topleft: 4px;
				-moz-border-radius-topright: 4px;
				border-top-left-radius: 4px;
				border-top-right-radius: 4px;
			}
			#boxrepeat {
				font-family: "Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;
				font-size: 11px;
				color: #333333;
				background: url(images/install_repeat.png);
				width: auto;
				padding: 15px;
				border: 1px solid #d3d3d3;
				border-top: 0px;
				-webkit-border-bottom-left-radius: 4px;
				-webkit-border-bottom-right-radius: 4px;
				-moz-border-radius-bottomleft: 4px;
				-moz-border-radius-bottomright: 4px;
				border-bottom-left-radius: 4px;
				border-bottom-right-radius: 4px;
			}
			#boxbottom { background: url(images/install_bottom.png); width: auto; height: 25px;}

			.textarea {
				font-family: "Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;
				font-size: 10px;
				color: #333333;
				width: 435px;
				border: 1px solid #ccc;
				padding: 2px;
				height: 80px;
				overflow:hidden;
				line-height: 14px;
			}

			#install_success {
				margin: 0 auto;
  				width: 450px;
			}

			#docked_code {
				margin: 0 auto;
  				width: 450px;
			}

			#embeded_code {
				margin: 0 auto;
  				width: 450px;
			}

		</style>

		<script>
			function copycode(code) {
				var tempval= document.getElementById(code);
				tempval.focus()
				tempval.select()
			}

			function copycodeJ() {
				var tempval= document.getElementById('codeJ');
				tempval.focus()
				tempval.select()
			}
		</script>

		<!--[if IE]>

		<style type="text/css">

			#container { position: relative; }
			#position { position: absolute; top: 50%; }
			#content { position: relative; width:100%; top: -50%; }
			#box { position:relative; left:50%; margin-left:-181px; }

		</style>

		<![endif]-->

	</head>

	<body>

		<div id="container">
			<div id="position">
				<div id="content">
					<div id="box">
						<div id="boxtop"></div>
						<div id="boxrepeat"><?php echo $body;?></div>
						<div id="boxbottom"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- License void if removed -->
		<?php
			echo '<img src="//my.cometchat.com/track?k='.$licensekey.'&v='.$currentversion.'" width="1" height="1" />';
		?>

	</body>

</html>
