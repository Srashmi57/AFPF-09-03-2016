<?php
include_once(dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."modules.php");
include_once(dirname(__FILE__).DIRECTORY_SEPARATOR."config.php");
?>
var chatScroll, lobbyScroll, chatroomScroll, woScroll, cruserScroll, baseurl = "<?php echo BASE_URL; ?>";
var cookiePrefix = '<?php echo $cookiePrefix; ?>';
<?php
    include_once(dirname(__FILE__).DIRECTORY_SEPARATOR."js".DIRECTORY_SEPARATOR."jquery.nicescroll.js");
?>
var enableType = '<?php echo $enableType ?>';
var winheight = '';
var cross_domain = '<?php echo CROSS_DOMAIN; ?>';
(function($){
    $.mobilewebapp = (function(){
        var mobileDevice = navigator.userAgent.match(/ipad|ipod|iphone|android|windows ce|Windows Phone|blackberry|palm|symbian/i);
        return {
           init: function(){
                winheight = $(window).height();
                if(typeof (jqcc.chatmobilewebapp)!=='undefined'){
                    jqcc.chatmobilewebapp.chatinit();
                }
                jqcc.mobilewebapp.detect();
            },
            addscroll: function(){
                $.browser.device = (/iphone|ipad/i.test(navigator.userAgent.toLowerCase()));
                if($.browser.device==false){
                    setTimeout(function(){
                        chatScroll = $("#chatcontent").niceScroll({horizrailenabled: false, bouncescroll: true, nativeparentscrolling: true, railalign: "right"});
                        chatroomScroll = $("#chatroomcontent").niceScroll({horizrailenabled: false, bouncescroll: true, nativeparentscrolling: true});
                        lobbyScroll = $("#lobbycontent").niceScroll({horizrailenabled: false, bouncescroll: true, nativeparentscrolling: true});
                        woScroll = $("#wocontent").niceScroll({horizrailenabled: false, bouncescroll: true, nativeparentscrolling: true});
                        cruserScroll = $("#chatroomusercontent").niceScroll({horizrailenabled: false, bouncescroll: true, nativeparentscrolling: true});
                    }, 200);
                }
            },
            detect: function(){
                if(window.orientation==90||window.orientation==-90){
                    $("div.chatlink_icon").css({'height':'20px', 'top':'15px'});
                    $("div.chatroomlink_icon").css({'height':'20px', 'top':'15px'});
                    $('div.chatlink_txt').css('display', 'none');
                    $('div.chatroomlink_txt').css('display', 'none');
                }else{
                    $("div.chatlink_icon").css({'height':'30px', 'top':'-1px'});
                    $("div.chatroomlink_icon").css({'height':'30px', 'top':'-1px'});
                    $('div.chatlink_txt').css('display', 'block');
                    $('div.chatroomlink_txt').css('display', 'block');
                }
                if(mobileDevice){
                    var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],winWidth=w.innerWidth||e.clientWidth||g.clientWidth,winHt=w.innerHeight||e.clientHeight||g.clientHeight;

                    if(winWidth<winHt){
                        if(winWidth>800){
                            winWidth = 800;
                        }
                        $('#cometchat_social_login .login_container').css({'width':(winWidth*0.6)+'px'});
                        $('#cometchat_social_login img').css({'width':(winWidth*0.6)+'px',height:'auto'});
                    }else{
                        if(winHt>450){
                            winHt = 450;
                        }
                        $('#cometchat_social_login .login_container').css({'width':(winHt*0.8)+'px'});
                        $('#cometchat_social_login img').css({'height':(winHt*0.6/4)+'px',width:'auto'});
                    }
                }
                var headerHeight;
                var baseHeight = window.innerHeight;
                var footerbtnHeight = 0;
                var footerHeight = $("#chatfooter").outerHeight(false);
                var cheaderHeight = $('#cheader').height();
                var crheaderHeight = $('#crheadertop').height();
                var footerCRHeight = $("#chatroomfooter").outerHeight(false);
                var headerHeight = $('#header').height();
                if($('#footer').length==0){
                    footerbtnHeight = 0;
                }else{
                    footerbtnHeight = $('#footer').height();
                }
                $('body').css({'height':(baseHeight)+'px', 'min-height':(baseHeight)+'px', 'max-height':(baseHeight)+'px', 'width':'100%'});
                $.browser.device = (/ipad/i.test(navigator.userAgent.toLowerCase()));
                if($.browser.device==true){
                    $("#options").css('width', '20%');
                    $("div.chatoptions").css('width', '20%');
                    $("#lobbyhome").css('width', '20%');
                    $("#buddyhome").css('width', '20%');
                    $("#backbtnChat").css('width', '20%');
                    $("#backbtnChatroom").css('width', '20%');
                    $("#backbtnChatroomuser").css('width', '20%');
                    $("#backbtnCreateChatroom").css('width', '20%');
                    if(window.orientation==90||window.orientation==-90){
                        if(baseHeight<winheight){
                            $("#chatroomcontent").css('height', '86.5%');
                            $("#chatcontent").css('height', '86.5%');
                        }else{
                            $("#chatroomcontent").css('height', (baseHeight-crheaderHeight-footerHeight-50)+'px');
                            $("#chatcontent").css('height', (baseHeight-cheaderHeight-footerHeight+5)+'px');
                        }
                    }else{
                        if(baseHeight<winheight){
                            $("#chatroomcontent").css('height', '90%');
                            $("#chatcontent").css('height', '90%');
                        }else{
                            $("#chatroomcontent").css('height', (baseHeight-crheaderHeight-footerHeight-50)+'px');
                            $("#chatcontent").css('height', (baseHeight-cheaderHeight-footerHeight+5)+'px');
                        }
                    }
                }
                $.browser.device = (/android|iphone|ipad/i.test(navigator.userAgent.toLowerCase()));
                if($.browser.device==false){
                    $("#chatcontent").css({'height':(baseHeight-headerHeight-footerHeight)+'px', 'min-height':(baseHeight-headerHeight-footerHeight)+'px', 'max-height':(baseHeight-headerHeight-footerHeight)+'px'}).getNiceScroll().resize();
                    $("#chatroomcontent").css({'height':(baseHeight-headerHeight-footerCRHeight)+'px', 'min-height':(baseHeight-headerHeight-footerCRHeight)+'px', 'max-height':(baseHeight-headerHeight-footerCRHeight)+'px'}).getNiceScroll().resize();
                    $("#chatroomusercontent").css({'max-height':(baseHeight-headerHeight)+'px !important', 'bottom':'1px', 'overflow-y':'auto'}).getNiceScroll().resize();
                }
                $.browser.device = (/android|iphone/i.test(navigator.userAgent.toLowerCase()));
                if($.browser.device==true){
                    if(window.orientation==90||window.orientation==-90){
                        var baseinnerHeight = window.innerHeight;
                        var baseHeight = $(window).height();
                        var headtop = baseHeight-baseinnerHeight;
                        $("#chatfooter").css({'position':'', 'bottom':'0', 'height':'50px', 'width':'100%'});
                        $("#chatroomfooter").css({'position':'', 'bottom':'0', 'height':'50px', 'width':'100%'});
                        $("#cheader").css({'position':'fixed', 'top':headtop+'px !important', 'height':'42px', 'width':'100%'});
                        $("#crheadertop").css({'position':'fixed', 'top':headtop+'px !important', 'height':'42px', 'width':'100%'});
                        $('#opt').css('top', (headtop+42)+'px');
                        var chathead = $('#cheader').height();
                        var chatfooter = $('#chatfooter').height();
                        var chatroomhead = $('#crheadertop').height();
                        var chatroomfooter = $('#chatroomfooter').height();
                        $("#chatcontent").css({'position':'', 'overflow-y':'scroll', 'height':(baseinnerHeight-chathead-chatfooter)+'px', 'width':'100%', 'bottom':'50px'});
                        $("#chatroomcontent").css({'position':'', 'overflow-y':'scroll', 'height':(baseinnerHeight-chatroomhead-chatroomfooter)+'px', 'width':'100%', 'bottom':'50px'});
                    }else{
                        $("#chatfooter").css({'position':'', 'bottom':'0', 'height':'50px', 'width':'100%'});
                        $("#chatroomfooter").css({'position':'', 'bottom':'0', 'height':'50px', 'width':'100%'});
                        $("#cheader").css({'position':'', 'top':'0px', 'height':'42px', 'width':'100%'});
                        $("#crheadertop").css({'position':'', 'top':'0px', 'height':'42px', 'width':'100%'});
                        var baseHeight = $(window).height();
                        var chathead = $('#cheader').height();
                        var chatfooter = $('#chatfooter').height();
                        var chatroomhead = $('#crheadertop').height();
                        var chatroomfooter = $('#chatroomfooter').height();
                        $("#chatcontent").css({'position':'', 'overflow-y':'scroll', 'height':(baseHeight-chathead-chatfooter)+'px', 'width':'100%', 'bottom':'50px'});
                        $("#chatroomcontent").css({'position':'', 'overflow-y':'scroll', 'height':(baseHeight-chatroomhead-chatroomfooter)+'px', 'width':'100%', 'bottom':'50px'});
                    }
                    $("#chatroomusercontent").css({'position':'', 'overflow-y':'scroll', 'max-height':(baseinnerHeight-headerHeight)+'px', 'min-height':(baseinnerHeight-headerHeight)+'px', 'height':(baseinnerHeight-headerHeight)+'px', 'width':'100%', 'bottom':'1px'});
                }
                $("#chatroom").css({'height':(baseHeight)+'px', 'min-height':(baseHeight)+'px', 'max-height':(baseHeight)+'px'});
                var baseinnerHeight = window.innerHeight;
                var head = $('#header').height();
                var footer = $('#footer').height();
                $("#wocontent").css({'bottom':footerbtnHeight+'px', 'height':(baseinnerHeight-head-footer)+'px', 'min-height':(baseinnerHeight-head-footer)+'px', 'max-height':(baseinnerHeight-head-footer)+'px'});
                $("#lobbycontent").css({'bottom':footerbtnHeight+'px', 'height':(baseinnerHeight-head-footer)+'px', 'min-height':(baseinnerHeight-head-footer)+'px', 'max-height':(baseinnerHeight-head-footer)+'px'});
                if(typeof (jqcc.chatmobilewebapp)!=='undefined'){
                    jqcc.chatmobilewebapp.chatdetect();
                }
                if(typeof (jqcc.mobilewebapp.chatroomdetect)=='function'){
                    jqcc.mobilewebapp.chatroomdetect();
                }
            },
            buddyList: function(data){
                if(typeof (jqcc.chatmobilewebapp)!=='undefined'){
                    jqcc.chatmobilewebapp.chatbuddyList(data);
                }
            },
            userStatus: function(item){
                jqcc.cometchat.setThemeVariable('userid', item.id);
                jqcc.cometchat.setThemeArray('buddylistStatus', item.id, item.status);
                jqcc.cometchat.setThemeArray('buddylistMessage', item.id, item.message);
                jqcc.cometchat.setThemeArray('buddylistName', item.id, item.n);
                jqcc.cometchat.setThemeArray('buddylistAvatar', item.id, item.a);
                jqcc.cometchat.setThemeArray('buddylistLink', item.id, item.l);
            },
            loadData: function(id, data){
                if(typeof (jqcc.chatmobilewebapp)!=='undefined'){
                    jqcc.chatmobilewebapp.chatloadData(id, data);
                }
            },
            txtfocus: function(){
                $('#cometchat_container_report').find('.cometchat_closebox').click();
                $('#opt').css('display', 'none');
            },
            get_user: function(){
                var searchc = document.getElementById('searchtxt').value;
                $("li.userlists").css("display", "none");
                $("span.search_name:containsIgnoreCase('"+searchc+"')").parent().parent().css("display", "block");
            },
            get_chatroom: function(){
                var searchc = document.getElementById('searchtxtCR').value;
                $("li.crlists").css("display", "none");
                $("span.lobby_room_1:containsIgnoreCase('"+searchc+"')").parent().parent().css("display", "block");
            },
            pathRedirect: function(showdiv){
                $("#buddy").hide();
                $("#lobby").hide();
                $("#chat").hide();
                $("#chatroom").hide();
                $("#chatroomuser").hide();
                $("#createChatroom").hide();
                if(showdiv!=''){
                    if(showdiv=='#lobby'){
                        $("#lobby").css('display', 'block');
                    }else if(showdiv=='#buddy'){
                        $("#buddy").css('display', 'block');
                    }else{
                        $(showdiv).css('display', 'block');
                    }
                }else{
                    $("#buddy").css('display', 'block');
                }
            },
            loggedOut: function(){
                var settings = jqcc.cometchat.getSettings();
                if(settings.ccauth.enabled==0){
                    alert(jqcc.cometchat.getLanguage(56));
                    var window_opener = window.opener;
                    if(typeof (window_opener)!=='undefined' && window_opener !== null){
                        if(cross_domain==1){
                            window_opener.postMessage('ccmobile_reinitializeauth','*');
                        }else if(typeof (window_opener.jqcc.ccmobiletab.reinitialize)!=='undefined'){
                            window_opener.jqcc.ccmobiletab.reinitialize();
                        }
                    }
                    location.href = '/';
                }else{
                    $(".cometchat_ccmobiletab_redirect ,.cometchat_ccmobiletab_tabalert").die('click');
                    $(".cometchat_ccmobiletab_redirect ,.cometchat_ccmobiletab_tabalert").die('click');
                    var ccauthpopup = '<div class="cc_overlay" onclick=""></div><div id="cometchat_social_login"><div class="login_container"><div class="login_image_container">';
                    var authactive = settings.ccauth.active;
                    authactive.forEach(function(auth) {
                        ccauthpopup += '<img onclick="window.open(\''+jqcc.cometchat.getBaseUrl()+'functions/login/signin.php?caller=mobilewebapp&network='+auth.toLowerCase()+'\',\'socialwindow\')" src="'+jqcc.cometchat.getBaseUrl()+'themes/mobile/images/login'+auth.toLowerCase()+'.png" class="auth_options"></img>';
                    });
                    ccauthpopup += '</div></div></div>';
                    $('body').html(ccauthpopup);
                }
            },
            reinitialize:function(){
                window.location.reload();
                window.focus();
            },
            scrollToBottom: function(){
                if($('#cwlist').length > 0 && $('#cwlist').find("li").length > 0)
                    $('#chatcontent').scrollTop($('#cwlist').find("li").last().position().top+$('#cwlist').find("li").last().height());
            },
            crscrollToBottom: function(){
                if($('#currentroom_convotext').find('div').length)
                    $('#chatroomcontent').scrollTop($('#currentroom_convotext').find('div').last().position().top+$('#currentroom_convotext').find('div').last().height());
            },
            refreshLists: function(id){
                $('#'+id).listview("refresh");
            },
            addChatroomMessage: function(fromid, incomingmessage, incomingid, selfadded, sent, fromname){
                jqcc.mobilewebapp.ChatroomMessage(fromid, incomingmessage, incomingid, selfadded, sent, fromname);
            },
            loadChatbox: function(){
                jqcc.mobilewebapp.pathRedirect('#chat');
            },
            loadChatboxReverse: function(){
                jqcc.mobilewebapp.pathRedirect('#buddy');
                if(typeof (jqcc.chatmobilewebapp)!=='undefined'){
                    jqcc.chatmobilewebapp.back();
                }
                $('#buddy_link').click();
            },
            loadChatroom: function(){
                jqcc.mobilewebapp.pathRedirect('#chatroom');
            },
            loadChatroomReverse: function(){
                jqcc.mobilewebapp.pathRedirect('#chatroom');
            },
            loadLobbyReverse: function(){
                jqcc.mobilewebapp.pathRedirect('#lobby');
                if(typeof (jqcc.mobilewebapp)!=='undefined'){
                    jqcc.mobilewebapp.backchatroom();
                }
                $('#chatroomlink').click();
            },
            showChatroomUser: function(){
                jqcc.mobilewebapp.pathRedirect('#chatroomuser');
            },
            chatwith: function(){
                jqcc.mobilewebapp.pathRedirect('#chat');
                return true;
            },
            createChatroom: function(){
                jqcc.mobilewebapp.pathRedirect('#createChatroom');
            },
            refreshPage: function(){
                location.reload();
            },
            getCookieInfo: function(cookieName){
                var i, x, y, ARRcookies = document.cookie.split(";");
                for(i = 0; i<ARRcookies.length; i++)
                {
                    x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
                    y = ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
                    x = x.replace(/^\s+|\s+$/g, "");
                    if(x==cookieName){
                        return unescape(y);
                    }
                }
            },
            addMessages: function(data){
                if(typeof (jqcc.chatmobilewebapp)!=='undefined'){
                    jqcc.chatmobilewebapp.attachMessage(data);
                }
            },
            loadUserData: function(id, data){
                if(typeof (jqcc.chatmobilewebapp)!=='undefined'){
                    jqcc.chatmobilewebapp.chatloadUserData(id, data);
                }
            },
            checkSmiley: function(message){
                message = message.replace('\ud83d\udd51', ' :clock2: ');
                message = message.replace('\ud83d\udd5d', ' :clock230: ');
                message = message.replace('\ud83d\udd52', ' :clock3: ');
                message = message.replace('\ud83d\udd5e', ' :clock330: ');
                message = message.replace('\ud83d\udd53', ' :clock4: ');
                message = message.replace('\ud83d\udd5f', ' :clock430: ');
                message = message.replace('\ud83d\udd54', ' :clock5: ');
                message = message.replace('\ud83d\udd60', ' :clock530: ');
                message = message.replace('\ud83d\udd55', ' :clock6: ');
                message = message.replace('\ud83d\udd61', ' :clock630: ');
                message = message.replace('\ud83d\udd56', ' :clock7: ');
                message = message.replace('\ud83d\udd62', ' :clock730: ');
                message = message.replace('\ud83d\udd57', ' :clock8: ');
                message = message.replace('\ud83d\udd63', ' :clock830: ');
                message = message.replace('\ud83d\udd58', ' :clock9: ');
                message = message.replace('\ud83d\udd64', ' :clock930: ');
                message = message.replace('\u3297', ' :congratulations: ');
                message = message.replace('\ud83c\udd92', ' :cool: ');
                message = message.replace('\u00a9', ' :copyright: ');
                message = message.replace('\u27b0', ' :curly_loop: ');
                message = message.replace('\ud83d\udcb1', ' :currency_exchange: ');
                message = message.replace('\ud83d\udec3', ' :customs: ');
                message = message.replace('\ud83d\udca0', ' :diamond_shape_with_a_dot_inside: ');
                message = message.replace('\ud83d\udeaf', ' :do_not_litter: ');
                message = message.replace('\u0038\u20e3', ' :eight: ');
                message = message.replace('\u2734', ' :eight_pointed_black_star: ');
                message = message.replace('\u2733', ' :eight_spoked_asterisk: ');
                message = message.replace('\ud83d\udd1a', ' :end: ');
                message = message.replace('\u23e9', ' :fast_forward: ');
                message = message.replace('\u0035\u20e3', ' :five: ');
                message = message.replace('\u0034\u20e3', ' :four: ');
                message = message.replace('\ud83c\udd93', ' :free: ');
                message = message.replace('\u264a', ' :gemini: ');
                message = message.replace('\u0023\u20e3', ' :hash: ');
                message = message.replace('\ud83d\udc9f', ' :heart_decoration: ');
                message = message.replace('\u2714', ' :heavy_check_mark: ');
                message = message.replace('\u2797', ' :heavy_division_sign: ');
                message = message.replace('\ud83d\udcb2', ' :heavy_dollar_sign: ');
                message = message.replace('\u2757', ' :heavy_exclamation_mark: ');
                message = message.replace('\u2796', ' :heavy_minus_sign: ');
                message = message.replace('\u2716', ' :heavy_multiplication_x: ');
                message = message.replace('\u2795', ' :heavy_plus_sign: ');
                message = message.replace('\ud83c\udd94', ' :id: ');
                message = message.replace('\ud83c\ude50', ' :ideograph_advantage: ');
                message = message.replace('\u2139', ' :information_source: ');
                message = message.replace('\u2049', ' :interrobang: ');
                message = message.replace('\ud83d\udd1f', ' :keycap_ten: ');
                message = message.replace('\ud83c\ude01', ' :koko: ');
                message = message.replace('\ud83d\udd35', ' :large_blue_circle: ');
                message = message.replace('\ud83d\udd37', ' :large_blue_diamond: ');
                message = message.replace('\ud83d\udd36', ' :large_orange_diamond: ');
                message = message.replace('\ud83d\udec5', ' :left_luggage: ');
                message = message.replace('\u2194', ' :left_right_arrow: ');
                message = message.replace('\u21a9', ' :leftwards_arrow_with_hook: ');
                message = message.replace('\u264c', ' :leo: ');
                message = message.replace('\u264e', ' :libra: ');
                message = message.replace('\ud83d\udd17', ' :link: ');
                message = message.replace('\u24c2', ' :m: ');
                message = message.replace('\ud83d\udeb9', ' :mens: ');
                message = message.replace('\ud83d\ude87', ' :metro: ');
                message = message.replace('\ud83d\udcf4', ' :mobile_phone_off: ');
                message = message.replace('\u274e', ' :negative_squared_cross_mark: ');
                message = message.replace('\ud83c\udd95', ' :new: ');
                message = message.replace('\ud83c\udd96', ' :ng: ');
                message = message.replace('\u0039\u20e3', ' :nine: ');
                message = message.replace('\ud83d\udeb3', ' :no_bicycles: ');
                message = message.replace('\u26d4', ' :no_entry: ');
                message = message.replace('\ud83d\udeab', ' :no_entry_sign: ');
                message = message.replace('\ud83d\udcf5', ' :no_mobile_phones: ');
                message = message.replace('\ud83d\udeb7', ' :no_pedestrians: ');
                message = message.replace('\ud83d\udead', ' :no_smoking: ');
                message = message.replace('\ud83d\udeb1', ' :non-potable_water: ');
                message = message.replace('\u2b55', ' :o: ');
                message = message.replace('\ud83c\udd7e', ' :o2: ');
                message = message.replace('\ud83c\udd97', ' :ok: ');
                message = message.replace('\ud83d\udd1b', ' :on: ');
                message = message.replace('\u0031\u20e3', ' :one: ');
                message = message.replace('\u26ce', ' :ophiuchus: ');
                message = message.replace('\ud83c\udd7f', ' :parking: ');
                message = message.replace('\u303d', ' :part_alternation_mark: ');
                message = message.replace('\ud83d\udec2', ' :passport_control: ');
                message = message.replace('\u2653', ' :pisces: ');
                message = message.replace('\ud83d\udeb0', ' :potable_water: ');
                message = message.replace('\ud83d\udeae', ' :put_litter_in_its_place: ');
                message = message.replace('\ud83d\udd18', ' :radio_button: ');
                message = message.replace('\u267b', ' :recycle: ');
                message = message.replace('\ud83d\udd34', ' :red_circle: ');
                message = message.replace('\u00ae', ' :registered: ');
                message = message.replace('\ud83d\udd01', ' :repeat: ');
                message = message.replace('\ud83d\udd02', ' :repeat_one: ');
                message = message.replace('\ud83d\udebb', ' :restroom: ');
                message = message.replace('\u23ea', ' :rewind: ');
                message = message.replace('\ud83c\ude02', ' :sa: ');
                message = message.replace('\u2650', ' :sagittarius: ');
                message = message.replace('\u264f', ' :scorpius: ');
                message = message.replace('\u3299', ' :secret: ');
                message = message.replace('\u0037\u20e3', ' :seven: ');
                message = message.replace(':shipit:', ' :shipit: ');
                message = message.replace('\ud83d\udcf6', ' :signal_strength: ');
                message = message.replace('\u0036\u20e3', ' :six: ');
                message = message.replace('\ud83d\udd2f', ' :six_pointed_star: ');
                message = message.replace('\ud83d\udd39', ' :small_blue_diamond: ');
                message = message.replace('\ud83d\udd38', ' :small_orange_diamond: ');
                message = message.replace('\ud83d\udd3a', ' :small_red_triangle: ');
                message = message.replace('\ud83d\udd3b', ' :small_red_triangle_down: ');
                message = message.replace('\ud83d\udd1c', ' :soon: ');
                message = message.replace('\ud83c\udd98', ' :sos: ');
                message = message.replace('\ud83d\udd23', ' :symbols1: ');
                message = message.replace('\u2649', ' :taurus: ');
                message = message.replace('\u0033\u20e3', ' :three: ');
                message = message.replace('\u2122', ' :tm: ');
                message = message.replace('\ud83d\udd1d', ' :top: ');
                message = message.replace('\ud83d\udd31', ' :trident: ');
                message = message.replace('\ud83d\udd00', ' :twisted_rightwards_arrows: ');
                message = message.replace('\u0032\u20e3', ' :two: ');
                message = message.replace('\ud83c\ude39', ' :u5272: ');
                message = message.replace('\ud83c\ude34', ' :u5408: ');
                message = message.replace('\ud83c\ude3a', ' :u55b6: ');
                message = message.replace('\ud83c\ude2f', ' :u6307: ');
                message = message.replace('\ud83c\ude37', ' :u6708: ');
                message = message.replace('\ud83c\ude36', ' :u6709: ');
                message = message.replace('\ud83c\ude35', ' :u6e80: ');
                message = message.replace('\ud83c\ude1a', ' :u7121: ');
                message = message.replace('\ud83c\ude38', ' :u7533: ');
                message = message.replace('\ud83c\ude32', ' :u7981: ');
                message = message.replace('\ud83c\ude33', ' :u7a7a: ');
                message = message.replace('\ud83d\udd1e', ' :underage: ');
                message = message.replace('\ud83c\udd99', ' :up: ');
                message = message.replace('\ud83d\udcf3', ' :vibration_mode: ');
                message = message.replace('\u264d', ' :virgo: ');
                message = message.replace('\ud83c\udd9a', ' :vs: ');
                message = message.replace('\u3030', ' :wavy_dash: ');
                message = message.replace('\ud83d\udebe', ' :wc: ');
                message = message.replace('\u267f', ' :wheelchair: ');
                message = message.replace('\u2705', ' :white_check_mark: ');
                message = message.replace('\u26aa', ' :white_circle: ');
                message = message.replace('\ud83d\udcae', ' :white_flower: ');
                message = message.replace('\u25fb', ' :white_square: ');
                message = message.replace('\ud83d\udd33', ' :white_square_button: ');
                message = message.replace('\ud83d\udeba', ' :womens: ');
                message = message.replace('\u274c', ' :x: ');
                message = message.replace('\u0030\u20e3', ' :zero: ');
                message = message.replace('\u2708', ' :airplane: ');
                message = message.replace('\ud83d\ude91', ' :ambulance: ');
                message = message.replace('\u2693', ' :anchor: ');
                message = message.replace('\ud83d\ude9b', ' :articulated_lorry: ');
                message = message.replace('\ud83c\udfe7', ' :atm: ');
                message = message.replace('\ud83c\udfe6', ' :bank: ');
                message = message.replace('\ud83d\udc88', ' :barber: ');
                message = message.replace('\ud83d\udd30', ' :beginner: ');
                message = message.replace('\ud83d\udeb2', ' :bike: ');
                message = message.replace('\ud83d\ude99', ' :blue_car: ');
                message = message.replace('\u26f5', ' :boat: ');
                message = message.replace('\ud83c\udf09', ' :bridge_at_night: ');
                message = message.replace('\ud83d\ude85', ' :bullettrain_front: ');
                message = message.replace('\ud83d\ude84', ' :bullettrain_side: ');
                message = message.replace('\ud83d\ude8c', ' :bus: ');
                message = message.replace('\ud83d\ude8f', ' :busstop: ');
                message = message.replace('\ud83d\ude97', ' :car: ');
                message = message.replace('\ud83c\udfa0', ' :carousel_horse: ');
                message = message.replace('\ud83c\udfc1', ' :checkered_flag: ');
                message = message.replace('\u26ea', ' :church: ');
                message = message.replace('\ud83c\udfaa', ' :circus_tent: ');
                message = message.replace('\ud83c\udf07', ' :city_sunrise: ');
                message = message.replace('\ud83c\udf06', ' :city_sunset: ');
                message = message.replace('\ud83c\udde8\ud83c\uddf3', ' :cn: ');
                message = message.replace('\ud83d\udea7', ' :construction: ');
                message = message.replace('\ud83c\udfea', ' :convenience_store: ');
                message = message.replace('\ud83c\udf8c', ' :crossed_flags: ');
                message = message.replace('\ud83c\udde9\ud83c\uddea', ' :de: ');
                message = message.replace('\ud83c\udfec', ' :department_store: ');
                message = message.replace('\ud83c\uddea\ud83c\uddf8', ' :es: ');
                message = message.replace('\ud83c\udff0', ' :european_castle: ');
                message = message.replace('\ud83c\udfe4', ' :european_post_office: ');
                message = message.replace('\ud83c\udfed', ' :factory: ');
                message = message.replace('\ud83c\udfa1', ' :ferris_wheel: ');
                message = message.replace('\ud83d\ude92', ' :fire_engine: ');
                message = message.replace('\u26f2', ' :fountain: ');
                message = message.replace('\ud83c\uddeb\ud83c\uddf7', ' :fr: ');
                message = message.replace('\u26fd', ' :fuelpump: ');
                message = message.replace('\ud83c\uddec\ud83c\udde7', ' :gb: ');
                message = message.replace('\ud83d\ude81', ' :helicopter: ');
                message = message.replace('\ud83c\udfe5', ' :hospital: ');
                message = message.replace('\ud83c\udfe8', ' :hotel: ');
                message = message.replace('\u2668', ' :hotsprings: ');
                message = message.replace('\ud83c\udfe0', ' :house: ');
                message = message.replace('\ud83c\udfe1', ' :house_with_garden: ');
                message = message.replace('\ud83c\uddee\ud83c\uddf9', ' :it: ');
                message = message.replace('\ud83c\udfee', ' :izakaya_lantern: ');
                message = message.replace('\ud83d\uddfe', ' :japan: ');
                message = message.replace('\ud83c\udfef', ' :japanese_castle: ');
                message = message.replace('\ud83c\uddee\ud83c\uddf3', ' :in: ');
                message = message.replace('\ud83c\uddef\ud83c\uddf5', ' :jp: ');
                message = message.replace('\ud83c\uddf0\ud83c\uddf7', ' :kr: ');
                message = message.replace('\ud83d\ude88', ' :light_rail: ');
                message = message.replace('\ud83c\udfe9', ' :love_hotel: ');
                message = message.replace('\ud83d\ude90', ' :minibus: ');
                message = message.replace('\ud83d\ude9d', ' :monorail: ');
                message = message.replace('\ud83d\uddfb', ' :mount_fuji: ');
                message = message.replace('\ud83d\udea0', ' :mountain_cableway: ');
                message = message.replace('\ud83d\ude9e', ' :mountain_railway: ');
                message = message.replace('\ud83d\uddff', ' :moyai: ');
                message = message.replace('\ud83c\udfe2', ' :office: ');
                message = message.replace('\ud83d\ude98', ' :oncoming_automobile: ');
                message = message.replace('\ud83d\ude8d', ' :oncoming_bus: ');
                message = message.replace('\ud83d\ude94', ' :oncoming_police_car: ');
                message = message.replace('\ud83d\ude96', ' :oncoming_taxi: ');
                message = message.replace('\ud83c\udfad', ' :performing_arts: ');
                message = message.replace('\ud83d\ude93', ' :police_car: ');
                message = message.replace('\ud83c\udfe3', ' :post_office: ');
                message = message.replace('\ud83d\ude83', ' :railway_car: ');
                message = message.replace('\ud83c\udf08', ' :rainbow: ');
                message = message.replace('\ud83d\ude97', ' :red_car: ');
                message = message.replace('\ud83d\ude80', ' :rocket: ');
                message = message.replace('\ud83c\udfa2', ' :roller_coaster: ');
                message = message.replace('\ud83d\udea8', ' :rotating_light: ');
                message = message.replace('\ud83d\udccd', ' :round_pushpin: ');
                message = message.replace('\ud83d\udea3', ' :rowboat: ');
                message = message.replace('\ud83c\uddf7\ud83c\uddfa', ' :ru: ');
                message = message.replace('\u26f5', ' :sailboat: ');
                message = message.replace('\ud83c\udfeb', ' :school: ');
                message = message.replace('\ud83d\udea2', ' :ship: ');
                message = message.replace('\ud83c\udfb0', ' :slot_machine: ');
                message = message.replace('\ud83d\udea4', ' :speedboat: ');
                message = message.replace('\ud83c\udf03', ' :stars: ');
                message = message.replace('\ud83d\ude89', ' :station: ');
                message = message.replace('\ud83d\uddfd', ' :statue_of_liberty: ');
                message = message.replace('\ud83d\ude82', ' :steam_locomotive: ');
                message = message.replace('\ud83c\udf05', ' :sunrise: ');
                message = message.replace('\ud83c\udf04', ' :sunrise_over_mountains: ');
                message = message.replace('\ud83d\ude9f', ' :suspension_railway: ');
                message = message.replace('\ud83d\ude95', ' :taxi: ');
                message = message.replace('\u26fa', ' :tent: ');
                message = message.replace('\ud83c\udfab', ' :ticket: ');
                message = message.replace('\ud83d\uddfc', ' :tokyo_tower: ');
                message = message.replace('\ud83d\ude9c', ' :tractor: ');
                message = message.replace('\ud83d\udea5', ' :traffic_light: ');
                message = message.replace('\ud83d\ude83', ' :train: ');
                message = message.replace('\ud83d\ude86', ' :train2: ');
                message = message.replace('\ud83d\ude8a', ' :tram: ');
                message = message.replace('\ud83d\udea9', ' :triangular_flag_on_post: ');
                message = message.replace('\ud83d\ude8e', ' :trolleybus: ');
                message = message.replace('\ud83d\ude9a', ' :truck: ');
                message = message.replace('\ud83c\uddec\ud83c\udde7', ' :uk: ');
                message = message.replace('\ud83c\uddfa\ud83c\uddf8', ' :us: ');
                message = message.replace('\ud83d\udea6', ' :vertical_traffic_light: ');
                message = message.replace('\u26a0', ' :warning: ');
                message = message.replace('\ud83d\udc92', ' :wedding: ');
                message = message.replace('\ud83d\udc7d', ' :alien: ');
                message = message.replace('\ud83d\udc7c', ' :angel: ');
                message = message.replace('\ud83d\udca2', ' :anger: ');
                message = message.replace('\ud83d\ude20', ' :angry: ');
                message = message.replace('\ud83d\ude27', ' :anguished: ');
                message = message.replace('\ud83d\ude32', ' :astonished: ');
                message = message.replace('\ud83d\udc76', ' :baby: ');
                message = message.replace('\ud83d\udc99', ' :blue_heart: ');
                message = message.replace('\ud83d\ude0a', ' :blush: ');
                message = message.replace('\ud83d\udca5', ' :boom: ');
                message = message.replace('\ud83d\ude47', ' :bow: ');
                message = message.replace(':bowtie:', ' :bowtie: ');
                message = message.replace('\ud83d\udc66', ' :boy: ');
                message = message.replace('\ud83d\udc70', ' :bride_with_veil: ');
                message = message.replace('\ud83d\udc94', ' :broken_heart: ');
                message = message.replace('\ud83d\udc64', ' :bust_in_silhouette: ');
                message = message.replace('\ud83d\udc65', ' :busts_in_silhouette: ');
                message = message.replace('\ud83d\udc4f', ' :clap: ');
                message = message.replace('\ud83d\ude30', ' :cold_sweat: ');
                message = message.replace('\ud83d\udca5', ' :collision: ');
                message = message.replace('\ud83d\ude16', ' :confounded: ');
                message = message.replace('\ud83d\ude15', ' :confused: ');
                message = message.replace('\ud83d\udc77', ' :construction_worker: ');
                message = message.replace('\ud83d\udc6e', ' :cop: ');
                message = message.replace('\ud83d\udc6b', ' :couple: ');
                message = message.replace('\ud83d\udc91', ' :couple_with_heart: ');
                message = message.replace('\ud83d\udc8f', ' :couplekiss: ');
                message = message.replace('\ud83d\ude22', ' :cry: ');
                message = message.replace('\ud83d\ude3f', ' :crying_cat_face: ');
                message = message.replace('\ud83d\udc98', ' :cupid: ');
                message = message.replace('\ud83d\udc83', ' :dancer: ');
                message = message.replace('\ud83d\udc6f', ' :dancers: ');
                message = message.replace('\ud83d\udca8', ' :dash: ');
                message = message.replace('\ud83d\ude1e', ' :disappointed: ');
                message = message.replace('\ud83d\ude25', ' :disappointed_relieved: ');
                message = message.replace('\ud83d\udcab', ' :dizzy: ');
                message = message.replace('\ud83d\ude35', ' :dizzy_face: ');
                message = message.replace('\ud83d\udca7', ' :droplet: ');
                message = message.replace('\ud83d\udc42', ' :ear: ');
                message = message.replace('\u2757', ' :exclamation: ');
                message = message.replace('\ud83d\ude11', ' :expressionless: ');
                message = message.replace('\ud83d\udc40', ' :eyes: ');
                message = message.replace('\ud83d\udc6a', ' :family: ');
                message = message.replace('\ud83d\ude28', ' :fearful: ');
                message = message.replace(':feelsgood:', ' :feelsgood: ');
                message = message.replace('\ud83d\udc63', ' :feet: ');
                message = message.replace(':finnadie:', ' :finnadie: ');
                message = message.replace('\ud83d\udd25', ' :fire: ');
                message = message.replace('\u270a', ' :fist: ');
                message = message.replace('\ud83d\ude33', ' :flushed: ');
                message = message.replace('\ud83d\ude26', ' :frowning: ');
                message = message.replace('\ud83d\udc67', ' :girl: ');
                message = message.replace(':goberserk:', ' :goberserk: ');
                message = message.replace(':godmode:', ' :godmode: ');
                message = message.replace('\ud83d\udc9a', ' :green_heart: ');
                message = message.replace('\u2755', ' :grey_exclamation: ');
                message = message.replace('\u2754', ' :grey_question: ');
                message = message.replace('\ud83d\ude01', ' :grimacing: ');
                message = message.replace('\ud83d\ude2c', ' :grin: ');
                message = message.replace('\ud83d\ude00', ' :grinning: ');
                message = message.replace('\ud83d\udc82', ' :guardsman: ');
                message = message.replace('\ud83d\udc87', ' :haircut: ');
                message = message.replace('\u270b', ' :hand: ');
                message = message.replace('\ud83d\ude49', ' :hear_no_evil: ');
                message = message.replace('\u2764', ' :heart: ');
                message = message.replace('\ud83d\ude0d', ' :heart_eyes: ');
                message = message.replace('\ud83d\ude3b', ' :heart_eyes_cat: ');
                message = message.replace('\ud83d\udc93', ' :heartbeat: ');
                message = message.replace('\ud83d\udc97', ' :heartpulse: ');
                message = message.replace(':hurtrealbad:', ' :hurtrealbad: ');
                message = message.replace('\ud83d\ude2f', ' :hushed: ');
                message = message.replace('\ud83d\udc7f', ' :imp: ');
                message = message.replace('\ud83d\udc81', ' :information_desk_person: ');
                message = message.replace('\ud83d\ude07', ' :innocent: ');
                message = message.replace('\ud83d\udc7a', ' :japanese_goblin: ');
                message = message.replace('\ud83d\udc79', ' :japanese_ogre: ');
                message = message.replace('\ud83d\ude02', ' :joy: ');
                message = message.replace('\ud83d\ude39', ' :joy_cat: ');
                message = message.replace('\ud83d\udc8b', ' :kiss: ');
                message = message.replace('\ud83d\ude17', ' :kissing: ');
                message = message.replace('\ud83d\ude3d', ' :kissing_cat: ');
                message = message.replace('\ud83d\ude1a', ' :kissing_closed_eyes: ');
                message = message.replace('\ud83d\ude18', ' :kissing_heart: ');
                message = message.replace('\ud83d\ude19', ' :kissing_smiling_eyes: ');
                message = message.replace('\ud83d\ude06', ' :laughing: ');
                message = message.replace('\ud83d\udc44', ' :lips: ');
                message = message.replace('\ud83d\udc8c', ' :love_letter: ');
                message = message.replace('\ud83d\udc68', ' :man: ');
                message = message.replace('\ud83d\udc72', ' :man_with_gua_pi_mao: ');
                message = message.replace('\ud83d\udc73', ' :man_with_turban: ');
                message = message.replace('\ud83d\ude37', ' :mask: ');
                message = message.replace('\ud83d\udc86', ' :massage: ');
                message = message.replace(':metal:', ' :metal: ');
                message = message.replace('\ud83d\udcaa', ' :muscle: ');
                message = message.replace('\ud83c\udfb5', ' :musical_note: ');
                message = message.replace('\ud83d\udc85', ' :nail_care: ');
                message = message.replace(':neckbeard:', ' :neckbeard: ');
                message = message.replace('\ud83d\ude10', ' :neutral_face: ');
                message = message.replace('\ud83d\ude45', ' :no_good: ');
                message = message.replace('\ud83d\ude36', ' :no_mouth: ');
                message = message.replace('\ud83d\udc43', ' :nose: ');
                message = message.replace('\ud83c\udfb6', ' :notes: ');
                message = message.replace('\ud83d\udc4c', ' :ok_hand: ');
                message = message.replace('\ud83d\ude46', ' :ok_woman: ');
                message = message.replace('\ud83d\udc74', ' :older_man: ');
                message = message.replace('\ud83d\udc75', ' :older_woman: ');
                message = message.replace('\ud83d\udc50', ' :open_hands: ');
                message = message.replace('\ud83d\ude2E', ' :open_mouth: ');
                message = message.replace('\ud83d\ude14', ' :pensive: ');
                message = message.replace('\ud83d\ude23', ' :persevere: ');
                message = message.replace('\ud83d\de4d', ' :person_frowning: ');
                message = message.replace('\ud83d\udc71', ' :person_with_blond_hair: ');
                message = message.replace('\ud83d\ude4e', ' :person_with_pouting_face: ');
                message = message.replace('\ud83d\udc47', ' :point_down: ');
                message = message.replace('\ud83d\udc48', ' :point_left: ');
                message = message.replace('\ud83d\udc49', ' :point_right: ');
                message = message.replace('\u261d', ' :point_up: ');
                message = message.replace('\ud83d\udc46', ' :point_up_2: ');
                message = message.replace('\ud83d\ude3e', ' :pouting_cat: ');
                message = message.replace('\ud83d\ude4f', ' :pray: ');
                message = message.replace('\ud83d\udc78', ' :princess: ');
                message = message.replace('\ud83d\udc4a', ' :punch: ');
                message = message.replace('\ud83d\udc9c', ' :purple_heart: ');
                message = message.replace('\u2753', ' :question: ');
                message = message.replace('\ud83d\ude21', ' :rage: ');
                message = message.replace('\u270b', ' :raised_hand: ');
                message = message.replace('\ud83d\ude4c', ' :raised_hands: ');
                message = message.replace('\ud83d\ude4b', ' :raising_hand: ');
                message = message.replace('\u263a', ' :relaxed: ');
                message = message.replace('\ud83d\ude0c', ' :relieved: ');
                message = message.replace('\ud83d\udc9e', ' :revolving_hearts: ');
                message = message.replace('\ud83c\udfc3', ' :runner: ');
                message = message.replace('\ud83c\udfc3', ' :running: ');
                message = message.replace('\ud83d\ude06', ' :satisfied: ');
                message = message.replace('\ud83d\ude31', ' :scream: ');
                message = message.replace('\ud83d\ude40', ' :scream_cat: ');
                message = message.replace('\ud83d\ude48', ' :see_no_evil: ');
                message = message.replace('\ud83d\udca9', ' :shit: ');
                message = message.replace('\ud83d\udc80', ' :skull: ');
                message = message.replace('\ud83d\ude34', ' :sleeping: ');
                message = message.replace('\ud83d\ude2a', ' :sleepy: ');
                message = message.replace('\ud83d\ude03', ' :smile: ');
                message = message.replace('\ud83d\ude38', ' :smile_cat: ');
                message = message.replace('\ud83d\ude04', ' :smiley: ');
                message = message.replace('\ud83d\ude3a', ' :smiley_cat: ');
                message = message.replace('\ud83d\ude08', ' :smiling_imp: ');
                message = message.replace('\ud83d\ude0f', ' :smirk: ');
                message = message.replace('\ud83d\ude3c', ' :smirk_cat: ');
                message = message.replace('\ud83d\ude2d', ' :sob: ');
                message = message.replace('\u2728', ' :sparkles: ');
                message = message.replace('\ud83d\udc96', ' :sparkling_heart: ');
                message = message.replace('\ud83d\ude4a', ' :speak_no_evil: ');
                message = message.replace('\ud83d\udcac', ' :speech_balloon: ');
                message = message.replace('\u2b50', ' :star: ');
                message = message.replace('\ud83c\udf1f', ' :star2: ');
                message = message.replace('\ud83d\ude1b', ' :stuck_out_tongue: ');
                message = message.replace('\ud83d\ude1d', ' :stuck_out_tongue_closed_eyes: ');
                message = message.replace('\ud83d\ude1c', ' :stuck_out_tongue_winking_eye: ');
                message = message.replace('\ud83d\ude0e', ' :sunglasses: ');
                message = message.replace(':suspect:', ' :suspect: ');
                message = message.replace('\ud83d\ude13', ' :sweat: ');
                message = message.replace('\ud83d\udca6', ' :sweat_drops: ');
                message = message.replace('\ud83d\ude05', ' :sweat_smile: ');
                message = message.replace('\ud83d\udcad', ' :thought_balloon: ');
                message = message.replace('\ud83d\udc4e', ' :thumbsdown: ');
                message = message.replace('\ud83d\udc4d', ' :thumbsup: ');
                message = message.replace('\ud83d\ude2b', ' :tired_face: ');
                message = message.replace('\ud83d\udc45', ' :tongue: ');
                message = message.replace('\ud83d\ude24', ' :triumph: ');
                message = message.replace(':trollface:', ' :trollface: ');
                message = message.replace('\ud83d\udc95', ' :two_hearts: ');
                message = message.replace('\ud83d\udc6c', ' :two_men_holding_hands: ');
                message = message.replace('\ud83d\udc6d', ' :two_women_holding_hands: ');
                message = message.replace('\ud83d\ude12', ' :unamused: ');
                message = message.replace('\u270c', ' :v: ');
                message = message.replace('\ud83d\udeb6', ' :walking: ');
                message = message.replace('\ud83d\udc4b', ' :wave: ');
                message = message.replace('\ud83d\ude29', ' :weary: ');
                message = message.replace('\ud83d\ude09', ' :wink: ');
                message = message.replace('\ud83d\udc69', ' :woman: ');
                message = message.replace('\ud83d\ude1f', ' :worried: ');
                message = message.replace('\ud83d\udc9b', ' :yellow_heart: ');
                message = message.replace('\ud83d\ude0b', ' :yum: ');
                message = message.replace('\ud83d\udca4', ' :zzz: ');
                message = message.replace('\ud83c\udfb1', ' :n8ball: ');
                message = message.replace('\u23f0', ' :alarm_clock: ');
                message = message.replace('\ud83c\udf4e', ' :apple: ');
                message = message.replace('\ud83c\udfa8', ' :art: ');
                message = message.replace('\ud83c\udf7c', ' :baby_bottle: ');
                message = message.replace('\ud83c\udf88', ' :balloon: ');
                message = message.replace('\ud83c\udf8d', ' :bamboo: ');
                message = message.replace('\ud83c\udf4c', ' :banana: ');
                message = message.replace('\ud83d\udcca', ' :bar_chart: ');
                message = message.replace('\u26be', ' :baseball: ');
                message = message.replace('\ud83c\udfc0', ' :basketball: ');
                message = message.replace('\ud83d\udec0', ' :bath: ');
                message = message.replace('\ud83d\udec1', ' :bathtub: ');
                message = message.replace('\ud83d\udd0b', ' :battery: ');
                message = message.replace('\ud83c\udf7a', ' :beer: ');
                message = message.replace('\ud83c\udf7b', ' :beers: ');
                message = message.replace('\ud83d\udd14 ', ' :bell: ');
                message = message.replace('\ud83c\udf71', ' :bento: ');
                message = message.replace('\ud83d\udeb4', ' :bicyclist: ');
                message = message.replace('\ud83d\udc59', ' :bikini: ');
                message = message.replace('\ud83c\udf82', ' :birthday: ');
                message = message.replace('\ud83c\udccf', ' :black_joker: ');
                message = message.replace('\u2712', ' :black_nib: ');
                message = message.replace('\ud83d\udcd8', ' :blue_book: ');
                message = message.replace('\ud83d\udca3', ' :bomb: ');
                message = message.replace('\ud83d\udcd6', ' :book: ');
                message = message.replace('\ud83d\udd16', ' :bookmark: ');
                message = message.replace('\ud83d\udcd1', ' :bookmark_tabs: ');
                message = message.replace('\ud83d\udcda', ' :books: ');
                message = message.replace('\ud83d\udc62', ' :boot: ');
                message = message.replace('\ud83c\udfb3', ' :bowling: ');
                message = message.replace('\ud83c\udf5e', ' :bread: ');
                message = message.replace('\ud83d\udcbc', ' :briefcase: ');
                message = message.replace('\ud83d\udca1', ' :bulb: ');
                message = message.replace('\ud83c\udf70', ' :cake: ');
                message = message.replace('\ud83d\udcc6', ' :calendar: ');
                message = message.replace('\ud83d\udcf2', ' :calling: ');
                message = message.replace('\ud83d\udcf7', ' :camera: ');
                message = message.replace('\ud83c\udf6c', ' :candy: ');
                message = message.replace('\ud83d\udcc7', ' :card_index: ');
                message = message.replace('\ud83d\udcbf', ' :cd: ');
                message = message.replace('\ud83d\udcc9', ' :chart_with_downwards_trend: ');
                message = message.replace('\ud83d\udcc8', ' :chart_with_upwards_trend: ');
                message = message.replace('\ud83c\udf52', ' :cherries: ');
                message = message.replace('\ud83c\udf6b', ' :chocolate_bar: ');
                message = message.replace('\ud83c\udf84', ' :christmas_tre: ');
                message = message.replace('\ud83c\udfac', ' :clapper: ');
                message = message.replace('\ud83d\udccb', ' :clipboard: ');
                message = message.replace('\ud83d\udcd5', ' :closed_book: ');
                message = message.replace('\ud83d\udd10', ' :closed_lock_with_key: ');
                message = message.replace('\ud83c\udf02', ' :closed_umbrella: ');
                message = message.replace('\u2663', ' :clubs: ');
                message = message.replace('\ud83c\udf78', ' :cocktail: ');
                message = message.replace('\u2615', ' :coffee: ');
                message = message.replace('\ud83d\udcbb', ' :computer: ');
                message = message.replace('\ud83c\udf8a', ' :confetti_ball: ');
                message = message.replace('\ud83c\udf6a', ' :cookie: ');
                message = message.replace('\ud83c\udf3d', ' :corn: ');
                message = message.replace('\ud83d\udcb3', ' :credit_card: ');
                message = message.replace('\ud83d\udc51', ' :crown: ');
                message = message.replace('\ud83d\udd2e', ' :crystal_ball: ');
                message = message.replace('\ud83c\udf5b', ' :curry: ');
                message = message.replace('\ud83c\udf6e', ' :custard: ');
                message = message.replace('\ud83c\udf61', ' :dango: ');
                message = message.replace('\ud83c\udfaf', ' :dart: ');
                message = message.replace('\ud83d\udcc5', ' :date: ');
                message = message.replace('\u2666', ' :diamonds: ');
                message = message.replace('\ud83d\udcb5', ' :dollar: ');
                message = message.replace('\ud83c\udf8e', ' :dolls: ');
                message = message.replace('\ud83d\udeaa', ' :door: ');
                message = message.replace('\ud83c\udf69', ' :doughnut: ');
                message = message.replace('\ud83d\udc57', ' :dress: ');
                message = message.replace('\ud83d\udcc0', ' :dvd: ');
                message = message.replace('\ud83d\udce7', ' :e-mail: ');
                message = message.replace('\ud83c\udf73', ' :egg: ');
                message = message.replace('\ud83c\udf46', ' :eggplant: ');
                message = message.replace('\ud83d\udd0c', ' :electric_plug: ');
                message = message.replace('\ud83d\udce9', ' :email: ');
                message = message.replace('\u2709', ' :envelope: ');
                message = message.replace('\ud83d\udcb6', ' :euro: ');
                message = message.replace('\ud83d\udc53', ' :eyeglasses: ');
                message = message.replace('\ud83d\udce0', ' :fax: ');
                message = message.replace('\ud83d\udcc1', ' :file_folder: ');
                message = message.replace('\ud83c\udf86 ', ' :fireworks: ');
                message = message.replace('\ud83c\udf65', ' :fish_cake: ');
                message = message.replace('\ud83c\udfa3', ' :fishing_pole_and_fish: ');
                message = message.replace('\ud83c\udf8f', ' :flags: ');
                message = message.replace('\ud83d\udd26', ' :flashlight: ');
                message = message.replace('\ud83d\udcbe', ' :floppy_disk: ');
                message = message.replace('\ud83c\udfb4', ' :flower_playing_cards: ');
                message = message.replace('\ud83c\udfc8', ' :football: ');
                message = message.replace('\ud83c\udf74', ' :fork_and_knife: ');
                message = message.replace('\ud83c\udf64', ' :fried_shrimp: ');
                message = message.replace('\ud83c\udf5f', ' :fries: ');
                message = message.replace('\ud83c\udfb2', ' :game_die: ');
                message = message.replace('\ud83d\udc8e', ' :gem: ');
                message = message.replace('\ud83d\udc7b', ' :ghost: ');
                message = message.replace('\ud83c\udf81', ' :gift: ');
                message = message.replace('\ud83d\udc9d', ' :gift_heart: ');
                message = message.replace('\u26f3', ' :golf: ');
                message = message.replace('\ud83c\udf47', ' :grapes: ');
                message = message.replace('\ud83c\udf4f', ' :green_apple: ');
                message = message.replace('\ud83d\udcd7', ' :green_book: ');
                message = message.replace('\ud83c\udfb8', ' :guitar: ');
                message = message.replace('\ud83d\udd2b', ' :gun: ');
                message = message.replace('\ud83c\udf54', ' :hamburger: ');
                message = message.replace('\ud83d\udd28', ' :hammer: ');
                message = message.replace('\ud83d\udc5c', ' :handbag: ');
                message = message.replace('\ud83c\udfa7', ' :headphones: ');
                message = message.replace('\u2665', ' :hearts: ');
                message = message.replace('\ud83d\udd06', ' :high_brightness: ');
                message = message.replace('\ud83d\udc60', ' :high_heel: ');
                message = message.replace('\ud83d\udd2a', ' :hocho: ');
                message = message.replace('\ud83c\udf6f', ' :honey_pot: ');
                message = message.replace('\ud83c\udfc7', ' :horse_racing: ');
                message = message.replace('\u231b', ' :hourglass: ');
                message = message.replace('\u23f3', ' :hourglass_flowing_sand: ');
                message = message.replace('\ud83c\udf68', ' :ice_cream: ');
                message = message.replace('\ud83c\udf66', ' :icecream: ');
                message = message.replace('\ud83d\udce5', ' :inbox_tray: ');
                message = message.replace('\ud83d\udce8', ' :incoming_envelope: ');
                message = message.replace('\ud83d\udcf1', ' :iphone: ');
                message = message.replace('\ud83c\udf83', ' :jack_o_lantern: ');
                message = message.replace('\ud83d\udc56', ' :jeans: ');
                message = message.replace('\ud83d\udd11', ' :key: ');
                message = message.replace('\ud83d\udc58', ' :kimono: ');
                message = message.replace('\ud83d\udcd2', ' :ledger: ');
                message = message.replace('\ud83c\udf4b', ' :lemon: ');
                message = message.replace('\ud83d\udc84', ' :lipstick: ');
                message = message.replace('\ud83d\udd12', ' :lock: ');
                message = message.replace('\ud83d\udd0f ', ' :lock_with_ink_pen: ');
                message = message.replace('\ud83c\udf6d', ' :lollipop: ');
                message = message.replace('\u27bf', ' :loop: ');
                message = message.replace('\ud83d\udce2', ' :loudspeaker: ');
                message = message.replace('\ud83d\udd05', ' :low_brightness: ');
                message = message.replace('\ud83d\udd0d', ' :mag: ');
                message = message.replace('\ud83d\udd0e', ' :mag_right: ');
                message = message.replace('\ud83c\udc04', ' :mahjong: ');
                message = message.replace('\ud83d\udceb', ' :mailbox: ');
                message = message.replace('\ud83d\udcea', ' :mailbox_closed: ');
                message = message.replace('\ud83d\udcec', ' :mailbox_with_mail: ');
                message = message.replace('\ud83d\udced', ' :mailbox_with_no_mail: ');
                message = message.replace('\ud83d\udc5e', ' :mans_shoe: ');
                message = message.replace('\ud83c\udf56', ' :meat_on_bone: ');
                message = message.replace('\ud83d\udce3', ' :mega: ');
                message = message.replace('\ud83c\udf48', ' :melon: ');
                message = message.replace('\ud83d\udcdd', ' :memo: ');
                message = message.replace('\ud83c\udfa4', ' :microphone: ');
                message = message.replace('\ud83d\udd2C', ' :microscope: ');
                message = message.replace('\ud83d\udcbd', ' :minidisc: ');
                message = message.replace('\ud83d\udcb8', ' :money_with_wings: ');
                message = message.replace('\ud83d\udcb0', ' :moneybag: ');
                message = message.replace('\ud83c\udf93', ' :mortar_board: ');
                message = message.replace('\ud83d\udeb5', ' :mountain_bicyclist: ');
                message = message.replace('\ud83c\udfa5', ' :movie_camera: ');
                message = message.replace('\ud83c\udfb9', ' :musical_keyboard: ');
                message = message.replace('\ud83c\udfbc', ' :musical_score: ');
                message = message.replace('\ud83d\udd07', ' :mute: ');
                message = message.replace('\ud83d\udcdb', ' :name_badge: ');
                message = message.replace('\ud83d\udc54', ' :necktie: ');
                message = message.replace('\ud83d\udcf0 ', ' :newspaper: ');
                message = message.replace('\ud83d\udd15', ' :no_bell: ');
                message = message.replace('\ud83d\udcd3', ' :notebook: ');
                message = message.replace('\ud83d\udcd4', ' :notebook_with_decorative_cover: ');
                message = message.replace('\ud83d\udd29', ' :nut_and_bolt: ');
                message = message.replace('\ud83c\udf62', ' :oden: ');
                message = message.replace('\ud83d\udcc2', ' :open_file_folder: ');
                message = message.replace('\ud83d\udcd9', ' :orange_book: ');
                message = message.replace('\ud83d\udce4', ' :outbox_tray: ');
                message = message.replace('\ud83d\udcc4 ', ' :page_facing_up: ');
                message = message.replace('\ud83d\udcc3', ' :page_with_curl: ');
                message = message.replace('\ud83d\udcdf', ' :pager: ');
                message = message.replace('\ud83d\udcces', ' :paperclip: ');
                message = message.replace('\ud83c\udf51', ' :peach: ');
                message = message.replace('\ud83c\udf50', ' :pear: ');
                message = message.replace('\u270f', ' :pencil: ');
                message = message.replace('\u270f', ' :pencil2: ');
                message = message.replace('\u260e', ' :phone: ');
                message = message.replace('\ud83d\udc8a', ' :pill: ');
                message = message.replace('\ud83c\udf4d', ' :pineapple: ');
                message = message.replace('\ud83c\udf55', ' :pizza: ');
                message = message.replace('\ud83d\udcef', ' :postal_horn: ');
                message = message.replace('\ud83d\udcee', ' :postbox: ');
                message = message.replace('\ud83d\udc5d', ' :pouch: ');
                message = message.replace('\ud83c\udf57', ' :poultry_leg: ');
                message = message.replace('\ud83d\udcb7', ' :pound: ');
                message = message.replace('\ud83d\udc5b', ' :purse: ');
                message = message.replace('\ud83d\udccc', ' :pushpin: ');
                message = message.replace('\ud83d\udcfb ', ' :radio: ');
                message = message.replace('\ud83c\udf5c', ' :ramen: ');
                message = message.replace('\ud83c\udf80', ' :ribbon: ');
                message = message.replace('\ud83c\udf5a', ' :rice: ');
                message = message.replace('\ud83c\udf59', ' :rice_ball: ');
                message = message.replace('\ud83c\udf58', ' :rice_cracker: ');
                message = message.replace('\ud83c\udf91', ' :rice_scene: ');
                message = message.replace('\ud83d\udc8d', ' :ring: ');
                message = message.replace('\ud83c\udfc9', ' :rugby_football: ');
                message = message.replace('\ud83c\udfbd', ' :running_sirt_with_sash: ');
                message = message.replace('\ud83c\udf76', ' :sake: ');
                message = message.replace('\ud83d\udc61', ' :sandal: ');
                message = message.replace('\ud83c\udf85', ' :santa: ');
                message = message.replace('\ud83d\udce1', ' :satellite: ');
                message = message.replace('\ud83c\udfb7', ' :saxophone: ');
                message = message.replace('\ud83c\udf92', ' :school_satchel: ');
                message = message.replace('\u2702', ' :scissors: ');
                message = message.replace('\ud83d\udcdc', ' :scroll: ');
                message = message.replace('\ud83d\udcba', ' :seat: ');
                message = message.replace('\ud83c\udf67', ' :shaved_ice: ');
                message = message.replace('\ud83d\udc55', ' :shirt: ');
                message = message.replace('\ud83d\udc5f', ' :shoe: ');
                message = message.replace('\ud83d\udebf', ' :shower: ');
                message = message.replace('\ud83c\udfbf', ' :ski: ');
                message = message.replace('\ud83d\udeac', ' :smoking: ');
                message = message.replace('\ud83c\udfc2', ' :snowboarder: ');
                message = message.replace('\u26bd', ' :soccer: ');
                message = message.replace('\ud83d\udd09', ' :sound: ');
                message = message.replace('\ud83d\udc7e', ' :space_invader: ');
                message = message.replace('\u2660', ' :spades: ');
                message = message.replace('\ud83c\udf5d', ' :spaghetti: ');
                message = message.replace('\ud83c\udf87', ' :sparkler: ');
                message = message.replace('\ud83d\udd0a', ' :speaker: ');
                message = message.replace('\ud83c\udf72', ' :stew: ');
                message = message.replace('\ud83d\udccf', ' :straight_ruler: ');
                message = message.replace('\ud83c\udf53', ' :strawberry: ');
                message = message.replace('\ud83c\udfc4', ' :surfer: ');
                message = message.replace('\ud83c\udf63', ' :sushi: ');
                message = message.replace('\ud83c\udf60', ' :sweet_potato: ');
                message = message.replace('\ud83c\udfca', ' :swimmer: ');
                message = message.replace('\ud83d\udc89', ' :syringe: ');
                message = message.replace('\ud83c\udf89', ' :tada: ');
                message = message.replace('\ud83c\udf8b', ' :tanabata_tree:');
                message = message.replace('\ud83c\udf4a', ' :tangerine: ');
                message = message.replace('\ud83c\udf75', ' :tea: ');
                message = message.replace('\u260e', ' :telephone: ');
                message = message.replace('\ud83d\udcde', ' :telephone_receiver: ');
                message = message.replace('\ud83d\udd2d', ' :telescope: ');
                message = message.replace('\ud83c\udfbe', ' :tennis: ');
                message = message.replace('\ud83d\udebd', ' :toilet: ');
                message = message.replace('\ud83c\udf45', ' :tomato: ');
                message = message.replace('\ud83c\udfa9', ' :tophat: ');
                message = message.replace('\ud83d\udcd0', ' :triangular_ruler: ');
                message = message.replace('\ud83c\udfc6', ' :trophy: ');
                message = message.replace('\ud83c\udf79', ' :tropical_drink: ');
                message = message.replace('\ud83c\udfba', ' :trumpet: ');
                message = message.replace('\ud83d\udc55', ' :tshirt: ');
                message = message.replace('\ud83d\udcfa', ' :tv: ');
                message = message.replace('\ud83d\udd13', ' :unlock: ');
                message = message.replace('\ud83d\udcfc', ' :vhs: ');
                message = message.replace('\ud83d\udcf9', ' :video_camera: ');
                message = message.replace('\ud83c\udfae', ' :video_game: ');
                message = message.replace('\ud83c\udfbb', ' :violin: ');
                message = message.replace('\u231a', ' :watch: ');
                message = message.replace('\ud83c\udf49', ' :watermelon: ');
                message = message.replace('\ud83c\udf90', ' :wind_chime: ');
                message = message.replace('\ud83c\udf77', ' :wine_glass: ');
                message = message.replace('\ud83d\udc5a', ' :womans_clothes: ');
                message = message.replace('\ud83d\udc52', ' :womans_hat: ');
                message = message.replace('\ud83d\udd27', ' :wrench: ');
                message = message.replace('\ud83d\udcb4', ' :yen: ');
                message = message.replace('\ud83d\udc1c', ' :ant: ');
                message = message.replace('\ud83d\udc24', ' :baby_chick: ');
                message = message.replace('\ud83d\udc3b', ' :bear: ');
                message = message.replace('\ud83d\udc1e', ' :beetle: ');
                message = message.replace('\ud83d\udc26', ' :bird: ');
                message = message.replace('\ud83c\udf3c', ' :blossom: ');
                message = message.replace('\ud83d\udc21', ' :blowfish: ');
                message = message.replace('\ud83d\udc17', ' :boar: ');
                message = message.replace('\ud83d\udc90', ' :bouquet: ');
                message = message.replace('\ud83d\udc1b', ' :bug: ');
                message = message.replace('\ud83c\udf35', ' :cactus: ');
                message = message.replace('\ud83d\udc2b', ' :camel: ');
                message = message.replace('\ud83d\udc31', ' :cat: ');
                message = message.replace('\ud83d\udc08', ' :cat2: ');
                message = message.replace('\ud83c\udf38', ' :cherry_blossom: ');
                message = message.replace('\ud83c\udf30', ' :chestnut: ');
                message = message.replace('\ud83d\udc14', ' :chicken: ');
                message = message.replace('\u2601', ' :cloud: ');
                message = message.replace('\ud83d\udc2e', ' :cow: ');
                message = message.replace('\ud83d\udc04', ' :cow2: ');
                message = message.replace('\ud83d\udc0a', ' :crocodile: ');
                message = message.replace('\ud83c\udf00', ' :cyclone: ');
                message = message.replace('\ud83c\udf33', ' :deciduous_tree: ');
                message = message.replace('\ud83d\udc36', ' :dog: ');
                message = message.replace('\ud83d\udc15', ' :dog2: ');
                message = message.replace('\ud83d\udc2c', ' :dolphin: ');
                message = message.replace('\ud83d\udc09', ' :dragon: ');
                message = message.replace('\ud83d\udc32', ' :dragon_face: ');
                message = message.replace('\ud83d\udc2a', ' :dromedary_camel:');
                message = message.replace('\ud83c\udf3e', ' :ear_of_rice: ');
                message = message.replace('\ud83c\udf0d', ' :earth_africa: ');
                message = message.replace('\ud83c\udf0e', ' :earth_americas: ');
                message = message.replace('\ud83c\udf0f', ' :earth_asia: ');
                message = message.replace('\ud83d\udc18', ' :elephant: ');
                message = message.replace('\ud83c\udf32', ' :evergreen_tree: ');
                message = message.replace('\ud83c\udf42', ' :fallen_leaf: ');
                message = message.replace('\ud83c\udf13', ' :first_quarter_moon: ');
                message = message.replace('\ud83c\udf1b', ' :first_quarter_moon_with_face: ');
                message = message.replace('\ud83d\udc1f', ' :fish: ');
                message = message.replace('\ud83c\udf01', ' :foggy: ');
                message = message.replace('\ud83c\udf40', ' :four_leaf_clover: ');
                message = message.replace('\ud83d\udc38', ' :frog: ');
                message = message.replace('\ud83c\udf15', ' :full_moon: ');
                message = message.replace('\ud83c\udf1d', ' :full_moon_with_face: ');
                message = message.replace('\ud83c\udf10', ' :globe_with_meridians: ');
                message = message.replace('\ud83d\udc10', ' :goat: ');
                message = message.replace('\ud83d\udc39', ' :hamster: ');
                message = message.replace('\ud83d\udc25', ' :hatched_chick: ');
                message = message.replace('\ud83d\udc23', ' :hatching_chick: ');
                message = message.replace('\ud83c\udf3f', ' :herb: ');
                message = message.replace('\ud83c\udf3a', ' :hibiscus: ');
                message = message.replace('\ud83d\udc1d', ' :honeybee: ');
                message = message.replace('\ud83d\udc34', ' :horse: ');
                message = message.replace('\ud83d\udc28', ' :koala: ');
                message = message.replace('\ud83c\udf17', ' :last_quarter_moon: ');
                message = message.replace('\ud83c\udf1c', ' :last_quarter_moon_with_face: ');
                message = message.replace('\ud83c\udf43', ' :leaves: ');
                message = message.replace('\ud83d\udc06', ' :leopard: ');
                message = message.replace('\ud83c\udf41', ' :maple_leaf: ');
                message = message.replace('\ud83c\udf0c', ' :milky_way: ');
                message = message.replace('\ud83d\udc12', ' :monkey: ');
                message = message.replace('\ud83d\udc35', ' :monkey_face: ');
                message = message.replace('\ud83c\udf19', ' :moon: ');
                message = message.replace('\ud83d\udc2d', ' :mouse: ');
                message = message.replace('\ud83d\udc01', ' :mouse2: ');
                message = message.replace('\ud83c\udf44', ' :mushroom:');
                message = message.replace('\ud83c\udf11', ' :new_moon: ');
                message = message.replace('\ud83c\udf1a', ' :new_moon_with_face: ');
                message = message.replace('\ud83c\udf0a', ' :ocean: ');
                message = message.replace('\ud83d\udc7f', ' :octocat: ');
                message = message.replace('\ud83d\udc19', ' :octopus: ');
                message = message.replace('\ud83d\udc02', ' :ox: ');
                message = message.replace('\ud83c\udf34', ' :palm_tree: ');
                message = message.replace('\ud83d\udc3c', ' :panda_face: ');
                message = message.replace('\u26c5', ' :partly_sunny: ');
                message = message.replace('\ud83d\udc3e', ' :paw_prints: ');
                message = message.replace('\ud83d\udc27', ' :penguin: ');
                message = message.replace('\ud83d\udc37', ' :pig: ');
                message = message.replace('\ud83d\udc16', ' :pig2: ');
                message = message.replace('\ud83d\udc3d', ' :pig_nose: ');
                message = message.replace('\ud83d\udc29', ' :poodle: ');
                message = message.replace('\ud83d\udc30', ' :rabbit: ');
                message = message.replace('\ud83d\udc07', ' :rabbit2: ');
                message = message.replace('\ud83d\udc0e', ' :racehorse: ');
                message = message.replace('\ud83d\udc0f', ' :ram: ');
                message = message.replace('\ud83d\udc00', ' :rat: ');
                message = message.replace('\ud83d\udc13', ' :rooster: ');
                message = message.replace('\ud83c\udf39', ' :rose: ');
                message = message.replace('\ud83c\udf31', ' :seedling: ');
                message = message.replace('\ud83d\udc11', ' :sheep: ');
                message = message.replace('\ud83d\udc1a', ' :shell: ');
                message = message.replace('\ud83d\udc0c', ' :snail: ');
                message = message.replace('\ud83d\udc0d', ' :snake: ');
                message = message.replace('\u2744', ' :snowflake: ');
                message = message.replace('\u26c4', ' :snowman: ');
                message = message.replace(':squirrel:', ' :squirrel: ');
                message = message.replace('\ud83c\udf1e', ' :sun_with_face: ');
                message = message.replace('\ud83c\udf3b', ' :sunflower: ');
                message = message.replace('\u2600', ' :sunny: ');
                message = message.replace('\ud83d\udc2f', ' :tiger: ');
                message = message.replace('\ud83d\udc05', ' :tiger2: ');
                message = message.replace('\ud83d\udc20', ' :tropical_fish: ');
                message = message.replace('\ud83c\udf37', ' :tulip: ');
                message = message.replace('\ud83d\udc22', ' :turtle: ');
                message = message.replace('\u2614', ' :umbrella: ');
                message = message.replace('\ud83c\udf0b', ' :volcano: ');
                message = message.replace('\ud83c\udf18', ' :waning_crescent_moon: ');
                message = message.replace('\ud83c\udf16', ' :waning_gibbous_moon: ');
                message = message.replace('\ud83d\udc03', ' :water_buffalo: ');
                message = message.replace('\ud83c\udf12', ' :waxing_crescent_moon: ');
                message = message.replace('\ud83c\udf14', ' :waxing_gibbous_moon: ');
                message = message.replace('\ud83d\udc33', ' :whale: ');
                message = message.replace('\ud83d\udc0b', ' :whale2: ');
                message = message.replace('\ud83d\udc3a', ' :wolf: ');
                message = message.replace('\u26a1', ' :zap: ');
                return message;
            }
        };
    })();
})(jqcc);
$(function(){
    $.extend($.expr[":"], {
        "containsIgnoreCase": function(elem, i, match, array) {
            return (elem.textContent || elem.innerText || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
        }
    });
    setInterval(function(){
        $('span.notifier').each(function(){
            if($(this).html()==0){
                $(this).css('display', 'none');
            }else{
                $(this).css('display', 'block');
            }
        });
    }, 100);
});

 <?php
 if($enableType == 0 ||  $enableType == 2){
    include_once(dirname(__FILE__).DIRECTORY_SEPARATOR."js".DIRECTORY_SEPARATOR."chat.js");
 }
 if($enableType == 0 ||  $enableType == 1){
    include_once(dirname(__FILE__).DIRECTORY_SEPARATOR."js".DIRECTORY_SEPARATOR."chatrooms.js");
 }
 ?>