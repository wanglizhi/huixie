
    <!-- Make sure all your bars are the first things in your <body> -->
    <header class="bar bar-nav">
      <h1 class="title">测试界面</h1>
    </header>

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
      <p class="content-padded">Thanks for downloading Ratchet. This is an example HTML page that's linked up to compiled Ratchet CSS and JS, has the proper meta tags and the HTML structure. Need some more help before you start filling this with your own content? Check out some Ratchet resources:</p>
      <div class="card">
        <ul class="table-view">
          <li class="table-view-cell">
            <a class="push-right" href="http://goratchet.com">
              <strong>Ratchet documentation</strong>
            </a>
          </li>
          <li class="table-view-cell">
            <a class="push-right" href="https://github.com/twbs/ratchet/">
              <strong>Ratchet on Github</strong>
            </a>
          </li>
          <li class="table-view-cell">
            <a class="push-right" href="https://groups.google.com/forum/#!forum/goratchet">
              <strong>Ratchet Google group</strong>
            </a>
          </li>
          <li class="table-view-cell">
            <a class="push-right" href="https://twitter.com/goratchet">
              <strong>Ratchet on Twitter</strong>
            </a>
          </li>
        </ul>
      </div>


<a href="#myModalexample" class="btn">Open modal</a>
<div id="myModalexample" class="modal">
  <header class="bar bar-nav">
    <a class="icon icon-close pull-right" href="#myModalexample"></a>
    <h1 class="title">Modal</h1>
  </header>

  <div class="content">
    <p class="content-padded">The contents of my modal go here. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut.</p>
  </div>
</div>

      
      <form action="<?php echo site_url('customer/user/starTa');?>" method="post" class="input-group">
  <div class="control-group">
    <label class="control-label">给TA打分:<span class="required">*</span></label>
    <div class="controls ">
      <div style="display: inline-block;" id="skill_star" name="skill_star" ></div>
      <input id="star" name="star" type="text" data-required="1" style="width:1px;visibility: hidden;"/>
    </div>
      <div class="">
        <button type="submit" class="btn btn-primary btn-block"><i class="icon-ok"></i> 评分</button>
      </div>
  </div>
  <div class="">
          <label for="major">专业<font color='red'>*</font></label>
          <div id="" class="">
          <select class="prov" name="prov" required="required" data-placeholder="请选择专业"></select>
          <select class="city" name="city" disabled="disabled" required="required" data-placeholder="请选择专业"></select>
        </div>
        </div>

        <input type="text" id='city-picker'/>


 <div class="input-row">
    <label>Full name</label>
    <input type="text" placeholder="Mister Ratchet">
  </div>
  <div class="input-row">
    <label>Email</label>
    <input type="email" placeholder="ratchetframework@gmail.com">
  </div>
  <div class="input-row">
    <label>Username</label>
    <input type="date" placeholder="goRatchet">
  </div>


  </form>



<form action="<?php echo site_url('customer/user/starTa');?>" method="post" class="input-group">
<div class="list-block">
    <ul>
      <!-- Text inputs -->
      <li>
        <div class="item-content">
          <div class="item-media"><i class="icon icon-form-name"></i></div>
          <div class="item-inner">
            <div class="item-title label">姓名</div>
            <div class="item-input">
              <input type="text" placeholder="Your name" required="required">
            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="item-content">
          <div class="item-media"><i class="icon icon-form-email"></i></div>
          <div class="item-inner">
            <div class="item-title label">邮箱<font color='red'>*</font></div>
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
            <div class="item-input" id ="city_5">

          <select class="prov" name="prov" required="required" data-placeholder="请选择专业"></select>
          <select class="city" name="city" disabled="disabled" required="required" data-placeholder="请选择专业"></select>

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
      <button class="col-100 button button-big button-fill button-success" type="submit">提交</button>
    </div>
  </div>
  </form>


  <div class="content-block-title">简单卡片</div>
  <div class="card">
    <div class="card-content">
      <div class="card-content-inner">这是一个用纯文本的简单卡片。但卡片可以包含自己的页头，页脚，列表视图，图像，和里面的任何元素。</div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">卡头</div>
    <div class="card-content">
      <div class="card-content-inner">头和尾的卡片。卡头是用来显示一些额外的信息，或自定义操作卡标题和页脚。</div>
    </div>
    <div class="card-footer">卡脚</div>
  </div>
  <div class="card">
    <div class="card-content">
      <div class="card-content-inner">这是一个用纯文本的简单卡片。但卡片可以包含自己的页头，页脚，列表视图，图像，和里面的任何元素。</div>
    </div>
  </div>
  <div class="content-block-title">风格卡片</div>
  <div class="card demo-card-header-pic">
    <div valign="bottom" class="card-header color-white no-border no-padding">
      <img class='card-cover' src="//gqianniu.alicdn.com/bao/uploaded/i4//tfscom/i3/TB10LfcHFXXXXXKXpXXXXXXXXXX_!!0-item_pic.jpg_250x250q60.jpg" alt="">
    </div>
    <div class="card-content">
      <div class="card-content-inner">
        <p class="color-gray">发表于 2015/01/15</p>
        <p>此处是内容...</p>
      </div>
    </div>
    <div class="card-footer">
      <a href="#" class="link">赞</a>
      <a href="#" class="link">更多</a>
    </div>
  </div>
  <div class="content-block-title">Facebook卡片</div>
  <div class="card facebook-card">
    <div class="card-header no-border">
      <div class="facebook-avatar"><img src="http://gqianniu.alicdn.com/bao/uploaded/i4//tfscom/i3/TB10LfcHFXXXXXKXpXXXXXXXXXX_!!0-item_pic.jpg_250x250q60.jpg" width="34" height="34"></div>
      <div class="facebook-name">夜萧</div>
      <div class="facebook-date">星期一 3:47pm</div>
    </div>
    <div class="card-content"><img src="http://gqianniu.alicdn.com/bao/uploaded/i4//tfscom/i3/TB10LfcHFXXXXXKXpXXXXXXXXXX_!!0-item_pic.jpg_250x250q60.jpg" width="100%"></div>
    <div class="card-footer no-border">
      <a href="#" class="link">赞</a>
      <a href="#" class="link">评论</a>
      <a href="#" class="link">分享</a>
    </div>
  </div>
  <div class="content-block-title">列表视图卡片</div>
  <div class="card">
    <div class="card-content">
      <div class="list-block">
        <ul>
          <li>
            <a href="#" class="item-link item-content">
              <div class="item-media"><i class="icon icon-f7"></i></div>
              <div class="item-inner">
                <div class="item-title">链接 1</div>
              </div>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">新的公布:</div>
    <div class="card-content">
      <div class="list-block media-list">
        <ul>
          <li class="item-content">
            <div class="item-media">
              <img src="http://gqianniu.alicdn.com/bao/uploaded/i4//tfscom/i3/TB10LfcHFXXXXXKXpXXXXXXXXXX_!!0-item_pic.jpg_250x250q60.jpg" width="44">
            </div>
            <div class="item-inner">
              <div class="item-title-row">
                <div class="item-title">标题</div>
              </div>
              <div class="item-subtitle">子标题</div>
            </div>
          </li>
        </ul>
      </div>
    </div>
    <div class="card-footer">
      <span>2015/01/15</span>
      <span>5 评论</span>
    </div>
  </div>            



    </div>
    <!-- end content-->

    <script>
    jQuery(document).ready(function() {
        //初始化专业二级选框
      var json = new Object();
        var citylist = new Array();
      for (var i = 0; i < major_array.length; i++) {
        // majorArray[i]
        var p = new Object();
        var c = new Array();

        for (var j = 0; j < sub_array[i].length; j++) {
          var n = new Object();
          n.n = sub_array[i][j];
          c.push(n);
        };

        p.p = major_array[i];
        p.c = c;
        citylist.push(p);
        // alert(JSON.stringify(p));
      };
      json.citylist = citylist;

      $("#city_5").citySelect({
        url: json,
        prov:"",
        city:"",
        dist:"",
        nodata:"none"
      });
    });

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
