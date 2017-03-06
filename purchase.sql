/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50711
Source Host           : localhost:3306
Source Database       : purchase

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2017-03-06 12:49:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `pur_ask_order`
-- ----------------------------
DROP TABLE IF EXISTS `pur_ask_order`;
CREATE TABLE `pur_ask_order` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_number` varchar(10) NOT NULL,
  `buyer_id` int(8) NOT NULL,
  `order_name` varchar(64) NOT NULL,
  `product` text NOT NULL,
  `asked` int(1) NOT NULL DEFAULT '0',
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pur_ask_order
-- ----------------------------
INSERT INTO `pur_ask_order` VALUES ('6', 'HN5tKJqbM2', '1', '足球等', '[{\"product_name\":\"足球\",\"product_num\":\"5\",\"product_unit\":\"个\"},{\"product_name\":\"篮球\",\"product_num\":\"6\",\"product_unit\":\"个\"},{\"product_name\":\"牛肉\",\"product_num\":\"10\",\"product_unit\":\"斤\"}]', '1', '0');
INSERT INTO `pur_ask_order` VALUES ('7', 'gSKkkU6HR7', '1', '毛巾篮球牛肉', '[{\"product_name\":\"篮球\",\"product_num\":\"6\",\"product_unit\":\"个\"},{\"product_name\":\"牛肉\",\"product_num\":\"10\",\"product_unit\":\"斤\"}]', '1', '0');
INSERT INTO `pur_ask_order` VALUES ('8', 'crmf32aQ5Q', '1', '毛巾和浴巾', '[{\"product_name\":\"毛巾\",\"product_num\":\"4\",\"product_unit\":\"条\"},{\"product_name\":\"浴巾\",\"product_num\":\"4\",\"product_unit\":\"条\"}]', '1', '0');

-- ----------------------------
-- Table structure for `pur_buyer`
-- ----------------------------
DROP TABLE IF EXISTS `pur_buyer`;
CREATE TABLE `pur_buyer` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `buyer_name` varchar(255) NOT NULL DEFAULT '帅哥买家',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pur_buyer
-- ----------------------------
INSERT INTO `pur_buyer` VALUES ('1', 'buyer1', 'buyer1', '帅哥买家');
INSERT INTO `pur_buyer` VALUES ('2', 'buyer2', 'buyer2', '美女买家');
INSERT INTO `pur_buyer` VALUES ('3', 'nenu', 'nenu', '东师买家');

-- ----------------------------
-- Table structure for `pur_reply_order`
-- ----------------------------
DROP TABLE IF EXISTS `pur_reply_order`;
CREATE TABLE `pur_reply_order` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `order_number` varchar(10) NOT NULL,
  `buyer_id` int(8) NOT NULL,
  `seller_id` int(8) NOT NULL,
  `order_name` varchar(64) NOT NULL,
  `product` text NOT NULL,
  `product_reply` text,
  `total_price` double(10,2) DEFAULT NULL,
  `replied` int(1) DEFAULT '0',
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pur_reply_order
-- ----------------------------
INSERT INTO `pur_reply_order` VALUES ('8', 'HN5tKJqbM2', '1', '1', '足球等', '[{\"product_name\":\"足球\",\"product_num\":\"5\",\"product_unit\":\"个\"},{\"product_name\":\"篮球\",\"product_num\":\"6\",\"product_unit\":\"个\"},{\"product_name\":\"牛肉\",\"product_num\":\"10\",\"product_unit\":\"斤\"}]', '[{\"product_name\":\"足球\",\"product_num\":\"5\",\"product_unit\":\"个\",\"product_price\":\"600\"},{\"product_name\":\"篮球\",\"product_num\":\"6\",\"product_unit\":\"个\",\"product_price\":\"700.7\"},{\"product_name\":\"牛肉\",\"product_num\":\"10\",\"product_unit\":\"斤\",\"product_price\":\"500\"}]', '1800.70', '1', '0');
INSERT INTO `pur_reply_order` VALUES ('9', 'HN5tKJqbM2', '1', '2', '足球等', '[{\"product_name\":\"足球\",\"product_num\":\"5\",\"product_unit\":\"个\"},{\"product_name\":\"篮球\",\"product_num\":\"6\",\"product_unit\":\"个\"},{\"product_name\":\"牛肉\",\"product_num\":\"10\",\"product_unit\":\"斤\"}]', '[{\"product_name\":\"足球\",\"product_num\":\"5\",\"product_unit\":\"个\",\"product_price\":\"500.99\"},{\"product_name\":\"篮球\",\"product_num\":\"6\",\"product_unit\":\"个\",\"product_price\":\"600\"},{\"product_name\":\"牛肉\",\"product_num\":\"10\",\"product_unit\":\"斤\",\"product_price\":\"400.5\"}]', '1501.49', '1', '0');
INSERT INTO `pur_reply_order` VALUES ('10', 'gSKkkU6HR7', '1', '1', '毛巾篮球牛肉', '[{\"product_name\":\"篮球\",\"product_num\":\"6\",\"product_unit\":\"个\"},{\"product_name\":\"牛肉\",\"product_num\":\"10\",\"product_unit\":\"斤\"}]', null, null, '0', '0');
INSERT INTO `pur_reply_order` VALUES ('11', 'gSKkkU6HR7', '1', '2', '毛巾篮球牛肉', '[{\"product_name\":\"篮球\",\"product_num\":\"6\",\"product_unit\":\"个\"},{\"product_name\":\"牛肉\",\"product_num\":\"10\",\"product_unit\":\"斤\"}]', null, null, '0', '0');
INSERT INTO `pur_reply_order` VALUES ('12', 'crmf32aQ5Q', '1', '1', '毛巾和浴巾', '[{\"product_name\":\"毛巾\",\"product_num\":\"4\",\"product_unit\":\"条\"},{\"product_name\":\"浴巾\",\"product_num\":\"4\",\"product_unit\":\"条\"}]', null, null, '0', '0');
INSERT INTO `pur_reply_order` VALUES ('13', 'crmf32aQ5Q', '1', '2', '毛巾和浴巾', '[{\"product_name\":\"毛巾\",\"product_num\":\"4\",\"product_unit\":\"条\"},{\"product_name\":\"浴巾\",\"product_num\":\"4\",\"product_unit\":\"条\"}]', '[{\"product_name\":\"毛巾\",\"product_num\":\"4\",\"product_unit\":\"条\",\"product_price\":\"40\"},{\"product_name\":\"浴巾\",\"product_num\":\"4\",\"product_unit\":\"条\",\"product_price\":\"40.9\"}]', '80.90', '1', '0');

-- ----------------------------
-- Table structure for `pur_seller`
-- ----------------------------
DROP TABLE IF EXISTS `pur_seller`;
CREATE TABLE `pur_seller` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `seller_name` varchar(255) NOT NULL DEFAULT '帅哥卖家',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pur_seller
-- ----------------------------
INSERT INTO `pur_seller` VALUES ('1', 'seller1', 'seller1', '卖家1号');
INSERT INTO `pur_seller` VALUES ('2', 'seller2', 'seller2', '南京义乌商品城');
INSERT INTO `pur_seller` VALUES ('3', 'nenu', 'nenu', '东师小卖铺');
