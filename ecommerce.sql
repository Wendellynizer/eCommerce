-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 12:04 AM
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
-- Database: `ecommerce`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddProduct` (IN `uProduct_of` INT(11), IN `uProduct_name` VARCHAR(255), IN `uCategory_id` INT(11), IN `uPrice` DECIMAL(10,2), IN `uQty` INT(11), IN `uImage_path` VARCHAR(255))   BEGIN
    	INSERT INTO products (product_of, product_name, category_id, price, quantity, image_path)
        VALUES
        (uProduct_of, uProduct_name, uCategory_id, uPrice, uQty, uImage_path);
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CreateUser` (IN `uEmail` VARCHAR(255), IN `uPassword` VARCHAR(60))   BEGIN
	INSERT INTO users (email, password) VALUES(uEmail, uPassword);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllProducts` (IN `limitValue` INT(11))   BEGIN
    	SELECT * FROM products LIMIT limitValue;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetProduct` (IN `productId` INT(11))   BEGIN
    	SELECT * FROM products WHERE product_id = productId;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetUserLogin` (IN `uEmail` VARCHAR(50), IN `uPass` VARCHAR(50))   BEGIN
           SELECT * FROM users WHERE email=uEmail AND password=uPass;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateUser` (IN `uID` INT(11), IN `uEmail` VARCHAR(255), IN `uname` VARCHAR(50), IN `uPass` VARCHAR(60), IN `fName` VARCHAR(50), IN `lName` VARCHAR(50), IN `uAddress` VARCHAR(255), IN `uContact` VARCHAR(11), IN `uGender` CHAR(1), IN `dateOfBirth` DATE, IN `pic_path` VARCHAR(150))   BEGIN
    	UPDATE users SET email=uEmail, username=uname, password=uPass, firstname=fName, lastname=lName, address=uAddress, contact_no=uContact, gender=uGender, date_of_birth=dateOfBirth, profile_pic_path=pic_path WHERE user_id=uID;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Figurine'),
(2, 'Automobile'),
(3, 'Furniture'),
(4, 'Men\'s Apparel'),
(5, 'Women\'s Apparel');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_of` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT 'No description available.',
  `category_id` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_of`, `product_name`, `description`, `category_id`, `price`, `quantity`, `image_path`) VALUES
(1, 1, 'Test', 'No description available.', 2, 1234, 1, 'uploads/product/user166509a533bc25.jpg'),
(2, 1, 'Dog', 'No description available.', 1, 1, 1, 'uploads/product/user16650a43038a32.jpg'),
(3, 1, 'Myself', 'No description available.', 5, 324, 1, 'uploads/product/user16650a4d625083.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `profile_pic_path` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_no` varchar(11) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `account_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `username`, `password`, `firstname`, `lastname`, `profile_pic_path`, `address`, `contact_no`, `gender`, `date_of_birth`, `account_created`) VALUES
(1, 'asdasd@asdasd', 'wenzkies', 'asdasd', 'Wendel', 'Sabelo', 'uploads/profile/user1.png', 'Prk 3-B Sto. Nino Carmen', '09514135319', 'F', '2007-10-16', '2024-05-17 04:43:32'),
(4, 'wendel@gmail.com', NULL, 'qwerty', NULL, NULL, '', NULL, NULL, 'N', NULL, '2024-05-17 04:52:36'),
(6, 'test@test.com', NULL, 'test123', NULL, NULL, '', NULL, NULL, 'N', NULL, '2024-05-17 04:53:21'),
(7, 'del@gmail.com', NULL, '123456789', NULL, NULL, '', NULL, NULL, 'N', NULL, '2024-05-17 06:39:13'),
(8, 'scasc@afasd', NULL, 'rwasdasd', NULL, NULL, '', NULL, NULL, 'N', NULL, '2024-05-17 07:31:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_fk` (`category_id`),
  ADD KEY `product_of_fk` (`product_of`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `category_fk` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_of_fk` FOREIGN KEY (`product_of`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
