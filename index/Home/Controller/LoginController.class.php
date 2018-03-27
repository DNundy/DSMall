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
    	$username = $_POST['username'];//获取表单的信息
    	$password = $_POST['password'];
    	$phone = $_POST['phone'];
    	$email = $_POST['email'];
    	$code = $_POST['code'];

    	$verify = new \Think\Verify();   //判断验证的内置方法
    	if($verify->check($code, $id)){
    		$user = M('user');//连接数据库
    		$is_user=$user->where("u_id=$username")->select();//查找该用户是否存在
    		echo $is_user;
    	}
    }
}