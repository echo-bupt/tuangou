<?php
class RegControl extends CommonControl{
	/**
	 * 显示注册界面
	 */
	public function index(){
             $this->setNav();
		$this->display();
	}
        
        public function code()
        {
            $code=new code();
            $code->show();
        }
        //AJAX验证邮箱与用户名是否已经存在。
        public function check()
        {
            if(IS_AJAX)
            {
                if(isset($_POST['email']))
                {
                   $email=$_POST['email'];
                   $uid=M("user")->where(array("email"=>$email))->getField("uid");
                   if($uid)
                   {
                       echo json_encode(array("status"=>false,"msg"=>"该邮箱已经被使用!"));
                   }else{
                       echo json_encode(array("status"=>true));
                   }
                }else if(isset($_POST['username'])){
                  $uid=M("user")->where(array("uname"=>$_POST['username']))->getField("uid");
                  if($uid)
                  {
                       echo json_encode(array("status"=>false,"msg"=>"该用户名已经存在!"));
                  }else{
                       echo json_encode(array("status"=>true));
                  }
                }else{
                    $code=$this->_POST("code","strtoupper");
                   if($code!=$_SESSION['code'])
                   {
                        echo json_encode(array("status"=>false,"msg"=>"验证码不正确!"));
                   }else{
                       echo json_encode(array("status"=>true));
                  }
                }
            }
        }
        public function reg()
        {
           $data=array();
           $data["email"]=$_POST['email'];
           $data['uname']=$_POST['username'];
           $data['password']=$this->_POST("password","md5");
          $uid=M("user")->add($data);
          if($uid)
          {
              $this->success("注册成功!");
          }
        }
	
	
	
	
	
	
	
	
}















?>