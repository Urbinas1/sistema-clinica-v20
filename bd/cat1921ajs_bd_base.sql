-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 05, 2024 at 07:13 PM
-- Server version: 10.5.22-MariaDB-cll-lve
-- PHP Version: 8.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cat1921ajs_bd_base`
--

-- --------------------------------------------------------

--
-- Table structure for table `atCliente`
--

CREATE TABLE `atCliente` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'1',
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `atCliente`
--

INSERT INTO `atCliente` (`id`, `description`, `quantity`, `price`, `status`, `created`) VALUES
(5, 'SERVICIOS', 1000.00, 500.00, b'1', '0000-00-00 00:00:00'),
(6, 'COMIDAS', 1000.00, 200.00, b'1', '0000-00-00 00:00:00'),
(7, 'RECUPERACION', 1000.00, 1000.00, b'1', '0000-00-00 00:00:00'),
(17, 'HOSPEDAJE', 1000.00, 2000.00, b'1', '2024-03-24 03:12:08');

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'1',
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `description`, `quantity`, `price`, `status`, `created`) VALUES
(5, 'USO DE EMERGENCIA', 0.00, 400.00, b'0', '0000-00-00 00:00:00'),
(6, 'SERVICIO DE ENFERMERIA ', 0.00, 100.00, b'0', '0000-00-00 00:00:00'),
(7, 'HONORARIOS MEDICOS ATENCION EN LA EMERGENCIA', 0.00, 720.00, b'0', '0000-00-00 00:00:00'),
(8, 'EXAMENES DE LABORATORIO', 0.00, 435.00, b'0', '0000-00-00 00:00:00'),
(15, 'esto es una prueba de tipo de atencion', NULL, 2300.00, b'0', '2024-03-23 22:32:07'),
(16, 'esto es una prueba de tipo de atencion2', NULL, 33.00, b'0', '2024-03-24 00:28:35'),
(17, 'Cirugia', NULL, 2.00, b'0', '2024-03-24 03:13:15'),
(18, 'prueba', NULL, 2.00, b'0', '2024-03-24 03:14:52'),
(19, 'HABITACIÓN', NULL, 1200.00, b'1', '2024-05-23 00:10:56'),
(20, 'INGRESO', NULL, 300.00, b'1', '2024-05-23 00:11:26'),
(21, 'SERVICIO DE ENFERMERIA', NULL, 600.00, b'1', '2024-05-23 00:11:46'),
(22, 'HONORARIOS MÉDICOS DE GUARDIA', NULL, 600.00, b'1', '2024-05-23 00:12:17'),
(23, 'HONORARIOS MÉDICOS AYUDANTE', NULL, 8000.00, b'1', '2024-05-23 00:13:18');

-- --------------------------------------------------------

--
-- Table structure for table `facturas`
--

CREATE TABLE `facturas` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `status` bit(1) NOT NULL DEFAULT b'1',
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `clienteId` int(11) NOT NULL DEFAULT 0,
  `doctor1id` int(11) NOT NULL DEFAULT 0,
  `doctor2id` int(11) NOT NULL DEFAULT 0,
  `tipoFactura` int(11) NOT NULL DEFAULT 0,
  `copago` int(11) NOT NULL DEFAULT 0,
  `cat1` bit(1) NOT NULL DEFAULT b'0',
  `cat2` bit(1) NOT NULL DEFAULT b'0',
  `cat3` bit(1) NOT NULL DEFAULT b'0',
  `cat4` bit(1) NOT NULL DEFAULT b'0',
  `cat5` bit(1) NOT NULL DEFAULT b'0',
  `tasaDesc` decimal(10,2) NOT NULL DEFAULT 0.00,
  `descOtros` decimal(10,2) NOT NULL DEFAULT 0.00,
  `copago2` decimal(10,2) NOT NULL,
  `deducible` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facturas`
--

INSERT INTO `facturas` (`id`, `description`, `quantity`, `price`, `status`, `created`, `clienteId`, `doctor1id`, `doctor2id`, `tipoFactura`, `copago`, `cat1`, `cat2`, `cat3`, `cat4`, `cat5`, `tasaDesc`, `descOtros`, `copago2`, `deducible`) VALUES
(16, '1', 0.00, 0.00, b'0', '2024-05-16 17:58:08', 4, 2, 3, 2, 1, b'1', b'1', b'1', b'1', b'1', 15.00, 30.00, 25.00, 160.00),
(29, '1', NULL, NULL, b'0', '2024-05-16 18:58:08', 37, 36, 0, 1, 1, b'0', b'1', b'1', b'0', b'0', 22.00, 60.00, 0.00, 0.00),
(30, '1', NULL, NULL, b'0', '2024-05-21 15:00:28', 34, 36, 38, 2, 1, b'1', b'0', b'0', b'0', b'0', 20.00, 0.00, 0.00, 0.00),
(31, '1', NULL, NULL, b'0', '2024-05-21 15:39:41', 33, 36, 38, 1, 1, b'1', b'1', b'0', b'0', b'0', 5.00, 30.00, 0.00, 0.00),
(35, '1', NULL, NULL, b'0', '2024-05-21 21:34:44', 4, 36, 38, 1, 0, b'1', b'1', b'0', b'0', b'0', 0.00, 0.00, 3.00, 100.00),
(36, '1', NULL, NULL, b'0', '2024-05-22 03:35:43', 37, 36, 0, 2, 0, b'1', b'1', b'0', b'0', b'0', 20.00, 0.00, 0.00, 0.00),
(37, '1', NULL, NULL, b'0', '2024-05-22 03:36:57', 33, 36, 0, 1, 0, b'1', b'0', b'0', b'0', b'0', 0.00, 0.00, 0.00, 0.00),
(38, '1', NULL, NULL, b'0', '2024-05-22 03:38:49', 33, 36, 0, 0, 0, b'1', b'0', b'0', b'0', b'0', 0.00, 0.00, 0.00, 0.00),
(39, '1', NULL, NULL, b'0', '2024-05-22 03:42:26', 34, 36, 0, 2, 0, b'0', b'1', b'0', b'0', b'0', 0.00, 0.00, 0.00, 0.00),
(40, '1', NULL, NULL, b'0', '2024-05-22 03:43:15', 37, 36, 0, 0, 1, b'1', b'0', b'0', b'0', b'0', 20.00, 5.00, 0.00, 0.00),
(41, '1', NULL, NULL, b'0', '2024-05-22 04:17:03', 86, 36, 0, 1, 1, b'1', b'1', b'0', b'0', b'0', 20.00, 10.00, 0.00, 0.00),
(43, '1', NULL, NULL, b'0', '2024-05-22 05:56:21', 33, 36, 38, 2, 1, b'1', b'1', b'0', b'0', b'0', 20.00, 80.00, 0.00, 0.00),
(44, '1', NULL, NULL, b'0', '2024-06-16 15:08:01', 33, 36, 0, 1, 1, b'0', b'1', b'0', b'0', b'0', 52.00, 20.00, 0.00, 0.00),
(45, '1', NULL, NULL, b'0', '2024-06-16 15:09:36', 33, 36, 0, 0, 0, b'1', b'0', b'0', b'0', b'0', 20.00, 10.00, 0.00, 0.00),
(47, '1', NULL, NULL, b'0', '2024-06-17 02:20:11', 33, 36, 0, 0, 1, b'1', b'1', b'1', b'0', b'0', 20.00, 10.00, 0.00, 0.00),
(48, '1', NULL, NULL, b'0', '2024-07-20 06:47:35', 33, 36, 0, 1, 1, b'0', b'0', b'1', b'1', b'0', 5.00, 23.00, 3.00, 162.00),
(49, '1', NULL, NULL, b'0', '2024-07-21 18:30:33', 33, 36, 0, 2, 1, b'1', b'0', b'0', b'0', b'1', 10.00, 50.00, 7.00, 0.00),
(50, '1', NULL, NULL, b'0', '2024-07-29 10:57:27', 33, 36, 38, 1, 0, b'1', b'0', b'0', b'0', b'0', 0.00, 0.00, 25.00, 1300.00),
(52, '1', NULL, NULL, b'1', '2024-08-03 22:55:12', 86, 38, 0, 2, 0, b'1', b'1', b'1', b'1', b'1', 0.00, 0.00, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `facturasdetalles`
--

CREATE TABLE `facturasdetalles` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `precioP` decimal(10,2) NOT NULL,
  `cp` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facturasdetalles`
--

INSERT INTO `facturasdetalles` (`id`, `description`, `quantity`, `price`, `status`, `created`, `precioP`, `cp`) VALUES
(103, '16', 1.00, 5.00, 1, '2024-05-16 18:19:41', 400.00, 0.00),
(104, '16', 1.00, 6.00, 1, '2024-05-16 18:19:57', 100.00, 0.00),
(105, '16', 1.00, 7.00, 1, '2024-05-16 18:20:12', 720.00, 500.00),
(106, '16', 1.00, 8.00, 1, '2024-05-16 18:20:33', 300.00, 50.00),
(107, '16', 3.00, 12.00, 0, '2024-05-16 18:21:31', 0.00, 0.00),
(108, '16', 1.00, 11.00, 0, '2024-05-16 18:21:39', 0.00, 0.00),
(109, '16', 1.00, 5.00, 0, '2024-05-16 18:21:47', 0.00, 0.00),
(110, '16', 1.00, 6.00, 0, '2024-05-16 18:21:59', 0.00, 800.00),
(111, '16', 1.00, 7.00, 0, '2024-05-16 18:22:04', 0.00, 0.00),
(112, '16', 1.00, 8.00, 0, '2024-05-16 18:22:11', 0.00, 0.00),
(113, '16', 1.00, 9.00, 0, '2024-05-16 18:22:21', 0.00, 0.00),
(114, '16', 1.00, 10.00, 0, '2024-05-16 18:22:31', 0.00, 0.00),
(120, '29', 1.00, 7.00, 0, '2024-05-20 17:49:09', 0.00, 0.00),
(121, '29', 1.00, 6.00, 0, '2024-05-20 17:52:53', 0.00, 0.00),
(122, '30', 1.00, 8.00, 1, '2024-05-21 15:34:43', 435.00, 100.00),
(123, '30', 1.00, 6.00, 1, '2024-05-21 15:34:47', 100.00, 20.00),
(124, '30', 1.00, 5.00, 1, '2024-05-21 15:34:55', 400.00, 100.00),
(126, '35', 1.00, 6.00, 1, '2024-05-22 00:54:47', 100.00, 0.00),
(127, '35', 1.00, 7.00, 1, '2024-05-22 00:54:51', 720.00, 0.00),
(128, '35', 1.00, 6.00, 0, '2024-05-22 00:55:01', 0.00, 0.00),
(129, '35', 1.00, 7.00, 1, '2024-05-22 01:00:18', 720.00, 0.00),
(130, '35', 1.00, 9.00, 0, '2024-05-22 03:35:36', 0.00, 50.00),
(131, '36', 1.00, 5.00, 1, '2024-05-22 03:36:33', 400.00, 0.00),
(132, '36', 1.00, 5.00, 0, '2024-05-22 03:36:41', 0.00, 0.00),
(133, '37', 1.00, 5.00, 1, '2024-05-22 03:38:42', 400.00, 0.00),
(134, '38', 1.00, 5.00, 1, '2024-05-22 03:41:16', 400.00, 0.00),
(135, '39', 1.00, 8.00, 0, '2024-05-22 03:42:45', 0.00, 0.00),
(136, '40', 1.00, 5.00, 1, '2024-05-22 04:16:32', 400.00, 0.00),
(137, '41', 1.00, 5.00, 1, '2024-05-22 04:24:51', 400.00, 0.00),
(138, '41', 1.00, 6.00, 1, '2024-05-22 04:53:09', 100.00, 0.00),
(139, '41', 1.00, 7.00, 0, '2024-05-22 04:54:33', 0.00, 0.00),
(140, '41', 2.00, 5.00, 0, '2024-05-22 05:04:49', 0.00, 0.00),
(141, '41', 1.00, 9.00, 0, '2024-05-22 05:54:25', 0.00, 0.00),
(143, '41', 1.00, 17.00, 1, '2024-05-22 05:54:46', 2.00, 0.00),
(144, '41', 1.00, 7.00, 1, '2024-05-22 05:54:57', 720.00, 0.00),
(145, '41', 1.00, 8.00, 0, '2024-05-22 05:56:44', 0.00, 0.00),
(147, '41', 4.00, 10.00, 0, '2024-05-22 06:01:55', 0.00, 0.00),
(148, '31', 1.00, 21.00, 1, '2024-05-23 00:14:50', 600.00, 100.00),
(149, '31', 1.00, 5.00, 0, '2024-05-23 00:19:47', 0.00, 10.00),
(152, '31', 1.00, 22.00, 1, '2024-05-23 00:47:32', 600.00, 100.00),
(176, '43', 1.00, 21.00, 1, '2024-05-31 04:47:42', 1001.00, 0.00),
(177, '43', 1.00, 19.00, 1, '2024-05-31 05:47:58', 222.00, 0.00),
(179, '43', 1.00, 20.00, 1, '2024-05-31 06:29:52', 301.00, 0.00),
(183, '43', 1.00, 5.00, 0, '2024-06-16 15:07:02', 0.00, 0.00),
(185, '45', 1.00, 20.00, 1, '2024-06-17 02:18:16', 150.00, 0.00),
(200, '47', 1.00, 19.00, 1, '2024-06-24 03:22:37', 1200.00, 0.00),
(201, '47', 1.00, 5.00, 0, '2024-06-24 03:22:41', 0.00, 0.00),
(202, '47', 1.00, 5.00, 3, '2024-06-24 03:22:46', 0.00, 0.00),
(203, '47', 1.00, 6.00, 3, '2024-06-24 03:45:00', 0.00, 0.00),
(218, '48', 1.00, 7.00, 3, '2024-07-21 17:50:50', 0.00, 100.00),
(220, '48', 3.00, 6.00, 3, '2024-07-21 23:38:42', 0.00, 200.00),
(231, '49', 1.00, 19.00, 1, '2024-07-29 10:24:53', 1200.00, 0.00),
(246, '50', 1.00, 19.00, 1, '2024-08-02 06:45:35', 165000.00, 77000.00),
(250, '50', 1.00, 20.00, 1, '2024-08-02 07:24:40', 535.00, 400.00),
(255, '48', 1.00, 1.00, 4, '2024-08-03 21:46:18', 0.00, 0.00),
(257, '49', 1.00, 19.00, 1, '2024-08-03 21:58:17', 1200.00, 0.00),
(258, '49', 1.00, 19.00, 1, '2024-08-03 22:04:15', 1200.00, 0.00),
(259, '52', 1.00, 23.00, 1, '2024-08-03 23:02:16', 8000.00, 0.00),
(260, '52', 1.00, 5.00, 0, '2024-08-03 23:03:03', 0.00, 0.00),
(261, '52', 1.00, 5.00, 3, '2024-08-03 23:03:09', 0.00, 0.00),
(262, '52', 1.00, 2.00, 4, '2024-08-03 23:04:48', 0.00, 0.00),
(263, '52', 1.00, 2.00, 5, '2024-08-03 23:06:48', 500.00, 0.00),
(266, '16', 1.00, 1.00, 5, '2024-08-05 02:29:05', 90.00, 20.00);

-- --------------------------------------------------------

--
-- Table structure for table `hospitalizacion`
--

CREATE TABLE `hospitalizacion` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'1',
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospitalizacion`
--

INSERT INTO `hospitalizacion` (`id`, `description`, `quantity`, `price`, `status`, `created`) VALUES
(1, 'hospitalizacion 1', 100.00, 100.00, b'1', '0000-00-00 00:00:00'),
(2, 'hospitalizacion 2', 500.00, 500.00, b'1', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `materiales`
--

CREATE TABLE `materiales` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'1',
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materiales`
--

INSERT INTO `materiales` (`id`, `description`, `quantity`, `price`, `status`, `created`) VALUES
(1, 'material 1', 1.00, 150.00, b'1', '0000-00-00 00:00:00'),
(2, 'material 2', 1.00, 100.00, b'1', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `medicinas`
--

CREATE TABLE `medicinas` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'1',
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicinas`
--

INSERT INTO `medicinas` (`id`, `description`, `quantity`, `price`, `status`, `created`) VALUES
(5, 'SSN AL 0.9% DE 500ML', 1000.00, 50.00, b'1', '0000-00-00 00:00:00'),
(6, 'NEXIUM 		\n', 1000.00, 850.00, b'1', '0000-00-00 00:00:00'),
(7, 'PARACONICA		\n', 1000.00, 390.00, b'1', '0000-00-00 00:00:00'),
(8, 'DRAMANYL		\n', 1000.00, 120.00, b'1', '0000-00-00 00:00:00'),
(9, 'CEFTRIAXONA\n', 1000.00, 300.00, b'1', '0000-00-00 00:00:00'),
(10, 'CATETER\n', 1000.00, 30.00, b'1', '0000-00-00 00:00:00'),
(11, 'VENOCLISIS		\n', 1000.00, 30.00, b'1', '2024-03-22 11:12:53'),
(12, 'JERINGAS DE 20CC', 1000.00, 20.00, b'1', '2024-03-22 11:15:46'),
(15, 'producto prueba', 100.00, 33.55, b'0', '2024-03-24 01:11:10'),
(16, 'segundo mediamento de prueba', 10.00, 200.00, b'0', '2024-03-24 01:11:54'),
(17, 'panadoles', 1.00, 1.00, b'0', '2024-03-24 03:12:08');

-- --------------------------------------------------------

--
-- Table structure for table `modulo_base`
--

CREATE TABLE `modulo_base` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'1',
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modulo_base`
--

INSERT INTO `modulo_base` (`id`, `description`, `quantity`, `price`, `status`, `created`) VALUES
(5, '[value-2]', 0.00, 0.00, b'1', '0000-00-00 00:00:00'),
(6, '[value-2]', 0.00, 0.00, b'1', '0000-00-00 00:00:00'),
(7, '[value-2]', 0.00, 0.00, b'1', '0000-00-00 00:00:00'),
(8, '[value-2]', 0.00, 0.00, b'1', '0000-00-00 00:00:00'),
(9, '[value-2]', 0.00, 0.00, b'1', '0000-00-00 00:00:00'),
(10, '[value-2]', 0.00, 0.00, b'1', '0000-00-00 00:00:00'),
(11, 'aaaa', 3.00, 33.55, b'1', '2024-03-22 11:12:53'),
(12, 'bbb', 8.00, 99.22, b'1', '2024-03-22 11:15:46'),
(13, 'ccc', 2.00, 123.98, b'1', '2024-03-22 12:01:01'),
(14, 'fff', 45.00, 78.32, b'1', '2024-03-22 12:01:15'),
(15, 'esto es una prueba de tipo de atencion', 0.00, 1000.00, b'1', '2024-03-23 22:14:56'),
(16, 'esto es una prueba de tipo de atencion', 0.00, 1000.00, b'1', '2024-03-23 22:15:06'),
(17, 'esto es una prueba de tipo de atencion', 0.00, 1000.00, b'1', '2024-03-23 22:23:30'),
(18, 'esto es una prueba de tipo de atencion', 0.00, 1000.00, b'1', '2024-03-23 22:26:48'),
(19, 'esto es una prueba de tipo de atencion', 0.00, 1000.00, b'1', '2024-03-23 22:28:52');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `status` bit(1) NOT NULL DEFAULT b'1',
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `poliza` varchar(150) NOT NULL,
  `certificado` varchar(150) NOT NULL,
  `password` text DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `docId` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `description`, `quantity`, `price`, `status`, `created`, `poliza`, `certificado`, `password`, `username`, `photo`, `docId`) VALUES
(1, 'Danilo B. Vivas', 1.00, 0.00, b'0', '2024-04-01 07:03:10', 'n/a', '+50589065522', '$2y$10$vU/mwnqNNu5uM9BKl5lp7eNQSvfXf2Rliv6UV.YHF0yMfr1/Gsk62', 'admin', 'danilo.jpg', NULL),
(2, 'DR. MAURICIO BAQUEDANO', 2.00, 0.00, b'0', '2024-04-01 07:03:10', 'MEDICO GENERAL: ', '88224455', '', '', NULL, NULL),
(3, 'DR. ANDI CRUZ', 2.00, 0.00, b'0', '2024-04-01 07:03:10', 'MEDICO GENERAL', '12358922', '', '', NULL, NULL),
(4, 'DIEGO JOAQUIN ORTIZ', 3.00, 0.00, b'0', '0000-00-00 00:00:00', 'POL2501', 'CER2501', '', '', NULL, '123-123456-1234F'),
(30, 'catuses', 1.00, NULL, b'0', '2024-04-08 05:24:50', 'INSS-147147', 'CER2501', '$2y$10$vU/mwnqNNu5uM9BKl5lp7eNQSvfXf2Rliv6UV.YHF0yMfr1/Gsk62', 'lapto2006', 'Captura de pantalla 2024-02-13 020429.png', '123-123456-12TEST'),
(31, 'Cinthia ', 1.00, NULL, b'0', '2024-04-10 18:54:26', 'Seguros', 'Jtyih', '$2y$10$MTj6Oy0y7PAshKc159Wv8.fKkaO1z7K99oPMeawTzO8sNN017qkNS', 'Cinthia ', 'userF.png', NULL),
(32, 'Cinthia ', 1.00, NULL, b'0', '2024-04-10 18:54:26', 'Seguros', 'Jtyih', '$2y$10$dmlx47HpxEVrSL/DrJKS7OJzSYQADPINJ0Adxr2GMfeR0/8O2gy3G', 'Cinthia ', 'userF.png', NULL),
(33, 'JUAN PACIENTE PRUEBAS', 3.00, NULL, b'1', '2024-05-10 08:32:42', 'SEGUROS CATUSES SA', 'CERT345BAC', NULL, NULL, 'NewrF.jpg', '455-SASD-4566'),
(34, 'maria cliente prueba', 3.00, NULL, b'1', '2024-05-11 00:18:50', 'SEGUROS NUEVA OPORTUNIDAD', '45544445', '$2y$10$LgybscB6WVh/TStYgJ78sukeQN8J2gQPsD9CFJd8PjmgR5m19gPeq', 'maria', 'userF2.jpg', NULL),
(36, 'Medico General: DR. MAURICIO BAQUEDANO', 2.00, NULL, b'1', '2024-05-11 17:51:26', 'MEDICO GENERAL', '2', NULL, NULL, NULL, NULL),
(37, 'DIEGO JUAQUIN ORTIZ', 3.00, NULL, b'1', '2024-05-11 20:36:25', 'SEGUROS ATLANTIDA', '', NULL, NULL, NULL, '17071981004960'),
(38, 'Medico General: DR. ANDI CRUZ', 2.00, NULL, b'1', '2024-05-11 20:39:43', 'Medico General', '5', NULL, NULL, NULL, NULL),
(39, 'Cinthia', 1.00, NULL, b'0', '2024-05-12 01:13:57', 'secretaria', '8888', '$2y$10$VX10hXjMdhzkaPOOPlJ5UOAkQxPeZYyrcNLqs09X42ufLCRgPl.Im', 'Cinthia ', 'd4dec1f1-253f-4a98-87ea-fcc35c29875f.jpeg', NULL),
(40, 'Cinthia', 1.00, NULL, b'0', '2024-05-12 01:13:57', 'secretaria', '8888', '$2y$10$0IzOm57ISb8tBPZxGfmyI.OVjXSKnToKgG8RfIoiC4ncyuZFkSOHm', 'Cinthia ', 'd4dec1f1-253f-4a98-87ea-fcc35c29875f.jpeg', NULL),
(41, 'Cinthia', 1.00, NULL, b'0', '2024-05-12 01:13:58', 'secretaria', '8888', '$2y$10$dFTNqjpIUPNu2dqRoNRuo.okP/jLmdTBRqwg1n/Zz828UQxpMf0gS', 'Cinthia ', 'd4dec1f1-253f-4a98-87ea-fcc35c29875f.jpeg', NULL),
(42, 'Cinthia', 1.00, NULL, b'0', '2024-05-12 01:15:50', '', '', '$2y$10$Y8qjyKo2vpoCaMSAUjReqegWU9Q41La6BnVCx/q12Ef9xleXnULHO', 'Cinthia', '', NULL),
(43, 'Cinthia', 1.00, NULL, b'1', '2024-05-12 01:15:54', '', '', '$2y$10$c3IzCN9v0MOTGm5gUer4N.1L.h4bKiYqaSostwYaXimSwnSioxp72', 'Cinthia', '', NULL),
(44, 'Cinthia', 1.00, NULL, b'1', '2024-05-12 01:16:03', '', '', '$2y$10$yZtBUOLK.GPwu9WxaTIESejGuQd429oMzdP1iPWy9NHCQqSQ1DmFa', 'Cinthia', '', NULL),
(45, 'Cinthia', 1.00, NULL, b'0', '2024-05-12 01:16:07', '', '', '$2y$10$dXQk0KGJUTTRc3q187jaHu3OQLEtj7Ck4zcoDoCvNVoWxv.qivqw2', 'Cinthia', '', NULL),
(46, 'Cinthia', 1.00, NULL, b'0', '2024-05-12 01:16:09', '', '', '$2y$10$SFoz5wFk0o4ikMOXTiUMOOCd96.5z7uj5oFnMmUBSxbO/nujqcNVK', 'Cinthia', '', NULL),
(47, 'Cinthia', 1.00, NULL, b'0', '2024-05-12 01:16:10', '', '', '$2y$10$JHfemS7A1HD3kkKFWajJd.r4YgSZ0oF0AN/mbrnK6CjcFdJEkjIyG', 'Cinthia', '', NULL),
(48, 'Cinthia', 1.00, NULL, b'0', '2024-05-12 01:16:10', '', '', '$2y$10$4SOEtqHDtqvSG1A8u8wCou34s.dDCv9Gpu3TllJ2wt1lO5bdRc3bq', 'Cinthia', '', NULL),
(49, 'Cinthia', 1.00, NULL, b'0', '2024-05-12 01:16:12', '', '', '$2y$10$SNJMkEn8NbM9KxUiPScWCOWVu7Kei6icjTV2xRPs6zp2zhnr9GiDC', 'Cinthia', '', NULL),
(50, 'Cinthia', 1.00, NULL, b'0', '2024-05-12 01:16:12', '', '', '$2y$10$zqjippz4xl0tWOlKTLzEdO5rbS6qCDPFMCGLCsgFSN.1k6kJa/3xi', 'Cinthia', '', NULL),
(51, 'Cinthia', 1.00, NULL, b'0', '2024-05-12 01:16:14', '', '', '$2y$10$ENEq/3KG8KPEaQmCQZSiq.jNiL2N/hl7dMw45d.xkS8RUOlpfc3Ui', 'Cinthia', '', NULL),
(52, 'Cinthia', 1.00, NULL, b'1', '2024-05-12 01:16:14', '', '', '$2y$10$JaeBwD..Sl30ubRlwGsxE.JZoBeaqrHSCr00S8hwK2EDjsCmDO4Cm', 'Cinthia', '', NULL),
(53, 'Cinthia', 1.00, NULL, b'1', '2024-05-12 01:16:19', '', '', '$2y$10$JIwiMh1jWITicGlV8q5mmOURKOXMljzesP0J/0GPb6VFLYI/OYfA6', 'Cinthia', '', NULL),
(54, 'Cinthia', 1.00, NULL, b'0', '2024-05-12 01:16:19', '', '', '$2y$10$yd8jRUmI/Kcpkg1w2mKZn.tZsqxNLgSNG.wqjLeGK789NAZAwY/Da', 'Cinthia', '', NULL),
(55, 'Cinthia', 1.00, NULL, b'0', '2024-05-12 01:16:20', '', '', '$2y$10$phAxhUYFPUWPWRi97IVJfeY4HsucPHT6SciMsktCpY6D/SmUn1t2q', 'Cinthia', '', NULL),
(56, 'Cinthia', 1.00, NULL, b'0', '2024-05-12 01:16:27', 'J', 'J', '$2y$10$jHFCjDTG38823CHr6EoG6OKkw4ec7.7KFMKp8Y5aj27ii8gWaMQ02', 'Cinthia', '', NULL),
(57, 'Cinthia', 1.00, NULL, b'0', '2024-05-12 01:16:34', 'J', 'J', '$2y$10$X10qnhNHrHwBx151AzqG2u83288GTE2VSXmjsKl4mg0azLLDVAIXS', 'Cinthia', '', NULL),
(58, 'Cinthia', 1.00, NULL, b'0', '2024-05-12 01:16:40', 'J', 'J', '$2y$10$3/NdlsaZEbW8FCArgFgyK.kyJ4Xg1b9bAPev1Kyn4tE/AGJh7yLOG', 'Cinthia', '', NULL),
(59, 'Cinthia', 1.00, NULL, b'1', '2024-05-12 01:16:45', 'J', 'J', '$2y$10$2mPfX2csOgmDeYYQGtk0teXrwkb5UVhQ2.mAplA72cdQ826XBlvr.', 'Cinthia', '', NULL),
(60, 'Cinthia', 1.00, NULL, b'1', '2024-05-12 01:16:57', 'J', 'J', '$2y$10$vpjtjJtedvhXEVaKcLP5dO45gCsnirnUtBUrKwIwXn.sThswr9qbi', 'Cinthia', '', NULL),
(61, 'Cinthia', 1.00, NULL, b'1', '2024-05-12 01:16:58', 'J', 'J', '$2y$10$cvkErIvsowB1uy0aqp1pNeAQpYV.5EwZpL/oabUAYAezZdGqn5V0e', 'Cinthia', '', NULL),
(62, 'Cinthia', 1.00, NULL, b'1', '2024-05-12 01:16:59', 'J', 'J', '$2y$10$ZyQIjjPu4ikNY78wgLK7kumrOwTpuiqqVvGGwtdN6pkdL9lHl3S9O', 'Cinthia', '', NULL),
(63, 'Cinthia', 1.00, NULL, b'1', '2024-05-12 01:17:09', 'J', 'J', '$2y$10$D2XgFlmX2TjSHgMhkfGEdOMwpZWnf2xQHS69O7bIptA8rAIU2VzQ6', 'Cinthia', '', NULL),
(64, 'Cinthia', 1.00, NULL, b'1', '2024-05-12 01:17:10', 'J', 'J', '$2y$10$D/uWfW7vFXnd14Pf.OXHr.yGyZzJM1C59W9WER8wB9JgWKvQCYAQi', 'Cinthia', '', NULL),
(65, 'Cinthia', 1.00, NULL, b'1', '2024-05-12 01:17:11', 'J', 'J', '$2y$10$SL7nOXESIM0aSa.yaDZ/7.0jP99MoPFxCXMpVIG9QiFZEzfu8znLW', 'Cinthia', '', NULL),
(66, 'Cinthia', 1.00, NULL, b'1', '2024-05-12 01:17:12', 'J', 'J', '$2y$10$t5xlcZHE.SU847gfIOoQ/Oq5mORe8EBUOcT9ge32.QQM6dKvm/JA2', 'Cinthia', '', NULL),
(67, 'Cinthia', 1.00, NULL, b'1', '2024-05-12 01:17:12', 'J', 'J', '$2y$10$oAs9eqRD/UMVTyVt.V2NC.sQoCIZTq7KCC9WoH9xnpcg28scTyRyG', 'Cinthia', '', NULL),
(68, 'Cinthia', 1.00, NULL, b'1', '2024-05-12 01:17:23', 'J', 'J', '$2y$10$/grc.aFz8bWd8vhwcS.EGuyj1UPQ9Zio1OYmwLTg.jPBX3JCfWOTu', 'Cinthia', '', NULL),
(69, 'Cinthia', 1.00, NULL, b'1', '2024-05-12 01:17:24', 'J', 'J', '$2y$10$ykC4g11vZR5XonkAwtaoGeYty6.FVdK17K5iw/SR.1RXdx/dijMES', 'Cinthia', '', NULL),
(70, 'Cinthia', 1.00, NULL, b'1', '2024-05-12 01:17:24', 'J', 'J', '$2y$10$5iJk8cJ.Irk79hJSZk4aOe3Q9ziVu/33nwbXscJ8OTUxU3jHkVDfm', 'Cinthia', '', NULL),
(71, 'Cinthia', 1.00, NULL, b'1', '2024-05-12 01:17:26', 'J', 'J', '$2y$10$OC76fzvvSxCzgCpaUxHC2ObCXXKtOSSA9BE5So4ih0inpmIp2JxBe', 'Cinthia', '', NULL),
(72, 'Cinthia', 1.00, NULL, b'1', '2024-05-12 01:17:28', 'J', 'J', '$2y$10$g3UrwYO.uhRbUD..6QGdzO5Xu1/4a3bjJoks797HtEaHk9k6ct55K', 'Cinthia', '', NULL),
(73, 'Cinthia', 1.00, NULL, b'1', '2024-05-12 01:17:29', 'J', 'J', '$2y$10$eXmZ48tNpsLYJXyFwKvhP.j6OXMOF0Ksdq..pKi0s2acnLBhvhS72', 'Cinthia', '', NULL),
(74, 'Cine', 1.00, NULL, b'1', '2024-05-12 01:24:39', 'K', 'J', '$2y$10$gpxdoCfUnkangW60DFx5.eTWrZfBbXdVnzRezF3fm0xLcHkglJ/Xi', 'I', '', NULL),
(75, 'Cine', 1.00, NULL, b'1', '2024-05-12 01:24:41', 'K', 'J', '$2y$10$x.4anTmeGlp42rBzcZICZe36Cg.kYGG5agzP12i2XNjFeMJqRLNOK', 'I', '', NULL),
(76, 'Cine', 1.00, NULL, b'1', '2024-05-12 01:24:48', 'K', 'J', '$2y$10$nnsVYPpjl3EhO0I.GX.X5eV2HPWtdp488s55LSLwMJ4YwQOCYe//m', 'I', '', NULL),
(77, 'Cine', 1.00, NULL, b'1', '2024-05-12 01:24:49', 'K', 'J', '$2y$10$3c8WDs3oyxMpIrnc4vZ5V.kD4H0vfS.vxZfCbhOXiMY/HHhZBO8Fu', 'I', '', NULL),
(78, 'Cine', 1.00, NULL, b'1', '2024-05-12 01:24:49', 'K', 'J', '$2y$10$pouIs7Ki1WRmjvGrHhjHTuWcxLoxfUgMBy5UIDHe7A7Wdoix3mglS', 'I', '', NULL),
(79, 'J', 1.00, NULL, b'1', '2024-05-12 03:36:39', 'J', '8', '$2y$10$reIShisvCBNXQPanpipFQOvsNWIHIKmk.5ZxGMSbciUmuX9w0NWK6', 'Jose', '', NULL),
(80, 'J', 1.00, NULL, b'1', '2024-05-12 03:36:49', 'J', '8', '$2y$10$faS6C1sLwE3nJGyBWiWcpeHb10TfmIl.kCYdwinqkEWLGImfGLFuq', 'Jose', '', NULL),
(81, 'J', 1.00, NULL, b'1', '2024-05-12 03:36:51', 'J', '8', '$2y$10$qzC3T1tjV.QoX7fP2Z2T7u4d/fmLcBuH6cVOvKA.yx2RepxeB2Ur6', 'Jose', '', NULL),
(82, 'J', 1.00, NULL, b'0', '2024-05-12 03:36:51', 'J', '8', '$2y$10$BT3PQNdWDSJ1VRELcl4WNuV85bSvnsxJ0SEHtg4lcsVFAUtd8FdQO', 'Jose', '', NULL),
(83, 'J', 1.00, NULL, b'0', '2024-05-12 03:36:54', 'J', '8', '$2y$10$Rjaea5M3q1VYc1SGeDgqJ.CqRZqwyRPUr05U/299kToLlMrpLcgNS', 'Jose', '', NULL),
(84, 'J', 1.00, NULL, b'0', '2024-05-12 03:36:54', 'J', '8', '$2y$10$iAl7GKpFLDnbFEUYjZMOpe5nCAGvEOSDw/ZMVybcqNmkhpSVOz5Kq', 'Jose', '', NULL),
(85, 'Alfredo ', 1.00, NULL, b'1', '2024-05-12 04:12:56', 'U', '9', '$2y$10$v5/HiiRGkW6NgUv4fkoK8.Vths1XnRTORsYi0.lMnhyezzfGgI7FG', 'Alfredo', '', NULL),
(86, 'Jose urbina', 3.00, NULL, b'1', '2024-05-22 04:23:23', 'Seguros Atlantida', 'Hsiwn', NULL, NULL, NULL, '0601199703679');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atCliente`
--
ALTER TABLE `atCliente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facturasdetalles`
--
ALTER TABLE `facturasdetalles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospitalizacion`
--
ALTER TABLE `hospitalizacion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materiales`
--
ALTER TABLE `materiales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicinas`
--
ALTER TABLE `medicinas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modulo_base`
--
ALTER TABLE `modulo_base`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atCliente`
--
ALTER TABLE `atCliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `facturasdetalles`
--
ALTER TABLE `facturasdetalles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;

--
-- AUTO_INCREMENT for table `hospitalizacion`
--
ALTER TABLE `hospitalizacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `materiales`
--
ALTER TABLE `materiales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `medicinas`
--
ALTER TABLE `medicinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `modulo_base`
--
ALTER TABLE `modulo_base`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
