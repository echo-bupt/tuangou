<?php
class CartControl extends Control{
    /****设置导航****/
      public function setNav()
      {
          //导航的信息就是pid为零的顶级元素.
          $nav=M("category")->field("cname,cid")->where(array("pid"=>0))->all();
           $this->assign("nav",$nav);
      }
	/**
	 * 显示购物车页
	 */
	public function index(){
        $this->setNav();
            //我们如何实验ajax是否在点击减号，加号的时候修改ajax正确，可以通过这个地方，刷新的时候要重新走这个
            //控制器，这个时候重新计算总计。
            $data=array();
            if(isset($_SESSION['buy']))
            {
                 $sessionData=$_SESSION['buy'];
                 
           //处理一下那个图片地址，我们这里是想获得到92x54的图片。
                 foreach($sessionData as $k=>$v)
                 {
                     $data[]=$v['price']*$v['num'];
                      $pathInfo = pathinfo($v['goods_img']);
    	 $sessionData[$k]['goods_img'] = __ROOT__.'/'.$pathInfo['dirname'].'/'.$pathInfo["filename"].'_92x54.'.$pathInfo['extension'];
                 }
         $totalMoney=array_sum($data);
         $this->assign("totalMoney",$totalMoney);
         $this->assign("sessionData",$sessionData);
          
            }
          
		$this->display();
	}
        public  function ajaxGetGoods()
        {
            $str="";
           $goodsInfo=$this->getDataAndSetCart();
           //计算购物车中所有商品的总价格。
           foreach($goodsInfo as $v)
           {
               $data[]=$v['price']*$v['num'];
           }
           $totalMoney=array_sum($data);
            echo "<a href='' id='guanbi'></a>";
             echo "<p>加入购物车成功!</p>";
             echo "<table border='0' class='goods'>
            <tr><th style='width:200px'>商品名</th><th style='width:100px'>单价</th><th style='width:100px'>数量</th><th style='width:100px;'>小计</th></tr>";
            
             if($goodsInfo)
             {
                 foreach($goodsInfo as $k=>$v)
            {
                //注意是这种".{变量}."的形式！
                $str.= "<tr><td>".$v['goods_name']."</td>
                <td>".$v['price']."</td>
                  <td>".$v['num']."</td>
                 <td>".$v['price']*$v['num']."元</td>
                        </tr>";
               
            } 
            echo $str;
             echo "<tr><td id='gou'><a href='".__ROOT__."' id='jixu'></a></td>
            <td><a href='".__APP__."/buy/index' id='jiezhang'></a></td>
              <td style='width:200px;'>总计:<span><strong style='color:#cc0000;'>".$totalMoney."</strong>元</span></td>
                </tr>";
                 
             }else{
                 echo "<td colspan='4'>购物车内暂无商品</td>";
             }
              echo "</table>";
        }
        //下面是得到数据并且将数据写入购物车，本网站数据的id都不一样，所以下面函数不需要很复杂的判断。
        public function getDataAndSetCart()
        {
            /*我们定义$_SESSION['buy']来盛放购物车信息。
             * 这个数组里面存放着购物车的数据信息。
             * 我们定义这个数组里面一个gid对应于一个数组。
             * 一个gid指向一个数组。
             * 每一个数组里面有一个num字段，用来盛放数量
             */
           if(!isset($_SESSION['buy']))
           {
               $_SESSION['buy']=array();
           }
            if(isset($_POST) && !empty($_POST))
            {
                if(array_key_exists($_POST['gid'], $_SESSION['buy']))
                {
                    ++$_SESSION['buy'][$_POST['gid']]['num'];
                }else{
                    foreach($_POST as $k=>$v)//我们这里还会用一下$_POST的键名。
                    {
                        $_SESSION['buy'][$_POST['gid']][$k]=$v;
                        $_SESSION['buy'][$_POST['gid']]['num']=1;
                    }
                }
            }
           return $_SESSION['buy'];
        }
        public function ajax_add()
        {
            $gid=$this->_POST("gid","intval");
            $_SESSION['buy'][$gid]['num']++;
            P($_SESSION);
        }
         public function ajax_reduce()
        {
            $gid=$this->_POST("gid","intval");
            $_SESSION['buy'][$gid]['num']--;
             
        }
        public function  del()
        {
            $gid=$this->_POST("gid","intval");
            unset($_SESSION['buy'][$gid]);
        }
        public function ajaxData()
        {
             if(isset($_SESSION['buy']))
            {
                 $sessionData=$_SESSION['buy'];
                 
           //处理一下那个图片地址，我们这里是想获得到92x54的图片。
                 foreach($sessionData as $k=>$v)
                 {
                   
                      $pathInfo = pathinfo($v['goods_img']);
    	 $sessionData[$k]['goods_img'] = __ROOT__.'/'.$pathInfo['dirname'].'/'.$pathInfo["filename"].'_92x54.'.$pathInfo['extension'];
                 }
                 echo json_encode($sessionData);
        }
}

}
?>