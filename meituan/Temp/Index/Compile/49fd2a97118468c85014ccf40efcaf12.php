<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="http://localhost/meituan/Public/css/reset.css" type="text/css" rel="stylesheet" >
<link href="http://localhost/meituan/Public/css/common.css" type="text/css" rel="stylesheet" >
<script type='text/javascript' src='http://localhost/meituan/hdphp/hdphp/Extend/Org/Jquery/jquery-1.8.2.min.js'></script>
<script>
    var URL="http://localhost/meituan";
</script>
<script type="text/javascript" src="http://localhost/meituan/Public/js/common.js"></script>
<script type="text/javascript" src="http://localhost/meituan/Public/js/myfocus-2.0.4.min.js"></script>

<meta name="keywords" content="" />
<meta name="description" content="" />
<title><?php echo $webInfo['title'];?></title>

</head>
<body>
	<!-- 顶部开始 -->
	<div id="top">
		<div class='position'>
			<div class='left'>
                            <?php if(isset($_SESSION['uid'])){?>
                                欢迎您:&nbsp;<span style="color:#cc0000;"><strong><?php echo $_SESSION['uname']?></strong></span>,&nbsp;&nbsp;&nbsp;&nbsp;这是您第<span style="color:#cc0000"><strong><?php echo $_COOKIE['cookieNum']+1?></strong></span>次光临本站,&nbsp;&nbsp;&nbsp;&nbsp;上次登陆时间是:<span style="color:#cc0000"><strong><?php echo $_COOKIE['lasttime']?></strong></span>&nbsp;&nbsp;祝您购物愉快。
                             
                                <?php  }else{ ?>
				欢迎光临本站,&nbsp;&nbsp;祝购物愉快!
                            <?php }?>
			</div>
			<div class='right'>
				<a href="javascript:addFavorite2();">收藏</a>
			</div>
		</div>
	</div>
	<!-- 顶部结束 -->
	<!-- 头部开始 -->
	<div id="header">
		<div class='position'>
			<div class='logo'>
				<a style="line-height:60px;" href="http://localhost/meituan">燕苑团购网</a>
				<a style="font-size:16px;" href="http://localhost/meituan">www.yanyuan.com</a>
			</div>
			<div class='search'>
				<div class='item'>
					<a href="http://localhost/meituan">小时代</a>
					<a href="http://localhost/meituan">KTV</a>
					<a href="http://localhost/meituan">电影</a>
					<a href="http://localhost/meituan">全聚德</a>
				</div>
				<div class='search-bar'>
                                    <form action="http://localhost/meituan/index.php/index/key/index" method="post">
					<input class='s-text' type="text" name="keywords" value="请输入商品名称，地址等">
					<input class='s-submit' type="submit" value='搜索'>
                                    </form>
				</div>
			</div>
			<div class='commitment'>
				
			</div>
		</div>
	</div>
	<!-- 头部结束 -->
	<!-- 导航开始-->
	<div id="nav">
		<div class='position'>
			<!-- 分类相关 -->
			<div class='category'>
				<a class='active' href="http://localhost/meituan">首页</a>
				  <?php if(isset($nav) && !empty($nav)):$_id_n=0;$_index_n=0;$lastn=min(1000,count($nav));
$hd["list"]["n"]["first"]=true;
$hd["list"]["n"]["last"]=false;
$_total_n=ceil($lastn/1);$hd["list"]["n"]["total"]=$_total_n;
$_data_n = array_slice($nav,0,$lastn);
if(count($_data_n)==0):echo "";
else:
foreach($_data_n as $key=>$n):
if(($_id_n)%1==0):$_id_n++;else:$_id_n++;continue;endif;
$hd["list"]["n"]["index"]=++$_index_n;
if($_index_n>=$_total_n):$hd["list"]["n"]["last"]=true;endif;?>

                                        <a href="http://localhost/meituan/index.php/Index/index/index/cid/<?php echo $n['cid'];?>"><?php echo $n['cname'];?></a>
                                        <?php $hd["list"]["n"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>
			</div>
			<!-- 用户相关 -->
			<div id="user-relevance" class='user-relevance'>
				
				<!--登录注册-->
                                  <div class='user-nav login-reg'>	
						<a class='title' href="<?php echo U('member/login/quit');?>">退出</a>
					</div>
					<div class='user-nav login-reg'>
						<a class='title' href="<?php echo U('member/reg/index');?>">注册</a>
					</div>
					<div class='user-nav login-reg'>	
						<a class='title' href="<?php echo U('member/login/index');?>">登录</a>
					</div>
                              
				<!--我的团购 -->	
					<div class='user-nav my-hdtg '>
						<a class='title' href="">我的团购</a>
						<ul class="menu">
							<li><a href="">我的订单</a></li>	
							<li><a href="">我的收藏</a></li>
							
						</ul>
					</div>
				<!-- 最近浏览 -->	
					<div  class='user-nav recent-view '>
						<a class='title' href="">最近浏览</a>
						<ul class="menu">
							
							
						</ul>
					</div>
					<div  class='user-nav my-cart '>
						<a class='title' href="http://localhost/meituan/index.php/member/cart/index"><i>&nbsp;</i>购物车<strong id="gou">(<?php if(isset($_SESSION['buy'])){?><?php echo count($_SESSION['buy'])?><?php  }else{ ?>0<?php }?>)</strong></a>
						<ul class="menu">
                                                    <p style="diaplay:block;" id="load">正在加载...</p>
							<p class='clear'><a href="">查看我的购物车</a></p>
						</ul>
					</div>
			</div>
		</div>
	</div> 
	<!-- 导航结束 -->
	