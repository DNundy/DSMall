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

	}
}