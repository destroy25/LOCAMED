USE [BIJOU]
GO
/****** Object:  Table [dbo].[INTERFACE_MENU]    Script Date: 04/10/2017 15:27:25 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[INTERFACE_MENU](
	[id_menu] [smallint] NOT NULL,
	[id_parent] [smallint] NOT NULL,
	[menu] [varchar](255) NULL,
	[icon] [varchar](255) NULL,
	[link] [varchar](255) NULL,
	[uniq] [smallint] NULL
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[INTERFACE_MENU_DROIT]    Script Date: 04/10/2017 15:27:25 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[INTERFACE_MENU_DROIT](
	[id_menu_droit] [smallint] NOT NULL,
	[id_menu] [smallint] NOT NULL,
	[id_profil] [smallint] NOT NULL,
	[active] [smallint] NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[INTERFACE_PROFIL]    Script Date: 04/10/2017 15:27:25 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[INTERFACE_PROFIL](
	[id_profil] [smallint] NOT NULL,
	[profil] [varchar](255) NULL
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[INTERFACE_USER]    Script Date: 04/10/2017 15:27:25 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[INTERFACE_USER](
	[id_user] [smallint] NOT NULL,
	[login] [varchar](255) NULL,
	[mdp] [varchar](255) NULL,
	[nom] [varchar](255) NULL,
	[prenom] [varchar](255) NULL,
	[email] [varchar](255) NULL,
	[depot] [smallint] NULL,
	[compteg] [varchar](50) NULL,
	[id_profil] [smallint] NULL
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
INSERT [dbo].[INTERFACE_MENU] ([id_menu], [id_parent], [menu], [icon], [link], [uniq]) VALUES (1, 0, N'Accueil', N'font-icon font-icon-dashboard', N'index.php', 1)
GO
INSERT [dbo].[INTERFACE_MENU] ([id_menu], [id_parent], [menu], [icon], [link], [uniq]) VALUES (2, 0, N'Gestion Devis', N'fa fa-file', N'', 0)
GO
INSERT [dbo].[INTERFACE_MENU] ([id_menu], [id_parent], [menu], [icon], [link], [uniq]) VALUES (3, 2, N'Saisie Devis', N'', N'creation_devis.php', 0)
GO
INSERT [dbo].[INTERFACE_MENU] ([id_menu], [id_parent], [menu], [icon], [link], [uniq]) VALUES (4, 2, N'Liste Devis', N'', N'list_devis.php', 0)
GO
INSERT [dbo].[INTERFACE_MENU] ([id_menu], [id_parent], [menu], [icon], [link], [uniq]) VALUES (5, 0, N'Gestion Factures', N'fa fa-file-text', N'', 0)
GO
INSERT [dbo].[INTERFACE_MENU] ([id_menu], [id_parent], [menu], [icon], [link], [uniq]) VALUES (6, 5, N'Liste Factures', N'', N'list_factures.php', 0)
GO
INSERT [dbo].[INTERFACE_MENU] ([id_menu], [id_parent], [menu], [icon], [link], [uniq]) VALUES (7, 5, N'Saisie Reglement', N'', N'saisie_reglement.php', 0)
GO
INSERT [dbo].[INTERFACE_MENU] ([id_menu], [id_parent], [menu], [icon], [link], [uniq]) VALUES (8, 0, N'Gestion Logistique', N'fa fa-truck', N'', 0)
GO
INSERT [dbo].[INTERFACE_MENU] ([id_menu], [id_parent], [menu], [icon], [link], [uniq]) VALUES (9, 8, N'Liste des Bon de Livraisons', N'', N'list_bl.php', 0)
GO
INSERT [dbo].[INTERFACE_MENU] ([id_menu], [id_parent], [menu], [icon], [link], [uniq]) VALUES (10, 8, N'Validation BL', N'', N'validation_bl.php', 0)
GO
INSERT [dbo].[INTERFACE_MENU] ([id_menu], [id_parent], [menu], [icon], [link], [uniq]) VALUES (11, 0, N'Gestion Retour', N'fa fa-sign-in', N'', 0)
GO
INSERT [dbo].[INTERFACE_MENU] ([id_menu], [id_parent], [menu], [icon], [link], [uniq]) VALUES (12, 11, N'Saisie Retour', N'', N'creation_retour.php', 0)
GO
INSERT [dbo].[INTERFACE_MENU] ([id_menu], [id_parent], [menu], [icon], [link], [uniq]) VALUES (13, 11, N'Liste des Retours', N'', N'list_retour.php', 0)
GO
INSERT [dbo].[INTERFACE_MENU] ([id_menu], [id_parent], [menu], [icon], [link], [uniq]) VALUES (14, 0, N'Gestion Clients', N'fa fa-user', N'', 0)
GO
INSERT [dbo].[INTERFACE_MENU] ([id_menu], [id_parent], [menu], [icon], [link], [uniq]) VALUES (15, 14, N'Saisie Client', N'', N'creation_client.php', 0)
GO
INSERT [dbo].[INTERFACE_MENU] ([id_menu], [id_parent], [menu], [icon], [link], [uniq]) VALUES (17, 14, N'Liste Clients', N'', N'list_client.php', 0)
GO
INSERT [dbo].[INTERFACE_MENU_DROIT] ([id_menu_droit], [id_menu], [id_profil], [active]) VALUES (1, 1, 1, 1)
GO
INSERT [dbo].[INTERFACE_MENU_DROIT] ([id_menu_droit], [id_menu], [id_profil], [active]) VALUES (2, 2, 1, 1)
GO
INSERT [dbo].[INTERFACE_MENU_DROIT] ([id_menu_droit], [id_menu], [id_profil], [active]) VALUES (3, 3, 1, 1)
GO
INSERT [dbo].[INTERFACE_MENU_DROIT] ([id_menu_droit], [id_menu], [id_profil], [active]) VALUES (4, 4, 1, 1)
GO
INSERT [dbo].[INTERFACE_MENU_DROIT] ([id_menu_droit], [id_menu], [id_profil], [active]) VALUES (5, 5, 1, 1)
GO
INSERT [dbo].[INTERFACE_MENU_DROIT] ([id_menu_droit], [id_menu], [id_profil], [active]) VALUES (6, 6, 1, 1)
GO
INSERT [dbo].[INTERFACE_MENU_DROIT] ([id_menu_droit], [id_menu], [id_profil], [active]) VALUES (7, 1, 2, 1)
GO
INSERT [dbo].[INTERFACE_MENU_DROIT] ([id_menu_droit], [id_menu], [id_profil], [active]) VALUES (8, 2, 2, 1)
GO
INSERT [dbo].[INTERFACE_MENU_DROIT] ([id_menu_droit], [id_menu], [id_profil], [active]) VALUES (9, 4, 2, 1)
GO
INSERT [dbo].[INTERFACE_MENU_DROIT] ([id_menu_droit], [id_menu], [id_profil], [active]) VALUES (10, 5, 2, 1)
GO
INSERT [dbo].[INTERFACE_MENU_DROIT] ([id_menu_droit], [id_menu], [id_profil], [active]) VALUES (11, 6, 2, 1)
GO
INSERT [dbo].[INTERFACE_MENU_DROIT] ([id_menu_droit], [id_menu], [id_profil], [active]) VALUES (12, 7, 2, 1)
GO
INSERT [dbo].[INTERFACE_MENU_DROIT] ([id_menu_droit], [id_menu], [id_profil], [active]) VALUES (13, 1, 3, 1)
GO
INSERT [dbo].[INTERFACE_MENU_DROIT] ([id_menu_droit], [id_menu], [id_profil], [active]) VALUES (14, 8, 3, 1)
GO
INSERT [dbo].[INTERFACE_MENU_DROIT] ([id_menu_droit], [id_menu], [id_profil], [active]) VALUES (15, 9, 3, 1)
GO
INSERT [dbo].[INTERFACE_MENU_DROIT] ([id_menu_droit], [id_menu], [id_profil], [active]) VALUES (16, 10, 3, 1)
GO
INSERT [dbo].[INTERFACE_MENU_DROIT] ([id_menu_droit], [id_menu], [id_profil], [active]) VALUES (17, 11, 3, 1)
GO
INSERT [dbo].[INTERFACE_MENU_DROIT] ([id_menu_droit], [id_menu], [id_profil], [active]) VALUES (18, 12, 3, 1)
GO
INSERT [dbo].[INTERFACE_MENU_DROIT] ([id_menu_droit], [id_menu], [id_profil], [active]) VALUES (19, 13, 3, 1)
GO
INSERT [dbo].[INTERFACE_PROFIL] ([id_profil], [profil]) VALUES (1, N'Agent Commercial')
GO
INSERT [dbo].[INTERFACE_PROFIL] ([id_profil], [profil]) VALUES (2, N'Agent de Caisse')
GO
INSERT [dbo].[INTERFACE_PROFIL] ([id_profil], [profil]) VALUES (3, N'Magasinier')
GO
INSERT [dbo].[INTERFACE_PROFIL] ([id_profil], [profil]) VALUES (4, N'Responsable Magasin')
GO
INSERT [dbo].[INTERFACE_USER] ([id_user], [login], [mdp], [nom], [prenom], [email], [depot], [compteg], [id_profil]) VALUES (1, N'boutique1_commercial', N'e10adc3949ba59abbe56e057f20f883e', N'test', N'test', NULL, 1, N'34210000', 1)
GO
INSERT [dbo].[INTERFACE_USER] ([id_user], [login], [mdp], [nom], [prenom], [email], [depot], [compteg], [id_profil]) VALUES (2, N'boutique1_caissier', N'e10adc3949ba59abbe56e057f20f883e', N'Caissier', N'Caisser', NULL, 1, N'34210000', 2)
GO
INSERT [dbo].[INTERFACE_USER] ([id_user], [login], [mdp], [nom], [prenom], [email], [depot], [compteg], [id_profil]) VALUES (3, N'boutique1_magasinier', N'e10adc3949ba59abbe56e057f20f883e', N'Magasinier', N'Magasinier', NULL, 1, N'34210000', 3)
GO
INSERT [dbo].[INTERFACE_USER] ([id_user], [login], [mdp], [nom], [prenom], [email], [depot], [compteg], [id_profil]) VALUES (4, N'boutique1_responsable', N'e10adc3949ba59abbe56e057f20f883e', N'Responsable', N'Magasin', NULL, 1, N'34210000', 4)
GO
