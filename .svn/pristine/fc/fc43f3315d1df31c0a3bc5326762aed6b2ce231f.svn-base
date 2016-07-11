/*
Navicat MySQL Data Transfer

Source Server         : binhai
Source Server Version : 50173
Source Host           : 192.168.1.223:3306
Source Database       : binhai

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2016-02-25 11:24:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_plan_note
-- ----------------------------
DROP TABLE IF EXISTS `t_plan_note`;
CREATE TABLE `t_plan_note` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增',
  `u_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL COMMENT '操作人名称',
  `type` int(11) DEFAULT NULL COMMENT '操作类型0查看1修改2删除3导出',
  `time` varchar(255) DEFAULT NULL COMMENT '操作时间',
  `plan_id` int(11) DEFAULT NULL COMMENT '工作方案对应的id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
