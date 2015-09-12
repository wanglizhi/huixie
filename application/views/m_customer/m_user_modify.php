<!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
<div class="content native-scroll">

<form action="<?php echo site_url('customer/user/modify');?>" method="post">
                <div class="list-block">
                    <ul>
                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">学校
                                        <font color='red'>*</font>
                                    </div>
                                    <div class="item-input">
                                        <input type="text" id="university" name="university" placeholder="请输入学校名称" value="<?php echo $user['university'];?>" required="required">
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">邮箱
                                        <font color='red'>*</font>
                                    </div>
                                    <div class="item-input">
                                        <input type="email" id="email" name="email" placeholder="E-mail" required="required" value="<?php echo $user['email'];?>">
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">现金账户
                                        <font color='red'>*</font>
                                    </div>
                                    <div class="item-input">
                                    <select name="cashType" id="cashType" required="required" data-placeholder="请选择账户类型">
                    
                                        <?php if($user['cashType']==1): ?>
                                            <option value="1" selected="selected">Paypal</option>
                                            <option value="2">支付宝</option>
                                            <option value="3">微信支付</option>
                                        <?php elseif($user['cashType']==2): ?>
                                            <option value="1">Paypal</option>
                                            <option value="2" selected="selected">支付宝</option>
                                            <option value="3">微信支付</option>
                                        <?php elseif($user['cashType']==3): ?>
                                            <option value="1">Paypal</option>
                                            <option value="2">支付宝</option>
                                            <option value="3" selected="selected">微信支付</option>
                                        <?php else: ?>
                                            <option></option>
                                            <option value="1">Paypal</option>
                                            <option value="2">支付宝</option>
                                            <option value="3">微信支付</option>
                                        <?php endif ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">账户
                                        <font color='red'>*</font>
                                    </div>
                                    <div class="item-input">
                                        <input type="text" id="cashAccount" name="cashAccount" placeholder="请输入您的账户" value="<?php echo $user['cashAccount'];?>" required="required">
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                <div class="content-block">
                    <div class="row">
                        <button class="col-100 button button-big button-fill button-success" type="submit">提交</button>
                    </div>
                </div>
            </form>

</div>
<!-- end content-->