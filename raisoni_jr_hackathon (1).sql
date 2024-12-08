-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2024 at 08:20 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
-- Table structure for table `all_team_members`
--

CREATE TABLE `all_team_members` (
  `id` int(11) NOT NULL,
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

INSERT INTO `all_team_members` (`id`, `mentor`, `name`, `email`, `phone`, `team_name`, `ps`, `is_leader`, `date`) VALUES
(48, 'abdulrahim74264@gmail.com', 'Shadman Hayat', 'shadmanhayat@gmail.com', '9876542310', 'GHRCACS', 'RJH03', 1, '2024-10-29 08:35:04'),
(49, 'abdulrahim74264@gmail.com', 'Awais Ansari', 'awais@gmail.com', '4568791230', 'GHRCACS', 'RJH03', 0, '2024-10-29 08:35:04'),
(50, 'shadmanhayat9992@gmail.com', 'Awais Aman', 'awais@gmail.com', '9876543210', 'ShadTech', 'RJH02', 1, '2024-11-21 18:50:17'),
(51, 'shadmanhayat9992@gmail.com', 'Mohammad Danish', 'danis@gmail.com', '9876542310', 'ShadTech', 'RJH02', 0, '2024-11-21 18:50:17');

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
  `no_of_teams` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mentor_details`
--

INSERT INTO `mentor_details` (`id`, `email`, `first_name`, `last_name`, `mobile`, `college`, `role`, `password`, `no_of_teams`, `image_name`, `image_path`) VALUES
(7, 'abdulrahim74264@gmail.com', 'ABDUL', 'RAHIM', 2147483647, 'Edify School, Kamptee Road', 'Mentor', '$2y$10$Gzyzx4lTyAxNgw8yj4tZ/exS7Lg8XU48OcTsOGcjzsJP6LvOYdIde', 1, '67208bc8d59d82.66886741.png', 'uploads/images/67208bc8d59d82.66886741.png'),
(8, 'abdul.ejazahmad.bca@ghrccst.raisoni.net', 'ABDUL', 'RAHIM', 2147483647, 'Anjuman College, Sadar', 'Mentor', '$2y$10$rCVbnv6PcMjxTFZiAxLERegdvPJCEk4DSup4OHUv1SyRfELnTsI7W', 0, '', ''),
(9, 'shadmanhayat9992@gmail.com', 'Shadman', 'Hayat', 2147483647, 'Delhi Public School, Kamptee Road', 'Mentor', '$2y$10$Vfmp6eBwbom6eyq7IoEDO.pBjiJ3MPP9VIB7RpVh2V.LZcE/besue', 1, '673f8090012ef1.48174948.jpg', 'uploads/images/673f8090012ef1.48174948.jpg');

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
(2, 'Please fill the form carefully', '2024-10-29 10:26:40', 1);

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
  `no_of_participation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `problem_statements`
--

INSERT INTO `problem_statements` (`id`, `ps_id`, `ps_name`, `ps_category`, `ps_description`, `ps_difficulty_level`, `no_of_participation`) VALUES
(1, 'RJH01', 'Career Path Navigator', 'Education / Career Guidance', '<p>Choosing the right career is one of the most critical and confusing decisions students face. With a vast number of career paths available today—ranging from technical fields to creative arts—students often lack clarity and direction, leading to indecision, misinformed choices, or following career paths due to societal pressure. This can result in dissatisfaction, lack of motivation, or the need to switch careers later in life.</p>\n<p>Your task is to develop a \"Career Path Navigator\", a solution that helps students, especially from high school (11th and 12th graders) and first-year college students, identify the right career path based on their strengths, interests, skills, and personality. The system should guide students through a structured roadmap to discover their ideal career, provide relevant resources, and offer insights on education, skills, and internships.</p>', 'Medium', 0),
(2, 'RJH02', 'Event Connect: Bridging Opportunities for Students', 'Education / Student Engagement', '<p> There are numerous events, competitions, workshops, and webinars organized by different educational institutions, NGOs, and companies that aim to help students learn and grow. These events provide valuable opportunities for skill development, networking, and personal growth, especially for junior college students (11th and 12th graders). However, many students miss out on these opportunities due to lack of proper advertisement, awareness, or access to information. The challenge lies in creating a centralized system that keeps students informed about relevant events and makes it easy for them to participate.\n<p> Your task is to develop \"Event Connect\", a platform that ensures that students, especially those in junior college, can discover, explore, and participate in educational events. The platform should be an easy-to-use, centralized hub that aggregates information about events happening around them.\n', 'Medium', 0),
(5, 'RJH03', 'Healthy Pocket: Smart Budgeting and Nutrition for Students', 'Health & Wellness / Financial Literacy', '<p> Many students, especially those who receive pocket money, tend to spend their funds on unhealthy food options like junk food, sugary drinks, and fast food. Due to a lack of awareness about healthy eating and budget-friendly options, this habit leads to poor nutrition, weight gain, and health issues such as obesity, fatigue, and even long-term illnesses. The challenge is to help students make smarter financial and dietary decisions by guiding them toward healthy, affordable food choices.\n<p> Your task is to design \"Healthy Pocket\", a solution that helps students manage their pocket money while promoting healthier eating habits. The platform should offer personalized budgeting tips, healthy food alternatives, and nutritional information that encourages students to prioritize their well-being without exceeding their budget.', 'Medium', 0),
(6, 'RJH04', 'FitLife: Overcoming Mobile Addiction with Exercise Awareness', 'Health & Wellness / Technology Impact', '<p> In today\'s digital world, mobile phones play a significant role in the lives of young people, often leading to sedentary lifestyles, reduced physical activity, and various health issues like obesity, poor posture, eye strain, and mental fatigue. The overuse of mobile devices among youngsters can lead to an addiction that negatively affects both their physical and mental well-being. However, through gym awareness, exercise routines, and healthy lifestyle education, this problem can be addressed effectively.\n<p> Your task is to develop \"FitLife\", a platform that raises awareness about the negative health impacts of excessive mobile phone usage while promoting a healthier lifestyle through gym exercises, home workouts, and exercise routines. The goal is to help students and young people integrate physical activity into their daily routine, reducing their dependence on mobile devices and improving overall well-being.', 'Medium', 0),
(7, 'RJH05', 'Think Before You Like: Shaping Positive Online Behavior', 'Social Awareness & Ethical Responsibility', '<p> With the rise of social media platforms, many students are exposed to content that promotes negative stereotypes, objectification of women, casteism, racism, religious intolerance, and body shaming. This has led to a normalization of these harmful attitudes, affecting the mentality of students and perpetuating biases against various groups based on gender, caste, religion, and color. The problem is further worsened by the fact that students often engage with such posts by liking, sharing, or commenting, without understanding the long-term consequences on societal thinking and their own perspectives.\n<p> Your challenge is to develop \"Think Before You Like\", a solution aimed at raising awareness among students about the consequences of engaging with harmful content on social media. The platform should educate them on how their online behavior can shape their mindset, reinforce stereotypes, and promote unhealthy societal norms. It should also guide them toward more responsible and ethical online engagement, encouraging the appreciation of content that promotes respect, equality, and inclusivity.', 'Hard', 0),
(8, 'RJH06', 'Ensuring Women\'s Safety in the Modern Era', 'Safety & Security', '<p> In today\'s world, ensuring the safety and security of women is a critical issue that cannot be overlooked. Despite technological advancements, women face daily challenges, including harassment, stalking, and unsafe environments, both in physical spaces and online. The problem is multifaceted, involving social, cultural, and structural factors. With the rise of urbanization and digital connectivity, there is an increasing need for innovative solutions that can empower women to feel safe, secure, and confident in their surroundings.\n<p> Your task is to develop a Women’s Safety Platform that leverages technology, community support, and real-time safety solutions to address the unique challenges women face today. The platform should enable women to proactively protect themselves, connect with their community in times of need, and raise awareness about the importance of safety through education and empowerment.', 'Hard', 0),
(9, 'RJH07', 'Combatting the Influence of Betting, Trading, and Gambling Apps on Youngsters', 'Social Impact & Technology', '<p> In today\'s tech-driven world, numerous apps promote betting, trading, and gambling, enticing youngsters with the promise of quick money. These apps often lead to addiction, financial losses, and a host of mental health issues, such as anxiety and stress. The allure of making money easily has attracted many young people who are unaware of the long-term consequences. However, while some apps can be harmful, others promote financial literacy, responsible investing, and personal growth.\n<p> Your challenge is to develop a solution that helps young people identify harmful apps that promote risky behaviors like betting and gambling, and highlight useful apps that can contribute to their personal growth, such as financial management, health, education, or skill development. The solution should provide guidance, raise awareness, and empower young users to make informed decisions when downloading and using apps.', 'Medium', 0),
(10, 'RJH08', 'Beyond Degrees: Bridging the Gap for Freshers in the Job Market', 'Education & Employment', '<p> In today’s competitive job market, having a degree alone is often not enough for freshers to secure a job. Many companies prioritize candidates with hands-on experience, practical skills, or internships, leaving fresh graduates struggling to find entry-level opportunities. Despite earning degrees, freshers frequently encounter the harsh reality of “No Jobs Without Experience,” which can be demotivating and confusing.\n<p> Your challenge is to develop a solution that helps fresh graduates bridge the gap between education and employment by offering a roadmap for skill development, practical experience, and networking. The solution should empower students and freshers to build the necessary skills and find relevant opportunities before they graduate, ensuring they are job-ready when they enter the job market.', 'Medium', 0),
(11, 'RJH09', 'Bridging the Book Gap: A Marketplace for Students', 'Education & Social Impact', '<p> In the current educational landscape, students often face significant financial challenges, especially when it comes to purchasing books and educational materials. Under-resourced students may struggle to afford new textbooks, while affluent students often accumulate old books that go unused and take up space. This creates a disconnect between those who need resources and those who have them to spare.\n<p> Your challenge is to develop a platform that facilitates the exchange of used books among students, ensuring that every student has access to the educational materials they need without financial strain. The solution should empower students from all backgrounds to buy, sell, or exchange used books in a user-friendly and accessible manner.', 'Medium', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_team_members`
--
ALTER TABLE `all_team_members`
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
-- Indexes for table `problem_statements`
--
ALTER TABLE `problem_statements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ps_id` (`ps_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_team_members`
--
ALTER TABLE `all_team_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `mentor_details`
--
ALTER TABLE `mentor_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `problem_statements`
--
ALTER TABLE `problem_statements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
