<header class="header">
    <div class="fix_nav">
        <div class="nav_inner">
            <a class="nav-left back-icon" href="javascript:goback();">返回</a>
            <div class="tit"><?=$cate_name?></div>
        </div>
    </div>
</header>

<div id="article" class="article-wrapper">
    <div class="article-bd">
        <ul class="article-list media-bd">
            <?php if(empty($list)):?>
            <li><div>您所查看的目录还没有内容！</div></li>
            <?php endif;?>
            <?php foreach($list as $item):?>
            <li>
                <a href="/article/info/id/<?=$item['id']?>.html">
                    <h3><?=$item['title']?></h3>
                    <div class="time"><?=date('Y年m月d日',$item['update_time'])?></div>
                    <div class="pic">
                        <img alt="" src="<?=imageView2($item['pic_url'],592,330)?>">
                    </div>
                    <p class="summary">
                        <?=$item['description']?>
                    </p>
                    <div class="operation">
                        <span class="text">阅读原文</span>
                        <span class="icon-right"></span>
                    </div>
                </a>
            </li>
            <?php endforeach;?>
        </ul>
    </div>

    <?php include APP_PATH.'views/common/page.php'?>
</div>
<block name="style">
    <link rel="stylesheet" href="/v2/css/main.css">
</block>
