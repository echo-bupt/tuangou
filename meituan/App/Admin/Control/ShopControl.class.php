<?php
class ShopControl extends CommonControl{
    public function index()
    {
        $allShopInfo=M("shop")->all();
        $this->assign("allShopInfo",$allShopInfo);
        $this->display();
    }
    public function add()
    {
        if(IS_GET==true)
        {
            $this->display();
        }else{
            M("shop")->add($this->_POST());
            $this->success("添加商铺成功!");
        }
    }
    public function edit()
    {
        if(IS_GET==true)
        {
            $shopid=$_GET['shopid'];
            $shop=M("shop")->where(array("shopid"=>$shopid))->find();
           $this->assign("shop",$shop);
        }else{
            $shopid=$_POST['shopid'];
            M("shop")->where(array("shopid"=>$shopid))->save($_POST);
            $this->success("修改成功!");
        }
        $this->display();
    }
    function del()
    {
        $shopid=$_GET['shopid'];
        M("shop")->where(array("shopid"=>$shopid))->del();
        $this->success("删除成功!");
    }
}
?>
