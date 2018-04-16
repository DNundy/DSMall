<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
//登录
class IndexController extends Controller {
	public function index(){
		$this->display();
	}
	public function indexGoods(){
		//$type = $_POST['type'];
		//$info = $_GET['info'];
		var_dump($_POST);
		switch ($type) {
			case 'type':
				//$goodInfo = M('Goods')->where("g_type=$")
				break;
			
			case 'price':

				break;
			case 'time':

				break; 
			case 'search':

				break;
		}
	}
}