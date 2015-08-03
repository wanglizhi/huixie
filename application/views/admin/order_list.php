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
				<div class="portlet-title">
						<div class="row-fluid search-forms search-default" style="width:50%;" >

							<div class="form-search" method="get" style="padding: 0px;">
								<div class="chat-form">
									<div class="input-cont" >   

										<input type="text" id="key" name="key" placeholder="请输入关键词。。。" class="m-wrap"/>

									</div>

									<button class="btn green" onclick="search()">搜索订单 &nbsp; <i class="m-icon-swapright m-icon-white"></i></button>

								</div>
							</div>

						</div>
					</div>
				<div class="portlet-body">
					<?php
						$data['js_page_method'] = "change_order_page";
						$this->load->view(ADMIN_PREFIX."order_table",$data);
					?>

					<script type="text/javascript">
					var sort_key = "createTime",sort_method = "desc",current_page = 1;
					var search_key = "";
					function search(){
						var key = document.getElementById('key').value;
						change_order_page(1,undefined,undefined,undefined,key);
						return false;
					}
					function change_order_page(page,key,method,callBack,searchKey){
						if(page===undefined) page = current_page;
						if(key===undefined) key = sort_key;
						if(method===undefined) method = sort_method;
						if(searchKey===undefined) searchKey = search_key;
						var tableId = "<?=$orderTable['tableId']?>";
						$.ajax({
							url: "<?php echo site_url($page_info['page_method'])?>",
							type: "get",
							data: {'page':page,'js_page_method': "change_order_page",'sort_key': key,'sort_method':method,'search_key': searchKey},
							dataType: "html",
							success: function(data){
								$('#'+tableId).html(' ');
								$('#'+tableId).html(data);
								sort_key = key,sort_method = method,current_page = page;
								search_key = searchKey;
								if(callBack!==undefined) callBack();
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
