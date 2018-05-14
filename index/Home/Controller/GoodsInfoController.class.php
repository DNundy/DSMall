<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
use Think\Model;

class GoodsInfoController extends Controller {
	//商品详情页面
	public function index(){
		if(empty($_GET['id'])){
			$res = array(
                'code' => '-1',
                'msg' => '参数传递失败',
            );
            return $this->ajaxReturn($res);
		}
		$id = $_GET['id'];
		$Model = new Model();
 		$sql ="select trading_goods.g_name,
 					  trading_goods.g_construct,
					   trading_goods.g_type,
					   trading_goods.g_id,
 					  trading_goods.g_price,
 					  trading_goods.g_time,
 					  trading_goods.g_picture,
					   trading_user.u_name,
					   trading_user.u_id,
 					  trading_user.u_place,
 					  trading_user.u_telphone
 					  from trading_goods left join trading_user on trading_goods.u_id=trading_user.u_id where trading_goods.g_id=$id";
 		$goodsInfo = $Model->query($sql);
		if(empty($goodsInfo)){
			$res = array(
                'code' => '-1',
                'msg' => "抱歉该商品已下架！",
        	);
        	return $this->ajaxReturn($res);
		}
		$goodsInfo[0]['g_time'] = date("Y-m-d H:i:s",$goodsInfo[0]['g_time']);
		$res = array(
                'code' => '0',
                'msg' => $goodsInfo,
        );
        return $this->ajaxReturn($res);
	}
	//商品用户评论内容
	public function discuss(){
		if(empty($_POST['id'])){
			$res = array(
                'code' => '-1',
                'msg' => '参数传递失败',
            );
            return $this->ajaxReturn($res);
		}
		$id = $_POST['id'];
		$Model = new Model();
 		$sql ="select trading_discuss.d_content,trading_discuss.d_time,trading_user.u_id,trading_user.u_name
 			from trading_discuss left join trading_user on 
            trading_discuss.u_id=trading_user.u_id where trading_discuss.g_id=$id";
 		$discussInfo = $Model->query($sql);
		$res = array(
                'code' => '0',
                'msg' => $discussInfo,
        );
        return $this->ajaxReturn($res);
	}
	//用户发布评论
	public function publishDiscuss(){
        if(!isset($_SESSION['num']) || $_SESSION['num'] == ''){
            $res = array(
                'code' => '-1',
                'msg' => '请登录后进行评论！',
        	);
        	return $this->ajaxReturn($res);
        }
        $data = array(
        	'u_id' => $_SESSION['num'],
        	'g_id' => $_POST['id'],
        	'd_content' => $_POST['content'],
        	'd_time' => date('Y-m-d H:i:s'),
        );
        $status = M('Discuss')->add($data);
    	$res = array(
    		'code' => '0',
    		'msg' => $status?'评论发布成功!':'重复发布！',
    	);
    	return $this->ajaxReturn($res);		
	}
    public function is_collect(){//判断是否已收藏
        if(empty($_POST['id'])){
            $res = array(
                'code' => '-1',
                'msg' => '参数传递失败',
            );
            return $this->ajaxReturn($res);
        }
        $data['g_id'] = $_POST['id'];
        $data['u_id'] = $_SESSION['num'];
        $result = M('Collect')->where($data)->select();
        if(empty($result)){
            $res = array(
                'code' => '-1',
                'msg' => '未收藏',
            );
            return $this->ajaxReturn($res);
        } else {
            $res = array(
                'code' => '0',
                'msg' => '已收藏',
            );
            return $this->ajaxReturn($res);
        }
    }
    public function goods_Collect(){
        if(empty($_POST['id'])){
            $res = array(
                'code' => '-1',
                'msg' => '参数传递失败',
            );
            return $this->ajaxReturn($res);
        }
        $data = array(
            'g_id' => $_POST['id'],
            'u_id' => $_SESSION['num'],
            'c_time' => date("Y-m-d"),
        );
        $result = M('Collect')->add($data);
        if($result!=false){
            $res = array(
                'code' => '0',
                'msg' => '收藏成功!',
            );
            return $this->ajaxReturn($res);
        } else {
            $res = array(
                'code' => '-1',
                'msg' => '收藏失败!',
            );
            return $this->ajaxReturn($res);
        }
    }
    public function goods_CollectNull(){
        if(empty($_POST['id'])){
            $res = array(
                'code' => '-1',
                'msg' => '参数传递失败',
            );
            return $this->ajaxReturn($res);
        }
        $data = array(
            'g_id' => $_POST['id'],
            'u_id' => $_SESSION['num'],
        );
        $result = M('Collect')->where($data)->delete();
        if($result!=false){
            $res = array(
                'code' => '0',
                'msg' => '取消收藏成功!',
            );
            return $this->ajaxReturn($res);
        } else {
            $res = array(
                'code' => '-1',
                'msg' => '取消收藏失败!',
            );
            return $this->ajaxReturn($res);
        }
    }
}