# Api Bolsa Emppleo
## Comenzando
Api para prueba tecnica Talentu, desarrollada en Laravel!

### Pre-requisitos
Tener instalado postman, motor de base de datos en mariadb
### Pasos para funcionamiento
    1. Clonar repositorio de github 
    --
    https://github.com/Ausber/bolsa-empleo-api.git
    --
    2. Configurar entorno de conexion de laravel con el usuario y contraseña a su vez crear la base de datos  bolsaempleo.

    3. Realizar las migraciones utilizando
    --
    php artisan migrate
    --

    4. Ejecutar los seeder
    --
    php artisan serve db:seed
    --

    5. Levantar servidor
    --
    php artisan serve
    --

### Endpoints APi

    1. Permite el registro de un usuario nuevo.
    Este recibe como parametros
    * email
    * name
    * document_type
    * document_number
    --
    127.0.0.1:8000/api/register
    --

    Una vez registrado se puede iniciar sesion con el siguente endpoint

    2. Permite el login el cual retorna un token con el cual se debe enviar en otros endpoints para poder realizar la peticion. Debe enviarse el email y contraseña con el que se registro.
    --
        127.0.0.1:8000/api/login
    --

    3. Permite el registro de una oferta laboral.
    Recibe como parametros:
    * nombre_oferta
    * usuarios_asociados[]
    * estado -> (Activo,Inactivo)
    --
    127.0.0.1:8000/api/registeroferta
    --

    4. Permite la consulta de todas las ofertas con los usuarios asociados
    --
    127.0.0.1:8000/api/listofertas
    --