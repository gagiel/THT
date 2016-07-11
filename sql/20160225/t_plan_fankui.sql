/*
Navicat MySQL Data Transfer

Source Server         : binhai
Source Server Version : 50173
Source Host           : 192.168.1.223:3306
Source Database       : binhai

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2016-02-25 11:24:51
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_plan_fankui
-- ----------------------------
DROP TABLE IF EXISTS `t_plan_fankui`;
CREATE TABLE `t_plan_fankui` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(255) DEFAULT NULL COMMENT '反馈人名称',
  `u_id` int(11) DEFAULT NULL,
  `area` text COMMENT '反馈内容',
  `addtime` text COMMENT '反馈时间',
  `plan_id` int(11) DEFAULT NULL COMMENT '反馈对应的工作方案id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
