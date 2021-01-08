-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08-Jan-2021 às 20:48
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
-- Banco de dados: `lfadmin`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `adms_grps_pgs`
--

CREATE TABLE `adms_grps_pgs` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ordem` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `adms_grps_pgs`
--

INSERT INTO `adms_grps_pgs` (`id`, `nome`, `ordem`, `created`, `modified`) VALUES
(1, 'Listar', 1, '2018-05-23 00:00:00', '2018-06-29 21:36:41'),
(2, 'Cadastrar', 2, '2018-05-23 00:00:00', '2018-06-29 22:30:06'),
(3, 'Editar', 3, '2018-05-23 00:00:00', '2018-06-29 22:30:06'),
(4, 'Apagar', 4, '2018-05-23 00:00:00', NULL),
(5, 'Visualizar', 5, '2018-05-23 00:00:00', NULL),
(6, 'Outros', 6, '2018-05-23 00:00:00', NULL),
(7, 'Acesso', 7, '2018-05-23 00:00:00', '2018-06-29 21:35:16'),
(8, 'Alterar Ordem', 8, '2018-06-23 00:00:00', '2018-06-29 21:35:16');

-- --------------------------------------------------------

--
-- Estrutura da tabela `adms_paginas`
--

CREATE TABLE `adms_paginas` (
  `id` int(11) NOT NULL,
  `controller` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `metodo` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `menu_controller` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `menu_metodo` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `nome_pagina` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `obs` text COLLATE utf8_unicode_ci NOT NULL,
  `lib_pub` int(11) NOT NULL DEFAULT 2,
  `icone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adms_grps_pg_id` int(11) NOT NULL,
  `adms_tps_pg_id` int(11) NOT NULL,
  `adms_sits_pg_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `adms_paginas`
--

INSERT INTO `adms_paginas` (`id`, `controller`, `metodo`, `menu_controller`, `menu_metodo`, `nome_pagina`, `obs`, `lib_pub`, `icone`, `adms_grps_pg_id`, `adms_tps_pg_id`, `adms_sits_pg_id`, `created`, `modified`) VALUES
(1, 'Home', 'index', 'home', 'index', 'Dashboard', 'PÃ¡gina inicial do sistema administrativo             ', 2, 'fas fa-tachometer-alt', 1, 1, 1, '2018-05-23 00:00:00', '2018-06-25 11:27:06'),
(2, 'Usuarios', 'listar', 'usuarios', 'listar', 'UsuÃ¡rios', 'Pagina para listar os usuÃ¡rios                ', 2, 'fas fa-users', 1, 1, 1, '2018-05-23 00:00:00', '2018-06-25 11:29:02'),
(3, 'Login', 'acesso', 'login', 'acesso', 'Acesso', 'PÃ¡gina de login                ', 1, '', 7, 1, 1, '2018-05-23 00:00:00', '2018-06-25 11:29:15'),
(4, 'Login', 'logout', 'login', 'logout', 'Sair', 'PÃ¡gina para sair do administrativo                ', 1, '', 7, 1, 1, '2018-05-23 00:00:00', '2018-06-25 11:29:25'),
(5, 'NovoUsuario', 'novoUsuario', 'novo-usuario', 'novo-usuario', 'Novo Usuário', 'PÃ¡gina para cadastrar novo usuÃ¡rio na pagina de login                                                ', 1, '', 2, 1, 1, '2018-05-23 00:00:00', '2018-06-25 11:29:38'),
(6, 'Confirmar', 'confirmarEmail', 'confirmar', 'confirmar-email', 'Confirmar e-mail', 'PÃ¡gina para confirmar e-mail                ', 1, '', 7, 1, 1, '2018-06-23 00:00:00', '2018-06-25 11:29:56'),
(7, 'EsqueceuSenha', 'esqueceuSenha', 'esqueceu-senha', 'esqueceu-senha', 'Esqueceu a senha', 'PÃ¡gina para recuperar a senha                ', 1, '', 7, 1, 1, '2018-06-23 00:00:00', '2018-06-25 11:30:08'),
(8, 'AtualizarSenha', 'atualizarSenha', 'atualizar-senha', 'atualizar-senha', 'Atualizar a senha', 'Página para atualizar a senha                ', 1, '', 7, 1, 1, '2018-06-23 00:00:00', '2018-06-25 11:30:22'),
(9, 'VerPerfil', 'perfil', 'ver-perfil', 'perfil', 'Ver Perfil', 'PÃ¡gina para o usuÃ¡rio ver o seu perfil                ', 2, '', 5, 1, 1, '2018-06-23 00:00:00', '2018-06-25 11:33:03'),
(10, 'AlterarSenha', 'altSenha', 'alterar-senha', 'alt-senha', 'Alterar Senha', 'PÃ¡gina para o prÃ³prio usuÃ¡rio alterar a sua senha                ', 2, '', 3, 1, 1, '2018-06-23 00:00:00', '2018-06-25 11:32:45'),
(11, 'EditarPerfil', 'altPerfil', 'editar-perfil', 'alt-perfil', 'Editar Perfil', 'PÃ¡gina para o prÃ³prio usuÃ¡rio editar os dados do seu perfil                ', 2, '', 3, 1, 1, '2018-06-23 00:00:00', '2018-06-25 11:33:41'),
(12, 'VerUsuario', 'verUsuario', 'ver-usuario', 'ver-usuario', 'Ver UsuÃ¡rio', 'PÃ¡gina para ver detalhes do usuÃ¡rio                ', 2, '', 5, 1, 1, '2018-06-23 00:00:00', '2018-06-25 11:31:52'),
(13, 'EditarSenha', 'editSenha', 'editar-senha', 'edit-senha', 'Editar Senha', 'PÃ¡gina para o administrador altera a senha do usuÃ¡rio.                ', 2, '', 3, 1, 1, '2018-06-23 00:00:00', '2018-06-25 11:31:09'),
(14, 'EditarUsuario', 'editUsuario', 'editar-usuario', 'edit-usuario', 'Editar UsuÃ¡rio', 'PÃ¡gina para editar os dados do usuÃ¡rio                ', 2, '', 3, 1, 1, '2018-06-23 00:00:00', '2018-06-25 11:31:33'),
(15, 'CadastrarUsuario', 'cadUsuario', 'cadastrar-usuario', 'cad-usuario', 'Cadastrar UsuÃ¡rio', 'PÃ¡gina para cadastrar novo usuÃ¡rio                ', 2, '', 2, 1, 1, '2018-06-23 00:00:00', '2018-06-25 11:34:31'),
(16, 'ApagarUsuario', 'apagarUsuario', 'apagar-usuario', 'apagar-usuario', 'Apagar UsuÃ¡rio', 'PÃ¡gina para apagar usuÃ¡rio                ', 2, '', 4, 1, 1, '2018-06-23 00:00:00', '2018-06-25 11:34:49'),
(17, 'NivelAcesso', 'listar', 'nivel-acesso', 'listar', 'NÃ­vel de Acesso', 'PÃ¡gina para listar nÃ­vel de acesso                ', 2, 'fas fa-key', 1, 1, 1, '2018-06-23 00:00:00', '2018-06-25 11:35:16'),
(18, 'CadastrarNivAc', 'cadNivAc', 'cadastrar-niv-ac', 'cad-niv-ac', 'Cadastrar NÃ­vel de Acesso', 'PÃ¡gina para cadastrar nÃ­vel de acesso                ', 2, '', 2, 1, 1, '2018-06-23 00:00:00', '2018-06-25 11:35:40'),
(19, 'VerNivAc', 'VerNivAc', 'ver-niv-ac', 'ver-niv-ac', 'Detalhes do NÃ­vel de Acesso', 'PÃ¡gina para ver detalhes do nÃ­vel de acesso                ', 2, '', 5, 1, 1, '2018-06-23 00:00:00', '2018-06-25 11:36:05'),
(20, 'EditarNivAc', 'editNivAc', 'editar-niv-ac', 'edit-niv-ac', 'Editar NÃ­vel de Acesso', 'PÃ¡gina para editar nÃ­vel de acesso                ', 2, '', 3, 1, 1, '2018-06-23 00:00:00', '2018-06-25 11:36:30'),
(21, 'ApagarNivAc', 'apagarNivAc', 'apagar-niv-ac', 'apagar-niv-ac', 'Apagar NÃ­vel de Acesso', 'PÃ¡gina para apagar nÃ­vel de acesso                ', 2, '', 4, 1, 1, '2018-06-23 00:00:00', '2018-06-25 11:36:56'),
(22, 'AltOrdemNivAc', 'altOrdemNivAc', 'alt-ordem-niv-ac', 'alt-ordem-niv-ac', 'Alterar ordem nÃ­vel de acesso', 'PÃ¡gina para alterar ordem do nÃ­vel de acesso                ', 2, '', 8, 1, 1, '2018-06-23 00:00:00', '2018-06-25 11:37:24'),
(23, 'Pagina', 'listar', 'pagina', 'listar', 'Listar PÃ¡ginas', 'PÃ¡gina para listar as paginas do administrativo                ', 2, 'fas fa-file-alt', 1, 1, 1, '2018-06-23 00:00:00', '2018-06-25 11:37:43'),
(24, 'CadastrarPagina', 'cadPagina', 'cadastrar-pagina', 'cad-pagina', 'Cadastrar Pagina', 'FormulÃ¡rio para cadastrar pagina                ', 2, '', 2, 1, 1, '2018-06-23 00:00:00', '2018-06-25 11:37:59'),
(25, 'VerPagina', 'verPagina', 'ver-pagina', 'ver-pagina', 'Visualizar PÃ¡gina', 'PÃ¡gina para ver detalhes da pÃ¡gina', 2, '', 5, 1, 1, '2018-06-22 14:25:21', NULL),
(26, 'EditarPagina', 'editPagina', 'editar-pagina', 'edit-pagina', 'Editar PÃ¡gina', 'FormulÃ¡rio para editar a pÃ¡gina                                                                                ', 2, '', 3, 1, 1, '2018-06-22 14:43:47', '2018-06-22 15:40:01'),
(27, 'ApagarPagina', 'apagarPagina', 'apagar-pagina', 'apagar-pagina', 'Apagar PÃ¡gina', 'PÃ¡gina para apagar pÃ¡gina                ', 2, '', 4, 1, 1, '2018-06-22 19:17:43', NULL),
(28, 'Permissoes', 'listar', 'permissoes', 'listar', 'PermissÃ£o', 'PÃ¡gina para listar as permissÃµes do nÃ­vel de acesso                ', 2, '', 1, 1, 1, '2018-06-24 11:59:53', NULL),
(29, 'LibPermi', 'libPermi', 'lib-permi', 'lib-permi', 'Liberar PermissÃ£o', 'PÃ¡gina para liberar permissÃ£o                                ', 2, '', 3, 1, 1, '2018-06-24 12:52:42', '2018-06-24 12:54:14'),
(30, 'LibMenu', 'libMenu', 'lib-menu', 'lib-menu', 'Liberar no menu', 'PÃ¡gina para liberar ou bloquear a pÃ¡gina no menu                ', 2, '', 3, 1, 1, '2018-06-25 09:48:29', NULL),
(31, 'LibDropdown', 'libDropdown', 'lib-dropdown', 'lib-dropdown', 'Liberar Dropdown', 'PÃ¡gina para liberar ou bloquear a pÃ¡gina a ser apresentado como dropdown no menu                ', 2, '', 3, 1, 1, '2018-06-25 10:24:39', '2018-06-25 10:29:10'),
(32, 'AltOrdemMenu', 'altOrdemMenu', 'alt-ordem-menu', 'alt-ordem-menu', 'Alterar Ordem Menu', 'PÃ¡gina para alterar a ordem das pÃ¡ginas no menu                ', 2, '', 3, 1, 1, '2018-06-25 10:56:36', NULL),
(33, 'SincroPgNivAc', 'sincroPgNivAc', 'sincro-pg-niv-ac', 'sincro-pg-niv-ac', 'Sincronizar PermissÃµes', 'PÃ¡gina para sincronizar as permissÃµes de acesso a cada nÃ­vel de acesso para as pÃ¡ginas do sistema.                ', 2, '', 3, 1, 1, '2018-06-26 12:23:37', NULL),
(34, 'EditarNivAcPgMenu', 'editNivAcPgMenu', 'editar-niv-ac-pg-menu', 'edit-niv-ac-pg-menu', 'Editar Item de Menu da PÃ¡gina', 'FormulÃ¡rio para editar o item de menu que a pÃ¡gina pertence para um determinado nÃ­vel de acesso', 2, '', 3, 1, 1, '2018-06-28 16:11:35', NULL),
(35, 'Menu', 'listar', 'menu', 'listar', 'Itens de Menu', 'Listar os itens do menu', 2, 'fab fa-elementor', 1, 1, 1, '2018-06-28 01:05:34', NULL),
(36, 'CadastrarMenu', 'cadMenu', 'cadastrar-menu', 'cad-menu', 'Cadastrar Item de Menu', 'FormulÃ¡rio para cadastrar item de menu', 2, '', 2, 1, 1, '2018-06-28 01:20:26', NULL),
(37, 'VerMenu', 'verMenu', 'ver-menu', 'ver-menu', 'Ver item de menu', 'PÃ¡gina para ver detalhes do item de menu', 2, '', 5, 1, 1, '2018-06-28 01:23:25', NULL),
(38, 'EditarMenu', 'editMenu', 'editar-menu', 'edit-menu', 'Editar item de menu', 'FormulÃ¡rio para editar o item de menu', 2, '', 3, 1, 1, '2018-06-28 01:32:29', NULL),
(39, 'ApagarMenu', 'apagarMenu', 'apagar-menu', 'apagar-menu', 'Apagar Item de Menu', 'PÃ¡gina para apagar item de menu', 2, '', 4, 1, 1, '2018-06-28 01:44:13', NULL),
(40, 'AltOrdemItemMenu', 'altOrdemItemMenu', 'alt-ordem-item-menu', 'alt-ordem-item-menu', 'Alterar Ordem Item de Menu', 'PÃ¡gina para alterar a ordem do itens no menu', 2, '', 8, 1, 1, '2018-06-28 01:58:16', NULL),
(41, 'EditarFormCadUsuario', 'editFormCadUsuario', 'editar-form-cad-usuario', 'edit-form-cad-usuario', 'Cadastro de Login', 'FormulÃ¡rio para editar as informaÃ§Ãµes do formulÃ¡rio cadastrar usuÃ¡rio na pÃ¡gina de login                ', 2, 'fas fa-edit', 3, 1, 1, '2018-06-29 18:33:56', '2018-06-29 18:35:03'),
(42, 'EditarConfEmail', 'editConfEmail', 'editar-conf-email', 'edit-conf-email', 'ConfiguraÃ§Ã£o de E-mail', 'FormulÃ¡rio para editar as configuraÃ§Ã£o do servidor de envio de e-mail', 2, 'fas fa-at', 2, 1, 1, '2018-06-29 18:56:15', NULL),
(43, 'Cor', 'listar', 'cor', 'listar', 'Cores', 'Listar as cores dos botÃµes                                                                                ', 2, 'fas fa-tint', 1, 1, 1, '2018-06-29 19:32:21', '2018-06-29 19:45:56'),
(44, 'VerCor', 'verCor', 'ver-cor', 'ver-cor', 'Ver Cores', 'PÃ¡gina para ver detalhes da cor do botÃ£o', 2, '', 5, 1, 1, '2018-06-29 19:50:19', NULL),
(45, 'EditarCor', 'editCor', 'editar-cor', 'edit-cor', 'Editar a Cor', 'FormulÃ¡rio para editar as cores dos botÃµes', 2, '', 3, 1, 1, '2018-06-29 19:59:53', NULL),
(46, 'CadastrarCor', 'cadCor', 'cadastrar-cor', 'cad-cor', 'Cadastrar Cor', 'FormulÃ¡rio para cadastrar a cor do botÃ£o', 2, '', 2, 1, 1, '2018-06-29 20:09:35', NULL),
(47, 'ApagarCor', 'apagarCor', 'apagar-cor', 'apagar-cor', 'Apagar a Cor', 'PÃ¡gina para apagar a cor do botÃ£o', 2, '', 4, 1, 1, '2018-06-29 20:17:36', NULL),
(48, 'GrupoPg', 'listar', 'grupo-pg', 'listar', 'Grupo de PÃ¡gina', 'Listar os grupos das pÃ¡ginas', 2, 'fas fa-file-alt', 1, 1, 1, '2018-06-29 20:29:31', NULL),
(49, 'VerGrupoPg', 'verGrupoPg', 'ver-grupo-pg', 'ver-grupo-pg', 'Ver Grupo de PÃ¡gina', 'PÃ¡gina para ver detalhes do grupo de pÃ¡gina', 2, '', 5, 1, 1, '2018-06-29 20:40:11', NULL),
(50, 'CadastrarGrupoPg', 'cadGrupoPg', 'cadastrar-grupo-pg', 'cad-grupo-pg', 'Cadastro Grupo de PÃ¡gina', 'FormulÃ¡rio para cadastrar novo grupo de pÃ¡gina', 2, '', 2, 1, 1, '2018-06-29 20:58:30', NULL),
(51, 'EditarGrupoPg', 'editGrupoPg', 'editar-grupo-pg', 'edit-grupo-pg', 'Editar Grupo de PÃ¡gina', 'FormulÃ¡rio para editar os dados do grupo de pÃ¡gina', 2, '', 3, 1, 1, '2018-06-29 21:08:41', NULL),
(52, 'ApagarGrupoPg', 'apagarGrupoPg', 'apagar-grupo-pg', 'apagar-grupo-pg', 'Apagar Grupo de PÃ¡gina', 'PÃ¡gina para apagar grupo de pÃ¡gina', 2, '', 4, 1, 1, '2018-06-29 21:19:33', NULL),
(53, 'AltOrdemGrupoPg', 'altOrdemGrupoPg', 'alt-ordem-grupo-pg', 'alt-ordem-grupo-pg', 'Alterar Ordem Grupo Pg', 'Altera a ordem do grupo de pÃ¡gina', 2, '', 8, 1, 1, '2018-06-29 21:31:23', NULL),
(54, 'TipoPg', 'listar', 'tipo-pg', 'listar', 'Tipo de PÃ¡gina', 'Listar os tipos de pÃ¡ginas', 2, 'fas fa-list-ol', 1, 1, 1, '2018-06-29 21:40:39', NULL),
(55, 'CadastrarTipoPg', 'cadTipoPg', 'cadastrar-tipo-pg', 'cad-tipo-pg', 'Cadastrar Tipo de PÃ¡gina', 'FormulÃ¡rio para cadastrar o tipo de pÃ¡gina', 2, '', 2, 1, 1, '2018-06-29 21:50:13', NULL),
(56, 'EditarTipoPg', 'editTipoPg', 'editar-tipo-pg', 'edit-tipo-pg', 'Editar Tipo de PÃ¡gina', 'FormulÃ¡rio para editar o tipo de pÃ¡gina', 2, '', 3, 1, 1, '2018-06-29 22:13:11', NULL),
(57, 'VerTipoPg', 'verTipoPg', 'ver-tipo-pg', 'ver-tipo-pg', 'Ver Tipo de PÃ¡gina', 'PÃ¡gina para ver detalhes do tipo de pÃ¡gina', 2, '', 5, 1, 1, '2018-06-29 22:21:25', NULL),
(58, 'ApagarTipoPg', 'apagarTipoPg', 'apagar-tipo-pg', 'apagar-tipo-pg', 'Apagar Tipo de PÃ¡gina', 'PÃ¡gina para apagar o tipo de pÃ¡gina', 2, '', 4, 1, 1, '2018-06-29 22:26:52', NULL),
(59, 'AltOrdemTipoPg', 'altOrdemTipoPg', 'alt-ordem-tipo-pg', 'alt-ordem-tipo-pg', 'Alterar Ordem Tipo Pg', 'PÃ¡gina para alterar a ordem do tipo de pÃ¡ginas        ', 2, '', 8, 1, 1, '2018-06-29 22:38:00', NULL),
(60, 'Situacao', 'listar', 'situacao', 'listar', 'SituaÃ§Ã£o', 'PÃ¡gina para listar as situaÃ§Ãµes                ', 2, 'fas fa-exclamation-triangle', 1, 1, 1, '2018-06-29 22:48:28', '2018-06-29 22:53:17'),
(61, 'VerSit', 'verSit', 'ver-sit', 'ver-sit', 'Ver SituaÃ§Ã£o', 'PÃ¡gina para ver detalhes da situaÃ§Ã£o', 2, '', 5, 1, 1, '2018-06-29 23:04:17', NULL),
(62, 'CadastrarSit', 'cadSit', 'cadastrar-sit', 'cad-sit', 'Cadastrar SituaÃ§Ã£o', 'FormulÃ¡rio para cadastrar situaÃ§Ã£o', 2, '', 2, 1, 1, '2018-06-29 23:11:35', NULL),
(63, 'EditarSit', 'editSit', 'editar-sit', 'edit-sit', 'Editar a situaÃ§Ã£o', 'FormulÃ¡rio para editar a situaÃ§Ã£o', 2, '', 3, 1, 1, '2018-06-29 23:20:52', NULL),
(64, 'ApagarSit', 'apagarSit', 'apagar-sit', 'apagar-sit', 'Apagar SituaÃ§Ã£o', 'PÃ¡gina para apagar situaÃ§Ã£o', 2, '', 3, 1, 1, '2018-06-29 23:27:34', NULL),
(65, 'SituacaoUser', 'listar', 'situacao-user', 'listar', 'SituaÃ§Ã£o dos UsuÃ¡rios', 'Listar as situaÃ§Ã£o de usuÃ¡rio                ', 2, 'far fa-id-badge', 1, 1, 1, '2018-06-29 23:44:50', '2018-06-29 23:46:55'),
(66, 'VerSitUser', 'verSitUser', 'ver-sit-user', 'ver-sit-user', 'Ver SituaÃ§Ã£o de UsuÃ¡rio', 'PÃ¡gina para ver detalhes da situaÃ§Ã£o de usuÃ¡rio', 2, '', 5, 1, 1, '2018-06-29 23:53:53', NULL),
(67, 'CadastrarSitUser', 'cadSitUser', 'cadastrar-sit-user', 'cad-sit-user', 'Cadastrar SituaÃ§Ã£o de UsuÃ¡rio', 'PÃ¡gina para cadastrar situaÃ§Ã£o de usuÃ¡rio', 2, '', 2, 1, 1, '2018-06-29 23:57:43', NULL),
(68, 'EditarSitUser', 'editSitUser', 'editar-sit-user', 'edit-sit-user', 'Editar SituaÃ§Ã£o de UsuÃ¡rio', 'FormulÃ¡rio para editar situaÃ§Ã£o de usuÃ¡rio', 2, '', 3, 1, 1, '2018-06-30 00:03:44', NULL),
(69, 'ApagarSitUser', 'apagarSitUser', 'apagar-sit-user', 'apagar-sit-user', 'Apagar SituaÃ§Ã£o de UsuÃ¡rio', 'PÃ¡gina para apagar situaÃ§Ã£o de usuÃ¡rio', 2, '', 4, 1, 1, '2018-06-30 00:09:08', NULL),
(70, 'SituacaoPg', 'listar', 'situacao-pg', 'listar', 'SituaÃ§Ã£o de PÃ¡gina', 'Listar as situaÃ§Ãµes de pÃ¡ginas                                ', 2, 'fas fa-exclamation', 1, 1, 1, '2018-06-30 00:22:52', '2018-06-30 00:29:39'),
(71, 'VerSitPg', 'verSitPg', 'ver-sit-pg', 'ver-sit-pg', 'Ver SituaÃ§Ã£o de PÃ¡gina', 'PÃ¡gina para ver detalhes da situaÃ§Ã£o de pÃ¡gina      ', 2, '', 5, 1, 1, '2018-06-30 00:35:47', NULL),
(72, 'CadastrarSitPg', 'cadSitPg', 'cadastrar-sit-pg', 'cad-sit-pg', 'Cadastrar SituaÃ§Ã£o de PÃ¡gina', 'FormulÃ¡rio para cadastrar situaÃ§Ã£o de pÃ¡gina', 2, '', 2, 1, 1, '2018-06-30 00:41:58', NULL),
(73, 'EditarSitPg', 'editSitPg', 'editar-sit-pg', 'edit-sit-pg', 'Editar situaÃ§Ã£o de pÃ¡gina', 'FormulÃ¡rio para editar situaÃ§Ã£o de pÃ¡gina                ', 2, '', 3, 1, 1, '2018-06-30 00:47:33', '2018-06-30 00:47:57'),
(74, 'ApagarSitPg', 'apagarSitPg', 'apagar-sit-pg', 'apagar-sit-pg', 'Apagar SituaÃ§Ã£o de PÃ¡gina', 'PÃ¡gina para apagar situaÃ§Ã£o de pÃ¡gina', 2, '', 4, 1, 1, '2018-06-30 00:53:21', NULL),
(75, 'Login', 'logout', '', '', 'Sair', 'Pagina para sair do adminitrativo', 1, NULL, 7, 1, 1, '2020-12-15 11:41:21', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `adms_sits_pgs`
--

CREATE TABLE `adms_sits_pgs` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cor` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `adms_sits_pgs`
--

INSERT INTO `adms_sits_pgs` (`id`, `nome`, `cor`, `created`, `modified`) VALUES
(1, 'Ativo', 'success', '2018-03-23 00:00:00', NULL),
(2, 'Inativo', 'danger', '2018-03-23 00:00:00', NULL),
(3, 'Analise', 'primary', '2018-03-23 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `adms_tps_pgs`
--

CREATE TABLE `adms_tps_pgs` (
  `id` int(11) NOT NULL,
  `tipo` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `nome` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `obs` text COLLATE utf8_unicode_ci NOT NULL,
  `ordem` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `adms_tps_pgs`
--

INSERT INTO `adms_tps_pgs` (`id`, `tipo`, `nome`, `obs`, `ordem`, `created`, `modified`) VALUES
(1, 'adms', 'Administrativo', 'Core do Administrativo', 1, '2018-05-23 00:00:00', '2018-06-29 22:41:45');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `adms_grps_pgs`
--
ALTER TABLE `adms_grps_pgs`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `adms_paginas`
--
ALTER TABLE `adms_paginas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `adms_sits_pgs`
--
ALTER TABLE `adms_sits_pgs`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `adms_tps_pgs`
--
ALTER TABLE `adms_tps_pgs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `adms_grps_pgs`
--
ALTER TABLE `adms_grps_pgs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `adms_paginas`
--
ALTER TABLE `adms_paginas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de tabela `adms_sits_pgs`
--
ALTER TABLE `adms_sits_pgs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `adms_tps_pgs`
--
ALTER TABLE `adms_tps_pgs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
