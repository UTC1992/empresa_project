-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-09-2017 a las 10:57:51
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `empresa_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_recmanual`
--

CREATE TABLE `tbl_recmanual` (
  `id_rec` int(11) NOT NULL,
  `datomanual` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_recmanual`
--

INSERT INTO `tbl_recmanual` (`id_rec`, `datomanual`) VALUES
(1, '44656'),
(2, '44659'),
(3, '110222'),
(4, '27412'),
(5, '96238'),
(6, '55716'),
(7, '92407'),
(8, '27438'),
(9, '23680'),
(10, '139218'),
(11, '133015'),
(12, '76194'),
(13, '132703'),
(14, '27846'),
(15, '137429'),
(16, '159450'),
(17, '99296'),
(18, '23439'),
(19, '5951'),
(20, '9544'),
(21, '124709'),
(22, '7016'),
(23, '7023'),
(24, '116341'),
(25, '51236'),
(26, '51236'),
(27, '5055'),
(28, '130571'),
(29, '126591'),
(30, '83646'),
(31, '85837'),
(32, '136237'),
(33, '82867'),
(34, '519'),
(35, '638'),
(36, '125165'),
(37, '108111'),
(38, '159533'),
(39, '24379'),
(40, '99507'),
(41, '24377'),
(42, '127441'),
(43, '58755'),
(44, '24309'),
(45, '21560'),
(46, '87357'),
(47, '104577');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_recmanual`
--
ALTER TABLE `tbl_recmanual`
  ADD PRIMARY KEY (`id_rec`),
  ADD UNIQUE KEY `id_rec_UNIQUE` (`id_rec`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_recmanual`
--
ALTER TABLE `tbl_recmanual`
  MODIFY `id_rec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
