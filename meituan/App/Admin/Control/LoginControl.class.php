<?php
ob_clean();
class LoginControl extends Control{
    public function index()
{
       
    $this->display();
}
public function login()
{
    $uname=$_POST['userName'];
    $adminInfo=M("admin")->where(array("adname"=>$uname))->field("uid,password")->find();
    if($adminInfo['password']==$this->_POST("psd"))
    {
        session("adname",$uname);
        session("adid",$adminInfo['uid']);
        $this->success("登陆成功!",U("admin/index/index"));
    }else{
        $this->error("用户名或者密码错误!");
    }
}
public function quit()
{
       session_unset();
    session_destroy();
    $this->success("退出成功!",U("admin/login/index"));
}
function code()
{
    $code=new code();
    $code->show();
}
}

?>
