<?php

require_once 'header.php'; 
require_once 'conexion.php';


if (isset($_SESSION['user_id']) || isset($_SESSION['usuario'])) {

    $redir_path = isset($folder_name) ? '/' . $folder_name . '/catalogo.php' : 'catalogo.php';
    header('Location: ' . $redir_path); 
    exit;
}

$error = "";
$registro_datos = [
    'nombre' => '',
    'apellido' => '',
    'email' => '',
    'usuario' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Recolección y Sanitización de Datos
    $nombre = trim($_POST['nombre'] ?? '');
    $apellido = trim($_POST['apellido'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $usuario = trim($_POST['usuario'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Guardar los datos para rellenar el formulario en caso de error
    $registro_datos = [
        'nombre' => htmlspecialchars($nombre),
        'apellido' => htmlspecialchars($apellido),
        'email' => htmlspecialchars($email),
        'usuario' => htmlspecialchars($usuario)
    ];

    // 2. Validación Básica y de Coincidencia
    if (empty($nombre) || empty($apellido) || empty($email) || empty($usuario) || empty($password) || empty($confirm_password)) {
        $error = "Todos los campos son obligatorios.";
    } elseif ($password !== $confirm_password) {
        $error = "Las contraseñas no coinciden.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "El formato del email no es válido.";
    } elseif (strlen($password) < 6) { // Añadir una verificación de seguridad mínima
        $error = "La contraseña debe tener al menos 6 caracteres.";
    } else {
        
        // 3. Verificación de Duplicados (Usuario o Email)
        $sql_check = "SELECT id, usuario, nombre, apellido, password FROM usuarios WHERE usuario = ? OR email = ?";
        $stmt_check = mysqli_prepare($conn, $sql_check);
        mysqli_stmt_bind_param($stmt_check, 'ss', $usuario, $email);
        mysqli_stmt_execute($stmt_check);
        mysqli_stmt_store_result($stmt_check);

        if (mysqli_stmt_num_rows($stmt_check) > 0) {
            $error = "El nombre de usuario o el email ya están en uso. Por favor, elegí otros.";
        } else {
            // 4. Creación Segura de la Cuenta
            
            // Cifrado de la contraseña (ESENCIAL)
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Query para insertar todos los campos
            $sql_insert = "INSERT INTO usuarios (nombre, apellido, email, usuario, password) VALUES (?, ?, ?, ?, ?)";
            
            $stmt_insert = mysqli_prepare($conn, $sql_insert);
            
            // 'sssss' significa 5 strings
            mysqli_stmt_bind_param($stmt_insert, 'sssss', $nombre, $apellido, $email, $usuario, $hashed_password);
            
            if (mysqli_stmt_execute($stmt_insert)) {
                
                // 5. Iniciar Sesión Automáticamente y Redirigir
                $_SESSION['user_id'] = mysqli_insert_id($conn); 
                $_SESSION['usuario'] = $usuario;
                $_SESSION['nombre'] = $nombre;
                $_SESSION['apellido'] = $apellido;
                
                // Redirigir al catálogo/panel
                $redir_path = isset($folder_name) ? '/' . $folder_name . '/catalogo.php' : 'catalogo.php';
                header('Location: ' . $redir_path);
                exit;
            } else {
                $error = "Error al crear la cuenta. Por favor, intentalo de nuevo.";
            }
            mysqli_stmt_close($stmt_insert);
        }
        mysqli_stmt_close($stmt_check);
    }
}

?>

<main class="access-main">

    <div class="access-container">

        <div class="access-col" style="max-width: 500px; margin: auto;">
            <h1 class="access-title">Crear Cuenta</h1>

            <?php if (!empty($error)): ?>
                <p style='color: var(--rojo); margin-top: 1rem; text-align: center; font-family: var(--font-secundaria);'>
                    <?php echo htmlspecialchars($error); ?>
                </p>
            <?php endif; ?>

            <form action="registro.php" method="post" class="access-form">

                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $registro_datos['nombre']; ?>" required>

                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="apellido" value="<?php echo $registro_datos['apellido']; ?>" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $registro_datos['email']; ?>" required>

                <label for="usuario">Nombre de usuario</label>
                <input type="text" id="usuario" name="usuario" maxlength="30" value="<?php echo $registro_datos['usuario']; ?>" required>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>

                <label for="confirm_password">Confirmar Contraseña</label>
                <input type="password" id="confirm_password" name="confirm_password" required>

                <button type="submit" class="access-btn">Registrarme</button>
            </form>
            
            <div style="text-align: center; margin-top: 2rem; padding-top: 1rem; border-top: 2px solid var(--negro);">
                <p>¿Ya tenés una cuenta?</p>
                <a href="/<?php echo $folder_name ?? ''; ?>/login.php" style="font-family: var(--font-titulo); color: var(--rojo); text-decoration: underline;">Iniciá sesión acá</a>
            </div>
        </div>

    </div>

</main>

<?php 
require_once 'footer.php'; 
?>