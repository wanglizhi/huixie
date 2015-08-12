
<div class="tab-pane active" id="ta_info">
	<div class="portlet-body form">

		<!-- BEGIN FORM-->
		<form action="<?php echo site_url(ADMIN_PREFIX."ta/updateTa")?>
			" class="form-horizontal" id="updateTaForm" method="post">
			<div class="row-fluid">
				<div class="control-group">

					<label class="control-label">
						OpenId:
						<span class="required">*</span>
					</label>

					<div class="controls">
						<input type="text" id="openId" name="openId" data-required="1" class="span6 m-wrap" value="<?=$ta['openid']?>" readonly="readonly"></div>

					</div>
					<div class="control-group">

						<label class="control-label">
							邮箱:
							<span class="required">*</span>
						</label>

						<div class="controls">
							<input type="text" id="email" name="email" data-required="1" class="span6 m-wrap" placeHolder="请输入Email" value="<?=$ta['email']?>"></div>

						</div>
						<div class="control-group">

							<label class="control-label">
								技能:
								<span class="required">*</span>
							</label>

							<div class="controls">
								<select id="skill_choose" name="skill_choose" data-placeholder="请选择技能" class="chosen span6" multiple="multiple" tabindex="6" style="display: inline-block">

									<option value=""></option>
								</select>
								<div style="display: inline-block;" class="chzn-label">
									<input id="skill" name="skill" type="text" data-required="1" style="width: 1px;visibility: hidden;"/>
								</div>
							</div>

						</div>
						<div class="control-group">
							<label class="control-label">
								技能评价:
								<span class="required">*</span>
							</label>
							<div class="controls ">
								<div style="display: inline-block;" id="skill_star" name="skill_star" ></div>
								<input id="star" name="star" type="text" data-required="1" style="width:1px;visibility: hidden;"/>
							</div>
						</div>

						<div class="control-group">

							<label class="control-label">
								单页价钱:
								<span class="required">*</span>
							</label>
							<div class="controls">

								<div class="input-prepend span2">

									<span class="add-on">$</span>
									<input id="unitPrice" name="unitPrice" class="m-wrap span12" type="text" value="<?=$ta['unitPrice']?>"></div>

								</div>

							</div>
							<div class="control-group">

								<label class="control-label">
									实际工资:
									<span class="required">*</span>
								</label>
								<div class="controls">

									<div class="input-prepend span2">

										<span class="add-on">$</span>
										<input id="actualPrice" name="actualPrice" class="m-wrap span12" type="text" value="<?=$ta['actualPrice']?>"></div>

									</div>

								</div>
								<div class="control-group">

									<label class="control-label">审核状态: </label>

									<div class="controls">

										<select id="hasCheck" name="hasCheck" class="small m-wrap" tabindex="1">
											<option value="0" <?php if(!$ta['hasCheck']) echo "selected";?> >待审核</option>

											<option value="1" <?php if($ta['hasCheck']) echo "selected";?>>已审核</option>

										</select>

									</div>

								</div>
								<div class="control-group">

									<label class="control-label">
										简介:
										<span class="required">*</span>
									</label>

									<div class="controls">
										<textarea id="introduction" name="introduction" data-required="1" class="large span6" rows="5" placeHolder="请输入简介" ><?=$ta['introduction']?></textarea>
									</div>

								</div>
							</div>
							<div class="form-actions" style="background: transparent;">

								<button type="submit" class="btn blue span2"> <i class="icon-ok"></i>
									修改
								</button>

							</div>

						</form>
						<!-- END FORM-->

					</div>
				</div>
				<div class="tab-pane" id="ta_order">
					<div class="portlet-body">
						<?php
						$taOrderTable['js_page_method'] = "change_ta_order_page";
						$dataTaOrder['orderTable'] = $taOrderTable;
						$this->load->view(ADMIN_PREFIX."order_table",$dataTaOrder);
						?>
						<script type="text/javascript">
						var ta_sort_key = "createTime",ta_sort_method = "desc",ta_current_page = 1;
						function change_ta_order_page(page,key,method,callBack){

							if(page===undefined) page = ta_current_page;
							if(key===undefined) key = ta_sort_key;
							if(method===undefined) method = ta_sort_method;
							var tableId = "<?=$taOrderTable['tableId']?>";
							$.ajax({
								url: "<?php echo site_url($taOrderTable['page_info']['page_method'])?>",
								type: "get",
								data: {'page':page,'js_page_method': "change_ta_order_page",'openid': "<?=$ta['openid']?>",'sort_key': key,'sort_method':method,},
								dataType: "html",
								success: function(data){
									$('#'+tableId).html(' ');
									$('#'+tableId).html(data);
									ta_sort_key = key,ta_sort_method = method,ta_current_page = page;
									if(callBack!==undefined) callBack();
								},
							});
						}
						</script>
					</div>
				</div>
				<script src="js/majorData.js" type="text/javascript"></script>
				<script>
				function test(){
					$.ajax({
						type: "GET",
						url: "<?php echo site_url(ADMIN_PREFIX.'order/test')?>",
						data: {page: 1,},
						success: function(data){
							alert(data);
						},
					});
				}
				$('#skill_star').raty({
					path      : 'media/image',
					half      : true,
					starHalf  : 'star-half.png',
					starOff   : 'star-off.png',
					starOn    : 'star-on.png',
					<?php if($ta['star']!=""):?>
					score     : <?=$ta['star']?>
					<?php endif;?>
				});

				var updateSkill = function(){
					var element = $('.search-choice > span');
					var length = element.length;
					var value = "";
					for(var i = 0;i<length;i++){
						var tmp = element[i].innerText;
						value+=tmp+";";
					}
					var skill = document.getElementById("skill");
					skill.value = value;
				}

				function initMajorData(){

					var has_choose = new Array();

					<?php if($ta['skills']!=""):?>
					var init_skill = "<?=$ta['skills']?>";
					has_choose = init_skill.split(";");
					has_choose.pop();
					<?php endif;?>

					var length = major_array.length;
					var select = document.getElementById("skill_choose");
					for(var i = 0;i<length;i++){
						var group = document.createElement("optgroup");
						group.label = major_array[i];
						group.style = "font-size:16px";
						var sub_length = sub_array[i].length;
						for(var j = 0;j<sub_length;j++){
							var option = document.createElement("option");
							option.value = major_array[i]+"-"+sub_array[i][j];
							option.innerHTML = sub_array[i][j];
							for(var k = 0;k<has_choose.length;k++){
								if(option.value==has_choose[k])
									option.selected = 1;
							}
							group.appendChild(option);
						}
						select.appendChild(group);
					}
				}
				initMajorData();

				jQuery(document).ready(function(){
					jQuery.validator.addMethod("star_required",function(value,element,params){
						var score = $('#skill_star').raty('score');
						var ok = (score!=null);
						if(ok) element.value = score;
						return ok;
					});
					jQuery.validator.addMethod("positive",function(value,element,params){
						return value>0;
					});
					var changeMethod = function(){
						updateSkill();
						updateTaValidator.element($("#skill"));
					};
					$('#skill_choose').chosen().bind("changed",changeMethod);

					var updateTaValidator = $("#updateTaForm").validate({
						rules:{
							openId:{
								required: true,
							},
							email:{
								required: true,
								email: true,
							},
							introduction:{
								required: true,
							},
							star: {
								star_required: true,
							},
							unitPrice:{
								required: true,
								digits: true,
								positive: true,
							},
							skill: {
								required: true,
							},
						},
						messages:{
							openId:{
								required: "OpenId不能为空",
							},
							email:{
								required: "Email地址不能为空",
								email: "请输入正确的email地址"
							},
							introduction:{
								required: "简介不能为空",
							},
							star: {
								star_required: "技能评价不能为0",
							},
							unitPrice:{
								required: "单页价钱不能为空",
								digits: "单页价钱必须是（非负）整数",
							},
							skill: {
								required: "技能不能为空",
							},
						},
						errorClass: "error help-inline",
						highlight: function(element){
							$(element)
                        .closest('.help-inline').removeClass('ok'); // display OK icon
                        $(element).closest('.control-group').removeClass('success').addClass('error');
                    },
				unhighlight: function (element) { // revert the change dony by hightlight
					$(element)
                        .closest('.control-group').removeClass('error'); // set error class to the control group
                    },
                    success: function (label) {
                    	label
                        .addClass('valid').addClass('help-inline ok') // mark the current input as valid and display OK icon
                    .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
                },
            });
updateSkill();
});

</script>