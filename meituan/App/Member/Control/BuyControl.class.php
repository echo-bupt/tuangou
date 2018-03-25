<?php
class BuyControl extends Control{
	
	/**
	 * 订单提交页
	 */
     public function setNav()
      {
          //导航的信息就是pid为零的顶级元素.
          $nav=M("category")->field("cname,cid")->where(array("pid"=>0))->all();
           $this->assign("nav",$nav);
      }
	public function index(){
            $this->setNav();
                $id=$_GET['gid'];
                $goodsInfo=M("goods")->where(array("gid"=>$id))->find();
                $pathInfo = pathinfo($goodsInfo['goods_img']);
                $goodsInfo['goods_img'] = __ROOT__.'/'.$pathInfo['dirname'].'/'.$pathInfo["filename"].'_92x54.'.$pathInfo['extension'];
               $this->assign("goodsInfo",$goodsInfo);
		$this->display();
	}
	/**
	 * 付款页 
	 */
	public function payment(){
		$this->display();
	}
	/**
	 * 购买成功
	 */
	public function buysuccess(){
		$this->display();
	}
}













?>