# Aula Sistemas Distribuídos

### **Nessa aula usaremos o XAMPP e o framework CodeIgniter**

* O XAMPP é um pacote com os principais servidores de código aberto do mercado, incluindo FTP, banco de dados MySQL e Apache com suporte as linguagens PHP e Perl.

* O Codelgniter é um poderoso framework PHP dentre diversos outros já existentes. Criado para desenvolvedores que precisam de um conjunto de ferramentas simples para a criação de aplicativos web completos, o CodeIgniter é uma excelente alternativa para o desenvolvimento de projetos utilizando o PHP. Adotaremos o CodeIgniter 3 que é a versão legado da estrutura, destinada ao uso com PHP 5.6+. Esta versão está em manutenção, recebendo em sua maioria apenas atualizações de segurança, sendo que a versão atual é a 3.1.13. O CodeIgniter é baseado no padrão de desenvolvimento Model-View-Controller. MVC é uma abordagem de software que separa a lógica do aplicativo da apresentação.

# Primeiro passo 

* Instalar o `XAMPP`
```
https://www.apachefriends.org/pt_br/download.html
```
* Iniciar o `Apache` e o `MySQL`.

![image](https://user-images.githubusercontent.com/48998618/225986951-7f12d3fb-e1e2-48df-92ec-8cf6b69955a4.png)

* Criar as tabelas: `usuario`,`categoria` e `produto` no banco de dados.
```
CREATE TABLE `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `senha` char(40) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status` char(1) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `data_cad` datetime DEFAULT NULL,
  `data_alt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
```
```
CREATE TABLE `categoria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status` char(1) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `data_cad` datetime DEFAULT NULL,
  `data_alt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
```
```
CREATE TABLE `produto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `descricao` text,
  `status` char(1) DEFAULT NULL,
  `data_cad` datetime DEFAULT NULL,
  `data_alt` datetime DEFAULT NULL,
  `id_categoria` int DEFAULT NULL,
  `valor_compra` decimal(18,2) DEFAULT NULL,
  `valor_venda` decimal(18,2) DEFAULT NULL,
  `estoque` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_produto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
```
* Fazer download do `CodeIgniter 3`.
```
https://api.github.com/repos/bcit-ci/CodeIgniter/zipball/refs/tags/3.1.13
```
* Renomear a pasta fornecida pelo CodeIgniter 3 para `loja`.
* Mover a pasta para `xampp -> htdocs`.
* Abrir a pasta com os arquivos no Visual Studio Code.
* Criar um login para o usuário no MySQL `SELECT * FROM loja.usuario` -> adicionar `email` e `senha` -> `Apply`.

# Configurações de compatibilidade

* Instalar o `xampp` com a versão do `php 5.6`
* Instalar o `MySQL 5.7`
* Configurar senha do banco: `application` -> `config` -> `database.php` -> `password => 'senha do MySQL aqui'`
