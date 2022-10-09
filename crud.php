<?php
include_once("conn.php");
//include_once("index.php");
$con = conect();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['Telefono'])) {
    header("Location: index.php");
}

$expiry = 1800; //session expiry required after 10 mins
if (isset($_SESSION['LAST']) && (time() - $_SESSION['LAST'] > $expiry)) {
    session_unset();
    session_destroy();
    header("Location: index.php");
}
$_SESSION['LAST'] = time();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" rel="stylesheet" />

    <!-- Include Slick Theme CSS library -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" rel="stylesheet" />

    <!-- Include EasyZoom CSS library -->
    <link rel="stylesheet" href="css/empresa.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light bg-info">
                <div class="container-fluid">
                    <input type="hidden" id="ValIdUser" value="<?= $_SESSION['Id'] ?>">
                    <!-- <img src="" alt="" id="ImgUser" width="84px"> -->
                    <!-- <a class="navbar-brand" href="#">Navbar</a> -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        </ul>
                        <div class="row">
                            <div class="col-auto">
                                <img style="width:100%; max-width:40px; margin-top: 3px;" class="rounded-circle" src="img/login.png" alt="User Avatar" class="rounded img-size-30">
                            </div>
                            <div class="col">
                                <span class="name-user" style="text-transform: uppercase;color:white;font-size: small;"><b><?= $_SESSION['user']['cuenta']; ?></b></span> <br>
                                <a href="index.php" class="text-light" id="CerrarSesion" style="font-size: large; color: white; text-decoration: none !important;">cerrar sesión</a>
                            </div>
                        </div>
                        <!-- <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form> -->
                    </div>
                </div>
            </nav>
        </div>
        <div class="row">
            <!-- <div class="col-2 sidebar">
                <nav id="sidebar" class="border-top">
                    <div class="sidebar-header">
                        <h5 style="font-family: 'Latin Modern Roman';font-style: italic;"><kbd>ctrl + s</kbd> HACKERS FOR HIRE</h5>
                    </div>

                    <ul class="list-unstyled components">
                        <p>Dummy Heading</p>
                        <li class="active">
                            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
                            <ul class="collapse list-unstyled" id="homeSubmenu">
                                <li>
                                    <a href="#">Home 1</a>
                                </li>
                                <li>
                                    <a href="#">Home 2</a>
                                </li>
                                <li>
                                    <a href="#">Home 3</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">About</a>
                        </li>
                        <li>
                            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
                            <ul class="collapse list-unstyled" id="pageSubmenu">
                                <li>
                                    <a href="#">Page 1</a>
                                </li>
                                <li>
                                    <a href="#">Page 2</a>
                                </li>
                                <li>
                                    <a href="#">Page 3</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Portfolio</a>
                        </li>
                        <li>
                            <a href="#">Contact</a>
                        </li>
                    </ul>
                </nav>
            </div> -->
            <center>
                <div class="col-md-10">
                    <center class="mt-5">
                        <a href="#" type="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregardatos">
                            <h5>
                                Agregar Datos de Usuario
                            </h5>
                        </a>
                    </center>
                    <div class="row justify-content-between">
                        <div class="col-md-11 mt-4" style="background-color:#edeaea; border-radius: 20px;">
                            <center>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Domicilio</th>
                                            <th scope="col">Ver</th>
                                            <th scope="col">Editar</th>
                                            <th scope="col">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyInformativo">
                                    </tbody>
                                </table>
                            </center>
                        </div>
                    </div>
                </div>
            </center>
        </div>
    </div>

    <div class="modal modal-xl " id="agregardatos" tabindex="-1" aria-labelledby="agregardatos" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="agregardatos">Usuario Nuevo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formNuevoEmpleado" method="POST">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <h5>Nombre:</h5>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                    <label for="" style="color:red; font-size: 13px;" id="errorname">Favor de ingresar el nombre</label>
                                    <input type="hidden" name="op" value="GuardarUsuario">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <h5>Apellido Paterno:</h5>
                                    <input type="text" class="form-control" id="apellidoPaterno" name="apellidoPaterno" required>
                                    <label for="" style="color:red; font-size: 13px;" id="errorAP">Favor de ingresar el Apellido Paterno</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <h5>Apellido Materno:</h5>
                                    <input type="text" class="form-control" id="apellidoMaterno" name="apellidoMaterno" required>
                                    <label for="" style="color:red; font-size: 13px;" id="errorAM">Favor de ingresar el Apellido Materno</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <h5>Ingresa tu email:</h5>
                                    <input type="email" class="form-control" id="email" name="email" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" required>
                                    <label for="" style="color:red; font-size: 13px;" id="errorE">Favor de ingresar el Email</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <h5>Domicilio:</h5>
                                    <input type="text" class="form-control" id="domicilio" name="domicilio" required>
                                    <label for="" style="color:red; font-size: 13px;" id="errorD">Favor de ingresar el Domicilio</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <h5>Contraseña:</h5>
                                    <input type="text" class="form-control" id="password" name="password" required>
                                    <label for="" style="color:red; font-size: 13px;" id="errorC">Favor de ingresar la Contraseña</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <h5>Codigo postal:</h5>
                                    <input type="text" class="form-control" id="codigopostal" maxlength="5" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Código Postal" onchange="try{setCustomValidity('')}catch(e){}" oninvalid="this.setCustomValidity('Código postal inválido')" name="codigopostal" required>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button class="btn btn-primary" id="Guardar">Guardar</button>
                        <!-- <input type="button" class="btn btn-primary" value="Guardar" id="Guardar"> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal modal-xl " id="editardatos" tabindex="-1" aria-labelledby="editardatos" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="agregardatos">Actualizar a: </h5>
                    <h5 class="modal-title ms-2" id="NombreUser"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formActEmpleado">
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <h5>Ingresa Nombre:</h5>
                                    <input type="text" class="form-control" id="anombre" name="anombre">
                                    <label for="" style="color:red; font-size: 13px;" id="erroraname">Favor de ingresar el nombre</label>
                                    <input type="hidden" name="op" value="ActualizarUsuario">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <h5>Apellido Paterno:</h5>
                                    <input type="text" class="form-control" id="aapellidoPaterno" name="aapellidoPaterno">
                                    <label for="" style="color:red; font-size: 13px;" id="erroraAP">Favor de ingresar el Apellido Paterno</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <h5>Apellido Materno:</h5>
                                    <input type="text" class="form-control" id="aapellidoMaterno" name="aapellidoMaterno">
                                    <label for="" style="color:red; font-size: 13px;" id="erroraAM">Favor de ingresar el Apellido Materno</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <h5>Email:</h5>
                                    <input type="email" class="form-control" id="aemail" name="aemail" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}">
                                    <label for="" style="color:red; font-size: 13px;" id="erroraE">Favor de ingresar el Email</label>
                                    <input type="hidden" name="id" id="id">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <h5>Domicilio:</h5>
                                    <input type="text" class="form-control" id="adomicilio" name="adomicilio">
                                    <label for="" style="color:red; font-size: 13px;" id="erroraD">Favor de ingresar el Domicilio</label>
                                </div>
                            </div>
                            <div class="col-4" id="CHECKSUSER">
                                <h5>Actualizar Imagen</h5>
                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="CargarImagen">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Si
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="NoCargarImagen" checked>
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4" id="fileUser">
                                <div class="mb-3">
                                    <h5>Imagen de Usuario:</h5>
                                    <input type="hidden" id="ExisteImage">
                                    <input type="file" class="form-control" id="imagenuser" name="imagenuser">
                                    <label for="" style="color:red; font-size: 13px;" id="errorF">Favor de ingresar la Imagen</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="editar">Editar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-xl " id="viewinfo" tabindex="-1" aria-labelledby="viewinfo" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <a href="" class="btn btn-danger" target="_blank" id="exportarpdf" data-toggle="tooltip" title="Exportar a PDF"><i class="far fa-file-pdf"></i></a>
                    <input type="hidden" id="UserExportpdf" value="">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="centrador text-center ez-slider">
                        <!-- <img src="img/hack.png" alt="" class="zoom"> -->
                        <!-- <img id="imagen" src="https://s-media-cache-ak0.pinimg.com/736x/c4/76/27/c476278504682e622fabe9b0932098c3.jpg"> -->
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3 text-center">
                                <h5>Nombre:</h5>
                                <label for=""><em id="viewname"><em></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <h5>Email:</h5>
                                <label for="" id="viewE"></label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <h5>Domicilio:</h5>
                                <label for="" id="viewD"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-1"></div>
        <div class="col-10" style="background-color: gray;">

        </div>
        <div class="col-1"></div>
    </div>
</body>
<label for="" class=""></label>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.13/jquery.mask.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/empresa.js"></script>
<script>

    $('#Guardar').click(function(e) {
        e.preventDefault();
        var val = $('#codigopostal').val();
        var patronCP = /(^([0-9]{5,5})|^)$/;
        var codigopostal = document.getElementById("codigopostal");
        if (!(patronCP.test(val)) || val == "") {
            console.log('si esta entrando')
            codigopostal.setCustomValidity('Código postal inválido');
            $(this).text('Guardar');
            return false;
        }
    });

    // button.addEventListener('click', (event) => {
    //     event.preventDefault();
    //     var val = $('#codigopostal').val();
    //     var patronCP = /(^([0-9]{5,5})|^)$/;
    //     var codigopostal = document.getElementById("codigopostal");
    //     if (!(patronCP.test(val)) || form['codigopostal'] == "") {
    //         //console.log(form)
    //         codigopostal.setCustomValidity('Código postal inválido');
    //         $(this).text('Guardar');
    //         return false;
    //     }
    //     event.preventDefault();
    // });
</script>

</html>