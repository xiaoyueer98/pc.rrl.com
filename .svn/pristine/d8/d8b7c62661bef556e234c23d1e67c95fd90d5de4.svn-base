<?php

namespace Home\Model;

use Think\Model;

class ShareInfoModel extends Model {


                function get_info($tag = "") {
                        if ($tag) {
                                $arShare = M("share_info")->where("tag='{$tag}' and status=1")->order("id desc")->find();
                                if ($arShare) {
                                        return $arShare;
                                }
                        }
                        return array();
                }


}

?>