-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 10, 2016 at 02:41 PM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2016_reservas`
--

-- --------------------------------------------------------

--
-- Table structure for table `res_administradores`
--

CREATE TABLE `res_administradores` (
  `rad_id` bigint(20) NOT NULL,
  `rad_dni` char(30) NOT NULL,
  `rad_apellidos` varchar(200) NOT NULL,
  `rad_nombres` varchar(200) NOT NULL,
  `rus_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `res_administradores`
--

INSERT INTO `res_administradores` (`rad_id`, `rad_dni`, `rad_apellidos`, `rad_nombres`, `rus_id`) VALUES
(2, '29131958C', 'apellidos gestor 2', 'nombres gestor 2', 12),
(3, '25206394G', 'miguel', 'francisco', 13);

-- --------------------------------------------------------

--
-- Table structure for table `res_clientes`
--

CREATE TABLE `res_clientes` (
  `rcl_id` bigint(20) NOT NULL,
  `rcl_dni` char(30) DEFAULT NULL,
  `rcl_nombres` varchar(150) DEFAULT NULL,
  `rcl_apellidos` varchar(150) DEFAULT NULL,
  `rcl_movil` char(30) DEFAULT NULL,
  `rcl_bloque` char(10) DEFAULT NULL,
  `rcl_portal` varchar(250) DEFAULT NULL,
  `rcl_piso` char(10) DEFAULT NULL,
  `rcl_letra` char(10) DEFAULT NULL,
  `rus_id` bigint(20) DEFAULT NULL,
  `rco_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `res_clientes`
--

INSERT INTO `res_clientes` (`rcl_id`, `rcl_dni`, `rcl_nombres`, `rcl_apellidos`, `rcl_movil`, `rcl_bloque`, `rcl_portal`, `rcl_piso`, `rcl_letra`, `rus_id`, `rco_id`) VALUES
(1, '25454737Q', 'Poncela Laborda', 'Isabel', '04143735483', 'F17', 'LUISCORDERO.COM', '12', 'A', 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `res_comunidades`
--

CREATE TABLE `res_comunidades` (
  `rco_id` bigint(20) NOT NULL,
  `rco_nombre` varchar(200) NOT NULL,
  `rco_direccion` text NOT NULL,
  `rco_contacto` varchar(200) NOT NULL,
  `rco_movil` char(30) NOT NULL,
  `rco_correo` varchar(250) NOT NULL,
  `rco_vecinos` bigint(20) NOT NULL,
  `rus_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `res_comunidades`
--

INSERT INTO `res_comunidades` (`rco_id`, `rco_nombre`, `rco_direccion`, `rco_contacto`, `rco_movil`, `rco_correo`, `rco_vecinos`, `rus_id`) VALUES
(1, 'simon bolivar', 'asd', 'lasd', '123123123', 'info@asd.com', 12, 13);

-- --------------------------------------------------------

--
-- Table structure for table `res_instalaciones`
--

CREATE TABLE `res_instalaciones` (
  `rin_id` bigint(20) NOT NULL,
  `rin_nombre` varchar(250) DEFAULT NULL,
  `rin_activo` enum('SI','NO') DEFAULT NULL,
  `rin_numero` tinyint(4) DEFAULT NULL,
  `rin_tipo` enum('MINUTOS','HORAS','DIA') DEFAULT NULL,
  `rin_duracion` tinyint(4) DEFAULT NULL,
  `rin_hora_inicio` time DEFAULT NULL,
  `rin_hora_fin` time DEFAULT NULL,
  `rin_antelacion` tinyint(4) DEFAULT NULL,
  `rin_anulacion` tinyint(4) DEFAULT NULL,
  `rco_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `res_instalaciones`
--

INSERT INTO `res_instalaciones` (`rin_id`, `rin_nombre`, `rin_activo`, `rin_numero`, `rin_tipo`, `rin_duracion`, `rin_hora_inicio`, `rin_hora_fin`, `rin_antelacion`, `rin_anulacion`, `rco_id`) VALUES
(9, 'CANCHA DE TENIS', 'NO', 2, 'HORAS', 2, '06:30:00', '18:30:00', 2, 2, 1),
(10, 'CABALLERIZA', 'SI', 3, 'MINUTOS', 30, '14:00:00', '18:00:00', 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `res_opciones`
--

CREATE TABLE `res_opciones` (
  `rop_id` bigint(20) NOT NULL,
  `rop_hora_inicio` time DEFAULT NULL,
  `rop_hora_fin` time DEFAULT NULL,
  `rin_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `res_opciones`
--

INSERT INTO `res_opciones` (`rop_id`, `rop_hora_inicio`, `rop_hora_fin`, `rin_id`) VALUES
(8473, '06:30:00', '08:30:00', 9),
(8474, '08:30:00', '10:30:00', 9),
(8475, '10:30:00', '12:30:00', 9),
(8476, '12:30:00', '14:30:00', 9),
(8477, '14:30:00', '16:30:00', 9),
(8478, '16:30:00', '18:30:00', 9),
(8479, '14:00:00', '14:30:00', 10),
(8480, '14:30:00', '15:00:00', 10),
(8481, '15:00:00', '15:30:00', 10),
(8482, '15:30:00', '16:00:00', 10),
(8483, '16:00:00', '16:30:00', 10),
(8484, '16:30:00', '17:00:00', 10),
(8485, '17:00:00', '17:30:00', 10),
(8486, '17:30:00', '18:00:00', 10);

-- --------------------------------------------------------

--
-- Table structure for table `res_reservas`
--

CREATE TABLE `res_reservas` (
  `rre_id` bigint(20) NOT NULL,
  `rre_fecha` date DEFAULT NULL,
  `rop_id` bigint(20) DEFAULT NULL,
  `rcl_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `res_reservas`
--

INSERT INTO `res_reservas` (`rre_id`, `rre_fecha`, `rop_id`, `rcl_id`) VALUES
(16, '2016-12-12', 8479, 1),
(17, '2017-06-07', 8479, 1),
(18, '2016-12-12', 8480, 1),
(19, '2016-12-12', 8481, 1),
(20, '2016-12-13', 8479, 1),
(21, '2016-12-11', 8479, 1),
(22, '2016-12-22', 8480, 1),
(23, '2016-12-14', 8479, 1),
(24, '2016-12-13', 8480, 1),
(25, '2016-12-13', 8481, 1);

-- --------------------------------------------------------

--
-- Table structure for table `res_usuarios`
--

CREATE TABLE `res_usuarios` (
  `rus_id` bigint(20) NOT NULL,
  `rus_tipo` enum('ADMIN_GLOBAL','ADMIN_COMUNIDAD','USUARIO') DEFAULT NULL,
  `rus_usuario` varchar(255) DEFAULT NULL,
  `rus_clave` varchar(255) DEFAULT NULL,
  `rus_correo` varchar(150) DEFAULT NULL,
  `rus_activo` enum('SI','NO') DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `res_usuarios`
--

INSERT INTO `res_usuarios` (`rus_id`, `rus_tipo`, `rus_usuario`, `rus_clave`, `rus_correo`, `rus_activo`) VALUES
(1, 'ADMIN_GLOBAL', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com', 'SI'),
(4, 'ADMIN_COMUNIDAD', '12640749H', '535951c35042f40fff2d1335673d6630', NULL, 'NO'),
(5, NULL, '06003864J', '630a2b689fd4ef2c280c63f18ef455cc', 'matilde@gmail.com', 'NO'),
(6, 'USUARIO', '86750273T', 'eaa79afeb3984858c46ad7a1bd38bff4', 'rosaspri11@hotmail.com', 'NO'),
(8, 'ADMIN_COMUNIDAD', '04280182C', 'dfb422076631b0c615f3f6ebbe19e130', NULL, 'NO'),
(9, 'USUARIO', '86084947H', 'f8202d385ab488f4cc45c4445ed660e5', 'luisa@gmail.com', 'NO'),
(10, 'ADMIN_GLOBAL', 'admin2', 'c84258e9c39059a89ab77d846ddab909', 'info@luiscordero29.com', 'SI'),
(12, 'ADMIN_COMUNIDAD', 'gestor2', '13f323133114e52cb8534cf096bc50d3', 'gestor2@reservas.com', 'SI'),
(13, 'ADMIN_COMUNIDAD', 'gestor3', '1d44b3019f0a880296507b1e24c50cd6', 'gestor3@gestor.com', 'SI'),
(14, 'USUARIO', 'usuario1', '122b738600a0f74f7c331c0ef59bc34c', 'iponcela@yahoo.com', 'SI');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `res_administradores`
--
ALTER TABLE `res_administradores`
  ADD PRIMARY KEY (`rad_id`),
  ADD UNIQUE KEY `rad_dni` (`rad_dni`),
  ADD KEY `res_administradores_rus_id` (`rus_id`);

--
-- Indexes for table `res_clientes`
--
ALTER TABLE `res_clientes`
  ADD PRIMARY KEY (`rcl_id`),
  ADD KEY `res_clientes_rus_id` (`rus_id`),
  ADD KEY `res_clientes_rco_id` (`rco_id`);

--
-- Indexes for table `res_comunidades`
--
ALTER TABLE `res_comunidades`
  ADD PRIMARY KEY (`rco_id`),
  ADD KEY `res_comunidades_rus_id` (`rus_id`);

--
-- Indexes for table `res_instalaciones`
--
ALTER TABLE `res_instalaciones`
  ADD PRIMARY KEY (`rin_id`),
  ADD KEY `res_instalaciones_rco_id` (`rco_id`);

--
-- Indexes for table `res_opciones`
--
ALTER TABLE `res_opciones`
  ADD PRIMARY KEY (`rop_id`),
  ADD KEY `res_opciones_rin_id` (`rin_id`);

--
-- Indexes for table `res_reservas`
--
ALTER TABLE `res_reservas`
  ADD PRIMARY KEY (`rre_id`),
  ADD KEY `res_reservas_rop_id` (`rop_id`),
  ADD KEY `res_reservas_rcl_id` (`rcl_id`);

--
-- Indexes for table `res_usuarios`
--
ALTER TABLE `res_usuarios`
  ADD PRIMARY KEY (`rus_id`),
  ADD UNIQUE KEY `rus_email` (`rus_correo`),
  ADD UNIQUE KEY `rus_usuario` (`rus_usuario`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `res_administradores`
--
ALTER TABLE `res_administradores`
  MODIFY `rad_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `res_clientes`
--
ALTER TABLE `res_clientes`
  MODIFY `rcl_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `res_comunidades`
--
ALTER TABLE `res_comunidades`
  MODIFY `rco_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `res_instalaciones`
--
ALTER TABLE `res_instalaciones`
  MODIFY `rin_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `res_opciones`
--
ALTER TABLE `res_opciones`
  MODIFY `rop_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8487;
--
-- AUTO_INCREMENT for table `res_reservas`
--
ALTER TABLE `res_reservas`
  MODIFY `rre_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `res_usuarios`
--
ALTER TABLE `res_usuarios`
  MODIFY `rus_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `res_administradores`
--
ALTER TABLE `res_administradores`
  ADD CONSTRAINT `res_administradores_rus_id` FOREIGN KEY (`rus_id`) REFERENCES `res_usuarios` (`rus_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `res_clientes`
--
ALTER TABLE `res_clientes`
  ADD CONSTRAINT `res_clientes_rco_id` FOREIGN KEY (`rco_id`) REFERENCES `res_comunidades` (`rco_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `res_clientes_rus_id` FOREIGN KEY (`rus_id`) REFERENCES `res_usuarios` (`rus_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `res_comunidades`
--
ALTER TABLE `res_comunidades`
  ADD CONSTRAINT `res_comunidades_rus_id` FOREIGN KEY (`rus_id`) REFERENCES `res_usuarios` (`rus_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `res_instalaciones`
--
ALTER TABLE `res_instalaciones`
  ADD CONSTRAINT `res_instalaciones_rco_id` FOREIGN KEY (`rco_id`) REFERENCES `res_comunidades` (`rco_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `res_opciones`
--
ALTER TABLE `res_opciones`
  ADD CONSTRAINT `res_opciones_rin_id` FOREIGN KEY (`rin_id`) REFERENCES `res_instalaciones` (`rin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `res_reservas`
--
ALTER TABLE `res_reservas`
  ADD CONSTRAINT `res_reservas_rcl_id` FOREIGN KEY (`rcl_id`) REFERENCES `res_clientes` (`rcl_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `res_reservas_rop_id` FOREIGN KEY (`rop_id`) REFERENCES `res_opciones` (`rop_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
