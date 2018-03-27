<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
//登录
class LoginController extends Controller {
    public function login(){
	$this->display('login');
    }
    public function register(){
	$this->display('register');
    }

}