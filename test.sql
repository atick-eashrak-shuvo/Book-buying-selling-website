-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2020 at 05:19 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(10) NOT NULL,
  `book_name` varchar(30) NOT NULL,
  `author` varchar(30) NOT NULL,
  `category` varchar(30) NOT NULL,
  `summary` varchar(1000) NOT NULL,
  `cover_photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_name`, `author`, `category`, `summary`, `cover_photo`) VALUES
(1, 'The Lord of the Rings Vol 1', 'J.R.R. Tolkien', '', 'THE BOOK OF THE CENTURY The Fellowship of the Ring is the first volume in J.R.R. Tolkiens epic adventure The Lord of the Rings . In a sleepy village in the Shire, a young hobbit is entrusted with an immense task. He must make a perilous journey across Middle-earth to the Crack of Doom, there to destroy the Ruling Ring of Power - the only thing that prevents the Dark Lords e THE BOOK OF THE CENTURY The Fellowship of the Ring is the first volume in J.R.R. Tolkiens epic adventure The Lord of the Rings . In a sleepy village in the Shire, a young hobbit is entrusted with an immense task. He must make a perilous journey across Middle-earth to the Crack of Doom, there to destroy the Ruling Ring of Power - the only thing that prevents the Dark Lords evil dominion. ~from the back cover ', 'resource\\book_cover\\9780007123827.jpg'),
(2, 'Fault in Our Stars', 'John Green', 'classics', 'The film tie-in edition of John Green\'s witty yet heart-breaking tour de force. This edition of the multi-million #1 bestseller contains images from the major motion picture starring Shailene Woodley and Ansel Elgort. \"I fell in love the way you fall asleep: slowly, then all at once.\" Despite the tumor-shrinking medical miracle that has bought her a few years, Hazel has never been anything but terminal, her final chapter inscribed upon diagnosis. But when a gorgeous plot twist named Augustus Waters suddenly appears at Cancer Kid Support Group, Hazel\'s story is about to be completely rewritten. Insightful, bold, irreverent, and raw, The Fault in Our Stars is award-winning author John Green\'s most ambitious and heartbreaking work yet, brilliantly exploring the funny, thrilling, and tragic business of being alive and in love. Sunday Times (Culture) \'A touching, often fiercely funny novel\' The Sun on Sunday (Fabulous Magazine) \'So good I think it should be compulsory reading for everyone!\'', 'resource\\book_cover\\9780147513731.jpg'),
(3, 'Twilight', 'Stephenie Meyer', 'Romance', 'Twilight is a vampire romance novel aimed at young adult readers. It is the first novel in Stephenie Meyerâ??s Twilight series. It presents the story of Isabella Swan, or Bella as she is called. The story is presented from Bellaâ??s perspective. Bella is a shy and mature seventeen-year-old who leaves Phoenix, Arizona, to move in with her father Charlie in Forks, Washington. She joins Forks High School, where she quickly becomes the center of attention, especially among the boys. On the first day of school, she finds herself seated adjacent to Edward Cullen, who somehow seems to take an instant dislike to her. Edward then disappears for a few days. Surprisingly, upon his return, he becomes quite friendly towards Bella. Bella intuitively knows that there is more to Edward than what meets the eye. Moreover, his abnormal abilities, unusual physical features and strange behavior fuel her curiosity further. One day, Edward saves Bellaâ??s life in a mysterious way. This makes her even more de', 'resource\\book_cover\\9781904233657.jpg'),
(48, 'Wuthering Heights', 'Emily BrontÃƒÂ«, John S. Whitl', 'classics', 'Set on the stormy moors of northern England, this classic novel is filled with the cruel and ecstatic love between the characters Heathcliff and Catherine. As they grow together as children and later as lovers, the conflicts of class and an all-consuming passion overwhelm the inhabitants of Wuthering Heights. The all-star cast of performers includes Claire Bloom and James Set on the stormy moors of northern England, this classic novel is filled with the cruel and ecstatic love between the characters Heathcliff and Catherine. As they grow together as children and later as lovers, the conflicts of class and an all-consuming passion overwhelm the inhabitants of Wuthering Heights. The all-star cast of performers includes Claire Bloom and James Mason as the doomed lovers.', 'resource/book_cover/04031232399781853260018.jpg'),
(54, 'East of the Sun', ' Julia Gregson', 'classics', 'Autumn 1928. The Kaiser-i-Hind is en route to Bombay. In Cabin D38, Viva Hollowat, an inexperienced chaperone, is worried shes made a terrible mistake. Her advert in The Lady has resulted in three unsettling charges to be escorted to India. Rose, a beautiful, dangerously naive English girl, is about to be married to the cavalry officer she has met only a handful of times. V Autumn 1928. The Kaiser-i-Hind is en route to Bombay. In Cabin D38, Viva Hollowat, an inexperienced chaperone, is worried shes made a terrible mistake. Her advert in The Lady has resulted in three unsettling charges to be escorted to India. Rose, a beautiful, dangerously naive English girl, is about to be married to the cavalry officer she has met only a handful of times. Victoria, the bridesmaid, is determined to lose her virginity on the journey before finding a husband of her own in India. And overshadowing all three of them, the malevolent presence of Guy Glover, a strange and disturbed schoolboy. Three potentia', 'resource/book_cover/0518064816Capture.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `book_ad`
--

CREATE TABLE `book_ad` (
  `book_id` int(11) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `book_condition_status` varchar(5) NOT NULL,
  `discount` decimal(10,0) NOT NULL DEFAULT '0',
  `quantity` int(3) NOT NULL,
  `price` int(4) NOT NULL,
  `location` varchar(255) NOT NULL,
  `ad_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_ad`
--

INSERT INTO `book_ad` (`book_id`, `user_name`, `book_condition_status`, `discount`, `quantity`, `price`, `location`, `ad_id`) VALUES
(2, 'datta', 'old', '0', 3, 300, 'Uttara', 1),
(1, 'golam', 'new', '0', 4, 500, 'Kuril', 2),
(1, 'abrar', 'new', '0', 5, 100, 'Dhanmondi', 3),
(3, 'golam', 'new', '0', 3, 300, 'Ploton', 4),
(2, 'golam', 'old', '0', 1, 250, 'Boshundhara', 5),
(54, 'golam', 'new', '0', 1, 175, 'Khilkhet', 6);

-- --------------------------------------------------------

--
-- Table structure for table `book_request`
--

CREATE TABLE `book_request` (
  `request_id` int(3) NOT NULL,
  `book_name` varchar(30) NOT NULL,
  `author` varchar(30) NOT NULL,
  `category` varchar(30) NOT NULL,
  `summary` varchar(1000) NOT NULL,
  `cover_photo` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_request`
--

INSERT INTO `book_request` (`request_id`, `book_name`, `author`, `category`, `summary`, `cover_photo`, `user_id`) VALUES
(5, 'Wuthering Heights', 'Emily BrontÃƒÂ«, John S. Whitl', 'classics', 'Set on the stormy moors of northern England, this classic novel is filled with the cruel and ecstatic love between the characters Heathcliff and Catherine. As they grow together as children and later as lovers, the conflicts of class and an all-consuming passion overwhelm the inhabitants of Wuthering Heights. The all-star cast of performers includes Claire Bloom and James Set on the stormy moors of northern England, this classic novel is filled with the cruel and ecstatic love between the characters Heathcliff and Catherine. As they grow together as children and later as lovers, the conflicts of class and an all-consuming passion overwhelm the inhabitants of Wuthering Heights. The all-star cast of performers includes Claire Bloom and James Mason as the doomed lovers.', 'resource/book_cover/04031232399781853260018.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `full_name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phono_no` varchar(15) NOT NULL,
  `user_type` varchar(15) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `password` varchar(70) NOT NULL,
  `user_id` int(10) NOT NULL,
  `status` varchar(20) NOT NULL,
  `last_login_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`full_name`, `email`, `phono_no`, `user_type`, `user_name`, `password`, `user_id`, `status`, `last_login_date`) VALUES
('admin', 'admin@gmail.com', '***********', 'admin', 'admin', '$2y$10$3hCw/pFYysnYI02qsMwxv.JlHYwcgpIkXRGbzhqORT2kaNnDTxHhO', 1, '', '2020-05-18'),
('Golam Fayaz', 'golam@gmail.com', '00000000000', 'seller', 'golam', '$2y$10$CVD8VeRDVB6io.hlJS/uJOe7UMe7oyh9M0bftfEwAwC1dvTOZKemO', 15, 'approved', '2020-05-18'),
('Shoumik Datta', 'datta@gmail.com', '01500000000', 'seller', 'datta', '$2y$10$QHVfyBn.hV6ea79iI4ddrulnevyKD8LidVrnPL3k/6F2wLgzakavi', 16, 'approved', '2020-05-14'),
('Abrar Ahmed', 'abrar@yahoo.com', '019********', 'seller', 'abrar', '$2y$10$S.9y4l7Ka8HFa5GQLZlqX.0EEgmyJtjsf5BkGwIYQyRyk2C2hphgC', 17, 'approved', '2020-05-18'),
('Atick Eashrak Shuvo', 'eashraks2@gmail.com', '01777777777', 'seller', 'aes', '$2y$10$CP1BVBXynpJV/.fPkxT2PeacZiNWcPk.U83u6yqOR9fPqwCK8BcwK', 19, 'approved', '0000-00-00'),
('Atick Eashrak Shuvo', 'eashraks@gmail.com', '01726825212', 'buyer', 'ae.shuvo', '$2y$10$P2rH39JpjlI91nXiLYffb.ft6mH1OB0Qk0k4tJ1..O6quSdWEhAzK', 21, 'approved', '2020-05-18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `book_ad`
--
ALTER TABLE `book_ad`
  ADD PRIMARY KEY (`ad_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_name` (`user_name`);

--
-- Indexes for table `book_request`
--
ALTER TABLE `book_request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `book_ad`
--
ALTER TABLE `book_ad`
  MODIFY `ad_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `book_request`
--
ALTER TABLE `book_request`
  MODIFY `request_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_ad`
--
ALTER TABLE `book_ad`
  ADD CONSTRAINT `book_ad_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  ADD CONSTRAINT `book_ad_ibfk_2` FOREIGN KEY (`user_name`) REFERENCES `user` (`user_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
