const defaultFile = 'https://stonegatesl.com/wp-content/uploads/2021/01/avatar-300x300.jpg';

const file = document.getElementById( 'foto' );
const img = document.getElementById( 'img' );
file.addEventListener( 'change', e => {
  if( e.target.files[0] ){
    const reader = new FileReader( );
    reader.onload = function( e ){
      img.src = e.target.result;
    }
    reader.readAsDataURL(e.target.files[0])
  }else{
    img.src = defaultFile;
  }
} );


// // En el evento 'change' del input de tipo 'file'
// document.querySelector('#foto').addEventListener('change', function() {
//     // Obtener el elemento de la imagen seleccionada
//     var img = document.querySelector('#img');
  
//     // Asignar la URL de la imagen al valor del campo oculto
//     var imgUrl = img.src;
//     document.querySelector('#img_url').value = imgUrl;
//   });

  
  document.getElementById("foto").addEventListener("change", function() {
  var nombre_imagen = this.files[0].name;
  document.getElementById("img").src = "../ASSETS/IMG/PRODUCTOS/" + nombre_imagen;
  document.getElementById("img_url").value = nombre_imagen;
});
