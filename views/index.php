<?php
session_start();

if (isset($_SESSION['logged_in']) &&  $_SESSION['logged_in'] === true) {
  // El usuario está autenticado
  $userId = $_SESSION['user_id'];
  $roleId = $_SESSION['role_id'];
  $nombre = $_SESSION['nombre'];
} else {


  header("Location: ../index.html");
  exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tienda de Videojuegos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/brands.min.css"
    integrity="sha512-58P9Hy7II0YeXLv+iFiLCv1rtLW47xmiRpC1oFafeKNShp8V5bKV/ciVbk2YfxXQMt58DjNfkXFOn62xE+g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    body {
      background-color: black;
    }

    .card {
      margin-bottom: 20px;
    }

    .container {
      padding-top: 20px;
    }

    /* Estilos personalizados para el formulario */
    .modal-content {
      background-color: #212529;
      color: #f8f9fa;
      border: 1px solid #495057;
    }

    .modal-header {
      border-bottom: 1px solid #495057;
    }

    .modal-footer {
      border-top: 1px solid #495057;
    }

    .form-label {
      color: #f8f9fa;
      font-weight: bold;
    }

    .form-control {
      background-color: #343a40;
      border: 1px solid #495057;
      color: #f8f9fa;
    }

    .form-control:focus {
      background-color: #343a40;
      color: #f8f9fa;
      border-color: #ffc107;
      box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
    }

    .form-control::placeholder {
      color: #adb5bd;
    }

    .btn-primary {
      background-color: #ffc107;
      border-color: #ffc107;
      color: #212529;
    }

    .btn-primary:hover {
      background-color: #e0a800;
      border-color: #e0a800;
      color: #212529;
    }

    .btn-secondary {
      background-color: #6c757d;
      border-color: #6c757d;
    }

    .btn-close {
      filter: invert(1) grayscale(100%) brightness(200%);
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="mb-4">
      <a href="#" class="btn btn-warning" id="btnCrearJuego"><strong>Crear Juego</strong></a>
    </div>


    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="formModalLabel">Ingresa los datos</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <form id="formJuego">
              <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Juego</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
              </div>

              <div class="mb-3">
                <label for="precio" class="form-label">Precio Minimo</label>
                <input type="number" class="form-control" id="precio" name="precio" required>
              </div>

              <div class="mb-3">
                <label for="precioDescuento" class="form-label">Precio Maximo</label>
                <input type="number" class="form-control" id="precioDescuento" name="precioDescuento" required>
              </div>

              <div class="mb-3">
                <label for="imagen" class="form-label">URL de la Imagen</label>
                <input type="url" class="form-control" id="imagen" name="imagen" required
                  placeholder="https://ejemplo.com/imagen.jpg">
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Crear</button>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


    <div class="mt-4">
      <div class="row" id="contenedorJuegos">

      </div>
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"

    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

  <script>
    $(document).ready(function() {
      $('#btnCrearJuego').click(function() {
        $('#formModal').modal('show');
      });


      $('#formJuego').submit(function(e) {
        e.preventDefault();

        var nombre = $('#nombre').val();
        var precio = $('#precio').val();
        var precioDescuento = $('#precioDescuento').val();
        var imagen = $('#imagen').val();


        function formatearPrecio(precio) {
          return new Intl.NumberFormat('es-CL').format(precio);

        }


        var nuevaCard = `
        <div class="col-md-3 mb-4">
        <div class="card">
        
        <img src="${imagen}" class="card-img-top" alt="${nombre}">
          <div class="card-body text-center">
        
          <h5 class="card-title"><strong>${nombre}</strong></h5>
       
          <h6 class="card-subtitle mb-2"><strong>$${formatearPrecio(precioDescuento)}/$${formatearPrecio(precio)}</strong></h6>
         <a href="#" class="btn btn-warning"><strong>Comprar</strong></a>
       
         </div>
  </div>
          </div>
        `;

        $('#contenedorJuegos').append(nuevaCard);

        $('#formModal').modal('hide');



        $('#formJuego')[0].reset();
      });
    });
  </script>
</body>

</html>
<div class="container fluid p-2">


  <nav class="navbar navbar-expand-lg navbar-light bg-warning" style="border-radius: 5px;">

    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>


      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">

            <a class="nav-link active text-dark" aria-current="page" href="/"><strong>Home</strong></a>
          </li>
          <li class="nav-item">

            <a class="nav-link text-dark" href="#">Productos</a>
          </li>
          <li class="nav-item">

            <a class="nav-link text-dark" href="#">Registrarse</a>
          </li>
          <li class="nav-item">

            <a class="nav-link text-dark" href="#">El Contacto</a>
          </li>
          <li class="nav-item">

            <a class="nav-link" href="#">
              <img src="" alt="Carrito" style="width: 20px; height: 20px; margin-right: 5px;">

            </a>
          </li>

        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-dark" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <!-- columna 1 -->

  <!-- columna 2 -->
  <nav class="navbar navbar-expand-lg navbar-dark bg">
    <ul class="navbar-nav me-auto">
      <li class="nav-item">
        <a class="nav-link text-warning text-right" href="#" class="bar2"><strong>Iniciar Sesion</strong></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-warning" href="#"><strong>Registrarse</strong></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-warning text-right" href="#" class="bar2"><strong>Logout</strong></a>
      </li>
    </ul>
  </nav>
  <!-- columna 2 -->

  <!-- columna 3 -->
  <div class="bg-warning" style="border-radius: 5px;">
    <h3 class="text-center"><strong>¡Juegos Tendencia!</strong></h3>
  </div>
  <!-- columna 3 -->

  <!-- listar -->
  <?php
  /* incluir la base de datos */
  require_once '.backend/config.php';

  /* instanciar */
  $dbConfig = new DbConfig();
  $conn = $dbConfig->getConnection();

  /* conexcion con la tabla crud */
  $query = "SELECT * FROM crud";
  $statement = $conn->prepare($query);
  $statement->execute();
  $products = $statement->fetchAll(PDO::FETCH_ASSOC);

  ?>

  <thead class="bg-dark text-white">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Img</th>
      <th scope="col">Price</th>
    </tr>
  </thead>
  <tbody>
    <?php

    while ($datos = $product->fetch_object()) { ?>
      <tr>
        <th scope="row"><?php echo $datos->id_img ?> </th>
        <td>Call of Duty Black Ops 6</td>
      </tr>
    <?php }
    ?>

  </tbody>

  <div class="row">
    <div class="col-md-12">
      <div class="row">

        <div class="col-md-3 mb-2">
          <div class="card">
            <img src="https://i.ibb.co/h1K1knXk/IMG-20250326-112803.png" class="card-img-top" alt="">
            <div class="card-body text-center">
              <h5 class="card-title"><strong>$269,999/$380,399</strong></h5>
              <a href="#" class="btn btn-warning"><strong>Comprar</strong></a>
            </div>
          </div>
        </div>

        <div class="col-md-3 mb-2">
          <div class="card">
            <img src="https://i.ibb.co/fdSVqKCQ/IMG-20250326-112727.png" class="card-img-top" alt="...">
            <div class="card-body text-center">
              <h5 class="card-title"><strong>$239,000/$399,000</strong></h5>
              <a href="#" class="btn btn-warning"><strong>Comprar</strong></a>
            </div>
          </div>
        </div>

        <div class="col-md-3 mb-2">
          <div class="card">
            <img src="https://i.ibb.co/JZzS5n8/IMG-20250326-112833.png" class="card-img-top" alt="...">
            <div class="card-body text-center">
              <h5 class="card-title"><strong>$279,000/$359,000</strong></h5>
              <a href="#" class="btn btn-warning"><strong>Comprar</strong></a>
            </div>
          </div>
        </div>

        <div class="col-md-3 mb-2">
          <div class="card">
            <img src="https://i.ibb.co/4wBTVRHt/IMG-20250326-112939.png" class="card-img-top" alt="...">
            <div class="card-body text-center">
              <h5 class="card-title"><strong>$199,000/$274,620</strong></h5>
              <a href="#" class="btn btn-warning"><strong>Comprar</strong></a>
            </div>
          </div>
        </div>
        <!-- columna 4 -->

        <!-- columna 5 -->
        <div class="bg-warning" style="border-radius: 5px;">
          <h3 class="text-center"><strong>¡Mejores Ofertas Semanales!</strong></h3>
        </div>
        <!-- columna 5 -->

        <!-- columna 6 -->
        <div class="col-md-6 mb-4">
          <div class="card">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTgO42twrCMyvSLY-xISHJLhQhBBkhvyF9K9g&s " class="card-img-top" alt="...">
            <div class="card-body text-center">
              <p class="card-text"></p>
              <a href="#" class="btn btn-warning">Informacion</a>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4">
          <div class="card">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOI3Gf8TVzFcEeBRzEZXS0DneTyBaHjy2bDg&s" class="card-img-top" alt="...">
            <div class="card-body text-center">
              <p class="card-text"></p>
              <a href="#" class="btn btn-warning">Informacion</a>
            </div>
          </div>
        </div>
        <!-- columna 6 -->


      </div>
    </div>
  </div>
</div>

<!-- columna 7 -->
<div class="bg-warning p-3 text-center">
  <p><strong>Todos los derechos reservados</strong></p>
</div>
</div>
<!-- columna 7 -->





<script src="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/1.13.1/alertify.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/1.13.1/css/alertify.min.css">

</body>

</html>