<extend name="Public/base"/>

<block name="body">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-header widget-header-blue widget-header-flat">
                    <h4 class="lighter">New Item Wizard</h4>

                    <div class="widget-toolbar">
                        <label>
                            <small class="green">
                                <b>Validation</b>
                            </small>

                            <input id="skip-validation" type="checkbox" class="ace ace-switch ace-switch-4">
                            <span class="lbl"></span>
                        </label>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <div id="fuelux-wizard" class="row-fluid" data-target="#step-container">
                            <ul class="wizard-steps">
                                <li data-target="#step1" class="active">
                                    <span class="step">1</span>
                                    <span class="title">Validation states</span>
                                </li>

                                <li data-target="#step2">
                                    <span class="step">2</span>
                                    <span class="title">Alerts</span>
                                </li>

                                <li data-target="#step3">
                                    <span class="step">3</span>
                                    <span class="title">Payment Info</span>
                                </li>

                                <li data-target="#step4">
                                    <span class="step">4</span>
                                    <span class="title">Other Info</span>
                                </li>
                            </ul>
                        </div>

                        <hr>
                        <div class="step-content row-fluid position-relative" id="step-container">
                            <div class="step-pane active" id="step1">
                                <h3 class="lighter block green">Enter the following information</h3>

                                <form class="form-horizontal" id="sample-form">
                                    <div class="form-group has-warning">
                                        <label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Input with warning</label>

                                        <div class="col-xs-12 col-sm-5">
																		<span class="block input-icon input-icon-right">
																			<input type="text" id="inputWarning" class="width-100">
																			<i class="icon-leaf"></i>
																		</span>
                                        </div>
                                        <div class="help-block col-xs-12 col-sm-reset inline">
                                            Warning tip help!
                                        </div>
                                    </div>

                                    <div class="form-group has-error">
                                        <label for="inputError" class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Input with error</label>

                                        <div class="col-xs-12 col-sm-5">
																		<span class="block input-icon input-icon-right">
																			<input type="text" id="inputError" class="width-100">
																			<i class="icon-remove-sign"></i>
																		</span>
                                        </div>
                                        <div class="help-block col-xs-12 col-sm-reset inline"> Error tip help! </div>
                                    </div>

                                    <div class="form-group has-success">
                                        <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right">Input with success</label>

                                        <div class="col-xs-12 col-sm-5">
																		<span class="block input-icon input-icon-right">
																			<input type="text" id="inputSuccess" class="width-100">
																			<i class="icon-ok-sign"></i>
																		</span>
                                        </div>
                                        <div class="help-block col-xs-12 col-sm-reset inline">
                                            Success tip help!
                                        </div>
                                    </div>

                                    <div class="form-group has-info">
                                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Input with info</label>

                                        <div class="col-xs-12 col-sm-5">
																		<span class="block input-icon input-icon-right">
																			<input type="text" id="inputInfo" class="width-100">
																			<i class="icon-info-sign"></i>
																		</span>
                                        </div>
                                        <div class="help-block col-xs-12 col-sm-reset inline"> Info tip help! </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputError2" class="col-xs-12 col-sm-3 control-label no-padding-right">Input with error</label>

                                        <div class="col-xs-12 col-sm-5">
																		<span class="input-icon block">
																			<input type="text" id="inputError2" class="width-100">
																			<i class="icon-remove-sign red"></i>
																		</span>
                                        </div>
                                        <div class="help-block col-xs-12 col-sm-reset inline"> Error tip help! </div>
                                    </div>
                                </form>

                            </div>

                            <div class="step-pane" id="step2">
                                <div class="row-fluid">
                                    <div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="icon-remove"></i>
                                        </button>

                                        <strong>
                                            <i class="icon-ok"></i>
                                            Well done!
                                        </strong>

                                        You successfully read this important alert message.
                                        <br>
                                    </div>

                                    <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="icon-remove"></i>
                                        </button>

                                        <strong>
                                            <i class="icon-remove"></i>
                                            Oh snap!
                                        </strong>

                                        Change a few things up and try submitting again.
                                        <br>
                                    </div>

                                    <div class="alert alert-warning">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="icon-remove"></i>
                                        </button>
                                        <strong>Warning!</strong>

                                        Best check yo self, you're not looking too good.
                                        <br>
                                    </div>

                                    <div class="alert alert-info">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="icon-remove"></i>
                                        </button>
                                        <strong>Heads up!</strong>

                                        This alert needs your attention, but it's not super important.
                                        <br>
                                    </div>
                                </div>
                            </div>

                            <div class="step-pane" id="step3">
                                <div class="center">
                                    <h3 class="blue lighter">This is step 3</h3>
                                </div>
                            </div>

                            <div class="step-pane" id="step4">
                                <div class="center">
                                    <h3 class="green">Congrats!</h3>
                                    Your product is ready to ship! Click finish to continue!
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row-fluid wizard-actions">
                            <button class="btn btn-prev" disabled="disabled">
                                <i class="icon-arrow-left"></i>
                                Prev
                            </button>

                            <button class="btn btn-success btn-next" data-last="Finish ">
                                Next
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
    <script type="text/javascript">
        (function(b,c){var a=function(f,e){var d;this.$element=b(f);this.options=b.extend({},b.fn.wizard.defaults,e);this.currentStep=1;this.numSteps=this.$element.find("li").length;this.$prevBtn=this.$element.find("button.btn-prev");this.$nextBtn=this.$element.find("button.btn-next");d=this.$nextBtn.children().detach();this.nextText=b.trim(this.$nextBtn.text());this.$nextBtn.append(d);this.$prevBtn.on("click",b.proxy(this.previous,this));this.$nextBtn.on("click",b.proxy(this.next,this));this.$element.on("click","li.complete",b.proxy(this.stepclicked,this));this.$stepContainer=this.$element.data("target")||"body";this.$stepContainer=b(this.$stepContainer)};a.prototype={constructor:a,setState:function(){var n=(this.currentStep>1);var o=(this.currentStep===1);var d=(this.currentStep===this.numSteps);this.$prevBtn.attr("disabled",(o===true||n===false));var h=this.$nextBtn.data();if(h&&h.last){this.lastText=h.last;if(typeof this.lastText!=="undefined"){var l=(d!==true)?this.nextText:this.lastText;var f=this.$nextBtn.children().detach();this.$nextBtn.text(l).append(f)}}var j=this.$element.find("li");j.removeClass("active").removeClass("complete");j.find("span.badge").removeClass("badge-info").removeClass("badge-success");var m="li:lt("+(this.currentStep-1)+")";var g=this.$element.find(m);g.addClass("complete");g.find("span.badge").addClass("badge-success");var e="li:eq("+(this.currentStep-1)+")";var k=this.$element.find(e);k.addClass("active");k.find("span.badge").addClass("badge-info");var i=k.data().target;this.$stepContainer.find(".step-pane").removeClass("active");b(i).addClass("active");this.$element.trigger("changed")},stepclicked:function(h){var d=b(h.currentTarget);var g=this.$element.find("li").index(d);var f=b.Event("stepclick");this.$element.trigger(f,{step:g+1});if(f.isDefaultPrevented()){return}this.currentStep=(g+1);this.setState()},previous:function(){var d=(this.currentStep>1);if(d){var f=b.Event("change");this.$element.trigger(f,{step:this.currentStep,direction:"previous"});if(f.isDefaultPrevented()){return}this.currentStep-=1;this.setState()}},next:function(){var g=(this.currentStep+1<=this.numSteps);var d=(this.currentStep===this.numSteps);if(g){var f=b.Event("change");this.$element.trigger(f,{step:this.currentStep,direction:"next"});if(f.isDefaultPrevented()){return}this.currentStep+=1;this.setState()}else{if(d){this.$element.trigger("finished")}}},selectedItem:function(d){return{step:this.currentStep}}};b.fn.wizard=function(e,g){var f;var d=this.each(function(){var j=b(this);var i=j.data("wizard");var h=typeof e==="object"&&e;if(!i){j.data("wizard",(i=new a(this,h)))}if(typeof e==="string"){f=i[e](g)}});return(f===c)?d:f};b.fn.wizard.defaults={};b.fn.wizard.Constructor=a;b(function(){b("body").on("mousedown.wizard.data-api",".wizard",function(){var d=b(this);if(d.data("wizard")){return}d.wizard(d.data())})})})(window.jQuery);
        (function ($) {
            var $validation = false;
            $('#fuelux-wizard').ace_wizard().on('change' , function(e, info){
                if(info.step == 1 && $validation) {
                    if(!$('#validation-form').valid()) return false;
                }
            }).on('finished', function(e) {
                bootbox.dialog({
                    message: "Thank you! Your information was successfully saved!",
                    buttons: {
                        "success" : {
                            "label" : "OK",
                            "className" : "btn-sm btn-primary"
                        }
                    }
                });
            }).on('stepclick', function(e){
                //return false;//prevent clicking on steps
            });

            $('#skip-validation').removeAttr('checked').on('click', function(){
                $validation = this.checked;
                if(this.checked) {
                    $('#sample-form').hide();
                    $('#validation-form').removeClass('hide');
                }
                else {
                    $('#validation-form').addClass('hide');
                    $('#sample-form').show();
                }
            });


            $('#modal-wizard .modal-header').ace_wizard();
            $('#modal-wizard .wizard-actions .btn[data-dismiss=modal]').removeAttr('disabled');



        })(jQuery);
    </script>
</block>