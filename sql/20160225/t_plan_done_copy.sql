/*
Navicat MySQL Data Transfer

Source Server         : binhai
Source Server Version : 50173
Source Host           : 192.168.1.223:3306
Source Database       : binhai

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2016-02-25 11:24:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_plan_done_copy
-- ----------------------------
DROP TABLE IF EXISTS `t_plan_done_copy`;
CREATE TABLE `t_plan_done_copy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_id` int(11) NOT NULL COMMENT '方案ID',
  `d_time` varchar(20) DEFAULT NULL COMMENT '时间',
  `d_info` text NOT NULL COMMENT '内容',
  `c_plan_more` text COMMENT '多日方案',
  `c_time_start` varchar(255) DEFAULT NULL COMMENT '多日方案开始时间(用于判断)',
  `c_time_end` varchar(255) DEFAULT NULL COMMENT '多日方案结束时间',
  `c_time_xi` varchar(255) DEFAULT NULL COMMENT '安排细项的时间',
  `c_plan_more_xi` text COMMENT '细项内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1722 DEFAULT CHARSET=utf8;
