const slides = document.querySelector('.carousel-slides');

        const slide = document.querySelectorAll('.carousel-slide');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        let currentIndex = 0;

        // Mostrar la diapositiva actual
        function showSlide(index) {
            const totalSlides = slide.length;
            if (index < 0) {
                currentIndex = totalSlides - 1;
            } else if (index >= totalSlides) {
                currentIndex = 0;
            } else {
                currentIndex = index;
            }
            slides.style.transform = `translateX(-${currentIndex * 100}%)`;
        }

        // Eventos de los botones
        prevBtn.addEventListener('click', () => showSlide(currentIndex - 1));
        nextBtn.addEventListener('click', () => showSlide(currentIndex + 1));

        // Cambio automático cada 3 segundos
        setInterval(() => showSlide(currentIndex + 1), 30000);
    