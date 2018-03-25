<?php
/*由于点击一个超链接的时候，他会重新把控制器以及里面的方法重新渲染一次。那么每一次的__URL__都是当前的url地址
 *，是最新的URL地址。此处为了实现点击比如说点击地址的时候能够保存cid，那么就是通过__URL__变量，
 * 每一次点击的时候都去获取当前url地址，点击lid的时候仅仅去删除lid的参数，冷然保留cid的参数。
 * 这样处理之后就保留了URL里面的其他参数。确保lid或者是cid不会丢失。
 * 
 */


/*我们不论点击顶级分类的超链接还是点击子级分类的超链接它都必须要求数据的重新分配所以这两种情况我们都必须重新分配数据.*/
class PublicControl extends Control{
    private $lidArr=array();
    private $cidArr=array();
    //由于where条件在搜索商品条数的时候也要用，所以我们也设置他为私有属性。
    private $where="";
    private $order="";
    /****设置前台分类数据,该函数是将分配顶级分类以及给顶级分类加高亮与分配子类分类以及给子类加高亮这些数据区分对待*****/
    public function setCategory($cid)
    {
        //获取所有的顶级分类.
        //关于这个URL的问题我们可能是一开始是localhost/meituan这种形式.那么这样获得的url即使再加上cid的情况下
        //也就是localhost/meituan/cid/1这种形式，是不会存在cid这个方法的.
        if(strlen(U("index"))>strlen(__URL__))
        {
             $url=url_param_remove("cid",U("index"));
        }else{
           $url=url_param_remove("cid",__URL__); 
        }
     
        $url=url_param_remove("key",$url);
          
        if(strlen(U("index/index/index"))>strlen($url))
        {
            $url=U("index/index/index");
        }
        $topCateInfo=M("category")->field("cname,cid")->where(array("pid"=>0))->all();
      //这里我们为了避免在模板里面判断，我们在控制器里面将数据就分配好，把逻辑判断好。
        /*****以下是分配顶级分类与高亮显示****/
        /*****当参数中不含有cid的时候****/
      if(!$cid)
      {
          //我们将要分配的数据存在一个数组里.
        $topData=array();
        //在php文件中__APP__相当于一个变量我们得以变量的形式来对待他.
        $topData[]='<a href="'.$url.'" class="active">全部</a>';
        foreach($topCateInfo as $v)
        {
            $topData[]='<a href="'.$url.'/cid/'.$v["cid"].'">'.$v['cname'].'</a>';
        }
        
      }else{
          /******当cid存在的时候*****/
          /***当cid的父级是pid=0的时候,也就是是顶级元素的时候**/
          if(!$this->getParentId($cid))
          {
               $topData=array();
               $topData[]='<a href="'.$url.'">全部</a>';
            foreach($topCateInfo as $v)
        {
                if($cid==$v['cid'])
            $topData[]='<a href="'.$url.'/cid/'.$v["cid"].'" class="active">'.$v['cname'].'</a>';
               else{
            $topData[]='<a href="'.$url.'/cid/'.$v["cid"].'">'.$v['cname'].'</a>';
                }
        }
        }else{
             /***当cid的父级是pid!=0的时候,也就不是顶级元素的时候**/
               $topData=array();
               $topData[]='<a href="'.$url.'">全部</a>';
                      foreach($topCateInfo as $v)
        {
                if($this->getParentId($cid)==$v['cid']){
                      $topData[]='<a href="'.$url.'/cid/'.$v["cid"].'" class="active">'.$v['cname'].'</a>';
                }
               else{
            $topData[]='<a href="'.$url.'/cid/'.$v["cid"].'">'.$v['cname'].'</a>';
                }
           
        }
        }
         
      }
      /*****以下是分配子类分类与高亮显示****/
       /******当cid存在的时候子类信息为空*****/
      if(!$cid)
      {
          $sonData=array();   
      }else{
          /*当点击的是父类元素为顶级元素的时候我们才会把数据分配出去**/
          if(!$this->getParentId($cid))
          {
                 $sonData=array();   
              $allSonData=M("category")->field("cname,cid")->where(array("pid"=>$cid))->all();
              $sonData[]='<a href="'.$url.'" class="active">全部</a>';
              if($allSonData)
              {
                   foreach($allSonData as $v)
              {   
                   $sonData[]='<a href="'.$url.'/cid/'.$v["cid"].'">'.$v['cname'].'</a>';  
              }   
              }
          }else{
              /****当点击的是子类元素的时候****/
               $sonData=array();   
              $allSonData=M("category")->field("cname,cid")->where(array("pid"=>$this->getParentId($cid)))->all();
              if($allSonData)
              {
                   foreach($allSonData as $v)
              {
                  if($cid==$v['cid'])
                  {
                       $sonData[]='<a href="'.$url.'/cid/'.$v["cid"].'" class="active">'.$v['cname'].'</a>';
                  }else{
                       $sonData[]='<a href="'.$url.'/cid/'.$v["cid"].'">'.$v['cname'].'</a>';
                  }
              }   
              }
          }
      } 
      $this->assign("sonData", $sonData);
      $this->assign("cateInfo",$topData);
    }
    //获取当前cid的父级id.
    public function getParentId($cid)
    {
        $pid=M("category")->field("pid")->where(array("cid"=>$cid))->find();
        return $pid['pid'];
    }
    public function getLocalParentId($lid)
    {
        $pid=M("locality")->field("pid")->where(array("lid"=>$lid))->find();
        return $pid['pid'];
    }
    /****下面是设置无限极分类的地区设置,与上面的逻辑一样.****/
    public function setLocalcity($lid)
    {
          if(strlen(U("index"))>strlen(__URL__))
        {
             $url=url_param_remove("lid",U("index"));
        }else{
           $url=url_param_remove("lid",__URL__); 
        }
          $url=url_param_remove("key",$url);
          
        if(strlen(U("index/index/index"))>strlen($url))
        {
            $url=U("index/index/index");
        }
       
        $topCateInfo=M("locality")->field("lname,lid")->where(array("pid"=>0))->all();
        if(!$lid)
      {
          //我们将要分配的数据存在一个数组里.
        $topData=array();
        //在php文件中__APP__相当于一个变量我们得以变量的形式来对待他.
        $topData[]='<a href="'.$url.'" class="active">全部</a>';
        foreach($topCateInfo as $v)
        {
            $topData[]='<a href="'.$url.'/lid/'.$v["lid"].'">'.$v['lname'].'</a>';
        }
       $this->assign("localTopData",$topData);
        return ;
      }
        /***我们是先来分配父级数据，然后再去分配子类数据***/  
           if(!$this->getLocalParentId($lid))
          {
               $topData=array();
               $topData[]='<a href="'.$url.'">全部</a>';
            foreach($topCateInfo as $v)
        {
                if($lid==$v['lid']){
                     $topData[]='<a href="'.$url.'/lid/'.$v["lid"].'" class="active">'.$v['lname'].'</a>';
                }
               else{
                       $topData[]='<a href="'.$url.'/lid/'.$v["lid"].'">'.$v['lname'].'</a>';
        }
        }
        }else{
             /***当cid的父级是pid!=0的时候,也就不是顶级元素的时候**/
               $topData=array();
               $topData[]='<a href="'.$url.'">全部</a>';
                      foreach($topCateInfo as $v)
        {
                if($this->getLocalParentId($lid)==$v['lid']){
                      $topData[]='<a href="'.$url.'/lid/'.$v["lid"].'" class="active">'.$v['lname'].'</a>';
                }
               else{
            $topData[]='<a href="'.$url.'/lid/'.$v["lid"].'">'.$v['lname'].'</a>';
                }
           
        }
        }
        /****接下来是获得子类信息数据以及获得高亮显示数据****/
        /***当点击的是顶级元素的时候***/
        if(!$this->getLocalParentId($lid))
        {
            $parentLocalInfo=M("locality")->where(array("pid"=>$lid))->all();
            $sonInfo[]='<a href="'.$url.'" class="active">全部</a>';
            if($parentLocalInfo)
            {
                 foreach($parentLocalInfo as $v)
            {
                 $sonInfo[]='<a href="'.$url.'/lid/'.$v["lid"].'">'.$v['lname'].'</a>';  
            }
            }
        }else{
                /****当点击的是子类元素的时候****/
               $sonInfo=array();   
              $allSonData=M("locality")->field("lname,lid")->where(array("pid"=>$this->getLocalParentId($lid)))->all();
              if($allSonData)
              {
                   foreach($allSonData as $v)
              {
                  if($lid==$v['lid'])
                  {
                      $sonInfo[]='<a href="'.$url.'/lid/'.$v["lid"].'" class="active">'.$v['lname'].'</a>';  
                  }else{
                      $sonInfo[]='<a href="'.$url.'/lid/'.$v["lid"].'">'.$v['lname'].'</a>';  
                  }
              }   
              }
        }
       $this->assign("sonInfo",$sonInfo);
       $this->assign("localTopData",$topData);
      }
      public function setNav()
      {
          //导航的信息就是pid为零的顶级元素.
          $nav=M("category")->field("cname,cid")->where(array("pid"=>0))->all();
           $this->assign("nav",$nav);
      }
      /*
       * 设置价格的URL显示，其中这里面用到了从配置文件中读取配置文件。其中这个配置文件的写成是通过
       * 首页中pid=0的顶级元素的id来定的，不同的顶级元素的id对应于不同的配置文件。
       */
      public function setprice($cid)
      {
            if(strlen(U("index"))>strlen(__URL__))
        {
             $url=url_param_remove("price",U("index"));
        }else{
           $url=url_param_remove("price",__URL__); 
        }
         $url=url_param_remove("key",$url);
          
        if(strlen(U("index/index/index"))>strlen($url))
        {
            $url=U("index/index/index");
        }
          if(!$cid)
          {
              $key="all";
          }else{
              //当cid存在的时候也得分两种情况，一种是点击的是顶级分类与顶级分类下的分类。必须得首先获得pid.
              $pid=$this->getParentId($cid);
              $key=$pid?$this->getParentId($cid):$cid;
          }
          $confArr=C("price");
          $priceData=array();
          if(!$this->_GET("price"))//当不存在price参数的时候.
          {
              $priceData[]='<a href="'.$url.'" class="active">全部</a>';
              foreach($confArr[$key] as $v)
              {
                   $priceData[]='<a href="'.$url.'/price/'.$v[1].'">'.$v[0].'</a>';
              }
          }else{
              $priceData=array();
              $priceData[]='<a href="'.$url.'">全部</a>';
              foreach($confArr[$key] as $v)
              {
                  if($this->_GET("price")==$v[1])
                  {
                      $priceData[]='<a href="'.$url.'/price/'.$v[1].'" class="active">'.$v[0].'</a>';
                  }else{
                      $priceData[]='<a href="'.$url.'/price/'.$v[1].'">'.$v[0].'</a>';
                  }
              }
          }
          //分配到模版以便我们点击每一个选项能够对应于不同的url地址。
       $this->assign("priceData", $priceData);
      }
      public function setOrder()
      {
             if(strlen(U("index"))>strlen(__URL__))
        {
             $url=url_param_remove("order",U("index"));
        }else{
           $url=url_param_remove("order",__URL__); 
        }
          $url=url_param_remove("key",$url);
         if(strlen(U("index/index/index"))>strlen($url))
        {
            $url=U("index/index/index");
        }
        $orderUrl = array();
		//default 默认排序
		$orderUrl['d'] = $url.'/order/t-desc';
		//buy 销量降序
		$orderUrl['b'] = $url.'/order/b-desc';
		//price 价格降序
		$orderUrl['p_d'] = $url.'/order/p-desc';
		//price 价格升序
		$orderUrl['p_a'] = $url.'/order/p-asc';
		//begin_time 发表时间，降序
		$orderUrl['t'] = $url.'/order/t-desc';
                $this->assign('orderUrl', $orderUrl);
      }
      /******根据条件查询对应的数据****/
      /******目的就是为了组合成in()的条件，这个条件是in(array("goods.cid"=>array(符合要求的商品的id,也就是我们要获得)))****/
      public function getGoodsData($cid,$lid,$price,$order,$limit)
      {
          //我么将所有设置$this->lids与$this->cids这两个数组的组合全部写在这个方法里。之前前面所有的setprice之类的方法仅仅是将父类与子类信息展示并且组合了超链接的url！
          //同样要写一个setorder并且为他们加好超链接.....
          //至于order的搜索条件要在本方法中组合。对于price与order他们应该是被组合在where条件中的。以where条件的形式来进行组合。
          //这里我们给$cidArr与$lidArr赋以初值的原因是，如果我们按照if条件走，只有在满足if条件的时候才会给
          //$cidArr与$lidArr赋值,如果$cid或者$lid为空，那么就没法给$cidArr与$lidArr赋值，那么就不存在$lidArr与$cidArr在这两个变量了，就会报错。
          // $cidArr=array();
          // $lidArr=array();
          //就是组合一个数组，这个数组里面的一个字段指向某一个数组，这个被指向的数组里面放着很多个分类id
          //注意一个是关于地区的条件一个是分类的条件。
          //$lid=$this->_GET("lid","intval");
          //$cid=$this->_GET("cid","intval");
          //组合分类的数组.
          //注意还有一种是当我们把拿过来的cid作为pid的条件来进行查询的时候，可能我们点击的是不是顶级的分类id。这就意味着该id下没有子类id
          //那么以该id为pid的数组没有信息。这个时候我们为了下面的foreach语句能够正常执行，我们需要组合一下这个子类信息为空的情况的数组.
          //也就是即使为空，那么也要组合一个二维数组.
           //下面必须是$lid与$cid存在的情况下，如果不存在那么我们就让cidArr=array(); $lidArr=array();,不然默认$lid为0，查出来的数据就不对了.

           
           //组合分类的数组，以便为in条件使用。
          if($cid)
          {
           $cidAll=M("category")->where(array("pid"=>$cid))->field("cid")->all();
          if(empty($cidAll))
          {
              $cidAll=array(array("cid"=>$cid));//也必须是一个二维数组。这就解决了如果点击的不是顶级元素的情况.
          }
           $this->cidArr=array();
          $this->cidArr['goods.cid']=array();
          foreach ($cidAll as $v)
          {
              $this->cidArr['goods.cid'][]=$v['cid'];
          }   
        
          }
          if($lid)
          {
             //组合地区的数组
          $lidAll=M("locality")->where(array("pid"=>$lid))->field("lid")->all();
          if(empty($lidAll))
          {
              $lidAll=array(array("lid"=>$lid));//也必须是一个二维数组。这就解决了如果点击的不是顶级元素的情况.
          }
               
          $this->lidArr["goods.lid"]=array();
          foreach($lidAll as $v)
          {
               $this->lidArr["goods.lid"][]=$v['lid'];
          } 
         
          }
          //接下来是组合关于价格的条件.
          /*
           * 
           * 欠补充:需要添加一下在商品未下架的条件下搜索这些商品的这么一个条件。这个时候会用到and，来将两个条件组合起来。
           * 还会用到rtrim函数，来对待and后面的price.(也就是当price这个条件没有的时候，为了不影响price前面的那个条件需要将and以及后面的price条件剔除掉)
           * 
           */
          
          $where="";//有可能组合不到where条件，我们来先定义一下，以免报错.
          if($price)
          {
               $priceArr=explode("-",$price);
              if(isset($priceArr[1]))
              {
                  $where='goods.price>'.$priceArr[0].' and price<'.$priceArr[1];
              }else{
                  $where='goods.price>'.$priceArr[0];
              }
          }
          $this->where=$where;
          
         
         //接下来是组合order的条件以便为order("里面的内容")设置order里面的内容。
         
          //这里我们没有判断$order存在的情况下执行下面的程序的原因是我们在AJAX调用的时候，我们会给予一个默认的
          //order的，也就是getOrderUrl这个函数，所以$order是一定不会空的!不需要判断
         	$arr = explode('-',$order);
    	switch ($arr[0]){
    		case 'd':
    			$order = 'begin_time '.$arr[1];
    		break;
    		case 'b':
    			$order = 'buy '.$arr[1];
    		break;
    		case 'p':
    			$order = 'price '.$arr[1];
    		break;
    		case 't':
    			$order = 'begin_time '.$arr[1];
    		break;
    	}
        $this->order=$order;
       // p($this->order);
        
          //但问题是有可能$cidArr与$lisArr都有可能存在为空的情况，对于in条件而言，in里面的数组有一个为空，那么就会报错。
          //所以判断如下:
           //$goodsInfo=M("goods")->in($cidArr)->in($lidArr)->countv();
                 //p($goodsInfo);
       /*
        * 上面是设置$cidArr，$lidArr与where条件主要是为了下面的in与where进行商品的检索。
        * 
        * 下面是根据设置的$cidArr与$lidArr以及根据price的where条件进行商品的检索。
        * 
        */  
         
         //下面是商品检索(根据条件!)
         
          if(!empty($this->cidArr) && !empty($this->lidArr))
          {
               $goodsInfo=M("goods")->where($where)->in($this->cidArr)->in($this->lidArr)->where($this->where)->limit($limit)->order($this->order)->all();
          }else{
              if(!empty($this->cidArr))
              {
                 $goodsInfo=M("goods")->where($where)->in($this->cidArr)->where($this->where)->limit($limit)->order($this->order)->all();
              }
              if(!empty($this->lidArr))
              {
                 $goodsInfo=M("goods")->where($where)->in($this->lidArr)->where($this->where)->limit($limit)->order($this->order)->all();
              }
          }
          if(empty($this->cidArr) && empty($this->lidArr))
          {
              $goodsInfo=M("goods")->where($this->where)->limit($limit)->order($this->order)->all();
          }
       
  return $goodsInfo;
       
      }
      public function getGoodsTotal()
      {
          //由于这里的函数我们需要用到分页，需要获得商品总数来进行分页处理，那么我们需要用到上面对$lidArr与cidArr
          //的判断，所以我们这里避免重复，我们将$lidArr与$cidArr作为一个私有属性，以便在该方法里面也能访问这两个数组。
          if(!empty($this->cidArr) && !empty($this->lidArr))
          {
                $goodstotal=M("goods")->where($this->where)->in($this->cidArr)->in($this->lidArr)->order($this->order)->count();
          }else{
              if(!empty($this->cidArr))
              {
                $goodstotal=M("goods")->where($this->where)->in($this->cidArr)->order($this->order)->count();
              }
              if(!empty($this->lidArr))
              {
               $goodstotal=M("goods")->where($this->where)->in($this->lidArr)->order($this->order)->count();
              }
          }
          if(empty($this->cidArr) && empty($this->lidArr))
          {
              $goodstotal=M("goods")->where($this->where)->order($this->order)->count();
          }
       return $goodstotal;
      }
    }
?>
