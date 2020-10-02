-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2019 at 08:00 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `railcoaches`
--

-- --------------------------------------------------------

--
-- Table structure for table `break_shop`
--

CREATE TABLE `break_shop` (
  `reg_id` int(4) NOT NULL,
  `coach_no` int(6) NOT NULL,
  `break_in` date NOT NULL,
  `break_out` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `break_shop`
--

INSERT INTO `break_shop` (`reg_id`, `coach_no`, `break_in`, `break_out`) VALUES
(6, 8250, '2019-06-28', '0000-00-00'),
(12, 8290, '2019-07-02', '2019-07-02'),
(13, 8560, '2019-07-02', '2019-07-02'),
(19, 8256, '2019-07-02', '2019-07-02'),
(20, 8124, '2019-06-29', '2019-06-29'),
(24, 8116, '2019-06-29', '2019-06-29'),
(26, 2590, '2019-06-29', '2019-06-29'),
(27, 8992, '2019-06-28', '2019-07-02'),
(30, 8772, '2019-07-02', '2019-07-02');

-- --------------------------------------------------------

--
-- Table structure for table `coachmaster`
--

CREATE TABLE `coachmaster` (
  `RAILWAY_ZONE` varchar(5) NOT NULL,
  `ALLOATED_BASE` varchar(4) NOT NULL,
  `COACH_NO` varchar(6) NOT NULL,
  `FULL_BRAKE` varchar(4) NOT NULL,
  `COACH_TYPE` varchar(10) NOT NULL,
  `MAKE` varchar(7) NOT NULL,
  `CATEGORY` varchar(6) NOT NULL,
  `BUILT_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coachmaster`
--

INSERT INTO `coachmaster` (`RAILWAY_ZONE`, `ALLOATED_BASE`, `COACH_NO`, `FULL_BRAKE`, `COACH_TYPE`, `MAKE`, `CATEGORY`, `BUILT_DATE`) VALUES
('SER', 'KGP', '008321', 'AB', 'WGSCZ', 'IRS', 'AC', '2019-06-27'),
('CR', 'TATA', '008645', 'AB', 'ERT', 'IRS', 'AC', '2019-07-04'),
('CR', 'TATA', '009635', 'AB', 'ERT', 'IRS', 'AC', '2019-07-02');

-- --------------------------------------------------------

--
-- Table structure for table `coachreg`
--

CREATE TABLE `coachreg` (
  `reg_id` int(4) NOT NULL,
  `coach_no` int(6) NOT NULL,
  `workshop_in` date NOT NULL,
  `shop_in` date NOT NULL,
  `estimated_hours` int(4) NOT NULL,
  `repair_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coachreg`
--

INSERT INTO `coachreg` (`reg_id`, `coach_no`, `workshop_in`, `shop_in`, `estimated_hours`, `repair_type`) VALUES
(1, 8212, '2019-06-13', '2019-06-17', 300, 'MCR'),
(2, 8110, '2019-06-14', '2019-06-27', 245, 'POH'),
(3, 7450, '2019-06-14', '2019-06-25', 500, 'HCR'),
(4, 8270, '2019-06-18', '0000-00-00', 255, 'MCR'),
(5, 8650, '2019-06-17', '2019-06-27', 350, 'POH'),
(6, 8250, '2019-06-15', '2019-06-27', 500, 'POH'),
(7, 8450, '2019-06-14', '2019-06-25', 200, 'MCR'),
(8, 8112, '2019-06-12', '2019-06-25', 700, 'POH'),
(9, 8772, '2019-06-14', '2019-06-27', 340, 'HCR'),
(10, 8140, '2019-06-13', '2019-06-19', 540, 'POH'),
(11, 8225, '2019-06-11', '2019-06-19', 220, 'HCR'),
(12, 8290, '2019-06-18', '2019-06-23', 525, 'HCR'),
(13, 8560, '2019-06-11', '2019-06-23', 340, 'MCR'),
(14, 6250, '2019-06-19', '0000-00-00', 450, 'HCR'),
(15, 8276, '2019-06-15', '2019-06-23', 200, 'MCR'),
(16, 8430, '2019-06-11', '2019-06-25', 800, 'POH'),
(17, 8630, '2019-06-13', '2019-06-23', 420, 'MCR'),
(18, 8293, '2019-06-14', '2019-06-23', 730, 'HCR'),
(19, 8256, '2019-06-14', '2019-06-24', 450, 'POH'),
(20, 8124, '2019-06-13', '2019-06-29', 500, 'MCR'),
(21, 8490, '2019-06-11', '2019-06-25', 439, 'POH'),
(22, 8315, '2019-06-18', '2019-06-28', 465, 'POH'),
(23, 8247, '2019-06-18', '0000-00-00', 340, 'POH'),
(24, 8116, '2019-06-12', '2019-06-29', 890, 'MCR'),
(25, 6683, '2019-06-13', '2019-06-27', 970, 'MCR'),
(26, 2590, '2019-06-18', '2019-06-27', 340, 'POH'),
(27, 8992, '2019-06-18', '2019-06-27', 560, 'MCR'),
(31, 8250, '2019-06-26', '2019-06-27', 200, 'POH'),
(32, 8212, '2019-06-28', '2019-06-28', 698, 'MCR');

-- --------------------------------------------------------

--
-- Table structure for table `hcrtable`
--

CREATE TABLE `hcrtable` (
  `reg_id` int(4) NOT NULL,
  `coach_no` int(6) NOT NULL,
  `shop_in` date NOT NULL,
  `shop_out` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hcrtable`
--

INSERT INTO `hcrtable` (`reg_id`, `coach_no`, `shop_in`, `shop_out`) VALUES
(2, 8110, '2019-06-27', '0000-00-00'),
(13, 8560, '2019-07-02', '2019-07-02'),
(15, 8276, '2019-06-27', '2019-06-27'),
(18, 8293, '2019-06-27', '0000-00-00'),
(24, 8116, '2019-06-29', '2019-06-29'),
(26, 2590, '2019-06-29', '2019-06-29'),
(30, 8772, '2019-06-27', '2019-07-02');

-- --------------------------------------------------------

--
-- Table structure for table `last_repair`
--

CREATE TABLE `last_repair` (
  `reg_id` int(4) NOT NULL,
  `coach_no` int(6) NOT NULL,
  `re_in` date NOT NULL,
  `re_out` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `last_repair`
--

INSERT INTO `last_repair` (`reg_id`, `coach_no`, `re_in`, `re_out`) VALUES
(12, 8290, '2019-07-02', '2019-07-02'),
(13, 8560, '2019-07-02', '2019-07-02'),
(19, 8256, '2019-07-02', '2019-07-02'),
(27, 8992, '2019-07-02', '0000-00-00'),
(50, 3960, '2019-07-02', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `lifting`
--

CREATE TABLE `lifting` (
  `reg_id` int(4) NOT NULL,
  `coach_no` int(6) NOT NULL,
  `lift_in` date NOT NULL,
  `lift_out` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lifting`
--

INSERT INTO `lifting` (`reg_id`, `coach_no`, `lift_in`, `lift_out`) VALUES
(1, 8212, '2019-06-27', '2019-06-28'),
(6, 8250, '2019-06-28', '2019-06-28'),
(12, 8290, '2019-07-02', '2019-07-02'),
(13, 8560, '2019-07-02', '2019-07-02'),
(17, 8630, '2019-06-28', '0000-00-00'),
(19, 8256, '2019-07-02', '2019-07-02'),
(20, 8124, '2019-06-29', '2019-06-29'),
(24, 8116, '2019-06-29', '2019-06-29'),
(26, 2590, '2019-06-29', '2019-06-29'),
(27, 8992, '2019-06-28', '2019-06-28'),
(30, 8772, '2019-07-02', '2019-07-02'),
(32, 8212, '2019-06-28', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `mcrtable`
--

CREATE TABLE `mcrtable` (
  `reg_id` int(4) NOT NULL,
  `coach_no` int(6) NOT NULL,
  `shop_in` date NOT NULL,
  `shop_out` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mcrtable`
--

INSERT INTO `mcrtable` (`reg_id`, `coach_no`, `shop_in`, `shop_out`) VALUES
(5, 8650, '2019-06-28', '0000-00-00'),
(12, 8290, '2019-07-02', '2019-07-02'),
(19, 8256, '2019-06-24', '2019-07-02'),
(25, 6683, '2019-06-27', '2019-06-27'),
(31, 8250, '2019-06-27', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `ntxr`
--

CREATE TABLE `ntxr` (
  `reg_id` int(4) NOT NULL,
  `coach_no` int(6) NOT NULL,
  `fit` varchar(3) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ntxr`
--

INSERT INTO `ntxr` (`reg_id`, `coach_no`, `fit`, `check_in`, `check_out`) VALUES
(12, 8290, 'NO', '2019-07-02', '2019-07-02'),
(13, 8560, 'NO', '2019-07-02', '2019-07-02'),
(19, 8256, 'NO', '2019-07-02', '2019-07-02'),
(20, 8124, '', '2019-06-29', '0000-00-00'),
(24, 8116, 'YES', '2019-06-29', '2019-06-29'),
(26, 2590, '', '2019-06-29', '0000-00-00'),
(27, 8992, 'NO', '2019-07-02', '2019-07-02'),
(30, 8772, 'YES', '2019-07-02', '2019-07-02'),
(50, 3960, 'NO', '2019-06-21', '2019-07-02');

-- --------------------------------------------------------

--
-- Table structure for table `painting`
--

CREATE TABLE `painting` (
  `reg_id` int(4) NOT NULL,
  `coach_no` int(6) NOT NULL,
  `paint_in` date NOT NULL,
  `paint_out` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `painting`
--

INSERT INTO `painting` (`reg_id`, `coach_no`, `paint_in`, `paint_out`) VALUES
(6, 8250, '2019-06-27', '2019-06-28'),
(12, 8290, '2019-07-02', '2019-07-02'),
(13, 8560, '2019-07-02', '2019-07-02'),
(16, 8430, '2019-06-25', '0000-00-00'),
(17, 8630, '2019-06-27', '2019-06-28'),
(19, 8256, '2019-07-02', '2019-07-02'),
(20, 8124, '2019-06-29', '2019-06-29'),
(21, 8490, '2019-06-27', '0000-00-00'),
(24, 8116, '2019-06-29', '2019-06-29'),
(26, 2590, '2019-06-29', '2019-06-29'),
(27, 8992, '2019-06-28', '2019-06-28'),
(30, 8772, '2019-07-02', '2019-07-02'),
(32, 8212, '2019-06-28', '2019-06-28');

-- --------------------------------------------------------

--
-- Table structure for table `pohtable`
--

CREATE TABLE `pohtable` (
  `reg_id` int(4) NOT NULL,
  `coach_no` int(6) NOT NULL,
  `shop_in` date NOT NULL,
  `shop_out` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pohtable`
--

INSERT INTO `pohtable` (`reg_id`, `coach_no`, `shop_in`, `shop_out`) VALUES
(3, 7450, '2019-06-25', '0000-00-00'),
(6, 8250, '2019-06-25', '2019-06-27'),
(7, 8450, '2019-06-25', '0000-00-00'),
(16, 8430, '2019-06-23', '2019-06-25'),
(17, 8630, '2019-06-23', '2019-06-27'),
(20, 8124, '2019-06-29', '2019-06-29'),
(21, 8490, '2019-06-25', '2019-06-27'),
(26, 2590, '2019-06-28', '2019-06-29'),
(27, 8992, '2019-06-27', '2019-06-28'),
(32, 8212, '2019-06-28', '2019-06-28');

-- --------------------------------------------------------

--
-- Table structure for table `strip_ins`
--

CREATE TABLE `strip_ins` (
  `reg_id` int(4) NOT NULL,
  `coach_no` int(6) NOT NULL,
  `strip_in` date NOT NULL,
  `strip_out` date NOT NULL,
  `actual_hour` int(10) NOT NULL,
  `shop` varchar(100) NOT NULL,
  `shop_no` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `strip_ins`
--

INSERT INTO `strip_ins` (`reg_id`, `coach_no`, `strip_in`, `strip_out`, `actual_hour`, `shop`, `shop_no`) VALUES
(2, 8110, '2019-06-27', '2019-06-27', 8690, 'HCR', 33),
(3, 7450, '2019-06-25', '2019-06-25', 450, 'POH', 25),
(5, 8650, '2019-06-27', '2019-06-28', 633, 'MCR', 26),
(6, 8250, '2019-06-25', '2019-06-25', 169, 'POH', 25),
(7, 8450, '2019-06-25', '2019-06-25', 189, 'POH', 25),
(8, 8112, '2019-06-25', '0000-00-00', 0, '', 0),
(9, 8772, '2019-06-25', '0000-00-00', 0, '', 0),
(12, 8290, '2019-06-23', '2019-07-02', 790, 'MCR', 26),
(13, 8560, '2019-06-23', '2019-07-02', 3990, 'HCR', 33),
(15, 8276, '2019-06-23', '2019-06-27', 1590, 'HCR', 33),
(16, 8430, '2019-06-23', '2019-06-23', 210, 'POH', 25),
(17, 8630, '2019-06-23', '2019-06-23', 130, 'POH', 25),
(18, 8293, '2019-06-23', '2019-06-27', 1993, 'HCR', 33),
(19, 8256, '2019-06-24', '2019-06-24', 650, 'MCR', 26),
(20, 8124, '2019-06-29', '2019-06-29', 330, 'POH', 25),
(21, 8490, '2019-06-25', '2019-06-25', 225, 'POH', 25),
(22, 8315, '2019-06-28', '0000-00-00', 0, '', 0),
(24, 8116, '2019-06-29', '2019-06-29', 1630, 'HCR', 33),
(25, 6683, '2019-06-27', '2019-06-27', 539, 'MCR', 26),
(26, 2590, '2019-06-27', '2019-06-29', 3990, 'HCR', 33),
(27, 8992, '2019-06-27', '2019-06-27', 135, 'POH', 25),
(31, 8250, '2019-06-27', '2019-06-27', 530, 'MCR', 26),
(32, 8212, '2019-06-28', '2019-06-28', 360, 'POH', 25);

-- --------------------------------------------------------

--
-- Table structure for table `trafficout`
--

CREATE TABLE `trafficout` (
  `reg_id` int(4) NOT NULL,
  `coach_no` int(6) NOT NULL,
  `date_out` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trafficout`
--

INSERT INTO `trafficout` (`reg_id`, `coach_no`, `date_out`) VALUES
(12, 8290, '2019-07-02'),
(13, 8560, '2019-07-02'),
(19, 8256, '2019-07-02'),
(24, 8116, '2019-06-29'),
(30, 8772, '2019-07-02');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `userlevel` int(1) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `doj` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `userlevel`, `firstname`, `lastname`, `email`, `doj`) VALUES
(7, 'sarthak', '7ea37afafc208859db2b5cbc67521f62', 2, 'Sarthhak', 'Roy', 'sarthak98@gmail.com', '2019-06-27'),
(8, 'sritama', 'fcf2100b8d75e6797597bede469a2b1d', 1, 'Sritama', 'Dey', 'sirilife17@gmail.com', '2019-07-01'),
(9, 'anmolrr', '6b974b8d0a6b6053d93553eb5e09ca57', 1, 'Anmol', 'Anmol', 'anmol99@gmail.com', '2019-06-13'),
(10, 'rittwik', '896f8909d8cc0f6e5eac89150fd2a218', 1, 'Rittwik', 'Sarkar', 'rittwik98@gmail.com', '2019-07-04'),
(11, 'jessaii', 'ca8d646fc464c20f393f1c5c58be82c2', 2, 'Jessai', 'Hasda', 'jesai98@gmail.com', '2019-07-03'),
(14, 'srjukta', '7f37228505f4df369e42967195017488', 1, 'Srijukta', 'Sarkar', 'srijuktadey92@gmail.com', '2019-07-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `break_shop`
--
ALTER TABLE `break_shop`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `coachmaster`
--
ALTER TABLE `coachmaster`
  ADD PRIMARY KEY (`COACH_NO`);

--
-- Indexes for table `coachreg`
--
ALTER TABLE `coachreg`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `hcrtable`
--
ALTER TABLE `hcrtable`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `last_repair`
--
ALTER TABLE `last_repair`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `lifting`
--
ALTER TABLE `lifting`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `mcrtable`
--
ALTER TABLE `mcrtable`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `ntxr`
--
ALTER TABLE `ntxr`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `painting`
--
ALTER TABLE `painting`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `pohtable`
--
ALTER TABLE `pohtable`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `strip_ins`
--
ALTER TABLE `strip_ins`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `trafficout`
--
ALTER TABLE `trafficout`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `break_shop`
--
ALTER TABLE `break_shop`
  MODIFY `reg_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `coachreg`
--
ALTER TABLE `coachreg`
  MODIFY `reg_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `last_repair`
--
ALTER TABLE `last_repair`
  MODIFY `reg_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `lifting`
--
ALTER TABLE `lifting`
  MODIFY `reg_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `mcrtable`
--
ALTER TABLE `mcrtable`
  MODIFY `reg_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `ntxr`
--
ALTER TABLE `ntxr`
  MODIFY `reg_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `painting`
--
ALTER TABLE `painting`
  MODIFY `reg_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `strip_ins`
--
ALTER TABLE `strip_ins`
  MODIFY `reg_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `trafficout`
--
ALTER TABLE `trafficout`
  MODIFY `reg_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
