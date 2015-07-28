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
							下订单
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
									<i class="icon-reorder"></i> 请仔细填写(<font color='red'>*</font>为必填)
								</div>
								<div class="tools hidden-phone">
									<a href="javascript:;" class="collapse"></a>

								</div>

							</div>

							<div class="portlet-body center">
							
			<form action="<?php echo site_url('customer/order/addOrder');?>" method="post">
  			<div class="form-group">
    			<label for="major">专业<font color='red'>*</font></label>
    			<select class="form-control m-wrap span6" name="major" id="major">
  					<option>天文</option>
  					<option>地理</option>
  					<option>历史</option>
  					<option>物理</option>
				</select>
  			</div>
  			<div class="form-group">
    			<label for="courseName">课程名<font color='red'>*</font></label>
    			<input type="text" class="form-control m-wrap span6" id="courseName" name="courseName" placeholder="" required="required">
  			</div>
  			<div class="form-group">
    			<label for="email">Email<font color='red'>*</font></label>
    			<input type="email" class="form-control m-wrap span6" id="email" name="email" placeholder="" required="required">
  			</div>
  			<div class="form-group">
    			<label for="pageNum">页数<font color='red'>*</font></label>
    			<select class="form-control m-wrap span6" name="pageNum" id="pageNum">
    			<?php for($i=1;$i<=100;$i++){ ?>
  					<option><?php echo $i; ?></option>
				<?php } ?>
				</select>
    		</div>
  			<div class="form-group">
    			<label for="refDoc">阅读材料页数<font color='red'>*</font></label>
    			<select class="form-control m-wrap span6" name="refDoc" id="refDoc">
    			<?php for($i=0;$i<=100;$i++){ ?>
  					<option><?php echo $i; ?></option>
				<?php } ?>
				</select>
  			</div>
  			<div class="form-group">
    			<label for="endTime">截止日期<font color='red'>*</font></label>
          <input type="date" class="form-control m-wrap span6" id="endTime" name="endTime" required="required">
    			<!-- <input type="time" class="form-control" id="endTime" name="endTime" required="required"> -->
  			</div>
  			<div class="form-group">
    			<label for="requirement">补充要求</label>
    			<textarea rows="5" class="form-control m-wrap span6" id="requirement" name="requirement" placeholder=""></textarea>
  			</div>
			<div class="form-group">
    			<a link="">保密政策</a>
  			</div>
  			<div class="form-actions">
  			<button type="submit" class="btn blue"><i class="icon-ok"></i> 提交</button>
  			</div>
		</form>


							</div>

						</div>

					</div>

				</div>
				<!-- END PAGE CONTENT-->         

			</div>
			<!-- END PAGE CONTAINER-->

		</div>
		<!-- END PAGE -->  