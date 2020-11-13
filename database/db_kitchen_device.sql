/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100414
 Source Host           : localhost:3306
 Source Schema         : db_kitchen_device

 Target Server Type    : MySQL
 Target Server Version : 100414
 File Encoding         : 65001

 Date: 13/11/2020 23:34:14
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for bill
-- ----------------------------
DROP TABLE IF EXISTS `bill`;
CREATE TABLE `bill`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_id` int(11) NULL DEFAULT NULL,
  `category_product_id` int(11) NULL DEFAULT NULL,
  `staff_id` int(11) NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `customer_id` int(11) NULL DEFAULT NULL,
  `exported` tinyint(1) NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `customer_id`(`customer_id`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  INDEX `product_id`(`product_id`) USING BTREE,
  INDEX `staff_id`(`staff_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of bill
-- ----------------------------
INSERT INTO `bill` VALUES (1, 'HD0001', NULL, NULL, 3, NULL, 1, 0, '2020-11-06 15:16:47', '2020-11-06 15:16:47', 3, NULL);
INSERT INTO `bill` VALUES (2, 'HD0002', NULL, NULL, 3, 'Giao buổi tối', 2, 1, '2020-11-06 15:25:14', '2020-11-06 15:37:22', 3, NULL);
INSERT INTO `bill` VALUES (3, 'HD0003', NULL, NULL, 4, 'Giao trong giờ hành chính', 3, 0, '2020-11-06 15:30:53', '2020-11-06 15:30:53', 4, NULL);

-- ----------------------------
-- Table structure for bill_detail
-- ----------------------------
DROP TABLE IF EXISTS `bill_detail`;
CREATE TABLE `bill_detail`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_id` int(11) NULL DEFAULT NULL,
  `product_id` int(11) NULL DEFAULT NULL,
  `category_product_id` int(11) NULL DEFAULT NULL,
  `amount` int(10) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `bill_id`(`bill_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of bill_detail
-- ----------------------------
INSERT INTO `bill_detail` VALUES (1, 1, 2, 1, 2, '2020-11-06 15:16:47', '2020-11-06 15:16:47', 3, 3);
INSERT INTO `bill_detail` VALUES (2, 1, 5, 3, 1, '2020-11-06 15:16:47', '2020-11-06 15:16:47', 3, 3);
INSERT INTO `bill_detail` VALUES (3, 2, 10, 5, 1, '2020-11-06 15:25:14', '2020-11-06 15:25:14', 3, 3);
INSERT INTO `bill_detail` VALUES (4, 3, 7, 4, 1, '2020-11-06 15:30:53', '2020-11-06 15:30:53', 4, 4);
INSERT INTO `bill_detail` VALUES (5, 3, 8, 4, 1, '2020-11-06 15:30:53', '2020-11-06 15:30:53', 4, 4);

-- ----------------------------
-- Table structure for category_product
-- ----------------------------
DROP TABLE IF EXISTS `category_product`;
CREATE TABLE `category_product`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `deleted_by` int(11) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of category_product
-- ----------------------------
INSERT INTO `category_product` VALUES (1, 'CSP0001', 'Bếp Gaz', 'Gaz mới', '2020-11-06 14:06:16', '2020-11-06 14:06:16', 3, NULL, NULL, NULL);
INSERT INTO `category_product` VALUES (2, 'CSP0002', 'Bếp điện - Bếp từ', NULL, '2020-11-06 14:10:08', '2020-11-06 14:10:08', 3, NULL, NULL, NULL);
INSERT INTO `category_product` VALUES (3, 'CSP0003', 'Lò vi sóng', NULL, '2020-11-06 14:10:21', '2020-11-06 14:10:21', 3, NULL, NULL, NULL);
INSERT INTO `category_product` VALUES (4, 'CSP0004', 'Đồ gia dụng', NULL, '2020-11-06 14:10:39', '2020-11-06 14:10:39', 3, NULL, NULL, NULL);
INSERT INTO `category_product` VALUES (5, 'CSP0005', 'Điện máy', 'test', '2020-11-06 14:10:54', '2020-11-06 14:18:46', 3, 3, NULL, NULL);
INSERT INTO `category_product` VALUES (6, 'CSP0006', 'Chậu rửa chén bát', NULL, '2020-11-06 14:11:10', '2020-11-06 14:11:10', 3, NULL, NULL, NULL);
INSERT INTO `category_product` VALUES (7, 'CSP0007', 'Máy hút mùi', NULL, '2020-11-06 14:11:28', '2020-11-06 14:11:28', 3, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sex` tinyint(1) NULL DEFAULT NULL,
  `birtday` date NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `deleted_by` int(11) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES (1, 'Nguyễn Văn Chung', 'Định Công - Hoàng Mai - Hà Nội', '036156752', 'chung@gmail.com', 1, '1985-06-02', '2020-11-06 15:01:00', '2020-11-06 15:12:13', 3, 3, NULL, NULL);
INSERT INTO `customer` VALUES (2, 'Vũ Thu Hoài', 'Đống Đa- Hà Nội', '036856963', 'hoabt@gmail.com', 2, '1993-03-05', '2020-11-06 15:13:00', '2020-11-06 15:13:00', 3, NULL, NULL, NULL);
INSERT INTO `customer` VALUES (3, 'Hoàng Văn Đại', 'Hà Đông - Hà Nội', '096568968', 'dai@gmail.com', 1, '1994-12-01', '2020-11-06 15:30:06', '2020-11-06 15:30:06', 4, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `supplier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Nhà cung cấp',
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `thumb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `deleted_by` int(11) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `category_id`(`category_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES (1, 'SP0001', 'Bếp gas Paloma', 1, '2150000', 'Việt Nam', 'BẾP GAS PALOMA PA-V72ER\r\nBếp 2 lò, đánh lửa magneto. \r\nĐầu đốt ECO BURNER - tiết kiệm gas và thời gian\r\nMặt bếp tráng men, màu đen\r\nKích thước: 690 (d) x 384 (r) x 136 (c) mm\r\nTổng lượng gas tiêu thụ: 0.43 kg/h\r\nĐầu đốt trái: 0.25 kg/h;\r\nĐầu đốt phải: 0.18 kg/h', 'images/SP0001.jpg', '2020-11-06 14:36:43', '2020-11-06 14:38:38', 3, 3, NULL, NULL);
INSERT INTO `product` VALUES (2, 'SP0002', 'Bếp gas Rinnai', 1, '3990000', 'Việt Nam', 'Bếp  gas dương Rinnai RJ-8600FE là sản phẩm bếp nhập khẩu nguyên chiếc từ Nhật Bản - chính hãng Rinnai. Để tìm hiểu kĩ hơn về chất lượng cũng như về kiểu dáng của sản phẩm này, Bếp Việt xin cung cấp tới các bạn những thông tin cụ thể nhất sau đây:\r\n\r\n- Sản', 'images/SP0002.jpg', '2020-11-06 14:39:35', '2020-11-06 14:39:54', 3, 3, NULL, NULL);
INSERT INTO `product` VALUES (3, 'SP0003', 'Bếp từ Canzy', 2, '4490000', 'PRC', 'Nếu bạn đang tìm kiếm một dòng bếp từ đôi giá rẻ thì sản phẩm bếp từ Canzy CZ-200SS là một lựa chọn rất đáng cân nhắc. Với thiết kế tinh tế, đẹp mắt, màu đen sang trọng cùng khả năng nấu nướng đáp ứng nhu cầu cơ bản trong gia đình, bếp đang có sẵn tại Bếp', 'images/SP0003.jpg', '2020-11-06 14:43:14', '2020-11-06 14:43:15', 3, NULL, NULL, NULL);
INSERT INTO `product` VALUES (4, 'SP0004', 'Bếp từ Rommelsbacher', 2, '4690000', 'Đức', NULL, 'images/SP0004.jpg', '2020-11-06 14:44:06', '2020-11-06 14:44:06', 3, NULL, NULL, NULL);
INSERT INTO `product` VALUES (5, 'SP0005', 'Lò vi sóng Cata FS 20 BK', 3, '3000000', 'Chính hãng Cata', 'Cata FS 20 BK phù hợp với gia đình từ 4-5 người.\r\n\r\nThời gian hẹn giờ lên tới 95 phút, thỏa mái làm công việc khác mà không lo thức ăn cháy hay hỏng.\r\n\r\nCông suất lò 1000W nấu nướng cực nhanh mà không bị mất dinh dưỡng của thực phẩm.', 'images/SP0005.jpg', '2020-11-06 14:45:17', '2020-11-06 14:45:17', 3, NULL, NULL, NULL);
INSERT INTO `product` VALUES (6, 'SP0006', 'Lò vi sóng Teka', 3, '1715000', 'Việt Nam', NULL, 'images/SP0006.png', '2020-11-06 14:46:08', '2020-11-06 15:26:39', 3, 3, NULL, NULL);
INSERT INTO `product` VALUES (7, 'SP0007', 'Bộ nồi Fivestar 5 món', 4, '1150000', 'Việt Nam', 'Thông số kỹ thuật:\r\n\r\nInox 3 lớp 403, dày 0.8mm. Đáy rời.\r\n\r\nTay cầm quai đũa\r\n\r\nMàu sắc: Gương bóng, nắp kính', 'images/SP0007.jpg', '2020-11-06 14:47:17', '2020-11-06 14:47:17', 3, NULL, NULL, NULL);
INSERT INTO `product` VALUES (8, 'SP0008', 'Chảo Ceramic Elo Bratpfanne', 4, '916000', 'Việt Nam', 'Chảo chống dính từ Ceramic Elo Bratpfanne là sản phẩm chảo chống dính được nhập khẩu nguyên chiếc từ Đức. Thuộc thương hiệu ELO cao cấp với hơn 70 năm kinh nghiệm, các sản phẩm nồi chảo, đồ gia dụng bếp của ELO nay đã có mặt ở nhiều quốc gia trên thế giới', 'images/SP0008.png', '2020-11-06 14:48:30', '2020-11-06 14:48:30', 3, NULL, NULL, NULL);
INSERT INTO `product` VALUES (9, 'SP0009', 'Tủ lạnh HF-M42S', 5, '3990000', 'PRC', 'Lắp độc lập\r\nTổng dung tích: 42 lít\r\nCửa toàn phần\r\nĐiều khiển điện tử\r\nHệ thống chiếu sáng bên trong với đèn LED\r\nKhông đóng tuyết bên trong\r\nHiệu điện thế:	220 - 240 V\r\nTần số:	50 - 60 Hz\r\nĐộ ồn:	38dB', 'images/SP0009.png', '2020-11-06 14:50:14', '2020-11-06 14:50:14', 3, NULL, NULL, NULL);
INSERT INTO `product` VALUES (10, 'SP0010', 'MÁY GIẶT SẤY HWD-F60A', 5, '21590000', 'Thổ Nhĩ Kì', 'Dung lượng giặt/ sấy: 9 kg/ 6 kg.\r\n16 chương trình giặt.\r\nCông nghệ giặt thông minh Active Jet.\r\nChế độ sấy không nhăn\r\nGiặt siêu tốc 12 phút\r\nMàn hình LCD với núm vặn điều khiển\r\nMức tiêu thụ điện:	Giặt: 0.9 kWh/lần, Sấy: 5.22 kWh/lần\r\nHiệu điện thế:	220-240V', 'images/SP0010.png', '2020-11-06 14:51:30', '2020-11-06 14:51:30', 3, NULL, NULL, NULL);
INSERT INTO `product` VALUES (11, 'SP0011', 'Chậu rửa bát Hafele', 6, '9300000', 'EU', '– Chất liệu: đá GRANTEC.\r\n– Thích hợp với vòi đá Hafele\r\n\r\nMã chậu\r\n\r\n570.35.430 màu Cream\r\n\r\n570.35.530 màu Xám\r\n\r\n570.35.330 màu Đen\r\n\r\n– Độ sâu bồn: 200 mm\r\n– Độ dày: 1.2mm.\r\n– Kích thước chậu: 550D x 430R mm.\r\n– Kích thước mỗi bồn: 490D x 370R mm.\r\n– Kích thước cắt', 'images/SP0011.png', '2020-11-06 14:52:34', '2020-11-06 14:52:34', 3, NULL, NULL, NULL);
INSERT INTO `product` VALUES (12, 'SP0012', 'Chậu rửa bát AMTS 10047', 6, '7200000', 'AMTS', 'Hãng sản xuất : AMTS\r\nDòng chậu rửa bát nhập khẩu cao cấp\r\nChậu rửa bát Inox cao cấp\r\nKích thước mặt : 1000 x 470 x 24 (mm)\r\nKích thước cắt đá: 980 x 450 (mm)\r\nChất liệu: Inox 304 chống bám cặn', 'images/SP0012.jpg', '2020-11-06 14:53:24', '2020-11-06 15:26:23', 3, 3, NULL, NULL);
INSERT INTO `product` VALUES (13, 'SP0013', 'Máy rửa chén bát Dann', 7, '15185000', 'Chính hãng Dann', 'Dung tích: 14 bộ chén đĩa. 3 tầng rửa.\r\nĐiều khiển bằng cảm ứng điện tử.\r\n6 chương trình rửa, 6 mức nhiệt độ rửa.\r\nMàn hình full chức năng.\r\nhẹn giờ 24 tiếng.\r\nChương trình rửa nhanh\r\nChương trình rửa ECO\r\nChương trình 3 trong 1 giúp tiết kiệm muối và chất trợ', 'images/SP0013.jpg', '2020-11-06 14:54:44', '2020-11-06 14:55:24', 3, 3, NULL, NULL);
INSERT INTO `product` VALUES (14, 'SP0014', 'Máy hút mùi Dann DA270B', 7, '2600000', 'PRC', 'Nếu quý khách đang chọn mua một mẫu máy hút mùi cổ điển chất lượng cao cho gia đình mình thì mẫu máy hút mùi Dann DA270B là sự lựa chọn không thể bỏ qua. Mẫu máy được thiết kế và lắp ráp bởi Dann Việt Nam đảm bảo độ bền cao, công suất hút lớn', 'images/SP0014.jpg', '2020-11-06 14:56:44', '2020-11-06 14:56:44', 3, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for staff
-- ----------------------------
DROP TABLE IF EXISTS `staff`;
CREATE TABLE `staff`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sex` tinyint(1) NULL DEFAULT NULL,
  `birtday` date NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `deleted_by` int(11) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of staff
-- ----------------------------
INSERT INTO `staff` VALUES (1, 'NV0001', 'Lê Văn Hải', 'Hà Nội', '012345678', 'hai@gmail.com', 1, '1990-06-19', '2020-11-02 20:44:54', '2020-11-02 20:45:00', 1, NULL, NULL, NULL);
INSERT INTO `staff` VALUES (2, 'NV0002', 'Hà Thị Thu', NULL, '0365557887', NULL, 2, '1992-05-13', '2020-11-06 13:47:05', '2020-11-06 13:49:16', 1, NULL, NULL, '2020-11-06 13:49:16');
INSERT INTO `staff` VALUES (3, 'NV0003', 'Đoàn Thị Trang', NULL, '034578965', NULL, 2, '1991-11-06', '2020-11-06 13:53:08', '2020-11-06 13:53:08', 1, NULL, NULL, NULL);
INSERT INTO `staff` VALUES (18, 'NV0004', 'Hoàng Thu Trang', NULL, '096855326', 'linhht@gmail.com', 2, '1993-03-02', '2020-11-06 13:58:51', '2020-11-06 13:58:51', 1, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_id` int(11) NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_by` int(11) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', 'admin@gmail.com', NULL, '$2y$12$ASwhiygzLF.lacwwZBm/deW.8iLf.2Du8SO0GtlwqgNUZVz36Jssi', 1, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (2, 'NV0002', NULL, NULL, '$2y$10$7L2Dn3gNR13KoaqTIuLGoOyeSJeJs7iC789YDKiWSAmuSJnJBoHFy', 2, NULL, '2020-11-06 13:47:05', '2020-11-06 13:49:16', NULL, '2020-11-06 13:49:16');
INSERT INTO `users` VALUES (3, 'NV0003', NULL, NULL, '$2y$10$mpOO2QmbSrxn5Xo4mwMdtu2saU79I4w7ShJifSmfAVM4nXmGz7IZC', 3, NULL, '2020-11-06 13:53:08', '2020-11-06 13:53:08', NULL, NULL);
INSERT INTO `users` VALUES (4, 'NV0004', 'linhht@gmail.com', NULL, '$2y$10$BPnuu1O.5j/Asy5G1m4HsuheepcyHZiv3BW4OhmRUwcKMwJMwq8AG', 18, NULL, '2020-11-06 13:58:51', '2020-11-06 13:58:51', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
