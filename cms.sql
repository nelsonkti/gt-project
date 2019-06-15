/*
Navicat MySQL Data Transfer

Source Server         : phpstudy
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : live

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-03-29 12:51:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for live_admin
-- ----------------------------
DROP TABLE IF EXISTS `live_admin`;
CREATE TABLE `live_admin` (
  `admin_id` tinyint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `admin_name` varchar(32) NOT NULL DEFAULT '' COMMENT '用户名',
  `admin_pass` varchar(48) NOT NULL DEFAULT '' COMMENT '密码',
  `admin_role_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '角色ID',
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of live_admin
-- ----------------------------
INSERT INTO `live_admin` VALUES ('1', 'admin', 'live99_e10adc3949ba59abbe56e057f20f883e', '0');
INSERT INTO `live_admin` VALUES ('2', 'bianji', 'live99_e10adc3949ba59abbe56e057f20f883e', '9');
INSERT INTO `live_admin` VALUES ('7', 'youke', 'live99_e10adc3949ba59abbe56e057f20f883e', '20');

-- ----------------------------
-- Table structure for live_article
-- ----------------------------
DROP TABLE IF EXISTS `live_article`;
CREATE TABLE `live_article` (
  `art_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `art_title` varchar(100) NOT NULL DEFAULT '' COMMENT '文章标题',
  `art_desc` varchar(255) NOT NULL DEFAULT '' COMMENT '文章简介',
  `art_editor` varchar(50) NOT NULL DEFAULT '' COMMENT '编辑',
  `art_time` int(11) unsigned NOT NULL COMMENT '添加时间',
  `art_thumb` varchar(100) NOT NULL DEFAULT '' COMMENT '缩略图',
  `art_content` text NOT NULL COMMENT '内容',
  `art_sort` int(11) unsigned NOT NULL DEFAULT '100' COMMENT '排序',
  PRIMARY KEY (`art_id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of live_article
-- ----------------------------
INSERT INTO `live_article` VALUES ('37', '测试文章1', '测试文章1的简介', 'duiying', '1553827260', '', '<p><img title=\"1553827259.png\" alt=\"csdn.png\" src=\"/upload/ueditor/php/upload/image/20190329/1553827259.png\"/></p>', '10');

-- ----------------------------
-- Table structure for live_auth
-- ----------------------------
DROP TABLE IF EXISTS `live_auth`;
CREATE TABLE `live_auth` (
  `auth_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `auth_name` varchar(32) NOT NULL DEFAULT '' COMMENT '名称',
  `auth_pid` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '父级ID',
  `auth_c` varchar(32) NOT NULL DEFAULT '' COMMENT '控制器',
  `auth_a` varchar(32) NOT NULL DEFAULT '' COMMENT '方法',
  `auth_level` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '级别 0是一级权限 1是二级权限 2是三级权限',
  `auth_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否在左侧菜单显示 0不是 1是',
  `auth_sort` int(11) unsigned NOT NULL DEFAULT '10' COMMENT '排序',
  PRIMARY KEY (`auth_id`)
) ENGINE=MyISAM AUTO_INCREMENT=109 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of live_auth
-- ----------------------------
INSERT INTO `live_auth` VALUES ('1', '设置', '0', '', '', '0', '1', '1');
INSERT INTO `live_auth` VALUES ('2', '修改密码', '1', 'Index', 'pass', '1', '1', '10');
INSERT INTO `live_auth` VALUES ('3', '网站配置', '1', 'Config', 'index', '1', '1', '10');
INSERT INTO `live_auth` VALUES ('30', '案例管理', '21', 'Case', 'index', '1', '1', '10');
INSERT INTO `live_auth` VALUES ('7', '权限管理', '0', '', '', '0', '1', '10');
INSERT INTO `live_auth` VALUES ('8', '管理员管理', '7', 'Manager', 'index', '1', '1', '10');
INSERT INTO `live_auth` VALUES ('9', '角色管理', '7', 'Role', 'index', '1', '1', '10');
INSERT INTO `live_auth` VALUES ('10', '权限管理', '7', 'Auth', 'index', '1', '1', '10');
INSERT INTO `live_auth` VALUES ('31', '友情链接', '1', 'Link', 'index', '1', '1', '10');
INSERT INTO `live_auth` VALUES ('34', '更新缓存', '1', 'Runtime', 'index', '1', '1', '10');
INSERT INTO `live_auth` VALUES ('21', '内容管理', '0', '', '', '0', '1', '2');
INSERT INTO `live_auth` VALUES ('22', '文章管理', '21', 'Article', 'index', '1', '1', '10');
INSERT INTO `live_auth` VALUES ('27', '幻灯管理', '1', 'Banner', 'index', '1', '1', '10');
INSERT INTO `live_auth` VALUES ('26', '导航管理', '21', 'Nav', 'index', '1', '1', '10');
INSERT INTO `live_auth` VALUES ('28', '招聘管理', '21', 'Job', 'index', '1', '1', '10');
INSERT INTO `live_auth` VALUES ('29', '留言管理', '21', 'Msg', 'index', '1', '1', '10');
INSERT INTO `live_auth` VALUES ('35', '添加', '27', 'Banner', 'add', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('36', '提交添加', '27', 'Banner', 'addData', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('37', '删除', '27', 'Banner', 'del', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('38', '批量删除', '27', 'Banner', 'dels', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('39', '编辑', '27', 'Banner', 'edit', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('40', '提交编辑', '27', 'Banner', 'editData', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('41', '排序', '27', 'Banner', 'sort', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('42', '更改状态', '27', 'Banner', 'status', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('43', '添加', '31', 'Link', 'add', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('44', '提交添加', '31', 'Link', 'addData', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('45', '删除', '31', 'Link', 'del', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('46', '批量删除', '31', 'Link', 'dels', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('47', '编辑', '31', 'Link', 'edit', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('48', '提交编辑', '31', 'Link', 'editData', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('49', '排序', '31', 'Link', 'sort', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('50', '提交更新', '34', 'Runtime', 'update', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('51', '添加', '22', 'Article', 'add', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('52', '提交添加', '22', 'Article', 'addData', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('53', '删除', '22', 'Article', 'del', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('54', '批量删除', '22', 'Article', 'dels', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('55', '编辑', '22', 'Article', 'edit', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('56', '提交编辑', '22', 'Article', 'editData', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('57', '排序', '22', 'Article', 'sort', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('58', '添加', '26', 'Nav', 'add', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('59', '提交添加', '26', 'Nav', 'addData', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('60', '删除', '26', 'Nav', 'del', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('61', '编辑', '26', 'Nav', 'edit', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('62', '提交编辑', '26', 'Nav', 'editData', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('63', '排序', '26', 'Nav', 'sort', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('64', '添加', '28', 'Job', 'add', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('65', '提交添加', '28', 'Job', 'addData', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('66', '删除', '28', 'Job', 'del', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('67', '批量删除', '28', 'Job', 'dels', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('68', '编辑', '28', 'Job', 'edit', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('69', '提交编辑', '28', 'Job', 'editData', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('70', '排序', '28', 'Job', 'sort', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('71', '更改状态', '28', 'Job', 'status', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('72', '删除', '29', 'Msg', 'del', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('73', '批量删除', '29', 'Msg', 'dels', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('74', '更改状态', '29', 'Msg', 'status', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('75', '添加', '30', 'Case', 'add', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('76', '提交添加', '30', 'Case', 'addData', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('77', '删除', '30', 'Case', 'del', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('78', '批量删除', '30', 'Case', 'dels', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('79', '编辑', '30', 'Case', 'edit', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('80', '提交编辑', '30', 'Case', 'editData', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('81', '排序', '30', 'Case', 'sort', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('82', '添加', '8', 'Manager', 'add', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('83', '提交添加', '8', 'Manager', 'addData', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('84', '删除', '8', 'Manager', 'del', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('85', '编辑', '8', 'Manager', 'edit', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('86', '提交编辑', '8', 'Manager', 'editData', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('87', '添加', '9', 'Role', 'add', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('88', '提交添加', '9', 'Role', 'addData', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('89', '删除', '9', 'Role', 'del', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('90', '批量删除', '9', 'Role', 'dels', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('91', '编辑', '9', 'Role', 'edit', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('92', '提交编辑', '9', 'Role', 'editData', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('93', '分配权限', '9', 'Role', 'info', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('94', '提交分配权限', '9', 'Role', 'authEdit', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('95', '添加', '10', 'Auth', 'add', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('96', '提交添加', '10', 'Auth', 'addData', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('97', '删除', '10', 'Auth', 'del', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('98', '编辑', '10', 'Auth', 'edit', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('99', '提交编辑', '10', 'Auth', 'editData', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('100', '排序', '10', 'Auth', 'sort', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('101', '更改状态', '10', 'Auth', 'status', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('102', '网站信息', '3', 'Config', 'index', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('103', 'SEO设置', '3', 'Config', 'seo', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('104', '企业信息', '3', 'Config', 'firm', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('105', '客服设置', '3', 'Config', 'service', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('106', '提交更新', '3', 'Config', 'editData', '2', '0', '10');
INSERT INTO `live_auth` VALUES ('108', '提交修改', '2', 'Index', 'edit', '2', '0', '10');

-- ----------------------------
-- Table structure for live_banner
-- ----------------------------
DROP TABLE IF EXISTS `live_banner`;
CREATE TABLE `live_banner` (
  `banner_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'bannerID',
  `banner_img` varchar(100) NOT NULL DEFAULT '' COMMENT 'banner图片地址',
  `banner_href` varchar(100) NOT NULL DEFAULT '' COMMENT 'banner链接地址',
  `banner_sort` int(11) unsigned NOT NULL COMMENT 'banner排序',
  `banner_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态 0开启 1关闭',
  PRIMARY KEY (`banner_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of live_banner
-- ----------------------------
INSERT INTO `live_banner` VALUES ('6', 'upload/2019/03/29/5c9d862bd61c4.jpg', '', '1', '0');
INSERT INTO `live_banner` VALUES ('7', 'upload/2019/03/29/5c9d863b47a8b.jpg', '', '2', '0');

-- ----------------------------
-- Table structure for live_case
-- ----------------------------
DROP TABLE IF EXISTS `live_case`;
CREATE TABLE `live_case` (
  `case_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '案例ID',
  `case_title` varchar(50) NOT NULL DEFAULT '' COMMENT '案例标题',
  `case_img` varchar(100) NOT NULL DEFAULT '' COMMENT '图片',
  `case_sort` int(11) unsigned NOT NULL DEFAULT '10' COMMENT '排序',
  PRIMARY KEY (`case_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of live_case
-- ----------------------------
INSERT INTO `live_case` VALUES ('8', '晴空恋雨', 'upload/2017/04/12/58edc0c098b9a.jpg', '10');
INSERT INTO `live_case` VALUES ('6', '玩墨天下', 'upload/2017/04/12/58edc0828e566.jpg', '10');
INSERT INTO `live_case` VALUES ('7', '中国银行', 'upload/2017/04/12/58edc0a0240f9.jpg', '10');
INSERT INTO `live_case` VALUES ('9', '域星球', 'upload/2017/04/12/58edc0d4411be.jpg', '10');
INSERT INTO `live_case` VALUES ('10', '药易购', 'upload/2017/04/12/58edc0e40f865.jpg', '10');
INSERT INTO `live_case` VALUES ('11', '中医药教育网', 'upload/2017/04/12/58edc107f390d.jpg', '10');
INSERT INTO `live_case` VALUES ('12', '云兼职', 'upload/2017/04/12/58edc12322b75.jpg', '10');
INSERT INTO `live_case` VALUES ('13', '喜月', 'upload/2017/04/12/58edc134de76e.jpg', '10');

-- ----------------------------
-- Table structure for live_config
-- ----------------------------
DROP TABLE IF EXISTS `live_config`;
CREATE TABLE `live_config` (
  `config_web_name` varchar(100) NOT NULL DEFAULT '' COMMENT '网站信息-网站名称',
  `config_web_stat` varchar(255) NOT NULL DEFAULT '' COMMENT '网站信息-统计代码',
  `config_web_copyright` varchar(255) NOT NULL DEFAULT '' COMMENT '网站信息-版权信息',
  `config_web_record` varchar(100) NOT NULL DEFAULT '' COMMENT '网站信息-备案信息',
  `config_seo_title` varchar(100) NOT NULL DEFAULT '' COMMENT 'SEO-SEO标题',
  `config_seo_keywords` varchar(255) NOT NULL DEFAULT '' COMMENT 'SEO-SEO关键字',
  `config_seo_desc` varchar(255) NOT NULL DEFAULT '' COMMENT 'SEO-SEO描述',
  `config_firm_name` varchar(100) NOT NULL DEFAULT '' COMMENT '公司-名称',
  `config_firm_location` varchar(100) NOT NULL DEFAULT '' COMMENT '公司-地址',
  `config_firm_phone` varchar(30) NOT NULL DEFAULT '' COMMENT '公司-电话',
  `config_firm_fax` varchar(30) NOT NULL DEFAULT '' COMMENT '公司-传真',
  `config_firm_mail` varchar(30) NOT NULL DEFAULT '' COMMENT '公司-邮箱',
  `config_service_qq` varchar(15) NOT NULL DEFAULT '' COMMENT '客服-QQ',
  `config_service_phone` varchar(30) NOT NULL DEFAULT '' COMMENT '客服-电话'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of live_config
-- ----------------------------
INSERT INTO `live_config` VALUES ('TP3-CMS 专业企业网站内容管理系统', '', 'Copyright ©2018-2019<a href=\"https://github.com/duiying/TP3-CMS\" target=\"_blank\" style=\"font-weight:bold;color:#fff;\"> GitHub </a>版权所有', '京ICP备11018762号', 'TP3-CMS 内容管理框架, 做最简约的PHP开源软件', 'TP3-CMS, 内容管理系统, 后台管理系统, 企业建站系统, php开源软件,thinkphp, 简约风', '基于ThinkPHP3.2框架完成的企业网站CMS系统, 快速搭建可商用的企业网站, 接私活利器', 'TP3-CMS科技有限公司', '北京望京sohu商业街', '010-24323424', '010-54354325', '1822581649@qq.com', '1822581649', '17725027889');

-- ----------------------------
-- Table structure for live_job
-- ----------------------------
DROP TABLE IF EXISTS `live_job`;
CREATE TABLE `live_job` (
  `job_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '职位ID',
  `job_name` varchar(50) NOT NULL DEFAULT '' COMMENT '职位名称',
  `job_where` varchar(50) NOT NULL DEFAULT '' COMMENT '工作地点',
  `job_num` varchar(30) NOT NULL DEFAULT '' COMMENT '人数',
  `job_desc` text NOT NULL COMMENT '职位描述',
  `job_ask` text NOT NULL COMMENT '职位要求',
  `job_sort` tinyint(5) unsigned NOT NULL DEFAULT '10' COMMENT '排序',
  `job_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '职位状态 0正常 1停止',
  PRIMARY KEY (`job_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of live_job
-- ----------------------------
INSERT INTO `live_job` VALUES ('3', '客户经理1', '北京', '3', '<p>1. 热爱销售，适应高强度工作，喜欢挑战自我，善于客户公关，主动销售，不畏挫折</p><p>2. 具有互联网软件市场推广经验，熟悉主要线上线下媒体传播渠道</p><p>3. 熟悉软件和互联网行业，掌握 office 软件，网络沟通和应用办公软件</p><p>4. 具有较强的执行能力，能独立运作线上线下推广的各个环节</p><p>5. 良好的人际关系，出色的沟通技巧； 吃苦耐劳，拥有强烈的上进心和学习意识</p><p><br/></p>', '<p>1. 热爱销售，适应高强度工作，喜欢挑战自我，善于客户公关，主动销售，不畏挫折</p><p>2. 具有互联网软件市场推广经验，熟悉主要线上线下媒体传播渠道</p><p>3. 熟悉软件和互联网行业，掌握 office 软件，网络沟通和应用办公软件</p><p>4. 具有较强的执行能力，能独立运作线上线下推广的各个环节</p><p>5. 良好的人际关系，出色的沟通技巧； 吃苦耐劳，拥有强烈的上进心和学习意识</p><p><br/></p>', '3', '1');
INSERT INTO `live_job` VALUES ('4', '客户经理2', '北京', '3', '<p>1. 热爱销售，适应高强度工作，喜欢挑战自我，善于客户公关，主动销售，不畏挫折</p><p>2. 具有互联网软件市场推广经验，熟悉主要线上线下媒体传播渠道</p><p>3. 熟悉软件和互联网行业，掌握 office 软件，网络沟通和应用办公软件</p><p>4. 具有较强的执行能力，能独立运作线上线下推广的各个环节</p><p>5. 良好的人际关系，出色的沟通技巧； 吃苦耐劳，拥有强烈的上进心和学习意识</p><p><br/></p>', '<p>1. 热爱销售，适应高强度工作，喜欢挑战自我，善于客户公关，主动销售，不畏挫折</p><p>2. 具有互联网软件市场推广经验，熟悉主要线上线下媒体传播渠道</p><p>3. 熟悉软件和互联网行业，掌握 office 软件，网络沟通和应用办公软件</p><p>4. 具有较强的执行能力，能独立运作线上线下推广的各个环节</p><p>5. 良好的人际关系，出色的沟通技巧； 吃苦耐劳，拥有强烈的上进心和学习意识</p><p><br/></p>', '1', '0');

-- ----------------------------
-- Table structure for live_link
-- ----------------------------
DROP TABLE IF EXISTS `live_link`;
CREATE TABLE `live_link` (
  `link_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '链接ID',
  `link_name` varchar(50) NOT NULL DEFAULT '' COMMENT '链接名称',
  `link_href` varchar(100) NOT NULL DEFAULT '' COMMENT '链接地址',
  `link_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '跳转方式 0是_blank 1是_self',
  `link_sort` int(11) unsigned NOT NULL DEFAULT '10' COMMENT '排序 默认10',
  PRIMARY KEY (`link_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of live_link
-- ----------------------------
INSERT INTO `live_link` VALUES ('1', '百度一下', 'http://www.baidu.com', '1', '4');
INSERT INTO `live_link` VALUES ('2', '新浪', 'http://sina.cn', '1', '2');
INSERT INTO `live_link` VALUES ('3', '知乎', 'http://www.zhihu.cn', '1', '3');
INSERT INTO `live_link` VALUES ('4', '腾讯', 'http://www.qq.com', '0', '1');

-- ----------------------------
-- Table structure for live_msg
-- ----------------------------
DROP TABLE IF EXISTS `live_msg`;
CREATE TABLE `live_msg` (
  `msg_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '留言ID',
  `msg_name` varchar(50) NOT NULL DEFAULT '' COMMENT '姓名',
  `msg_phone` varchar(30) NOT NULL DEFAULT '' COMMENT '手机',
  `msg_qq` varchar(20) NOT NULL DEFAULT '' COMMENT 'QQ',
  `msg_content` varchar(255) NOT NULL DEFAULT '' COMMENT '内容',
  `msg_time` int(11) unsigned NOT NULL COMMENT '留言时间',
  `msg_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '留言装填 0未处理 1已处理',
  PRIMARY KEY (`msg_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of live_msg
-- ----------------------------
INSERT INTO `live_msg` VALUES ('11', '王某', '17726768888', '37612633', '需要做一个企业CMS', '1553827464', '0');

-- ----------------------------
-- Table structure for live_nav
-- ----------------------------
DROP TABLE IF EXISTS `live_nav`;
CREATE TABLE `live_nav` (
  `nav_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '导航ID',
  `nav_name` varchar(50) NOT NULL DEFAULT '' COMMENT '导航名称',
  `nav_link` varchar(50) NOT NULL DEFAULT '' COMMENT '导航链接',
  `nav_pid` int(11) NOT NULL COMMENT '父级ID 0是一级 非0是二级',
  `nav_sort` smallint(5) NOT NULL DEFAULT '10' COMMENT '排序',
  PRIMARY KEY (`nav_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of live_nav
-- ----------------------------
INSERT INTO `live_nav` VALUES ('1', '首页', 'index.html', '0', '1');
INSERT INTO `live_nav` VALUES ('2', '新闻动态', 'index.php?v=news', '0', '2');
INSERT INTO `live_nav` VALUES ('3', '客户案例', 'client.html', '0', '3');
INSERT INTO `live_nav` VALUES ('4', '关于我们', 'us.html', '0', '4');
INSERT INTO `live_nav` VALUES ('5', '联系我们', 'contact.html', '4', '2');
INSERT INTO `live_nav` VALUES ('6', '公司简介', 'us.html', '4', '1');
INSERT INTO `live_nav` VALUES ('9', '人才招聘', 'job.html', '4', '3');
INSERT INTO `live_nav` VALUES ('10', '在线留言', 'msg.html', '4', '4');

-- ----------------------------
-- Table structure for live_role
-- ----------------------------
DROP TABLE IF EXISTS `live_role`;
CREATE TABLE `live_role` (
  `role_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `role_name` varchar(32) NOT NULL DEFAULT '' COMMENT '名称',
  `role_auth_ids` varchar(128) NOT NULL DEFAULT '' COMMENT '权限ids',
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of live_role
-- ----------------------------
INSERT INTO `live_role` VALUES ('9', '编辑', '21,22,51,52,53,54,55,56,57');
INSERT INTO `live_role` VALUES ('20', '游客', '1,2,3,102,103,104,105,27,31,34,21,22,26,28,29,30,7,8,9,10');
