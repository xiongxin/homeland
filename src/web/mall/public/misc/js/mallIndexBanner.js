$(function($){
	var SetTime = 1500; //延迟显示时间
	var AdTime = 4000; //播放时间
	var timer = null;
	function open_Ad(showBtn){
		$('.advcon').slideDown(100,function(){
			if(showBtn !== false){
				$('.advclose').fadeIn();				
			}
			if(timer){clearTimeout(timer);}
			timer = setTimeout(close_Ad,AdTime);
		});
	}
	function close_Ad(){
		$('.advcon').slideUp(100,function(){
			$('.advclose').hide();
			$('.advreplay').show();
		});
	}
	$('.advclose').click(function(){
		if(timer){clearTimeout(timer);}
		close_Ad();
		return false;
	});
	$('.advreplay').click(function(){
		if(timer){clearTimeout(timer);}
		open_Ad(false);
		$('.advreplay').hide();
		$('.advclose').show();
		return false;
	});	
	//setTimeout(open_Ad,1500);/
	var Cookie = {
		get:function (k) {
			return ((new RegExp(["(?:; )?", k, "=([^;]*);?"].join(""))).test(document.cookie) && RegExp["$1"]) || "";
		},
		set: function (k, v, e, d) {
			var date=new Date();
			var expiresDays=e;
			date.setTime(date.getTime()+expiresDays*24*3600*1000);
			//如果有设置时间，则在规定时间内使用cookie，否则就是永不过期
			document.cookie=k+"="+v+"; expires="+ (e != '' ? date.toGMTString(): "GMT_String")+";path=/;domain="+ (d||'');
		}
	};
	var getCookie = Cookie.get('adCookie');
	if(getCookie == 'adShow'){
		$('.advreplay').show();
	}else{		
		setTimeout(open_Ad,SetTime);
		document.cookie="adCookie=adShow"; 
	};
	
	
});