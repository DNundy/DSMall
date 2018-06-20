<?php
namespace Api\Controller;
use Think\Controller;

define('KEY', 'jfdksajfkl;dsajfkdjsaklfdajffdsafdsfdsfdsfdsklfdsafdsafdsafdsdsajlkfdsa');

class AccountController extends Controller{
    // 用户登录
    public function login(){
        // 请求信息
        $req = array(
            'a_id' => $_POST[id],
            'a_password' => md5($_POST[password])
        );

        // 请求信息检测
        if( empty($req[a_id]) || empty($req[a_password])){
            $res = array(
                'code' => -1,
                'msg' => "信息不能为空",
            );
            return $this->ajaxReturn($res);
        }

        // 账户id验证
        $AccountSql = M('Account');
        $isAccount = M('Account')->where("a_id='$req[a_id]'")->getField();
        if( empty($isAccount) ){
            $res = array(
                'code' => -1,
                'msg' => "该账号不存在",
            );
            return $this->ajaxReturn($res);
        }

        // 账户密码验证
        $AccountData = $AccountSql->where($req)->select();
        if( empty($AccountData) ){
            $res = array(
                'code' => -1,
                'msg' => "密码输入错误",
            );
            return $this->ajaxReturn($res);
        }

        // 账户是否被封锁a_blockade_time
        $currenttime = time();
        $blockadetime = $AccountData[0][a_blockade_time];
        if( $blockadetime > $currenttime ){
            $date=floor(($blockadetime-$currenttime)/86400);
            $hour=floor(($blockadetime-$currenttime)%86400/3600);
            $minute=floor(($blockadetime-$currenttime)%86400/60);
            $res = array(
                'code' => -1,
                'msg' => "账号距封锁结束还有".$date."天".$hour."小时"."$minute"."分",
            );
            return $this->ajaxReturn($res);
        }

        // 生成Token
        $encode = $this->encode($req);

        // 登录成功
        $res = array(
            'code' => 0,
            'msg' => "登录成功",
            'data' => array(
                'a_id' => $AccountData[0][a_id],
                'a_name' => $AccountData[0][a_name],
                'a_auth' => $AccountData[0][a_auth],
                'a_email' => $AccountData[0][a_name],
                'access_token' => $encode[access_token],
                'refresh_token' => $encode[refresh_token],
            )
        );
        return $this->ajaxReturn($res);
    }

    // 用户注册
    public function register(){
        // 请求信息
        $req = array(
            'a_name' => $_POST[name],
            'a_id' => $_POST[id],
            'a_email' => $_POST[email],
            'a_password' => $_POST[password],
        );
        
        // 请求信息检测
        if( empty($req[a_name]) || empty($req[a_id]) || empty($req[a_email]) || empty($req[a_password]) ){
            $res = array(
                'code' => -1,
                'msg' => "信息不能为空",
            );
            return $this->ajaxReturn($res);
        } elseif( M('Account')->where("a_name='$req[a_name]'")->getField('a_name') ){
            $res = array(
                'code' => -1,
                'msg' => "该用户名已被使用！",
            );
            return $this->ajaxReturn($res);
        } elseif( M('Account')->where("a_id='$req[a_id]'")->getField('a_id') ){
            $res = array(
                'code' => -1,
                'msg' => "该手机号码已被使用！"
            );
            return $this->ajaxReturn($res);
        } elseif( M('Account')->where("a_email='$req[a_email]'")->getField('a_email') ){
            $res = array(
                'code' => -1,
                'msg' => "该邮箱账号已被使用！",
            );
            return $this->ajaxReturn($res);
        }
        // 生成Token
        $encode = $this->encode($req);
        $currenttime = time();

        // 数据集成
        $data = array(
            'a_id' => $req[a_id],
            'a_name' => $req[a_name],
            'a_email' => $req[a_email],
            'a_password' => md5($req[a_password]),
            'a_auth' => 0,
            'a_account_time' => $currenttime,
            'a_access_token' => $encode[access_token],
            'a_refresh_token' => $encode[refresh_token]
        );
        
        // 执行插入
        $sqlstatus = M('Account')->add($data);
        if( $sqlstatus ){
            $res = array(
                'code' => 0,
                'msg' => '恭喜您，注册成功!',
                'data' => array(
                    'a_id' => $req[a_id],
                    'a_name' => $req[a_name],
                    'a_auth' => 0,
                    'a_email' => $req[a_email],
                    'access_token' => $encode[access_token],
                    'refresh_token' => $encode[refresh_token]
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

    // Token编码
    public function encode($req){
        $currenttime = time();

        // Token参数
        $access_token = array( // 鉴权Token
            'iss' => 'nundy', // 签发者
            'aud' => 'nundy.cn', // 接收者
            'sub' => 'nundy.cn', // 面向的用户
            'iat' => $currenttime, // 签发时间
            'exp' => $currenttime + 3600, // 过期时间 (1小时，1*60*60)
            'data' => array(
                'a_id' => $req[a_id],
                'a_name' => $req[a_name],
                'a_email' => $req[a_email],
                'a_auth' => 0,
                'a_account_time' => $currenttime,
            )
        );

        $refresh_token = array( // 刷新Token
            'iss' => 'nundy', // 签发者
            'aud' => 'nundy.cn', // 接收者
            'sub' => 'nundy.cn', // 面向的用户
            'iat' => $currenttime, // 签发时间
            'exp' => $currenttime + 604800, // 过期时间 (7天，7*24*60*60)
            'data' => array(
                'a_id' => $req[id],
                'a_access_token' => $access_token
            )
        );

        // 生成Token
        $jwt = new \Org\Util\Jwt;
        $access_token_code = $jwt::encode($access_token, KEY);
        $refresh_token_code = $jwt::encode($refresh_token, KEY);

        return array(
            "access_token" => $access_token_code,
            "refresh_token" => $refresh_token_code
        );
    }
}
?>
