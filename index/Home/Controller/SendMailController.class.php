<?php
namespace Home\Controller;
use Think\Controller;
//为用户邮箱发送验证信息
class SendMailController extends Controller {
	public function student(){
		$type=$_GET['type'];//用户身份
		$num=$_GET['num'];//账户
		$password=$_GET['p'];//修改后的密码
		if(!empty($type)&&!empty($num))
		{
			if($type=='student'){//如果该用户时学生
				$user=M('Student');
			    $email=$user->where("s_num=$num")->getField('s_email');//查找该学生的邮箱
				$time=time();//获取系统当前时间
				$key=$user->where("s_num=$num")->getField('s_password');//获取该用户之前密码用于制造令牌
				$passwordToken=md5($num.$key.$type);//令牌
			    $result=$user->where("s_num=$num")->setField('s_time',"$time");//讲当前时间存入数据库用以判断验证是否超时
				if($result!=false)//如果新令牌更新成功则发送至邮箱
				{
					$mail=A('Mail');
					$mail -> index($email,$passwordToken,$num,$type,$password);	

				}
				else{
					redirect('../Repassword',5,'修改密码失败!');
				}

			}	
			elseif ($type=='teacher') {
				$user=M('Teacher');
			    $email=$user->where("t_num=$num")->getField('t_email');
				$time=time();
				$key=$user->where("t_num=$num")->getField('t_password');
				$passwordToken=md5($num.$key.$type);
			    $result=$user->where("t_num=$num")->setField('t_time',"$time");
					if($result!=false)//如果新令牌更新成功则发送至邮箱
					{
						$mail=A('Mail');
						$mail -> index($email,$passwordToken,$num,$type,$password);	

					}
					else{
						redirect('../Repassword',5,'修改密码失败!');
					}
			}
			else{
				$this->error('参数传递出错！');
			}
		}
		else{
			$this->error('参数传递出错！');
		}
	    
	}
	
}