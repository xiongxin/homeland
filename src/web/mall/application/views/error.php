    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">温馨提示</h3>
        </div>
        <div class="panel-body">
            <div class="alert alert-danger" role="alert">
                <p><?=$message?></p>
            </div>
            <p>
                页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
            </p>

            <a href="/" >点这里回首页</a>
        </div>
    </div>

<block name="script">
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
</block>
