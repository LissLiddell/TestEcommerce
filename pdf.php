<?php


include_once("conexion.php");
// include_once("ajax.php");
$con = conexion();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['Telefono'])) {
    header("Location: index.php");
}
$idUser = $_REQUEST['user_export'];
$con = mysqli_connect('localhost', 'root', '', 'empresa');
$sql = ("SELECT * FROM usuarios WHERE id = $idUser");
$result = mysqli_query($con, $sql);
$crow =  mysqli_fetch_array($result);
$id = $crow['Id'];
$email = $crow['email'];
$nombre = $crow['nombre'];
$apellidoPaterno = $crow['apellidoPaterno'];
$apellidoMaterno = $crow['apellidoMaterno'];
$email = $crow['email'];
$domicilio = $crow['domicilio'];
$imagen = base64_encode($crow['imagenuser']);
$nombreCompleto = $nombre . '  ' . $apellidoPaterno . ' ' . $apellidoMaterno;
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>

<body>
    <div class="row" style="width: 50%; margin: 0 auto;">
        <div class="" style="text-align: center;">
            <img id="imagen" class="zoom" src="data:image/png;base64,<?= $imagen ?>" style="width:250px; height:250px;" />
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <h5>Nombre:</h5>
                <label for=""><em id="viewname"><?= $nombreCompleto ?><em></label>
            </div>
            <div class="col-4" style="margin-left: 220px;">
                <h5>Email:</h5>
                <label for="" id="viewE"><em><?= $email ?></em></label>
            </div>
            <div class="col-4" style="margin-left: 450px;">
                <h5>Domicilio:</h5>
                <label for="" id="viewD"><em><?= $domicilio ?></em></label>
            </div>
        </div>
    </div>
    <!-- <div class="row" style="width: 50%; margin: 0 auto;">
        <div class="" style="text-align: center;">
            <img id="imagen" class="zoom" src="data:image/png;base64,<?= $imagen ?>" style="width:250px; height:250px;" />
        </div>
        <div class="mb-3 text-center">
            <h5>Nombre:</h5>
            <label for=""><em id="viewname"><?= $nombreCompleto ?><em></label>
        </div>
        <div class="col-4">
            <div class="mb-3 ms-5">
                <h5>Email:</h5>
                <label for="" id="viewE"><?= $email ?></label>
            </div>
        </div>
        <div class="col-4">
            <div class="mb-3">
                <h5>Domicilio:</h5>
                <label for="" id="viewD"><?= $domicilio ?></label>
            </div>
        </div>
    </div>  -->
</body>

</html>
<?php
$html = ob_get_clean();
// echo $html;
require_once 'library/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);
$dompdf->setPaper('letter');
$dompdf->render();
$dompdf->stream("personal.pdf", array("Attachment" => true));
?>