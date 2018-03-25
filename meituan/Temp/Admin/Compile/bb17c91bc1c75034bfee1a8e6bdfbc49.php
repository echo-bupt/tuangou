<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?><?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title></title>
<script type='text/javascript' src='http://localhost/meituan/hdphp/hdphp/Extend/Org/Jquery/jquery-1.8.2.min.js'></script>
<link href="http://localhost/meituan/hdphp/hdphp/Extend/Org/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"><script src="http://localhost/meituan/hdphp/hdphp/Extend/Org/bootstrap/js/bootstrap.min.js"></script>
  <!--[if lte IE 6]>
  <link rel="stylesheet" type="text/css" href="http://localhost/meituan/hdphp/hdphp/Extend/Org/bootstrap/ie6/css/bootstrap-ie6.css">
  <![endif]-->
  <!--[if lte IE 7]>
  <link rel="stylesheet" type="text/css" href="http://localhost/meituan/hdphp/hdphp/Extend/Org/bootstrap/ie6/css/ie.css">
  <![endif]-->
<script type="text/javascript" src="http://localhost/meituan/meituan/App/Admin/Tpl/Public/js/common.js"> </script>
<link href="http://localhost/meituan/meituan/App/Admin/Tpl/Public/css/common.css" rel="stylesheet" type="text/css" />
</head>
<body>
<link href="http://localhost/meituan/hdphp/hdphp/Extend/Org/HdUi/css/hdui.css" rel="stylesheet" media="screen"><script src="http://localhost/meituan/hdphp/hdphp/Extend/Org/HdUi/js/hdui.js"></script>
<link href="http://localhost/meituan/meituan/App/Admin/Tpl/Public/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=您的密钥"></script>
<script src="http://localhost/meituan/meituan/App/Admin/Tpl/Public/js/category.js"></script>
<div id="map">
	<span class='title'>添加分类</span>
</div>
<div id="content">
	<form action="<?php echo U('Admin/Category/add');?>" id="validation"method="post">
	<table class='table table-striped table-bordered'>
		<thead>
			<tr>
				<th width="20%">名称</th>
				<th>值</th>
			</tr>
		</thead>
		<tbody>
                    <tr>
				<td>所属分类</td>
				<td>
                                    <select name="pid">
                                           <option value="0">顶级分类</option>
                                        <?php if(isset($cateInfo) && !empty($cateInfo)):$_id_n=0;$_index_n=0;$lastn=min(1000,count($cateInfo));
$hd["list"]["n"]["first"]=true;
$hd["list"]["n"]["last"]=false;
$_total_n=ceil($lastn/1);$hd["list"]["n"]["total"]=$_total_n;
$_data_n = array_slice($cateInfo,0,$lastn);
if(count($_data_n)==0):echo "";
else:
foreach($_data_n as $key=>$n):
if(($_id_n)%1==0):$_id_n++;else:$_id_n++;continue;endif;
$hd["list"]["n"]["index"]=++$_index_n;
if($_index_n>=$_total_n):$hd["list"]["n"]["last"]=true;endif;?>

                                            <option value="<?php echo $n['cid'];?>"><?php echo $n['html'];?><?php echo $n['cname'];?></option>
                                            <?php $hd["list"]["n"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>
                                    </select>
				</td>
			</tr>
			<tr>
				<td>分类名称</td>
				<td>
					<input type="text" name="cname" />
				</td>
			</tr>
			<tr>
				<td>分类标题</td>
				<td>
					<textarea name="title"></textarea>
				</td>
			</tr>
			<tr>
				<td>分类关键字</td>
				<td>
					<textarea name="keywords"></textarea>
				</td>
			</tr>
			<tr>
				<td>分类描述</td>
				<td>
					<textarea name="description"></textarea>
				</td>
			</tr>
			<tr>
				<td>分类排序</td>
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
				<td></td>
				<td><input type="submit" class='btn' /></td>
			</tr>
		</tbody>
	</table>
	</form>
	
	
	
</div>
</body>
</html>
