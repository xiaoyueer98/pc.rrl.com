<?php 

namespace Home\Controller;

use Think\Controller;

/**
 * 私人定制 类文件 
 * 
 * @author      sunyue<1551058861@qq.com> 
 * @since       1.0 
 */
class CustomizedController extends Controller {
      
        Private $max_sms_number = 10;

        Public function __construct() {

                parent::__construct();
                $linkArr = M("friendlink")->where("status=0")->order("orderid desc,id asc")->select();
                $this->assign("linkArr", $linkArr);
                
        }

        /**
         * 私人定制页面  
         * 
         * @access public 
         * @since 1.0 
         */
        function index() {
                //查看分享信息
                $arShare = D("ShareInfo")->get_info("share1");
                
                if(empty($arShare)){
                      $arShare['pcurl']  = "http://www.renrenlie.com/Home/Customized/index.html";
                      $arShare['title']  = "人人猎-高薪工作机会的“私人订制“";
                      $arShare['desc'] = "人人猎--您最可靠的私人求职顾问";
                      $arShare['img'] =  "http://www.renrenlie.com/Public/img/web_custom.png";
                }
                $this->assign("share",$arShare);
                $this->assign("domain", "http://www.renrenlie.com");
                
                $this->display("Active/custom");
        }

        /*
         * 发送手机验证码
         */

        function send_msg() {

                if($_POST['hash'] != md5("rrl_".$_SESSION['cookie'])){
                        return;
                }
                
                $mobile = $_POST['mobile'];
                if(empty($mobile)){
                        echo json_encode(array("code" => 500, "msg" => "手机号异常"));
                        exit();
                }

                //查看该手机号今天短信发送次数是否过于频繁
                $smslogOb = M("sms_log");
                $today = strtotime(date("Y-m-d"));
                $sended = $smslogOb->where("mobile='" . $mobile . "'  and status=2 and created_at>" . $today)->count();

                if ($sended >= $this->max_sms_number) {
                        echo json_encode(array("code" => '400', "msg" => "该号码发送验证码过于频繁，请稍后再发"));die;
                }
                //判断该用户是否已经参与过私人定制
                $arCustom = M("customized")->where("mobile='{$mobile}' and telestatus<3")->find();
                if(!empty($arCustom)){
                      echo json_encode(array("code" => "500", "msg" => "您已经完成过私人定制"));die;  
                }
                //发送验证码并存入session和日志表中
                $send_code = getCode();
                $link_id = 0;
                $tag = "customized";
                $comment = "私人定制";
                $content = "您的短信验证码为" . $send_code . "，此验证码10分钟后过期，如非本人操作请忽略此条信息。若有疑问请咨询010-57188076。";
                if (!$_SESSION['cus_leveltime']) {

                        $gets = smsChannel($mobile, $content, $link_id, $tag, $comment);
                        if ($gets['code'] == 200) {
                                $_SESSION["cus_" . $mobile] = $send_code;
                                $_SESSION["cus_mobile"] = $mobile;
                                $_SESSION['cus_leveltime'] = time();
                                echo json_encode(array("code" => 200, "msg" => "获取验证码成功"));die;
                        } else {
                                echo json_encode(array("code" => 500, "msg" => "系统繁忙"));die;
                        }
                } elseif ((time() - $_SESSION['cus_leveltime']) < 3) {  //小于3秒直接返回
                        echo json_encode(array("code" => 200, "msg" => $_SESSION["cus_" . $mobile]));
                        exit();
                } else {

                        $gets = smsChannel($mobile, $content, $link_id, $tag, $comment);
                        if ($gets['code'] == 200) {
                                $_SESSION["cus_" . $mobile] = $send_code;
                                $_SESSION["cus_mobile"] = $mobile;
                                $_SESSION['cus_leveltime'] = time();
                                echo json_encode(array("code" => 200, "msg" => "获取验证码成功"));die;
                        } else {
                                echo json_encode(array("code" => 500, "msg" => "请您稍后再试"));die;
                        }
                }
        }

        /*
         * 定制信息的验证和保存
         */

        function info_save() {

                //判断传过来的信息是否合法,包括验证码是否正确
                foreach ($_POST as $k => $v) {
                        $data[$k] = I("post." . $k);
                }
//                echo "<pre>";var_dump($data);echo "</pre>";
                if (empty($data['name']) || empty($data['mobile']) || empty($data['able_time']) || empty($data['verify']) || empty($data['want'])) {
                        echo json_encode(array("code" => "500", "msg" => "参数异常"));die;
                }
                if ($_SESSION['cus_' . $data['mobile']] != $data['verify']) {
                        echo json_encode(array("code" => "500", "msg" => "验证码不正确"));die;
                }
                //判断该用户是否已经参与过私人定制
                $arCustom = M("customized")->where("mobile='{$data['mobile']}' and telestatus<3")->find();
                if(!empty($arCustom)){
                      echo json_encode(array("code" => "200", "msg" => "定制成功"));die;  
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
                        $card['fromwhere'] = "customized";
                        
                        $userOb->add($user);
                        $memberOb->add($card);
                        $memberId = $memberOb->getLastInsID();
                        
                        //发送短信
                        $content = "您成功在人人猎完成了工作机会的私人订制，请用手机号登录，密码为手机号末六位。如有疑问，请联系010-57188076。";
                        $tag = "customized";
                        $comment = "私人定制";
                        $linkid = $memberId;
                        smsChannel($_POST['mobile'], $content, $linkid, $tag, $comment);
                       
                        
                }else{
                        $username = $arMember[0]['username'];
                        $memberId = $arMember[0]['id'];
                        
                        $memberOb->save(array("id"=>$memberId,"cnname"=>$data['name'])); 
                        
                }
                //保存信息到私人定制表中
                $custom['name']= $data['name'];
                $custom['mobile']= $data['mobile'];
                $custom['contact_time']= $data['able_time'];
                $custom['jobwant']= $data['want'];
                $custom['uid']= $memberId;
                $custom['username']= $username;
                $custom['created_at'] = $custom['updated_at'] = time();
                
                $_SESSION['cus_' . $data['mobile']] = null;
                $re = M("customized")->add($custom);
//                var_dump($re);
//                echo M("customized")->getLastSql();
                
                echo json_encode(array("code" => "200", "msg" => "定制成功"));die;
                
        }
        /*
         * 生成私人定制用户名
         */
        function create_username($userOb, $username = "")
        {
                if (empty($username))
                {
                        $username = "vip" . mt_rand(100000, 999999);
                }
                $arU = $userOb->where("username='{$username}'")->find();

                if (!empty($arU))
                {
                        return $this->create_username($userOb, $username . "1");
                }

                return $username;
        }


}
