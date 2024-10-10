-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-06-2024 a las 04:02:46
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `emilio_barrios_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `categoria_id` int(10) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `descripcion`) VALUES
(1, 'mantequilla de mani'),
(2, 'snacks'),
(3, 'cafe de especialidad'),
(4, 'otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id`, `descripcion`) VALUES
(1, 'admin'),
(2, 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(10) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `categoria_id` int(10) DEFAULT NULL,
  `precio` double(255,0) NOT NULL,
  `precio_vta` double(255,0) NOT NULL,
  `stock` int(11) NOT NULL,
  `stock_min` int(11) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `eliminado` varchar(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `categoria_id`, `precio`, `precio_vta`, `stock`, `stock_min`, `imagen`, `eliminado`) VALUES
(50, 'Avena Instantanea', 'Quaker', 4, 1900, 3500, 50, 1, '1718646922_cc87ce9c028323293442.jpg', 'NO'),
(49, 'Cafe de especialidad', 'DoyPack', 3, 9000, 14799, 15, 0, '1718646871_83c9f5ea499e3653486c.png', 'NO'),
(48, 'Pochoclos Organicos', 'Importado', 2, 1000, 1369, 100, 1, '1718646499_7ed0bc20cbda66a87ba9.png', 'NO'),
(47, 'Castañas DoyPack', '200 gramos naturales', 2, 3999, 5580, 20, 4, '1718646404_3c505bedfa75be76c52e.png', 'NO'),
(46, 'Aceite de Olvida Zue', 'Todas las variedades', 4, 12000, 16000, 49, 3, '1718645759_468ded46eb7eaa627521.jpg', 'NO'),
(45, 'Cafe Importado Suelt', 'Compra minima 250gr', 3, 1000, 1500, 300, 1, '1718645706_abd8e0c3b2f6e9499e57.jpg', 'NO'),
(44, 'Barrita de cereal', 'sin agregados ', 2, 420, 800, 999, 100, '1718645582_f264f7809d9e7bb276da.png', 'NO'),
(43, 'Mantequilla Chocolat', 'Endulzada con Stevia', 1, 4200, 6000, 5, 1, '1718645510_41af1aba9d82564599e5.jpg', 'NO'),
(42, 'Pasta de Maní de Cam', '100% ARTESANAL', 1, 5799, 6500, 9, 2, '1718495544_b6d9fa76ac6dc059811d.png', 'NO'),
(41, 'Mantequilla de Maní ', 'Endulzada con miel', 1, 4500, 5000, 18, 5, '1718485019_1f6b07c72d3c9c84a174.jpg', 'NO'),
(51, 'Cafe colombiano', 'Tostado y molido Premium', 3, 6000, 9879, 9, 0, '1718647259_ddb23bb9d02babb086f2.png', 'NO'),
(52, 'Harina', 'Integral', 4, 800, 1459, 12, 0, '1718647384_67e82c7c3099c97dbf1b.png', 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(10) NOT NULL,
  `mensaje` varchar(300) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `visitante` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `mensaje`, `estado`, `visitante`) VALUES
(1, 'viaje a goya', 'barrios@gmail.com', 377849, 'cuanto sale un viaje a goya', '0', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `telefono` int(10) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `perfil_id` int(11) NOT NULL DEFAULT 2,
  `baja` varchar(20) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `usuario`, `telefono`, `direccion`, `email`, `pass`, `perfil_id`, `baja`) VALUES
(57, 'emilio', 'barrios', 'emilio', 2147483647, 'Tucuman 1749', 'barriosemiliotkd@gmail.com', '$2y$10$zKENAf/KdSYljN92xZ/MeuwLg5R5X8WprpjHQzX/EkzubtkGzJc.O', 1, 'NO'),
(58, 'emi', 'barrios', 'emilio', 30495032, 'Tucuman 1749', 'emiliofaridbarrios@gmail.com', '$2y$10$gTROBzO29g/40cQuA1HTQ.xp3OIs/575ON8pLUGgBnQAHO/X1FJga', 1, 'NO'),
(59, 'Emilio', 'Barrios', 'milei', 2147483647, 'Tucumán 1749', 'weplayctes@gmail.com', '$2y$10$YKk9ChOAJmwficR8v3nod.dkIg2/14kmmQpU7a4TV6Lfhc6lmXoBS', 2, 'NO'),
(60, 'Maxi', 'Peres', 'maxo55', 1234567890, 'Pedro esnaola uufedgf', 'maxi_@gmail.com', '$2y$10$DeSXAjRV/6XIMYDDZCYhGO6UF7XQut9qrUu0vG7Jipa4H7JqHHlri', 1, 'NO'),
(61, 'Cesar', 'Huisi', 'Cesar22', 1234567890, 'gdfsgfhfh', 'cesar@gmail.com', '$2y$10$73Sptq4vMfS/.QYPLDvAXuA9XjTAmtCG/8T3oCkY9zZsIUEPbmbVK', 2, 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_cabecera`
--

CREATE TABLE `ventas_cabecera` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `total_venta` double(10,2) NOT NULL,
  `tipo_pago` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ventas_cabecera`
--

INSERT INTO `ventas_cabecera` (`id`, `fecha`, `usuario_id`, `total_venta`, `tipo_pago`) VALUES
(110, '2024-06-13', 55, 86000.00, 'Efectivo'),
(109, '2024-06-13', 54, 68000.00, 'Efectivo'),
(111, '2024-06-17', 59, 16500.00, 'T_Debito'),
(112, '2024-06-17', 59, 16800.00, 'T_Debito'),
(113, '2024-06-24', 60, 9879.00, 'T_Debito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_detalle`
--

CREATE TABLE `ventas_detalle` (
  `id` int(10) UNSIGNED NOT NULL,
  `venta_id` int(10) UNSIGNED NOT NULL,
  `producto_id` int(10) UNSIGNED NOT NULL,
  `cantidad` int(10) UNSIGNED NOT NULL,
  `precio` double(10,2) UNSIGNED NOT NULL,
  `total` double(10,2) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ventas_detalle`
--

INSERT INTO `ventas_detalle` (`id`, `venta_id`, `producto_id`, `cantidad`, `precio`, `total`) VALUES
(97, 110, 25, 1, 50000.00, 50000.00),
(96, 110, 29, 2, 18000.00, 36000.00),
(95, 109, 25, 1, 50000.00, 50000.00),
(94, 109, 29, 1, 18000.00, 18000.00),
(98, 111, 41, 2, 5000.00, 10000.00),
(99, 111, 42, 1, 6500.00, 6500.00),
(100, 112, 46, 1, 16000.00, 16000.00),
(101, 112, 44, 1, 800.00, 800.00),
(102, 113, 51, 1, 9879.00, 9879.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perfil_id` (`perfil_id`);

--
-- Indices de la tabla `ventas_cabecera`
--
ALTER TABLE `ventas_cabecera`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categoria_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `ventas_cabecera`
--
ALTER TABLE `ventas_cabecera`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
