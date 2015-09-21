<?php

namespace Home\Controller;

use Think\Controller;
use Think\Upload;

header("Content-type: text/html; charset=utf-8");

class LoginController extends Controller {

        static private $_size = 10;

        public function __construct() {
                if (is_weixin() === true) {
                        header('Location: http://m.renrenlie.com/');
                }
                parent::__construct();
                //获取友情链接
                $linkArr = M("friendlink")->where("status=0")->order("orderid desc,id asc")->select();
                $this->assign("linkArr", $linkArr);
                import('ORG.Util.Page');

                $username = $_SESSION['username'];
                $userinfo = M('member')->where("username='" . $username . "'")->select();
                $this->userinfo = $userinfo;


                if (!empty($_SESSION['username']) || !empty($_SESSION['cusername'])) {
                        $username = ($_SESSION['username'] ? $_SESSION['username'] : $_SESSION['cusername']);
                        $decide = M('userinfo')->where("username='" . $username . "'")->select();
                        if (!empty($decide)) {
                                $table = array();
                                foreach ($decide as $key => $val) {
                                        $table = $decide[$key];
                                }
                                if ($table["flag"] == "0") {
                                        $uid = $userinfo[0]['id'];
                                        $leftNavCompleted = array();
                                        //判断基本资料是否填写完整
                                        if (isset($userinfo[0]['cnname']) && isset($userinfo[0]['sex']) && isset($userinfo[0]['age']) && isset($userinfo[0]['mobile']) && isset($userinfo[0]['email']))
                                                $leftNavCompleted['userinfo_completed'] = true;
                                        else
                                                $leftNavCompleted['userinfo_completed'] = false;

                                        //判断简历库是否有数据
                                        $isResume = M("resume")->where("t_id=" . $uid)->find();
                                        if (!empty($isResume))
                                                $leftNavCompleted['resume_completed'] = true;
                                        else
                                                $leftNavCompleted['resume_completed'] = false;
                                        //判断是否有推荐职位
                                        $isRecord = M("record")->where("t_id=" . $uid)->find();
                                        if (!empty($isRecord))
                                                $leftNavCompleted['record_completed'] = true;
                                        else
                                                $leftNavCompleted['record_completed'] = false;
                                        $isMoney = M("account")->where("username='" . $username . "'")->find();
                                        if (!empty($isMoney))
                                                $leftNavCompleted['money_completed'] = true;
                                        else
                                                $leftNavCompleted['money_completed'] = false;
                                        $this->assign("leftNavCompleted", $leftNavCompleted);
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
                } else {
                        $this->error("您长时间未操作，已登录超时，若想继续操作，请重新登录！", U('Index/index'));
                }
        }

        /*
         * 推荐人登陆后的总览页面
         */

        public function index() {
                
                $userInfo = $this->userinfo[0];

                //是否验证手机号
                if ($userInfo['mobile']) {
                        $Info['is_mobile'] = true;
                        //是否完善资料
                        if ($userInfo['cnname'] && $userInfo['email']) {
                                $Info['userinfo_completed'] = true;
                        } else {
                                $Info['userinfo_completed'] = false;
                        }
                } else {
                        $Info['is_mobile'] = false;
                        $Info['userinfo_completed'] = false;
                }

                //用户已经注册天数
                $regTime = intval((time() - $userInfo['regtime']) / (24 * 3600));

                //简历数量
                $resumeCount = M("resume")->where("t_id=" . $userInfo['id']." and isshow=1")->count();

                //是否上传过简历
                if ($resumeCount == 0) {
                        $Info['is_resume'] = false;
                } else {
                        $Info['is_resume'] = true;
                }

                //推荐次数
                $arRecord = M("record")->where("t_id=" . $userInfo['id'])->select();
                $recordCount = count($arRecord);

                //是否推荐过候选人
                if ($recordCount == 0) {
                        $Info['is_record'] = false;
                } else {
                        $Info['is_record'] = true;
                }
                //累计收益（只要面试通过就算）
                $feeCount = intval(M("account")->where("uid=".$userInfo['id'])->getField("account"));
               
                //正在面试中(已入职以前的面试状态且已经审核通过)
                $isAudstartCount = 0;

                //进入代付款状态的候选人数量（已入职且付款状态为待付款）
                $isSinkCount = 0;

                foreach ($arRecord as $v) {
                        if ($v['audstart'] == 6 && $v['sink'] = 1) {
                              
                               $isSinkCount++;
                        }
                        if (($v['audstart'] == 1 or $v['audstart'] == 3 or  $v['audstart']==5)  and $v['checkinfo'] == "true") {
                                $isAudstartCount ++;
                        }
                }
             
                $this->assign("Info", $Info);
                $this->assign("isSinkCount", $isSinkCount);
                $this->assign("isAudstartCount", $isAudstartCount);
                $this->assign("feeCount", $feeCount);
                $this->assign("recordCount", $recordCount);
                $this->assign("resumeCount", $resumeCount);
                $this->assign("regTime", $regTime);
                $this->assign("arUser", $userInfo);
                $this->display();
        }

        public function getIndexContent() {
                //$arJobList = M("job")->where("checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0")->order("orderid asc, starttime desc")->limit(0, 18)->select();
                $sql = "select * from stj_job where stj_job.employ>(select count(*) from stj_record where stj_record.j_id = stj_job.id and audstart=6) and checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0 order by orderid ASC,checktime DESC, starttime DESC limit 0,18";
                $arJobList = M("job")->query($sql);
                foreach ($arJobList as $key => &$val) {
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
                        $company = M("company")->where("id='$val[cpid]'")->find();

                        $val['cpname'] = $company["cpname"];

                        if ($company['thumlogo']) {
                                $val['thumlogo'] = $company["thumlogo"];
                        } else {
                                $val['thumlogo'] = "/Public/img/defoultLogo.png";
                        }
                        $val['record_num'] = M("record")->where("j_id=" . $val['id']);
                        $val['experience'] = M("cascadedata")->where("datagroup='experience' and datavalue='$val[experience]'")->getField("dataname");
                        $val['jobplace'] = M("casclist")->where("id='$val[jobplace]'")->getField("cascname");
                }

                $arCompany = array_chunk($arJobList, 10);
                return $arCompany;
        }

        //用户中心首页
        public function userinfo() {
                $username = $_SESSION['username'];
                $userinfo = M('member')->where("username='" . $username . "'")->find();
                $userinfo['sex'] = ($userinfo['sex'] == 1 ? "女" : "男");

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
                //擅长职位
                if (!empty($userinfo['Jobcate'])) {
                        $jobcat = explode('+', $userinfo['Jobcate']);
                        $Jobcate = '';
                        foreach ($jobcat as $v) {
                                $Jobcate .= getCscData($v) . '+';
                        }
                        $Jobcate = substr($Jobcate, 0, -1);
                } else {
                        $Jobcate = "选择职位";
                }
                $userinfo['Jobcate_data'] = $Jobcate;

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

                if ($userinfo['token_exptime']) {
                        $userinfo['date'] = "至" . date("Y-m-d", $userinfo['token_exptime']) . "止";
                        $userinfo['maxdate'] = date("Y-m-d", $userinfo['token_exptime']);
                }


                $arCompanyInfo = M("casclist")->where("cascname='熟悉公司'")->find();
                $arPostionInfo = M("casclist")->where("cascname='熟悉职位'")->find();
                $arAreaInfo = M("casclist")->where("cascname='擅长领域'")->find();


                if ($arCompanyInfo) {
                        $arCompanyList = M("casclist")->where("parentid='$arCompanyInfo[id]'")->select();
                }
                if ($arPostionInfo) {
                        $arPostionList = M("casclist")->where("parentid='$arPostionInfo[id]'")->select();
                }
                if ($arAreaInfo) {
                        $arAreaList = M("casclist")->where("parentid='$arAreaInfo[id]'")->select();
                }

                $link_companys = array();
                if ($userinfo['link_companys']) {
                        $link_companys_tmp = explode("|||", $userinfo['link_companys']);
                        foreach ($link_companys_tmp as $value) {
                                if ($value) {
                                        array_push($link_companys, $value);
                                }
                        }
                }
                $link_postions = array();
                if ($userinfo['link_postions']) {
                        $link_postions_tmp = explode("|||", $userinfo['link_postions']);
                        foreach ($link_postions_tmp as $value) {
                                if ($value) {
                                        array_push($link_postions, $value);
                                }
                        }
                }
                $link_areas = array();
                if ($userinfo['link_areas']) {
                        $link_areas_tmp = explode("|||", $userinfo['link_areas']);
                        foreach ($link_areas_tmp as $value) {
                                if ($value) {
                                        array_push($link_areas, $value);
                                }
                        }
                }

                $this->assign("link_companys", $link_companys);
                $this->assign("link_postions", $link_postions);
                $this->assign("link_areas", $link_areas);

                $this->assign("arCompanyList", $arCompanyList);
                $this->assign("arPostionList", $arPostionList);
                $this->assign("arAreaList", $arAreaList);


                $userinfo['area_data'] = $area;
                $this->assign("arArea", $arArea);
                $this->assign("arJobcate", $arJobcate);
                $this->assign("arStrycate", $arStrycate);
                $this->userinfo = $userinfo;
                $this->assign("first_class", 1);
                $this->assign("second_class", 1);
                $this->display('Login/new_userinfo');
                //     $this->display();
        }

        //判断用户修改手机号的类型
        public function checkMobileType() {
                $username = $_SESSION['username'];
                $mobile = trim($_POST['mobile']);
                $isExit = M("member")->where("username='$username'")->find();
                //如果已经存在系统则是更换手机号码
                if (!empty($isExit)) {
                        if (isset($isExit['mobile']) && $isExit['mobile']) {
                                echo json_encode(array("code" => 201, "mobile" => $isExit['mobile']));
                        } else {
                                echo json_encode(array("code" => 200, "mobile" => $mobile));
                        }
                } else {
                        echo json_encode(array("code" => 500, "msg" => "您长时间未操作，请退出后重试"));
                }
        }

        //修改已验证的手机号
        public function changeTelephoneStep1() {
                $username = $_SESSION['username'];

                if (!$username) {
                        echo json_encode(array("code" => 500, "msg" => "用户身份验证失败，请重新登陆后再试！"));
                        exit();
                }
                $telephone = M("member")->where("username='$username'")->getField("mobile");
                if (!$telephone) {
                        echo json_encode(array("code" => 500, "msg" => "系统繁忙，请稍候再试！"));
                        exit();
                }
                $code = getCode();

                if (!$_SESSION['leveltime']) {

                        $content = "您的短信验证码为" . $code . "，此验证码10分钟后过期，如非本人操作请忽略此条信息。若有疑问请咨询010-57188076。";

                        $result = sendMessageNew($telephone, $content, 0, "changeMobileCode", "推荐人验证手机验证码");
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
                } elseif ((time() - $_SESSION['leveltime']) < 1 * 60 && $_SESSION['changeMobile_' . $telephone]) {
                        echo json_encode(array("code" => 200, "smg" => "发送成功"));
                } else {

                        $content = "您的短信验证码为" . $code . "，此验证码10分钟后过期，如非本人操作请忽略此条信息。若有疑问请咨询010-57188076。";
                        $result = sendMessageNew($telephone, $content, 0, "changeMobileCode", "推荐人验证手机验证码");
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
                $username = $_SESSION['username'];
                if (!$username) {
                        echo json_encode(array("code" => 500, "msg" => "用户身份验证失败，请重新登陆后再试！"));
                        exit();
                }
                $telephone = M("member")->where("username='$username'")->getField("mobile");
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
                $username = $_SESSION['username'];

                if (!$username) {
                        echo json_encode(array("code" => 500, "msg" => "用户身份验证失败，请重新登陆后再试！"));
                        exit();
                }
                $telephone = $_POST['telephone'];
                if (!$telephone) {
                        echo json_encode(array("code" => 500, "msg" => "系统繁忙，请稍候再试！"));
                        exit();
                }
                $isExit = M("member")->where("mobile='$telephone'")->find();
                if ($isExit) {
                        echo json_encode(array("code" => 500, "msg" => "此手机号码号已经存在，请重新输入！"));
                        exit();
                }
                $code = getCode();

                if (!$_SESSION['leveltime2']) {

                        $content = "您的短信验证码为" . $code . "，此验证码10分钟后过期，如非本人操作请忽略此条信息。若有疑问请咨询010-57188076。";

                        $result = sendMessageNew($telephone, $content, 0, "changeMobileCode2", "推荐人验证手机验证码第二步");
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
                } elseif ((time() - $_SESSION['leveltime2']) < 1 * 60 && $_SESSION['changeMobile2_' . $telephone]) {
                        echo json_encode(array("code" => 200, "smg" => "发送成功"));
                } else {

                        $content = "您的短信验证码为" . $code . "，此验证码10分钟后过期，如非本人操作请忽略此条信息。若有疑问请咨询010-57188076。";
                        $result = sendMessageNew($telephone, $content, 0, "changeMobileCode2", "推荐人验证手机验证码第二步");
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
                $username = $_SESSION['username'];

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
                        M("member")->where("username='$username'")->save(array("mobile" => $telephone));
                        echo json_encode(array("code" => 200, "msg" => "成功"));
                        exit();
                } else {
                        echo json_encode(array("code" => 500, "msg" => "验证码输入有误，请重新输入"));
                        exit();
                }
        }

//修改已验证的手机号
        public function checktelephonecode() {
                $username = $_SESSION['username'];

                if (!$username) {
                        echo json_encode(array("code" => 500, "msg" => "用户身份验证失败，请重新登陆后再试！"));
                        exit();
                }
                $telephone = $_POST['mobile'];
                if (!$telephone) {
                        echo json_encode(array("code" => 500, "msg" => "系统繁忙，请稍候再试！"));
                        exit();
                }
                $isExit = M("member")->where("mobile='$telephone'")->find();
                if ($isExit) {
                        echo json_encode(array("code" => 500, "msg" => "此手机号码号已经存在，请重新输入！"));
                        exit();
                }
                $code = getCode();

                if (!$_SESSION['leveltime3']) {

                        $content = "您的短信验证码为" . $code . "，此验证码10分钟后过期，如非本人操作请忽略此条信息。若有疑问请咨询010-57188076。";

                        $result = sendMessageNew($telephone, $content, 0, "checkMobileCode", "推荐人验证手机正确性");
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
                } elseif ((time() - $_SESSION['leveltime3']) < 1 * 60 && $_SESSION['changeMobile3_' . $telephone]) {
                        echo json_encode(array("code" => 200, "smg" => "发送成功"));
                } else {

                        $content = "您的短信验证码为" . $code . "，此验证码10分钟后过期，如非本人操作请忽略此条信息。若有疑问请咨询010-57188076。";
                        $result = sendMessageNew($telephone, $content, 0, "checkMobileCode", "推荐人验证手机正确性");
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
                $username = $_SESSION['username'];
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
                        M("member")->where("username='$username'")->save(array("mobile" => $telephone));
                        echo json_encode(array("code" => 200, "msg" => "成功"));
                        exit();
                } else {
                        echo json_encode(array("code" => 500, "msg" => "验证码输入有误，请重新输入"));
                        exit();
                }
        }

        //设置用户基本信息
        public function setUserBaseInfo() {
                $username = $_SESSION['username']; //用户名
                $data['cnname'] = I('cnname'); //真实姓名
                $data['sex'] = I('sex');      //性别
                $data['age'] = I('age');        //年龄
                $data['qqnum'] = I('qqnum');    //qq号
                $data['email'] = I('email');  // 邮箱
                $data['intro'] = $_POST['editor'];  //自我介绍
                $data['weixin'] = I("weixin");  //微信号码
                if ($_FILES) {
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
                        $this->uploader = new Upload($setting, 'Local');
                        $info = $this->uploader->upload($_FILES);

                        if ($info) {
                                $data['avatar'] = $setting['rootPath'] . $info['avatar']['savepath'] . $info['avatar']['savename'];
                                //这里可以输出一下结果,相对路径的键名是$info['upload']['filepath']  
                        }
                }
                M('member')->where("username='" . $username . "'")->save($data);
                header("Location:/Home/Login/userinfo.html");
        }

        //设置推荐设置
        public function setRecordSeting() {
                $username = $_SESSION['username']; //用户名
                $arRecordSetIng = array();
                $arRecordSetIng['strycate'] = trim($_POST['strycate']);
                $arRecordSetIng['Jobcate'] = trim($_POST['Jobcate']);
                $arRecordSetIng['area'] = trim($_POST['area']);
                $arRecordSetIng['token_exptime'] = strtotime(trim($_POST['recordSetingMaxdate']));
                $arRecordSetIng['link_companys'] = trim($_POST['companyListStr'], "|||");
                $arRecordSetIng['link_postions'] = trim($_POST['postionListStr'], "|||");
                $arRecordSetIng['link_areas'] = trim($_POST['areaListStr'], "|||");
                if (!$username) {
                        echo json_encode(array("code" => 500, "msg" => "用户身份验证失败，请重新登陆后再试！"));
                        exit();
                }
                M('member')->where("username='" . $username . "'")->save($arRecordSetIng);
                echo json_encode(array("code" => 200, "msg" => "ok"));
                exit();
        }

        public function getUserInfo() {
                $userinfo = M('member', 'stj_', 'DB_CONFIG1')->where("username='" . $_SESSION['username'] . "'")->find();
                echo json_encode($userinfo);
        }

        public function RecoSettings() {
                $userBaseInfo = M("member")->where("username='" . $_SESSION['username'] . "'")->find();

                //行业类别
                $hyData = M("casclist")->where("parentid=2")->order("orderid asc")->select();
                $zwData = M("casclist")->where("parentid=1")->order("orderid asc")->select();
                $dqData = M("casclist")->where("parentid=19")->order("orderid asc")->select();
                if ($userBaseInfo['strycate']) {
                        $casclist = M("casclist")->where("id='$userBaseInfo[strycate]'")->find();
                        $data = M("casclist")->where("id='$casclist[parentid]'")->find();
                        if ($data['cascname'] == "行业类别") {
                                $userBaseInfo['p_strycate'] = $casclist['cascname'];
                                $userBaseInfo['strycate'] = "请选择行业";
                                $userBaseInfo['strycate_id'] = $casclist['strycate'];
                        } else {

                                $userBaseInfo['p_strycate'] = $data['cascname'];
                                $userBaseInfo['strycate_id'] = $casclist['id'];
                                $userBaseInfo['strycate'] = $casclist['cascname'];
                        }
                        $userBaseInfo['strycatedata'] = $casclist['cascname'];
                } else {
                        $userBaseInfo['strycate_id'] = "请选择行业";
                        $userBaseInfo['strycate'] = "请选择行业";
                }

                if ($userBaseInfo['Jobcate']) {
                        $casclist = M("casclist")->where("id='$userBaseInfo[Jobcate]'")->find();
                        $data = M("casclist")->where("id='$casclist[parentid]'")->find();
                        if ($data['cascname'] == "职位类别") {
                                $userBaseInfo['p_Jobcate'] = $casclist['cascname'];
                                $userBaseInfo['Jobcate'] = "请选择行业";
                                $userBaseInfo['Jobcate_id'] = $casclist['Jobcate'];
                        } else {

                                $userBaseInfo['p_Jobcate'] = $data['cascname'];
                                $userBaseInfo['Jobcate_id'] = $casclist['id'];
                                $userBaseInfo['Jobcate'] = $casclist['cascname'];
                        }
                        $userBaseInfo['Jobcatedata'] = $casclist['cascname'];
                } else {
                        $userBaseInfo['Jobcate_id'] = "请选择职位";
                        $userBaseInfo['Jobcate'] = "请选择职位";
                }

                if ($userBaseInfo['area']) {
                        $casclist = M("casclist")->where("id='$userBaseInfo[area]'")->find();
                        $data = M("casclist")->where("id='$casclist[parentid]'")->find();
                        if ($data['cascname'] == "所在地区") {
                                $userBaseInfo['p_area'] = $casclist['cascname'];
                                $userBaseInfo['area'] = "请选择行业";
                                $userBaseInfo['area_id'] = $casclist['area'];
                        } else {

                                $userBaseInfo['p_area'] = $data['cascname'];
                                $userBaseInfo['area_id'] = $casclist['id'];
                                $userBaseInfo['area'] = $casclist['cascname'];
                        }
                        $userBaseInfo['areadata'] = $casclist['cascname'];
                } else {
                        $userBaseInfo['area_id'] = "请选择市";
                        $userBaseInfo['area'] = "请选择市";
                }

                if ($userBaseInfo['token_exptime']) {
                        $userBaseInfo['date'] = "至" . date("Y-m-d", $userBaseInfo['token_exptime']) . "止";
                        $userBaseInfo['maxdate'] = date("Y-m-d", $userBaseInfo['token_exptime']);
                } else {
                        $userBaseInfo['date'] = '';
                        $userBaseInfo['maxdate'] = date("Y-m-d", $userBaseInfo['token_exptime']);
                }

                $arCompanyInfo = M("casclist")->where("cascname='熟悉公司'")->find();
                $arPostionInfo = M("casclist")->where("cascname='熟悉职位'")->find();
                $arAreaInfo = M("casclist")->where("cascname='擅长领域'")->find();


                if ($arCompanyInfo) {
                        $arCompanyList = M("casclist")->where("parentid='$arCompanyInfo[id]'")->select();
                }
                if ($arPostionInfo) {
                        $arPostionList = M("casclist")->where("parentid='$arPostionInfo[id]'")->select();
                }
                if ($arAreaInfo) {
                        $arAreaList = M("casclist")->where("parentid='$arAreaInfo[id]'")->select();
                }

                $link_companys = array();
                if ($userBaseInfo['link_companys']) {
                        $link_companys_tmp = explode("|||", $userBaseInfo['link_companys']);
                        foreach ($link_companys_tmp as $value) {
                                if ($value) {
                                        array_push($link_companys, $value);
                                }
                        }
                }
                $link_postions = array();
                if ($userBaseInfo['link_postions']) {
                        $link_postions_tmp = explode("|||", $userBaseInfo['link_postions']);
                        foreach ($link_postions_tmp as $value) {
                                if ($value) {
                                        array_push($link_postions, $value);
                                }
                        }
                }
                $link_areas = array();
                if ($userBaseInfo['link_areas']) {
                        $link_areas_tmp = explode("|||", $userBaseInfo['link_areas']);
                        foreach ($link_areas_tmp as $value) {
                                if ($value) {
                                        array_push($link_areas, $value);
                                }
                        }
                }

                $this->assign("link_companys", $link_companys);
                $this->assign("link_postions", $link_postions);
                $this->assign("link_areas", $link_areas);

                $this->assign("arCompanyList", $arCompanyList);
                $this->assign("arPostionList", $arPostionList);
                $this->assign("arAreaList", $arAreaList);
                $this->assign("first_class", 2);
                $this->assign("second_class", 3);
                $this->assign("userBaseInfo", $userBaseInfo);
                $this->assign("dqData", $dqData);
                $this->assign("hyData", $hyData);
                $this->assign("zwData", $zwData);
                $this->display();
        }

        public function getData() {
                $id = $_POST['id'];
                $hyData = M("casclist")->where("parentid='$id'")->order("orderid asc")->select();
                echo json_encode($hyData);
                exit();
        }

        function IsRecommended() {

                $sUid = M('member')->where("username = '" . $_SESSION['username'] . "'")->getField('id');
                //  var_dump($sUid);
                $count = M("record")->where("t_id='$sUid'")->count();
                $page = new \Think\Page($count, self::$_size);
                $arRecordList = M('record')->where("t_id='$sUid'")->order("id desc")->limit($page->firstRow, $page->listRows)->select();

                $show = $page->show();
                if ($arRecordList) {
                        $i = (($_GET['p'] ? $_GET['p'] : 1) - 1) * $size + 1;
                        foreach ($arRecordList as $key => &$arRecordInfo) {
                                if (!$arRecordInfo[audstart] || $arRecordInfo[audstart] == 1) {
                                        $arRecordInfo['audstart'] = "未面试";
                                } else {
                                        $arRecordInfo['audstart'] = M("cascadedata")->where("datagroup='audstart' and datavalue='$arRecordInfo[audstart]'")->getField("dataname");
                                }

                                $arJobInfo = M("job")->where("id = '" . $arRecordInfo['j_id'] . "'")->find();
                                $arCompanyInfo = M("company")->where("id = '" . $arJobInfo['cpid'] . "'")->find();
                                $arResumeInfo = M("resume")->where("id = '" . $arRecordInfo['bt_id'] . "'")->find();
                                $arRecordInfo['username'] = $arResumeInfo['username'];
                                $arRecordInfo['cpname'] = $arCompanyInfo['cpname'];
                                $arRecordInfo['Jobcate'] = ($arJobInfo['title'] ? $arJobInfo['title'] : M("casclist")->where("id ='$arJobInfo[Jobcate]'")->getField("cascname"));
                                $arRecordInfo['employ'] = $arJobInfo['employ'];
                                if ($arRecordInfo['status'] == 1) {
                                        $arRecordInfo['status'] = "审核未通过";
                                } elseif ($arRecordInfo['status'] == 2) {
                                        $arRecordInfo['status'] = $arRecordInfo['audstart'];
                                } else {
                                        $arRecordInfo['status'] = "正在审核";
                                }
                                if ($arJobInfo['Tariff'] > 10) {

                                        $arRecordInfo['Tariff'] = floor($arJobInfo['Tariff'] * 0.8 / 100) * 100;
                                } else {
                                        $arRecordInfo['Tariff'] = floor($arJobInfo['treatment'] * $arJobInfo['Tariff'] * 12 * 0.8 / 100) * 100;
                                }
                                //否定原因
                                $arRecordInfo['disreason'] = $arRecordInfo['audreason'] ? $arRecordInfo['audreason'] : $arRecordInfo['because'];
                                $arRecordInfo['sort_id'] = $i++;
                        }
                }

                $this->comp = $arRecordList;
                $this->assign("first_class", 2);
                $this->assign("second_class", 5);
                $this->assign("page", $show);
                $this->display();
        }

        //简历库
        function Recommended() {

                $xfhy = array("A" => "互联网金融", "B" => "在线旅游", "C" => "教育", "D" => "健康医疗", "E" => "电子商务", "F" => "搜索", "G" => "传媒广告",
                    "H" => "移动互联网", "I" => "O2O", "J" => "社交", "K" => "游戏", "L" => "云计算/大数据", "M" => "招聘", "N" => "智能家居",
                    "O" => "智能电视", "P" => "企业服务", "Q" => "文化美术", "R" => "生活服务", "S" => "社会化营销", "T" => "运动体育", "U" => "安全",
                    "V" => "硬件", "W" => "分类信息", "X" => "非TMT(非互联网)");
                $username = $_SESSION['username'];
                //推荐人id
                $relist = M('member')->field('id')->where("username = '" . $username . "'")->find();
                if (empty($relist)) {
                        $this->error("当前页面已经失效，请登录后重试");
                        exit();
                }
                $act = trim($_GET['act']);
                if (!empty($act)) {
                        //在职状态
                        $zzstatus = M("cascadedata")->where("datagroup='zzstart'")->select();
                        $this->assign("zzstatus", $zzstatus);
                        $id = ((intval($_GET['id']) > 0) ? $_GET['id'] : 0);
                        if ($id > 0) {
                                $resumeInfo = M("resume")->where("id=$id")->find();
                                if ($resumeInfo['wordname']) {
                                        $type = 1; //有附件简历模式
                                } else {
                                        $type = 2;
                                }

                                $resumeInfo['uploadUrl'] = M("uploads")->where("name='$resumeInfo[wordname]'")->getField("path");
                                $sFilePath = "/Uploads/word/" . $resumeInfo[wordname];
                                if (file_exists($sFilePath)) {
                                        $resumeInfo['upload'] = $sFilePath;
                                } else {
                                        $r = M("uploads")->where("name='$resumeInfo[wordname]'")->find();

                                        if (!empty($r)) {
                                                $resumeInfo['upload'] = $r['path'];
                                        }
                                }

                                if ($resumeInfo['upload']) {
                                        $arUploadTmp = explode($resumeInfo[wordname], $resumeInfo['upload']);
                                        $resumeInfo['updateFile'] = $resumeInfo[wordname];
                                        $resumeInfo['updatePath'] = $arUploadTmp[0];
                                        $resumeInfo['updateName'] = $resumeInfo['username'] . "--" . $resumeInfo[wordname];
                                }
                                // $resumeInfo['upload'] = M("uploads")->where("name='$resumeInfo[wordname]'")->getField("path");
                                //工作经验
                                $resumeInfo['workexper'] = M("workexper")->where("keyid='$resumeInfo[keyid]'")->getField("intro");

                                //教育经历
                                $resumeInfo['education'] = M("education")->where("keyid='$resumeInfo[keyid]'")->getField("content");

                                //自理证书
                                $resumeInfo['cercate'] = M("cercate")->where("keyid='$resumeInfo[keyid]'")->getField("zhengshu");
                                $resumeInfo['xfhy'] = $xfhy[$resumeInfo['match_industry']];

                                $userInfo = M("member")->where("username='" . $_SESSION['username'] . "' ")->find();
                                if ($resumeInfo[t_id] != $userInfo['id']) {
                                        $resumeInfo = false;
                                }
                        } else {
                                $type = 1;
                        }
                        $isNewUser = "保存";
                        if ($_SESSION['recommend_comid'] && $_SESSION['recommend_jobid']) {
                                $userinfo = M("member")->where("username='" . $_SESSION['username'] . "'")->find();
                                $count = M("resume")->where("t_id='$userinfo[id]' and isshow =1")->count();
                                $Recordtype = intval($_GET['type']);
                                if (($count == 0) || $Recordtype == 1) {
                                        $this->assign("Recordtype", $Recordtype);
                                        $isNewUser = "立即推荐";
                                }
                        }

                        $this->assign("isNewUser", $isNewUser);
                        $matchResume = M("match_resume")->where("t_id='$resumeInfo[t_id]' and bt_id ='$id'")->find();
                        $this->assign("matchResume", $matchResume);
                        $this->assign("type", $type);
                        $this->assign("resumeInfo", $resumeInfo);
                } else {
                        $act = "";
                }
                $where = "t_id=" . $relist['id'] . " and isshow = 1";
                if (trim($_GET['name'])) {
                        $resumeName = trim($_GET['name']);
                        $where.=" and username like '%" . $resumeName . "%'";
                }
                $size = 15;
                $count = M("resume")->where($where)->count();
                $page = new \Think\NewPage($count, $size);
                $arResumeList = M("resume")->where($where)->order("id desc ")->limit($page->firstRow, $page->listRows)->select();

                if ($arResumeList) {
                        $i = (($_GET['p'] ? $_GET['p'] : 1) - 1) * $size + 1;
                        foreach ($arResumeList as $key => &$Resume) {
                                $Resume['state'] = getDataName('zzstart', $Resume['state']);
                                $Resume['sort_id'] = $i++;
                                $Resume['sex'] = (($Resume['sex'] == 0) ? "男" : "女");
                                $Resume['posttime'] = ($Resume['posttime'] != 0 ? date("Y-m-d", $Resume['posttime']) : "");
                        }
                }
                $show = $page->show();
                $this->assign("xfhy", $xfhy);
                $this->assign("resumeName", $resumeName);
                $this->assign("list", array("arResumeList" => $arResumeList, "page" => $show));
                $dqData = M("casclist")->where("parentid=19")->order("orderid asc")->select();
                $this->assign("dqData", $dqData);
                $this->assign("act", $act);
                $this->assign("first_class", 2);
                $this->assign("second_class", 4);
                $this->display('Login/new_recommended');
        }

        //简历库
        function addResume() {
                $xfhy = array("A" => "互联网金融", "B" => "在线旅游", "C" => "教育", "D" => "健康医疗", "E" => "电子商务", "F" => "搜索", "G" => "传媒广告",
                    "H" => "移动互联网", "I" => "O2O", "J" => "社交", "K" => "游戏", "L" => "云计算/大数据", "M" => "招聘", "N" => "智能家居",
                    "O" => "智能电视", "P" => "企业服务", "Q" => "文化美术", "R" => "生活服务", "S" => "社会化营销", "T" => "运动体育", "U" => "安全",
                    "V" => "硬件", "W" => "分类信息", "X" => "非TMT(非互联网)");
                $username = $_SESSION['username'];
                //推荐人id
                $relist = M('member')->field('id')->where("username = '" . $username . "'")->find();
                if (empty($relist)) {
                        $this->error("当前页面已经失效，请登录后重试");
                        exit();
                }
                if (!isset($_SESSION['recommend_comid']) || !isset($_SESSION['recommend_jobid'])) {
                        header("Location:/Home/Login/Recommended/act/addResume.html");
                        exit();
                }

                $jobinfo = M("job")->where(array('id' => $_SESSION['recommend_jobid']))->find();
                //职位名称
                if (!$jobinfo['title']) {
                        $jobinfo['title'] = M("casclist")->where("id='$jobinfo[Jobcate]'")->getField("cascname");
                }
                //在职状态
                $zzstatus = M("cascadedata")->where("datagroup='zzstart'")->select();
                $this->assign("zzstatus", $zzstatus);
                $dqData = M("casclist")->where("parentid=19")->order("orderid asc")->select();
                $this->assign("xfhy", $xfhy);
                $this->assign("dqData", $dqData);
                $this->assign("cid", $_SESSION['recommend_comid']);
                $this->assign("jid", $_SESSION['recommend_jobid']);
                $this->assign("jobinfo", $jobinfo);
                $this->assign("first_class", 3);
                $this->assign("second_class", 4);
                $this->display('Login/new_addResume');
        }

        public function getMillisecond() {
                list($t1, $t2) = explode(' ', microtime());
                return (float) sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
        }

        public function btjadd() {
                $model = M('member', 'stj_', 'DB_CONFIG1');
                $resume = M('resume', 'stj_', 'DB_CONFIG1');
                $data['username'] = I('tusername');
                $data['sex'] = I('sex');
                $data['age'] = I('age');
                $data['state'] = I('state');
                $data['mobile'] = I('mobile');
                $data['email'] = I('email');
                $data['qqnum'] = I('qqnum');
                $data['because'] = ($_POST['because'] ? $_POST['because'] : "");
                $data['personal'] = ($_POST['personal'] ? $_POST['personal'] : "");
                $data['match_company'] = ($_POST['match_company'] ? $_POST['match_company'] : "");
                $data['match_educational'] = ($_POST['match_educational'] ? $_POST['match_educational'] : "");
                $data['match_treatment'] = ($_POST['match_treatment'] ? $_POST['match_treatment'] : "");
                $data['match_industry'] = $_POST['match_industry'];
                $data['match_title'] = $_POST['match_title'];
                $data['match_skill'] = $_POST['match_skill'];
                $data['keyword'] = $_POST['keyword'];
                $data['posttime'] = time();
                $relist = M('member')->field('id')->where("username = '" . $_SESSION['username'] . "'")->find();
                if (empty($relist)) {
                        $this->error("当前页面已经失效，请登录后重试");
                        exit();
                }
                if (!$data['username'] || !$data['mobile'] || !$data['email'] || !$data['because']) {
                        $this->error("简历信息缺少必要字段，请重新填写！");
                        exit();
                }
                $id = intval($_POST['resume_id']);
                if ($_POST['updateFile']) {
                        $data['wordname'] = $_POST['updateFile'];
                }

                $username = $_SESSION['username'];
                $userinfo = $model->where("username='" . $username . "'")->find();

                $data['t_id'] = $userinfo['id'];

                if (empty($id)) {
                        $data['match_area'] = ($_POST['match_area'] ? "北京市" . $_POST['area'] . $_POST['match_area'] : "");
                        $data['posttime'] = time();
                        $data['keyid'] = $this->getMillisecond();
                        if ($_POST['Recordtype'] == 1) {
                                $data['type'] = 1;
                        } else {
                                if ($_COOKIE["upload"]) {
                                        $data['type'] = 5;
                                } else {
                                        $data['type'] = 2;
                                }
                        }
                        if ($vo = $resume->create($data)) {
                                $list = $resume->add($data);
                                if ($list !== false) {
                                        //$resumeCount = M("resume")->where("t_id='$userinfo[id]' and isshow =1")->count();
                                        $btjrid = $resume->getLastInsID();

                                        /*                                         * *****************************【增加候选人】操作日志 begin************************** */

                                        $arNoticeInfo = getTNoticeInfo(0, $data['username']);
                                        $sLogtitle = $arNoticeInfo[0];
                                        $sLogContent = $arNoticeInfo[1];
                                        addNoticeLog($userinfo['id'], $userinfo['username'], $btjrid, 0, $sLogtitle, $sLogContent);

                                        /*                                         * *****************************【增加候选人】操作日志 end************************** */
                                        ////////////////////////////////处理匹配的信息////////////////////////////////////////////
                                        $isRecord = $_POST['isRecord'];
                                        if ($isRecord) {
                                                $arMatchResume = array();
                                                $arMatchResume['t_id'] = $userinfo['id'];
                                                $arMatchResume['bt_id'] = $btjrid;
                                                $arMatchResume['keyword'] = $_POST['keyword'];
                                                $arMatchResume['match_company'] = $_POST['match_company'];
                                                $arMatchResume['match_educational'] = $_POST['match_educational'];
                                                $arMatchResume['match_treatment'] = $_POST['match_treatment'];
                                                $arMatchResume['match_area'] = ($_POST['match_area'] ? "北京市" . $_POST['area'] . $_POST['match_area'] : "");
                                                $arMatchResume['match_industry'] = $_POST['match_industry'];
                                                $arMatchResume['match_title'] = $_POST['match_title'];
                                                $arMatchResume['match_skill'] = $_POST['match_skill'];
                                                $arMatchResume['state'] = $_POST['state'];
                                                $arMatchResume['created_at'] = $arMatchResume['updated_at'] = time();
                                                M("match_resume")->add($arMatchResume);
                                        }
                                        ////////////////////////////////处理匹配的信息////////////////////////////////////////////
                                        if ($data['wordname']) {
                                                $upload = array();
                                                $upload['name'] = $data['wordname'];
                                                $upload['path'] = $_POST['updatePath'] . $_POST['updateFile'];
                                                $upload['posttime'] = time();
                                                M("uploads")->add($upload);
                                        }
                                        if ($_POST['education']) {
                                                $education = array();
                                                $education['keyid'] = $data['keyid'];
                                                $education['starttime'] = 0;
                                                $education['endtime'] = 0;
                                                $education['schoolname'] = 0;
                                                $education['profess'] = 0;
                                                $education['academic'] = 0;
                                                $education['checkinfo'] = true;
                                                $education['content'] = $_POST['education'];
                                                M("education")->add($education);
                                        }
                                        if ($_POST['workexper']) {
                                                $workexper = array();
                                                $workexper['keyid'] = $data['keyid'];
                                                $workexper['starttime'] = 0;
                                                $workexper['endtime'] = 0;
                                                $workexper['pname'] = 0;
                                                $workexper['salary'] = 0;
                                                $workexper['releaving'] = 0;
                                                $workexper['checkinfo'] = true;
                                                $workexper['intro'] = $_POST['workexper'];
                                                M("workexper")->add($workexper);
                                        }
                                        if ($_POST['cercate']) {
                                                $cercate = array();
                                                $cercate['keyid'] = $data['keyid'];
                                                $cercate['ceaname'] = 0;
                                                $cercate['zhengshu'] = $_POST['cercate'];
                                                M("cercate")->add($cercate);
                                        }
                                        if ($_SESSION['recommend_comid'] && $_SESSION['recommend_jobid'] && $btjrid && $_POST['mssj']) {
                                                $recommend_jobid = $_SESSION['recommend_jobid'];
                                                //  unset($_SESSION['recommend_jobid']);
                                                //  unset($_SESSION['recommend_comid']);
                                                header("Location:/Home/login/RecommendTheCandidate3/id/" . $btjrid . "/jobid/" . $recommend_jobid . "/audstarttime/" . $_POST['mssj'] . ".html");
                                                exit();
                                        } else {
                                                //判断该简历有多少能匹配的职位
                                                $where = "title like '%" . $data['keyword'] . "%' and stj_job.employ>(select count(*) from stj_record where stj_record.j_id = stj_job.id and audstart=6) and checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0";
                                                $jobCount = M("job")->where($where)->count();
                                                if ($jobCount > 0) {
                                                        $_SESSION['fitjobCount'] = $jobCount;
                                                        $_SESSION['fitjobKeyword'] = $data['keyword'];
                                                }
                                                $this->success('数据保存成功！', U('Login/Recommended'));
                                        }
                                } else {

                                        $this->error('数据写入错误！');
                                }
                        } else {
                                $this->error($Form->getError());
                        }
                } else if (!empty($id)) {
                        $data['match_area'] = ($_POST['match_area'] ? $_POST['match_area'] : "");
                        $vo = $resume->where("id=" . $id . "")->save($data);

                        $resumeInfo = $resume->where("id=" . $id . "")->find();

                        $isRecord = $_POST['isRecord'];
                        $isRecordInfo = M("match_resume")->where("t_id='$resumeInfo[t_id]' and bt_id='$resumeInfo[id]'")->find();
                        if ($isRecord) {
                                $arMatchResume = array();
                                $arMatchResume['t_id'] = $userinfo['id'];
                                $arMatchResume['bt_id'] = $id;
                                $arMatchResume['keyword'] = $_POST['keyword'];
                                $arMatchResume['match_company'] = $_POST['match_company'];
                                $arMatchResume['match_educational'] = $_POST['match_educational'];
                                $arMatchResume['match_treatment'] = $_POST['match_treatment'];
                                $arMatchResume['match_area'] = ($_POST['match_area'] ? $_POST['match_area'] : "");
                                $arMatchResume['match_industry'] = $_POST['match_industry'];
                                $arMatchResume['match_title'] = $_POST['match_title'];
                                $arMatchResume['match_skill'] = $_POST['match_skill'];
                                $arMatchResume['state'] = $_POST['state'];
                                $arMatchResume['updated_at'] = time();
                                if (empty($isRecordInfo)) {
                                        $arMatchResume['created_at'] = time();
                                        M("match_resume")->add($arMatchResume);
                                } else {
                                        M("match_resume")->where("id=" . $isRecordInfo['id'] . "")->save($arMatchResume);
                                }
                        } else {
                                if (!empty($isRecordInfo)) {
                                        // M("match_resume")->where("id=" . $isRecordInfo['id'] . "")->delete();
                                }
                        }

                        if ($data['wordname']) {
                                $upload = array();
                                $upload['name'] = $data['wordname'];
                                $upload['path'] = $_POST['updatePath'] . $_POST['updateFile'];
                                $upload['posttime'] = time();
                                M("uploads")->add($upload);
                        }

                        if ($_POST['education']) {
                                $education = array();
                                // $education['keyid']     = $data['key_id'];
                                $education['starttime'] = 0;
                                $education['endtime'] = 0;
                                $education['schoolname'] = 0;
                                $education['profess'] = 0;
                                $education['academic'] = 0;
                                $education['checkinfo'] = true;
                                $education['content'] = $_POST['education'];
                                $educationinfo = M("education")->where("keyid='" . $resumeInfo[keyid] . "'")->find();

                                if ($educationinfo) {
                                        M("education")->where("keyid='" . $resumeInfo[keyid] . "'")->save($education);
                                        echo M("education")->getlastsql();
                                } else {
                                        $education['keyid'] = $resumeInfo['keyid'];
                                        M("education")->add($education);
                                        echo M("education")->getlastsql();
                                }
                        }

                        if ($_POST['workexper']) {
                                $workexper = array();
                                //   $workexper['keyid']     = $data['key_id'];
                                $workexper['starttime'] = 0;
                                $workexper['endtime'] = 0;
                                $workexper['pname'] = 0;
                                $workexper['salary'] = 0;
                                $workexper['releaving'] = 0;
                                $workexper['checkinfo'] = true;
                                $workexper['intro'] = $_POST['workexper'];
                                $workexperinfo = M("workexper")->where("keyid='" . $resumeInfo[keyid] . "'")->find();

                                if ($workexperinfo) {
                                        M("workexper")->where("keyid='" . $resumeInfo[keyid] . "'")->save($workexper);
                                } else {
                                        $workexper['keyid'] = $resumeInfo['keyid'];
                                        M("workexper")->add($workexper);
                                }
                        }
                        if ($_POST['cercate']) {
                                $cercate = array();
                                //  $workexper['keyid']     = $data['key_id'];
                                $cercate['ceaname'] = 0;
                                $cercate['zhengshu'] = $_POST['cercate'];
                                $cercateinfo = M("cercate")->where("keyid='" . $resumeInfo[keyid] . "'")->find();
                                if ($cercateinfo) {
                                        M("cercate")->where("keyid='" . $resumeInfo[keyid] . "'")->save($cercate);
                                } else {
                                        $cercate['keyid'] = $resumeInfo['keyid'];
                                        M("cercate")->add($cercate);
                                }
                        }

                        if ($vo !== false) {
                                $this->success('数据修改成功！', U('Login/Recommended'));
                        } else {
                                //   $this->error('数据写入错误！');
                        }
                }
        }

        function page() {
                $nowpage = I('i');
                //职位 1
                $position = I('position');
                //行业 2
                $industry = I("industry");
                $place = I('area');
                $title = trim(I('title'));
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
                if ($title) {

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
                        $jt = M("casclist")->where("cascname like '%" . $title . "%' and id in (" . $jobid . ")")->select();

                        if ($jt) {
                                $jttmp = array();
                                foreach ($jt as $j) {
                                        array_push($jttmp, $j['id']);
                                }
                                $jttmp = implode(",", $jttmp);
                                $where .=" AND (Jobcate in (" . $jttmp . ") or title like '%" . $title . "%') ";
                        } else {
                                $where .=" AND (Jobcate in (1000000000)  or title like '%" . $title . "%') ";
                        }
                }

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

                /*
                  //无是否已经招满人标记
                  $count = M("job")->where("checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0" . $where)->count();
                  $page = new \Think\Spage($count, self::$_size);
                  $arJobList = M("job")->where("checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0" . $where)->order("orderid asc, starttime desc")->limit($page->firstRow, $page->listRows)->select();
                 */
                $count = M("job")->where("employ>(select count(*) from stj_record where stj_record.j_id = stj_job.id and audstart=6) and checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0 and is_show=1" . $where)->count();
                $page = new \Think\Spage($count, 15);
                $arJobList = M("job")->where("employ>(select count(*) from stj_record where stj_record.j_id = stj_job.id and audstart=6) and  checkinfo='true' and endtime>unix_timestamp(now()) and is_deleted=0 and is_show=1" . $where)->order("orderid ASC,checktime DESC, starttime DESC")->limit($page->firstRow, $page->listRows)->select();

                $show = $page->show();

                foreach ($arJobList as $key => &$val) {
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
                        $company = M("company")->where("id='$val[cpid]'")->find();

                        $val['cpname'] = $company["cpname"];

                        if ($company['thumlogo']) {
                                $val['thumlogo'] = $company["thumlogo"];
                        } else {
                                $val['thumlogo'] = "/Public/img/defoultLogo.png";
                        }
                        $val['experience'] = M("cascadedata")->where("datagroup='experience' and datavalue='$val[experience]'")->getField("dataname");
                        $val['record_num'] = M("record")->where("j_id=" . $val['id'])->count();
                        //工作地点
                        $val['jobplace'] = M("casclist")->where("id='$val[jobplace]'")->getField("cascname");
                }

                $this->page = $page;
                $this->money = $money;
                $this->smoney = $smoney;
                $this->workarea = $workarea;
                $this->positime = $positime;
                $this->str = $show;
                $this->nowpage = $nowpage;
                $this->comp = $arJobList;
                $this->display("page");
                //  $this->display();
        }

        function searchs() {

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

                        //公司缩略图
                        $val['thumlogo'] = ($company['thumlogo'] ? $company['thumlogo'] : "/Public/img/defoultLogo.png");
                        //工作经验要求
                        $val['experience'] = M("cascadedata")->where("datagroup='experience' and datavalue='$val[experience]'")->getField("dataname");

                        $val['strycate'] = getCscData($val['strycate']);
                        $val['nature'] = getDataName("nature", $company['nature']);
                        $val['scale'] = getDataName("scale", $company['scale']);
                        $val['stage'] = M("cascadedata")->where("datagroup='stage' and datavalue=" . $company['stage'])->getField("dataname");
                        $val['record_num'] = M("record")->where("j_id=" . $val['id'])->count();
                        //工作地点
                        $val['jobplace'] = M("casclist")->where("id='$val[jobplace]'")->getField("cascname");
                }
                $this->nowpage = $nowpage;
                $this->assign("page", $show);
                $this->assign("arJobList", $arJobList);
                $this->display('page');
        }

        //推荐职位
        function JobSearch() {

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
                $page = new \Think\NewPage($count, 10);
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

                        //公司缩略图
                        $val['thumlogo'] = ($company['thumlogo'] ? $company['thumlogo'] : "/Public/img/defoultLogo.png");
                        //工作经验要求
                        $val['experience'] = M("cascadedata")->where("datagroup='experience' and datavalue='$val[experience]'")->getField("dataname");
                        $val['stage'] = M("cascadedata")->where("datagroup='stage' and datavalue=" . $company['stage'])->getField("dataname");
                        $val['strycate'] = getCscData($val['strycate']);
                        $val['nature'] = getDataName("nature", $company['nature']);
                        $val['scale'] = getDataName("scale", $company['scale']);
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
                $act = trim($_GET['act']);
                if ($act == "collect") {
                        //收藏职位
                        $username = $_SESSION['username'];
                        $count = M("job_collection")->where("username='$username' and status =1")->count();
                        $page = new \Think\NewPage($count, 10);
                        $arCollectList = M("job_collection")->where("username='$username' and status =1")->order("id desc")->limit($page->firstRow, $page->listRows)->select();
                        $show = $page->show();
                        $i = (($_GET['p'] ? $_GET['p'] : 1) - 1) * 15 + 1;
                        foreach ($arCollectList as &$arCollectInfo) {
                                $arCollectInfo['cpname'] = M("company")->where("id='$arCollectInfo[cpid]'")->getField("cpname");
                                $arCollectInfo['count'] = M("record")->where("j_id=" . $arCollectInfo['j_id'] . "")->count();
                                $arCollectInfo['endtime'] = date("Y-m-d", $arCollectInfo['endtime']);
                                $arCollectInfo['sort_id'] = $i++;
                        }
                        $this->arCollectList = $arCollectList;
                        $this->assign("page", $show);
                } else {
                        $act = "";
                }

                $this->money = $money;
                $this->workarea = $workarea;
                $this->positime = $positime;
                $this->page = $show;
                $this->assign("act", $act);
                $this->assign("arJobList", $arJobList);
                $this->assign("isSearchCollect", $isSearchCollect);
                $this->assign("arIndustry", $arIndustry);
                $this->assign("arPosition", $arPosition);
                $this->assign("title", $title);
                $this->assign("first_class", 3);
                $this->assign("second_class", 8);
                $this->display("new_jobsearch");
        }

        //正在推荐
        public function Recording() {
                $username = $_SESSION['username'];
                $sUid = M('member')->where("username = '$username'")->getField('id');
                //所有推荐列表
                $arRecordJobList = M('record')->where("t_id='$sUid'")->select();

                if (!empty($arRecordJobList)) {
                        $arJobID = array();
                        foreach ($arRecordJobList as $arJobInfo) {
                                array_push($arJobID, $arJobInfo['j_id']);
                        }
                        if (!empty($arJobID)) {
                                $sJobID = implode(",", $arJobID);
                                $arJobTmp = M('job')->where("id in (" . $sJobID . ") AND endtime>" . time())->select();
                                if (!empty($arJobTmp)) {
                                        $whereJobID = array();
                                        foreach ($arJobTmp as $arJobInfoTmp) {
                                                array_push($whereJobID, $arJobInfoTmp['id']);
                                        }

                                        $whereJobID = implode(",", $whereJobID);
                                        $count = M("record")->where("t_id='$sUid' and j_id in (" . $whereJobID . ")")->count();

                                        $page = new \Think\NewPage($count, 15);

                                        //默认按id倒序，还可按推荐人姓名正序、倒序
                                        $order = "id desc";
                                        if ($_GET['order'] == "desc") {
                                                $order = "CONVERT(username USING gbk) desc";
                                        } else if ($_GET['order'] == "asc") {
                                                $order = "CONVERT(username USING gbk) asc";
                                                $this->assign("ordern", "m");
                                                $this->assign("orderw", "current");
                                        }
                                        //$arRecordList = M('record')->where("t_id='$sUid' and j_id in (" . $whereJobID . ")")->order($order)->limit($page->firstRow, $page->listRows)->select();
                                        $arRecordList = M('record')->query("select c.*,r.id rid,r.username from stj_record c join stj_resume r on bt_id=r.id and  c.t_id=" . $sUid . " and j_id in (" . $whereJobID . ") order by " . $order . " limit " . $page->firstRow . "," . $page->listRows);
                                        $show = $page->show();
                                        if ($arRecordList) {
                                                $i = (($_GET['p'] ? $_GET['p'] : 1) - 1) * 15 + 1;
                                                foreach ($arRecordList as $key => &$arRecordInfo) {
                                                        $arRecordInfo['audstart_status'] = $arRecordInfo['audstart'];
                                                        if (!$arRecordInfo[audstart] || $arRecordInfo[audstart] == 1) {
                                                                $arRecordInfo['audstart'] = "未面试";
                                                        } else {
                                                                $arRecordInfo['audstart'] = M("cascadedata")->where("datagroup='audstart' and datavalue='$arRecordInfo[audstart]'")->getField("dataname");
                                                        }
                                                        $arRecordInfo['notice_list'] = M("notice_log")->where("type=1 and bt_id=" . $arRecordInfo['bt_id'] . " and (j_id=" . $arRecordInfo['j_id'] . " or j_id=0)")->order("id desc")->select();

                                                        $arJobInfo = M("job")->where("id = '" . $arRecordInfo['j_id'] . "'")->find();
                                                        $arCompanyInfo = M("company")->where("id = '" . $arJobInfo['cpid'] . "'")->find();
                                                        //$arResumeInfo = M("resume")->where("id = '" . $arRecordInfo['bt_id'] . "'")->find();
                                                        //$arRecordInfo['username'] = $arResumeInfo['username'];
                                                        $arRecordInfo['cpname'] = $arCompanyInfo['cpname'];
                                                        $arRecordInfo['cpid'] = $arJobInfo['cpid'];
                                                        $arRecordInfo['Jobcate'] = ($arJobInfo['title'] ? $arJobInfo['title'] : M("casclist")->where("id ='$arJobInfo[Jobcate]'")->getField("cascname"));
                                                        $arRecordInfo['employ'] = $arJobInfo['employ'];
                                                        if ($arRecordInfo['status'] == 1) {
                                                                $arRecordInfo['status'] = "审核未通过";
                                                        } elseif ($arRecordInfo['status'] == 2) {
                                                                $arRecordInfo['status'] = $arRecordInfo['audstart'];
                                                        } else {
                                                                $arRecordInfo['status'] = "正在审核";
                                                        }
                                                        if ($arJobInfo['Tariff'] > 10) {

                                                                $arRecordInfo['Tariff'] = floor($arJobInfo['Tariff'] * 0.8 / 100) * 100;
                                                        } else {
                                                                $arRecordInfo['Tariff'] = floor($arJobInfo['treatment'] * $arJobInfo['Tariff'] * 12 * 0.8 / 100) * 100;
                                                        }

                                                        $arRecordInfo['comment'] = M("evaluate")->where("pid=" . $arRecordInfo['id'] . " and uid='$sUid' and tag='record'")->getField("content");

                                                        //否定原因
                                                        $arRecordInfo['disreason'] = $arRecordInfo['audreason'] ? $arRecordInfo['audreason'] : $arRecordInfo['because'];
                                                        $arRecordInfo['sort_id'] = $i++;
                                                }
                                        }
                                }
                        }
                }
                $this->assign("arRecordList", $arRecordList);

                $this->assign("page", $show);
                $this->assign("first_class", 4);
                $this->display("new_recording");
        }

        //历史推荐
        public function Recorded() {
                $username = $_SESSION['username'];
                $sUid = M('member')->where("username = '$username'")->getField('id');
                //所有推荐列表
                $arRecordJobList = M('record')->where("t_id='$sUid'")->select();

                if (!empty($arRecordJobList)) {
                        $arJobID = array();
                        foreach ($arRecordJobList as $arJobInfo) {
                                array_push($arJobID, $arJobInfo['j_id']);
                        }
                        if (!empty($arJobID)) {
                                $sJobID = implode(",", $arJobID);
                                $arJobTmp = M('job')->where("id in (" . $sJobID . ") AND endtime<" . time())->select();
                                if (!empty($arJobTmp)) {
                                        $whereJobID = array();
                                        foreach ($arJobTmp as $arJobInfoTmp) {
                                                array_push($whereJobID, $arJobInfoTmp['id']);
                                        }

                                        $whereJobID = implode(",", $whereJobID);
                                        $count = M("record")->where("t_id='$sUid' and j_id in (" . $whereJobID . ")")->count();

                                        $page = new \Think\NewPage($count, 15);

                                        //默认按id倒序，还可按推荐人姓名正序、倒序
                                        $order = "id desc";
                                        if ($_GET['order'] == "desc") {
                                                $order = "CONVERT(username USING gbk) desc";
                                        } else if ($_GET['order'] == "asc") {
                                                $order = "CONVERT(username USING gbk) asc";
                                                $this->assign("ordern", "m");
                                                $this->assign("orderw", "current");
                                        }
                                        //$arRecordList = M('record')->where("t_id='$sUid' and j_id in (" . $whereJobID . ")")->order("id desc")->limit($page->firstRow, $page->listRows)->select();
                                        $arRecordList = M('record')->query("select c.*,r.id rid,r.username from stj_record c join stj_resume r on bt_id=r.id and  c.t_id=" . $sUid . " and j_id in (" . $whereJobID . ")  order by " . $order . " limit " . $page->firstRow . "," . $page->listRows);
                                        $show = $page->show();
                                        if ($arRecordList) {
                                                $i = (($_GET['p'] ? $_GET['p'] : 1) - 1) * $size + 1;
                                                foreach ($arRecordList as $key => &$arRecordInfo) {
                                                        if (!$arRecordInfo[audstart] || $arRecordInfo[audstart] == 1) {
                                                                $arRecordInfo['audstart'] = "未面试";
                                                        } else {
                                                                $arRecordInfo['audstart'] = M("cascadedata")->where("datagroup='audstart' and datavalue='$arRecordInfo[audstart]'")->getField("dataname");
                                                        }

                                                        $arJobInfo = M("job")->where("id = '" . $arRecordInfo['j_id'] . "'")->find();
                                                        $arCompanyInfo = M("company")->where("id = '" . $arJobInfo['cpid'] . "'")->find();
//                            $arResumeInfo = M("resume")->where("id = '" . $arRecordInfo['bt_id'] . "'")->find();
//                            $arRecordInfo['username'] = $arResumeInfo['username'];
                                                        $arRecordInfo['cpname'] = $arCompanyInfo['cpname'];
                                                        $arRecordInfo['Jobcate'] = ($arJobInfo['title'] ? $arJobInfo['title'] : M("casclist")->where("id ='$arJobInfo[Jobcate]'")->getField("cascname"));
                                                        $arRecordInfo['employ'] = $arJobInfo['employ'];
                                                        $arRecordInfo['cpid'] = $arJobInfo['cpid'];
                                                        if ($arRecordInfo['status'] == 1) {
                                                                $arRecordInfo['status'] = "审核未通过";
                                                        } elseif ($arRecordInfo['status'] == 2) {
                                                                $arRecordInfo['status'] = $arRecordInfo['audstart'];
                                                        } else {
                                                                $arRecordInfo['status'] = "正在审核";
                                                        }
                                                        if ($arJobInfo['Tariff'] > 10) {

                                                                $arRecordInfo['Tariff'] = floor($arJobInfo['Tariff'] * 0.8 / 100) * 100;
                                                        } else {
                                                                $arRecordInfo['Tariff'] = floor($arJobInfo['treatment'] * $arJobInfo['Tariff'] * 12 * 0.8 / 100) * 100;
                                                        }
                                                        //否定原因
                                                        $arRecordInfo['disreason'] = $arRecordInfo['audreason'] ? $arRecordInfo['audreason'] : $arRecordInfo['because'];
                                                        $arRecordInfo['sort_id'] = $i++;
                                                }
                                        }
                                }
                        }
                }

                $this->assign("arRecordList", $arRecordList);

                $this->assign("page", $show);
                $this->assign("first_class", 4);
                $this->display("new_recorded");
        }

        function logout() {
                if (!empty($_SESSION['username']) && substr($_SESSION['username'], 0, 3) == "qq_") {
                        setcookie($_SESSION['username'], "", time() - 1, "/");
                }
                session_destroy();
                $this->success("", U('Index/index'));
        }

        function ziwojieshao() {
                $model = M('member', 'stj_', 'DB_CONFIG1');
                $username = $_SESSION['username'];
                $info = $model
                        ->where("username='" . $username . "'")
                        ->find();

                $this->info = $info;
                $this->assign("first_class", 1);
                $this->assign("second_class", 2);
                $this->display();
        }

        function introduce() {
                $data['intro'] = $_POST['oneself'];
                $username = $_SESSION['username'];
                $model = M('member', 'stj_', 'DB_CONFIG1');
                $info = $model->where("username='" . $username . "'")->save($data);
                if ($info) {
                        echo "ok";
                } else {
                        echo "ok";
                }
        }

        function EnterIndex2() {
                $model = M('job', 'stj_', 'DB_CONFIG1');
                $cmodel = M('company', 'stj_', 'DB_CONFIG1');
                $comid = I('comid');
                $jobid = I('jobid');
                $cpinfo = $model
                        ->field("com.id,stj_job.starttime,stj_job.id as jobid,stj_job.posttime,stj_job.endtime,stj_job.employ,stj_job.workdesc,stj_job.content,com.address,com.bright,stj_job.Tariff,ca.cascname,cas.cascname as casc,casc.cascname as casca,com.cpname,cc.dataname,ccas.dataname as ccas,ccasc.dataname as ccasc,chi.dataname as chi,count(re.j_id) as num")
                        ->join("stj_casclist AS ca ON ca.id = stj_job.Jobcate")
                        ->join("stj_casclist AS cas on cas.id = stj_job.jobplace")
                        ->join("stj_casclist AS casc on casc.id = stj_job.strycate")
                        ->join("stj_company as com on com.id=stj_job.cpid")
                        ->join("stj_record as re on re.j_id=stj_job.id ")
                        ->join("stj_cascadedata as cc on cc.datavalue=stj_job.treatment and cc.datagroup='treatment' AND cc.level=0")
                        ->join("stj_cascadedata as ccas on ccas.datavalue=stj_job.education and ccas.datagroup='education' AND ccas.level=0")
                        ->join("stj_cascadedata as ccasc on ccasc.datavalue=stj_job.education and ccasc.datagroup='experience' AND ccasc.level=0")
                        ->join("stj_cascadedata as chi on chi.datavalue=stj_job.joblang and chi.datagroup='joblang' AND chi.level=0")
                        ->where("com.id=" . $comid . " and stj_job.id=" . $jobid . "")
                        ->group("re.j_id")
                        ->limit("0,10")
                        ->select();
                $comp = array();
                foreach ($cpinfo as $key => $val) {
                        if ($cpinfo[$key]['Tariff'] > 10) {

                                $cpinfo[$key]['Tariff'] = floor($cpinfo[$key]['Tariff'] * 0.8 / 100) * 100;
                        } else {
                                $cpinfo[$key]['Tariff'] = floor($cpinfo[$key]['treatment'] * $cpinfo[$key]['Tariff'] * 12 * 0.8 / 100) * 100;
                        }
                        $cpinfo[$key]['starttime'] = date('Y-m-d H:i:s', $cpinfo[$key]['starttime']);

                        // $cpinfo[$key]['posttime'] = date('Y-m-d H:i:s', $cpinfo[$key]['posttime']);
                        $cpinfo[$key]['posttime'] = (($val['checktime'] != 0) ? date('Y-m-d H:i', $val['checktime']) : date('Y-m-d H:i', $val['starttime']));
                        $cpinfo[$key]['endtime'] = date('Y-m-d H:i:s', $cpinfo[$key]['endtime']);
                        $comp[] = $cpinfo[$key];
                }
                $cinfo = $cmodel
                        ->field("stj_company.cpname as cpname,cascadedata.dataname as jieduan,nature.dataname as xingzhi,scale.dataname as guimo")
                        ->join("stj_cascadedata as cascadedata on stj_company.stage=cascadedata.datavalue and cascadedata.datagroup='stage' AND cascadedata.level=0")
                        ->join("stj_cascadedata as nature on stj_company.nature=nature.datavalue and nature.datagroup='nature' AND nature.level=0")
                        ->join("stj_cascadedata as scale on stj_company.scale=scale.datavalue and scale.datagroup='scale' AND scale.level=0")
                        ->where("stj_company.id=" . $comid . "")
                        ->select();
                $this->cinfo = $cinfo;
                $this->comp = $comp;
                $this->display();
        }

        function EnterIndex() {
                $model = M('job', 'stj_', 'DB_CONFIG1');
                $cmodel = M('company', 'stj_', 'DB_CONFIG1');
                $comid = I('comid');
                $jobid = I('jobid');
                $cpinfo = $model
                        ->field("com.id,stj_job.starttime,stj_job.id as jobid,stj_job.posttime,stj_job.endtime,stj_job.employ,stj_job.workdesc,stj_job.content,com.address,com.bright,stj_job.Tariff,ca.cascname,cas.cascname as casc,casc.cascname as casca,com.cpname,cc.dataname,ccas.dataname as ccas,ccasc.dataname as ccasc,chi.dataname as chi,count(re.j_id) as num")
                        ->join("stj_casclist AS ca ON ca.id = stj_job.Jobcate")
                        ->join("stj_casclist AS cas on cas.id = stj_job.jobplace")
                        ->join("stj_casclist AS casc on casc.id = stj_job.strycate")
                        ->join("stj_company as com on com.id=stj_job.cpid")
                        ->join("stj_record as re on re.j_id=stj_job.id ")
                        ->join("stj_cascadedata as cc on cc.datavalue=stj_job.treatment and cc.datagroup='treatment' AND cc.level=0")
                        ->join("stj_cascadedata as ccas on ccas.datavalue=stj_job.education and ccas.datagroup='education' AND ccas.level=0")
                        ->join("stj_cascadedata as ccasc on ccasc.datavalue=stj_job.education and ccasc.datagroup='experience' AND ccasc.level=0")
                        ->join("stj_cascadedata as chi on chi.datavalue=stj_job.joblang and chi.datagroup='joblang' AND chi.level=0")
                        ->where("com.id=" . $comid . " and stj_job.id=" . $jobid . " ")
                        ->group("re.j_id")
                        ->limit("0,10")
                        ->select();
                $comp = array();
                foreach ($cpinfo as $key => $val) {
                        if ($cpinfo[$key]['Tariff'] > 10) {

                                $cpinfo[$key]['Tariff'] = floor($cpinfo[$key]['Tariff'] * 0.8 / 100) * 100;
                        } else {
                                $cpinfo[$key]['Tariff'] = floor($cpinfo[$key]['treatment'] * $cpinfo[$key]['Tariff'] * 12 * 0.8 / 100) * 100;
                        }

                        //$cpinfo[$key]['starttime'] = date('Y-m-d H:i:s', $cpinfo[$key]['starttime']);
                        $cpinfo[$key]['starttime'] = (($val['checktime'] != 0) ? date('Y-m-d H:i', $val['checktime']) : date('Y-m-d H:i', $val['starttime']));
                        $comp[] = $cpinfo[$key];
                }
                $cinfo = $cmodel
                        ->field("stj_company.cpname as cpname,cascadedata.dataname as jieduan,nature.dataname as xingzhi,scale.dataname as guimo")
                        ->join("stj_cascadedata as cascadedata on stj_company.stage=cascadedata.datavalue and cascadedata.datagroup='stage' AND cascadedata.level=0")
                        ->join("stj_cascadedata as nature on stj_company.nature=nature.datavalue and nature.datagroup='nature' AND nature.level=0")
                        ->join("stj_cascadedata as scale on stj_company.scale=scale.datavalue and scale.datagroup='scale' AND scale.level=0")
                        ->where("stj_company.id=" . $comid . "")
                        ->select();
                $this->cinfo = $cinfo;
                $this->comp = $comp;
                $this->display();
        }

        //推荐职位
        function RecommendTheCandidate() {
                $username = $_SESSION['username'];
                $cid = $_GET['comid'];
                $jid = $_GET['jobid'];
                $userInfo = M("member")->where("username = '" . $username . "'")->find();
                $jobInfo = M("job")->where("id='$jid'")->find();
                if (empty($jobInfo) || $jobInfo['cpid'] != $cid || empty($userInfo)) {
                        $this->error("您要访问的页面不存在！");
                        exit();
                }
                if ($jobInfo['endtime'] < time()) {
                        $this->error("您想要推荐的职位已经过期！");
                        exit();
                }
                $count = M("resume")->where("t_id='$userInfo[id]' and isshow =1")->count();
                //判断当前是否没有候选人，如果没有候选人，则记录下此推荐人想要推荐的职位
                $_SESSION['recommend_comid'] = $cid;
                $_SESSION['recommend_jobid'] = $jid;
                if ($count == 0) {
                        header("Location:/Home/Login/Recommended/act/addResume/type/1.html");
                        exit();
                }
                $page = new \Think\NewPage($count, 10);

                $arResumeList = M("resume")->where("t_id='$userInfo[id]' and isshow =1")->order("id desc")->limit($page->firstRow, $page->listRows)->select();
                $show = $page->show();

                if (!$jobInfo['title']) {
                        $jobInfo['title'] = M("casclist")->where("id='$jobInfo[Jobcate]'")->getField("cascname");
                }

                $i = (($_GET['p'] ? $_GET['p'] : 1) - 1) * 10 + 1;
                foreach ($arResumeList as &$arResumeInfo) {

                        $arResumeInfo['state'] = M("cascadedata")->where("datavalue='$arResumeInfo[state]' and datagroup='zzstart'")->getField("dataname");

                        //判断该候选人是否已经推荐给该职位
                        $isRecord = M("record")->where("bt_id=" . $arResumeInfo['id'] . " AND j_id='$jid'")->find();
                        if ($isRecord) {
                                $arResumeInfo['isRecord'] = "disabled";
                        } else {
//                                $arResumeInfo['isRecord'] = "";
//                                
                                //判断该推荐人是否已经推荐给该企业的一个职位
                                $isThisCompany = M("record")->query("select *  from stj_record where bt_id=" . $arResumeInfo['id'] . " and j_id in (select id from stj_job where cpid = $cid) and (audstart=1 or audstart=3 or audstart=5 or audstart=6) and status !=1");
                                if (!empty($isThisCompany)) {
                                        $arResumeInfo['isRecord'] = "isthiscompany";
                                } else {
                                        //判断该职位是否已经推荐给3家企业
                                        $isThreeCompany = M("record")->query("select *  from stj_record  r join stj_job b on  r.j_id = b.id  and r.bt_id =" . $arResumeInfo['id'] . "  and (audstart=1 or audstart=3 or audstart=5 or audstart=6) and status !=1 group by  b.cpid;");

                                        if (count($isThreeCompany) >= 3) {
                                                $arResumeInfo['isRecord'] = "isthreecompany";
                                        }
                                }
                        }


                        $arResumeInfo['sort_id'] = $i++;
                }
                $this->assign("cid", $cid);
                $this->assign("jobid", $jid);
                $this->assign("jobInfo", $jobInfo);
                $this->assign("first_class", 3);
                $this->assign("second_class", 5);
                $this->resumelist = $arResumeList;
                $this->assign("count", $count);
                $this->assign("page", $show);
                $this->display("new_record_user");
        }

        function RecommendTheCandidate3() {
                $username = $_SESSION['username'];
                $this->assign("first_class", 3);
                $this->assign("second_class", 5);
                //招聘信息ID
                $data['j_id'] = intval($_REQUEST["jobid"]);

                if (!is_array($_REQUEST['id']) && $_SESSION['recommend_jobid'] && $_SESSION['recommend_comid']) {
                        //推荐人添加完简历直接过来
                        $type = 3;
                        $getid = array($_REQUEST['id']);
                        unset($_SESSION['recommend_jobid']);
                        unset($_SESSION['recommend_comid']);
                } else {
                        $type = 0;
                        $getid = $_REQUEST['id']; //获取选择的复选框的值
                }

                if (!$getid) {
                        $this->error('未选择记录'); //没选择就提示信息
                        exit();
                }
                if ($data['j_id'] <= 0) {
                        $this->error("参数错误");
                        exit();
                }
                $userInfo = M('member')->where("username='" . $username . "'")->find();
                if (empty($userInfo)) {
                        $this->error("您长时间未操作，请登陆后重试");
                        exit();
                }
                //招聘信息
                $jobInfos = M("job")->where("id='$data[j_id]'")->find();
                if (!$jobInfos['title']) {
                        $jobInfos['title'] = M("casclist")->where("id='$jobInfos[Jobcate]'")->getField("cascname");
                }
                $this->assign("jobInfos", $jobInfos);
                //选择一个以上，就用,把值连接起来(1,2,3)这样		
                $data['bt_id'] = $getid;
                $data['t_id'] = $userInfo['id'];


                /*                 * *********限制同一个候选人已经推荐给该职位、限制同一个候选人已经推荐给该公司职位、限制同一个候选人已经推荐给3家公司******* */

                //判断该候选人是否已经推荐给该职位
                $isRecord = M("record")->where("bt_id=" . $arResumeInfo['id'] . " AND j_id='$jid'")->find();
                if ($isRecord) {
                        $this->resumelist = $this->getRecordListByJob($userInfo['id'], $data['j_id']);
                        $this->display("new_recorded_user");
                        exit();
                } else {
                        //判断该推荐人是否已经推荐给该企业的一个职位
                        $isThisCompany = M("record")->query("select *  from stj_record where bt_id=" . $arResumeInfo['id'] . " and j_id in (select id from stj_job where cpid = $cid)  and (audstart=1 or audstart=3 or audstart=5 or audstart=6) and status !=1");
                        if (!empty($isThisCompany)) {
                                $this->resumelist = $this->getRecordListByJob($userInfo['id'], $data['j_id']);
                                $this->display("new_recorded_user");
                                exit();
                        } else {
                                //判断该职位是否已经推荐给3家企业
                                $isThreeCompany = M("record")->query("select * from stj_record  r join stj_job b on  r.j_id = b.id  and r.bt_id =" . $arResumeInfo['id'] . "  and (audstart=1 or audstart=3 or audstart=5 or audstart=6) and status !=1 group by  b.cpid;");
                                if (count($isThreeCompany) >= 3) {
                                        $this->resumelist = $this->getRecordListByJob($userInfo['id'], $data['j_id']);
                                        $this->display("new_recorded_user");
                                        exit();
                                }
                        }
                }


                $arRecordCount = M("record")->where("j_id='$data[j_id]' and t_id='$data[t_id]'")->count();
                //如果此职位已经推荐过10个人，则不能再次推荐
                if ($arRecordCount > 10) {
                        $this->resumelist = $this->getRecordListByJob($userInfo['id'], $data['j_id']);
                        $this->display("new_recorded_user");
                        exit();
                }
                $data['posttime'] = time();
                $sql = "INSERT INTO `stj_record` (`id`, `j_id`, `t_id`, `bt_id`, `audstart`, `audreason`, `sink`, `posttime`, `status`, `because`, `news_status`,`is_send`,`audstartdate`,type,j_title) VALUES ";
                $sqlvalue = "";
                for ($i = 0; $i < count($data['bt_id']); $i++) {
                        $isRecord = M("record")->where("j_id='$data[j_id]' and bt_id='" . $data[bt_id][$i] . "'")->find();
                        $resumeInfo = M("resume")->where("id='" . $data[bt_id][$i] . "'")->find();
                        $this->assign("resumeInfo", $resumeInfo);
                        if (!$isRecord && $resumeInfo) {
                                $sqlvalue.= "(NULL, '" . $data['j_id'] . "', '" . $data['t_id'] . "', '" . $data['bt_id'][$i] . "', '1', '', '1', '" . $data['posttime'] . "', '0', NULL, '0',1,'$_REQUEST[audstarttime]','$type','$jobInfos[title]'),";

                                /*                                 * *******************************【推荐候选人】操作日志 begin ************************** */


                                $companyInfo = M("company")->where("id=" . $jobInfos['cpid'])->find();
                                $arNoticeInfo = getTNoticeInfo(1, $resumeInfo['username'], $companyInfo['cpname'], $jobInfos['title']);
                                $sLogtitle = $arNoticeInfo[0];
                                $sLogContent = $arNoticeInfo[1];
                                addNoticeLog($data['t_id'], $username, $data['bt_id'][$i], $data['j_id'], $sLogtitle, $sLogContent);

                                /*                                 * *******************************【推荐候选人】操作日志 end ************************** */
                        }
                }

                if ($sqlvalue) {
                        $sqlvalue = rtrim($sqlvalue, ",");
                        $add = mysql_query($sql . $sqlvalue);
                        if ($add) {
                                $this->resumelist = $this->getRecordListByJob($userInfo['id'], $data['j_id']);
                                $this->display("new_recorded_user");
                        } else {
                                $this->display("RecommendTheCandidate");
                        }
                } else {

                        $this->resumelist = $this->getRecordListByJob($userInfo['id'], $data['j_id']);
                        //    $this->display();
                        $this->display("new_recorded_user");
                }
        }

        //获取已推荐的记录
        public function getRecordListByJob($t_id, $jid) {
                $where = "t_id='$t_id' and j_id='$jid'";
                $arRecordList = M("record")->where($where)->select();
                $i = 1;
                foreach ($arRecordList as &$arRecordInfo) {
                        $arResumeInfo = M("resume")->where("id=" . $arRecordInfo['bt_id'])->find();
                        $arRecordInfo['username'] = $arResumeInfo['username'];
                        $arRecordInfo['sex'] = ($arRecordInfo['sex'] == 1 ? "女" : "男");
                        $arRecordInfo['state'] = M("cascadedata")->where("datavalue='$arResumeInfo[state]' and datagroup ='zzstart'")->getField("dataname");
                        $arRecordInfo['mobile'] = $arResumeInfo['mobile'];
                        $jobInfo = M("job")->where("id='$arRecordInfo[j_id]'")->find();
                        if (!$jobInfo['title']) {
                                $arRecordInfo['title'] = M("casclist")->where("id='$jobInfo[Jobcate]'")->getField("cascname");
                        } else {
                                $arRecordInfo['title'] = $jobInfo['title'];
                        }
                        $arRecordInfo['sort_order'] = $i++;
                }
                return $arRecordList;
        }

        function savepassv() {

                $user = M('userinfo', 'stj_', 'DB_CONFIG1');
                $username = ($_SESSION['username'] ? $_SESSION['username'] : $_SESSION['cusername']);


                $data['password'] = md5(md5(I("password")));
                $newdata['password'] = md5(md5(I("newpassword")));
                $mem['password'] = md5(md5($_POST['password']));
                $mem['pwd'] = I('newpassword');
                $info = $user
                        ->where("username='" . $username . "' and password='" . $data['password'] . "'")
                        ->find();
                if ($info) {

                        $save = $user->where("username='" . $username . "'")->save($newdata);


                        if ($save) {
                                if ($info['flag'] == 1) {
                                        $memb = M("company");
                                } else {
                                        $memb = M("member");
                                }
                                $vic = $memb
                                        ->where("username='" . $username . "'")
                                        ->save($mem);
                                echo json_encode(array("code" => 200, "msg" => "ok"));
                        } else {
                                echo json_encode(array("code" => 500, "msg" => "新旧密码一致"));
                                exit();
                        }
                } else {
                        echo json_encode(array("code" => 500, "msg" => "原密码输入有误"));
                        exit();
                }
        }

        function savepass() {
                $arCompany = $this->getIndexContent();
                if (!empty($_SESSION['username'])) {
                        $this->username = $_SESSION['username'];
                }
                $this->comp = $arCompany[0];
                $this->comp2 = $arCompany[1];
                $this->display();
        }

        function findpass() {
                $user = M('userinfo', 'stj_', 'DB_CONFIG1');
                $username = $_SESSION['username'];
                $password = md5(md5(I("password")));
                $info = $user
                        ->where("username='" . $username . "' and password='" . $password . "'")
                        ->find();
                if ($info) {
                        echo "cz";
                } else {
                        echo "bcz";
                }
        }

        function ReceivAccount() {
                $mem = M('member', 'stj_', 'DB_CONFIG1');
                $username = $_SESSION['username'];
                $info = $mem->field("bankname,banknumber")->where("username='" . $username . "'")->find();
                $this->info = $info;
                $this->assign("first_class", 4);
                $this->assign("second_class", 11);
                $this->display();
        }

        //修改收款账号信息
        function SetBanksInfo() {
                $mem = M('member', 'stj_', 'DB_CONFIG1');
                $username = $_SESSION['username'];
                $bank['bankname'] = I("bankname");
                $bank['banknumber'] = I("banknumber");

                $saveback = $mem->where("username='" . $username . "'")->save($bank);
                $sql = "update stj_member set remind_bank=1 where username='$username'";
                $mem->query($sql);
                echo json_encode(array("code" => 200, "msg" => "ok"));
                exit();
                if ($saveback) {
                        $saveback = $mem->where("username='" . $username . "'")->save(array("remind_bank" => 1));
                        echo json_encode(array("code" => 200, "msg" => "ok"));
                        exit();
                } else {
                        echo json_encode(array("code" => 500, "msg" => "保存错误"));
                }
        }

        function MyPosition() {

                $count = M("job_collection")->where("username='$_SESSION[username]' and status =1")->count();

                $page = new \Think\Page($count, self::$_size);

                $arCollectList = M("job_collection")->where("username='$_SESSION[username]' and status =1")->order("id desc")->limit($page->firstRow, $page->listRows)->select();
                $show = $page->show();
                $i = (($_GET['p'] ? $_GET['p'] : 1) - 1) * self::$_size + 1;
                foreach ($arCollectList as &$arCollectInfo) {

                        $arCollectInfo['cpname'] = M("company")->where("id='$arCollectInfo[cpid]'")->getField("cpname");
                        $arCollectInfo['count'] = M("record")->where("j_id=" . $arCollectInfo['j_id'] . "")->count();
                        $arCollectInfo['endtime'] = date("Y-m-d", $arCollectInfo['endtime']);
                        $arCollectInfo['sort_id'] = $i++;
                }
                $this->assign("first_class", 3);
                $this->assign("second_class", 10);
                $this->arCollectList = $arCollectList;
                $this->assign("page", $show);
                $this->display();
        }

        //删除候选人
        function delResume() {
                $id = intval($_POST['resume_id']);
                $username = $_SESSION['username'];
                $userInfo = M("member")->where("username = '" . $username . "'")->find();
                $isDelete = M("resume")->where("t_id='" . $userInfo['id'] . "' and id='$id'")->find();
                $isRecord = M('record')->where("bt_id=" . $id . "")->find();
                if (empty($isDelete)) {
                        echo json_encode(array("code" => 500, "msg" => "长时间未操作，请重新登录后再试！"));
                        exit();
                }
                if (empty($isRecord)) {
                        $data['isshow'] = 0;
                        $isshow = M('resume')->where("id=" . $id . "")->save($data);
                        echo json_encode(array("code" => 200, "msg" => "ok！"));
                        exit();
                } else {
                        echo json_encode(array("code" => 500, "msg" => "此简历已经被推荐，无法删除"));
                        exit();
                }
        }

        function edit() {
                $id = I('id');
                $resume = M('resume', 'stj_', 'DB_CONFIG1');
                $record = M('record', 'stj_', 'DB_CONFIG1');
                $iscz = $record
                        ->where("bt_id=" . $id . "")
                        ->select();

                if (empty($iscz)) {
                        echo "bianji";
                } else {
                        echo "yi";
                }
        }

        //添加简历
        public function ModifyRencom() {
                $id = ((intval($_GET['id']) > 0) ? $_GET['id'] : 0);
                if ($id > 0) {
                        $resumeInfo = M("resume")->where("id=$id")->find();
                        if ($resumeInfo['wordname']) {
                                $type = 1;
                        } else {
                                $type = 2;
                        }

                        $resumeInfo['uploadUrl'] = M("uploads")->where("name='$resumeInfo[wordname]'")->getField("path");
                        $sFilePath = "/Uploads/word/" . $resumeInfo[wordname];
                        if (file_exists($sFilePath)) {
                                $resumeInfo['upload'] = $sFilePath;
                        } else {
                                $r = M("uploads")->where("name='$resumeInfo[wordname]'")->find();

                                if (!empty($r)) {
                                        $resumeInfo['upload'] = $r['path'];
                                }
                        }

                        if ($resumeInfo['upload']) {
                                $arUploadTmp = explode($resumeInfo[wordname], $resumeInfo['upload']);
                                $resumeInfo['updateFile'] = $resumeInfo[wordname];
                                $resumeInfo['updatePath'] = $arUploadTmp[0];
                                $resumeInfo['updateName'] = $resumeInfo['username'] . "--" . $resumeInfo[wordname];
                        }
                        // $resumeInfo['upload'] = M("uploads")->where("name='$resumeInfo[wordname]'")->getField("path");
                        //工作经验
                        $resumeInfo['workexper'] = M("workexper")->where("keyid='$resumeInfo[keyid]'")->getField("intro");

                        //教育经历
                        $resumeInfo['education'] = M("education")->where("keyid='$resumeInfo[keyid]'")->getField("content");

                        //自理证书
                        $resumeInfo['cercate'] = M("cercate")->where("keyid='$resumeInfo[keyid]'")->getField("zhengshu");

                        $userInfo = M("member")->where("username='" . $_SESSION['username'] . "' ")->find();
                        if ($resumeInfo[t_id] != $userInfo['id']) {
                                $resumeInfo = false;
                        }
                } else {
                        $type = 2;
                }

                if ($_GET['addtype'] == 1) {
                        $type = 1;
                }

                $zzstatus = M("cascadedata")->where("datagroup='zzstart'")->select();

                $isNewUser = "保存";
                if ($_SESSION['recommend_comid'] && $_SESSION['recommend_jobid']) {
                        $userinfo = M("member")->where("username='" . $_SESSION['username'] . "'")->find();
                        $count = M("resume")->where("t_id='$userinfo[id]' and isshow =1")->count();
                        if ($count == 0) {
                                $isNewUser = "立即推荐";
                        }
                }

                $dqData = M("casclist")->where("parentid=19")->order("orderid asc")->select();
                $this->assign("dqData", $dqData);
                $matchResume = M("match_resume")->where("t_id='$resumeInfo[t_id]' and bt_id ='$id'")->find();
                $this->assign("matchResume", $matchResume);
                $this->assign("isNewUser", $isNewUser);
                $this->assign("resumeInfo", $resumeInfo);
                $this->assign("zzstatus", $zzstatus);
                $this->assign("type", $type);
                $this->assign("first_class", 2);
                $this->assign("second_class", 4);
                $this->display();
        }

        public function random($length = 6, $numeric = 0) {
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

        public function getCode() {

                $target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit";
                $mobile_code = $this->random(4, 1);
                $_SESSION['check_code'] = $mobile_code;
                $mobile = $_POST['telephoneCheck'];

                if (!$mobile) {
                        //防用户恶意请求
                        echo json_encode(array("code" => 500, "msg" => "手机号格式不正确"));
                        exit();
                }
                $isExit = M("member")->where("mobile ='" . $mobile . "'")->find();
                if ($isExit) {
                        echo json_encode(array("code" => 500, "msg" => "此手机号已经存在系统中！"));
                        exit();
                }
                $post_data = "account=cf_zpkj&password=840a6d63c511f5b0a61afc7352c207f3&mobile=" . $mobile . "&content=" . rawurlencode("您的验证码是：" . $mobile_code . "。请不要把验证码泄露给其他人。");
//密码可以使用明文密码或使用32位MD5加密
//840a6d63c511f5b0a61afc7352c207f3
                $gets = $this->xml_to_array($this->Post($post_data, $target));
                if ($gets['SubmitResult']['code'] == 2) {
                        $_SESSION['mobile_code'] = $_SESSION['check_code'];
                        echo json_encode(array("code" => 200, "msg" => $_SESSION['check_code']));
                        exit();
                } else {
                        echo json_encode(array("code" => 500, "msg" => "系统繁忙，请稍候再试"));
                        exit();
                }
        }

        public function checkCode() {
                $code = $_POST['code'];
                if ($code == $_SESSION['mobile_code']) {
                        echo json_encode(array("code" => 200, "msg" => $code));
                        exit();
                } else {
                        echo json_encode(array("code" => 500, "msg" => "验证码错误"));
                        exit();
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

        public function userSaveInfo() {
                $data = $_POST;

                if (!$data['strycate'] || $data['strycate'] == "请选择行业") {

                        $data['strycate'] = $data['strycate1'];
                }
                if (!$data['Jobcate'] || $data['Jobcate'] == "请选择职位") {
                        $data['Jobcate'] = $data['Jobcate1'];
                }
                if (!$data['area'] || $data['area'] == "请选择市") {
                        $data['area'] = $data['area1'];
                }


                $data['token_exptime'] = strtotime($data['date']);
                unset($data['strycate1']);
                unset($data['Jobcate1']);
                unset($data['area1']);
                unset($data['date']);
                M("member")->where("username='" . $_SESSION['username'] . "'")->save($data);

                $this->success("保存成功", U('Login/RecoSettings'));
        }

        public function checkSelectUser() {
                $jid = $_POST['jid'];
                $cid = $_POST['cid'];
                $userid = M("member")->where("username='" . $_SESSION['username'] . "'")->getField("id");
                $count = M("record")->where("j_id='$jid' and t_id='$userid'")->count();
                echo $count;
        }

        public function getuserinfos() {
                $memberInfo = M("member")->where("username='$_SESSION[username]'")->find();

                if (!$memberInfo['cnname'] || !$memberInfo['mobile']) {
                        echo json_encode(array("code" => 500, "msg" => "您的手机号未填写，请完善后再添加被推荐人", "url" => "userinfo"));
                        exit();
                } elseif (!$memberInfo['intro']) {
                        echo json_encode(array("code" => 500, "msg" => "您的自我介绍未完善，请完善后再添加被推荐人", "url" => "ziwojieshao"));
                        exit();
                } else {
                        echo json_encode(array("code" => 200));
                        exit();
                }
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

        public function MyJobSearch() {
                $count = M("search_collection")->where("username='$_SESSION[username]' and status =1")->count();
                $page = new \Think\Page($count, self::$_size);
                $arCollectList = M("search_collection")->where("username='$_SESSION[username]' and status =1")->order("id desc")->limit($page->firstRow, $page->listRows)->select();
                $show = $page->show();
                $i = (($_GET['p'] ? $_GET['p'] : 1) - 1) * self::$_size + 1;
                foreach ($arCollectList as &$arCollectInfo) {
                        $arCollectInfo['sort_id'] = $i++;
                        $title = "";

                        if ($arCollectInfo['title']) {
                                $title .=$arCollectInfo['title'] . "+";
                        }
                        if ($arCollectInfo['industrydata']) {
                                $title .=$arCollectInfo['industrydata'] . "+";
                        }
                        if ($arCollectInfo['positiondata']) {
                                $title .=$arCollectInfo['positiondata'] . "+";
                        }
                        if ($arCollectInfo['areadata']) {
                                $title .=$arCollectInfo['areadata'] . "+";
                        }
                        if ($arCollectInfo['treatmentdata']) {
                                $title .=$arCollectInfo['treatmentdata'] . "+";
                        }
                        if ($arCollectInfo['puttimedata']) {
                                $title .=$arCollectInfo['puttimedata'] . "+";
                        }
                        $arCollectInfo['searchdata'] = trim($title, "+");
                }

                $this->assign("first_class", 3);
                $this->assign("second_class", 9);
                $this->assign("arCollectList", $arCollectList);
                $this->assign("page", $show);
                $this->display();
        }

        public function deleteSearchCollect() {
                $id = $_POST['id'];
                $res = M("search_collection")->where("username='$_SESSION[username]' and id='$id'")->delete();

                if ($res) {
                        echo json_encode(array("code" => 200, "msg" => "删除成功"));
                        exit();
                } else {
                        echo json_encode(array("code" => 500, "msg" => "删除失败"));
                        exit();
                }
        }

        //我的资金明细
        public function DetailsFunds() {
                $username = $_SESSION['username'];
                $count = M("account_blance")->where("username='$username'")->count();
                $page = new \Think\NewPage($count, 15);
                $arAccountList = M("account_blance")->where("username='$username' ")->order("id desc")->limit($page->firstRow, $page->listRows)->select();
                $show = $page->show();
                $i = (($_GET['p'] ? $_GET['p'] : 1) - 1) * 15 + 1;
                foreach ($arAccountList as &$arAccountInfo) {
                        $arAccountInfo['sort_id'] = $i++;
                        $arAccountInfo['updated_at'] = date("Y.m.d", $arAccountInfo['updated_at']);
                }
                $accountInfo = M("member")->field("bankname,banknumber,remind_member")->where("username='$username'")->find();

                $isFinishBank = 1;
                if (!$accountInfo['bankname'] || $accountInfo['bankname'] = "" || !$accountInfo['banknumber'] || $accountInfo['bankname'] = "") {

                        $isFinishBank = 0;
                }
                $act = trim($_GET['act']);

                $userAccount = M("account")->where("username='$username'")->find();
                $this->assign("isFinishBank", $isFinishBank);
                $this->assign("userAccount", $userAccount);
                $this->assign("userAccountInfo", $accountInfo);
                $this->assign("act", $act);
                $this->assign("page", $show);
                $this->assign("arAccountList", $arAccountList);
                $this->assign("first_class", 5);
                $this->assign("second_class", 12);
                $this->display("new_money");
                //  $this->display("");
        }

        //修改是否已经审核过账号信息
        public function RemindMember() {
                $username = $_SESSION['username'];
                M("member")->where("username='$username'")->save(array("remind_member" => 1));
                echo 1;
        }

        public function EnchashmentDetail() {
                $username = $_SESSION['username'];
                $moneyInput = $_POST['moneyInput'];
                $userinfo = M("member")->where("username='$username' and checkinfo='true'")->find();
                if (empty($userinfo)) {
                        echo json_encode(array("code" => 500, "msg" => "用户不存在或者被禁用！"));
                        exit();
                }
                //查询提现记录总金额
                $sql = "select sum(account) as total from stj_enchashment where status =1  and username='$username'";
                $Enchashment = M("enchashment")->query($sql);

                $EnchashmentAccount = intval($Enchashment[0]['total']);
                //查询当前用户账户总金额
                $arUserAccount = M("account")->where("username='$username'")->find();
                $uasrAccount = $arUserAccount['account'];

                if (($EnchashmentAccount + $moneyInput) > $uasrAccount) {
                        echo json_encode(array("code" => 500, "msg" => "当前账户不足，或已有提款记录未处理！"));
                        exit();
                } else {
                        $arrEnchashment = array();
                        $arrEnchashment['uid'] = $arUserAccount['uid'];
                        $arrEnchashment['username'] = $username;
                        $arrEnchashment['last_account'] = $uasrAccount;
                        $arrEnchashment['account'] = $moneyInput;
                        $arrEnchashment['status'] = 1;
                        $arrEnchashment['created_at'] = $arrEnchashment['updated_at'] = time();
                        M("enchashment")->add($arrEnchashment);
                        $account_blance_sql = "insert into stj_account_blance(uid,username,last_account,account,incr,operat,`from`,comment,created_at,updated_at) value"
                                . "({$arUserAccount['uid']},'{$username}',{$uasrAccount},{$uasrAccount}-{$moneyInput},'-{$moneyInput}','','enchashmentask','提现申请中'," . time() . "," . time() . ")";
                        M("account_blance")->query($account_blance_sql);
                        echo json_encode(array("code" => 200, "msg" => "提现成功！"));
                }
        }

        public function isNewUser() {

                $isNewUser = 1;
                if ($_SESSION['recommend_comid'] && $_SESSION['recommend_jobid']) {
                        $userinfo = M("member")->where("username='" . $_SESSION['username'] . "'")->find();
                        $count = M("resume")->where("t_id='$userinfo[id]' and isshow =1")->count();
                        $Recordtype = $_POST['Recordtype'];
                        if (($count == 0) || ($Recordtype == 1)) {
                                $isNewUser = 2;
                        }
                }
                echo $isNewUser;
        }

        public function comment() {
                $id = intval($_POST['id']);
                $content = trim($_POST['content']);
                $recordInfo = M("record")->where("id='$id'")->find();
                $userInfo = M("member")->where("id=" . $recordInfo['t_id'])->find();
                if (empty($recordInfo) || empty($userInfo)) {
                        echo json_encode(array("code" => 500, "msg" => "参数错误"));
                        exit();
                }
                $jobInfo = M("job")->where("id=" . $recordInfo['j_id'])->find();
                $comInfo = M("company")->where("id=" . $jobInfo['cpid'])->find();
                $isComment = M("evaluate")->where("uid=" . $recordInfo['t_id'] . " and pid=" . $id)->find();

                if (empty($isComment)) {

                        $evaluate = array();
                        $evaluate['uid'] = $userInfo['id'];
                        $evaluate['username'] = $userInfo['username'];
                        $evaluate['loginip'] = $_SERVER["REMOTE_ADDR"];
                        $evaluate['pid'] = $id;
                        $evaluate['j_id'] = $recordInfo['j_id'];
                        $evaluate['tag'] = "record";
                        $evaluate['pname'] = $comInfo['cpname'];
                        $evaluate['content'] = $content;
                        $evaluate['checkinfo'] = "true";
                        $evaluate['created_at'] = $evaluate['updated_at'] = time();

                        M("evaluate")->add($evaluate);
                        echo json_encode(array("code" => 200, "msg" => "评价成功，感谢您的评价！"));
                        exit();
                } else {
                        echo json_encode(array("code" => 500, "msg" => "您已经评价过该职位！"));
                        exit();
                }
        }

        public function isComplatdUser() {
                $username = $_SESSION['username'];
                $userInfo = M("member")->where("username='$username'")->find();
                if ($userInfo['mobile']) {
                        echo json_encode(array("code" => 200, "msg" => "ok"));
                        exit();
                } else {
                        echo json_encode(array("code" => 500, "msg" => "error"));
                        exit();
                }
        }

        public function changePassword() {
                $username = $_SESSION['username'];
                if (!$username) {
                        echo json_encode(array("code" => 500, "msg" => "您长时间未操作，已登录超时，若想继续操作，请重新登录！"));
                        exit();
                }

                $data['opassword'] = md5(md5(I("opassword")));
                $newdata['password'] = md5(md5(I("password")));
                $newdata['pwd'] = I('password');
                $userinfo = M("member")->where("username='$username' and password='" . $data['opassword'] . "'")->find();
                if (empty($userinfo)) {
                        echo json_encode(array("code" => 500, "msg" => "您输入的旧密码有误，请重新输入！"));
                        exit();
                }
                M("member")->where("username='$username'")->save($newdata);

                M("userinfo")->where("username='$username' and flag=1")->save(array("password" => $newdata['password']));

                echo json_encode(array("code" => 200, "msg" => "恭喜您，修改成功！"));
                exit();
        }

}
