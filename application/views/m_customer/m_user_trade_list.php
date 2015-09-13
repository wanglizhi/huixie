<!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
<div class="content native-scroll">
    
<div class="content-block-title">余额信息</div>
<div class="list-block">
    <ul>
      <li class="item-content">
        <div class="item-inner">
          <div class="item-title">余额($)</div>
          <div class="item-after"><?php echo $user['balance'];?></div>
        </div>
      </li>
      <li>
        <form action="<?php echo site_url('customer/user/rechargePage');?>" method="post">
        <div class="item-inner">
            &nbsp&nbsp&nbsp&nbsp
            <input type="number" id="recharge" name="recharge" placeholder="请输入充值金额" required="required">
            <button type="submit" class="btn btn-primary">充值</button>
        </div>
        </form>
      </li>
    </ul>
</div>
<div class="content-block-title">交易记录</div>

<?php if(!empty($tradeList))foreach ($tradeList as $trade):?>
                        <?php 
                            static $orderRow = 0; 
                        ?>
                        <div class="content-block-title"><?php echo $trade['createTime'];?></div>
<div class="list-block">
    <ul>
      <li class="item-content">
        <div class="item-media"></div>
        <div class="item-inner">
          <div class="item-title">交易金额：</div>
          <div class="item-after"><?php echo $trade['money'];?></div>
        </div>
      </li>
      <li class="item-content">
        <div class="item-media"></div>
        <div class="item-inner">
          <div class="item-title">余额：</div>
          <div class="item-after"><?php echo $trade['balance'];?></div>
        </div>
      </li>
      <li class="item-content">
        <div class="item-media"></div>
        <div class="item-inner">
          <div class="item-title">订单编号：</div>
          <div class="item-after"><?php echo $trade['orderNum'];?></div>
        </div>
      </li>
      <li class="item-content">
        <div class="item-media"></div>
        <div class="item-inner">
          <div class="item-title">描述：</div>
          <div class="item-after"><?php echo $trade['describe'];?></div>
        </div>
      </li>
    </ul>
</div>
                            <?php
                            $orderRow++; 
                            ?>
                    <?php endforeach;?>

    <?=$page_info?>


</div>
<!-- end content-->