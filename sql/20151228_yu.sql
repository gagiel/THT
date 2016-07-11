/*
Navicat MySQL Data Transfer

Source Server         : bihai
Source Server Version : 50173
Source Host           : 192.168.1.223:3306
Source Database       : binhai

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2015-12-28 17:12:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_send_massage
-- ----------------------------
DROP TABLE IF EXISTS `t_send_massage`;
CREATE TABLE `t_send_massage` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键自增id',
  `callid` int(11) NOT NULL COMMENT '发信人id(user表)',
  `msg` text COMMENT '短信内容',
  `mpid` text COMMENT '名片人员id集(以 , 间隔，如果为0表示没有选择名片人员)',
  `nbid` text COMMENT '工作人员id(user表)如果为0表示没有选择工作人员',
  `time` datetime DEFAULT NULL COMMENT '短信发送时间',
  `otherphone` text COMMENT '添加其他的电话号码',
  `is_del` int(11) DEFAULT NULL COMMENT '删除标识0未删除1未已删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
