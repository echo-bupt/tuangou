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
	
        <style type="text/css">
  a.backToTop{width:60px; height:60px; background:#eaeaea url("http://localhost/meituan/meituan/App/Index/Tpl/Public/images/top.gif") no-repeat -51px 0; text-indent:-999em}
  a.backToTop:hover{background-position:-113px 0}
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="http://localhost/meituan/meituan/App/Index/Tpl/Public/js/gotoTop.js"></script>
	<!-- 载入公共头部文件-->
	<!-- 载入商品筛选-->
	<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?><!-- 商品过滤开始 -->
	<div id="filter">
		<div class='hots'>
			<span>热门标签：</span>
			<div class='box'>	
				<a href="http://localhost/meituan/index.php/index/index/index/cid/7">电影</a><a href="http://localhost/meituan/index.php/index/index/index/cid/1">美食</a><a href="http://localhost/meituan/index.php/index/index/index/cid/25">经济型酒店</a><a href="http://localhost/meituan/index.php/index/index/index/cid/14">KTV</a><a href="http://localhost/meituan/index.php/index/index/index/cid/4">火锅</a><a href="http://localhost/meituan/index.php/index/index/index/cid/11">烧烤烤肉</a>
			</div>	
		</div>
		
		<div class='filter-box'>
			<div class='category filter-label'>
				<div class='filter-label-level-1'>
					<span><b></b>分类：</span>
					<div class='box'>
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

                                                    <?php echo $n;?>
                                           <?php $hd["list"]["n"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>
					</div>
				</div>
				<div class='filter-label-level-2'>
					<?php if($sonData){?>
                                            <?php if(isset($sonData) && !empty($sonData)):$_id_n=0;$_index_n=0;$lastn=min(1000,count($sonData));
$hd["list"]["n"]["first"]=true;
$hd["list"]["n"]["last"]=false;
$_total_n=ceil($lastn/1);$hd["list"]["n"]["total"]=$_total_n;
$_data_n = array_slice($sonData,0,$lastn);
if(count($_data_n)==0):echo "";
else:
foreach($_data_n as $key=>$n):
if(($_id_n)%1==0):$_id_n++;else:$_id_n++;continue;endif;
$hd["list"]["n"]["index"]=++$_index_n;
if($_index_n>=$_total_n):$hd["list"]["n"]["last"]=true;endif;?>

                                            <?php echo $n;?>
                                            <?php $hd["list"]["n"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>
                                            <?php }?>
				</div>
			</div>
			<div class='locality filter-label'>
				<div class='filter-label-level-1'>
					<span><b></b>区域：</span>
					<div class='box'>
						<?php if(is_array($localTopData)):?><?php  foreach($localTopData as $k=>$v){ ?>
							<?php echo $v;?>
						<?php }?><?php endif;?>
					</div>
				</div>
				<div class='filter-label-level-2'>
					<?php if(is_array($sonInfo)):?><?php  foreach($sonInfo as $k=>$v){ ?>
						<?php echo $v;?>
					<?php }?><?php endif;?>
				</div>
			</div>
			<?php if($priceData){?>
			<div class='price filter-label'>
				<div class='filter-label-level-1'>
					<span><b></b>价格：</span>
					<div class='box'>
						<?php if(is_array($priceData)):?><?php  foreach($priceData as $v){ ?>
							<?php echo $v;?>							
						<?php }?><?php endif;?>
					</div>
				</div>
			</div>	
			<?php }?>
			<div class='screen'>
				<div>
					<a class='active' href="<?php echo $orderUrl['d'];?>" title="默认排序">默认排序</a>
					<a href="<?php echo $orderUrl['b'];?>" title="销量从高到低">销量<b></b></a>
					<a href="<?php echo $orderUrl['p_d'];?>" title="价格从高到低">价格<b></b></a>
					<a  href="<?php echo $orderUrl['p_a'];?>" title="价格从低到高">价格<b style="background-position:-45px -16px;"></b></a>
					<a style="border:0;" href="<?php echo $orderUrl['t'];?>" title="发布时间降序">发布时间<b></b></a>
				</div>
			</div>
		</div>	
	</div>
	<!-- 商品过滤结束 -->
	<link href="http://localhost/meituan/meituan/App/Index/Tpl/Public/css/index.css" type="text/css" rel="stylesheet" >
            <script>
                var url="http://localhost/meituan/index.php/Index";
                var root="http://localhost/meituan"+"/";
            </script>
            <script>
                  var on=false;//验证用户是否登陆的变量.
          
            on=<?php if(isset($_SESSION['uid']) && isset($_SESSION['uname'])){?>
            true;
        
          <?php  }else{ ?>false<?php }?>
            </script>
        <script src="http://localhost/meituan/meituan/App/Index/Tpl/Public/js/index.js"></script>
    <input type="hidden" value="<?php echo $_GET['page'];?>" id="page"/>
	<!-- 页面主体开始 -->
        <!--下面记录index页面的访问次数-->
        <input type="hidden" value=<?php echo $_COOKIE['cookieNum']?> id="cookieNum"/>
        <input type="hidden" value=<?php echo $_COOKIE['lasttime']?> id="lasttime"/>
       <input type="hidden" value="<?php echo $freshCount;?>" id="freshCount"/>
	<div id="main">
		<div class='content' style="border:solid 1px red;" id="content">
                    <!--
                    <?php if(is_array($goods)):?><?php  foreach($goods as $v){ ?>
		<div class='item'>
                    	
				<div class='cover'>
					<a href="<?php echo U('Index/Detail/index');?>/gid/<?php echo $v['gid'];?>"><img src="<?php echo $v['goods_img'];?>"/></a>
				</div>
				<a class='link' href="<?php echo U('Index/Detail/index');?>/gid/<?php echo $v['gid'];?>">
					<h3><?php echo $v['main_title'];?></h3>
					<p class='describe'><?php echo $v['sub_title'];?></p>
				</a>
				<p class='detail'>
					<strong>¥<?php echo $v['price'];?></strong>
					<span>门店价<span>-</span><del><?php echo $v['old_price'];?></del></span>
					<a href="<?php echo U('Index/Detail/index');?>/gid/<?php echo $v['gid'];?>"></a>
				</p>
				<p class='total'>
					<strong><?php echo $v['buy'];?></strong>
					人已参与
				</p>
			</div>	
<?php }?><?php endif;?>
                    -->
		</div>
		<div class='sidebar'>
			<div class='hot-products'>
				<h3>热卖商品</h3>
				<ul>
                                    <?php if(is_array($hotGoods)):?><?php  foreach($hotGoods as $k=>$v){ ?>
					<li>
						<h6><span><?php echo $k;?></span><a href=""><?php echo $v['main_title'];?></a></h6>
						<a href=""><img src="<?php echo $v['goods_img'];?>"/></a>
						<div class='info'>
							<em>¥<?php echo $v['price'];?></em>
							<p>每天<span><?php echo $v['buy'];?></span>人已购</p>
						</div>
					</li>
                                        <?php }?><?php endif;?>
				</ul>
			</div>
		</div>
	</div>
        
	<div class='c page'>
            <?php echo $page;?>
        </div>
         <div id="loader"></div>
	<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?>
	<div id="footer">
		<p>本demo不用于任何商业目的，仅供学习与交流</p>
	</div>
	</body>
</html>
</body>
</html>