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
        integrity="sha512-58P9Hy7II0YeXLv+iFiLCv1rtLW47xmiRpC1oFafeKNShp8V5bKV/ciVtYqbk2YfxXQMt58DjNfkXFOn62xE+g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="">
    <style>
        body {
            background-color: black;
        }
    </style>
</head>

<body>

    <div class="container fluid p-2">

        <!-- columna 1 fila 1 -->
        <nav class="navbar navbar-expand-lg navbar-light bg-warning" style="border-radius: 5px;">

            <div class="container-fluid">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                        Drop
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                        <li><a class="dropdown-item active" href="#">Categorias</a></li>
                    </ul>
                </div>
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
        <!-- fin columna 1 fila 1 -->

        <!-- columna 1 fila 2-->
        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 bg-danger d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <!-- columna 1 fila 2 -->


        <!-- columna 2 fila 2 -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 bg-danger d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
                <img src="" class="card-img-top" alt="...">
            </div>
        </div>
        <!-- columna 2 fila 2 -->

        <!-- columna 3 fila 2 -->
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 bg-danger d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
                <img src="" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text"></p>
                </div>
            </div>
        </div>
        <!-- columna 2 fila 2 -->

        <!-- columna 1 fila 3 -->
        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 bg-danger d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <!-- columna 1 fila 3 -->


        <!-- columna 2 fila 3 -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 bg-danger d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
                <img src="" class="card-img-top" alt="...">
            </div>
        </div>
        <!-- columna 2 fila 3 -->

        <!-- columna 2 fila 3 -->
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 bg-danger d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
                <img src="" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text"></p>
                </div>
            </div>
        </div>
        <!-- columna 2 fila 3 -->

        



