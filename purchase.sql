/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50711
Source Host           : localhost:3306
Source Database       : purchase

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2017-03-05 22:55:35
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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pur_ask_order
-- ----------------------------
INSERT INTO `pur_ask_order` VALUES ('6', 'HN5tKJqbM2', '1', '足球等', '[{\"product_name\":\"足球\",\"product_num\":\"5\",\"product_unit\":\"个\"},{\"product_name\":\"篮球\",\"product_num\":\"6\",\"product_unit\":\"个\"},{\"product_name\":\"牛肉\",\"product_num\":\"10\",\"product_unit\":\"斤\"}]', '1', '0');
INSERT INTO `pur_ask_order` VALUES ('7', 'gSKkkU6HR7', '1', '毛巾篮球牛肉', '[{\"product_name\":\"篮球\",\"product_num\":\"6\",\"product_unit\":\"个\"},{\"product_name\":\"牛肉\",\"product_num\":\"10\",\"product_unit\":\"斤\"}]', '1', '0');

-- ----------------------------
-- Table structure for `pur_buyer`
-- ----------------------------
DROP TABLE IF EXISTS `pur_buyer`;
CREATE TABLE `pur_buyer` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `buyer_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pur_buyer
-- ----------------------------
INSERT INTO `pur_buyer` VALUES ('1', 'buyer1', 'buyer1', '帅哥买家');
INSERT INTO `pur_buyer` VALUES ('2', 'buyer2', 'buyer2', '郝锦');
INSERT INTO `pur_buyer` VALUES ('3', 'nenu', 'nenu', '东北师范大学买家');

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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pur_reply_order
-- ----------------------------
INSERT INTO `pur_reply_order` VALUES ('8', 'HN5tKJqbM2', '1', '1', '足球等', '[{\"product_name\":\"足球\",\"product_num\":\"5\",\"product_unit\":\"个\"},{\"product_name\":\"篮球\",\"product_num\":\"6\",\"product_unit\":\"个\"},{\"product_name\":\"牛肉\",\"product_num\":\"10\",\"product_unit\":\"斤\"}]', '[{\"product_name\":\"足球\",\"product_num\":\"5\",\"product_unit\":\"个\",\"product_price\":\"600\"},{\"product_name\":\"篮球\",\"product_num\":\"6\",\"product_unit\":\"个\",\"product_price\":\"700.7\"},{\"product_name\":\"牛肉\",\"product_num\":\"10\",\"product_unit\":\"斤\",\"product_price\":\"500\"}]', '1800.70', '1', '0');
INSERT INTO `pur_reply_order` VALUES ('9', 'HN5tKJqbM2', '1', '2', '足球等', '[{\"product_name\":\"足球\",\"product_num\":\"5\",\"product_unit\":\"个\"},{\"product_name\":\"篮球\",\"product_num\":\"6\",\"product_unit\":\"个\"},{\"product_name\":\"牛肉\",\"product_num\":\"10\",\"product_unit\":\"斤\"}]', '[{\"product_name\":\"足球\",\"product_num\":\"5\",\"product_unit\":\"个\",\"product_price\":\"500.99\"},{\"product_name\":\"篮球\",\"product_num\":\"6\",\"product_unit\":\"个\",\"product_price\":\"600\"},{\"product_name\":\"牛肉\",\"product_num\":\"10\",\"product_unit\":\"斤\",\"product_price\":\"400.5\"}]', '1501.49', '1', '0');
INSERT INTO `pur_reply_order` VALUES ('10', 'gSKkkU6HR7', '1', '1', '毛巾篮球牛肉', '[{\"product_name\":\"篮球\",\"product_num\":\"6\",\"product_unit\":\"个\"},{\"product_name\":\"牛肉\",\"product_num\":\"10\",\"product_unit\":\"斤\"}]', null, null, '0', '0');
INSERT INTO `pur_reply_order` VALUES ('11', 'gSKkkU6HR7', '1', '2', '毛巾篮球牛肉', '[{\"product_name\":\"篮球\",\"product_num\":\"6\",\"product_unit\":\"个\"},{\"product_name\":\"牛肉\",\"product_num\":\"10\",\"product_unit\":\"斤\"}]', null, null, '0', '0');

-- ----------------------------
-- Table structure for `pur_seller`
-- ----------------------------
DROP TABLE IF EXISTS `pur_seller`;
CREATE TABLE `pur_seller` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `seller_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pur_seller
-- ----------------------------
INSERT INTO `pur_seller` VALUES ('1', 'nenu', 'nenu', '东北师范大学卖家');
INSERT INTO `pur_seller` VALUES ('2', 'seller1', 'seller1', '帅哥卖家');
