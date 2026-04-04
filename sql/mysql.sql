# SQL Dump for wgtestmb module
# PhpMyAdmin Version: 4.0.4
# https://www.phpmyadmin.net
#
# Host: localhost
# Generated on: Sat Apr 04, 2026 to 12:47:55
# Server version: 9.1.0
# PHP Version: 8.3.14

#
# Structure table for `wgtestmb_categories` 5
#

CREATE TABLE `wgtestmb_categories` (
  `cat_id`        INT(8)          UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat_name`      VARCHAR(200)    NOT NULL DEFAULT '',
  `cat_logo`      VARCHAR(200)    NOT NULL DEFAULT '',
  `cat_created`   INT(10)         NOT NULL DEFAULT '0',
  `cat_submitter` INT(8)          NOT NULL DEFAULT '0',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB;

#
# Structure table for `wgtestmb_articles` 11
#

CREATE TABLE `wgtestmb_articles` (
  `art_id`        INT(8)          UNSIGNED NOT NULL AUTO_INCREMENT,
  `art_cat`       INT(10)         NOT NULL DEFAULT '0',
  `art_title`     VARCHAR(200)    NOT NULL DEFAULT '',
  `art_descr`     MEDIUMTEXT      NOT NULL ,
  `art_img`       VARCHAR(200)    NULL DEFAULT '',
  `art_status`    INT(1)          NOT NULL DEFAULT '0',
  `art_file`      VARCHAR(200)    NOT NULL DEFAULT '',
  `art_ratings`   DOUBLE(10, 2)   NOT NULL DEFAULT '0.00',
  `art_votes`     INT(10)         NOT NULL DEFAULT '0',
  `art_created`   INT(10)         NOT NULL DEFAULT '0',
  `art_submitter` INT(10)         NOT NULL DEFAULT '0',
  PRIMARY KEY (`art_id`)
) ENGINE=InnoDB;

#
# Structure table for `wgtestmb_testfields` 28
#

CREATE TABLE `wgtestmb_testfields` (
  `tf_id`             INT(8)          UNSIGNED NOT NULL AUTO_INCREMENT,
  `tf_text`           VARCHAR(255)    NOT NULL DEFAULT '',
  `tf_textarea`       TEXT            NOT NULL ,
  `tf_dhtml`          TEXT            NOT NULL ,
  `tf_checkbox`       INT(10)         NOT NULL DEFAULT '0',
  `tf_yesno`          INT(1)          NOT NULL DEFAULT '0',
  `tf_selectbox`      INT(10)         NOT NULL DEFAULT '0',
  `tf_user`           INT(10)         NOT NULL DEFAULT '0',
  `tf_color`          VARCHAR(7)      NOT NULL DEFAULT '',
  `tf_imagelist`      VARCHAR(255)    NOT NULL DEFAULT '',
  `tf_urlfile`        VARCHAR(255)    NOT NULL DEFAULT '',
  `tf_uplimage`       VARCHAR(255)    NOT NULL DEFAULT '',
  `tf_uplfile`        VARCHAR(255)    NOT NULL DEFAULT '',
  `tf_textdateselect` INT(10)         NOT NULL DEFAULT '0',
  `tf_selectfile`     VARCHAR(255)    NOT NULL DEFAULT '',
  `tf_password`       VARCHAR(255)    NOT NULL DEFAULT '',
  `tf_country_list`   VARCHAR(3)      NOT NULL DEFAULT '',
  `tf_language`       VARCHAR(100)    NOT NULL DEFAULT '',
  `tf_radio`          INT(10)         NOT NULL DEFAULT '0',
  `tf_status`         INT(1)          NOT NULL DEFAULT '0',
  `tf_datetime`       INT(10)         NOT NULL DEFAULT '0',
  `tf_combobox`       INT(10)         NOT NULL DEFAULT '0',
  `tf_comments`       INT(10)         NOT NULL DEFAULT '0',
  `tf_ratings`        DOUBLE(10, 2)   NOT NULL DEFAULT '0.00',
  `tf_votes`          INT(10)         NOT NULL DEFAULT '0',
  `tf_uuid`           VARCHAR(45)     NOT NULL DEFAULT '',
  `tf_ip`             VARCHAR(16)     NOT NULL DEFAULT '',
  `tf_reads`          INT(10)         NOT NULL DEFAULT '0',
  PRIMARY KEY (`tf_id`)
) ENGINE=InnoDB;

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

#
# Structure table for `wgtestmb_ratings` 6
#

CREATE TABLE `wgtestmb_ratings` (
  `rate_id` INT(8)          UNSIGNED NOT NULL AUTO_INCREMENT,
  `rate_itemid` INT(8)          NOT NULL DEFAULT '0',
  `rate_source` INT(8)          NOT NULL DEFAULT '0',
  `rate_value` INT(1)          NOT NULL DEFAULT '0',
  `rate_uid` INT(8)          NOT NULL DEFAULT '0',
  `rate_ip` VARCHAR(60)     NOT NULL DEFAULT '',
  `rate_date` INT(8)          NOT NULL DEFAULT '0',
  PRIMARY KEY (`rate_id`)
) ENGINE=InnoDB;

