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
    //接收并处理注册页面传来的数据
    public function accept_register(){
    	//获取表单中的信息
    	$code = $_POST['code'];
    	$num = $_POST['num'];
    	$data = array(
    		'u_id' => $_POST['num'], //账户
    		'u_name' => $_POST['name'],//姓名
    		'u_password' => md5($_POST['password']),//用MD5对密码进行加密
    		'u_email' => $_POST['email'],//邮箱
    		'u_place' => $_POST['place'],//交易的地址
    		'u_telphone' => $_POST['phone'],//联系电话
    	);
    	$verify = new \Think\Verify();   //判断验证的内置方法
    	if($verify->check($code, $id)){
    		$user = M('user');//连接数据库
    		$is_user=$user->where("u_id=$num")->select();//查找该用户是否存在
    		if($is_user==NULL){
    			$status = $user->add($data);//数据库操作成功返回1，失败返回false
    			return $status;    		}
    		else{
    			$this->error('该用户已存在!');
    		}
    	}
    	else{
    		$this->error('验证码错误!');
    	}
    }
    public function accept_login(){
    	//获取登录页面表单中的信息
    	$code = $_POST['code'];
    	$data = array(
    		'u_id' => $_POST['num'], //账户
    		'u_password' => md5($_POST['password']),//用MD5对密码进行加密
    	);
    	if($verify->check($code, $id)){

    	}
    	else{
    		$this->error('验证码错误!');
    	}
    }
}