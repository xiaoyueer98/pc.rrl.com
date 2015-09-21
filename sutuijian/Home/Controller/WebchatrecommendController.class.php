<?php

namespace Home\Controller;

use Think\Controller;

class WebchatrecommendController extends Controller {

        public function __construct() {
                //判断如果不是从微信端访问微信页面则跳转到对应端的首页
                from_to_weixin();
                parent::__construct();
        }

        /*
         * 正在推荐的职位
         */

        public function recommending() {

                //如果为登陆，跳转到login页面，否则查出uid和username字段
                $userinfo = $_COOKIE['userinfo'];

                if (empty($userinfo)) {
                        setcookie("gourl", "/Home/Webchatrecommend/recommending", time() + 3600, "/");
                        header("location:/Home/Webchatlogin/login");
                        die;
                } else {
                        setcookie("gourl", "", time() - 1, "/");
                        $userinfoArr = unserialize($userinfo);
                        $uid = $userinfoArr['userid'];
                }
                
                get_login_time();
                
                $jobOb = D("job");
                $limit = "0,10";
                $result = $jobOb->getRecommendJob(1, $limit, $uid);

                if (empty($result)) {
                        $result = array();
                } else {
                        foreach ($result as $k => $v) {
                                $arNotice = M("notice_log")->where("type=1 and bt_id=" . $v['bt_id'])->order("id desc")->select();
                                if (empty($arNotice)) {
                                        $arNotice = array();
                                } else {
                                        foreach ($arNotice as $k1 => $v1) {
                                                $arNotice[$k1]['posttime'] = date("Y-m-d H:i", $v1['created_at']);
                                        }
                                }

                                $result[$k]['notice_log'] = $arNotice;

                                //查看改用户是否已经评论过该职位
                                $arEvaluate = M("evaluate")->where("uid=" . $uid . " and pid=" . $result[$k]['recordid'] . " and tag='record'")->find();
                                if (empty($arEvaluate)) {
                                        $result[$k]['is_evaluate'] = 1;
                                }
                        }
                }
                $this->assign("result", $result);

                $this->display("/Webchatnew/recommending");
        }

        public function get_recommending_list() {

                $page = $_POST['page'];
                $size = $_POST['number'];
                $start = ($page - 1) * $size;

                $jobOb = D("job");

                $userinfo = $_COOKIE['userinfo'];
                $userinfoArr = unserialize($userinfo);
                $uid = $userinfoArr['userid'];
                $username = $userinfoArr['username'];

                $num = $jobOb->recommend_job_count(1, $uid); //得到列表总条数
                $limit = "$start,$size"; //每页的数据数和内容$limit

                $result = $jobOb->getRecommendJob(1, $limit, $uid);

                if (empty($result)) {
                        $result = array();
                }
                foreach ($result as $k => $v) {
                        $arNotice = M("notice_log")->where("type=1 and bt_id=" . $v['bt_id'])->order("id desc")->select();
                        if (empty($arNotice)) {
                                $arNotice = array();
                        } else {
                                foreach ($arNotice as $k1 => $v1) {
                                        $arNotice[$k1]['posttime'] = date("Y-m-d H:i", $v1['created_at']);
                                }
                        }

                        $result[$k]['notice_log'] = $arNotice;

                        //查看改用户是否已经评论过该职位
                        $arEvaluate = M("evaluate")->where("uid=" . $uid . " and pid=" . $result[$k]['recordid'] . " and tag='record'")->find();
                        if (empty($arEvaluate)) {
                                $result[$k]['is_evaluate'] = 1;
                        }
                }
                $data = array(
                    'count' => $num,
                    'result' => $result,
                );

                echo json_encode($data);
        }

        function text_evaluate() {

                $this->display("/Webchatnew/text_evaluate");
        }

        /*
         * 历史推荐的职位
         */

        public function recommended() {

                
                //如果为登陆，跳转到login页面，否则查出uid和username字段
                $userinfo = $_COOKIE['userinfo'];
                if (empty($userinfo)) {
                        setcookie("gourl", "/Home/Webchatrecommend/recommended", time() + 3600, "/");
                        header("location:/Home/Webchatlogin/login");
                        die;
                } else {
                        setcookie("gourl", "", time() - 1, "/");
                        $userinfoArr = unserialize($userinfo);
                        $uid = $userinfoArr['userid'];
                }
                
                get_login_time();
                
                $jobOb = D("job");
                $limit = "0,10";
                $result = $jobOb->getRecommendJob(2, $limit, $uid);

                if (empty($result)) {
                        $result = array();
                } else {
                        foreach ($result as $k => $v) {
                                $arNotice = M("notice_log")->where("type=1 and bt_id=" . $v['bt_id'])->order("id desc")->select();
                                if (empty($arNotice)) {
                                        $arNotice = array();
                                } else {
                                        foreach ($arNotice as $k1 => $v1) {
                                                $arNotice[$k1]['posttime'] = date("Y-m-d H:i", $v1['created_at']);
                                        }
                                }

                                $result[$k]['notice_log'] = $arNotice;

                                //查看改用户是否已经评论过该职位
                                $arEvaluate = M("evaluate")->where("uid=" . $uid . " and pid=" . $result[$k]['recordid'] . " and tag='record'")->find();
                                if (empty($arEvaluate)) {
                                        $result[$k]['is_evaluate'] = 1;
                                }
                        }
                }

                $this->assign("result", $result);
                $this->display("/Webchatnew/recommended");
        }

        /*
         * 获取正在收藏职位列表
         * 
         * 参数   post
         *       page   页码
         *       number 显示条数
         * 
         * 返回值  json
         * 
         *       count  总条数
         *       result  收藏职位列表
         */

        public function get_recommended_list() {

                $page = $_POST['page'];
                $size = $_POST['number'];
                $start = ($page - 1) * $size;

                $jobOb = D("job");

                $userinfo = $_COOKIE['userinfo'];
                $userinfoArr = unserialize($userinfo);
                $uid = $userinfoArr['userid'];
                $username = $userinfoArr['username'];

                $num = $jobOb->recommend_job_count(2, $uid); //得到列表总条数
                $limit = "$start,$size"; //每页的数据数和内容$limit

                $result = $jobOb->getRecommendJob(2, $limit, $uid);

                if (empty($result)) {

                        $result = array();
                }
                foreach ($result as $k => $v) {
                        $arNotice = M("notice_log")->where("type=1 and bt_id=" . $v['bt_id'])->order("id desc")->select();
                        if (empty($arNotice)) {
                                $arNotice = array();
                        } else {
                                foreach ($arNotice as $k1 => $v1) {
                                        $arNotice[$k1]['posttime'] = date("Y-m-d H:i", $v1['created_at']);
                                }
                        }

                        $result[$k]['notice_log'] = $arNotice;

                        //查看改用户是否已经评论过该职位
                        $arEvaluate = M("evaluate")->where("uid=" . $uid . " and pid=" . $result[$k]['recordid'] . " and tag='record'")->find();
                        if (empty($arEvaluate)) {
                                $result[$k]['is_evaluate'] = 1;
                        }
                }
                $data = array(
                    'count' => $num,
                    'result' => $result,
                );
                echo json_encode($data);
        }

        /*
         * 评论保存方法 
         * 
         *  params
         *      recordid  招聘记录id
         *      j_id      职位id
         *      pname     公司名称
         *      content   评论内容     
         */

        function add_evaluate() {
                $params = $_POST;
//                var_dump($params);die;
                if (!empty($params['recordid']) && !empty($params['j_id']) && !empty($params['pname']) && !empty($params['content'])) {
                        $userinfo = $_COOKIE['userinfo'];
                        $userinfoArr = unserialize($userinfo);
                        $uid = $userinfoArr['userid'];
                        $username = $userinfoArr['username'];
                        $arEvaluate = M("evaluate")->where("uid=" . $uid . " and pid=" . $params['recordid'] . " and tag='record'")->find();
                        if (empty($arEvaluate)) {

                                $data['pid'] = $params['recordid'];
                                $data['j_id'] = $params['j_id'];
                                $data['pname'] = $params['pname'];
                                $data['content'] = $params['content'];
                                $data['tag'] = "record";
                                $data['loginip'] = $_SERVER['REMOTE_ADDR'];
                                $data['uid'] = $uid;
                                $data['username'] = $username;
                                $data['checkinfo'] = 'true';
                                $data['pid'] = $params['recordid'];
                                $data['created_at'] = $data['updated_at'] = time();
                                M("evaluate")->add($data);
                        }
                }

                if (empty($_POST['type'])) {
                        header("location:/Home/Webchatrecommend/recommending");
                        die;
                } else {
                        header("location:/Home/Webchatrecommend/recommended");
                        die;
                }
        }

}
