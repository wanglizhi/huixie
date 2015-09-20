<!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
<div class="content native-scroll">
<div class="content-block-title">查看选择助教（可多选）</div>
<div class="list-block media-list">
<ul>
  <li>
    <label class="label-checkbox item-content">
      <input type="checkbox" name="my-radio" checked="checked" disabled="disabled">
      <div class="item-media"><i class="icon icon-form-checkbox"></i></div>
      <div class="item-inner">
        <div class="item-title-row">
          <div class="item-title">系统匹配TA</div>
          <div class="item-after">*</div>
        </div>
        <div class="item-subtitle">如果不选择或者未接单，系统默认分配助教</div>
      </div>
    </label>
  </li>

<form action="<?php echo site_url('customer/order/selectTa/'.$orderNum);?>" method="post">
<?php if(!empty($taList))foreach ($taList as $ta):?>
  <li>
    <label class="label-checkbox item-content">
      <input type="checkbox" name="taIdList[]" value="<?php echo $ta['openid'];?>">
      <div class="item-media"><i class="icon icon-form-checkbox"></i><img src="<?php echo $ta['userInfo']['headimgurl'];?>" style='width: 4rem;'></div>
      <div class="item-inner">
        <div class="item-title-row">
          <div class="item-title"><?php echo $ta['userInfo']['nickname'];?></div>
          <div class="item-after">评级：<?php echo $ta['star'];?></div>
        </div>
        <div class="item-subtitle">单价：<?php echo $ta['unitPrice'];?></div>
        <div class="item-text">
          简介：
          <?php echo $ta['introduction'];?>
          <br>
            当前状态：
            <?php if($ta['state']==0): ?>
                <span class="label label-success">空闲</span>
            <?php elseif($ta['state']==1): ?>
                <span class="label label-warning">有课</span>
            <?php else: ?>
                <span class="label label-important">忙碌</span>
            <?php endif ?>

        </div>
      </div>
    </label>
  </li>
  <?php endforeach;?>
</ul>
</div>
    <div class="content-block">
        <div class="row">
            <button class="col-100 button button-big button-fill button-success" type="submit">下一步</button>
        </div>
    </div>
</form>



</div>
<!-- end content-->