
<!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
<div class="content native-scroll">
    <?php if(isset($notice) and $notice!= ""):?>
        <div class="content-block-title" style="color:#f00;">Notice！</div>
        <div class="card">
            <div class="card-content">
                <div class="card-content-inner">
                    <?php echo $notice; ?>
                </div>
            </div>
        </div>
        <?php  endif?>
            <form action="<?php echo site_url('customer/order/addOrder');?>" method="post" onsubmit="return checkForm()">
                <div class="list-block">
                    <ul>
                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">专业
                                        <font color='red'>*</font>
                                    </div>
                                    <div class="item-input" id="city_5">
                                        <select class="prov" name="prov" required="required" data-placeholder="请选择专业">
                                        </select>
                                        <select class="city" name="city" disabled="disabled" required="required" data-placeholder="请选择专业"></select>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">课程名
                                        <font color='red'>*</font>
                                    </div>
                                    <div class="item-input">
                                        <input type="text" id="courseName" name="courseName" placeholder="请输入课程名称" required="required">
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
                                        <input type="email" id="email" name="email" placeholder="E-mail" required="required">
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">页数
                                        <font color='red'>*</font>
                                    </div>
                                    <div class="item-input">
                                        <select name="pageNum" id="pageNum" data-placeholder="请选择文章页数">
                                            <?php for($i=1;$i<=100;$i++){ ?>
                                                <option>
                                                    <?php echo $i; ?>
                                                </option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">阅读材料页数
                                        <font color='red'>*</font>
                                    </div>
                                    <div class="item-input">
                                        <select name="refDoc" id="refDoc" data-placeholder="请选择阅读材料数量">
                                            <?php for($i=0;$i<=100;$i++){ ?>
                                                <option>
                                                    <?php echo $i; ?>
                                                </option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">截止日期
                                        <font color='red'>*</font>
                                    </div>
                                    <div class="item-input">
                                        <input type="date" id="endDate" name="endDate" required="required" placeholder="请选择日期">
                                        </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">截止时间
                                        <font color='red'>*</font>
                                    </div>
                                    <div class="item-input">
                                        <input type="time" id="endTime" name="endTime" required="required" placeholder="请选择时间">
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">请选择时区
                                        <font color='red'>*</font>
                                    </div>
                                    <div class="item-input">
                                        <select name="timezone" id="timezone" required="required" data-placeholder="请选择您的时区">
                                            <option value="">请选择时区</option>
                                            <option value="PST8PDT">UTC-8(太平洋时间,洛杉矶)</option>
                                            <option value="MST7MDT">UTC-7(山地时间,丹佛)</option>
                                            <option value="CST6CDT">UTC-6(中央时间,芝加哥)</option>
                                            <option value="EST5EDT">UTC-5(东部时间,纽约)</option>
                                            <option value="Australia/Perth">UTC+8(澳大利亚时间,珀斯)</option>
                                            <option value="Australia/Darwin">UTC+9:30(澳大利亚东部时间,达尔文)</option>
                                            <option value="Australia/Sydney">UTC+10(澳大利亚中央东部时间,悉尼)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="align-top">
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">补充要求</div>
                                    <div class="item-input">
                                        <textarea id="requirement" name="requirement" placeholder="如有额外要求，请在这里填写~"></textarea>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                 <div class="list-block">
                    <ul class="table-view">
                      <li class="table-view-cell">
                        <a class="push-right" href="javascript:void(0);" onclick="showPrivacy();" data-ignore="push">
                          <strong>保密政策</strong>
                        </a>
                      </li>
                    </ul>
                    <ul class="table-view" id="privacy">
                      <li class="table-view-cell">
                        会写么非常重视用户信息的保护，在使用会写么的所有产品和服务前，请您务必仔细阅读并透彻理解本声明。一旦您选择使用，即表示您认可并接受本条款现有内容及其可能随时更新的内容。
                      </li>
                    </ul>
                  </div>
                <div class="content-block">
                    <div class="row">
                        <button class="col-100 button button-big button-fill button-success" type="submit">提交</button>
                    </div>
                </div>
            </form>
</div>
<!-- end content-->
<script>
jQuery(document).ready(function() {
    $('#privacy').hide();
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
        prov: "",
        city: "",
        dist: "",
        nodata: "none"
    });
    var today = new Date();
});

function checkForm() {
    var major = $('#major').val();
    var courseName = $('courseName').val();
    var email = $('#email').val();
    var date = $('#endDate').val();
    var time = $('#endTime').val();
    var timezone = $('#timezone').val();
    alert(major+' '+courseName+' '+email+' '+date+' '+time+' '+timezone);
    return false;

    var today = new Date();
    var endTime = date + ' ' + time;
    entTime = moment(endTime, "YYYY-MM-DD h:mm");
    if (moment(endTime).isBefore(today)) {
        alert('请选择合适的截止日期，应该大于当前日期！');
        return false;
    }
    return true;
}
function showPrivacy(){
    if($("#privacy").is(":hidden")){
        $("#privacy").show();    //如果元素为隐藏,则将它显现
    }else{
        $("#privacy").hide();     //如果元素为显现,则将其隐藏
    }
}
</script>
