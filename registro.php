<?php  session_start();

    // Para que el usuario no pueda crear mas usuario
    if(isset($_SESSION['usuario'])){
        header('Location: index.php');
    }

    //Recibir los datos
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nombre = filter_var(strtolower($_POST['txtnombre']), FILTER_SANITIZE_STRING);
        $clave = $_POST['txtclave'];
        $clave2 = $_POST['txtclave2'];

        // contolar q los datos no vengan vacios 
        $errores = '';
        if(empty($nombre) or empty($clave) or empty($clave2)){
            $errores .='<li> Por favor rellenar todos los datos correctamente </li>';
        }else{
            try{
                $conexion = new PDO('mysql:host=localhost;dbname=login_practica;port=3307','root','');
            }catch(PDOException $e){
                echo "Error: " .$e->getMessage();
            }

            $statement = $conexion->prepare('SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1');
            $statement->execute(array(':usuario' => $nombre));
            $resultado = $statement->fetch();

            // Comprobar si usuario ya existe
            if($resultado != false){
                $errores .= '<li>El nombre de usuario ya existe</li>';
            }

            $clave = hash('sha512', $clave);
            $clave2 = hash('sha512', $clave2);

            if($clave != $clave2){
                $errores .= '<li> Las contrasenas no son iguales </li>';
            }

        }
            // Si no hay errores, se guarda el registro en la base

        if($errores == ''){
            $statement = $conexion->prepare('INSERT INTO usuarios () VALUES (null, :usuario, :pass)');
            $statement->execute(array(':usuario' => $nombre, ':pass' => $clave));  
    
            header('Location: login.php');
        }

    }

    require 'views/registro.view.php';

?>