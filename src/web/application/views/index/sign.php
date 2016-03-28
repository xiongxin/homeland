<div class="page">
    <div class="hd">
        <div class="bd spacing">
            <a href="javascript:;" class="weui_btn weui_btn_primary">点击扫码签到</a>
        </div>
    </div>
    <div class="bd" id="js-container">
        <!--<a href="javascript:;" class="weui_btn weui_btn_primary">点击展现searchBar</a>-->
        <div class="weui_search_bar" id="search_bar">
            <form action="<?U('/index/search')?>" class="weui_search_outer ajax-form" method="post" success="search_success">
                <div class="weui_search_inner">
                    <i class="weui_icon_search"></i>
                    <input type="search" pattern="[0-9]{11}" class="weui_search_input" id="search_input" placeholder="搜索" required/>
                    <a href="javascript:" class="weui_icon_clear" id="search_clear"></a>
                </div>
                <label for="search_input" class="weui_search_text" id="search_text">
                    <i class="weui_icon_search"></i>
                    <span>输入手机号码</span>
                </label>
            </form>
            <a href="javascript:" class="weui_search_cancel" id="search_cancel">取消</a>
        </div>
        <div class="weui_cells weui_cells_access search_show" id="search_show">
            <div class="weui_cell">
                <div class="weui_cell_bd weui_cell_primary">
                    <p>实时搜索文本</p>
                </div>
            </div>
        </div>
    </div>
</div>
<block name="script">
<script>
$(function(){

    var events = {
        '#search_input':{
            focus:function(){
                //searchBar
                var $weuiSearchBar = $('#search_bar');
                $weuiSearchBar.addClass('weui_search_focusing');
            },
            blur:function(){
                var $weuiSearchBar = $('#search_bar');
                $weuiSearchBar.removeClass('weui_search_focusing');
            },
            input:function(){

            }
        }
    };

    var contriner = $('#js-container');
    for (var t in events) {
        for (var type in events[t]) {
            contriner.on(type, t, events[t][type]);
        }
    }

});

function search_success(form,resp){
    alert('aaa');
    alert(resp.status);
}
</script>
</block>
