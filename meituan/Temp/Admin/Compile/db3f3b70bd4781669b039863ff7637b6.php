<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
 <script type='text/javascript' src='http://localhost/meituan/hdphp/hdphp/Extend/Org/Jquery/jquery-1.8.2.min.js'></script>
    <link href="http://localhost/meituan/hdphp/hdphp/Extend/Org/HdUi/css/hdui.css" rel="stylesheet" media="screen"><script src="http://localhost/meituan/hdphp/hdphp/Extend/Org/HdUi/js/hdui.js"></script>
    <script src="http://localhost/meituan/meituan/App/Admin/Tpl/Public/js/category.js"></script>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<link rel="stylesheet" href="http://localhost/meituan/meituan/App/Admin/Tpl/Public/Css/add_category.css" />
	<title></title>
</head>
<body>
	<form action="http://localhost/meituan/index.php/Admin/Locality/add_locality" method="post" id="validation">
		<table class="table">
			<tr >
				<td class="th" colspan="2">添加子地区</td>
			</tr>
			<tr>
				<td>地区名称</td>
				<td><input type="text" name="lname"/></td>
                                <input type="hidden" name="pid" value="<?php echo $_GET['lid'];?>"/>
			</tr>
			<tr>
				<td>地区排序</td>
				<td>
					<input name="sort" type="text" />
				</td>
			</tr>
			<tr>
				<td>是否显示</td>
				<td>
					<lable>
						<input type="radio" name="display" value="1" checked="checked"/>	
						<span>显示</span>
					</lable>
					<lable>
						<input type="radio" name="display" value="0"/>	
						<span>隐藏</span>
					</lable>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" value="添加" class="input_button"/>
					<input type="reset" class="input_button"/>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>

