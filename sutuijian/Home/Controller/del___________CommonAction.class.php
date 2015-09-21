<?php

namespace Home\Controller;

use Think\Controller;

header("Content-type: text/html; charset=utf-8");

class IndexController extends TestController {
    /*
     * ****主页显示
     */

    public function __construct() {
        parent::__construct();
        $model = M('casclist', 'stj_', 'DB_CONFIG1');
        $position = $model
                        ->where("id in (641,642,643,648,649,645,970)")->order("orderid asc")->select();
        $model2 = M('userinfo', 'stj_', 'DB_CONFIG1');

        if (!empty($_SESSION['username']) || !empty($_SESSION['cusername'])) {
            $username = ($_SESSION['username'] ? $_SESSION['username'] : $_SESSION['cusername']);
            $decide = $model2
                    ->where("username='" . $username . "'")
                    ->find();
            if (!empty($decide)) {
                $table = array();
                foreach ($decide as $key => $val) {
                    $table = $decide[$key];
                }
                //判断是企业or推荐人 1企业用户 0推荐人
                if ($table["flag"] == "0") {
                    $data['url'] = U('Login/userinfo');
                    $data['logout'] = U('Login/logout');
                    $data['savepass'] = U('Login/savepass');
                } else if ($table["flag"] == "1") {

                    $data['url'] = U('Company/EnterpriseInformation');
                    $data['logout'] = U('Login/logout');
                    $data['savepass'] = U('Login/savepass');
                }
                $this->assign("data", $data);
            }
        }
        $this->position = $position;
    }

    function page() {
        $nowpage = I('i');
        //职位 1
        $position = I('position');
        //行业 2
        $industry = I("industry");
        $place = I('area');
        $treatment = I('treatment');
        $start = ($nowpage - 1) * 10;
        $Tariff = I('Tariff');
        $puttime = I('puttime');
        $newdesc = I("newdesc");
        $model = M('job', 'stj_', 'DB_CONFIG1');
        $name = M('cascadedata', 'stj_', 'DB_CONFIG1');
        $area = M('casclist', 'stj_', 'DB_CONFIG1');
        //$where     = " 1=1";
        $order = " 1=1";

        if ($position != "") {
            $jobCate_list = M("casclist")->where("parentid=1")->select();

            $jobid = array();
            foreach ($jobCate_list as $jobInfo) {
                $jobid[] = $jobInfo['id'];
                $joblist = M("casclist")->where("parentid=" . $jobInfo['id'])->select();
                foreach ($joblist as $value) {
                    $jobid[] = $value['id'];
                }
            }
            $jobid = implode(",", $jobid);
            $jt = M("casclist")->where("cascname like '%" . $position . "%' and id in (" . $jobid . ")")->select();

            if ($jt) {
                $jttmp = array();
                foreach ($jt as $j) {
                    array_push($jttmp, $j['id']);
                }
                $jttmp = implode(",", $jttmp);
                $where .=" AND Jobcate in (" . $jttmp . ")";
            } else {
                $where .=" AND Jobcate in (1000000000)";
            }
        }

        if ($industry != "") {
            $jobCate_list = M("casclist")->where("parentid=2")->select();

            $jobid = array();
            foreach ($jobCate_list as $jobInfo) {
                $jobid[] = $jobInfo['id'];
                $joblist = M("casclist")->where("parentid=" . $jobInfo['id'])->select();

                foreach ($joblist as $value) {
                    $jobid[] = $value['id'];
                }
            }
            $jobid = implode(",", $jobid);
            $jt = M("casclist")->where("cascname like '%" . $industry . "%' and id in (" . $jobid . ")")->select();

            if ($jt) {
                $jttmp = array();
                foreach ($jt as $j) {
                    array_push($jttmp, $j['id']);
                }
                $jttmp = implode(",", $jttmp);
                $where .=" AND strycate in (" . $jttmp . ")";
            } else {
                $where .=" AND strycate in (1000000000)";
            }
        }

        if ($place != "") {
            $jobCate_list = M("casclist")->where("parentid='$place'")->select();

            $jobid = array();
            foreach ($jobCate_list as $jobInfo) {
                $jobid[] = $jobInfo['id'];
            }

            if ($jobid) {
                $jobid = implode(",", $jobid);
                $where .=" AND jobplace in (" . $jobid . ")";
            } else {
                $where .=" AND jobplace in (1000000000)";
            }
        }

        if ($treatment != "") {

            $where .=" AND treatment = '" . $treatment . "'";
        }

        if ($puttime != "") {

            if ($puttime == '604800') {
                //一周以内时间戳记
                $lastWeek = time() - 24 * 60 * 60 * 7;
                $where .=" AND starttime>" . $lastWeek;
            } else if ($puttime == '1209600') {
                //两周以内时间戳记
                $lastWeek = time() - 24 * 60 * 60 * 14;
                $where .=" AND starttime>" . $lastWeek;
            } else if ($puttime == '2592000') {
                //一月以内时间戳记
                $lastWeek = time() - 24 * 60 * 60 * 30;
                $where .=" AND starttime>" . $lastWeek;
            }
        }

        $count = M("job")->where("checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0" . $where)->count();

        $arJobList = M("job")->where("checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0" . $where)->order("orderid asc, starttime desc")->limit($start, 10)->select();



        $page = ceil($count / 10);
        $str = "";
        for ($i = 1; $i <= $page; $i++) {
            $str = $str . "<a href='#' onclick='page(" . $i . ")'>" . $i . "</a>&nbsp&nbsp";
        }

        foreach ($arJobList as $key => &$val) {
            if ($val['Tariff'] > 10) {

                $val['Tariff'] = floor($val['Tariff'] * 0.8 / 100) * 100;
            } else {
                $val['Tariff'] = floor($val['treatment'] * $val['Tariff'] * 12 * 0.8 / 100) * 100;
            }
            $val['starttime'] = date('Y-m-d H:i:s', $val['starttime']);
            if (!$val['title']) {
                $val['title'] = M("casclist")->where("id='$val[Jobcate]'")->getField("cascname");
            } else {
                $val['title'] = $val['title'];
            }
            $val['treatment'] = M("cascadedata")->where("datagroup='treatment' and datavalue='$val[treatment]'")->getField("dataname");

            $val['education'] = M("cascadedata")->where("datagroup='education' and datavalue='$val[education]'")->getField("dataname");
            //  $val['treatment'] = M("cascadedata")->where("datagroup='treatment' and datavalue='$val[treatment]'")->getField("dataname");
            $company = M("company")->where("id='$val[cpid]'")->find();

            $val['cpname'] = $company["cpname"];

            if ($company['thumlogo']) {
                $val['thumlogo'] = $company["thumlogo"];
            } else {
                $val['thumlogo'] = "/Public/img/defoultLogo.png";
            }
            $val['experience'] = M("cascadedata")->where("datagroup='experience' and datavalue='$val[experience]'")->getField("dataname");
        }

        $this->page = $page;
        $this->money = $money;
        $this->smoney = $smoney;
        $this->workarea = $workarea;
        $this->positime = $positime;
        $this->str = $str;
        $this->nowpage = $nowpage;
        $this->comp = $arJobList;
        $this->display("page");
        //  $this->display();
    }

    function searchs() {
        //职位 1
        $position = I('position');
        //行业 2
        $industry = I("industry");
        $place = I('area');
        $treatment = I('treatment');
        $nowpage = I('nowpage');
        $start = ($nowpage - 1) * 10;
        $Tariff = I('Tariff');
        $puttime = I('puttime');
        $newdesc = I("newdesc");
        $model = M('job', 'stj_', 'DB_CONFIG1');
        $name = M('cascadedata', 'stj_', 'DB_CONFIG1');
        $area = M('casclist', 'stj_', 'DB_CONFIG1');
        //$where     = " 1=1";
        $order = " 1=1";

        if ($position != "") {
            $jobCate_list = M("casclist")->where("parentid=1")->select();

            $jobid = array();
            foreach ($jobCate_list as $jobInfo) {
                $jobid[] = $jobInfo['id'];
                $joblist = M("casclist")->where("parentid=" . $jobInfo['id'])->select();
                foreach ($joblist as $value) {
                    $jobid[] = $value['id'];
                }
            }
            $jobid = implode(",", $jobid);
            $jt = M("casclist")->where("cascname like '%" . $position . "%' and id in (" . $jobid . ")")->select();

            if ($jt) {
                $jttmp = array();
                foreach ($jt as $j) {
                    array_push($jttmp, $j['id']);
                }
                $jttmp = implode(",", $jttmp);
                $where .=" AND Jobcate in (" . $jttmp . ")";
            } else {
                $where .=" AND Jobcate in (1000000000)";
            }
        }

        if ($industry != "") {
            $jobCate_list = M("casclist")->where("parentid=2")->select();

            $jobid = array();
            foreach ($jobCate_list as $jobInfo) {
                $jobid[] = $jobInfo['id'];
                $joblist = M("casclist")->where("parentid=" . $jobInfo['id'])->select();

                foreach ($joblist as $value) {
                    $jobid[] = $value['id'];
                }
            }


            $jobid = implode(",", $jobid);
            $jt = M("casclist")->where("cascname like '%" . $industry . "%' and id in (" . $jobid . ")")->select();


            if ($jt) {
                $jttmp = array();
                foreach ($jt as $j) {
                    array_push($jttmp, $j['id']);
                }
                $jttmp = implode(",", $jttmp);
                $where .=" AND strycate in (" . $jttmp . ")";
            } else {
                $where .=" AND strycate in (1000000000)";
            }
        }

        if ($place != "") {
            $jobCate_list = M("casclist")->where("parentid='$place'")->select();

            $jobid = array();
            foreach ($jobCate_list as $jobInfo) {
                $jobid[] = $jobInfo['id'];
            }

            if ($jobid) {
                $jobid = implode(",", $jobid);
                $where .=" AND jobplace in (" . $jobid . ")";
            } else {
                $where .=" AND jobplace in (1000000000)";
            }
        }

        if ($treatment != "") {

            $where .=" AND treatment = '" . $treatment . "'";
        }

        if ($puttime != "") {

            if ($puttime == '604800') {
                //一周以内时间戳记
                $lastWeek = time() - 24 * 60 * 60 * 7;
                $where .=" AND starttime>" . $lastWeek;
            } else if ($puttime == '1209600') {
                //两周以内时间戳记
                $lastWeek = time() - 24 * 60 * 60 * 14;
                $where .=" AND starttime>" . $lastWeek;
            } else if ($puttime == '2592000') {
                //一月以内时间戳记
                $lastWeek = time() - 24 * 60 * 60 * 30;
                $where .=" AND starttime>" . $lastWeek;
            }
        }

        $arJobList = M("job")->where("checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0" . $where)->order("orderid asc, starttime desc")->limit("0,10")->select();

        $count = M("job")->where("checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0" . $where)->count();

        $page = ceil($count / 10);
        $str = "";
        for ($i = 1; $i <= $page; $i++) {
            $str = $str . "<a href='#' onclick='page(" . $i . ")'>" . $i . "</a>&nbsp&nbsp";
        }

        foreach ($arJobList as $key => &$val) {
            if ($val['Tariff'] > 10) {

                $val['Tariff'] = floor($val['Tariff'] * 0.8 / 100) * 100;
            } else {
                $val['Tariff'] = floor($val['treatment'] * $val['Tariff'] * 12 * 0.8 / 100) * 100;
            }
            $val['starttime'] = date('Y-m-d H:i:s', $val['starttime']);
            if (!$val['title']) {
                $val['title'] = M("casclist")->where("id='$val[Jobcate]'")->getField("cascname");
            } else {
                $val['title'] = $val['title'];
            }
            $val['treatment'] = M("cascadedata")->where("datagroup='treatment' and datavalue='$val[treatment]'")->getField("dataname");

            $val['education'] = M("cascadedata")->where("datagroup='education' and datavalue='$val[education]'")->getField("dataname");
            //  $val['treatment'] = M("cascadedata")->where("datagroup='treatment' and datavalue='$val[treatment]'")->getField("dataname");
            $company = M("company")->where("id='$val[cpid]'")->find();

            $val['cpname'] = $company["cpname"];

            if ($company['thumlogo']) {
                $val['thumlogo'] = $company["thumlogo"];
            } else {
                $val['thumlogo'] = "/Public/img/defoultLogo.png";
            }
            $val['experience'] = M("cascadedata")->where("datagroup='experience' and datavalue='$val[experience]'")->getField("dataname");
        }

        $this->page = $page;
        $this->money = $money;
        $this->smoney = $smoney;
        $this->workarea = $workarea;
        $this->positime = $positime;
        $this->str = $str;
        $this->nowpage = $nowpage;
        $this->comp = $arJobList;

        $this->display();
    }

    function search() {
        $sort = I('sort');
        if ($sort == "puttime") {
            $sort = "stj_job.starttime desc";
        } else if ($sort = "Tariff") {
            $sort = "stj_job.Tariff desc";
        }
        $position = I('position');
        $industry = I("industry");
        $place = I('area');
        $treatment = I('treatment');
        $Tariff = I('Tariff');
        $puttime = I('puttime');
        $model = M('job', 'stj_', 'DB_CONFIG1');
        $name = M('cascadedata', 'stj_', 'DB_CONFIG1');
        $area = M('casclist', 'stj_', 'DB_CONFIG1');
        $where = " and 1=1";
        if ($position != "") {
            $jobCate_list = M("casclist")->where("parentid=1")->select();

            $jobid = array();
            foreach ($jobCate_list as $jobInfo) {
                $jobid[] = $jobInfo['id'];
                $joblist = M("casclist")->where("parentid=" . $jobInfo['id'])->select();
                foreach ($joblist as $value) {
                    $jobid[] = $value['id'];
                }
            }
            $jobid = implode(",", $jobid);
            $jt = M("casclist")->where("cascname like '%" . $position . "%' and id in (" . $jobid . ")")->select();

            if ($jt) {
                $jttmp = array();
                foreach ($jt as $j) {
                    array_push($jttmp, $j['id']);
                }
                $jttmp = implode(",", $jttmp);
                $where .=" AND Jobcate in (" . $jttmp . ")";
            } else {
                $where .=" AND Jobcate in (1000000000)";
            }
        }

        if ($industry != "") {
            $jobCate_list = M("casclist")->where("parentid=2")->select();

            $jobid = array();
            foreach ($jobCate_list as $jobInfo) {
                $jobid[] = $jobInfo['id'];
                $joblist = M("casclist")->where("parentid=" . $jobInfo['id'])->select();

                foreach ($joblist as $value) {
                    $jobid[] = $value['id'];
                }
            }


            $jobid = implode(",", $jobid);
            $jt = M("casclist")->where("cascname like '%" . $industry . "%' and id in (" . $jobid . ")")->select();


            if ($jt) {
                $jttmp = array();
                foreach ($jt as $j) {
                    array_push($jttmp, $j['id']);
                }
                $jttmp = implode(",", $jttmp);
                $where .=" AND strycate in (" . $jttmp . ")";
            } else {
                $where .=" AND strycate in (1000000000)";
            }
        }

        if ($place != "") {
            $jobCate_list = M("casclist")->where("parentid='$place'")->select();

            $jobid = array();
            foreach ($jobCate_list as $jobInfo) {
                $jobid[] = $jobInfo['id'];
            }

            if ($jobid) {
                $jobid = implode(",", $jobid);
                $where .=" AND jobplace in (" . $jobid . ")";
            } else {
                $where .=" AND jobplace in (1000000000)";
            }
        }

        if ($treatment != "") {

            $where .=" AND treatment = '" . $treatment . "'";
        }

        if ($puttime != "") {

            if ($puttime == '604800') {
                //一周以内时间戳记
                $lastWeek = time() - 24 * 60 * 60 * 7;
                $where .=" AND starttime>" . $lastWeek;
            } else if ($puttime == '1209600') {
                //两周以内时间戳记
                $lastWeek = time() - 24 * 60 * 60 * 14;
                $where .=" AND starttime>" . $lastWeek;
            } else if ($puttime == '2592000') {
                //一月以内时间戳记
                $lastWeek = time() - 24 * 60 * 60 * 30;
                $where .=" AND starttime>" . $lastWeek;
            }
        }

        $arJobList = M("job")->where("checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0" . $where)->order("orderid asc, starttime desc")->limit("0,10")->select();
        $count = M("job")->where("checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0" . $where)->count();

        $page = ceil($count / 10);
        $str = "";
        for ($i = 1; $i <= $page; $i++) {
            $str = $str . "<a href='#' onclick='page(" . $i . ")'>" . $i . "</a>&nbsp&nbsp";
        }

        foreach ($arJobList as $key => &$val) {
            if ($val['Tariff'] > 10) {

                $val['Tariff'] = floor($val['Tariff'] * 0.8 / 100) * 100;
            } else {
                $val['Tariff'] = floor($val['treatment'] * $val['Tariff'] * 12 * 0.8 / 100) * 100;
            }
            $val['starttime'] = date('Y-m-d H:i:s', $val['starttime']);
            if (!$val['title']) {
                $val['title'] = M("casclist")->where("id='$val[Jobcate]'")->getField("cascname");
            } else {
                $val['title'] = $val['title'];
            }
            $val['treatment'] = M("cascadedata")->where("datagroup='treatment' and datavalue='$val[treatment]'")->getField("dataname");

            $val['education'] = M("cascadedata")->where("datagroup='education' and datavalue='$val[education]'")->getField("dataname");
            //  $val['treatment'] = M("cascadedata")->where("datagroup='treatment' and datavalue='$val[treatment]'")->getField("dataname");
            $company = M("company")->where("id='$val[cpid]'")->find();

            $val['cpname'] = $company["cpname"];

            if ($company['thumlogo']) {
                $val['thumlogo'] = $company["thumlogo"];
            } else {
                $val['thumlogo'] = "/Public/img/defoultLogo.png";
            }

            $val['experience'] = M("cascadedata")->where("datagroup='experience' and datavalue='$val[experience]'")->getField("dataname");
        }
        $workarea = $area->where("parentid = 19")->order("orderid ASC")->select();
        $money = $name->where("datagroup='treatment' AND level=0 ")->select();
        $smoney = $name->where("datagroup='Tariff' AND level=0 ")->select();
        $positime = $name->where("datagroup='puttime'  AND level=0")->select();
        $this->page = $page;
        $this->money = $money;
        $this->smoney = $smoney;
        $this->workarea = $workarea;
        $this->positime = $positime;
        $this->str = $str;
        $this->nowpage = $nowpage;
        $this->comp = $arJobList;
        $this->assign("positionss", $position);
        $this->display();
    }

    public function getIndexContent() {
        $arJobList = M("job")->where("checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0")->order("orderid asc, starttime desc")->limit(0, 18)->select();

        foreach ($arJobList as $key => &$val) {
            if ($val['Tariff'] > 10) {

                $val['Tariff'] = floor($val['Tariff'] * 0.8 / 100) * 100;
            } else {
                $val['Tariff'] = floor($val['treatment'] * $val['Tariff'] * 12 * 0.8 / 100) * 100;
            }
            $val['starttime'] = date('Y-m-d H:i:s', $val['starttime']);
            if (!$val['title']) {
                $val['title'] = M("casclist")->where("id='$val[Jobcate]'")->getField("cascname");
            } else {
                $val['title'] = $val['title'];
            }
            $val['treatment'] = M("cascadedata")->where("datagroup='treatment' and datavalue='$val[treatment]'")->getField("dataname");

            $val['education'] = M("cascadedata")->where("datagroup='education' and datavalue='$val[education]'")->getField("dataname");
            //  $val['treatment'] = M("cascadedata")->where("datagroup='treatment' and datavalue='$val[treatment]'")->getField("dataname");
            $company = M("company")->where("id='$val[cpid]'")->find();

            $val['cpname'] = $company["cpname"];

            if ($company['thumlogo']) {
                $val['thumlogo'] = $company["thumlogo"];
            } else {
                $val['thumlogo'] = "/Public/img/defoultLogo.png";
            }

            $val['experience'] = M("cascadedata")->where("datagroup='experience' and datavalue='$val[experience]'")->getField("dataname");
            $val['jobplace'] = M("casclist")->where("id='$val[jobplace]'")->getField("cascname");
        }

        $arCompany = array_chunk($arJobList, 10);
        return $arCompany;
    }

    public function index() {
        $arCompany = $this->getIndexContent();
        if (!empty($_SESSION['username'])) {
            $this->username = $_SESSION['username'];
        }
        $this->assign("code_url", $this->logs());
        ////////////////////////////////处理分享过来的连接////////////////////////////////////////////////
        $url = $_SERVER['QUERY_STRING'];
        $url = decrypt($url, "share");

        //如果是分享连接
        if ((strpos($url, "tag") !== false) && (strpos($url, "channel") !== false)) {


            $arUrl = explode("&", $url);
            $shareUrl = array();
            foreach ($arUrl as $u) {
                $au = explode("=", $u);
                $shareUrl[$au[0]] = $au[1];
            }

            $_SESSION['shreurl'] = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
            $_SESSION['backurl'] = $_SERVER['HTTP_REFERER'];
            $_SESSION['sharetag'] = $shareUrl['tag'];
            $_SESSION['sharechannel'] = $shareUrl['channel'];
            $_SESSION['shareaid'] = $shareUrl['aid'];
            $_SESSION['shareuname'] = $shareUrl['uname'];
        }
        ////////////////////////////////处理分享过来的连接////////////////////////////////////////////////
        $this->comp = $arCompany[0];
        $this->comp2 = $arCompany[1];
        $this->display();
    }

    /*
     * ****ajax返回详细职位
     */

    function login($type = null) {
        empty($type) && $this->error('参数错误');

        //加载ThinkOauth类并实例化一个对象
        import("Org.ThinkSDK.ThinkOauth");
        $sns = \ThinkOauth::getInstance($type);
        $a = $sns->getRequestCodeURL();
        var_dump($a);
        //跳转到授权页面
        redirect($sns->getRequestCodeURL());
    }

    public function callbacksina() {

        $code = $_GET['code'];

        empty($code) && $this->error('参数错误');

        $this->callback($type = 'sina', $code);
    }

    public function callbackqq() {

        $code = $_GET['code'];

        empty($code) && $this->error('参数错误');

        $this->callback($type = 'qq', $code);
    }

    public function callbackrenren() {

        $code = $_GET['code'];

        empty($code) && $this->error('参数错误');

        $this->callback($type = 'renren', $code);
    }

    public function callbackweixin() {

        $code = $_GET['code'];

        empty($code) && $this->error('参数错误');

        $this->callback($type = 'weixin', $code);
    }

    public function callback($type = null, $code = null) {

        (empty($type) || empty($code)) && $this->error('参数错误');

        //加载ThinkOauth类并实例化一个对象
        import("Org.ThinkSDK.ThinkOauth");
        $sns = \ThinkOauth::getInstance($type);
        //腾讯微博需传递的额外参数
        $extend = null;
        if ($type == 'tencent') {
            $extend = array('openid' => $this->_get('openid'), 'openkey' => $this->_get('openkey'));
        }

        //请妥善保管这里获取到的Token信息，方便以后API调用
        //调用方法，实例化SDK对象的时候直接作为构造函数的第二个参数传入
        //如： $qq = ThinkOauth::getInstance('qq', $token);

        $token = $sns->getAccessToken($code, $extend);
        //获取当前登录用户信息
        if (is_array($token)) {

            //设置登陆成功   
            if ($type == "sina") {
                $data['username'] = "sina_" . $token['openid'];
                $this->otherLogin($data, "sina");
            } elseif ($type == "qq") {

                $userinfo = $this->getQqUserinfo($token['access_token']);
                $user_info = $this->std_class_object_to_array(json_decode($userinfo));
//                
//    
//                echo("<h1>恭喜！使用 {$type} 用户登录成功</h1><br>");
//                echo("授权信息为：<br>");
//                dump($token);
//                echo("当前登录用户信息为：<br>");
//                dump($user_info);
//                die;
//                
//                echo "qq登陆接口测试中,咱不能提供服务<br/>";
//                echo "<pre>";
//                var_dump($token);
//                echo "</pre>";
//                die;

                $data['username'] = "qq_" . $user_info['nickname'];
                $this->otherLogin($data, "qq");
            } elseif ($type == "renren") {
                $data['username'] = "renren_" . $token['openid'];
                $this->otherLogin($data, "renren");
            } elseif ($type == "weixin") {
                $data['username'] = "weixin_" . $token['openid'];
                $this->otherLogin($data, "weixin");
            }

//            //$user_info = A('Type', 'Event')->$type($token);
//
//            echo("<h1>恭喜！使用 {$type} 用户登录成功</h1><br>");
//            echo("授权信息为：<br>");
//            dump($token);
//            echo("当前登录用户信息为：<br>");
            //dump($user_info);
        }
    }

    /**
     * 对象转换成数组格式
     *
     * $stdclassobject object
     *
     * return array
     */
    public function std_class_object_to_array($stdclassobject) {
        $_array = is_object($stdclassobject) ? get_object_vars($stdclassobject) : $stdclassobject;
        foreach ($_array as $key => $value) {
            $value = (is_array($value) || is_object($value)) ? $this->std_class_object_to_array($value) : $value;
            $array[$key] = $value;
        }
        return $array;
    }

    function getQqUserinfo($token) {

        $url = "https://graph.qq.com/oauth2.0/me?access_token=$token";
        $info = file_get_contents($url);
        //将返回值转为数组
        $info1 = substr($info, 9, -3);
        $info2 = json_decode($info1);
        $info3 = $this->std_class_object_to_array($info2);
        $key = $info3['client_id'];
        $openid = $info3['openid'];
        $userinfoUrl = "https://graph.qq.com/user/get_user_info?access_token=$token&oauth_consumer_key=$key&openid=$openid";
        $userinfo = file_get_contents($userinfoUrl);
        return $userinfo;
    }

    function check() {
        $model = M('userinfo', 'stj_', 'DB_CONFIG1');
        $zhuceUser = I("username");
        if ($model->where("username='" . $zhuceUser . "'")->select()) {
            echo "0";
        } else {
            echo "1";
        }
    }

    function ajaxReturn() {
        $model = M('casclist', 'stj_', 'DB_CONFIG1');
        $id = I('id');
        $posi = $model
                ->where("parentid=" . $id . "")
                ->select();
        $this->posi = $posi;
        $this->display();
    }

    /*
     * ****注册
     */

    public function add() {


        $model = M('userinfo', 'stj_', 'DB_CONFIG1');

        //获取用户的类型
        $table = $_POST['usertype'];
        //根据用户判断进入哪个表
        if ($table == "1") {
            $tableName = "company";
        } else {
            $tableName = "member";
        }
        $Card = M("" . $tableName . "", 'stj_', 'DB_CONFIG1');
        //用户的类型
        $data['flag'] = $table;
        $data['password'] = md5(md5($_POST['password']));
        $data['username'] = $_POST['username'];
        $card['username'] = $data['username'];
        $card['password'] = $data['password'];
        $card['email'] = $_POST['email'];
        $card['pwd'] = $_POST['password'];
        $card['activation'] = 1;
        $card['regip'] = $_SERVER["REMOTE_ADDR"];
        $card['regtime'] = time();
        $card['logintime'] = time();
        $isExit = M("member")->where("username='$data[username]'")->find();
        if ($isExit) {
            echo json_encode(array("code" => 200, "msg" => "此用户已经注册！"));
            exit();
        }
        $title = "人人猎成功注册确认邮件";
        $a = "cccc";
        $b = "aaaa";
        $c = "bbbb";
        $abc = md5($a . $b . $c);
        $verify = md5($data['username'] . $abc);
        $url = "http://" . $_SERVER['HTTP_HOST'] . "/Home/Index/registerv/verify/" . $verify . "/username/" . $data['username'] . "";
        $content = " <p>您好，感谢您注册（www.renrenlie.com）。这是一封注册确认邮件。</p>";
        $content .= "<p>请点击以下链接完成确认：<a href='" . $url . "'>" . $url . "</a></p>";
        $content .= "<p>如果链接不能点击，请复制地址到浏览器，然后直接打开。</p>";
        $content .="人人猎";
        
        //分享职位送大礼
        if ($_SESSION['shreurl'] && C("SHARE_JOB_ID") == $_SESSION['shareaid']) {
            $data['form'] = $_SESSION['shreurl'];
            $data['is_gift'] = 1;
            $data['fromusername'] = $_SESSION['shareuname'];
            $card['from'] = "share";
        }
      
        //邮箱发送成功之后把用户信息添加进数据库,默认为零不激活
        if (SendMail($_POST['email'], $title, $content)) {
            if ($model->add($data)) {
                if ($Card->add($card)) {
                    $this->username = $data["username"];
                    $this->password = $data["password"];
                    $this->email = $_POST["email"];
                    // $this->display("register");
                    echo json_encode(array("code" => 200, "msg" => "注册成功！"));
                    exit();
                }
            }
        } else {

            echo json_encode(array("code" => 500, "msg" => "邮箱发送失败，请稍候！"));
            exit();
        }
    }

    function huopass() {
        $arCompany = $this->getIndexContent();
        if (!empty($_SESSION['username'])) {
            $this->username = $_SESSION['username'];
        }
        $this->assign("code_url", $this->logs());

        $this->comp = $arCompany[0];
        $this->comp2 = $arCompany[1];
        $this->display();
    }

    public function huoquyou2() {

        $arCompany = $this->getIndexContent();
        if (!empty($_SESSION['username'])) {
            $this->username = $_SESSION['username'];
        }
        $this->assign("code_url", $this->logs());

        $this->comp = $arCompany[0];
        $this->comp2 = $arCompany[1];
        $mailServer = $this->gotomail($_GET['email']);
        $mailTo = $this->gotomail($_GET['email']);
        $this->assign("mailTo", "http://" . $mailTo);
        $this->assign("email", $_GET['email']);
        $this->display();
    }

    function huoquyou() {
        $email = I('email');
        $decide1 = M("member")->where("email='" . $email . "'")->find();
        $decide2 = M("company")->where("email='" . $email . "'")->find();
        if (!empty($decide1) || !empty($decide2)) {
            if (empty($decide1)) {

                $username = $decide2['username'];
            } else {
                $username = $decide1['username'];
            }
            $title = "人人猎密码重置邮件";
            $a = "cccc";
            $b = "aaaa";
            $c = "bbbb";
            $abc = md5($a . $b . $c);
            $verify = md5($username . $abc);


            $url = "http://" . $_SERVER['HTTP_HOST'] . "/Home/Index/huoquvs/verify/" . $verify . "/username/" . $username;
            $content = " <p>您好，感谢您使用人人猎。这是一封密码重置邮件。 </p>";
            $content .= "<p>请点击以下链接完成密码重置操作：<a href='" . $url . "'>" . $url . "</a></p>";
            $content .= "<p>如果链接不能点击，请复制地址到浏览器，然后直接打开。</p>";
            $content .="人人猎";
            //邮箱发送成功之后把用户信息添加进数据库,默认为零不激活
            if (SendMail($email, $title, $content)) {



                echo json_encode(array("code" => 200, "msg" => "ok"));
                exit();
                //$this->display();
            } else {
                echo json_encode(array("code" => 500, "msg" => "发送失败"));
                exit();
            }
        } else {
            echo json_encode(array("code" => 500, "msg" => "注册邮箱不存在"));
            exit();
        }
    }

    public function gotomail($mail) {
        $t = explode('@', $mail);
        $t = strtolower($t[1]);
        if ($t == '163.com') {
            return 'mail.163.com';
        } else if ($t == 'vip.163.com') {
            return 'vip.163.com';
        } else if ($t == '126.com') {
            return 'mail.126.com';
        } else if ($t == 'qq.com' || $t == 'vip.qq.com' || $t == 'foxmail.com') {
            return 'mail.qq.com';
        } else if ($t == 'gmail.com') {
            return 'mail.google.com';
        } else if ($t == 'sohu.com') {
            return 'mail.sohu.com';
        } else if ($t == 'tom.com') {
            return 'mail.tom.com';
        } else if ($t == 'vip.sina.com') {
            return 'vip.sina.com';
        } else if ($t == 'sina.com.cn' || $t == 'sina.com') {
            return 'mail.sina.com.cn';
        } else if ($t == 'tom.com') {
            return 'mail.tom.com';
        } else if ($t == 'yahoo.com.cn' || $t == 'yahoo.cn') {
            return 'mail.cn.yahoo.com';
        } else if ($t == 'tom.com') {
            return 'mail.tom.com';
        } else if ($t == 'yeah.net') {
            return 'www.yeah.net';
        } else if ($t == '21cn.com') {
            return 'mail.21cn.com';
        } else if ($t == 'hotmail.com') {
            return 'www.hotmail.com';
        } else if ($t == 'sogou.com') {
            return 'mail.sogou.com';
        } else if ($t == '188.com') {
            return 'www.188.com';
        } else if ($t == '139.com') {
            return 'mail.10086.cn';
        } else if ($t == '189.cn') {
            return 'webmail15.189.cn/webmail';
        } else if ($t == 'wo.com.cn') {
            return 'mail.wo.com.cn/smsmail';
        } else if ($t == '139.com') {
            return 'mail.10086.cn';
        } else {
            return '';
        }
    }

    function register() {

        $arCompany = $this->getIndexContent();
        if (!empty($_SESSION['username'])) {
            $this->username = $_SESSION['username'];
        }
        $this->assign("code_url", $this->logs());

        $this->comp = $arCompany[0];
        $this->comp2 = $arCompany[1];
        $mailTo = $this->gotomail($_GET['email']);
        $this->assign("mailTo", $mailTo);
        $this->display();
    }

    function registerv() {
        $model = M('userinfo', 'stj_', 'DB_CONFIG1');
        $username = I('username');
        $a = "cccc";
        $b = "aaaa";
        $c = "bbbb";
        $abc = md5($a . $b . $c);
        $this->assign("username", $username);
        $userInfo = $model->where("username='" . $username . "'")->find();
        if (empty($userInfo)) {

            $this->error("非法请求", U('Index/index'));
        }
        if (md5($username . $abc) == I("verify")) {
            $arCompany = $this->getIndexContent();
            if (!empty($_SESSION['username'])) {
                $this->username = $_SESSION['username'];
            }
            $this->assign("code_url", $this->logs());

            $this->comp = $arCompany[0];
            $this->comp2 = $arCompany[1];
            if ($userInfo["flag"] == "0") {
                $arMemberInfo = M("member")->where("username='" . $username . "'")->find();
                if (($arMemberInfo['regtime'] + 24 * 3600) < time()) {
                    $this->error("请到首页登录", U('Index/index'));
                }
                //修改登陆的信息
                $arUserLogin = array("logintime" => time(), "loginip" => $_SERVER["REMOTE_ADDR"]);
                M("member")->where("username='" . $username . "' ")->save($arUserLogin);
                session('username', $username);
                $url = U('Login/userinfo');
            } else if ($userInfo["flag"] == "1") {
                $arCompanyInfo = M("company")->where("username='" . $username . "'")->find();
                if (($arCompanyInfo['regtime'] + 24 * 3600) < time()) {
                    $this->error("请到首页登录", U(''));
                }
                //修改登陆的信息
                $arUserLogin = array("logintime" => time(), "loginip" => $_SERVER["REMOTE_ADDR"]);
                M("company")->where("username='" . $username . "'")->save($arUserLogin);
                session('cusername', $username);
                $url = U("Company/EnterpriseInformation");
            }
            $model = M('userinfo', 'stj_', 'DB_CONFIG1');
            $sql = "update stj_userinfo set status=1 where username='" . $username . "'";
            $this->assign("url", $url);
            if ($model->execute($sql)) {
                $this->display();
            } else {
                $this->display();
            }
        } else {

            $this->error("非法请求");
        }
    }

    //判断用户登陆
    function userlogin() {

        if (empty($username) || empty($password)) {
            $username = I("username");
            $password = md5(md5(I("password")));
            //查询账户密码是否存在
            $isExitUser = M('userinfo')->where("username='" . $username . "' and password='" . $password . "'")->find();
            if ($isExitUser) {
                $remembeme = $_POST['remembeme'];

                if ($remembeme == "true") {
                    setcookie("username", $username);
                    setcookie("password", I("password"));
                } else {

                    setcookie("username", "");
                    setcookie("password", "");
                }
                //判断是不是用户系统合并后有相同登陆用户名和密码,0是推荐人1是企业
                $isCompanyUser = M("userinfo")->where("username='" . $username . "' and password='" . $password . "' and flag=0")->find();
                $isMemberUser = M("userinfo")->where("username='" . $username . "' and password='" . $password . "' and flag=1")->find();

                $isDouble = 0;
                if ($isCompanyUser) {
                    $isDouble = $isDouble + 1;
                }
                if ($isMemberUser) {
                    $isDouble = $isDouble + 1;
                }

                //如果是企业和推荐人的双重身份，则修改推荐人的用户名+hr
                if ($isDouble == 2) {
                    $sql = "UPDATE stj_userinfo set username=concat('hr',`username`) where username='" . $username . "' and password='" . $password . "' and flag=0";

                    M("userinfo")->query($sql);
                    //修改登陆的信息
                    $sql2 = "UPDATE stj_member set username=concat('hr',`username`), loginip ='$_SERVER[REMOTE_ADDR]',logintime =" . time() . " where username='" . $username . "' and password='" . $password . "'";
                    M("member")->query($sql2);

                    session('username', "hr" . $username);
                    ///home/Login/RecommendTheCandidate//comid/165/jobid/285.html
                    //判断来源是否是推荐职位页面
                    $currentAction = $_POST['currentAction'];
                    if ($currentAction == "EnterIndex2") {
                        $enterIndexComId = $_POST['enterIndexComId'];
                        $enterIndexJobId = $_POST['enterIndexJobId'];
                        $url = U('Home/Login/RecommendTheCandidate/comid/' . $enterIndexComId . '/jobid/' . $enterIndexJobId);
                    } else {
                        $url = U('Login/userinfo');
                    }
                    echo json_encode(array("code" => 201, "msg" => $url));
                    exit();
                } else {
                    if ($isExitUser['status'] == "1") {
                        if ($isExitUser["flag"] == "0") {
                            //修改登陆的信息
                            $arUserLogin = array("logintime" => time(), "loginip" => $_SERVER["REMOTE_ADDR"]);
                            M("member")->where("username='" . $username . "' and password='" . $password . "'")->save($arUserLogin);
                            session('username', $username);
                            //判断来源是否是推荐职位页面
                            $currentAction = $_POST['currentAction'];
                            if ($currentAction == "EnterIndex2") {
                                $enterIndexComId = $_POST['enterIndexComId'];
                                $enterIndexJobId = $_POST['enterIndexJobId'];
                                $url = U('Home/Login/RecommendTheCandidate/comid/' . $enterIndexComId . '/jobid/' . $enterIndexJobId);
                            } else {
                                $url = U('Login/userinfo');
                            }
                            echo json_encode(array("code" => 200, "msg" => $url));
                            exit();
                        } else if ($isExitUser["flag"] == "1") {
                            //修改登陆的信息
                            $arUserLogin = array("logintime" => time(), "loginip" => $_SERVER["REMOTE_ADDR"]);
                            M("company")->where("username='" . $username . "' and password='" . $password . "'")->save($arUserLogin);
                            session('cusername', $username);
                            echo json_encode(array("code" => 200, "msg" => U('Company/EnterpriseInformation')));
                            exit();
                        }
                    } else {
                        echo json_encode(array("code" => 500, "msg" => "用户未激活,详情咨询客服"));
                        exit();
                    }
                }
            } else {
                echo json_encode(array("code" => 500, "msg" => "用户名或者密码不正确,请重新登录"));
                exit();
            }
        }
    }

    function huoquvs() {
        $arCompany = $this->getIndexContent();


        $this->comp = $arCompany[0];
        $this->comp2 = $arCompany[1];
        $this->username = I('username');
        $this->tableName = I('type');
        $this->verify = I('verify');
        $this->display();
    }

    function save() {
        $username = $_POST['username'];
        $data["password"] = md5(md5(I('password')));

        $type['password'] = md5(md5(I('password')));
        $type['pwd'] = I('password');
        $verify = I('verify');
        $a = "cccc";
        $b = "aaaa";
        $c = "bbbb";
        $abc = md5($a . $b . $c);
        if (md5($username . $abc) == $verify) {
            $model = M('userinfo', 'stj_', 'DB_CONFIG1');

            $userinfo = $model->where("username='" . $username . "'")->save($data);
            $sql = "update stj_member set password='" . $type['password'] . "', pwd='" . $type['pwd'] . "' where username='" . $username . "'";
            M("member")->query($sql);
            $sql2 = "update stj_company set password='" . $type['password'] . "', pwd='" . $type['pwd'] . "' where username='" . $username . "'";
            M("company")->query($sql2);
            echo json_encode(array("code" => "200", "msg" => "ok"));
        } else {
            echo json_encode(array("code" => "500", "msg" => "参数错误"));
        }
    }

    function EnterIndex2() {
        $model = M('job', 'stj_', 'DB_CONFIG1');
        $cmodel = M('company', 'stj_', 'DB_CONFIG1');
        $comid = I('comid');
        $jobid = I('jobid');
        $jobInfo = $model->where("id=" . $jobid)->find();
        $comInfo = $cmodel->where("id=" . $comid)->find();
        if ($jobInfo['is_deleted'] == 1 || $jobInfo['checkinfo'] == "false" || empty($comInfo)) {
            $this->error("非法请求");
            exit();
        }

        $comInfo['nature'] = M("cascadedata")->where("datagroup='nature' and datavalue=" . $comInfo['nature'])->getField("dataname");
        $comInfo['scale'] = M("cascadedata")->where("datagroup='scale' and datavalue=" . $comInfo['scale'])->getField("dataname");
        $comInfo['stage'] = M("cascadedata")->where("datagroup='stage' and datavalue=" . $comInfo['stage'])->getField("dataname");

        if ($jobInfo['Tariff'] > 10) {

            $jobInfo['Tariff'] = floor($jobInfo['Tariff'] * 0.8 / 100) * 100;
        } else {
            $jobInfo['Tariff'] = floor($jobInfo['treatment'] * $jobInfo['Tariff'] * 12 * 0.8 / 100) * 100;
        }

        if (!$jobInfo['title']) {
            $jobInfo['title'] = M("casclist")->where("id='$jobInfo[Jobcate]'")->getField("cascname");
        } else {
            $jobInfo['title'] = $jobInfo['title'];
        }
        $jobInfo['starttime'] = date('Y-m-d H:i:s', $jobInfo['starttime']);
        $jobInfo['posttime'] = ($jobInfo['posttime'] ? date('Y-m-d', $jobInfo['posttime']) : "");
        $jobInfo['endtime'] = date('Y-m-d', $jobInfo['endtime']);
        $jobInfo['casc'] = M("casclist")->where("id=" . $jobInfo['jobplace'])->getField("cascname");
        $jobInfo['ccas'] = M("cascadedata")->where("datagroup='education' and datavalue=" . $jobInfo['education'])->getField("dataname");
        $jobInfo['ccasc'] = M("cascadedata")->where("datagroup='experience' and datavalue=" . $jobInfo['experience'])->getField("dataname");
        $jobInfo['dataname'] = M("cascadedata")->where("datagroup='treatment' and datavalue=" . $jobInfo['treatment'])->getField("dataname");
        $jobInfo['tn'] = M("record")->where("j_id='$jobid'")->count();

        $shareUrl = "http://www.renrenlie.com/index.php";
        if ($_SESSION['username']) {
            $username = $_SESSION['username'];
            $flag = "0";
            $shareUrlTmp = "tag=ShareJob&channel=WebShare&aid=1&uname=" . $username;
            $shareUrl = $shareUrl . "?" . encrypt($shareUrlTmp, "share");
        } elseif ($_SESSION['cusername']) {
            $username = $_SESSION['cusername'];
            $flag = "1";
            $shareUrlTmp = "tag=ShareJob&channel=WebShare&aid=1&uname=" . $username;
            $shareUrl = $shareUrl . "?" . encrypt($shareUrlTmp, "share");
        } else {
            $username = "";
            $flag = "";
        }
        $share['url'] = $shareUrl;
        $share['title'] = "即刻分享" . $jobInfo[title] . "职位，立得N个“百元”现金。";
        $share['description'] = "[renrenlie.com] " . $comInfo[cpname] . "直招" . $jobInfo[title] . "职位" . $jobInfo[employ] . "人,月薪:" . $jobInfo[dataname] . " ，推荐或自荐成功入职即得推荐费" . $jobInfo[Tariff] . "元。";
        $this->assign("shareurl", $shareUrl);
        $this->assign("share", $share);
        $this->cp = $jobInfo;
        $this->comp = $comInfo;
        $this->assign("username", $username);
        $this->assign("flag", $flag);
        $this->display();
    }

    function EnterIndex() {
        $comid = $_GET['comid'];
        $comInfo = M("company")->where("id=" . $comid)->find();
        $comInfo['nature'] = M("cascadedata")->where("datagroup='nature' and datavalue=" . $comInfo['nature'])->getField("dataname");
        $comInfo['scale'] = M("cascadedata")->where("datagroup='scale' and datavalue=" . $comInfo['scale'])->getField("dataname");
        $comInfo['stage'] = M("cascadedata")->where("datagroup='stage' and datavalue=" . $comInfo['stage'])->getField("dataname");
        $comInfo['brightreg'] = date("Y.m");
        //热招职位
        $where = " AND cpid='$comid'";
        $arJobList = M("job")->where("checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0" . $where)->order("orderid asc, starttime desc")->limit("0,10")->select();
        foreach ($arJobList as &$val) {
            if ($val['Tariff'] > 10) {

                $val['Tariff'] = floor($val['Tariff'] * 0.8 / 100) * 100;
            } else {
                $val['Tariff'] = floor($val['treatment'] * $val['Tariff'] * 12 * 0.8 / 100) * 100;
            }
            $val['starttime'] = date('Y-m-d H:i:s', $val['starttime']);
            if (!$val['title']) {
                $val['title'] = M("casclist")->where("id='$val[Jobcate]'")->getField("cascname");
            } else {
                $val['title'] = $val['title'];
            }
            $val['treatment'] = M("cascadedata")->where("datagroup='treatment' and datavalue='$val[treatment]'")->getField("dataname");

            $val['education'] = M("cascadedata")->where("datagroup='education' and datavalue='$val[education]'")->getField("dataname");
            //  $val['treatment'] = M("cascadedata")->where("datagroup='treatment' and datavalue='$val[treatment]'")->getField("dataname");
            $val['cpname'] = M("company")->where("id='$val[cpid]'")->getField("cpname");
            $val['experience'] = M("cascadedata")->where("datagroup='experience' and datavalue='$val[experience]'")->getField("dataname");
            $val['jobplace'] = M("casclist")->where("id='$val[jobplace]'")->getField("cascname");
        }
        $this->assign("arJobList", $arJobList);
        $this->assign("companyInfo", $comInfo);
        $this->display();
    }

    function RecommendTheCandidate() {
        $username = $_SESSION['username'];
        $cid = $_GET['comid'];

        if ($_SESSION['username']) {
            $userInfo = M("userinfo")->where("username='$_SESSION[username]' AND status =1")->find();
            if ($userInfo['flag'] == 1) {
                $this->error("您的账号是企业账号请注册推荐人账号后再试", U('Index/index'));
                exit();
            }
        } else {
            $this->error("请登录后再试", U('Index/index'));
            exit();
        }

        //  RecommendTheCandidate&position={$cp.title}&comid=<php>echo $_GET['comid'];</php>&jobid={$cp.id}
        //    var_dump(U('Login/RecommendTheCandidate/position/'.$_GET['position'].'/comid/'.$cid.'/jobid/'.$_GET['jobid']));
        $this->redirect(('home/Login/RecommendTheCandidate/position/' . $_GET['position'] . '/comid/' . $cid . '/jobid/' . $_GET['jobid']));
    }

    function tjrzpfjs() {
        $this->assign("first_class", 1);
        $this->assign("second_class", 1);
        $this->display();
    }

    function srzy() {
        $this->assign("first_class", 1);
        $this->assign("second_class", 2);
        $this->display();
    }

    function tjrxy() {
        $this->assign("first_class", 2);
        $this->assign("second_class", 3);
        $this->display();
    }

    function zpfxy() {
        $this->assign("first_class", 2);
        $this->assign("second_class", 4);
        $this->display();
    }

    function yhys() {
        $this->assign("first_class", 2);
        $this->display();
    }

    function lxwm() {
        $this->assign("first_class", 2);
        $this->display();
    }

    public function otherLogin($data, $from) {
        $isExitLogin = $this->isExitLogin($data);
        if ($isExitLogin === false) {
            session('username', $data['username']);
            $this->success("", U('Login/userinfo'));
        } else {
            //用户的类型
            $data['flag'] = 0;
            $data['password'] = md5(md5(123456));
            $data['status'] = 1;
            $data['username'] = $data['username'];
            $card['username'] = $data['username'];
            $card['password'] = $data['password'];
            $card['pwd'] = 123456;
            $card['fromwhere'] = $from;
            $card['activation'] = 1;
            $card['regip'] = $_SERVER["REMOTE_ADDR"];
            $card['regtime'] = time();
            $card['logintime'] = time();
            M("userinfo")->add($data);
            M("member")->add($card);
            session('username', $data['username']);
            $this->success("", U('Login/userinfo'));
        }
    }

    public function isExitLogin($data) {
        $isExit = M("member")->where("username='$data[username]'")->find();
        if ($isExit) {
            return false;
        } else {
            return true;
        }
    }

    public function checkemail() {
        $eamil = $_POST['eamil'];
        $usertype = $_POST['usertype'];
        $isExit = M("company")->where("email='$eamil'")->find();

        $isExit2 = M("member")->where("email='$eamil'")->find();

        if ($isExit || $isExit2) {
            echo json_encode(array("code" => 500, "msg" => "此邮箱已经注册!"));
        } else {
            echo json_encode(array("code" => 200, "msg" => "ok!"));
        }
    }

    public function saveShareUrl() {
        $urlTmp = explode("?", $_POST['url']);
        $data = array();

        $data['decrypturl'] = $_POST['url'];
        $url = decrypt($urlTmp[1], "share");

        $username = ($_SESSION['username'] ? $_SESSION['username'] : $_SESSION['cusername']);

        //如果是分享连接
        if ((strpos($url, "tag") !== false) && (strpos($url, "channel") !== false) && $username) {

            $userinfo = M("userinfo")->where("username='$username'")->find();


            $arUrl = explode("&", $url);
            $shareUrl = array();
            foreach ($arUrl as $u) {
                $au = explode("=", $u);
                $shareUrl[$au[0]] = $au[1];
            }

            $shareUrl2 = $urlTmp[0];
            $shareUrlTmp = "tag=" . $shareUrl['tag'] . "&channel=" . $shareUrl['channel'] . "&aid=" . $shareUrl['aid'] . "&uname=" . $username;
            $shareUrl2 = $shareUrl2 . "?" . $shareUrlTmp;
            $data['url'] = $shareUrl2;
            $activeInfo = M("active")->where("id='$shareUrl[aid]'")->find();
            $data['uid'] = $userinfo['userid'];
            $data['username'] = $userinfo['username'];
            $data['tag'] = $shareUrl['tag'];
            $data['channel'] = $shareUrl['channel'];
            $data['activeid'] = $shareUrl['aid'];
            $data['activename'] = $activeInfo['activename'];
            $data['click'] = 0;
            $data['num'] = 0;
            $data['comment'] = '';
            $data['created_at'] = $data['updated_at'] = time();
            $isExit = M("share")->where("decrypturl='$data[url]'")->find();
            if (!$isExit) {
                M("share")->add($data);
            }
        }
    }

}
