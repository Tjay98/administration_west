-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Fev-2021 às 17:19
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
(1, 2, 'Rodolfo Barreira', 226831469, 927718775, 'Torres Vedras', 'Torres Vedras', '2560', '2021-02-14 15:40:19', NULL, 1);

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
(1, 'Vinhos', '13'),
(2, 'Enchidos', '13'),
(3, 'Produtos artesanais', '10'),
(4, 'Licores', '23'),
(5, 'Bolos', '23'),
(6, 'Produtos lácteos', '6');

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
(1, 'Vinhos do oeste', 'Vinhos_do_oeste_LOGO.png', 'Empresa focada na produção e venda de produtos derivados da cultivação da uva. \r\nVenda de vinhos e de licores.', 1, '2021-02-12 22:58:52'),
(2, 'Queijo legítimo', 'Queijo_legítimo_LOGO.png', 'A queijo legítimo é uma empresa especializada na venda de produtos lácteos  nomeadamente queijo de vaca, fundada em 1950  onde a tradição no paladar permanece desde as gerações mais antigas.', 1, '2021-02-12 23:04:03'),
(3, 'Padaria Joaquim', 'Padaria_Joaquim_LOGO.png', 'A padaria Joaquim é uma padaria focada na venda de bolos, que ganhou grande  fama pelos seus pasteis de nata.', 1, '2021-02-12 23:09:35'),
(4, 'ArtesanOeste', 'ArtesanOeste_LOGO.png', 'A ArtesanOeste é uma empresa de Torres Vedras que vende produtos artesanais da região.\r\n', 1, '2021-02-12 23:13:45'),
(5, 'Doces honrados', 'Doces_honrados_LOGO.png', 'Empresa especializada em bolos de aniversário.', 1, '2021-02-12 23:17:23');

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
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1-recebido 2-resolvido 3-apagado',
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1-utilizador 2-empresa',
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
(1, 'products', 'Acesso aos produtos do backend', '2020-12-17 23:11:16', NULL),
(2, 'categories', 'Acesso às categorias do backend', '2020-12-17 23:11:31', NULL),
(3, 'sales', 'Acesso às vendas do backend', '2020-12-17 23:11:46', NULL),
(4, 'users', 'Acesso aos utilizadores do backend', '2020-12-17 23:12:13', NULL),
(5, 'companies', 'Acesso às empresas do backoffice', '2021-02-11 23:37:40', NULL),
(6, 'contacts', 'Acesso aos contactos', '2021-02-12 22:23:52', NULL);

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
(7, 2, 3, 1, 1, '2020-12-17 23:46:01', NULL),
(9, 2, 5, 1, 0, '2021-02-11 23:41:53', NULL),
(10, 3, 5, 1, 1, '2021-02-12 00:11:31', NULL),
(11, 3, 6, 1, 0, '2021-02-12 22:24:15', NULL),
(12, 2, 4, 1, 0, '2021-02-14 15:40:58', NULL);

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
(1, 'Queijo de vaca curado 250g', 'queijo_vaca_curado1.png', 'Queijo de vaca curado ', '<p>Queijo de vaca curado<p>\r\n<b>Ingredientes:</b>\r\n<p>Leite pasteurizado de Vaca, sal, coalho, fermento lácteo</p>', 6, 2, 29, '7.00', '6.60', '0.40', 1, '2021-02-12 23:25:46'),
(2, 'Queijo de vaca fresco 90g', 'queijo_vaca_fresco1.png', 'Queijo fresco', '<b>Ingredientes</b>\r\n<p>Valores nutricionais médios por 100gr: Preparado: Energia: 566.00 kJ / 135.00 kcal; Hidratos de carbono: 8.00 g, Dos quais açúcares: 4.00 g; Lípidos: 6.30 g, Dos quais ácidos gordos saturados: 4.60 g; Proteínas: 11.60 g; Sal: 0.70 g </p>\r\n<p>Ingredientes e alergénios    Ingredientes: LEITE de vaca pasteurizado, sal, cloreto de cálcio, coalho</p>', 6, 2, 10, '2.00', '2.00', '0.12', 1, '2021-02-12 23:38:08'),
(3, 'Queijo cheddar 200g', 'queijo_cheddar.jpg', 'O cheddar é uma variedade de queijo originalmente inglês. É alaranjado por corante.', '<p>O cheddar é uma variedade de queijo originalmente inglês.<p>\r\n<b>Ingredientes:</b>\r\nLEITE de vaca pasteurizado, sal, fermentos láticos, cloreto de cálcio, coalho e corante (carotenos) .', 6, 2, 20, '8.00', '7.55', '0.45', 1, '2021-02-12 23:45:02'),
(4, 'Herdade do Sobreiro 1.5L', 'Herade_sobreiro1.jpg', 'Vinho tinto Herdade do Sobreiro', 'Vinho tinto Herdade do Sobreiro', 1, 1, 39, '3.00', '3.00', '0.39', 1, '2021-02-13 23:41:14'),
(5, 'Castelo Torres 1.5L', 'Castelo_torres1.png', 'Vinho verde Castelo Torres', 'Vinho verde Castelo Torres ', 1, 1, 30, '4.00', '3.00', '0.52', 1, '2021-02-13 23:42:29'),
(6, 'Tinto Adega da toira 1.5L', 'depositphotos_19750459-stock-photo-red-wine-and-a-bottle1.jpg', 'Vinho tinto adega da toira', 'Vinho tinto adega da toira', 1, 1, 20, '6.00', '5.00', '0.78', 1, '2021-02-13 23:45:40'),
(7, 'Bolo de cenoura e chocolate', 'Bolo_cenoura_e_chocolate.jpg', 'Um delicioso bolo de cenoura com recheio de chocolate', '<p>Um delicioso bolo de cenoura com recheio de chocolate</p>\r\n<b>Ingredientes</b>\r\n<p>Farinha tipo 55, óleo vegetal, cenoura, ovos, açúcar, fermento, chocolate de culinária,  natas</p>', 5, 5, 10, '5.00', '4.07', '0.93', 1, '2021-02-13 23:49:15'),
(8, 'Bolo de chocolate 700g', 'bolo_chocolate1.png', 'Um bolo de chocolate perfeito para festas de aniversário.', '<p>Um bolo de chocolate perfeito para festas de aniversário.</p>\r\n<b>Ingredientes</b>\r\n<p>Ovos, farinha, açúcar, óleo, leite, chocolate e fermento</p>', 5, 5, 0, '7.00', '5.00', '1.61', 1, '2021-02-13 23:50:56'),
(9, 'Bolo de bolacha 600g', 'bolo_bolacha.png', 'O tradicional bolo de bolacha pronto para degustar\r\n', '<p>O tradicional bolo de bolacha pronto para degustar</p>\r\n<b>Ingredientes</b>\r\n<p>Bolacha torrada, manteiga,  açúcar em pó, ovos, café bolacha ralada para decorar</p>\r\n', 5, 5, 10, '6.00', '4.88', '1.12', 1, '2021-02-13 23:54:01'),
(10, 'Farinheira', 'Farinheira.png', 'Farinheira', '<b>Ingredientes</b>\r\n<p>Farinha de trigo, Gordura fundida de porco, Massa de pimentão, Colorau, Pimenta, Vinho branco, Sal, Tripa de vaca </p>', 2, 4, 40, '2.00', '1.77', '0.23', 1, '2021-02-14 00:09:00'),
(11, 'Chouriço', 'Chourço.png', 'Chourço de porco', '<b>Ingredientes</b>\r\n<p>Perna de porco (rabadilha),  entremeada,  toucinho,  alho, pimentão, colorau,  pimenta preta,  Sal  água (ou vinho branco na versão beirã), Tripa fina fresca, de porco</p>', 2, 4, 60, '3.00', '2.65', '0.35', 1, '2021-02-14 00:12:54'),
(12, 'Presunto 1kg ', 'presunto.png', 'Presunto perna de porco', '<b>Ingredientes</b>\r\nPernil suíno, vinho tinto, sal, açúcar mascavo,  antioxidante ,alho, sal de cura , pimenta do reino preta', 3, 4, 5, '20.00', '18.18', '1.82', 1, '2021-02-14 00:14:55'),
(13, 'Bolo de Laranja', 'bolo_laranja.png', 'Um delicioso e simples bolo de laranja', '<b>Ingredientes</b>\r\n<p>Ovos,  açúcar, sumo de laranja,raspa de laranja,farinha com fermento</p>', 5, 3, 10, '4.00', '3.25', '0.75', 1, '2021-02-14 00:16:18'),
(14, 'Licor 1L', 'dollhouse_miniature_brown_unlabeled_liquor_bottles1.jpeg', 'Licor', 'Licor', 4, 1, 9, '8.00', '6.00', '1.84', 0, '2021-02-14 15:34:06');

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
(1, 2, 1, 1, 1, '3.00', '0.39', '2021-02-14 15:40:19', 0),
(2, 2, 1, 1, 1, '15.00', '2.24', '2021-02-14 16:02:15', 2);

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
(1, 1, 4, 1, '3.00', '0.39', 0, '2021-02-14 15:40:19'),
(2, 2, 14, 1, '8.00', '1.84', 1, '2021-02-14 16:02:15'),
(3, 2, 1, 1, '7.00', '0.40', 1, '2021-02-14 16:02:15');

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
(1, 2, 'Rodolfo Barreira', 226831469, 927718775, 'Torres Vedras', 'Torres Vedras', '2560', '2021-02-14 15:40:19', NULL, 1);

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
(1, 'Rodolfo Barreira', 'rodolfo-barreira@hotmail.com', 226831469, '1998-03-31', '$2y$10$HIl9fVXofH4YFNGvV1PRY.RsnKtN6SvZWwO2sPGFcke0ctUv5om7u', NULL, '7771de302a5c2d6d84c7eee28740d97b', 3, NULL, 1, '2020-11-15 20:37:53', '2020-11-15 20:37:53'),
(2, 'Utilizador Comum', 'usercomum@gmail.com', 123456789, '2000-03-31', '$2y$10$Aij1g7vUleMjkgw1GAj4C.omgHMp1L5I0y.1ZGCm.DEt7HAq5FbRa', NULL, '146a70141050d4b8a580a5aee9bf5534', 1, NULL, 2, '2020-12-20 20:50:04', '2020-12-20 20:50:04'),
(3, 'Vinhos Oeste', 'vinhos@oeste.pt', 123456781, '1997-07-31', '$2y$10$zoh//JbXis5ZbnWQRh2mzOkQmyA9ZxpO111oXmYHrq6a.OihNknnO', NULL, '0718c9704202cb41ed2392bb5083d392', 2, 1, 1, '2020-12-20 20:50:04', '2021-02-13 00:52:34'),
(15, 'Queijo Legítimo', 'queijo@queijolegitimo.pt', 912345678, '2021-02-14', '$2y$10$3UbltceRXVyUIJZxXWqdwOaRVGm/otsTBjtjsem.aya/iesUbImm.', NULL, 'f853c272e54379d63f36bbd2906a8191', 2, 2, 1, '2021-02-14 16:58:41', '2021-02-14 16:58:41');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_cart`
--

CREATE TABLE `user_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Índices para tabela `user_cart`
--
ALTER TABLE `user_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `billing_address`
--
ALTER TABLE `billing_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `permission_assignment`
--
ALTER TABLE `permission_assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `sales_group`
--
ALTER TABLE `sales_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `sales_product`
--
ALTER TABLE `sales_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `shipping_address`
--
ALTER TABLE `shipping_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `user_cart`
--
ALTER TABLE `user_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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

--
-- Limitadores para a tabela `user_cart`
--
ALTER TABLE `user_cart`
  ADD CONSTRAINT `user_cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `user_cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
