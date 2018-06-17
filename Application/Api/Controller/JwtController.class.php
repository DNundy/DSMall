<?php
namespace Api\Controller;
use Think\Controller;

class JwtController extends Controller{
    public function encode()
    {
        $jwt = new \Org\Util\Jwt;
        $key = "jfdksajfkl;dsajfkdjsaklfdajffdsafdsfdsfdsfdsklfdsafdsafdsafdsdsajlkfdsa";
        $token = array(
        'uid' => '1050asdasdasdas',
        'username' => 'baby',
        );

        $encode = $jwt::encode($token, $key);
        dump($encode);
    }
    public function decode()
    {
        $jwt = new \Org\Util\Jwt;
        $key = "jfdksajfkl;dsajfkdjsaklfdajffdsafdsfdsfdsfdsklfdsafdsafdsafdsdsajlkfdsa";
        $encode = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1aWQiOjEwNTAsInVzZXJuYW1lIjoiYmFieSJ9.r7KLs6Z-HaUw52qZzKrE8hiuAPy-KGVZXuE4QXZodo8';
        
        $decoded = (array) $jwt::decode($encode, $key, array('HS256'));
        dump($decoded);
    }
    public function login()
    {
        
    }
}
?>