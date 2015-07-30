<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	  <base href="<?php echo base_url();?>"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="ajax,jquery,省市联动" />
		<meta name="description" content="ijquery演示平台，演示XHTML、CSS、jquery、PHP案例和示例" />
		<link rel="stylesheet" type="text/css" href="css/main.css" />

		<style type="text/css">
			.demo{width:80%; margin:20px auto}
			.demo h3{height:32px; line-height:32px}
			.demo p{line-height:24px}
			pre{margin-top:10px; padding:6px; background:#f7f7f7}
		</style>
		<script src="media/js/jquery-1.10.1.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/jquery.cityselect.js"></script>
		<script type="text/javascript" src="js/majorData.js"></script>
		<script type="text/javascript">
			$(function(){

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
		</script>
	</head>
	
	<body>
		<div id="main">
			
			<div class="demo">
				<h3>自定义下拉选项</h3>
				<form action="<?php echo site_url('customer/oauth/check');?>" method="post">
				<div id="city_5">
					<select class="prov" name="prov" required="required"></select>
					<select class="city" name="city" disabled="disabled" required="required"></select>
					<select class="dist" name="dist" disabled="disabled"></select>
				</div>
				<div class="form-actions">
  				<button type="submit" class="btn blue"><i class="icon-ok"></i> 提交</button>
  				</div>
				</form>
				<pre>
					$("#city_5").citySelect({
					url:{"citylist":[
					{"p":"前端技术","c":[{"n":"HTML"},{"n":"CSS","a":[{"s":"CSS2.0"},{"s":"CSS3.0"}]},{"n":"JAVASCIPT"}]},
					{"p":"编程语言","c":[{"n":"C"},{"n":"C++"},{"n":"Objective-C"},{"n":"PHP"},{"n":"JAVA"}]},
					{"p":"数据库","c":[{"n":"Mysql"},{"n":"SqlServer"},{"n":"Oracle"},{"n":"DB2"}]},
					]},
					prov:"",
					city:"",
					dist:"",
					nodata:"none"
					});
				</pre>
			</div>
			
		</div>
	</body>
</html>
