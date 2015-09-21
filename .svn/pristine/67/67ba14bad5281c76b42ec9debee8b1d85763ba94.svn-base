<?php
// 本类由系统自动生成，仅供测试用途

/**
 * 文件名  ：IndexAction
 * 功能摘要：显示前台首页
 * 编写作者：haibo
 * 更新日期：2014-10-15
 * 文件版本：V1.0
 */
 namespace Home\Controller;
use Think\Controller;
class TestController extends Controller  {
        function __construct() {
                parent::__construct();
                $linkArr = M("friendlink") -> where("status=0")->order("orderid desc,id asc")->select();
                $this ->assign("linkArr",$linkArr);
                
        }
	function logs(){
		import("Org.Util.saetv2");
		$o = new \SaeTOAuthV2( WB_AKEY , WB_SKEY );
		
		$code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );
		
		return $code_url;
	}
	function callback(){
		
		import("Org.Util.saetv2");
		$o = new \SaeTOAuthV2( WB_AKEY , WB_SKEY );
		if (isset($_REQUEST['code'])) {
			$keys = array();
			$keys['code'] = $_REQUEST['code'];
			$keys['redirect_uri'] = WB_CALLBACK_URL;
			try {
				$token = $o->getAccessToken( 'code', $keys ) ;
			} catch (OAuthException $e) {
			}
		}
		
		
		if ($token) {
			session("token",$token);//$_SESSION['token'] = $token
			setcookie( 'weibojs_'.$o->client_id, http_build_query($token) );
			$c = new \SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
			$ms  = $c->home_timeline(); // done
			$uid_get = $c->get_uid();
			$uid = $uid_get['uid'];
			$user_message = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息
			//var_dump($user_message);die;
			session("username",$user_message["screen_name"]);
			session("c_img",$user_message["profile_image_url"]);
			echo session('username');
			?>
			success ，<a href="http://www.sutuijian.com">come on</a> 
			<?php
		} else {
			?>
			default。
			<?php
		}
	}

	public function logg(){
		
		
		if(empty($_SESSION['username']))
		{
			$this->error("未登录",U("Index:index"));
		}
		else
		{
			$username = session('username');
			
		}
	}
}