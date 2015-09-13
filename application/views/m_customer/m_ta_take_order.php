
<!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
<div class="content native-scroll">
    
        <div class="content-block-title">订单详情</div>
          <div class="list-block">
            <ul>
              <li class="item-content">
                <div class="item-inner">
                  <div class="item-title">订单编号</div>
                  <div class="item-after"><?php echo $order['orderNum'];?></div>
                </div>
              </li>
              <li class="item-content">
                <div class="item-inner">
                  <div class="item-title">下单时间</div>
                  <div class="item-after"><?php 
                    date_default_timezone_set("PRC");
                    $timestamp = strtotime($order['createTime']);
                    date_default_timezone_set($order['timezone']);
                    echo date("Y-m-d H:i:s",$timestamp);
                  ?></div>
                </div>
              </li>
              <li class="item-content">
                <div class="item-inner">
                  <div class="item-title">专业</div>
                  <div class="item-after"><?php echo $order['major'];?></div>
                </div>
              </li>
              <li class="item-content">
                <div class="item-inner">
                  <div class="item-title">课程名</div>
                  <div class="item-after"><?php echo $order['courseName'];?></div>
                </div>
              </li>
              <li class="item-content">
                <div class="item-inner">
                  <div class="item-title">页数</div>
                  <div class="item-after"><?php echo $order['pageNum'];?></div>
                </div>
              </li>
              <li class="item-content">
                <div class="item-inner">
                  <div class="item-title">阅读材料</div>
                  <div class="item-after"><?php echo $order['refDoc'];?></div>
                </div>
              </li>
              <li class="item-content">
                <div class="item-inner">
                  <div class="item-title">截止日期</div>
                  <div class="item-after"><?php echo $order['endTime'];?></div>
                </div>
              </li>
              <li class="item-content">
                <div class="item-inner">
                  <div class="item-title">时区</div>
                  <div class="item-after"><?php echo $order['timezone'];?></div>
                </div>
              </li>
              <li class="item-content">
                <div class="item-inner">
                  <div class="item-title">补充要求</div>
                  <p><?php echo $order['requirement'];?></p>
                </div>
              </li>
              <li class="item-content item-link">
                <div class="item-inner">
                  <div class="item-title">订单状态</div>
                    <?php if($order['hasPaid']==0): ?>
                        <div class="item-after">未付款</div>
                    <?php elseif($order['hasTaken']==0): ?>
                        <div class="item-after">已付款&nbsp<?php 
                        echo $order['paidTime'];
                    ?></div>
                    <?php elseif($order['hasFinished']==0): ?>
                        <div class="item-after">已接单&nbsp<?php 
                        echo $order['takenTime'];
                    ?></div>
                    <?php else: ?>
                        <div class="item-after">已完成&nbsp<?php 
                        echo $order['finishedTime'];
                    ?></div>
                    <?php endif; ?>
                </div>
              </li>
            </ul>
          </div>

          <div class="content-block-title">接单信息</div>

          <?php if($order['taId'] and $order['taId'] == $user['openid'] and $order['hasTaken']): ?>
            <div class="list-block">
            <ul>
                <li class="item-content">
                    <div class="item-inner">
                        <div class="item-title">您已经接受此订单</div>
                    </div>
                </li>
                <li class="item-content">
                    <div class="item-inner">
                        <p>如果需要阅读材料，请联系客服，论文完成后发送到邮箱admin@huixie.me</p>
                    </div>
                </li>
            </ul>
            </div>
        <?php elseif($order['hasTaken']): ?>
             <div class="list-block">
            <ul>
                <li class="item-content">
                    <div class="item-inner">
                        <div class="item-title">订单已经被接单，您不能再接单！</div>
                    </div>
                </li>
            </ul>
            </div>
        <?php elseif($order['hasPaid'] == 0): ?>
            <div class="list-block">
            <ul>
                <li class="item-content">
                    <div class="item-inner">
                        <div class="item-title">订单未付款，您不能接单~</div>
                    </div>
                </li>
            </ul>
            </div>
        <?php else: ?>
        <div class="list-block">
        <form action="<?php echo site_url('customer/ta/takeOrder');?>" method="post">
            <ul>
                <li>
                  <div class="item-content">
                    <div class="item-inner">
                        <div class="item-title">选择接单</div>
                        <input type="hidden" value="<?php echo $order['orderNum'];?>" id="orderNum" name="orderNum" placeholder="">
                        <button type="submit" class="btn btn-primary">确认接单</button>
                    </div>
                    </div> 
                </li>
            </ul>

        </form>
        </div>
        <?php endif ?>


<div class="content-block-title">关闭微信窗口</div>
          <a class="btn btn-negative btn-block" role="button" href="javascript:void(0);" onclick="WeixinJSBridge.call('closeWindow');">关闭本窗口</a>

</div>
<!-- end content-->
<script>
            $('#skill_star').raty({
                path      : 'media/image',
                half      : true,
                starHalf  : 'star-half.png',
                starOff   : 'star-off.png',
                starOn    : 'star-on.png',
                <?php if(isset($star)):?>
                score     : <?=$star?>
                <?php endif;?>
            });
        </script>
