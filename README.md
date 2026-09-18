# SmartCampus Spaces — Actividad 2 (Laravel)

Sistema de Gestión y Reserva de Espacios Académicos y Tecnológicos.
Traducción del modelo relacional diseñado en la **Actividad 1** al framework
Laravel 12, usando el ORM Eloquent y el sistema de migraciones.

> Nota: este repositorio también contiene las tablas `departamentos` y
> `municipios`, pertenecientes a otro proyecto (Sistemas Distribuidos). No
> forman parte del modelo de SmartCampus Spaces y no fueron modificadas.

## 1. Requisitos

- PHP >= 8.2
- Composer
- MySQL / MariaDB (o el motor que prefieras — ver sección 4)
- Node.js (solo si vas a compilar assets con `npm run dev`)

## 2. Instalación

```bash
composer install
cp .env.example .env   # si no tienes ya un .env local
php artisan key:generate
```

Configura en `.env` los datos de tu base de datos (`DB_CONNECTION`,
`DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`) y crea la base de
datos vacía en tu motor (ej. `CREATE DATABASE electivaii20262;`).

## 3. Migraciones y datos de prueba

```bash
php artisan migrate:fresh --seed
```

Este comando **crea la base de datos desde cero** a partir de los archivos
de `database/migrations` (no necesita que la BD ya exista con tablas; las
migraciones son el código que las genera) y luego ejecuta `DatabaseSeeder`
para poblarla con datos de prueba.

Usuarios de prueba creados por el seeder:

| Rol | Email | Password |
|---|---|---|
| Administrador del Campus | admin@smartcampus.edu | password |
| Solicitante (demo) | test@example.com | password |
| Solicitantes aleatorios (10) | generados con Faker | password |

## 4. Motor de base de datos

El `.env` incluido usa MariaDB/MySQL (`DB_CONNECTION=mysql`, host
`127.0.0.1:3306`, BD `electivaii20262`), tal como estaba configurado el
proyecto. Si prefieres probar rápido sin instalar un servidor, puedes usar
SQLite:

```bash
touch database/database.sqlite
# en .env: DB_CONNECTION=sqlite (y comenta/borra las demás variables DB_*)
php artisan migrate:fresh --seed
```

Las migraciones solo usan el Schema Builder de Laravel (sin SQL crudo), por
lo que corren igual en MySQL, MariaDB, PostgreSQL o SQLite.

## 5. Mapeo Actividad 1 → Actividad 2

La Actividad 1 definió las entidades en español; la Actividad 2 las traduce
a inglés siguiendo la *Guía de Convenciones de Nombres en Laravel* del
profesor (tablas en plural/inglés, PK `id`, FK `modelo_id`, pivotes en
orden alfabético).

| Entidad (Act. 1) | Tabla (Act. 2) | Modelo Eloquent |
|---|---|---|
| usuarios | `users` (tabla nativa de Laravel + columna `role` agregada) | `App\Models\User` |
| espacios | `spaces` | `App\Models\Space` |
| recursos | `resources` | `App\Models\Resource` |
| espacio_recursos (pivote N:M) | `resource_space` | `App\Models\ResourceSpace` (pivot) |
| reservas | `reservations` | `App\Models\Reservation` |
| incidentes | `incidents` | `App\Models\Incident` |

Campos traducidos por tabla:

- **users**: `id_usuario→id`, `nombre→name`, `correo_inst→email` (ya
  provista por Laravel, `UNIQUE`), `password→password`, `rol→role`
  (agregado en la migración `add_role_to_users_table`, valores:
  `estudiante` | `docente` | `administrador`).
- **spaces**: `id_espacio→id`, `nombre_espacio→name`, `capacidad→capacity`,
  `ubicacion_bloque→location_block`, `estado→status`.
- **resources**: `id_recurso→id`, `nombre_recurso→name`,
  `estado_recurso→status`.
- **resource_space**: `id_espacio_recurso→id`, `id_espacio→space_id`,
  `id_recurso→resource_id`, `cantidad→quantity`.
- **reservations**: `id_reserva→id`, `id_usuario→user_id`,
  `id_espacio→space_id`, `fecha→date`, `hora_inicio→start_time`,
  `hora_fin→end_time`, `estado_reserva→status`.
- **incidents**: `id_incidente→id`, `id_reserva→reservation_id`,
  `id_usuario→user_id`, `descripcion→description`,
  `fecha_reporte→reported_at`. Se agregó además el campo `status`
  (`reportado` | `en_proceso` | `resuelto`), no presente en el diagrama
  original de la Act. 1, para poder cumplir el objetivo del Módulo de
  Incidentes descrito en esa misma actividad ("registro y **control del
  estado** de novedades").

Restricciones de integridad aplicadas: todas las FK usan
`constrained()->cascadeOnDelete()`, con `default()`/`nullable()` explícitos
en los campos que lo ameritan, e índices en `status` y en `(space_id,
date)` para las consultas de disponibilidad.

## 6. Publicar en GitHub

Este repositorio ya quedó inicializado con `git init` y un primer commit.
Para subirlo a tu cuenta de GitHub:

1. Entra a https://github.com/new y crea un repositorio **vacío** (sin
   README, sin .gitignore, sin licencia) — por ejemplo
   `smartcampus-spaces-actividad2`. Puede ser público o privado; la
   actividad pide un repo **público**.
2. Copia la URL que te da GitHub (algo como
   `https://github.com/tu-usuario/smartcampus-spaces-actividad2.git`).
3. En la terminal, dentro de la carpeta del proyecto:

   ```bash
   git remote add origin https://github.com/tu-usuario/smartcampus-spaces-actividad2.git
   git branch -M main
   git push -u origin main
   ```

4. Si te pide usuario/contraseña y no acepta tu contraseña normal, GitHub
   ya no permite contraseñas por HTTPS: necesitas un *Personal Access
   Token* (Settings → Developer settings → Personal access tokens → Tokens
   (classic) → Generate new token, marca el scope `repo`) y lo usas como
   contraseña. O instala [GitHub CLI](https://cli.github.com/) y corre
   `gh auth login` una sola vez; después `git push` funciona sin pedir
   nada.
