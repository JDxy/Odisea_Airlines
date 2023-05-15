<button onclick="toggleColorMode()">Cambiar modo de color</button>

<script>
  function toggleColorMode() {
    if (localStorage.getItem("colorMode") === "dark") {
      localStorage.setItem("colorMode", "light");
      document.body.style.backgroundColor = "white";
    } else {
      localStorage.setItem("colorMode", "dark");
      document.body.style.backgroundColor = "black";
    }
  }

  // Al cargar la página, establece el modo de color según el valor almacenado en localStorage
  if (localStorage.getItem("colorMode") === "dark") {
    document.body.style.backgroundColor = "black";
  } else {
    document.body.style.backgroundColor = "white";
  }
</script>
