<?
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
    /**
     * 管理员对用户的管理
     */
class AdminUserInfoController extends AdminCommonController {
    //搜索框搜索用户账号及详细信息
    public function searchUser(){
        if(empty($_POST['num'])){
            $res = array(
                'code' => '-1',
                'msg' => '参数传递失败',
            );
            return $this->ajaxReturn($res);
        }
        $num = $_POST['num'];
        $user = M('User');
        $userInfo = $user->where("u_id=$num")->select();
        if(!empty($userInfo)){
            $res = array(
                'code' => '0',
                'msg' => $userInfo,
            );
            return $this->ajaxReturn($res);
        } else {
            $res = array(
                'code' => '-1',
                'msg' => '查找改用户信息失败',
            );
            return $this->ajaxReturn($res);
        }
    }
	public function selectUser(){
		$user = M('User');
		$userInfo = $user->where()->select();

		$num = $_SESSION['num'];
        $admin = M('Admin');
        $name = $admin->where("a_id=$num")->getField('a_name');

		if(!empty($userInfo)){
			$res = array(
    			'code' => '0',
    			'msg' => $userInfo,
    			'adminName' => $name,
    		);
    		return $this->ajaxReturn($res);
		} else {
			$res = array(
    			'code' => '-1',
    			'msg' => '查找信息失败',
    			'adminName' => $name,
    		);
    		return $this->ajaxReturn($res);
		}
	}
	public function exitUser(){
		if(empty($_GET['id'])){
			$res = array(
    			'code' => '-1',
    			'msg' => '找不见该用户哟！系统宝宝很委屈！',
    		);
    		return $this->ajaxReturn($res);
		}
		$user = M('User');
		$result = $user->where("u_id=$num")->setField('u_status','-1');
		if($result!=false)
		{
			$res = array(
                'code' => '0',
                'msg' => '冻结该用户成功!',
            );
            return $this->ajaxReturn($res);

		}
		else{
			$res = array(
                'code' => '-1',
                'msg' => '冻结该用户失败!',
            );
            return $this->ajaxReturn($res);
		}	
	}
}