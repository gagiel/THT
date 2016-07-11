/*
Navicat MySQL Data Transfer

Source Server         : binhai
Source Server Version : 50173
Source Host           : 192.168.1.223:3306
Source Database       : binhai

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2016-02-25 11:24:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_plan_division_copy
-- ----------------------------
DROP TABLE IF EXISTS `t_plan_division_copy`;
CREATE TABLE `t_plan_division_copy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_id` int(11) NOT NULL COMMENT '方案ID',
  `f_info` text NOT NULL COMMENT '分工内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1739 DEFAULT CHARSET=utf8;
