<?php
namespace Home\Controller;
use Think\Controller;
class RegistController extends Controller {
	/**
	 * 注册
	 */

	public function login() {

		$this->display ( "./Webchat/login" );
	}


	public function regist() {


		$userid = session(C('USER_AUTH_ID'));
		if($userid)
		{
			exit;
		}
		else
		{

		$rules = array(

			array('name','require','帐号必须填写'), //默认情况下用正则进行验证
			array('password','require','密码必须填写'),
			array('name','','帐号名称已经存在！',0,'unique',1), // 在新增的时候验证name字段是否唯一
			array('repassword','password','确认密码不正确',0,'confirm'), // 验证确认密码是否和密码一致
		);
		$Userinfo = D("Userinfo"); 
		$member = D("Member"); 

		$data['password'] = md5(md5($_POST['password']));
		$data['username'] = $_POST['name'];

		$card['username']=$data['username'];
		$card['password']=$data['password'];
		$card['pwd']=$_POST['password'];

		if (!$Userinfo->validate($rules)->create($_POST)){
			// 如果创建失败 表示验证没有通过 输出错误提示信息
			exit($Userinfo->getError());
		}else{
			// 验证通过 可以进行其他数据操作

			$user_result = $Userinfo->add($data);
			if($user_result)
			{
			$member_result = $member->add($data);
			}
			session(C('USER_AUTH_ID'),$member_result);
			exit;


		}
		}
	}
}