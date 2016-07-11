/*
Navicat MySQL Data Transfer

Source Server         : binhai
Source Server Version : 50173
Source Host           : 192.168.1.223:3306
Source Database       : binhai

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2016-02-25 11:25:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_remind_read_copy
-- ----------------------------
DROP TABLE IF EXISTS `t_remind_read_copy`;
CREATE TABLE `t_remind_read_copy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `remind_id` int(11) NOT NULL COMMENT '提醒ID',
  `user_id` int(11) NOT NULL COMMENT '阅读人ID',
  `state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '阅读状态 0未阅读 1已阅读 2不再提醒',
  `addtime` datetime NOT NULL COMMENT '阅读时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
