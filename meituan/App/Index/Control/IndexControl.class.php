<?php
/**
 *	首页控制器 
 */
class IndexControl extends PublicControl{
    function index(){
        //这个$_COOKIE['freshCount']是用来记录
        if(isset($_COOKIE['freshCount']))
        {
            //修改cookie值就要重新写一遍setcookie!!
            //一个是在login控制器修改访问量的控制器，一个是在index控制器修改防止刷新的cookie！！！
            //注意这里在这里定义一个防止刷新造成的函数，当刷新的时候走这个控制器，这个时候修改cookie值！
            //但是同时要防止刷新造成网站访问数的变化，这个要通过login控制器之后我们才让网站访问数增加，而不是
            $freshCount=$_COOKIE['freshCount'];
            setcookie("freshCount",++$_COOKIE['freshCount'],0,"/");
            $this->assign("freshCount",++$freshCount);
        }else{
             setcookie("freshCount",0,0,"/");
              $this->assign("freshCount",0);
        }
        $this->ajaxGetCookie();
        $this->showHotGoods();
        $cid=$this->_GET("cid","intval");
        $lid=$this->_GET("lid","intval");
        $price=$this->_GET("price");
        $order=$this->_GET("order");
   //以上四项是从我们设置好的地址中获得某一个参数的信息，以便用于组织$cidArr与lidArr以及AJAX来使用。
        //作为实验，我们为了做一次实验，我们对order参数为空的情况进行讨论，事实上这个在ajax请求里面是已经做了处理的了。
        if(!$order)
        {
            $order="t-desc";//给一个默认排序
        }
        $this->setLocalcity($lid);
        $this->setCategory($cid);
        $this->setNav();
        $this->setprice($cid);
        $this->setOrder();
     //以上五个函数是从public控制器里面调用来实现对url的设置。
       // $allGoods=$this->getGoodsData($cid,$lid,$price,$order);
        //$goodsTotal=count($allGoods);//这是商品的总数。
        //echo $this->getGoodsTotal();
       // exit();
        $total = $this->getGoodsTotal();
     // echo $total;
    	$page = new Page($total,30,4,2);
        $this->assign("page", $page->show());
    	$this->display();
    }
       private function getSomeNumStr($allStr,$nowStr)
    {
       if(!strpos($allStr,$nowStr))
        {
            $newsrc="";
            return $newsrc;
        }
           $num=strpos($allStr,$nowStr);
           $newsrc=mb_substr($allStr,$num+4,2);//substr是获得cid之后所有的字符串，我们用mb_str
           return $newsrc;
    }
    private function getPriceUrl($allStr,$nowStr)
    {
       $url = url_param_remove('cid',$allStr);
        $url = url_param_remove('lid',$url);
        $url = url_param_remove('order',$url);
            $url = url_param_remove('page',$url);
         if(!strpos($allStr,$nowStr))
        {
            $newsrc="";
            return $newsrc;
        }
           $num=strpos($url,$nowStr);
           $newsrc=mb_substr($url,$num+6,7);//substr是获得cid之后所有的字符串，我们用mb_str
           return $newsrc;
    }
      private function getOrderUrl($allStr,$nowStr)
    {
          //注意这里一定要进行处理，不然如果order参数不是排在最后是无法实现获得order参数的目的的。
        $url = url_param_remove('cid',$allStr);
        $url = url_param_remove('lid',$url);
         $url = url_param_remove('price',$url);
            $url = url_param_remove('page',$url);
         if(!strpos($allStr,$nowStr))
        {
            $newsrc="t-desc";
            return $newsrc;
        }
           $num=strpos($url,$nowStr);
           $newsrc=mb_substr($url,$num+6,6);//substr是获得cid之后所有的字符串，我们用mb_str
           return $newsrc;
    }
   public function array_remove_empty($arr, $trim = true){
    foreach ($arr as $key => $value) {
        if (is_array($value)) {
            array_remove_empty($arr[$key]);
        } else {
        $value = trim($value);
            if ($value == '') {
                unset($arr[$key]);
            } elseif ($trim) {
                $arr[$key] = $value;
            }
        }
    }
}
    function ajaxDataGet()
    {
         C("DEBUG",0);
                //明天写一下AJAX请求数据.
        //但是注意的是AJAX要获取的数据是经过条件处理才能从数据库获得。但是这个过程是不走index\控制器的auto方法的，所以必须是重新组合where条件.
     if(strlen(U('Index/Index/index'))>strlen($_POST['url'])){
			$this->url = U('Index/Index/index');
		}else{
			$this->url = $_POST['url'];
		}
		$cid = $this->getSomeNumStr($this->url,"cid");
		$lid =  $this->getSomeNumStr($this->url,"lid");
                $price=$this->getPriceUrl($this->url,"price");
                $order=$this->getOrderUrl($this->url,"order");
               // p($this->price);
                //p($this->url);
               // p($this->cid);
              // p($this->lid);
                
		//$this->price = $this->getPriceUrl($this->url,"price");
               // p($this->price);
		//$this->order=$this->getOrderUrl($this->url,"order");
		//$this->setSearchWhere();
                //$this->setOrder();//理论上这个setOrder也应该写在setWhere函数里面，setorderUrl
                //用来设置GOODSmodel里面的order属性。另一个setOrderUrl就是为了设置带有order的url地址。
                // p($this->db->order);这是获得GOODSmodel里面的order属性。
       $num= $_GET['num'];
       //我们定义每一次执行AJAX函数的时候去获得4条数据。
       //这个长度需要和我们index.js里面的num自增所加的数目相同。
       $length=6;
      $total = $this->getGoodsTotal();
     // echo $total;
    	$page = new Page($total,30,4,2);
        //这是我们获得当前页的所有数据，下面才是把当前页的这些所有数据给分配给每一次ajax请求的数据.
        $nowPageData=$this->getGoodsData($cid,$lid,$price,$order,$page->limit()); 
        //p($page->limit());
        $nowPageData = $this->disGoods($nowPageData);
       // p($nowPageData);
        $ajaxData=array();
    	//$data = $this->db->getGoods($page->limit()); 
       //$limit=array(
         //  "limit"=>$num.",".$length
       //);
        for($i=$num;$i<$num+$length;$i++)
        {
            //这里我们是为了防止报错，而采取的措施。
            if(!isset($nowPageData[$i]))
            {
                $nowPageData[$i]=array();
            }
            $ajaxData[]=$nowPageData[$i];
        }
//p($ajaxData);
//清除数组中空元素.
$ajaxData=array_filter($ajaxData);
//p($ajaxData);
//exit();
//p($ajaxData);
//exit();
 echo json_encode($ajaxData);
    }
   
    
    /**
     * 处理查询结果
     */
    private function disGoods($data){
    	if(!is_array($data)) return;
    	foreach ($data as $k=>$v){
    		$pathInfo = pathinfo($v['goods_img']);
    		$data[$k]['goods_img'] = __ROOT__.'/'.$pathInfo['dirname'].'/'.$pathInfo["filename"].'_310x190.'.$pathInfo['extension'];
    		$data[$k]['sub_title'] = mb_substr($v['sub_title'],0,30,'utf8');
    	}
    	return $data;
    }
   
    public function ajaxGetCookie()
    {
        if(IS_AJAX)
        {
           $key=encrypt("recent-view");
        if(isset($_COOKIE[$key]))
        {
           $gids=unserialize($_COOKIE[$key]);
        
            $Info=M("goods")->in(array("gid"=>$gids))->all();
         foreach($Info as $k=>$v)
         {
          $pathInfo=pathinfo($v['goods_img']); 
           $Info[$k]['goods_img'] = __ROOT__.'/'.$pathInfo['dirname'].'/'.$pathInfo["filename"].'_92x54.'.$pathInfo['extension'];
         }
         echo json_encode($Info);
        }  
        }
       
       
       
    	
            
    }
    public function clearCookie()
    {
         $key=encrypt("recent-view");
         $value=isset($_COOKIE[$key])?unserialize($_COOKIE[$key]):array();
        setcookie($key,serialize($value),time()-1,"/");
    }
    //显示热销商品.
    public function showHotGoods()
    {
        $hotGoods=M("goods")->order("buy desc")->limit(6)->all();
          foreach($hotGoods as $k=>$v)
         {
              $data[$k+1]=$v;
            $pathInfo= pathinfo($v['goods_img']);
    	  $data[$k+1]['goods_img'] = __ROOT__.'/'.$pathInfo['dirname'].'/'.$pathInfo["filename"].'_92x54.'.$pathInfo['extension']; 
         }
       $this->assign("hotGoods",$data);
    }
        
}
?>