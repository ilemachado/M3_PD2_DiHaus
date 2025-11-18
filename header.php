<?php

session_set_cookie_params([
    'lifetime' => 0, // La cookie dura hasta que se cierra el navegador
    'path' => '/',   // ESTABLECE LA RUTA DE LA COOKIE AL NIVEL SUPERIOR 
    'domain' => '',  
    'secure' => false, 
    'httponly' => true // Buena práctica de seguridad
]);


// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$folder_name = 'DiHaus_copia'; 
$base_url = '/' . $folder_name . '/';

// Verificar cookie Remember Me si el usuario NO está logueado
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_me'])) {
    require_once 'conexion.php';

    list($user_id, $token) = explode(':', $_COOKIE['remember_me'], 2);

    if ($user_id && $token) {
        $sql = "SELECT * FROM usuarios 
                WHERE id = ? AND remember_token = ? 
                AND remember_token_expiry > NOW()";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'is', $user_id, $token);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nombre'] = $user['nombre'];
            $_SESSION['apellido'] = $user['apellido'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['usuario'] = $user['usuario'];

            $new_token = bin2hex(random_bytes(32));
            $sql_update = "UPDATE usuarios SET remember_token = ? WHERE id = ?";
            $stmt2 = mysqli_prepare($conn, $sql_update);
            mysqli_stmt_bind_param($stmt2, 'si', $new_token, $user_id);
            mysqli_stmt_execute($stmt2);

            setcookie("remember_me", $user_id . ":" . $new_token, time() + 86400*30, "/");
        }
    }
    mysqli_close($conn);
    unset($conn);
}

$page_slug = basename($_SERVER["PHP_SELF"], ".php");

// Títulos
$titles = [
    "index" => "Inicio",
    "historia" => "Historia",
    "galeria" => "Galería",
    "contacto" => "Contacto",
    "catalogo" => "Catálogo Exclusivo",
    "login" => "Iniciar Sesión",
    "enviar" => "Mensaje Enviado",
    "gropius" => "Walter Gropius",
    "breuer" => "Marcel Breuer",
    "brandt" => "Marianne Brandt",
    "moholy" => "László Moholy-Nagy",
    "klee" => "Paul Klee",
];



if (!isset($page_title)) {
    $page_title = $titles[$page_slug] ?? "Di:Haus";
    $page_title .= " – Di:Haus";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?php echo htmlspecialchars($page_title); ?></title>

  <link rel="stylesheet" href="<?php echo $base_url; ?>style.css?v=2"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet"/>
</head>

<body>
<header class="main-header">
    <div class="header-logo">
        <a href="<?php echo $base_url; ?>index.php">
            <img src="<?php echo $base_url; ?>img/logo.svg" alt="Di:Haus Logo" class="nav-logo"/>
        </a>
    </div>

    <nav class="nav-links">
        <a href="<?php echo $base_url; ?>index.php" class="<?php echo ($page_slug == 'index') ? 'active' : ''; ?>">Inicio</a>
        <a href="<?php echo $base_url; ?>historia.php" class="<?php echo ($page_slug == 'historia') ? 'active' : ''; ?>">Historia</a>

<div class="dropdown">
            <button class="dropbtn">Artistas</button>
            <div class="dropdown-content">
                <a href="<?php echo $base_url; ?>artistas/gropius.php">Walter Gropius</a>
                <a href="<?php echo $base_url; ?>artistas/breuer.php">Marcel Breuer</a>
                <a href="<?php echo $base_url; ?>artistas/brandt.php">Marianne Brandt</a>
                <a href="<?php echo $base_url; ?>artistas/moholy.php">László Moholy-Nagy</a>
                <a href="<?php echo $base_url; ?>artistas/klee.php">Paul Klee</a>
            </div>
        </div>
        

        <a href="<?php echo $base_url; ?>galeria.php" class="<?php echo ($page_slug == 'galeria') ? 'active' : ''; ?>">Galería</a>
        <a href="<?php echo $base_url; ?>contacto.php" class="<?php echo ($page_slug == 'contacto') ? 'active' : ''; ?>">Contacto</a>

        <?php if (isset($_SESSION["user_id"])): ?>
            <a href="<?php echo $base_url; ?>catalogo.php" class="<?php echo ($page_slug == "catalogo") ? "active" : ""; ?>">Catálogo</a>
        <?php endif; ?>
    </nav>

    <form action="<?php echo $base_url; ?>buscador.php" method="get" class="search-form">
        <input type="search" name="q" placeholder="Buscar Artistas" 
               value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>" required>
        <button type="submit" class="search-button"><i class="fas fa-search"></i></button>
    </form>
        <div class="auth-link">
        <?php if (isset($_SESSION["user_id"])): ?>
        <span class="user-greeting">
         Hola, <?php echo htmlspecialchars($_SESSION['nombre']); ?> </span>
        <a href="<?php echo $base_url; ?>logout.php">Salir</a>
    <?php else: ?>
    <a href="<?php echo $base_url; ?>login.php">Unirse</a>
    <?php endif; ?>
    </div>
</header>


