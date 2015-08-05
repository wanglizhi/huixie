<!-- Modal -->
<div class="modal hide fade modal-overflow" id="orderRow<?=$orderRow?>" tabindex="-1" role="dialog"  style="width: 50% !important;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title" id="myModalLabel<?=$orderRow?>">订单<?=$order['orderNum']?></h4>
	</div>
	<div class="modal-body">
		<div class="profile-classic row-fluid">
			<h4 class="form-section">论文信息</h4>
			<li style="width:100%;"><span>用户编号:</span> <?=$order['userId']?></li>
				<li style="width:100%;"><span>专业:</span> <?=$order['major']?></li>
				<li style="width:100%;"><span>课程名称:</span> <?=$order['courseName']?></li>
				<li style="width:100%;"><span>邮箱:</span> <?=$order['email']?></li>
				<li style="width:100%;"><span>页数:</span> <?=$order['pageNum']?></li>
				<li style="width:100%;"><span>阅读材料:</span> <?=$order['refDoc']?></li>
				<li style="width:100%;"><span>截止日期:</span> <?=$order['endTime']?></li>
				<li style="width:100%;"><span>价格:</span> <?=$order['price']?></li>
				<li style="width:100%;"><span>额外需求:</span> <?=$order['requirement']?></li>
				<li style="width:100%;"><span>TA编号:</span> <?=$order['taId']?></li>
				<li style="width:100%;"><span>创建时间:</span> <?=$order['createTime']?></li>
				<li style="width:100%;"><span>付款时间:</span> <?=$order['paidTime']?></li>
				<li style="width:100%;"><span>接单时间:</span> <?=$order['takenTime']?></li>
				<li style="width:100%;"><span>结束时间:</span> <?=$order['finishedTime']?></li>
		</div>
	</div>
</div>