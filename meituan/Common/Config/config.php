<?php
if (!defined("HDPHP_PATH"))exit('No direct script access allowed');
//更多配置请查看hdphp/Config/config.php
return array(
		/**************** url配置 ********************/
		"PATHINFO_HTML"    => "",     //伪静态扩展名
                "NAME"=>1,
                /******************价格配置****************/
                "price"=>array(
                    "all"=>array(
    //注意这里是二维数组.每一个小数组里面盛放着价格区间与说明。
                       array('50元以下','0-50'),
		       array('100元到200','100-200'),
		       array('200元到500','200-500'),
		       array('500元以上','500'),
                    ),
                    //这是对应于美食的价格区间.
                    "1"=>array(
                        array('50元以下','0-50'),
			array('50元到100','50-100'),
			array('100元到200','100-200'),
			array('200元以上','200'),
                    ),
                    //这是针对于休闲娱乐的价格区间.
                    "6"=>array(
                        array('50元以下','0-50'),
			array('50元到100','50-100'),
			array('100元到200','100-200'),
			array('200元以上','200'),
                    ),
                    //这是针对于电影的价格区间
                     "7"=>array(
                        array('50元以下','0-50'),
			array('50元到100','50-100'),
			array('100元到200','100-200'),
			array('200元以上','200'),
                    ),
                    //这是针对于丽人的价格区间
                    "8"=>array(
                        array('50元以下','0-50'),
			array('50元到100','50-100'),
			array('100元到200','100-200'),
			array('200元以上','200'), 
                    ),
                     //这是针对于酒店的价格区间
                    "9"=>array(
                        array('50元以下','0-50'),
			array('50元到100','50-100'),
			array('100元到200','100-200'),
			array('200元以上','200'), 
                    ),
                ),
                     /******商品服务的配置项******/
    /*****************注意这是关于商品服务的配置项，img是用来盛放背景图的!其中一个服务对应于一个背景图***/
                    'goods_server'=>array(
				1=>array( 
					'name'=>'假一赔十',
                                    //懂了，注意一下这里配置文件读取特点。
					'img'=>'<span class="ico" style="background-position:0px -92px;"></span>'
				),
				2=>array(
					'name'=>'支持随时退款',
					'img'=>'<span class="ico" style="background-position:0px 0px;"></span>'	
				),
				3=>array(
					'name'=>'7天无理由退换货',
					'img'=>'<span class="ico" style="background-position:0px -62px;"></span>'	
				),
				4=>array(
						'name'=>'不支持随时退款',
						'img'=>'<span class="ico" style="background-position:0px -121px;"></span>'
				),
				5=>array(
						'name'=>'不支持7天退换货',
						'img'=>'<span class="ico" style="background-position:0px -182px;"></span>'
				)
		),
        /********************************指定文件上传后的保存路径********************************/
    //根目录下upload文件夹下的一时间命名的文件夹。Y-m-d!
    "UPLOAD_PATH"                   => ROOT_PATH . "/upload/".date('Y-m-d',time()), //上传路径
    
      /********************************验证码********************************/
    "CODE_FONT"                     => HDPHP_PATH . "Data/Font/font.ttf",       //字体
    "CODE_STR"                      => "123456789abcdefghijklmnpqrstuvwsyz", //验证码种子
    "CODE_WIDTH"                    => 100,         //宽度
    "CODE_HEIGHT"                   => 30,          //高度
    "CODE_BG_COLOR"                 => "#ffffff",   //背景颜色
    "CODE_LEN"                      => 4,           //文字数量
    "CODE_FONT_SIZE"                => 22,          //字体大小
    "CODE_FONT_COLOR"               => "",          //字体颜色
);
?>