/*
 Navicat Premium Data Transfer

 Source Server         : LOCALHOST
 Source Server Type    : MySQL
 Source Server Version : 80033 (8.0.33)
 Source Host           : localhost:3306
 Source Schema         : cmpho_plans

 Target Server Type    : MySQL
 Target Server Version : 80033 (8.0.33)
 File Encoding         : 65001

 Date: 20/09/2024 11:12:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cache
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for departments
-- ----------------------------
DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
  `dept_id` int NOT NULL AUTO_INCREMENT,
  `dept_name` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of departments
-- ----------------------------
BEGIN;
INSERT INTO `departments` (`dept_id`, `dept_name`) VALUES (1, 'งานพัฒนายุทธศาสตร์ (สสจ.ชม.)');
INSERT INTO `departments` (`dept_id`, `dept_name`) VALUES (2, 'งานการเงิน (สสจ.ชม.)');
INSERT INTO `departments` (`dept_id`, `dept_name`) VALUES (3, 'งานเลขานุการ (สสจ.ชม.)');
INSERT INTO `departments` (`dept_id`, `dept_name`) VALUES (4, 'หน่วยบริการ');
COMMIT;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for hospital
-- ----------------------------
DROP TABLE IF EXISTS `hospital`;
CREATE TABLE `hospital` (
  `h_code` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `h_name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`h_code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of hospital
-- ----------------------------
BEGIN;
INSERT INTO `hospital` (`h_code`, `h_name`) VALUES ('00037', 'สำนักงานสาธารณสุขจังหวัดเชียงใหม่');
INSERT INTO `hospital` (`h_code`, `h_name`) VALUES ('06009', 'โรงพยาบาลแม่ตื่น');
INSERT INTO `hospital` (`h_code`, `h_name`) VALUES ('10713', 'โรงพยาบาลนครพิงค์');
INSERT INTO `hospital` (`h_code`, `h_name`) VALUES ('11119', 'โรงพยาบาลจอมทอง');
INSERT INTO `hospital` (`h_code`, `h_name`) VALUES ('11120', 'โรงพยาบาลเทพรัตนฯ');
INSERT INTO `hospital` (`h_code`, `h_name`) VALUES ('11121', 'โรงพยาบาลเชียงดาว');
INSERT INTO `hospital` (`h_code`, `h_name`) VALUES ('11122', 'โรงพยาบาลดอยสะเก็ด');
INSERT INTO `hospital` (`h_code`, `h_name`) VALUES ('11123', 'โรงพยาบาลแม่แตง');
INSERT INTO `hospital` (`h_code`, `h_name`) VALUES ('11124', 'โรงพยาบาลสะเมิง');
INSERT INTO `hospital` (`h_code`, `h_name`) VALUES ('11125', 'โรงพยาบาลฝาง');
INSERT INTO `hospital` (`h_code`, `h_name`) VALUES ('11126', 'โรงพยาบาลแม่อาย');
INSERT INTO `hospital` (`h_code`, `h_name`) VALUES ('11127', 'โรงพยาบาลพร้าว');
INSERT INTO `hospital` (`h_code`, `h_name`) VALUES ('11128', 'โรงพยาบาลสันป่าตอง');
INSERT INTO `hospital` (`h_code`, `h_name`) VALUES ('11129', 'โรงพยาบาลสันกำแพง');
INSERT INTO `hospital` (`h_code`, `h_name`) VALUES ('11130', 'โรงพยาบาลสันทราย');
INSERT INTO `hospital` (`h_code`, `h_name`) VALUES ('11131', 'โรงพยาบาลหางดง');
INSERT INTO `hospital` (`h_code`, `h_name`) VALUES ('11132', 'โรงพยาบาลฮอด');
INSERT INTO `hospital` (`h_code`, `h_name`) VALUES ('11133', 'โรงพยาบาลดอยเต่า');
INSERT INTO `hospital` (`h_code`, `h_name`) VALUES ('11134', 'โรงพยาบาลอมก๋อย');
INSERT INTO `hospital` (`h_code`, `h_name`) VALUES ('11135', 'โรงพยาบาลสารภี');
INSERT INTO `hospital` (`h_code`, `h_name`) VALUES ('11136', 'โรงพยาบาลเวียงแหง');
INSERT INTO `hospital` (`h_code`, `h_name`) VALUES ('11137', 'โรงพยาบาลไชยปราการ');
INSERT INTO `hospital` (`h_code`, `h_name`) VALUES ('11138', 'โรงพยาบาลแม่วาง');
INSERT INTO `hospital` (`h_code`, `h_name`) VALUES ('11139', 'โรงพยาบาลแม่ออน');
INSERT INTO `hospital` (`h_code`, `h_name`) VALUES ('11643', 'โรงพยาบาลดอยหล่อ');
INSERT INTO `hospital` (`h_code`, `h_name`) VALUES ('23736', 'โรงพยาบาลวัดจันทร์ฯ');
COMMIT;

-- ----------------------------
-- Table structure for job_batches
-- ----------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of job_batches
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
COMMIT;

-- ----------------------------
-- Table structure for p_status
-- ----------------------------
DROP TABLE IF EXISTS `p_status`;
CREATE TABLE `p_status` (
  `p_status_id` int NOT NULL AUTO_INCREMENT,
  `p_status_name` text COLLATE utf8mb4_general_ci,
  `p_status_color` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `p_status_icon` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`p_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of p_status
-- ----------------------------
BEGIN;
INSERT INTO `p_status` (`p_status_id`, `p_status_name`, `p_status_color`, `p_status_icon`) VALUES (1, 'รอดำเนินการ', 'text-info', '<i class=\"fa-solid fa-spinner fa-spin\"></i>');
INSERT INTO `p_status` (`p_status_id`, `p_status_name`, `p_status_color`, `p_status_icon`) VALUES (2, 'อยู่ระหว่างดำเนินการ', 'text-primary', '<i class=\"fa-solid fa-list-check\"></i>');
INSERT INTO `p_status` (`p_status_id`, `p_status_name`, `p_status_color`, `p_status_icon`) VALUES (3, 'อนุมัติแล้ว', 'text-success', '<i class=\"fa-solid fa-envelope-circle-check\"></i>');
COMMIT;

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for plan_budget
-- ----------------------------
DROP TABLE IF EXISTS `plan_budget`;
CREATE TABLE `plan_budget` (
  `budget_id` int NOT NULL AUTO_INCREMENT,
  `budget_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`budget_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of plan_budget
-- ----------------------------
BEGIN;
INSERT INTO `plan_budget` (`budget_id`, `budget_name`) VALUES (1, 'เงินบำรุง');
INSERT INTO `plan_budget` (`budget_id`, `budget_name`) VALUES (2, 'เงินบำรุง (กองทุนหลักประกันสุขภาพถ้วนหน้า)');
INSERT INTO `plan_budget` (`budget_id`, `budget_name`) VALUES (3, 'งบศูนย์แพทย์');
INSERT INTO `plan_budget` (`budget_id`, `budget_name`) VALUES (4, 'เงินงบประมาน');
INSERT INTO `plan_budget` (`budget_id`, `budget_name`) VALUES (5, 'เงินอุดหนุนโครงการหลวง');
INSERT INTO `plan_budget` (`budget_id`, `budget_name`) VALUES (6, 'งบโรงพยาบาลเฉลิมพระเกียรติ');
COMMIT;

-- ----------------------------
-- Table structure for plan_list
-- ----------------------------
DROP TABLE IF EXISTS `plan_list`;
CREATE TABLE `plan_list` (
  `plan_id` int NOT NULL AUTO_INCREMENT,
  `uuid` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `plan_hos` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `plan_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `plan_budget_id` int DEFAULT NULL,
  `plan_total` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `plan_doc_no` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `plan_doc_date` date DEFAULT NULL,
  `plan_files` text COLLATE utf8mb4_general_ci,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `plan_receive` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `plan_receive_date` date DEFAULT NULL,
  `plan_approve_date` date DEFAULT NULL,
  `plan_approve_doc_no` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `plan_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '1',
  PRIMARY KEY (`plan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of plan_list
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for plan_log
-- ----------------------------
DROP TABLE IF EXISTS `plan_log`;
CREATE TABLE `plan_log` (
  `log_id` int NOT NULL AUTO_INCREMENT,
  `log_plan_id` text COLLATE utf8mb4_general_ci,
  `log_dept_id` int DEFAULT '1',
  `log_status_id` int DEFAULT NULL,
  `log_note` text COLLATE utf8mb4_general_ci,
  `create_at` datetime DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of plan_log
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for plan_log_status
-- ----------------------------
DROP TABLE IF EXISTS `plan_log_status`;
CREATE TABLE `plan_log_status` (
  `status_id` int NOT NULL AUTO_INCREMENT,
  `status_name` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of plan_log_status
-- ----------------------------
BEGIN;
INSERT INTO `plan_log_status` (`status_id`, `status_name`) VALUES (1, 'รับเข้าแผนงานโครงการ');
INSERT INTO `plan_log_status` (`status_id`, `status_name`) VALUES (2, 'กำลังตรวจสอบ');
INSERT INTO `plan_log_status` (`status_id`, `status_name`) VALUES (3, 'ส่งกลับแก้ไข');
INSERT INTO `plan_log_status` (`status_id`, `status_name`) VALUES (4, 'ตรวจสอบแล้ว');
INSERT INTO `plan_log_status` (`status_id`, `status_name`) VALUES (5, 'อนุมัติแล้ว');
COMMIT;

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `role_name` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of role
-- ----------------------------
BEGIN;
INSERT INTO `role` (`role_id`, `role_name`) VALUES (1, 'ผู้ดูแลระบบ');
INSERT INTO `role` (`role_id`, `role_name`) VALUES (2, 'ผู้ดูแลระบบ (สสจ.เชียงใหม่)');
INSERT INTO `role` (`role_id`, `role_name`) VALUES (3, 'ผู้ใช้งานทั่วไป (หน่วยบริการ)');
INSERT INTO `role` (`role_id`, `role_name`) VALUES (4, 'ผู้ใช้งานทั่วไป (สสจ.เชียงใหม่)');
COMMIT;

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of sessions
-- ----------------------------
BEGIN;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('5JGgAFsdrEOl5pyqhEqczV99nqvjGpuNUVOjfgOO', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidWVXQ3RzTXFHV1Y4MVNvRWpGVTNzWmZ6aklGTVhTckFMSkxsMm1qYSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovL2xvY2FsaG9zdDo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fX0=', 1726805443);
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `uuid` text COLLATE utf8mb4_unicode_ci,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `hcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `department_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` (`id`, `uuid`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `hcode`, `role`, `department_id`) VALUES (1, '3954b1d5-78e9-4c3b-99c1-2afd7c00355a', 'ผู้ดูแลระบบ', 'cmpho@00037', NULL, '$2y$12$sCyt7mQbKQHscFq8LDgpRuiF7/UwvMeSngxIkeT6FCi6oCEecSufu', NULL, NULL, NULL, '00037', '1', 1);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
