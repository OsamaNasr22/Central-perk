-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2017 at 03:23 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `banner_url` varchar(255) NOT NULL,
  `type` varchar(150) NOT NULL,
  `banner_desc` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `creatBy` varchar(150) NOT NULL,
  `banner_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bannerName` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `banner_url`, `type`, `banner_desc`, `status`, `creatBy`, `banner_date`, `bannerName`) VALUES
(16, '../layout/images/312805food07.jpg', 'slider', 'knd', 1, 'osama', '2017-04-19 21:36:35', '312805food07.jpg'),
(18, '../layout/images/433838luccarestaurant.jpg', 'slider', 'vhjkjkd', 1, 'osama', '2017-04-19 21:37:25', '433838luccarestaurant.jpg'),
(19, '../layout/images/70648Turkey.jpg', 'slider', 'gduj', 1, 'osama', '2017-04-19 22:11:40', '70648Turkey.jpg'),
(20, '../layout/images/46890pizza.jpg', 'slider', 'bdjlbahbdjbj', 1, 'osama', '2017-05-04 10:07:51', '46890pizza.jpg'),
(21, '../layout/images/63614carlsen51.jpg', 'slider', 'bjdbsj', 1, 'osama', '2017-05-04 13:11:08', '63614carlsen51.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `cat_desc` text NOT NULL,
  `ordering` int(11) NOT NULL,
  `visability` tinyint(4) NOT NULL DEFAULT '0',
  `allow_comment` tinyint(4) NOT NULL DEFAULT '0',
  `allow_ads` tinyint(4) NOT NULL DEFAULT '0',
  `image` varchar(250) NOT NULL,
  `cat_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createdBy` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`, `cat_desc`, `ordering`, `visability`, `allow_comment`, `allow_ads`, `image`, `cat_date`, `createdBy`, `url`) VALUES
(16, 'pizza', 'pizza', 1, 0, 0, 0, '355713pizza.jpg', '2017-04-20 17:19:41', 'osama', '../layout/images/355713pizza.jpg'),
(17, 'Sushi', 'meat', 2, 0, 0, 0, 'sushi.jpg', '2017-04-23 18:10:33', 'osama', '../layout/images/sushi.jpg'),
(18, 'pasta', 'lorem text lorem text lorem text lorem text lorem text lorem text lorem text ', 5, 0, 0, 0, '117859italian1.jpg', '2017-04-23 18:15:13', 'osama', '../layout/images/117859italian1.jpg'),
(19, 'drink', 'jbdkbis', 5, 0, 0, 0, '47268750030175.jpg', '2017-04-29 07:41:06', 'osama', '../layout/images/47268750030175.jpg'),
(21, 'osas', 'jaj', 20, 0, 0, 0, '87158wsj.png', '2017-05-04 13:10:43', 'osama', '../layout/images/87158wsj.png');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `comment_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `status`, `comment_date`, `item_id`, `user_id`) VALUES
(1, 'Too Mnay Jokes to moke joey\r\n\r\n', 1, '2017-04-28 19:39:08', 50, 16),
(2, 'i have to go before i put your head throught a wall\r\n\r\n', 1, '2017-04-28 19:39:58', 50, 32),
(3, 'Too Mnay Jokes to moke joey\r\n\r\n', 1, '2017-04-28 19:39:54', 50, 16),
(4, 'i have to go before i put your head throught a wall\r\n\r\n', 1, '2017-04-28 19:39:49', 50, 32),
(11, 'awesome', 1, '2017-04-28 20:57:07', 51, 16),
(12, 'awsome\r\n', 1, '2017-04-29 04:43:20', 13, 16),
(13, 's', 1, '2017-04-29 05:11:57', 50, 16),
(14, 'yes', 1, '2017-04-29 07:20:39', 32, 16),
(15, 'fghj\r\n', 1, '2017-04-29 09:56:11', 52, 16),
(16, 'amazing\r\n', 1, '2017-04-29 12:08:10', 29, 16),
(17, 'osama\r\n', 1, '2017-05-04 10:28:33', 29, 16),
(18, 'awesome', 1, '2017-05-04 14:45:31', 29, 16),
(19, 'jbj', 1, '2017-05-04 14:55:49', 29, 16);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_feed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `feedback`, `username`, `user_id`, `date_feed`) VALUES
(1, 'jgdsab', 'karem', 16, '2017-04-29 04:45:46'),
(2, 'jgdsab', 'karem', 16, '2017-04-29 04:45:54'),
(3, '006', 'karem', 16, '2017-04-29 07:52:54'),
(4, 'lojsaln', 'karem', 16, '2017-05-04 11:56:29');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `item_name` varchar(150) NOT NULL,
  `item_desc` varchar(255) NOT NULL,
  `price` varchar(150) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image` varchar(255) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_name`, `item_desc`, `price`, `add_date`, `image`, `cat_id`, `url`) VALUES
(13, 'tako', 'tako tako tako tako tako tako tako tako tako tako tako tako tako tako tako tako tako tako tako tako tako tako tako tako ', '15', '2017-04-23 23:53:49', '417649TakoPartyFood1476.lores.jpg', 17, '../layout/images/417649TakoPartyFood1476.lores.jpg'),
(14, 'sashimi', 'lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text ', '30', '2017-04-23 18:09:42', 'sashimi.jpg', 17, '../layout/images/sashimi.jpg'),
(15, 'Fotomaki', 'lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text ', '17', '2017-04-23 23:41:00', '313599fotomaki.jpg', 17, '../layout/images/313599fotomaki.jpg'),
(16, 'sashimi', 'lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text ', '30', '2017-04-23 18:09:42', 'sashimi.jpg', 17, '../layout/images/sashimi.jpg'),
(17, 'sashimi', 'lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text ', '30', '2017-04-23 18:09:42', 'sashimi.jpg', 17, '../layout/images/sashimi.jpg'),
(18, 'sashimi', 'lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text ', '30', '2017-04-23 18:09:43', 'sashimi.jpg', 17, '../layout/images/sashimi.jpg'),
(19, 'sashimi', 'lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text ', '30', '2017-04-23 18:09:43', 'sashimi.jpg', 17, '../layout/images/sashimi.jpg'),
(20, 'sashimi', 'lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text ', '30', '2017-04-23 18:09:43', 'sashimi.jpg', 17, '../layout/images/sashimi.jpg'),
(21, 'sashimi', 'lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text ', '30', '2017-04-23 18:09:43', 'sashimi.jpg', 17, '../layout/images/sashimi.jpg'),
(22, 'sashimi', 'lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text ', '30', '2017-04-23 18:09:43', 'sashimi.jpg', 17, '../layout/images/sashimi.jpg'),
(28, 'sashimi', 'lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text lorem text ', '30', '2017-04-23 18:09:43', 'sashimi.jpg', 17, '../layout/images/sashimi.jpg'),
(29, 'four chease', 'pizza four chease pizza four chease pizza four chease pizza four ', '12', '2017-04-24 02:50:56', '22966073184.jpg', 16, '../layout/images/22966073184.jpg'),
(31, 'surf & turf', 'pizza hotpizza hotpizza hotpizza hotpizza hotpizza hot', '15', '2017-04-23 23:48:00', '425614aventinospizzapasta.jpg', 16, '../layout/images/425614aventinospizzapasta.jpg'),
(32, 'pizza hot', 'pizza hotpizza hotpizza hotpizza hotpizza hotpizza hot', '20', '2017-04-23 23:30:45', 'pizza.jpg', 16, '../layout/images/pizza.jpg'),
(33, 'pizza hot', 'pizza hotpizza hotpizza hotpizza hotpizza hotpizza hot', '20', '2017-04-23 23:30:49', 'pizza.jpg', 16, '../layout/images/pizza.jpg'),
(34, 'pizza hot', 'pizza hotpizza hotpizza hotpizza hotpizza hotpizza hot', '20', '2017-04-23 23:30:52', 'pizza.jpg', 16, '../layout/images/pizza.jpg'),
(35, 'pizza hot', 'pizza hotpizza hotpizza hotpizza hotpizza hotpizza hot', '20', '2017-04-23 23:30:56', 'pizza.jpg', 16, '../layout/images/pizza.jpg'),
(36, 'pizza hot', 'pizza hotpizza hotpizza hotpizza hotpizza hotpizza hot', '20', '2017-04-23 23:30:59', 'pizza.jpg', 16, '../layout/images/pizza.jpg'),
(37, 'pizza hot', 'pizza hotpizza hotpizza hotpizza hotpizza hotpizza hot', '20', '2017-04-23 23:31:02', 'pizza.jpg', 16, '../layout/images/pizza.jpg'),
(38, 'pizza hot', 'pizza hotpizza hotpizza hotpizza hotpizza hotpizza hot', '20', '2017-04-23 23:31:06', 'pizza.jpg', 16, '../layout/images/pizza.jpg'),
(39, 'pizza hot', 'pizza hotpizza hotpizza hotpizza hotpizza hotpizza hot', '20', '2017-04-23 23:31:09', 'pizza.jpg', 16, '../layout/images/pizza.jpg'),
(40, 'pizza hot', 'pizza hotpizza hotpizza hotpizza hotpizza hotpizza hot', '20', '2017-04-23 23:31:13', 'pizza.jpg', 16, '../layout/images/pizza.jpg'),
(41, 'pizza hot', 'pizza hotpizza hotpizza hotpizza hotpizza hotpizza hot', '20', '2017-04-23 23:31:16', 'pizza.jpg', 16, '../layout/images/pizza.jpg'),
(42, 'pizza hot', 'pizza hotpizza hotpizza hotpizza hotpizza hotpizza hot', '20', '2017-04-23 23:31:19', 'pizza.jpg', 16, '../layout/images/pizza.jpg'),
(43, 'pizza hot', 'pizza hotpizza hotpizza hotpizza hotpizza hotpizza hot', '20', '2017-04-23 23:31:22', 'pizza.jpg', 16, '../layout/images/pizza.jpg'),
(44, 'pizza hot', 'pizza hotpizza hotpizza hotpizza hotpizza hotpizza hot', '20', '2017-04-21 01:27:26', '103256pizza.jpg', 16, '../layout/images/103256pizza.jpg'),
(47, 'pizza hot', 'pizza hotpizza hotpizza hotpizza hotpizza hotpizza hot', '20', '2017-04-21 01:27:26', '103256pizza.jpg', 16, '../layout/images/103256pizza.jpg'),
(50, 'recipes', 'pasta recipespasta recipespasta recipespasta recipespasta ', '10', '2017-04-24 01:49:31', '414902landscape1472241950delishjambalayapasta01.jpg', 18, '../layout/images/414902landscape1472241950delishjambalayapasta01.jpg'),
(51, 'pasta salad', 'pasta saladpasta saladpasta saladpasta salad', '20', '2017-04-23 23:34:31', '170471spaghetti625x35061436865755.jpg', 18, '../layout/images/170471spaghetti625x35061436865755.jpg'),
(52, 'italian pasta', 'italian pastaitalian pastaitalian pastaitalian pastaitalian pasta', '30', '2017-04-24 02:39:29', 'ClassicItalianPastaSalad.jpg', 18, '../layout/images/340759ClassicItalianPastaSalad.jpg'),
(53, 'french padta', 'italian pastaitalian pastaitalian pastaitalian pastaitalian pasta', '30', '2017-04-24 02:39:33', 'ClassicItalianPastaSalad.jpg', 18, '../layout/images/340759ClassicItalianPastaSalad.jpg'),
(54, 'italian pasta', 'italian pastaitalian pastaitalian pastaitalian pastaitalian pasta', '30', '2017-04-24 02:41:01', 'ClassicItalianPastaSalad.jpg', 18, '../layout/images/ClassicItalianPastaSalad.jpg'),
(55, 'italian pasta', 'italian pastaitalian pastaitalian pastaitalian pastaitalian pasta', '30', '2017-04-24 02:40:58', 'ClassicItalianPastaSalad.jpg', 18, '../layout/images/ClassicItalianPastaSalad.jpg'),
(57, 'italian pasta', 'italian pastaitalian pastaitalian pastaitalian pastaitalian pasta', '30', '2017-04-24 02:40:52', 'ClassicItalianPastaSalad.jpg', 18, '../layout/images/ClassicItalianPastaSalad.jpg'),
(58, 'italian pasta', 'italian pastaitalian pastaitalian pastaitalian pastaitalian pasta', '30', '2017-04-24 02:40:48', 'ClassicItalianPastaSalad.jpg', 18, '../layout/images/ClassicItalianPastaSalad.jpg'),
(59, 'italian pasta', 'italian pastaitalian pastaitalian pastaitalian pastaitalian pasta', '30', '2017-04-24 02:40:44', 'ClassicItalianPastaSalad.jpg', 18, '../layout/images/ClassicItalianPastaSalad.jpg'),
(60, 'italian pasta', 'italian pastaitalian pastaitalian pastaitalian pastaitalian pasta', '30', '2017-04-24 02:40:41', 'ClassicItalianPastaSalad.jpg', 18, '../layout/images/ClassicItalianPastaSalad.jpg'),
(61, 'italian pasta', 'italian pastaitalian pastaitalian pastaitalian pastaitalian pasta', '30', '2017-04-24 02:40:36', 'ClassicItalianPastaSalad.jpg', 18, '../layout/images/ClassicItalianPastaSalad.jpg'),
(62, 'italian pasta', 'italian pastaitalian pastaitalian pastaitalian pastaitalian pasta', '30', '2017-04-24 02:40:33', 'ClassicItalianPastaSalad.jpg', 18, '../layout/images/ClassicItalianPastaSalad.jpg'),
(63, 'italian pasta', 'italian pastaitalian pastaitalian pastaitalian pastaitalian pasta', '30', '2017-04-24 02:40:30', 'ClassicItalianPastaSalad.jpg', 18, '../layout/images/ClassicItalianPastaSalad.jpg'),
(64, 'italian pasta', 'italian pastaitalian pastaitalian pastaitalian pastaitalian pasta', '30', '2017-04-24 02:40:27', 'ClassicItalianPastaSalad.jpg', 18, '../layout/images/ClassicItalianPastaSalad.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `mealName` varchar(150) NOT NULL,
  `fullName` varchar(150) NOT NULL,
  `address` varchar(255) NOT NULL,
  `price` varchar(50) NOT NULL,
  `orderedBy` varchar(150) NOT NULL,
  `item_id` int(11) NOT NULL,
  `cridit` int(11) NOT NULL,
  `phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `mealName`, `fullName`, `address`, `price`, `orderedBy`, `item_id`, `cridit`, `phone`) VALUES
(1, 'tako', 'd', 'jbjbj', '15', '', 13, 79, 45),
(2, 'tako', 'd', 'jbjbj', '15', '', 13, 79, 45),
(3, 'tako', 'd', 'jbjbj', '15', '', 13, 79, 45),
(4, 'tako', 'osama', 'cairo', '15', 'karem', 13, 646, 1229194145),
(5, 'tako', 'osama', 'cairo', '15', 'karem', 13, 646, 1229194145),
(6, 'tako', 'osama', 'cairo', '15', 'karem', 13, 646, 1229194145),
(7, 'tako', 'osama', 'cairo', '15', 'karem', 13, 646, 1229194145),
(8, 'tako', 'osama', 'cairo', '15', 'karem', 13, 646, 1229194145),
(9, 'tako', 'osama', 'cairo', '15', 'karem', 13, 646, 1229194145),
(10, 'tako', 'osama', 'cairo', '15', 'karem', 13, 646, 1229194145),
(11, 'tako', 'osama', 'cairo', '15', 'karem', 13, 646, 1229194145),
(12, 'four chease', 'kareem', 'talkha', '12', 'karem', 29, 225, 1099431740);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `phonenum` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `numperson` tinyint(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `cridit` varchar(255) NOT NULL,
  `post_code` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Fullname` varchar(200) NOT NULL,
  `GroupId` int(11) NOT NULL DEFAULT '0',
  `trustStatus` int(11) NOT NULL DEFAULT '0',
  `regStatus` int(11) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `address` varchar(255) NOT NULL,
  `postCode` varchar(255) NOT NULL,
  `telephone` int(11) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'http://placehold.it/200x200',
  `cover` varchar(255) NOT NULL DEFAULT 'http://placehold.it/1200x300'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `Email`, `Fullname`, `GroupId`, `trustStatus`, `regStatus`, `date`, `address`, `postCode`, `telephone`, `image`, `cover`) VALUES
(1, 'sayed', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'sayed@gmail.com', 'Sayed ibrahem elmohamady', 1, 0, 0, '2017-03-17 01:33:23', '', '', 0, '', ''),
(12, 'Ahmed', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'ahmed@ahmed.com', 'ahmedahmedahmed', 0, 0, 1, '2017-03-17 01:51:42', '', '', 0, '', ''),
(16, 'karem', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'karem@karem.com', 'karem mohamed', 0, 0, 1, '2017-05-04 12:53:49', 'cairo-egypt', '', 1229194145, '72921preview.jpg', '238403raleighwebsitedesign.jpg'),
(26, 'osama', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'os.ns2013@gmail.com', 'osama mohamed nasr', 1, 0, 0, '2017-04-20 01:53:51', '', '', 0, '', ''),
(30, 'khaled', '', 'k@k.com', 'khaled mohsen ', 0, 0, 1, '2017-04-29 02:05:18', 'aswan-Street-town', '5454', 4616, '', ''),
(32, 'osamanasr', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'os.ns2013@gmail.com', '', 0, 0, 1, '2017-04-29 07:44:04', 'aswan-Street-town', '44', 1664, '', ''),
(33, 'yaser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'yase@y.com', 'yaser ', 0, 0, 1, '2017-05-04 13:09:47', '', '', 0, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cat_name` (`cat_name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `item_comment` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_comment` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `item` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `ordereditem` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
