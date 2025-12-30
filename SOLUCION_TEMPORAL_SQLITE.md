# Solución Temporal: Usar SQLite mientras resuelves MySQL

Si no puedes resolver el problema de MySQL inmediatamente, puedes usar SQLite temporalmente:

## Paso 1: Cambiar a SQLite en .env

Abre el archivo `.env` y cambia:

```env
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=clinicavida
# DB_USERNAME=root
# DB_PASSWORD=
```

## Paso 2: Crear el archivo de base de datos SQLite

Ejecuta en la terminal:

```bash
touch database/database.sqlite
```

O crea manualmente un archivo vacío llamado `database.sqlite` en la carpeta `database/`

## Paso 3: Ejecutar migraciones

```bash
php artisan migrate
```

## Paso 4: Limpiar caché

```bash
php artisan config:clear
php artisan cache:clear
```

## ⚠️ Nota:
SQLite es solo una solución temporal. Para producción, deberás usar MySQL. Una vez resuelto el problema de MySQL, vuelve a cambiar a MySQL en el `.env`.

