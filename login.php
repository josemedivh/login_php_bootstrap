<?php session_start();

    // Comprovamos que este una session abierta
    if(isset($_SESSION['usuario'])){
        header('Location: index.php');
    }

    // Traemos los datos
    $errores = '';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $usuario = filter_var(strtolower($_POST['txtnombre']), FILTER_SANITIZE_STRING );
        $password = $_POST['txtclave'];
        $password = hash('sha512', $password);
    
        try {
            $conexion = new PDO('mysql:host=localhost;dbname=login_practica;port=3307', 'root', '');
        } catch (PDOException $e) {
            echo "Error:". $e->getMessage();;
        }

        $statement = $conexion->prepare('SELECT * FROM usuarios WHERE usuario = :usuario AND pass = :password ');

        $statement->execute(array(
            ':usuario' => $usuario,
            ':password' => $password
            
        ));

        //se crea la sesion si los datos son correctos
        $resultado = $statement->fetch();
        if($resultado !== false){
            $_SESSION['usuario'] = $usuario;
            header('Location: index.php');
        // echo "Datos Correctos";
        }else{
            $errores .= '<li> Datos Incorrectos </li>';
        }
    }
    require 'views/login.view.php';

?>