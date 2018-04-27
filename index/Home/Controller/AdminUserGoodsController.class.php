<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
use Think\Model;
class AdminUserGoodsController extends AdminCommonController {
	public function findType(){
		$type = M('Type');
		$typeGoods = $type->where()->select();

		$num = $_SESSION['num'];
        $admin = M('Admin');
        $name = $admin->where("a_id=$num")->getField('a_name');
		$res = array(
			'code' => '0',
			'msg' => $typeGoods,
			'adminName' => $name,

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
		$type = M('Type');
		$data['t_type'] = $_POST['type'];
		$status = $type->add($data);
    	$res = array(
    		'code' => $status,
    		'msg' => $status?'添加成功!':'不能重复添加',
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
		$data['t_type'] = $_GET['type'];
		M()->startTrans();//开启事务
		$type = M('Type');
		$statusOne = $type->where($data)->delete();
		$goods = M('Goods');
		$is_type = $goods->where("g_type=$goodsType")->getField();
		if(!empty($is_type)){
			$statusTwo =  $goods->where("g_type=$goodsType")->delete();
		}else {
			$statusTwo = true;
		}
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
 		$sql ="select * from trading_goods left join trading_user on trading_goods.u_id=trading_user.u_id order by trading_goods.g_id desc";
 		$goodsInfo = $Model->query($sql);

 		$num = $_SESSION['num'];
        $admin = M('Admin');
        $name = $admin->where("a_id=$num")->getField('a_name');

		if(!empty($goodsInfo)){
    		$res = array(
    			'code' => '0',
    			'msg' => $goodsInfo,
    			'adminName' => $name,
    		);
    		return $this->ajaxReturn($res);				
		} else {
   			$res = array(
    			'code' => '-1',
    			'msg' => '暂时还没有商品哦QAQ!',
    			'adminName' => $name,
    		);
    		return $this->ajaxReturn($res);	
		}
	}
	public function searchGoods(){//搜索框搜索商品
		if(empty($_POST['search'])){
			$res = array(
    			'code' => '-1',
    			'msg' => '参数传递出错！',
    		);
    		return $this->ajaxReturn($res);
		}
		$search = $_POST['search'];
		$Model = new Model();
 		$sql ="select * from trading_goods where g_name REGEXP '[$search]'";
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
    			'msg' => '暂时还没有对应商品哦QAQ!',
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