-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15-Nov-2020 às 21:31
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
(1, 'Categoria 1', '23');

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
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `image`, `description`, `status`, `created_date`) VALUES
(1, 'Isell&Repair', 'https://cdn.shopify.com/s/files/1/0245/0010/9358/files/LOGO_FUNDO_CINZA_100x.png?v=1581444243', 'A iSell&Repair é uma empresa de venda de equipamentos eletrónicos, tais como telemóveis, tablets e computadores', 1, '2020-11-15 00:00:00');

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `permission_assignment`
--

CREATE TABLE `permission_assignment` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='atribuição de permissões';

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
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `product_name`, `image`, `small_description`, `big_description`, `category_id`, `company_id`, `quantity_in_stock`, `price`, `price_without_iva`, `price_iva`, `created_date`) VALUES
(1, 'Produto 1', NULL, NULL, NULL, 1, 1, 10, '10.00', '7.70', '2.30', '2020-11-15 20:07:29'),
(2, 'Produto 2', NULL, NULL, NULL, 1, 1, 10, '10.00', '7.70', '2.30', '2020-11-15 20:07:43'),
(3, 'Produto 3', NULL, NULL, NULL, 1, 1, 10, '10.00', '7.70', '2.30', '2020-11-15 20:07:43'),
(4, 'Produto 4', NULL, NULL, NULL, 1, 1, 10, '10.00', '7.70', '2.30', '2020-11-15 20:07:43'),
(5, 'Produto 5', NULL, NULL, NULL, 1, 1, 10, '10.00', '7.70', '2.30', '2020-11-15 20:07:43'),
(6, 'Produto 6', NULL, NULL, NULL, 1, 1, 10, '10.00', '7.70', '2.30', '2020-11-15 20:07:43'),
(7, 'Produto 7', NULL, NULL, NULL, 1, 1, 10, '10.00', '7.70', '2.30', '2020-11-15 20:07:43'),
(8, 'Produto 8', NULL, NULL, NULL, 1, 1, 10, '10.00', '7.70', '2.30', '2020-11-15 20:07:43'),
(9, 'Produto 9', NULL, NULL, NULL, 1, 1, 10, '10.00', '7.70', '2.30', '2020-11-15 20:07:43'),
(10, 'Produto 10', NULL, NULL, NULL, 1, 1, 10, '10.00', '7.70', '2.30', '2020-11-15 20:07:43'),
(11, 'Produto 11', NULL, NULL, NULL, 1, 1, 10, '10.00', '7.70', '2.30', '2020-11-15 20:07:43'),
(12, 'Produto 12', NULL, NULL, NULL, 1, 1, 10, '10.00', '7.70', '2.30', '2020-11-15 20:07:43');

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
  `total_price` decimal(11,2) NOT NULL,
  `total_iva` decimal(11,2) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL COMMENT '0-por pagar 1-pago 2-cancelado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `zip_code` int(11) NOT NULL COMMENT 'codigo postal',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0-inativo 1-ativo 2-apagado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='morada de envio';

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nif` int(9) NOT NULL,
  `birthday_date` date DEFAULT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT 1 COMMENT '1-utilizador 2-empresa 3-admin',
  `status` smallint(6) NOT NULL DEFAULT 1 COMMENT '0-inativo 1-ativo 2-banido',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `nif`, `birthday_date`, `password_hash`, `password_reset_token`, `role_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Rodolfo Barreira', 'rodolfo-barreira@hotmail.com', 226831469, '1998-03-31', '$2y$10$iU..PsIubR5BbdrKDoq/OOvKbsV0Mc1vGnlx4LaGfrP..fkHpJPz2', NULL, 1, 1, '2020-11-15 20:37:53', '2020-11-15 20:37:53');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `billing_address`
--
ALTER TABLE `billing_address`
  ADD PRIMARY KEY (`id`);

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
-- Índices para tabela `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `permission_assignment`
--
ALTER TABLE `permission_assignment`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `shipping_address_id` (`shipping_address_id`);

--
-- Índices para tabela `sales_product`
--
ALTER TABLE `sales_product`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `shipping_address`
--
ALTER TABLE `shipping_address`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nif` (`nif`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `permission_assignment`
--
ALTER TABLE `permission_assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sales_product`
--
ALTER TABLE `sales_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `shipping_address`
--
ALTER TABLE `shipping_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

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
  ADD CONSTRAINT `sales_group_ibfk_3` FOREIGN KEY (`shipping_address_id`) REFERENCES `shipping_address` (`id`);

--
-- Limitadores para a tabela `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
