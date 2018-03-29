<?
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class AdminUserGoodsController extends Controller {
	public function findType(){
		$type = M('type');
		$typeGoods = $type->where()->select();
		return $this->ajaxReturn($typeGoods);
	}

	public function addType(){
		if(empty($_POST['type'])){
			$res = array(
    			'code' => '-1',
    			'msg' => '参数传递失败',
    		);
    		return $this->ajaxReturn($res);
		}
		$type = M('type');
		$data['t_id'] = $_POST['type'];
		$status = $type->add($data);
    	$res = array(
    		'code' => $status,
    		'msg' => $status?'添加成功!':'添加失败',
    	);
    	return $this->ajaxReturn($res);		
	}

	public function deleteType(){

	}

	public function findGoods(){

	}
	public function deleteGoods(){
		
	}
}