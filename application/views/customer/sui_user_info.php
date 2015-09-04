<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>我的信息</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="stylesheet" href="//g.alicdn.com/sui-mobile/sm/0.5.0/css/sm.min.css">
    <link rel="stylesheet" href="//g.alicdn.com/sui-mobile/sm/0.5.0/css/sm-extend.min.css">

    <link rel="stylesheet" href="/your-css-file.css">
  </head>
  <body>
  <div class="page">
    <!-- 你的html代码 -->
    <header class="bar bar-nav" style="background-color:#18b4ed;">
        <a class="icon icon-me pull-left open-panel" style="color:#fff;"></a>
      <h1 class="title" style="color:#fff;">个人信息</h1>
    </header>
    <div class="content">
      <!-- 这里是页面内容区 -->
      <div class="page-index">

        <div class="content-block-title">微信资料</div>
          <div class="list-block media-list">
            <ul>
              <li>
                <a href="#" class="item item-content">
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
              <li class="item-content">
                <div class="item-inner">
                  <div class="item-title">大学</div>
                  <div class="item-after"><?php echo $user['university'];?></div>
                </div>
              </li>
              <li class="item-content">
                <div class="item-inner">
                  <div class="item-title">邮箱</div>
                  <div class="item-after"><?php echo $user['email'];?></div>
                </div>
              </li>
              <li class="item-content">
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
                  <div class="item-after"><?php echo $user['cashAccount'];?></div>
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
              <li class="item-content">
                <div class="item-inner">
                  <div class="item-title">$</div>
                  <div class="item-input">
                      <input type="tel" require="required" placeholder="请输入充值金额">
                    </div>
                    <div class="col-50"><a href="#" class="button button-fill button-success">充值</a></div>
                </div>
              </li>
            </ul>
          </div>

          
<form action="<?php echo site_url('customer/order/addOrder');?>" method="post" onsubmit="return checkForm()">
        
          <div class="list-block">
    <ul>
      <!-- Text inputs -->
      <li>
        <div class="item-content">
          <div class="item-media"><i class="icon icon-form-name"></i></div>
          <div class="item-inner">
            <div class="item-title label">姓名</div>
            <div class="item-input">
              <input type="text" placeholder="Your name" require="required">
            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="item-content">
          <div class="item-media"><i class="icon icon-form-email"></i></div>
          <div class="item-inner">
            <div class="item-title label">邮箱</div>
            <div class="item-input">
              <input type="email" placeholder="E-mail">
            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="item-content">
          <div class="item-media"><i class="icon icon-form-password"></i></div>
          <div class="item-inner">
            <div class="item-title label">密码</div>
            <div class="item-input">
              <input type="password" placeholder="Password" class="">
            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="item-content">
          <div class="item-media"><i class="icon icon-form-gender"></i></div>
          <div class="item-inner">
            <div class="item-title label">性别</div>
            <div class="item-input">
              <select>
                <option>Male</option>
                <option>Female</option>
              </select>
            </div>
          </div>
        </div>
      </li>
      <!-- Date -->
      <li>
        <div class="item-content">
          <div class="item-media"><i class="icon icon-form-calendar"></i></div>
          <div class="item-inner">
            <div class="item-title label">生日</div>
            <div class="item-input">
              <input type="date" placeholder="Birth day" value="2014-04-30">
            </div>
          </div>
        </div>
      </li>
      <!-- Switch (Checkbox) -->
      <li>
        <div class="item-content">
          <div class="item-media"><i class="icon icon-form-toggle"></i></div>
          <div class="item-inner">
            <div class="item-title label">开关</div>
            <div class="item-input">
              <label class="label-switch">
                <input type="checkbox">
                <div class="checkbox"></div>
              </label>
            </div>
          </div>
        </div>
      </li>
      <li class="align-top">
        <div class="item-content">
          <div class="item-media"><i class="icon icon-form-comment"></i></div>
          <div class="item-inner">
            <div class="item-title label">文本域</div>
            <div class="item-input">
              <textarea></textarea>
            </div>
          </div>
        </div>
      </li>
    </ul>
  </div>
  <div class="content-block">
    <div class="row">
      <div class="col-50"><a href="#" class="button button-big button-fill button-danger">取消</a></div>
      <div class="col-50"><a type="submit" class="button button-big button-fill button-success">提交</a></div>
    </div>
  </div>
  </form>



      </div>
    </div>
    </div>

<div class="panel-overlay"></div>
<!-- Left Panel with Reveal effect -->
<div class="panel panel-left panel-reveal theme-dark" id='panel-left-demo'>
  <div class="content-block">
    <p>这是一个侧栏</p>
    <p>你可以在这里放用户设置页面</p>
    <p><a href="#" class="close-panel">关闭</a></p>
  </div>
  <div class="list-block">
    <!-- .... -->
    
  </div>
</div>
<div class="panel panel-right panel-reveal">
  <div class="content-block">
    <p>这是一个侧栏</p>
    <!-- Click on link with "close-panel" class will close panel -->
    <p><a href="#" class="close-panel">关闭</a></p>
  </div>
</div>

    <script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='//g.alicdn.com/sui-mobile/sm/0.5.0/js/sm.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='//g.alicdn.com/sui-mobile/sm/0.5.0/js/sm-extend.min.js' charset='utf-8'></script>

    <script src="/your-js-file.js"></script>

  </body>
</html>