<?php
namespace Home\Controller;
use Think\Controller;
//重置密码
class RepasswordController extends Controller {
	public function index(){//重置密码主页面
		$type=$_GET['type'];
		$this->assign('type',"$type");
    	$this->display();
	}
	public function find(){//验证该用户是否达到修改密码的条件
	   $num=$_POST['num'];//学号或者工号
	   $password=$_POST['password'];//重置的密码
	   $p=md5($_POST['password']);//将密码加密
	   $code=$_POST['code'];//验证码
	   $type=$_GET['type'];//用户身份
	   if($type=='student'){//若重置用户为学生
		   	     $verify = new \Think\Verify();   //判断验证的内置方法
	         	if($verify->check($code, $id)){
				         	 	$user=M('Student');//连接数据库查找学生表
					   		    $info1=$user->where("s_num=$num")->select();
								if(!empty($info1)) {//若该用户存在
								   			   $data['s_num']=$num;
								   			   $data['s_email']=0;
								   			   $info2=$user->where($data)->select();//该用户存在且未完善用户资料
								   			   if($info2!=NULL){
								   				  	$this->error('您还未修改过密码！请使用初始密码登录！');
								   			    }
								   			    else{       //给该用户发送邮箱用于修改密码
								   				 	 redirect("../SendMail/student?type=$type&num=$num&p=$p");
								   			    }
					   		    }
					   		    else{
					   		    	$this->error('该用户不存在!');
					   		    }
		   		}
		   		 else{
		   			  $this->error('验证码错误!');
		   		}
	   	 }
	   elseif ($type=='teacher') {
		   			$verify = new \Think\Verify();   //判断验证的内置方法
		         	 if($verify->check($code, $id)){
					         	 	$user=M('Teacher');
						   		    $info1=$user->where("t_num=$num")->select();
									if(!empty($info1)) {//若该用户存在
									   			   $data['t_num']=$num;
									   			   $data['t_email']=0;
									   			   $info2=$user->where($data)->select();//该用户存在且未完善用户资料
									   			   if($info2==NULL){
									   				  	$this->error('您还未重置密码！请使用初始密码登录！');
									   			    }
									   			    else{       //给该用户发送邮箱用于修改密码
									   				 	 redirect("../SendMail/student?type=$type&num=$num&p=$p");
									   			    }
						   		    }
						   		    else{
						   		    	$this->error('该用户不存在!');
						   		    }
			   		}
			   		 else{
			   			  $this->error('验证码错误!');
			   		}
	   	
	   }
	   else{
	   	$this->error('参数传递出错！');
	   }

	}


}
