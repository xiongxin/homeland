/**
 
 @Name: layer拓展类，依赖于layer
 @Date: 2014.08.13
 @Author: 贤心
 @Versions：1.8.5-ext
 @Api：http://sentsin.com/jquery/layer
 @Desc: 本拓展会持续更新

 */
 
layer.use('skin/layer.ext.css', function(){
    layer.ext && layer.ext();
});


/**

 系统prompt
 
*/

layer.prompt = function(parme, yes, no){
    var log = {}, parme = parme || {}, conf = {
        area: parme.area || ['auto', 'auto'],
        offset: [parme.top || '', ''],
        title: parme.title || '&#x4FE1;&#x606F;',
        dialog: {
            btns: 2,
            type: -1,
            msg: '<input type="'+ function(){
                if(parme.type === 1){ //密码
                    return 'password';
                } else if(parme.type === 2) {
                    return 'file';
                } else {
                    return 'text';
                }
            }() +'" class="xubox_prompt xubox_form" id="xubox_prompt" value="'+ (parme.val || '') +'" />',
            yes: function(index){
                var val = log.prompt.val();
                if(val === ''){
                    log.prompt.focus();
                } else if(val.replace(/\s/g, '').length > (parme.length || 1000)) {
                    layer.tips('&#x6700;&#x591A;&#x8F93;&#x5165;'+ (parme.length || 1000) +'&#x4E2A;&#x5B57;&#x6570;', '#xubox_prompt', 2);
                } else {
                    yes && yes(val, index, log.prompt);
                }
                
            }, no: no
        }, success: function(){
            log.prompt = $('#xubox_prompt');
            log.prompt.focus();
        }
    };
    if(parme.type === 3){
        conf.dialog.msg = '<textarea class="xubox_prompt xubox_form xubox_formArea" id="xubox_prompt">'+ (parme.val || '') +'</textarea>'
    }
    if(parme.type === 4){
    	conf.dialog.msg = '<select id="xubox_prompt">';
		var options = parme.options || {};
		for(var k in options){
			conf.dialog.msg += '<option value="'+k+'">'+options[k]+'</option>';
		}
    	conf.dialog.msg += '</select>';
    }
    
    return $.layer(conf);
};