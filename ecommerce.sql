-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2024 at 12:35 AM
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
-- Database: `ecommerce`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddNotification` (IN `userID` INT, IN `notif_type_id` INT)   BEGIN
	IF notif_type_id = 1 THEN
        	INSERT INTO notifications (user_id, notif_type, message)
            SELECT userID, "Order Processing", CONCAT('Your order of ', p.product_name,' is being process by the seller.') FROM orders o 
            INNER JOIN products p ON p.product_id = o.product_id 
             WHERE o.order_by = userID LIMIT 1;
        
        ELSEIF notif_type_id = 2 THEN
        	INSERT INTO notifications (user_id, notif_type, message)
            SELECT userID, "Order Shipped", CONCAT('Your order of ', p.product_name, ' has been shipped.') FROM orders o 
            INNER JOIN products p ON p.product_id = o.product_id
            WHERE o.order_by = userID LIMIT 1;
            
        ELSEIF notif_type_id = 3 THEN
        	INSERT INTO notifications (user_id, notif_type, message)
            SELECT userID, "Order Delivering", CONCAT('Your order of ', p.product_name, ' is out for delivery.') FROM orders o 
            INNER JOIN products p ON p.product_id = o.product_id
            WHERE o.order_by = userID LIMIT 1;
            
        ELSEIF notif_type_id = 4 THEN
        	INSERT INTO notifications (user_id, notif_type, message)
            SELECT userID, "Order Complete", CONCAT('Your order of ', p.product_name, ' is complete.') FROM orders o 
            INNER JOIN products p ON p.product_id = o.product_id
            WHERE o.order_by = userID LIMIT 1;
            
        ELSEIF notif_type_id = 5 THEN
        	INSERT INTO notifications (user_id, notif_type, message)
            SELECT userID, "Customer Order", CONCAT(username, ' has cancelled an order.') FROM users WHERE user_id = userID LIMIT 1;
        END IF;
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `AddProduct` (IN `uProduct_of` INT(11), IN `uProduct_name` VARCHAR(255), IN `uCategory_id` INT(11), IN `uPrice` DECIMAL(10,2), IN `uQty` INT(11), IN `uImage_path` VARCHAR(255), IN `uDescription` VARCHAR(255), IN `uCondition` VARCHAR(30))   BEGIN
    	INSERT INTO products (product_of, product_name, description, category_id,product_condition, price, quantity, image_path)
        VALUES
        (uProduct_of, uProduct_name, uDescription, uCategory_id, uCondition, uPrice, uQty, uImage_path);
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CreateUser` (IN `uEmail` VARCHAR(255), IN `uPassword` VARCHAR(60))   BEGIN
	INSERT INTO users (email, password) VALUES(uEmail, uPassword);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteProduct` (IN `productID` INT)   BEGIN
    	DELETE FROM products WHERE product_id = productID;
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
(4, 1, 5, 1),
(5, 1, 7, 10),
(8, 1, 40, 2),
(9, 4, 16, 1);

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
(5, 'Women\'s Apparel'),
(6, 'Hardware Materials');

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
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `notif_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `notif_type`, `message`, `is_read`, `timestamp`, `notif_date`) VALUES
(564, 1, 'Order Shipped', 'Your order of Unknown Character has been shipped.', 0, '2024-06-04 05:58:45', '2024-06-04 05:58:45'),
(565, 1, 'Order Delivering', 'Your order of Unknown Character is out for delivery.', 0, '2024-06-04 05:58:46', '2024-06-04 05:58:46'),
(566, 1, 'Order Shipped', 'Your order of Unknown Character has been shipped.', 0, '2024-06-04 05:58:52', '2024-06-04 05:58:52'),
(567, 1, 'Order Delivering', 'Your order of Unknown Character is out for delivery.', 0, '2024-06-04 05:58:53', '2024-06-04 05:58:53'),
(568, 1, 'Order Processing', 'Your order of Unknown Character is being process by the seller.', 0, '2024-06-04 06:02:24', '2024-06-04 06:02:24'),
(569, 1, 'Order Processing', 'Your order of Unknown Character is being process by the seller.', 0, '2024-06-04 06:02:38', '2024-06-04 06:02:38');

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
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_by`, `product_id`, `order_date_time`, `status_id`, `qty_ordered`, `deleted_at`) VALUES
(25, 6, 6, '2024-06-03 20:10:08', 4, 1, NULL),
(26, 1, 41, '2024-06-03 22:37:24', 4, 1, NULL),
(27, 1, 41, '2024-06-03 22:41:24', 1, 1, NULL),
(28, 1, 41, '2024-06-03 22:51:48', 1, 1, NULL),
(29, 1, 41, '2024-06-03 22:54:58', 1, 1, NULL),
(30, 1, 41, '2024-06-03 22:56:35', 1, 1, NULL),
(31, 4, 7, '2024-06-03 22:57:59', 1, 1, NULL),
(32, 1, 41, '2024-06-03 22:58:59', 1, 1, NULL),
(33, 1, 41, '2024-06-03 23:01:31', 1, 1, NULL),
(34, 1, 41, '2024-06-03 23:03:54', 1, 1, NULL),
(35, 1, 41, '2024-06-03 23:04:13', 1, 1, NULL),
(36, 1, 41, '2024-06-03 23:38:07', 1, 1, NULL),
(37, 1, 41, '2024-06-03 23:44:14', 1, 1, NULL),
(38, 1, 41, '2024-06-03 23:44:21', 4, 1, NULL),
(39, 1, 41, '2024-06-03 23:44:32', 2, 1, NULL),
(40, 1, 41, '2024-06-03 23:44:34', 1, 1, NULL),
(41, 1, 41, '2024-06-03 23:44:35', 1, 1, NULL),
(42, 1, 41, '2024-06-03 23:44:35', 1, 1, NULL),
(43, 1, 41, '2024-06-03 23:44:37', 1, 1, NULL),
(44, 1, 41, '2024-06-03 23:45:02', 1, 1, NULL),
(45, 1, 41, '2024-06-03 23:45:37', 1, 1, NULL),
(46, 1, 41, '2024-06-04 00:02:24', 1, 1, NULL),
(47, 1, 41, '2024-06-04 00:02:38', 1, 1, NULL);

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `order_insert_trigger` AFTER INSERT ON `orders` FOR EACH ROW BEGIN
		CALL AddNotification(NEW.order_by, 1);
	END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `order_update_trigger` AFTER UPDATE ON `orders` FOR EACH ROW BEGIN
		IF OLD.status_id = 2 THEN
        	CALL AddNotification(OLD.order_by, OLD.status_id);
        ELSEIF OLD.status_id = 3 THEN
        	CALL AddNotification(OLD.order_by, OLD.status_id);
        ELSEIF OLD.status_id = 4 THEN
        	CALL AddNotification(OLD.order_by, OLD.status_id);
        ELSEIF OLD.status_id = 5 THEN
        	CALL AddNotification(
                (SELECT product_of FROM products WHERE product_id = OLD.product_id), 
            OLD.status_id);
		END IF; 
	END
$$
DELIMITER ;

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
(5, 6, 'Galvanized Square Steel', 'comes with screws that gave my aunt to me.', 2, 'Very Good', 150, 50, 'uploads/product/user666588911ea203.jpg', NULL),
(6, 1, 'Logistics', 'this is logistcis', 2, 'Good', 1000, 0, 'uploads/product/user16659c260afb4e.jpeg', NULL),
(7, 1, 'Wenzkie Gwapo Facial Wash', 'qwertyu', 4, 'Fair', 900000, 1, 'uploads/product/user16659ca5222f7c.png', NULL),
(8, 1, 'Senku Figurine', 'a senku figuring', 1, 'Good', 450, 1, 'uploads/product/user16659ea16e32f6.jpg', NULL),
(9, 1, 'Senku Figurine', 'senkue figurine', 1, 'Very Good', 450, 1, 'uploads/product/user16659ea28c0890.jpg', NULL),
(10, 1, 'Kabaneri of The Iron Fortress', 'It only makes sense that its protagonist, Mumei, also has an equally dynamic figure. Mumei is also a rare creation with only ten in existence, standing just over five feet. Some life-size figures don\'t live up to their price tag and can have a mass-produc', 1, 'Very Good', 24000, 3, 'uploads/product/user1665dc4c0c8549.jpg', NULL),
(11, 1, 'Early Neapolitan Polychromed Terracotta and Carved Wood Crèche Nativity Figure.', 'A beautiful example of an Italian, Neapolitan nativity figure. Her hand painted terracotta head features a pretty face with rosy cheeks and glass eyes with brown wavy hair swept up into a top knot. Popular with collectors it is recorded that the King of I', 1, 'Very Good', 4668, 3, 'uploads/product/user1665dc5491c196.jpg', NULL),
(12, 1, 'Bloodborne Game : The Hunter Action Figure / Video Game Action Figurines Figma, Collection Model Doll Toys Game Statue Home Decoration Gift', '\"Hunter Bloobborne Lamp, Bloodborne Game, Bloodborne Figure, Hunter Bloobborne Figure, Epoxy resin lamp, Lamp Decor home, Gift For dad, Handmade lamp, Father\'s Day Gift, Dark souls game, Elden Ring game, Video Game\r\n\r\n1. Size\r\nSize M: 13x6.5x6.5cm\r\nSize L', 1, 'Good', 2024, 6, 'uploads/product/user1665dc583dfe43.jpg', NULL),
(13, 1, 'Luffy Figurine - 20CM Luffy Anime Action Figure - Anime Statue - Anime Decoration - Manga Collectible', 'Height: 20cm\r\nMaterial: High-Quality Resin\r\n\r\nSet sail on an adventure with our dynamic Luffy statue, standing proudly at 20cm! 🌊\r\n\r\nExpertly crafted with attention to detail, this statue captures the essence of our fearless captain. ⚓️\r\n\r\nWith his iconic', 1, 'Very Good', 1854, 16, 'uploads/product/user1665dc5b2f4025.jpg', NULL),
(14, 1, 'Rengoko and Akaza Statue STL File, 3D Digital Printing STL File for 3D Printers, Movie Characters, Games, Figures, Diorama 3D Model', 'This is not a finished product, it is a DIGITAL GOODS for 3D printing for the 3D machines.', 1, 'Very Good', 900, 9, 'uploads/product/user1665dc5f38c431.jpg', NULL),
(15, 10, 'Sitting Gojo Figurine - 10CM Anime Action Figure - Anime Small Statue - Manga Table Decoration - Anime Desk Decor - Gift for Anime Fans', 'Discover the Sitting Gojo Figurine, a perfect 10 cm collectible! 🌟This charming figure captures the essence of the beloved character with incredible detail.\r\nThe Sitting Gojo Figurine portrays the enigmatic sorcerer in a relaxed pose, featuring his iconic', 1, 'Very Good', 1325, 2, 'uploads/product/user10665dc6936f996.jpg', NULL),
(16, 10, '2017 Ford EcoSport 1.5 Titanium AT', 'This 2017 Ford EcoSport 1.5 Titanium AT Crossover could be yours for just P415,000.00.\r\n\r\nThis particular EcoSport features a 1.5L Gasoline engine, paired with a Automatic transmission and has got 60,000 km on the clock. On the inside the vehicle features', 2, 'Very Good', 415000, 1, 'uploads/product/user10665dc71fb451a.jpg', NULL),
(17, 10, 'BAIC B40 Ragnar', 'The B40 Ragnar is a vehicle with a body-on-frame construction and a 4x4 drivetrain. It features approach and departure angles that enable it to navigate various off-road terrains. The vehicle is equipped with 220 mm of ground clearance which aids its off-', 2, 'Very Good', 2368000, 1, 'uploads/product/user10665dc74ef1640.jpg', NULL),
(18, 10, '2007 BMW 1-Series Hatchback 120i Sport', 'This 2007 BMW 1-Series Hatchback 120i Sport Hatchback could be yours for just P468,000.00.\r\n\r\nThis particular 1-Series Hatchback features a 2L Gasoline engine, paired with a Automatic transmission and has got 85,000 km on the clock. On the inside the vehi', 2, 'Very Good', 468000, 1, 'uploads/product/user10665dc784e2e06.jpg', NULL),
(19, 10, '2019 Toyota Fortuner 2.7L AT Gasoline', 'This 2019 Toyota Fortuner 2.7L AT Gasoline SUV could be yours for just P995,000.00.\r\n\r\nThis particular Fortuner features a 2.7L Gasoline engine, paired with a Automatic transmission and has got 90,000 km on the clock. On the inside the vehicle features Po', 2, 'Very Good', 995000, 1, 'uploads/product/user10665dc7bc0f941.jpg', NULL),
(20, 10, '2018 Mitsubishi Montero Sport GLS 2.4L AT Diesel', 'This 2018 Mitsubishi Montero Sport GLS 2.4L AT Diesel SUV could be yours for just P990,000.00.\r\n\r\nThis particular Montero Sport features a 2.4L Diesel engine, paired with a Automatic transmission and has got 50,000 km on the clock. On the inside the vehic', 2, 'Very Good', 990000, 1, 'uploads/product/user10665dc7fa4ce17.jpg', NULL),
(21, 10, '2014 Hyundai Grand Starex', 'This 2014 Hyundai Grand Starex 2.5 HVX with transmission is available for sale in Davao City City at ₱550000 . This 2014 Hyundai Grand Starex is First hand owner maintained, It runs on diesel engine and its odometer reading is 95000 KM. You can also check', 2, 'Very Good', 999000, 1, 'uploads/product/user10665dc839a325c.jpg', NULL),
(22, 10, '2017 Toyota Innova', 'ODO: 98,400km\r\nMagwheels: 16, 17, 205\r\nYou will be hard pressed to find better value for your money elsewhere. This is a bargain you cannot afford to miss, so get in touch today.  If you are interested to inquire on the listing just fill in your details o', 2, 'Very Good', 760000, 1, 'uploads/product/user10665dc85fa2021.jpg', NULL),
(23, 10, '2018 Nissan Urvan', 'This 2018 Nissan Urvan 18 Seater VX with manual transmission is available for sale in Davao City City at ₱880000 . This 2018 Nissan Urvan is First hand owner maintained, It runs on diesel engine and its odometer reading is 110000 KM. You can also check Ni', 2, 'Very Good', 880000, 1, 'uploads/product/user10665dc884b5075.jpg', NULL),
(24, 1, 'Men\'s Fashion Comfy Loafers, Wear-resistant Non-Slip Smart Casual Shoes', 'Upper Material: Suede\r\nInsole Material: EVA\r\nInner Material: Cloth\r\nSole Material: Rubber', 4, 'Very Good', 1500, 3, 'uploads/product/user1665e0f9e25b9a.jpg', NULL),
(25, 1, 'Summer Sun Hat Outdoor Korean Version Peaked Cap Simple Solid Color Street Style Canvas Baseball Cap Short Brim Hat', 'Usage: Casual wear', 4, 'Very Good', 100, 20, 'uploads/product/user1665e0fee03f79.jpg', NULL),
(26, 1, 'Korean Trend Shoes Men\'s Outdoor Casual White Shoes', 'Product description: Pattern: Maple Leaf Product Category: Board Shoes Upper height: low Size: 40/41/42/43/44/44 Closed: lace-up Applicable scene: daily Toe shape: round head Applicable gender: male/female Applicable age group: youth (18-40 years old) Sui', 4, 'Very Good', 800, 19, 'uploads/product/user1665e0ffcc62a9.jpg', NULL),
(27, 1, 'Literary Simple Casual Shoulder Ladies Bag Portable Cloth Bag', '1. Quality testing will be carried out before the product is sent out of the warehouse\r\n2. If you encounter quality problems after receiving a product, you can contact Quality Assurance\r\nus first.', 5, 'Very Good', 890, 2, 'uploads/product/user1665e1064326f8.jpg', NULL),
(28, 1, 'R&O #SW3 Korean daster sleepwear sleep dress night dress Pambahay Homewear Nightwear Dress', 'ONE SIZE (XXL) No pocket Size: Lenght - 93cm Chest Circumference - 50cm Shoulder width -51cm Sleeve Length -17cm Materials: Cotton Spandex', 5, 'Very Good', 678, 6, 'uploads/product/user1665e10987856b.jpg', NULL),
(30, 4, '2021 Mitsubishi xpander gls', 'Mitsubishi Xpander GLS\r\nModel 2021, Automatic\r\n1st owner Lady owned\r\nWith own damage car insurance\r\nkeyless push button', 2, 'Very Good', 70000, 2, 'uploads/product/user4665e12fb37615.jpg', NULL),
(31, 4, 'Hyundai accent 2018', 'RUSH‼️‼️\r\n\r\nfor assume\r\nhyundai accent 2018\r\nmatic\r\n39k mileage', 2, 'Very Good', 1200000, 1, 'uploads/product/user4665e13a78cc8e.jpg', NULL),
(32, 4, '4wheel E- car', 'Rush Sale visit to see in person', 2, 'Very Good', 12300, 1, 'uploads/product/user4665e1411d7850.jpg', NULL),
(33, 4, 'Mitsubishi', '16 months paid\r\n✅ Very tipid sa GAS\r\n✅ 13k+ Odo\r\n✅ Well maintained sa casa\r\n✅ w/ AAP Insurance til Jan. 2025', 2, 'Very Good', 123222, 1, 'uploads/product/user4665e146561685.jpg', NULL),
(34, 4, 'Midrange Car', 'Good as new need money for now.', 2, 'Good', 232112, 1, 'uploads/product/user4665e14c2e8c05.jpg', NULL),
(35, 6, 'Sin', 'Color roof and wall cladding \r\nRoofing materials all you need', 6, 'Very Good', 300, 1, 'uploads/product/user6665e153bb3194.jpg', NULL),
(36, 6, 'Wall Cladding and Roofing Materials', 'Planta price ta, mao ng barato ra. 🥰🫢', 6, 'Very Good', 230, 5, 'uploads/product/user6665e1581435eb.jpg', NULL),
(37, 6, 'Ribtype and BENDED materials', 'FREE TASTE', 5, 'Bad', 99, 1, 'uploads/product/user6665e15fe72188.jpg', NULL),
(38, 6, 'Bomba', 'Affordable and Durable for the string pumping', 6, 'Good', 299, 1, 'uploads/product/user6665e16a879aaf.jpg', NULL),
(39, 1, 'Cabalbal', 'Blatter', 4, 'Bad', 89, 1, 'uploads/product/user1665e17f7e28bc.jfif', NULL),
(40, 1, 'Puwa Bangko', 'Humokon All set', 3, 'Very Good', 1, 1, 'uploads/product/user1665e18b572efd.jpg', NULL),
(41, 4, 'Unknown Character', 'DURABLE AND ENJOYABLE', 1, 'Very Good', 120, -2, 'uploads/product/user4665e1a6ad5fd6.jfif', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `products_view`
-- (See below for the actual view)
--
CREATE TABLE `products_view` (
`product_id` int(11)
,`seller` varchar(50)
,`product_name` varchar(255)
,`product_condition` varchar(10)
,`category_id` int(11)
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
(10, 'bugoy143@gmail.com', 'bugoy143', 'qwerty12345', 'Bugoy', 'Neh', 'uploads/profile/user10.jfif', 'Prk6 DDN', '09430434322', 'M', '1997-01-14', '2024-06-03 13:33:11');

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `products_view`  AS SELECT `p`.`product_id` AS `product_id`, `u`.`username` AS `seller`, `p`.`product_name` AS `product_name`, `p`.`product_condition` AS `product_condition`, `c`.`category_id` AS `category_id`, `c`.`category_name` AS `category_name`, `p`.`price` AS `price`, `p`.`quantity` AS `quantity`, `p`.`image_path` AS `image_path` FROM ((`products` `p` join `users` `u` on(`p`.`product_of` = `u`.`user_id`)) join `category` `c` on(`p`.`category_id` = `c`.`category_id`)) ;

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
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=570;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
