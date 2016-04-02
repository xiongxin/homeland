 <div class="row">
    <div class="col-sm-12">

    <?php if(isset($company_info)):?>
        <div class="col-xs-12">
            <h3 class="header smaller lighter green">
                快捷入口
            </h3>

            <p>
                <a href="<?=U('my/reg')?>" class="btn btn-primary btn-app radius-4">
                    <i class="icon-cog bigger-230"></i>
                    注册信息
                </a>
                <?php if(!empty($company_info) && $company_info['check_status'] == 'OK#'):?>
                <a href="<?=U('my/companyedit')?>" class="btn btn-success btn-app radius-4">
                    <i class="icon-edit bigger-230"></i>
                    建档信息
                </a>
                <a href="<?=U('my/courses')?>" class="btn btn-pink btn-app radius-4">
                    <i class="icon-shopping-cart bigger-230"></i>
                    我的课程
                </a>
                <?php endif;?>
            </p>

            <?php if(empty($company_info)):?>
            <p>
                <div class="alert alert-danger">
                    您需要先完善了建档，才能进行课程相关的操作！
                </div>
                <a href="<?=U('my/companyedit')?>" class="btn btn-success">完善建档信息</a>
            </p>
            <?php elseif($company_info['check_status'] == 'WAT'):?>
            <div class="alert alert-info">
                您的建档信息正在审核，审核通过后，您将可以进行课程相关的操作！
            </div>
            <?php endif;?>
        </div>
    <?php else:?>
        <div class="infobox infobox-green">
            <div class="infobox-icon">
                <i class="icon-group"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number">{$info.user}</span>
                <div class="infobox-content">用户数</div>
            </div>
        </div>

        <div class="infobox infobox-blue">
            <div class="infobox-icon">
                <i class="icon-briefcase"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number">{$info.action}</span>
                <div class="infobox-content">用户行为</div>
            </div>

        </div>

        <div class="infobox infobox-pink">
            <div class="infobox-icon">
                <i class="icon-text-width"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number">{$info.document}</span>
                <div class="infobox-content">文档数</div>
            </div>
        </div>

        <div class="infobox infobox-red">
            <div class="infobox-icon">
                <i class="icon-beaker"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number">{$info.model}</span>
                <div class="infobox-content">文档模型</div>
            </div>
        </div>

        <div class="infobox  infobox-blue">
            <div class="infobox-icon">
                <i class="icon-list-alt"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number">{$info.category}</span>
                <div class="infobox-content">分类数</div>
            </div>
        </div>
    <?php endif;?>

    </div>
</div><!-- /row -->
<div class="hr hr32 hr-dotted"></div>