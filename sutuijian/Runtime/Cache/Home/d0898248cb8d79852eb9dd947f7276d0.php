<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>人人猎</title>
        <link rel="stylesheet"  href="/Public/css/webchatnew/reset.css">     
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <meta content="yes" name="apple-mobile-web-app-capable" />
        <meta content="black" name="apple-mobile-web-app-status-bar-style" />
        <meta content="telephone=no" name="format-detection" />
        <style>
            #re_wrapper #audstartdate {
                width: 100%;
                height: 144px;
                display: block;
                border: none;
                background: #ffffff;
                resize: none;
                overflow: hidden;
                outline: medium;
                font-size: 14px;
                line-height: 20px;
                border-bottom: 1px #ccc solid;
            }
        </style>
    </head>
    <body>

        <div class="set_wrapper" id="re_wrapper" style="background:#ffffff;" >
            <div id="scroller">
                <div id="pullDown" style="display:none">
                    <span class="pullDownIcon"></span><span class="pullDownLabel">下拉刷新...</span>
                </div>
                <form action="/Home/Webchatnew/add_resume" method="post" id="form">
                    <?php if($data["type"] == 'username'): ?><textarea placeholder="请输入<?php echo ($data["desc"]); ?>" name="<?php echo ($data["type"]); ?>" id="audstartdate"><?php echo ($data["username"]); ?></textarea>
                        <?php else: ?>
                        <input type="hidden" value='<?php echo ($data["username"]); ?>' name='username' /><?php endif; ?>
                    <?php if($data["type"] == 'sex'): ?><textarea placeholder="请输入<?php echo ($data["desc"]); ?>" name="<?php echo ($data["type"]); ?>" id="audstartdate"><?php echo ($data["sex"]); ?></textarea>
                        <?php else: ?>
                        <input type="hidden" value='<?php echo ($data["sex"]); ?>' name='sex' /><?php endif; ?>
                    <?php if($data["type"] == 'age'): ?><textarea placeholder="请输入<?php echo ($data["desc"]); ?>" name="<?php echo ($data["type"]); ?>" id="audstartdate"><?php echo ($data["age"]); ?></textarea>
                        <?php else: ?>
                        <input type="hidden" value='<?php echo ($data["age"]); ?>' name='age' /><?php endif; ?>
                    <?php if($data["type"] == 'email'): ?><textarea placeholder="请输入<?php echo ($data["desc"]); ?>" name="<?php echo ($data["type"]); ?>" id="audstartdate"><?php echo ($data["email"]); ?></textarea>
                        <?php else: ?>
                        <input type="hidden" value='<?php echo ($data["email"]); ?>' name='email' /><?php endif; ?>
                    <?php if($data["type"] == 'qqnum'): ?><textarea placeholder="请输入<?php echo ($data["desc"]); ?>" name="<?php echo ($data["type"]); ?>" id="audstartdate"><?php echo ($data["qqnum"]); ?></textarea>
                        <?php else: ?>
                        <input type="hidden" value='<?php echo ($data["qqnum"]); ?>' name='qqnum' /><?php endif; ?>
                    <?php if($data["type"] == 'state'): ?><textarea placeholder="请输入<?php echo ($data["desc"]); ?>" name="<?php echo ($data["type"]); ?>" id="audstartdate"><?php echo ($data["state"]); ?></textarea>
                        <?php else: ?>
                        <input type="hidden" value='<?php echo ($data["state"]); ?>' name='state' /><?php endif; ?>
                    <?php if($data["type"] == 'edu'): ?><textarea placeholder="请输入<?php echo ($data["desc"]); ?>" name="<?php echo ($data["type"]); ?>" id="audstartdate"><?php echo ($data["edu"]); ?></textarea>
                        <?php else: ?>
                        <input type="hidden" value='<?php echo ($data["edu"]); ?>' name='edu' /><?php endif; ?>
                    <?php if($data["type"] == 'exper'): ?><textarea placeholder="请输入<?php echo ($data["desc"]); ?>" name="<?php echo ($data["type"]); ?>" id="audstartdate"><?php echo ($data["exper"]); ?></textarea>
                        <?php else: ?>
                        <input type="hidden" value='<?php echo ($data["exper"]); ?>' name='exper' /><?php endif; ?>
                    <?php if($data["type"] == 'zige'): ?><textarea placeholder="请输入<?php echo ($data["desc"]); ?>" name="<?php echo ($data["type"]); ?>" id="audstartdate"><?php echo ($data["zige"]); ?></textarea>
                        <?php else: ?>
                        <input type="hidden" value='<?php echo ($data["zige"]); ?>' name='zige' /><?php endif; ?>
                    <?php if($data["type"] == 'because'): ?><textarea placeholder="请输入<?php echo ($data["desc"]); ?>" name="<?php echo ($data["type"]); ?>" id="audstartdate"><?php echo ($data["because"]); ?></textarea>
                        <?php else: ?>
                        <input type="hidden" value='<?php echo ($data["because"]); ?>' name='because' /><?php endif; ?>
                    <?php if($data["type"] == 'mobile'): ?><textarea placeholder="请输入<?php echo ($data["desc"]); ?>" name="<?php echo ($data["type"]); ?>" id="audstartdate"><?php echo ($data["mobile"]); ?></textarea>
                        <?php else: ?>
                        <input type="hidden" value='<?php echo ($data["mobile"]); ?>' name='mobile' /><?php endif; ?>
                    <?php if($data["type"] == 'keyword'): ?><textarea placeholder="请输入<?php echo ($data["desc"]); ?>" name="<?php echo ($data["type"]); ?>" id="audstartdate"><?php echo ($data["keyword"]); ?></textarea>
                        <?php else: ?>
                        <input type="hidden" value='<?php echo ($data["keyword"]); ?>' name='keyword' /><?php endif; ?>
                    <?php if($data["type"] == 'personal'): ?><textarea placeholder="请输入<?php echo ($data["desc"]); ?>" name="<?php echo ($data["type"]); ?>" id="audstartdate"><?php echo ($data["personal"]); ?></textarea>
                        <?php else: ?>
                        <input type="hidden" value='<?php echo ($data["personal"]); ?>' name='personal' /><?php endif; ?>

                </form>
                <p class="clearfix"><span class="btn" style="margin-top:10px;float:center;" id="savebtn">保存</span></p>
                <div id="pullUp" style="display:none;">
                    <span class="pullUpIcon"></span><span class="pullUpLabel">上拉加载更多...</span>
                </div>

            </div>
        </div>
        <!--  -->
        <script>
            document.addEventListener("touchmove", function (e) {
                e.preventDefault();
            }, false);

            $("#savebtn").click(function () {

                $("#form")[0].submit();
            })
            $('.jl ul li em').on('click', function () {
                $(this).hide();
                $(this).nextAll().show();
            })
        </script>
    </body>
</html>