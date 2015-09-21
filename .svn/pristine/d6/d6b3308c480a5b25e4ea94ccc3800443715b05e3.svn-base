<?php
namespace Home\Controller;
use Think\Controller;

/**
 * 前端页面 类文件 
 * 
 * @author      sunyue<1551058861@qq.com> 
 * @since       1.0 
 */
class HtmlController extends Controller {

        public function __construct() {

                parent::__construct();
                $linkArr = M("friendlink") -> where("status=0")->order("orderid desc,id asc")->select();
                $this ->assign("linkArr",$linkArr);
        }

}
