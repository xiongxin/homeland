<extend name="Public/base"/>

<block name="body">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-header widget-header-blue widget-header-flat">
                    <h4 class="lighter">完善档案</h4>
                </div>
                <div class="widget-body" style="position: relative;">
                    <div class="widget-main">
                        <div id="fuelux-wizard" class="row-fluid" data-target="#step-container">
                            <ul class="wizard-steps">
                                <li data-target="#step1" class="active">
                                    <span class="step">1</span>
                                </li>
                                <li data-target="#step2">
                                    <span class="step">2</span>
                                </li>
                                <li data-target="#step3">
                                    <span class="step">3</span>
                                </li>
                            </ul>
                        </div>

                        <hr>
                        <div class="alert alert-block alert-success">
                            <button type="button" class="close" data-dismiss="alert">
                                <i class="icon-remove"></i>
                            </button>

                            <h4 class="green smaller lighter">温馨提示：</h4>
                            请认真填写如下内容，以便于我们进行咨询，谢谢您的支持，愿我们共同成长！
                            <ol>
                                <li>这个表格认真填写</li>
                                <li>填写时请尽量理性真实地反映数据</li>
                                <li>请认真提供尽量多的信息，以便企业情况更准确的分析</li>
                                <li>我们承诺为您完全保密</li>
                            </ol>
                        </div>
                        <form id="company" action="{:U()}" method="post" class="form-horizontal">
                            <div class="step-content row-fluid position-relative" id="step-container">
                                <div class="step-pane active" id="step1">
                                    <div class="row-fluid">
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                企业全名
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <input type="text" class="width-100" name="company_name"
                                                    value="{$item.company_name}">
                                            </div>
                                            <span class="check-tips"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                企业法定代表人
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <input type="text" name="corporation_name" class="width-100"
                                                       value="{$item.corporation_name}">
                                            </div>
                                            <span class="check-tips"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                企业性质
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <select name="enterprise_nature" id="enterprise_nature" data-id="{$item.enterprise_nature}">
                                                    <option value="0">选择企业</option>
                                                    <option value="GFZ">股份制企业</option>
                                                    <option value="SY#">私营企业</option>
                                                    <option value="GT#">个体企业</option>
                                                    <option value="WSD">外商独资企业</option>
                                                    <option value="ZWH">中外合资企业</option>
                                                    <option value="GY#">国营企业</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                企业注册资本
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <input type="text" name="registered_capital" class="width-100"
                                                       value="{$item.registered_capital}">
                                            </div>
                                            <span class="check-tips">（单位：元）</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                股东人数
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <input type="text" name="shareholder_num" class="width-100"
                                                       value="{$item.shareholder_num}">
                                            </div>
                                            <span class="check-tips"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                在企业内任职情况
                                            </label>
                                            <div class="col-xs-12 col-sm-7">
                                                <textarea name="shareholder_num" class="form-control">{$item.shareholder_num}</textarea>
                                            </div>
                                            <span class="help-block col-xs-12 col-sm-reset inline">
                                                企业股东结构及在企业内任职情况
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">营业执照</label>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="upload-wrap">
                                                    <a href="javascript:" class="btn btn-sm btn-success pic-upload" name="business_licence_url"
                                                       val="{$item['business_licence_url']|default=''}" >
                                                        <i class="icon-cloud-upload "></i>上传图片
                                                    </a>
                                                    <notempty name="item['business_licence_url']">
                                                        <div class="preview"><img src="<?=imageView2($item['business_licence_url'],120,120)?>" width="120"/></div>
                                                    </notempty>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">税务登记证</label>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="upload-wrap">
                                                    <a href="javascript:" class="btn btn-sm btn-success pic-upload" name="tax_reg_cert_url"
                                                       val="{$item['tax_reg_cert_url']|default=''}" >
                                                        <i class="icon-cloud-upload "></i>上传图片
                                                    </a>
                                                    <notempty name="item['tax_reg_cert_url']">
                                                        <div class="preview"><img src="<?=imageView2($item['tax_reg_cert_url'],120,120)?>" width="120"/></div>
                                                    </notempty>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">结构代码证</label>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="upload-wrap">
                                                    <a href="javascript:" class="btn btn-sm btn-success pic-upload" name="organization_code_cert_url"
                                                       val="{$item['organization_code_cert_url']|default=''}" >
                                                        <i class="icon-cloud-upload "></i>上传图片
                                                    </a>
                                                    <notempty name="item['organization_code_cert_url']">
                                                        <div class="preview"><img src="<?=imageView2($item['organization_code_cert_url'],120,120)?>" width="120"/></div>
                                                    </notempty>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <h3 class="center"> 企业财务状况</h3>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                是否有银行贷款
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <label><input type="radio" <?= $item['has_bank_loan']=='YES' ? 'checked' : '' ?> class="ace" name="has_bank_loan" value="YES"><span class="lbl">是&nbsp;</span></label>
                                                <label><input type="radio" <?= $item['has_bank_loan']=='NO#' ? 'checked' : '' ?> class="ace" name="has_bank_loan" value="NO#"><span class="lbl">否&nbsp;</span></label>
                                            </div>
                                            <span class="check-tips"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                总资产周转率
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <input type="text" name="total_asset_turnover" class="width-100"
                                                       value="{$item.total_asset_turnover}">
                                            </div>
                                            <span class="check-tips">%</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                应收帐款周转率
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <input type="text" class="width-100" name="accounts_receivable_turnover"
                                                       value="{$item.accounts_receivable_turnover}">
                                            </div>
                                            <span class="check-tips">%</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                毛利润率
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <input type="text" name="gross_profit_margin" class="width-100"
                                                       value="{$item.gross_profit_margin}">
                                            </div>
                                            <span class="check-tips">%</span>
                                        </div>

                                    </div>
                                </div>
                                <div class="step-pane" id="step2">
                                    <hr>
                                    <h3 class="center">企业人员情况</h3>
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                            总人数
                                        </label>
                                        <div class="col-xs-12 col-sm-2">
                                            <input type="text" name="total_people_count" class="width-100"
                                                   value="{$item.total_people_count}">
                                        </div>
                                        <span class="check-tips"></span>
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                            管理人员数量
                                        </label>
                                        <div class="col-xs-12 col-sm-2">
                                            <input type="text" name="manage_people_count" class="width-100"
                                                   value="{$item.manage_people_count}">
                                        </div>
                                        <span class="check-tips"></span>
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                            营销人员数量
                                        </label>
                                        <div class="col-xs-12 col-sm-2">
                                            <input type="text" name="marketing_people_count" class="width-100"
                                                   value="{$item.marketing_people_count}">
                                        </div>
                                        <span class="check-tips"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                            生产人员数量
                                        </label>
                                        <div class="col-xs-12 col-sm-2">
                                            <input type="text" name="production_people_count" class="width-100"
                                                   value="{$item.production_people_count}">
                                        </div>
                                        <span class="check-tips"></span>
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                            技术人员数量
                                        </label>
                                        <div class="col-xs-12 col-sm-2">
                                            <input type="text" name="technology_people_count" class="width-100"
                                                   value="{$item.technology_people_count}">
                                        </div>
                                        <span class="check-tips"></span>
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                            其他人员数量
                                        </label>
                                        <div class="col-xs-12 col-sm-2">
                                            <input type="text" name="other_people_count" class="width-100"
                                                   value="{$item.other_people_count}">
                                        </div>
                                        <span class="check-tips"></span>
                                    </div>

                                    <hr>
                                    <h3 class="center">员工年龄分布</h3>
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                            20岁以下
                                        </label>
                                        <div class="col-xs-12 col-sm-2">
                                            <input type="text" name="people_age_count1" class="width-100"
                                                   value="{$item.people_age_count1}">
                                        </div>
                                        <span class="check-tips"></span>
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                            20-25岁
                                        </label>
                                        <div class="col-xs-12 col-sm-2">
                                            <input type="text" name="people_age_count2" class="width-100"
                                                   value="{$item.people_age_count2}">
                                        </div>
                                        <span class="check-tips"></span>
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                            25-30岁
                                        </label>
                                        <div class="col-xs-12 col-sm-2">
                                            <input type="text" name="people_age_count3" class="width-100"
                                                   value="{$item.people_age_count3}">
                                        </div>
                                        <span class="check-tips"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                            30-35岁
                                        </label>
                                        <div class="col-xs-12 col-sm-2">
                                            <input type="text" name="people_age_count4" class="width-100"
                                                   value="{$item.people_age_count4}">
                                        </div>
                                        <span class="check-tips"></span>
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                            35-40岁
                                        </label>
                                        <div class="col-xs-12 col-sm-2">
                                            <input type="text" name="people_age_count5" class="width-100"
                                                   value="{$item.people_age_count5}">
                                        </div>
                                        <span class="check-tips"></span>
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                            40以上
                                        </label>
                                        <div class="col-xs-12 col-sm-2">
                                            <input type="text" name="people_age_count6" class="width-100"
                                                   value="{$item.people_age_count6}">
                                        </div>
                                        <span class="check-tips"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                            公司管理层是否有亲戚在公司任职
                                        </label>
                                        <div class="col-xs-12 col-sm-6">
                                            <label><input type="radio" <?= $item['has_family_manage']=='YES' ? 'checked' : '' ?> class="ace" name="has_family_manage" value="YES"><span class="lbl">是&nbsp;</span></label>
                                            <label><input type="radio" <?= $item['has_family_manage']=='NO#' ? 'checked' : '' ?> class="ace" name="has_family_manage" value="NO#"><span class="lbl">否&nbsp;</span></label>
                                        </div>
                                        <span class="check-tips"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                            员工流失率（上年度员工流失率）
                                        </label>
                                        <div class="col-xs-12 col-sm-2">
                                            <input type="text" name="employee_turnover" class="width-100"
                                                   value="{$item.employee_turnover}">
                                        </div>
                                        <span class="check-tips"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                           目前企业阶段
                                        </label>
                                        <div class="col-xs-12 col-sm-6">
                                            <label>
                                                <input type="radio" <?= $item['enterprise_stage']=='ZLJ' ? 'checked' : '' ?>
                                                       class="ace" name="enterprise_stage" value="ZLJ">
                                                <span class="lbl">资本积累阶段&nbsp;</span>
                                            </label>
                                            <label>
                                                <input type="radio" <?= $item['enterprise_stage']=='ZTZ' ? 'checked' : '' ?>
                                                       class="ace" name="enterprise_stage" value="ZTZ">
                                                <span class="lbl">战略调整阶段&nbsp;</span>
                                            </label>
                                            <label>
                                                <input type="radio" <?= $item['enterprise_stage']=='CWC' ? 'checked' : '' ?>
                                                       class="ace" name="enterprise_stage" value="CWC">
                                                <span class="lbl">成熟和维持阶段&nbsp;</span>
                                            </label>
                                            <label>
                                                <input type="radio" <?= $item['enterprise_stage']=='CTZ' ? 'checked' : '' ?>
                                                       class="ace" name="enterprise_stage" value="CTZ">
                                                <span class="lbl">业务重新定位阶段&nbsp;</span>
                                            </label>
                                            <label>
                                                <input type="radio" <?= $item['enterprise_stage']=='OTH' ? 'checked' : '' ?>
                                                       class="ace" name="enterprise_stage" value="OTH">
                                                <span class="lbl">其他&nbsp;</span>
                                            </label>
                                        </div>
                                        <span class="check-tips"></span>
                                    </div>
                                    <style>
                                        .my-tips{float: left;font-size: 14px;margin-left: 10px;height: 25px;line-height: 21px;padding-top: 4px;}
                                    </style>
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                            <?= intval(date('Y')) - 3 ?>年企业收入情况
                                        </label>
                                        <span class="check-tips my-tips">营业额：</span>
                                        <div class="col-xs-12 col-sm-2">
                                            <input type="text" name="turnover_year1" class="width-100"
                                                   value="{$item.turnover_year1}"
                                            placeholder="营业额">
                                        </div>
                                        <span class="check-tips my-tips">净利润：</span>
                                        <div class="col-xs-12 col-sm-2">
                                            <input type="text" name="net_margin_year1" class="width-100"
                                                   value="{$item.net_margin_year1}"
                                            placeholder="净利润" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                            <?= intval(date('Y')) - 2 ?>年企业收入情况
                                        </label>
                                        <span class="check-tips my-tips">营业额：</span>
                                        <div class="col-xs-12 col-sm-2">
                                            <input type="text" name="turnover_year2" class="width-100"
                                                   value="{$item.turnover_year2}"
                                                   placeholder="营业额">
                                        </div>
                                        <span class="check-tips my-tips">净利润：</span>
                                        <div class="col-xs-12 col-sm-2">
                                            <input type="text" name="net_margin_year2" class="width-100"
                                                   value="{$item.net_margin_year2}"
                                                   placeholder="净利润"   />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                            <?= intval(date('Y')) - 1 ?>年企业收入情况
                                        </label>
                                        <span class="check-tips my-tips">营业额：</span>
                                        <div class="col-xs-12 col-sm-2">
                                            <input type="text" name="turnover_year3" class="width-100"
                                                   value="{$item.turnover_year3}"
                                                   placeholder="营业额">
                                        </div>
                                        <span class="check-tips my-tips">净利润：</span>
                                        <div class="col-xs-12 col-sm-2">
                                            <input type="text" name="net_margin_year3" class="width-100"
                                                   value="{$item.net_margin_year3}"
                                                   placeholder="净利润"   />
                                        </div>
                                        <span class="check-tips"></span>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                            <?= intval(date('Y')) ?>年企业收入情况
                                        </label>
                                        <span class="check-tips my-tips">营业额：</span>
                                        <div class="col-xs-12 col-sm-2">
                                            <input type="text" name="turnover_year4" class="width-100"
                                                   value="{$item.turnover_year4}"
                                                   placeholder="营业额">
                                        </div>
                                        <span class="check-tips my-tips">净利润：</span>
                                        <div class="col-xs-12 col-sm-2">
                                            <input type="text" name="net_margin_year4" class="width-100"
                                                   value="{$item.net_margin_year4}"
                                                   placeholder="净利润"   />
                                        </div>
                                    </div>

                                </div>
                                <div class="step-pane" id="step3">
                                    <div class="row-fluid">
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                国内营销区域
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <input type="text" name="marketing_area_domestic" class="width-100"
                                                       value="{$item.marketing_area_domestic}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                国外营销区域
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <input type="text" name="marketing_area_abroad" class="width-100"
                                                       value="{$item.marketing_area_abroad}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                销售模式
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <label>
                                                    <input type="radio" <?= $item['sale_mode']=='ZD' ? 'checked' : '' ?>
                                                           class="ace" name="sale_mode" value="ZD">
                                                    <span class="lbl">主动营销&nbsp;</span>
                                                </label>
                                                <label>
                                                    <input type="radio" <?= $item['sale_mode']=='ZR' ? 'checked' : '' ?>
                                                           class="ace" name="sale_mode" value="ZR">
                                                    <span class="lbl">自然营销&nbsp;</span>
                                                </label>
                                            </div>
                                            <span class="check-tips"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                销售的技术要求
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <label>
                                                    <input type="radio" <?= $item['sale_technical_requirements']=='JSX' ? 'checked' : '' ?>
                                                           class="ace" name="sale_technical_requirements" value="JSX">
                                                    <span class="lbl">技术性销售&nbsp;</span>
                                                </label>
                                                <label>
                                                    <input type="radio" <?= $item['sale_technical_requirements']=='NJS' ? 'checked' : '' ?>
                                                           class="ace" name="sale_technical_requirements" value="NJS">
                                                    <span class="lbl">无技术性销售&nbsp;</span>
                                                </label>
                                                <label>
                                                    <input type="radio" <?= $item['sale_technical_requirements']=='YBX' ? 'checked' : '' ?>
                                                           class="ace" name="sale_technical_requirements" value="YBX">
                                                    <span class="lbl">一般技术性销售&nbsp;</span>
                                                </label>
                                            </div>
                                            <span class="check-tips"></span>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                客户类型
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <label>
                                                    <input type="radio" <?= $item['customer_type']=='GR#' ? 'checked' : '' ?>
                                                           class="ace" name="customer_type" value="GR#">
                                                    <span class="lbl">个人消费者&nbsp;</span>
                                                </label>
                                                <label>
                                                    <input type="radio" <?= $item['customer_type']=='DLS' ? 'checked' : '' ?>
                                                           class="ace" name="customer_type" value="DLS">
                                                    <span class="lbl">代理商&nbsp;</span>
                                                </label>
                                                <label>
                                                    <input type="radio" <?= $item['customer_type']=='QY#' ? 'checked' : '' ?>
                                                           class="ace" name="customer_type" value="QY#">
                                                    <span class="lbl">企业&nbsp;</span>
                                                </label>
                                                <label>
                                                    <input type="radio" <?= $item['customer_type']=='PFS' ? 'checked' : '' ?>
                                                           class="ace" name="customer_type" value="PFS">
                                                    <span class="lbl">批发商&nbsp;</span>
                                                </label>
                                            </div>
                                            <span class="check-tips"></span>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                营销流程说明
                                            </label>
                                            <div class="col-xs-12 col-sm-7">
                                                <textarea name="marketing_processes_desc" class="form-control">{$item.marketing_processes_desc}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                企业产品的简介（产品名称、性能、技术及价格、批发、零售、包装等，请罗列出产品的系列及详细的介绍）
                                            </label>
                                            <div class="col-xs-12 col-sm-7">
                                                <textarea style="height: 120px;" name="product_desc" class="form-control">
                                                    {$item.product_desc}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                企业现有的业务模式
                                            </label>
                                            <div class="col-xs-12 col-sm-7">
                                                <textarea name="business_model_desc" class="form-control">{$item.business_model_desc}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                企业现有的运营模式
                                            </label>
                                            <div class="col-xs-12 col-sm-7">
                                                <textarea name="operating_model_desc" class="form-control">{$item.operating_model_desc}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                企业现有的盈利模式
                                            </label>
                                            <div class="col-xs-12 col-sm-7">
                                                <textarea name="profit_model_desc" class="form-control">{$item.profit_model_desc}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                您认为企业目前遇到的困难是什么？出现了哪些问题？（请举具体案例说明）
                                            </label>
                                            <div class="col-xs-12 col-sm-7">
                                                <textarea style="height: 120px;" name="enterprise_difficulty_desc" class="form-control">
                                                    {$item.enterprise_difficulty_desc}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                请写出并联系一个3分钟的自我介绍稿
                                            </label>
                                            <div class="col-xs-12 col-sm-7">
                                                <textarea name="self_introduction_desc" class="form-control">{$item.self_introduction_desc}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                在资本运作上您的期望是什么
                                            </label>
                                            <div class="col-xs-12 col-sm-7">
                                                <textarea name="expectation_desc" class="form-control">{$item.expectation_desc}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                在资本运作上您的期望是什么
                                            </label>
                                            <div class="col-xs-12 col-sm-7">
                                                <textarea name="expectation_desc" class="form-control">{$item.expectation_desc}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                您的企业最希望在哪一个模块需要得到支持？
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <label>
                                                    <input type="radio" <?= $item['need_support']=='顶层商业模型设计' ? 'checked' : '' ?>
                                                           class="ace" name="need_support" value="顶层商业模型设计">
                                                    <span class="lbl">顶层商业模型设计&nbsp;</span>
                                                </label>
                                                <label>
                                                    <input type="radio" <?= $item['need_support']=='商业模式梳理' ? 'checked' : '' ?>
                                                           class="ace" name="need_support" value="商业模式梳理">
                                                    <span class="lbl">商业模式梳理&nbsp;</span>
                                                </label>
                                                <label>
                                                    <input type="radio" <?= $item['need_support']=='股权投资' ? 'checked' : '' ?>
                                                           class="ace" name="need_support" value="股权投资">
                                                    <span class="lbl">股权投资&nbsp;</span>
                                                </label>
                                                <label>
                                                    <input type="radio" <?= $item['need_support']=='股权设计' ? 'checked' : '' ?>
                                                           class="ace" name="need_support" value="股权设计">
                                                    <span class="lbl">股权设计&nbsp;</span>
                                                </label>
                                                <label>
                                                    <input type="radio" <?= $item['need_support']=='招商融资' ? 'checked' : '' ?>
                                                           class="ace" name="need_support" value="招商融资">
                                                    <span class="lbl">招商融资&nbsp;</span>
                                                </label>
                                                <label>
                                                    <input type="radio" <?= $item['need_support']=='企业运营系统' ? 'checked' : '' ?>
                                                           class="ace" name="need_support" value="企业运营系统">
                                                    <span class="lbl">企业运营系统&nbsp;</span>
                                                </label>
                                                <label>
                                                    <input type="radio" <?= $item['need_support']=='渠道建设' ? 'checked' : '' ?>
                                                           class="ace" name="need_support" value="渠道建设">
                                                    <span class="lbl">渠道建设&nbsp;</span>
                                                </label>
                                                <label>
                                                    <input type="radio" <?= $item['need_support']=='企业文化建设' ? 'checked' : '' ?>
                                                           class="ace" name="need_support" value="企业文化建设">
                                                    <span class="lbl">企业文化建设&nbsp;</span>
                                                </label>
                                                <label>
                                                    <input type="radio" <?= $item['need_support']=='人才管理及输送' ? 'checked' : '' ?>
                                                           class="ace" name="need_support" value="人才管理及输送">
                                                    <span class="lbl">人才管理及输送&nbsp;</span>
                                                </label>
                                                <label>
                                                    <input type="radio" <?= $item['need_support']=='财务管理' ? 'checked' : '' ?>
                                                           class="ace" name="need_support" value="财务管理">
                                                    <span class="lbl">财务管理&nbsp;</span>
                                                </label>
                                                <label>
                                                    <input type="radio" <?= $item['need_support']=='企业VI系统' ? 'checked' : '' ?>
                                                           class="ace" name="need_support" value="企业VI系统">
                                                    <span class="lbl">企业VI系统&nbsp;</span>
                                                </label>
                                                <label>
                                                    <input type="radio" <?= $item['need_support']=='新三板新四板挂牌' ? 'checked' : '' ?>
                                                           class="ace" name="need_support" value="新三板新四板挂牌">
                                                    <span class="lbl">新三板新四板挂牌&nbsp;</span>
                                                </label>
                                                <label>
                                                    <input type="radio" <?= $item['need_support']=='企业宣传片、微电影' ? 'checked' : '' ?>
                                                           class="ace" name="need_support" value="企业宣传片、微电影">
                                                    <span class="lbl">企业宣传片、微电影&nbsp;</span>
                                                </label>

                                            </div>
                                            <span class="check-tips"></span>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                请列举出该模块内最希望解决的问题
                                            </label>
                                            <div class="col-xs-12 col-sm-7">
                                                <textarea style="height: 120px;" name="need_support_question" class="form-control">
                                                    {$item.need_support_question}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix form-actions">
                                <div class="col-xs-12">
                                    <a href="javascript:;" class="btn btn-white" onclick="history.go(-1)">
                                        返回
                                    </a>
                                </div>
                            </div>
                        </form>
                        <div class="row-fluid wizard-actions" style="position: absolute;right: 10px;bottom: 40px;">
                            <button class="btn btn-prev" disabled="disabled">
                                <i class="icon-arrow-left"></i>
                                上一步
                            </button>

                            <button class="btn btn-success btn-next" data-last="完成">
                                保存并下一步
                                <i class="icon-arrow-right icon-on-right"></i>
                            </button>
                        </div>

                    </div><!-- /widget-main -->
                </div><!-- /widget-body -->
            </div>
        </div>
    </div>
</block>

<block name="script">
    <include file="Public/upload.js"/>
    <include file="Public/upload.pic"/>
    <script src="__ACE__/js/fuelux/fuelux.wizard.min.js"></script>
    <script src="__ACE__/js/bootbox.min.js"></script>

    <script type="text/javascript">
        jQuery(function($) {
            var $validation = false;
            var url = $('#company').action;
            $('#fuelux-wizard').ace_wizard().on('change' , function(e, info){
                $.ajax({
                    cache: true,
                    type: "POST",
                    url: url,
                    data:$('#company').serialize(),// 你的formid
                    error: function(request) {
                        alert("保存失败");
                    },
                    success: function(data) {
                        console.log(data);
                    }
                });
                if(info.step == 1 && $validation) {
                    if(!$('#validation-form').valid()) return false;
                }
            }).on('finished', function(e) {
                var form = $('#company');
                <if condition="empty($item['check_status'])">
                    form.append('<input type="hidden" name="check_status" value="WAT" />');
                $.ajax({
                    cache: true,
                    type: "POST",
                    url: url,
                    data:form.serialize(),
                    error: function(request) {
                        alert("保存失败");
                    },
                    success: function(data) {
                        bootbox.dialog({
                            message: "保存成功，客服人员将在三个工作日内审核！",
                            buttons: {
                                "success" : {
                                    "label" : "OK",
                                    "className" : "btn-sm btn-primary"
                                }
                            }
                        });
                    }
                });
                <elseif condition="$item['check_status'] eq 'WAT'"/>
                    $.ajax({
                        cache: true,
                        type: "POST",
                        url: url,
                        data:form.serialize(),
                        error: function(request) {
                            alert("保存失败");
                        },
                        success: function(data) {
                            bootbox.dialog({
                                message: "保存成功，您的资料已经提交审核，请耐心等待",
                                buttons: {
                                    "success" : {
                                        "label" : "OK",
                                        "className" : "btn-sm btn-primary"
                                    }
                                }
                            });
                        }
                    });
                <elseif condition="$item['check_status'] eq 'OK#'"/>
                    $.ajax({
                        cache: true,
                        type: "POST",
                        url: url,
                        data:form.serialize(),
                        error: function(request) {
                            alert("保存失败");
                        },
                        success: function(data) {
                            bootbox.dialog({
                                message: "保存成功，您的资料已经通过审核！",
                                buttons: {
                                    "success" : {
                                        "label" : "OK",
                                        "className" : "btn-sm btn-primary"
                                    }
                                }
                            });
                        }
                    });
                </if>
            });

            //企业性质
            var enterprise_nature = $('#enterprise_nature');
            var eid = enterprise_nature.data('id');
            if (!!eid)enterprise_nature.val(eid);

            //导航高亮
            highlight_subnav('{:U('my/company')}');
        })
    </script>

</block>