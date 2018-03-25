<?php
class CategoryControl extends CommonControl{
	
	
	
	/**
	 * 添加分类的方法
	 */
	public function add(){
		if(IS_GET === true){
                       $allData=M("category")->all();
                       if($allData)
                       {
                             $cateInfo=$this->getAllSonData($allData);
                  //  p($cateInfo);
                    //exit();
                    $this->assign("cateInfo",$cateInfo);
                       }
                  
			$this->display();
                        exit;
		}
           M("category")->add($this->_POST());
           $this->success("添加成功!");
        }
          function index()
          {
              $allData=M("category")->all();
              if($allData)
              {
                     $allInfo=$this->getAllSonData($allData);
            $this->assign("allInfo",$allInfo);
              }
              $this->display();
          }
          function add_cate()
          {
              if(IS_GET==true)
              {
                   $this->display();
                   exit();
              }
            M("category")->add($this->_POST());
            $this->success("添加子类成功!");
             
          }
          function edit()
          {
              if(IS_GET==true)
              {
                   $cid=$this->_GET("cid","intval");
              $info=M("category")->where(array("cid"=>$cid))->find();
              $this->assign("info",$info);
              $this->display();
              exit();
              }
          $cid=$this->_POST("cid","intval");
          M("category")->where(array("cid"=>$cid))->save($this->_POST());
          $this->success("修改分类成功!");
             
          }
          
          function del()
          {
              $cid=$this->_GET("cid","intval");
              $data=M("category")->all();
              $allSonData=$this->getSonId($data, $cid);
              if($allSonData)
              {
                  M("category")->in(array("cid"=>$allSonData))->del();//是可以用户in匹配一个数组的!不用非得将数组拆分成字符串的形式。  
              }
            M("category")->where(array("cid"=>$cid))->del();
            $this->success("删除成功!");
          }
	}
        ?>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        