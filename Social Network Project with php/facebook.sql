-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 06, 2024 at 10:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `facebook`
--
CREATE DATABASE IF NOT EXISTS `facebook` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `facebook`;

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

DROP TABLE IF EXISTS `block`;
CREATE TABLE `block` (
  `blockID` int(11) NOT NULL,
  `blockerID` int(11) NOT NULL,
  `blockedID` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `blockOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `block`
--

INSERT INTO `block` (`blockID`, `blockerID`, `blockedID`, `status`, `blockOn`) VALUES
(1, 7, 8, 0, '2024-09-03 15:21:36'),
(2, 6, 8, 0, '2024-12-06 10:13:24');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `commentID` int(11) NOT NULL,
  `comment_parent_id` int(11) NOT NULL,
  `commentReplyID` decimal(20,0) NOT NULL,
  `replyID` decimal(20,0) NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `commentOn` int(11) NOT NULL,
  `commentBy` decimal(20,0) NOT NULL,
  `commentAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentID`, `comment_parent_id`, `commentReplyID`, `replyID`, `comment`, `commentOn`, `commentBy`, `commentAt`) VALUES
(1, 0, 0, 0, 'Hey oh! Here comes the danger up in this club!!', 5, 7, '2024-08-10 15:05:28'),
(20, 5, 0, 0, 'The quick brown fox jumped over a white lazy dog', 5, 7, '2024-08-10 17:09:23'),
(21, 5, 0, 0, 'third new comment', 5, 7, '2024-08-10 17:09:38'),
(22, 5, 0, 0, 'fourth new comment', 5, 7, '2024-08-10 17:13:02'),
(23, 5, 0, 0, 'fifth new comment', 5, 7, '2024-08-10 17:14:44'),
(25, 5, 21, 0, 'first reply', 5, 7, '2024-08-12 15:07:44'),
(26, 5, 21, 0, 'second reply', 5, 7, '2024-08-12 15:08:34'),
(27, 5, 22, 0, 'testing reply module', 5, 7, '2024-08-12 15:09:08'),
(28, 5, 23, 0, 'fixing bugs... something seems wrong', 5, 7, '2024-08-12 15:10:28'),
(29, 5, 23, 0, 'still showing errors', 5, 7, '2024-08-12 15:11:54'),
(31, 5, 23, 0, 'Seems like it is working fine now!', 5, 7, '2024-08-12 15:25:05'),
(32, 5, 0, 0, 'Testing if the comment module still works', 5, 7, '2024-08-12 15:27:34'),
(33, 5, 0, 0, 'You only live once, but if you do it right, once is enough.', 5, 6, '2024-08-14 08:35:13'),
(34, 10, 0, 0, 'It is better to be hated for what you are than to be loved for what you are not', 10, 7, '2024-08-15 07:30:00'),
(35, 11, 0, 0, 'the tests continue...', 11, 7, '2024-08-17 20:06:44'),
(36, 10, 0, 0, 'When there is a will, there is NOT ALWAYS a way', 10, 7, '2024-08-28 20:10:05'),
(37, 5, 0, 0, 'amar shonar bangla, ami tomay valobashi...', 5, 7, '2024-08-31 18:16:25'),
(38, 15, 0, 0, 'Testing mention system...', 15, 7, '2024-09-03 20:09:30'),
(41, 17, 0, 0, 'testing testing 1 2 ....', 17, 7, '2024-12-06 10:06:53'),
(42, 18, 0, 0, 'This is very nice', 18, 6, '2024-12-06 10:11:05'),
(43, 18, 42, 0, 'great!!', 18, 6, '2024-12-06 10:11:17'),
(44, 20, 0, 0, 'hello, how are you?', 20, 7, '2024-12-06 10:15:38'),
(45, 18, 42, 0, 'Thank you', 18, 7, '2024-12-06 10:15:57');

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

DROP TABLE IF EXISTS `follow`;
CREATE TABLE `follow` (
  `id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `followOn` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`id`, `sender`, `receiver`, `followOn`) VALUES
(8, 6, 7, '2024-12-06 10:12:43');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `messageID` int(11) NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `messageTo` int(11) NOT NULL,
  `messageFrom` int(11) NOT NULL,
  `messageOn` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messageID`, `message`, `messageTo`, `messageFrom`, `messageOn`, `status`) VALUES
(1, 'Bangladesh has banned the export of hilsa to India 🇧🇩❌🇮🇳\r\n\r\nAt the same time, Border Guard Bangladesh (BGB) and Bangladesh Coast Guard are strictly monitoring that Hilsa does not enter India illegally.', 6, 7, '2024-08-20 08:31:52', 0),
(2, 'Appreciate good decision 😉', 7, 6, '2024-08-20 08:35:44', 0),
(3, '<img alt=\"👏\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f44f.png\"><img alt=\"👏\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f44f.png\"><img alt=\"👏\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f44f.png\"><img alt=\"👏\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f44f.png\">', 6, 7, '2024-08-20 08:51:00', 0),
(4, 'During Corona Virus Lockdown he graduated online class 🤣🤪😂😜', 6, 8, '2024-08-26 20:25:11', 0),
(5, '“Yesterday is history, tomorrow is a mystery, but today is a gift. That is why it is called the present.”- Master Oogway, Kung Fu Panda', 8, 6, '2024-08-26 20:59:14', 0),
(6, 'An apple a day, keeps the doctor away&nbsp;<img alt=\"👍\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f44d.png\">', 7, 6, '2024-08-28 19:33:15', 0),
(11, 'how are you??', 8, 7, '2024-08-28 19:37:13', 0),
(12, 'I am fine. thank you', 8, 7, '2024-12-06 10:17:20', 0),
(13, 'good advice<img alt=\"😍\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f60d.png\"><div><br><div><', 6, 7, '2024-12-06 10:17:37', 0),
(14, 'Praesent quis fermentum est.<img alt=\"🤩\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f929.png\"><img alt=\"😝\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f61d.png\">', 7, 8, '2024-12-06 10:19:46', 0),
(15, '<div><img alt=\"👍\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f44d.png\"><img alt=\"😫\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f62b.png\">&nbsp;kSDNaw vpeihb<br></div>', 7, 8, '2024-12-06 10:20:03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE `notification` (
  `ID` int(11) NOT NULL,
  `notificationFor` int(11) NOT NULL,
  `notificationFrom` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `type` enum('postReact','commentReact','comment','share','message','request','mention') NOT NULL,
  `notificationOn` datetime NOT NULL,
  `notificationCount` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `friendStatus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`ID`, `notificationFor`, `notificationFrom`, `postid`, `type`, `notificationOn`, `notificationCount`, `status`, `friendStatus`) VALUES
(1, 6, 7, 10, 'postReact', '2024-08-28 20:07:07', 1, 1, 1),
(2, 6, 7, 10, 'comment', '2024-08-28 20:10:05', 1, 1, 1),
(4, 6, 8, 0, 'request', '2024-08-29 19:51:55', 1, 0, 0),
(5, 7, 8, 0, 'request', '2024-08-29 20:50:18', 1, 1, 0),
(6, 7, 6, 12, 'postReact', '2024-08-31 18:27:48', 1, 1, 0),
(7, 7, 6, 15, 'mention', '2024-09-03 20:07:28', 1, 1, 0),
(8, 6, 7, 15, 'postReact', '2024-09-03 20:09:08', 1, 1, 0),
(9, 6, 7, 15, 'comment', '2024-09-03 20:09:30', 1, 1, 0),
(10, 7, 6, 18, 'comment', '2024-12-06 10:11:05', 1, 0, 0),
(11, 7, 6, 18, 'postReact', '2024-12-06 10:11:08', 1, 1, 0),
(12, 7, 6, 18, 'comment', '2024-12-06 10:11:17', 1, 0, 0),
(13, 7, 6, 17, 'postReact', '2024-12-06 10:11:31', 1, 1, 0),
(14, 7, 6, 20, 'mention', '2024-12-06 10:12:30', 1, 1, 0),
(15, 7, 6, 0, 'request', '2024-12-06 10:12:43', 1, 1, 0),
(16, 6, 7, 20, 'comment', '2024-12-06 10:15:38', 0, 0, 0),
(17, 6, 7, 20, 'postReact', '2024-12-06 10:15:41', 0, 0, 0),
(18, 6, 7, 18, 'comment', '2024-12-06 10:15:57', 0, 0, 0),
(19, 8, 7, 0, 'message', '2024-12-06 10:17:20', 0, 0, 0),
(20, 6, 7, 0, 'message', '2024-12-06 10:17:37', 0, 0, 0),
(21, 7, 8, 0, 'message', '2024-12-06 10:19:46', 0, 0, 0),
(22, 7, 8, 0, 'message', '2024-12-06 10:20:03', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `post` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `postBy` int(11) DEFAULT NULL,
  `sharedFrom` int(11) DEFAULT NULL,
  `shareId` int(11) DEFAULT NULL,
  `sharedBy` int(11) DEFAULT NULL,
  `postImage` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `imageId` text DEFAULT NULL,
  `likesCount` int(11) DEFAULT NULL,
  `shareCount` int(11) DEFAULT NULL,
  `postedOn` datetime DEFAULT NULL,
  `shareText` text DEFAULT NULL,
  `profilePhoto` text DEFAULT NULL,
  `coverPhoto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `userId`, `post`, `postBy`, `sharedFrom`, `shareId`, `sharedBy`, `postImage`, `imageId`, `likesCount`, `shareCount`, `postedOn`, `shareText`, `profilePhoto`, `coverPhoto`) VALUES
(1, 7, 'hello world!! You\'ve been hit by, a SMOOTH CRIMINAL !', 7, NULL, NULL, NULL, '', NULL, NULL, NULL, '2024-07-15 08:14:41', NULL, NULL, NULL),
(2, 7, 'what is going on !!', 7, NULL, NULL, NULL, '', NULL, NULL, NULL, '2024-07-15 08:21:39', NULL, NULL, NULL),
(5, 7, 'Lately I\'ve been feeling so alone...<img alt=\"😔\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f614.png\"><img alt=\"😔\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f614.png\">', 7, NULL, NULL, NULL, '', NULL, NULL, NULL, '2024-07-15 09:59:29', NULL, NULL, NULL),
(9, 6, 'The quick brown fox jumped over a white lazy dog<img alt=\"😃\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f603.png\"><img alt=\"😄\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f604.png\">', 6, NULL, NULL, NULL, '', NULL, NULL, NULL, '2024-08-13 08:56:49', NULL, NULL, NULL),
(10, 6, NULL, 7, 7, 5, 6, '', NULL, NULL, NULL, '2024-08-13 09:03:37', 'Very Nice post', NULL, NULL),
(11, 7, 'Early to bed and early to rise, makes a man healthy, wealthy and wise <img alt=\"🙃\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f643.png\"><img alt=\"😌\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f60c.png\">', 7, NULL, NULL, NULL, '', NULL, NULL, NULL, '2024-08-17 20:06:22', NULL, NULL, NULL),
(12, 7, 'I am feeling very tired right now<img alt=\"😫\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f62b.png\"><img alt=\"😫\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f62b.png\">', 7, NULL, NULL, NULL, '', NULL, NULL, NULL, '2024-08-31 17:41:23', NULL, NULL, NULL),
(14, 7, '@doctor_animo , how are you doing?', 7, NULL, NULL, NULL, '', NULL, NULL, NULL, '2024-09-03 20:00:30', NULL, NULL, NULL),
(17, 7, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.<img alt=\"😃\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f603.png\"><img alt=\"😌\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f60c.png\">', 7, NULL, NULL, NULL, '', NULL, NULL, NULL, '2024-12-06 10:06:43', NULL, NULL, NULL),
(18, 7, 'How is this photo?', 7, NULL, NULL, NULL, '[{\"imageName\":\"user/7/postImage/me6.png\"}]', NULL, NULL, NULL, '2024-12-06 10:08:14', NULL, NULL, NULL),
(19, 6, NULL, 7, 7, 17, 6, '', NULL, NULL, NULL, '2024-12-06 10:11:43', 'really funny!!', NULL, NULL),
(20, 6, 'hello, @Tony_Stark', 6, NULL, NULL, NULL, '', NULL, NULL, NULL, '2024-12-06 10:12:30', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `currentCity` varchar(255) DEFAULT NULL,
  `shortBio` text DEFAULT NULL,
  `aboutYou` text DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `profilePic` text DEFAULT NULL,
  `coverPic` text DEFAULT NULL,
  `politicalViews` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `highSchool` text DEFAULT NULL,
  `college` text DEFAULT NULL,
  `university` text DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `hometown` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `workplace` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `professional` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `otherPlace` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `socialLink` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `relationship` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `quotes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `otherName` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `lifeEvent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `userId`, `currentCity`, `shortBio`, `aboutYou`, `birthday`, `firstName`, `lastName`, `profilePic`, `coverPic`, `politicalViews`, `religion`, `highSchool`, `college`, `university`, `country`, `website`, `language`, `hometown`, `gender`, `workplace`, `professional`, `otherPlace`, `address`, `socialLink`, `relationship`, `quotes`, `otherName`, `lifeEvent`) VALUES
(1, 6, NULL, NULL, NULL, '1989-08-01', 'doctor', 'animo', 'user/6/profilePhoto/me2.jpg', 'user/6/coverphoto/coverPhoto.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'male', '', '', '', '', '', '', '', '', ''),
(2, 7, 'Chattorgam', NULL, NULL, '1996-09-17', 'Tony', 'Stark', 'user/7/profilePhoto/me4.png', 'user/7/coverphoto/night_sky.jpeg', NULL, NULL, 'CCS', 'ABC Government College', NULL, NULL, NULL, NULL, 'Chattorgram', 'male', 'CTO, XYZ Company', '', 'Dhaka', 'Palashi, Dhaka', '', 'Single', '', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
(3, 8, NULL, NULL, NULL, '2000-08-12', 'ben', 'ten', 'user/8/profilePhoto/me7.png', 'assets/image/defaultCover.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'male', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `react`
--

DROP TABLE IF EXISTS `react`;
CREATE TABLE `react` (
  `reactID` int(11) NOT NULL,
  `reactBy` int(11) NOT NULL,
  `reactOn` int(11) NOT NULL,
  `reactCommentOn` int(11) NOT NULL,
  `reactReplyOn` int(11) NOT NULL,
  `reactType` enum('like','love','haha','wow','sad','angry') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `reactTimeOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `react`
--

INSERT INTO `react` (`reactID`, `reactBy`, `reactOn`, `reactCommentOn`, `reactReplyOn`, `reactType`, `reactTimeOn`) VALUES
(18, 7, 5, 0, 0, 'sad', '2024-08-10 15:22:26'),
(23, 7, 5, 1, 0, 'love', '2024-08-11 09:58:00'),
(24, 7, 5, 20, 0, 'like', '2024-08-11 10:12:35'),
(25, 7, 5, 30, 20, 'wow', '2024-08-12 15:23:03'),
(26, 7, 5, 26, 21, 'love', '2024-08-12 15:23:08'),
(28, 7, 5, 27, 22, 'like', '2024-08-12 15:23:19'),
(29, 7, 5, 28, 23, 'sad', '2024-08-12 15:27:06'),
(30, 7, 5, 29, 23, 'sad', '2024-08-12 15:27:10'),
(31, 7, 5, 31, 23, 'love', '2024-08-12 15:27:12'),
(32, 7, 5, 32, 0, 'like', '2024-08-12 15:27:43'),
(33, 6, 5, 0, 0, 'wow', '2024-08-14 08:33:52'),
(34, 6, 5, 32, 0, 'love', '2024-08-14 08:35:27'),
(35, 6, 3, 0, 0, 'like', '2024-08-14 09:14:14'),
(36, 6, 2, 0, 0, 'haha', '2024-08-14 09:14:17'),
(37, 6, 1, 0, 0, 'love', '2024-08-14 09:14:21'),
(39, 7, 9, 0, 0, 'haha', '2024-08-15 07:28:46'),
(40, 7, 11, 0, 0, 'like', '2024-08-18 08:51:40'),
(41, 6, 10, 34, 0, 'wow', '2024-08-19 11:02:24'),
(42, 6, 11, 35, 0, 'sad', '2024-08-19 11:38:53'),
(43, 6, 11, 0, 0, 'angry', '2024-08-19 11:38:57'),
(44, 7, 10, 0, 0, 'haha', '2024-08-28 20:07:07'),
(45, 6, 9, 0, 0, 'sad', '2024-08-29 20:06:54'),
(46, 6, 10, 0, 0, 'like', '2024-08-29 20:06:57'),
(47, 7, 5, 33, 0, 'wow', '2024-08-31 18:16:00'),
(48, 6, 12, 0, 0, 'like', '2024-08-31 18:27:48'),
(49, 6, 14, 0, 0, 'love', '2024-09-03 20:07:05'),
(50, 7, 15, 0, 0, 'like', '2024-09-03 20:09:08'),
(51, 6, 15, 38, 0, 'wow', '2024-09-03 20:09:54'),
(54, 7, 18, 0, 0, 'love', '2024-12-06 10:08:27'),
(55, 6, 18, 0, 0, 'like', '2024-12-06 10:11:08'),
(56, 6, 17, 0, 0, 'haha', '2024-12-06 10:11:31'),
(57, 6, 19, 0, 0, 'wow', '2024-12-06 10:11:54'),
(58, 7, 20, 0, 0, 'wow', '2024-12-06 10:15:41');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

DROP TABLE IF EXISTS `request`;
CREATE TABLE `request` (
  `requestid` int(11) NOT NULL,
  `reqtReceiver` int(11) NOT NULL,
  `reqtSender` int(11) NOT NULL,
  `reqStatus` int(11) NOT NULL,
  `requestOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`requestid`, `reqtReceiver`, `reqtSender`, `reqStatus`, `requestOn`) VALUES
(11, 7, 6, 1, '2024-12-06 10:12:43');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

DROP TABLE IF EXISTS `token`;
CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id`, `token`, `user_id`) VALUES
(61, '3746b267db45b0f2c1ca4413e8a53056c914fcad', 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `screenName` varchar(255) NOT NULL,
  `userLink` text NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `screenName`, `userLink`, `email`, `mobile`, `password`, `birthday`, `gender`) VALUES
(6, 'doctor', 'animo', 'doctor_animo', 'doctor_animo', NULL, '01234567899', '$2y$10$Pwx8jeJOi39TaKagP94fZugNaQUhXC.o5gM1/NUcYcDeBOm9OJjme', '1989-08-01', 'male'),
(7, 'Tony', 'Stark', 'Tony_Stark', 'Tony_Stark', 'stark@gmail.com', '01234568888', '$2y$10$EumTZszaeGzpZrd2lQG4yOYgJGqpUGzdry6G9PO41XF5jDRRzPVua', '1996-09-17', 'male'),
(8, 'ben', 'ten', 'ben_ten', 'ben_ten', NULL, '01234567889', '$2y$10$Rl62T6rkcfBc/EVSr1ewAODmPmk62smxeUgsmWqBhNtOBSLaQ1RvC', '2000-08-12', 'male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`blockID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageID`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `postForeign` (`userId`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profileForeign` (`userId`);

--
-- Indexes for table `react`
--
ALTER TABLE `react`
  ADD PRIMARY KEY (`reactID`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`requestid`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_fk` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `block`
--
ALTER TABLE `block`
  MODIFY `blockID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `react`
--
ALTER TABLE `react`
  MODIFY `reactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `requestid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `postForeign` FOREIGN KEY (`userId`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profileForeign` FOREIGN KEY (`userId`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
