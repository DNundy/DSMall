<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
use Think\Model;
//用户个人信息相关类
class PersonalController extends UserCommonController {
	public function index(){
		$this->display('index/personal');
	}
	//显示用户相关信息
	public function userInfo(){
		$num = $_SESSION['num'];
		$user = M('User');
        $userInfo = $user->where("u_id=$num")->select();
        if(!empty($userInfo)){
            $res = array(
                'code' => '0',
                'msg' => $userInfo,
            );
            return $this->ajaxReturn($res);
        } else {
            $res = array(
                'code' => '-1',
                'msg' => '个人信息展示有误！',
            );
            return $this->ajaxReturn($res);
        }
	}

	//接受修改用户信息 
	public function fixUserInfo(){
		$num = $_SESSION['num'];
		$name = $_POST['u_name'];
		$email = $_POST['u_email'];
		$place = $_POST['u_place'];
		$telphone = $_POST['u_telphone'];
		if(empty($name)||empty($email)||empty($place)||empty($telphone)){
			$res = array(
                'code' => '-1',
                'msg' => '参数传递出错',
            );
            return $this->ajaxReturn($res);
		}
		$data = array(
			'u_name' => $name,
			'u_email' => $email,
			'u_place' => $place,
			'u_telphone' => $telphone,
		);
		$result = M('User')->where("u_id=$num")->setField($data);
		if($result!=false){
			$res = array(
                'code' => '0',
                'msg' => '修改用户信息成功!',
            );
            return $this->ajaxReturn($res);
		} else {
			$res = array(
                'code' => '-1',
                'msg' => '您并未进行修改!',
            );
            return $this->ajaxReturn($res);
		}
	}
	public function fixPassword(){
		if(empty($_POST['oldPwd'])||empty($_POST['newPwd'])){
			$res = array(
    			'code' => '-1',
    			'msg' => '参数传递出错！',
    		);
    		return $this->ajaxReturn($res);	
		}
		$num = $_SESSION['num'];
		$newPwd = md5($_POST['newPwd']);
		$data = array(
			'u_id' => $num,
			'u_password' => md5($_POST['oldPwd']),
		);
		$info = M('User')->where($data)->select();//若用户与密码对应正确且未被冻结
        if(!empty($info))
        {
        	$result = M('User')->where($data)->setField('u_password',"$newPwd");
        	if($result != false){
        		$res = array(
    				'code' => '0',
    				'msg' => '修改密码成功！',
    			);
    			return $this->ajaxReturn($res);	
        	} else {
        		$res = array(
    				'code' => '-1',
    				'msg' => '该密码与原始密码相同！',
    			);
    			return $this->ajaxReturn($res);	
        	}
        } else {
        	$res = array(
    			'code' => '-1',
    			'msg' => '原始密码输入有误！',
    		);
    		return $this->ajaxReturn($res);	
        }

	}
	//展示该用户收藏的商品
	public function userCollectGoods(){
		$num = $_SESSION['num'];
		$Model = new Model();
 		$sql ="select * from trading_collect left join trading_goods on trading_collect.g_id=trading_goods.g_id where trading_collect.u_id=$num order by trading_collect.c_id desc";
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
    			'msg' => '暂时还没有收藏任何商品哦QAQ!',
    		);
    		return $this->ajaxReturn($res);	
		}
	}
	//取消用户对该商品的收藏
	public function exitUserCollectGoods(){
		if(empty($_GET['id'])){
			$res = array(
    			'code' => '-1',
    			'msg' => '参数传递出错！',
    		);
    		return $this->ajaxReturn($res);	
		}
		$id = $_GET['id'];
		$result = M('Collect')->where("c_id=$id")->delete();
		if($result != false){
			$res = array(
    			'code' => '0',
    			'msg' => '取消收藏成功！',
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
	//该用户发布的所有商品
	public function oldPublishGoods(){
		$num = $_SESSION['num'];
		$goodsInfo = M('Goods')->where("u_id=$num")->order('g_id desc')->select();
		if(empty($goodsInfo)){
			$res = array(
                'code' => '-1',
                'msg' => '你还未发布任何商品哦',
            );
            return $this->ajaxReturn($res);
		}
		$res = array(
            'code' => '0',
            'msg' => $goodsInfo,
        );
        return $this->ajaxReturn($res);
	}
	//用户发布的所有评论
	public function discussGoods(){
		$num = $_SESSION['num'];
		$Model = new Model();
 		$sql ="select * from trading_discuss left join trading_goods on trading_discuss.g_id=trading_goods.g_id where trading_discuss.d_user=$num order by trading_discuss.d_id desc";
 		$disscussInfo = $Model->query($sql);
		if(!empty($disscussInfo)){
			$res = array(
            'code' => '0',
            'msg' => $disscussInfo,
        	);
        	return $this->ajaxReturn($res);
		} else {
			$res = array(
            'code' => '-1',
            'msg' => "该用户未发表任何评论！",
        	);
        	return $this->ajaxReturn($res);
		}
	}
	//下架商品
	public function exitGoods(){
		$id = $_GET['id'];//商品id
		if(empty($id)){
			$res = array(
                'code' => '-1',
                'msg' => '参数传递出错！',
            );
            return $this->ajaxReturn($res);
		}
		$result = M('Goods')->where("g_id=$id")->setField('g_status','-1');
		if($result!=false)
		{
			$res = array(
                'code' => '0',
                'msg' => '下架商品成功!',
            );
            return $this->ajaxReturn($res);

		} else {
			$res = array(
                'code' => '-1',
                'msg' => '该商品已经下架!',
            );
            return $this->ajaxReturn($res);
		}
	}
	//重新发布
	public function againGoods(){
		$id = $_GET['id'];//商品id
		if(empty($id)){
			$res = array(
                'code' => '-1',
                'msg' => '参数传递出错！',
            );
            return $this->ajaxReturn($res);
		}
		$result = M('Goods')->where("g_id=$id")->setField('g_status','1');
		if($result!=false)
		{
			$res = array(
                'code' => '0',
                'msg' => '上架商品成功!',
            );
            return $this->ajaxReturn($res);

		} else {
			$res = array(
                'code' => '-1',
                'msg' => '该商品已经上架!',
            );
            return $this->ajaxReturn($res);
		}
	}
	public function findNotice(){//显示系统发布的所有通知
    	$notice = M('Notice');
    	$adminNotice = $notice->where()->order('n_id desc')->select();
    	$res = array(
            'msg' => $adminNotice,
        );
    	return $this->ajaxReturn($res);
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
	public function publishGoods(){//发布商品
		$data = array(
			'u_id' => $_SESSION['num'],
			'g_name' => $_POST['g_name'],
			'g_construct' => $_POST['g_construct'],
			'g_type' => $_POST['g_type'],
			'g_price' => $_POST['g_price'],
			'g_time' => date("Y-m-d H:i:s"),
		);
		$data['g_picture'] = ''; 
		$upload_path = $_SERVER['DOCUMENT_ROOT'];
		var_dump($_FILES['g_picture[]']);
		/*foreach ($_FILES['myfile']['name'] as $value)
		{
			if($_FILES['myfile']['error'][$i]<=0)
			{
					$allowtype=array('png','gif','jpg','jpeg');			
					//遍历出所有的文件
					$arr=explode('.', $value);
					$type=$arr[count($arr)-1];
					//判断图片类型是否符合
					if(!in_array($type, $allowtype))
					{
						//图片类型不符合
						header("location:error.html");
					}
					else
					{
						$j=0;
						//保存图片的具体路径
						$uplode_path=$_SERVER['DOCUMENT_ROOT']."/z/order_image/";
						//设置时间戳和随机数重命名图片
						$randname=time().rand(99,200).".".$type;
						//将临时位置的文件移动到指定的目录上
						if(is_uploaded_file($_FILES['myfile']['tmp_name'][$i]))
						{
							if(move_uploaded_file($_FILES['myfile']['tmp_name'][$i], $uplode_path.$randname))
							{
								//保存到$pic数组中  后面需将数组中的所有值赋给变量$picture
								 $pic[$j++]=$randname;
							}
							else
							{
								//文件上传失败
								header("location:error.html");
							}
						}
						else
						{
							//不是一个上传文件
							header("location:error.html");
						}
					}
				}
				else{
					header("location:error.html");
				}
						//将$pic数组中的所有元素放进$picture
				foreach ($pic as $value) 
				{
					$picture=$picture.$value."|";
				}
				$i++;

			}
		}*/
	}
}