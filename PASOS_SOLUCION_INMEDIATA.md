# Pasos Inmediatos para Solucionar los Errores

## 🔴 Error Actual:
- Laravel no puede conectarse a MySQL
- phpMyAdmin no puede conectarse a MySQL
- Error: "Access denied for user 'root'@'localhost'"

## ✅ Solución Paso a Paso:

### PASO 1: Verificar que XAMPP esté corriendo

1. Abre **XAMPP Control Panel**
2. Busca el módulo **MySQL**
3. Si está en **rojo** o dice "Stopped":
   - Haz clic en el botón **"Start"** junto a MySQL
   - Espera a que aparezca en **verde** o diga "Running"

### PASO 2: Verificar si MySQL tiene contraseña

**Opción A: Si MySQL NO tiene contraseña (más común en XAMPP)**

1. Abre una terminal/PowerShell
2. Navega a la carpeta de MySQL:
   ```powershell
   cd C:\xampp\mysql\bin
   ```
3. Intenta conectarte:
   ```bash
   mysql.exe -u root
   ```
   Si te conecta sin pedir contraseña, entonces NO tiene contraseña.

**Opción B: Si MySQL SÍ tiene contraseña**

Si al intentar conectarte te pide contraseña, entonces necesitas:
1. Recordar cuál es la contraseña
2. O resetearla (ver más abajo)

### PASO 3: Crear la base de datos

**Método 1: Desde la línea de comandos (RECOMENDADO)**

1. Abre PowerShell como Administrador
2. Ejecuta:
   ```powershell
   cd C:\xampp\mysql\bin
   mysql.exe -u root
   ```
   (Si te pide contraseña, agrega `-p` y escribe la contraseña)

3. Una vez dentro de MySQL, ejecuta:
   ```sql
   CREATE DATABASE IF NOT EXISTS clinicavida CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   EXIT;
   ```

**Método 2: Usar el script .bat**

1. Ejecuta el archivo `crear_bd.bat` que está en la carpeta del proyecto
2. Sigue las instrucciones en pantalla

**Método 3: Desde phpMyAdmin (si funciona)**

1. Abre: http://localhost/phpmyadmin
2. Si te pide usuario/contraseña:
   - Usuario: `root`
   - Contraseña: (déjala vacía si no configuraste una)
3. Haz clic en "Nueva" o "New" en el menú lateral
4. Nombre de la base de datos: `clinicavida`
5. Intercalación: `utf8mb4_unicode_ci`
6. Haz clic en "Crear"

### PASO 4: Si MySQL tiene contraseña configurada

Si descubriste que MySQL tiene contraseña, actualiza el archivo `.env`:

1. Abre el archivo `.env` en la raíz del proyecto
2. Busca la línea:
   ```env
   DB_PASSWORD=
   ```
3. Cambia a:
   ```env
   DB_PASSWORD=tu_contraseña_aqui
   ```
4. Guarda el archivo

### PASO 5: Limpiar caché y probar

Después de crear la base de datos:

```bash
php artisan config:clear
php artisan cache:clear
php artisan migrate
```

### PASO 6: Si MySQL sigue sin funcionar - Resetear contraseña

Si nada funciona, puedes resetear la contraseña de MySQL:

1. Detén MySQL en XAMPP
2. Abre PowerShell como Administrador
3. Ejecuta:
   ```powershell
   cd C:\xampp\mysql\bin
   mysqld.exe --skip-grant-tables
   ```
4. Abre otra terminal y ejecuta:
   ```powershell
   cd C:\xampp\mysql\bin
   mysql.exe -u root
   ```
5. Dentro de MySQL:
   ```sql
   USE mysql;
   UPDATE user SET password='' WHERE user='root';
   FLUSH PRIVILEGES;
   EXIT;
   ```
6. Cierra ambas terminales
7. Reinicia MySQL desde XAMPP

## 🎯 Solución Rápida (Si tienes acceso a phpMyAdmin):

1. Abre http://localhost/phpmyadmin
2. Usuario: `root`, Contraseña: (vacía)
3. Crea la base de datos `clinicavida`
4. Ejecuta: `php artisan migrate`

## 📝 Verificar que todo funciona:

```bash
php artisan tinker
```

Luego dentro de tinker:
```php
DB::connection()->getPdo();
```

Si no muestra error, ¡está funcionando!

## ⚠️ Si NADA funciona:

1. Reinstala XAMPP
2. O usa SQLite temporalmente (cambia `DB_CONNECTION=sqlite` en `.env`)
3. O contacta con soporte técnico

