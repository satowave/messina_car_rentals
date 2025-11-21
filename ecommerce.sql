SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'All Cars'),
(2, 'SUV'),
(3, 'Sports Car'),
(4, 'Sedan'),
(5, 'Luxury');

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `price` int(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`category_id`) REFERENCES `categories`(`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `products` (`id`, `name`, `price`, `category_id`, `image`) VALUES
(1, 'Fiat 500X Dolcevita', 80, 2, 'fb1.jpg'),
(2, 'Jeep Renegade Trailhawk', 85, 2, 'fb2.jpg'),
(3, 'Alfa Romeo Tonale Sprint', 100, 2, 'fb3.jpg'),
(4, 'Peugeot 3008 Allure', 110, 2, 'fb4.jpg'),
(5, 'Fiat Panda Cross 4x4', 120, 2, 'fb5.jpg'),
(6, 'Maserati Grecale GT', 130, 2, 'fb6.jpg'),
(7, 'Abarth 124 Spider Rallye', 200, 3, 'sp1.jpg'),
(8, 'Alfa Romeo 4C Launch', 220, 3, 'sp2.jpg'),
(9, 'Maserati MC20 Trofeo', 240, 3, 'sp3.jpg'),
(10, 'Ferrari Portofino M', 260, 3, 'sp4.jpg'),
(11, 'Lamborghini Huracán Evo', 280, 3, 'sp5.jpg'),
(12, 'Abarth 695 Tributo', 300, 3, 'sp6.jpg'),
(13, 'Fiat Tipo Life', 120, 4, 'sb1.jpg'),
(14, 'Lancia Ypsilon Hybrid', 135, 4, 'sb2.jpg'),
(15, 'Alfa Romeo Giulia Veloce', 150, 4, 'sb3.jpg'),
(16, 'Maserati Ghibli Modena', 170, 4, 'sb4.jpg'),
(17, 'Mercedes C-Class Avantgarde', 190, 4, 'sb5.jpg'),
(18, 'Audi A6 Quattro', 210, 4, 'sb6.jpg'),
(19, 'Maserati Quattroporte', 400, 5, 'ya1.jpg'),
(20, 'Ferrari Roma Sunset', 450, 5, 'ya2.jpg'),
(21, 'Bentley Continental GT', 500, 5, 'ya3.jpg'),
(22, 'Lamborghini Urus Modena', 550, 5, 'ya4.jpg'),
(23, 'Rolls-Royce Ghost Taormina', 600, 5, 'ya5.jpg'),
(24, 'Maybach S 580 Coastline', 650, 5, 'ya6.jpg'),
(25, 'Fiat 500X Dolcevita', 80, 1, 'fb1.jpg'),
(26, 'Jeep Renegade Trailhawk', 85, 1, 'fb2.jpg'),
(27, 'Alfa Romeo Tonale Sprint', 100, 1, 'fb3.jpg'),
(28, 'Peugeot 3008 Allure', 110, 1, 'fb4.jpg'),
(29, 'Fiat Panda Cross 4x4', 120, 1, 'fb5.jpg'),
(30, 'Maserati Grecale GT', 130, 1, 'fb6.jpg'),
(31, 'Abarth 124 Spider Rallye', 200, 1, 'sp1.jpg'),
(32, 'Alfa Romeo 4C Launch', 220, 1, 'sp2.jpg'),
(33, 'Maserati MC20 Trofeo', 240, 1, 'sp3.jpg'),
(34, 'Ferrari Portofino M', 260, 1, 'sp4.jpg'),
(35, 'Lamborghini Huracán Evo', 280, 1, 'sp5.jpg'),
(36, 'Abarth 695 Tributo', 300, 1, 'sp6.jpg'),
(37, 'Fiat Tipo Life', 120, 1, 'sb1.jpg'),
(38, 'Lancia Ypsilon Hybrid', 135, 1, 'sb2.jpg'),
(39, 'Alfa Romeo Giulia Veloce', 150, 1, 'sb3.jpg'),
(40, 'Maserati Ghibli Modena', 170, 1, 'sb4.jpg'),
(41, 'Mercedes C-Class Avantgarde', 190, 1, 'sb5.jpg'),
(42, 'Audi A6 Quattro', 210, 1, 'sb6.jpg'),
(43, 'Maserati Quattroporte', 400, 1, 'ya1.jpg'),
(44, 'Ferrari Roma Sunset', 450, 1, 'ya2.jpg'),
(45, 'Bentley Continental GT', 500, 1, 'ya3.jpg'),
(46, 'Lamborghini Urus Modena', 550, 1, 'ya4.jpg'),
(47, 'Rolls-Royce Ghost Taormina', 600, 1, 'ya5.jpg'),
(48, 'Maybach S 580 Coastline', 650, 1, 'ya6.jpg');

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_id` varchar(255) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `registration_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `rentals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `car_id` int(11) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('Booked','Confirmed') NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
  FOREIGN KEY (`car_id`) REFERENCES `products`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `expiry_date` decimal(10,2) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `card_number` varchar(16) NOT NULL,
  `cvv` varchar(3) NOT NULL,
  PRIMARY KEY (`payment_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `rentals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;
