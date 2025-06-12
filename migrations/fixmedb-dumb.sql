-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2025 at 05:55 AM
-- Server version: 8.1.0
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fixmedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin`
(
    `admin_id`        int                                     NOT NULL,
    `fname`           varchar(45) COLLATE utf8mb4_general_ci  NOT NULL,
    `lname`           varchar(45) COLLATE utf8mb4_general_ci  NOT NULL,
    `email`           varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
    `password`        varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `phone_no`        varchar(15) COLLATE utf8mb4_general_ci  NOT NULL,
    `address`         varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
    `profile_picture` varchar(255) COLLATE utf8mb4_general_ci          DEFAULT '/assets/user_avatar.png',
    `reg_date`        datetime                                NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `fname`, `lname`, `email`, `password`, `phone_no`, `address`, `profile_picture`,
                     `reg_date`)
VALUES (7, 'admin', 'mario', 'admin1@gmail.com', '$2y$10$NSdp7BvOyiWif54gDc3EF.eyabT1JD989q4IfRDOwlGlEBzXRwuu2',
        '0778533345', 'No.112, Katana, Negombo', '/assets/user_avatar.png', '2024-11-24 21:54:14');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments`
(
    `appointment_id`    int       NOT NULL,
    `customer_id`       int                                                                 DEFAULT NULL,
    `service_center_id` int                                                                 DEFAULT NULL,
    `vehicle_details`   varchar(255) COLLATE utf8mb4_general_ci                             DEFAULT NULL,
    `appointment_date`  date                                                                DEFAULT NULL,
    `appointment_time`  time                                                                DEFAULT NULL,
    `status`            enum ('pending','confirmed','cancelled') COLLATE utf8mb4_general_ci DEFAULT 'pending',
    `created_at`        timestamp NOT NULL                                                  DEFAULT CURRENT_TIMESTAMP,
    `otp`               varchar(10) COLLATE utf8mb4_general_ci                              DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `customer_id`, `service_center_id`, `vehicle_details`, `appointment_date`,
                            `appointment_time`, `status`, `created_at`, `otp`)
VALUES (2, 4, 3, '', '2025-04-15', '13:00:00', 'confirmed', '2025-04-14 17:57:25', NULL),
       (3, 4, 3, '', '2025-04-16', '10:00:00', 'cancelled', '2025-04-14 18:02:10', NULL),
       (5, 4, 1, 'another', '2025-04-24', '10:00:00', 'pending', '2025-04-15 13:18:45', NULL),
       (6, 2, 2, 'Toyota corolla', '2025-04-28', '11:30:00', 'confirmed', '2025-04-22 13:38:02', NULL),
       (7, 1, 2, 'Toyota corolla', '2025-04-29', '11:00:00', 'pending', '2025-04-24 11:47:21', NULL),
       (8, 5, 4, 'Engine repair, BMW', '2025-04-29', '14:30:00', 'confirmed', '2025-04-27 16:49:39', NULL),
       (9, 1, 3, 'Tire function failure', '2025-05-03', '13:00:00', 'pending', '2025-04-28 04:50:32', '445852'),
       (10, 1, 3, 'Tinkering', '2025-05-03', '13:30:00', 'pending', '2025-04-28 04:51:22', '891643'),
       (11, 1, 6, 'car engine repair', '2025-04-30', '14:00:00', 'pending', '2025-04-28 04:52:36', '407411'),
       (12, 1, 1, 'Brake oil change', '2025-05-02', '13:30:00', 'confirmed', '2025-04-28 06:57:40', NULL),
       (13, 5, 1, 'Engine repair, BMW', '2025-05-03', '14:30:00', 'confirmed', '2025-04-28 07:03:19', NULL),
       (14, 1, 1, 'Engine repair, BMW', '2025-04-29', '12:30:00', 'pending', '2025-04-28 09:07:12', '344387'),
       (15, 1, 4, 'Engine repair, BMW', '2025-05-31', '14:30:00', 'pending', '2025-05-29 07:27:55', '483758'),
       (16, 1, 4, 'Engine repair, BMW', '2025-05-31', '13:30:00', 'pending', '2025-05-29 07:47:29', '682530');

--
-- Triggers `appointments`
--
DELIMITER $$
CREATE TRIGGER `delete_otp_on_status_change`
    BEFORE UPDATE
    ON `appointments`
    FOR EACH ROW
BEGIN
    IF OLD.status = 'pending' AND NEW.status != 'pending' THEN
        SET NEW.otp = NULL; -- Set OTP to NULL
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart`
(
    `id`         int       NOT NULL,
    `user_id`    int       NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `created_at`, `updated_at`)
VALUES (2, 6, '2025-02-04 17:35:26', '2025-02-04 17:35:26'),
       (3, 4, '2025-02-04 18:27:05', '2025-02-04 18:27:05'),
       (6, 1, '2025-04-24 09:37:23', '2025-04-24 09:37:23'),
       (7, 5, '2025-04-27 16:53:36', '2025-04-27 16:53:36'),
       (8, 2, '2025-04-28 06:33:21', '2025-04-28 06:33:21');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items`
(
    `id`         int       NOT NULL,
    `cart_id`    int       NOT NULL,
    `product_id` int       NOT NULL,
    `quantity`   int                DEFAULT '1',
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `quantity`, `created_at`, `updated_at`)
VALUES (3, 3, 14, 3, '2025-02-04 18:27:05', '2025-02-04 19:17:49'),
       (4, 3, 15, 1, '2025-02-04 18:52:25', '2025-02-04 18:52:25'),
       (5, 3, 13, 1, '2025-02-04 19:18:48', '2025-02-04 19:18:48'),
       (6, 3, 10, 1, '2025-02-04 19:21:58', '2025-02-04 19:21:58'),
       (13, 2, 15, 1, '2025-02-05 10:23:48', '2025-02-05 10:23:48'),
       (18, 6, 6, 1, '2025-04-25 06:16:06', '2025-04-25 06:16:06'),
       (21, 6, 10, 1, '2025-04-28 06:31:59', '2025-04-28 06:31:59'),
       (23, 8, 6, 1, '2025-04-28 06:36:04', '2025-04-28 06:36:04'),
       (24, 7, 5, 1, '2025-04-28 07:04:29', '2025-04-28 07:04:29'),
       (25, 7, 10, 1, '2025-04-28 07:04:50', '2025-04-28 07:04:50'),
       (27, 6, 11, 1, '2025-05-29 07:47:01', '2025-05-29 07:47:01');

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages`
(
    `message_id`      int                             NOT NULL,
    `tech_id`         int                             NOT NULL,
    `cus_id`          int                             NOT NULL,
    `outgoing_msg_id` int                             NOT NULL,
    `incoming_msg_id` int                             NOT NULL,
    `message`         text COLLATE utf8mb4_general_ci NOT NULL,
    `timestamp`       timestamp                       NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`message_id`, `tech_id`, `cus_id`, `outgoing_msg_id`, `incoming_msg_id`, `message`,
                             `timestamp`)
VALUES (1, 14, 1, 1, 14, 'Hii travis scott i have an issue in my vehicle', '2025-03-15 03:54:54'),
       (2, 14, 1, 1, 14, 'Hey are you there', '2025-04-07 11:12:05'),
       (3, 4, 1, 1, 4, 'Hi Tom are you available', '2025-04-07 11:12:25'),
       (4, 5, 1, 1, 5, 'hello', '2025-04-17 08:47:34'),
       (5, 13, 1, 1, 13, 'hello', '2025-04-20 10:43:39'),
       (6, 14, 1, 1, 14, 'I have some ignition issue and i request you could you help me please ASAP',
        '2025-04-23 06:58:02'),
       (7, 5, 1, 5, 1, 'Hey do you need help', '2025-04-23 08:10:39'),
       (8, 5, 1, 5, 1, 'request me and pay the advance i\'ll come ASAP', '2025-04-23 08:11:11'),
       (9, 5, 1, 1, 5, 'hello', '2025-04-24 11:15:33'),
       (10, 4, 1, 1, 4, 'hii', '2025-04-27 16:23:22'),
       (11, 7, 5, 5, 7, 'Hello boss', '2025-04-27 17:04:09'),
       (12, 5, 1, 1, 5, 'hee', '2025-04-28 08:49:07'),
       (13, 5, 1, 1, 5, 'hii', '2025-05-29 07:26:57'),
       (14, 5, 1, 1, 5, 'there is an issue', '2025-05-29 07:27:03'),
       (15, 4, 1, 1, 4, 'hiii bro', '2025-05-29 07:43:04'),
       (16, 4, 1, 1, 4, 'i have some issues', '2025-05-29 07:43:11');

-- --------------------------------------------------------

--
-- Table structure for table `checkout_info`
--

CREATE TABLE `checkout_info`
(
    `id`          int                                     NOT NULL,
    `user_id`     int                                     NOT NULL,
    `email`       varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
    `phone`       varchar(20) COLLATE utf8mb4_general_ci  NOT NULL,
    `full_name`   varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
    `address`     varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `city`        varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
    `postal_code` varchar(20) COLLATE utf8mb4_general_ci  NOT NULL,
    `created_at`  timestamp                               NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `checkout_info`
--

INSERT INTO `checkout_info` (`id`, `user_id`, `email`, `phone`, `full_name`, `address`, `city`, `postal_code`,
                             `created_at`)
VALUES (2, 1, 'sheanemario7@gmail.com', '0778530369', 'Sheane Mario', 'No.111. Welihena. kochchikade', 'Negombo',
        '11534', '2025-04-26 06:56:13'),
       (3, 1, 'sheanemario7@gmail.com', '0778530369', 'Sheane Mario', 'No.111. Welihena. kochchikade', 'Negombo',
        '11534', '2025-04-26 15:21:30'),
       (4, 5, 'sheanemario7@gmail.com', '0778530369', 'Sheane Mario', 'No.111. Welihena. kochchikade', 'Negombo',
        '11534', '2025-04-27 16:55:56'),
       (5, 2, 'sheanemario7@gmail.com', '0778530369', 'Sheane Mario', 'No.111. Welihena. kochchikade', 'Negombo',
        '11534', '2025-04-28 06:39:16'),
       (6, 5, 'sheanemario7@gmail.com', '0778530369', 'Sheane Mario', 'No.111. Welihena. kochchikade', 'Negombo',
        '11534', '2025-04-28 07:04:59'),
       (7, 5, 'sheanemario7@gmail.com', '0778530369', 'Sheane Mario', 'No.111. Welihena. kochchikade', 'Negombo',
        '11534', '2025-04-28 07:14:14'),
       (8, 5, 'sheanemario7@gmail.com', '0778530369', 'Sheane Mario', 'No.111. Welihena. kochchikade', 'Negombo',
        '11534', '2025-04-28 07:16:34'),
       (9, 5, 'sheanemario7@gmail.com', '0778530369', 'Sheane Mario', 'No.111. Welihena. kochchikade', 'Negombo',
        '11534', '2025-04-28 07:34:44');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer`
(
    `cus_id`          int          NOT NULL,
    `fname`           varchar(45)  NOT NULL,
    `lname`           varchar(45)  NOT NULL,
    `email`           varchar(100) NOT NULL,
    `password`        varchar(255) NOT NULL,
    `phone_no`        varchar(15)  NOT NULL,
    `address`         varchar(200) NOT NULL,
    `profile_picture` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT '/assets/user_avatar.png',
    `reg_date`        datetime     NOT NULL                                         DEFAULT CURRENT_TIMESTAMP,
    `latitude`        decimal(10, 8)                                                DEFAULT NULL,
    `longitude`       decimal(11, 8)                                                DEFAULT NULL,
    `cart_id`         int                                                           DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb3;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_id`, `fname`, `lname`, `email`, `password`, `phone_no`, `address`, `profile_picture`,
                        `reg_date`, `latitude`, `longitude`, `cart_id`)
VALUES (1, 'Sheane', 'Mario', 'sheanemario7@gmail.com', '$2y$10$YNhRkMWFQs.9tB4t4qt/y.LVh2XZXzYenI3L04ltKtpYDyaal7URG',
        '0778530369', 'Negombo', '/uploads/profile-pictures/customer/profile_67f3a4e98c0791.88214400.jpg',
        '2024-11-07 00:10:49', 7.20552080, 79.85125620, 6),
       (2, 'Sheane', 'Mario', 'sheanemario77@gmail.com', '$2y$10$YEF7aixRV65CEM7M5ijvIuY/0VWngNcznx.5oy9pc2IFyL.KyQB7u',
        '0778530369', 'No.111. Welihena. kochchikade', '/assets/user_avatar.png', '2024-11-07 00:14:31', 7.23337770,
        79.86678480, 8),
       (3, 'Tommi', 'Polli', 'sheanemario777@gmail.com', '$2y$10$uUqrsG5Cv2sxhYcmGSgf6uNo0KD1ym1eL7528B.Lm.6U1Zub9M1/6',
        '0778530369', 'No.111. Welihena. kochchikade', '/assets/user_avatar.png', '2024-11-07 13:28:43', 7.23337770,
        79.86678480, NULL),
       (4, 'Devin', 'Goonawardena', 'customer1@gmail.com',
        '$2y$10$ZjDKrx1MWc9KBwwQDaxmbuoGkKXHdqdJceTvOjCdK3DcTwGq7D9ke', '0778530379',
        'No. 15, Gregory Lake Road, Nuwara Eliya',
        '/uploads/profile-pictures/customer/profile_67f3a47fc3e5e5.55717594.jpeg', '2024-11-14 12:44:35', 6.94971660,
        80.78910680, 3),
       (5, 'Damith', 'Bandara', 'customer2@gmail.com', '$2y$10$PJMdK7EA/MUb5sKt9HSpzeQo6ajkpbfPMwnE5r2qlZm8c1V0BBxNK',
        '0778530458', 'No. 7, Sooriyawewa Road,',
        '/uploads/profile-pictures/customer/profile_67f3a449bc95b2.55457714.jpeg', '2024-11-14 14:00:35', 6.31936420,
        81.00236300, 7),
       (6, 'Ravindu ', 'Peiris', 'customer3@gmail.com', '$2y$10$UFGnvLu4i0d46zRnjgD6jeSzpsRHG0VqAzi3nJyhA9yHbDWspYUNi',
        '0778989563', 'no.123.polonnaruwa', '/uploads/profile-pictures/customer/profile_67f3a4ab7eebc6.97582334.jpeg',
        '2025-04-07 12:05:39', 7.91470300, 81.00011830, 2);

-- --------------------------------------------------------

--
-- Table structure for table `cus_feedback_ser_cen`
--

CREATE TABLE `cus_feedback_ser_cen`
(
    `feedback_id` int           NOT NULL,
    `msg`         varchar(2000) NOT NULL,
    `cus_id`      int           NOT NULL,
    `ser_cen_id`  int           NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `cus_feedback_tech`
--

CREATE TABLE `cus_feedback_tech`
(
    `feedback_id` int           NOT NULL,
    `msg`         varchar(2000) NOT NULL,
    `cus_id`      int           NOT NULL,
    `tech_id`     int           NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `cus_payment_opt`
--

CREATE TABLE `cus_payment_opt`
(
    `cus_pay_opt_id` int         NOT NULL,
    `cus_id`         int         NOT NULL,
    `token`          varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
    `last_four`      varchar(45) NOT NULL,
    `card_type`      varchar(45) NOT NULL,
    `exp_date`       date        NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb3;

--
-- Dumping data for table `cus_payment_opt`
--

INSERT INTO `cus_payment_opt` (`cus_pay_opt_id`, `cus_id`, `token`, `last_four`, `card_type`, `exp_date`)
VALUES (5, 1, NULL, '5489', 'HNB', '2027-03-07'),
       (6, 1, NULL, '6321', 'BOC', '2027-04-03');

-- --------------------------------------------------------

--
-- Table structure for table `cus_ser_cen_req`
--

CREATE TABLE `cus_ser_cen_req`
(
    `req_id`     int         NOT NULL,
    `cus_id`     int         NOT NULL,
    `ser_cen_id` int         NOT NULL,
    `status`     varchar(45) NOT NULL,
    `date`       date        NOT NULL,
    `time`       time        NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `cus_tech_adv_payment`
--

CREATE TABLE `cus_tech_adv_payment`
(
    `pin`     int            NOT NULL,
    `cus_id`  int            NOT NULL,
    `tech_id` int            NOT NULL,
    `amount`  decimal(10, 2) NOT NULL,
    `time`    datetime       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `req_id`  int            NOT NULL,
    `done`    varchar(10)    NOT NULL DEFAULT 'false'
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb3;

--
-- Dumping data for table `cus_tech_adv_payment`
--

INSERT INTO `cus_tech_adv_payment` (`pin`, `cus_id`, `tech_id`, `amount`, `time`, `req_id`, `done`)
VALUES (6, 5, 3, 2740.50, '2025-04-13 19:19:09', 48, 'true'),
       (7, 2, 3, 16582.50, '2025-04-13 19:37:00', 49, 'true'),
       (8, 5, 11, 9950.00, '2025-04-13 20:40:38', 56, 'true'),
       (9, 3, 11, 11716.50, '2025-04-13 20:49:08', 58, 'true'),
       (12, 1, 15, 8853.00, '2025-04-14 11:05:32', 43, 'true'),
       (16, 1, 5, 857.00, '2025-04-21 10:23:25', 63, 'true'),
       (17, 1, 13, 9130.00, '2025-04-21 10:25:39', 62, 'true'),
       (18, 1, 4, 837.00, '2025-04-22 01:07:20', 44, 'true'),
       (19, 1, 14, 8485.50, '2025-04-23 12:29:54', 64, 'true'),
       (20, 5, 8, 5703.00, '2025-04-24 15:33:07', 31, 'true'),
       (21, 1, 14, 7208.00, '2025-04-24 17:13:04', 65, 'true'),
       (22, 3, 10, 2848.50, '2025-04-25 12:07:29', 68, 'true'),
       (23, 5, 7, 5133.50, '2025-04-27 22:03:54', 71, 'true'),
       (24, 2, 12, 4066.00, '2025-04-28 12:14:08', 72, 'true'),
       (25, 5, 12, 13476.50, '2025-04-28 12:21:13', 73, 'true'),
       (26, 1, 9, 2941.00, '2025-04-28 13:29:16', 75, 'false'),
       (27, 1, 16, 4794.00, '2025-04-28 14:24:15', 76, 'true'),
       (28, 1, 4, 867.00, '2025-05-29 12:32:47', 70, 'false'),
       (30, 1, 4, 867.00, '2025-05-29 13:14:07', 78, 'true');

-- --------------------------------------------------------

--
-- Table structure for table `cus_tech_contract`
--

CREATE TABLE `cus_tech_contract`
(
    `contract_id` int      NOT NULL,
    `cus_id`      int      NOT NULL,
    `tech_id`     int      NOT NULL,
    `start_time`  datetime NOT NULL                     DEFAULT CURRENT_TIMESTAMP,
    `end_time`    datetime                              DEFAULT NULL,
    `done`        varchar(10)                           DEFAULT 'false',
    `status`      enum ('pending','ongoing','finished') DEFAULT 'pending',
    `start_pin`   varchar(255)                          DEFAULT NULL,
    `finish_pin`  varchar(255)                          DEFAULT NULL,
    `req_id`      int                                   DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb3;

--
-- Dumping data for table `cus_tech_contract`
--

INSERT INTO `cus_tech_contract` (`contract_id`, `cus_id`, `tech_id`, `start_time`, `end_time`, `done`, `status`,
                                 `start_pin`, `finish_pin`, `req_id`)
VALUES (1, 1, 5, '2025-04-21 15:10:26', '2025-04-22 01:02:50', 'true', 'finished', '427834', '363141', 63),
       (2, 1, 13, '2025-04-22 00:56:16', '2025-04-22 01:02:50', 'true', 'finished', '167739', '900296', 62),
       (3, 1, 4, '2025-04-22 01:08:19', '2025-04-22 01:11:05', 'true', 'finished', '231007', '930298', 44),
       (4, 3, 11, '2025-04-22 01:29:50', '2025-04-22 01:34:11', 'true', 'finished', '412765', '828424', 58),
       (5, 5, 11, '2025-04-22 13:06:23', '2025-04-22 13:07:44', 'true', 'finished', '171482', '507695', 56),
       (6, 5, 3, '2025-04-22 16:14:31', '2025-04-22 16:16:01', 'true', 'finished', '153279', '858693', 48),
       (7, 2, 3, '2025-04-22 16:21:42', '2025-04-22 16:29:58', 'true', 'finished', '684671', '120725', 49),
       (8, 1, 14, '2025-04-23 12:32:16', '2025-04-24 17:10:13', 'true', 'finished', '743528', '394480', 64),
       (9, 5, 8, '2025-04-24 15:35:24', NULL, 'false', 'ongoing', '112548', NULL, 31),
       (10, 1, 14, '2025-04-24 17:14:30', '2025-04-25 12:40:28', 'true', 'finished', '275184', '983392', 65),
       (11, 3, 10, '2025-04-25 12:30:59', '2025-04-25 12:32:18', 'true', 'finished', '171106', '782017', 68),
       (12, 5, 7, '2025-04-27 22:04:34', '2025-04-27 22:08:15', 'true', 'finished', '617182', '393275', 71),
       (13, 2, 12, '2025-04-28 12:14:51', '2025-04-28 12:15:56', 'true', 'finished', '879363', '325475', 72),
       (14, 5, 12, '2025-04-28 12:22:11', '2025-04-28 12:23:01', 'true', 'finished', '450820', '221744', 73),
       (15, 1, 16, '2025-04-28 14:26:53', '2025-04-28 14:28:20', 'true', 'finished', '116796', '729722', 76),
       (16, 1, 4, '2025-05-29 13:14:45', '2025-05-29 13:15:41', 'true', 'finished', '434024', '205699', 78);

-- --------------------------------------------------------

--
-- Table structure for table `cus_tech_payment`
--

CREATE TABLE `cus_tech_payment`
(
    `cus_tech_pay_id` int            NOT NULL,
    `cus_id`          int            NOT NULL,
    `tech_id`         int            NOT NULL,
    `amount`          decimal(10, 2) NOT NULL,
    `date`            date           NOT NULL,
    `time`            time           NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `cus_tech_req`
--

CREATE TABLE `cus_tech_req`
(
    `req_id`  int          NOT NULL,
    `cus_id`  int          NOT NULL,
    `tech_id` int          NOT NULL,
    `status`  varchar(100) NOT NULL,
    `date`    datetime     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `time`    datetime     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb3;

--
-- Dumping data for table `cus_tech_req`
--

INSERT INTO `cus_tech_req` (`req_id`, `cus_id`, `tech_id`, `status`, `date`, `time`)
VALUES (30, 5, 3, 'Rejected', '2024-11-27 11:18:58', '2024-11-27 11:18:58'),
       (31, 5, 8, 'InProgress', '2024-11-27 11:19:30', '2024-11-27 11:19:30'),
       (35, 1, 4, 'Rejected', '2024-11-27 23:55:50', '2024-11-27 23:55:50'),
       (43, 1, 15, 'InProgress', '2025-04-13 00:45:04', '2025-04-13 00:45:04'),
       (44, 1, 4, 'completed', '2025-04-13 13:14:22', '2025-04-13 13:14:22'),
       (48, 5, 3, 'completed', '2025-04-13 19:18:50', '2025-04-13 19:18:50'),
       (49, 2, 3, 'completed', '2025-04-13 19:29:26', '2025-04-13 19:29:26'),
       (50, 2, 11, 'Rejected', '2025-04-13 19:38:45', '2025-04-13 19:38:45'),
       (56, 5, 11, 'completed', '2025-04-13 20:40:00', '2025-04-13 20:40:00'),
       (58, 3, 11, 'completed', '2025-04-13 20:43:08', '2025-04-13 20:43:08'),
       (62, 1, 13, 'completed', '2025-04-20 15:38:35', '2025-04-20 15:38:35'),
       (63, 1, 5, 'completed', '2025-04-20 16:15:14', '2025-04-20 16:15:14'),
       (64, 1, 14, 'completed', '2025-04-23 12:27:09', '2025-04-23 12:27:09'),
       (65, 1, 14, 'completed', '2025-04-24 15:13:21', '2025-04-24 15:13:21'),
       (68, 3, 10, 'completed', '2025-04-25 12:03:58', '2025-04-25 12:03:58'),
       (70, 1, 4, 'InProgress', '2025-04-27 21:53:09', '2025-04-27 21:53:09'),
       (71, 5, 7, 'completed', '2025-04-27 22:02:50', '2025-04-27 22:02:50'),
       (72, 2, 12, 'completed', '2025-04-28 12:11:08', '2025-04-28 12:11:08'),
       (73, 5, 12, 'completed', '2025-04-28 12:20:52', '2025-04-28 12:20:52'),
       (74, 1, 5, 'pending', '2025-04-28 13:27:25', '2025-04-28 13:27:25'),
       (75, 1, 9, 'InProgress', '2025-04-28 13:27:51', '2025-04-28 13:27:51'),
       (76, 1, 16, 'completed', '2025-04-28 14:19:29', '2025-04-28 14:19:29'),
       (78, 1, 4, 'completed', '2025-05-29 13:13:19', '2025-05-29 13:13:19');

-- --------------------------------------------------------

--
-- Table structure for table `cus_veh_issue`
--

CREATE TABLE `cus_veh_issue`
(
    `cus_veh_issue_id` int         NOT NULL,
    `cus_id`           int         NOT NULL,
    `vehicle_id`       int         NOT NULL,
    `issue_id`         int         NOT NULL,
    `is_urgent`        varchar(10) NOT NULL,
    `nearest_tech_c`   int         NOT NULL,
    `rating_c`         int         NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb3;

--
-- Dumping data for table `cus_veh_issue`
--

INSERT INTO `cus_veh_issue` (`cus_veh_issue_id`, `cus_id`, `vehicle_id`, `issue_id`, `is_urgent`, `nearest_tech_c`,
                             `rating_c`)
VALUES (1, 1, 2, 2, 'true', 1, 1),
       (2, 1, 2, 2, 'true', 1, 1),
       (3, 1, 2, 2, 'true', 1, 1),
       (4, 1, 3, 7, 'true', 3, 2),
       (5, 1, 3, 2, 'false', 3, 5),
       (6, 1, 2, 2, 'false', 3, 5),
       (7, 4, 3, 2, 'true', 3, 4),
       (8, 4, 3, 2, 'false', 1, 1),
       (9, 1, 4, 19, 'true', 5, 2),
       (10, 1, 6, 4, 'false', 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE `issue`
(
    `issue_id`   int          NOT NULL,
    `issue_type` varchar(500) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb3;

--
-- Dumping data for table `issue`
--

INSERT INTO `issue` (`issue_id`, `issue_type`)
VALUES (1, 'engine repair'),
       (2, 'transmission repair'),
       (3, 'brake systems'),
       (4, 'suspension and steering'),
       (5, 'air conditioning and heating'),
       (6, 'electrical systems'),
       (7, 'diagnostics'),
       (8, 'engine control unit programming'),
       (9, 'airbag systems'),
       (10, 'fuel injection'),
       (11, 'ignition systems'),
       (12, 'roadside assistance'),
       (13, 'mobile mechanic'),
       (14, 'vehicle inspection'),
       (15, 'custom modifications'),
       (16, 'battery replacement'),
       (17, 'alternator issues'),
       (18, 'cooling system repair'),
       (19, 'exhaust system'),
       (20, 'tire services'),
       (21, 'wheel alignment'),
       (22, 'software updates'),
       (23, 'ADAS calibration'),
       (24, 'emissions testing'),
       (25, 'clutch replacement'),
       (26, 'headlight/taillight repair'),
       (27, 'window and mirror repair'),
       (28, 'key programming'),
       (29, 'remote diagnostics'),
       (30, 'fleet maintenance');

-- --------------------------------------------------------

--
-- Table structure for table `marketplace_orders`
--

CREATE TABLE `marketplace_orders`
(
    `id`           int            NOT NULL,
    `order_id`     varchar(255)   NOT NULL,
    `customer_id`  int            NOT NULL,
    `total_amount` decimal(10, 2) NOT NULL,
    `status`       varchar(50)             DEFAULT 'pending',
    `paid_at`      datetime                DEFAULT NULL,
    `created_at`   timestamp      NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb3;

--
-- Dumping data for table `marketplace_orders`
--

INSERT INTO `marketplace_orders` (`id`, `order_id`, `customer_id`, `total_amount`, `status`, `paid_at`, `created_at`)
VALUES (1, '68091d2d6f665', 4, 50000.00, 'completed', '2025-04-23 17:03:01', '2025-04-23 11:33:01'),
       (2, '68091ea6ad5e7', 5, 43000.00, 'completed', '2025-04-23 17:09:13', '2025-04-23 11:39:13'),
       (3, '6809af27141e6', 5, 48000.00, 'completed', '2025-04-24 03:26:28', '2025-04-23 21:56:28'),
       (4, '6809dbce5a727', 5, 30000.00, 'completed', '2025-04-24 06:36:37', '2025-04-24 01:06:37'),
       (5, '680a0297b784e', 4, 10000.00, 'completed', '2025-04-24 09:22:06', '2025-04-24 03:52:06'),
       (6, '680a046c9264d', 4, 10000.00, 'completed', '2025-04-24 09:29:37', '2025-04-24 03:59:37'),
       (7, '680ba0886869a', 4, 10000.00, 'completed', '2025-04-25 14:48:01', '2025-04-25 09:18:01'),
       (8, '680bc581ae7d1', 4, 10000.00, 'completed', '2025-04-25 17:25:44', '2025-04-25 11:55:44'),
       (9, '680bc5c780351', 4, 10000.00, 'completed', '2025-04-25 17:26:47', '2025-04-25 11:56:47'),
       (10, '680bd3d9d8c7c', 4, 10000.00, 'completed', '2025-04-25 18:27:09', '2025-04-25 12:57:09'),
       (11, '680bd86db0a35', 4, 10000.00, 'completed', '2025-04-25 18:46:30', '2025-04-25 13:16:30'),
       (12, '680be6c5cf329', 4, 20000.00, 'completed', '2025-04-25 19:47:57', '2025-04-25 14:17:57'),
       (13, '680be74153493', 4, 30000.00, 'completed', '2025-04-25 19:49:36', '2025-04-25 14:19:36'),
       (14, '680f2f961f7fd', 5, 26200.00, 'completed', '2025-04-28 09:35:40', '2025-04-28 07:35:40');

-- --------------------------------------------------------

--
-- Table structure for table `marketplace_order_service_centers`
--

CREATE TABLE `marketplace_order_service_centers`
(
    `id`                int            NOT NULL,
    `order_id`          varchar(255)   NOT NULL,
    `service_center_id` int            NOT NULL,
    `sub_total`         decimal(10, 2) NOT NULL,
    `commission`        decimal(10, 2) NOT NULL,
    `seller_earning`    decimal(10, 2) NOT NULL,
    `created_at`        timestamp      NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb3;

--
-- Dumping data for table `marketplace_order_service_centers`
--

INSERT INTO `marketplace_order_service_centers` (`id`, `order_id`, `service_center_id`, `sub_total`, `commission`,
                                                 `seller_earning`, `created_at`)
VALUES (1, '68091d2d6f665', 2, 40000.00, 4000.00, 36000.00, '2025-04-23 17:03:01'),
       (2, '68091d2d6f665', 3, 10000.00, 1000.00, 9000.00, '2025-04-23 17:03:01'),
       (3, '68091ea6ad5e7', 4, 15000.00, 1500.00, 13500.00, '2025-04-23 17:09:13'),
       (4, '68091ea6ad5e7', 5, 28000.00, 2800.00, 25200.00, '2025-04-23 17:09:13'),
       (5, '680f2f961f7fd', 1, 26200.00, 2620.00, 23580.00, '2025-04-28 07:35:40');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media`
(
    `media_id`    int       NOT NULL,
    `post_id`     int       NOT NULL,
    `media_type`  varchar(255)   DEFAULT NULL,
    `media_url`   varchar(1000)  DEFAULT NULL,
    `uploaded_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications`
(
    `id`                int                             NOT NULL,
    `user_id`           int        DEFAULT NULL,
    `service_center_id` int        DEFAULT NULL,
    `message`           text COLLATE utf8mb4_general_ci NOT NULL,
    `is_read`           tinyint(1) DEFAULT '0',
    `created_at`        datetime   DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `service_center_id`, `message`, `is_read`, `created_at`)
VALUES (1, 4, 3, 'New appointment booked by customer with ID: 4and nameand phone no is on 2025-04-17 at 15:00', 1,
        '2025-04-16 12:57:59'),
       (2, 4, 3, 'New appointment booked by customer with ID: 4and name and phone no is  on 2025-04-16 at 14:00', 0,
        '2025-04-16 13:00:30'),
       (3, 4, 3,
        'New appointment booked by customer with ID: 4and name Devinand phone no is 0778530379 on 2025-04-18 at 12:00',
        0, '2025-04-16 13:10:10'),
       (4, 4, 3,
        'New appointment booked by customer with ID: 4 and name Devin and phone no is 0778530379 on 2025-04-18 at 14:00',
        0, '2025-04-16 18:44:50'),
       (5, 2, 2,
        'New appointment booked by customer with ID: 2 and name Sheane and phone no is 0778530369 on 2025-04-28 at 11:30',
        1, '2025-04-22 19:08:02'),
       (6, 1, 2,
        'New appointment booked by customer with ID: 1 and name Sheane and phone no is 0778530369 on 2025-04-29 at 11:00',
        0, '2025-04-24 17:17:21'),
       (7, 5, 4,
        'New appointment booked by customer with ID: 5 and name Damith. Phone: 0778530458. Date: 2025-04-29 at 14:30. OTP: 580227',
        0, '2025-04-27 22:19:39'),
       (8, 5, 4, 'appointment with ID: 8 has been updated to confirmed', 0, '2025-04-27 22:21:48'),
       (9, 1, 3,
        'New appointment booked by customer with ID: 1 and name Sheane. Phone: 0778530369. Date: 2025-05-03 at 13:00. OTP: 445852',
        0, '2025-04-28 10:20:32'),
       (10, 1, 3,
        'New appointment booked by customer with ID: 1 and name Sheane. Phone: 0778530369. Date: 2025-05-03 at 13:30. OTP: 891643',
        0, '2025-04-28 10:21:22'),
       (11, 1, 6,
        'New appointment booked by customer with ID: 1 and name Sheane. Phone: 0778530369. Date: 2025-04-30 at 14:00',
        0, '2025-04-28 10:22:36'),
       (12, NULL, 5, 'Service center details updated successfully', 0, '2025-04-28 11:01:25'),
       (13, NULL, 6, 'Service center details updated successfully', 0, '2025-04-28 11:08:37'),
       (14, NULL, 4, 'Service center details updated successfully', 0, '2025-04-28 11:22:21'),
       (15, NULL, 3, 'Service center details updated successfully', 0, '2025-04-28 11:43:34'),
       (16, NULL, 1, 'Service center details updated successfully', 0, '2025-04-28 11:46:10'),
       (17, 1, 1,
        'New appointment booked by customer with ID: 1 and name Sheane. Phone: 0778530369. Date: 2025-05-02 at 13:30',
        0, '2025-04-28 12:27:40'),
       (18, 1, 1, 'appointment with ID: 12 has been updated to confirmed', 0, '2025-04-28 12:28:29'),
       (19, 5, 1,
        'New appointment booked by customer with ID: 5 and name Damith. Phone: 0778530458. Date: 2025-05-03 at 14:30',
        0, '2025-04-28 12:33:19'),
       (20, 5, 1, 'appointment with ID: 13 has been updated to confirmed', 0, '2025-04-28 12:33:47'),
       (21, NULL, 1, 'New product created: Engine oil pack', 0, '2025-04-28 13:07:54'),
       (22, 1, 1,
        'New appointment booked by customer with ID: 1 and name Sheane. Phone: 0778530369. Date: 2025-04-29 at 12:30',
        0, '2025-04-28 14:37:12'),
       (23, 1, 4,
        'New appointment booked by customer with ID: 1 and name Sheane. Phone: 0778530369. Date: 2025-05-31 at 14:30',
        0, '2025-05-29 12:57:55'),
       (24, 1, 4,
        'New appointment booked by customer with ID: 1 and name Sheane. Phone: 0778530369. Date: 2025-05-31 at 13:30',
        0, '2025-05-29 13:17:29');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post`
(
    `post_id`     int      NOT NULL,
    `tech_id`     int      NOT NULL,
    `description` varchar(1000)     DEFAULT NULL,
    `media`       varchar(255)      DEFAULT NULL,
    `created_at`  datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`  datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb3;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `tech_id`, `description`, `media`, `created_at`, `updated_at`)
VALUES (1, 6, 'I completed a request on Colombo ', 'section-3-image.webp', '2024-11-25 09:58:45',
        '2024-11-25 09:58:45'),
       (2, 6, 'I create a buldozer', 'faq-section-image.jpg', '2024-11-25 10:00:28', '2024-11-25 10:00:28'),
       (3, 10, 'today at kandy', 'post1.jpg', '2024-11-29 09:54:53', '2024-11-29 09:54:53'),
       (4, 11, 'Today at kurunagala', 'post4.jpg', '2024-11-29 09:56:10', '2024-11-29 09:56:10'),
       (5, 8, 'today at hambantota', 'post3.jpg', '2024-11-29 09:57:30', '2024-11-29 09:57:30'),
       (6, 6, 'Interim post', 'post2.jpg', '2024-11-29 10:55:47', '2024-11-29 10:55:47');

-- --------------------------------------------------------

--
-- Table structure for table `post_comment`
--

CREATE TABLE `post_comment`
(
    `comment_id`   int           NOT NULL,
    `post_id`      int           NOT NULL,
    `cus_id`       int           NOT NULL,
    `comment_text` varchar(1000) NOT NULL,
    `created_at`   timestamp     NULL DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `post_like`
--

CREATE TABLE `post_like`
(
    `like_id`  int       NOT NULL,
    `post_id`  int       NOT NULL,
    `cus_id`   int       NOT NULL,
    `liked_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb3;

--
-- Dumping data for table `post_like`
--

INSERT INTO `post_like` (`like_id`, `post_id`, `cus_id`, `liked_at`)
VALUES (2, 1, 1, NULL),
       (3, 4, 1, NULL),
       (4, 6, 1, NULL),
       (5, 6, 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product`
(
    `product_id`    int      NOT NULL,
    `ser_cen_id`    int      NOT NULL,
    `description`   varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `price`         decimal(10, 2)                           DEFAULT NULL,
    `media`         varchar(255) COLLATE utf8mb4_general_ci  DEFAULT NULL,
    `created_at`    datetime NOT NULL                        DEFAULT CURRENT_TIMESTAMP,
    `updated_at`    datetime NOT NULL                        DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `product_count` int                                      DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `ser_cen_id`, `description`, `price`, `media`, `created_at`, `updated_at`,
                       `product_count`)
VALUES (5, 1, 'Hydraulic Jack', 1200.00, 'jack.jpeg', '2024-11-28 16:16:20', '2024-11-28 16:16:20', NULL),
       (6, 2, 'Toolkit', 10000.00, 'toolkit.jpg', '2024-11-29 09:58:30', '2024-11-29 09:58:30', NULL),
       (7, 4, 'Car wing', 15000.00, 'product2.jpg', '2024-11-29 10:00:46', '2024-11-29 10:00:46', NULL),
       (8, 5, 'Car Bonet', 28000.00, 'product3.jpg', '2024-11-29 10:01:39', '2024-11-29 10:01:39', NULL),
       (9, 2, 'Car Body', 40000.00, 'product4.jpg', '2024-11-29 10:03:02', '2024-11-29 10:03:02', NULL),
       (10, 1, 'Spare Wheel', 25000.00, 'product5.jpg', '2024-11-29 10:04:21', '2024-11-29 10:04:21', NULL),
       (11, 2, 'engine ', 645454.00, 'engine.jpg', '2024-11-29 10:58:31', '2024-11-29 10:58:31', NULL),
       (12, 3, 'BMW shock absorber', 25000.00, 'shock_absorber.jpeg', '2025-04-23 11:19:46', '2025-04-23 11:19:46',
        NULL),
       (13, 1, 'Engine oil pack', 5000.00, 'brake_oil.jpg', '2025-04-28 13:07:54', '2025-04-28 13:07:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion`
(
    `promotion_id` int      NOT NULL,
    `admin_id`     int      NOT NULL,
    `description`  varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `price`        decimal(10, 2)                           DEFAULT NULL,
    `media`        varchar(255) COLLATE utf8mb4_general_ci  DEFAULT NULL,
    `created_at`   datetime NOT NULL                        DEFAULT CURRENT_TIMESTAMP,
    `updated_at`   datetime NOT NULL                        DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`promotion_id`, `admin_id`, `description`, `price`, `media`, `created_at`, `updated_at`)
VALUES (11, 7, 'Sampath  Credit Card', 50.00, NULL, '2024-11-28 00:00:00', '2024-11-30 00:00:00'),
       (12, 7, 'technican service above 50', 50.00, NULL, '2024-11-30 00:00:00', '2024-12-06 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `service_center`
--

CREATE TABLE `service_center`
(
    `ser_cen_id`       int          NOT NULL,
    `name`             varchar(45)  NOT NULL,
    `address`          varchar(200) NOT NULL,
    `phone_no`         varchar(15)  NOT NULL,
    `email`            varchar(100) NOT NULL,
    `password`         varchar(255) NOT NULL,
    `reg_date`         datetime       DEFAULT CURRENT_TIMESTAMP,
    `service_category` varchar(50)    DEFAULT NULL,
    `longitude`        decimal(10, 8) DEFAULT NULL,
    `latitude`         decimal(10, 8) DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb3;

--
-- Dumping data for table `service_center`
--

INSERT INTO `service_center` (`ser_cen_id`, `name`, `address`, `phone_no`, `email`, `password`, `reg_date`,
                              `service_category`, `longitude`, `latitude`)
VALUES (1, 'centre1', '​No. 45, New Kandy Road ​Weliweriya', '0778530369', 'centre1@gmail.com',
        '$2y$10$mp5w1W0FYwc9RCJJU73/auJihdTEhXLFRNsmBqPDY180mqVpTFePe', '2024-11-13 21:31:35', '', 80.02731200,
        7.03337670),
       (2, 'centre2', 'No. 10, Galle Road, Colombo 03', '0718007172', 'centre2@gmail.com',
        '$2y$10$.kPnnUAQYJbWYH9zvA/7Ru1PtNVOK4bCw.sOz0CnS3T8cyIkAaEqu', '2024-11-13 23:17:03', '', 79.85342360,
        6.89944750),
       (3, 'centre3', '​No. 123, Hendala Road, Wattala', '0718007173', 'centre3@gmail.com',
        '$2y$10$bRKn5A..rgdx6RuY95tZWOqMDN2eyRPqy2RJIyH/GvrYAl4Cxg4EO', '2024-11-13 23:17:56', '', 79.87884030,
        6.99453740),
       (4, 'centre4', 'No. 45, Hospital Road, Ragama', '0718107173', 'centre4@gmail.com',
        '$2y$10$MwdW1w/KHp0tClBxRgGYPuJfhLVJG22AqpwDGsqerxtz5WpAIfwCe', '2024-11-13 23:18:38', '', 79.92300000,
        7.02800370),
       (5, 'centre5', 'No. 12, Old Kottawa Road, Maharagama, Colombo', '0778107173', 'centre5@gmail.com',
        '$2y$10$nOUt9.cFSF7IghfeG7NcTulctReyyuu5nybypsRwoGp8hDkuBhmta', '2024-11-13 23:19:29', '', 79.91941780,
        6.85234700),
       (6, 'centre6', 'No. 78, Dutugemunu Street, Maharagama, Colombo', '0778564354', 'centre6@gmail.com',
        '$2y$10$hjyHQIIlYu/ZexD.UV.YRehOw5SteIlTXZfJX6jhVA1bRH.4qIGbC', '2024-11-29 10:12:45', '', 79.87580870,
        6.87146440);

-- --------------------------------------------------------

--
-- Table structure for table `service_center_services`
--

CREATE TABLE `service_center_services`
(
    `id`         int                                     NOT NULL,
    `ser_cen_id` int                                     NOT NULL,
    `name`       varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `created_at` timestamp                               NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `service_center_services`
--

INSERT INTO `service_center_services` (`id`, `ser_cen_id`, `name`, `created_at`)
VALUES (1, 1, 'Engine repair', '2025-04-27 09:23:06'),
       (2, 1, 'Wheel alignment', '2025-04-27 09:23:26'),
       (3, 1, 'Body painting', '2025-04-27 09:24:02'),
       (4, 4, 'fuel failure repair', '2025-04-27 13:29:50'),
       (5, 4, 'Air conditioning', '2025-04-27 13:29:59'),
       (6, 4, 'Body painting', '2025-04-27 13:30:10');

-- --------------------------------------------------------

--
-- Table structure for table `ser_cen_payment_opt`
--

CREATE TABLE `ser_cen_payment_opt`
(
    `ser_cen_pay_opt_id` int          NOT NULL,
    `ser_cen_id`         int          NOT NULL,
    `token`              varchar(255) NOT NULL,
    `last_four`          varchar(45)  NOT NULL,
    `card_type`          varchar(45)  NOT NULL,
    `exp_date`           date         NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `ser_cen_reviews`
--

CREATE TABLE `ser_cen_reviews`
(
    `review_id`   int          NOT NULL,
    `cus_id`      int          NOT NULL,
    `ser_cen_id`  int          NOT NULL,
    `user_name`   varchar(200) NOT NULL,
    `user_rating` int          NOT NULL,
    `user_review` text         NOT NULL,
    `datetime`    timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Dumping data for table `ser_cen_reviews`
--

INSERT INTO `ser_cen_reviews` (`review_id`, `cus_id`, `ser_cen_id`, `user_name`, `user_rating`, `user_review`,
                               `datetime`)
VALUES (34, 1, 3, 'Sheane Mario', 4, 'Good service', '2025-04-28 04:48:48'),
       (35, 1, 1, 'Sheane Mario', 5, 'By far the best service center', '2025-04-28 06:56:05'),
       (36, 5, 1, 'Damith Bandara', 4, 'This place is awesome', '2025-04-28 07:02:59');

-- --------------------------------------------------------

--
-- Table structure for table `technician`
--

CREATE TABLE `technician`
(
    `tech_id`         int          NOT NULL,
    `fname`           varchar(45)  NOT NULL,
    `lname`           varchar(45)  NOT NULL,
    `email`           varchar(100) NOT NULL,
    `password`        varchar(255) NOT NULL,
    `phone_no`        varchar(15)  NOT NULL,
    `address`         varchar(200) NOT NULL,
    `profile_picture` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT '/assets/user_avatar.png',
    `reg_date`        datetime                                                      DEFAULT CURRENT_TIMESTAMP,
    `longitude`       decimal(10, 8)                                                DEFAULT NULL,
    `latitude`        decimal(11, 8)                                                DEFAULT NULL,
    `available`       varchar(10)  NOT NULL                                         DEFAULT 'true'
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb3;

--
-- Dumping data for table `technician`
--

INSERT INTO `technician` (`tech_id`, `fname`, `lname`, `email`, `password`, `phone_no`, `address`, `profile_picture`,
                          `reg_date`, `longitude`, `latitude`, `available`)
VALUES (3, 'Mario', 'Silva', 'sheanemario7@gmail.com', '$2y$10$4WKjp9WPKrVHhnyKB10cpu8XpYcP5THLymW2sHiUFfSYMZT7T0VSm',
        '0778530369', 'No. 17, Robert Gunawardena Mawatha, Battaramulla',
        '/uploads/profile-pictures/technician/profile_67f3b029df4070.27442314.jpg', '2024-11-10 16:26:34', 79.92393510,
        6.90390300, 'true'),
       (4, 'Tom', 'Kasun', 'sheanemario77@gmail.com', '$2y$10$HY04ceE9kOp2FuKCr/ovdet9Kkk2aAl3dMdaXD7qfY.7cdhCGMwea',
        '0778530369', 'No.111. Welihena. kochchikade',
        '/uploads/profile-pictures/technician/profile_67f3b0873e9b80.38991865.jpeg', '2024-11-10 16:27:59', 79.86678480,
        7.23337770, 'false'),
       (5, 'Nimal', 'Rathi', 'sheanemario777@gmail.com', '$2y$10$7jZJKYMp7mu1mhKo4L60Xuf840No1FQPpeImB6.3bOLRZ0oEKNJmO',
        '0778530369', 'No.111. Welihena. kochchikade',
        '/uploads/profile-pictures/technician/profile_67f3b0f6454bb4.22806055.jpeg', '2024-11-10 16:28:56', 79.86678480,
        7.23337770, 'true'),
       (6, 'kasun', 'obesiri', 'technician1@gmail.com', '$2y$10$Tx5NrwsOV968TwohtR1KmuqsRMf9L9p9zKu4lwdNmrVzfb/jnYDdu',
        '0778530368', 'No. 88, Hokandara Road, Athurugiriya',
        '/uploads/profile-pictures/technician/profile_680f2dabee62e9.62318116.jpg', '2024-11-13 23:21:15', 79.95961850,
        6.88039100, 'false'),
       (7, 'sandaruwan', 'priyalanka', 'technician2@gmail.com',
        '$2y$10$lf3G0ganubuHAF2skqxl5.XrP/YViakgDhVA/edBvpQjcJeuaKKFa', '0778537368',
        '123/4, Main Street, Kolonnawa, Colombo 08',
        '/uploads/profile-pictures/technician/profile_67f3af17490b58.32833227.jpeg', '2024-11-13 23:22:09', 79.85073350,
        6.93746590, 'true'),
       (8, 'Mohsin', 'Jutt', 'technician3@gmail.com', '$2y$10$OA.JwSY3WDpxjK.TtqqStuMwKMWEnpof3gq5PAtl9CypHorP37WZW',
        '0718107172', 'No. 45, Pahala Bope Road, Padukka',
        '/uploads/profile-pictures/technician/profile_67f3af81b96d18.97624221.jpeg', '2024-11-13 23:23:28', 80.10377210,
        6.84536340, 'true'),
       (9, 'Rajitha', 'Kulathunga', 'technician4@gmail.com',
        '$2y$10$V6xRe6g78whjOg6GDvTCtuSfppgHE0491BB3H1kwmlK7Au.VXIMVq', '0778107072',
        'No. 22, Thimbirigasyaya Road, Colombo 05',
        '/uploads/profile-pictures/technician/profile_67f3afb42ace82.69171288.jpeg', '2024-11-13 23:26:27', 79.87535330,
        6.89800830, 'true'),
       (10, 'Batiya', 'Alwis', 'technician5@gmail.com', '$2y$10$vHiAxMfYuFfS6mqls4WOzOfsqbAhffbNih1xNRXFJbHL1TQpgli/C',
        '0768107072', '12, Temple Road, Colombo 14',
        '/uploads/profile-pictures/technician/profile_67f3b14cd5cae3.01128388.jpeg', '2024-11-13 23:27:45', 79.87316690,
        6.94044780, 'true'),
       (11, 'Deepal', 'Rathnayaka', 'technician6@gmail.com',
        '$2y$10$lBmyH2lye1FCPXV0AJZ65eBgsg7qbXZrEEBMPywcRWJ/PjEy0BEH6', '0778830369', 'No. 212, Negombo Road, Ja-Ela',
        '/uploads/profile-pictures/technician/profile_67f3b1732cd091.93012888.jpeg', '2024-11-14 12:52:07', 79.89100430,
        7.08465940, 'true'),
       (12, 'Steven', 'Schapiro', 'stevenschapiro@gmail.com',
        '$2y$10$dCe/8uHl4Ap9vI6Xu/aLDu.6Cr0ukfcMyqwzAKDdMSR9UlRVZwo4y', '0718007172',
        'No. 123, Delgoda Road, Weliweriya', '/uploads/profile-pictures/technician/profile_680f248ca3b148.30079010.jpg',
        '2024-11-28 12:18:38', 80.07376130, 6.98850270, 'true'),
       (13, 'Mark', 'Rober', 'markrober@gmail.com', '$2y$10$PGJ8cJ9a3Tvk5ZFxJp2UaeHpTox3tsRrkKdbj.THoLeE/2JyRZocC',
        '0778530369', 'No. 45, New Kandy Road, Kaduwela',
        '/uploads/profile-pictures/technician/profile_67f3b265ef7413.75390539.jpeg', '2024-11-28 12:21:05', 79.97437940,
        6.92024650, 'true'),
       (14, 'Travis', 'Scott', 'travisscott@gmail.com', '$2y$10$007z9qALXAmCBWUAogvrneXos/9vSrypjzwyERxVQLctIG1w8T/XO',
        '0718007172', 'No. 112, Makola Road, Kiribathgoda',
        '/uploads/profile-pictures/technician/profile_680f2cb343a5e7.18438663.jpg', '2024-11-28 12:22:56', 79.93014810,
        6.97723600, 'true'),
       (15, 'Pulasthi ', 'Abishek', 'technician7@gmail.com',
        '$2y$10$dB7/UmgqHWBwPM12rXjo3uTfv7IKcyOJg5usjUu8N7OG5bMzM0k/i', '0743383502',
        'No. 45, Colombo Road, Nittambuwa, Gampaha District', '/assets/user_avatar.png', '2024-11-29 10:08:57',
        80.00656990, 7.08823640, 'true'),
       (16, 'Kasun', 'Mendis', 'kasunmendis@gmail.com', '$2y$10$6sSQH1LKV4V8MbeY3QJ9eOzxSCmTUyOQzFrXj1pcQQw6wFVr.iU5a',
        '0710154855', 'No.462/48, Malamulla, Panadura',
        '/uploads/profile-pictures/technician/profile_680f0baec0f603.31980422.jpg', '2025-04-28 10:29:25', 79.91873460,
        6.72081360, 'true');

-- --------------------------------------------------------

--
-- Table structure for table `technician_reviews`
--

CREATE TABLE `technician_reviews`
(
    `review_id`   int          NOT NULL,
    `cus_id`      int          NOT NULL,
    `tech_id`     int          NOT NULL,
    `user_name`   varchar(200) NOT NULL,
    `user_rating` int          NOT NULL,
    `user_review` text         NOT NULL,
    `datetime`    timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Dumping data for table `technician_reviews`
--

INSERT INTO `technician_reviews` (`review_id`, `cus_id`, `tech_id`, `user_name`, `user_rating`, `user_review`,
                                  `datetime`)
VALUES (33, 2, 3, 'Sheane Mario', 4, 'I had some failure in my engine and this guy was excellent in his work.',
        '2025-04-22 13:25:56'),
       (34, 1, 4, 'Sheane Mario', 3, 'This guy has some issues with communication, but overall the service was fine',
        '2025-04-23 13:53:18'),
       (35, 1, 5, 'Sheane Mario', 5,
        'I&#39;m very satisfied on his work. I had an issue in my vehicle&#39;s engine, outside of my home town, and I call him and requested him, and he came ASAP. Extremely satisfied with the work',
        '2025-04-23 13:56:16'),
       (36, 1, 14, 'Sheane Mario', 4, 'good', '2025-04-24 11:40:47'),
       (37, 1, 14, 'Sheane Mario', 2, 'Nice work', '2025-04-25 06:19:54'),
       (38, 3, 10, 'Tommi Polli', 4, 'Nice work and done patiently', '2025-04-25 07:02:51'),
       (39, 5, 7, 'Damith Bandara', 4, 'nice work', '2025-04-27 16:38:37'),
       (40, 2, 12, 'Sheane Mario', 4, 'Nice work brooo', '2025-04-28 06:46:13'),
       (41, 1, 16, 'Sheane Mario', 4, 'good', '2025-04-28 09:04:59'),
       (42, 1, 4, 'Sheane Mario', 5, 'This guy was awesome in his work', '2025-05-29 07:46:13');

-- --------------------------------------------------------

--
-- Table structure for table `tech_payment_opt`
--

CREATE TABLE `tech_payment_opt`
(
    `tech_pay_opt_id` int          NOT NULL,
    `tech_id`         int          NOT NULL,
    `last_four`       varchar(45)  NOT NULL,
    `bank_acc_num`    bigint       NOT NULL,
    `bank_acc_name`   varchar(255) NOT NULL,
    `bank_acc_branch` varchar(255) DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb3;

--
-- Dumping data for table `tech_payment_opt`
--

INSERT INTO `tech_payment_opt` (`tech_pay_opt_id`, `tech_id`, `last_four`, `bank_acc_num`, `bank_acc_name`,
                                `bank_acc_branch`)
VALUES (1, 3, '4523', 155020784523, 'HNB', 'Kochchikade'),
       (3, 5, '2245', 155090112245, 'HNB', 'Kochchikade'),
       (4, 10, '7876', 123445657876, 'boc', 'negombo'),
       (5, 8, '3435', 345698053435, 'seylan', 'colombo'),
       (6, 14, '4578', 1234578, 'ghgjh', 'sdsfd'),
       (7, 6, '7345', 1234678934567345, 'hnb', 'kottawa'),
       (8, 7, '3475', 1234090967893475, 'seylan', 'colombo'),
       (9, 12, '8787', 1212343456568787, 'hnb', 'negombo'),
       (10, 9, '1234', 1234123412341234, 'hnb', 'negombo'),
       (11, 16, '5626', 312644579895626, 'HNB', 'Panadura'),
       (12, 4, '1234', 1234123412341234, 'HNB', 'Negombo');

-- --------------------------------------------------------

--
-- Table structure for table `tech_spec_issue`
--

CREATE TABLE `tech_spec_issue`
(
    `tech_spec_issue_id` int NOT NULL,
    `tech_id`            int NOT NULL,
    `issue_id`           int NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb3;

--
-- Dumping data for table `tech_spec_issue`
--

INSERT INTO `tech_spec_issue` (`tech_spec_issue_id`, `tech_id`, `issue_id`)
VALUES (1, 10, 3),
       (2, 10, 5),
       (3, 10, 7),
       (4, 10, 8),
       (5, 14, 2),
       (6, 14, 3),
       (7, 14, 4),
       (8, 14, 5),
       (9, 14, 6),
       (10, 14, 9),
       (11, 14, 10),
       (12, 14, 11),
       (13, 5, 6),
       (14, 5, 7),
       (15, 5, 10),
       (16, 5, 16),
       (17, 5, 18),
       (18, 5, 20),
       (19, 6, 1),
       (20, 6, 2),
       (21, 6, 3),
       (22, 6, 5),
       (23, 6, 7),
       (24, 6, 8),
       (25, 6, 9),
       (26, 6, 11),
       (27, 6, 17),
       (28, 7, 1),
       (29, 7, 6),
       (30, 7, 9),
       (31, 7, 11),
       (32, 7, 19),
       (33, 7, 20),
       (34, 7, 21),
       (35, 7, 23),
       (36, 7, 25),
       (37, 3, 1),
       (38, 3, 2),
       (39, 3, 3),
       (40, 3, 5),
       (41, 3, 7),
       (42, 3, 9),
       (43, 3, 10),
       (44, 3, 11),
       (45, 3, 16),
       (46, 3, 20),
       (47, 3, 27),
       (48, 12, 1),
       (49, 12, 2),
       (50, 12, 3),
       (51, 12, 4),
       (52, 12, 5),
       (53, 12, 6),
       (54, 12, 7),
       (55, 12, 8),
       (56, 12, 9),
       (57, 12, 10),
       (58, 12, 11),
       (59, 12, 16),
       (60, 9, 3),
       (61, 9, 5),
       (62, 9, 6),
       (63, 9, 7),
       (64, 9, 16),
       (65, 9, 17),
       (66, 9, 18),
       (67, 16, 1),
       (68, 16, 2),
       (69, 16, 3),
       (70, 16, 4),
       (71, 16, 5),
       (72, 16, 6),
       (73, 16, 8),
       (74, 16, 21),
       (75, 4, 1),
       (76, 4, 2),
       (77, 4, 3),
       (78, 4, 4),
       (79, 4, 5),
       (80, 4, 6),
       (81, 4, 7);

-- --------------------------------------------------------

--
-- Table structure for table `tech_spec_veh`
--

CREATE TABLE `tech_spec_veh`
(
    `tech_spec_veh_id` int NOT NULL,
    `tech_id`          int NOT NULL,
    `vehicle_id`       int NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb3;

--
-- Dumping data for table `tech_spec_veh`
--

INSERT INTO `tech_spec_veh` (`tech_spec_veh_id`, `tech_id`, `vehicle_id`)
VALUES (1, 10, 1),
       (2, 10, 2),
       (3, 14, 1),
       (4, 14, 2),
       (5, 14, 3),
       (6, 5, 5),
       (7, 5, 6),
       (8, 6, 1),
       (9, 6, 2),
       (10, 6, 3),
       (11, 7, 7),
       (12, 7, 8),
       (13, 3, 1),
       (14, 3, 2),
       (15, 3, 3),
       (16, 3, 5),
       (17, 12, 1),
       (18, 12, 2),
       (19, 12, 3),
       (20, 12, 5),
       (21, 12, 6),
       (22, 9, 2),
       (23, 9, 3),
       (24, 9, 4),
       (25, 9, 5),
       (26, 16, 1),
       (27, 16, 2),
       (28, 16, 3),
       (29, 16, 5),
       (30, 16, 6),
       (31, 4, 1),
       (32, 4, 2),
       (33, 4, 4),
       (34, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle`
(
    `vehicle_id`   int          NOT NULL,
    `vehicle_type` varchar(100) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb3;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicle_id`, `vehicle_type`)
VALUES (1, 'petrol vehicles'),
       (2, 'diesel vehicles'),
       (3, 'hybrid vehicles'),
       (4, 'electric vehicles (EV)'),
       (5, 'motorcycles'),
       (6, 'three-wheelers (tuk-tuks)'),
       (7, 'buses'),
       (8, 'trucks'),
       (9, 'Car');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_issue`
--

CREATE TABLE `vehicle_issue`
(
    `vehicle_issue_id` int NOT NULL,
    `vehicle_id`       int NOT NULL,
    `issue_id`         int NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb3;

--
-- Dumping data for table `vehicle_issue`
--

INSERT INTO `vehicle_issue` (`vehicle_issue_id`, `vehicle_id`, `issue_id`)
VALUES (1, 1, 1),
       (2, 1, 2),
       (3, 1, 3),
       (4, 1, 4),
       (5, 1, 5),
       (6, 1, 6),
       (7, 1, 7),
       (8, 1, 8),
       (9, 1, 9),
       (10, 1, 10),
       (11, 1, 11),
       (12, 1, 16),
       (13, 1, 17),
       (14, 1, 18),
       (15, 1, 19),
       (16, 1, 20),
       (17, 1, 21),
       (18, 1, 22),
       (19, 1, 24),
       (20, 1, 26),
       (21, 2, 1),
       (22, 2, 2),
       (23, 2, 3),
       (24, 2, 4),
       (25, 2, 5),
       (26, 2, 6),
       (27, 2, 7),
       (28, 2, 8),
       (29, 2, 9),
       (30, 2, 10),
       (31, 2, 11),
       (32, 2, 16),
       (33, 2, 17),
       (34, 2, 18),
       (35, 2, 19),
       (36, 2, 20),
       (37, 2, 21),
       (38, 2, 22),
       (39, 2, 24),
       (40, 2, 26),
       (41, 3, 1),
       (42, 3, 2),
       (43, 3, 3),
       (44, 3, 4),
       (45, 3, 5),
       (46, 3, 6),
       (47, 3, 7),
       (48, 3, 8),
       (49, 3, 9),
       (50, 3, 10),
       (51, 3, 11),
       (52, 3, 16),
       (53, 3, 17),
       (54, 3, 18),
       (55, 3, 19),
       (56, 3, 20),
       (57, 3, 21),
       (58, 3, 22),
       (59, 3, 23),
       (60, 3, 24),
       (61, 3, 26),
       (62, 4, 3),
       (63, 4, 4),
       (64, 4, 5),
       (65, 4, 6),
       (66, 4, 7),
       (67, 4, 8),
       (68, 4, 9),
       (69, 4, 16),
       (70, 4, 17),
       (71, 4, 18),
       (72, 4, 19),
       (73, 4, 20),
       (74, 4, 21),
       (75, 4, 22),
       (76, 4, 23),
       (77, 4, 24),
       (78, 4, 26),
       (79, 4, 28),
       (80, 4, 29),
       (81, 5, 1),
       (82, 5, 3),
       (83, 5, 4),
       (84, 5, 6),
       (85, 5, 7),
       (86, 5, 10),
       (87, 5, 11),
       (88, 5, 16),
       (89, 5, 18),
       (90, 5, 20),
       (91, 5, 21),
       (92, 5, 26),
       (93, 5, 27),
       (94, 6, 1),
       (95, 6, 3),
       (96, 6, 4),
       (97, 6, 5),
       (98, 6, 6),
       (99, 6, 10),
       (100, 6, 11),
       (101, 6, 16),
       (102, 6, 18),
       (103, 6, 20),
       (104, 6, 21),
       (105, 6, 26),
       (106, 6, 27),
       (107, 7, 1),
       (108, 7, 2),
       (109, 7, 3),
       (110, 7, 4),
       (111, 7, 5),
       (112, 7, 6),
       (113, 7, 7),
       (114, 7, 8),
       (115, 7, 9),
       (116, 7, 10),
       (117, 7, 11),
       (118, 7, 16),
       (119, 7, 17),
       (120, 7, 18),
       (121, 7, 19),
       (122, 7, 20),
       (123, 7, 21),
       (124, 7, 22),
       (125, 7, 23),
       (126, 7, 24),
       (127, 7, 26),
       (128, 7, 30),
       (129, 8, 1),
       (130, 8, 2),
       (131, 8, 3),
       (132, 8, 4),
       (133, 8, 5),
       (134, 8, 6),
       (135, 8, 7),
       (136, 8, 8),
       (137, 8, 9),
       (138, 8, 10),
       (139, 8, 11),
       (140, 8, 16),
       (141, 8, 17),
       (142, 8, 18),
       (143, 8, 19),
       (144, 8, 20),
       (145, 8, 21),
       (146, 8, 22),
       (147, 8, 23),
       (148, 8, 24),
       (149, 8, 25),
       (150, 8, 30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
    ADD PRIMARY KEY (`admin_id`),
    ADD UNIQUE KEY `admin_id_UNIQUE` (`admin_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
    ADD PRIMARY KEY (`appointment_id`),
    ADD KEY `customer_id` (`customer_id`),
    ADD KEY `service_center_id` (`service_center_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
    ADD PRIMARY KEY (`id`),
    ADD KEY `cart_id` (`cart_id`),
    ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
    ADD PRIMARY KEY (`message_id`),
    ADD KEY `tech_id` (`tech_id`),
    ADD KEY `cus_id` (`cus_id`);

--
-- Indexes for table `checkout_info`
--
ALTER TABLE `checkout_info`
    ADD PRIMARY KEY (`id`),
    ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
    ADD PRIMARY KEY (`cus_id`),
    ADD UNIQUE KEY `cus_id_UNIQUE` (`cus_id`),
    ADD UNIQUE KEY `cart_id` (`cart_id`);

--
-- Indexes for table `cus_feedback_ser_cen`
--
ALTER TABLE `cus_feedback_ser_cen`
    ADD PRIMARY KEY (`feedback_id`),
    ADD KEY `cfcs_cus_id_idx` (`cus_id`),
    ADD KEY `cfsc_ser_cen_id_idx` (`ser_cen_id`);

--
-- Indexes for table `cus_feedback_tech`
--
ALTER TABLE `cus_feedback_tech`
    ADD PRIMARY KEY (`feedback_id`),
    ADD KEY `cft_cus_id_idx` (`cus_id`),
    ADD KEY `cft_tech_id_idx` (`tech_id`);

--
-- Indexes for table `cus_payment_opt`
--
ALTER TABLE `cus_payment_opt`
    ADD PRIMARY KEY (`cus_pay_opt_id`),
    ADD KEY `cus_id_idx` (`cus_id`);

--
-- Indexes for table `cus_ser_cen_req`
--
ALTER TABLE `cus_ser_cen_req`
    ADD PRIMARY KEY (`req_id`),
    ADD KEY `cscr_cus_id_idx` (`cus_id`),
    ADD KEY `cscr_ser_cen_id_idx` (`ser_cen_id`);

--
-- Indexes for table `cus_tech_adv_payment`
--
ALTER TABLE `cus_tech_adv_payment`
    ADD PRIMARY KEY (`pin`),
    ADD KEY `ctap_cus_id_idx` (`cus_id`),
    ADD KEY `ctap_tech_id_idx` (`tech_id`),
    ADD KEY `ctap_req_id_idx` (`req_id`);

--
-- Indexes for table `cus_tech_contract`
--
ALTER TABLE `cus_tech_contract`
    ADD PRIMARY KEY (`contract_id`),
    ADD KEY `cus_id` (`cus_id`),
    ADD KEY `tech_id` (`tech_id`),
    ADD KEY `fk_req_id` (`req_id`);

--
-- Indexes for table `cus_tech_payment`
--
ALTER TABLE `cus_tech_payment`
    ADD PRIMARY KEY (`cus_tech_pay_id`),
    ADD KEY `ctp_cus_id_idx` (`cus_id`),
    ADD KEY `ctp_tech_id_idx` (`tech_id`);

--
-- Indexes for table `cus_tech_req`
--
ALTER TABLE `cus_tech_req`
    ADD PRIMARY KEY (`req_id`),
    ADD KEY `ctr_cus_id_idx` (`cus_id`),
    ADD KEY `ctr_tech_id_idx` (`tech_id`);

--
-- Indexes for table `cus_veh_issue`
--
ALTER TABLE `cus_veh_issue`
    ADD PRIMARY KEY (`cus_veh_issue_id`),
    ADD KEY `fk_cus_id_is` (`cus_id`),
    ADD KEY `fk_veh_id_is` (`vehicle_id`),
    ADD KEY `fk_veh_issue_is` (`issue_id`);

--
-- Indexes for table `issue`
--
ALTER TABLE `issue`
    ADD PRIMARY KEY (`issue_id`);

--
-- Indexes for table `marketplace_orders`
--
ALTER TABLE `marketplace_orders`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `order_id` (`order_id`),
    ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `marketplace_order_service_centers`
--
ALTER TABLE `marketplace_order_service_centers`
    ADD PRIMARY KEY (`id`),
    ADD KEY `order_id` (`order_id`),
    ADD KEY `service_center_id` (`service_center_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
    ADD PRIMARY KEY (`media_id`),
    ADD KEY `m_post_id_idx` (`post_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
    ADD PRIMARY KEY (`id`),
    ADD KEY `fk_user` (`user_id`),
    ADD KEY `fk_service_center` (`service_center_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
    ADD PRIMARY KEY (`post_id`),
    ADD KEY `p_tech_id_idx` (`tech_id`);

--
-- Indexes for table `post_comment`
--
ALTER TABLE `post_comment`
    ADD PRIMARY KEY (`comment_id`),
    ADD KEY `pc_post_id_idx` (`post_id`),
    ADD KEY `pc_cus_id_idx` (`cus_id`);

--
-- Indexes for table `post_like`
--
ALTER TABLE `post_like`
    ADD PRIMARY KEY (`like_id`),
    ADD KEY `pl_post_id_idx` (`post_id`),
    ADD KEY `pl_cus_id_idx` (`cus_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
    ADD PRIMARY KEY (`product_id`),
    ADD KEY `p_ser_cen_id_idx` (`ser_cen_id`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
    ADD PRIMARY KEY (`promotion_id`),
    ADD KEY `p_admin_id_idx` (`admin_id`);

--
-- Indexes for table `service_center`
--
ALTER TABLE `service_center`
    ADD PRIMARY KEY (`ser_cen_id`),
    ADD UNIQUE KEY `ser_cen_id_UNIQUE` (`ser_cen_id`);

--
-- Indexes for table `service_center_services`
--
ALTER TABLE `service_center_services`
    ADD PRIMARY KEY (`id`),
    ADD KEY `ser_cen_id` (`ser_cen_id`);

--
-- Indexes for table `ser_cen_payment_opt`
--
ALTER TABLE `ser_cen_payment_opt`
    ADD PRIMARY KEY (`ser_cen_pay_opt_id`),
    ADD KEY `scpo_ser_cen_id_idx` (`ser_cen_id`);

--
-- Indexes for table `ser_cen_reviews`
--
ALTER TABLE `ser_cen_reviews`
    ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `technician`
--
ALTER TABLE `technician`
    ADD PRIMARY KEY (`tech_id`),
    ADD UNIQUE KEY `tech_id_UNIQUE` (`tech_id`);

--
-- Indexes for table `technician_reviews`
--
ALTER TABLE `technician_reviews`
    ADD PRIMARY KEY (`review_id`),
    ADD KEY `fk_tech_review_customer` (`cus_id`),
    ADD KEY `fk_tech_review_technician` (`tech_id`);

--
-- Indexes for table `tech_payment_opt`
--
ALTER TABLE `tech_payment_opt`
    ADD PRIMARY KEY (`tech_pay_opt_id`),
    ADD KEY `tech_id_idx` (`tech_id`);

--
-- Indexes for table `tech_spec_issue`
--
ALTER TABLE `tech_spec_issue`
    ADD PRIMARY KEY (`tech_spec_issue_id`),
    ADD KEY `tech_id_idx` (`tech_id`),
    ADD KEY `issue_id_idx` (`issue_id`);

--
-- Indexes for table `tech_spec_veh`
--
ALTER TABLE `tech_spec_veh`
    ADD PRIMARY KEY (`tech_spec_veh_id`),
    ADD KEY `tech_id_idx` (`tech_id`),
    ADD KEY `vehicle_id_idx` (`vehicle_id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
    ADD PRIMARY KEY (`vehicle_id`);

--
-- Indexes for table `vehicle_issue`
--
ALTER TABLE `vehicle_issue`
    ADD PRIMARY KEY (`vehicle_issue_id`),
    ADD KEY `vi_vehicle_type_id_idx` (`vehicle_id`),
    ADD KEY `vi_issue_id_idx` (`issue_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
    MODIFY `admin_id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 8;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
    MODIFY `appointment_id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 17;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
    MODIFY `id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 9;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
    MODIFY `id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 28;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
    MODIFY `message_id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 17;

--
-- AUTO_INCREMENT for table `checkout_info`
--
ALTER TABLE `checkout_info`
    MODIFY `id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 10;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
    MODIFY `cus_id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 7;

--
-- AUTO_INCREMENT for table `cus_feedback_ser_cen`
--
ALTER TABLE `cus_feedback_ser_cen`
    MODIFY `feedback_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cus_feedback_tech`
--
ALTER TABLE `cus_feedback_tech`
    MODIFY `feedback_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cus_payment_opt`
--
ALTER TABLE `cus_payment_opt`
    MODIFY `cus_pay_opt_id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 7;

--
-- AUTO_INCREMENT for table `cus_ser_cen_req`
--
ALTER TABLE `cus_ser_cen_req`
    MODIFY `req_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cus_tech_adv_payment`
--
ALTER TABLE `cus_tech_adv_payment`
    MODIFY `pin` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 31;

--
-- AUTO_INCREMENT for table `cus_tech_contract`
--
ALTER TABLE `cus_tech_contract`
    MODIFY `contract_id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 17;

--
-- AUTO_INCREMENT for table `cus_tech_payment`
--
ALTER TABLE `cus_tech_payment`
    MODIFY `cus_tech_pay_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cus_tech_req`
--
ALTER TABLE `cus_tech_req`
    MODIFY `req_id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 79;

--
-- AUTO_INCREMENT for table `cus_veh_issue`
--
ALTER TABLE `cus_veh_issue`
    MODIFY `cus_veh_issue_id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 11;

--
-- AUTO_INCREMENT for table `issue`
--
ALTER TABLE `issue`
    MODIFY `issue_id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 31;

--
-- AUTO_INCREMENT for table `marketplace_orders`
--
ALTER TABLE `marketplace_orders`
    MODIFY `id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 15;

--
-- AUTO_INCREMENT for table `marketplace_order_service_centers`
--
ALTER TABLE `marketplace_order_service_centers`
    MODIFY `id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 6;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
    MODIFY `media_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
    MODIFY `id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 25;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
    MODIFY `post_id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 7;

--
-- AUTO_INCREMENT for table `post_comment`
--
ALTER TABLE `post_comment`
    MODIFY `comment_id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 2;

--
-- AUTO_INCREMENT for table `post_like`
--
ALTER TABLE `post_like`
    MODIFY `like_id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
    MODIFY `product_id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 14;

--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
    MODIFY `promotion_id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 13;

--
-- AUTO_INCREMENT for table `service_center`
--
ALTER TABLE `service_center`
    MODIFY `ser_cen_id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 7;

--
-- AUTO_INCREMENT for table `service_center_services`
--
ALTER TABLE `service_center_services`
    MODIFY `id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 7;

--
-- AUTO_INCREMENT for table `ser_cen_payment_opt`
--
ALTER TABLE `ser_cen_payment_opt`
    MODIFY `ser_cen_pay_opt_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ser_cen_reviews`
--
ALTER TABLE `ser_cen_reviews`
    MODIFY `review_id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 37;

--
-- AUTO_INCREMENT for table `technician`
--
ALTER TABLE `technician`
    MODIFY `tech_id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 17;

--
-- AUTO_INCREMENT for table `technician_reviews`
--
ALTER TABLE `technician_reviews`
    MODIFY `review_id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 43;

--
-- AUTO_INCREMENT for table `tech_payment_opt`
--
ALTER TABLE `tech_payment_opt`
    MODIFY `tech_pay_opt_id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 13;

--
-- AUTO_INCREMENT for table `tech_spec_issue`
--
ALTER TABLE `tech_spec_issue`
    MODIFY `tech_spec_issue_id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 82;

--
-- AUTO_INCREMENT for table `tech_spec_veh`
--
ALTER TABLE `tech_spec_veh`
    MODIFY `tech_spec_veh_id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 35;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
    MODIFY `vehicle_id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 10;

--
-- AUTO_INCREMENT for table `vehicle_issue`
--
ALTER TABLE `vehicle_issue`
    MODIFY `vehicle_issue_id` int NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 151;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
    ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`cus_id`) ON DELETE CASCADE,
    ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`service_center_id`) REFERENCES `service_center` (`ser_cen_id`) ON DELETE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
    ADD CONSTRAINT `fk_cart_id` FOREIGN KEY (`user_id`) REFERENCES `customer` (`cus_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chat_messages`
--
ALTER TABLE `chat_messages`
    ADD CONSTRAINT `chat_messages_ibfk_1` FOREIGN KEY (`tech_id`) REFERENCES `technician` (`tech_id`) ON DELETE CASCADE,
    ADD CONSTRAINT `chat_messages_ibfk_2` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`) ON DELETE CASCADE;

--
-- Constraints for table `checkout_info`
--
ALTER TABLE `checkout_info`
    ADD CONSTRAINT `checkout_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`cus_id`) ON DELETE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
    ADD CONSTRAINT `fk_cart_id_c` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cus_feedback_ser_cen`
--
ALTER TABLE `cus_feedback_ser_cen`
    ADD CONSTRAINT `cfsc_cus_id` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `cfsc_ser_cen_id` FOREIGN KEY (`ser_cen_id`) REFERENCES `service_center` (`ser_cen_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cus_feedback_tech`
--
ALTER TABLE `cus_feedback_tech`
    ADD CONSTRAINT `cft_cus_id` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `cft_tech_id` FOREIGN KEY (`tech_id`) REFERENCES `technician` (`tech_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cus_payment_opt`
--
ALTER TABLE `cus_payment_opt`
    ADD CONSTRAINT `cus_id` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cus_ser_cen_req`
--
ALTER TABLE `cus_ser_cen_req`
    ADD CONSTRAINT `cscr_cus_id` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `cscr_ser_cen_id` FOREIGN KEY (`ser_cen_id`) REFERENCES `service_center` (`ser_cen_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cus_tech_adv_payment`
--
ALTER TABLE `cus_tech_adv_payment`
    ADD CONSTRAINT `ctap_cus_id` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `ctap_req_id` FOREIGN KEY (`req_id`) REFERENCES `cus_tech_req` (`req_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `ctap_tech_id` FOREIGN KEY (`tech_id`) REFERENCES `technician` (`tech_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cus_tech_contract`
--
ALTER TABLE `cus_tech_contract`
    ADD CONSTRAINT `cus_tech_contract_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`),
    ADD CONSTRAINT `cus_tech_contract_ibfk_2` FOREIGN KEY (`tech_id`) REFERENCES `technician` (`tech_id`),
    ADD CONSTRAINT `fk_req_id` FOREIGN KEY (`req_id`) REFERENCES `cus_tech_req` (`req_id`);

--
-- Constraints for table `cus_tech_payment`
--
ALTER TABLE `cus_tech_payment`
    ADD CONSTRAINT `ctp_cus_id` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `ctp_tech_id` FOREIGN KEY (`tech_id`) REFERENCES `technician` (`tech_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cus_tech_req`
--
ALTER TABLE `cus_tech_req`
    ADD CONSTRAINT `ctr_cus_id` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `ctr_tech_id` FOREIGN KEY (`tech_id`) REFERENCES `technician` (`tech_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cus_veh_issue`
--
ALTER TABLE `cus_veh_issue`
    ADD CONSTRAINT `fk_cus_id_is` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `fk_veh_id_is` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`vehicle_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `fk_veh_issue_is` FOREIGN KEY (`issue_id`) REFERENCES `issue` (`issue_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `marketplace_orders`
--
ALTER TABLE `marketplace_orders`
    ADD CONSTRAINT `marketplace_orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`cus_id`) ON DELETE CASCADE;

--
-- Constraints for table `marketplace_order_service_centers`
--
ALTER TABLE `marketplace_order_service_centers`
    ADD CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `marketplace_orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `fk_ser_cen_id_mosc` FOREIGN KEY (`service_center_id`) REFERENCES `service_center` (`ser_cen_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `media`
--
ALTER TABLE `media`
    ADD CONSTRAINT `m_post_id` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
    ADD CONSTRAINT `fk_service_center` FOREIGN KEY (`service_center_id`) REFERENCES `service_center` (`ser_cen_id`) ON DELETE CASCADE,
    ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `customer` (`cus_id`) ON DELETE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
    ADD CONSTRAINT `p_tech_id` FOREIGN KEY (`tech_id`) REFERENCES `technician` (`tech_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_comment`
--
ALTER TABLE `post_comment`
    ADD CONSTRAINT `pc_cus_id` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `pc_post_id` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_like`
--
ALTER TABLE `post_like`
    ADD CONSTRAINT `pl_cus_id` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `pl_post_id` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
    ADD CONSTRAINT `p_ser_cen_id` FOREIGN KEY (`ser_cen_id`) REFERENCES `service_center` (`ser_cen_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `promotion`
--
ALTER TABLE `promotion`
    ADD CONSTRAINT `p_admin_id` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_center_services`
--
ALTER TABLE `service_center_services`
    ADD CONSTRAINT `service_center_services_ibfk_1` FOREIGN KEY (`ser_cen_id`) REFERENCES `service_center` (`ser_cen_id`) ON DELETE CASCADE;

--
-- Constraints for table `ser_cen_payment_opt`
--
ALTER TABLE `ser_cen_payment_opt`
    ADD CONSTRAINT `scpo_ser_cen_id` FOREIGN KEY (`ser_cen_id`) REFERENCES `service_center` (`ser_cen_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `technician_reviews`
--
ALTER TABLE `technician_reviews`
    ADD CONSTRAINT `fk_tech_review_customer` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
    ADD CONSTRAINT `fk_tech_review_technician` FOREIGN KEY (`tech_id`) REFERENCES `technician` (`tech_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `tech_payment_opt`
--
ALTER TABLE `tech_payment_opt`
    ADD CONSTRAINT `tpo_tech_id` FOREIGN KEY (`tech_id`) REFERENCES `technician` (`tech_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tech_spec_issue`
--
ALTER TABLE `tech_spec_issue`
    ADD CONSTRAINT `fk_tech_spec_issue_issue_id` FOREIGN KEY (`issue_id`) REFERENCES `issue` (`issue_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `fk_tech_spec_issue_tech_id` FOREIGN KEY (`tech_id`) REFERENCES `technician` (`tech_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tech_spec_veh`
--
ALTER TABLE `tech_spec_veh`
    ADD CONSTRAINT `fk_tech_id` FOREIGN KEY (`tech_id`) REFERENCES `technician` (`tech_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `fk_vehicle_id` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`vehicle_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vehicle_issue`
--
ALTER TABLE `vehicle_issue`
    ADD CONSTRAINT `vi_issue_id` FOREIGN KEY (`issue_id`) REFERENCES `issue` (`issue_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `vi_vehicle_type_id` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`vehicle_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
