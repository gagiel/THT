/*
Navicat MySQL Data Transfer

Source Server         : binhai
Source Server Version : 50173
Source Host           : 192.168.1.223:3306
Source Database       : binhai

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2016-02-25 11:24:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_plan_copy
-- ----------------------------
DROP TABLE IF EXISTS `t_plan_copy`;
CREATE TABLE `t_plan_copy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num` varchar(100) NOT NULL COMMENT '编号',
  `title` varchar(200) NOT NULL COMMENT '标题',
  `affairs` text NOT NULL COMMENT '导语',
  `start` datetime NOT NULL COMMENT '开始时间',
  `address` text NOT NULL COMMENT '地点',
  `info` text NOT NULL COMMENT '内容',
  `users` text COMMENT '提醒人员范围',
  `join_dept` text COMMENT '参加部门',
  `join_user` text COMMENT '出席领导',
  `inscribe` text COMMENT '落款',
  `state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 0未发布 1已发布 2已撤销',
  `creater` int(11) NOT NULL COMMENT '创建人',
  `c_num` int(11) NOT NULL DEFAULT '1' COMMENT '编号计数',
  `remark` text COMMENT '备注',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '类型 1会议 2调研 3商务接待 4公务接待 5其他',
  `nature` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1内事 2外事',
  `isdel` tinyint(1) NOT NULL DEFAULT '0' COMMENT '删除 0否 1是',
  `re_time` datetime DEFAULT NULL COMMENT '落款时间',
  `info_add` text,
  `c_point_lat` text,
  `c_point_lng` text,
  `names_show_shi` text,
  `names_show_qita` text,
  `department_show_shi` text,
  `department_show_qita` text,
  `names_show_qu` text,
  `department_show_qu` text,
  `c_person` text COMMENT '负责人字段',
  `info_title` text COMMENT '附件标题',
  `people_name` text COMMENT '联系人名',
  `people_phone` text COMMENT '联系人电话',
  `canyu_id` text COMMENT '参与人id集合',
  `fabu_id` int(11) DEFAULT NULL COMMENT '发布人的id',
  `tixing_id` text COMMENT '提醒人的id集合',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;
