INSERT INTO [dbo].[categorias] (codigo, descricao)
    VALUES
        ('ADM', 'Administração'),
        ('CON', 'Contabilidade'),
        ('ENG', 'Engenharia'),
        ('MED', 'Medicina'),
        ('TEC', 'Tecnologia')
GO

INSERT INTO [dbo].[pessoas] (nome, email, celular, cpf, data_nascimento)
    VALUES ('Thiago Dias', 'thidias6003@gmail.com', '','02053377674', '1997-12-21')
GO

INSERT INTO [dbo].[pessoas_categorias] (codigo_categoria, codigo_pessoa)
    VALUES ('ADM', 1)
GO