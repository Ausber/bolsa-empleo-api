# Api Bolsa Emppleo
## Comenzando
Api para prueba tecnica Talentu, desarrollada en Laravel!

### Pre-requisitos
Tener instalado postman, motor de base de datos en mariadb
### Pasos para funcionamiento
    Clonar repositorio de github 

    1. https://github.com/Ausber/bolsa-empleo-api.git

    2. Se debe crear en la raiz del proyecto el archivo .env

    Instalar las dependecias del proyecto con composer, en la consola ingresamos:

    3. composer install

    Generar la key del proyecto por medio del comando:

    4. php artisan key:generate

    Generar la key de JWT con el comando

    5. php artisan jwt:secret


    6 . Configurar entorno de conexion de laravel con el usuario y contraseña a su vez crear la base de datos  bolsaempleo.

    Realizar las migraciones utilizando
    
     7. php artisan migrate
    

    Ejecutar los seeder
   
    8. php artisan serve db:seed
   

     Levantar servidor

    9. php artisan serve


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