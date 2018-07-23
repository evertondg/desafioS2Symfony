Desafio php Symfony
===========================

Este projeto foi desenvolvido como um desafio para conquistar a vaga de desenvolvedor PHP na S2IT.

 
 
#Pré requisitos: 
- [GIT](https://git-scm.com/) 
- [PHP 7.*](http://php.net/downloads.php)
- [Mysql](https://www.mysql.com/) 
- [Composer](http://getcomposer.org/)
    
Os pré requisitos devem estar instalados e configurados devidamente em sua máquina. 
             

Acesse seu terminal e siga os seguintes passos

#Inicialmente clonamos o repositório:
    git clone https://github.com/evertondg/desafioS2Symfony.git


#Entramos no diretorio do projeto
     cd desafioS2Symfony\challenge

#Instalamos as dependecias do projeto 
    composer install



Ao final da instalação o `composer` irá auxiliar na configuração do projeto symfony pedindo algumas informações:

    database_host(127.0.0.1) : [ Utilize o endereço de seu mysql ou pressione <ENTER> para aceitar 127.0.0.1]  
    database_port(null): [ Utilize a porta do seu mysql ou pressione <ENTER> para aceitar a porta padrão 3306 ] 
    database_name(symfony): <ENTER> [ Digite o nome do banco de dados que sera criado pela aplicação ]
    database_user(root): [ Utilize o usuario de seu mysql ou pressione <ENTER> para aceitar root ]
    database_password: [Utilize a senha do usuario de seu mysql ou pressione <ENTER>]
    mailer_transport(smtp): <ENTER>
    mailer_host(1127.0.0.1): <ENTER>
    mailer_user(null): <ENTER>
    mailer_password(null): <ENTER>
    secret(ThisTokenIsNotSoSecretChangeIt): <ENTER>

Ao pressionar <Enter> pela última vez o symfony está pronto para ser utilizado.

#Para criar o banco de dados digite o comando:
            
    php app/console doctrine:database:create

# Para gerar as tabelas do banco de dados digite o comando:
    php app/console doctrine:schema:update --force

# Para servir a aplicação digite o comando:    
    php app/console server:run

# Se tudo estiver correto você verá uma mensagem parecida com esta:
    [OK] Server running on http://127.0.0.1:8000

**PRONTO!** Agora é só acessar o endereço fornecido através do seu navegador.






##Link da documentação da API 
    https://documenter.getpostman.com/view/115648/RWMHLnU7



#Observações
Encontrei um problema na estrutura do arquivo `shiporders.xml` as tags `<items></items>` das linhas `37` e `61` não estavam devidamente fechadas, tomei a liberdade de corrigir e disponibilizar um terceiro arquivo de nome `shipordersOK.xml` que é o arquivo que funciona corretamente no momento de importar.


Todos os arquivos XML estão disponibilizados no diretório xmlFiles deste repositório.  


#Próximas implementações

* Gerar o ambiente em docker para servir esta aplicação
* Implementar o sistema de autenticação na API 
* Implementar Teste Unitários / Funcionais    

















