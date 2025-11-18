<?php
require_once 'header.php'; 
require_once 'conexion.php';

// Si el usuario ya está logueado (usamos 'user_id' o 'usuario' dependiendo de tu estructura)
if (isset($_SESSION['user_id']) || isset($_SESSION['usuario'])) {
    // Redirigir al catálogo, panel, o la página que le corresponda al usuario logueado
    header('Location: /' . $folder_name . '/catalogo.php'); 
    exit;
}

$error = "";
$usuario_ingresado = ""; // Para rellenar el campo de usuario si falla la validación

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_type']) && $_POST['form_type'] === 'login') {
    
    // 1. Lógica de Validación y Login (Solo si se envió el formulario de login)
    if (!empty(trim($_POST['usuario'])) && !empty(trim($_POST['password']))) {
        $usuario = trim($_POST['usuario']);
        $password = trim($_POST['password']);
        $usuario_ingresado = htmlspecialchars($usuario);

        // Busca al usuario en la base de datos
        $sql_check = "SELECT id, usuario, nombre, apellido, password, remember_token, remember_token_expiry FROM usuarios WHERE usuario = ?";
        $stmt_check = mysqli_prepare($conn, $sql_check);
        mysqli_stmt_bind_param($stmt_check, 's', $usuario);
        mysqli_stmt_execute($stmt_check);
        $result = mysqli_stmt_get_result($stmt_check);
        $user = mysqli_fetch_assoc($result);

        // Verifica si el usuario existe y la contraseña es correcta
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id']; 
            $_SESSION['usuario'] = $user['usuario'];
            $_SESSION['nombre'] = $user['nombre']; 
            $_SESSION['apellido'] = $user['apellido'];

            // 2. Manejo de "Recordarme"
            if (isset($_POST['remember_me']) && $_POST['remember_me'] == '1') {
                $token = bin2hex(random_bytes(32));
                $expiry_date = date('Y-m-d H:i:s', time() + (86400 * 30)); // 30 días

                // Almacenar token en la base de datos
                $sql_update_token = "UPDATE usuarios SET remember_token = ?, remember_token_expiry = ? WHERE id = ?";
                $stmt_update_token = mysqli_prepare($conn, $sql_update_token);
                mysqli_stmt_bind_param($stmt_update_token, 'ssi', $token, $expiry_date, $user['id']);
                mysqli_stmt_execute($stmt_update_token);

                // Establecer la cookie (Path "/" es crucial)
                $cookie_value = $user['id'] . ':' . $token;
                setcookie('remember_me', $cookie_value, time() + (86400 * 30), "/"); 
            }

            // Redirección
            header('Location: /' . $folder_name . '/catalogo.php');
            exit;
        }
        $error = "Usuario o contraseña incorrectos.";
    } else {
        $error = "El usuario y la contraseña no pueden estar vacíos.";
    }
}

?>

<main class="access-main">

    <div class="access-container">

        <div class="access-col">
            <h1 class="access-title">Iniciar sesión</h1>

            <?php if (!empty($error)): ?>
                <p style='color:var(--rojo); margin-top: 1rem; text-align: center; font-family: var(--font-secundaria);'>
                    <?php echo htmlspecialchars($error); ?>
                </p>
            <?php endif; ?>

            <form action="login.php" method="post" class="access-form">
                <input type="hidden" name="form_type" value="login"> 
                
                <label for="login_usuario">Nombre de usuario</label>
                <input type="text" id="login_usuario" name="usuario" value="<?php echo $usuario_ingresado; ?>" required>

                <label for="login_password">Contraseña</label>
                <input type="password" id="login_password" name="password" required>

                <div style="display: flex; align-items: center; gap: 8px; margin-top: 10px;">
                    <input type="checkbox" id="remember_me" name="remember_me" value="1" style="width: auto; margin: 0;">
                    <label for="remember_me" style="margin: 0; font-size: 0.9rem;">Recordarme</label>
                </div>

                <button type="submit" class="access-btn">Entrar</button>
            </form>
        </div>

        <div class="access-col">
            <h1 class="access-title">Crear cuenta</h1>

            <form action="registro.php" method="post" class="access-form">
                
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="apellido" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="reg_usuario">Nombre de usuario</label>
                <input type="text" id="reg_usuario" name="usuario" maxlength="30" required>

                <label for="reg_password">Contraseña</label>
                <input type="password" id="reg_password" name="password" required>

                <label for="confirm_password">Confirmar Contraseña</label>
                <input type="password" id="confirm_password" name="confirm_password" required>

                <button type="submit" class="access-btn">Registrarme</button>
            </form>
        </div>

    </div>

</main>

<?php 
require_once 'footer.php'; 
?>