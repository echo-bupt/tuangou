<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
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
<link href="http://localhost/meituan/meituan/App/Admin/Tpl/Public/css/common.css" rel="stylesheet" type="text/css" />
</head>
<body>
<script src="http://localhost/meituan/meituan/App/Admin/Tpl/Public/js/fenlei.js"></script>
<div id="map">
	<span class='title'>分类列表</span>
</div>
<div id="content">
	<table id="table" class='table table-striped table-bordered'>
		
			<tr>
				<th width="5%"></th>
				<th width="25%">分类名称</th>
				<th width="30%">分类标题</th>
				<th width="10%">分类排序</th>
				<th width="10%">是否显示</th>
				<th >操作</th>
			</tr>
		<?php if(isset($allInfo) && !empty($allInfo)):$_id_n=0;$_index_n=0;$lastn=min(1000,count($allInfo));
$hd["list"]["n"]["first"]=true;
$hd["list"]["n"]["last"]=false;
$_total_n=ceil($lastn/1);$hd["list"]["n"]["total"]=$_total_n;
$_data_n = array_slice($allInfo,0,$lastn);
if(count($_data_n)==0):echo "";
else:
foreach($_data_n as $key=>$n):
if(($_id_n)%1==0):$_id_n++;else:$_id_n++;continue;endif;
$hd["list"]["n"]["index"]=++$_index_n;
if($_index_n>=$_total_n):$hd["list"]["n"]["last"]=true;endif;?>

			<tr class="isshow" cid="<?php echo $n['cid'];?>" pid="<?php echo $n['pid'];?>">
				<td><a class='btn btn-mini btn-info  click' style="font-size:16px;" href="">+</a></td>
				<td><?php echo $n['html'];?><?php echo $n['cname'];?></td>
				<td><?php echo $n['title'];?></td>
				<td><?php echo $n['sort'];?></td>
				<td>
					<?php if($n['display']){?>
						显示
						<?php  }else{ ?>
						隐藏
					<?php }?>
				</td>
				<td>
					<a class='btn btn-small' href="<?php echo U('Admin/Category/add_cate');?>/cid/<?php echo $n['cid'];?>">添加子类</a>
					<a class='btn btn-small' href="<?php echo U('Admin/Category/edit');?>/cid/<?php echo $n['cid'];?>">编辑</a>
					<a class='btn btn-small' href="<?php echo U('Admin/Category/del');?>/cid/<?php echo $n['cid'];?>">删除</a>
				</td>
			</tr>
		<?php $hd["list"]["n"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>	
		<tbody>
		
		</tbody>
	</table>
</div>
</body>
</html>