<!-- BEGIN PAGE -->  
<div class="page-content">
	<!-- BEGIN PAGE CONTAINER-->

	<div class="container-fluid">

		<!-- BEGIN PAGE HEADER-->   

		<div class="row-fluid">

			<div class="span12">
				<h3 class="form-section">添加TA</h3>
			</div>

		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN PAGE CONTENT-->
		
		<div class="tab-content">
			<div class="tab-pane active" id="portlet_tab1">
				<div class="portlet-body form">

					<!-- BEGIN FORM-->
					<form action="#" class="form-horizontal" id="addTaForm" method="post">

						<div class="row-fluid">
							<div class="control-group">

								<label class="control-label">OpenId:<span class="required">*</span></label>

								<div class="controls">
									<input type="text" id="openId" name="openId" data-required="1" class="span6 m-wrap" placeHolder="请输入微信获取的OpenId">
								</div>

							</div>
							<div class="control-group">

								<label class="control-label">邮箱:<span class="required">*</span></label>

								<div class="controls">
									<input type="text" id="email" name="email" data-required="1" class="span6 m-wrap" placeHolder="请输入Email">
								</div>

							</div>
							<div class="control-group">

								<label class="control-label">简介:<span class="required">*</span></label>

								<div class="controls">
									<textarea id="introduction" name="introduction" data-required="1" class="large span6" rows="5" placeHolder="请输入简介"></textarea>
								</div>

							</div>
							<div class="control-group">
								<label class="control-label">技能评价:<span class="required">*</span></label>
								<div class="controls ">
									<div style="display: inline-block;" id="skill_star" name="skill_star" ></div>
									<input id="star" name="star" type="button" data-required="1" style="visibility: hidden;"/>
								</div>
							</div>
							<div class="control-group">

								<label class="control-label">单页价钱:<span class="required">*</span></label>
								<div class="controls">

									<div class="input-prepend span2">

										<span class="add-on">￥</span>
										<input id="unitPrice" name="unitPrice" class="m-wrap span12" type="text">
									</div>

								</div>

							</div>	
						</div>
						<div class="form-actions" style="background: transparent;">

							<button type="submit" class="btn blue span2"><i class="icon-ok"></i> 添加</button>

						</div>

					</form>
					<!-- END FORM--> 

				</div>
			</div>
		</div>
		<!-- END PAGE CONTENT-->         

	</div>
	<!-- END PAGE CONTAINER-->

	<!--VALIDATION -->

	<script>
	$('#skill_star').raty({
		path      : 'media/image',
		half      : true,
		starHalf  : 'star-half.png',
		starOff   : 'star-off.png',
		starOn    : 'star-on.png'
	});

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
		$("#addTaForm").validate({
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
});
</script>


</div>
<!-- END PAGE -->  