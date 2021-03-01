-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Mar-2021 às 08:17
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `laravelcms`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_02_27_155140_create_all_tables', 1),
(2, '2021_02_28_031216_create_settings_table', 2),
(3, '2021_02_28_062131_create_pages_table', 3),
(4, '2021_02_28_192419_create_visitors_table', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `body`) VALUES
(2, 'Sobre a empresa', 'sobre-a-empresa', '<p><img src=\"http://127.0.0.1:8000/media/images/1614539980.jpg\" alt=\"\" width=\"1028\" height=\"578\" /></p>'),
(3, 'teste Legal aqui', 'teste-legal-aqui', 'Descubra aqui como programar em javascript'),
(4, 'Desenvolvedor júnior', 'desenvolvedor-junior', 'Conteúdo aqui');

-- --------------------------------------------------------

--
-- Estrutura da tabela `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `settings`
--

INSERT INTO `settings` (`id`, `name`, `content`) VALUES
(1, 'title', 'Developer'),
(2, 'subtitle', 'Descubra o poder da programação!'),
(3, 'email', 'contato@site.com'),
(4, 'bgcolor', '#1640da'),
(5, 'textcolor', '#00ff84');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `admin`) VALUES
(1, 'Daniel Ferreira', 'daniel@gmail.com', '$2y$10$RseFb2kyI9.jDft6n0zefu0UhsVYG297nZbCzViXyzg75RYhe0ANa', 'KnGKD9FuwM7FIUtxloGL3HWKH9E3TGsWz6SykHRGhtb1YSkINWSLtzajY8PV', 1),
(2, 'Rebeca Rocha', 'rebecfunk_jk@hotmail.com', '$2y$10$PGJmNUkx7yV3u4J0KRShdupv3mFBjEzT4b8XqavG8PEyV1w67uJLO', NULL, 0),
(3, 'Vanderson Marcelino', 'vanderson1995@gmail.com', '$2y$10$Y4iimCnwcZTdQmHydQ5x6u8UX58QrqMUqEtxsZsWL1SRNkmrwLiH2', NULL, 0),
(4, 'Cláudio Benedito', 'claudito@bol.com', '$2y$10$yf0L9Edv7CPzKFT0hr7mXOYvHCAU5I5tftXv5j7ao15w1N69ULOQS', NULL, 0),
(5, 'Robson Santos', 'rob1996@gmail.com', '$2y$10$aZUubgnzgX1lDxOebDaKJeM1nhJGDDsZ7yEdBHDYQ7TYcIXB9eaR6', NULL, 0),
(6, 'Clodoaldo Alberto', 'clodogt_fit@yahoo.com.br', '$2y$10$rHN/DyZX8iJYSDRC9CQOn.6TlUuryQ0q.AiKEGuiWLkL40NdBJhXe', NULL, 0),
(7, 'Quitéria Valentina', 'quiteval@gmail.com', '$2y$10$86fbVDvJ5hBCSzsTa2TXMexQ1KfvyFMIiDZRzZOhMtuuSkcQHbXXK', NULL, 0),
(8, 'Roberval Andrade', 'roberval_tiktok@gmail.com', '$2y$10$T.4oM.XgL2eaA14p5zcOrur1hzvAowRcH4l2pTBmhep.Chcu3U3s2', NULL, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `visitors`
--

CREATE TABLE `visitors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_access` datetime NOT NULL,
  `page` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `visitors`
--

INSERT INTO `visitors` (`id`, `ip`, `date_access`, `page`) VALUES
(1, '1', '2021-02-27 11:00:00', '/'),
(2, '2', '2021-02-26 05:00:00', '/'),
(3, '1', '2021-02-24 14:00:00', '/teste'),
(4, '4', '2021-01-03 11:00:00', '/');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Índices para tabela `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
