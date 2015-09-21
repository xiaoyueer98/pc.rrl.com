<?php

/*
 * ְJobCollectionModel
 */

namespace Home\Model;

use Think\Model;

class JobCollectionModel extends Model {
        /*
         * 获取最新职位列表
         * @param  
         * @return array
         */

        public function fav_job_count($uid) {
                $WebChatModel = M("stj_job_collection");

                $sql = "select count(*) as num from stj_job_collection job  where status=1 and uid=" . $uid;
                $countArr = $WebChatModel->query($sql);

                return $countArr[0]['num'];
        }

        /*
         * 获取收藏职位列表
         * @param  
         * @return array
         */

        public function fav_job_list($uid, $limit) {

                $sql = "select * from stj_job_collection job  where  uid=$uid  and status=1 order by created_at desc limit $limit";
                $return_data = $this->table('stj_job_collection job')->query($sql);
                //echo "<pre>";var_dump($return_data);echo"</pre>";
                //得到岗位名称信息
                foreach ($return_data as $k => $v) {

                        $return_data[$k]['id'] = $return_data[$k]['j_id'];

                        $com_sql = "select com.cpname,com.id cpid from stj_company com where  com.id=" . $v['cpid']; //关联公司信息
                        $recommended_sql = "select count(*) as num from stj_record where stj_record.j_id = {$v['j_id']}"; //查找该职位已推荐人数
                        ///echo $cas_sql;

                        $return_data_com = $this->table('stj_company com')->query($com_sql);
                        $recommendedArr = $this->table('stj_record')->query($recommended_sql);

                        foreach ($return_data_com[0] as $k1 => $v1) {
                                $return_data[$k][$k1] = $v1;
                        }

                        $return_data[$k]['recommendednum'] = $recommendedArr[0]['num'];
                        $return_data[$k]['starttimedata'] = timeFormat($return_data[$k]['starttime'], $format = 'Y-m-d');
                        $return_data[$k]['posttimedata'] =  timeFormat($return_data[$k]['posttime'], $format = 'Y-m-d');
                        $return_data[$k]['posttimedata'] = (($return_data[$k]['checktime'] != 0) ? timeFormat($return_data[$k]['checktime'], $format = 'Y-m-d') : timeFormat($return_data[$k]['starttime'], $format = 'Y-m-d'));

                        //查找审核状态和是否被删除状态是否有变动
                        $job_sql = "select * from stj_job  job where job.id=" . $return_data[$k]['id'];
                        $return_data_job = $this->table('stj_job job')->query($job_sql);
                        
                        $audstart_sql = "select count(*) as num from stj_record where stj_record.j_id = {$v['j_id']} and audstart=6"; //查找该职位已招到人数
                        $audstartArr = $this->table('stj_record')->query($audstart_sql);
                        
                       //得到 薪资待遇 数据
                        $arTreatmentdata                  = explode("-", str_replace("元", "", $return_data[$k]['treatmentdata']));
                          if(count($arTreatmentdata) ==1){
                            $return_data[$k]['treatmentdata'] = "80K以上";
                        }else{
                             $return_data[$k]['treatmentdata'] = ($arTreatmentdata[0] / 1000) . "K-" . ($arTreatmentdata[1] / 1000) . "K";
                        }
                        //$return_data[$k]['treatmentdata'] = ($arTreatmentdata[0] / 1000) . "K-" . ($arTreatmentdata[1] / 1000) . "K";
                        //判断是否已经过期或者已经招满或者变成审核失败或者已经删除
                        if ($audstartArr[0]['num'] >= $return_data[$k]['employ'] || $return_data[$k]['endtime'] < time() || $return_data_job[0]['checkinfo'] == "false" || $return_data_job[0]['is_deleted'] == "1" || $return_data_job[0]['Tariff'] == null) {
                                $return_data[$k]['deadline'] = 1;
                        }
                }
                //var_dump($return_data);
                return $return_data;
        }

}

?>