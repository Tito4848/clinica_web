# Cómo Acceder al Dashboard del Doctor

## Opción 1: Usar el Seeder (Recomendado)

1. Ejecuta el seeder para crear usuarios doctores de prueba:
```bash
php artisan db:seed --class=DoctorSeeder
```

O ejecuta todos los seeders:
```bash
php artisan db:seed
```

2. Credenciales de prueba creadas:
   - **Email:** `doctor@clinica.com`
   - **Password:** `password123`
   - **Email:** `doctora@clinica.com`
   - **Password:** `password123`

3. Inicia sesión en la página web con estas credenciales.

4. Una vez logueado como doctor, verás el enlace **"Dashboard"** en el menú superior.

5. Haz clic en "Dashboard" o accede directamente a: `http://tu-dominio/doctor/dashboard`

## Opción 2: Registrarse como Doctor

1. Ve a la página de registro: `/register`

2. Completa el formulario:
   - Nombre completo
   - Email
   - Teléfono
   - **Tipo de Usuario:** Selecciona **"Doctor"**
   - **Especialidad:** Selecciona tu especialidad (aparece cuando seleccionas "Doctor")
   - Contraseña

3. Al registrarte como doctor, serás redirigido automáticamente al Dashboard del Doctor.

## Funcionalidades del Dashboard del Doctor

### 1. Dashboard Principal (`/doctor/dashboard`)
- **Estadísticas:**
  - Total de citas
  - Citas de hoy
  - Citas pendientes
  - Citas confirmadas

- **Acciones Rápidas:**
  - Ver Calendario
  - Agendar Cita

- **Citas de Hoy:**
  - Lista de todas las citas programadas para hoy
  - Puedes cambiar el estado de cada cita (Pendiente, Confirmada, Completada, Cancelada)

- **Todas las Citas:**
  - Lista completa de todas tus citas
  - Puedes cambiar estados y eliminar citas

### 2. Calendario (`/doctor/calendario`)
- Vista de calendario con todas tus citas
- Puedes ver las citas en diferentes vistas:
  - Mes
  - Semana
  - Día
- Las citas se muestran con colores según su estado:
  - Verde: Confirmadas
  - Amarillo: Pendientes

## Notas Importantes

- Solo los usuarios con rol "doctor" pueden acceder al dashboard
- El enlace "Dashboard" en el menú solo aparece cuando estás logueado como doctor
- Si intentas acceder sin ser doctor, serás redirigido a la página principal

## Solución de Problemas

### No veo el enlace "Dashboard" en el menú
- Verifica que estés logueado
- Verifica que tu usuario tenga el rol "doctor" en la base de datos
- Verifica que exista un registro en la tabla `doctores` asociado a tu usuario

### Error: "Perfil de doctor no encontrado"
- Asegúrate de que exista un registro en la tabla `doctores` con tu `user_id`
- Puedes crear el perfil manualmente desde phpMyAdmin o usando tinker

### No puedo acceder a `/doctor/dashboard`
- Verifica que estés autenticado (logueado)
- Verifica que tu usuario tenga `role = 'doctor'` en la tabla `users`
- Verifica que exista un registro en la tabla `doctores` con tu `user_id`

