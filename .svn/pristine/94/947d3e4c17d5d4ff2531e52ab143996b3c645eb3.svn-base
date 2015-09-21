<?php

namespace Home\Controller;

use Think\Controller;

class RedpackageController extends Controller {

        public function __construct() {
                //判断如果不是从微信端访问微信页面则跳转到对应端的首页
                from_to_weixin();
                parent::__construct();
        }

        /*
         * 发放红包页面
         */

        public function redpackage() {

                header("location:/Home/Webchatactive/wxredpackage");
                //得到用户信息
                $userinfo = $_COOKIE['userinfo'];
                if (empty($userinfo)) {
                        setcookie("gourl", "/Home/Redpackage/redpackage");
                        header("location:/Home/Webchatlogin/login");
                        die;
                }
                setcookie("gourl", "");
                $this->display("./Webchat/redpackage");
        }

        /*
         * 领取红包页面
         */

        public function redpackage_end() {

                //得到用户信息
                $userinfo = $_COOKIE['userinfo'];
                if (empty($userinfo)) {
                        header("location:/Home/Webchat/new_job");
                        die;
                }
                $money = $_GET['mo'];
                $this->assign("money", $money);
                $this->display("./Webchat/redpackage_end");
        }

        /*
         * 领取红包
         */

        public function get_redpackage() {
                //得到用户信息
                $userinfo = unserialize($_COOKIE['userinfo']);
                if (empty($userinfo)) {
                        echo json_encode(array("code" => "500", "msg" => "未登录"));
                        die;
                }
                $username = $userinfo['username'];
                $userOb = M("userinfo");
                $userArr = $userOb->where("username='{$username}'")->find();
                $userid = $userArr['userid'];

                //查看此次红包活动信息
                $redAId = C("RED_PACKAGE_ID");
                $redActiveOb = M("active");
                $redActiveArr = $redActiveOb->where("id = {$redAId}")->find();

                $activeStart = $redActiveArr['starttime']; //活动开始时间
                $activeEnd = $redActiveArr['endtime']; //活动截止时间
                //判断该用户是否符合领取红包的条件
                $memArr = M("member")->where("username ='" . $username . "'")->find();
                if ($memArr['regtime'] < strtotime($activeStart) || $memArr['regtime'] > strtotime($activeEnd)) {
                        echo json_encode(array("code" => "500", "msg" => "您不符合领取红包的条件哦~"));
                        die;
                }
                //查看该用户是否已经领取过红包
                $redLogOb = M("redpackage_log");
                $isGet = $redLogOb->where("username='{$username}' and uid='{$userid}' and status=1 and activeid='{$redAId}' ")->find();
                if (!empty($isGet)) {
                        echo json_encode(array("code" => "500", "msg" => "您已经领取过红包了~"));
                        die;
                }

                //查看红包日志中此次活动已领取总额
                $countMoney = $redLogOb->where("activeid='{$redAId}' and status=1")->sum('money');
                if (empty($countMoney)) {
                        $countMoney = 0;
                }

                if (C('RED_PACKAGE_OPEN') && date("Y-m-d H:i:s") > $activeStart && date("Y-m-d H:i:s") < $activeEnd && C('RED_PACKAGE_COUNT') > $countMoney) {
                        //生成红包金额
                        $redMoney = $this->rand_redpackage_money();
                        //写进用户账户和账户日志
                        $accountOb = M("account");
                        $accountArr = $accountOb->where("uid='{$userid}'")->find();
                        $accountBlanceOb = M("account_blance");
                        if (empty($accountArr)) {
                                //echo "1"."<br/>";
                                $data = array("uid" => $userid, "username" => $username, "account" => $redMoney, "created_at" => time(), "updated_at" => time());
                                $accountOb->add($data);
                                $dataBlance = array("uid" => $userid, "username" => $username, "last_account" => '0', "account" => $redMoney, "incr" => $redMoney, "operat" => "", "from" => "redpackage", "comment" => "新人注册领红包", "created_at" => time(), "updated_at" => time());
                                $accountBlanceOb->add($dataBlance);
                                //echo $accountBlanceOb-> getLastSql();
                        } else {
                                //echo "2"."<br/>";
                                $newAccount = $accountArr['account'] + $redMoney;
                                $data = array("id" => $accountArr['id'], "account" => $newAccount, "updated_at" => time());
                                $accountOb->save($data);
                                $dataBlance = array("uid" => $userid, "username" => $username, "last_account" => $accountArr['account'], "account" => $newAccount, "incr" => $redMoney, "operat" => "", "from" => "redpackage", "comment" => "新人注册领红包", "created_at" => time(), "updated_at" => time());
                                $accountBlanceOb->add($dataBlance);
                                //echo $accountBlanceOb-> getLastSql();
                        }

                        //写进红包领取日志
                        $dataRedLog = array("uid" => $userid, "username" => $username, "activeid" => $redAId, "activename" => $redActiveArr['activename'], "money" => $redMoney, "comment" => "", "created_at" => time(), "updated_at" => time());
                        $redLogOb->add($dataRedLog);
                        //echo "<br/>".$redLogOb-> getLastSql();
                        echo json_encode(array("code" => "200", "msg" => $redMoney));
                        die;
                } else {
                        echo json_encode(array("code" => "500", "msg" => "对不起，红包已领完！"));
                        die;
                }
        }

        /*
         * 红包金额生成规则
         */

        public function rand_redpackage_money() {

                $redMoney = mt_rand(50, 500) / 100;
                return $redMoney;
        }

}
