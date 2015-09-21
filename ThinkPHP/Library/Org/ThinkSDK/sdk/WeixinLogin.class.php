<?php
// +----------------------------------------------------------------------
// | TOPThink [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2010 http://topthink.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi.cn@gmail.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------
// | QqSDK.class.php 2013-02-25
// +----------------------------------------------------------------------

class WeixinLogin{
	/**
	 * 获取requestCode的api接口
	 * @var string
	 */
	protected $GetRequestCodeURL = 'https://open.weixin.qq.com/connect/qrconnect';
	
	/**
	 * 获取access_token的api接口
	 * @var string
	 */
	protected $GetAccessTokenURL = 'https://api.weixin.qq.com/sns/oauth2/access_token';
	/**
	 * 获取request_code的额外参数,可在配置中修改 URL查询字符串格式
	 * @var srting
	 */
	protected $Authorize = 'scope=snsapi_login&state=2014#wechat_redirect';
        /**
	 * appid
	 * @var srting
	 */
	protected $AppKey = '';
        /**
	 * appsecret
	 * @var srting
	 */
	protected $AppSecret = '';
        /**
	 * callback
	 * @var srting
	 */
	protected $Callback = '';
        /**
	 * scope
	 * @var srting
	 */
	protected $scope = 'snsapi_login';
        /**
	 * callback
	 * @var srting
	 */
	protected $state = 'STATE#wechat_redirect';
        /**
	 * response_type
	 * @var srting
	 */
	protected $response_type = 'code';
         /**
	 * grant_type
	 * @var srting
	 */
	protected $grant_type = 'authorization_code';
         /**
	 * 等待时长，单位秒
	 * @var srting
	 */
	static public $timeout = 10;	
        
        /**
	 * 构造方法，配置应用信息
	 * @param array $token 
	 */
	public function __construct(){
		

		//获取应用配置
		$config = C("THINK_SDK_WEIXIN");
		if(empty($config['APP_KEY']) || empty($config['APP_SECRET'])){
			throw new Exception('请配置您申请的APP_KEY和APP_SECRET');
		} else {
			$this->AppKey    = $config['APP_KEY'];
			$this->AppSecret = $config['APP_SECRET'];
                        $this->Callback = "http://www.renrenlie.com/Home/Index/callbackweixinlogin/";
		}
	}
        
        /*
         * 获取验证码
         */
        public  function  getCode(){
                
                $appid = $this->AppKey;
                $callback = $this->Callback;
                $response_type = $this->response_type;
                $scope = $this->scope;
                $state = $this->state;
                
                $url = $this -> GetRequestCodeURL."?appid=".$appid."&redirect_uri=".$callback."&response_type=code&scope=snsapi_login&state=STATE#wechat_redirect";
                return $url;
        }
        /*
         * 获取access_token
         */
        public  function  getToken($code){
                
                $appid = $this->AppKey;
                $secret = $this->AppSecret;
                $grant_type = $this->grant_type;
                
                $url = $this -> GetAccessTokenURL;
                $arguments = array(
                        "appid" => $appid,
                        "secret" =>$secret,
                        "code" => $code,
                        "grant_type" => $grant_type                        
                );
                
                $return = $this -> _post($url,$arguments);
                return $return;
        }
        /*
         * curl post 
         */
        private function _post($url, $arguments, $charset = 'utf-8')
	{
		if(is_array($arguments))
		{
			$postData = http_build_query($arguments);
		}else
		{
			$postData = $arguments;
		}
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false);
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
		curl_setopt($ch, CURLOPT_TIMEOUT, self::$timeout);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, self::$timeout);

		$returnValue = curl_exec($ch);
		curl_close($ch);
		if($charset != 'utf-8'){
			$returnValue = iconv($charset,$charset,$returnValue);
		}
		return $returnValue;
	}
        
        
        
//        public function  wxtest(){
//        
//        import("Org.ThinkSDK.sdk.WeixinLogin");
//        $sns = new \WeixinLogin();
//        
//        $url = $sns->getCode();
//        redirect($url);
//    }
//    public function  callbackweixinlogin($code = null){
//            
//        empty($code) &&  $this->error('参数错误');
//        
//        import("Org.ThinkSDK.sdk.WeixinLogin");
//        $sns = new \WeixinLogin();
//        
//        $return = $sns->getToken($code);
//        //echo "<pre>";var_dump($return);echo "</pre>";
//        if($return){
//            
//            $returnArr = json_decode($return,true);
//            //echo "<pre>";var_dump($returnArr);echo "</pre>";echo "hehe";die;
//            
//            if(is_array($returnArr)){
//                
//                    if(!empty($returnArr['openid'])){
//                        
//                        $openid = $returnArr['openid'];
//                        $data['username'] = "wx_" . $openid;
//                        var_dump($data);
//                        //$this->otherLogin($data, "weixin");
//                   
//                    }else{
//                        header("location:?s=/Home/Index/index");
//                    }
//            }else{
//                header("location:?s=/Home/Index/index");
//            }
//        }else{
//            header("location:?s=/Home/Index/index");
//        }
//            
//    }   
	
}









