<?php

namespace Home\Controller;

use Think\Controller;

class WebchatloginController extends Controller {

        public function __construct() {
                //判断如果不是从微信端访问微信页面则跳转到对应端的首页
                from_to_weixin();
                parent::__construct();
        }

        /*
         * 登录(老版)
         */

        public function login_back() {

                $userinfo = $_COOKIE['userinfo'];
                $userArr = unserialize($userinfo);
                $uid = $userArr['userid'];
                $username = $userArr['username'];

                //得到跳转到的地址
                if (!empty($_COOKIE['gourl'])) {
                        $gourl = $_COOKIE['gourl'];
                } else {
                        $gourl = "/Home/Webchat/new_job.html";
                }

                if ($username) {
                        header('location:' . $gourl);
                } else {
                        $this->assign("gourl", $gourl);
                        $this->display("./Webchat/user_login");
                }
        }

        /*
         * 登录(新版)
         */

        public function login1() {

                $userinfo = $_COOKIE['userinfo'];
                $userArr = unserialize($userinfo);
                $uid = $userArr['userid'];
                $username = $userArr['username'];

                //得到跳转到的地址
                if (!empty($_COOKIE['gourl'])) {
                        $gourl = $_COOKIE['gourl'];
                } else {
                        $gourl = "/Home/Webchat/new_job.html";
                }

                if ($username) {
                        header('location:' . $gourl);
                } else {
                        $this->assign("gourl", $gourl);
                        $this->display("./Webchat/user_login_new1");
                }
        }

        /*
         * 登录(新版)
         */

        public function login() {

                $userinfo = $_COOKIE['userinfo'];
                $userArr = unserialize($userinfo);
                $uid = $userArr['userid'];
                $username = $userArr['username'];

                //得到跳转到的地址
                if (!empty($_COOKIE['gourl'])) {
                        $gourl = $_COOKIE['gourl'];
                } else {
                        $gourl = "/Home/Webchatnew/job_list.html";
                }

                if ($username) {
                        header('location:' . $gourl);
                } else {
                        $this->assign("gourl", $gourl);
                        $this->display("./Webchat/user_login_new");
                }
        }

        public function judge_login() {

                if ($_POST['type'] == 1) {

                        $data['username'] = I('post.username', '', 'htmlspecialchars');
                        $data['password'] = md5(md5(I('post.password', '', 'htmlspecialchars')));
                        $data['status'] = 1;
                        $data['is_deleted'] = 0;

                        $Userinfo = M("userinfo");
                        $userArr = $Userinfo->where($data)->find();

                        if ($userArr['userid'] > 0) {

                                if ($userArr['flag'] == "1") {
                                        echo json_encode(array("code" => 500, "msg" => "企业用户请选择PC登录"));
                                        die;
                                }

                                $User = D("Member"); // 实例化User对象
                                $check_user = $User->where("username='" . $data['username'] . "'")->find();

                                //修改登陆信息
                                $arUserLogin = array("logintime" => time(), "loginip" => $_SERVER["REMOTE_ADDR"]);
                                $User->where("id=" . $check_user['id'])->save($arUserLogin);

                                //写入cookie
                                setcookie("userinfo", serialize(array("userid" => $check_user['id'], "username" => $data['username'])), time() + 24 * 3600,"/");

                                echo json_encode(array("code" => 200, "msg" => "登录成功"));
                                die;
                        } else {
                                echo json_encode(array("code" => 500, "msg" => "用户名或密码错误"));
                                die;
                        }
                } elseif ($_POST['type'] == 2) {

                        $data['mobile'] = I('post.username', '', 'htmlspecialchars');
                        $data['password'] = md5(md5(I('post.password', '', 'htmlspecialchars')));

                        $arMember = M("member")->where("mobile='" . $data['mobile'] . "'")->find();
                        if (empty($arMember)) {
                                $arCompany = M("company")->where("mobile='" . $data['mobile'] . "'")->find();
                                if (!empty($arCompany)) {
                                        echo json_encode(array("code" => 500, "msg" => "企业用户暂不支持登陆"));
                                        die;
                                } else {
                                        echo json_encode(array("code" => 500, "msg" => "手机号或密码错误"));
                                        die;
                                }
                        } else {

                                $arUserinfo = M("userinfo")->where("username='" . $arMember['username'] . "'  and  is_deleted=0")->find();
                                if ($arUserinfo['password'] != $data['password']) {
                                        echo json_encode(array("code" => 500, "msg" => "手机号或密码错误"));
                                        die;
                                }
                                if ($arUserinfo['status'] == 0) {
                                        echo json_encode(array("code" => 500, "msg" => "该用户已冻结"));
                                        die;
                                }else {
                                        //修改登陆信息
                                        $arUserLogin = array("logintime" => time(), "loginip" => $_SERVER["REMOTE_ADDR"]);
                                        M("member")->where("id=" . $arMember['id'])->save($arUserLogin);

                                        //写进cookie
                                        setcookie("userinfo", serialize(array("userid" => $arMember['id'], "username" => $arMember['username'])), time() + 24 * 3600,"/");

                                        echo json_encode(array("code" => 200, "msg" => "登陆成功"));
                                        die;
                                }
                        }
                }
        }

        /*
         * 测试方法，代替上面方法
         */

        public function judge_login1() {



                $data['username'] = I('post.username', '', 'htmlspecialchars');
                $data['password'] = md5(md5(I('post.password', '', 'htmlspecialchars')));


                $User = D("Member"); // 实例化User对象
                $check_user = $User->where($data)->find();
                echo "<pre>";
                var_dump($check_user);
                echo "</pre>";
                echo $check_user->getLastSql();
                if ($check_user['id'] > 0) {
                        $Userinfo = M("userinfo");
                        $isCompanyArr = $Userinfo->where("username='" . $data['username'] . "' and flag=1")->find();
                        if (!empty($isCompanyArr)) {
                                echo json_encode(array("code" => 500, "msg" => "企业用户暂不支持登陆"));
                                die;
                        }

                        setcookie("userinfo", serialize(array("userid" => $check_user['id'], "username" => $data['username'])), time() + 24 * 3600);
                        echo json_encode(array("code" => 200, "msg" => "登陆成功"));
                        die;
                } else {
                        echo json_encode(array("code" => 500, "msg" => "用户名或密码错误"));
                        die;
                }
        }

        /*
         * 退出登录
         */

        public function logout() {
                //print_r($data);
                //session_destroy();
                setcookie("userinfo", "", time()-1,"/");
                header("location:/Home/Webchatlogin/login");
                die();
        }

}
