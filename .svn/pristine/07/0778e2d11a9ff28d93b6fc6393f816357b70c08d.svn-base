<?php

namespace Home\Controller;

use Think\Controller;

class WebchatController extends Controller {
        
        
        public function __construct() {
                //判断如果不是从微信端访问微信页面则跳转到对应端的首页
                from_to_weixin();
                parent::__construct();
        }
        /*
         * 取出最新的职位
         */
        
        public function new_job1() {

                $WebChatModel = D('job');
                $result = $WebChatModel->new_job_list("0,10");
                $this -> assign("result",$result);
                //$this->display("/Webchat/new_job_push");
                $this->display("/Webchatback/zuixinzhiwei1");
        }

        /*
         * 得到最新职位列表
         * 
         * 参数  post
         *       page  页码
         *       number  显示条数
         *       
         * 
         * 返回值
         *       count  总条数
         *       result  最新职位列表
         */

        public function get_newjob_list1() {

                $page = $_POST['page'];
                $size = $_POST['number'];
                $start = ($page - 1) * $size;

                $WebChatModel = D('job');
                
                $limit = "$start,$size"; //每页的数据数和内容$limit
                $num = $WebChatModel->new_job_count(); //得到列表总条数
                

                $result = $WebChatModel->new_job_list($limit);

                if (empty($result)) {

                        $result = array();
                }
                $data = array(
                    'count' => $num,
                    'result' => $result,
                );

                echo json_encode($data);
        }
        /*
         * 取出最新的职位
         */
        
        public function new_job() {

                $WebChatModel = D('job');
                $result = $WebChatModel->new_job_list("0,10");
                $this -> assign("result",$result);
                //$this->display("/Webchat/new_job_push");
                $this->display("/Webchat/zuixinzhiwei");
        }

        /*
         * 得到最新职位列表
         * 
         * 参数  post
         *       page  页码
         *       number  显示条数
         *       
         * 
         * 返回值
         *       count  总条数
         *       result  最新职位列表
         */

        public function get_newjob_list() {

                $page = $_POST['page'];
                $size = $_POST['number'];
                $start = ($page - 1) * $size;

                $WebChatModel = D('job');
                $limit = "$start,$size"; //每页的数据数和内容$limit
                $num = $WebChatModel->new_job_count(); //得到列表总条数
                

                $result = $WebChatModel->new_job_list($limit);

                if (empty($result)) {

                        $result = array();
                }
                $data = array(
                    'count' => $num,
                    'result' => $result,
                );

                echo json_encode($data);
        }

        /*
         * 职位详情
         */

        public function job_detail() {

                import("Org.ThinkSDK.sdk.Jssdk");
                $appid = C("APPID");
                $secretkey = C("SECRETKEY");
                $jssdk = new \Jssdk($appid, $secretkey);
                $signPackage = $jssdk->GetSignPackage();
                $this->assign("appId", $signPackage['appId']);
                $this->assign("timestamp", $signPackage['timestamp']);
                $this->assign("nonceStr", $signPackage['nonceStr']);
                $this->assign("signature", $signPackage['signature']);

                $id = $_GET['id'];
                if (empty($id)) {
                        header("location:/Home/Webchat/new_job");
                        exit();
                }
                $WebChatModel = D('job');
                $result = $WebChatModel->get_detail($id);
                //echo "<pre>";print_r($result);echo "</pre>";


                $tag = 0; //默认是未收藏状态
                //判断当前用户是否登陆，如果登陆判断当前页面当前用户是否已藏
                $userinfo = $_COOKIE['userinfo'];

                if (!empty($userinfo)) {

                        $userinfoArr = unserialize($userinfo);
                        $username = $userinfoArr['username'];

                        //判断当前页面当前用户是否已藏
                        $jcOb = M("job_collection");
                        $jcArr = $jcOb->where("username='" . $username . "' and status=1 and j_id=" . $id)->find();
                        //echo $jcOb ->getLastSql();
                        //var_dump($jcArr);
                        if (!empty($jcArr)) {
                                $tag = 1; //收藏表里有相关数据，改为已收藏状态
                        }
                }
                $this->assign("ip", $_SERVER['REMOTE_ADDR']);
                $this->assign("tag", $tag);
                $this->assign("result", $result);
                $this->display("./Webchat/job_detail");
        }
        /*
         * 职位详情(test)
         */

        public function job_detail1() {

                import("Org.ThinkSDK.sdk.Jssdk");
                $appid = "wx5aee7c9e7c2eb969";
                $secretkey = "44062163dcb3b4627a53bf0ac164c87d";
                $jssdk = new \Jssdk($appid, $secretkey);
                $signPackage = $jssdk->GetSignPackage();
                $this->assign("appId", $signPackage['appId']);
                $this->assign("timestamp", $signPackage['timestamp']);
                $this->assign("nonceStr", $signPackage['nonceStr']);
                $this->assign("signature", $signPackage['signature']);

                $id = $_GET['id'];
                if (empty($id)) {
                        header("location:/Home/Webchat/new_job");
                        exit();
                }
                $WebChatModel = D('job');
                $result = $WebChatModel->get_detail($id);
                //echo "<pre>";print_r($result);echo "</pre>";


                $tag = 0; //默认是未收藏状态
                //判断当前用户是否登陆，如果登陆判断当前页面当前用户是否已藏
                $userinfo = $_COOKIE['userinfo'];

                if (!empty($userinfo)) {

                        $userinfoArr = unserialize($userinfo);
                        $username = $userinfoArr['username'];

                        //判断当前页面当前用户是否已藏
                        $jcOb = M("job_collection");
                        $jcArr = $jcOb->where("username='" . $username . "' and status=1 and j_id=" . $id)->find();
                        //echo $jcOb ->getLastSql();
                        //var_dump($jcArr);
                        if (!empty($jcArr)) {
                                $tag = 1; //收藏表里有相关数据，改为已收藏状态
                        }
                }

                $this->assign("tag", $tag);
                $this->assign("result", $result);
                $this->display("./Webchat/job_detail1");
        }

        /*
         * 收藏职位
         */

        public function collect_job() {

//                echo "<pre>";
//                var_dump($_POST);
//                echo "</pre>";
//                var_dump($_SESSION);die;
                //如果参数为空，跳回职位详情页
                if (empty($_POST)) {
                        setcookie("gourl", "");
                        echo json_encode(array("code" => 500, "msg" => "参数异常"));
                        die;
                }

                //如果为登陆，跳转到login页面，否则查出uid和username字段
                $userinfo = $_COOKIE['userinfo'];
                if (empty($userinfo)) {
                        setcookie("gourl", "/Home/Webchat/job_detail/id/" . $_POST['j_id']);
                        echo json_encode(array("code" => 400, "msg" => "未登录"));
                        die;
                } else {
                        setcookie("gourl", "");
                        $userinfoArr = unserialize($userinfo);
                        $_POST['uid'] = $userinfoArr['userid'];
                        $_POST['username'] = $userinfoArr['username'];
                        $_POST['created_at'] = time();
                        $_POST['updated_at'] = time();
                }
//                if (empty($_SESSION['username'])) {
//                        setcookie("gourl", "/Home/Webchat/job_detail/id/" . $_POST['j_id']);
//                        echo json_encode(array("code" => 400, "msg" => "未登录"));
//                        die;
//                } else {
//                        setcookie("gourl", "");
//                        $_POST['uid'] = $_SESSION['userid'];
//                        $_POST['username'] = $_SESSION['username'];
//                        $_POST['created_at'] = time();
//                        $_POST['updated_at'] = time();
//                }
                //将收藏信息插入到 收藏职位表 job_collection
                $collectOb = M("job_collection");
                $jcArr = $collectOb->where("username='" . $_POST['username'] . "' and status=2 and j_id=" . $_POST['j_id'])->find();
                if (!empty($jcArr)) {
                        $collect_result = $collectOb->save(array("status" => 1, "updated_at" => time(), "id" => $jcArr['id']));
                } else {
                        $collect_result = $collectOb->add($_POST);
                }
                //echo $collectOb->getLastSql();
                if ($collect_result) {
                        echo json_encode(array("code" => 200, "msg" => "收藏成功"));
                        die;
                } else {
                        echo json_encode(array("code" => 400, "msg" => "收藏失败"));
                        die;
                }
        }

        /*
         * 取消收藏职位
         */

        public function cancel_collect_job() {

                $j_id = $_POST['j_id'];
                //如果为登陆，跳转到login页面，否则查出uid和username字段
                $userinfo = $_COOKIE['userinfo'];
                if (empty($userinfo)) {
                        setcookie("gourl", "/Home/Webchat/job_detail/id/" . $j_id);
                        echo json_encode(array("code" => 400, "msg" => "未登录"));
                        die;
                } else {
                        setcookie("gourl", "");
                        $userinfoArr = unserialize($userinfo);
                        $uid = $userinfoArr['userid'];
                        $data['updated_at'] = time();

                        //查找该条收藏记录
                        $collectOb = M("job_collection");
                        $jcArr = $collectOb->where("uid='" . $uid . "' and status=1 and j_id=" . $j_id)->find();
                        $data['id'] = $jcArr['id'];
                        $data['status'] = 2;
                        $collect_result = $collectOb->save($data);
                        if ($collect_result) {
                                echo json_encode(array("code" => 200, "msg" => "取消收藏成功"));
                                die;
                        } else {
                                echo json_encode(array("code" => 400, "msg" => "取消收藏失败"));
                                die;
                        }
                }
        }

        /*
         * 取出收藏的职位列表
         */

        public function fav_job() {

                //如果为登陆，跳转到login页面，否则查出uid和username字段
                $userinfo = $_COOKIE['userinfo'];
                if (empty($userinfo)) {
                        setcookie("gourl", "/Home/Webchat/fav_job");
                        header("location:/Home/Webchatlogin/login");
                        die;
                } else {
                        setcookie("gourl", "");
                        $userinfoArr = unserialize($userinfo);
                        $uid = $userinfoArr['userid'];
                }
//                if (empty($_SESSION['username'])) {
//
//                        setcookie("gourl", "/Home/Webchat/fav_job");
//                        header("location:/Home/Webchatlogin/login");
//                        die;
//                } else {
//                        setcookie("gourl", "");
//                        $uid = $_SESSION['userid'];
//                }
                //var_dump($_SESSION);
                //$this->display("/Webchat/fav_job_new");
                $this->display("/Webchat/shoucangzhiwei");
        }

        /*
         * 获取收藏职位列表
         * 
         * 参数  POST
         *      page  页面
         *      number  显示条数
         * 
         * 返回值  json
         * 
         *      count   总条数
         *      result  收藏职位列表
         *     
         */

        public function get_favjob_list() {

                $page = $_POST['page'];
                $size = $_POST['number'];
                $start = ($page - 1) * $size;

                //首先查看这个职位是否已经被删除在job表中
                $WebChatModel = new \Home\Model\JobCollectionModel();

                $userinfo = $_COOKIE['userinfo'];
                $userinfoArr = unserialize($userinfo);
                $uid = $userinfoArr['userid'];
                $username = $userinfoArr['username'];

                $num = $WebChatModel->fav_job_count($uid); //得到列表总条数
                $limit = "$start,$size"; //每页的数据数和内容$limit

                $result = $WebChatModel->fav_job_list($uid, $limit);

                if (empty($result)) {

                        $result = array();
                }
                $data = array(
                    'count' => $num,
                    'result' => $result,
                );

                echo json_encode($data);
        }

        /*
         * 正在推荐的职位
         */

        public function recommending() {


                //如果为登陆，跳转到login页面，否则查出uid和username字段
                $userinfo = $_COOKIE['userinfo'];

                if (empty($userinfo)) {
                        setcookie("gourl", "/Home/Webchat/recommending");
                        header("location:/Home/Webchatlogin/login");
                        die;
                } else {
                        setcookie("gourl", "");
                        $userinfoArr = unserialize($userinfo);
                        $uid = $userinfoArr['userid'];
                }
//                if (empty($_SESSION['username'])) {
//                        setcookie("gourl", "/Home/Webchat/recommended");
//                        header("location:/Home/Webchatlogin/login");
//                        die;
//                } else {
//                        setcookie("gourl", "");
//                        $uid = $_SESSION['userid'];
//                }
                //$this->display("./Webchat/recommending_new");
                $this->display("./Webchat/zhengzaituijian");
        }

        public function get_recommending_list() {

                $page = $_POST['page'];
                $size = $_POST['number'];
                $start = ($page - 1) * $size;

                $WebChatModel = D('job');

                $userinfo = $_COOKIE['userinfo'];
                $userinfoArr = unserialize($userinfo);
                $uid = $userinfoArr['userid'];
                $username = $userinfoArr['username'];

                $num = $WebChatModel->recommend_job_count(1, $uid); //得到列表总条数
                $limit = "$start,$size"; //每页的数据数和内容$limit

                $result = $WebChatModel->getRecommendJob(1, $limit, $uid);


                if (empty($result)) {

                        $result = array();
                }
                $data = array(
                    'count' => $num,
                    'result' => $result,
                );

                echo json_encode($data);
        }

        /*
         * 历史推荐的职位
         */

        public function recommended() {


                //如果为登陆，跳转到login页面，否则查出uid和username字段
                $userinfo = $_COOKIE['userinfo'];
                if (empty($userinfo)) {
                        setcookie("gourl", "/Home/Webchat/recommended");
                        header("location:/Home/Webchatlogin/login");
                        die;
                } else {
                        setcookie("gourl", "");
                        $userinfoArr = unserialize($userinfo);
                        $uid = $userinfoArr['userid'];
                }
//                if (empty($_SESSION['username'])) {
//                        setcookie("gourl", "/Home/Webchat/recommended");
//                        header("location:/Home/Webchatlogin/login");
//                        die;
//                } else {
//                        setcookie("gourl", "");
//                        $uid = $_SESSION['userid'];
//                }
                //$this->display("./Webchat/recommended_new");
                $this->display("./Webchat/lishituijian");
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

                $WebChatModel = D('job');

                $userinfo = $_COOKIE['userinfo'];
                $userinfoArr = unserialize($userinfo);
                $uid = $userinfoArr['userid'];
                $username = $userinfoArr['username'];

                $num = $WebChatModel->recommend_job_count(2, $uid); //得到列表总条数
                $limit = "$start,$size"; //每页的数据数和内容$limit

                $result = $WebChatModel->getRecommendJob(2, $limit, $uid);
                //echo "<pre>";var_dump($result);echo "</pre>";              

                if (empty($result)) {

                        $result = array();
                }
                $data = array(
                    'count' => $num,
                    'result' => $result,
                );

                echo json_encode($data);
        }

        /*
         * 我的账户
         */

        public function my_account() {


                //如果为登陆，跳转到login页面，否则查出uid和username字段
                $userinfo = $_COOKIE['userinfo'];
                if (empty($userinfo)) {
                        setcookie("gourl", "/Home/Webchat/my_account");
                        header("location:/Home/Webchatlogin/login");
                        die;
                } else {
                        setcookie("gourl", "");
                        $userinfoArr = unserialize($userinfo);
                        $username = $userinfoArr['username'];
                        $userinfoOb = M("userinfo");
                        $userArr = $userinfoOb->where("username='" . $username . "'")->find();
                        $uid = $userArr['userid'];
                }

//                if (empty($_SESSION['username'])) {
//                        //将当前页面地址放进存入session
//                        setcookie("gourl", "/Home/Webchat/my_account");
//                        header("location:/Home/Webchatlogin/login");
//                        die;
//                } else {
//                        setcookie("gourl", "");
//                        $username = $_SESSION['username'];
//                        $userinfoOb = M("userinfo");
//                        $userArr = $userinfoOb->where("username='" . $username . "'")->find();
//                        $uid = $userArr['userid'];
//                        //$uid = $_SESSION['userid'];
//                }


                $this->assign("username", $username);
                //$this->display("./Webchat/my_account_new");
                $this->display("./Webchat/zijinmingxi");
        }

        /*
         * 获取我的账户列表
         * 
         * 参数   post
         *       page   页码
         *       number 显示条数
         * 
         * 返回值  json
         * 
         *       count  总条数
         *       result 我的账户列表
         */

        public function get_account_list() {

                $page = $_POST['page'];
                $size = $_POST['number'];
                $start = ($page - 1) * $size;

                $WebChatModel = new \Home\Model\AccountBlanceModel();

                $userinfo = $_COOKIE['userinfo'];
                $userinfoArr = unserialize($userinfo);
                $username = $userinfoArr['username'];
                $userinfoOb = M("userinfo");
                $userArr = $userinfoOb->where("username='" . $username . "'")->find();
                $uid = $userArr['userid'];

                $num = $WebChatModel->my_account_count($uid); //得到列表总条数
                $limit = "$start,$size"; //每页的数据数和内容$limit

                $result = $WebChatModel->my_account_list($uid, $limit);

                if (empty($result)) {

                        $result = array();
                }
                $data = array(
                    'count' => $num,
                    'result' => $result,
                );

                echo json_encode($data);
        }

        /*
         *         
         *  判断该用户为该职位已经推荐几个人
         */

        public function checkSelectUser() {


                $userinfo = $_COOKIE['userinfo'];
                $userinfoArr = unserialize($userinfo);
                $userid = $userinfoArr['userid'];

                $jid = $_POST['jid'];
                $count = M("record")->where("j_id='$jid' and t_id='$userid'")->count();
                echo $count;
        }

        /*
         * 被推荐人列表页
         */

        public function push_resume() {
                
                 $jobid = $_GET['jobid'];
                //如果为登陆，跳转到login页面
                $userinfo = $_COOKIE['userinfo'];

//                if (empty($_SESSION['username'])) {
//                        //将当前页面地址放进存入session
//                        setcookie("gourl", "/Home/Webchat/push_resume");
//                        header("location:/Home/Webchatlogin/login");
//                        die;
//                } else {
//                        setcookie("gourl", "");
//                        $uid = $_SESSION['userid'];
//                        $username = $_SESSION['username'];
//                }

                if (empty($userinfo)) {
                        setcookie("gourl", "/Home/Webchat/push_resume/jobid/" . $jobid);
                        header("location:/Home/Webchatlogin/login");
                        die;
                }
                
                setcookie("gourl", "");
                $this->assign('jobid', $jobid);
                //$this->display("./Webchat/listtui_new_old");
                $this->display("./Webchat/listtui_new");
        }

        /*
         * 获取被推荐人列表
         * 
         * 参数  post
         *      jobid  职位id
         *      page   页码
         *      number  显示条数
         * 
         * 返回值 json 格式
         *      
         *        count   总条数
         *        result  被推荐人列表
         *    
         */

        public function get_resume_list() {

                //得到职位信息id
                $jobid = $_POST['jobid'];
                $page = $_POST['page'];
                $size = $_POST['number'];
                $start = ($page - 1) * $size;

                $userinfo = $_COOKIE['userinfo'];
                $userinfoArr = unserialize($userinfo);
                $uid = $userinfoArr['userid'];
                $username = $userinfoArr['username'];

                $resumeOb = new \Home\Model\ResumeModel();
                $num = $resumeOb->resume_count($uid); //得到列表总条数

                $limit = "$start,$size";
                $result = $resumeOb->resume_list($uid, $limit, $jobid);
                //var_dump($result);
                if (empty($result)) {

                        $result = array();
                }
                $data = array(
                    'count' => $num,
                    'result' => $result,
                );

                echo json_encode($data);
        }

        /*
         * 确定面试时间页面
         */

        public function resume_time() {

                //如果为登陆，跳转到login页面
                $userinfo = $_COOKIE['userinfo'];
                if (empty($userinfo)) {
                        setcookie("gourl", "/Home/Webchat/new_job");
                        header("location:/Home/Webchatlogin/login");
                        die;
                } else {
                        setcookie("gourl", "");
                }

                $jobid = $_GET['jobid'];
                $jid = $_GET['jid'];
                $this->assign("jobid", $jobid);
                $this->assign("jid", $jid);
                $this->display("./Webchat/set_time");
        }

        /*
         *  保存推荐人信息 到推荐记录表中record 
         */

        public function record_save() {
                $data['j_id'] = $_POST['j_id'];
                $userinfo = $_COOKIE['userinfo'];
                if (empty($userinfo)) {
                        setcookie("gourl", "/Home/Webchat/new_job");
                        echo json_encode(array("code" => 400, "msg" => "未登录"));
                        die;
                } else {
                        setcookie("gourl", "");
                        $userinfoArr = unserialize($userinfo);
                }
                $uid = $userinfoArr['userid'];
                $data['t_id'] = $uid;
                $data['bt_id'] = $_POST['bt_id'];
                $data['posttime'] = time();
                $data['audstartdate'] = $_POST['audstartdate'];
                $recordOb = M("record");
                $re = $recordOb->add($data);
                if ($re) {
                        
                        /************************【推荐候选人】操作日志 begin***************/
                        
                        $username = $userinfoArr['username'];
                        
                        $arResume = M("resume") -> where("id=".$data['bt_id'])->find();
                        $sRecommended = $arResume['username'];  //候选人名称
                        $arJob = M("job")->where("id=".$data['j_id'])->find();
                       
                        $sJobTitle = $arJob['title'];//职位名称
                        if($sJobTitle == '0'){
                              $sJobTitle = getCascList($arJob['Jobcate'],"信息不明");
                        }
                        $arCompany = M("company") -> where("id=".$arJob['cpid']) ->find();
                        $sCompanyName = $arCompany['cpname'];//公司名称
                        
                        $arNotice = getTNoticeInfo(1, $sRecommended, $sCompanyName, $sJobTitle);
                        $sLogtitle = $arNotice[0];
                        $sLogContent = $arNotice[1];
                        
                        $bt_id = $data['bt_id'];//简历id
                        $job_id = $data['j_id'];//职位id
                        addNoticeLog($uid, $username, $bt_id,$job_id,$sLogtitle, $sLogContent);
                        
                        /************************【推荐候选人】操作日志 end***************/
                        
                        echo json_encode(array("code" => "200", "msg" => "保存成功"));
                        die;
                } else {
                        echo json_encode(array("code" => "500", "msg" => "保存失败"));
                        die;
                }
        }

}
