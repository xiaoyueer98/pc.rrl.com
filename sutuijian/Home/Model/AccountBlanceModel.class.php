<?php

/*
 * ְAccountBlanceModel
 */

namespace Home\Model;

use Think\Model;

class AccountBlanceModel extends Model {
    
    /*
     * 获取最新职位数据总条数
     * @param  
     * @return int
     */

	public function my_account_count($uid)
                {

                        $acOb = M('account_blance');
                        return $acOb -> where('uid='.$uid) -> count();
                 
                }    

    /*
     * 获取最新职位列表
     * @param  
     * @return array
     */

	public function my_account_list($uid,$limit)
		{
                        $return_data = $this -> table('stj_account_blance')
                                             -> where('uid='.$uid)
                                             -> limit($limit)
                                             -> order('id desc')
                                             -> select();  
                     
                        //echo "<pre>";var_dump($return_data);echo"</pre>";
                        
                        //得到岗位名称信息
                        foreach($return_data as $k=>$v){
                                $return_data[$k]['created_at'] = date("Y-m-d",$return_data[$k]['created_at']);
                                $com_sql = "select com.cpname,com.id cpid from stj_company com where  com.id=".$v['cpid'];//关联公司信息
                                $cas_sql = "select cas.cascname from stj_casclist cas where cas.id=".$v['jobplace'];//关联casclist
                                
                                $return_data_com = $this ->table( 'stj_company com' ) ->query($com_sql);
                                //echo"<pre>";var_dump($return_data_com);echo"</pre>";
                                $return_data_cas = $this ->table( 'stj_casclist cas' ) ->query($cas_sql);
                                //echo"<pre>";var_dump($return_data_cas);echo"</pre>";
                                
                                foreach($return_data_com as $k1 => $v1){
                                        $return_data[$k][$k1] = $v1;
                                }
                                foreach($return_data_cas as $k1 => $v1){
                                        $return_data[$k][$k1] = $v1;
                                }
                                
                                

                        }
			return $return_data;
		}
                
}

?>