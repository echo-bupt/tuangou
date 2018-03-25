<?php
class CommonControl extends Control{
    //验证用户是否登陆。
    
    public function __init()
    {

    }
    
    //获取所有的分类以及每一个顶级分类下所有的子级分类，并且子级分类与父级分类紧挨着，自己分类位于父级分类之后。
    public function getAllSonData($allData,$pid=0,$level=0)//默认pid是0，也就是顶级分类。我们对于子级要加条线表示。注意我们每一次是在给$level赋值，所以每次一是$level在增加，因为我们不停辅以新值。
    {
        $arr=array();
        foreach($allData as $v)
        {
            if($v['pid']==$pid)
            {
                $v['html']=str_repeat("-", $level*9);
                $arr[]=$v;
                $arr=array_merge($arr,$this->getAllSonData($allData,$v['cid'],$level+1));//这里第二次遍历的还是全部的数组，而不是$v!!!
            }
        }
        return $arr;
    }
    public function getAllLocalSonData($allData,$pid=0,$level=0)//默认pid是0，也就是顶级分类。我们对于子级要加条线表示。注意我们每一次是在给$level赋值，所以每次一是$level在增加，因为我们不停辅以新值。
    {
        $arr=array();
        foreach($allData as $v)
        {
            if($v['pid']==$pid)
            {
                $v['html']=str_repeat("-", $level*9);
                $arr[]=$v;
                $arr=array_merge($arr,$this->getAllLocalSonData($allData,$v['lid'],$level+1));//这里第二次遍历的还是全部的数组，而不是$v!!!
            }
        }
        return $arr;
    }
    //获取每一个父类下的所有子类的id。先是子级，然后是子子级
    public function getSonId($data,$pid)
    {
        $arr=array();
        foreach($data as $v)
        {
            if($v['pid']==$pid)
            {
                $arr[]=$v['cid'];
                $arr=array_merge($arr,$this->getSonId($data,$v['cid']));
            }
        }
        return $arr;
    }
  
}
?>
