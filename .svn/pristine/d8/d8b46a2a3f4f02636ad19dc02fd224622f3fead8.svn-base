<?php
namespace Home\Controller;
use Think\Controller;
class CompanydetailsController extends	Controller {

    /*
     * 公司详情
     */
    public function company(){
		$CompanyModel = D('Company');
		$id = I('get.id');
		$result = $CompanyModel->where("id=" . $id )
				->find();
		$this->assign("result",$result);


		$map['com.id'] = $id;
		$return_data = $CompanyModel ->table( 'stj_job job' ) 
				->field('job.title,com.cpname,job.treatment,cas.cascname,job.experience,job.Tariff,com.id as cpid,job.id')
				->where($map)
				->join( 'stj_company com ON job.cpid = com.id' )
				->join( 'stj_casclist cas ON job.jobplace = cas.id' )
				->order( 'job.starttime desc' )
				->limit('0,20')
				->select();
		$this->assign("return_data",$return_data);

		$this->display ( "./Webchat/company_details" );
    }
}


