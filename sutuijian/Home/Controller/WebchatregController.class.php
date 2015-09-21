<?php

namespace Home\Controller;

use Think\Controller;

class WebchatregController extends Controller {

        private $max_sms_number = 10;   //每个手机号一天允许发送的短信数量
        private $target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit";   //短信通道的地址
        private $sms_account = "account=cf_zpkj&password=cf_zpkj&";
        private $mobile_by_url = "http://tcc.taobao.com/cc/json/mobile_tel_segment.htm";

        public function __construct() {
                //判断如果不是从微信端访问微信页面则跳转到对应端的首页
                from_to_weixin();
                parent::__construct();
        }

        /*
         * 注册xin
         */

        public function reg() {

                $userinfo = $_COOKIE['userinfo'];
                $userArr = unserialize($userinfo);
                $uid = $userArr['userid'];

                if ($uid) {
                        header("location:/Home/Webchat/new_job");
                        exit;
                } else {
                        $this->display("./Webchat/user_reg_new_wxred");
                }
        }

        /*
         * 注册验证成功后跳转页面
         */

        public function reg_redirect() {
                //session_start();
                //var_dump($_SESSION);
                $mobile = $_SESSION['mobile'];
                //$mobile = "15201273050";
                if (empty($mobile)) {
                        //header("location:/Home/Webchat/new_job");
                        echo "<div>请通过正常途径访问，<a href='/Home/Webchat/new_job'>点击</a>回到最新职位页面</div>";
                        die;
                }
                unset($_SESSION['mobile']);
                unset($_SESSION['m' . $mobile]);
                unset($_SESSION['leveltime']);

                $html.="<form action='/Home/Webchatreg/reg_info' method='post' name='pwd'><input type='hidden' name='mobile' value='" . $mobile . "'></form>";
                $html.="<script>document.forms['pwd'].submit();</script>";
                echo $html;
        }

        /*
         * 注册xin
         */

        public function reg_info() {

                $userinfo = $_COOKIE['userinfo'];
                $userArr = unserialize($userinfo);
                $uid = $userArr['userid'];
                if ($uid) {
                        header("location:/Home/Webchat/new_job");
                        exit;
                } else {
                        $mobile = $_POST['mobile'];
                        if (empty($mobile)) {
                                echo "<div>请通过正常途径访问，<a href='/Home/Webchat/new_job'>点击</a>回到最新职位页面</div>";
                                die;
                        }
                        $this->assign("mobile", $mobile);
                        $this->display("./Webchat/user_reg_info_wxred");
                }
        }

        /*
         * 保存注册信息
         */

        public function reg_save() {

                if (empty($_POST['username']) || empty($_POST['mobile']) || empty($_POST['password'])) {
                        echo json_encode(array("code" => "500", "msg" => "参数错误"));
                        exit;
                }

                $rules = array(
                    array('username', 'require', '帐号必须填写'), //默认情况下用正则进行验证
                    array('password', 'require', '密码必须填写'),
                    array('username', '', '帐号名称已经存在！', 0, 'unique', 1), // 在新增的时候验证name字段是否唯一
                );


                $Userinfo = D("Userinfo");
                //echo "<pre>";var_dump($Userinfo);echo "</pre>";
                $member = D("Member");

                $data['password'] = md5(md5($_POST['password']));
                $data['username'] = $_POST['username'];
                $data['status'] = '1';
                $data['flag'] = '0';

                $card['username'] = $data['username'];
                $card['password'] = $data['password'];
                $card['pwd'] = $_POST['password'];
                $card['mobile'] = $_POST['mobile'];

                $card['activation'] = 1;
                $card['checkinfo'] = 'true';
                $card['regip'] = $_SERVER["REMOTE_ADDR"];
                $card['regtime'] = time();
                $card['logintime'] = time();
                $card['loginip'] = $_SERVER["REMOTE_ADDR"];

                //得到活动相关信息
                $actOb = M("active");
                $actArr = $actOb->where("id=" . C('WX_REDPACKAGE_ID'))->find();
                //得到该活动已发出多少钱
                $countMoney = M("redpackage_log")->where("status<2 and activeid = '" . C('WX_REDPACKAGE_ID') . "'")->sum("money");
                if (empty($countMoney)) {
                        $countMoney = 0;
                }
//                var_dump($countMoney);echo "<br/>";
                session_start();
                $is_wxredpackage = false; //初始设定  红包活动关闭
                if (C('WX_REDPACKAGE_OPEN') && date("Y-m-d H:i:s") > $actArr['starttime'] && date("Y-m-d H:i:s") < $actArr['endtime'] && C('WX_REDPACKAGE_COUNT') > $countMoney) {
                        $is_wxredpackage = true;  //符合以上情况 红包活动开启
                        $card['fromwhere'] = "wx注册领取微信现金红包";
                } else if ($_SESSION['qrcodefrom']) {
                        if ($_SESSION['qrcodefrom'] == "1") {
                                $card['fromwhere'] = "车套扫码进入微信";
                        } else {
                                $card['fromwhere'] = "weixin_reg";
                        }
                } else {
                        $card['fromwhere'] = "weixin_reg";
                }
//                var_dump($is_wxredpackage);echo "<br/>";  
//                var_dump(C('WX_REDPACKAGE_OPEN'));
//                var_dump(date("Y-m-d H:i:s") > $actArr['starttime']);
//                var_dump(date("Y-m-d H:i:s") < $actArr['endtime']);
//                var_dump(C('WX_REDPACKAGE_COUNT'));
//                echo "<br/>"; 
                //判断该用户名中是否包含  wx_,qq_,renren_,sina_
                if (strpos($_POST['username'], "qq_") === 0 || strpos($_POST['username'], "wx_") === 0 || strpos($_POST['username'], "renren_") === 0 || strpos($_POST['username'], "sina_") === 0) {
                        echo json_encode(array("code" => "500", "msg" => "用户名已存在"));
                        die;
                }
                if (!$Userinfo->validate($rules)->create($_POST)) {
                        // 如果创建失败 表示验证没有通过 输出错误提示信息
                        echo json_encode(array("code" => "500", "msg" => $Userinfo->getError()));
                        die;
                } else {
                        //如果输入邀请码，则判断邀请码是否存在
                        $invitecode = strtolower($_POST['invitecode']);
                        if (!empty($invitecode)) {
                                $shareOb = M("share");
                                $shareArr = $shareOb->where("activeid='" . C('WX_REDPACKAGE_ID') . "' and comment='{$invitecode}' and status=1")->find();
                                if (empty($shareArr)) {
                                        echo json_encode(array("code" => "500", "msg" => "邀请码不存在"));
                                        die;
                                }
                        }


                        // 验证通过 可以进行其他数据操作
                        $user_result = $Userinfo->add($data);

                        if ($user_result) {
                                $member_result = $member->add($card);
                                $memberArr = $member->where("username='" . $data['username'] . "'")->order("id desc")->find();
                                setcookie("userinfo", serialize(array("userid" => $memberArr['id'], "username" => $data['username'])), time() + 24 * 3600);

                                //判断该用户是否是北京用户
                                $is_bj = $this->is_beijing($_POST['mobile']);

//                                var_dump("bejing:".$is_bj);echo "<br/>";
//                                echo "<pre>";var_dump($_SESSION);echo "</pre>";

                                if ($is_wxredpackage && $is_bj && $_SESSION['wxredtag'] == "WxRedpackage" && $_SESSION['wxredaid'] == C('WX_REDPACKAGE_ID') && $_SESSION['wxreduname']) {
//                                        echo "1";"<br/>";
                                        //插入一条数据到 红包日志中 状态为未发
                                        //得到对应的分享记录
                                        $decrypturl = $_SESSION['wxredurl'];
                                        $shareArr = M("share")->where("decrypturl='" . $decrypturl . "'")->find();
                                        if (empty($shareArr)) {
                                                echo json_encode(array("code" => "200", "msg" => "注册成功"));
                                                die;
                                        }
//                                        echo M("share") -> getLastSql();echo "<br/>";
//                                        echo "<pre>";var_dump($shareArr);echo "</pre>";
                                        //得到红包订单号
                                        $redwxconOb = new RedpackagewxController();
                                        $billno = $redwxconOb->getOrderID();

                                        $redlog = M("redpackage_log");
                                        $redlogdata['uid'] = $shareArr['uid'];
                                        $redlogdata['username'] = $shareArr['username'];
                                        $redlogdata['openid'] = $_SESSION['wxreduname'];
                                        $redlogdata['sendname'] = C('WX_REDPACKAGE_SEND_NAME');
                                        $redlogdata['nickname'] = C('WX_REDPACKAGE_NICK_NAME');
                                        $redlogdata['activeid'] = $_SESSION['wxredaid'];
                                        $redlogdata['activename'] = $actArr['activename'];
                                        $redlogdata['wishing'] = $actArr['content'];
                                        $redlogdata['money'] = C('WX_REDPACKAGE_TOTAL_AMOUNT') / 100;
                                        $redlogdata['maxvalue'] = C('WX_REDPACKAGE_MAX_VALUE');
                                        $redlogdata['minvalue'] = C('WX_REDPACKAGE_MIN_VALUE');
                                        $redlogdata['billno'] = $billno;
                                        $redlogdata['totalnum'] = C('WX_REDPACKAGE_TOTAL_NUM');
                                        $redlogdata['comment'] = C('WX_REDPACKAGE_REMARK');
                                        $redlogdata['status'] = "0";
                                        $redlogdata['tag'] = "1";
                                        $redlogdata['linkid'] = $memberArr['id'];
                                        $redlogdata['created_at'] = $redlogdata['updated_at'] = time();

                                        $redreuslt = $redlog->add($redlogdata);
//                                        echo $redlog->getLastSql();die;

                                        $_SESSION['wxredurl'] = null;
                                        $_SESSION['wxredbackurl'] = null;
                                        $_SESSION['wxredtag'] = null;
                                        $_SESSION['wxredchannel'] = null;
                                        $_SESSION['wxredaid'] = null;
                                } else if ($is_wxredpackage && $is_bj && !empty($invitecode)) {

//                                        echo "2";"<br/>";
                                        //插入一条数据到 红包日志中 状态为未发
                                        $url = $shareArr['url'];

                                        $urlArr = explode("&", $url);

                                        foreach ($urlArr as $k => $v) {
                                                $vArr = explode("=", $v);
                                                $infoArr[$vArr[0]] = $vArr[1];
                                        }

//                                        echo "<pre>";var_dump($infoArr);echo "</pre>";
                                        //得到活动相关信息
                                        $actOb = M("active");
                                        $actArr = $actOb->where("id={$shareArr['activeid']}")->find();

//                                        echo "<pre>";var_dump($infoArr);echo "</pre>";
                                        //得到红包订单号
                                        $redwxconOb = new RedpackagewxController();
                                        $billno = $redwxconOb->getOrderID();

                                        $redlog = M("redpackage_log");
                                        $redlogdata['uid'] = $shareArr['uid'];
                                        $redlogdata['username'] = $shareArr['username'];
                                        $redlogdata['openid'] = $infoArr['wxreduname'];
                                        $redlogdata['sendname'] = C('WX_REDPACKAGE_SEND_NAME');
                                        $redlogdata['nickname'] = C('WX_REDPACKAGE_NICK_NAME');
                                        $redlogdata['activeid'] = $shareArr['activeid'];
                                        $redlogdata['activename'] = $shareArr['activename'];
                                        $redlogdata['wishing'] = $actArr['content'];
                                        $redlogdata['money'] = C('WX_REDPACKAGE_TOTAL_AMOUNT') / 100;
                                        $redlogdata['maxvalue'] = C('WX_REDPACKAGE_MAX_VALUE');
                                        $redlogdata['minvalue'] = C('WX_REDPACKAGE_MIN_VALUE');
                                        $redlogdata['billno'] = $billno;
                                        $redlogdata['totalnum'] = C('WX_REDPACKAGE_TOTAL_NUM');
                                        $redlogdata['comment'] = C('WX_REDPACKAGE_REMARK');
                                        $redlogdata['status'] = "0";
                                        $redlogdata['tag'] = "2";
                                        $redlogdata['linkid'] = $memberArr['id'];
                                        $redlogdata['created_at'] = $redlogdata['updated_at'] = time();

                                        $redreuslt = $redlog->add($redlogdata);
//                                        echo $redlog->getLastSql();die;
                                }

                                if (!empty($_SESSION['qrcodefrom'])) {

                                        $_SESSION['qrcodefrom'] = null;
                                }
                                echo json_encode(array("code" => "200", "msg" => "注册成功"));
                                die;
                        } else {
                                echo json_encode(array("code" => "500", "msg" => "注册失败"));
                                die;
                        }
                }
        }

        /*
         * 修改密码第一步------填写手机号获取验证码
         */

        public function forget_password() {

                $userinfo = $_COOKIE['userinfo'];
                $userArr = unserialize($userinfo);
                $uid = $userArr['userid'];

                if ($uid) {
                        header("location:/Home/Webchat/new_job");
                        exit;
                } else {
                        $this->display("./Webchat/forget_password");
                }
        }

        /*
         * 新的短信接口发送短信
         */

        public function forget_mobile() {
                if($_POST['hash'] != md5("rrl_".$_SESSION['cookie'])){
                        return;
                }
                
                $type = $_POST['type'];
                $mobile = $_POST['mobile'];


                if ($type == 1) {
                        //查看该手机号是否已注册
                        $memberOb = M("member");


                        $mobileArr1 = $memberOb->query("select * from stj_member  m join stj_userinfo u where m.username=u.username and mobile='{$mobile}' and flag=0");
                        $mobileArr = $mobileArr1[0];
                        if (empty($mobileArr)) {
                                echo json_encode(array("code" => '400', "msg" => "该手机未注册"));
                                die;
                        } 
                } else {
                        //查看该手机号是否已注册
                        $memberOb = M("member");
                        //$mobileArr = $memberOb->where("mobile='" . $mobile . "'")->find();
                        $mobileArr = $memberOb->query("select * from stj_member  m join stj_userinfo u where m.username=u.username and mobile='{$mobile}' and flag=0");
                        $mobileArr = $mobileArr[0];
                        if (!empty($mobileArr)) {
                                echo json_encode(array("code" => '400', "msg" => "该手机已注册"));
                                die;
                        }
                        $mobileArr['id'] = 0;
                }
                //查看该手机号今天短信发送次数是否过于频繁
                $smslogOb = M("sms_log");
                $today = strtotime(date("Y-m-d"));
                $sended = $smslogOb->where("mobile='" . $mobile . "'  and status=2 and created_at>" . $today)->count();

                if ($sended >= $this->max_sms_number) {
                        echo json_encode(array("code" => '400', "msg" => "该号码发送验证码过于频繁，请稍后再发"));
                        die;
                }

                //发送验证码并存入session和日志表中
                $code = $this->getCode();
                $send_code = $code;

                if ($type == 1) {
                        $link_id = $mobileArr['id'];
                        $tag = "weixinforgetpassword";
                        $comment = "微信忘记密码";
                        $content = "您申请重置密码的验证码为" . $send_code . "，10分钟内有效，如非本人操作请忽略此条信息或咨询010-57188076。";
                } else {
                        $link_id = $mobileArr['id'];
                        $tag = "weixinreg";
                        $comment = "微信注册";
                        $content = "您申请成为renrenlie.com推荐人用户的验证码为" . $send_code . "，10分钟内有效，如非本人操作请忽略此条信息或咨询010-57188076。";
                }


                if (!$_SESSION['leveltime']) {
                        $gets = smsChannel($mobile, $content, $link_id, $tag, $comment);
                        if ($gets['code'] == 200) {
                                $_SESSION["m" . $mobile] = $send_code;
                                $_SESSION["mobile"] = $mobile;
                                $_SESSION['leveltime'] = time();
                                echo json_encode(array("code" => 200, "msg" => "获取验证码成功"));
                        } else {
                                echo json_encode(array("code" => 500, "msg" => "系统繁忙"));
                        }
                } elseif ((time() - $_SESSION['leveltime']) < 5*60) {

                        echo json_encode(array("code" => 200, "msg" => $_SESSION["m" . $mobile]));
                        exit();
                } else {

                        $gets = smsChannel($mobile, $content, $link_id, $tag, $comment);
                        if ($gets['code'] == 200) {
                                $_SESSION["m" . $mobile] = $send_code;
                                $_SESSION["mobile"] = $mobile;
                                $_SESSION['leveltime'] = time();
                                echo json_encode(array("code" => 200, "msg" => "获取验证码成功"));
                        } else {
                                echo json_encode(array("code" => 500, "msg" => "系统繁忙"));
                        }
                }
        }

        /*
         * 验证输入的验证码和发送的验证码是否相同
         */

        public function checkVerify() {

                $type = $_POST['type'];
                $mobile = $_POST['mobile'];
                $verify = $_POST['verify'];
                if (empty($type) || empty($mobile) || empty($verify)) {
                        echo json_encode(array("code" => 500, "msg" => "验证失败"));
                        exit();
                }

                //session_start();
                //var_dump($_SESSION);
                if ($_SESSION["m" . $mobile] == $verify) {
                        echo json_encode(array("code" => 200, "msg" => "验证成功"));
                        exit();
                } else {
                        echo json_encode(array("code" => 500, "msg" => "验证码不正确"));
                        exit();
                }
        }

        /*
         * 重置密码验证成功后跳转页面
         */

        public function forget_pwd_redirect() {
                //session_start();
                //var_dump($_SESSION);
                $mobile = $_SESSION['mobile'];
                $mOb = M("member");
                $mobileArrAll = $mOb->query("select m.* from stj_member  m join stj_userinfo u where m.username=u.username and mobile='{$mobile}' and flag=0 ");
                $usernamestr = "";
                foreach ($mobileArrAll as $k => $v) {
                        if($v['fromwhere'] == "qq"){
                                 $usernamestr .= " , qq用户";
                        }elseif($v['fromwhere'] == "weixin"){
                                 $usernamestr .= " , 微信用户";
                        }elseif($v['fromwhere'] == "sina"){
                                 $usernamestr .= " , 新浪用户";
                        }elseif($v['fromwhere'] == "renren"){
                                 $usernamestr .= " , 人人用户";
                        }else{
                                 $usernamestr .= " , " . $v['username'];
                        }
                }
                $username = substr($usernamestr, 3);

                if (empty($mobile)) {
                        //header("location:/Home/Webchat/new_job");
                        echo "<div>请通过正常途径访问，<a href='/Home/Webchat/new_job'>点击</a>回到最新职位页面</div>";
                        die;
                }
                unset($_SESSION['mobile']);
                unset($_SESSION['m' . $mobile]);
                unset($_SESSION['leveltime']);

                $html.="<form action='/Home/Webchatreg/reset_password' method='post' name='pwd'><input type='hidden' name='mobile' value='" . $mobile . "'><input type='hidden' name='username' value='" . $username . "'></form>";
                $html.="<script>document.forms['pwd'].submit();</script>";
                echo $html;
        }

        /*
         * 修改密码第二步-----重置密码
         */

        public function reset_password() {

                $userinfo = $_COOKIE['userinfo'];
                $userArr = unserialize($userinfo);
                $uid = $userArr['userid'];
                if ($uid) {
                        header("location:/Home/Webchat/new_job");
                        exit;
                }
                $mobile = $_POST['mobile'];
                $username = $_POST['username'];
                if (empty($mobile)) {
                        echo "<div>请通过正常途径访问，<a href='/Home/Webchat/new_job'>点击</a>回到最新职位页面</div>";
                        die;
                }

                $this->assign("username", $username);
                $this->assign("mobile", $mobile);
                $this->display("./Webchat/reset_password");
        }

        /*
         * 保存密码
         */

        public function password_save() {
                $mobile = $_POST['mobile'];
                $pwd = $_POST['password'];
                $password = md5(md5($pwd));
                if (empty($mobile)) {
                        echo json_encode(array("code" => 500, "msg" => "参数异常"));
                        die;
                }
                $mobileArrAll = M("member")->query("select * from stj_member  m join stj_userinfo u where m.username=u.username and mobile='{$mobile}' and flag=0  ");
                $memArrs = $mobileArrAll;

                if (empty($memArrs)) {
                        echo json_encode(array("code" => 500, "msg" => "该用户不存在"));
                        exit();
                }
                foreach ($memArrs as $memArr) {
                        M("member")->query("update stj_member set password='{$password}',pwd='{$pwd}' where id={$memArr['id']}");
                        M("userinfo")->query("update stj_userinfo set password='{$password}' where username='{$memArr['username']}' and flag=0");
                }

                echo json_encode(array("code" => 200, "msg" => "修改成功"));
                exit();
        }

        function getCode($num = 6) {
                $randStr = str_shuffle('1234567890');
                $rand = substr($randStr, 0, 6);
                return $rand;
        }

        function Post($curlPost, $url) {
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_HEADER, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_NOBODY, true);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
                $return_str = curl_exec($curl);
                curl_close($curl);
                return $return_str;
        }

        function xml_to_array($xml) {
                $reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
                if (preg_match_all($reg, $xml, $matches)) {
                        $count = count($matches[0]);
                        for ($i = 0; $i < $count; $i++) {
                                $subxml = $matches[2][$i];
                                $key = $matches[1][$i];
                                if (preg_match($reg, $subxml)) {
                                        $arr[$key] = $this->xml_to_array($subxml);
                                } else {
                                        $arr[$key] = $subxml;
                                }
                        }
                }
                return $arr;
        }

        /*
         * 判断用户是否是北京用户
         */

        function is_beijing($mobile) {

                $mobielUrl = $this->mobile_by_url . "?tel=" . $mobile;
                $content = file_get_contents($mobielUrl);
                $json = iconv('GBK', 'UTF-8', $content);
                $jsonArr = explode(",", $json);
                $areaStr = $jsonArr[1];
                $areaArr = explode(":", $areaStr);

                if (str_replace("'", "", $areaArr[1]) == "北京") {
                        return true;
                } else {
                        return false;
                }
        }

}
