USE [BIJOU]
GO

/****** Object:  Table [dbo].[menu]    Script Date: 08/08/2017 09:06:30 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[menu](
	[id_menu] [smallint] IDENTITY(1,1) NOT NULL,
	[id_parent] [smallint] NOT NULL,
	[menu] [varchar](255) NULL,
	[icon] [varchar](255) NULL,
	[link] [varchar](255) NULL,
	[uniq] [smallint] NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


