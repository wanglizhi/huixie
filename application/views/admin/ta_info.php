<!-- BEGIN PAGE -->
<div class="page-content">
	<!-- BEGIN PAGE CONTAINER-->

	<div class="container-fluid">

		<!-- BEGIN PAGE HEADER-->

		<div class="row-fluid">

			<div class="span12">
				<h3 class="form-section">TA信息</h3>
			</div>

		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN PAGE CONTENT-->
		<div class="tabbable tabble-custom boxless">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#ta_info" data-toggle="tab">TA信息</a>
				</li>
				<li>
					<a href="#ta_order" data-toggle="tab">TA接单列表</a>
				</li>
			</ul>
			<div class="tab-content">
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

											<span class="add-on">￥</span>
											<input id="unitPrice" name="unitPrice" class="m-wrap span12" type="text" value="<?=$ta['unitPrice']?>"></div>

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
						<div>
							<table class="table" id="orderList">
								<thead>
									<tr>
										<th>订单编号</th>
										<th>用户编号</th>
										<th>TA编号</th>
										<th>专业</th>
										<th>课程名称</th>
										<th>截止日期</th>
										<th>价格</th>
										<th>订单状态</th>
										<th>详情</th>
									</tr>
								</thead>
								<tbody>
									<?php if(!empty($orderList))foreach ($orderList as $order):?>
									<tr>
										<td> <?php echo $order['orderNum'];?> </td>
										<td> <?php echo $order['userId'];?> </td>
										<td> <?php echo $order['taId'];?> </td>
										<td> <?php echo $order['major'];?> </td>
										<td> <?php echo $order['courseName'];?> </td>
										<td> <?php echo $order['finishedTime'];?> </td>
										<td> <?php echo $order['price'];?> </td>
										<?php if($order['hasPaid']==0): ?>
										<td> <span class="label label-default">未付款</span></td>
										<?php elseif($order['hasTaken']==0): ?>
										<td> <span class="label label-warning">已付款</span></td>
										<?php elseif($order['hasFinished']==0): ?>
										<td> <span class="label label-info">已接单</span></td>
										<?php else: ?>
										<td> <span class="label label-success">已完成</span></td>
										<?php endif; ?>
										<td>
											<?php static $orderRow = 0; ?>
											<a href="#orderRow<?=$orderRow?>" data-toggle="modal">查看详情</a>
											<!-- Modal -->
											<div class="modal hide fade modal-overflow" id="orderRow<?=$orderRow?>" tabindex="-1" role="dialog">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
												<h4 class="modal-title" id="myModalLabel<?=$orderRow?>">订单详情</h4>
											</div>
											<div class="modal-body">
												<div class="profile-classic row-fluid">
													<ul style="width:100%;" class="unstyled span10">
														<li style="width:100%;"><span>订单编号:</span> <?=$order['orderNum']?></li>
														<li style="width:100%;"><span>用户编号:</span> <?=$order['userId']?></li>
														<li style="width:100%;"><span>专业:</span> <?=$order['major']?></li>
														<li style="width:100%;"><span>课程名称:</span> <?=$order['courseName']?></li>
														<li style="width:100%;"><span>邮箱:</span> <?=$order['email']?></li>
														<li style="width:100%;"><span>页数:</span> <?=$order['pageNum']?></li>
														<li style="width:100%;"><span>阅读材料:</span> <?=$order['refDoc']?></li>
														<li style="width:100%;"><span>截止日期:</span> <?=$order['endTime']?></li>
														<li style="width:100%;"><span>价格:</span> <?=$order['price']?></li>
														<li style="width:100%;"><span>额外需求:</span> <?=$order['requirement']?></li>
														<li style="width:100%;"><span>TA编号:</span> <?=$order['taId']?></li>
														<li style="width:100%;"><span>创建时间:</span> <?=$order['createTime']?></li>
														<li style="width:100%;"><span>付款时间:</span> <?=$order['paidTime']?></li>
														<li style="width:100%;"><span>接单时间:</span> <?=$order['takenTime']?></li>
														<li style="width:100%;"><span>结束时间:</span> <?=$order['finishedTime']?></li>
													</ul>
												</div>
											</div>
											</div>
											<?php $orderRow++;?>
										</td>
									</tr>
									<?php endforeach;?>
								</tbody>

							</table>
						</div>
						<?=$page_info?>
					</div>
				</div>
			</div>
		</div>
		<!-- END PAGE CONTENT-->

	</div>
	<!-- END PAGE CONTAINER-->

	<!--VALIDATION -->

	<script src="js/majorData.js" type="text/javascript"></script>
	<script>
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

</div>
<!-- END PAGE -->