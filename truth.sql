-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2017 at 04:32 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `truth`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentID` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `comment_writer` varchar(255) NOT NULL,
  `comment_body` text NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `accepted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentID`, `news_id`, `comment_writer`, `comment_body`, `comment_date`, `accepted`) VALUES
(12, 13, 'عصام', 'خبر جيد شكراً على النشر ', '2016-04-16 19:51:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `newsID` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `news_title` varchar(255) NOT NULL,
  `news_body` text NOT NULL,
  `news_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `news_writer` varchar(255) NOT NULL,
  `news_banner` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`newsID`, `section_id`, `news_title`, `news_body`, `news_date`, `news_writer`, `news_banner`) VALUES
(9, 4, 'الخبر التجريبي التجريبي', '<h5 style=\"margin: 0px; padding: 0px; border: 0px; font-family: tahoma; font-size: 11px; font-weight: normal; color: #76655d; line-height: 16.5px; text-align: right;\"><span style=\"font-size: small;\"><br />السؤال غامض بعض الشيء، فأنت تقولين: فقرات القفص الصدري الأيمن، والفقرات هي من الخلف وليس هناك فقرات يمنى ويسرى، وإنما هي فقرات على صف واحد، وألمها يكون في الوسط؛ فإن كان الألم ليس في الوسط من الخلف في منطقة القفص الصدري، فقد يكون من العضلات، أو يكون من المفاصل التي تصل الفقرات بالأضلاع، وتسمى المفاصل الضلعية الفقراتية.&nbsp;<br />الآلام في هذه المنطقة معظمها تكون من العضلات التي تصل لوح الكتف مع العمود الفقري، ويمكن أن تأتي وتذهب، وقد تزيد مع البرودة، ومع الحركة، وأخذ النفس، وحركة الصدر، وهذه تحتاج لأخذ وضعية مستوية، وتجنب الجلوس غير الصحيح، والمساج للعضلات.&nbsp;<br />أما إن كان الألم في المنطقة القريبة من الوسط من الخلف؛ فقد يكون السبب هو مشاكل في المفاصل التي تصل الأضلاع بالفقرات، وهذه تحتاج للعلاج الطبيعي، والمسكنات.<br /><br /></span></h5>', '2016-04-16 11:09:33', 'إيسو', '57121d6dde080Penguins.jpg'),
(10, 4, 'رسمياً .. حل مجلس إدارة غزل المحلة', '<p style=\"direction: rtl;\"><span style=\"font-family: Tahoma; font-size: 12px;\">قرر حمزة أبو الفتح رئيس نادى غزل المحلة حل مجلس إدارة النادى، بعد المذكرة التى قدمها لمديرية الشباب والرياضة بمحافظة الغربية والتى تضمنت موافقة الدكتور أحمد مصطفى رئيس شركة الغزل والنسيج التابع لها نادى غزل المحلة على قرار الحل. يذكر أن عدد من أعضاء النادى تقدموا باستقالتهم من المجلس بداية الشهر ورفضها المهندس حمزة أبو الفتح رئيس النادى .</span><br style=\"font-family: Tahoma; font-size: 12px;\" /><br style=\"font-family: Tahoma; font-size: 12px;\" /></p>', '2016-04-16 19:24:46', 'admin', '5712917eee3b51-788776.jpg'),
(11, 4, 'منتخب ناشئات اليد يحتل المركز الخامس فى كأس البحر المتوسط', '<p style=\"direction: rtl;\"><span style=\"font-family: Tahoma; font-size: 12px;\">احتل منتخب ناشئات كرة اليد مواليد 2000 المركز الخامس فى بطولة البحر الأبيض المتوسط بعد الفوز على تونس فى مباريات تحديد المراكز بنتيجة 28 / 15 . كانت ناشئات الفراعنة قد فازن على كلا من تونس ومونتنيجرو وإيطاليا فيما خسرن من فرنسا وتركيا وصربيا فى الدور الأول .</span></p>', '2016-04-16 19:27:34', 'admin', '57129226643051-788776.jpg'),
(12, 3, 'انقلاب سيارة محملة بأسطوانات غاز دون إصابات غرب الإسكندرية ', '<p style=\"direction: rtl;\"><span style=\"font-family: Tahoma; font-size: 12px;\">تسبب انقلاب سيارة محملة بأسطوانات الغاز، بمنطقة مرغم، غرب الإسكندرية، فى تعطيل حركة المرور، دون حدوث إصابات. تلقى اللواء نادر جنيدى، مساعد وزير الداخلية لأمن الإسكندرية، بلاغًا يفيد بانقلاب السيارة محملة بأسطوانات الغاز. وانتقلت إدارة الحماية المدنية برئاسة اللواء عمرو جاب الله، يفيد بانقلاب السيارة بالطريق المشار إليه، وتم رفع السيارة، وإعادة حركة المرور .&nbsp;</span></p>', '2016-04-16 19:29:15', 'admin', '5712928b9535a1-788776.jpg'),
(13, 2, 'النائب إيهاب الطماوى: زيارة رئيس فرنسا لمصر تؤكد على دورها الريادى بالمنطقة', '<p style=\"direction: rtl;\"><span style=\"font-family: Tahoma; font-size: 12px;\">قال إيهاب الطماوى عضو مجلس النواب عن حزب المصريين الأحرار، إن زيارة الرئيس الفرنسى فرانسو هولاند لمصر تؤكد تمييز العلاقة الإستراتيجية والروابط الثقافية بين البلدين، كما تؤكد على دور مصر الريادى بالشرق الأوسط ودول حوض البحر المتوسط. وأضاف الطماوى فى بيان له منذ قليل كما أنها تدلل على أن شراكة مصر وفرنسا ليست فقط لانتماء مصر للفرانكوفونية، بل لكون مصر شريك أساسى فى الحرب ضد الإرهاب الذى يهدد دول العالم. وأشار عضو مجلس النواب عن حزب المصريين الأحرار إلى أن من ضمن دلالات الزيارة ثقة فرنسا قيادة وشعبا فى القيادة المصرية، ودليل على دعم فرنسا لمصر حكومة وشعبا فى حربها الشرسة ضد الإرهاب الأسود وقوى الشر.</span></p>', '2016-04-16 19:33:20', 'admin', '5712938039e621-788776.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `sectionID` int(11) NOT NULL,
  `section_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`sectionID`, `section_name`) VALUES
(1, 'اقتصاد'),
(2, 'سياسة'),
(3, 'حوادث'),
(4, 'رياضة');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `groupID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `email`, `fullname`, `groupID`) VALUES
(5, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@truth.com', 'essam saber', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsID`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`sectionID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `newsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `sectionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
