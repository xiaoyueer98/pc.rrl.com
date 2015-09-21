<?php if (!defined('THINK_PATH')) exit(); if(!empty($arJobList)):?>
<div class="job-list">
    <?php foreach($arJobList as $jobInfo):?>
    <div class="clearfix list">
        <span class="np-logo dis-block dis-inlin fl-lef">
            <?php if($jobInfo['type'] == 2):?>
            <img src="/Public/img/company_logo/bmkh.png" alt="" width="50px" height="50px">
            <?php else:?>
            <img src="<?php echo $jobInfo['thumlogo'];?>" alt="" width="50px" height="50px">
            <?php endif;?>
        </span>
        <ul class="r fl-rig">
            <li class="clearfix li1">
                <a href="/Home/Index/EnterIndex2/comid/<?php echo $jobInfo['cpid'];?>/jobid/<?php echo $jobInfo['guid'];?>.html" target="_blank"><em class="dis-inlin dis-block fl-lef"><?php echo $jobInfo['title'];?></em></a>
                <span class="adrs dis-inlin dis-block fl-lef">[<?php echo $jobInfo['jobplace'];?>]</span>
                <a href="/Home/Index/EnterIndex/comid/<?php echo $jobInfo['cpid'];?>.html" target="_blank"><h6 class="dis-inlin dis-block fl-rig"><?php echo $jobInfo['cpname'];?></h6></a>
            </li>
            <li class="clearfix li2">
                <!-- <span class="dis-inlin dis-block fl-lef">月薪：</span> -->
                <span class="dis-inlin dis-block fl-lef"><?php echo $jobInfo['treatment'];?></span>
                <span class="dis-inlin dis-block fl-lef"><?php echo $jobInfo['experience'];?></span>
                <span class="dis-inlin dis-block fl-lef"><?php echo $jobInfo['education'];?></span>
                <div class="fl-rig dis-inlin dis-block">
                    <span class="c-r dis-inlin dis-block fl-lef">招聘人数：</span>
                    <span class="ic dis-inlin dis-block fl-lef" style="color: black;"><?php echo $jobInfo['employ'];?></span>                                                                               
                    <span class="c-r dis-inlin dis-block fl-lef">推荐人数：</span>
                    <span class="ic dis-inlin dis-block fl-lef" style="color: red;font-weight: bold"><?php echo $jobInfo['record_num'];?></span>

                </div>
                <div class="fl-rig dis-inlin dis-block">
                    <span class="c-r dis-inlin dis-block fl-lef">所属行业：</span>
                    <span class="ic dis-inlin dis-block fl-lef"><?php echo $jobInfo['strycate'];?></span>    

                    <span class="c-r dis-inlin dis-block fl-lef">融资阶段：</span>
                    <span class="ic dis-inlin dis-block fl-lef"><?php echo $jobInfo['stage'];?></span>
                    <span class="c-r dis-inlin dis-block fl-lef">规模：</span> 
                    <span class="ic dis-inlin dis-block fl-lef"><?php echo $jobInfo['scale'];?></span>
                </div>

            </li>
            <li class="clearfix li3">
                <em class="c3-l	dis-inlin dis-block fl-lef">候选人成功入职，你即得奖励  <i>￥<?php echo $jobInfo['Tariff'];?></i></em>
                <span class="c-r dis-inlin dis-block fl-rig">[<?php echo $jobInfo['starttime'];?>]</span>
            </li>
        </ul>
    </div>
    <?php endforeach;?>
</div>
<?php echo $page;?>
<?php else:?>
<p style="text-align:center;color:#000000;font-size:12px;margin:50px 0;">
    <b style="font-size:14px;line-height:40px;">抱歉，没有找到相关的职位<br></b>
    <b >请查看输入关键词是否有误</b>或调整关键字，如将“前端 <b>H5</b>”改为“<b>前端</b>”
</p>
<?php endif;?>
<div style="width:712px;height:0px;margin-top:20px;border-bottom:1px #b5b5b5 dashed;margin-left:38px;"></div>

<input type="hidden" id="hid" value="<?php echo ($nowpage); ?>"/>