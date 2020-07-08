# BancoDeSangre
Trabajo Práctico Especial Promoción Web 2

Funcionalidad:
Este proyecto se hace con la intención de mantener un registro de pacientes donantes de sangre, entre las funcionalidades del proyecto se encuentran ABM
de pacientes y tipos de sangre, login y registro de usuarios, manejo de roles de usuario y un panel de observaciones para usuarios autenticados que 
funciona de manera restful. 

Guía de instalación:
*previamente usted deberá tener instalado composer y laravel 7

1) Descargue los archivos y descomprímalos

2) Abra su consola predeterminada en la carpeta bancosangre-laravel

3) Ejecute los comandos:
  
  composer require laravel/ui
 
  php artisan make:auth

4) Posteriormente ejecute 

  composer dump-autoload

5) Y finalmente 

  php artisan migrate:refresh –seed
  
Para desarrolladores:
Se propone una arquitectura MVC que cuenta con 6 models, de los cuales Patient y Bloodtype estan estadarizados mientras que Observation, Role, Role_user y User se encuentran personalizados.
Se utiliza Laravel 7 en este proyecto, que requiere a su vez composer y node.js para el render de las observaciones.

* El proyecto se encuentra documentado en cada sección.

Cualquier duda contactar martinaguirre08@gmail.com
