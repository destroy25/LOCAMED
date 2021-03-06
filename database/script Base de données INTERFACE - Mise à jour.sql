USE [BIJOU]
GO
/****** Object:  Table [dbo].[INTERFACE_USER]    Script Date: 23/10/2017 11:39:33 ******/
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
	[id_profil] [smallint] NULL,
	[Objet_cnx] [int] NULL
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
INSERT [dbo].[INTERFACE_USER] ([id_user], [login], [mdp], [nom], [prenom], [email], [depot], [compteg], [id_profil], [Objet_cnx]) VALUES (1, N'boutique1_commercial', N'e10adc3949ba59abbe56e057f20f883e', N'test', N'test', NULL, 1, N'34210000', 1, 1)
INSERT [dbo].[INTERFACE_USER] ([id_user], [login], [mdp], [nom], [prenom], [email], [depot], [compteg], [id_profil], [Objet_cnx]) VALUES (2, N'boutique1_caissier', N'e10adc3949ba59abbe56e057f20f883e', N'Caissier', N'Caisser', NULL, 1, N'34210000', 2, 1)
INSERT [dbo].[INTERFACE_USER] ([id_user], [login], [mdp], [nom], [prenom], [email], [depot], [compteg], [id_profil], [Objet_cnx]) VALUES (3, N'boutique1_magasinier', N'e10adc3949ba59abbe56e057f20f883e', N'Magasinier', N'Magasinier', NULL, 1, N'34210000', 3, 1)
INSERT [dbo].[INTERFACE_USER] ([id_user], [login], [mdp], [nom], [prenom], [email], [depot], [compteg], [id_profil], [Objet_cnx]) VALUES (4, N'boutique1_responsable', N'e10adc3949ba59abbe56e057f20f883e', N'Responsable', N'Magasin', NULL, 1, N'34210000', 4, 1)
