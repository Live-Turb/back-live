-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 04/05/2025 às 12:23
-- Versão do servidor: 10.11.11-MariaDB-cll-lve
-- Versão do PHP: 8.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `live5006_live`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `anuncios`
--

CREATE TABLE `anuncios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `tag_principal` varchar(50) NOT NULL,
  `data_anuncio` date NOT NULL,
  `nicho` varchar(255) NOT NULL,
  `pais_codigo` char(2) NOT NULL,
  `status` enum('Ativo','Inativo') NOT NULL,
  `novo_anuncio` tinyint(1) NOT NULL DEFAULT 0,
  `destaque` tinyint(1) NOT NULL DEFAULT 0,
  `tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tags`)),
  `imagem` varchar(255) DEFAULT NULL,
  `url_video` text DEFAULT NULL,
  `produto_tipo` enum('Infoproduto','Produto Físico','Serviço','Assinatura') NOT NULL,
  `produto_estrutura` enum('VSL','PLR','Webinar','Carta de Vendas') NOT NULL,
  `produto_idioma` varchar(255) NOT NULL,
  `produto_rede_trafego` varchar(255) NOT NULL,
  `produto_funil_vendas` varchar(255) NOT NULL,
  `link_pagina_anuncio` text DEFAULT NULL,
  `link_criativos_fb` text DEFAULT NULL,
  `link_anuncios_escalados` text DEFAULT NULL,
  `link_site_cloaker` text DEFAULT NULL,
  `contador_anuncios` int(11) NOT NULL DEFAULT 0,
  `variacao_diaria` int(11) NOT NULL DEFAULT 0 COMMENT 'Número absoluto de anúncios nas últimas 24h',
  `variacao_semanal` int(11) NOT NULL DEFAULT 0 COMMENT 'Número absoluto de anúncios nos últimos 7 dias',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `numero_anuncios` int(11) NOT NULL DEFAULT 0 COMMENT 'Quantidade total de anúncios associados',
  `numero_criativos` int(11) NOT NULL DEFAULT 0 COMMENT 'Quantidade total de criativos vinculados (calculado automaticamente)',
  `link_transcricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `anuncios`
--

INSERT INTO `anuncios` (`id`, `titulo`, `tag_principal`, `data_anuncio`, `nicho`, `pais_codigo`, `status`, `novo_anuncio`, `destaque`, `tags`, `imagem`, `url_video`, `produto_tipo`, `produto_estrutura`, `produto_idioma`, `produto_rede_trafego`, `produto_funil_vendas`, `link_pagina_anuncio`, `link_criativos_fb`, `link_anuncios_escalados`, `link_site_cloaker`, `contador_anuncios`, `variacao_diaria`, `variacao_semanal`, `deleted_at`, `created_at`, `updated_at`, `numero_anuncios`, `numero_criativos`, `link_transcricao`) VALUES
(1, 'Maratona Vocal VSL - Lead 01', 'ESCALANDO', '2025-03-27', 'Renda Extra', 'BR', 'Ativo', 1, 1, '[\"Relacionamento\",\"Low Ticket\",\"VSL\",\"Nutra\"]', 'anuncios/1743270217_vocal.jpeg', 'https://dtjx5no407kii.cloudfront.net/13d12e8bd9fe53a44f403034588d9596-Maratona%20Vocal%20VSL.video/mp4', 'Infoproduto', 'VSL', 'Portugues', 'Facebook', 'Facebook > Pagina de vendas', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=324660370720659', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&q=%22WWW.WESLEYMOREIRAVOZ.COM.BR%2F%22&search_type=keyword_exact_phrase', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=824199217614391', 'https://wesleymoreiravoz.com.br/maratonavocal/', 0, -457, -457, NULL, '2025-03-27 17:08:30', '2025-05-02 19:07:31', 607, 8, 'https://prod-minio.ja6ipr.easypanel.host/american-producao/680eaa4f37aaee01d44d1e5f2209aee3-Maratona%20Vocal.application/vnd.openxmlformats-officedocument.wordprocessingml.document'),
(2, 'Teste anuncio 2', 'TESTE', '2025-03-28', 'Maternidade', 'US', 'Ativo', 0, 1, '\"[]\"', NULL, 'https://www.youtube.com/watch?v=3ghG2E0vhoo', 'Infoproduto', 'VSL', 'ingles', 'Facebook', 'Facebook > Pagina de vendas', 'https://testedepagina.com', NULL, 'https://anuncioescalado.com', 'https://liveturb.com', 0, 0, 0, '2025-03-28 20:19:00', '2025-03-28 19:28:19', '2025-03-28 20:19:00', 211, 0, NULL),
(3, 'Conteúdos Virais com IA', 'ESCALANDO', '2025-04-09', 'Pack', 'BR', 'Ativo', 1, 0, '[\"Low Ticket\"]', 'anuncios/1744240852_foto anuncio.png', 'https://www.youtube.com/watch?v=3ghG2E0vhoo', 'Infoproduto', 'Carta de Vendas', 'Portugues', 'Facebook', 'Facebook > Pagina de vendas', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=229804133549730', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&q=%22TROKAJOTREINAMENTOS.ONLINE%22&search_type=keyword_exact_phrase', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&q=%22TROKAJOTREINAMENTOS.ONLINE%22&search_type=keyword_exact_phrase', 'https://trokajotreinamentos.online/metodocv#1', 0, -2, -104, NULL, '2025-04-10 02:20:52', '2025-04-26 21:31:53', 228, 9, NULL),
(4, 'Curcury Vision', 'ESCALANDO', '2025-04-10', 'visão', 'BR', 'Ativo', 1, 0, '[\"Nutrac\\u00eautico\"]', 'anuncios/1744337967_b82deba6-14f9-4247-87b8-d3ee562846b8.jpeg', 'https://prod-minio.ja6ipr.easypanel.host/american-producao/8be3581e-d550-40a4-81bf-69ebd19aaff8.m3u8', 'Produto Físico', 'VSL', 'Portugues', 'Facebook', 'Facebook > Pagina de vendas', 'https://www.facebook.com/ads/library/?id=1200410831655420', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&q=%22VISILAB.ONLINE%22&search_type=keyword_exact_phrase&source=page-transparency-widget', 'https://www.facebook.com/ads/library/?id=1200410831655420', 'https://clinicavision.online/cury-direto/', 0, 4, 4, NULL, '2025-04-11 02:06:19', '2025-04-26 21:31:53', 99, 5, 'https://prod-minio.ja6ipr.easypanel.host/american-producao/9fa35f3c-4346-493e-89fa-828599c1ba1a'),
(5, 'A Verdadeira Páscoa', 'ESCALANDO', '2025-04-10', 'Evangélico/Cristianismo', 'BR', 'Ativo', 1, 0, '[\"Low Ticket\"]', 'anuncios/1744336852_3c6e3997-bd60-4aca-9b40-ba9867c693b1.png', NULL, 'Infoproduto', 'Carta de Vendas', 'Portugues', 'Facebook', 'Facebook > Pagina de vendas', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=101205485975449', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&q=%22WWW.VERDADEIRA-PASCOA.COM%22&search_type=keyword_exact_phrase', 'https://www.facebook.com/ads/library/?id=491955150662220', 'https://comportamentopositivo.com/semanasanta/', 0, -2, -382, NULL, '2025-04-11 03:02:39', '2025-04-26 21:31:53', 77, 7, NULL),
(6, '10 Mil Esboços de Sermões', 'ESCALANDO', '2025-04-10', 'Evangélico/Cristianismo', 'BR', 'Ativo', 1, 0, '[\"Low Ticket\"]', 'anuncios/1744330899_6ea19bb16faec361f389b02895b81443-Captura de tela 2025-02-25 160401.jpg', NULL, 'Infoproduto', 'Carta de Vendas', 'Portugues', 'Facebook', 'Facebook > Pagina de vendas', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=518671521334913', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&q=%22PORTALDOPREGADOR.COM%22&search_type=keyword_exact_phrase', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=518671521334913', 'https://portaldopregador.com/portal-do-pregador-10-mil-sermoes-impactantes-prontos/?fbclid=IwZXh0bgNhZW0BMABhZGlkAasY1asVS3kBHbDPF-c6-8nbxb6TaDaWGJ6_JfV63Xyi1R27Kn9LgWUEoTYLjL2yqd3q9g_aem_o5lY2PazaYZ_HVKoCXfSjw', 0, 6, 10, NULL, '2025-04-11 03:21:39', '2025-04-26 21:31:53', 22, 2, NULL),
(7, 'Lista de Fornecedores', 'ESCALANDO', '2025-04-10', 'Renda Extra', 'BR', 'Ativo', 1, 0, '[\"low ticket\"]', 'anuncios/1744334684_efdc19e648db67481340356913f2310f-Lista de Fornecedores (1).jpg', NULL, 'Infoproduto', 'Carta de Vendas', 'Portugues', 'Facebook', 'Facebook > Pagina de vendas', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=109482248016730', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&q=%22EMPREENDACOMGABY.COM.BR%22&search_type=keyword_exact_phrase', 'https://www.facebook.com/ads/library/?id=1181989720065086', 'https://empreendacomgaby.com.br/lista-de-fornecedores-make/', 0, -60, -140, NULL, '2025-04-11 03:41:33', '2025-04-26 21:31:53', 26, 6, NULL),
(8, 'Bussola das Passagens Baratas', 'ESCALANDO', '2025-04-10', 'Renda Extra', 'BR', 'Ativo', 1, 0, '[\"Relacionamento\",\"Low Ticket\",\"VSL\",\"Nutra\"]', 'anuncios/1744338403_33520239-b8f7-43d7-b548-a87190d2eeeb.jpg', 'https://prod-minio.ja6ipr.easypanel.host/american-producao/1920ca37-97c7-4fb5-bb13-078f6fa2b496.m3u8', 'Infoproduto', 'VSL', 'Portugues', 'Facebook', 'Facebook > Pagina de vendas', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&q=%22ESPECIALISTAEMMILHAS.COM%22&search_type=keyword_exact_phrase', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=345652156802199', 'https://www.facebook.com/ads/library/?id=624967530544937', 'https://especialistaemmilhas.com/bussolapv', 0, -1, 46, NULL, '2025-04-11 05:00:48', '2025-04-26 21:31:53', 12, 4, 'https://prod-minio.ja6ipr.easypanel.host/american-producao/6c59a6be-8c58-4566-9fca-caabe33fc26e'),
(9, 'ROTEIRO DIVINO DE 12 PALAVRAS', 'ESCALANDO', '2025-04-23', 'Lei da Atração/Prosperidade', 'BR', 'Ativo', 1, 1, '[\"EM DESTAQUE\"]', 'anuncios/1745436533_30e1dab3-be33-4ad7-98b0-2aee72df8b57.jpg', 'https://prod-minio.ja6ipr.easypanel.host/american-producao/1bc59f84-17e3-4f52-a07d-ca7c84e3a4ac.m3u8', 'Infoproduto', 'VSL', 'ingles', 'Facebook', 'Facebook > Pagina de vendas', 'https://www.wealthbulider.com/pre24?rtkcid=68014b7cc7e026ba790a4abd&rtkcmpid=67ad04c88a6566afb91a65c7', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&q=%22M.ABUNDANCECALLER.COM%22&search_type=keyword_exact_phrase', 'https://www.wealthbulider.com/pre24?rtkcid=68014b7cc7e026ba790a4abd&rtkcmpid=67ad04c88a6566afb91a65c7', 'https://www.wealthbulider.com/vslfb?rtkcid=67ffd066c7e026ba79e1bb96&rtkcmpid=67ad04c88a6566afb91a65c7', 0, 243, 727, NULL, '2025-04-23 22:24:11', '2025-04-26 21:31:53', 299, 4, 'https://docs.google.com/document/d/1EFait0xOtLtTToMUAFC-KAp8swU0gaqQ/edit?usp=drive_link&ouid=104373462850646115809&rtpof=true&sd=true'),
(10, 'Brecha na loteria', 'ESCALANDO', '2025-04-23', 'Renda Extra', 'US', 'Ativo', 1, 1, '[\"EM DESTAQUE\"]', 'anuncios/1745440853_3c605ad9-d339-4133-af79-6350d4bc6a08.jpg', 'https://prod-minio.ja6ipr.easypanel.host/american-producao/0db75781-0256-4a10-a9a4-aec8105dc05a.m3u8', 'Infoproduto', 'VSL', 'ingles', 'Facebook', 'Facebook > Pagina de vendas', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=101377876274474', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=101377876274474', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=101377876274474', 'https://lottocash.online/mpage/', 0, -90, 46, NULL, '2025-04-23 23:40:53', '2025-04-26 21:31:53', 180, 8, 'https://docs.google.com/document/d/1uutyT2PPhbjirrpr3Aka9poEIaqtE4eD/edit?usp=drive_link&ouid=104373462850646115809&rtpof=true&sd=true'),
(11, 'Ingrediente Bariátrico', 'ESCALANDO', '2025-04-24', 'Emagrecimento', 'ES', 'Ativo', 1, 0, '[\"Nutrac\\u00eautico\",\"Vsl\",\"Emagrecimento\"]', 'anuncios/1745502956_4ce49742-484b-4873-9931-ac4ecebec824.jpg', 'https://drive.google.com/file/d/188D2K2i2FUp8QCEyeN0bCevd7jXwMCys/view?usp=drive_link', 'Infoproduto', 'VSL', 'Espanhol', 'Facebook', 'Facebook > Pagina de vendas', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&source=page-transparency-widget&view_all_page_id=106668348965808', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&source=page-transparency-widget&view_all_page_id=106668348965808', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&source=page-transparency-widget&view_all_page_id=106668348965808', 'https://periodicoman.fun/plantica/', 0, 48, 0, NULL, '2025-04-24 16:55:56', '2025-04-24 18:23:29', 48, 7, 'https://docs.google.com/document/d/1PpKhpqEE19VJhprNHs2aUIXNNGm0rc8y/edit?usp=drive_link&ouid=104373462850646115809&rtpof=true&sd=true'),
(12, 'Seca Jejum', 'ESCALANDO', '2025-04-24', 'Emagrecimento', 'BR', 'Ativo', 1, 0, '[\"Emagrecimento\",\"Low Ticket\",\"Quizz\"]', 'anuncios/1745512402_image.jpeg', 'https://drive.google.com/file/d/1CwetIAhxaSnfIQw5MAypF-W-j3KmUiwG/view?usp=drive_link', 'Produto Físico', 'VSL', 'Portugues', 'Facebook', 'Facebook > Pagina de vendas > Quizz', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&q=%22LP1.SECAJEJUM.COM%22&search_type=keyword_exact_phrase', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&q=%22LP1.SECAJEJUM.COM%22&search_type=keyword_exact_phrase', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&q=%22LP1.SECAJEJUM.COM%22&search_type=keyword_exact_phrase', 'https://lp1.secajejum.com/', 0, -1, 79, NULL, '2025-04-24 19:33:22', '2025-04-28 22:03:00', 28, 4, NULL),
(13, 'Starflix do Empreendedor', 'ESCALANDO', '2025-04-26', 'Renda Extra', 'BR', 'Ativo', 1, 0, '[\"Renda Extra\",\"Escalando\",\"Quizz\",\"Infoproduto\"]', 'anuncios/1745850897_4b543969-03bc-4019-b717-f43ecdd05c7c.png', 'https://liveturb.com/VIDEOS/7e884494-dd05-4968-9897-5e5c2ab872c9.mp4', 'Infoproduto', 'PLR', 'Portugues', 'Facebook', 'Facebook > Quizz', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=276767192177477', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=276767192177477', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=276767192177477', 'https://inlead.digital/starflix-do-empreendedor-digital/', 0, 31, 15, NULL, '2025-04-28 16:51:59', '2025-04-28 17:34:57', 155, 10, 'https://docs.google.com/document/d/1Hm06J0Malkj5k5z3_f39QklveR_eRIB6/edit?usp=sharing&ouid=104373462850646115809&rtpof=true&sd=true'),
(14, 'Faculdade das Unhas', 'ESCALANDO', '2025-04-28', 'Renda Extra', 'BR', 'Ativo', 1, 0, '[\"Outros\",\"Infoproduto\",\"VSL\",\"Renda Extra\"]', 'anuncios/1745851385_d2c123c9-dcc3-4c26-88ad-aeaafa9df8a4.jpeg', 'https://liveturb.com/VIDEOS/43e4d4f6-2101-4770-a085-0c2f58166619.mp4', 'Infoproduto', 'VSL', 'Portugues', 'Facebook', 'Facebook > Pagina de vendas > VSL', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=106399811856016', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=106399811856016', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=106399811856016', 'https://faculdadedanail.com.br/fdu01/', 0, 19, 25, NULL, '2025-04-28 17:43:05', '2025-04-28 21:01:27', 90, 10, 'https://docs.google.com/document/d/1JR5GOobPI_NdgGQzuKFHVPy7O9MWwRp5/edit?usp=sharing&ouid=104373462850646115809&rtpof=true&sd=true'),
(15, 'Projeto 9/90', 'OPORTUNIDADE RAPIDA', '2025-04-28', 'Outros', 'BR', 'Ativo', 1, 0, '[\"Low Ticket\",\"TSL\",\"Facebook\"]', 'anuncios/1745867619_2086a3ad-f403-4d03-9944-83231c3f6a51.jpeg', 'https://liveturb.com/VIDEOS/a4eadf86-a62e-4ac3-ad6b-4431af4506ff.mp4', 'Infoproduto', 'Carta de Vendas', 'Portugues', 'Facebook', 'Facebook > TSL', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&source=page-transparency-widget&view_all_page_id=638352609965268', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&source=page-transparency-widget&view_all_page_id=638352609965268', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&source=page-transparency-widget&view_all_page_id=638352609965268', 'https://donnademim.com.br/9-90-para-elas/', 0, 3, -68, NULL, '2025-04-28 22:13:39', '2025-04-28 23:07:15', 14, 3, 'https://docs.google.com/document/d/1Hm06J0Malkj5k5z3_f39QklveR_eRIB6/edit?usp=sharing&ouid=104373462850646115809&rtpof=true&sd=true'),
(16, '11', 'RECEM ADICIONADO', '2025-04-28', '111', 'BR', 'Ativo', 1, 0, '[\"tag1\",\"tag2\",\"tag3\"]', NULL, NULL, 'Infoproduto', 'VSL', 'Portugues', 'Facebook', 'Facebook > Quizz', NULL, NULL, NULL, NULL, 0, 0, 0, '2025-04-28 22:57:14', '2025-04-28 22:57:07', '2025-04-28 22:57:14', 0, 0, NULL),
(17, 'Método Duração de Respeito', 'RECEM ADICIONADO', '2025-04-28', 'Disfunção Erétil', 'BR', 'Ativo', 1, 0, '[\"Disfun\\u00e7\\u00e3o Er\\u00e9til\",\"Infoproduto\",\"Quizz\"]', 'anuncios/1745870420_5cb5c9a4-2c3d-4aca-8c70-424ecec04d57.jpeg', 'https://liveturb.com/VIDEOS/447b6dd1-d918-436d-bbe3-c5b4363825fb.mp4', 'Infoproduto', 'Carta de Vendas', 'Portugues', 'Facebook', 'Facebook > Quizz', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=397901264370697', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=397901264370697', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=397901264370697', 'https://inlead.digital/emf-ep-142/', 0, 9, -2, NULL, '2025-04-28 23:00:20', '2025-04-28 23:06:16', 69, 8, NULL),
(18, 'Descomplicando a Neutralização', 'RECEM ADICIONADO', '2025-04-28', 'Beleza', 'BR', 'Ativo', 1, 0, '[\"Beleza\",\"Infoproduto\",\"VSL\"]', 'anuncios/1745872737_image.jpeg', 'https://liveturb.com/VIDEOS/55f46e9b-9090-41b2-9bdf-809b382985e5.mp4', 'Infoproduto', 'VSL', 'Portugues', 'Facebook', 'Facebook > Pagina de vendas > VSL', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=307054455826895', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=307054455826895', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=307054455826895', 'https://www.glamacademy.com.br/descomplicando-a-neutralizacao-s/delay', 0, 17, 54, NULL, '2025-04-28 23:38:57', '2025-04-28 23:47:15', 93, 12, 'https://docs.google.com/document/d/1KsnVNVI35JiTuOD1J_i0N9z3c__qI2tz/edit?usp=drive_link&ouid=104373462850646115809&rtpof=true&sd=true'),
(19, 'Cante Bem do Zero', 'RECEM ADICIONADO', '2025-04-28', 'Low Ticket', 'BR', 'Ativo', 1, 0, '[\"Low Ticket\",\"TSL\",\"Facebook\"]', 'anuncios/1745873833_3f208315-c44e-4195-ad3e-db2e7b3cc544.jpeg', 'https://liveturb.com/VIDEOS/cb3f8a70-dd9c-47b8-ab27-438b73bf5625.mp4', 'Infoproduto', 'Carta de Vendas', 'Portugues', 'Facebook', 'Facebook > TSL', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&q=%22CBZQUIZNOVO.XQUIZ.IO%22&search_type=keyword_exact_phrase&source=page-transparency-widget', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&q=%22CBZQUIZNOVO.XQUIZ.IO%22&search_type=keyword_exact_phrase&source=page-transparency-widget', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&q=%22CBZQUIZNOVO.XQUIZ.IO%22&search_type=keyword_exact_phrase&source=page-transparency-widget', 'https://www.direcaovocal.com.br/bio', 0, 8, 0, NULL, '2025-04-28 23:57:13', '2025-04-29 00:01:18', 22, 4, 'https://docs.google.com/document/d/1Hm06J0Malkj5k5z3_f39QklveR_eRIB6/edit'),
(20, 'Mapa do Prazer Masculino', 'RECEM ADICIONADO', '2025-04-29', 'Sexualidade', 'BR', 'Ativo', 1, 0, '[\"Low Ticket\",\"Quizz\",\"Sexualidade\"]', 'anuncios/1745946204_image (1).jpeg', 'https://liveturb.com/VIDEOS/66be11de-931f-49ea-91d3-5aaf91f4d2a3.mp4', 'Infoproduto', 'Carta de Vendas', 'Portugues', 'Facebook', 'Facebook > Quizz', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&q=%22LP.MAPADOPRAZERMASCULINO.SITE%22&search_type=keyword_exact_phrase', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&q=%22LP.MAPADOPRAZERMASCULINO.SITE%22&search_type=keyword_exact_phrase', 'https://www.facebook.com/ads/library/?id=574991031738555', 'https://lp.mapadoprazermasculino.site/', 0, 4, -8, NULL, '2025-04-29 20:03:24', '2025-04-29 20:06:33', 16, 3, 'https://docs.google.com/document/d/1Hm06J0Malkj5k5z3_f39QklveR_eRIB6/edit?usp=sharing&ouid=104373462850646115809&rtpof=true&sd=true'),
(21, 'Cardápio da Cura', 'ESCALANDO', '2025-04-29', 'Outros', 'BR', 'Ativo', 1, 0, '[\"Infoproduto\",\"VSL\",\"Outros\"]', 'anuncios/1745946860_image (1).jpeg', 'https://liveturb.com/VIDEOS/8c49a296-8f17-4702-83fb-0505bab73461.mp4', 'Infoproduto', 'VSL', 'Portugues', 'Facebook', 'Facebook > Pagina de vendas > VSL', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&q=%22NCC.CURAPELAALIMENTACAO.COM.BR%22&search_type=keyword_exact_phrase', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&q=%22NCC.CURAPELAALIMENTACAO.COM.BR%22&search_type=keyword_exact_phrase', 'https://www.facebook.com/ads/library/?id=977692914224954', 'https://ncc.curapelaalimentacao.com.br/ncc', 0, 6, -16, NULL, '2025-04-29 20:14:20', '2025-04-29 20:28:50', 56, 9, 'https://docs.google.com/document/d/1uFHstH7qzipMttBmm78YbuFj-bb2OeLd/edit?usp=sharing&ouid=104373462850646115809&rtpof=true&sd=true'),
(22, 'Mounjaro de Pobre', 'ESCALANDO', '2025-05-01', 'Emagrecimento', 'BR', 'Ativo', 1, 0, '[\"Low Ticket\",\"Quizz\",\"Emagrecimento\"]', 'anuncios/1746133223_fd9f928d-1036-48c1-9df7-bba3278a7b3f.jpeg', 'https://videos.liveturb.com/videos/1/stream', 'Serviço', 'VSL', 'Portugues', 'Facebook', 'Facebook > Quizz', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=536454729542558', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=536454729542558', 'https://www.facebook.com/ads/library/?id=1186326206039799', 'https://quiz.formulacaseira.com/', 0, 2, -14, NULL, '2025-05-02 00:00:23', '2025-05-02 00:07:07', 39, 13, 'https://docs.google.com/document/d/1NvsmvXzoQhLwK7Ay0PxMGU2bkOkeFT1L/edit?usp=sharing&ouid=104373462850646115809&rtpof=true&sd=true'),
(23, 'Salário sem Fronteiras', 'ESCALANDO', '2025-05-01', 'Renda Extra', 'BR', 'Ativo', 1, 0, '[\"Infoproduto\",\"VSL\",\"Renda Extra\"]', 'anuncios/1746135547_image.jpeg', 'https://videos.liveturb.com/videos/2/stream', 'Infoproduto', 'VSL', 'Portugues', 'Facebook', 'Facebook > Pagina de vendas > VSL', 'https://www.facebook.com/renatocarianiatleta/', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&q=%22salariosemfronteiras.com.br%22&search_type=keyword_exact_phrase', 'https://www.facebook.com/ads/library/?id=646088934914999', 'https://salariosemfronteiras.com.br/vsl-a-7/?utm_medium=ads_fb&utm_source=%7B%7Bsite_source_name%7D%7D_%7B%7Bplacement%7D%7D&utm_campaign=%7B%7Bcampaign.name%7D%7D&utm_term=%7B%7Badset.name%7D%7D&utm_content=%7B%7Bad.name%7D%7D', 0, 4, 34, NULL, '2025-05-02 00:39:07', '2025-05-02 00:45:25', 110, 12, 'https://docs.google.com/document/d/1YUk1zat7lp9o69-8rrJWFiN1Yapm-dpU/edit?usp=sharing&ouid=104373462850646115809&rtpof=true&sd=true'),
(24, 'Estilo Infinito', 'EVOLUINDO RAPIDO', '2025-05-01', 'Moda', 'BR', 'Ativo', 1, 0, '[\"Moda\",\"Low Ticket\",\"TSL\"]', 'anuncios/1746137270_2da0a3a3-555f-49d4-a284-a77c9841b152.jpeg', 'https://docs.google.com/document/d/1Hm06J0Malkj5k5z3_f39QklveR_eRIB6/edit?usp=sharing&ouid=104373462850646115809&rtpof=true&sd=true', 'Infoproduto', 'Carta de Vendas', 'Portugues', 'Facebook', 'Facebook > TSL', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&q=%22FERNANDACAPUCHO.COM.BR%22&search_type=keyword_exact_phrase', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&q=%22FERNANDACAPUCHO.COM.BR%22&search_type=keyword_exact_phrase', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&q=%22FERNANDACAPUCHO.COM.BR%22&search_type=keyword_exact_phrase', 'https://fernandacapucho.com.br/ebook-estilo-infinito-100-looks-com-apenas-25-pecas/', 0, 8, 3, NULL, '2025-05-02 01:07:18', '2025-05-02 01:10:32', 58, 5, 'https://docs.google.com/document/d/1Hm06J0Malkj5k5z3_f39QklveR_eRIB6/edit?usp=sharing&ouid=104373462850646115809&rtpof=true&sd=true'),
(25, 'Raiz Anti-Diabetes', 'OPORTUNIDADE RAPIDA', '2025-04-30', 'Nutracêutico', 'BR', 'Ativo', 1, 0, '[\"Nutrac\\u00eautico\",\"VSL\",\"Diabetes\"]', 'anuncios/1746138190_image.jpeg', 'https://videos.liveturb.com/videos/3/stream', 'Produto Físico', 'VSL', 'Portugues', 'Facebook', 'Facebook > Pagina de vendas > VSL', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=108724675220815', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=108724675220815', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=108724675220815', 'https://track.blogvivanatu.com/86b4kczr6', 0, 4, -3, NULL, '2025-05-02 01:23:10', '2025-05-02 01:33:10', 82, 22, 'https://docs.google.com/document/d/1SVLVhr-YwfVVRK0m4RAnqtZypmoCO9X5/edit?usp=sharing&ouid=104373462850646115809&rtpof=true&sd=true'),
(26, 'Oferta Prosperidade (França)', 'RECEM ADICIONADO', '2025-05-01', 'Renda Extra', 'CA', 'Ativo', 1, 0, '[\"Renda Extra\",\"Escalando\",\"Fran\\u00e7a\",\"Infoproduto\"]', 'anuncios/1746141546_cover.jpg', 'https://videos.liveturb.com/videos/4/stream', 'Infoproduto', 'VSL', 'Frances', 'Facebook', 'Facebook > Pagina de vendas > VSL', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=113097815059392', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=113097815059392', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=113097815059392', 'https://abundanciainf.online/9fr/', 0, 3, 0, NULL, '2025-05-02 02:19:06', '2025-05-02 02:24:44', 38, 10, 'https://docs.google.com/document/d/1CX3VNA-saOjfUJfQ1BclR7f_CXfh_V6Y/edit?usp=sharing&ouid=104373462850646115809&rtpof=true&sd=true'),
(27, 'Picoles de Bolos', 'RECEM ADICIONADO', '2025-05-02', 'Renda Extra', 'BR', 'Ativo', 1, 1, '[\"Renda Extra\",\"Infoproduto\",\"Low Tiket\",\"Quiz\"]', 'anuncios/1746220042_cake-pop-picole.jpg', 'https://videos.liveturb.com/videos/5/stream', 'Infoproduto', 'Carta de Vendas', 'Portugues', 'Facebook', 'Facebook > Quizz', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=532436566616095', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=532436566616095', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=532436566616095', 'https://academiadospicolesdebolo.online/', 0, 15, 0, NULL, '2025-05-03 00:07:22', '2025-05-03 00:09:40', 54, 4, 'https://docs.google.com/document/d/1Hm06J0Malkj5k5z3_f39QklveR_eRIB6/edit?usp=sharing&ouid=104373462850646115809&rtpof=true&sd=true'),
(28, 'Pac De Ferramentas', 'ESCALANDO', '2025-05-02', 'Renda Extra', 'BR', 'Ativo', 1, 1, '[\"Renda Extra\",\"Escalando\",\"Infoproduto\"]', 'anuncios/1746220627_901608550-pack-de-ferramentas-premium-vitalicio-WY8X.jpeg', 'https://videos.liveturb.com/videos/6/stream', 'Infoproduto', 'Carta de Vendas', 'Portugues', 'Facebook', 'Facebook > Pagina de vendas', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=110991598528749', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=110991598528749', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=110991598528749', 'https://escoladomarketing.com/ferramentas-pro/', 0, 2, -40, NULL, '2025-05-03 00:17:07', '2025-05-03 00:24:04', 180, 16, 'https://docs.google.com/document/d/1Hm06J0Malkj5k5z3_f39QklveR_eRIB6/edit?usp=drive_link&ouid=104373462850646115809&rtpof=true&sd=true'),
(29, 'The Divine Script', 'ESCALANDO', '2025-05-02', 'Renda Extra', 'US', 'Ativo', 1, 1, '[\"Renda Extra\",\"Escalando\",\"vsl\",\"Infoproduto\"]', 'anuncios/1746222081_492529753_652928977514457_940856543679304748_n.jpg', 'https://videos.liveturb.com/videos/7/stream', 'Infoproduto', 'VSL', 'ingles', 'Facebook', 'Facebook > Pagina de vendas > VSL', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=429360780259151', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=429360780259151', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=429360780259151', 'https://m.abundancecaller.com/32eyee0pz9/', 0, 6, 8, NULL, '2025-05-03 00:41:21', '2025-05-03 00:46:18', 97, 10, 'https://docs.google.com/document/d/1IGxrXu_PAF1Mco90BIPGSFQu3zScOYOg/edit?usp=drive_link&ouid=104373462850646115809&rtpof=true&sd=true'),
(30, 'Seca Bucho', 'ESCALANDO', '2025-05-02', 'Emagrecimento', 'BR', 'Ativo', 1, 1, '[\"Emagrecimento\",\"Low Ticket\",\"Quizz\"]', 'anuncios/1746223302_sddefault.jpg', 'https://videos.liveturb.com/videos/8/stream', 'Infoproduto', 'Carta de Vendas', 'Portugues', 'Facebook', 'Facebook > Pagina de vendas > Quizz', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=106253239248296', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=106253239248296', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=106253239248296', 'https://lp.desafiosecabucho.com.br/', 0, 8, -117, NULL, '2025-05-03 01:01:42', '2025-05-03 01:05:50', 123, 10, 'https://docs.google.com/document/d/1Hm06J0Malkj5k5z3_f39QklveR_eRIB6/edit?usp=drive_link&ouid=104373462850646115809&rtpof=true&sd=true'),
(31, 'Protocolo Liberado (Parasita Natural)', 'ESCALANDO', '2025-05-02', 'Emagrecimento', 'BR', 'Ativo', 1, 1, '[\"Emagrecimento\",\"Low Ticket\",\"Quizz\",\"Vsl\"]', 'anuncios/1746224708_images (1).jpg', 'https://videos.liveturb.com/videos/9/stream', 'Infoproduto', 'VSL', 'Portugues', 'Facebook', 'Facebook > Pagina de vendas > VSL', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=505319635993411', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=505319635993411', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=505319635993411', 'https://exame.dramanucaceres.com.br/', 0, 4, -4, NULL, '2025-05-03 01:25:08', '2025-05-03 01:29:10', 126, 9, 'https://docs.google.com/document/d/1SrXECMGxwcHNN-R5ssD7kwQNTXn_tkE9/edit?usp=drive_link&ouid=104373462850646115809&rtpof=true&sd=true'),
(32, 'Código da Obsessão', 'ESCALANDO', '2025-05-03', 'Relacionamento', 'BR', 'Ativo', 1, 1, '[\"Infoproduto\",\"VSL\",\"Relacionamento\"]', 'anuncios/1746294393_730fec9b-23af-49fe-ae65-767770e46013.jpeg', 'https://videos.liveturb.com/videos/10/stream', 'Infoproduto', 'VSL', 'Portugues', 'Facebook', 'Facebook > Pagina de vendas > VSL', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=644820902038543', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=644820902038543', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=BR&is_targeted_country=false&media_type=all&search_type=page&view_all_page_id=644820902038543', 'https://oportunidadesvaliosas.com/obsessaovsl/?subid=v3_b91c7f2b-a1bc-45fa-86e1-00b9df81dcf7_68127b85604188d4863d1545_190_t-11_h-1_s-1&src=v3_b91c7f2b-a1bc-45fa-86e1-00b9df81dcf7_68127b85604188d4863d1545_190_t-11_h-1_s-1', 0, 12, 0, NULL, '2025-05-03 20:46:33', '2025-05-03 20:55:31', 54, 16, 'https://docs.google.com/document/d/14HaZHVBwAaRNqPtaEfNS7i9ojHuuxEH0/edit?usp=sharing&ouid=104373462850646115809&rtpof=true&sd=true'),
(33, 'Meu Edital Verticalizado', 'RECEM ADICIONADO', '2025-05-03', 'Low Ticket', 'BR', 'Ativo', 1, 0, '[\"Low Ticket\",\"TSL\",\"Facebook\"]', 'anuncios/1746295358_image.jpeg', 'https://videos.liveturb.com/videos/11/stream', 'Infoproduto', 'Carta de Vendas', 'Portugues', 'Facebook', 'Facebook > TSL', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&q=%22MEUEDITALVERTICALIZADO.COM%22&search_type=keyword_exact_phrase', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&q=%22MEUEDITALVERTICALIZADO.COM%22&search_type=keyword_exact_phrase', 'https://www.facebook.com/ads/library/?active_status=active&ad_type=all&country=ALL&is_targeted_country=false&media_type=all&q=%22MEUEDITALVERTICALIZADO.COM%22&search_type=keyword_exact_phrase', 'https://meueditalverticalizado.com/', 0, 8, 0, NULL, '2025-05-03 21:02:38', '2025-05-03 21:05:15', 45, 7, 'https://docs.google.com/document/d/1Hm06J0Malkj5k5z3_f39QklveR_eRIB6/edit?usp=sharing&ouid=104373462850646115809&rtpof=true&sd=true');

-- --------------------------------------------------------

--
-- Estrutura para tabela `anuncios_backup`
--

CREATE TABLE `anuncios_backup` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `tag_principal` enum('ESCALANDO','TESTE','PAUSADO') NOT NULL,
  `data_anuncio` date NOT NULL,
  `nicho` varchar(255) NOT NULL,
  `pais_codigo` char(2) NOT NULL,
  `status` enum('Ativo','Inativo') NOT NULL,
  `novo_anuncio` tinyint(1) NOT NULL DEFAULT 0,
  `destaque` tinyint(1) NOT NULL DEFAULT 0,
  `tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tags`)),
  `imagem` varchar(255) DEFAULT NULL,
  `url_video` text DEFAULT NULL,
  `transcricao` text DEFAULT NULL,
  `produto_tipo` enum('Infoproduto','Produto Físico','Serviço','Assinatura') NOT NULL,
  `produto_estrutura` enum('VSL','PLR','Webinar','Carta de Vendas') NOT NULL,
  `produto_idioma` varchar(255) NOT NULL,
  `produto_rede_trafego` varchar(255) NOT NULL,
  `produto_funil_vendas` varchar(255) NOT NULL,
  `link_pagina_anuncio` text DEFAULT NULL,
  `link_criativos_fb` text DEFAULT NULL,
  `link_anuncios_escalados` text DEFAULT NULL,
  `link_site_cloaker` text DEFAULT NULL,
  `contador_anuncios` int(11) NOT NULL DEFAULT 0,
  `variacao_diaria_new` int(11) DEFAULT NULL,
  `variacao_semanal_new` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `numero_anuncios` int(11) NOT NULL DEFAULT 0 COMMENT 'Quantidade total de anúncios associados',
  `numero_criativos` int(11) NOT NULL DEFAULT 0 COMMENT 'Quantidade total de criativos vinculados (calculado automaticamente)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `anuncios_backup`
--

INSERT INTO `anuncios_backup` (`id`, `titulo`, `tag_principal`, `data_anuncio`, `nicho`, `pais_codigo`, `status`, `novo_anuncio`, `destaque`, `tags`, `imagem`, `url_video`, `transcricao`, `produto_tipo`, `produto_estrutura`, `produto_idioma`, `produto_rede_trafego`, `produto_funil_vendas`, `link_pagina_anuncio`, `link_criativos_fb`, `link_anuncios_escalados`, `link_site_cloaker`, `contador_anuncios`, `variacao_diaria_new`, `variacao_semanal_new`, `deleted_at`, `created_at`, `updated_at`, `numero_anuncios`, `numero_criativos`) VALUES
(1, 'Maratona Vocal VSL - Lead 01', 'ESCALANDO', '2025-03-27', 'Renda Extra', 'BR', 'Ativo', 1, 1, '[\"Relacionamento\",\"Low Ticket\",\"VSL\",\"Nutra\"]', 'anuncios/1743270217_vocal.jpeg', 'https://dtjx5no407kii.cloudfront.net/13d12e8bd9fe53a44f403034588d9596-Maratona%20Vocal%20VSL.video/mp4', 'Fala meu queridão, fala minha queridona, é o seguinte, eu sou Wesley Moreira, professor de técnicas vocais, você tá aqui na minha página de vendas do curso, eu vim te explicar, pra você não ter dúvida nenhuma, tá bom? Na hora que você entrar, o curso é real, tem gente que perguntou, Wesley, é real? É golpe? Não é, é real, eu sou cantor, sou professor há mais de 11 anos, e quero compartilhar esse conhecimento com você, tá bom? Com certeza você já viu meu Instagram, você veio por lá ou pelo Facebook, você pode dar uma procurada nos conteúdos lá, mas não perca essa oportunidade, já te falo de cara, porque o valor que tá aqui é promissional e vai sair do ar em breve. Literalmente, porque a grandiosidade que tá dentro do curso O valor que você vai pagar não tem comparação, tá? Porque a gente vai subir mesmo, o conteúdo tá de primeira, muita gente no trabalho, na edição, tá top, tá bom? Mas vou passar pra você aqui o que você vai aprender. Primeira coisa, quero te dizer, tirar da sua cabeça esse mito Eu não sei cantar, mas eu posso aprender.\r\n\r\nÉ justamente esse curso que você precisa pra poder aprender a cantar. O mito que as pessoas tem que, meu Deus, eu não sei cantar, cantar é só pra quem tem dom, primeiro que dom da música ou dom de cantar não existe. Dom é algo divino, né? Pra quem tá na igreja conhece, dom de língua, dom de cura, dom de interpretação de alguma coisa, mas cantar é um talento, é um talento.\r\n\r\nEsse talento pode ser predisposto, ou seja, a pessoa nasce com uma predisposição, que é o que você chama de dom. Essa predisposição é ou é psíquica ou é motora, né? Quando a pessoa, por um acaso, consegue fazer intuitivamente um som. Então eu vou fazer um vibrato.\r\n\r\nA pessoa já consegue fazer esse... Intuitivamente, porque ela conectou ali os neurônios, enfim. Mas tem gente que precisa de um método, e esse método que eu quero te entregar.\r\n\r\nO passo a passo com o meu método CTA. O que é esse CTA? É um caminho, é um plano. Esse caminho, né? Por isso que é o C, é um plano que eu te entrego pra você aprender, desenvolver, pra você compreender como e porquê a nossa voz trabalha daquele jeito, como que você vai executar aquela técnica, os exercícios, te dou o caminho passo a passo, a jornada ali.\r\n\r\nO T, no caso, é o treinamento. É quando você treina, você exercita, você se desenvolve, você é disciplinado, você entende o caminho que eu te entreguei, você percorre esse caminho. E o A do CTA é a sua aplicação.\r\n\r\nAonde você vai aplicar isso? Eu vou precisar, eu vou te encorajar a cantar pra alguém ou algum lugar, ou gravar um vídeo, mesmo que você grave pra você, mas você precisa aplicar tudo isso. te dou o caminho, você caminha por ele, você treina, exercita e aplica numa apresentação em....', 'Infoproduto', 'VSL', 'Portugues', 'Facebook', 'Facebook > Pagina de vendas', 'https://testedepagina.com', 'https://criativo.com', 'https://anuncioescalado.com', 'https://liveturb.com', 0, 20, 50, NULL, '2025-03-27 17:08:30', '2025-04-01 15:56:23', 128, 7),
(2, 'Teste anuncio 2', 'TESTE', '2025-03-28', 'Maternidade', 'US', 'Ativo', 0, 1, '\"[]\"', NULL, 'https://www.youtube.com/watch?v=3ghG2E0vhoo', 'Teste transcriçao 2', 'Infoproduto', 'VSL', 'ingles', 'Facebook', 'Facebook > Pagina de vendas', 'https://testedepagina.com', NULL, 'https://anuncioescalado.com', 'https://liveturb.com', 0, 80, -30, '2025-03-28 20:19:00', '2025-03-28 19:28:19', '2025-03-28 20:19:00', 211, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `broad_cast_comments`
--

CREATE TABLE `broad_cast_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `video_details_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `platform` enum('youtube','instagram') DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `broad_cast_comments`
--

INSERT INTO `broad_cast_comments` (`id`, `video_details_id`, `comment`, `platform`, `avatar`, `created_at`, `updated_at`) VALUES
(8660, 53, '😯 Wow, já ouvi falar desse produto. As celebridades estão todas sobre ele.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8661, 53, 'Esse parece ser um maravilhoso produto de emagrecimento, alguém já tentou?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8662, 53, 'Ai meu Deus, eu precisava disso! 😍 Já acabou a última vez que tentei comprar.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8663, 53, 'Estou assistindo de casa, alguém pode me dizer se o preço vale a pena?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8664, 53, 'Eu realmente espero que isso resolva meu problema de perda de peso. 🤔', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8665, 53, 'Eu sempre fico um pouco cética com esses produtos de emagrecimento... mas este parece promissor. 👍', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8666, 53, 'Parece ótimo! Mas queria saber mais sobre os ingredientes nele.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8667, 53, 'Alguém sabe como isso funciona? Tipo, eu tenho que tomá-lo todos os dias?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8668, 53, 'Quantidade de pessoas falando sobre esse produto...agora estou curiosa 😯', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8669, 53, 'Incrível, já ouvi falar muito. Vou continuar assistindo para ver se vale a pena comprar.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8670, 53, 'Eu estava assistindo esse feed e não podia deixar de comentar. Este produto parece incrível! 🙌', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8671, 53, 'Espero que não esgote antes que eu possa obter o meu! 🏃‍♀️', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8672, 53, 'Essa marca é bem conhecida. Acredito muito nos benefícios que promete.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8673, 53, 'Nunca tentei um produto de emagrecimento antes, mas este parece interessante.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8674, 53, 'Espero que não seja apenas mais um daqueles produtos de emagrecimento que prometem e não entregam. 😞', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8675, 53, 'Esse produto parece figurar bastante na TV. Bem curioso!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8676, 53, 'Eu sou um homem de 50 anos. Isso vai funcionar para mim e para minha esposa de 45 anos?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8677, 53, 'Esse parece ser um produto de alta qualidade. Mal posso esperar para começar a usá-lo! 💃', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8678, 53, 'Nossa, adorei ver os comentários positivos. Isso me deixa mais confiante para comprar.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8679, 53, 'Eu gostaria de ver mais experiências positivas antes de fazer a compra.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8680, 53, 'Produto esgotou da última vez quando eu estava tentando comprar. Hoje não vou perder! 🎯', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8681, 53, 'Parece que esse produto realmente funciona. Tomara que tenha em estoque, vou comprar agora mesmo.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8682, 53, 'Uau, que incrível, finalmente consegui comprar o meu! 💪💪', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8683, 53, 'Estou ansioso para experimentar! Espero que chegue logo.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8684, 53, 'Estou um pouco cético, mas acho que vale a pena tentar.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8685, 53, 'Eu vejo muitos comentários positivos. Parece que a galera realmente gostou.🤩', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8686, 53, 'Esse produto parece bom demais pra ser verdade... vou tentar!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8687, 53, 'Muito animada para receber o meu e começar a utilizar. Ouvi falar muito dele!😊', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8688, 53, 'Espero que não esgote de novo! Preciso dele no meu processo de emagrecimento!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8689, 53, 'Esse produto parece ser muito popular entre as mulheres na minha faixa etária. Interessante 🧐', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8690, 53, 'As celebridades estão falando sobre isso. Deve valer a pena!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8691, 53, 'Quem já comprou esse produto? Funciona mesmo?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8692, 53, 'Ouvi falar que esgotou na última vez, então estou pensando em comprar agora mesmo.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8693, 53, 'Se funcionar mesmo, é um ótimo preço pelo o que oferece.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8694, 53, 'Espero que tenha bons resultados como todos estão dizendo.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8695, 53, 'Parece eficaz, mas gostaria de ver mais comentários sobre isso.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8696, 53, 'Eu estava procurando por um produto assim há tempos.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8697, 53, 'Parece que esse produto é o segredo do emagrecimento... interessante.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8698, 53, 'Opa, parece que acertei ao ligar nessa live. Esse produto parece ser um bom negócio!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8699, 53, 'Esse parece bem diferente de todos os outros que já tentei.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8700, 53, 'Todos estão falando sobre isso. Vamos ver se funciona mesmo.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8701, 53, 'Esse produto tem algum efeito colateral que eu devo me preocupar?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8702, 53, 'Como funciona a política de devolução se eu não estiver satisfeito?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8703, 53, 'Uau, parece uma boa escolha. Acho que vou comprar! 👍', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8704, 53, 'Esse produto é seguro para diabéticos?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8705, 53, 'É seguro para todas as idades?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8706, 53, 'Nossa, parece ser muito bom. Tem disponibilidade em estoque?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8707, 53, 'Valeu pela transmissão, vou comprar um para experimentar. Fingers crossed! 🤞', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8708, 53, 'Gente, eu vi algumas celebridades falando sobre isso! Alguém já experimentou? 🤔', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8709, 53, 'Uau, o preço é realmente razoável! 😊 Pensei que seria muito mais caro.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8710, 53, 'Por que todos estão falando desse produto? Ele é realmente bom?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8711, 53, 'Este produto tem algum efeito colateral?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8712, 53, 'Droga! Tentei comprar isso antes, mas estava esgotado...', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8713, 53, 'Já ouvi falar muito sobre isso na TV. Agora é minha chance de comprar! 😍', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8714, 53, 'Estou curioso sobre isso... Alguém pode me dizer se realmente ajuda a perder peso?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8715, 53, 'Espera, esse produto ajuda na perda de peso? Achei que fosse apenas para tonificar.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8716, 53, 'Nossa, muita gente parece animada com isso. Devo estar perdendo algo 🤔', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8717, 53, 'Ainda está disponível? Quero garantir o meu antes que acabe novamente!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8718, 53, 'Vi isso no feed de uma celebridade que sigo. Ela disse que estava amando.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8719, 53, 'Pergunta rápida... Isso é adequado para alguém na faixa dos 40?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8720, 53, 'Espera, como isso ajuda na perda de peso exatamente?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8721, 53, 'Faz sentido! Depois de ler as descrições, estou muito tentado a comprar. 😁', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8722, 53, 'Quando o produto será entregue se eu comprar agora?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8723, 53, 'Ok, estou considerando isso... Mas tem algum desconto para primeiros compradores?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8724, 53, 'Estou pensando em comprar isto. Alguém já experimentou e pode dar um feedback honesto?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8725, 53, 'Espera, tem algum código de cupom que posso usar?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8726, 53, 'Por que este produto é diferente dos outros no mercado?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8727, 53, 'Alguém mais achou o chat ao vivo super útil? Estou amando isso! ❤️', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8728, 53, 'Essa parece ser uma compra que não vou me arrepender. 😊 Qual é o tempo de entrega?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8729, 53, 'Não acredito que finalmente vou conseguir esse produto! Foi muito falado no último mês.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8730, 53, 'Na minha opinião, o preço vale... Já tentou tantos produtos parecidos, mas nenhum deu certo.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8731, 53, 'Os benefícios soam incríveis, mas estou preocupado com os efeitos colaterais 😟', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8732, 53, 'Vou verificar com meu médico se posso usar isto. Ouvi coisas boas, mas não quero correr riscos.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8733, 53, 'Já estou pressionando o botão de \'compra\'. Quem mais está dentro? 🙋‍♀️', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8734, 53, 'Espero que ainda esteja em estoque. A última vez que verifiquei, estava esgotado. 😭', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8735, 53, 'Ok, estou convencido... Vou fazer o pedido.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8736, 53, 'Parece autêntico e de qualidade. Eu acho que vale a pena dar uma chance. 👍', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8737, 53, 'Não consigo esperar para colocar as mãos nisso. Espero que chegue rapidamente!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8738, 53, 'Precisamos de mais produtos como este no mercado, mais acessíveis e eficazes.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8739, 53, 'Será que isso vai funcionar bem com a minha rotina de exercícios?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8740, 53, 'Alguém pode confirmar se este produto vale todos os elogios?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8741, 53, 'Todos os meus amigos estão falando sobre isso. Acho que vou pular no vagão.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8742, 53, 'Finalmente algo que posso pagar e que tem ótimas críticas.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8743, 53, 'Este broadcast ao vivo está esclarecendo muitas questões. Aprecio isso!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8744, 53, 'Agora, com o isolamento, acho que este produto me ajudaria a controlar meu peso.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8745, 53, 'Tentei outras soluções de perda de peso mas nada funcionou. Espero que este seja diferente. 🤞', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8746, 53, 'Parece que tem muita ciência por trás deste produto. Isso é reconfortante.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8747, 53, 'Espero que eles possam manter o estoque para que eu possa pegar outro quando este acabar.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8748, 53, 'Isso se adapta a qualquer dieta? Como vegana, tenho que ter cuidado com o que uso.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8749, 53, 'Acredito que vale a pena experimentar, especialmente por esse preço. Estou dentro!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8750, 53, 'Essa é uma dificuldade real para muitos de nós, fico feliz que uma solução como essa esteja disponível.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8751, 53, 'Venho tentando perder peso há algum tempo, talvez isso possa me dar um empurrãozinho.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8752, 53, 'Ainda estou um pouco cético... Alguém pode compartilhar sua experiência?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8753, 53, 'Interessante como este produto parece atender a todos os gêneros.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8754, 53, 'Amei a transparência na descrição do produto. Isso dá muita confiança.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8755, 53, 'Será que eles entregarão mesmo com a pandemia?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8756, 53, 'Acabei de entrar, alguém pode me dizer o nome do produto novamente?👀', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8757, 53, 'Esse produto parece ótimo, alguém aqui já usou?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8758, 53, 'Vi isso na TV! Parece que as celebridades estão amando! 🌟', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8759, 53, 'Estou aqui pela primeira vez... o produto já esgotou antes? 😳', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8760, 53, 'Parece eficaz, mas é seguro para todos os tipos de corpo?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8761, 53, 'Lembro que tentei comprar uma vez, estava esgotado.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8762, 53, 'Gostaria de vê-lo em ação ao vivo! Eles mostraram isso na transmissão?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8763, 53, 'Dizem que os resultados são rápidos, isso é verdade? 🕐', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8764, 53, 'Adorando essa transmissão, tão informativa e este produto parece ser incrível! 👍', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8765, 53, 'Espero que eles tenham suficiente no estoque desta vez.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8766, 53, 'Preço justo considerando os benefícios, o que vocês acham?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8767, 53, 'Ainda curioso, eles têm alguma política de devolução?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8768, 53, 'Vou levar! Espero que ele entregue o que promete.🤞', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8769, 53, 'Ouvi dizer que este produto é ótimo para queimar gordura, é verdade?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8770, 53, 'Depois de tantas celebridades elogiarem, tenho que tentar.👏', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8771, 53, 'Eu estava procurando por algo assim, finalmente! 💪', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8772, 53, 'Acho que finalmente vou fazer essa compra, gostei da transmissão de hoje.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8773, 53, 'Muito bom ver tantas pessoas interessadas. 😉', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8774, 53, 'Ouvi dizer que ele atende a todos os tipos de idade, certo?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8775, 53, 'Adicionando ao meu carrinho antes que ele se esgote novamente! 😂', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8776, 53, 'Sabem se ele funciona igualmente para homens e mulheres?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8777, 53, 'Nunca ouvi falar desse produto antes, mas estou impressionado! 👌', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8778, 53, 'Espero que os resultados sejam tão bons quanto eles prometem.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8779, 53, 'Produto parece legítimo, gostaria de ver algumas resenhas de usuários.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8780, 53, 'Uau, esta transmissão está sendo útil, agora eu entendo o hype do produto. 🙌', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8781, 53, 'Aposto que esta transmissão ao vivo vai esgotar as unidades. 😆', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8782, 53, 'Se realmente funciona como dizem, o preço vale a pena.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8783, 53, 'Eu posso começar a usá-lo imediatamente, certo? 🤔', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8784, 53, 'Eles enviam para todo o país?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8785, 53, 'Vou pegar um para minha mãe também, ela vai adorar! ❤️', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8786, 53, 'Impressionante como eles explicaram todas as características do produto.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8787, 53, 'Quem mais está pensando em comprar depois desta transmissão? 🙋‍♀️', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8788, 53, 'Fantástico! Este é exatamente o produto de emagrecimento que eu estava procurando.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8789, 53, 'Pessoal, vocês têm algum cupom de desconto para este produto?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8790, 53, 'Comprando agora, eu sei que se esgota rapidamente. 😉', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8791, 53, 'Nunca fiquei tão animado com uma transmissão ao vivo antes! 🚀', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8792, 53, 'Mal posso esperar para começar minha jornada de emagrecimento com este produto!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8793, 53, 'Espero que eles reestocassem o suficiente desta vez.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8794, 53, 'Que bom que eles repetiram os benefícios, estou definitivamente comprando!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8795, 53, 'Estou tão feliz que reservei um tempo para assistir a esta transmissão. 💯', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8796, 53, 'Minha única preocupação é sobre possíveis efeitos colaterais. 🤷‍♀️', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8797, 53, 'Finalmente um produto que parece legítimo e bem fundamentado.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8798, 53, 'Soa incrível, mas gostaria de ouvir experiências de quem já usou.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8799, 53, 'É sempre bom ver um produto emagrecedor que pareça funcionar!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8800, 53, 'Preciso falar sobre isso com minha esposa, ela adorará! 👍', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8801, 53, 'Nossa! Qual é o prazo de entrega para este produto?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8802, 53, 'Espero que tenha chegado em tempo para comprá-lo desta vez.😆', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8803, 53, 'Uau, nunca ouvi falar deste produto antes, parece promissor.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8804, 53, 'Ouvi boas histórias sobre este produto, espero ter os mesmos resultados.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8805, 53, 'Finalmente decidido, adicionando ao carrinho agora. Vamos lá! 🎉', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8806, 53, 'Just reordered my second bottle of SlimFit Max. I am a believer now!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8807, 53, 'SlimFit Max has really changed my outlook on weight loss. So glad I took the leap!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8808, 53, 'Anyone else recommending SlimFit Max to their friends? It\'s too good to keep to myself!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8809, 53, 'This weight loss journey with SlimFit Max doesn\'t feel like a punishment. It\'s quite the ride!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8810, 53, 'This product is revolutionising my lifestyle! Thanks to SlimFit Max, I\'m on a roll!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8811, 53, 'With SlimFit Max, I keep checking my reflection in the mirror. Love the improvements I see!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8812, 53, 'Is it just me or does SlimFit Max really make you feel lighter and more confident?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8813, 53, 'Não acreditava no produto no início, mas SlimFit Max me provou o contrário. Resultados incríveis!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8814, 53, '5kg a menos em apenas duas semanas. Obrigado, SlimFit Max!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8815, 53, 'Essa queima de gordura acelerada realmente funciona. Estou impressionado!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8816, 53, 'Nunca me senti tão bem e cheia de energia. Fortemente recomendado!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8817, 53, 'SlimFit Max, a melhor decisão que já tomei. Sem arrependimentos!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8818, 53, 'Uau, senti a redução do apetite no primeiro dia. Que produto incrível!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8819, 53, 'Nenhuma outra dieta me deu este tipo de resultados. Feliz por ter tentado o SlimFit Max.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8820, 53, 'Nossa, vale o investimento, pessoal. Senti uma grande diferença nos meus níveis de energia.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8821, 53, 'Uma semana usando SlimFit Max e já estou vendo as mudanças. Muito animado!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8822, 53, 'Realmente gostei da ideia da tecnologia avançada e ingredientes naturais. SlimFit Max é bom demais!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8823, 53, 'Raramente comento, mas SlimFit Max merece um elogio. Ótimo produto!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8824, 53, 'Para quem está em dúvida, não pense duas vezes. SlimFit Max funciona!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8825, 53, 'Meu amigo recomendou e agora eu recomendo. SlimFit Max é o real negócio!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8826, 53, 'Nunca acreditei em produtos de perda de peso até conhecer SlimFit Max. Mudou minha vida para melhor.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8827, 53, 'Perda de 4 kg na primeira semana. Alguém mais experimentou isso com SlimFit Max?', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8828, 53, 'Estava preocupado com o preço no início, mas vale cada real. Recomendo!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8829, 53, 'Senti meus jeans ficando mais soltos após o uso contínuo. SlimFit Max, você é incrível!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8830, 53, 'Estava cético, mas SlimFit Max me surpreendeu. Já vi grandes mudanças em mim mesmo.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8831, 53, 'Gostaria de ter conhecido SlimFit Max antes. Nunca mais me preocupo com minha dieta!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8832, 53, 'Acabou a fome constante. SlimFit Max vale a pena!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8833, 53, 'Nunca pensei que um produto pudesse queimar gordura tão rapidamente. SlimFit Max, obrigado!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8834, 53, 'Indo para a terceira semana e me sentindo ótimo. SlimFit Max está me ajudando a alcançar meus objetivos.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8835, 53, 'SlimFit Max, por favor, aceite minha sincera gratidão. Você mudou minha vida!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8836, 53, 'Quando vi os ingredientes naturais, fiquei entusiasmado. Agora, vendo os resultados, estou ainda mais!', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8837, 53, 'SlimFit Max, você fez um trabalho incrível! Nunca me senti tão bem.', NULL, NULL, '2025-02-02 18:52:12', '2025-02-02 18:52:12'),
(8838, 53, 'Amei SlimFit Max! Emagreça rápido e super fácil de usar!', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8839, 53, 'Este produto é incrível. Totalmente vale a pena o dinheiro gasto!', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8840, 53, 'Fiquei surpreso em ver como meu apetite diminuiu desde que comecei a usar este produto.', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8841, 53, 'Estava cético no início, mas agora sou um grande fã de SlimFit Max!', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8842, 53, 'Sim! Finalmente um produto que realmente funciona.', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8843, 53, 'Tentei muitas coisas antes disso, mas SlimFit Max acabou sendo a melhor escolha para mim.', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8844, 53, 'Nunca imaginei que a perda de peso poderia ser tão fácil. Thanks, SlimFit Max!', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8845, 53, 'Minhas calças estão praticamente caindo de tão bem que esse produto está funcionando!', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8846, 53, 'Simplesmente não consigo acreditar nos resultados rápidos deste produto. Inacreditável!', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8847, 53, 'Muito obrigado SlimFit Max, agora finalmente posso usar minha roupa favorita novamente!', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8848, 53, 'Estou tão feliz que me deparei com esse produto. SlimFit Max, te amo!', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8849, 53, 'Uau! Este produto é realmente eficaz. Perdi 2 kg na primeira semana.', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8850, 53, 'Se você quer perder peso de verdade, então este é o produto para você.', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8851, 53, 'SlimFit Max funciona mesmo! Ele me ajudou a perder peso como nenhum outro produto.', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8852, 53, 'Perder peso nunca foi tão fácil graças ao SlimFit Max.', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8853, 53, 'Nunca achei que fosse perder peso tão rápido. Incrível SlimFit Max!', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8854, 53, 'Posso ver a diferença no espelho. Obrigado SlimFit Max!', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8855, 53, 'SlimFit Max me ajudou a ganhar confiança de novo, é realmente incrível!', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8856, 53, 'O melhor produto de perda de peso que já experimentei. Valeu SlimFit Max!', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8857, 53, 'Adorei que SlimFit Max tem ingredientes naturais. Funciona bem!', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8858, 53, 'Perdi a conta de quantos quilos perdi. Obrigado, SlimFit Max!', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8859, 53, '3 semanas depois e 7 kilos a menos. Não posso acreditar!', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8860, 53, 'Incrível! Vi resultados na primeira semana. Obrigado SlimFit Max!', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8861, 53, 'Nunca experimentei um produto de emagrecimento que funcionasse tão bem!', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8862, 53, 'Possivelmente o melhor investimento que já fiz! Estou impressionada, SlimFit Max!', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8863, 53, 'Whoa, I\'m seeing great results for this! Can someone send the link to buy it?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8864, 53, 'Seriously? These results are amazing! Send me the link please!', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8865, 53, 'I need this SlimFit Max in my life ASAP. Where\'s the link?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8866, 53, 'Ok, I\'m convinced. Can anyone share the buying link?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8867, 53, 'My gym buddy recommended this. Where can I get it?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8868, 53, 'Lost some weight with SlimFit Max?! Sounds unreal! Send the link, I\'ll give it a try.', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8869, 53, 'My clothes would love me more if I lose some weight. Share the link pls!', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8870, 53, 'Been searching for something like this. Can you share the link?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8871, 53, 'Natural ingredient and weight loss? I\'m sold! Where can I buy this product?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8872, 53, 'Fast fat burning with an increase in energy? Where do I sign up?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8873, 53, 'This is tempting! Can someone hook me up with the link?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8874, 53, 'If this helps control my appetite, I\'m all in. Where can I get it?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8875, 53, 'Does anybody know where I can get this product? Really need this in my life right now.', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8876, 53, 'No more hunger pangs? I need to try this! Send me the link please.', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8877, 53, 'After seeing the results, I\'m ready to order. Can anyone guide me to the link?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8878, 53, 'I\'m liking what I\'m hearing about this! Can anyone message me the purchase link?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8879, 53, 'I\'d love to try this! Can I have the link please?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8880, 53, 'These comments convinced me! Where\'s the link to buy it?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8881, 53, 'I need to get my hands on SlimFit Max. Where can I order it?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8882, 53, 'Just what I need! Can anyone drop the link to purchase?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8883, 53, 'Anyone have the buying link? Excited to try this!', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8884, 53, 'I’ve been struggling to find a good weight loss solution. Does someone have the link?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8885, 53, 'I NEED this. Tell me where to buy!', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8886, 53, 'Feeling pumped up. DM me the link, fast!', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8887, 53, 'Ready to experience SlimFit Max! Where’s the link?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8888, 53, 'Please share the link, guys! Wanna drop some pounds fast.', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8889, 53, 'I’ve been on edge about buying, but these comments have convinced me! Anyone has the link?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8890, 53, 'Easier weight loss? Yes, please! Send the link.', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8891, 53, 'I\'ve been waiting for something like this! Does anyone have the link?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8892, 53, 'Wanna try this SlimFit Max. Anyone share the link?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8893, 53, 'Hearing great things about this product. Could someone send me the link?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8894, 53, 'These results speak for themselves. Where can I buy this?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8895, 53, 'Wow, people seem to really like this product. Where can I get it?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8896, 53, 'Can someone DM me the link? Need to snag this SlimFit Max ASAP!', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8897, 53, 'I’m ready to give this a try! Where can I buy?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8898, 53, 'This seems like a game-changer. Does anyone have the purchase link?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8899, 53, 'Please share the buying link. Must try this when it’s still available.', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8900, 53, 'I\'m seriously considering buying this. Can anyone message me the link?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8901, 53, 'When can I get a piece of this magic? Please send the link!', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8902, 53, 'I want to invest in this. Does anybody have the link?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8903, 53, 'This product sounds awesome! Where can I buy?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8904, 53, 'I need this right away! Can anyone provide the link?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8905, 53, 'Alright, you\'ve got my attention. Where\'s the purchase link?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8906, 53, 'Can\'t wait to try this SlimFit Max! Send me the purchase link anyone?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8907, 53, 'Wow, where can I buy this miracle? Share the link, please.', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8908, 53, 'Ok, consider me interested. Can you provide the buying link?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8909, 53, 'This sounds too good to be true, gotta try it myself! Someone send me the link.', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8910, 53, 'Who can give me the link? I\'m ready to shape up with SlimFit Max!', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8911, 53, 'Sick of hunger pangs during weight loss. Need this ASAP! Where can I buy?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(8912, 53, 'On my way to a healthier lifestyle with SlimFit Max! Who can provide the link?', NULL, NULL, '2025-02-02 18:52:13', '2025-02-02 18:52:13'),
(11163, 69, 'Uau! Esse produto parece ser incrível! 😍', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11164, 69, 'Alguém mais já testou? Estou curioso se vale a pena. 🤔', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11165, 69, 'Comprei semana passada e já vejo resultados! 🎉', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11166, 69, 'Kiwify tem um ótimo suporte. Eles realmente ajudam! 👏', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11167, 69, 'Adorei a ideia de ganhar em dólar. Quem não quer? 💵', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11168, 69, 'O curso parece fácil de seguir. Sou iniciante e já estou animado! 🤗', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11169, 69, 'Estou com algumas dúvidas sobre o funcionamento. Alguém pode me ajudar?', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11170, 69, 'Muitas dicas valiosas! Vale cada centavo. 💰', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11171, 69, 'Será que é realmente possível ganhar muito? 😬', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11172, 69, 'Estou amando as explicações! Super didáticas! 👍', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11173, 69, 'É seguro? Essa é a minha maior preocupação. 🤷', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11174, 69, 'O bônus de suporte é um show à parte! ❤️', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11175, 69, 'Já conhecia a Kiwify, mas não sabia que dava para ganhar assim!', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11176, 69, 'Depois que comprei, minha vida financeira mudou! 🌟', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11177, 69, 'Tem alguma garantia de satisfação? Não quero gastar à toa. 😟', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11178, 69, 'Essa oportunidade de ganhar em dólar é única! 👀', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11179, 69, 'Estou animado para começar! Estava precisando de algo assim. 🙌', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11180, 69, 'Alguém mais já teve problemas com o acesso ao curso?', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11181, 69, 'Fui cético no início, mas agora sou fã total!', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11182, 69, 'Acho que o preço está bem justo para um curso tão completo! 💸', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11183, 69, 'Todo mundo fala bem do suporte, é verdade?', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11184, 69, 'Estou no mês 2 e já vi um crescimento legal nas minhas finanças!', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11185, 69, 'Um amigo me recomendou e estou ansioso para testar.', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11186, 69, 'As aulas são bem práticas, consigo aplicar facilmente!', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11187, 69, 'Não sabia que dava para ganhar assim com a Kiwify. Surpreendente! 🤯', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11188, 69, 'Como funciona a parte do pagamento em dólar? Alguém pode explicar?', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11189, 69, 'O material que vem no pacote é muito bom! Valeu a pena. 🥳', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11190, 69, 'Será que tem algum \'truque\' para se destacar?', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11191, 69, 'Esse método pode ser aplicado em qualquer área? 🧐', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11192, 69, 'Todos mentores são experientes? Quero saber mais deles!', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11193, 69, 'A comunidade é bem ativa? Quero trocar ideias com outros alunos!', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11194, 69, 'Já recuperei meu investimento! Sensacional! 🎊', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11195, 69, 'Estou tentando entender melhor a estrutura da Kiwify. Alguém pode me ajudar?', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11196, 69, 'Que investimento, hein! Espero que valha a pena!', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11197, 69, 'Sempre tive interesse em ganhar em dólar, além do real.', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11198, 69, 'O que mais vocês gostaram no curso? 😄', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11199, 69, 'Estou fazendo promoções e já vejo diferença nas vendas! 🚀', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11200, 69, 'Um amigo fez e já está com resultados ótimos! Acho que vou arriscar!', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11201, 69, 'Tenho um pouco de receio em investir. O que vocês acham?', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11202, 69, 'O curso é para todos ou tem algum pré-requisito?', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11203, 69, 'Seria legal se tivesse um grupo de suporte exclusivo!', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11204, 69, 'Melhor investimento do mês! Não me arrependo! ✨', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11205, 69, 'Alguém já conseguiu um retorno significativo?', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11206, 69, 'Sou muito grato por ter encontrado esse curso!', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11207, 69, 'A Kiwify é confiável mesmo? Não quero problemas depois…', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11208, 69, 'Estou tão empolgado! Começando o curso hoje! 🚀', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11209, 69, 'Tem algum alerta ou cuidado que deveríamos ter?', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11210, 69, 'Queria saber se alguém teve dificuldades.', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11211, 69, 'Esse curso tem mudado minha visão sobre renda extra. Informações tão valiosas!', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11212, 69, 'Já estou aplicando as dicas e vendo resultados! 🥳', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11213, 69, '😍 Uau! Estou adorando as dicas sobre como ganhar em dólar! Mal posso esperar para experimentar! 💵', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11214, 69, 'A idéia de trabalhar com a Kiwify é incrível! Alguém já teve resultados? 🤔', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11215, 69, 'Estou aqui só pelo conteúdo gratuito, mas talvez eu compre o curso! 🤑', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11216, 69, 'Já vi alguns vídeos sobre ganhar em dólar, mas este é diferente! Muito conteúdo valioso! 👏', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11217, 69, 'O preço parece justo para tudo que oferece! Alguém pode confirmar se realmente funciona? 🔍', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11218, 69, 'O que eu mais gostei foi a explicação clara! Isso me ajudou a entender melhor! 👍', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11219, 69, 'Eu sou um pouco cético, mas as informações estão muito interessantes! 🤨 Alguém já testou?', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11220, 69, '💪 Eu já ganhei dinheiro com a Kiwify e vale a pena! Super recomendo!', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11221, 69, 'Estou preocupado em não ter tempo para implementar tudo isso! Alguém pode me ajudar? ⏰', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11222, 69, 'Esse curso parece uma oportunidade incrível para quem quer uma renda extra! 🙌', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11223, 69, 'Não estou com certeza se poderei acompanhar, mas vou tentar! 🤞', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11224, 69, 'O feedback dos alunos anteriores é realmente bom! Isso me deixa esperançoso! 💬', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11225, 69, '💰 Ganhar em dólar parece um sonho, e esse curso pode ser a solução! Estou dentro!', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11226, 69, 'Alguém já teve dificuldade em configurar a conta na Kiwify? Preciso de ajuda! 🙋‍♂️', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11227, 69, 'As dicas práticas são o que eu estava procurando! Muito conteúdo útil! 📈', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11228, 69, 'O preço é um pouco salgado, mas acho que vale a pena pelo retorno! 💸', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11229, 69, 'Estou aqui para aprender e espero que funcione para mim! Vamos lá! 🚀', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11230, 69, 'O que vem incluido no curso? Alguém pode me ajudar? 🤔', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11231, 69, 'Já estou imaginando as possibilidades de renda! 😍 Boa sorte a todos!', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11232, 69, 'Pode ser que eu compre! A apresentação está muito boa! 👏👏', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11233, 69, 'Estou em dúvida... e se não for o que eu espero? 😬', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11234, 69, 'Quem aqui já ganhou um bom dinheiro com a Kiwify? Compartilhem suas experiências! 🌟', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11235, 69, 'Sinto que essa é a mudança que eu precisava na minha vida financeira! 💪', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11236, 69, 'A live está cheia de energia! Isso me empolga ainda mais! 😃✨', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11237, 69, 'Preciso saber mais sobre o suporte ao aluno. Alguém pode me explicar? 📞', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11238, 69, 'Parece que a Kiwify é uma ótima oportunidade para iniciantes! 😁', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11239, 69, 'Estou gostando das interações! Isso deixa a live muito mais interessante! 🔥', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11240, 69, 'Achei a proposta bem realista e animadora, quero acreditar! 🌈', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11241, 69, 'Espero que o acesso ao conteúdo seja fácil e claro! 🎯', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11242, 69, 'Estou impressionado com a quantidade de informações! Isso pode mudar tudo! 🤯', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11243, 69, 'Se as promessas forem cumpridas, estarei muito feliz! 🎉', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11244, 69, 'A live estava tão boa que até perdi a noção do tempo! ⏳', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11245, 69, 'Estou aqui pensando em como usar essas dicas no meu dia a dia! 🤔💡', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11246, 69, 'O suporte parece ser incrível! Isso é essencial para iniciantes! 🛠️', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11247, 69, 'A Kiwify é confiável? Não quero investir em algo que não funcione. 😟', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11248, 69, 'A forma como o produto é apresentado da ideia de credibilidade! ✨', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11249, 69, 'Incrível ver tantas pessoas interessadas em melhorar suas finanças! 🙏', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11250, 69, 'Eu já tentava ganhar renda extra, mas nunca vi algo assim! Estou animado! 🎯', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11251, 69, 'Achava difícil fazer dinheiro online, mas isso parece acessível! 💻', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11252, 69, 'Estou OK com o investimento, desde que haja retorno! 💵 Vamos lá!', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11253, 69, 'Adorei o formato da live! Isso ajuda a entender tudo melhor! ✔️', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11254, 69, 'Esse método não parece convencional... mas estou disposto a tentar! 🤷‍♂️', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11255, 69, 'Gente, não sou expert, mas isso tudo faz bastante sentido! 🔍', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11256, 69, 'Quero saber mais sobre as recompensas mensais! Isso é real? 🤔', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11257, 69, 'Ansioso para colocar essas estratégias em prática! 🏃‍♂️💨', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11258, 69, 'O conteúdo é relevante para mim, mas ainda tenho algumas dúvidas. 😕', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11259, 69, 'Sinto que se eu seguir bem o curso, vou colher bons frutos! 🌱', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11260, 69, 'Este é o início de uma nova etapa financeira para mim! ✨🍀', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11261, 69, 'As perguntas e respostas estão ajudando muito! Isso é valioso! 💬', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11262, 69, 'Ah, estou torcendo para que tudo isso funcione! Sucesso para todos nós! 🤞🌟', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11263, 69, 'Uau, isso parece muito interessante! Já estou pensando em comprar! 💰', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11264, 69, 'Alguém já testou? Funciona mesmo? 🤔', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11265, 69, 'Com certeza, quero gerar uma renda extra com isso! ⚡', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00');
INSERT INTO `broad_cast_comments` (`id`, `video_details_id`, `comment`, `platform`, `avatar`, `created_at`, `updated_at`) VALUES
(11266, 69, 'Fiquei curioso sobre como funciona o sistema da Kiwify. Já vi gente falando bem! 📈', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11267, 69, 'Parece que é uma ótima forma de ganhar em dólar, quem sabe eu não tento! ✈️', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11268, 69, 'Vocês acham que dá pra usar isso mesmo com pouco conhecimento? 🤷‍♂️', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11269, 69, 'Super animado para começar, já quero garantir a minha vaga! 🙌', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11270, 69, 'Estou com dúvidas sobre a plataforma, alguém pode me ajudar? 😅', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11271, 69, 'Que legal! O preço tá ótimo, estou pensando em adquirir já! 💵', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11272, 69, 'Vi muitos depoimentos positivos, me deixou mais confiante! 🌟', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11273, 69, 'Isso é pra mim! Quero ganhar uma grana extra e viajar! 🌍', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11274, 69, 'Eu gostei do conteúdo, mas queria saber mais sobre o suporte! 💬', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11275, 69, 'Tem garantia de devolução se não funcionar? Isso é importante pra mim. ❓', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11276, 69, 'Vi que a Kiwify tem um bom suporte, vou dar uma chance! 👍', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11277, 69, 'Adorei a apresentação, ficou tudo muito claro! 😀', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11278, 69, 'Alguém já usou o passo a passo que foi ensinado? Funcionou? 📚', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11279, 69, 'A ideia de ganhar em dólar é sensacional! Tô dentro! 😍', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11280, 69, 'Estou pensando, mas preciso ver se é realmente fácil de usar. 🙄', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11281, 69, 'Tem algum bônus se eu comprar agora? 👀', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11282, 69, 'Fiquei com um pé atrás, alguém pode compartilhar experiências? 🤔', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11283, 69, 'Essa é a oportunidade que eu estava esperando! Vou comprar hoje! ✌️', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11284, 69, 'Muito bom saber que existe um jeito de ganhar em dólar sem sair de casa! 🏠', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11285, 69, 'Estou um pouco inseguro, mas as opiniões são encorajadoras! ✨', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11286, 69, 'Vi várias pessoas tendo sucesso com isso! Já tô motivado! 😁', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11287, 69, 'O que me preocupa é o tempo que leva pra ver resultados... ⏳', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11288, 69, 'O valor tá super acessível, acho que vou arriscar! 🤑', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11289, 69, 'O suporte realmente é bom? Isso é algo que me preocupa... 💭', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11290, 69, 'Já tive experiências com produtos digitais e nem sempre foram boas. 😬', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11291, 69, 'Se funcionar mesmo, vai ser uma baita ajuda na minha renda! 🎉', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11292, 69, 'Gosto desse conceito de trabalho online, quero aprender mais! 📲', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11293, 69, 'Pessoal, as aulas são gravadas ou ao vivo? 🤷‍♀️', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11294, 69, 'Esse valor vale muito a pena! Espero que possa ajudar na minha situação! 🙏', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11295, 69, 'Estou confusa com as informações, alguém pode resumir? 🙋‍♀️', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11296, 69, 'Parece que muitas pessoas estão se dando bem, fiquei curiosa! 🌈', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11297, 69, 'Se não funcionar, posso pedir reembolso? Isso me deixaria mais tranquila! 🔄', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11298, 69, 'Alguém sabe se dá pra começar do zero? Não tenho experiência. 🧐', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11299, 69, 'O conteúdo parece incrível, mal posso esperar para começar! 😇', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11300, 69, 'Estou pensando em usar isso como uma renda extra durante a faculdade! 🎓', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11301, 69, 'Isso pode ser realmente útil! Trabalho em casa é tudo que eu quero! 💻', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11302, 69, 'Espero que a Kiwify tenha um bom suporte técnico pra ajudar! 🔧', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11303, 69, 'Com certeza vou compartilhar essa oportunidade com meus amigos! 🤝', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11304, 69, 'Gostei das dicas que o apresentador deu, bem útil! 📌', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11305, 69, 'Tem algum grupo ou comunidade onde podemos interagir? 👥', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11306, 69, 'Quero ver mais provas de pessoas que conseguiram! 🌟', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11307, 69, 'O que será que eles ensinam que não está em outros cursos? 💡', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11308, 69, 'Parece que dá pra ter liberdade financeira, quero isso pra mim! 💸', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11309, 69, 'Estou animada, já escrevi tudo que preciso para começar! ✏️', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11310, 69, 'O depoimento de quem já fez é muito relevante! Mais disso, por favor! 🗣️', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11311, 69, 'Funciona mesmo para pessoas que estão começando do zero? 🤔', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(11312, 69, 'Isso pode mudar vidas! Estou esperançoso! 🌍✨', 'youtube', NULL, '2025-03-06 05:13:00', '2025-03-06 05:13:00'),
(12523, 68, 'I think I need a little more convincing before buying.', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12524, 68, 'Estou curioso, esse curso realmente vale a pena? 🤔', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12525, 68, 'Just signed up! Fingers crossed this is what I need! 🤞', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12526, 68, 'Comprei e estou impressionado com o conteúdo! É super didático! 👍', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12527, 68, 'What’s the refund policy if it doesn\'t work for me?', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12528, 68, 'I’ve been following this for weeks. Today’s the day I buy!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12529, 68, 'Alguém sabe se tem garantia de satisfação? 🧐', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12530, 68, 'Does it require a lot of time each day to make it effective?', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12531, 68, 'As dicas sobre como ganhar em dólar são incríveis! 💵💥', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12532, 68, 'Love this! The flexibility it offers is what I need!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12533, 68, 'Estou tendo dificuldades para configurar a conta... Alguma dica? 🙁', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12534, 68, 'Some mixed reviews online. Is anyone here experienced?', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12535, 68, 'A metodologia parece muito boa! Mal posso esperar para começar! 🎉', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12536, 68, 'I can\'t believe how affordable it is compared to others!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12537, 68, 'Já fiz minha inscrição! Espero que funcione para mim também! 😊', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12538, 68, 'Expecting big things! Let\'s gooo! 🌟', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12539, 68, 'A parte sobre marketing digital é um diferencial incrível! 📈', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12540, 68, 'Does it come with training or support for newbies?', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12541, 68, 'Vocês acham que é viável para quem está começando do zero? 🤷‍♂️', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12542, 68, 'I\'ve seen this mentioned on social media a lot lately!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12543, 68, 'Estou seguindo todos os passos e já vejo resultados! #Empolgado 🎊', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12544, 68, 'This could really help improve my financial stability!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12545, 68, 'A forma de ganhar a comissão é simples, eu gosto! 👌', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12546, 68, 'Is there a recommendable way to get started quickly?', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12547, 68, 'Tô pensando em fazer o curso, mas ainda tô na dúvida. 😅', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12548, 68, 'I\'ve seen a lot of success stories—it makes me hopeful!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12549, 68, 'Esse método de renda extra é realmente acessível para todos. 💪', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12550, 68, 'Anyone else here joining for the second time? First was great!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12551, 68, 'Does it work in different countries? I’m from Brazil.', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12552, 68, 'Gente, tem como receber em real ou só em dólar? 💲', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12553, 68, 'Just placed my order! Can’t wait to start earning!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12554, 68, 'As experiências compartilhadas aqui me inspiraram a investir! 🔥', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12555, 68, 'I hope the customer support is as good as everyone says!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12556, 68, 'Com tanto conteúdo gratuito na internet, como esse curso se destaca? 😬', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12557, 68, 'Struggling financially right now... hoping this can help!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12558, 68, 'Meu amigo já está ganhando muito com a Kiwify, quero tentar também! 🤑', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12559, 68, 'Does anyone have tips for maximizing earnings with this?', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12560, 68, 'Pareceu ser um ótimo investimento, vou clicar no link! 💻', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12561, 68, 'I heard it pays off quickly if you’re consistent!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12562, 68, 'Alguém aqui já assistiu as aulas? O que acharam? 📚', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12563, 68, 'This seems a bit too good to be true, does it really work?', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12564, 68, 'O suporte ao aluno é bom? Tenho algumas dúvidas. 🤔', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12565, 68, 'The testimonials are so inspiring! I’m all in!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12566, 68, 'Fiquei impressionado com os depoimentos de quem já usou! 🌟', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12567, 68, 'I wish I could see more real-life examples on this...', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12568, 68, 'A promessa de renda extra em dólar me conquistou! 🌍', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12569, 68, 'I made my first sale within a week! Super happy!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12570, 68, 'Espero não me decepcionar com o curso! 👀', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12571, 68, 'What if I don’t have much experience? Will I be okay?', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12572, 68, 'O preço tá ótimo! Vale a pena! 🔖', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12573, 68, 'Excited to join the ranks of successful users!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12574, 68, 'O que mais vocês estão aprendendo? Estou perdido nas opções! 😂', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12575, 68, 'Community support is everything! Loving the positivity!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12576, 68, 'A Kiwify parece ser uma plataforma bem estruturada! 🚀', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12577, 68, 'Hopefully it’s beginner-friendly, I’m really new to this.', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12578, 68, 'The energy in this chat is contagious! Let’s do this!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12579, 68, 'Vou comprar agora! Não posso perder essa oportunidade! ⏳', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12580, 68, 'What’s the best strategy for someone just starting?', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12581, 68, 'Como está o suporte para tirar dúvidas após a compra? 🙏', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12582, 68, 'I love how empowering this can be! Time to take charge!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12583, 68, 'Estou animado! Espero começar a ver resultados logo! ✨', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12584, 68, 'Wish I could join but funds are tight. 😟', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12585, 68, 'Vi que pode ganhar comissão pela recomendação, né? Isso é demais! 💸', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12586, 68, 'Can anyone share their journey? I want to hear success stories!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12587, 68, 'Estou com medo de não conseguir acompanhar as aulas... 😩', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12588, 68, 'Totally ready to change my life with this! Are you guys with me? 🚀', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12589, 68, 'O investimento parece seguro, todos aqui estão adorando! 💖', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12590, 68, 'Como funciona a liberação de pagamentos? Preciso entender isso! 💬', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12591, 68, 'Alguém me ajuda? Não estou conseguindo finalizá minha compra! 😰', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12592, 68, 'O conteúdo extra oferecido parece ser bem útil, já vi ótimos feedbacks! 👍', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12593, 68, 'Uau, vi que podem ganhar bônus também! Que motivador! 🔥', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12594, 68, 'As estratégias apresentadas são atuais, o que é excelente! 👏', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12595, 68, 'Estou compartilhando com amigos, isso pode ajudar mais pessoas! 🤝', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12596, 68, 'Me mandaram o link e estou bem interessado! Não quero perder! ⌛', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12597, 68, 'A credibilidade do curso é uma grande vantagem! Confio! 💯', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12598, 68, 'É para todos os públicos? Não tenho experiência nenhuma! 😅', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12599, 68, 'O conteúdo parece muito enriquecedor! Estou animado! 🎈', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12600, 68, 'Alguém já conseguiu uma renda significativa com isso? 🤞', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12601, 68, 'O suporte ao cliente é bem recomendado, certo? Espero que sim! 🙌', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12602, 68, 'A ideia de ganhar em dólar é sensacional! Tenho que me arriscar! 💫', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12603, 68, 'Tô precisando de renda extra, esse é o momento certo! 🕒', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12604, 68, 'Uma dúvida: é necessário investir em publicidade para dar certo? 🤔', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12605, 68, 'A influência da economia americana na Kiwify é um bom chamariz! 🇺🇸', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12606, 68, 'Estou chegando agora e já quero saber mais! A energia aqui é contagiante! 🔋', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12607, 68, 'Uau, que incrível! Eu sempre quis aprender a ganhar em dólar. 💸', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12608, 68, 'Alguém conseguiu aplicar as dicas? O que achou? 🤔', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12609, 68, 'Esse curso é tudo que eu precisava! As informações são super claras. 🙌', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12610, 68, 'Estou curioso sobre como funciona a Kiwify. 😍', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12611, 68, 'Não sei se vai funcionar pra mim... Mas estou disposto a tentar! 💪', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12612, 68, 'Esse valor é justo considerando os benefícios que você pode ter! 👍', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12613, 68, 'Quais são os passos iniciais? Estou perdido. 😅', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12614, 68, 'Amei a ideia de ganhar em dólar! Vou adquirir! 💵', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12615, 68, 'Parece muito interessante! Mas será que é fácil de executar? 🤷‍♀️', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12616, 68, 'Já comprei e estou adorando! Está super fácil de entender! 🎉', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12617, 68, 'Quais são os resultados que vocês estão tendo após seguir o curso? 📈', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12618, 68, 'Duvido que faça tanta diferença, mas quem sabe... 🤔', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12619, 68, 'Estou aqui pensando se vale a pena o investimento. Alguém pode ajudar? 🧐', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12620, 68, 'Esse é o tipo de oportunidade que eu estava esperando! 🚀', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12621, 68, 'Recebi a planilha do curso e já estou usando! 📝', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12622, 68, 'Legal que ensina sobre Kiwify. Estou ansioso pra começar! ✌️', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12623, 68, 'A informação sobre como se cadastrar foi super útil! Obrigado! 🙏', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12624, 68, 'Alguém sabe se é possível ganhar um valor legal em pouco tempo? ⏰', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12625, 68, 'A proposta é muito boa, mas ainda tô com uma pulga atrás da orelha... 🐜', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12626, 68, 'O que mais eu preciso para começar? Alguém pode compartilhar? 🤗', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12627, 68, 'Quero muito saber dos resultados de quem já está usando! 💬', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12628, 68, 'Isso parece mais fácil do que eu imaginava! ❤️', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12629, 68, 'Já estou fazendo o curso e tem tanta informação legal! 🤩', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12630, 68, 'Será que funciona para todas as idades? Tenho 50 anos e estou em dúvida! 😊', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12631, 68, 'É bom saber que posso usar a Kiwify para um ganho extra! 💰', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12632, 68, 'Não gosto da ideia de ter que investir muito… Foi assim com outros cursos. 😅', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12633, 68, 'Meu amigo me falou muito bem desse curso! 👍', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12634, 68, 'Alguém tem dicas de como maximizar os ganhos? 🤑', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12635, 68, 'Vai ser ótimo aprender a faturar em dólar! 💵', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12636, 68, 'Me deixaram empolgado com os resultados que mostram! 🎊', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12637, 68, 'Estou um pouco inseguro, mas quero tentar. Todo mundo está falando bem! 😟', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12638, 68, 'Esse curso vai mudar minha vida financeira! 🚀', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12639, 68, 'Que interessante, mas ainda estou pensando se vale a pena o custo. 🤔', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12640, 68, 'As aulas estão ótimas! Já estou aplicando algumas técnicas! 💡', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12641, 68, 'Demorei pra decidir, mas agora que comprei estou super feliz! 🎉', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12642, 68, 'Alguém conhece histórias de sucesso nesse curso? 🌟', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12643, 68, 'O preço está acessível! Melhor que pagar por muito menos! 💵', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12644, 68, 'Tenho familiares que ganharam bastante com isso! Top! 💪', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12645, 68, 'Não importa a idade, basta ter vontade! Estou animada! 🤩', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12646, 68, 'Esse curso parece ser a solução para minha falta de renda extra. 💸', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12647, 68, 'Estou tão feliz que decidi participar! As aulas são ótimas! 😊', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12648, 68, 'É super legal que você pode ganhar em dólar, mas e os impostos? 🧐', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12649, 68, 'Essa oportunidade é fantástica, mas será que é para mim? 🤔', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12650, 68, 'Fui buscar referencias e achei várias positivas! 😍', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12651, 68, 'Vou tentar e ver o que acontece! Alguém se arriscou e se deu bem? 🤷‍♂️', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12652, 68, 'As dicas sobre marketing digital foram um diferencial! 📝', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12653, 68, 'Comprei e já estou vendo resultados em uma semana! 🤑', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12654, 68, 'Estou tão animada com esse novo projeto! Vamos juntos nessa! 🚀', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12655, 68, 'Legal encontrar uma oportunidade de ganhar extra sem sair de casa! 🏠💰', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12656, 68, 'Que bom ver tantos comentários positivos! Isso me encoraja a comprar! 🙌', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12657, 68, '🔥 Uau, estou muito empolgado para começar a usar a Kiwify! Alguém já fez a primeira venda? 💰', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12658, 68, 'Eu já comprei e estou adorando as dicas! Super vale a pena! 👍', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12659, 68, 'Estou curioso sobre como funciona. Alguém pode explicar um pouco mais? 🤔', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12660, 68, 'Esse curso é realmente eficaz? Estou com receio de investir. 😟', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12661, 68, 'Comprei ontem e já estou aplicando as estratégias. Estou ansioso pelos resultados! 🚀', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12662, 68, 'Vi que o suporte ao cliente é bom, é verdade? 💬', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12663, 68, 'Essa ideia de ganhar em dólar parece incrível! Estou dentro! 💵', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12664, 68, 'Não sei se é para mim... Alguém que começou do zero conseguiu? 🤷‍♀️', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12665, 68, 'As aulas são fáceis de entender? Porque sou leiga no assunto. 😅', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12666, 68, 'Estou aqui assistindo e já sinto que valeu a pena! 😍', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12667, 68, 'Alguém teve dificuldades para acessar o material? 🤔', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12668, 68, 'O preço está ótimo, se considerar o potencial de ganho! 💸', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12669, 68, 'Uma dúvida: tem material para quem quer começar com pouco investimento? 🤨', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12670, 68, 'A Kiwify é realmente legal. Minha amiga já ganhou bastante grana! 💥', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12671, 68, 'Vocês acham que é possível ganhar um salário extra em poucos meses?', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12672, 68, 'Estou ainda em dúvida sobre comprar o curso, as experiências estão sendo boas? 🤔', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12673, 68, 'As estratégias se aplicam bem a outros nichos também? 🚀', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12674, 68, 'Minha primeira venda foi hoje! Estou super feliz! 🎉', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12675, 68, 'O que vocês acham das técnicas de marketing ensinadas? Funcionam mesmo? 💡', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12676, 68, 'Estou ansioso para aplicar tudo isso. Parece promissor! 👍', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12677, 68, 'Tenho dúvidas sobre o suporte técnico, ele é eficaz? 🛠️', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12678, 68, 'Gente, o que mais vocês gostaram no curso? 👀', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12679, 68, 'Estou gostando muito do conteúdo, mas é tudo bem prático? 📚', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12680, 68, 'A Kiwify é confiável? Quero garantir que não vou me decepcionar. 🤔', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12681, 68, 'Comprei e já estou aprendendo a criar meus produtos. Obrigada pelas dicas! 🙌', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12682, 68, 'Quais são os principais erros que vocês cometeram no começo? 🤷‍♂️', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12683, 68, 'O curso vale a pena mesmo? Tem algum depoimento positivo? 🤗', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12684, 68, 'Estou tentando entender como funcionam as taxas da Kiwify. Alguém sabe? 💸', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12685, 68, 'Esse produto parece uma grande oportunidade. Não posso perder! 💪', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12686, 68, 'As aulas são atualizadas com frequência? 😮', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12687, 68, 'Quem aqui já viu resultados em menos de um mês? 😍', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12688, 68, 'Estou com muitas expectativas! Vamos juntos nessa jornada! 🚀', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12689, 68, 'Vocês acham que é mais fácil vender produtos digitais ou físicos? 💭', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12690, 68, 'Minha irmã está ensaiando para comprar, ela deve decidir ainda hoje! 😅', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12691, 68, 'As aulas são diretas ao ponto, o que mais gostei. Valeu a pena! 👌', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12692, 68, 'O que vocês conseguem dizer sobre a comunidade do curso? 🧑‍🤝‍🧑', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12693, 68, 'Muito boa a apresentação, parece que o curso é muito bem estruturado! 👍', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12694, 68, 'Quem não tem ideia de como começar? Estava exatamente assim! 🙃', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12695, 68, 'Investi o valor do curso e já estou vendo os frutos! 🎉', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12696, 68, 'O suporte responde rápido? Estou pensando em comprar. 🛍️', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12697, 68, 'Super indico! Aprendi muito nas primeiras aulas. 🤗', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12698, 68, 'Minha dúvida ainda persiste: quanto tempo leva para ver resultados? ⏳', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12699, 68, 'Ganhar em dólar é tudo que eu quero! Estou tão empolgada! ✨', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12700, 68, 'O curso é focado em que tipo de investimento, alguém sabe? 🤔', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12701, 68, 'Eu vim do Brasil e estou amando! Se eu consigo, você também consegue! 🇧🇷', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12702, 68, 'As dicas de marketing são realmente diferenciadas. Vale a pena! 💡', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12703, 68, 'Estou com receio... Se eu não vender nada, o que faço? 😬', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12704, 68, 'Não tem segredo, é só seguir o passo a passo! Estou com você! 🙌', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12705, 68, 'Já sou aluna e só tenho a agradecer! Estou vendendo muito! ⚡', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12706, 68, 'Essa live está excelente! Depois vou compartilhar com os amigos! 📲', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12707, 68, 'Gente, estou tão animado com essa oportunidade! 💸 Mal posso esperar para começar a ganhar em dólares com a Kiwify!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12708, 68, 'Quem mais já testou? Quais foram os resultados que você teve? Estou curioso!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12709, 68, 'Acabei de comprar! Espero que funcione bem para mim. Alguém mais aqui já viu resultados? 🤞', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12710, 68, 'Achei a explicação bem clara! Isso realmente parece uma maneira fácil de ter uma renda extra. 😊', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12711, 68, 'Os vídeos são super explicativos, mas gostaria de um guia passo a passo! Alguém já conseguiu um? 📈', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12712, 68, 'Estou um pouco inseguro sobre começar. As taxas são muito altas na Kiwify? 😬', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12713, 68, 'Posso dizer que estou gostando muito do suporte que recebi até agora! 🎉', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12714, 68, 'Alguma dica para quem é iniciante e nunca trabalhou com vendas online?', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12715, 68, 'Essa ideia de faturar em dólares é incrível! 🌍 Estou dentro!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12716, 68, 'Achei que seria complicado, mas já estou entendendo tudo! 👍 Você também pode!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12717, 68, 'Só eu que estou adorando isso? Estou pensando em fazer uma renda extra para viajar! ✈️', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12718, 68, 'Estou na dúvida se vale mesmo a pena. Alguém tem dados sobre a rentabilidade?', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12719, 68, 'O suporte é muito bom. Responderam minhas perguntas rapidinho. Adorei! 💬', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12720, 68, 'Estou animada com a possibilidade de fazer uma renda extra. Espero que funcione pra mim!😊', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12721, 68, 'Achei o preço do curso bem justo para as oportunidades que ele oferece! 💵', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12722, 68, 'Alguém já testou essa estratégia de marketing que eles ensinam?', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12723, 68, 'Tem um preço acessível e promete muito. Vale a pena arriscar! 🔥', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12724, 68, 'As aulas são curtas e boas! Aprendi muita coisa já. Recomendo! 👏', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12725, 68, 'Pois é, tá todo mundo falando e eu aqui ainda pensando em comprar. Acho que já está na hora! ⏰', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12726, 68, 'Uma dúvida: posso usar a Kiwify para vender outros produtos que eu tenho?', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12727, 68, 'É um produto digital? Isso é ótimo, não preciso me preocupar com estoque! 💻', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12728, 68, 'Kiwify realmente é o caminho? Quero saber mais experiências de vocês!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12729, 68, 'Se eu não ver resultados em 30 dias, posso pedir meu dinheiro de volta, né? 🧐', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12730, 68, 'Adorei a proposta! Vou tentar e contar os resultados! ⚡️', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12731, 68, 'As aulas são muito motivacionais! Isso pode realmente mudar vidas! 🌟', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12732, 68, 'Gostei do feedback que vi no site. As pessoas parecem bem satisfeitas. 😍', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12733, 68, 'Um colega meu começou a usar e já fez algumas vendas, estou esperançosa! 👏🏻', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12734, 68, 'O que eu mais gosto é que é tudo online! Posso trabalhar de qualquer lugar! 🌍', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12735, 68, 'Qualquer um pode fazer? Sou péssimo com tecnologia! 😅', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12736, 68, 'Essa vai ser a solução para minha dívida! Muito ansioso para começar! 🤑', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12737, 68, 'Tem uma garantia de satisfação? Quero me sentir seguro antes de investir. 🤔', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12738, 68, 'Se eu conseguir um resultado bacana, com certeza vou indicar pra família! ❤️', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12739, 68, 'Não conhecia a Kiwify. Está funcionando bem pra quem já tá lá? 🤷‍♂️', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12740, 68, 'Estou empolgado! Acompanhei a live até agora e estou decidido a comprar. 💪', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12741, 68, 'Estou pensando em adicionar isso como um projeto secundário. Vamos ver como vai! 👌', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12742, 68, 'Alguém já chegou a ganhar um valor significativo nessa metodologia?', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12743, 68, 'Por que não conheci isso antes? Estou tão animado para começar minha jornada! 😃', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12744, 68, 'Tem que ter dedicação, né? Não quero entrar nesse e depois desistir! 😅', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12745, 68, 'Adorei o conteúdo até agora, mas as dúvidas que não foram respondidas me deixam inseguro. 😔', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12746, 68, 'Vários amigos meus ganharam dinheiro assim! Estou ansiosa para tentar também! 🎉', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12747, 68, 'Quero ver depoimentos de quem realmente fez grana. Isso me ajudaria a decidir! 🙌', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12748, 68, 'Tô passado com o potencial que isso parece ter! Haja ansiedade! 😆', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12749, 68, 'A proposta parece ousada, mas sou a favor de arriscar quando a chance é boa! 🙏', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12750, 68, 'Lendo os comentários, sinto que não estou só nessa. Bora, galera! Vamos pra cima! ✊', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12751, 68, 'Vi alguns vídeos no YouTube sobre o tema e agora tudo faz sentido. Estou dentro! 🎥', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12752, 68, 'Olha, se rolar um bônus, eu compro na hora! Isso ajudaria muito! 😍', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12753, 68, 'Tem um grupo de suporte? Queria interagir mais com quem está fazendo também! 📱', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12754, 68, 'Ansioso por resultados! Espero que seja tão bom quanto parece! 😅', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12755, 68, 'Palpite: quem entra agora e se dedica vai se dar bem demais! 💰', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12756, 68, 'Uma pergunta: qual é melhor, Kiwify ou outras plataformas? As experiências são diferentes?', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12757, 68, 'Wow, this product sounds amazing! I can\'t wait to try it out!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12758, 68, 'Has anyone here actually used this? What results have you seen?', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12759, 68, 'Just got mine! The setup was super easy!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12760, 68, 'I\'m a bit skeptical... but I really want it to work. 🤔', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12761, 68, 'I wish I had known about this sooner! Could\'ve used this last year!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12762, 68, 'Is this really worth the price, though?', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12763, 68, 'So excited to start my journey to financial freedom! 💪', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12764, 68, 'Can it really help with time management while earning? I struggle with that.', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12765, 68, 'I love the community vibe here! We\'re all in this together!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12766, 68, 'Just saw my friend using this last week, and she loves it!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12767, 68, 'I have some concerns about the initial investment...', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12768, 68, 'This product really helped me pay off my debt, highly recommend it!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12769, 68, 'Do you think it\'s suitable for busy parents? I\'m swamped!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12770, 68, 'Best decision ever! I\'ve made an extra $500 this month!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12771, 68, 'Can someone explain how it works in simple terms?', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12772, 68, 'I think I need a little more convincing before buying.', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12773, 68, 'Just signed up! Fingers crossed this is what I need! 🤞', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12774, 68, 'What’s the refund policy if it doesn\'t work for me?', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12775, 68, 'I’ve been following this for weeks. Today’s the day I buy!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12776, 68, 'Does it require a lot of time each day to make it effective?', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12777, 68, 'Love this! The flexibility it offers is what I need!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12778, 68, 'Some mixed reviews online. Is anyone here experienced?', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12779, 68, 'I can\'t believe how affordable it is compared to others!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12780, 68, 'Expecting big things! Let\'s gooo! 🌟', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12781, 68, 'Does it come with training or support for newbies?', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12782, 68, 'I\'ve seen this mentioned on social media a lot lately!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12783, 68, 'This could really help improve my financial stability!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12784, 68, 'Is there a recommendable way to get started quickly?', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12785, 68, 'I\'ve seen a lot of success stories—it makes me hopeful!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12786, 68, 'Anyone else here joining for the second time? First was great!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12787, 68, 'Does it work in different countries? I’m from Brazil.', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12788, 68, 'Just placed my order! Can’t wait to start earning!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12789, 68, 'I hope the customer support is as good as everyone says!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12790, 68, 'Struggling financially right now... hoping this can help!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12791, 68, 'Does anyone have tips for maximizing earnings with this?', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12792, 68, 'I heard it pays off quickly if you’re consistent!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12793, 68, 'This seems a bit too good to be true, does it really work?', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12794, 68, 'The testimonials are so inspiring! I’m all in!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12795, 68, 'I wish I could see more real-life examples on this...', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12796, 68, 'I made my first sale within a week! Super happy!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12797, 68, 'What if I don’t have much experience? Will I be okay?', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12798, 68, 'Excited to join the ranks of successful users!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12799, 68, 'Community support is everything! Loving the positivity!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12800, 68, 'Hopefully it’s beginner-friendly, I’m really new to this.', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12801, 68, 'The energy in this chat is contagious! Let’s do this!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12802, 68, 'What’s the best strategy for someone just starting?', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12803, 68, 'I love how empowering this can be! Time to take charge!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12804, 68, 'Wish I could join but funds are tight. 😟', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12805, 68, 'Can anyone share their journey? I want to hear success stories!', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24'),
(12806, 68, 'Totally ready to change my life with this! Are you guys with me? 🚀', 'instagram', NULL, '2025-04-09 23:14:24', '2025-04-09 23:14:24');

-- --------------------------------------------------------

--
-- Estrutura para tabela `broad_cast_thumbnails`
--

CREATE TABLE `broad_cast_thumbnails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `video_detail_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `channel_name` varchar(255) DEFAULT NULL,
  `channel_avatar` varchar(255) DEFAULT NULL,
  `status` enum('pending','complete') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `broad_cast_thumbnails`
--

INSERT INTO `broad_cast_thumbnails` (`id`, `user_id`, `video_detail_id`, `title`, `description`, `img_name`, `channel_name`, `channel_avatar`, `status`, `created_at`, `updated_at`) VALUES
(108, 147, 53, 'Como Ganhar dinheiro com vendas online', 'Veja como fazer isso em 3 minutos com uma tecnica especial', 'videothumbnails/1736830505_thumbnail.jpg', 'Mago da Internet', 'channelavatars/1736830505_avatar.jpg', 'complete', '2025-01-14 07:55:05', '2025-01-14 07:59:35'),
(109, 147, 53, 'Como aumentar a retençao da sua Vsl em 50%', 'Essa nova plataforma vai fazer toda a diferença na sua operaçao', 'videothumbnails/1736830637_thumbnail.jpg', 'Thiago Finch Oficial', 'channelavatars/1736830637_avatar.jpg', 'complete', '2025-01-14 07:57:17', '2025-01-14 07:59:35'),
(110, 147, 53, 'Como ganhar em dolar 2025 como afiliado', 'o ouro vai ser revelado', 'videothumbnails/1736830768_thumbnail.jpg', 'Vivendo do digital', 'channelavatars/1736830768_avatar.jpg', 'complete', '2025-01-14 07:59:28', '2025-01-14 07:59:35'),
(113, 147, 55, '33333333', '333333333', 'videothumbnails/1739651834_thumbnail.jpg', '3333333', 'channelavatars/1739651834_avatar.jpg', 'complete', '2025-02-15 23:37:14', '2025-02-15 23:37:18'),
(115, 147, 64, 'COMO FAZER', 'DESC2', 'videothumbnails/1740081711_thumbnail.jpg', 'CHANNEL 2', 'channelavatars/1740081711_avatar.jpg', 'complete', '2025-02-20 23:01:51', '2025-02-20 23:01:55'),
(117, 147, 69, 'Como ganhar dinheiro com a insternet', 'Nessa live voce vai descobrir..', 'videothumbnails/1741226964_thumbnail.jpg', 'Kiwify Brasil', 'channelavatars/1741226964_avatar.jpg', 'complete', '2025-03-06 05:09:24', '2025-03-06 05:11:13'),
(118, 147, 69, 'Como fazer videos virais com Ia', 'O mestre da ia', 'videothumbnails/1741227009_thumbnail.jpg', 'Kacto Payment', 'channelavatars/1741227009_avatar.jpg', 'complete', '2025-03-06 05:10:09', '2025-03-06 05:11:13'),
(119, 147, 69, 'Como Nonetizar um Canal de corte do Zero', 'Veja nessa live..', 'videothumbnails/1741227071_thumbnail.jpg', 'Ganhar com Youtube', 'channelavatars/1741227071_avatar.jpg', 'complete', '2025-03-06 05:11:11', '2025-03-06 05:11:13');

-- --------------------------------------------------------

--
-- Estrutura para tabela `buy_plans`
--

CREATE TABLE `buy_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `plan_type` varchar(255) NOT NULL,
  `plan_duration` varchar(255) NOT NULL,
  `payment` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `expiration_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `comment_frequencies`
--

CREATE TABLE `comment_frequencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `video_details_id` int(11) NOT NULL,
  `min_Sec` int(11) NOT NULL,
  `max_Sec` int(11) NOT NULL,
  `vsl_time_in_minutes` int(11) NOT NULL DEFAULT 60,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `comment_frequencies`
--

INSERT INTO `comment_frequencies` (`id`, `video_details_id`, `min_Sec`, `max_Sec`, `vsl_time_in_minutes`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 10, 60, '2024-08-19 07:52:33', '2024-08-19 07:52:33'),
(2, 2, 6, 10, 60, '2024-08-19 08:20:18', '2024-08-19 08:20:18'),
(3, 6, 2, 10, 60, '2024-08-20 11:01:49', '2024-08-20 11:01:49'),
(4, 14, 2, 10, 60, '2024-08-20 11:49:59', '2024-08-20 11:49:59'),
(5, 16, 2, 10, 60, '2024-08-20 12:05:22', '2024-08-20 12:17:05'),
(6, 17, 2, 10, 60, '2024-08-20 13:05:42', '2024-08-20 13:05:42'),
(7, 18, 2, 10, 60, '2024-08-20 13:39:02', '2024-08-20 13:39:02'),
(8, 19, 2, 10, 60, '2024-08-20 14:03:57', '2024-08-20 14:03:57'),
(9, 7, 2, 10, 60, '2024-08-21 09:23:53', '2024-08-21 09:23:53'),
(10, 20, 2, 10, 60, '2024-08-21 17:35:26', '2024-08-21 17:35:26'),
(11, 25, 2, 3, 60, '2024-08-27 13:06:28', '2024-08-27 17:29:05'),
(12, 27, 5, 6, 60, '2024-08-28 07:20:24', '2024-08-28 07:20:24'),
(13, 31, 3, 3, 60, '2024-08-29 18:18:55', '2024-09-18 06:49:09'),
(14, 32, 2, 4, 60, '2024-08-30 20:42:16', '2024-08-30 20:42:16'),
(15, 33, 2, 10, 60, '2024-09-04 12:50:41', '2024-09-04 12:50:41'),
(16, 34, 2, 10, 60, '2024-09-05 10:14:10', '2024-09-05 10:14:10'),
(17, 35, 2, 10, 60, '2024-09-05 11:00:49', '2024-09-05 11:00:49'),
(18, 22, 5, 6, 60, '2024-09-05 11:34:47', '2024-09-05 11:34:47'),
(19, 21, 2, 8, 60, '2024-09-05 11:39:34', '2024-09-05 11:39:34'),
(20, 36, 2, 10, 60, '2024-09-05 13:36:07', '2024-09-05 13:36:07'),
(21, 37, 2, 10, 60, '2024-09-05 14:00:07', '2024-09-05 14:00:07'),
(22, 38, 2, 10, 60, '2024-09-05 14:04:08', '2024-09-05 14:04:08'),
(23, 39, 2, 4, 60, '2024-09-05 22:39:11', '2024-09-05 22:39:11'),
(24, 40, 2, 4, 60, '2024-09-17 20:57:47', '2024-09-17 20:57:47'),
(25, 30, 2, 3, 60, '2024-09-18 06:28:19', '2024-09-18 06:28:19'),
(26, 42, 3, 3, 60, '2024-12-16 17:45:54', '2024-12-16 17:45:54'),
(27, 43, 2, 3, 60, '2024-12-16 20:26:15', '2024-12-16 20:26:15'),
(28, 48, 4, 7, 60, '2024-12-17 20:20:51', '2024-12-17 20:36:25'),
(29, 49, 2, 6, 60, '2024-12-19 19:48:31', '2024-12-19 19:48:31'),
(30, 50, 3, 5, 60, '2024-12-19 23:47:31', '2024-12-19 23:47:31'),
(31, 51, 2, 3, 60, '2024-12-23 05:54:24', '2024-12-23 05:54:24'),
(32, 52, 2, 10, 60, '2024-12-30 23:54:33', '2024-12-31 00:42:41'),
(33, 53, 2, 6, 60, '2025-01-27 05:43:27', '2025-02-02 18:52:11'),
(34, 67, 2, 12, 60, '2025-03-03 18:39:18', '2025-03-03 18:48:32'),
(35, 66, 2, 6, 17, '2025-03-04 00:55:08', '2025-03-06 00:43:56'),
(36, 69, 2, 12, 26, '2025-03-06 05:12:59', '2025-03-06 05:12:59'),
(37, 68, 2, 6, 15, '2025-03-06 05:16:53', '2025-04-09 23:14:24');

-- --------------------------------------------------------

--
-- Estrutura para tabela `criativos`
--

CREATE TABLE `criativos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `anuncio_id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(100) NOT NULL COMMENT 'Título do criativo',
  `tag` varchar(50) DEFAULT NULL COMMENT 'Tag para categorização/filtragem',
  `url` varchar(2048) DEFAULT NULL COMMENT 'URL para o conteúdo do criativo',
  `creativeId` varchar(255) NOT NULL,
  `platform` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`platform`)),
  `platform_backup` varchar(255) DEFAULT NULL,
  `language` varchar(255) NOT NULL,
  `idioma` varchar(10) DEFAULT NULL COMMENT 'Idioma do criativo (PT-BR, EN-US, etc)',
  `image` varchar(255) DEFAULT NULL,
  `caption` text DEFAULT NULL,
  `status` enum('ativo','inativo') NOT NULL DEFAULT 'ativo',
  `performance_status` varchar(255) DEFAULT NULL,
  `value` double(8,2) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_status_change` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `criativos`
--

INSERT INTO `criativos` (`id`, `anuncio_id`, `titulo`, `tag`, `url`, `creativeId`, `platform`, `platform_backup`, `language`, `idioma`, `image`, `caption`, `status`, `performance_status`, `value`, `deleted_at`, `created_at`, `updated_at`, `last_status_change`) VALUES
(1, 1, 'Criativo 1', 'tag1', 'https://prod-minio.ja6ipr.easypanel.host/american-producao/388063ef88464d14ddee69b0e7f54fc6-Maratona%20Vocal%20CR%2004.mp4', '1256', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', 'criativos/vuW9pgcshCHM3tP4TVWMfyXlamrivPu7FIIjeJI2.jpg', NULL, 'ativo', 'Escalando', 511.00, NULL, '2025-03-27 17:23:03', '2025-04-01 15:50:50', '2025-03-31 17:27:18'),
(2, 1, 'Criativo 2', 'tag2', 'https://prod-minio.ja6ipr.easypanel.host/american-producao/509253c88ed4fe37fe17a47d50855e64-Maratona%20Vocal%20CR%2006.mp4', '1257', '[\"Instagram\"]', 'Instagram', 'PT-BR', 'PT-BR', 'criativos/1743273374_pessoas 2.jpg', NULL, 'ativo', 'Perdendo desempenho', 15.00, NULL, '2025-03-29 21:36:14', '2025-04-01 15:51:20', '2025-03-31 17:27:34'),
(3, 1, 'criativo 3', 'tag4', 'https://ricardoimoveisitapema.com.br', '1257', '[\"Instagram\"]', 'Instagram', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', 'Testando criativos', 35.00, NULL, '2025-03-31 17:26:59', '2025-04-01 15:51:33', '2025-03-31 17:36:34'),
(4, 1, 'Criativo 4', 'cri5', 'https://prod-minio.ja6ipr.easypanel.host/american-producao/388063ef88464d14ddee69b0e7f54fc6-Maratona%20Vocal%20CR%2004.mp4', '123', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 6.00, NULL, '2025-04-01 15:49:50', '2025-04-01 15:51:46', NULL),
(5, 1, 'Criativo 5', 'tag1', 'https://prod-minio.ja6ipr.easypanel.host/american-producao/4b71fd73efa18b1d0d10026c4b9b3c7b-Maratona%20Vocal%20CR%2003.mp4', '1234', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 10.00, NULL, '2025-04-01 15:53:22', '2025-04-01 15:53:22', NULL),
(6, 1, 'Criativo 6', 'tag1', 'https://prod-minio.ja6ipr.easypanel.host/american-producao/adce33e5b131b0f60b4f870964559e35-Maratona%20Vocal%20CR%2002.mp4', '12345', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 11.00, NULL, '2025-04-01 15:54:38', '2025-04-01 15:54:38', NULL),
(7, 1, 'Criativo 7', 'tag1', 'https://prod-minio.ja6ipr.easypanel.host/american-producao/179dc90840a378c58e8c7346a6226b2c-Maratona%20Vocal%20CR%2001.mp4', '123', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 10.00, NULL, '2025-04-01 15:56:23', '2025-04-01 15:56:23', NULL),
(8, 3, 'criativo 01', 'tag1', 'https://www.facebook.com/ads/library/?id=7957138831071297', '1345', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 1.00, NULL, '2025-04-10 02:29:56', '2025-04-10 02:29:56', NULL),
(9, 3, 'criativo 2', 'tag1', 'https://www.facebook.com/ads/library/?id=8674544696007310', '5etrd', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 1.00, NULL, '2025-04-10 02:31:20', '2025-04-10 02:31:20', NULL),
(10, 3, 'criativo 03', 'tag1', 'https://www.facebook.com/ads/library/?id=1342002620139360', 'dytr', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 1.00, NULL, '2025-04-10 02:32:20', '2025-04-10 02:32:20', NULL),
(11, 3, 'criativo 4', 'tag1', 'https://www.facebook.com/ads/library/?id=1722419101649695', 'd', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 23.00, NULL, '2025-04-10 02:33:28', '2025-04-10 02:33:28', NULL),
(12, 3, 'Criativo 5', 'tag1', 'https://www.facebook.com/ads/library/?id=1417984732500787', 'gdh', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 21.00, NULL, '2025-04-10 02:34:19', '2025-04-10 02:34:19', NULL),
(13, 3, 'criativo 6', 'tag1', 'https://www.facebook.com/ads/library/?id=1312549990047245', 'fns', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 28.00, NULL, '2025-04-10 02:36:40', '2025-04-10 02:36:40', NULL),
(14, 3, 'criativo 7', 'tag1', 'https://www.facebook.com/ads/library/?id=2778386652333054', 'fzs', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 51.00, NULL, '2025-04-10 02:38:01', '2025-04-10 02:38:01', NULL),
(15, 3, 'criativo 8', 'tag1', 'https://www.facebook.com/ads/library/?id=957283599932622', 'fsf', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 51.00, NULL, '2025-04-10 02:39:26', '2025-04-10 02:39:26', NULL),
(16, 3, 'criativo 9', 'tag1', 'https://www.facebook.com/ads/library/?id=3686678644912065', 'fvbhzh', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 51.00, NULL, '2025-04-10 02:41:12', '2025-04-10 02:41:12', NULL),
(17, 4, 'Criativo 1', 'olhos', 'https://www.facebook.com/ads/library/?id=677706571271453', 'e5', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 1.00, NULL, '2025-04-11 02:13:04', '2025-04-11 02:13:04', NULL),
(18, 4, 'criativo 2', 'olhos', 'https://www.facebook.com/ads/library/?id=1010347447683381', '1010347447683381', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', 'Perdendo desempenho', 0.00, NULL, '2025-04-11 02:16:40', '2025-04-11 02:29:19', '2025-04-11 02:29:19'),
(19, 4, 'criativo 3', 'tag1', 'https://www.facebook.com/ads/library/?id=1200410831655420', '1200410831655420', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 95.00, NULL, '2025-04-11 02:18:20', '2025-04-11 02:18:20', NULL),
(20, 4, 'criativo 4', 'tag1', 'https://www.facebook.com/ads/library/?id=1004346257918739', '1004346257918739', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 1.00, NULL, '2025-04-11 02:22:08', '2025-04-11 02:22:08', NULL),
(21, 4, 'Criativo 5', 'olhos', 'https://www.facebook.com/ads/library/?id=3570283346599394https://www.facebook.com/ads/library/?id=3570283346599394', '3570283346599394', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-04-11 02:31:06', '2025-04-11 02:31:06', NULL),
(22, 6, 'Criativo 1', 'Evangélico/Cristianismo', 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/482766783_1117197656756178_6365022783066521542_n.mp4?_nc_cat=100&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeFZ6ZNW_1Kh7GIElsdLqBrVv_e3If0pbwe_97ch_SlvBx3Au7lToU-KmXoVuTh6QrI3fMs0RVKl6jLCyPCMUdqT&_nc_ohc=MtU8lzJcB2EQ7kNvwEfmLVg&_nc_oc=Adlu8LTATDuDm8PfboDHZP3LVOQhnjChoXmFKvLFZmxgi7JtllzLS9BgeXl7OR-nlHE&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=6Mz4ybE4g_27ZH_3gB5fhA&oh=00_AfH-ObFijhj0Dc5yBeX97f9BpkpA8e-WFzxaCYzIWxIfcg&oe=67FE4E01', '1192530045609185', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 16.00, NULL, '2025-04-11 03:26:52', '2025-04-11 03:26:52', NULL),
(23, 6, 'Criativo 2', 'Evangélico/Cristianismo', 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/482867968_498925736608574_6867206556268763918_n.mp4?_nc_cat=103&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeEE3OSqqItFtwvmew3OKnzpweRBpJIzRzLB5EGkkjNHMpGkgfngz50diYeuCn8vdxtmwSAifOAKnVyLWjv1_REd&_nc_ohc=T22Lu9DgGf0Q7kNvwEKnTLj&_nc_oc=Adn7lQyrmZFilqWZPTUrZMxorY7wHSPrpM_B-3mQdQgcvhZOfe-iV-kU5cfyDLQ8LJk&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=6Mz4ybE4g_27ZH_3gB5fhA&oh=00_AfEJSoF5zUrAwjk2MxdJtlo_kxxfpwPGOVDHmZhnZ-1a_Q&oe=67FE3141', '1178551073469629', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 6.00, NULL, '2025-04-11 03:31:05', '2025-04-11 03:31:05', NULL),
(24, 5, 'Criativo 1', 'Evangélico/Cristianismo', 'https://www.facebook.com/ads/library/?id=1273079664246752', '1273079664246752', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', 'Perdendo desempenho', 8.00, NULL, '2025-04-11 03:36:31', '2025-04-11 03:37:51', '2025-04-11 03:37:51'),
(25, 5, 'criativo 2', 'Evangélico/Cristianismo', 'https://www.facebook.com/ads/library/?id=2184622328619285', 'I', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', 'criativos/1744332250_3c6e3997-bd60-4aca-9b40-ba9867c693b1.png', NULL, 'ativo', NULL, 1.00, NULL, '2025-04-11 03:44:10', '2025-04-11 03:44:10', NULL),
(26, 5, 'criativo 3', 'Evangélico/Cristianismo', 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/486097709_669529908962868_8184716508493432686_n.mp4?_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=F70udM8y6YgQ7kNvwGPUVdb&_nc_oc=Adkh4kC8_j_gxDLaKKehuEybrmiIp8V9OW0j95H8nVLFethXsRxz5l8hkocwtP9BX4Q&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=_xgjgT3QC0KMcRgrXJZOTw&oh=00_AfEGB6oxVKj0L_ykIDr0BCDCip5dGunbvJlMfn8Qh3nBTQ&oe=67FE4713', '491955150662220', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 40.00, NULL, '2025-04-11 03:48:56', '2025-04-11 03:48:56', NULL),
(27, 7, 'criativo 01', 'tag1', 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/451262821_1022883042799367_3802101047175041092_n.mp4?_nc_cat=111&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeF12-6xTa9eepPVRPhdhHH8B8gcyUSjp60HyBzJRKOnrSlt_DoecgfXkQKIQ8rmz9ghFM9a3IRefq3SDBC4JlVx&_nc_ohc=USKF3wZNKzwQ7kNvwE2m1X0&_nc_oc=AdmM0rdbejEL1KRHYg_KmK59c2F9jJV3aamRIvGgB35fgJGw8TLGerfuGXdD2UDyVkE&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=Em3KupqNJ95GpiRogUPs3g&oh=00_AfEgCUUAgzkGYF18xqFaP7Z7fM3SOrX5xeOKjmO_QE9cbQ&oe=67FE5433', '531888176328018', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 3.00, NULL, '2025-04-11 04:28:10', '2025-04-11 04:28:10', NULL),
(28, 7, 'Criativo 2', 'tag2', 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/399358103_249900854728788_4683517884106491577_n.mp4?_nc_cat=110&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeHbQP4wGbx-wz1Dlg_BJZD5YrJ2dLa6tC1isnZ0trq0LVzu8IesAiln36t6jRELr6z8rdteGKV9nIQcmqNL6jhH&_nc_ohc=lRyOOPFovJEQ7kNvwF_DODw&_nc_oc=AdnSxFeF0n9ozCKFlEfP_n5yOrkIlbvqqcDOuEKEspxIDb_0wWjbZi6IOak-umEqtJo&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=Em3KupqNJ95GpiRogUPs3g&oh=00_AfE2tUfYLmx2nPRZ0kdNKUF6we0HdHGsSNdP4hB8_SOUwA&oe=67FE5C08', '1236607631801603', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 6.00, NULL, '2025-04-11 04:29:36', '2025-04-11 04:29:36', NULL),
(29, 7, 'Criativo 3', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/461519271_1048372263617069_4223511585634835718_n.mp4?_nc_cat=103&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeEY5_a-0IIlGf9P6x9MNq8eUJRyBi-gQipQlHIGL6BCKjyrybGPlQQNt-sHvtSkgUjrzGFZBtm45JxK5kY9BkTh&_nc_ohc=pNnLNt1KXtUQ7kNvwEcN0bN&_nc_oc=Adl_PpwvruuUIAEZ0aFHgzgEEDOtfxpX_FN_lEP0eK6OmDMtzBfMpc_l8maTDYUnbeg&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=Em3KupqNJ95GpiRogUPs3g&oh=00_AfGJWn6eVOCkPEGn5OErJ4vK4BmsrmnKJHIdXASAifIBiA&oe=67FE2EF7', '29313030031676607', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 3.00, NULL, '2025-04-11 04:32:26', '2025-04-11 04:32:26', NULL),
(30, 7, 'criativo 4', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/466344217_1341950883846070_8607327271029741236_n.mp4?_nc_cat=106&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeGN5Y8pot3gRHk8lysDTQqbphfiqSW8m4ymF-KpJbybjCW_zvzEG4Osx-FNLdqjenOuty2VKMlNFVvlA0wPqEbQ&_nc_ohc=StsXnYBPEwkQ7kNvwEMco4G&_nc_oc=Adn8u_TihZUh9J1ypZK8lKvFHi84Ui4tPeMRey2JAfqUfmRhwLVoc-udsFMzy4E3vxw&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=Em3KupqNJ95GpiRogUPs3g&oh=00_AfHMzn0AorIOtfcbrsPA3VEa1sBGryF7kodJjfGE5G2VMQ&oe=67FE46A4', '2678136249053860', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 0.00, NULL, '2025-04-11 04:34:36', '2025-04-11 04:34:36', NULL),
(31, 7, 'Criativo 5', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/388929364_730553272240492_1436702142133222742_n.mp4?_nc_cat=106&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeH9SCPUve9jW2HSO23GTSIqxX0z6pgdLsrFfTPqmB0uytjqnOBKSoja_rsemHyWxfyZabm9TBqE1MXSdLhZepRl&_nc_ohc=gLLl-ACgt-kQ7kNvwGiM41p&_nc_oc=Adm2-zmyh8NyJepnjcndLGakaA9GY8kwtJaoo266RU6cqBtM0efI8ZWRYAF4cBWxpdg&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=Em3KupqNJ95GpiRogUPs3g&oh=00_AfFb7yX6i3PbyPTc4XL72XeFGP6qBC1AbNTMSrUZ1giaPg&oe=67FE2F29', '653403700754167', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 7.00, NULL, '2025-04-11 04:39:47', '2025-04-11 04:39:47', NULL),
(32, 7, 'Criativo 6', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/449042661_869325171890555_5777911996748533810_n.mp4?_nc_cat=103&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeE2ETVzPo868IQbwm1rfrwsfXf_XWbhhx99d_9dZuGHH2VpOUSUbz15GcR8IS0B5SV_eV5mue9IAEdSjZpLVklM&_nc_ohc=ZX8IA829o3kQ7kNvwHVL5Z4&_nc_oc=AdnvsMhkyenNQipupTjdetd5xOTCWVL1qMULXzvPhfHsk7BDMaYvfmhh1kCFQf_EyN0&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=9RnyJYLVIyMBXvpHGZZX4g&oh=00_AfF5m8a3XNiZ0Vj1HS63xf1bu2Ow__5QqfF447SH15K0KQ&oe=67FE4748', '1181989720065086', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 7.00, NULL, '2025-04-11 04:43:19', '2025-04-11 04:43:19', NULL),
(33, 5, 'criativo 4', 'Evangélico/Cristianismo', 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/486097709_669529908962868_8184716508493432686_n.mp4?_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=F70udM8y6YgQ7kNvwGPUVdb&_nc_oc=Adkh4kC8_j_gxDLaKKehuEybrmiIp8V9OW0j95H8nVLFethXsRxz5l8hkocwtP9BX4Q&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=_xgjgT3QC0KMcRgrXJZOTw&oh=00_AfEGB6oxVKj0L_ykIDr0BCDCip5dGunbvJlMfn8Qh3nBTQ&oe=67FE4713', '9777298632315664', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-04-11 04:59:04', '2025-04-11 04:59:04', NULL),
(34, 8, 'criativo 01', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/481325050_2925916190909996_1123548781316021123_n.mp4?_nc_cat=107&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeH66APGMXwJlA-sgfzwD6BjWwYyeO-e411bBjJ4757jXU7KJ-lv4u-XAW5WNTEKF79CvbmaEZM-Kr4w8mViZlCM&_nc_ohc=Kx5Y6IO6OC4Q7kNvwEp_4Kl&_nc_oc=Adk34_bWFiMse3zF2ovtctukHlXW-7dKMRRwPGf1EU8OqBFveVz1cwbTcoxDijyCRbc&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=RNcPin-zG7JR1g7JgLQoEA&oh=00_AfHrrSYP6zgf748OYpKJ4iYjYIRvFbIpiW46FaWt3Vsv_g&oe=67FE4030', '624967530544937', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 4.00, NULL, '2025-04-11 05:04:53', '2025-04-11 05:04:53', NULL),
(35, 5, 'criativo 5', 'Evangélico/Cristianismo', 'https://www.facebook.com/ads/library/?id=535965909558207', '535965909558207', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 7.00, NULL, '2025-04-11 05:06:17', '2025-04-11 05:06:17', NULL),
(36, 8, 'Criativo 2', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/485022582_1823653791745191_4520477719510067851_n.mp4?_nc_cat=100&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeFQ8hp1HUGnb4Tf30Z935IRc5qkUlJcS8pzmqRSUlxLytOnB3Qo2PiyeEfRYx0239ETZADPBfaftm3gZ95-9OLP&_nc_ohc=xYWXuSpKzakQ7kNvwEnW796&_nc_oc=AdkajXCou6bFnQJ5O1ESzAPxCUNKihbRjjVPoBYbl6cz8CzlT_i4BhOeAP88bkLqpfQ&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=RNcPin-zG7JR1g7JgLQoEA&oh=00_AfFRuEjfqw-NkoIxTZK8n-h3fFsmItWMu8Wi5XILoL8SmA&oe=67FE3750', '679318467805602', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 3.00, NULL, '2025-04-11 05:07:28', '2025-04-11 05:07:28', NULL),
(37, 5, 'criativo 6', 'Evangélico/Cristianismo', 'https://www.facebook.com/ads/library/?id=658852250220758', '658852250220758', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 4.00, NULL, '2025-04-11 05:09:08', '2025-04-11 05:09:08', NULL),
(38, 8, 'Criativo 3', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/481190711_642177658405640_1415915232367388482_n.mp4?_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeELtaUbQHMnAHYZsYgIxLD9ECQdTqbanx4QJB1OptqfHumCCoGn3MwDYpsVv3yZZuKQNqyv-KsTMoDBEoxBdqnR&_nc_ohc=2bAlym5h_UEQ7kNvwGoqbpx&_nc_oc=Adn0ZwfrLLYu7hKQyOXcbgCb6BelxZRZLBidxvRodcgUz_1R1F4pp5174nRHpdqCwN8&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=RNcPin-zG7JR1g7JgLQoEA&oh=00_AfEt9v8cz8smaRuHBhrMiUW0YzuD3xYWe2ywfWa_C-VMFg&oe=67FE3C69', '974449144891913', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-04-11 05:09:44', '2025-04-11 05:09:44', NULL),
(39, 8, 'criativo 4', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/484881669_1360757194926585_8867874946983471254_n.mp4?_nc_cat=105&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeGFaUl5R7AG9JUSZ9n6Ei0mtk2SEBE5CXW2TZIQETkJdRPkonSG9-u-zLSDmFccqMCujI3EIfvkjMXcXWzkRH1v&_nc_ohc=p2kyzi5MCeMQ7kNvwGA7OXT&_nc_oc=AdkTSa4SZt34ZFsgb7eGfDAUADOXk7GODGqfoACgwpytJ8hdDItBlcUUp7PY6T0QhZo&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=RNcPin-zG7JR1g7JgLQoEA&oh=00_AfEtuQMmm0x02qK_Q9VImjoSI-DiZbkB4JK4mW-tDsrdmA&oe=67FE53E0', '1067599821859593', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 3.00, NULL, '2025-04-11 05:11:18', '2025-04-11 05:11:18', NULL),
(40, 5, 'criativo 7', 'Evangélico/Cristianismo', 'https://www.facebook.com/ads/library/?id=460535470414719', '460535470414719', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 15.00, NULL, '2025-04-11 05:11:21', '2025-04-11 05:11:21', NULL),
(41, 9, 'Criativo 1', 'TAG 1', 'https://www.facebook.com/ads/library/?id=1871450480318504', '1871450480318504', '[\"Facebook\"]', 'Facebook', 'EN-US', 'EN-US', NULL, NULL, 'ativo', NULL, 56.00, NULL, '2025-04-23 22:48:08', '2025-04-23 22:48:08', NULL),
(42, 9, 'CRIATIVO 2', 'TAG 1', 'https://www.facebook.com/ads/library/?id=3671074309696798', '3671074309696798', '[\"Facebook\"]', 'Facebook', 'EN-US', 'EN-US', NULL, NULL, 'ativo', NULL, 84.00, NULL, '2025-04-23 22:49:29', '2025-04-23 22:49:29', NULL),
(43, 9, 'CRIAITVO 3', 'TAG 1', 'https://www.facebook.com/ads/library/?id=1375618506799806', '1375618506799806', '[\"Facebook\"]', 'Facebook', 'EN-US', 'EN-US', NULL, NULL, 'ativo', NULL, 69.00, NULL, '2025-04-23 22:51:08', '2025-04-23 22:51:08', NULL),
(44, 9, 'CRIATIVO 4', 'TAG 1', 'https://www.facebook.com/ads/library/?id=531672406432562', '531672406432562', '[\"Facebook\"]', 'Facebook', 'EN-US', 'EN-US', NULL, NULL, 'ativo', NULL, 90.00, NULL, '2025-04-23 22:53:33', '2025-04-23 22:53:33', NULL),
(45, 10, 'Criativo 1', 'TAG 1', 'https://www.facebook.com/ads/library/?id=1043603787816155', '1043603787816155', '[\"Facebook\"]', 'Facebook', 'EN-US', 'EN-US', NULL, NULL, 'ativo', 'Perdendo desempenho', 9.00, NULL, '2025-04-23 23:43:28', '2025-04-23 23:46:04', '2025-04-23 23:46:04'),
(46, 10, 'criativo 2', 'TAG 1', 'https://www.facebook.com/ads/library/?id=498378863242222', '498378863242222', '[\"Facebook\"]', 'Facebook', 'EN-US', 'EN-US', NULL, NULL, 'ativo', NULL, 18.00, NULL, '2025-04-23 23:45:02', '2025-04-23 23:45:02', NULL),
(47, 10, 'CRIATIVO 3', 'TAG 1', 'https://www.facebook.com/ads/library/?id=1710023269605057', '1710023269605057', '[\"Facebook\"]', 'Facebook', 'EN-US', 'EN-US', NULL, NULL, 'ativo', NULL, 7.00, NULL, '2025-04-23 23:48:39', '2025-04-23 23:48:39', NULL),
(48, 10, 'CRIATIVO 4', 'TAG 1', 'https://www.facebook.com/ads/library/?id=533948042867112', '533948042867112', '[\"Facebook\"]', 'Facebook', 'EN-US', 'EN-US', NULL, NULL, 'ativo', NULL, 9.00, NULL, '2025-04-23 23:50:46', '2025-04-23 23:50:46', NULL),
(49, 10, 'Criativo 5', 'TAG 1', 'https://www.facebook.com/ads/library/?id=1344870796717170', '1344870796717170', '[\"Facebook\"]', 'Facebook', 'EN-US', 'EN-US', NULL, NULL, 'ativo', NULL, 17.00, NULL, '2025-04-23 23:53:33', '2025-04-23 23:53:33', NULL),
(50, 10, 'Criativo 6', 'TAG 1', 'https://www.facebook.com/ads/library/?id=658466076818929', '658466076818929', '[\"Facebook\"]', 'Facebook', 'EN-US', 'EN-US', NULL, NULL, 'ativo', NULL, 31.00, NULL, '2025-04-23 23:54:55', '2025-04-23 23:54:55', NULL),
(51, 10, 'CRIATIVO 7', 'TAG 1', 'https://www.facebook.com/ads/library/?id=1221134816270580', '1221134816270580', '[\"Facebook\"]', 'Facebook', 'EN-US', 'EN-US', NULL, NULL, 'ativo', NULL, 18.00, NULL, '2025-04-23 23:58:51', '2025-04-23 23:58:51', NULL),
(52, 10, 'criativo 8', 'TAG 1', 'https://www.facebook.com/ads/library/?id=1921271508677924', '1921271508677924', '[\"Facebook\"]', 'Facebook', 'EN-US', 'EN-US', NULL, NULL, 'ativo', NULL, 71.00, NULL, '2025-04-24 00:26:50', '2025-04-24 00:26:50', NULL),
(53, 11, '456200944223290', 'tag1', 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/481714240_1140965354192648_8239256210615590023_n.mp4?_nc_cat=105&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=Wx2C0wmNKxcQ7kNvwG4OTsE&_nc_oc=AdkrBXjztbMOdy_BaO-W-K8uIC09nPFgdggrTtbExikUszdHBMEXD3ZjTdxVQDsbMX0&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=TMtYlRkzdlC5pLyMEZ_SzQ&oh=00_AfEEbmoIjNXX5IDTtwjqj4jNEWAUQKLcEjwDZ8qVk25t2A&oe=68101D31', '456200944223290', '[\"Facebook\"]', 'Facebook', 'ES', 'ES', NULL, NULL, 'ativo', NULL, 18.00, NULL, '2025-04-24 16:58:55', '2025-04-24 18:24:18', NULL),
(54, 11, '1726035744936115', 'tag1', 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/486681609_1206728174414972_2539658095934896296_n.mp4?_nc_cat=105&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=fw7oSh_tboIQ7kNvwEp_6Zt&_nc_oc=AdnCgrZGK-7Z0w60D8qSoll8A9EDIVJthcljWsKAAql_YCppmggfCWMOh1VwspVqHPM&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=TMtYlRkzdlC5pLyMEZ_SzQ&oh=00_AfFCLUB7xCcpdfIpoWIB5s6ZGwHR8yzgsfuQt0qgzPAshA&oe=68101353', '1726035744936115', '[\"Facebook\"]', 'Facebook', 'ES', 'ES', NULL, NULL, 'ativo', NULL, 9.00, NULL, '2025-04-24 17:17:59', '2025-04-24 18:25:13', NULL),
(55, 11, '641498758800572', 'Emagrecimento', 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/489964997_1020637803598837_6797726982219995216_n.mp4?_nc_cat=110&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=nhMmWsknxUAQ7kNvwFWQYug&_nc_oc=Adlakm5VGJyV63J2RUmPmWg6w1yugWs9uGnUtlgUYZr-soj4Fapt2v02toBiGppuQJE&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=TMtYlRkzdlC5pLyMEZ_SzQ&oh=00_AfFCMGdSSjEAFfGpL6HVbVQvWQTMVPcV4GR-UiRFI8XYsQ&oe=681018AF', '641498758800572', '[\"Instagram\"]', 'Instagram', 'ES', 'ES', NULL, NULL, 'ativo', NULL, 3.00, NULL, '2025-04-24 18:16:43', '2025-04-24 18:16:43', NULL),
(56, 11, '644835325205644', 'Emagrecimento', 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/490041276_1840705306775852_9177073756985558754_n.mp4?_nc_cat=102&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=taj--ixLPtkQ7kNvwFpeYjq&_nc_oc=Adnf8cYIcATEav4qjskA8b6oFz4-AIlP9aw9OtShtxHxbBnhDReFZpkj-hPrhBwTIbQ&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=TMtYlRkzdlC5pLyMEZ_SzQ&oh=00_AfEBQsdCYLFxAqENOVYyh_aGL1iVxisy5mkbItF7nWE2zg&oe=680FF955', '644835325205644', '[\"Facebook\"]', 'Facebook', 'ES', 'ES', NULL, NULL, 'ativo', NULL, 6.00, NULL, '2025-04-24 18:19:29', '2025-04-24 18:19:29', NULL),
(57, 11, '1056278359890509', 'Emagrecimento', 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491552422_1171724230911981_7945159231662979518_n.mp4?_nc_cat=109&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=Y6C1_83Cu2kQ7kNvwGALvqF&_nc_oc=AdlwI6U6gN4YvcewE60jYjOVPAjG6pTvrvYCaOLZx5ia8ZgsbS_IZJ6xepvb7t5mBA8&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=TMtYlRkzdlC5pLyMEZ_SzQ&oh=00_AfEDnuHyZeHg1FsQ1pBkcCZcYVRcJAwH8UNNkxFL5UUdpQ&oe=6810019F', '1056278359890509', '[\"Facebook\"]', 'Facebook', 'ES', 'ES', NULL, NULL, 'ativo', NULL, 6.00, NULL, '2025-04-24 18:21:42', '2025-04-24 18:21:42', NULL),
(58, 11, '649769777976293', 'Emagrecimento', 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491561512_1041334227849670_888839798819333152_n.mp4?_nc_cat=109&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=xAa-u7ZPd3sQ7kNvwGuHhM7&_nc_oc=AdnEZgx2s981594HjmOe5Mlel8b81v5wFP8M-HOZJsTyZBt7F2o7n3oaCiey-yXBIQo&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=gbrELacJ0Dj-TNYhDpaMPg&oh=00_AfF6YvAVQ9ye_ueZoQEEDX4B5_YMA0Cdi9USf0EdVmFRfw&oe=68101B82', '649769777976293', '[\"Facebook\"]', 'Facebook', 'ES', 'ES', NULL, NULL, 'ativo', NULL, 3.00, NULL, '2025-04-24 18:22:49', '2025-04-24 18:22:49', NULL),
(59, 11, '1022632452557395', 'Emagrecimento', 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/481714240_1140965354192648_8239256210615590023_n.mp4?_nc_cat=105&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=Wx2C0wmNKxcQ7kNvwG4OTsE&_nc_oc=AdkrBXjztbMOdy_BaO-W-K8uIC09nPFgdggrTtbExikUszdHBMEXD3ZjTdxVQDsbMX0&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=TMtYlRkzdlC5pLyMEZ_SzQ&oh=00_AfEEbmoIjNXX5IDTtwjqj4jNEWAUQKLcEjwDZ8qVk25t2A&oe=68101D31', '1022632452557395', '[\"Facebook\"]', 'Facebook', 'ES', 'ES', NULL, NULL, 'ativo', NULL, 3.00, NULL, '2025-04-24 18:23:29', '2025-04-24 18:23:29', NULL),
(60, 12, '1240204624133353', 'Emagrecimento', 'https://drive.google.com/file/d/1pbwP5Nb7vd1v2BQpz68BAl7NWflWxa8D/view?usp=drive_link', '1240204624133353', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', 'criativos/1745512716_492734587_1658840044837294_5980036008640722891_n.jpeg', NULL, 'ativo', 'Ativo', 2.00, NULL, '2025-04-24 19:38:36', '2025-04-26 21:31:33', '2025-04-26 21:31:33'),
(61, 12, '1071363228161474', 'Emagrecimento', 'https://l.facebook.com/l.php?u=https%3A%2F%2Flp1.secajejum.com%2F&h=AT1goTj7jCx7Uya7F4aRl566fK-izrarqmK_EMcx5b_jhxKlGUMwHbPZZnF7IUXG8DyOUVz-EEhiS3pa2IgLVvLrunWC6UM5auNBlG9b4dXu4Ny5HSbHiUl19QfuGJXYtYzwSE6GADiTRBlfZ8fpaQ', '1071363228161474', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', 'criativos/1745513006_487729540_655094810583215_7465049261066391472_n.jpeg', NULL, 'ativo', NULL, 4.00, NULL, '2025-04-24 19:43:26', '2025-04-24 19:43:26', NULL),
(62, 12, '9435083423226473', 'Emagrecimento', 'https://l.facebook.com/l.php?u=https%3A%2F%2Flp1.secajejum.com%2F&h=AT1goTj7jCx7Uya7F4aRl566fK-izrarqmK_EMcx5b_jhxKlGUMwHbPZZnF7IUXG8DyOUVz-EEhiS3pa2IgLVvLrunWC6UM5auNBlG9b4dXu4Ny5HSbHiUl19QfuGJXYtYzwSE6GADiTRBlfZ8fpaQ', '9435083423226473', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', 'criativos/1745513085_487729540_655094810583215_7465049261066391472_n (1).jpeg', NULL, 'ativo', NULL, 8.00, NULL, '2025-04-24 19:44:45', '2025-04-24 19:44:45', NULL),
(63, 12, '2083132362200674', 'Emagrecimento', 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/475801384_3469827456647078_4191286299156966640_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=108&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=Id5LNnwPKAUQ7kNvwEiDnS0&_nc_oc=AdmfJSAANmWjhFpXGhWOyPXOnkuir_f8tMRO903EspxPxdaJcrxArzPlK-zp0BTkzSo&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=W7VF2UxMcjRf6_fYK9J8Tg&oh=00_AfGA9mn8aUKv_ch-tY5ms3gkUwU4lL3vnjPCgohb870lmg&oe=681044EF', '2083132362200674', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', 'criativos/1745513156_475801384_3469827456647078_4191286299156966640_n.jpeg', NULL, 'ativo', NULL, 14.00, NULL, '2025-04-24 19:45:56', '2025-04-24 19:45:56', NULL),
(64, 1, 'Cicero Alves Voz de Respeito', 'Violao', 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/486753343_729154052940960_504758242126468194_n.mp4?_nc_cat=110&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=Vd2DnXmMhvUQ7kNvwGmOytZ&_nc_oc=AdnUqSvV_zhEZ1a7pRTgFAaHSriIQMg_u1Wia-GBgO3szNwyXR6zCByL_4Iq4se8SK0&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=dCsu-3VKnh7AljckX-Jduw&oh=00_AfGdAXmOh6b8WBVCAINiPXeEkeC8Dj2VJK9pJvqizv1Ybg&oe=680F3BD3', '1392701158587273', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, 'Transforme sua voz em menos de 7 dias! Se quer uma voz grave, forte e imponente, eu posso te ajudar. Conheça o Método Voz e Respeito e conquiste uma voz de respeito.', 'ativo', NULL, 9.00, NULL, '2025-04-26 16:47:33', '2025-04-26 16:47:33', NULL),
(65, 13, 'Wylliam Marques MKT Digital', 'Renda extra', 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/487477217_1580754169299565_7307387856834088115_n.mp4?_nc_cat=105&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=LDFySE6JlLsQ7kNvwG9bPeF&_nc_oc=AdmbcDd16ehEWHt_q6k3r_9MGUoV6C3-xmpMc7Hkz4Mw2Xp09WYFsdB3vo0ZROk4tCQ&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=qU5IZZ9SE986GBwwdBnOsA&oh=00_AfE7YucsfI_yguwj0RovQUlOHWySv2ggHRAW0owfMaFf1Q&oe=68155CA8', '693155566416024', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, 'NÃO CONTRATE GESTOR DE TRÁFEGO \r\nTe mostro como acelerar seu NEGÓCIO na INTERNET, Fazer Tráfego Pago e Vender muito!!🤩🚀', 'ativo', NULL, 1.00, NULL, '2025-04-28 16:54:12', '2025-04-28 16:54:12', NULL),
(66, 13, '3843370465975903', 'Renda extra', 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/487840822_560823823093672_703265588327375413_n.mp4?_nc_cat=107&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=5AeBSdNnecUQ7kNvwGrEIsl&_nc_oc=Adk9P-5tFPUILG7DSLlBahWe_Ilrs1rq7oPaCRTXGrK64EBFvh7xzaFq5Od0rNNaos0&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=qU5IZZ9SE986GBwwdBnOsA&oh=00_AfEPdJRR1mb5fEoum3Fgittfnm2MLSpqKXfV5HtElXNwuA&oe=68154226', '3843370465975903', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, 'NÃO CONTRATE GESTOR DE TRÁFEGO \r\nTe mostro como acelerar seu NEGÓCIO na INTERNET, Fazer Tráfego Pago e Vender muito!!🤩🚀', 'ativo', NULL, 2.00, NULL, '2025-04-28 16:55:35', '2025-04-28 16:55:35', NULL),
(67, 13, '1201176484890381', 'Renda extra', 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/483405390_1290509052007664_5379756589222396451_n.mp4?_nc_cat=104&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=2CEwGD-2GfIQ7kNvwFf3ZOV&_nc_oc=Adl9jB09V-Zwdz-SZyyQsGLhV3h9w21-N1c3NZzg8VJ3bzEB71dLTM3VV9xEmOosxw0&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=-eGy8A29g4x7b_MUFQrLmA&oh=00_AfHrdnggqQKrFFdCWveKbhMz2WA2kYvaNJ59yW1fZU3Rjw&oe=68155327', '1201176484890381', '[\"Facebook\"]', 'Facebook', 'EN-US', 'EN-US', NULL, 'Você pode e dever fazer seus anúncios.\r\nClica nesse link de saiba mais e vem descobrir \r\ncomo fazer isso.', 'ativo', NULL, 4.00, NULL, '2025-04-28 16:57:04', '2025-04-28 16:57:04', NULL),
(68, 13, '1233972798303704', 'Renda extra', 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/484648593_1720875828842703_3738383603712118646_n.mp4?_nc_cat=105&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=iBx7EHUe8oQQ7kNvwGiS9J1&_nc_oc=Adn8w5vL7QsqegPyoVFHGkyLh5Y5UXj5HnlfvUS4YBQBwhTV7oodrc8htiQJgbu9bpo&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=-eGy8A29g4x7b_MUFQrLmA&oh=00_AfGVyfSAAJ5ut-sKR4NxXRtfH0moSflmQGuD9OQzbqh3Qw&oe=68157530', '1233972798303704', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, 'Te mostro como acelerar seus resultados na internet, ter mais clientes e Vender muito!!🤩🚀', 'ativo', NULL, 3.00, NULL, '2025-04-28 16:58:13', '2025-04-28 16:58:13', NULL),
(69, 13, '1968854283886772', 'Renda extra', 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/486050657_965090475776493_530607646327704973_n.mp4?_nc_cat=111&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=s1aGi8MnNqMQ7kNvwGSzztn&_nc_oc=AdnU6XGm7_NaS3BQj55fUd7OBJOyhG5SbpNurWo_jd3pZqZkx2WRRRj3B2IYjOrEILg&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=qU5IZZ9SE986GBwwdBnOsA&oh=00_AfExv1x4-WAkENgQMHyUim0ubrkNdiNvenXZCi7QBsw9ag&oe=68155D8C', '1968854283886772', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, 'Você não precisa pagar um gestor de tráfego, você mesmo pode fazer, clica aqui e descubra', 'ativo', NULL, 1.00, NULL, '2025-04-28 17:00:02', '2025-04-28 17:00:02', NULL),
(70, 13, '1407103260723667', 'Renda extra', 'https://video.xx.fbcdn.net/v/t42.1790-2/491483597_1367080771269924_7137956979909929049_n.mp4?_nc_cat=103&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=4yadw33_e5sQ7kNvwGiqjY1&_nc_oc=Adl4dfNeMNdV9GDLK3IY316sO-spVja5BIyGgefYWSM0v4dDNwwQPBKi0-zvhBCVFAo&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=vjADf7BOx1g-v6I1vCI2YA&oh=00_AfHvLl4wgq5aav4LUuYkVMF4ocbyOYQVB-dgaLltJHIrAg&oe=6815593F', '1407103260723667', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, 'Te mostro como acelerar seu NEGÓCIO na INTERNET, Fazer Tráfego Pago e Vender muito!!🤩🚀\r\n\r\nChega de gastar com agência ou depender de gestor de tráfego. Faça você mesmo e veja como multiplicar suas VENDAS usando o Instagram e WHATSAPP', 'ativo', NULL, 80.00, NULL, '2025-04-28 17:19:32', '2025-04-28 17:19:32', NULL),
(71, 13, '649724957862441', 'Renda extra', 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/488883270_971358978314459_2539199097375613007_n.mp4?_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=NjaISVpPRd4Q7kNvwEOgPD_&_nc_oc=AdlvwrPQm9hFc0Q3n2bBycgANILLfDYJmZj8r1mqLMGVIWjEc83G3yzsD6lv_VUGfZg&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=TQGgI7nB_QPYyZQX9zqIaQ&oh=00_AfE3zx2QTmuoZaNp-m1eV2emFHWD_eruL0OIdXs01WTSjA&oe=681547D6', '649724957862441', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, 'Você pode e dever fazer seus anúncios.\r\nClica nesse link de saiba mais e vem descobrir \r\ncomo fazer isso.', 'ativo', NULL, 12.00, NULL, '2025-04-28 17:21:46', '2025-04-28 17:21:46', NULL),
(72, 13, '1420653005589871', 'Renda extra', 'https://video.xx.fbcdn.net/v/t42.1790-2/491899480_1034051611981785_4301169978587707886_n.mp4?_nc_cat=103&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=sxhrr_eTHw8Q7kNvwE2H6vs&_nc_oc=Adkqc1w7Sa8qpNyYtcAE5SduJzPxHOc1pR8NJuhWH0c1fPZ2iZjhxVyImMfSH3MzwHs&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=TQGgI7nB_QPYyZQX9zqIaQ&oh=00_AfGTVoUxnOK-nuZ7oj-eYtLHh_NpvDziGzejhQ-7RWZ7iQ&oe=6815778B', '1420653005589871', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, 'Te mostro como acelerar seu NEGÓCIO na INTERNET, Fazer Tráfego Pago e Vender muito!!🤩🚀\r\n\r\nChega de gastar com agência ou depender de gestor de tráfego. Faça você mesmo e veja como multiplicar suas VENDAS usando o Instagram e WHATSAPP', 'ativo', NULL, 6.00, NULL, '2025-04-28 17:24:31', '2025-04-28 17:24:31', NULL),
(73, 13, '2455401651520693', 'Renda extra', 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491482438_1243356810540122_5558716544063613301_n.mp4?_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=UtXoQ0_BnI8Q7kNvwF0qG5F&_nc_oc=AdlF3KLwlI4TLU2XdjxZkdi8v97wBJpnCZ8_0Y5vAlux07byrTi-OmRIj7QjcjqnfBI&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=kDDKeplgoeLYPKiH5CnS4w&oh=00_AfH0CrkFjHTGbyFvjZsCY-UH-QZfEyxBaZs3u-JY7Xq9_Q&oe=6815753E', '2455401651520693', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, 'Te mostro como VOCÊ mesmo pode fazer seu TRÁFEGO PAGO e Multiplicar suas VENDAS\r\n\r\nConheça a Starflix do Empreendedor Digital.', 'ativo', NULL, 15.00, NULL, '2025-04-28 17:25:31', '2025-04-28 17:25:31', NULL),
(74, 13, '1909699643169172', 'Renda extra', 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/490772289_1168150847909776_3649813051703504058_n.mp4?_nc_cat=104&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=z8I_2WiOACsQ7kNvwEBjV16&_nc_oc=AdlbUhRHNvLtecIwyHJTUD8v4U7t3dCfYzDEOEWrIoi6zhntocsXKhIbh5SIXVHWAOg&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=zWnNgjlXNCriA6kXNTH24Q&oh=00_AfHvwqW9Yz4xt5WAuve559ZXZS2z7OiBQkgIdgLz104G4w&oe=68155149', '1909699643169172', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, 'Você quer ser reconhecido no seu bairro, na sua cidade, e atrair clientes todos os dias pelo Instagram e WhatsApp? Então você precisa aprender a fazer o anúncio certo, do jeito certo.\r\n\r\nE o melhor: sem depender de agência nem gestor de tráfego!\r\n\r\nEu te ensino tudo, passo a passo, pra você dominar o tráfego pago e', 'ativo', NULL, 31.00, NULL, '2025-04-28 17:27:15', '2025-04-28 17:27:15', NULL),
(75, 14, '564948016620729', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491896543_964739242503228_3481330290454191255_n.mp4?_nc_cat=103&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=8yRKUQIzwAMQ7kNvwEYyWof&_nc_oc=Adnvyw1ImzITitht5ge7dCoWSYwgCY75YdVogAiTuoI6B72lPW-DVTa_FX21jxDicIQ&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=aleh1MXlrEfvDv-bZLPl9Q&oh=00_AfEWW_hMxSeGQq99-IyDRTsqpLcnGfQdH6y0oMXtRicZag&oe=681556BB', '564948016620729', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, 'Descubra o truque desconhecido para fazer unhas e ganhar muito bem todos os meses, toque em saiba mais e conheça esse truque agora. 💅', 'ativo', 'Ativo', 1.00, NULL, '2025-04-28 17:44:35', '2025-04-28 21:08:51', '2025-04-28 21:08:51'),
(76, 14, '629943400041857', NULL, 'https://video.xx.fbcdn.net/v/t42.1790-2/491212123_541828128650016_891688701403138250_n.mp4?_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=ARaeswHw9-wQ7kNvwHlQBg3&_nc_oc=AdknH5Wq05l5RiImkES1akWDS9LDfJujTkDUk-g8rUD2FQV4BrAXwwQplhjblsvJgf8&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=aleh1MXlrEfvDv-bZLPl9Q&oh=00_AfGY1SF62lkoujggYmjzZecumBdZSiegepa8MC0GAuW0iw&oe=68155043', '629943400041857', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, 'Descubra o truque desconhecido para fazer unhas e ganhar muito bem todos os meses, toque em saiba mais e conheça esse truque agora. 💅', 'ativo', NULL, 1.00, NULL, '2025-04-28 17:45:31', '2025-04-28 17:45:31', NULL),
(77, 14, '647942131562422', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491896543_964739242503228_3481330290454191255_n.mp4?_nc_cat=103&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=8yRKUQIzwAMQ7kNvwEYyWof&_nc_oc=Adnvyw1ImzITitht5ge7dCoWSYwgCY75YdVogAiTuoI6B72lPW-DVTa_FX21jxDicIQ&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=aleh1MXlrEfvDv-bZLPl9Q&oh=00_AfEWW_hMxSeGQq99-IyDRTsqpLcnGfQdH6y0oMXtRicZag&oe=681556BB', '647942131562422', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 1.00, NULL, '2025-04-28 17:46:12', '2025-04-28 17:46:12', NULL),
(78, 14, '654851324028874', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491899550_1200514404669312_8842655566397241427_n.mp4?_nc_cat=110&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=vTn85BedXegQ7kNvwGyIW6D&_nc_oc=AdkG-0fUBpClkmjIhn3dhJTlsphPvu___tTbND6l5Aj25IxEbqSG8sT8plPYZKJpCFk&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=aleh1MXlrEfvDv-bZLPl9Q&oh=00_AfGjNg69zehF9qMIErwxFNyeWWumafRwbgbyyRDgfHp7cw&oe=68156009', '654851324028874', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 1.00, NULL, '2025-04-28 17:46:46', '2025-04-28 17:46:46', NULL),
(79, 14, '694091706432505', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491688136_1676534156588943_2830279149341544401_n.mp4?_nc_cat=102&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=Q4ZbnNjeSXMQ7kNvwH07JtL&_nc_oc=Adl9n4KSX5nwsNnFMA70R8FGHGPMF9HhZDeDBMOecSp9CnfDittLLfI3Wqoa8LXWNjk&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=aleh1MXlrEfvDv-bZLPl9Q&oh=00_AfF2-4gxuQDYxdHydho7u0UTNPZRhtH7RhS9FWFzrn8l0A&oe=681555AA', '694091706432505', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 10.00, NULL, '2025-04-28 17:47:37', '2025-04-28 17:47:37', NULL),
(80, 14, '712037494498907', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491688136_1676534156588943_2830279149341544401_n.mp4?_nc_cat=102&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=Q4ZbnNjeSXMQ7kNvwH07JtL&_nc_oc=Adl9n4KSX5nwsNnFMA70R8FGHGPMF9HhZDeDBMOecSp9CnfDittLLfI3Wqoa8LXWNjk&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=aleh1MXlrEfvDv-bZLPl9Q&oh=00_AfF2-4gxuQDYxdHydho7u0UTNPZRhtH7RhS9FWFzrn8l0A&oe=681555AA', '712037494498907', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 15.00, NULL, '2025-04-28 17:48:12', '2025-04-28 17:48:12', NULL),
(81, 14, '718060220575087', NULL, 'https://video.xx.fbcdn.net/v/t42.1790-2/491896543_964739242503228_3481330290454191255_n.mp4?_nc_cat=103&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=8yRKUQIzwAMQ7kNvwEYyWof&_nc_oc=Adnvyw1ImzITitht5ge7dCoWSYwgCY75YdVogAiTuoI6B72lPW-DVTa_FX21jxDicIQ&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=aleh1MXlrEfvDv-bZLPl9Q&oh=00_AfEWW_hMxSeGQq99-IyDRTsqpLcnGfQdH6y0oMXtRicZag&oe=681556BB', '718060220575087', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 11.00, NULL, '2025-04-28 17:49:09', '2025-04-28 17:49:09', NULL),
(82, 14, '720648253960939', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491212123_541828128650016_891688701403138250_n.mp4?_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=ARaeswHw9-wQ7kNvwHlQBg3&_nc_oc=AdknH5Wq05l5RiImkES1akWDS9LDfJujTkDUk-g8rUD2FQV4BrAXwwQplhjblsvJgf8&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=aleh1MXlrEfvDv-bZLPl9Q&oh=00_AfGY1SF62lkoujggYmjzZecumBdZSiegepa8MC0GAuW0iw&oe=68155043', '720648253960939', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 17.00, NULL, '2025-04-28 17:49:46', '2025-04-28 17:49:46', NULL),
(83, 14, '1191941139306934', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491688136_1676534156588943_2830279149341544401_n.mp4?_nc_cat=102&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=Q4ZbnNjeSXMQ7kNvwH07JtL&_nc_oc=Adl9n4KSX5nwsNnFMA70R8FGHGPMF9HhZDeDBMOecSp9CnfDittLLfI3Wqoa8LXWNjk&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=aleh1MXlrEfvDv-bZLPl9Q&oh=00_AfF2-4gxuQDYxdHydho7u0UTNPZRhtH7RhS9FWFzrn8l0A&oe=681555AA', '1191941139306934', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 14.00, NULL, '2025-04-28 17:50:25', '2025-04-28 17:50:25', NULL),
(84, 14, '1400921164253061', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491896543_964739242503228_3481330290454191255_n.mp4?_nc_cat=103&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=8yRKUQIzwAMQ7kNvwEYyWof&_nc_oc=Adnvyw1ImzITitht5ge7dCoWSYwgCY75YdVogAiTuoI6B72lPW-DVTa_FX21jxDicIQ&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=aleh1MXlrEfvDv-bZLPl9Q&oh=00_AfEWW_hMxSeGQq99-IyDRTsqpLcnGfQdH6y0oMXtRicZag&oe=681556BB', '1400921164253061', '[\"Facebook\"]', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 19.00, NULL, '2025-04-28 17:51:08', '2025-04-28 17:51:08', NULL),
(85, 14, 'Criativo 11', NULL, 'https://prod-minio.ja6ipr.easypanel.host/american-producao/509253c88ed4fe37fe17a47d50855e64-Maratona%20Vocal%20CR%2006.mp4', 'teste', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 0.00, '2025-04-28 21:01:27', '2025-04-28 20:56:20', '2025-04-28 21:01:27', NULL),
(86, 12, 'Criativo 5', NULL, 'https://prod-minio.ja6ipr.easypanel.host/american-producao/509253c88ed4fe37fe17a47d50855e64-Maratona%20Vocal%20CR%2006.mp4', '00000', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 1.00, '2025-04-28 22:03:00', '2025-04-28 22:02:43', '2025-04-28 22:03:00', NULL),
(87, 15, 'Criativo 1', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/439087167_796842078634507_1644312568569391107_n.mp4?_nc_cat=104&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=86DT_2NcSDMQ7kNvwFJVFs8&_nc_oc=Adm8cTJ2-Az_IxmfGXZL4Dt6kqjG_3zWiB35UYvOCZpCovwqTj_7PuQcP7GAhfxgyWw&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=Os8cBTdSHRlH9__-gaRwcA&oh=00_AfEwQmofkYGrvFg26lX-IObP3BO4cjphKk7hMETRbUc3Aw&oe=6815AFB8', '1817717775470742', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-04-28 22:18:01', '2025-04-28 22:18:01', NULL),
(88, 15, 'Criativo 2', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/439097339_422338077073487_1145807266672186435_n.mp4?_nc_cat=108&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=3D5cwPX5fp8Q7kNvwE4jnIQ&_nc_oc=AdkXNC3ToR185AQZ4kUbk_VabYPPQCc99haao1899D_PyPnRi6KmQyMbYaSSzvcQ9x4&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=Os8cBTdSHRlH9__-gaRwcA&oh=00_AfFtgUPRsda33HgvYY7K1HeECpNd8DZMFDgqiYcbY-qC2g&oe=6815A26C', '9468396476601906', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 9.00, NULL, '2025-04-28 22:18:39', '2025-04-28 22:18:39', NULL),
(89, 15, 'Criativo 3', NULL, 'https://video.xx.fbcdn.net/v/t42.1790-2/435569029_394456373547079_5960579945800740633_n.mp4?_nc_cat=102&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=UF4jG7m7_B4Q7kNvwH6w-TG&_nc_oc=Adk-L4xHfOfvKdaNEUYT_j_KACqsl7wE8cPhWBYFxYccVr7mA4x5-PT9lV0Ot4RRbMw&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=Os8cBTdSHRlH9__-gaRwcA&oh=00_AfFjTTYU3HN6zgQI7IVQAPyIe3a25Ta4js-6r1SQDeosCw&oe=68159879', '697573962842428', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 3.00, NULL, '2025-04-28 22:19:12', '2025-04-28 22:19:12', NULL),
(90, 17, 'Criativo 1', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491567327_682432737660981_218377558773695531_n.mp4?_nc_cat=104&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=kASoci3QchEQ7kNvwHy0lJS&_nc_oc=AdksFybZB471CnallKDUzA4KvMKjrcf84jA89ESSd_pO9iO5B7K6x4LyihptgjQyFjg&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=OOrhQkhY8R6k_wsDFt1fWQ&oh=00_AfHbWa-M69eH0Zul8JJ_jDmDH2r6pi809-oYvcQWa--U6w&oe=6815C2F4', '530761390110452', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 1.00, NULL, '2025-04-28 23:01:54', '2025-04-28 23:01:54', NULL),
(91, 17, 'Criativo 2', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491898701_1336674924283311_1487914158811132871_n.mp4?_nc_cat=104&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=LTTJCtPlz70Q7kNvwHW2TD8&_nc_oc=AdluHTAlppgiX_DCLyRSut0-xnStJjg4BZSXiABT4ms0gXPi2iz4X--19Hhcfv5U1Ec&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=OOrhQkhY8R6k_wsDFt1fWQ&oh=00_AfH-p6evP6L-mr7ZqyaMJJKMlvtMlxdfmI8X4JJvti6XRw&oe=6815B03F', '556926107040834', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 10.00, NULL, '2025-04-28 23:02:23', '2025-04-28 23:02:23', NULL),
(92, 17, 'Criativo 3', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491567264_1841185540069213_4366720122814092184_n.mp4?_nc_cat=108&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=G1f0YlvEKsEQ7kNvwEp9Xqk&_nc_oc=Adl2R5PpEFR0ORnJ1wUE-4UWT7c0d7DSAtK4N7xwnWobThiQ4c78v1wifNfIFlGWNBI&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=OOrhQkhY8R6k_wsDFt1fWQ&oh=00_AfEEi_nRh-qIMwb7ptq-s7Qh1Y6JakfETyU-3k6lAxqyIw&oe=6815B6A3', '607919078926131', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 1.00, NULL, '2025-04-28 23:02:53', '2025-04-28 23:02:53', NULL),
(93, 17, 'Criativo 4', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491567327_682432737660981_218377558773695531_n.mp4?_nc_cat=104&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=kASoci3QchEQ7kNvwHy0lJS&_nc_oc=AdksFybZB471CnallKDUzA4KvMKjrcf84jA89ESSd_pO9iO5B7K6x4LyihptgjQyFjg&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=OOrhQkhY8R6k_wsDFt1fWQ&oh=00_AfHbWa-M69eH0Zul8JJ_jDmDH2r6pi809-oYvcQWa--U6w&oe=6815C2F4', '615888691486919', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 10.00, NULL, '2025-04-28 23:03:28', '2025-04-28 23:03:28', NULL),
(94, 17, 'Criativo 5', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/484238067_1149470113117551_273750028566282389_n.mp4?_nc_cat=111&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=EFUVGWqWlL0Q7kNvwHqxdtu&_nc_oc=AdkHg8ly-SE5Yp0ljMMNRiGR5itLllxevWp03fpu-lGRsE9wVfotTaG6yC9ymxM7dxI&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=OOrhQkhY8R6k_wsDFt1fWQ&oh=00_AfFGPGVpPYvzXfjAXxKTzOVXVLV66lLTEJ6WYUQl3kJ_BQ&oe=681595C1', '697108046176478', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 15.00, NULL, '2025-04-28 23:04:10', '2025-04-28 23:04:10', NULL),
(95, 17, 'Criativo 6', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491567264_1841185540069213_4366720122814092184_n.mp4?_nc_cat=108&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=G1f0YlvEKsEQ7kNvwEp9Xqk&_nc_oc=Adl2R5PpEFR0ORnJ1wUE-4UWT7c0d7DSAtK4N7xwnWobThiQ4c78v1wifNfIFlGWNBI&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=OOrhQkhY8R6k_wsDFt1fWQ&oh=00_AfEEi_nRh-qIMwb7ptq-s7Qh1Y6JakfETyU-3k6lAxqyIw&oe=6815B6A3', '1158608882707339', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 21.00, NULL, '2025-04-28 23:04:52', '2025-04-28 23:04:52', NULL),
(96, 17, 'Criativo 7', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/486761017_1179194670513803_2069150159293769714_n.mp4?_nc_cat=105&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=lUTeVq9oALEQ7kNvwGv8uyb&_nc_oc=AdkyVjkNuJ1F7xMyKD6JnaqEMC-5tXpgqfB4UCVvrh1fcaKJuq5mJHSscxduhkatgSw&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=f9wnu-ZTA75sQ1e7H4fuXA&oh=00_AfFiHEZ5nP17j_2ePxolQQM9tPGFUcrMNc44T10I0YPsow&oe=68159C07', '679995641308313', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-04-28 23:05:33', '2025-04-28 23:05:33', NULL),
(97, 17, 'Criativo 8', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/488704700_1290501802044957_7342836503883345242_n.mp4?_nc_cat=104&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=aeQyaEdp69QQ7kNvwH_27JM&_nc_oc=AdmFUjj-FMUa-M8B9lpUka6E-UQAQNXoaW-Qi2tmbxV8q1yuOW3PVk_esnTskPray6w&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=f9wnu-ZTA75sQ1e7H4fuXA&oh=00_AfH8Ms9GMEdDP8esAnsXhgg1J5BKFCt_bHPsseDo3x2aTw&oe=6815ADC4', '540205795469527', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 9.00, NULL, '2025-04-28 23:06:16', '2025-04-28 23:06:16', NULL),
(98, 18, 'Criativo 1', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/491538336_538809745934228_827374001354259068_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=105&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=o3LU2PBkA0UQ7kNvwHYWV2y&_nc_oc=AdlxYaPo9cJ8Rrm-54cjvBw7RX1wu5dM4BN6JLZ9YMZ_vmgyCZSw-DZFbqsp648ogrw&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=4EGjc_E6OfPHYQGWjq4L0g&oh=00_AfGeNWreGoSb0B6ot9LFvz016Z697Zmuk2Tj8qS6d20-UA&oe=6815B85D', '589435186778489', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', 'criativos/1745872871_491538336_538809745934228_827374001354259068_n.jpg', NULL, 'ativo', NULL, 5.00, NULL, '2025-04-28 23:41:11', '2025-04-28 23:41:11', NULL),
(99, 18, 'Criativo 2', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/490206895_990297486549243_5731444291998189840_n.mp4?_nc_cat=103&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=Vjqw7S_KPJkQ7kNvwHBqaV3&_nc_oc=Adl8Fpl7L5rNeuQN6Q_x3ehmFKTd40XOI9WXrRbRJra70PczOiyozSmOUpP3AQiUe_E&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=4EGjc_E6OfPHYQGWjq4L0g&oh=00_AfEqSfYeiNhHp-vBgcFL_60_QJczQtCwgFJwnWA14-Xxmw&oe=6815C811', '699880555814624', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-04-28 23:42:01', '2025-04-28 23:42:01', NULL),
(100, 18, 'Criativo 3', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491490451_654270757388876_3257665484997966702_n.mp4?_nc_cat=107&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=Bw_FpN0h5bUQ7kNvwGVEE6Q&_nc_oc=AdmrwXvCI6oTa5mVJtLTVft98H5kwn4P1yfvrgQ68rMY8WPBnXdg0CPcekYnWSfGJOo&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=4EGjc_E6OfPHYQGWjq4L0g&oh=00_AfHs_p1GroLyxzGEeuXRcj7rFGHRVLKe5y2DBVLZpMr_SQ&oe=6815D32E', '1177293580384503', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 0.00, NULL, '2025-04-28 23:42:25', '2025-04-28 23:42:25', NULL),
(101, 18, 'Criativo 4', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491531122_1009863494451089_1188395830540355313_n.mp4?_nc_cat=105&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=pdIBtdTiprEQ7kNvwFX4GQc&_nc_oc=AdleJdz6wXUXaBClH0xgN88byJgPPnWR_HisWOU7xFYCA4rjIlIfH1-7NmaW7GypFiY&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=4EGjc_E6OfPHYQGWjq4L0g&oh=00_AfEDYsmUrCPV83fV6hpwNcg-UYpMrnfbsM6WtJ5ryQNGYQ&oe=6815C70C', '1383092923117841', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-04-28 23:43:01', '2025-04-28 23:43:01', NULL),
(102, 18, 'Criativo 5', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/489954631_942385161145284_1859340884403823491_n.mp4?_nc_cat=111&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=x9zyleIXN1MQ7kNvwFTJhDP&_nc_oc=AdmSeSQRs8Nj59BgIHACR6HF_Rt9rLLH6eVefPvdJRfWs0Gqk5j3VtMiQGqfHBR2ERE&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=4EGjc_E6OfPHYQGWjq4L0g&oh=00_AfGxYRQmmBIb3GZaiaHU83MREVj6rTb5ZfNU5gdY1V1mLQ&oe=6815A365', '1431517768295211', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-04-28 23:43:33', '2025-04-28 23:43:33', NULL);
INSERT INTO `criativos` (`id`, `anuncio_id`, `titulo`, `tag`, `url`, `creativeId`, `platform`, `platform_backup`, `language`, `idioma`, `image`, `caption`, `status`, `performance_status`, `value`, `deleted_at`, `created_at`, `updated_at`, `last_status_change`) VALUES
(103, 18, 'Criativo 6', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/491624983_622390024100456_4939693651161054334_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=102&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=b9uGs4zUQCMQ7kNvwFJlJRl&_nc_oc=AdnHnuJ2SMWeYRC-whaMnAXYp2J6KVSVPYGeCkmfogvKBwxDnzYwZZVF4gwJ4chhgcU&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=4EGjc_E6OfPHYQGWjq4L0g&oh=00_AfEhxqaw8BRQP1qaOyH3alYKAo-iJlDccXWC-NHuhQRNOA&oe=6815AF53', '711313724677842', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', 'criativos/1745873047_491538336_538809745934228_827374001354259068_n.jpg', NULL, 'ativo', NULL, 2.00, NULL, '2025-04-28 23:44:07', '2025-04-28 23:44:07', NULL),
(104, 18, 'Criativo 7', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/490753459_1337374350846946_172861452519062049_n.mp4?_nc_cat=104&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=PQM-Io5M8D0Q7kNvwFSCs2Q&_nc_oc=Adl51tIxotUj6pn2b2A8SUw3WAdZSQCjXOStVRDpl0QRW59IjPwgmI3SFI8v6tTfyDQ&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=4EGjc_E6OfPHYQGWjq4L0g&oh=00_AfFHKmJGWya2w6nPZVI1XAco1EE1RYTfhqnvjIpSWLBPqQ&oe=6815AAA2', '962759192391769', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 10.00, NULL, '2025-04-28 23:44:45', '2025-04-28 23:44:45', NULL),
(105, 18, 'Criativo 8', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491151364_1970657177011692_9130135868588460993_n.mp4?_nc_cat=108&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=fy35p55-ze8Q7kNvwFNg7_S&_nc_oc=AdklxQOoiNJloASMhx3OS1-br_Vx1USHTGlAKhbJVddRXy2HdDPC5hE0K-h3oWm-fEQ&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=4EGjc_E6OfPHYQGWjq4L0g&oh=00_AfEWkK7MYM3d1u6ZhEKyZmluSAZ5NEGjKA2PV8Eofnx14A&oe=6815ABF7', '1037029498487937', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 13.00, NULL, '2025-04-28 23:45:14', '2025-04-28 23:45:14', NULL),
(106, 18, 'Criativo 9', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/483915207_1231185351759625_8980456893573777210_n.mp4?_nc_cat=103&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=dbp61SeOVAAQ7kNvwGGARU2&_nc_oc=AdlqNVu-69NI6LyHuSd2mz3bsT-zpW0Tt2KVdK-wH6kbL_G3-iTWF9CKbg_zer2qvEM&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=4EGjc_E6OfPHYQGWjq4L0g&oh=00_AfHgLF3gjtvOlLZbXRkCc_6t8rMgr-e9DQUo4znv643O3g&oe=6815B81F', '1300774274352086', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 21.00, NULL, '2025-04-28 23:45:45', '2025-04-28 23:45:45', NULL),
(107, 18, 'Criativo 10', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/483938989_989326059963416_2643572473747404869_n.mp4?_nc_cat=100&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=UW_k5FfF89kQ7kNvwGr6Zfp&_nc_oc=Adl0HZKRuPLZagyciWnk-v6xReW4JYpjF-DG8s78EDgO0cgjGINxts6OYlMqoRNCIII&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=4EGjc_E6OfPHYQGWjq4L0g&oh=00_AfEvhv7UlNe7hsGyFhs4CoEAC7ybBAj0U_OTewWeGpAMJA&oe=6815BF99', '710871228039354', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 11.00, NULL, '2025-04-28 23:46:13', '2025-04-28 23:46:13', NULL),
(108, 18, 'Criativo 11', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/482604156_1157076762525592_7783750154064332681_n.mp4?_nc_cat=110&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=mQVjyveE59cQ7kNvwGFKyz9&_nc_oc=AdnAoB3BF0H6UDJUvYs0bR8SB3Ux97UfLLdvronCDIyRlQqfUryxkKS6zqWTK9nXfdQ&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=4EGjc_E6OfPHYQGWjq4L0g&oh=00_AfF9dbFtPByf3KAkX5MkntU9QUxqRuuLcfSbsBb9neiUtw&oe=68159D30', '1636810150532759', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 8.00, NULL, '2025-04-28 23:46:40', '2025-04-28 23:46:40', NULL),
(109, 18, 'Criativo 12', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/483970989_3536346276500906_1229467824511042386_n.mp4?_nc_cat=107&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=pz8bIhPVULsQ7kNvwF84Lle&_nc_oc=AdnHY9olL9JZuPea8DTgxkwQuhLBdcfgwbXmtI236QiChLkmIObAZAJEFuS7OVQaKUs&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=YhU7e0l1uuejngqoLhPqhg&oh=00_AfGpG0pn4h-tVelvPiH_l0LXNrLhMxJjr7-yHqtCKYFNjA&oe=6815BFC5', '643719515123500', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 17.00, NULL, '2025-04-28 23:47:15', '2025-04-28 23:47:15', NULL),
(110, 19, 'Criativo 1', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/488422884_1285857989155030_8227675847896959385_n.mp4?_nc_cat=107&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=QyCLtvwoBxYQ7kNvwHRvttp&_nc_oc=Adl0a14AJ41IhEgSAVaPVBsZ7Xdwxex34NuCXclyihQZCOiQvYoiP7NGe44gjGXwqmY&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=TxZDiR0VMQhmaGJ56dt7Bg&oh=00_AfGpD2-6wQnOrhoRHLR58VrL2_2-Bx0cDXi9zgtkH_pQHQ&oe=6815D195', '687584700323816', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 3.00, NULL, '2025-04-28 23:59:52', '2025-04-28 23:59:52', NULL),
(111, 19, 'Criativo 2', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/487920252_1169494474616270_200084147604254661_n.mp4?_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=8123QBzZ9UUQ7kNvwFh35l7&_nc_oc=AdmAUJoZI9z1KJaXNdYAIiLUPahaMXUKdSFTsygmCpX5aWUkQrd179Ot215m76OL0Fg&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=TxZDiR0VMQhmaGJ56dt7Bg&oh=00_AfH3fbq7mYUVpndvp8IXjJHYu83146gMQaanjVcfz2ZAQw&oe=6815A676', '1021887049405954', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 3.00, NULL, '2025-04-29 00:00:25', '2025-04-29 00:00:25', NULL),
(112, 19, 'Criativo 3', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/487920252_1169494474616270_200084147604254661_n.mp4?_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=8123QBzZ9UUQ7kNvwFh35l7&_nc_oc=AdmAUJoZI9z1KJaXNdYAIiLUPahaMXUKdSFTsygmCpX5aWUkQrd179Ot215m76OL0Fg&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=TxZDiR0VMQhmaGJ56dt7Bg&oh=00_AfH3fbq7mYUVpndvp8IXjJHYu83146gMQaanjVcfz2ZAQw&oe=6815A676', '573278145878087', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 8.00, NULL, '2025-04-29 00:00:50', '2025-04-29 00:00:50', NULL),
(113, 19, 'Criativo 4', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/488422884_1285857989155030_8227675847896959385_n.mp4?_nc_cat=107&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=QyCLtvwoBxYQ7kNvwHRvttp&_nc_oc=Adl0a14AJ41IhEgSAVaPVBsZ7Xdwxex34NuCXclyihQZCOiQvYoiP7NGe44gjGXwqmY&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=TxZDiR0VMQhmaGJ56dt7Bg&oh=00_AfGpD2-6wQnOrhoRHLR58VrL2_2-Bx0cDXi9zgtkH_pQHQ&oe=6815D195', '668846819472454', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 8.00, NULL, '2025-04-29 00:01:18', '2025-04-29 00:01:18', NULL),
(114, 20, 'Criativo 1', NULL, 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/490656422_1018157156344392_9199201426616467376_n.mp4?_nc_cat=104&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=zFWO1eHfyFYQ7kNvwEXYUHu&_nc_oc=Adk0wJ_aDpOvp0E3EDdXif0vvHVRLXMqld3rAwPii5DahAIJGTLJAwPrWeUDE0jqD74&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=bESm5clCyZu36YxmlmujXw&oh=00_AfGDWVqIWoTExBvOr-hWwNf0r6iywDl3caQao6K0mYb6mQ&oe=6816C163', '574991031738555', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 12.00, NULL, '2025-04-29 20:05:08', '2025-04-29 20:05:08', NULL),
(115, 20, 'Criativo 2', NULL, 'https://video.xx.fbcdn.net/v/t42.1790-2/491476347_1179108410081502_8623154629321713135_n.mp4?_nc_cat=103&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=1CgM97na4RAQ7kNvwHqQP1d&_nc_oc=AdkziJET-y_r_ClX2rYIhGtzS5wpP0w805fXpkSE8i3Z6_e0aGQSM7BTsaYDmiT2E-c&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=bESm5clCyZu36YxmlmujXw&oh=00_AfF8hPgmE-LPS1UIMrg1CcCHPGqjCEHtesKxbPxPYtvOtA&oe=6816DD1A', '1249491089841823', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 4.00, NULL, '2025-04-29 20:05:52', '2025-04-29 20:05:52', NULL),
(116, 20, 'Criativo 3', NULL, 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491476347_1179108410081502_8623154629321713135_n.mp4?_nc_cat=103&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=1CgM97na4RAQ7kNvwHqQP1d&_nc_oc=AdkziJET-y_r_ClX2rYIhGtzS5wpP0w805fXpkSE8i3Z6_e0aGQSM7BTsaYDmiT2E-c&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=PfggXh8Y0nbFLvMy_pLTiA&oh=00_AfENFTV137-Zh4AJrzhMNQZOO0RsskRFVdtcAhQgGjs5wQ&oe=6816DD1A', '1734238270855559', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 0.00, NULL, '2025-04-29 20:06:33', '2025-04-29 20:06:33', NULL),
(117, 21, 'Criativo 1', NULL, 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/494130320_1038279564848522_3134073430362261786_n.mp4?_nc_cat=105&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=OvN9xxS_QA8Q7kNvwFUPxpO&_nc_oc=Adm9u5qczPNNu8-b2o2u3lisueNR72n2PPhHsyrGFUyOse56IHLqtOkhtkLLS51l87Q&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=uSnDCLB8HIyz-RpPFRcMwg&oh=00_AfFx3q8L8uLtRBEvmdDz5qbSca2YwqWnoPnBSvmdTXmdZQ&oe=6816BFF6', '1325011715268341', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 9.00, NULL, '2025-04-29 20:19:31', '2025-04-29 20:19:31', NULL),
(118, 21, 'Criativo 2', NULL, 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/494410195_1398286488195154_6222404897319279896_n.mp4?_nc_cat=100&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=wCnVl8apiIoQ7kNvwEKO-KY&_nc_oc=AdnZ9CKQ0NmIRkJE3qZ79jyNigj-sJI3YzBP5CGeuPhWLfxqZ73FIYAGvS-fvofx-jI&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=uSnDCLB8HIyz-RpPFRcMwg&oh=00_AfFD9ERlEtL7ly7cAI53DxOfBhB6GMZKc7js_7fJMh6odg&oe=6816D5D9', '671090745696430', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 7.00, NULL, '2025-04-29 20:19:57', '2025-04-29 20:19:57', NULL),
(119, 21, 'Criativo 3', NULL, 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491487923_1770895703523301_665717835071475198_n.mp4?_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=LwxP6bqhCpgQ7kNvwG_3RDO&_nc_oc=AdlGJxEPmuFlSJMtMcvWCAyeihH2XpHBQi-CjuLr3wm0IxcQZC_sjoGTX3OQkOmqbzk&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=uSnDCLB8HIyz-RpPFRcMwg&oh=00_AfGl_2RbUPuJGsnlkn7P_1HShGwkh-T6uixztGaSO33LIw&oe=6816C134', '662018193422487', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 4.00, NULL, '2025-04-29 20:20:27', '2025-04-29 20:20:27', NULL),
(120, 21, 'Criativo 4', NULL, 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/494525313_585301084581358_1210284056357378509_n.mp4?_nc_cat=109&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=Dm5RLYScqb0Q7kNvwFFHbT3&_nc_oc=Adlbb3dDuZQBMDxZJrMnpDiT6JZx7A4fWbvm4Xmhu8SMuhJF3t5WboAphsrN6CC6cH0&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=uSnDCLB8HIyz-RpPFRcMwg&oh=00_AfHdumvAXTLnZFCh_gXgv_5oZllJEcZ3oDOazS2dqJuOug&oe=6816DB7D', '1298272124608195', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 7.00, NULL, '2025-04-29 20:20:58', '2025-04-29 20:20:58', NULL),
(121, 21, 'Criativo 5', NULL, 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491511775_4089287141393969_3962618162704420183_n.mp4?_nc_cat=102&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=Ntd-rKidlnEQ7kNvwHxe7tv&_nc_oc=Adm8SzXVKFcZ7qFGfT0oL-139Qhw9m-pq-5ehec-XEfu5HdJJWKqvLciaZgYXDpp2bM&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=uSnDCLB8HIyz-RpPFRcMwg&oh=00_AfFuAsG3Qg2CSxWnk6YAvOeWEc1436P-gLsCqAFP17VIFw&oe=6816E0D7', '661629046785903', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 5.00, NULL, '2025-04-29 20:21:32', '2025-04-29 20:21:32', NULL),
(122, 21, 'Criativo 6', NULL, 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/274894646_495147732023066_6243063727175648987_n.mp4?_nc_cat=106&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=wFbNHX7xSR4Q7kNvwHi1FGu&_nc_oc=Adn9tnrmSE33JZA85akd8lR4LrOySUpqEKxDXbrjVsAOZRPBqbQ8TYEb0RkV7SAT9xQ&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=uSnDCLB8HIyz-RpPFRcMwg&oh=00_AfFya7B7IL-ZKWOZw-wMXYaxTxQv39hVzqs_7Aqop-fgLA&oe=6816CC5C', '644254891766587', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 10.00, NULL, '2025-04-29 20:22:13', '2025-04-29 20:22:13', NULL),
(123, 21, 'Criativo 7', NULL, 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/471903460_628019629816495_1627628077752238811_n.mp4?_nc_cat=109&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=dkS6bMeQpXYQ7kNvwENrBxw&_nc_oc=Adl3YMar2b5APTEVlDBwkRXsxfG17WuAfMvOw8SsP_4o3lutT92yxhZ9508Mq0n6tyI&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=wJ0JNh-AEUrZNCbQ8t6Iow&oh=00_AfEETrO4nnCW7xcqdaC08Z8Zh0xvR0Y5ThVKZOZXWNCNJw&oe=6816DA4C', '977692914224954', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 6.00, NULL, '2025-04-29 20:26:58', '2025-04-29 20:26:58', NULL),
(124, 21, 'Criativo 8', NULL, 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/480372851_1341972880152499_4121278233817925997_n.mp4?_nc_cat=109&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=Yoj8-bxZGHYQ7kNvwG5vjRi&_nc_oc=AdmfexwqWs4lsGVJM6mbYRX0dUktao6ygoS_7gGcrsaTdjcIqtM-y4SKjRoJPsvj_do&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=wJ0JNh-AEUrZNCbQ8t6Iow&oh=00_AfFWTMsNdY9xUNDUbblE0GgLG13U37Q7wOlROJiXz69qew&oe=6816D8E3', '627661763240673', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-04-29 20:27:39', '2025-04-29 20:27:39', NULL),
(125, 21, 'Criativo 9', NULL, 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/275615926_649519353002131_1544634951520317262_n.mp4?_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=pHG_16dyNeEQ7kNvwGC4SMH&_nc_oc=AdmT0MAoM9NdAzaqFhCs5JaQ19wtKPQ8Xyn4R-l-35hZZpYcz_amM-XzWc0c53iEzCg&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=36yn_-qG0u1KkWWBPl1WLw&oh=00_AfFq8wiU49SxqhuxsrbhIXUuNeZI_7huNbtylchqPWE6Lg&oe=6816E344', '6822740384436916', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 6.00, NULL, '2025-04-29 20:28:50', '2025-04-29 20:28:50', NULL),
(126, 22, 'Criativo 1', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/490962574_10066410713369044_3499790559159348746_n.mp4?_nc_cat=111&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=lGU_wq7EnVcQ7kNvwFveRhw&_nc_oc=AdknG22WdAPAciKuAeFGHDgbuW2eCFia8K9TO9tPtEWc9_xV4OEDsw6ug653M9yXuN8&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=AAcXeRpuFewmfzDCgvT5Zg&oh=00_AfF2ULa1lFuXPePlajTEcuzBGwacInSUOkI5uyHeyXq53Q&oe=6819A380', '721622330538544', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 5.00, NULL, '2025-05-02 00:01:43', '2025-05-02 00:01:43', NULL),
(127, 22, 'Criativo 2', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491743990_621972270845156_6353036791995822288_n.mp4?_nc_cat=100&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=fSZco_h7QkkQ7kNvwFPMuCc&_nc_oc=Adn6BFcx1e8q0X-TgrLCKqkCoIGGqfv806uirc1EDwuOEMV0kNLa0T6gW9kplKj-FDM&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=AAcXeRpuFewmfzDCgvT5Zg&oh=00_AfGBSZRJx6FpotHNyBfRTzBktPljeprDVSdtENGF1e9stA&oe=6819CE8E', '983848647278080', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', 'Ativo', 6.00, NULL, '2025-05-02 00:02:03', '2025-05-02 00:02:21', '2025-05-02 00:02:21'),
(128, 22, 'Criativo 3', NULL, 'https://video.xx.fbcdn.net/v/t42.1790-2/491487950_1340046130442457_5821587312851104738_n.mp4?_nc_cat=103&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=yLj5uHVt_6AQ7kNvwFD9ujc&_nc_oc=AdnAbK5X82vH1dpTIV46GMx0iAlqjW73wOqoesm0Z4wMq3_msqPDJZiIL0swTrQIgPw&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=AAcXeRpuFewmfzDCgvT5Zg&oh=00_AfHZb2RWx-Bxx8lpyxABJmAf-gfQb0fiqImjRV3jOjKPRQ&oe=6819C5E1', '1186326206039799', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 13.00, NULL, '2025-05-02 00:02:57', '2025-05-02 00:02:57', NULL),
(129, 22, 'Criativo 4', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/493545231_1263575411849409_6905159899879564770_n.mp4?_nc_cat=108&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=kbh5jlvmLg4Q7kNvwErpQVq&_nc_oc=AdkeyvcNz9qSPI7oEM8_1nsJ14dn1uxpG4pP_okl_Yp2mhuK-Hwr0kUEl2_hHFinBaI&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=AAcXeRpuFewmfzDCgvT5Zg&oh=00_AfFvzBZJyBzogi_Km4doxNQcoine9a-ozkckj2wwfkUAhw&oe=6819A5CA', '1330313171605411', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 0.00, NULL, '2025-05-02 00:03:21', '2025-05-02 00:03:21', NULL),
(130, 22, 'Criativo 5', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/494588676_546648238485219_3815182125102954425_n.mp4?_nc_cat=107&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=BKrMVJkpmhgQ7kNvwE-iL3n&_nc_oc=AdmzCtXEpBp-HJvTdve9l1a3gREnIDOgxPNjXnsD6tsSwfDCjjay4nAcujqkjC--ktg&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=AAcXeRpuFewmfzDCgvT5Zg&oh=00_AfFV_fKUFZl4FWmvKvTqEv6CcaTl4ECnZ_UBmhX_O6w-tg&oe=68199771', '1376363810178933', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 3.00, NULL, '2025-05-02 00:03:56', '2025-05-02 00:03:56', NULL),
(131, 22, 'Criativo 6', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491502998_535257969443097_8679506718203244667_n.mp4?_nc_cat=108&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=KZMJpG8SjzcQ7kNvwHdzu5f&_nc_oc=AdlsZL7mvSsFCeMskIApe1R6YF-Kwjw5taEZSZL_U3omeSL1S7V9kTWLCG-BVwKZMBQ&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=AAcXeRpuFewmfzDCgvT5Zg&oh=00_AfHMzz3eW1Vxg55IUzrGm1tCyLQSrUl32jmoqLBbqh0QUQ&oe=6819AA2E', '1764750201054826', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-05-02 00:04:19', '2025-05-02 00:04:19', NULL),
(132, 22, 'Criativo 7', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/494186316_1403072194042863_2356860872392100535_n.mp4?_nc_cat=100&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=kgfCyi4_nAcQ7kNvwFbYMv1&_nc_oc=Adlf-yn14_zUT3ACT43DYTTyU2lbheZtcRatwA3MTV2jTyZ15pvTlhvv-Oeby_IMA00&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=AAcXeRpuFewmfzDCgvT5Zg&oh=00_AfHsQedmL3ECtCeTSqapG__AQZO_yun2BMq6uuE9xpd1ew&oe=6819B5DA', '1822857701903284', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 0.00, NULL, '2025-05-02 00:04:41', '2025-05-02 00:04:41', NULL),
(133, 22, 'Criativo 8', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491511321_1735730470657790_6543375040486223615_n.mp4?_nc_cat=107&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=O_rFPMDf4gkQ7kNvwFQrud8&_nc_oc=AdkEC8plWvmfFvCvN-6IVGmpEQjLbJmNhaGggNAOxX01YofXtP-YPnpdYz7Fmzw6k70&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=AAcXeRpuFewmfzDCgvT5Zg&oh=00_AfEhJWpWQQb0PqHukNTVKOq7SBVPjM3WELsomVDAtBPQfw&oe=6819C177', '4045448675674092', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 8.00, NULL, '2025-05-02 00:05:05', '2025-05-02 00:05:05', NULL),
(134, 22, 'Criativo 9', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491896739_9831106983623778_528546058831170854_n.mp4?_nc_cat=111&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=EeJXmhjIP8UQ7kNvwG2pbvz&_nc_oc=AdlhHYMSaOBODKK_qj-SvQuhkg1x3e22iTmcppdCRhCv7J0Y-b8KWPc3-U1bue90Zd0&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=AAcXeRpuFewmfzDCgvT5Zg&oh=00_AfEJzuIpYXSnzRZGzxtudobB8eBB7nU2EZcz8Ob60anvEg&oe=6819A1F5', '673484561991528', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-05-02 00:05:36', '2025-05-02 00:05:36', NULL),
(135, 22, 'Criativo 10', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491512906_969769345323939_8688425908054564669_n.mp4?_nc_cat=100&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=iBSzHxvg_5sQ7kNvwE_AxIh&_nc_oc=Adm-puPLKoXIc4QjhPr7whPxuSetLwJgeWhBJvUtCIKHWnAMDHFE0bXHpBbFbLO4zkM&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=pw1QSsKE4nXWYk3aK8Kp2g&oh=00_AfEx9OfaLKKY-tfe6q4Ki1QKejPvsEfp5UfCXr2TPJ6YWg&oe=6819B416', '1028923275847665', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 0.00, NULL, '2025-05-02 00:05:54', '2025-05-02 00:05:54', NULL),
(136, 22, 'Criativo 11', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491506764_579047275208152_9055962662118427240_n.mp4?_nc_cat=111&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=FWzO198sxYMQ7kNvwFSe4yd&_nc_oc=AdnZgDyHLjyn58QhU0_45P2W83KbLTR56_V6_hLvkvL6MXasW9nR6fIq0VSUHCicpnw&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=pw1QSsKE4nXWYk3aK8Kp2g&oh=00_AfH-yKo83Sif92fbtRxGtGzU8pd60mMgaY5f59UcB28Jcw&oe=6819AA17', '23864786099792277', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 0.00, NULL, '2025-05-02 00:06:24', '2025-05-02 00:06:24', NULL),
(137, 22, 'Criativo 12', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491521828_1217524813103881_9101906574620029444_n.mp4?_nc_cat=111&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=PiZDMXAmtbEQ7kNvwFWbCWa&_nc_oc=Admpcvl0Cx8fx16RYK493wtHLcd9Py_j7xBQ9Q1X8JKyAgsGUd5XEKVEcdR_hS6oZXo&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=pw1QSsKE4nXWYk3aK8Kp2g&oh=00_AfHqruT9n3l2iQAlTRlaQir1fyhKlwgfeJMJeB_kx---Yg&oe=6819A1CE', '1417935856237569', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 0.00, NULL, '2025-05-02 00:06:47', '2025-05-02 00:06:47', NULL),
(138, 22, 'Criativo 13', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491500871_563507350109317_3512663740518253963_n.mp4?_nc_cat=108&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=PXYxkrjtsFMQ7kNvwEokHb4&_nc_oc=AdkT6tsRPdkrMQIaZtc9ITfKF1EK6YcL3Kt0QEoPfMonzeXIwc-NFAzxAiSyF9V8RmY&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=pw1QSsKE4nXWYk3aK8Kp2g&oh=00_AfHeUbCoX2vLR6Om_gJUP3KTo55htnLlBi9nhgBh2iUtNA&oe=6819BF62', '995368582743788', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 0.00, NULL, '2025-05-02 00:07:07', '2025-05-02 00:07:07', NULL),
(139, 23, 'Criativo 1', NULL, 'https://scontent-bos5-1.xx.fbcdn.net/v/t42.1790-2/483336806_1194639992291323_5469733783505727883_n.mp4?_nc_cat=106&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=b3srWHoVJXgQ7kNvwEn_hNL&_nc_oc=AdmPauKf_bf_wioVdgGr7cgVPUlNlSxCd5r5Zh1lxjgVGCxEdW0O4AiiYusOsg4qX7c&_nc_zt=28&_nc_ht=scontent-bos5-1.xx&_nc_gid=s4LkQxDUkrd_2QYRwRO72A&oh=00_AfFlZJa50AUg8cGAXHLCXIufLt26LsnqNwIfstbsWbuSmQ&oe=6819C9A5', '561178230422782', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 20.00, NULL, '2025-05-02 00:40:14', '2025-05-02 00:40:14', NULL),
(140, 23, 'Criativo 2', NULL, 'https://scontent-bos5-1.xx.fbcdn.net/v/t42.1790-2/485310704_633449832868079_7253589379432056032_n.mp4?_nc_cat=105&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=bVfeBC8AiG4Q7kNvwHPYKUF&_nc_oc=AdmOt_-gjfvA8P2HbC9Cxj-LeDNIiiQe2OHFHDHvoASLHzUCYobz78aOiit4gYnZu9U&_nc_zt=28&_nc_ht=scontent-bos5-1.xx&_nc_gid=s4LkQxDUkrd_2QYRwRO72A&oh=00_AfFI2w7Fth7OliB7pfaCG63Q4jG9aQCP3u209m9wvn-OTw&oe=6819BB50', '1008269444275941', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 13.00, NULL, '2025-05-02 00:40:45', '2025-05-02 00:40:45', NULL),
(141, 23, 'Criativo 3', NULL, 'https://scontent-bos5-1.xx.fbcdn.net/v/t42.1790-2/484925254_2095818680879703_154106180818453555_n.mp4?_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=Q5ch6CQ-nMgQ7kNvwFXT8KT&_nc_oc=AdlW8lfThce6OlxAnr3zV7siXoAAbViCOPwHi0_DnoLC65j2XYJ03NIuLKw59nxLNK4&_nc_zt=28&_nc_ht=scontent-bos5-1.xx&_nc_gid=s4LkQxDUkrd_2QYRwRO72A&oh=00_AfH-HbnBi7AzVoSg3ci88r0EEVwE1wEYjOC2gYYBIDC8Cw&oe=6819A874', '883368353919617', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 17.00, NULL, '2025-05-02 00:41:11', '2025-05-02 00:41:11', NULL),
(142, 23, 'Criativo 4', NULL, 'https://scontent-bos5-1.xx.fbcdn.net/v/t42.1790-2/482660161_2420008521693702_1144449583103854550_n.mp4?_nc_cat=106&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=PpMIXcZGWbkQ7kNvwF2Gqos&_nc_oc=AdmjR6m9VzVdDmmLB4Ya-1UHe7pidL63oSGxaimP5cG7r5rWDct3wtO0p5nd5Py5DT8&_nc_zt=28&_nc_ht=scontent-bos5-1.xx&_nc_gid=s4LkQxDUkrd_2QYRwRO72A&oh=00_AfGLSFaPSgBf0wm8r0-NXmMAUsVMjIijmChVTXAv-BSfDA&oe=6819C9FB', '1180635083518153', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 14.00, NULL, '2025-05-02 00:41:35', '2025-05-02 00:41:35', NULL),
(143, 23, 'Criativo 5', NULL, 'https://scontent-bos5-1.xx.fbcdn.net/v/t42.1790-2/479708175_922663909950098_2775557294899060283_n.mp4?_nc_cat=108&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=YvQEW69LAuoQ7kNvwGWMT0r&_nc_oc=AdnxUClhEC9bayu_787J1xispL_aYVVC8DNN66jYZBSOPwkIUKO4EPHpj-pO9_twnhw&_nc_zt=28&_nc_ht=scontent-bos5-1.xx&_nc_gid=s4LkQxDUkrd_2QYRwRO72A&oh=00_AfEmG7HSxnZpyG0Q3_qCGpWNDxg4rjSwerUMvI9FTxEffA&oe=6819D463', '1386172609248395', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 7.00, NULL, '2025-05-02 00:42:02', '2025-05-02 00:42:02', NULL),
(144, 23, 'Criativo 6', NULL, 'https://scontent-bos5-1.xx.fbcdn.net/v/t42.1790-2/480927964_1581273382587742_4693095943688270842_n.mp4?_nc_cat=105&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=bH8Ii6XltdsQ7kNvwHvXu5e&_nc_oc=Adno_hIMCrFUyZnIR4rlceQJxt-W_40PJkheMxmwFOJav5kIQPRoYqUMRRJagC_CV6E&_nc_zt=28&_nc_ht=scontent-bos5-1.xx&_nc_gid=s4LkQxDUkrd_2QYRwRO72A&oh=00_AfHLKs7UR7sy0qo8BEsiroUfAsr-eTZNXLy_6IVci3tSwg&oe=6819AD3B', '1727877161271704', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 0.00, NULL, '2025-05-02 00:42:25', '2025-05-02 00:42:25', NULL),
(145, 23, 'Criativo 7', NULL, 'https://scontent-bos5-1.xx.fbcdn.net/v/t42.1790-2/483965099_1170335894762645_1660569180959808417_n.mp4?_nc_cat=100&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=tGLjfFz1i3wQ7kNvwG_NO6k&_nc_oc=AdlZs90pE7aDMFDhaLucFvNDNwUji7HVdpaVeuk67tgkW1-gSjJEoyBP22Eua9s-JGI&_nc_zt=28&_nc_ht=scontent-bos5-1.xx&_nc_gid=s4LkQxDUkrd_2QYRwRO72A&oh=00_AfHPYyD8GjSIAcCBvoDgkBTzNjwVHxWj_Mdl_rZaRGPmKA&oe=6819D106', '561641613619856', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 11.00, NULL, '2025-05-02 00:42:54', '2025-05-02 00:42:54', NULL),
(146, 23, 'Criativo 8', NULL, 'https://scontent-bos5-1.xx.fbcdn.net/v/t42.1790-2/484815025_1996095457548158_6393863824642239550_n.mp4?_nc_cat=102&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=KqzQNQn8X3wQ7kNvwFFqXYs&_nc_oc=AdkS_XokprwMSeI8Sl1DExQyNp0iJClAHLCtVsr7qHgdYXYJ7Bohcs0cZCMV6vkuolE&_nc_zt=28&_nc_ht=scontent-bos5-1.xx&_nc_gid=s4LkQxDUkrd_2QYRwRO72A&oh=00_AfErG2dswGaaT1qJLyNg5yceLTuCyU2W6t-gEEHxi6gPYA&oe=6819B2F1', '692139343291184', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 0.00, NULL, '2025-05-02 00:43:19', '2025-05-02 00:43:19', NULL),
(147, 23, 'Criativo 9', NULL, 'https://scontent-bos5-1.xx.fbcdn.net/v/t42.1790-2/486284310_2120150361768688_1177180231427643433_n.mp4?_nc_cat=111&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=liUw99NpNwMQ7kNvwHg0Z7Z&_nc_oc=AdmsGLdEO1J0pjYgmObakPm3ApFlLnhNlcLZBEaUxfwaJEUigtzmUuarVo9lFiYFaHQ&_nc_zt=28&_nc_ht=scontent-bos5-1.xx&_nc_gid=s4LkQxDUkrd_2QYRwRO72A&oh=00_AfEG2E5w2RGnngvq24_iGd24HnqjHbPv49tft507Z5uO7g&oe=6819A47A', '1038632901506781', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 11.00, NULL, '2025-05-02 00:43:55', '2025-05-02 00:43:55', NULL),
(148, 23, 'Criativo 10', NULL, 'https://scontent-bos5-1.xx.fbcdn.net/v/t42.1790-2/480368119_658355607123099_4699185761870017750_n.mp4?_nc_cat=109&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=yN8erxJGWnUQ7kNvwFlPjFK&_nc_oc=AdnCR7U1HmxsuOK3nWiMbUwXFKoPUomcq1APbWiH_oxuVK5JOgH9wk7m-2IVgA7t2GM&_nc_zt=28&_nc_ht=scontent-bos5-1.xx&_nc_gid=s4LkQxDUkrd_2QYRwRO72A&oh=00_AfF5KxMWsO81s-CSZPBPWmmX6Oif3CTRSQw1r52c2McWTw&oe=6819B6CB', '646088934914999', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 4.00, NULL, '2025-05-02 00:44:16', '2025-05-02 00:44:16', NULL),
(149, 23, 'Criativo 11', NULL, 'https://scontent-bos5-1.xx.fbcdn.net/v/t42.1790-2/479693221_633553999256459_9097750919992807846_n.mp4?_nc_cat=108&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=qUE_m--0ZqQQ7kNvwHa0TFL&_nc_oc=Adlm-Nu2ncr71Arhi-wOdnJT1QXkLQhf7F88xyy7BxyU0EJ2W2LfQrOTo_QLTco0oes&_nc_zt=28&_nc_ht=scontent-bos5-1.xx&_nc_gid=NQ16Lj9677A9eDyHdjWapQ&oh=00_AfG16CEtc3hV6Q8P1xvtBZPH0UUV2QjpiEEJClhZl1QQdA&oe=6819C6F5', '1220696336106792', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 9.00, NULL, '2025-05-02 00:44:51', '2025-05-02 00:44:51', NULL),
(150, 23, 'Criativo 12', NULL, 'https://scontent-bos5-1.xx.fbcdn.net/v/t42.1790-2/479029070_1139526414136504_8668659192745299158_n.mp4?_nc_cat=104&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=gAnlO3Kf2hIQ7kNvwFQyqkf&_nc_oc=AdlGLlXQHFA5VjHwY_2dGeEosN49r4Htls-v78AKL9toOH98UfSTV8vAYmGUUFOlXlI&_nc_zt=28&_nc_ht=scontent-bos5-1.xx&_nc_gid=NQ16Lj9677A9eDyHdjWapQ&oh=00_AfEwllvE6jejkye1g5Z0ymKhAck-ioFcymXqapxyHVGNJQ&oe=6819D16B', '1367772787761010', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 4.00, NULL, '2025-05-02 00:45:25', '2025-05-02 00:45:25', NULL),
(151, 24, 'Criativo 1', NULL, 'https://scontent-bos5-1.xx.fbcdn.net/v/t42.1790-2/482264495_541595265014587_8033618593135858543_n.mp4?_nc_cat=110&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=VbNj8jaboWEQ7kNvwEqIHVZ&_nc_oc=AdmRUhSe-XO5pkqYcfxFhm_6sDac_l8ya55oOHim-4399UexTYV3pHSI4ISGKbOD9Nk&_nc_zt=28&_nc_ht=scontent-bos5-1.xx&_nc_gid=mHJLq-4kW-EZ-twfnwAA9Q&oh=00_AfEnLCwfVBnfuDgE-6s2l3RlIP6c7SNmsBhmsgvmwev5sA&oe=6819B7E5', '2339022893147701', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 14.00, NULL, '2025-05-02 01:08:40', '2025-05-02 01:08:40', NULL),
(152, 24, 'Criativo 2', NULL, 'https://scontent-bos5-1.xx.fbcdn.net/v/t42.1790-2/481761409_2687944501401516_8203902850657794706_n.mp4?_nc_cat=108&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=ejkCLdH6HbMQ7kNvwFLQHtq&_nc_oc=AdkOlLkLRjOgmjZDN97pLtheHl0JJgeENG4GfuFWKx3Q3uQo-yiMwAZh5MwxrdTNL7Q&_nc_zt=28&_nc_ht=scontent-bos5-1.xx&_nc_gid=mHJLq-4kW-EZ-twfnwAA9Q&oh=00_AfEkoKnPnlZz9AaJyHkydmqhdal7g88YL229FUJ4gKPL9A&oe=6819A7E5', '1209307700636348', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 15.00, NULL, '2025-05-02 01:09:00', '2025-05-02 01:09:00', NULL),
(153, 24, 'Criativo 3', NULL, 'https://scontent-bos5-1.xx.fbcdn.net/v/t42.1790-2/481105404_541718078338984_6511053666820370642_n.mp4?_nc_cat=107&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=X2lp4GCI37UQ7kNvwEJ0MhN&_nc_oc=AdkLfNSYZjh22lJEL6j1YuSZsfxw5ICiKvwMdMJc34EBK_rFDfPRxun5Iy8ATBEukz4&_nc_zt=28&_nc_ht=scontent-bos5-1.xx&_nc_gid=mHJLq-4kW-EZ-twfnwAA9Q&oh=00_AfHtLJDCGo935KytVOKWv_UBPxx2g2rnnQRjKieUZBT53A&oe=6819B579', '1190817342753905', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 10.00, NULL, '2025-05-02 01:09:30', '2025-05-02 01:09:30', NULL),
(154, 24, 'Criativo 4', NULL, 'https://scontent-bos5-1.xx.fbcdn.net/v/t42.1790-2/481927885_890117696446122_2220640306130536169_n.mp4?_nc_cat=103&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=OfA5H_3hUyMQ7kNvwHVWAYl&_nc_oc=AdlQV8SU6FlBP8gGH_AwcQbUMKjYJTzjwom_uU0GTn2OcDFJEVkz6zgMoJmsPQP2I_A&_nc_zt=28&_nc_ht=scontent-bos5-1.xx&_nc_gid=etIwWrIQG-dVOdwSw3KeGg&oh=00_AfFXRcwZLJ6cSPGHVtY5EC6OTh7-n0VNotPmJ3fSWF-Hug&oe=6819AD04', '1676818587039689', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 11.00, NULL, '2025-05-02 01:10:04', '2025-05-02 01:10:04', NULL),
(155, 24, 'Criativo 5', NULL, 'https://scontent-bos5-1.xx.fbcdn.net/v/t42.1790-2/481693231_2288846298176475_9051170447717873222_n.mp4?_nc_cat=104&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=KoQlNE5BjfkQ7kNvwHk57-N&_nc_oc=Adnx7gkVxaTRWzksy1OMV4cjU7Dfp8EgAAhY8lc68wNwSJ2s2O8IxCPdSoLO36lvSZ4&_nc_zt=28&_nc_ht=scontent-bos5-1.xx&_nc_gid=etIwWrIQG-dVOdwSw3KeGg&oh=00_AfFenELYmm1IHY6V8Dob4OhkH7EcQ5_mcWodgYXYS0SDOA&oe=6819A2C0', '647838831429929', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 8.00, NULL, '2025-05-02 01:10:32', '2025-05-02 01:10:32', NULL),
(156, 25, 'Criativo 1', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/494095047_1696799360958606_7771574132004960626_n.mp4?_nc_cat=106&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=-tLfukYa5n0Q7kNvwFuLB_3&_nc_oc=AdmQ0MhXNtwW52mXxCA132-nsfjgd_vxekShFS9D7C_74MHzb-nMMCxsIJlMmy-VNsc&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=bRz-CKtS029P4yRZgA46WA&oh=00_AfFEnfBqMwJmKJga8GVRPA_7pAvSZxYnyIKTh0mWY-BkbA&oe=6819CE8D', '585252970637147', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 0.00, NULL, '2025-05-02 01:24:14', '2025-05-02 01:24:14', NULL),
(157, 25, 'Criativo 2', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/494373720_540612762185220_5223917849390642618_n.mp4?_nc_cat=107&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=-6G841Vb6xUQ7kNvwEV1y-A&_nc_oc=AdmSoycQZ1qiv1tHd6MqCnRyFSD5lpvOcapXqLiVYA-x9RHxGrzJJyyd4UGSYNi6SD8&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=bRz-CKtS029P4yRZgA46WA&oh=00_AfHa80dy83fDf-ISLZ7_X3KW60lFYWkrzMAf1OvOpjh_pg&oe=6819AB8A', '643286575206117', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 0.00, NULL, '2025-05-02 01:24:36', '2025-05-02 01:24:36', NULL),
(158, 25, 'Criativo 3', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491489302_1400391574301928_4535566511017658206_n.mp4?_nc_cat=104&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=fZ3kHbreAWEQ7kNvwEjpHZi&_nc_oc=AdkTsHVB20HWJHNJ3qgadkGDNluYfLkMjnneynC4tleAkMVEfYEsKpmEMGiRI68GhLI&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=bRz-CKtS029P4yRZgA46WA&oh=00_AfHKwgN9KoiuWaguf3DHYgBff4aUwdKh-TnFsfEVSvsDdg&oe=6819BA6A', '651966987599614', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 15.00, NULL, '2025-05-02 01:25:07', '2025-05-02 01:25:07', NULL),
(159, 25, 'Criativo 4', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/494740642_1120279849862147_8816475397328405218_n.mp4?_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=l57z0NSuyaUQ7kNvwHmRhky&_nc_oc=AdnxzB7W7lfdBB833TxRiIYoySi6uxx2vMq-tpxRjbSLH0v5R6FFPqooxw-1y6Q_N8E&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=bRz-CKtS029P4yRZgA46WA&oh=00_AfH7EWGQb0N1RYAQ4h0urGxZ928FxcDSp2FbHiMteLmIMA&oe=6819C771', '656705940508147', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 17.00, NULL, '2025-05-02 01:25:32', '2025-05-02 01:25:32', NULL),
(160, 25, 'Criativo 5', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491481827_4089870381257874_2728600190247469306_n.mp4?_nc_cat=109&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=PxD4a8ZwT_wQ7kNvwFYqOPC&_nc_oc=AdnylrQmLln201L2eUfA8LhYuOonalWRDhMrpWtpmuRWii6gNWR2YeU2ga5-9iYbjdc&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=bRz-CKtS029P4yRZgA46WA&oh=00_AfGl22M2424hOivRSJAnXoP9DUsJh3V9wvIIBGSIHEbrJg&oe=6819CEF8', '673622715375709', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 0.00, NULL, '2025-05-02 01:25:55', '2025-05-02 01:25:55', NULL),
(161, 25, 'Criativo 6', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/495046057_9725393324223845_4859876429571146282_n.mp4?_nc_cat=110&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=wfBKtZzWHGUQ7kNvwE2y-zC&_nc_oc=Admob9rfWghUqJf9CcYeFf-IN9ZPdq2IAMlw0It6Pdhyd91gck6spQO_iulcenp-xlc&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=bRz-CKtS029P4yRZgA46WA&oh=00_AfFJZdLmf61LDB23yS9v8WC2p9zMgp6zg6SyK8RqYqDxTw&oe=6819C5A6', '696762796051518', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 21.00, NULL, '2025-05-02 01:26:27', '2025-05-02 01:26:27', NULL),
(162, 25, 'Criativo 7', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/494684806_1023550083056250_3401327904907501919_n.mp4?_nc_cat=107&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=GVfo8rr6L_4Q7kNvwH3nabO&_nc_oc=AdmUDX6qh1TN5fc4mN6np66sHOtRVF-4vlnN768iCErEDGvhELWbIHF-OZAl-56o8a8&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=bRz-CKtS029P4yRZgA46WA&oh=00_AfH2a1duI7__BH1YtPF4GB9KBt_CkmRKhoYzqENUkaqPXg&oe=6819DA0A', '710664671921189', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 1.00, NULL, '2025-05-02 01:26:58', '2025-05-02 01:26:58', NULL),
(163, 25, 'Criativo 8', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/494269985_688032533976271_5892411696543405184_n.mp4?_nc_cat=111&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=OgaIg9mNajUQ7kNvwGJWI15&_nc_oc=AdlEt6MrdQjsJTrvjp19vCvvwDTCp0aIBIc_7_kfBwQSu7j0AUd1u23u7NCBWIwj79o&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=bRz-CKtS029P4yRZgA46WA&oh=00_AfHFbvs9Q1UztfWG7hu-yKkcwfbBJEbcik2TwqnRfIHLUg&oe=6819D434', '701458285901646', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 1.00, NULL, '2025-05-02 01:27:20', '2025-05-02 01:27:20', NULL),
(164, 25, 'Criativo 9', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491512131_1258779149043356_5478511236680617828_n.mp4?_nc_cat=106&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=aj5jNxKdIcsQ7kNvwEVJpYF&_nc_oc=AdlMLi10kzKwv-C8K3Lo3HXoIlrUnWt6W0KrBIYobXms9BQlAJz-Jo5-ld6Ovmyzh1s&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=bRz-CKtS029P4yRZgA46WA&oh=00_AfEXY8ZITHjvhGQmXqMfhxgxDuhIeMInWzcLVtl57jpClg&oe=6819DF75', '710664671921189', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 1.00, NULL, '2025-05-02 01:27:41', '2025-05-02 01:27:41', NULL),
(165, 25, 'Criativo 10', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/494003749_1220570943188507_2017903530105304467_n.mp4?_nc_cat=104&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=S2xeWQOHa9IQ7kNvwHYPvhT&_nc_oc=AdlG9ra4ZQFCZMNCjJguv7VPF76aiXa0bn7H6r9zNlczlnQWYx6DUEM2VW9u9Bldpws&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=bRz-CKtS029P4yRZgA46WA&oh=00_AfGQu4D_HURgBPDukzJfgo8dbEkz-_NoXaTDnqaFfCTRYg&oe=6819B032', '866020372357251', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 1.00, NULL, '2025-05-02 01:28:02', '2025-05-02 01:28:02', NULL),
(166, 25, 'Criativo 11', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/493505797_657094450647864_8678526417675432337_n.mp4?_nc_cat=104&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=gB_gi5DkLNIQ7kNvwG0aX_h&_nc_oc=AdnBi41l8cky-0UFE6qFPqUQsRSSILVL48W_MgpBhJ_x9Ane_Fbt_MEbEwSeiTg7SxI&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=bRz-CKtS029P4yRZgA46WA&oh=00_AfFul7rQ2L0lt2c6xkyYajFPbX3E7z8fYMLThPTDdD408w&oe=6819CA8C', '900076348874752', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 1.00, NULL, '2025-05-02 01:28:25', '2025-05-02 01:28:25', NULL),
(167, 25, 'Criativo 12', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491491592_4145376155706362_621192708710543912_n.mp4?_nc_cat=100&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=wdGZFYmWZEoQ7kNvwEkA0eM&_nc_oc=AdlOhh5CUd71FMsus30LxUhLz4Sn2wp_wuuuAPuBQr9b79ZI3clFDCxu3rCIVxy7FmE&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=bRz-CKtS029P4yRZgA46WA&oh=00_AfHr3s92JjlQZx8VMHWabjk1tVuT0F_BJ0YHi1tJK2815A&oe=6819AC93', '900745385469493', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-05-02 01:29:04', '2025-05-02 01:29:04', NULL),
(168, 25, 'Criativo 13', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491481662_394645547077477_1558628813441818557_n.mp4?_nc_cat=109&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=La9BgmxZz-QQ7kNvwGJzVcQ&_nc_oc=AdkHdJlnZPyOIaAJkBBldb0YF3kpakWCjCUAuw0l-JqJktawtp4ODQEBOU_xjOd_BIw&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=bRz-CKtS029P4yRZgA46WA&oh=00_AfEKIq9nSM7gS_CmKg0Mw81pHU59qlRVR1YPsgBmTnyt7w&oe=6819CE56', '909190171262797', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-05-02 01:29:25', '2025-05-02 01:29:25', NULL),
(169, 25, 'Criativo 14', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/494133712_1186918916247672_8880674957630655386_n.mp4?_nc_cat=106&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=mz2Wq7H8JCEQ7kNvwEWNzf8&_nc_oc=Adnl7mVXqi_xaysnR4yxO_Po2Wzx0mPR-Ed_ErnREaU8F0PruUP-oi2BGLgVgbT-oG4&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=bRz-CKtS029P4yRZgA46WA&oh=00_AfHKy5zGo1YB5LMKAy1RIGLSSxNCfd9HmsTqgyM_Fr8S-A&oe=6819C0AF', '991472156499734', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 3.00, NULL, '2025-05-02 01:29:49', '2025-05-02 01:29:49', NULL),
(170, 25, 'Criativo 15', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/494615397_1015112530595837_5395046383874529971_n.mp4?_nc_cat=108&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=C2mKJG4dS9oQ7kNvwEkyfWS&_nc_oc=AdlEdepl9GmuWxtXJ-ad_bw41JTjY39k9V3Vo202qr7ErLtoMNJurtR_v_4bVY_nZrY&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=bRz-CKtS029P4yRZgA46WA&oh=00_AfFmyfpVefSVSUYKflkc_07OHDdRQdu8G5L3yzam36bRUg&oe=6819D2B0', '1010071171253501', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 4.00, NULL, '2025-05-02 01:30:12', '2025-05-02 01:30:12', NULL),
(171, 25, 'Criativo 16', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491469188_2151550925282613_3895474857646052740_n.mp4?_nc_cat=110&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=MJgJR9pgTnIQ7kNvwHvLJeu&_nc_oc=AdnLeCIiHlSj_ZJm8lWT5vNrkSxsWweoobs7j1wM4QvcJZ4KCN5Xbx97S3Y_md0d2Ow&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=bRz-CKtS029P4yRZgA46WA&oh=00_AfG7n8TGJC2U-tiFVOHGOKqcotIxO1deUXCpigT7ge7d9g&oe=6819C1EF', '1063694572293892', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-05-02 01:30:36', '2025-05-02 01:30:36', NULL),
(172, 25, 'Criativo 17', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491478248_1708647946424141_9110390564180700211_n.mp4?_nc_cat=106&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=rDsW606JvCYQ7kNvwF2QsK5&_nc_oc=AdkOnRIdum4UViZWtFzFsvZz6Cm_iZ0-y5V4Ukz-e5ayqUtR8oe3s2XiF--C3rowqbo&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=bRz-CKtS029P4yRZgA46WA&oh=00_AfHw9E9nSn4f1si9zSyCpF-FRVffkr1DvcwQfQNftr77HA&oe=6819D8EA', '1128623099020945', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-05-02 01:30:59', '2025-05-02 01:30:59', NULL),
(173, 25, 'Criativo 18', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/494882223_895134689386105_6109301634625611172_n.mp4?_nc_cat=102&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=CzhCg_DqnEMQ7kNvwE-RQr6&_nc_oc=AdnFQwWTOfNsfGOxUBpVQ74eW0ZbvV0dL_vFtEz4YBSiSbcJ6O9l3KFiVVOzH7yrYo0&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=bRz-CKtS029P4yRZgA46WA&oh=00_AfF7VKKgnUtAE7eFI_5iZ0qA-lk4G_7fkBJP5itcpUlTAw&oe=6819DBF0', '1216881926780426', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 0.00, NULL, '2025-05-02 01:31:21', '2025-05-02 01:31:21', NULL),
(174, 25, 'Criativo 19', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/494084285_476862485449581_8384822045092266518_n.mp4?_nc_cat=103&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=hck5hiuMllwQ7kNvwGh9RXl&_nc_oc=AdkoOBXoWaTuUFaNyKCqa7Jps5VGJvNod5_XCEhzG6ZhL0cBC8k1Abtumh26MApMkjs&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=bRz-CKtS029P4yRZgA46WA&oh=00_AfFpa5lAPcrirV28RKeHQ6GWx6iySvntKl2cT7tszk6hIA&oe=6819BE56', '1265252151938902', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-05-02 01:31:46', '2025-05-02 01:31:46', NULL),
(175, 25, 'Criativo 20', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491501673_1008228941439196_8470646016999069071_n.mp4?_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=5hX8_rsQtL8Q7kNvwExv5oA&_nc_oc=AdnTS7OSGwFwPRH__X9_uPLzaOpkWY4zwEyIv2diwsbhGwrLKI65IQfudF1z-qmewXU&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=bRz-CKtS029P4yRZgA46WA&oh=00_AfE3fFgCHaQvujgrTo-MZMF6BnwZ_quOQBixLg4xGMBZHA&oe=6819D007', '1352077229211658', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 1.00, NULL, '2025-05-02 01:32:11', '2025-05-02 01:32:11', NULL),
(176, 25, 'Criativo 21', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491474250_666626832629094_6411800232524336519_n.mp4?_nc_cat=110&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=5Tq2mpOY_bAQ7kNvwESH-FT&_nc_oc=AdnxWWpfKz_IqI9QNAk0hTWgRAg7_MAmY67i-l4XQv9aazRbMvunWTqS7uVqqLfSF4A&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=dBR67ObpLEk0HjfWcQ1kog&oh=00_AfHzN7QbhPp_8rmxM_yQvdvRrh98DvYIWfUzD9WJrEMNEw&oe=6819DACD', '669820729002356', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-05-02 01:32:45', '2025-05-02 01:32:45', NULL),
(177, 25, 'Criativo 22', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491280762_697980956095928_4690981866137543016_n.mp4?_nc_cat=111&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=msbb6Pjx3A0Q7kNvwGwg7g5&_nc_oc=Adltkl9gKHkTsRZvgUZUr5GMjk6n-dUOwWEujJKAmZmPBn5tgm3Sx8Y1NU5_3HqT6ec&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=dBR67ObpLEk0HjfWcQ1kog&oh=00_AfHcpKXVA5D2NiJf91H5Q7vyf4-Lu2rN5mexSbRdE53Z0w&oe=6819ACBE', '880241630907047', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 4.00, NULL, '2025-05-02 01:33:10', '2025-05-02 01:33:10', NULL),
(178, 26, 'Criativo 1', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491484332_1029828609104563_882903034049087951_n.mp4?_nc_cat=106&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=fBVKonVFIC4Q7kNvwFIXn2c&_nc_oc=Adl3FuG117BEPcazH1se8xJJHaoKufHnExhuZEsritZDd_oBZhHsbYUUSuI_g-gStEk&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=7yw81YQfh0uTos_A7JMfSw&oh=00_AfGubpnOn_NJWkNxMROKgN63jCvg3e7kxPMWJ1ByEOxCyw&oe=6819D305', '622877344048040', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 11.00, NULL, '2025-05-02 02:20:09', '2025-05-02 02:20:09', NULL),
(179, 26, 'Criativo 2', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/494088036_1184019816835348_2059166224135584546_n.mp4?_nc_cat=109&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=B3m6-Lw4Z-sQ7kNvwEwTygm&_nc_oc=Adl71w3bOl1OaffUHXgJgDuPM5kHQBevAZVbC1Alkr1VmvVWK8cdacoWwwj7Fv96_PM&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=7yw81YQfh0uTos_A7JMfSw&oh=00_AfFowtqYQa4GZR4bMD88H-_aCLzzUQgT0eQ5CHQxV2Y9TA&oe=6819E35C', '1065983922217573', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 3.00, NULL, '2025-05-02 02:20:38', '2025-05-02 02:20:38', NULL),
(180, 26, 'Criativo 3', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/493533654_566719302662220_4397467207009627554_n.mp4?_nc_cat=103&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=K8jsykQdauMQ7kNvwFSv90y&_nc_oc=AdkH_7wlTAAbrziXex2XAci5x8LjXkdZxOOJg0Q-YCGx55D_VBdNAU8QSCgDOTBIvkI&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=7yw81YQfh0uTos_A7JMfSw&oh=00_AfEq4Si1hgqp__tIdtVuXWc7dZCn_zszinIPwn6SAnz2lQ&oe=6819C27C', '546920351483753', '[\"Facebook\",\"Instagram\"]', NULL, 'FR', 'FR', NULL, NULL, 'ativo', NULL, 3.00, NULL, '2025-05-02 02:21:13', '2025-05-02 02:21:13', NULL),
(181, 26, 'Criativo 4', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491518891_1409355077044063_1818692429156940880_n.mp4?_nc_cat=108&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=bKPdCOLkq2kQ7kNvwFC5aoX&_nc_oc=AdmAAIOIq57VUewmc4xX6GD1Nq3Z6Z6JeMKnTzxK-OSKutqOKce7jkCi9nTprh8ByxQ&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=7yw81YQfh0uTos_A7JMfSw&oh=00_AfHbRld5XGH3mbHv0VcFpDgi-KKNXuQpPHS-zZbSTUH9jA&oe=6819D612', '588134857631896', '[\"Facebook\",\"Instagram\"]', NULL, 'FR', 'FR', NULL, NULL, 'ativo', NULL, 3.00, NULL, '2025-05-02 02:21:42', '2025-05-02 02:21:42', NULL),
(182, 26, 'Criativo 5', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491482922_1033012842094325_1612779097602677596_n.mp4?_nc_cat=100&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=YhLLFwsYSbwQ7kNvwEM25yB&_nc_oc=AdnDvyNNOJiNn23RFWd9rAvbNkbOHkARe6bjzbtB_Falj2oJuVCCO2fvoV4b-7t94Wg&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=7yw81YQfh0uTos_A7JMfSw&oh=00_AfEJo3PX6ZMSdVKrPXVrxurb5QMiMvqRwU5y5plfJAYMcQ&oe=6819C88C', '674524475519712', '[\"Facebook\",\"Instagram\"]', NULL, 'FR', 'FR', NULL, NULL, 'ativo', NULL, 3.00, NULL, '2025-05-02 02:22:15', '2025-05-02 02:22:15', NULL),
(183, 26, 'Criativo 6', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491509420_1212406303746273_5882206651326574954_n.mp4?_nc_cat=104&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=2d9M6eetlOcQ7kNvwGya5lM&_nc_oc=Adk-oTs2hONkAiM69QSESMvAlmzLmcUuLuto7RYYQiDMxewEIFCbbrTdy0ivQp9PhKY&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=7yw81YQfh0uTos_A7JMfSw&oh=00_AfGBp_1EQGDfOmA7RViLYAyQKZrEP3Q600Xb0sDpMPkF7g&oe=6819CDA2', '1066263845550903', '[\"Facebook\",\"Instagram\"]', NULL, 'FR', 'FR', NULL, NULL, 'ativo', NULL, 3.00, NULL, '2025-05-02 02:22:47', '2025-05-02 02:22:47', NULL),
(184, 26, 'Criativo 7', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/493835026_29373411895606455_5221237033321016402_n.mp4?_nc_cat=100&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=ViULGI9156AQ7kNvwGwFC0P&_nc_oc=Adn17p1F_Kw95LlmnDY7XLzZiJ0tEcXtJi-r3h2ESW67pyR5PW7OMaPAe1hod_pXnZg&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=7yw81YQfh0uTos_A7JMfSw&oh=00_AfFGoy0sOmRKbpvZXQCU7VObGkjaubTKOk1jj9trqmIj7Q&oe=6819CD36', '2420603048307968', '[\"Facebook\",\"Instagram\"]', NULL, 'FR', 'FR', NULL, NULL, 'ativo', NULL, 3.00, NULL, '2025-05-02 02:23:26', '2025-05-02 02:23:26', NULL),
(185, 26, 'Criativo 8', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491504492_1249377983413569_7413267901137430097_n.mp4?_nc_cat=104&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=6PbXS9o0XgUQ7kNvwHZX7eS&_nc_oc=AdnEuqgagLxifaISBRz9wq7v2uPYft_xtwUwdDRPXba8ovA1ZOzKfjYntWCa_VM5F0U&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=7yw81YQfh0uTos_A7JMfSw&oh=00_AfEmxogLHazk2uDPuI0u4sIuae0ZfRNg9CpZUnISWy53Xg&oe=6819D218', '4030785763873093', '[\"Facebook\",\"Instagram\"]', NULL, 'FR', 'FR', NULL, NULL, 'ativo', NULL, 3.00, NULL, '2025-05-02 02:23:51', '2025-05-02 02:23:51', NULL),
(186, 26, 'Criativo 9', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/494637451_1319965275758167_6505534232719149477_n.mp4?_nc_cat=106&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=fU6_aJZ1BIsQ7kNvwEmNts8&_nc_oc=AdmotEiQEGdnj89CY9IUSboeX2SdwG0YN88Y_uoFSP8zvfbLatHwB5hrRE5EyM1rYmk&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=7yw81YQfh0uTos_A7JMfSw&oh=00_AfF_f33W2oLYOpaX1Wv4SflHz8wUHvujvEE5TWG4r3oAig&oe=6819E84B', '1178224116943714', '[\"Facebook\",\"Instagram\"]', NULL, 'FR', 'FR', NULL, NULL, 'ativo', NULL, 3.00, NULL, '2025-05-02 02:24:19', '2025-05-02 02:24:19', NULL),
(187, 26, 'Criativo 10', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/494098302_1032336478835008_3114063789739085688_n.mp4?_nc_cat=100&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=wWSHZKvaYiIQ7kNvwGzjd3p&_nc_oc=AdnmQ_NCJwmOYTeZB2YkgyxAz2xGeMsn_dK7SC9vJeL_7q5tdPXys5QiSPwAL_jcMAI&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=7yw81YQfh0uTos_A7JMfSw&oh=00_AfHIwNXTcjgZCXbVCLFJHhT0a5jntlISYTFjfxy9SSgLug&oe=6819E321', '1192604142659749', '[\"Facebook\",\"Instagram\"]', NULL, 'FR', 'FR', NULL, NULL, 'ativo', NULL, 3.00, NULL, '2025-05-02 02:24:44', '2025-05-02 02:24:44', NULL);
INSERT INTO `criativos` (`id`, `anuncio_id`, `titulo`, `tag`, `url`, `creativeId`, `platform`, `platform_backup`, `language`, `idioma`, `image`, `caption`, `status`, `performance_status`, `value`, `deleted_at`, `created_at`, `updated_at`, `last_status_change`) VALUES
(188, 27, 'Criativo 1', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/489630737_1348891396389115_7827449861131929601_n.mp4?_nc_cat=105&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=2QP5NMaco4AQ7kNvwGTrHCN&_nc_oc=AdniAxhPPu7M97LlP2_mNUG4Gu_T9O8dh0xfmw606bTx2k28BdpTtIppftqXOo9RBwE&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=qNvpSnTrD3AP9Rgrpi7_XA&oh=00_AfE0F3t0XcdhKra6-JEdloIc9PeanPiEtSRwm4gW7PBKFw&oe=681AFD14', '677632661318560', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 12.00, NULL, '2025-05-03 00:08:29', '2025-05-03 00:08:29', NULL),
(189, 27, 'Criativo 2', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/484443740_629074206586895_8084931190178337135_n.mp4?_nc_cat=105&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=87FqjgnspA4Q7kNvwGX6Dva&_nc_oc=AdmjJQ_XoyiHdbeFFQr5lPXsG1A7l9wY2-mqih5XGfH2mIr7-mfKEqzKVAhHhOCQ4f0&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=qNvpSnTrD3AP9Rgrpi7_XA&oh=00_AfHzvdv2ZBktqD00vxNyYlrvqpvi2Z56dX5NnpvGk17x4Q&oe=681AFBD0', '636665239163070', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 6.00, NULL, '2025-05-03 00:08:52', '2025-05-03 00:08:52', NULL),
(190, 27, 'Criativo 3', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/483521209_1640846903974354_7789664847400480968_n.mp4?_nc_cat=100&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=1zfNKcy8Cd4Q7kNvwG2XPn_&_nc_oc=Admb2v1lP1UcM_cUBfHjulT0Z1VZwjGJg7FoipXLZbmQvq75OH_yJUsa0wSa26OJhX4&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=qNvpSnTrD3AP9Rgrpi7_XA&oh=00_AfG7f3kIoXTLt_1b4hUj5x_ofzsNpyZzSU_gBIaZ8UdLyQ&oe=681AFFE4', '995773678860950', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 21.00, NULL, '2025-05-03 00:09:15', '2025-05-03 00:09:15', NULL),
(191, 27, 'Criativo 4', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/483421461_1725066474890842_8668679015631207734_n.mp4?_nc_cat=107&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=FblQGwKy3jYQ7kNvwGvaEbz&_nc_oc=AdmU3dPRlG9VPjSW7BLUnyLHzBY8NySJPbPHKJNgM7i28mW-xffvi77gPlxeMUjdeO0&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=qNvpSnTrD3AP9Rgrpi7_XA&oh=00_AfGq45ifiOMUH8709XykI7aItZhu0yMCYQt5Cbsz6yGLYg&oe=681B0F20', '1134852598657837', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 15.00, NULL, '2025-05-03 00:09:40', '2025-05-03 00:09:40', NULL),
(192, 28, 'Criativo 1', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/491467704_1618467278687383_3613654007611226312_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=102&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=mK9q1jVMw6QQ7kNvwHrkZZx&_nc_oc=AdmuCaEsZNwLkCZPSg-jznRlGnVDvw8SCOpPN8z7fuV5XKtf0gplRhzdey_bDhzNTWw&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=5r2qOWtZKbanNCoTse6Y4A&oh=00_AfFThwmkDcPFFbBPk1fsO6B1tx79ONMkJVwQpqwDJIb6uw&oe=681B1072', '540536382435387', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 3.00, NULL, '2025-05-03 00:18:19', '2025-05-03 00:18:19', NULL),
(193, 28, 'Criativo 2', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/491998956_1028425172508595_588953643823212180_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=1T3WYSbVzZEQ7kNvwGHMymR&_nc_oc=AdmNaq_MAqcBdhktaYXgOhnrMF14yMcSi-S4RpZYtAAyUK6GC2TOqJ8XqhH4nBL1hYs&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=5r2qOWtZKbanNCoTse6Y4A&oh=00_AfFvAsw2Vs6qITxgK4iEZQo8ZUSF2OkqW4oFfv4gpqkz1A&oe=681B017F', '661220143423017', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 3.00, NULL, '2025-05-03 00:18:38', '2025-05-03 00:18:38', NULL),
(194, 28, 'Criativo 3', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/491049552_1186059965988635_8004720455295948203_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=103&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=64tjM_5rVmQQ7kNvwH4qA8Y&_nc_oc=AdlFSujAa_fnqYCa1yjJUQKXq_cIn6BXzyeZzdoZp05Vs1PLzSlP-7tB8vS_GKISg50&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=5r2qOWtZKbanNCoTse6Y4A&oh=00_AfHyLJN84E8NJIYXRWvBRXS0VvtHciJiuO1m_Z7B6mPx6w&oe=681AF545', '681181697974471', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 3.00, NULL, '2025-05-03 00:18:55', '2025-05-03 00:18:55', NULL),
(195, 28, 'Criativo 4', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/491573831_560691033742566_8179097921472027887_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=111&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=MVPHMqaLhA0Q7kNvwFQqQEP&_nc_oc=Adli8emtc3mKqDu8zD_RFMeJCYa1LSJU0mxUfHUlkJQ4yr1hYM-ViQh7NlVzmhJ2984&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=5r2qOWtZKbanNCoTse6Y4A&oh=00_AfFggMyJaM9fih3ZjfuwjDfp8rhnEDErowjpPC7upjUuew&oe=681B2225', '714200734616849', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 3.00, NULL, '2025-05-03 00:19:16', '2025-05-03 00:19:16', NULL),
(196, 28, 'Criativo 5', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/491998985_1494600754585341_1855511684448753532_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=100&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=zcABREfvF3UQ7kNvwF-SBeW&_nc_oc=AdkWFDDdvBMo96jnyO5NFRCYak9mU5V3PD1vShDrjovFO8Qi_5Dvhuuj3NT0sTPwoyI&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=5r2qOWtZKbanNCoTse6Y4A&oh=00_AfEfYGq_Vl49phfgeF_hxSufouI01v7maA_IiMBG6F0y4A&oe=681B0504', '1167231455166271', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 0.00, NULL, '2025-05-03 00:19:40', '2025-05-03 00:19:40', NULL),
(197, 28, 'Criativo 6', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/491924931_1319557336012594_1220991642875448889_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=104&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=DoeMvtoT8fgQ7kNvwHfhZHW&_nc_oc=AdmErGghnnFZOmeqLI80mJLbpU1RXgjqXXLoEsbblu4CrkbjY9cOYBdzNanUskrkb5Y&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=5r2qOWtZKbanNCoTse6Y4A&oh=00_AfGh_I8GdjqrJCk1G3fkWCpqUzPiaLzQX565auOolTl9dg&oe=681AF9D5', '1341972286913628', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 3.00, NULL, '2025-05-03 00:19:59', '2025-05-03 00:19:59', NULL),
(198, 28, 'Criativo 7', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/483853254_987430379638556_8522018699466911911_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=Bnax_Jg2eXkQ7kNvwEFf3-B&_nc_oc=Admo__r0Nym9cRc9L8KVZPaosfVCjgkTjzAOw3TK0bS15zw17iTgwnjvR76RW-Du6Bg&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=5r2qOWtZKbanNCoTse6Y4A&oh=00_AfF7WK-1y08yuwykRwykXoYqtDCX-k2boJNAwtzIpmFVKg&oe=681B0613', '565688409891946', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 5.00, NULL, '2025-05-03 00:20:24', '2025-05-03 00:20:24', NULL),
(199, 28, 'Criativo 8', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/483985898_1281821626248572_1331235245009997923_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=107&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=Vao0QFqt5f8Q7kNvwHg1A98&_nc_oc=AdlaNBDCJ3YT10Li3w3aJgtqb0jp70T3LHPIGWG1hPnepBGVfD33kvHA629xZlqhd3Y&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=5r2qOWtZKbanNCoTse6Y4A&oh=00_AfFLd2oGR04Ce4MNbDFEpMC72MOAq7sriHs-9Cq_efT5qg&oe=681B22B1', '642669344898026', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 23.00, NULL, '2025-05-03 00:20:41', '2025-05-03 00:20:41', NULL),
(200, 28, 'Criativo 9', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/484061662_545129341929473_2917057007110208520_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=100&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=jc6n9EQUEycQ7kNvwHv1sW1&_nc_oc=Adncoa67Uh1q3A_P0mUIb-j1ykRwfAW4w9VE58tRGdDEkHUXGCzLZOojflklloBu5lc&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=5r2qOWtZKbanNCoTse6Y4A&oh=00_AfH5t9ivkLCb1dQt5iHwhgfPJTVts_WLJg3eqXU0L-Vw9g&oe=681AF579', '655142057306766', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 23.00, NULL, '2025-05-03 00:21:00', '2025-05-03 00:21:00', NULL),
(201, 28, 'Criativo 10', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/483893103_1062786395869884_5845158769610190147_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=100&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=s4R4BkzOCI4Q7kNvwH2yrpP&_nc_oc=AdmtD9sBzH5Qxdvu5MlFeaVDf9pC24JvF4ZiUwqzmJMKyYqpBEDIsYpo78jycEeJ2qQ&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=5r2qOWtZKbanNCoTse6Y4A&oh=00_AfEHhysQKSsBN8sgEEoA_O-LFyUbIJgFHwo0XtkcEjTQnw&oe=681B0A22', '684049351448844', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 18.00, NULL, '2025-05-03 00:21:20', '2025-05-03 00:21:20', NULL),
(202, 28, 'Criativo 11', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/484094944_1775689979658339_6915265574061317193_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=110&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=el2-40mBcpYQ7kNvwEPb8OF&_nc_oc=AdkCOEUfD9sQB77otM_3ewyaWXgbPYjJLO2CR0xQekcUKmX2BIrprw89G1iMXCTMXFc&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=F78pBoc2bCxdzGjKTGiaNA&oh=00_AfFXRg_agGRjCDWIQFqJZAFoSiQfOzVF1HHtRLJ7GY0ToQ&oe=681AF67F', '770532458720582', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 23.00, NULL, '2025-05-03 00:21:44', '2025-05-03 00:21:44', NULL),
(203, 28, 'Criativo 12', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/484632680_649437197831388_8099720474418251994_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=102&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=b5Dimb9SzkoQ7kNvwFczbAC&_nc_oc=AdljfOsnwICLvY-_INcsgOuIvOSqRkf6EHHWwmusgLjVk0ot9ns1sRsluprAsT-lqjY&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=F78pBoc2bCxdzGjKTGiaNA&oh=00_AfEGfdJ4KNcKtlcNAXwQ9E3EpIC4hrKLSj1Ajbt0zUj8fg&oe=681AF2B3', '1030283081882572', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 15.00, NULL, '2025-05-03 00:22:21', '2025-05-03 00:22:21', NULL),
(204, 28, 'Criativo 13', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/484124475_626769419976136_1152984474368924994_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=nRByBcc5XEQQ7kNvwHV6rhb&_nc_oc=AdkQrWuo9ZV878omkOBNjigwVD5XuAznjX1GMoNv0Ii7b92WgA_GGpvhD702DB3lGMU&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=F78pBoc2bCxdzGjKTGiaNA&oh=00_AfG--APYA8o9qdq2iGntCBpddzDt5T2Kw5VDsSG8EmzJTw&oe=681AF6A9', '1045528544105031', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 39.00, NULL, '2025-05-03 00:22:38', '2025-05-03 00:22:38', NULL),
(205, 28, 'Criativo 14', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/491049552_1186059965988635_8004720455295948203_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=103&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=64tjM_5rVmQQ7kNvwH4qA8Y&_nc_oc=AdlFSujAa_fnqYCa1yjJUQKXq_cIn6BXzyeZzdoZp05Vs1PLzSlP-7tB8vS_GKISg50&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=F78pBoc2bCxdzGjKTGiaNA&oh=00_AfH_n1FsKPtwNPepY1KoZc2aOniU5u4XG_BB7mh2mphA1A&oe=681AF545', '696163442790024', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 11.00, NULL, '2025-05-03 00:22:56', '2025-05-03 00:22:56', NULL),
(206, 28, 'Criativo 15', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/484794115_554672356995116_8629927336139904063_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=100&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=MpTZaayl_4MQ7kNvwHfCi4X&_nc_oc=AdkjFyncKqzL5iBzET5CIVq7tj8zkorl0zin55YlVQq7vnviuZny3xLOEbe8b9oE_mw&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=7z4J3SFNSmx-DyWVMS9ZoA&oh=00_AfHtN8KSrE2oat-JAPSZL5vFx-kK1AAUm1UFINy5rzWZVw&oe=681B1F8E', '1464855614880971', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 6.00, NULL, '2025-05-03 00:23:18', '2025-05-03 00:23:18', NULL),
(207, 28, 'Criativo 16', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/483928355_1164065338431313_4155609410721833461_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=VyH72mJRKB8Q7kNvwEpc_zd&_nc_oc=AdkiMEzQVe75_vtdCUXA0ZQxQxXgHW10Aohy6-ftxGiXI34lbKSKu8OCwv9dryeOGQM&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=7z4J3SFNSmx-DyWVMS9ZoA&oh=00_AfF_D2-x4f6kPTqYJwmY2ADTaksDMf3-GUFjEy1napHz1A&oe=681AF1B3', '596880886679412', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-05-03 00:24:04', '2025-05-03 00:24:04', NULL),
(208, 29, 'Criativo 1', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491503907_2632151123645757_5755382366661689849_n.mp4?_nc_cat=108&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=KuTQCH7WmHAQ7kNvwHu2CSJ&_nc_oc=Adky739GwtA9AW3QRJiFKUYh0zeBsEknYMsmJ8XZL1iaQT2dirMGfMReGuDjfkgYtoQ&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=gVu2ofjEub-pLhQQ_utW0Q&oh=00_AfGfpmOTVSK336m_jlVhW2kNLEpJhc-5Z6Ce4EROXCZbWQ&oe=681B164F', '1026164408957116', '[\"Facebook\",\"Instagram\"]', NULL, 'EN-US', 'EN-US', NULL, NULL, 'ativo', NULL, 26.00, NULL, '2025-05-03 00:42:18', '2025-05-03 00:42:18', NULL),
(209, 29, 'Criativo 2', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491512675_732902005728534_8251550366819534617_n.mp4?_nc_cat=104&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=o1mkBj-uYsgQ7kNvwE-Z9Jf&_nc_oc=AdlSpcs5fHzF2wToBDjZX3hbqAm22jeDVv7hAC3CuKj27Wv3JSghGBb62AlMhqWoUqQ&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=gVu2ofjEub-pLhQQ_utW0Q&oh=00_AfE_0XQO_u_wL42t-M-tOniEnzyoNWkJQ2HVtWqI0E64Kg&oe=681B0D91', '712206577919962', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 1.00, NULL, '2025-05-03 00:42:53', '2025-05-03 00:42:53', NULL),
(210, 29, 'Criativo 3', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/494619542_1198565191754461_6267053370837527707_n.mp4?_nc_cat=109&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=VMKFZnpTuCAQ7kNvwF3QsJK&_nc_oc=AdkHbC3a2KySsDr9kYCFU4_16SQA8jn1KfgPWMUcfvgOgIqAxcuz2um9U1Hw6DLJIK4&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=gVu2ofjEub-pLhQQ_utW0Q&oh=00_AfFm7Zdd7kpQ9oMbXOgW0amuoiOCi5GjUZURVxmuCFPCzw&oe=681B0D1E', '1619807821870601', '[\"Facebook\",\"Instagram\"]', NULL, 'EN-US', 'EN-US', NULL, NULL, 'ativo', NULL, 1.00, NULL, '2025-05-03 00:43:17', '2025-05-03 00:43:17', NULL),
(211, 29, 'Criativo 4', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491508709_1322602955490957_8453488402415147967_n.mp4?_nc_cat=111&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=eEr5k2Xh3hEQ7kNvwHcc_wW&_nc_oc=AdmgAhUyMK_ERS9fcYC_iyy5h9_l_i2gsdNi6MEbwbj-04Q4m4FrVEJnvw9caoLAVSM&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=gVu2ofjEub-pLhQQ_utW0Q&oh=00_AfGQcF3-F1rfMVWU1v0gs56_sMZeKsS-yhzkwdGAPDuUXw&oe=681B2283', '475679448900030', '[\"Facebook\",\"Instagram\"]', NULL, 'EN-US', 'EN-US', NULL, NULL, 'ativo', NULL, 1.00, NULL, '2025-05-03 00:43:43', '2025-05-03 00:43:43', NULL),
(212, 29, 'Criativo 5', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491474669_4034083550191568_29966906024364023_n.mp4?_nc_cat=106&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=nUcCDd_YwngQ7kNvwEgcymL&_nc_oc=Adkfl1DMxYfto1N5OHcotzY21MDJVLNXg61tTRBQ8cc7rYwF_2DyXkGJ18EpQUbug8w&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=gVu2ofjEub-pLhQQ_utW0Q&oh=00_AfHYRo1Ta2ffcGzmAuhHHq2dpnoA2_cfK65XhOjz0WFZng&oe=681B264C', '2079419569222664', '[\"Facebook\",\"Instagram\"]', NULL, 'EN-US', 'EN-US', NULL, NULL, 'ativo', NULL, 8.00, NULL, '2025-05-03 00:44:20', '2025-05-03 00:44:20', NULL),
(213, 29, 'Criativo 6', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/490020057_1177593216877742_9218554601613212355_n.mp4?_nc_cat=104&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=tc1hjWKzZd8Q7kNvwHz-luH&_nc_oc=AdktG1wooWT9uODB5XkREVNu0RLyi4iUd1rYcC4yNXbxtLEZ7SJNQf-wRQXA8Bx0-x0&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=0N_pZzawybdjxmITE4ac7w&oh=00_AfE1M1mhUATClgcn1971yOV-w_wMGLfsxrOQB5z5-5I6_g&oe=681B05FF', '604066375990654', '[\"Facebook\",\"Instagram\"]', NULL, 'EN-US', 'EN-US', NULL, NULL, 'ativo', NULL, 15.00, NULL, '2025-05-03 00:44:45', '2025-05-03 00:44:45', NULL),
(214, 29, 'Criativo 7', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/486064370_1912813922814562_3088883831719663914_n.mp4?_nc_cat=110&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=vcX7E2qos0cQ7kNvwG06E7K&_nc_oc=AdmFDR2fcDTfezEvg7gn2crrHZsC7AKFTpU4_IVoVlclSMkL2JYoHTWwsi28cAS03SI&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=0N_pZzawybdjxmITE4ac7w&oh=00_AfEZkeLEiKRIJGT6V11o9yAq6vbtT8ANp3YYZDywiwt4kg&oe=681B1B4B', '2114805568946850', '[\"Facebook\",\"Instagram\"]', NULL, 'EN-US', 'EN-US', NULL, NULL, 'ativo', NULL, 18.00, NULL, '2025-05-03 00:45:05', '2025-05-03 00:45:05', NULL),
(215, 29, 'Criativo 8', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/491917505_1398769444471777_1698863843822048913_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=106&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=4HOj9FnyfEsQ7kNvwFTowRr&_nc_oc=AdkzXjs8JTLUJaAFZxez_8Hpb-5koTgRatBI-wfX7QmUXAz5N1nJVLGfWRxuRddEwCQ&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=0N_pZzawybdjxmITE4ac7w&oh=00_AfGrZAMexMZp_1pHHsnHgXIHMI0_aVfI9OBeKgScHde6_w&oe=681AF52D', '1385885055875756', '[\"Facebook\",\"Instagram\"]', NULL, 'EN-US', 'EN-US', NULL, NULL, 'ativo', NULL, 3.00, NULL, '2025-05-03 00:45:24', '2025-05-03 00:45:24', NULL),
(216, 29, 'Criativo 9', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/492323564_1437769500719274_5140583088509122283_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=111&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=-Pw4kD7yDugQ7kNvwGpEBiL&_nc_oc=Adkve83cpVIhGO825GQIeI-kVgQ0x5ClcTvlNACreCEVKpGz7Szxo8NgcuwTjVUDczk&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=0N_pZzawybdjxmITE4ac7w&oh=00_AfFFW7Xi23sSnf61kmLkd-Ow9e5xrOI-73EsM_xvpoZA-g&oe=681AF4E6', '558182210640500', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 18.00, NULL, '2025-05-03 00:45:47', '2025-05-03 00:45:47', NULL),
(217, 29, 'Criativo 10', NULL, 'https://video.xx.fbcdn.net/v/t42.1790-2/473533147_1573694890689133_723154153900025751_n.mp4?_nc_cat=108&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=o1lURYeBXkYQ7kNvwG-pCY5&_nc_oc=AdnhSz0Zpe38X-_kXkfSIoOPAxGHiZfph7nq6UpnmU9VkcHAcsMpJLw1_khgoYMaIYA&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=LpMHocdm8lXT6r_XzvToyA&oh=00_AfF-xcWTkzN6Aua0AjIq0V1wrEKdysIERwzq6QNjaRPyNQ&oe=681B2089', '1817961295644428', '[\"Facebook\",\"Instagram\"]', NULL, 'EN-US', 'EN-US', NULL, NULL, 'ativo', NULL, 6.00, NULL, '2025-05-03 00:46:18', '2025-05-03 00:46:18', NULL),
(218, 30, 'Criativo 1', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/494566425_1763188931249429_8924731956409304521_n.mp4?_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=d2E8vLh-Ds0Q7kNvwHI8pel&_nc_oc=AdmtaSy3gwf87crtn2LN-f7cJDwU-Tb1-kQxQBpdWkrIKfv0juQu35ztnDiWspJxbZM&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=bf7ZVV5jiX88-VQ0jbwO0w&oh=00_AfGUSaNixeRNW8dyUuWH5BR_znWu4D2mYJsmwACAZ2ermw&oe=681B0CC9', '517281404656409', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 5.00, NULL, '2025-05-03 01:02:35', '2025-05-03 01:02:35', NULL),
(219, 30, 'Criativo 2', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/494566425_1763188931249429_8924731956409304521_n.mp4?_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=d2E8vLh-Ds0Q7kNvwHI8pel&_nc_oc=AdmtaSy3gwf87crtn2LN-f7cJDwU-Tb1-kQxQBpdWkrIKfv0juQu35ztnDiWspJxbZM&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=bf7ZVV5jiX88-VQ0jbwO0w&oh=00_AfGUSaNixeRNW8dyUuWH5BR_znWu4D2mYJsmwACAZ2ermw&oe=681B0CC9', '519464927910108', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 3.00, NULL, '2025-05-03 01:02:56', '2025-05-03 01:02:56', NULL),
(220, 30, 'Criativo 3', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/494566425_1763188931249429_8924731956409304521_n.mp4?_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=d2E8vLh-Ds0Q7kNvwHI8pel&_nc_oc=AdmtaSy3gwf87crtn2LN-f7cJDwU-Tb1-kQxQBpdWkrIKfv0juQu35ztnDiWspJxbZM&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=bf7ZVV5jiX88-VQ0jbwO0w&oh=00_AfGUSaNixeRNW8dyUuWH5BR_znWu4D2mYJsmwACAZ2ermw&oe=681B0CC9', '534874546345501', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 1.00, NULL, '2025-05-03 01:03:17', '2025-05-03 01:03:17', NULL),
(221, 30, 'Criativo 4', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/493796021_691074700002278_6924686008753193115_n.mp4?_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=cokjrC7hrXgQ7kNvwHADioI&_nc_oc=Adm4qW0ecTzPE8KH5mUsE_N36-UB--hZQhc0DHYjj09QE9QJhnQ8Z0vVbJR7LaZyD50&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=bf7ZVV5jiX88-VQ0jbwO0w&oh=00_AfGa0olhXQcyb0-bCevkd2YeoJ9Pc0ysoKJUD6j-G0XApg&oe=681B076C', '539643545862433', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 36.00, NULL, '2025-05-03 01:03:37', '2025-05-03 01:03:37', NULL),
(222, 30, 'Criativo 5', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/493796021_691074700002278_6924686008753193115_n.mp4?_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=cokjrC7hrXgQ7kNvwHADioI&_nc_oc=Adm4qW0ecTzPE8KH5mUsE_N36-UB--hZQhc0DHYjj09QE9QJhnQ8Z0vVbJR7LaZyD50&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=bf7ZVV5jiX88-VQ0jbwO0w&oh=00_AfGa0olhXQcyb0-bCevkd2YeoJ9Pc0ysoKJUD6j-G0XApg&oe=681B076C', '551989124274034', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 8.00, NULL, '2025-05-03 01:03:56', '2025-05-03 01:03:56', NULL),
(223, 30, 'Criativo 6', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/493796021_691074700002278_6924686008753193115_n.mp4?_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=cokjrC7hrXgQ7kNvwHADioI&_nc_oc=Adm4qW0ecTzPE8KH5mUsE_N36-UB--hZQhc0DHYjj09QE9QJhnQ8Z0vVbJR7LaZyD50&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=bf7ZVV5jiX88-VQ0jbwO0w&oh=00_AfGa0olhXQcyb0-bCevkd2YeoJ9Pc0ysoKJUD6j-G0XApg&oe=681B076C', '573810739088770', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 54.00, NULL, '2025-05-03 01:04:17', '2025-05-03 01:04:17', NULL),
(224, 30, 'Criativo 7', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/493796021_691074700002278_6924686008753193115_n.mp4?_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=cokjrC7hrXgQ7kNvwHADioI&_nc_oc=Adm4qW0ecTzPE8KH5mUsE_N36-UB--hZQhc0DHYjj09QE9QJhnQ8Z0vVbJR7LaZyD50&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=bf7ZVV5jiX88-VQ0jbwO0w&oh=00_AfGa0olhXQcyb0-bCevkd2YeoJ9Pc0ysoKJUD6j-G0XApg&oe=681B076C', '608242062379232', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 1.00, NULL, '2025-05-03 01:04:40', '2025-05-03 01:04:40', NULL),
(225, 30, 'Criativo 8', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/494566425_1763188931249429_8924731956409304521_n.mp4?_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=d2E8vLh-Ds0Q7kNvwHI8pel&_nc_oc=AdmtaSy3gwf87crtn2LN-f7cJDwU-Tb1-kQxQBpdWkrIKfv0juQu35ztnDiWspJxbZM&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=bf7ZVV5jiX88-VQ0jbwO0w&oh=00_AfGUSaNixeRNW8dyUuWH5BR_znWu4D2mYJsmwACAZ2ermw&oe=681B0CC9', '655635484132518', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 1.00, NULL, '2025-05-03 01:05:01', '2025-05-03 01:05:01', NULL),
(226, 30, 'Criativo 9', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491932683_668651739134479_6617902251685793990_n.mp4?_nc_cat=106&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=ay7mZeNJZIwQ7kNvwEdG1lU&_nc_oc=AdkW6rYzUbybVq4ZQuQa57CNr_CULztpsykEuHX_m7eMccP9WUQpQcNJm7GWMYawW2s&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=TvWKVctp8d_P3kg227ty2Q&oh=00_AfGwkUYaX1ChfKM2rRz1lhbIpQohfbV97EOZcxf8I8y9hQ&oe=681B15E7', '1796666504232750', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 6.00, NULL, '2025-05-03 01:05:27', '2025-05-03 01:05:27', NULL),
(227, 30, 'Criativo 10', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/490623833_894617529409325_6309102305830915421_n.mp4?_nc_cat=111&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=T7_4DvrKX4kQ7kNvwEd38G4&_nc_oc=AdkCS3pYjpoLOytaD-SHGeGA36V3rfGcJbhxjN6kIf-b45dH7Lrv2UsFYt92dBrXa7c&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=TvWKVctp8d_P3kg227ty2Q&oh=00_AfF8A1aB1s1b764g19dNpqyORmjgFhUjFXsC51TIT8msMA&oe=681B0BF5', '1100512775220159', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 8.00, NULL, '2025-05-03 01:05:50', '2025-05-03 01:05:50', NULL),
(228, 31, 'Criativo 1', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/488658678_1702128330668343_5388099031462497311_n.mp4?_nc_cat=108&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=eN_vP-BuQkIQ7kNvwHOWiNG&_nc_oc=Adm6_8k6S1rmXkkJDgcFmJJpaAjIys5yNvpVuvTTPB8hDj8wOmEh5BNjDr5tNWpTaz4&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=yqdykxCWtZTM5qN5bu8YlA&oh=00_AfGbVumioSHjNehGF0YC-2qJ0X_fGA0nd349JhbOFZP-rg&oe=681B004C', '1691346284828776', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 62.00, NULL, '2025-05-03 01:26:10', '2025-05-03 01:26:10', NULL),
(229, 31, 'Criativo 2', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/488163447_1023529166321016_9186420675479061023_n.mp4?_nc_cat=107&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=uZfUq6nTohMQ7kNvwF1o6JK&_nc_oc=AdlNhGUTmJhRiVL3TYMGf1q_qYItSweyvbdJ7wntWPp5IkG_F_-JJbR8pQIxMKjIoFg&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=yqdykxCWtZTM5qN5bu8YlA&oh=00_AfGbiNuhZO1C2cQvTDATdzQgppBx5Pkc_MrHzdxFBWIyzQ&oe=681B01ED', '705455505386458', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 18.00, NULL, '2025-05-03 01:26:30', '2025-05-03 01:26:30', NULL),
(230, 31, 'Criativo 3', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/488869988_566871199761299_6649678658812760918_n.mp4?_nc_cat=110&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=CPY5hr_2UpYQ7kNvwF0iC-d&_nc_oc=AdndoehF3t7dykQsbZja_wDhw0lcoi8pVU_ZYBB4SvjqDThEo0mNrihssDQRRozZrSo&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=yqdykxCWtZTM5qN5bu8YlA&oh=00_AfGLbUPMh6hwvJuEjQwokXtRwAEOsiEUaQ49JDanVoZifg&oe=681B24C9', '1366844504593406', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 22.00, NULL, '2025-05-03 01:26:50', '2025-05-03 01:26:50', NULL),
(231, 31, 'Criativo 4', NULL, 'https://video.xx.fbcdn.net/v/t42.1790-2/491502212_1034454314809648_6253685321919893355_n.mp4?_nc_cat=100&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=T6YavtOKlbsQ7kNvwFI7t9_&_nc_oc=AdlKPSLTWlagf64UDaGH2wRAXt7_H_Z6WjUHVcRJ2QrCT6Clg-sAJv9qtm7-sONLmQw&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=yqdykxCWtZTM5qN5bu8YlA&oh=00_AfHDjUaYy6e2XynHx5kpNYFDdmxKn5sY3FjXq0XBZ7WuPw&oe=681B0A0F', '1097918335476578', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 4.00, NULL, '2025-05-03 01:27:12', '2025-05-03 01:27:12', NULL),
(232, 31, 'Criativo 5', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491476122_635552499453429_211472590560307474_n.mp4?_nc_cat=107&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=N7kMyvapCowQ7kNvwGfO8l5&_nc_oc=Adlq3ChLlTJKm43AqRDiYbJOHidq2rXVWjLOE1pEIu3DGHV4GRj_ZMhCVPip0YY5W60&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=yqdykxCWtZTM5qN5bu8YlA&oh=00_AfFJZwQApzMHx7zXKI8yKf02N0q84d2FFxclcdnj4cA4Bg&oe=681B1FAA', '1403457463999853', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 4.00, NULL, '2025-05-03 01:27:33', '2025-05-03 01:27:33', NULL),
(233, 31, 'Criativo 6', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491526025_1234737311429835_8866033130635388822_n.mp4?_nc_cat=103&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=5baxFDGA_P4Q7kNvwG6Ubuc&_nc_oc=Adlqv1MQnhdIXp9DtWgtrESJ5TRKiDU5kM62TsOHXaFlnojMLYGa8jEUpu0io9deFoE&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=yqdykxCWtZTM5qN5bu8YlA&oh=00_AfElX7Ngf_bsPvVI0c_I2qGPVYJGmpRqRSVk6SN_bjDmYg&oe=681B1179', '3656491094646208', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 4.00, NULL, '2025-05-03 01:28:05', '2025-05-03 01:28:05', NULL),
(234, 31, 'Criativo 7', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491832642_3812108949099678_4972211101504931754_n.mp4?_nc_cat=105&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=nA74H6LD9JIQ7kNvwGIz3kk&_nc_oc=AdkJEcjYNOw06rkqvSID_PHGYvm-eKmx7VeWVdD41c0amKzrPc2T71eRlPnZrk2YVsI&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=9GvGmMlrMiKS1PASRv1FFA&oh=00_AfFGvTpeDjngfE-2nFOLmZI0UCjMEgUKQA9d98kNyW_nPA&oe=681B167D', '1036896234435999', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 4.00, NULL, '2025-05-03 01:28:26', '2025-05-03 01:28:26', NULL),
(235, 31, 'Criativo 8', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491471495_662315389858552_4586843115738567538_n.mp4?_nc_cat=107&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=VNY7qsnN8VgQ7kNvwHwU5iJ&_nc_oc=AdkKX_u-aym4wBV4QlUAUCqQSfVjA1chga5_fqcBXJXeOZ8nc4jbhFOzn3-U0NGI7DU&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=9GvGmMlrMiKS1PASRv1FFA&oh=00_AfFR4tdBKcNYGtWmQgu2eMvQhqJXfZvFA9BwFc2vzBXmvw&oe=681B14C6', '1669674383659028', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 4.00, NULL, '2025-05-03 01:28:51', '2025-05-03 01:28:51', NULL),
(236, 31, 'Criativo 9', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491042217_1799007350715852_2494967306407684130_n.mp4?_nc_cat=109&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=oGgwD9xP-KEQ7kNvwGjEVDH&_nc_oc=Adl0x866_CyyjTSip9L_NpV1wv9C78xfq2Mt9R4ovmuZbHfL4wpN_jF7heswexiiR0A&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=9GvGmMlrMiKS1PASRv1FFA&oh=00_AfHRRA6CsMxP0TpoCjZ2CUoYASvWtNIomyPTTrLeFglTgg&oe=681B031B', '2611237099075622', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 4.00, NULL, '2025-05-03 01:29:10', '2025-05-03 01:29:10', NULL),
(237, 32, 'Criativo 1', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491509349_1238790854431793_820860409991524638_n.mp4?_nc_cat=100&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeGjuM5bpXXsxdyHRaJF6pN6rb6TjDf9njytvpOMN_2ePHQaIfXTt8roLpAZSxr9OAouDDs0ptds17bvidRJdvVn&_nc_ohc=ug1tugkzEYwQ7kNvwFmAq3O&_nc_oc=AdlgUt_2Z9fc0xTrLPR9BLQH2YGIUe0g10rmx7gNG8MZkJPByooizRbs40-ru5lfeLE&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=Ex66t4gA1Os7JdMMlikiHA&oh=00_AfHvPSwIo0EM5WW2w0bjayuxHrEMy5gjI1cuW5pSFC_TTw&oe=681C0F24', '1801119823776808', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-05-03 20:47:23', '2025-05-03 20:47:23', NULL),
(238, 32, 'Criativo 2', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/493512373_1313217066448471_2707427706191977174_n.mp4?_nc_cat=100&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeGa3JvjWV9_2RVvTDsCouXD3Vvz5Ry3fjXdW_PlHLd-NRhZUfO3om0riADDHRJm_Vn0nRf4T_0SCurqgDnFUPkp&_nc_ohc=-jhIDUZ1l7kQ7kNvwF0R0xq&_nc_oc=AdnLrGxDgn32gFODKOXCj9jFAdDOj1y0WsMHcZQvHBuMGouVbimAAarXxkA-fM7Lc04&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=Ex66t4gA1Os7JdMMlikiHA&oh=00_AfEL5ML32OkkOeh4Kgr11_p4065EVedGr4hxynqiZNqE6A&oe=681C29C0', '1351795266042230', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-05-03 20:47:49', '2025-05-03 20:47:49', NULL),
(239, 32, 'Criativo 3', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/493512373_1313217066448471_2707427706191977174_n.mp4?_nc_cat=100&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeGa3JvjWV9_2RVvTDsCouXD3Vvz5Ry3fjXdW_PlHLd-NRhZUfO3om0riADDHRJm_Vn0nRf4T_0SCurqgDnFUPkp&_nc_ohc=-jhIDUZ1l7kQ7kNvwF0R0xq&_nc_oc=AdnLrGxDgn32gFODKOXCj9jFAdDOj1y0WsMHcZQvHBuMGouVbimAAarXxkA-fM7Lc04&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=Ex66t4gA1Os7JdMMlikiHA&oh=00_AfEL5ML32OkkOeh4Kgr11_p4065EVedGr4hxynqiZNqE6A&oe=681C29C0', '993942482868336', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-05-03 20:48:11', '2025-05-03 20:48:11', NULL),
(240, 32, 'Criativo 4', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491509349_1238790854431793_820860409991524638_n.mp4?_nc_cat=100&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeGjuM5bpXXsxdyHRaJF6pN6rb6TjDf9njytvpOMN_2ePHQaIfXTt8roLpAZSxr9OAouDDs0ptds17bvidRJdvVn&_nc_ohc=ug1tugkzEYwQ7kNvwFmAq3O&_nc_oc=AdlgUt_2Z9fc0xTrLPR9BLQH2YGIUe0g10rmx7gNG8MZkJPByooizRbs40-ru5lfeLE&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=Ex66t4gA1Os7JdMMlikiHA&oh=00_AfHvPSwIo0EM5WW2w0bjayuxHrEMy5gjI1cuW5pSFC_TTw&oe=681C0F24', '723340256923785', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 1.00, NULL, '2025-05-03 20:48:32', '2025-05-03 20:48:32', NULL),
(241, 32, 'Criativo 5', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/493680360_654611370761928_7169517909363330278_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=102&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeFUgxE4kRAwATHIOrXs2zpu3QgG9Rf8HxzdCAb1F_wfHNCdpSSIsawJS4k3rJaPrtBF39_xLq_JnG9XlZHLimYb&_nc_ohc=ikRnxheWyMUQ7kNvwHIr53r&_nc_oc=AdlBdB7W3Xcn_ev3r-dDcKmXA641HW8wZY6QONaIqh9tVZoxUvfVsvSisS3HmJlCMeg&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=Ex66t4gA1Os7JdMMlikiHA&oh=00_AfGLhpXf7o6_UjTOSUIN3sq7QBsuF0w461ZsZfq3ymNsjg&oe=681C379C', '1221000403064663', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 7.00, NULL, '2025-05-03 20:49:06', '2025-05-03 20:49:06', NULL),
(242, 32, 'Criativo 6', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/492421933_1030841172326914_447168957058232080_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=108&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeEwar-6h-os8vOPRi4haVsf5_woT5uXIajn_ChPm5chqE5TSl6p2IsiQ29zeuV68QVP3orcyvdniIWfLscYRr3q&_nc_ohc=cI4cy2BUd7oQ7kNvwGufav8&_nc_oc=AdlczQZsLHhx7jMuvkLKDpAQFQDWp8sN1UHOGy4vKT03TQCJLYMc3owB9pQRqLzkoOc&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=Ex66t4gA1Os7JdMMlikiHA&oh=00_AfEofCtxL-IMZUTt05Fh8PwE0HVtTuXV2js7fnTwsnxihA&oe=681C42B6', '1769603293769421', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 10.00, NULL, '2025-05-03 20:49:45', '2025-05-03 20:49:45', NULL),
(243, 32, 'Criativo 7', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491570765_1867794370719506_5175874897017424203_n.mp4?_nc_cat=105&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeF3QMxh8ZnrmD0oh8y9_6_TMo01g-4p7M0yjTWD7inszWt3ivzioKMgtxWDWt0yaSSH8ANBfx4WC1_aFXio8caW&_nc_ohc=8TmKHjr8jX4Q7kNvwHrFylF&_nc_oc=AdkNVkB9N1VNbTs6wPjbvyRepf9g3EeQ_Tgo-IL63w9tW5gnXO_SqBFD3K7iD2enXpc&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=Ex66t4gA1Os7JdMMlikiHA&oh=00_AfGb56pzGSduoIFDm7eKp_wmS5Fk2PfKP-0LZIWsvV2iew&oe=681C4008', '996585425943908', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-05-03 20:50:54', '2025-05-03 20:50:54', NULL),
(244, 32, 'Criativo 8', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491569655_1015002217239747_8372149963778630263_n.mp4?_nc_cat=100&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeGh4qFZrFxlfrFZWPxlpsIZGxZD-f4Npw8bFkP5_g2nD3Fe2QCykT7wHE2aSYydvapwgM2fgzzhgeZu9lD9s72q&_nc_ohc=bsLBRkyU1WgQ7kNvwGOFu0m&_nc_oc=AdmuewAFnbQP-ZoUSaBSAR2Kpd6frh47xDss9VIk46Xj8ClaubA_Z4V3CFr3LXTGMNU&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=Ex66t4gA1Os7JdMMlikiHA&oh=00_AfFVWtF7q9AYfVTqULNZXtCwUWbwWoGv9kEqrR28sPFtuA&oe=681C2A49', '704731691900681', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-05-03 20:51:25', '2025-05-03 20:51:25', NULL),
(245, 32, 'Criativo 9', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/491832031_1042993607748918_6960458108281089421_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=106&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeG-mFDNUa9K03GSKTATCTejHAorABA49TMcCisAEDj1M_Mlqml3TxocrOashxOmLdvMRZn52qzzkfzlnyop8sYe&_nc_ohc=tNkOYL4cBCQQ7kNvwFTu3XP&_nc_oc=Adl8EXj-E40RPPMffGDnWFpUjSa5nIS5ifgiFgspwm8JEXLMgo4x3i0kpvFQxjO_F84&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=Ex66t4gA1Os7JdMMlikiHA&oh=00_AfEacbotdgvToBHtDSs2KJ0nKeVVGvQnjfLLQl3gAHFgaA&oe=681C354F', '1027566046183857', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-05-03 20:51:48', '2025-05-03 20:51:48', NULL),
(246, 32, 'Criativo 10', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491479361_1045748384079592_448788468976917132_n.mp4?_nc_cat=106&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeF9FyJDfjPzpaqHsVkR_ZU96XY8VMFX3k3pdjxUwVfeTUqxxZC5VAWVamzVufL01VEK_Wc5mL8v7EuXxdDE4GY6&_nc_ohc=sWq2rsW5b4UQ7kNvwH6SH12&_nc_oc=Adm0KsDOl74-SRiDq0IzKNeG44FHS8pX3DEg3HfUDkkz-vCH-y8D5ZhNOP9Sn5rQRWo&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=Ex66t4gA1Os7JdMMlikiHA&oh=00_AfEk6VfV9pHr9pFsbpXWaTFNri6bYNt2X49G4Xloddn7PA&oe=681C10EA', '1174728543939599', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-05-03 20:52:14', '2025-05-03 20:52:14', NULL),
(247, 32, 'Criativo 11', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491562257_879026347686340_4791644807526156106_n.mp4?_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeE3Rqeh42x8PTo4Sbnah3SPN1BG29n1yZk3UEbb2fXJmWriIvgfc6v2r8j6WWBu_0jklC2a43ar6b-UIT5UO59s&_nc_ohc=KHL8SJv7OooQ7kNvwFXCAOR&_nc_oc=AdkfA8QZZp8d9EF5blW3Gl7qypbyPxMBylRsHVeenfizI07nNKEIRTHrh025Oz6M7yw&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=Ex66t4gA1Os7JdMMlikiHA&oh=00_AfH2Sf0E_J-IHe0E1w9w-8bGUPsBEPD_cpYTrReHGCwZ2Q&oe=681C3D19', '663669423060448', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-05-03 20:52:36', '2025-05-03 20:52:36', NULL),
(248, 32, 'Criativo 12', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491532027_688395103738819_1826757974444310026_n.mp4?_nc_cat=102&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeHDpIvi2vmDAAGIR3Xx77guVVme_EbRYbdVWZ78RtFhtyyNZjsabT665sw9GTCoFE6XBGFpF2PrYYxSfb-MFgPw&_nc_ohc=hePKa0N5VloQ7kNvwH9p9vy&_nc_oc=AdlqzX62QRJSCdyELhAtPYwLSkM6hZHU1H5piswCot0CCeszofx9mEmT1g6THkz9id0&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=Ex66t4gA1Os7JdMMlikiHA&oh=00_AfG5Od7BVXrD66B5FYaZIQ3oWJAXUYiqhQVoHy-T8qpGOA&oe=681C31E7', '1405593967470262', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-05-03 20:53:10', '2025-05-03 20:53:10', NULL),
(249, 32, 'Criativo 13', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491899305_2014886372334649_4433502002187084629_n.mp4?_nc_cat=103&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeG_Zh0SNORoJtBwb_bXjRaEGIPnREUM-bwYg-dERQz5vEfLXrl_2J7RsC_shYRU-K5hf2X4DelO-eZCuUufX0rI&_nc_ohc=GahP-53WuUYQ7kNvwHA3u0h&_nc_oc=Adn2sBEkZD_tjMc0SY7mLm-iwxTesw3LuiOuxevAU9yTql3LtRyhaD2VPtbnm3ewM60&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=Ex66t4gA1Os7JdMMlikiHA&oh=00_AfFnNW-0iG1AVxGpwcLmxKJ_pI7U7a6ANjlvZJew9aZRJw&oe=681C3C18', '670053892332905', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-05-03 20:53:29', '2025-05-03 20:53:29', NULL),
(250, 32, 'Criativo 14', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491897398_1070479905099840_718255079398356586_n.mp4?_nc_cat=110&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeGrntfeuLaEIrDj00CV-PSn3b4K73GWtFDdvgrvcZa0UIe7krzqrrUeYSueXzJaib5qGGQaNf1xYwODyPQjEFaK&_nc_ohc=4r7St0fCT6gQ7kNvwGZM-kd&_nc_oc=Admc31H7mtVUdv4QRhDgAUtvomPbETBUDj8frRqVHpvl0mwlMKMoJpE6PmgSDhCp6IA&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=Ex66t4gA1Os7JdMMlikiHA&oh=00_AfHCawIjQpl2O1VYTnaH4Lbm9TBKHaFfNulkBqigwvYo7g&oe=681C40A7', '1212246433733418', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-05-03 20:53:55', '2025-05-03 20:53:55', NULL),
(251, 32, 'Criativo 15', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491509604_2137034366805042_1792512581845592414_n.mp4?_nc_cat=108&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeF4xLZXW7RF_nWoTWNHJgf1uZ9D8jHWw0e5n0PyMdbDR67GW2Xg0ZbXpphy7fE1TEMlafgyuUP1lPBRVCx5Wz-s&_nc_ohc=RxIH11KTXDcQ7kNvwEXOAtu&_nc_oc=AdlwMPFYiaOualDn7VJk9a_pnvHDyUB2s-Zkn1lWWYG7jAw3aj8Q_oWq-bwcMZ5QIPY&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=Ex66t4gA1Os7JdMMlikiHA&oh=00_AfG_iAHNWSOVvlckozF4m-n95GOA5MdDDd-dq3nEU5sKVA&oe=681C33BD', '1314663856273461', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 2.00, NULL, '2025-05-03 20:54:20', '2025-05-03 20:54:20', NULL),
(252, 32, 'Criativo 16', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491480732_1239069857889299_7937429338851274627_n.mp4?_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeEL_f1z-X9134_S8Sms4nX_s-5UZ-C4pf-z7lRn4Lil__4v1Ge0xjlhu5IFyL-TfrptY40B1aVAMGYsQi6LmJf3&_nc_ohc=HFnaIWczvXgQ7kNvwHgCu5F&_nc_oc=Admn_n6H1xyENWrMpYq67cfooKxnQL31LbFnddK-dHM6MhG-qbDPABi-sx74G8eCvgc&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=KOLqjXwbMNzhihuiGOdJ4Q&oh=00_AfErjlwIh7EP-7xy4qGFwNSTZf8usE3qeKkknxPs8PBesg&oe=681C1D9F', '670576112594018', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 12.00, NULL, '2025-05-03 20:55:31', '2025-05-03 20:55:31', NULL),
(253, 33, 'Criativo 1', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/493299060_707604998459089_2195131182008473163_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=109&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeFBcyGgvoXtC0Ap3jqrBdCc417p2qOK1WTjXunao4rVZGt4bmIMBYzCLalwTZu93PaQjB5TPJoMj_u4DkbzVMJx&_nc_ohc=GIXiK3QCULEQ7kNvwGCKCLG&_nc_oc=AdlJFkpb1s8Oc04S848LS2vIGfNF0xn4ICpybjT5h9cdVhp1CZfRjttIMqf0PlAYmNU&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=6Rpenws8DyLXyCEPp5bF9A&oh=00_AfHUZS4lP38LWrFSi0TLEJ4Y4Ktrq8_1g0puFkDsqQBPQw&oe=681C38E9', '565392399499436', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 7.00, NULL, '2025-05-03 21:03:16', '2025-05-03 21:03:16', NULL),
(254, 33, 'Criativo 2', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/493521205_3940015982912752_6771178119362348631_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=104&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeFEUafU6_2hZBYE8x-SOKOsbvAibzoW4ORu8CJvOhbg5OpbLn73yi-g3zwn2HC2ycrgukDM0n1TSCpxeyylbyXk&_nc_ohc=P2nvZPtr1t4Q7kNvwHP1oJ0&_nc_oc=AdlWMsfQFCl5bp4GTMcpe22L8lJt2Kb2Zws7IkK14HHp3IWfNjx-O4MHjSM686Piv7M&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=6Rpenws8DyLXyCEPp5bF9A&oh=00_AfF-tlLWrRuSvGBE4MES5hre4wuYPkLln4GYISTzHmQ-1w&oe=681C479E', '571499852649833', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 6.00, NULL, '2025-05-03 21:03:36', '2025-05-03 21:03:36', NULL),
(255, 33, 'Criativo 3', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/493796763_2521456988192054_1070598767697563724_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=111&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeGbRpebBLwW4siUasG-sqVeopnWAIRWsD2imdYAhFawPRT_AaeLyTwfTHD2eel03TovHoq1rNGnwNurMtxddoQ4&_nc_ohc=SEJsbtd1yaoQ7kNvwH0oNjp&_nc_oc=Admdb-FiidRA4_PqwWSoSM8avpfDcWfV2ydBbQ4kn2vyWCNpnEgv9ZbuHKgU7dA8Nx0&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=6Rpenws8DyLXyCEPp5bF9A&oh=00_AfG1MpnOiA3xeX0KqzV6ql8O4KW3DXLExd4lQg8prpBaSQ&oe=681C3A98', '696334386180210', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 6.00, NULL, '2025-05-03 21:03:54', '2025-05-03 21:03:54', NULL),
(256, 33, 'Criativo 4', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/494135624_562628113611028_6544069114886625659_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=110&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeFbA88wzaIemo1sj_vLwHytBF0IEw0TztkEXQgTDRPO2fbHyBSJnu9-xQnugadcK_A4wmqX5xnjSl8mvgMchvzg&_nc_ohc=LzjIqE6ygAsQ7kNvwFOf5Bs&_nc_oc=AdnTBOVyvm00e-xcP2eKRH6bHVKwUQmBJkKH6cca96gZTa8QuRYXAInno7ibeKSeMns&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=6Rpenws8DyLXyCEPp5bF9A&oh=00_AfEnWRenc3ZsECHDxfkLprGy9hvLrw2awrF5sQYa0u8Nzg&oe=681C302B', '716236127669961', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 5.00, NULL, '2025-05-03 21:04:12', '2025-05-03 21:04:12', NULL),
(257, 33, 'Criativo 5', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/493950261_1079580124014440_1197568909556482057_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=104&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeFzrvXLBQlbfKiQrdTB8SSKmtbTV0nXQ6-a1tNXSddDr3DYdBEk__0zcP0pS8VxnBgE3glp52-IO2EU8JUYbn0C&_nc_ohc=8xeOjawmrUQQ7kNvwETB9Ce&_nc_oc=AdkegOBlXk9OAw3yjHmGrG-rUa50vFP7lCtoXhpg6cADstybfHI8mPwmgbiDOxFqawA&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=6Rpenws8DyLXyCEPp5bF9A&oh=00_AfEXSs6yYZtZmtTIYemMXa8HURge2huipUxqRqReJEyybg&oe=681C1C60', '898076265777682', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 6.00, NULL, '2025-05-03 21:04:28', '2025-05-03 21:04:28', NULL),
(258, 33, 'Criativo 6', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/493914317_1220358553131219_2163181374000484028_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=107&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeFJ9SfgA6AlhzMJ4bSod70U-1WuFjjMMBb7Va4WOMwwFv6DtYF8NFIfosvXsUAm4A8ZE_FpNpcvNuT11BGKGKzC&_nc_ohc=CEeX6_fAprgQ7kNvwHTK8ou&_nc_oc=AdkamxxYAqr2Q3nMdnqK6KFW65x966rGcScF5ScApSn8nDws0MuwL2hm8QKIS0FUCBM&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=6Rpenws8DyLXyCEPp5bF9A&oh=00_AfFV32Q8VmTOba8eR5VutBUw5Hmd8vQZ3MB7a5-5qw8DhQ&oe=681C466E', '1019999319688259', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 7.00, NULL, '2025-05-03 21:04:50', '2025-05-03 21:04:50', NULL),
(259, 33, 'Criativo 7', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/493750141_1034799765267502_8255570603675498390_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=106&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeHo86qq1yBpB0l-wNdbHvIfWtg25OPqqFpa2Dbk4-qoWijd_0XY63BFe39fH0Bns0gclMdAuv3ca2qTbtYIFAY_&_nc_ohc=J99kGqIT6tIQ7kNvwEDoPSO&_nc_oc=AdlnTLoyIuzILCArV5W096xTEEJ3kBc8puohkwU-vvIr_Gb4Dbb7c9HS7YnbhaBeOdk&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=6Rpenws8DyLXyCEPp5bF9A&oh=00_AfEj8Qis6ADyHTSDxg9vd6I6oFpH6H8gtzNycmCu59ASow&oe=681C1039', '995512086035594', '[\"Facebook\",\"Instagram\"]', NULL, 'PT-BR', 'PT-BR', NULL, NULL, 'ativo', NULL, 8.00, NULL, '2025-05-03 21:05:15', '2025-05-03 21:05:15', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `criativos_backup`
--

CREATE TABLE `criativos_backup` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `anuncio_id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(100) NOT NULL COMMENT 'Título do criativo',
  `tag` varchar(50) DEFAULT NULL COMMENT 'Tag para categorização/filtragem',
  `url` varchar(2048) DEFAULT NULL COMMENT 'URL para o conteúdo do criativo',
  `creativeId` varchar(255) NOT NULL,
  `platform` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `idioma` varchar(10) DEFAULT NULL COMMENT 'Idioma do criativo (PT-BR, EN-US, etc)',
  `image` varchar(255) DEFAULT NULL,
  `caption` text DEFAULT NULL,
  `status` enum('escalando','teste','pausado') NOT NULL,
  `performance_status` varchar(255) DEFAULT NULL,
  `value` double(8,2) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_status_change` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `criativos_backup`
--

INSERT INTO `criativos_backup` (`id`, `anuncio_id`, `titulo`, `tag`, `url`, `creativeId`, `platform`, `language`, `idioma`, `image`, `caption`, `status`, `performance_status`, `value`, `deleted_at`, `created_at`, `updated_at`, `last_status_change`) VALUES
(1, 1, 'Criativo 1', 'tag1', 'https://prod-minio.ja6ipr.easypanel.host/american-producao/388063ef88464d14ddee69b0e7f54fc6-Maratona%20Vocal%20CR%2004.mp4', '1256', 'Facebook', 'PT-BR', 'PT-BR', 'criativos/vuW9pgcshCHM3tP4TVWMfyXlamrivPu7FIIjeJI2.jpg', NULL, 'escalando', 'Escalando', 511.00, NULL, '2025-03-27 17:23:03', '2025-04-01 15:50:50', '2025-03-31 17:27:18'),
(2, 1, 'Criativo 2', 'tag2', 'https://prod-minio.ja6ipr.easypanel.host/american-producao/509253c88ed4fe37fe17a47d50855e64-Maratona%20Vocal%20CR%2006.mp4', '1257', 'Instagram', 'PT-BR', 'PT-BR', 'criativos/1743273374_pessoas 2.jpg', NULL, 'escalando', 'Perdendo desempenho', 15.00, NULL, '2025-03-29 21:36:14', '2025-04-01 15:51:20', '2025-03-31 17:27:34'),
(3, 1, 'criativo 3', 'tag4', 'https://ricardoimoveisitapema.com.br', '1257', 'Instagram', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', 'Testando criativos', 35.00, NULL, '2025-03-31 17:26:59', '2025-04-01 15:51:33', '2025-03-31 17:36:34'),
(4, 1, 'Criativo 4', 'cri5', 'https://prod-minio.ja6ipr.easypanel.host/american-producao/388063ef88464d14ddee69b0e7f54fc6-Maratona%20Vocal%20CR%2004.mp4', '123', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 6.00, NULL, '2025-04-01 15:49:50', '2025-04-01 15:51:46', NULL),
(5, 1, 'Criativo 5', 'tag1', 'https://prod-minio.ja6ipr.easypanel.host/american-producao/4b71fd73efa18b1d0d10026c4b9b3c7b-Maratona%20Vocal%20CR%2003.mp4', '1234', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 10.00, NULL, '2025-04-01 15:53:22', '2025-04-01 15:53:22', NULL),
(6, 1, 'Criativo 6', 'tag1', 'https://prod-minio.ja6ipr.easypanel.host/american-producao/adce33e5b131b0f60b4f870964559e35-Maratona%20Vocal%20CR%2002.mp4', '12345', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 11.00, NULL, '2025-04-01 15:54:38', '2025-04-01 15:54:38', NULL),
(7, 1, 'Criativo 7', 'tag1', 'https://prod-minio.ja6ipr.easypanel.host/american-producao/179dc90840a378c58e8c7346a6226b2c-Maratona%20Vocal%20CR%2001.mp4', '123', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 10.00, NULL, '2025-04-01 15:56:23', '2025-04-01 15:56:23', NULL),
(8, 3, 'criativo 01', 'tag1', 'https://www.facebook.com/ads/library/?id=7957138831071297', '1345', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 1.00, NULL, '2025-04-10 02:29:56', '2025-04-10 02:29:56', NULL),
(9, 3, 'criativo 2', 'tag1', 'https://www.facebook.com/ads/library/?id=8674544696007310', '5etrd', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 1.00, NULL, '2025-04-10 02:31:20', '2025-04-10 02:31:20', NULL),
(10, 3, 'criativo 03', 'tag1', 'https://www.facebook.com/ads/library/?id=1342002620139360', 'dytr', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 1.00, NULL, '2025-04-10 02:32:20', '2025-04-10 02:32:20', NULL),
(11, 3, 'criativo 4', 'tag1', 'https://www.facebook.com/ads/library/?id=1722419101649695', 'd', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 23.00, NULL, '2025-04-10 02:33:28', '2025-04-10 02:33:28', NULL),
(12, 3, 'Criativo 5', 'tag1', 'https://www.facebook.com/ads/library/?id=1417984732500787', 'gdh', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 21.00, NULL, '2025-04-10 02:34:19', '2025-04-10 02:34:19', NULL),
(13, 3, 'criativo 6', 'tag1', 'https://www.facebook.com/ads/library/?id=1312549990047245', 'fns', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 28.00, NULL, '2025-04-10 02:36:40', '2025-04-10 02:36:40', NULL),
(14, 3, 'criativo 7', 'tag1', 'https://www.facebook.com/ads/library/?id=2778386652333054', 'fzs', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 51.00, NULL, '2025-04-10 02:38:01', '2025-04-10 02:38:01', NULL),
(15, 3, 'criativo 8', 'tag1', 'https://www.facebook.com/ads/library/?id=957283599932622', 'fsf', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 51.00, NULL, '2025-04-10 02:39:26', '2025-04-10 02:39:26', NULL),
(16, 3, 'criativo 9', 'tag1', 'https://www.facebook.com/ads/library/?id=3686678644912065', 'fvbhzh', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 51.00, NULL, '2025-04-10 02:41:12', '2025-04-10 02:41:12', NULL),
(17, 4, 'Criativo 1', 'olhos', 'https://www.facebook.com/ads/library/?id=677706571271453', 'e5', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 1.00, NULL, '2025-04-11 02:13:04', '2025-04-11 02:13:04', NULL),
(18, 4, 'criativo 2', 'olhos', 'https://www.facebook.com/ads/library/?id=1010347447683381', '1010347447683381', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', 'Perdendo desempenho', 0.00, NULL, '2025-04-11 02:16:40', '2025-04-11 02:29:19', '2025-04-11 02:29:19'),
(19, 4, 'criativo 3', 'tag1', 'https://www.facebook.com/ads/library/?id=1200410831655420', '1200410831655420', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 95.00, NULL, '2025-04-11 02:18:20', '2025-04-11 02:18:20', NULL),
(20, 4, 'criativo 4', 'tag1', 'https://www.facebook.com/ads/library/?id=1004346257918739', '1004346257918739', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 1.00, NULL, '2025-04-11 02:22:08', '2025-04-11 02:22:08', NULL),
(21, 4, 'Criativo 5', 'olhos', 'https://www.facebook.com/ads/library/?id=3570283346599394https://www.facebook.com/ads/library/?id=3570283346599394', '3570283346599394', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 2.00, NULL, '2025-04-11 02:31:06', '2025-04-11 02:31:06', NULL),
(22, 6, 'Criativo 1', 'Evangélico/Cristianismo', 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/482766783_1117197656756178_6365022783066521542_n.mp4?_nc_cat=100&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeFZ6ZNW_1Kh7GIElsdLqBrVv_e3If0pbwe_97ch_SlvBx3Au7lToU-KmXoVuTh6QrI3fMs0RVKl6jLCyPCMUdqT&_nc_ohc=MtU8lzJcB2EQ7kNvwEfmLVg&_nc_oc=Adlu8LTATDuDm8PfboDHZP3LVOQhnjChoXmFKvLFZmxgi7JtllzLS9BgeXl7OR-nlHE&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=6Mz4ybE4g_27ZH_3gB5fhA&oh=00_AfH-ObFijhj0Dc5yBeX97f9BpkpA8e-WFzxaCYzIWxIfcg&oe=67FE4E01', '1192530045609185', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 16.00, NULL, '2025-04-11 03:26:52', '2025-04-11 03:26:52', NULL),
(23, 6, 'Criativo 2', 'Evangélico/Cristianismo', 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/482867968_498925736608574_6867206556268763918_n.mp4?_nc_cat=103&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeEE3OSqqItFtwvmew3OKnzpweRBpJIzRzLB5EGkkjNHMpGkgfngz50diYeuCn8vdxtmwSAifOAKnVyLWjv1_REd&_nc_ohc=T22Lu9DgGf0Q7kNvwEKnTLj&_nc_oc=Adn7lQyrmZFilqWZPTUrZMxorY7wHSPrpM_B-3mQdQgcvhZOfe-iV-kU5cfyDLQ8LJk&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=6Mz4ybE4g_27ZH_3gB5fhA&oh=00_AfEJSoF5zUrAwjk2MxdJtlo_kxxfpwPGOVDHmZhnZ-1a_Q&oe=67FE3141', '1178551073469629', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 6.00, NULL, '2025-04-11 03:31:05', '2025-04-11 03:31:05', NULL),
(24, 5, 'Criativo 1', 'Evangélico/Cristianismo', 'https://www.facebook.com/ads/library/?id=1273079664246752', '1273079664246752', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', 'Perdendo desempenho', 8.00, NULL, '2025-04-11 03:36:31', '2025-04-11 03:37:51', '2025-04-11 03:37:51'),
(25, 5, 'criativo 2', 'Evangélico/Cristianismo', 'https://www.facebook.com/ads/library/?id=2184622328619285', 'I', 'Facebook', 'PT-BR', 'PT-BR', 'criativos/1744332250_3c6e3997-bd60-4aca-9b40-ba9867c693b1.png', NULL, 'escalando', NULL, 1.00, NULL, '2025-04-11 03:44:10', '2025-04-11 03:44:10', NULL),
(26, 5, 'criativo 3', 'Evangélico/Cristianismo', 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/486097709_669529908962868_8184716508493432686_n.mp4?_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=F70udM8y6YgQ7kNvwGPUVdb&_nc_oc=Adkh4kC8_j_gxDLaKKehuEybrmiIp8V9OW0j95H8nVLFethXsRxz5l8hkocwtP9BX4Q&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=_xgjgT3QC0KMcRgrXJZOTw&oh=00_AfEGB6oxVKj0L_ykIDr0BCDCip5dGunbvJlMfn8Qh3nBTQ&oe=67FE4713', '491955150662220', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 40.00, NULL, '2025-04-11 03:48:56', '2025-04-11 03:48:56', NULL),
(27, 7, 'criativo 01', 'tag1', 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/451262821_1022883042799367_3802101047175041092_n.mp4?_nc_cat=111&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeF12-6xTa9eepPVRPhdhHH8B8gcyUSjp60HyBzJRKOnrSlt_DoecgfXkQKIQ8rmz9ghFM9a3IRefq3SDBC4JlVx&_nc_ohc=USKF3wZNKzwQ7kNvwE2m1X0&_nc_oc=AdmM0rdbejEL1KRHYg_KmK59c2F9jJV3aamRIvGgB35fgJGw8TLGerfuGXdD2UDyVkE&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=Em3KupqNJ95GpiRogUPs3g&oh=00_AfEgCUUAgzkGYF18xqFaP7Z7fM3SOrX5xeOKjmO_QE9cbQ&oe=67FE5433', '531888176328018', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 3.00, NULL, '2025-04-11 04:28:10', '2025-04-11 04:28:10', NULL),
(28, 7, 'Criativo 2', 'tag2', 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/399358103_249900854728788_4683517884106491577_n.mp4?_nc_cat=110&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeHbQP4wGbx-wz1Dlg_BJZD5YrJ2dLa6tC1isnZ0trq0LVzu8IesAiln36t6jRELr6z8rdteGKV9nIQcmqNL6jhH&_nc_ohc=lRyOOPFovJEQ7kNvwF_DODw&_nc_oc=AdnSxFeF0n9ozCKFlEfP_n5yOrkIlbvqqcDOuEKEspxIDb_0wWjbZi6IOak-umEqtJo&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=Em3KupqNJ95GpiRogUPs3g&oh=00_AfE2tUfYLmx2nPRZ0kdNKUF6we0HdHGsSNdP4hB8_SOUwA&oe=67FE5C08', '1236607631801603', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 6.00, NULL, '2025-04-11 04:29:36', '2025-04-11 04:29:36', NULL),
(29, 7, 'Criativo 3', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/461519271_1048372263617069_4223511585634835718_n.mp4?_nc_cat=103&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeEY5_a-0IIlGf9P6x9MNq8eUJRyBi-gQipQlHIGL6BCKjyrybGPlQQNt-sHvtSkgUjrzGFZBtm45JxK5kY9BkTh&_nc_ohc=pNnLNt1KXtUQ7kNvwEcN0bN&_nc_oc=Adl_PpwvruuUIAEZ0aFHgzgEEDOtfxpX_FN_lEP0eK6OmDMtzBfMpc_l8maTDYUnbeg&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=Em3KupqNJ95GpiRogUPs3g&oh=00_AfGJWn6eVOCkPEGn5OErJ4vK4BmsrmnKJHIdXASAifIBiA&oe=67FE2EF7', '29313030031676607', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 3.00, NULL, '2025-04-11 04:32:26', '2025-04-11 04:32:26', NULL),
(30, 7, 'criativo 4', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/466344217_1341950883846070_8607327271029741236_n.mp4?_nc_cat=106&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeGN5Y8pot3gRHk8lysDTQqbphfiqSW8m4ymF-KpJbybjCW_zvzEG4Osx-FNLdqjenOuty2VKMlNFVvlA0wPqEbQ&_nc_ohc=StsXnYBPEwkQ7kNvwEMco4G&_nc_oc=Adn8u_TihZUh9J1ypZK8lKvFHi84Ui4tPeMRey2JAfqUfmRhwLVoc-udsFMzy4E3vxw&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=Em3KupqNJ95GpiRogUPs3g&oh=00_AfHMzn0AorIOtfcbrsPA3VEa1sBGryF7kodJjfGE5G2VMQ&oe=67FE46A4', '2678136249053860', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 0.00, NULL, '2025-04-11 04:34:36', '2025-04-11 04:34:36', NULL),
(31, 7, 'Criativo 5', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/388929364_730553272240492_1436702142133222742_n.mp4?_nc_cat=106&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeH9SCPUve9jW2HSO23GTSIqxX0z6pgdLsrFfTPqmB0uytjqnOBKSoja_rsemHyWxfyZabm9TBqE1MXSdLhZepRl&_nc_ohc=gLLl-ACgt-kQ7kNvwGiM41p&_nc_oc=Adm2-zmyh8NyJepnjcndLGakaA9GY8kwtJaoo266RU6cqBtM0efI8ZWRYAF4cBWxpdg&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=Em3KupqNJ95GpiRogUPs3g&oh=00_AfFb7yX6i3PbyPTc4XL72XeFGP6qBC1AbNTMSrUZ1giaPg&oe=67FE2F29', '653403700754167', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 7.00, NULL, '2025-04-11 04:39:47', '2025-04-11 04:39:47', NULL),
(32, 7, 'Criativo 6', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/449042661_869325171890555_5777911996748533810_n.mp4?_nc_cat=103&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeE2ETVzPo868IQbwm1rfrwsfXf_XWbhhx99d_9dZuGHH2VpOUSUbz15GcR8IS0B5SV_eV5mue9IAEdSjZpLVklM&_nc_ohc=ZX8IA829o3kQ7kNvwHVL5Z4&_nc_oc=AdnvsMhkyenNQipupTjdetd5xOTCWVL1qMULXzvPhfHsk7BDMaYvfmhh1kCFQf_EyN0&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=9RnyJYLVIyMBXvpHGZZX4g&oh=00_AfF5m8a3XNiZ0Vj1HS63xf1bu2Ow__5QqfF447SH15K0KQ&oe=67FE4748', '1181989720065086', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 7.00, NULL, '2025-04-11 04:43:19', '2025-04-11 04:43:19', NULL),
(33, 5, 'criativo 4', 'Evangélico/Cristianismo', 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/486097709_669529908962868_8184716508493432686_n.mp4?_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=F70udM8y6YgQ7kNvwGPUVdb&_nc_oc=Adkh4kC8_j_gxDLaKKehuEybrmiIp8V9OW0j95H8nVLFethXsRxz5l8hkocwtP9BX4Q&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=_xgjgT3QC0KMcRgrXJZOTw&oh=00_AfEGB6oxVKj0L_ykIDr0BCDCip5dGunbvJlMfn8Qh3nBTQ&oe=67FE4713', '9777298632315664', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 2.00, NULL, '2025-04-11 04:59:04', '2025-04-11 04:59:04', NULL),
(34, 8, 'criativo 01', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/481325050_2925916190909996_1123548781316021123_n.mp4?_nc_cat=107&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeH66APGMXwJlA-sgfzwD6BjWwYyeO-e411bBjJ4757jXU7KJ-lv4u-XAW5WNTEKF79CvbmaEZM-Kr4w8mViZlCM&_nc_ohc=Kx5Y6IO6OC4Q7kNvwEp_4Kl&_nc_oc=Adk34_bWFiMse3zF2ovtctukHlXW-7dKMRRwPGf1EU8OqBFveVz1cwbTcoxDijyCRbc&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=RNcPin-zG7JR1g7JgLQoEA&oh=00_AfHrrSYP6zgf748OYpKJ4iYjYIRvFbIpiW46FaWt3Vsv_g&oe=67FE4030', '624967530544937', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 4.00, NULL, '2025-04-11 05:04:53', '2025-04-11 05:04:53', NULL),
(35, 5, 'criativo 5', 'Evangélico/Cristianismo', 'https://www.facebook.com/ads/library/?id=535965909558207', '535965909558207', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 7.00, NULL, '2025-04-11 05:06:17', '2025-04-11 05:06:17', NULL),
(36, 8, 'Criativo 2', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/485022582_1823653791745191_4520477719510067851_n.mp4?_nc_cat=100&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeFQ8hp1HUGnb4Tf30Z935IRc5qkUlJcS8pzmqRSUlxLytOnB3Qo2PiyeEfRYx0239ETZADPBfaftm3gZ95-9OLP&_nc_ohc=xYWXuSpKzakQ7kNvwEnW796&_nc_oc=AdkajXCou6bFnQJ5O1ESzAPxCUNKihbRjjVPoBYbl6cz8CzlT_i4BhOeAP88bkLqpfQ&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=RNcPin-zG7JR1g7JgLQoEA&oh=00_AfFRuEjfqw-NkoIxTZK8n-h3fFsmItWMu8Wi5XILoL8SmA&oe=67FE3750', '679318467805602', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 3.00, NULL, '2025-04-11 05:07:28', '2025-04-11 05:07:28', NULL),
(37, 5, 'criativo 6', 'Evangélico/Cristianismo', 'https://www.facebook.com/ads/library/?id=658852250220758', '658852250220758', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 4.00, NULL, '2025-04-11 05:09:08', '2025-04-11 05:09:08', NULL),
(38, 8, 'Criativo 3', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/481190711_642177658405640_1415915232367388482_n.mp4?_nc_cat=101&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeELtaUbQHMnAHYZsYgIxLD9ECQdTqbanx4QJB1OptqfHumCCoGn3MwDYpsVv3yZZuKQNqyv-KsTMoDBEoxBdqnR&_nc_ohc=2bAlym5h_UEQ7kNvwGoqbpx&_nc_oc=Adn0ZwfrLLYu7hKQyOXcbgCb6BelxZRZLBidxvRodcgUz_1R1F4pp5174nRHpdqCwN8&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=RNcPin-zG7JR1g7JgLQoEA&oh=00_AfEt9v8cz8smaRuHBhrMiUW0YzuD3xYWe2ywfWa_C-VMFg&oe=67FE3C69', '974449144891913', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 2.00, NULL, '2025-04-11 05:09:44', '2025-04-11 05:09:44', NULL),
(39, 8, 'criativo 4', NULL, 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/484881669_1360757194926585_8867874946983471254_n.mp4?_nc_cat=105&ccb=1-7&_nc_sid=c53f8f&_nc_eui2=AeGFaUl5R7AG9JUSZ9n6Ei0mtk2SEBE5CXW2TZIQETkJdRPkonSG9-u-zLSDmFccqMCujI3EIfvkjMXcXWzkRH1v&_nc_ohc=p2kyzi5MCeMQ7kNvwGA7OXT&_nc_oc=AdkTSa4SZt34ZFsgb7eGfDAUADOXk7GODGqfoACgwpytJ8hdDItBlcUUp7PY6T0QhZo&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=RNcPin-zG7JR1g7JgLQoEA&oh=00_AfEtuQMmm0x02qK_Q9VImjoSI-DiZbkB4JK4mW-tDsrdmA&oe=67FE53E0', '1067599821859593', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 3.00, NULL, '2025-04-11 05:11:18', '2025-04-11 05:11:18', NULL),
(40, 5, 'criativo 7', 'Evangélico/Cristianismo', 'https://www.facebook.com/ads/library/?id=460535470414719', '460535470414719', 'Facebook', 'PT-BR', 'PT-BR', NULL, NULL, 'escalando', NULL, 15.00, NULL, '2025-04-11 05:11:21', '2025-04-11 05:11:21', NULL),
(41, 9, 'Criativo 1', 'TAG 1', 'https://www.facebook.com/ads/library/?id=1871450480318504', '1871450480318504', 'Facebook', 'EN-US', 'EN-US', NULL, NULL, 'escalando', NULL, 56.00, NULL, '2025-04-23 22:48:08', '2025-04-23 22:48:08', NULL),
(42, 9, 'CRIATIVO 2', 'TAG 1', 'https://www.facebook.com/ads/library/?id=3671074309696798', '3671074309696798', 'Facebook', 'EN-US', 'EN-US', NULL, NULL, 'escalando', NULL, 84.00, NULL, '2025-04-23 22:49:29', '2025-04-23 22:49:29', NULL),
(43, 9, 'CRIAITVO 3', 'TAG 1', 'https://www.facebook.com/ads/library/?id=1375618506799806', '1375618506799806', 'Facebook', 'EN-US', 'EN-US', NULL, NULL, 'escalando', NULL, 69.00, NULL, '2025-04-23 22:51:08', '2025-04-23 22:51:08', NULL),
(44, 9, 'CRIATIVO 4', 'TAG 1', 'https://www.facebook.com/ads/library/?id=531672406432562', '531672406432562', 'Facebook', 'EN-US', 'EN-US', NULL, NULL, 'escalando', NULL, 90.00, NULL, '2025-04-23 22:53:33', '2025-04-23 22:53:33', NULL),
(45, 10, 'Criativo 1', 'TAG 1', 'https://www.facebook.com/ads/library/?id=1043603787816155', '1043603787816155', 'Facebook', 'EN-US', 'EN-US', NULL, NULL, 'escalando', 'Perdendo desempenho', 9.00, NULL, '2025-04-23 23:43:28', '2025-04-23 23:46:04', '2025-04-23 23:46:04'),
(46, 10, 'criativo 2', 'TAG 1', 'https://www.facebook.com/ads/library/?id=498378863242222', '498378863242222', 'Facebook', 'EN-US', 'EN-US', NULL, NULL, 'escalando', NULL, 18.00, NULL, '2025-04-23 23:45:02', '2025-04-23 23:45:02', NULL),
(47, 10, 'CRIATIVO 3', 'TAG 1', 'https://www.facebook.com/ads/library/?id=1710023269605057', '1710023269605057', 'Facebook', 'EN-US', 'EN-US', NULL, NULL, 'escalando', NULL, 7.00, NULL, '2025-04-23 23:48:39', '2025-04-23 23:48:39', NULL),
(48, 10, 'CRIATIVO 4', 'TAG 1', 'https://www.facebook.com/ads/library/?id=533948042867112', '533948042867112', 'Facebook', 'EN-US', 'EN-US', NULL, NULL, 'escalando', NULL, 9.00, NULL, '2025-04-23 23:50:46', '2025-04-23 23:50:46', NULL),
(49, 10, 'Criativo 5', 'TAG 1', 'https://www.facebook.com/ads/library/?id=1344870796717170', '1344870796717170', 'Facebook', 'EN-US', 'EN-US', NULL, NULL, 'escalando', NULL, 17.00, NULL, '2025-04-23 23:53:33', '2025-04-23 23:53:33', NULL),
(50, 10, 'Criativo 6', 'TAG 1', 'https://www.facebook.com/ads/library/?id=658466076818929', '658466076818929', 'Facebook', 'EN-US', 'EN-US', NULL, NULL, 'escalando', NULL, 31.00, NULL, '2025-04-23 23:54:55', '2025-04-23 23:54:55', NULL),
(51, 10, 'CRIATIVO 7', 'TAG 1', 'https://www.facebook.com/ads/library/?id=1221134816270580', '1221134816270580', 'Facebook', 'EN-US', 'EN-US', NULL, NULL, 'escalando', NULL, 18.00, NULL, '2025-04-23 23:58:51', '2025-04-23 23:58:51', NULL),
(52, 10, 'criativo 8', 'TAG 1', 'https://www.facebook.com/ads/library/?id=1921271508677924', '1921271508677924', 'Facebook', 'EN-US', 'EN-US', NULL, NULL, 'escalando', NULL, 71.00, NULL, '2025-04-24 00:26:50', '2025-04-24 00:26:50', NULL),
(53, 11, '456200944223290', 'tag1', 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/481714240_1140965354192648_8239256210615590023_n.mp4?_nc_cat=105&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=Wx2C0wmNKxcQ7kNvwG4OTsE&_nc_oc=AdkrBXjztbMOdy_BaO-W-K8uIC09nPFgdggrTtbExikUszdHBMEXD3ZjTdxVQDsbMX0&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=TMtYlRkzdlC5pLyMEZ_SzQ&oh=00_AfEEbmoIjNXX5IDTtwjqj4jNEWAUQKLcEjwDZ8qVk25t2A&oe=68101D31', '456200944223290', 'Facebook', 'ES', 'ES', NULL, NULL, 'escalando', NULL, 18.00, NULL, '2025-04-24 16:58:55', '2025-04-24 18:24:18', NULL),
(54, 11, '1726035744936115', 'tag1', 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/486681609_1206728174414972_2539658095934896296_n.mp4?_nc_cat=105&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=fw7oSh_tboIQ7kNvwEp_6Zt&_nc_oc=AdnCgrZGK-7Z0w60D8qSoll8A9EDIVJthcljWsKAAql_YCppmggfCWMOh1VwspVqHPM&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=TMtYlRkzdlC5pLyMEZ_SzQ&oh=00_AfFCLUB7xCcpdfIpoWIB5s6ZGwHR8yzgsfuQt0qgzPAshA&oe=68101353', '1726035744936115', 'Facebook', 'ES', 'ES', NULL, NULL, 'escalando', NULL, 9.00, NULL, '2025-04-24 17:17:59', '2025-04-24 18:25:13', NULL),
(55, 11, '641498758800572', 'Emagrecimento', 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/489964997_1020637803598837_6797726982219995216_n.mp4?_nc_cat=110&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=nhMmWsknxUAQ7kNvwFWQYug&_nc_oc=Adlakm5VGJyV63J2RUmPmWg6w1yugWs9uGnUtlgUYZr-soj4Fapt2v02toBiGppuQJE&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=TMtYlRkzdlC5pLyMEZ_SzQ&oh=00_AfFCMGdSSjEAFfGpL6HVbVQvWQTMVPcV4GR-UiRFI8XYsQ&oe=681018AF', '641498758800572', 'Instagram', 'ES', 'ES', NULL, NULL, 'escalando', NULL, 3.00, NULL, '2025-04-24 18:16:43', '2025-04-24 18:16:43', NULL),
(56, 11, '644835325205644', 'Emagrecimento', 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/490041276_1840705306775852_9177073756985558754_n.mp4?_nc_cat=102&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=taj--ixLPtkQ7kNvwFpeYjq&_nc_oc=Adnf8cYIcATEav4qjskA8b6oFz4-AIlP9aw9OtShtxHxbBnhDReFZpkj-hPrhBwTIbQ&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=TMtYlRkzdlC5pLyMEZ_SzQ&oh=00_AfEBQsdCYLFxAqENOVYyh_aGL1iVxisy5mkbItF7nWE2zg&oe=680FF955', '644835325205644', 'Facebook', 'ES', 'ES', NULL, NULL, 'escalando', NULL, 6.00, NULL, '2025-04-24 18:19:29', '2025-04-24 18:19:29', NULL),
(57, 11, '1056278359890509', 'Emagrecimento', 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491552422_1171724230911981_7945159231662979518_n.mp4?_nc_cat=109&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=Y6C1_83Cu2kQ7kNvwGALvqF&_nc_oc=AdlwI6U6gN4YvcewE60jYjOVPAjG6pTvrvYCaOLZx5ia8ZgsbS_IZJ6xepvb7t5mBA8&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=TMtYlRkzdlC5pLyMEZ_SzQ&oh=00_AfEDnuHyZeHg1FsQ1pBkcCZcYVRcJAwH8UNNkxFL5UUdpQ&oe=6810019F', '1056278359890509', 'Facebook', 'ES', 'ES', NULL, NULL, 'escalando', NULL, 6.00, NULL, '2025-04-24 18:21:42', '2025-04-24 18:21:42', NULL),
(58, 11, '649769777976293', 'Emagrecimento', 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/491561512_1041334227849670_888839798819333152_n.mp4?_nc_cat=109&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=xAa-u7ZPd3sQ7kNvwGuHhM7&_nc_oc=AdnEZgx2s981594HjmOe5Mlel8b81v5wFP8M-HOZJsTyZBt7F2o7n3oaCiey-yXBIQo&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=gbrELacJ0Dj-TNYhDpaMPg&oh=00_AfF6YvAVQ9ye_ueZoQEEDX4B5_YMA0Cdi9USf0EdVmFRfw&oe=68101B82', '649769777976293', 'Facebook', 'ES', 'ES', NULL, NULL, 'escalando', NULL, 3.00, NULL, '2025-04-24 18:22:49', '2025-04-24 18:22:49', NULL),
(59, 11, '1022632452557395', 'Emagrecimento', 'https://video.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/481714240_1140965354192648_8239256210615590023_n.mp4?_nc_cat=105&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=Wx2C0wmNKxcQ7kNvwG4OTsE&_nc_oc=AdkrBXjztbMOdy_BaO-W-K8uIC09nPFgdggrTtbExikUszdHBMEXD3ZjTdxVQDsbMX0&_nc_zt=28&_nc_ht=video.fnvt5-1.fna&_nc_gid=TMtYlRkzdlC5pLyMEZ_SzQ&oh=00_AfEEbmoIjNXX5IDTtwjqj4jNEWAUQKLcEjwDZ8qVk25t2A&oe=68101D31', '1022632452557395', 'Facebook', 'ES', 'ES', NULL, NULL, 'escalando', NULL, 3.00, NULL, '2025-04-24 18:23:29', '2025-04-24 18:23:29', NULL),
(60, 12, '1240204624133353', 'Emagrecimento', 'https://drive.google.com/file/d/1pbwP5Nb7vd1v2BQpz68BAl7NWflWxa8D/view?usp=drive_link', '1240204624133353', 'Facebook', 'PT-BR', 'PT-BR', 'criativos/1745512716_492734587_1658840044837294_5980036008640722891_n.jpeg', NULL, 'escalando', NULL, 2.00, NULL, '2025-04-24 19:38:36', '2025-04-24 19:38:36', NULL),
(61, 12, '1071363228161474', 'Emagrecimento', 'https://l.facebook.com/l.php?u=https%3A%2F%2Flp1.secajejum.com%2F&h=AT1goTj7jCx7Uya7F4aRl566fK-izrarqmK_EMcx5b_jhxKlGUMwHbPZZnF7IUXG8DyOUVz-EEhiS3pa2IgLVvLrunWC6UM5auNBlG9b4dXu4Ny5HSbHiUl19QfuGJXYtYzwSE6GADiTRBlfZ8fpaQ', '1071363228161474', 'Facebook', 'PT-BR', 'PT-BR', 'criativos/1745513006_487729540_655094810583215_7465049261066391472_n.jpeg', NULL, 'escalando', NULL, 4.00, NULL, '2025-04-24 19:43:26', '2025-04-24 19:43:26', NULL),
(62, 12, '9435083423226473', 'Emagrecimento', 'https://l.facebook.com/l.php?u=https%3A%2F%2Flp1.secajejum.com%2F&h=AT1goTj7jCx7Uya7F4aRl566fK-izrarqmK_EMcx5b_jhxKlGUMwHbPZZnF7IUXG8DyOUVz-EEhiS3pa2IgLVvLrunWC6UM5auNBlG9b4dXu4Ny5HSbHiUl19QfuGJXYtYzwSE6GADiTRBlfZ8fpaQ', '9435083423226473', 'Facebook', 'PT-BR', 'PT-BR', 'criativos/1745513085_487729540_655094810583215_7465049261066391472_n (1).jpeg', NULL, 'escalando', NULL, 8.00, NULL, '2025-04-24 19:44:45', '2025-04-24 19:44:45', NULL),
(63, 12, '2083132362200674', 'Emagrecimento', 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t39.35426-6/475801384_3469827456647078_4191286299156966640_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=108&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=Id5LNnwPKAUQ7kNvwEiDnS0&_nc_oc=AdmfJSAANmWjhFpXGhWOyPXOnkuir_f8tMRO903EspxPxdaJcrxArzPlK-zp0BTkzSo&_nc_zt=14&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=W7VF2UxMcjRf6_fYK9J8Tg&oh=00_AfGA9mn8aUKv_ch-tY5ms3gkUwU4lL3vnjPCgohb870lmg&oe=681044EF', '2083132362200674', 'Facebook', 'PT-BR', 'PT-BR', 'criativos/1745513156_475801384_3469827456647078_4191286299156966640_n.jpeg', NULL, 'escalando', NULL, 14.00, NULL, '2025-04-24 19:45:56', '2025-04-24 19:45:56', NULL),
(64, 1, 'Cicero Alves Voz de Respeito', 'Violao', 'https://scontent.fnvt5-1.fna.fbcdn.net/v/t42.1790-2/486753343_729154052940960_504758242126468194_n.mp4?_nc_cat=110&ccb=1-7&_nc_sid=c53f8f&_nc_ohc=Vd2DnXmMhvUQ7kNvwGmOytZ&_nc_oc=AdnUqSvV_zhEZ1a7pRTgFAaHSriIQMg_u1Wia-GBgO3szNwyXR6zCByL_4Iq4se8SK0&_nc_zt=28&_nc_ht=scontent.fnvt5-1.fna&_nc_gid=dCsu-3VKnh7AljckX-Jduw&oh=00_AfGdAXmOh6b8WBVCAINiPXeEkeC8Dj2VJK9pJvqizv1Ybg&oe=680F3BD3', '1392701158587273', 'Facebook', 'PT-BR', 'PT-BR', NULL, 'Transforme sua voz em menos de 7 dias! Se quer uma voz grave, forte e imponente, eu posso te ajudar. Conheça o Método Voz e Respeito e conquiste uma voz de respeito.', 'escalando', NULL, 9.00, NULL, '2025-04-26 16:47:33', '2025-04-26 16:47:33', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `expense_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_06_24_075421_create_buy_plans_table', 1),
(7, '2024_06_26_105712_add_fields_to_users', 1),
(8, '2024_06_29_080023_create_subscriptions_table', 1),
(9, '2024_07_04_053557_create_video_details_table', 1),
(10, '2024_07_04_162648_create_broad_cast_thumbnails_table', 1),
(11, '2024_07_19_112114_create_permission_tables', 1),
(12, '2024_07_24_081118_create_pay_pal_plans_table', 1),
(13, '2024_07_27_113411_create_broad_cast_comments_table', 1),
(14, '2024_07_27_114204_create_comment_frequencies_table', 1),
(18, '2024_01_13_000001_create_template_views_table', 2),
(19, '2024_01_13_000002_create_view_billing_records_table', 2),
(20, '2024_01_13_000003_add_stripe_id_to_users_table', 2),
(21, '2024_12_23_173527_add_tracking_pixels_to_users_table', 2),
(22, '2025_01_13_193500_update_pay_pal_plans_table', 3),
(23, '2025_01_13_233400_update_plan_limits', 4),
(24, '2025_01_14_000001_update_views_limits_in_pay_pal_plans', 5),
(25, '2025_01_14_000002_set_views_limits_values', 5),
(26, '2025_01_14_000003_fix_views_limits_values', 6),
(27, '2025_01_14_000004_ensure_correct_views_limits', 6),
(28, '2025_01_14_025227_update_subscription_views_limits', 6),
(29, '2025_01_14_154037_create_view_statistics_table', 7),
(30, '2024_01_14_195500_modify_template_id_in_view_statistics', 8),
(31, '2024_01_14_195700_update_template_id_in_view_statistics', 9),
(32, '2025_01_15_194900_create_notifications_table', 10),
(34, '2025_01_16_193500_add_indexes_to_view_tables', 11),
(35, '2025_01_16_212244_add_user_agent_to_view_statistics', 11),
(36, '2025_01_16_create_templates_table', 11),
(37, '2025_01_16_create_user_billing_controls_table', 11),
(38, '2025_01_16_create_view_billing_records_table', 12),
(39, '2025_01_20_005645_create_view_statistics_table', 12),
(40, '2025_01_20_add_gold_plan', 13),
(41, '2025_02_15_214930_add_template_type_to_video_details', 14),
(42, '2025_02_20_173905_update_template_type_values', 15),
(43, '2024_02_27_183200_add_platform_column_to_broadcast_comments', 16),
(44, '2025_03_04_142329_add_template_type_to_video_details_if_not_exists', 17),
(45, '2025_03_04_115400_ensure_template_type_values', 18),
(46, '2025_03_05_212119_add_vsl_time_to_comment_frequencies_table', 19),
(47, '2025_03_06_014145_add_amount_and_description_to_view_billing_records', 20),
(48, '2025_03_12_000000_create_expenses_table', 21),
(49, '2025_03_12_210000_add_test_countries_to_view_statistics', 22),
(50, '2025_03_13_000000_create_user_sessions_table', 23),
(51, '2025_03_27_000000_create_anuncios_table', 24),
(52, '2025_03_27_000001_create_criativos_table', 24),
(53, '2024_03_26_235900_create_anuncios_table', 25),
(54, '2024_03_26_235901_create_criativos_table', 25),
(55, '2025_03_27_000002_create_anuncios_table_safe', 26),
(56, '2025_03_27_000003_alter_anuncios_table_safe', 27),
(57, '2025_03_28_000002_update_criativos_table_add_fields', 28),
(58, '2025_03_28_000003_update_anuncios_table_add_fields_safe', 29),
(59, '2024_04_02_000000_add_performance_status_to_criativos', 30),
(60, '2025_03_31_143500_safely_update_image_field_in_criativos', 31),
(61, '2025_03_31_144000_unify_creative_count_fields', 32),
(63, '2025_03_28_000004_safely_convert_variacao_fields_to_integer', 33),
(64, '2025_03_28_000007_fix_variacao_fields', 34),
(65, '2025_03_28_000005_verify_variacao_fields_conversion', 35),
(67, '2025_04_01_173000_modify_transcricao_to_link', 36),
(68, '2025_04_26_181809_update_criativos_status_enum', 37),
(69, '2025_04_28_165909_update_platform_column_in_criativos_table', 38),
(70, '2025_04_28_194936_alter_tag_principal_column_in_anuncios_table', 39);

-- --------------------------------------------------------

--
-- Estrutura para tabela `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 8),
(2, 'App\\Models\\User', 9),
(2, 'App\\Models\\User', 10),
(2, 'App\\Models\\User', 11),
(2, 'App\\Models\\User', 29),
(2, 'App\\Models\\User', 30),
(2, 'App\\Models\\User', 31),
(2, 'App\\Models\\User', 32),
(2, 'App\\Models\\User', 34),
(2, 'App\\Models\\User', 35),
(2, 'App\\Models\\User', 36),
(2, 'App\\Models\\User', 37),
(2, 'App\\Models\\User', 38),
(2, 'App\\Models\\User', 39),
(2, 'App\\Models\\User', 40),
(2, 'App\\Models\\User', 41),
(2, 'App\\Models\\User', 42),
(2, 'App\\Models\\User', 43),
(2, 'App\\Models\\User', 44),
(2, 'App\\Models\\User', 45),
(2, 'App\\Models\\User', 46),
(2, 'App\\Models\\User', 47),
(2, 'App\\Models\\User', 85),
(2, 'App\\Models\\User', 90),
(2, 'App\\Models\\User', 96),
(2, 'App\\Models\\User', 97),
(2, 'App\\Models\\User', 98),
(2, 'App\\Models\\User', 99),
(2, 'App\\Models\\User', 100),
(2, 'App\\Models\\User', 101),
(2, 'App\\Models\\User', 102),
(2, 'App\\Models\\User', 116),
(2, 'App\\Models\\User', 119),
(2, 'App\\Models\\User', 121),
(2, 'App\\Models\\User', 122),
(2, 'App\\Models\\User', 125),
(2, 'App\\Models\\User', 126),
(2, 'App\\Models\\User', 127),
(2, 'App\\Models\\User', 128),
(2, 'App\\Models\\User', 129),
(2, 'App\\Models\\User', 130),
(2, 'App\\Models\\User', 131),
(2, 'App\\Models\\User', 132),
(2, 'App\\Models\\User', 133),
(2, 'App\\Models\\User', 134),
(2, 'App\\Models\\User', 135),
(2, 'App\\Models\\User', 143),
(2, 'App\\Models\\User', 144),
(2, 'App\\Models\\User', 145),
(2, 'App\\Models\\User', 146),
(2, 'App\\Models\\User', 147),
(2, 'App\\Models\\User', 148),
(2, 'App\\Models\\User', 149),
(2, 'App\\Models\\User', 150),
(2, 'App\\Models\\User', 151),
(2, 'App\\Models\\User', 153),
(2, 'App\\Models\\User', 156),
(2, 'App\\Models\\User', 157),
(2, 'App\\Models\\User', 158),
(2, 'App\\Models\\User', 159),
(2, 'App\\Models\\User', 160),
(2, 'App\\Models\\User', 161),
(2, 'App\\Models\\User', 162),
(2, 'App\\Models\\User', 163),
(2, 'App\\Models\\User', 164),
(2, 'App\\Models\\User', 165),
(2, 'App\\Models\\User', 166),
(2, 'App\\Models\\User', 167),
(2, 'App\\Models\\User', 168),
(2, 'App\\Models\\User', 169),
(2, 'App\\Models\\User', 170),
(2, 'App\\Models\\User', 171),
(2, 'App\\Models\\User', 172),
(2, 'App\\Models\\User', 173),
(2, 'App\\Models\\User', 174),
(2, 'App\\Models\\User', 175),
(2, 'App\\Models\\User', 176),
(2, 'App\\Models\\User', 177),
(2, 'App\\Models\\User', 178),
(2, 'App\\Models\\User', 179),
(2, 'App\\Models\\User', 180),
(2, 'App\\Models\\User', 181),
(2, 'App\\Models\\User', 182),
(2, 'App\\Models\\User', 183),
(2, 'App\\Models\\User', 184),
(2, 'App\\Models\\User', 185),
(2, 'App\\Models\\User', 186),
(2, 'App\\Models\\User', 187),
(2, 'App\\Models\\User', 188),
(2, 'App\\Models\\User', 189),
(2, 'App\\Models\\User', 190),
(2, 'App\\Models\\User', 191),
(2, 'App\\Models\\User', 192),
(2, 'App\\Models\\User', 193),
(2, 'App\\Models\\User', 194),
(2, 'App\\Models\\User', 195),
(2, 'App\\Models\\User', 196),
(2, 'App\\Models\\User', 197),
(2, 'App\\Models\\User', 198),
(2, 'App\\Models\\User', 199),
(2, 'App\\Models\\User', 200),
(2, 'App\\Models\\User', 201),
(2, 'App\\Models\\User', 202),
(2, 'App\\Models\\User', 203),
(2, 'App\\Models\\User', 204),
(2, 'App\\Models\\User', 205),
(2, 'App\\Models\\User', 206),
(2, 'App\\Models\\User', 207),
(2, 'App\\Models\\User', 208),
(2, 'App\\Models\\User', 209),
(2, 'App\\Models\\User', 210),
(2, 'App\\Models\\User', 211),
(2, 'App\\Models\\User', 212),
(2, 'App\\Models\\User', 213),
(2, 'App\\Models\\User', 214),
(2, 'App\\Models\\User', 215),
(2, 'App\\Models\\User', 216),
(2, 'App\\Models\\User', 217),
(2, 'App\\Models\\User', 218),
(2, 'App\\Models\\User', 219),
(2, 'App\\Models\\User', 220),
(2, 'App\\Models\\User', 221),
(2, 'App\\Models\\User', 222),
(2, 'App\\Models\\User', 223),
(2, 'App\\Models\\User', 224),
(2, 'App\\Models\\User', 225),
(2, 'App\\Models\\User', 226),
(2, 'App\\Models\\User', 227),
(2, 'App\\Models\\User', 228),
(2, 'App\\Models\\User', 229),
(2, 'App\\Models\\User', 230),
(2, 'App\\Models\\User', 231),
(2, 'App\\Models\\User', 232),
(2, 'App\\Models\\User', 233),
(2, 'App\\Models\\User', 234),
(2, 'App\\Models\\User', 235),
(2, 'App\\Models\\User', 236),
(2, 'App\\Models\\User', 237),
(2, 'App\\Models\\User', 238),
(2, 'App\\Models\\User', 239),
(2, 'App\\Models\\User', 240),
(2, 'App\\Models\\User', 241),
(2, 'App\\Models\\User', 242),
(2, 'App\\Models\\User', 243),
(2, 'App\\Models\\User', 244),
(2, 'App\\Models\\User', 245),
(2, 'App\\Models\\User', 246),
(2, 'App\\Models\\User', 247),
(2, 'App\\Models\\User', 248),
(2, 'App\\Models\\User', 249),
(2, 'App\\Models\\User', 250),
(2, 'App\\Models\\User', 251),
(2, 'App\\Models\\User', 252),
(2, 'App\\Models\\User', 253),
(2, 'App\\Models\\User', 254),
(2, 'App\\Models\\User', 255),
(2, 'App\\Models\\User', 256),
(2, 'App\\Models\\User', 257),
(2, 'App\\Models\\User', 258),
(2, 'App\\Models\\User', 259),
(2, 'App\\Models\\User', 260),
(2, 'App\\Models\\User', 261),
(2, 'App\\Models\\User', 262),
(2, 'App\\Models\\User', 263),
(2, 'App\\Models\\User', 264),
(2, 'App\\Models\\User', 265),
(2, 'App\\Models\\User', 266),
(2, 'App\\Models\\User', 267),
(2, 'App\\Models\\User', 268),
(2, 'App\\Models\\User', 269),
(2, 'App\\Models\\User', 270),
(2, 'App\\Models\\User', 271),
(2, 'App\\Models\\User', 272),
(2, 'App\\Models\\User', 273),
(2, 'App\\Models\\User', 274),
(2, 'App\\Models\\User', 275),
(2, 'App\\Models\\User', 276),
(2, 'App\\Models\\User', 277),
(2, 'App\\Models\\User', 278),
(2, 'App\\Models\\User', 279),
(2, 'App\\Models\\User', 280),
(2, 'App\\Models\\User', 281),
(2, 'App\\Models\\User', 282),
(2, 'App\\Models\\User', 283),
(2, 'App\\Models\\User', 284),
(2, 'App\\Models\\User', 285),
(2, 'App\\Models\\User', 286),
(2, 'App\\Models\\User', 287),
(2, 'App\\Models\\User', 288),
(2, 'App\\Models\\User', 289),
(2, 'App\\Models\\User', 290),
(2, 'App\\Models\\User', 291),
(2, 'App\\Models\\User', 292),
(2, 'App\\Models\\User', 293),
(2, 'App\\Models\\User', 294),
(2, 'App\\Models\\User', 295),
(2, 'App\\Models\\User', 296),
(2, 'App\\Models\\User', 297),
(2, 'App\\Models\\User', 298),
(2, 'App\\Models\\User', 299),
(2, 'App\\Models\\User', 300),
(2, 'App\\Models\\User', 301),
(2, 'App\\Models\\User', 302),
(2, 'App\\Models\\User', 303),
(2, 'App\\Models\\User', 304),
(2, 'App\\Models\\User', 305),
(2, 'App\\Models\\User', 306),
(2, 'App\\Models\\User', 307),
(2, 'App\\Models\\User', 308),
(2, 'App\\Models\\User', 309),
(2, 'App\\Models\\User', 310),
(2, 'App\\Models\\User', 311),
(2, 'App\\Models\\User', 312),
(2, 'App\\Models\\User', 313),
(2, 'App\\Models\\User', 314),
(2, 'App\\Models\\User', 315),
(2, 'App\\Models\\User', 316),
(2, 'App\\Models\\User', 317),
(2, 'App\\Models\\User', 318),
(2, 'App\\Models\\User', 319),
(2, 'App\\Models\\User', 320),
(2, 'App\\Models\\User', 321),
(2, 'App\\Models\\User', 322),
(2, 'App\\Models\\User', 323),
(2, 'App\\Models\\User', 324),
(2, 'App\\Models\\User', 325),
(2, 'App\\Models\\User', 326),
(2, 'App\\Models\\User', 327),
(2, 'App\\Models\\User', 328),
(2, 'App\\Models\\User', 329),
(2, 'App\\Models\\User', 330),
(2, 'App\\Models\\User', 331),
(2, 'App\\Models\\User', 332),
(2, 'App\\Models\\User', 333),
(2, 'App\\Models\\User', 334),
(2, 'App\\Models\\User', 335),
(2, 'App\\Models\\User', 336),
(2, 'App\\Models\\User', 337),
(2, 'App\\Models\\User', 338),
(2, 'App\\Models\\User', 339),
(2, 'App\\Models\\User', 340),
(2, 'App\\Models\\User', 341),
(2, 'App\\Models\\User', 342),
(2, 'App\\Models\\User', 343),
(2, 'App\\Models\\User', 344),
(2, 'App\\Models\\User', 345),
(2, 'App\\Models\\User', 346),
(2, 'App\\Models\\User', 347),
(2, 'App\\Models\\User', 348),
(2, 'App\\Models\\User', 349),
(2, 'App\\Models\\User', 350),
(2, 'App\\Models\\User', 351),
(2, 'App\\Models\\User', 352),
(2, 'App\\Models\\User', 353),
(2, 'App\\Models\\User', 354),
(2, 'App\\Models\\User', 355),
(2, 'App\\Models\\User', 356),
(2, 'App\\Models\\User', 357),
(2, 'App\\Models\\User', 358),
(2, 'App\\Models\\User', 359),
(2, 'App\\Models\\User', 360),
(2, 'App\\Models\\User', 361),
(2, 'App\\Models\\User', 362),
(2, 'App\\Models\\User', 363),
(2, 'App\\Models\\User', 364),
(2, 'App\\Models\\User', 365),
(2, 'App\\Models\\User', 366),
(2, 'App\\Models\\User', 367),
(2, 'App\\Models\\User', 368),
(2, 'App\\Models\\User', 369),
(2, 'App\\Models\\User', 370),
(2, 'App\\Models\\User', 371),
(2, 'App\\Models\\User', 372),
(2, 'App\\Models\\User', 373),
(2, 'App\\Models\\User', 374),
(2, 'App\\Models\\User', 375),
(2, 'App\\Models\\User', 376),
(2, 'App\\Models\\User', 377),
(2, 'App\\Models\\User', 378),
(2, 'App\\Models\\User', 379),
(2, 'App\\Models\\User', 380),
(2, 'App\\Models\\User', 381),
(2, 'App\\Models\\User', 382),
(2, 'App\\Models\\User', 383),
(2, 'App\\Models\\User', 384),
(2, 'App\\Models\\User', 385),
(2, 'App\\Models\\User', 386),
(2, 'App\\Models\\User', 387),
(2, 'App\\Models\\User', 388),
(2, 'App\\Models\\User', 389),
(2, 'App\\Models\\User', 390),
(2, 'App\\Models\\User', 391),
(2, 'App\\Models\\User', 392),
(2, 'App\\Models\\User', 393),
(2, 'App\\Models\\User', 394),
(2, 'App\\Models\\User', 395),
(2, 'App\\Models\\User', 396),
(2, 'App\\Models\\User', 397),
(2, 'App\\Models\\User', 398),
(2, 'App\\Models\\User', 399),
(2, 'App\\Models\\User', 400),
(2, 'App\\Models\\User', 401),
(2, 'App\\Models\\User', 402),
(2, 'App\\Models\\User', 403),
(2, 'App\\Models\\User', 404),
(2, 'App\\Models\\User', 405),
(2, 'App\\Models\\User', 406),
(2, 'App\\Models\\User', 407),
(2, 'App\\Models\\User', 408),
(2, 'App\\Models\\User', 409),
(2, 'App\\Models\\User', 410),
(2, 'App\\Models\\User', 411),
(2, 'App\\Models\\User', 412),
(2, 'App\\Models\\User', 413),
(2, 'App\\Models\\User', 414),
(2, 'App\\Models\\User', 415),
(2, 'App\\Models\\User', 416),
(2, 'App\\Models\\User', 417),
(2, 'App\\Models\\User', 418),
(2, 'App\\Models\\User', 419),
(2, 'App\\Models\\User', 420),
(2, 'App\\Models\\User', 421),
(2, 'App\\Models\\User', 422),
(2, 'App\\Models\\User', 423),
(2, 'App\\Models\\User', 424),
(2, 'App\\Models\\User', 425),
(2, 'App\\Models\\User', 426),
(2, 'App\\Models\\User', 427),
(2, 'App\\Models\\User', 428),
(2, 'App\\Models\\User', 429),
(2, 'App\\Models\\User', 430),
(2, 'App\\Models\\User', 431),
(2, 'App\\Models\\User', 432),
(2, 'App\\Models\\User', 433),
(2, 'App\\Models\\User', 434),
(2, 'App\\Models\\User', 435),
(2, 'App\\Models\\User', 436),
(2, 'App\\Models\\User', 437),
(2, 'App\\Models\\User', 438),
(2, 'App\\Models\\User', 439),
(2, 'App\\Models\\User', 440),
(2, 'App\\Models\\User', 441),
(2, 'App\\Models\\User', 442),
(2, 'App\\Models\\User', 443),
(2, 'App\\Models\\User', 444),
(2, 'App\\Models\\User', 445),
(2, 'App\\Models\\User', 446),
(2, 'App\\Models\\User', 447),
(2, 'App\\Models\\User', 448),
(2, 'App\\Models\\User', 449),
(2, 'App\\Models\\User', 450),
(2, 'App\\Models\\User', 451),
(2, 'App\\Models\\User', 452),
(2, 'App\\Models\\User', 453),
(2, 'App\\Models\\User', 454),
(2, 'App\\Models\\User', 455),
(2, 'App\\Models\\User', 456),
(2, 'App\\Models\\User', 457),
(2, 'App\\Models\\User', 458),
(2, 'App\\Models\\User', 459),
(2, 'App\\Models\\User', 460),
(2, 'App\\Models\\User', 461),
(2, 'App\\Models\\User', 462),
(2, 'App\\Models\\User', 463),
(2, 'App\\Models\\User', 464),
(2, 'App\\Models\\User', 465),
(2, 'App\\Models\\User', 466),
(2, 'App\\Models\\User', 467),
(2, 'App\\Models\\User', 468),
(2, 'App\\Models\\User', 469),
(2, 'App\\Models\\User', 470),
(2, 'App\\Models\\User', 471),
(2, 'App\\Models\\User', 472),
(2, 'App\\Models\\User', 473),
(2, 'App\\Models\\User', 474),
(2, 'App\\Models\\User', 475),
(2, 'App\\Models\\User', 476),
(2, 'App\\Models\\User', 477),
(2, 'App\\Models\\User', 478),
(2, 'App\\Models\\User', 479),
(2, 'App\\Models\\User', 480),
(2, 'App\\Models\\User', 481),
(2, 'App\\Models\\User', 482),
(2, 'App\\Models\\User', 483),
(2, 'App\\Models\\User', 484),
(2, 'App\\Models\\User', 485),
(2, 'App\\Models\\User', 486),
(2, 'App\\Models\\User', 487),
(2, 'App\\Models\\User', 488),
(2, 'App\\Models\\User', 489),
(2, 'App\\Models\\User', 490),
(2, 'App\\Models\\User', 491),
(2, 'App\\Models\\User', 492),
(2, 'App\\Models\\User', 493),
(2, 'App\\Models\\User', 494),
(2, 'App\\Models\\User', 495),
(2, 'App\\Models\\User', 496),
(2, 'App\\Models\\User', 497),
(2, 'App\\Models\\User', 498),
(2, 'App\\Models\\User', 499),
(2, 'App\\Models\\User', 500),
(2, 'App\\Models\\User', 501),
(2, 'App\\Models\\User', 502),
(2, 'App\\Models\\User', 503),
(2, 'App\\Models\\User', 504),
(2, 'App\\Models\\User', 505),
(2, 'App\\Models\\User', 506),
(2, 'App\\Models\\User', 507),
(2, 'App\\Models\\User', 508),
(2, 'App\\Models\\User', 509),
(2, 'App\\Models\\User', 510),
(2, 'App\\Models\\User', 511),
(2, 'App\\Models\\User', 512),
(2, 'App\\Models\\User', 513),
(2, 'App\\Models\\User', 514),
(2, 'App\\Models\\User', 515),
(2, 'App\\Models\\User', 516),
(2, 'App\\Models\\User', 517),
(2, 'App\\Models\\User', 518),
(2, 'App\\Models\\User', 519),
(2, 'App\\Models\\User', 520),
(2, 'App\\Models\\User', 521),
(2, 'App\\Models\\User', 522),
(2, 'App\\Models\\User', 523),
(2, 'App\\Models\\User', 524),
(2, 'App\\Models\\User', 525),
(2, 'App\\Models\\User', 526),
(2, 'App\\Models\\User', 527),
(2, 'App\\Models\\User', 528),
(2, 'App\\Models\\User', 529),
(2, 'App\\Models\\User', 530),
(2, 'App\\Models\\User', 531),
(2, 'App\\Models\\User', 532),
(2, 'App\\Models\\User', 533),
(2, 'App\\Models\\User', 534),
(2, 'App\\Models\\User', 535),
(2, 'App\\Models\\User', 536),
(2, 'App\\Models\\User', 537),
(2, 'App\\Models\\User', 538),
(2, 'App\\Models\\User', 539),
(2, 'App\\Models\\User', 540),
(2, 'App\\Models\\User', 541),
(2, 'App\\Models\\User', 542),
(2, 'App\\Models\\User', 543);

-- --------------------------------------------------------

--
-- Estrutura para tabela `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('help@liveturb.com', '$2y$10$gCBrT2puc8W7sfKpnVgjVO6VV9jjIHSVBF55abHHQkLLJxWAG5dvK', '2024-12-21 22:03:53');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pay_pal_plans`
--

CREATE TABLE `pay_pal_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `plan_key` varchar(255) NOT NULL,
  `stripe_plan_key` varchar(255) DEFAULT NULL,
  `comment_limit` int(11) DEFAULT NULL,
  `template_limit` int(11) NOT NULL DEFAULT 1,
  `extra_view_cost` decimal(8,2) NOT NULL DEFAULT 0.02,
  `step` int(11) DEFAULT NULL,
  `price` double NOT NULL,
  `limit` int(11) NOT NULL,
  `views_limit` int(11) NOT NULL DEFAULT 0,
  `duration` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `pay_pal_plans`
--

INSERT INTO `pay_pal_plans` (`id`, `uuid`, `name`, `plan_key`, `stripe_plan_key`, `comment_limit`, `template_limit`, `extra_view_cost`, `step`, `price`, `limit`, `views_limit`, `duration`, `created_at`, `updated_at`) VALUES
(1, '6bc0595a-f99b-45f0-9840-1b223603286d', 'Basic', 'prod_QyZuKbLBSA733h', 'price_1Q6ckf05Tnxo1YAkO4WJgAsr', 180, 1, 0.02, 1, 97, 1, 6000, 1, '2024-08-19 07:31:21', '2025-04-28 16:29:26'),
(2, '313892f0-e4e9-4a7b-8927-ddd15f803879', 'Standard', 'prod_QyZvquJR35WFgp', 'price_1Q6clN05Tnxo1YAkoWFVz6cO', 240, 1, 0.02, 2, 297, 2, 25000, 1, '2024-08-19 07:31:21', '2025-04-28 16:30:06'),
(3, '4445d507-5a66-4dda-83de-a660878e1274', 'Premium', 'prod_QyZwsGcQ5tm97l', 'price_1Q6cmE05Tnxo1YAkV9EzA5g1', 370, 1, 0.02, 3, 597, 3, 50000, 1, '2024-08-19 07:31:21', '2025-04-28 16:30:39');

-- --------------------------------------------------------

--
-- Estrutura para tabela `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2024-08-19 07:31:21', '2024-08-19 07:31:21'),
(2, 'user', 'web', '2024-08-19 07:31:21', '2024-08-19 07:31:21');

-- --------------------------------------------------------

--
-- Estrutura para tabela `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `paypal_id` varchar(255) DEFAULT NULL,
  `stripe_id` varchar(255) DEFAULT NULL,
  `mercadopago_id` varchar(255) DEFAULT NULL,
  `status` enum('PENDING','ACTIVE','EXPIRE','REJECTED','CANCELLED') NOT NULL DEFAULT 'PENDING',
  `plan_id` varchar(255) DEFAULT NULL,
  `start_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `expire_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `user_id`, `paypal_id`, `stripe_id`, `mercadopago_id`, `status`, `plan_id`, `start_time`, `expire_date`, `created_at`, `updated_at`) VALUES
(100, 147, NULL, 'cs_test_a1iSeVrazzjMCR49MNQkLa6yCjoIpG6scTKPnRnhVoNaGRaFegyQD1U3Ii', NULL, 'ACTIVE', '3', '2025-03-11 19:47:10', '2025-03-11 19:47:10', '2024-12-14 04:37:29', '2025-03-11 22:47:10'),
(103, 151, NULL, 'cs_test_a1leyEbH6RfMgjRaIg6xQx647CoxcW1Btx9u3U7lF7cnQHoBptyfMu70qP', NULL, 'ACTIVE', '1', '2025-03-11 19:57:13', '2025-03-11 19:57:13', '2025-03-07 21:39:51', '2025-03-11 22:57:13'),
(105, 153, NULL, NULL, NULL, 'ACTIVE', '1', '2025-03-12 18:36:09', '2025-04-12 18:36:09', '2025-03-12 18:36:09', '2025-03-12 18:36:09'),
(107, 156, NULL, 'cs_live_a18uQ5JmbRvYFaQKKNp08jcWJPG8l8uclFcOu6hs2uYTTPdedVVqdlSzsd', NULL, 'ACTIVE', '1', '2025-05-03 00:27:29', '2025-06-03 03:24:44', '2025-05-03 03:24:44', '2025-05-03 03:27:29'),
(108, 157, NULL, 'cs_live_a16F7Iq5ZUPz04P3Y0kK3XFr8oVfqt2OCBAoZ7gI64kcRvFw2PQq8LUoup', NULL, 'PENDING', '1', '2025-05-03 20:17:10', '2025-06-03 20:17:10', '2025-05-03 20:17:10', '2025-05-03 20:17:10');

-- --------------------------------------------------------

--
-- Estrutura para tabela `templates`
--

CREATE TABLE `templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `template_views`
--

CREATE TABLE `template_views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `template_id` bigint(20) UNSIGNED NOT NULL,
  `viewer_ip` varchar(255) DEFAULT NULL,
  `viewer_session` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `is_charged` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `template_views`
--

INSERT INTO `template_views` (`id`, `user_id`, `template_id`, `viewer_ip`, `viewer_session`, `user_agent`, `is_charged`, `created_at`, `updated_at`) VALUES
(46024, 147, 53, '127.0.0.1', 'uVYtcrbr9ZwhaSh5mkzlrrCoLD5xwi1BEFL5vmzM', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 0, NULL, NULL),
(46025, 147, 53, '127.0.0.1', 'uVYtcrbr9ZwhaSh5mkzlrrCoLD5xwi1BEFL5vmzM', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 0, NULL, NULL),
(46026, 147, 53, '127.0.0.1', 'LvNN6qxi5hrF6dRjzVVpUe6NmpQMBJOJUEmLPsYZ', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 0, NULL, NULL),
(46027, 147, 53, '127.0.0.1', 'qpVTsmCATeOZewygCMgwyPKndQ1JRhmkOwnJSxsH', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 0, NULL, NULL),
(46028, 147, 53, '127.0.0.1', 'JvsFgCHLVlhNN7VaDEajhUTRb4pVTFpG6JPjNkBs', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `temp_transcricoes`
--

CREATE TABLE `temp_transcricoes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `anuncio_id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `conteudo` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stripe_id` varchar(255) DEFAULT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','active','blocked','expired') NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `facebook_pixel` text DEFAULT NULL,
  `google_ads_pixel` text DEFAULT NULL,
  `tiktok_pixel` text DEFAULT NULL,
  `profile_picture_path` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_ip` varchar(255) DEFAULT NULL,
  `device_fingerprint` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `stripe_id`, `uuid`, `name`, `email`, `email_verified_at`, `status`, `password`, `profile_picture`, `facebook_pixel`, `google_ads_pixel`, `tiktok_pixel`, `profile_picture_path`, `remember_token`, `created_at`, `updated_at`, `last_ip`, `device_fingerprint`) VALUES
(1, NULL, 'cc68a98c-4601-4e83-8826-f7f2b101de51', 'admin', 'help@liveturb.com', NULL, 'pending', '$2y$10$TWgsGQgselmLDpsl0HO7ZO0SCeaFVpsXHAbXBFOzyWGHS0hVcsFWK', NULL, NULL, NULL, NULL, NULL, '2cjOhvaRUyfcGBMjwIB9Z6oUiAcKw3Tvmw6BmTHiZchsHfG8bwsx3qN8TBAZ', '2024-08-19 07:31:21', '2024-08-19 07:31:21', NULL, NULL),
(147, NULL, '65d59757-bf8a-4aeb-9509-d389d9eb130c', 'Antonio Monteiro', 'antoniojhuliene@gmail.com', NULL, 'active', '$2y$10$zYICAax21fuIC8bBjbE6MuZixTBNlPa/yliHPKl5UUVdtBtzEwxuS', '02.jpg', NULL, NULL, NULL, 'profile_picture/TGIpIBzxvxpyPemUhRDPbS2QD4ehNpf6OzQB6pvX.jpg', 'S19OvgzNhKsE3AQvIes64i5lFNahHKrHUWmMk2EOkgitWPVXeWkzTmDLC9a3', '2024-12-14 04:37:28', '2025-03-11 22:47:20', NULL, NULL),
(151, NULL, '46800a2e-e4d7-4ef3-947b-72c12949004b', 'jhuliene carolina monteiro', 'jhuliene.monteiro@icloud.com', NULL, 'active', '$2y$10$LJHF3kP2LMgyg6H2aT8QJeZLibhDRww44PtD5jRsojL5l0e8CQ4hu', NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-07 21:39:48', '2025-03-12 18:28:39', NULL, NULL),
(153, NULL, '845c4a72-78c9-498b-a9b1-3b8cf928ab20', 'teste assistencia', 'assistenciatv@gmail.com', NULL, 'active', '$2y$10$bnWK/m40E.3xHxlWIGrvDOZ44hJgxRz551gXfwFlgZPDmwHUGkAre', NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-12 18:36:09', '2025-03-12 18:36:09', NULL, NULL),
(156, NULL, '7b4c5b3e-5e19-4cd1-8d93-a094322802bc', 'Teste stripe', 'testestripe@gmail.com.br', NULL, 'pending', '$2y$10$FiuEuTn/o555H4/8/1oS..Km.f/VEKVeQ52/ry58D9RtOHeu4Kbcm', NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-03 03:24:40', '2025-05-03 03:24:40', NULL, NULL),
(157, NULL, '6e18ab1f-c582-47da-b9af-a400d812ec97', 'dwqe', 'sad@gmail.com', NULL, 'pending', '$2y$10$tmlpIBayc3BBsQNlTEnHJeOWjQ2sRMegdCOezL.NjKnkkwuP5WYqO', NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-03 20:17:09', '2025-05-03 20:17:09', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `user_billing_controls`
--

CREATE TABLE `user_billing_controls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `last_ip` varchar(255) DEFAULT NULL,
  `device_fingerprint` varchar(255) DEFAULT NULL,
  `pending_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `is_blocked` tinyint(1) NOT NULL DEFAULT 0,
  `block_reason` text DEFAULT NULL,
  `last_billing_check` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `user_billing_controls`
--

INSERT INTO `user_billing_controls` (`id`, `user_id`, `last_ip`, `device_fingerprint`, `pending_amount`, `is_blocked`, `block_reason`, `last_billing_check`, `created_at`, `updated_at`) VALUES
(1, 147, '127.0.0.1', 'f51bb482c660d0eeadd1f058058a2b35', 0.00, 0, NULL, NULL, '2025-01-20 03:59:13', '2025-01-21 05:24:39'),
(4, 1, '127.0.0.1', '3fa31b52dd6ebc517e5492d43d77e61c', 0.00, 0, NULL, NULL, '2025-03-13 21:46:46', '2025-03-13 21:46:46');

-- --------------------------------------------------------

--
-- Estrutura para tabela `user_sessions`
--

CREATE TABLE `user_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `last_activity_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `user_sessions`
--

INSERT INTO `user_sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `last_activity_at`, `created_at`, `updated_at`) VALUES
(1, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-14 23:52:31', '2025-03-14 23:21:05', '2025-03-14 23:52:31'),
(2, 147, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-14 23:52:29', '2025-03-14 23:21:21', '2025-03-14 23:52:29'),
(4, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-27 06:48:48', '2025-03-27 05:26:41', '2025-03-27 06:48:48'),
(5, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-27 17:57:03', '2025-03-27 15:16:44', '2025-03-27 17:57:03'),
(6, 151, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-27 16:08:43', '2025-03-27 16:08:28', '2025-03-27 16:08:43'),
(7, 147, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-27 17:53:17', '2025-03-27 17:52:00', '2025-03-27 17:53:17'),
(8, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-28 03:10:51', '2025-03-27 23:56:11', '2025-03-28 03:10:51'),
(9, 147, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-28 00:45:32', '2025-03-27 23:56:33', '2025-03-28 00:45:32'),
(10, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-28 21:39:32', '2025-03-28 17:16:22', '2025-03-28 21:39:32'),
(11, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-29 03:51:45', '2025-03-29 03:51:04', '2025-03-29 03:51:45'),
(12, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-29 22:48:05', '2025-03-29 19:43:55', '2025-03-29 22:48:05'),
(13, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-31 17:36:34', '2025-03-31 15:23:10', '2025-03-31 17:36:34'),
(14, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-01 16:34:29', '2025-04-01 15:47:06', '2025-04-01 16:34:29'),
(15, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-01 21:42:14', '2025-04-01 20:50:20', '2025-04-01 21:42:14'),
(16, 147, '138.59.131.211', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-09 01:13:34', '2025-04-09 00:03:33', '2025-04-09 01:13:34'),
(17, 147, '138.59.131.211', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-09 04:54:02', '2025-04-09 04:54:01', '2025-04-09 04:54:02'),
(18, 147, '138.59.131.211', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-04-10 02:43:45', '2025-04-09 19:07:55', '2025-04-10 02:43:45'),
(19, 1, '138.59.131.211', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-10 05:49:31', '2025-04-09 22:43:15', '2025-04-10 05:49:31'),
(20, 1, '138.59.131.211', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-10 18:22:58', '2025-04-10 17:20:05', '2025-04-10 18:22:58'),
(21, 1, '138.59.131.211', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-11 05:26:51', '2025-04-11 01:39:31', '2025-04-11 05:26:51'),
(22, 147, '138.59.131.211', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-11 05:16:24', '2025-04-11 03:15:36', '2025-04-11 05:16:24'),
(23, 147, '45.5.196.177', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-20 21:24:35', '2025-04-20 19:35:32', '2025-04-20 21:24:35'),
(24, 1, '177.155.207.11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-24 00:44:08', '2025-04-23 21:48:02', '2025-04-24 00:44:08'),
(25, 1, '177.155.207.11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2025-04-24 19:46:00', '2025-04-24 16:13:41', '2025-04-24 19:46:00'),
(26, 147, '177.155.207.11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-24 19:52:45', '2025-04-24 16:59:31', '2025-04-24 19:52:45'),
(27, 147, '177.155.207.11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-25 01:45:32', '2025-04-25 01:41:41', '2025-04-25 01:45:32'),
(28, 1, '177.155.207.11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-25 04:57:03', '2025-04-25 01:45:46', '2025-04-25 04:57:03'),
(29, 1, '177.155.207.11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-25 17:29:28', '2025-04-25 17:11:40', '2025-04-25 17:29:28'),
(30, 147, '177.155.207.11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-25 20:18:31', '2025-04-25 19:42:39', '2025-04-25 20:18:31'),
(31, 147, '177.155.207.11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-26 23:14:38', '2025-04-26 15:56:48', '2025-04-26 23:14:38'),
(32, 1, '177.155.207.11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-27 00:35:04', '2025-04-26 16:44:49', '2025-04-27 00:35:04'),
(33, 1, '177.155.207.11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-29 00:01:18', '2025-04-28 16:18:02', '2025-04-29 00:01:18'),
(34, 147, '177.155.207.11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-04-29 00:06:23', '2025-04-28 17:29:12', '2025-04-29 00:06:23'),
(35, 1, '177.155.207.11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2025-04-29 20:28:54', '2025-04-29 19:52:19', '2025-04-29 20:28:54'),
(36, 1, '177.155.206.66', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '2025-04-30 20:06:05', '2025-04-30 20:05:51', '2025-04-30 20:06:05'),
(37, 147, '177.155.206.66', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-05-01 01:43:19', '2025-05-01 01:42:42', '2025-05-01 01:43:19'),
(38, 1, '177.155.206.66', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-05-01 16:23:20', '2025-05-01 16:23:09', '2025-05-01 16:23:20'),
(39, 1, '177.155.206.66', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-05-02 03:28:41', '2025-05-01 23:51:51', '2025-05-02 03:28:41'),
(40, 147, '177.155.206.66', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-05-02 06:27:16', '2025-05-02 02:25:41', '2025-05-02 06:27:16'),
(41, 147, '177.155.206.66', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-05-02 23:41:49', '2025-05-02 17:32:40', '2025-05-02 23:41:49'),
(42, 1, '177.155.206.66', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-05-02 19:07:38', '2025-05-02 18:59:13', '2025-05-02 19:07:38'),
(43, 1, '177.155.206.66', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-05-03 01:29:21', '2025-05-02 23:50:34', '2025-05-03 01:29:21'),
(44, 156, '179.68.111.193', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-05-03 03:28:49', '2025-05-03 03:27:33', '2025-05-03 03:28:49'),
(45, 1, '177.155.206.66', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '2025-05-03 21:05:15', '2025-05-03 20:41:02', '2025-05-03 21:05:15');

-- --------------------------------------------------------

--
-- Estrutura para tabela `video_details`
--

CREATE TABLE `video_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `user_id` char(36) DEFAULT NULL,
  `details_video_title` varchar(255) NOT NULL,
  `details_video_description` longtext NOT NULL,
  `details_video_shortcode` longtext NOT NULL,
  `details_video_minnum` double NOT NULL,
  `details_video_maxnum` double NOT NULL,
  `template_type` enum('youtube','instagram') NOT NULL DEFAULT 'youtube',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `video_details`
--

INSERT INTO `video_details` (`id`, `uuid`, `user_id`, `details_video_title`, `details_video_description`, `details_video_shortcode`, `details_video_minnum`, `details_video_maxnum`, `template_type`, `created_at`, `updated_at`) VALUES
(68, '26f64d7c-88b3-4d84-97d5-43ea41678a54', '147', '💚 Template instagram', 'Template insta descriçao', '<div id=\"vid_6814111f7554952945a3d564\" style=\"position: relative; width: 100%; padding: 178.21782178217822% 0 0;\"> <img id=\"thumb_6814111f7554952945a3d564\" src=\"https://images.converteai.net/d6d0c206-87ad-4142-bfd9-a5f9e67bf536/players/6814111f7554952945a3d564/thumbnail.jpg\" style=\"position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; display: block;\" alt=\"thumbnail\"> <div id=\"backdrop_6814111f7554952945a3d564\" style=\" -webkit-backdrop-filter: blur(5px); backdrop-filter: blur(5px); position: absolute; top: 0; height: 100%; width: 100%; \"></div> </div> <script type=\"text/javascript\" id=\"scr_6814111f7554952945a3d564\"> var s=document.createElement(\"script\"); s.src=\"https://scripts.converteai.net/d6d0c206-87ad-4142-bfd9-a5f9e67bf536/players/6814111f7554952945a3d564/player.js\", s.async=!0,document.head.appendChild(s); </script>', 6500, 9900, 'instagram', '2025-03-06 05:05:00', '2025-05-02 03:31:57'),
(69, '648b9f1a-db67-439d-b920-94a4f2ed3165', '147', '❤️ YOUTUBE TEMPLATE', 'DESCRIÇAO YOUTUBE TEMPLATE', '<div id=\"vid_681410bc7554952945a3d522\" style=\"position: relative; width: 100%; padding: 56.25% 0 0;\"> <img id=\"thumb_681410bc7554952945a3d522\" src=\"https://images.converteai.net/d6d0c206-87ad-4142-bfd9-a5f9e67bf536/players/681410bc7554952945a3d522/thumbnail.jpg\" style=\"position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; display: block;\" alt=\"thumbnail\"> <div id=\"backdrop_681410bc7554952945a3d522\" style=\" -webkit-backdrop-filter: blur(5px); backdrop-filter: blur(5px); position: absolute; top: 0; height: 100%; width: 100%; \"></div> </div> <script type=\"text/javascript\" id=\"scr_681410bc7554952945a3d522\"> var s=document.createElement(\"script\"); s.src=\"https://scripts.converteai.net/d6d0c206-87ad-4142-bfd9-a5f9e67bf536/players/681410bc7554952945a3d522/player.js\", s.async=!0,document.head.appendChild(s); </script>', 5000, 9700, 'youtube', '2025-03-06 05:11:13', '2025-05-02 03:30:49');

-- --------------------------------------------------------

--
-- Estrutura para tabela `view_billing_records`
--

CREATE TABLE `view_billing_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `billing_period_start` date NOT NULL,
  `billing_period_end` date NOT NULL,
  `total_views` int(11) NOT NULL,
  `extra_views` int(11) NOT NULL,
  `extra_views_cost` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('pending','processed','failed') NOT NULL DEFAULT 'pending',
  `paid_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `view_billing_records`
--

INSERT INTO `view_billing_records` (`id`, `user_id`, `billing_period_start`, `billing_period_end`, `total_views`, `extra_views`, `extra_views_cost`, `amount`, `status`, `paid_at`, `notes`, `description`, `created_at`, `updated_at`) VALUES
(72, 147, '2025-01-01', '2025-01-31', 2500, 2500, 50.00, 0.00, 'processed', NULL, '{\"charge_type\":\"auto_block\",\"block_size\":2500,\"block_number\":1}', NULL, '2025-01-20 03:51:53', '2025-01-20 03:51:53'),
(74, 147, '2025-03-06', '2025-04-06', 0, 0, 97.00, 97.00, 'processed', '2025-03-06 04:48:39', 'Pagamento de assinatura do plano Basic', 'Assinatura do plano Basic', '2025-03-06 04:48:39', '2025-03-06 04:48:39'),
(75, 147, '2025-03-06', '2025-04-06', 0, 0, 597.00, 597.00, 'processed', '2025-03-06 05:01:17', 'Pagamento de assinatura do plano Premium', 'Assinatura do plano Premium', '2025-03-06 05:01:17', '2025-03-06 05:01:17'),
(76, 151, '2025-03-07', '2025-04-07', 0, 0, 97.00, 97.00, 'processed', '2025-03-07 21:40:20', 'Pagamento de assinatura do plano Basic', 'Assinatura do plano Basic', '2025-03-07 21:40:20', '2025-03-07 21:40:20'),
(80, 156, '2025-05-03', '2025-06-03', 0, 0, 97.00, 97.00, 'processed', '2025-05-03 03:27:29', 'Pagamento de assinatura do plano Basic', 'Assinatura do plano Basic', '2025-05-03 03:27:29', '2025-05-03 03:27:29');

-- --------------------------------------------------------

--
-- Estrutura para tabela `view_statistics`
--

CREATE TABLE `view_statistics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `template_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `viewer_ip` varchar(255) NOT NULL,
  `viewer_session` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `device_type` varchar(255) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `os` varchar(255) NOT NULL,
  `referrer_domain` varchar(255) DEFAULT NULL,
  `referrer_url` text DEFAULT NULL,
  `utm_source` varchar(255) DEFAULT NULL,
  `utm_medium` varchar(255) DEFAULT NULL,
  `utm_campaign` varchar(255) DEFAULT NULL,
  `view_duration` int(11) DEFAULT NULL,
  `is_unique` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `view_statistics`
--

INSERT INTO `view_statistics` (`id`, `template_id`, `user_id`, `viewer_ip`, `viewer_session`, `user_agent`, `country`, `city`, `device_type`, `browser`, `os`, `referrer_domain`, `referrer_url`, `utm_source`, `utm_medium`, `utm_campaign`, `view_duration`, `is_unique`, `created_at`, `updated_at`) VALUES
(113038, NULL, 147, '127.0.0.1', 'cYNzcJ4TzGgKSW5PLMe8RzHbKJF0zym1JmKrSjtD', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-01-17 03:21:06', '2025-01-17 03:21:06'),
(113039, NULL, 147, '127.0.0.1', 'cYNzcJ4TzGgKSW5PLMe8RzHbKJF0zym1JmKrSjtD', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', 'localhost', 'http://localhost:8000/genrate-video/26d759e1-f7d6-414e-bb57-6446a0864666/view', NULL, NULL, NULL, NULL, 0, '2025-01-17 03:21:15', '2025-01-17 03:21:15'),
(113040, NULL, 147, '127.0.0.1', 'cYNzcJ4TzGgKSW5PLMe8RzHbKJF0zym1JmKrSjtD', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', 'localhost', 'http://localhost:8000/genrate-video/26d759e1-f7d6-414e-bb57-6446a0864666/view', NULL, NULL, NULL, NULL, 0, '2025-01-17 03:21:21', '2025-01-17 03:21:21'),
(113044, NULL, 147, '127.0.0.1', 'cYNzcJ4TzGgKSW5PLMe8RzHbKJF0zym1JmKrSjtD', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-01-17 03:36:22', '2025-01-17 03:36:22'),
(113078, NULL, 147, '127.0.0.1', 'c0R0uzMnPDsKrnjS9RFwi83EC7Is2xWKtVD7ipU6', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-02-13 00:08:45', '2025-02-13 00:08:45'),
(113080, NULL, 147, '127.0.0.1', 'OQURxN1E8Q1OpUKrjJ6imPrO0PNLcUMIJ1Ebk7tO', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-02-15 23:01:06', '2025-02-15 23:01:06'),
(113082, NULL, 147, '127.0.0.1', 'wTJu31wKyp5TjZsH5YA70YaWp9QwX91tGuAYN1RX', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', 'localhost', 'http://localhost:8000/video/1194b9a4-b7ec-43f1-a8cd-c818db2cf891/view', NULL, NULL, NULL, NULL, 1, '2025-02-20 00:17:03', '2025-02-20 00:17:03'),
(113084, NULL, 147, '127.0.0.1', 'wTJu31wKyp5TjZsH5YA70YaWp9QwX91tGuAYN1RX', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', 'localhost', 'http://localhost:8000/video/1194b9a4-b7ec-43f1-a8cd-c818db2cf891/view', NULL, NULL, NULL, NULL, 1, '2025-02-20 00:17:04', '2025-02-20 00:17:04'),
(113086, NULL, 147, '127.0.0.1', 'svnnrY1sutnA6wUu3ywqiw43b3tBR4RzlumuSd7n', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', 'localhost', 'http://localhost:8000/video/26d759e1-f7d6-414e-bb57-6446a0864666/view', NULL, NULL, NULL, NULL, 1, '2025-02-20 00:32:04', '2025-02-20 00:32:04'),
(113088, NULL, 147, '127.0.0.1', 'svnnrY1sutnA6wUu3ywqiw43b3tBR4RzlumuSd7n', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', 'localhost', 'http://localhost:8000/video/1194b9a4-b7ec-43f1-a8cd-c818db2cf891/view', NULL, NULL, NULL, NULL, 1, '2025-02-20 00:32:24', '2025-02-20 00:32:24'),
(113090, NULL, 147, '127.0.0.1', 'svnnrY1sutnA6wUu3ywqiw43b3tBR4RzlumuSd7n', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', 'localhost', 'http://localhost:8000/video/1194b9a4-b7ec-43f1-a8cd-c818db2cf891/view', NULL, NULL, NULL, NULL, 1, '2025-02-20 00:51:47', '2025-02-20 00:51:47'),
(113094, NULL, 147, '127.0.0.1', 'ugzwNbuaVErLAk6WaI4QQ6ML92amH8BQjq9QkPmP', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 01:15:28', '2025-03-04 01:15:28'),
(113096, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 16:56:34', '2025-03-04 16:56:34'),
(113106, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 17:59:26', '2025-03-04 17:59:26'),
(113121, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 18:44:59', '2025-03-04 18:44:59'),
(113123, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 18:46:36', '2025-03-04 18:46:36'),
(113125, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 18:46:42', '2025-03-04 18:46:42'),
(113127, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 18:50:46', '2025-03-04 18:50:46'),
(113129, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 19:28:28', '2025-03-04 19:28:28'),
(113131, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 19:30:12', '2025-03-04 19:30:12'),
(113133, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 19:42:49', '2025-03-04 19:42:49'),
(113135, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 19:43:40', '2025-03-04 19:43:40'),
(113137, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 19:50:18', '2025-03-04 19:50:18'),
(113139, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 19:51:25', '2025-03-04 19:51:25'),
(113143, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 20:15:43', '2025-03-04 20:15:43'),
(113145, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 20:34:00', '2025-03-04 20:34:00'),
(113147, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 20:34:01', '2025-03-04 20:34:01'),
(113149, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 20:37:43', '2025-03-04 20:37:43'),
(113151, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 20:40:53', '2025-03-04 20:40:53'),
(113153, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 20:41:38', '2025-03-04 20:41:38'),
(113155, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 20:42:27', '2025-03-04 20:42:27'),
(113157, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 20:43:34', '2025-03-04 20:43:34'),
(113159, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 20:43:46', '2025-03-04 20:43:46'),
(113161, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 20:47:07', '2025-03-04 20:47:07'),
(113163, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 21:01:05', '2025-03-04 21:01:05'),
(113165, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 21:03:34', '2025-03-04 21:03:34'),
(113167, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 21:04:59', '2025-03-04 21:04:59'),
(113169, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 21:16:34', '2025-03-04 21:16:34'),
(113177, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 21:27:21', '2025-03-04 21:27:21'),
(113203, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 22:33:20', '2025-03-04 22:33:20'),
(113205, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 22:34:28', '2025-03-04 22:34:28'),
(113207, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 22:37:39', '2025-03-04 22:37:39'),
(113209, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 22:38:29', '2025-03-04 22:38:29'),
(113211, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 22:38:54', '2025-03-04 22:38:54'),
(113213, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 22:57:16', '2025-03-04 22:57:16'),
(113215, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 22:58:39', '2025-03-04 22:58:39'),
(113217, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 22:59:31', '2025-03-04 22:59:31'),
(113219, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 22:59:39', '2025-03-04 22:59:39'),
(113221, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 22:59:52', '2025-03-04 22:59:52'),
(113223, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 22:59:59', '2025-03-04 22:59:59'),
(113225, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 23:00:21', '2025-03-04 23:00:21'),
(113227, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 23:05:41', '2025-03-04 23:05:41'),
(113229, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 23:13:47', '2025-03-04 23:13:47'),
(113231, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 23:15:20', '2025-03-04 23:15:20'),
(113233, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 23:20:59', '2025-03-04 23:20:59'),
(113236, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-04 23:24:52', '2025-03-04 23:24:52'),
(113239, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-05 01:10:13', '2025-03-05 01:10:13'),
(113241, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-05 01:11:17', '2025-03-05 01:11:17'),
(113243, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-05 01:12:58', '2025-03-05 01:12:58'),
(113245, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-05 01:13:23', '2025-03-05 01:13:23'),
(113247, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-05 01:13:41', '2025-03-05 01:13:41'),
(113249, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-05 01:16:35', '2025-03-05 01:16:35'),
(113251, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-05 01:30:48', '2025-03-05 01:30:48'),
(113253, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-05 01:33:49', '2025-03-05 01:33:49'),
(113255, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-05 01:35:22', '2025-03-05 01:35:22'),
(113257, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-05 03:06:12', '2025-03-05 03:06:12'),
(113259, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-05 03:06:45', '2025-03-05 03:06:45'),
(113261, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-05 03:07:32', '2025-03-05 03:07:32'),
(113263, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-05 03:34:57', '2025-03-05 03:34:57'),
(113265, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-05 03:36:36', '2025-03-05 03:36:36'),
(113267, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-05 03:36:46', '2025-03-05 03:36:46'),
(113273, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-05 04:50:39', '2025-03-05 04:50:39'),
(113276, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-05 05:33:31', '2025-03-05 05:33:31'),
(113278, NULL, 147, '127.0.0.1', 'yY4kK1aJaUl63VynGfaH0kkZzxD0yn613fstM4h5', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-05 05:34:54', '2025-03-05 05:34:54'),
(113283, NULL, 147, '127.0.0.1', 'VM0LhnUap98bpCW01C5UbvLngGgRp652TIByNP7f', NULL, 'XX', 'Desconhecido', 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-06 00:44:24', '2025-03-06 00:44:24'),
(113286, NULL, 147, '127.0.0.1', 'VM0LhnUap98bpCW01C5UbvLngGgRp652TIByNP7f', NULL, 'XX', 'Desconhecido', 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-06 00:57:09', '2025-03-06 00:57:09'),
(113295, 69, 147, '127.0.0.1', 'dlTELJ8q2hxPL7tejfagIE5VPSI4jCtMgPvlGJtV', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-06 05:13:55', '2025-03-06 05:13:55'),
(113296, 68, 147, '127.0.0.1', 'WhyYKOGhq3oeoMtuQn5PLUMpkmElpSP5kfQPRued', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-06 05:17:29', '2025-03-06 05:17:29'),
(113297, 68, 147, '127.0.0.1', 'bL5jE2tYS58cbsSU8xDHuLCBlZ8Unwf9C01zBkY9', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-06 05:18:46', '2025-03-06 05:18:46'),
(113298, 68, 147, '127.0.0.1', 'RGlgHwYk53uw4x7flcksM0oQpvpuOTOc6mQxOsS4', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-07 01:59:45', '2025-03-07 01:59:45'),
(113299, NULL, 147, '127.0.0.1', 'LWzEhqTB8Wa2jQWfzPPnjJGdiyphBQYhtwF6uk01', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-07 01:59:49', '2025-03-07 01:59:49'),
(113300, 68, 147, '127.0.0.1', 'RGlgHwYk53uw4x7flcksM0oQpvpuOTOc6mQxOsS4', NULL, NULL, NULL, 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-07 02:01:14', '2025-03-07 02:01:14'),
(113301, NULL, 147, '127.0.0.1', 'LWzEhqTB8Wa2jQWfzPPnjJGdiyphBQYhtwF6uk01', NULL, 'XX', 'Desconhecido', 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-07 02:01:16', '2025-03-07 02:01:16'),
(113302, 68, 147, '127.0.0.1', 'RGlgHwYk53uw4x7flcksM0oQpvpuOTOc6mQxOsS4', NULL, NULL, NULL, 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-07 02:10:55', '2025-03-07 02:10:55'),
(113303, NULL, 147, '127.0.0.1', 'LWzEhqTB8Wa2jQWfzPPnjJGdiyphBQYhtwF6uk01', NULL, 'XX', 'Desconhecido', 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-07 02:10:57', '2025-03-07 02:10:57'),
(113304, 68, 147, '127.0.0.1', 'RGlgHwYk53uw4x7flcksM0oQpvpuOTOc6mQxOsS4', NULL, NULL, NULL, 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-07 02:11:59', '2025-03-07 02:11:59'),
(113305, NULL, 147, '127.0.0.1', 'LWzEhqTB8Wa2jQWfzPPnjJGdiyphBQYhtwF6uk01', NULL, 'XX', 'Desconhecido', 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-07 02:12:01', '2025-03-07 02:12:01'),
(113306, 68, 147, '127.0.0.1', 'RGlgHwYk53uw4x7flcksM0oQpvpuOTOc6mQxOsS4', NULL, NULL, NULL, 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-07 02:12:43', '2025-03-07 02:12:43'),
(113307, NULL, 147, '127.0.0.1', 'LWzEhqTB8Wa2jQWfzPPnjJGdiyphBQYhtwF6uk01', NULL, 'XX', 'Desconhecido', 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-07 02:12:44', '2025-03-07 02:12:44'),
(113308, 68, 147, '127.0.0.1', 'RGlgHwYk53uw4x7flcksM0oQpvpuOTOc6mQxOsS4', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-07 02:13:44', '2025-03-07 02:13:44'),
(113309, NULL, 147, '127.0.0.1', 'LWzEhqTB8Wa2jQWfzPPnjJGdiyphBQYhtwF6uk01', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-07 02:13:46', '2025-03-07 02:13:46'),
(113310, 68, 147, '192.168.1.15', 'iXgmLP3f0iTKefM6I29DNrKiRorDShwlGneL0nhf', NULL, NULL, NULL, 'mobile', 'Chrome', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-07 02:14:34', '2025-03-07 02:14:34'),
(113311, 68, 147, '127.0.0.1', 'RGlgHwYk53uw4x7flcksM0oQpvpuOTOc6mQxOsS4', NULL, NULL, NULL, 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-07 02:16:20', '2025-03-07 02:16:20'),
(113312, NULL, 147, '127.0.0.1', 'LWzEhqTB8Wa2jQWfzPPnjJGdiyphBQYhtwF6uk01', NULL, 'XX', 'Desconhecido', 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-07 02:16:22', '2025-03-07 02:16:22'),
(113313, 68, 147, '192.168.1.15', 'iXgmLP3f0iTKefM6I29DNrKiRorDShwlGneL0nhf', NULL, NULL, NULL, 'mobile', 'Chrome', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-07 02:17:08', '2025-03-07 02:17:08'),
(113314, 68, 147, '192.168.1.15', 'iXgmLP3f0iTKefM6I29DNrKiRorDShwlGneL0nhf', NULL, NULL, NULL, 'mobile', 'Chrome', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-07 02:17:43', '2025-03-07 02:17:43'),
(113315, 68, 147, '192.168.1.15', 'iXgmLP3f0iTKefM6I29DNrKiRorDShwlGneL0nhf', NULL, NULL, NULL, 'mobile', 'Chrome', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-07 02:18:28', '2025-03-07 02:18:28'),
(113316, 68, 147, '127.0.0.1', 'RGlgHwYk53uw4x7flcksM0oQpvpuOTOc6mQxOsS4', NULL, NULL, NULL, 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-07 02:18:51', '2025-03-07 02:18:51'),
(113317, NULL, 147, '127.0.0.1', 'LWzEhqTB8Wa2jQWfzPPnjJGdiyphBQYhtwF6uk01', NULL, 'XX', 'Desconhecido', 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-07 02:18:53', '2025-03-07 02:18:53'),
(113318, 68, 147, '127.0.0.1', 'RGlgHwYk53uw4x7flcksM0oQpvpuOTOc6mQxOsS4', NULL, NULL, NULL, 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-07 02:19:37', '2025-03-07 02:19:37'),
(113319, NULL, 147, '127.0.0.1', 'LWzEhqTB8Wa2jQWfzPPnjJGdiyphBQYhtwF6uk01', NULL, 'XX', 'Desconhecido', 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-07 02:19:39', '2025-03-07 02:19:39'),
(113320, 68, 147, '127.0.0.1', 'RGlgHwYk53uw4x7flcksM0oQpvpuOTOc6mQxOsS4', NULL, NULL, NULL, 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-07 02:20:19', '2025-03-07 02:20:19'),
(113321, NULL, 147, '127.0.0.1', 'LWzEhqTB8Wa2jQWfzPPnjJGdiyphBQYhtwF6uk01', NULL, 'XX', 'Desconhecido', 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-07 02:20:21', '2025-03-07 02:20:21'),
(113322, 68, 147, '127.0.0.1', 'RGlgHwYk53uw4x7flcksM0oQpvpuOTOc6mQxOsS4', NULL, NULL, NULL, 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-07 02:22:27', '2025-03-07 02:22:27'),
(113323, NULL, 147, '127.0.0.1', 'LWzEhqTB8Wa2jQWfzPPnjJGdiyphBQYhtwF6uk01', NULL, 'XX', 'Desconhecido', 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-07 02:22:29', '2025-03-07 02:22:29'),
(113324, 68, 147, '127.0.0.1', 'RGlgHwYk53uw4x7flcksM0oQpvpuOTOc6mQxOsS4', NULL, NULL, NULL, 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-07 02:23:52', '2025-03-07 02:23:52'),
(113325, NULL, 147, '127.0.0.1', 'LWzEhqTB8Wa2jQWfzPPnjJGdiyphBQYhtwF6uk01', NULL, 'XX', 'Desconhecido', 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-07 02:23:54', '2025-03-07 02:23:54'),
(113326, 68, 147, '127.0.0.1', 'RGlgHwYk53uw4x7flcksM0oQpvpuOTOc6mQxOsS4', NULL, NULL, NULL, 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-07 02:24:32', '2025-03-07 02:24:32'),
(113327, NULL, 147, '127.0.0.1', 'LWzEhqTB8Wa2jQWfzPPnjJGdiyphBQYhtwF6uk01', NULL, 'XX', 'Desconhecido', 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-07 02:24:34', '2025-03-07 02:24:34'),
(113328, 68, 147, '127.0.0.1', 'RGlgHwYk53uw4x7flcksM0oQpvpuOTOc6mQxOsS4', NULL, NULL, NULL, 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-07 02:25:42', '2025-03-07 02:25:42'),
(113329, NULL, 147, '127.0.0.1', 'LWzEhqTB8Wa2jQWfzPPnjJGdiyphBQYhtwF6uk01', NULL, 'XX', 'Desconhecido', 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-07 02:25:44', '2025-03-07 02:25:44'),
(113330, 68, 147, '127.0.0.1', 'RGlgHwYk53uw4x7flcksM0oQpvpuOTOc6mQxOsS4', NULL, NULL, NULL, 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-07 02:26:50', '2025-03-07 02:26:50'),
(113331, NULL, 147, '127.0.0.1', 'LWzEhqTB8Wa2jQWfzPPnjJGdiyphBQYhtwF6uk01', NULL, 'XX', 'Desconhecido', 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-07 02:26:52', '2025-03-07 02:26:52'),
(113332, 68, 147, '127.0.0.1', 'RGlgHwYk53uw4x7flcksM0oQpvpuOTOc6mQxOsS4', NULL, NULL, NULL, 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-07 02:32:58', '2025-03-07 02:32:58'),
(113333, NULL, 147, '127.0.0.1', 'LWzEhqTB8Wa2jQWfzPPnjJGdiyphBQYhtwF6uk01', NULL, 'XX', 'Desconhecido', 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-07 02:33:00', '2025-03-07 02:33:00'),
(113334, 68, 147, '127.0.0.1', 'RGlgHwYk53uw4x7flcksM0oQpvpuOTOc6mQxOsS4', NULL, NULL, NULL, 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-07 02:34:31', '2025-03-07 02:34:31'),
(113335, NULL, 147, '127.0.0.1', 'LWzEhqTB8Wa2jQWfzPPnjJGdiyphBQYhtwF6uk01', NULL, 'XX', 'Desconhecido', 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-07 02:34:32', '2025-03-07 02:34:32'),
(113336, 68, 147, '127.0.0.1', 'RGlgHwYk53uw4x7flcksM0oQpvpuOTOc6mQxOsS4', NULL, NULL, NULL, 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-07 02:40:45', '2025-03-07 02:40:45'),
(113337, NULL, 147, '127.0.0.1', 'LWzEhqTB8Wa2jQWfzPPnjJGdiyphBQYhtwF6uk01', NULL, 'XX', 'Desconhecido', 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-07 02:40:47', '2025-03-07 02:40:47'),
(113338, 68, 147, '192.168.1.15', 'iXgmLP3f0iTKefM6I29DNrKiRorDShwlGneL0nhf', NULL, NULL, NULL, 'mobile', 'Chrome', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-07 02:41:38', '2025-03-07 02:41:38'),
(113339, 68, 147, '127.0.0.1', 'RGlgHwYk53uw4x7flcksM0oQpvpuOTOc6mQxOsS4', NULL, NULL, NULL, 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-07 02:44:54', '2025-03-07 02:44:54'),
(113340, NULL, 147, '127.0.0.1', 'LWzEhqTB8Wa2jQWfzPPnjJGdiyphBQYhtwF6uk01', NULL, 'XX', 'Desconhecido', 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-07 02:44:55', '2025-03-07 02:44:55'),
(113341, 68, 147, '127.0.0.1', 'RGlgHwYk53uw4x7flcksM0oQpvpuOTOc6mQxOsS4', NULL, NULL, NULL, 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-07 02:45:47', '2025-03-07 02:45:47'),
(113342, NULL, 147, '127.0.0.1', 'LWzEhqTB8Wa2jQWfzPPnjJGdiyphBQYhtwF6uk01', NULL, 'XX', 'Desconhecido', 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-07 02:45:49', '2025-03-07 02:45:49'),
(113343, 68, 147, '127.0.0.1', 'FDfr78zwLSLsjHussaFsO2ociKrDNxrFYNMCBKob', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-13 01:21:31', '2025-03-13 01:21:31'),
(113345, 69, 147, '127.0.0.1', '8koqIF1ab677wOhZ3Bdg7uoLczi0851TTiBJ3Lia', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-13 18:24:33', '2025-03-13 18:24:33'),
(113346, 68, 147, '127.0.0.1', '8koqIF1ab677wOhZ3Bdg7uoLczi0851TTiBJ3Lia', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-13 18:25:42', '2025-03-13 18:25:42'),
(113347, 69, 147, '127.0.0.1', 'TgjV3EYEA4Yk5gn4uPoHCYjjNxtaYD22nFet25Es', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-13 18:29:25', '2025-03-13 18:29:25'),
(113348, 69, 147, '127.0.0.1', 'TgjV3EYEA4Yk5gn4uPoHCYjjNxtaYD22nFet25Es', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-13 18:31:00', '2025-03-13 18:31:00'),
(113349, 69, 147, '127.0.0.1', 'evKBfZ7krqMlyQp0TXwHBrrkIlI0bytI2SqEyBeR', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-13 21:46:46', '2025-03-13 21:46:46'),
(113350, NULL, 1, '127.0.0.1', 'KN6r2xoMPyzH3JwLQHHyItHNuKVfX1ea0q8MCC1L', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-13 21:46:47', '2025-03-13 21:46:47'),
(113351, 69, 147, '127.0.0.1', '24HLlRB6aS0t6j4Gtib59vpcfep5u3fUr6XyDy5v', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-13 21:51:50', '2025-03-13 21:51:50'),
(113352, NULL, 147, '127.0.0.1', 'DjutaphA31x4nrZPkwiT3TtSBWFzx8wAt9JpIFxx', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-13 21:51:51', '2025-03-13 21:51:51'),
(113353, 68, 147, '127.0.0.1', '24HLlRB6aS0t6j4Gtib59vpcfep5u3fUr6XyDy5v', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-13 21:52:37', '2025-03-13 21:52:37'),
(113354, NULL, 147, '127.0.0.1', 'DjutaphA31x4nrZPkwiT3TtSBWFzx8wAt9JpIFxx', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-13 21:52:38', '2025-03-13 21:52:38'),
(113355, 68, 147, '127.0.0.1', '24HLlRB6aS0t6j4Gtib59vpcfep5u3fUr6XyDy5v', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-13 21:52:50', '2025-03-13 21:52:50'),
(113356, NULL, 147, '127.0.0.1', 'DjutaphA31x4nrZPkwiT3TtSBWFzx8wAt9JpIFxx', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-13 21:52:52', '2025-03-13 21:52:52'),
(113357, 69, 147, '127.0.0.1', 'oLSfYFz8PnGoMx6RqVRwJRi1XkyaidNZ7pFavghr', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-13 22:07:37', '2025-03-13 22:07:37'),
(113358, NULL, 147, '127.0.0.1', 'NhIpDQH0YvYY8yyTxxVPNbRC0AnsOXiXb2onxAk3', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-13 22:07:38', '2025-03-13 22:07:38'),
(113359, 68, 147, '127.0.0.1', 'oLSfYFz8PnGoMx6RqVRwJRi1XkyaidNZ7pFavghr', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-13 22:08:13', '2025-03-13 22:08:13'),
(113360, NULL, 147, '127.0.0.1', 'NhIpDQH0YvYY8yyTxxVPNbRC0AnsOXiXb2onxAk3', NULL, 'XX', 'Desconhecido', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-13 22:08:14', '2025-03-13 22:08:14'),
(113361, 69, 147, '127.0.0.1', 'lAxcL9QoWjpn4Y4IgyqJz69pDspcjQfjJ1XPkfFc', NULL, NULL, NULL, 'desktop', 'Chrome', 'OS X', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-13 22:18:28', '2025-03-13 22:18:28'),
(113362, 68, 147, '127.0.0.1', 'Sy1tqVFGn4aEPMZxgFdUxqYYlI750dcxQ10XQliF', NULL, NULL, NULL, 'desktop', 'Chrome', 'OS X', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-13 22:20:36', '2025-03-13 22:20:36'),
(113363, 69, 147, '127.0.0.1', 'oLSfYFz8PnGoMx6RqVRwJRi1XkyaidNZ7pFavghr', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-13 22:38:57', '2025-03-13 22:38:57'),
(113364, NULL, 147, '127.0.0.1', 'NhIpDQH0YvYY8yyTxxVPNbRC0AnsOXiXb2onxAk3', NULL, 'BR', 'São Paulo', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-13 22:38:57', '2025-03-13 22:38:57'),
(113365, 69, 147, '127.0.0.1', 'Erl9y8zW8nkqYg2CI0NJ3WdOYtefaLQ0w6vWK7w1', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-13 22:39:54', '2025-03-13 22:39:54'),
(113366, NULL, 147, '127.0.0.1', '6xNKyuNdMQixrEJNKiBFPU9XhtQ6FYr8643zbZ7f', NULL, 'BR', 'São Paulo', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-13 22:39:54', '2025-03-13 22:39:54'),
(113367, 68, 147, '127.0.0.1', 'Erl9y8zW8nkqYg2CI0NJ3WdOYtefaLQ0w6vWK7w1', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-13 22:39:57', '2025-03-13 22:39:57'),
(113368, NULL, 147, '127.0.0.1', '6xNKyuNdMQixrEJNKiBFPU9XhtQ6FYr8643zbZ7f', NULL, 'BR', 'São Paulo', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-13 22:39:57', '2025-03-13 22:39:57'),
(113369, 69, 147, '127.0.0.1', 'Erl9y8zW8nkqYg2CI0NJ3WdOYtefaLQ0w6vWK7w1', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-13 22:40:18', '2025-03-13 22:40:18'),
(113370, NULL, 147, '127.0.0.1', '6xNKyuNdMQixrEJNKiBFPU9XhtQ6FYr8643zbZ7f', NULL, 'BR', 'São Paulo', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-13 22:40:18', '2025-03-13 22:40:18'),
(113371, 68, 147, '127.0.0.1', 'Erl9y8zW8nkqYg2CI0NJ3WdOYtefaLQ0w6vWK7w1', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-13 22:40:19', '2025-03-13 22:40:19'),
(113372, NULL, 147, '127.0.0.1', '6xNKyuNdMQixrEJNKiBFPU9XhtQ6FYr8643zbZ7f', NULL, 'BR', 'São Paulo', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-13 22:40:19', '2025-03-13 22:40:19'),
(113373, 68, 147, '127.0.0.1', 'Erl9y8zW8nkqYg2CI0NJ3WdOYtefaLQ0w6vWK7w1', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-13 23:08:32', '2025-03-13 23:08:32'),
(113374, NULL, 147, '127.0.0.1', '6xNKyuNdMQixrEJNKiBFPU9XhtQ6FYr8643zbZ7f', NULL, 'BR', 'São Paulo', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-13 23:08:32', '2025-03-13 23:08:32'),
(113375, 69, 147, '127.0.0.1', 'ZuC6J8pdHzHOi2KCVoMG8QDMQstl0QOGerAKsfvf', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 04:10:21', '2025-03-14 04:10:21'),
(113376, NULL, 1, '127.0.0.1', '1LnMYdt1Pmxym18i5nKxpouWU1LboSjC82HIJeZL', NULL, 'BR', 'São Paulo', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-14 04:10:22', '2025-03-14 04:10:22'),
(113377, 69, 147, '127.0.0.1', 'ZuC6J8pdHzHOi2KCVoMG8QDMQstl0QOGerAKsfvf', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 04:14:28', '2025-03-14 04:14:28'),
(113378, NULL, 1, '127.0.0.1', '1LnMYdt1Pmxym18i5nKxpouWU1LboSjC82HIJeZL', NULL, 'BR', 'São Paulo', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-14 04:14:28', '2025-03-14 04:14:28'),
(113379, 69, 147, '192.168.68.135', 'pCDiL4VGwuBSNnu90iY0R6fT5jUdHsD1K8wIEBgA', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-14 04:17:23', '2025-03-14 04:17:23'),
(113380, 69, 147, '192.168.68.155', 'AV3F4QWhc0fyhYLJErZrS8JL2E61dIvTM4a26n5r', NULL, NULL, NULL, 'mobile', 'Chrome', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-14 04:17:45', '2025-03-14 04:17:45'),
(113381, 69, 147, '192.168.68.155', 'AV3F4QWhc0fyhYLJErZrS8JL2E61dIvTM4a26n5r', NULL, NULL, NULL, 'mobile', 'Chrome', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-14 04:37:21', '2025-03-14 04:37:21'),
(113382, 69, 147, '127.0.0.1', 'LKAZASnHJTxVEvYtFiziD3cF22rWRLOzzyRb0rba', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 15:30:42', '2025-03-14 15:30:42'),
(113383, NULL, 1, '127.0.0.1', 'Yo4JcWN4BLt3pPAxjPlX7e3xxj6fYe1KLI2ieod7', NULL, 'BR', 'São Paulo', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-14 15:30:42', '2025-03-14 15:30:42'),
(113384, 68, 147, '127.0.0.1', 'y9DPsGTJmvIoDGFGRxcclxPg3aM94u7FhoxQLiCb', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 15:31:21', '2025-03-14 15:31:21'),
(113385, 69, 147, '192.168.68.155', 'uF56lI6ZjGzrkbiH6ctrGFrYDqQGCKrjFDVBfEOo', NULL, NULL, NULL, 'mobile', 'Chrome', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 15:34:07', '2025-03-14 15:34:07'),
(113386, 69, 147, '192.168.68.155', 'uF56lI6ZjGzrkbiH6ctrGFrYDqQGCKrjFDVBfEOo', NULL, NULL, NULL, 'mobile', 'Chrome', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 15:34:17', '2025-03-14 15:34:17'),
(113387, 69, 147, '192.168.68.155', 'wXM0TQHzqnQOv17LRXBqboMDgsx3tQAKhZbVx1dA', NULL, NULL, NULL, 'mobile', 'Chrome', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 15:34:26', '2025-03-14 15:34:26'),
(113388, 69, 147, '127.0.0.1', 'LKAZASnHJTxVEvYtFiziD3cF22rWRLOzzyRb0rba', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 15:39:44', '2025-03-14 15:39:44'),
(113389, NULL, 1, '127.0.0.1', 'Yo4JcWN4BLt3pPAxjPlX7e3xxj6fYe1KLI2ieod7', NULL, 'BR', 'São Paulo', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-14 15:39:44', '2025-03-14 15:39:44'),
(113390, 69, 147, '127.0.0.1', 'LKAZASnHJTxVEvYtFiziD3cF22rWRLOzzyRb0rba', NULL, NULL, NULL, 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 15:42:20', '2025-03-14 15:42:20'),
(113391, NULL, 1, '127.0.0.1', 'Yo4JcWN4BLt3pPAxjPlX7e3xxj6fYe1KLI2ieod7', NULL, 'BR', 'São Paulo', 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-14 15:42:20', '2025-03-14 15:42:20'),
(113392, 69, 147, '127.0.0.1', 'LKAZASnHJTxVEvYtFiziD3cF22rWRLOzzyRb0rba', NULL, NULL, NULL, 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 15:42:25', '2025-03-14 15:42:25'),
(113393, NULL, 1, '127.0.0.1', 'Yo4JcWN4BLt3pPAxjPlX7e3xxj6fYe1KLI2ieod7', NULL, 'BR', 'São Paulo', 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-14 15:42:25', '2025-03-14 15:42:25'),
(113394, 69, 147, '127.0.0.1', 'LKAZASnHJTxVEvYtFiziD3cF22rWRLOzzyRb0rba', NULL, NULL, NULL, 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 15:48:23', '2025-03-14 15:48:23'),
(113395, NULL, 1, '127.0.0.1', 'Yo4JcWN4BLt3pPAxjPlX7e3xxj6fYe1KLI2ieod7', NULL, 'BR', 'São Paulo', 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-14 15:48:23', '2025-03-14 15:48:23'),
(113396, 69, 147, '127.0.0.1', 'LKAZASnHJTxVEvYtFiziD3cF22rWRLOzzyRb0rba', NULL, NULL, NULL, 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 15:50:26', '2025-03-14 15:50:26'),
(113397, NULL, 1, '127.0.0.1', 'Yo4JcWN4BLt3pPAxjPlX7e3xxj6fYe1KLI2ieod7', NULL, 'BR', 'São Paulo', 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-14 15:50:26', '2025-03-14 15:50:26'),
(113398, 69, 147, '192.168.68.111', 'JYhVGlDqTTeiil089CMGNSs9tE4XTZlSjG1sRk7d', NULL, NULL, NULL, 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-14 16:11:12', '2025-03-14 16:11:12'),
(113399, 69, 147, '127.0.0.1', 'LKAZASnHJTxVEvYtFiziD3cF22rWRLOzzyRb0rba', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 16:18:11', '2025-03-14 16:18:11'),
(113400, NULL, 1, '127.0.0.1', 'Yo4JcWN4BLt3pPAxjPlX7e3xxj6fYe1KLI2ieod7', NULL, 'BR', 'São Paulo', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-14 16:18:11', '2025-03-14 16:18:11'),
(113401, 69, 147, '192.168.68.155', 'wXM0TQHzqnQOv17LRXBqboMDgsx3tQAKhZbVx1dA', NULL, NULL, NULL, 'mobile', 'Chrome', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 16:35:18', '2025-03-14 16:35:18'),
(113402, 69, 147, '127.0.0.1', 'LKAZASnHJTxVEvYtFiziD3cF22rWRLOzzyRb0rba', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 16:36:23', '2025-03-14 16:36:23'),
(113403, NULL, 1, '127.0.0.1', 'Yo4JcWN4BLt3pPAxjPlX7e3xxj6fYe1KLI2ieod7', NULL, 'BR', 'São Paulo', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-14 16:36:23', '2025-03-14 16:36:23'),
(113404, 69, 147, '192.168.68.111', 'JYhVGlDqTTeiil089CMGNSs9tE4XTZlSjG1sRk7d', NULL, NULL, NULL, 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 16:36:48', '2025-03-14 16:36:48'),
(113405, 69, 147, '192.168.68.155', 'wXM0TQHzqnQOv17LRXBqboMDgsx3tQAKhZbVx1dA', NULL, NULL, NULL, 'mobile', 'Chrome', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 16:38:23', '2025-03-14 16:38:23'),
(113406, 69, 147, '192.168.68.155', 'wXM0TQHzqnQOv17LRXBqboMDgsx3tQAKhZbVx1dA', NULL, NULL, NULL, 'mobile', 'Chrome', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 16:38:43', '2025-03-14 16:38:43'),
(113407, 69, 147, '192.168.68.155', 'wXM0TQHzqnQOv17LRXBqboMDgsx3tQAKhZbVx1dA', NULL, NULL, NULL, 'mobile', 'Chrome', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 16:39:01', '2025-03-14 16:39:01'),
(113408, 69, 147, '192.168.68.155', 'wXM0TQHzqnQOv17LRXBqboMDgsx3tQAKhZbVx1dA', NULL, NULL, NULL, 'mobile', 'Chrome', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 16:39:36', '2025-03-14 16:39:36'),
(113409, 69, 147, '192.168.68.111', 'JYhVGlDqTTeiil089CMGNSs9tE4XTZlSjG1sRk7d', NULL, NULL, NULL, 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 16:39:51', '2025-03-14 16:39:51'),
(113410, 69, 147, '127.0.0.1', 'LKAZASnHJTxVEvYtFiziD3cF22rWRLOzzyRb0rba', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 16:40:17', '2025-03-14 16:40:17'),
(113411, NULL, 1, '127.0.0.1', 'Yo4JcWN4BLt3pPAxjPlX7e3xxj6fYe1KLI2ieod7', NULL, 'BR', 'São Paulo', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-14 16:40:17', '2025-03-14 16:40:17'),
(113412, 69, 147, '127.0.0.1', 'LKAZASnHJTxVEvYtFiziD3cF22rWRLOzzyRb0rba', NULL, NULL, NULL, 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 16:53:46', '2025-03-14 16:53:46'),
(113413, NULL, 1, '127.0.0.1', 'Yo4JcWN4BLt3pPAxjPlX7e3xxj6fYe1KLI2ieod7', NULL, 'BR', 'São Paulo', 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-14 16:53:47', '2025-03-14 16:53:47'),
(113414, 69, 147, '192.168.68.155', 'wXM0TQHzqnQOv17LRXBqboMDgsx3tQAKhZbVx1dA', NULL, NULL, NULL, 'mobile', 'Chrome', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 16:54:02', '2025-03-14 16:54:02'),
(113415, 69, 147, '192.168.68.155', 'wXM0TQHzqnQOv17LRXBqboMDgsx3tQAKhZbVx1dA', NULL, NULL, NULL, 'mobile', 'Chrome', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 16:55:02', '2025-03-14 16:55:02'),
(113416, 69, 147, '192.168.68.155', 'wXM0TQHzqnQOv17LRXBqboMDgsx3tQAKhZbVx1dA', NULL, NULL, NULL, 'mobile', 'Chrome', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 16:55:31', '2025-03-14 16:55:31'),
(113417, 69, 147, '192.168.68.111', 'JYhVGlDqTTeiil089CMGNSs9tE4XTZlSjG1sRk7d', NULL, NULL, NULL, 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 16:56:30', '2025-03-14 16:56:30'),
(113418, 69, 147, '127.0.0.1', 'LKAZASnHJTxVEvYtFiziD3cF22rWRLOzzyRb0rba', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 16:57:06', '2025-03-14 16:57:06'),
(113419, NULL, 1, '127.0.0.1', 'Yo4JcWN4BLt3pPAxjPlX7e3xxj6fYe1KLI2ieod7', NULL, 'BR', 'São Paulo', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-14 16:57:06', '2025-03-14 16:57:06'),
(113420, 68, 147, '127.0.0.1', 'LKAZASnHJTxVEvYtFiziD3cF22rWRLOzzyRb0rba', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 16:57:32', '2025-03-14 16:57:32'),
(113421, NULL, 1, '127.0.0.1', 'Yo4JcWN4BLt3pPAxjPlX7e3xxj6fYe1KLI2ieod7', NULL, 'BR', 'São Paulo', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-14 16:57:32', '2025-03-14 16:57:32'),
(113422, 68, 147, '192.168.68.111', 'JYhVGlDqTTeiil089CMGNSs9tE4XTZlSjG1sRk7d', NULL, NULL, NULL, 'mobile', 'Chrome', 'AndroidOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-14 16:58:50', '2025-03-14 16:58:50'),
(113423, 69, 147, '127.0.0.1', 'be8M3OpGlTX9LxOz3iWeGbQzZbWgtwQwnJnrgi1n', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 17:33:55', '2025-03-14 17:33:55'),
(113424, 69, 147, '127.0.0.1', 'vshoMuYoPkyJqW7RULeU0EDRT4usDs2TYZ6n5pAi', NULL, 'BR', 'São Paulo', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-14 17:33:55', '2025-03-14 17:33:55'),
(113425, 68, 147, '127.0.0.1', 'be8M3OpGlTX9LxOz3iWeGbQzZbWgtwQwnJnrgi1n', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 17:35:46', '2025-03-14 17:35:46'),
(113426, 68, 147, '127.0.0.1', 'vshoMuYoPkyJqW7RULeU0EDRT4usDs2TYZ6n5pAi', NULL, 'BR', 'São Paulo', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-14 17:35:46', '2025-03-14 17:35:46'),
(113427, 68, 147, '127.0.0.1', 'v9xAH5AVow0YZJPYqCyub37GKuanokJLuwBAAKKR', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 22:55:34', '2025-03-14 22:55:34'),
(113428, 68, 1, '127.0.0.1', 'oU4ZPGTjyAthI2qx9AxQAGauJTGZy0k2WaRIRS4n', NULL, 'BR', 'São Paulo', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-14 22:55:34', '2025-03-14 22:55:34'),
(113429, 69, 147, '127.0.0.1', 'oErSjBI1EOatXhZL07k09GxuLiDc4oed3qXL7xBz', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 23:10:50', '2025-03-14 23:10:50'),
(113430, 69, 147, '127.0.0.1', 'gxE0s7Nt2UESqPLtnSx6Lp3SbmeIiRT9koXSAUt7', NULL, 'BR', 'São Paulo', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-14 23:10:50', '2025-03-14 23:10:50'),
(113431, 69, 147, '127.0.0.1', 'oErSjBI1EOatXhZL07k09GxuLiDc4oed3qXL7xBz', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 23:17:23', '2025-03-14 23:17:23'),
(113432, 69, 147, '127.0.0.1', 'gxE0s7Nt2UESqPLtnSx6Lp3SbmeIiRT9koXSAUt7', NULL, 'BR', 'São Paulo', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-14 23:17:23', '2025-03-14 23:17:23'),
(113433, 68, 1, '127.0.0.105', 'test-session-67d48f8ca2519', NULL, 'BR', 'Test City', 'tablet', 'Edge', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-10 05:08:28', '2025-03-10 05:08:28'),
(113434, 68, 1, '127.0.0.109', 'test-session-67d48f8ca4e24', NULL, 'BR', 'Test City', 'desktop', 'Chrome', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-08 18:02:28', '2025-03-08 18:02:28'),
(113435, 68, 1, '127.0.0.131', 'test-session-67d48f8ca5c23', NULL, 'BR', 'Test City', 'desktop', 'Edge', 'Linux', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-04 01:31:28', '2025-03-04 01:31:28'),
(113436, 68, 1, '127.0.0.240', 'test-session-67d48f8ca6a66', NULL, 'BR', 'Test City', 'mobile', 'Safari', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-01 07:31:28', '2025-03-01 07:31:28'),
(113437, 68, 1, '127.0.0.153', 'test-session-67d48f8ca789b', NULL, 'BR', 'Test City', 'tablet', 'Firefox', 'macOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-02-28 02:20:28', '2025-02-28 02:20:28'),
(113438, 68, 1, '127.0.0.143', 'test-session-67d48f8ca862a', NULL, 'US', 'Test City', 'tablet', 'Firefox', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-02-27 21:57:28', '2025-02-27 21:57:28'),
(113439, 68, 1, '127.0.0.118', 'test-session-67d48f8ca953d', NULL, 'US', 'Test City', 'desktop', 'Safari', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-02-24 13:48:28', '2025-02-24 13:48:28'),
(113440, 68, 1, '127.0.0.158', 'test-session-67d48f8caa337', NULL, 'US', 'Test City', 'tablet', 'Safari', 'macOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-02-18 03:49:28', '2025-02-18 03:49:28'),
(113441, 68, 1, '127.0.0.181', 'test-session-67d48f8cab1fb', NULL, 'US', 'Test City', 'desktop', 'Chrome', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-02-12 13:44:28', '2025-02-12 13:44:28'),
(113442, 68, 1, '127.0.0.62', 'test-session-67d48f8cac02e', NULL, 'US', 'Test City', 'mobile', 'Chrome', 'Android', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-02-08 12:47:28', '2025-02-08 12:47:28'),
(113443, 68, 1, '127.0.0.40', 'test-session-67d48f8cad4ef', NULL, 'US', 'Test City', 'mobile', 'Safari', 'macOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-02-04 05:08:28', '2025-02-04 05:08:28'),
(113444, 68, 1, '127.0.0.42', 'test-session-67d48f8cae2ec', NULL, 'US', 'Test City', 'desktop', 'Edge', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-01-31 11:31:28', '2025-01-31 11:31:28'),
(113445, 68, 1, '127.0.0.235', 'test-session-67d48f8caf264', NULL, 'US', 'Test City', 'mobile', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-01-30 19:52:28', '2025-01-30 19:52:28'),
(113446, 68, 1, '127.0.0.197', 'test-session-67d48f8cb0103', NULL, 'US', 'Test City', 'mobile', 'Chrome', 'macOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-01-26 22:42:28', '2025-01-26 22:42:28'),
(113447, 68, 1, '127.0.0.44', 'test-session-67d48f8cb0f4a', NULL, 'US', 'Test City', 'mobile', 'Firefox', 'Android', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-01-26 00:30:28', '2025-01-26 00:30:28');
INSERT INTO `view_statistics` (`id`, `template_id`, `user_id`, `viewer_ip`, `viewer_session`, `user_agent`, `country`, `city`, `device_type`, `browser`, `os`, `referrer_domain`, `referrer_url`, `utm_source`, `utm_medium`, `utm_campaign`, `view_duration`, `is_unique`, `created_at`, `updated_at`) VALUES
(113448, 68, 1, '127.0.0.160', 'test-session-67d48f8cb1d98', NULL, 'PT', 'Test City', 'desktop', 'Safari', 'macOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-01-24 22:02:28', '2025-01-24 22:02:28'),
(113449, 68, 1, '127.0.0.98', 'test-session-67d48f8cb2b67', NULL, 'PT', 'Test City', 'tablet', 'Edge', 'macOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-01-19 09:24:28', '2025-01-19 09:24:28'),
(113450, 68, 1, '127.0.0.12', 'test-session-67d48f8cb3a3f', NULL, 'PT', 'Test City', 'mobile', 'Firefox', 'Linux', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-01-16 05:22:28', '2025-01-16 05:22:28'),
(113451, 68, 1, '127.0.0.118', 'test-session-67d48f8cb4948', NULL, 'PT', 'Test City', 'tablet', 'Firefox', 'macOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-01-11 08:21:28', '2025-01-11 08:21:28'),
(113452, 68, 1, '127.0.0.179', 'test-session-67d48f8cb50b0', NULL, 'PT', 'Test City', 'mobile', 'Safari', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-01-07 11:47:28', '2025-01-07 11:47:28'),
(113453, 68, 1, '127.0.0.121', 'test-session-67d48f8cb5711', NULL, 'PT', 'Test City', 'tablet', 'Safari', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-12-31 16:21:28', '2024-12-31 16:21:28'),
(113454, 68, 1, '127.0.0.56', 'test-session-67d48f8cb5c66', NULL, 'PT', 'Test City', 'desktop', 'Safari', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-12-31 00:35:28', '2024-12-31 00:35:28'),
(113455, 68, 1, '127.0.0.174', 'test-session-67d48f8cb69d2', NULL, 'PT', 'Test City', 'tablet', 'Chrome', 'macOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-12-26 12:00:28', '2024-12-26 12:00:28'),
(113456, 68, 1, '127.0.0.92', 'test-session-67d48f8cb6eb9', NULL, 'PT', 'Test City', 'mobile', 'Chrome', 'macOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-12-21 21:58:28', '2024-12-21 21:58:28'),
(113457, 68, 1, '127.0.0.229', 'test-session-67d48f8cb72fe', NULL, 'ES', 'Test City', 'desktop', 'Firefox', 'Android', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-12-20 03:26:28', '2024-12-20 03:26:28'),
(113458, 68, 1, '127.0.0.247', 'test-session-67d48f8cb7762', NULL, 'ES', 'Test City', 'tablet', 'Edge', 'macOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-12-19 18:19:28', '2024-12-19 18:19:28'),
(113459, 68, 1, '127.0.0.84', 'test-session-67d48f8cb7c01', NULL, 'ES', 'Test City', 'tablet', 'Firefox', 'Linux', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-12-16 15:52:28', '2024-12-16 15:52:28'),
(113460, 68, 1, '127.0.0.62', 'test-session-67d48f8cb80ba', NULL, 'ES', 'Test City', 'mobile', 'Safari', 'macOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-12-13 04:46:28', '2024-12-13 04:46:28'),
(113461, 68, 1, '127.0.0.120', 'test-session-67d48f8cb8578', NULL, 'ES', 'Test City', 'mobile', 'Safari', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-12-12 14:22:28', '2024-12-12 14:22:28'),
(113462, 68, 1, '127.0.0.159', 'test-session-67d48f8cb899c', NULL, 'ES', 'Test City', 'desktop', 'Firefox', 'macOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-12-11 13:21:28', '2024-12-11 13:21:28'),
(113463, 68, 1, '127.0.0.33', 'test-session-67d48f8cb8e2f', NULL, 'ES', 'Test City', 'tablet', 'Safari', 'macOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-12-05 15:47:28', '2024-12-05 15:47:28'),
(113464, 68, 1, '127.0.0.144', 'test-session-67d48f8cb92f1', NULL, 'ES', 'Test City', 'desktop', 'Chrome', 'Android', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-12-02 15:09:28', '2024-12-02 15:09:28'),
(113465, 68, 1, '127.0.0.24', 'test-session-67d48f8cb975c', NULL, 'ES', 'Test City', 'tablet', 'Safari', 'macOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-11-25 17:08:28', '2024-11-25 17:08:28'),
(113466, 68, 1, '127.0.0.43', 'test-session-67d48f8cb9bcd', NULL, 'MX', 'Test City', 'mobile', 'Edge', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-11-21 20:26:28', '2024-11-21 20:26:28'),
(113467, 68, 1, '127.0.0.43', 'test-session-67d48f8cba12d', NULL, 'MX', 'Test City', 'tablet', 'Safari', 'Android', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-11-17 04:20:28', '2024-11-17 04:20:28'),
(113468, 68, 1, '127.0.0.53', 'test-session-67d48f8cba5c7', NULL, 'MX', 'Test City', 'mobile', 'Edge', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-11-15 19:24:28', '2024-11-15 19:24:28'),
(113469, 68, 1, '127.0.0.60', 'test-session-67d48f8cba9f8', NULL, 'MX', 'Test City', 'desktop', 'Safari', 'Linux', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-11-09 11:49:28', '2024-11-09 11:49:28'),
(113470, 68, 1, '127.0.0.178', 'test-session-67d48f8cbae41', NULL, 'MX', 'Test City', 'mobile', 'Firefox', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-11-09 03:22:28', '2024-11-09 03:22:28'),
(113471, 68, 1, '127.0.0.19', 'test-session-67d48f8cbb349', NULL, 'CO', 'Test City', 'mobile', 'Edge', 'macOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-11-02 04:59:28', '2024-11-02 04:59:28'),
(113472, 68, 1, '127.0.0.13', 'test-session-67d48f8cbb8e6', NULL, 'CO', 'Test City', 'desktop', 'Firefox', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-11-01 20:34:28', '2024-11-01 20:34:28'),
(113473, 68, 1, '127.0.0.12', 'test-session-67d48f8cbbdf2', NULL, 'CO', 'Test City', 'desktop', 'Chrome', 'Android', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-11-01 01:38:28', '2024-11-01 01:38:28'),
(113474, 68, 1, '127.0.0.228', 'test-session-67d48f8cbc271', NULL, 'CO', 'Test City', 'desktop', 'Chrome', 'Android', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-10-31 15:01:28', '2024-10-31 15:01:28'),
(113475, 68, 1, '127.0.0.187', 'test-session-67d48f8cbc6c1', NULL, 'CO', 'Test City', 'mobile', 'Edge', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-10-26 21:13:28', '2024-10-26 21:13:28'),
(113476, 68, 1, '127.0.0.161', 'test-session-67d48f8cbcade', NULL, 'CO', 'Test City', 'desktop', 'Safari', 'Linux', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-10-23 22:37:28', '2024-10-23 22:37:28'),
(113477, 68, 1, '127.0.0.18', 'test-session-67d48f8cbcf27', NULL, 'CO', 'Test City', 'tablet', 'Chrome', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-10-20 03:10:28', '2024-10-20 03:10:28'),
(113478, 68, 1, '127.0.0.182', 'test-session-67d48f8cbd3b5', NULL, 'CO', 'Test City', 'tablet', 'Safari', 'Linux', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-10-14 12:07:28', '2024-10-14 12:07:28'),
(113479, 68, 1, '127.0.0.34', 'test-session-67d48f8cbd851', NULL, 'CO', 'Test City', 'mobile', 'Edge', 'Android', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-10-09 12:14:28', '2024-10-09 12:14:28'),
(113480, 68, 1, '127.0.0.49', 'test-session-67d48f8cbdc70', NULL, 'AR', 'Test City', 'desktop', 'Firefox', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-10-08 08:30:28', '2024-10-08 08:30:28'),
(113481, 68, 1, '127.0.0.131', 'test-session-67d48f8cbe12b', NULL, 'AR', 'Test City', 'tablet', 'Safari', 'macOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-10-02 08:43:28', '2024-10-02 08:43:28'),
(113482, 68, 1, '127.0.0.25', 'test-session-67d48f8cbe53d', NULL, 'AR', 'Test City', 'mobile', 'Safari', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-09-27 13:36:28', '2024-09-27 13:36:28'),
(113483, 68, 1, '127.0.0.245', 'test-session-67d48f8cbe904', NULL, 'AR', 'Test City', 'mobile', 'Firefox', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-09-21 15:14:28', '2024-09-21 15:14:28'),
(113484, 68, 1, '127.0.0.42', 'test-session-67d48f8cbee3b', NULL, 'AR', 'Test City', 'desktop', 'Edge', 'macOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-09-20 18:41:28', '2024-09-20 18:41:28'),
(113485, 68, 1, '127.0.0.210', 'test-session-67d48f8cbf306', NULL, 'AR', 'Test City', 'desktop', 'Firefox', 'Android', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-09-14 18:54:28', '2024-09-14 18:54:28'),
(113486, 68, 1, '127.0.0.47', 'test-session-67d48f8cbf797', NULL, 'AR', 'Test City', 'tablet', 'Firefox', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-09-08 09:01:28', '2024-09-08 09:01:28'),
(113487, 68, 1, '127.0.0.184', 'test-session-67d48f8cbfbd2', NULL, 'AR', 'Test City', 'mobile', 'Edge', 'macOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-09-01 12:23:28', '2024-09-01 12:23:28'),
(113488, 68, 1, '127.0.0.4', 'test-session-67d48f8cc00e7', NULL, 'AR', 'Test City', 'tablet', 'Safari', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-08-30 16:24:28', '2024-08-30 16:24:28'),
(113489, 68, 1, '127.0.0.122', 'test-session-67d48f8cc05d6', NULL, 'AR', 'Test City', 'desktop', 'Edge', 'Linux', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-08-25 14:27:28', '2024-08-25 14:27:28'),
(113490, 68, 1, '127.0.0.21', 'test-session-67d48f8cc0ad1', NULL, 'CL', 'Test City', 'mobile', 'Edge', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-08-20 04:35:28', '2024-08-20 04:35:28'),
(113491, 68, 1, '127.0.0.149', 'test-session-67d48f8cc0f77', NULL, 'CL', 'Test City', 'desktop', 'Edge', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-08-16 21:23:28', '2024-08-16 21:23:28'),
(113492, 68, 1, '127.0.0.201', 'test-session-67d48f8cc13e7', NULL, 'CL', 'Test City', 'desktop', 'Firefox', 'Linux', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-08-13 00:30:28', '2024-08-13 00:30:28'),
(113493, 68, 1, '127.0.0.105', 'test-session-67d48f8cc17e2', NULL, 'CL', 'Test City', 'mobile', 'Edge', 'Android', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-08-06 03:50:28', '2024-08-06 03:50:28'),
(113494, 68, 1, '127.0.0.199', 'test-session-67d48f8cc1bc2', NULL, 'CL', 'Test City', 'desktop', 'Chrome', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-08-04 11:19:28', '2024-08-04 11:19:28'),
(113495, 68, 1, '127.0.0.63', 'test-session-67d48f8cc1fa7', NULL, 'CL', 'Test City', 'mobile', 'Chrome', 'macOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-08-04 07:27:28', '2024-08-04 07:27:28'),
(113496, 68, 1, '127.0.0.77', 'test-session-67d48f8cc23f9', NULL, 'PE', 'Test City', 'mobile', 'Firefox', 'Android', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-07-28 22:22:28', '2024-07-28 22:22:28'),
(113497, 68, 1, '127.0.0.192', 'test-session-67d48f8cc28a0', NULL, 'PE', 'Test City', 'tablet', 'Safari', 'macOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-07-27 08:01:28', '2024-07-27 08:01:28'),
(113498, 68, 1, '127.0.0.26', 'test-session-67d48f8cc2d0b', NULL, 'PE', 'Test City', 'tablet', 'Chrome', 'macOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-07-26 04:56:28', '2024-07-26 04:56:28'),
(113499, 68, 1, '127.0.0.221', 'test-session-67d48f8cc31a6', NULL, 'PE', 'Test City', 'desktop', 'Firefox', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-07-25 10:47:28', '2024-07-25 10:47:28'),
(113500, 68, 1, '127.0.0.128', 'test-session-67d48f8cc35c5', NULL, 'PE', 'Test City', 'tablet', 'Firefox', 'Android', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-07-21 12:43:28', '2024-07-21 12:43:28'),
(113501, 68, 1, '127.0.0.30', 'test-session-67d48f8cc3aae', NULL, 'PE', 'Test City', 'desktop', 'Edge', 'Linux', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-07-21 01:30:28', '2024-07-21 01:30:28'),
(113502, 68, 1, '127.0.0.239', 'test-session-67d48f8cc3edd', NULL, 'PE', 'Test City', 'mobile', 'Chrome', 'Android', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-07-20 08:58:28', '2024-07-20 08:58:28'),
(113503, 68, 1, '127.0.0.198', 'test-session-67d48f8cc43a7', NULL, 'PE', 'Test City', 'tablet', 'Firefox', 'macOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-07-16 09:06:28', '2024-07-16 09:06:28'),
(113504, 68, 1, '127.0.0.174', 'test-session-67d48f8cc483d', NULL, 'UY', 'Test City', 'desktop', 'Firefox', 'macOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-07-15 17:10:28', '2024-07-15 17:10:28'),
(113505, 68, 1, '127.0.0.82', 'test-session-67d48f8cc4d33', NULL, 'UY', 'Test City', 'tablet', 'Chrome', 'macOS', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-07-13 06:45:28', '2024-07-13 06:45:28'),
(113506, 68, 1, '127.0.0.172', 'test-session-67d48f8cc5234', NULL, 'UY', 'Test City', 'tablet', 'Chrome', 'Android', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-07-06 12:09:28', '2024-07-06 12:09:28'),
(113507, 68, 1, '127.0.0.232', 'test-session-67d48f8cc5649', NULL, 'UY', 'Test City', 'mobile', 'Safari', 'iOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-07-03 04:51:28', '2024-07-03 04:51:28'),
(113508, 68, 1, '127.0.0.82', 'test-session-67d48f8cc5fb0', NULL, 'UY', 'Test City', 'desktop', 'Firefox', 'macOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-06-28 15:07:28', '2024-06-28 15:07:28'),
(113509, 68, 147, '127.0.0.1', 'gDkK9mKKuoeYQvxoUqOI2qpJhnhegLSTH0eThS35', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 23:21:53', '2025-03-14 23:21:53'),
(113510, 68, 147, '127.0.0.1', 'kS08xBWfx2a1durGR7TOa3hq7PYmNGGseQhdhtHM', NULL, 'BR', 'São Paulo', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-14 23:21:53', '2025-03-14 23:21:53'),
(113511, 68, 147, '127.0.0.1', 'rHdXRRtgiwbHvjZyBR4ZI8bTXR676R0B3A0YUVkd', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 23:27:35', '2025-03-14 23:27:35'),
(113513, 69, 147, '127.0.0.1', 'w5J8ZkOO1mCsijGFrpv7DSsSAVCUq5DisqzGn4AF', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-03-14 23:40:16', '2025-03-14 23:40:16'),
(113514, 69, 147, '127.0.0.1', 'AoSLFDKef28fXXYJM68RKeOFxe471kJHQGRSVBP3', NULL, 'BR', 'São Paulo', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-03-14 23:40:16', '2025-03-14 23:40:16'),
(113515, 68, 147, '138.59.131.211', '5LnfdLMxuGx78ly5cZYGOyEjAEwY53bzjA5AR0HM', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-04-09 23:14:49', '2025-04-09 23:14:49'),
(113516, 68, 147, '138.59.131.211', 'x1w7u8NARXKeepd80NpYhzhKZd18NBycPvOTSdy5', NULL, 'BR', 'Itapema', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-04-09 23:14:49', '2025-04-09 23:14:49'),
(113517, 69, 147, '138.59.131.211', '5LnfdLMxuGx78ly5cZYGOyEjAEwY53bzjA5AR0HM', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-04-09 23:15:25', '2025-04-09 23:15:25'),
(113518, 69, 147, '138.59.131.211', 'x1w7u8NARXKeepd80NpYhzhKZd18NBycPvOTSdy5', NULL, 'BR', 'Itapema', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-04-09 23:15:25', '2025-04-09 23:15:25'),
(113519, 69, 147, '138.59.131.211', '6h85ogdJ2OBkTAPDTPtQjdkIR01bDj8uCS7doYYD', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-04-10 00:21:55', '2025-04-10 00:21:55'),
(113520, 69, 147, '138.59.131.211', 'N7GYpHAqGshy5gMTXxWGYn3vmLHoqzcNmNw8igAB', NULL, 'BR', 'Itapema', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-04-10 00:21:56', '2025-04-10 00:21:56'),
(113521, 69, 147, '177.155.206.66', 'h1cztXGjycPXuZNvC5YAhBGBoh8uIwD9tj6zXNsI', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-05-02 03:14:33', '2025-05-02 03:14:33'),
(113522, 69, 1, '177.155.206.66', 'ydLne086YSReZ6WyZlOphWxv29EqfWVMwy39b8nO', NULL, 'BR', 'Itapema', 'desktop', 'Chrome', 'Windows', 'liveturb.com', 'https://liveturb.com/admin/kpi', NULL, NULL, NULL, NULL, 1, '2025-05-02 03:14:33', '2025-05-02 03:14:33'),
(113523, 68, 147, '177.155.206.66', 'p7ebpR9rNuiRk95tY472oWSqF3PRiY9sLgli7nS8', NULL, NULL, NULL, 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-05-02 03:32:47', '2025-05-02 03:32:47'),
(113524, 68, 147, '177.155.206.66', 'x8qnucAjV1lOZG0z9LM2hhqOp8wMuTDrshX2bRPl', NULL, 'BR', 'Itapema', 'desktop', 'Chrome', 'Windows', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-05-02 03:32:47', '2025-05-02 03:32:47');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `anuncios_backup`
--
ALTER TABLE `anuncios_backup`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `broad_cast_comments`
--
ALTER TABLE `broad_cast_comments`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `broad_cast_thumbnails`
--
ALTER TABLE `broad_cast_thumbnails`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `buy_plans`
--
ALTER TABLE `buy_plans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `buy_plans_email_unique` (`email`);

--
-- Índices de tabela `comment_frequencies`
--
ALTER TABLE `comment_frequencies`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `criativos`
--
ALTER TABLE `criativos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `criativos_anuncio_id_foreign` (`anuncio_id`);

--
-- Índices de tabela `criativos_backup`
--
ALTER TABLE `criativos_backup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `criativos_anuncio_id_foreign` (`anuncio_id`);

--
-- Índices de tabela `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Índices de tabela `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Índices de tabela `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Índices de tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Índices de tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices de tabela `pay_pal_plans`
--
ALTER TABLE `pay_pal_plans`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Índices de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices de tabela `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Índices de tabela `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Índices de tabela `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriptions_user_id_foreign` (`user_id`);

--
-- Índices de tabela `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `templates_user_id_foreign` (`user_id`);

--
-- Índices de tabela `template_views`
--
ALTER TABLE `template_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `template_views_user_id_foreign` (`user_id`),
  ADD KEY `template_views_user_id_created_at_index` (`user_id`,`created_at`);

--
-- Índices de tabela `temp_transcricoes`
--
ALTER TABLE `temp_transcricoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_stripe_id_index` (`stripe_id`);

--
-- Índices de tabela `user_billing_controls`
--
ALTER TABLE `user_billing_controls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_billing_controls_user_id_foreign` (`user_id`);

--
-- Índices de tabela `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_sessions_user_id_foreign` (`user_id`);

--
-- Índices de tabela `video_details`
--
ALTER TABLE `video_details`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `view_billing_records`
--
ALTER TABLE `view_billing_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `view_billing_records_user_id_billing_period_start_index` (`user_id`,`billing_period_start`),
  ADD KEY `view_billing_records_status_index` (`status`),
  ADD KEY `view_billing_records_user_id_status_index` (`user_id`,`status`);

--
-- Índices de tabela `view_statistics`
--
ALTER TABLE `view_statistics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `view_statistics_template_id_created_at_index` (`template_id`,`created_at`),
  ADD KEY `view_statistics_user_id_created_at_index` (`user_id`,`created_at`),
  ADD KEY `view_statistics_template_id_viewer_ip_created_at_index` (`template_id`,`viewer_ip`,`created_at`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `anuncios_backup`
--
ALTER TABLE `anuncios_backup`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `broad_cast_comments`
--
ALTER TABLE `broad_cast_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12807;

--
-- AUTO_INCREMENT de tabela `broad_cast_thumbnails`
--
ALTER TABLE `broad_cast_thumbnails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT de tabela `buy_plans`
--
ALTER TABLE `buy_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `comment_frequencies`
--
ALTER TABLE `comment_frequencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `criativos`
--
ALTER TABLE `criativos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;

--
-- AUTO_INCREMENT de tabela `criativos_backup`
--
ALTER TABLE `criativos_backup`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de tabela `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de tabela `pay_pal_plans`
--
ALTER TABLE `pay_pal_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT de tabela `templates`
--
ALTER TABLE `templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `template_views`
--
ALTER TABLE `template_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46029;

--
-- AUTO_INCREMENT de tabela `temp_transcricoes`
--
ALTER TABLE `temp_transcricoes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT de tabela `user_billing_controls`
--
ALTER TABLE `user_billing_controls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de tabela `video_details`
--
ALTER TABLE `video_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de tabela `view_billing_records`
--
ALTER TABLE `view_billing_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de tabela `view_statistics`
--
ALTER TABLE `view_statistics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113525;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `templates`
--
ALTER TABLE `templates`
  ADD CONSTRAINT `templates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `template_views`
--
ALTER TABLE `template_views`
  ADD CONSTRAINT `template_views_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `user_billing_controls`
--
ALTER TABLE `user_billing_controls`
  ADD CONSTRAINT `user_billing_controls_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD CONSTRAINT `user_sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `view_billing_records`
--
ALTER TABLE `view_billing_records`
  ADD CONSTRAINT `view_billing_records_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `view_statistics`
--
ALTER TABLE `view_statistics`
  ADD CONSTRAINT `view_statistics_template_id_foreign` FOREIGN KEY (`template_id`) REFERENCES `video_details` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `view_statistics_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
