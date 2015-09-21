<?php

namespace Home\Controller;

use Think\Controller;
use Think\Upload;

header("Content-type: text/html; charset=utf-8");

class IndexController extends TestController {
        /*
         * ****主页显示
         */

        static private $_size = 10;
        private $isCheckNickname = true;

        public function __construct() {
                if (is_weixin() === true) {
                        header('Location: http://m.renrenlie.com/');
                }
                parent::__construct();                
                
                if (!empty($_SESSION['username']) || !empty($_SESSION['cusername'])) {
                        $username = ($_SESSION['username'] ? $_SESSION['username'] : $_SESSION['cusername']);
                        $decide = M('userinfo')->where("username='" . $username . "'")->select();
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
        }

        //搜索分页方法
        function page() {

                $nowpage = I('i'); //当前页码
                $position = I('position'); //职位 1
                $industry = I("industry");  //行业 2
                $place = I('area'); //所在地区
                $title = trim(I('title')); //职位名称
                $treatment = I('treatment'); //工资待遇
                $puttime = I('puttime'); //发布时间
                $cpname = I('cpname'); //公司名称

                if ($cpname) {
                        $where .=" AND (cpname like '%" . $cpname . "%') ";
                }
                if ($title) {
                        //关键词模糊查询
                        $keywordGroup = M("keyword_group")->where("keyword_group like '%" . $title . "%'")->getField("keyword_group");
                        if ($keywordGroup) {
                                $arKeywordGroup = explode(" ", $keywordGroup);
                                $titleTmp = "";
                                foreach ($arKeywordGroup as $keyword) {
                                        if ($keyword) {
                                                $titleTmp .=" or title like '%" . $keyword . "%' ";
                                        }
                                }
                        }
                        if (strlen($titleTmp) > 0) {
                                $where .=" AND (title like '%" . $title . "%' " . $titleTmp . ") ";
                        } else {
                                $where .=" AND (title like '%" . $title . "%') ";
                        }
                }
                //职位
                if ($position != "") {
                        $jt = M("casclist")->where("parentid='" . $position . "'")->select();
                        $industryid = array();
                        foreach ($jt as $j) {
                                $industryid[] = $j['id'];
                        }
                        $industryid[] = $position;
                        $sindustryid = implode(",", $industryid);
                        if ($sindustryid) {
                                $where .=" AND Jobcate in (" . $sindustryid . ")";
                        } else {
                                $where .=" AND Jobcate in (1000000000)";
                        }
                }

                //行业类别
                if ($industry != "") {
                        $jt = M("casclist")->where("parentid='" . $industry . "'")->select();
                        $industryid = array();
                        foreach ($jt as $j) {
                                $industryid[] = $j['id'];
                        }
                        $industryid[] = $industry;
                        $sindustryid = implode(",", $industryid);
                        if ($sindustryid) {
                                $where .=" AND strycate in (" . $sindustryid . ")";
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

                $count = M("job")->where("employ>(select count(*) from stj_record where stj_record.j_id = stj_job.id and audstart=6) and checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0  and is_show=1" . $where)->count();
                $page = new \Think\Snewpage($count, self::$_size);
                $arJobList = M("job")->where("employ>(select count(*) from stj_record where stj_record.j_id = stj_job.id and audstart=6) and  checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0  and is_show=1" . $where)->order("orderid ASC,checktime DESC, starttime DESC")->limit($page->firstRow, $page->listRows)->select();
                $show = $page->show();

                foreach ($arJobList as $key => &$val) {
                        //计算招聘费用，20%留作系统费用
                        if ($val['Tariff'] > 10) {
                                $val['Tariff'] = floor($val['Tariff'] * 0.8 / 100) * 100;
                        } else {
                                $val['Tariff'] = floor($val['treatment'] * $val['Tariff'] * 12 * 0.8 / 100) * 100;
                        }
                        //发布时间
                        $val['starttime'] = (($val['checktime'] != 0) ? date('Y-m-d H:i', $val['checktime']) : date('Y-m-d H:i', $val['starttime']));
                        //职位名称
                        if (!$val['title']) {
                                $val['title'] = M("casclist")->where("id='$val[Jobcate]'")->getField("cascname");
                        } else {
                                $val['title'] = $val['title'];
                        }
                        //工资待遇
                        $val['treatment'] = M("cascadedata")->where("datagroup='treatment' and datavalue='$val[treatment]'")->getField("dataname");
                        //学历要求
                        $val['education'] = M("cascadedata")->where("datagroup='education' and datavalue='$val[education]'")->getField("dataname");
                        //公司信息
                        $company = M("company")->where("id=" . $val['cpid'])->find();
                        //公司名称
                        $val['cpname'] = $company["cpname"];
                        //公司性质
                        $val['nature'] = M("cascadedata")->where("datagroup='nature' and datavalue=" . $company['nature'])->getField("dataname");
                        //公司规模
                        $val['scale'] = M("cascadedata")->where("datagroup='scale' and datavalue=" . $company['scale'])->getField("dataname");
                        //公司缩略图
                        $val['thumlogo'] = ($company['thumlogo'] ? $company['thumlogo'] : "/Public/img/defoultLogo.png");
                        //工作经验要求
                        $val['experience'] = M("cascadedata")->where("datagroup='experience' and datavalue='$val[experience]'")->getField("dataname");
                        $val['strycate'] = M("casclist")->where("id='$val[strycate]'")->getField("cascname");
                        $val['stage'] = M("cascadedata")->where("datagroup='stage' and datavalue=" . $company['stage'])->getField("dataname");
                        $val['record_num'] = M("record")->where("j_id=" . $val['id'])->count();
                        //工作地点
                        $val['jobplace'] = M("casclist")->where("id='$val[jobplace]'")->getField("cascname");
                }
                $this->nowpage = $nowpage;
                $this->assign("page", $show);
                $this->assign("arJobList", $arJobList);
                $this->display("page");
        }

        function searchs() {

                $nowpage = I('i'); //当前页码
                $position = I('position'); //职位 1
                $industry = I("industry");  //行业 2
                $place = I('area'); //所在地区
                $title = trim(I('title')); //职位名称
                $treatment = I('treatment'); //工资待遇
                $puttime = I('puttime'); //发布时间
                $cpname = I('cpname'); //发布时间
                if ($title) {
                        //关键词模糊查询
                        $keywordGroup = M("keyword_group")->where("keyword_group like '%" . $title . "%'")->getField("keyword_group");
                        if ($keywordGroup) {
                                $arKeywordGroup = explode(" ", $keywordGroup);
                                $titleTmp = "";
                                foreach ($arKeywordGroup as $keyword) {
                                        if ($keyword) {
                                                $titleTmp .=" or title like '%" . $keyword . "%' ";
                                        }
                                }
                        }
                        if (strlen($titleTmp) > 0) {
                                $where .=" AND (title like '%" . $title . "%' " . $titleTmp . ") ";
                        } else {
                                $where .=" AND (title like '%" . $title . "%') ";
                        }
                }
                if ($cpname) {
                        $where .=" AND (cpname like '%" . $cpname . "%') ";
                }
                //职位
                if ($position != "") {
                        $jt = M("casclist")->where("parentid='" . $position . "'")->select();
                        $industryid = array();
                        foreach ($jt as $j) {
                                $industryid[] = $j['id'];
                        }
                        $industryid[] = $position;
                        $sindustryid = implode(",", $industryid);
                        if ($sindustryid) {
                                $where .=" AND Jobcate in (" . $sindustryid . ")";
                        } else {
                                $where .=" AND Jobcate in (1000000000)";
                        }
                }

                //行业类别
                if ($industry != "") {
                        $jt = M("casclist")->where("parentid='" . $industry . "'")->select();
                        $industryid = array();
                        foreach ($jt as $j) {
                                $industryid[] = $j['id'];
                        }
                        $industryid[] = $industry;
                        $sindustryid = implode(",", $industryid);
                        if ($sindustryid) {
                                $where .=" AND strycate in (" . $sindustryid . ")";
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

                $count = M("job")->where("employ>(select count(*) from stj_record where stj_record.j_id = stj_job.id and audstart=6) and checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0 and is_show=1" . $where)->count();
                $page = new \Think\Snewpage($count, self::$_size);
                $arJobList = M("job")->where("employ>(select count(*) from stj_record where stj_record.j_id = stj_job.id and audstart=6) and  checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0  and is_show=1" . $where)->order("orderid ASC,checktime DESC, starttime DESC")->limit($page->firstRow, $page->listRows)->select();
                $show = $page->show();

                foreach ($arJobList as $key => &$val) {
                        //计算招聘费用，20%留作系统费用
                        if ($val['Tariff'] > 10) {
                                $val['Tariff'] = floor($val['Tariff'] * 0.8 / 100) * 100;
                        } else {
                                $val['Tariff'] = floor($val['treatment'] * $val['Tariff'] * 12 * 0.8 / 100) * 100;
                        }
                        //发布时间
                        $val['starttime'] = (($val['checktime'] != 0) ? date('Y-m-d H:i', $val['checktime']) : date('Y-m-d H:i', $val['starttime']));
                        //职位名称
                        if (!$val['title']) {
                                $val['title'] = M("casclist")->where("id='$val[Jobcate]'")->getField("cascname");
                        } else {
                                $val['title'] = $val['title'];
                        }
                        //工资待遇
                        $val['treatment'] = M("cascadedata")->where("datagroup='treatment' and datavalue='$val[treatment]'")->getField("dataname");
                        //学历要求
                        $val['education'] = M("cascadedata")->where("datagroup='education' and datavalue='$val[education]'")->getField("dataname");
                        //公司信息
                        $company = M("company")->where("id=" . $val['cpid'])->find();
                        //公司名称
                        $val['cpname'] = $company["cpname"];
                        //公司性质
                        $val['nature'] = M("cascadedata")->where("datagroup='nature' and datavalue=" . $company['nature'])->getField("dataname");
                        //公司规模
                        $val['scale'] = M("cascadedata")->where("datagroup='scale' and datavalue=" . $company['scale'])->getField("dataname");
                        //公司缩略图
                        $val['thumlogo'] = ($company['thumlogo'] ? $company['thumlogo'] : "/Public/img/defoultLogo.png");
                        //工作经验要求
                        $val['experience'] = M("cascadedata")->where("datagroup='experience' and datavalue='$val[experience]'")->getField("dataname");
                        $val['strycate'] = M("casclist")->where("id='$val[strycate]'")->getField("cascname");
                        $val['stage'] = M("cascadedata")->where("datagroup='stage' and datavalue=" . $company['stage'])->getField("dataname");
                        $val['record_num'] = M("record")->where("j_id=" . $val['id'])->count();
                        //工作地点
                        $val['jobplace'] = M("casclist")->where("id='$val[jobplace]'")->getField("cascname");
                }

                $this->nowpage = $nowpage;
                $this->assign("page", $show);
                $this->assign("arJobList", $arJobList);
                $this->display();
        }

        function search() {

                $nowpage = I('i'); //当前页码
                $title = I('position'); //职位 1
                $industry = I("industry");  //行业 2
                $place = I('area'); //所在地区

                $treatment = I('treatment'); //工资待遇
                $puttime = I('puttime'); //发布时间

                if ($title) {
                        //关键词模糊查询
                        $keywordGroup = M("keyword_group")->where("keyword_group like '%" . $title . "%'")->getField("keyword_group");
                        if ($keywordGroup) {
                                $arKeywordGroup = explode(" ", $keywordGroup);
                                $titleTmp = "";
                                foreach ($arKeywordGroup as $keyword) {
                                        if ($keyword) {
                                                $titleTmp .=" or title like '%" . $keyword . "%' ";
                                        }
                                }
                        }
                        if (strlen($titleTmp) > 0) {
                                $where .=" AND (title like '%" . $title . "%' " . $titleTmp . ") ";
                        } else {
                                $where .=" AND (title like '%" . $title . "%') ";
                        }
                }
                $count = M("job")->where("employ>(select count(*) from stj_record where stj_record.j_id = stj_job.id and audstart=6) and checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0 and is_show=1" . $where)->count();
                $page = new \Think\Snewpage($count, self::$_size);
                $arJobList = M("job")->where("employ>(select count(*) from stj_record where stj_record.j_id = stj_job.id and audstart=6) and  checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0  and is_show=1" . $where)->order("orderid ASC,checktime DESC, starttime DESC")->limit($page->firstRow, $page->listRows)->select();
                $show = $page->show();

                foreach ($arJobList as $key => &$val) {
                        //计算招聘费用，20%留作系统费用
                        if ($val['Tariff'] > 10) {
                                $val['Tariff'] = floor($val['Tariff'] * 0.8 / 100) * 100;
                        } else {
                                $val['Tariff'] = floor($val['treatment'] * $val['Tariff'] * 12 * 0.8 / 100) * 100;
                        }
                        //发布时间
                        $val['starttime'] = (($val['checktime'] != 0) ? date('Y-m-d H:i', $val['checktime']) : date('Y-m-d H:i', $val['starttime']));
                        //职位名称
                        if (!$val['title']) {
                                $val['title'] = M("casclist")->where("id='$val[Jobcate]'")->getField("cascname");
                        } else {
                                $val['title'] = $val['title'];
                        }
                        //工资待遇
                        $val['treatment'] = M("cascadedata")->where("datagroup='treatment' and datavalue='$val[treatment]'")->getField("dataname");
                        //学历要求
                        $val['education'] = M("cascadedata")->where("datagroup='education' and datavalue='$val[education]'")->getField("dataname");
                        //公司信息
                        $company = M("company")->where("id=" . $val['cpid'])->find();
                        //公司名称
                        $val['cpname'] = $company["cpname"];
                        //公司性质
                        $val['nature'] = M("cascadedata")->where("datagroup='nature' and datavalue=" . $company['nature'])->getField("dataname");
                        //公司规模
                        $val['scale'] = M("cascadedata")->where("datagroup='scale' and datavalue=" . $company['scale'])->getField("dataname");
                        //公司缩略图
                        $val['thumlogo'] = ($company['thumlogo'] ? $company['thumlogo'] : "/Public/img/defoultLogo.png");
                        //工作经验要求
                        $val['experience'] = M("cascadedata")->where("datagroup='experience' and datavalue='$val[experience]'")->getField("dataname");
                        $val['strycate'] = M("casclist")->where("id='$val[strycate]'")->getField("cascname");
                        $val['stage'] = M("cascadedata")->where("datagroup='stage' and datavalue=" . $company['stage'])->getField("dataname");
                        $val['record_num'] = M("record")->where("j_id=" . $val['id'])->count();
                        //工作地点
                        $val['jobplace'] = M("casclist")->where("id='$val[jobplace]'")->getField("cascname");
                }
                //工作地点下拉框
                $workarea = M('casclist')->where("parentid = 19")->order("orderid ASC")->select();
                //工资待遇
                $money = M('cascadedata')->where("datagroup='treatment' AND level=0 ")->select();
                //发布时间
                $positime = M('cascadedata')->where("datagroup='puttime'  AND level=0")->select();
                //行业类别
                $arIndustry = M('casclist')->where("parentid =2")->order("orderid ASC")->select();
                //职位类别
                $arPosition = M('casclist')->where("parentid =1")->order("orderid ASC")->select();
                //判断是否可以收藏职位搜索器
                $isSearchCollect = ($_SESSION['username'] ? true : false);

                $this->money = $money;
                $this->workarea = $workarea;
                $this->positime = $positime;

                $this->assign("page", $show);
                $this->assign("arJobList", $arJobList);
                $this->assign("isSearchCollect", $isSearchCollect);
                $this->assign("arIndustry", $arIndustry);
                $this->assign("arPosition", $arPosition);
                $this->assign("title", $title);
                $this->assign("cur", "search");
                $this->display("new_job");
        }

        //或者中间的职位列表
        public function getIndexContent_back() {
                $sql = "select * from stj_job where stj_job.employ>(select count(*) from stj_record where stj_record.j_id = stj_job.id and audstart=6) and checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0 and is_show=1 order by orderid asc,checktime DESC, starttime desc limit 0,18";
                $arJobList = M("job")->query($sql);
                foreach ($arJobList as $key => &$val) {
                        //计算招聘费用，20%留作系统费用
                        if ($val['Tariff'] > 10) {
                                $val['Tariff'] = floor($val['Tariff'] * 0.8 / 100) * 100;
                        } else {
                                $val['Tariff'] = floor($val['treatment'] * $val['Tariff'] * 12 * 0.8 / 100) * 100;
                        }
                        //发布时间
                        $val['starttime'] = (($val['checktime'] != 0) ? date('Y-m-d H:i', $val['checktime']) : date('Y-m-d H:i', $val['starttime']));
                        //职位名称
                        if (!$val['title']) {
                                $val['title'] = M("casclist")->where("id='$val[Jobcate]'")->getField("cascname");
                        } else {
                                $val['title'] = $val['title'];
                        }
                        //工资待遇
                        $val['treatment'] = rtrim(M("cascadedata")->where("datagroup='treatment' and datavalue='$val[treatment]'")->getField("dataname"), "元");
                        //学历要求
                        $val['education'] = M("cascadedata")->where("datagroup='education' and datavalue='$val[education]'")->getField("dataname");
                        //公司信息
                        $company = M("company")->where("id=" . $val['cpid'])->find();
                        //公司名称
                        $val['cpname'] = $company["cpname"];
                        //公司缩略图
                        $val['thumlogo'] = ($company['thumlogo'] ? $company['thumlogo'] : "/Public/img/defoultLogo.png");
                        //工作经验要求
                        $val['experience'] = M("cascadedata")->where("datagroup='experience' and datavalue='$val[experience]'")->getField("dataname");
                        //工作地点
                        $val['jobplace'] = M("casclist")->where("id='$val[jobplace]'")->getField("cascname");
                }

                $arCompany = array_chunk($arJobList, 10);
                return $arCompany;
        }

        //或者中间的职位列表
        public function getIndexContent() {
                $sql = "select * from stj_job where stj_job.employ>(select count(*) from stj_record where stj_record.j_id = stj_job.id and audstart=6) and checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0 and is_show=1  order by orderid asc,checktime DESC, starttime desc limit 0,18";
                $arJobList = M("job")->query($sql);
                foreach ($arJobList as $key => &$val) {
                        //计算招聘费用，20%留作系统费用
                        if ($val['Tariff'] > 10) {
                                $val['Tariff'] = floor($val['Tariff'] * 0.8 / 100) * 100;
                        } else {
                                $val['Tariff'] = floor($val['treatment'] * $val['Tariff'] * 12 * 0.8 / 100) * 100;
                        }
                        //发布时间
                        $val['starttime'] = (($val['checktime'] != 0) ? date('Y-m-d', $val['checktime']) : date('Y-m-d', $val['starttime']));
                        //职位名称
                        if (!$val['title']) {
                                $val['title'] = M("casclist")->where("id='$val[Jobcate]'")->getField("cascname");
                        } else {
                                $val['title'] = $val['title'];
                        }
                        //工资待遇
                        $treatment = rtrim(M("cascadedata")->where("datagroup='treatment' and datavalue='$val[treatment]'")->getField("dataname"), "元");
                        $arTreatment = explode("-", $treatment);

                        if (count($arTreatment) == 1) {
                                $val['treatment'] = "80K以上";
                        } else {
                                $val['treatment'] = ($arTreatment[0] / 1000) . "K-" . ($arTreatment[1] / 1000) . "K";
                        }


                        //学历要求
                        $val['education'] = M("cascadedata")->where("datagroup='education' and datavalue='$val[education]'")->getField("dataname");
                        //公司信息
                        $company = M("company")->where("id=" . $val['cpid'])->find();
                        //公司名称
                        $val['cpname'] = $company["cpname"];
                        //公司缩略图
                        $val['thumlogo'] = ($company['thumlogo'] ? $company['thumlogo'] : "/Public/img/defoultLogo.png");
                        //工作经验要求
                        $val['experience'] = M("cascadedata")->where("datagroup='experience' and datavalue='$val[experience]'")->getField("dataname");
                        //工作地点
                        $val['jobplace'] = M("casclist")->where("id='$val[jobplace]'")->getField("cascname");

                        //公司信息
                        $val['nature'] = M("cascadedata")->where("datagroup='nature' and datavalue=" . $company['nature'])->getField("dataname");
                        $val['scale'] = M("cascadedata")->where("datagroup='scale' and datavalue=" . $company['scale'])->getField("dataname");
                        $val['stage'] = M("cascadedata")->where("datagroup='stage' and datavalue=" . $company['stage'])->getField("dataname");
                        $val['strycate'] = M("casclist")->where("id='$val[strycate]'")->getField("cascname");
                        $val['record_num'] = M("record")->where("j_id=" . $val['id'])->count();
                }

                $arCompany = array_chunk($arJobList, 10);
                return $arCompany;
        }

        //网站首页
        public function index_back() {
                $username = ($_SESSION['username'] ? $_SESSION['username'] : $_SESSION['cusername']);
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
                //   $this->redirect("/index.?s=/Home/Index/EnterIndex2&".$_COOKIE['shareBackUrl']);
                $this->assign("code_url", $this->logs());
                $this->assign("cur", "index");
                $arCompany = $this->getIndexContent();
                if (!empty($username)) {

                        $this->username = $username;
                        $this->comp = $arCompany[0];
                        $this->comp2 = $arCompany[1];
                        $this->display();
                } else {
                        //推荐成功虚拟列表
                        $arInventedData = M("invented_data")->order("created_at DESC")->select();
                        foreach ($arInventedData as &$data) {
                                $data['title'] = strip_tags($data[content]);
                        }
                        $this->assign("arInventedData", $arInventedData);
                        $this->display("Index/new-index");
                }
        }

        //或者中间的职位列表
        public function getIndexContent1() {
                $sql = "select * from stj_job where stj_job.employ>(select count(*) from stj_record where stj_record.j_id = stj_job.id and audstart=6) and checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0 order by orderid asc,checktime DESC, starttime desc limit 0,18";
                $arJobList = M("job")->query($sql);
                foreach ($arJobList as $key => &$val) {
                        //计算招聘费用，20%留作系统费用
                        if ($val['Tariff'] > 10) {
                                $val['Tariff'] = floor($val['Tariff'] * 0.8 / 100) * 100;
                        } else {
                                $val['Tariff'] = floor($val['treatment'] * $val['Tariff'] * 12 * 0.8 / 100) * 100;
                        }
                        //发布时间
                        $val['starttime'] = (($val['checktime'] != 0) ? date('Y-m-d', $val['checktime']) : date('Y-m-d', $val['starttime']));
                        //职位名称
                        if (!$val['title']) {
                                $val['title'] = M("casclist")->where("id='$val[Jobcate]'")->getField("cascname");
                        } else {
                                $val['title'] = $val['title'];
                        }
                        //工资待遇
                        $treatment = rtrim(M("cascadedata")->where("datagroup='treatment' and datavalue='$val[treatment]'")->getField("dataname"), "元");
                        $arTreatment = explode("-", $treatment);
                        if (count($arTreatment) == 1) {
                                $val['treatment'] = "80K以上";
                        } else {
                                $val['treatment'] = ($arTreatment[0] / 1000) . "K-" . ($arTreatment[1] / 1000) . "K";
                        }
                        //$val['treatment'] = ($arTreatment[0] / 1000) . "K-" . ($arTreatment[1] / 1000) . "K";
                        //学历要求
                        $val['education'] = M("cascadedata")->where("datagroup='education' and datavalue='$val[education]'")->getField("dataname");
                        //公司信息
                        $company = M("company")->where("id=" . $val['cpid'])->find();
                        //公司名称
                        $val['cpname'] = $company["cpname"];
                        //公司缩略图
                        $val['thumlogo'] = ($company['thumlogo'] ? $company['thumlogo'] : "/Public/img/defoultLogo.png");
                        //工作经验要求
                        $val['experience'] = M("cascadedata")->where("datagroup='experience' and datavalue='$val[experience]'")->getField("dataname");
                        //工作地点
                        $val['jobplace'] = M("casclist")->where("id='$val[jobplace]'")->getField("cascname");

                        //公司信息
                        $val['nature'] = M("cascadedata")->where("datagroup='nature' and datavalue=" . $company['nature'])->getField("dataname");
                        $val['scale'] = M("cascadedata")->where("datagroup='scale' and datavalue=" . $company['scale'])->getField("dataname");
                        $val['strycate'] = M("casclist")->where("id='$val[strycate]'")->getField("cascname");
                }

                $arCompany = array_chunk($arJobList, 10);
                return $arCompany;
        }

        /*
         * 获取访问当前页面的是时间
         */

        public function get_login_time($username) {

//                        var_dump(date("Y-m-d H:i:s",$_COOKIE["record_time"]));

                if (!$_COOKIE["record_time"]) {

                        //查看今天是否已经更新过这个时间
                        $arMember = M("member")->where("username='" . $username . "'")->find();
                        if (time() - $arMember['logintime'] >= 3600 * 24) {
                                //修改登陆信息
                                $arUserLogin = array("logintime" => time(), "loginip" => $_SERVER["REMOTE_ADDR"]);
                                M("member")->where("username='" . $username . "'")->save($arUserLogin);

                                setcookie("record_time", time(), time() + 3600 * 24, "/");
                        } else {
                                setcookie("record_time", time(), $arMember['logintime'] + 3600 * 24, "/");
                        }
                }
//               setcookie("record_time","",time()-1,"/");
        }

        //网站首页
        public function index() {
                
                $username = ($_SESSION['username'] ? $_SESSION['username'] : $_SESSION['cusername']);
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
                //   $this->redirect("/index.?s=/Home/Index/EnterIndex2&".$_COOKIE['shareBackUrl']);
                $this->assign("code_url", $this->logs());
                $this->assign("cur", "index");
                $arCompany = $this->getIndexContent();

                $this->comp = $arCompany[0];
                $this->comp2 = $arCompany[1];
                //推荐成功虚拟列表
                $arInventedData = M("invented_data")->order("created_at DESC")->select();
                foreach ($arInventedData as &$data) {
                        $data['title'] = strip_tags($data[content]);
                }
                $this->assign("arInventedData", $arInventedData);
                if (!empty($username)) {

                        $this->username = $username;
                        $this->get_login_time($username);

                        $this->display("Index/indexed");
                } else {

                        $this->display("Index/indexed");
                }
        }

        /*
         * ****ajax返回详细职位
         */

        function login($type = null) {
                empty($type) && $this->error("您访问的页面不存在，到<a href='http://www.renrenlie.com'>首页</a>去！");

                //加载ThinkOauth类并实例化一个对象
                import("Org.ThinkSDK.ThinkOauth");
                $sns = \ThinkOauth::getInstance($type);

                $url = $sns->getRequestCodeURL();

                //如果是微信用户需要将参数client_id变成appid
                if ($type == "weixin") {
                        $url = str_replace("client_id", "appid", $url);
                }
                //var_dump($url);die;
                //跳转到授权页面
                redirect($url);
        }

        public function callbacksina() {

                $code = $_GET['code'];

                empty($code) && $this->error("您访问的页面不存在，到<a href='http://www.renrenlie.com'>首页</a>去！");

                $this->callback($type = 'sina', $code);
        }

        public function callbackqq() {

                $code = $_GET['code'];

                empty($code) && $this->error("您访问的页面不存在，到<a href='http://www.renrenlie.com'>首页</a>去！");

                $this->callback($type = 'qq', $code);
        }

        public function callbackrenren() {

                $code = $_GET['code'];

                empty($code) && $this->error("您访问的页面不存在，到<a href='http://www.renrenlie.com'>首页</a>去！");

                $this->callback($type = 'renren', $code);
        }

        public function callbackweixin() {

                $code = $_GET['code'];

                empty($code) && $this->error("您访问的页面不存在，到<a href='http://www.renrenlie.com'>首页</a>去！");

                $this->callback($type = 'weixin', $code);
        }

        public function callback($type = null, $code = null) {

                (empty($type) || empty($code)) && $this->error("您访问的页面不存在，到<a href='http://www.renrenlie.com'>首页</a>去！");

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

//                $user_info = $this->getQqUserinfo($token['access_token']);
//                $data['username'] = "qq_" . $user_info['nickname'];
//                
// 
//                $this->otherLogin($data, "qq");

                                $this->qqLoginTest($token);
                        } elseif ($type == "renren") {
                                $data['username'] = "renren_" . $token['openid'];
                                $this->otherLogin($data, "renren");
                        } elseif ($type == "weixin") {

                                //var_dump($token);die;

                                $data['username'] = "wx_" . $token['openid'];
                                $data['unionid'] = $token['unionid'];
                                $this->otherLogin($data, "weixin");
                        }
                } else {
                        header("location:?s=/Home/Index/index");
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

                $user_info = $this->std_class_object_to_array(json_decode($userinfo));
                $user_info['openid'] = $openid;
                return $user_info;

//        return $userinfo;
        }

        //验证用户名是否已经占用
        function check() {
                $zhuceUser = I("username");
                if (M('userinfo')->where("username='" . $zhuceUser . "'")->select()) {
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
                $table = intval($_POST['usertype']);
                //根据用户判断进入哪个表
                if ($table == "1") {
                        $type = "企业";
                        $tableName = "company";
                        $card['checkinfo'] = "false";
                } else {
                        $tableName = "member";
                        $type = "推荐人";
                }
                $Card = M("" . $tableName . "");
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

                if (!empty($isExit)) {
                        echo json_encode(array("code" => 500, "msg" => "此用户已经注册！"));
                        exit();
                }

                $title = "人人猎成功注册确认邮件";
                $a = "cccc";
                $b = "aaaa";
                $c = "bbbb";
                $abc = md5($a . $b . $c);
                $verify = md5($data['username'] . $abc);
                $url = "http://" . $_SERVER['HTTP_HOST'] . "/Home/Index/registerv/verify/" . $verify . "/username/" . $data['username'] . "";
                $content = " <p>您好，感谢您注册（www.renrenlie.com）。您注册的是" . $type . "用户，这是一封注册确认邮件。</p>";
                $content .= "<p>请点击以下链接完成确认：<a href='" . $url . "'>" . $url . "</a></p>";
                $content .= "<p>如果链接不能点击，请复制地址到浏览器，然后直接打开。</p>";
                $content .="人人猎";

                //分享职位送大礼
                if ($_SESSION['shreurl'] && C("SHARE_JOB_ID") == $_SESSION['shareaid'] && (C("SHARE_JON_OPEN") == true)) {
                        $data['fromwhere'] = $_SESSION['shreurl'];
                        $data['is_gift'] = 1;
                        $data['fromusername'] = $_SESSION['shareuname'];
                        $card['fromwhere'] = "share";
                }
                //推广奖励
                if ($_SESSION['shreurl'] && C("SHARE_RECOMMENDSHARE_ID") == $_SESSION['shareaid'] && (C("SHARE_JON_OPEN") == true)) {
                        $data['fromwhere'] = $_SESSION['shreurl'];
                        $data['is_gift'] = 1;
                        $data['fromusername'] = $_SESSION['shareuname'];
                        $card['fromwhere'] = "recommentshare";
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

        //找回密码第一步
        function findpwd() {
                //获取职位内容信息
                $arCompany = $this->getIndexContent();
                if (!empty($_SESSION['username'])) {
                        $this->username = $_SESSION['username'];
                }
                $this->assign("code_url", $this->logs());
                $this->comp = $arCompany[0];
                $this->comp2 = $arCompany[1];
                //    $this->display('new_findpwd');
                $this->display('new_findpwd');
        }

        //找回密码第二步
        public function huoquyou2() {

                if (!empty($_SESSION['username'])) {
                        $this->username = $_SESSION['username'];
                }

                //获取首页内容
                $arCompany = $this->getIndexContent();
                $this->comp = $arCompany[0];
                $this->comp2 = $arCompany[1];
                $type = $_SESSION['findpwd_type'];
                $findpwd_step = $_SESSION['findpwd_step'];
                if ($findpwd_step != 1) {
                        $this->error("您访问的页面不存在，到<a href='http://www.renrenlie.com'>首页</a>去！");
                        exit();
                }
                $this->assign("code_url", $this->logs());
                $mailServer = $this->gotomail($_SESSION['findpwd_tag']);
                $mailTo = $this->gotomail($_SESSION['findpwd_tag']);
                $this->assign("mailTo", "http://" . $mailTo);
                $this->assign("type", $type);
                $this->assign("email", $_SESSION['findpwd_tag']);
                $this->display('new_findpwd2');
        }

        //
        function huoquyou() {
                //手机或者邮箱
                $email = I('email');
                //type 1: emial 2:电话
                $type = I('type');
                if ($type == 1) {
                        //判断email是否存在于系统
                        $decide1 = M("member")->where(" email='" . $email . "'")->find();
                        //echo M("member")->getLastSql();
                        $decide2 = M("company")->where("email='" . $email . "'")->find();
                        if (!empty($decide1) || !empty($decide2)) {
                                
                                if(empty($decide1)){
                                        $username = $decide2['username'];
                                }else{
                                        $username = $decide1['username'];
                                        if ($decide1['fromwhere'] == "qq") {
                                                $_SESSION['findpwd_third'] = "qq_";
                                        } elseif ($decide1['fromwhere'] == "wx") {
                                                $_SESSION['findpwd_third'] = "wx_";
                                        } elseif ($decide1['fromwhere'] == "renren") {
                                                $_SESSION['findpwd_third'] = "renren_";
                                        } elseif ($decide1['fromwhere'] == "sina") {
                                                $_SESSION['findpwd_third'] = "sina_";
                                        } else {
                                                $_SESSION['findpwd_third'] = "";
                                        }
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
                                //发送找回密码邮件
                                if (SendMail($email, $title, $content)) {
                                        $_SESSION['findpwd_type'] = 1;
                                        $_SESSION['findpwd_step'] = 1;
                                        $_SESSION['findpwd_tag'] = $email;
                                        echo json_encode(array("code" => 200, "msg" => "ok"));
                                        exit();
                                } else {
                                        echo json_encode(array("code" => 500, "msg" => "发送失败"));
                                        exit();
                                }
                        } else {
                                echo json_encode(array("code" => 500, "msg" => "注册邮箱不存在"));
                                exit();
                        }
                } else {
                        //判断手机号
                        $decide1 = M("member")->where(" mobile='" . $email . "'")->find();
                        $decide2 = M("company")->where("mobile='" . $email . "'")->find();
                        if (!empty($decide1) || !empty($decide2)) {
                                if (empty($decide1)) {

                                        $username = $decide2['username'];
                                } else {
                                        $username = $decide1['username'];
                                        if ($decide1['fromwhere'] == "qq") {
                                                $_SESSION['findpwd_third'] = "qq_";
                                        } elseif ($decide1['fromwhere'] == "wx") {
                                                $_SESSION['findpwd_third'] = "wx_";
                                        } elseif ($decide1['fromwhere'] == "renren") {
                                                $_SESSION['findpwd_third'] = "renren_";
                                        } elseif ($decide1['fromwhere'] == "sina") {
                                                $_SESSION['findpwd_third'] = "sina_";
                                        } else {
                                                $_SESSION['findpwd_third'] = "";
                                        }
                                }
                                $_SESSION['findpwd_type'] = 2;
                                $_SESSION['findpwd_step'] = 1;
                                $_SESSION['findpwd_tag'] = $email;
                                $_SESSION['findpwd_username'] = $username;
                                echo json_encode(array("code" => 200, "msg" => "ok"));
                                exit();
                        } else {
                                echo json_encode(array("code" => 500, "msg" => "手机号不存在系统"));
                                exit();
                        }
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

                        $this->error("您访问的页面不存在，到<a href='http://www.renrenlie.com'>首页</a>去！", U('Index/index'));
                }
                if (md5($username . $abc) == I("verify")) {
                        $arCompany = $this->getIndexContent();
                        if (!empty($_SESSION['username'])) {
                                $this->username = $_SESSION['username'];
                        }
                        $this->assign("code_url", $this->logs());

                        $this->comp = $arCompany[0];
                        $this->comp2 = $arCompany[1];
                        $model = M('userinfo', 'stj_', 'DB_CONFIG1');
                        $sql = "update stj_userinfo set status=1 where username='" . $username . "'";
                        // if (true) {
                        if ($model->execute($sql)) {
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
                                        //////////////////////////////推广分享送大礼/////////////////////////////////////////
                                        if ($userInfo['is_gift'] == 1 && $userInfo['fromusername'] != '' && $userInfo['fromwhere'] != '' && C("SHARE_RECOMMENDSHARE_OPEN") === true) {
                                                $memberInfo = M("member")->where("fromwhere='recommentshare' and username='$username'")->find();
                                                $activeInfo = M("active")->where("id=" . C('SHARE_RECOMMENDSHARE_ID') . " AND status=1 AND endtime>'" . date("Y-m-d H:i:s") . "'")->find();

                                                if ($memberInfo && $activeInfo) {
                                                        $Recorduserinfo = M("userinfo")->where("username='" . $userInfo[fromusername] . "'")->find();
                                                        $accArr = M("account")->where("uid='$Recorduserinfo[userid]'")->find();
                                                        //查找推荐人之前的账户信息
                                                        $time = time();
                                                        if (empty($accArr)) {
                                                                //插入一条信息账户信息到account表中
                                                                $sql = "insert into   stj_account(uid,username,account,created_at,updated_at)  values($Recorduserinfo[userid],'$Recorduserinfo[username]'," . C('SHARE_RECOMMENDSHARE_RECORD') . ",'$time','$time')";
                                                                M("account")->query($sql);
                                                                $newAccount = C('SHARE_RECOMMENDSHARE_RECORD');
                                                                $account = 0;
                                                        } else {

                                                                //插入一条日志记录到account_balance中
                                                                $newAccount = $accArr['account'] + C('SHARE_RECOMMENDSHARE_RECORD');
                                                                //更新账户表中的金额和更新时间
                                                                $sql = "update  stj_account  set account='{$newAccount}',updated_at='{$time}'  where id ={$accArr['id']}";
                                                                M("account")->query($sql);
                                                                $account = $accArr['account'];
                                                        }
                                                        $sql = "insert into  stj_account_blance(uid,username,last_account,account,incr,operat,`from`,comment,created_at,updated_at)  values({$Recorduserinfo[userid]},'{$Recorduserinfo[username]}',{$account},$newAccount," . C('SHARE_RECOMMENDSHARE_RECORD') . ",'','recommendShare','推广分享奖励。','{$time}','{$time}')";
                                                        M("account_blance")->query($sql);
                                                        //首次推荐修改状态
                                                        $sql = "update  stj_userinfo  set is_gift=2   where userid ='{$userInfo[userid]}'";
                                                        M("userinfo")->query($sql);
                                                        $sql = "update  stj_share  set num=`num`+1  where decrypturl ='$userInfo[fromwhere]'";
                                                        M("share")->query($sql);
                                                }
                                        }
                                        //////////////////////////////推广分享送大礼/////////////////////////////////////////
                                } else if ($userInfo["flag"] == "1") {
                                        $arCompanyInfo = M("company")->where("username='" . $username . "'")->find();
                                        if (($arCompanyInfo['regtime'] + 24 * 3600) < time()) {
                                                $this->error("请到首页登录", U(''));
                                        }
                                        //修改登陆的信息
                                        $arUserLogin = array("logintime" => time(), "loginip" => $_SERVER["REMOTE_ADDR"]);
                                        M("company")->where("username='" . $username . "'")->save($arUserLogin);
                                        session('cusername', $username);
                                        $url = U("Company/index");
                                }

                                $this->assign("url", $url);
                                $this->display();
                        } else {
                                $this->display();
                        }
                } else {

                        $this->error("请正确输入网页地址");
                }
        }

        //判断用户登陆
        function userlogin() {

                if (empty($username) || empty($password)) {
                        $username = I("username");
                        $password = md5(md5(I("password")));
                        //查询账户密码是否存在
                        $isExitUser = M('userinfo')->where("username='" . $username . "' and password='" . $password . "' and is_deleted=0")->find();

                        if ($isExitUser) {
                                $remembeme = $_POST['remembeme'];

                                if ($remembeme == "true") {
                                        setcookie("username", $username, time() + 3600 * 30 * 24, "/");
                                        setcookie("password", I("password"), time() + 3600 * 30 * 24, "/");
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
                                        if ($_COOKIE['shareBackUrl']) {
                                                $rurl = $_COOKIE['shareBackUrl'];
                                                setcookie("shareBackUrl", "", time() - 1, "/");
                                                echo json_encode(array("code" => 201, "msg" => U('Home/Index/EnterIndex2/' . $rurl)));
                                        } elseif (!empty($_COOKIE['upresume'])) {
                                                $url = "/Home/Login/Recommended/act/addResume.html";
                                                setcookie("upresume", "", time() - 1, "/");
                                                echo json_encode(array("code" => 201, "msg" => $url));
                                        } else {
                                                //判断来源是否是推荐职位页面
                                                $currentAction = $_POST['currentAction'];
                                                if ($currentAction == "EnterIndex2") {
                                                        $enterIndexComId = $_POST['enterIndexComId'];
                                                        $enterIndexJobId = $_POST['enterIndexJobId'];
                                                        $url = U('Home/Login/RecommendTheCandidate/comid/' . $enterIndexComId . '/jobid/' . $enterIndexJobId);
                                                } else {
                                                        $url = '/Home/Login/index.html';
                                                }
                                                echo json_encode(array("code" => 201, "msg" => $url));
                                                exit();
                                        }
                                } else {
                                        if ($isExitUser['status'] == "1") {
                                                if ($isExitUser["flag"] == "0") {
                                                        //修改登陆的信息
                                                        $arUserLogin = array("logintime" => time(), "loginip" => $_SERVER["REMOTE_ADDR"]);
                                                        M("member")->where("username='" . $username . "' and password='" . $password . "'")->save($arUserLogin);
                                                        session('username', $username);
                                                        if ($_COOKIE['shareBackUrl']) {
                                                                $rurl = $_COOKIE['shareBackUrl'];
                                                                setcookie("shareBackUrl", "", time() - 1, "/");
                                                                //   $this->success("", U('Home/Index/EnterIndex2/' . $rurl));
                                                                echo json_encode(array("code" => 200, "msg" => U('Home/Index/EnterIndex2/' . $rurl)));
                                                                exit();
                                                        } elseif (!empty($_COOKIE['upresume'])) {
                                                                $url = "/Home/Login/Recommended/act/addResume.html";
                                                                setcookie("upresume", "", time() - 1, "/");
                                                                echo json_encode(array("code" => 200, "msg" => $url));
                                                                exit();
                                                        } else {
                                                                //判断来源是否是推荐职位页面
                                                                $currentAction = $_POST['currentAction'];
                                                                if ($currentAction == "EnterIndex2") {
                                                                        $enterIndexComId = $_POST['enterIndexComId'];
                                                                        $enterIndexJobId = $_POST['enterIndexJobId'];
                                                                        $url = U('Home/Login/RecommendTheCandidate/comid/' . $enterIndexComId . '/jobid/' . $enterIndexJobId);
                                                                } else {
                                                                        $url = "/Home/Login/index.html";
                                                                }
                                                                echo json_encode(array("code" => 200, "msg" => $url));
                                                                exit();
                                                        }
                                                } else if ($isExitUser["flag"] == "1") {
                                                        //修改登陆的信息
                                                        $arUserLogin = array("logintime" => time(), "loginip" => $_SERVER["REMOTE_ADDR"]);
                                                        M("company")->where("username='" . $username . "' and password='" . $password . "'")->save($arUserLogin);
                                                        session('cusername', $username);
                                                        if ($_COOKIE['shareBackUrl']) {
                                                                $url = "/Home/Index/EnterIndex2/" . $_COOKIE['shareBackUrl'];
                                                                setcookie("shareBackUrl", "", time() - 1, "/");
                                                        } else {
                                                                $url = "/Home/Company/index.html";
                                                        }
                                                        echo json_encode(array("code" => 200, "msg" => $url));
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

        //手机号登陆
        function mobilelogin() {

                $data['mobile'] = I("username");
                $data['password'] = md5(md5(I("password")));
                if (!empty($data['mobile']) && !empty($data['password'])) {

                        //判断是不是推荐人用户
                        $arMember = M("member")->where("mobile='" . $data['mobile'] . "'")->find();

                        if (empty($arMember)) {
                                $arCompany = M("company")->where("mobile='" . $data['mobile'] . "'")->find();
                                if (!empty($arCompany)) {
                                        echo json_encode(array("code" => 500, "msg" => "企业用户暂不支持手机号登陆"));
                                        die;
                                } else {
                                        echo json_encode(array("code" => 500, "msg" => "手机号或密码错误"));
                                        die;
                                }
                        } else {

                                $arUserinfo = M("userinfo")->where("username='" . $arMember['username'] . "'")->find();
                                if ($arUserinfo['password'] != $data['password']) {
                                        echo json_encode(array("code" => 500, "msg" => "手机号或密码错误"));
                                        die;
                                }
                                if ($arUserinfo['status'] == 0) {
                                        echo json_encode(array("code" => 500, "msg" => "该用户未激活"));
                                        die;
                                } elseif ($arUserinfo['is_deleted'] == 1) {
                                        echo json_encode(array("code" => 500, "msg" => "该用户已删除"));
                                        die;
                                } else {
                                        $remembeme = $_POST['remembeme'];

                                        if ($remembeme == "true") {
                                                setcookie("username", $data['mobile'], time() + 3600 * 30 * 24, "/");
                                                setcookie("password", I("password"), time() + 3600 * 30 * 24, "/");
                                        } else {
                                                setcookie("username", "");
                                                setcookie("password", "");
                                        }

                                        //修改登陆信息
                                        $arUserLogin = array("logintime" => time(), "loginip" => $_SERVER["REMOTE_ADDR"]);
                                        M("member")->where("id=" . $arMember['id'])->save($arUserLogin);

                                        //存进session信息
                                        session('username', $arMember['username']);
                                        
                                        if (!empty($_COOKIE['shareBackUrl'])) {
                                                $url = "/Home/Index/EnterIndex2/" . $_COOKIE['shareBackUrl'];
                                                setcookie("shareBackUrl", "", time() - 1, "/");
                                        } elseif (!empty($_COOKIE['upresume'])) {
                                                $url = "/Home/Login/Recommended/act/addResume.html";
                                                setcookie("upresume", "", time() - 1, "/");
                                        } else {
                                                $url = "/Home/Login/index.html";
                                        }
                                        echo json_encode(array("code" => 200, "msg" => $url));
                                        die;
                                }
                        }
                }
        }

        function huoquvs() {
                
                $arCompany = $this->getIndexContent();
                $username = I('username');

                $this->comp = $arCompany[0];
                $this->comp2 = $arCompany[1];
                $this->username = $username;
                $this->tableName = I('type');
                $this->verify = I('verify');
                
                
                if ($_SESSION['findpwd_third'] == "qq_") {
                        $username1 = "您的账号为qq第三方登录账号，您可以通过您的手机号和设置的密码登录人人猎系统";
                        $this->assign("username1", $username1);
                } elseif ($_SESSION['findpwd_third'] == "wx_") {
                        $username1 = "您的账号为微信第三方登录账号，您可以通过您的手机号和设置的密码登录人人猎系统";
                        $this->assign("username1", $username1);
                } elseif ($_SESSION['findpwd_third'] == "renren_") {
                        $username1 = "您的账号为人人第三方登录账号，您可以通过您的手机号和设置的密码登录人人猎系统";
                        $this->assign("username1", $username1);
                } elseif ($_SESSION['findpwd_third'] == "sina_") {
                        $username1 = "您的账号为新浪第三方登录账号，您可以通过您的手机号和设置的密码登录人人猎系统";
                        $this->assign("username1", $username1);
                } else {
                        $this->assign("find_pwd_third", 1); //不是第三方登陆
                }
                
                $this->assign("username", $username);

                $this->display("new_find_pwdemail");
        }

        function save() {
                $username = ($_SESSION['findpwd_username'] ? $_SESSION['findpwd_username'] : $_POST['username']);
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

                if (!is_numeric($jobid)) {

                        $jobInfo = $model->where("guid='" . $jobid . "'")->find();
                } else {
                        $jobInfo = $model->where("id='" . $jobid . "'")->find();
                }

                $comInfo = $cmodel->where("id=" . $comid)->find();

                if ($jobInfo['is_deleted'] == 1 || $jobInfo['checkinfo'] == "false" || empty($comInfo) || empty($jobInfo)) {
                        $this->error("您访问的页面不存在，到<a href='http://www.renrenlie.com'>首页</a>去！");
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
                $jobInfo['starttime'] = (($jobInfo['checktime'] != 0) ? date('Y-m-d', $jobInfo['checktime']) : date('Y-m-d', $jobInfo['starttime']));

                $jobInfo['posttime'] = ($jobInfo['checktime'] ? date('Y-m-d', $jobInfo['checktime']) : "");
                $jobInfo['endtime'] = date('Y-m-d', $jobInfo['endtime']);
                $jobInfo['jobplace'] = M("casclist")->where("id=" . $jobInfo['jobplace'])->getField("cascname");
                $jobInfo['education'] = M("cascadedata")->where("datagroup='education' and datavalue=" . $jobInfo['education'])->getField("dataname");
                $jobInfo['experience'] = M("cascadedata")->where("datagroup='experience' and datavalue=" . $jobInfo['experience'])->getField("dataname");
                $jobInfo['treatment'] = M("cascadedata")->where("datagroup='treatment' and datavalue=" . $jobInfo['treatment'])->getField("dataname");
                if ($jobInfo['joblang'] > 0) {
                        $jobInfo['joblang'] = M("cascadedata")->where("datagroup='joblang' and datavalue=" . $jobInfo['joblang'])->getField("dataname");
                } else {
                        $jobInfo['joblang'] = "无要求";
                }

                $jobInfo['tn'] = M("record")->where("j_id='$jobInfo[id]'")->count();
                $requestUrl = rtrim($_SERVER['QUERY_STRING'], ".html");
                $shareUrl = "http://www.renrenlie.com/index.php";
                if ($_SESSION['username']) {
                        $username = $_SESSION['username'];
                        $flag = "0";
                        $shareUrlTmp = "tag/ShareJob/channel/WebShare/aid/" . C('SHARE_JOB_ID') . "/uname/" . $username;

                        $shareUrl = $shareUrl . "?" . $requestUrl . "/share/" . encrypt($shareUrlTmp, "share");
                } elseif ($_SESSION['cusername']) {
                        $username = $_SESSION['cusername'];
                        $flag = "1";
                        $shareUrlTmp = "tag/ShareJob/channel/WebShare/aid/" . C('SHARE_JOB_ID') . "/uname/" . $username;
                        $shareUrl = $shareUrl . "?" . $requestUrl . "/share/" . encrypt($shareUrlTmp, "share");
                } else {
                        $username = "";
                        $flag = "";
                        $shareUrl = $shareUrl . "?" . $requestUrl;
                }
                ///////////////////////////////////////处理分享//////////////////////////////////////////////////////

                $shareUrl2 = rtrim($_GET['share'], ".html");

                $url = decrypt($shareUrl2, "share");
                if ($url == false) {
                        $shareUrl2 = str_replace(" ", "+", $shareUrl2);
                        $url = decrypt($shareUrl2, "share");
                }

                $isShare = 0;
                //如果是分享连接
                if ((strpos($url, "tag") !== false) && (strpos($url, "channel") !== false)) {
                        $isShare = true;
                        $arUrl = explode("&", $url);
                        $shareUrl2 = array();
                        foreach ($arUrl as $u) {
                                $au = explode("=", $u);
                                $shareUrl2[$au[0]] = $au[1];
                        }

                        $_SESSION['shreurl'] = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                        $_SESSION['backurl'] = $_SERVER['HTTP_REFERER'];
                        $_SESSION['sharetag'] = $shareUrl2['tag'];
                        $_SESSION['sharechannel'] = $shareUrl2['channel'];
                        $_SESSION['shareaid'] = $shareUrl2['aid'];
                        $_SESSION['shareuname'] = $shareUrl2['uname'];
                }
                ///////////////////////////////////////处理分享//////////////////////////////////////////////////////
                //是否分享过来的连接需要登陆
                if ($_SESSION['cusername'] || $_SESSION['username']) {
                        $isShare = 0;
                }
                //如果不是分享过来的，则判断登陆没有，如果没有登陆则不允许浏览
                $showWindow = 0;
                if ($isShare == true || (!$_SESSION['cusername'] && !$_SESSION['username'])) {
                        setcookie("shareBackUrl", "comid/" . $comid . "/jobid/" . $jobid, time() + 3600, "/");
                        $showWindow = 1;
                } else {
                        $showWindow = 0;
                        setcookie("shareBackUrl", "", time() - 1, "/");
                }

                $share['url'] = $shareUrl;
                $share['title'] = "即刻分享" . $jobInfo[title] . "职位，立得N个“百元”现金。";
                $share['description'] = "[renrenlie.com] " . $comInfo[cpname] . "直招" . $jobInfo[title] . "职位" . $jobInfo[employ] . "人,月薪:" . $jobInfo['treatment'] . " ，推荐或自荐成功入职即得推荐奖金" . $jobInfo[Tariff] . "元。";
                $this->assign("shareurl", $shareUrl);
                $this->assign("share", $share);
                if ($comInfo['comlogo'] && file_get_contents("http://" . $_SERVER['HTTP_HOST'] . "/" . $comInfo['comlogo'])) {
                        $comInfo['comlogo'] = "http://" . $_SERVER['HTTP_HOST'] . "/" . $comInfo['comlogo'];
                } else {
                        $comInfo['comlogo'] = "";
                }
                //  $comInfo = $_SERVER["HTTP"]
                //是否关注过
                if ($username && $flag != 1) {
                        $clectInfo = M("job_collection")->where("username='$username' and status=1 and j_id='$jobInfo[id]'")->find();
                } else {
                        $clectInfo = false;
                }

                $jobBright = $jobInfo['jobbright'];
                if ($jobBright) {
                        $jobBright = explode("|||", $jobBright);
                }
                ////////////////////////////////////////////////////////////评论列表///////////////////////////////////////////////////////////////////

                $count = M("evaluate")->where("tag='record' and status=0 and checkinfo ='true' and j_id='$jobInfo[id]'")->count();
                $page = new \Think\Snewpage($count, 5);
                $arCommentList = M("evaluate")->where("tag='record' and status=0 and checkinfo ='true' and j_id='$jobInfo[id]'")->order("created_at DESC")->limit($page->firstRow, $page->listRows)->select();
                foreach ($arCommentList as &$commentInfo) {
                        $commnetUser = M("member")->where("id=" . $commentInfo['uid'])->find();

                        if ($commnetUser['avatar']) {
                                $commentInfo['avatar'] = '/' . $commnetUser[avatar];
                        } else {
                                $commentInfo['avatar'] = '/Public/img/rcmd-img/icon11.png';
                        }
                        $commentInfo['created_at'] = date("Y-m-d", $commentInfo['created_at']);
                        $commentInfo['username'] = cut_str($commentInfo['username'], 3, 0) . '**' . cut_str($commentInfo['username'], 2, -2);
                }

                $show = $page->show();
                $this->assign("nowpage", 1);
                $this->assign("commentCount", $count);
                $this->assign("arCommentList", $arCommentList);
                $this->assign("page", $show);

                //////////////////////////////////////////////////////////////评论列表///////////////////////////////////////////////////////////////////
                // $showWindow = false;
                $this->assign("showWindow", $showWindow);
                $this->assign("jobInfo", $jobInfo);
                $this->assign("comInfo", $comInfo);
                $this->assign("jobBright", $jobBright);
                $this->assign("username", $username);
                $this->assign("flag", $flag);
                $this->assign("clectInfo", $clectInfo);
                $this->assign("isShare", $isShare);
                $this->display("new_jobinfo");
        }

        public function commentPage() {

                $gid = intval($_REQUEST['jid']);
                $count = M("evaluate")->where("tag='record' and status=0 and checkinfo ='true' and j_id='$gid'")->count();
                $page = new \Think\Snewpage($count, 1);
                $arCommentList = M("evaluate")->where("tag='record' and status=0 and checkinfo ='true' and j_id='$gid'")->order("created_at DESC")->limit($page->firstRow, $page->listRows)->select();
                foreach ($arCommentList as &$commentInfo) {
                        $commnetUser = M("member")->where("id=" . $commentInfo['uid'])->find();

                        if ($commnetUser['avatar']) {
                                $commentInfo['avatar'] = '/' . $commnetUser[avatar];
                        } else {
                                $commentInfo['avatar'] = '/Public/img/rcmd-img/icon11.png';
                        }
                        $commentInfo['created_at'] = date("Y-m-d", $commentInfo['created_at']);
                        $commentInfo['username'] = cut_str($commentInfo['username'], 3, 0) . '**' . cut_str($commentInfo['username'], 2, -2);
                }

                $show = $page->show();
                $this->assign("commentCount", $count);
                $this->assign("arCommentList", $arCommentList);
                $this->assign("page", $show);
                $this->display("new_comment_page");
        }

        function EnterIndex_back() {
                $comid = $_GET['comid'];
                $comInfo = M("company")->where("id=" . $comid)->find();
                $comInfo['nature'] = M("cascadedata")->where("datagroup='nature' and datavalue=" . $comInfo['nature'])->getField("dataname");
                $comInfo['scale'] = M("cascadedata")->where("datagroup='scale' and datavalue=" . $comInfo['scale'])->getField("dataname");
                $comInfo['stage'] = M("cascadedata")->where("datagroup='stage' and datavalue=" . $comInfo['stage'])->getField("dataname");
                $comInfo['brightreg'] = date("Y.m");
                //热招职位
                $where = " AND cpid='$comid'";
                $arJobList = M("job")->where("checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0" . $where)->order("orderid ASC,checktime DESC, starttime DESC")->limit("0,10")->select();
                foreach ($arJobList as &$val) {
                        if ($val['Tariff'] > 10) {

                                $val['Tariff'] = floor($val['Tariff'] * 0.8 / 100) * 100;
                        } else {
                                $val['Tariff'] = floor($val['treatment'] * $val['Tariff'] * 12 * 0.8 / 100) * 100;
                        }
                        $val['starttime'] = (($val['checktime'] != 0) ? date('Y-m-d H:i', $val['checktime']) : date('Y-m-d H:i', $val['starttime']));
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
                if ($comInfo['comlogo'] && file_get_contents("http://" . $_SERVER['HTTP_HOST'] . "/" . $comInfo['comlogo'])) {
                        $comInfo['comlogo'] = "http://" . $_SERVER['HTTP_HOST'] . "/" . $comInfo['comlogo'];
                } else {
                        $comInfo['comlogo'] = "";
                }
                $this->assign("arJobList", $arJobList);
                $this->assign("companyInfo", $comInfo);
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
                $arJobList = M("job")->where("checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0" . $where)->order("orderid ASC,checktime DESC, starttime DESC")->limit("0,10")->select();
                foreach ($arJobList as &$val) {
                        if ($val['Tariff'] > 10) {

                                $val['Tariff'] = floor($val['Tariff'] * 0.8 / 100) * 100;
                        } else {
                                $val['Tariff'] = floor($val['treatment'] * $val['Tariff'] * 12 * 0.8 / 100) * 100;
                        }
                        $val['starttime'] = (($val['checktime'] != 0) ? date('Y-m-d H:i', $val['checktime']) : date('Y-m-d H:i', $val['starttime']));
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
                if ($comInfo['comlogo'] && file_get_contents("http://" . $_SERVER['HTTP_HOST'] . "/" . $comInfo['comlogo'])) {
                        $comInfo['comlogo'] = "http://" . $_SERVER['HTTP_HOST'] . "/" . $comInfo['comlogo'];
                } else {
                        $comInfo['comlogo'] = "";
                }
                //查看该用户是否评论过
                $evaluate = "";
                if ($_SESSION['username']) {
                        $evaluateArr = M("evaluate")->where("username='" . $_SESSION['username'] . "'and pid=$comid and status=0")->find();
                        if (!empty($evaluateArr)) {
                                $evaluate = $evaluateArr['content'];
                        }
                }
                $this->assign("evaluate", $evaluate);

                $this->assign("arJobList", $arJobList);
                $this->assign("companyInfo", $comInfo);
                $this->display("new_companyinfo");
        }

        function evaluateSave() {

                $pid = trim($_POST['pid']);
                $pname = trim($_POST['pname']);
                $content = trim($_POST['content']);

                if ($pid == "" || $pname == "" || $content == "") {
                        echo json_encode(array("code" => "500", "msg" => "参数错误"));
                        die;
                }
                preg_match_all('/./us', $content, $match);
                if (count($match[0]) > 500) {
                        echo json_encode(array("code" => "500", "msg" => "评论过长"));
                        die;
                }
                if (!$_SESSION['username']) {

                        setcookie("evaluateUrl", "comid/" . $comid . "/jobid/" . $jobid);
                        echo json_encode(array("code" => "400", "msg" => "未登录"));
                        die;
                }

                $memberArr = M("member")->where("username='{$_SESSION['username']}'")->find();
                $uid = $memberArr['id'];
                $ip = $_SERVER['REMOTE_ADDR'];
                $evaluateArr = M("evaluate")->where("username='" . $_SESSION['username'] . "' and pid=$pid and status=0")->find();
                if (!empty($evaluateArr)) {
                        $data = array("id" => $evaluateArr['id'], "content" => $content, "loginip" => $ip, "updated_at" => time());
                        $re = M("evaluate")->save($data);
                } else {
                        $data = array("uid" => $uid, "username" => $_SESSION['username'], "loginip" => $ip, "pid" => $pid, "pname" => $pname, "content" => $content, "created_at" => time(), "updated_at" => time());
                        $re = M("evaluate")->add($data);
                }
                if ($re) {
                        echo json_encode(array("code" => "200", "msg" => "感谢您的评价"));
                        die;
                } else {
                        echo json_encode(array("code" => "500", "msg" => "评论失败"));
                        die;
                }
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
                $this->assign("cur", "aboutus");
                $this->display("About/aboutus");
        }

        function srzy() {
                $this->assign("first_class", 1);
                $this->assign("second_class", 2);
                $this->assign("cur", "aboutus");
                $this->display("About/aboutus");
        }

        function tjrxy() {
                $this->assign("first_class", 2);
                $this->assign("second_class", 3);
                $this->assign("cur", "yhxy");
                $this->display("About/yhxy");
        }

        function zpfxy() {
                $this->assign("first_class", 2);
                $this->assign("second_class", 4);
                $this->assign("cur", "yhxy");
                $this->display("About/yhxy");
        }

        function yhys() {
                $this->assign("first_class", 2);
                $this->assign("cur", "yhys");
                $this->display("About/yhys");
        }

        function lxwm() {
                $this->assign("first_class", 2);
                $this->assign("cur", "contactus");
                $this->display("About/contactus");
        }

        function sutuijian() {
                $this->assign("cur", "aboutus");
                $this->display("About/aboutus");
        }

        function joinus() {
                $this->assign("cur", "joinus");
                $this->display("About/joinus");
        }

        public function otherLogin($data, $from) {
                $isExitLogin = $this->isExitLogin($data);
                if ($isExitLogin === false) {
                        //如果是微信用户，判断是否拥有unionid
                        if ($from == "weixin") {
                                $arForWxMember = M("member")->where("username='" . $data['username'] . "' and password='" . md5(md5(123456)) . "'")->find();
                                if (empty($arForWxMember['unionid'])) {
                                        $arMember = array("logintime" => time(), "loginip" => $_SERVER["REMOTE_ADDR"], "unionid" => $data['unionid']);
                                } else {
                                        $arMember = array("logintime" => time(), "loginip" => $_SERVER["REMOTE_ADDR"]);
                                }
                        } else {

                                $arMember = array("logintime" => time(), "loginip" => $_SERVER["REMOTE_ADDR"]);
                        }
                        M("member")->where("username='" . $data['username'] . "' and password='" . md5(md5(123456)) . "'")->save($arMember);
                        session('username', $data['username']);
                        if ($_COOKIE['shareBackUrl']) {
                                $rurl = $_COOKIE['shareBackUrl'];
                                setcookie("shareBackUrl", "", time() - 1, "/");
                                $this->success("", U('Home/Index/EnterIndex2/' . $rurl));
                        } elseif (!empty($_COOKIE['upresume'])) {
                                setcookie("upresume", "", time() - 1, "/");
                                $this->success("", '/Home/Login/Recommended/act/addResume.html');
                        } else {
                                $this->success("", U('Login/index'));
                        }
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
                        //如果是微信用户
                        if ($from == "weixin") {
                                $card['unionid'] = $data['unionid'];
                                unset($data['unionid']);
                        }
                        M("userinfo")->add($data);
                        M("member")->add($card);
                        session('username', $data['username']);
                        if ($_COOKIE['shareBackUrl']) {
                                $rurl = $_COOKIE['shareBackUrl'];
                                setcookie("shareBackUrl", "", time() - 1, "/");
                                $this->success("", U('Home/Index/EnterIndex2/' . $rurl));
                        } elseif (!empty($_COOKIE['upresume'])) {
                                setcookie("upresume", "", time() - 1, "/");
                                $this->success("", '/Home/Login/Recommended/act/addResume.html');
                        } else {
                                $this->success("", U('Login/userinfo'));
                        }
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
                $urlTmp = explode("share=", $_POST['url']);
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
                        $isExit = M("share")->where("decrypturl='$_POST[url]' and status=1")->find();
                        if (!$isExit) {
                                M("share")->add($data);
                        }
                }
        }

        public function uploadify() {
                $ftype = 'docx,pdf,doc,txt,ppt,wps,jpg,JPG,PNG,png,JPEG';

                $setting = array(
                    'mimes' => '', //允许上传的文件MiMe类型  
                    'maxSize' => 60 * 1024 * 1024, //上传的文件大小限制 (0-不做限制)  
                    'exts' => $ftype, //允许上传的文件后缀  
                    'autoSub' => true, //自动子目录保存文件  
                    'subName' => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组  
                    'rootPath' => './Uploads/', //保存根路径  
                    'savePath' => '', //保存路径  
                );

                /* 调用文件上传组件上传文件 */
                //实例化上传类，传入上面的配置数组  
                $this->uploader = new Upload($setting, 'Local');
                $info = $this->uploader->upload($_FILES);

                //这里判断是否上传成功  
                if ($info) {
                        //// 上传成功 获取上传文件信息  
                        foreach ($info as &$file) {

                                //拼接出上传目录  
                                echo "/Uploads/" . $file['savepath'] . "&&" . $file['savename'];
                        }
                        //这里可以输出一下结果,相对路径的键名是$info['upload']['filepath']  
                }
        }

        public function uploadifyLicence() {
                $ftype = 'docx,pdf,doc,txt,ppt,wps,jpg,JPG,PNG,png,JPEG,zip,rar';

                $setting = array(
                    'mimes' => '', //允许上传的文件MiMe类型  
                    'maxSize' => 60 * 1024 * 1024, //上传的文件大小限制 (0-不做限制)  
                    'exts' => $ftype, //允许上传的文件后缀  
                    'autoSub' => true, //自动子目录保存文件  
                    'subName' => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组  
                    'rootPath' => './Uploads/', //保存根路径  
                    'savePath' => '', //保存路径  
                );

                /* 调用文件上传组件上传文件 */
                //实例化上传类，传入上面的配置数组  
                $this->uploader = new Upload($setting, 'Local');
                $info = $this->uploader->upload($_FILES);

                //这里判断是否上传成功  
                if ($info) {
                        //// 上传成功 获取上传文件信息  
                        foreach ($info as &$file) {
                                //上传营业执照
                                //  M("company")->where("username='$_SESSION[username]'")->save(array("licence" => "/Uploads/" . $file['savepath'] . $file['savename']));
                                echo "/Uploads/" . $file['savepath'] . $file['savename'];
                        }
                        //这里可以输出一下结果,相对路径的键名是$info['upload']['filepath']  
                } else {
                        echo "no";
                }
        }

        function collectJob() {

                $username = $_POST['username'];
                $jid = $_POST['jobid'];
                $model = M('member', 'stj_', 'DB_CONFIG1');
                $user = M('userfavorite', 'stj_', 'DB_CONFIG1');
                //判断是否已经收藏过
                $collectJobInfo = M("job_collection")->where("username='$username' and j_id='$jid'")->find();
                $userInfo = M("member")->where("username='$username'")->find();
                if ($collectJobInfo) {
                        //如果以前收藏过只不过是删除了则还原下状态
                        if ($collectJobInfo['status'] == 2) {
                                $collect_result = M("job_collection")->save(array("status" => 1, "updated_at" => time(), "id" => $collectJobInfo['id']));
                        } elseif ($collectJobInfo['status'] == 1) {
                                $collect_result = M("job_collection")->save(array("status" => 2, "updated_at" => time(), "id" => $collectJobInfo['id']));
                        }
                } else {

                        $jobInfo = M("job")->where("id='$jid'")->find();

                        if ($jobInfo['is_deleted'] == 1 || $jobInfo['checkinfo'] == "false" || !$userInfo) {
                                echo json_encode(array("code" => 500, "detail" => "此职位已经过期了"));
                                exit();
                        } else {
                                if (!$jobInfo['title']) {
                                        $jobInfo['title'] = M("casclist")->where("id='$jobInfo[Jobcate]'")->getField("cascname");
                                } else {
                                        $jobInfo['title'] = $jobInfo['title'];
                                }
                                if ($jobInfo['Tariff'] > 10) {

                                        $jobInfo['Tariff'] = floor($jobInfo['Tariff'] * 0.8 / 100) * 100;
                                } else {
                                        $jobInfo['Tariff'] = floor($jobInfo['treatment'] * $jobInfo['Tariff'] * 12 * 0.8 / 100) * 100;
                                }
                                $collectInfo = array();
                                $collectInfo['uid'] = $userInfo['id'];
                                $collectInfo['username'] = $userInfo['username'];
                                $collectInfo['j_id'] = $jid;
                                $collectInfo['siteid'] = $jobInfo['siteid'];
                                $collectInfo['cpid'] = $jobInfo['cpid'];
                                $collectInfo['title'] = $jobInfo['title'];
                                $collectInfo['jobplacedata'] = $jobInfo['title'];
                                $collectInfo['meth'] = $jobInfo['meth'];
                                $collectInfo['email'] = $jobInfo['email'];
                                $collectInfo['mobile'] = $jobInfo['mobile'];
                                $collectInfo['employ'] = $jobInfo['employ'];
                                $collectInfo['Jobcatedata'] = M("casclist")->where("id='$jobInfo[Jobcate]'")->getField("cascname");
                                $collectInfo['strycatedata'] = M("casclist")->where("id='$jobInfo[strycate]'")->getField("cascname");
                                $collectInfo['Tariff'] = $jobInfo['Tariff'];
                                $collectInfo['treatmentdata'] = M("cascadedata")->where("datavalue='$jobInfo[treatment]' and datagroup='treatment'")->getField("dataname");
                                $collectInfo['educationdata'] = M("cascadedata")->where("datavalue='$jobInfo[education]' and datagroup='education'")->getField("dataname");

                                $jobLang = M("cascadedata")->where("datavalue='$jobInfo[joblang]' and datagroup='joblang'")->getField("dataname");
                                $collectInfo['joblangdata'] = ($jobLang ? $jobLang : "无要求");
                                $collectInfo['posttime'] = $jobInfo['posttime'];
                                $collectInfo['endtime'] = $jobInfo['endtime'];
                                $collectInfo['status'] = 1;
                                $collectInfo['created_at'] = $collectInfo['updated_at'] = time();
                                M("job_collection")->add($collectInfo);
                        }
                }
                echo json_encode(array("code" => 200, "detail" => "ok"));
                exit();
        }

        //保存职位搜索器
        public function saveSearchTools() {
                $username = $_SESSION['username'];
                $title = trim($_POST['title']);
                $name = trim($_POST['name']);
                $userInfo = M("member")->where("username='$username'")->find();

                $isExit = M("search_collection")->where("username='$username' and name='$name'")->find();
                if ($isExit) {
                        echo json_encode(array("code" => 500, "msg" => "您已经有此名称的搜索器！"));
                        exit();
                }

                $area = $_POST['area'];
                $industry = $_POST['industry'];
                $position = $_POST['position'];
                $puttime = $_POST['puttime'];

                $treatment = $_POST['treatment'];
                $arSearch = array();
                if ($industry) {
                        $arSearch['industry'] = $industry;
                        $arSearch['industrydata'] = M('casclist')->where("id='$industry'")->getField("cascname");
                }
                if ($position) {
                        $arSearch['position'] = $position;
                        $arSearch['positiondata'] = M('casclist')->where("id='$position'")->getField("cascname");
                }
                if ($area) {
                        $arSearch['area'] = $area;
                        $arSearch['areadata'] = M('casclist')->where("id='$area'")->getField("cascname");
                }
                if ($puttime) {
                        $arSearch['puttime'] = $puttime;
                        $arSearch['puttimedata'] = M("cascadedata")->where("datavalue='$puttime' and datagroup='puttime'")->getField("dataname");
                }
                if ($treatment) {
                        $arSearch['treatment'] = $treatment;
                        $arSearch['treatmentdata'] = M("cascadedata")->where("datavalue='$treatment' and datagroup='treatment'")->getField("dataname");
                }
                $arSearch['title'] = $title;
                $arSearch['uid'] = $userInfo['id'];
                $arSearch['username'] = $userInfo['username'];
                $arSearch['name'] = $name;
                $arSearch['status'] = 1;
                $arSearch['created_at'] = $arSearch['updated_at'] = time();
                M("search_collection")->add($arSearch);
                echo json_encode(array("code" => 200, "msg" => "收藏成功！"));
        }

        public function qqLoginTest($token) {

                //得到openid 信息
                $info = $this->getQqOpenid($token['access_token']);


                //判断cookie中是否有昵称信息，如果有不去第三方获取
                if (!empty($_COOKIE["qq_" . $info['openid']])) {

                        $user_info['nickname'] = $_COOKIE["qq_" . $info['openid']];
                        $user_info['openid'] = $info['openid'];
                        session('username', "qq_" . $info['openid']);
                        $this->loginRedirect();
                } else {

                        $user_info = $this->getQqUinfo($info);
                }


                $data['nickname'] = "qq_" . $user_info['nickname'];
                $data['username'] = "qq_" . $user_info['openid'];

                setcookie("qq_" . $user_info['openid'], $data['nickname'], time() + 24 * 3600, "/");


                if ($this->isCheckNickname && $this->isExitQqNickname($data)) {

                        $this->updateUsername($data);
                        session('username', $data['username']);

                        $this->loginRedirect();
                        die;
                }

                if ($this->isExitQqOpenid($data)) {
                        //登陆
                        session('username', $data['username']);
                        $this->loginRedirect();
                        die;
                } else {
                        //插入数据到用户信息数据
                        $this->addUserData($data);
                        $this->loginRedirect();
                        die;
                }
        }

        /*
         * 判断存不存在用户名是qq昵称
         */

        public function isExitQqNickname($data) {

                $isExit = M("member")->where("username='{$data['nickname']}'")->find();
                if ($isExit) {
                        return true;
                } else {
                        return false;
                }
        }

        /*
         * 判断存不存在用户名是qq_openid
         */

        public function isExitQqOpenid($data) {

                $isExit = M("member")->where("username='{$data['username']}'")->find();
                if ($isExit) {
                        return true;
                } else {
                        return false;
                }
        }

        /*
         * 新增数据到userinfo和member
         */

        public function addUserData($da) {
                //用户的类型
                $data['flag'] = 0;
                $data['password'] = md5(md5(123456));
                $data['status'] = 1;
                $data['username'] = $da['username'];
                $card['username'] = $da['username'];
                $card['password'] = $data['password'];
                $card['pwd'] = 123456;
                $card['fromwhere'] = "qq";
                $card['activation'] = 1;
                $card['regip'] = $_SERVER["REMOTE_ADDR"];
                $card['regtime'] = time();
                $card['logintime'] = time();


                M("userinfo")->add($data);
                M("member")->add($card);

                session('username', $data['username']);

                $this->loginRedirect();
        }

        public function loginRedirect() {

                if ($_COOKIE['shareBackUrl']) {
                        $rurl = $_COOKIE['shareBackUrl'];
                        setcookie("shareBackUrl", "", time() - 1, "/");
                        $this->success("", U('Home/Index/EnterIndex2/' . $rurl));
                } elseif (!empty($_COOKIE['upresume'])) {
                        $url = "/Home/Login/Recommended/act/addResume.html";
                        setcookie("upresume", "", time() - 1, "/");
                        $this->success("", $url);
                } else {
                        $this->success("", U('Login/index'));
                }
        }

        public function updateUsername($data) {

                //修改username 和 nickname
                $user = M("userinfo");
                $userArr = $user->where("username='{$data['nickname']}'")->find();
                $memberArr = M("member")->where("username='{$data['nickname']}'")->find();

                $user->startTrans();
                $re1 = $user->query("update stj_userinfo set username='{$data['username']}' where username='{$data['nickname']}' and userid='{$userArr['userid']}'");  //userinfo
                //echo $user->getLastSql()."<br/>";
                $re2 = M("member")->query("update stj_member set username='{$data['username']}' where username='{$data['nickname']}' and  id={$memberArr['id']}"); //member
                //echo M("member")->getLastSql()."<br/>";
                $re3 = M("account")->query("update stj_account set username='{$data['username']}' where username='{$data['nickname']}' and uid={$userArr['userid']}");
                //echo M("account")->getLastSql()."<br/>";
                $re4 = M("account_blance")->query("update stj_account set username='{$data['username']}' where username='{$data['nickname']}' and uid={$userArr['userid']}");
                //echo M("account_blance")->getLastSql()."<br/>";
                $re5 = M("job_collection")->query("update stj_job_collection set username='{$data['username']}' where username='{$data['nickname']}' and uid={$memberArr['id']}");
                //echo M("job_collection")->getLastSql()."<br/>";
                $re6 = M("share")->query("update stj_share set username='{$data['username']}' where username='{$data['nickname']}' and uid={$userArr['userid']}");
                //echo M("share")->getLastSql()."<br/>";
                $re7 = M("enchashment")->query("update stj_enchashment set username='{$data['username']}' where username='{$data['nickname']}' and uid={$userArr['userid']}");
                //echo M("enchashment")->getLastSql()."<br/>";
                //var_dump($re1);var_dump($re2);var_dump($re3);var_dump($re4);var_dump($re5);var_dump($re6);var_dump($re7);echo "<br/>";
                if ($re1 === false || $re2 === false || $re3 === false || $re4 === false || $re5 === false || $re6 === false || $re7 === false) {
                        //echo "1<br/>";
                        $user->rollback();
                } else {
                        //echo "2<br/>";
                        $user->commit();
                }
                //die;
        }

        public function getQqOpenid($token) {
                $url = "https://graph.qq.com/oauth2.0/me?access_token=$token";
                $info = file_get_contents($url);
                //将返回值转为数组
                $info1 = substr($info, 9, -3);
                $info2 = json_decode($info1);
                $info3 = $this->std_class_object_to_array($info2);
                $info3['token'] = $token;
                return $info3;
        }

        function getQqUinfo($info) {

                $token = $info['token'];
                $key = $info['client_id'];
                $openid = $info['openid'];
                $userinfoUrl = "https://graph.qq.com/user/get_user_info?access_token=$token&oauth_consumer_key=$key&openid=$openid";
                $userinfo = file_get_contents($userinfoUrl);

                $user_info = $this->std_class_object_to_array(json_decode($userinfo));
                $user_info['openid'] = $openid;
                return $user_info;
        }

        public function getRegCode() {
                
                if($_POST['hash']!= md5("rrl_".$_SESSION['cookie'])){
                        return;
                }
               
                $mobile = $_POST['mobile'];
                //0推荐人 1企业
                $userType = $_POST['usertype'];
                $model = ($userType == 1 ? "company" : "member");
                $type = ($userType == 1 ? "企业" : "推荐人");
                $isExit = M($model)->where("mobile='$mobile'")->find();

                if ($isExit) {
                        echo json_encode(array("code" => 500, "msg" => "此手机号码已经注册！"));
                        exit();
                }
                $code = $this->getCode();

                if (!$_SESSION['leveltime']) {
                        $content = "您申请成为renrenlie.com" . $type . "用户的验证码为" . $code . "，10分钟内有效，如非本人操作请忽略此条信息或咨询010-57188076。";
                        $result = smsChannel($mobile, $content);

                        if ($result['code'] == "200") {

                                $retCode = array("code" => 200, "msg" => "发送成功");
                                $_SESSION['leveltime'] = time();
                                $_SESSION['reg_' . $mobile] = $code;
                        } else {

                                $logData['msg'] = $result;
                                $retCode = array("code" => 500, "msg" => "短信发送通道拥挤，稍后再试！");
                        }

                        echo json_encode($retCode);
                        exit();
                } elseif ((time() - $_SESSION['leveltime']) < 5 * 60) {

                        echo json_encode(array("code" => 200, "smg" => "发送成功"));
                } else {

                        $content = "您申请成为renrenlie.com" . $type . "用户的验证码为" . $code . "，10分钟内有效，如非本人操作请忽略此条信息或咨询010-57188076。";
                        $result = smsChannel($mobile, $content);

                        if ($result[code] == "200") {

                                $retCode = array("code" => 200, "msg" => "发送成功");
                                $_SESSION['leveltime'] = time();
                                $_SESSION['reg_' . $mobile] = $code;
                        } else {

                                $logData['msg'] = $result;
                                $retCode = array("code" => 500, "msg" => "短信发送通道拥挤，稍后再试！");
                        }
                        echo json_encode($retCode);
                        exit();
                }
        }

        public function sendMessage($mobile, $content) {
                $target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit";
                $post_data = "account=cf_zpkj&password=renrenlie231&mobile=" . $mobile . "&content=" . rawurlencode($content);
                $gets = $this->xml_to_array($this->Post($post_data, $target));
                if ($gets['SubmitResult']['code'] == 2) {
                        return true;
                } else {

                        return $gets['SubmitResult']['msg'];
                }
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

        function random($length = 6, $numeric = 0) {
                PHP_VERSION < '4.2.0' && mt_srand((double) microtime() * 1000000);
                if ($numeric) {
                        $hash = sprintf('%0' . $length . 'd', mt_rand(0, pow(10, $length) - 1));
                } else {
                        $hash = '';
                        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
                        $max = strlen($chars) - 1;
                        for ($i = 0; $i < $length; $i++) {
                                $hash .= $chars[mt_rand(0, $max)];
                        }
                }
                return $hash;
        }

        public function addUser() {
                $cpname = trim($_POST['cpname']);
                $address = trim($_POST['address']);
                $username = trim($_POST['username']);
                $mobile = trim($_POST['mobile']);

                $code = $_POST['code'];
                $password = $_POST['password'];
                $usertype = $_POST['usertype'];

                if (!$_SESSION['reg_' . $mobile]) {
                        echo json_encode(array("code" => 500, "msg" => "验证码错误"));
                        exit();
                }


                if ($_SESSION['reg_' . $mobile] != $code) {
                        echo json_encode(array("code" => 500, "msg" => "验证码错误"));
                        exit();
                }
                if (M('userinfo')->where("username='" . $username . "'")->find()) {
                        echo json_encode(array("code" => 500, "msg" => "用户名已经存在"));
                        exit();
                }
                //0推荐人 1企业
                $model = ($usertype == 1 ? "company" : "member");
                $card['checkinfo'] = ($usertype == 1 ? "false" : "true");
                $isExit = M($model)->where("mobile='$mobile'")->find();

                if ($isExit) {
                        echo json_encode(array("code" => 500, "msg" => "此手机号码已经注册！"));
                        exit();
                }
                $Card = M($model);
                //用户的类型
                $data['flag'] = $usertype;
                $data['password'] = md5(md5($password));
                $data['status'] = 1;
                $data['username'] = $username;

                if ($usertype == "1") {
                        $card['cpname'] = $cpname;
                        $card['address'] = $address;
                }
                $card['username'] = $username;
                $card['password'] = $data['password'];
                $card['mobile'] = $mobile;
                $card['pwd'] = $password;
                $card['activation'] = 1;
                $card['regip'] = $_SERVER["REMOTE_ADDR"];
                $card['regtime'] = time();
                $card['logintime'] = time();


                //分享职位送大礼
                if ($_SESSION['shreurl'] && C("SHARE_JOB_ID") == $_SESSION['shareaid'] && (C("SHARE_JON_OPEN") == true)) {
                        $data['fromwhere'] = $_SESSION['shreurl'];
                        $data['is_gift'] = 1;
                        $data['fromusername'] = $_SESSION['shareuname'];
                        $card['fromwhere'] = "share";
                }
                //推广奖励
                if ($_SESSION['shreurl'] && C("SHARE_RECOMMENDSHARE_ID") == $_SESSION['shareaid'] && (C("SHARE_JON_OPEN") == true)) {
                        $data['fromwhere'] = $_SESSION['shreurl'];
                        $data['is_gift'] = 1;
                        $data['fromusername'] = $_SESSION['shareuname'];
                        $card['fromwhere'] = "recommentshare";
                }
                if (M("userinfo")->add($data)) {
                        if ($Card->add($card)) {
                                if ($usertype == "0") {
                                        $arMemberInfo = M("member")->where("username='" . $username . "'")->find();
                                        //修改登陆的信息
                                        session('username', $username);
                                        $url = U('Login/userinfo');
                                        //////////////////////////////推广分享送大礼/////////////////////////////////////////
                                        if ($data['is_gift'] == 1 && $data['fromusername'] != '' && C("SHARE_RECOMMENDSHARE_OPEN") === true) {
                                                $memberInfo = M("member")->where("fromwhere='recommentshare' and username='$username'")->find();
                                                $activeInfo = M("active")->where("id=" . C('SHARE_RECOMMENDSHARE_ID') . " AND status=1 AND endtime>'" . date("Y-m-d H:i:s") . "'")->find();

                                                if ($memberInfo && $activeInfo) {
                                                        $Recorduserinfo = M("userinfo")->where("username='" . $data[fromusername] . "'")->find();
                                                        $accArr = M("account")->where("uid='$Recorduserinfo[userid]'")->find();
                                                        //查找推荐人之前的账户信息
                                                        $time = time();
                                                        if (empty($accArr)) {
                                                                //插入一条信息账户信息到account表中
                                                                $sql = "insert into   stj_account(uid,username,account,created_at,updated_at)  values($Recorduserinfo[userid],'$Recorduserinfo[username]'," . C('SHARE_RECOMMENDSHARE_RECORD') . ",'$time','$time')";
                                                                M("account")->query($sql);
                                                                $newAccount = C('SHARE_RECOMMENDSHARE_RECORD');
                                                                $account = 0;
                                                        } else {

                                                                //插入一条日志记录到account_balance中
                                                                $newAccount = $accArr['account'] + C('SHARE_RECOMMENDSHARE_RECORD');
                                                                //更新账户表中的金额和更新时间
                                                                $sql = "update  stj_account  set account='{$newAccount}',updated_at='{$time}'  where id ={$accArr['id']}";
                                                                M("account")->query($sql);
                                                                $account = $accArr['account'];
                                                        }
                                                        $sql = "insert into  stj_account_blance(uid,username,last_account,account,incr,operat,`from`,comment,created_at,updated_at)  values({$Recorduserinfo[userid]},'{$Recorduserinfo[username]}',{$account},$newAccount," . C('SHARE_RECOMMENDSHARE_RECORD') . ",'','recommendShare','推广分享奖励。','{$time}','{$time}')";
                                                        M("account_blance")->query($sql);
                                                        //首次推荐修改状态
                                                        $sql = "update  stj_userinfo  set is_gift=2   where username ='{$username}'";
                                                        M("userinfo")->query($sql);
                                                        $sql = "update  stj_share  set num=`num`+1  where decrypturl ='$data[fromusername]'";
                                                        M("share")->query($sql);
                                                }
                                        }
                                        //////////////////////////////推广分享送大礼/////////////////////////////////////////
                                } else if ($usertype == "1") {
                                        session('cusername', $username);
                                        $url = U("Company/EnterpriseInformation");
                                }
                                // $this->display("register");
                                echo json_encode(array("code" => 200, "msg" => $url));
                                exit();
                        }
                }
        }

        public function findpwdcode() {
                
                if($_POST['hash'] != md5("rrl_".$_SESSION['cookie'])){
                        return;
                }
                
                $mobile = $_SESSION['findpwd_tag'];


                $isExit = M("member")->where("mobile='$mobile'")->find();
                $isExit2 = M("company")->where("mobile='$mobile'")->find();
                if (!$isExit && !$isExit2) {
                        echo json_encode(array("code" => 500, "msg" => "系统繁忙，请重新验证身份再试！"));
                        exit();
                }
                $code = $this->getCode();

                if (!$_SESSION['pwdleveltime']) {
                        $content = "您申请重置密码的验证码为{$code}，10分钟内有效，如非本人操作请忽略此条信息或咨询010-57188076。";
                        $result = smsChannel($mobile, $content);
                        
                        if ($result['code'] == "200") {

                                $retCode = array("code" => 200, "msg" => "发送成功");
                                $_SESSION['pwdleveltime'] = time();
                                $_SESSION['findpwd_' . $mobile] = $code;
                        } else {

                                $logData['msg'] = $result;
                                $retCode = array("code" => 500, "msg" => "系统繁忙");
                        }

                        echo json_encode($retCode);
                        exit();
                } elseif ((time() - $_SESSION['pwdleveltime']) < 1 * 60) {

                        echo json_encode(array("code" => 200, "smg" => "发送成功"));
                } else {

                        $content = "您申请重置密码的验证码为{$code}，10分钟内有效，如非本人操作请忽略此条信息或咨询010-57188076。";
                        $result = smsChannel($mobile, $content);
                        if ($result[code] == "200") {

                                $retCode = array("code" => 200, "msg" => "发送成功");
                                $_SESSION['pwdleveltime'] = time();
                                $_SESSION['findpwd_' . $mobile] = $code;
                        } else {

                                $logData['msg'] = $result;
                                $retCode = array("code" => 500, "msg" => "系统繁忙");
                        }
                        echo json_encode($retCode);
                        exit();
                }
        }

        public function checkfindpwdcode() {
                $code = $_POST['findpwd_code'];
                $mobile = $_SESSION['findpwd_tag'];
                // var_dump($_SESSION['findpwd_' . $mobile]);
                if ($_SESSION['findpwd_' . $mobile] == $code) {
                        $_SESSION['findpwd_check'] = "finish";
                        echo json_encode(array("code" => 200, "msg" => "成功"));
                        exit();
                } else {
                        echo json_encode(array("code" => 500, "msg" => "验证码错误"));
                        exit();
                }
        }

        public function changePwssword() {
                if (empty($_SESSION['findpwd_check']) || empty($_SESSION['findpwd_tag'])) {
                        $this->error("您长时间未操作，已登录超时，若想继续操作，请重新登录！");
                        exit();
                }


                $arCompany = $this->getIndexContent();
                $this->comp = $arCompany[0];
                $this->comp2 = $arCompany[1];

                $username = $_SESSION['findpwd_username'];
                if ($_SESSION['findpwd_third'] == "qq_") {
                        $username = "您的账号为qq第三方登录账号，您可以通过您的手机号和设置的密码登录人人猎系统";
                } elseif ($_SESSION['findpwd_third'] == "wx_") {
                        $username = "您的账号为微信第三方登录账号，您可以通过您的手机号和设置的密码登录人人猎系统";
                } elseif ($_SESSION['findpwd_third'] == "renren_") {
                        $username = "您的账号为人人第三方登录账号，您可以通过您的手机号和设置的密码登录人人猎系统";
                } elseif ($_SESSION['findpwd_third'] == "sina_") {
                        $username = "您的账号为新浪第三方登录账号，您可以通过您的手机号和设置的密码登录人人猎系统";
                } else {
                        $this->assign("find_pwd_third", 1); //不是第三方登陆
                }
                $this->assign("find_pwdusername", $username);
                //var_dump($username);die;
                $this->display('new_findpwd3');
        }

        function passwordsave() {
                if (empty($_SESSION['findpwd_check']) || empty($_SESSION['findpwd_tag'])) {
                        $this->error("您长时间未操作，已登录超时，若想继续操作，请重新登录！");
                        exit();
                }
                $data["password"] = md5(md5(I('password')));
                $type['password'] = md5(md5(I('password')));
                $type['pwd'] = I('password');

                $model = M('userinfo', 'stj_', 'DB_CONFIG1');

                $userinfo = $model->where("username='" . $_SESSION['findpwd_username'] . "'")->save($data);

                $sql = "update stj_member set password='" . $type['password'] . "', pwd='" . $type['pwd'] . "' where username='" . $_SESSION['findpwd_username'] . "' and mobile='" . $_SESSION['findpwd_tag'] . "'";

                M("member")->query($sql);
                $sql2 = "update stj_company set password='" . $type['password'] . "', pwd='" . $type['pwd'] . "' where username='" . $_SESSION['findpwd_username'] . "' and mobile='" . $_SESSION['findpwd_tag'] . "'";
                M("company")->query($sql2);

                session_destroy();
                echo json_encode(array("code" => "200", "msg" => "ok"));
        }

        /*
         * 微信现金红包活动对应的pc页面
         */

        function activities4() {
                $this->display("./Active/activities4");
        }

        /*
         * 成功案例
         */

        public function anli() {
                $this->assign("cur", "anli");
                $this->display("case");
        }

        /*
         * 当pc访问微信的职位详情页面的中转页面
         */

        Public function job_detail_redirect() {

                $jobid = $_GET['jobid'];
                $arJob = M("job")->where("id=" . $jobid)->find();
                if (empty($arJob)) {
                        header("location:http://www.renrenlie.com/");
                        die;
                } else {
                        header("location:http://www.renrenlie.com/Home/Index/EnterIndex2/comid/" . $arJob['cpid'] . "/jobid/" . $arJob['guid'] . ".html");
                        die;
                }
        }
        

}
