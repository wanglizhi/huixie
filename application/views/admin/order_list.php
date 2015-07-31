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
				<h3 class="form-section">
					<?=$pageTitle?>
				</h3>
			</div>

		</div>
		<!-- END PAGE HEADER-->

		<!-- BEGIN PAGE CONTENT-->
		<div class="row-fluid">
			<div class="span12">

				<div class="portlet-body">
					<?php
						$data['orderTable'] = $orderTable;
						$data['page_info'] = $page_info;
						$data['js_page_method'] = "change_order_page";
						$this->load->view(ADMIN_PREFIX."order_table",$data);
					?>

					<script type="text/javascript">
					function change_order_page(page){
						var tableId = "<?=$orderTable['tableId']?>";
						$.ajax({
							url: "<?php echo site_url($page_info['page_method'])?>",
							type: "get",
							data: {'page':page,'js_page_method': "change_order_page",},
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
		<!-- END PAGE CONTENT-->         


	</div>
	<!-- END PAGE CONTAINER-->

</div>
<!-- END PAGE -->  
