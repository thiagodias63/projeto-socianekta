# Projeto Socianekta

Requisitos do projeto: 
* PHP 5.4+ 
* Sql server instalado 

Para executar a primeira vez
    
1. Na pasta do projeto, utilize o comando `composer install` ou caso não tenha o composer na máquina `php composer.phar install`

2. Banco de dados:

    *   Acesse o arquivo `config\db.php`
        Informe o host, dbname, username e password da máquina

3. Utilize o comando `yii serve` na pasta do projeto
    3.1 Caso estenha no linux, utilizar o comando: `.\yii serve`

4. Acesse no navegador o endereço: `localhost:8080`

5. Para visualizar os usuários criados, acesse: `localhost:8080/site/admin`