<?php

namespace Home\Controller;

use Think\Controller;

class WebchatcompanyController extends Controller {

        public function __construct() {
                //判断如果不是从微信端访问微信页面则跳转到对应端的首页
                from_to_weixin();
                parent::__construct();
        }

        /*
         * 公司详情
         */

        public function company_detail() {

                $id = $_GET['id'];
                if (empty($id)) {
                        header("location:/Home/Webchat/new_job");
                        exit();
                }
                $Jobcatedata = $_GET['Jobcatedata'];
                $strycatedata = $_GET['strycatedata'];
                $WxComModel = D('company');
                $result = $WxComModel->get_detail($id);
                $result['Jobcatedata'] = $Jobcatedata;
                $result['strycatedata'] = $strycatedata;
                //得到热招职位
                $return_job = $WxComModel->get_hot_job($id);

                $this->assign("result", $result);
                $this->assign("empty", '<div class="resultjobs clearfix" style="font-size:17px;text-align:center;line-height:50px;">暂时没有数据</div>');
                $this->assign("return_job", $return_job);
                $this->display("./Webchat/company_details");
        }

}
