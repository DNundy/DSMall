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
		if(empty($_POST['type'])||$_POST['price']||$_POST['time']||$_POST['orderBy']){
			$res = array(
                'code' => '-1',
                'msg' => '参数传递出错！',
            );
            return $this->ajaxReturn($res);
		}
		$type = $_POST['type'];
		$price = $_POST['price'];
		$time = $_POST['time'];
		$orderBy = $_POST['orderBy'];
		switch ($type) {
			case '1':
				break;
			
			case '2':

				break;
			case '3':

				break; 
			case 'search':

				break;
		}
	}
}