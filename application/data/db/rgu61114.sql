/*
Navicat PGSQL Data Transfer

Source Server         : localhost
Source Server Version : 90208
Source Host           : localhost:5432
Source Database       : rgu61114
Source Schema         : public

Target Server Type    : PGSQL
Target Server Version : 90208
File Encoding         : 65001

Date: 2014-11-06 23:24:03
*/


-- ----------------------------
-- Sequence structure for "activity_feed_id_activity_feed_seq"
-- ----------------------------
DROP SEQUENCE "activity_feed_id_activity_feed_seq";
CREATE SEQUENCE "activity_feed_id_activity_feed_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 62
 CACHE 1;

-- ----------------------------
-- Sequence structure for "authority_id_authority_seq"
-- ----------------------------
DROP SEQUENCE "authority_id_authority_seq";
CREATE SEQUENCE "authority_id_authority_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 8519
 CACHE 1;

-- ----------------------------
-- Sequence structure for "authority_property_id_authority_property_seq"
-- ----------------------------
DROP SEQUENCE "authority_property_id_authority_property_seq";
CREATE SEQUENCE "authority_property_id_authority_property_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 50595
 CACHE 1;

-- ----------------------------
-- Sequence structure for "authority_status_id_authority_status_seq"
-- ----------------------------
DROP SEQUENCE "authority_status_id_authority_status_seq";
CREATE SEQUENCE "authority_status_id_authority_status_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 5
 CACHE 1;

-- ----------------------------
-- Sequence structure for "comment_id_comment_seq"
-- ----------------------------
DROP SEQUENCE "comment_id_comment_seq";
CREATE SEQUENCE "comment_id_comment_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 109
 CACHE 1;

-- ----------------------------
-- Sequence structure for "event_type_id_event_type_seq"
-- ----------------------------
DROP SEQUENCE "event_type_id_event_type_seq";
CREATE SEQUENCE "event_type_id_event_type_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 9
 CACHE 1;

-- ----------------------------
-- Sequence structure for "files_id_file_seq"
-- ----------------------------
DROP SEQUENCE "files_id_file_seq";
CREATE SEQUENCE "files_id_file_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 27
 CACHE 1;

-- ----------------------------
-- Sequence structure for "history_log_id_history_log_seq"
-- ----------------------------
DROP SEQUENCE "history_log_id_history_log_seq";
CREATE SEQUENCE "history_log_id_history_log_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 40
 CACHE 1;

-- ----------------------------
-- Sequence structure for "organization_id_organization_seq"
-- ----------------------------
DROP SEQUENCE "organization_id_organization_seq";
CREATE SEQUENCE "organization_id_organization_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 58
 CACHE 1;

-- ----------------------------
-- Sequence structure for "organization_rank_id_organization_rank_seq"
-- ----------------------------
DROP SEQUENCE "organization_rank_id_organization_rank_seq";
CREATE SEQUENCE "organization_rank_id_organization_rank_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 2
 CACHE 1;

-- ----------------------------
-- Sequence structure for "property_commits_id_property_commit_seq"
-- ----------------------------
DROP SEQUENCE "property_commits_id_property_commit_seq";
CREATE SEQUENCE "property_commits_id_property_commit_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 7
 CACHE 1;

-- ----------------------------
-- Sequence structure for "property_format_id_property_format_seq"
-- ----------------------------
DROP SEQUENCE "property_format_id_property_format_seq";
CREATE SEQUENCE "property_format_id_property_format_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 7
 CACHE 1;

-- ----------------------------
-- Sequence structure for "property_id_property_seq"
-- ----------------------------
DROP SEQUENCE "property_id_property_seq";
CREATE SEQUENCE "property_id_property_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1080
 CACHE 1;

-- ----------------------------
-- Sequence structure for "property_values_property_value_id_seq"
-- ----------------------------
DROP SEQUENCE "property_values_property_value_id_seq";
CREATE SEQUENCE "property_values_property_value_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 5
 CACHE 1;

-- ----------------------------
-- Sequence structure for "service_id_service_seq"
-- ----------------------------
DROP SEQUENCE "service_id_service_seq";
CREATE SEQUENCE "service_id_service_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 5674
 CACHE 1;

-- ----------------------------
-- Sequence structure for "service_property_id_service_property_seq"
-- ----------------------------
DROP SEQUENCE "service_property_id_service_property_seq";
CREATE SEQUENCE "service_property_id_service_property_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 53831
 CACHE 1;

-- ----------------------------
-- Sequence structure for "service_type_id_service_type_seq"
-- ----------------------------
DROP SEQUENCE "service_type_id_service_type_seq";
CREATE SEQUENCE "service_type_id_service_type_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 10
 CACHE 1;

-- ----------------------------
-- Sequence structure for "spher_id_spher_seq"
-- ----------------------------
DROP SEQUENCE "spher_id_spher_seq";
CREATE SEQUENCE "spher_id_spher_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 24
 CACHE 1;

-- ----------------------------
-- Sequence structure for "users_id_user_seq"
-- ----------------------------
DROP SEQUENCE "users_id_user_seq";
CREATE SEQUENCE "users_id_user_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 4
 CACHE 1;
