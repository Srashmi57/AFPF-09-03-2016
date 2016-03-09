<?php
 include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR."en.php");
 include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."config.php");
 if(file_exists(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR.$lang.".php")){
    include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR.$lang.".php");
 }
 foreach($mobilewebapp_language as $i => $l){
    $mobilewebapp_language[$i] = str_replace("'", "\'", $l);
 }
 ?>
var chatMessageCount = 0;
var initializeMobileWebapp = 1;
(function($){
    $.chatmobilewebapp = (function(){
        var currentChatboxId = 0;
        var onlineScroll;
        var hideWebBar;
        var keyboardOpen = 0;
        var landscapeMode = 0;
        var buddyListName = {};
        var buddyListAvatar = {};
        var buddyListMessages = {};
        var buddyListChannelHash = {};
        var detectTimer;
        var enableType = '<?php echo $enableType ?>';
        var clearmsg = {};
        return {
            playSound: function(){
                document.getElementsByTagName('audio')[0].play();
            },
            chatdetect: function(keyboard){
                clearTimeout(detectTimer);
                detectTimer = setTimeout(function(){
                    jqcc.mobilewebapp.detect();
                }, 200);
            },
            chatinit: function(){
                jqcc.mobilewebapp.detect();
                window.addEventListener('onorientationchange' in window ? 'orientationchange' : 'resize', function(){
                    jqcc.mobilewebapp.detect();
                }, false);
                if(typeof (jqcc.cookie(cookiePrefix+'new'))!='undefined'&&jqcc.cookie(cookiePrefix+'new')!=''){
                    jqcc.chatmobilewebapp.loadPanel(jqcc.cookie(cookiePrefix+'new'));
                    jqcc.cookie(cookiePrefix+'new', '', {path: '/'});
                }
                if (location.href.match('#user-')) {
                    $userid = location.href.split('#user-');
                    window.history.pushState('', '', jqcc.cometchat.getBaseUrl()+'extensions/mobilewebapp/index.php?cookiePrefix='+cookiePrefix+'&basedata='+jqcc.cometchat.getBaseData()+'&ccmobileauth='+jqcc.cometchat.getThemeVariable('ccmobileauth'));
                    jqcc.chatmobilewebapp.chatWith($userid[1]);
                }
            },
            chatbuddyList: function(data){
                var buddylist = '';
                var buddylisttemp = {};
                buddylisttemp['available'] = '';
                buddylisttemp['busy'] = '';
                buddylisttemp['offline'] = '';
                buddylisttemp['away'] = '';
                var thumbnaillimit = <?php echo intval($thumbnailDisplayNumber);?>;
                var buddylistsize = data.length;
                var displaythumbnail = true;
                if(buddylistsize > thumbnaillimit){
                    displaythumbnail = false;
                }
                $.each(data, function(i, buddy){
                    var longname = buddy.n;
                    buddyListName[buddy.id] = buddy.n;
                    buddyListAvatar[buddy.id] = buddy.a;
                    buddyListChannelHash[buddy.id] = buddy.ch;
                    jqcc.cometchat.setThemeArray('buddyListChannelHash',buddy.id,buddy.ch);
                    if(!buddyListMessages[buddy.id]){
                        buddyListMessages[buddy.id] = 0;
                    }
                    var imgTag = displaythumbnail?'<img src="'+buddy.a+'" class=" avatarimage"/>':'';
                    buddylisttemp[buddy.s] += '<li id="onlinelist_'+buddy.id+'" class="row userlists" onclick="javascript:jqcc.chatmobilewebapp.loadPanel(\''+buddy.id+'\')" data-filtertext="'+longname+'"><div class="small-7 columns"><img src="images/cleardot.gif" class=" status status-'+buddy.s+' "><span class="longname search_name">'+longname+'</span></div><div class="small-5 columns">'+imgTag+'<span class="newmessages">'+buddyListMessages[buddy.id]+'</span></div></li>';
                    $('#onlinelist_'+buddy.id).remove();
                });
                buddylist = buddylisttemp['available']+buddylisttemp['busy']+buddylisttemp['away']+buddylisttemp['offline'];
                if(buddylist==''){
                    buddylist += '<li class="onlinelist" id="nousersonline">'+jqcc.cometchat.getLanguage(14)+'</li>';
                    $('#wolist').html(buddylist);
                }
                else{
                    $('#wolist').html(buddylist);
                    $('#wolist').append('<li class="onlinelist row" id="wolast" style="background:none !important;"></li>');
                }
                if(initializeMobileWebapp){
                    if(typeof (jqcc.mobilewebapp.ccstateReader)=='function'){
                        jqcc.mobilewebapp.ccstateReader();
                    }
                    initializeMobileWebapp = 0;
                }
            },
            clearChatbox: function(id){
                $('#cometchat_container_report').find('.cometchat_closebox').click();
                $('#opt').css('display', 'none');
                var myid = jqcc.cometchat.getThemeVariable('userid');
                var chatboxId = id;
                var lastMsg = $("#cwlist").find("li:last div").attr('id');
                var msgId = parseInt(lastMsg.split('_')[2]);
                clearmsg[chatboxId] = msgId;
                var controlparameters = {"to":chatboxId, "chatroommode":"0"};
                $.ccclearconversation.init(controlparameters);
                $("#cwlist").empty();
                setTimeout(function(){
                    jqcc.mobilewebapp.scrollToBottom();
                }, 700);
            },
            reportChat: function(id){
                $('#cometchat_container_report').find('.cometchat_closebox').click();
                $('#opt').css('display', 'none');
                var params = {};
                if($('#cwlist').find('li').length){
                    params['to']= id;
                    params['mode']= 'mobilewebapp';
                    $.ccreport.init(params);
                }else{
                    alert('<?php echo $mobilewebapp_language[32];?>');
                }
                setTimeout(function(){
                    jqcc.mobilewebapp.scrollToBottom();
                }, 700);
            },
            chatWith: function(id, chatroomId){
                if(typeof (jqcc.chatmobilewebapp)!=='undefined'){
                    if(jqcc.mobilewebapp.chatwith()){
                        jqcc.chatmobilewebapp.loadPanel(id);
                    }
                }
                if(chatroomId){
                    jqcc.cometchat.leaveChatroom(chatroomId, 0, 'mobilewebapp');
                }
            },
            chatboxKeydownSet: function(id){
                var message = jqcc.mobilewebapp.checkSmiley($('#chatmessage').val());
                if($.trim(message)!=""){
                    jqcc.cometchat.chatboxKeydownSet(id, message ,'mobilewebapp');
                }
                $('#chatmessage').val('');
                $('#chatmessage').focus();
                return false;
            },
            attachMessage: function(data){

                var temp = '';
                var atleastOneNewMessage = 0;
                $.each(data, function(i, incoming){
                    if(typeof(incoming.id)!="undefined"){
                        if(typeof(incoming.self) ==='undefined' && typeof(incoming.old) ==='undefined' && typeof(incoming.sent) ==='undefined'){
                            incoming.sent = Math.floor(new Date().getTime()/1000);
                            incoming.old = incoming.self = 1;
                        }
                        if(typeof(incoming.m)!== 'undefined'){
                            incoming.message = incoming.m;
                        }

                        if(!buddyListName[incoming.from]){
                            jqcc.cometchat.getUserDetails(incoming.from);
                        }
                        fromname = buddyListName[incoming.from];
                        if(fromname.indexOf(" ")!=-1){
                            fromname = fromname.slice(0, fromname.indexOf(" "));
                        }
                        var message = jqcc.cometchat.processcontrolmessage(incoming);
                        if((message!=''&&(message.indexOf('jqcc.cc')>-1))){
                            var first = message.indexOf('<a');
                            message = message.substring(0, (first-1));
                            message = message+'<?php echo $mobilewebapp_language[34];?>';
                        }else if(((message.indexOf('jqcc.cometchat.joinChatroom')>-1))){
                            message = '<?php echo $mobilewebapp_language[35];?>';
                        }
                        if(incoming.self==0){
                            var temp = (('<li><div class="cometchat_chatboxmessage you" id="cometchat_message_'+incoming.id+'"><span class="cometchat_chatboxmessagecontent">'+message+'</span>'+'</div><div style="clear:both;"></div></li>'));
                            atleastOneNewMessage++;
                            jqcc.cometchat.sendReceipt(incoming);
                            if(currentChatboxId==incoming.from){
                                if(!(clearmsg[incoming.from])||(clearmsg[incoming.from]<incoming.id&&currentChatboxId==incoming.from)){
                                    $('#cwlist').append(temp);
                                    setTimeout(function(){
                                        jqcc.mobilewebapp.scrollToBottom();
                                    }, 500);

                                }
                            }else{
                                if(buddyListMessages[incoming.from]){
                                    if(incoming.old!=1)
                                        buddyListMessages[incoming.from] += 1;
                                }else{
                                    if(incoming.old!=1)
                                        buddyListMessages[incoming.from] = 1;
                                }
                                if(buddyListMessages[incoming.from]>0){
                                    $('#onlinelist_'+incoming.from+' .newmessages').html(buddyListMessages[incoming.from]).addClass('newmessageCount');
                                    jqcc.chatmobilewebapp.notification();
                                }
                            }
                        }else if(incoming.self==1){
                            if($("#cometchat_message_"+incoming.id).length>0){
                                if(!$("#cometchat_message_"+incoming.id).find("a").hasClass('imagemessage')){
                                    $("#cometchat_message_"+incoming.id).find("span.cometchat_chatboxmessagecontent").html(message);
                                }
                            }else{
                                if($("#cwlist #cometchat_message_"+incoming.id).length!=1){
                                    fromname = '<?php echo $mobilewebapp_language[6];?>';
                                    selfstyle = 'selfmessage';
                                    var temp = (('<li><div class="cometchat_chatboxmessage '+selfstyle+' me" id="cometchat_message_'+incoming.id+'"><span class="cometchat_chatboxmessagecontent">'+message+'</span>'+'</div><div style="clear:both;"></div></li>'));
                                    if(currentChatboxId==incoming.from){
                                        if(!(clearmsg[incoming.from])||(clearmsg[incoming.from]<incoming.id&&currentChatboxId==incoming.from)){
                                            $('#cwlist').append(temp);
                                            setTimeout(function(){
                                                jqcc.mobilewebapp.scrollToBottom();
                                            }, 500);
                                        }
                                    }
                                }
                            }
                        }
                        if(incoming.old==0){
                            jqcc.chatmobilewebapp.playSound();
                        }
                    }
                });
            },
            chatloadUserData: function(id, data){
                buddyListName[id] = data.n;
                buddyListAvatar[id] = data.a;
                if(!buddyListMessages[id]){
                    buddyListMessages[id] = 0;
                }
                var longname = data.n;


                var buddylist = '<li id="onlinelist_'+data.id+'" onclick="javascript:jqcc.chatmobilewebapp.loadPanel(\''+data.id+'\')" data-filtertext="'+longname+'"><img src="images/cleardot.gif" class="status status-'+data.s+' "><span class="longname">'+longname+'</span><span class=""><img src="'+buddy.a+'" class=" avatarimage"/></span><span class="newmessages">0</span></li>';
                $('#nousersonline').css('display', 'none');
                $('#permanent').prepend(buddylist);
            },
            joinChatroom: function(roomid, inviteid, roomname){
                javascript:jqcc.mobilewebapp.mobilechatroom(roomid, roomname, 1, inviteid, 1);
                jqcc.mobilewebapp.loadChatroom();
            },
            loadPanel: function(id, name){
                if(typeof (id)!='undefined'&&id!=null){
                buddyListMessages[id] = 0;
                $('#onlinelist_'+id).find('span.newmessages').html('0').removeClass('newmessageCount');
                var cc_state = jqcc.cookie(cookiePrefix+'state');
                if(typeof (cc_state)!='undefined'&&cc_state!=null&&cc_state!=''){
                    var pattern = id+"\\|[0-9]+";
                    var regex = new RegExp(pattern);
                    cc_state = cc_state.replace(regex, id+"|0");
                    jqcc.cookie(cookiePrefix+'state', cc_state, {path: '/'});
                }
                var userName = buddyListName[id];
                var flag = 0;
                if(userName===undefined){
                    if(!isNaN(id) && typeof(jqcc.cometchat.getUserDetails) == 'function'){
                        jqcc.cometchat.getUserDetails(id);
                        userName = jqcc.cometchat.getName(id);
                        flag = 1;
                    }
                }else{
                    flag = 1;
                }
                var refreshIntervalId = setInterval(function(){
                    if(flag==1){
                        clearInterval(refreshIntervalId);
                        $('#chatheader').find("h1").html(userName);
                        $('#scroller').html('<ul id="cwlist"></ul>');
                        $("#chatmessage").keyup(function(event){
                            if($("#chatmessage").val()!==''&&event.keyCode==13&&event.shiftKey==0)
                                $("#chat_send").click()
                        });
                        $('#chat_send').attr('onclick', 'return jqcc.chatmobilewebapp.chatboxKeydownSet(\''+id+'\')');
                        $('#clear').attr('onclick', 'return jqcc.chatmobilewebapp.clearChatbox(\''+id+'\')');
                        $('#report').attr('onclick', 'return jqcc.chatmobilewebapp.reportChat(\''+id+'\')');
                        jqcc.mobilewebapp.loadChatbox();
                    }
                }, 100);
                jqcc.mobilewebapp.detect();
                currentChatboxId = id;
                if(typeof(jqcc.cometchat.setThemeVariable) == 'function'){
                    jqcc.cometchat.setThemeVariable('openChatboxId',currentChatboxId);
                }
                $('#chatmessage').blur(function(){
                    keyboardOpen = 0;
                    jqcc.mobilewebapp.detect();
                });
                if(typeof(jqcc.cometchat.getRecentData) == 'function'){
                    jqcc.cometchat.getRecentData(id);
                }
                setTimeout(function(){
                    jqcc.mobilewebapp.scrollToBottom();
                }, 500);
                document.cookie = '<?php echo $cookiePrefix;?>chat='+urlencode(id+':'+urlencode(userName));
                }
            },
            chatloadData: function(id, data){
                $.each(data, function(type, item){
                    if(type=='messages'){
                        var temp = '';
                        var messageid = 0;
                        $.each(item, function(i, incoming){
                            var message = jqcc.cometchat.processcontrolmessage(incoming);
                            if(((message.indexOf('jqcc.cc')>-1))){
                                var first = message.indexOf('<a');
                                message = message.substring(0, (first-1));
                                message = message+'<?php echo $mobilewebapp_language[34];?>';
                            }else if(((message.indexOf('jqcc.cometchat.joinChatroom')>-1))){
                                message = '<?php echo $mobilewebapp_language[35];?>';
                            }
                            var self;
                            var selfstyle = '';
                            var messagefrom = '';
                            if(incoming.self==1){
                                var fromname = '<?php echo $mobilewebapp_language[6];?>';
                                selfstyle = 'selfmessage';
                            }else{
                                var fromname = buddyListName[id];
                            }
                            var ts = new Date(incoming.sent*1000);
                            if(fromname.indexOf(" ")!=-1){
                                fromname = fromname.slice(0, fromname.indexOf(" "));
                            }
                            if(selfstyle==''){
                                self = 'you';
                            }else{
                                self = 'me';
                            }
                            temp += ('<li><div class="cometchat_chatboxmessage '+selfstyle+' '+self+'" id="cometchat_message_'+incoming.id+'">'+messagefrom+'<span class="cometchat_chatboxmessagecontent'+selfstyle+'">'+message+'</span>'+'</div><div style="clear:both;"></div>');
                            messageid = incoming.id;
                        });
                        var message = {"id": messageid, "from": currentChatboxId, "self": 0};
                        jqcc.cometchat.sendReceipt(message, 'readMessageNotify');
                        if(currentChatboxId==id){
                            setTimeout(function(){
                                $('#cwlist').append(temp);
                                setTimeout(function(){
                                    jqcc.mobilewebapp.scrollToBottom();
                                }, 500);
                            }, 200)
                        }
                    }
                });
            },
            getChatCookie: function(){
                var cookieName = '<?php echo $cookiePrefix;?>'+'chat';
                var cookieData = jqcc.mobilewebapp.getCookieInfo(cookieName);
                if(typeof (cookieData)!='undefined'&&cookieData!=""){
                    var cDetails = urldecode(cookieData).split(":")
                    var id = cDetails[0];
                    setTimeout(function(){
                        jqcc.chatmobilewebapp.loadPanel(id);
                    }, 500);
                }else{
                    jqcc.mobilewebapp.loadChatboxReverse();
                }
            },
            back: function(){
                document.cookie = '<?php echo $cookiePrefix;?>chat=';
                currentChatboxId = 0;
                if(typeof(jqcc.cometchat.setThemeVariable) == 'function'){
                    jqcc.cometchat.setThemeVariable('openChatboxId',currentChatboxId);
                }
            },
            notification: function(){
                var chatMessageCount = 0;
                $.each(buddyListMessages, function(i, j){
                    chatMessageCount = chatMessageCount+j;
                });
                if($("#lobby").is(':visible')){
                    $('span.notifier').html(chatMessageCount);
                }
            }
        };
    })();
})(jqcc);
var listener = function(e){
    e.preventDefault();
};
window.onload = function(){
    if(typeof (jqcc.mobilewebapp.getChatroomCookie)=='function'){
        jqcc.mobilewebapp.getChatroomCookie();
    }
    jqcc.chatmobilewebapp.getChatCookie();
    document.cookie = '<?php echo $cookiePrefix;?>chat=';
    document.cookie = '<?php echo $cookiePrefix;?>chatroom=';
    jqcc.mobilewebapp.init();
}
if($("#buddy").is(':visible')){
    jqcc.chatmobilewebapp.notification();
}