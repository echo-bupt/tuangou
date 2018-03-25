<?php
   class DetailControl extends PublicControl{
       private $gid;//便于我们其他方法使用这个变量。
       //每一次走detail控制器，都要执行这个压入COOKIE 数据的方法来丰富我们的数组内容的方法。
     
        public function index(){
                $this->setNav();
                $id=$_GET['gid'];
                $this->gid=$id;
                $this->setRecentViewCookie();
                //$this->setNav();
            $detailInfo=K("GOODS")->where(array("gid"=>$id))->find();
           // p($detailInfo);
            $this->getRelitiveData($detailInfo);
            $detailInfo=$this->processDetail($detailInfo);
           // p($detailInfo);
            //exit();
            $this->assign("detailInfo",$detailInfo);
            $this->display();            
        }
        //下面这个函数是用来对商品详情的数据进行处理，有折扣，img等的数据都需要进行处理。
        public function processDetail($detailInfo)
        {
            //这个函数牵扯到很多php函数，可以用来好好学习一下。
            //折扣:
            $detailInfo['zhekou']=round($detailInfo['price']/$detailInfo['old_price']*10,1);
            //商品图像处理:
            //原函数是用foreach进行循环，对多组数据进行处理，但是我们详情页仅仅是查出一件商品，那么我们操作的对象
            //就只有一个，那么我们是不用foreach进行处理的。
         $pathInfo = pathinfo($detailInfo['goods_img']);
          $detailInfo['yuan_img']=$detailInfo['goods_img'];
    	 $detailInfo['goods_img'] = __ROOT__.'/'.$pathInfo['dirname'].'/'.$pathInfo["filename"].'_460x280.'.$pathInfo['extension'];
            
         //关于剩余几天的处理。
         //两个时间戳相减得到的是秒数。
        if($detailInfo['end_time']-$detailInfo['begin_time']>(pow(60,2)*24*3))
        {
            $detailInfo['time']="剩余<span>3</span>天以上";
        }else{
            $day=intval(($detailInfo['end_time']-$detailInfo['begin_time'])/pow(60,2)*24);
            $hour=($detailInfo['end_time']-$detailInfo['begin_time']-pow(60,2)*24*($day))/pow(60,2);
             $detailInfo['time']="剩余<span>$day</span>天$hour小时";
             
        }
        //由于goods_server里面存放的是数组，我们进行序列化在储存，现在反序列化取出来。
        $detailInfo['goods_server']=unserialize($detailInfo['goods_server']);
        //还有就是读取配置文件配置服务的问题。目的是为了读取配置文件中对应的配置项，然后将配置项分配到模版。
        $detailInfo['goods_rule']=array();
        $rule=C("goods_server");
        $detailInfo['goods_server']=array_slice( $detailInfo['goods_server'],0,2);
        //测试一下array_slice
        //注意我们这里只用两个服务，所以从配置项中取两个，提前用ary_slice处理。
           foreach( $detailInfo['goods_server'] as $v)
        {
            $detailInfo['goods_rule'][]=$rule[$v];
        }
       
       
            return $detailInfo;
        }
        public function setRecentViewCookie()
        {
            //因为我们写入cookie的数据必须是一个字符串的形式，所以我们必须要将$_COOKIE中的数组进行序列化字符串处理。
            //我们对要出储存我们浏览记录的cookie的键名进行加密处理。
            //以序列化形式存储数组。
            $key=encrypt("recent-view");
            //注意这里用了一个巧妙而必须采用的方法，如果是我们每一次走detail控制器的时候去创建一个
            //空数组，那么每一次这个数组都是空的，只会存入一个数据，就是当前gid。如何用一个恒定的数组，实现往数组里面不停地
            //存入数据呢。不断往数组里面压值呢，用$_COOKIE,这其实与购物车中的$_SESSION['buy']是一样的！
            //我们先判断。如果有$_COOKIE直接往里面存值，如果没有就创建一个空数组同时将这个空数组写入cookie。
            $value=isset($_COOKIE[$key])?unserialize($_COOKIE[$key]):array();//这个变量是我们要向$_cookie里面写内容的。另外我们在cookie里面存储的数组信息是经过加密和序列化处理的，如果$_cookie里面的数组存在，
            //那我们得首先就这个数组进行反序列化与反解密处理得出值，才能往里面压入值
            //到时候写入cookie的时候我们再对$value进行序列化与加密处理。
           // p(unserialize(decrypt($_COOKIE)));
           // p(unserialize(decrypt($_COOKIE[$key])));
           // exit();
             //p(unserialize($_COOKIE[$key]));
            if(!in_array($this->gid, $value))//为了避免重复，，为了避免多个相同gid的重复。
            {
                 array_unshift($value, $this->gid);
            }
            setcookie($key,serialize($value),time()+3600*24,"/");
           
        }
        public function getRelitiveData($detaiInfo)
        {
            $cid=$detaiInfo['cid'];
            $gid=$detaiInfo['gid'];
          
           $relitiveData=M("goods")->in(array("cid"=>$cid))->order("buy desc")->limit(5)->all();
          
            foreach($relitiveData as $k=>$v)
         {
          $pathInfo= pathinfo($v['goods_img']);
    	 $relitiveData[$k]['goods_img'] = __ROOT__.'/'.$pathInfo['dirname'].'/'.$pathInfo["filename"].'_200x100.'.$pathInfo['extension']; 
         }
           $this->assign("relitiveData",$relitiveData);
         
        }
   }
?>