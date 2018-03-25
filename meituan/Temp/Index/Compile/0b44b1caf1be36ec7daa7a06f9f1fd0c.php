<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?>	<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
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
	
<!-- 载入公共头部文件结束 -->
<script>
    var URL="http://localhost/meituan"+"/index.php/member/cart";
</script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=AC37be9efe7459c38f04c34a964155a2"></script>
	<link href="http://localhost/meituan/meituan/App/Index/Tpl/Public/css/detail.css" type="text/css" rel="stylesheet" >
	<div id="map" class='position'>
            <a href="<?php echo U('index/index/index');?>/lid/<?php echo $detailInfo['lid'];?>"><?php echo $detailInfo['lname'];?></a><span>»</span><a href="<?php echo U('index/index/index');?>/cid/<?php echo $detailInfo['cid'];?>"><?php echo $detailInfo['cname'];?></a><span>»</span><span><?php echo $detailInfo['shopname'];?></span>
	</div>
	<div id="content" class='position' style="height:auto;">
		<div class='content-left'>
			<div class="goods-intro">
				<div class='goods-title'>
                                    <form action="" method="" id="goodsForm">
                                      <input type="hidden" name="main_title" value="<?php echo $detailInfo['main_title'];?>"/>
                                     <input type="hidden" value="<?php echo $detailInfo['yuan_img'];?>" name="goods_img"/>
                                    <input type="hidden" value="<?php echo $detailInfo['main_title'];?>" name="goods_name"/>
                                    <input type="hidden" value="<?php echo $_GET['gid'];?>" name="gid" id="goodsId"/>
					<h1><?php echo $detailInfo['main_title'];?></h1>
					<h3><?php echo $detailInfo['sub_title'];?></h3>
				</div>
				<div class='deal-intro'>
					<div class='buy-intro'>
						<div class='price'>
							<div class='discount-price'>
                                                            <input type="hidden" value="<?php echo $detailInfo['price'];?>" name="price"/>
								<span>¥</span><?php echo $detailInfo['price'];?>
							</div>
                                                    </form>
							<div class='cost-price'>
								<span class='discount'><?php echo $detailInfo['zhekou'];?>折</span>
								门店价<b>¥<?php echo $detailInfo['old_price'];?></b>
							</div>
						</div>
						<div class='deal-buy-cart'>
							<a href="http://localhost/meituan/index.php/member/buy/index/gid/<?php echo $detailInfo['gid'];?>" class='buy'></a>
							<a href="" class='cart' id="addCart"></a>
						</div>
						<div class='purchased'>
							<p class='people'>
								<span><?php echo $detailInfo['buy'];?></span>人已团购
							</p>
							<p class='time'>
								<?php echo $detailInfo['time'];?>
							</p>
						</div>
						<ul class='refund-intro'>
                                                    <?php if(is_array($detailInfo['goods_rule'])):?><?php  foreach($detailInfo['goods_rule'] as $v){ ?>
							<li>
								<?php echo $v['img'];?>
								<span class='text'><?php echo $v['name'];?></span>
							</li>
                                                    <?php }?><?php endif;?>
						</ul>
					</div>
					<div class='image-intro'>
						<img src="<?php echo $detailInfo['goods_img'];?>"/>
					</div>
				</div>
				<div class='collect'>
					<a class='collect-link' href=''><i></i>收藏本单</a>
					
					<div class='share'>
						
					</div>
					
				</div>
			</div>
			<div class='detail'>
				<ul class='plot-points'>
					<li class='active'><a href="#shop-site">商家位置</a></li>
					<li><a href="#details">本单详情</a></li>
					<li><a href="#comment">消费评价</a></li>
				</ul>
				<div id="shop-site" class='shop-site'>
					<p class='site-title'>商家位置</p>
					<div class='box'>
						<div class='map' id="bMap">
							<!--这里盛放百度API请求来的地图信息-->
						</div>
						<div class='info'>
							<h3><?php echo $detailInfo['shopname'];?></h3>
							<dl>
								<dt>地址:</dt>
								<dd><?php echo $detailInfo['shopaddress'];?></dd>
							</dl>
							<dl>
								<dt>地铁:</dt>
								<dd><?php echo $detailInfo['metroaddress'];?></dd>
							</dl>
							<dl>
								<dt>电话:</dt>
								<dd><?php echo $detailInfo['shoptel'];?></dd>
							</dl>
						</div>
					</div>
				</div>
				<div id="details"  class='details'>
					<?php echo $detailInfo['detail'];?>
				</div>
				<div id="comment" class='comment'>
					<div class='comment-list-title'>
						<span>全部评价</span>
						<a class='order-time' href="">按时间<i></i></a>
					</div>
					<div class='comment-list'>
						<div class='list-con'>
							<div class='con-top'>
								<span class='username'>sdas</span>
								<span class='time'>评价于:<em>2013-08-04</em></span>
							</div>
							<p>
								说是香草拿铁不是很苦，结果根本不是想象中的味道！像速溶冲调！还要另加五元？有此一说吗？银座店环境一般！
							</p>
						</div>
						
					</div>
					<div class='comment-page'>
						<a href="">1</a>
						<a href="">1</a>
						<a href="">1</a>
						<a href="">1</a>
						<a href="">1</a>
						<a href="">1</a>
					</div>
				</div>
			</div>
		
		</div>
		<div class='content-right'>
			<div class='recommend'>
				<h3 class='recommend-title'>
					看过本团购的用户还看了
				</h3>
                            <?php if(isset($relitiveData) && !empty($relitiveData)):$_id_n=0;$_index_n=0;$lastn=min(1000,count($relitiveData));
$hd["list"]["n"]["first"]=true;
$hd["list"]["n"]["last"]=false;
$_total_n=ceil($lastn/1);$hd["list"]["n"]["total"]=$_total_n;
$_data_n = array_slice($relitiveData,0,$lastn);
if(count($_data_n)==0):echo "";
else:
foreach($_data_n as $key=>$n):
if(($_id_n)%1==0):$_id_n++;else:$_id_n++;continue;endif;
$hd["list"]["n"]["index"]=++$_index_n;
if($_index_n>=$_total_n):$hd["list"]["n"]["last"]=true;endif;?>

				<div class='recommend-goods'>
					<a class='goods-image' href="http://localhost/meituan/index.php/index/detail/index/gid/<?php echo $n['gid'];?>">
						<img alt="图像加载失败.." src="<?php echo $n['goods_img'];?>">
					</a>
					<h4>
						<a href=""><?php echo $n['main_title'];?></a>
					</h4>
					<p>
						<strong>¥<?php echo $n['price'];?></strong>
						<span class='num'>
							<span><?php echo $n['buy'];?></span>
							 人已购
						</span>
					</p>
				</div>
                            <?php $hd["list"]["n"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>
			</div>
		</div>
		
		
		
	</div>		


<div class="c"></div>
	<div id="cover"></div>
	<div id="infoWindow">
		
	</div>
	
	

	<br/>
	<br/>
	<br/>
<!-- 载入公共头部文件开始 --> 
	<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?>
	<div id="footer">
		<p>本demo不用于任何商业目的，仅供学习与交流</p>
	</div>
	</body>
</html>
<!-- 载入公共头部文件结束 -->
<script src="http://localhost/meituan/meituan/App/Index/Tpl/Public/js/detail.js"></script>
	<script>
		var shopcoord = <?php echo $detailInfo['shopcoord'];?>;
		// 百度地图API功能
		var map = new BMap.Map("bMap");            // 创建Map实例
		var point = new BMap.Point(shopcoord.lng, shopcoord.lat);    // 创建点坐标
		map.centerAndZoom(point,15);                     	// 初始化地图,设置中心点坐标和地图级别。
		map.enableScrollWheelZoom();                        //启用滚轮放大缩小
		var marker1 = new BMap.Marker(point);  // 创建标注
		map.addOverlay(marker1);              // 将标注添加到地图中
		map.addControl(new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_RIGHT, type: BMAP_NAVIGATION_CONTROL_SMALL}));  //右上角，仅包含平移和缩放按钮
	</script>










