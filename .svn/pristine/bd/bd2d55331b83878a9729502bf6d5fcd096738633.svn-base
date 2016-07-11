/*
Navicat MySQL Data Transfer

Source Server         : binhai
Source Server Version : 50173
Source Host           : 192.168.1.223:3306
Source Database       : binhai

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2016-02-25 11:25:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_remind_copy
-- ----------------------------
DROP TABLE IF EXISTS `t_remind_copy`;
CREATE TABLE `t_remind_copy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `info` text NOT NULL COMMENT '提醒内容',
  `t_start` datetime NOT NULL COMMENT '提醒开始时间',
  `t_end` datetime NOT NULL COMMENT '提醒结束时间',
  `userid` int(11) NOT NULL COMMENT '提醒创建人',
  `range_type` tinyint(1) NOT NULL COMMENT '提醒范围类型 1指定 2全部 3对外',
  `range_user` text COMMENT '被提醒人id，'',''分隔',
  `state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发布状态 0未发送，1已发送，2已撤回',
  `addtime` datetime NOT NULL COMMENT '新增时间',
  `plan_id` int(11) NOT NULL DEFAULT '0' COMMENT '活动方案ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
