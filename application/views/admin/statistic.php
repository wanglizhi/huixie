<div class="page-content">

	<div class="container-fluid">

		<!-- BEGIN PAGE HEADER-->   

		<div class="row-fluid">

			<div class="span12">
				<h3 class="form-section">统计面板</h3>
			</div>

		</div>
		<div class="tab-content">
			
			<div class="row-fluid">

				<div class="responsive span6" data-tablet="span6" data-desktop="span3">

					<div class="dashboard-stat blue">

						<div class="visual">

							<i class="icon-user icon-white"></i>

						</div>

						<div class="details">

							<div class="number">

								<?=$userNum?>

							</div>

							<div class="desc">                           

								用户数量

							</div>

						</div>

						<a class="more" href="<?php echo site_url(ADMIN_PREFIX."user/userList")?>">

							查看用户 <i class="m-icon-swapright m-icon-white"></i>

						</a>                 

					</div>

				</div>

				<div class="responsive span6" data-tablet="span6" data-desktop="span3">

					<div class="dashboard-stat green">

						<div class="visual">

							<i class="icon-shopping-cart"></i>

						</div>

						<div class="details">

							<div class="number"><?=$orderNum?></div>

							<div class="desc">订单数量</div>

						</div>

						<a class="more" href="<?php echo site_url(ADMIN_PREFIX."order/orderList")?>">

							查看订单 <i class="m-icon-swapright m-icon-white"></i>

						</a>                 

					</div>

				</div>

				<div class="responsive span6 fix-offset" data-tablet="span6  fix-offset" data-desktop="span3">

					<div class="dashboard-stat purple">

						<div class="visual">

							<i class="icon-thumbs-up"></i>

						</div>

						<div class="details">

							<div class="number"><?=$checkedTaNum?></div>

							<div class="desc">已审核TA数量</div>

						</div>

						<a class="more" href="<?php echo site_url(ADMIN_PREFIX."ta/checkedTaList")?>">

							查看已审核TA <i class="m-icon-swapright m-icon-white"></i>

						</a>                 

					</div>

				</div>

				<div class="responsive span6" data-tablet="span6" data-desktop="span3">

					<div class="dashboard-stat yellow">

						<div class="visual">

							<i class="icon-hand-right"></i>

						</div>

						<div class="details">

							<div class="number"><?=$uncheckedTaNum?></div>

							<div class="desc">待审核TA数量</div>

						</div>

						<a class="more" href="<?php echo site_url(ADMIN_PREFIX."ta/uncheckedTaList")?>">

							查看待审核TA <i class="m-icon-swapright m-icon-white"></i>

						</a>                 

					</div>

				</div>
			</div>
		</div>
	</div>
</div>