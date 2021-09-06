-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- 主機: localhost:3306
-- 產生時間： 2019 年 11 月 01 日 08:50
-- 伺服器版本: 10.1.40-MariaDB-0ubuntu0.18.04.1
-- PHP 版本： 7.2.19-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `sias_ntus`
--
CREATE DATABASE IF NOT EXISTS `sias_ntus` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sias_ntus`;
CREATE USER 'sias_ntus'@'%' IDENTIFIED BY 'sias_ntus20191101';
GRANT ALL PRIVILEGES ON sias_ntus.* TO 'sias_ntus'@'%';

-- --------------------------------------------------------

--
-- 資料表結構 `functional_measurement`
--
-- 建立時間: 2019 年 11 月 01 日 00:33
--

CREATE TABLE IF NOT EXISTS `functional_measurement` (
  `fm_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `ubi_id` int(11) UNSIGNED NOT NULL COMMENT '個案編號',
  `created_at` varchar(20) DEFAULT NULL COMMENT '建立日期',
  `updated_at` varchar(20) DEFAULT NULL COMMENT '更新日期',
  `dominant` int(1) DEFAULT NULL COMMENT '慣用手/腳[1=右；2=左]',
  `squat_1` int(1) DEFAULT NULL COMMENT '深蹲_第一次[0=疼痛；1，2，3]',
  `squat_2` int(1) DEFAULT NULL COMMENT '深蹲_第二次[0=疼痛；1，2，3]',
  `squat_3` int(1) DEFAULT NULL COMMENT '深蹲_第三次[0=疼痛；1，2，3]',
  `squat` int(1) DEFAULT NULL COMMENT '深蹲_最後分數[0=疼痛；1，2，3]',
  `hurdle_l_1` int(1) DEFAULT NULL COMMENT '跨欄_左_第一次[0=疼痛；1，2，3]',
  `hurdle_l_2` int(1) DEFAULT NULL COMMENT '跨欄_左_第二次[0=疼痛；1，2，3]',
  `hurdle_l_3` int(1) DEFAULT NULL COMMENT '跨欄_左_第三次[0=疼痛；1，2，3]',
  `hurdle_r_1` int(1) DEFAULT NULL COMMENT '跨欄_右_第一次[0=疼痛；1，2，3]',
  `hurdle_r_2` int(1) DEFAULT NULL COMMENT '跨欄_右_第二次[0=疼痛；1，2，3]',
  `hurdle_r_3` int(1) DEFAULT NULL COMMENT '跨欄_右_第三次[0=疼痛；1，2，3]',
  `hurdle` int(1) DEFAULT NULL COMMENT '跨欄_最後分數[0=疼痛；1，2，3]',
  `lunge_l_1` int(1) DEFAULT NULL COMMENT '直線弓箭步_左_第一次[0=疼痛；1，2，3]',
  `lunge_l_2` int(1) DEFAULT NULL COMMENT '直線弓箭步_左_第二次[0=疼痛；1，2，3]',
  `lunge_l_3` int(1) DEFAULT NULL COMMENT '直線弓箭步_左_第三次[0=疼痛；1，2，3]',
  `lunge_r_1` int(1) DEFAULT NULL COMMENT '直線弓箭步_右_第一次[0=疼痛；1，2，3]',
  `lunge_r_2` int(1) DEFAULT NULL COMMENT '直線弓箭步_右_第二次[0=疼痛；1，2，3]',
  `lunge_r_3` int(1) DEFAULT NULL COMMENT '直線弓箭步_右_第三次[0=疼痛；1，2，3]',
  `lunge` int(1) DEFAULT NULL COMMENT '直線弓箭步_最後分數[0=疼痛；1，2，3]',
  `mobility_l_1` int(1) DEFAULT NULL COMMENT '肩關節活動度_左_第一次[0=疼痛；1，2，3]',
  `mobility_l_2` int(1) DEFAULT NULL COMMENT '肩關節活動度_左_第二次[0=疼痛；1，2，3]',
  `mobility_l_3` int(1) DEFAULT NULL COMMENT '肩關節活動度_左_第三次[0=疼痛；1，2，3]',
  `mobility_r_1` int(1) DEFAULT NULL COMMENT '肩關節活動度_右_第一次[0=疼痛；1，2，3]',
  `mobility_r_2` int(1) DEFAULT NULL COMMENT '肩關節活動度_右_第二次[0=疼痛；1，2，3]',
  `mobility_r_3` int(1) DEFAULT NULL COMMENT '肩關節活動度_右_第三次[0=疼痛；1，2，3]',
  `mobility` int(1) DEFAULT NULL COMMENT '肩關節活動度_最後分數[0=疼痛；1，2，3]',
  `slr_l_1` int(1) DEFAULT NULL COMMENT '單腿打直高抬_左_第一次[0=疼痛；1，2，3]',
  `slr_l_2` int(1) DEFAULT NULL COMMENT '單腿打直高抬_左_第二次[0=疼痛；1，2，3]',
  `slr_l_3` int(1) DEFAULT NULL COMMENT '單腿打直高抬_左_第三次[0=疼痛；1，2，3]',
  `slr_r_1` int(1) DEFAULT NULL COMMENT '單腿打直高抬_右_第一次[0=疼痛；1，2，3]',
  `slr_r_2` int(1) DEFAULT NULL COMMENT '單腿打直高抬_右_第二次[0=疼痛；1，2，3]',
  `slr_r_3` int(1) DEFAULT NULL COMMENT '單腿打直高抬_右_第三次[0=疼痛；1，2，3]',
  `slr` int(1) DEFAULT NULL COMMENT '單腿打直高抬_最後分數[0=疼痛；1，2，3]',
  `pushup_1` int(1) DEFAULT NULL COMMENT '俯臥撐地-軀幹穩定度_第一次[0=疼痛；1，2，3]',
  `pushup_2` int(1) DEFAULT NULL COMMENT '俯臥撐地-軀幹穩定度_第二次[0=疼痛；1，2，3]',
  `pushup_3` int(1) DEFAULT NULL COMMENT '俯臥撐地-軀幹穩定度_第三次[0=疼痛；1，2，3]',
  `pushup` int(1) DEFAULT NULL COMMENT '俯臥撐地-軀幹穩定度_最後分數[0=疼痛；1，2，3]',
  `stability_l_1` int(1) DEFAULT NULL COMMENT '核心旋轉穩定度_左_第一次[0=疼痛；1，2，3]',
  `stability_l_2` int(1) DEFAULT NULL COMMENT '核心旋轉穩定度_左_第二次[0=疼痛；1，2，3]',
  `stability_l_3` int(1) DEFAULT NULL COMMENT '核心旋轉穩定度_左_第三次[0=疼痛；1，2，3]',
  `stability_r_1` int(1) DEFAULT NULL COMMENT '核心旋轉穩定度_右_第一次[0=疼痛；1，2，3]',
  `stability_r_2` int(1) DEFAULT NULL COMMENT '核心旋轉穩定度_右_第二次[0=疼痛；1，2，3]',
  `stability_r_3` int(1) DEFAULT NULL COMMENT '核心旋轉穩定度_右_第三次[0=疼痛；1，2，3]',
  `stability` int(1) DEFAULT NULL COMMENT '核心旋轉穩定度_最後分數[0=疼痛；1，2，3]',
  `fms_total` int(3) DEFAULT NULL COMMENT 'fms_總分[總分=21，<14高運動傷害風險]',
  PRIMARY KEY (`fm_id`),
  KEY `u_id` (`ubi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 表的關聯 `functional_measurement`:
--   `ubi_id`
--       `users_body_info` -> `ubi_id`
--

-- --------------------------------------------------------

--
-- 資料表結構 `medical_diagnosis_codes`
--
-- 建立時間: 2019 年 08 月 20 日 00:37
--

CREATE TABLE IF NOT EXISTS `medical_diagnosis_codes` (
  `mdc_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(4) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  `updated_at` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`mdc_id`),
  KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- 表的關聯 `medical_diagnosis_codes`:
--

--
-- 資料表的匯出資料 `medical_diagnosis_codes`
--

INSERT INTO `medical_diagnosis_codes` (`mdc_id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, '111', '旋轉肌群損傷', '1565831607698', '1565831607698'),
(2, '112', '滑液囊發炎', '1565831607698', '1565831607698'),
(3, '121', '網球肘', '1565831607698', '1565831607698'),
(4, '122', '高爾夫球肘', '1565831607698', '1565831607698'),
(5, '131', '腕隧道症候群', '1565831607698', '1565831607698'),
(6, '132', '手腕扭傷', '1565831607698', '1565831607698'),
(7, '141', '關節炎', '1565831607698', '1565831607698'),
(8, '142', '手指扭傷', '1565831607698', '1565831607698'),
(9, '211', '髖關節扭傷', '1565831607698', '1565831607698'),
(10, '221', '前十字韌帶損傷與重建', '1565831607698', '1565831607698'),
(11, '231', '韌帶扭傷', '1565831607698', '1565831607698'),
(12, '241', '足底筋膜炎', '1565831607698', '1565831607698'),
(13, '311', '頸部扭傷', '1565831607698', '1565831607698'),
(14, '312', '上背痛', '1565831607698', '1565831607698'),
(15, '321', '挫傷', '1565831607698', '1565831607698'),
(16, '331', '下背痛', '1565831607698', '1565831607698'),
(17, '4', '其它', '1565831607698', '1565831607698'),
(19, '333', 'string', '1568689759913', '1568689759913'),
(20, '333', 'string', '1568689776449', '1568689776449');

-- --------------------------------------------------------

--
-- 資料表結構 `medical_history`
--
-- 建立時間: 2019 年 11 月 01 日 00:33
--

CREATE TABLE IF NOT EXISTS `medical_history` (
  `mh_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `ubi_id` int(11) UNSIGNED NOT NULL COMMENT '個案編號',
  `created_at` varchar(20) DEFAULT NULL COMMENT '建立日期',
  `updated_at` varchar(20) DEFAULT NULL COMMENT '更新日期',
  `at_plan_1` tinyint(1) DEFAULT NULL COMMENT '運動按摩[0=無;1=有]',
  `at_plan_2` tinyint(1) DEFAULT NULL COMMENT '拉筋[0=無;1=有]',
  `at_plan_3` tinyint(1) DEFAULT NULL COMMENT '冷熱敷[0=無;1=有]',
  `at_plan_4` int(1) DEFAULT NULL COMMENT '衛教[0=無;1=有]',
  `at_plan_5` tinyint(1) DEFAULT NULL COMMENT '貼紮防護[0=無;1=有]',
  `at_plan_6` tinyint(1) DEFAULT NULL COMMENT '建議轉介醫院或診所[0=無;1=有]',
  `at_plan_7` tinyint(1) DEFAULT NULL COMMENT '無[0=無;1=有]',
  `at_plan_8` tinyint(1) DEFAULT NULL COMMENT '其它[0=無;1=有]',
  `at_plan_other` text COMMENT '運動防護人員其它處置狀況',
  `treatment_1` tinyint(1) DEFAULT NULL COMMENT '醫院或診所接受復健或其它保守治療介入[0=無;1=有]',
  `treatment_2` tinyint(1) DEFAULT NULL COMMENT '國術館或民俗療法[0=無;1=有]',
  `treatment_3` tinyint(1) DEFAULT NULL COMMENT '無接受任何方式處理[0=無;1=有]',
  `treatment_4` tinyint(1) DEFAULT NULL COMMENT '手術治療[0=無;1=有]',
  `treatment_5` tinyint(1) DEFAULT NULL COMMENT '其它[0=無;1=有]',
  `treatment_other` text COMMENT '其它醫療處置',
  `event_1` varchar(6) DEFAULT NULL COMMENT '運動傷害事件發生[參考表 medical_injured_*]',
  `event_1_other` text COMMENT '其他運動傷害事件訊息',
  `diagnosis_1` varchar(6) DEFAULT NULL COMMENT '診斷[參考表 medical_diagnosis_code]',
  `diagnosis_1_other` text COMMENT '其他診斷訊息',
  PRIMARY KEY (`mh_id`),
  KEY `u_id` (`ubi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 表的關聯 `medical_history`:
--   `ubi_id`
--       `users_body_info` -> `ubi_id`
--

-- --------------------------------------------------------

--
-- 資料表結構 `medical_injured_codes_beg`
--
-- 建立時間: 2019 年 08 月 20 日 00:38
--

CREATE TABLE IF NOT EXISTS `medical_injured_codes_beg` (
  `micb_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(2) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  `updated_at` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`micb_id`),
  KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 表的關聯 `medical_injured_codes_beg`:
--

--
-- 資料表的匯出資料 `medical_injured_codes_beg`
--

INSERT INTO `medical_injured_codes_beg` (`micb_id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, '1', '急性', '1565831607698', '1565831607698'),
(2, '2', '慢性', '1565831607698', '1565831607698');

-- --------------------------------------------------------

--
-- 資料表結構 `medical_injured_codes_end`
--
-- 建立時間: 2019 年 08 月 20 日 00:38
--

CREATE TABLE IF NOT EXISTS `medical_injured_codes_end` (
  `mice_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(2) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  `updated_at` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`mice_id`),
  KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- 表的關聯 `medical_injured_codes_end`:
--

--
-- 資料表的匯出資料 `medical_injured_codes_end`
--

INSERT INTO `medical_injured_codes_end` (`mice_id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, '1', '左', '1565831607698', '1565831607698'),
(2, '2', '右', '1565831607698', '1565831607698'),
(6, '3', '雙側', '1565831607698', '1565831607698');

-- --------------------------------------------------------

--
-- 資料表結構 `medical_injured_codes_mid`
--
-- 建立時間: 2019 年 09 月 17 日 03:17
--

CREATE TABLE IF NOT EXISTS `medical_injured_codes_mid` (
  `micm_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(4) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  `updated_at` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`micm_id`),
  KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- 表的關聯 `medical_injured_codes_mid`:
--

--
-- 資料表的匯出資料 `medical_injured_codes_mid`
--

INSERT INTO `medical_injured_codes_mid` (`micm_id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, '101', '肩膀', '1565831607698', '1565831607698'),
(2, '102', '上臂', '1565831607698', '1565831607698'),
(3, '103', '手肘', '1565831607698', '1565831607698'),
(4, '104', '前臂', '1565831607698', '1565831607698'),
(5, '105', '手腕', '1565831607698', '1565831607698'),
(6, '106', '手掌', '1565831607698', '1565831607698'),
(7, '107', '手指', '1565831607698', '1565831607698'),
(8, '201', '臀部', '1565831607698', '1565831607698'),
(9, '202', '大腿前側', '1565831607698', '1565831607698'),
(10, '203', '大腿後側', '1565831607698', '1565831607698'),
(11, '204', '膝蓋前側', '1565831607698', '1565831607698'),
(12, '205', '膝蓋內側', '1565831607698', '1565831607698'),
(13, '206', '膝蓋外側', '1565831607698', '1565831607698'),
(14, '207', '小腿前側', '1565831607698', '1565831607698'),
(15, '208', '小腿後側', '1565831607698', '1565831607698'),
(16, '209', '踝關節', '1565831607698', '1565831607698'),
(17, '210', '腳底', '1565831607698', '1565831607698'),
(18, '211', '腳跟', '1565831607698', '1565831607698'),
(19, '212', '腳趾', '1565831607698', '1565831607698'),
(20, '301', '胸部', '1565831607698', '1565831607698'),
(21, '302', '腹部', '1565831607698', '1565831607698'),
(22, '303', '上背', '1565831607698', '1565831607698');

-- --------------------------------------------------------

--
-- 資料表結構 `muscles_joints_measurement`
--
-- 建立時間: 2019 年 11 月 01 日 00:33
--

CREATE TABLE IF NOT EXISTS `muscles_joints_measurement` (
  `mjm_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `ubi_id` int(11) UNSIGNED NOT NULL COMMENT '個案編號',
  `created_at` varchar(20) DEFAULT NULL COMMENT '建立日期',
  `updated_at` varchar(20) DEFAULT NULL COMMENT '更新日期',
  `lx_lf_rom_r` decimal(5,2) DEFAULT NULL COMMENT 'rom量測：右 lumbar lateral flexion[end range：__°]',
  `lx_lf_rom_l` decimal(5,2) DEFAULT NULL COMMENT 'rom量測：左 lumbar lateral flexion[end range：__°]',
  `tx_r_rom_r` decimal(5,2) DEFAULT NULL COMMENT 'rom量測：右 thoracic rotation[end range：__°]',
  `tx_r_rom_l` decimal(5,2) DEFAULT NULL COMMENT 'rom量測：左 thoracic rotation[end range：__°]',
  `gh_er_rom_r` decimal(5,2) DEFAULT NULL COMMENT 'rom量測：右 shoulder er[end range：__°]',
  `gh_er_rom_l` decimal(5,2) DEFAULT NULL COMMENT 'rom量測：左 shoulder er[end range：__°]',
  `gh_ir_rom_r` decimal(5,2) DEFAULT NULL COMMENT 'rom量測：右 shoulder ir[end range：__°]',
  `gh_ir_rom_l` decimal(5,2) DEFAULT NULL COMMENT 'rom量測：左 shoulder ir[end range：__°]',
  `gh_er_mmt_r` decimal(5,2) DEFAULT NULL COMMENT 'mmt量測: 右 shoulder er[數值]',
  `gh_er_mmt_l` decimal(5,2) DEFAULT NULL COMMENT 'mmt量測: 左 shoulder er[數值]',
  `gh_ir_mmt_r` decimal(5,2) DEFAULT NULL COMMENT 'mmt量測: 右 shoulder ir[數值]',
  `gh_ir_mmt_l` decimal(5,2) DEFAULT NULL COMMENT 'mmt量測: 左 shoulder ir[數值]',
  `e_f_mmt_r` decimal(5,2) DEFAULT NULL COMMENT 'mmt量測: 右 elbow flexion[數值]',
  `e_f_mmt_l` decimal(5,2) DEFAULT NULL COMMENT 'mmt量測: 左 elbow flexion[數值]',
  `e_e_mmt_r` decimal(5,2) DEFAULT NULL COMMENT 'mmt量測: 右 elbow extension[數值]',
  `e_e_mmt_l` decimal(5,2) DEFAULT NULL COMMENT 'mmt量測: 左 elbow extension[數值]',
  `ank_inver_mmt_r` decimal(5,2) DEFAULT NULL COMMENT 'mmt量測: 右 ankle inversion[數值]',
  `ank_inver_mmt_l` decimal(5,2) DEFAULT NULL COMMENT 'mmt量測: 左 ankle inversion[數值]',
  `ank_ever_mmt_r` decimal(5,2) DEFAULT NULL COMMENT 'mmt量測: 右 ankle eversion[數值]',
  `ank_ever_mmt_l` decimal(5,2) DEFAULT NULL COMMENT 'mmt量測: 左 ankle eversion[數值]',
  `gh_horiadd_mmt_r` decimal(5,2) DEFAULT NULL COMMENT 'mmt量測: 右 shoulder horizontal adduction[數值]',
  `gh_horiadd_mmt_l` decimal(5,2) DEFAULT NULL COMMENT 'mmt量測: 左 shoulder horizontal adduction[數值]',
  `gh_horiabd_mmt_r` decimal(5,2) DEFAULT NULL COMMENT 'mmt量測: 右 shoulder horizontal abduction[數值]',
  `gh_horiabd_mmt_l` decimal(5,2) DEFAULT NULL COMMENT 'mmt量測: 左 shoulder horizontal abduction[數值]',
  `myo_t_f_r` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_trapezius_肌肉張力_右（坐）[數值]',
  `myo_t_f_l` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_trapezius_肌肉張力_左（坐）[數值]',
  `myo_t_s_r` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_trapezius_肌肉硬度_右（坐）[數值]',
  `myo_t_s_l` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_trapezius_肌肉硬度_左（坐）[數值]',
  `myo_t_d_r` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_trapezius_肌肉彈性_右（坐）[數值]',
  `myo_t_d_l` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_trapezius_肌肉彈性_左（坐）[數值]',
  `myo_t_r_r` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_trapezius_放鬆時間_右（坐）[數值]',
  `myo_t_r_l` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_trapezius_放鬆時間_左（坐）[數值]',
  `myo_t_c_r` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_trapezius_德柏拉數_右（坐）[數值]',
  `myo_t_c_l` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_trapezius_德柏拉數_左（坐）[數值]',
  `myo_es_p_f_r` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_erector spinae_肌肉張力_右（趴）[數值]',
  `myo_es_p_f_l` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_erector spinae_肌肉張力_左（趴）[數值]',
  `myo_es_s_f_r` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_erector spinae_肌肉張力_右（坐）[數值]',
  `myo_es_s_f_l` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_erector spinae_肌肉張力_左（坐）[數值]',
  `myo_es_p_s_r` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_erector spinae_肌肉硬度_右（趴）[數值]',
  `myo_es_p_s_l` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_erector spinae_肌肉硬度_左（趴）[數值]',
  `myo_es_s_s_r` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_erector spinae_肌肉硬度_右（坐）[數值]',
  `myo_es_s_s_l` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_erector spinae_肌肉硬度_左（坐）[數值]',
  `myo_es_p_d_r` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_erector spinae_肌肉彈性_右（趴）[數值]',
  `myo_es_p_d_l` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_erector spinae_肌肉彈性_左（趴）[數值]',
  `myo_es_s_d_r` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_erector spinae_肌肉彈性_右（坐）[數值]',
  `myo_es_s_d_l` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_erector spinae_肌肉彈性_左（坐）[數值]',
  `myo_es_p_r_r` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_erector spinae_放鬆時間_右（趴）[數值]',
  `myo_es_p_r_l` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_erector spinae_放鬆時間_左（趴）[數值]',
  `myo_es_s_r_r` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_erector spinae_放鬆時間_右（坐）[數值]',
  `myo_es_s_r_l` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_erector spinae_放鬆時間_左（坐）[數值]',
  `myo_es_p_c_r` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_erector spinae_德柏拉數_右（趴）[數值]',
  `myo_es_p_c_l` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_erector spinae_德柏拉數_左（趴）[數值]',
  `myo_es_s_c_r` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_erector spinae_德柏拉數_右（坐）[數值]',
  `myo_es_s_c_l` decimal(5,2) DEFAULT NULL COMMENT '肌肉張力測_erector spinae_德柏拉數_左（坐）[數值]',
  `flexibility_1` decimal(5,2) DEFAULT NULL COMMENT '柔軟度_第一次[數值]',
  `flexibility_2` decimal(5,2) DEFAULT NULL COMMENT '柔軟度_第二次[數值]',
  `note` text COMMENT '備註[所有統一寫]',
  PRIMARY KEY (`mjm_id`),
  KEY `u_id` (`ubi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 表的關聯 `muscles_joints_measurement`:
--   `ubi_id`
--       `users_body_info` -> `ubi_id`
--

-- --------------------------------------------------------

--
-- 資料表結構 `psychological_skill_questions`
--
-- 建立時間: 2019 年 10 月 08 日 02:05
--

CREATE TABLE IF NOT EXISTS `psychological_skill_questions` (
  `psq_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `created_at` varchar(20) DEFAULT NULL COMMENT '建立日期',
  `updated_at` varchar(20) DEFAULT NULL COMMENT '更新日期',
  `name` varchar(255) DEFAULT NULL COMMENT '題目名稱',
  PRIMARY KEY (`psq_id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- 表的關聯 `psychological_skill_questions`:
--

--
-- 資料表的匯出資料 `psychological_skill_questions`
--

INSERT INTO `psychological_skill_questions` (`psq_id`, `created_at`, `updated_at`, `name`) VALUES
(1, '1566264895390', '1566264895390', '每一次練習，我會設定自己想達成的目標'),
(2, '1566264895390', '1566264895390', '練習時，不用教練督促，我會自動自發的練習'),
(3, '1566264895390', '1566264895390', '我可以將注意力集中在比賽上而不分心'),
(4, '1566264895390', '1566264895390', '我會仔細聆聽教練的忠告和指示而獲得技巧的進步'),
(5, '1566264895390', '1566264895390', '當我設定的目標未達成時，我會更努力的練習'),
(6, '1566264895390', '1566264895390', '比賽或是練習我總是全力以赴，不需要被別人強迫表現'),
(7, '1566264895390', '1566264895390', '比賽中我很容易受到一些因素的干擾而分心'),
(8, '1566264895390', '1566264895390', '對教練的指示我會虛心接受與遵照行事'),
(9, '1566264895390', '1566264895390', '對於平常的訓練，我會有很高的自我要求'),
(10, '1566264895390', '1566264895390', '當比賽氣氛越緊張時，我越能感受比賽的樂趣'),
(11, '1566264895390', '1566264895390', '比賽中遇到不滿意的情況時，我會激勵自己振作'),
(12, '1566264895390', '1566264895390', '比賽中我會一直想到剛才的失誤，而無法集中注意力在比賽上'),
(13, '1566264895390', '1566264895390', '我常懷疑自己的運動實力'),
(14, '1566264895390', '1566264895390', '我會做許多規劃以達到自己的目標'),
(15, '1566264895390', '1566264895390', '在比賽中，我會因為觀眾的干擾而分心'),
(16, '1566264895390', '1566264895390', '我覺得自己的各方面條件都比對手好'),
(17, '1566264895390', '1566264895390', '教練或別人對我的批評，我會參考反省改進'),
(18, '1566264895390', '1566264895390', '在平常的訓練外，我會再另外找時間練習'),
(19, '1566264895390', '1566264895390', '我喜歡把有壓力感覺的比賽情境視為一種挑戰'),
(20, '1566264895390', '1566264895390', '當感覺到自己太過緊張時，我能夠很快的放鬆身體並且鎮定下來'),
(21, '1566264895390', '1566264895390', '我會虛心接受教練的指導與糾正'),
(22, '1566264895390', '1566264895390', '我對自己的運動技術很有信心'),
(23, '1566264895390', '1566264895390', '我會以每天或每週為單位，設定訓練的目標來引導自己練習'),
(24, '1566264895390', '1566264895390', '外界的壓力不會影響我的表現'),
(25, '1566264895390', '1566264895390', '比賽中我可以運用放鬆技巧以紓解壓力'),
(26, '1566264895390', '1566264895390', '當比賽場上情況變糟時，我會告訴自己要保持冷靜'),
(27, '1566264895390', '1566264895390', '當教練告訴我如何改正錯誤動作時，我會認為他是在找我麻煩'),
(28, '1566264895390', '1566264895390', '面對失誤與挫折時，我會運用正面思考的策略穩定自己情緒'),
(29, '1566264895390', '1566264895390', '失誤時，我能冷靜思考，自我調整，避免再失誤'),
(30, '1566264895390', '1566264895390', '我會要求自己比別人多花一些時間練習'),
(31, '1566264895390', '1566264895390', '我有信心在比賽中會表現的很好');

-- --------------------------------------------------------

--
-- 資料表結構 `psychological_skill_scale`
--
-- 建立時間: 2019 年 11 月 01 日 00:33
--

CREATE TABLE IF NOT EXISTS `psychological_skill_scale` (
  `pss_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `ubi_id` int(11) UNSIGNED NOT NULL COMMENT '個案編號',
  `created_at` varchar(20) DEFAULT NULL COMMENT '建立日期',
  `updated_at` varchar(20) DEFAULT NULL COMMENT '更新日期',
  `scale_results` varchar(150) DEFAULT NULL COMMENT '以逗點區隔之1~5分量表數值[0,0,0,0,0,0...]',
  PRIMARY KEY (`pss_id`),
  KEY `u_id` (`ubi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 表的關聯 `psychological_skill_scale`:
--   `ubi_id`
--       `users_body_info` -> `ubi_id`
--

-- --------------------------------------------------------

--
-- 資料表結構 `shoes_advance_info`
--
-- 建立時間: 2019 年 11 月 01 日 00:33
--

CREATE TABLE IF NOT EXISTS `shoes_advance_info` (
  `sai_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `ubi_id` int(11) UNSIGNED NOT NULL COMMENT '個案編號',
  `created_at` varchar(20) DEFAULT NULL COMMENT '建立日期',
  `updated_at` varchar(20) DEFAULT NULL COMMENT '更新日期',
  `results_area1` varchar(150) DEFAULT NULL COMMENT '以逗點區隔之1~5分量表數值[0,0,0,0,0,0...]',
  `results_area2` varchar(150) DEFAULT NULL COMMENT '以逗點區隔之1~5分量表數值[0,0,0,0,0,0...]',
  `results_area3` varchar(150) DEFAULT NULL COMMENT '以逗點區隔之1~5分量表數值[0,0,0,0,0,0...]',
  `results_area4` varchar(150) DEFAULT NULL COMMENT '以逗點區隔之1~5分量表數值[0,0,0,0,0,0...]',
  PRIMARY KEY (`sai_id`),
  KEY `u_id` (`ubi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 表的關聯 `shoes_advance_info`:
--   `ubi_id`
--       `users_body_info` -> `ubi_id`
--

-- --------------------------------------------------------

--
-- 資料表結構 `shoes_advance_questions`
--
-- 建立時間: 2019 年 08 月 20 日 01:37
--

CREATE TABLE IF NOT EXISTS `shoes_advance_questions` (
  `saq_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `created_at` varchar(20) DEFAULT NULL COMMENT '建立日期',
  `updated_at` varchar(20) DEFAULT NULL COMMENT '更新日期',
  `name` varchar(255) DEFAULT NULL COMMENT '題目名稱',
  `field` tinyint(1) DEFAULT NULL COMMENT '題目領域代碼',
  PRIMARY KEY (`saq_id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- 表的關聯 `shoes_advance_questions`:
--

--
-- 資料表的匯出資料 `shoes_advance_questions`
--

INSERT INTO `shoes_advance_questions` (`saq_id`, `created_at`, `updated_at`, `name`, `field`) VALUES
(1, '1566264362578', '1566264362578', '請問您認為鞋子的抓地力好不好?(起跑時是否容易打滑)', 1),
(2, '1566264362578', '1566264362578', '請問您認為鞋子的地面摩擦力好不好?(急剎時是否容易打滑)', 1),
(3, '1566264362578', '1566264362578', '請問您認為鞋子的防滑性好不好?(地面濕滑時是否容易打滑)', 1),
(4, '1566264362578', '1566264362578', '請問您認為鞋子的左右移位的敏捷性好不好?', 1),
(5, '1566264362578', '1566264362578', '請問您認為鞋子是否好穿並移動自如?', 1),
(6, '1566264362578', '1566264362578', '請問您認為鞋子的防扭傷功能好不好?', 1),
(7, '1566264362578', '1566264362578', '請問您認為鞋子的避震效果好不好?', 1),
(8, '1566264362578', '1566264362578', '請問您認為鞋子的減緩、分散衝擊力的效能好不好?', 1),
(9, '1566264362578', '1566264362578', '請問您是否因為款式新穎而選購此雙鞋子?', 2),
(10, '1566264362578', '1566264362578', '請問您是否因為款式流線型(剪裁縫紉度)而選購此雙鞋子?', 2),
(11, '1566264362578', '1566264362578', '請問您是否因為外觀的配色而選購此雙鞋子?', 2),
(12, '1566264362578', '1566264362578', '請問您是否因為看到廣告而選購此雙鞋子?', 2),
(13, '1566264362578', '1566264362578', '請問您是否因為品牌而選購此雙鞋子?', 2),
(14, '1566264362578', '1566264362578', '請問您認為鞋子的透氣性好不好?', 3),
(15, '1566264362578', '1566264362578', '請問您認為鞋墊的柔軟度是否適中?', 3),
(16, '1566264362578', '1566264362578', '請問您認為鞋子的抗磨損性好不好?', 3),
(17, '1566264362578', '1566264362578', '請問您認為鞋子的耐穿性好不好?', 3),
(18, '1566264362578', '1566264362578', '請問您認為鞋底的軟硬度是否適中?', 3),
(19, '1566264362578', '1566264362578', '請問您認為鞋底的厚度是否適中?', 3),
(20, '1566264362578', '1566264362578', '請問您認為鞋子的重量是否適中?', 3),
(21, '1566264362578', '1566264362578', '請問您認為穿著鞋子時對技能發揮的影響好不好?', 4),
(22, '1566264362578', '1566264362578', '請問您認為穿著鞋子時的彈性好不好?', 4),
(23, '1566264362578', '1566264362578', '請問您認為鞋子的鞋帶耐用性(不易斷裂) 好不好?', 4),
(24, '1566264362578', '1566264362578', '請問您認為鞋子的散熱性(不易產生濕熱) 好不好?', 4);

-- --------------------------------------------------------

--
-- 資料表結構 `shoes_basic_info`
--
-- 建立時間: 2019 年 11 月 01 日 00:32
--

CREATE TABLE IF NOT EXISTS `shoes_basic_info` (
  `sbi_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `ubi_id` int(11) UNSIGNED NOT NULL COMMENT '個案編號',
  `created_at` varchar(20) DEFAULT NULL COMMENT '建立日期',
  `updated_at` varchar(20) DEFAULT NULL COMMENT '更新日期',
  `shoe_size` decimal(5,2) DEFAULT NULL COMMENT '鞋子尺寸[__公分]',
  `shoe_len` tinyint(1) DEFAULT NULL COMMENT '鞋長是否適合[1=是；2=否（小於1根手指的距離）；3=否 （大於2根手指的距離）]',
  `brand` tinyint(1) DEFAULT NULL COMMENT '鞋子品牌[1=Nike；2=Mizuno; 3=Joola; 4=Nittaku; 5=STIGa; 6=Butterfly(BTY); 7=其他]',
  `brand_other` varchar(25) DEFAULT NULL COMMENT '其他鞋子品牌',
  `flexibility` tinyint(1) DEFAULT NULL COMMENT '鞋子是否具柔軟度[1=是;2=否]',
  `air_cushion` tinyint(1) DEFAULT NULL COMMENT '鞋跟有無氣墊[1=是;2=否]',
  `lining` tinyint(1) DEFAULT NULL COMMENT '鞋跟是否有突起的襯舌[1=是;2=否]',
  `arch_pad` tinyint(1) DEFAULT NULL COMMENT '鞋內是否有足弓墊[1=是;2=否]',
  `bottom_design` tinyint(1) DEFAULT NULL COMMENT '鞋底設計[1=平面 ；2=凹凸條紋 ；3=有突起物]',
  `training_duration` int(1) DEFAULT NULL COMMENT '每日訓練時間約[__小時(若非每天訓練，以一週訓練時數做平均)]',
  `aver_wear` int(1) DEFAULT NULL COMMENT '平均一天穿戴此雙鞋子的時間約[__小時]',
  `aver_replace` int(1) DEFAULT NULL COMMENT '平均球鞋汰換時間[__月]',
  `worn_1_r` tinyint(1) DEFAULT NULL COMMENT '鞋底磨損的部位 （右前1/3內側）[0=無;1=有]',
  `worn_2_r` tinyint(1) DEFAULT NULL COMMENT '鞋底磨損的部位 （右中2/3內側）[0=無;1=有]',
  `worn_3_r` tinyint(1) DEFAULT NULL COMMENT '鞋底磨損的部位 （右後1/3內側）[0=無;1=有]',
  `worn_4_r` tinyint(1) DEFAULT NULL COMMENT '鞋底磨損的部位 （右前1/3外側）[0=無;1=有]',
  `worn_5_r` tinyint(1) DEFAULT NULL COMMENT '鞋底磨損的部位 （右中2/3外側）[0=無;1=有]',
  `worn_6_r` tinyint(1) DEFAULT NULL COMMENT '鞋底磨損的部位 （右後1/3外側）[0=無;1=有]',
  `worn_1_l` tinyint(1) DEFAULT NULL COMMENT '鞋底磨損的部位 （左前1/3內側）[0=無;1=有]',
  `worn_2_l` tinyint(1) DEFAULT NULL COMMENT '鞋底磨損的部位 （左中2/3內側）[0=無;1=有]',
  `worn_3_l` tinyint(1) DEFAULT NULL COMMENT '鞋底磨損的部位 （左中2/3內側）[0=無;1=有]',
  `worn_4_l` tinyint(1) DEFAULT NULL COMMENT '鞋底磨損的部位 （左前1/3外側）[0=無;1=有]',
  `worn_5_l` tinyint(1) DEFAULT NULL COMMENT '鞋底磨損的部位 （左中2/3外側）[0=無;1=有]',
  `worn_6_l` tinyint(1) DEFAULT NULL COMMENT '鞋底磨損的部位 （左後1/3外側）[0=無;1=有]',
  `foot_length_r` decimal(5,2) DEFAULT NULL COMMENT '右足長[__公分]',
  `foot_length_l` decimal(5,2) DEFAULT NULL COMMENT '左足長[__公分]',
  `foot_width_r` decimal(5,2) DEFAULT NULL COMMENT '右足寬[__公分]',
  `foot_width_l` decimal(5,2) DEFAULT NULL COMMENT '左足寬[__公分]',
  `arch_height_r` decimal(5,2) DEFAULT NULL COMMENT '右足弓高度[__公分]',
  `arch_height_l` decimal(5,2) DEFAULT NULL COMMENT '左足弓高度[__公分]',
  PRIMARY KEY (`sbi_id`),
  KEY `u_id` (`ubi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 表的關聯 `shoes_basic_info`:
--   `ubi_id`
--       `users_body_info` -> `ubi_id`
--

-- --------------------------------------------------------

--
-- 資料表結構 `shoes_brand`
--
-- 建立時間: 2019 年 09 月 17 日 02:00
--

CREATE TABLE IF NOT EXISTS `shoes_brand` (
  `sb_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(2) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  `updated_at` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`sb_id`),
  KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- 表的關聯 `shoes_brand`:
--

--
-- 資料表的匯出資料 `shoes_brand`
--

INSERT INTO `shoes_brand` (`sb_id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, '1', 'Nike', '1565833692907', '1565833692907'),
(2, '2', 'Mizuno', '1565833692907', '1565833692907'),
(3, '3', 'Joola', '1565833692907', '1565833692907'),
(4, '4', 'Nittaku', '1565833692907', '1565833692907'),
(5, '5', 'STIGA', '1565833692907', '1565833692907'),
(6, '6', 'Butterfly(BTY)', '1565833692907', '1565833692907'),
(7, '7', '其他', '1565833692907', '1565833692907');

-- --------------------------------------------------------

--
-- 資料表結構 `shoes_design`
--
-- 建立時間: 2019 年 08 月 15 日 01:50
--

CREATE TABLE IF NOT EXISTS `shoes_design` (
  `sd_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(2) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  `updated_at` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`sd_id`),
  KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 表的關聯 `shoes_design`:
--

--
-- 資料表的匯出資料 `shoes_design`
--

INSERT INTO `shoes_design` (`sd_id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, '1', '平面', '1565833882751', '1565833882751'),
(2, '2', '凹凸條紋', '1565833882751', '1565833882751'),
(3, '3', '有突起物', '1565833882751', '1565833882751');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--
-- 建立時間: 2019 年 11 月 01 日 00:32
--

CREATE TABLE IF NOT EXISTS `users` (
  `u_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '個案編號',
  `created_at` varchar(20) DEFAULT NULL COMMENT '測試日期',
  `updated_at` varchar(20) DEFAULT NULL COMMENT '更新日期',
  `name` varchar(50) DEFAULT NULL COMMENT '個案姓名',
  `line_id` varchar(100) DEFAULT NULL COMMENT '個案連絡ID',
  `contact_no` varchar(50) DEFAULT NULL COMMENT '個案連絡號碼',
  `role` int(3) DEFAULT NULL COMMENT '角色權限代碼',
  `access_token` text COMMENT '存取token',
  `last_modify` int(11) DEFAULT NULL COMMENT '未完成測驗單序號',
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `line_id` (`line_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 表的關聯 `users`:
--

--
-- 資料表的匯出資料 `users`
--

INSERT INTO `users` (`u_id`, `created_at`, `updated_at`, `name`, `line_id`, `contact_no`, `role`, `access_token`, `last_modify`) VALUES
(1, '1570500672582', '1572310781811', 'siasNtusAdmin_hidden', 'siasNtusAdmin_hidden', '00000000', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `users_body_info`
--
-- 建立時間: 2019 年 11 月 01 日 00:32
--

CREATE TABLE IF NOT EXISTS `users_body_info` (
  `ubi_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `u_id` int(11) UNSIGNED NOT NULL COMMENT '個案編號',
  `created_at` varchar(20) DEFAULT NULL COMMENT '建立日期',
  `updated_at` varchar(20) DEFAULT NULL COMMENT '更新日期',
  `gender` tinyint(1) DEFAULT NULL COMMENT '個案性別[1=男;2=女]',
  `day_of_birth` varchar(20) DEFAULT NULL COMMENT '個案出生日',
  `height` decimal(4,1) DEFAULT NULL COMMENT '個案身高',
  `weight` decimal(4,1) DEFAULT NULL COMMENT '個案體重',
  `img_shldrlvl` tinyint(1) DEFAULT NULL COMMENT '是否已拍攝肩高[0=未完成;1=完成]',
  `bmi` decimal(5,2) DEFAULT NULL COMMENT '個案身體質量指數',
  `bfp` decimal(5,2) DEFAULT NULL COMMENT '體脂肪百分比',
  `muscle` decimal(5,2) DEFAULT NULL COMMENT '肌肉百分比',
  `bone` decimal(5,2) DEFAULT NULL COMMENT '骨頭質量',
  `vfp` decimal(5,2) DEFAULT NULL COMMENT '內臟脂肪百分比',
  `bmr` decimal(7,2) DEFAULT NULL COMMENT '基礎代謝率',
  `body_water` decimal(7,2) DEFAULT NULL COMMENT '體內水分百分比',
  `rt_len` decimal(5,2) DEFAULT NULL COMMENT '右大腿長',
  `lt_len` decimal(5,2) DEFAULT NULL COMMENT '左大腿長',
  `rc_len` decimal(5,2) DEFAULT NULL COMMENT '右小腿長',
  `lc_len` decimal(5,2) DEFAULT NULL COMMENT '左小腿長',
  `rl_len` decimal(5,2) DEFAULT NULL COMMENT '右腿長',
  `ll_len` decimal(5,2) DEFAULT NULL COMMENT '左腿長',
  `rua_len` decimal(5,2) DEFAULT NULL COMMENT '右上臂長',
  `lua_len` decimal(5,2) DEFAULT NULL COMMENT '左上臂長',
  `rfa_len` decimal(5,2) DEFAULT NULL COMMENT '右前臂長',
  `lfa_len` decimal(5,2) DEFAULT NULL COMMENT '左前臂長',
  `rpmr_len` decimal(5,2) DEFAULT NULL COMMENT '右手掌長',
  `lpmr_len` decimal(5,2) DEFAULT NULL COMMENT '左手掌長',
  `rcvc_len` decimal(5,2) DEFAULT NULL COMMENT '右鎖骨長',
  `lcvc_len` decimal(5,2) DEFAULT NULL COMMENT '左鎖骨長',
  `trunk_len` decimal(5,2) DEFAULT NULL COMMENT '軀幹高',
  `rae_5cm` decimal(5,2) DEFAULT NULL COMMENT '右肘關節上5公分',
  `lae_5cm` decimal(5,2) DEFAULT NULL COMMENT '左肘關節上5公分',
  `rbe_5cm` decimal(5,2) DEFAULT NULL COMMENT '右肘關節下5公分',
  `lbe_5cm` decimal(5,2) DEFAULT NULL COMMENT '左肘關節下5公分',
  `rak_5cm` decimal(5,2) DEFAULT NULL COMMENT '右膝關節上5公分',
  `lak_5cm` decimal(5,2) DEFAULT NULL COMMENT '右肘關節上5公分',
  `rbk_5cm` decimal(5,2) DEFAULT NULL COMMENT '右肘關節上5公分',
  `lbk_5cm` decimal(5,2) DEFAULT NULL COMMENT '右肘關節上5公分',
  PRIMARY KEY (`ubi_id`),
  KEY `u_id` (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 表的關聯 `users_body_info`:
--   `u_id`
--       `users` -> `u_id`
--

-- --------------------------------------------------------

--
-- 資料表結構 `users_diagnosis_codes`
--
-- 建立時間: 2019 年 08 月 20 日 00:38
--

CREATE TABLE IF NOT EXISTS `users_diagnosis_codes` (
  `udc_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(4) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  `updated_at` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`udc_id`),
  KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- 表的關聯 `users_diagnosis_codes`:
--

--
-- 資料表的匯出資料 `users_diagnosis_codes`
--

INSERT INTO `users_diagnosis_codes` (`udc_id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, '1', '旋轉肌群損傷', '1566260397381', '1566260397381'),
(2, '2', '滑液囊發炎', '1566260397381', '1566260397381'),
(3, '3', '網球肘', '1566260397381', '1566260397381'),
(4, '4', '高爾夫球肘', '1566260397381', '1566260397381'),
(5, '5', '腕隧道症候群', '1566260397381', '1566260397381'),
(6, '6', '手腕扭傷', '1566260397381', '1566260397381'),
(7, '7', '關節炎', '1566260397381', '1566260397381'),
(8, '8', '手指扭傷', '1566260397381', '1566260397381'),
(9, '9', '髖關節扭傷', '1566260397381', '1566260397381'),
(10, '10', '前十字韌帶損傷與重建', '1566260397381', '1566260397381'),
(11, '11', '韌帶扭傷', '1566260397381', '1566260397381'),
(12, '12', '足底筋膜炎', '1566260397381', '1566260397381'),
(13, '13', '頸部扭傷', '1566260397381', '1566260397381'),
(14, '14', '上背痛', '1566260397381', '1566260397381'),
(15, '15', '挫傷', '1566260397381', '1566260397381'),
(16, '16', '下背痛', '1566260397381', '1566260397381'),
(17, '17', '其他', '1566260397381', '1566260397381');

-- --------------------------------------------------------

--
-- 資料表結構 `users_event_codes`
--
-- 建立時間: 2019 年 08 月 20 日 00:38
--

CREATE TABLE IF NOT EXISTS `users_event_codes` (
  `uec_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(4) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  `updated_at` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`uec_id`),
  KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- 表的關聯 `users_event_codes`:
--

--
-- 資料表的匯出資料 `users_event_codes`
--

INSERT INTO `users_event_codes` (`uec_id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, '1', '扭傷', '1566260397381', '1566260397381'),
(2, '2', '拉傷', '1566260397381', '1566260397381'),
(3, '3', '瘀傷(挫傷)', '1566260397381', '1566260397381'),
(4, '4', '筋膜炎', '1566260397381', '1566260397381'),
(5, '5', '骨折', '1566260397381', '1566260397381'),
(6, '6', '脫位/ 半脫位', '1566260397381', '1566260397381'),
(7, '7', '過度使用', '1566260397381', '1566260397381'),
(8, '8', '其他', '1566260397381', '1566260397381');

-- --------------------------------------------------------

--
-- 資料表結構 `users_injured_codes`
--
-- 建立時間: 2019 年 08 月 20 日 00:38
--

CREATE TABLE IF NOT EXISTS `users_injured_codes` (
  `uic_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(4) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  `updated_at` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`uic_id`),
  KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- 表的關聯 `users_injured_codes`:
--

--
-- 資料表的匯出資料 `users_injured_codes`
--

INSERT INTO `users_injured_codes` (`uic_id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, '1', '肩關節', '1566260397381', '1566260397381'),
(2, '2', '肘關節', '1566260397381', '1566260397381'),
(3, '3', '腕關節', '1566260397381', '1566260397381'),
(4, '4', '手指關節', '1566260397381', '1566260397381'),
(5, '5', '髖關節', '1566260397381', '1566260397381'),
(6, '6', '膝關節', '1566260397381', '1566260397381'),
(7, '7', '踝關節', '1566260397381', '1566260397381'),
(8, '8', '腳趾關節', '1566260397381', '1566260397381'),
(9, '9', '頸椎', '1566260397381', '1566260397381'),
(10, '10', '胸椎', '1566260397381', '1566260397381'),
(11, '11', '腰椎', '1566260397381', '1566260397381'),
(12, '12', '其他', '1566260397381', '1566260397381');

-- --------------------------------------------------------

--
-- 資料表結構 `users_investigation`
--
-- 建立時間: 2019 年 11 月 01 日 00:32
--

CREATE TABLE IF NOT EXISTS `users_investigation` (
  `ui_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `ubi_id` int(11) UNSIGNED NOT NULL COMMENT '個案編號',
  `created_at` varchar(20) DEFAULT NULL COMMENT '建立日期',
  `updated_at` varchar(20) DEFAULT NULL COMMENT '更新日期',
  `schl` varchar(10) DEFAULT NULL COMMENT '學校類別[JHS=國中,HS=高中,UN=大學,PRO=專項職業選手]',
  `grade` int(3) DEFAULT NULL COMMENT '年級[一年級=7,二年級=8,三年級=9,四年級=10 ]',
  `class` varchar(50) DEFAULT NULL COMMENT '班級名稱',
  `name` varchar(50) DEFAULT NULL COMMENT '姓名',
  `spt` varchar(10) DEFAULT NULL COMMENT '運動項目[soccer=足球, baseball=棒球, basketball=籃球, billiard=桌球]',
  `student_id` varchar(10) DEFAULT NULL COMMENT '學號/座號',
  `gender` tinyint(1) DEFAULT NULL COMMENT '性別[M=1, F=2]',
  `id_card` varchar(10) DEFAULT NULL COMMENT '身分證字號',
  `date` varchar(20) DEFAULT NULL COMMENT '生日',
  `bpf` decimal(5,2) DEFAULT NULL COMMENT '基礎體適能',
  `bpf_height` decimal(5,2) DEFAULT NULL COMMENT '身高',
  `bpf_weight` decimal(5,2) DEFAULT NULL COMMENT '體重',
  `bpf_forward_flex` decimal(5,2) DEFAULT NULL COMMENT '坐姿體前彎',
  `bpf_jump` decimal(5,2) DEFAULT NULL COMMENT '立定跳遠',
  `bpf_sit_ups` decimal(5,2) DEFAULT NULL COMMENT '仰臥起坐',
  `bpf_800_1600m` decimal(7,2) DEFAULT NULL COMMENT '心肺適能',
  `spf` decimal(7,2) DEFAULT NULL COMMENT '競技體適能',
  `spf_3minstep_15` decimal(7,2) DEFAULT NULL COMMENT '心肺耐力第一次測量',
  `spf_3minstep_25` decimal(7,2) DEFAULT NULL COMMENT '心肺耐力第二次測量',
  `spf_3minstep_35` decimal(7,2) DEFAULT NULL COMMENT '心肺耐力第三次測量',
  `spf_3minstep_sum` decimal(7,2) DEFAULT NULL COMMENT '心肺耐力三次加總',
  `spf_3minstep_index` decimal(7,2) DEFAULT NULL COMMENT '心肺耐力',
  `spf_v_10m` decimal(5,2) DEFAULT NULL COMMENT '速度第一次測量',
  `spf_v_20m` decimal(5,2) DEFAULT NULL COMMENT '速度第二次測量',
  `spf_v_30m` decimal(5,2) DEFAULT NULL COMMENT '速度第三次測量',
  `spf_v_40m` decimal(5,2) DEFAULT NULL COMMENT '速度第四次測量',
  `spf_power` decimal(5,2) DEFAULT NULL COMMENT '爆發力',
  `spf_balance_l_a` decimal(5,2) DEFAULT NULL COMMENT '平衡(spf_balance_l_a)',
  `spf_balance_l_pm` decimal(5,2) DEFAULT NULL COMMENT '平衡',
  `spf_balance_l_pl` decimal(5,2) DEFAULT NULL COMMENT '平衡',
  `spf_balance_r_a` decimal(5,2) DEFAULT NULL COMMENT '平衡',
  `spf_balance_r_pm` decimal(5,2) DEFAULT NULL COMMENT '平衡',
  `spf_balance_r_pl` decimal(5,2) DEFAULT NULL COMMENT '平衡',
  `spf_agility` decimal(5,2) DEFAULT NULL COMMENT '敏捷',
  `fms_squat` decimal(5,2) DEFAULT NULL COMMENT '功能性動作檢測(FMS)',
  `fms_hurdle_l` decimal(5,2) DEFAULT NULL COMMENT '功能性動作檢測(FMS)',
  `fms_hurdle_r` decimal(5,2) DEFAULT NULL COMMENT '功能性動作檢測(FMS)',
  `fms_lunge_l` decimal(5,2) DEFAULT NULL COMMENT '功能性動作檢測(FMS)',
  `fms_lunge_r` decimal(5,2) DEFAULT NULL COMMENT '功能性動作檢測(FMS)',
  `fms_mobility_l` decimal(5,2) DEFAULT NULL COMMENT '功能性動作檢測(FMS)',
  `fms_mobility_r` decimal(5,2) DEFAULT NULL COMMENT '功能性動作檢測(FMS)',
  `fms_slr_l` decimal(5,2) DEFAULT NULL COMMENT '功能性動作檢測(FMS)',
  `fms_slr_r` decimal(5,2) DEFAULT NULL COMMENT '功能性動作檢測(FMS)',
  `fms_pushup` decimal(5,2) DEFAULT NULL COMMENT '功能性動作檢測(FMS)',
  `fms_stability_l` decimal(5,2) DEFAULT NULL COMMENT '功能性動作檢測(FMS)',
  `fms_stability_r` decimal(5,2) DEFAULT NULL COMMENT '功能性動作檢測(FMS)',
  `is_injured_6month` tinyint(1) DEFAULT NULL COMMENT '六個月是否受傷[0=沒有;1=有]',
  `injured_side` tinyint(1) DEFAULT NULL COMMENT '受傷側[1=左;2=右;3=其他]',
  `injured_side_other` text,
  `injured_part` int(3) DEFAULT NULL COMMENT '受傷部位[參照表 users_injured_codes]',
  `injured_part_other` text,
  `diagnosis` int(3) DEFAULT NULL COMMENT '診斷[參照表users_diagnosis_codes]',
  `diagnosis_other` text,
  `event` int(3) DEFAULT NULL COMMENT '發生狀況[參照表users_event_codes]',
  `event_other` text,
  PRIMARY KEY (`ui_id`),
  KEY `u_id` (`ubi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 表的關聯 `users_investigation`:
--   `ubi_id`
--       `users_body_info` -> `ubi_id`
--

--
-- 已匯出資料表的限制(Constraint)
--

--
-- 資料表的 Constraints `functional_measurement`
--
ALTER TABLE `functional_measurement`
  ADD CONSTRAINT `functional_measurement_ibfk_1` FOREIGN KEY (`ubi_id`) REFERENCES `users_body_info` (`ubi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `medical_history`
--
ALTER TABLE `medical_history`
  ADD CONSTRAINT `medical_history_ibfk_1` FOREIGN KEY (`ubi_id`) REFERENCES `users_body_info` (`ubi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `muscles_joints_measurement`
--
ALTER TABLE `muscles_joints_measurement`
  ADD CONSTRAINT `muscles_joints_measurement_ibfk_1` FOREIGN KEY (`ubi_id`) REFERENCES `users_body_info` (`ubi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `psychological_skill_scale`
--
ALTER TABLE `psychological_skill_scale`
  ADD CONSTRAINT `psychological_skill_scale_ibfk_1` FOREIGN KEY (`ubi_id`) REFERENCES `users_body_info` (`ubi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `shoes_advance_info`
--
ALTER TABLE `shoes_advance_info`
  ADD CONSTRAINT `shoes_advance_info_ibfk_1` FOREIGN KEY (`ubi_id`) REFERENCES `users_body_info` (`ubi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `shoes_basic_info`
--
ALTER TABLE `shoes_basic_info`
  ADD CONSTRAINT `shoes_basic_info_ibfk_1` FOREIGN KEY (`ubi_id`) REFERENCES `users_body_info` (`ubi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `users_body_info`
--
ALTER TABLE `users_body_info`
  ADD CONSTRAINT `users_body_info_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `users_investigation`
--
ALTER TABLE `users_investigation`
  ADD CONSTRAINT `users_investigation_ibfk_1` FOREIGN KEY (`ubi_id`) REFERENCES `users_body_info` (`ubi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
