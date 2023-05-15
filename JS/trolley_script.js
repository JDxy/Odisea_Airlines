



function mostrarInput(idProducto) {
  var x = document.getElementById("inputCantidad" + idProducto);
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}




function realizarPago() {
  if (!document.cookie.includes("cliente")) {
    window.location.href = "start_session.php";
  } else {
    const modal = document.querySelector('.modal-overlay');
    modal.classList.add('activo');
  }
}




const modal = document.querySelector('.modal-overlay');
const abrirModalBtn = document.getElementById('abrir-modal');
const cerrarModalBtn = document.querySelector('.modal button[type="button"]');

abrirModalBtn.addEventListener('click', () => {
  modal.classList.add('activo');
});

cerrarModalBtn.addEventListener('click', () => {
  modal.classList.remove('activo');
});



function obtener_productos() {
  
var line_val = ''


var total = 0



for (let i = 0; i < localStorage.length; i++) {
  const key = localStorage.key(i);
  const value = localStorage.getItem(key);
  line = `${key}: ${value}`;
    // console.log(value)
  line_val = JSON.parse(value)
//   console.log(line_val[0])
    console.log(line_val[0]['id'])
    console.log(line_val[0]['img'])
    console.log(line_val[0]['nombre'])
    console.log(line_val[0]['precio'])

    const miDiv = document.createElement("div");
    miDiv.classList.add("producto");
    // miDiv.innerHTML = `
    //     <p>ID: ${line_val[0]['id']}</p>
    //     <img src=" ${line_val[0]['img']}.png " alt="">
    //     <p>Nombre: ${line_val[0]['nombre']}</p>
    //     <p>Precio: ${line_val[0]['precio']}</p>
    // `;

    miDiv.innerHTML = `

    <img src=" ${line_val[0]['img']}.png " alt="">
    <p>Nombre: ${line_val[0]['nombre']}</p>
    <p>Precio: ${line_val[0]['precio']}</p>
`;

    // document.body.appendChild(miDiv);
    document.getElementsByClassName("productos")[0].appendChild(miDiv)
    total += parseFloat(line_val[0]['precio'])
    console.log(total)

    
    
}

node = document.createTextNode(total)
document.getElementsByClassName("pay")[0].appendChild(node)

// lista_json = json.stringify(lista);


}

obtener_productos()





