<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
//登录
class GoodsInfoController extends Controller {
	public function index(){
		if(empty($_GET['id'])){
			$res = array(
                'code' => '-1',
                'msg' => '参数传递失败',
            );
            return $this->ajaxReturn($res);
		}
		$id = $_GET['id'];
		$info = M('Goods')->where("g_id = $id")->select();
		if(empty($info)){
			$res = array(
                'code' => '-1',
                'msg' => "抱歉该商品已下架！",
        	);
        	return $this->ajaxReturn($res);
		}
		$res = array(
                'code' => '0',
                'msg' => $info,
        );
        return $this->ajaxReturn($res);
	}
}