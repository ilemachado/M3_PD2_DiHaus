<?php 
$page_title = "Contacto – Di:Haus";
require_once 'header.php'; 
?>

<section class="contacto-section" data-aos="fade-up">
  <h1 class="section-title">Contactate</h1>
  <p class="section-subtitle">y descubrí más sobre la Bauhaus</p>

  <div class="contacto-grid">
    <!-- FORMULARIO -->
    <div class="contacto-form">
      <form action="enviar.php" method="POST">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required>
        </div>

        <div class="form-group">
          <label for="email">Correo electrónico</label>
          <input type="email" id="email" name="email" placeholder="nombre@mail.com" required>
        </div>

        <div class="form-group">
          <label for="mensaje">Mensaje</label>
          <textarea id="mensaje" name="mensaje" placeholder="Escribí tu mensaje..." rows="5" required></textarea>
        </div>

        <button type="submit" class="btn-enviar">Enviar</button>
      </form>
    </div>

    <!-- MAPA -->
    <div class="contacto-mapa">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2306.289620024428!2d12.23846427694912!3d51.83899417345424!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47a6e4e1d835ef11%3A0xbee098ff6146b4de!2sBauhaus%20Museum%20Dessau!5e0!3m2!1ses-419!2sar!4v1696799440000!5m2!1ses-419!2sar"
        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
  </div>
</section>

<?php 
require_once 'footer.php'; 
?>