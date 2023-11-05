<?php
include_once 'db.php';


class User extends Database{

    //LOGEAR USUARIO

    private $correoUser;
    private $userName;
    private $userId;

    public function userExist( $correo, $psw ){
        $query = $this->StartUp()->prepare('SELECT * FROM usuarios WHERE correo = :correo AND psw = :psw ');
        $query->execute( ['correo' => $correo, 'psw'=> $psw] );

        if($query->rowCount()){
            return true;
        }
        else{
            return false;
        }

    }

    public function setUser( $correo ){
        $query = $this->StartUp()->prepare( 'SELECT * FROM usuarios WHERE correo = :correo ; ' );
        $query->execute( ['correo' => $correo] );

        foreach ($query as $currentUser) {
            $this->correoUser = $currentUser['correo'];
            $this->userName = $currentUser['nombre_usuario'];
            $this->userId = $currentUser['id'];
        }
    }

    public function getcorreo(){
        return $this->correoUser;
    }

    public function getId( $correo ){
        $query = $this->StartUp()->prepare( 'SELECT * FROM usuarios WHERE correo = :correo ; ' );
        $query->execute( ['correo' => $correo] );

        foreach ($query as $currentUser) {
            return $this->userId = $currentUser['id'];
        }
    }



    //CREAR USUARIO
    public function createUser( $correo, $password, $nombre, $imgPath ){

        $query = $this->StartUp()->prepare(
            'INSERT INTO usuarios (correo, password, nombre, imgPath )
            VALUES ( :correo , :password , :nombre, :imgPath );'
        );
        $query->execute( [
            'correo' => $correo,
            'password' => $password,
            'nombre' => $nombre,
            'imgPath' => $imgPath
        ] );
        
        }

}

