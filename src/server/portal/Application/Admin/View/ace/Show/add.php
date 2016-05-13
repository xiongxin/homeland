<extend name="Public/base"/>
<block name="body">
    <link href="__ACE__/resource/css/font-awesome.min.css" rel="stylesheet">
    <link href="__ACE__/resource/css/common.css" rel="stylesheet">
    <script>var require = { urlArgs: 'v=2016051220' };</script>
    <script src="__ACE__/resource/js/lib/jquery-1.11.1.min.js"></script>
    <script src="__ACE__/resource/js/app/util.js"></script>
    <script src="__ACE__/resource/js/require.js"></script>
    <script src="__ACE__/resource/js/app/config.js"></script>
    <!--[if lt IE 9]>
    <script src="__ACE__/resource/js/html5shiv.min.js"></script>
    <script src="__ACE__/resource/js/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
        window.sysinfo = {};
    </script>
    <script type="text/javascript">
        require(['bootstrap']);
        $('.js-clip').each(function(){
            util.clip(this, $(this).attr('data-url'));
        });
    </script>
    <link href="__ACE__/resource/css/app.css" rel="stylesheet">
    <form action="{:U('')}" method="post" ng-controller="commonCtrl">
        <if condition="!empty($item)">
            <input type="hidden" name="id" value="{$item.id}" />
        </if>
        <div class="app clearfix" ng-controller="mainCtrl">
            <input type="hidden" name="wapeditor[params]" id="wapeditor-params" value="{{submit.params}}" />
            <input type="hidden" name="wapeditor[html]" id="wapeditor-html" value="{{submit.html}}" />
            <div class="app-preview">
                <div class="app-header"></div>
                <div class="app-content" ng-style="{'background-color' : activeModules[0].params.bgColor}">
                    <div class="modules">
                        <div ng-if="module['id']" id="module-{{module.index}}" name="{{module.id}}" index="{{module.index}}" ng-class="{'modules-actions': activeItem.index == module.index, 'js-sorttable' : !module.issystem}" ng-repeat="module in activeModules | orderBy:'displayorder'"  ng-style="{'border' : module.issystem ? 'none' : ''}">
                            <div ng-init="displayPanel = ('widget-'+(module['id'].toLowerCase())+'-display.html')" ng-include="displayPanel" ng-click="editItem(module.index)"></div>
                            <!--自定义模块编辑部分-->
                            <div class="text-right action-wrap">
                                <span class="label-default action edit" ng-click="editItem(module.index)">编辑</span>
                                <!--span class="label-default action app-add">加内容</span-->
                                <span class="label-default action remove" data-container="body" data-toggle="popover" data-placement="left" ng-click="deleteItem(module.index)">删除</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-region">
                    <div class="arrow-top"></div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h4 class="text-center">添加内容</h4>
                            <ul class="app-add-filed clearfix">
                                <li ng-repeat="m in modules" ng-if="!m.issystem" ng-click="addItem(m['id'])"><a id="{{m['id']}}" class="btn btn-default" href="#" ng-bind="m['name']"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-side">
                <div ng-init="editorPanel = ('widget-'+(activeItem['id'].toLowerCase())+'-editor.html'.toLowerCase())" ng-show="activeItem.id == editorid" ng-repeat="editorid in editors" ng-include="editorPanel" id="editor{{editorid}}" class="editor"></div>
            </div>
            <div class="shop-preview col-xs-12 col-sm-9 col-lg-10">
                <div class="text-center alert alert-warning">
                    <button type='submit'
                            class="btn btn-sm btn-success no-border js-editor-submit">上架</button>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="__ACE__/resource/components/ueditor/ueditor.config.js"></script>
        <script type="text/javascript" src="__ACE__/resource/components/ueditor/ueditor.all.min.js"></script>
        <script type="text/javascript" src="__ACE__/resource/components/ueditor/lang/zh-cn/zh-cn.js"></script>

        <script type="text/javascript">
            var ueditoroption = {
                'autoClearinitialContent' : false,
                'toolbars' : [['fullscreen', 'source', 'preview', '|', 'bold', 'italic', 'underline', 'strikethrough', 'forecolor', 'backcolor', '|',
                    'justifyleft', 'justifycenter', 'justifyright', '|', 'insertorderedlist', 'insertunorderedlist', 'blockquote', 'emotion', 'insertvideo',
                    'link', 'removeformat', '|', 'rowspacingtop', 'rowspacingbottom', 'lineheight','indent', 'paragraph', 'fontsize', '|',
                    'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol',
                    'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', '|', 'anchor', 'map', 'print', 'drafts']],
                'elementPathEnabled' : false,
                'initialFrameHeight': 200,
                'focus' : false,
                'maximumWords' : 1000000
            };
            var opts = {
                type :'image',
                direct : false,
                multi : true,
                tabs : {
                    'upload' : 'active',
                    'browser' : '',
                    'crawler' : ''
                },
                path : '',
                dest_dir : '',
                global : false,
                thumb : false,
                width : 0
            };
            UE.registerUI('myinsertimage',function(editor,uiName){
                editor.registerCommand(uiName, {
                    execCommand:function(){
                        require(['fileUploader'], function(uploader){
                            uploader.show(function(imgs){
                                if (imgs.length == 0) {
                                    return;
                                } else if (imgs.length == 1) {
                                    editor.execCommand('insertimage', {
                                        'src' : imgs[0]['url'],
                                        '_src' : imgs[0]['attachment'],
                                        'width' : '100%',
                                        'alt' : imgs[0].filename
                                    });
                                } else {
                                    var imglist = [];
                                    for (i in imgs) {
                                        imglist.push({
                                            'src' : imgs[i]['url'],
                                            '_src' : imgs[i]['attachment'],
                                            'width' : '100%',
                                            'alt' : imgs[i].filename
                                        });
                                    }
                                    editor.execCommand('insertimage', imglist);
                                }
                            }, opts);
                        });
                    }
                });
                var btn = new UE.ui.Button({
                    name: '插入图片',
                    title: '插入图片',
                    cssRules :'background-position: -726px -77px',
                    onclick:function () {
                        editor.execCommand(uiName);
                    }
                });
                editor.addListener('selectionchange', function () {
                    var state = editor.queryCommandState(uiName);
                    if (state == -1) {
                        btn.setDisabled(true);
                        btn.setChecked(false);
                    } else {
                        btn.setDisabled(false);
                        btn.setChecked(state);
                    }
                });
                return btn;
            }, 19);

        </script>		
        <script type="text/javascript">
            $(function(){
                $('.modules').click(function(){
                    return false;
                });
                require(['wapeditor'], function() {
                    activeModules = <?= !empty($item['params']) ? $item['params'] : 'null' ?>;
                    angular.bootstrap(document, ['app']);
                });
            });
        </script>
    </form>
</block>
