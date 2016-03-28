<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title><?=isset($meta_title) ? $meta_title.' - ' : ''?>百合花</title>
    <link href="/style/weui.css" rel="stylesheet" type="text/css" />
    <block name="style"></block>
</head>

<body ontouchstart>

<block name="header">
<?php if(isset($title)):?>
    <header class="header">
        <a href="<?=(isset($back_url) ? $back_url : 'javascript:back();')?>" class="back"><i class="ico i-back"></i></a>
        <div class="txt"><?=$title?></div>
    </header>
<?php endif;?>
</block>

<?php echo $content?>

<script type="text/javascript" src="//cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
<script type="text/javascript" src="/js/common.js"></script>
<script type="text/javascript" src="//7xrote.com2.z0.glb.qiniucdn.com/layer.mobile.js"></script>
<block name="script">

</block>
</body>
</html>
