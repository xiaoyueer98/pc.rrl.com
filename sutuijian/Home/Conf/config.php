<?php

define('URL_CALLBACK', 'http://www.renrenlie.com/index.php?s=/Home/Index/callback');

$THINK_SDK_RENREN = array(
    'APP_KEY' => 'a120f1c4c89b40e59abcc2749e0b4f72', //应用注册成功后分配的 APP ID
    'APP_SECRET' => '77bc11c11c9f437e8578633d4d5d3d71', //应用注册成功后分配的KEY
    'CALLBACK' => URL_CALLBACK . 'renren&',
);
$THINK_SDK_QQ = array(
//    'APP_KEY' => '1104216027', //应用注册成功后分配的 APP ID
//    'APP_SECRET' => '2aHI5xvvhjXFWj9j', //应用注册成功后分配的KEY
    'APP_KEY' => '101197941', //应用注册成功后分配的 APP ID
    'APP_SECRET' => '138e32dab59c912a00a814316b787cea', //应用注册成功后分配的KEY
    'CALLBACK' => URL_CALLBACK . 'qq&',
);
$THINK_SDK_WEIXIN = array(
    'APP_KEY' => 'wxf2310b20ba7d362c', //应用注册成功后分配的 APP ID
    'APP_SECRET' => '43396c539e07fd12aa1f77b96b427aad', //应用注册成功后分配的KEY
    'CALLBACK' => URL_CALLBACK . 'weixin&',
);
$THINK_SDK_SINA = array(
    'APP_KEY' => '1471489106', //应用注册成功后分配的 APP ID   
    'APP_SECRET' => 'becfef84fa57123e21d88c0faf17fe12', //应用注册成功后分配的KEY
    'CALLBACK' => URL_CALLBACK . 'sina&',
);
$WEIXIN_CONFIG = array(
    
        "wxappid" => "wx5aee7c9e7c2eb969", //微信公众号appid
        "mch_id" => "1235001902",  //微信支付商户id
        "appsecret" => "44062163dcb3b4627a53bf0ac164c87d", //公众号appsecert
        "KEY" => "1235001902905115wx5aee7c9e7c2eb9",   //api秘钥
        
        "SSLCERT_PATH" => '/Public/cert/apiclient_cert.pem',
        "SSLKEY_PATH" => '/Public/cert/apiclient_key.pem',
        "CA_PATH" => '/Public/cert/rootca.pem',
);
$config = array(
    'URL_MODEL' =>  2, //如果你的环境不支持PATHINFO请设置为3
    'DB_TYPE' => 'mysql', //数据库类型
//    'DB_HOST' => 'localhost', //数据库地址
//    'DB_NAME' => 'lierenren', //管理库名称，数据库初始化时已定，无需修改
//  'DB_USER' => 'myrenrenlie', //数据库用户名
//  'DB_PWD' => 'W8ydG7TxHRaYZVcT', //数据库密码ie', //数据库用户名
        
    'DB_HOST' => '127.0.0.1', //数据库地址
    'DB_NAME' => 'renrenlie', //管理库名称，数据库初始化时已定，无需修改
      'DB_USER' => 'root', //数据库用户名
      'DB_PWD' => '', //数据库密码ie', //数据库用户名

    /*
      'DB_HOST'   =>  '127.0.0.1', //数据库地址
      'DB_NAME'   =>  'lierenren', //管理库名称，数据库初始化时已定，无需修改
      'DB_USER'   =>  'root', //数据库用户名
      'DB_PWD'    =>  '', //数据库密码
     */
    'DB_PORT' => '3306', //数据库端口号
    'DB_PREFIX' => 'stj_', //数据库前缀，数据库初始化时已定，无需修改
    'DISABLE_LOG' => 0, //禁用日志
    //SDK 此处可以些到外部include进来然后array_merge
    'THINK_SDK_RENREN' => $THINK_SDK_RENREN,
    'THINK_SDK_QQ' => $THINK_SDK_QQ,
    'THINK_SDK_SINA' => $THINK_SDK_SINA,
    'THINK_SDK_WEIXIN' => $THINK_SDK_WEIXIN,
    //邮件
    'MAIL_HOST' => 'smtp.1sheng2.com', //smtp服务器的名称
    'MAIL_SMTPAUTH' => TRUE, //启用smtp认证
    'MAIL_USERNAME' => 'yifei@1sheng2.com', //你的邮箱名
    'MAIL_FROM' => 'yifei@1sheng2.com', //发件人地址
    'MAIL_FROMNAME' => '人人猎', //发件人姓名
    'MAIL_PASSWORD' => 'Yangcl231', //邮箱密码
    'MAIL_CHARSET' => 'utf-8', //设置邮件编码
    'MAIL_ISHTML' => TRUE, // 是否HTML格式邮件
    
    //微信公众号和微信支付配置信息
    'WEIXIN_CONFIG' => $WEIXIN_CONFIG,
    
    
    
    'SHARE_JON_OPEN' => true,
    'SHARE_JOB_ID' => 2,
    'SHARE_JOB_RECORD' => 20,
    'SHARE_JOB_RECORD_SUCCESS' => 50,
    'SHARE_JOB_COMPANY' => 20,
    'SHARE_JOB_COMPANY_SUCCESS' => 50,
    
    
    'SHARE_RECOMMENDSHARE_OPEN' => true,
    'SHARE_RECOMMENDSHARE_ID' => 4,
    'SHARE_RECOMMENDSHARE_RECORD' => 10,
    'SHARE_RECOMMENDSHARE_RECORD_SUCCESS' => 30,
    'SHARE_RECOMMENDSHARE_COMPANY' => 10,
    'SHARE_RECOMMENDSHARE_COMPANY_SUCCESS' => 30,
    
    
    'RED_PACKAGE_OPEN' => true,
    'RED_PACKAGE_ID' => 6,
    'RED_PACKAGE_COUNT' => 500,
    
    
    //微信红包配置信息
    'WX_REDPACKAGE_OPEN' => true,
    'WX_REDPACKAGE_ID' => 7,
    'WX_REDPACKAGE_COUNT' => 5000,     //元 为单位
    
    //微信红包参数 
    //activename 和 wishing 写进活动表中
    'WX_REDPACKAGE_REMARK' => "职场牛人都在人人猎",             //备注信息
    'WX_REDPACKAGE_TOTAL_NUM' => 1,                  //发放数量
    'WX_REDPACKAGE_MAX_VALUE' => 500,                //最大红包金额
    'WX_REDPACKAGE_MIN_VALUE' => 500,                //最小红包金额 
    'WX_REDPACKAGE_TOTAL_AMOUNT' => 500,             //付款金额，单位 分 
    'WX_REDPACKAGE_SEND_NAME' => "人人猎分享返现",            //红包发送者名称
    'WX_REDPACKAGE_NICK_NAME' => "人人猎分享返现",            //提供方名称
    
    
    
    //微信公众号
    'APPID' => "wx5aee7c9e7c2eb969",
    'SECRETKEY' => "44062163dcb3b4627a53bf0ac164c87d",
);
return $config;

/*return array(


	'DB_CONFIG1' => array(
    'db_type'  => 'mysql',
    'db_user'  => 'mystj',
    'db_pwd'   => 'VsEW8aNDwp7BNTwH',
    'db_host'  => '127.0.0.1',
    'db_port'  => '3306',
    'db_name'  => 'stj',
    'db_charset'=>    'utf8',
 ),
 'THINK_SDK_RENREN' => array(
		'APP_KEY'    => '85aec6d1af734fc08583669d7d985aeb', //应用注册成功后分配的 APP ID
		'APP_SECRET' => '870b8b7caa3e430ba9eb0a1d10801b2a', //应用注册成功后分配的KEY
		'CALLBACK'   => URL_CALLBACK . 'renren',
	),
	'THINK_SDK_QQ' => array(
		'APP_KEY'    => '1104216027', //应用注册成功后分配的 APP ID
		'APP_SECRET' => '2aHI5xvvhjXFWj9j', //应用注册成功后分配的KEY
		'CALLBACK'   => URL_CALLBACK . 'qq',
	),
	
	'MAIL_HOST' =>'smtp.exmail.qq.com',//smtp服务器的名称
    'MAIL_SMTPAUTH' =>TRUE, //启用smtp认证
    'MAIL_USERNAME' =>'709981907@qq.com',//你的邮箱名
    'MAIL_FROM' =>'709981907@qq.com',//发件人地址
    'MAIL_FROMNAME'=>'韩江涛',//发件人姓名
    'MAIL_PASSWORD' =>'duolejibuzhu1',//邮箱密码
    'MAIL_CHARSET' =>'utf-8',//设置邮件编码
    'MAIL_ISHTML' =>TRUE, // 是否HTML格式邮件

);*/
