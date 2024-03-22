
    CRUD Completo: 
    
    Permite crear, leer, actualizar y eliminar registros de una base de datos de forma intuitiva.
    Interfaz Responsiva: utiliza Bootstrap
    Filtrado Avanzado: Implementa DataTables de jQuery para proporcionar una funcionalidad de filtrado y búsqueda avanzada en las tablas de datos.
    Consulta Estructurada: Utiliza el Query Builder de Laravel para realizar consultas a la base de datos de forma organizada y segura realizando todas las querys en el modelo, añadiendo que utilize migraciones.
    MVC: Sigue el patrón de diseño Modelo-Vista-Controlador para una estructura de código limpia y mantenible.
    Apis: utilize api de https://debounce.io/es/ para verificar correo electronico, hay que verificar los creditos gratuitos que le resten a la api y utilize para verificar el rut la formula del modulo 11, las apis estan conectadas con variables de entorno.
    

Tecnologías Utilizadas

    Laravel: Framework de desarrollo web en PHP que facilita la creación de aplicaciones robustas y escalables.
    Bootstrap: Biblioteca de código abierto para diseño web responsivo y móvil. (CDN)
    jQuery: Biblioteca JavaScript que simplifica la manipulación del DOM y la comunicación asíncrona con el servidor. (CDN)
    AJAX: Tecnología que permite realizar solicitudes HTTP asíncronas desde el cliente al servidor.
    DataTables: Plugin de jQuery que añade características avanzadas de interacción a las tablas HTML, como ordenamiento, paginación y filtrado. (CDN)
>>>>>>> 121cff98044b031fe3a9cb48f85aae632a74b1d6

instrucciones para despliegue en su maquina local.

1: tener instalado xampp con Laravel Framework 8.83.27 y con PHP 8.0.28 (ejecutarlo en la carpeta del servidor htdocs en caso de xampp o www en caso de que se utilize laragon).

2: instalacion de composer en su maquina local  "composer install".

3: para tener la base de datos debe migrarlas, para realizar esto ejecute en el proyecto el comando "php artisan migrate".

4: la base de datos es mysql, puede ejecutarla con el gestor phpmyadmin.

5: ejecute "php artisan serve" en su consola para visualizar la url del proyecto.


