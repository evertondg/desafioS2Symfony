# desafioS2Symfony
Desafio PHP

Pre requisitos: 
    - GIT, 
    - PHP 7.*, 
    - Mysql  
    - Composer 
    
Os pré requisitos devem estar instalados e configurados em sua máquina (Testado em ambiente windows); 

Acesse seu terminal e siga os seguintes passos

Inicialmente clonamos o repositório:
    git clone https://github.com/evertondg/desafioS2Symfony.git


Entramos no diretorio do projeto
     cd desafioS2Symfony\challenge

Instalamos as dependecias do projeto 
    composer install



Ao final da instalação o composer ajudara a configurar o projeto symfony pedindo algumas informações
    database_host(127.0.0.1) :      [utilize o endereço de seu mysql ou pressione <ENTER> para aceitar 127.0.0.1]  
    database_port(null):            [utilize a porta do seu mysql ou pressione <ENTER> para aceitar a porta padrão 3306] 
    database_name(symfony): <ENTER> [digite o nome do banco de dados que sera criado]
    database_user(root):            [utilize o usuario de seu mysql ou pressione <ENTER> para aceitar root]
    database_password:              [utilize a senha do usuario de seu mysql ou pressione]
    mailer_transport(smtp): <ENTER>
    mailer_host(1127.0.0.1): <ENTER>
    mailer_user(null): <ENTER>
    mailer_password(null): <ENTER>
    secret(ThisTokenIsNotSoSecretChangeIt): <ENTER>

Ao pressionar <Enter> pela ultima vez o symfony estara configurado.

Para criar o banco de dados digite o comando:
    php app/console doctrine:database:create

Para gerar as tabelas do banco de dados digite o comando:
    php app/console doctrine:schema:update --force

Para servir a aplicação digite o comando:    
    php app/console server:run

Se tudo tudo estiver correto você verá uma mensagem parecida com esta:
    [OK] Server running on http://127.0.0.1:8000

PRONTO! Basta acessar o endereço que foi fornecido através de seu navegador




Link da documentação da API 
    https://documenter.getpostman.com/view/115648/RWMHLnU7

Proximas implementações
    - Gerar o ambiente em docker para servir esta aplicação
        Verificar onde errei ao implementar o ambiente;

    - Implementar o sistema de autenticação na API 
        Pesquisar e implementar; 

    - Implementar Teste Unitários / Funcionais





















