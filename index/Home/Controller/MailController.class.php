<?php
namespace Home\Controller;
use Think\Controller;
class MailController extends Controller{
    public function index($email,$token,$num,$type,$password){//参数分别为email，token，用户身份
    	$address = $email;
    	$title="计算机学院选课系统，密码重置";
    	$body="<a href='http://localhost/course_sellection_system/index.php/Home/CheckToken?token=$token&num=$num&type=$type&asd=$password'>确认是本人操作！点击完成验证</a>";
    	$status=SendMail($address,$title,$body);   //邮件的整体格式
    	if(!$status) {
    		redirect('../Repassword',5,'修改密码失败!');
    	}
        else{
            redirect('../Index', 5, '请登录邮箱进行确认！');   
    	}
    }
}
?>
