<div class="container">
    <div class="row">
        <div id="slide">
            <div class="hd">
                <ul></ul>
            </div>
            <div class="bd">
                <ul>
                    <?php foreach ($banners[1] as $banner):?>
                    <li>
                        <a href="<?=$banner['link']?>">
                            <img _src="<?=imageView2($banner['pic'],447,173)?>" ppsrc="<?=imageView2($banner['pic'],447,173)?>"/>
                        </a>
                    </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div>
    <div class="row category">
        <?php foreach($cate_list as $item):
            $item['link'] = ($item['pid'] == 39 ? '/article/list/cate_id/'.$item['id'].'.html' : $item['link']);
        ?>
        <a href="<?=$item['link']?>" class="col-xs-4 mt10">
            <img class="img-responsive" src="<?=$item['pic_url']?>">
            <?=$item['title']?>
        </a>
        <?php endforeach;?>
    </div>
    <div class="row">
        <div class="tb_box">
            <h2 class="tab_tit">
                <?=$banners[2][0]['name']?>
            </h2>
            <div class="tb_type tb_type_even clearfix" style="padding-top: 1px;">
                <?=$banners[2][0]['content']?>
            </div>
        </div>
    </div>
</div>

<block name="script">
<script type="text/javascript" src="/v2/js/TouchSlide.1.1.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('embed').css({width:$(".container").width()+30,height:'auto'});

    $("#slide img").each(function(){
        var img_src=$(this).attr("_src");
        $(this).attr("src",img_src);
    });
    TouchSlide({
        slideCell:"#slide",
        titCell:".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
        mainCell:".bd ul",
        effect:"left",
        autoPlay:true,//自动播放
        autoPage:true, //自动分页
        interTime:5000,
        switchLoad:"_src" //切换加载，真实图片路径为"_src"
    });

    $(".foot-con_2 a:eq(0)").addClass('active');
})
</script>
</block>
