<!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
<div class="content native-scroll">
    <div class="content-block-title">订单列表</div>
    <?php if(!empty($orderList))foreach ($orderList as $order):?>
        <?php 
                            static $orderRow = 0; 
                        ?>
            <div class="card">
                <div class="card-header">订单编号:&nbsp
                    <?php echo $order['orderNum'];?>
                </div>
                <div class="card-content">
                    <div class="list-block media-list">
                        <ul>
                            <li class="item-content">
                                <div class="item-inner">
                                    <div class="item-subtitle">专业：
                                        <?php echo $order['major'];?>
                                    </div>
                                </div>
                            </li>
                            <li class="item-content">
                                <div class="item-inner">
                                    <div class="item-subtitle">课程名：
                                        <?php echo $order['courseName'];?>
                                    </div>
                                </div>
                            </li>
                            <li class="item-content">
                                <div class="item-inner">
                                    <div class="item-subtitle">截止日期：
                                        <?php echo $order['endTime'];?>
                                    </div>
                                </div>
                            </li>
                            <li class="item-content">
                                <div class="item-inner">
                                    <div class="item-title-row">
                                        <div class="item-title">订单状态</div>
                                    </div>
                                    <div class="item-subtitle">
                                        <?php if($order['hasPaid']==0): ?>
                                            <span class="label label-default">未付款</span>
                                        <?php elseif($order['hasTaken']==0): ?>
                                            <span class="label label-warning">待接单</span>
                                            <a class="btn btn-primary" href="<?php echo site_url('customer/ta/takeOrderPage/'.$order['orderNum']);?>"><i class="icon-shopping-cart"></i>&nbsp去接单</a>
                                        <?php elseif($order['hasFinished']==0): ?>
                                            <span class="label label-info">已接单</span>
                                        <?php else: ?>
                                            <span class="label label-success">已完成</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-footer">
                    <span>
          <?php 
                                    date_default_timezone_set("PRC");
                                    $timestamp = strtotime($order['createTime']);
                                    date_default_timezone_set($order['timezone']);
                                    echo date("Y-m-d H:i:s",$timestamp);
                                    ?>
      </span>
                    <a href="<?php echo site_url('customer/ta/takeOrderPage').'/'.$order['orderNum'];?>" class="link">更多</a>
                </div>
            </div>
            <?php
                            $orderRow++; 
                            ?>
                <?php endforeach;?>

                    <?=$page_info?>
</div>
<!-- end content-->
