-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2017 at 12:38 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `job_date` date NOT NULL,
  `budget` varchar(100) NOT NULL,
  `skills` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `user_id`, `name`, `location`, `job_date`, `budget`, `skills`, `details`, `status`) VALUES
(1, 3, 'PHP Developers', 'lahore', '2017-05-30', '40000', 'PHP, JavaScript, Jquery, Laravel ', 'Need PHP developers from 1 to 5 years experience on urgent basis. Part time developers can also contact. Codeigniter and wordpress experience will be plus. \r\n\r\nCandidates willing to work from home can also contact.', 1),
(2, 3, 'Java Developer', 'karachi', '2017-05-27', '80000', 'Bootstrap, Angular Js, J2EE, Java', 'Responsible for programming and software development using various programming languages and related tools and frameworks, reviewing code written by other programmers, requirement gathering, bug fixing, testing, documenting and implementing software systems.\r\n\r\nExperienced programmers are also responsible for interpreting architecture and design, code reviews, mentoring, guiding and monitoring programmers, ensuring adherence to programming and documentation policies, software development, testing and release.', 1),
(3, 3, 'Marketing Head', 'gujranwala', '2017-06-16', '120000', 'Data Analysis, Self Motivated, Research, Creativity, Digital Marketing, Script Writing, Social Media Management, Strong Written English, Google Addwords, Time and Team Management', 'MeriPolicy is an e-commerce start up that will play the role of an independent insurance agent in the personal lines or retail sector which includes products like car, health, life, home, travel insurance etc. \r\n\r\nDue to Low awareness, primarily, the insurance penetration in Pakistan is one of the lowest in the region. We want to challenge that, therefore, the importance of this position is very high. \r\n\r\nThe role of the marketing head will be split in 2 main areas.\r\n\r\ni) Create Awareness and Understanding \r\n\r\n- Do background research and work closely with CEO to develop understanding of key insurance concepts.\r\n\r\n- Develop Scripts for explainer videos to be placed on website and social media\r\n\r\n- Work with in house animation expert to develop animations\r\n\r\n- Manage voice over with studios \r\n\r\n- Develop plan to propogate material developed in the masses\r\n\r\n- Explore other strategies for mass awareness \r\n\r\nii) Digital Marketing of our Brand\r\n\r\nAll of our marketing budget in Year 1 will be spent in the digital arena. \r\n\r\n- Background research \r\n\r\n- Develop marketing material with in house graphic designer\r\n\r\n- Manage Social Media Page(s)\r\n\r\n- Work with Marketing Agency (or otherwise) to develop Media buying strategy and budget\r\n\r\n- Work with other third parties to secure articles to be placed on website \r\n\r\nPlease note this is not an all exclusive list, the Marketing Head may be required to support in all marketing related activities. We initially intend to Hire only 1 resource for marketing, however, this may be increased to 2 to 3 members once we secure sales. ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `job_cv`
--

CREATE TABLE `job_cv` (
  `id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `last_edu` varchar(150) NOT NULL,
  `skills` varchar(255) NOT NULL,
  `experience` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_cv`
--

INSERT INTO `job_cv` (`id`, `user_id`, `last_edu`, `skills`, `experience`) VALUES
(1, 2, 'MSc ', 'Alogrithm, PHP, Java, Data Mining, Date Science ', '1) Work in Government Sector \r\n2) Awesome Rank in Linkdin \r\n3) Custom Application Development ');

-- --------------------------------------------------------

--
-- Table structure for table `seeker_jobs`
--

CREATE TABLE `seeker_jobs` (
  `id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `job_id` int(20) NOT NULL,
  `rank` int(20) NOT NULL DEFAULT '0',
  `emp_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seeker_jobs`
--

INSERT INTO `seeker_jobs` (`id`, `user_id`, `job_id`, `rank`, `emp_id`) VALUES
(1, 2, 1, 3, 3),
(2, 2, 2, 0, 3),
(3, 2, 3, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `name` varchar(90) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `dob` date NOT NULL,
  `gender` varchar(60) NOT NULL,
  `location` varchar(100) NOT NULL,
  `functional_area` varchar(100) NOT NULL,
  `role` varchar(60) NOT NULL,
  `reg_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `contact`, `image`, `dob`, `gender`, `location`, `functional_area`, `role`, `reg_date`) VALUES
(1, 'Admin', 'admin@yahoo.com', 'admin', '03104455209', '3cc621261ec71aea804b1f5631729ef0.jpg', '1992-02-05', 'men', 'gujranwala', 'teaching', 'admin', '2017-05-24 18:02:26'),
(2, 'Job Seeker', 'jobseeker@yahoo.com', 'jobseeker', '03104455209', 'fancy.jpg', '1994-05-25', 'women', 'karachi', 'teaching', 'job seeker', '2017-05-24 21:29:20'),
(3, 'Employers', 'employer@yahoo.com', 'employer', '03104455209', '18010606_295449344218281_4311407994935238484_n.jpg', '1992-02-05', 'men', 'gujranwala', 'business', 'employeer', '2017-05-24 21:53:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_cv`
--
ALTER TABLE `job_cv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seeker_jobs`
--
ALTER TABLE `seeker_jobs`
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
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `job_cv`
--
ALTER TABLE `job_cv`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `seeker_jobs`
--
ALTER TABLE `seeker_jobs`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
