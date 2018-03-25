<?php
/**
 * 用户账户管理控制器
 * @author zhengyin
 */
class AccountControl extends Control{

	/**
	 * 显示账户余额
	 */
	public function index(){
		$this->display();	
	}
	/**
	 * 用户成长信息
	 */
	public function growth(){
		$this->display();
	}
	/**
	 * 用户账户设置
	 */
	public function setting(){
		$this->display();
	}
	/**
	 * 设置收货地址
	 */
	public function setAddress(){
		$this->display();
	}
}
?>