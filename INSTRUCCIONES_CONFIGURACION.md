# Instrucciones de Configuración - Clínica Vida

## Configuración de Base de Datos (XAMPP)

### Paso 1: Configurar XAMPP
1. Asegúrate de que XAMPP esté instalado y funcionando
2. Inicia Apache y MySQL desde el panel de control de XAMPP
3. Abre phpMyAdmin (http://localhost/phpmyadmin)

### Paso 2: Crear la Base de Datos
1. En phpMyAdmin, crea una nueva base de datos llamada `clinicavida`
2. O ejecuta este comando SQL:
```sql
CREATE DATABASE clinicavida CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Paso 3: Configurar el archivo .env
Abre el archivo `.env` en la raíz del proyecto y configura lo siguiente:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=clinicavida
DB_USERNAME=root
DB_PASSWORD=
```

**Nota:** Si tu MySQL tiene contraseña, agrégala en `DB_PASSWORD`

### Paso 4: Ejecutar Migraciones
Abre una terminal en la carpeta del proyecto y ejecuta:

```bash
php artisan migrate
```

Esto creará todas las tablas necesarias:
- users (con roles: doctor, paciente, admin)
- doctores
- pacientes
- citas

### Paso 5: Crear un Usuario de Prueba (Opcional)
Puedes crear un usuario doctor de prueba ejecutando:

```bash
php artisan tinker
```

Y luego:
```php
$user = App\Models\User::create([
    'name' => 'Dr. Prueba',
    'email' => 'doctor@clinica.com',
    'password' => bcrypt('password123'),
    'role' => 'doctor',
    'telefono' => '987654321'
]);

$doctor = App\Models\Doctor::create([
    'user_id' => $user->id,
    'especialidad' => 'Consulta General',
    'hora_inicio' => '08:00',
    'hora_fin' => '18:00',
    'duracion_cita' => 30
]);
```

## Funcionalidades Implementadas

### Para Doctores:
1. **Dashboard del Doctor** (`/doctor/dashboard`)
   - Ver estadísticas de citas
   - Lista de todas las citas
   - Citas del día
   - Cambiar estado de citas (pendiente, confirmada, completada, cancelada)
   - Eliminar citas

2. **Calendario** (`/doctor/calendario`)
   - Vista de calendario con todas las citas
   - Visualización por mes, semana o día
   - Citas marcadas con colores según estado

### Para Pacientes:
1. **Solicitar Cita** (`/cita`)
   - Formulario para agendar citas
   - Selección de especialidad
   - Fecha y hora disponibles

### General:
1. **Apartado Clínica** (`/clinica`)
   - Información sobre la clínica
   - Características y servicios

2. **Autenticación**
   - Login con email y contraseña
   - Registro con selección de rol (doctor/paciente)
   - Redirección automática según rol

## Estructura de Roles

- **doctor**: Acceso al dashboard y calendario
- **paciente**: Acceso normal al sitio
- **admin**: (Para futuras implementaciones)

## Rutas Principales

- `/` - Página de inicio
- `/principal` - Página principal
- `/clinica` - Información de la clínica
- `/login` - Iniciar sesión
- `/register` - Registrarse
- `/cita` - Solicitar cita
- `/doctor/dashboard` - Dashboard del doctor (requiere autenticación)
- `/doctor/calendario` - Calendario del doctor (requiere autenticación)

## Notas Importantes

1. Asegúrate de que XAMPP esté corriendo antes de ejecutar las migraciones
2. El usuario por defecto de MySQL en XAMPP es `root` sin contraseña
3. Si tienes problemas de conexión, verifica que el puerto 3306 esté libre
4. Las citas se agregan automáticamente al calendario del doctor correspondiente

## Próximos Pasos Sugeridos

1. Agregar validación de horarios disponibles
2. Implementar notificaciones por email
3. Agregar más especialidades
4. Implementar búsqueda y filtros en el dashboard
5. Agregar perfil de usuario editable

