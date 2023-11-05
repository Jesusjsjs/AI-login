<?php
echo"create user";


include_once "./model/user.php";

$usuarioElements = new User();

//Comprobar que todos los datos para crear un usuario lleguen
if( isset($_POST['correo']) && isset($_POST['nombre']) && isset($_POST['password']) && !empty($_FILES['imageUser']['name'])){


    //Area de imgs
    $carpetaDestinoPath = './public/img/imgUsers/';
    $imagenUsuario = $_FILES['imageUser']['tmp_name'];
    $nuevoImagenMainNombre = uniqid( 'IMG_', true );
    $destinoImagen = $carpetaDestinoPath . $nuevoImagenMainNombre;
    move_uploaded_file($imagenUsuario, $destinoImagen);


    //Guardar datos del usuario
    $correoForm =  $_POST['correo'];
    $passwordForm = $_POST['password'];
    $nombreForm = $_POST['nombre_usuario'];
    //Usamos nuestro objeto para crea al usuario
    $usuarioElements->createUser( $correoForm, $passwordForm, $nombreForm, $destinoImagen  ); 


}