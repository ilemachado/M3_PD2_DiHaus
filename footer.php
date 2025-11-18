<?php
if (isset($conn) && $conn) {
    mysqli_close($conn);
}
?>

</main>

<footer class="footer">
    <div class="social-icons">
        <a href="https://x.com/BauhausMovement" target="_blank"><i class="fab fa-x-twitter"></i></a>
        <a href="https://www.instagram.com/bauhaus.movement/" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://www.facebook.com/bauhaus.movement/?locale=es_LA" target="_blank"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.youtube.com/@bauhaus-movement/featured" target="_blank"><i class="fab fa-youtube"></i></a>
    </div>

    <div class="legales">
        © 2025 Di:Haus. Todos los derechos reservados. | Aviso Legal
    </div>
</footer>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script src="app.js"></script>
<script>
AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true
});
</script>
</body>
</html>



