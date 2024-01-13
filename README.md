
# SISTEMA DE TORNEOS

Sistema para la gestión de torneos desarrollado con Laravel y Livewire


## Feartures

- Agregar productos a la venta, a traves de codigo de barras
- Modulo de Usuarios
- Modulo de Equipos
- Modulo Sorteo
- Modulo Fixture
- Modulo Jugador
- Modulo Partido


## Instalación

Puedes seguir estos pasos para la instalación:

* Clonar desde github (usar github desktop)
```bash
  git clone https://github.com/yorchavez9/sis_torneo.git
```
* Vaya a la carpeta del proyecto
```bash
  cd sis_torneo
```
* Instalar dependencias con composer desde consola
```bash
  composer install
```

* Instalar dependencias node
```bash
  npm install
```

## Variables de entorno

Para ejecutar este proyecto, Necesitarás añadir las siguientes variables de entorno en **.env file**
Para ello primero tienes hacer una copia del **.env.example** y solo tiene que quedar así **.env**
Una vez ya copiado se debe configurar el siguiente:

`DB_DATABASE=your-database`

`DB_USERNAME=your-username`

`DB_PASSWORD=your-password`

`APP_KEY=base64:APP_KEY` (**)

** para generar el APP_KEY, se necesita ejecutar el siguiente comando:

```bash
  php artisan key:generate
```
## Ejecutar Localmente

Ejecutar las migraciones y datos de prueba

```bash
  php artisan migrate:fresh --seed
```
Generamos una clave secreta

```bash
  php artisan jwt:secret
```
La clave secreta se creará en la ultima parte del .env
Habilitar el storage para que se pueda subir archivos

```bash
  php artisan storage:link
```

Iniciar el server

```bash
  php artisan serve
```
##### ** te recomiendo usar laragon o Sail **


#
Ir a

http://sis_torneo.com (tu localhost)

Puedes crear un nuevo usuario y ingresar con el mismo usuario que creaste


## Screenshots

#### Inico de la página

![Incio de la página](public/features/01.png)

#### Sorteo

![Soteo](public/features/Captura%20de%20pantalla%202023-09-08%20111358.png)

#### Equipos

![Equipos](public/features/Captura%20de%20pantalla%202024-01-11%20112345.png)

#### Partido

![Patido](public/features/Captura%20de%20pantalla%202024-01-11%20112523.png)


## Feedback

Si tienes algun Feedback, por favor hazme saber djjmygm160399@gmail.com o al whatsapp: +51 920 468 502