# Install
    ## depois de baixado rodar o comando composer install
# Deploy
    ## Criar uma aplicação
        heroku create
    ## Cria uma chave da aplicação
        heroku config:set APP_KEY=$(php artisan --no-ansi key:generate --show)
    ## Subir aplicação
