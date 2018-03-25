<?php
class GoodsControl extends CommonControl{
    //显示商品,在显示商品时需要三张表的关联，建立GOODS模型。
    public function index()
    {
        //对于一:在模型中是这样写的
        //$this->view['goods_detail']=array(
			//'type'=>'inner',
			//'on'=>'goods_detail.goods_id=goods.gid'			
		//);
        $field="shopname,main_title,price,buy,lname,cname,end_time,gid";
        $db=K("GOODS");
        //view是模型一个的属性，其中这个属性是一个大数组!
        $db->view['goods_detail']=array(
            "type"=>"inner",
            'on'=>'goods_detail.goods_id=goods.gid'
        );
        //我们去增加这个view属性，但是后面你得用$db这个句柄才可以体现修改了!得有$db这个句柄!!
      $allInfo=$db->field($field)->all();
      //1，我想试一下临时增加一个关联表会怎么加?
      //2，我想参照问答系统看看那个public $table是怎么加的?
      $this->assign("goods",$allInfo);
      $this->display();
    }
    //添加商品
    public function add()
    {
        if(IS_GET==true)
        {
              $id=$this->_GET("shopid");
        $shopInfo=M("shop")->where(array("shopid"=>$id))->field("shopid,shopname")->find();
        $this->assign("shopInfo",$shopInfo);
        $allData=M("category")->all();
        if($allData)
        {
              $allCategory=$this->getAllSonData($allData);
        $this->assign("allCategory",$allCategory); 
        }
           $allLocal=M("locality")->all();
        if($allLocal)
        {
                $allLocality=$this->getAllLocalSonData($allLocal);
        $this->assign("allLocality",$allLocality);
        }
        //从配置项中读取配置数组
     $goods_server=C("goods_server");
     $this->assign("goods_server",$goods_server);
        }
      else{
            $data=$this->getData();
            //别忘了还有添加商品详情表。还有添加商品仅仅是$data里面的goods字段，详情是$data里面的goods_detail字段。
          //但是别忘了商品详情表里面有goods_id这个字段，他需要商品表在执行add方法之后，返回值就是受到改变的
            //商品的id,所以我们需要先拿到这个返回值，然后再添加详情表。
            $gid=M("goods")->add($data['goods']);
            $data['goods_detail']['goods_id']=$gid;
            if($gid)
            {
                M("goods_detail")->add($data['goods_detail']);
            }
            $this->success("添加商品成功!");
      }
    $this->display();
        
    }
    //写这个函数是为了让编辑商品时也能调用，不用再去处理提交上来的数据。
    public function getData()
    { 
        $data=array();
        //goods这个字段是为了盛放往商品表里填写的数据。
        $data['goods']['shopid']=$this->_POST("shopid","intval");
        $data['goods']['cid']=$this->_POST("cid","intval");
        $data['goods']['lid']=$this->_POST("lid","intval");
        //strip_tags该函数尝试返回给定的字符串 str 去除空字符、HTML 和 PHP 标记后的结果。
        //允许 <p> 和 <a>
        $data['goods']['main_title']=$this->_POST("main_title","strip_tags");
        $data['goods']['sub_title']=$this->_POST("sub_title","strip_tags");
        $data['goods']['price'] = $this->_POST('price','intval');
	$data['goods']['old_price'] = $this->_POST('old_price','intval');
        //strtotime — 将任何英文文本的日期时间描述解析为 Unix 时间戳
        $data['goods']['begin_time'] = $this->_POST('begin_time','strtotime');
	$data['goods']['end_time'] = $this->_POST('end_time','strtotime');
        //对于商品修改而言，只要有商品的goods_img提交上来，我们就让goods_img这个字段时新提交上来的goods_img的内容。
        //但前提是得有商品的goods_img提交上来，所以对于商品修改我们只需goods_img提交上来新的内容这个条件即可。
        //但是对于商品原图像删除，必须是goods_old也存在才可以，才证明是编辑，不然有可能是初次上传，所以它需要两个条件!
        //也就是如果原图像不在，那么必定是初次上传。而不会是删除。
        if(isset($_POST["goods_img"]))
        {
            //只要goods_img存在，我们就更新这个goods_img为最新提交上来的。只有当old_img也存在时我们去删除old_img，但这也不影响我们更新这个最新提交上来的goods_img的!
            /*

 还有一种情况就是第一次上传图片的时候没有进行上传，然后在进行修改的时候要上传新的图片，这个时候属于修改，也就是存在old_img但是old_img是空的，因为数据库没有内容，这个时候删除就会抱错，所以我们先判断!empty($_POST['old_img'])试试看....
 存在old_img字段仅仅代表是编辑提交上来的内容。

            */
            if(isset($_POST['old_img']) && !empty($_POST['old_img']))
            {
                //这个时候我们才去删除原有图像。
                $this->delOldImg($_POST['old_img']);
            }
            //只要goods_img存在，我们就更新这个goods_img为最新提交上来的。这与是否删除原图像没有关系。
            $data['goods']['goods_img']=$_POST["goods_img"][1]['path'];
          //最后可以看出，我们保存商品的地址，只是去保存path里面的地址，至于thumb我们可以直接通过加后缀的方式进行获取。 
        }
          //我们用goods_detail来存放detail里面的数据。
            $data['goods_detail']['detail']=$_POST['detail'];
            //我们将数组存入数据库的时候是要先将数组进行序列化处理。
            $data['goods_detail']['goods_server']=serialize($_POST['goods_server']);
            return $data;
        
    }
    //写一下删除原来图像的函数。
    public function delOldImg($img)
    {
        //$img="upload/2013-11-17/25811384692302.jpg";
        //对于删除图片我们要用到一个函数，其实可以不用....
        $imgInfo=pathinfo($img);
       // p(pathinfo($img));//这个函数的参数是一个url参数。
        //其实我们利用这个函数就是为了更好地获得地址，因为我们手中的地址只有这个upload/2013-11-17/25811384692302.jpg
        //要变成带有upload/2013-11-17/11071384685155_310x185.jpg有点困难，有了这个函数便可以轻松操作。
        $imgdata=array();
        $imgdata=array(
            './'.$img,
            './'.$imgInfo['dirname']."/".$imgInfo['filename']."_460x280".".".$imgInfo['extension'],
            './'.$imgInfo['dirname']."/".$imgInfo['filename']."_200x100".".".$imgInfo['extension'],
            './'.$imgInfo['dirname']."/".$imgInfo['filename']."_310x185".".".$imgInfo['extension'],
            './'.$imgInfo['dirname']."/".$imgInfo['filename']."_90x55".".".$imgInfo['extension'],
        );
       foreach($imgdata as $v)
       {
           if(!unlink($v))
           {
               $this->error("没有权限!");
           }
       }
    }
    //编辑商品
    public function edit()
    {
        if(IS_GET==true)
        {
            $gid=$_GET['gid'];
          $allData=M("category")->all();
        if($allData)
        {
              $allCategory=$this->getAllSonData($allData);
        $this->assign("allCategory",$allCategory); 
        }
           $allLocal=M("locality")->all();
        if($allLocal)
        {
                $allLocality=$this->getAllLocalSonData($allLocal);
        $this->assign("allLocality",$allLocality);
        }
          $field="shopname,main_title,sub_title,price,old_price,begin_time,goods_img,detail,goods_server,lname,cname,end_time,gid,goods.lid,goods.cid,goods.shopid";
        $db=K("GOODS");
        //view是模型一个的属性，其中这个属性是一个大数组!
        $db->view['goods_detail']=array(
            "type"=>"inner",
            'on'=>'goods_detail.goods_id=goods.gid'
        );
        $goodsInfo=$db->field($field)->where(array("gid"=>$gid))->find();
        //注意这里在展示的时候我们要对存储好的数组进行反序列化处理。
        $goodsInfo['goods_server']=  unserialize($goodsInfo['goods_server']);
        $goodsRule=C("goods_server");
       $this->assign("goodsRule",$goodsRule);
       $this->assign("goodsInfo",$goodsInfo);
        }
        else{
//这里便可以体现出getData这个函数的作用了，我们在商品添加与商品编辑的时候均会用到对提交上来的数据进行处理，那么我们用一个函数解决，包括删除原来的图像。
            $gid=$this->_POST("gid","intval");
            $data=$this->getData();
            $gid=M("GOODS")->where(array("gid"=>$gid))->save($data['goods']);
            M("goods_detail")->where(array("goods_id"=>$gid))->save($data['goods_detail']);
            $this->success("修改成功!");

                    }
       $this->display();
    }
    public function del()
    {
        $id=$_GET['gid'];
       //删除的时候我们需要删除详情表中关于该商品的信息，还要删除商品表，最后要删除上传上来的图片。
        //得到图片地址:
        $imgSrc=M("goods")->where(array("gid"=>$id))->getField("goods_img");
       
        if($imgSrc)
        {
         $imgInfo=pathinfo($imgSrc);
       // p(pathinfo($img));//这个函数的参数是一个url参数。
        //其实我们利用这个函数就是为了更好地获得地址，因为我们手中的地址只有这个upload/2013-11-17/25811384692302.jpg
        //要变成带有upload/2013-11-17/11071384685155_310x185.jpg有点困难，有了这个函数便可以轻松操作。
        $imgdata=array();
        $imgdata=array(
            './'.$imgSrc,
            './'.$imgInfo['dirname']."/".$imgInfo['filename']."_460x280".".".$imgInfo['extension'],
            './'.$imgInfo['dirname']."/".$imgInfo['filename']."_200x100".".".$imgInfo['extension'],
            './'.$imgInfo['dirname']."/".$imgInfo['filename']."_310x185".".".$imgInfo['extension'],
            './'.$imgInfo['dirname']."/".$imgInfo['filename']."_90x55".".".$imgInfo['extension'],
        );
       foreach($imgdata as $v)
       {
           if(!unlink($v))
           {
               $this->error("没有权限!");
           }
       }
        } 
        
        //写一下当删除的时候必须是先删除详情表，在删除商品表才可以!
        M("goods_detail")->where(array("goods_id"=>$id))->del();
        M("goods")->where(array("gid"=>$id))->del();
       
        $this->success("删除成功!");
        
    }
}
?>
