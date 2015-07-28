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
					Admin管理
				</h3>
				<ul class="breadcrumb">
					<li>
					</li>
				</ul>
			</div>

		</div>
		<!-- END PAGE HEADER-->

		<!-- BEGIN PAGE CONTENT-->
		<div class="row-fluid">
			<div class="span12">
				<div class="portlet box blue" id="form_wizard_1">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-reorder"></i> 管理员列表
						</div>
						<div class="tools hidden-phone">
							<a href="javascript:;" class="collapse"></a>

						</div>

					</div>

					<div class="portlet-body">
						<div>
							<table class="table" id="adminList">
								<thead>
									<tr>
										<th>用户名</th>
										<th>密码</th>
									</tr>
								</thead>
								<tbody>
									<?php if(!empty($adminList))foreach ($adminList as $admin):?>
									<tr>
										<td> <?php echo $admin['name'];?> </td>
										<td> <?php echo $admin['password'];?> </td>
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

</div>
<!-- END PAGE -->  