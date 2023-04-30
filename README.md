# Instalação

### Clonando e preparando
Clone este repositório
> git clone git@github.com:Adrianzctpa/crud-book-app.git

Vá para a root dele
> cd crud-book-app

### Dependências
Composer e NPM, respectivamente:

> composer install && npm install

### Setup do projeto
Crie uma cópia da env, usando o env.example:
> cp .env .example.env

Gere a chave de encriptação
> php artisan key:generate

Crie uma database sqlite no caminho do projeto `database`
> touch database/database.sqlite

Crie um secret JWT
> php artisan jwt:secret

Finalmente, rode as migrations.
> php artisan migrate

Agora você pode rodar o server!
> php artisan serve && npm run dev