<?php
/**
 * Script para crear la base de datos clinicavida
 * Ejecuta este archivo desde el navegador: http://localhost:8000/crear_bd.php
 * O desde la línea de comandos: php crear_bd.php
 */

$host = '127.0.0.1';
$port = 3306;
$username = 'root';
$password = ''; // Cambia esto si tu MySQL tiene contraseña
$database = 'clinicavida';

echo "========================================\n";
echo "Crear Base de Datos - Clínica Vida\n";
echo "========================================\n\n";

try {
    // Conectar a MySQL (sin especificar base de datos)
    $pdo = new PDO(
        "mysql:host=$host;port=$port;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
    
    echo "✓ Conexión a MySQL exitosa\n\n";
    
    // Crear la base de datos
    $sql = "CREATE DATABASE IF NOT EXISTS `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    $pdo->exec($sql);
    
    echo "✓ Base de datos '$database' creada exitosamente\n\n";
    
    // Verificar que se creó
    $stmt = $pdo->query("SHOW DATABASES LIKE '$database'");
    $result = $stmt->fetch();
    
    if ($result) {
        echo "✓ Verificación: La base de datos existe\n\n";
        echo "========================================\n";
        echo "¡ÉXITO! Base de datos creada correctamente\n";
        echo "========================================\n\n";
        echo "Próximos pasos:\n";
        echo "1. Ejecuta: php artisan migrate\n";
        echo "2. Ejecuta: php artisan config:clear\n";
        echo "3. Prueba hacer login nuevamente\n";
    } else {
        echo "⚠ Advertencia: No se pudo verificar la creación\n";
    }
    
} catch (PDOException $e) {
    echo "✗ ERROR: " . $e->getMessage() . "\n\n";
    echo "Posibles soluciones:\n";
    echo "1. Verifica que MySQL esté corriendo en XAMPP\n";
    echo "2. Si MySQL tiene contraseña, actualiza la variable \$password en este archivo\n";
    echo "3. Verifica que el usuario 'root' tenga permisos para crear bases de datos\n";
    echo "4. Revisa el archivo .env y asegúrate de que DB_PASSWORD esté correcto\n";
    exit(1);
}

