-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th9 17, 2024 lúc 10:57 PM
-- Phiên bản máy phục vụ: 10.6.18-MariaDB-cll-lve
-- Phiên bản PHP: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `tri06113_data`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hd_articles`
--

CREATE TABLE `hd_articles` (
  `ID_AR` int(11) NOT NULL,
  `ID_MODULE` varchar(255) DEFAULT NULL,
  `NAME_AR` varchar(255) DEFAULT NULL,
  `DESC_AR` longtext DEFAULT NULL,
  `CONTENT_AR` longtext DEFAULT NULL,
  `IMAGE_AR` longtext DEFAULT NULL,
  `GROUP_ID` int(11) DEFAULT NULL,
  `SORT_INDEX` int(11) DEFAULT NULL,
  `VISIBLE_AR` tinyint(1) DEFAULT NULL,
  `DATE_CREATED` datetime DEFAULT NULL,
  `USER_CREATED` varchar(255) DEFAULT NULL,
  `DATE_MODIFIED` datetime DEFAULT NULL,
  `USER_MODIFIED` varchar(255) DEFAULT NULL,
  `LANGUAGE` varchar(255) DEFAULT 'Vi-VN',
  `PRIORITY` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `hd_articles`
--

INSERT INTO `hd_articles` (`ID_AR`, `ID_MODULE`, `NAME_AR`, `DESC_AR`, `CONTENT_AR`, `IMAGE_AR`, `GROUP_ID`, `SORT_INDEX`, `VISIBLE_AR`, `DATE_CREATED`, `USER_CREATED`, `DATE_MODIFIED`, `USER_MODIFIED`, `LANGUAGE`, `PRIORITY`) VALUES
(1, 'tuyendung', 'Apollo 11 was the spaceflight that landed', 'Apollo 11 was the spaceflight that landed the first humans, Americans Neil Armstrong and Buzz Aldrin, on the Moon on July 20th, 1969, at 20:18 UTC. Armstrong became the first to step onto the lunar surface 6 hours later on July 21st at 02:56 UTC.', 'Apollo 11 was the spaceflight that landed the first humans, Americans Neil Armstrong and Buzz Aldrin, on the Moon on July 20th, 1969, at 20:18 UTC. Armstrong became the first to step onto the lunar surface 6 hours later on July 21st at 02:56 UTC.', 'imagesUpload/hoi-nghi-quan-triet-cac-van-ban-quy-pham-phap-luat-moi-ve-xay-dung20180930011951.png', NULL, 1, 1, '2024-09-14 00:05:17', 'duyhh', '2024-09-14 00:05:23', 'duyhh', 'Vi-VN', 1),
(2, 'gioithieu', 'Về Triều Tiến', 'Lời đầu tiên Lãnh đạo công ty Cổ phần Xây dựng Triều Tiến xin gửi lời chào trân trọng và lời cảm ơn tới quý khách hàng, đối tác đã đồng hành, hợp tác, ủng hộ\r\nCông ty trong thời gian qua.', '<p>Thương hiệu x&acirc;y dựng: C&ocirc;ng ty cổ phần x&acirc;y dựng Triều Tiến (Triều Tiến) đ&atilde; được th&agrave;nh lập bởi c&aacute;c th&agrave;nh vi&ecirc;n ưu t&uacute; nhất, c&oacute; năng lực chuy&ecirc;n m&ocirc;n cao v&agrave; bề d&agrave;y kinh nghiệm về thi c&ocirc;ng x&acirc;y dựng. Ch&uacute;ng t&ocirc;i đ&atilde; v&agrave; đang thi c&ocirc;ng nhiều c&aacute;c c&ocirc;ng tr&igrave;nh kh&aacute;ch sạn, văn ph&ograve;ng l&agrave;m việc, hạ tầng c&oacute; quy m&ocirc; lớn, đ&aacute;p ứng y&ecirc;u cầu cao về kỹ thuật, mỹ thuật, chất lượng của Chủ đầu tư. Một số c&ocirc;ng tr&igrave;nh điển h&igrave;nh như: Nh&agrave; cao tầng, nh&agrave; h&agrave;ng, kh&aacute;ch sạn, c&ocirc;ng tr&igrave;nh c&ocirc;ng cộng điển h&igrave;nh:</p>\r\n', 'imagesUpload/ve-trieu-tien20240915014510.jpg', NULL, 1, 1, '2024-09-14 00:05:17', 'duyhh', '2024-09-15 01:45:10', 'Duy Hoàng(justeendh)', 'Vi-VN', 1),
(3, 'dichvucongty', 'Thi công xây dựng', 'Dịch vụ xây nhà trọn gói của Triều Tiến sẽ giúp bạn giải quyết các vấn đề của 1 công trình xây dựng như thủ tục cấp phép, thiết kế, giám sát, thi công.', NULL, 'imagesUpload/xay-dung-120240915002537.jpg', NULL, 0, 1, '2024-09-14 00:05:17', 'duyhh', '2024-09-15 00:38:32', 'Duy Hoàng(justeendh)', 'Vi-VN', 1),
(4, 'dichvucongty', 'Tư vấn thiết', 'Xây một ngôi nhà – không chỉ là việc sắp xếp bố cục – màu sắc, mà là nghệ thuật tạo ra không gian sống & làm việc giúp con người ở trong không gian đó đạt đến sự bình an.', NULL, 'imagesUpload/tu-van-thiet20240915002731.jpg', NULL, 1, 1, '2024-09-14 00:05:17', 'duyhh', '2024-09-15 00:30:13', 'Duy Hoàng(justeendh)', 'Vi-VN', 1),
(5, 'dichvucongty', 'Giám sát công trình', 'Triều Tiến sẽ giải đáp cho bạn tầm quan trọng của việc giám sát thi công và dịch vụ tư vấn giám sát thi công chuyên nghiệp mà Triều Tiến đem lại cho khách hàng.', NULL, 'imagesUpload/giam-sat-cong-trinh20240915003429.jpg', NULL, 2, 1, '2024-09-14 00:05:17', 'duyhh', '2024-09-15 00:34:29', 'Duy Hoàng(justeendh)', 'Vi-VN', 1),
(7, 'tintuc', 'Apollo 11 was the spaceflight that landed', 'Apollo 11 was the spaceflight that landed the first humans, Americans Neil Armstrong and Buzz Aldrin, on the Moon on July 20th, 1969, at 20:18 UTC.', 'Apollo 11 was the spaceflight that landed the first humans, Americans Neil Armstrong and Buzz Aldrin, on the Moon on July 20th, 1969, at 20:18 UTC. Armstrong became the first to step onto the lunar surface 6 hours later on July 21st at 02:56 UTC.', 'imagesUpload/hoi-nghi-quan-triet-cac-van-ban-quy-pham-phap-luat-moi-ve-xay-dung20180930011951.png', NULL, 1, 1, '2024-09-14 00:05:17', 'duyhh', '2024-09-14 00:05:23', 'duyhh', 'Vi-VN', 1),
(8, 'tintuc', 'Apollo 11 was the spaceflight that landed', 'Apollo 11 was the spaceflight that landed the first humans, Americans Neil Armstrong and Buzz Aldrin, on the Moon on July 20th, 1969, at 20:18 UTC.', 'Apollo 11 was the spaceflight that landed the first humans, Americans Neil Armstrong and Buzz Aldrin, on the Moon on July 20th, 1969, at 20:18 UTC. Armstrong became the first to step onto the lunar surface 6 hours later on July 21st at 02:56 UTC.', 'imagesUpload/hoi-nghi-quan-triet-cac-van-ban-quy-pham-phap-luat-moi-ve-xay-dung20180930011951.png', NULL, 1, 1, '2024-09-14 00:05:17', 'duyhh', '2024-09-14 00:05:23', 'duyhh', 'Vi-VN', 1),
(9, 'tintuc', 'Apollo 11 was the spaceflight that landed', 'Apollo 11 was the spaceflight that landed the first humans, Americans Neil Armstrong and Buzz Aldrin, on the Moon on July 20th, 1969, at 20:18 UTC.', 'Apollo 11 was the spaceflight that landed the first humans, Americans Neil Armstrong and Buzz Aldrin, on the Moon on July 20th, 1969, at 20:18 UTC. Armstrong became the first to step onto the lunar surface 6 hours later on July 21st at 02:56 UTC.', 'imagesUpload/hoi-nghi-quan-triet-cac-van-ban-quy-pham-phap-luat-moi-ve-xay-dung20180930011951.png', NULL, 1, 1, '2024-09-14 00:05:17', 'duyhh', '2024-09-14 00:05:23', 'duyhh', 'Vi-VN', 1),
(10, 'tintuc', 'Apollo 11 was the spaceflight that landed', 'Apollo 11 was the spaceflight that landed the first humans, Americans Neil Armstrong and Buzz Aldrin, on the Moon on July 20th, 1969, at 20:18 UTC.', 'Apollo 11 was the spaceflight that landed the first humans, Americans Neil Armstrong and Buzz Aldrin, on the Moon on July 20th, 1969, at 20:18 UTC. Armstrong became the first to step onto the lunar surface 6 hours later on July 21st at 02:56 UTC.', 'imagesUpload/hoi-nghi-quan-triet-cac-van-ban-quy-pham-phap-luat-moi-ve-xay-dung20180930011951.png', NULL, 1, 1, '2024-09-14 00:05:17', 'duyhh', '2024-09-14 00:05:23', 'duyhh', 'Vi-VN', 1),
(11, 'dichvucongty', 'Construction', 'Trieu Tien\'s full-package house construction service will help you solve problems of a construction project such as licensing procedures, design, supervision, and construction.', NULL, 'imagesUpload/xay-dung-120240915002537.jpg', NULL, 0, 1, '2024-09-14 00:05:17', 'duyhh', '2024-09-15 00:38:32', 'Duy Hoàng(justeendh)', 'En-US', 1),
(12, 'dichvucongty', 'Design consulting', 'Building a house is not just about arranging the layout and colors, but the art of creating a living and working space that helps people in that space achieve peace.', NULL, 'imagesUpload/tu-van-thiet20240915002731.jpg', NULL, 1, 1, '2024-09-14 00:05:17', 'duyhh', '2024-09-15 00:30:13', 'Duy Hoàng(justeendh)', 'En-US', 1),
(13, 'dichvucongty', 'Construction supervision', 'Trieu Tien will explain to you the importance of construction supervision and the professional construction supervision consulting service that Trieu Tien brings to customers.', NULL, 'imagesUpload/giam-sat-cong-trinh20240915003429.jpg', NULL, 2, 1, '2024-09-14 00:05:17', 'duyhh', '2024-09-15 00:34:29', 'Duy Hoàng(justeendh)', 'En-US', 1),
(14, 'gioithieu', 'About us', 'First of all, the leaders of Trieu Tien Construction Joint Stock Company would like to send our sincere greetings and thanks to our customers and partners who have accompanied, cooperated and supported the Company in the past time.', '<p>Construction brand: Trieu Tien Construction Joint Stock Company (Trieu Tien) was established by the most elite members, with high professional capacity and extensive experience in construction. We have been constructing many large-scale hotels, offices, and infrastructure projects, meeting the high technical, aesthetic, and quality requirements of the Investor. Some typical projects such as: High-rise buildings, restaurants, hotels, typical public works:</p>\r\n', 'imagesUpload/about-us20240915014537.jpg', NULL, 0, 1, '2024-09-15 01:44:05', 'Duy Hoàng(justeendh)', '2024-09-15 01:45:37', 'Duy Hoàng(justeendh)', 'En-US', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hd_contacts`
--

CREATE TABLE `hd_contacts` (
  `ID` int(11) NOT NULL,
  `TITLE_CONTACT` varchar(255) DEFAULT NULL,
  `NAME_CONTACT` varchar(255) DEFAULT NULL,
  `STATUS_CONTACT` int(11) DEFAULT NULL,
  `DATE_CREATED` datetime DEFAULT NULL,
  `EMAIL_CONTACT` varchar(255) DEFAULT NULL,
  `PHONE_CONTACT` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hd_groups`
--

CREATE TABLE `hd_groups` (
  `ID_MODULE` varchar(255) DEFAULT NULL,
  `ID_GR` int(255) NOT NULL,
  `NAME_GR` varchar(255) DEFAULT NULL,
  `DESC_GR` longtext DEFAULT NULL,
  `SORT_INDEX` int(255) DEFAULT NULL,
  `VISIBLE_GR` tinyint(1) DEFAULT NULL,
  `LANGUAGE` varchar(255) DEFAULT 'Vi-VN'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `hd_groups`
--

INSERT INTO `hd_groups` (`ID_MODULE`, `ID_GR`, `NAME_GR`, `DESC_GR`, `SORT_INDEX`, `VISIBLE_GR`, `LANGUAGE`) VALUES
('duan', 1, 'NHÀ Ở GIA ĐÌNH', 'Dự án Nhà ở gia đình', 1, 1, 'Vi-VN'),
('duan', 2, 'KHÁCH SẠN & NGHỈ DƯỠNG', 'DỰ ÁN KHÁCH SẠN VÀ KHU NGHỈ DƯỠNG', 0, 1, 'Vi-VN'),
('duan', 4, 'KHU CÔNG NGHIỆP - NHÀ XƯỞNG', 'Dự án Khu công nghiệp - Nhà xưởng', 0, 1, 'Vi-VN'),
('duan', 5, 'THƯƠNG MẠI', 'Dự án văn phòng cho thuê, dịch vụ lưu trú', 0, 1, 'Vi-VN'),
('duan', 7, 'HOTEL & RESORTS', '', 0, 1, 'En-US'),
('duan', 10, 'INDUSTRIAL PARK - FACTORY', '', 0, 1, 'En-US');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hd_images`
--

CREATE TABLE `hd_images` (
  `ID` int(11) NOT NULL,
  `ID_MODULE` varchar(255) DEFAULT NULL,
  `NAME_IMG` varchar(255) DEFAULT NULL,
  `REF_ID` varchar(255) DEFAULT NULL,
  `IMAGE_URL` longtext DEFAULT NULL,
  `GROUP_ID` int(11) DEFAULT NULL,
  `URL_LINK_IMG` longtext DEFAULT NULL,
  `VISIBLE_IMG` tinyint(1) DEFAULT NULL,
  `SORT_INDEX` int(11) DEFAULT NULL,
  `INFO_1` longtext DEFAULT NULL,
  `INFO_2` longtext DEFAULT NULL,
  `INFO_3` longtext DEFAULT NULL,
  `DATE_CREATED` datetime DEFAULT NULL,
  `USER_CREATED` varchar(255) DEFAULT NULL,
  `DATE_MODIFIED` datetime DEFAULT NULL,
  `USER_MODIFIED` varchar(255) DEFAULT NULL,
  `LANGUAGE` varchar(255) DEFAULT 'Vi-VN'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `hd_images`
--

INSERT INTO `hd_images` (`ID`, `ID_MODULE`, `NAME_IMG`, `REF_ID`, `IMAGE_URL`, `GROUP_ID`, `URL_LINK_IMG`, `VISIBLE_IMG`, `SORT_INDEX`, `INFO_1`, `INFO_2`, `INFO_3`, `DATE_CREATED`, `USER_CREATED`, `DATE_MODIFIED`, `USER_MODIFIED`, `LANGUAGE`) VALUES
(1, 'doitac', 'Triều Tiến', NULL, 'data:image/png;base64,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', NULL, NULL, 1, 1, NULL, NULL, NULL, '2024-09-13 23:56:40', 'duyhh', '2024-09-13 23:56:36', 'duyhh', 'Vi-VN'),
(2, 'doitac', 'Example 01', NULL, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS02IIAXAaq_wWb6WLLLzKfXiFMrhbloM1hKQ&s', NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-13 23:58:30', 'duyhh', '2024-09-13 23:58:34', 'duyhh', 'Vi-VN'),
(3, 'doitac', 'Example 02', NULL, 'data:image/png;base64,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', NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-13 23:58:30', 'duyhh', '2024-09-13 23:58:34', 'duyhh', 'Vi-VN'),
(4, 'doitac', 'Example 02', NULL, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ9rpBVpOWhqKTQ-PMQtDRq-OxIJt1ttJ258w&s', NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-13 23:58:30', 'duyhh', '2024-09-13 23:58:34', 'duyhh', 'Vi-VN'),
(5, 'doitac', 'Example 02', NULL, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQnxYd0ExQeE8FrWDKwyK2Sm3YeA-_fxEPy1Q&s', NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-13 23:58:30', 'duyhh', '2024-09-13 23:58:34', 'duyhh', 'Vi-VN'),
(6, 'homeslide', 'Công ty Cổ Phần Xây Dựng Triều Tiến', '', 'imagesUpload/cong-ty-co-phan-xay-dung-trieu-tien20240914234145.jpg', NULL, '', 1, 1, '', '', '', '2024-09-14 00:15:53', 'duyhh', '2024-09-14 23:41:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(8, 'homeslide', 'Công ty Cổ Phần Xây Dựng Triều Tiến', '', 'imagesUpload/cong-ty-co-phan-xay-dung-trieu-tien20240914234220.jpg', NULL, '', 1, 1, '', '', '', '2024-09-14 00:15:53', 'duyhh', '2024-09-14 23:42:48', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(21, 'homeslide', 'Công ty Cổ Phần Xây Dựng Triều Tiến', '', 'imagesUpload/cong-ty-co-phan-xay-dung-trieu-tien20240915001320.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 00:13:20', 'Duy Hoàng(justeendh)', '2024-09-15 00:13:20', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(22, 'homeslide', 'Trieu Tien Construction Joint Stock Company', '', 'imagesUpload/trieu-tien-construction-joint-stock-company20240915001407.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 00:14:07', 'Duy Hoàng(justeendh)', '2024-09-15 00:14:07', 'Duy Hoàng(justeendh)', 'En-US'),
(23, 'homeslide', 'Trieu Tien Construction Joint Stock Company', '', 'imagesUpload/trieu-tien-construction-joint-stock-company20240915001424.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 00:14:24', 'Duy Hoàng(justeendh)', '2024-09-15 00:14:24', 'Duy Hoàng(justeendh)', 'En-US'),
(24, 'homeslide', 'Trieu Tien Construction Joint Stock Company', '', 'imagesUpload/trieu-tien-construction-joint-stock-company20240915001436.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 00:14:36', 'Duy Hoàng(justeendh)', '2024-09-15 00:14:36', 'Duy Hoàng(justeendh)', 'En-US'),
(25, 'hinhanh', 'Trieu Tien Construction Joint Stock Company', '', 'imagesUpload/trieu-tien-construction-joint-stock-company20240915004707.jpg', NULL, '', 1, 0, '', '', '', '2024-09-15 00:39:59', 'Duy Hoàng(justeendh)', '2024-09-15 00:47:07', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(26, 'hinhanh_ref_25', '', '25', 'imagesUpload/ActivitiesPhotos/1726336038-1538587788-GREENERY.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-15 00:47:18', 'Duy Hoàng(justeendh)', NULL, NULL, NULL),
(27, 'hinhanh_ref_25', '', '25', 'imagesUpload/ActivitiesPhotos/1726336038-1538587832-DRAGON.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-15 00:47:18', 'Duy Hoàng(justeendh)', NULL, NULL, NULL),
(28, 'hinhanh_ref_25', '', '25', 'imagesUpload/ActivitiesPhotos/1726336038-1538587852-KS-HAYDEN.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-15 00:47:18', 'Duy Hoàng(justeendh)', NULL, NULL, NULL),
(29, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/ho-so-nang-luc20240915005523.jpg', NULL, '', 1, 0, '', '', '', '2024-09-15 00:54:04', 'Duy Hoàng(justeendh)', '2024-09-15 00:55:23', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(31, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/ho-so-nang-luc20240915005714.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 00:57:14', 'Duy Hoàng(justeendh)', '2024-09-15 00:57:14', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(32, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/ho-so-nang-luc20240915011150.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(33, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/2120181014194458.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(34, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/2220181014194519.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(35, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/2320181015095310.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(36, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/2420181015095331.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(37, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/2520181015095356.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(38, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/2620181015095419.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(39, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/2720181015095441.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(40, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/2720200330010652.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(41, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/2820181015095503.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(42, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/2920181015095521.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(43, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/3020181015095541.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(44, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/3120181015095600.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(45, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/3220181015095617.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(46, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/3320181015095635.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(47, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/3420181015095654.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(48, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/3520181015095711.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(49, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/3620181015095735.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(50, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/3720181015095754.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(51, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/3820181015095811.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(52, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/420181014192733.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(53, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/520181014192750.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(54, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/620181019152915.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(55, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/720181019152941.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(56, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/820181019153010.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(57, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/920181019153041.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(58, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/1020181019153109.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(59, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/1120181019153129.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(60, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/1220181019153243.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(61, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/1320181019153307.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(62, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/1420181019153334.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(63, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/1520181019153417.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(64, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/1620181014194235.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(65, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/1620181014194257.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(66, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/1820181014194348.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(67, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/1920181014194418.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(68, 'hosonangluc', 'Hồ sơ năng lực', '', 'imagesUpload/2020181014194440.jpg', NULL, NULL, 1, 0, '', '', '', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', '2024-09-15 01:11:50', 'Duy Hoàng(justeendh)', 'Vi-VN'),
(69, 'duan_ref_6', '', '6', 'imagesUpload/ActivitiesPhotos/1726469639-LÊ ĐÌNH LÝ.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-16 13:53:59', 'Admin(trieutien_admin)', NULL, NULL, NULL),
(70, 'duan_ref_7', '', '7', 'imagesUpload/ActivitiesPhotos/1726469809-nguyên gia.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-16 13:56:49', 'Admin(trieutien_admin)', NULL, NULL, NULL),
(71, 'duan_ref_8', '', '8', 'imagesUpload/ActivitiesPhotos/1726470002-MONA LISA.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-16 14:00:02', 'Admin(trieutien_admin)', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hd_infomations`
--

CREATE TABLE `hd_infomations` (
  `KEY_INFO` varchar(255) NOT NULL,
  `VAL_INFO` longtext DEFAULT NULL,
  `LANGUAGE` varchar(255) NOT NULL,
  `SORT_INDEX` int(255) DEFAULT NULL,
  `TYPE_INFO` varchar(255) DEFAULT NULL,
  `VISIBLE_EDIT` tinyint(1) DEFAULT NULL,
  `NAME_INFO` varchar(255) DEFAULT 'Vi-VN'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `hd_infomations`
--

INSERT INTO `hd_infomations` (`KEY_INFO`, `VAL_INFO`, `LANGUAGE`, `SORT_INDEX`, `TYPE_INFO`, `VISIBLE_EDIT`, `NAME_INFO`) VALUES
('companyfullname', 'Công ty Cổ Phần Xây Dựng Triều Tiến', 'En-US', 1, '1', 1, 'Tên Công ty'),
('companyfullname', 'Công ty Cổ Phần Xây Dựng Triều Tiến', 'Vi-VN', 1, '1', 1, 'Tên Công ty'),
('contactformintro', '<p>If upon making changes to your .htaccess file your website breaks, you can also check the Apache error log for additional debugging information. The Apache error log file is typically located in the</p>\r\n', 'En-US', 9, NULL, 1, 'Thông tin liên hệ'),
('contactformintro', '<p>If upon making changes to your .htaccess file your website breaks, you can also check the Apache error log for additional debugging information. The Apache error log file is typically located in the</p>\r\n', 'Vi-VN', 9, NULL, 1, 'Thông tin liên hệ'),
('email', 'info@trieutien.vn', 'En-US', 2, '1', 1, 'Email'),
('email', 'info@trieutien.vn', 'Vi-VN', 2, '1', 1, 'Email'),
('fulladdress', '20-22 Nguyễn Khoa Chiêm, Phường Hoà Thọ Đông, Quận Cẩm Lệ, Đà Nẵng', 'En-US', 2, '1', 1, 'Địa chỉ'),
('fulladdress', '20-22 Nguyễn Khoa Chiêm, Phường Hoà Thọ Đông, Quận Cẩm Lệ, Đà Nẵng', 'Vi-VN', 2, '1', 1, 'Địa chỉ'),
('homeintro', '<p>First of all, the leaders of Trieu Tien Construction Joint Stock Company would like to send our sincere greetings and thanks to our customers and partners who have accompanied, cooperated and supported the Company in the past time.</p>\r\n', 'En-US', 6, NULL, 1, 'Giới thiệu trang chủ'),
('homeintro', '<p>Lời đầu tiên Lãnh đạo công ty Cổ phần Xây dựng Triều Tiến xin gửi lời chào trân trọng và lời cảm ơn tới quý khách hàng, đối tác đã đồng hành, hợp tác, ủng hộ<br />\r\nCông ty trong thời gian qua.</p>\r\n', 'Vi-VN', 6, NULL, 1, 'Giới thiệu trang chủ'),
('homevideopopup', '', 'En-US', 7, '3', 1, 'Popup video'),
('homevideopopup', '', 'Vi-VN', 7, '3', 1, 'Popup video'),
('hsnl_download', 'https://www.youtube.com/watch?v=EIoMa9D2UyE', 'ALL', 8, '4', 1, 'Link tải HSNL'),
('mobile', '02363551286', 'En-US', 3, '1', 1, 'Di động'),
('mobile', '02363551286', 'Vi-VN', 3, '1', 1, 'Di động'),
('phone', '02363551286', 'En-US', 4, '1', 1, 'Số Bàn'),
('phone', '02363551286', 'Vi-VN', 4, '1', 1, 'Số Bàn'),
('shortaddress', '20-22 Nguyễn Khoa Chiêm, Hoà Thọ Đông, Cẩm Lệ, Đà Nẵng', 'En-US', 5, '1', 1, 'Địa chỉ ngắn'),
('shortaddress', '20-22 Nguyễn Khoa Chiêm, Hoà Thọ Đông, Cẩm Lệ, Đà Nẵng', 'Vi-VN', 5, '1', 1, 'Địa chỉ ngắn'),
('stopwebsite', '1', 'ALL', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hd_modules`
--

CREATE TABLE `hd_modules` (
  `ID_MODULE` varchar(255) NOT NULL,
  `NAME_MD` varchar(255) DEFAULT NULL,
  `TYPE_MD` int(255) DEFAULT NULL,
  `ALLOW_ACTION` varchar(255) DEFAULT NULL,
  `Vi_VN` varchar(255) DEFAULT NULL,
  `En_US` varchar(255) DEFAULT NULL,
  `SORT_INDEX` int(11) DEFAULT NULL,
  `IMAGE_WIDTH` int(11) DEFAULT NULL,
  `IMAGE_HEIGHT` int(11) DEFAULT NULL,
  `IMAGE_RATIO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `hd_modules`
--

INSERT INTO `hd_modules` (`ID_MODULE`, `NAME_MD`, `TYPE_MD`, `ALLOW_ACTION`, `Vi_VN`, `En_US`, `SORT_INDEX`, `IMAGE_WIDTH`, `IMAGE_HEIGHT`, `IMAGE_RATIO`) VALUES
('dichvucongty', 'Dịch vụ công ty', 0, 'ADD,MODIFY,DELETE', 'Dịch vụ công ty', 'Our Services', 1, 64, 64, 1),
('doitac', 'Đối tác', 4, 'ADD,MODIFY,DELETE', 'Đối tác', 'Partners', 4, 715, 420, 1),
('duan', 'Dự án', 2, 'MANAGE_GROUP,MODIFY,ADD,DELETE,EDIT_CONTENT,DELETE', 'Dự án', 'Project', 3, 1035, 690, 1),
('gioithieu', 'Giới thiệu', 0, 'ADD,MODIFY,EDIT_CONTENT,DELETE', 'Giới thiệu', 'About us', 1, 1346, 690, 1),
('hinhanh', 'Hình ảnh', 3, 'ADD,MODIFY,DELETE', 'Hình ảnh', 'Photos', 3, NULL, NULL, NULL),
('homeslide', 'Hình ảnh', 4, 'ADD,MODIFY,DELETE', 'Sliders', 'Sliders', 4, 1346, 518, 1),
('hosonangluc', 'Hồ sơ năng lực', 4, 'ADD,MODIFY,EDIT_CONTENT,DELETE', 'Hồ sơ năng lực', 'Profile', 2, NULL, NULL, NULL),
('tintuc', 'Tin tức', 1, 'MANAGE_GROUP,ADD,DELETE', 'Tin tức', 'News', 5, 1035, 690, 1),
('tuyendung', 'Tuyển Dụng', 1, 'ADD,MODIFY,DELETE', 'Tuyển Dụng', 'Recruitment', 6, 1035, 690, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hd_projects`
--

CREATE TABLE `hd_projects` (
  `ID_PRJ` int(11) NOT NULL,
  `ID_MODULE` varchar(255) DEFAULT NULL,
  `GROUP_ID` int(11) DEFAULT NULL,
  `IMAGE_PRJ` longtext DEFAULT NULL,
  `NAME_PRJ` varchar(255) DEFAULT NULL,
  `VISIBLE_PRJ` tinyint(1) DEFAULT NULL,
  `DESC_PRJ` longtext DEFAULT NULL,
  `CONTENT_PRJ` longtext DEFAULT NULL,
  `HOST_PRJ` varchar(255) DEFAULT NULL,
  `LOCATION_PRJ` varchar(255) DEFAULT NULL,
  `YEAR_PRJ` int(11) DEFAULT NULL,
  `DATE_CREATED` datetime DEFAULT NULL,
  `USER_CREATED` varchar(255) DEFAULT NULL,
  `DATE_MODIFIED` datetime DEFAULT NULL,
  `USER_MODIFIED` varchar(255) DEFAULT NULL,
  `PRIORITY` int(255) DEFAULT NULL,
  `LANGUAGE` varchar(255) DEFAULT 'Vi-VN'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `hd_projects`
--

INSERT INTO `hd_projects` (`ID_PRJ`, `ID_MODULE`, `GROUP_ID`, `IMAGE_PRJ`, `NAME_PRJ`, `VISIBLE_PRJ`, `DESC_PRJ`, `CONTENT_PRJ`, `HOST_PRJ`, `LOCATION_PRJ`, `YEAR_PRJ`, `DATE_CREATED`, `USER_CREATED`, `DATE_MODIFIED`, `USER_MODIFIED`, `PRIORITY`, `LANGUAGE`) VALUES
(1, 'duan', 1, 'imagesUpload/ProjectsPhotos/biet-thu-tran-van-dung20240916091551.jpg', 'BIỆT THỰ ', 1, '', '', 'Trần Văn Dũng', 'Đường Bùi Tá Hán, Ngũ Hành Sơn, Đà Nẵng', 2022, '2024-09-14 00:33:10', 'duyhh', '2024-09-16 09:18:30', 'Admin(trieutien_admin)', 1, 'Vi-VN'),
(2, 'duan', 2, 'imagesUpload/ProjectsPhotos/khach-san-nghi-duong20240916090332.jpg', 'KHÁCH SẠN TÂN PHƯƠNG NAM', 1, '', '', 'CÔNG TY TNHH ĐẦU TƯ TỔNG HỢP TÂN PHƯƠNG NAM', 'Số 180 Bạch Đằng, Hải Châu, Đà Nẵng', 2022, '2024-09-16 09:03:32', 'Admin(trieutien_admin)', '2024-09-16 14:01:16', 'Admin(trieutien_admin)', 2, 'Vi-VN'),
(3, 'duan', 5, 'imagesUpload/ProjectsPhotos/toa-can-ho-taiyo-apartment20240916091045.jpg', 'TOÀ CĂN HỘ TAIYO APARTMENT', 1, '', '', 'TAIYO GROUP', 'Đường An Thượng 31, Ngũ Hành Sơn, Đà Nẵng', 2022, '2024-09-16 09:10:45', 'Admin(trieutien_admin)', '2024-09-16 09:18:34', 'Admin(trieutien_admin)', 1, 'Vi-VN'),
(4, 'duan', 5, 'imagesUpload/ProjectsPhotos/van-phong-cho-thue20240916091148.jpg', 'VĂN PHÒNG CHO THUÊ', 1, '', '', 'TẬP ĐOÀN GFDI', 'Đường 29/3, Hoà Xuân, Cẩm Lệ, Đà Nẵng', 2022, '2024-09-16 09:11:48', 'Admin(trieutien_admin)', '2024-09-16 09:14:13', 'Admin(trieutien_admin)', 2, 'Vi-VN'),
(5, 'duan', 5, 'imagesUpload/ProjectsPhotos/nha-o-ket-hop-van-phong-cho-thue20240916134600.jpg', 'NHÀ Ở KẾT HỢP VĂN PHÒNG CHO THUÊ', 1, '', '', 'BÀ NGUYỄN THỊ TOẠI', '28-30 NGUYỄN CHÍ THANH, HẢI CHÂU, ĐÀ NẴNG', 2022, '2024-09-16 13:46:00', 'Admin(trieutien_admin)', '2024-09-16 13:46:02', 'Admin(trieutien_admin)', NULL, 'Vi-VN'),
(6, 'duan', 5, 'imagesUpload/ProjectsPhotos/nha-o-ket-hop-van-phong-lam-viec20240916135341.jpg', 'NHÀ Ở KẾT HỢP VĂN PHÒNG LÀM VIỆC', 1, '', '', 'CÔNG TY TNHH GIÁO DỤC ACADEMY AEC', '98 LÊ ĐÌNH LÝ, VĨNH TRUNG, THANH KHÊ, ĐÀ NẴNG', 2020, '2024-09-16 13:53:41', 'Admin(trieutien_admin)', '2024-09-16 13:54:04', 'Admin(trieutien_admin)', NULL, 'Vi-VN'),
(7, 'duan', 2, 'imagesUpload/ProjectsPhotos/khach-san-nguyen-gia20240916135645.jpg', 'KHÁCH SẠN NGUYÊN GIA', 1, '', '', 'CÔNG TY TNHH MTV NGUYÊN LÊ GIA', 'ĐƯỜNG VÕ NGUYÊN GIÁP, THỌ QUANG, SƠN TRÀ, ĐÀ NẴNG', 2018, '2024-09-16 13:56:45', 'Admin(trieutien_admin)', '2024-09-16 13:57:01', 'Admin(trieutien_admin)', NULL, 'Vi-VN'),
(8, 'duan', 2, 'imagesUpload/ProjectsPhotos/khach-san-mona-lisa20240916135956.jpg', 'KHÁCH SẠN MONA LISA', 1, '', '', 'CÔNG TY TNHH XD TM VÀ DV MTV MONA LISA VIỆT NAM', '18-20-22-24 PHAN TÔN, NGŨ HÀNH SƠN, ĐÀ NẴNG', 2019, '2024-09-16 13:59:56', 'Admin(trieutien_admin)', '2024-09-16 14:00:06', 'Admin(trieutien_admin)', NULL, 'Vi-VN');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hd_userbybrowserlogs`
--

CREATE TABLE `hd_userbybrowserlogs` (
  `KEY__LOGS` varchar(50) NOT NULL,
  `TYPE_LOGS` varchar(255) DEFAULT NULL,
  `NAME_LOGS` varchar(255) DEFAULT NULL,
  `COUNTER` bigint(255) DEFAULT 0,
  `SHORT_NAME` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `hd_userbybrowserlogs`
--

INSERT INTO `hd_userbybrowserlogs` (`KEY__LOGS`, `TYPE_LOGS`, `NAME_LOGS`, `COUNTER`, `SHORT_NAME`) VALUES
('android', 'os', 'Android', 124, 'Android'),
('apple', 'os', 'Apple OS', 6, 'Apple OS'),
('chrome', 'browser', 'Google Chrome', 164, 'Chrome'),
('crom', 'browser', 'Cốc cốc', 0, 'Cốc cốc'),
('edge', 'browser', 'Microsoft Edge', 0, 'Edge'),
('firefox', 'browser', 'Mozila Firefox', 2, 'Firefox'),
('othersBrowser', 'browser', 'Others browsers', 36, 'Others'),
('othersOs', 'os', 'Others', 48, 'Others'),
('safari', 'browser', 'Apple Safari', 5, 'Safari'),
('windows', 'os', 'Windows', 2, 'Windows'),
('windows10', 'os', 'Windows 10', 27, 'Windows 10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hd_userbydatelogs`
--

CREATE TABLE `hd_userbydatelogs` (
  `DATE_ACCESS` varchar(40) NOT NULL,
  `COUNTER` bigint(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `hd_userbydatelogs`
--

INSERT INTO `hd_userbydatelogs` (`DATE_ACCESS`, `COUNTER`) VALUES
('2024-09-13', 3),
('2024-09-14', 5),
('2024-09-15', 55),
('2024-09-16', 45),
('2024-09-17', 102);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hd_users`
--

CREATE TABLE `hd_users` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(255) DEFAULT NULL,
  `FULL_NAME` varchar(255) DEFAULT NULL,
  `LAST_LOGIN` datetime DEFAULT NULL,
  `PASSWORD` varchar(255) DEFAULT NULL,
  `IS_ADMIN` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `hd_users`
--

INSERT INTO `hd_users` (`ID`, `USERNAME`, `FULL_NAME`, `LAST_LOGIN`, `PASSWORD`, `IS_ADMIN`) VALUES
(1, 'justeendh', 'Duy Hoàng', '2024-09-14 02:48:50', '77cca2edb9b78ceaebb9f8dec2dc44ef', 1),
(2, 'trieutien_admin', 'Admin', '2024-09-14 02:48:50', '1fd58ea0fd1a06dd3efe847bd9abdebd', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `hd_articles`
--
ALTER TABLE `hd_articles`
  ADD PRIMARY KEY (`ID_AR`) USING BTREE;

--
-- Chỉ mục cho bảng `hd_contacts`
--
ALTER TABLE `hd_contacts`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- Chỉ mục cho bảng `hd_groups`
--
ALTER TABLE `hd_groups`
  ADD PRIMARY KEY (`ID_GR`) USING BTREE;

--
-- Chỉ mục cho bảng `hd_images`
--
ALTER TABLE `hd_images`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- Chỉ mục cho bảng `hd_infomations`
--
ALTER TABLE `hd_infomations`
  ADD PRIMARY KEY (`KEY_INFO`,`LANGUAGE`) USING BTREE;

--
-- Chỉ mục cho bảng `hd_modules`
--
ALTER TABLE `hd_modules`
  ADD PRIMARY KEY (`ID_MODULE`) USING BTREE;

--
-- Chỉ mục cho bảng `hd_projects`
--
ALTER TABLE `hd_projects`
  ADD PRIMARY KEY (`ID_PRJ`) USING BTREE;

--
-- Chỉ mục cho bảng `hd_userbybrowserlogs`
--
ALTER TABLE `hd_userbybrowserlogs`
  ADD PRIMARY KEY (`KEY__LOGS`) USING BTREE;

--
-- Chỉ mục cho bảng `hd_userbydatelogs`
--
ALTER TABLE `hd_userbydatelogs`
  ADD PRIMARY KEY (`DATE_ACCESS`) USING BTREE;

--
-- Chỉ mục cho bảng `hd_users`
--
ALTER TABLE `hd_users`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `hd_articles`
--
ALTER TABLE `hd_articles`
  MODIFY `ID_AR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `hd_groups`
--
ALTER TABLE `hd_groups`
  MODIFY `ID_GR` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `hd_images`
--
ALTER TABLE `hd_images`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT cho bảng `hd_projects`
--
ALTER TABLE `hd_projects`
  MODIFY `ID_PRJ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `hd_users`
--
ALTER TABLE `hd_users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
