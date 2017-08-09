USE [BIJOU]
GO

/****** Object:  Table [dbo].[user_interface]    Script Date: 08/08/2017 09:17:14 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[user_interface](
	[id_user] [smallint] IDENTITY(1,1) NOT NULL,
	[login] [varchar](255) NULL,
	[mdp] [varchar](255) NULL,
	[nom] [varchar](255) NULL,
	[prenom] [varchar](255) NULL,
	[email] [varchar](255) NULL,
	[depot] [smallint] NULL,
	[compteg] [varchar](50) NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


