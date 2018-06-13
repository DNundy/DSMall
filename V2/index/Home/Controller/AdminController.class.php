<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class AdminController extends AdminCommonController {
	public function admin(){//显示用户登录页面
	   $this->display('admin');
	}
	public function adminGoods(){
	   $this->display('adminGoods');
	}
	public function adminInfo(){
	   $this->display('adminInfo');
	}
	public function adminSet(){
	   $this->display('adminSet');
	}
	public function adminType(){
	   $this->display('adminType');
	}
	public function adminUser(){
	   $this->display('adminUser');
	}
	
    public function findNotice(){//显示系统发布的所有通知
    	$notice = M('Notice');
    	$adminNotice = $notice->where()->order('n_id desc')->select();
        $num = $_SESSION['numAdmin'];
        $admin = M('Admin');
        $name = $admin->where("a_id=$num")->getField('a_name');
    	$res = array(
            'msg' => $adminNotice,
            'adminName' => $name,
        );
    	return $this->ajaxReturn($res);
    }
    public function addNotice(){

    	if(empty($_POST['title'])||empty($_POST['content'])){
    		$res = array(
    			'code' => '-1',
    			'msg' => '请输入完整通知内容！',
    		);
    		return $this->ajaxReturn($res);
    	}
    	$data = array(
    		'n_title' => $_POST['title'],
    		'n_content' => $_POST['content'],
    		'n_time' => date("Y-m-d H:i:s"),
    	);
    	$notice = M('Notice');
    	$status = $notice->add($data);
    	$res = array(
    		'code' => $status,
    		'msg' => $status?'发布消息成功!':'发布消息失败',
    	);
    	return $this->ajaxReturn($res);
    }

    public function deleteNotice(){
    	if(empty($_GET['id'])){
    		$res = array(
    			'code' => $status,
    			'msg' => $status?'删除成功!':'删除失败',
    		);
    		return $this->ajaxReturn($res);
    	}
    	$id = $_GET['id'];
    	$notice = M('Notice');
    	$status = $notice->where("n_id=$id")->delete();
    	$res = array(
    		'code' => $status,
    		'msg' => $status?'删除消息成功!':'删除消息失败',
    	);
    	return $this->ajaxReturn($res);
    }
    public function count(){
    	$notice = M('Notice');
    	$countNotice = $notice->where()->count('n_id');
    	$user = M('User');
        $countUser = $user->where()->count('u_id');
        $goods = M('Goods');
        $countGoods = $goods->where()->count('g_id');
        $type = M('Type');
        $countType = $type->where()->count('t_type');
        $noticeHot = M('Notice');
        $adminNoticeHot = $noticeHot->where()->order('n_id desc')->limit(2)->select();

        $num = $_SESSION['numAdmin'];
        $admin = M('Admin');
        $name = $admin->where("a_id=$num")->getField('a_name');
        $res = array(
            'countNotice' => $countNotice,
            'countUser' => $countUser,
            'countGoods' => $countGoods,
            'countType' => $countType,
            'hotNotice' => $adminNoticeHot,
            'adminName' => $name,
        );
    	return $this->ajaxReturn($res);
	}
	public function fixAdminPassword(){
		if(empty($_POST['oldPwd'])||empty($_POST['newPwd'])){
			$res = array(
    			'code' => '-1',
    			'msg' => '参数传递出错！',
    		);
    		return $this->ajaxReturn($res);	
		}
		$num = $_SESSION['numAdmin'];
		$newPwd = md5($_POST['newPwd']);
		$data = array(
			'a_id' => $num,
			'a_password' => md5($_POST['oldPwd']),
		);
		$info = M('Admin')->where($data)->select();//若用户与密码对应正确且未被冻结
        if(!empty($info))
        {
        	$result = M('Admin')->where($data)->setField('a_password',"$newPwd");
        	if($result != false){
        		$res = array(
    				'code' => '0',
    				'msg' => '修改密码成功！',
    			);
    			return $this->ajaxReturn($res);	
        	} else {
        		$res = array(
    				'code' => '-1',
    				'msg' => '该密码与原始密码相同！',
    			);
    			return $this->ajaxReturn($res);	
        	}
        } else {
        	$res = array(
    			'code' => '-1',
    			'msg' => '原始密码输入有误！',
    		);
    		return $this->ajaxReturn($res);	
        }

	}
	public function add_admin(){
    	//获取表单中的信息
        if(empty($_POST['name'])||empty($_POST['password'])||empty($_POST['email'])){
            $this->error('参数传递出错!');
        }

    	$data = array(
    		//'a_name' => $_POST['name'],//姓名
    		//'a_password' => md5($_POST['password']),//用MD5对密码进行加密
    		'a_email' => $_GET['email'],//邮箱
		);
		$status = M('Admin')->add($data);
        $id = M('Admin')->order('a_id desc')->limit(1)->getField('a_id');
        array(
			'code' => $status,
			'msg' => $status?'注册成功!':'注册失败',
            'id' => $id,
		);
		return $this->ajaxReturn($res);
	}
	public function adminName(){
        $num = $_SESSION['numAdmin'];
        $admin = M('Admin');
        $name = M('Admin')->where("a_id=$num")->getField('a_name');
        $res = array(
            'adminName' => $name,
        );
    	return $this->ajaxReturn($res);
	}
}