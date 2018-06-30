<?php
namespace Api\Controller;
use Think\Controller;

define('KEY', 'jfdksajfkl;dsajfkdjsaklfdajffdsafdsfdsfdsfdsklfdsafdsafdsafdsdsajlkfdsa');

class AccountInfoController extends Controller{
    public function refresh()
    {
        // 请求信息
        $req = array(
            'refresh_token' => $_SERVER['HTTP_REFRESH_TOKEN'],
        );

        // Token解析
        $token = $this->decode($req[refresh_token]);
        $token_data = (array) $token[data];

        // 判断Token是否过期
        $current = time();
        if( $token[exp] < $current ){
            $res = array(
                'code' => -1,
                'msg' => 'Token 已过期!',
            );
            return $this->ajaxReturn($res);
        }

        // 判断Token是否正确
        $data = M('Account')->where("a_id='$token_data[a_id]'")->select();
        if( !$data[0][a_refresh_token] === $req[refresh_token] ){
            $res = array(
                'code' => -1,
                'msg' => 'Token 不匹配!',
            );
            return $this->ajaxReturn($res);
        }

        // 更新token
        $encode = $this->encode($data[0]);
        $condition = array(
            'a_access_token' => $encode[access_token],
            'a_refresh_token' => $encode[refresh_token],
        );
        $sqlstatus = M('account')->where("a_id = '$token_data[a_id]'")->save($condition);

        // 返回结果
        if( $sqlstatus ){
            $res = array(
                'code' => 0,
                'data' => array(
                    'a_id' => $data[0][a_id],
                    'a_name' => $data[0][a_name],
                    'a_auth' => $data[0][a_auth],
                    'a_email' => $data[0][a_email],
                    'access_token' => $encode[access_token],
                    'refresh_token' => $encode[refresh_token],
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
            'data' => array(
                'a_id' => $req[a_id],
                'a_name' => $req[a_name],
                'a_email' => $req[a_email],
                'a_auth' => 0,
            )
        );

        $refresh_token = array( // 刷新Token
            'iss' => 'nundy', // 签发者
            'aud' => 'nundy.cn', // 接收者
            'sub' => 'nundy.cn', // 面向的用户
            'iat' => $currenttime, // 签发时间
            'exp' => $currenttime + 604800, // 过期时间 (7天，7*24*60*60)
            'data' => array(
                'a_id' => $req[a_id],
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
    
    public function decode($token){
        $jwt = new \Org\Util\Jwt;
        $data = (array) $jwt::decode($token, KEY, array('HS256'));
        return $data;
    }
}
?>
