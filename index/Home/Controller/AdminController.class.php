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
    	$adminNotice = $notice->where()->order('n_id desc')->select();
    	$res['msg'] = $adminNotice;
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
        $type = M('type');
        $countType = $type->where()->count('t_type');
        $res = array(
            'countNotice' => $countNotice,
            'countUser' => $countUser,
            'countGoods' => $countGoods,
            'countType' => $countType,
        );
    	return $this->ajaxReturn($res);
    }
}