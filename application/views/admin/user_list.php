<!-- BEGIN PAGE -->  
<div class="page-content">

	<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

	<!-- BEGIN PAGE CONTAINER-->

	<div class="container-fluid">

		<!-- BEGIN PAGE HEADER-->   

		<div class="row-fluid">

			<div class="span12">
				<h3 class="page-title">
					用户管理
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

							<form class="form-search" action="<?php echo site_url(ADMIN_PREFIX."user/searchUser");?>" method="get" style="padding: 0px;">
								<div class="chat-form">
									<div class="input-cont" >   

										<input type="text" name="key" placeholder="请输入关键词。。。" class="m-wrap">

									</div>

									<button type="submit" class="btn green">搜索用户 &nbsp; <i class="m-icon-swapright m-icon-white"></i></button>

								</div>

							</form>

						</div>
					</div>

					<div class="portlet-body">
						<?php
							$data['js_page_method'] = "change_user_page";
							$this->load->view(ADMIN_PREFIX."user_table",$data);
						?>


						<script type="text/javascript">
							function change_user_page(page){
								var tableId = "<?=$userTable['tableId']?>";
								$.ajax({
									url: "<?php echo site_url($page_info['page_method'])?>",
									type: "get",
									data: {'page':page,'js_page_method': "change_user_page",},
									dataType: "html",
									success: function(data){
										$('#'+tableId).html(' ');
										$('#'+tableId).html(data);
									},
								});
							}
						</script>
					</div>
				</div>
			</div>

		</div>
	<!-- END PAGE CONTENT-->         
	</div>
<!-- END PAGE CONTAINER-->

</div>
<!-- END PAGE -->  
