<?php
include_once("active.php");
define("TOKEN", "wxrenrenlie");
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
//                        if (strpos($eventKey, "qrscene_") !== false) {//未关注用户通过扫描带参数二维码进入
//                                $eventKey = substr($eventKey,8);
//                                if(trim($eventKey) === "1"){
//                                     $ob = new Active();
//                                     $ob -> doQrcode1($this->fromUsername,"1");
//                                     exit;
//                                }
//                        } else {
                                $this->contentStr = "\t人人猎 是中国最有效的优质互联网创业企业人才极速直招平台。她让企业在 7 天内搞定招聘需求、招到靠谱的人；既让猎头、HR、知名公司的面试官等推荐人暂不使用的简历得以轻松变现，又让中高端候选人快速找到匹配的工作。\n";
                                $this->contentStr .= "\t人人猎 核心团队由来自百度、搜狐等知名互联网公司的互联网资深人士，及有10多年猎头从业经验的人才招聘行业专家组成。\n";
                                $this->contentStr .= "\t人人猎 成立之初，相继获得知名投资人的种子资金和天使轮投资。人人猎以“简单、诚实、可靠”为企业理念，以“避免互联网创业企业长久招不到靠谱的人而受损失，帮助候选人加入最匹配的团队，让猎头和HR等推荐人的每个面试都有现金回报”为宗旨，以追求“极佳效果和服务”为始终如一的目标。\n";
                                $this->contentStr .= "\t参与线下活动注册：http://m.renrenlie.com/index.php?s=Active/reg";
//                        }
                } else if ($event == "SCAN") {//已关注用户通过扫描带参数二维码进入
                       
                        $eventKey = $this->postObj->EventKey;
                        if (!empty($eventKey)) {
                                if(trim($eventKey) === "1"){
                                     $ob = new Active();
                                     $ob -> doQrcode1($this->fromUsername,"2"); 
                                     exit;
                                }
                        } else {
                                exit;
                        }
                } else if ($event == "CLICK") {
                        $eventKey = $this->postObj->EventKey;
                        if ($eventKey == "ABOUT") {
                                $this->contentStr = "\t人人猎 是中国最有效的优质互联网创业企业人才极速直招平台。她让企业在 7 天内搞定招聘需求、招到靠谱的人；既让猎头、HR、知名公司的面试官等推荐人暂不使用的简历得以轻松变现，又让中高端候选人快速找到匹配的工作。\n";
                                $this->contentStr .= "\t人人猎 核心团队由来自百度、搜狐等知名互联网公司的互联网资深人士，及有10多年猎头从业经验的人才招聘行业专家组成。\n";
                                $this->contentStr .= "\t人人猎 成立之初，相继获得知名投资人的种子资金和天使轮投资。人人猎以“简单、诚实、可靠”为企业理念，以“避免互联网创业企业长久招不到靠谱的人而受损失，帮助候选人加入最匹配的团队，让猎头和HR等推荐人的每个面试都有现金回报”为宗旨，以追求“极佳效果和服务”为始终如一的目标。";
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