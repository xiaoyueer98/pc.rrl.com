<?php namespace Home\Api;
use Think\Controller;

class WebChatApi extends Controller
{
    /*
     * 取出最新的职位
     */
    public function new_job_list(){
        $stjjobModel = D('Job');
        $array = $stjjobModel->new_job_list();
		return $array;
    }


}
