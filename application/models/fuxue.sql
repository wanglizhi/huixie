create database fuxue;

use fuxue;

#所有数据表

#用户表
create table `user`(
`openid` varchar(255) NOT NULL PRIMARY KEY,
`unionid` varchar(255) NOT NULL,
`nickname` varchar(64),
`sex` tinyint(4),
`city` varchar(255),
`country` varchar(255),
`province` varchar(255),
`language` varchar(64),
`headimgurl` text,
`remark` varchar(64),
`groupid` varchar(64),
`subscribe_time` int(11),
`subscribe` tinyint(4),

`university` varchar(64) DEFAULT NULL,
`email` varchar(128) DEFAULT NULL,

`createTime` datetime NOT NULL
)

#TA表
create table `ta`(
`openid` varchar(255) NOT NULL PRIMARY KEY,
`name` varchar(64),
`skills` varchar(128),
`star` float,
`unitPrice` int(11),
`createTime` datetime,
`email` varchar(128)
)

#订单表
create table `order`(
`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
`orderNum` varchar(64) NOT NULL,
`major` varchar(128) NOT NULL,
`courseName` varchar(128) NOT NULL,
`email` varchar(128) NOT NULL,
`pageNum` int(11) NOT NULL,
`refDoc` int(11) NOT NULL,
`endTime` datetime NOT NULL,
`requirement` text,

`userId` varchar(255) NOT NULL,
`taId` varchar(255),
`price` int(11),
`hasPaid` tinyint(4) DEFAULT 0,
`hasTaken` tinyint(4) DEFAULT 0,
`hasFinished` tinyint(4) DEFAULT 0,
`createTime` datetime NOT NULL,
`paidTime` datetime,
`takenTime` datetime,
`finishedTime` datetime
)
#推送的TA列表
create table `selectedTa`(
`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
`taId` varchar(255) NOT NULL,
`orderNum` varchar(64) NOT NULL,
`createTime` datetime NOT NULL
)

#access_token列表
create table `ctoken`(
`appid` varchar(255) NOT NULL,
`token` varchar(255) PRIMARY KEY,
`expire` int(11) DEFAULT NULL,
`createTime` int(11) DEFAULT NULL
)

create table `admin`(
`name` varchar(64) NOT NUll PRIMARY KEY,
`password` varchar(64)
)