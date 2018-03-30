<?
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class AdminController extends AdminCommonController {
	public function index(){//显示用户登录页面
	$this->display('admin');
    }
    public function findNotice(){//显示系统发布的所有通知
    	$notice = M('Notice');
    	$adminNotice = $notice->where()->select();
    	$res['msg'] = $adminNotice;
    	return $this->ajaxReturn($res);
    }
    public function addNotice(){

    	if(empty($_POST['title'])||$_POST['cotent']){
    		$res = array(
    			'code' => '-1',
    			'msg' => '参数传递出错',
    		);
    		return $this->ajaxReturn($res);
    	}
    	$data = array(
    		'n_title' => $_POST['title'],
    		'n_content' => $_POST['cotent'],
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
    public function countNotice(){
    	$notice = M('Notice');
    	$count = $notice->where()->count('n_id');
    	$res['msg'] =$count;
    	return $this->ajaxReturn($res);
    }
}