-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Client: localhost:3306
-- Généré le: Jeu 05 Avril 2018 à 09:43
-- Version du serveur: 10.1.31-MariaDB-cll-lve
-- Version de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `congdyxd_devblog`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `cat_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `position` tinyint(4) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`cat_id`, `user_id`, `cat_name`, `position`) VALUES
(8, 1, 'Blog', 1);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `auther` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `comment_date` datetime NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `page_id` (`page_id`),
  KEY `comment_date` (`comment_date`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`comment_id`, `page_id`, `auther`, `email`, `comment`, `comment_date`) VALUES
(25, 16, 'TrÆ°á»ng', 'congtruongvp97@gmail.com', 'Test Comment', '2018-01-24 06:18:57');

-- --------------------------------------------------------

--
-- Structure de la table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf32_unicode_ci NOT NULL,
  `upload_on` datetime NOT NULL,
  `size` int(11) NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci AUTO_INCREMENT=17 ;

--
-- Contenu de la table `files`
--

INSERT INTO `files` (`file_id`, `name`, `upload_on`, `size`) VALUES
(13, '26903938_862218623965878_4478444377631605873_n.jpg', '2018-01-24 06:29:51', 8773),
(14, 'cute vietnam girl.jpg', '2018-01-24 13:20:57', 154058),
(15, 'hinh-nen-dep-cho-lap-top (1).png', '2018-01-24 13:22:38', 2226640),
(16, 'raven_bird_flying_smoke_black_white_92907_1920x1080.jpg', '2018-01-24 13:23:22', 652607);

-- --------------------------------------------------------

--
-- Structure de la table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(200) COLLATE utf32_unicode_ci NOT NULL,
  `option_value` varchar(500) COLLATE utf32_unicode_ci NOT NULL,
  PRIMARY KEY (`option_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `options`
--

INSERT INTO `options` (`option_id`, `option_name`, `option_value`) VALUES
(1, 'siteurl', 'http://congtruong.xyz'),
(2, 'sitename', 'CÃ´ng TrÆ°á»ng Blog'),
(3, 'sitedescription', 'Blog Chia Sáº» Bá»Ÿi Tráº§n CÃ´ng TrÆ°á»ng');

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `page_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `position` tinyint(4) NOT NULL,
  `post_on` datetime NOT NULL,
  PRIMARY KEY (`page_id`),
  KEY `user_id` (`user_id`),
  KEY `cat_id` (`cat_id`),
  KEY `post_on` (`post_on`),
  KEY `position` (`position`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Contenu de la table `pages`
--

INSERT INTO `pages` (`page_id`, `user_id`, `cat_id`, `page_name`, `content`, `position`, `post_on`) VALUES
(16, 1, 8, 'HÆ°á»›ng dáº«n nháº­n 50k miá»…n phÃ­ vá»›i VPoint', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;">H&ocirc;m nay, m&igrave;nh viáº¿t b&agrave;i n&agrave;y hÆ°á»›ng dáº«n c&aacute;c báº¡n nháº­n&nbsp;<strong style="font-style: inherit; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">50.000 VNÄ miá»…n ph&iacute;</strong>&nbsp;tá»«&nbsp;<strong style="font-style: inherit; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">VPoint</strong>. Báº¡n chá»‰ cáº§n 1 sá»‘ Ä‘iá»‡n thoáº¡i v&agrave; 1 t&agrave;i khoáº£n email, tiá»n sáº½ Ä‘Æ°á»£c gá»­i vá» sau 24h. &Aacute;p dá»¥ng vá»›i má»i nh&agrave; máº¡ng, c&aacute;c báº¡n chá»‰ cáº§n Ä‘Äƒng k&yacute; t&agrave;i khoáº£n miá»…n ph&iacute;, nháº­p m&atilde; giá»›i thiá»‡u v&agrave; Ä‘á»£i tiá»n vá».</p>\r\n<h3 style="margin-top: 0px; margin-bottom: 12px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: bold; font-stretch: inherit; font-size: 25px; line-height: 1.4; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;">I. Giá»›i thiá»‡u vá» VPoint</h3>\r\n<blockquote style="margin-bottom: 25px; padding-right: 10px; padding-bottom: 3px; padding-left: 20px; border-left: 3px solid rgba(0, 0, 0, 0.8); font-style: italic; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; quotes: none; position: relative; color: #333333; background-color: #ffffff;">\r\n<p style="margin-top: 0px; margin-bottom: 10px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">Vpoint l&agrave; tháº» t&iacute;ch Ä‘iá»ƒm Ä‘a nÄƒng, báº¡n c&oacute; thá»ƒ t&iacute;ch Ä‘iá»ƒm v&agrave; thanh to&aacute;n báº±ng Ä‘iá»ƒm táº¡i nhiá»u cá»­a h&agrave;ng thuá»™c cá»™ng Ä‘á»“ng li&ecirc;n káº¿t cá»§a Vpoint.&nbsp;Vá»›i tháº» t&iacute;ch Ä‘iá»ƒm Ä‘a nÄƒng Vpoint, kh&aacute;ch h&agrave;ng kh&ocirc;ng cáº§n lÆ°u trá»¯ qu&aacute; nhiá»u tháº» kh&aacute;ch h&agrave;ng th&acirc;n thiáº¿t trong v&iacute; vá»›i c&aacute;c gi&aacute; trá»‹ Æ°u Ä‘&atilde;i nhá» láº» theo tá»«ng cá»­a h&agrave;ng, thay v&agrave;o Ä‘&oacute;, sá»‘ Ä‘iá»ƒm t&iacute;ch lÅ©y tá»« c&aacute;c cá»­a h&agrave;ng Ä‘Æ°á»£c Cá»˜NG Dá»’N trong tháº», kh&aacute;ch h&agrave;ng c&oacute; thá»ƒ sá»­ dá»¥ng sá»‘ Ä‘iá»ƒm n&agrave;y Ä‘á»ƒ THANH TO&Aacute;N má»™t pháº§n hoáº·c to&agrave;n bá»™ gi&aacute; trá»‹ mua h&agrave;ng trong láº§n mua tiáº¿p theo.<br /><em style="font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">Theo&nbsp;v-point.vn.</em></p>\r\n</blockquote>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;">C&aacute;c báº¡n c&oacute; thá»ƒ tham kháº£o chi tiáº¿t vá» VPoint&nbsp;<a style="font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-decoration-line: none; color: #12b075; transition: all 0.25s ease;" href="https://v-point.vn/mypage/gioi-thieu/vpoint" target="_blank" rel="nofollow noopener">táº¡i Ä‘&acirc;y</a>.</p>\r\n<h3 style="margin-top: 0px; margin-bottom: 12px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: bold; font-stretch: inherit; font-size: 25px; line-height: 1.4; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;">II. HÆ°á»›ng dáº«n Ä‘Äƒng k&yacute; t&agrave;i khoáº£n VPoint v&agrave; nháº­n 50 Ä‘iá»ƒm</h3>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;"><strong style="font-style: inherit; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">BÆ°á»›c 1:&nbsp;</strong>Báº¡n táº£i á»©ng dá»¥ng VPoint tr&ecirc;n Ä‘iá»‡n thoáº¡i (Android or IOS) vá» m&aacute;y Ä‘á»ƒ Ä‘Äƒng k&yacute; t&agrave;i khoáº£n má»›i.</p>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;">Link Andoird:&nbsp;<a style="font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-decoration-line: none; color: #12b075; transition: all 0.25s ease;" href="https://play.google.com/store/apps/details?id=vn.com.vnpt.vinaphone.vnptsoftware.vpoint.mypage" target="_blank" rel="nofollow noopener">Táº£i vá» VPoint cho Android</a>.</p>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;">Link IOS:&nbsp;<a style="font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-decoration-line: none; color: #12b075; transition: all 0.25s ease;" href="https://itunes.apple.com/us/app/vpoint/id1244667572?mt=8" target="_blank" rel="nofollow noopener">Táº£i vá» VPoint cho IOS</a>.</p>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;"><span style="font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-decoration-line: underline;"><em style="font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;"><strong style="font-style: inherit; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">Ch&uacute; &yacute; trÆ°á»›c:</strong></em></span>&nbsp;Khi Ä‘Äƒng k&yacute; t&agrave;i khoáº£n c&aacute;c báº¡n cáº§n nháº­p m&atilde; giá»›i thiá»‡u l&agrave;:&nbsp;<span style="font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; color: #ff0000;">0981334233<span style="font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; color: #000000;">. Pháº£i nháº­p ch&iacute;nh x&aacute;c má»›i Ä‘Æ°á»£c nháº­n 50 Ä‘iá»ƒm thÆ°á»Ÿng nha.</span></span></p>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;"><img class="aligncenter wp-image-918 size-full" style="margin: 1em auto; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; max-width: 100%; display: block; clear: both; float: none; height: auto !important;" src="https://truongken.net/wp-content/uploads/2017/12/kiem-tien-voi-vpoint.png" sizes="(max-width: 540px) 100vw, 540px" srcset="https://truongken.net/wp-content/uploads/2017/12/kiem-tien-voi-vpoint.png 540w, https://truongken.net/wp-content/uploads/2017/12/kiem-tien-voi-vpoint-169x300.png 169w" alt="nháº­n 50k miá»…n ph&iacute; vá»›i vpoint" width="540" height="960" /></p>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;">Hoáº·c báº¡n cÅ©ng c&oacute; thá»ƒ truy cáº­p website cá»§a VPoint Ä‘á»ƒ Ä‘Äƒng k&yacute; t&agrave;i khoáº£n.</p>\r\n<div class="button-center" style="font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; width: 628px; text-align: center; color: #333333; background-color: #ffffff;"><a class="buttons btn_green center" style="margin-right: 15px; margin-bottom: 15px; padding: 10px 20px; border-width: 1px; border-style: solid; border-color: rgba(0, 0, 0, 0.1); font-style: inherit; font-variant: inherit; font-weight: bold; font-stretch: inherit; font-size: 12px; line-height: inherit; font-family: inherit; vertical-align: baseline; text-decoration-line: none; transition: all 0.25s ease; border-radius: 3px; overflow: hidden; display: inline-block; width: auto; background-color: #6cb24c; text-transform: uppercase; clear: both; float: none; color: #ffffff !important;" href="https://v-point.vn/mypage" target="_blank" rel="noopener"><span class="left" style="font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; float: none; overflow: hidden;">LINK ÄÄ‚NG K&Yacute; VPOINT</span></a></div>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;">C&aacute;c báº¡n click v&agrave;o link tr&ecirc;n chá»n Tham gia VPoint nhÆ° h&igrave;nh dÆ°á»›i:</p>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;"><img class="aligncenter size-full wp-image-919" style="margin: 1em auto; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; max-width: 100%; display: block; clear: both; float: none; height: auto !important;" src="https://truongken.net/wp-content/uploads/2017/12/kiem-tien-voi-vpoint-1.png" sizes="(max-width: 1360px) 100vw, 1360px" srcset="https://truongken.net/wp-content/uploads/2017/12/kiem-tien-voi-vpoint-1.png 1360w, https://truongken.net/wp-content/uploads/2017/12/kiem-tien-voi-vpoint-1-300x156.png 300w, https://truongken.net/wp-content/uploads/2017/12/kiem-tien-voi-vpoint-1-768x398.png 768w, https://truongken.net/wp-content/uploads/2017/12/kiem-tien-voi-vpoint-1-1024x531.png 1024w" alt="" width="1360" height="705" /></p>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;"><strong style="font-style: inherit; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">BÆ°á»›c 2:</strong>&nbsp;Nháº­p c&aacute;c th&ocirc;ng tin bao gá»“m: Há» t&ecirc;n, t&ecirc;n Ä‘Äƒng nháº­p, máº­t kháº©u, x&aacute;c nháº­n máº­t kháº©u.</p>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;"><img class="aligncenter size-full wp-image-920" style="margin: 1em auto; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; max-width: 100%; display: block; clear: both; float: none; height: auto !important;" src="https://truongken.net/wp-content/uploads/2017/12/kiem-tien-voi-vpoint-2.png" sizes="(max-width: 527px) 100vw, 527px" srcset="https://truongken.net/wp-content/uploads/2017/12/kiem-tien-voi-vpoint-2.png 527w, https://truongken.net/wp-content/uploads/2017/12/kiem-tien-voi-vpoint-2-283x300.png 283w" alt="" width="527" height="559" /></p>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;"><strong style="font-style: inherit; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">BÆ°á»›c 3:</strong>&nbsp;Ä&acirc;y l&agrave; bÆ°á»›c quan trá»ng Ä‘á»ƒ báº¡n Ä‘Æ°á»£c 50k miá»…n ph&iacute;. C&aacute;c ch&uacute; &yacute; Ä‘á»c ká»¹ v&agrave; l&agrave;m theo hÆ°á»›ng dáº«n nha.</p>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;">á»ž Ä‘&acirc;y c&aacute;c báº¡n Ä‘iá»n c&aacute;c th&ocirc;ng tin: Email, sá»‘ Ä‘iá»‡n thoáº¡i, ng&agrave;y sinh, Ä‘á»‹a chá»‰, giá»›i t&iacute;nh nhÆ° b&igrave;nh thÆ°á»ng.</p>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;">Tuy nhi&ecirc;n quan trá»ng nháº¥t &ocirc;&nbsp;<strong style="font-style: inherit; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">Sá» ÄIá»†N THOáº I NGÆ¯á»œI GIá»šI THIá»†U</strong>&nbsp;c&aacute;c báº¡n nháº­p ch&iacute;nh x&aacute;c sá»‘ Ä‘iá»‡n thoáº¡i cá»§a m&igrave;nh Ä‘á»ƒ cáº£ m&igrave;nh v&agrave; báº¡n Ä‘á»u nháº­n Ä‘Æ°á»£c 50k nha.</p>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff; text-align: center;"><strong style="font-style: inherit; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">SDT M&igrave;nh:</strong>&nbsp;<span style="font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; color: #ff0000;"><strong style="font-style: inherit; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">0981334233</strong></span></p>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;"><img class="aligncenter size-full wp-image-921" style="margin: 1em auto; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; max-width: 100%; display: block; clear: both; float: none; height: auto !important;" src="https://truongken.net/wp-content/uploads/2017/12/kiem-tien-voi-vpoint-3.png" sizes="(max-width: 492px) 100vw, 492px" srcset="https://truongken.net/wp-content/uploads/2017/12/kiem-tien-voi-vpoint-3.png 492w, https://truongken.net/wp-content/uploads/2017/12/kiem-tien-voi-vpoint-3-257x300.png 257w" alt="" width="492" height="574" /></p>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;"><strong style="font-style: inherit; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">BÆ°á»›c 4:</strong>&nbsp;X&aacute;c nháº­n m&atilde; OPT Ä‘Æ°á»£c gá»­i vá» Ä‘iá»‡n thoáº¡i v&agrave; ho&agrave;n th&agrave;nh.</p>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;"><img class="aligncenter size-full wp-image-922" style="margin: 1em auto; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; max-width: 100%; display: block; clear: both; float: none; height: auto !important;" src="https://truongken.net/wp-content/uploads/2017/12/kiem-tien-voi-vpoint-4.png" sizes="(max-width: 486px) 100vw, 486px" srcset="https://truongken.net/wp-content/uploads/2017/12/kiem-tien-voi-vpoint-4.png 486w, https://truongken.net/wp-content/uploads/2017/12/kiem-tien-voi-vpoint-4-300x262.png 300w" alt="" width="486" height="424" /></p>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;"><strong style="font-style: inherit; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">BÆ°á»›c 5:</strong>&nbsp;Äá»£i 24h báº¡n sáº½ nháº­n Ä‘Æ°á»£c 50 Ä‘iá»ƒm trong t&agrave;i khoáº£n VPoint.</p>\r\n<h3 style="margin-top: 0px; margin-bottom: 12px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: bold; font-stretch: inherit; font-size: 25px; line-height: 1.4; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;">III. C&aacute;ch sá»­ dá»¥ng Ä‘iá»ƒm VPoint</h3>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;"><strong style="font-style: inherit; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">BÆ°á»›c 1:</strong>&nbsp;C&agrave;i á»©ng dá»¥ng Vpoint tr&ecirc;n Ä‘iá»‡n thoáº¡i v&agrave; Ä‘Äƒng nháº­p v&agrave;o nick vá»«a Ä‘Äƒng k&yacute; á»Ÿ tr&ecirc;n. Chá»n má»¥c Ä‘iá»ƒm Ä‘á»ƒ kiá»ƒm tra Ä‘iá»ƒm cá»§a báº¡n Ä‘&atilde; Ä‘Æ°á»£c cá»™ng chÆ°a (LÆ°u &yacute;: Sau khi Ä‘Äƒng k&yacute; Ä‘á»£i 24h má»›i Ä‘Æ°á»£c cá»™ng Ä‘iá»ƒm nha.).</p>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;">Link Andoird:&nbsp;<a style="font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-decoration-line: none; color: #12b075; transition: all 0.25s ease;" href="https://play.google.com/store/apps/details?id=vn.com.vnpt.vinaphone.vnptsoftware.vpoint.mypage" target="_blank" rel="nofollow noopener">Táº£i vá» VPoint cho Android</a>.</p>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;">Link IOS:&nbsp;<a style="font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-decoration-line: none; color: #12b075; transition: all 0.25s ease;" href="https://itunes.apple.com/us/app/vpoint/id1244667572?mt=8" target="_blank" rel="nofollow noopener">Táº£i vá» VPoint cho IOS</a>.</p>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;">Sau khi c&agrave;i á»©ng dá»¥ng v&agrave; c&oacute; Ä‘iá»ƒm, c&aacute;c báº¡n láº¥y m&atilde; ti&ecirc;u Ä‘iá»ƒm báº±ng c&aacute;ch chá»n n&uacute;t nhÆ° h&igrave;nh dÆ°á»›i.</p>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;"><img class="aligncenter size-full wp-image-923" style="margin: 1em auto; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; max-width: 100%; display: block; clear: both; float: none; height: auto !important;" src="https://truongken.net/wp-content/uploads/2017/12/kiem-tien-voi-vpoint-5.png" sizes="(max-width: 540px) 100vw, 540px" srcset="https://truongken.net/wp-content/uploads/2017/12/kiem-tien-voi-vpoint-5.png 540w, https://truongken.net/wp-content/uploads/2017/12/kiem-tien-voi-vpoint-5-169x300.png 169w" alt="" width="540" height="960" /></p>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;">BÆ°á»›c 2:&nbsp;ÄÄƒng k&yacute; t&agrave;i khoáº£n tr&ecirc;n trang&nbsp;<a style="font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-decoration-line: none; color: #12b075; transition: all 0.25s ease;" href="https://onecard.vn/" target="_blank" rel="nofollow noopener">https://onecard.vn</a>.</p>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;">Sau khi Ä‘Äƒng k&yacute; c&aacute;c báº¡n Ä‘Äƒng nháº­p, Ä‘áº·t h&agrave;ng sau Ä‘&oacute; nháº­p m&atilde; ti&ecirc;u Ä‘iá»ƒm cá»§a Vpoint láº¥y á»Ÿ bÆ°á»›c tr&ecirc;n má»i ngÆ°á»i sáº½ ti&ecirc;u Ä‘Æ°á»£c.</p>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;"><img class="aligncenter size-full wp-image-924" style="margin: 1em auto; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; max-width: 100%; display: block; clear: both; float: none; height: auto !important;" src="https://truongken.net/wp-content/uploads/2017/12/kiem-tien-voi-vpoint-6.png" sizes="(max-width: 1305px) 100vw, 1305px" srcset="https://truongken.net/wp-content/uploads/2017/12/kiem-tien-voi-vpoint-6.png 1305w, https://truongken.net/wp-content/uploads/2017/12/kiem-tien-voi-vpoint-6-300x77.png 300w, https://truongken.net/wp-content/uploads/2017/12/kiem-tien-voi-vpoint-6-768x196.png 768w, https://truongken.net/wp-content/uploads/2017/12/kiem-tien-voi-vpoint-6-1024x261.png 1024w" alt="" width="1305" height="333" /></p>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;"><span style="font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-decoration-line: underline;"><strong style="font-style: inherit; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;"><em style="font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">Ch&uacute; &yacute; nhá»:</em></strong></span>&nbsp;ChÆ°Æ¡ng tr&igrave;nh chá»‰ giá»›i háº¡n&nbsp;<strong style="font-style: inherit; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">1 tá»· VNÄ</strong>&nbsp;do váº­y c&aacute;c báº¡n tranh thá»§ nha!</p>\r\n<h4 style="margin-top: 0px; margin-bottom: 12px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: bold; font-stretch: inherit; font-size: 23px; line-height: 1.4; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;">IV. C&aacute;ch kiáº¿m Ä‘iá»ƒm VPoint</h4>\r\n<p style="margin-top: 0px; margin-bottom: 20px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: Roboto; vertical-align: baseline; color: #333333; background-color: #ffffff;">Má»—i lÆ°á»£t giá»›i thiá»‡u nhÆ° m&igrave;nh giá»›i thiá»‡u c&aacute;c báº¡n th&igrave; má»—i ngÆ°á»i sáº½ Ä‘Æ°á»£c thÆ°á»Ÿng 50 point tÆ°Æ¡ng Ä‘Æ°Æ¡ng vá»›i 50k. Ch&uacute;c c&aacute;c báº¡n th&agrave;nh c&ocirc;ng!</p>\r\n</body>\r\n</html>', 1, '2018-01-24 06:18:04'),
(17, 1, 8, 'HÃ¬nh ná»n Ä‘áº¹p Part 1', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>DÆ°á»›i Ä‘&acirc;y l&agrave; nhá»¯ng bá»©c h&igrave;nh ná»n Ä‘áº¹p sÆ°u táº§m. Share náº¿u tháº¥y n&oacute; Ä‘áº¹p :3.</p>\r\n<p><img src="../uploads/cute vietnam girl.jpg" alt="H&igrave;nh G&aacute;i Xinh" width="720" height="467" /></p>\r\n<p><img src="../uploads/hinh-nen-dep-cho-lap-top (1).png" width="720" height="405" /></p>\r\n<p><img src="../uploads/raven_bird_flying_smoke_black_white_92907_1920x1080.jpg" width="720" height="405" /></p>\r\n<p>Tr&ecirc;n Ä‘&acirc;y l&agrave; máº¥y bá»©c áº£nh Ä‘áº¹p l&agrave;m h&igrave;nh ná»n m&aacute;y t&iacute;nh Ä‘áº¹p ^^</p>\r\n</body>\r\n</html>', 2, '2018-01-24 13:24:11');

-- --------------------------------------------------------

--
-- Structure de la table `page_views`
--

CREATE TABLE IF NOT EXISTS `page_views` (
  `view_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `num_views` int(11) NOT NULL,
  `user_ip` text COLLATE utf32_unicode_ci NOT NULL,
  PRIMARY KEY (`view_id`),
  KEY `page_id` (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci AUTO_INCREMENT=10 ;

--
-- Contenu de la table `page_views`
--

INSERT INTO `page_views` (`view_id`, `page_id`, `num_views`, `user_ip`) VALUES
(8, 16, 78, '27.67.4.231'),
(9, 17, 38, '1.53.43.43');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `avatar` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_level` tinyint(4) NOT NULL,
  `active` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registration_date` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  KEY `registration_date` (`registration_date`),
  KEY `first_name` (`first_name`),
  KEY `last_name` (`last_name`),
  KEY `pass` (`pass`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `pass`, `website`, `bio`, `avatar`, `user_level`, `active`, `registration_date`) VALUES
(1, 'Truong', 'Ken', 'admin@gmail.com', '2615dcb7ce43f149d94674e71098f0ab9e608533', 'hinhnenmienphi.com', 'LiÃªn há»‡ facebook: fb.com/truongvp97 Ä‘á»ƒ xem thÃªm thÃ´ng tin  chi tiáº¿t :3', '8964675495a67648cd637a7.57846551.jpg', 2, NULL, '2017-10-15 12:59:00'),
(2, 'Bui', 'Tung', 'tung230197@gmail.com', '82d8c8f996bfc3527825c21435cb2d6263256298', NULL, NULL, NULL, 1, NULL, '2018-01-24 10:58:03');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `page_views`
--
ALTER TABLE `page_views`
  ADD CONSTRAINT `page_views_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `pages` (`page_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
