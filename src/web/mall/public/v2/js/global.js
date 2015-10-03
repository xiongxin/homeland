jQuery.extend({
  getCookie : function(sName) {
    var aCookie = document.cookie.split("; ");
    for (var i=0; i < aCookie.length; i++){
      var aCrumb = aCookie[i].split("=");
      if (sName == aCrumb[0]) return decodeURIComponent(aCrumb[1]);
    }
    return '';
  },
  setCookie : function(sName, sValue, sExpires) {
    var sCookie = sName + "=" + encodeURIComponent(sValue);
    if (sExpires != null) sCookie += "; expires=" + sExpires;
    document.cookie = sCookie;
  },
  removeCookie : function(sName) {
    document.cookie = sName + "=; expires=Fri, 31 Dec 1999 23:59:59 GMT;";
  }
});

(function(e){if(void 0==window.define){var d={},h=d.exports={};e(null,h,d);window.floatNotify=window.notification=d.exports}else define(e)})(function(require, exports, module){function e(a){this._options=d.extend({mode:"msg",text:"\u7f51\u9875\u63d0\u793a",useTap:!1},a||{});this._init()}var d=require?require("zepto"):window.$,h=d(window),c=d('<div class="c-float-popWrap msgMode hide"><div class="c-float-modePop"><div class="warnMsg"></div><div class="content"></div><div class="doBtn"><button class="ok">\u786e\u5b9a</button><button class="cancel">\u53d6\u6d88</button></div></div></div>'),m=c.find(".warnMsg"),n=c.find(".content"),o=c.find(".doBtn .ok"),p=c.find(".doBtn .cancel"),j=!1,f;d.extend(e.prototype,{_init:function(){var a=this,b=a._options,g=b.mode,k=b.text,e=b.content,f=b.callback,l=b.background,b=b.useTap?"tap":"click",i=c.attr("class"),i=i.replace(/(msg|alert|confirm)Mode/i,g+"Mode");c.attr("class",i);l&&c.css("background",l);k&&m.html(k);e&&n.html(e);o.off(b).on(b,function(b){f.call(a,b,!0)});p.off(b).on(b,function(b){f.call(a,b,!1)});j||(j=!0,d("body").append(c),h.on("resize",function(){setTimeout(function(){a._pos()},500)}))},_pos:function(){var a=document,b=a.documentElement,g=a.body,e,d,f;this.isHide()||(a=g.scrollTop,g=g.scrollLeft,e=b.clientWidth,b=b.clientHeight,d=c.width(),f=c.height(),c.css({top:a+(b-f)/2,left:g+(e-d)/2}))},isShow:function(){return c.hasClass("show")},isHide:function(){return c.hasClass("hide")},_cbShow:function(){var a=this._options.onShow;c.css("opacity","1").addClass("show");a&&a.call(this)},show:function(){var a=this;f&&(clearTimeout(f),f=void 0);a.isShow()?a._cbShow():(c.css("opacity","0").removeClass("hide"),a._pos(),setTimeout(function(){a._cbShow()},300),setTimeout(function(){c.animate({opacity:"1"},300,"linear")},1))},_cbHide:function(){var a=this._options.onHide;c.css("opacity","0").addClass("hide");a&&a.call(this)},hide:function(){var a=this;a.isHide()?a._cbHide():(c.css("opacity","1").removeClass("show"),setTimeout(function(){a._cbHide()},300),setTimeout(function(){c.animate({opacity:"0"},300,"linear")},1))},flash:function(a){var b=this;opt=b._options;opt.onShow=function(){f=setTimeout(function(){f&&b.hide()},a)};b.show()}});module.exports=new function(){this.simple=function(a,b,c){2==arguments.length&&"number"==typeof arguments[1]&&(c=arguments[1],b=void 0);var d=new e({mode:"msg",text:a,background:b});d.flash(c||2E3);return d};this.msg=function(a,b){return new e(d.extend({mode:"msg",text:a},b||{}))};this.alert=function(a,b,c){return new e(d.extend({mode:"alert",text:a,callback:b},c||{}))};this.confirm=function(a,b,c,f){return new e(d.extend({mode:"confirm",text:a,content:b,callback:c},f||{}))};this.pop=function(a){return new e(a)}}});

function showPageLoadingMsg(msg,type)
{
    var html ='<div class="ui-loader ui-corner-all ui-body-a ui-loader-verbose">';
    html    +='     <span class="ui-icon ui-icon-loading"></span>';
    html    +='         <h1>';
    html    += msg ? msg : 'loading...';
    html    +='         </h1>';
    html    +='</div>';
    $('body').append(html);
    //setTimeout('$(".ui-loader").remove();',1000);
}
/**
 * 格式化数字字符，保留小数位
 */
String.prototype.numberFormat = function(decimals){
    if (isNaN(this)) { return 0; };
    if (this == '') { return 0; };
    var sec = this.split('.');
    var whole = parseFloat(sec[0]);
    var result = '';
    if (sec.length > 1) {
        var dec = new String(sec[1]);
        dec = String(parseFloat(sec[1]) / Math.pow(10, (dec.length - decimals)));
        dec = String(whole + Math.round(parseFloat(dec)) / Math.pow(10, decimals));
        var dot = dec.indexOf('.');
        if (dot == -1) {
            dec += '.';
            dot = dec.indexOf('.');
        }
        while (dec.length <= dot + decimals) { dec += '0'; }
        result = dec;
    } else {
        var dot;
        var dec = new String(whole);
        dec += '.';
        dot = dec.indexOf('.');
        while (dec.length <= dot + decimals) { dec += '0'; }
        result = dec;
    }
    return result;
};

/**
 * 反转 PHP 的 nl2br
 */
String.prototype.br2nl = function(){
    var re = /(<br\/>|<br>|<BR>|<BR\/>)/g;
    return this.replace(re, "\n");
}

function goback(){
    if(document.referrer == ''){
        window.location = '/';
    }else{
        history.back();
    }
}


