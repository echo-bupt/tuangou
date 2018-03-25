<?php
class LoginControl extends CommonControl{
	/**
	 * 显示登录界面
	 */	
	public function index(){
            $this->setNav();
		$this->display();
	}
        
        public function login()
        {
            if(IS_POST)
            {
                $username=$_POST['uname'];
                $pwd=M("user")->where(array("uname"=>$username))->getField("password");
                $uid=M("user")->where(array("uname"=>$username))->getField("uid");
                if($pwd==$this->_POST("password","md5"))
                {
                    //登陆成功后我们要将数据写入SESSION里面。
                    session("uid",$uid);
                    session("uname",$username);
                    //一个浏览器只会拥有一个sessionid，也就是所有的session数据共用这一个session_id.
                    if(isset($_POST['auto']))//当用户选择7天内自动登录的时候.
                    {
                        setcookie(session_name(),session_id(),time()+3600*24,"/");
                    }
                     if(isset($_COOKIE['cookieNum']))
        {
            //修改cookie值就要重新写一遍setcookie!!
            //一个是在login控制器修改访问量的控制器，一个是在index控制器修改防止刷新的cookie！！！
            //注意这里在这里定义一个防止刷新造成的函数，当刷新的时候走这个控制器，这个时候修改cookie值！
            //但是同时要防止刷新造成网站访问数的变化，这个要通过login控制器之后我们才让网站访问数增加，而不是
            $freshCount=$_COOKIE['cookieNum'];
            setcookie("cookieNum",++$_COOKIE['cookieNum'],time()+3600*24*365,"/");
           
        }else{
             setcookie("cookieNum",0,time()+3600*24*365,"/");
            
             
        }
                   setcookie("lasttime",date("Y-m-d H:i:s"),time()+3600*24*365,"/");
                    $this->success("登陆成功!",U("index/index/index"));
                }else{
                    $this->error("用户名或者密码错误!");
                }
            }
        }
        //实现一下记住账号与自动登录，先看看源文件是否有这方面的功能的实现。
	
	//退出
        
        public function quit()
        {
             session_unset();
    session_destroy();
    $this->success("退出成功!",U("index/index/index"));
        }
	
	
}














?>