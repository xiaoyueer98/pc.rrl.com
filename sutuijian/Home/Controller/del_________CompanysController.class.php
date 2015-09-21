<?php

namespace Home\Controller;

use Think\Controller;
use Think\Upload; 
header("Content-type: text/html; charset=utf-8");

class CompanysController extends Controller {
	//添加职位 页面
    public function companySendJob(){
		$jobInfo = $this->getJobInfo();
		$this->assign("jobInfo", $jobInfo);
        $this->display('Company/company_send_job');
    }
	// 添加职位  处理
	public function companySendJobAdd(){
		$company = $this->getCompanyInfo();
		$data = $_POST;
		$data['starttime'] = time();
		$data['endtime']   = strtotime($data['endtime']);
		$data['cpid']      = $company['id']; 
		$res  = M("job")->add($data);
		if($res){
			$this->success("",U('Companys/companyJobList'));
		}else{
			$this->success("",U('Companys/companyJobList'));
		}
	}
	//正在招聘职位列表
	public function companyJobList(){
		$today = strtotime(date("Y-m-d"));
		$List = $this->getJobList("and endtime > $today");
		$this->assign("list",$List);
		$this->display('Company/company_job_list');
	}

	//往期招聘职位列表
	public function beforeCompanyJobList(){
		$today = strtotime(date("Y-m-d"));
		$List = $this->getJobList("and endtime < $today");
		$this->assign("list",$List);
		$this->display('Company/company_job_list');
	}
	//删除职位
	public function deleteJob(){
		$jobId = I("id");
		$data['id']  = $jobId;
		$data['is_deleted'] = 1;
		$res = M("job")->save($data);
		if($res){
			$this->success("",U('Companys/companyJobList'));
		}else{
			$this->success("",U('Companys/companyJobList'));
		}
	}
	//代付账单
	public function toBePaid(){
		$pay = $this->getPayment("and sink = 1");
		$this->assign("list", $pay);
		$this->display('Company/to_be_payed');
	}
	//付款记录
	public function paymentRecords(){
		$pay = $this->getPayment("and sink = 2");
		$this->assign("list", $pay);
		$this->display('Company/payment_records');
	}
	//获取付款记录
	private function getPayment($where){
		$company = $this->getCompanyInfo();
		$cpid    = $company['id'];
		$jobList = M("job")->field("id")->where("cpid = '$cpid'")->select();
		if($jobList){
			foreach($jobList as $job){
				$jobs[] = $job['id'];
			}
		}
		$jobids  = implode(',',$jobs).",44";
		$count   = M("record")->where("j_id in ($jobids) and status = 2 $where")->count();
		$page    = new \Think\Page($count,8);
		$limit   = $page->firstRow."，".$page->listRows;
		$payList = M("record")->where("j_id in ($jobids) and status = 2 $where")->order("id desc")->limit($page->firstRow,$page->listRows)->select();
		$show    = $page->show();
		if($payList){
			foreach($payList as $key=>$pay){
				$job    = M("job")->where("id = '".$pay['j_id']."'")->find();
				$tname  = M("member")->field("cnname")->where("id = '".$pay['t_id']."'")->find();
				$btname = M("member")->field("cnname")->where("id = '".$pay['bt_id']."'")->find();
				$input  = M("")->field("")->where("")->find();
				$payList[$key]['tname']  = $tname['cnname'];
				$payList[$key]['btname'] = $btname['cnname'];
				$payList[$key]['Jobcate']= $job['Jobcate'];
				$payList[$key]['Tariff'] = $job['Tariff'];
 			}
		}
		return array("payList"=>$payList,"page"=>$show);
	}
	//获取职位列表
	private function getJobList($where){
		$company = $this->getCompanyInfo();
		$cpid    = $company['id'];
		$count   = M("job")->where("cpid = '$cpid' and is_deleted = 0 $where")->count();
		$page    = new \Think\Page($count,1);
		$limit   = $page->firstRow."，".$page->listRows;
		$jobList = M("job")->where("cpid = '$cpid' and is_deleted = 0 $where")->order("id desc")->limit($page->firstRow,$page->listRows)->select();
		if($jobList){
			foreach($jobList as $key=>$job){
				$jobid = $job['id'];
				$jobList[$key]['endtime'] = date("Y.m.d",$job['endtime']);
				$jobList[$key]['status']  = $job['checkifno']?"通过审核":"未通过审核";
				$total  = M("record")->where("j_id = '$jobid'").count();
				$noread = M("resume")->where("j_id = '$jobid' and news_status = 0 ").count();
				$jobList[$key]['total']   = $total?$total:0;
				$jobList[$key]['noread']  = $noread?$noread:0;
 			}
		}
		$show    = $page->show();
		return array("jobList"=>$jobList,"page"=>$show);
	}

    //获取企业信息
    public function getCompanyInfo()
    {
        $objComany = M("company");
        if (!$_SESSION['username'])
        {
            $this->error("您长时间未操作，请重新登录", U('Index/index'));
            exit();
        }
        $arCompanyInfo = $objComany->where("username='" . $_SESSION['username'] . "'")->find();

        if (empty($arCompanyInfo))
        {
            $this->error("非法操作，请重新登录", U('Index/index'));
            exit();
        }
        return $arCompanyInfo;
    }
	public function getJobInfo()
    {
        $objCascade       = M("cascade");
        $arConfigBaseInfo = $objCascade->where("groupsign IN ('treatment', 'area', 'experience', 'education', 'joblang')")->select();

        if ($arConfigBaseInfo)
        {
            $objCascadedata = M("cascadedata");
            foreach ($arConfigBaseInfo as &$arrBaseInfo)
            {
                $arConfigInfo = $objCascadedata->where("`datagroup` = " . "'" . $arrBaseInfo['groupsign'] . "'")->order("orderid asc")->select();
                if ($arConfigInfo)
                {
                    $arrBaseInfo['config_list'] = $arConfigInfo;
                }
            }
        }
        return $arConfigBaseInfo;
    }
    //获取配置信息 公司性质 : 公司规模 : 公司阶段 
    public function getConfigInfo()
    {

        $objCascade       = M("cascade");
        $arConfigBaseInfo = $objCascade->where("groupsign IN ('nature','scale','stage')")->select();

        if ($arConfigBaseInfo)
        {
            $objCascadedata = M("cascadedata");
            foreach ($arConfigBaseInfo as &$arrBaseInfo)
            {
                $arConfigInfo = $objCascadedata->where("`datagroup` = " . "'" . $arrBaseInfo['groupsign'] . "'")->order("orderid asc")->select();
                if ($arConfigInfo)
                {
                    $arrBaseInfo['config_list'] = $arConfigInfo;
                }
            }
        }
        return $arConfigBaseInfo;
    }

    public function saveCompanyBaseInfo()
    {
        $company = M('company','stj_','DB_CONFIG1');
        $data['username'] = $_SESSION['username'];
        $data['cpname'] = $_POST['cpname'];
        $data['nature'] = $_POST['nature'];
        $data['scale']  = $_POST['scale'];
        $data['stage']  = $_POST['stage'];
        $data['brightreg']   = strtotime($_POST['date']);
        $setting = array(  
            'mimes' => '', //允许上传的文件MiMe类型  
            'maxSize' => 6 * 1024 * 1024, //上传的文件大小限制 (0-不做限制)  
            'exts' => "jpg,jpeg,gif", //允许上传的文件后缀  
            'autoSub' => true, //自动子目录保存文件  
            'subName' => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组  
            'rootPath' => './Uploads/', //保存根路径  
            'savePath' => '', //保存路径  
        );  
        /* 调用文件上传组件上传文件 */  
        //实例化上传类，传入上面的配置数组  
        $this->uploader = new Upload($setting, 'Local');  
        $info = $this->uploader->upload($_FILES); 
        if ($info) {  
            $data['comlogo'] = $setting['rootPath'] . $info['comlogo']['savepath'] . $info['comlogo']['savename'];
            $data['licence'] = $setting['rootPath'] . $info['licence']['savepath'] . $info['licence']['savename'];
            //这里可以输出一下结果,相对路径的键名是$info['upload']['filepath']  
        } else {  
            //输出错误信息  
            exit($this->uploader->getError());  
        }
        $data['thumlogo'] = $data['comlogo'];
        print_r($data);
        $res = $company->where("username='".$data['username']."'")->save($data);
       
        echo json_encode();
        //echo json_encode(array("success"=>$res));
    }
public function EnterpriseInformsation()
    {
        $arCompanyInfo = $this->getCompanyInfo();
        echo 123;
        if (!$arCompanyInfo['cpname'])
        {
            $sIsNewCompay = true;
        }
        else
        {
            $sIsNewCompay = false;
        }
        $arConfigInfo = $this->getConfigInfo();
        $this->assign("arConfigInfo", $arConfigInfo);
        $this->assign("sIsNewCompay", $sIsNewCompay);
        //$this->display('Company/company_base_info');

        // $this->display();
    }
}