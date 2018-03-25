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
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=AC37be9efe7459c38f04c34a964155a2"></script>
<script type="text/javascript" src="http://localhost/meituan/meituan/App/Admin/Tpl/Public/js/goods.js"></script>
<!--下面<link href="http://localhost/meituan/hdphp/hdphp/Extend/Org/JqueryUi/css/flick/jquery-ui-1.10.3.custom.css" rel="stylesheet"><script src="http://localhost/meituan/hdphp/hdphp/Extend/Org/JqueryUi/js/jquery-ui-1.10.3.custom.js"></script>是为了载入框架中的日历插件-->
<link href="http://localhost/meituan/hdphp/hdphp/Extend/Org/JqueryUi/css/flick/jquery-ui-1.10.3.custom.css" rel="stylesheet"><script src="http://localhost/meituan/hdphp/hdphp/Extend/Org/JqueryUi/js/jquery-ui-1.10.3.custom.js"></script>
<div id="map">
	<span class='title'>编辑商品</span>
</div>
<div id="content">
	<form id="goodsForm" action="<?php echo U('Admin/Goods/edit');?>" method="post">
	<table class='table table-striped table-bordered'>
		<thead>
			<tr>
				<th width="20%">名称</th>
				<th>值</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>商铺名称</td>
				<td>
					<input type="hidden" value="<?php echo $_GET['gid'];?>" name="gid"/>
					<input type="hidden" name="shopid" value="<?php echo $goodsInfo['shopid'];?>"/>
					<?php echo $goodsInfo['shopname'];?>
				</td>
			</tr>
			<tr>
				<td>分类名称</td>
				<td>
					<select name="cid" >
						<?php if(is_array($allCategory)):?><?php  foreach($allCategory as $v){ ?>
                                                    <?php if($v['cid'] == $goodsInfo['cid']){?>
							<option value="<?php echo $v['cid'];?>" selected="selected"><?php echo $v['html'];?><?php echo $v['cname'];?></option>	
                                                        <?php  }else{ ?>
                                                        <option value="<?php echo $v['cid'];?>"><?php echo $v['html'];?><?php echo $v['cname'];?></option>
                                                        <?php }?>
						<?php }?><?php endif;?>
					</select>
				</td>
			</tr>
			<tr>
				<td>所在地区</td>
				<td>
					<select name="lid" >
						<?php if(is_array($allLocality)):?><?php  foreach($allLocality as $v){ ?>
                                                      <?php if($v['lid'] == $goodsInfo['lid']){?>
							<option value="<?php echo $v['lid'];?>" selected="selected"><?php echo $v['html'];?><?php echo $v['lname'];?></option>	
                                                        <?php  }else{ ?>
                                                        <option value="<?php echo $v['lid'];?>"><?php echo $v['html'];?><?php echo $v['lname'];?></option>
                                                        <?php }?>
						<?php }?><?php endif;?>
					</select>
				</td>
			</tr>
			<tr>
				<td>商品主标题</td>
				<td>
					<input type="text" name="main_title" value="<?php echo $goodsInfo['main_title'];?>"/>
				</td>
			</tr>
			<tr>
				<td>商品副标题</td>
				<td>
					<!--textarea这个标签是没有value属性的-->
					<textarea name="sub_title"><?php echo $goodsInfo['sub_title'];?></textarea>
				</td>
			</tr>
			<tr>
				<td>现价</td>
				<td>
					<input type="text" name="price" value="<?php echo $goodsInfo['price'];?>"/>
				</td>
			</tr>
			<tr>
				<td>原价</td>
				<td>
					<input type="text" name="old_price" value="<?php echo $goodsInfo['old_price'];?>" />
				</td>
			</tr>
			<tr>
				<td>上架时间</td>
				<td>
					<input id="begin_time" type="text" name="begin_time" value="<?php echo date('Y-m-d',$goodsInfo['begin_time']);?>"/>
				</td>
			</tr>
			<tr>
				<td>下架时间</td>
				<td>
					<input id="end_time" type="text" name="end_time"  value="<?php echo date('Y-m-d',$goodsInfo['end_time']);?>"/>
				</td>
			</tr>
			
			
			<tr>
				<td>商品展示图</td>
				<td>
					<link rel="stylesheet" type="text/css" href="http://localhost/meituan/hdphp/hdphp/Extend/Org/Uploadify/uploadify.css" />
            <script type="text/javascript" src="http://localhost/meituan/hdphp/hdphp/Extend/Org/Uploadify/jquery.uploadify.min.js"></script>
            <script type="text/javascript">
            var HDPHP_CONTROL         = "http://localhost/meituan/index.php/Admin/Goods";
            var UPLOADIFY_URL    = "http://localhost/meituan/hdphp/hdphp/Extend/Org/Uploadify/";
            var HDPHP_UPLOAD_THUMB    ="460,280,200,100,310,185,90,55";
HDPHP_UPLOAD_TOTAL = 0</script>
            <script type="text/javascript" src="http://localhost/meituan/hdphp/hdphp/Extend/Org/Uploadify/hd_uploadify.js"></script>
<script type="text/javascript">
    $(function() {
        hd_uploadify_options.removeTimeout  =0;
        hd_uploadify_options.fileSizeLimit  ="2MB";
        hd_uploadify_options.fileTypeExts   ="*.jpg;*.png;*.gif";
        hd_uploadify_options.queueID        ="hd_uploadify_goods_img_queue";
        hd_uploadify_options.showalt        =true;
        hd_uploadify_options.uploadLimit    =1;
        hd_uploadify_options.success_msg    ="正在上传...";//上传成功提示文字
        hd_uploadify_options.formData       ={image : "1", someOtherKey:1,hdsid:"if3fq5ujaickagcvt7c5lt2872",upload_dir:"",hdphp_upload_thumb:"460,280,200,100,310,185,90,55"};
        hd_uploadify_options.thumb_width          =200;
        hd_uploadify_options.thumb_height          =150;
        hd_uploadify_options.uploadsSuccessNums = 0;

        $("#hd_uploadify_goods_img").uploadify(hd_uploadify_options);
        });
</script>
<input type="file" name="up" id="hd_uploadify_goods_img"/>
<div tool="hd_uploadify_goods_img_msg uploadify_upload_msg">
</div>
<div id="hd_uploadify_goods_img_queue"></div>
<div class="hd_uploadify_goods_img_files uploadify_upload_files" input_file_id ="hd_uploadify_goods_img">
    <ul></ul>
    <div style="clear:both;"></div>
</div>
                                        <!--这里我们加一个old_img的字段，是为了与那个getData函数相对应，当我们添加商品的时候肯定在$_POST里不存在这个字段，然后在edit的POST数据里可以有
                                        这个old_img字段，说明是编辑，那我们就进行删除(另外还必须保证goods_img存在，也就是有新的图像提交上来!)-->
                                        <?php if(is_array($goodsInfo['old_img'])):?><?php  foreach($goodsInfo['old_img'] as $v){ ?>
                                        <img src="http://localhost/meituan/<?php echo $v;?>" width="200"/>
                                        <?php }?><?php endif;?>>
                                        <input type="hidden" value="<?php echo $goodsInfo['goods_img'];?>" name="old_img"/>
                                        
				</td>
			</tr>	
			<tr>
				<td>商品服务</td>
				<td>
					<?php if(is_array($goodsRule)):?><?php  foreach($goodsRule as $k=>$v){ ?>
						<label>
                                                    <?php if($goodsInfo['goods_server'][0] == $k or $goodsInfo['goods_server'][1] == $k){?>
							<input type="checkbox" name="goods_server[]" value="<?php echo $k;?>" checked="checked">
							<?php echo $v['name'];?>
                                                       <?php  }else{ ?>
                                                       <input type="checkbox" name="goods_server[]" value="<?php echo $k;?>"><?php echo $v['name'];?>
                                                       <?php }?>
						</label>
					<?php }?><?php endif;?>
				</td>
			</tr>	
			<tr>
				<td>商品细节展示</td>
				<td>
					<script type="text/javascript" charset="utf-8" src="http://localhost/meituan/hdphp/hdphp/Extend/Org/Editor/Ueditor/ueditor.config.js"></script><script type="text/javascript" charset="utf-8" src="http://localhost/meituan/hdphp/hdphp/Extend/Org/Editor/Ueditor/ueditor.all.min.js"></script><script type="text/javascript">UEDITOR_HOME_URL="http://localhost/meituan/hdphp/hdphp/Extend/Org/Editor/Ueditor/"</script><script id="hd_detail" name="detail" type="text/plain"></script>
    <script type='text/javascript'>
        var ue = UE.getEditor('hd_detail',{
        imageUrl:'http://localhost/meituan/index.php/Admin/Goods&m=ueditor_upload&water=1&uploadsize=2000000&maximagewidth=false&maximageheight=false'//处理上传脚本
        ,zIndex : 0
        ,autoClearinitialContent:false
        ,initialFrameWidth:"100%" //宽度1000
        ,initialFrameHeight:"300" //宽度1000
        ,autoHeightEnabled:false //是否自动长高,默认true
        ,autoFloatEnabled:false //是否保持toolbar的位置不动,默认true
        ,maximumWords:2000 //允许的最大字符数
        ,initialContent:'<?php echo $goodsInfo['detail'];?>' //初始化编辑器的内容 也可以通过textarea/script给值
        ,readonly : false //编辑器初始化结束后,编辑区域是否是只读的，默认是false
        ,wordCount:true //是否开启字数统计
        
    });
    </script>
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
