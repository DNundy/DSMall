<?
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
use Think\Model;
class AdminUserGoodsController extends AdminCommonController {
	public function findType(){
		$type = M('type');
		$typeGoods = $type->where()->select();
		$res = array(
			'code' => '0',
			'msg' => $typeGoods,
		);
		return $this->ajaxReturn($res);
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
	public function findGoods(){//显示所有商品
		$Model = new Model();
 		$sql ="select * from trading_goods left join trading_user on trading_goods.u_id=trading_user.u_id order by g_id desc";
 		$goodsInfo = $Model->query($sql);
		if(!empty($goodsInfo)){
    		$res = array(
    			'code' => '0',
    			'msg' => $goodsInfo,
    		);
    		return $this->ajaxReturn($res);				
		} else {
   			$res = array(
    			'code' => '-1',
    			'msg' => '暂时还没有商品哦QAQ!',
    		);
    		return $this->ajaxReturn($res);	
		}
	}
	public function deleteGoods(){//管理员删除商品
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