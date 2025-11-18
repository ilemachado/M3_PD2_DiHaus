<?php
require_once 'header.php';
require_once 'conexion.php';

$message_to_user = "";
$success = false;


// Verificamos que el método sea POST para evitar accesos directos al script.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar datos del formulario
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $mensaje = filter_input(INPUT_POST, 'mensaje', FILTER_SANITIZE_STRING);

    // Validar que no estén vacíos
    if(empty($nombre) || empty($email) || empty($mensaje)){
        $message_to_user = "<h3>Error</h3><p>Por favor, completá todos los campos del formulario.</p>";
    } else {
        // Guardar en la base de datos de forma segura con sentencias preparadas
        $sql = "INSERT INTO contactos (nombre, email, mensaje) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $nombre, $email, $mensaje);
            
            if (mysqli_stmt_execute($stmt)) {
                $message_to_user = "<h3>¡Gracias por tu mensaje!</h3><p>Hemos recibido tu contacto y lo revisaremos pronto.</p>";
                $success = true;
            } else {
                $message_to_user = "<h3>Error</h3><p>Hubo un problema al guardar tu mensaje en la base de datos. Por favor, intentá de nuevo.</p>";
            }
            mysqli_stmt_close($stmt);
        } else {
            $message_to_user = "<h3>Error</h3><p>Hubo un error preparando la consulta. Por favor, contactá al administrador.</p>";
        }
    }

} else {
    $message_to_user = "<h3>Acceso no permitido</h3><p>Por favor, enviá tus datos a través del formulario de contacto.</p>";
}

?>
<section style="max-width: 800px; margin: 0 auto; padding: 120px 20px 80px 20px; min-height: 100vh; display: flex; align-items: center; justify-content: center;">
    <div style="background: #ffffff; padding: 50px 40px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); text-align: center; width: 100%;">
        <?php echo $message_to_user; ?>
        <a href="contacto.php" style="display: inline-block; margin-top: 1.5rem; padding: 12px 30px; background: <?php echo $success ? '#2852d2' : '#2852d2'; ?>; color: #fff; text-decoration: none; border-radius: 6px; font-family: var(--font-secundaria); font-weight: 700; font-size: 1rem; transition: all 0.3s ease;">Volver al formulario</a>
    </div>
</section>

<?php
require_once 'footer.php';
?>