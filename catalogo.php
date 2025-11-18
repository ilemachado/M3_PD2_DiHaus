<?php 
require_once 'header.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$page_title = "Catálogo Exclusivo – Di:Haus"; 

?>

<section class="catalogo-section" style="max-width: 1400px; margin: 0 auto; padding-top: 120px; padding-bottom: 80px;">
    <h1 class="section-title" style="font-family: var(--font-primaria); font-size: clamp(2rem, 5vw, 3rem); font-weight: 700; text-align: center; margin-bottom: 20px; color: var(--color-texto);">
        Catálogo Exclusivo
    </h1>
    
<p style="text-align: center; font-family: var(--font-secundaria); font-size: 1.2rem; margin-bottom: 60px; color: var(--color-texto);">
    <strong>¡Bienvenido/a <?php echo htmlspecialchars($_SESSION['nombre']); ?>!</strong>
</p>

    <!-- CONTENIDO DEL CATÁLOGO -->
    <div style="background: #ffffff; padding: 60px 40px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); text-align: center; max-width: 900px; margin: 0 auto;">
        <h2 style="font-family: var(--font-primaria); font-size: 2rem; color: var(--color-azul); margin-bottom: 30px;">
            Contenido Exclusivo del Catálogo
        </h2>
        <p style="font-family: var(--font-secundaria); font-size: 1.1rem; line-height: 1.8; color: var(--color-texto); margin-bottom: 30px;">
            Esta sección está reservada para miembros registrados de Di:Haus. 
        </p>
        <p style="font-family: var(--font-secundaria); font-size: 1.1rem; line-height: 1.8; color: var(--color-texto); margin-bottom: 30px;">
            Acá vas a encontrar contenido exclusivo, recursos adicionales y material especial sobre la Bauhaus.
        </p>
        <p style="font-family: var(--font-secundaria); font-size: 1rem; color: #666;">
            Próximamente
        </p>
    </div>
</section>

<?php 
require_once 'footer.php'; 
?>