<html>

<body>
  <?php

  session_start();

  if (!isset($_SESSION['usuario'])) {
    header('Location: Login.php');
  } else {
    echo "Usuario autenticado como " . $_SESSION['usuario'];
  }


  ?>




  <ul>
    <li><a href=''>Alta Usuarios</a></li>
    <li><a href=''>Edición Usuarios</a></li>
    <li><a href=''>Busqueda Usuarios</a></li>

  </ul>



</body>

</html>