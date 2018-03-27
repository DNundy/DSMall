<?php
namespace Home\Controller;
use Think\Controller;
//登录
class CheckTokenController extends Controller {
	public function index(){
		$token=$_GET['token'];//令牌
		$num=$_GET['num'];//学号或者工号
		$type=$_GET['type'];//用户身份
		$password=$_GET['asd'];//密码
		if(!empty($token)&&!empty($num)&&!empty($type)&&!empty($password)){
			if($type=='student'){
					$user=M('Student');
					$time=$user->where("s_num=$num")->getField('s_time');//获取修改密码的时间
					if (time()-$time>60*60){
						redirect('Repressword/index',5,'该验证已失效！');	
					}
					else{//如果链接未超时
						  $key=$user->where("s_num=$num")->getField('s_password');
							if($token==md5($num.$key.$type))//若令牌匹配成功
							{
								$user->where("s_num=$num")->setField('s_password',"$password");//将修改后的密码存入数据库
					     	    $this->success('密码重置成功！到首页进行登录','Index');
					
							}
							else{
								 redirect('Repressword/index',5,'修改密码失败！');		
								}
						}
				
			}
			elseif ($num=='teacher') {
					$user=M('Teacher');
					$time=$user->where("t_num=$num")->getField('t_time');
					if (time()-$time>24){
						redirect('Repressword/index',5,'该验证已失效！');	
					}
					else{
						  $key=$user->where("t_num=$num")->getField('t_password');
							if($token==md5($num.$key.$type))
							{
								$user->where("t_num=$num")->setField('t_password',"$password");
					     	    $this->success('密码重置成功！到首页进行登录','Index');
					
							}
							else{
								 redirect('Repressword/index',5,'修改密码失败！');		
								}
						}
			}
			else{
				redirect('Repassword',5,'参数传递失败!');
			}
		}
		else{
			redirect('Repassword',5,'参数传递失败!');
		}
	}
}