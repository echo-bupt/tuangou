<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="http://localhost/meituan/meituan/App/Admin/Tpl/Public/css/base.css" type="text/css" rel="stylesheet">
<link href="http://localhost/meituan/meituan/App/Admin/Tpl/Public/css/index.css" type="text/css" rel="stylesheet">
<link href="http://localhost/meituan/meituan/App/Admin/Tpl/Public/css/reset.css" type="text/css" rel="stylesheet">
<script type='text/javascript' src='http://localhost/meituan/hdphp/hdphp/Extend/Org/Jquery/jquery-1.8.2.min.js'></script>
<script	type="text/javascript" src="http://localhost/meituan/meituan/App/Admin/Tpl/Public/js/index.js"></script>

<base target="showContent" />
<title>仿美团</title>

</head>
<body style="overflow:hidden;" scroll="no">

<div id="header">
	<div class='hd-box'>
		<div class='hd-top'>
			<div class="logo">
				<a href="http://localhost/meituan/index.php/Admin"><img src="http://localhost/meituan/hdtg/App/Admin/Tpl/Public/images/logo.png"/></a>
			</div>
			<div class='logout'>
                            <a style='color:#FFF;' href="http://localhost/meituan" target="_bank">站点主页</a>
                                <a href="http://localhost/meituan/index.php/Admin/login/quit" target="_bank">退出登录</a>
			</div>
		</div>
		<div class='bar'>
			<div class='home'>
				<a href="http://localhost/meituan/index.php/Admin"></a>
			</div>
			<div class="nav">
				
				<a href="javascript:void(0);">会员管理</a>
				
				<a href="<?php echo U('Admin/Locality/index');?>">地区管理</a>
				
				<a href="http://localhost/meituan/index.php/Admin/category/index">分类管理</a>
			
				<a href="<?php echo U('Admin/Shop/index');?>">商铺管理</a>
				
				<a href="<?php echo U('admin/goods/index');?>">商品管理</a>
				
				<a  href="javascript:void(0);">订单管理</a>
				
				<a class='active' href="javascript:void(0);">站点概要</a>
			</div>
		</div>
	</div>
</div>
<div id="box">
	<div id="sidebar">
		<!-- 会员管理 -->
		<div class='menuItem'>
			<div class='menu'>
				<a class='title' href="javascript:void(0);">会员管理</a>
				<ul class='menuList' >
					<li><a href=""></a></li>
					<li><a href=""></a></li>
				</ul>
			</div>
		</div>
		<!-- 地区管理 -->
		<div class='menuItem'>
			<div class='menu'>
				<a class='title' href="javascript:void(0);">地区管理</a>
				<ul class='menuList' >
					<li><a href="<?php echo U('Admin/Locality/add');?>">添加地区</a></li>
					<li><a href="<?php echo U('Admin/Locality/index');?>">地区列表</a></li>
				</ul>
			</div>
		</div>
		<!-- 分类管理 -->
		<div class='menuItem'>
			<div class='menu'>
				<a class='title' href="http://localhost/meituan/index.php/Admin/category/index">分类管理</a>
				<ul class='menuList' >
					<li><a href="<?php echo U('Admin/Category/add');?>">添加分类</a></li>
					<li><a href="<?php echo U('admin/category/index');?>">分类列表</a></li>
				</ul>
			</div>
		</div>
		<!-- 商铺管理 -->
		<div class='menuItem'>
			<div class='menu'>
				<a class='title' href="javascript:void(0);">商铺管理</a>
				<ul class='menuList' >
					<li><a href="<?php echo U('Admin/Shop/add');?>">添加商铺</a></li>
					<li><a href="<?php echo U('Admin/Shop/index');?>">商铺列表</a></li>
				</ul>
			</div>	
		</div>	
		<!-- 商品管理 -->
		<div class='menuItem'>
			<div class='menu'>
				<a class='title' href="javascript:void(0);">商品管理</a>
				<ul class='menuList' >
					<li><a href="<?php echo U('admin/goods/index');?>">商品列表</a></li>
				</ul>
			</div>	
		</div>
		<!-- 订单管理 -->
		<div class='menuItem'>
			<div class='menu'>	
				<a class='title' href="javascript:void(0);">订单管理</a>
				<ul class='menuList' >
					<li><a href=""></a></li>
					<li><a href=""></a></li>
				</ul>
			</div>
		</div>
		<!-- 站点概要 -->
		<div class='menuItem' style="display:block;">
			<div class='menu'>	
				<a class='title' href="javascript:void(0);">站点概要</a>
				<ul class='menuList' >
					<li><a href=""></a></li>
					<li><a href=""></a></li>
				</ul>
			</div>
		</div>
	</div>
	<div id="content">
		 <iframe id="iContent" name='showContent' scrolling="auto" height="100%" width="100%" frameborder="0" src="http://localhost/meituan/index.php/Admin/Index/welcome" >
     		  
	 	</iframe>
	</div>
</div>
</body>
</html>