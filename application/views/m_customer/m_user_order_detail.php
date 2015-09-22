
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
                  <div class="item-after"><?php 
                        date_default_timezone_set("PRC");
                        $timestamp = strtotime($order['endTime']);
                        date_default_timezone_set($order['timezone']);
                        echo date("Y-m-d H:i:s",$timestamp);
                    ?></div>
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
                  <div class="item-title">价格($)</div>
                  <div class="item-after"><?php echo $order['price'];?></div>
                </div>
              </li>
              <li class="item-content item-link">
                <div class="item-inner">
                  <div class="item-title">订单状态</div>
                    <?php if($order['hasPaid']==0): ?>
                        <a href="<?php echo site_url('customer/order/payOrderPage/'.$order['orderNum']);?>">
                            <div class="item-after">未付款（点击付款）</div>
                        </a>
                    <?php elseif($order['hasTaken']==0): ?>
                        <div class="item-after">已付款&nbsp<?php 
                        date_default_timezone_set("PRC");
                        $timestamp = strtotime($order['paidTime']);
                        date_default_timezone_set($order['timezone']);
                        echo date("Y-m-d",$timestamp);
                    ?></div>
                    <?php elseif($order['hasFinished']==0): ?>
                        <div class="item-after">已接单&nbsp<?php 
                        date_default_timezone_set("PRC");
                        $timestamp = strtotime($order['takenTime']);
                        date_default_timezone_set($order['timezone']);
                        echo date("Y-m-d",$timestamp);
                    ?></div>
                    <?php else: ?>
                        <div class="item-after">已完成&nbsp<?php 
                        date_default_timezone_set("PRC");
                        $timestamp = strtotime($order['finishedTime']);
                        date_default_timezone_set($order['timezone']);
                        echo date("Y-m-d",$timestamp);
                    ?></div>
                    <?php endif; ?>
                </div>
              </li>
              <li class="table-view-cell">
                  补充要求：<?php echo $order['requirement'];?>
              </li>
            </ul>
          </div>

        <?php if($order['hasFinished'] || $order['hasTaken']): ?>
          <div class="content-block-title">TA信息</div>
          <div class="list-block media-list">
            <ul>
              <li>
                <a href="javascript:void(0)" class="item item-content">
                  <div class="item-media"><img src="<?php echo $user['headimgurl'];?>" style='width: 4rem;'></div>
                  <div class="item-inner">
                    <div class="item-title">
                      <div class="item-title"><?php echo $user['nickname'];?></div>
                    </div>
                    <div class="item-text"><?php echo $user['country'].'-'.$user['city'];?></div>
                  </div>
                </a>
              </li>
            </ul>
          </div>
        <?php endif; ?>
        <?php if($order['hasFinished']): ?>
            <div class="content-block-title">给TA打分</div>
            <div class="list-block">
            <form action="<?php echo site_url('customer/user/starTa');?>" method="post">
                    <ul>
                        <li>
                            <div class="item-inner">
                                <div style="display: inline-block;" id="skill_star" name="skill_star" ></div>
                                <input id="star" name="star" type="text" data-required="1" style="width:1px;visibility: hidden;"/>
                                <button class="btn btn-primary" type="submit">提交</button>
                             </div>
                                <div class="form-group">
                                <input type="hidden" value="<?php echo $order['orderNum'];?>" id="orderNum" name="orderNum" placeholder="">
                             </div>
                             <div class="form-group">
                                 <input type="hidden" value="<?php echo $order['taId'];?>" id="taId" name="taId" placeholder="">
                                </div>
                        </li>
                    </ul>
                          
            </form>
            </div>
        <?php endif; ?>

<div class="content-block-title">关闭微信窗口</div>
          <a class="btn btn-negative btn-block" role="button" href="javascript:void(0);" onclick="WeixinJSBridge.call('closeWindow');">关闭本窗口</a>

</div>
<!-- end content-->
<script>
            // jQuery(document).ready(function() {
            //     var hasPaid = <?php echo $order['hasPaid'];?>;
            //     var paidTime = <?php echo $order['paidTime'];?>;
            //     alert(hasPaid+" "+paidTime);
            // });
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
