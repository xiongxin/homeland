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

            var sel_html = '<select class="form-control '+options.menu_id+root+'">';
            sel_html    += '<option selected value="">'+options.emptyText+'</option>'
            
            $.each(self.data[root],function(i,v){
                sel_html += '<option value="'+v[0]+'">'+v[1]+'</option>';
            });
            
            sel_html    += '</select>';
            if(flag){
                $this.nextAll().remove();
                $this.after(sel_html);
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
