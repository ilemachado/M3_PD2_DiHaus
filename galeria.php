<?php
require_once 'header.php'; 
?>

<section class="galeria-section" data-aos="fade-up" data-aos-duration="1000">
    <p class="section-subtitle">
        UNA SELECCIÓN DE 12 OBRAS ICÓNICAS
    </p>
    <h1 class="section-title">
        Explorá la Colección
    </h1>

    <div class="slider-container">
        <button class="slider-btn prev"><i class="fas fa-chevron-left"></i></button>

        <div class="slider-wrapper">
</div>

        <button class="slider-btn next"><i class="fas fa-chevron-right"></i></button>
    </div>
</section>

<div class="modal" id="imgModal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <img id="modalImage" src="" alt="">
        <div class="modal-info">
            <h2 id="modalTitle"></h2>
            <h3 id="modalSubtitle"></h3>
            <p id="modalDescription"></p>
        </div>
    </div>
</div>

<?php

require_once 'footer.php';
?>

<script src="app.js"></script>