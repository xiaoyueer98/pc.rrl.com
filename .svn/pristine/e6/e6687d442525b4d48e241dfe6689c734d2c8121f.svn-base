<?php

namespace Home\Controller;

use Think\Controller;

class RedpackagewxtestController extends Controller {

        protected $values = array();
        protected $wxappid = ""; //微信公众号appid
        protected $mch_id = "";  //微信支付商户id
        protected $redirect_uri = "http://www.renrenlie.com/Home/Redpackagewxtest/get_openid";  //回调地址
        protected $appsecret = ""; //公众号appsecert
        protected $KEY = "";   //api秘钥
        protected $redpackage_uri = "https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack";

        const SSLCERT_PATH = '';
        const SSLKEY_PATH = '';
        const CA_PATH = '';
        //curl代理设置
        const CURL_PROXY_HOST = "0.0.0.0"; //"10.152.18.220";
        const CURL_PROXY_PORT = 0; //8080;

        public function __construct() {
                //判断如果不是从微信端访问微信页面则跳转到对应端的首页
                from_to_weixin();
                parent::__construct();

                $config = C("WEIXIN_CONFIG");
                $this->wxappid = $config['wxappid'];
                $this->mch_id = $config['mch_id'];
                $this->appsecret = $config['appsecret'];
                $this->KEY = $config['KEY'];
                $this->SSLCERT_PATH = $config['SSLCERT_PATH'];
                $this->SSLKEY_PATH = $config['SSLKEY_PATH'];
                $this->CA_PATH = $config['CA_PATH'];
        }

        /**
         * 通过网页授权获取code
         */
        public function get_code() {

                $userinfo = $_COOKIE['userinfo'];
                $userArr = unserialize($userinfo);
                $uid = $userArr['userid'];
                $username = $userArr['username'];
                //$_SESSION['rrl' . $username] = "orHnYsxvHbeAPKObuSNPKJpchhTU";
                if (!$uid) {
                        setcookie("gourl", "/Home/Redpackagewx/get_code", time() + 3600, "/");
                        header("location:/Home/Webchatlogin/login");
                        die;
                }
                setcookie("gourl", "/Home/Redpackagewx/get_code", time() - 1, "/");
                if ($_SESSION['rrl' . $username]) {
                        header("location:/Home/Redpackagewx/get_openid");
                } else {
                        $codeurl = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $this->wxappid . "&redirect_uri=" . urlencode($this->redirect_uri) . "&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
                        header("location:$codeurl");
                }
        }

        /**
         * 通过网页授权根据code获取用户openid,并发放红包
         */
        public function get_openid() {

                $userinfo = $_COOKIE['userinfo'];
                $userArr = unserialize($userinfo);
                $uid = $userArr['userid'];
                $username = $userArr['username'];

                if (!$uid) {

                        header("location:/index.php");
                        die;
                }


                if (empty($_GET['state']) || empty($_GET['code'])) {
                        header("location:/index.php");
                }

                $openidurl = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $this->wxappid . "&secret=" . $this->appsecret . "&code=" . $_GET['code'] . "&grant_type=authorization_code";
                $content = file_get_contents($openidurl, true);
                $openidArr = $this->std_class_object_to_array(json_decode($content));
                $openid = $openidArr['openid'];
                $_SESSION['rrl' . $username] = $openid;
                var_dump($openidArr);
                $access_token = $openidArr['access_token'];
                
                $url2 = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";
                $content2 = file_get_contents($url2, true);
                $userinfo = $this->std_class_object_to_array(json_decode($content2));
                echo "<pre>";var_dump($userinfo);echo "</pre>";
                
                die;
                
                //判断该用户是否已经获取过分享链接
                $shareOb = M("share");
                $isExit = $shareOb->where("activeid=" . C('WX_REDPACKAGE_ID') . " and username='$username' and status=1")->find();
                if (!$isExit) {
                        /*                         * **********************************拼凑分享链接获取邀请码*************************************** */
                        $shareUrlBase = "http://www.renrenlie.com/Home/Webchatactive/wxredpackage";
                        $shareUrlTmp = "wxredtag/WxRedpackage/wxredchannel/WxShare/wxredaid/" . C('WX_REDPACKAGE_ID') . "/wxreduname/" . $openid;
                        $shareUrl = $shareUrlBase . "/wxredshare/" . md5($shareUrlTmp);
                        $sharecode = $this->get_sharecode();
                        //不加密的分享链接地址
                        $shareUrl2 = $shareUrlBase . "/" . $shareUrlTmp;

                        $userinfoArr = M("userinfo")->where("username='{$username}'")->find();
                        $userid = $userinfoArr['userid'];
                        //插入一条分享信息
                        $activeInfo = M("active")->where("id='" . C('WX_REDPACKAGE_ID') . "'")->find();
                        $data['url'] = $shareUrl2;
                        $data['decrypturl'] = $shareUrl;
                        $data['uid'] = $userid;
                        $data['username'] = $username;
                        $data['tag'] = "WxRedpackage";
                        $data['channel'] = "WxShare";
                        $data['activeid'] = C('WX_REDPACKAGE_ID');
                        $data['activename'] = $activeInfo['activename'];
                        $data['click'] = 0;
                        $data['num'] = 0;
                        $data['comment'] = $sharecode;
                        $data['created_at'] = $data['updated_at'] = time();
                        M("share")->add($data);
                } else {
                        $shareUrl = $isExit['decrypturl'];
                        $sharecode = $isExit['comment'];
                }


                $this->assign("shareurl", $shareUrl);
                $this->assign("sharecode", $sharecode);
                $this->display("./Webchat/shareinfo");
        }

        /*
         * 发放红包
         */

        public function send_wxredpackage() {
                //$id = 27;
                //获取发放红包日志的id
                $id = $_POST['id'];
                if (empty($id)) {
                        echo json_encode(array("code" => "500", "msg" => "参数异常"));
                        die;
                }

                $redlog = M("redpackage_log");
                $redlogArr = $redlog->where("id={$id} and status=0")->find();
                if (empty($redlogArr)) {
                        echo json_encode(array("code" => "500", "msg" => "该红包不存在或已发放"));
                        die;
                }

                //判断该用户是否满足被下发微信红包的条件
                //1活动开启，2，发放总金额未达到，3，注册时间满足活动时间 
                //查看此次微信红包活动信息
                $redAId = $redlogArr['activeid'];
                $redActiveOb = M("active");
                $redActiveArr = $redActiveOb->where("id = {$redAId} and status=1")->find();
                if (empty($redActiveArr)) {
                        echo json_encode(array("code" => "500", "msg" => "该活动已终止"));
                        die;
                }
                $activeStart = $redActiveArr['starttime']; //活动开始时间
                $activeEnd = $redActiveArr['endtime']; //活动截止时间

                $countMoney = M("redpackage_log")->where("status=1 and activeid = '{$redAId}'")->sum("money");

                if (empty($countMoney)) {
                        $countMoney = 0;
                }

                //判断该用户是否符合领取红包的条件
                if (C('WX_REDPACKAGE_OPEN') && date("Y-m-d H:i:s") > $activeStart && date("Y-m-d H:i:s") < $activeEnd && C('WX_REDPACKAGE_COUNT') > $countMoney) {

                        //发放红包接口参数
                        $url = $this->redpackage_uri;
                        $remark = $redlogArr['comment'];   //备注信息
                        $act_name = $redlogArr['activename']; //活动名称
                        $wishing = $redlogArr['wishing'];  //祝福语
                        $total_num = $redlogArr['totalnum']; //发放数量
                        $max_value = $redlogArr['maxvalue']; //最大红包金额
                        $min_value = $redlogArr['minvalue']; //最小红包金额
                        $total_amount = $redlogArr['money'] * 100; //付款金额 
                        $re_openid = $redlogArr['openid'];  //被发放红包者openid
                        $send_name = $redlogArr['sendname']; //发放红包者
                        $nick_name = $redlogArr['nickname']; //红包提供方
                        $wxappid = $this->wxappid;   //微信公众号appid
                        $mch_id = $this->mch_id;     //微信支付商户号
                        $mch_billno = $redlogArr['billno']; //订到号
                        $nonce_str = $this->getNonceStr();

                        $resultArr = $this->wx_redpackage($url, $remark, $act_name, $wishing, $total_num, $max_value, $min_value, $total_amount, $nick_name, $wxappid, $mch_id, $mch_billno, $send_name, $nonce_str, $re_openid);

                        if ($resultArr['code'] == "200") {
                                //修改红包日志状态和修改时间
                                $re = $redlog->save(array("id" => $id, "status" => "1", "updated_at" => time()));
                                if ($re) {
                                        echo json_encode($resultArr);
                                        die;
                                } else {
                                        echo json_encode(array("code" => "500", "msg" => "红包发放成功，修改记录失败"));
                                        die;
                                }
                        } else {
                                echo json_encode($resultArr);
                                die;
                        }
                } else {
                        echo json_encode(array("code" => "500", "msg" => "该活动已终止"));
                        die;
                }
        }

        public function sendtest() {
                $url = $this->redpackage_uri;
                $remark = "wu";   //备注信息
                $act_name = "hongbao"; //活动名称
                $wishing = "恭喜";  //祝福语
                $total_num = 1; //发放数量
                $max_value = 100; //最大红包金额
                $min_value = 100; //最小红包金额
                $total_amount = 100; //付款金额 
                $send_name = 'renrenlie'; //发放红包者
                $nick_name = 'who'; //红包提供方
                $wxappid = $this->wxappid;   //微信公众号appid
                $mch_id = $this->mch_id;     //微信支付商户号
                $mch_billno = "1234567890123456789012345678"; //订单号
                $nonce_str = $this->getNonceStr();

                $re = $this->wx_redpackage($url, $remark, $act_name, $wishing, $total_num, $max_value, $min_value, $total_amount, $nick_name, $wxappid, $mch_id, $mch_billno, $send_name, $nonce_str);
                var_dump($re);
        }

        /*
         * 微信红包测试
         */

        public function wx_redpackage($url, $remark, $act_name, $wishing, $total_num, $max_value, $min_value, $total_amount, $nick_name, $wxappid, $mch_id, $mch_billno, $send_name, $nonce_str, $re_openid = "orHnYsxvHbeAPKObuSNPKJpchhTU", $client_ip = "127.0.0.1") {

                //var_dump(__DIR__."/../../..".RedpackagewxController::CA_PATH);

                $data = array(
                    "remark" => $remark,
                    "act_name" => $act_name,
                    "client_ip" => $client_ip,
                    "wishing" => $wishing,
                    "total_num" => $total_num,
                    "max_value" => $max_value,
                    "min_value" => $min_value,
                    "total_amount" => $total_amount,
                    "re_openid" => $re_openid,
                    "send_name" => $send_name,
                    "nick_name" => $nick_name,
                    "wxappid" => $wxappid,
                    "mch_id" => $mch_id,
                    "mch_billno" => $mch_billno,
                    "nonce_str" => $nonce_str
                );
                foreach ($data as $k => $v) {

                        $this->SetData($k, $v);
                }
                $this->SetSign();

                $xml = $this->ToXml();
                //var_dump($xml);die;
                $return = $this->postXmlCurl($xml, $url, true);
                //var_dump($return);
                $returnArr = $this->FromXml($return);

//                echo "<pre>";
//                var_dump($returnArr);
//                echo "</pre>";
                //对返回值进行处理
                if ($returnArr['return_code'] == "SUCCESS" && $returnArr['result_code'] == "SUCCESS") {
                        return array("code" => "200", "msg" => "微信红包发放成功");
                } else {
                        return array("code" => "500", "msg" => $returnArr['return_msg']);
                }
        }

        /**
         * 
         * 产生随机字符串，不长于32位
         * @param int $length
         * @return 产生的随机字符串
         */
        public static function getNonceStr($length = 32) {
                $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
                $str = "";
                for ($i = 0; $i < $length; $i++) {
                        $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
                }
                return $str;
        }

        /**
         * 
         * 28为订单号 mch_id+yyyymmdd+10位一天内不能重复的数字
         * 
         */
        public function getOrderID() {
                $chars = "1234567890";
                $str = "";
                for ($i = 0; $i < 10; $i++) {
                        $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
                }
                //判断改订单号今天是否重复过
                $mch_id = $this->mch_id;
                return $mch_id . date("Ymd") . $str;
        }

        /**
         * 
         * 设置参数
         * @param string $key
         * @param string $value
         */
        public function SetData($key, $value) {
                $this->values[$key] = $value;
        }

        /**
         * 设置签名，详见签名生成算法
         * @param string $value 
         * */
        public function SetSign() {
                $sign = $this->MakeSign();
                $this->values['sign'] = $sign;
                return $sign;
        }

        /**
         * 生成签名
         * @return 签名，本函数不覆盖sign成员变量，如要设置签名需要调用SetSign方法赋值
         */
        public function MakeSign() {
                //签名步骤一：按字典序排序参数
                ksort($this->values);
                $string = $this->ToUrlParams();
                //签名步骤二：在string后加入KEY
                $string = $string . "&key=" . $this->KEY;
                //签名步骤三：MD5加密
                $string = md5($string);
                //签名步骤四：所有字符转为大写
                $result = strtoupper($string);
                return $result;
        }

        /**
         * 输出xml字符
         * @throws WxPayException
         * */
        public function ToXml() {
                if (!is_array($this->values) || count($this->values) <= 0) {
                        throw new WxPayException("数组数据异常！");
                }

                $xml = "<xml>";
                foreach ($this->values as $key => $val) {
                        if (is_numeric($val)) {
                                $xml.="<" . $key . ">" . $val . "</" . $key . ">";
                        } else {
                                $xml.="<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
                        }
                }
                $xml.="</xml>";
                return $xml;
        }

        /**
         * 以post方式提交xml到对应的接口url
         * 
         * @param string $xml  需要post的xml数据
         * @param string $url  url
         * @param bool $useCert 是否需要证书，默认不需要
         * @param int $second   url执行超时时间，默认30s
         * @throws WxPayException
         */
        private static function postXmlCurl($xml, $url, $useCert = false, $second = 30) {
                $ch = curl_init();
                //设置超时
                curl_setopt($ch, CURLOPT_TIMEOUT, $second);

                //如果有配置代理这里就设置代理
                if (RedpackagewxController::CURL_PROXY_HOST != "0.0.0.0" && RedpackagewxController::CURL_PROXY_PORT != 0) {
                        curl_setopt($ch, CURLOPT_PROXY, RedpackagewxController::CURL_PROXY_HOST);
                        curl_setopt($ch, CURLOPT_PROXYPORT, RedpackagewxController::CURL_PROXY_PORT);
                }
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                //设置header
                curl_setopt($ch, CURLOPT_HEADER, FALSE);
                //要求结果为字符串且输出到屏幕上
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

                if ($useCert == true) {
                        //设置证书
                        //使用证书：cert 与 key 分别属于两个.pem文件
                        curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'PEM');
                        curl_setopt($ch, CURLOPT_SSLCERT, __DIR__ . "/../../.." . RedpackagewxController::SSLCERT_PATH);
                        curl_setopt($ch, CURLOPT_SSLKEYTYPE, 'PEM');
                        curl_setopt($ch, CURLOPT_SSLKEY, __DIR__ . "/../../.." . RedpackagewxController::SSLKEY_PATH);
                        curl_setopt($ch, CURLOPT_CAINFOTYPE, 'PEM');
                        curl_setopt($ch, CURLOPT_CAINFO, __DIR__ . "/../../.." . RedpackagewxController::CA_PATH);
                }
                //post提交方式
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
                //运行curl
                $data = curl_exec($ch);
                //返回结果
                if ($data) {
                        curl_close($ch);
                        return $data;
                } else {
                        $error = curl_errno($ch);
                        curl_close($ch);
                        throw new WxPayException("curl出错，错误码:$error");
                }
        }

        /**
         * 将xml转为array
         * @param string $xml
         * @throws WxPayException
         */
        public function FromXml($xml) {
                if (!$xml) {
                        throw new WxPayException("xml数据异常！");
                }
                //将XML转为array 
                $this->values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
                return $this->values;
        }

        /**
         * 格式化参数格式化成url参数
         */
        public function ToUrlParams() {
                $buff = "";
                foreach ($this->values as $k => $v) {
                        if ($k != "sign" && $v != "" && !is_array($v)) {
                                $buff .= $k . "=" . $v . "&";
                        }
                }

                $buff = trim($buff, "&");
                return $buff;
        }

        /**
         * 对象转换成数组格式
         *
         * $stdclassobject object
         *
         * return array
         */
        public function std_class_object_to_array($stdclassobject) {
                $_array = is_object($stdclassobject) ? get_object_vars($stdclassobject) : $stdclassobject;
                foreach ($_array as $key => $value) {
                        $value = (is_array($value) || is_object($value)) ? $this->std_class_object_to_array($value) : $value;
                        $array[$key] = $value;
                }
                return $array;
        }

        /*
         * 获取专属邀请码
         * 
         */

        public function get_sharecode() {

                $str = "ab2c3d4e5f6g7h8jkmnopqrstu9vwxy0z";
                $s = "";
                while (strlen($s) < 6) {

                        $i = mt_rand(0, 32);
                        $s .= $str[$i];
                }
                $cOb = M("share");
                $reArr = $cOb->where("comment='$s'")->find();

                if ($reArr) {
                        $this->get_sharecode();
                } else {

                        return $s;
                }
        }

}

use Think\Exception;

class WxPayException extends Exception {

        public function errorMessage() {
                return $this->getMessage();
        }

}
