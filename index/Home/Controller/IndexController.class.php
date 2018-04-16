<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
//登录
class IndexController extends Controller {
	public function index(){
		$this->display();
	}
	public function findType(){
		$type = M('type');
		$typeGoods = $type->where()->select();
		$res = array(
			'code' => '0',
			'msg' => $typeGoods,
		);
		return $this->ajaxReturn($res);
	}
	public function indexGoods(){
		// 类型
		if($_POST['type'] != 'all'){
			$data['g_type'] = $_POST['type'];
		}

		// 价格
		switch ($_POST['price']) {
			case '1':
				$data['g_price'] = array('lt',50);
				break;
			case '2':
				$data['g_price'] = array('between',array(50,100));
				break;
			case '3':
				$data['g_price'] = array('between',array(100,1000));
				break; 
			case '4':
				$data['g_price'] = array('between',array(1001,10000));
				break;
			case '5':
				$data['g_price'] = array('gt',10000);
				break;
			default:
				$data['g_price'] = array('egt',0);
				break;
		}

		// 时间
		switch ($_POST['time']) {
			case '1':
				$time = time()-7*24*3600;
				$data['g_time'] = array('egt',$time);
				break;
			case '2':
				$time = time()-30*24*3600;
				$data['g_time'] = array('egt',$time);
				break;
			case '3':
				$time = time()-90*24*3600;
				$data['g_time'] = array('egt',$time);
				break; 
			case '4':
				$time = time()-365*24*3600;
				$data['g_time'] = array('egt',$time);
				break;
			case '5':
				$time = time()-365*24*3600;
				$data['g_time'] = array('lt',$time);
				break;
			default:
				$data['g_time'] = array('egt',0);
				break;
		}

		// 排序
		if( $_POST['orderBy'] == 'desc' ){
			$goods = M('Goods')->where($data)->order("g_price desc")->select();
		}else{
			$goods = M('Goods')->where($data)->order("g_price")->select();
		}
		$res = array(
			'code' => '0',
			'msg' => $goods,
			'count' => count($goods),
		);
		return $this->ajaxReturn($res);
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
}