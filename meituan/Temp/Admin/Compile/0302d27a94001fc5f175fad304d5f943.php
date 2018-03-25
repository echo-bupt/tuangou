<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?><script type='text/javascript' src='http://localhost/meituan/hdphp/hdphp/Extend/Org/Jquery/jquery-1.8.2.min.js'></script>
<link href="http://localhost/meituan/hdphp/hdphp/Extend/Org/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"><script src="http://localhost/meituan/hdphp/hdphp/Extend/Org/bootstrap/js/bootstrap.min.js"></script>
  <!--[if lte IE 6]>
  <link rel="stylesheet" type="text/css" href="http://localhost/meituan/hdphp/hdphp/Extend/Org/bootstrap/ie6/css/bootstrap-ie6.css">
  <![endif]-->
  <!--[if lte IE 7]>
  <link rel="stylesheet" type="text/css" href="http://localhost/meituan/hdphp/hdphp/Extend/Org/bootstrap/ie6/css/ie.css">
  <![endif]-->
<link href="http://localhost/meituan/hdphp/hdphp/Extend/Org/HdUi/css/hdui.css" rel="stylesheet" media="screen"><script src="http://localhost/meituan/hdphp/hdphp/Extend/Org/HdUi/js/hdui.js"></script>
<!--其实我们引入header.html这个文件也就是仅仅为了把那些js文件包，css文件包引入进来-->
<script src="http://localhost/meituan/meituan/App/Admin/Tpl/Public/js/fenlei.js"></script>
<link href="http://localhost/meituan/meituan/App/Admin/Tpl/Public/css/common.css" rel="stylesheet" type="text/css" />
    <body>
     <div id="map">
	<span class='title'>地区列表</span>
</div>
<div id="content">
	<table id="table" class='table table-striped table-bordered'>
		
			<tr>
				<th width="5%"></th>
				<th width="25%">地区名称</th>
				<th width="10%">地区排序</th>
				<th width="10%">是否显示</th>
				<th >操作</th>
			</tr>
		<?php if(isset($localityInfo) && !empty($localityInfo)):$_id_n=0;$_index_n=0;$lastn=min(1000,count($localityInfo));
$hd["list"]["n"]["first"]=true;
$hd["list"]["n"]["last"]=false;
$_total_n=ceil($lastn/1);$hd["list"]["n"]["total"]=$_total_n;
$_data_n = array_slice($localityInfo,0,$lastn);
if(count($_data_n)==0):echo "";
else:
foreach($_data_n as $key=>$n):
if(($_id_n)%1==0):$_id_n++;else:$_id_n++;continue;endif;
$hd["list"]["n"]["index"]=++$_index_n;
if($_index_n>=$_total_n):$hd["list"]["n"]["last"]=true;endif;?>

			<tr class="isshow" cid="<?php echo $n['lid'];?>" pid="<?php echo $n['pid'];?>">
				<td><a class='btn btn-mini btn-info  click' style="font-size:16px;" href="">+</a></td>
				<td><?php echo $n['html'];?><?php echo $n['lname'];?></td>
				<td><?php echo $n['sort'];?></td>
				<td>
					<?php if($n['display']){?>
						显示
						<?php  }else{ ?>
						隐藏
					<?php }?>
				</td>
				<td>
					<a class='btn btn-small' href="<?php echo U('Admin/Locality/add_locality');?>/lid/<?php echo $n['lid'];?>">添加子地区</a>
					<a class='btn btn-small' href="<?php echo U('Admin/Locality/edit');?>/lid/<?php echo $n['lid'];?>">编辑</a>
					<a class='btn btn-small' href="<?php echo U('Admin/Locality/del');?>/lid/<?php echo $n['lid'];?>">删除</a>
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
