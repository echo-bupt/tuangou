<?php
class KeyControl extends PublicControl{
    function index()
    {
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
       $keywords=$_POST['keywords'];
       $goods=M("goods")->where("sub_title like '%$keywords%'")->all();
       //对搜索到的进行高亮处理。
       if($goods)
         {
              foreach($goods as $k=>$v)
         {
             $goods[$k]['main_title']=preg_replace("/{$keywords}/","<strong style='color:#cc0000'>{$keywords}</strong>", $v['main_title']);
              $goods[$k]['sub_title']=preg_replace("/{$keywords}/","<strong style='color:#cc0000'>{$keywords}</strong>", $v['sub_title']);
              $goods[$k]['sub_title'] = mb_substr($v['sub_title'],0,30,'utf8');
         }
         $num=count($goods);
         foreach($goods as $k=>$v)
         {
            $pathInfo= pathinfo($v['goods_img']);
    	 $goods[$k]['goods_img'] = __ROOT__.'/'.$pathInfo['dirname'].'/'.$pathInfo["filename"].'_310x190.'.$pathInfo['extension']; 
         }
        
    }else{
        $num=0;
    }
    $this->assign("keywords",$keywords);
       $this->assign("num", $num);
      $this->assign("goods", $goods);
      $this->display();
}
//热门与用户还看过的商品。
}
?>
