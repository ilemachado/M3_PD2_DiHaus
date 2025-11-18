document.addEventListener('DOMContentLoaded', () => {
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 1000,    // Duración de la animación en milisegundos (1 segundo)
            once: true,        // La animación solo ocurre una vez por elemento
        });
    }
});


// =========================
// GALERÍA SLIDER FUNCIONAL + MODAL
// =========================

  const sliderWrapper = document.querySelector('.slider-wrapper');
  if (sliderWrapper) {

    const obras = [
      { img: 'obra1.jpg', titulo: 'Edificio Bauhaus en Dessau - Walter Gropius', subtitulo: '1925 - 1926', desc: 'Síntesis de arquitectura moderna, con fachadas de vidrio y estructura funcional.' },
      { img: 'obra2.jpg', titulo: 'Casa Gropius en Dessau - Walter Gropius', subtitulo: '', desc: 'Residencia experimental con líneas simples y racionales.' },
      { img: 'obra3.jpg', titulo: 'Silla Wassily - Marcel Breuer', subtitulo: '1925', desc: 'Primera en usar tubos de acero cromado, inspirada en la ligereza de una bicicleta.' },
      { img: 'obra4.jpg', titulo: 'Silla Cesca - Marcel Breuer', subtitulo: '1928', desc: 'Mezcla de acero tubular y mimbre, combinación de tradición artesanal con producción industrial.' },
      { img: 'obra5.jpg', titulo: 'Silla Laminar “Long Chair” - Marcel Breuer', subtitulo: '1935 - 1936', desc: 'Pieza icónica del diseño moderno que explora la curvatura de la madera laminada para lograr una estructura continua, ergonómica y ligera. Su perfil fluido representa la transición de Breuer hacia materiales orgánicos y producción industrial avanzada.' },
      { img: 'obra6.jpg', titulo: 'Lámparas esféricas - Marianne Brandt', subtitulo: '1926', desc: 'Luminarias modernas, producidas en serie, íconos del diseño industrial.' },
      { img: 'obra7.jpg', titulo: 'Juego de té y café en metal - Marianne Brandt', subtitulo: '1924', desc: 'Líneas geométricas, unión de estética y practicidad.' },
      { img: 'obra8.jpg', titulo: 'Cenicero 90010 - Marianne Bandt', subtitulo: '1926 – 1928', desc:'Objeto metálico de geometría pura, con tapa abatible y formas limpias. Ejemplo perfecto de la síntesis entre funcionalidad cotidiana y precisión formal característica de la Bauhaus, pensado para la producción en serie.' },
      { img: 'obra9.jpg', titulo: 'Fotogramas - Moholy-Nagy', subtitulo: '1920\'s', desc: 'Fotografías sin cámara, colocando objetos directamente sobre papel fotosensible.' },
      { img: 'obra10.jpg', titulo: 'Escultura luminocinética - Moholy-Nagy', subtitulo: 'Licht-Raum-Modulator, 1930', desc: 'Obra de luz y movimiento, explorando interacción entre arte y tecnología.' },
      { img: 'obra11.jpg', titulo: 'Twittering Machine - Paul Klee', subtitulo: '1922', desc: 'Obra que combina abstracción y lirismo, explorando la relación entre naturaleza y fantasía.' },
      { img: 'obra12.jpg', titulo: 'Pedagogical Sketchbook - Paul Klee', subtitulo: '1925', desc: 'Publicación usada en Bauhaus, donde sistematiza su pensamiento sobre forma, color y construcción.' }
    ];

    // Generar slides
    obras.forEach((obra, index) => {
      const slide = document.createElement('div');
      slide.classList.add('slide');
      slide.innerHTML = `
        <img src="img/${obra.img}" alt="${obra.titulo}" data-index="${index}">
        <p class="slide-description">${obra.titulo}</p>
      `;
      sliderWrapper.appendChild(slide);
    });

    const slides = document.querySelectorAll('.slide');
    let currentSlide = 0;

    // Botones slider
    document.querySelector('.slider-btn.prev').addEventListener('click', () => {
      currentSlide = (currentSlide - 1 + slides.length) % slides.length;
      sliderWrapper.scrollTo({ left: slides[currentSlide].offsetLeft, behavior: 'smooth' });
    });
    document.querySelector('.slider-btn.next').addEventListener('click', () => {
      currentSlide = (currentSlide + 1) % slides.length;
      sliderWrapper.scrollTo({ left: slides[currentSlide].offsetLeft, behavior: 'smooth' });
    });

    // =========================
    // MODAL LIGHTBOX
    // =========================
    const modal = document.getElementById('imgModal');
    const modalImg = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalSubtitle = document.getElementById('modalSubtitle');
    const modalDesc = document.getElementById('modalDescription');
    const closeModal = document.querySelector('.modal-close');

    slides.forEach(slide => {
      slide.querySelector('img').addEventListener('click', (e) => {
        const idx = e.target.getAttribute('data-index');
        const obra = obras[idx];
        modal.style.display = 'flex';
        modalImg.src = `img/${obra.img}`;
        modalTitle.textContent = obra.titulo;
        modalSubtitle.textContent = obra.subtitulo;
        modalDesc.textContent = obra.desc;
      });
    });

    closeModal.addEventListener('click', () => modal.style.display = 'none');
    modal.addEventListener('click', (e) => {
      if (e.target === modal) modal.style.display = 'none';
    });
  }




