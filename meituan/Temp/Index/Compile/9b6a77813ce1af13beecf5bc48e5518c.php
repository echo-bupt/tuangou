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