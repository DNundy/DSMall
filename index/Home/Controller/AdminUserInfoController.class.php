<?
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
    /**
     * 管理员对用户的管理
     */
class AdminUserInfoController extends AdminCommonController {
	public function selectUser(){
		$user = M('User');
		$userInfo = $user->where()->select();
		if(!empty($userInfo)){
			$res = array(
    			'code' => '0',
    			'msg' => $userInfo,
    		);
    		return $this->ajaxReturn($res);
		} else {
			$res = array(
    			'code' => '0',
    			'msg' => '查找信息失败',
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