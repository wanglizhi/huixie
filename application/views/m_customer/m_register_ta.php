<!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
<div class="content native-scroll">
    <?php if($ta and $ta['hasCheck']): ?>
        <div class="content-block-title">您已经通过审核成为助教</div>
        <div class="list-block">
            <ul>
                <li class="item-content item-link">
                    <div class="item-inner">
                        <div class="item-title">技能</div>
                        <div class="item-after item-text">
                            <?php echo $ta['skills'];?>
                        </div>
                    </div>
                </li>
                <li class="item-content">
                    <div class="item-inner">
                        <div class="item-title">单价</div>
                        <div class="item-after">
                            <?php echo $ta['unitPrice'];?>
                        </div>
                    </div>
                </li>
                <li class="item-content">
                    <div class="item-inner">
                        <div class="item-title">技能评价</div>
                        <div class="item-after">
                            <div style="display: inline-block;" id="skill_star" name="skill_star"></div>
                            <input id="star" name="star" type="text" data-required="1" style="width:1px;visibility: hidden;" />
                        </div>
                    </div>
                </li>
                <li class="item-content">
                    <div class="item-inner">
                        <div class="item-title">当前状态</div>
                        <div class="item-after">
                            <?php if($ta['state']==0): ?>
                                空闲
                                <?php elseif($ta['state']==1): ?>
                                    有课
                                    <?php else: ?>
                                        忙碌
                                        <?php endif ?>
                        </div>
                    </div>
                </li>
                <li class="table-view-cell">
                    简介：<?php echo $ta['introduction'];?>
                </li>
            </ul>
        </div>
        <div class="content-block-title">修改信息</div>
        <div class="list-block">
        <form action="<?php echo site_url('customer/ta/modify');?>" method="post">
                <ul>
                    <li>
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-title label">邮箱
                                    <font color='red'>*</font>
                                </div>
                                <div class="item-input">
                                    <input type="email" id="email" name="email" placeholder="" value="<?php echo $ta['email'];?>" required="required">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-title label">当前状态
                                    <font color='red'>*</font>
                                </div>
                                <div class="item-input">
                                    <select name="cashType" id="cashType" required="required" data-placeholder="请选择当前状态" value="<?php echo $ta['state'];?>">
                                        <?php if($ta['state']==0): ?>
                                            <option value="0" selected="selected">空闲</option>
                                            <option value="2">忙碌</option>
                                            <?php elseif($ta['state']==2): ?>
                                                <option value="0">空闲</option>
                                                <option value="2" selected="selected">忙碌</option>
                                                <?php elseif($ta['state']==1): ?>
                                                    <option value="1" selected="selected">有课</option>
                                                    <option value="2">忙碌</option>
                                                    <?php else: ?>
                                                        <option></option>
                                                        <option value="1">有课</option>
                                                        <option value="2">忙碌</option>
                                                        <?php endif ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="content-block">
                    <div class="row">
                        <button class="col-100 button button-big button-fill button-success" type="submit">修改</button>
                    </div>
                </div>

           </form>
           </div>
        <div class="content-padded">如果需要修改助教的相关信息，请联系客服，并且将相关材料发送到邮箱admin@huixie.me</div>
        <?php else: ?>
            <?php if($ta): ?>
                <div class="content-block-title">您已经提交过助教申请</div>
                <div class="list-block">
                    <ul>
                        <li class="item-content">
                            <div class="item-inner">
                                <div class="item-title">邮箱</div>
                                <div class="item-after">
                                    <?php echo $ta['email'];?>
                                </div>
                            </div>
                        </li>
                        <li class="item-content">
                            <div class="item-inner">
                                <div class="item-title">简介</div>
                                <p>
                                    <?php echo $ta['introduction'];?>
                                </p>
                            </div>
                        </li>
                        <li class="item-content">
                            <div class="item-inner">
                                <p>请联系客服发送材料等待审核，重新点击提交申请可以更改邮箱。</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <?php endif ?>
                    <div class="content-block-title">助教申请表单</div>
                    

                        <div class="list-block">
                        <form action="<?php echo site_url('customer/ta/register');?>" method="post">
                            <ul>
                                <li>
                                    <div class="item-content">
                                        <div class="item-inner">
                                            <div class="item-title label">邮箱
                                                <font color='red'>*</font>
                                            </div>
                                            <div class="item-input">
                                                <input type="email" id="email" name="email" placeholder="" required="required">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="item-content">
                                        <div class="item-inner">
                                            <div class="item-title label">自我介绍
                                                <font color='red'>*</font>
                                            </div>
                                            <div class="item-input">
                                                <textarea id="introduction" name="introduction" placeholder="请输入您的简介~" required="required"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="content-block">
                                <div class="row">
                                    <button class="col-100 button button-big button-fill button-success" type="submit">提交申请</button>
                                </div>
                          </form>
                          </div>
                   
                    <?php endif ?>
                        </div>
                        <!-- end content-->
                        <script>
                        jQuery(document).ready(function() {
                            $('#skill_star').raty({
                                readOnly: true,
                                path: 'media/image',
                                half: true,
                                starHalf: 'star-half.png',
                                starOff: 'star-off.png',
                                starOn: 'star-on.png',
                                <?php if($ta['star']!=""):?>
                                score: <?=$ta['star']?>
                                <?php endif;?>
                            });
                        });
                        </script>
