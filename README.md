
# PÁGINA WEB PARA VIDEOS ADMINISTRABLE CON PHP Y MYSQL

Página web de videos, el sistema es administrable está desarrollao en la arquitectura MVC


## Feartures

- Agregar productos a la venta, a traves de codigo de barras
- Modulo de usuario
- Modulo de categorias A
- Modulo de categorias B
- Modulo de video
- Modulo de anuncio


## Instalación

Puedes seguir estos pasos para la instalación:

* Clonar desde github (usar github desktop)
```bash
  git clone https://github.com/yorchavez9/pagina-web-de-videos-.git
```
* El archivos descargado tiene que estar en c/xammp/htdoc/{nombre-del-archivo}

* Importar la base de datos en el navgador "http://localhost/phpmyadmin/"
```bash
  db.video.sql
```


## Variables de entorno

Para ejecutar este proyecto, Necesitarás añadir las siguientes configuraciones en la Conexion que está ubicando 
en modelos/conexion.php

`
<?php
class Conexion{
    static public function conectar(){
        $link = new PDO("mysql:host=localhost;dbname=sis_apuuray","root","");
        return $link;
    }
}
?>
`

Por ültimo ejecutar el proyecto en "http://localhost/{Nombre del archivo o proyecto}"




## Screenshots

#### Inico de la página

![Incio de la página](public/img/01.png)

#### Reproducción de video

![Reproduciónd el video](public/img/02.png)


![Incio de la página](public/img/03.png)

![Incio de la página](public/img/04.png)

![Incio de la página](public/img/05.png)

![Incio de la página](public/img/06.png)

![Incio de la página](public/img/07.png)

![Incio de la página](public/img/08.png)

![Incio de la página](public/img/09.png)

![Incio de la página](public/img/10.png)

![Incio de la página](public/img/11.png)



## Feedback

Si tienes alguna duda, por favor hazme saber djjmygm160399@gmail.com o al whatsapp: +51 920 468 502