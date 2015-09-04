<!-- BEGIN PAGE -->  
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div id="portlet-config" class="modal hide">
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button"></button>
					<h3>portlet Settings</h3>
				</div>
				<div class="modal-body">
					<p>Here will be a configuration form</p>
				</div>
			</div>

			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

			<!-- BEGIN PAGE CONTAINER-->

			<div class="container-fluid">

				<!-- BEGIN PAGE HEADER-->   

				<div class="row-fluid">

					<div class="span12">
						<h3 class="page-title">
							助教信息
						</h3>
					</div>

				</div>
				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					<div class="span12">
						<div class="portlet box blue" id="form_wizard_1">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-reorder"></i>
								</div>
								<div class="tools hidden-phone">
									<a href="javascript:;" class="collapse"></a>

								</div>

							</div>

							<div class="portlet-body center">
		<?php if($ta and $ta['hasCheck']): ?>
			<div class="alert alert-success">
			<h4>您已经通过审核成为助教</h4>
				<label>技能：<?php echo $ta['skills'];?></label>
				<label>单价：<?php echo $ta['unitPrice'];?></label>
				<div>
					<label>
						技能评价:
						<span class="required">*</span>
					</label>
					<div class="controls ">
						<div style="display: inline-block;" id="skill_star" name="skill_star" ></div>
						<input id="star" name="star" type="text" data-required="1" style="width:1px;visibility: hidden;"/>
					</div>
				</div>



				<label>邮箱：<?php echo $ta['email'];?></label>
				<label>当前状态：
				<?php if($ta['state']==0): ?>
					<span class="label label-success">空闲</span>
				<?php elseif($ta['state']==1): ?>
					<span class="label label-warning">有课</span>
				<?php else: ?>
					<span class="label label-important">忙碌</span>
				<?php endif ?>
				</label>
			</div>

			<form action="<?php echo site_url('customer/ta/modify');?>" method="post">
  			<div class="form-group">
    			<label for="state">当前状态(有课状态不能修改成空闲状态)</label>
    			<select class="form-control span6" name="state" id="state" value="<?php echo $ta['state'];?>" required="required">
    			<?php if($ta['state']==0): ?>
					<option value="0" selected="selected">空闲</option>
					<option value="2">忙碌</option>
				<?php elseif($ta['state']==2): ?>
					<option value="0">空闲</option>
					<option value="2" selected="selected">忙碌</option>
				<?php elseif($ta['state']==1): ?>
					<option value="1" selected="selected">有课</option>
					<option value="2">忙碌</option>
				<?php else: ?>
					<option></option>
					<option value="1">有课</option>
					<option value="2">忙碌</option>
				<?php endif ?>
				</select>
    			<label for="email">邮箱</label>
    			<input type="email" class="form-control m-wrap span6" id="email" name="email" placeholder="" value="<?php echo $ta['email'];?>" required="required">
  			</div>

  			<div class="form-actions">
  			<button type="submit" class="btn green"><i class="icon-ok"></i> 修改</button>
  			</div>
			</form>

			
			<div class="alert alert-info">如果需要修改助教的相关信息，请联系客服，并且将相关材料发送到邮箱admin@huixie.me</div>
		<?php else: ?>
			<?php if($ta): ?>
				<div class="alert alert-info">
				您已经提交过助教申请，您的邮箱是<span><?php echo $ta['email'];?></span>
				<br>
				您的简介是：<span><?php echo $ta['introduction'];?></span>
				<br>
				请联系客服发送材料等待审核，重新点击提交申请可以更改邮箱。
				</div>
			<?php endif ?>

		<form action="<?php echo site_url('customer/ta/register');?>" method="post">
  			<div class="form-group">
    			<label for="email">邮箱</label>
    			<input type="email" class="form-control m-wrap span6" id="email" name="email" placeholder="请输入您的邮箱" required="required">
  			</div>
  			<div class="form-group">
    			<label for="introduction">自我介绍</label>
    			<textarea class="form-control m-wrap span6" rows="5" id="introduction" name="introduction" placeholder="请输入您的简介" required="required"></textarea>
  			</div>

  			<div class="form-actions">
  			<button type="submit" class="btn green"><i class="icon-ok"></i> 提交申请</button>
  			</div>
		</form>
		<?php endif ?>


							</div>

						</div>

					</div>

				</div>
				<!-- END PAGE CONTENT-->         

			</div>
			<!-- END PAGE CONTAINER-->

		</div>
		<!-- END PAGE -->  
		<script>
		jQuery(document).ready(function() {
			$('#skill_star').raty({
		readOnly	:true,
		path      : 'media/image',
		half      : true,
		starHalf  : 'star-half.png',
		starOff   : 'star-off.png',
		starOn    : 'star-on.png',
		<?php if($ta['star']!=""):?>
		score     : <?=$ta['star']?>
		<?php endif;?>
	});
		});
	</script>