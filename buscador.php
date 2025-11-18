<?php 
require_once 'header.php'; 
require_once 'conexion.php'; 

$q = '';
if (isset($_GET['q'])) {
    $q = trim($_GET['q']); 
}
?>

<main class="main-content">
    <h1 class="search-page-title">Resultados de Búsqueda</h1>

    <section id="search-results">
        <?php
        if (!empty($q)) {
           echo "<div class='section-header'><h2>Resultados para '" . htmlspecialchars($q) . "'</h2></div>";
        }
        ?>

        <div class="search-results-container">
        <?php
        
        if (!empty($q)) {
            $search_term = '%' . $q . '%'; 
            $results_count = 0; 
            
            $sql_artistas = "SELECT nombre, slug, area, resumen_bio, imagen_url 
                             FROM artistas 
                             WHERE nombre LIKE ? OR area LIKE ? OR resumen_bio LIKE ?";
            
            $stmt_artistas = mysqli_prepare($conn, $sql_artistas);
            
            if ($stmt_artistas) {
                mysqli_stmt_bind_param($stmt_artistas, 'sss', $search_term, $search_term, $search_term);
                mysqli_stmt_execute($stmt_artistas);
                $result_artistas = mysqli_stmt_get_result($stmt_artistas);
                
                if ($result_artistas && mysqli_num_rows($result_artistas) > 0) {
                    $results_count = mysqli_num_rows($result_artistas);
                    
                    while ($artista = mysqli_fetch_assoc($result_artistas)) {
                        $link_url = $base_url . 'artistas/' . htmlspecialchars($artista['slug']) . '.php'; 
                        
                        echo '
                        <div class="artista-search-item">
                            <div class="artista-search-img">
                                <img src="' . $base_url . 'img/' . htmlspecialchars($artista['imagen_url']) . '" alt="' . htmlspecialchars($artista['nombre']) . '">
                            </div>
                            <div class="artista-search-info">
                                <h3 class="search-result-title"><a href="' . $link_url . '">' . htmlspecialchars($artista['nombre']) . '</a></h3>
                                <p class="search-result-area">Área: ' . htmlspecialchars($artista['area']) . '</p>
                                <p class="search-result-snippet">' . nl2br(htmlspecialchars(substr($artista['resumen_bio'], 0, 250))) . '...</p>
                                <a href="' . $link_url . '" class="btn-ver-mas">Ampliar Información</a>
                            </div>
                        </div>';
                    }
                } else {
                    echo "<p class='no-results'>No se encontraron resultados para '" . htmlspecialchars($q) . "'.</p>";
                }
                
            } else {
                 echo "<p class='error-message'>Hubo un error en la preparación de la consulta: " . mysqli_error($conn) . "</p>";
            }

            if ($results_count > 0) {
                echo "<p class='count-message'>Se encontraron {$results_count} resultados.</p>";
            } else if (!mysqli_error($conn)) {
                echo "<p class='no-results'>No se encontraron resultados de artistas para tu búsqueda.</p>";
            }

        } else {
            echo "<p class='no-query'>Por favor, introduce un término de búsqueda (ej: 'Breuer' o 'Arquitectura').</p>";
        }

        ?>
        </div>
    </section>
</main>

<?php 
require_once 'footer.php'; 
?>