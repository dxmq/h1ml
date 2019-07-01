# Host: localhost  (Version: 5.5.53)
# Date: 2019-06-30 23:18:20
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "zc_admin"
#

DROP TABLE IF EXISTS `zc_admin`;
CREATE TABLE `zc_admin` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员Id',
  `username` varchar(10) NOT NULL DEFAULT '' COMMENT '管理员名称',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `delete_time` int(11) unsigned DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='管理员表';

insert into `zc_admin` (`id`, `username`, `password`, `create_time`, `update_time`) VALUES (1, 'admin', '1844b9ed56cac2af0b5d139012a9a317', '1561977170', '1561977170');
#
# Structure for table "zc_article"
#

DROP TABLE IF EXISTS `zc_article`;
CREATE TABLE `zc_article` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `cate_id` smallint(5) unsigned NOT NULL COMMENT '栏目Id',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `thumbnail` varchar(80) DEFAULT NULL COMMENT '缩略图地址',
  `author` varchar(15) NOT NULL COMMENT '作者',
  `view_content` varchar(255) NOT NULL COMMENT '文章概要(内容去html的200个字符)',
  `content` text NOT NULL COMMENT '文章内容',
  `browse_num` mediumint(8) unsigned NOT NULL COMMENT '浏览次数',
  `comment_num` mediumint(8) unsigned NOT NULL COMMENT '评论数',
  `is_show` enum('1','0') DEFAULT '1' COMMENT '是否展示',
  `is_top` enum('1','0') DEFAULT '1' COMMENT '是否置顶',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`id`),
  KEY `cate_id` (`cate_id`),
  KEY `title` (`title`),
  KEY `author` (`author`)
) ENGINE=InnoDB AUTO_INCREMENT=123802 DEFAULT CHARSET=utf8 COMMENT='文章表';

#
# Structure for table "zc_article_label"
#

DROP TABLE IF EXISTS `zc_article_label`;
CREATE TABLE `zc_article_label` (
  `article_id` mediumint(8) unsigned NOT NULL COMMENT '文章Id',
  `label_id` smallint(5) unsigned NOT NULL COMMENT '标签Id',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  KEY `label_id` (`label_id`),
  KEY `article_id` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章标签表';

#
# Structure for table "zc_cate"
#

DROP TABLE IF EXISTS `zc_cate`;
CREATE TABLE `zc_cate` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `catename` varchar(15) NOT NULL DEFAULT '' COMMENT '栏目名称',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='栏目表';

#
# Structure for table "zc_chat"
#

DROP TABLE IF EXISTS `zc_chat`;
CREATE TABLE `zc_chat` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `content` varchar(50) NOT NULL DEFAULT '' COMMENT '内容',
  `is_show` enum('1','0') NOT NULL COMMENT '是否展示',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='随言碎语表';

#
# Structure for table "zc_label"
#

DROP TABLE IF EXISTS `zc_label`;
CREATE TABLE `zc_label` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `labelname` varchar(15) NOT NULL DEFAULT '' COMMENT '标签内容',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='标签表';

#
# Structure for table "zc_system"
#

DROP TABLE IF EXISTS `zc_system`;
CREATE TABLE `zc_system` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `webname` varchar(30) NOT NULL COMMENT '网站名称',
  `copyright` varchar(30) NOT NULL COMMENT '版权信息',
  `friendship_link` varchar(150) DEFAULT NULL COMMENT '友情链接',
  `web_introduce` varchar(150) NOT NULL DEFAULT '' COMMENT '网站介绍',
  `contact` varchar(150) DEFAULT NULL COMMENT '联系方式',
  `create_time` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='系统设置表';
