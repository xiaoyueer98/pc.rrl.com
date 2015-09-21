<?php

namespace Home\Controller;

use Think\Controller;

/**
 * 上传简历 类文件 
 * 
 * @author      sunyue<1551058861@qq.com> 
 * @since       1.0 
 */
class UpresumeController extends Controller {

        Private $max_sms_number = 10;

        Public function __construct() {

                parent::__construct();
                $linkArr = M("friendlink")->where("status=0")->order("orderid desc,id asc")->select();
                $this->assign("linkArr", $linkArr);
                
        }

        /**
         * 上传简历页面
         * 
         * @access public 
         * @since 1.0 
         */
        function index() {
                
                //查看分享信息
                $arShare = D("ShareInfo")->get_info("share3");
                
                if(empty($arShare)){
                      $arShare['pcurl']  = "http://www.renrenlie.com/Home/Upresume/index.html";
                      $arShare['title']  = "人人猎-上传简历坐等收钱";
                      $arShare['desc'] = "HR和猎头的赚钱神器";
                      $arShare['img'] =  "http://www.renrenlie.com/Public/img/web_logo.png";
                }
                $this->assign("share",$arShare);
                $this->assign("domain", "http://www.renrenlie.com");
                $this->display("Active/upresume_info");
        }
        function  is_login(){
                
                //cookie中存取用户信息，在保存尽力信息时信息时如果有此信息，简历则为5状态
                setcookie("upload","1",time()+3600,"/");
                
                if($_SESSION['username']){
                        echo 1;
                }elseif($_SESSION['cusername']){
                        echo 2;
                }else{
                        setcookie("upresume", "1", time() + 3600, "/");
                        echo 3;
                }
        }

        /**
         * 上传简历页面(表单页面)
         * 
         * @access public 
         * @since 1.0 
         */
        function index_back() {
                header("location:/Home/Upresume/index_info");die;
                $this->display("Active/upresume");
        }

        /*
         * 发送手机验证码
         */

        function send_msg() {

                $mobile = $_POST['mobile'];
                if (empty($mobile)) {
                        echo json_encode(array("code" => 500, "msg" => "手机号异常"));
                        exit();
                }

                //查看该手机号今天短信发送次数是否过于频繁
                $smslogOb = M("sms_log");
                $today = strtotime(date("Y-m-d"));
                $sended = $smslogOb->where("mobile='" . $mobile . "'  and status=2 and created_at>" . $today)->count();

                if ($sended >= $this->max_sms_number) {
                        echo json_encode(array("code" => '400', "msg" => "该号码发送验证码过于频繁，请稍后再发"));
                        die;
                }

                //判断该用户是否已经是该系统用户
                $arMember = M()->query("select * from stj_member  m join stj_userinfo u where m.username=u.username and mobile='{$_POST['mobile']}' and flag=0");
                if (!empty($arMember)) {
                        echo json_encode(array("code" => "500", "msg" => "您已是系统用户,请登陆后,上传简历。"));
                        die;
                }
                //发送验证码并存入session和日志表中
                $send_code = getCode();
                $link_id = 0;
                $tag = "uploadresumecode";
                $comment = "上传简历坐等收钱验证码";
                $content = "您的短信验证码为" . $send_code . "，此验证码10分钟后过期，如非本人操作请忽略此条信息。若有疑问请咨询010-57188076。";
                if (!$_SESSION['up_leveltime']) {

                        $gets = oldSendMsg($mobile, $content, $link_id, $tag, $comment);
                        if ($gets['code'] == 200) {
                                $_SESSION["up_" . $mobile] = $send_code;
                                $_SESSION["up_mobile"] = $mobile;
                                $_SESSION['up_leveltime'] = time();
                                echo json_encode(array("code" => 200, "msg" => "获取验证码成功"));
                                die;
                        } else {
                                echo json_encode(array("code" => 500, "msg" => "系统繁忙"));
                                die;
                        }
                } elseif ((time() - $_SESSION['up_leveltime']) < 3) {  //小于3秒直接返回
                        echo json_encode(array("code" => 200, "msg" => $_SESSION["up_" . $mobile]));
                        exit();
                } else {

                        $gets = oldSendMsg($mobile, $content, $link_id, $tag, $comment);
                        if ($gets['code'] == 200) {
                                $_SESSION["up_" . $mobile] = $send_code;
                                $_SESSION["up_mobile"] = $mobile;
                                $_SESSION['up_leveltime'] = time();
                                echo json_encode(array("code" => 200, "msg" => "获取验证码成功"));
                                die;
                        } else {
                                echo json_encode(array("code" => 500, "msg" => "请您稍后再试"));
                                die;
                        }
                }
        }

        /*
         * 上传简历信息的验证和保存
         */

        function info_save() {

                //判断传过来的信息是否合法,包括验证码是否正确
                foreach ($_POST as $k => $v) {
                        $data[$k] = I("post." . $k);
                }
//                echo "<pre>";var_dump($data);echo "</pre>";
                if (empty($data['name']) || empty($data['mobile']) || empty($data['able_time']) || empty($data['verify']) || empty($data['want']) || empty($data['updateFile'])) {
                        echo json_encode(array("code" => "500", "msg" => "参数异常"));
                        die;
                }
                if ($_SESSION['up_' . $data['mobile']] != $data['verify']) {
                        echo json_encode(array("code" => "500", "msg" => "验证码不正确"));
                        die;
                }

                //判断是否是已有账号用户，不是则为其注册新用户，发送账号短信息
                $memberOb = M("member");
                $arMember = $memberOb->query("select * from stj_member  m join stj_userinfo u where m.username=u.username and mobile='{$_POST['mobile']}' and flag=0");
                if (empty($arMember)) {

                        //创建用户
                        $userOb = M("userinfo");
                        $username = $this->create_username($userOb);
                        $pwd = substr($_POST['mobile'], 5);
                        $user['password'] = md5(md5($pwd));
                        $user['username'] = $username;

                        $user['status'] = '1';
                        $user['flag'] = '0';

                        $card['username'] = $user['username'];
                        $card['cnname'] = $data['name'];
                        $card['password'] = $user['password'];
                        $card['pwd'] = $pwd;
                        $card['mobile'] = $_POST['mobile'];

                        $card['activation'] = 1;
                        $card['checkinfo'] = 'true';
                        $card['regip'] = $_SERVER["REMOTE_ADDR"];
                        $card['regtime'] = time();
                        $card['logintime'] = time();
                        $card['loginip'] = $_SERVER["REMOTE_ADDR"];
                        $card['fromwhere'] = "upresume";

                        $userOb->add($user);
                        $memberOb->add($card);
                        $memberId = $memberOb->getLastInsID();

                        //发送短信
                        $content = "您成功参与了人人猎上传简历坐等收钱活动，请用手机号登录，密码为手机号末六位。如有疑问，请联系010-57188076。";
                        $tag = "uploadresume";
                        $comment = "上传简历坐等收钱";
                        $linkid = $memberId;
                        oldSendMsg($_POST['mobile'], $content, $linkid, $tag, $comment);
                } else {
                        echo json_encode(array("code" => "500", "msg" => "您已是系统用户,请登陆后,上传简历。"));
                        die;
                }
                //保存信息到简历表中
                $resume['username'] = $data['name'];
                $resume['mobile'] = $data['mobile'];
                $resume['contact_time'] = $data['able_time'];
                $resume['keyword'] = $data['want'];
                $resume['wordname'] = $data['updateFile'];
                $resume['t_id'] = $memberId;
                $resume['keyid'] = getMillisecond();
                $resume['type'] = 5;
                $resume['other'] = $data['other'];
                $resume['posttime'] = time();

                //保存 
                if (!empty($data['updateFile']) && !empty($data['updatePath'])) {
                        $upload = array();
                        $upload['name'] = $data['updateFile'];
                        $upload['path'] = $_POST['updatePath'] . $_POST['updateFile'];
                        $upload['posttime'] = time();
                        M("uploads")->add($upload);
                }
                $_SESSION['up_' . $data['mobile']] = null;
                $re = M("resume")->add($resume);
//                var_dump($re);
//                echo M("customized")->getLastSql();

                echo json_encode(array("code" => "200", "msg" => "参与成功"));
                die;
        }

        /*
         * 生成上传简历坐等收钱用户名
         */

        function create_username($userOb, $username = "") {
                if (empty($username)) {
                        $username = "vp" . mt_rand(100000, 999999);
                }
                $arU = $userOb->where("username='{$username}'")->find();

                if (!empty($arU)) {
                        return $this->create_username($userOb, $username . "1");
                }

                return $username;
        }

}
