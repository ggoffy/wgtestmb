# SQL Dump for wgtestmb module
# PhpMyAdmin Version: 4.0.4
# https://www.phpmyadmin.net
#
# Host: localhost
# Generated on: Thu Mar 26, 2026 to 19:42:06
# Server version: 9.1.0
# PHP Version: 8.3.14

#
# Structure table for `wgtestmb_testtable1` 5
#

CREATE TABLE `wgtestmb_testtable1` (
  `tt1_id`       INT(8)          UNSIGNED NOT NULL AUTO_INCREMENT,
  `tt1_name`     VARCHAR(255)    NOT NULL DEFAULT '',
  `tt1_date`     INT(11)         NOT NULL DEFAULT '0',
  `tt1_status`   INT(1)          NOT NULL DEFAULT '0',
  `tt1_comments` INT(10)         NOT NULL DEFAULT '0',
  PRIMARY KEY (`tt1_id`)
) ENGINE=InnoDB;

