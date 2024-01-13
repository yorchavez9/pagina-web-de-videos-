/* ===============================
CREAMOS LA BASE DE DATOS
=============================== */

/* =======================================================
TABLA DE USUARIO
======================================================= */

create table usuarios(
    id_usuario int(11) not null primary key auto_increment,
    nombre_usuario text collate utf8mb4_unicode_ci not null,
    correo_usuario text collate utf8mb4_unicode_ci not null,
    password_usuario text collate utf8mb4_unicode_ci not null,
    perfil_usuario text collate utf8mb4_unicode_ci not null,
    foto_usuario text collate utf8mb4_unicode_ci,
    estado_usuario int(11) not null default 1,
    ultimo_login_usuario datetime not null,
    fecha_usuario timestamp not null default current_timestamp() on update current_timestamp()
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


/* ====================================================
TABLE CATEFORIA PRINCCIPAL
==================================================== */

create table categoriaP(
    id_cp int(11) not null primary key auto_increment,
    nombre_cp varchar(100) not null,
    fecha_cp timestamp not null default current_timestamp() on update current_timestamp()
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/* =======================================================
TABLA DE CATEGORIA
======================================================= */

create table categoria(
    id_c int(11) not null primary key auto_increment,
    nombre_c varchar(100) not null,
    id_cp int(11) not null,
    fecha_c timestamp not null default current_timestamp() on update current_timestamp(),
    foreign key(id_cp) references categoriaP(id_cp) on update cascade on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/* =======================================================
TABLA DE REGALO
======================================================= */

CREATE TABLE `regalo` (
  `id_r` int(11) not null primary key auto_increment,
  `id_c` int(11) not null,
  `codigo_r` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_r` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen_r` varchar(100) COLLATE utf8mb4_unicode_ci,
  `titulo_r` varchar(100) COLLATE utf8mb4_unicode_ci,
  `descripcion_r` text COLLATE utf8mb4_unicode_ci,
  `fecha_r` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  foreign key(id_c) references categoria(id_c) on update cascade on delete cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/* =======================================================
TABLA DE FORMULARIO DE EMBUDO
======================================================= */

create table embudo(
    id_em int(11) not null primary key auto_increment,
    id_c int(11) not null,
    id_r int(11) not null,
    nombre_em varchar(60) not null,
    correo_em varchar(50) not null,
    telefono_em varchar(12) not null,
    fecha_em timestamp not null default current_timestamp() on update current_timestamp(),
    foreign key(id_c) references categoria(id_c) on update cascade on delete cascade,
    foreign key(id_r) references regalo(id_r) on update cascade on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/* =======================================================
TABLA DE ANUNCIO
======================================================= */

create table anuncio(
    id_a int(11) not null primary key auto_increment,
    id_c int(11) not null,
    id_r int(11) not null,
    codigo_a varchar(10) not null,
    imagen_a varchar(100) not null,
    imagen_a_b varchar(100) not null,
    titulo_a varchar(100) not null,
    descripcion_a text,
    link_a varchar(200) not null,
    fecha_a timestamp not null default current_timestamp() on update current_timestamp(),
    foreign key(id_c) references categoria(id_c) on update cascade on delete cascade,
    foreign key(id_r) references regalo(id_r) on update cascade on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


/* =======================================================
TABLA DE CALIFICACION
======================================================= */

create table calificacion(
    id_cali int(11) not null primary key auto_increment,
    id_r int(11) not null,
    like_cali int(1) default 0,
    dislike_cali int(1) default 0,
    foreign key(id_r) references regalo(id_r) on update cascade on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/* =======================================================
TABLA DE VISTAS
======================================================= */

create table visitas(
    id_visitas int(11) not null primary key auto_increment,
    ip_visitas varchar(255) not null,
    total_visitas int(11),
    fecha_visitas timestamp not null default current_timestamp() on update current_timestamp()
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
