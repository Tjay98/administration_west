-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09-Jan-2021 às 18:37
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `administration_west`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `billing_address`
--

CREATE TABLE `billing_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'nome completo do cliente',
  `nif` int(9) NOT NULL COMMENT 'nif, máximo 9 caractéres',
  `contact_number` int(20) NOT NULL COMMENT 'telemóvel',
  `city` varchar(255) NOT NULL COMMENT 'cidade',
  `address` text NOT NULL COMMENT 'morada',
  `zip_code` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0-inactive 1- active 2-deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `billing_address`
--

INSERT INTO `billing_address` (`id`, `user_id`, `name`, `nif`, `contact_number`, `city`, `address`, `zip_code`, `created_date`, `modified_date`, `status`) VALUES
(1, 1, 'Rodolfo Barreira', 226831469, 927718775, 'Torres vedras', 'Torres v', '2560', '2020-12-06 17:15:12', NULL, 1),
(2, 2, 'Rodolfo Barreira', 226831469, 927718775, 'Torres Vedras', 'Torres V', '2560', '2020-12-23 22:04:18', NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `iva` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `iva`) VALUES
(1, 'Categoria 1', '23'),
(2, 'testea', '1'),
(3, 'Teste 2', '1'),
(4, 'Jorge', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL COMMENT 'nome da empresa',
  `image` varchar(255) NOT NULL COMMENT 'image path',
  `description` text NOT NULL COMMENT 'descriçao da empresa',
  `status` tinyint(1) NOT NULL COMMENT '0-inactive 1-active',
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `image`, `description`, `status`, `created_date`) VALUES
(1, 'Isell&Repair', 'isell&repair.jpg', 'A iSell&Repair é uma empresa de venda de equipamentos eletrónicos, tais como telemóveis, tablets e computadores', 1, '2020-11-15 00:00:00'),
(2, 'Teste', '', 'EMPRESA TESTE', 1, '2020-12-19 17:43:57');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contact_form`
--

CREATE TABLE `contact_form` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0-recebido 1-resolvido',
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0-inativo 1-ativo',
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `image`, `status`, `created_date`) VALUES
(1, 'Multibanco', '', 1, '2020-12-06 23:02:50'),
(2, 'Mbway', '', 1, '2020-12-06 23:03:02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `payment_reference`
--

CREATE TABLE `payment_reference` (
  `id` int(11) NOT NULL,
  `sale_group_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `company_reference` int(11) NOT NULL,
  `reference` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0-por pagar, 1-pago',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'nome da permissao',
  `description` text DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='nome da permissao';

--
-- Extraindo dados da tabela `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `description`, `created_date`, `modified_date`) VALUES
(1, 'Products', 'Acesso aos produtos do backend', '2020-12-17 23:11:16', NULL),
(2, 'Categorias', 'Acesso às categorias do backend', '2020-12-17 23:11:31', NULL),
(3, 'Sales', 'Acesso às vendas do backend', '2020-12-17 23:11:46', NULL),
(4, 'Users', 'Acesso aos utilizadores do backend', '2020-12-17 23:12:13', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `permission_assignment`
--

CREATE TABLE `permission_assignment` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `view` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0-no 1-yes',
  `crud` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0-no 1-yes',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='atribuição de permissões';

--
-- Extraindo dados da tabela `permission_assignment`
--

INSERT INTO `permission_assignment` (`id`, `role_id`, `permission_id`, `view`, `crud`, `created_date`, `modified_date`) VALUES
(1, 3, 1, 1, 1, '2020-12-17 23:44:36', NULL),
(2, 3, 2, 1, 1, '2020-12-17 23:44:42', NULL),
(3, 3, 3, 1, 1, '2020-12-17 23:44:48', NULL),
(4, 3, 4, 1, 1, '2020-12-17 23:44:53', NULL),
(5, 2, 1, 1, 1, '2020-12-17 23:45:01', NULL),
(6, 2, 2, 1, 0, '2020-12-17 23:45:44', NULL),
(7, 2, 3, 1, 1, '2020-12-17 23:46:01', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL COMMENT 'link da imagem',
  `small_description` varchar(255) DEFAULT NULL COMMENT 'descriçao para aparecer na lista',
  `big_description` text DEFAULT NULL COMMENT 'descriçao para mostrar quando se abre o produto',
  `category_id` int(11) NOT NULL COMMENT 'id da categoria',
  `company_id` int(11) NOT NULL,
  `quantity_in_stock` int(11) NOT NULL DEFAULT 0,
  `price` decimal(11,2) NOT NULL COMMENT 'Preço com iva',
  `price_without_iva` decimal(11,2) NOT NULL,
  `price_iva` decimal(11,2) NOT NULL COMMENT 'valor do iva',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0-inativo 1-ativo\r\n',
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `product_name`, `image`, `small_description`, `big_description`, `category_id`, `company_id`, `quantity_in_stock`, `price`, `price_without_iva`, `price_iva`, `status`, `created_date`) VALUES
(1, 'Produto 1', 'video-imagem-camera-fotografica.png', 'askjdaijodasijdajisdioasiodasoidaosdokiasodoikadoas', NULL, 1, 2, 9, '10.00', '7.70', '2.30', 1, '2020-11-15 20:07:29'),
(2, 'Produto 2', 'video-imagem-camera-fotografica.png', NULL, NULL, 1, 1, 10, '10.00', '7.70', '2.30', 1, '2020-11-15 20:07:43'),
(3, 'Produto 3', 'video-imagem-camera-fotografica.png', NULL, NULL, 1, 1, 10, '10.00', '7.70', '2.30', 1, '2020-11-15 20:07:43'),
(4, 'Produto 4', 'video-imagem-camera-fotografica.png', NULL, NULL, 1, 1, 10, '10.00', '7.70', '2.30', 1, '2020-11-15 20:07:43'),
(5, 'Produto 5', 'video-imagem-camera-fotografica.png', NULL, NULL, 1, 1, 10, '10.00', '7.70', '2.30', 1, '2020-11-15 20:07:43'),
(6, 'Produto 6', 'video-imagem-camera-fotografica.png', NULL, NULL, 1, 1, 10, '10.00', '7.70', '2.30', 1, '2020-11-15 20:07:43'),
(7, 'Produto 7', 'video-imagem-camera-fotografica.png', NULL, NULL, 1, 1, 10, '10.00', '7.70', '2.30', 1, '2020-11-15 20:07:43'),
(8, 'Produto 8', 'video-imagem-camera-fotografica.png', NULL, NULL, 1, 1, 10, '10.00', '7.70', '2.30', 1, '2020-11-15 20:07:43'),
(9, 'Produto 9', 'video-imagem-camera-fotografica.png', NULL, NULL, 1, 1, 10, '10.00', '7.70', '2.30', 1, '2020-11-15 20:07:43'),
(10, 'Produto 10', 'video-imagem-camera-fotografica.png', NULL, NULL, 1, 1, 7, '10.00', '7.70', '2.30', 1, '2020-11-15 20:07:43'),
(11, 'Produto 11', 'video-imagem-camera-fotografica.png', NULL, NULL, 1, 1, -1, '10.00', '7.70', '2.30', 1, '2020-11-15 20:07:43'),
(12, 'Produto 12', 'video-imagem-camera-fotografica.png', NULL, NULL, 1, 1, -1, '10.00', '7.70', '2.30', 0, '2020-11-15 20:07:43');

-- --------------------------------------------------------

--
-- Estrutura da tabela `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0-inactive 1-active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `status`) VALUES
(1, 'user', 'Utilizador comum', 1),
(2, 'company', 'Empresa que deseja aceder aos nossos serviços', 1),
(3, 'admin', 'Administrador da empresa', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sales_group`
--

CREATE TABLE `sales_group` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `billing_address_id` int(11) NOT NULL COMMENT 'morada de faturaçao',
  `shipping_address_id` int(11) NOT NULL COMMENT 'morada de envio',
  `payment_method_id` int(11) NOT NULL,
  `total_price` decimal(11,2) NOT NULL,
  `total_iva` decimal(11,2) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0-processamento 1-processado 2-enviado 3-cancelado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sales_group`
--

INSERT INTO `sales_group` (`id`, `user_id`, `billing_address_id`, `shipping_address_id`, `payment_method_id`, `total_price`, `total_iva`, `created_date`, `status`) VALUES
(1, 2, 2, 1, 1, '10.00', '2.30', '2020-12-23 22:31:52', 1),
(2, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 15:29:59', 0),
(3, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 15:31:07', 0),
(4, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 15:31:08', 0),
(5, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 15:31:08', 0),
(6, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 15:31:09', 0),
(7, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 15:31:09', 0),
(8, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 15:31:09', 0),
(9, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 15:31:33', 0),
(10, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 15:31:34', 0),
(11, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 15:31:38', 0),
(12, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 15:38:46', 0),
(13, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 15:38:56', 0),
(14, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 15:40:56', 0),
(15, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 15:47:53', 0),
(16, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 15:47:54', 0),
(17, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 15:47:55', 0),
(18, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 15:47:59', 0),
(19, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 15:47:59', 0),
(20, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 15:47:59', 0),
(21, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 16:19:25', 0),
(22, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 16:23:10', 0),
(23, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 16:23:46', 0),
(24, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 16:24:30', 0),
(25, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 16:30:57', 0),
(26, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 17:02:26', 0),
(27, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 17:02:52', 0),
(28, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 17:02:53', 0),
(29, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 17:06:55', 0),
(30, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 17:07:15', 0),
(31, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 17:07:16', 0),
(32, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 17:07:16', 0),
(33, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 17:10:05', 0),
(34, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 17:10:19', 0),
(35, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 17:10:20', 0),
(36, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 17:10:20', 0),
(37, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 17:10:20', 0),
(38, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 17:10:20', 0),
(39, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 17:10:20', 0),
(40, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 17:10:37', 0),
(41, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 17:14:34', 0),
(42, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 17:15:11', 0),
(43, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 17:15:11', 0),
(44, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 17:15:19', 0),
(45, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 17:23:40', 2),
(46, 2, 2, 1, 1, '10.00', '2.30', '2021-01-03 18:19:37', 2),
(47, 2, 2, 1, 1, '20.00', '4.60', '2021-01-03 23:16:22', 1),
(48, 1, 1, 1, 1, '10.00', '1.00', '2021-01-04 00:38:51', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sales_product`
--

CREATE TABLE `sales_product` (
  `id` int(11) NOT NULL,
  `sale_group_id` int(11) NOT NULL,
  `sale_product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(11,2) NOT NULL,
  `price_iva` decimal(11,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0-por processar 1-processado',
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sales_product`
--

INSERT INTO `sales_product` (`id`, `sale_group_id`, `sale_product_id`, `quantity`, `price`, `price_iva`, `status`, `created_date`) VALUES
(1, 1, 11, 1, '10.00', '2.30', 0, '2020-12-23 22:31:52'),
(2, 1, 11, 1, '10.00', '2.30', 0, '2020-12-23 22:31:52'),
(3, 14, 11, 1, '10.00', '2.30', 0, '2021-01-03 15:40:56'),
(4, 15, 11, 1, '10.00', '2.30', 0, '2021-01-03 15:47:53'),
(5, 16, 11, 1, '10.00', '2.30', 0, '2021-01-03 15:47:54'),
(6, 17, 11, 1, '10.00', '2.30', 0, '2021-01-03 15:47:55'),
(7, 18, 11, 1, '10.00', '2.30', 0, '2021-01-03 15:47:59'),
(8, 19, 11, 1, '10.00', '2.30', 0, '2021-01-03 15:47:59'),
(9, 20, 11, 1, '10.00', '2.30', 0, '2021-01-03 15:47:59'),
(10, 23, 12, 1, '10.00', '2.30', 0, '2021-01-03 16:23:46'),
(11, 24, 12, 1, '10.00', '2.30', 0, '2021-01-03 16:24:30'),
(12, 25, 2, 1, '10.00', '2.30', 0, '2021-01-03 16:30:57'),
(13, 45, 10, 1, '10.00', '2.30', 1, '2021-01-03 17:23:40'),
(14, 46, 10, 1, '10.00', '2.30', 1, '2021-01-03 18:19:37'),
(15, 47, 10, 1, '10.00', '2.30', 1, '2021-01-03 23:16:22'),
(16, 47, 1, 1, '10.00', '2.30', 1, '2021-01-03 23:16:22'),
(17, 48, 12, 1, '10.00', '2.30', 0, '2021-01-03 23:38:51');

-- --------------------------------------------------------

--
-- Estrutura da tabela `shipping_address`
--

CREATE TABLE `shipping_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'nome do cliente',
  `nif` int(9) NOT NULL COMMENT 'nif, maximo 9 caracteres',
  `contact_number` int(20) NOT NULL COMMENT 'telemovel',
  `city` varchar(255) NOT NULL COMMENT 'cidade',
  `address` text NOT NULL COMMENT 'morada completa',
  `zip_code` varchar(255) NOT NULL COMMENT 'codigo postal',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0-inativo 1-ativo 2-apagado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='morada de envio';

--
-- Extraindo dados da tabela `shipping_address`
--

INSERT INTO `shipping_address` (`id`, `user_id`, `name`, `nif`, `contact_number`, `city`, `address`, `zip_code`, `created_date`, `modified_date`, `status`) VALUES
(1, 1, 'Rodolfo Barreira', 226831469, 927718775, 'Torres Vedras', 'Torres V', '2560', '2020-12-06 17:14:19', NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` int(9) NOT NULL,
  `birthday_date` date DEFAULT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unique_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 1 COMMENT '1-utilizador 2-empresa 3-admin',
  `store_id` int(11) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 1 COMMENT '0-inativo 1-ativo 2-banido',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `phone_number`, `birthday_date`, `password_hash`, `password_reset_token`, `unique_key`, `role_id`, `store_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Rodolfo Barreira', 'rodolfo-barreira@hotmail.com', 226831469, '1998-03-31', '$2y$10$iU..PsIubR5BbdrKDoq/OOvKbsV0Mc1vGnlx4LaGfrP..fkHpJPz2', NULL, '7771de302a5c2d6d84c7eee28740d97b', 3, NULL, 1, '2020-11-15 20:37:53', '2020-11-15 20:37:53'),
(2, 'Utilizador Comum', 'usercomum@gmail.com', 123456789, '2000-03-31', '$2y$10$zoh//JbXis5ZbnWQRh2mzOkQmyA9ZxpO111oXmYHrq6a.OihNknnO', NULL, '146a70141050d4b8a580a5aee9bf5534', 1, NULL, 1, '2020-12-20 20:50:04', '2020-12-20 20:50:04'),
(3, 'Conta empresa', 'teste@teste.pt', 123456781, '2000-03-31', '$2y$10$zoh//JbXis5ZbnWQRh2mzOkQmyA9ZxpO111oXmYHrq6a.OihNknnO', NULL, '0718c9704202cb41ed2392bb5083d392', 2, 1, 1, '2020-12-20 20:50:04', '2020-12-20 20:50:04'),
(4, 'Utilizador Comum 2', 'usercomum@gmail.pt', 927718775, '1998-03-31', '$2y$10$K9azy7MsB98pnh22PYIVKOcyCfzkE6t40QOFVt1WA7FN4CkgaMY2G', NULL, '123301185191cf83f09c5bbc2081e5fe', 1, NULL, 1, '2021-01-07 22:19:36', '2021-01-07 22:19:36'),
(5, 'Teste Restful', 'restful@rest.pt', 937718775, '0000-00-00', '$2y$10$UKY4k9K7oXU4ZlgUaq.AIOjLQD2A7sUza7nTNpuJq2/d6K9vmPmTi', NULL, '8515b501ebf085a1fb21bf5b96c90090', 1, NULL, 1, '2021-01-07 22:24:15', '2021-01-07 22:24:15'),
(6, 'Bruno', 'bruno@bruno.pt', 937718772, '1998-03-31', '$2y$10$lpF7vbVwXpzl4VzVO9Vy3OchSGsmwq9ZQRu507kdBhetFECZu/7RO', NULL, '8e92e50910c2172f482954a90a387346', 1, NULL, 1, '2021-01-08 18:55:51', '2021-01-08 18:55:51'),
(7, 'Bruno2', 'bruno2@bruno.pot', 927718773, '0000-00-00', '$2y$10$Jbo0KTdNJZrzZkrdwLxjLOKqsv3l2af9qDmJJXCxX0KZdcohXNiRa', NULL, '0eb6c8d5728697b269b37ee6f8e544b9', 1, NULL, 1, '2021-01-08 18:57:57', '2021-01-08 18:57:57'),
(8, 'Bruno3', 'bruno3@bruno.pot', 927718774, '1998-03-31', '$2y$10$qs5kC5K5t5Yh4EYF9KqUruAnZ1giVCy8md6G62uYzLEUGpmi1bi82', NULL, '8040af602169e173c1f8d59164ba2458', 1, NULL, 1, '2021-01-08 19:00:14', '2021-01-08 19:00:14'),
(9, 'Bruno4', 'bruno4@bruno.pt', 927718777, '1998-03-31', '$2y$10$j35nCVg/5vFZ0OEmZM2Ep.4Q.r5zgecujxpI7ee7Fp4tUui7EiiWa', NULL, '12044e0d13a0e1e68d004d7efc2f1d5f', 1, NULL, 1, '2021-01-08 19:01:45', '2021-01-08 19:01:45');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `billing_address`
--
ALTER TABLE `billing_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices para tabela `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `payment_reference`
--
ALTER TABLE `payment_reference`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_group_id` (`sale_group_id`),
  ADD KEY `payment_method_id` (`payment_method_id`);

--
-- Índices para tabela `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `permission_assignment`
--
ALTER TABLE `permission_assignment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_id` (`permission_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Índices para tabela `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sales_group`
--
ALTER TABLE `sales_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `billing_address_id` (`billing_address_id`),
  ADD KEY `shipping_address_id` (`shipping_address_id`),
  ADD KEY `payment_method_id` (`payment_method_id`);

--
-- Índices para tabela `sales_product`
--
ALTER TABLE `sales_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_group_id` (`sale_group_id`),
  ADD KEY `sale_product_id` (`sale_product_id`);

--
-- Índices para tabela `shipping_address`
--
ALTER TABLE `shipping_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nif` (`phone_number`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`),
  ADD KEY `username` (`username`) USING BTREE,
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `billing_address`
--
ALTER TABLE `billing_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `payment_reference`
--
ALTER TABLE `payment_reference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `permission_assignment`
--
ALTER TABLE `permission_assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `sales_group`
--
ALTER TABLE `sales_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de tabela `sales_product`
--
ALTER TABLE `sales_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `shipping_address`
--
ALTER TABLE `shipping_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `billing_address`
--
ALTER TABLE `billing_address`
  ADD CONSTRAINT `billing_address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `payment_reference`
--
ALTER TABLE `payment_reference`
  ADD CONSTRAINT `payment_reference_ibfk_1` FOREIGN KEY (`sale_group_id`) REFERENCES `sales_group` (`id`),
  ADD CONSTRAINT `payment_reference_ibfk_2` FOREIGN KEY (`payment_method_id`) REFERENCES `billing_address` (`id`);

--
-- Limitadores para a tabela `permission_assignment`
--
ALTER TABLE `permission_assignment`
  ADD CONSTRAINT `permission_assignment_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `permission_assignment_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Limitadores para a tabela `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`);

--
-- Limitadores para a tabela `sales_group`
--
ALTER TABLE `sales_group`
  ADD CONSTRAINT `sales_group_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `sales_group_ibfk_2` FOREIGN KEY (`billing_address_id`) REFERENCES `billing_address` (`id`),
  ADD CONSTRAINT `sales_group_ibfk_3` FOREIGN KEY (`shipping_address_id`) REFERENCES `shipping_address` (`id`),
  ADD CONSTRAINT `sales_group_ibfk_4` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`);

--
-- Limitadores para a tabela `sales_product`
--
ALTER TABLE `sales_product`
  ADD CONSTRAINT `sales_product_ibfk_1` FOREIGN KEY (`sale_group_id`) REFERENCES `sales_group` (`id`),
  ADD CONSTRAINT `sales_product_ibfk_2` FOREIGN KEY (`sale_product_id`) REFERENCES `products` (`id`);

--
-- Limitadores para a tabela `shipping_address`
--
ALTER TABLE `shipping_address`
  ADD CONSTRAINT `shipping_address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
