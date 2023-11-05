<?php

include_once "./model/user.php";

$user = new User();


if( isset($_SESSION['user']) ){
    $user->setUser($userSession->getCurrentUser());
    include_once './views/home.php';
    echo"sesion existe";
}
//SESIONES
else if( isset($_POST['correo']) && isset($_POST['password']) ){
    // echo "validacion de login";

    echo "iniciando sesion";

    $emailForm =  $_POST['correo'];
    $passwordForm = $_POST['password'];

    //INICIAR SESION
    if( $user -> userExist($emailForm, $passwordForm) ){
        $userSession->setCurrentUser($emailForm);
        $user->setUser($emailForm);

        include_once '.views/home.php';
    }
    else{
        // $errorLogin = "Nombre de usuario y/o contraseña incorrectos";
        // include_once './views/login.php';
        include_once "./views/login.php";
        echo 'No existe';
    }

}
else{
    include_once "./views/login.php";

}

?>

