<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))).DIRECTORY_SEPARATOR."modules".DIRECTORY_SEPARATOR."chatrooms".DIRECTORY_SEPARATOR."config.php");

include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR."en.php");
if (file_exists(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR.$lang.".php")) {
	include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR.$lang.".php");
}
foreach ($chatrooms_language as $i => $l) {
	$chatrooms_language[$i] = str_replace("'", "\'", $l);
}
if ($autoLogin != 0) {
	$sql = ("select name from cometchat_chatrooms where id = '".mysqli_real_escape_string($GLOBALS['dbh'],$autoLogin)."' limit 1");
 	$query = mysqli_query($GLOBALS['dbh'], $sql);

	$chatroom = mysqli_fetch_assoc($query);
	$autoLoginName = base64_encode($chatroom['name']);
} else {
	$autoLoginName = '';
}
?>

/*
 * CometChat
 * Copyright (c) 2014 Inscripts - support@cometchat.com | http://www.cometchat.com | http://www.inscripts.com
*/

if(typeof (jqcc)==='undefined'){
    jqcc = jQuery;
}
jqcc.ajaxSetup({scriptCharset: "utf-8", cache: "false"});
if(typeof (jqcc.mobilewebapp)==='undefined'){
    jqcc.mobilewebapp = function(){
    };
}
jqcc(function(){
    jqcc.mobilewebapp.chatHeartbeatWebapp(1);
    if($("#chatroom").is(':visible')){
        jqcc.mobilewebapp.setChatroomVars('chatroomMessageCount', '0');
    }
    if($("#lobby").is(':visible')){
        var cookieName = '<?php echo $cookiePrefix;?>'+'chatroom';
        var cookieData = jqcc.mobilewebapp.getCookieInfo(cookieName);
        if(!cookieData){
            cookieData = '';
        }
        if(jqcc.cometchat.getChatroomVars('autoLoginFlag')==0&&jqcc.cometchat.getChatroomVars('cookieData')==''){
            var autoLogin = '<?php echo $autoLogin;?>';
            var name = '<?php echo $autoLoginName;?>';
            if(autoLogin!=0){
                jqcc.mobilewebapp.chatroom(autoLogin, name);
            }
            jqcc.mobilewebapp.setChatroomVars('autoLoginFlag', '1');
        }
    }
});
jqcc.extend($.mobilewebapp, {
    crvariables: {themename: '<?php echo $theme;?>',
        autoLoginFlag: 0,
        chatroomMessageCount: 0,
        detectTimer: '',
    },
    getcrAllVariables: function(){
        return this.crvariables;
    },
    getChatroomVars: function(key, value){
        if(typeof (this.crvariables[key])!=='undefined')
            return this.crvariables[key];

        return value;
    },
    setChatroomVars: function(key, value){
        this.crvariables[key] = value;
    },
    chatroomdetect: function(keyboard){
        clearTimeout(this.crvariables.detectTimer);
        this.crvariables.detectTimer = setTimeout(function(){
            jqcc.mobilewebapp.detect();
        }, 200);
    },
    chatHeartbeatWebapp: function(forceUpdate, chatroommessageno){
        jqcc.cometchat.chatroomHeartbeat(forceUpdate);
    },
    loadChatroomList: function(item){
        var temp = '';
        $.each(item, function(i, room){
            var longname = room.name;
            var shortname = room.name;
            if(room.status=='available'){
                onlineNumber++;
            }
            var selected = '';
            if(jqcc.cometchat.getChatroomVars('currentroom')==room.id){
                selected = ' cometchat_chatroomselected';
            }
            var roomtype = '';
            var roomowner = '';
            if(room.type!=0){
                roomtype = '<?php echo $chatrooms_language[24];?>';
            }
            if(room.s!=0){
                roomowner = '<?php echo $chatrooms_language[25];?>';
            }
            temp += '<li id="lobbylist_'+room.id+'" class="row crlists" onclick="javascript:jqcc.mobilewebapp.mobilechatroom(\''+room.id+'\',\''+urlencode(shortname)+'\',\''+room.type+'\',\''+room.i+'\',\''+room.s+'\');" data-filtertext="'+longname+'">'+'<div class="small-4 columns"><span class="lobby_room_1">'+longname+'</span></div><div class="small-3 columns"><span class="lobby_room_2">'+room.online+' <?php echo $chatrooms_language[34];?></span></div><div class="small-2 columns"><span class="lobby_room_3">'+roomtype+'</span></div><div class="small-2 columns"><span class="lobby_room_4">'+roomowner+'</span></div><div class="small-1 columns"><span class="lobby_room_5">0</span></div><div style="clear:both"></div>'+'</li>';
        });
        if(temp!=''){
            $("#lobbylist").html(temp);
            $("#lobbylist").append('<li id="lobbylist_last" class="" style="border-style:none !important;background:none !important;" ></li>');
        }
    },
    displayChatroomMessage: function(item, fetchedUsers){
        var temp = '';
        var beepNewMessages = 0;
        $.each(item, function(i, incoming){
            var message = incoming.message;
            if(((message.indexOf('jqcc.cc')>-1))){
                var first = message.indexOf('<a');
                message = message.substring(0, (first-1));
                incoming.message = message+'<?php echo $mobilewebapp_language[34];?>';
            }
            jqcc.cometchat.setChatroomVars('timestamp', incoming.id);
            var fromname = incoming.from;
            message = jqcc.cometchat.processcontrolmessage(incoming);
            if(message != ''){
                if($("#cometchat_message_"+incoming.id).length>0){
                    $("#cometchat_message_"+incoming.id).find("span.cometchat_chatboxmessagecontent").html(message);
                }else{
                    var ts = new Date(incoming.sent*1000);
                    if(incoming.fromid!=jqcc.cometchat.getChatroomVars('myid')){
                        temp += ('<div><div class="cometchat_chatboxmessage you" id="cometchat_message_'+incoming.id+'"><span class="cometchat_chatboxmessagefrom"><strong>');
                        if(typeof (jqcc.chatmobilewebapp)!=='undefined'){
                            temp += ('<a href="javascript:void(0)" onclick="javascript:parent.jqcc.chatmobilewebapp.chatWith(\''+incoming.fromid+'\');">'+fromname+':</a>');
                        }else{
                            temp += ('<a href="javascript:void(0)" >'+fromname+':</a>');
                        }
                        temp += ('</strong></span><div class="userSeperator"></div><span class="cometchat_chatboxmessagecontent">'+message+'</span>'+jqcc.mobilewebapp.getTimeDisplay(ts)+'</div><div style="clear:both;"></div></div>');
                        jqcc.cometchat.setChatroomVars('newMessages', (jqcc.cometchat.getChatroomVars('newMessages')+1));
                        beepNewMessages++;
                        jqcc.cometchat.setChatroomVars('chatroomMessageCount', (jqcc.cometchat.getChatroomVars('chatroomMessageCount')+1));
                    }else{
                        temp += ('<div><div class="cometchat_chatboxmessage me" id="cometchat_message_'+incoming.id+'"><span class="cometchat_chatboxmessagefrom"><strong>'+fromname+':</strong></span><div class="userSeperator"></div><span class="cometchat_chatboxmessagecontent">'+message+'</span>'+jqcc.mobilewebapp.getTimeDisplay(ts)+'</div><div style="clear:both;"></div></div>');
                    }
                }
            }
        });
        jqcc.cometchat.setChatroomVars('heartbeatCount', 1);
        jqcc.cometchat.setChatroomVars('heartbeatTime', jqcc.cometchat.getChatroomVars('minHeartbeat'));
        if(beepNewMessages>0&&fetchedUsers==0){
            if(typeof (jqcc.chatmobilewebapp)!=='undefined')
                jqcc.chatmobilewebapp.playSound();
            else
                jqcc.mobilewebapp.playSound();
        }
        if(temp!=''){
            if(jqcc.cometchat.getChatroomVars('prepend')==0){
                $("#currentroom_convotext").append(temp);
                setTimeout(function(){
                    jqcc.mobilewebapp.crscrollToBottom();
                }, 500);
            }else{
                $("#currentroom_convotext").prepend(temp);
                setTimeout(function(){
                    crscrollToTop();
                }, 500);
            }
        }
    },
    updateChatroomUsers: function(item, fetchedUsers){
        var cookieName = '<?php echo $cookiePrefix;?>'+'chatroom';
        var cookieData = jqcc.mobilewebapp.getCookieInfo(cookieName);
        if(typeof (cookieData)!='undefined'&&cookieData!=""){
            var crDetails = urldecode(cookieData).split(":");
            var currentChatroomid = crDetails[0];
        }
        var temp = '';
        var newUsers = {};
        var newUsersName = {};
        fetchedUsers = 1;
        $.each(item, function(i, user){
            var longname = user.n;
            if(jqcc.cometchat.getcrAllVariables().users[user.id]!=1&&jqcc.cometchat.getChatroomVars('initializeRoom')==0&&jqcc.cometchat.getChatroomVars('hideEnterExit')==0){
                var ts = new Date();
                $("#currentroom_convotext").append('<div class="cometchat_chatboxalert" id="cometchat_message_0">'+user.n+'<?php echo $chatrooms_language[14]?>'+jqcc.mobilewebapp.getTimeDisplay(ts)+'</div><div style="clear:both;"></div>');
                setTimeout(function(){
                    jqcc.mobilewebapp.crscrollToBottom();
                }, 500);
            }
            newUsers[user.id] = 1;
            newUsersName[user.id] = user.n;
            if(user.id==0||user.id==jqcc.cometchat.getChatroomVars('myid')){
                temp += '<li class="chatroomuser"><div id="cometchat_userlist_'+user.id+'" class="cometchat_userlist"><span class="cometchat_userscontentname">'+user.n+'</span></div></li>';
            }else{
                if(typeof (jqcc.chatmobilewebapp)!=='undefined'){
                    temp += '<li class="chatroomuser"><div id="cometchat_userlist_'+user.id+'" class="cometchat_userlist" onclick="javascript:parent.jqcc.chatmobilewebapp.chatWith(\''+user.id+'\',\''+currentChatroomid+'\');" ><span class="cometchat_userscontentname">'+user.n+'</span><span class="arrow_icon"></span></div></li>';
                }else{
                    temp += '<li class="chatroomuser"><div id="cometchat_userlist_'+user.id+'" class="cometchat_userlist" ><span class="cometchat_userscontentname">'+user.n+'</span><span class="arrow_icon"></span></div></li>';
                }
            }
        });
        for(user in jqcc.cometchat.getChatroomVars('users')){
            if(jqcc.cometchat.getChatroomVars('users').hasOwnProperty(user)){
                if(newUsers[user]!=1&&jqcc.cometchat.getChatroomVars('initializeRoom')==0&&jqcc.cometchat.getChatroomVars('hideEnterExit')==0){
                    var ts = new Date();
                    $("#currentroom_convotext").append('<div class="cometchat_chatboxalert" id="cometchat_message_0">'+jqcc.cometchat.getcrAllVariables().usersName[user]+'<?php echo $chatrooms_language[13]?>'+jqcc.mobilewebapp.getTimeDisplay(ts)+'</div><div style="clear:both;"></div>');
                    setTimeout(function(){
                        jqcc.mobilewebapp.crscrollToBottom();
                    }, 500);
                }
            }
        }
        $("#currentroom_users").html(temp);
        jqcc.cometchat.setChatroomVars('users', newUsers);
        jqcc.cometchat.setChatroomVars('usersName', newUsersName);
        jqcc.cometchat.setChatroomVars('initializeRoom', 0);
    },
    sendchatroommessage: function(chatboxtextarea){
        var message = $(chatboxtextarea).val();
        message = jqcc.mobilewebapp.checkSmiley(message);
        message = message.replace(/^\s+|\s+$/g, "");

        if(jqcc.cometchat.getChatroomVars('currentroom')!=0){
            $(chatboxtextarea).val('');

            if(message!=''){
                jqcc.cometchat.sendmessageProcess(message, jqcc.cometchat.getChatroomVars('currentroom'), jqcc.cometchat.getChatroomVars('myid'), jqcc.cometchat.getChatroomVars('currentroomname'));
            }
            jqcc.mobilewebapp.crscrollToBottom();
            $(chatboxtextarea).focus();
        }
    },
    ChatroomMessage: function(fromid, incomingmessage, incomingid, selfadded, sent, fromname){
        var temp = '';
    	var message = incomingmessage;
        if(((message.indexOf('jqcc.cc')>-1))){
            var first = message.indexOf('<a');
            message = message.substring(0, (first-1));
            message = message+'<?php echo $mobilewebapp_language[34];?>';
        }
        var controlparameters = {"id":incomingid, "from":fromname, "fromid":fromid, "message":incomingmessage, "sent":sent};
        separator = '<?php echo $chatrooms_language[7]; ?>';
        message = jqcc.cometchat.processcontrolmessage(controlparameters);
        if(message != ''){
            if($("#cometchat_message_"+incomingid).length>0){
                $("#cometchat_message_"+incomingid).find("span.cometchat_chatboxmessagecontent").html(message);
            }else{
                var sentdata = '';
                if(sent!=null){
                    var ts = new Date(sent);
                    sentdata = jqcc.mobilewebapp.getTimeDisplay(ts);
                }
                if(fromname == '0'){
                    fromname = '<?php echo $chatrooms_language[6]; ?>';
                }
                if(fromid!=jqcc.cometchat.getChatroomVars('myid')){
                    temp += ('<div><div class="cometchat_chatboxmessage you" id="cometchat_message_'+incomingid+'"><span class="cometchat_chatboxmessagefrom"><strong>');
                    if(typeof (jqcc.chatmobilewebapp)!=='undefined'){
                        temp += ('<a href="javascript:void(0)" onclick="javascript:parent.jqcc.chatmobilewebapp.chatWith(\''+fromid+'\');">'+fromname+':</a>');
                    }else{
                        temp += ('<a href="javascript:void(0)" >'+fromname+':</a>');
                    }
                    temp += ('</strong></span><div class="userSeperator"></div><span class="cometchat_chatboxmessagecontent">'+message+'</span>'+jqcc.mobilewebapp.getTimeDisplay(ts)+'</div><div style="clear:both;"></div></div>');
                }else{
                    $("#currentroom_convotext").append('<div><div class="cometchat_chatboxmessage me" id="cometchat_message_'+incomingid+'"><span class="cometchat_chatboxmessagefrom"><strong>'+fromname+'</strong>'+separator+'</span><div class="userSeperator"></div><span class="cometchat_chatboxmessagecontent">'+message+'</span>'+sentdata+'</div><div style="clear:both;"></div></div>');
                 }

                if(temp!=''){
                	$("#currentroom_convotext").append(temp);
	            }
                setTimeout(function(){
                    jqcc.mobilewebapp.crscrollToBottom();
                }, 500);
                if(typeof (jqcc.chatmobilewebapp)!=='undefined')
                    jqcc.chatmobilewebapp.playSound();
                else
                    jqcc.mobilewebapp.playSound();
            }
        }
    },
    checkDropDown: function(dropdown){
        var id = $('#type').val();
        if(id==1){
            $("#chatroomPassword").css('display', 'block');
        }
        else{
            $("#chatroomPassword").css('display', 'none');
        }
    },
    loadRoom: function(){
        document.cookie = '<?php echo $cookiePrefix;?>chatroom='+urlencode(jqcc.cometchat.getChatroomVars('currentroom')+':'+jqcc.cometchat.getChatroomVars('currentp')+':'+urlencode(jqcc.cometchat.getChatroomVars('currentroomname')));
        setTimeout(function(){
            jqcc.mobilewebapp.crscrollToBottom();
        }, 500);
    },
    loadMobileChatroom: function(){
        jqcc.mobilewebapp.loadChatroom();
    },
    loadMobileLobbyReverse: function(){
        jqcc.mobilewebapp.loadLobbyReverse();
        exit;
    },
    mobilecreateChatroomSubmit: function(){
        jqcc.cometchat.createChatroomSubmit();
        jqcc('#createChatroomForm').find('#name').val('');
        jqcc('#createChatroomForm').find('#password').val('');
        jqcc.mobilewebapp.chatHeartbeatWebapp(1);
    },
    backchatroom: function(){
        document.cookie = '<?php echo $cookiePrefix;?>chatroom=';
    },
    createChatroomSubmitStruct: function(){
        var name = $('#name').val();
        var type = $('#type').val();
        var password = $('#password').val();
        var room = {};
        if(name!=''&&name!=null){
            name = name.replace(/^\s+|\s+$/g, "");
            if(type==1&&password==''){
                alert('<?php echo $chatrooms_language[26];?>');
                return false;
            }
            if(type==0){
                password = '';
            }
        }
        room['name'] = name;
        room['password'] = password;
        room['type'] = type;

        return room;
    },
    mobileleaveChatroom: function(id){
        jqcc.cometchat.leaveChatroom(id);
    },
    loadLobby: function(){
        jqcc.mobilewebapp.loadLobbyReverse();
    },
    getChatroomCookie: function(){
        var cookieName = '<?php echo $cookiePrefix;?>'+'chatroom';
        var cookieData = jqcc.mobilewebapp.getCookieInfo(cookieName);
        if(typeof (cookieData)!='undefined'&&cookieData!=""){
            var crDetails = urldecode(cookieData).split(":");
            var id = crDetails[0];
            var name = crDetails[2];
            var invite = crDetails[1];
            setTimeout(function(){
                jqcc.mobilewebapp.mobilechatroom(id, name, null, invite, 1);
            }, 500);
        }
    },
    mobilechatroom: function(id, name, type, invite, silent){
        jqcc.cometchat.chatroom(id, name, type, invite, silent);
    },
    setRoomName: function(currentroomname){
        $('#chatroomName').html(currentroomname);
        $('#chatroomUserName').html(currentroomname);
        $('#crscroller').html('<div id="currentroom_convotext"></div>');
        $('#chatroomusercontent').html('<ul id="currentroom_users"></ul>');
    },
    silentRoom: function(id, name, silent){
        var temp = prompt('<?php echo $chatrooms_language[8];?>', '')
        if(temp){
            var password = SHA1(temp);
        }else{
            return;
        }
        jqcc.cometchat.checkChatroomPass(id, name, silent, temp);
    },
    kickUser: function(kickid, kick){
        jqcc.cometchat.kickChatroomUser(kickid, kick);
    },
    banUser: function(banid, ban){
        jqcc.cometchat.banChatroomUser(banid, ban);
    },
    playSound: function(){
        try{
            jqcc.mobilewebapp.getFlashMovie("cometchatbeep").beep();
        }catch(error){
            jqcc.cometchat.setChatroomVars('messageBeep', 0);
        }
    },
    getFlashMovie: function(movieName){
        var isIE = navigator.appName.indexOf("Microsoft")!=-1;
        return (isIE) ? window[movieName] : document[movieName];
    },
    getTimeDisplay: function(ts){
            var ap = "";
            var hour = ts.getHours();
            var minute = ts.getMinutes();
            var date = ts.getDate();
            var month = ts.getMonth();
            var armyTime = jqcc.cometchat.getChatroomVars('armyTime');
            if(armyTime!=1){
                ap = hour>11 ? "PM" : "AM";
                hour = hour==0 ? 12 : hour>12 ? hour-12 : hour;
            }else{
                hour = hour<10 ? "0"+hour : hour;
            }
            minute = minute<10 ? "0"+minute : minute;
            var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            var type = 'th';
            if(date==1||date==21||date==31){
                type = 'st';
            }else if(date==2||date==22){
                type = 'nd';
            }else if(date==3||date==23){
                type = 'rd';
            }
            if(ts<jqcc.cometchat.getChatroomVars('todays12am')){
                return '<span class="cometchat_ts">('+hour+":"+minute+ap+' '+date+type+' '+months[month]+')</span>';
            }else{
                return '<span class="cometchat_ts">('+hour+":"+minute+ap+')</span>';
            }
    },
    replaceHtml: function(el, html){
        var oldEl = typeof el==="string" ? document.getElementById(el) : el;
        /*@cc_on // Pure innerHTML is slightly faster in IE
         oldEl.innerHTML = html;
         return oldEl;
         @*/
        var newEl = oldEl.cloneNode(false);
        newEl.innerHTML = html;
        oldEl.parentNode.replaceChild(newEl, oldEl);
        return newEl;
    },
    ccstateReader: function(){
        var cc_state = jqcc.cookie(cookiePrefix+'state');
        if(cc_state!=null){
            var cc_states = cc_state.split(/:/);
            if(cc_states[1]!=' '&&cc_states[1]!=''){
                var chatboxData = cc_states[1].split(/,/);
                for(i = 0; i<chatboxData.length; i++){
                    var chatboxIds = chatboxData[i].split(/\|/)[0];
                    var newMsgCount = chatboxData[i].split(/\|/)[1];
                    if(newMsgCount>0){
                        jqcc('#onlinelist_'+chatboxIds).find('span.newmessages').html(newMsgCount).addClass('newmessageCount');
                    }
                }
            }
        }
    }
});


