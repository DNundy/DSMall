<?php
namespace Home\Controller;
use Think\Controller;
//重置密码
class RepasswordController extends Controller {
	public function index(){//验证该用户是否达到修改密码的条件
		if(empty($_POST['num'])||empty($_POST['password'])||empty($_POST['code'])||empty($_POST['email']))
		{
            $this->error('参数传递出错!');
        }
		$num=$_POST['num'];//账户
		$password=md5($_POST['password']);//将密码加密
	    $code=$_POST['code'];//验证码
	    $data = array(
    		'u_id' => $_POST['num'], //账户
    		'u_email' => $_POST['email'],//用MD5对密码进行加密
    	);
	    $verify = new \Think\Verify();   //判断验证的内置方法
	    //if($verify->check($code, $id)){
			$user=M('User');//连接数据库
			$userInfo=$user->where("u_id=$num")->getField();//查找该用户是否存在
			if(!empty($userInfo)){
				$newInfo=$user->where($data)->select();//重置密码时的邮箱需为注册时所用邮箱
				if(!empty($newInfo)){
					$this->sendMail($num, $password);
				}else{
					$res = array(
                    	'code' => '-1',
                    	'msg' => '找回密码所有邮箱与注册时邮箱不一致!',
                	);
                	return $this->ajaxReturn($res);
				}
			}
			else{
				$res = array(
                    'code' => '-1',
                    'msg' => '该用户未注册!',
                );
                return $this->ajaxReturn($res);
			}
		/*}else{
            $res = array(
                'code' => '-1',
                'msg' => '验证码错误!',
            );
            return $this->ajaxReturn($res);
        }*/
								
	}
	public function sendMail($num, $password){
		$user=M('User');
		$email=$user->where("u_id=$num")->getField('u_email');//查找该用户的邮箱
		$time=time();//获取系统当前时间
		$key=$user->where("u_id=$num")->getField('u_password');//获取该用户之前密码用于制造令牌
		$passwordToken=md5($num.$key);//令牌
		$result=$user->where("u_id=$num")->setField('u_time',"$time");//讲当前时间存入数据库用以判断验证是否超时
		if($result!=false)//如果新令牌更新成功则发送至邮箱
		{
			$this->RepasswordMail($email, $passwordToken, $num, $password);	

		}
		else{
			$res = array(
                'code' => '-1',
                'msg' => '修改密码失败!',
            );
            return $this->ajaxReturn($res);
		}	
			
	}
	function RepasswordMail($email, $token, $num, $password){//参数分别为email，token，用户身份
    	$address = $email;
    	$title = "趣二手，密码重置";
    	$body = "<a href='http://localhost/platform/index.php/Home/CheckToken?token=$token&num=$num&asd=$password'>确认是本人操作！点击完成验证</a>";
    	$status = SendMail($address,$title,$body);   //邮件的整体格式
    	if(!$status) {
    		$res = array(
                    'code' => '-1',
                    'msg' => '重置密码失败!',
                );
                return $this->ajaxReturn($res);
    	}
        else {
            $res = array(
                'code' => '0',
                'msg' => '请登录邮箱进行确认后登录!',
            );
            return $this->ajaxReturn($res);
    	}
    }

}
