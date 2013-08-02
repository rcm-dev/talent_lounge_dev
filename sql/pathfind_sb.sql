-- phpMyAdmin SQL Dump
-- version 3.4.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 07, 2012 at 03:56 PM
-- Server version: 5.1.65
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pathfind_sb`
--

-- --------------------------------------------------------

--
-- Table structure for table `mj_area`
--

CREATE TABLE IF NOT EXISTS `mj_area` (
  `area_id` int(10) NOT NULL AUTO_INCREMENT,
  `area_name` varchar(30) NOT NULL,
  PRIMARY KEY (`area_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mj_com_info`
--

CREATE TABLE IF NOT EXISTS `mj_com_info` (
  `ci_id` int(10) NOT NULL AUTO_INCREMENT,
  `ci_addrs` varchar(255) NOT NULL,
  `ci_about` varchar(255) NOT NULL,
  `ci_desc` varchar(255) NOT NULL,
  `ci_general` varchar(255) NOT NULL,
  `ci_email` varchar(70) NOT NULL,
  `ci_phone` varchar(10) NOT NULL,
  `ci_fax` varchar(10) NOT NULL,
  `ci_website` varchar(30) NOT NULL,
  `ci_sector_id` int(2) NOT NULL,
  `ci_services_id` int(2) NOT NULL,
  `ci_area_id` int(2) NOT NULL,
  `ci_state_id` int(2) NOT NULL,
  `ci_country_id` int(2) NOT NULL,
  PRIMARY KEY (`ci_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mj_conum_relation`
--

CREATE TABLE IF NOT EXISTS `mj_conum_relation` (
  `conum_id` int(10) NOT NULL AUTO_INCREMENT,
  `comnum_number` varchar(20) NOT NULL,
  `conum_com_id_fk` int(10) NOT NULL,
  PRIMARY KEY (`conum_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mj_country`
--

CREATE TABLE IF NOT EXISTS `mj_country` (
  `country_id` int(10) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(30) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mj_country`
--

INSERT INTO `mj_country` (`country_id`, `country_name`) VALUES
(1, 'Malaysia');

-- --------------------------------------------------------

--
-- Table structure for table `mj_director_ic`
--

CREATE TABLE IF NOT EXISTS `mj_director_ic` (
  `directoric_id` int(11) NOT NULL AUTO_INCREMENT,
  `director_id_fk` int(11) NOT NULL,
  `director_com_id_fk` int(11) NOT NULL,
  `director_valid_ic` int(11) NOT NULL,
  PRIMARY KEY (`directoric_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mj_fund_category`
--

CREATE TABLE IF NOT EXISTS `mj_fund_category` (
  `fund_cat_id` int(10) NOT NULL AUTO_INCREMENT,
  `fund_cat_name` varchar(70) NOT NULL,
  PRIMARY KEY (`fund_cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `mj_fund_category`
--

INSERT INTO `mj_fund_category` (`fund_cat_id`, `fund_cat_name`) VALUES
(1, 'Art'),
(2, 'Comics'),
(3, 'Dance'),
(6, 'Design'),
(7, 'Fashion'),
(8, 'Film & Video'),
(9, 'Food'),
(10, 'Games'),
(11, 'Music'),
(12, 'Photography'),
(13, 'Publishing'),
(14, 'Technology'),
(15, 'Theater');

-- --------------------------------------------------------

--
-- Table structure for table `mj_fund_comment`
--

CREATE TABLE IF NOT EXISTS `mj_fund_comment` (
  `fund_comment_id` int(10) NOT NULL AUTO_INCREMENT,
  `fund_usr_id_fk` int(10) NOT NULL,
  `fund_post_id_fk` int(10) NOT NULL,
  `fund_comment_body` varchar(255) NOT NULL,
  `fund_comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`fund_comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `mj_fund_comment`
--

INSERT INTO `mj_fund_comment` (`fund_comment_id`, `fund_usr_id_fk`, `fund_post_id_fk`, `fund_comment_body`, `fund_comment_date`) VALUES
(1, 1, 3, 'This is cool man!', '2012-02-07 20:56:47'),
(2, 2, 1, '4 Days to go! Yahooo!', '2012-02-16 07:23:52'),
(3, 14, 1, 'over budget :P', '2012-03-09 22:15:11'),
(4, 27, 7, 'Wow 2M?', '2012-03-14 14:45:18'),
(5, 1, 7, 'Yes :P', '2012-03-14 16:10:19'),
(6, 2, 11, 'Dfgr', '2012-05-06 09:00:54');

-- --------------------------------------------------------

--
-- Table structure for table `mj_fund_media`
--

CREATE TABLE IF NOT EXISTS `mj_fund_media` (
  `mfm_id` int(11) NOT NULL AUTO_INCREMENT,
  `mfm_path` text NOT NULL,
  `mfm_id_fk` int(11) NOT NULL,
  `mfm_type` int(11) NOT NULL,
  PRIMARY KEY (`mfm_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `mj_fund_media`
--

INSERT INTO `mj_fund_media` (`mfm_id`, `mfm_path`, `mfm_id_fk`, `mfm_type`) VALUES
(8, 'uploads/project/lbos.png', 7, 1),
(9, 'uploads/project/fb_home.png', 7, 1),
(10, 'uploads/project/badge.png', 7, 1),
(11, 'uploads/project/606-black.jpg', 1, 1),
(12, 'uploads/project/606-silver.jpg', 1, 1),
(13, 'uploads/project/606-yellow.jpg', 1, 1),
(14, 'uploads/project/test-x-dot.mp4', 1, 2),
(15, 'uploads/project/Jellyfish.jpg', 2, 1),
(16, 'uploads/project/Koala.jpg', 2, 1),
(17, 'uploads/project/Penguins.jpg', 2, 1),
(18, 'uploads/project/test_Wildlife.mp4', 2, 2),
(21, 'uploads/project/dinotitan.jpg', 9, 1),
(22, 'uploads/project/dinotitan.jpg', 9, 1),
(23, 'uploads/project/Nemesis-Prime-Henkei-Transformers-Custom.jpg', 9, 1),
(24, 'uploads/project/1279150878_b6cf2467b0.jpg', 9, 1),
(25, 'uploads/project/photo-full.jpg', 10, 1),
(26, 'uploads/project/photo-full-1.jpg', 11, 1),
(27, 'uploads/project/trio2.jpg', 12, 1),
(28, 'uploads/project/slc.jpg', 13, 1),
(29, 'uploads/project/nikkor85mm.jpg', 14, 1),
(30, 'uploads/project/drifter.jpg', 2, 1),
(36, 'uploads/project/myg.jpg', 37, 1),
(37, 'uploads/ideas/freshmilk.mp4', 37, 2),
(38, 'uploads/project/kayu1.jpg', 38, 1),
(39, 'uploads/project/kayu2.jpg', 38, 1),
(40, 'uploads/project/kayu3.jpg', 38, 1),
(41, 'uploads/project/ukir.mp4', 38, 2),
(42, 'uploads/project/', 0, 1),
(43, 'uploads/project/', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `mj_fund_pledged`
--

CREATE TABLE IF NOT EXISTS `mj_fund_pledged` (
  `fund_pledged_id` int(10) NOT NULL AUTO_INCREMENT,
  `fund_usr_id_fk` int(10) NOT NULL,
  `fund_post_id_fk` int(10) NOT NULL,
  `fund_money` int(255) NOT NULL,
  PRIMARY KEY (`fund_pledged_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `mj_fund_pledged`
--

INSERT INTO `mj_fund_pledged` (`fund_pledged_id`, `fund_usr_id_fk`, `fund_post_id_fk`, `fund_money`) VALUES
(1, 2, 1, 5000),
(4, 3, 2, 7500),
(5, 3, 1, 5000),
(6, 1, 3, 10000),
(7, 2, 3, 10000),
(8, 2, 1, 5000),
(11, 14, 1, 21000);

-- --------------------------------------------------------

--
-- Table structure for table `mj_fund_post`
--

CREATE TABLE IF NOT EXISTS `mj_fund_post` (
  `fund_post_id` int(10) NOT NULL AUTO_INCREMENT,
  `fund_usr_id_fk` int(10) NOT NULL,
  `fund_cat_id_fk` int(10) NOT NULL,
  `fund_post_title` varchar(70) NOT NULL,
  `fund_post_short_brief` text NOT NULL,
  `fund_post_business_model` text NOT NULL,
  `fund_post_customer_market` text NOT NULL,
  `fund_post_accesstiming` text NOT NULL,
  `fund_post_economic_trends` text NOT NULL,
  `fund_post_tech_dev_inno` text NOT NULL,
  `fund_post_ip_regulation` text NOT NULL,
  `fund_post_industry_future` text NOT NULL,
  `fund_post_idea_development` text NOT NULL,
  `fund_post_project_budget` text NOT NULL,
  `fund_post_funding_miles` text NOT NULL,
  `fund_post_image` text NOT NULL,
  `fund_post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fund_post_ended` text NOT NULL,
  `fund_post_video` text NOT NULL,
  `fund_post_ratup` int(10) DEFAULT NULL,
  `fund_post_ratdown` int(10) DEFAULT NULL,
  `fund_view` int(11) DEFAULT NULL,
  `fund_post_published` int(2) DEFAULT NULL,
  `fund_post_success` int(1) DEFAULT NULL,
  `fund_post_failed` int(1) DEFAULT NULL,
  `fund_post_featured` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fund_post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `mj_fund_post`
--

INSERT INTO `mj_fund_post` (`fund_post_id`, `fund_usr_id_fk`, `fund_cat_id_fk`, `fund_post_title`, `fund_post_short_brief`, `fund_post_business_model`, `fund_post_customer_market`, `fund_post_accesstiming`, `fund_post_economic_trends`, `fund_post_tech_dev_inno`, `fund_post_ip_regulation`, `fund_post_industry_future`, `fund_post_idea_development`, `fund_post_project_budget`, `fund_post_funding_miles`, `fund_post_image`, `fund_post_date`, `fund_post_ended`, `fund_post_video`, `fund_post_ratup`, `fund_post_ratdown`, `fund_view`, `fund_post_published`, `fund_post_success`, `fund_post_failed`, `fund_post_featured`) VALUES
(1, 1, 1, 'Helmet', 'On this site, you will find online tools to perform common string manipulations such as reversing a string.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc tristique molestie elit quis pulvinar. Proin porta congue nulla non feugiat. Fusce ut velit sapien, vel molestie diam. Sed interdum ligula eget erat ornare molestie.', 'Customer', 'Market', 'Economic', 'Technology', 'IP', 'Future Plans', 'Idea Development', '20000', 'Cash Flow', 'uploads/project/1-February-6-2012-12-59-48-am-2_MG_4330.jpg', '2012-03-14 13:58:31', '2012-10-20 0:59:48', 'uploads/project/1-February-6-2012-12-59-48-am-x-dot.mp4', 0, 1, 811, 1, 1, 0, 0),
(2, 22, 2, 'Wild Life Descovery', 'On this site, you will find online tools to perform common string manipulations such as reversing a string.', 'Curabitur aliquam mi id tellus volutpat eget mollis dolor consequat. In mollis, diam id rhoncus ornare, orci dui posuere justo, a lobortis ligula mi at orci. Nulla nec eleifend tellus. Nam mattis mattis eros, non lacinia orci dictum ac. Nulla in purus mauris.', 'Customer', 'Mrket', 'Economic', 'Technology', 'IP', 'Future Plans', 'Idea Development', '30000', 'Cash Flow Break Down', 'uploads/project/1-February-6-2012-1-25-25-am-wildlife.jpg', '2012-03-13 01:27:11', '2012-10-20 0:59:48', 'uploads/project/1-February-6-2012-1-25-25-am-Wildlife.mp4', 1, 1, 802, 1, 0, 1, 0),
(3, 3, 1, 'Motion Graphics Reel', 'Motion graphics are graphics that use video footage and/or animation technology to create the illusion of motion or rotation, graphics are usually combined with audio for use in multimedia projects. Motion graphics are usually displayed via electronic media technology, but may be displayed via manual powered technology (e.g. thaumatrope, phenakistoscope, stroboscope, zoetrope, praxinoscope, flip book) as well. The term is useful for distinguishing still graphics from graphics with a transforming appearance over time without over-specifying the form.', 'Motion graphics extend beyond the most commonly used methods of frame-by-frame footage and animation. Computers are capable of calculating and randomizing changes in imagery to create the illusion of motion and transformation. Computer animations can use less information space (computer memory) by automatically tweening, a process of rendering the key changes of an image at a specified or calculated time. These key poses or frames are commonly referred to as keyframes. Adobe Flash uses computer animation tweening as well as frame-by-frame animation and video.', 'Customer Market', 'Market Access & Timing', 'Economic Trends', 'Technology', 'IP', 'Future PLans', 'Idea Develpoment', '40000', 'Cash Flow', 'uploads/project/3-February-6-2012-6-30-26-pm-jv.jpg', '2012-03-13 01:30:20', '2012-10-10 0:59:48', 'uploads/project/3-February-6-2012-6-30-26-pm-Motion Graphics Reel - Evan Larimore.mp4', 1, 0, 286, 1, 0, 0, 0),
(7, 27, 3, 'asd update and update long agains title', 'asdasd update and update long title again', 'asdasdas update', 'dasdas update', 'asdasd update', 'asdasd update', 'asdasd update', 'adasd update', 'adasda update', 'asdasd update', '2000000', 'adasd update', 'uploads/project/lbos.png', '2012-03-14 15:04:15', '2012-10-10 0:59:48', 'NULL', 1, 0, 652, 1, 0, 0, 0),
(9, 14, 1, 'Sample Project Transformers', 'Sample Project Transformers', 'Sample Project Transformers', 'Sample Project Transformers', 'Sample Project Transformers', 'Sample Project Transformers', 'Sample Project Transformers', 'Sample Project Transformers', 'Sample Project Transformers', 'Sample Project Transformers', '2000', 'Sample Project Transformers 1\r\nSample Project Transformers 2', 'uploads/project/Nemesis-Prime-Henkei-Transformers-Custom.jpg', '2012-03-28 04:28:52', '2012-10-10 0:59:48', 'NULL', 0, 0, 60, 1, 0, 0, 0),
(10, 3, 1, 'A Cautionary Tail', 'A Cautionary Tail is an animated short film starring Cate Blanchett, David Wenham and Barry Otto. Directed by Simon Rippingale, the film is based on a children''s story by writer Erica Harrison.\r\n\r\nThrough a collage of 3D animated characters and hand-made miniature sets, we follow the story of a girl born with a tail that expresses her emotions. A dark, funny fable about learning to treasure the things that make us unique, the film is animated by world-class CGI artists and features an original score by Michael Yezerski, composer for the Academy Award-winning short, The Lost Thing.\r\n\r\nEveryone working on A Cautionary Tail has sacrificed something to make this film possible, but we need to raise funds to finish the animation. We''ve managed to raise enough money to make a trailer, which you can view on our website. Now we''re hoping you''ll get involved to help us finish the 13-minute film.\r\n\r\nOur goal of $40,000 will fund animation production. Additional funding will enable us to go into lighting and compositing so we can finish the film. To show our gratitude, the first 1,000 supporters to donate will have their names added to our limited-edition poster, which will be available for download online.\r\n\r\nFor more information and a sneak preview behind the scenes, check out our video. From everyone working on A Cautionary Tail, thanks for your support.', '3D Animation', 'Childrens and adults that want to have fun and enjoy their movie', 'In two weeks time as the animation will be published world wide on this May.', 'Movie watchers', '3D animation that adapt high animation and rendering skills ', 'All rights are reserved by our company', 'The 3D animation is trending right now. So there will be no problem on marketing this product. ', 'The quality and rendering skill are as par of Disney Pixar.', '15000', 'Animator - RM2000\nRenderer - RM3000\nTools and Application - RM10000', 'uploads/project/photo-full.jpg', '2012-04-24 13:15:33', '2012-10-10 0:59:48', 'NULL', 0, 0, 83, 1, 0, 0, 0),
(11, 26, 1, 'Removable Vinyl Floor Tiles', 'acet Collection is the newest material exploration by Process + Content, bringing vinyl to the floor, in a interactive + customizable tiling system, featuring bold, geometric designs. Fools Gold, is the first color combination of the Facet Collection, the 3 diamond shaped tiles come in matte white, matte black + mirrored gold. The diamonds are precision cut to meet seamlessly with the sides of each of the 3 shapes. The application of the thin tiles to the floor is meant to delineate space, riffing off of inlayed wood + tile, of classically designed + constructed buildings. They add color + pattern, in a clean + graphic way, with modern design + an undertone of whimsy.', 'Tiling', 'As a designer, exploring mediums + applications is an investment of hours. Arriving at a final process + resolved product is financially costly. Up to this point, I have cut my product by hand, which is labor intensive + leaves room for error. Kickstarter would finance three dies to be made, improving accuracy, shortening production time + ultimatley lowering costs.', 'In 1 month time', 'New age of floor tiling', 'Vinyl', 'Small quantities of Facet will only be available on Kickstarter. The semi + full sets are shown below the projected retail price. So buying now, saves later.', 'Preorder #s will serve as a small market test for retail buyers. Product shots will serve as a marketing tool. Precisely cut samples will be able to be sent out to retailers.', 'When applied, natural wear will occur, leaving your unique imprint on the product + space. Traffic volume + exposure to the elements (specifically water) will dictate much of the lifespan. A clean surface will give Facet the best start. You can expect Facet to \\', '4000', 'Production of 3 Custom dies Purchasing entire rolls of vinyl material Product packaging - recycled cardboard sleeves Hand silkscreening the cardboard sleeves Grouping + sealing tile series for interior packaging Shipping costs + materials Kickstarter + Amazon processing fees Product shots', 'uploads/project/photo-full-1.jpg', '2012-04-24 13:30:26', '2012-10-10 0:59:48', 'NULL', 1, 0, 80, 1, 0, 0, 0),
(12, 27, 1, 'Pebble E-Paper Watch for iPhone and Android', 'Pebble is the first watch built for the 21st century. It\\''s infinitely customizable, with beautiful downloadable watchfaces and useful internet-connected apps. Pebble connects to iPhone and Android smartphones using Bluetooth, alerting you with a silent vibration to incoming calls, emails and messages. While designing Pebble, we strove to create a minimalist yet fashionable product that seamlessly blends into everyday life.', 'Technology', 'Anyone that is interested with the latst technology', 'Pebble can change instantly, thanks to its brilliant, outdoor-readable electronic-paper (e-paper) display. We\\''ve designed tons of watchfaces already, with more coming every day. Choose your favourite watchfaces using Pebble\\''s iPhone or Android app. Then as the day progresses, effortlessly switch to the one that matches your mood, activity or outfit.', 'The integration of watch with smart phone technology', 'Smartphone technology on your wrist', 'All rights are reserved', 'Everyone will have better watch with smarter technology on the go', 'Pebble connects by Bluetooth to your iPhone or Android device. Setting up Pebble is as easy as downloading the Pebble app onto your phone. All software updates are wirelessly transmitted to your Pebble.\r\n\r\nCompatibility\r\n\r\niPhone 3GS, 4, 4S running iOS 5 or any iPod Touch with iOS 5.\r\n\r\nAndroid devices running OS 2.3 and up. Works great with Android 4.0 (Ice Cream Sandwich)!\r\n\r\nUnfortunately Pebble does not work with Blackberry, Windows Phone 7, or Palm phones at this time.', '100000', '$99 - Early Bird: 200 Black watches available. $115 - One Black Pebble. $125 - One Color Pebble. $220 - Two Black Pebbles. $235 - Prototype Pebble for early app development + one Color Pebble. $240 - Two Color Pebbles. $550 - Five Color Pebbles. $1000 - Ten Color Pebbles. $1,250 - Custom watchface + five Color Pebbles.', 'uploads/project/trio2.jpg', '2012-04-24 13:41:19', '2012-10-10 0:59:48', 'NULL', 0, 0, 69, 1, 0, 0, 0),
(19, 2, 10, 'Drifter Space Game', 'A game on space exploration', '3D futuristic game for all people', 'Kids, and all space explorer', 'In about 2 months time, this project will be up and running, free of bugs', 'People like to play interactive game that they can interact with the game itself', '3d game with lots of multimedia effects', 'All rights reserved by Drifter', 'To develop even larger scope of game that can socialize people all around the world', 'Space exploration is currently hot in the market', '100000', '50000 - Computer with high end spec\r\n20000 - Salary for 2 programmers\r\n30000 - Other related stuffs', 'uploads/project/drifter.jpg', '2012-05-09 03:03:52', '2012-10-10 0:59:48', 'NULL', 0, 0, 0, 0, 0, 0, 0),
(37, 2, 9, 'Fresh Milk My Goat', 'Susu kambing kaya dengan protien, enzim dan mengandungi faktor anti penuaan, antiarthritis serta antibarah. Ia mengandungi antibodi untuk merawat penyakit gastrik, demam kuning, lelah, penyakit kulit, memulih tenaga batin, sakit jantung peringkat awal, ulser perut serta membantu dalam pembentukan tulang dan gigi serta berbagai lagi penyakit kerana susu kambing merupakan makanan tambahan yang baik untuk kesihatan. ANtara kebaikan lain susu kambing ialah:\r\nTidak menyebabkan alahan.\r\nMembantu sistem imunisasi tubuh.\r\nBersifat alkali.\r\nMeningkatkan daya kepekaan, penumpuan dan ingatan.\r\nMembantu sistem penghadaman.\r\nMenguatkan jisim tubuh yang sihat (tulang, otot, sendi, kulit & tisu saraf).\r\nTidak mengandungi Protein Kompleks (Alpha-casein & Beta-casein Protein) yang menjadi penyebab utama alahan.\r\nKandungan gizi dalam susu kambing lebih tinggi berbanding dalam susu lembu:\r\n  > Protein 2.1 kali ganda\r\n  > Kalsium 2.2 kali ganda\r\n  > Zat Besi 2.0 kali ganda\r\n  > Potasium 2.1 kali ganda\r\n  > Vitamin A 3.8 kali ganda\r\n  > Garam Galian 2.0 kali ganda\r\n  > Selenium paling tinggi berbanding semua jenis susu\r\nKandungan Asid Lemak Rantaian Pendek dalam susu kambing lebih tinggi berbanding dalam susu lembu.\r\nMolekul Lemak dalam susu kambing lebih halus & mudah dihadam berbanding susu lembu.\r\nProses pencernaan untuk susu kambing hanya memerlukan 20 minit sahaja berbanding susu lembu yang memerlukan lebih 2 jam.\r\nSama seperti susu ibu pH susu kambing beralkali berbanding susu lembu yang asidik.', 'Susu kambing', 'Public', '12 Bulan', 'Susu kambing', 'Susu kambing', 'Susu kambing', 'Susu kambing', 'Susu kambing', '20000', 'Susu kambing', 'uploads/project/myg.jpg', '2012-09-21 15:49:43', '2012-10-20 0:59:48', '', 0, 0, 77, 1, 0, 0, 0),
(38, 22, 1, 'Traditional Ukiran Melayu tulen', 'Seni ukiran kayu adalah seni kraftangan yang telah lama wujud di kalangan masyarakat Malaysia terutama bagi masyarakat Melayu, masyarakat etnik Sabah dan Sarawak serta masyarakat Orang Asli. Seni ukiran yang dipersembahkan melalui bahan kayu ini sama seperti seni ukiran yang lain cuma berbeza dari segi cara dan teknik pengukirannya. Seni ini begitu berkembang luas kerana Malaysia merupakan sebuah negara yang mempunyai hasil kayu-kayan yang banyak di mana terdapat kira-kira 3000 spesis kayu-kayan di negara kita.', 'Business Model', 'Public', 'A Cross malaysia', 'economic trends', 'Technology', 'IP', 'Art and Creative', 'Originality', '15000', 'Cash Flow', 'uploads/project/18469667.jpg', '2012-09-23 15:49:13', '2012-10-07 11:49:13', 'NULL', 0, 0, 335, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mj_idea_category`
--

CREATE TABLE IF NOT EXISTS `mj_idea_category` (
  `id_cat_id` int(10) NOT NULL AUTO_INCREMENT,
  `id_cat_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id_cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `mj_idea_category`
--

INSERT INTO `mj_idea_category` (`id_cat_id`, `id_cat_name`) VALUES
(1, '<p>Kitchen</p>'),
(2, '<p>Toys</p>'),
(3, '<p>Home Decor</p>'),
(4, '<p>Lawn &amp; Garden</p>'),
(5, '<p>Electronics</p>'),
(6, '<p>Organization</p>'),
(7, '<p>Fitness</p>'),
(8, '<p>Accessories</p>'),
(9, '<p>Pets</p>'),
(10, '<p>Others</p>');

-- --------------------------------------------------------

--
-- Table structure for table `mj_idea_comment`
--

CREATE TABLE IF NOT EXISTS `mj_idea_comment` (
  `id_comment_id` int(10) NOT NULL AUTO_INCREMENT,
  `id_usr_id_fk` int(10) NOT NULL,
  `id_comment_body` varchar(250) NOT NULL,
  `id_comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_post_id_fk` int(10) NOT NULL,
  PRIMARY KEY (`id_comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `mj_idea_comment`
--

INSERT INTO `mj_idea_comment` (`id_comment_id`, `id_usr_id_fk`, `id_comment_body`, `id_comment_date`, `id_post_id_fk`) VALUES
(1, 1, 'Nice Idea', '2012-02-07 19:59:11', 5),
(2, 1, 'We should make this!', '2012-02-07 20:00:56', 4),
(3, 1, 'Smart!', '2012-02-07 20:10:09', 2),
(4, 1, 'Look good!', '2012-02-07 20:10:27', 1),
(5, 2, 'Yeah. how bout the price?', '2012-02-16 07:21:22', 2),
(6, 2, 'this price about RM5rat', '2012-02-16 07:22:33', 1),
(7, 2, 'When?', '2012-02-26 12:34:26', 4),
(8, 24, 'i place for 500. is it ok?', '2012-02-27 03:21:53', 2),
(9, 1, 'Ok. kat mana nk dpt ni?', '2012-02-27 08:56:06', 2),
(10, 14, 'nice idea!', '2012-03-09 22:11:47', 4),
(11, 2, 'testing', '2012-05-07 03:40:30', 38),
(12, 43, 'Takda seni', '2012-06-11 05:55:49', 33),
(13, 2, 'memerlukan komen membina, positif @ negative bagi tujuan untuk meninjau/mendapat pendapat semua pihak tentang idea/invoasi baru yang saya ingin laksanakan untuk perusahan kecil saya ini. terima kasih', '2012-09-24 01:39:16', 59);

-- --------------------------------------------------------

--
-- Table structure for table `mj_idea_media`
--

CREATE TABLE IF NOT EXISTS `mj_idea_media` (
  `mim_id` int(11) NOT NULL AUTO_INCREMENT,
  `mim_path` text NOT NULL,
  `mi_id_fk` int(11) NOT NULL,
  `mim_type` int(11) NOT NULL,
  PRIMARY KEY (`mim_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=144 ;

--
-- Dumping data for table `mj_idea_media`
--

INSERT INTO `mj_idea_media` (`mim_id`, `mim_path`, `mi_id_fk`, `mim_type`) VALUES
(54, 'uploads/ideas/idea3gsmartphones_231749218317_640x360.jpg', 27, 1),
(55, 'uploads/ideas/creative-idea-the-library-bookshelf.jpg', 28, 1),
(56, 'uploads/ideas/Axel-Schaefer-Creative-Idea-588x352.jpg', 28, 1),
(57, 'uploads/ideas/Wildlife.mp4', 28, 2),
(59, 'uploads/ideas/Anonymous_Flag.png', 3, 1),
(60, 'uploads/ideas/lbos.png', 3, 1),
(61, 'uploads/ideas/perakniaga.jpg', 3, 1),
(62, 'uploads/ideas/anon.jpg', 2, 1),
(64, 'uploads/ideas/DSC_0039 copy.jpg', 1, 1),
(65, 'uploads/ideas/hanger.jpg', 1, 1),
(66, 'uploads/ideas/bumerang-trouser-hanger__42332_PE137009_S4.jpg', 1, 1),
(67, 'uploads/ideas/campus-of-the-future-main_IdnGE_5784.jpg', 29, 1),
(68, 'uploads/ideas/campus-of-the-future-main_IdnGE_5784.jpg', 29, 1),
(69, 'uploads/ideas/Top-Design-View-Bright-Idea-Concept-Kitchen-Design-Luxury-Future.jpg', 29, 1),
(70, 'uploads/ideas/food1.jpg', 30, 1),
(71, 'uploads/ideas/food1.jpg', 30, 1),
(72, 'uploads/ideas/defq_new_title.jpg', 15, 1),
(73, 'uploads/ideas/defq_new_title.jpg', 15, 1),
(74, 'uploads/ideas/pLEVI1-9054701_outfitmain_t330x400.jpg', 30, 1),
(75, 'uploads/ideas/pLEVI1-9054701_outfitmain_t330x400.jpg', 30, 1),
(76, 'uploads/ideas/Justin Regan Phone Case.png', 31, 1),
(80, 'uploads/ideas/perfect party gift.jpg', 32, 1),
(81, 'uploads/ideas/ice drops for your drinks.jpg', 32, 1),
(82, 'uploads/ideas/Product__Secondary_01-1.jpg', 33, 1),
(83, 'uploads/ideas/Product__Secondary_06.jpg', 33, 1),
(84, 'uploads/ideas/fader1.jpg', 34, 1),
(85, 'uploads/ideas/fader2.jpg', 34, 1),
(86, 'uploads/ideas/swoop1.jpg', 35, 1),
(87, 'uploads/ideas/swoop2.jpg', 35, 1),
(88, 'uploads/ideas/swoop3.jpg', 35, 1),
(89, 'uploads/ideas/cookie1.jpg', 36, 1),
(90, 'uploads/ideas/cookie2.jpg', 36, 1),
(91, 'uploads/ideas/cookie3.jpg', 36, 1),
(92, 'uploads/ideas/lift1.jpg', 37, 1),
(93, 'uploads/ideas/lift2.jpg', 37, 1),
(94, 'uploads/ideas/lift3.jpg', 37, 1),
(95, 'uploads/ideas/aroma1.jpg', 38, 1),
(96, 'uploads/ideas/aroma2.jpg', 38, 1),
(97, 'uploads/ideas/stepper1.jpg', 39, 1),
(98, 'uploads/ideas/stepper2.jpg', 39, 1),
(99, 'uploads/ideas/stepper3.jpg', 39, 1),
(100, 'uploads/ideas/clip1.jpg', 43, 1),
(101, 'uploads/ideas/clip2.jpg', 43, 1),
(102, 'uploads/ideas/clip3.jpg', 43, 1),
(103, 'uploads/ideas/', 0, 1),
(104, 'uploads/ideas/', 0, 2),
(105, 'uploads/ideas/', 0, 1),
(106, 'uploads/ideas/', 0, 1),
(107, 'uploads/ideas/', 0, 1),
(108, 'uploads/ideas/', 0, 1),
(109, 'uploads/ideas/', 0, 1),
(110, 'uploads/ideas/', 0, 1),
(111, 'uploads/ideas/', 0, 1),
(112, 'uploads/ideas/', 0, 1),
(113, 'uploads/ideas/', 0, 1),
(114, 'uploads/ideas/', 0, 1),
(115, 'uploads/ideas/', 0, 1),
(116, 'uploads/ideas/', 0, 2),
(117, 'uploads/ideas/', 0, 2),
(118, 'uploads/ideas/', 0, 2),
(119, 'uploads/ideas/', 0, 2),
(120, 'uploads/ideas/', 0, 2),
(121, 'uploads/ideas/', 0, 2),
(122, 'uploads/ideas/', 0, 2),
(123, 'uploads/ideas/', 0, 2),
(124, 'uploads/ideas/', 0, 2),
(125, 'uploads/ideas/', 0, 2),
(126, 'uploads/ideas/', 0, 2),
(127, 'uploads/ideas/', 0, 1),
(128, 'uploads/ideas/', 0, 2),
(129, 'uploads/ideas/', 0, 1),
(130, 'uploads/ideas/', 0, 2),
(131, 'uploads/ideas/', 0, 1),
(132, 'uploads/ideas/', 0, 2),
(133, 'uploads/ideas/', 0, 1),
(134, 'uploads/ideas/ki-1.jpg', 59, 1),
(135, 'uploads/ideas/ki-2.jpg', 59, 1),
(136, 'uploads/ideas/ki-3.jpg', 59, 1),
(137, 'uploads/ideas/kay1.jpg', 60, 1),
(138, 'uploads/ideas/kay2.jpg', 60, 1),
(139, 'uploads/ideas/kay3.jpg', 60, 1),
(140, 'uploads/ideas/', 0, 2),
(141, 'uploads/ideas/', 0, 1),
(142, 'uploads/ideas/', 0, 2),
(143, 'uploads/ideas/', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `mj_idea_post`
--

CREATE TABLE IF NOT EXISTS `mj_idea_post` (
  `id_post_id` int(10) NOT NULL AUTO_INCREMENT,
  `id_title` varchar(255) NOT NULL,
  `id_usr_id_fk` int(10) NOT NULL,
  `id_dateposted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_pictures` text NOT NULL,
  `id_cat_id_fk` int(10) NOT NULL,
  `id_cur_problem` varchar(255) NOT NULL,
  `id_cur_solution` varchar(255) NOT NULL,
  `id_desc` text NOT NULL,
  `id_trget_cust` varchar(255) NOT NULL,
  `id_features` text NOT NULL,
  `id_smlar_product` text NOT NULL,
  `id_rat_up` int(10) DEFAULT NULL,
  `id_rat_down` int(10) DEFAULT NULL,
  `idea_view` int(11) DEFAULT NULL,
  `id_post_published` int(2) DEFAULT NULL,
  `id_featured` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `mj_idea_post`
--

INSERT INTO `mj_idea_post` (`id_post_id`, `id_title`, `id_usr_id_fk`, `id_dateposted`, `id_pictures`, `id_cat_id_fk`, `id_cur_problem`, `id_cur_solution`, `id_desc`, `id_trget_cust`, `id_features`, `id_smlar_product`, `id_rat_up`, `id_rat_down`, `idea_view`, `id_post_published`, `id_featured`) VALUES
(1, 'Hanger', 22, '2012-03-11 10:05:50', 'uploads/ideas/1-January-27-2012-3-15-18-pm-hanger.jpg', 1, 'Problem', 'Solution', 'Desc', 'Public', 'Features', 'Similar Product', 2, 1, 111, 1, 0),
(2, 'Cool Bottles', 14, '2012-03-13 01:27:44', 'uploads/ideas/1-January-27-2012-3-20-44-pm-bottle.jpg', 1, 'Problem\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aut', 'SOlution\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis au', 'Description\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Market\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute', 'Features\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Product\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 4, 1, 507, 1, 0),
(3, 'Relaxing Chair', 1, '2012-03-13 01:27:57', 'uploads/ideas/1-January-27-2012-3-21-45-pm-chair.jpg', 3, 'Problem\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute ', 'Solution\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute', 'Desc\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Market\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute i', 'Features\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Similar Product\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1, 0, 109, 1, 0),
(4, 'Creative Zip', 1, '2012-03-13 01:29:45', 'uploads/ideas/1-January-27-2012-3-22-39-pm-zip.jpg', 7, 'Problem\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute ', 'Solution\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute', 'Description\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'MArket\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute i', 'Features\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Similar Product\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 13, 0, 72, 1, 0),
(5, 'Wrist Band', 22, '2012-03-14 16:06:21', 'uploads/ideas/1-January-27-2012-3-23-26-pm-band.jpg', 7, 'Problem\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute ', 'Solution\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute', 'Desc\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Market\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute i', 'Features\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Product\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0, 1, 94, 1, 0),
(15, 'new title', 1, '2012-03-11 10:05:50', 'uploads/ideas/defq_new_title.jpg', 1, '<p>new solution</p>', '<p>new solution</p>', '<p>new desc</p>', '<p>new market</p>', '<p>new features</p>', '<p>new smilar product</p>', 0, 0, 42, 1, 0),
(27, 'asdaaaa', 26, '2012-03-11 10:05:50', 'uploads/ideas/idea3gsmartphones_231749218317_640x360.jpg', 1, '<p>asdasda</p>', '<p>asdasda</p>', '<p>asd</p>', '<p>a</p>', '<p>asdasd</p>', '<p>HTC, Android</p>', 0, 0, 48, 1, 0),
(28, 'Creative Chair Wooden', 1, '2012-03-14 15:46:27', 'uploads/ideas/Axel-Schaefer-Creative-Idea-588x352.jpg', 1, 'cip', 'cis', 'cid description', 'citm', 'cif', 'cisp', 0, 0, 93, 1, 0),
(29, 'Future Phone', 27, '2012-03-26 03:12:57', 'uploads/ideas/campus-of-the-future-main_IdnGE_5784.jpg', 10, '<p>The Solution Lack</p>', '<p>The Solution Lack</p>', '<p>Future Phone</p>', '<p>Public World market</p>', '<p>The Features</p>', '<p>iPhone</p>', 0, 0, 118, 1, 0),
(31, 'Mobile Phone Case', 23, '2012-04-24 13:50:53', 'uploads/ideas/Justin Regan Phone Case.png', 1, 'For some time now I''ve noticed people shooting video on their mobile phones. The issue I''ve noticed is the that most shoot the video in a ''portrait'' orientation. The biggest issue with this is when/if they chose to watch the video on a tv then it''s not id', 'The \\''solution\\'' I have discovered would be a case with built in, fold out handle. The handle would make it easy and stable for \\''standard landscape\\'' filming.\n\nThis product could be made out of moulded plastic and may or may not require an incorporated', 'Convert your phone into a camcorder by using our innovation that will help you shoot video without shaky hands', 'Anyone with a mobile phone', 'No need to carry attachments', 'None', 0, 0, 105, 1, 0),
(32, 'How cool is that? ', 25, '2012-04-24 13:59:23', 'uploads/ideas/perfect party gift.jpg', 1, 'You got the perfect cocktail in your hand, but the ice cubes dilute the taste after a while. Of course you could use the funny plastic cubes that don\\''t melt, but it\\''s a bit awkward have them swimming in your drink and honestly: who has enough of them in', 'Ice Drops stick to the bottom of your glass, you refill them with crushed ice as often as you need. No melting ice in your drink, no concerns about water quality. Looks cool and helps you recognize your glas', 'Keep your drinks cool', 'From consumers to product manfacturers', 'Fits into every glass\r\n\r\nRefill with crushed ice as often as you need\r\n\r\nNo melting ice in your drink\r\n\r\nNo concerns about water quality\r\n\r\nAlways recognize your glass\r\n\r\nPerfect gift', 'Ice cubes - dilute the taste of your drink after a while\r\n\r\nPlastic ice cubes - you need new cold cubes for every drink', 0, 0, 53, 1, 0),
(33, 'Tackits', 3, '2012-04-26 05:46:22', 'uploads/ideas/Product__Secondary_06.jpg', 6, 'Hard to use the traditional type tack pin', '- Corkscrew-style pin twists into place for a more sturdy hold\r\n- Easy to remove with a counter-clockwise twist\r\n- Unique head shape allows easy turning, hanging, and threading for crafty possibilities\r\n- Perfect for cork, drywall, and soft wood\r\n- One pa', 'Plain old pushpins? Screw â€˜em! Introducing Tackits - the tack with a twist. The impetus behind this innovation is simple; regular tacks fall easily out of the wall or bulletin boards. Tackits\\'' corkscrew design twists into most any surface and provides a secure mount for the heaviest of Hallmark cards and monthly calendars. And with another flick of the wrist, you can cleanly remove Tackits and reuse as needed.', 'Office users', '- Polypropylene plastic head\r\n- Steel pin', 'None', 0, 0, 33, 1, 0),
(34, 'Fader', 24, '2012-04-26 05:51:18', 'uploads/ideas/fader1.jpg', 6, 'Normal highlighter ink will stay on the paper forever', 'The average college student will spend $1,168 on textbooks over the course of four years of schooling. Selling back your books is a great way to recoup your cash, but itâ€™s hard to keep them looking mint. Fader is a highlighter with ink that fades comple', 'The average college student will spend $1,168 on textbooks over the course of four years of schooling. Selling back your books is a great way to recoup your cash, but itâ€™s hard to keep them looking mint. Fader is a highlighter with ink that fades completely after five months. Feel free to mark up your books with Fader, ace your exams, and return them to the university bookstore for a sweet payday. Itâ€™ll be the highlight of your semester!', 'Office users, students, lecturers', '- Plastic body and lid\r\n- Brushed metal clip', 'None', 0, 0, 41, 1, 0),
(35, 'Swoop', 27, '2012-04-26 05:54:42', 'uploads/ideas/swoop1.jpg', 1, 'Normal hangers will not protect our clothes from dust and can easily drop to the floor', '', '', 'Anyone', '-Rotational stainless steel hook\r\n-Plastic hanger body\r\n-Stainless steel wire\r\n-EVA padding', 'Normal hangers', 0, 0, 32, 1, 0),
(36, 'Cookie Keeper', 2, '2012-04-26 05:58:09', 'uploads/ideas/cookie1.jpg', 1, 'Need to change the baking tray and it is not usable to transport anywhere.', '', 'Keep Your Edibles Incredible', 'Housewifes, bakers, hotels', '- Removable silicone trays\r\n- Oven-safe\r\n- Lightweight plastic outer case\r\n- Lockable cover\r\n- Rotating handle\r\n- Circular imprints for cookie placement', 'None', 0, 0, 68, 1, 0),
(37, 'Lift', 24, '2012-04-26 06:08:21', 'uploads/ideas/lift2.jpg', 8, 'When traveling, it is a burden to carry your large luggage and there is no extra support for you to hold', 'Lift is an adjustable, heavy duty t-strap that secures around a suitcase in both directions and adds extra handles for easy lifting. A seatbelt-style buckle makes it easy to attach and remove the straps, and the front plate displays a luggage tag. Packing', 'Leverage Your Luggage', 'Everyone that likes travelling', '-Heavy duty t-strap secures suitcase both horizontally and vertically\r\n-Strap can be tightened around small and large suitcases\r\n-Fasteners hold strap securely in place\r\n-4 attached handles with adjustable placement to help with lifting\r\n-Seatbelt-style buckle makes it easy to attach and remove straps\r\n-1 embedded luggage tag', 'None', 0, 0, 63, 1, 0),
(38, 'Aroma', 3, '2012-04-26 06:12:46', 'uploads/ideas/aroma1.jpg', 1, 'No space to sort out all of your favorite coffees and teas. ', 'It\\''s time to streamline your coffee routine! Aroma is an all-in-one organizer that stores coffee pods and accessories like stirrers, spoons, sugar, and creamers within easy reach. The sleek bamboo pieces can be stacked in whatever configuration fits your', 'The Morning Line-Up', 'Everyone', '-5 bamboo coffee pod holders (each holds 4 pods, for a total capacity of 20 pods)\r\n-1 open bamboo box to nestle ceramic containers and support pod holders\r\n-2 gloss-finished ceramic containers for accessories like stirrers, spoons, sugar, and creamers\r\n-6 clip-on plastic feet for stability\r\n-10 plastic connectors which slip securely into grooves to hold bamboo pieces in place', 'None', 0, 0, 56, 1, 0),
(39, 'Stepper', 27, '2012-04-26 06:15:17', 'uploads/ideas/stepper2.jpg', 6, 'To many shoes to carry around but your hands is full and you have no time to take all at the same time', 'Stepper is a minimalist, lightweight shoe rack that folds flat for easy storage and transport. Finally â€“ shoe organization that combines both form and function in one portable package!', 'Organize your shoes', 'Everyone', '- Bi-level rack stores up to six pairs of shoes.\r\n- Folds flat for convenient storage.\r\n- Lightweight, easy-to-clean plastic construction, with rubber lining on the shoe supports.\r\n- Easy to transport the entire rack with shoes intact.', 'None', 0, 0, 65, 1, 0),
(43, 'Cliplets', 2, '2012-05-08 07:04:06', 'uploads/ideas/clip2.jpg', 6, 'Easy to break', 'A new tough steel to replace the current paper clip material', 'New way to clip your paper', 'Office user, school children, paper organizer', 'Tougher steel + plastic for easier grip', 'Paper clip', 0, 0, 0, 0, 0),
(59, 'Pembungkusan Susu Kambing Moden', 2, '2012-09-21 15:37:46', 'uploads/ideas/susu-kambing-ettawa-fresh.jpg', 10, 'Kurang Khasiat pemakanan', 'Senang di bawa dan dalam paket yang mudah untuk di beli', 'Susu kambing kaya dengan protien, enzim dan mengandungi faktor anti penuaan, antiarthritis serta antibarah. \r\n\r\nIa mengandungi antibodi untuk merawat penyakit gastrik, demam kuning, lelah, penyakit kulit, memulih tenaga batin, sakit jantung peringkat awal, ulser perut serta membantu dalam pembentukan tulang dan gigi serta berbagai lagi penyakit kerana susu kambing merupakan makanan tambahan yang baik untuk kesihatan. ANtara kebaikan lain susu kambing ialah:\r\n\r\nTidak menyebabkan alahan.\r\nMembantu sistem imunisasi tubuh.\r\nBersifat alkali.\r\nMeningkatkan daya kepekaan, penumpuan dan ingatan.\r\nMembantu sistem penghadaman.\r\nMenguatkan jisim tubuh yang sihat (tulang, otot, sendi, kulit & tisu saraf).\r\nTidak mengandungi Protein Kompleks (Alpha-casein & Beta-casein Protein) yang menjadi penyebab utama alahan.\r\nKandungan gizi dalam susu kambing lebih tinggi berbanding dalam susu lembu:\r\n  > Protein 2.1 kali ganda\r\n  > Kalsium 2.2 kali ganda\r\n  > Zat Besi 2.0 kali ganda\r\n  > Potasium 2.1 kali ganda\r\n  > Vitamin A 3.8 kali ganda\r\n  > Garam Galian 2.0 kali ganda\r\n  > Selenium paling tinggi berbanding semua jenis susu\r\nKandungan Asid Lemak Rantaian Pendek dalam susu kambing lebih tinggi berbanding dalam susu lembu.\r\nMolekul Lemak dalam susu kambing lebih halus & mudah dihadam berbanding susu lembu.\r\nProses pencernaan untuk susu kambing hanya memerlukan 20 minit sahaja berbanding susu lembu yang memerlukan lebih 2 jam.\r\nSama seperti susu ibu pH susu kambing beralkali berbanding susu lembu yang asidik.', 'Orang Lama, Orang bersukan', '> Protein 2.1 kali ganda\r\n  > Kalsium 2.2 kali ganda\r\n  > Zat Besi 2.0 kali ganda\r\n  > Potasium 2.1 kali ganda\r\n  > Vitamin A 3.8 kali ganda\r\n  > Garam Galian 2.0 kali ganda\r\n  > Selenium paling tinggi berbanding semua jenis susu', 'Hi Goat, Susu Kambing', 0, 0, 38, 1, 0),
(60, 'Ukiran Kayu Traditional', 22, '2012-09-23 15:42:58', 'uploads/ideas/Ukir1.jpg', 3, 'Hilangnya Traditional', 'Mengembalikan traditional ukiran', 'Ukiran kayu traditional untuk apa sahaja jenis kegunaan', 'Semua pengguna', 'Unik, menarik, kayu jati asli', 'Ukiran-ukiran', 0, 0, 64, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mj_idea_price`
--

CREATE TABLE IF NOT EXISTS `mj_idea_price` (
  `ip_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_id_fk` int(11) NOT NULL,
  `mrket_post_id_fk` int(11) NOT NULL,
  `ip_price` int(7) NOT NULL,
  `ip_date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ip_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `mj_idea_price`
--

INSERT INTO `mj_idea_price` (`ip_id`, `usr_id_fk`, `mrket_post_id_fk`, `ip_price`, `ip_date_posted`) VALUES
(2, 1, 5, 200, '2012-02-26 12:13:34'),
(3, 1, 5, 250, '2012-02-26 12:19:29'),
(4, 1, 5, 240, '2012-02-26 12:20:39'),
(5, 2, 5, 199, '2012-02-26 12:22:15'),
(6, 2, 5, 180, '2012-02-26 12:23:15'),
(7, 2, 3, 2000, '2012-02-26 12:23:46'),
(8, 2, 3, 1999, '2012-02-26 12:24:14'),
(9, 2, 4, 200, '2012-02-26 12:34:08'),
(10, 24, 2, 500, '2012-02-27 03:21:18'),
(11, 14, 4, 2000, '2012-03-09 22:11:37'),
(25, 0, 0, 0, '2012-07-12 20:36:14'),
(26, 0, 0, 0, '2012-09-04 23:57:48'),
(27, 0, 0, 0, '2012-09-16 16:09:40'),
(28, 0, 0, 0, '2012-10-31 07:30:26');

-- --------------------------------------------------------

--
-- Table structure for table `mj_learn_article`
--

CREATE TABLE IF NOT EXISTS `mj_learn_article` (
  `la_id` int(10) NOT NULL AUTO_INCREMENT,
  `la_title` varchar(50) NOT NULL,
  `la_body` text NOT NULL,
  `la_visual` text,
  `la_dateposted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `la_article_by` int(10) NOT NULL,
  `la_rat_up` int(10) DEFAULT NULL,
  `la_rat_down` int(10) DEFAULT NULL,
  `la_cat_id_fk` int(10) NOT NULL,
  `la_featured` int(1) DEFAULT NULL,
  `la_published` int(1) DEFAULT NULL,
  PRIMARY KEY (`la_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `mj_learn_article`
--

INSERT INTO `mj_learn_article` (`la_id`, `la_title`, `la_body`, `la_visual`, `la_dateposted`, `la_article_by`, `la_rat_up`, `la_rat_down`, `la_cat_id_fk`, `la_featured`, `la_published`) VALUES
(1, 'Writing Business Requirement Documents', 'Writing a business requirement documents is known to entail a lot of consideration.\r\n<p>But if there is the two-way communication between you and your people, you will surely be able to realize your goals in your projects.\r\nBusiness requirement documents indeed have a lot of uses from the past even until now. Commonly, it has been widely used specifically when it comes to project planning. But nowadays, such documents are used for the development of enterprise software, database as well as websites.</p>\r\n \r\n<p>In writing a business requirements document, one must make sure that he/she must have a preemptive knowledge when it comes to the goals of the project before actually writing it. Of course, this can be fully realized when people are able to have a careful attention to the information that will make the project to be completed</p>\r\n\r\n<p>The first thing that one must do is to have a discovery meeting. Such meeting must include people like stakeholders (customer service representatives, sales force, etc), end users as well as the management. <blockquote>What you must talk about in the meeting are the desired results that you would like attain. Moreover, it would also help if you can do some interviews with these people and get details that you can use for the benefit of the company.</blockquote></p>\r\n\r\n<p>After having your meeting, you can now make a draft or your business requirement documents and pass it over with all the people who attended your meeting. It is best that all of you are able to review all the things written on it. Take comments given by these people as changes that will be for the betterment of the business requirement documents.</p>\r\n\r\n<p>For the most part, there will be revisions that must be given proper attention. After all comments have been given by the people who attended your meeting, collate it over and do the necessary revisions. Moving forward, you can now re-circulate it to people whom are important for the full realization of the projects’ goal with the help of the business requirement documents.\r\nIt is a good way that you start writing your business requirement documents with the help of a template. There are standard templates that you can use so that during the meeting, you will be able to address all the things that must be included in your meeting. This will serve as a roadmap in making you achieve your goals.</p> \r\n \r\n<p>Moreover, it is important that you give particularity when it comes to the continuous updates that will surely come. By doing so, you are avoiding and at the same time protecting yourself from the blames if there are cases where the goals of the projects are not met.</p>', 'uploads/article/cover1.jpg', '2012-01-26 16:00:00', 1, 7, 2, 1, 0, 1),
(2, 'How to Start a Mid Night Club', 'If you look into today''s night life then you can easily comprehend the young generations are more into brew pubs, night clubs, dance clubs and swing clubs. Young couples also don''t want to stay behind, they are also seen more in mid night clubs. Opening a night club is a potential business to think about and invest.\r\nLas Vegas night clubs are classic examples that show there is money in nightlife. The best nightclubs and bars have raised a number of successful entrepreneurs who have cashed in on man’s natural love for night life.\r\nIf you have been thinking to start a new business that you can consider fun and enjoyable, you might want to invest on a bar night club . Starting and running a nightclub, however, is not as easy as it seems. It takes a great deal of preparation and some know-how to establish a successful nightclub business. Here are some things that you have to know before starting a nightclub business:\r\nGet to know what appeals to your clients\r\nAmong the best things that you can do to guarantee success to your local bar is to make sure you are providing the right services like live entertainment and drinks to your clients and the best means to do this is to know what appeals to your clients. Know their tastes and their preferences. The night club industry is an ever evolving business. Pub hoppers of today may not have the same preference for entertainment, food and drinks that night clubbers of the yesteryears wanted. Knowing the current tastes and general favorites of your prospective clients will allow you to make plans for a night club and bar that reflects and expresses the personality and tastes of your clients.\r\nGive your clients reasons to be in your nightclub\r\nIf there are a number of nightclubs in the area, how will you make people go to your nightclub? You can actually make people go to your nightclub by providing them with reasons and intentions to be in your nightclub. You can do this by making people feel special or privileged. While not being necessarily a teen nightclub, for example, you can provide teenagers special discounts during Fridays or you can make your nightclub a dance club or karaoke bar on special days to cater to people who like to dance and sing. It will also be a good idea to establish fixed days of the week to cater to the interests and preferences of different personalities so your guests will know when it is best for them to visit your nightclub.\r\nA nightclub business can be a fun way for you to cash in on people’s love for nightlife. You can be as successful as many nightclub entrepreneurs if you get to know what appeals to your clients and when you give your clients reasons to be in your nightclub.', 'uploads/article/cover2.jpg', '2012-01-26 18:16:27', 1, 11, 0, 1, 0, 1),
(3, 'How to Write Business Thank You Notes to Customers', 'Sending a business thank-you letter to customers is a way of giving your whole-hearted appreciation. This type of business letter show that you have given importance to the client and this result to the improvement of customer restrain.\r\nBusiness thank-you notes is one of the strategies that help your company to gain more customers. Here are some tips on how to write a business thank-you note letter.\r\nThe use of business thank you notes to customers has been neglected by most companies. One effective way in order to get better the customer retention and the effective vocal advertising is through taking the effort and time to write thank-you letters to the customers. Although writing a thank-you letter to the customer can be a time consuming process, it is a very ideal to show your appreciation and to be appreciated by the clients. Preferably, the owner of starting business must be the one who need to write and send a thank-you letter in whole appreciation and sincerity is completely associated with the business. However, writing a thank-you letter is not just like a simple friendly letter. You need to think it about some important things to produce effective thank-you letter to the clients.\r\n \r\nChoose the Right Format\r\n \r\nSelect the right format for the thank-you letter. Since you are using it for your business, it should be written in formal way. Of course, you need to search for business letter format and style. There are various information about business letters on internet, so it won’t difficult for you to find the formal style for the letter. Business letters today are usually printed, but you can show your sincerity and effort if the thank-you letter is personalized and hand written. You should also include a small-thank you card which can be bought in bulk. \r\n \r\nAvoid Using Sale Tone\r\n \r\nDon’t use the sale tone in the note. Although your customer has already ordered or bought a product from you, you should still avoid more sale tone in the note. This could possibly bring a bad impression from the customer. He or she might think feel that you are forcing him or her to buy another product from your company. This is an annoyance for most customers. So, you have stick to your intention by appreciating the customer about his or her loyalty and nothing else. \r\n \r\nMake the Card Special\r\n \r\nFirst impression is very important. In order to feel your appreciation from the card, you have to personalize it. You should begin with the client’s name and then put the date when she or he was in your company. For example, “Dear James, we are glad you have visited our company.” This allows the clients to be ware that he or she is not just unknown person while walking through your door. \r\n \r\nExpress Your Appreciation to the Client\r\n \r\nMake sure you show your sincerity through the use of art of words. Thank the customer with your all heart for his or her purchase and allow him or her to know what you appreciated about. If possible, insert tag lines like ”we are hoping to see you again”. This is a tactic to let them feel their importance as a part of your company. Then, send the letter with an actual stamp.', 'uploads/article/cover3.jpg', '2012-01-26 18:20:20', 1, 1, 1, 1, 0, 1),
(4, 'Tips to Make Your Own Logo', 'A logo is an integral part of a business regardless of its size. It gives identification to the company and shows the future of the company in the business world.\r\nTherefore, it is important to know how to draw your own logo that says all about your business.\r\nStarting a new business needs big amount of money but there are possible ways to cut the costs. Designing a business logo is significant thus it adds cost of starting a business. However, if you have skills in designing you can save money by making and designing your own logo. All you have to do is follow some steps in designing a great logo.\r\n \r\nChoosing Software\r\n \r\nCreating a logo can be both simple and complicated. This means that it depends on the preference of the business owner. Likewise, there are many tools that you can use in designing a logo. In this sense, choosing the right software should be considered. One of the photo editing software that you can use is the Adobe Photoshop.\r\n \r\nCreate Readable Logo\r\n \r\nWhen creating a logo for your business make sure that it is not complicated and readable. That is why you should think for elements that you can use in making simple logos. You can choose to add images or just the name of your company. If you want just to include only the company name in the logo you can use Adobe Photoshop. While using the Adobe Photoshop you can have the chance to choose the fonts that you prefer. On the other hand, you can also look for websites that offer free fonts and download it in your computer.\r\n \r\nAfter choosing the font that suits your company name the next step is to decide whether you will add image to the logo. Just like the fonts you can also download free images from the web. As much as possible choose image that is relevant to the product and services that your company offer. \r\n \r\nMoreover, if you do not want the logo that you personally made, you can opt to browse from different websites and generate your own logo. On the other hand, you can also decide to hire a professional designer who can create your company logo. Keep in mind that hiring professional designer is expensive but you can expect for an attractive logo design.\r\n \r\nIn the same manner, if you want your logo to be made in professional manner it will be a contributing factor for the success of your business. It is not enough just to provide quality products and services because it is also significant to have attractive company logo that will be easily recognized by your customers. IN this way, you can ensure that your customer will not forget your company as well as your products and services.', 'uploads/article/cover4.jpg', '2012-01-26 18:25:16', 1, 0, 0, 1, 0, 1),
(5, 'Tips on Complaining About an Accountant', 'Even though accountants are respected in the world of professions, there are some people who are unfortunate as they come across with a charlatan.\r\nAnd if by chance that they will be unfortunate in such case, there are some ways that they can use in forwarding complaints with regards to their accountant.\r\nIn a corporate setting, the services that are offered by a chartered accountant can never be done away. They are the ones who can help you in coming up with the best decisions when it comes to financial matters. More so, they are big contributors when it comes to decisions that will assure that your business is on the right track. But despite the expertise derived from rigorous trainings as well as examinations, chartered accountants can also make mistake. And with such, there are some misunderstandings between an accountant and their clients.\r\nRising Conflicts Leading to Complaints\r\nThe main reason why there is the surge of complaints between an accountant and their clients is basically rooted in the lack of communication between two parties. Even though there is the possibility of the two parties talking things over, there will always be a time wherein problems are so serious that two parties will be needing mediators, like the Institute of Chartered Accountants, to make sure that complaints will be given proper attention and mediation as well as resolution will be given.\r\nHaving your Complaint/s Heard\r\nIf by chance that you have a complaint that should be heard, you must make sure that you make it heard. It is best advised that you talk first to the accountant as you both discuss the issue or problem. It will be faster also if you will address your concern to the accountancy firm’s senior partner. On the other hand, you can also have the help of the Institute that will later on give you a complaint form. Before sending back the complaint form to the Institute, make sure that you have included all necessary documentation as well as correspondence needed from you.\r\nAfter the phase of you sending all the relevant pieces of information regarding your complaint, the Institute will then acknowledge the receipt of your complaint. Next, they will forward it to an assessor will review your complaint and see to it if what further actions can be taken.\r\nIn the review process of an assessor, he/she will look into the potentiality of disciplinary or liability actions to the accountant and how can it be dealt with. On the other hand, if the assessor deems that your complaint can still be settled without the use of any disciplinary action, then conciliation will be given. In such cases, the Institute of Chartered Accountants will be there along the way to make sure that you are in the right track.', 'uploads/article/cover5.jpg', '2012-01-26 18:26:58', 1, 0, 0, 1, 0, 1),
(6, 'Ways to Become a Forensic Loan Auditor', 'Forensic loan auditor is now becoming an in-demand occupation these days. It actually tackles all the issues regarding the mortgage loans and other related matter. If you love numbers and law then this job is right for you.\r\nIn any type of venture, it is very important that you have the right tool and method to be successful. Read on further to know how to become a successful forensic loan auditor.\r\nWhy Forensic Loan Auditor?\r\n \r\nIf you love working with banks and laws, forensic loan auditor is perhaps the job suited for you. As a forensic loan auditor, it is your task to determine or investigate the errors or downright violations in laws involving loans. If you love to analyze and explore then this field is right for you. The best thing about this job is you can actually practice your skills and ability at the same time help people who are facing great problem about loans.\r\n \r\nOverview of this Job\r\n \r\nThe current debacle or issues that involve predatory lending is growing not just in the U.S. but also in other places, which requires the need to have a people or expert that will investigate and explore it. Individuals who don’t have enough knowledge about the loan laws and are about to have their assets and other properties for foreclosure need the assistance of a forensic loan auditor. If this is not resolved, these people will have to stay homeless. If there’s a forensic loan auditor, it is more likely that this will be barred, if it is proven that the loan is unenforceable, the owner will surely benefit. In order for the auditor to determine this, he or she needs to review the mortgage contract. By reviewing the contract, the auditor can tell if the bank or financial institution has the basis of getting the property legally. \r\n \r\nHow to Start?\r\n \r\nIn order for you to start with this job of course, it is very significant if you can get a certain certification or short crash course about this field. Even if you love banking and laws, if is still recommendable if you have the right knowledge. Maybe you can consult the nearest universities or colleges near your area if they offer similar training or programs. During this training, you will be able to learn the important laws about loans and what is legal and what is not. When you enter a program, make sure that it is supported by the government. After your course, you can now start your new profession.\r\n \r\nYou can start as a freelance forensic loan auditor but for starters, it is ideal way on joining a group of forensic loan auditors or employed on a firm. This helps you to get the clients because the clients will be the one that will look for you.', 'uploads/article/cover6.png', '2012-01-26 18:27:36', 1, 0, 0, 1, 0, 1),
(7, 'How to Become a Sales Agent', 'If you want to become a sales agent, this is your chance. A lot of companies these days are no longer maintaining their own sales force and are relying greatly on sales agents like you.\r\nThis is the perfect time to file applications to the reputable companies out there. If you want, you can even use the internet as a tool to sell various kinds of products and services by having your own website.\r\nThe Job Description of a Sales Agent\r\nAs a sales agent, you have a chance to earn unlimited income. In fact, if you become a full time sales agent, you can enjoy the financial security that comes with it. Almost every individual wants to be his/her own boss and this is possible if you become a sales agent. There are no educational requirements required although you can be at an advantage if you finish a marketing related course in college. You will need to pick a company that offers an attractive incentive or commission program. Some companies even offer their sales agents with dental and medical benefits.\r\nTrainings are usually provided by companies once you pass their application process. Well of course, the requirements may vary from one company to another so you need to determine the qualifications first before you file an application. You should choose the company well and pick one that offers continuous support for sales agents like you. Ongoing programs and workshops should be provided by the company to help you in keeping up with the latest trends in the market. The needs of people vary so it would be best to team up with a company that offers a wide range of services and products. That way, you can offer the right products/services to the right clients.\r\nOther Info for Becoming a Sales Agent\r\nSo far, becoming a sales agent is the cheapest and simplest method. In today’s modern market, a lot of companies no longer want a massive sales force because it’s too costly. These companies are now turning to sales agents because it the most effective way to circulate their product in the online and offline market and less costly too. The sales agents are given a certain percentage for every product sold to customers. If you’re not ready to take the plunge, you can start by becoming a part timer. Start surfing the internet now and look for companies offering business opportunities to sales agents.\r\nSince there are no stringent requirements to become a sales agent, you can easily qualify especially if you possess the skills of a good sales agent. You should be smart, a good communicator, confident, and knowledgeable so that you can easily convince clients to get your products or services of the company that you represent. If you are hard working, you can earn more. Choose the best schedule during the day so that you can have more output. Apply as a sales agent now and start making a lot of money.', 'uploads/article/cover7.jpg', '2012-01-26 18:28:24', 1, 0, 0, 1, 0, 1),
(8, 'How to Start a T-shirt Company', 'As far as the fashion industry is concerned, t-shirts are the most common fashion output that people are used of wearing.\r\nThey find it comfortable and very trendy at the same time.\r\nSetting up your T-shirt Company\r\nThe first thing you should do is to make sure that you have the essential tools and equipment needed in setting up your t-shirt venture. You should have lots of sewing machines. These machines will be the ones that will produce your t-shirt. Of course along with it, there should be t-shirt designers. They will be the ones who will make your t-shirt designs. They are the ones who will give you the idea on what type of t-shirt you will be producing in the industry. T-shirts are almost the same with every single type of t-shirt. The only difference is the type of cloth you used and the designs printed on shirt itself.\r\nNext, you should secure the entire license needed in starting your business venture. They are important because in this world, without a license you are always considered to be operating a business in an illegal way. You do have laws and you should follow those laws to avoid problems. Include your tax ID and other tax related responsibilities in your check list. These are the most essential requisite to make your business in line with the licensed business companies and be legal. Another thing, you should find a good source and supplier. Suppliers for your employees and suppliers for the raw materials you will be using in your company.\r\nDesigning and Selling T-shirts\r\nIn designing t-shirts, you will need the help of a fashion consultant or you might want to hire your very own designer. Having your own designer will definitely be an edge for your company. You will be saving lots of money from it and you will be working closely with them. With your designer, you may come up with t-shirt prints that are very unique and trendy. Most people today are very trendy when it comes to choosing their kind of shirts. They do not just buy a plain shirt. They buy those shirts that have a print on it that would make other people notice them. It is essential in designing shirt prints to take into consideration the attitude and persona of the market group you are going to deal with. For example, if you are targeting the young group of buyers, then maybe you can think of prints that are colourful, feisty, and jolly. You may also think of those cute and trendy prints for them because the young generation of today have already their own kind of fashion statements.\r\nYou may use iron-on transfers to make your t-shirt printing faster and more efficient. Through this, you will no longer hire too many workers in your company because you will need just enough of them to do the job. You will be cost cutting through this since the economy today is very unstable. When you already made your designs and you already had them printed or transferred to the shirt, then you’re ready for business.', 'uploads/article/cover8.jpg', '2012-01-26 18:29:15', 1, 0, 0, 1, 0, 1),
(9, 'How to Start a Woodworking Business', 'Use your woodworking skills and start a lucrative business. The woodworking business is an enjoyable way to make money. This article also offers tips on starting and running a woodworking business.\r\nThe woodworking business is ideal for people who love doing handcrafted woodwork for a hobby.\r\nThere are a lot of highly marketable products nowadays that make use of woodworking techniques. Furniture is a fine example and hand made wooden toys too is becoming a market favorite.\r\nIf you are looking for business opportunities and you possess woodworking skills and talent, then I suggest you explore this industry.\r\nStarting a woodworking business can be simple as long as you are armed with sufficient knowledge. Here are some pointers that may guide you as you embark on starting your own woodworking company.\r\nFirst, figure out what kind of items you want to specialize in i.e. home décor, furniture, toys, etc. The supplies and equipment you invest on will rely primarily on the products you plan to produce.\r\nSecond, look for a good supplier for your wood and equipment needs. Make sure the supplier you choose will give you the best value for money deal. Naturally, you know better than procure sub-standard materials. Doing so will vastly affect the quality of your products and quality is one of the selling points in this business. Typically, you will need to buy clamps, a square, saws, tape measure, hammers, hand drills, and chisels.\r\nThird, look for a space where you can work. If your operation is a small one, your garage or home workshop will do just fine. However, if you plan to launch a big business, then you will need to rent space where you and your craftsmen can manufacture your merchandise. The additional cost for rent and utilities should be computed and used as a consideration when making your price scheme.\r\nFourth, identify your target market and develop a promotional campaign tailor-fit to suit them. There are a lot of ways you can advertise your merchandise. You can post adverts in the internet, or on local bulletin boards, on trade magazines etc. The key is to establish your business in the arena and introduce your name to the market.\r\nFifth, look for a plausible sales channel. A website is a good option because it enables you to reach a wider market. If possible, equip your website with e-commerce capability. Aside from this, you can also participate in trade shows, arts & crafts fairs, and flea markets and so on.\r\nSixth, expound, explore, and discover. Take a look at the trends. Take a look at your competition. Make it a point that your products are better than theirs are. Don’t hamper your creativity and imagination. The best way to establish a niche market is to develop product designs that are uniquely yours. Remember to have these designs copyrighted so nobody else can use them.\r\nSeventh, in manufacturing your products, make sure you and your workers adhere to safety rules. You will be using sharp tools like knives and chisels so to avoid accidents and mishaps, always practice caution.\r\nEight, put your customers first, always. The success of a business doesn’t only depend on the number of customers you entice to your store. What matters is the number of customers you retain. Keep them coming back by giving them the royal treatment.', 'uploads/article/cover9.jpg', '2012-01-26 18:29:54', 1, 0, 0, 4, 0, 1),
(10, 'Tips on Closing a Sale Effectively', 'If you are personally marketing the business and the products you have for your customers, it is important that you are aware of the proper ways on how to close a sale effectively.\r\nBecause of having an idea with the right tactics and tips required, this will lead to the efficiency and productivity of the business.\r\nWhen your aim is to personally advertise the business and the services you have for your customers, it is important that you know the possible ways on how to close the deal. This article will provide you with the most effective tips you can consider. \r\n \r\nSell the Aces of the Products\r\n \r\nOnce you are selling your products and services and you are eager to close the deal with your customer, it is important that you sell the advantages. Keep in mind that what usually disappoints the customers in some deals is when the marketer will open about the disadvantages of the products. Keep in mind that your customer is looking for a superb product, so it will be a major turn off to hear some of the negative sides of the stuffs you are offering. To effectively close the deal, talk more of the benefits of using the product. \r\n \r\nPut Yourself on the Customers’ Shoes\r\n \r\nIf you will put yourself in the shoes of your customers, you can effectively close a deal. Being a customer, you will have lots of doubts and queries about the product you want to purchase. Try to ask yourself if you are the actual customer. By this way, you will know how to tackle the queries of your client and to effectively market the product you are offering as well. So when the same question is asked by your client in the future, you know what to say. \r\n \r\nIdentifying Goals\r\n \r\nDetermining your goals is also among the best ways for you to effectively close a sale. Keep in mind that sales is different from the actual conversation you do with your friends and the people around you. By identifying the exact goal why you need to do effective marketing conversation, you can device the right tone of discussion. Additionally, identify if you are inclined to get a broad net or a higher number of people. By doing this, you will be able what to go about and to tackle the discussion with your client. \r\n \r\nMaking Customers Feel Special\r\n \r\nAs you talk to your customer, make sure that you will make them feel they are special to you. Because of the feeling that they are special to your business, they will somehow be convinced to purchase the product you are offering. The use of the right tone and words also affects the special feeling experienced by your customers. If you will ask for some pieces of advice from your possible customers, they will also tell you the same thing.', 'uploads/article/cover10.jpg', '2012-01-26 18:38:08', 1, 1, 0, 1, 0, 1),
(11, 'Types of Viral Marketing', 'When you plan to establish a business, selling your products or service could be one of your first considerations. Definitely, selling products or services is a great challenge for you especially if you don’t have enough knowledge about marketing. Using the types of viral marketing could be the best way to have an effective marketing.\r\nThe viral marketing can be used by vocal or network effects from the innovation of internet. Viral marketing can also be used through video clips, text messages, and other interactive processes.\r\nWhen you buy a product of a particular establishment and you are satisfied with product, you usually recommend it to your friend and other people who also appreciate the product. And when you give your recommendation, they grab or avail the item. Usually, you express your satisfaction through telling your relatives or friends about the benefits you got from the items or service. Some of them will actually try the same item that you have recommended. This is the viral marketing strategies in which you could successfully advertise the item or service by word-of-mouth without using money on it. This is the process of viral marketing. It is said that it is an advertising strategy that attracts people to pass on selling message to friends and relatives. \r\n \r\nIdea of Viral Marketing\r\n \r\nThe idea of viral marketing of passing along the selling message has been started for a long now. Steve Jurvetson, a business capitalist was the first man who was recognized to use viral marketing to illustrate Hotmail’s selling practice. This practice was designed to use an advertisement of itself on message which is expressed using the service. When a receiver gets attracted and press the ad icon, it will open to hotmail’s site for you to sign up. This process will go on and on and develop is the same to cycle business marketing. From this moment, viral marketing has been developed into different types.\r\n \r\nIncentivised Viral Marketing\r\n \r\nIncentivised viral is the first type of marketing strategy that is used by most businesses in which they offered rewards or incentives when they refer somebody or to recruit to the company. This process becomes more effective when they referred person who intentionally want to get the reward. \r\n \r\nPass-along Strategy\r\n \r\nThis strategy is the most common type of viral marketing. It uses internet wherein the selling process takes on websites. The innovation asks the users to tell-a- friend about the service or products. Most companies use this strategy since it offers a convenient way of marketing. However, the drawback of this strategy is there is a risk of the message being recognized as a spam. The purpose of the spam is to repeatedly remind the users about the service or products being offered. \r\n \r\nBuzz Marketing\r\n \r\nThis strategy is being used in the entertainment world. Controversies is the best example of this strategy since it boost the interest of people such as involving stars of the commercial that not yet released. Buzz marketing aid the business to get the attention of the public people.', 'uploads/article/cover11.jpg', '2012-02-10 03:54:28', 1, 0, 0, 1, 0, 1),
(16, 'How to Start a KFC Franchise', '<p>With more than 500 units of KFC stores in the world and more than 50 percent market shares in the umbrella company, opportunities in KFC investment is ideally good for businessmen who are motivated and dedicated in bringing good service to its customers.</p>\r\n<p>KFC Corp. has started making franchises available in the market in 1952. Since then, the company has established hundreds of store worldwide. Initially, you will need around $25-$30,000 for franchising a store. According to the company website, there was no financing available for first-time owners.</p>\r\n<p>Based on the company website, you and your staff can get free training to develop your skills in handling such food and restaurant business. This training involved shift leading, brand training, and handling different branches in one time. The company, under the Performance Improvement Programs and Support, will also hand out certifications after you and your staff completed the training.</p>\r\n<p>However, the $25,000 franchising fee does not cover all the expenses. You\\\\\\''ll going to have another $1million-$1.8million as capital requirement. The cash based capital is needed for building construction and other equipment to be purchased later on.</p>\r\n<p>The company is also requiring all of its franchisee to commit in building or at least handling 3 more restaurants over a period of three years, which is in the US alone. The location of the store can also be handled by the mother company in order for you to maximize visibility without compromising the profit you\\\\\\''ll get in every store that you put up.</p>\r\n<p>A genius in multibranding, Yum! Brands can also accommodate you\\\\\\''re choice of two brands under of roof. It also gives you the value to your money by combining two leading restaurant names and giving consumers that much needed choice and convenience. Now, they will never have to move from one place to another just to order fast and fresh foods.</p>\r\n<p>The company also has what they called Value Network. This includes programs and staff recognition and support to enable you to compete in advertising terms. Brand recognition alone is a form of advertising so you can be assured that you\\\\\\''re getting more than what you need. Consumer attraction and competitive advantage is gained simply by brand recognition so you don\\\\\\''t have to pay extra money for TV, paper ads.</p>\r\n<p>With all of these factors, the return of investment can be acquired in just a small amount of time.&nbsp;</p>', 'uploads/article/b33.jpg', '2012-04-26 08:03:53', 2, 0, 0, 4, 1, 1),
(17, 'How to Start a Shoe Business', '<p><em><strong>Do you want to start a profitable business and make money? Have you ever thought about a Shoe business? Do you know everyone needs at least one shoe so demand never goes down? In general the profit margins are high in shoe business. Why not learn more on shoe business?</strong></em></p>\r\n<p>Everybody wears shoes. Girls even love collecting them so why not start a shoe business if you look at the prospect of engaging in a retail business? While a shoe business can require considerable start up cost from you, the shoes business can be very profitable.</p>\r\n<p>Here are some of the things that you will find interesting to know if you plan on starting a shoe business:</p>\r\n<h3>Where to Buy Shoes</h3>\r\n<p>You will need to look for wholesalers of shoes if you want to start a shoes business. The internet has a large database of shoe wholesalers but it is important that you verify the credibility of the wholesalers you are dealing with. It is also best to get quotation from a number of shoe vendors so you will be able to know where it is best and cheapest to buy shoes that you will sell.</p>\r\n<h3>Low End Shoes or High End Shoes?</h3>\r\n<p>When starting a shoes business, you will find it valuable to determine who your target market will be. This will allow you to determine what type of shoes you are going to sell. You can sell low end shoes, high end shoes or both depending on what type of clients you expect to patronize your shoe company. Nevertheless, you will find it notable to know that you will be able to sell to more people if you sell low end shoes. Your shoe store business start up capital will also determine what type of shoes your will be able to sell.</p>\r\n<h3>Marketing and Selling</h3>\r\n<p>Selling shoes these days is no longer limited to opening a brick and mortar shoe business store. Many shoe business operators have realized that selling their items in the internet through eBay and through their shoe market business websites can be very profitable. You just need to have a secure payment system and a delivery service provider that you can rely on. You can provide a catalogue of the shoe products that you sell in your website so it will be easier for your clients to choose from the shoes that you sell. While an online presence for your shoe business can help boost your sales, it is still important that you acknowledge the importance of a brick and mortar shoe market business outlet because this is where you can display your products and sell directly to your customers. It is important that you choose a location where people can easily see and purchase your shoe store business products. Setting up a shoe outlet in a mall or in similar high traffic areas would be a great idea.</p>\r\n<h3>FAQs</h3>\r\n<p><strong>Q. Best place for opening a shoe retail store?</strong>&nbsp;<br />A. Here are some tips on selecting the location for a shoe shop<br />- Is there enough traffic? Traffic next to a theatre might be ample but not ideal for a shoe store. Best location will be a mall, where people are already in a buying mood.<br />- Lookout for the existing shoe store and what is the requirement in the locality.<br />- Your store requires enough space for showing your items.<br />- Parking space is very important; people might not like to shop at if they have trouble in parking.</p>\r\n<p><strong>Q. How to increase the sales of a shoe store?</strong><br />A. You can increase your sales by advertising, marketing, handing out coupons, promotional offers, increasing your inventory, meeting the public&rsquo;s requirement, improving customer relation, etc.</p>', 'uploads/article/b32.jpg', '2012-04-26 08:08:02', 2, 0, 0, 4, 1, 1),
(18, 'How to Start a Hospital Business', '<p><em><strong>Having a hospital business may require intensive planning and large capital. Knowing the right ways on how to start a hospital business can save you from the fuss and additional expenses from starting it.</strong></em></p>\r\n<p>Having your own hospital can be very ambitious knowing that you have well-built establishment, professional group of personnel, and a huge amount of capital.</p>\r\n<p>Starting a small hospital may already require you a certain amount of investment but if you are really passionate about having your own hospital and a great demand is there, then you really have to invest on this venture.</p>\r\n<p>Just like any other businesses, you need to have a well-constructed&nbsp;<a href=\\"http://www.startupbizhub.com/business-planning-analysis.htm\\">business plan</a>&nbsp;that will guide you through all the needs of the business and the goals that you need to achieve. A strategic action plan is needed in order to smoothly start and run a business like this.<br /><br />You can either choose constructing your own building or find a building that is already built and then renovate it. You can also have the option of leasing an already existing building if you don&rsquo;t have budget in constructing your own building. Finding a strategic location is also important. This means that your hospital must be easily-accessible to a larger population especially during emergencies.</p>\r\n<p>When it comes to facilities, make sure that you the devices are up-to-date and safe. You have to contract or coordinate with suppliers of facilities and other hospitals need. Having one supplier can save you more especially when you order bulk equipment and supplies. Modern equipment must be within standards and make sure that these are safe.</p>\r\n<p>Management and marketing is the next move. You have to coordinate with the organizations in your area especially with the medical associations. This will give you more knowledge on how you can run your business. Hire professionals that are well-trained and knowledgeable. Make sure that they are legally licensed and with&nbsp;<a href=\\"http://www.startupbizhub.com/buy-stanley-steemer-carpet-cleaner-franchise.htm\\">clean</a>&nbsp;background. Maintaining the reputation of hospitals is very important.</p>\r\n<p>Inside your hospital, you have to build a reception desk and hire the most accommodating receptionist to man it. Another station to be built inside your building is the GP&rsquo;s office. Make it more spacious and large enough to be comfortable for people and for you to stay. Make sure you can place all the objects that you need to put in which includes chairs, tables or desks, cabinets, books, and so on. Windows and doors must be installed strategically. Unnecessary appliances and objects must be avoided. A doctor can work well with a nice environment.</p>\r\n<p>Build a staff room that is ideal for staff members to rest. Only important objects must be contained in that room. In a hospital, enough number of washrooms is important because sanitation is a priority in hospitals. In addition, you can also build treatment rooms, diagnosis rooms, and other rooms that can make patients comfortable. You can add some benches, radiators, and drink machines for patients and visitors.</p>', 'uploads/article/b31.jpg', '2012-04-26 08:11:11', 22, 0, 0, 4, 0, 1),
(19, 'Start a Private School Franchise', '<p><em><strong>Education is very important for everyone because it allows a person to become whoever he or she wants to be in the future. If you are planning of putting up your own school, the best option would be starting a private school franchise.</strong></em></p>\r\n<p>This is because it is more practical to get a franchise than starting from the scratch as you just have to be familiar with franchising a private school.</p>\r\n<h3>The Process of Starting Private School Franchise<br />&nbsp;</h3>\r\n<p>Starting your own school can be a daunting task because you have to work on a lot of stuffs or things. The first thing that you need to create if you will start your own private school is an effective business plan. The process of starting is relatively easy when you have the right knowledge. Before you choose one, it is very significant to do your homework by researching on the various kinds of schools that you can franchise.</p>\r\n<ul>\r\n<li>It can be a preparatory or elementary private school, which provides education for young children.</li>\r\n<li>You can also choose to put up high school private school franchise that provides education to high school students.</li>\r\n<li>A private college school franchise for college student who want to pursue a career.</li>\r\n<li>A school that specialize in certain area of interest like culinary school, music school or others.&nbsp;<br />&nbsp;</li>\r\n</ul>\r\n<h3>Choosing the Private School Franchise<br />&nbsp;</h3>\r\n<p>Be sure to think meticulously when you are choosing a school for franchise. Keep in mind that starting a school even if it is a franchise is not an easy task. There are some factors that you need to consider. It is also significant if you can do some feasible studies on area you wish to put up a school, be sure that there&rsquo;s a large target market.<br />&nbsp;</p>\r\n<p>When you are finally decided what school you want to franchise. Visit the main office of the school and talk to the administrator. As franchisee, you will carry their name, be sure to give them your intention why you have chosen their institution. It is helpful if you can familiarize yourself about the core values and mission of the school. The franchising fee is also one consideration, be sure that it is acceptable in the market.<br />&nbsp;</p>\r\n<h3>Capital for Franchise&nbsp;<br />&nbsp;</h3>\r\n<p>Another significant factor you need to consider is your capital for your private school franchise. Most of the franchise business, franchisee must be able to provide the same facilities and services that the school offers. This includes the exterior of the classrooms, building and other amenities. This is a requirement, so that your school will be identified as part or branch of a certain private school. It surely requires you to have a lot of funding, if you don&rsquo;t have that much funds, obtaining a loan for business can be your best chance or look for potential investors or partners that can help you with the finances.</p>', 'uploads/article/b35.jpg', '2012-04-26 08:14:00', 3, 0, 0, 3, 0, 1),
(20, 'Starting a Hair Care Product Business', '<p><em><strong>Looking into hair care trends and future, one can easily say there is a huge potential in hair care product business. Do you want to start your own business? Would you like to know how to start a hair care product business? You might want to know what are the pros and cons in starting a hair care product business.</strong></em></p>\r\n<p>Men and women alike are fascinated with everything that is beautiful and strive to be beautiful themselves. This is the reason why retailing cosmetics and hair care products makes for a good business idea.</p>\r\n<p>Experts say that this industry is expected reap in profits of up to 5% each year for several years to come.</p>\r\n<p>At present, almost half of the hair care products on the market are being sold by major retailers. While the remaining half is divided among the independent businesses. Considering the brevity of this market, rest assured, a new player would find no trouble in finding a niche for himself. All he has to do is study the market and the potential clientele of the area.</p>\r\n<p>This is encouraging news indeed especially if you have aspirations of building your very own hair care product empire. But how does one go about starting a business like this? Primarily, you have to choose what line/s or brand/s of hair care products to sell. Are they for women, men, or both? Are they for kids, adults, or both? Note too that geographic segmentation is a vital factor in the hair care business. You must identify which ethnic distribution is prevalent in your target market area. Subsequently, find out what ethnic specific product line would satisfy this groups hair care concerns.</p>\r\n<p>The number of manufacturers remains wide and varied. The key here is to find distributors that offer products that best meet the needs of your target consumers. In selecting a supplier, make sure that the company is stable and its products have a good reputation.</p>\r\n<p>In order to adequately market your products, you need to develop a distinct selling point. Spend some time analyzing what makes your products different from the others. Setting your product apart from the rest will give you an edge and will markedly increase your potential for success.</p>\r\n<h3>Promoting Hair Care Products</h3>\r\n<p>There are countless ways to promote your products. There is the direct mailing for one. Or if you have the funds, you can go for media advertising. But remember, you need to take into consideration, the lifestyle of the market that you wish to cater too. For example, if your target market is teenagers, placing an ad in a newspaper would a useless move since generally teenagers rarely read the papers.</p>\r\n<h3>Pricing Hair Care Products</h3>\r\n<p>Make sure that you set an appropriate price for your product. If it is too expensive, chances are, you will lose a number of consumers. If on the other hand the price is too low, then you will limit the profit potential of your business.</p>\r\n<h3>Bottom Line Advice</h3>\r\n<p>And lastly, no matter how catchy your sales angle is or how extensive your promotional campaign has been; if you can&rsquo;t get your products out on the racks, then your business is doomed to head south. Find stores and salons that you can team up with and that would let you sell your products on consignment basis. If your funds permit, you can rent a kiosk in the mall. Another option is the internet.</p>', 'uploads/article/b34.jpg', '2012-04-26 08:17:39', 3, 0, 0, 2, 0, 1);
INSERT INTO `mj_learn_article` (`la_id`, `la_title`, `la_body`, `la_visual`, `la_dateposted`, `la_article_by`, `la_rat_up`, `la_rat_down`, `la_cat_id_fk`, `la_featured`, `la_published`) VALUES
(21, 'How to Start a Scrap Metal Business', '<p><em><strong>Scrap metal business has three major priorities that should be first looked into before opening for business: the accumulation of scrap metal, the holding area, and the safety measures of the said holding area. Without these three, business may prove futile.</strong></em></p>\r\n<p>Scrap metal business may go by various monikers: metal recycling business, junk metal business, scrap metal recycling, scrap yard, waste metal recycling center, wrecking yard, breaker&rsquo;s yard, etc.</p>\r\n<p>In any case, starting a scrap metal business has a few fundamental rules that you may want to follow. This business is a very hands-on business, where owners and scrap workers work directly with the &ldquo;product&rdquo; &ndash; sometimes even handling junk and rusty pieces of metal.</p>\r\n<p>Your first priority should be the accumulation of scrap: these are old, unwanted metal pieces that usually come from building supplies, discarded vehicle parts, and other surplus metal materials. Scrap metal is actually a very important commodity &ndash; and is usually almost always in demand for both production and recycling. Scrap metal or recycled metal is less costly than pure metal, and the market for scrap metal is expansive.</p>\r\n<p>Scraps can be found almost everywhere &ndash; some are given for free, others have to be salvaged from wreckage or demolition sites, and others have to be bought outright. In order to remain competitive, owners of scrap metal businesses try to keep their rates low, and try to sell their scraps high.</p>\r\n<p>As an owner of a scrap metal business, your second priority should be your holding area or the lot with which to hold all your scraps. Some people call it a scrap yard. Depending on the size and location of your holding area, your business may or may not be open to &ldquo;browsers&rdquo; or customers who wish to scan available scrap metal. Some scrap metal businesses allow browsers to walk into the holding area and extract whatever they need, provided that the customers supply their own tools for extraction, and that they waive any liability from personal injury during the extraction process.</p>\r\n<p>Larger scrap metal businesses usually segregate metals by piles according to quality and its recyclable parts. Buyers of scrap metal then &ldquo;bid&rdquo; for a specific pile: something like an auction of sorts, where the highest bidder gets the pile he so desires. Sale of scrap metal is always measured by weight, and never per piece or item.</p>\r\n<p>Some scrap metal businesses even have dual purposes. On one hand, they sell scraps to the highest bidders or browsers and the less desired pieces are inevitably sent to smelting companies. In both cases, there is always a fast exchange of money, making this a very lucrative business enterprise.</p>\r\n<p>However, one great major concern, and one that should be the third on your priority list, is safety and security. Obviously, scrap metal holding area poses a lot of risks when it comes to physical injury. Haphazardly placed metal pieces may eventually topple over especially when &ldquo;browsers&rdquo; are covering the lot. There is also concerns regarding health and environmental issues &ndash; radioactive materials have been found in scrap metal yards before. As the owner of a scrap metal business, you and your people will most likely handle a lot of junk that came from unknown sources. It is best if you have protective gear or at least a contingency measure should something quite undesirable turn up in your holding area.</p>', 'uploads/article/b30.jpg', '2012-05-20 12:42:19', 1, 0, 0, 4, 0, 1),
(22, 'How to Start a Towing Business', '<p><em><strong>If you are looking for a good business venture that you can invest on, you might want to take a look at the money earning potentials of engaging in the tow business industry. Aside from the fact that there is less competition in the tow truck business, entrepreneurs that are engaged in auto towing businesses are more often assured of stable profits owing to the small number of towing companies that exist.</strong></em></p>\r\n<p>If you want to start a towing business, the following information can prove to be helpful:</p>\r\n<h3>Start up cost and requirements</h3>\r\n<p>You will need a license to operate a towing company. Remember however that you need to be patient in securing a towing truck business license because obtaining a towing license can prove to be difficult. This is because towing licenses are strictly regulated. People who are planning to invest in a tow truck business must also have at least $10,000 for a towing business start up capital. The starting capital for a towing company however can vary depending on your location and the type of operation you intend to have. In urbanized areas for example, you might need around $200,000 if you are going to purchase a tow truck and a towing license.</p>\r\n<h3>Operating a Towing Company</h3>\r\n<p>Starting a towing company will not guarantee you that people will automatically call for your towing services business services when they need help in towing vehicles. You must do something so people will know about your auto towing business company. It is therefore best if you can have a good marketing strategy so people will remember your towing business should they need the services of a towing company. You can post ads in local newspapers so people can read and know about you. It is also a good idea to contact companies that might need towing businesses to service them when they need to tow illegally parked cars in their vicinity. Towing business operators are also advised to come up with easy to remember names and phone numbers so people can easily recall their company when vehicle towing services are needed.</p>\r\n<p>A towing business is a good business opportunity given the small number of competitors in the industry. If you intend to invest in a vehicle towing business, make sure that you have the necessary capital needed as start up cost for your vehicle towing business. It will also help if you have an effective marketing strategy so people can easily contact your towing business when they need auto towing providers.</p>\r\n<p>It is always better to focus on a small part of your niche as the market has grown very big and it will be tough to compete with others when you are just starting and don&rsquo;t have a specialized service. When I say specialized service then I mean either you concentrate on&nbsp;starting heavy duty tow trucks&nbsp;business,&nbsp;boat towingservice,&nbsp;bike towing, etc. It is always advised to&nbsp;buy used tow trucks&nbsp;to start the business rather than going for new one. If you buy the used ones then you save on your budget and can use the extra money on advertising your towing business because end result depends on the number of hours you keep your tow trucks busy.</p>', 'uploads/article/b29.jpg', '2012-05-20 15:11:41', 1, 0, 0, 4, 0, 1),
(23, 'How to Start Boat Towing Business', '<p><em><strong>If you are looking for a good business that will get you more dollars per hour, you should start thinking about starting a boat towing service. It is always in demand, since there are a lot of ships plying the waters around the world and one of them is always bound to run into problems every once in a while.</strong></em></p>\r\n<p>Boat towing is an emergency service. They are always to be there when the need arises.</p>\r\n<p>Just imagine how many ships are there that ply the bodies of water around the United States and other countries. This represents a sizable market for you, since one or two boats are bound to run into emergencies every now and then.</p>\r\n<p>This means that boat towing services have the potential of earning one a lot of money even in just one accident. That is because boat towing services charge per hour, and it takes quite some time to tow a vessel from the waiting area and unto the wharf where it can be docked. Boat towing services are also capable of salvaging grounded vessels but it depends on what you&rsquo;re reading to spend on.</p>\r\n<p>There are only a few requirements that you would need to accomplish before you can start operating a boat towing service. These requirements are:</p>\r\n<ul>\r\n<li><strong>Business registration</strong>&nbsp;- Anywhere you may want to base your business in, you would still need to register it with the state agency in charge of such a task. Without this, your business would be considered illegal since it cannot be charged the appropriate taxes and fees. Without being registered, you only would not be able to avail of the protection of the law when the time comes.</li>\r\n<li><strong>Towing equipment</strong>&nbsp;- Towing equipment would generally include the tugboats that you will be using for towing maritime vessels to the shore. This would also include the rigging equipment like ropes, cables and many others. Fortunately, these are all available anywhere. You can just check the Internet to find new and slightly used equipment for sale at a variety of prices, but most of them ranging from USD15,000 and up to the millions.</li>\r\n<li><strong>Personnel</strong>&nbsp;- You would need to recruit the appropriate personnel in order to operate your tugboats. They should be people who are experienced in such an activity, because boat towing is a science all on its own in the maritime industry.</li>\r\n<li><strong>Appropriate permits</strong>&nbsp;- Since you are operating a maritime vessel &ndash; albeit designed to assist other maritime vessel in need &ndash; you would need to secure a seagoing permit from the local maritime agency. To qualify, you would need to make sure that all your vessels are seaworthy and will not run into accidents on their own. Your employees and crew should also be qualified to operate seagoing vessels and must have the necessary paperwork to prove their qualification.</li>\r\n<li><strong>Liability insurance</strong>&nbsp;- This is a must for any business, since there is always a chance that you will make some mistakes and ends up damaging your client&rsquo;s vessel. Any damage, big or small, is bound to end up in a compensations claim so it is wise to have some insurance ready.</li>\r\n</ul>', 'uploads/article/b28.jpg', '2012-05-20 15:15:02', 1, 0, 0, 4, 0, 1),
(24, 'How to Write a Small Business Plan of your Own', '<p><em><strong>Preparation and careful planning is the key to starting your own business as well as getting investors to invest in your start-up company. Any business needs a good business plan to steer its course as well as anticipate possible problems.</strong></em></p>\r\n<p>Here are a few things that you must consider and include in writing your own small business plan.</p>\r\n<p>The most important parts of your small business plan include a description of your small business, a developed marketing plan, and a management plan. In describing your small business, you have to be able to describe what business you are in. In this part of your business plan, you should be able to put the goods and services you plan to sell as well as the location or place of your business. Indicate why you have chosen such location as well as the advantages and disadvantages of your location. You may also seek to be more detailed in the description of your business by including the special aspects of your business and why you think your business would appeal to your target market. In your description you must clearly point out the purpose of your business as well as the goals and objectives of your business.&nbsp;</p>\r\n<p><br />In the description of your business, you must be able to describe the products and services that you are offering. Why did you choose to offer such products? What are the strengths of your product and possible weaknesses? How is your product or service better than your competitors? What possible benefit or good will your products have on your consumers?</p>\r\n<p>In the location part of your business plan, it is important to remember that in choosing your location, you must take into account the accessibility of your business as well as the needs of your target consumers. Your business must be in a place where your market can easily reach you as well as adequate in space to accommodate your customers. Indicate in your business plan the expected needs of your location. Is it accessible enough? Big enough? Is your location beneficial or not?</p>\r\n<p>In the marketing part of your business plan, it is important to get to know your consumers and address their needs. You must be able to develop a marketing plan that would both address the demands of your consumers as well as potential needs or wants of your target market. In this part, you must provide in detail your target market. Provide demographics, economic and socio-political trends, the expectations of your customers, as well as your advertisement and publicity plans.</p>\r\n<p><br />Also provide a management plan in your business plan. This includes your financial management plan as well as your personnel management plan. In the financial management plan, be able to show budgetary allocations, projections in profits and losses and ways to address these losses. In the personnel management plan, indicate the employees you would need, their positions, salaries and rules and regulations they need to follow.</p>', 'uploads/article/b18.jpg', '2012-05-20 15:16:24', 1, 0, 0, 4, 0, 1),
(25, 'How the Internet Affects Business', '<p><em><strong>The Internet has done a global domination because of its numerous benefits to people from all walks of life. In fact, it is the one affecting the business a lot because almost all of the transactions are done online today.</strong></em></p>\r\n<p>If you want to know how the Internet affects business, you need to read this article.</p>\r\n<p>&nbsp;</p>\r\n<p>When the word&nbsp;effect&nbsp;is being mentioned, that does not mean that there will be a monopoly of positive effects only or negative effects only. They come in balance. So, that means that everything has its pros and cons. In the succeeding paragraphs, you can have the chance to look at the Internet effects in two different perspectives.</p>\r\n<h3>Know How the Internet Affects Business</h3>\r\n<p>During the past few years, there were people who though that the Internet was nothing but a fad. But nowadays, that idea no longer exists because the Internet has become the best necessity especially when it comes to business. This is also the one that provides countless and limitless information to people around the globe.</p>\r\n<p>The first positive effect that it has is effective lead generation. If before, your customers are just in the locality, now you can have several customers from the different parts of the world. By simply opening websites, the products and services that a company has can be marketed easily and more and more people will know about it. In just one click, you can already reach your potential customers no matter where part of the globe they are.</p>\r\n<p>So what is the negative effect? It is no other than tight&nbsp;competition&nbsp;among the businesses. Now, if you want to stay on top and to take the lead in the business, you have to spend a large amount of money to make sure that when customers search on Google, your website will be on the top list.</p>\r\n<p>The Internet also provides several benefits and possibilities for the working individuals. Today, no matter where you are you can have the chance to work as long as you have your laptop and Internet. The best example of a job that doesn&rsquo;t require you to rush to the office and to wear corporate attires is freelance writing. If you want easy money, being a freelancer is the best career you can have.&nbsp;<br />Because of the Internet, there can already be educated customers and consumers. This will pave the way for them to get the products that they exactly want. With the several sites that offer product reviews and free customer service, they always be satisfied in what they buy.</p>\r\n<p>If you have the right knowledge on virtual operations, you can start your own virtual business. By choosing the right niche, you can make lots of money. You just need to stay focused and determined on what you are doing.</p>', 'uploads/article/b27.jpg', '2012-05-20 15:26:19', 1, 0, 0, 4, 0, 1),
(26, 'How to Start an Online Bakery', '<p><em><strong>If you want to start your own bakery, it would be best to focus on running an online store. It is possible to ship perishable goods and you can find the needed information from the local post office.</strong></em></p>\r\n<p>Decide in the goods that you want to sell and work hard on your website.</p>\r\n<p>&nbsp;</p>\r\n<h3>Starting an Online Bakery</h3>\r\n<p>Do you love to cook or bake goodies? If you do, you can put your skills to good use by starting your own online bakery. Perhaps you&rsquo;re wondering why focus on online selling when you can simply deliver the baked goods to local stores. Well, delivery to local stores can be time-consuming and exhausting. To cut down the costs and the tasks, online is a great choice. Besides, a lot of people love&nbsp;shopping&nbsp;online these days.</p>\r\n<p>The first that you need to decide on is whether you will have the bakery at home or in a small&nbsp;kitchen&nbsp;that you can rent out. It&rsquo;s better to start with a home-based business to lessen the overheads but one problem that you can encounter is with the zoning laws. Since you live in a residential area, it would not be possible to run a bakery from home unless you talk or meet with the zoning officials. At times, you will only be required to pay a certain fee to re-zone the place of business. Well of course, the laws or procedures may vary from place to place but it pays to stick with the law.</p>\r\n<h3>Licensing, Website, Etc.</h3>\r\n<p>The business license should also be settled prior to opening. Even if you&rsquo;re going to run an online bakery, there are still licenses that you should obtain. A domestic kitchen for a bakery is subject to the requirements of the Department of Agriculture. After passing the test, you can receive the license. This will allow you to learn the basics of proper labeling and weighing. While you&rsquo;re studying for the exams, you can now work on your online&nbsp;bakery&nbsp;website. You have two options &ndash; create a site from scratch or use websites like eBay and Etsy to start an online store.</p>\r\n<p>Another thing that you have to consider is the shipping since you&rsquo;re dealing with perishable goods. Talk with the local post office and see if you can arrange for priority mail shipments. If you&rsquo;re lucky, you can ship to different states in the US and even other countries. Decide on the items that you want to make and purchase the supplies. Take photos of the goods that you want to sell and upload it to your store. Don&rsquo;t forget to provide for descriptions as well. Now, you have to prepare the right amount so that you will not be wasting your supplies and effort. When you&rsquo;ve posted all the photos of the products you&rsquo;re selling, you can now bake per order.</p>', 'uploads/article/b26.jpg', '2012-05-20 15:27:09', 1, 0, 0, 4, 0, 1),
(27, 'How to Start an Internet Cafe Business', '<p><em><strong>Anyone can start his or her own Internet cafe as long as proper planning is applied. Learn more on how to start an Internet cafe business effectively.</strong></em></p>\r\n<p>Internet is one of the most widely-used media in the world today. It is a place for almost anything may it is for entertainment, education, business, and so on.</p>\r\n<p>&nbsp;</p>\r\n<p>People usually have their own PCs at home or carry with them their laptops and with wireless&nbsp;Internet. But to some who want to access Internet but doesn&rsquo;t have their own laptops, they usually rely on the services of Internet cafes. Since Internet is very in-demand nowadays, having an Internet cafe can really become a good business that will give good earnings.</p>\r\n<p>Creating a business plan for your Internet cafe is very important so you can strategically measure what you need and what you need to do. Here are some tips on how to start an Internet&nbsp;cafe&nbsp;business effectively.</p>\r\n<p>The first thing that you need to consider when planning to start this kind of business is your budget or initial investment. You may start with a few seats if you have smaller capital. Usually, 10 to 20 seats can be a good start and that means you will have 11 or more computers, one of the main server and the rest for rental. Some can start at their homes and have 5 to 10 seats to accommodate enough customers. But to those who want to start it big, the more seats the better. Having an Internet cafe is not limited to sole proprietorship. You can ask partners to invest in your business and add investment to your capital and add more seats or products. You may also sell some computer needs such as printer inks, discs, USB storage, and others. Of course, it is normal to offer other services aside from Internet rental such as printing, games, encoding, layouts, and many more.</p>\r\n<p>Next to be considered is the business location. Think of how to be a customer looking for fast and accessible Internet connection. Look for a place that is easy to spot for the customers. The best factors to consider when choosing a location are it has to be near schools or malls. It can also be in the streets where heavy foot traffic is present. Also, make sure that there is no heavy competition in the area. You can either rent a place or build your own place. You can even start at your own backyard if you know there is high rate of prospective clients.</p>\r\n<p>You can budget $500 to $600 per unit of desktop&nbsp;computer&nbsp;that you will invest. Remember to always think of the future of the units and this means you don&rsquo;t have to scrimp on the memory size, processing, or video cards. Make sure that these components are updated and at their maximum sizes. This will save you more money in the future and the return of&nbsp;investment&nbsp;will be the one focused on.</p>\r\n<p>One of the most important factors in starting this business is the Internet connection. Make sure you subscribe to a service that can offer fast, efficient, and reliable connection. If you have an excellent Internet connection, you won&rsquo;t even need advertisement because word-of-mouth from the customers alone will make your business popular. You also have to make sure that you have enough friendly and skilled staff to assist the clients.</p>\r\n<p>So those are few hints in becoming successful having an Internet cafe.</p>', 'uploads/article/b25.jpg', '2012-05-20 15:28:48', 1, 0, 0, 4, 0, 1),
(28, 'How to Create a Business Website', '<p><em><strong>This is a step-by-step guide in building a business website that can help you to boost further the potential of your company.</strong></em></p>\r\n<p>This article will also help an amateur businessman like you to understand what makes a powerful business website and what you need to do to maintain the Internet traffic that goes along with it.</p>\r\n<p>&nbsp;</p>\r\n<p>A business website, by definition, is an online web address that usually represents one&rsquo;s business or organization in the World Wide Web. It is where a particular firm discusses its products and services for the online audiences ranging from other businesses, advertisers, professionals, and the public.</p>\r\n<p>In building your own business website, you need to understand how things work online. Everything in the&nbsp;Internet&nbsp;is based on the number of hits a site gets from the online community. The number of hits in a particular website dictates whether the business is doing well or not. The more popular the website becomes, the more potential for company to grow.</p>\r\n<p>The top two things that a businessman or business organization needs to have to build a website are:</p>\r\n<h3>A domain name (yourwebsitename.com or yourbusiness.biz).</h3>\r\n<p>The domain name, otherwise known as URL address, will give the online audience an idea on what your website is all about. Remember, the shorter the domain name, the better chances of being remembered by the online audience and the more chances of getting more hits.</p>\r\n<h3>A web host service.</h3>\r\n<p>Web hosting is a type of Internet service that allows a particular website to be accessible to the users in the Internet. Web hosts are often large companies that provide leases or rentals for a server space so a website can be connected to the web.</p>\r\n<p>If you have already decided on what domain name and web host you will use, the next thing you need to ask is: What does your business website need?</p>\r\n<h3>Here are several things that you need to consider before you decide on the actual form of the business website you want:</h3>\r\n<ul>\r\n<li>What will be the end result? Make sure that the website you will create will help you meet your goals. Your&nbsp;business plan&nbsp;is always the final answer to the question. So, build a website in line with your company&rsquo;s goals.</li>\r\n<li>What are the supports needed? These usually include phone lines, business e-mail, and business address to where customers can communicate with you.</li>\r\n<li>Who am I competing with? You should bear in mind that there are already millions of websites all over the world. You should ask yourself, what can help my website standout from others. Explore things that have never been explored before by other business.</li>\r\n<li>What are keywords? These are words that are most commonly used by online users to search for particular product or service&nbsp;online. Know the psychology of the people and the product that you are offering then find the right connection that will help direct them to your website.</li>\r\n<li>What are the additional supports needed to maintain the website? These are the regular maintenance checks and feedbacks from people who are frequently viewing the website. This can be done after reading e-mail, comments, and blog entries from users.</li>\r\n</ul>\r\n<p>If you follow these instructions, you can never go wrong in developing your own business website.</p>', 'uploads/article/b24.jpg', '2012-05-20 15:30:33', 1, 0, 0, 4, 0, 1),
(30, 'How to Open a Cycle Gear Store', '<p><em><strong>How to open a cycle gear store is a business venture that is exciting and at the same time gives you the opportunity of gaining financial independence. Cycling is probably one of the most exciting sports there is.</strong></em></p>\r\n<p>Cycling is also a form of exercise that most people love to indulge in. If you have the passion for cycling and thinking of starting a business in this field here are some sound advice on how to do so.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<h3>Turn Your Hobby into a Business</h3>\r\n<p>If you are one of those whose hobby is cycling then why not turn your hobby into a business. Since your passion is cycling it is the most rewarding thing to start a business about it at the same time earns a living out of it. Many entrepreneurs start their business from turning their passion into a business related to it. Most often than not people who ventures into a business that is related to their passion succeed due to the fact that their heart is into it.</p>\r\n<h3>Create a Niche</h3>\r\n<p>In any business venture creating a niche is always the best prerogative, hard to achieve though but definitely attainable. How do you create a niche in this kind of business? Aside from making sure that there are fewer competitors in the area where you would like to start your business making sure that you provide a personalized service to your clients is just one way of creating a niche. Train your staffs on how to provide good customer service: courtesy, approachable instead of intimidating, building rapport with clients, etc. Another way of creating a niche in the industry that you are in is the products that you tend to be available in your cycle gear store. People would visit your store to look and/or purchase products for their cycling needs. Live up to the name of your store. When you open a cyclegear store&nbsp;make sure that you provide almost all the cycle gears customers will more likely look for. This is a way to make sure that customers will never have to leave your store to look for another&nbsp;cycle&nbsp;store just to be able to buy what they need. Remember that successful businesses have established a niche in their chosen field that&rsquo;s why they have excellent client base of customers.</p>\r\n<h3>An Excellent Location</h3>\r\n<p>Location is one of the foremost reasons why a business becomes successful. Buy a location wherein there is less competition. It is also imperative that you see for yourself if there is a need of a cycle gear store in the area where you want to start your business. It is an excellent idea that people in the area where you plan to start your business is an area where people loves to&nbsp;bike.</p>', 'uploads/article/b22.jpg', '2012-05-20 15:32:21', 1, 0, 0, 4, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mj_learn_article_category`
--

CREATE TABLE IF NOT EXISTS `mj_learn_article_category` (
  `la_cat_id` int(10) NOT NULL AUTO_INCREMENT,
  `la_cat_name` varchar(70) NOT NULL,
  PRIMARY KEY (`la_cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `mj_learn_article_category`
--

INSERT INTO `mj_learn_article_category` (`la_cat_id`, `la_cat_name`) VALUES
(1, '<p>Finance</p>'),
(2, '<p>Management and Leadership</p>'),
(3, '<p>Marketing and Sales</p>'),
(4, 'How to'),
(5, 'Investing'),
(6, 'Business Life'),
(7, 'Jobs and Carriers'),
(8, 'Skills'),
(9, 'Women and Business');

-- --------------------------------------------------------

--
-- Table structure for table `mj_learn_comment`
--

CREATE TABLE IF NOT EXISTS `mj_learn_comment` (
  `la_comment_id` int(10) NOT NULL AUTO_INCREMENT,
  `la_usr_id_fk` int(10) NOT NULL,
  `la_comment_body` varchar(250) NOT NULL,
  `la_comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `la_id_fk` int(10) NOT NULL,
  PRIMARY KEY (`la_comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `mj_learn_comment`
--

INSERT INTO `mj_learn_comment` (`la_comment_id`, `la_usr_id_fk`, `la_comment_body`, `la_comment_date`, `la_id_fk`) VALUES
(2, 1, 'Nice post!', '2012-02-07 09:58:49', 1),
(3, 1, 'This is nice!', '2012-02-07 10:02:20', 2),
(4, 1, 'Yes! sure this is nice post!', '2012-02-07 10:03:38', 1),
(5, 1, 'Another comment..', '2012-02-07 10:08:17', 1),
(6, 1, 'Why...', '2012-02-07 10:09:04', 1),
(7, 1, 'yes! why why...', '2012-02-07 10:09:15', 1),
(8, 1, 'is it true?', '2012-02-07 10:10:38', 1),
(9, 1, 'Finally...', '2012-02-07 10:11:20', 1),
(10, 1, 'Thanks!', '2012-02-07 10:14:20', 3),
(11, 2, 'Sure. we can start business now!', '2012-02-16 07:26:48', 2),
(12, 2, 'Yeah!', '2012-02-16 07:27:41', 3),
(13, 0, 'Thanks for the article', '2012-02-26 23:53:36', 4),
(14, 0, 'this is nice!', '2012-02-27 08:30:18', 8),
(15, 0, 'zzzzzzz', '2012-02-27 08:30:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mj_market_category`
--

CREATE TABLE IF NOT EXISTS `mj_market_category` (
  `mrket_cat_id` int(10) NOT NULL AUTO_INCREMENT,
  `mrket_cat_name` varchar(70) NOT NULL,
  PRIMARY KEY (`mrket_cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `mj_market_category`
--

INSERT INTO `mj_market_category` (`mrket_cat_id`, `mrket_cat_name`) VALUES
(1, 'Arts & Antiques'),
(2, 'B2B & Industrial Products'),
(3, 'Baby, Kids & Mum'),
(4, 'Beauty & Personal Care'),
(5, 'Books & Comics'),
(6, 'Camera & Camcorder'),
(7, 'Cars & Transport'),
(8, 'Clothing & Accessories'),
(9, 'Computer & Software'),
(10, 'Electronics & Appliances'),
(11, 'Food & Beverages'),
(12, 'General & Misc'),
(13, 'Gifts & Premiums'),
(14, 'Handphone'),
(15, 'Health & Medical'),
(16, 'Home & Gardening'),
(17, 'House & Property'),
(18, 'Internet'),
(19, 'Jewellery & Gemstone'),
(20, 'Jobs & Freelances'),
(21, 'Learning & Education'),
(22, 'Movies & Video'),
(23, 'Music & Song'),
(24, 'Office Equipment'),
(25, 'Rental, To Let & For Hire'),
(26, 'Services'),
(27, 'Special Interest'),
(28, 'Sports & Recreation'),
(29, 'Ticket'),
(30, 'Toys & Games'),
(31, 'Travel & Tours'),
(32, 'Watches, Pens & Clocks');

-- --------------------------------------------------------

--
-- Table structure for table `mj_market_media`
--

CREATE TABLE IF NOT EXISTS `mj_market_media` (
  `mmm_id` int(11) NOT NULL AUTO_INCREMENT,
  `mmm_path` text NOT NULL,
  `mmm_mp_id_fk` int(11) NOT NULL,
  PRIMARY KEY (`mmm_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=104 ;

--
-- Dumping data for table `mj_market_media`
--

INSERT INTO `mj_market_media` (`mmm_id`, `mmm_path`, `mmm_mp_id_fk`) VALUES
(3, 'uploads/market/19653391091296664915.png', 14),
(5, 'uploads/market/car.jpg', 2),
(6, 'uploads/market/398399_214997518594931_79362180_n.jpg', 14),
(8, 'uploads/market/perakniaga.jpg', 16),
(9, 'uploads/market/606-black.jpg', 16),
(10, 'uploads/market/606-blue.jpg', 16),
(11, 'uploads/market/606-pink.jpg', 16),
(12, 'uploads/market/606-rainbow.jpg', 16),
(13, 'uploads/market/606-silver.jpg', 16),
(14, 'uploads/market/606-yellow.jpg', 16),
(15, 'uploads/market/sony.jpg', 17),
(16, 'uploads/market/psp-phone.jpg', 17),
(17, 'uploads/market/nokia-5800-xpressmusic-2.jpg', 18),
(18, 'uploads/market/imac.png', 19),
(19, 'uploads/market/apple-imac-2010.jpg', 19),
(20, 'uploads/market/Aprilia RSV4 R 2010.jpg', 20),
(21, 'uploads/market/suzuki_gsxr_1000_09_01.jpg', 21),
(22, 'uploads/market/chevrolet-camaro.jpg', 22),
(23, 'uploads/market/kafho4.png', 7),
(24, 'uploads/market/1ds.jpg', 3),
(25, 'uploads/market/loft.jpg', 10),
(26, 'uploads/market/Cabinet.jpg', 9),
(27, 'uploads/market/plasma.jpg', 1),
(28, 'uploads/market/mbp17.jpg', 4),
(29, 'uploads/market/nike.JPG', 5),
(30, 'uploads/market/ipad3.jpg', 6),
(31, 'uploads/market/HP2007.jpg', 8),
(32, 'uploads/market/canon-ef-70-200mm-f-2-8l-ii-usm-lens-giantmoni-1008-30-esaezzatinor@1.jpg', 23),
(33, 'uploads/market/OriginalJPG.jpeg', 24),
(34, 'uploads/market/miracle-full-leather-l-shaped-sofa-set-adjustable-seats-1204-15-richyyk@2.jpg', 25),
(35, 'uploads/market/bosch_rotak_40.jpg', 26),
(36, 'uploads/market/nokia-lumia-800-latest-model-ori-set-avaxx-ready-stock-1202-13-directd@1.jpg', 27),
(37, 'uploads/market/2012-proton-preve-12-625x303.jpg', 28),
(38, 'uploads/market/seiko-sndd41p1-gents-criteria-chronograph-sapphire-watch-limited-1500pcs-1204-18-superbuy@12243.jpg', 29),
(39, 'uploads/market/samsung 185.jpg', 30),
(40, 'uploads/market/iphone32.jpg', 31),
(41, 'uploads/market/table.jpg', 32),
(42, 'uploads/market/iphone3gs.jpg', 33),
(43, 'uploads/market/nikkor85mm.jpg', 34),
(44, 'uploads/market/nikkor85mm.jpg', 37),
(45, 'uploads/market/nikkor85mm.jpg', 38),
(46, 'uploads/market/nikkor85mm.jpg', 39),
(47, 'uploads/market/nikkor85mm.jpg', 40),
(48, 'uploads/market/nikkor85mm.jpg', 41),
(49, 'uploads/market/nikkor85mm.jpg', 42),
(50, 'uploads/market/nikkor85mm.jpg', 43),
(51, 'uploads/market/nikkor85mm.jpg', 44),
(52, 'uploads/market/woodpiano.jpg', 45),
(53, 'uploads/market/woodpiano2.jpg', 45),
(54, 'uploads/market/hurix.jpg', 46),
(55, 'uploads/market/hurix2.jpg', 47),
(56, 'uploads/market/abott.jpg', 48),
(57, 'uploads/market/gtoshonan.jpg', 49),
(58, 'uploads/market/penyiasat-remaja.jpg', 50),
(59, 'uploads/market/network-security.jpg', 51),
(60, 'uploads/market/t2.jpg', 52),
(61, 'uploads/market/yonex-voltric.jpg', 53),
(62, 'uploads/market/Canon-EF-600mm-f-4.0-L-IS-USM-Lens.jpg', 54),
(63, 'uploads/market/Canon-EF-600mm-f-4.0-L-IS-USM-Lens.jpg', 55),
(64, 'uploads/market/Canon-EF-600mm-f-4.0-L-IS-USM-Lens.jpg', 56),
(91, 'uploads/market/', 0),
(92, 'uploads/market/', 0),
(93, 'uploads/market/', 0),
(94, 'uploads/market/', 0),
(95, 'uploads/market/k1.jpg', 1069),
(96, 'uploads/market/k2.jpg', 1069),
(97, 'uploads/market/k3.jpg', 1069),
(98, 'uploads/market/jam.jpg', 1070),
(99, 'uploads/market/jam2.jpg', 1070),
(100, 'uploads/market/', 0),
(101, 'uploads/market/', 0),
(102, 'uploads/market/', 0),
(103, 'uploads/market/', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mj_market_post`
--

CREATE TABLE IF NOT EXISTS `mj_market_post` (
  `mrket_post_id` int(10) NOT NULL AUTO_INCREMENT,
  `mrket_usr_id_fk` int(10) NOT NULL,
  `mrket_post_title` varchar(40) NOT NULL,
  `mrket_post_body` text NOT NULL,
  `mrket_post_picture` text NOT NULL,
  `market_dateposted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `market_mms_id_fk` int(11) DEFAULT NULL,
  `mrket_cat_id_fk` int(10) NOT NULL,
  `mrket_state_id_fk` int(10) NOT NULL,
  `mrket_post_published` int(2) DEFAULT '0',
  `mrket_rat_up` int(2) DEFAULT NULL,
  `mrket_rat_down` int(2) DEFAULT NULL,
  `market_view` int(11) DEFAULT '0',
  `mrket_price` int(7) NOT NULL,
  `market_featured` int(1) DEFAULT '0',
  PRIMARY KEY (`mrket_post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1074 ;

--
-- Dumping data for table `mj_market_post`
--

INSERT INTO `mj_market_post` (`mrket_post_id`, `mrket_usr_id_fk`, `mrket_post_title`, `mrket_post_body`, `mrket_post_picture`, `market_dateposted`, `market_mms_id_fk`, `mrket_cat_id_fk`, `mrket_state_id_fk`, `mrket_post_published`, `mrket_rat_up`, `mrket_rat_down`, `market_view`, `mrket_price`, `market_featured`) VALUES
(1, 3, 'Panasonic 50 inch plasma tv', 'Model:TH-P50X30K\r\n2 Years Warranty\r\n\r\nSpecification:\r\n- Integrated Tuners :World 17-System\r\n- Teletext Reception :1000P Level 2.5, FASTEXT/LIST/TOP\r\n- Progressive HD Plasma Display Panel with Tough Panel\r\n- Resolution :1,024 x 768 (16:9)\r\n- Applicable PC signals :VGA, WVGA, SVGA, XGA, WXGA, SXGA, 1920 x 1080\r\n- Full-HD :1125p (50/60/24, HDMI), 1125i (50/60)\r\n- HD :750p (50/60)\r\n- SD :625p (50), 525p (60), 625i (50), 525i (60)\r\n- Contrast Ratio (in dark surroundings):2,000,000:1 Dynamic\r\n- Moving Picture Resolution:720 lines\r\n- 600 Hz Sub-Field Drive:Yes\r\n- 24p Smooth Film/Playback:24p Playback\r\n- Shades of Gradation:4,096 equivalent steps of gradation\r\n- V-Audio Surround\r\n- Picture Mode :Dynamic/Normal/Cinema/True Cinema/Game\r\n- HDMI Input:3(1 side, 2 rear)\r\n- WiFi Ready\r\n- Power Supply:AC 220 - 240 V, 50/60Hz\r\n- Rated Power Consumption:250 W\r\n- Standby Power Consumption:0.4 W\r\n- Dimensions (W x H x D) (w/o stand):1,212 x 747 x 93 mm\r\n- Dimensions (W x H x D) (with stand):1,212 x 782 x 324 mm', 'uploads/market/plasma.jpg', '2012-03-20 08:19:24', NULL, 10, 1, 1, NULL, NULL, 61, 2300, 0),
(2, 26, 'Volkswagen Golf ', 'FOR SALE GOLF GTI 2.0CC TURBO. 400HP ON WHELL DYNO DYNAMICS AT BOOST 1.9BAR.\r\nFULL STAGE 3 NOTHING ELSE CAN BE DONE TUNED BY ARP USA, SPORTY BBS SPORT RIM\r\n19" ORIGINAL JAPAN 3PIECE, 4 PCS NEW TYRE, SIX PORT BREMBO BRAKE SYSTEM\r\n(PORSCHE). NICE 3 DIGIT PLATE NO. WVF 8.. NO NEED TO REPAIR.', 'uploads/market/car.jpg', '2012-03-21 04:54:29', 0, 7, 1, 1, NULL, NULL, 70, 180000, 0),
(3, 3, 'Canon EOS 1Ds Mark III', 'Features\r\n\r\nExceptional Digital SLR Performance\r\nUltra high-resolution 21.1-megapixel to record high resolution images\r\nFull-frame CMOS sensor developed and manufactured by Canon, with noise reduction technology to capture images with greater clarity and colour fidelity\r\nDual “DIGIC III” Imaging Processors for improved colour reproduction for razor sharp images at accelerated processing speed\r\n14-bit A/D conversion method also gives images a richer and smoother tonal expression\r\n3-layer Optical Low Pass Filter for reducing red fringing and colour casts\r\nWide ISO speed range of ISO 100-3200 (1/3-stop increments, extendable – L: 50/ H: 6400)\r\nCustomisable White Balance Settings\r\n           1) Enables you to manually set up to 5 different personal custom white balance options, especially \r\n           useful when shooting under multiple lighting conditions as you can switch white balance setting \r\n           quickly and easily\r\n\r\n          2) The custom white balance can be registered with up to five images shot on the spot, in addition  \r\n          to registering it from an image in the memory card\r\n\r\n          3) The lowest colour temperature has been extended to 300K, while selectable range has been \r\n          expanded to 2500K - 10000K with 100K increments\r\nHighlight Tone Priority\r\n          1) To give your images better colour rendition for a more lifelike feel, this function improves\r\n          gradation within highlight areas\r\n\r\n          2) It effectively preventing your photos from suffering a ‘whitewash’ effect when shooting under \r\n          bright conditions\r\nShoot to Small RAW (sRAW) Type Files\r\n           1) Able to shoot using a new sRAW image format, which is approximately a quarter of the pixel\r\n            count (approx. 2.5 megapixels) and takes up only half the space of standard RAW Type files\r\n            (approx.7.6MB)\r\n\r\n           2) A handy substitute for the JPEG Type files, sRAW Type can be processed and adjusted with the\r\n           provided EOS Utility software. This is useful for photographers who want the versatility of the RAW\r\n           Type for snapshots, but do not require their images to be at the highest possible resolution', 'uploads/market/1ds.jpg', '2012-03-20 09:30:37', 4, 6, 1, 1, NULL, NULL, 149, 25889, 0),
(4, 23, 'Mac Book pro 17 inch', 'Mac Book pro 17 inch for sale \r\nNever used before still sealed in the box \r\nonly serious buyer do call me no sms please \r\nReason for sale : Already have other Mac book', 'uploads/market/mbp17.jpg', '2012-03-20 08:19:24', NULL, 9, 14, 1, NULL, NULL, 45, 5500, 0),
(5, 27, 'Nike Mercurial Victory II IC Volt Yellow', 'Brand new.. never used before.. 100% original.. selling coz not the size that', 'uploads/market/nike.JPG', '2012-03-20 08:19:24', NULL, 8, 4, 1, NULL, NULL, 56, 180, 0),
(6, 22, 'Ipad 3', '16gb-RM 1,849-wifi\r\n\r\n16gb-RM 2,249-3g & wifi\r\n\r\n32gb-RM 2,599-4g & wifi\r\n\r\n64gb-RM 2,999-4g & wifi', 'uploads/market/ipad3.jpg', '2012-03-20 08:19:24', NULL, 9, 6, 1, NULL, NULL, 47, 1849, 0),
(7, 26, 'Windows 7 Ultimate', 'Windows 7 Ultimate + MS Office 2010 \n***********************************\n\nApa yang anda dapat?\n- CD installer Microsoft Window 7 Genuine \n- GENUINE activation code \n- Box + Dvd + Manual & Disclaimer \n- 1 year support & warranty\n\nAnda juga dapat :\n- CD installer Microsoft Office Standard 2010 Full version include (Words, Excel, Powerpoint, Outlook Express, One Note, Publisher)\n- GENUINE activation code \n- Box + Dvd + Manual & Disclaimer \n\n* Jaminan selama 1 tahun \n* Jaminan 14 hari jika ada masalah ketika activation code', 'uploads/market/kafho4.png', '2012-03-21 04:54:24', 0, 9, 8, 1, NULL, NULL, 66, 450, 1),
(8, 23, '2 sty end lot, taman segar perdana', '-whole change to tile\r\n-corner lot n end lot\r\n-land area 30 x 65', 'uploads/market/HP2007.jpg', '2012-03-20 08:19:24', NULL, 17, 9, 1, 0, 0, 53, 675000, 0),
(9, 22, 'Anastasia display cabinet', '*SIZE H78" D16" W36"\r\n*WHITE COLOUR ONLY\r\n*IT CAN SUIT FOR ENGLISH STYLE AND MODERN CLASSIC CONCEPT\r\n*AT THE TOP CAN BE OPEN BOOKSHELF OR DISPLAY CABINET AND THE DRAWER YOU CANSTORE MANY THINGS\r\n*WHILE STOCK LAST,LIMITED STOCK ', 'uploads/market/Cabinet.jpg', '2012-03-20 09:00:29', NULL, 16, 3, 1, 0, 0, 29, 699, 0),
(10, 24, 'KL Sentral The Loft', '* Property Type:Condominium\r\n* Tenure:Freehold \r\n* Title Type:Strata\r\n* Quiet relaxed area, environmental housing\r\n* Built-Up:1,585 sq. ft.\r\n* Asking PriceRM 1,268,000\r\n* Bedrooms:3+1 ,Bathrooms:3\r\n* Unit type:Corner\r\n* Furnishing:Fully Furnished\r\n\r\n-Located on elevated ground and prime location of Bukit Bandaraya, Bangsar. Walking distance to Bangsar Shopping Centre.', 'uploads/market/loft.jpg', '2012-03-20 09:30:17', NULL, 25, 1, 1, 0, 0, 51, 1200000, 0),
(17, 27, 'Sony Ericsson', '<p>Sony Ericsson</p>', 'uploads/market/sony.jpg', '2012-03-26 02:52:11', NULL, 14, 3, 1, 0, 0, NULL, 500, 0),
(19, 27, 'iMac 27', '<p>iMac 27 Inch Multimedia</p>', 'uploads/market/apple-imac-2010.jpg', '2012-03-26 03:09:43', NULL, 9, 1, 1, 0, 0, NULL, 3400, 1),
(20, 2, 'Aprilia RSV4 R Like New Under Warranty', 'Selling my Aprilia RSV4 R for upgrade:\r\n- Priced with nice reg no: W**69\r\n- Registered 2011\r\n- Manufactured 2011\r\n- Accident free guaranteed, like new\r\n- Under warranty until Mar 2013\r\n- Under free maintenance Until Mar 2014\r\n- All original, no modifications\r\n- Low mileage, weekend ride only\r\n- FOC freebies*** limited time offer\r\n\r\nWelcome to view and test the bike, price negotiable.\r\n', 'uploads/market/Aprilia-RSV4-R-2010.jpg', '2012-04-25 07:26:20', NULL, 7, 3, 1, 0, 0, NULL, 79900, 1),
(21, 23, 'Suzuki GSXR 1000 K9', 'Saya nak letgo K9 1000\r\ntiptop condt\r\nlow milige (9+++)\r\nada aksesori\r\n', 'uploads/market/suzuki_gsxr_1000_09_01.jpg', '2012-04-25 07:43:28', NULL, 7, 10, 1, 0, 0, NULL, 66000, 0),
(22, 14, 'Chevrolet Camaro SS 6.2 V8', 'Chevrolet Camaro 6.2 SS V8 \r\n* Year of manufacture 2010\r\n* Unregister\r\n* Import UK\r\n* SS Model\r\n* Showroom car\r\n* Limited unit in Malaysia\r\n\r\nEngine:\r\n* 6,162cc\r\n* 0 - 100km 5.4 sec\r\n* 426hp / 5900 rpm\r\n* Top Speed 250km\r\n\r\nSpecification:\r\n* Boston Acoustics sound system\r\n* Brembo four-piston calipers\r\n* Convenience and Connectivity Package\r\n* Daytime Running Lamps\r\n* Front Sport buckets seat\r\n* 20" Midnight Silver Aluminum Wheel\r\n* A four-pack of auxiliary gauges\r\n* And more spec and feature\r\n\r\nLocation: Jalan Tun Razak\r\n\r\nAfter sales service:\r\n* Warranty 1-3 year\r\n* Maintain by specialist machanic\r\n* Original Chevrolet part\r\n', 'uploads/market/chevrolet-camaro.jpg', '2012-04-25 07:50:24', NULL, 7, 9, 1, 0, 0, NULL, 390000, 0),
(23, 2, 'Canon EF 70-200mm F/2.8L IS II USM Lens', 'The Canon EF 70-200mm f/2.8L IS II USM Lens improves upon its predecessor, one of the most acclaimed lenses in the Canon EF line, with superior performance, increased speed and optical quality.\r\n\r\nThis lens is constructed of 23 elements in 19 groups (including 1 Fluorite and 5 UD elements) which help deliver the sharpness and reduced aberration which professional photographers rely upon from Canon. The IS II Optical Image Stabilizer provides up to 4 stops of correction at all focal lengths.\r\n\r\nThis lens has a minimum focusing distance of 3.9'' (1.2 m) at all zoom settings so you can get the shot when shooting close to your subject even in smaller spaces. Like all Canon L-series lenses, this telephoto zoom is dust- and moisture-resistant and designed to keep on going even in the most challenging of environments.\r\n\r\nSpecification:\r\n\r\nFocal Length & Maximum Aperture :70-200mm 1:2.8 Angle of View (Diagonal) :34Â° - 12Â° Groups/ Elements : 23/19 (1 Fluorite & 5 UD elements) Filter Size : 77mm Closest Focusing Distance (ft/m) : 1.2m/3.94 ft. (maximum close-up magnification: 0.21x) Length (mm) : 7.8" (199mm)', 'uploads/market/canon-ef-70-200mm-f-2-8l-ii-usm-lens-giantmoni-1008-30-esaezzatinor@1.jpg', '2012-04-25 11:54:28', NULL, 6, 9, 1, 0, 0, NULL, 7200, 0),
(24, 22, 'Alienware M14X - Gaming Machine i7-2670', 'Specification: -Intel Core I7-2670QM (2.20 GHz Boost 3.10 GHz) -Windows 7 Premium -8GB DDR3 1333Mhz ram -500GB 7200RPM -DVDRW -3GB NVIDIA GT 555M - 3D -14.0" WHD+ 1600 X 900 -Stealth Black -WIFI/Bluetooth/Webcam', 'uploads/market/OriginalJPG.jpeg', '2012-04-25 11:57:48', NULL, 9, 7, 1, 0, 0, NULL, 4399, 0),
(25, 14, 'Miracle Full Leather L shaped Sofa Set', 'Confidence, elegance, and comfort.\r\n\r\nThe Miracle sectional features a unique mix of modern swagger and classic looks; from strong, square shapes and clean lines to inviting soft looking cushions, Miracle always sits as good as it looks.', 'uploads/market/miracle-full-leather-l-shaped-sofa-set-adjustable-seats-1204-15-richyyk@2.jpg', '2012-04-25 12:02:40', NULL, 16, 5, 1, 0, 0, NULL, 4100, 0),
(26, 1, 'Bosch Rotak 37 Li Cordless Lawnmower', 'Feature available to Store Members\r\n\r\nThe worlds first cordless lithium-ion mower from Bosch combines the power of an electric mower with the convenience of new generation cordless technology.\r\n\r\n- Featuring unique grass combs that allows you to cut right to the edge - Supplied with a high performance 36 volt lithium-ion battery to cut up to 300 metres - Fast 1 hour recharge time with super charger supplied - 37cm width of cut, with high speed steel blade - 7 heights of cut (35-70mm) - Lightweight and manoeuvrable, only 13.9kg - Rear collect grassbox (40 litres)', 'uploads/market/bosch_rotak_40.jpg', '2012-04-25 12:19:44', NULL, 2, 8, 1, 0, 0, NULL, 2100, NULL),
(27, 14, 'Nokia Lumia 800 Latest Model', 'package : battery,charger,headset,data cable and box with free gifts\r\n\r\nwarranty : 12-months by Nokia M''sia\r\n\r\ncolor:- black/blue/pink', 'uploads/market/nokia-lumia-800-latest-model-ori-set-avaxx-ready-stock-1202-13-directd@1.jpg', '2012-04-25 12:27:40', 0, 14, 1, 1, 0, 0, NULL, 1349, NULL),
(28, 27, 'PROTON PREVE 1.6 (A) CVT PREMIUM', 'MAKE : PROTON MODEL : PREVE YEAR : 2012 MILEAGE : 0\r\n\r\nSpecial Offer! * Brand New Car * Show Room Condition * Special Promotion, * Ready stock * High Loan, Low Downpayment * Enjoy Cash Discount What are You Waiting For?', 'uploads/market/2012-proton-preve-12-625x303.jpg', '2012-04-25 15:11:00', NULL, 7, 9, 1, 0, 0, NULL, 73000, NULL),
(29, 14, 'Seiko Gents Criteria Chronograph', 'Stainless stell chronograph watch. Limited to 1500 pieces worlwide.', 'uploads/market/seiko-sndd41p1-gents-criteria-chronograph-sapphire-watch-limited-1500pcs-1204-18-superbuy@12243.jpg', '2012-04-25 15:18:58', NULL, 32, 12, 1, 0, 0, NULL, 1200, NULL),
(30, 22, 'Samsung 18.5 S19A10N LCD Monitor', 'Samsung 18.5" LCD Monitor', 'uploads/market/samsung_185.jpg', '2012-04-26 03:51:30', NULL, 9, 10, 1, 0, 0, NULL, 299, NULL),
(31, 27, 'APPLE IPHONE 4s 32gb', 'Item(s):APPLE IPHONE 4s sim free official unlocked to all sim card in the world\r\n\r\nPackage includes:FULL SET IN BOX free back & screen protector.FREE LEATHER CASE\r\n\r\nFREE APPS GAMES GPS\r\n\r\n \r\n\r\n1 year apple warranty\r\n\r\n \r\n\r\nADD RM100 FOR 2 YEARS WARRANTY', 'uploads/market/iphone32.jpg', '2012-04-26 03:52:47', NULL, 14, 9, 1, 0, 0, NULL, 2400, NULL),
(32, 3, 'New Portable Laptop Desk with USB Cooler', 'Solid structure with metal support in leg hinges for better stability\r\n\r\nAll packaging is labelled with sticker to guarantee authenticity and quality\r\n\r\nBeware of Imitation!', 'uploads/market/table.jpg', '2012-04-26 03:56:33', NULL, 9, 9, 1, 0, 0, 79, 55, 0),
(33, 2, ' APPLE iPHONE 3GS 32GB', 'ORIGINAL APPLE IPHONE 3GS 32GB\r\n\r\n(WHITE COLOUR)\r\n\r\n \r\n\r\nSUPER WORKING CONDITION\r\n\r\n WE TESTED BEFORE SELL\r\n\r\nTHE PHOTOS ATTACHED IS THE ACTUAL ITEM\r\n\r\nWHAT U SEE IN PHOTOS IS WHAT U GET\r\n\r\n7 DAYS WARRANTY FOR THE PHONE', 'uploads/market/iphone3gs.jpg', '2012-04-26 07:03:39', NULL, 14, 11, 1, 0, 0, 70, 788, 1),
(1069, 2, 'Susu Kambing Segar', 'Susu kambing kaya dengan protien, enzim dan mengandungi faktor anti penuaan, antiarthritis serta antibarah. Ia mengandungi antibodi untuk merawat penyakit gastrik, demam kuning, lelah, penyakit kulit, memulih tenaga batin, sakit jantung peringkat awal, ulser perut serta membantu dalam pembentukan tulang dan gigi serta berbagai lagi penyakit kerana susu kambing merupakan makanan tambahan yang baik untuk kesihatan.', 'uploads/market/ssk.jpg', '2012-09-21 15:18:37', NULL, 2, 8, 1, 0, 0, 91, 14, 0),
(1070, 22, 'Jam dinding ukiran', 'Jam dinding ukiran melayu tradisi\r\ntahan berpuluh tahun. terhad limited item', 'uploads/market/jdindin.jpg', '2012-09-23 15:58:19', NULL, 1, 7, 1, 0, 0, 79, 799, 0),
(1071, 0, 'Van sewa dengan driver', 'Perkhidmatan van sewa dengan driver di Ipoh. Kami menyediakan perkhidmatan van berkapasiti 13 penumpang untuk pelbagai aktiviti ke mana jua :\r\n-Rombongan kahwin ,\r\n-Rombongan sekolah ,\r\n-Rombongan kilang ,\r\n-Hantar anak ke IPT,\r\n-Kami menyediakan driver untuk kemudahan anda', 'images/default-market.jpg', '2012-09-24 04:56:50', NULL, 25, 6, 0, 0, 0, 0, 0, 0),
(1072, 0, 'Van sewa dengan driver', 'Perkhidmatan van sewa dengan driver di Ipoh. Kami menyediakan perkhidmatan van berkapasiti 13 penumpang untuk pelbagai aktiviti ke mana jua :\r\n-Rombongan kahwin ,\r\n-Rombongan sekolah ,\r\n-Rombongan kilang ,\r\n-Hantar anak ke IPT,\r\n-Kami menyediakan driver untuk kemudahan anda', 'images/default-market.jpg', '2012-09-24 04:56:55', NULL, 25, 6, 0, 0, 0, 0, 0, 0),
(1073, 0, 'Van sewa dengan driver', 'Perkhidmatan van sewa dengan driver di Ipoh. Kami menyediakan perkhidmatan van berkapasiti 13 penumpang untuk pelbagai aktiviti ke mana jua :\r\n-Rombongan kahwin ,\r\n-Rombongan sekolah ,\r\n-Rombongan kilang ,\r\n-Hantar anak ke IPT,\r\n-Kami menyediakan driver untuk kemudahan anda', 'images/default-market.jpg', '2012-09-24 04:56:55', NULL, 25, 6, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mj_market_review`
--

CREATE TABLE IF NOT EXISTS `mj_market_review` (
  `mr_id` int(11) NOT NULL AUTO_INCREMENT,
  `mr_usr_id_fk` int(11) NOT NULL,
  `mr_reviewbody` varchar(255) NOT NULL,
  `mr_mpost_id_fk` int(11) NOT NULL,
  `mr_date_submited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`mr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `mj_market_review`
--

INSERT INTO `mj_market_review` (`mr_id`, `mr_usr_id_fk`, `mr_reviewbody`, `mr_mpost_id_fk`, `mr_date_submited`) VALUES
(1, 1, 'Very nice....', 8, '2012-02-24 15:18:17'),
(3, 1, 'how much can we offer this?', 8, '2012-02-25 09:28:06'),
(4, 1, 'OEM license?', 1, '2012-02-25 18:36:17'),
(5, 1, 'Kit set?', 3, '2012-02-25 18:36:42'),
(6, 1, 'looks like converse!', 5, '2012-02-26 06:34:17'),
(7, 1, 'Which area for this one?', 10, '2012-02-26 06:35:01'),
(8, 1, 'its old school!!!', 2, '2012-03-05 11:50:10'),
(9, 14, 'Dato Keramat', 10, '2012-03-09 22:10:49');

-- --------------------------------------------------------

--
-- Table structure for table `mj_market_store`
--

CREATE TABLE IF NOT EXISTS `mj_market_store` (
  `mms_id` int(10) NOT NULL AUTO_INCREMENT,
  `mms_name` text NOT NULL,
  `mms_usr_id_fk` int(10) NOT NULL,
  `mms_view` int(10) DEFAULT NULL,
  PRIMARY KEY (`mms_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `mj_market_store`
--

INSERT INTO `mj_market_store` (`mms_id`, `mms_name`, `mms_usr_id_fk`, `mms_view`) VALUES
(3, 'My Food Online Store', 24, 25),
(4, 'My Gadget Online Store', 1, 175),
(5, 'My Fruit Online Store', 1, NULL),
(6, 'arminplace', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mj_media`
--

CREATE TABLE IF NOT EXISTS `mj_media` (
  `med_id` int(10) NOT NULL AUTO_INCREMENT,
  `med_name` varchar(20) NOT NULL,
  `med_type` varchar(20) NOT NULL,
  `med_url` text NOT NULL,
  `med_time` timestamp NULL DEFAULT NULL,
  `usr_id_fk` int(10) NOT NULL,
  `com_id_fk` int(10) NOT NULL,
  `ma_id_fk` int(10) DEFAULT NULL,
  PRIMARY KEY (`med_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mj_media_album`
--

CREATE TABLE IF NOT EXISTS `mj_media_album` (
  `ma_id` int(10) NOT NULL AUTO_INCREMENT,
  `ma_name` varchar(70) NOT NULL,
  `com_id_fk` int(10) DEFAULT NULL,
  PRIMARY KEY (`ma_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mj_message`
--

CREATE TABLE IF NOT EXISTS `mj_message` (
  `msg_id` int(10) NOT NULL AUTO_INCREMENT,
  `msg_thread_id` int(11) NOT NULL,
  `msg_to` int(10) NOT NULL,
  `msg_by_usr_id_fk` int(10) NOT NULL,
  `msg_body` text NOT NULL,
  `msg_status` int(2) NOT NULL,
  `msg_recieved_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=83 ;

--
-- Dumping data for table `mj_message`
--

INSERT INTO `mj_message` (`msg_id`, `msg_thread_id`, `msg_to`, `msg_by_usr_id_fk`, `msg_body`, `msg_status`, `msg_recieved_date`) VALUES
(18, 3, 2, 1, 'Hello.', 0, '2012-02-14 03:59:22'),
(19, 4, 24, 1, 'test', 0, '2012-02-14 05:01:02'),
(20, 5, 3, 1, 'Hello!', 0, '2012-02-14 08:27:21'),
(21, 3, 1, 2, 'Hello to', 0, '2012-02-16 02:21:00'),
(22, 3, 1, 1, 'Where are you de?', 0, '2012-02-16 02:35:35'),
(23, 3, 1, 2, 'PWCT. Lai2..', 0, '2012-02-16 03:02:04'),
(24, 3, 1, 1, 'COming Later...', 0, '2012-02-16 03:04:08'),
(25, 3, 1, 2, 'okey dude', 0, '2012-02-16 03:08:18'),
(26, 3, 1, 2, 'dont forget to bring your laptop ya', 0, '2012-02-16 03:18:47'),
(27, 3, 2, 1, 'okey. see u there about 15 minutes. gud luck!', 0, '2012-02-16 03:20:54'),
(28, 3, 1, 2, 'make it faster dude!', 0, '2012-02-16 03:23:26'),
(29, 3, 1, 2, 'live streaming now! yahoooo', 0, '2012-02-16 03:23:53'),
(30, 3, 1, 2, 'watch me at youtube!\nhahahahahaha', 0, '2012-02-16 03:24:29'),
(31, 3, 2, 1, 'hahahahahaha', 0, '2012-02-16 03:25:03'),
(32, 3, 2, 1, 'check this! our future project', 0, '2012-02-16 03:28:19'),
(33, 6, 22, 1, 'Chech This project!', 0, '2012-02-16 03:53:33'),
(35, 5, 1, 3, 'Yes bro!', 0, '2012-02-16 04:21:13'),
(36, 6, 22, 1, 'Are you there?', 0, '2012-02-16 05:33:01'),
(37, 6, 1, 22, 'Yes. Iam here. :P Whattsupp dude?', 0, '2012-02-16 05:33:57'),
(38, 7, 3, 2, 'Lai2!', 0, '2012-02-16 05:37:56'),
(39, 7, 2, 3, 'mana?', 0, '2012-02-16 05:40:05'),
(40, 8, 23, 1, 'This friday are you free?', 0, '2012-02-16 05:44:04'),
(41, 8, 1, 23, 'Yes. why?', 0, '2012-02-16 06:02:10'),
(42, 9, 2, 23, 'hahaha done!', 0, '2012-02-16 06:55:51'),
(43, 7, 3, 2, 'PWTC', 0, '2012-02-16 06:56:21'),
(44, 9, 23, 2, 'Yes!', 0, '2012-02-16 06:56:36'),
(45, 8, 23, 1, 'Nothing ;-)', 0, '2012-02-17 07:30:52'),
(46, 6, 22, 1, 'nothing... :P', 0, '2012-02-24 11:50:02'),
(47, 4, 1, 24, 'joined. :)', 0, '2012-02-27 03:09:55'),
(48, 0, 0, 0, 'hahahaha', 0, '2012-02-27 08:27:51'),
(49, 0, 0, 0, 'lalala', 0, '2012-02-27 08:28:06'),
(50, 0, 0, 0, 'ok', 0, '2012-02-28 14:31:54'),
(51, 4, 24, 1, 'haha', 0, '2012-02-28 14:34:35'),
(52, 4, 24, 1, 'we got meeting?', 0, '2012-02-28 14:35:48'),
(53, 5, 3, 1, 'where u now?', 0, '2012-02-28 14:36:53'),
(54, 10, 25, 25, 'Woi!', 0, '2012-02-29 08:48:16'),
(55, 11, 14, 14, 'helloo....', 0, '2012-02-29 08:57:58'),
(56, 12, 14, 1, 'Heloooo agains. :)', 0, '2012-02-29 09:01:28'),
(57, 12, 1, 14, 'Yes. im here :P', 0, '2012-02-29 09:02:26'),
(58, 12, 14, 1, ':P', 0, '2012-02-29 09:43:11'),
(59, 8, 23, 1, 'lalalala', 0, '2012-03-03 12:29:54'),
(60, 6, 22, 1, 'lol', 0, '2012-03-03 20:40:20'),
(61, 13, 23, 25, 'Change your profile picture please! :P', 0, '2012-03-07 04:38:12'),
(62, 14, 14, 2, 'Testing', 0, '2012-03-09 08:10:15'),
(63, 15, 24, 2, 'tesing message dz...', 0, '2012-03-09 08:11:27'),
(64, 16, 23, 2, 'nokia cheapest one!', 0, '2012-03-09 08:13:12'),
(65, 17, 22, 2, 'are u okey?', 0, '2012-03-09 08:13:43'),
(66, 18, 14, 1, 'message back!', 0, '2012-03-09 22:07:27'),
(67, 12, 14, 1, 'you got it?', 0, '2012-03-10 14:22:45'),
(68, 12, 1, 14, 'yes. i got it! how bout tmrow?', 0, '2012-03-10 14:42:54'),
(69, 12, 14, 1, 'yeah.', 0, '2012-03-10 14:43:44'),
(70, 4, 24, 1, 'zzzzzzz...', 0, '2012-03-10 14:44:45'),
(71, 19, 1, 27, 'hye :P', 0, '2012-03-11 00:11:17'),
(73, 21, 1, 27, 'we make profit share', 0, '2012-03-14 15:22:54'),
(74, 21, 27, 1, 'which profit share?', 0, '2012-03-14 15:23:58'),
(75, 21, 1, 27, 'your project asd', 0, '2012-03-14 15:24:36'),
(76, 21, 1, 27, 'hello..', 0, '2012-03-15 18:29:06'),
(77, 21, 27, 1, 'hello back', 0, '2012-03-16 01:52:29'),
(78, 21, 1, 27, 'hello agains :P', 0, '2012-03-16 01:54:30'),
(79, 22, 3, 27, 'hello mat', 0, '2012-03-16 01:56:41'),
(80, 22, 27, 3, 'yes hello.', 0, '2012-03-16 01:56:59'),
(81, 22, 3, 27, 'hello......', 0, '2012-03-16 01:58:50'),
(82, 23, 44, 1, 'Hye, Tq for joining with us ;)', 1, '2012-06-15 07:15:54');

-- --------------------------------------------------------

--
-- Table structure for table `mj_message_thread`
--

CREATE TABLE IF NOT EXISTS `mj_message_thread` (
  `mt_id` int(11) NOT NULL AUTO_INCREMENT,
  `mt_received` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`mt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `mj_message_thread`
--

INSERT INTO `mj_message_thread` (`mt_id`, `mt_received`) VALUES
(3, '2012-02-14 03:59:22'),
(4, '2012-02-14 05:01:02'),
(5, '2012-02-14 08:27:21'),
(6, '2012-02-16 03:53:33'),
(7, '2012-02-16 05:37:56'),
(8, '2012-02-16 05:44:04'),
(9, '2012-02-16 06:55:51'),
(10, '2012-02-29 08:48:16'),
(11, '2012-02-29 08:57:58'),
(12, '2012-02-29 09:01:28'),
(13, '2012-03-07 04:38:12'),
(14, '2012-03-09 08:10:15'),
(15, '2012-03-09 08:11:27'),
(16, '2012-03-09 08:13:12'),
(17, '2012-03-09 08:13:43'),
(18, '2012-03-09 22:07:27'),
(19, '2012-03-11 00:11:17'),
(20, '2012-03-14 15:21:09'),
(21, '2012-03-14 15:22:54'),
(22, '2012-03-16 01:56:41'),
(23, '2012-06-15 07:15:54');

-- --------------------------------------------------------

--
-- Table structure for table `mj_network`
--

CREATE TABLE IF NOT EXISTS `mj_network` (
  `mn_id` int(11) NOT NULL AUTO_INCREMENT,
  `mn_name` varchar(100) NOT NULL,
  `mn_desc` text,
  `mn_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mn_published` int(11) NOT NULL,
  `mn_created_by` int(11) NOT NULL,
  PRIMARY KEY (`mn_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `mj_network`
--

INSERT INTO `mj_network` (`mn_id`, `mn_name`, `mn_desc`, `mn_date_created`, `mn_published`, `mn_created_by`) VALUES
(17, 'Cili', NULL, '2012-02-09 16:09:52', 1, 1),
(19, 'Cyber Cafe', NULL, '2012-02-09 16:55:06', 1, 3),
(20, 'Ikan Keli', NULL, '2012-02-10 04:37:08', 1, 3),
(21, 'Getah Bikam', NULL, '2012-02-13 11:15:52', 1, 1),
(22, 'Remote Control Room', NULL, '2012-02-13 11:19:18', 1, 1),
(23, 'Snooker Table Bundle', NULL, '2012-02-13 11:24:37', 1, 3),
(24, 'Cheap Office Config', NULL, '2012-02-13 11:25:57', 1, 3),
(25, 'Lets go', NULL, '2012-02-13 12:26:56', 1, 1),
(26, 'Android', NULL, '2012-02-13 12:32:51', 1, 1),
(27, 'Business Listing', NULL, '2012-02-14 01:18:58', 1, 1),
(28, 'Insurance', NULL, '2012-02-14 04:56:38', 1, 24),
(29, 'Business Intelligent', NULL, '2012-02-14 11:01:00', 1, 2),
(30, 'Apple Fan', NULL, '2012-02-22 14:33:57', 1, 1),
(36, 'Dell Alienware', NULL, '2012-02-22 14:39:25', 1, 1),
(37, 'iOS', NULL, '2012-02-22 14:42:29', 1, 1),
(38, 'Alfa', 'This group is Alfa Network Wireless Adapter from Taiwan!', '2012-02-22 14:48:20', 1, 1),
(39, 'Ice Cream', NULL, '2012-02-22 14:51:38', 1, 2),
(40, 'Samsung', NULL, '2012-02-22 14:56:31', 1, 2),
(41, 'Toshiba Network', NULL, '2012-02-22 15:07:19', 1, 2),
(42, 'NEC Group', NULL, '2012-02-22 15:17:55', 1, 2),
(43, 'Makeup Artists', NULL, '2012-02-23 12:01:23', 1, 14),
(44, 'Al-Islam Medical Centre', NULL, '2012-02-26 08:08:16', 1, 1),
(45, 'Family Business', 'Desciription new family business here', '2012-02-26 08:12:07', 1, 1),
(46, 'AtoZ', NULL, '2012-02-26 08:13:04', 1, 1),
(47, 'Perodoa MyVi', NULL, '2012-02-26 08:41:21', 1, 1),
(48, 'Innovatis', NULL, '2012-02-27 08:22:51', 1, 1),
(49, 'CS group', NULL, '2012-02-28 14:52:21', 1, 1),
(50, 'Beginner Haruan', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam imperdiet adipiscing turpis sed fringilla. Curabitur et metus nulla. Fusce pellentesque egestas lorem, sed tristique diam bibendum ac. Praesent rhoncus fermentum odio, non euismod tortor facilisis vitae. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam pulvinar tincidunt felis, eu faucibus orci dapibus nec. Fusce auctor mollis tempor. Ut magna massa, sagittis sit amet porta vitae, vulputate nec nibh. Sed consectetur imperdiet lacus sed bibendum. Nulla facilisi. Mauris hendrerit placerat augue posuere consequat. Pellentesque scelerisque mi a nisl pulvinar a laoreet tortor vulputate.', '2012-02-28 17:03:42', 1, 25),
(51, 'Testing Group', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2012-03-09 03:31:31', 1, 1),
(52, 'Dell Group', '', '2012-03-09 08:52:09', 1, 2),
(53, 'Teh Boh Group', '', '2012-03-09 08:53:50', 1, 2),
(54, 'Kobis Bunga Solution', '', '2012-03-09 08:55:19', 1, 2),
(55, 'Ikan Keli Kulim', 'Kulim, Kedah.', '2012-03-09 17:30:12', 1, 1),
(56, 'New group', '', '2012-03-09 19:40:03', 1, 1),
(57, 'Money', 'alway money fo life!', '2012-03-09 19:55:55', 1, 25),
(58, 'Group Penternak Kambing Segar Malaysia', '', '2012-09-24 01:24:07', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `mj_network_comment`
--

CREATE TABLE IF NOT EXISTS `mj_network_comment` (
  `nc_id` int(11) NOT NULL AUTO_INCREMENT,
  `nc_wall_id_fk` int(11) NOT NULL,
  `nc_body` text NOT NULL,
  `nc_comment_by` int(11) NOT NULL,
  `nc_date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`nc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=104 ;

--
-- Dumping data for table `mj_network_comment`
--

INSERT INTO `mj_network_comment` (`nc_id`, `nc_wall_id_fk`, `nc_body`, `nc_comment_by`, `nc_date_posted`) VALUES
(2, 20, 'Jom2..', 1, '2012-02-13 23:15:00'),
(3, 7, 'Testing...', 1, '2012-02-14 01:09:16'),
(4, 6, 'Yes. of course!', 1, '2012-02-14 01:11:07'),
(5, 5, 'which shop ya?', 1, '2012-02-14 01:12:52'),
(6, 2, 'Details please', 1, '2012-02-14 01:17:47'),
(7, 1, 'i will invite all my friends to join this network. Cheer', 1, '2012-02-14 01:18:25'),
(8, 5, 'Near Dataran Ipoh. :-)', 22, '2012-02-14 01:22:31'),
(9, 2, 'Check your inbox. already PMed you. :)', 2, '2012-02-14 01:46:43'),
(10, 22, 'ok join', 24, '2012-02-14 05:00:07'),
(11, 22, 'jom', 1, '2012-02-14 05:01:50'),
(12, 23, 'i like', 1, '2012-02-14 05:02:02'),
(13, 22, 'Apa yg menarik ni?', 2, '2012-02-16 05:36:11'),
(14, 23, 'i lilke too!', 2, '2012-02-16 05:36:50'),
(15, 7, 'It just work! :P', 2, '2012-02-16 07:19:04'),
(24, 7, 'yeah', 1, '2012-02-16 15:03:49'),
(26, 7, 'where?', 2, '2012-02-22 15:17:07'),
(27, 1, 'agains...it does not work anymore...', 2, '2012-02-22 15:17:35'),
(28, 31, 'be the first la!', 2, '2012-02-22 15:19:51'),
(29, 33, 'Yahooo!', 2, '2012-02-23 02:02:15'),
(30, 30, 'we have a bug here...', 2, '2012-02-23 02:03:05'),
(31, 6, 'hahahahaha', 2, '2012-02-23 03:27:58'),
(32, 1, 'which one....?', 14, '2012-02-23 12:03:58'),
(33, 15, '..........', 1, '2012-02-24 11:49:42'),
(34, 20, 'lol.....', 1, '2012-02-26 08:00:21'),
(35, 42, 'developer....', 1, '2012-02-26 08:16:23'),
(36, 42, '............', 1, '2012-02-28 14:39:18'),
(37, 42, 'lalalalal', 1, '2012-03-08 11:36:10'),
(38, 7, 'Pizza Lai...', 1, '2012-03-08 11:43:35'),
(39, 38, 'lol', 1, '2012-03-08 11:45:14'),
(40, 15, 'zzzzzzzzzzzzzzzzzzzzzzzzz', 1, '2012-03-08 11:47:19'),
(41, 19, 'lalalalala', 1, '2012-03-08 11:49:02'),
(42, 54, 'hohohohohoho', 1, '2012-03-09 04:09:23'),
(43, 49, 'hahahah apa merepek ni', 2, '2012-03-09 09:19:36'),
(44, 7, 'when?', 2, '2012-03-09 09:22:53'),
(45, 1, 'PLV maybe?', 2, '2012-03-09 09:23:12'),
(46, 5, 'i forgot the things', 2, '2012-03-09 09:26:28'),
(47, 49, 'mmg merepek pn', 1, '2012-03-09 19:22:00'),
(48, 7, 'tomorrow bai', 1, '2012-03-09 19:22:15'),
(49, 1, 'hahaha', 1, '2012-03-09 19:22:29'),
(50, 6, 'generate profit!', 1, '2012-03-09 19:23:17'),
(51, 34, 'hellooo...', 1, '2012-03-09 19:23:27'),
(52, 58, 'testing', 1, '2012-03-09 19:38:13'),
(53, 59, '.............', 1, '2012-03-09 19:43:28'),
(54, 59, 'zzzzzzzzzzzz', 1, '2012-03-09 19:43:35'),
(55, 59, 'zzzzzz', 1, '2012-03-09 19:43:41'),
(56, 59, 'zzzzzzzzzz', 1, '2012-03-09 19:43:47'),
(57, 59, 'aaaaaaaaa', 1, '2012-03-09 19:43:56'),
(58, 64, 'zzzzzzzz', 25, '2012-03-09 19:58:25'),
(59, 63, 'zzzz', 25, '2012-03-09 20:08:18'),
(60, 62, 'aaaaaa', 25, '2012-03-09 20:10:09'),
(61, 62, 'sssssssssssss', 25, '2012-03-09 20:10:16'),
(62, 62, 'sssssssssssss', 25, '2012-03-09 20:10:22'),
(63, 62, 'is it okey?', 25, '2012-03-09 20:10:40'),
(64, 62, 'i think so...', 25, '2012-03-09 20:10:49'),
(65, 62, 'yeahh....!', 25, '2012-03-09 20:10:53'),
(66, 62, 'yahoooo!', 25, '2012-03-09 20:10:57'),
(67, 63, 'and always!', 25, '2012-03-09 20:11:04'),
(68, 63, 'yahoooo!', 25, '2012-03-09 20:11:08'),
(69, 63, 'ye peee!', 25, '2012-03-09 20:11:13'),
(70, 69, '1 more thing', 25, '2012-03-09 20:11:41'),
(71, 69, 'and more thing', 25, '2012-03-09 20:11:49'),
(72, 70, 'zzzzzzzzzzzzz', 25, '2012-03-09 20:25:30'),
(73, 70, 'ssssssssssss', 25, '2012-03-09 20:25:34'),
(74, 70, 'ddddddddddddddddd', 25, '2012-03-09 20:25:37'),
(75, 70, 'wwwwwwwwwwwwwww', 25, '2012-03-09 20:25:40'),
(76, 70, 'wwwwwwwwwwwwwwwwwwwwwwwwwwwd', 25, '2012-03-09 20:25:44'),
(77, 70, 'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww', 25, '2012-03-09 20:25:49'),
(78, 71, 'zzzzzzzzzzzzz', 25, '2012-03-09 20:36:21'),
(79, 76, 'zzzzzzzzzzz', 25, '2012-03-09 21:08:07'),
(80, 76, 'ssssssssss', 25, '2012-03-09 21:08:09'),
(81, 76, 'wwwwwwwww', 25, '2012-03-09 21:08:11'),
(82, 76, 'ddddddddd', 25, '2012-03-09 21:08:13'),
(83, 76, 'w', 25, '2012-03-09 21:08:16'),
(84, 76, 'd', 25, '2012-03-09 21:08:17'),
(85, 76, 'a', 25, '2012-03-09 21:08:19'),
(86, 76, 'u', 25, '2012-03-09 21:08:22'),
(87, 78, 'jom', 25, '2012-03-09 21:10:34'),
(88, 79, 'hurm...........', 25, '2012-03-09 21:18:23'),
(89, 79, 'try again', 25, '2012-03-09 21:19:26'),
(90, 81, 'when....', 25, '2012-03-09 21:27:02'),
(91, 82, 'au', 25, '2012-03-09 21:43:46'),
(92, 82, 'yo man', 25, '2012-03-09 21:43:50'),
(93, 83, 'zzz', 25, '2012-03-09 21:43:56'),
(94, 83, ':P', 25, '2012-03-09 21:43:59'),
(95, 83, 'hahahhaa', 25, '2012-03-09 21:44:03'),
(96, 85, 'agains', 25, '2012-03-09 21:45:14'),
(97, 59, 'lululul', 1, '2012-03-13 01:39:48'),
(98, 59, 'hahahahaha', 27, '2012-03-14 18:31:01'),
(99, 89, 'hahaha', 27, '2012-03-14 18:31:34'),
(100, 90, 'testing', 27, '2012-03-15 18:35:38'),
(101, 59, 'testing', 27, '2012-03-15 18:35:48'),
(102, 57, 'lalalalalal', 1, '2012-03-22 16:16:52'),
(103, 57, 'lulululu', 27, '2012-03-22 16:18:06');

-- --------------------------------------------------------

--
-- Table structure for table `mj_network_relation`
--

CREATE TABLE IF NOT EXISTS `mj_network_relation` (
  `mnr_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_id_fk` int(11) NOT NULL,
  `mn_id_fk` int(11) NOT NULL,
  `mnr_status` int(11) NOT NULL,
  PRIMARY KEY (`mnr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

--
-- Dumping data for table `mj_network_relation`
--

INSERT INTO `mj_network_relation` (`mnr_id`, `usr_id_fk`, `mn_id_fk`, `mnr_status`) VALUES
(1, 1, 17, 1),
(2, 3, 19, 1),
(3, 2, 19, 1),
(4, 1, 19, 1),
(5, 22, 19, 1),
(6, 3, 20, 1),
(7, 1, 21, 1),
(8, 1, 22, 1),
(9, 3, 23, 1),
(10, 3, 24, 1),
(11, 1, 25, 1),
(12, 1, 26, 1),
(13, 1, 20, 1),
(14, 1, 27, 1),
(15, 24, 28, 1),
(16, 1, 28, 1),
(17, 2, 29, 1),
(18, 2, 28, 1),
(19, 24, 19, 1),
(20, 23, 19, 1),
(21, 14, 19, 1),
(22, 3, 29, 1),
(23, 1, 30, 1),
(24, 1, 31, 1),
(25, 1, 32, 1),
(26, 1, 33, 1),
(27, 1, 34, 1),
(28, 1, 35, 1),
(29, 1, 36, 1),
(30, 1, 37, 1),
(31, 1, 38, 1),
(32, 2, 39, 1),
(33, 2, 40, 1),
(34, 2, 41, 1),
(35, 2, 42, 1),
(36, 14, 43, 1),
(37, 1, 44, 1),
(38, 1, 45, 1),
(39, 1, 46, 1),
(40, 1, 47, 1),
(41, 1, 48, 1),
(42, 1, 49, 1),
(43, 25, 50, 1),
(44, 1, 50, 1),
(45, 1, 51, 1),
(46, 2, 52, 1),
(47, 2, 53, 1),
(48, 2, 54, 1),
(50, 25, 50, 0),
(51, 1, 55, 1),
(54, 25, 55, 0),
(63, 2, 55, 0),
(64, 23, 55, 0),
(65, 24, 55, 0),
(66, 3, 55, 0),
(67, 25, 19, 0),
(68, 1, 56, 1),
(69, 25, 57, 1),
(70, 23, 28, 0),
(72, 27, 56, 1),
(73, 27, 45, 1),
(74, 2, 58, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mj_network_wall`
--

CREATE TABLE IF NOT EXISTS `mj_network_wall` (
  `nw_id` int(11) NOT NULL AUTO_INCREMENT,
  `nw_ntwrk_group_id_fk` int(11) NOT NULL,
  `nw_post_title` text NOT NULL,
  `nw_posted_by` int(11) NOT NULL,
  `nw_date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`nw_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=94 ;

--
-- Dumping data for table `mj_network_wall`
--

INSERT INTO `mj_network_wall` (`nw_id`, `nw_ntwrk_group_id_fk`, `nw_post_title`, `nw_posted_by`, `nw_date_posted`) VALUES
(1, 19, 'Welcome to Cyber Cafe Network.. We discuss any question about Cyber Cafe here', 3, '2012-02-12 08:18:22'),
(2, 19, 'Cyber cafer for sale. contact me', 2, '2012-02-12 12:37:09'),
(3, 19, 'Nice to know this network', 1, '2012-02-12 16:03:41'),
(4, 17, 'Welcome!', 1, '2012-02-12 16:05:33'),
(5, 19, 'Go to lowyat, and level 2 shop. very cheap to get the equipment.', 22, '2012-02-12 16:08:02'),
(6, 19, 'They should know how to operate cyber cafe', 22, '2012-02-12 16:13:12'),
(7, 19, 'Ding!~', 3, '2012-02-13 12:17:45'),
(8, 22, 'Hello', 1, '2012-02-13 12:20:56'),
(9, 22, 'World', 1, '2012-02-13 12:22:13'),
(10, 22, 'Lets begin', 1, '2012-02-13 12:22:52'),
(11, 21, 'Bundle Sale. Strategies', 1, '2012-02-13 12:24:45'),
(12, 21, 'Buy new book how to manage your firm', 1, '2012-02-13 12:25:09'),
(13, 21, 'Hello world!', 1, '2012-02-13 12:25:38'),
(14, 21, 'World Hello!', 1, '2012-02-13 12:26:04'),
(15, 21, 'testing', 1, '2012-02-13 12:31:07'),
(16, 21, 'Agains', 1, '2012-02-13 12:31:21'),
(17, 21, 'And again.', 1, '2012-02-13 12:32:02'),
(18, 21, 'Lagi sekali', 1, '2012-02-13 12:32:17'),
(19, 26, 'Lets discuss Andorid here!', 1, '2012-02-13 18:22:53'),
(20, 20, 'Jom business Ikan Keli', 3, '2012-02-13 22:31:13'),
(21, 27, 'Share with us what your got', 1, '2012-02-14 01:19:15'),
(22, 28, 'insurance kereta baik punya', 24, '2012-02-14 04:59:58'),
(23, 28, 'life insurance world!!', 1, '2012-02-14 05:01:44'),
(24, 29, 'Now everyone can fly!', 2, '2012-02-16 07:20:52'),
(30, 41, 'TOshiba!', 2, '2012-02-22 15:15:14'),
(31, 42, 'We will able to access here :)', 2, '2012-02-22 15:18:11'),
(32, 40, 'Samsung Note', 2, '2012-02-22 16:36:29'),
(33, 39, 'Ice Cream Candy', 2, '2012-02-23 02:01:59'),
(34, 19, 'helloo....', 2, '2012-02-23 03:27:23'),
(35, 43, 'so cheap..', 14, '2012-02-23 12:02:26'),
(36, 37, 'Lets training!', 1, '2012-02-24 11:47:17'),
(37, 21, 'dan lagi...', 1, '2012-02-26 07:59:10'),
(38, 17, 'zzzzz', 1, '2012-02-26 08:01:06'),
(39, 27, 'any ideas?', 1, '2012-02-26 08:02:53'),
(40, 44, 'Very nice...', 1, '2012-02-26 08:08:44'),
(41, 46, 'Superb!', 1, '2012-02-26 08:13:14'),
(42, 30, 'Developer Release...', 1, '2012-02-26 08:15:48'),
(43, 47, 'orange?', 1, '2012-02-26 08:41:36'),
(44, 47, 'orange?', 1, '2012-02-26 08:43:16'),
(45, 47, 'lalalalala', 1, '2012-02-26 08:43:51'),
(46, 38, 'Alfa..', 1, '2012-02-27 08:22:26'),
(47, 47, 'hahaha sala la...', 1, '2012-02-28 14:38:38'),
(48, 48, 'our partner', 1, '2012-02-28 14:39:28'),
(49, 19, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam imperdiet adipiscing turpis sed fringilla. Curabitur et metus nulla. Fusce pellentesque egestas lorem, sed tristique diam bibendum ac. Praesent rhoncus fermentum odio, non euismod tortor facilisis vitae. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam pulvinar tincidunt felis, eu faucibus orci dapibus nec. Fusce auctor mollis tempor. Ut magna massa, sagittis sit amet porta vitae, vulputate nec nibh. Sed consectetur imperdiet lacus sed bibendum. Nulla facilisi. Mauris hendrerit placerat augue posuere consequat. Pellentesque scelerisque mi a nisl pulvinar a laoreet tortor vulputate.', 1, '2012-02-28 16:07:53'),
(50, 50, 'Haruan Berapa sekarang 1kg?', 1, '2012-02-29 11:47:47'),
(51, 20, 'Balakong ada port. Interested?', 1, '2012-03-08 11:39:20'),
(52, 47, 'yuhuuuuu', 1, '2012-03-08 11:45:38'),
(53, 37, 'New Season', 1, '2012-03-08 11:48:48'),
(54, 50, 'lalalalalalallaa', 1, '2012-03-09 04:08:54'),
(55, 19, 'Bundle sale at Leisure Mall!', 1, '2012-03-09 19:23:50'),
(56, 30, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1, '2012-03-09 19:35:25'),
(57, 45, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1, '2012-03-09 19:36:37'),
(58, 51, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1, '2012-03-09 19:37:57'),
(59, 56, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1, '2012-03-09 19:43:03'),
(60, 50, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 25, '2012-03-09 19:48:08'),
(61, 50, 'lululululu', 25, '2012-03-09 19:49:53'),
(62, 57, 'money for life!', 25, '2012-03-09 19:56:17'),
(63, 57, 'agains....', 25, '2012-03-09 19:57:36'),
(64, 57, 'lets try agains!', 25, '2012-03-09 19:58:16'),
(65, 57, 'again', 25, '2012-03-09 19:59:20'),
(66, 57, 'n again', 25, '2012-03-09 20:01:23'),
(67, 57, 'n agains', 25, '2012-03-09 20:01:51'),
(68, 57, 'zzzzz', 25, '2012-03-09 20:05:57'),
(69, 57, 'haiz...', 25, '2012-03-09 20:06:47'),
(70, 57, 'try...', 25, '2012-03-09 20:14:21'),
(71, 57, 'agains...', 25, '2012-03-09 20:36:11'),
(72, 57, 'try agains', 25, '2012-03-09 20:51:33'),
(73, 57, 'lai lai', 25, '2012-03-09 20:54:58'),
(74, 57, 'hmmm', 25, '2012-03-09 21:01:25'),
(75, 57, 'ngantok sudah....', 25, '2012-03-09 21:04:41'),
(76, 57, 'tdo jom...', 25, '2012-03-09 21:06:18'),
(77, 57, 'jom', 25, '2012-03-09 21:08:42'),
(78, 57, 'ok?', 25, '2012-03-09 21:09:29'),
(79, 57, 'wait....', 25, '2012-03-09 21:17:53'),
(80, 57, 'and try agains', 25, '2012-03-09 21:19:41'),
(81, 57, 'agains', 25, '2012-03-09 21:23:50'),
(82, 57, 'ssssssss', 25, '2012-03-09 21:27:10'),
(83, 57, 'wwwwwwwwww', 25, '2012-03-09 21:28:42'),
(84, 57, 'aw', 25, '2012-03-09 21:38:32'),
(85, 57, 'testing', 25, '2012-03-09 21:44:11'),
(86, 57, 'okey', 25, '2012-03-09 21:45:18'),
(87, 57, 'and agains', 25, '2012-03-09 21:48:09'),
(88, 50, 'testing', 25, '2012-03-09 21:51:41'),
(89, 56, 'lalalalala', 1, '2012-03-13 01:39:40'),
(90, 56, 'lol', 27, '2012-03-15 18:35:11'),
(91, 56, 'testing', 27, '2012-03-15 18:35:31'),
(92, 45, 'Any news?', 27, '2012-03-22 16:17:59'),
(93, 17, 'Any News in this?', 1, '2012-06-07 09:30:46');

-- --------------------------------------------------------

--
-- Table structure for table `mj_notification`
--

CREATE TABLE IF NOT EXISTS `mj_notification` (
  `noti_id` int(10) NOT NULL AUTO_INCREMENT,
  `noti_type_id_fk` int(10) NOT NULL,
  `mj_type_id_id_fk` int(11) DEFAULT NULL,
  `mj_group_id_fk` int(11) DEFAULT NULL,
  `noti_to_usr_id` int(2) DEFAULT NULL,
  `noti_request_usr_id_fk` int(10) NOT NULL,
  `noti_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `noti_status` int(2) NOT NULL,
  PRIMARY KEY (`noti_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=109 ;

--
-- Dumping data for table `mj_notification`
--

INSERT INTO `mj_notification` (`noti_id`, `noti_type_id_fk`, `mj_type_id_id_fk`, `mj_group_id_fk`, `noti_to_usr_id`, `noti_request_usr_id_fk`, `noti_datetime`, `noti_status`) VALUES
(18, 1, 0, NULL, 2, 1, '2012-02-16 23:24:43', 0),
(19, 1, 0, NULL, 24, 1, '2012-02-16 23:24:43', 0),
(20, 1, 0, NULL, 3, 1, '2012-02-16 23:24:43', 0),
(21, 1, 0, NULL, 1, 2, '2012-02-16 23:24:43', 0),
(22, 1, 0, NULL, 2, 1, '2012-02-16 23:24:43', 0),
(23, 1, 0, NULL, 1, 2, '2012-02-16 23:24:43', 0),
(24, 1, 0, NULL, 2, 1, '2012-02-16 23:24:43', 0),
(25, 1, 0, NULL, 1, 2, '2012-02-16 23:24:43', 0),
(26, 1, 0, NULL, 1, 2, '2012-02-16 23:24:43', 0),
(27, 1, 0, NULL, 2, 1, '2012-02-16 23:24:43', 0),
(28, 1, 0, NULL, 1, 2, '2012-02-16 23:24:43', 0),
(29, 1, 0, NULL, 1, 2, '2012-02-16 23:24:43', 0),
(30, 1, 0, NULL, 1, 2, '2012-02-16 23:24:43', 0),
(31, 1, 0, NULL, 2, 1, '2012-02-16 23:24:43', 0),
(32, 1, 0, NULL, 2, 1, '2012-02-16 23:24:43', 0),
(33, 1, 0, NULL, 22, 1, '2012-02-16 23:24:43', 0),
(34, 1, 0, NULL, 1, 3, '2012-02-16 23:24:43', 0),
(35, 1, 0, NULL, 22, 1, '2012-02-16 23:24:43', 0),
(36, 1, 0, NULL, 1, 22, '2012-02-16 23:24:43', 0),
(37, 1, 0, NULL, 3, 2, '2012-02-16 23:24:43', 0),
(38, 1, 0, NULL, 2, 3, '2012-02-16 23:24:43', 0),
(39, 1, 40, NULL, 23, 1, '2012-02-16 06:01:58', 0),
(40, 1, NULL, NULL, 1, 23, '2012-02-16 23:24:43', 0),
(41, 1, NULL, NULL, 2, 23, '2012-02-16 23:24:43', 0),
(42, 1, NULL, NULL, 3, 2, '2012-02-16 23:24:43', 0),
(43, 1, NULL, NULL, 23, 2, '2012-02-16 23:31:34', 0),
(44, 1, NULL, NULL, 23, 1, '2012-03-13 01:50:47', 0),
(45, 1, NULL, NULL, 22, 1, '2012-02-24 11:50:03', 1),
(46, 1, NULL, NULL, 1, 24, '2012-03-11 09:40:07', 0),
(47, 1, NULL, NULL, 0, 0, '2012-03-28 11:31:35', 0),
(48, 1, NULL, NULL, 0, 0, '2012-03-28 11:31:35', 0),
(49, 1, NULL, NULL, 0, 0, '2012-03-28 11:31:35', 0),
(50, 1, NULL, NULL, 24, 1, '2012-03-16 12:25:45', 0),
(51, 1, NULL, NULL, 24, 1, '2012-03-16 12:25:45', 0),
(52, 1, NULL, NULL, 3, 1, '2012-03-13 10:34:19', 0),
(53, 1, 54, NULL, 25, 25, '2012-02-29 10:55:16', 0),
(54, 1, 55, NULL, 14, 14, '2012-02-29 09:02:08', 0),
(55, 1, 56, NULL, 14, 1, '2012-02-29 09:02:05', 0),
(56, 1, NULL, NULL, 1, 14, '2012-03-11 09:40:07', 0),
(57, 1, NULL, NULL, 14, 1, '2012-02-29 09:43:11', 1),
(58, 1, NULL, NULL, 23, 1, '2012-03-13 01:50:47', 0),
(59, 1, NULL, NULL, 22, 1, '2012-03-03 20:40:20', 1),
(60, 1, 61, NULL, 23, 25, '2012-03-13 01:50:47', 0),
(61, 1, 62, NULL, 14, 2, '2012-03-09 08:10:15', 1),
(62, 1, 63, NULL, 24, 2, '2012-03-16 12:25:45', 0),
(63, 1, 64, NULL, 23, 2, '2012-03-13 01:50:47', 0),
(64, 1, 65, NULL, 22, 2, '2012-03-09 08:13:43', 1),
(65, 6, 0, NULL, 25, 2, '2012-03-09 12:09:29', 0),
(66, 6, 0, NULL, 25, 2, '2012-03-09 12:23:21', 1),
(67, 6, 0, NULL, 25, 1, '2012-03-09 17:34:36', 1),
(68, 6, 0, NULL, 24, 1, '2012-03-16 12:25:45', 0),
(69, 6, 0, NULL, 25, 1, '2012-03-09 17:43:11', 1),
(70, 6, 0, NULL, 3, 1, '2012-03-13 10:34:19', 0),
(71, 6, 0, NULL, 23, 1, '2012-03-13 01:50:47', 0),
(72, 6, 0, NULL, 23, 1, '2012-03-13 01:50:47', 0),
(73, 6, 0, NULL, 2, 1, '2012-03-14 17:51:35', 0),
(74, 6, 0, NULL, 24, 1, '2012-03-16 12:25:45', 0),
(75, 6, 0, NULL, 24, 1, '2012-03-16 12:25:45', 0),
(76, 6, 0, NULL, 24, 1, '2012-03-16 12:25:45', 0),
(77, 6, 0, NULL, 2, 1, '2012-03-14 17:51:35', 0),
(78, 6, 0, NULL, 2, 1, '2012-03-14 17:51:35', 0),
(79, 6, 0, NULL, 23, 1, '2012-03-13 01:50:47', 0),
(80, 6, 0, NULL, 24, 1, '2012-03-16 12:25:45', 0),
(81, 6, 0, NULL, 3, 1, '2012-03-13 10:34:19', 0),
(82, 6, 0, NULL, 25, 1, '2012-03-09 19:22:47', 1),
(83, 1, 66, NULL, 14, 1, '2012-03-10 14:42:03', 0),
(84, 1, NULL, NULL, 14, 1, '2012-03-10 14:22:45', 1),
(85, 1, NULL, NULL, 1, 14, '2012-03-11 09:40:07', 0),
(86, 1, NULL, NULL, 14, 1, '2012-03-10 14:43:44', 1),
(87, 1, NULL, NULL, 24, 1, '2012-03-16 12:25:45', 0),
(88, 1, 71, NULL, 1, 27, '2012-03-11 00:28:00', 0),
(89, 6, 0, NULL, 23, 1, '2012-03-13 01:50:47', 0),
(90, 7, NULL, NULL, 27, 1, '2012-03-13 10:23:32', 0),
(91, 7, NULL, NULL, 27, 3, '2012-03-13 10:36:21', 0),
(92, 1, 72, NULL, 0, 0, '2012-03-28 11:31:35', 0),
(93, 1, 73, NULL, 1, 27, '2012-03-14 15:23:28', 0),
(94, 1, NULL, NULL, 27, 1, '2012-03-14 15:24:16', 0),
(95, 1, NULL, NULL, 1, 27, '2012-03-14 15:30:43', 0),
(96, 7, NULL, NULL, 27, 2, '2012-03-14 17:53:36', 0),
(98, 6, NULL, 56, 27, 1, '2012-03-14 18:05:51', 0),
(99, 1, NULL, NULL, 1, 27, '2012-03-16 01:52:12', 0),
(100, 1, NULL, NULL, 27, 1, '2012-03-16 01:57:14', 0),
(101, 1, NULL, NULL, 1, 27, '2012-03-20 03:29:56', 0),
(102, 1, 79, NULL, 3, 27, '2012-03-16 01:56:55', 0),
(103, 1, NULL, NULL, 27, 3, '2012-03-16 01:57:14', 0),
(104, 1, NULL, NULL, 3, 27, '2012-03-20 08:57:15', 0),
(105, 6, NULL, 45, 27, 1, '2012-03-22 16:17:22', 0),
(106, 7, NULL, NULL, 41, 1, '2012-06-07 09:32:34', 0),
(107, 7, NULL, NULL, 44, 1, '2012-06-15 07:15:40', 1),
(108, 1, 82, NULL, 44, 1, '2012-06-15 07:15:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mj_notification_type`
--

CREATE TABLE IF NOT EXISTS `mj_notification_type` (
  `noti_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `noti_type_name` varchar(20) NOT NULL,
  PRIMARY KEY (`noti_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `mj_notification_type`
--

INSERT INTO `mj_notification_type` (`noti_type_id`, `noti_type_name`) VALUES
(1, 'message'),
(2, 'idea'),
(3, 'market'),
(4, 'review'),
(5, 'commet'),
(6, 'group'),
(7, 'friend');

-- --------------------------------------------------------

--
-- Table structure for table `mj_nw_comment`
--

CREATE TABLE IF NOT EXISTS `mj_nw_comment` (
  `nwc_id` int(11) NOT NULL AUTO_INCREMENT,
  `nwc_body` text NOT NULL,
  `nwc_usr_id_fk` int(11) NOT NULL,
  `nwc_n_id_fk` int(11) NOT NULL,
  `nwc_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`nwc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mj_pages`
--

CREATE TABLE IF NOT EXISTS `mj_pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(200) NOT NULL,
  `page_content` text NOT NULL,
  `page_type` varchar(50) NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `mj_pages`
--

INSERT INTO `mj_pages` (`page_id`, `page_title`, `page_content`, `page_type`) VALUES
(1, 'Service and Support', '<p><span><strong>Objectives</strong></span></p>\r\n<p><span><strong><br /></strong></span></p>\r\n<p>Offer an opportunity to invest in a company dedicated to social media technologies for entrepreneurs.</p>\r\n<p><strong><br /></strong></p>\r\n<p><strong>Approach</strong></p>\r\n<p><strong><br /></strong></p>\r\n<p>Evolutionary new media avenues integrated in a single fluid technology platform for entrepreneurs and start-ups.</p>\r\n<p><strong><br /></strong></p>\r\n<p><strong>Benefits</strong></p>\r\n<p><strong><br /></strong></p>\r\n<ul>\r\n<li><strong></strong>A community to connect, share and learn between entrepreneurs and startups</li>\r\n<li>Co-creation platform to invent, improve, influence and contribute to the development of products and services among entrepreneurs and startups</li>\r\n<li>Marketplace to identify and secure funding for the products and services</li>\r\n<li>Commercial trading hub to match-make on the technologies, equipments and tools among entrepreneurs .</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>Need personal assistance?&nbsp;</strong></p>\r\n<p><strong><br /></strong></p>\r\n<p>Do contact us at :</p>\r\n<p><span>Tel &nbsp; &nbsp; &nbsp; &nbsp;: +6.03.7665.0607&nbsp;</span></p>\r\n<p><span>Fax &nbsp; &nbsp; &nbsp; : +6.03.7665.0610</span></p>\r\n<p><span>Website : www.innovatis.com.my</span></p>\r\n<p><strong><br /></strong></p>', 'Top'),
(2, 'Advertise with us', '<p><strong><span style=\\"font-size: xx-large;\\">Why advertise with us?</span></strong></p>', 'bottom'),
(3, 'How to submit a new post', '<p><span><strong>Idea Section</strong></span></p>\r\n<p><strong><br /></strong></p>\r\n<p>Step 1 &nbsp;: <span><strong>Click Idea Section</strong></span><br />Step 2 &nbsp;: <strong>Click New Idea</strong><br />Step 3 &nbsp;: <strong>Fill up the form</strong><br />Step 4 &nbsp;:<strong> Click Preview before submit</strong><br />Step 5 &nbsp;:<strong> Click Submit &amp; Upload visual/image</strong><br />Step 6 &nbsp;: <strong>Done!</strong><br />Step 7 &nbsp;: <strong>Edit images/video</strong><br />Step 8 &nbsp;:<strong> Set Default Cover</strong></p>\r\n<p>&nbsp;</p>\r\n<p><span><strong>Project Section</strong></span></p>\r\n<p><strong><br /></strong></p>\r\n<p>Step 1 &nbsp;:<strong> Click Idea Section</strong><br />Step 2 &nbsp;: <strong>Click New Idea</strong><br />Step 3 &nbsp;:<strong> Fill up the form</strong><br />Step 4 &nbsp;: <strong>Click Preview before submit</strong><br />Step 5 &nbsp;: <strong>Click Submit &amp; Upload visual / image</strong><br />Step 6 &nbsp;: <strong>Done!</strong><br />Step 7 &nbsp;: <strong>Edit images / video</strong><br />Step 8 &nbsp;: <strong>Set Default Cover</strong></p>\r\n<p>&nbsp;</p>\r\n<p><span><strong>Market Section</strong></span></p>\r\n<p><strong><br /></strong></p>\r\n<p>Step 1 &nbsp;:&nbsp;<strong>Click Idea Section</strong><br />Step 2 &nbsp;: <strong>Click New Idea</strong><br />Step 3 &nbsp;: <strong>Fill up the form</strong><br />Step 4 &nbsp;:<strong> Click Preview before submit</strong><br />Step 5 &nbsp;:<strong> Click Submit &amp; Upload visual / image</strong><br />Step 6 &nbsp;:<strong> Done!</strong><br />Step 7 &nbsp;:<strong> Edit images / video</strong><br />Step 8 &nbsp;:<strong> Set Default Cover</strong></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong><br /></strong></p>\r\n<p><iframe src=\\"http://www.youtube.com/embed/ZpVA65qN05U\\" frameborder=\\"0\\" width=\\"560\\" height=\\"315\\"></iframe></p>', 'Listing'),
(4, 'Submission Process', '<p><span style=\\"font-size: large;\\"><strong>Submission Process of each section</strong></span></p>', 'Listing');

-- --------------------------------------------------------

--
-- Table structure for table `mj_sector`
--

CREATE TABLE IF NOT EXISTS `mj_sector` (
  `sec_id` int(10) NOT NULL AUTO_INCREMENT,
  `sec_name` varchar(50) NOT NULL,
  PRIMARY KEY (`sec_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `mj_sector`
--

INSERT INTO `mj_sector` (`sec_id`, `sec_name`) VALUES
(1, 'Emergency services'),
(2, ' Banking and finance'),
(3, ' Business and management'),
(4, ' Charities and voluntary work'),
(5, ' Creative arts and culture'),
(6, ' Energy and utilities'),
(7, 'Engineering and manufacturing'),
(8, ' Environment and agriculture'),
(9, ' Government and public administration'),
(10, 'Health and social care'),
(11, ' Hospitality, tourism and sport'),
(12, 'IT and information services'),
(13, ' Law'),
(14, 'Marketing, advertising and PR'),
(15, ' Media and publishing'),
(16, ' Property and construction'),
(17, ' Recruitment and HR'),
(18, ' Retail and sales'),
(19, ' Science and pharmaceuticals'),
(20, ' Teaching and education'),
(21, ' Transport and logistics');

-- --------------------------------------------------------

--
-- Table structure for table `mj_services`
--

CREATE TABLE IF NOT EXISTS `mj_services` (
  `services_id` int(10) NOT NULL AUTO_INCREMENT,
  `services_name` varchar(60) NOT NULL,
  `sector_id_fk` int(11) DEFAULT NULL,
  PRIMARY KEY (`services_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=160 ;

--
-- Dumping data for table `mj_services`
--

INSERT INTO `mj_services` (`services_id`, `services_name`, `sector_id_fk`) VALUES
(1, 'Administrative officer', 1),
(2, 'Operational officer', 1),
(3, 'Technical officer', 1),
(4, 'Training and education officer', 1),
(5, 'Planning/management officer', 1),
(6, 'Firefighter', 1),
(7, 'Paramedic', 1),
(8, 'Police officer', 1),
(9, 'Actuary', 2),
(10, 'Chartered accountant', 2),
(11, 'Credit analyst', 2),
(12, 'Financial adviser', 2),
(13, 'Tax adviser', 2),
(14, 'Accounting technician', 3),
(15, 'Chartered accountant', 3),
(16, 'Chartered certified accountant', 3),
(17, 'Chartered management accountant', 3),
(18, 'Chartered public finance accountant', 3),
(19, 'Financial manager', 3),
(20, 'Tax adviser', 3),
(21, 'Advice worker', 4),
(22, 'Charity fundraiser', 4),
(23, 'Charity officer', 4),
(24, 'Community development worker', 4),
(25, 'Information officer', 4),
(26, 'International aid/development worker', 4),
(27, 'Marketing executive', 4),
(28, 'Public relations officer', 4),
(29, 'Volunteer coordinator', 4),
(30, 'Youth worker', 4),
(31, 'Exhibition designer', 5),
(32, 'Fashion designer', 5),
(33, 'Illustrator', 5),
(34, 'Photographer', 5),
(35, 'Textile designer', 5),
(36, 'Drilling engineer', 6),
(37, 'Energy manager', 6),
(38, 'Engineering geologist', 6),
(39, 'Environmental consultant', 6),
(40, 'Geophysicist/field seismologist', 6),
(41, 'Geoscientist', 6),
(42, 'Hydrogeologist', 6),
(43, 'Mudlogger', 6),
(44, 'Petroleum engineer', 6),
(45, 'Waste management officer', 6),
(46, 'Water quality scientist', 6),
(47, 'Wellsite geologist', 6),
(48, 'Aeronautical engineer', 7),
(49, 'Chemical development engineer', 7),
(50, 'Control and instrumentation engineer', 7),
(51, 'Production manager', 7),
(52, 'Technical sales engineer', 7),
(53, 'Agricultural consultant', 8),
(54, 'Amenity horticulturist', 8),
(55, 'Arboriculturist', 8),
(56, 'Commercial horticulturist', 8),
(57, 'Environmental consultant', 8),
(58, 'Environmental manager', 8),
(59, 'Farm manager', 8),
(60, 'Field trials officer', 8),
(61, 'Forest/woodland manager', 8),
(62, 'Land-based engineer', 8),
(63, 'Civil Service fast streamer', 9),
(64, 'Community development worker', 9),
(65, 'Diplomatic Services operational officer', 9),
(66, 'Housing manager/officer', 9),
(67, 'Museum education officer', 9),
(68, 'Police officer', 9),
(69, 'Tax inspector', 9),
(70, 'Tourism officer', 9),
(71, 'Trading standards officer', 9),
(72, 'Waste management officer', 9),
(73, 'Counsellor', 10),
(74, 'Dentist', 10),
(75, 'Midwife', 10),
(76, 'Speech and language therapist', 10),
(77, 'Youth worker', 10),
(78, 'Catering manager', 11),
(79, 'Event organiser', 11),
(80, 'Outdoor pursuits manager', 11),
(81, 'Sports development officer', 11),
(82, 'Tour manager', 11),
(83, 'Applications developer', 12),
(84, 'Database administrator', 12),
(85, 'Games developer', 12),
(86, 'Information systems manager', 12),
(87, 'IT consultant', 12),
(88, 'IT technical support officer', 12),
(89, 'IT trainer', 12),
(90, 'Multimedia programmer', 12),
(91, 'Software engineer', 12),
(92, 'Systems analyst', 12),
(93, 'Systems developer', 12),
(94, 'Barrister', 13),
(95, 'Barrister''s clerk', 13),
(96, 'Company secretary', 13),
(97, 'Legal executive', 13),
(98, 'Licensed conveyancer', 13),
(99, 'Patent attorney', 13),
(100, 'Solicitor', 13),
(101, 'Tax adviser', 13),
(102, 'Trade mark attorney', 13),
(103, 'Advertising account executive', 14),
(104, 'Advertising account planner', 14),
(105, 'Advertising art director', 14),
(106, 'Advertising copywriter', 14),
(107, 'Event organiser', 14),
(108, 'Market researcher', 14),
(109, 'Marketing executive', 14),
(110, 'Media buyer', 14),
(111, 'Media planner', 14),
(112, 'Public affairs consultant', 14),
(113, 'Public relations account executive', 14),
(114, 'Public relations officer', 14),
(115, 'Sales promotion account executive', 14),
(116, 'Commissioning editor', 15),
(117, 'Film/video editor', 15),
(118, 'Multimedia specialist', 15),
(119, 'Newspaper journalist', 15),
(120, 'Television production assistant', 15),
(121, 'Civil service fast streamer', 16),
(122, 'Ergonomist', 16),
(123, 'Facilities manager', 16),
(124, 'Management consultant', 16),
(125, 'Office manager', 16),
(126, 'Careers adviser/personal adviser', 17),
(127, 'Careers consultant', 17),
(128, 'Human resources officer', 17),
(129, 'Management consultant', 17),
(130, 'Occupational psychologist', 17),
(131, 'Office manager', 17),
(132, 'Recruitment consultant', 17),
(133, 'Sales executive', 17),
(134, 'Sales promotion account executive', 17),
(135, 'Training and development officer', 17),
(136, 'Fashion designer', 18),
(137, 'Human resources officer', 18),
(138, 'Market researcher', 18),
(139, 'Marketing executive', 18),
(140, 'Public relations officer', 18),
(141, 'Quality manager', 18),
(142, 'Retail buyer', 18),
(143, 'Retail manager', 18),
(144, 'Retail merchandiser', 18),
(145, 'Analytical chemist', 19),
(146, 'Animal technologist', 19),
(147, 'Biomedical scientist', 19),
(148, 'Clinical research associate', 19),
(149, 'Food technologist', 19),
(150, 'Medical physicist', 19),
(151, 'Meteorologist', 19),
(152, 'Product/process development scientist', 19),
(153, 'Regulatory affairs officer', 19),
(154, 'Research scientist (life sciences)', 19),
(155, 'Secondary school teacher', 19),
(156, 'Software engineer', 19),
(157, 'Statistician', 19),
(158, 'Teaching laboratory technician', 19),
(159, 'Toxicologist', 19);

-- --------------------------------------------------------

--
-- Table structure for table `mj_state`
--

CREATE TABLE IF NOT EXISTS `mj_state` (
  `state_id` int(10) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(30) NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `mj_state`
--

INSERT INTO `mj_state` (`state_id`, `state_name`) VALUES
(1, 'Perlis'),
(2, 'Kedah'),
(3, 'Penang'),
(4, 'Kelantan'),
(5, 'Terengganu'),
(6, 'Perak'),
(7, 'Pahang'),
(8, 'Selangor'),
(9, 'KL'),
(10, 'N. Sembilan'),
(11, 'Malacca'),
(12, 'Johore'),
(13, 'Sarawak'),
(14, 'Sabah');

-- --------------------------------------------------------

--
-- Table structure for table `mj_status`
--

CREATE TABLE IF NOT EXISTS `mj_status` (
  `status_id` int(10) NOT NULL AUTO_INCREMENT,
  `status_usr_id_fk` int(10) NOT NULL,
  `status_body` text NOT NULL,
  `status_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=80 ;

--
-- Dumping data for table `mj_status`
--

INSERT INTO `mj_status` (`status_id`, `status_usr_id_fk`, `status_body`, `status_date`) VALUES
(4, 1, 'Finally. yahooo!', '2012-02-23 08:47:46'),
(5, 2, 'Qlik is better! lets do it now!!', '2012-02-23 08:48:29'),
(6, 3, 'we need more time!!!!!!!!!!!!!!!!', '2012-02-23 08:49:37'),
(7, 23, 'Im new here. can someone teach me?', '2012-02-23 08:50:29'),
(8, 22, 'any search engine developer here?', '2012-02-23 08:51:08'),
(9, 22, 'i need more resources. can some one support me?', '2012-02-23 08:51:28'),
(10, 22, 'hello there?', '2012-02-23 08:51:34'),
(11, 24, 'join our group now!', '2012-02-23 08:52:42'),
(12, 24, 'Innovatis network stream here. follow us now!', '2012-02-23 08:53:07'),
(13, 14, 'any secretary company here?', '2012-02-23 08:55:10'),
(14, 1, 'there have many bug to fix it....', '2012-02-23 09:41:34'),
(15, 1, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz..........................................................................................................................................................................................', '2012-02-23 09:58:05'),
(16, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eget arcu ut ante imperdiet semper. Suspendisse non lacus leo. Phasellus dignissim lacinia ipsum, nec condimentum erat ullamcorper ac. Etiam urna purus, sollicitudin ut adipiscing pharetra, mol', '2012-02-23 09:59:30'),
(17, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eget arcu ut ante imperdiet semper. Suspendisse non lacus leo. Phasellus dignissim lacinia ipsum, nec condimentum erat ullamcorper ac. Etiam urna purus, sollicitudin ut adipiscing pharetra, molestie id ipsum. Curabitur semper, mi ac commodo dictum, dui enim bibendum est, quis bibendum dolor purus nec mi. Suspendisse in libero diam. Nullam convallis luctus magna, quis cursus enim auctor eget.', '2012-02-23 10:00:47'),
(18, 3, 'Feeding some url http://www.lipsum.com/feed/html', '2012-02-23 10:01:34'),
(19, 14, 'zzzzzzzzzz....', '2012-02-23 12:00:18'),
(20, 1, 'it friday!', '2012-02-24 02:37:22'),
(21, 1, 'Jom jumaat!', '2012-02-24 04:57:44'),
(22, 1, 'lalalalalalala', '2012-02-24 04:58:16'),
(23, 1, 'time is running out!', '2012-02-24 04:58:51'),
(24, 2, 'its monday... :)', '2012-02-26 23:50:22'),
(25, 25, 'Im new!', '2012-02-28 05:28:27'),
(26, 25, 'Working now on MOJO Social Business! :P', '2012-02-28 05:47:47'),
(27, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eu malesuada eros. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum placerat vehicula nulla in porttitor. Mauris eu quam purus. Ut sem elit, congue in sodales sit amet, tempus sit amet nibh. Vestibulum elit nibh, tempus eget placerat ac, porta et dui. Praesent euismod felis id est aliquet dictum bibendum lorem aliquam. Pellentesque rutrum, metus id tristique tristique, libero nisi consequat nunc, et fermentum lectus purus feugiat lacus. Ut viverra vehicula enim id sagittis', '2012-03-01 07:35:46'),
(28, 1, 'working on new interface now...', '2012-03-03 12:27:36'),
(29, 1, 'lalalalalala', '2012-03-03 12:27:51'),
(30, 1, 'having work now!', '2012-03-03 19:16:05'),
(31, 1, 'Let go dinner! Yeah', '2012-03-06 11:59:29'),
(32, 25, 'lalalalala', '2012-03-07 04:37:13'),
(33, 23, '@mahfudz where u now?', '2012-03-07 04:39:37'),
(34, 1, 'New look and feel! Yeah', '2012-03-07 11:42:28'),
(35, 3, 'Reseller Chili Melaka Contact us now!', '2012-03-07 11:44:26'),
(36, 2, 'looks better now!', '2012-03-07 15:48:37'),
(37, 1, 'Hello!', '2012-03-07 16:48:11'),
(38, 1, 'Flying Hanger 2 is so cool! Vote this product guys! http://localhost/v1/idea-details.php?id=1', '2012-03-07 17:05:46'),
(39, 2, 'Time! We should release beta version now.', '2012-03-09 08:38:00'),
(40, 25, 'jom solat and tido! yahoo', '2012-03-09 22:05:01'),
(41, 14, 'Im changing rite now! :)', '2012-03-09 22:09:28'),
(42, 1, 'Selesai sudah...yahoooo!', '2012-03-10 14:10:42'),
(43, 25, 'testing', '2012-03-10 16:29:34'),
(44, 27, 'Im new here!', '2012-03-10 16:43:23'),
(45, 1, '98% up to RC01', '2012-03-13 01:47:56'),
(46, 3, 'Welcome Alya!', '2012-03-14 17:41:42'),
(47, 27, 'I Got your timeline!', '2012-03-14 17:45:22'),
(48, 27, 'got another timeline! :P', '2012-03-14 17:50:36'),
(49, 1, 'i got too! :P', '2012-03-14 17:53:17'),
(50, 27, 'Lets tdo!', '2012-03-14 18:22:25'),
(51, 27, 'Agains..', '2012-03-14 18:24:40'),
(52, 27, 'agains...........', '2012-03-14 18:26:12'),
(53, 27, 'Testing agains', '2012-03-15 18:31:18'),
(54, 1, 'Beta version is out! please feel free to make a survey after you explore our site :)', '2012-03-16 12:22:46'),
(55, 1, 'Currently running now!', '2012-03-20 09:58:56'),
(56, 2, 'Up and loaded', '2012-04-25 15:28:09'),
(57, 37, 'Hi there Mojo', '2012-05-24 04:11:26'),
(58, 32, 'I''m searching for a business partner in Toy Manufacturing', '2012-05-24 04:12:32'),
(59, 34, 'Looking vendor for digital camera', '2012-05-24 04:13:52'),
(60, 36, 'Need more fund on my agricultural project', '2012-05-24 05:54:41'),
(61, 1, 'Hello There! Im new here', '2012-05-30 10:22:40'),
(62, 38, 'Hello There! Iam new here! :P', '2012-05-30 10:23:19'),
(63, 41, 'Need help on opening cloothing shop', '2012-06-06 06:55:19'),
(64, 1, 'Hye, next week we will launching our new PathFinder! So guys, just wait for the beta release.!!!!!', '2012-06-07 09:25:27'),
(65, 2, 'A few more days to go :)', '2012-06-08 03:16:42'),
(66, 42, 'I''m new... =)', '2012-06-09 17:51:00'),
(67, 43, 'Im new here', '2012-06-11 05:50:23'),
(68, 44, 'Multimedia Freelancer.Blogger.Penulis.Idealis.', '2012-06-13 15:47:34'),
(69, 47, 'Karnival kerjaya dan keusahawanan PWTC! see u there!', '2012-06-29 04:58:10'),
(70, 1, 'How going on?', '2012-07-24 04:24:08'),
(71, 1, 'Yeah!', '2012-09-12 04:58:36'),
(72, 56, 'hello', '2012-09-16 11:09:59'),
(73, 24, 'get susu kambing kat sini http://pathfinder.my/product-details.php?id=1069', '2012-09-21 15:29:11'),
(74, 2, 'Kambing Segar hubungi saya', '2012-09-23 15:24:03'),
(75, 22, 'Ukiran usahawan Felda. Asli', '2012-09-23 15:52:36'),
(76, 2, 'Planning to supply lamb to other countries. finalizing the documentation now :)', '2012-09-24 01:41:13'),
(77, 57, 'http://arminplace.blogspot.com/', '2012-09-24 04:59:17'),
(78, 60, 'Tempah Anak Pokok Kurma Hari Ini Pada ''Harga Mampu Milik''', '2012-11-06 03:14:33'),
(79, 60, 'www.klasikniaga.com.my\nklasikniaga@gmail.com', '2012-11-06 03:17:05');

-- --------------------------------------------------------

--
-- Table structure for table `mj_tours`
--

CREATE TABLE IF NOT EXISTS `mj_tours` (
  `tours_id` int(11) NOT NULL AUTO_INCREMENT,
  `tours_usr_id_fk` int(11) NOT NULL,
  `tours_section` int(1) NOT NULL,
  `tours_status` int(1) NOT NULL,
  PRIMARY KEY (`tours_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=108 ;

--
-- Dumping data for table `mj_tours`
--

INSERT INTO `mj_tours` (`tours_id`, `tours_usr_id_fk`, `tours_section`, `tours_status`) VALUES
(25, 1, 5, 0),
(24, 1, 4, 0),
(26, 1, 3, 0),
(27, 1, 2, 0),
(29, 1, 1, 0),
(30, 3, 5, 0),
(31, 3, 4, 0),
(32, 3, 3, 0),
(33, 3, 2, 0),
(34, 3, 1, 0),
(35, 0, 1, 0),
(36, 0, 3, 0),
(37, 2, 5, 0),
(38, 2, 4, 0),
(39, 2, 3, 0),
(40, 0, 4, 0),
(41, 0, 5, 0),
(42, 2, 1, 0),
(43, 2, 2, 0),
(44, 28, 5, 0),
(45, 28, 1, 0),
(46, 28, 2, 0),
(47, 28, 3, 0),
(48, 28, 4, 0),
(49, 29, 5, 0),
(50, 29, 2, 0),
(51, 29, 4, 0),
(52, 37, 5, 0),
(53, 32, 5, 0),
(54, 34, 5, 0),
(55, 34, 2, 0),
(56, 34, 4, 0),
(57, 36, 5, 0),
(58, 38, 5, 0),
(59, 41, 5, 0),
(60, 41, 4, 0),
(61, 41, 1, 0),
(62, 41, 2, 0),
(63, 0, 2, 0),
(64, 42, 5, 0),
(65, 42, 1, 0),
(66, 43, 5, 0),
(67, 43, 1, 0),
(68, 43, 2, 0),
(69, 43, 3, 0),
(70, 43, 4, 0),
(71, 44, 5, 0),
(72, 46, 5, 0),
(73, 47, 5, 0),
(74, 47, 1, 0),
(75, 47, 2, 0),
(76, 47, 3, 0),
(77, 47, 4, 0),
(78, 48, 5, 0),
(79, 56, 5, 0),
(80, 56, 1, 0),
(81, 56, 2, 0),
(82, 56, 3, 0),
(83, 56, 4, 0),
(84, 24, 5, 0),
(85, 24, 1, 0),
(86, 24, 2, 0),
(87, 24, 3, 0),
(88, 24, 4, 0),
(89, 22, 5, 0),
(90, 22, 3, 0),
(91, 22, 4, 0),
(92, 22, 1, 0),
(93, 22, 2, 0),
(94, 57, 5, 0),
(95, 57, 1, 0),
(96, 57, 2, 0),
(97, 60, 5, 0),
(98, 60, 1, 0),
(99, 60, 2, 0),
(100, 60, 3, 0),
(101, 66, 5, 0),
(102, 66, 3, 0),
(103, 67, 5, 0),
(104, 67, 1, 0),
(105, 67, 2, 0),
(106, 67, 3, 0),
(107, 67, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mj_users`
--

CREATE TABLE IF NOT EXISTS `mj_users` (
  `usr_id` int(20) NOT NULL AUTO_INCREMENT,
  `usr_name` text NOT NULL,
  `usr_pwd` text NOT NULL,
  `usr_email` text NOT NULL,
  `user_pic` text,
  `usr_lvl` int(1) DEFAULT NULL,
  `usr_acct_status` int(1) DEFAULT NULL,
  `usr_cnfm_key` text,
  `usr_cnfrm_datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usr_last_login` text,
  `usr_workat` text,
  `usr_tel` text,
  `usr_general_info` text,
  `usr_core_activity` text,
  `usr_rating` int(11) DEFAULT NULL,
  `mj_sector_fk` int(11) DEFAULT NULL,
  `mj_services_fk` int(11) DEFAULT NULL,
  `mj_state_fk` int(11) DEFAULT NULL,
  `mj_country_id_fk` int(11) DEFAULT NULL,
  PRIMARY KEY (`usr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

--
-- Dumping data for table `mj_users`
--

INSERT INTO `mj_users` (`usr_id`, `usr_name`, `usr_pwd`, `usr_email`, `user_pic`, `usr_lvl`, `usr_acct_status`, `usr_cnfm_key`, `usr_cnfrm_datetime`, `usr_last_login`, `usr_workat`, `usr_tel`, `usr_general_info`, `usr_core_activity`, `usr_rating`, `mj_sector_fk`, `mj_services_fk`, `mj_state_fk`, `mj_country_id_fk`) VALUES
(1, 'mahfudz', '082ee1a3fb7990bf721d44953cfaec2d', 'mahfudz@richcoremedia.com', 'uploads/avatar/P1500[01]_26-02-12.JPG', 1, 1, NULL, '2012-01-20 12:04:18', '2012-09-14 12:38:28:pm', 'Rcm', '0132465974', 'FInally, im become master!', 'Describe your core activity', 0, 1, 1, 9, 1),
(2, 'Dzairil', '5f4dcc3b5aa765d61d8327deb882cf99', 'd.z@mail.com', '/uploads/senyum-kambing1.jpg', 1, 1, NULL, '2012-01-22 15:39:58', '2012-09-23 11:24:08:pm', 'Dzairil Kambing Segar', '0123424796', 'Kambing Segar Provider', 'Pengusaha Penternakan Daging Kambing di sekitar Lembah Klang', 1, 8, 59, 9, 1),
(3, 'Mat', 'c049a088004a7cf812c1797654d2d4c6', 'mat@richcoremedia.com', 'uploads/avatar/mat.jpeg', 0, 1, NULL, '2012-02-06 04:45:31', '2012-04-3 4:08:18:pm', 'Entreprenuer', '0132465974', 'FInally, im become master!', 'Describe your core activity', 2, 2, 2, 3, 1),
(14, 'Ina Lucy', 'c049a088004a7cf812c1797654d2d4c6', 'umi@richcoremedia.com', 'uploads/avatar/ina.jpeg', 0, 1, 'E5rxsLJR', '2012-02-09 05:01:39', '2012-03-10 10:43:06:pm', 'Entreprenuer', '0132465974', 'FInally, im become master!', 'Describe your core activity', 0, 1, 1, 1, 1),
(22, 'Fadzil', '5f4dcc3b5aa765d61d8327deb882cf99', 'fadzil@richcoremedia.com', 'uploads/avatar/fazil.jpeg', 0, 1, '2N6j9dFw', '2012-02-09 05:53:42', '2012-09-23 11:59:17:pm', 'Koperasi Felda', '0132465974', 'Koperasi Felda Member', 'Usahawan Ukiran asli', 0, 5, 35, 7, 1),
(23, 'Amirul', 'c049a088004a7cf812c1797654d2d4c6', 'amirul@gmail.com', 'uploads/avatar/amirul.jpeg', 0, 1, 'QcnU7GwC', '2012-02-12 04:59:03', '2012-03-13 6:34:08:pm', 'Entreprenuer', '0132465974', 'FInally, im become master!', 'Describe your core activity', 0, 1, 1, 2, 1),
(24, 'Imran', '5f4dcc3b5aa765d61d8327deb882cf99', 'dzairilimran@gmail.com', 'uploads/avatar/dz.jpeg', 0, 1, '3cw8xHUW', '2012-02-14 04:50:49', '2012-09-21 11:53:24:pm', 'Kambing Segar Sdn Bhd', '0132465974', 'Usahawan Kambing', 'Usahawan Kambing di Selangor', 0, 3, 0, 8, 1),
(25, 'Ajib Afro', 'c049a088004a7cf812c1797654d2d4c6', 'razif@richcoremedia.com', 'uploads/avatar/ajib.jpeg', 0, 1, '5RuFhMoN', '2012-02-27 05:21:12', '2012-03-11 12:30:34:am', 'Entreprenuer', 'NULL', 'NULL', 'Describe your core activity', 0, 2, 2, 3, 1),
(26, 'Rafizi Hashim', 'c049a088004a7cf812c1797654d2d4c6', 'rafizi@gmail.com', 'uploads/avatar/rafizi.jpeg', 0, 1, 'kU170P9F', '2012-02-27 05:28:00', '2012-03-7 12:30:29:pm', 'Entreprenuer', '012897362', 'Aku pembekal ikan keli di sg.petani', 'Describe your core activity', 0, 2, 3, 3, 1),
(27, 'Alya', 'c049a088004a7cf812c1797654d2d4c6', 'alya@gmail.com', 'uploads/avatar/alya.jpeg', 0, 1, 'iAT8Vcrt', '2012-03-10 16:31:40', '2012-03-30 11:47:33:am', 'Entreprenuer', '0', '0', 'Describe your core activity', 3, 1, 1, 1, 1),
(28, 'sazn86', 'cab561712f682b33ac64541b1b592b71', 'sazn86@gmail.com', 'images/users.png', 0, 1, 'UZHfMrRi', '2012-05-06 15:21:02', NULL, 'Entreprenuer', '0', '0', 'Describe your core activity', 0, 1, 1, 1, 1),
(29, 'Zulfadli', 'c049a088004a7cf812c1797654d2d4c6', 'zulfadli@yahoo.com', 'images/users.png', 0, 1, NULL, '2012-05-20 09:44:26', '2012-05-22 1:46:46:pm', 'Enterpreneur', NULL, NULL, NULL, 0, 6, 1, 1, 1),
(30, 'Azrulmukmin', 'c049a088004a7cf812c1797654d2d4c6', 'Azrul@yahoo.com', 'images/users.png', 0, 1, NULL, '2012-05-20 09:47:58', NULL, 'Enterpreneur', NULL, NULL, NULL, 0, 10, 2, 1, 1),
(31, 'Shahreza', 'c049a088004a7cf812c1797654d2d4c6', 'shah@gmail.com', 'images/users.png', 0, 1, NULL, '2012-05-20 09:53:31', NULL, 'Enterpreneur', NULL, NULL, NULL, 0, 1, 1, 1, 1),
(32, 'Chow Kar Meng', 'c049a088004a7cf812c1797654d2d4c6', 'Chokm@yahoo.com', 'uploads/avatar/cmeng.jpeg', 0, 1, NULL, '2012-05-20 09:55:40', '2012-05-24 12:12:36:pm', 'Enterpreneur', NULL, NULL, NULL, 0, 12, 1, 1, 1),
(33, 'David Arumugam', 'c049a088004a7cf812c1797654d2d4c6', 'Davidaru@yahoo.com', 'images/users.png', 0, 1, NULL, '2012-05-20 09:56:53', NULL, 'Enterpreneur', NULL, NULL, NULL, 0, 1, 1, 1, 1),
(34, 'Christin Yap', 'c049a088004a7cf812c1797654d2d4c6', 'Chrisyap@gmail.com', 'uploads/avatar/cyap.jpeg', 0, 1, NULL, '2012-05-20 10:02:17', '2012-05-24 1:53:42:pm', 'Enterpreneur', NULL, NULL, NULL, 0, 3, 3, 1, 1),
(35, 'Seri Devi', 'c049a088004a7cf812c1797654d2d4c6', 'Seridevi@yahoo.com', 'images/users.png', 0, 1, NULL, '2012-05-20 10:06:25', NULL, 'Enterpreneur', NULL, NULL, NULL, 0, 1, 1, 1, 1),
(36, 'Mahaletchumi', 'c049a088004a7cf812c1797654d2d4c6', 'Maha@lhdpn.com', 'uploads/avatar/maha.jpeg', 0, 1, NULL, '2012-05-20 10:07:40', '2012-05-24 1:54:45:pm', 'Enterpreneur', NULL, NULL, NULL, 0, 15, 1, 1, 1),
(37, 'Siva Balan', 'c049a088004a7cf812c1797654d2d4c6', 'Siva@lhdpn.com', 'uploads/avatar/siva.jpeg', 0, 1, NULL, '2012-05-20 10:11:42', '2012-05-24 12:11:31:pm', 'Enterpreneur', NULL, NULL, NULL, 0, 4, 2, 1, 1),
(38, 'fofodesign', 'c049a088004a7cf812c1797654d2d4c6', 'fofodesign@gmail.com', 'uploads/avatar/fofo.jpeg', 0, 1, 'r7eZRIa0', '2012-05-30 10:14:32', '2012-05-30 6:23:24:pm', 'Fofo Design', '0', '0', 'Describe your core activity', 0, 1, 1, 1, 1),
(39, 'AMN', 'c049a088004a7cf812c1797654d2d4c6', 'amn@amn.com.my', 'images/users.png', 0, 0, 'ROua2IkJ', '2012-05-30 10:27:20', NULL, 'Entreprenuer', '0', '0', 'Describe your core activity', 0, 1, 1, 1, 1),
(40, 'abc', 'c049a088004a7cf812c1797654d2d4c6', 'abc@def.com', 'images/users.png', 0, 0, 'd0pfx26X', '2012-06-06 04:40:21', NULL, 'Entreprenuer', '0', '0', 'Describe your core activity', 0, 1, 1, 1, 1),
(41, 'farahwani', 'c049a088004a7cf812c1797654d2d4c6', 'farahwani_88@yahoo.com', 'uploads/avatar/farah.jpeg', 0, 1, 'KjhbL0x6', '2012-06-06 06:16:05', '2012-06-7 5:33:04:pm', 'Entreprenuer', '0', '0', 'Describe your core activity', 1, 1, 1, 1, 1),
(42, 'pg2393', '9878abd3f60acce1c86e032735392d00', 'pg2393@gmail.com', 'uploads/avatar/pg.jpeg', 0, 1, 'c498RTJi', '2012-06-09 17:47:47', NULL, 'Entreprenuer', '0', '0', 'Describe your core activity', 0, 1, 1, 1, 1),
(43, 'Mohamedjasren', 'c049a088004a7cf812c1797654d2d4c6', 'Mohamedjasren@yahoo.com', 'uploads/avatar/jasren.jpeg', 0, 1, 'z4Fsoykg', '2012-06-11 05:48:07', NULL, 'Entreprenuer', '0', '0', 'Describe your core activity', 0, 1, 1, 1, 1),
(44, 'ultimatebot', '2c3c6c914aab75b6e188b0c8d19ef073', 'ultimatebot@live.com', 'uploads/avatar/ubot.jpeg', 0, 1, 'B8d1qTgm', '2012-06-13 15:23:30', '2012-06-15 5:07:16:am', 'Entreprenuer', '0', 'Multimedia Freelancer.\r\nBlogger.\r\nPenulis.\r\nIdealis.', 'Idealist.', 0, 1, 1, 9, 1),
(45, 'sweeties', 'e10adc3949ba59abbe56e057f20f883e', 'Ruby_sweeties@yahoo.com', 'uploads/avatar/sweet.jpeg', 0, 0, 'tp5un1YI', '2012-06-20 23:41:56', NULL, 'Entreprenuer', '0', '0', 'Describe your core activity', 0, 1, 1, 1, 1),
(47, 'infovisualiation', '5f4dcc3b5aa765d61d8327deb882cf99', 'mr.infovis@gmail.com', 'uploads/avatar/infov.jpeg', 0, 1, 'GWq3TSvs', '2012-06-29 04:51:44', '2012-06-29 1:01:36:pm', 'Entreprenuer', '0', '0', 'Describe your core activity', 0, 1, 1, 1, 1),
(49, 'hafizmanap', 'fb69460520c49b16aac87486174d16f8', 'apis_teentitan@yahoo.com', 'uploads/avatar/hafiz.jpeg', 0, 0, 'xnFuBpo8', '2012-07-02 04:51:59', NULL, 'Entreprenuer', '0', '0', 'Describe your core activity', 0, 1, 1, 1, 1),
(50, 'hafizmanap', 'fb69460520c49b16aac87486174d16f8', 'apis_teentitan@yahoo.com', 'images/users.png', 0, 1, 'Qhvp2gV4', '2012-07-02 04:52:03', NULL, 'Entreprenuer', '0', '0', 'Describe your core activity', 0, 1, 1, 1, 1),
(51, 'hafizmanap', 'fb69460520c49b16aac87486174d16f8', 'apis_teentitan@yahoo.com', 'images/users.png', 0, 0, '5YGuLO3k', '2012-07-02 04:52:04', NULL, 'Entreprenuer', '0', '0', 'Describe your core activity', 0, 1, 1, 1, 1),
(52, 'munira', '2ca21ffcf94a14848a7448fc9256c698', 'munira1850@yahoo.com.my', 'images/users.png', 0, 1, 'XP0tUMVm', '2012-07-04 12:39:06', NULL, 'Entreprenuer', '0', '0', 'Describe your core activity', 0, 1, 1, 1, 1),
(53, 'jibon', 'ff53902e27cdb0f2ee02d17da8d7120f', 'jibon@jiban.com', 'images/users.png', 0, 0, 'bIek5S6Q', '2012-08-27 13:50:59', NULL, 'Entreprenuer', '0', '0', 'Describe your core activity', 0, 1, 1, 1, 1),
(54, 'eiza', '887af41e547ac9f71e70aa16caa3abc3', 'unic_nice@yahoo.com', 'images/users.png', 0, 1, 'PZLd7txn', '2012-08-29 06:26:39', NULL, 'Entreprenuer', '0', '0', 'Describe your core activity', 0, 1, 1, 1, 1),
(55, 'irwan', '9653d4af36ef1e0c3fd78f051cd3ef50', 'rpa_2boy@yahoo.com.my', 'images/users.png', 0, 0, 'XMJvzETB', '2012-09-10 07:36:50', NULL, 'Entreprenuer', '0', '0', 'Describe your core activity', 0, 1, 1, 1, 1),
(56, 'RCM Rock', '5f4dcc3b5aa765d61d8327deb882cf99', 'hello@richcoremedia.com', 'images/users.png', 0, 1, 'nxWJZja8', '2012-09-16 10:52:30', '2012-09-16 7:10:29:pm', 'Entreprenuer', '0', '0', 'Describe your core activity', 0, 1, 1, 1, 1),
(57, 'arminakbar', '59d8c4aefe966d178bdfed13241074eb', 'armin_akbar@hotmail.com', 'images/users.png', 0, 1, 'rTwi6Eye', '2012-09-24 04:48:43', NULL, 'Entreprenuer', '0', 'http://arminplace.blogspot.com/', 'Describe your core activity', 0, 14, 0, 6, 1),
(58, 'Nur Farah Rohaida', '8a7d538e75e611b58acfac684aa23cf9', 'rohaidafarah@yahoo.com', 'images/users.png', 0, 0, '3edJ0OmQ', '2012-09-30 13:17:20', NULL, 'Entreprenuer', '0', '0', 'Describe your core activity', 0, 1, 1, 1, 1),
(59, 'Nur Farah Rohaida', '8a7d538e75e611b58acfac684aa23cf9', 'rohaidafarah@yahoo.com', 'images/users.png', 0, 0, 'rTwztGIq', '2012-09-30 13:18:15', NULL, 'Entreprenuer', '0', '0', 'Describe your core activity', 0, 1, 1, 1, 1),
(60, 'klasikniaga', '1fdbeff0b0d68897e2e2cba0dd8158f2', 'klasikniaga@gmail.com', '/uploads/IMG_3385.JPG', 0, 1, 'EikY1hdR', '2012-11-06 02:55:39', '2012-11-6 11:28:48:am', 'Chemor, Perak', '0195709334', 'Klasik Niaga pakar dalam penyemaian anak pokok kurma. Kami dalam perancangan melaksanakan Projek Tanaman Pokok Kurma dimana matlamat utamanya untuk menjadikan pokok kurma sebagai tanaman hiasan pilihan ramai dan mengahasilkan produk-produk berasaskan buah kurma yang ditanam sendiri di Malaysia.', 'Anak Pokok Kurma', 0, 8, 0, 6, 1),
(61, 'oujie', '62ea6d0904437d004d998d7b9dbc47cb', 'ogjyd_curecore@yahoo.com.my', 'images/users.png', 0, 0, 'VZq7HfYi', '2012-11-09 07:28:06', NULL, 'Entreprenuer', '0', '0', 'Describe your core activity', 0, 1, 1, 1, 1),
(62, 'ameron', '31a8d696befc0c78c60e368a7b14e9ff', 'ameronr@gmail.com', 'images/users.png', 0, 0, 'qsY943GJ', '2012-11-10 02:59:22', NULL, 'Entreprenuer', '0', '0', 'Describe your core activity', 0, 1, 1, 1, 1),
(63, 'wiliamhong', 'c13f7d7ba47b80dd2157cf3038b4448e', 'hong121@live.com', 'images/users.png', 0, 1, 'i5Cr1Rbo', '2012-11-11 04:14:30', NULL, 'Entreprenuer', '0', '0', 'Describe your core activity', 0, 1, 1, 1, 1),
(64, 'aen', '40b2757a7271d779886261c3d90ed862', 'azrinhamidi@gmail.com', 'images/users.png', 0, 1, 'zLvl3n5U', '2012-11-16 11:20:15', NULL, 'Entreprenuer', '0', '0', 'Describe your core activity', 0, 1, 1, 1, 1),
(65, 'lieya yusof', '377f09f6b12936e12a980e142d86b315', 'aina_azlan91@yahoo.com.my', 'images/users.png', 0, 0, '9awSs1KC', '2012-11-26 08:03:42', NULL, 'Entreprenuer', '0', '0', 'Describe your core activity', 0, 1, 1, 1, 1),
(66, 'syazwani86', '8a8b97a73e654d5338481f2a6e661314', 'syazani_aq@yahoo.com', 'images/users.png', 0, 1, 'w8e4vAZC', '2012-11-28 04:36:00', NULL, 'Entreprenuer', '0', '0', 'Describe your core activity', 0, 1, 1, 1, 1),
(67, 'yana', '5f4dcc3b5aa765d61d8327deb882cf99', 'haryana@richcoremedia.com', 'images/users.png', 0, 1, 'znLEZmpQ', '2012-12-07 02:20:18', '2012-12-7 10:24:42:am', 'Entreprenuer', '0', '0', 'Describe your core activity', 0, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mj_usr_com_relation`
--

CREATE TABLE IF NOT EXISTS `mj_usr_com_relation` (
  `usrcomrelation_id` int(10) NOT NULL AUTO_INCREMENT,
  `usrcomrelation_usr_id_fk` int(10) NOT NULL,
  `com_id_fk` int(10) NOT NULL,
  PRIMARY KEY (`usrcomrelation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mj_usr_network`
--

CREATE TABLE IF NOT EXISTS `mj_usr_network` (
  `usr_network_id` int(10) NOT NULL AUTO_INCREMENT,
  `usr_network_usr_id_fk` int(10) NOT NULL,
  `usr_network_friend_usr_id_fk` int(10) NOT NULL,
  `usr_network_approved` int(10) NOT NULL,
  PRIMARY KEY (`usr_network_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;

--
-- Dumping data for table `mj_usr_network`
--

INSERT INTO `mj_usr_network` (`usr_network_id`, `usr_network_usr_id_fk`, `usr_network_friend_usr_id_fk`, `usr_network_approved`) VALUES
(1, 1, 2, 0),
(2, 2, 1, 0),
(3, 3, 1, 0),
(4, 3, 2, 0),
(5, 3, 14, 0),
(7, 3, 22, 0),
(8, 1, 23, 0),
(9, 24, 1, 0),
(11, 1, 3, 0),
(13, 2, 2, 0),
(14, 23, 1, 0),
(15, 22, 3, 0),
(16, 2, 3, 0),
(17, 23, 23, 1),
(19, 23, 2, 0),
(20, 2, 23, 0),
(21, 23, 3, 0),
(22, 3, 23, 0),
(23, 23, 14, 0),
(24, 14, 23, 0),
(25, 2, 22, 0),
(26, 22, 2, 0),
(27, 1, 24, 0),
(28, 2, 24, 0),
(29, 24, 2, 0),
(30, 2, 14, 0),
(31, 14, 2, 0),
(32, 1, 1, 0),
(33, 3, 3, 0),
(34, 14, 14, 0),
(35, 24, 3, 0),
(36, 3, 24, 0),
(37, 25, 25, 0),
(38, 26, 26, 0),
(40, 1, 25, 0),
(41, 25, 1, 0),
(42, 25, 24, 0),
(43, 24, 25, 0),
(44, 25, 2, 0),
(45, 2, 25, 0),
(46, 25, 14, 0),
(47, 14, 25, 0),
(48, 27, 27, 0),
(53, 1, 27, 0),
(54, 27, 1, 0),
(55, 3, 27, 0),
(56, 27, 3, 0),
(57, 2, 27, 0),
(58, 27, 2, 0),
(59, 28, 28, 0),
(60, 1, 37, 0),
(61, 1, 32, 0),
(62, 1, 29, 0),
(63, 1, 30, 0),
(64, 1, 34, 0),
(65, 1, 36, 0),
(66, 38, 38, 0),
(67, 39, 39, 0),
(68, 40, 40, 0),
(69, 41, 41, 0),
(70, 1, 41, 0),
(71, 41, 1, 0),
(72, 42, 42, 0),
(73, 43, 43, 0),
(74, 44, 44, 0),
(75, 1, 44, 1),
(76, 44, 1, 1),
(77, 45, 45, 0),
(78, 46, 46, 0),
(79, 47, 47, 0),
(80, 48, 48, 0),
(81, 49, 49, 0),
(82, 50, 50, 0),
(83, 51, 51, 0),
(84, 52, 52, 0),
(85, 53, 53, 0),
(86, 54, 54, 0),
(87, 55, 55, 0),
(88, 56, 56, 0),
(89, 57, 57, 0),
(90, 58, 58, 0),
(91, 59, 59, 0),
(92, 60, 60, 0),
(93, 61, 61, 0),
(94, 62, 62, 0),
(95, 63, 63, 0),
(96, 64, 64, 0),
(97, 65, 65, 0),
(98, 66, 66, 0),
(99, 67, 67, 0);

-- --------------------------------------------------------

--
-- Table structure for table `_company`
--

CREATE TABLE IF NOT EXISTS `_company` (
  `comp_id` int(11) NOT NULL AUTO_INCREMENT,
  `comp_pic` text,
  `comp_name` text NOT NULL,
  `comp_desc` text,
  `comp_co_num` text NOT NULL,
  `mj_sector_fk` int(11) DEFAULT NULL,
  `mj_services_fk` int(11) DEFAULT NULL,
  `mj_state_fk` int(11) DEFAULT NULL,
  `is_founder` int(11) DEFAULT NULL,
  `ispublished` int(11) DEFAULT NULL,
  `isfeatured` int(11) DEFAULT NULL,
  PRIMARY KEY (`comp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `_company`
--

INSERT INTO `_company` (`comp_id`, `comp_pic`, `comp_name`, `comp_desc`, `comp_co_num`, `mj_sector_fk`, `mj_services_fk`, `mj_state_fk`, `is_founder`, `ispublished`, `isfeatured`) VALUES
(1, 'uploads/founder/rcm_logo.png', 'Rich Core Media', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tincidunt, nibh id hendrerit egestas, nisi dui auctor mi, quis tincidunt tellus risus nec neque. Nullam semper justo quis libero vulputate malesuada luctus sem volutpat. Nullam diam nibh, venenatis quis elementum a, tempus eget augue. Donec ultricies purus quis velit scelerisque interdum auctor elit hendrerit. Nunc dictum porta aliquet. Aenean viverra turpis quis elit venenatis mollis. Vestibulum rhoncus lobortis lacus at suscipit. Mauris sit amet fermentum enim. Integer nec erat quis nisi sollicitudin lobortis vitae eu mauris.', '001988694-U', 1, 1, 1, 1, 0, 1),
(2, 'uploads/founder/founders.png', 'Sastred One Sdn Bhd', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tincidunt, nibh id hendrerit egestas, nisi dui auctor mi, quis tincidunt tellus risus nec neque. Nullam semper justo quis libero vulputate malesuada luctus sem volutpat. Nullam diam nibh, venenatis quis elementum a, tempus eget augue. Donec ultricies purus quis velit scelerisque interdum auctor elit hendrerit. Nunc dictum porta aliquet. Aenean viverra turpis quis elit venenatis mollis. Vestibulum rhoncus lobortis lacus at suscipit. Mauris sit amet fermentum enim. Integer nec erat quis nisi sollicitudin lobortis vitae eu mauris.', '112233-X', 1, 1, 1, 0, 0, 0),
(3, 'uploads/founder/inno_logo.png', 'Innovatis Sdn Bhd', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tincidunt, nibh id hendrerit egestas, nisi dui auctor mi, quis tincidunt tellus risus nec neque. Nullam semper justo quis libero vulputate malesuada luctus sem volutpat. Nullam diam nibh, venenatis quis elementum a, tempus eget augue. Donec ultricies purus quis velit scelerisque interdum auctor elit hendrerit. Nunc dictum porta aliquet. Aenean viverra turpis quis elit venenatis mollis. Vestibulum rhoncus lobortis lacus at suscipit. Mauris sit amet fermentum enim. Integer nec erat quis nisi sollicitudin lobortis vitae eu mauris.', '223344-X', 1, 1, 1, 1, 0, 1),
(4, 'uploads/founder/founders.png', 'company a', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tincidunt, nibh id hendrerit egestas, nisi dui auctor mi, quis tincidunt tellus risus nec neque. Nullam semper justo quis libero vulputate malesuada luctus sem volutpat. Nullam diam nibh, venenatis quis elementum a, tempus eget augue. Donec ultricies purus quis velit scelerisque interdum auctor elit hendrerit. Nunc dictum porta aliquet. Aenean viverra turpis quis elit venenatis mollis. Vestibulum rhoncus lobortis lacus at suscipit. Mauris sit amet fermentum enim. Integer nec erat quis nisi sollicitudin lobortis vitae eu mauris.', '12324122', 1, 1, 1, 1, 0, 0),
(5, 'uploads/founder/bsn.png', 'Bank Simpanan Nasional', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tincidunt, nibh id hendrerit egestas, nisi dui auctor mi, quis tincidunt tellus risus nec neque. Nullam semper justo quis libero vulputate malesuada luctus sem volutpat. Nullam diam nibh, venenatis quis elementum a, tempus eget augue. Donec ultricies purus quis velit scelerisque interdum auctor elit hendrerit. Nunc dictum porta aliquet. Aenean viverra turpis quis elit venenatis mollis. Vestibulum rhoncus lobortis lacus at suscipit. Mauris sit amet fermentum enim. Integer nec erat quis nisi sollicitudin lobortis vitae eu mauris.', 'asdasd1212', 2, 2, 2, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `_company_director`
--

CREATE TABLE IF NOT EXISTS `_company_director` (
  `_cd_id` int(11) NOT NULL AUTO_INCREMENT,
  `_cd_name` varchar(25) NOT NULL,
  `_cd_ic` text NOT NULL,
  `_comp_id_fk` int(11) DEFAULT NULL,
  PRIMARY KEY (`_cd_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `_company_director`
--

INSERT INTO `_company_director` (`_cd_id`, `_cd_name`, `_cd_ic`, `_comp_id_fk`) VALUES
(2, 'Muhamad Mahfudz Idris', '870922435553', 1),
(3, 'Muhamad Mahfudz Idris', '870922435553', 2),
(4, 'Azamin', '791112145807', 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
