var Debug={write:function(text){if(jsDebug&&!Object.isUndefined(window.console)){console.log(text);}},dir:function(values){if(jsDebug&&!Object.isUndefined(window.console)&&!Prototype.Browser.IE){console.dir(values);}},error:function(text){if(jsDebug&&!Object.isUndefined(window.console)){console.error(text);}},warn:function(text){if(jsDebug&&!Object.isUndefined(window.console)){console.warn(text);}},info:function(text){if(jsDebug&&!Object.isUndefined(window.console)){console.info(text);}}};Event.observe(window,'load',function(e){Element.Methods.getOffsetParent=function(element){if(element.offsetParent&&element.offsetParent!=document.body)return $(element.offsetParent);if(element==document.body)return $(element);while((element=element.parentNode)&&element!=document.body)
if(Element.getStyle(element,'position')!='static')
return $(element);return $(document.body);};});function _getOffsetParent(element)
{if(element.offsetParent&&element.offsetParent!=document.body)return $(element.offsetParent);if(element==document.body)return $(element);while((element=element.parentNode)&&element!=document.body)
if(Element.getStyle(element,'position')!='static')
return $(element);return $(document.body);}
Prototype.Browser.IE6=Prototype.Browser.IE&&parseInt(navigator.userAgent.substring(navigator.userAgent.indexOf("MSIE")+5))==6;Prototype.Browser.IE7=Prototype.Browser.IE&&parseInt(navigator.userAgent.substring(navigator.userAgent.indexOf("MSIE")+5))==7;Prototype.Browser.IE8=Prototype.Browser.IE&&!Prototype.Browser.IE6&&!Prototype.Browser.IE7;Prototype.Browser.Chrome=Prototype.Browser.WebKit&&(navigator.userAgent.indexOf('Chrome/')>-1);window.IPBoard=Class.create({namePops:[],topicPops:[],vars:[],lang:[],templates:[],editors:$A(),notifications:null,initDone:false,initialize:function()
{Debug.write("IPBjs is loading...");document.observe("dom:loaded",function(){this.Cookie.init();Ajax.Responders.register({onLoading:function(){if(!$('ajax_loading'))
{if(!ipb.templates['ajax_loading']){return;}
$('ipboard_body').insert(ipb.templates['ajax_loading']);}
var effect=new Effect.Appear($('ajax_loading'),{duration:0.2});},onComplete:function(){if(!$('ajax_loading')){return;}
var effect=new Effect.Fade($('ajax_loading'),{duration:0.2});if(!Object.isUndefined(ipb.hoverCard))
{ipb.hoverCardRegister.postAjaxInit();}},onSuccess:function(){if(!Object.isUndefined(ipb.hoverCard))
{ipb.hoverCardRegister.postAjaxInit();}}});ipb.delegate.initialize();ipb.initDone=true;if($('user_notifications_link'))
{$('user_notifications_link').observe('click',ipb.getNotifications);}}.bind(this));},positionCenter:function(elem,dir)
{if(!$(elem)){return;}
elem_s=$(elem).getDimensions();window_s=document.viewport.getDimensions();window_offsets=document.viewport.getScrollOffsets();center={left:((window_s['width']-elem_s['width'])/2),top:((window_s['height']-elem_s['height'])/2)};if(typeof(dir)=='undefined'||(dir!='h'&&dir!='v'))
{$(elem).setStyle('top: '+center['top']+'px; left: '+center['left']+'px');}
else if(dir=='h')
{$(elem).setStyle('left: '+center['left']+'px');}
else if(dir=='v')
{$(elem).setStyle('top: '+center['top']+'px');}
$(elem).setStyle('position: fixed');},showModal:function()
{if(!$('ipb_modal'))
{this.createModal();}
this.modal.show();},hideModal:function()
{if(!$('ipb_modal')){return;}
this.modal.hide();},createModal:function()
{this.modal=new Element('div',{id:'ipb_modal'}).hide().addClassName('modal');this.modal.setStyle("width: 100%; height: 100%; position: absolute; top: 0px; left: 0px; overflow: hidden; z-index: 1000; opacity: 0.2");$('ipboard_body').insert({bottom:this.modal});},alert:function(message)
{if(!$('ipb_alert'))
{this.createAlert();}
this.showModal();$('ipb_alert_message').update(message);},createAlert:function()
{wrapper=new Element('div',{id:'ipb_alert'});icon=new Element('div',{id:'ipb_alert_icon'});message=new Element('div',{id:'ipb_alert_message'});ok_button=new Element('input',{'type':'button','value':"OK",id:'ipb_alert_ok'});cancel_button=new Element('input',{'type':'button','value':"Cancel",id:'ipb_alert_cancel'});wrapper.insert({bottom:icon}).insert({bottom:message}).insert({bottom:ok_button}).insert({bottom:cancel_button}).setStyle('z-index: 1001');$('ipboard_body').insert({bottom:wrapper});this.positionCenter(wrapper,'h');},editorInsert:function(content,editorid)
{if(!editorid){Debug.dir(ipb.editors);var editor=$A(ipb.editors).first();Debug.write(editor);}else{var editor=ipb.editors[editorid];}
if(Object.isUndefined(editor))
{Debug.error("Can't find any suitable editor");return;}
editor.insert_text(content);editor.editor_check_focus();},getNotifications:function(e)
{if(!ipb.notifications)
{var url=ipb.vars['base_url']+'app=core&module=ajax&section=notifications&do=getlatest';new Ajax.Request(url,{method:'post',evalJSON:'force',parameters:{secure_key:ipb.vars['secure_hash']},onSuccess:function(t)
{if(t.responseJSON['error'])
{alert(t.responseJSON['error']);}
else
{ipb.notifications=true;$('user_notifications_link').addClassName('ipbmenu');$('ipboard_body').insert(t.responseJSON['html']);var _newMenu=new ipb.Menu($('user_notifications_link'),$("user_notifications_link_menucontent"));_newMenu.doOpen();}}});}
Event.stop(e);return false;}});IPBoard.prototype.delegate={store:$A(),initialize:function()
{document.observe('click',function(e){if(Event.isLeftClick(e)||Prototype.Browser.IE)
{var elem=null;var handler=null;var target=ipb.delegate.store.find(function(item){elem=e.findElement(item['selector']);if(elem){handler=item;return true;}else{return false;}});if(!Object.isUndefined(target))
{if(handler)
{Debug.write("Firing callback for selector "+handler['selector']);handler['callback'](e,elem,handler['params']);}}}});},register:function(selector,callback,params)
{ipb.delegate.store.push({selector:selector,callback:callback,params:params});}};IPBoard.prototype.Cookie={store:[],initDone:false,set:function(name,value,sticky)
{var expires='';var path='/';var domain='';if(!name)
{return;}
if(sticky)
{if(sticky==1)
{expires="; expires=Wed, 1 Jan 2020 00:00:00 GMT";}
else if(sticky==-1)
{expires="; expires=Thu, 01-Jan-1970 00:00:01 GMT";}
else if(sticky.length>10)
{expires="; expires="+sticky;}}
if(ipb.vars['cookie_domain'])
{domain="; domain="+ipb.vars['cookie_domain'];}
if(ipb.vars['cookie_path'])
{path=ipb.vars['cookie_path'];}
document.cookie=ipb.vars['cookie_id']+name+"="+escape(value)+"; path="+path+expires+domain+';';ipb.Cookie.store[name]=value;Debug.write("Set cookie: "+ipb.vars['cookie_id']+name+"="+value+"; path="+path+expires+domain+';');},get:function(name)
{if(ipb.Cookie.initDone!==true)
{ipb.Cookie.init();}
if(ipb.Cookie.store[name])
{return ipb.Cookie.store[name];}
return'';},doDelete:function(name)
{Debug.write("Deleting cookie "+name);ipb.Cookie.set(name,'',-1);},init:function()
{if(ipb.Cookie.initDone)
{return true;}
skip=['session_id','ipb_admin_session_id','member_id','pass_hash'];cookies=$H(document.cookie.replace(" ",'').toQueryParams(";"));if(cookies)
{cookies.each(function(cookie){cookie[0]=cookie[0].strip();if(ipb.vars['cookie_id']!='')
{if(!cookie[0].startsWith(ipb.vars['cookie_id']))
{return;}
else
{cookie[0]=cookie[0].replace(ipb.vars['cookie_id'],'');}}
if(skip[cookie[0]])
{return;}
else
{ipb.Cookie.store[cookie[0]]=unescape(cookie[1]||'');Debug.write("Loaded cookie: "+cookie[0]+" = "+cookie[1]);}});}
ipb.Cookie.initDone=true;}};IPBoard.prototype.validate={isFilled:function(elem)
{if(!$(elem)){return null;}
return!$F(elem).blank();},isNumeric:function(elem)
{if(!$(elem)){return null;}
return $F(elem).match(/^[\d]+?$/);},isMatching:function(elem1,elem2)
{if(!$(elem1)||!$(elem2)){return null;}
return $F(elem1)==$F(elem2);},email:function(elem)
{if(!$(elem)){return null;}
if($F(elem).match(/^.+@.+\..{2,4}$/)){return true;}else{return false;}}};IPBoard.prototype.Autocomplete=Class.create({initialize:function(id,options)
{this.id=$(id).id;this.timer=null;this.last_string='';this.internal_cache=$H();this.pointer=0;this.items=$A();this.observing=true;this.objHasFocus=null;this.options=Object.extend({min_chars:3,multibox:false,global_cache:false,classname:'ipb_autocomplete',templates:{wrap:new Template("<ul id='#{id}'></ul>"),item:new Template("<li id='#{id}'>#{itemvalue}</li>")}},arguments[1]||{});if(!$(this.id)){Debug.error("Invalid textbox ID");return false;}
this.obj=$(this.id);if(!this.options.url)
{Debug.error("No URL specified for autocomplete");return false;}
$(this.obj).writeAttribute('autocomplete','off');this.buildList();$(this.obj).observe('focus',this.timerEventFocus.bindAsEventListener(this));$(this.obj).observe('blur',this.timerEventBlur.bindAsEventListener(this));$(this.obj).observe('keypress',this.eventKeypress.bindAsEventListener(this));},eventKeypress:function(e)
{if(![Event.KEY_TAB,Event.KEY_UP,Event.KEY_DOWN,Event.KEY_LEFT,Event.KEY_RIGHT,Event.KEY_RETURN].include(e.keyCode)){return;}
if($(this.list).visible())
{switch(e.keyCode)
{case Event.KEY_TAB:case Event.KEY_RETURN:this.selectCurrentItem(e);break;case Event.KEY_UP:case Event.KEY_LEFT:this.selectPreviousItem(e);break;case Event.KEY_DOWN:case Event.KEY_RIGHT:this.selectNextItem(e);break;}
Event.stop(e);}},selectCurrentItem:function(e)
{var current=$(this.list).down('.active');this.unselectAll();if(!Object.isUndefined(current))
{var itemid=$(current).id.replace(this.id+'_ac_item_','');if(!itemid){return;}
var value=this.items[itemid].replace('&amp;','&').replace(/&#39;/g,"'");if(this.options.multibox)
{if($F(this.obj).indexOf(',')!==-1)
{var pieces=$F(this.obj).split(',');pieces[pieces.length-1]='';$(this.obj).value=pieces.join(',')+' ';}
else
{$(this.obj).value='';}
$(this.obj).value=$F(this.obj)+value+', ';}
else
{$(this.obj).value=value;var effect=new Effect.Fade($(this.list),{duration:0.3});this.observing=false;}}
$(this.obj).focus();},selectThisItem:function(e)
{this.unselectAll();var items=$(this.list).immediateDescendants();var elem=Event.element(e);while(!items.include(elem))
{elem=elem.up();}
$(elem).addClassName('active');},selectPreviousItem:function(e)
{var current=$(this.list).down('.active');this.unselectAll();if(Object.isUndefined(current))
{this.selectFirstItem();}
else
{var prev=$(current).previous();if(prev){$(prev).addClassName('active');}
else
{this.selectLastItem();}}},selectNextItem:function(e)
{var current=$(this.list).down('.active');this.unselectAll();if(Object.isUndefined(current)){this.selectFirstItem();}
else
{var next=$(current).next();if(next){$(next).addClassName('active');}
else
{this.selectFirstItem();}}},selectFirstItem:function()
{if(!$(this.list).visible()){return;}
this.unselectAll();$(this.list).firstDescendant().addClassName('active');},selectLastItem:function()
{if(!$(this.list).visible()){return;}
this.unselectAll();var d=$(this.list).immediateDescendants();var l=d[d.length-1];if(l)
{$(l).addClassName('active');}},unselectAll:function()
{$(this.list).childElements().invoke('removeClassName','active');},timerEventBlur:function(e)
{window.clearTimeout(this.timer);this.eventBlur.bind(this).delay(0.6,e);},timerEventFocus:function(e)
{this.timer=this.eventFocus.bind(this).delay(0.4,e);},eventBlur:function(e)
{this.objHasFocus=false;if($(this.list).visible())
{var effect=new Effect.Fade($(this.list),{duration:0.3});}},eventFocus:function(e)
{if(!this.observing){return;}
this.objHasFocus=true;this.timer=this.eventFocus.bind(this).delay(0.6,e);var curValue=this.getCurrentName();if(curValue==this.last_string){return;}
if(curValue.length<this.options.min_chars){if($(this.list).visible())
{var effect=new Effect.Fade($(this.list),{duration:0.3,afterFinish:function(){$(this.list).update();}.bind(this)});}
return;}
this.last_string=curValue;json=this.cacheRead(curValue);if(json==false){var request=new Ajax.Request(this.options.url+escape(curValue),{method:'get',evalJSON:'force',onSuccess:function(t)
{if(Object.isUndefined(t.responseJSON))
{Debug.error("Invalid response returned from the server");return;}
if(t.responseJSON['error'])
{switch(t.responseJSON['error'])
{case'requestTooShort':Debug.warn("Server said request was too short, skipping...");break;default:Debug.error("Server returned an error: "+t.responseJSON['error']);break;}
return false;}
if(t.responseText!="[]")
{this.cacheWrite(curValue,t.responseJSON);this.updateAndShow(t.responseText.evalJSON());}}.bind(this)});}
else
{this.updateAndShow(json);}},updateAndShow:function(json)
{if(!json){return;}
this.updateList(json);if(!$(this.list).visible()&&this.objHasFocus)
{Debug.write("Showing");var effect=new Effect.Appear($(this.list),{duration:0.3,afterFinish:function(){this.selectFirstItem();}.bind(this)});}},cacheRead:function(value)
{if(this.options.global_cache!=false)
{if(!Object.isUndefined(this.options.global_cache.get(value))){Debug.write("Read from global cache");return this.options.global_cache.get(value);}}
else
{if(!Object.isUndefined(this.internal_cache.get(value))){Debug.write("Read from internal cache");return this.internal_cache.get(value);}}
return false;},cacheWrite:function(key,value)
{if(this.options.global_cache!==false){this.options.global_cache[key]=value;}else{this.internal_cache[key]=value;}
return true;},getCurrentName:function()
{if(this.options.multibox)
{if($F(this.obj).indexOf(',')===-1){return $F(this.obj).strip();}
else
{var pieces=$F(this.obj).split(',');var lastPiece=pieces[pieces.length-1];return lastPiece.strip();}}
else
{return $F(this.obj).strip();}},buildList:function()
{if($(this.id+'_ac'))
{return;}
var ul=this.options.templates.wrap.evaluate({id:this.id+'_ac'});$$('body')[0].insert({bottom:ul});var finalPos={};var sourcePos=$(this.id).viewportOffset();var sourceDim=$(this.id).getDimensions();var delta=[0,0];var parent=null;var screenScroll=document.viewport.getScrollOffsets();if(Element.getStyle($(this.id),'position')=='absolute')
{parent=element.getOffsetParent();delta=parent.viewportOffset();}
finalPos['left']=sourcePos[0]-delta[0];finalPos['top']=sourcePos[1]-delta[1]+screenScroll.top;finalPos['top']=finalPos['top']+sourceDim.height;$(this.id+'_ac').setStyle('position: absolute; top: '+finalPos['top']+'px; left: '+finalPos['left']+'px;').hide();this.list=$(this.id+'_ac');},updateList:function(json)
{if(!json||!$(this.list)){return;}
var newitems='';this.items=$A();json=$H(json);json.each(function(item)
{var li=this.options.templates.item.evaluate({id:this.id+'_ac_item_'+item.key,itemid:item.key,itemvalue:item.value['showas']||item.value['name'],img:item.value['img']||'',img_w:item.value['img_w']||'',img_h:item.value['img_h']||''});this.items[item.key]=item.value['name'];newitems=newitems+li;}.bind(this));$(this.list).update(newitems);$(this.list).immediateDescendants().each(function(elem){$(elem).observe('mouseover',this.selectThisItem.bindAsEventListener(this));$(elem).observe('click',this.selectCurrentItem.bindAsEventListener(this));$(elem).setStyle('cursor: pointer');}.bind(this));if($(this.list).visible())
{this.selectFirstItem();}}});IPBoard.prototype.editor_values=$H({'templates':$A(),'colors_perrow':8,'colors':['000000','A0522D','556B2F','006400','483D8B','000080','4B0082','2F4F4F','8B0000','FF8C00','808000','008000','008080','0000FF','708090','696969','FF0000','F4A460','9ACD32','2E8B57','48D1CC','4169E1','800080','808080','FF00FF','FFA500','FFFF00','00FF00','00FFFF','00BFFF','9932CC','C0C0C0','FFC0CB','F5DEB3','FFFACD','98FB98','AFEEEE','ADD8E6','DDA0DD','FFFFFF'],'primary_fonts':$H({arial:"Arial",arialblack:"Arial Black",arialnarrow:"Arial Narrow",bookantiqua:"Book Antiqua",centurygothic:"Century Gothic",comicsansms:"Comic Sans MS",couriernew:"Courier New",franklingothicmedium:"Franklin Gothic Medium",garamond:"Garamond",georgia:"Georgia",impact:"Impact",lucidaconsole:"Lucida Console",lucidasansunicode:"Lucida Sans Unicode",microsoftsansserif:"Microsoft Sans Serif",palatinolinotype:"Palatino Linotype",tahoma:"Tahoma",timesnewroman:"Times New Roman",trebuchetms:"Trebuchet MS",verdana:"Verdana"}),'font_sizes':$A([1,2,3,4,5,6,7])});Object.extend(RegExp,{escape:function(text)
{if(!arguments.callee.sRE)
{var specials=['/','.','*','+','?','|','(',')','[',']','{','}','\\','$'];arguments.callee.sRE=new RegExp('(\\'+specials.join('|\\')+')','g');}
return text.replace(arguments.callee.sRE,'\\$1');}});String.prototype.encodeUrl=function()
{text=this;var regcheck=text.match(/[\x90-\xFF]/g);if(regcheck)
{for(var i=0;i<regcheck.length;i++)
{text=text.replace(regcheck[i],'%u00'+(regcheck[i].charCodeAt(0)&0xFF).toString(16).toUpperCase());}}
return escape(text).replace(/\+/g,"%2B").replace(/%20/g,'+').replace(/\*/g,'%2A').replace(/\//g,'%2F').replace(/@/g,'%40');};String.prototype.encodeParam=function()
{text=this;var regcheck=text.match(/[\x90-\xFF]/g);if(regcheck)
{for(var i=0;i<regcheck.length;i++)
{text=text.replace(regcheck[i],'%u00'+(regcheck[i].charCodeAt(0)&0xFF).toString(16).toUpperCase());}}
return escape(text).replace(/\+/g,"%2B");};Date.prototype.getDST=function()
{var beginning=new Date("January 1, 2008");var middle=new Date("July 1, 2008");var difference=middle.getTimezoneOffset()-beginning.getTimezoneOffset();var offset=this.getTimezoneOffset()-beginning.getTimezoneOffset();if(difference!=0)
{return(difference==offset)?1:0;}
else
{return 0;}};var Loader={require:function(name)
{document.write("<script type='text/javascript' src='"+name+".js'></script>");},boot:function()
{$A(document.getElementsByTagName("script")).findAll(function(s)
{return(s.src&&s.src.match(/ipb\.js(\?.*)?$/));}).each(function(s){var path=s.src.replace(/ipb\.js(\?.*)?$/,'');var includes=s.src.match(/\?.*load=([a-z0-9_,]*)/);if(!Object.isUndefined(includes)&&includes!=null&&includes[1])
{includes[1].split(',').each(function(include)
{if(include)
{Loader.require(path+"ips."+include);}});}});}};var _global=window.IPBoard;_global.prototype.global={searchTimer:[],searchLastQuery:'',rssItems:[],reputation:{},ac_cache:$H(),pageJumps:$H(),pageJumpMenus:$H(),boardMarkers:$H(),searchResults:$H(),tidPopOpen:0,activeTab:'forums',userCards:null,init:function()
{Debug.write("Initializing ips.global.js");document.observe("dom:loaded",function(){ipb.global.initEvents();});},initEvents:function()
{ipb.delegate.register(".__user",ipb.global.userPopup);ipb.delegate.register(".warn_link",ipb.global.displayWarnLogs);ipb.delegate.register(".mini_friend_toggle",ipb.global.toggleFriend);$$('.__topic').each(function(i){$(i).observe('mouseover',function(e){ipb.global.topicPreviewShowIcon(e);});$(i).observe('mouseout',function(e){ipb.global.topicPreviewHideIcon(e);});ipb.global.topicPreviewSetUp(i);});if($('rss_feed')){ipb.global.buildRSSmenu();}
if($('newSkin')||$('newLang')){ipb.global.setUpSkinLang();}
if($('pm_notification'))
{var _vph=document.viewport.getDimensions().height-275;$('pm_notify_excerpt').setStyle('max-height:'+_vph+'px; width:95%');new Effect.Parallel([new Effect.Appear($('pm_notification')),new Effect.BlindDown($('pm_notification'))],{duration:0.5});if($('close_pm_notification')){$('close_pm_notification').observe('click',ipb.global.closePMpopup);}
if($('ack_pm_notification')){$('ack_pm_notification').observe('click',ipb.global.markReadPMpopup);}
if($('notification_go_forward'))
{$('notification_go_forward').observe('click',ipb.global.getNextNotification);}
if($('notification_go_back'))
{$('notification_go_back').observe('click',ipb.global.getPreviousNotification);}}
if($('backtotop'))
{$('backtotop').observe("click",function(e){Event.stop(e);window.scroll(0,0);});}
if($('sign_in'))
{wrapper=$('sign_in').down('.services');if(wrapper)
{wrapper.select('img').each(function(i){var _a=i.src.replace(/^.*loginmethods\/(\S+?)\.(png|gif).*$/,'$1');if(_a=='windows')
{_a='live';}
i.observe('click',function(e){Event.stop(e);window.location=ipb.vars['base_url']+'app=core&module=global&section=login&serviceClick='+_a;});});}}
ipb.global.buildPageJumps();ipb.delegate.register('.bbc_spoiler_show',ipb.global.toggleSpoiler);ipb.delegate.register('a[rel~="external"]',ipb.global.openNewWindow);ipb.global.initUserCards();},initUserCards:function()
{if(!Object.isUndefined(ipb.hoverCard))
{var ajaxUrl=ipb.vars['base_url']+'&app=members&module=ajax&secure_key='+ipb.vars['secure_hash']+'&section=card';ipb.hoverCardRegister.initialize('member',{'w':'400px','delay':750,'position':'auto','ajaxUrl':ajaxUrl,'getId':true,'setIdParam':'mid'});}},getNextNotification:function(e)
{var _currentId=$('pm_notification').readAttribute('rel');var url=ipb.vars['base_url']+"app=core&section=notifications&module=ajax&do=getNextNotification&last="+_currentId+"&md5check="+ipb.vars['secure_hash'];new Ajax.Request(url,{method:'get',evalJSON:'force',onSuccess:function(t)
{if(t.responseJSON['error'])
{alert(t.responseJSON['error']);}
else
{$('pm_notification').writeAttribute('rel',t.responseJSON['notify_id']);$('pm_date').update(t.responseJSON['notify_date_formatted']);$('pm_notify_title').update(t.responseJSON['notify_title']);$('pm_notify_excerpt').update(t.responseJSON['notify_text']);$('view_pm_notification').writeAttribute('href',t.responseJSON['notify_url']);$('ack_pm_notification').writeAttribute('href',$('ack_pm_notification').readAttribute('href').replace(/mark=(\d+)/,'mark='+t.responseJSON['notify_id']));if(!t.responseJSON['has_more'])
{$('notification_go_forward').addClassName('hide');}
else
{$('notification_go_forward').removeClassName('hide');}
if(t.responseJSON['has_previous'])
{$('notification_go_back').removeClassName('hide');}
else
{$('notification_go_back').addClassName('hide');}
var _currentCount=parseInt($('pm-count').innerHTML);$('pm-count').update(_currentCount+1);}}});Event.stop(e);return false;},getPreviousNotification:function(e)
{var _currentId=$('pm_notification').readAttribute('rel');var url=ipb.vars['base_url']+"app=core&section=notifications&module=ajax&do=getLastNotification&last="+_currentId+"&md5check="+ipb.vars['secure_hash'];new Ajax.Request(url,{method:'get',evalJSON:'force',onSuccess:function(t)
{if(t.responseJSON['error'])
{alert(t.responseJSON['error']);}
else
{$('pm_notification').writeAttribute('rel',t.responseJSON['notify_id']);$('pm_date').update(t.responseJSON['notify_date_formatted']);$('pm_notify_title').update(t.responseJSON['notify_title']);$('pm_notify_excerpt').update(t.responseJSON['notify_text']);$('view_pm_notification').writeAttribute('href',$('view_pm_notification').readAttribute('href').replace(/view=(\d+)/,'view='+t.responseJSON['notify_id']));$('ack_pm_notification').writeAttribute('href',$('ack_pm_notification').readAttribute('href').replace(/mark=(\d+)/,'mark='+t.responseJSON['notify_id']));if(!t.responseJSON['has_previous'])
{$('notification_go_forward').addClassName('hide');}
else
{$('notification_go_forward').removeClassName('hide');}
if(t.responseJSON['has_more'])
{$('notification_go_back').removeClassName('hide');}
else
{$('notification_go_back').addClassName('hide');}
var _currentCount=parseInt($('pm-count').innerHTML);$('pm-count').update(_currentCount-1);}}});Event.stop(e);return false;},contextualSearch:function()
{if(!$('search_options')&&!$('search_options_menucontent')){return;}
$('main_search').addClassName('inactive').value=ipb.lang['search_default_value'];$('main_search').observe('focus',function(e){if($('main_search').hasClassName('inactive')){$('main_search').removeClassName('inactive').value="";}});$('search').select('.submit_input').find(function(elem){$(elem).value='';});var update=function(noSelect)
{var checked=$('search_options_menucontent').select('input').find(function(elem){return $(elem).checked;});if(Object.isUndefined(checked)){return;}
$('search_options').update($(checked).up('label').readAttribute('title')||'');if(noSelect!=true){$('main_search').focus();}
return true;};update(true);$('search_options_menucontent').select('input').invoke('observe','click',update);},initTabs:function()
{$$('.tab_toggle').each(function(elem){$(elem).observe('click',ipb.global.changeTabContent);});},changeTabContent:function(e)
{Event.stop(e);elem=Event.findElement(e,'li');if(!elem.hasClassName('tab_toggle')||!elem.id){return;}
ol=elem.up('ol');id=elem.id.replace('tab_link_','');if(!id||id.blank()){return;}
if(!$('tab_content_'+id)){return;}
if(ipb.global.activeTab==id)
{return;}
oldTab=ipb.global.activeTab;ipb.global.activeTab=id;if(!$('tab_'+id))
{ol.select('.tab_toggle').each(function(otherelem){_id=otherelem.id.replace('tab_link_','');if($('tab_content_'+_id))
{$($('tab_content_'+_id)).hide();}});$('tab_content_'+id).show();}
else
{new Effect.Parallel([new Effect.BlindUp($('tab_content_'+oldTab),{sync:true}),new Effect.BlindDown($('tab_content_'+ipb.global.activeTab),{sync:true})],{duration:0.4});}
ol.select('.tab_toggle').each(function(otherelem){$(otherelem).removeClassName('active');});$(elem).addClassName('active');},userPopup:function(e,elem)
{Event.stop(e);var sourceid=elem.identify();var user=$(elem).className.match('__id([0-9]+)');var fid=$(elem).className.match('__fid([0-9]+)');if(user==null||Object.isUndefined(user[1])){Debug.error("Error showing popup");return;}
var popid='popup_'+user[1]+'_user';var _url=ipb.vars['base_url']+'&app=members&module=ajax&secure_key='+ipb.vars['secure_hash']+'&section=card&mid='+user[1];Debug.write(fid);if(fid!=null&&!Object.isUndefined(fid[1])&&fid[1])
{_url+='&f='+fid[1];}
Debug.write(_url);ipb.namePops[user]=new ipb.Popup(popid,{type:'balloon',ajaxURL:_url,stem:true,hideAtStart:false,attach:{target:elem,position:'auto'},w:'400px'});},fetchTid:function(e)
{var elem=Event.element(e);elem.identify();if(!elem.hasClassName('__topic'))
{elem=elem.up('.__topic');}
var id=elem.id;if(!id||!$(id))
{return 0;}
var m=$(id).className.match('__tid([0-9]+)');var tid=m[1];return tid;},topicPreviewSetUp:function(id)
{var m=$(id).className.match('__tid([0-9]+)');var tid=m[1];if(tid&&$('tidPop_'+tid))
{$('tidPop_'+tid).setOpacity(0.3);$('tidPop_'+tid).down('img').observe('mouseover',function(e){ipb.global.topicPreviewMover(e);});$('tidPop_'+tid).down('img').observe('mouseout',function(e){ipb.global.topicPreviewMout(e);});}},topicPreviewShowIcon:function(e)
{tid=ipb.global.fetchTid(e);if(tid)
{if(!ipb.global.tidPopOpen)
{$$('.__tpopup').invoke('hide');}
if($('tidPop_'+tid))
{$('tidPop_'+tid).observe('click',ipb.global.topicPreviewPop);$('tidPop_'+tid).setStyle({'cursor':'pointer'});$('tidPop_'+tid).show();}}},topicPreviewHideIcon:function(e)
{tid=ipb.global.fetchTid(e);if(ipb.global.tidPopOpen>0&&ipb.global.tidPopOpen==tid)
{return;}
if(tid&&$('tidPop_'+tid))
{$('tidPop_'+tid).hide();$('tidPop_'+tid).stopObserving();}},topicPreviewMover:function(e)
{tid=ipb.global.fetchTid(e);if(tid)
{$('tidPop_'+tid).setOpacity(1);}},topicPreviewMout:function(e)
{tid=ipb.global.fetchTid(e);if(ipb.global.tidPopOpen>0&&ipb.global.tidPopOpen==tid)
{return;}
if(tid)
{$('tidPop_'+tid).setOpacity(0.3);}},topicPreviewPop:function(e)
{Event.stop(e);var tid=ipb.global.fetchTid(e);if(ipb.global.tidPopOpen==tid)
{return;}
else if(ipb.global.tidPopOpen>0)
{if($('tid-'+ipb.global.tidPopOpen+'_popup'))
{$$('#tid-'+ipb.global.tidPopOpen+'_popup').each(function(id){id.hide();});$('tidPop_'+ipb.global.tidPopOpen).hide();$('tidPop_'+ipb.global.tidPopOpen).stopObserving();}}
var _url=ipb.vars['base_url']+'&app=forums&module=ajax&secure_key='+ipb.vars['secure_hash']+'&section=topics&do=preview&tid='+tid;if(ipb.global.searchResults[tid])
{_url+='&pid='+ipb.global.searchResults[tid]['pid']+'&searchTerm='+ipb.global.searchResults[tid]['searchterm'];}
ipb.topicPops['tid-'+tid]=new ipb.Popup('tid-'+tid,{type:'balloon',ajaxURL:_url,stem:true,hideAtStart:false,attach:{target:$('tidPop_'+tid),position:'auto'},w:'400px'},{'afterHide':ipb.global.topicPreviewHide});ipb.global.tidPopOpen=tid;},topicPreviewHide:function(e)
{if($('tidPop_'+ipb.global.tidPopOpen))
{$('tidPop_'+ipb.global.tidPopOpen).setOpacity(0.3);}
$$('.__tpopup').invoke('hide');ipb.global.tidPopOpen=0;},displayWarnLogs:function(e,elem)
{mid=elem.id.match('warn_link_([0-9a-z]+)_([0-9]+)')[2];if(Object.isUndefined(mid)){return;}
if(parseInt(mid)==0){return false;}
Event.stop(e);var _url=ipb.vars['base_url']+'&app=members&module=ajax&secure_key='+ipb.vars['secure_hash']+'&section=warn&do=view&mid='+mid;warnLogs=new ipb.Popup('warnLogs',{type:'pane',modal:false,w:'500px',h:'500px',ajaxURL:_url,hideAtStart:false,close:'.cancel'});},toggleFriend:function(e,elem)
{Event.stop(e);var id=$(elem).id.match('friend_(.*)_([0-9]+)');if(Object.isUndefined(id[2])){return;}
var isFriend=($(elem).hasClassName('is_friend'))?1:0;var urlBit=(isFriend)?'remove':'add';var url=ipb.vars['base_url']+"app=members&section=friends&module=ajax&do="+urlBit+"&member_id="+id[2]+"&md5check="+ipb.vars['secure_hash'];new Ajax.Request(url,{method:'get',onSuccess:function(t)
{switch(t.responseText)
{case'pp_friend_timeflood':alert(ipb.lang['cannot_readd_friend']);Event.stop(e);break;case"pp_friend_already":alert(ipb.lang['friend_already']);Event.stop(e);break;case"error":return true;break;default:var newIcon=(isFriend)?ipb.templates['m_add_friend'].evaluate({id:id[2]}):ipb.templates['m_rem_friend'].evaluate({id:id[2]});var friends=$$('.mini_friend_toggle').each(function(fr){if($(fr).id.endsWith('_'+id[2]))
{if(isFriend){$(fr).removeClassName('is_friend').addClassName('is_not_friend').update(newIcon);}else{$(fr).removeClassName('is_not_friend').addClassName('is_friend').update(newIcon);}}});new Effect.Highlight($(elem),{startcolor:ipb.vars['highlight_color']});document.fire('ipb:friendRemoved',{friendID:id[2]});Event.stop(e);break;}}});},toggleFlagSpammer:function(memberId,flagStatus)
{if(flagStatus==true)
{if(confirm(ipb.lang['set_as_spammer']))
{var tid=0;var fid=0;var sid=0;if(typeof(ipb.topic)!='undefined')
{tid=ipb.topic.topic_id;fid=ipb.topic.forum_id;sid=ipb.topic.start_id;}
window.location=ipb.vars['base_url']+'app=forums&module=moderate&section=moderate&do=setAsSpammer&member_id='+memberId+'&t='+tid+'&f='+fid+'&st='+sid+'&auth_key='+ipb.vars['secure_hash'];return false;}
else
{return false;}}
else
{alert(ipb.lang['is_spammer']);return false;}},toggleSpoiler:function(e,button)
{Event.stop(e);var returnvalue=$(button).up().down('.bbc_spoiler_wrapper').down('.bbc_spoiler_content').toggle();if(returnvalue.visible())
{$(button).value=ipb.lang['spoiler_hide'];}
else
{$(button).value=ipb.lang['spoiler_show'];}},setUpSkinLang:function()
{if($('newSkin'))
{var form=$('newSkin').up('form');if(form)
{if($('newSkinSubmit')){$('newSkinSubmit').hide();}
$('newSkin').observe('change',function(e)
{form.submit();return true;});}}
if($('newLang'))
{var form1=$('newLang').up('form');if(form1)
{if($('newLangSubmit')){$('newLangSubmit').hide();}
$('newLang').observe('change',function(e)
{form1.submit();return true;});}}},buildRSSmenu:function()
{$$('link').each(function(link)
{if(link.readAttribute('type')=="application/rss+xml")
{ipb.global.rssItems.push(ipb.templates['rss_item'].evaluate({url:link.readAttribute('href'),title:link.readAttribute('title')}));}});if(ipb.global.rssItems.length>0)
{rssmenu=ipb.templates['rss_shell'].evaluate({items:ipb.global.rssItems.join("\n")});$('rss_feed').insert({after:rssmenu});new ipb.Menu($('rss_feed'),$('rss_menu'));}
else
{$('rss_feed').hide();}},closePMpopup:function(e)
{if($('pm_notification'))
{new Effect.Parallel([new Effect.Fade($('pm_notification')),new Effect.BlindUp($('pm_notification'))],{duration:0.5});}
Event.stop(e);},markReadPMpopup:function(e)
{if($('pm_notification'))
{var elem=Event.findElement(e,'a');var href=elem.href.replace(/&amp;/g,'&')+'&ajax=1';new Ajax.Request(href+"&md5check="+ipb.vars['secure_hash'],{method:'get',evalJSON:'force',onSuccess:function(t){}});new Effect.Parallel([new Effect.Fade($('pm_notification')),new Effect.BlindUp($('pm_notification'))],{duration:0.5});}
Event.stop(e);return false;},initGD:function(elem)
{if(!$(elem)){return;}
$(elem).observe('click',ipb.global.generateNewImage);if($('gd-image-link'))
{$('gd-image-link').observe('click',ipb.global.generateNewImage);}},generateImageExternally:function(elem)
{if(!$(elem)){return;}
$(elem).observe('click',ipb.global.generateNewImage);},generateNewImage:function(e)
{img=Event.findElement(e,'img');Event.stop(e);if(img==document){return;}
if(!img)
{anchor=Event.findElement(e,'a');if(anchor)
{img=anchor.up().down('img');}}
oldSrc=img.src.toQueryParams();oldSrc=$H(oldSrc).toObject();if(!oldSrc['captcha_unique_id']){Debug.error("No captcha ID found");}
new Ajax.Request(ipb.vars['base_url']+"app=core&module=global&section=captcha&do=refresh&captcha_unique_id="+oldSrc['captcha_unique_id']+'&secure_key='+ipb.vars['secure_hash'],{method:'get',onSuccess:function(t)
{oldSrc['captcha_unique_id']=t.responseText;img.writeAttribute({src:ipb.vars['base_url']+$H(oldSrc).toQueryString()});$('regid').value=t.responseText;}});},registerReputation:function(id,url,rating)
{if(!$(id)){return;}
var rep_up=$(id).down('.rep_up');var rep_down=$(id).down('.rep_down');var sendUrl=ipb.vars['base_url']+'&app=core&module=ajax&section=reputation&do=add_rating&app_rate='+url.app+'&type='+url.type+'&type_id='+url.typeid+'&secure_key='+ipb.vars['secure_hash'];if($(rep_up)){$(rep_up).observe('click',ipb.global.repRate.bindAsEventListener(this,1,id));}
if($(rep_down)){$(rep_down).observe('click',ipb.global.repRate.bindAsEventListener(this,-1,id));}
ipb.global.reputation[id]={obj:$(id),url:url,sendUrl:sendUrl,currentRating:rating||0};Debug.write("Registered reputation");},repRate:function(e)
{Event.stop(e);var type=$A(arguments)[1];var id=$A(arguments)[2];var value=(type==1)?1:-1;if(!ipb.global.reputation[id]){return;}else{var rep=ipb.global.reputation[id];}
new Ajax.Request(rep.sendUrl+'&rating='+value,{method:'get',onSuccess:function(t)
{if(t.responseText=='done')
{try{rep.obj.down('.rep_up').hide();rep.obj.down('.rep_down').hide();}catch(err){}
var rep_display=rep.obj.down('.rep_show');if(rep_display)
{['positive','negative','zero'].each(function(c){rep_display.removeClassName(c);});var newValue=rep.currentRating+value;if(newValue>0)
{rep_display.addClassName('positive');}
else if(newValue<0)
{rep_display.addClassName('negative');}
else
{rep_display.addClassName('zero');}
rep_display.update(parseInt(rep.currentRating+value));}}
else
{if(t.responseText=='nopermission')
{alert(ipb.lang['no_permission']);}
else
{alert(ipb.lang['action_failed']+": "+t.responseText);}}}});},timer_liveSearch:function(e)
{ipb.global.searchTimer['show']=setTimeout(ipb.global.liveSearch,400);},timer_hideLiveSearch:function(e)
{ipb.global.searchTimer['hide']=setTimeout(ipb.global.hideLiveSearch,800);},hideLiveSearch:function(e)
{new Effect.Fade($('live_search_popup'),{duration:0.4,afterFinish:function(){$('ajax_result').update('');}});ipb.global.searchLastQuery='';clearTimeout(ipb.global.searchTimer['show']);clearTimeout(ipb.global.searchTimer['hide']);},liveSearch:function(e)
{ipb.global.timer_liveSearch();if($F('main_search').length<ipb.vars['live_search_limit']){return;}
if(!$('live_search_popup'))
{Debug.write("Creating popup");ipb.global.buildSearchPopup();}
else if(!$('live_search_popup').visible())
{new Effect.Appear($('live_search_popup'),{duration:0.4});}
if($F('main_search')==ipb.global.searchLastQuery){return;}
var refine_search='';if(ipb.vars['active_app'])
{refine_search+="&app_search="+ipb.vars['active_app'];}
if(ipb.vars['search_type']&&ipb.vars['search_type_id'])
{refine_search+='&search_type='+ipb.vars['search_type']+'&search_type_id='+ipb.vars['search_type_id'];}
if(ipb.vars['search_type_2']&&ipb.vars['search_type_id_2'])
{refine_search+='&search_type_2='+ipb.vars['search_type_2']+'&search_type_id_2='+ipb.vars['search_type_id_2'];}
new Ajax.Request(ipb.vars['base_url']+"app=core&module=ajax&section=livesearch&do=search&secure_key="+ipb.vars['secure_hash']+"&search_term="+$F('main_search').encodeUrl()+refine_search,{method:'get',onSuccess:function(t){if(!$('ajax_result')){return;}
$('ajax_result').update(t.responseText);}});ipb.global.searchLastQuery=$F('main_search');},buildSearchPopup:function(e)
{pos=$('main_search').cumulativeOffset();finalPos={top:pos.top+$('main_search').getHeight(),left:(pos.left+45)};popup=new Element('div',{id:'live_search_popup'}).hide().setStyle('top: '+finalPos.top+'px; left: '+finalPos.left+'px');$('content').insert({bottom:popup});var refine_search='';if(ipb.vars['active_app'])
{refine_search+="&app_search="+ipb.vars['active_app'];}
if(ipb.vars['search_type']&&ipb.vars['search_type_id'])
{refine_search+='&search_type='+ipb.vars['search_type']+'&search_type_id='+ipb.vars['search_type_id'];}
if(ipb.vars['search_type_2']&&ipb.vars['search_type_id_2'])
{refine_search+='&search_type_2='+ipb.vars['search_type_2']+'&search_type_id_2='+ipb.vars['search_type_id_2'];}
new Ajax.Request(ipb.vars['base_url']+"app=core&module=ajax&section=livesearch&do=template&secure_key="+ipb.vars['secure_hash']+refine_search,{method:'get',onSuccess:function(t){popup.update(t.responseText);}});new Effect.Appear($('live_search_popup'),{duration:0.3});},convertSize:function(size)
{var kb=1024;var mb=1024*1024;var gb=1024*1024*1024;if(size<kb){return size+" B";}
if(size<mb){return(size/kb).toFixed(2)+" KB";}
if(size<gb){return(size/mb).toFixed(2)+" MB";}
return(size/gb).toFixed(2)+" GB";},initImageResize:function()
{var dims=document.viewport.getDimensions();ipb.global.screen_w=dims.width;ipb.global.screen_h=dims.height;ipb.global.max_w=Math.ceil(ipb.global.screen_w*.8);},findImgs:function(wrapper)
{if(!$(wrapper)){return;}
if(!ipb.vars['image_resize']){return;}
if($(wrapper).hasClassName('imgsize_ignore')){Debug.write("Ignoring this post for image resizing...");return;}
$(wrapper).select('img.bbc_img').each(function(elem){if(!ipb.global.screen_w)
{ipb.global.initImageResize();}
ipb.global.resizeImage(elem);});},resizeImage:function(elem)
{if(elem.tagName!='IMG'){return;}
if(elem.readAttribute('handled')){Debug.write("Handled...");return;}
if(!ipb.global.post_width)
{var post=$(elem).up('.post');if(!Object.isUndefined(post))
{var extra=parseInt(post.getStyle('padding-left'))+parseInt(post.getStyle('padding-right'));ipb.global.post_width=$(post).getWidth()-(extra*2);}}
var quotewidth=0;var quote=$(elem).up('.quote');if(!Object.isUndefined(quote))
{var extra=parseInt(quote.getStyle('padding-left'))+parseInt(quote.getStyle('padding-right'));quotewidth=$(quote).getWidth()-(extra*2);}
var widthCompare=(ipb.vars['image_resize_force'])?ipb.vars['image_resize_force']:(quotewidth?quotewidth:(ipb.global.post_width?ipb.global.post_width:ipb.global.max_w));var dims=elem.getDimensions();if(dims.width>widthCompare)
{if(_parent=elem.up('.bbc_center'))
{_parent.removeClassName('bbc_center');}
var percent=Math.ceil((widthCompare/dims.width)*100);if(percent<100)
{elem.height=dims.height*(percent/100);elem.width=dims.width*(percent/100);}
var temp=ipb.templates['resized_img'];var wrap=$(elem).wrap('div').addClassName('resized_img');$(elem).insert({before:temp.evaluate({percent:percent,width:dims.width,height:dims.height})});$(elem).addClassName('resized').setStyle('cursor: pointer;');$(elem).writeAttribute('origWidth',dims.width).writeAttribute('origHeight',dims.height).writeAttribute('shrunk',1);$(elem).writeAttribute('newWidth',elem.width).writeAttribute('newHeight',elem.height).writeAttribute('handled',1);$(elem).observe('click',ipb.global.enlargeImage);}},enlargeImage:function(e)
{var elem=Event.element(e);if(!elem.hasClassName('resized')){elem=Event.findElement(e,'.resized');}
var img=elem;if(!img){return;}
if($(img).readAttribute('shrunk')==1)
{$(img).setStyle('width: '+img.readAttribute('origWidth')+'px; height: '+img.readAttribute('origHeight')+'px; cursor: pointer');$(img).writeAttribute('shrunk',0);}
else
{$(img).setStyle('width: '+img.readAttribute('newWidth')+'px; height: '+img.readAttribute('newHeight')+'px; cursor: pointer');$(img).writeAttribute('shrunk',1);Debug.write("width: "+img.readAttribute('newWidth'));}},registerPageJump:function(source,options)
{if(!source||!options){return;}
ipb.global.pageJumps[source]=options;},buildPageJumps:function()
{$$('.pagejump').each(function(elem){var classes=$(elem).className.match(/pj([0-9]+)/);if(!classes[1]){return;}
$(elem).identify();var temp=ipb.templates['page_jump'].evaluate({id:'pj_'+$(elem).identify()});$$('body')[0].insert(temp);$('pj_'+$(elem).identify()+'_submit').observe('click',ipb.global.pageJump.bindAsEventListener(this,$(elem).identify()));$('pj_'+$(elem).identify()+'_input').observe('keypress',function(e){if(e.which==Event.KEY_RETURN)
{ipb.global.pageJump(e,$(elem).identify());}});var wrap=$('pj_'+$(elem).identify()+'_wrap').addClassName('pj'+classes[1]).writeAttribute('jumpid',classes[1]);var callback={afterOpen:function(popup){try{$('pj_'+$(elem).identify()+'_input').activate();}
catch(err){}}};ipb.global.pageJumpMenus[classes[1]]=new ipb.Menu($(elem),$(wrap),{stopClose:true},callback);});},pageJump:function(e,elem)
{if(!$(elem)||!$('pj_'+$(elem).id+'_input')){return;}
var value=$F('pj_'+$(elem).id+'_input');var jumpid=$('pj_'+$(elem).id+'_wrap').readAttribute('jumpid');if(value.blank()){try{ipb.global.pageJumpMenus[source].doClose();}catch(err){}}
else
{value=parseInt(value);}
var options=ipb.global.pageJumps[jumpid];if(!options){Debug.dir(ipb.global.pageJumps);Debug.write(jumpid);return;}
var pageNum=((value-1)*options.perPage);Debug.write(pageNum);if(pageNum<1){pageNum=0;}
if(ipb.vars['seo_enabled']&&document.location.toString().match(ipb.vars['seo_params']['start'])&&document.location.toString().match(ipb.vars['seo_params']['end'])){if(options.url.match(ipb.vars['seo_params']['varBlock']))
{var url=options.url+ipb.vars['seo_params']['varSep']+options.stKey+ipb.vars['seo_params']['varSep']+pageNum;}
else
{var url=options.url+ipb.vars['seo_params']['varBlock']+options.stKey+ipb.vars['seo_params']['varSep']+pageNum;}}else{var url=options.url+'&amp;'+options.stKey+'='+pageNum;}
url=url.replace(/&amp;/g,'&');url=url.replace(/(http:)?\/\//g,function($0,$1){return $1?$0:'/';});document.location=url;return;},openNewWindow:function(e,link,force)
{var ourHost=document.location.host;var newHost=link.host;if(Prototype.Browser.IE)
{newHost=newHost.replace(/^(.+?):(\d+)$/,'$1');}
if(ourHost!=newHost||force)
{window.open(link.href);Event.stop(e);return false;}
else
{return true;}},registerMarker:function(id,key,url)
{if(!$(id)||key.blank()||url.blank()){return;}
if(Object.isUndefined(ipb.global.boardMarkers)){return;}
Debug.write("Marker INIT: "+id);$(id).observe('click',ipb.global.sendMarker.bindAsEventListener(this,id,key,url));},sendMarker:function(e,id,key,url)
{Event.stop(e);if(!ipb.global.boardMarkers[key]){return;}
new Ajax.Request(url+"&secure_key="+ipb.vars['secure_hash'],{method:'get',evalJSON:'force',onSuccess:function(t)
{if(Object.isUndefined(t.responseJSON))
{Debug.error("Invalid server response");return false;}
if(t.responseJSON['error'])
{Debug.error(t.responseJSON['error']);return false;}
$(id).replace(ipb.global.boardMarkers[key]);var _intId=id.replace(/forum_img_/,'');if($("subforums_"+_intId))
{$$("#subforums_"+_intId+" li").each(function(elem){$(elem).removeClassName('newposts');});}}});},registerCheckAll:function(id,classname)
{if(!$(id)){return;}
$(id).observe('click',ipb.global.checkAll.bindAsEventListener(this,classname));$$('.'+classname).each(function(elem){$(elem).observe('click',ipb.global.checkOne.bindAsEventListener(this,id));});},checkAll:function(e,classname)
{Debug.write('checkAll');var elem=Event.element(e);var checkboxes=$$('.'+classname);if(elem.checked){checkboxes.each(function(check){check.checked=true;});}else{checkboxes.each(function(check){check.checked=false;});}},checkOne:function(e,id)
{var elem=Event.element(e);if($(id).checked&&elem.checked==false)
{$(id).checked=false;}},updateReportStatus:function(e,reportID,noauto,noimg)
{Event.stop(e);var url=ipb.vars['base_url']+"app=core&amp;module=ajax&amp;section=reports&amp;do=change_status&secure_key="+ipb.vars['secure_hash']+"&amp;status=3&amp;id="+parseInt(reportID)+"&amp;noimg="+parseInt(noimg)+"&amp;noauto="+parseInt(noauto);new Ajax.Request(url.replace(/&amp;/g,'&'),{method:'post',evalJSON:'force',onSuccess:function(t)
{if(Object.isUndefined(t.responseJSON))
{alert(ipb.lang['action_failed']);return;}
try{$('rstat-'+reportID).update(t.responseJSON['img']);ipb.menus.closeAll(e);}catch(err){Debug.error(err);}}});},getTotalOffset:function(elem,top,left)
{if($(elem).getOffsetParent()!=document.body)
{Debug.write("Checking "+$(elem).id);var extra=$(elem).positionedOffset();top+=extra['top'];left+=extra['left'];return ipb.global.getTotalOffset($(elem).getOffsetParent(),top,left);}
else
{Debug.write("OK Finished!");return{top:top,left:left};}},checkPermission:function(text)
{if(text=="nopermission")
{alert(ipb.lang['nopermission']);return false;}
return true;},checkForEnter:function(e,callback)
{if(![Event.KEY_RETURN].include(e.keyCode)){return;}
if(callback)
{switch(e.keyCode)
{case Event.KEY_RETURN:callback(e);break;}
Event.stop(e);}}};var _menu=window.IPBoard;_menu.prototype.menus={registered:$H(),init:function()
{Debug.write("Initializing ips.menu.js");document.observe("dom:loaded",function(){ipb.menus.initEvents();});},initEvents:function()
{Event.observe(document,'click',ipb.menus.docCloseAll);$$('.ipbmenu').each(function(menu){id=menu.identify();if($(id+"_menucontent"))
{new ipb.Menu(menu,$(id+"_menucontent"));}});},register:function(source,obj)
{ipb.menus.registered.set(source,obj);},docCloseAll:function(e)
{if((!Event.isLeftClick(e)||e.ctrlKey==true||e.keyCode==91)&&!Prototype.Browser.IE)
{}
else
{ipb.menus.closeAll(e);}},closeAll:function(except)
{ipb.menus.registered.each(function(menu,force){if(typeof(except)=='undefined'||(except&&menu.key!=except))
{try{menu.value.doClose();}catch(err){}}});}};_menu.prototype.Menu=Class.create({initialize:function(source,target,options,callbacks){if(!$(source)||!$(target)){return;}
if(!$(source).id){$(source).identify();}
this.id=$(source).id+'_menu';this.source=$(source);this.target=$(target);this.callbacks=callbacks||{};this.options=Object.extend({eventType:'click',stopClose:false,offsetX:0,offsetY:0},arguments[2]||{});$(source).observe('click',this.eventClick.bindAsEventListener(this));$(source).observe('mouseover',this.eventOver.bindAsEventListener(this));$(target).observe('click',this.targetClick.bindAsEventListener(this));$(this.target).setStyle('position: absolute;').hide().setStyle({zIndex:9999});$(this.target).descendants().each(function(elem){$(elem).setStyle({zIndex:10000});});ipb.menus.register($(source).id,this);if(Object.isFunction(this.callbacks['afterInit']))
{this.callbacks['afterInit'](this);}},doOpen:function()
{Debug.write("Menu open");var pos={};_source=(this.options.positionSource)?this.options.positionSource:this.source;var sourcePos=$(_source).positionedOffset();var _sourcePos=$(_source).cumulativeOffset();var _offset=$(_source).cumulativeScrollOffset();var realSourcePos={top:_sourcePos.top-_offset.top,left:_sourcePos.left-_offset.left};var sourceDim=$(_source).getDimensions();var screenDim=document.viewport.getDimensions();var menuDim=$(this.target).getDimensions();Debug.write("realSourcePos: "+realSourcePos.top+" x "+realSourcePos.left);Debug.write("sourcePos: "+sourcePos.top+" x "+sourcePos.left);Debug.write("scrollOffset: "+_offset.top+" x "+_offset.left);Debug.write("_sourcePos: "+_sourcePos.top+" x "+_sourcePos.left);Debug.write("sourceDim: "+sourceDim.width+" x "+sourceDim.height);Debug.write("menuDim: "+menuDim.height);Debug.write("screenDim: "+screenDim.height);Debug.write("manual ofset: "+this.options.offsetX+" x "+this.options.offsetY);if(Prototype.Browser.IE7)
{_a=_source.getOffsetParent();_b=this.target.getOffsetParent();}
else
{_a=_getOffsetParent(_source);_b=_getOffsetParent(this.target);}
if(_a!=_b)
{if((realSourcePos.left+menuDim.width)>screenDim.width){diff=menuDim.width-sourceDim.width;pos.left=_sourcePos.left-diff+this.options.offsetX;}else{if(Prototype.Browser.IE7)
{pos.left=(sourcePos.left)+this.options.offsetX;}
else
{pos.left=(_sourcePos.left)+this.options.offsetX;}}
if((((realSourcePos.top+sourceDim.height)+menuDim.height)>screenDim.height)&&(_sourcePos.top-menuDim.height+this.options.offsetY)>0)
{pos.top=_sourcePos.top-menuDim.height+this.options.offsetY;}else{pos.top=_sourcePos.top+sourceDim.height+this.options.offsetY;}}
else
{if((realSourcePos.left+menuDim.width)>screenDim.width){diff=menuDim.width-sourceDim.width;pos.left=sourcePos.left-diff+this.options.offsetX;}else{pos.left=sourcePos.left+this.options.offsetX;}
if((((realSourcePos.top+sourceDim.height)+menuDim.height)>screenDim.height)&&(_sourcePos.top-menuDim.height+this.options.offsetY)>0)
{pos.top=sourcePos.top-menuDim.height+this.options.offsetY;}else{pos.top=sourcePos.top+sourceDim.height+this.options.offsetY;}}
Debug.write("Menu position: "+pos.top+" x "+pos.left);$(this.target).setStyle('top: '+(pos.top-1)+'px; left: '+pos.left+'px;');new Effect.Appear($(this.target),{duration:0.2,afterFinish:function(e){if(Object.isFunction(this.callbacks['afterOpen']))
{this.callbacks['afterOpen'](this);}}.bind(this)});Event.observe(document,'keypress',this.checkKeyPress.bindAsEventListener(this));},checkKeyPress:function(e)
{if(e.keyCode==Event.KEY_ESC)
{this.doClose();}},doClose:function()
{new Effect.Fade($(this.target),{duration:0.3,afterFinish:function(e){if(Object.isFunction(this.callbacks['afterClose']))
{this.callbacks['afterClose'](this);}}.bind(this)});},targetClick:function(e)
{try
{elem=Event.findElement(e);if(elem.hasClassName('_noCloseMenuUponClick'))
{Event.stop(e);}}
catch(e){}
if(this.options.stopClose)
{Event.stop(e);}},eventClick:function(e)
{Event.stop(e);if($(this.target).visible()){if(Object.isFunction(this.callbacks['beforeClose']))
{this.callbacks['beforeClose'](this);}
this.doClose();}else{ipb.menus.closeAll($(this.source).id);if(Object.isFunction(this.callbacks['beforeOpen']))
{this.callbacks['beforeOpen'](this);}
this.doOpen();}},eventOver:function()
{}});_popup=window.IPBoard;_popup.prototype.Popup=Class.create({initialize:function(id,options,callbacks)
{this.id='';this.wrapper=null;this.inner=null;this.stem=null;this.options={};this.timer=[];this.ready=false;this.visible=false;this._startup=null;this.hideAfterSetup=false;this.eventPairs={'mouseover':'mouseout','mousedown':'mouseup'};this._tmpEvent=null;this.id=id;this.options=Object.extend({type:'pane',w:'500px',modal:false,modalOpacity:0.4,hideAtStart:true,delay:{show:0,hide:0},defer:false,hideClose:false,black:false,warning:false,closeContents:ipb.templates['close_popup']},arguments[1]||{});this.callbacks=callbacks||{};if(this.options.defer&&$(this.options.attach.target))
{this._defer=this.init.bindAsEventListener(this);$(this.options.attach.target).observe(this.options.attach.event,this._defer);if(this.eventPairs[this.options.attach.event])
{this._startup=function(e){this.hideAfterSetup=true;this.hide();}.bindAsEventListener(this);$(this.options.attach.target).observe(this.eventPairs[this.options.attach.event],this._startup);}}
else
{this.init();}},init:function()
{try{Event.stopObserving($(this.options.attach.target),this.options.attach.event,this._defer);if($(this.options.attach.target))
{var toff=$(this.options.attach.target).positionedOffset();var menu=$(this.options.attach.target).up('.ipbmenu_content');if(toff.top==0&&toff.left==0||$(menu))
{this.options.type='modal';this.options.attach={};}}}catch(err){}
this.wrapper=new Element('div',{'id':this.id+'_popup'}).setStyle('z-index: 16000').hide().addClassName('popupWrapper');this.inner=new Element('div',{'id':this.id+'_inner'}).addClassName('popupInner');if(this.options.black)
{this.inner.addClassName('black_mode');}
if(this.options.warning)
{this.inner.addClassName('warning_mode');}
if(this.options.w){this.inner.setStyle('width: '+this.options.w);}
var _vph=document.viewport.getDimensions().height-25;this.options.h=(this.options.h&&_vph>this.options.h)?_vph:_vph;this.inner.setStyle('max-height: '+this.options.h+'px');this.wrapper.insert(this.inner);if(this.options.hideClose!=true)
{this.closeLink=new Element('div',{'id':this.id+'_close'}).addClassName('popupClose').addClassName('clickable');this.closeLink.update(this.options.closeContents);this.closeLink.observe('click',this.hide.bindAsEventListener(this));this.wrapper.insert(this.closeLink);if(this.options.black||this.options.warning)
{this.closeLink.addClassName('light_close_button');}}
$$('body')[0].insert(this.wrapper);if(this.options.classname){this.wrapper.addClassName(this.options.classname);}
if(this.options.initial){this.update(this.options.initial);}
if(Object.isFunction(this.callbacks['beforeAjax']))
{this.callbacks['beforeAjax'](this);}
if(this.options.ajaxURL){this.updateAjax();setTimeout(this.continueInit.bind(this),80);}else{this.ready=true;this.continueInit();}},continueInit:function()
{if(!this.ready)
{setTimeout(this.continueInit.bind(this),80);return;}
if(this.options.type=='balloon'){this.setUpBalloon();}else{this.setUpPane();}
try{if(this.options.close){closeElem=$(this.wrapper).select(this.options.close)[0];if(Object.isElement(closeElem))
{$(closeElem).observe('click',this.hide.bindAsEventListener(this));}}}catch(err){Debug.write(err);}
if(Object.isFunction(this.callbacks['afterInit']))
{this.callbacks['afterInit'](this);}
if(!this.options.hideAtStart&&!this.hideAfterSetup)
{this.show();}
if(this.hideAfterSetup&&this._startup)
{Event.stopObserving($(this.options.attach.target),this.eventPairs[this.options.attach.event],this._startup);}},updateAjax:function()
{new Ajax.Request(this.options.ajaxURL,{method:'get',onSuccess:function(t)
{if(t.responseText!='error')
{if(t.responseText=='nopermission')
{alert(ipb.lang['no_permission']);return;}
if(t.responseText.match("__session__expired__log__out__"))
{this.update('');alert("Your session has expired, please refresh the page and log back in");return false;}
Debug.write("AJAX done!");this.update(t.responseText);this.ready=true;if(Object.isFunction(this.callbacks['afterAjax']))
{this.callbacks['afterAjax'](this,t.responseText);}}
else
{Debug.write(t.responseText);return;}}.bind(this)});},show:function(e)
{if(e){Event.stop(e);}
if(this.timer['show']){clearTimeout(this.timer['show']);}
if(this.options.delay.show!=0){this.timer['show']=setTimeout(this._show.bind(this),this.options.delay.show);}else{this._show();}},hide:function(e)
{if(e){Event.stop(e);}
if(this.document_event){Event.stopObserving(document,'click',this.document_event);}
if(this.timer['hide']){clearTimeout(this.timer['hide']);}
if(this.options.delay.hide!=0){this.timer['hide']=setTimeout(this._hide.bind(this),this.options.delay.hide);}else{this._hide();}},kill:function()
{if(this.timer['hide']){clearTimeout(this.timer['hide']);}
if(this.timer['show']){clearTimeout(this.timer['show']);}
$(this.wrapper).remove();},_show:function()
{this.visible=true;try
{if(this.options.warning)
{_wrap=this.inner.down('h3').next('div');if(_wrap)
{if(!_wrap.className.match(/moderated/))
{_wrap.addClassName('moderated');}}}}catch(e){}
if(this.options.modal==false){new Effect.Appear($(this.wrapper),{duration:0.3,afterFinish:function(){if(Object.isFunction(this.callbacks['afterShow']))
{this.callbacks['afterShow'](this);}}.bind(this)});this.document_event=this.handleDocumentClick.bindAsEventListener(this);Event.observe(document,'click',this.document_event);}else{new Effect.Appear($('document_modal'),{duration:0.3,to:this.options.modalOpacity,afterFinish:function(){new Effect.Appear($(this.wrapper),{duration:0.4,afterFinish:function(){if(Object.isFunction(this.callbacks['afterShow']))
{this.callbacks['afterShow'](this);}}.bind(this)});}.bind(this)});}},_hide:function()
{this.visible=false;if(this._tmpEvent!=null)
{Event.stopObserving($(this.wrapper),'mouseout',this._tmpEvent);this._tmpEvent=null;}
if(this.options.modal==false){new Effect.Fade($(this.wrapper),{duration:0.3,afterFinish:function(){if(Object.isFunction(this.callbacks['afterHide']))
{this.callbacks['afterHide'](this);}}.bind(this)});}else{new Effect.Fade($(this.wrapper),{duration:0.3,afterFinish:function(){new Effect.Fade($('document_modal'),{duration:0.2,afterFinish:function(){if(Object.isFunction(this.callbacks['afterHide']))
{this.callbacks['afterHide'](this);}}.bind(this)});}.bind(this)});}},handleDocumentClick:function(e)
{if(!Event.element(e).descendantOf(this.wrapper)&&(this.options.attach&&(Event.element(e).id!=this.options.attach.target.id)))
{this._hide(e);}},update:function(content,evalScript)
{this.inner.update(content);if(Object.isUndefined(evalScript)||evalScript!=false){this.inner.innerHTML.evalScripts();}},setUpBalloon:function()
{if(this.options.attach)
{var attach=this.options.attach;if(attach.target&&$(attach.target))
{if(this.options.stem==true)
{this.createStem();}
if(!attach.position){attach.position='auto';}
if(isRTL)
{if(Object.isUndefined(attach.offset)){attach.offset={top:0,right:0};}
if(Object.isUndefined(attach.offset.top)){attach.offset.top=0;}
if(Object.isUndefined(attach.offset.left)){attach.offset.right=0;}else{attach.offset.right=attach.offset.left;}}
else
{if(Object.isUndefined(attach.offset)){attach.offset={top:0,left:0};}
if(Object.isUndefined(attach.offset.top)){attach.offset.top=0;}
if(Object.isUndefined(attach.offset.left)){attach.offset.left=0;}}
if(attach.position=='auto')
{Debug.write("Popup: auto-positioning");var screendims=document.viewport.getDimensions();var screenscroll=document.viewport.getScrollOffsets();var toff=$(attach.target).viewportOffset();var wrapSize=$(this.wrapper).getDimensions();var delta=[0,0];if(Element.getStyle($(attach.target),'position')=='absolute')
{var parent=$(attach.target).getOffsetParent();delta=parent.viewportOffset();}
if(isRTL)
{toff['right']=screendims.width-(toff[0]-delta[0]);}
else
{toff['left']=toff[0]-delta[0];}
toff['top']=toff[1]-delta[1]+screenscroll.top;var start='top';if(isRTL)
{var end='right';}
else
{var end='left';}
if((toff.top-wrapSize.height-attach.offset.top)<(0+screenscroll.top)){var start='bottom';}
if(isRTL)
{if((toff.right+wrapSize.width-attach.offset.right)<(screendims.width-screenscroll.left)){var end='left';}}
else
{if((toff.left+wrapSize.width-attach.offset.left)>(screendims.width-screenscroll.left)){var end='right';}}
finalPos=this.position(start+end,{target:$(attach.target),content:$(this.wrapper),offset:attach.offset});if(this.options.stem==true)
{finalPos=this.positionStem(start+end,finalPos);}}
else
{Debug.write("Popup: manual positioning");finalPos=this.position(attach.position,{target:$(attach.target),content:$(this.wrapper),offset:attach.offset});if(this.options.stem==true)
{finalPos=this.positionStem(attach.position,finalPos);}}
if(!Object.isUndefined(attach.event)){$(attach.target).observe(attach.event,this.show.bindAsEventListener(this));if(attach.event!='click'&&!Object.isUndefined(this.eventPairs[attach.event])){$(attach.target).observe(this.eventPairs[attach.event],this.hide.bindAsEventListener(this));}
$(this.wrapper).observe('mouseover',this.wrapperEvent.bindAsEventListener(this));}}}
if(isRTL)
{Debug.write("Popup: Right: "+finalPos.right+"; Top: "+finalPos.top);$(this.wrapper).setStyle('top: '+finalPos.top+'px; right: '+finalPos.right+'px; position: absolute;');}
else
{Debug.write("Popup: Left: "+finalPos.left+"; Top: "+finalPos.top);$(this.wrapper).setStyle('top: '+finalPos.top+'px; left: '+finalPos.left+'px; position: absolute;');}},wrapperEvent:function(e)
{if(this.timer['hide'])
{clearTimeout(this.timer['hide']);this.timer['hide']=null;if(this.options.attach.event&&this.options.attach.event=='mouseover')
{if(this._tmpEvent==null){this._tmpEvent=this.hide.bindAsEventListener(this);$(this.wrapper).observe('mouseout',this._tmpEvent);}}}},positionStem:function(pos,finalPos)
{var stemSize={height:16,width:31};var wrapStyle={};var stemStyle={};switch(pos.toLowerCase())
{case'topleft':wrapStyle={marginBottom:stemSize.height+'px'};if(isRTL)
{stemStyle={bottom:-(stemSize.height)+'px',right:'5px'};finalPos.right=finalPos.right-15;}
else
{stemStyle={bottom:-(stemSize.height)+'px',left:'5px'};finalPos.left=finalPos.left-15;}
break;case'topright':wrapStyle={marginBottom:stemSize.height+'px'};if(isRTL)
{stemStyle={bottom:-(stemSize.height)+'px',left:'5px'};finalPos.right=finalPos.right+15;}
else
{stemStyle={bottom:-(stemSize.height)+'px',right:'5px'};finalPos.left=finalPos.left+15;}
break;case'bottomleft':wrapStyle={marginTop:stemSize.height+'px'};if(isRTL)
{stemStyle={top:-(stemSize.height)+'px',right:'5px'};finalPos.right=finalPos.right-15;}
else
{stemStyle={top:-(stemSize.height)+'px',left:'5px'};finalPos.left=finalPos.left-15;}
break;case'bottomright':wrapStyle={marginTop:stemSize.height+'px'};if(isRTL)
{stemStyle={top:-(stemSize.height)+'px',left:'5px'};finalPos.right=finalPos.right+15;}
else
{stemStyle={top:-(stemSize.height)+'px',right:'5px'};finalPos.left=finalPos.left+15;}
break;}
$(this.wrapper).setStyle(wrapStyle);$(this.stem).setStyle(stemStyle).setStyle('z-index: 6000').addClassName(pos.toLowerCase());return finalPos;},position:function(pos,v)
{finalPos={};var toff=$(v.target).viewportOffset();var tsize=$(v.target).getDimensions();var wrapSize=$(v.content).getDimensions();var screenscroll=document.viewport.getScrollOffsets();var offset=v.offset;var delta=[0,0];if(Element.getStyle($(v.target),'position')=='absolute')
{var parent=$(v.target).getOffsetParent();delta=parent.viewportOffset();}
if(isRTL)
{toff['right']=document.viewport.getDimensions().width-(toff[0]-delta[0]);}
else
{toff['left']=toff[0]-delta[0];}
toff['top']=toff[1]-delta[1];if(!Prototype.Browser.Opera){toff['top']+=screenscroll.top;}
switch(pos.toLowerCase())
{case'topleft':finalPos.top=(toff.top-wrapSize.height-tsize.height)-offset.top;if(isRTL)
{finalPos.right=toff.right+offset.right;}
else
{finalPos.left=toff.left+offset.left;}
break;case'topright':finalPos.top=(toff.top-wrapSize.height-tsize.height)-offset.top;if(isRTL)
{finalPos.right=(toff.right-(wrapSize.width-tsize.width))-offset.right;}
else
{finalPos.left=(toff.left-(wrapSize.width-tsize.width))-offset.left;}
break;case'bottomleft':finalPos.top=(toff.top+tsize.height)+offset.top;if(isRTL)
{finalPos.right=toff.right+offset.right;}
else
{finalPos.left=toff.left+offset.left;}
break;case'bottomright':finalPos.top=(toff.top+tsize.height)+offset.top;if(isRTL)
{finalPos.right=(toff.right-(wrapSize.width-tsize.width))-offset.right;}
else
{finalPos.left=(toff.left-(wrapSize.width-tsize.width))-offset.left;}
break;}
return finalPos;},createStem:function()
{this.stem=new Element('div',{id:this.id+'_stem'}).update('&nbsp;').addClassName('stem');this.wrapper.insert({top:this.stem});},setUpPane:function()
{if(!$('document_modal')){this.createDocumentModal();}
this.positionPane();},positionPane:function()
{var elem_s=$(this.wrapper).getDimensions();var window_s=document.viewport.getDimensions();var window_offsets=document.viewport.getScrollOffsets();if(isRTL)
{var center={right:((window_s['width']-elem_s['width'])/2),top:(((window_s['height']-elem_s['height'])/2)/2)};if(center.top<10){center.top=10;}
$(this.wrapper).setStyle('top: '+center['top']+'px; right: '+center['right']+'px; position: fixed;');}
else
{var center={left:((window_s['width']-elem_s['width'])/2),top:(((window_s['height']-elem_s['height'])/2)/2)};if(center.top<10){center.top=10;}
$(this.wrapper).setStyle('top: '+center['top']+'px; left: '+center['left']+'px; position: fixed;');}},createDocumentModal:function()
{var pageSize=$('ipboard_body').getDimensions();var viewSize=document.viewport.getDimensions();var dims=[];if(viewSize['height']<pageSize['height']){dims['height']=pageSize['height'];}else{dims['height']=viewSize['height'];}
if(viewSize['width']<pageSize['width']){dims['width']=pageSize['width'];}else{dims['width']=viewSize['width'];}
var modal=new Element('div',{'id':'document_modal'}).addClassName('modal').hide();if(isRTL)
{modal.setStyle('width: '+dims['width']+'px; height: '+dims['height']+'px; position: absolute; top: 0px; right: 0px; z-index: 15000;');}
else
{modal.setStyle('width: '+dims['width']+'px; height: '+dims['height']+'px; position: absolute; top: 0px; left: 0px; z-index: 15000;');}
$$('body')[0].insert(modal);},getObj:function()
{return $(this.wrapper);}});ipb=new IPBoard;ipb.global.init();ipb.menus.init();;var _quickpm=window.IPBoard;_quickpm.prototype.quickpm={popupObj:null,sendingToUser:0,init:function()
{Debug.write("Initializing ips.quickpm.js");document.observe("dom:loaded",function(){ipb.quickpm.initEvents();});},initEvents:function()
{ipb.delegate.register(".pm_button",ipb.quickpm.launchPMform);},launchPMform:function(e,target)
{if(DISABLE_AJAX){return false;}
if(e.ctrlKey==true||e.metaKey==true||e.keyCode==91)
{return false;}
Debug.write("Launching PM form");pmInfo=target.id.match(/pm_([0-9a-z]+)_([0-9]+)/);if(!pmInfo[2]){Debug.error('Could not find member ID in string '+target.id);}
if($('pm_popup_popup'))
{if(pmInfo[2]==ipb.quickpm.sendingToUser)
{try{$('pm_error_'+ipb.quickpm.sendingToUser).hide();}catch(err){}
ipb.quickpm.popupObj.show();Event.stop(e);return;}
else
{ipb.quickpm.popupObj.getObj().remove();ipb.quickpm.sendingToUser=null;ipb.quickpm.sendingToUser=pmInfo[2];}}
else
{ipb.quickpm.sendingToUser=pmInfo[2];}
ipb.quickpm.popupObj=new ipb.Popup('pm_popup',{type:'pane',modal:true,hideAtStart:true,w:'600px'});var popup=ipb.quickpm.popupObj;new Ajax.Request(ipb.vars['base_url']+"&app=members&module=ajax&secure_key="+ipb.vars['secure_hash']+'&section=messenger&do=showQuickForm&toMemberID='+pmInfo[2],{method:'post',evalJSON:'force',onSuccess:function(t)
{if(t.responseJSON['error'])
{switch(t.responseJSON['error'])
{case'noSuchToMember':alert(ipb.lang['member_no_exist']);break;case'cannotUsePMSystem':case'nopermission':alert(ipb.lang['no_permission']);break;default:alert(t.responseJSON['error']);break;}
ipb.quickpm.sendingToUser=0;return;}
else
{popup.update(t.responseJSON['success']);popup.positionPane();popup.show();if($(popup.getObj()).select('.input_submit')[0]){$(popup.getObj()).select('.input_submit')[0].observe('click',ipb.quickpm.doSend);}
if($(popup.getObj()).select('.use_full')[0]){$(popup.getObj()).select('.use_full')[0].observe('click',ipb.quickpm.useFull);}
if($(popup.getObj()).select('.cancel')[0]){$(popup.getObj()).select('.cancel')[0].observe('click',ipb.quickpm.cancelForm);}}}});Event.stop(e);},cancelForm:function(e)
{$('pm_error_'+ipb.quickpm.sendingToUser).hide();ipb.quickpm.popupObj.hide();Event.stop(e);},useFull:function(e)
{Event.stop(e);var form=new Element('form',{'method':'post','action':ipb.vars['base_url']+'&app=members&module=messaging&section=send&do=form&preview=1&_from=quickPM&fromMemberID='+ipb.quickpm.sendingToUser});var post=new Element('textarea',{'name':'Post'});var subject=new Element('input',{'type':'text','value':$F('pm_subject_'+ipb.quickpm.sendingToUser),'name':'msg_title'});var val=$F('pm_textarea_'+ipb.quickpm.sendingToUser).replace(/<script/ig,'&lt; script').replace(/<\/script/ig,'&lt; /script');$(form).insert(post).insert(subject).setStyle('position: absolute; left: -500px; top: 0');$(post).update(val);$$('body')[0].insert(form);$(form).submit();},doSend:function(e)
{Debug.write("Sending");if(!ipb.quickpm.sendingToUser){return;}
Event.stop(e);if($F('pm_subject_'+ipb.quickpm.sendingToUser).blank())
{ipb.quickpm.showError(ipb.lang['quickpm_enter_subject']);return;}
if($F('pm_textarea_'+ipb.quickpm.sendingToUser).blank())
{ipb.quickpm.showError(ipb.lang['quickpm_msg_blank']);return;}
var popup=ipb.quickpm.popupObj;if($(popup.getObj()).select('.input_submit')[0]){$(popup.getObj()).select('.input_submit')[0].disabled=true;};new Ajax.Request(ipb.vars['base_url']+'&app=members&module=ajax&secure_key='+ipb.vars['secure_hash']+'&section=messenger&do=PMSend&toMemberID='+ipb.quickpm.sendingToUser,{method:'post',parameters:{'Post':$F('pm_textarea_'+ipb.quickpm.sendingToUser).encodeParam(),'std_used':1,'toMemberID':ipb.quickpm.sendingToUser,'subject':$F('pm_subject_'+ipb.quickpm.sendingToUser).encodeParam()},evalJSON:'force',onSuccess:function(t)
{if(Object.isUndefined(t.responseJSON)){alert(ipb.lang['action_failed']);}
if(t.responseJSON['error'])
{popup.hide();ipb.quickpm.sendingToUser=0;Event.stop(e);switch(t.responseJSON['error'])
{case'cannotUsePMSystem':case'nopermission':alert(ipb.lang['no_permission']);break;default:alert(t.responseJSON['error']);break;}}
else if(t.responseJSON['inlineError'])
{ipb.quickpm.showError(t.responseJSON['inlineError']);if($(popup.getObj()).select('.input_submit')[0]){$(popup.getObj()).select('.input_submit')[0].disabled=false;};return;}
else if(t.responseJSON['status'])
{popup.hide();ipb.quickpm.sendingToUser=0;Event.stop(e);alert(ipb.lang['message_sent']);return;}
else
{Debug.dir(t.responseJSON);}}});},showError:function(msg)
{if(!ipb.quickpm.sendingToUser||!$('pm_error_'+ipb.quickpm.sendingToUser)){return;}
$('pm_error_'+ipb.quickpm.sendingToUser).select('.message')[0].update(msg);if(!$('pm_error_'+ipb.quickpm.sendingToUser).visible())
{new Effect.BlindDown($('pm_error_'+ipb.quickpm.sendingToUser),{duration:0.3});}
else
{}
return;}};ipb.quickpm.init();;var _sharelinks=window.IPBoard;_sharelinks.prototype.sharelinks={popups:null,bname:null,url:null,title:null,maxTwitterLen:115,init:function()
{Debug.write("Initializing ips.sharelinks.js");document.observe("dom:loaded",function(){ipb.sharelinks.initEvents();});},initEvents:function()
{ipb.delegate.register('._slink',ipb.sharelinks.sharePop);},sharePop:function(e,elem)
{var shareKey=elem.id.replace(/slink_/,'');var ok=false;var callback=null;if(shareKey=='twitter')
{if(ipb.vars['member_id']&&ipb.vars['twitter_id'])
{callback=ipb.sharelinks.twitterPostPop;ok=true;}}
else if(shareKey=='facebook')
{if(ipb.vars['member_id']&&ipb.vars['fb_uid'])
{callback=ipb.sharelinks.facebookPostPop;ok=true;}}
if(ok===false||DISABLE_AJAX)
{return false;}
Event.stop(e);var _url=ipb.vars['base_url']+'&app=core&module=ajax&secure_key='+ipb.vars['secure_hash']+'&section=sharelinks&do='+shareKey+'Form';var x=new ipb.Popup('shareKeyPop_'+Math.random(),{type:'balloon',ajaxURL:_url,stem:true,hideAtStart:false,attach:{target:$('slink_'+shareKey),position:'auto'},w:'400px'},{'afterAjax':callback,'beforeAjax':ipb.sharelinks.resetPop});},facebookPostPop:function(e)
{$('fContent').update('');$('fSubmit').observe('click',ipb.sharelinks.goFacebook);},twitterPostPop:function(e)
{ipb.sharelinks.title=ipb.sharelinks.title.replace(/&#34;/g,'"');ipb.sharelinks.title=ipb.sharelinks.title.replace(/&#33;/g,"!");ipb.sharelinks.title=ipb.sharelinks.title.replace(/&quot;/g,'"');ipb.sharelinks.title=ipb.sharelinks.title.replace(/&quot;/g,'"');ipb.sharelinks.bname=ipb.sharelinks.bname.replace(/&#34;/g,'"');ipb.sharelinks.bname=ipb.sharelinks.bname.replace(/&#33;/g,"!");ipb.sharelinks.bname=ipb.sharelinks.bname.replace(/&#39;/g,"'");ipb.sharelinks.bname=ipb.sharelinks.bname.replace(/&quot;/g,'"');$('tContent').value=ipb.sharelinks.bname+': '+ipb.sharelinks.title;$('tContent').observe('keyup',ipb.sharelinks.checkTwitterLength);$('tSubmit').observe('click',ipb.sharelinks.goTwitter);ipb.sharelinks.checkTwitterLength(e);},resetPop:function(e)
{if($('tContent'))
{$('tContent').stopObserving();$('tContent').remove();$('tSubmit').stopObserving();$('tWrap').remove();}
if($('cLeft'))
{$('cLeft').remove();}
if($('fContent'))
{$('fContent').remove();$('fSubmit').stopObserving();$('fWrap').remove();}},goTwitter:function(e)
{if(DISABLE_AJAX)
{return false;}
Event.stop(e);if(!$('tContent')||$F('tContent').blank())
{return;}
new Ajax.Request(ipb.vars['base_url']+'&app=core&module=ajax&secure_key='+ipb.vars['secure_hash']+'&section=sharelinks&do=twitterGo',{method:'post',parameters:{'tweet':$F('tContent').encodeParam(),'title':ipb.sharelinks.title.encodeParam(),'url':ipb.sharelinks.url.encodeParam()},onSuccess:function(t)
{if(t.responseText=='failwhale')
{alert(ipb.lang['action_failed']);return;}
else
{$('tWrap').update(t.responseText);}}});},goFacebook:function(e)
{if(DISABLE_AJAX)
{return false;}
Event.stop(e);new Ajax.Request(ipb.vars['base_url']+'&app=core&module=ajax&secure_key='+ipb.vars['secure_hash']+'&section=sharelinks&do=facebookGo',{method:'post',parameters:{'comment':$F('fContent').encodeParam(),'title':ipb.sharelinks.title.encodeParam(),'url':ipb.sharelinks.url.encodeParam()},onSuccess:function(t)
{if(t.responseText=='finchersaysno')
{alert(ipb.lang['action_failed']);return;}
else
{$('fWrap').update(t.responseText);}}});},checkTwitterLength:function(e)
{newTotal=parseInt(ipb.sharelinks.maxTwitterLen)-parseInt($F('tContent').length);if(newTotal<0)
{$('tContent').value=$F('tContent').truncate(ipb.sharelinks.maxTwitterLen,'');newTotal=0;}
$('cLeft').update(newTotal);}};ipb.sharelinks.init();;var _editor=window.IPBoard;var isRTL=(isRTL)?isRTL:false;_editor_rte=Class.create({_identifyType:function()
{Debug.write("(Editor "+this.id+") This is the RTE class");},togglesource_pre_show_html:function()
{},togglesource_post_show_html:function()
{},editor_write_contents:function(text,do_init)
{if((Object.isUndefined(text)||text===false||text.blank())&&Prototype.Browser.Gecko)
{text='<br />';}
else if(Object.isUndefined(text)||text===false)
{text='';}
if(this.editor_document&&this.editor_document.initialized)
{this.editor_document.body.innerHTML=text;}
else
{if(do_init)
{this.editor_document.designMode='on';}
this.editor_document=this.editor_window.document;this.editor_document.open('text/html','replace');this.editor_document.write(this.ips_frame_html.replace('{:content:}',text));this.editor_document.close();if(do_init)
{this.editor_document.body.contentEditable=true;this.editor_document.initialized=true;}}},removeformat:function(e)
{this.apply_formatting('unlink',false,false);this.apply_formatting('removeformat',false,false);var text=this.get_selection();if(text)
{text=this.strip_html(text);text=this.strip_empty_html(text);text=text.replace(/\r/g,"");text=text.replace(/\n/g,"<br />");text=text.replace(/<!--(.*?)-->/g,"");text=text.replace(/&lt;!--(.*?)--&gt;/g,"");this.insert_text(text);}},editor_get_contents:function()
{return this.editor_document.body.innerHTML;},editor_set_content:function(init_text)
{if($(this.id+'_iframe'))
{this.editor_box=$(this.id+'_iframe');}
else
{var iframe=new Element('iframe',{'id':this.id+'_iframe','tabindex':0});if(Prototype.Browser.IE&&window.location.protocol=='https:')
{iframe.writeAttribute('src',this.options.file_path+'/index.html');}
this.items['text_obj'].up().insert(iframe);this.editor_box=iframe;}
if(!Prototype.Browser.IE)
{this.editor_box.setStyle('border: 1px inset');}
else
{if(!Object.isUndefined(init_text)&&init_text!=false)
{init_text=init_text.replace(/&sect/g,"&amp;sect");}}
var test_height=ipb.Cookie.get('ips_rte_height');if(Object.isNumber(test_height)&&test_height>50)
{this.items['text_obj'].setStyle({height:test_height+'px'});Debug.write("Set text_obj height to "+test_height);}
var tobj_dims=this.items['text_obj'].getDimensions();if(Object.isUndefined(tobj_dims)||tobj_dims['height']==0)
{tobj_dims['height']=250;}
this.editor_box.setStyle({width:'100%',height:tobj_dims.height+'px',className:this.items['text_obj'].className});this.items['text_obj'].hide();this.editor_window=this.editor_box.contentWindow;this.editor_document=this.editor_window.document;if(!this.items['text_obj'].value&&(init_text===false||Object.isUndefined(init_text)))
{this.editor_write_contents(false,true);}
else
{this.editor_write_contents((Object.isUndefined(init_text)||!init_text?this.items['text_obj'].value:init_text),true);}
this.editor_document.editor_id=this.editor_id;this.editor_window.editor_id=this.editor_id;this.editor_window.has_focus=false;try
{Debug.write("Attempt to get focus");this.editor_check_focus();this.editor_document.execCommand("InsertHorizontalRule",false,null);this.editor_document.execCommand("undo",false,null);}
catch(error)
{Debug.write("#011 "+error);}},apply_formatting:function(cmd,dialog,argument)
{dialog=(Object.isUndefined(dialog)?false:dialog);argument=(Object.isUndefined(argument)?true:argument);if(Prototype.Browser.IE&&this.forum_fix_ie_newlines)
{if(cmd=='justifyleft'||cmd=='justifycenter'||cmd=='justifyright')
{var _a=cmd.replace("justify","");this.wrap_tags_lite("["+_a+"]","[/"+_a+"]");return true;}
else if(cmd=='outdent'||cmd=='indent'||cmd=='insertorderedlist'||cmd=='insertunorderedlist')
{this.editor_check_focus();var sel=this.editor_document.selection;var ts=this.editor_document.selection.createRange();var t=ts.htmlText.replace(/<p([^>]*)>(.*)<\/p>/i,'$2');if((sel.type=="Text"||sel.type=="None"))
{ts.pasteHTML(t+"<p />\n");}
else
{this.editor_document.body.innerHTML+="<p />";}}}
if(Prototype.Browser.IE&&this._ie_cache!=null)
{this.editor_check_focus();this._ie_cache.select();}
this.editor_document.execCommand(cmd,dialog,argument);this._ie_cache=null;return false;},get_selection:function()
{var rng=this._ie_cache?this._ie_cache:this.editor_document.selection.createRange();if(rng.htmlText)
{Debug.write('htmlTest:'+rng.htmlText+'.');return rng.htmlText;}
else
{var rtn='';for(var i=0;i<rng.length;i++)
{rtn+=rng.item(i).outerHTML;}}
return rtn;},editor_set_functions:function()
{Event.observe(this.editor_document,'mouseup',this.events.editor_document_onmouseup.bindAsEventListener(this));Event.observe(this.editor_document,'keyup',this.events.editor_document_onkeyup.bindAsEventListener(this));Event.observe(this.editor_document,'keydown',this.events.editor_document_onkeydown.bindAsEventListener(this));Event.observe(this.editor_window,'blur',this.events.editor_window_onblur.bindAsEventListener(this));Event.observe(this.editor_window,'focus',this.events.editor_window_onfocus.bindAsEventListener(this));},set_context:function(cmd)
{if(this._showing_html)
{return false;}
this.button_update.each(function(item)
{var obj=$(this.id+'_cmd_'+item);if(obj!=null)
{try{var state=new String(this.editor_document.queryCommandState(item));if(obj.readAttribute('state')!=state)
{obj.writeAttribute('state',new String(state));this.set_button_context(obj,(obj.readAttribute('cmd')==cmd?'mouseover':'mouseout'));}}
catch(error)
{Debug.write("#1 "+error);}}}.bind(this));this.button_set_font_context();this.button_set_size_context();},button_set_font_context:function(font_state)
{changeto='';if(this._showing_html)
{return false;}
if(this.items['buttons']['fontname'])
{if(Object.isUndefined(font_state)){font_state=this.editor_document.queryCommandValue('fontname')||'';}
if(font_state.blank()){if(!Prototype.Browser.IE&&window.getComputedStyle)
{font_state=this.editor_document.body.style.fontFamily;}}else if(font_state==null){font_state='';}
if(font_state!=this.font_state)
{this.font_state=font_state;var fontword=font_state;var commapos=fontword.indexOf(",");if(commapos!=-1){fontword=fontword.substr(0,commapos);}
fontword=fontword.toLowerCase();changeto='';ipb.editor_values.get('primary_fonts').any(function(font){if(font.value.toLowerCase()==fontword){changeto=font.value;return true;}else{return false;}});changeto=(changeto=='')?this.fontoptions['_default']:changeto;this.items['buttons']['fontname'].update(changeto);}}},button_set_size_context:function(size_state)
{if(this.items['buttons']['fontsize'])
{if(Object.isUndefined(size_state)){size_state=this.editor_document.queryCommandValue('fontsize');}
if(size_state==null||size_state=='')
{if(Prototype.Browser.Gecko)
{size_state=this.convert_size(this.editor_document.body.style.fontSize,0);if(!size_state)
{size_state='2';}}}
changeto='';if(size_state!=this.size_state)
{this.size_state=size_state;ipb.editor_values.get('font_sizes').any(function(size){if(parseInt(size)==parseInt(this.size_state)){changeto=size;return true;}else{return false;}}.bind(this));changeto=(changeto=='')?this.sizeoptions['_default']:changeto;this.items['buttons']['fontsize'].update(changeto);}}},insert_text:function(text)
{Debug.write("Inserting "+text+".");this.editor_check_focus();if(typeof(this.editor_document.selection)!='undefined'&&this.editor_document.selection.type!='Text'&&this.editor_document.selection.type!='None')
{this.editor_document.selection.clear();}
var sel=this._ie_cache?this._ie_cache:this.editor_document.selection.createRange();sel.pasteHTML(text);sel.select();this._ie_cache=null;},insert_emoticon:function(emo_id,emo_image,emo_code,event)
{Debug.write("Adding emoticon "+emo_code);try
{var _emo_url=ipb.vars['emoticon_url']+"/"+emo_image;var _emo_html=' <img src="'+_emo_url+'" class="bbc_emoticon" alt="'+this.unhtmlspecialchars(emo_code)+'" />';this.wrap_tags_lite(" "+_emo_html," ",false);}
catch(error)
{Debug.write("#2 "+error);}},togglesource:function(e,update)
{Event.stop(e);if(this._showing_html)
{if(update)
{this.editor_document.initialized=false;this.editor_write_contents($(this.id+'_htmlsource').value,true);}
$(this.editor_box).show();$(this.items['controls']).show();$(this.id+'_htmlsource').remove();$(this.id+'_ts_controls').remove();this._showing_html=false;this.editor_check_focus();}
else
{this._showing_html=true;this.togglesource_pre_show_html();var textarea=new Element('textarea',{id:this.id+'_htmlsource',tabindex:3});textarea.className=this.items['text_obj'].className;var dims=this.items['text_obj'].getDimensions();textarea.value=this.clean_html(this.editor_get_contents());var controlbar=ipb.editor_values.get('templates')['togglesource'].evaluate({id:this.id});$(this.items['text_obj']).insert({after:textarea});$(textarea).insert({after:controlbar});$(this.id+'_ts_update').writeAttribute('cmd','togglesource').writeAttribute('editor_id',this.id).observe('click',this.togglesource.bindAsEventListener(this,1));$(this.id+'_ts_cancel').writeAttribute('cmd','togglesource').writeAttribute('editor_id',this.id).observe('click',this.togglesource.bindAsEventListener(this,0));$(this.items['controls']).hide();$(this.editor_box).hide();this.editor_check_focus();}},update_for_form_submit:function()
{Debug.write("Updating for submit");this.items['text_obj'].value=this.editor_get_contents();Debug.write("Before: "+this.items['text_obj'].value);if(Prototype.Browser.IE)
{this.items['text_obj'].value=this.items['text_obj'].value.replace(/&nbsp;/g,' ');this.items['text_obj'].value=this.items['text_obj'].value.replace(/\s+?$/,'');}
if(Prototype.Browser.WebKit)
{this.items['text_obj'].value=this.items['text_obj'].value.replace(/<span class="Apple-style-span" style="text-decoration: underline;">([^>]*)<\/span>/gi,"<u>$1</u>");this.items['text_obj'].value=this.items['text_obj'].value.replace(/<span class="Apple-style-span" style="text-decoration: line-through;">([^>]*)<\/span>/gi,"<strike>$1</strike>");}
Debug.write("After: "+this.items['text_obj'].value);return true;}});_editor_std=Class.create({_identifyType:function()
{Debug.write("(Editor "+this.id+") This is the STD class");},editor_set_content:function(init_text)
{var iframe=this.items['text_obj'].up().down('iframe',0);if(!Object.isUndefined(iframe))
{var iframeDims=iframe.getDimensions();$(this.items['text_obj']).setStyle({'width':iframeDims.width,'height':iframeDims.height}).show();$(iframe).setStyle('width: 0px; height: 0px; border: none;');}
this.editor_window=this.items['text_obj'];this.editor_document=this.items['text_obj'];this.editor_box=this.items['text_obj'];if(!Object.isUndefined(init_text)&&init_text!==false)
{this.editor_write_contents(init_text);}
this.editor_document.editor_id=this.id;this.editor_window.editor_id=this.id;if(!Prototype.Browser.IE&&$(this.id+'_cmd_spellcheck')){$(this.id+'_cmd_spellcheck').hide();}
if($(this.id+'_cmd_removeformat')){$(this.id+'_cmd_removeformat').hide();}
if($(this.id+'_cmd_togglesource')){$(this.id+'_cmd_togglesource').hide();}
if($(this.id+'_cmd_justifyfull')){$(this.id+'_cmd_justifyfull').hide();}
if($(this.id+'_cmd_outdent')){$(this.id+'_cmd_outdent').hide();}
if($(this.id+'_cmd_switcheditor')){$(this.id+'_cmd_switcheditor').hide();}},editor_write_contents:function(text)
{if(text!==false)
{this.items['text_obj'].value=text;}},editor_get_contents:function()
{return this.editor_document.value;},apply_formatting:function(cmd,dialog,argument)
{switch(cmd)
{case'bold':case'italic':case'underline':{this.wrap_tags(cmd.substr(0,1),false);return;}
case'justifyleft':case'justifycenter':case'justifyright':{this.wrap_tags(cmd.substr(7),false);return;}
case'indent':{this.wrap_tags(cmd,false);return;}
case'createlink':{var sel=this.get_selection();if(sel)
{this.wrap_tags('url',argument);}
else
{this.wrap_tags('url',argument,argument);}
return;}
case'fontname':{this.wrap_tags('font',argument);return;}
case'fontsize':{this.wrap_tags('size',argument);return;}
case'forecolor':{this.wrap_tags('color',argument);return;}
case'backcolor':{this.wrap_tags('background',argument);return;}
case'insertimage':{this.wrap_tags('img',false,argument);return;}
case'strikethrough':{this.wrap_tags('s',false);return;}
case'superscript':{this.wrap_tags('sup',false);return;}
case'subscript':{this.wrap_tags('sub',false);return;}
case'removeformat':return;}},editor_set_functions:function()
{Event.observe(this.editor_document,'keypress',this.events.editor_document_onkeypress.bindAsEventListener(this));Event.observe(this.editor_window,'focus',this.events.editor_window_onfocus.bindAsEventListener(this));Event.observe(this.editor_window,'blur',this.events.editor_window_onblur.bindAsEventListener(this));},set_context:function()
{},get_selection:function()
{if(!Object.isUndefined(this.editor_document.selectionStart))
{return this.editor_document.value.substr(this.editor_document.selectionStart,this.editor_document.selectionEnd-this.editor_document.selectionStart);}
else if((document.selection&&document.selection.createRange)||this._ie_cache)
{return(!document.selection.createRange().text&&this._ie_cache)?this._ie_cache.text:document.selection.createRange().text;}
else if(window.getSelection)
{return window.getSelection()+'';}
else
{return false;}},insert_text:function(text)
{this.editor_check_focus();if(!Object.isUndefined(this.editor_document.selectionStart))
{var open=this.editor_document.selectionStart+0;var st=this.editor_document.scrollTop;var end=open+text.length;if(Prototype.Browser.Opera)
{var opera_len=text.match(/\n/g);try
{end+=parseInt(opera_len.length);}
catch(e)
{Debug.write("#3 "+e);}}
this.editor_document.value=this.editor_document.value.substr(0,this.editor_document.selectionStart)+text+this.editor_document.value.substr(this.editor_document.selectionEnd);if(!text.match(new RegExp("\\"+this.open_brace+"(\\S+?)"+"\\"+this.close_brace+"\\"+this.open_brace+"/(\\S+?)"+"\\"+this.close_brace)))
{this.editor_document.selectionStart=open;this.editor_document.selectionEnd=end;this.editor_document.scrollTop=st;Debug.write("Insert 0");}
else
{if(Prototype.Browser.Gecko){this.editor_document.scrollTop=st;}}
this.editor_document.setSelectionRange(open,end);Debug.write("Insert 1");}
else if((document.selection&&document.selection.createRange)||this._ie_cache)
{var sel=this._ie_cache?this._ie_cache:document.selection.createRange();sel.text=text.replace(/\r?\n/g,'\r\n');sel.select();Debug.write("Insert 2");}
else
{this.editor_document.value+=text;Debug.write("Insert 3");}
this._ie_cache=null;},insert_emoticon:function(emo_id,emo_image,emo_code,event)
{this.editor_check_focus();emo_code=this.unhtmlspecialchars(emo_code);this.wrap_tags_lite(" "+emo_code," ");},insertorderedlist:function(e)
{this.insertlist('ol');},insertunorderedlist:function(e)
{this.insertlist('ul');},insertlist:function(list_type)
{var open_tag;var close_tag;var item_open_tag='<li>';var item_close_tag='</li>';var regex='';var all_add='';if(this.use_bbcode)
{regex=new RegExp('([\r\n]+|^[\r\n]*)(?!\\[\\*\\]|\\[\\/?list)(?=[^\r\n])','gi');open_tag=list_type=='ol'?'[list=1]\n':'[list]\n';close_tag='[/list]';item_open_tag='[*]';item_close_tag='';}
else
{regex=new RegExp('([\r\n]+|^[\r\n]*)(?!<li>|<\\/?ol|ul)(?=[^\r\n])','gi');open_tag=list_type=='ol'?'<ol>\n':'<ul>\n';close_tag=list_type=='ol'?'</ol>\n':'</ul>\n';}
if(text=this.get_selection())
{text=open_tag+text.replace(regex,"\n"+item_open_tag+'$1'+item_close_tag)+'\n'+close_tag;if(this.use_bbcode)
{text=text.replace(new RegExp('\\[\\*\\][\r\n]+','gi'),item_open_tag);}
this.insert_text(text);}
else
{var to_insert=open_tag;var listitems='';while(val=prompt(ipb.lang['editor_enter_list'],''))
{listitems+=item_open_tag+val+item_close_tag+'\n';}
if(listitems)
{to_insert+=listitems;to_insert+=close_tag;this.insert_text(to_insert);}}},removeformat:function()
{var text=this.get_selection();if(text)
{text=this.strip_html(text);this.insert_text(text);}},unlink:function()
{var text=this.get_selection();var link_regex='';var link_text='';if(text!==false)
{if(text.match(link_regex))
{text=(this.use_bbcode)?text.replace(/\[url=([^\]]+?)\]([^\[]+?)\[\/url\]/ig,"$2"):text.replace(/<a href=['\"]([^\"']+?)['\"]([^>]+?)?>(.+?)<\/a>/ig,"$3");}
this.insert_text(text);}},undo:function()
{this.history_record_state(this.editor_get_contents());this.history_time_shift(-1);if((text=this.history_fetch_recording())!==false)
{this.editor_document.value=text;}},redo:function()
{this.history_time_shift(1);if((text=this.history_fetch_recording())!==false)
{this.editor_document.value=text;}},update_for_form_submit:function(subjecttext,minchars)
{return true;}});if(USE_RTE){Debug.write("Extending with RTE");_type=_editor_rte;}else{Debug.write("Extending with STD");_type=_editor_std;}
_editor.prototype.editor=Class.create(_type,{initialize:function(editor_id,mode,initial_content,options)
{this.id=editor_id;this.is_rte=mode;this.use_bbcode=!mode;this.events=null;this.options=[];this.items=[];this.settings={};this.open_brace='';this.close_brace='';this.allow_advanced=0;this.initialized=0;this.ips_frame_html='';this.forum_fix_ie_newlines=1;this.has_focus=null;this.history_recordings=[];this.history_pointer=-1;this._ie_cache=null;this._showing_html=false;this._loading=false;this.original=$H();this.hidden_objects=[];this.fontoptions=$A();this.sizeoptions=$A();this.font_state=null;this.size_state=null;this.palettes={};this.defaults={};this.key_handlers=[];this.showing_sidebar=false;this.emoticons_loaded=false;this.emoClick=false;this.options=Object.extend({file_path:'',forum_fix_ie_newlines:1,char_set:'UTF-8',ignore_controls:[],button_update:[]},arguments[3]||{});this.button_update=$A(["bold","italic","underline","justifyleft","justifycenter","justifyright","insertorderedlist","insertunorderedlist","superscript","subscript","strikethrough"].concat(this.options.button_update));this.values=ipb.editor_values;this.items['text_obj']=$(this.id+"_textarea");this.items['buttons']=$A();this.items['controls']=$(this.id+'_controls');this.open_brace=this.use_bbcode?'[':'<';this.close_brace=this.use_bbcode?']':'>';this.allow_advanced=this.use_bbcode?0:1;this.doc_body=$$('body')[0];this.events=new _editor_events();this._identifyType();if(this.values.get('bbcodes')&&$(this.id+'_cmd_otherstyles'))
{this.buildCustomStyles();}
if(this.items['text_obj'].up('form')){this.items['text_obj'].up('form').observe('submit',function(e){this.update_for_form_submit();}.bindAsEventListener(this));}
this.init(initial_content);Debug.write("All editor initialization complete");},init:function(initial_text)
{try{if(this.initialized){return;}
if($(this.id+'_wysiwyg_used')){$(this.id+'_wysiwyg_used').value=parseInt(this.is_rte);}
if(ipb.Cookie.get('emoticon_sidebar')=='1'&&$(this.id+'_sidebar'))
{this.buildEmoticons();$(this.id+'_sidebar').show();$('editor_'+this.id).addClassName('with_sidebar');ipb.Cookie.set('emoticon_sidebar',1,1);this.showing_sidebar=true;}
this.ips_frame_html=this.get_frame_html();this.editor_set_content(initial_text);this.editor_set_functions();this.editor_set_controls();this.initialized=true;}
catch(err){Debug.error("#4 "+err);}},buildCustomStyles:function()
{var buttons=false;var other_styles=false;var toolbar=ipb.editor_values.get('templates')['toolbar'].evaluate({'id':this.id,'toolbarid':'3'});$(this.id+'_toolbar_2').insert({after:toolbar});this.init_editor_menu($(this.id+'_cmd_otherstyles'));this.values.get('bbcodes').each(function(bbcode){if(!bbcode.value['image'].blank())
{$(this.id+'_toolbar_3').insert(ipb.editor_values.get('templates')['button'].evaluate({'id':this.id,'cmd':bbcode.key,'title':bbcode.value['title'],'img':bbcode.value['image']}));buttons=true;}
else
{$(this.id+'_popup_otherstyles_menu').insert(ipb.editor_values.get('templates')['menu_item'].evaluate({'id':this.id,'cmd':bbcode.key,'title':bbcode.value['title']}));other_styles=true;}
if(!(bbcode.value['useoption']=='0'&&bbcode.value['single_tag']=='1'))
{var item_wrap=new Element('div',{id:this.id+'_palette_otherstyles_'+bbcode.key});item_wrap.addClassName('ipb_palette').addClassName('extended');item_wrap.writeAttribute("styleid",bbcode.key);var _content=this.values.get('templates')['generic'].evaluate({id:this.id+'_'+bbcode.key,title:bbcode.value['title'],example:bbcode.value['example'],option_text:bbcode.value['menu_option_text']||'',value_text:bbcode.value['menu_content_text']||''});item_wrap.update(_content);this.doc_body.insert({top:item_wrap});if(bbcode.value['useoption']=='0'){item_wrap.select('.optional').invoke('remove');}
if(bbcode.value['single_tag']=='1'){item_wrap.select('.tagcontent').invoke('remove');}
this.palettes['otherstyles_'+bbcode.key]=new ipb.Menu($(this.id+'_cmd_custom_'+bbcode.key),item_wrap,{stopClose:true,offsetX:0,offsetY:42,positionSource:$(this.id+'_cmd_otherstyles')});item_wrap.down('input[type="submit"]').observe('click',this.events.handle_custom_onclick.bindAsEventListener(this));}
$(this.id+'_cmd_custom_'+bbcode.key).observe('click',this.events.handle_custom_command.bindAsEventListener(this,bbcode.key));}.bind(this));if(buttons){$(this.id+'_toolbar_3').show();}
if(other_styles){$(this.id+'_cmd_otherstyles').show();}},resize_to:function(size)
{var afterFinish=function(){};if(Prototype.Browser.Opera&&$(this.id+'_emoticon_holder'))
{var height=$(this.id+'_emoticon_holder').getHeight();var currentSize=(this.is_rte)?$(this.editor_box).getHeight():$(this.items['text_obj']).getHeight();var diff=currentSize-size;var newSize=height-diff;$(this.id+'_emoticon_holder').setStyle('height: '+newSize+'px');var afterFinish=function(e){$(this.id+'_emoticon_holder').setStyle('height: auto;');}.bind(this);}
try{if(this.is_rte)
{new Effect.Morph($(this.editor_box),{style:'height: '+size+'px',duration:0.3,afterFinish:afterFinish});$(this.items['text_obj']).setStyle('height: '+size+'px');}
else
{new Effect.Morph($(this.items['text_obj']),{style:'height: '+size+'px',duration:0.3,afterFinish:afterFinish});if($(this.editor_box)){$(this.editor_box).setStyle('height: '+size+'px');}}}catch(err){Debug.write("#5 "+err);}},get_frame_html:function()
{var ips_frame_html="";ips_frame_html+="<html id=\""+this.id+"_html\">\n";ips_frame_html+="<head>\n";ips_frame_html+="<meta http-equiv=\"content-type\" content=\"text/html; charset="+this.options.char_set+"\" />";ips_frame_html+="<style type='text/css' media='all'>\n";ips_frame_html+="body {\n";ips_frame_html+=" background: #FFFFFF;\n";ips_frame_html+=" margin: 0px;\n";ips_frame_html+=" padding: 4px;\n";ips_frame_html+=" font-family: arial, verdana, tahoma, sans-serif;\n";ips_frame_html+=" font-size: 9pt;\n";ips_frame_html+="}\n";ips_frame_html+="font[size=\"1\"] {\n";ips_frame_html+=" font-size: 9px;\n";ips_frame_html+="}\n";ips_frame_html+="font[size=\"2\"] {\n";ips_frame_html+=" font-size: 13px;\n";ips_frame_html+="}\n";ips_frame_html+="font[size=\"3\"] {\n";ips_frame_html+=" font-size: 15px;\n";ips_frame_html+="}\n";ips_frame_html+="font[size=\"4\"] {\n";ips_frame_html+=" font-size: 17px;\n";ips_frame_html+="}\n";ips_frame_html+="font[size=\"5\"] {\n";ips_frame_html+=" font-size: 21px;\n";ips_frame_html+="}\n";ips_frame_html+="font[size=\"6\"] {\n";ips_frame_html+=" font-size: 26px;\n";ips_frame_html+="}\n";ips_frame_html+="font[size=\"7\"] {\n";ips_frame_html+=" font-size: 36px;\n";ips_frame_html+="}\n";ips_frame_html+="</style>\n";if(isRTL&&rtlFull)
{ips_frame_html+="<link rel='stylesheet' type='text/css' media='screen' href='"+rtlFull+"' />\n";if(rtlIe&&Prototype.Browser.IE)
{ips_frame_html+="<!--[if lte IE 7]>\n";ips_frame_html+="<link rel='stylesheet' type='text/css' media='screen' href='"+rtlIe+"' />\n";ips_frame_html+="<![endif]-->\n";}}
ips_frame_html+="</head>\n";ips_frame_html+="<body class='withRTL'>\n";ips_frame_html+="{:content:}\n";ips_frame_html+="</body>\n";ips_frame_html+="</html>";return ips_frame_html;},editor_check_focus:function()
{if(this.is_rte)
{Debug.write("Focussing RTE");try{this.editor_window.focus();}catch(err){Debug.write("Could not focus editor window");}}
else
{Debug.write("Focussing STD Textarea");if(!this._ie_cache)
{this.items['text_obj'].focus();}}},editor_set_controls:function()
{controls=$(this.id+'_controls').select('.rte_control').each(function(elem)
{if(!elem.id){return;}
if(this.options.ignore_controls.include(elem.id.toLowerCase())){return;}
if(elem.hasClassName('rte_button')){this.init_editor_button(elem);}else if(elem.hasClassName('rte_menu')&&!elem.hasClassName('rte_special')){this.init_editor_menu(elem);}else if(elem.hasClassName('rte_palette')){this.init_editor_palette(elem);}else{return;}
this.set_control_unselectable(elem);}.bind(this));if($(this.id+'_resizer')){this.init_editor_button($(this.id+'_cmd_r_small'));this.set_control_unselectable($(this.id+'_cmd_r_small'));this.init_editor_button($(this.id+'_cmd_r_big'));this.set_control_unselectable($(this.id+'_cmd_r_big'));}},set_button_context:function(obj,state,type)
{if(this._showing_html){return false;}
if(Object.isUndefined(type)){type='button';}
if(state=='mousedown'&&(obj.readAttribute('cmd')=='undo'||obj.readAttribute('cmd')=='redo')){return false;}
switch(obj.readAttribute('state'))
{case'true':{switch(state)
{case'mouseout':this.editor_set_ctl_style(obj,'button','selected');break;case'mouseover':case'mousedown':case'mouseup':this.editor_set_ctl_style(obj,type,'down');break;}
break;}
default:{switch(state)
{case'mouseout':this.editor_set_ctl_style(obj,type,'normal');break;case'mousedown':this.editor_set_ctl_style(obj,type,'down');break;case'mouseover':case'mouseup':this.editor_set_ctl_style(obj,type,'hover');break;}
break;}}},editor_set_ctl_style:function(obj,type,mode)
{if(obj.readAttribute('mode')==mode){return;}
var extra='';if(type=='menu'){extra='_menu';}else if(type=='menubutton'){extra='_menubutton';}
extra+=obj.readAttribute('colorname')?'_color':'';extra+=obj.readAttribute('emo_id')?'_emo':'';obj.writeAttribute('mode',mode);try
{switch(mode)
{case"normal":obj.addClassName('rte_normal'+extra).removeClassName('rte_hover').removeClassName('rte_selected');break;case"hover":obj.addClassName('rte_hover'+extra).removeClassName('rte_normal').removeClassName('rte_selected');break;case"selected":case"down":obj.addClassName('rte_selected'+extra).removeClassName('rte_normal').removeClassName('rte_hover');break;}}
catch(err)
{Debug.write("#6 "+err);}},set_control_unselectable:function(elem)
{if(!$(elem)){return;}
$(elem).descendants().each(function(dec){dec.writeAttribute('unselectable','on');});$(elem).writeAttribute('unselectable','on');},init_editor_button:function(elem)
{elem.writeAttribute('cmd',elem.id.replace(this.id+'_cmd_',''));elem.writeAttribute('editor_id',this.id);this.items['buttons'][elem.readAttribute('cmd')]=elem;elem.writeAttribute('state',false);elem.writeAttribute('mode','normal');elem.writeAttribute('real_type','button');elem.observe('click',this.events.button_onmouse_event.bindAsEventListener(this));elem.observe('mousedown',this.events.button_onmouse_event.bindAsEventListener(this));elem.observe('mouseover',this.events.button_onmouse_event.bindAsEventListener(this));elem.observe('mouseout',this.events.button_onmouse_event.bindAsEventListener(this));},init_editor_menu:function(elem)
{elem.writeAttribute('cmd',elem.id.replace(this.id+'_cmd_',''));elem.writeAttribute('editor_id',this.id);this.items['buttons'][elem.readAttribute('cmd')]=elem;var wrap=new Element('ul',{id:this.id+'_popup_'+elem.readAttribute('cmd')+'_menu'});wrap.writeAttribute('cmd',elem.readAttribute('cmd')).addClassName('ipbmenu_content');wrap.hide();if(elem.hasClassName('rte_font'))
{this.fontoptions['_default']=elem.innerHTML;ipb.editor_values.get('primary_fonts').each(function(font){var item=new Element('li',{'id':this.id+'_fontoption_'+font.key});item.setStyle('font-family: "'+font.value+'"; cursor: pointer').addClassName('fontitem');item.update(font.value);$(item).observe('click',this.events.font_format_option_onclick.bindAsEventListener(this));wrap.insert(item);this.fontoptions[font.key]=item;}.bind(this));elem.insert({after:wrap});}
else if(elem.hasClassName('rte_fontsize'))
{this.sizeoptions['_default']=elem.innerHTML;ipb.editor_values.get('font_sizes').each(function(size){var item=new Element('li',{id:this.id+'_sizeoption_'+size});item.setStyle('font-size: '+this.convert_size(size,1)+'px; cursor: pointer').addClassName('fontitem');item.update(size);$(item).observe('click',this.events.font_format_option_onclick.bindAsEventListener(this));wrap.insert(item);wrap.addClassName("fontsizes");this.sizeoptions.push(size);}.bind(this));elem.insert({after:wrap});}
else if(elem.hasClassName('rte_special'))
{elem.insert({after:wrap});}
var beforeOpen=function(menu){this.editor_check_focus();this.preserve_ie_range();Debug.write("Preserved IE Range");}.bind(this);new ipb.Menu($(elem),wrap,{},{beforeOpen:beforeOpen});},init_editor_palette:function(elem)
{elem.writeAttribute('cmd',elem.id.replace(this.id+'_cmd_',''));elem.writeAttribute('editor_id',this.id);this.items['buttons'][elem.readAttribute('cmd')]=elem;wrap=new Element('div',{id:this.id+'_palette_'+elem.readAttribute('cmd')});wrap.writeAttribute('cmd',elem.readAttribute('cmd')).addClassName('ipb_palette');wrap.hide();opt={};var handleReturn=false;switch(elem.readAttribute('cmd'))
{case'forecolor':case'backcolor':var table=new Element('table',{id:this.id+'_'+elem.readAttribute('cmd')+'_palette'}).addClassName('rte_colors');var tbody=new Element('tbody');table.insert(tbody);var tr=null;var td=null;var color='';for(i=0;i<ipb.editor_values.get('colors').length;i++)
{color=ipb.editor_values.get('colors')[i];if(i%ipb.editor_values.get('colors_perrow')==0){tr=new Element('tr');tbody.insert(tr);}
td=new Element('td',{id:this.id+'_'+elem.readAttribute('cmd')+'_color_'+color});td.setStyle('background-color: #'+color).setStyle('background-image: none').writeAttribute('colorname',color);tr.insert(td);$(td).observe('click',this.events.color_cell_onclick.bindAsEventListener(this));}
wrap.insert(table).addClassName('color_palette');elem.insert({after:wrap});break;case'link':case'image':case'email':case'media':if(Object.isUndefined(ipb.editor_values.get('templates')[elem.readAttribute('cmd')]))
{elem.hide();return;}
try{wrap.update(ipb.editor_values.get('templates')[elem.readAttribute('cmd')].evaluate({id:this.id}));wrap.down('input[type="submit"]').observe('click',this.events.palette_submit.bindAsEventListener(this));}catch(err){Debug.write("#7 "+err);}
this.doc_body.insert({top:wrap});if(elem.readAttribute('cmd')=='link')
{try{this.defaults['link_text']=$F(this.id+'_urltext');this.defaults['link_url']=$F(this.id+'_url');}catch(err){Debug.write("#8 "+err);}
$(elem).observe('click',this.events.link_onclick.bindAsEventListener(this));}
if(elem.readAttribute('cmd')=='image')
{try{this.defaults['img']=$F(this.id+'_img');}catch(err){Debug.write("#15 "+err);}
$(elem).observe('click',this.events.image_onclick.bindAsEventListener(this));}
if(elem.readAttribute('cmd')=='email')
{try{this.defaults['email_text']=$F(this.id+'_emailtext');this.defaults['email']=$F(this.id+'_email');}catch(err){Debug.write("#8 "+err);}
$(elem).observe('click',this.events.email_onclick.bindAsEventListener(this));}
if(elem.readAttribute('cmd')=='media')
{try{this.defaults['media']=$F(this.id+'_media');}catch(err){Debug.write("#17 "+err);}
$(elem).observe('click',this.events.media_onclick.bindAsEventListener(this));}
this.key_handlers[elem.readAttribute('cmd')]=false;break;default:this.items['buttons'][elem.readAttribute('cmd')]=null;elem.hide();wrap.remove();break;}
if(elem.readAttribute('title'))
{title=new Element('div');title.update(elem.readAttribute('title')).addClassName('rte_title');wrap.insert({top:title});}
if(!elem.readAttribute('cmd').endsWith('color')){opt={stopClose:true};}
$(elem).observe('mouseover',this.events.palette_button_onmouseover.bindAsEventListener(this));$(elem).observe('mouseover',this.events.palette_onmouse_event.bindAsEventListener(this));$(elem).observe('mouseout',this.events.palette_onmouse_event.bindAsEventListener(this));var beforeOpen=function(menu){this.editor_check_focus();this.preserve_ie_range();Debug.write("Preserved IE Range");}.bind(this);this.palettes[elem.readAttribute('cmd')]=new ipb.Menu($(elem),wrap,opt,{beforeOpen:beforeOpen});},convert_size:function(size,type)
{if(type==1)
{switch(size)
{case 1:return 9;break;case 2:return 13;break;case 3:return 15;break;case 4:return 17;break;case 5:return 21;break;case 6:return 26;break;case 7:return 36;break;default:return 13;}}else{switch(size)
{case'7.5pt':case'9px':return 1;case'13px':return 2;case'15px':return 3;case'17px':return 4;case'21px':return 5;case'26px':return 6;case'36px':return 7;default:return'';}}},format_text:function(e,command,arg)
{if(command.startsWith('resize_')){}
if(command=='switcheditor'){try{ipb.switchEditor(this.id);}catch(err){Debug.error("#9 "+err);}}
if(!this.is_rte&&command!='redo'){this.history_record_state(this.editor_get_contents());}
this.editor_check_focus();if(this[command])
{var return_val=this[command](e);}
else
{try
{var return_val=this.apply_formatting(command,false,(typeof arg=='undefined'?true:arg));}
catch(e)
{Debug.warn("#10 "+e);var return_val=false;}}
if(!this.is_rte&&command!='undo'){this.history_record_state(this.editor_get_contents());}
this.set_context(command);this.editor_check_focus();return return_val;},spellcheck:function()
{if(!Prototype.Browser.IE){return;}
try{if(this.rte_mode){var tmpis=new ActiveXObject("ieSpell.ieSpellExtension").CheckDocumentNode(this.editor_document);}else{var tmpis=new ActiveXObject("ieSpell.ieSpellExtension").CheckAllLinkedDocuments(this.editor_document);}}catch(exception){if(exception.number==-2146827859){if(confirm(ipb.lang['js_rte_erroriespell']?ipb.lang['js_rte_erroriespell']:"ieSpell not detected.  Click Ok to go to download page."))
{window.open("http://www.iespell.com/download.php","Download");}}
else
{alert(ipb.lang['js_rte_errorloadingiespell']?ipb.lang['js_rte_errorloadingiespell']:"Error Loading ieSpell: Exception "+exception.number);}}},wrap_tags:function(tag_name,has_option,selected_text)
{var tag_close=tag_name;if(!this.use_bbcode)
{switch(tag_name)
{case'url':tag_name='a href';tag_close='a';break;case'email':tag_name='a href';tag_close='a';has_option='mailto:'+has_option;break;case'img':tag_name='img src';tag_close='';break;case'font':tag_name='font face';tag_close='font';break;case'size':tag_name='font size';tag_close='font';break;case'color':tag_name='font color';tag_close='font';break;case'background':tag_name='font bgcolor';tag_close='font';break;case'indent':tag_name=tag_close='blockquote';break;case'left':case'right':case'center':has_option=tag_name;tag_name='div align';tag_close='div';break;}}
if(Object.isUndefined(selected_text))
{selected_text=this.get_selection();selected_text=(selected_text===false)?'':new String(selected_text);}
if(has_option===true)
{var option=prompt(ips_language_arrayp['js_rte_optionals']?ips_language_arrayp['js_rte_optionals']:"Enter the optional arguments for this tag",'');if(option)
{var opentag=this.open_brace+tag_name+'="'+option+'"'+this.close_brace;}
else
{return false;}}
else if(has_option!==false)
{var opentag=this.open_brace+tag_name+'="'+has_option+'"'+this.close_brace;}
else
{var opentag=this.open_brace+tag_name+this.close_brace;}
var closetag=(tag_close!='')?this.open_brace+'/'+tag_close+this.close_brace:'';var text=opentag+selected_text+closetag;this.insert_text(text);return false;},wrap_tags_lite:function(start_text,close_text,replace_selection)
{selected_text='';if(Object.isUndefined(replace_selection)||replace_selection==0)
{selected_text=this.get_selection();selected_text=(selected_text===false)?'':new String(selected_text);}
this.insert_text(start_text+selected_text+close_text);return false;},preserve_ie_range:function()
{if(Prototype.Browser.IE&&document.selection&&!this.emoClick)
{this._ie_cache=this.is_rte?(this.editor_document.selection.createRange)?this.editor_document.selection.createRange():null:document.selection.createRange();Debug.write("Preserved IE Range: ");this.emoClick=false;}},clean_html:function(t)
{if(t.blank()||Object.isUndefined(t))
{return t;}
t=t.replace(/<br>/ig,"<br />");t=t.replace(/<p>(\s+?)?<\/p>/ig,"");t=t.replace(/<p><hr \/><\/p>/ig,"<hr />");t=t.replace(/<p>&nbsp;<\/p><hr \/><p>&nbsp;<\/p>/ig,"<hr />");t=t.replace(/<(p|div)([^&]*)>/ig,"\n<$1$2>\n");t=t.replace(/<\/(p|div)([^&]*)>/ig,"\n</$1$2>\n");t=t.replace(/<br \/>(?!<\/td)/ig,"<br />\n");t=t.replace(/<\/(td|tr|tbody|table)>/ig,"</$1>\n");t=t.replace(/<(tr|tbody|table(.+?)?)>/ig,"<$1>\n");t=t.replace(/<(td(.+?)?)>/ig,"\t<$1>");t=t.replace(/<p>&nbsp;<\/p>/ig,"<br />");t=t.replace(/<br \/>/ig,"<br />\n");t=t.replace(/<br>/ig,"<br />\n");t=t.replace(/<td><br \/>\n<\/td>/ig,"<td><br /></td>");t=t.replace(/<script/g,"&lt;script");t=t.replace(/<\/script>/g,"&lt;/script&gt;");t=t.replace(/^[\s\n\t]+/g,'');t=t.replace(/[\s\n\t]+$/g,'');t=t.replace(/<br \/>$/g,'');return t;},strip_empty_html:function(html)
{html=html.replace('<([^>]+?)></([^>]+?)>',"");return html;},strip_html:function(html)
{html=html.replace(/<\/?([^>]+?)>/ig,"");return html;},history_record_state:function(content)
{if(this.history_recordings[this.history_pointer]!=content)
{this.history_pointer++;this.history_recordings[this.history_pointer]=content;if(!Object.isUndefined(this.history_recordings[this.history_pointer+1]))
{this.history_recordings[this.history_pointer+1]=null;}}},unhtmlspecialchars:function(html)
{html=html.replace(/&quot;/g,'"');html=html.replace(/&lt;/g,'<');html=html.replace(/&gt;/g,'>');html=html.replace(/&amp;/g,'&');return html;},htmlspecialchars:function(html)
{html=html.replace(/&/g,"&amp;");html=html.replace(/"/g,"&quot;");html=html.replace(/</g,"&lt;");html=html.replace(/>/g,"&gt;");return html;},history_time_shift:function(inc)
{var i=this.history_pointer+inc;if(i>=0&&this.history_recordings[i]!=null&&typeof this.history_recordings[i]!='undefined')
{this.history_pointer+=inc;}},history_fetch_recording:function()
{if(!Object.isUndefined(this.history_recordings[this.history_pointer])&&this.history_recordings[this.history_pointer]!=null)
{return this.history_recordings[this.history_pointer];}
else
{return false;}},ipb_quote:function()
{this.wrap_tags_lite('[quote]','[/quote]',0);},ipb_code:function()
{this.wrap_tags_lite('[code]','[/code]',0);},toggleEmoticons:function(e)
{if(this.showing_sidebar)
{$(this.id+'_sidebar').hide();$('editor_'+this.id).removeClassName('with_sidebar');ipb.Cookie.set('emoticon_sidebar',0,0);this.showing_sidebar=false;}
else
{if(this.emoticons_loaded)
{$(this.id+'_emoticon_holder').show();}
else
{this.buildEmoticons();}
$(this.id+'_sidebar').show();$('editor_'+this.id).addClassName('with_sidebar');ipb.Cookie.set('emoticon_sidebar',1,1);this.showing_sidebar=true;}},buildEmoticons:function()
{var table=new Element('table',{id:this.id+'_emoticons_palette'}).addClassName('rte_emoticons');var tbody=new Element('tbody');table.insert(tbody);var perrow=2;var classname='1';var i=0;ipb.editor_values.get('emoticons').each(function(emote){if(i%perrow==0)
{tr=new Element('tr').addClassName('row'+classname);tbody.insert(tr);classname=(classname=='1')?'2':'1';}
i++;var _tmp=emote.value.split(',');var img=new Element('img',{id:'smid_'+_tmp[0],src:ipb.vars['emoticon_url']+'/'+_tmp[1]});td=new Element('td',{id:this.id+'_emoticons_emote_'+_tmp[0]}).setStyle('cursor: pointer; text-align: center').addClassName('emote');td.writeAttribute('emo_id',_tmp[0]);td.writeAttribute('emo_img',_tmp[1]);td.writeAttribute('emo_code',emote.key);td.insert(img);tr.insert(td);$(td).observe('click',this.events.emoticon_onclick.bindAsEventListener(this));}.bind(this));$(this.id+'_emoticon_holder').update(table).show();this.emoticons_loaded=true;if($(this.id+'_showall_emoticons')){$(this.id+'_showall_emoticons').observe('click',this.showAllEmoticons.bindAsEventListener(this));}
if($(this.id+'_close_sidebar')){$(this.id+'_close_sidebar').observe('click',this.toggleEmoticons.bindAsEventListener(this));}},showAllEmoticons:function(e)
{if(Object.isUndefined(inACP)||inACP==false){var url=ipb.vars['base_url'];}else{var url=ipb.vars['front_url'];}
url+="app=forums&amp;module=ajax&amp;section=emoticons&amp;editor_id="+this.id+"&amp;secure_key="+ipb.vars['secure_hash'];new Ajax.Request(url.replace(/&amp;/g,'&'),{method:'get',onSuccess:function(t)
{$(this.id+'_emoticon_holder').update(t.responseText);if($(this.id+'_showall_bar')){$(this.id+'_showall_bar').hide();$(this.id+'_emoticon_holder').addClassName('no_bar');}}.bind(this)});}});if((Prototype.Browser.Gecko||Prototype.Browser.WebKit)&&USE_RTE){_editor.prototype.editor.prototype.ORIGINAL_editor_set_content=_editor.prototype.editor.prototype.editor_set_content;_editor.prototype.editor.prototype.ORIGINAL_apply_formatting=_editor.prototype.editor.prototype.apply_formatting;Debug.write("Adding mozilla-specific methods");_editor.prototype.editor.addMethods({_moz_test:function()
{return"Test: "+this.id;},togglesource_pre_show_html:function()
{this.editor_document.designMode='off';},togglesource_post_show_html:function()
{this.editor_document.designMode='on';},editor_set_content:function(initial_text)
{this.ORIGINAL_editor_set_content(initial_text);Event.observe(this.editor_document,'keypress',this.events.editor_document_onkeypress.bindAsEventListener(this));if($(this.id+'_cmd_spellcheck')){$(this.id+'_cmd_spellcheck').hide();this.hidden_objects[this.id+'_cmd_spellcheck']=1;}
if(this.use_bbcode&&$(this.id+'_cmd_justifyfull'))
{$(this.id+'_cmd_justifyfull').hide();this.hidden_objects[this.id+'_cmd_justifyfull']=1;}
try
{var _y=parseInt(window.pageYOffset);this.editor_document.execCommand("inserthtml",false," ");this.editor_document.execCommand("undo",false,null);scroll(0,_y);}
catch(error)
{Debug.write("#11 "+error);}},editor_set_functions:function()
{Event.observe(this.editor_document,'mouseup',this.events.editor_document_onmouseup.bindAsEventListener(this));Event.observe(this.editor_document,'keyup',this.events.editor_document_onkeyup.bindAsEventListener(this));Event.observe(this.editor_document,'keydown',this.events.editor_document_onkeydown.bindAsEventListener(this));Event.observe(this.editor_window,'focus',this.events.editor_window_onfocus.bindAsEventListener(this));Event.observe(this.editor_window,'blur',this.events.editor_window_onblur.bindAsEventListener(this));},apply_formatting:function(cmd,dialog,arg)
{if(cmd!='redo')
{this.editor_document.execCommand("inserthtml",false," ");this.editor_document.execCommand("undo",false,null);}
this.editor_document.execCommand('useCSS',false,true);this.editor_document.execCommand('styleWithCSS',false,false);return this.ORIGINAL_apply_formatting(cmd,dialog,arg);},get_selection:function()
{var selection=this.editor_window.getSelection();this.editor_check_focus();var range=selection?selection.getRangeAt(0):this.editor_document.createRange();return this.moz_read_nodes(range.cloneContents(),false);},moz_add_range:function(node,text_length)
{this.editor_check_focus();var sel=this.editor_window.getSelection();var range=this.editor_document.createRange();range.selectNodeContents(node);if(text_length)
{range.setEnd(node,text_length);range.setStart(node,text_length);}
sel.removeAllRanges();sel.addRange(range);},moz_read_nodes:function(root,toptag)
{var html="";var moz_check=/_moz/i;switch(root.nodeType)
{case Node.ELEMENT_NODE:case Node.DOCUMENT_FRAGMENT_NODE:{var closed;if(toptag)
{closed=!root.hasChildNodes();html='<'+root.tagName.toLowerCase();var attr=root.attributes;for(var i=0;i<attr.length;++i)
{var a=attr.item(i);if(!a.specified||a.name.match(moz_check)||a.value.match(moz_check))
{continue;}
html+=" "+a.name.toLowerCase()+'="'+a.value+'"';}
html+=closed?" />":">";}
for(var i=root.firstChild;i;i=i.nextSibling)
{html+=this.moz_read_nodes(i,true);}
if(toptag&&!closed)
{html+="</"+root.tagName.toLowerCase()+">";}}
break;case Node.TEXT_NODE:{html=this.htmlspecialchars(root.data);}
break;}
return html;},moz_goto_parent_then_body:function(n)
{var o=n;while(n.parentNode!=null&&n.parentNode.nodeName=='HTML')
{n=n.parentNode;}
if(n)
{for(var c=0;c<n.childNodes.length;c++)
{if(n.childNodes[c].nodeName=='BODY')
{return n.childNodes[c];}}}
return o;},moz_insert_node_at_selection:function(text,text_length)
{this.editor_check_focus();var sel=this.editor_window.getSelection();var range=sel?sel.getRangeAt(0):this.editor_document.createRange();sel.removeAllRanges();range.deleteContents();var node=range.startContainer;var pos=range.startOffset;text_length=text_length?text_length:0;if(node.nodeName=='HTML')
{node=this.moz_goto_parent_then_body(node);}
switch(node.nodeType)
{case Node.ELEMENT_NODE:{if(text.nodeType==Node.DOCUMENT_FRAGMENT_NODE)
{selNode=text.firstChild;}
else
{selNode=text;}
node.insertBefore(text,node.childNodes[pos]);this.moz_add_range(selNode,text_length);}
break;case Node.TEXT_NODE:{if(text.nodeType==Node.TEXT_NODE)
{var text_length=pos+text.length;node.insertData(pos,text.data);range=this.editor_document.createRange();range.setEnd(node,text_length);range.setStart(node,text_length);sel.addRange(range);}
else
{node=node.splitText(pos);var selNode;if(text.nodeType==Node.DOCUMENT_FRAGMENT_NODE)
{selNode=text.firstChild;}
else
{selNode=text;}
node.parentNode.insertBefore(text,node);this.moz_add_range(selNode,text_length);}}
break;}
sel.removeAllRanges();},insert_text:function(str,len)
{fragment=this.editor_document.createDocumentFragment();holder=this.editor_document.createElement('span');holder.innerHTML=str;while(holder.firstChild){fragment.appendChild(holder.firstChild);}
var my_length=parseInt(len)>0?len:0;this.moz_insert_node_at_selection(fragment,my_length);},insert_emoticon:function(emo_id,emo_image,emo_code,event)
{this.editor_check_focus();try
{var _emo_url=ipb.vars['emoticon_url']+"/"+emo_image;this.editor_document.execCommand('InsertImage',false,_emo_url);var images=this.editor_document.getElementsByTagName('img');if(images.length>0)
{for(var i=0;i<=images.length;i++)
{if(!Object.isUndefined(images[i])&&images[i].src.match(new RegExp(_emo_url+"$")))
{if(!images[i].getAttribute('alt'))
{images[i].setAttribute('alt',this.unhtmlspecialchars(emo_code));images[i].setAttribute('class','bbc_emoticon');}}}}}
catch(error)
{Debug.write("#12 "+error);}
if(this.emoticon_window_id!=''&&typeof(this.emoticon_window_id)!='undefined')
{this.emoticon_window_id.focus();}}});};if(Prototype.Browser.Opera&&USE_RTE){_editor.prototype.editor.prototype.ORIGINAL_editor_set_content=_editor.prototype.editor.prototype.editor_set_content;_editor.prototype.editor.addMethods({editor_set_content:function(initial_text)
{this.ORIGINAL_editor_set_content(initial_text);this.editor_document.body.style.height='95%';Event.observe(this.editor_document,'keypress',this.events.editor_document_onkeypress.bindAsEventListener(this));$(this.id+'_cmd_spellcheck').hide();this.hidden_objects[this.id+'_cmd_spellcheck']=1;if(this.use_bbcode)
{$(this.id+'_cmd_justifyfull').hide();this.hidden_objects[this.id+'_cmd_justifyfull']=1;}
try
{var _y=parseInt(window.pageYOffset);this.editor_document.execCommand("inserthtml",false,"-");this.editor_document.execCommand("undo",false,null);scroll(0,_y);}
catch(error)
{Debug.write("#13 "+error);}},insert_text:function(str)
{this.editor_document.execCommand('insertHTML',false,str);},get_selection:function()
{var selection=this.editor_window.getSelection();this.editor_check_focus();var range=selection?selection.getRangeAt(0):this.editor_document.createRange();var lsserializer=document.implementation.createLSSerializer();return lsserializer.writeToString(range.cloneContents());},editor_set_functions:function()
{Event.observe(this.editor_document,'mouseup',this.events.editor_document_onmouseup.bindAsEventListener(this));Event.observe(this.editor_document,'keyup',this.events.editor_document_onkeyup.bindAsEventListener(this));Event.observe(this.editor_window,'focus',this.events.editor_window_onfocus.bindAsEventListener(this));Event.observe(this.editor_window,'blur',this.events.editor_window_onblur.bindAsEventListener(this));}});}
_editor_events=Class.create({handle_custom_command:function(e,cmd)
{Event.stop(e);var elem=($(Event.element(e)).hasClassName('specialitem'))?$(Event.element(e)):$(Event.element(e)).up('.specialitem');if(!$(elem)){return;}
var cmd=$(elem).id.replace(this.id+'_cmd_custom_','');var info=this.values.get('bbcodes').get(cmd);Debug.write(cmd);if(info['single_tag']=='1'&&info['useoption']=='0')
{this.wrap_tags_lite('['+info['tag']+']','',1);ipb.menus.registered.get(this.id+'_cmd_otherstyles').doClose();return;}
else
{var selection=this.get_selection();try{window.setTimeout(function()
{if(info['useoption']=='1'&&info['single_tag']=='1')
{if($(this.id+'_'+cmd+'_option')){$(this.id+'_'+cmd+'_option').focus();}}
else
{if(selection)
{$(this.id+'_'+cmd+'_text').value=selection;}
if($(this.id+'_'+cmd+'_option')){$(this.id+'_'+cmd+'_option').focus();}else{$(this.id+'_'+cmd+'_text').activate();}}}.bind(this),200);}catch(err){Debug.write(err);}}},handle_custom_onclick:function(e)
{Debug.write("Here 5");var elem=Event.element(e);if(!elem.hasClassName('ipb_palette')){elem=Event.findElement(e,'.ipb_palette');}
var styleid=elem.readAttribute("styleid");if(!styleid||Object.isUndefined(this.values.get('bbcodes').get(styleid))){return;}
var info=this.values.get('bbcodes').get(styleid);Debug.write("Here 4");if(info['useoption']=='1'&&info['optional_option']=='0'&&$F(this.id+'_'+styleid+'_option').blank())
{alert(ipb.lang['option_is_empty']);try{$(this.id+'_'+styleid+'_option').focus();}catch(err){}
return;}
Debug.write("Here 3");if(info['useoption']=='1'&&info['single_tag']=='1')
{var option=$F(this.id+'_'+styleid+'_option');if(info['optional_option']=='1'&&option.blank()){this.wrap_tags_lite('['+info['tag']+']','',1);}else{this.wrap_tags_lite('['+info['tag']+"='"+option+"']",'',1);}}
else
{Debug.write("Here 1");var value=$F(this.id+'_'+styleid+'_text');Debug.write("Here 2");var option=($(this.id+'_'+styleid+'_option'))?$F(this.id+'_'+styleid+'_option'):'';if(USE_RTE)
{value=value.replace(/\n/g,'<br />');}
if((info['optional_option']=='1'&&option.blank())||info['useoption']=='0'){this.wrap_tags_lite('['+info['tag']+']'+value,'[/'+info['tag']+']',1);}else{this.wrap_tags_lite('['+info['tag']+"='"+option+"']"+value,'[/'+info['tag']+']',1);}}
this.palettes['otherstyles_'+styleid].doClose();},editor_document_onmouseup:function(e)
{Debug.write("Mouse up");ipb.menus.closeAll();this.set_context();if(Prototype.Browser.IE)
{}},editor_document_onkeyup:function(e)
{this.set_context();},editor_document_onkeydown:function(e)
{if(this.forum_fix_ie_newlines&&Prototype.Browser.IE&&e.keyCode==Event.KEY_RETURN)
{var _test=['Indent','Outdent','JustifyLeft','JustifyCenter','JustifyRight','InsertOrderedList','InsertUnorderedList'];for(i=0;i<_test.length;i++)
{if(this.editor_document.queryCommandState(_test[i]))
{return true;}}
var sel=this.editor_document.selection;var ts=this.editor_document.selection.createRange();var t=ts.htmlText.replace(/<p([^>]*)>(.*)<\/p>/i,'$2');if((sel.type=="Text"||sel.type=="None"))
{ts.pasteHTML("<br />"+t+"\n");}
else
{this.editor_document.innerHTML+="<br />\n";}
this.editor_window.event.returnValue=false;ts.select();this.editor_check_focus();}},editor_document_onkeypress:function(e)
{if(e.ctrlKey)
{switch(String.fromCharCode(e.charCode).toLowerCase())
{case'b':cmd='bold';break;case'i':cmd='italic';break;case'u':cmd='underline';break;default:return;}
Event.stop(e);this.apply_formatting(cmd,false,null);return false;}},editor_window_onfocus:function(e)
{this.has_focus=true;},editor_window_onblur:function(e)
{this.has_focus=false;},button_onmouse_event:function(e)
{if(!Event.element(e).hasClassName('rte_control')){elem=$(Event.element(e)).up('.rte_control');}else{elem=Event.element(e);}
Debug.write(elem.readAttribute('cmd'));if(e.type=='click')
{if(elem.readAttribute('cmd').startsWith('custom_'))
{return;}
else if(elem.readAttribute('cmd')=='help')
{if(inACP)
{window.open(ipb.vars['front_url']+"&app=forums&module=extras&section=legends&do=bbcode","bbcode","status=0,toolbar=0,width=1024,height=800,scrollbars=1");}
else
{window.open(ipb.vars['base_url']+"&app=forums&module=extras&section=legends&do=bbcode","bbcode","status=0,toolbar=0,width=1024,height=800,scrollbars=1");}
Event.stop(e);return false;}
else if(elem.readAttribute('cmd').startsWith('r_'))
{var editorSize=$(this.id+'_textarea').getHeight();if(elem.readAttribute('cmd')=='r_small'){this.resize_to(editorSize-100);}else{this.resize_to(editorSize+100);}}
else if(elem.readAttribute('cmd')=='emoticons')
{this.toggleEmoticons(e);}
else
{this.format_text(e,elem.readAttribute('cmd'),false,true);}}
Event.stop(e);this.set_button_context(elem,e.type);},font_format_option_onclick:function(e)
{if(!Event.element(e).hasClassName('fontitem')){elem=Event.element(e).up('.fontitem');}else{elem=Event.element(e);}
cmd=$(elem).up('.ipbmenu_content').readAttribute('cmd');this.format_text(e,cmd,elem.innerHTML);},color_cell_onclick:function(e)
{elem=Event.element(e);cmd=$(elem).up('.ipb_palette').readAttribute('cmd');this.format_text(e,cmd,'#'+elem.readAttribute('colorname'));this.palettes[cmd].doClose();},palette_button_onmouseover:function(e)
{if(!Event.element(e).hasClassName('rte_palette')){elem=$(Event.element(e)).up('.rte_palette');}else{elem=Event.element(e);}
elem.setStyle('cursor: pointer;');},palette_onmouse_event:function(e)
{if(!Event.element(e).hasClassName('rte_control')){elem=$(Event.element(e)).up('.rte_control');}else{elem=Event.element(e);}
if(e.type=='mouseover'){$(elem).addClassName('rte_hover');}else{$(elem).removeClassName('rte_hover');}},palette_return_key:function(e)
{},palette_submit:function(e)
{elem=Event.element(e);palette=elem.up('.ipb_palette');if(!palette){return;}
cmd=palette.readAttribute('cmd');Debug.write($(elem).id+" "+$(palette).id+" "+cmd);switch(cmd)
{case'link':var url=$F(this.id+'_url');var text=$F(this.id+'_urltext');if(url=='http://'||url.blank()){return;};if(text.blank()){text=url;}
this.wrap_tags('url',url,text);break;case'image':var img=$F(this.id+'_img');if(img=='http://'||img.blank()){return;};if(!this.is_rte){this.wrap_tags('img',false,img);}else{this.wrap_tags('img',img,'');}
break;case'email':var email=$F(this.id+'_email');var text=$F(this.id+'_emailtext');if(email.blank()||email.indexOf('@')==-1){return;}
if(text.blank()){text=email;}
this.wrap_tags('email',email,text);break;case'media':var url=$F(this.id+'_media');if(url.blank()){return;}
if(!this.is_rte){this.wrap_tags('media',false,url);}else{this.wrap_tags_lite('[media]'+url,'[/media]');}
break;}
this.palettes[cmd].doClose();},emoticon_onclick:function(e)
{Event.stop(e);var elem=Event.element(e);var emo=elem.up('.emote');if(!emo)
{return false;}
this.insert_emoticon(emo.readAttribute('emo_id'),emo.readAttribute('emo_img'),emo.readAttribute('emo_code'),e);},link_onclick:function(e)
{var selection=this.get_selection();var _active=null;try{if(selection)
{Debug.write("**selection: "+selection);if(selection.match(/<img/)||selection.match(/\[img\]/))
{if(!this.is_rte)
{selection=selection.gsub(/<img src=['"]([^'"]+?)['"]\s+?\/>/,function(match){return"[img]"+match[1]+"[/img]";});}
$(this.id+'_url').value=this.defaults['link_url'];$(this.id+'_urltext').value=selection;}
else if(selection.match(/<a/))
{if(res=selection.match(/href="([^"]+?)"([^>]+?)?>([^<]+?)<\/a>/i))
{Debug.write(res);if(res.length)
{$(this.id+'_url').value=res[1];$(this.id+'_urltext').value=res[3];}
else
{$(this.id+'_url').value=selection.strip();$(this.id+'_urltext').value=this.defaults['link_text'];}
_active=$(this.id+'_urltext');}}
else if(selection.match(/[A-Za-z]+:\/\/[A-Za-z0-9\.-]{3,}\.[A-Za-z]{3}/)){$(this.id+'_url').value=selection.strip();$(this.id+'_urltext').value=this.defaults['link_text'];_active=$(this.id+'_urltext');}else{$(this.id+'_urltext').value=selection.strip();$(this.id+'_url').value=this.defaults['link_url'];_active=$(this.id+'_url');}}
else
{$(this.id+'_urltext').value=this.defaults['link_text'];$(this.id+'_url').value=this.defaults['link_url'];_active=$(this.id+'_url');}
if(!this.key_handlers['url'])
{$(this.id+'_url').observe('keypress',this.events.palette_return_key.bindAsEventListener(this));$(this.id+'_urltext').observe('keypress',this.events.palette_return_key.bindAsEventListener(this));this.key_handlers['url']=true;}
window.setTimeout(function()
{$(_active).activate();}.bind(this),200);}catch(err){Debug.write("#13 "+err);}},image_onclick:function(e)
{var selection=this.get_selection();var msg=(selection&&!selection.startsWith('<IMG'))?selection:this.defaults['img'];try{$(this.id+'_img').value=msg;if(!this.key_handlers['image'])
{$(this.id+'_img').observe('keypress',this.events.palette_return_key.bindAsEventListener(this));this.key_handlers['image']=true;}
window.setTimeout(function()
{$(this.id+'_img').activate();}.bind(this),200);}catch(err){Debug.write("#14 "+err);}},media_onclick:function(e)
{var selection=this.get_selection();var msg=(selection)?selection:this.defaults['media'];try{$(this.id+'_media').value=msg;if(!this.key_handlers['media'])
{$(this.id+'_media').observe('keypress',this.events.palette_return_key.bindAsEventListener(this));this.key_handlers['media']=true;}
window.setTimeout(function()
{$(this.id+'_media').activate();}.bind(this),200);}catch(err){Debug.write("#18 "+err);}},email_onclick:function(e)
{var selection=this.get_selection();var _active=$(this.id+'_email');try{if(selection)
{if(selection.match(/([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+/))
{$(this.id+'_email').value=selection.strip();$(this.id+'_emailtext').value=this.defaults['email_text'];_active=$(this.id+'_emailtext');}
else
{$(this.id+'_emailtext').value=selection.strip();$(this.id+'_email').value=this.defaults['email'];}}
else
{$(this.id+'_emailtext').value=this.defaults['email_text'];$(this.id+'_email').value=this.defaults['email'];}
if(!this.key_handlers['email'])
{$(this.id+'_email').observe('keypress',this.events.palette_return_key.bindAsEventListener(this));$(this.id+'_emailtext').observe('keypress',this.events.palette_return_key.bindAsEventListener(this));this.key_handlers['email']=true;}
window.setTimeout(function()
{$(_active).activate();}.bind(this),200);}catch(err){Debug.write("#16 "+err);}},show_emoticon_sidebar:function(e)
{if(Object.isUndefined(inACP)||inACP==false){var url=ipb.vars['base_url'];}else{var url=ipb.vars['front_url'];}
url+="app=forums&amp;module=ajax&amp;section=emoticons&amp;editor_id="+this.id;new Ajax.Request(url.replace(/&amp;/g,'&'),{method:'get',onSuccess:function(t)
{$('editor_'+this.id).addClassName('with_sidebar');var div=$('editor_'+this.id).down('.sidebar');div.update(this.values.get('templates')['emoticon_wrapper'].evaluate({id:this.id}));$(this.id+'_emoticon_holder').update(t.responseText);div.show();this.palettes['emoticons'].doClose();}.bind(this)});},addEmoticon:function(code,id,img,editorid)
{try{this.insert_emoticon('',img,code,'');}
catch(err)
{Debug.error(err);}}});var x_expanded=new Array();function editorMinimize(key)
{Debug.write('shrinking: '+key);x_expanded[key]=0;$(key+'_textarea').setStyle({height:'70px'});$('editor_'+key).removeClassName('ips_editor');$(key+'_controls').hide();if($(key+'_textarea').value)
{editorExpand(key);}
$(key+'_textarea').observe('focus',function(e){editorExpand(key);});}
function editorExpand(key)
{$H(x_expanded).each(function(i)
{if(i.key!=key)
{editorCollapse(i.key);}});if(x_expanded[key]==0)
{Debug.write(" expanding: "+key);$(key+'_controls').appear();$('editor_'+key).addClassName('ips_editor');ipb.editors[key]=new ipb.editor(key,USE_RTE);$(ipb.editors[key]).resize_to(250);x_expanded[key]=1;try
{ipb.editors[key].editor_window.focus();}catch(err){Debug.write(err);}}}
function editorCollapse(key)
{};var _topic=window.IPBoard;_topic.prototype.topic={totalChecked:0,inSection:'',postcache:[],poll:[],pollPopups:[],deletePerms:{},deleteUrls:{},deletePopUps:[],init:function()
{Debug.write("Initializing ips.topic.js");document.observe("dom:loaded",function(){if(ipb.topic.inSection=='topicview')
{if($('show_filters'))
{$('show_filters').observe('click',ipb.topic.toggleFilters);$('filter_form').hide();}
ipb.topic.preCheckPosts();ipb.delegate.register('.multiquote',ipb.topic.toggleMultimod);ipb.delegate.register('.edit_post',ipb.topic.ajaxEditShow);ipb.delegate.register('.delete_post',ipb.topic.deletePopUp);ipb.delegate.register('.toggle_post',ipb.topic.ajaxTogglePostApprove);ipb.delegate.register('.sd_content',ipb.topic.sDeletePostShow);ipb.delegate.register('.sd_remove',ipb.topic.confirmSingleDelete);ipb.delegate.register('input.post_mod',ipb.topic.checkPost);ipb.delegate.register('a[rel="bookmark"]',ipb.topic.showLinkToTopic);if($('showforumJump'))
{$('showforumJump').observe("change",ipb.topic.jumpToForum);$('forum_jump_submit').hide();}}
else if(ipb.topic.inSection=='searchview')
{ipb.delegate.register('input.post_mod',ipb.topic.checkPost);ipb.delegate.register('.sd_content',ipb.topic.sDeletePostShow);}});Event.observe(window,'load',function(){$$('.post','.poll').each(function(elem){ipb.global.findImgs($(elem));});});},jumpToForum:function(e)
{Event.stop(e);$('forum_jump').submit();return false;},submitPostModeration:function(e)
{if($F('tact')=='delete'){if(!confirm(ipb.lang['delete_confirm'])){Event.stop(e);}}},submitTopicModeration:function(e)
{if($F('topic_moderation')=='03'){if(!confirm(ipb.lang['delete_confirm'])){Event.stop(e);}}},deletePopUp:function(e,elem)
{var postid=elem.up().id.replace(/del_post_/,'');if(!postid){return;}
var _url_delete=ipb.topic.deleteUrls['hardDelete'].evaluate({'pid':postid}).replace(/&amp;/g,'&')+'&nr=1';var _url_soft=ipb.topic.deleteUrls['softDelete'].evaluate({'pid':postid}).replace(/&amp;/g,'&')+'&nr=1';var _permaShow='';if(!ipb.topic.deletePerms[postid]['canSoftDelete'])
{return ipb.topic.confirmSingleDelete(e,elem);}
Event.stop(e);if(!ipb.topic.deletePerms[postid]['canDelete'])
{_permaShow='display:none;';}
var popid='pop__delete_popup_'+postid;var content=new Template($('delPopUp').innerHTML).evaluate({removeUrl:_url_soft,permaDelete:_permaShow,permaUrl:_url_delete});ipb.topic.deletePopUps=new ipb.Popup(popid,{type:'balloon',initial:content,stem:true,hideAtStart:false,attach:{target:$('del_post_'+postid),position:'auto','event':'click'},w:'450px'});},sDeletePostShow:function(e,elem)
{Event.stop(e);var postid=elem.id.replace(/seeContent_/,'');if(!postid){return;}
if(!$('postsDelete_'+postid)._showing)
{$('postsDelete_'+postid).hide();$('postsDeleteShow_'+postid).show();$('postsDelete_'+postid)._showing=1;}
else
{$('postsDelete_'+postid).show();$('postsDeleteShow_'+postid).hide();$('postsDelete_'+postid)._showing=0;}},ajaxTogglePostApprove:function(e,elem)
{Event.stop(e);var postid=elem.id.replace(/toggle(text)?_post_/,'');if(!postid){return;}
var toApprove=($('post_id_'+postid).hasClassName('moderated'))?1:0;var url=ipb.vars['base_url']+'app=forums&module=ajax&section=topics&do=postApproveToggle&p='+postid+'&t='+ipb.topic.topic_id+'&f='+ipb.topic.forum_id+'&approve='+toApprove;new Ajax.Request(url,{method:'post',evalJSON:'force',parameters:{md5check:ipb.vars['secure_hash']},onSuccess:function(t)
{if(t.responseJSON['error'])
{switch(t.responseJSON['error'])
{case'notopic':alert(ipb.lang['no_permission']);break;case'nopermission':alert(ipb.lang['no_permission']);break;}}
else
{if(toApprove)
{$('post_id_'+postid).removeClassName('moderated');$('toggletext_post_'+postid).update(ipb.lang['unapprove']);$$('#toggle_post_'+postid+" a img").each(function(elem){$(elem).src=$(elem).src.replace(/accept/,'delete');});}
else
{$('post_id_'+postid).addClassName('moderated');$('toggletext_post_'+postid).update(ipb.lang['approve']);$$('#toggle_post_'+postid+" a img").each(function(elem){$(elem).src=$(elem).src.replace(/delete/,'accept');});}}}});},ajaxEditShow:function(e,elem)
{if(DISABLE_AJAX)
{return false;}
if(e.ctrlKey==true||e.metaKey==true||e.keyCode==91)
{return false;}
Event.stop(e);var edit=[];edit['button']=elem;if(!edit['button']){return;}
if(edit['button'].readAttribute('_editing')=='1')
{return false;}
edit['pid']=edit['button'].id.replace('edit_post_','');edit['tid']=ipb.topic.topic_id;edit['fid']=ipb.topic.forum_id;edit['post']=$('post_id_'+edit['pid']).down('.post');ipb.topic.postcache[edit['pid']]=edit['post'].innerHTML;url=ipb.vars['base_url']+'app=forums&module=ajax&section=topics&do=editBoxShow&p='+edit['pid']+'&t='+edit['tid']+'&f='+edit['fid'];if(Prototype.Browser.IE7)
{window.location='#entry'+edit['pid'];}
else
{new Effect.ScrollTo(edit['post'],{offset:-50});}
new Ajax.Request(url,{method:'post',parameters:{md5check:ipb.vars['secure_hash']},onSuccess:function(t)
{if(t.responseText=='nopermission'||t.responseText=='NO_POST_FORUM'||t.responseText=='NO_EDIT_PERMS'||t.responseText=='NO_POSTING_PPD')
{alert(ipb.lang['no_permission']);return;}
if(t.responseText=='error')
{alert(ipb.lang['action_failed']);return;}
edit['button'].writeAttribute('_editing','1');edit['post'].update(t.responseText);edit['pid']='e'+edit['pid'];ipb.editors[edit['pid']]=new ipb.editor(edit['pid'],USE_RTE);if($('edit_save_'+edit['pid'])){$('edit_save_'+edit['pid']).observe('click',ipb.topic.ajaxEditSave);}
if($('edit_switch_'+edit['pid'])){$('edit_switch_'+edit['pid']).observe('click',ipb.topic.ajaxEditSwitch);}
if($('edit_cancel_'+edit['pid'])){$('edit_cancel_'+edit['pid']).observe('click',ipb.topic.ajaxEditCancel);}}});Debug.write(url);},ajaxEditSwitch:function(e)
{Event.stop(e);var elem=Event.element(e);var postid=elem.id.replace('edit_switch_e','');if(!postid){return;}
var url=ipb.vars['base_url']+'app=forums&module=post&section=post&do=edit_post&f='+ipb.topic.forum_id+'&t='+ipb.topic.topic_id+'&p='+postid+'&st='+ipb.topic.start_id+'&_from=quickedit';try{ipb.editors['e'+postid].update_for_form_submit();var Post=$F('e'+postid+'_textarea');}catch(err){Debug.error(err);return;}
form=new Element('form',{action:url,method:'post'});textarea=new Element('textarea',{name:'Post'});reason=new Element('input',{name:'post_edit_reason'});md5check=new Element('input',{type:'hidden',name:'md5check',value:ipb.vars['secure_hash']});if(Prototype.Browser.Opera){textarea.value=Post;}else{textarea.value=Post.replace(/&/g,'&amp;');}
reason.value=($('post_edit_reason'))?$('post_edit_reason').value:'';form.insert(md5check).insert(textarea).insert(reason).hide();$$('body')[0].insert(form);form.submit();},ajaxEditSave:function(e)
{Event.stop(e);var elem=Event.element(e);var postid=elem.id.replace('edit_save_e','');if(!postid){return;}
try{ipb.editors['e'+postid].update_for_form_submit();var Post=$F('e'+postid+'_textarea');}catch(err){Debug.error(err);Debug.dir(ipb.editors);return;}
if(Post.blank())
{alert(ipb.lang['post_empty']);return;}
var add_edit=null;var edit_reason='';var post_htmlstatus='';if($('add_edit')){add_edit=$F('add_edit');}
if($('post_edit_reason')){edit_reason=$F('post_edit_reason');}
if($('post_htmlstatus')){post_htmlstatus=$F('post_htmlstatus');}
var url=ipb.vars['base_url']+'app=forums&module=ajax&section=topics&do=editBoxSave&p='+postid+'&t='+ipb.topic.topic_id+'&f='+ipb.topic.forum_id;new Ajax.Request(url,{method:'post',evalJSON:'force',encoding:ipb.vars['charset'],parameters:{md5check:ipb.vars['secure_hash'],Post:Post.encodeParam(),add_edit:add_edit,post_edit_reason:edit_reason.encodeParam(),post_htmlstatus:post_htmlstatus},onSuccess:function(t)
{if(t.responseJSON['error'])
{if($('error_msg_e'+postid))
{$('error_msg_e'+postid).update(t.responseJSON['error']);new Effect.BlindDown($('error_msg_e'+postid),{duration:0.4});}
else
{alert(t.responseJSON['error']);}
return false;}
else
{$('edit_post_'+postid).writeAttribute('_editing','0');$('post_id_'+postid).down('.post').update(t.responseJSON['successString']);ipb.global.findImgs($('post_id_'+postid).down('.post'));prettyPrint();}}});},ajaxEditCancel:function(e)
{Event.stop(e);var elem=Event.element(e);var postid=elem.id.replace('edit_cancel_e','');if(!postid){return;}
if(ipb.topic.postcache[postid]){$('post_id_'+postid).down('.post').update(ipb.topic.postcache[postid]);ipb.editors[postid]=null;$('edit_post_'+postid).writeAttribute('_editing','0');}
return;},preCheckPosts:function()
{if(!$('selectedpidsJS')||!$F('selectedpidsJS')){return true;}
pids=$F('selectedpidsJS').split(',');if(pids)
{pids.each(function(pid)
{if(!pid.blank())
{ipb.topic.totalChecked++;if($('checkbox_'+pid))
{$('checkbox_'+pid).checked=true;}}});}
ipb.topic.updatePostModButton();},checkPost:function(e,check)
{Debug.write("Check post");remove=$A();data=$F('selectedpidsJS');if(data!=null){pids=data.split(',')||$A();}else{pids=$A();}
if(check.checked==true)
{pids.push(check.id.replace('checkbox_',''));ipb.topic.totalChecked++;}
else
{remove.push(check.id.replace('checkbox_',''));ipb.topic.totalChecked--;}
pids=pids.uniq().without(remove).join(',');ipb.Cookie.set('modpids',pids,0);$('selectedpidsJS').value=pids;ipb.topic.updatePostModButton();},updatePostModButton:function()
{if($('mod_submit'))
{if(ipb.topic.totalChecked==0){$('mod_submit').disabled=true;}else{$('mod_submit').disabled=false;}
$('mod_submit').value=ipb.lang['with_selected'].replace('{num}',ipb.topic.totalChecked);}},showLinkToTopic:function(e,elem)
{_t=prompt(ipb.lang['copy_topic_link'],$(elem).readAttribute('href'));Event.stop(e);},confirmSingleDelete:function(e,elem)
{if(!confirm(ipb.lang['delete_post_confirm']))
{Event.stop(e);return false;}
return true;},toggleMultimod:function(e,elem)
{Event.stop(e);try{quoted=ipb.Cookie.get('mqtids').split(',').compact();}catch(err){quoted=$A();}
id=elem.id.replace('multiq_','');if(elem.hasClassName('selected'))
{elem.removeClassName('selected');quoted=quoted.uniq().without(id).join(',');}
else
{elem.addClassName('selected');quoted.push(id);quoted=quoted.uniq().join(',');}
ipb.Cookie.set('mqtids',quoted,0);},toggleFilters:function(e)
{if($('filter_form'))
{Effect.toggle($('filter_form'),'blind',{duration:0.2});Effect.toggle($('show_filters'),'blind',{duration:0.2});}},setPostHidden:function(id)
{if($('post_id_'+id).select('.post_wrap')[0])
{$('post_id_'+id).select('.post_wrap')[0].hide();if($('unhide_post_'+id))
{$('unhide_post_'+id).observe('click',ipb.topic.showHiddenPost);}}},showHiddenPost:function(e)
{link=Event.findElement(e,'a');id=link.id.replace('unhide_post_','');if($('post_id_'+id).select('.post_wrap')[0])
{elem=$('post_id_'+id).select('.post_wrap')[0];new Effect.Parallel([new Effect.BlindDown(elem),new Effect.Appear(elem)],{duration:0.5,afterFinish:function(e){ipb.global.findImgs($(elem));}});}
if($('post_id_'+id).select('.post_ignore')[0])
{ignoreElem=$('post_id_'+id).select('.post_ignore')[0];ignoreElem.hide();}
Event.stop(e);},scrollToPost:function(pid)
{if(!pid||!Object.isNumber(pid)){return;}
$('entry'+pid).scrollTo();},showVoters:function(e,qid,cid)
{Event.stop(e);if(!ipb.topic.poll[qid]||!ipb.topic.poll[qid][cid]){return;}
var content=ipb.templates['poll_voters'].evaluate({title:ipb.topic.poll[qid][cid]['name'],content:ipb.topic.poll[qid][cid]['users']});ipb.topic.pollPopups[qid+'_'+cid]=new ipb.Popup('b_voters_'+qid+'_'+cid,{type:'balloon',initial:content,stem:true,hideAtStart:false,attach:{target:$('l_voters_'+qid+'_'+cid),position:'auto','event':'click'},w:'500px'});},repPopUp:function(e,postID)
{var _url=ipb.vars['base_url']+'&app=forums&module=ajax&secure_key='+ipb.vars['secure_hash']+'&section=topics&do=reputation&post='+postID;new ipb.Popup('rep_'+postID,{type:'balloon',stem:true,attach:{target:e,position:'auto'},hideAtStart:false,ajaxURL:_url,w:'300px',h:'400px'});}};ipb.topic.init();;ipb.lang['action_failed']="Action failed";ipb.lang['album_full']="You are not permitted to upload any more items into this album";ipb.lang['approve']="Approve";ipb.lang['att_select_files']="Select files";ipb.lang['available']="&#10004; Available!";ipb.lang['blog_cat_exists']="That category already exists";ipb.lang['blog_publish_now']="Publish Now";ipb.lang['blog_revert_header']="Are you sure you want to revert your header?";ipb.lang['blog_save_draft']="Save Draft";ipb.lang['blog_uncategorized']="Uncategorized";ipb.lang['cannot_readd_friend']="You cannot re-add this friend for five minutes after removing them";ipb.lang['cant_delete_folder']="You can't delete a protected folder!";ipb.lang['click_to_attach']="Click To Attach Files";ipb.lang['click_to_show_opts']="Click to configure post options";ipb.lang['confirm_delete']="Are you sure you want to delete this folder? ALL messages in it will be deleted. This cannot be undone!";ipb.lang['confirm_empty']="Are you sure you want to empty this folder?";ipb.lang['copy_topic_link']="Copy the permalink below to store the direct address to this post in your clipboard";ipb.lang['delete_confirm']="Are you sure you want to continue?";ipb.lang['delete_pm_confirm']="Are you sure you wish to permanently delete this conversation?";ipb.lang['delete_pm_many_confirm']="Are you sure you wish to delete these conversations?";ipb.lang['delete_post_confirm']="Are you sure you want to delete this post?";ipb.lang['delete_reply_confirm']="Are you sure you want to delete this reply?";ipb.lang['delete_topic_confirm']="Are you sure you want to delete this topic?";ipb.lang['editor_enter_list']="Enter list item (or hit Cancel to finish list)";ipb.lang['email_banned']="&#10007; This email address has been banned";ipb.lang['email_doesnt_match']="&#10007; The addresses you entered don't match";ipb.lang['email_in_use']="&#10007; This email address is in use";ipb.lang['enter_unlimited_names']="Enter names";ipb.lang['enter_x_names']="Enter up to [x] names";ipb.lang['error']="Error";ipb.lang['error_occured']="An error occurred";ipb.lang['error_security']="Security Error";ipb.lang['fail_cblock']="Failed to save content block changes";ipb.lang['fail_config']="Failed to save configuration";ipb.lang['folder_not_found']="Cannot find that folder";ipb.lang['folder_protected']="Cannot perform that action on a protected folder";ipb.lang['friend_already']="This member is already on your friends list";ipb.lang['gallery_rotate_failed']="There was an error rotating the image";ipb.lang['go_to_category']="Go to this category";ipb.lang['idm_comment_empty']="Comment is empty";ipb.lang['idm_comment_empty']="Comment is empty";ipb.lang['idm_invalid_file']="Invalid File";ipb.lang['idm_msg_email']="You did not enter an email address to send the email to";ipb.lang['idm_msg_text']="You did not enter any text to email to the user";ipb.lang['invalid_chars']="&#10007; This field contains invalid characters";ipb.lang['invalid_email']="&#10007; This isn't a valid address";ipb.lang['invalid_folder_name']="The folder name is invalid";ipb.lang['invalid_mime_type']="You aren't permitted to upload this kind of file";ipb.lang['is_required']="&#10007; This field is required";ipb.lang['is_spammer']="This account has been flagged as a spam account";ipb.lang['js_rte_erroriespell']="ieSpell was not detected. Click OK to go to the download page.";ipb.lang['js_rte_errorloadingiespell']="Error loading ieSpell. Exception: ";ipb.lang['justgo']="Go";ipb.lang['loading']="Loading...";ipb.lang['max_notes_reached']="You cannot add any more notes to this image, because you have reached the maximum number allowed";ipb.lang['member_no_exist']="That member does not exist!";ipb.lang['message_sent']="Message Sent";ipb.lang['messenger_cancel']="Cancel";ipb.lang['messenger_edit']="Edit";ipb.lang['must_enter_name']="You must enter a name";ipb.lang['note_confirm_delete']="Are you sure you want to delete this note?";ipb.lang['note_no_permission_a']="You do not have permission to add notes to this image";ipb.lang['note_no_permission_d']="You don't have permission to delete notes";ipb.lang['note_no_permission_e']="You do not have permission to edit this note";ipb.lang['note_save_empty']="Your note cannot be empty; click the Delete link for this note if you do not wish to keep it";ipb.lang['not_available']="&#10007; This name is taken!";ipb.lang['no_permission']="You do not have permission for this action";ipb.lang['option_is_empty']="This tag's option cannot be left empty!";ipb.lang['out_of_diskspace']="You have run out of space for uploads";ipb.lang['pass_doesnt_match']="&#10007; The passwords you entered don't match";ipb.lang['pass_too_long']="&#10007; Your password is too long (max. 32 characters)";ipb.lang['pass_too_short']="&#10007; Your password is too short (min. 3 characters)";ipb.lang['pending']="Pending";ipb.lang['poll_not_enough_choices']="One or more of your questions doesn't contain enough choices. Each question must contain at least 2 choices!";ipb.lang['poll_no_more_choices']="You cannot add any more choices to this question";ipb.lang['poll_no_more_q']="You cannot add any more questions to this poll!";ipb.lang['poll_stats']="You may add [q] more question(s), with [c] choices per question";ipb.lang['post_empty']="Your post is empty";ipb.lang['post_empty_post']="Sorry, you can't submit a blank post. Please enter some text in the editor box";ipb.lang['post_empty_title']="You must enter a topic title!";ipb.lang['post_empty_username']="You must enter a username";ipb.lang['prof_comment_empty']="You must enter a comment";ipb.lang['prof_comment_mod']="Your comment was added, but requires approval by this member before it will be displayed";ipb.lang['prof_comment_perm']="You do not have permission to post comments on this profile";ipb.lang['prof_update_button']="Update";ipb.lang['prof_update_default']="What's on your mind?";ipb.lang['prof_update_tooltip']="Update my status";ipb.lang['quickpm_enter_subject']="Please enter a subject";ipb.lang['quickpm_msg_blank']="Your message is blank";ipb.lang['reached_max_folders']="You have reached the maximum number of allowed folders";ipb.lang['required_data_missing']="Some required data was missing";ipb.lang['rtg_already']="You've already rated this entry";ipb.lang['rtg_awesome']="Awesome!";ipb.lang['rtg_good']="Good";ipb.lang['rtg_nbad']="Not Bad";ipb.lang['rtg_ok']="Okay";ipb.lang['rtg_poor']="Poor";ipb.lang['rtg_topic_locked']="This topic is locked";ipb.lang['save_folder']=">";ipb.lang['search_default_value']="Search...";ipb.lang['set_as_spammer']="Are you sure you want to flag this user as a spam account?";ipb.lang['signin_badopenid']="Supplied OpenID url is invalid";ipb.lang['signin_nopassword']="No password entered";ipb.lang['signin_nosigninname']="No sign in name entered";ipb.lang['silly_server']="The server returned an error during upload";ipb.lang['spoiler_hide']="Hide";ipb.lang['spoiler_show']="Show";ipb.lang['switch_to_advanced']="Try our advanced uploader which supports multiple file uploading (modern browser required)";ipb.lang['too_long']="&#10007; The name you entered is too long";ipb.lang['too_short']="&#10007; The name you entered is too short";ipb.lang['trouble_uploading']="Trouble uploading?";ipb.lang['unapprove']="Unapprove";ipb.lang['uploading']="Uploading...";ipb.lang['upload_done']="Done (uploaded [total])";ipb.lang['upload_failed']="This upload failed";ipb.lang['upload_limit_hit']="Upload limit exceeded";ipb.lang['upload_no_file']="No file was selected for upload";ipb.lang['upload_progress']="Uploaded [done] of [total]";ipb.lang['upload_queue']="You have attempted to queue too many files. The number of files you can queue is: ";ipb.lang['upload_skipped']="Upload Skipped";ipb.lang['upload_too_big']="This file was too big to upload";ipb.lang['usercp_photo_upload']="You have not selected a file to upload";ipb.lang['vote_success']="Vote saved!";ipb.lang['vote_updated']="Vote updated!";ipb.lang['with_selected']="With Selected ({num})";