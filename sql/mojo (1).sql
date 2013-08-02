-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 13, 2012 at 11:45 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mojo`
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `mj_fund_category`
--

INSERT INTO `mj_fund_category` (`fund_cat_id`, `fund_cat_name`) VALUES
(1, 'design'),
(2, 'education'),
(3, 'application');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mj_fund_comment`
--

INSERT INTO `mj_fund_comment` (`fund_comment_id`, `fund_usr_id_fk`, `fund_post_id_fk`, `fund_comment_body`, `fund_comment_date`) VALUES
(1, 1, 3, 'This is cool man!', '2012-02-07 20:56:47');

-- --------------------------------------------------------

--
-- Table structure for table `mj_fund_pledged`
--

CREATE TABLE IF NOT EXISTS `mj_fund_pledged` (
  `fund_pledged_id` int(10) NOT NULL AUTO_INCREMENT,
  `fund_usr_id_fk` int(10) NOT NULL,
  `fund_post_id_fk` int(10) NOT NULL,
  `fund_money` int(10) NOT NULL,
  PRIMARY KEY (`fund_pledged_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `mj_fund_pledged`
--

INSERT INTO `mj_fund_pledged` (`fund_pledged_id`, `fund_usr_id_fk`, `fund_post_id_fk`, `fund_money`) VALUES
(1, 2, 1, 5000),
(2, 3, 1, 5000),
(4, 3, 2, 7500),
(5, 3, 1, 5000),
(6, 1, 3, 10000),
(7, 2, 3, 10000);

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
  `fund_post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fund_post_ended` text NOT NULL,
  `fund_post_video` text NOT NULL,
  `fund_post_ratup` int(10) DEFAULT NULL,
  `fund_post_ratdown` int(10) DEFAULT NULL,
  `fund_post_published` int(2) DEFAULT NULL,
  PRIMARY KEY (`fund_post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `mj_fund_post`
--

INSERT INTO `mj_fund_post` (`fund_post_id`, `fund_usr_id_fk`, `fund_cat_id_fk`, `fund_post_title`, `fund_post_short_brief`, `fund_post_business_model`, `fund_post_customer_market`, `fund_post_accesstiming`, `fund_post_economic_trends`, `fund_post_tech_dev_inno`, `fund_post_ip_regulation`, `fund_post_industry_future`, `fund_post_idea_development`, `fund_post_project_budget`, `fund_post_funding_miles`, `fund_post_image`, `fund_post_date`, `fund_post_ended`, `fund_post_video`, `fund_post_ratup`, `fund_post_ratdown`, `fund_post_published`) VALUES
(1, 1, 1, 'Helmet', 'On this site, you will find online tools to perform common string manipulations such as reversing a string.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc tristique molestie elit quis pulvinar. Proin porta congue nulla non feugiat. Fusce ut velit sapien, vel molestie diam. Sed interdum ligula eget erat ornare molestie.', 'Customer', 'Market', 'Economic', 'Technology', 'IP', 'Future Plans', 'Idea Development', '20000', 'Cash Flow', 'uploads/project/1-February-6-2012-12-59-48-am-2_MG_4330.jpg', '2012-02-07 20:39:09', '2012-02-20 0:59:48', 'uploads/project/1-February-6-2012-12-59-48-am-x-dot.mp4', 0, 1, 1),
(2, 1, 2, 'Wild Life Descovery', 'On this site, you will find online tools to perform common string manipulations such as reversing a string.', 'Curabitur aliquam mi id tellus volutpat eget mollis dolor consequat. In mollis, diam id rhoncus ornare, orci dui posuere justo, a lobortis ligula mi at orci. Nulla nec eleifend tellus. Nam mattis mattis eros, non lacinia orci dictum ac. Nulla in purus mauris.', 'Customer', 'Mrket', 'Economic', 'Technology', 'IP', 'Future Plans', 'Idea Development', '30000', 'Cash Flow Break Down', 'uploads/project/1-February-6-2012-1-25-25-am-wildlife.jpg', '2012-02-08 04:23:00', '2012-02-20 1:25:25', 'uploads/project/1-February-6-2012-1-25-25-am-Wildlife.mp4', 1, 1, 1),
(3, 3, 1, 'Motion Graphics Reel', 'Motion graphics are graphics that use video footage and/or animation technology to create the illusion of motion or rotation, graphics are usually combined with audio for use in multimedia projects. Motion graphics are usually displayed via electronic media technology, but may be displayed via manual powered technology (e.g. thaumatrope, phenakistoscope, stroboscope, zoetrope, praxinoscope, flip book) as well. The term is useful for distinguishing still graphics from graphics with a transforming appearance over time without over-specifying the form.', 'Motion graphics extend beyond the most commonly used methods of frame-by-frame footage and animation. Computers are capable of calculating and randomizing changes in imagery to create the illusion of motion and transformation. Computer animations can use less information space (computer memory) by automatically tweening, a process of rendering the key changes of an image at a specified or calculated time. These key poses or frames are commonly referred to as keyframes. Adobe Flash uses computer animation tweening as well as frame-by-frame animation and video.', 'Customer Market', 'Market Access & Timing', 'Economic Trends', 'Technology', 'IP', 'Future PLans', 'Idea Develpoment', '40000', 'Cash Flow', 'uploads/project/3-February-6-2012-6-30-26-pm-jv.jpg', '2012-02-08 07:30:09', '2012-02-20 18:30:26', 'uploads/project/3-February-6-2012-6-30-26-pm-Motion Graphics Reel - Evan Larimore.mp4', 1, 0, 1);

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
(1, 'kitchen'),
(2, 'toys'),
(3, 'home decor'),
(4, 'lawn & garden'),
(5, 'electronics'),
(6, 'organization'),
(7, 'fitness'),
(8, 'accessories'),
(9, 'pets'),
(10, 'other');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `mj_idea_comment`
--

INSERT INTO `mj_idea_comment` (`id_comment_id`, `id_usr_id_fk`, `id_comment_body`, `id_comment_date`, `id_post_id_fk`) VALUES
(1, 1, 'Nice Idea', '2012-02-07 19:59:11', 5),
(2, 1, 'We should make this!', '2012-02-07 20:00:56', 4),
(3, 1, 'Smart!', '2012-02-07 20:10:09', 2),
(4, 1, 'Look good!', '2012-02-07 20:10:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mj_idea_post`
--

CREATE TABLE IF NOT EXISTS `mj_idea_post` (
  `id_post_id` int(10) NOT NULL AUTO_INCREMENT,
  `id_title` varchar(255) NOT NULL,
  `id_usr_id_fk` int(10) NOT NULL,
  `id_dateposted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
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
  `id_post_published` int(2) DEFAULT NULL,
  PRIMARY KEY (`id_post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `mj_idea_post`
--

INSERT INTO `mj_idea_post` (`id_post_id`, `id_title`, `id_usr_id_fk`, `id_dateposted`, `id_pictures`, `id_cat_id_fk`, `id_cur_problem`, `id_cur_solution`, `id_desc`, `id_trget_cust`, `id_features`, `id_smlar_product`, `id_rat_up`, `id_rat_down`, `id_post_published`) VALUES
(1, 'Flying Hanger', 1, '2012-02-07 20:22:12', 'uploads/ideas/1-January-27-2012-3-15-18-pm-hanger.jpg', 3, 'Problem\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aut', 'Solutions\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis a', 'Deacription\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Market\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute', 'Features\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Simialar Product\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 2, 1, 1),
(2, 'Cool Bottles', 1, '2012-02-07 20:22:36', 'uploads/ideas/1-January-27-2012-3-20-44-pm-bottle.jpg', 1, 'Problem\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aut', 'SOlution\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis au', 'Description\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Market\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute', 'Features\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Product\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 3, 1, 1),
(3, 'Relaxing Chair', 1, '2012-01-27 07:21:46', 'uploads/ideas/1-January-27-2012-3-21-45-pm-chair.jpg', 3, 'Problem\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute ', 'Solution\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute', 'Desc\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Market\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute i', 'Features\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Similar Product\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0, 0, 1),
(4, 'Creative Zip', 1, '2012-01-29 03:40:53', 'uploads/ideas/1-January-27-2012-3-22-39-pm-zip.jpg', 7, 'Problem\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute ', 'Solution\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute', 'Description\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'MArket\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute i', 'Features\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Similar Product\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 10, 0, 1),
(5, 'Wrist Band', 1, '2012-02-08 04:20:38', 'uploads/ideas/1-January-27-2012-3-23-26-pm-band.jpg', 7, 'Problem\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute ', 'Solution\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute', 'Desc\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Market\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute i', 'Features\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Product\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0, 1, 1);

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
  PRIMARY KEY (`la_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `mj_learn_article`
--

INSERT INTO `mj_learn_article` (`la_id`, `la_title`, `la_body`, `la_visual`, `la_dateposted`, `la_article_by`, `la_rat_up`, `la_rat_down`, `la_cat_id_fk`) VALUES
(1, 'Writing Business Requirement Documents', 'Writing a business requirement documents is known to entail a lot of consideration.\r\n<p>But if there is the two-way communication between you and your people, you will surely be able to realize your goals in your projects.\r\nBusiness requirement documents indeed have a lot of uses from the past even until now. Commonly, it has been widely used specifically when it comes to project planning. But nowadays, such documents are used for the development of enterprise software, database as well as websites.</p>\r\n \r\n<p>In writing a business requirements document, one must make sure that he/she must have a preemptive knowledge when it comes to the goals of the project before actually writing it. Of course, this can be fully realized when people are able to have a careful attention to the information that will make the project to be completed</p>\r\n\r\n<p>The first thing that one must do is to have a discovery meeting. Such meeting must include people like stakeholders (customer service representatives, sales force, etc), end users as well as the management. <blockquote>What you must talk about in the meeting are the desired results that you would like attain. Moreover, it would also help if you can do some interviews with these people and get details that you can use for the benefit of the company.</blockquote></p>\r\n\r\n<p>After having your meeting, you can now make a draft or your business requirement documents and pass it over with all the people who attended your meeting. It is best that all of you are able to review all the things written on it. Take comments given by these people as changes that will be for the betterment of the business requirement documents.</p>\r\n\r\n<p>For the most part, there will be revisions that must be given proper attention. After all comments have been given by the people who attended your meeting, collate it over and do the necessary revisions. Moving forward, you can now re-circulate it to people whom are important for the full realization of the projects’ goal with the help of the business requirement documents.\r\nIt is a good way that you start writing your business requirement documents with the help of a template. There are standard templates that you can use so that during the meeting, you will be able to address all the things that must be included in your meeting. This will serve as a roadmap in making you achieve your goals.</p> \r\n \r\n<p>Moreover, it is important that you give particularity when it comes to the continuous updates that will surely come. By doing so, you are avoiding and at the same time protecting yourself from the blames if there are cases where the goals of the projects are not met.</p>', 'uploads/article/cover1.jpg', '2012-01-26 16:00:00', 1, 7, 2, 1),
(2, 'How to Start a Mid Night Club', 'If you look into today''s night life then you can easily comprehend the young generations are more into brew pubs, night clubs, dance clubs and swing clubs. Young couples also don''t want to stay behind, they are also seen more in mid night clubs. Opening a night club is a potential business to think about and invest.\r\nLas Vegas night clubs are classic examples that show there is money in nightlife. The best nightclubs and bars have raised a number of successful entrepreneurs who have cashed in on man’s natural love for night life.\r\nIf you have been thinking to start a new business that you can consider fun and enjoyable, you might want to invest on a bar night club . Starting and running a nightclub, however, is not as easy as it seems. It takes a great deal of preparation and some know-how to establish a successful nightclub business. Here are some things that you have to know before starting a nightclub business:\r\nGet to know what appeals to your clients\r\nAmong the best things that you can do to guarantee success to your local bar is to make sure you are providing the right services like live entertainment and drinks to your clients and the best means to do this is to know what appeals to your clients. Know their tastes and their preferences. The night club industry is an ever evolving business. Pub hoppers of today may not have the same preference for entertainment, food and drinks that night clubbers of the yesteryears wanted. Knowing the current tastes and general favorites of your prospective clients will allow you to make plans for a night club and bar that reflects and expresses the personality and tastes of your clients.\r\nGive your clients reasons to be in your nightclub\r\nIf there are a number of nightclubs in the area, how will you make people go to your nightclub? You can actually make people go to your nightclub by providing them with reasons and intentions to be in your nightclub. You can do this by making people feel special or privileged. While not being necessarily a teen nightclub, for example, you can provide teenagers special discounts during Fridays or you can make your nightclub a dance club or karaoke bar on special days to cater to people who like to dance and sing. It will also be a good idea to establish fixed days of the week to cater to the interests and preferences of different personalities so your guests will know when it is best for them to visit your nightclub.\r\nA nightclub business can be a fun way for you to cash in on people’s love for nightlife. You can be as successful as many nightclub entrepreneurs if you get to know what appeals to your clients and when you give your clients reasons to be in your nightclub.', 'uploads/article/cover2.jpg', '2012-01-26 18:16:27', 1, 11, 0, 1),
(3, 'How to Write Business Thank You Notes to Customers', 'Sending a business thank-you letter to customers is a way of giving your whole-hearted appreciation. This type of business letter show that you have given importance to the client and this result to the improvement of customer restrain.\r\nBusiness thank-you notes is one of the strategies that help your company to gain more customers. Here are some tips on how to write a business thank-you note letter.\r\nThe use of business thank you notes to customers has been neglected by most companies. One effective way in order to get better the customer retention and the effective vocal advertising is through taking the effort and time to write thank-you letters to the customers. Although writing a thank-you letter to the customer can be a time consuming process, it is a very ideal to show your appreciation and to be appreciated by the clients. Preferably, the owner of starting business must be the one who need to write and send a thank-you letter in whole appreciation and sincerity is completely associated with the business. However, writing a thank-you letter is not just like a simple friendly letter. You need to think it about some important things to produce effective thank-you letter to the clients.\r\n \r\nChoose the Right Format\r\n \r\nSelect the right format for the thank-you letter. Since you are using it for your business, it should be written in formal way. Of course, you need to search for business letter format and style. There are various information about business letters on internet, so it won’t difficult for you to find the formal style for the letter. Business letters today are usually printed, but you can show your sincerity and effort if the thank-you letter is personalized and hand written. You should also include a small-thank you card which can be bought in bulk. \r\n \r\nAvoid Using Sale Tone\r\n \r\nDon’t use the sale tone in the note. Although your customer has already ordered or bought a product from you, you should still avoid more sale tone in the note. This could possibly bring a bad impression from the customer. He or she might think feel that you are forcing him or her to buy another product from your company. This is an annoyance for most customers. So, you have stick to your intention by appreciating the customer about his or her loyalty and nothing else. \r\n \r\nMake the Card Special\r\n \r\nFirst impression is very important. In order to feel your appreciation from the card, you have to personalize it. You should begin with the client’s name and then put the date when she or he was in your company. For example, “Dear James, we are glad you have visited our company.” This allows the clients to be ware that he or she is not just unknown person while walking through your door. \r\n \r\nExpress Your Appreciation to the Client\r\n \r\nMake sure you show your sincerity through the use of art of words. Thank the customer with your all heart for his or her purchase and allow him or her to know what you appreciated about. If possible, insert tag lines like ”we are hoping to see you again”. This is a tactic to let them feel their importance as a part of your company. Then, send the letter with an actual stamp.', 'uploads/article/cover3.jpg', '2012-01-26 18:20:20', 1, 1, 1, 1),
(4, 'Tips to Make Your Own Logo', 'A logo is an integral part of a business regardless of its size. It gives identification to the company and shows the future of the company in the business world.\r\nTherefore, it is important to know how to draw your own logo that says all about your business.\r\nStarting a new business needs big amount of money but there are possible ways to cut the costs. Designing a business logo is significant thus it adds cost of starting a business. However, if you have skills in designing you can save money by making and designing your own logo. All you have to do is follow some steps in designing a great logo.\r\n \r\nChoosing Software\r\n \r\nCreating a logo can be both simple and complicated. This means that it depends on the preference of the business owner. Likewise, there are many tools that you can use in designing a logo. In this sense, choosing the right software should be considered. One of the photo editing software that you can use is the Adobe Photoshop.\r\n \r\nCreate Readable Logo\r\n \r\nWhen creating a logo for your business make sure that it is not complicated and readable. That is why you should think for elements that you can use in making simple logos. You can choose to add images or just the name of your company. If you want just to include only the company name in the logo you can use Adobe Photoshop. While using the Adobe Photoshop you can have the chance to choose the fonts that you prefer. On the other hand, you can also look for websites that offer free fonts and download it in your computer.\r\n \r\nAfter choosing the font that suits your company name the next step is to decide whether you will add image to the logo. Just like the fonts you can also download free images from the web. As much as possible choose image that is relevant to the product and services that your company offer. \r\n \r\nMoreover, if you do not want the logo that you personally made, you can opt to browse from different websites and generate your own logo. On the other hand, you can also decide to hire a professional designer who can create your company logo. Keep in mind that hiring professional designer is expensive but you can expect for an attractive logo design.\r\n \r\nIn the same manner, if you want your logo to be made in professional manner it will be a contributing factor for the success of your business. It is not enough just to provide quality products and services because it is also significant to have attractive company logo that will be easily recognized by your customers. IN this way, you can ensure that your customer will not forget your company as well as your products and services.', 'uploads/article/cover4.jpg', '2012-01-26 18:25:16', 1, 0, 0, 1),
(5, 'Tips on Complaining About an Accountant', 'Even though accountants are respected in the world of professions, there are some people who are unfortunate as they come across with a charlatan.\r\nAnd if by chance that they will be unfortunate in such case, there are some ways that they can use in forwarding complaints with regards to their accountant.\r\nIn a corporate setting, the services that are offered by a chartered accountant can never be done away. They are the ones who can help you in coming up with the best decisions when it comes to financial matters. More so, they are big contributors when it comes to decisions that will assure that your business is on the right track. But despite the expertise derived from rigorous trainings as well as examinations, chartered accountants can also make mistake. And with such, there are some misunderstandings between an accountant and their clients.\r\nRising Conflicts Leading to Complaints\r\nThe main reason why there is the surge of complaints between an accountant and their clients is basically rooted in the lack of communication between two parties. Even though there is the possibility of the two parties talking things over, there will always be a time wherein problems are so serious that two parties will be needing mediators, like the Institute of Chartered Accountants, to make sure that complaints will be given proper attention and mediation as well as resolution will be given.\r\nHaving your Complaint/s Heard\r\nIf by chance that you have a complaint that should be heard, you must make sure that you make it heard. It is best advised that you talk first to the accountant as you both discuss the issue or problem. It will be faster also if you will address your concern to the accountancy firm’s senior partner. On the other hand, you can also have the help of the Institute that will later on give you a complaint form. Before sending back the complaint form to the Institute, make sure that you have included all necessary documentation as well as correspondence needed from you.\r\nAfter the phase of you sending all the relevant pieces of information regarding your complaint, the Institute will then acknowledge the receipt of your complaint. Next, they will forward it to an assessor will review your complaint and see to it if what further actions can be taken.\r\nIn the review process of an assessor, he/she will look into the potentiality of disciplinary or liability actions to the accountant and how can it be dealt with. On the other hand, if the assessor deems that your complaint can still be settled without the use of any disciplinary action, then conciliation will be given. In such cases, the Institute of Chartered Accountants will be there along the way to make sure that you are in the right track.', 'uploads/article/cover5.jpg', '2012-01-26 18:26:58', 1, 0, 0, 1),
(6, 'Ways to Become a Forensic Loan Auditor', 'Forensic loan auditor is now becoming an in-demand occupation these days. It actually tackles all the issues regarding the mortgage loans and other related matter. If you love numbers and law then this job is right for you.\r\nIn any type of venture, it is very important that you have the right tool and method to be successful. Read on further to know how to become a successful forensic loan auditor.\r\nWhy Forensic Loan Auditor?\r\n \r\nIf you love working with banks and laws, forensic loan auditor is perhaps the job suited for you. As a forensic loan auditor, it is your task to determine or investigate the errors or downright violations in laws involving loans. If you love to analyze and explore then this field is right for you. The best thing about this job is you can actually practice your skills and ability at the same time help people who are facing great problem about loans.\r\n \r\nOverview of this Job\r\n \r\nThe current debacle or issues that involve predatory lending is growing not just in the U.S. but also in other places, which requires the need to have a people or expert that will investigate and explore it. Individuals who don’t have enough knowledge about the loan laws and are about to have their assets and other properties for foreclosure need the assistance of a forensic loan auditor. If this is not resolved, these people will have to stay homeless. If there’s a forensic loan auditor, it is more likely that this will be barred, if it is proven that the loan is unenforceable, the owner will surely benefit. In order for the auditor to determine this, he or she needs to review the mortgage contract. By reviewing the contract, the auditor can tell if the bank or financial institution has the basis of getting the property legally. \r\n \r\nHow to Start?\r\n \r\nIn order for you to start with this job of course, it is very significant if you can get a certain certification or short crash course about this field. Even if you love banking and laws, if is still recommendable if you have the right knowledge. Maybe you can consult the nearest universities or colleges near your area if they offer similar training or programs. During this training, you will be able to learn the important laws about loans and what is legal and what is not. When you enter a program, make sure that it is supported by the government. After your course, you can now start your new profession.\r\n \r\nYou can start as a freelance forensic loan auditor but for starters, it is ideal way on joining a group of forensic loan auditors or employed on a firm. This helps you to get the clients because the clients will be the one that will look for you.', 'uploads/article/cover6.png', '2012-01-26 18:27:36', 1, 0, 0, 1),
(7, 'How to Become a Sales Agent', 'If you want to become a sales agent, this is your chance. A lot of companies these days are no longer maintaining their own sales force and are relying greatly on sales agents like you.\r\nThis is the perfect time to file applications to the reputable companies out there. If you want, you can even use the internet as a tool to sell various kinds of products and services by having your own website.\r\nThe Job Description of a Sales Agent\r\nAs a sales agent, you have a chance to earn unlimited income. In fact, if you become a full time sales agent, you can enjoy the financial security that comes with it. Almost every individual wants to be his/her own boss and this is possible if you become a sales agent. There are no educational requirements required although you can be at an advantage if you finish a marketing related course in college. You will need to pick a company that offers an attractive incentive or commission program. Some companies even offer their sales agents with dental and medical benefits.\r\nTrainings are usually provided by companies once you pass their application process. Well of course, the requirements may vary from one company to another so you need to determine the qualifications first before you file an application. You should choose the company well and pick one that offers continuous support for sales agents like you. Ongoing programs and workshops should be provided by the company to help you in keeping up with the latest trends in the market. The needs of people vary so it would be best to team up with a company that offers a wide range of services and products. That way, you can offer the right products/services to the right clients.\r\nOther Info for Becoming a Sales Agent\r\nSo far, becoming a sales agent is the cheapest and simplest method. In today’s modern market, a lot of companies no longer want a massive sales force because it’s too costly. These companies are now turning to sales agents because it the most effective way to circulate their product in the online and offline market and less costly too. The sales agents are given a certain percentage for every product sold to customers. If you’re not ready to take the plunge, you can start by becoming a part timer. Start surfing the internet now and look for companies offering business opportunities to sales agents.\r\nSince there are no stringent requirements to become a sales agent, you can easily qualify especially if you possess the skills of a good sales agent. You should be smart, a good communicator, confident, and knowledgeable so that you can easily convince clients to get your products or services of the company that you represent. If you are hard working, you can earn more. Choose the best schedule during the day so that you can have more output. Apply as a sales agent now and start making a lot of money.', 'uploads/article/cover7.jpg', '2012-01-26 18:28:24', 1, 0, 0, 1),
(8, 'How to Start a T-shirt Company', 'As far as the fashion industry is concerned, t-shirts are the most common fashion output that people are used of wearing.\r\nThey find it comfortable and very trendy at the same time.\r\nSetting up your T-shirt Company\r\nThe first thing you should do is to make sure that you have the essential tools and equipment needed in setting up your t-shirt venture. You should have lots of sewing machines. These machines will be the ones that will produce your t-shirt. Of course along with it, there should be t-shirt designers. They will be the ones who will make your t-shirt designs. They are the ones who will give you the idea on what type of t-shirt you will be producing in the industry. T-shirts are almost the same with every single type of t-shirt. The only difference is the type of cloth you used and the designs printed on shirt itself.\r\nNext, you should secure the entire license needed in starting your business venture. They are important because in this world, without a license you are always considered to be operating a business in an illegal way. You do have laws and you should follow those laws to avoid problems. Include your tax ID and other tax related responsibilities in your check list. These are the most essential requisite to make your business in line with the licensed business companies and be legal. Another thing, you should find a good source and supplier. Suppliers for your employees and suppliers for the raw materials you will be using in your company.\r\nDesigning and Selling T-shirts\r\nIn designing t-shirts, you will need the help of a fashion consultant or you might want to hire your very own designer. Having your own designer will definitely be an edge for your company. You will be saving lots of money from it and you will be working closely with them. With your designer, you may come up with t-shirt prints that are very unique and trendy. Most people today are very trendy when it comes to choosing their kind of shirts. They do not just buy a plain shirt. They buy those shirts that have a print on it that would make other people notice them. It is essential in designing shirt prints to take into consideration the attitude and persona of the market group you are going to deal with. For example, if you are targeting the young group of buyers, then maybe you can think of prints that are colourful, feisty, and jolly. You may also think of those cute and trendy prints for them because the young generation of today have already their own kind of fashion statements.\r\nYou may use iron-on transfers to make your t-shirt printing faster and more efficient. Through this, you will no longer hire too many workers in your company because you will need just enough of them to do the job. You will be cost cutting through this since the economy today is very unstable. When you already made your designs and you already had them printed or transferred to the shirt, then you’re ready for business.', 'uploads/article/cover8.jpg', '2012-01-26 18:29:15', 1, 0, 0, 1),
(9, 'How to Start a Woodworking Business', 'Use your woodworking skills and start a lucrative business. The woodworking business is an enjoyable way to make money. This article also offers tips on starting and running a woodworking business.\r\nThe woodworking business is ideal for people who love doing handcrafted woodwork for a hobby.\r\nThere are a lot of highly marketable products nowadays that make use of woodworking techniques. Furniture is a fine example and hand made wooden toys too is becoming a market favorite.\r\nIf you are looking for business opportunities and you possess woodworking skills and talent, then I suggest you explore this industry.\r\nStarting a woodworking business can be simple as long as you are armed with sufficient knowledge. Here are some pointers that may guide you as you embark on starting your own woodworking company.\r\nFirst, figure out what kind of items you want to specialize in i.e. home décor, furniture, toys, etc. The supplies and equipment you invest on will rely primarily on the products you plan to produce.\r\nSecond, look for a good supplier for your wood and equipment needs. Make sure the supplier you choose will give you the best value for money deal. Naturally, you know better than procure sub-standard materials. Doing so will vastly affect the quality of your products and quality is one of the selling points in this business. Typically, you will need to buy clamps, a square, saws, tape measure, hammers, hand drills, and chisels.\r\nThird, look for a space where you can work. If your operation is a small one, your garage or home workshop will do just fine. However, if you plan to launch a big business, then you will need to rent space where you and your craftsmen can manufacture your merchandise. The additional cost for rent and utilities should be computed and used as a consideration when making your price scheme.\r\nFourth, identify your target market and develop a promotional campaign tailor-fit to suit them. There are a lot of ways you can advertise your merchandise. You can post adverts in the internet, or on local bulletin boards, on trade magazines etc. The key is to establish your business in the arena and introduce your name to the market.\r\nFifth, look for a plausible sales channel. A website is a good option because it enables you to reach a wider market. If possible, equip your website with e-commerce capability. Aside from this, you can also participate in trade shows, arts & crafts fairs, and flea markets and so on.\r\nSixth, expound, explore, and discover. Take a look at the trends. Take a look at your competition. Make it a point that your products are better than theirs are. Don’t hamper your creativity and imagination. The best way to establish a niche market is to develop product designs that are uniquely yours. Remember to have these designs copyrighted so nobody else can use them.\r\nSeventh, in manufacturing your products, make sure you and your workers adhere to safety rules. You will be using sharp tools like knives and chisels so to avoid accidents and mishaps, always practice caution.\r\nEight, put your customers first, always. The success of a business doesn’t only depend on the number of customers you entice to your store. What matters is the number of customers you retain. Keep them coming back by giving them the royal treatment.', 'uploads/article/cover9.jpg', '2012-01-26 18:29:54', 1, 0, 0, 1),
(10, 'Tips on Closing a Sale Effectively', 'If you are personally marketing the business and the products you have for your customers, it is important that you are aware of the proper ways on how to close a sale effectively.\r\nBecause of having an idea with the right tactics and tips required, this will lead to the efficiency and productivity of the business.\r\nWhen your aim is to personally advertise the business and the services you have for your customers, it is important that you know the possible ways on how to close the deal. This article will provide you with the most effective tips you can consider. \r\n \r\nSell the Aces of the Products\r\n \r\nOnce you are selling your products and services and you are eager to close the deal with your customer, it is important that you sell the advantages. Keep in mind that what usually disappoints the customers in some deals is when the marketer will open about the disadvantages of the products. Keep in mind that your customer is looking for a superb product, so it will be a major turn off to hear some of the negative sides of the stuffs you are offering. To effectively close the deal, talk more of the benefits of using the product. \r\n \r\nPut Yourself on the Customers’ Shoes\r\n \r\nIf you will put yourself in the shoes of your customers, you can effectively close a deal. Being a customer, you will have lots of doubts and queries about the product you want to purchase. Try to ask yourself if you are the actual customer. By this way, you will know how to tackle the queries of your client and to effectively market the product you are offering as well. So when the same question is asked by your client in the future, you know what to say. \r\n \r\nIdentifying Goals\r\n \r\nDetermining your goals is also among the best ways for you to effectively close a sale. Keep in mind that sales is different from the actual conversation you do with your friends and the people around you. By identifying the exact goal why you need to do effective marketing conversation, you can device the right tone of discussion. Additionally, identify if you are inclined to get a broad net or a higher number of people. By doing this, you will be able what to go about and to tackle the discussion with your client. \r\n \r\nMaking Customers Feel Special\r\n \r\nAs you talk to your customer, make sure that you will make them feel they are special to you. Because of the feeling that they are special to your business, they will somehow be convinced to purchase the product you are offering. The use of the right tone and words also affects the special feeling experienced by your customers. If you will ask for some pieces of advice from your possible customers, they will also tell you the same thing.', 'uploads/article/cover10.jpg', '2012-01-26 18:38:08', 1, 1, 0, 1),
(11, 'Types of Viral Marketing', 'When you plan to establish a business, selling your products or service could be one of your first considerations. Definitely, selling products or services is a great challenge for you especially if you don’t have enough knowledge about marketing. Using the types of viral marketing could be the best way to have an effective marketing.\r\nThe viral marketing can be used by vocal or network effects from the innovation of internet. Viral marketing can also be used through video clips, text messages, and other interactive processes.\r\nWhen you buy a product of a particular establishment and you are satisfied with product, you usually recommend it to your friend and other people who also appreciate the product. And when you give your recommendation, they grab or avail the item. Usually, you express your satisfaction through telling your relatives or friends about the benefits you got from the items or service. Some of them will actually try the same item that you have recommended. This is the viral marketing strategies in which you could successfully advertise the item or service by word-of-mouth without using money on it. This is the process of viral marketing. It is said that it is an advertising strategy that attracts people to pass on selling message to friends and relatives. \r\n \r\nIdea of Viral Marketing\r\n \r\nThe idea of viral marketing of passing along the selling message has been started for a long now. Steve Jurvetson, a business capitalist was the first man who was recognized to use viral marketing to illustrate Hotmail’s selling practice. This practice was designed to use an advertisement of itself on message which is expressed using the service. When a receiver gets attracted and press the ad icon, it will open to hotmail’s site for you to sign up. This process will go on and on and develop is the same to cycle business marketing. From this moment, viral marketing has been developed into different types.\r\n \r\nIncentivised Viral Marketing\r\n \r\nIncentivised viral is the first type of marketing strategy that is used by most businesses in which they offered rewards or incentives when they refer somebody or to recruit to the company. This process becomes more effective when they referred person who intentionally want to get the reward. \r\n \r\nPass-along Strategy\r\n \r\nThis strategy is the most common type of viral marketing. It uses internet wherein the selling process takes on websites. The innovation asks the users to tell-a- friend about the service or products. Most companies use this strategy since it offers a convenient way of marketing. However, the drawback of this strategy is there is a risk of the message being recognized as a spam. The purpose of the spam is to repeatedly remind the users about the service or products being offered. \r\n \r\nBuzz Marketing\r\n \r\nThis strategy is being used in the entertainment world. Controversies is the best example of this strategy since it boost the interest of people such as involving stars of the commercial that not yet released. Buzz marketing aid the business to get the attention of the public people.', 'uploads/article/cover11.jpg', '2012-02-10 03:54:28', 1, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mj_learn_article_category`
--

CREATE TABLE IF NOT EXISTS `mj_learn_article_category` (
  `la_cat_id` int(10) NOT NULL AUTO_INCREMENT,
  `la_cat_name` varchar(70) NOT NULL,
  PRIMARY KEY (`la_cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `mj_learn_article_category`
--

INSERT INTO `mj_learn_article_category` (`la_cat_id`, `la_cat_name`) VALUES
(1, 'small business'),
(2, 'Retail Store Ideas'),
(3, 'Free Business Ideas');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

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
(10, 1, 'Thanks!', '2012-02-07 10:14:20', 3);

-- --------------------------------------------------------

--
-- Table structure for table `mj_market_category`
--

CREATE TABLE IF NOT EXISTS `mj_market_category` (
  `mrket_cat_id` int(10) NOT NULL AUTO_INCREMENT,
  `mrket_cat_name` varchar(70) NOT NULL,
  PRIMARY KEY (`mrket_cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mj_market_category`
--

INSERT INTO `mj_market_category` (`mrket_cat_id`, `mrket_cat_name`) VALUES
(1, 'electronic'),
(2, 'vehicles');

-- --------------------------------------------------------

--
-- Table structure for table `mj_market_post`
--

CREATE TABLE IF NOT EXISTS `mj_market_post` (
  `mrket_post_id` int(10) NOT NULL AUTO_INCREMENT,
  `mrket_usr_id_fk` int(10) NOT NULL,
  `mrket_post_title` varchar(70) NOT NULL,
  `mrket_post_body` text NOT NULL,
  `mrket_post_picture` text NOT NULL,
  `market_dateposted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mrket_cat_id_fk` int(10) NOT NULL,
  `mrket_state_id_fk` int(10) NOT NULL,
  `mrket_post_published` int(2) DEFAULT NULL,
  `mrket_rat_up` int(2) DEFAULT NULL,
  `mrket_rat_down` int(2) DEFAULT NULL,
  `mrket_price` int(7) NOT NULL,
  PRIMARY KEY (`mrket_post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `mj_market_post`
--

INSERT INTO `mj_market_post` (`mrket_post_id`, `mrket_usr_id_fk`, `mrket_post_title`, `mrket_post_body`, `mrket_post_picture`, `market_dateposted`, `mrket_cat_id_fk`, `mrket_state_id_fk`, `mrket_post_published`, `mrket_rat_up`, `mrket_rat_down`, `mrket_price`) VALUES
(1, 1, 'Product 1\r\n', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris erat libero, blandit vitae lobortis sed, convallis sed libero. Curabitur sapien massa, mattis et scelerisque aliquam, laoreet eu enim. Nulla facilisi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam quis orci placerat mauris dictum ullamcorper. Vestibulum facilisis adipiscing congue. Etiam accumsan pretium nibh sit amet vehicula. ', 'uploads/market/1-February-3-2012-4-09-13-pm-68.jpg', '2012-02-03 10:12:54', 1, 1, 1, NULL, NULL, 1200),
(2, 1, 'Product 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris erat libero, blandit vitae lobortis sed, convallis sed libero. Curabitur sapien massa, mattis et scelerisque aliquam, laoreet eu enim. Nulla facilisi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam quis orci placerat mauris dictum ullamcorper. Vestibulum facilisis adipiscing congue. Etiam accumsan pretium nibh sit amet vehicula. ', 'uploads/market/1-February-3-2012-4-10-08-pm-108.jpg', '2012-02-03 10:13:05', 1, 1, 1, NULL, NULL, 800),
(3, 1, 'Product 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris erat libero, blandit vitae lobortis sed, convallis sed libero. Curabitur sapien massa, mattis et scelerisque aliquam, laoreet eu enim. Nulla facilisi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam quis orci placerat mauris dictum ullamcorper. Vestibulum facilisis adipiscing congue. Etiam accumsan pretium nibh sit amet vehicula. ', 'uploads/market/1-February-3-2012-4-10-28-pm-25420_D40_right.png', '2012-02-03 10:13:17', 1, 1, 1, NULL, NULL, 2300),
(4, 1, 'Product 4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris erat libero, blandit vitae lobortis sed, convallis sed libero. Curabitur sapien massa, mattis et scelerisque aliquam, laoreet eu enim. Nulla facilisi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam quis orci placerat mauris dictum ullamcorper. Vestibulum facilisis adipiscing congue. Etiam accumsan pretium nibh sit amet vehicula. ', 'uploads/market/1-February-3-2012-4-10-52-pm-Dell_XPS_M1330_PRODUCT_RED-.jpg', '2012-02-03 10:13:32', 1, 1, 1, NULL, NULL, 200),
(5, 1, 'product 5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris erat libero, blandit vitae lobortis sed, convallis sed libero. Curabitur sapien massa, mattis et scelerisque aliquam, laoreet eu enim. Nulla facilisi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam quis orci placerat mauris dictum ullamcorper. Vestibulum facilisis adipiscing congue. Etiam accumsan pretium nibh sit amet vehicula. Kasut', 'uploads/market/1-February-3-2012-4-11-12-pm-huf-converse-product-red-skidgrip-1.jpg', '2012-02-06 18:07:23', 1, 1, 1, NULL, NULL, 1600),
(6, 1, 'product 6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris erat libero, blandit vitae lobortis sed, convallis sed libero. Curabitur sapien massa, mattis et scelerisque aliquam, laoreet eu enim. Nulla facilisi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam quis orci placerat mauris dictum ullamcorper. Vestibulum facilisis adipiscing congue. Etiam accumsan pretium nibh sit amet vehicula. ', 'uploads/market/1-February-3-2012-4-11-38-pm-product-red-ipod-mock2.gif', '2012-02-03 10:13:59', 1, 1, 1, NULL, NULL, 4100),
(7, 1, 'Product 7', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris erat libero, blandit vitae lobortis sed, convallis sed libero. Curabitur sapien massa, mattis et scelerisque aliquam, laoreet eu enim. Nulla facilisi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam quis orci placerat mauris dictum ullamcorper. Vestibulum facilisis adipiscing congue. Etiam accumsan pretium nibh sit amet vehicula. Macbook Pro', 'uploads/market/1-February-3-2012-4-12-15-pm-software_box_and_all_cd.jpg', '2012-02-06 18:08:38', 2, 3, 1, NULL, NULL, 600),
(8, 1, 'House Leasing', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis congue risus sit amet quam condimentum a luctus sem porta. Aliquam risus sem, dapibus eu bibendum vel, facilisis vel sapien. In sed est nulla, tempor elementum libero. Sed scelerisque consectetur commodo. Suspendisse at felis metus, sed vulputate dui. ', 'uploads/market/1-February-3-2012-6-27-48-pm-bungalow-athyma-villa-2-phase-10a-perspective.jpg', '2012-02-09 06:55:11', 1, 2, 1, 0, 0, 2500000),
(9, 1, 'Wedding', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis congue risus sit amet quam condimentum a luctus sem porta. Aliquam risus sem, dapibus eu bibendum vel, facilisis vel sapien. In sed est nulla, tempor elementum libero. Sed scelerisque consectetur commodo. Suspendisse at felis metus, sed vulputate dui. ', 'uploads/market/1-February-3-2012-6-28-13-pm-K-Tornado Productions Wedding Services.jpg', '2012-02-03 10:28:13', 2, 3, 1, 0, 0, 500),
(10, 1, 'For Sale', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis congue risus sit amet quam condimentum a luctus sem porta. Aliquam risus sem, dapibus eu bibendum vel, facilisis vel sapien. In sed est nulla, tempor elementum libero. Sed scelerisque consectetur commodo. Suspendisse at felis metus, sed vulputate dui. ', 'uploads/market/1-February-3-2012-6-28-41-pm-house.jpg', '2012-02-03 10:28:41', 1, 1, 1, 0, 0, 210000);

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
  `msg_to` int(10) NOT NULL,
  `msg_by_usr_id_fk` int(10) NOT NULL,
  `msg_body` text NOT NULL,
  `msg_status` int(2) NOT NULL,
  `msg_recieved_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `mj_message`
--

INSERT INTO `mj_message` (`msg_id`, `msg_to`, `msg_by_usr_id_fk`, `msg_body`, `msg_status`, `msg_recieved_date`) VALUES
(9, 2, 1, 'Helloooooooooooooooooooooooooooo', 1, '2012-02-13 22:12:41'),
(10, 23, 1, 'hey, check this out!', 1, '2012-02-13 22:15:55'),
(11, 3, 1, 'Sent regard to your sister. Thanks :)', 1, '2012-02-13 22:16:58'),
(12, 22, 1, 'Lets go futsal tonight. call me ya', 1, '2012-02-13 22:21:03'),
(13, 1, 2, 'Okey. We should know this thing!', 1, '2012-02-13 22:22:43'),
(14, 14, 2, 'Ding!', 1, '2012-02-13 22:23:30'),
(15, 1, 2, 'Hello There!', 1, '2012-02-13 22:23:46'),
(16, 1, 3, 'Cpanel Please!', 1, '2012-02-13 22:24:12');

-- --------------------------------------------------------

--
-- Table structure for table `mj_message_thread`
--

CREATE TABLE IF NOT EXISTS `mj_message_thread` (
  `mt_id` int(11) NOT NULL AUTO_INCREMENT,
  `mt_msg_id_fk` int(11) NOT NULL,
  `mt_received` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`mt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mj_network`
--

CREATE TABLE IF NOT EXISTS `mj_network` (
  `mn_id` int(11) NOT NULL AUTO_INCREMENT,
  `mn_name` varchar(100) NOT NULL,
  `mn_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mn_published` int(11) NOT NULL,
  `mn_created_by` int(11) NOT NULL,
  PRIMARY KEY (`mn_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `mj_network`
--

INSERT INTO `mj_network` (`mn_id`, `mn_name`, `mn_date_created`, `mn_published`, `mn_created_by`) VALUES
(17, 'Cili', '2012-02-09 16:09:52', 1, 1),
(19, 'Cyber Cafe', '2012-02-09 16:55:06', 1, 3),
(20, 'Ikan Keli', '2012-02-10 04:37:08', 1, 3),
(21, 'Getah Bikam', '2012-02-13 11:15:52', 1, 1),
(22, 'Remote Control Room', '2012-02-13 11:19:18', 1, 1),
(23, 'Snooker Table Bundle', '2012-02-13 11:24:37', 1, 3),
(24, 'Cheap Office Config', '2012-02-13 11:25:57', 1, 3),
(25, 'Lets go', '2012-02-13 12:26:56', 1, 1),
(26, 'Android', '2012-02-13 12:32:51', 1, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

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
(13, 1, 20, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

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
(20, 20, 'Jom business Ikan Keli', 3, '2012-02-13 22:31:13');

-- --------------------------------------------------------

--
-- Table structure for table `mj_notification`
--

CREATE TABLE IF NOT EXISTS `mj_notification` (
  `noti_id` int(10) NOT NULL AUTO_INCREMENT,
  `noti_type_id_fk` int(10) NOT NULL,
  `noti_to_usr_id` int(2) DEFAULT NULL,
  `noti_request_usr_id_fk` int(10) NOT NULL,
  `noti_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `noti_status` int(2) NOT NULL,
  PRIMARY KEY (`noti_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `mj_notification`
--

INSERT INTO `mj_notification` (`noti_id`, `noti_type_id_fk`, `noti_to_usr_id`, `noti_request_usr_id_fk`, `noti_datetime`, `noti_status`) VALUES
(9, 1, 2, 1, '2012-02-13 22:12:41', 1),
(10, 1, 23, 1, '2012-02-13 22:15:55', 1),
(11, 1, 3, 1, '2012-02-13 22:16:58', 1),
(12, 1, 22, 1, '2012-02-13 22:21:03', 1),
(13, 1, 1, 2, '2012-02-13 22:22:43', 1),
(14, 1, 14, 2, '2012-02-13 22:23:30', 1),
(15, 1, 1, 2, '2012-02-13 22:23:46', 1),
(16, 1, 1, 3, '2012-02-13 22:24:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mj_notification_type`
--

CREATE TABLE IF NOT EXISTS `mj_notification_type` (
  `noti_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `noti_type_name` varchar(20) NOT NULL,
  PRIMARY KEY (`noti_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mj_notification_type`
--

INSERT INTO `mj_notification_type` (`noti_type_id`, `noti_type_name`) VALUES
(1, 'message');

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
-- Table structure for table `mj_sector`
--

CREATE TABLE IF NOT EXISTS `mj_sector` (
  `sec_id` int(10) NOT NULL AUTO_INCREMENT,
  `sec_name` varchar(30) NOT NULL,
  PRIMARY KEY (`sec_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mj_services`
--

CREATE TABLE IF NOT EXISTS `mj_services` (
  `services_id` int(10) NOT NULL AUTO_INCREMENT,
  `services_name` varchar(30) NOT NULL,
  PRIMARY KEY (`services_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mj_state`
--

CREATE TABLE IF NOT EXISTS `mj_state` (
  `state_id` int(10) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(30) NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `mj_state`
--

INSERT INTO `mj_state` (`state_id`, `state_name`) VALUES
(1, 'selangor'),
(2, 'kuala lumpur'),
(3, 'perak');

-- --------------------------------------------------------

--
-- Table structure for table `mj_status`
--

CREATE TABLE IF NOT EXISTS `mj_status` (
  `status_id` int(10) NOT NULL AUTO_INCREMENT,
  `status_usr_id_fk` int(10) NOT NULL,
  `status_body` varchar(255) NOT NULL,
  `status_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `usr_workat` varchar(20) DEFAULT NULL,
  `usr_tel` text,
  `usr_general_info` text,
  PRIMARY KEY (`usr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `mj_users`
--

INSERT INTO `mj_users` (`usr_id`, `usr_name`, `usr_pwd`, `usr_email`, `user_pic`, `usr_lvl`, `usr_acct_status`, `usr_cnfm_key`, `usr_cnfrm_datetime`, `usr_last_login`, `usr_workat`, `usr_tel`, `usr_general_info`) VALUES
(1, 'Mahfudz', '5f4dcc3b5aa765d61d8327deb882cf99', 'mahfudz@richcoremedia.com', 'uploads/avatar/fuz.jpg', 0, 1, NULL, '2012-01-20 12:04:18', '2012-02-14 6:32:16:am', '001988694-U', '0132465974', 'FInally, im become master!'),
(2, 'Fikri', '5f4dcc3b5aa765d61d8327deb882cf99', 'fikri.zainul@richcoremedia.com', 'uploads/avatar/fik.jpg', 0, 1, NULL, '2012-01-22 15:39:58', '2012-02-14 6:23:54:am', '001988694-U', '0132465974', 'FInally, im become master!'),
(3, 'Mat', '5f4dcc3b5aa765d61d8327deb882cf99', 'mat@richcoremedia.com', 'uploads/avatar/mat.jpg', 0, 1, NULL, '2012-02-06 04:45:31', '2012-02-14 6:31:36:am', '001988694-U', '0132465974', 'FInally, im become master!'),
(14, 'Umi', '6cb75f652a9b52798eb6cf2201057c73', 'umi@richcoremedia.com', 'uploads/avatar/umie.jpg', 0, 1, 'E5rxsLJR', '2012-02-09 05:01:39', '2012-02-12 12:49:40:pm', '001988694-U', '0132465974', 'FInally, im become master!'),
(22, 'Fadzil', '5f4dcc3b5aa765d61d8327deb882cf99', 'fadzil@richcoremedia.com', 'uploads/avatar/padil.jpg', 0, 1, '2N6j9dFw', '2012-02-09 05:53:42', '2012-02-13 10:13:47:am', '001988694-U', '0132465974', 'FInally, im become master!'),
(23, 'Amirul', '5f4dcc3b5aa765d61d8327deb882cf99', 'amirul@gmail.com', 'images/users.jpg', 0, 1, 'QcnU7GwC', '2012-02-12 04:59:03', '2012-02-12 1:02:07:pm', '112233-X', '0132465974', 'FInally, im become master!');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

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
(8, 1, 23, 0);

-- --------------------------------------------------------

--
-- Table structure for table `_company`
--

CREATE TABLE IF NOT EXISTS `_company` (
  `comp_id` int(11) NOT NULL AUTO_INCREMENT,
  `comp_name` text NOT NULL,
  `comp_co_num` text NOT NULL,
  PRIMARY KEY (`comp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `_company`
--

INSERT INTO `_company` (`comp_id`, `comp_name`, `comp_co_num`) VALUES
(1, 'Rich Core Media', '001988694-U'),
(2, 'Sastred One Sdn Bhd', '112233-X');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `_company_director`
--

INSERT INTO `_company_director` (`_cd_id`, `_cd_name`, `_cd_ic`, `_comp_id_fk`) VALUES
(2, 'Muhamad Mahfudz Idris', '870922435553', 1),
(3, 'Muhamad Mahfudz Idris', '870922435553', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
