<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
   <script type='text/javascript' src='http://localhost/meituan/hdphp/hdphp/Extend/Org/Jquery/jquery-1.8.2.min.js'></script>
    <script src="http://localhost/meituan/meituan/App/Admin/Tpl/Public/js/locality.js">
        //这个js是我们利用框架中js验证规则
    </script>
    <!--这个是引入一个前台框架，是一个继承好的类，引入之后，我们对table设置的table table-striped table-bordered这三个类均可以起作用-->
    <link href="http://localhost/meituan/hdphp/hdphp/Extend/Org/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"><script src="http://localhost/meituan/hdphp/hdphp/Extend/Org/bootstrap/js/bootstrap.min.js"></script>
  <!--[if lte IE 6]>
  <link rel="stylesheet" type="text/css" href="http://localhost/meituan/hdphp/hdphp/Extend/Org/bootstrap/ie6/css/bootstrap-ie6.css">
  <![endif]-->
  <!--[if lte IE 7]>
  <link rel="stylesheet" type="text/css" href="http://localhost/meituan/hdphp/hdphp/Extend/Org/bootstrap/ie6/css/ie.css">
  <![endif]-->
    <link href="http://localhost/meituan/meituan/App/Admin/Tpl/Public/css/common.css" rel="stylesheet" type="text/css" />
   <link href="http://localhost/meituan/hdphp/hdphp/Extend/Org/HdUi/css/hdui.css" rel="stylesheet" media="screen"><script src="http://localhost/meituan/hdphp/hdphp/Extend/Org/HdUi/js/hdui.js"></script>
    <body>
   <div id="map">
	<span class='title'>添加地区</span>
</div>
<div id="content">
	<form action="<?php echo U('Admin/Locality/add');?>" id="validation"method="post">
	<table class='table table-striped table-bordered'>
		<thead>
			<tr>
				<th width="20%">名称</th>
				<th>值</th>
			</tr>
		</thead>
		<tbody>
                    <tr>
				<td>所属地区</td>
				<td>
                                    <select name="pid">
                                           <option value="0">顶级分类</option>
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

                                            <option value="<?php echo $n['lid'];?>"><?php echo $n['html'];?><?php echo $n['lname'];?></option>
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
				<td>地区名称</td>
				<td>
					<input type="text" name="lname" style="height:100%;"/>
				</td>
			</tr>
			<tr>
				<td>地区排序</td>
				<td>
					<input name="sort" type="text" style="height:100%;"/>
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
