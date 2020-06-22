CREATE TABLE [dbo].[categorias](
    [codigo] [char](3) NOT NULL,
    [descricao] [varchar](50) NOT NULL,
CONSTRAINT [PK_categorias] PRIMARY KEY CLUSTERED 
(
    [codigo] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[pessoas](
    [codigo] [int] IDENTITY(1,1) PRIMARY KEY,
    [nome] [varchar](300) NOT NULL,
    [email] [varchar](120) NULL,
    [celular] [varchar](11) NULL,
    [cpf] [varchar](11) NOT NULL,
    [data_nascimento] [date] NOT NULL,
	)
GO

CREATE TABLE [dbo].[pessoas_categorias](
    [codigo_categoria] [char](3) NOT NULL,
    [codigo_pessoa] [int] NOT NULL,
    FOREIGN KEY (codigo_categoria) REFERENCES categorias(codigo),
    FOREIGN KEY (codigo_pessoa) REFERENCES pessoas(codigo),
    PRIMARY KEY(codigo_categoria, codigo_pessoa)
)
GO
