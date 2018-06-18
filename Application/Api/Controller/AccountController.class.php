<?php
namespace Api\Controller;
use Think\Controller;

define('KEY', 'jfdksajfkl;dsajfkdjsaklfdajffdsafdsfdsfdsfdsklfdsafdsafdsafdsdsajlkfdsa');

class AccountController extends Controller{
    public function decode()
    {
        $jwt = new \Org\Util\Jwt;
        $encode = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1aWQiOjEwNTAsInVzZXJuYW1lIjoiYmFieSJ9.r7KLs6Z-HaUw52qZzKrE8hiuAPy-KGVZXuE4QXZodo8';
        
        $decoded = (array) $jwt::decode($encode, KEY, array('HS256'));
        dump($decoded);
    }
    public function register(){
        $req_name = $_POST['name'];
        $req_id = $_POST['id'];
        $req_email = $_POST['email'];
        $req_password = $_POST['password'];
        
        // 1、请求信息检测
        if( empty($req_name) || empty($req_id) || empty($req_email) || empty($req_password) ){
            $res = array(
    			'code' => -1,
    			'msg' => "信息不能为空",
    		);
    		return $this->ajaxReturn($res);
        } elseif( M('Account')->where("a_name='$req_name'")->getField('a_name') ){
            $res = array(
    			'code' => -1,
    			'msg' => "该用户名已被使用！",
    		);
    		return $this->ajaxReturn($res);
        } elseif( M('Account')->where("a_id='$req_id'")->getField('a_id') ){
            $res = array(
    			'code' => -1,
                'msg' => "该手机号码已被使用！"
    		);
    		return $this->ajaxReturn($res);
        } elseif( M('Account')->where("a_email='$req_email'")->getField('a_email') ){
            $res = array(
    			'code' => -1,
    			'msg' => "该邮箱账号已被使用！",
    		);
    		return $this->ajaxReturn($res);
        }

        // 2、生成Token参数
        $currenttime = time();
        $access_token = array( // 鉴权Token
            'iss' => 'nundy', // 签发者
            'aud' => 'nundy.cn', // 接收者
            'sub' => 'nundy.cn', // 面向的用户
            'iat' => $currenttime, // 签发时间
            'exp' => $currenttime + 3600, // 过期时间 (1小时，1*60*60)
            'data' => array(
                'a_id' => $_POST['id'],
                'a_name' => $_POST['name'],
                'a_email' => $_POST['email'],
                'a_auth' => 0,
                'a_account_time' => date("Y-m-d H:i:s"),
            )
        );
        $refresh_token = array( // 刷新Token
            'iss' => 'nundy', // 签发者
            'aud' => 'nundy.cn', // 接收者
            'sub' => 'nundy.cn', // 面向的用户
            'iat' => $currenttime, // 签发时间
            'exp' => $currenttime + 604800, // 过期时间 (7天，7*24*60*60)
            'data' => array(
                'a_id' => $_POST['id'],
                'a_access_token' => $access_token
            )
        );

        // 3、制作Token
        $jwt = new \Org\Util\Jwt;
        $access_token_code = $jwt::encode($access_token, KEY);
        $refresh_token_code = $jwt::encode($refresh_token, KEY);

        // 4、数据集成
    	$data = array(
            'a_id' => $_POST['id'],
    		'a_name' => $_POST['name'],
    		'a_email' => $_POST['email'],
            'a_password' => md5($_POST['password']),
            'a_auth' => 0,
            'a_account_time' => $currenttime,
            'a_access_token' => $access_token_code,
            'a_refresh_token' => $refresh_token_code
        );
        
        // 5、执行插入
    	$sqlstatus = M('Account')->add($data);
        if( $sqlstatus ){
            $res = array(
    			'code' => 0,
                'msg' => '恭喜您，注册成功!',
                'data' => array(
                    'access_token' => $access_token_code,
                    'refresh_token' => $refresh_token_code
                )
    		);
    		return $this->ajaxReturn($res);
        } else {
            $res = array(
                'code' => -1,
                'msg' => '抱歉，一个未知的错误发生了!',
            );
            return $this->ajaxReturn($res);
    	}
    }
}
?>
