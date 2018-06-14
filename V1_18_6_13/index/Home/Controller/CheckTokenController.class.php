<?php
namespace Api\Controller;
use Think\Controller;
//登录
class CheckTokenController extends Controller {
	public function index(){
		$token=$_GET['token'];//令牌
		$num=$_GET['num'];//账户
		$password=$_GET['asd'];//密码
		if(empty($token)||empty($num)||empty($password)){
			$this->error('参数传递出错！');
		}
		$user=M('User');
		$time=$user->where("u_id=$num")->getField('u_time');//获取修改密码的时间
		if (time()-$time>60*60){
			$res = array(
    			'code' => '-1',
    			'msg' => '链接超时',
    		);
    		return $this->ajaxReturn($res);
		}else{//如果链接未超时
			$key=$user->where("u_id=$num")->getField('u_password');
			if($token==md5($num.$key)) {//若令牌匹配成功
				$user->where("u_id=$num")->setField('u_password',"$password");//将修改后的密码存入数据库
				$res = array(
    				'code' => '0',
    				'msg' => '密码重置成功',
    			);
    			return $this->ajaxReturn($res);	
			} else {
				$res = array(
    				'code' => '-1',
    				'msg' => '令牌错误',
    			);
    			return $this->ajaxReturn($res);
			}
		}
	}
}