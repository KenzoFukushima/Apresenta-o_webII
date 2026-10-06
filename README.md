Upload e Manipulação de Arquivos e Imagens no Laravel
Projeto do Seminário de Funcionalidades Laravel (Módulo 1, Web II) — Tema 01.
Dupla: Thiago e Pedro

Sobre:
 Cadastro de usuário com foto de perfil. O sistema valida o formulário, salva a imagem original em storage/app/public/avatars, gera uma thumbnail 150x150 em WebP com Intervention Image e exibe a foto na tela de perfil através do link simbólico public/storage.

Tecnologias:
    PHP 8.2+
    Laravel 12
    Intervention Image (intervention/image e intervention/image-laravel)
    Bootstrap (local, em public/assets/bootstrap)
    MySQL (configurado no .env)
    Como rodar

Requisitos: PHP 8.2+ com extensão GD (com suporte a WebP), Composer, Node.js e MySQL.





# 1. instalar dependências
    composer update

# 2. configurar o ambiente
    criar o .env a partir do .env.example
    php artisan key:generate

No .env, ajuste o banco (padrão do projeto):

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=root


# 3. criar as tabelas
    php artisan migrate

# 4. criar o link simbólico do storage (obrigatório para as imagens aparecerem)
    php artisan storage:link

# 5. subir o servidor
    php artisan serve


Rotas
URI	            Ação
/	            cadastro	Formulário de cadastro
/users          cadastroSubmit	Valida, salva a foto e cria o usuário
/users/{user}	perfil	Exibe o usuário cadastrado


# 6. Armazenamento

    php
    $caminhoOriginal = $foto->storePublicly('avatars', 'public');

O arquivo vai para storage/app/public/avatars com nome aleatório. O caminho relativo é salvo na coluna foto.



# 7. Thumbnail
A thumbnail é gerada com o Intervention Image, biblioteca de manipulação de imagens instalada com "composer require intervention/image-laravel". No controller, a facade vem de use Intervention\Image\Laravel\Facades\Image;.

    php
    $imagem = Image::read($foto)->cover(150, 150)->toWebp();
    Storage::disk('public')->put($caminhoThumbnail, (string) $imagem);

cover(150, 150) recorta e redimensiona sem distorcer. A miniatura é salva em storage/app/public/avatars/thumbs e o caminho vai para a coluna thumbnail.



Banco de dados
Tabela users (database/migrations/..._create_users_table.php):

    Coluna	     Tipo
    id	         bigint
    name	     string
    email	     string (único)
    password	 string
    foto	     string
    thumbnail	 string
    timestamps	
A senha é gerada automaticamente (bcrypt('12345678')), pois o foco do projeto é o upload e não a autenticação.

Estrutura principal

    app/
      Http/Controllers/UserController.php
      Models/User.php
      
    database/migrations/..._create_users_table.php
    
    resources/views/
      cadastro.blade.php
      perfil.blade.php
      layouts/
      
    routes/web.php
    
    storage/app/public/avatars/        (foto original)
    storage/app/public/avatars/thumbs/ (thumbnails 150x150)
