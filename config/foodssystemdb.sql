-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2022 at 04:47 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodssystemdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admintbl`
--

CREATE TABLE `admintbl` (
  `UserID` int(11) NOT NULL,
  `AdminUsername` varchar(255) NOT NULL,
  `AdminPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admintbl`
--

INSERT INTO `admintbl` (`UserID`, `AdminUsername`, `AdminPassword`) VALUES
(1, 'test', '$2y$10$PwdC6lGaBlLs47Fg4O.hJ.wxPEvJjMhptgHxji3PLaOOGHXfnA2DS');

-- --------------------------------------------------------

--
-- Table structure for table `categorytbl`
--

CREATE TABLE `categorytbl` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categorytbl`
--

INSERT INTO `categorytbl` (`CategoryID`, `CategoryName`) VALUES
(1, 'Add-Ons'),
(2, 'Beverages'),
(3, 'Burgers'),
(4, 'Desserts'),
(5, 'Family Meals'),
(6, 'Rice Meals'),
(7, 'Pasta');

-- --------------------------------------------------------

--
-- Table structure for table `customertbl`
--

CREATE TABLE `customertbl` (
  `CustomerID` int(11) NOT NULL,
  `CustomerUsername` varchar(30) NOT NULL,
  `CustomerPassword` varchar(255) NOT NULL,
  `EmailAddress` varchar(320) NOT NULL,
  `FirstName` varchar(100) DEFAULT NULL,
  `MiddleName` varchar(100) DEFAULT NULL,
  `LastName` varchar(100) DEFAULT NULL,
  `Birthdate` date DEFAULT NULL,
  `ContactNum` varchar(50) DEFAULT NULL,
  `AccountStatus` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customertbl`
--

INSERT INTO `customertbl` (`CustomerID`, `CustomerUsername`, `CustomerPassword`, `EmailAddress`, `FirstName`, `MiddleName`, `LastName`, `Birthdate`, `ContactNum`, `AccountStatus`) VALUES
(12, 'test', '$2y$10$iQ6PdN8b6dRKj6D5x7UfHutD804pMxkqmKeVtBpJuu1y21EQ5MEPy', 'test@test.com', 'test', 'test', 'test', '2022-05-30', '12321', 1),
(13, 'tester', '$2y$10$T1G2jRPwJ4GtyksjXjddbe1QMsEpSZM7ivzl91n2xP/vE8Mcq767y', 'test1@test1.com', 'test', 'test', 'test', '2022-05-30', 'testes', 1);

-- --------------------------------------------------------

--
-- Table structure for table `favoritetbl`
--

CREATE TABLE `favoritetbl` (
  `FavoriteID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orderdetailstbl`
--

CREATE TABLE `orderdetailstbl` (
  `OrderDetailsID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `OrderQuantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderdetailstbl`
--

INSERT INTO `orderdetailstbl` (`OrderDetailsID`, `OrderID`, `ProductID`, `OrderQuantity`) VALUES
(38, 30, 5, 2),
(39, 30, 13, 1),
(41, 30, 5, 2),
(42, 30, 17, 1),
(43, 30, 5, 2),
(44, 30, 4, 32),
(46, 30, 22, 6),
(47, 30, 4, 22),
(48, 35, 9, 1),
(49, 30, 15, 1),
(50, 30, 26, 1),
(51, 56, 23, 1),
(52, 57, 16, 1),
(53, 58, 25, 1),
(54, 58, 15, 1),
(56, 59, 25, 3),
(57, 59, 6, 3),
(58, 60, 22, 1),
(59, 61, 5, 1),
(61, 63, 25, 1),
(62, 63, 16, 1),
(63, 64, 15, 1),
(64, 65, 6, 1),
(65, 65, 20, 1),
(66, 66, 15, 1),
(67, 67, 16, 1),
(68, 67, 17, 1),
(69, 68, 15, 1),
(70, 69, 20, 1),
(71, 70, 16, 1),
(72, 71, 20, 1),
(73, 72, 20, 1),
(74, 73, 6, 1),
(75, 74, 17, 1),
(76, 75, 6, 2),
(77, 76, 17, 1),
(78, 77, 25, 4),
(79, 78, 15, 1),
(80, 79, 25, 3),
(81, 79, 19, 4),
(82, 79, 10, 3),
(83, 80, 5, 1),
(84, 80, 10, 1),
(85, 80, 11, 1),
(86, 81, 15, 1),
(87, 81, 11, 1),
(88, 82, 17, 1),
(89, 83, 16, 1),
(90, 83, 11, 1),
(91, 84, 6, 3),
(92, 84, 10, 1),
(93, 84, 5, 1),
(94, 85, 5, 1),
(95, 85, 7, 1),
(96, 85, 20, 2),
(97, 85, 19, 2),
(98, 85, 8, 1),
(99, 85, 26, 1),
(100, 86, 17, 1),
(101, 86, 19, 3),
(102, 86, 11, 12),
(103, 87, 10, 1),
(104, 87, 9, 1),
(105, 87, 11, 1),
(106, 88, 20, 1),
(107, 88, 8, 4),
(108, 88, 9, 3),
(109, 89, 5, 1),
(110, 89, 11, 1),
(111, 89, 12, 1),
(112, 90, 9, 1),
(113, 91, 16, 1),
(114, 92, 17, 1),
(115, 93, 7, 1),
(116, 94, 6, 1),
(117, 95, 19, 1),
(118, 96, 7, 1),
(119, 97, 26, 3),
(120, 98, 25, 2),
(121, 98, 26, 3),
(122, 99, 19, 2),
(123, 99, 7, 23),
(124, 99, 11, 3),
(125, 100, 19, 2),
(126, 100, 6, 23),
(127, 100, 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `ordertbl`
--

CREATE TABLE `ordertbl` (
  `OrderID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `Order_DateTime` datetime NOT NULL,
  `OrderStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ordertbl`
--

INSERT INTO `ordertbl` (`OrderID`, `CustomerID`, `Order_DateTime`, `OrderStatus`) VALUES
(30, 12, '2022-05-30 08:01:46', 0),
(31, 12, '2022-05-30 08:01:46', 0),
(32, 12, '2022-05-30 08:01:46', 0),
(33, 12, '2022-05-30 08:01:46', 0),
(34, 12, '2022-05-30 08:01:46', 0),
(35, 12, '2022-05-30 08:01:46', 0),
(36, 12, '2022-05-30 08:01:46', 0),
(37, 12, '2022-05-30 08:01:46', 0),
(38, 12, '2022-05-30 08:01:46', 0),
(39, 12, '2022-05-30 08:01:46', 0),
(40, 12, '2022-05-30 08:01:46', 0),
(41, 12, '2022-05-30 08:01:46', 0),
(42, 12, '2022-05-30 08:01:46', 0),
(43, 12, '2022-05-30 08:01:46', 0),
(44, 12, '2022-05-30 08:01:46', 0),
(45, 12, '2022-05-30 08:01:46', 0),
(46, 12, '2022-05-30 08:01:46', 0),
(47, 12, '2022-05-30 08:01:46', 0),
(48, 12, '2022-05-30 08:01:46', 0),
(49, 12, '2022-05-30 08:01:46', 0),
(50, 12, '2022-05-30 08:01:46', 0),
(51, 12, '2022-05-30 08:01:46', 0),
(52, 12, '2022-05-30 08:01:46', 0),
(53, 12, '2022-05-30 08:01:46', 0),
(54, 12, '2022-05-30 08:01:46', 0),
(55, 12, '2022-05-30 08:01:46', 0),
(56, 12, '2022-05-30 08:01:46', 0),
(57, 12, '2022-05-30 08:01:46', 0),
(58, 12, '2022-05-30 08:07:58', 0),
(59, 12, '2022-05-30 08:19:09', 0),
(60, 12, '2022-05-30 08:21:32', 0),
(61, 12, '2022-05-30 09:12:16', 0),
(62, 12, '2022-05-30 09:25:06', 1),
(63, 13, '2022-05-30 12:59:01', 0),
(64, 13, '2022-05-30 13:00:14', 0),
(65, 13, '2022-05-30 13:00:35', 0),
(66, 13, '2022-05-30 13:01:41', 0),
(67, 13, '2022-05-30 13:04:46', 0),
(68, 13, '2022-05-30 13:07:43', 0),
(69, 13, '2022-05-30 13:10:46', 0),
(70, 13, '2022-05-30 13:11:10', 0),
(71, 13, '2022-05-30 13:11:46', 0),
(72, 13, '2022-05-30 13:12:02', 0),
(73, 13, '2022-05-30 13:12:21', 0),
(74, 13, '2022-05-30 13:13:20', 0),
(75, 13, '2022-05-30 13:16:16', 0),
(76, 13, '2022-05-30 13:16:51', 0),
(77, 13, '2022-05-30 13:20:25', 0),
(78, 13, '2022-05-30 13:22:17', 0),
(79, 13, '2022-05-30 13:22:53', 0),
(80, 13, '2022-05-30 13:30:55', 0),
(81, 13, '2022-05-30 13:31:35', 0),
(82, 13, '2022-05-30 13:32:31', 0),
(83, 13, '2022-05-30 13:32:56', 0),
(84, 13, '2022-05-30 13:33:21', 0),
(85, 13, '2022-05-30 14:26:32', 0),
(86, 13, '2022-05-30 14:27:36', 0),
(87, 13, '2022-05-30 14:28:43', 0),
(88, 13, '2022-05-30 14:56:13', 0),
(89, 13, '2022-05-30 14:57:44', 0),
(90, 13, '2022-05-30 14:58:46', 0),
(91, 13, '2022-05-30 14:59:52', 0),
(92, 13, '2022-05-30 15:00:35', 0),
(93, 13, '2022-05-30 15:01:15', 0),
(94, 13, '2022-05-30 15:02:10', 0),
(95, 13, '2022-05-30 15:02:41', 0),
(96, 13, '2022-05-30 15:03:29', 0),
(97, 13, '2022-05-30 15:04:44', 0),
(98, 13, '2022-05-30 15:05:09', 0),
(99, 13, '2022-05-30 15:05:52', 0),
(100, 13, '2022-05-30 15:06:27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `producttbl`
--

CREATE TABLE `producttbl` (
  `ProductID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `ProductName` varchar(50) NOT NULL,
  `ProductDescription` varchar(255) DEFAULT NULL,
  `ProductPrice` decimal(15,2) NOT NULL,
  `ProductStock` int(11) NOT NULL,
  `ProductImage` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `producttbl`
--

INSERT INTO `producttbl` (`ProductID`, `CategoryID`, `ProductName`, `ProductDescription`, `ProductPrice`, `ProductStock`, `ProductImage`) VALUES
(4, 7, 'Spaghetti (Solo)', '1 regular platter of Spaghetti', '60.00', 0, 'spagh solo.jpg'),
(5, 7, 'Spaghetti With Rice And Chicken Meal', '1 regular platter of Spaghetti, 1 cup of rice, 1pc chicken', '150.00', 2, 'spagh meal.jpg'),
(6, 5, 'Set A', '2 pcs Chicken, 2pcs Spaghetti Regular, 2 pcs Cheese Burger, 2 Regular Drinks, 2 Regular Fries', '320.00', 19, 'Set A.png'),
(7, 5, 'Set B', '4 pcs Chicken, 4pcs Spaghetti Regular, 4 pcs Cheese Burger, 4 Regular Drinks, 2 Medium Fries, 4 Pcs Mashed Potato', '570.00', 15, 'Set B.png'),
(8, 5, 'Set C', '6 pcs Chicken, 6pcs Spaghetti Regular, 6 pcs Cheese Burger, 6 Regular Drinks, 3 Large Fries, 6pcs Burger steak, 6 pcs Mashed Potato', '780.00', 0, 'Set C.png'),
(9, 6, 'Burger Steak Meal', '1pc Burger steak, 1 cup of rice', '60.00', 1, 'Burger Steak.jpg'),
(10, 6, '1pc Chicken Meal', '1pc Chicken, 1 cup of rice', '120.00', 6, '1pc chicken.png'),
(11, 6, '1pc Spicy Chicken Meal', '1pc Spicy Chicken, 1 cup of rice', '130.00', 2, '1pc spicy chicken.png'),
(12, 6, '2pcs Chicken (Original) Meal', '2pcs chicken, 1 cup of rice, 1 regular drink', '180.00', 0, '2pcs chicken.jpg'),
(13, 3, 'Cheeseburger', '1pc beef burger patty, 1pc cheese, pickles, onions, mayo, and ketchup', '50.00', 0, 'cheeseburger.jpg'),
(14, 3, 'Double Patty Cheeseburger', '2pcs beef burger patties, 2pcs cheese, pickles,onions, mayo and ketchup', '90.00', 0, 'double cheeseburger.jpg'),
(15, 3, 'Bacon Cheeseburger', '   1pc beef burger patty, 2pcs bacon, cheese, mushrooms, mayo and ketchup', '110.00', 11, 'bacon mushroom.jpg'),
(16, 3, 'Crispy Chicken Burger', '1pc chicken,lettuce, onions, and our special house sauce', '65.00', 8, 'chicken burger.jpg'),
(17, 4, 'Chocolate Sundae', 'Ice cream sundae top with chocolate syrup', '30.00', 0, 'Chocolate.jpg'),
(18, 4, 'Strawberry Sundae', 'Ice cream sundae top with strawberry syrup', '30.00', 0, 'Strawberry.jpg'),
(19, 4, 'Caramel Sundae', 'Ice cream sundae top with caramel syrup', '30.00', 47, 'caramel.jpg'),
(20, 2, 'Iced Tea', 'Sweetened Lemon Iced Tea', '40.00', 77, 'Iced Tea.jpg'),
(21, 2, 'Sprite', 'Lemon-lime flavored soft drinks', '50.00', 0, 'Sprite.jpg'),
(22, 2, 'Coca Cola ', 'Carbonated, sweetened soft drinks', '50.00', 0, 'Cola.jpg'),
(23, 2, 'Pineapple Juice', 'Light sweetened pineapple juice', '40.00', 0, 'Pineapple.jpg'),
(24, 1, 'Fries', 'A thin strip of potatoes that are deep-fried until golden brown and crisp on the outside', '40.00', 0, 'fries.jpg'),
(25, 1, 'Mashed Potato', 'Dish made with potatoes, with added milk and butter', '75.00', 78, 'Mashed Potato.jpg'),
(26, 1, 'Gravy', 'Sauce made with juices of the meat and thickened with cornstarch or flour', '25.00', 90, 'Gravy.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admintbl`
--
ALTER TABLE `admintbl`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `categorytbl`
--
ALTER TABLE `categorytbl`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `customertbl`
--
ALTER TABLE `customertbl`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `favoritetbl`
--
ALTER TABLE `favoritetbl`
  ADD PRIMARY KEY (`FavoriteID`),
  ADD KEY `ProductID` (`ProductID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `orderdetailstbl`
--
ALTER TABLE `orderdetailstbl`
  ADD PRIMARY KEY (`OrderDetailsID`),
  ADD KEY `OrderID` (`OrderID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `ordertbl`
--
ALTER TABLE `ordertbl`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `producttbl`
--
ALTER TABLE `producttbl`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admintbl`
--
ALTER TABLE `admintbl`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categorytbl`
--
ALTER TABLE `categorytbl`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customertbl`
--
ALTER TABLE `customertbl`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `favoritetbl`
--
ALTER TABLE `favoritetbl`
  MODIFY `FavoriteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orderdetailstbl`
--
ALTER TABLE `orderdetailstbl`
  MODIFY `OrderDetailsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `ordertbl`
--
ALTER TABLE `ordertbl`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `producttbl`
--
ALTER TABLE `producttbl`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favoritetbl`
--
ALTER TABLE `favoritetbl`
  ADD CONSTRAINT `favoritetbl_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `producttbl` (`ProductID`),
  ADD CONSTRAINT `favoritetbl_ibfk_2` FOREIGN KEY (`CustomerID`) REFERENCES `customertbl` (`CustomerID`);

--
-- Constraints for table `orderdetailstbl`
--
ALTER TABLE `orderdetailstbl`
  ADD CONSTRAINT `orderdetailstbl_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `ordertbl` (`OrderID`),
  ADD CONSTRAINT `orderdetailstbl_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `producttbl` (`ProductID`);

--
-- Constraints for table `ordertbl`
--
ALTER TABLE `ordertbl`
  ADD CONSTRAINT `ordertbl_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customertbl` (`CustomerID`);

--
-- Constraints for table `producttbl`
--
ALTER TABLE `producttbl`
  ADD CONSTRAINT `producttbl_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `categorytbl` (`CategoryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
