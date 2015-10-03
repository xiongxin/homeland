<?php if(!empty($page)):?>
    <div class="wap_page">
        <?=$page?>
    </div>
    <div class="order_i_h"></div>
    <style>

        .wap_page {
            width: 304px;
            margin: 0 auto;
            text-align: center;
            padding: 10px 0;
        }
        .wap_page a {
            display: inline-block;
            zoom: 1;
            padding: 8px 10px;
            color: #888888;
            border: 1px solid #d3d3d3;
            margin: 0 5px;
            background-image: -webkit-gradient(linear, 0 0, 0 100%, color-stop(0, #fffdfe), color-stop(0.05, #fffdfe), color-stop(1, #ededed));
            background-image: -moz-linear-gradient(top, #fffdfe, #fffdfe 5%, #ededed);
            background-image: -o-linear-gradient(top, #fffdfe, #fffdfe 5%, #ededed);
            text-decoration: none;
        }

    </style>
<?php endif;?>