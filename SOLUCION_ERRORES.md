# Solución de Errores - Clínica Vida

## Error 1: Laravel usando SQLite en lugar de MySQL

**Problema:** Laravel está intentando usar SQLite cuando debería usar MySQL.

**Solución aplicada:**
- ✅ Se descomentaron las líneas de configuración de MySQL en el archivo `.env`
- ✅ Se limpió la caché de configuración de Laravel

**Verificación:**
Ejecuta estos comandos para verificar:
```bash
php artisan config:clear
php artisan cache:clear
```

## Error 2: Error de conexión a phpMyAdmin

**Problema:** 
```
Access denied for user 'pma'@'localhost' (using password: NO)
Access denied for user 'root'@'localhost' (using password: NO)
```

**Soluciones:**

### Opción A: Verificar que MySQL esté corriendo
1. Abre el panel de control de XAMPP
2. Asegúrate de que MySQL esté iniciado (debe aparecer en verde)
3. Si no está iniciado, haz clic en "Start" junto a MySQL

### Opción B: Verificar credenciales de MySQL
1. Abre el archivo `config.inc.php` de phpMyAdmin (normalmente en `C:\xampp\phpMyAdmin\config.inc.php`)
2. Verifica estas líneas:
```php
$cfg['Servers'][1]['user'] = 'root';
$cfg['Servers'][1]['password'] = '';  // Debe estar vacío si no tienes contraseña
```

### Opción C: Crear la base de datos manualmente
Si phpMyAdmin no funciona, puedes crear la base de datos desde la línea de comandos:

1. Abre una terminal/PowerShell
2. Navega a la carpeta de MySQL de XAMPP:
```bash
cd C:\xampp\mysql\bin
```

3. Conecta a MySQL:
```bash
mysql.exe -u root
```

4. Crea la base de datos:
```sql
CREATE DATABASE clinicavida CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### Opción D: Usar MySQL desde la línea de comandos
Si tienes problemas con phpMyAdmin, puedes ejecutar las migraciones directamente:

1. Asegúrate de que MySQL esté corriendo en XAMPP
2. Verifica que el archivo `.env` tenga:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=clinicavida
DB_USERNAME=root
DB_PASSWORD=
```

3. Ejecuta las migraciones:
```bash
php artisan migrate
```

## Pasos para resolver completamente:

1. **Verificar XAMPP:**
   - Abre XAMPP Control Panel
   - Inicia Apache y MySQL
   - Verifica que ambos estén en verde

2. **Crear la base de datos:**
   - Opción 1: Usa phpMyAdmin (http://localhost/phpmyadmin)
   - Opción 2: Usa la línea de comandos (ver Opción C arriba)
   - Opción 3: Ejecuta el archivo `crear_base_datos.sql`

3. **Verificar configuración .env:**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=clinicavida
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Limpiar caché de Laravel:**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

5. **Ejecutar migraciones:**
   ```bash
   php artisan migrate
   ```

6. **Probar la conexión:**
   ```bash
   php artisan tinker
   ```
   Luego en tinker:
   ```php
   DB::connection()->getPdo();
   ```
   Si no hay error, la conexión está funcionando.

## Si MySQL tiene contraseña:

Si configuraste una contraseña para el usuario `root` de MySQL, actualiza el `.env`:
```env
DB_PASSWORD=tu_contraseña_aqui
```

## Verificar que todo funciona:

1. Reinicia el servidor de Laravel:
   ```bash
   php artisan serve
   ```

2. Intenta hacer login nuevamente

3. Si aún hay errores, verifica los logs:
   ```bash
   tail -f storage/logs/laravel.log
   ```

