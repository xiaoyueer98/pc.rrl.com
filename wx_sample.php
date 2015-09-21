<?php

//在微信公众平台测试号下的测试文件
define("TOKEN", "wx_renrenlie");
$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
        $wechatObj = new wechatCallbackapiTest();
        $wechatObj->valid();
} else if ($method == 'POST') {
        $wechatObj = new wechatCallbackapi();
        $wechatObj->responseMsg();
}

class wechatCallbackapiTest {

        public function valid() {
                $echoStr = $_GET["echostr"];
                //valid signature , option
                if ($this->checkSignature()) {
                        echo $echoStr;
                        exit;
                }
        }

        private function checkSignature() {
                // you must define TOKEN by yourself
                if (!defined("TOKEN")) {
                        throw new Exception('TOKEN is not defined!');
                }

                $signature = $_GET["signature"];
                $timestamp = $_GET["timestamp"];
                $nonce = $_GET["nonce"];

                $token = TOKEN;
                $tmpArr = array($token, $timestamp, $nonce);
                // use SORT_STRING rule
                sort($tmpArr, SORT_STRING);
                $tmpStr = implode($tmpArr);
                $tmpStr = sha1($tmpStr);

                if ($tmpStr == $signature) {
                        return true;
                } else {
                        return false;
                }
        }

}

class wechatCallbackapi {

        public function __construct() {
                //文本事件
                $this->textTpl = "<xml>
                                    <ToUserName><![CDATA[%s]]></ToUserName>
				    <FromUserName><![CDATA[%s]]></FromUserName>
				    <CreateTime>%s</CreateTime>
				    <MsgType><![CDATA[%s]]></MsgType>
				    <Content><![CDATA[%s]]></Content>
				    <FuncFlag>0</FuncFlag>
				    </xml>";

                $this->postStr = @$GLOBALS["HTTP_RAW_POST_DATA"];
                @file_put_contents("wxtest.txt", $this->postStr);
                if (!empty($this->postStr)) {
                        libxml_disable_entity_loader(true);
                        $this->postObj = simplexml_load_string($this->postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                } else {
                        echo "";
                        exit;
                }
                $this->fromUsername = $this->postObj->FromUserName;
                $this->toUsername = $this->postObj->ToUserName;
                $this->msgType = $this->postObj->MsgType;
                $this->time = time();
        }

        public function responseMsg() {
                if ($this->msgType == "text") {
                        $keyword = trim($this->postObj->Content);
                        if (!empty($keyword)) {
                                
                        } else {
                                exit;
                        }
                } else if ($this->msgType == "event") {
                        $this->doEvent();
                } else if ($this->msgType == "voice") {
                        
                } else if ($this->msgType == "image") {
                        
                } else if ($this->msgType == "link") {
                        
                } else if ($this->msgType == "LOCATION") {
                        
                } else {
                        
                }
                $this->msgType = "text";
                $this->contentStr = "欢迎关注人人猎！客服会尽快回复你，请耐心等待~";
                $resultStr = sprintf($this->textTpl, $this->fromUsername, $this->toUsername, $this->time, $this->msgType, $this->contentStr);
                echo $resultStr;
                exit;
        }

        public function doEvent() {
                $event = $this->postObj->Event;
                $this->msgType = "text";
                if ($event == "subscribe") {
                        $eventKey = $this->postObj->EventKey;
                        if (strpos($eventKey, "qrscene_") !== false) {//未关注用户通过扫描带参数二维码进入
                                $this->contentStr = $eventKey;
                        } else {
                                $this->contentStr = "欢迎关注人人猎！人人猎正在举办注册领红包活动，领取红包http://www.renrenlie.com/Home/Redpackage/redpackage";
                        }
                } else if ($event == "SCAN") {//已关注用户通过扫描带参数二维码进入
                        $eventKey = $this->postObj->EventKey;
                        if (!empty($eventKey)) {
                                $this->contentStr = $eventKey;
                        } else {
                                exit;
                        }
                } else if ($event == "CLICK") {
                        $eventKey = $this->postObj->EventKey;
                        if ($eventKey == "ABOUT") {
                                $this->contentStr = "人人猎（www.renrenlie.com)是企业低成本极速直招平台，让企业一周内搞定招聘需求，为推荐人提供“人力资源”变现通道。\n";
                                $this->contentStr .= "人人猎由曾在百度、搜狐等知名互联网公司工作的资深互联网人士成立，已获2轮融资。目前已有近千家北京地区互联网公司入驻、近2万推荐人，绝大部分职位发布后一周内发出offer，是中国首家真正用互联网思维解决招聘瓶颈的知名招聘平台。";
                        }
                } else {
                        exit;
                }
                $resultStr = sprintf($this->textTpl, $this->fromUsername, $this->toUsername, $this->time, $this->msgType, $this->contentStr);
                echo $resultStr;
                exit;
        }

}

?>