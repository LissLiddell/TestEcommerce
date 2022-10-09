<?php
include_once("conexion.php");

$con = conect();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// var_dump($desarrollo);
$_SESSION = array();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>
<style>
    body {
        /* background: url("https://cdn.pixabay.com/photo/2017/10/10/16/55/halloween-2837936__340.png") no-repeat; */
        background-image: url('https://www.billin.net/blog/wp-content/uploads/2020/09/Clasificacio%CC%81n-de-las-empresas-1140x630.jpg');
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-size: cover;
        max-width: 100%;
        height: auto;
    }

    .form-control {
        width: 69%;
        height: 48px;
        font-size: 22px;
        border-radius: 8px;
    }

    .ms-5 {
        margin-left: 4rem !important;
    }

    /** */
    .neon {
        color: #fff;
        margin-top: 12%;
        text-shadow:
            0 0 5px rgba(0, 178, 255, 1),
            0 0 10px rgba(0, 178, 255, 1),
            0 0 20px rgba(0, 178, 255, 1),
            0 0 40px rgba(38, 104, 127, 1),
            0 0 80px rgba(38, 104, 127, 1),
            0 0 90px rgba(38, 104, 127, 1),
            0 0 100px rgba(38, 104, 127, 1),
            0 0 140px rgba(38, 104, 127, 1),
            0 0 180px rgba(38, 104, 127, 1);
    }

    p {
        font-weight: bold;
        text-align: center;
        text-transform: uppercase;
    }
</style>

<body>
    <div class="container-fluid">
        <!-- <img src="https://cdn.pixabay.com/photo/2021/02/03/00/10/receptionist-5975961__340.jpg" alt=""> -->
        <div class="row mt-5">
            <div class="col-4"></div>
            <div class="col-4" style="background-color: #f7f0f070; border-radius: 20px;">
                <form>
                    <div class="text-center">
                        <label for="" style="font-size: 31px; font-weight: bolder;">Bienvenido!</label>
                        <label style="font-size: larger; font-weight:bold;">Es necesario iniciar sesión para continuar</label>
                        <br>
                    </div>
                    <div class="mt-3 mb-3 text-justify-center">
                        <input type="email" class="form-control ms-5" id="usuario" placeholder="Email..." aria-describedby="emailHelp" name="usuario">
                    </div>
                    <div class="mb-3 input-group" id="show_hide_password">
                        <input type="password" placeholder="Password..." class="form-control ms-5" id="password" name="password" style="flex: .76 auto;  border-right-color: white;">
                        <div class="input-group-text" style=" background-color: white; border-top-right-radius: 7px; border-bottom-right-radius: 7px;">
                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true" style="color:#89929a; margin-top: 12px;"></i></a>
                        </div>
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="" id="error" class="ms-5" style="color:red; font-weight: 500;">Usuario/Password Incorrectos</label>
                        <span class="input-group-prepend bg-transparent iconover" style="height: 48px; border-top-right-radius: 15px; border-bottom-right-radius: 15px;">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary form-control ms-5" id="ingresar" /*data-bs-toggle="modal" data-bs-target="#staticBackdrop" * />Ingresar</button>
                    </div>
                    <div class="mb-3 text-center">
                        <label for="" style="font-weight: 700;">No tienes Cuenta? <a href="#"> Registrate!</a></label>
                    </div>
                    <br>
                </form>
            </div>
            <div class="col-4"></div>
        </div>


        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" style="background-color: #a70a0a;">
                <div class="modal-content" style="background-color: #a70a0a;">
                    <div class="modal-body">
                        <p style="font-size:9rem; -webkit-text-stroke: 2px #ff0f0f;" class="text-danger neon">ERROR</p>
                    </div>
                </div>
            </div>
        </div>
</body>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.13/jquery.mask.min.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    //test123
    
    
    $('#error').hide();
    $('#ingresar').click(function() {
        var usuario, password;
        usuario = $('#usuario').val();
        password = $('#password').val();
        $.ajax({
            type: 'POST',
            url: "ajax.php",
            data: {
                'op': 'AccesoBD',
                'usuario': usuario,
                'password': password
            },
            success: function(data) {
                console.log(data)
                var valores = $.parseJSON(data)
                if (valores.total == '1') {
                    window.location.replace("crud.php");
                } else {
                    $('#error').show();
                }
            },
            error: function() {
                alert('Algo salio Mal :(')
            }
        });
        return false;
    });

    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if ($('#show_hide_password input').attr("type") == "text") {
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass("fa-eye-slash");
            $('#show_hide_password i').removeClass("fa-eye");
        } else if ($('#show_hide_password input').attr("type") == "password") {
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass("fa-eye-slash");
            $('#show_hide_password i').addClass("fa-eye");
        }
    });

    const DBZ = {
        name: 'Cakaroto',
        alias: 'GokuPicoro',
        poder: 'Gencidama'
    }
    const {
        name,
        alias,
        poder
    } = DBZ
    //console.log(alias);


    /*var pedido = 25;
    pedido *= 2; 
    console.log(pedido);*/
</script>

</html>