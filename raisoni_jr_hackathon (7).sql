-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2025 at 01:10 PM
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
-- Database: `raisoni_jr_hackathon`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_details`
--

CREATE TABLE `admin_details` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `contact` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_details`
--

INSERT INTO `admin_details` (`id`, `username`, `password`, `contact`) VALUES
(1, 'admin@rjh', 'pass', '8275435110');

-- --------------------------------------------------------

--
-- Table structure for table `admin_rounds`
--

CREATE TABLE `admin_rounds` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `on_going` tinyint(1) NOT NULL,
  `isResultAnnounced` tinyint(1) NOT NULL,
  `resultDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_rounds`
--

INSERT INTO `admin_rounds` (`id`, `title`, `date`, `on_going`, `isResultAnnounced`, `resultDate`) VALUES
(1, 'Round 1', '2025-01-27 09:46:53', 0, 0, '2025-01-15 10:16:03'),
(2, 'Round 2', '2025-01-12 12:59:45', 0, 0, '2025-01-12 12:59:45');

-- --------------------------------------------------------

--
-- Table structure for table `all_team_members`
--

CREATE TABLE `all_team_members` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `mentor` varchar(200) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `team_name` varchar(100) NOT NULL,
  `ps` varchar(255) NOT NULL,
  `is_leader` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `all_team_members`
--

INSERT INTO `all_team_members` (`id`, `team_id`, `mentor`, `name`, `email`, `phone`, `team_name`, `ps`, `is_leader`, `date`) VALUES
(90, 28, 'abdulrahim74264@gmail.com', 'ABDUL RAHIM', 'abdulrahim74264@gmail.com', '8275435110', 'Al Nassr', 'RTH02', 1, '2024-12-14 18:06:39'),
(92, 28, 'abdulrahim74264@gmail.com', 'Shadman Hayat', 'shadmanhayat9992@gmail.com', '8007839942', '', '', 0, '2024-12-14 18:07:13');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `query` varchar(255) NOT NULL,
  `optional_message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `contact`, `query`, `optional_message`) VALUES
(1, 'Abdul Rahim', 'abdulrahim74264@gmail.com', '8275435110', 'login', 'I have completed my payment but login credentials not receieved');

-- --------------------------------------------------------

--
-- Table structure for table `eliminated_teams`
--

CREATE TABLE `eliminated_teams` (
  `id` int(11) NOT NULL,
  `teamId` int(11) NOT NULL,
  `teamName` varchar(255) NOT NULL,
  `leaderEmail` varchar(255) NOT NULL,
  `reasoneOfElimination` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guidelines`
--

CREATE TABLE `guidelines` (
  `id` int(11) NOT NULL,
  `guideline` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guidelines`
--

INSERT INTO `guidelines` (`id`, `guideline`) VALUES
(1, 'A team must have one female candidate'),
(3, 'here is an example of an guidelines');

-- --------------------------------------------------------

--
-- Table structure for table `leader_and_member_details`
--

CREATE TABLE `leader_and_member_details` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `leaderEmail` varchar(100) NOT NULL,
  `memberName` varchar(100) NOT NULL,
  `memberMobile` varchar(20) NOT NULL,
  `memberEmail` varchar(100) NOT NULL,
  `memberGender` varchar(20) NOT NULL,
  `teamName` varchar(100) NOT NULL,
  `psId` varchar(100) NOT NULL,
  `is_leader` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leader_and_member_details`
--

INSERT INTO `leader_and_member_details` (`id`, `team_id`, `leaderEmail`, `memberName`, `memberMobile`, `memberEmail`, `memberGender`, `teamName`, `psId`, `is_leader`) VALUES
(81, 38, 'abdulrahim74264@gmail.com', 'Awais Ansari', '9307543095', 'awaisansari06@gmail.com', 'Male', 'XTech', 'RTH02', 0),
(82, 38, 'abdulrahim74264@gmail.com', 'One Lady', '9998887775', 'ladies@gmail.com', 'Female', 'XTech', 'RTH02', 0),
(83, 38, 'abdulrahim74264@gmail.com', 'Abdul Rahim', '8275435110', 'abdulrahim74264@gmail.com', 'Male', 'XTech', 'RTH02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mentor_details`
--

CREATE TABLE `mentor_details` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `mobile` int(11) NOT NULL,
  `college` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `ps` varchar(100) NOT NULL,
  `no_of_teams` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mentor_details`
--

INSERT INTO `mentor_details` (`id`, `email`, `first_name`, `last_name`, `mobile`, `college`, `role`, `password`, `ps`, `no_of_teams`, `image_name`, `image_path`) VALUES
(28, 'abdulrahim74264@gmail.com', 'ABDUL', 'RAHIM', 2147483647, 'GH Raisoni College of Arts Commerce And Science', 'Mentor', '$2y$10$TunJG4t8ntS5QAU1FFzBuufXPxH26ksHfVrCaFG72gLk8aUbJf2l.', '', 0, '675dbef30c7a43.87788349.jpg', 'uploads/images/675dbef30c7a43.87788349.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `notification` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `new` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `notification`, `date`, `new`) VALUES
(1, 'Fill the form before 20/10/2024', '2024-10-29 10:24:11', 1),
(2, 'Please fill the form carefully', '2024-10-29 10:26:40', 1),
(3, 'Please register before 18 December', '2024-12-08 09:18:11', 1),
(11, 'Hackathon website is in development phase', '2024-12-18 19:05:46', 0),
(14, 'xyz\r\n', '2025-01-07 06:38:02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `transactionId` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  `pay_name` varchar(255) NOT NULL,
  `pay_path` varchar(255) NOT NULL,
  `is_approved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`id`, `team_id`, `transactionId`, `status`, `pay_name`, `pay_path`, `is_approved`) VALUES
(34, 38, 'T-123-145-168-778', 'Completed', '6794bee3f25b77.14634681.png', 'uploads/payments/6794bee3f25b77.14634681.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `problem_statements`
--

CREATE TABLE `problem_statements` (
  `id` int(11) NOT NULL,
  `ps_id` varchar(10) NOT NULL,
  `ps_name` varchar(100) NOT NULL,
  `ps_category` varchar(100) NOT NULL,
  `ps_description` mediumtext NOT NULL,
  `ps_difficulty_level` varchar(10) NOT NULL,
  `ps_given_by` varchar(100) NOT NULL,
  `no_of_participation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `problem_statements`
--

INSERT INTO `problem_statements` (`id`, `ps_id`, `ps_name`, `ps_category`, `ps_description`, `ps_difficulty_level`, `ps_given_by`, `no_of_participation`) VALUES
(1, 'RTH01', 'Career Path Navigator', 'Education / Career Guidance', '<p>Choosing the right career is one of the most critical and confusing decisions students face. With a vast number of career paths available today—ranging from technical fields to creative arts—students often lack clarity and direction, leading to indecision, misinformed choices, or following career paths due to societal pressure. This can result in dissatisfaction, lack of motivation, or the need to switch careers later in life.</p>\n<p>Your task is to develop a \"Career Path Navigator\", a solution that helps students, especially from high school (11th and 12th graders) and first-year college students, identify the right career path based on their strengths, interests, skills, and personality. The system should guide students through a structured roadmap to discover their ideal career, provide relevant resources, and offer insights on education, skills, and internships.</p>', 'Medium', '', 5),
(2, 'RTH02', 'Event Connect: Bridging Opportunities for Students', 'Education / Student Engagement', '<p> There are numerous events, competitions, workshops, and webinars organized by different educational institutions, NGOs, and companies that aim to help students learn and grow. These events provide valuable opportunities for skill development, networking, and personal growth, especially for junior college students (11th and 12th graders). However, many students miss out on these opportunities due to lack of proper advertisement, awareness, or access to information. The challenge lies in creating a centralized system that keeps students informed about relevant events and makes it easy for them to participate.\n<p> Your task is to develop \"Event Connect\", a platform that ensures that students, especially those in junior college, can discover, explore, and participate in educational events. The platform should be an easy-to-use, centralized hub that aggregates information about events happening around them.\n', 'Medium', '', 7),
(5, 'RTH03', 'Healthy Pocket: Smart Budgeting and Nutrition for Students', 'Health & Wellness / Financial Literacy', '<p> Many students, especially those who receive pocket money, tend to spend their funds on unhealthy food options like junk food, sugary drinks, and fast food. Due to a lack of awareness about healthy eating and budget-friendly options, this habit leads to poor nutrition, weight gain, and health issues such as obesity, fatigue, and even long-term illnesses. The challenge is to help students make smarter financial and dietary decisions by guiding them toward healthy, affordable food choices.\n<p> Your task is to design \"Healthy Pocket\", a solution that helps students manage their pocket money while promoting healthier eating habits. The platform should offer personalized budgeting tips, healthy food alternatives, and nutritional information that encourages students to prioritize their well-being without exceeding their budget.', 'Medium', '', 1),
(6, 'RTH04', 'FitLife: Overcoming Mobile Addiction with Exercise Awareness', 'Health & Wellness / Technology Impact', '<p> In today\'s digital world, mobile phones play a significant role in the lives of young people, often leading to sedentary lifestyles, reduced physical activity, and various health issues like obesity, poor posture, eye strain, and mental fatigue. The overuse of mobile devices among youngsters can lead to an addiction that negatively affects both their physical and mental well-being. However, through gym awareness, exercise routines, and healthy lifestyle education, this problem can be addressed effectively.\n<p> Your task is to develop \"FitLife\", a platform that raises awareness about the negative health impacts of excessive mobile phone usage while promoting a healthier lifestyle through gym exercises, home workouts, and exercise routines. The goal is to help students and young people integrate physical activity into their daily routine, reducing their dependence on mobile devices and improving overall well-being.', 'Medium', '', 0),
(8, 'RTH06', 'Ensuring Women\'s Safety in the Modern Era', 'Safety & Security', '<p> In today\'s world, ensuring the safety and security of women is a critical issue that cannot be overlooked. Despite technological advancements, women face daily challenges, including harassment, stalking, and unsafe environments, both in physical spaces and online. The problem is multifaceted, involving social, cultural, and structural factors. With the rise of urbanization and digital connectivity, there is an increasing need for innovative solutions that can empower women to feel safe, secure, and confident in their surroundings.\n<p> Your task is to develop a Women’s Safety Platform that leverages technology, community support, and real-time safety solutions to address the unique challenges women face today. The platform should enable women to proactively protect themselves, connect with their community in times of need, and raise awareness about the importance of safety through education and empowerment.', 'Hard', '', 0),
(24, 'RTH05', 'Student Innovation', 'Student Innovation', 'This category focuses on empowering students to tackle real-world challenges by fostering creativity, problem-solving, and critical thinking. It includes problem statements aimed at leveraging technology, innovative approaches, and collaborative tools to enhance the learning experience, improve student engagement, and drive impactful contributions to society. Solutions may address areas like education, sustainability, skill development, or community welfare, providing students with opportunities to innovate and make a difference.', 'None', 'G. H. Raisoni Skill Tech University', 0);

-- --------------------------------------------------------

--
-- Table structure for table `team_and_leader_details`
--

CREATE TABLE `team_and_leader_details` (
  `id` int(11) NOT NULL,
  `teamName` varchar(100) NOT NULL,
  `psId` varchar(20) NOT NULL,
  `leaderName` varchar(100) NOT NULL,
  `leaderMobile` varchar(20) NOT NULL,
  `leaderEmail` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `leaderGender` varchar(20) NOT NULL,
  `role` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `no_of_members` int(11) NOT NULL,
  `isEliminated` tinyint(1) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `image_path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_and_leader_details`
--

INSERT INTO `team_and_leader_details` (`id`, `teamName`, `psId`, `leaderName`, `leaderMobile`, `leaderEmail`, `password`, `leaderGender`, `role`, `date`, `no_of_members`, `isEliminated`, `image_name`, `image_path`) VALUES
(38, 'XTech', 'RTH02', 'Abdul Rahim', '8275435110', 'abdulrahim74264@gmail.com', '$2y$10$D91HTLan5uGEePX0x0vqAOBOB1ZrvA1gG6qrLLwGwC89HqtYOb/e.', 'Male', 'Team Leader', '2025-01-25 10:39:42', 2, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `team_idea_submissions`
--

CREATE TABLE `team_idea_submissions` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `leaderEmail` varchar(255) NOT NULL,
  `psId` varchar(20) NOT NULL,
  `psTitle` varchar(255) NOT NULL,
  `pptLink` varchar(255) NOT NULL,
  `docLink` varchar(255) NOT NULL,
  `solSummary` mediumtext NOT NULL,
  `isApproved` tinyint(1) NOT NULL,
  `isWinner` tinyint(1) NOT NULL,
  `rank` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_details`
--
ALTER TABLE `admin_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_rounds`
--
ALTER TABLE `admin_rounds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `all_team_members`
--
ALTER TABLE `all_team_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eliminated_teams`
--
ALTER TABLE `eliminated_teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guidelines`
--
ALTER TABLE `guidelines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leader_and_member_details`
--
ALTER TABLE `leader_and_member_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mentor_details`
--
ALTER TABLE `mentor_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`email`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `problem_statements`
--
ALTER TABLE `problem_statements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ps_id` (`ps_id`);

--
-- Indexes for table `team_and_leader_details`
--
ALTER TABLE `team_and_leader_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_idea_submissions`
--
ALTER TABLE `team_idea_submissions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_details`
--
ALTER TABLE `admin_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_rounds`
--
ALTER TABLE `admin_rounds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `all_team_members`
--
ALTER TABLE `all_team_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `eliminated_teams`
--
ALTER TABLE `eliminated_teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `guidelines`
--
ALTER TABLE `guidelines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leader_and_member_details`
--
ALTER TABLE `leader_and_member_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `mentor_details`
--
ALTER TABLE `mentor_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `problem_statements`
--
ALTER TABLE `problem_statements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `team_and_leader_details`
--
ALTER TABLE `team_and_leader_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `team_idea_submissions`
--
ALTER TABLE `team_idea_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
