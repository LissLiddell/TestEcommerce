<?php
include_once("conn.php");

$con = conect();
$business = new business;
//echo($_POST['op']);
switch ($_REQUEST['op']) {
    case 'AccesoBD':
        echo json_encode($business->AccessBDUser($_POST['usuario'], $_POST['password']));
        break;
    case 'GuardarUsuario':
        echo json_encode($business->SaveUserBD($_REQUEST));
        break;
    case 'MostrarDatos':
        echo json_encode($business->ShowDataDB($_POST['Id']));
        break;
    case 'EliminarUsuario':
        echo json_encode($business->DeleteUsesBD($_POST['Id']));
        break;
    case 'ListaUsuarios':
        echo json_encode($business->UserList());
        break;
    case 'ActualizarUsuario':
        echo json_encode($business->UpdateUserBD($_REQUEST));
        break;
    case 'SaveFile':
        echo json_encode($business->SaveFile($_FILES['file'], $_REQUEST['user_id']));
        break;
    case 'ExportUserPdf':
        echo json_encode($business->UserExportpdf($_POST['id']));
        break;
    case 'ShowInfo':
            echo ($business->ShowInfo($_POST['Id']));
            break;
    default:
        echo 'Error';
        break;
}

class Database
{
    public static function StartUp()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=emp;charset=utf8', 'root', '');
       // $pdo-&gt;setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        return $pdo;
    }
}
class User
{
    private $pdo;
    public $id;
    public $nombre;
    public $apellidoPaterno;
    public $apellidoMaterno;
    public $email;
    public $domicilio;
    public $password;
    public $imagenuser;

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Show()
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM usuarios  WHERE Estatus = 1");
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public  function Access($usuario, $password)
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT COUNT(*) total, CONCAT(nombre,' ',apellidopaterno) Nombre, Id FROM usuarios WHERE email = ? AND password = ? AND Estatus = 1");
            $stm->execute(array($usuario, $password));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function GetUser($id)
    {
        try {
            $stm = $this->pdo
                ->prepare("SELECT * FROM usuarios WHERE id = ?");


            $stm->execute(array($id));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function UpdateUser($data)
    {
        try {
            $sql = "UPDATE usuarios SET nombre = ?, apellidoPaterno = ?, 
						apellidoMaterno = ?, email = ?, domicilio  = ?
				    WHERE Id = ?";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        strtoupper($data->nombre),
                        strtoupper($data->apellidoPaterno),
                        strtoupper($data->apellidoMaterno),
                        strtolower($data->email),
                        strtoupper($data->domicilio),
                        $data->id
                    )
                );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function UpdateImg($imgContenido, $user_id)
    {
        $fp = fopen($imgContenido,'rb');
        try {
            $con = mysqli_connect('localhost', 'root', '', 'emp');
            $sql = "UPDATE usuarios SET  imagenuser  = :imagen WHERE Id = :userid";
            $sentencia = $this->pdo->prepare($sql);
            $sentencia->bindParam(":imagen", $fp, PDO::PARAM_LOB);  
            $sentencia->bindParam(":userid", $user_id, PDO::PARAM_INT);
            $sentencia->execute();
            // $sentencia->execute(['imagen'=>$imgContenido, 'userid'=>$user_id]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Delete($data)
    {
        try {
            $sql = "UPDATE usuarios SET Estatus = ? WHERE Id = ?";
            $this->pdo->prepare($sql)->execute( array(
                $data['Estatus'],  
                $data['Id']
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function InsertUser(User $data)
    {
        try {
            $sql = "INSERT INTO usuarios (nombre, apellidoPaterno ,apellidoMaterno, email, password, domicilio,codigopostal) 
		        VALUES (?, ?, ?, ?, ?, ?, ?)";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        strtoupper($data->nombre),
                        strtoupper($data->apellidoPaterno),
                        strtoupper($data->apellidoMaterno),
                        strtolower($data->email),
                        $data->password,
                        strtoupper($data->domicilio),
                        $data->codigopostal
                    )
                );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ImgUser($id)
    {
        try{
            $smt = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = ? ");
            $smt->execute(array($id));
            return $smt->fetch(PDO::FETCH_OBJ);

        }catch(Exception $e){
            die($e->getMessage());
        }
    }
}


class business
{
    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new User();
    }

    public function UserExportpdf($id)
    {
        $_SESSION['user_export'] = $id;
        return $id;
    }

    public function SaveFile($image, $user_id)
    {
        $revisar = getimagesize($_FILES["file"]["tmp_name"]);
        if ($revisar !== false) {
            $image = $_FILES['file']['tmp_name'];
            $this->model->UpdateImg($image, $user_id);
            return true;
        } else {
            return false;
        }
    }

    public function AccessBDUser($usuario, $password)
    {
        $total = 0;
        $nombre = "";
        $id = 0;
        $r = $this->model->Access($usuario, $password); 
        $total  = $r->total;
        $nombre =  $r->Nombre;
        $id = $r->Id;

        if ($total == 1) {
            session_start();
            $_SESSION['Telefono'] = '3461006083';
            $_SESSION['user']['cuenta'] = $nombre;
            $_SESSION['user_export'] = 0;
            $_SESSION['Id'] = $id;
            return $r;
        }else{
            return 'Algo salio mal';
        }
       
    }

    public function SaveUserBD($form)
    {
        $ConfirmarEmail =  (filter_var($form['email'], FILTER_VALIDATE_EMAIL) ? 1 : 2).PHP_EOL;
        //return false;
        if ($form['nombre'] == "") {
            return "NOMBRE";
        }

        if ($form['apellidoPaterno'] == "") {
            return "APELLIDO PATERNO";
        }

        if ($form['apellidoMaterno'] == "") {
            return "APELLIDO MATERNO";
        }

        if ($form['email'] == "" || $ConfirmarEmail == 2) {
            return "EMAIL";
        }

        if ($form['password'] == "") {
            return "CONTRASEÑA";
        }

        if ($form['domicilio'] == "") {
            return "DOMICILIO";
        }
        if ($form['codigopostal'] == "") {
            return "CODIGOPOSTAL";
        }

        $usuario = new User();
        $usuario->nombre = $form['nombre'];
        $usuario->apellidoPaterno = $form['apellidoPaterno'];
        $usuario->apellidoMaterno = $form['apellidoMaterno'];
        $usuario->email = $form['email'];
        $usuario->password = $form['password'];
        $usuario->domicilio = $form['domicilio'];
        $usuario->codigopostal = $form['codigopostal'];
        $this->model->InsertUser($usuario);
        return true;
    }

    public function DeleteUsesBD($id)
    {
        $valores = ["Estatus" => 2, "Id"=>$id];
        $this->model->Delete($valores);
        return true;
    }

    public function ShowDataDB($id)
    {
        $usuario = new User();
        $usuario = $this->model->GetUser($id);
        $id = $usuario->Id;
        $email = $usuario->email;
        $nombre = $usuario->nombre;
        $apellidoPaterno = $usuario->apellidoPaterno;;
        $apellidoMaterno = $usuario->apellidoMaterno;;
        $domicilio = $usuario->domicilio;
        $imagen = base64_encode($usuario->imagenuser);
        $array = [$id, $email, $nombre, $apellidoPaterno, $apellidoMaterno, $email, $domicilio, $imagen];
        return $array;
    }

    public function UpdateUserBD($form)
    {
        $ConfirmarEmail =  (filter_var($form['aemail'], FILTER_VALIDATE_EMAIL) ? 1 : 2).PHP_EOL;
        if ($form['anombre'] == "") {
            return 'NOMBRE';
        }
        if ($form['aapellidoPaterno'] == "") {
            return 'APELLIDO PATERNO';
        }
        if ($form['aapellidoMaterno'] == "") {
            return 'APELLIDO MATERNO';
        }
        if ($form['aemail'] == "" || $ConfirmarEmail ==2 ) {
            return 'EMAIL';
        }
        if ($form['adomicilio'] == "") {
            return 'DOMICILIO';
        }
      
        $user = new User();
        $user->nombre = $form['anombre'];
        $user->apellidoPaterno = $form['aapellidoPaterno'];
        $user->apellidoMaterno = $form['aapellidoMaterno'];
        $user->email = $form['aemail'];
        $user->domicilio = $form['adomicilio'];
        $user->id = $form['id'];
        $this->model->UpdateUser($user);
        return true;
    }

    public function UserList()
    {
        $values = [];
        foreach ($this->model->Show() as $r) {
            $valores = ["Id" => $r->id, "nombre" => $r->nombre, "apellidoPaterno" => $r->apellidoPaterno, "apellidoMaterno" => $r->apellidoMaterno, "email" => $r->email, "domicilio" => $r->domicilio];
            array_push($values, $valores);
        }
        return $values;
    }

    public function ShowInfo($id)
    {
        $uva  = $this->model->ImgUser($id);
        $imagen =  base64_encode($uva->imagenuser);
        return $imagen;
    }
}

