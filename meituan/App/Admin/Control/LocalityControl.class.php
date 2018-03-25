<?php
/*
 * 
 * 地区控制器
 * 
 */
class localityControl extends CommonControl{
    public function index()
    {
         $allLocalityData=M("locality")->all();
         if($allLocalityData)
             {
                 $localityInfo=$this->getAllLocalSonData($allLocalityData);
                 $this->assign("localityInfo",$localityInfo);
             }
        $this->display();
    }
    public function add()
    {
        if(IS_GET==true)
        {
             $allLocalityData=M("locality")->all();
             if($allLocalityData)
             {
                 $localityInfo=$this->getAllLocalSonData($allLocalityData);
                 $this->assign("localityInfo",$localityInfo);
             }
                 $this->display();
        }else{
          $lid=M("locality")->add($this->_POST());
          if($lid)
          {
              $this->success("添加成功!");
          }
        }
       
    }
    public function add_locality()
    {
        if(IS_GET==true)
        {
             $this->display();
        }else{
           if(M("locality")->add($_POST))
           {
               $this->success("添加子分类成功!");
           }
        }
       
    }
    function edit()
    {
         if(IS_GET==true)
              {
                   $cid=$this->_GET("lid","intval");
              $info=M("locality")->where(array("lid"=>$cid))->find();
              $this->assign("info",$info);
              $this->display();
              exit();
              }
          $cid=$this->_POST("lid","intval");
          M("locality")->where(array("lid"=>$cid))->save($this->_POST());
          $this->success("修改分类成功!");
    }
    function del()
          {
              $cid=$this->_GET("lid","intval");
              $data=M("locality")->all();
              $allSonData=$this->getSonId($data, $cid);
              //先删除子级分类，然后再删除父级父类，这个过程需要我们判断一下，自己分类是否存在。
              if($allSonData)
              {
                  M("locality")->in(array("lid"=>$allSonData))->del();//是可以用户in匹配一个数组的!不用非得将数组拆分成字符串的形式。  
              }
            M("locality")->where(array("lid"=>$cid))->del();
            $this->success("删除成功!");
          }
}
?>
