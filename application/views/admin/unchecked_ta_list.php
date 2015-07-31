<!-- BEGIN PAGE -->  
<div class="page-content">
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<h3 class="page-title">
					TA管理
				</h3>
			</div>
		</div>
		<!-- END PAGE HEADER-->

		<!-- BEGIN PAGE CONTENT-->
		<div class="row-fluid">
			<div class="span12">
				<div class="portlet box" id="form_wizard_1">
					<div class="portlet-title">
						<div class="row-fluid search-forms search-default" style="width:50%;" >

							<form class="form-search" action="<?php echo site_url(ADMIN_PREFIX."ta/searchTa");?>" method="get" style="padding: 0px;">
								<div class="chat-form">
									<div class="input-cont" >   

										<input type="text" name="key" placeholder="请输入关键词。。。" class="m-wrap">

									</div>

									<button type="submit" class="btn green">搜索TA &nbsp; <i class="m-icon-swapright m-icon-white"></i></button>

								</div>

							</form>

						</div>
					</div>

					<div class="portlet-body">
						<div>
							<table class="table table-striped table-hover" id="taList">
								<thead>
									<tr>
										<th>Open ID</th>
										<th>邮箱</th>
										<th>技能</th>
										<th>评级</th>
										<th>每页收费（元）</th>
										<th>创建时间</th>
									</tr>
								</thead>
								<tbody>
									<?php if(!empty($taList)): ?>
									<?php foreach ($taList as $ta):?>
									<tr>
										<td> <?php echo $ta['openid'];?> </td>
										<td> <?php echo $ta['email'];?> </td>
										<td> <?php echo $ta['skills'];?> </td>
										<td> <?php echo $ta['star'];?> </td>
										<td> <?php echo $ta['unitPrice'];?> </td>
										<td> 
											<?php if($ta['hasCheck']): ?>
											<span class="label label-success">已审核</span>
											<?php else:?>
											<span class="label label-info">待审核</span>
											<?php endif;?>
										</td>
									</tr>
									<?php endforeach;?>
									<?php else: ?>
									<tr class="odd">
										<td valign="top" colspan="6" class="dataTables_empty">没有找到符合条件的结果</td>
									</tr>
									<?php endif;?>
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