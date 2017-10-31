USE [BIJOU]
GO
/****** Object:  Table [dbo].[INTERFACE_USER]    Script Date: 31/10/2017 15:37:14 ******/
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
	[Objet_cnx] [int] NULL,
	[NameSAGE] [varchar](255) NULL,
	[PwdSAGE] [varchar](255) NULL
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
