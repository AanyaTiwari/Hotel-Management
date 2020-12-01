-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 07, 2019 at 07:27 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `uid` int(20) NOT NULL AUTO_INCREMENT,
  `uname` varchar(30) NOT NULL,
  `upass` varchar(30) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `uemail` varchar(30) NOT NULL,
  `phone` varchar(11) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`uid`, `uname`, `upass`, `fullname`, `uemail`, `phone`) VALUES
(6, 'admin', 'sagar', 'admin', 'admin@admin.com', '7577013554');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `fname` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE IF NOT EXISTS `food` (
  `fid` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`fid`, `fname`, `type`, `price`) VALUES
('3', 'Mutton biryani', 'Non-veg', 290),
('4', 'Paratha', 'Veg', 30),
('5', 'Butter Chicken', 'Non-veg', 200),
('6', 'Panner chilly', 'Veg', 150);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `room_id` int(200) NOT NULL AUTO_INCREMENT,
  `room_cat` text NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `name` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `book` text NOT NULL,
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_cat`, `checkin`, `checkout`, `name`, `phone`, `book`) VALUES
(1, 'Delux', '2019-11-05', '2019-11-05', 'Sagar Kumar', '1234566789', 'true'),
(2, 'Family', '2019-11-05', '2019-11-11', 'random', '2345678901', 'true'),
(3, 'premium', '2019-11-05', '2019-11-05', 'sagar kumar prasad', '3456789987', 'true'),
(4, 'premium', '2019-11-05', '2019-11-05', 'sagar kumar prasad', '3456789987', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `room_category`
--

CREATE TABLE IF NOT EXISTS `room_category` (
  `roomname` text NOT NULL,
  `room_qnty` int(11) NOT NULL,
  `available` int(11) NOT NULL,
  `booked` int(11) NOT NULL,
  `no_bed` int(11) NOT NULL,
  `bedtype` text NOT NULL,
  `facility` text NOT NULL,
  `price` float NOT NULL,
  `room_pic` longblob,
  PRIMARY KEY (`roomname`(100))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_category`
--

INSERT INTO `room_category` (`roomname`, `room_qnty`, `available`, `booked`, `no_bed`, `bedtype`, `facility`, `price`, `room_pic`) VALUES
('Delux', 3, 1, 2, 3, 'single', 'tv, fridge, balcony', 2800, 0x44656c7578),
('Duplex', 5, 5, 0, 2, 'single', 'AC, TV, Wifi', 1500, 0x4475706c6578),
('Family', 3, 2, 1, 2, 'double', 'Sofa, TV, AC, freeze, wifi', 3500, 0x3f3f3f3f001845786966000049492a000800000000000000000000003f3f00114475636b79000100040000003200003f3f0318687474703a2f2f6e732e61646f62652e636f6d2f7861702f312e302f003c3f787061636b657420626567696e3d22efbbbf222069643d2257354d304d7043656869487a7265537a4e54637a6b633964223f3e203c783a786d706d65746120786d6c6e733a783d2261646f62653a6e733a6d6574612f2220783a786d70746b3d2241646f626520584d5020436f726520352e302d633036302036312e3133343737372c20323031302f30322f31322d31373a33323a30302020202020202020223e203c7264663a52444620786d6c6e),
('premium', 5, 3, 2, 2, 'double', 'AC, TV, Wifi', 5000, 0x3f3f3f3f00104a464946000101010048004800003f3f004300010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101013f3f004301010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101013f3f00110802160320030122000211010311013f3f001f0000010501010101010100000000000000000102030405060708090a0b3f3f003f100002010303020403050504040000017d01020300041105122131410613516107227114323f3f3f08),
('Super Comfort', 6, 6, 0, 1, 'double', 'AC, TV, WIFI', 2200, 0x3f3f3f3f00104a464946000101010060006000003f3f00430006040506050406060506070706080a100a0a09090a140e0f0c1017141818171416161a1d251f1a1b231c1616202c20232627292a29191f2d302d2830252829283f3f0043010707070a080a130a0a13281a161a28282828282828282828282828282828282828282828282828282828282828282828282828282828282828282828282828283f3f00110802160320030122000211010311013f3f001f0000010501010101010100000000000000000102030405060708090a0b3f3f003f100002010303020403050504040000017d01020300041105122131410613516107227114323f3f3f08);

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE IF NOT EXISTS `sale` (
  `fname` varchar(255) NOT NULL,
  `qty` int(15) NOT NULL,
  `price` int(15) NOT NULL,
  `amount` int(15) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`fname`, `qty`, `price`, `amount`, `date`) VALUES
('Paratha', 5, 30, 150, '2019-10-26'),
('Panner chilly', 3, 150, 450, '2019-10-26'),
('Butter Chicken', 3, 200, 600, '2019-10-26'),
('mutton biryani', 7, 290, 2030, '2019-10-27'),
('Paratha', 8, 30, 240, '2019-10-27'),
('Butter Chicken', 2, 200, 400, '2019-10-27'),
('Mutton biryani', 2, 290, 580, '2019-10-28'),
('Butter Chicken', 2, 200, 400, '2019-10-28'),
('Mutton biryani', 2, 290, 580, '2019-10-30'),
('Paratha', 2, 30, 60, '2019-10-30'),
('Mutton biryani', 2, 290, 580, '2019-10-31'),
('Paratha', 1, 30, 30, '2019-10-31'),
('Mutton biryani', 2, 290, 580, '2019-11-03'),
('Paratha', 4, 30, 120, '2019-11-05'),
('Panner chilly', 2, 150, 300, '2019-11-05'),
('Mutton biryani', 1, 290, 290, '2019-11-05');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `sid` int(20) NOT NULL AUTO_INCREMENT,
  `uname` varchar(30) NOT NULL,
  `upass` varchar(30) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `uemail` varchar(30) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`sid`, `uname`, `upass`, `fullname`, `uemail`) VALUES
(6, 'staff', '1234', 'staff', 'staff@staff.com'),
(7, 'sagar', 'sagar', 'Sagar kumar', 'sagar@66');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
