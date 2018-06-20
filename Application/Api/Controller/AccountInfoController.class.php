<?php
namespace Api\Controller;
use Think\Controller;

define('KEY', 'jfdksajfkl;dsajfkdjsaklfdajffdsafdsfdsfdsfdsklfdsafdsafdsafdsdsajlkfdsa');

class AccountInfoController extends Controller{
    public function baseInfo()
    {
        $req = array(
            'access_token' => $_SERVER['HTTP_ACCESS_TOKEN'],
            'refresh_token' => $_SERVER['HTTP_REFRESH_TOKEN'],
            'access_expires' => $_SERVER['HTTP_ACCESS_EXPIRES'],
            'refresh_expires' => $_SERVER['HTTP_REFRESH_EXPIRES']
        );
        
    }

    public function verify()
    {
        
    }

    // Token解码
    public function decode(){
        $jwt = new \Org\Util\Jwt;
        $encode = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1aWQiOjEwNTAsInVzZXJuYW1lIjoiYmFieSJ9.r7KLs6Z-HaUw52qZzKrE8hiuAPy-KGVZXuE4QXZodo8';
        $decoded = (array) $jwt::decode($encode, KEY, array('HS256'));
        dump($decoded);
        // $req_access_token = $_SERVER['HTTP_ACCESS_TOKEN'];
        // $req_refresh_token = $_SERVER['HTTP_REFRESH_TOKEN'];
    }
}
?>
