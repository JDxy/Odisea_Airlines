let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  const slides = document.querySelectorAll('.slider img');
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

function guardarProductoLocalStorage(email ,idProducto, Img_producto, Nombre_producto, precio) {
  // console.log(idProducto, Img_producto, Nombre_producto);
  var productos = [];
  var producto = {
      email: email,
      id_producto: idProducto,
      img: Img_producto,
      nombre: Nombre_producto,
      precio: precio
  };
  productos.push(producto);
  localStorage.setItem("productos" + idProducto, JSON.stringify(productos));
}
