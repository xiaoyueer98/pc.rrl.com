
alter table stj_company add column licence varchar(100) not null default '' comment '企业营业执照';
alter table stj_job add column is_deleted varchar(100) not null default '0' comment '删除状态，0未删，1已删除';
ALTER TABLE stj_job  MODIFY COLUMN title varchar(100) default 0;
alter table stj_company add column telephone varchar(100) not null default '' comment '座机电话';
update stj_job set Tariff=(Tariff*(treatment*12/100))*100 where Tariff<10;





------------------------------------------------------------------------------------
CREATE TABLE `stj_active` (
  `id` int(2) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `activename` varchar(50) DEFAULT NULL COMMENT '活动名称',
  `holdingunit` varchar(10) DEFAULT NULL COMMENT '举办单位',
  `content` varchar(256) DEFAULT NULL COMMENT '内容简要',
  `category` varchar(10) DEFAULT NULL COMMENT '活动类别',
  `starttime` varchar(50) DEFAULT NULL COMMENT '起始时间',
  `endtime` varchar(50) DEFAULT NULL COMMENT '结束时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='活动表';


CREATE TABLE `stj_gift` (
  `id` int(2) DEFAULT NULL COMMENT '自增id',
  `giftusername` varchar(15) DEFAULT NULL COMMENT '奖品名称',
  `category` varchar(20) DEFAULT NULL COMMENT '类别名称',
  `fromgift` varchar(20) DEFAULT NULL COMMENT '来源',
  `money` decimal(2,0) NOT NULL COMMENT '金额',
  `count` int(20) NOT NULL COMMENT '数量'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='奖品表';


CREATE TABLE `stj_expirys` (
  `id` int(2) DEFAULT NULL COMMENT '自增id',
  `giftid` int(2) DEFAULT NULL COMMENT '礼物id',
  `expiry` varchar(20) DEFAULT NULL COMMENT '兑奖码',
  `status` int(1) DEFAULT NULL COMMENT '兑奖状态0是未发放1已发放2已领取',
  `notissued` varchar(40) DEFAULT NULL COMMENT '创建奖品的时间',
  `issued` varchar(40) NOT NULL COMMENT '发放时间',
  `accept` varchar(40) NOT NULL COMMENT '领取时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='兑奖表';

alter table stj_member add column `fromwhere` varchar(125) DEFAULT NULL COMMENT '来自哪个活动';
alter table stj_member add column `expiry` varchar(255) DEFAULT NULL;
alter table stj_member add column `address` varchar(500) DEFAULT NULL COMMENT '推荐人详细地址';
alter table stj_resume add column `isshow` int(1) NOT NULL DEFAULT '1' COMMENT '是否显示1显示0隐藏';
alter table stj_resume add column `because` int(1) NOT NULL DEFAULT '1' COMMENT '是否显示1显示0隐藏';

-----------------------------------------------------------------------
CREATE TABLE `stj_wxtk` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `access_token` varchar(250) NOT NULL COMMENT 'weixin access_token',
  `ctime` bigint(20) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `ctime` (`ctime`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;



-----------------------------------成功推荐送大礼-------------------------------------------------
alter table stj_record  add column checktime  int(10) unsigned NOT NULL default 0 COMMENT '审核时间';
alter table stj_record  add column audstarttime  int(10) unsigned NOT NULL default 0 COMMENT '修改面试状态时间';
alter table stj_record  add column sinktime  int(10) unsigned NOT NULL default 0 COMMENT '付款时间';
alter table stj_record  add column is_send  int(10) unsigned NOT NULL default 0 COMMENT '0不赠送推荐奖励，1未处理，2赠送奖励，3不赠送';



CREATE TABLE `stj_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `username` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `account` decimal(10,2) DEFAULT NULL COMMENT '账户金额',
  `created_at` int(11) DEFAULT NULL COMMENT '添加时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `stj_account_blance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `username` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `last_account` DECIMAL(10,2) NOT NULL  default 0 COMMENT '原金额',
  `account` decimal(10,2) NOT NULL  default 0 COMMENT '账户金额',
  `incr`   DECIMAL(10,2) NOT NULL  default 0 COMMENT '操作金额',
 `operat` varchar(255) NOT NULL  default '' COMMENT '操作人',
  `from`  varchar(255) NOT NULL  default '' COMMENT '来源',
  `comment`  text  COMMENT '详细说明',
  `created_at` int(11) DEFAULT NULL COMMENT '添加时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;





alter table stj_record  add column audstartdate  varchar(255)  NOT NULL default '' COMMENT '推荐人填写的候选人面试时间';


alter table stj_active  add column status  tinyint(3) unsigned NOT NULL default 0 COMMENT '0未启用，1启用 2删除';
alter table stj_active  add column `created_at` int(11) DEFAULT NULL COMMENT '添加时间';
alter table stj_active  add column `updated_at` int(11) DEFAULT NULL COMMENT '修改时间';



CREATE TABLE `stj_share` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `username` varchar(255) DEFAULT NULL COMMENT '用户名',
  `activeid` int(11) NOT NULL COMMENT '活动ID',
  `activename` varchar(200) DEFAULT NULL COMMENT '活动名称',
  `url` varchar(255) DEFAULT NULL COMMENT '分享地址',
  `tag` varchar(100) DEFAULT NULL COMMENT '分享标记',
  `channel` varchar(200) DEFAULT NULL COMMENT '分享渠道 百度等',
  `click` int(11) DEFAULT NULL COMMENT '点击数',
  `num` smallint(5) DEFAULT NULL COMMENT '盈利次数',
  `comment` varchar(255) DEFAULT NULL COMMENT '备注',
  `status` tinyint(3) DEFAULT '1' COMMENT '1正常 2删除',
  `created_at` int(11) DEFAULT NULL COMMENT '添加时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


alter table stj_share  add column `decrypturl` varchar(255) DEFAULT NULL COMMENT '加密后分享的URL';


alter table stj_userinfo  add column `fromwhere` varchar(255) DEFAULT '' COMMENT '来源分享的url';
alter table stj_userinfo  add column `is_gift` tinyint(3) DEFAULT 0 COMMENT '0不赠送，1未赠送，1已赠送首次奖励';
alter table stj_userinfo  add column `fromusername` varchar(255) DEFAULT '' COMMENT '来源用户名';


alter table stj_company add column `fromwhere` varchar(125) DEFAULT NULL COMMENT '来自哪个活动';


ALTER TABLE stj_active  MODIFY COLUMN category varchar(100) default '';


alter table stj_company add column `checklogo` tinyint(1) DEFAULT '0' COMMENT '0未审核，1审核通过';
alter table stj_company add column `contract` varchar(250) DEFAULT '' COMMENT '合同上传地址';
alter table stj_company add column `checkcontract` tinyint(1) DEFAULT '0' COMMENT '合同0未审核，1审核通过';
alter table stj_company add column `checklicence` tinyint(1) DEFAULT '0' COMMENT '营业执照0未审核，1审核通过';

------------------------------------------------------------
DROP TABLE IF EXISTS `stj_job_collection`;
CREATE TABLE `stj_job_collection` (
  `id` int(11) NOT NULL  AUTO_INCREMENT,
  `uid` int(11) not null DEFAULT '0' COMMENT '用户id',
  `username` varchar(255) not NULL DEFAULT '' COMMENT '用户名',
  `j_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '招聘信息id',
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '站点id',
  `cpid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '招聘公司ID',
  `title` varchar(100) NOT NULL DEFAULT '0',
  `jobplacedata` varchar(80) NOT NULL DEFAULT '' COMMENT '工作地点',
  `meth` tinyint(2) NOT NULL DEFAULT '0' COMMENT '联系方式',
  `email` varchar(80) NOT NULL DEFAULT '' COMMENT '邮件地址',
  `mobile` varchar(80) NOT NULL DEFAULT '' COMMENT '联系方式',
  `employ` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '招聘人数',
  `Jobcatedata` varchar(50) NOT NULL DEFAULT '' COMMENT '职位类别',
  `strycatedata` varchar(50) NOT NULL DEFAULT '' COMMENT '行业类别',
  `Tariff` varchar(10) NOT NULL DEFAULT '0' COMMENT '招聘资费',
  `treatmentdata` varchar(30) NOT NULL DEFAULT '' COMMENT '工资待遇',
  `experiencedata` varchar(50) NOT NULL DEFAULT '' COMMENT '工作经验',
  `educationdata` varchar(50) NOT NULL DEFAULT '' COMMENT '学历要求',
  `joblangdata` varchar(50) NOT NULL DEFAULT '' COMMENT '言语能力',
  `workdesc` mediumtext COMMENT '职位描述',
  `content` mediumtext COMMENT '职位要求',
  `orderid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '排列排序',
  `posttime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '结束时间',
  `starttime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发表时间',
  `cascname` varchar(30) NOT NULL DEFAULT '' COMMENT '数据名称',
  `status` tinyint(3) NOT NULL DEFAULT '1' COMMENT '1正常 2删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


CREATE TABLE `stj_enchashment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `username` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `last_account` DECIMAL(10,2) NOT NULL  default 0 COMMENT '原金额',
  `account` decimal(10,2) NOT NULL  default 0 COMMENT '取现金额',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1未操作 2成功，3失败',
  `comment`  varchar(255) NOT NULL  default '' COMMENT '失败原因',
  `created_at` int(11) DEFAULT NULL COMMENT '添加时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;







CREATE TABLE `stj_sms_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link_id` varchar(255) NOT NULL COMMENT '关联ID',
  `tag` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `comment` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
 `mobile` varchar(80) NOT NULL DEFAULT '' COMMENT '发送号码',
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '发送内容',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1未操作 2成功，3失败',
  `msg` varchar(255) NOT NULL DEFAULT '' COMMENT '失败原因',
  `created_at` int(11) DEFAULT NULL COMMENT '添加时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

----------------------------------------------------------------------------------------------
alter table stj_userinfo  modify `username` varchar(50) NOT NULL;
alter table stj_member modify  `username` varchar(50) NOT NULL COMMENT '用户名';


alter table stj_record add column `isremind` tinyint(1) DEFAULT '0' COMMENT '0未提醒，1，已提醒，2不提醒，3发送成功，4发送失败';


alter table stj_member add column `link_companys` varchar(255) DEFAULT '' COMMENT '擅长推荐的公司，中间以|||分割';
alter table stj_member add column `link_postions` varchar(255) DEFAULT '' COMMENT '擅长推荐的职位，中间以|||分割';
alter table stj_member add column `link_areas` varchar(255) DEFAULT '' COMMENT '擅长推荐的领域，中间以|||分割';


alter table stj_job add column `guid` varchar(255) DEFAULT '' COMMENT '做url参数';
update stj_job set guid=(select UUID());


---------------------------------------------------------------------------------------------
CREATE TABLE `stj_redpackage_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `username` varchar(255) DEFAULT NULL COMMENT '用户名',
  `activeid` int(11) NOT NULL COMMENT '活动ID',
  `activename` varchar(200) DEFAULT NULL COMMENT '活动名称',
  `money` float DEFAULT '0' COMMENT '领取金额',
  `comment` varchar(255) DEFAULT NULL COMMENT '备注',
  `status` tinyint(3) DEFAULT '1' COMMENT '1正常 2删除',
  `created_at` int(11) DEFAULT NULL COMMENT '添加时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


CREATE TABLE `stj_keyword_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(255) DEFAULT NULL COMMENT '关键词',
  `keyword_group` text COMMENT '关键词组，以空格分隔',
  `created_at` int(11) DEFAULT NULL COMMENT '添加时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

alter table stj_job add column `jobbright` varchar(255) DEFAULT '' COMMENT '做url参数';






alter table stj_member add column `remind_member` tinyint(1) DEFAULT '0' COMMENT '是否已经确认收款银行，0未确认，1已经确认';

---------------------------------------------------------------------------------------------
insert into stj_active(activename,holdingunit,content,category,starttime,endtime,status,created_at,updated_at) value('注册送好礼','北京众聘科技有限公司','注册送好礼','regRedPackage','2015-04-08 00:00:00','2015-05-01 23:59:59',1,UNIX_TIMESTAMP(),UNIX_TIMESTAMP());



alter table stj_job  add column checktime  int(10) unsigned NOT NULL default 0 COMMENT '审核时间';


CREATE TABLE `stj_sms_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link_id` varchar(255) NOT NULL COMMENT '关联ID',
  `tag` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `comment` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
 `mobile` varchar(80) NOT NULL DEFAULT '' COMMENT '发送号码',
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '发送内容',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1未操作 2成功，3失败',
  `msg` varchar(255) NOT NULL DEFAULT '' COMMENT '失败原因',
  `created_at` int(11) DEFAULT NULL COMMENT '添加时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `stj_admin_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL COMMENT '操作人',
  `content` text  COMMENT '操作内容',
  `created_at` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


alter table stj_resume  add column send_money  tinyint(3) unsigned NOT NULL default 0 COMMENT '0,未赠送，1已赠送';

alter table stj_company  add column remark  text  COMMENT '补充说明';



alter table stj_userinfo  add column is_deleted  tinyint(3) unsigned NOT NULL default 0 COMMENT '0,未删除，1已删除';

--------------------------------------------------------------------------
alter table stj_redpackage_log  modify  `status` tinyint(3) DEFAULT '1' comment '0待发放,1已发放,2已删除';
alter table stj_redpackage_log  modify  `money` float DEFAULT '0' COMMENT '领取金额，元为单位';
alter table stj_redpackage_log   add `wishing` varchar(200) DEFAULT "" COMMENT '祝福语'after `activename`;
alter table stj_redpackage_log   add `openid` varchar(50) DEFAULT "" COMMENT '领取者微信openid' after `username`;
alter table stj_redpackage_log   add `sendname` varchar(200) DEFAULT "" COMMENT '红包发放者名称' after `openid`;
alter table stj_redpackage_log   add `nickname` varchar(200) DEFAULT "" COMMENT '提供方名称'after `sendname`;
alter table stj_redpackage_log   add `totalnum` int(11) DEFAULT "1" COMMENT '发放数量' after `money`;
alter table stj_redpackage_log   add `maxvalue` int(11) DEFAULT "0" COMMENT '最大红包金额，分为单位' after `totalnum`;
alter table stj_redpackage_log   add `minvalue` int(11) DEFAULT "0" COMMENT '最小红包金额，分为单位' after `maxvalue`;
alter table stj_redpackage_log   add `billno` varchar(50) DEFAULT "" COMMENT '微信红包订单号' after `minvalue`;
alter table stj_redpackage_log   add `linkid` int(11) DEFAULT "0" COMMENT '关联id,wx红包中为注册用户member中id' after `status`;
alter table stj_redpackage_log   add `tag` tinyint(3) DEFAULT "0" COMMENT '进入途径0直接注册,1分享链接,2邀请码' after `status`;

insert  into stj_active(`activename`,`holdingunit`,`content`,`category`,`starttime`,`endtime`,`status`,`created_at`,`updated_at`) values('分享注册领取微信红包','北京众聘科技有限公司','分享注册领取微信红包','regWxRedPackage','2015-04-22 00:00:00','2015-12-31 23:59:59',1,UNIX_TIMESTAMP(),UNIX_TIMESTAMP());
-----------------------------------------------------------------------------------



update stj_active set starttime='2015-04-22 00:00:00',endtime='2015-04-30 23:59:59'   where id=7;


-----------------------------------------------------------------智能匹配------------------------------------------------------------------

alter table stj_job  add column match_company  char(1)  NOT NULL default '' COMMENT '智能匹配公司背景选项 （A：一线公司 （BAT，即百度、阿里、腾讯）B：二线公司 （BAT外的其它互联网上市公司）C：三线公司 （C轮融资）D：四线公司 （已融资）E：其它公司 （包括自有资金））';
alter table stj_job  add column match_title  char(1)  NOT NULL default '' COMMENT '智能匹配职位详细选项 （A：总裁级（如副总、总裁、VP、总监等）B：经理级（经理、主管等）C：员工级（如工程师等））';
alter table stj_job  add column match_skill  char(1)  NOT NULL default '' COMMENT '智能匹配核心技术掌握情况选项 （A：精通 B：熟悉 C：了解 D:没有）';
alter table stj_job  add column match_industry  char(1)  NOT NULL default '' COMMENT '智能匹配细分行业选项 （A：互联网金融（P2P）B：旅游C：教育；D: 医疗；E：电商；F：搜索；G: 传媒广告；H：非TMT（非互联网行业））';



alter table stj_resume  add column match_company  char(1)  NOT NULL default '' COMMENT '智能匹配公司背景选项 （A：一线公司 （BAT，即百度、阿里、腾讯）B：二线公司 （BAT外的其它互联网上市公司）C：三线公司 （C轮融资）D：四线公司 （已融资）E：其它公司 （包括自有资金））';
alter table stj_resume  add column match_educational  char(1)  NOT NULL default '' COMMENT '智能匹配学历情况选项 （A：大专 B：本科 C：研究生 D:博士）';
alter table stj_resume  add column match_treatment  char(1)  NOT NULL default '' COMMENT '智能匹配薪水要求选项 （A：8000-12000 B：12000-15000 C：15000-20000 D:20000-40000 E:40000-60000 F:60000-80000 G:80000+）';
alter table stj_resume  add column match_area  varchar(255)  NOT NULL default '' COMMENT '智能匹配现居住地';
alter table stj_resume  add column match_industry  char(1)  NOT NULL default '' COMMENT '智能匹配细分行业选项 （A：互联网金融（P2P）B：旅游C：教育；D: 医疗；E：电商；F：搜索；G: 传媒广告；H：非TMT（非互联网行业））';
alter table stj_resume  add column match_title  char(1)  NOT NULL default '' COMMENT '智能匹配职位详细选项 （A：总裁级（如副总、总裁、VP、总监等）B：经理级（经理、主管等）C：员工级（如工程师等））';
alter table stj_resume  add column match_skill  char(1)  NOT NULL default '' COMMENT '智能匹配核心技术掌握情况选项 （A：精通 B：熟悉 C：了解 D:没有）';


alter table stj_job add `softlytip` text COMMENT '职位的温馨提示';

CREATE TABLE `stj_evaluate` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评价id',
  `uid` int(10) unsigned NOT NULL COMMENT '评价者的用户member id',
  `username` varchar(50) NOT NULL COMMENT '评价者用户名',
  `loginip` varchar(20) NOT NULL COMMENT '评价用户的IP',
  `pid` int(10) unsigned NOT NULL COMMENT '被评价id',
  `pname` varchar(100) NOT NULL COMMENT '被评价名称',
  `content` text NOT NULL COMMENT '评价描述',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0是正常1是删除',
  `checkinfo` enum('true','false') NOT NULL DEFAULT 'false' COMMENT '审核状态',
  `created_at` int(10) unsigned NOT NULL COMMENT '开始时间',
  `updated_at` int(10) unsigned NOT NULL COMMENT '结束时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户评价表'

CREATE TABLE `stj_friendlink` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '友情链接id',
  `typeid` smallint(5) unsigned NOT NULL default '1' COMMENT '所属类别id',
  `webname` varchar(30) NOT NULL COMMENT '网站名称',
  `picurl` varchar(100) NOT NULL COMMENT '缩略图片',
  `linkurl` varchar(255) NOT NULL COMMENT '跳转链接',
  `orderid` smallint(5) unsigned NOT NULL COMMENT '排列排序',
  `status` tinyint(2) NOT NULL default '0' COMMENT '状态0正常1隐藏2删除',
  `created_at` int(10) unsigned NOT NULL COMMENT '生成时间',
  `updated_at` int(10) unsigned NOT NULL COMMENT '更新时间',

  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8; 



alter table stj_record add column `match_score` varchar(6) DEFAULT '' COMMENT '智能匹配得分';




INSERT INTO `stj_friendlink` VALUES ('1', '1', 'E商人才网', '', 'http://www.e3job.com/', '0', '1', '1430734409', '1430734409');
INSERT INTO `stj_friendlink` VALUES ('null', '1', '千里马人才网', '', 'http://www.0579job.com/', '0', '1', '1430734409', '1430734409');
INSERT INTO `stj_friendlink` VALUES ('null', '1', '青岛logo设计', '', 'http://www.1epoch.com/', '0', '1', '1430734409', '1430734409');
INSERT INTO `stj_friendlink` VALUES ('null', '1', '启东人才网', '', 'http://www.qidong.zp300.cn/', '0', '1', '1430734409', '1430734409');
INSERT INTO `stj_friendlink` VALUES ('null', '1', '北京一站通', '', 'http://bj.yi.xbaixing.com', '0', '1', '1430734409', '1430734409');
INSERT INTO `stj_friendlink` VALUES ('null', '1', '郑云工作室', '', 'http://zhengyun.cc/', '0', '1', '1430734409', '1430734409');
INSERT INTO `stj_friendlink` VALUES ('null', '1', '一折网', '', 'http://www.5niubi.com/', '0', '1', '1430734409', '1430734409');
INSERT INTO `stj_friendlink` VALUES ('null', '1', '京东精选', '', 'http://www.jdaaa.com/', '0', '1', '1430734409', '1430734409');
INSERT INTO `stj_friendlink` VALUES ('null', '1', 'B5教程网', '', 'http://www.bcty365.com/', '0', '1', '1430734409', '1430734409');
INSERT INTO `stj_friendlink` VALUES ('null', '1', '思讯通', '', 'http://www.shsixun.com/', '0', '1', '1430734409', '1430734409');







alter table stj_resume add column `is_match` tinyint(1) DEFAULT '1' COMMENT '是否进行二次匹配，1进行二次匹配 2不进行二次匹配';

alter table stj_job add column `is_match` tinyint(1) DEFAULT '2' COMMENT '是否已经二次匹配，1已进行匹配 2未进行';


CREATE TABLE `stj_match_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `ot_id` mediumint(8) unsigned NOT NULL COMMENT '前期推荐记录ID',
  `ot_cpname` varchar(255)  NOT NULL COMMENT '上次推荐公司名称名称',
  `ot_title` varchar(255)  NOT NULL COMMENT '上次推荐职位名称',
  `ot_posttime` int(10) unsigned NOT NULL COMMENT '上次推荐时间',
  `j_id` mediumint(8) unsigned NOT NULL COMMENT '招聘信息id',
  `t_id` smallint(5) unsigned NOT NULL COMMENT '推荐人id',
  `bt_id` smallint(5) unsigned NOT NULL COMMENT '被推荐人id',
  `match_score` varchar(6) DEFAULT '' COMMENT '智能匹配得分',
  `is_record` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '0未处理，1已推荐',
  `created_at` int(10) unsigned NOT NULL COMMENT '生成时间',
  `updated_at` int(10) unsigned NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='智能匹配推荐表';


------------------
alter table stj_member add `unionid` varchar(50) NOT NULL default'0' COMMENT '微信开发平台unionid';


alter table stj_resume add `keyword` varchar(250) NOT NULL default'' COMMENT '关键词';


create table stj_listen_log(
		`id` int(11) NOT NULL AUTO_INCREMENT primary key COMMENT '自增id',
		`memberid` int(11) NOT NULL COMMENT '用户ID',
		`type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1登陆2完善信息 3上传简历4推荐',
		`fromwhere` char(50) NOT NULL DEFAULT '' COMMENT '用户来源',
		`regtime` int(11) DEFAULT NULL COMMENT '用户注册时间',
		`comment` char(50) NOT NULL DEFAULT '' COMMENT '备注',
		`listentime` char(50) NOT NULL DEFAULT '' COMMENT '所要统计的时间',
		`status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1正常 2删除',
		`created_at` int(11) DEFAULT NULL COMMENT '添加时间',
  		`updated_at` int(11) DEFAULT NULL COMMENT '修改时间'
 );


alter table stj_resume   add `type` tinyint(3) DEFAULT "2" COMMENT '简历库添加，1从职位添加的简历，2个人中心点击的简历上传';


create table stj_notice_log(
    `id` int(11) NOT NULL AUTO_INCREMENT primary key COMMENT '自增id',
    `uid` int(11) NOT NULL  DEFAULT '0' COMMENT '用户ID',
    `username` varchar(150) NOT NULL DEFAULT '' COMMENT '用户名称',
    `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1推荐人信息，2企业信息',
    `category` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1前台消息，2后台消息',
    `bt_id` int(11) NOT NULL  DEFAULT '0' COMMENT '简历ID',
    `j_id` int(11) NOT NULL  DEFAULT '0' COMMENT '招聘信息ID',
    `title` varchar(200) NOT NULL DEFAULT '' COMMENT '消息名称',
    `content` text NOT NULL COMMENT '消息内容',
    `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1未读 2已读 3删除',
    `created_at` int(11) DEFAULT NULL COMMENT '添加时间',
    `updated_at` int(11) DEFAULT NULL COMMENT '修改时间'
 );


alter table stj_job add column `report` varchar(250) DEFAULT '' COMMENT '汇报对象';
alter table stj_job add column `report_number` varchar(250) DEFAULT '' COMMENT '下属人数';

alter table stj_record add column `j_title` varchar(250) DEFAULT '' COMMENT '职位名称';


update stj_record set j_title = (select title from stj_job where stj_record.j_id=stj_job.id);





alter table  stj_job  add   cpname  varchar(255)  NOT NULL default '' COMMENT '公司名称'  after cpid;
update stj_job set cpname = (select cpname from stj_company where stj_job.cpid=stj_company.id);

alter table stj_company add  talkremark text COMMENT '沟通备注';



alter table stj_resume   add `is_view` tinyint(3) DEFAULT 0 COMMENT '0未读 1已读';
alter table stj_record   add `is_view` tinyint(3) DEFAULT 0 COMMENT '0未读 1已读';
alter table stj_job   add `is_view` tinyint(3) DEFAULT 0 COMMENT '0未读 1已读';



create table stj_qa(
    `id` int(11) NOT NULL AUTO_INCREMENT primary key COMMENT '自增id',
    `question` varchar(200) NOT NULL DEFAULT '' COMMENT '问题',
    `answer` text NOT NULL COMMENT '答案',
    `orderid` mediumint(8) unsigned NOT NULL COMMENT '排列排序',
   `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1推荐人2企业',
    `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1显示 2隐藏 3删除',
    `created_at` int(11) DEFAULT NULL COMMENT '添加时间',
    `updated_at` int(11) DEFAULT NULL COMMENT '修改时间'
 ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='网站qa';


select * from stj_member where mobile !='' and (logintime<1434297600 or fromwhere ='wap注册送好礼') and LENGTH(mobile)=11;



CREATE TABLE `stj_click_count` (
   `id` int(11) NOT NULL AUTO_INCREMENT primary key COMMENT '自增id',
  `tag` varchar(200) DEFAULT NULL COMMENT '标记',
  `ip` varchar(200) DEFAULT NULL COMMENT '访问ip',
  `created_at` int(11) DEFAULT NULL COMMENT '添加时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='短信发送点击统计';


alter table stj_member   add `is_remind_msg` tinyint(3) DEFAULT 1 COMMENT '发送短消息提醒 1未发送 2 已发送';



alter table stj_job   add `is_show` tinyint(3) DEFAULT 1 COMMENT '是否显示，1显示 2不显示';
alter table stj_job   add `type` tinyint(3) DEFAULT 1 COMMENT '职位类型，1普通职位，2私密职位';



alter table stj_resume   add `offer_status` tinyint(3) DEFAULT 1 COMMENT '入职状态  1未沟通，2 离职找工作 3在职看机会 4已入职新公司 5不考虑工作机会 ';
alter table stj_resume   add `offer_date`  varchar(250) not null DEFAULT '' COMMENT '入职日期 ';
alter table stj_resume   add `offer_remark`  varchar(250) not null DEFAULT '' COMMENT '入职公司与职位 ';

alter table stj_sms_log   add column `ip` varchar(80) DEFAULT NULL COMMENT '发送ip';





ALTER TABLE `stj_job` ADD INDEX cpid ( `cpid` ) ;
ALTER TABLE `stj_job` ADD INDEX is_deleted ( `is_deleted` ) ;
ALTER TABLE `stj_job` ADD INDEX guid ( `guid` ) ;
ALTER TABLE `stj_job` ADD INDEX type ( `type` ) ;
ALTER TABLE `stj_job` ADD INDEX is_show ( `is_show` ) ;
ALTER TABLE `stj_job` ADD INDEX checkinfo ( `checkinfo` ) ;


ALTER TABLE `stj_resume` ADD INDEX job_id ( `job_id` ) ;
ALTER TABLE `stj_resume` ADD INDEX t_id ( `t_id` ) ;
ALTER TABLE `stj_resume` ADD INDEX keyid ( `keyid` ) ;
ALTER TABLE `stj_resume` ADD INDEX isshow ( `isshow` ) ;
ALTER TABLE `stj_resume` ADD INDEX audstart ( `audstart` ) ;




ALTER TABLE `stj_record` ADD INDEX j_id ( `j_id` ) ;
ALTER TABLE `stj_record` ADD INDEX t_id ( `t_id` ) ;
ALTER TABLE `stj_record` ADD INDEX bt_id ( `bt_id` ) ;
ALTER TABLE `stj_record` ADD INDEX status ( `status` ) ;











CREATE TABLE `stj_click_count` (
   `id` int(11) NOT NULL AUTO_INCREMENT primary key COMMENT '自增id',
  `tag` varchar(200) DEFAULT NULL COMMENT '标记',
  `ip` varchar(200) DEFAULT NULL COMMENT '访问ip',
  `created_at` int(11) DEFAULT NULL COMMENT '添加时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='短信发送点击统计';




CREATE TABLE `stj_download_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `resume_id` mediumint(8) unsigned NOT NULL COMMENT '简历ID',
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `keyword` varchar(250) NOT NULL DEFAULT '' COMMENT '关键词',
  `wordname` text COMMENT 'word上传名称',
  `adminname` varchar(50) NOT NULL COMMENT '用户名',
   `created_at` int(11) DEFAULT NULL COMMENT '添加时间',
   PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;












