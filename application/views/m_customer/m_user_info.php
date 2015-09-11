
<!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
<div class="content native-scroll">
    
<div class="content-block-title">微信资料</div>
          <div class="list-block media-list">
            <ul>
              <li>
                <a href="javascript:void(0)" class="item item-content">
                  <div class="item-media"><img src="<?php echo $user['headimgurl'];?>" style='width: 4rem;'></div>
                  <div class="item-inner">
                    <div class="item-title">
                      <div class="item-title"><?php echo $user['nickname'];?></div>
                    </div>
                    <div class="item-subtitle">
                        <?php if($user['sex'] == 0):?>
                        <?php echo '未知';?>
                        <?php elseif($user['sex'] == 1):?>
                        <?php echo '男';?>
                        <?php elseif($user['sex'] == 2):?>
                        <?php echo '女';?>
                        <?php endif?>
                    </div>
                    <div class="item-text"><?php echo $user['country'].'-'.$user['city'];?></div>
                  </div>
                </a>
              </li>
            </ul>
          </div>

        <div class="content-block-title">详细信息</div>
          <div class="list-block">
            <ul>
              <li class="item-content item-link">
                <div class="item-inner">
                  <div class="item-title">大学</div>
                  <a href="<?php echo site_url("customer/user/modifyPage");?>">
                  <div class="item-after"><?php echo $user['university'];?></div>
                  </a>
                </div>
              </li>
              <li class="item-content item-link">
                <div class="item-inner">
                  <div class="item-title">邮箱</div>
                  <a href="<?php echo site_url("customer/user/modifyPage");?>">
                  <div class="item-after"><?php echo $user['email'];?></div>
                  </a>
                </div>
              </li>
              <li class="item-content item-link">
                <div class="item-inner">
                  <div class="item-title">
                      <?php 
                    $type = $user['cashType'];
                    if($type == 1){
                        echo "Paypal：";
                    }else if($type == 2){
                        echo "支付宝：";
                    }else if($type == 3){
                        echo "微信支付账户";
                    }
                    ?>
                  </div>
                  <a href="<?php echo site_url("customer/user/modifyPage");?>">
                  <div class="item-after"><?php echo $user['cashAccount'];?></div>
                  </a>
                </div>
              </li>
            </ul>
          </div>

          <div class="content-block-title">余额信息</div>
          <div class="list-block">
            <ul>
              <li class="item-content">
                <div class="item-inner">
                  <div class="item-title">余额($)</div>
                  <div class="item-after"><?php echo $user['balance'];?></div>
                </div>
              </li>
            </ul>
          </div>
          <a class="btn btn-negative btn-block" role="button" href="<?php echo site_url("customer/user/logout");?>">注销登陆</a>

</div>
<!-- end content-->
