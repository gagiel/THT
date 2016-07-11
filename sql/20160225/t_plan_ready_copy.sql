/*
Navicat MySQL Data Transfer

Source Server         : binhai
Source Server Version : 50173
Source Host           : 192.168.1.223:3306
Source Database       : binhai

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2016-02-25 11:25:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_plan_ready_copy
-- ----------------------------
DROP TABLE IF EXISTS `t_plan_ready_copy`;
CREATE TABLE `t_plan_ready_copy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_id` int(11) NOT NULL COMMENT '活动方案ID',
  `info` varchar(255) NOT NULL COMMENT '准备内容',
  `r_state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 0未完成 1已完成',
  `r_time` int(11) DEFAULT NULL COMMENT '准备完成时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=294 DEFAULT CHARSET=utf8;
