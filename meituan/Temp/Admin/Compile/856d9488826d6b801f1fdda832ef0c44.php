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
<link href="http://localhost/meituan/meituan/App/Admin/Tpl/Public/css/common.css" rel="stylesheet" type="text/css" />
    <body>
     <div id="map">
	<span class='title'>商铺列表</span>
</div>
<div id="content">
	<table id="table" class='table table-striped table-bordered'>
            <thead>
			<tr>
				<th width="10%">商铺名称</th>
				<th width="20%">商铺地址</th>
				<th width="20%">地铁地址</th>
				<th width="15%">商家电话</th>
                                <th width="20%">操作</th>
                                
			</tr>
            </thead>
            <tbody>
		<?php if(isset($allShopInfo) && !empty($allShopInfo)):$_id_n=0;$_index_n=0;$lastn=min(1000,count($allShopInfo));
$hd["list"]["n"]["first"]=true;
$hd["list"]["n"]["last"]=false;
$_total_n=ceil($lastn/1);$hd["list"]["n"]["total"]=$_total_n;
$_data_n = array_slice($allShopInfo,0,$lastn);
if(count($_data_n)==0):echo "";
else:
foreach($_data_n as $key=>$n):
if(($_id_n)%1==0):$_id_n++;else:$_id_n++;continue;endif;
$hd["list"]["n"]["index"]=++$_index_n;
if($_index_n>=$_total_n):$hd["list"]["n"]["last"]=true;endif;?>

			<tr>
				<td><?php echo $n['shopname'];?></td>
				<td><?php echo $n['metroaddress'];?></td>
				<td>
                                    <?php echo $n['metroaddress'];?>
				</td>
                                <td><?php echo $n['shoptel'];?></td>
				<td>
					<a class='btn btn-small' href="<?php echo U('Admin/Goods/add');?>/shopid/<?php echo $n['shopid'];?>">添加商品</a>
					<a class='btn btn-small' href="<?php echo U('Admin/Shop/edit');?>/shopid/<?php echo $n['shopid'];?>">编辑</a>
					<a class='btn btn-small' href="<?php echo U('Admin/Shop/del');?>/shopid/<?php echo $n['shopid'];?>">删除</a>
				</td>
			</tr>
		<?php $hd["list"]["n"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>	
        </tbody>
	</table>
</div>
    </body>
</html>

