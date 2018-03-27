<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
//登录
class LoginController extends Controller {
    public function login(){//显示用户登录页面
	$this->display('login');
    }
    public function register(){//显示用户注册页面
	$this->display('register');
    }
    public function forget(){//显示忘记密码页面
	$this->display('forget');
    }
    public function login_admin(){//显示管理员登录页面
	$this->display('login-admin');
    }

    public function accept_register(){
    	$username = $_POST['username'];
    	$password = $_POST['password'];
    	$phone = $_POST['phone'];
    	$email = $_POST['email'];
    }
}