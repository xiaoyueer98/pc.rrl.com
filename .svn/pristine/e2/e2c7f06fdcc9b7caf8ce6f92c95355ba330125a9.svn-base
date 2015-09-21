<?php

namespace Home\Controller;

use Think\Controller;

class WebchatactiveController extends Controller {

        public function __construct() {
                //判断如果不是从微信端访问微信页面则跳转到对应端的首页
                from_to_weixin();
                parent::__construct();
        }

        public function wxredpackage() {

                ///////////////////////////////////////处理分享//////////////////////////////////////////////////////

                $shareUrl2 = rtrim($_GET['wxredshare'], ".html");

                if (!empty($shareUrl2)) {
                        $shareUrlBase = "http://www.renrenlie.com/Home/Webchatactive/wxredpackage";
                        $shareOb = M("share");
                        $decrypturl = $shareUrlBase."&wxredshare=".$shareUrl2;
                        $shareArr = $shareOb->where("decrypturl='{$decrypturl}'")->find();
                        if (!empty($shareArr)) {
                                $url = $shareArr['url'];
                                //$url = "http://www.renrenlie.com/Home/Webchatactive/wxredpackage&wxredtag=WxRedpackage&wxredchannel=WxShare&wxredaid=6&wxreduname=orHnYsxvHbeAPKObuSNPKJpchhTU";
                                $arUrl = explode("&", $url);
                                $shareUrl2 = array();
                                foreach ($arUrl as $u) {
                                        $au = explode("=", $u);
                                        $shareUrl2[$au[0]] = $au[1];
                                }

//                                $_SESSION['wxredurl'] = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                                $_SESSION['wxredurl'] = $decrypturl;
                                $_SESSION['wxredbackurl'] = $_SERVER['HTTP_REFERER'];
                                $_SESSION['wxredtag'] = $shareUrl2['wxredtag'];
                                $_SESSION['wxredchannel'] = $shareUrl2['wxredchannel'];
                                $_SESSION['wxredaid'] = $shareUrl2['wxredaid'];
                                $_SESSION['wxreduname'] = $shareUrl2['wxreduname'];
                        }
                }
//                var_dump($_SESSION);
                $this->display("./Webchat/activities4");
        }

       

}
