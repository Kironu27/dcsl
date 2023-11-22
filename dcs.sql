/*
 Navicat Premium Data Transfer

 Source Server         : UMSDB
 Source Server Type    : MySQL
 Source Server Version : 80019
 Source Host           : umsdb.iukl.edu.my:3306
 Source Schema         : dcs

 Target Server Type    : MySQL
 Target Server Version : 80019
 File Encoding         : 65001

 Date: 15/11/2023 22:13:09
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for announcement
-- ----------------------------
DROP TABLE IF EXISTS `announcement`;
CREATE TABLE `announcement`  (
  `announcement_id` tinyint NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `target` enum('all','customer') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `status` enum('active','inactive','draft') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_by` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_by` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`announcement_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of announcement
-- ----------------------------
INSERT INTO `announcement` VALUES (1, 'Welcome to Daimon Sport Center Dashboard', 'You can view event happening in our Sports Centre', 'customer', 'active', '1', '2023-01-10 08:51:49', NULL, NULL);
INSERT INTO `announcement` VALUES (2, 'Double Up - 1-1 Challenge', 'Compete with our Trainer to Win up RM10000', 'customer', 'active', '1', '2023-08-10 08:51:49', NULL, NULL);
INSERT INTO `announcement` VALUES (3, 'Court Repair', 'Court will be having a repair maintainance happen on 25 September 2023', 'customer', 'draft', '1', '2023-09-20 08:51:49', NULL, NULL);
INSERT INTO `announcement` VALUES (4, 'Idea To Get Your Event Up', 'Don\'t Overspend EXPENSIVE gear to boost you skill, but BOOST your skill with SUITABLE gear to improved it', 'customer', 'active', '1', '2023-02-10 07:35:29', NULL, NULL);
INSERT INTO `announcement` VALUES (8, 'test', 'test', 'all', 'active', '1', '2023-10-06 03:57:23', NULL, NULL);

-- ----------------------------
-- Table structure for bank_card_type
-- ----------------------------
DROP TABLE IF EXISTS `bank_card_type`;
CREATE TABLE `bank_card_type`  (
  `bank_card_type_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `updated_by` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_by` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`bank_card_type_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bank_card_type
-- ----------------------------
INSERT INTO `bank_card_type` VALUES ('CREDIT', 'Credit', 'active', '2022-12-15 14:33:21', 'DEVELOPER', NULL, NULL, NULL, NULL);
INSERT INTO `bank_card_type` VALUES ('DEBIT', 'Debit', 'active', '2022-12-15 14:33:21', 'DEVELOPER', NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for booking
-- ----------------------------
DROP TABLE IF EXISTS `booking`;
CREATE TABLE `booking`  (
  `booking_id` tinyint NOT NULL AUTO_INCREMENT,
  `venue_id` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `customer_id` tinyint NULL DEFAULT NULL,
  `booking_date` date NULL DEFAULT NULL,
  `booking_time` time(0) NULL DEFAULT NULL,
  `booking_duration` tinyint NULL DEFAULT NULL,
  `group_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `gear_needed` tinyint NULL DEFAULT NULL,
  `racquet` tinyint NULL DEFAULT NULL,
  `shuttlecock` tinyint NULL DEFAULT NULL,
  `status` enum('active','inactive','booked','expired') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_by` tinyint NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_by` tinyint NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`booking_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 53 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of booking
-- ----------------------------
INSERT INTO `booking` VALUES (30, 'C1', 3, '2023-11-09', '09:00:00', 3, '231109_0900_C1_3', 1, 4, 6, 'expired', 3, '2023-11-12 21:43:43', NULL, NULL);
INSERT INTO `booking` VALUES (31, 'C1', 3, '2023-11-09', '10:00:00', 3, '231109_0900_C1_3', 1, 4, 6, 'expired', 3, '2023-11-12 21:43:43', NULL, NULL);
INSERT INTO `booking` VALUES (32, 'C1', 3, '2023-11-09', '11:00:00', 3, '231109_0900_C1_3', 1, 4, 6, 'expired', 3, '2023-11-12 21:43:43', NULL, NULL);
INSERT INTO `booking` VALUES (33, 'C1', 3, '2023-11-13', '11:00:00', 3, '231113_1100_C1_3', 1, 4, 6, 'expired', 3, '2023-11-12 21:43:43', NULL, NULL);
INSERT INTO `booking` VALUES (34, 'C1', 3, '2023-11-13', '12:00:00', 3, '231113_1100_C1_3', 1, 4, 6, 'expired', 3, '2023-11-12 21:43:43', NULL, NULL);
INSERT INTO `booking` VALUES (35, 'C1', 3, '2023-11-13', '13:00:00', 3, '231113_1100_C1_3', 1, 4, 6, 'expired', 3, '2023-11-12 21:43:43', NULL, NULL);
INSERT INTO `booking` VALUES (36, 'C1', 3, '2023-11-20', '12:00:00', 3, '231120_1200_C1_3', 1, 4, 6, 'booked', 3, '2023-11-12 21:43:43', NULL, NULL);
INSERT INTO `booking` VALUES (37, 'C1', 3, '2023-11-20', '13:00:00', 3, '231120_1200_C1_3', 1, 4, 6, 'booked', 3, '2023-11-12 21:43:43', NULL, NULL);
INSERT INTO `booking` VALUES (38, 'C1', 3, '2023-11-20', '14:00:00', 3, '231120_1200_C1_3', 1, 4, 6, 'booked', 3, '2023-11-12 21:43:43', NULL, NULL);
INSERT INTO `booking` VALUES (39, 'C1', 3, '2023-11-14', '11:00:00', 1, '231114_1100_C1_3', 1, 1, 1, 'expired', 3, '2023-11-13 18:46:00', NULL, NULL);
INSERT INTO `booking` VALUES (40, 'C1', 34, '2023-11-14', '15:00:00', 4, '231114_1500_C1_34', 0, NULL, NULL, 'expired', 34, '2023-11-13 20:55:41', NULL, NULL);
INSERT INTO `booking` VALUES (41, 'C1', 34, '2023-11-14', '16:00:00', 4, '231114_1500_C1_34', 0, NULL, NULL, 'expired', 34, '2023-11-13 20:55:41', NULL, NULL);
INSERT INTO `booking` VALUES (42, 'C1', 34, '2023-11-14', '17:00:00', 4, '231114_1500_C1_34', 0, NULL, NULL, 'expired', 34, '2023-11-13 20:55:41', NULL, NULL);
INSERT INTO `booking` VALUES (43, 'C1', 34, '2023-11-14', '18:00:00', 4, '231114_1500_C1_34', 0, NULL, NULL, 'expired', 34, '2023-11-13 20:55:41', NULL, NULL);
INSERT INTO `booking` VALUES (44, 'C1', 36, '2023-11-15', '09:00:00', 2, '231115_0900_C1_36', 0, NULL, NULL, 'booked', 36, '2023-11-14 12:48:45', NULL, NULL);
INSERT INTO `booking` VALUES (45, 'C1', 36, '2023-11-15', '10:00:00', 2, '231115_0900_C1_36', 0, NULL, NULL, 'booked', 36, '2023-11-14 12:48:45', NULL, NULL);
INSERT INTO `booking` VALUES (46, 'C1', 37, '2023-11-15', '20:00:00', 5, '231115_2000_C1_37', 1, 4, 6, 'booked', 37, '2023-11-14 14:30:05', NULL, NULL);
INSERT INTO `booking` VALUES (47, 'C1', 37, '2023-11-15', '21:00:00', 5, '231115_2000_C1_37', 1, 4, 6, 'booked', 37, '2023-11-14 14:30:05', NULL, NULL);
INSERT INTO `booking` VALUES (48, 'C1', 37, '2023-11-15', '22:00:00', 5, '231115_2000_C1_37', 1, 4, 6, 'booked', 37, '2023-11-14 14:30:05', NULL, NULL);
INSERT INTO `booking` VALUES (49, 'C1', 37, '2023-11-15', '23:00:00', 5, '231115_2000_C1_37', 1, 4, 6, 'booked', 37, '2023-11-14 14:30:05', NULL, NULL);
INSERT INTO `booking` VALUES (50, 'C1', 37, '2023-11-15', '00:00:00', 5, '231115_2000_C1_37', 1, 4, 6, 'booked', 37, '2023-11-14 14:30:05', NULL, NULL);
INSERT INTO `booking` VALUES (51, 'C1', 37, '2023-11-16', '10:00:00', 2, '231116_1000_C1_37', 0, NULL, NULL, 'booked', 37, '2023-11-15 21:11:15', NULL, NULL);
INSERT INTO `booking` VALUES (52, 'C1', 37, '2023-11-16', '11:00:00', 2, '231116_1000_C1_37', 0, NULL, NULL, 'booked', 37, '2023-11-15 21:11:15', NULL, NULL);

-- ----------------------------
-- Table structure for booking_payment
-- ----------------------------
DROP TABLE IF EXISTS `booking_payment`;
CREATE TABLE `booking_payment`  (
  `payment_id` tinyint NOT NULL AUTO_INCREMENT,
  `group_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `booking_id` tinyint NOT NULL,
  `payment_type_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `credit_card_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `credit_card_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `ccv` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `credit_card_date_expired` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `bank_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `price` decimal(4, 2) NULL DEFAULT NULL,
  `status` enum('paid','pending','') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_by` tinyint NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_by` tinyint NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`payment_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of booking_payment
-- ----------------------------
INSERT INTO `booking_payment` VALUES (19, '231109_0900_C1_3', 32, 'ob', NULL, NULL, NULL, NULL, 'MBB0228', 90.00, 'paid', 3, '2023-11-12 21:43:43', NULL, NULL);
INSERT INTO `booking_payment` VALUES (20, '231113_1100_C1_3', 32, 'ob', NULL, NULL, NULL, NULL, 'MBB0228', 90.00, 'paid', 3, '2023-11-12 21:43:43', NULL, NULL);
INSERT INTO `booking_payment` VALUES (21, '231120_1200_C1_3', 32, 'ob', NULL, NULL, NULL, NULL, 'MBB0228', 90.00, 'paid', 3, '2023-11-12 21:43:43', NULL, NULL);
INSERT INTO `booking_payment` VALUES (22, '231114_1100_C1_3', 39, 'ob', NULL, NULL, NULL, NULL, 'MBB0228', 22.00, 'paid', 3, '2023-11-13 18:46:00', NULL, NULL);
INSERT INTO `booking_payment` VALUES (23, '231114_1500_C1_34', 43, 'ob', NULL, NULL, NULL, NULL, 'ABMB0212', 40.00, 'paid', 34, '2023-11-13 20:55:41', NULL, NULL);
INSERT INTO `booking_payment` VALUES (24, '231115_0900_C1_36', 45, 'ob', NULL, NULL, NULL, NULL, 'ABB0234', 20.00, 'paid', 36, '2023-11-14 12:48:45', NULL, NULL);
INSERT INTO `booking_payment` VALUES (25, '231115_2000_C1_37', 50, 'ob', NULL, NULL, NULL, NULL, 'BCBB0235', 99.99, 'paid', 37, '2023-11-14 14:30:05', NULL, NULL);
INSERT INTO `booking_payment` VALUES (26, '231116_1000_C1_37', 52, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'paid', 37, '2023-11-15 21:11:15', NULL, NULL);

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer`  (
  `customer_id` tinyint NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `contact_no` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `dob` date NULL DEFAULT NULL,
  `payment_code` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `verification_code` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `gender` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `is_reset` tinyint NULL DEFAULT NULL,
  `status` enum('active','inactive','pending') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_by` tinyint NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_by` tinyint NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`customer_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES (1, 'Adam Sandler', 'adam@gmail.com', '012455487', '1983-06-12', NULL, NULL, 'male', '$2y$10$YwoPh9fvNe5p1YIRFzBUFexIAbXgV8TyIc7oezvXnLqfJXJQ6GLUe', NULL, 'active', 1, '2023-01-08 18:13:33', 1, '2023-11-14 13:40:17');
INSERT INTO `customer` VALUES (2, 'Levine James', 'levine@gmail.com', '014789741', '1984-04-13', NULL, NULL, 'male', '$2y$10$YwoPh9fvNe5p1YIRFzBUFexIAbXgV8TyIc7oezvXnLqfJXJQ6GLUe', NULL, 'active', 2, '2023-02-08 18:13:33', NULL, NULL);
INSERT INTO `customer` VALUES (3, 'Sophia Al Barakbah', 'sophia@gmail.com', '3211', '1985-12-22', '608737', NULL, 'female', '$2y$10$.dRfsCYzRx3soW4rz/5ml.sDolV4G3NBMHVIjE5h7lzPsE10Pjoem', NULL, 'active', 3, '2023-03-08 18:13:33', 3, '2023-11-13 02:48:26');
INSERT INTO `customer` VALUES (4, 'Fatin Afeefa', 'fatinfafa@gmail.com', '012373213', '1998-07-07', NULL, NULL, 'female', '$2y$10$YwoPh9fvNe5p1YIRFzBUFexIAbXgV8TyIc7oezvXnLqfJXJQ6GLUe', NULL, 'active', 4, '2023-04-19 17:16:59', NULL, NULL);
INSERT INTO `customer` VALUES (5, 'Aina Syafiqah', 'aina_syafiqah@gmail.com', '032131321', '1990-01-20', NULL, NULL, 'female', '$2y$10$YwoPh9fvNe5p1YIRFzBUFexIAbXgV8TyIc7oezvXnLqfJXJQ6GLUe', NULL, 'active', 5, '2023-05-19 06:24:19', 5, '2023-02-19 06:26:08');
INSERT INTO `customer` VALUES (6, 'Lando Zawawi', 'lando_zawawi@gmail.com', '03211', '1975-08-16', NULL, NULL, 'male', '$2y$10$YwoPh9fvNe5p1YIRFzBUFexIAbXgV8TyIc7oezvXnLqfJXJQ6GLUe', NULL, 'active', 6, '2023-06-19 06:28:25', NULL, NULL);
INSERT INTO `customer` VALUES (7, 'Johnny Sin', 'johhny_sin@gmail.com', '02132131', '1980-03-29', NULL, NULL, 'male', '$2y$10$YwoPh9fvNe5p1YIRFzBUFexIAbXgV8TyIc7oezvXnLqfJXJQ6GLUe', NULL, 'active', 7, '2023-07-19 06:29:45', NULL, NULL);
INSERT INTO `customer` VALUES (8, 'Sara Adlina', 'sara_adlina@gmail.com', '012830232', '2000-02-02', NULL, NULL, 'female', '$2y$10$YwoPh9fvNe5p1YIRFzBUFexIAbXgV8TyIc7oezvXnLqfJXJQ6GLUe', NULL, 'active', 7, '2023-08-19 06:29:45', NULL, NULL);
INSERT INTO `customer` VALUES (9, 'Thia Azman', 'thia.azman@gmail.com', '0111283692', '1982-09-09', NULL, NULL, 'female', '$2y$10$YwoPh9fvNe5p1YIRFzBUFexIAbXgV8TyIc7oezvXnLqfJXJQ6GLUe', NULL, 'active', 7, '2023-09-19 06:29:45', NULL, NULL);
INSERT INTO `customer` VALUES (10, 'Najwa Ishak', 'najwa.ishak@gmail.com', '0182123732', '1981-10-09', NULL, NULL, 'female', '$2y$10$YwoPh9fvNe5p1YIRFzBUFexIAbXgV8TyIc7oezvXnLqfJXJQ6GLUe', NULL, 'active', 7, '2023-10-19 06:29:45', NULL, NULL);
INSERT INTO `customer` VALUES (11, 'Eina Aziq', 'eina.aziq@gmail.com', '0192321321', '1989-11-11', NULL, NULL, 'female', '$2y$10$YwoPh9fvNe5p1YIRFzBUFexIAbXgV8TyIc7oezvXnLqfJXJQ6GLUe', NULL, 'active', 7, '2023-11-19 06:29:45', NULL, NULL);
INSERT INTO `customer` VALUES (12, 'Azri Walter', 'azri_walter@gmail.com', '0132737192', '1970-01-29', NULL, NULL, 'male', '$2y$10$YwoPh9fvNe5p1YIRFzBUFexIAbXgV8TyIc7oezvXnLqfJXJQ6GLUe', NULL, 'active', 7, '2023-12-19 06:29:45', NULL, NULL);
INSERT INTO `customer` VALUES (13, 'Zaidi Haron', 'zaidi.haron@gmail.com', '0123832172', '1972-02-28', NULL, NULL, 'male', '$2y$10$YwoPh9fvNe5p1YIRFzBUFexIAbXgV8TyIc7oezvXnLqfJXJQ6GLUe', NULL, 'active', 7, '2023-01-19 06:29:45', NULL, NULL);
INSERT INTO `customer` VALUES (14, 'Zamzarina Zamri', 'zamzarina.zamri@gmail.com', '0123736473', '1973-03-18', NULL, NULL, 'female', '$2y$10$YwoPh9fvNe5p1YIRFzBUFexIAbXgV8TyIc7oezvXnLqfJXJQ6GLUe', NULL, 'active', 7, '2023-02-19 06:29:45', NULL, NULL);
INSERT INTO `customer` VALUES (15, 'Farah Lydia', 'farah.lydia@gmail.com', '0133736473', '1984-03-18', NULL, NULL, 'female', '$2y$10$YwoPh9fvNe5p1YIRFzBUFexIAbXgV8TyIc7oezvXnLqfJXJQ6GLUe', NULL, 'active', 7, '2023-03-19 06:29:45', NULL, NULL);
INSERT INTO `customer` VALUES (16, 'Hans Isaac', 'han.isaac@gmail.com', '0143736473', '1985-05-13', NULL, NULL, 'male', '$2y$10$YwoPh9fvNe5p1YIRFzBUFexIAbXgV8TyIc7oezvXnLqfJXJQ6GLUe', NULL, 'active', 7, '2023-04-19 06:29:45', NULL, NULL);
INSERT INTO `customer` VALUES (17, 'Najib Razak', 'najib.razak@gmail.com', '0153736473', '1986-06-29', NULL, NULL, 'male', '$2y$10$YwoPh9fvNe5p1YIRFzBUFexIAbXgV8TyIc7oezvXnLqfJXJQ6GLUe', NULL, 'active', 7, '2023-05-19 06:29:45', NULL, NULL);
INSERT INTO `customer` VALUES (18, 'Hattan Bachan', 'hattan.bachan@gmail.com', '0143736473', '1956-08-09', NULL, NULL, 'male', '$2y$10$YwoPh9fvNe5p1YIRFzBUFexIAbXgV8TyIc7oezvXnLqfJXJQ6GLUe', NULL, 'active', 7, '2023-10-19 06:29:45', NULL, NULL);
INSERT INTO `customer` VALUES (19, 'Michelle Yeoh', 'michelle.yeoh@gmail.com', '0193736473', '1986-09-19', NULL, NULL, 'female', '$2y$10$YwoPh9fvNe5p1YIRFzBUFexIAbXgV8TyIc7oezvXnLqfJXJQ6GLUe', NULL, 'active', 7, '2023-11-19 06:29:45', NULL, NULL);
INSERT INTO `customer` VALUES (20, 'Sabrina Lee', 'sabrina.lee@gmail.com', '0203736473', '1981-11-11', NULL, NULL, 'female', '$2y$10$YwoPh9fvNe5p1YIRFzBUFexIAbXgV8TyIc7oezvXnLqfJXJQ6GLUe', NULL, 'active', 7, '2023-12-19 06:29:45', NULL, NULL);
INSERT INTO `customer` VALUES (21, 'Margaret Samuel', 'margaret.samuel@gmail.com', '0101283644', '1981-12-11', NULL, NULL, 'female', '$2y$10$YwoPh9fvNe5p1YIRFzBUFexIAbXgV8TyIc7oezvXnLqfJXJQ6GLUe', NULL, 'active', 7, '2023-12-19 06:29:45', NULL, NULL);
INSERT INTO `customer` VALUES (34, 'Farhan', 'farhanfahmiebil@gmail.com', '123', '1111-11-11', '263921', '949805', 'male', '$2y$10$XEzppymQot4hExD/hAbozuZOaqm8YPd0dmYYwETwM3Qkzftoy.UkK', 1, 'pending', 34, '2023-11-13 19:00:30', 34, '2023-11-13 21:33:53');
INSERT INTO `customer` VALUES (35, 'Zain', 'zain@outlook.com', '012232123', '1987-12-21', NULL, '986035', 'male', '$2y$10$oZiKbccqEXSmJoX.bDZbSOSbdteXCxvNTa8TvzOCWcvVjxpgmWGI6', NULL, 'pending', 35, '2023-11-13 21:14:23', NULL, NULL);
INSERT INTO `customer` VALUES (36, 'affiz', 'silverhawke27@gmail.com', '0196138127', '2000-04-27', '605833', '879991', 'male', '$2y$10$Qb2a/iiXEt.y/t4eUfcNn.uk3IpxS/0OmP.kxKoptlRncJZPfK67m', 1, 'pending', 36, '2023-11-14 12:46:58', 36, '2023-11-14 13:11:06');
INSERT INTO `customer` VALUES (37, 'amsyar', 'amsyarmock@gmail.com', '0196138127', '1999-01-13', '569908', '236926', 'male', '$2y$10$rw7QhZMfOuF41cUDwgwu9OWAkgZ1ThwAOMG6NavAqU.Tt3ADg5Ey6', 1, 'pending', 37, '2023-11-14 14:27:17', 37, '2023-11-15 02:42:50');

-- ----------------------------
-- Table structure for employee
-- ----------------------------
DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee`  (
  `employee_id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` tinyint NULL DEFAULT NULL,
  `role` enum('admin','superadmin','staff') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `is_reset` tinyint NULL DEFAULT NULL,
  `updated_by` tinyint NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`employee_id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of employee
-- ----------------------------
INSERT INTO `employee` VALUES (1, 'Admin', 'admin@live.com', NULL, 'admin', '$2y$10$LTHiiIw8EJC8zTMrd0AxUuEMU1sctBaodYwRsu.VfLLacIzxyUWCS', NULL, 'active', '2023-03-28 02:24:40', NULL, 1, '2023-11-14 13:40:32');

-- ----------------------------
-- Table structure for equipment_ball
-- ----------------------------
DROP TABLE IF EXISTS `equipment_ball`;
CREATE TABLE `equipment_ball`  (
  `sport_id` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `equipment_ball_id` tinyint NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `type` enum('feather','synthetic') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `quantity` tinyint NULL DEFAULT NULL,
  `amount` decimal(5, 2) NULL DEFAULT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_by` tinyint NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_by` tinyint NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`sport_id`, `equipment_ball_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of equipment_ball
-- ----------------------------
INSERT INTO `equipment_ball` VALUES ('BD', 1, 'Shuttlecock', 'feather', 1, 2.00, 'active', 1, '2023-10-02 15:02:10', NULL, NULL);
INSERT INTO `equipment_ball` VALUES ('BD', 2, 'Shuttlecock', 'feather', 5, 10.00, 'active', 1, '2023-10-02 15:02:10', NULL, NULL);
INSERT INTO `equipment_ball` VALUES ('BD', 3, 'Shuttlecock', 'feather', 10, 20.00, 'active', 1, '2023-10-02 15:02:10', NULL, NULL);
INSERT INTO `equipment_ball` VALUES ('BD', 4, 'Shuttlecock', 'synthetic', 1, 2.00, 'active', 1, '2023-10-02 15:02:10', NULL, NULL);
INSERT INTO `equipment_ball` VALUES ('BD', 5, 'Shuttlecock', 'synthetic', 5, 10.00, 'active', 1, '2023-10-02 15:02:10', NULL, NULL);
INSERT INTO `equipment_ball` VALUES ('BD', 6, 'Shuttlecock', 'synthetic', 10, 20.00, 'active', 1, '2023-10-02 15:02:10', NULL, NULL);

-- ----------------------------
-- Table structure for equipment_racquet
-- ----------------------------
DROP TABLE IF EXISTS `equipment_racquet`;
CREATE TABLE `equipment_racquet`  (
  `sport_id` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `equipment_racquet_id` tinyint NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `quantity` tinyint NULL DEFAULT NULL,
  `amount` decimal(5, 2) NULL DEFAULT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_by` tinyint NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_by` tinyint NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`sport_id`, `equipment_racquet_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of equipment_racquet
-- ----------------------------
INSERT INTO `equipment_racquet` VALUES ('BD', 1, 'Racquet', 1, 10.00, 'active', 1, '2023-10-02 15:02:10', NULL, NULL);
INSERT INTO `equipment_racquet` VALUES ('BD', 2, 'Racquet', 2, 20.00, 'active', 1, '2023-10-02 15:02:10', NULL, NULL);
INSERT INTO `equipment_racquet` VALUES ('BD', 3, 'Racquet', 3, 30.00, 'active', 1, '2023-10-02 15:02:10', NULL, NULL);
INSERT INTO `equipment_racquet` VALUES ('BD', 4, 'Racquet', 4, 40.00, 'active', 1, '2023-10-02 15:02:10', NULL, NULL);

-- ----------------------------
-- Table structure for equipment_shoe
-- ----------------------------
DROP TABLE IF EXISTS `equipment_shoe`;
CREATE TABLE `equipment_shoe`  (
  `sport_id` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `equipment_id` tinyint(1) NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `size` tinyint NULL DEFAULT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_by` tinyint NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_by` tinyint NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`sport_id`, `equipment_id`) USING BTREE,
  INDEX `sport_id_foreign`(`sport_id`) USING BTREE,
  CONSTRAINT `sport_id_foreign` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of equipment_shoe
-- ----------------------------
INSERT INTO `equipment_shoe` VALUES ('BD', 1, NULL, 6, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for equipment_shoe_copy1
-- ----------------------------
DROP TABLE IF EXISTS `equipment_shoe_copy1`;
CREATE TABLE `equipment_shoe_copy1`  (
  `sport_id` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `equipment_id` tinyint(1) NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `size` tinyint NULL DEFAULT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_by` tinyint NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_by` tinyint NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`sport_id`, `equipment_id`) USING BTREE,
  INDEX `sport_id_foreign`(`sport_id`) USING BTREE,
  CONSTRAINT `equipment_shoe_copy1_ibfk_1` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of equipment_shoe_copy1
-- ----------------------------
INSERT INTO `equipment_shoe_copy1` VALUES ('BD', 1, NULL, 6, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for operation_hour
-- ----------------------------
DROP TABLE IF EXISTS `operation_hour`;
CREATE TABLE `operation_hour`  (
  `operation_hour_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `day_id` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `time` time(0) NOT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `updated_by` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_by` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`operation_hour_id`, `day_id`, `time`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of operation_hour
-- ----------------------------
INSERT INTO `operation_hour` VALUES ('0000', 'friday', '00:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0000', 'monday', '00:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0000', 'saturday', '00:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0000', 'sunday', '00:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0000', 'thursday', '00:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0000', 'tuesday', '00:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0000', 'wednesday', '00:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0100', 'friday', '01:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0100', 'monday', '01:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0100', 'saturday', '01:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0100', 'sunday', '01:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0100', 'thursday', '01:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0100', 'tuesday', '01:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0100', 'wednesday', '01:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0200', 'friday', '02:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0200', 'monday', '02:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0200', 'saturday', '02:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0200', 'sunday', '02:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0200', 'thursday', '02:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0200', 'tuesday', '02:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0200', 'wednesday', '02:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0300', 'friday', '03:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0300', 'monday', '03:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0300', 'saturday', '03:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0300', 'sunday', '03:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0300', 'thursday', '03:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0300', 'tuesday', '03:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0300', 'wednesday', '03:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0400', 'friday', '04:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0400', 'monday', '04:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0400', 'saturday', '04:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0400', 'sunday', '04:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0400', 'thursday', '04:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0400', 'tuesday', '04:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0400', 'wednesday', '04:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0500', 'friday', '05:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0500', 'monday', '05:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0500', 'saturday', '05:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0500', 'sunday', '05:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0500', 'thursday', '05:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0500', 'tuesday', '05:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0500', 'wednesday', '05:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0600', 'friday', '06:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0600', 'monday', '06:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0600', 'saturday', '06:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0600', 'sunday', '06:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0600', 'thursday', '06:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0600', 'tuesday', '06:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0600', 'wednesday', '06:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0700', 'friday', '07:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0700', 'monday', '07:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0700', 'saturday', '07:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0700', 'sunday', '07:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0700', 'thursday', '07:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0700', 'tuesday', '07:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0700', 'wednesday', '07:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0800', 'friday', '08:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0800', 'monday', '08:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0800', 'saturday', '08:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0800', 'sunday', '08:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0800', 'thursday', '08:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0800', 'tuesday', '08:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0800', 'wednesday', '08:00:00', 'inactive', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0900', 'friday', '09:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0900', 'monday', '09:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0900', 'saturday', '09:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0900', 'sunday', '09:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0900', 'thursday', '09:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0900', 'tuesday', '09:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('0900', 'wednesday', '09:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1000', 'friday', '10:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1000', 'monday', '10:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1000', 'saturday', '10:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1000', 'sunday', '10:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1000', 'thursday', '10:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1000', 'tuesday', '10:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1000', 'wednesday', '10:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1100', 'friday', '11:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1100', 'monday', '11:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1100', 'saturday', '11:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1100', 'sunday', '11:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1100', 'thursday', '11:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1100', 'tuesday', '11:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1100', 'wednesday', '11:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1200', 'friday', '12:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1200', 'monday', '12:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1200', 'saturday', '12:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1200', 'sunday', '12:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1200', 'thursday', '12:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1200', 'tuesday', '12:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1200', 'wednesday', '12:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1300', 'friday', '13:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', '1', '2023-11-13 00:14:23', NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1300', 'monday', '13:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', '1', '2023-11-13 00:14:23', NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1300', 'saturday', '13:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', '1', '2023-11-13 00:14:23', NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1300', 'sunday', '13:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', '1', '2023-11-13 00:14:23', NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1300', 'thursday', '13:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', '1', '2023-11-13 00:14:23', NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1300', 'tuesday', '13:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', '1', '2023-11-13 00:14:23', NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1300', 'wednesday', '13:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', '1', '2023-11-13 00:14:23', NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1400', 'friday', '14:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1400', 'monday', '14:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1400', 'saturday', '14:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1400', 'sunday', '14:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1400', 'thursday', '14:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1400', 'tuesday', '14:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1400', 'wednesday', '14:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1500', 'friday', '15:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1500', 'monday', '15:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1500', 'saturday', '15:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1500', 'sunday', '15:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1500', 'thursday', '15:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1500', 'tuesday', '15:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1500', 'wednesday', '15:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1600', 'friday', '16:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1600', 'monday', '16:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1600', 'saturday', '16:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1600', 'sunday', '16:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1600', 'thursday', '16:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1600', 'tuesday', '16:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1600', 'wednesday', '16:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1700', 'friday', '17:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1700', 'monday', '17:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1700', 'saturday', '17:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1700', 'sunday', '17:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1700', 'thursday', '17:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1700', 'tuesday', '17:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1700', 'wednesday', '17:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1800', 'friday', '18:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1800', 'monday', '18:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1800', 'saturday', '18:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1800', 'sunday', '18:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1800', 'thursday', '18:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1800', 'tuesday', '18:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1800', 'wednesday', '18:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1900', 'friday', '19:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1900', 'monday', '19:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1900', 'saturday', '19:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1900', 'sunday', '19:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1900', 'thursday', '19:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1900', 'tuesday', '19:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('1900', 'wednesday', '19:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('2000', 'friday', '20:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('2000', 'monday', '20:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('2000', 'saturday', '20:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('2000', 'sunday', '20:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('2000', 'thursday', '20:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('2000', 'tuesday', '20:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('2000', 'wednesday', '20:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('2100', 'friday', '21:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('2100', 'monday', '21:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('2100', 'saturday', '21:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('2100', 'sunday', '21:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('2100', 'thursday', '21:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('2100', 'tuesday', '21:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('2100', 'wednesday', '21:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('2200', 'friday', '22:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('2200', 'monday', '22:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('2200', 'saturday', '22:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('2200', 'sunday', '22:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('2200', 'thursday', '22:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('2200', 'tuesday', '22:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('2200', 'wednesday', '22:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('2300', 'friday', '23:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('2300', 'monday', '23:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('2300', 'saturday', '23:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('2300', 'sunday', '23:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('2300', 'thursday', '23:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('2300', 'tuesday', '23:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);
INSERT INTO `operation_hour` VALUES ('2300', 'wednesday', '23:00:00', 'active', '2023-11-06 23:25:01', 'ADMINISTRATOR', NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for payment
-- ----------------------------
DROP TABLE IF EXISTS `payment`;
CREATE TABLE `payment`  (
  `PaymentID` int NOT NULL,
  `PaymentDate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `Amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `InvoiceID` int NULL DEFAULT NULL,
  PRIMARY KEY (`PaymentID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payment
-- ----------------------------
INSERT INTO `payment` VALUES (1, '1/06/2023', '$1000', 1);
INSERT INTO `payment` VALUES (2, '2/06/2023', '$900', 2);
INSERT INTO `payment` VALUES (3, '2/06/2023', '$100', 1);
INSERT INTO `payment` VALUES (4, '3/06/2023', '$700', 3);

-- ----------------------------
-- Table structure for payment_network
-- ----------------------------
DROP TABLE IF EXISTS `payment_network`;
CREATE TABLE `payment_network`  (
  `payment_network_id` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_by` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_by` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`payment_network_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payment_network
-- ----------------------------
INSERT INTO `payment_network` VALUES ('AMEX', 'American Express', 'active', 'DEVELOPER', '2022-12-15 14:25:29', NULL, NULL);
INSERT INTO `payment_network` VALUES ('DISCOVER', 'Discover', 'active', 'DEVELOPER', '2022-12-15 14:25:29', NULL, NULL);
INSERT INTO `payment_network` VALUES ('MASTERCARD', 'Mastercard', 'active', 'DEVELOPER', '2022-12-15 14:25:29', NULL, NULL);
INSERT INTO `payment_network` VALUES ('VISA', 'Visa', 'active', 'DEVELOPER', '2022-12-15 14:25:29', NULL, NULL);

-- ----------------------------
-- Table structure for payment_online_banking
-- ----------------------------
DROP TABLE IF EXISTS `payment_online_banking`;
CREATE TABLE `payment_online_banking`  (
  `payment_online_banking_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `category` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `display_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `status` enum('active','inactive','deleted') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `created_by` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_by` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT '',
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_by` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT '',
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`payment_online_banking_id`, `category`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payment_online_banking
-- ----------------------------
INSERT INTO `payment_online_banking` VALUES ('ABB0233', 'B2C', 'Affin Bank Berhad', 'Affin Bank', 'active', NULL, 'DEVELOPER', '2020-12-07 16:20:23', 'DEVELOPER', '2021-08-18 19:42:07', NULL, NULL);
INSERT INTO `payment_online_banking` VALUES ('ABB0234', 'B2C', 'Affin Bank Berhad B2C - Test ID', 'Affin B2C - Test ID', 'active', NULL, 'DEVELOPER', '2021-08-18 19:37:27', 'DEVELOPER', '2021-08-18 19:43:44', NULL, NULL);
INSERT INTO `payment_online_banking` VALUES ('ABMB0212', 'B2C', 'Alliance Bank Malaysia \nBerhad', 'Alliance Bank (Personal)', 'active', NULL, 'DEVELOPER', '2020-12-07 16:20:23', 'DEVELOPER', '2022-04-06 14:31:44', NULL, NULL);
INSERT INTO `payment_online_banking` VALUES ('AGRO01', 'B2C', 'Bank Pertanian Malaysia Berhad (AGROBANK)', 'AGRONet', 'active', NULL, 'DEVELOPER', '2021-08-18 19:38:41', 'DEVELOPER', '2021-08-18 19:43:47', NULL, NULL);
INSERT INTO `payment_online_banking` VALUES ('AMBB0209', 'B2C', 'AmBank Malaysia Berhad', 'AmBank', 'active', NULL, 'DEVELOPER', '2020-12-07 16:20:23', 'DEVELOPER', '2021-08-18 19:42:07', NULL, NULL);
INSERT INTO `payment_online_banking` VALUES ('BCBB0235', 'B2C', 'CIMB Bank Berhad', 'CIMB Clicks', 'active', NULL, 'DEVELOPER', '2020-12-07 16:20:23', 'DEVELOPER', '2021-08-18 19:42:07', NULL, NULL);
INSERT INTO `payment_online_banking` VALUES ('BIMB0340', 'B2C', 'Bank Islam Malaysia Berhad', 'Bank Islam', 'active', NULL, 'DEVELOPER', '2020-12-07 16:20:23', 'DEVELOPER', '2021-08-18 19:42:07', NULL, NULL);
INSERT INTO `payment_online_banking` VALUES ('BKRM0602', 'B2C', 'Bank Kerjasama Rakyat\n Malaysia Berhad', 'Bank Rakyat', 'active', NULL, 'DEVELOPER', '2020-12-07 16:20:23', 'DEVELOPER', '2021-08-18 19:42:07', NULL, NULL);
INSERT INTO `payment_online_banking` VALUES ('BMMB0341', 'B2C', 'Bank Muamalat Malaysia \nBerhad', 'Bank Muamalat', 'active', NULL, 'DEVELOPER', '2020-12-07 16:20:23', 'DEVELOPER', '2022-04-06 14:31:41', NULL, NULL);
INSERT INTO `payment_online_banking` VALUES ('BSN0601', 'B2C', 'Bank Simpanan Nasional', 'BSN', 'active', NULL, 'DEVELOPER', '2020-12-07 16:20:23', 'DEVELOPER', '2021-08-18 19:42:07', NULL, NULL);
INSERT INTO `payment_online_banking` VALUES ('CIT0219', 'B2C', 'CITIBANK BHD', 'Citibank', 'active', NULL, 'DEVELOPER', '2020-12-07 16:20:23', 'DEVELOPER', '2021-08-18 19:42:07', NULL, NULL);
INSERT INTO `payment_online_banking` VALUES ('HLB0224', 'B2C', 'Hong Leong Bank Berhad', 'Hong Leong Bank', 'active', NULL, 'DEVELOPER', '2020-12-07 16:20:23', 'DEVELOPER', '2021-08-18 19:42:07', NULL, NULL);
INSERT INTO `payment_online_banking` VALUES ('HSBC0223', 'B2C', 'HSBC Bank Malaysia\n Berhad', 'HSBC Bank', 'active', NULL, 'DEVELOPER', '2020-12-07 16:20:23', 'DEVELOPER', '2022-04-06 14:32:44', NULL, NULL);
INSERT INTO `payment_online_banking` VALUES ('KFH0346', 'B2C', 'Kuwait Finance House \n(Malaysia) Berhad', 'KFH', 'active', NULL, 'DEVELOPER', '2020-12-07 16:20:23', 'DEVELOPER', '2022-04-06 14:31:39', NULL, NULL);
INSERT INTO `payment_online_banking` VALUES ('MB2U0227', 'B2C', 'Malayan Banking Berhad \n(M2U)', 'Maybank2U', 'active', NULL, 'DEVELOPER', '2020-12-07 16:20:23', 'DEVELOPER', '2022-04-06 15:31:17', NULL, NULL);
INSERT INTO `payment_online_banking` VALUES ('MBB0228', 'B2C', 'Malayan Banking Berhad \n(M2E)', 'Maybank2E', 'active', NULL, 'DEVELOPER', '2020-12-07 16:20:23', 'DEVELOPER', '2022-04-06 14:30:19', NULL, NULL);
INSERT INTO `payment_online_banking` VALUES ('OCBC0229', 'B2C', 'OCBC Bank Malaysia\n Berhad', 'OCBC Bank', 'active', NULL, 'DEVELOPER', '2020-12-07 16:20:23', 'DEVELOPER', '2022-04-06 14:31:37', NULL, NULL);
INSERT INTO `payment_online_banking` VALUES ('PBB0233', 'B2C', 'Public Bank Berhad', 'Public Bank', 'active', NULL, 'DEVELOPER', '2020-12-07 16:20:23', 'DEVELOPER', '2021-08-18 19:42:08', NULL, NULL);
INSERT INTO `payment_online_banking` VALUES ('RHB0218', 'B2C', 'RHB Bank Berhad', 'RHB Bank', 'active', NULL, 'DEVELOPER', '2020-12-07 16:20:23', 'DEVELOPER', '2021-08-18 19:42:08', NULL, NULL);
INSERT INTO `payment_online_banking` VALUES ('SCB0216', 'B2C', 'Standard Chartered Bank', 'Standard Chartered', 'active', NULL, 'DEVELOPER', '2020-12-07 16:20:23', 'DEVELOPER', '2021-08-18 19:42:08', NULL, NULL);
INSERT INTO `payment_online_banking` VALUES ('UOB0226', 'B2C', 'United Overseas Bank', 'UOB Bank', 'active', NULL, 'DEVELOPER', '2020-12-07 16:20:23', 'DEVELOPER', '2021-08-18 19:42:08', NULL, NULL);

-- ----------------------------
-- Table structure for payment_online_banking1
-- ----------------------------
DROP TABLE IF EXISTS `payment_online_banking1`;
CREATE TABLE `payment_online_banking1`  (
  `payment_online_banking_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Abbreviation` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `updated_by` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_by` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`payment_online_banking_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payment_online_banking1
-- ----------------------------
INSERT INTO `payment_online_banking1` VALUES ('CIMB', 'CIMB', 'Commerce International Merchant Bankers', 'active', '2022-12-15 14:33:21', 'DEVELOPER', NULL, NULL, NULL, NULL);
INSERT INTO `payment_online_banking1` VALUES ('MAYBANK', 'Maybank', 'Malayan Banking Berhad', 'active', '2022-12-15 14:33:21', 'DEVELOPER', NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for payment_type
-- ----------------------------
DROP TABLE IF EXISTS `payment_type`;
CREATE TABLE `payment_type`  (
  `payment_type_id` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `updated_by` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_by` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`payment_type_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payment_type
-- ----------------------------
INSERT INTO `payment_type` VALUES ('cc', 'Credit Card', 'active', '2022-12-15 14:33:21', 'DEVELOPER', NULL, NULL, NULL, NULL);
INSERT INTO `payment_type` VALUES ('ob', 'Online Banking', 'active', '2022-12-15 14:33:21', 'DEVELOPER', NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for sport
-- ----------------------------
DROP TABLE IF EXISTS `sport`;
CREATE TABLE `sport`  (
  `sport_id` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_by` tinyint NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_by` tinyint NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`sport_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sport
-- ----------------------------
INSERT INTO `sport` VALUES ('BD', 'Badminton', 'active', 1, '2023-10-02 14:38:58', 1, '2023-11-13 01:50:12');

-- ----------------------------
-- Table structure for venue
-- ----------------------------
DROP TABLE IF EXISTS `venue`;
CREATE TABLE `venue`  (
  `venue_id` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `venue_category_id` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sport_id` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `amount` decimal(4, 2) NULL DEFAULT NULL,
  `status` enum('active','inactive','maintainance') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_by` tinyint NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_by` tinyint NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`venue_id`, `venue_category_id`, `sport_id`) USING BTREE,
  INDEX `venue_category_id_foreign`(`venue_category_id`) USING BTREE,
  INDEX `venue_sport_id_foreign`(`sport_id`) USING BTREE,
  CONSTRAINT `venue_category_id_foreign` FOREIGN KEY (`venue_category_id`) REFERENCES `venue_category` (`venue_category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `venue_sport_id_foreign` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of venue
-- ----------------------------
INSERT INTO `venue` VALUES ('C1', 'INDOOR', 'BD', 'C1', 10.00, 'active', 1, '2023-10-11 03:52:29', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_1', 'INDOOR', 'BD', 'Court 1', 10.00, 'inactive', 1, '2023-10-02 14:46:08', 1, '2023-10-11 07:12:11');
INSERT INTO `venue` VALUES ('COURT_1', 'OUTDOOR', 'BD', 'Court 1', 10.00, 'inactive', 1, '2023-10-02 14:46:08', 1, '2023-10-11 07:12:11');
INSERT INTO `venue` VALUES ('COURT_10', 'INDOOR', 'BD', 'Court 10', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_10', 'OUTDOOR', 'BD', 'Court 10', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_11', 'INDOOR', 'BD', 'Court 11', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_11', 'OUTDOOR', 'BD', 'Court 11', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_12', 'INDOOR', 'BD', 'Court 12', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_12', 'OUTDOOR', 'BD', 'Court 12', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_13', 'INDOOR', 'BD', 'Court 13', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_13', 'OUTDOOR', 'BD', 'Court 13', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_14', 'INDOOR', 'BD', 'Court 14', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_14', 'OUTDOOR', 'BD', 'Court 14', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_15', 'INDOOR', 'BD', 'Court 15', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_15', 'OUTDOOR', 'BD', 'Court 15', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_16', 'INDOOR', 'BD', 'Court 16', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_16', 'OUTDOOR', 'BD', 'Court 16', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_17', 'INDOOR', 'BD', 'Court 17', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_17', 'OUTDOOR', 'BD', 'Court 17', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_18', 'INDOOR', 'BD', 'Court 18', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_18', 'OUTDOOR', 'BD', 'Court 18', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_19', 'INDOOR', 'BD', 'Court 19', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_19', 'OUTDOOR', 'BD', 'Court 19', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_2', 'INDOOR', 'BD', 'Court 2', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_2', 'OUTDOOR', 'BD', 'Court 2', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_20', 'INDOOR', 'BD', 'Court 20', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_20', 'OUTDOOR', 'BD', 'Court 20', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_3', 'INDOOR', 'BD', 'Court 3', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_3', 'OUTDOOR', 'BD', 'Court 3', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_4', 'INDOOR', 'BD', 'Court 4', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_4', 'OUTDOOR', 'BD', 'Court 4', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_5', 'INDOOR', 'BD', 'Court 5', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_5', 'OUTDOOR', 'BD', 'Court 5', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_6', 'INDOOR', 'BD', 'Court 6', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_6', 'OUTDOOR', 'BD', 'Court 6', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_7', 'INDOOR', 'BD', 'Court 7', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_7', 'OUTDOOR', 'BD', 'Court 7', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_8', 'INDOOR', 'BD', 'Court 8', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_8', 'OUTDOOR', 'BD', 'Court 8', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_9', 'INDOOR', 'BD', 'Court 9', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);
INSERT INTO `venue` VALUES ('COURT_9', 'OUTDOOR', 'BD', 'Court 9', 10.00, 'active', 1, '2023-10-02 14:46:08', NULL, NULL);

-- ----------------------------
-- Table structure for venue_category
-- ----------------------------
DROP TABLE IF EXISTS `venue_category`;
CREATE TABLE `venue_category`  (
  `venue_category_id` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_by` tinyint NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_by` tinyint NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`venue_category_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of venue_category
-- ----------------------------
INSERT INTO `venue_category` VALUES ('INDOOR', 'Indoor', 'active', 1, '2023-10-02 14:45:01', NULL, NULL);
INSERT INTO `venue_category` VALUES ('OUTDOOR', 'Outdoor', 'active', 1, '2023-10-02 14:45:01', NULL, NULL);

-- ----------------------------
-- View structure for venue_available
-- ----------------------------
DROP VIEW IF EXISTS `venue_available`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `venue_available` AS select `venue_available`.`venue_id` AS `venue_id`,`venue_available`.`venue_name` AS `venue_name`,`venue_available`.`operation_hour_id` AS `operation_hour_id`,`venue_available`.`day_id` AS `day_id`,`venue_available`.`time` AS `time`,`venue_available`.`is_booked` AS `is_booked` from (select `venue`.`venue_id` AS `venue_id`,`venue`.`name` AS `venue_name`,`operation_hour`.`operation_hour_id` AS `operation_hour_id`,`operation_hour`.`day_id` AS `day_id`,`operation_hour`.`time` AS `time`,ifnull((select count(0) from `booking` where ((`booking`.`booking_date` = '2023-11-09') and (`booking`.`booking_time` = `operation_hour`.`time`) and (`booking`.`venue_id` = `venue`.`venue_id`))),0) AS `is_booked` from (`operation_hour` join `venue`) where (`operation_hour`.`status` = 'active')) `venue_available` where (`venue_available`.`is_booked` = 0);

SET FOREIGN_KEY_CHECKS = 1;
