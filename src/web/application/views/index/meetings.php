<div class="page slideIn cell">
    <div class="hd">
        <h1 class="page_title">会议报名</h1>
    </div>
    <div class="weui_panel_bd">
        <?php foreach ($list as $item) { ?>
            <div class="weui_media_box weui_media_text">
                <a href="<?= U('public/enroll?meeting_id=' . $item['id']) ?>">
                    <h4 class="weui_media_title"><?= $item['title'] ?></h4>
                    <p class="weui_media_desc"><?= $item['subheading'] ?></p>
                    <ul class="weui_media_info">
                        <li class="weui_media_info_meta">会议时间：<?= $item['agenda_date'] ?></li>
                    </ul>
                </a>
            </div>
        <?php } ?>
    </div>
</div>