<?php
class CommonControl extends Control{
     public function setNav()
      {
          //导航的信息就是pid为零的顶级元素.
          $nav=M("category")->field("cname,cid")->where(array("pid"=>0))->all();
           $this->assign("nav",$nav);
      }
}
?>
