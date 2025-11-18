<?php
// ⭐ ESTE PASO ES CRUCIAL: Incluimos el header para que se ejecute session_start()
// y para que se muestre el menú dinámico con el nombre de usuario y el botón "Salir".
require_once 'header.php'; 
?>

<div class="banner">
    <div class="title">
        <?php include("svg_home.php"); ?> 
    </div>
</div>


<main class="main-content">
    <section class="about-section">
        <p class="section-subtitle" data-aos="fade-up" data-aos-duration="1000">SOBRE LA BAUHAUS</p>
        <h1 class="section-title" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
            Un <span class="highlight">archivo vivo</span> de la vanguardia
        </h1>

        <div class="section-body-text" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
            <p class="col-izq">
                Fundada en 1919 por Walter Gropius, la Bauhaus redefinió el diseño, fusionando el arte con la artesanía y la funcionalidad.
            </p>

            <p class="col-centro">
                Di:Haus rinde homenaje a este legado, explorando la relación entre la forma, el color y el espacio en la era digital.
            </p>

            <p class="col-der">
                Es una colección constante de la pureza geométrica y el color primario, manteniendo viva la esencia de la modernidad.
            </p>
        </div>
    </section>

    <section id="historia" class="content-section"></section>

    <section class="artistas-section">
        <h2 class="section-title-artistas" data-aos="fade-up" data-aos-duration="1000">Referentes</h2>
        
        <div class="artistas-grid">
            <div class="artist-item" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="100">
                <div class="artista-card">
                    <img src="img/gropius-1.jpg" alt="Walter Gropius">
                    <div class="overlay">
                        <a href="artistas/gropius.php" class="read-more-link">Leer Más</a>
                    </div>
                </div>
                <h3 class="artist-name">Walter Gropius</h3>
            </div>

            <div class="artist-item" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="200">
                <div class="artista-card">
                    <img src="img/breuer-1.jpg" alt="Marcel Breuer">
                    <div class="overlay">
                        <a href="artistas/breuer.php" class="read-more-link">Leer Más</a>
                    </div>
                </div>
                <h3 class="artist-name">Marcel Breuer</h3>
            </div>

            <div class="artist-item" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="300">
                <div class="artista-card">
                    <img src="img/brandt-1.jpg" alt="Marianne Brandt">
                    <div class="overlay">
                        <a href="artistas/brandt.php" class="read-more-link">Leer Más</a>
                    </div>
                </div>
                <h3 class="artist-name">Marianne Brandt</h3>
            </div>

            <div class="artist-item" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="400">
                <div class="artista-card">
                    <img src="img/moholy-nagy-1.jpg" alt="László Moholy-Nagy">
                    <div class="overlay">
                        <a href="artistas/moholy.php" class="read-more-link">Leer Más</a>
                    </div>
                </div>
                <h3 class="artist-name">László Moholy-Nagy</h3>
            </div>

            <div class="artist-item" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="500">
                <div class="artista-card">
                    <img src="img/klee-1.jpg" alt="Paul Klee">
                    <div class="overlay">
                        <a href="artistas/klee.php" class="read-more-link">Leer Más</a>
                    </div>
                </div>
                <h3 class="artist-name">Paul Klee</h3>
            </div>
        </div>
    </section>
</main>

<?php 
require_once 'footer.php'; 
?>