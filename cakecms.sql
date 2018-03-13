/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.13-MariaDB : Database - cakecms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cakecms` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `cakecms`;

/*Table structure for table `ad_arctypes` */

DROP TABLE IF EXISTS `ad_arctypes`;

CREATE TABLE `ad_arctypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name` varchar(50) DEFAULT NULL COMMENT '栏目名称',
  `asname` varchar(50) DEFAULT NULL COMMENT '栏目别名，对应英文名称',
  `parent_id` int(11) DEFAULT NULL COMMENT '父id',
  `level` tinyint(3) DEFAULT '1' COMMENT '级别',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `type` tinyint(2) DEFAULT '1' COMMENT '类型，1分类栏目，2单页面，3列表栏目，4图片栏目，5跳转链接',
  `image` varchar(50) DEFAULT NULL COMMENT '图片',
  `isshow` tinyint(2) DEFAULT '1' COMMENT '是否显示，1显示，2隐藏',
  `isnav` tinyint(2) DEFAULT '2' COMMENT '是否导航，1是，2否',
  `keywords` varchar(255) DEFAULT NULL COMMENT '关键词',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `content` text COMMENT '内容',
  `href` varchar(255) DEFAULT NULL COMMENT '跳转链接',
  `created` datetime DEFAULT NULL COMMENT '创建时间',
  `modified` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='栏目表';

/*Data for the table `ad_arctypes` */

/*Table structure for table `ad_articles` */

DROP TABLE IF EXISTS `ad_articles`;

CREATE TABLE `ad_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `arctype_id` int(11) DEFAULT NULL COMMENT '栏目id',
  `title` varchar(100) DEFAULT NULL COMMENT '标题',
  `shorttitle` varchar(36) DEFAULT NULL COMMENT '短标题',
  `color` varchar(10) DEFAULT NULL COMMENT '颜色',
  `description` varchar(250) DEFAULT NULL COMMENT '描述',
  `keywords` varchar(100) DEFAULT NULL COMMENT '关键字',
  `content` mediumtext COMMENT '内容',
  `author` varchar(50) DEFAULT NULL COMMENT '作者',
  `source` varchar(50) DEFAULT NULL COMMENT '来源',
  `pubdate` datetime DEFAULT NULL COMMENT '发布时间',
  `image` varchar(200) DEFAULT NULL COMMENT '缩略图',
  `autoimage` tinyint(2) DEFAULT '2' COMMENT '是否提取图片，1是，2否。提取内容中第一个图片为缩略图',
  `tag` varchar(100) DEFAULT NULL COMMENT '标签',
  `click` int(11) DEFAULT NULL COMMENT '点击次数',
  `isshow` tinyint(2) DEFAULT '1' COMMENT '是否显示，1显示，2隐藏',
  `isbold` tinyint(2) DEFAULT '2' COMMENT '是否加粗，1是，2否',
  `istop` tinyint(2) DEFAULT '2' COMMENT '是否置顶，1是，2否',
  `ishot` tinyint(2) DEFAULT '2' COMMENT '是否热门，1是，2否',
  `isindex` tinyint(2) DEFAULT '2' COMMENT '是否首页，1是，2否',
  `isred` tinyint(2) DEFAULT '2' COMMENT '是否标红，1是，2否',
  `ishref` tinyint(2) DEFAULT '2' COMMENT '是否链接，1是，2否',
  `href` varchar(150) DEFAULT NULL COMMENT '链接URL',
  `user_id` int(11) DEFAULT NULL COMMENT '管理员id',
  `created` datetime DEFAULT NULL COMMENT '创建时间',
  `modified` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `created` (`created`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章表';

/*Data for the table `ad_articles` */

/*Table structure for table `ad_menus` */

DROP TABLE IF EXISTS `ad_menus`;

CREATE TABLE `ad_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name` varchar(50) DEFAULT NULL COMMENT '菜单名称',
  `parent_id` int(11) DEFAULT '0' COMMENT '上级菜单id',
  `level` tinyint(3) DEFAULT '1' COMMENT '菜单级别',
  `icon` varchar(20) DEFAULT NULL COMMENT '菜单图标',
  `target` varchar(50) DEFAULT NULL COMMENT '菜单链接',
  `reload` varchar(20) DEFAULT NULL COMMENT '重新载入某个标签',
  `sort` tinyint(3) DEFAULT '0' COMMENT '菜单排序',
  `isshow` tinyint(2) DEFAULT '1' COMMENT '是否显示。1显示，2隐藏',
  `created` datetime DEFAULT NULL COMMENT '创建时间',
  `modified` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='菜单表';

/*Data for the table `ad_menus` */

insert  into `ad_menus`(`id`,`name`,`parent_id`,`level`,`icon`,`target`,`reload`,`sort`,`isshow`,`created`,`modified`) values (1,'系统管理',0,1,'fa-cogs','','',0,1,'2017-09-22 17:08:36','0000-00-00 00:00:00'),(2,'系统管理',1,2,'cogs','','',0,1,'2017-09-22 17:08:39','0000-00-00 00:00:00'),(3,'管理员组',2,3,'fa-caret-right','admin/roles/index','roles',0,1,'2017-09-22 17:08:41','0000-00-00 00:00:00'),(4,'用户管理',2,3,'fa-caret-right','admin/users/index','users',0,1,'2017-09-22 17:08:42','0000-00-00 00:00:00'),(5,'系统设置',2,3,'fa-caret-right','admin/options/index','options',0,1,'2017-09-22 17:08:44','0000-00-00 00:00:00'),(6,'菜单管理',2,3,'fa-caret-right','admin/menus/index','menus',0,1,'2017-09-22 17:08:51','0000-00-00 00:00:00'),(7,'信息管理',0,1,'fa-list-ul','','',1,1,'2017-09-22 17:08:53','0000-00-00 00:00:00'),(8,'信息管理',7,2,'list-ul','','',0,1,'2017-09-22 17:08:55','0000-00-00 00:00:00'),(9,'栏目管理',8,3,'fa-caret-right','admin/arctypes/index','arctypes',0,1,'2017-09-22 17:08:56','0000-00-00 00:00:00'),(10,'文章管理',8,3,'fa-caret-right','admin/articles/index','articles',1,1,'2017-09-22 17:08:58','0000-00-00 00:00:00');

/*Table structure for table `ad_options` */

DROP TABLE IF EXISTS `ad_options`;

CREATE TABLE `ad_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `field` varchar(50) DEFAULT NULL COMMENT '字段名',
  `value` text COMMENT '值',
  `type` varchar(50) DEFAULT NULL COMMENT '所属分类',
  `autoload` varchar(20) DEFAULT 'yes' COMMENT '是否自动加载，缓存起来',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='系统配置表';

/*Data for the table `ad_options` */

insert  into `ad_options`(`id`,`name`,`field`,`value`,`type`,`autoload`) values (1,'系统名称','systemname','CakeCMS管理系统','system','yes'),(2,'系统logo','systemlogo','img/cake-logo.png','system','yes'),(3,'显示系统名称','systemnamehide','1','system','yes'),(4,'起始年份','systemyear','2018','system','yes'),(5,'底部信息','systemfoot','Copyright © 2018 CakeCMS','system','yes'),(6,'百度地图','baidu','','other','yes'),(7,'云片短信','yunpian','','other','yes'),(8,'站点名称','sitename','','site','yes'),(9,'站点副名称','sitefuname','','site','yes'),(10,'站点描述','sitedesc','','site','yes'),(11,'关键词','sitekeywords','','site','yes'),(12,'版权信息','sitecopyright','','site','yes'),(13,'备案编号','siteicpsn','','site','yes'),(14,'统计代码','sitestatistics','','site','yes'),(15,'登录名称','systemlogin','CakeCMS管理系统','system','yes');

/*Table structure for table `ad_roles` */

DROP TABLE IF EXISTS `ad_roles`;

CREATE TABLE `ad_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name` varchar(50) DEFAULT NULL COMMENT '组别名称',
  `menus` text COMMENT '菜单权限',
  `note` varchar(100) DEFAULT NULL COMMENT '备注',
  `sort` int(11) DEFAULT '0' COMMENT '排序id',
  `created` datetime DEFAULT NULL COMMENT '创建时间',
  `modified` datetime NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员组表';

/*Data for the table `ad_roles` */

insert  into `ad_roles`(`id`,`name`,`menus`,`note`,`sort`,`created`,`modified`) values (1,'管理员组','[\"7\",\"8\",\"10\",\"9\",\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"11\"]','',0,'2017-09-22 17:07:58','2018-03-13 13:28:15');

/*Table structure for table `ad_users` */

DROP TABLE IF EXISTS `ad_users`;

CREATE TABLE `ad_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `username` varchar(50) DEFAULT NULL COMMENT '登录名',
  `password` varchar(100) DEFAULT NULL COMMENT '登录密码',
  `nickname` varchar(50) DEFAULT NULL COMMENT '昵称',
  `role_id` int(11) DEFAULT NULL COMMENT '用户组id',
  `state` tinyint(2) DEFAULT '1' COMMENT '登录状态.1正常，2禁止',
  `created` datetime DEFAULT NULL COMMENT '创建时间',
  `modified` datetime NOT NULL COMMENT '修改时间',
  `sex` tinyint(2) DEFAULT NULL COMMENT '性别。1男，2女',
  `telphone` varchar(20) DEFAULT NULL COMMENT '联系方式',
  `email` varchar(50) DEFAULT NULL COMMENT '电子邮件',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员表';

/*Data for the table `ad_users` */

insert  into `ad_users`(`id`,`username`,`password`,`nickname`,`role_id`,`state`,`created`,`modified`,`sex`,`telphone`,`email`) values (1,'admin','$2y$10$v5bE3wc3AASZSK05CLUvf.hhjWxWEfXZGz.1LAVtNn/70n6DsVFOi','管理员',1,1,'2017-09-22 15:16:50','2018-03-13 13:39:36',1,'','');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
