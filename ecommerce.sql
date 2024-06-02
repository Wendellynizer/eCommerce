-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2024 at 07:38 AM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddNotification` (IN `userID` INT, IN `uType` VARCHAR(30), IN `msg` VARCHAR(255))   BEGIN
    	INSERT INTO notifications (user_id, notif_type, message)
        VALUES (userID, uType, msg);
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `AddProduct` (IN `uProduct_of` INT(11), IN `uProduct_name` VARCHAR(255), IN `uCategory_id` INT(11), IN `uPrice` DECIMAL(10,2), IN `uQty` INT(11), IN `uImage_path` VARCHAR(255), IN `uDescription` VARCHAR(255), IN `uCondition` VARCHAR(30))   BEGIN
    	INSERT INTO products (product_of, product_name, description, category_id,product_condition, price, quantity, image_path)
        VALUES
        (uProduct_of, uProduct_name, uDescription, uCategory_id, uCondition, uPrice, uQty, uImage_path);
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CreateUser` (IN `uEmail` VARCHAR(255), IN `uPassword` VARCHAR(60))   BEGIN
	INSERT INTO users (email, password) VALUES(uEmail, uPassword);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllProducts` (IN `limitValue` INT(11), IN `user_id` INT)   BEGIN
    	SELECT * FROM products WHERE product_of=user_id AND deleted_at IS NULL LIMIT limitValue ;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllTrash` (IN `limitValue` INT, IN `user_id` INT)   BEGIN
		SELECT product_id, image_path, product_name, price, quantity, product_condition FROM products WHERE product_of = user_id AND deleted_at IS NOT NULL LIMIT limitValue;
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetProduct` (IN `productId` INT(11))   BEGIN
    	SELECT * FROM products WHERE product_id = productId;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetUserLogin` (IN `uEmail` VARCHAR(50), IN `uPass` VARCHAR(50))   BEGIN
           SELECT * FROM users WHERE email=uEmail AND password=uPass;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `RetrieveProducts` (IN `name` VARCHAR(50), IN `category` INT)   BEGIN
    IF category IS NULL THEN
        SELECT * FROM products_view 
        WHERE product_name LIKE CONCAT('%', IFNULL(name, ""), '%');
    ELSE
        SELECT * FROM products_view 
        WHERE product_name LIKE CONCAT('%', IFNULL(name, ""), '%')
        AND category_name = category;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateProduct` (IN `uProductID` INT, IN `uProductName` VARCHAR(255), IN `uDescription` VARCHAR(255), IN `uCatID` INT, IN `uPrice` DECIMAL(10,2), IN `uQty` INT(10), IN `uImagePath` VARCHAR(255), IN `uCondition` VARCHAR(30))   BEGIN
    	UPDATE products SET product_name=uProductName, description=uDescription, product_condition=uCondition, category_id=uCatID, price=uPrice, quantity=uQty, image_path=uImagePath WHERE product_id=uProductID;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateUser` (IN `uID` INT(11), IN `uEmail` VARCHAR(255), IN `uname` VARCHAR(50), IN `uPass` VARCHAR(60), IN `fName` VARCHAR(50), IN `lName` VARCHAR(50), IN `uAddress` VARCHAR(255), IN `uContact` VARCHAR(11), IN `uGender` CHAR(1), IN `dateOfBirth` DATE, IN `pic_path` VARCHAR(150))   BEGIN
    	UPDATE users SET email=uEmail, username=uname, password=uPass, firstname=fName, lastname=lName, address=uAddress, contact_no=uContact, gender=uGender, date_of_birth=dateOfBirth, profile_pic_path=pic_path WHERE user_id=uID;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cart_id`, `user_id`, `product_id`, `qty`) VALUES
(3, 1, 3, 1),
(4, 1, 5, 1),
(5, 1, 7, 10),
(6, 1, 2, 1),
(7, 1, 3, 5);

-- --------------------------------------------------------

--
-- Stand-in structure for view `cart_details`
-- (See below for the actual view)
--
CREATE TABLE `cart_details` (
`cart_id` int(11)
,`user_id` int(11)
,`product_id` int(11)
,`product_name` varchar(255)
,`image_path` varchar(255)
,`price` decimal(10,0)
,`qty` int(11)
);

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
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `notif_type` varchar(30) NOT NULL,
  `message` varchar(255) NOT NULL,
  `is_read` tinyint(11) NOT NULL DEFAULT 1,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `notif_type`, `message`, `is_read`, `timestamp`) VALUES
(5, 6, 'Order Processing', 'Your order of Logistics has been shipped. <a href=\'purchases.php\'>See purchases.</a>', 0, '2024-06-01 12:26:28'),
(6, 1, 'Customer Order', 'Danigilr45 has placed an order(s). <a href=\'orders.php\'>See orders now</a>', 0, '2024-06-01 12:26:28'),
(7, 1, 'Order Processing', 'Your order of Galvanized Square Steel has been shipped. <a href=\'purchases.php\'>See purchases.</a>', 0, '2024-06-01 12:31:04'),
(8, 6, 'Customer Order', 'wenzkies has placed an order(s). <a href=\'orders.php\'>See orders now</a>', 0, '2024-06-01 12:31:04');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_by` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_date_time` datetime NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT 1,
  `qty_ordered` int(11) UNSIGNED NOT NULL,
  `delete_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_by`, `product_id`, `order_date_time`, `status_id`, `qty_ordered`, `delete_at`) VALUES
(1, 1, 1, '2024-05-29 10:00:00', 5, 1, NULL),
(2, 3, 1, '2024-05-29 05:34:00', 4, 1, NULL),
(3, 3, 4, '2024-05-29 23:00:00', 1, 1, NULL),
(4, 2, 1, '2024-05-29 00:00:48', 4, 1, NULL),
(5, 1, 2, '2024-05-29 00:00:00', 4, 1, NULL),
(6, 1, 2, '2024-05-29 15:00:00', 4, 1, NULL),
(7, 6, 3, '2024-05-30 15:26:33', 4, 5, NULL),
(8, 1, 5, '2024-05-31 10:49:24', 1, 1, NULL),
(9, 1, 1, '2024-05-31 10:49:31', 3, 1, NULL),
(10, 1, 2, '2024-05-31 10:50:02', 2, 1, NULL),
(11, 1, 2, '2024-05-31 10:50:07', 1, 1, NULL),
(12, 6, 1, '2024-06-01 05:51:50', 1, 1, NULL),
(13, 6, 3, '2024-06-01 05:52:56', 1, 1, NULL),
(14, 6, 7, '2024-06-01 05:53:37', 1, 1, NULL),
(15, 6, 7, '2024-06-01 05:54:26', 1, 1, NULL),
(16, 6, 7, '2024-06-01 05:54:39', 1, 1, NULL),
(17, 6, 7, '2024-06-01 06:08:42', 1, 1, NULL),
(18, 6, 7, '2024-06-01 06:08:50', 1, 1, NULL),
(19, 6, 7, '2024-06-01 06:09:03', 1, 1, NULL),
(20, 6, 7, '2024-06-01 06:09:08', 1, 1, NULL),
(21, 6, 7, '2024-06-01 06:12:02', 1, 1, NULL),
(22, 6, 6, '2024-06-01 06:26:27', 1, 1, NULL),
(23, 1, 5, '2024-06-01 06:31:04', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `order_details`
-- (See below for the actual view)
--
CREATE TABLE `order_details` (
`order_id` int(11)
,`seller_id` int(11)
,`firstname` varchar(50)
,`lastname` varchar(50)
,`username` varchar(50)
,`product_name` varchar(255)
,`quantity` int(11) unsigned
,`order_date_time` datetime
,`status` varchar(30)
,`total_amount` decimal(21,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `status_id` int(11) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`status_id`, `status`) VALUES
(1, 'Pending'),
(2, 'Shipping'),
(3, 'Delivering'),
(4, 'Complete'),
(5, 'Cancelled');

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
  `product_condition` varchar(10) DEFAULT NULL,
  `price` decimal(10,0) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_of`, `product_name`, `description`, `category_id`, `product_condition`, `price`, `quantity`, `image_path`, `deleted_at`) VALUES
(1, 1, 'Purelyfinds', 'No description available.', 5, 'Very Good', 1234, 5, 'uploads/product/user166570910c6553.png', NULL),
(2, 1, 'Nyan Chat', 'a description about something', 5, 'Good', 1, 2, 'uploads/product/user16657093d06893.jpg', '2024-06-02 05:39:22'),
(3, 1, 'Tasha', 'this is a product', 1, 'Bad', 32, 5, 'uploads/product/user166570927e356e.jpg', NULL),
(5, 6, 'Galvanized Square Steel', 'comes with screws that gave my aunt to me.', 2, 'Very Good', 150, 50, 'uploads/product/user666588911ea203.jpg', NULL),
(6, 1, 'Logistics', 'this is logistcis', 2, 'Good', 1000, 1, 'uploads/product/user16659c260afb4e.jpeg', NULL),
(7, 1, 'Wenzkie Gwapo Facial Wash', 'qwertyu', 4, 'Fair', 900000, 1, 'uploads/product/user16659ca5222f7c.png', NULL),
(8, 1, 'Senku Figurine', 'a senku figuring', 1, 'Good', 450, 1, 'uploads/product/user16659ea16e32f6.jpg', NULL),
(9, 1, 'Senku Figurine', 'senkue figurine', 1, 'Very Good', 450, 1, 'uploads/product/user16659ea28c0890.jpg', '2024-06-02 07:26:17');

-- --------------------------------------------------------

--
-- Stand-in structure for view `products_view`
-- (See below for the actual view)
--
CREATE TABLE `products_view` (
`product_id` int(11)
,`username` varchar(50)
,`product_name` varchar(255)
,`product_condition` varchar(10)
,`category_name` varchar(100)
,`price` decimal(10,0)
,`quantity` smallint(6)
,`image_path` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `purchases_view`
-- (See below for the actual view)
--
CREATE TABLE `purchases_view` (
`product_id` int(11)
,`order_by` int(11)
,`seller` varchar(50)
,`product_name` varchar(255)
,`image_path` varchar(255)
,`status` varchar(30)
,`qty_ordered` int(11) unsigned
,`total_amount` decimal(21,0)
,`order_date_time` datetime
);

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
  `profile_pic_path` varchar(255) NOT NULL DEFAULT 'uploads/profile/default.png',
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
(4, 'dellyace11@gmail.com', 'wendz', 'qwerty', 'Drake', 'Lazner', 'uploads/profile/user4.jpeg', 'Prk 3-B Sto. Nino Carmen', '09123456789', 'N', '2005-01-01', '2024-05-17 04:52:36'),
(6, 'test@test.com', 'Danigilr45', 'test123', 'Daniela', 'Asumbrado', 'uploads/profile/user6.jpg', 'Kasilak, Panabo City', '0912345678', 'F', '2004-07-04', '2024-05-17 04:53:21'),
(7, 'del@gmail.com', NULL, '123456789', NULL, NULL, '', NULL, NULL, 'N', NULL, '2024-05-17 06:39:13'),
(8, 'scasc@afasd', NULL, 'rwasdasd', NULL, NULL, '', NULL, NULL, 'N', NULL, '2024-05-17 07:31:39');

-- --------------------------------------------------------

--
-- Structure for view `cart_details`
--
DROP TABLE IF EXISTS `cart_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cart_details`  AS SELECT `c`.`cart_id` AS `cart_id`, `c`.`user_id` AS `user_id`, `p`.`product_id` AS `product_id`, `p`.`product_name` AS `product_name`, `p`.`image_path` AS `image_path`, `p`.`price` AS `price`, `c`.`qty` AS `qty` FROM (`carts` `c` join `products` `p` on(`c`.`product_id` = `p`.`product_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `order_details`
--
DROP TABLE IF EXISTS `order_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `order_details`  AS SELECT `o`.`order_id` AS `order_id`, `p`.`product_of` AS `seller_id`, `u`.`firstname` AS `firstname`, `u`.`lastname` AS `lastname`, `u`.`username` AS `username`, `p`.`product_name` AS `product_name`, `o`.`qty_ordered` AS `quantity`, `o`.`order_date_time` AS `order_date_time`, `os`.`status` AS `status`, `o`.`qty_ordered`* `p`.`price` AS `total_amount` FROM (((`orders` `o` left join `products` `p` on(`o`.`product_id` = `p`.`product_id`)) left join `order_status` `os` on(`o`.`status_id` = `os`.`status_id`)) left join `users` `u` on(`o`.`order_by` = `u`.`user_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `products_view`
--
DROP TABLE IF EXISTS `products_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `products_view`  AS SELECT `p`.`product_id` AS `product_id`, `u`.`username` AS `username`, `p`.`product_name` AS `product_name`, `p`.`product_condition` AS `product_condition`, `c`.`category_name` AS `category_name`, `p`.`price` AS `price`, `p`.`quantity` AS `quantity`, `p`.`image_path` AS `image_path` FROM ((`products` `p` join `users` `u` on(`p`.`product_of` = `u`.`user_id`)) join `category` `c` on(`p`.`category_id` = `c`.`category_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `purchases_view`
--
DROP TABLE IF EXISTS `purchases_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `purchases_view`  AS SELECT `p`.`product_id` AS `product_id`, `o`.`order_by` AS `order_by`, `s`.`username` AS `seller`, `p`.`product_name` AS `product_name`, `p`.`image_path` AS `image_path`, `os`.`status` AS `status`, `o`.`qty_ordered` AS `qty_ordered`, `o`.`qty_ordered`* `p`.`price` AS `total_amount`, `o`.`order_date_time` AS `order_date_time` FROM ((((`orders` `o` left join `products` `p` on(`o`.`product_id` = `p`.`product_id`)) left join `users` `u` on(`o`.`order_by` = `u`.`user_id`)) left join `users` `s` on(`p`.`product_of` = `s`.`user_id`)) left join `order_status` `os` on(`o`.`status_id` = `os`.`status_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `carts_ibfk_2` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_fk` (`category_id`),
  ADD KEY `product_of_fk` (`product_of`),
  ADD KEY `product_name_idx` (`product_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `username_idx` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `order_status` (`status_id`);

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
