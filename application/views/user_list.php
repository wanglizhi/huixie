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
							用户管理
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
									<i class="icon-reorder"></i> 用户列表
								</div>
								<div class="tools hidden-phone">
									<a href="javascript:;" class="collapse"></a>

								</div>

							</div>

							<div class="portlet-body">
<div>
<table class="table" id="userList">
			<thead>
				<tr>
					<th>ID</th>
					<th>用户名</th>
					<th>大学</th>
					<th>邮箱</th>
					<th>创建时间</th>
				</tr>
			</thead>
			<tbody>
			<?php if(!empty($userList))foreach ($userList as $user):?>
				<tr>
					<td> <?php echo $user['openid'];?> </td>
					<td> <?php echo $user['nickname'];?> </td>
					<td> <?php echo $user['university'];?> </td>
					<td> <?php echo $user['email'];?> </td>
					<td> <?php echo $user['createTime'];?> </td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
</div><div class="row-fluid">
						<div class="span12">
							<div class="dataTables_paginate paging_bootstrap pagination">
								<ul>
									<li class="prev disabled">
										<a style="margin: 0px;" href="#">← <span class="hidden-480">Prev</span></a>
									</li>
									<li class="active">
										<a style="margin: 0px;" href="#">1</a>
									</li>
									<li>
										<a style="margin: 0px;" href="#">2</a>
									</li>
									<li>
										<a style="margin: 0px;" href="#">3</a>
									</li>
									<li>
										<a style="margin: 0px;" href="#">4</a>
									</li>
									<li>
										<a style="margin: 0px;" href="#">5</a>
									</li>
									<li class="next">
										<a style="margin: 0px;" href="#"><span class="hidden-480">Next</span> → </a>
									</li>
								</ul>
							</div>
						</div>
					</div>

							</div>

						</div>

					</div>

				</div>
				<!-- END PAGE CONTENT-->         

			</div>
			<!-- END PAGE CONTAINER-->

		</div>
		<!-- END PAGE -->  
