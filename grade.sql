-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2020 at 05:30 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grade`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `No` int(200) NOT NULL,
  `adminID` varchar(200) NOT NULL,
  `adminName` varchar(200) NOT NULL,
  `adminUid` varchar(200) NOT NULL,
  `adminEmail` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`No`, `adminID`, `adminName`, `adminUid`, `adminEmail`) VALUES
(1, '6995', 'admin1234', 'admin1234', 'admin1234@gmail.com'),
(4, 'admin', 'admin', 'admin', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `No` int(200) NOT NULL,
  `courseID` varchar(200) NOT NULL,
  `courseName` varchar(200) NOT NULL,
  `courseYear` int(4) NOT NULL,
  `courseMonth` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`No`, `courseID`, `courseName`, `courseYear`, `courseMonth`) VALUES
(7, 'SEMD', 'Sofware Engineering and Mobile Development', 2018, 'May'),
(10, 'SEMD', 'Sofware Engineering and Mobile Development', 2018, 'September'),
(15, 'SEMD', 'Sofware Engineering and Mobile Development', 2019, 'September'),
(16, 'MMCD', 'Multimedia and Commercial Deisgn ', 2021, 'May'),
(18, 'SEMD', 'Sofware Engineering and Mobile Development', 2022, 'September');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `No` int(200) NOT NULL,
  `studentID` varchar(200) NOT NULL,
  `studentName` varchar(200) NOT NULL,
  `studentUid` varchar(200) NOT NULL,
  `studentEmail` varchar(200) NOT NULL,
  `studentCourse` varchar(200) NOT NULL,
  `studentYear` int(4) NOT NULL,
  `studentMonth` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`No`, `studentID`, `studentName`, `studentUid`, `studentEmail`, `studentCourse`, `studentYear`, `studentMonth`) VALUES
(37, '1850001', 'Tee Fu Zhen', 'teefuzhen', 'teefuzhen@gmail.com', 'SEMD', 2018, 'May'),
(41, '1850005', 'Chai Yong Di', 'chaiyongdi', 'chaiyongdi@gmail.com', 'SEMD', 2018, 'May'),
(42, '1850006', 'Lee Zi Yu', 'leeziyu', 'leeziyu@gmail.com', 'SEMD', 2018, 'May'),
(46, '1850010', 'Cheah Wan Rou', 'cheahwanrou', 'cheahwanrou@gmail.com', 'SEMD', 2018, 'May'),
(38, '1890002', 'TEE JING HUI', 'teejinghui', 'teejinghui@gmail.com', 'SEMD', 2018, 'September'),
(43, '1890007', 'Lam Lee Fong', 'lamleefong', 'lamleefong@gmail.com', 'SEMD', 2018, 'September'),
(47, '1890011', 'Lee Zi Hao', 'leezihao', 'leezihao@gmail.com', 'SEMD', 2018, 'September'),
(40, '1990003', 'Oye Eng Wei', 'oyeengwei', 'oyeengwei@gmail.com', 'SEMD', 2019, 'September'),
(45, '1990009', 'Cheah Wan Yu', 'cheahwanyu', 'cheahwanyu@gmail.com', 'SEMD', 2019, 'September');

-- --------------------------------------------------------

--
-- Table structure for table `student_score`
--

CREATE TABLE `student_score` (
  `No` int(200) NOT NULL,
  `courseID` varchar(200) NOT NULL,
  `courseYear` int(4) NOT NULL,
  `courseMonth` varchar(200) NOT NULL,
  `studentID` varchar(200) NOT NULL,
  `studentName` varchar(200) NOT NULL,
  `subjectID` varchar(200) NOT NULL,
  `subjectName` varchar(200) NOT NULL,
  `subjectTotalScore` int(100) NOT NULL,
  `studentScore` int(100) NOT NULL,
  `studentGrade` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_score`
--

INSERT INTO `student_score` (`No`, `courseID`, `courseYear`, `courseMonth`, `studentID`, `studentName`, `subjectID`, `subjectName`, `subjectTotalScore`, `studentScore`, `studentGrade`) VALUES
(46, 'SEMD', 2018, 'May', '1850001', 'Tee Fu Zhen', 'SEMD002', 'Java Programing', 100, 80, 'A'),
(47, 'SEMD', 2018, 'May', '1850001', 'Tee Fu Zhen', 'SEMD003', 'C Sharp Programing', 80, 0, 'N/A'),
(52, 'SEMD', 2018, 'May', '1850005', 'Chai Yong Di', 'SEMD002', 'Java Programing', 100, 0, 'N/A'),
(53, 'SEMD', 2018, 'May', '1850005', 'Chai Yong Di', 'SEMD003', 'C Sharp Programing', 80, 0, 'N/A'),
(54, 'SEMD', 2018, 'May', '1850006', 'Lee Zi Yu', 'SEMD002', 'Java Programing', 100, 0, 'N/A'),
(55, 'SEMD', 2018, 'May', '1850006', 'Lee Zi Yu', 'SEMD003', 'C Sharp Programing', 80, 0, 'N/A'),
(60, 'SEMD', 2018, 'May', '1850010', 'Cheah Wan Rou', 'SEMD002', 'Java Programing', 100, 0, 'N/A'),
(61, 'SEMD', 2018, 'May', '1850010', 'Cheah Wan Rou', 'SEMD003', 'C Sharp Programing', 80, 0, 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `No` int(200) NOT NULL,
  `courseID` varchar(200) NOT NULL,
  `subjectID` varchar(200) NOT NULL,
  `subjectName` varchar(200) NOT NULL,
  `subjectYear` int(4) NOT NULL,
  `subjectMonth` varchar(20) NOT NULL,
  `subjectTotalScore` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`No`, `courseID`, `subjectID`, `subjectName`, `subjectYear`, `subjectMonth`, `subjectTotalScore`) VALUES
(19, 'SEMD', 'SEMD002', 'Java Programing', 2018, 'May', 100),
(20, 'SEMD', 'SEMD003', 'C Sharp Programing', 2018, 'May', 80),
(25, 'SEMD', 'SEMD002', 'Java Programing', 2018, 'September', 50),
(28, 'SEMD', 'SEMD789', 'Introduction to Programming', 2022, 'September', 100);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `No` int(200) NOT NULL,
  `teacherID` varchar(200) NOT NULL,
  `teacherName` varchar(200) NOT NULL,
  `teacherUid` varchar(200) NOT NULL,
  `teacherEmail` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`No`, `teacherID`, `teacherName`, `teacherUid`, `teacherEmail`) VALUES
(5, 'TEAC0000', 'teacher', 'teacher', 'teacher@gmail.com'),
(1, 'TEAC0001', 'Ng Wai Kong', 'ngwaikong0001', 'ngwaikong0001@gmail.com'),
(3, 'TEAC0003', 'qwer', 'qwer', 'qwer@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subject`
--

CREATE TABLE `teacher_subject` (
  `No` int(200) NOT NULL,
  `teacherID` varchar(200) NOT NULL,
  `teacherUid` varchar(200) NOT NULL,
  `teacherName` varchar(200) NOT NULL,
  `teacherSubject` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_subject`
--

INSERT INTO `teacher_subject` (`No`, `teacherID`, `teacherUid`, `teacherName`, `teacherSubject`) VALUES
(39, 'TEAC0001', 'ngwaikong0001', 'Ng Wai Kong', 'SEMD002 Java Programing 2018 May'),
(48, 'TEAC0003', 'qwer', 'qwer', 'SEMD003 C Sharp Programing 2018 May');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `No` int(200) NOT NULL,
  `userID` varchar(200) NOT NULL,
  `userUid` varchar(200) NOT NULL,
  `userName` varchar(200) NOT NULL,
  `userEmail` varchar(200) NOT NULL,
  `userPassword` varchar(200) NOT NULL,
  `userType` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`No`, `userID`, `userUid`, `userName`, `userEmail`, `userPassword`, `userType`) VALUES
(43, '0050111', 'xcvb', 'xcvb', 'xcvb@gmail.com', '$2y$10$1ZzQerMx8NwWtFEbSLC0A.AlZgx2ab1kQniEoRHwa.5gUe.Zrq3GO', 'student'),
(47, '0050258', 'vbnm', 'vbnm', 'vbmn@gmail.com', '$2y$10$PgQx6ITBNVmtHwdrxWQndex/9Bqt7H22wuxzm4WDkxvnsqB51hMcq', 'student'),
(51, '1850001', 'teefuzhen', 'Tee Fu Zhen', 'teefuzhen@gmail.com', '$2y$10$qaauUXCIBNdY4lxLs73Ol.bh4XUPJrmWsEGcXgqI43ZyqCorSO9Ye', 'student'),
(56, '1850005', 'chaiyongdi', 'Chai Yong Di', 'chaiyongdi@gmail.com', '$2y$10$JK/uou17J7vLy2pj565DzOchqMdp.hojoaV3GKuUhyk0pGqoLqv0m', 'student'),
(57, '1850006', 'leeziyu', 'Lee Zi Yu', 'leeziyu@gmail.com', '$2y$10$JmnKbMb.6/YYKqbxfrUuS.WTa/idx9shhTtj3yjymnVwTfiaI9kCq', 'student'),
(24, '1850009', 'zxvc', 'zxcv', 'zxcv@gmail.com', '$2y$10$XrPA5zwEdDKGPkXVbGAHpuNWz4VzQnahf9XMmZpeSl2t/hQgjfksW', 'student'),
(61, '1850010', 'cheahwanrou', 'Cheah Wan Rou', 'cheahwanrou@gmail.com', '$2y$10$br858Aru7M6d7NbShvLAoOMfSf1FLm5.Z9xp33e8etXpKZmIrd.pS', 'student'),
(52, '1890002', 'teejinghui', 'TEE JING HUI', 'teejinghui@gmail.com', '$2y$10$uA2kTKwvMmO6xvKTr1h0V.5S1gOoGiR/xIk6TBLvTSa7JPeo79F0u', 'student'),
(58, '1890007', 'lamleefong', 'Lam Lee Fong', 'lamleefong@gmail.com', '$2y$10$D5hX1N3iz5y/VkydHChbjexLKXZPpYSD1WU0jo.3P0xHvZ.XtC/Nu', 'student'),
(62, '1890011', 'leezihao', 'Lee Zi Hao', 'leezihao@gmail.com', '$2y$10$kF75E9p2yyAOegYAkFr7MeL3W1iGRDp3k2N1C.HPwxVubYHWo3wny', 'student'),
(53, '1950000', 'student', 'student', 'student@gmail.com', '$2y$10$tem9jqEcj8GrnPWBOrfQ4OmcryX.YfrFyPUlWbK1GU9huDFx2lury', 'student'),
(59, '1950008', 'lamlaiwan', 'Lam Lai Wan', 'lamlaiwan@gmail.com', '$2y$10$BoCcdteWYeiUHjEsy4tvTOcEA2RuUpQUvYXE9lV0axZbigdHiXxx.', 'student'),
(65, '1950369', 'quinnwong', 'Quinn Wong', 'quinnwong@gmail.com', '$2y$10$R7vIJq4R7DrU90GqCHJX7eInM7DC4eDG37uuW459XO70vVW8Llh2e', 'student'),
(55, '1990003', 'oyeengwei', 'Oye Eng Wei', 'oyeengwei@gmail.com', '$2y$10$PasVeUvOvA.oOnj/pqD73uXTUAwwJyiHhMGLuC4YFgmvO9abXIDvm', 'student'),
(60, '1990009', 'cheahwanyu', 'Cheah Wan Yu', 'cheahwanyu@gmail.com', '$2y$10$EXkyr4O/Y3hbQww6.IM81O5yn4JZ5A755fmILQuhMgm2OjHrvzBki', 'student'),
(49, '2016995', 'erty', 'erty', 'erty@gmail.com', '$2y$10$jKutgbMyNhOJIa3/B/1Qm.R3muw3r6RMH6IlEDOUT93V3AzZH.2Gu', 'student'),
(6, '6995', 'admin1234', 'admin1234', 'admin1234@gmail.com', '$2y$10$xlrbsDP.UlvYKsIY5RNl3e58GiQLyZmFgzrbWdOKtV9utE5E8l7Xu', 'admin'),
(50, 'admin', 'admin', 'admin', 'admin@gmail.com', '$2y$10$aQPy3y1JilexSFI1w6whiO/NJ2DtQVbl9J1iALNp8nkSVodISQn3q', 'admin'),
(54, 'TEAC0000', 'teacher', 'teacher', 'teacher@gmail.com', '$2y$10$OoMbOAb/JMobg5TkSNtwJO/F0y.OFklZa4KYr8feBe2mTMhS3cCfO', 'teacher'),
(8, 'TEAC0001', 'ngwaikong0001', 'Ng Wai Kong', 'ngwaikong0001@gmail.com', '$2y$10$95UltAbo0r9PKnY1XjSvxu3dxb3Uu/gKMrj09JrDaJJgOUJrzWU56', 'teacher'),
(15, 'TEAC0003', 'qwer', 'qwer', 'qwer@gmail.com', '$2y$10$SMAsClfbN9Vm4oyo/lcBSu89.1OPxFCDtCGm32HKSqrgcOTeMq7x6', 'teacher');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`),
  ADD UNIQUE KEY `No` (`No`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD UNIQUE KEY `No` (`No`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`),
  ADD UNIQUE KEY `No` (`No`);

--
-- Indexes for table `student_score`
--
ALTER TABLE `student_score`
  ADD PRIMARY KEY (`No`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`No`),
  ADD UNIQUE KEY `No` (`No`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacherID`),
  ADD UNIQUE KEY `No` (`No`);

--
-- Indexes for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
  ADD PRIMARY KEY (`No`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `No` (`No`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `No` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `No` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `No` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `student_score`
--
ALTER TABLE `student_score`
  MODIFY `No` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `No` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `No` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
  MODIFY `No` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `No` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
