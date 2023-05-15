let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  const slides = document.querySelectorAll('.section-2 .slider img');
  for (i = 0; i < slides.length; i++) {
    slides[i].classList.remove('active');
  }
  slideIndex++;
  if (slideIndex > slides.length) {
    slideIndex = 1;
  }
  slides[slideIndex - 1].classList.add('active');
  setTimeout(showSlides, 3000); // Cambiar imagen cada 3 segundos
}





  