# Como rodar o projeto.
1. Clone o repositório:
git clone https://github.com/Geronilton/CadastroEmpresa_PHP_laravel
cd CadastroEmpresa_PHP_laravel

2. Configure(ou crie) o .env com o seu banco de dados MySQL.
3. Instale as dependências do Laravel e do vue:
    composer install
   npm install
4. Rode as migrações.
    php artisan migrate
5. Colocar no ar o servidor frontend.
    npm run dev
6. Colocar no ar o servidor backend(laravel).
    php artisan serve
