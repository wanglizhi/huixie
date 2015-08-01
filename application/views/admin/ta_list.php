<!-- BEGIN PAGE -->  
<div class="page-content">
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<h3 class="page-title">
					<?=$pageTitle?>
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
						<?php
							$data['js_page_method'] = "change_ta_page";
							$this->load->view(ADMIN_PREFIX."ta_table",$data);
						?>


						<script type="text/javascript">
							function change_ta_page(page){
								var tableId = "<?=$taTable['tableId']?>";
								$.ajax({
									url: "<?php echo site_url($page_info['page_method'])?>",
									type: "get",
									data: {'page':page,'js_page_method': "change_ta_page",},
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
</div>
<!-- END PAGE CONTAINER-->

<!-- END PAGE -->  