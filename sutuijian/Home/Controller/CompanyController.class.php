<?php

namespace Home\Controller;

use Think\Controller;
use Think\Upload;

header("Content-type: text/html; charset=utf-8");

class CompanyController extends Controller {

        static private $_size = 10;

        public function __construct() {
                if (is_weixin() === true) {
                        header('Location: http://m.renrenlie.com/');
                }
                
                parent::__construct();
                $linkArr = M("friendlink")->where("status=0")->order("orderid desc,id asc")->select();
                $this->assign("linkArr", $linkArr);
                import('ORG.Util.Page');
                $model2 = M('userinfo', 'stj_', 'DB_CONFIG1');
                $model = M('casclist', 'stj_', 'DB_CONFIG1');
                $model3 = M('member', 'stj_', 'DB_CONFIG1');
                $username = $_SESSION['username'];
                $userinfo = M('member')->where("username='" . $username . "'")->find();
                $this->userinfo = $userinfo;

                if (!empty($_SESSION['username']) || !empty($_SESSION['cusername'])) {
                        $username = ($_SESSION['username'] ? $_SESSION['username'] : $_SESSION['cusername']);

                        $decide = $model2->where("username='" . $username . "'")->select();

                        if (!empty($decide)) {
                                $table = array();
                                foreach ($decide as $key => $val) {
                                        $table = $decide[$key];
                                }
                                $cUserInfo = $this->getCompanyInfo();
                                //判断基本资料是否填写完整
                                if ($cUserInfo['cpname'] && isset($cUserInfo['mobile']))
                                        $leftNavCompleted['userinfo_completed'] = true;
                                else
                                        $leftNavCompleted['userinfo_completed'] = false;

                                //判断合同

                                if (isset($cUserInfo['contract']) && ($cUserInfo['checkcontract'] == 1))
                                        $leftNavCompleted['contract_completed'] = true;
                                else
                                        $leftNavCompleted['contract_completed'] = false;
                                $isJob = M("job")->where("cpid='" . $cUserInfo['id'] . "'")->find();
                                if (!empty($isJob))
                                        $leftNavCompleted['job_completed'] = true;
                                else
                                        $leftNavCompleted['job_completed'] = false;

                                $sql = "select r.id from stj_record as r left join stj_job as j on r.j_id=j.id where j.cpid='$cUserInfo[id]'";
                                $jlist = M("record")->query($sql);
                                if (!empty($jlist))
                                        $leftNavCompleted['record_completed'] = true;
                                else
                                        $leftNavCompleted['record_completed'] = false;

                                $this->assign("leftNavCompleted", $leftNavCompleted);
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
                } else {
                        $this->error("您长时间未操作，已登录超时，若想继续操作，请重新登录！", U('Index/index'));
                }
        }

        /*
         * 企业版登陆后统计页面
         */

        public function index() {
                $cUserInfo = M("company")->where("username='{$_SESSION['cusername']}'")->find();

                //用户已经注册天数
                $regTime = intval((time() - $cUserInfo['regtime']) / (24 * 3600));

                //该公司还在招聘的职位的候选人简历
                $arResume = M()->query("select * from stj_record r join stj_job b on r.j_id=b.id and r.status=2 and b.cpid=" . $cUserInfo['id']." and b.is_deleted=0 and b.checkinfo='true' and b.endtime>" . time());
               
                $resumeCount = count($arResume); //判断候选人简历数量（只要审核通过）
                $leftNavCompleted['record_completed'] = false; //判断是否有未查看的候选人(审核通过且is_view=0的)
                $newRecordCount = 0; //判断新收到候选人数量（审核通过且is_view=0的）
                foreach ($arResume as $v) {
                        if ($v['is_view'] == 0) {
                                $leftNavCompleted['record_completed'] = true;
                                $newRecordCount++;
                        }
                        
                }
                //该公司所有职位的候选人简历
                $arResume1 = M()->query("select * from stj_record r join stj_job b on r.j_id=b.id  and audstart=6 and b.cpid=" . $cUserInfo['id']);
                $isSinkCount = 0; //判断进入待付款状态的候选人数量（已入职未打款）
                $isSucCount = count($arResume1); //累计入职数量
                foreach ($arResume1 as $v) {
                      
                                if ($v['sink'] == 1) {
                                        $isSinkCount++;
                                } else {
                                        $jids .= "," . $v['j_id'];
                                }
                        
                }
                $where = "(" . substr($jids, 1) . ")";
                //累计支付费用
                $arJobFee = M("job")->query("select sum(Tariff) as count from stj_job where id in " . $where);

                $sumFee = intval($arJobFee[0]['count']);

                //判断发布职位数量
                $jobCount = M("job")->where("cpid='" . $cUserInfo['id'] . "' and is_deleted=0")->count();

                $this->assign("sumFee", $sumFee);
                $this->assign("isSucCount", $isSucCount);
                $this->assign("isSinkCount", $isSinkCount);
                $this->assign("newRecordCount", $newRecordCount);
                $this->assign("regTime", $regTime);
                $this->assign("resumeCount", $resumeCount);
                $this->assign("jobCount", $jobCount);
                $this->assign("cuserinfo", $cUserInfo);
                $this->assign("$record_completed", $leftNavCompleted['record_completed']);
                $this->display();
        }

        public function EnterpriseInformation() {
                $arCompanyInfo = $this->getCompanyInfo();

                if (!$arCompanyInfo['cpname']) {
                        $sIsNewCompay = 1;
                } else {
                        $sIsNewCompay = 2;
                }
                $objCascade = M("cascadedata");
                //,'scale','stage')
                $arNatureList = $objCascade->where("datagroup = 'nature'")->order("orderid asc")->select();

                $arScaleList = $objCascade->where("datagroup = 'scale'")->order("orderid asc")->select();
                $arStageList = $objCascade->where("datagroup = 'stage'")->order("orderid asc")->select();

                $this->assign("arNatureList", $arNatureList);
                $this->assign("arScaleList", $arScaleList);
                $this->assign("arStageList", $arStageList);
                if ($arCompanyInfo['comlogo']) {
                        $logoTmp = substr($arCompanyInfo['comlogo'], 0, 1);
                        if ($logoTmp != "/") {
                                $arCompanyInfo['comlogo'] = "/" . $arCompanyInfo['comlogo'];
                        }
                }

                $this->assign("first_class", 1);
                $this->assign("second_class", 1);
                $this->assign("arCompanyInfo", $arCompanyInfo);
                $this->assign("sIsNewCompay", $sIsNewCompay);
                $this->display("new_userinfo");
                //  $this->display('Company/company_base_info');
                // $this->display();
        }

        //获取企业信息
        public function getCompanyInfo() {
                $objComany = M("company");

                if (!$_SESSION['cusername']) {
                        $this->error("您长时间未操作，已登录超时，若想继续操作，请重新登录！", U('Index/index'));
                        exit();
                }
                $arCompanyInfo = $objComany->where("username='" . $_SESSION['cusername'] . "'")->find();

                if (empty($arCompanyInfo)) {
                        $this->error("您长时间未操作，已登录超时，若想继续操作，请重新登录！", U('Index/index'));
                        exit();
                }
                $_SESSION['company_id'] = $arCompanyInfo['id'];
                $objCascadedata = M("cascadedata");
                if ($arCompanyInfo['nature']) {

                        $arCascadedataInfo = $objCascadedata->where("datagroup='nature' and datavalue=" . $arCompanyInfo['nature'])->find();
                        $arCompanyInfo['naturedata'] = $arCascadedataInfo['dataname'];
                }
                if ($arCompanyInfo['scale']) {

                        $arCascadedataInfo = $objCascadedata->where("datagroup='scale' and datavalue=" . $arCompanyInfo['scale'])->find();
                        $arCompanyInfo['scaledata'] = $arCascadedataInfo['dataname'];
                }
                if ($arCompanyInfo['stage']) {

                        $arCascadedataInfo = $objCascadedata->where("datagroup='stage' and datavalue=" . $arCompanyInfo['stage'])->find();
                        $arCompanyInfo['stagedata'] = $arCascadedataInfo['dataname'];
                }

                $arCompanyInfo['brightregdata'] = ($arCompanyInfo['brightreg'] ? date("Y-m-d", $arCompanyInfo['brightreg']) : "暂未填写");
                return $arCompanyInfo;
        }

        public function saveCompanyBaseInfo() {
                $data['username'] = $_SESSION['cusername'];
                $data['cpname'] = trim($_POST['cpname']);
                $data['nature'] = trim($_POST['nature']);
                $data['scale'] = trim($_POST['scale']);
                $data['stage'] = trim($_POST['stage']);
                $data['brightreg'] = trim(strtotime($_POST['brightregdata']));
                $data['webname'] = trim($_POST['webname']);

                $data['intro'] = trim($_POST['intro']);
                $data['bright'] = trim($_POST['bright']);
                $data['address'] = trim($_POST['address']);
                $data['cnname'] = trim($_POST['cnname']);
                $data['telephone'] = trim($_POST['telephone']);
                $data['email'] = trim($_POST['email']);

                $setting = array(
                    'mimes' => '', //允许上传的文件MiMe类型  
                    'maxSize' => 6 * 1024 * 1024, //上传的文件大小限制 (0-不做限制)  
                    'exts' => "jpg,jpeg,gif,png", //允许上传的文件后缀  
                    'autoSub' => true, //自动子目录保存文件  
                    'subName' => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组  
                    'rootPath' => 'Uploads/', //保存根路径  
                    'savePath' => '', //保存路径  
                );
                /* 调用文件上传组件上传文件 */
                //实例化上传类，传入上面的配置数组  

                $info = false;
                if (!empty($_FILES)) {
                        $this->uploader = new Upload($setting, 'Local');
                        $info = $this->uploader->upload($_FILES);
                }


                if ($info) {
                        if ($info['comlogo']) {
                                $data['comlogo'] = "/" . $setting['rootPath'] . $info['comlogo']['savepath'] . $info['comlogo']['savename'];
                                $data['thumlogo'] = $data['comlogo'];
                        }
                        if ($info['licence']) {
                                $data['licence'] = "/" . $setting['rootPath'] . $info['licence']['savepath'] . $info['licence']['savename'];
                        }
                }
                $res = M('company')->where("username='" . $data['username'] . "'")->save($data);

                header("Location:/Home/Company/EnterpriseInformation.html");
                //echo json_encode(array("success"=>$res));
        }

        public function getCompanyBaseInfo() {
                $username = $_POST['username'] ? $_POST['username'] : $_SESSION['cusername'];
                $companyInfo = $this->getCompanyInfo();
                echo json_encode($companyInfo);
                exit();
        }

        public function introductCompany() {
                $arCompanyInfo = $this->getCompanyInfo();

                if (!$arCompanyInfo['intro']) {
                        $sIsNewCompay = 1;
                } else {
                        $sIsNewCompay = 2;
                }
                $this->assign("first_class", 1);
                $this->assign("second_class", 2);
                $this->assign("arCompanyInfo", $arCompanyInfo);
                $this->assign("sIsNewCompay", $sIsNewCompay);
                $this->display('Company/company_intro_info');
        }

        public function saveCompanyIntro() {
                $data = array();
                $data['intro'] = $_POST['intro'];
                $objComany = M("company");
                if (!$_SESSION['cusername']) {
                        echo json_encode(array("code" => 500, "msg" => "您长时间未操作，请重新登录"));
                        exit();
                }
                $arCompanyInfo = $objComany->where("username='" . $_SESSION['cusername'] . "'")->find();

                if (empty($arCompanyInfo)) {
                        echo json_encode(array("code" => 500, "msg" => "您长时间未操作，请重新登录"));
                        exit();
                }

                $res = $objComany->where("username='" . $_SESSION['cusername'] . "'")->save($data);

                echo json_encode(array("code" => 200, "msg" => $_POST['intro']));
                exit();
        }

        public function saveCompanyBright() {
                $data = array();
                $data['bright'] = $_POST['bright'];
                $objComany = M("company");
                if (!$_SESSION['cusername']) {
                        echo json_encode(array("code" => 500, "msg" => "您长时间未操作，请重新登录"));
                        exit();
                }
                $arCompanyInfo = $objComany->where("username='" . $_SESSION['cusername'] . "'")->find();

                if (empty($arCompanyInfo)) {
                        echo json_encode(array("code" => 500, "msg" => "您长时间未操作，请重新登录"));
                        exit();
                }

                $res = $objComany->where("username='" . $_SESSION['cusername'] . "'")->save($data);

                echo json_encode(array("code" => 200, "msg" => $_POST['bright']));
                exit();
        }

        public function companyBright() {
                $arCompanyInfo = $this->getCompanyInfo();

                if (!$arCompanyInfo['bright']) {
                        $sIsNewCompay = 1;
                } else {
                        $sIsNewCompay = 2;
                }
                $this->assign("first_class", 1);
                $this->assign("second_class", 4);
                $this->assign("arCompanyInfo", $arCompanyInfo);
                $this->assign("sIsNewCompay", $sIsNewCompay);
                $this->display('Company/company_bright_info');
        }

        //添加职位 页面
        public function companySendJob() {
                $jobInfo = $this->getJobInfo();
                $this->assign("jobInfo", $jobInfo);
                //行业类别
                $hyData = M("casclist")->where("parentid=2")->order("orderid asc")->select();
                //职位
                $zwData = M("casclist")->where("parentid=1")->order("orderid asc")->select();
                //地区
                $dqData = M("casclist")->where("parentid=19")->order("orderid asc")->select();
                //语言能力
                $sql = "select DISTINCT dataname,datavalue from stj_cascadedata where datagroup='joblang' and dataname !=''  group by dataname order by orderid";
                $ynData = M("cascadedata")->query($sql);
                $zwldId = M("casclist")->where("cascname='职位亮点'")->find();
                $ldData = M("casclist")->where("parentid='$zwldId[id]'")->select();

                $this->assign("ynData", $ynData);
                $this->assign("dqData", $dqData);
                $this->assign("hyData", $hyData);
                $this->assign("zwData", $zwData);
                $this->assign("ldData", $ldData);
                $this->assign("first_class", 2);
                $this->assign("second_class", 11);
                $this->display('Company/company_send_job');
        }

        public function checkUserPaviliong() {
                $username = $_SESSION['cusername'];
                $userInfo = M("company")->where("username='$username'")->find();
                if (empty($userInfo)) {
                        return false;
                }
                return $userInfo;
        }

        //添加职位 页面
        public function SendJob() {
                $xfhy = array("A" => "互联网金融", "B" => "在线旅游", "C" => "教育", "D" => "健康医疗", "E" => "电子商务", "F" => "搜索", "G" => "传媒广告",
                    "H" => "移动互联网", "I" => "O2O", "J" => "社交", "K" => "游戏", "L" => "云计算/大数据", "M" => "招聘", "N" => "智能家居",
                    "O" => "智能电视", "P" => "企业服务", "Q" => "文化美术", "R" => "生活服务", "S" => "社会化营销", "T" => "运动体育", "U" => "安全",
                    "V" => "硬件", "W" => "分类信息", "X" => "非TMT(非互联网)");
                $checkUserPavi = $this->checkUserPaviliong();
                if ($checkUserPavi === false) {
                        $this->error("用户身份验证失败，请重新登陆后再试！");
                        exit();
                }
                //如果传过来职位id,则做修改显示
                $jobid = $_GET['id'];
                if (!empty($jobid)) {
                        $arJob = M("job")->where("id=" . $jobid)->find();
                        if (!empty($arJob) && $arJob['checkinfo'] === 'false') {

                                $arJob['strycatedata'] = M("casclist")->where("id = " . $arJob['strycate'])->getField("cascname");
                                $arJob['Jobcatedata'] = M("casclist")->where("id = " . $arJob['Jobcate'])->getField("cascname");
                                $arJob['jobplacedata'] = M("casclist")->where("id = " . $arJob['jobplace'])->getField("cascname");

                                $this->assign("arJob", $arJob);
                        }
                }

                $jobInfo = $this->getJobInfo();
                $this->assign("jobInfo", $jobInfo);
                //期望行业
                if (!empty($userinfo['strycate'])) {
                        $stry = explode('+', $userinfo['strycate']);
                        $strycate = '';
                        foreach ($stry as $v) {
                                $strycate .= getCscData($v) . '+';
                        }
                        $strycate = substr($strycate, 0, -1);
                } else {
                        $strycate = "选择行业";
                }
                $userinfo['strycate_data'] = $strycate;
                //行业类别
                $sql = "SELECT * FROM `stj_casclist` WHERE parentid = 2  order by orderid ASC";
                $arStrycate = M("casclist")->query($sql);
                foreach ($arStrycate as &$cate) {
                        $sql = "SELECT * FROM `stj_casclist` WHERE parentid = " . $cate['id'] . " order by orderid ASC";
                        $cate['casclist'] = M("casclist")->query($sql);
                }
                $sql = "SELECT * FROM `stj_casclist` WHERE parentid =1  order by orderid ASC";
                $arJobcate = M("casclist")->query($sql);
                foreach ($arJobcate as &$jcate) {
                        $sql = "SELECT * FROM `stj_casclist` WHERE parentid = " . $jcate['id'] . " order by orderid ASC";
                        $jcate['casclist'] = M("casclist")->query($sql);
                }

                if (!empty($userinfo['area'])) {
                        $areaTmp = explode('+', $userinfo['area']);
                        $area = '';
                        foreach ($areaTmp as $v) {
                                $area .= getCscData($v) . '+';
                        }
                        $area = substr($area, 0, -1);
                } else {
                        $area = "选择地区";
                }
                //地区
                $sql = "SELECT * FROM `stj_casclist` WHERE parentid =19  order by orderid ASC";
                $arArea = M("casclist")->query($sql);
                foreach ($arArea as &$areas) {
                        $sql = "SELECT * FROM `stj_casclist` WHERE parentid = " . $areas['id'] . " order by orderid ASC";
                        $areas['casclist'] = M("casclist")->query($sql);
                }
                //语言能力
                $sql = "select DISTINCT dataname,datavalue from stj_cascadedata where datagroup='joblang' and dataname !=''  group by dataname order by orderid";
                $ynData = M("cascadedata")->query($sql);
                $zwldId = M("casclist")->where("cascname='职位亮点'")->find();
                $ldData = M("casclist")->where("parentid='$zwldId[id]'")->select();
                ////////////////////////////////////////////////////正在招聘///////////////////////////////////////////////
                $today = strtotime(date("Y-m-d H:i:s"));
                $arCurrectList = $this->getCurrectJobList("and endtime > $today", 1);
                $checked = $checkUserPavi['checkinfo'];
                ////////////////////////////////////////////////////往期招聘///////////////////////////////////////////////

                $arOldList = $this->getCurrectJobList("and endtime < $today", 2);

                ///////////////////////////////////////////////////////////////////////////////////////////////////////////
                if (trim($_GET['act']) == "joblist") {
                        $act = "CurrectJobList";
                } elseif (trim($_GET['act'] == "lastjoblist")) {
                        $act = "OldJobList";
                } else {
                        $act = "SendJob";
                }
                $this->assign("xfhy", $xfhy);
                $this->assign("arCurrectList", $arCurrectList);
                $this->assign("arOldList", $arOldList);
                $this->assign("act", $act);
                $this->assign("ischecked", $checked);
                $this->assign("arArea", $arArea);
                $this->assign("arJobcate", $arJobcate);
                $this->assign("arStrycate", $arStrycate);
                $this->assign("ynData", $ynData);
                $this->assign("ldData", $ldData);
                $this->assign("first_class", 3);
                $this->display("new_send_job");
        }

        public function ResumeList() {
                $id = intval($_GET['id']);
                $checkUserPavi = $this->checkUserPaviliong();
                $checkUserPavi['telephone'] = ($checkUserPavi['mobile'] ? $checkUserPavi['mobile'] : $checkUserPavi['telephone']);
                if ($checkUserPavi === false) {
                        $this->error("用户身份验证失败，请重新登陆后再试！");
                        exit();
                }
                if ($id) {
                        $jobInfoTmp = M("job")->where("id='$id'")->find();
                        //职位名称
                        if (!$jobInfoTmp['title']) {
                                $jobInfoTmp['title'] = M("casclist")->where("id='$jobInfoTmp[Jobcate]'")->getField("cascname");
                        }
                        $this->assign("jobInfoTmp", $jobInfoTmp);
                }

                $arJobList = M("job")->where("cpid=" . $checkUserPavi['id'] . " and is_deleted=0 and checkinfo='true' and endtime>" . time())->order("id desc")->select();

                $checked = $checkUserPavi['checkinfo'];

                if ($checked == "true") {
                        $arJobIDTmp = array();
                        if ($arJobList) {
                                $size = self::$_size;
                                if ($id) {
                                        $where = " and j_id='$id'";
                                } else {
                                        foreach ($arJobList as &$jobInfo) {
                                                if (!$jobInfo['title']) {
                                                        $jobInfo['title'] = M("casclist")->where("id='$jobInfo[Jobcate]'")->getField("cascname");
                                                }
                                                array_push($arJobIDTmp, $jobInfo['id']);
                                        }
                                        $sJobIDTmp = implode(",", $arJobIDTmp);

                                        $where = " and j_id in (" . $sJobIDTmp . ")";
                                }
                                $count = M("record")->where("status=2  " . $where)->count();
                                $page = new \Think\NewPage($count, $size);
                                $arRecordList = M("record")->where("status=2 " . $where)->order("j_id desc,id desc")->limit($page->firstRow, $page->listRows)->select();

                                if ($arRecordList) {
                                        $i = (($_GET['p'] ? $_GET['p'] : 1) - 1) * $size + 1;
                                        foreach ($arRecordList as $key => &$record) {
                                                $record['sort_id'] = $i++;
                                                $Resume = M("resume")->where("id=" . $record['bt_id'])->find();
                                                $record['bt_username'] = $Resume['username'];
                                                $job = M("job")->where("id='$record[j_id]'")->find();

                                                //职位名称
                                                if (!$job['title']) {
                                                        $record['title'] = M("casclist")->where("id='$job[Jobcate]'")->getField("cascname");
                                                } else {
                                                        $record['title'] = $job['title'];
                                                }

                                                $record['t_username'] = M("member")->where("id='$Resume[t_id]'")->getField("username");
                                                $record['state'] = getDataName('zzstart', $Resume['state']);
                                                $record['mobile'] = $Resume['mobile'];
                                                $record['sink'] = ($record['sink'] == 1 ? "未打款" : "已打款");
                                                $Resume['posttime'] = ($record['posttime'] != 0 ? date("Y-m-d", $record['posttime']) : "");
                                                $record['audstart_status'] = $record[audstart];
                                                $record['audstart'] = M("cascadedata")->where("datavalue='$record[audstart]' and datagroup='audstart'")->getField("dataname");
                                                $record['audstartdate'] = ($record['audstartdate'] ? $record['audstartdate'] : "电话沟通");
                                        }
                                }
                                $show = $page->show();
                        } else {
                                $arRecordList = false;
                        }
                }
                $arAudreasonList = M("cascadedata")->where("datagroup='audstart'")->order("orderid asc")->select();
                $this->assign("company", $checkUserPavi);
                $this->assign("arAudreasonList", $arAudreasonList);
                $this->assign("checked", $checked);
                $this->assign("arRecordList", $arRecordList);
                $this->assign("page", $show);
                $this->assign("arJobList", $arJobList);

                $this->assign("first_class", 4);
                $this->display("new_resume_list");
        }

        // 添加职位  处理
        public function companySendJobAdd() {


                if ($_POST['treatment'] == 8000 && $_POST['Tariff'] * 100 < 2000) {
                        echo json_encode(array("code" => 500, "msg" => "您选择的职位12000-15000元，招聘费不能低于2000"));
                        exit();
                } elseif ($_POST['treatment'] == 12000 && $_POST['Tariff'] * 100 < 3000) {
                        echo json_encode(array("code" => 500, "msg" => "您选择的职位12000-15000元，招聘费不能低于3000"));
                        exit();
                } elseif ($_POST['treatment'] == 15000 && $_POST['Tariff'] * 100 < 5000) {
                        echo json_encode(array("code" => 500, "msg" => "您选择的职位15000-20000元，招聘费不能低于5000"));
                        exit();
                } elseif ($_POST['treatment'] == 20000 && $_POST['Tariff'] * 100 < 10000) {
                        echo json_encode(array("code" => 500, "msg" => "您选择的职位20000-40000元，招聘费不能低于10000"));
                        exit();
                } elseif ($_POST['treatment'] == 40000 && $_POST['Tariff'] * 100 < 20000) {
                        echo json_encode(array("code" => 500, "msg" => "您选择的职位40000-60000元，招聘费不能低于20000"));
                        exit();
                } elseif ($_POST['treatment'] == 60000 && $_POST['Tariff'] * 100 < 30000) {
                        echo json_encode(array("code" => 500, "msg" => "您选择的职位60000-80000元，招聘费不能低于30000"));
                        exit();
                } elseif ($_POST['treatment'] == 80000 && $_POST['Tariff'] * 100 < 50000) {
                        echo json_encode(array("code" => 500, "msg" => "您选择的职位80000元以上，招聘费不能低于50000"));
                        exit();
                }
                $company = $this->getCompanyInfo();
                $data = $_POST;

                $data['starttime'] = time();
                $data['endtime'] = strtotime($data['endtime']);
                $data['cpid'] = $company['id'];
                $data['Tariff'] = $data['Tariff'] * 100;
                $data['checkinfo'] = "false";
                $data['workdesc'] = $_POST['workdesc'];
                $data['content'] = $_POST['content'];
                $data['jobbright'] = $_POST['jobbright'];
                $data['posttime'] = time();
                $data['guid'] = $this->create_guid();
                $data['cpname'] = $company['cpname'];
                if ($data['meth'] == 1) {
                        $data['email'] = ($company['cnname'] ? $company['cnname'] : "");
                        $data['mobile'] = (($company['mobile'] ? $company['mobile'] : $company['telephone']) ? ($company['mobile'] ? $company['mobile'] : $company['telephone']) : '');
                }
                unset($data['editor']);
                unset($data['editor1']);

                if (!$data['id']) {
                        unset($data['id']);
                        $res = M("job")->add($data);

                        /*                         * *****************************【推荐人】【发布职位】操作日志 begin****************************** */

                        $j_id = M("job")->getLastInsID(); //职位id
                        $arNoticeInfo = getCNoticeInfo(0, $_POST['title']);
                        $sLogtitle = $arNoticeInfo[0];
                        $sLogContent = $arNoticeInfo[1];
                        $username = $_SESSION['cusername'];
                        $arCompany = M("company")->where("username='" . $username . "'")->find();
                        addNoticeLog($arCompany['id'], $username, 0, $j_id, $sLogtitle, $sLogContent, 1, 2);

                        /*                         * *****************************【推荐人】【发布职位】操作日志 begin****************************** */

                        //查看发布的职位有多少个匹配的获选人
                        $fitCount = M("resume")->where("'" . $data['title'] . "' like CONCAT('%',keyword,'%') and keyword !=''")->count();

                        if ($fitCount) {
                                $fitCount = $fitCount * 3;
                        } else {
                                $fitCount = mt_rand(3, 6);
                        }
                        $_SESSION['fitCount'] = $fitCount;
                        $_SESSION['jobname'] = $data['title'];
                } else {
                        $res = M("job")->save($data);
                }

                if ($res) {
                        echo json_encode(array("code" => 200, "msg" => "ok"));
                        // $this->success("添加职位成功", U('Company/companyJobList'));
                } else {
                        echo json_encode(array("code" => 500, "msg" => "创建失败"));
                }
        }

        //正在招聘职位列表
        public function companyJobList() {
                $arCompany = $this->getCompanyInfo();
                $today = strtotime(date("Y-m-d H:i:s"));
                $List = $this->getCurrectJobList("and endtime > $today", 1);
                $checked = $arCompany['checkinfo'];
                $this->assign("checked", $checked);
                $this->assign("first_class", 2);
                $this->assign("second_class", 5);
                $this->assign("list", $List);
                $this->assign("isold", 2);

                $this->display('Company/company_job_list');
        }

        //往期招聘职位列表
        public function beforeCompanyJobList() {
                $arCompany = $this->getCompanyInfo();
                $today = strtotime(date("Y-m-d H:i:s"));
                $List = $this->getCurrectJobList("and endtime < $today", 2);
                $checked = $arCompany['checkinfo'];
                $this->assign("checked", $checked);
                $this->assign("list", $List);
                $this->assign("isold", 1);
                $this->assign("first_class", 2);
                $this->assign("second_class", 6);
                $this->display('Company/company_job_list');
        }

        //删除职位
        public function deleteJob() {
                $jobId = I("jobId");
                $data['id'] = $jobId;
                $data['is_deleted'] = 1;
                //查看当前职位是否有人投递简历
                $sRecordCount = M("record")->where("j_id='$jobId'")->count();
                if ($sRecordCount) {
                        echo json_encode(array("code" => 500, "msg" => "已经有人投递简历不允许删除！"));
                        exit();
                }
                $res = M("job")->save($data);
                if ($res) {
                        echo json_encode(array("code" => 200, "msg" => "ok！"));
                        exit();
                } else {
                        echo json_encode(array("code" => 500, "msg" => "操作失败！"));
                        exit();
                        //  $this->success("", U('Company/companyJobList'));
                }
        }

        //代付账单
        public function toBePaid() {
                //推荐进度
                $username = $_SESSION['cusername'];
                $sql = "SELECT distinct(j_id) from stj_notice_log where type=2 and username='$username'";
                $jobList = M("notice_log")->query($sql);
                if ($jobList) {
                        foreach ($jobList as &$jobID) {
                                $jobInfo = M("job")->where("id='$jobID[j_id]'")->find();
                                //职位名称
                                if (!$jobInfo['title']) {
                                        $jobID['title'] = M("casclist")->where("id='$jobInfo[Jobcate]'")->getField("cascname");
                                } else {
                                        $jobID['title'] = $jobInfo['title'];
                                }
                                $jobID['Tariff'] = $jobInfo['Tariff'];
                                $jobID['employ'] = $jobInfo['employ'];
                                $logList = M("notice_log")->where("j_id='$jobID[j_id]' and type=2")->order("j_id desc,created_at desc")->select();
                                $jobID['logList'] = $logList;
                        }
                }
                $act = trim($_GET['act']);
                $this->assign("jobList", $jobList);
                $pay = $this->getPaymentList();
                $oldpay = $this->getPayment("and  audstart =6");

                $this->assign("first_class", 5);
                $this->assign("act", $act);
                $this->assign("newPaid", $pay);
                $this->assign("oldPaid", $oldpay);
                $this->display('new_be_payed');
        }

        //付款记录
        public function paymentRecords() {
                $pay = $this->getPayment("and  audstart =6");
                $this->assign("first_class", 3);
                $this->assign("second_class", 8);
                $this->assign("list", $pay);
                $this->display('Company/payment_records');
        }

        public function getPaymentList() {
                $company = $this->getCompanyInfo();
                $cpid = $company['id'];
                $jobList = M("job")->field("id")->where("cpid = '$cpid'")->select();
                if ($jobList) {
                        foreach ($jobList as $job) {
                                $jobs[] = $job['id'];
                        }
                }
                $jobids = implode(',', $jobs);


                $count = M("record")->where("j_id in ($jobids) and audstart =6 AND sink=1")->count();
                $page = new \Think\NewPage($count, self::$_size);

                $payList = M("record")->where("j_id in ($jobids) and audstart =6 AND sink=1")->order("id desc")->limit($page->firstRow, $page->listRows)->select();
                $show = $page->show();
                if ($payList) {
                        $i = (($_GET['p'] ? $_GET['p'] : 1) - 1) * $size + 1;

                        foreach ($payList as $key => $pay) {
                                $job = M("job")->where("id = '" . $pay['j_id'] . "'")->find();

                                $payList[$key]['sort_id'] = $i++;
                                $tname = M("member")->field("username,fromwhere")->where("id = '" . $pay['t_id'] . "'")->find();
                              
                                $btname = M("resume")->field("username")->where("id = '" . $pay['bt_id'] . "'")->find();
                                if (!$job['title']) {
                                        $job['title'] = M("casclist")->where("id='$job[Jobcate]'")->getField("cascname");
                                } else {
                                        $job['title'] = $job['title'];
                                }
                                $payList[$key]['posttime'] = date("Y-m-d", $pay['posttime']);
                                
                                if($tname['fromwhere'] == "qq"){
                                        $payList[$key]['tname'] = "qq用户";
                                }elseif($tname['fromwhere'] == "weixin"){
                                        $payList[$key]['tname'] = "weixin用户";
                                }elseif($tname['fromwhere'] == "renren"){
                                        $payList[$key]['tname'] = "renren用户";
                                }elseif($tname['fromwhere'] == "sina"){
                                        $payList[$key]['tname'] = "sina用户";
                                }else{
                                        $payList[$key]['tname'] = $tname['username'];
                                }
                                $payList[$key]['btname'] = $btname['username'];
                                $payList[$key]['Jobcate'] = $job['title'];
                                $payList[$key]['Tariff'] = $job['Tariff'];
                        }
                }

                return array("payList" => $payList, "page" => $show);
        }

        //获取付款记录
        private function getPayment($where) {
                $company = $this->getCompanyInfo();
                $cpid = $company['id'];
                $jobList = M("job")->field("id")->where("cpid = '$cpid'")->select();
                if ($jobList) {
                        foreach ($jobList as $job) {
                                $jobs[] = $job['id'];
                        }
                }
                $jobids = implode(',', $jobs);
                $count = M("record")->where("j_id in ($jobids) $where")->count();
                $page = new \Think\NewPage($count, self::$_size);
                $limit = $page->firstRow . "，" . $page->listRows;
                $payList = M("record")->where("j_id in ($jobids) $where")->order("id desc")->limit($page->firstRow, $page->listRows)->select();
                $show = $page->show();
                if ($payList) {
                        $i = (($_GET['p'] ? $_GET['p'] : 1) - 1) * $size + 1;
                        foreach ($payList as $key => $pay) {
                                $payList[$key]['sort_id'] = $i++;
                                $job = M("job")->where("id = '" . $pay['j_id'] . "'")->find();
                                $tname = M("member")->where("id = '" . $pay['t_id'] . "'")->find();
                                $btname = M("resume")->where("id = '" . $pay['bt_id'] . "'")->find();
                                if (!$job['title']) {
                                        $job['title'] = M("casclist")->where("id='$job[Jobcate]'")->getField("cascname");
                                } else {
                                        $job['title'] = $job['title'];
                                }

                                $payList[$key]['posttime'] = date("Y-m-d", $pay['posttime']);

                                //在职状态
                                $zaizhistatus = M("cascadedata")->where("datagroup='zzstart' and datavalue='$btname[state]'")->find();

                                //面试状态
                                $mianshistatus = M("cascadedata")->where("datagroup='audstart' and datavalue='$pay[audstart]'")->find();
                                $payList[$key]['msstatus'] = $mianshistatus['dataname'];
                                $payList[$key]['zzstatus'] = $zaizhistatus['dataname'];
                                
                                if($tname['fromwhere'] == "qq"){
                                        $payList[$key]['tname'] = "qq用户";
                                }elseif($tname['fromwhere'] == "weixin"){
                                        $payList[$key]['tname'] = "weixin用户";
                                }elseif($tname['fromwhere'] == "renren"){
                                        $payList[$key]['tname'] = "renren用户";
                                }elseif($tname['fromwhere'] == "sina"){
                                        $payList[$key]['tname'] = "sina用户";
                                }else{
                                        $payList[$key]['tname'] = $tname['username'];
                                }
                                
                                $payList[$key]['btname'] = $btname['username'];
                                $payList[$key]['title'] = $job['title'];
                                $payList[$key]['Tariff'] = $job['Tariff'];
                                $payList[$key]['tatus'] = (($pay['sink'] == 1) ? "未打款" : "已打款");
                        }
                }
                return array("payList" => $payList, "page" => $show);
        }

        private function getCurrectJobList($where, $type) {
                $size = self::$_size;
                $company = $this->getCompanyInfo();
                $cpid = $company['id'];
                $today = strtotime(date("Y-m-d"));
                if ($type == 1) {
                        $arJobList = M("job")->where("cpid='$cpid' and is_deleted = 0 $where")->select();
                        $jobidlist = array();
                        if ($arJobList) {
                                foreach ($arJobList as $jobinfo) {
                                        if ($type == 1) {
                                                $recordCount = M("record")->where("j_id='$jobinfo[id]' and audstart=6")->count();

                                                if ($recordCount < $jobinfo['employ']) {
                                                        array_push($jobidlist, $jobinfo['id']);
                                                }
                                        }
                                }
                        }
                } else {
                        $arJobList = M("job")->where("cpid='$cpid' and is_deleted = 0")->select();
                        $jobidlist = array();
                        if ($arJobList) {
                                foreach ($arJobList as $jobinfo) {
                                        $recordCount = M("record")->where("j_id='$jobinfo[id]' and audstart=6")->count();

                                        if (($jobinfo['endtime'] < strtotime(date("Y-m-d H:i:s"))) || $recordCount >= $jobinfo['employ']) {
                                                array_push($jobidlist, $jobinfo['id']);
                                        }
                                }
                        }
                }

                if (!empty($jobidlist)) {
                        $idIn = implode(",", $jobidlist);
                        $count = M("job")->where("cpid = '$cpid' and is_deleted = 0 and id in (" . $idIn . ")")->count();
                        $page = new \Think\NewPage($count, $size);
                        $jobList = M("job")->where("cpid = '$cpid' and is_deleted = 0 and id in (" . $idIn . ")")->order("starttime desc")->limit($page->firstRow, $page->listRows)->select();
                        if ($jobList) {
                                $i = (($_GET['p'] ? $_GET['p'] : 1) - 1) * $size + 1;
                                foreach ($jobList as $key => &$job) {
                                        $jobid = $job['id'];
                                        $jobList[$key]['endtime'] = date("Y-m-d", $job['endtime']);
                                        $jobList[$key]['status'] = (($job['checkinfo'] == "true") ? "审核通过" : "正在审核");
                                        $total = M("record")->where("j_id = '$jobid' and status=2")->count();
                                        $noread = M("record")->where("j_id = '$jobid' and status=2 and news_status = 0 ")->count();
                                        // $audstart                 = M("record")->where("")
                                        // $jobList[$key]['total']   = $job['employ'];
                                        $jobList[$key]['total'] = $total;
                                        $jobList[$key]['noread'] = $noread ? $noread : 0;
                                        if (!$job['title']) {
                                                $job['title'] = M("casclist")->where("id='$job[Jobcate]'")->getField("cascname");
                                        } else {
                                                $job['title'] = $job['title'];
                                        }
                                        $job['sort_id'] = $i++;
                                }
                        }
                        $show = $page->show();
                        return array("jobList" => $jobList, "page" => $show);
                } else {
                        $page = new \Think\Page(0, $size);
                        $jobList = array(array());
                        $show = $page->show();
                        return array("jobList" => false, "page" => $show);
                }
        }

        //获取职位列表
        private function getJobList($where) {
                $size = self::$_size;
                $company = $this->getCompanyInfo();
                $cpid = $company['id'];
                $count = M("job")->where("cpid = '$cpid' and is_deleted = 0 $where")->count();
                $page = new \Think\Page($count, $size);
                $limit = $page->firstRow . "，" . $page->listRows;
                $jobList = M("job")->where("cpid = '$cpid' and is_deleted = 0 $where")->order("id desc")->limit($page->firstRow, $page->listRows)->select();
                if ($jobList) {
                        $i = (($_GET['p'] ? $_GET['p'] : 1) - 1) * $size + 1;
                        foreach ($jobList as $key => &$job) {
                                $jobid = $job['id'];
                                $jobList[$key]['endtime'] = date("Y.m.d", $job['endtime']);
                                $jobList[$key]['status'] = (($job['checkifno'] == "true") ? "审核通过" : "正在审核");
                                $total = M("record")->where("j_id = '$jobid'")->count();
                                $noread = M("record")->where("j_id = '$jobid' and news_status = 0 ")->count();
                                $jobList[$key]['total'] = $total ? $total : 0;
                                $jobList[$key]['noread'] = $noread ? $noread : 0;
                                if (!$job['title']) {
                                        $job['title'] = M("casclist")->where("id='$job[Jobcate]'")->getField("cascname");
                                } else {
                                        $job['title'] = $job['title'];
                                }
                                $job['sort_id'] = $i++;
                        }
                }
                $show = $page->show();
                return array("jobList" => $jobList, "page" => $show);
        }

        public function getJobInfo() {
                $objCascade = M("cascade");
                $arConfigBaseInfo = $objCascade->where("groupsign IN ('treatment', 'area', 'experience', 'education', 'joblang')")->select();

                if ($arConfigBaseInfo) {
                        $objCascadedata = M("cascadedata");
                        foreach ($arConfigBaseInfo as &$arrBaseInfo) {
                                $arConfigInfo = $objCascadedata->where("`datagroup` = " . "'" . $arrBaseInfo['groupsign'] . "'")->order("orderid asc")->select();
                                if ($arConfigInfo) {
                                        $arrBaseInfo['config_list'] = $arConfigInfo;
                                }
                        }
                }
                return $arConfigBaseInfo;
        }

        //获取配置信息 公司性质 : 公司规模 : 公司阶段 
        public function getConfigInfo() {

                $objCascade = M("cascade");
                $arConfigBaseInfo = $objCascade->where("groupsign IN ('nature','scale','stage')")->select();

                if ($arConfigBaseInfo) {
                        $objCascadedata = M("cascadedata");
                        foreach ($arConfigBaseInfo as &$arrBaseInfo) {
                                $arConfigInfo = $objCascadedata->where("`datagroup` = " . "'" . $arrBaseInfo['groupsign'] . "'")->order("orderid asc")->select();
                                if ($arConfigInfo) {
                                        $arrBaseInfo['config_list'] = $arConfigInfo;
                                }
                        }
                }
                return $arConfigBaseInfo;
        }

        public function ContInformation() {

                $arCompanyInfo = $this->getCompanyInfo();

                if (!$arCompanyInfo['cnname']) {
                        $sIsNewCompay = 1;
                } else {
                        $sIsNewCompay = 2;
                }
                $this->assign("first_class", 1);
                $this->assign("second_class", 3);
                $this->assign("arCompanyInfo", $arCompanyInfo);
                $this->assign("sIsNewCompay", $sIsNewCompay);
                $this->display('Company/company_cont_info');
        }

        public function saveCompanyCont() {
                $data = array();
                $data['address'] = $_POST['address'];
                $data['cnname'] = $_POST['cnname'];
                //  $data['mobile']    = $_POST['mobile'];
                $data['email'] = $_POST['email'];
                $data['telephone'] = $_POST['telephone'];
                $objComany = M("company");
                if (!$_SESSION['cusername']) {
                        echo json_encode(array("code" => 500, "msg" => "您长时间未操作，请重新登录"));
                        exit();
                }
                $arCompanyInfo = $objComany->where("username='" . $_SESSION['cusername'] . "'")->find();

                if (empty($arCompanyInfo)) {
                        echo json_encode(array("code" => 500, "msg" => "您长时间未操作，请重新登录"));
                        exit();
                }

                $objComany->where("username='" . $_SESSION['cusername'] . "'")->save($data);

                echo json_encode($data);
                exit();
        }

        //推荐列表
        public function experList() {

                $id = intval($_GET['id']);
                if ($id <= 0) {
                        echo "参数错误";
                        exit();
                }
                //职位信息
                $jobInfo = M("job")->where("id='$id'")->find();
                if (!$jobInfo['title']) {
                        $jobInfo['title'] = M("casclist")->where("id='$jobInfo[Jobcate]'")->getField("cascname");
                }
                $arCompanyInfo = $this->getCompanyInfo();
                $jobInfo['comname'] = $arCompanyInfo['cpname'];
                $jobInfo['jobplace'] = $arCompanyInfo['address'];
                $jobInfo['cnname'] = $arCompanyInfo['cnname'];
                $jobInfo['telephone'] = ($arCompanyInfo['mobile'] ? $arCompanyInfo['mobile'] : $arCompanyInfo['telephone']);
                $arRecordList = $this->getRecordList($id);
                $arAudreasonList = M("cascadedata")->where("datagroup='audstart'")->order("orderid asc")->select();
                //判断是否可以查看简历
                $isViewReuse = 1;
                $recordCount = M("record")->where("j_id='$id[id]' and audstart=6")->count();
                if ($recordCount >= $jobInfo['employ'] || $jobInfo['endtime'] < time()) {
                        $isViewReuse = 0;
                }
                $this->assign("arAudreasonList", $arAudreasonList);
                $this->assign("isViewReuse", $isViewReuse);
                $this->assign("first_class", 2);
                $this->assign("second_class", 5);
                $this->assign("arRecordList", $arRecordList);
                $this->assign("jobInfo", $jobInfo);
                $this->display('Company/exper_list');
        }

        public function getRecordList($j_id) {
                $size = self::$_size;

                $count = M("record")->where("j_id='$j_id'  and status=2")->count();

                $page = new \Think\Page($count, $size);

                $arRecordList = M("record")->where("j_id = '$j_id' and status=2")->order("news_status asc")->limit($page->firstRow, $page->listRows)->select();

                if ($arRecordList) {
                        $i = (($_GET['p'] ? $_GET['p'] : 1) - 1) * $size + 1;
                        foreach ($arRecordList as &$arRecordInfo) {

                                $arRecordInfo['tName'] = M("member")->where("id='$arRecordInfo[t_id]'")->getField("username");
                                $arBtInfo = M("resume")->where("id='$arRecordInfo[bt_id]'")->find();
                                $arRecordInfo['btName'] = $arBtInfo['username'];
                                $arRecordInfo['mobile'] = $arBtInfo['mobile'];
                                $arRecordInfo['audstart_status'] = $arRecordInfo[audstart];
                                $arRecordInfo['audstart'] = M("cascadedata")->where("datavalue='$arRecordInfo[audstart]' and datagroup='audstart'")->getField("dataname");
                                $arRecordInfo['stage'] = M("cascadedata")->where("datavalue='$arBtInfo[state]' and datagroup='zzstart'")->getField("dataname");
                                //  $arRecordInfo['sink']     = M("cascadedata")->where("datavalue='$arBtInfo[sink]' and datagroup='audstart'")->getField("dataname");
                                $arRecordInfo['audstartdate'] = ($arRecordInfo['audstartdate'] ? $arRecordInfo['audstartdate'] : "电话沟通");
                                $arRecordInfo['sink'] = (($arRecordInfo['sink'] == 1) ? "未打款" : "已打款");


                                $arRecordInfo['sort_id'] = $i++;
                        }
                }
                $show = $page->show();
                return array("list" => $arRecordList, "page" => $show);
        }

        public function viewResume() {
                //推荐记录id
                $id = intval($_GET['id']) > 0 ? intval($_GET['id']) : 0;
                //招聘信息id
                $jid = intval($_GET['jid']) > 0 ? intval($_GET['jid']) : 0;
                //推荐人id
                $btid = intval($_GET['btid']) > 0 ? intval($_GET['btid']) : 0;
                //推荐记录信息
                if ($id == 0 || $jid == 0 || $btid == 0) {
                        $this->error("您长时间未操作，已登录超时，若想继续操作，请重新登录！", U('Index/index'));
                        exit();
                }
                //简历信息
                $resumeInfo = M("resume")->where("id='$btid'")->find();
                $arJobInfo = M("job")->where("id='$jid'")->find();
                if (!$arJobInfo['title']) {
                        $arJobInfo['title'] = M("casclist")->where("id='$arJobInfo[Jobcate]'")->getField("cascname");
                }

                $arRecord = M("record")->where("id='$id'")->find();
                if ($arRecord['news_status'] == "0") {


                        /*                         * ***************************【推荐人/企业】企业查看简历操作日志 begin************************** */

                        $arCompanyInfo = M("company")->where("id={$arJobInfo['cpid']}")->find();
                        $username = $_SESSION['cusername'];

                        $arTNoticeInfo = getTNoticeInfo(6, $resumeInfo['username'], $arCompanyInfo['cpname'], $arJobInfo['title']);
                        $sLogtitle = $arTNoticeInfo[0];
                        $sLogContent = $arTNoticeInfo[1];
                        addNoticeLog($arCompanyInfo['id'], $username, $btid, $jid, $sLogtitle, $sLogContent);

                        $arCNoticeInfo = getCNoticeInfo(6, $arJobInfo['title'], $resumeInfo['username']);
                        $sLogtitle = $arCNoticeInfo[0];
                        $sLogContent = $arCNoticeInfo[1];
                        addNoticeLog($arCompanyInfo['id'], $username, $btid, $jid, $sLogtitle, $sLogContent, 1, 2);

                        /*                         * ***************************【推荐人/企业】企业查看简历操作日志 begin************************** */
                        //修改新消息状态
                        M("record")->query("UPDATE stj_record set news_status=1 where id='$id'");
                }




                if ($_SESSION['company_id'] != $arJobInfo['cpid']) {
                        $this->error("您访问的页面不存在，到<a href='http://www.renrenlie.com'>首页</a>去！", U('Index/index'));
                        exit();
                }

                $resumeInfo['sex'] = (($resumeInfo['sex'] == 0) ? "男" : "女");
                $resumeInfo['stage'] = M("cascadedata")->where("datavalue='$resumeInfo[state]' and datagroup='zzstart'")->getField("dataname");
                //教育经历

                $educat_list = M("education")->where("keyid='$resumeInfo[keyid]'")->order("id desc")->find();
                $resumeInfo['workexper'] = M("workexper")->where("keyid='$resumeInfo[keyid]'")->getField("intro");
                $resumeInfo['education'] = $educat_list['content'];
                /*
                  if ($educat_list)
                  {
                  foreach ($educat_list as &$educat_info)
                  {
                  $educat_info['starttime'] = date("Y-m-d", $educat_info['starttime']);
                  $educat_info['endtime']   = date("Y-m-d", $educat_info['endtime']);
                  }
                  $resumeInfo['educat_list'] = $educat_list;
                  }
                 * 
                 */

                //  str_replace("&#0", "&lt", $resumeInfo['education']);
                // var_dump($resumeInfo['education']);exit();


                if ($resumeInfo['wordname']) {
                        $resumeInfo['uploadName'] = $resumeInfo['username'] . "  " . $arJobInfo['title'] . "+" . $resumeInfo['wordname'];
                        $resumeInfo['uploadUrl'] = M("uploads")->where("name='$resumeInfo[wordname]'")->getField("path");
                        $sFilePath = "/Uploads/word/" . $resumeInfo[wordname];
                        if (file_exists($sFilePath)) {
                                $resumeInfo['uploadUrl'] = $sFilePath;
                        } else {
                                $r = M("uploads")->where("name='$resumeInfo[wordname]'")->find();

                                if (!empty($r)) {
                                        $resumeInfo['uploadUrl'] = $r['path'];
                                }
                        }
                        $resumeInfo['upurl'] = $resumeInfo['wordname'];
                }
                $this->assign("id", $id);
                $this->assign("jid", $jid);
                $this->assign("btid", $btid);
                $this->assign("first_class", 4);
                $this->assign("userinfo", $resumeInfo);
                // $this->display("view_resume");
                $this->display('Company/new_view_resume');
        }

        public function nyMessage() {
                $arJobList = M("job")->where("cpid='$_SESSION[company_id]' and checkinfo='true'")->select();

                if ($arJobList) {
                        foreach ($arJobList as $job) {
                                $jobs[] = $job['id'];
                        }
                        $jobids = implode(',', $jobs);
                        $arRecordList = M("record")->where("j_id in (" . $jobids . ") and news_status=0")->limit(0, 20)->select();

                        if ($arRecordList) {
                                $newsList = array();
                                foreach ($arRecordList as $arRecordInfo) {

                                        $jobInfo = M("job")->where("id='$arRecordInfo[j_id]'")->find();
                                        if (!$jobInfo['title']) {
                                                $title = M("casclist")->where("id='$jobInfo[Jobcate]'")->getField("cascname");
                                        }

                                        $arNews['news'] = "您发布的招聘" . $title . "职位，已经有推荐人推荐给您了，请您留意您正在招聘的信息！";
                                        $arNews['time'] = date("Y-m-d H:i", $arRecordInfo['posttime']);
                                        $arNews['type'] = "招聘信息";
                                        array_push($newsList, $arNews);
                                }

                                if (count($newsList) <= 20) {
                                        $arJobList = M("job")->where("cpid='$_SESSION[company_id]' and checkinfo='true' and newstatus=0")->limit(0, 10)->select();
                                        if ($arJobList) {
                                                $newsLists = array();
                                                foreach ($arJobList as $arJobInfo) {

                                                        if (!$arJobInfo['title']) {
                                                                $title = M("casclist")->where("id='$arJobInfo[Jobcate]'")->getField("cascname");
                                                        }

                                                        $arNews['news'] = "您发布的招聘" . $title . "职位，已经审核通过了，请您留意您正在招聘的信息！";
                                                        $arNews['time'] = "";
                                                        $arNews['type'] = "系统审核";
                                                        array_push($newsLists, $arNews);
                                                }
                                                $newsList = array_merge($newsLists, $newsList);
                                        }
                                }
                        } else {
                                $arJobList = M("job")->where("cpid='$_SESSION[company_id]' and checkinfo='true' and newstatus=0")->limit(0, 10)->select();
                                if ($arJobList) {
                                        $newsList = array();
                                        foreach ($arJobList as $arJobInfo) {

                                                if (!$arJobInfo['title']) {
                                                        $title = M("casclist")->where("id='$arJobInfo[Jobcate]'")->getField("cascname");
                                                }

                                                $arNews['news'] = "您发布的招聘" . $title . "职位，已经审核通过了，请您留意您正在招聘的信息！";
                                                $arNews['time'] = "";
                                                $arNews['type'] = "系统审核";
                                                array_push($newsList, $arNews);
                                        }
                                }
                        }
                }
                //修改状态
                $arJobList = M("job")->where("cpid='$_SESSION[company_id]' and checkinfo='true'")->select();

                if ($arJobList) {
                        foreach ($arJobList as $job) {
                                $jobs[] = $job['id'];
                        }
                        $jobids = implode(',', $jobs);
                        $arRecordList = M("record")->where("j_id in (" . $jobids . ") and news_status=0")->save(array("news_status" => 1));
                }
                $arJobList = M("job")->where("cpid='$_SESSION[company_id]' and checkinfo='true' and newstatus=0")->save(array("newstatus" => 1));
                $this->assign("first_class", 3);
                $this->assign("second_class", 9);
                $this->assign("newsList", $newsList);
                $this->display('Company/my_message');
        }

        public function getData() {
                $id = $_POST['id'];
                $hyData = M("casclist")->where("parentid='$id'")->order("orderid asc")->select();
                echo json_encode($hyData);
                exit();
        }

        public function sendMessage() {
                if($_POST['hash'] != md5("rrl_".$_SESSION['cookie'])){
                        return;
                }
               
                $telephone = $_POST['mobile'];
                $content = $_POST['msgcontent'];
                $linkid = $_POST['recordid'];
                $res = smsChannel($telephone, $content, $linkid, "companyCallResume", "面试短信");
                // $res = $this->sendMsg($telephone, $content);
                if ($res == true) {
                        echo json_encode(array("code" => "200", "msg" => "发送成功!"));
                        exit();
                } else {
                        echo json_encode(array("code" => "500", "msg" => "系统繁忙,请您稍后重试!"));
                        exit();
                }
                exit();
                $res = smsChannel($telephone, $content, 0, "InterviewInvitation", "企业发送面试邀请短信");

                if ($res['code'] == "200") {
                        echo json_encode(array("code" => "200", "msg" => "发送成功!"));
                        exit();
                } else {
                        echo json_encode(array("code" => "500", "msg" => "系统繁忙,请您稍后重试!"));
                        exit();
                }
        }

        public function sendMsg($telephone, $content) {

                $target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit";

                $mobile = $telephone;

                if (!$mobile) {
                        //防用户恶意请求
                        echo json_encode(array("code" => 500, "msg" => "手机号格式不正确"));
                        exit();
                }

                $post_data = "account=cf_zpkj&password=renrenlie231&mobile=" . $mobile . "&content=" . rawurlencode($content);
                //密码可以使用明文密码或使用32位MD5加密
                //840a6d63c511f5b0a61afc7352c207f3
                $gets = $this->xml_to_array($this->Post($post_data, $target));

                if ($gets['SubmitResult']['code'] == 2) {
                        return "ok";
                } else {
                        return $gets;
                }
        }

        public function Post($curlPost, $url) {
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

        public function xml_to_array($xml) {
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

        public function updateUserStatus() {

                $reasonid = $_POST['reasonid'];
                $data['audstart'] = $_POST['statused'];
                if (!empty($_POST['content'])) {
                        $data['audreason'] = $_POST['content'];
                }
                if (!empty($_POST['candidate_time'])) {
                        $data['real_audstart_time'] = $_POST['candidate_time'];
                }
                $data['audstarttime'] = time();
                $status = M("record")->where("id='$reasonid'")->save($data);
                $status = $_POST['statused'];
                $statusValue = getCascData("audstart", $status, "信息不明");

                //推荐info
                $recordinfo = M("record")->where("id='$reasonid'")->find();

                /*                 * *********************【推荐人/企业】【修改面试状态】操作日志  begin*********************************** */

                $resumeInfo = M("resume")->where("id=" . $recordinfo['bt_id'])->find();
                $arJobInfo = M("job")->where("id=" . $recordinfo['j_id'])->find();
                $arCompanyInfo = M("company")->where("id=" . $arJobInfo['cpid'])->find();
                if (!$arJobInfo['title']) {
                        $arJobInfo['title'] = M("casclist")->where("id='$arJobInfo[Jobcate]'")->getField("cascname");
                }
                if ($data['audreason']) {
                        $arTNoticeInfo = getTNoticeInfo(9, $resumeInfo['username'], $arCompanyInfo['cpname'], $arJobInfo['title'], "", $statusValue, $data['audreason']);
                        $arCNoticeInfo = getCNoticeInfo(9, $arJobInfo['title'], $resumeInfo['username'], $statusValue, $data['audreason']);
                } else {
                        $arTNoticeInfo = getTNoticeInfo(7, $resumeInfo['username'], $arCompanyInfo['cpname'], $arJobInfo['title'], "", $statusValue);
                        $arCNoticeInfo = getCNoticeInfo(7, $arJobInfo['title'], $resumeInfo['username'], $statusValue);
                }
                $sLogtitle = $arTNoticeInfo[0];
                $sLogContent = $arTNoticeInfo[1];
                addNoticeLog($arCompanyInfo['id'], $arCompanyInfo['username'], $recordinfo['bt_id'], $recordinfo['j_id'], $sLogtitle, $sLogContent);


                $sLogtitle = $arCNoticeInfo[0];
                $sLogContent = $arCNoticeInfo[1];
                addNoticeLog($arCompanyInfo['id'], $arCompanyInfo['username'], $recordinfo['bt_id'], $recordinfo['j_id'], $sLogtitle, $sLogContent, 1, 2);

                /*                 * *********************【推荐人/企业】【修改面试状态】操作日志  end*********************************** */

                //////////////////////////分享职位送大礼/////////////////////////////////
                if (C("SHARE_JON_OPEN") === true) {

                        //   $id = $_POST['rid'] = 499;
                        //如果是活动1并且是已入职状态则查看是否已经为推荐人的来源用户赠送过
                        $activiteID = C("SHARE_JOB_ID");
                        if ($status == 6 && $activiteID == 2) {
                                $activeInfo = M("active")->where("id='$activiteID' and status=1 and endtime>'" . date("Y-m-d H:i:s") . "'")->find();
                                if ($activeInfo) {

                                        $memberId = $recordinfo['t_id'];
                                        $userInfo = M("member")->where("id=" . $memberId . " AND fromwhere='share'")->find();
                                        if ($userInfo) {

                                                //如果存在还没有赠送过并且有来源的username，则赠送给分享人金额
                                                $userinfo = M("userinfo")->where("username='" . $userInfo[username] . "' and fromusername !=''")->find();

                                                if ($userinfo) {
                                                        $Recorduserinfo = M("userinfo")->where("username='" . $userinfo[fromusername] . "'")->find();
                                                        $accArr = M("account")->where("uid='$Recorduserinfo[userid]'")->find();
                                                        //查找推荐人之前的账户信息
                                                        $time = time();
                                                        if (empty($accArr)) {
                                                                //插入一条信息账户信息到account表中
                                                                $sql = "insert into   stj_account(uid,username,account,created_at,updated_at)  values($Recorduserinfo[userid],'$Recorduserinfo[username]'," . C('SHARE_JOB_RECORD_SUCCESS') . ",'$time','$time')";
                                                                M("account")->query($sql);
                                                                $newAccount = C('SHARE_JOB_RECORD_SUCCESS');
                                                                $account = 0;
                                                        } else {

                                                                //插入一条日志记录到account_balance中
                                                                $newAccount = $accArr['account'] + C('SHARE_JOB_RECORD_SUCCESS');
                                                                //更新账户表中的金额和更新时间
                                                                $sql = "update  stj_account  set account='{$newAccount}',updated_at='{$time}'  where id ={$accArr['id']}";
                                                                M("account")->query($sql);
                                                                $account = $accArr['account'];
                                                        }
                                                        $sql = "insert into  stj_account_blance(uid,username,last_account,account,incr,operat,`from`,comment,created_at,updated_at)  values({$Recorduserinfo[userid]},'{$Recorduserinfo[username]}',{$account},$newAccount," . C('SHARE_JOB_RECORD_SUCCESS') . ",'','shareMoney','分享职位成功入职。','{$time}','{$time}')";
                                                        M("account_blance")->query($sql);
                                                        //首次推荐修改状态
                                                        $sql = "update  stj_share  set num=`num`+1  where decrypturl ='$userinfo[fromwhere]'";
                                                        M("share")->query($sql);
                                                }
                                        }
                                }
                        }

                        //如果是活动1并且是已入职状态并且此人是通过分享而来则赠送分享人奖励
                        $activiteID = C("SHARE_JOB_ID");
                        if ($status == 6 && $activiteID == 2) {
                                $activeInfo = M("active")->where("id='$activiteID' and status=1 and endtime>'" . date("Y-m-d H:i:s") . "'")->find();
                                if ($activeInfo) {

                                        $jobInfo = M("job")->where("id='$recordinfo[j_id]'")->find();
                                        $memberId = $jobInfo['cpid'];
                                        $userInfo = M("company")->where("id=" . $memberId . " AND fromwhere='share'")->find();
                                        if ($userInfo) {

                                                //如果存在还没有赠送过并且有来源的username，则赠送给分享人金额
                                                $userinfo = M("userinfo")->where("username='" . $userInfo[username] . "' and fromusername !=''")->find();

                                                if ($userinfo) {
                                                        $Recorduserinfo = M("userinfo")->where("username='" . $userinfo[fromusername] . "'")->find();
                                                        $accArr = M("account")->where("uid='$Recorduserinfo[userid]'")->find();
                                                        //查找推荐人之前的账户信息
                                                        $time = time();
                                                        if (empty($accArr)) {
                                                                //插入一条信息账户信息到account表中
                                                                $sql = "insert into   stj_account(uid,username,account,created_at,updated_at)  values($Recorduserinfo[userid],'$Recorduserinfo[username]'," . C('SHARE_JOB_COMPANY_SUCCESS') . ",'$time','$time')";
                                                                M("account")->query($sql);
                                                                $newAccount = C('SHARE_JOB_COMPANY_SUCCESS');
                                                                $account = 0;
                                                        } else {

                                                                //插入一条日志记录到account_balance中
                                                                $newAccount = $accArr['account'] + C('SHARE_JOB_COMPANY_SUCCESS');
                                                                //更新账户表中的金额和更新时间
                                                                $sql = "update  stj_account  set account='{$newAccount}',updated_at='{$time}'  where id ={$accArr['id']}";
                                                                M("account")->query($sql);
                                                                $account = $accArr['account'];
                                                        }
                                                        $sql = "insert into  stj_account_blance(uid,username,last_account,account,incr,operat,`from`,comment,created_at,updated_at)  values({$Recorduserinfo[userid]},'{$Recorduserinfo[username]}',{$account},$newAccount," . C('SHARE_JOB_COMPANY_SUCCESS') . ",'','shareMoney','分享职位企业成功入职。','{$time}','{$time}')";
                                                        M("account_blance")->query($sql);
                                                        //首次推荐修改状态
                                                        $sql = "update  stj_share  set num=`num`+1  where decrypturl ='$userinfo[fromwhere]'";
                                                        M("share")->query($sql);
                                                }
                                        }
                                }
                        }
                }


                ////////////////////////////////推广奖利送大礼////////////////////////////////////////////////////////
                if (C("SHARE_RECOMMENDSHARE_OPEN") === true && $status == 6) {
                        $activiteID = C("SHARE_RECOMMENDSHARE_ID");
                        if ($status == 6 && $activiteID == 4) {
                                $activeInfo = M("active")->where("id='$activiteID' and status=1 and endtime>'" . date("Y-m-d H:i:s") . "'")->find();
                                if ($activeInfo) {

                                        $memberId = $recordinfo['t_id'];
                                        $userInfo = M("member")->where("id=" . $memberId . " AND fromwhere='recommentshare'")->find();

                                        if ($userInfo) {

                                                //如果存在还没有赠送过并且有来源的username，则赠送给分享人金额
                                                $userinfo = M("userinfo")->where("username='" . $userInfo[username] . "' and fromusername !=''")->find();

                                                if ($userinfo) {
                                                        $Recorduserinfo = M("userinfo")->where("username='" . $userinfo[fromusername] . "'")->find();
                                                        $accArr = M("account")->where("uid='$Recorduserinfo[userid]'")->find();
                                                        //查找推荐人之前的账户信息
                                                        $time = time();
                                                        if (empty($accArr)) {
                                                                //插入一条信息账户信息到account表中
                                                                $sql = "insert into   stj_account(uid,username,account,created_at,updated_at)  values($Recorduserinfo[userid],'$Recorduserinfo[username]'," . C('SHARE_RECOMMENDSHARE_RECORD_SUCCESS') . ",'$time','$time')";
                                                                M("account")->query($sql);
                                                                $newAccount = C('SHARE_RECOMMENDSHARE_RECORD_SUCCESS');
                                                                $account = 0;
                                                        } else {

                                                                //插入一条日志记录到account_balance中
                                                                $newAccount = $accArr['account'] + C('SHARE_RECOMMENDSHARE_RECORD_SUCCESS');
                                                                //更新账户表中的金额和更新时间
                                                                $sql = "update  stj_account  set account='{$newAccount}',updated_at='{$time}'  where id ={$accArr['id']}";
                                                                M("account")->query($sql);
                                                                $account = $accArr['account'];
                                                        }
                                                        $sql = "insert into  stj_account_blance(uid,username,last_account,account,incr,operat,`from`,comment,created_at,updated_at)  values({$Recorduserinfo[userid]},'{$Recorduserinfo[username]}',{$account},$newAccount," . C('SHARE_RECOMMENDSHARE_RECORD_SUCCESS') . ",'','recommendShare ','推广分享奖励。 。','{$time}','{$time}')";
                                                        M("account_blance")->query($sql);
                                                        //首次推荐修改状态
                                                        $sql = "update  stj_share  set num=`num`+1  where decrypturl ='$userinfo[fromwhere]'";
                                                        M("share")->query($sql);
                                                }
                                        }
                                }
                        }


                        $activiteID = C("SHARE_RECOMMENDSHARE_ID");
                        if ($status == 6 && $activiteID == 4) {
                                $activeInfo = M("active")->where("id='$activiteID' and status=1 and endtime>'" . date("Y-m-d H:i:s") . "'")->find();
                                if ($activeInfo) {

                                        $jobInfo = M("job")->where("id='$recordinfo[j_id]'")->find();
                                        $memberId = $jobInfo['cpid'];
                                        $userInfo = M("company")->where("id=" . $memberId . " AND fromwhere='recommentshare'")->find();
                                        if ($userInfo) {

                                                //如果存在还没有赠送过并且有来源的username，则赠送给分享人金额
                                                $userinfo = M("userinfo")->where("username='" . $userInfo[username] . "' and fromusername !=''")->find();

                                                if ($userinfo) {
                                                        $Recorduserinfo = M("userinfo")->where("username='" . $userinfo[fromusername] . "'")->find();
                                                        $accArr = M("account")->where("uid='$Recorduserinfo[userid]'")->find();
                                                        //查找推荐人之前的账户信息
                                                        $time = time();
                                                        if (empty($accArr)) {
                                                                //插入一条信息账户信息到account表中
                                                                $sql = "insert into   stj_account(uid,username,account,created_at,updated_at)  values($Recorduserinfo[userid],'$Recorduserinfo[username]'," . C('SHARE_RECOMMENDSHARE_COMPANY_SUCCESS') . ",'$time','$time')";
                                                                M("account")->query($sql);
                                                                $newAccount = C('SHARE_RECOMMENDSHARE_COMPANY_SUCCESS');
                                                                $account = 0;
                                                        } else {

                                                                //插入一条日志记录到account_balance中
                                                                $newAccount = $accArr['account'] + C('SHARE_RECOMMENDSHARE_COMPANY_SUCCESS');
                                                                //更新账户表中的金额和更新时间
                                                                $sql = "update  stj_account  set account='{$newAccount}',updated_at='{$time}'  where id ={$accArr['id']}";
                                                                M("account")->query($sql);
                                                                $account = $accArr['account'];
                                                        }
                                                        $sql = "insert into  stj_account_blance(uid,username,last_account,account,incr,operat,`from`,comment,created_at,updated_at)  values({$Recorduserinfo[userid]},'{$Recorduserinfo[username]}',{$account},$newAccount," . C('SHARE_RECOMMENDSHARE_COMPANY_SUCCESS') . ",'','recommendShare ','推广分享奖励。','{$time}','{$time}')";
                                                        M("account_blance")->query($sql);
                                                        //首次推荐修改状态
                                                        $sql = "update  stj_share  set num=`num`+1  where decrypturl ='$userinfo[fromwhere]'";
                                                        M("share")->query($sql);
                                                }
                                        }
                                }
                        }
                }
                // $recordInfo = M("record")->where("id='$reasonid'")->find();
                //  echo M("record")->getLastSql();

                echo json_encode("ok");
        }

        public function getuserinfos() {
                $companyInfo = $this->getCompanyInfo();
                if (!$companyInfo['cpname'] || !$companyInfo['nature'] || !$companyInfo['brightreg'] || !$companyInfo['scale'] || !$companyInfo['stage']) {
                        echo json_encode(array("code" => 500, "msg" => "您的个人信息未完善，请完善后再发布职位", "url" => "EnterpriseInformation"));
                        exit();
                } elseif (!$companyInfo['intro']) {
                        echo json_encode(array("code" => 500, "msg" => "您的公司简介未完善，请完善后再发布职位", "url" => "introductCompany"));
                        exit();
                } elseif (!$companyInfo['bright']) {
                        echo json_encode(array("code" => 500, "msg" => "您的公司亮点未完善，请完善后再发布职位", "url" => "companyBright"));
                        exit();
                } elseif (!$companyInfo['address'] || !$companyInfo['cnname'] || !$companyInfo['email'] || (!$companyInfo['mobile'] && !$companyInfo['telephone'])) {
                        echo json_encode(array("code" => 500, "msg" => "您的联系方式未完善，请完善后再发布职位", "url" => "ContInformation"));
                        exit();
                } else {
                        echo json_encode(array("code" => 200));
                        exit();
                }
        }

        public function uploadeword() {

                $sFilePath = "/usr/local/htdocs/www/lierenren/Uploads/word/" . $_GET['jid'];
                if (file_exists($sFilePath)) {

                        $nFileSize = filesize($sFilePath);
                        header("Content-Disposition: attachment; filename=" . basename($_GET['jid']));
                        header("Content-Length: " . $nFileSize);
                        header("Content-type: application/octet-stream");
                        mb_convert_encoding(readfile($sFilePath));
                } else {
                        $r = M("uploads")->where("name='$_GET[jid]'")->find();

                        if (empty($r)) {
                                echo("文件不存在！");
                        } else {
                                $sFilePath = "/usr/local/htdocs/www/lierenren/" . $r['path'];
                                if (file_exists($sFilePath)) {
                                        $nFileSize = filesize($sFilePath);
                                        header("Content-Disposition: attachment; filename=" . basename($_GET['pid']));
                                        header("Content-Length: " . $nFileSize);
                                        header("Content-type: application/octet-stream");
                                        mb_convert_encoding(readfile($sFilePath));
                                }
                        }
                }
        }

        public function viewSendJob() {





                $jobid = I('id');

                $model = M('job', 'stj_', 'DB_CONFIG1');
                $cmodel = M('company', 'stj_', 'DB_CONFIG1');


                if (!is_numeric($jobid)) {

                        $jobInfo = $model->where("guid='" . $jobid . "'")->find();
                } else {
                        $jobInfo = $model->where("id='" . $jobid . "'")->find();
                }
                $comInfo = $cmodel->where("id=" . $jobInfo['cpid'])->find();
                if (empty($comInfo)) {
                        $this->error("您访问的页面不存在，到<a href='http://www.renrenlie.com'>首页</a>去！");
                        exit();
                }
                if ($jobInfo['is_deleted'] == 1 || empty($comInfo) || empty($jobInfo)) {
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



                $jobBright = $jobInfo['jobbright'];
                if ($jobBright) {
                        $jobBright = explode("|||", $jobBright);
                }



                $this->assign("comInfo", $comInfo);
                $this->assign("jobBright", $jobBright);

                $this->assign("comInfo", $comInfo);
                $this->assign("jobInfo", $jobInfo);
                $this->display("Company/new_view_job");
        }

        //增加推荐费用
        public function addTariff() {
                $jobId = intval($_POST['jobId']);
                $TariffValue = intval($_POST['TariffValue'] * 100);
                $sTariffValue = M("job")->where("id={$jobId}")->getField("Tariff");
                if (!$sTariffValue) {
                        echo json_encode(array("code" => 500, "msg" => "参数错误，请联系系统管理员！"));
                        exit();
                } else {
                        if ($sTariffValue > $TariffValue) {
                                echo json_encode(array("code" => 500, "msg" => "招聘费只能增加不能减少哦！"));
                                exit();
                        }
                        M("job")->where("id={$jobId}")->save(array("Tariff" => $TariffValue));
                        echo json_encode(array("code" => 200, "msg" => "增加成功！"));
                        exit();
                }
        }

        function create_guid() {
                $microTime = microtime();
                list($a_dec, $a_sec) = explode(" ", $microTime);
                $dec_hex = dechex($a_dec * 1000000);
                $sec_hex = dechex($a_sec);
                $this->ensure_length($dec_hex, 5);
                $this->ensure_length($sec_hex, 6);
                $guid = "";
                $guid .= $dec_hex;
                $guid .= $this->create_guid_section(3);
                $guid .= '-';
                $guid .= $this->create_guid_section(4);
                $guid .= '-';
                $guid .= $this->create_guid_section(4);
                $guid .= '-';
                $guid .= $this->create_guid_section(4);
                $guid .= '-';
                $guid .= $sec_hex;
                $guid .= $this->create_guid_section(6);
                return $guid;
        }

        function ensure_length(&$string, $length) {
                $strlen = strlen($string);
                if ($strlen < $length) {
                        $string = str_pad($string, $length, "0");
                } else if ($strlen > $length) {
                        $string = substr($string, 0, $length);
                }
        }

        function create_guid_section($characters) {
                $return = "";
                for ($i = 0; $i < $characters; $i++) {
                        $return .= dechex(mt_rand(0, 15));
                }
                return $return;
        }

        public function download() {
                //推荐记录id
                $id = intval($_GET['id']) > 0 ? intval($_GET['id']) : 0;
                //招聘信息id
                $jid = intval($_GET['jid']) > 0 ? intval($_GET['jid']) : 0;
                //推荐人id
                $btid = intval($_GET['btid']) > 0 ? intval($_GET['btid']) : 0;
                //推荐记录信息
                if ($id == 0 || $jid == 0 || $btid == 0) {
                        $this->error("您访问的页面不存在，到<a href='http://www.renrenlie.com'>首页</a>去！", U('Index/index'));
                        exit();
                }
                $recordInfo = M("record")->where("id={$id} and j_id={$jid} and bt_id={$btid}")->find();
                if (empty($recordInfo)) {
                        $this->error("您访问的页面不存在，到<a href='http://www.renrenlie.com'>首页</a>去！", U('Index/index'));
                        exit();
                }
                //简历信息
                $resumeInfo = M("resume")->where("id='$btid'")->find();

                $resumeInfo['sex'] = (($resumeInfo['sex'] == 0) ? "男" : "女");
                $resumeInfo['stage'] = M("cascadedata")->where("datavalue='$resumeInfo[state]' and datagroup='zzstart'")->getField("dataname");
                $resumeInfo['workexper'] = M("workexper")->where("keyid='$resumeInfo[keyid]'")->getField("intro");
                //教育经历

                $educat_list = M("education")->where("keyid='$resumeInfo[keyid]'")->order("id desc")->find();
                $resumeInfo['education'] = $educat_list['content'];
                //var_dump($resumeInfo);
                $wordStr = $resumeInfo['username'] . "_" . date("ymd");
                $fileName = iconv("utf-8", "GBK", $wordStr);

                header("Cache-Control: no-cache, must-revalidate");
                header("Pragma: no-cache");

                header("Content-Type: application/doc");
                header("Content-Disposition: attachment; filename=" . $fileName . ".doc");
                /* */
                $wordHtml .= "<table style='border:1px #ffffff solid;margin-left:1px;margin-right:1px' cellspacing='0px' cellpadding='0px'>";
                $wordHtml .= "<tr style='border:1px #ffffff solid;'><td  style='border:1px #ffffff solid;' colspan=3><center><h2>简  历</h2></center></td></tr>";
                $wordHtml .= "<tr style='border:1px #ffffff solid;'><td  style='border:1px #ffffff solid;' colspan=3><h3>基本信息</h3></td></tr>";
                $wordHtml .= "<tr style='border:1px #ffffff solid'><td  style='border:1px #ffffff solid' width=50px>姓名：" . $resumeInfo['username'] . "&nbsp;&nbsp;&nbsp;性别：" . $resumeInfo['sex'] . "&nbsp;&nbsp;&nbsp;年龄：" . $resumeInfo['age'] . "</td></tr>";
                $wordHtml .= "<tr style='border:1px #ffffff solid;line-height:30px'><td  style='border:1px #ffffff solid'  colspan=3>在职状态：" . $resumeInfo['stage'] . "</td></tr>";
                $wordHtml .= "<tr style='border:1px #ffffff solid;line-height:30px'><td  style='border:1px #ffffff solid'  colspan=3>联系电话：" . $resumeInfo['mobile'] . "</td></tr>";
                $wordHtml .= "<tr style='border:1px #ffffff solid;line-height:30px'><td  style='border:1px #ffffff solid'  colspan=3>邮&nbsp;&nbsp;箱：" . $resumeInfo['email'] . "</td></tr>";
                $wordHtml .= "<tr style='border:1px #ffffff solid;line-height:30px'><td  style='border:1px #ffffff solid'  colspan=3>Q&nbsp;&nbsp;&nbsp;Q：" . $resumeInfo['qqnum'] . "</td></tr>";
                $wordHtml .= "<tr style='border:1px #ffffff solid;line-height:20px'><td  style='border:1px #ffffff solid' ><hr width='2px' color='#b5b5b5'></td></tr>";
                if ($resumeInfo['personal']) {
                        $wordHtml .= "<tr style='border:1px #ffffff solid;line-height:30px'><td  colspan=3 style='border:1px #ffffff solid;'><h3>自我评价</h3></td></tr>";
                        $wordHtml .= "<tr style='border:1px #ffffff solid'><td  colspan=3 style='border:1px #ffffff solid'>" . $resumeInfo['personal'] . "</td></tr>";
                }
                $wordHtml .= "<tr style='border:1px #ffffff solid;line-height:30px'><td style='border:1px #ffffff solid;font-size:18px;'<hr width='2px' color='#b5b5b5'></td></tr>";
                if ($resumeInfo['education']) {
                        $wordHtml .= "<tr style='border:1px #ffffff solid;line-height:30px'><td  style='border:1px #ffffff solid;' colspan=3><h3>教育经历</h3></td></tr>";
                        $wordHtml .= "<tr style='border:1px #ffffff solid;line-height:30px'><td style='border:1px #ffffff solid' colspan=3>" . $resumeInfo['education'] . "</td></tr>";
                }
                $wordHtml .= "<tr style='border:1px #ffffff solid;line-height:30px'><td style='border:1px #ffffff solid;font-size:18px;'<hr width='2px' color='#b5b5b5'></td></tr>";
                if ($resumeInfo['workexper']) {
                        $wordHtml .= "<tr style='border:1px #ffffff solid;line-height:30px'><td  style='border:1px #ffffff solid;' colspan=3><h3>工作经历</h3></td></tr>";
                        $wordHtml .= "<tr style='border:1px #ffffff solid;line-height:30px'><td style='border:1px #ffffff solid' colspan=3>" . $resumeInfo['workexper'] . "</td></tr>";
                }

                $wordHtml .= "<tr style='border:1px #ffffff solid;line-height:30px'><td style='border:1px #ffffff solid'><hr width='2px' color='#b5b5b5'></td></tr>";
                if ($resumeInfo['because']) {
                        $wordHtml .= "<tr style='border:1px #ffffff solid;line-height:30px'><td style='border:1px #ffffff solid;' colspan=3><h3>推荐理由</h3></td></tr>";
                        $wordHtml .= "<tr style='border:1px #ffffff solid;line-height:30px'><td style='border:1px #ffffff solid' colspan=3>" . $resumeInfo['because'] . "</td></tr>";
                }
                /*

                  $wordHtml .= '<h2 style="font-size:20px; height:30px; font-weight:bold; line-height:30px; font-family:\'微软雅黑\'">基本信息</h2>';
                  $wordHtml.='<p style="font-size:16px; height:30px; line-height:30px; margin:10px 0; font-family:\'微软雅黑\'">姓名：' . $resumeInfo[username] . '<span style="padding-left:230px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;性别：' . $resumeInfo[sex] . '</span><span style="padding-left:30px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;年龄：' . $resumeInfo[age] . '</span></p>';
                  $wordHtml.='<p style="font-size:16px; height:30px; line-height:30px; margin:10px 0; font-family:\'微软雅黑\'">在职状态：' . $resumeInfo[stage] . '</p>';
                  $wordHtml.='<p style="font-size:16px; height:30px; line-height:30px; margin:10px 0; font-family:\'微软雅黑\'">联系电话：' . $resumeInfo[mobile] . '</p>';
                  $wordHtml.='<p style="font-size:16px; height:30px; line-height:30px; margin:10px 0; font-family:\'微软雅黑\'">邮箱：' . $resumeInfo[email] . '</p>';
                  $wordHtml.='<p style="font-size:16px; height:30px; line-height:30px; margin:10px 0; font-family:\'微软雅黑\'">QQ：' . $resumeInfo[qqnum] . '</p>';
                  if ($resumeInfo['personal'])
                  {
                  $wordHtml .= '<h2 style="font-size:20px; height:30px; font-weight:bold; line-height:30px; font-family:\'微软雅黑\'">自我评价</h2>';
                  $wordHtml .= '<div style="font-size:16px;width:1400px; line-height:30px; margin:10px 0; font-family:\'微软雅黑\'">' . $resumeInfo['personal'] . "</div>";
                  }
                  if ($resumeInfo['education'])
                  {
                  $wordHtml .= '<h2 style="font-size:20px; height:30px; font-weight:bold; line-height:30px; font-family:\'微软雅黑\'">教育经历</h2>';
                  $wordHtml .= '<div style="font-size:16px;width: 1400px;  line-height:30px; margin:10px 0; font-family:\'微软雅黑\'">' . $resumeInfo['education'] . "</div>";
                  }
                  if ($resumeInfo['because'])
                  {
                  $wordHtml .= '<h2 style="font-size:20px; height:30px; font-weight:bold; line-height:30px; font-family:\'微软雅黑\'">推荐理由</h2>';
                  $wordHtml .= '<div style="font-size:16px;width: 1400px;  line-height:30px; margin:10px 0; font-family:\'微软雅黑\'">' . $resumeInfo['because'] . "</div>";
                  }
                 */
                echo $wordHtml;
        }

        function cword($data, $fileName = '') {
                if (empty($data))
                        return '';
                $data = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word" xmlns="http://www.w3.org/TR/REC-html40">' . $data . '</html>';
                $dir = "/Uploads/word/";
                if (!file_exists($dir))
                        mkdir($dir, 777, true);
                if (empty($fileName)) {

                        $fileName = $dir . date('His') . '.doc';
                } else {

                        $fileName = $dir . $fileName . '.doc';
                }

                $writefile = fopen($fileName, 'wb') or die("创建文件失败"); //wb以二进制写入
                fwrite($writefile, $data);
                fclose($writefile);
                return $fileName;
        }

        //修改已验证的手机号
        public function changeTelephoneStep1() {
                if($_POST['hash'] != md5("rrl_".$_SESSION['cookie'])){
                        return;
                }
               
                $username = $_SESSION['cusername'];

                if (!$username) {
                        echo json_encode(array("code" => 500, "msg" => "用户身份验证失败，请重新登陆后再试！"));
                        exit();
                }
                $telephone = M("company")->where("username='$username'")->getField("mobile");
                if (!$telephone) {
                        echo json_encode(array("code" => 500, "msg" => "系统繁忙，请稍候再试！"));
                        exit();
                }
                $code = getCode();

                if (!$_SESSION['leveltime']) {

                        $content = "您的短信验证码为" . $code . "，此验证码10分钟后过期，如非本人操作请忽略此条信息。若有疑问请咨询010-57188076。";

                        $result = smsChannel($telephone, $content, 0, "changeMobileCode", "企业验证手机验证码");
                        if ($result['code'] == "200") {

                                $retCode = array("code" => 200, "msg" => "发送成功");
                                $_SESSION['leveltime'] = time();
                                $_SESSION['changeMobile_' . $telephone] = $code;
                        } else {

                                $logData['msg'] = $result;
                                $retCode = array("code" => 500, "msg" => "系统繁忙");
                        }

                        echo json_encode($retCode);
                        exit();
                } elseif ((time() - $_SESSION['leveltime']) < 10 * 60 && $_SESSION['changeMobile_' . $telephone]) {
                        echo json_encode(array("code" => 200, "smg" => "发送成功"));
                } else {

                        $content = "您的短信验证码为" . $code . "，此验证码10分钟后过期，如非本人操作请忽略此条信息。若有疑问请咨询010-57188076。";
                        $result = smsChannel($telephone, $content, 0, "changeMobileCode", "企业验证手机验证码");
                        if ($result[code] == "200") {

                                $retCode = array("code" => 200, "msg" => "发送成功");
                                $_SESSION['leveltime'] = time();
                                $_SESSION['changeMobile_' . $telephone] = $code;
                        } else {

                                $logData['msg'] = $result;
                                $retCode = array("code" => 500, "msg" => "系统繁忙");
                        }
                        echo json_encode($retCode);
                        exit();
                }
        }

        //修改手机验证短信验证码第一步
        public function changeTelephoneCheckStep1() {
                $code = $_POST['change_telehone_ccode_step1'];
                $username = $_SESSION['cusername'];
                if (!$username) {
                        echo json_encode(array("code" => 500, "msg" => "用户身份验证失败，请重新登陆后再试！"));
                        exit();
                }
                $telephone = M("company")->where("username='$username'")->getField("mobile");
                if (!$telephone) {
                        echo json_encode(array("code" => 500, "msg" => "系统繁忙，请稍候再试！"));
                        exit();
                }

                if ($_SESSION['changeMobile_' . $telephone] == $code) {
                        $_SESSION['change_telephone_step'] = "finish";
                        unset($_SESSION['changeMobile_' . $telephone]);
                        echo json_encode(array("code" => 200, "msg" => "成功"));
                        exit();
                } else {
                        echo json_encode(array("code" => 500, "msg" => "验证码输入有误，请重新输入"));
                        exit();
                }
        }

        //修改已验证的手机号
        public function changeTelephoneStep2() {
                if($_POST['hash'] != md5("rrl_".$_SESSION['cookie'])){
                        return;
                }
                
                $username = $_SESSION['cusername'];

                if (!$username) {
                        echo json_encode(array("code" => 500, "msg" => "用户身份验证失败，请重新登陆后再试！"));
                        exit();
                }
                $telephone = $_POST['telephone'];
                if (!$telephone) {
                        echo json_encode(array("code" => 500, "msg" => "系统繁忙，请稍候再试！"));
                        exit();
                }
                $isExit = M("company")->where("mobile='$telephone'")->find();
                if ($isExit) {
                        echo json_encode(array("code" => 500, "msg" => "此手机号码号已经存在，请重新输入！"));
                        exit();
                }
                $code = getCode();

                if (!$_SESSION['leveltime2']) {

                        $content = "您的短信验证码为" . $code . "，此验证码10分钟后过期，如非本人操作请忽略此条信息。若有疑问请咨询010-57188076。";

                        $result = smsChannel($telephone, $content, 0, "changeMobileCode2", "企业验证手机验证码第二步");
                        if ($result['code'] == "200") {

                                $retCode = array("code" => 200, "msg" => "发送成功");
                                $_SESSION['leveltime2'] = time();
                                $_SESSION['changeMobile2_' . $telephone] = $code;
                        } else {

                                $logData['msg'] = $result;
                                $retCode = array("code" => 500, "msg" => "系统繁忙");
                        }

                        echo json_encode($retCode);
                        exit();
                } elseif ((time() - $_SESSION['leveltime2']) < 10 * 60 && $_SESSION['changeMobile2_' . $telephone]) {
                        echo json_encode(array("code" => 200, "smg" => "发送成功"));
                } else {

                        $content = "您的短信验证码为" . $code . "，此验证码10分钟后过期，如非本人操作请忽略此条信息。若有疑问请咨询010-57188076。";
                        $result = smsChannel($telephone, $content, 0, "changeMobileCode2", "企业验证手机验证码第二步");
                        if ($result[code] == "200") {

                                $retCode = array("code" => 200, "msg" => "发送成功");
                                $_SESSION['leveltime2'] = time();
                                $_SESSION['changeMobile2_' . $telephone] = $code;
                        } else {

                                $logData['msg'] = $result;
                                $retCode = array("code" => 500, "msg" => "系统繁忙");
                        }
                        echo json_encode($retCode);
                        exit();
                }
        }

        //修改手机验证短信验证码第二步
        public function changeTelephoneCheckStep2() {
                $code = $_POST['change_telehone_ccode_step2'];
                $username = $_SESSION['cusername'];
                if (!$username) {
                        echo json_encode(array("code" => 500, "msg" => "用户身份验证失败，请重新登陆后再试！"));
                        exit();
                }
                $telephone = $_POST['change_telehone_telephone_step2'];
                if (!$telephone) {
                        echo json_encode(array("code" => 500, "msg" => "系统繁忙，请稍候再试！"));
                        exit();
                }

                if ($_SESSION['changeMobile2_' . $telephone] == $code) {
                        $_SESSION['change_telephone_step2'] = "finish";
                        unset($_SESSION['changeMobile2_' . $telephone]);
                        M("company")->where("username='$username'")->save(array("mobile" => $telephone));
                        echo json_encode(array("code" => 200, "msg" => "成功"));
                        exit();
                } else {
                        echo json_encode(array("code" => 500, "msg" => "验证码输入有误，请重新输入"));
                        exit();
                }
        }

//修改已验证的手机号
        public function checktelephonecode() {
                if($_POST['hash'] != md5("rrl_".$_SESSION['cookie'])){
                        return;
                }
                
                $username = $_SESSION['cusername'];

                if (!$username) {
                        echo json_encode(array("code" => 500, "msg" => "用户身份验证失败，请重新登陆后再试！"));
                        exit();
                }
                $telephone = $_POST['mobile'];
                if (!$telephone) {
                        echo json_encode(array("code" => 500, "msg" => "系统繁忙，请稍候再试！"));
                        exit();
                }
                $isExit = M("company")->where("mobile='$telephone'")->find();
                if ($isExit) {
                        echo json_encode(array("code" => 500, "msg" => "此手机号码号已经存在，请重新输入！"));
                        exit();
                }
                $code = getCode();

                if (!$_SESSION['leveltime3']) {

                        $content = "您的短信验证码为" . $code . "，此验证码10分钟后过期，如非本人操作请忽略此条信息。若有疑问请咨询010-57188076。";

                        $result = smsChannel($telephone, $content, 0, "checkMobileCode", "企业验证手机正确性");
                        if ($result['code'] == "200") {

                                $retCode = array("code" => 200, "msg" => "发送成功");
                                $_SESSION['leveltime3'] = time();
                                $_SESSION['changeMobile3_' . $telephone] = $code;
                        } else {

                                $logData['msg'] = $result;
                                $retCode = array("code" => 500, "msg" => "系统繁忙");
                        }

                        echo json_encode($retCode);
                        exit();
                } elseif ((time() - $_SESSION['leveltime3']) < 10 * 60 && $_SESSION['changeMobile3_' . $telephone]) {
                        echo json_encode(array("code" => 200, "smg" => "发送成功"));
                } else {

                        $content = "您的短信验证码为" . $code . "，此验证码10分钟后过期，如非本人操作请忽略此条信息。若有疑问请咨询010-57188076。";
                        $result = smsChannel($telephone, $content, 0, "checkMobileCode", "企业验证手机正确性");
                        if ($result[code] == "200") {

                                $retCode = array("code" => 200, "msg" => "发送成功");
                                $_SESSION['leveltime3'] = time();
                                $_SESSION['changeMobile3_' . $telephone] = $code;
                        } else {

                                $logData['msg'] = $result;
                                $retCode = array("code" => 500, "msg" => "系统繁忙");
                        }
                        echo json_encode($retCode);
                        exit();
                }
        }

        public function changeTelephoneCheckStep3() {
                $code = $_POST['code'];
                $username = $_SESSION['cusername'];
                if (!$username) {
                        echo json_encode(array("code" => 500, "msg" => "用户身份验证失败，请重新登陆后再试！"));
                        exit();
                }
                $telephone = $_POST['mobile'];
                if (!$telephone) {
                        echo json_encode(array("code" => 500, "msg" => "系统繁忙，请稍候再试！"));
                        exit();
                }

                if ($_SESSION['changeMobile3_' . $telephone] == $code) {
                        $_SESSION['change_telephone_step3'] = "finish";
                        unset($_SESSION['changeMobile3_' . $telephone]);
                        M("company")->where("username='$username'")->save(array("mobile" => $telephone));
                        echo json_encode(array("code" => 200, "msg" => "成功"));
                        exit();
                } else {
                        echo json_encode(array("code" => 500, "msg" => "验证码输入有误，请重新输入"));
                        exit();
                }
        }

        public function changeUserEmail() {
                $email = trim($_POST['email']);
                $username = $_SESSION['cusername'];
                $isExit = M("company")->where("username !='$username' and email='$email'")->find();
                if ($isExit) {
                        echo json_encode(array("code" => 500, "msg" => "您输入的邮箱已经存在于系统中，请重新输入"));
                        exit();
                } else {
                        $isExit = M("member")->where("email='$email'")->find();
                        if ($isExit) {
                                echo json_encode(array("code" => 500, "msg" => "您输入的邮箱已经存在于系统中，请重新输入"));
                                exit();
                        } else {
                                echo json_encode(array("code" => 200, "msg" => "ok"));
                                exit();
                        }
                }
        }

        //签订合同
        public function SignContract() {
                $arCompanyInfo = $this->getCompanyInfo();
                $this->assign("first_class", 2);
                $this->assign("arCompanyInfo", $arCompanyInfo);

                $this->display("new_sign_contract");
        }

        public function changePassword() {
                $username = $_SESSION['cusername'];
                if (!$username) {
                        echo json_encode(array("code" => 500, "msg" => "您长时间未操作，已登录超时，若想继续操作，请重新登录！"));
                        exit();
                }

                $data['opassword'] = md5(md5(I("opassword")));
                $newdata['password'] = md5(md5(I("password")));
                $newdata['pwd'] = I('password');
                $userinfo = M("company")->where("username='$username' and password='" . $data['opassword'] . "'")->find();
                if (empty($userinfo)) {
                        echo json_encode(array("code" => 500, "msg" => "您输入的旧密码有误，请重新输入！"));
                        exit();
                }
                M("company")->where("username='$username'")->save($newdata);

                M("userinfo")->where("username='$username' and flag=0")->save(array("password" => $newdata['password']));

                echo json_encode(array("code" => 200, "msg" => "恭喜您，修改成功！"));
                exit();
        }

        public function SaveSignContract() {
                $data['username'] = $_SESSION['cusername'];

                if ($_POST['uploadFiletext']) {
                        $data['contract'] = $_POST['uploadFiletext'];
                        $res = M('company')->where("username='" . $data['username'] . "'")->save($data);
                }
                header("Location:/Home/Company/SignContract.html");
        }

}
