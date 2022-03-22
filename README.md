## Sistema de Gerenciamento de Saldo

Sistema para gerenciamento do saldo dos funcionários.

## Sobre o Sistema de Gerenciamento de Saldo

Projeto criado para simples gestão de funcionários e seus saldos na plataforma.
Sistema conta com tipos de acesso para facilitar a entrada em areas restritas a cada um conforme seu tipo.
Sistema conta com a aba "movimentação" que o administrador pode fazer uma entrada/saida do saldo do funcionário, e ainda utilizando o campo de "OBS" ele pode descrever em poucas palavras o que está sendo feito.
Cada movimentação do saldo do funcionário seja entrada ou saida é feita de forma sincronizada com o saldo do mesmo.


## Stack de Desenvolvimento

- PHP 8.0
- Backend Laravel Framework 7.
- Frontend Bootstrap 4.
- MySQL 8.0
- Matrix Admin Template

## Antes de começar

Tenha no minimo o PHP 8.0 instalado em sua máquina ou no docker ou o que for usar para desenvolver/testar.

Tenhas as extensões PHP recomendadas e o MySQL na sua versão 5.7 ou superior.

Tenha o [Composer](https://getcomposer.org) instalado

E principalmente o Laravel instalado em seu ambiente local seguindo os passos da documentação oficial

[Documentação Oficial](https://laravel.com/docs/7.x/installation#installing-laravel).

## Configurando o .env do projeto

Depois de criar o seu banco de dados em seu SGBD favorito, faça:

Abra o arquivo na raiz do projeto chamado .env.example renomeie para .env e substitua as chaves contendo DB_*, exemplo:

- DB_DATABASE=nome_do_banco_que_voce_criou
- DB_USERNAME=seu_user_local
- DB_PASSWORD=caso_haja_senha

Na ultima chave o password deixar em branco caso não tenha senha local
## Comandos para execução do projeto

- php artisan migrate
- php artisan db:seed
- php artisan serve (ou qualquer outra forma, ex.: valet link & valet open)

## Ou comando reduzido pode ser:

- php artisan migrate --seed
- php artisan serve (ou qualquer outra forma, ex.: valet link & valet open)

## Para o ambiente de produção
Comente o foreach de permissões no arquivo AuthServiceProvider para não dar conflito.
Feito isso execute:
- php artisan migrate
Volte ao ambiente local e descomente o codigo, faça o push para o ambiente e pronto.

## Problemas com Permission Denied
Qualquer problema com as permissões na pasta do Laravel storage/*
Executar:
- sudo chown -R $USER:www-data storage/
Em 99% dos casos isso ja vai resolver

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
