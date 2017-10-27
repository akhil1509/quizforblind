-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2017 at 11:24 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `btest`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `loginid` varchar(20) NOT NULL DEFAULT '',
  `pass` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`loginid`, `pass`) VALUES
('quizadmin', 'quizadmin');

-- --------------------------------------------------------

--
-- Table structure for table `c language`
--

CREATE TABLE `c language` (
  `id` int(6) UNSIGNED NOT NULL,
  `t_id` varchar(50) DEFAULT NULL,
  `tests` text,
  `testtime` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `c language`
--

INSERT INTO `c language` (`id`, `t_id`, `tests`, `testtime`) VALUES
(1, 'test_1486400610', 'Practice Test 1', '30');

-- --------------------------------------------------------

--
-- Table structure for table `c language-practice test 1`
--

CREATE TABLE `c language-practice test 1` (
  `id` int(6) UNSIGNED NOT NULL,
  `q_id` varchar(50) DEFAULT NULL,
  `guidelines` text NOT NULL,
  `questions` text,
  `option1` varchar(100) DEFAULT NULL,
  `option2` varchar(100) DEFAULT NULL,
  `option3` varchar(100) DEFAULT NULL,
  `option4` varchar(100) DEFAULT NULL,
  `option5` varchar(100) DEFAULT NULL,
  `answer` varchar(50) DEFAULT NULL,
  `exp` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `c language-practice test 1`
--

INSERT INTO `c language-practice test 1` (`id`, `q_id`, `guidelines`, `questions`, `option1`, `option2`, `option3`, `option4`, `option5`, `answer`, `exp`) VALUES
(1, 'question_1486400755', 'Answer all', 'What is used for displaying content in C?', 'printf();', 'scanf();', 'echo();', 'print();', 'document.write();', 'A', 'printf is used to display content in C. Syntax: printf("hello world");'),
(2, 'question_1486400849', '', 'What is used for reading content in C?', 'echo', 'scanf()', 'printf()', 'print()', '$', 'B', 'scanf is used to read content. Syntax: scanf("%d",&a);'),
(3, 'question_1486475254', '', 'x = 5;\r\ny = 7;\r\nx + y= ?', '12', '5', '3', '2', '8', 'A', '5+7=12');

-- --------------------------------------------------------

--
-- Table structure for table `gk`
--

CREATE TABLE `gk` (
  `id` int(6) UNSIGNED NOT NULL,
  `t_id` varchar(50) DEFAULT NULL,
  `tests` text,
  `testtime` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gk`
--

INSERT INTO `gk` (`id`, `t_id`, `tests`, `testtime`) VALUES
(1, 'test_1488315010', 'Practice Test 1', '30');

-- --------------------------------------------------------

--
-- Table structure for table `gk-practice test 1`
--

CREATE TABLE `gk-practice test 1` (
  `id` int(6) UNSIGNED NOT NULL,
  `q_id` varchar(50) DEFAULT NULL,
  `guidelines` text,
  `questions` text,
  `option1` varchar(100) DEFAULT NULL,
  `option2` varchar(100) DEFAULT NULL,
  `option3` varchar(100) DEFAULT NULL,
  `option4` varchar(100) DEFAULT NULL,
  `option5` varchar(100) DEFAULT NULL,
  `answer` varchar(50) DEFAULT NULL,
  `exp` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gk-practice test 1`
--

INSERT INTO `gk-practice test 1` (`id`, `q_id`, `guidelines`, `questions`, `option1`, `option2`, `option3`, `option4`, `option5`, `answer`, `exp`) VALUES
(1, 'question_1488315091', '', 'FRS stands for', 'Fellow Research System', 'Federation of Regulation Society', 'Fellow of Royal Society', 'Fine Resource Sector', 'None of the above', 'C', 'FRS stands for Fellow of Royal Society'),
(2, 'question_1488315404', '', 'The ozone layer restricts', 'Visible light', 'Infrared radiation', 'X-rays and gamma rays', 'Ultraviolet radiation', 'Radio waves', 'D', 'The ozone layer restricts Ultraviolet radiation'),
(3, 'question_1488315485', '', 'Euclid was', 'Greek mathematician', 'Contributor to the use of deductive principles of logic as the basis of geometry', 'Propounded the geometrical theorems', 'Human', 'All of the above', 'E', 'All of the above');

-- --------------------------------------------------------

--
-- Table structure for table `lang`
--

CREATE TABLE `lang` (
  `id` int(11) NOT NULL,
  `subjects` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lang`
--

INSERT INTO `lang` (`id`, `subjects`) VALUES
(2, 'c language'),
(3, 'gk'),
(4, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(6) UNSIGNED NOT NULL,
  `t_id` varchar(50) DEFAULT NULL,
  `tests` text,
  `testtime` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `t_id`, `tests`, `testtime`) VALUES
(1, 'test_1488396259', 'Practice Test 1', '30');

-- --------------------------------------------------------

--
-- Table structure for table `test-practice test 1`
--

CREATE TABLE `test-practice test 1` (
  `id` int(6) UNSIGNED NOT NULL,
  `q_id` varchar(50) DEFAULT NULL,
  `guidelines` text,
  `questions` text,
  `option1` varchar(100) DEFAULT NULL,
  `option2` varchar(100) DEFAULT NULL,
  `option3` varchar(100) DEFAULT NULL,
  `option4` varchar(100) DEFAULT NULL,
  `option5` varchar(100) DEFAULT NULL,
  `answer` varchar(50) DEFAULT NULL,
  `exp` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test-practice test 1`
--

INSERT INTO `test-practice test 1` (`id`, `q_id`, `guidelines`, `questions`, `option1`, `option2`, `option3`, `option4`, `option5`, `answer`, `exp`) VALUES
(1, 'question_1488396300', 'Answer all questions', 'abc', 'd d', 'd e', 'f d', 'd r', 'f e', 'B', 'abcde'),
(2, 'question_1488396362', '', '300 + 200 = ?', '200', '500', '100', '600', '400', 'B', '300 + 200 = 500'),
(3, 'question_1488396425', '', 'Hello', 'Hey', 'World', 'Hello', 'Earth', 'Hi', 'B', 'Hello World');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `userid` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `userid`, `password`, `username`, `address`, `city`, `phone`, `email`) VALUES
(1, 'quizuser', '9b395e600494fdabdb4acd5238a22745', 'quizuser', '2-2-2', 'Hyerabad', '1234567890', 'test.test@test.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`loginid`,`pass`);

--
-- Indexes for table `c language`
--
ALTER TABLE `c language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `c language-practice test 1`
--
ALTER TABLE `c language-practice test 1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gk`
--
ALTER TABLE `gk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gk-practice test 1`
--
ALTER TABLE `gk-practice test 1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lang`
--
ALTER TABLE `lang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test-practice test 1`
--
ALTER TABLE `test-practice test 1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `c language`
--
ALTER TABLE `c language`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `c language-practice test 1`
--
ALTER TABLE `c language-practice test 1`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `gk`
--
ALTER TABLE `gk`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gk-practice test 1`
--
ALTER TABLE `gk-practice test 1`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lang`
--
ALTER TABLE `lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `test-practice test 1`
--
ALTER TABLE `test-practice test 1`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
