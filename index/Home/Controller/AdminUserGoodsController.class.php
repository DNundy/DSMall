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
		if(empty($_GET['type'])){
			$res = array(
    			'code' => '-1',
    			'msg' => '参数传递失败',
    		);
    		return $this->ajaxReturn($res);
		}
		$goodsType = $_GET['type'];
		M()->startTrans();//开启事务
		$type = M('Type');
		$statusOne = $type->where("t_type=$goodsType")->delete();
		$goods = M('Goods');
		$statusTwo =  $goods->where("g_type=$goodsType")->delete();
		var_dump($statusTwo);
		if($statusOne&&$statusTwo){
			M()->commit();
			$res = array(
    			'code' => '0',
    			'msg' => '删除成功',
    		);
    		return $this->ajaxReturn($res);
		} else {
			M()->rollback();
			$res = array(
    			'code' => '-1',
    			'msg' => '删除失败',
    		);
    		return $this->ajaxReturn($res);
		}


	}
	public function findGoods(){
		$goods = M('Goods');
		$goodsInfo = $goods->where()->select();
		if(!empty($goodsInfo)){
    		$res = array(
    			'code' => '0',
    			'msg' => $goodsInfo,
    		);
    		return $this->ajaxReturn($res);				
		} else {
   			$res = array(
    			'code' => '-1',
    			'msg' => '查询失败',
    		);
    		return $this->ajaxReturn($res);	
		}
	}
	public function deleteGoods(){
		if(empty($_GET['id'])){
			$res = array(
    			'code' => '-1',
    			'msg' => '参数传递出错！',
    		);
    		return $this->ajaxReturn($res);				
		}
		$id = $_GET['id'];
		$goods = M('Goods');
		$status = $goods->where("g_id=$id")->delete();
    	$res = array(
    		'code' => $status,
    		'msg' => $status?'删除成功!':'删除失败!',
    	);
    	return $this->ajaxReturn($res);		
	}
}