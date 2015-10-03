// JavaScript Document
if (!(window.console && console.log)) {
  (function() {
    var noop = function() {};
    var methods = ['assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error', 'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log', 'markTimeline', 'profile', 'profileEnd', 'markTimeline', 'table', 'time', 'timeEnd', 'timeStamp', 'trace', 'warn'];
    var length = methods.length;
    var console = window.console = {};
    while (length--) {
        console[methods[length]] = noop;
    }
  }());
}
//判断浏览器是否支持 placeholder属性  
function isPlaceholder(){  
    var input = document.createElement('input');  
    return 'placeholder' in input;  
}  
  
if (!isPlaceholder()) {//不支持placeholder 用jquery来完成  
    $(document).ready(function() {  
        if(!isPlaceholder()){  
            //对password框的特殊处理1.创建一个text框 2获取焦点和失去焦点的时候切换  
            var inputField    = $("input[type=text],input[type=password]");  
            inputField.each(function(){
            	var $this 	= $(this);
            	var place	= $this.attr('placeholder');
            	if(place != null){
            		var className = $this.attr('class') || '';
            		$this.after('<input class="'+className+'" type="text" value="'+place+'"/>');  
            		if($this.val() == ''){
            			$this.hide().next().show();
            		}else{
            			$this.next().hide();
            		}
            		
            		$this.next().focus(function(){  
            			$(this).hide().prev().show().focus();  
            		});  
            		
            		$this.blur(function(){  
            			if($this.val() == '') {  
            				$(this).hide().next().show();  
            			}  
            		});  
            	}
            });
              
        }  
    });  
      
}  

function sprintf()
{
    var arg = arguments,
        str = arg[0] || '',
        i, n;
    if(arg[1] != null && typeof(arg[1]) == 'object'){

    	$.each(arg[1],function(i,v){
            str = str.replace(/%s/, v);
    	});
    	
    	delete arg[1];
    }
    for (i = 1, n = arg.length; i < n; i++) {
        str = str.replace(/%s/, arg[i]);
    }
    return str;
}
window.updateAlert = function (text,c) {
    text = text||'default';
    c = c||false;
    if ( text!='default' ) {
        if(c == 'alert-success'){
                layer.msg(text,2,1);
        }else{
                layer.alert(text,3);
        }
    }
};

$(document).ready(function(){
    
	$("input:password,input.only-num-letter").keyup(function(){
		var $this = $(this);
		$this.val($this.val().replace(/[^\w\.\/]/ig,''));
	});
	$("input.mobile,input.only-num").keyup(function(){
		var $this = $(this);
		$this.val($this.val().replace(/\D/g,''));
	});
	
	//ajax get请求
    $('.ajax-get').click(function(){
        var target;
        var $this = $(this);
        if ( $this.hasClass('confirm') ) {
            layer.confirm('确认要执行该操作吗?',function(index){
                clean();
                layer.close(index);
            });
        }else{
            clean(); 
        }
        
        function clean(){
            if ( (target = $this.attr('href')) || (target = $this.attr('url')) ) {
                var loading = layer.load('请稍后...');
                $.get(target).success(function(data){
                    if (data.status==1) {
                        if (data.url) {
                            updateAlert(data.info + ' 页面即将自动跳转~','alert-success');
                        }else{
                            updateAlert(data.info,'alert-success');
                        }
                        setTimeout(function(){
                            $('#top-alert').find('button').click();
                            if (data.url) {
                                location.href=data.url;
                            }else if( $this.hasClass('no-refresh')){
                                    
                            }else{
                                location.reload();
                            }
                        },1500);
                    }else{
                        updateAlert(data.info,'alert-danger');
                        setTimeout(function(){
                            if (data.url) {
                                location.href=data.url;
                            }else{
                                $('#top-alert').find('button').click();
                            }
                        },1500);
                    }
                }).always(function () {
                    layer.close(loading);
                });

            }
        }
        if($this.attr('href') != null){
            return false;
        }
    });

    //ajax post submit请求
    $('.ajax-post').click(function(){
        var target,query,form;
        var target_form = $(this).attr('target-form');
        var that = this;
        var nead_confirm=false;
        if( ($(this).attr('type')=='submit') || (target = $(this).attr('href')) || (target = $(this).attr('url')) ){
            if(target_form.indexOf("#") == 0){
                form = $(target_form);
            }else{
                form = $('.'+target_form);
            }
            switch(true){
                case $(this).attr('hide-data') === 'true'://无数据时也可以使用的功能
                    form = $('.hide-data');
                    query = form.serialize();
                    break;
                case form.get(0)==undefined:
                    return false;
                    break;
                case form.get(0).nodeName=='FORM':
                    if($(this).attr('url') !== undefined){
                        target = $(this).attr('url');
                    }else{
                            target = form.get(0).action;
                    }
                    query = form.serialize();
                    if ( $(this).hasClass('confirm') ) {
                        layer.confirm('确认要执行该操作吗?',function(index){
                            do_post()
                            layer.close(index);
                        });
                    }
                    break;
                case form.get(0).nodeName=='INPUT' || form.get(0).nodeName=='SELECT' || form.get(0).nodeName=='TEXTAREA':
                    form.each(function(k,v){
                        if(v.type=='checkbox' && v.checked==true){
                            nead_confirm = true;
                        }
                    })
                    
                    query = form.serialize();
                    if ( nead_confirm || $(this).hasClass('confirm') ) {
                        
                        layer.confirm('确认要执行该操作吗?',function(index){
                            do_post()
                            layer.close(index);
                        });
                    }
                    break;
                default:
                    query = form.find('input,select,textarea').serialize();
                    if ( $(this).hasClass('confirm') ) {
                        layer.confirm('确认要执行该操作吗?',function(index){
                            do_post()
                            layer.close(index);
                        });
                    }
            }
            
            function do_post(){
                $(that).addClass('disabled').attr('autocomplete','off').prop('disabled',true);
                var loading = layer.load('请稍后...');
                $.post(target,query).success(function(data){
                    if (data.status==1) {
                        if (data.url) {
                            updateAlert(data.info + ' 页面即将自动跳转~','alert-success');
                        }else{
                            updateAlert(data.info ,'alert-success');
                        }
                        setTimeout(function(){
                            $(that).removeClass('disabled').prop('disabled',false);
                            if (data.url) {
                                location.href=data.url;
                            }else if( $(that).hasClass('no-refresh')){
                                $('#top-alert').find('button').click();
                            }else{
                                location.reload();
                            }
                        },1500);
                    }else{
                        updateAlert(data.info,'alert-danger');
                        setTimeout(function(){
                            $(that).removeClass('disabled').prop('disabled',false);
                            if (data.url) {
                                location.href=data.url;
                            }else{
                                $('#top-alert').find('button').click();
                            }
                        },1500);
                    }
                }).always(function () {
                    layer.close(loading);
                });
            }
            if(!nead_confirm && !$(this).hasClass('confirm')){
                do_post();
            }
        }
        return false;
    });
});

if ("undefined" == typeof XBW || !XBW) var XBW = {};
XBW.linkagesel = {
    data : '',
    selector : '',
    init : function(options){
        var defaults = {
            root        : 0,          //从哪个开始
            emptyText   : '请选择',     //选择框的提示
            selected    : '',         //默认选中的值
            district    : 'district', //input隐藏域的name
            district_id : 'district', //input隐藏域的id
            menu_id     : 'sel_'      //下拉菜单ID
        };
        options = $.extend(defaults, options);
        options.district_id = options.district_id || options.district;

        if(this.data == ''){

            return false;
        }
        var self = this;
        var selector = this.selector;

        self.buildSelect = function(parents,root){

            var flag = root != null ? true : false;
            root     = flag         ? root : options.root;

            //选择的节点没有下级时
            if(self.data[root] == null){
                $(this).nextAll().remove();
                return false;
            }

            var $this = flag ? $(this) : $(selector);

            var sel_html = '<select class="'+options.menu_id+root+'">';
            sel_html    += '<option selected value="">'+options.emptyText+'</option>'

            $.each(self.data[root],function(i,v){
                sel_html += '<option value="'+v[0]+'">'+v[1]+'</option>';
            });

            sel_html    += '</select>';
            if(flag){
                $this.nextAll().remove();
                $this.after(' &nbsp;' + sel_html);
            }else{
                sel_html = '<input id="'+options.district_id+'" type="hidden" name="'+options.district+'" />'+sel_html;
                $this.html(sel_html);
            }

            //为下拉框绑定事件
            $(selector+' .'+options.menu_id+root).change(function(){

                $('#'+options.district_id).val(this.value);

                if(root > 1 && this.value == ''){
                    $(selector+' .'+options.district_id).val($(selector+' #'+options.menu_id+root).prev().val());
                }

                //递归
                self.buildSelect.call(this,parents,this.value);
            });
            //自动选择，并出发事件
            if(parents[root] != null){
                $(selector+" ."+options.menu_id+root).val(parents[root]).change();
            }

        };

        //设置json数据
        if(typeof(this.data) == "string"){
            $.getJSON(this.data,$.proxy(function(json){

                this.data = json;
                this.buildSelect(this.getParentsKey(options.selected));
            }, this));
        }else if(typeof(this.data) == 'object'){

            this.buildSelect(this.getParentsKey(options.selected));
        };

    },

    //根据k找到值
    findVbyK : function(k){
        if(this.data == ''){
            return false;
        }

        var value;
        $.each(this.data,function(i,v){
            if(v[k] != null ){
                value = v[k];
                value.push(i);
                return false;
            }
        });
        return value;
    },
    //根据选中值，返回所有父类id
    getParentsKey : function(selected){
        var keys = [];
        if(selected > 0){

            var tmp = this.findVbyK(selected);
            keys[tmp[2]] = tmp[0];

            while(tmp[2] > 0){
                tmp = this.findVbyK(tmp[2]);
                keys[tmp[2]] = tmp[0];
            }
        }
        return keys;
    },
    //根据选中值，返回所有父类名称
    getParentsText : function(selected){
        var text = [];
        if(selected > 0){

            var tmp = this.findVbyK(selected);
            text.push(tmp[1]);

            while(tmp[2] > 0){
                tmp = this.findVbyK(tmp[2]);
                text.push(tmp[1]);
            }
        }
        return text.reverse().join(' ');
    },
    //根据选中值，自动选择
    choose : function(selected){
        var self = this;
        var keys = this.getParentsKey(selected);
        var p_sel = $(this.selector+" select:eq(0)");
        $(p_sel.find("option")).each(function(){
            if(this.value == keys[0]){
                p_sel.val(this.value);
                self.buildSelect.call(p_sel,keys,this.value);
            }
        })
        //p_sel.val(keys[0]);

    }
}