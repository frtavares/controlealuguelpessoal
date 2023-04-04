-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Abr-2023 às 02:24
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `controlealuguel`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `anos`
--

CREATE TABLE `anos` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `ano` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `anos`
--

INSERT INTO `anos` (`id`, `status`, `ano`) VALUES
(1, 1, '2023'),
(2, 1, '2024');

-- --------------------------------------------------------

--
-- Estrutura da tabela `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL,
  `entrada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `codigo` varchar(255) NOT NULL,
  `container` varchar(11) DEFAULT NULL,
  `client_id` varchar(255) NOT NULL,
  `ship_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `slug` varchar(191) NOT NULL,
  `userlog` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `booking_gallery`
--

CREATE TABLE `booking_gallery` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` int(11) NOT NULL,
  `file_path` varchar(191) NOT NULL,
  `file_name` varchar(191) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `capas`
--

CREATE TABLE `capas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL,
  `dataservico` varchar(20) NOT NULL,
  `code` varchar(11) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `booking` varchar(20) NOT NULL,
  `transportadora_id` varchar(255) NOT NULL,
  `pessoa_id` int(11) NOT NULL,
  `ship_id` varchar(255) NOT NULL,
  `navio` varchar(220) DEFAULT NULL,
  `tara` varchar(255) NOT NULL,
  `iso_id` int(11) NOT NULL,
  `lacre` varchar(255) NOT NULL,
  `lacre2` varchar(220) NOT NULL,
  `danfe` text NOT NULL,
  `cnpj` varchar(255) NOT NULL,
  `placa` varchar(255) NOT NULL,
  `placa2` varchar(20) NOT NULL,
  `pesoentrada` varchar(255) NOT NULL,
  `pesovazio` varchar(255) NOT NULL,
  `pesocarga` varchar(255) NOT NULL,
  `pesobruto` varchar(20) NOT NULL,
  `carga` varchar(220) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `userlog` varchar(225) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module` int(11) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `file_path` varchar(220) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) DEFAULT NULL,
  `valor` varchar(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `fantasia` varchar(220) NOT NULL,
  `cnpj` varchar(255) NOT NULL,
  `cep` varchar(255) NOT NULL,
  `logradouro` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `complemento` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `municipio` varchar(225) NOT NULL,
  `uf` varchar(255) NOT NULL,
  `email` varchar(225) NOT NULL,
  `namecnpj` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `isos`
--

CREATE TABLE `isos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `manuseios`
--

CREATE TABLE `manuseios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(220) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `meses`
--

CREATE TABLE `meses` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `mes` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `occupations`
--

CREATE TABLE `occupations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pendencias`
--

CREATE TABLE `pendencias` (
  `pendencia_id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL,
  `referencia` varchar(191) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

CREATE TABLE `pessoas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) DEFAULT NULL,
  `cpf` varchar(255) NOT NULL,
  `namecpf` varchar(220) NOT NULL,
  `name` varchar(255) NOT NULL,
  `occupation_id` int(11) DEFAULT NULL,
  `matricula` varchar(20) NOT NULL,
  `userlog` varchar(55) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL DEFAULT 0,
  `file_path` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `client_id` int(11) NOT NULL,
  `cnpj_id` int(11) NOT NULL,
  `inventory` int(11) NOT NULL DEFAULT 0,
  `in_discount` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `content` text NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `product_gallery`
--

CREATE TABLE `product_gallery` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `product_inventory`
--

CREATE TABLE `product_inventory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `limited` int(11) NOT NULL,
  `minimum` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rents`
--

CREATE TABLE `rents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) DEFAULT NULL,
  `code` varchar(255) NOT NULL,
  `client_id` int(11) NOT NULL,
  `mes_id` int(11) NOT NULL,
  `ano_id` int(11) NOT NULL,
  `vencimento` datetime NOT NULL,
  `valor` decimal(11,2) NOT NULL,
  `desconto` decimal(11,2) DEFAULT NULL,
  `referenciadesconto` varchar(191) DEFAULT NULL,
  `condominio` decimal(11,2) DEFAULT NULL,
  `referenciacondominio` varchar(191) DEFAULT NULL,
  `taxaextra` decimal(11,2) DEFAULT NULL,
  `referenciataxa` varchar(191) DEFAULT NULL,
  `taxaincendio` decimal(10,0) DEFAULT NULL,
  `referenciataxaincendio` varchar(255) DEFAULT NULL,
  `iptu` decimal(10,0) DEFAULT NULL,
  `referenciaiptu` varchar(255) DEFAULT NULL,
  `seguro` decimal(11,2) NOT NULL,
  `total` decimal(11,2) DEFAULT NULL,
  `subtotal` decimal(11,2) NOT NULL,
  `observacoes` text DEFAULT NULL,
  `slug` varchar(200) NOT NULL,
  `userlog` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ships`
--

CREATE TABLE `ships` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `file_path` varchar(220) NOT NULL,
  `file_name` varchar(220) NOT NULL,
  `content` text NOT NULL,
  `sorder` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL,
  `dataservico` varchar(191) NOT NULL,
  `code` varchar(191) NOT NULL,
  `client_id` varchar(191) NOT NULL,
  `booking` varchar(191) NOT NULL,
  `transportadora_id` int(11) NOT NULL,
  `pessoa_id` int(11) NOT NULL,
  `ship_id` varchar(191) NOT NULL,
  `navio` varchar(255) NOT NULL,
  `tara` varchar(255) NOT NULL,
  `tipocarga_id` int(11) NOT NULL,
  `lacre` varchar(191) NOT NULL,
  `lacre2` varchar(191) NOT NULL,
  `danfe` varchar(191) NOT NULL,
  `cnpj` varchar(191) NOT NULL,
  `placa` varchar(191) NOT NULL,
  `placa2` varchar(191) NOT NULL,
  `pesoentrada` varchar(191) NOT NULL,
  `pesovazio` varchar(191) NOT NULL,
  `pesocarga` varchar(191) NOT NULL,
  `pesobruto` varchar(191) NOT NULL,
  `carga` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `userlog` varchar(191) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipocargas`
--

CREATE TABLE `tipocargas` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `transportadoras`
--

CREATE TABLE `transportadoras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `fantasia` varchar(220) NOT NULL,
  `cnpj` varchar(255) NOT NULL,
  `cep` varchar(255) NOT NULL,
  `logradouro` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `complemento` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `municipio` varchar(225) NOT NULL,
  `uf` varchar(255) NOT NULL,
  `email` varchar(225) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `namecnpj` varchar(220) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `unitizations`
--

CREATE TABLE `unitizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL,
  `entrada` varchar(20) NOT NULL DEFAULT current_timestamp(),
  `service_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `client_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `userlog` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `unitization_gallery`
--

CREATE TABLE `unitization_gallery` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `role` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `password_code` varchar(255) DEFAULT NULL,
  `permissions` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `status`, `role`, `name`, `lastname`, `email`, `avatar`, `phone`, `birthday`, `gender`, `email_verified_at`, `password`, `password_code`, `permissions`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'admin', 'admin', 'admin@admin.com', NULL, NULL, NULL, NULL, NULL, '$2y$10$tokvuExCT24U0YyiAJMHkeM3h7LzJHZ3q7gNskhhuFRLGwePApl7W', NULL, '{\"dashboard\":\"true\",\"dashboard_small_stats\":\"true\",\"dashboard_sell_today\":\"true\",\"products\":\"true\",\"product_add\":\"true\",\"product_edit\":\"true\",\"product_search\":\"true\",\"product_delete\":\"true\",\"product_gallery_add\":\"true\",\"product_gallery_delete\":\"true\",\"product_inventory\":\"true\",\"categories\":\"true\",\"category_add\":\"true\",\"category_edit\":\"true\",\"category_delete\":\"true\",\"bookings\":\"true\",\"booking_add\":\"true\",\"booking_edit\":\"true\",\"booking_delete\":\"true\",\"booking_search\":\"true\",\"booking_gallery_add\":\"true\",\"booking_gallery_delete\":\"true\",\"booking_pdf\":\"true\",\"booking_gallery\":\"true\",\"clients\":\"true\",\"client_add\":\"true\",\"client_edit\":\"true\",\"client_search\":\"true\",\"client_delete\":\"true\",\"pessoas\":\"true\",\"pessoa_add\":\"true\",\"pessoa_edit\":\"true\",\"pessoa_search\":\"true\",\"pessoa_delete\":\"true\",\"pessoa_pdf\":\"true\",\"services\":\"true\",\"service_add\":\"true\",\"service_edit\":\"true\",\"service_search\":\"true\",\"service_delete\":\"true\",\"ships\":\"true\",\"ship_add\":\"true\",\"ship_edit\":\"true\",\"ship_search\":\"true\",\"ship_delete\":\"true\",\"transportadoras\":\"true\",\"transportadora_add\":\"true\",\"transportadora_edit\":\"true\",\"transportadora_search\":\"true\",\"transportadora_delete\":\"true\",\"isos\":\"true\",\"iso_add\":\"true\",\"iso_edit\":\"true\",\"iso_search\":\"true\",\"iso_delete\":\"true\",\"tipocargas\":\"true\",\"tipocarga_add\":\"true\",\"tipocarga_edit\":\"true\",\"tipocarga_search\":\"true\",\"tipocarga_delete\":\"true\",\"manuseios\":\"true\",\"manuseio_add\":\"true\",\"manuseio_edit\":\"true\",\"manuseio_search\":\"true\",\"manuseio_delete\":\"true\",\"capas\":\"true\",\"capa_add\":\"true\",\"capa_edit\":\"true\",\"capa_search\":\"true\",\"capa_delete\":\"true\",\"capa_pdf\":\"true\",\"rents\":\"true\",\"rent_add\":\"true\",\"rent_edit\":\"true\",\"rent_search\":\"true\",\"rent_delete\":\"true\",\"rent_pdf\":\"true\",\"tickets\":\"true\",\"ticket_add\":\"true\",\"ticket_edit\":\"true\",\"ticket_search\":\"true\",\"ticket_delete\":\"true\",\"ticket_pdf\":\"true\",\"user_list\":\"true\",\"user_edit\":\"true\",\"user_banned\":\"true\",\"user_permissions\":\"true\",\"sliders_list\":\"true\",\"slider_add\":\"true\",\"slider_edit\":\"true\",\"slider_delete\":\"true\",\"settings\":\"true\",\"orders_list\":\"true\"}', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_favorites`
--

CREATE TABLE `user_favorites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `module` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `anos`
--
ALTER TABLE `anos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bookings_name_unique` (`codigo`);

--
-- Índices para tabela `booking_gallery`
--
ALTER TABLE `booking_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `capas`
--
ALTER TABLE `capas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Índices para tabela `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_cnpj_unique` (`cnpj`);

--
-- Índices para tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `isos`
--
ALTER TABLE `isos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `manuseios`
--
ALTER TABLE `manuseios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `meses`
--
ALTER TABLE `meses`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `occupations`
--
ALTER TABLE `occupations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Índices para tabela `pendencias`
--
ALTER TABLE `pendencias`
  ADD PRIMARY KEY (`pendencia_id`);

--
-- Índices para tabela `pessoas`
--
ALTER TABLE `pessoas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `visitors_cpf_unique` (`cpf`);

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_name_unique` (`name`);

--
-- Índices para tabela `product_gallery`
--
ALTER TABLE `product_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `product_inventory`
--
ALTER TABLE `product_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `rents`
--
ALTER TABLE `rents`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_name_unique` (`name`);

--
-- Índices para tabela `ships`
--
ALTER TABLE `ships`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tipocargas`
--
ALTER TABLE `tipocargas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `transportadoras`
--
ALTER TABLE `transportadoras`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Índices para tabela `user_favorites`
--
ALTER TABLE `user_favorites`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `anos`
--
ALTER TABLE `anos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `booking_gallery`
--
ALTER TABLE `booking_gallery`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `capas`
--
ALTER TABLE `capas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `isos`
--
ALTER TABLE `isos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `manuseios`
--
ALTER TABLE `manuseios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `meses`
--
ALTER TABLE `meses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `occupations`
--
ALTER TABLE `occupations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pendencias`
--
ALTER TABLE `pendencias`
  MODIFY `pendencia_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `product_gallery`
--
ALTER TABLE `product_gallery`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `product_inventory`
--
ALTER TABLE `product_inventory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `rents`
--
ALTER TABLE `rents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ships`
--
ALTER TABLE `ships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tipocargas`
--
ALTER TABLE `tipocargas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `transportadoras`
--
ALTER TABLE `transportadoras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `user_favorites`
--
ALTER TABLE `user_favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
