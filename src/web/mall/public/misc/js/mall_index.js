jQuery(function($){
	//分类	
	var clickEventType=((document.ontouchstart!==null)?'click':'touchstart');
	$("#navMore").bind(clickEventType, function(e){
		$('.category_nav_more').addClass('open');
		if($(".modal-backdrop").length == ''){
			$(document.body).append('<div class="modal-backdrop" ></div>');			
		};
		$(".modal-backdrop").bind(clickEventType,function(event){			
			$('.category_nav_more').removeClass('open');
			$(this).remove();
			event.preventDefault();		
		});
		e.preventDefault();	
	});

	
	
	//轮播
	$(window).resize(function(){
		var width=$('.touchslider-viewport').width();
		$('.touchslider-item a').css('width',width);
		$('.touchslider').css('height',384*(width/768));  //389/750是图片的高度和长度比例
	}).resize();	
	$(".touchslider").touchSlider({mouseTouch: true, autoplay: true});
	
	//toolbarTab
	 
	if(navigator.userAgent.match(/mobile/i)) {
		document.addEventListener('touchmove', function(event) {
		    checkBar();			
		},false);
	}else{
		document.addEventListener('scroll', function() {
		    checkBar();
		},false);
	};
	 
	document.addEventListener('touchend', function(event) {		
		if($(window).scrollTop() < 40){
			$(".sort_btnTab").removeClass("sort_tab_fixed");
		}
	},false);
 
	
	function checkBar(){
		if($(window).scrollTop() > 40){
			$(".sort_btnTab").addClass("sort_tab_fixed");
		}else{
			$(".sort_btnTab").removeClass("sort_tab_fixed");
		}
	};
	
});
