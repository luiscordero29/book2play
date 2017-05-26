-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 25, 2017 at 06:15 PM
-- Server version: 10.0.31-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book2pla_codeigniter`
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
  `rcl_correo` varchar(250) DEFAULT NULL,
  `rcl_bloque` char(10) DEFAULT NULL,
  `rcl_portal` varchar(250) DEFAULT NULL,
  `rcl_piso` char(10) DEFAULT NULL,
  `rcl_letra` char(10) DEFAULT NULL,
  `rus_id` bigint(20) DEFAULT NULL,
  `rco_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  MODIFY `rad_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `res_clientes`
--
ALTER TABLE `res_clientes`
  MODIFY `rcl_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `res_comunidades`
--
ALTER TABLE `res_comunidades`
  MODIFY `rco_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `res_instalaciones`
--
ALTER TABLE `res_instalaciones`
  MODIFY `rin_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `res_opciones`
--
ALTER TABLE `res_opciones`
  MODIFY `rop_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8543;
--
-- AUTO_INCREMENT for table `res_reservas`
--
ALTER TABLE `res_reservas`
  MODIFY `rre_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `res_usuarios`
--
ALTER TABLE `res_usuarios`
  MODIFY `rus_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
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
