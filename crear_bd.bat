@echo off
echo ========================================
echo Crear Base de Datos - Clínica Vida
echo ========================================
echo.
echo Este script intentara crear la base de datos 'clinicavida' en MySQL
echo.
echo Asegurate de que:
echo 1. XAMPP este corriendo
echo 2. MySQL este iniciado en XAMPP
echo 3. El usuario root no tenga contraseña (o ajusta el script)
echo.
pause

cd /d C:\xampp\mysql\bin
mysql.exe -u root -e "CREATE DATABASE IF NOT EXISTS clinicavida CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql.exe -u root -e "SHOW DATABASES LIKE 'clinicavida';"

if %ERRORLEVEL% EQU 0 (
    echo.
    echo ========================================
    echo Base de datos creada exitosamente!
    echo ========================================
    echo.
    echo Ahora ejecuta en la carpeta del proyecto:
    echo php artisan migrate
) else (
    echo.
    echo ========================================
    echo Error al crear la base de datos
    echo ========================================
    echo.
    echo Posibles causas:
    echo - MySQL no esta corriendo en XAMPP
    echo - El usuario root tiene contraseña
    echo - MySQL no esta en la ruta C:\xampp\mysql\bin
    echo.
    echo Solucion alternativa:
    echo 1. Abre phpMyAdmin: http://localhost/phpmyadmin
    echo 2. Crea manualmente la base de datos: clinicavida
)

pause

