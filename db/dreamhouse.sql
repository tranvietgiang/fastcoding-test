-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2026 at 09:50 AM
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
-- Database: `dreamhouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `published_date` varchar(80) NOT NULL,
  `category` varchar(80) NOT NULL,
  `title` varchar(180) NOT NULL,
  `description` text NOT NULL,
  `author` varchar(120) NOT NULL DEFAULT 'Mike Hesson',
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `published_date`, `category`, `title`, `description`, `author`, `sort_order`, `created_at`) VALUES
(1, '3 years ago', 'Rentals', 'How to rent a home very easily?', 'How to rent a home very easily in this pandemic situation. You can rent house through using our platfrom...', 'Mike Hesson', 0, '2026-06-23 04:43:14'),
(2, '3 years ago', 'Rentals', 'How to rent a home very easily?', 'How to rent a home very easily in this pandemic situation. You can rent house through using our platfrom...', 'Mike Hesson', 1, '2026-06-23 04:43:14'),
(3, '3 years ago', 'Rentals', 'How to rent a home very easily?', 'How to rent a home very easily in this pandemic situation. You can rent house through using our platfrom...', 'Mike Hesson', 2, '2026-06-23 04:43:14');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(180) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `featured_property_items`
--

CREATE TABLE `featured_property_items` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `price` varchar(80) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `featured_property_items`
--

INSERT INTO `featured_property_items` (`id`, `section_id`, `title`, `location`, `price`, `is_active`, `sort_order`, `created_at`) VALUES
(1, 1, 'The Stokes Appartment', 'Cleveland, United States', '$2,32,120', 1, 0, '2026-06-23 07:08:48'),
(2, 1, 'The Stokes Appartment', 'Cleveland, United States', '$2,32,120', 0, 1, '2026-06-23 07:08:48'),
(3, 1, 'The Stokes Appartment', 'Cleveland, United States', '$2,32,120', 0, 2, '2026-06-23 07:08:48');

-- --------------------------------------------------------

--
-- Table structure for table `featured_property_sections`
--

CREATE TABLE `featured_property_sections` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `button_text` varchar(120) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `featured_property_sections`
--

INSERT INTO `featured_property_sections` (`id`, `title`, `description`, `button_text`, `sort_order`, `created_at`) VALUES
(1, 'Featured Property', 'Find your suitable house here and stay safe and relaxe with pleasure', 'Explore Property', 0, '2026-06-23 07:08:48');

-- --------------------------------------------------------

--
-- Table structure for table `featured_property_tabs`
--

CREATE TABLE `featured_property_tabs` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `label` varchar(80) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `featured_property_tabs`
--

INSERT INTO `featured_property_tabs` (`id`, `section_id`, `label`, `is_active`, `sort_order`, `created_at`) VALUES
(1, 1, 'Appartment', 1, 0, '2026-06-23 07:08:48'),
(2, 1, 'Vila', 0, 1, '2026-06-23 07:08:48'),
(3, 1, 'Land', 0, 2, '2026-06-23 07:08:48');

-- --------------------------------------------------------

--
-- Table structure for table `living_features`
--

CREATE TABLE `living_features` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `living_features`
--

INSERT INTO `living_features` (`id`, `section_id`, `icon`, `title`, `description`, `sort_order`, `created_at`) VALUES
(1, 1, 'fa-solid fa-house-chimney', 'The perfect Residency', 'Take a deep dive and browse origin neighborhood photos.', 0, '2026-06-23 06:14:48'),
(2, 1, 'fa-solid fa-user-tie', 'Global Arhitect Experts', 'Take a deep dive and browse origin neighborhood photos.', 1, '2026-06-23 06:14:48'),
(3, 1, 'fa-solid fa-earth-americas', 'Built-in a storage capable', 'Take a deep dive and browse origin neighborhood photos.', 2, '2026-06-23 06:14:48');

-- --------------------------------------------------------

--
-- Table structure for table `living_sections`
--

CREATE TABLE `living_sections` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `rating` varchar(100) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `living_sections`
--

INSERT INTO `living_sections` (`id`, `title`, `description`, `rating`, `sort_order`, `created_at`) VALUES
(1, 'Dream Living Spaces Setting New Build', 'SeaWire Web is a wireframe kit that has more than 15 popular categories and more than 200 screens', '5 Star Rating', 0, '2026-06-23 06:14:48');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(80) NOT NULL,
  `area` varchar(80) NOT NULL,
  `title` varchar(180) NOT NULL,
  `address` varchar(255) NOT NULL,
  `price` varchar(80) NOT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `type`, `area`, `title`, `address`, `price`, `sort_order`, `created_at`) VALUES
(1, 'Apartment', '120 m2', 'Modern family apartment', 'District 1, Ho Chi Minh City', '$280,000', 0, '2026-06-23 04:43:14'),
(2, 'Office', '260 m2', 'Bright corporate office', 'Thu Duc City, Ho Chi Minh City', '$4,800/mo', 1, '2026-06-23 04:43:14'),
(3, 'House', '180 m2', 'Quiet urban townhouse', 'Binh Thanh, Ho Chi Minh City', '$395,000', 2, '2026-06-23 04:43:14');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `icon`, `sort_order`, `created_at`) VALUES
(1, 'Bed Rooms', 'Desktop publishing software like aldus page maker including', 'fa-solid fa-bed', 0, '2026-06-23 04:43:14'),
(2, 'Swimming pool', 'React creative agency amet, consec tetur adipiscing elit.', 'fa-solid fa-person-swimming', 1, '2026-06-23 04:43:14'),
(3, 'Copywriting content', 'The standard chunk of used since the 1500s is reproduced', 'fa-solid fa-pen-nib', 2, '2026-06-23 04:43:14'),
(4, 'Smart Home', 'The standard chunk of used since the 1500s is reproduced', 'fa-solid fa-house', 3, '2026-06-23 04:43:14'),
(5, 'Libarary area', 'Desktop publishing software like aldus page maker including', 'fa-solid fa-book-open', 4, '2026-06-23 04:43:14'),
(6, 'Responsive Duity', 'React creative agency amet, consec tetur adipiscing elit.', 'fa-solid fa-user-tag', 5, '2026-06-23 04:43:14');

-- --------------------------------------------------------

--
-- Table structure for table `today_sell_items`
--

CREATE TABLE `today_sell_items` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `today_sell_items`
--

INSERT INTO `today_sell_items` (`id`, `section_id`, `label`, `sort_order`, `created_at`) VALUES
(1, 1, 'Live Music concert at Newyork', 0, '2026-06-23 06:16:20'),
(2, 1, 'Our best boat Tour is j us t for you', 1, '2026-06-23 06:16:20'),
(3, 1, 'Live Music concert at Newyork', 2, '2026-06-23 06:16:20'),
(4, 1, 'Our best boat Tour is j us t for you', 3, '2026-06-23 06:16:20'),
(5, 1, 'Live Music concert at Newyork', 4, '2026-06-23 06:16:20');

-- --------------------------------------------------------

--
-- Table structure for table `today_sell_sections`
--

CREATE TABLE `today_sell_sections` (
  `id` int(11) NOT NULL,
  `eyebrow` varchar(120) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `today_sell_sections`
--

INSERT INTO `today_sell_sections` (`id`, `eyebrow`, `title`, `description`, `sort_order`, `created_at`) VALUES
(1, 'About home', 'Today Sells Properties', 'SeaWire Web is a wireframe kit that has more than 15 popular categories and more than 200 screens', 0, '2026-06-23 06:16:20');

-- --------------------------------------------------------

--
-- Table structure for table `today_sell_tabs`
--

CREATE TABLE `today_sell_tabs` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `label` varchar(80) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `today_sell_tabs`
--

INSERT INTO `today_sell_tabs` (`id`, `section_id`, `label`, `sort_order`, `created_at`) VALUES
(1, 1, 'HOUSE 1', 0, '2026-06-23 06:16:20'),
(2, 1, 'HOUSE 2', 1, '2026-06-23 06:16:20'),
(3, 1, 'HOUSE 3', 2, '2026-06-23 06:16:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `featured_property_items`
--
ALTER TABLE `featured_property_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `featured_property_sections`
--
ALTER TABLE `featured_property_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `featured_property_tabs`
--
ALTER TABLE `featured_property_tabs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `living_features`
--
ALTER TABLE `living_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `living_sections`
--
ALTER TABLE `living_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `today_sell_items`
--
ALTER TABLE `today_sell_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `today_sell_sections`
--
ALTER TABLE `today_sell_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `today_sell_tabs`
--
ALTER TABLE `today_sell_tabs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `featured_property_items`
--
ALTER TABLE `featured_property_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `featured_property_sections`
--
ALTER TABLE `featured_property_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `featured_property_tabs`
--
ALTER TABLE `featured_property_tabs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `living_features`
--
ALTER TABLE `living_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `living_sections`
--
ALTER TABLE `living_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `today_sell_items`
--
ALTER TABLE `today_sell_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `today_sell_sections`
--
ALTER TABLE `today_sell_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `today_sell_tabs`
--
ALTER TABLE `today_sell_tabs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
