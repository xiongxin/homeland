<!DOCTYPE html>
<html lang="zh-cn">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="yes" name="apple-mobile-web-app-capable"/>
<meta content="yes" name="apple-touch-fullscreen"/>
<meta content="telephone=no" name="format-detection"/>
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1;user-scalable=no;">
<title><?php if(isset($layout['title'])):?><?=$layout['title']?><?php else:?>天天加油<?php endif;?></title>
<meta name="keywords" content="<?php if(isset($layout['keywords'])):?><?=$layout['keywords']?><?php else:?>天天加油,SDP,专业汽车服务电商平台<?php endif;?>">
<meta name="description" content="<?php if(isset($layout['description'])):?><?=$layout['description']?><?php else:?>专业汽车服务电商平台，产品包括加油卡、汽车配件、汽车美容，以及油站和油品的专业知识介绍<?php endif;?>">
<meta name="Author" Content="" />
<meta name="Copyright" Content="深圳麦圈互动技术有限公司。All Rights Reserved" />

<link rel="stylesheet" href="/v2/css/bootstrap.min.css">
<link rel="stylesheet" href="/v2/css/style.css">
<script type="text/javascript" src="/v2/js/jquery.min.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

<body>

<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">温馨提示</h3>
        </div>
        <div class="panel-body">
            <div class="alert alert-success" role="alert">
                <p><?=$message?></p>
            </div>
            <p>
                页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
            </p>

            <a href="/" >点这里回首页</a>
        </div>
    </div>

</div>

<?php include APP_PATH.'views/common/nav.php'?>
<script type="text/javascript">
    (function(){
        var wait = document.getElementById('wait'),href = document.getElementById('href').href;
        var interval = setInterval(function(){
            var time = --wait.innerHTML;
            if(time <= 0) {
                location.href = href;
                clearInterval(interval);
            };
        }, 1000);
    })();
</script>
</body>
</html>
