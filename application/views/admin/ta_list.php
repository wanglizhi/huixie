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

							<div class="form-search" style="padding: 0px;">
								<div class="chat-form">
									<div class="input-cont" >   

										<input type="text" id="key" name="key" placeholder="请输入关键词。。。" class="m-wrap">

									</div>

									<button onclick="search()" class="btn green">搜索TA &nbsp; <i class="m-icon-swapright m-icon-white"></i></button>

								</div>
							</div>

						</div>
					</div>
					<div class="portlet-body">
						<?php
						$taTable['js_page_method'] = "change_ta_page";
						$data['taTable'] = $taTable;
						$this->load->view(ADMIN_PREFIX."ta_table",$data);
						?>


						<script type="text/javascript">
						function search(){
							var key = document.getElementById('key').value;
							change_ta_page(1,key);
							return false;
						}
						var search_key = "",current_page = 1;
						function change_ta_page(page,key){
							if(page===undefined) page = current_page;
							if(key==undefined) key = search_key;
							var tableId = "<?=$taTable['tableId']?>";
							$.ajax({
								url: "<?php echo site_url($taTable['page_info']['page_method'])?>",
								type: "get",
								data: {'page':page,'js_page_method': "change_ta_page",'search_key':key,},
								dataType: "html",
								success: function(data){
									$('#'+tableId).html(' ');
									$('#'+tableId).html(data);
									search_key = key,current_page = page;
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