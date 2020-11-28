<?php

class Usuario {

    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $rol;
    private $password;
    private $imagen;
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    function setId() {
        $this->id = $id;
    }

    function setNombre($nombre) {

        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setApellidos($apellidos) {

        $this->apellidos = $this->db->real_escape_string($apellidos);
    }

    function setEmail($email) {

        $this->email = $this->db->real_escape_string($email);
    }

    function setRol($rol) {

        $this->rol = $rol;
    }

    function setPassword($password) {

        $this->password = password_hash($this->db->real_escape_string($password), PASSWORD_BCRYPT, ['cost' => 4]);
    }

    function setImagen($imagen) {

        $this->imagen = $imagen;
    }

    function getId() {

        return $this->id;
    }

    function getNombre() {

        return $this->nombre;
    }

    function getApellidos() {

        return $this->apellidos;
    }

    function getEmail() {

        return $this->email;
    }

    function getPassword(){

        return $this->password;

        $result = false;
        if ($save) {

            $result = true;
        }
        return $result;
    }

    function getImagen() {

        return $this->imagen;
    }

    public function save() {
        $sql = "INSERT INTO usuarios VALUES(NULL, '{$this->getNombre()}', '{$this->getApellidos()}', '{$this->getEmail()}', '{$this->getPassword()}', 'user', NULL)"; 
        $save = $this->db->query($sql);
        
        $result = false;
        if($save){
            
            $result = true;
        }
        
        return $result;
    }
    
    public function login(){
        
        $result = false;
        $email = $this->getEmail();
        $password = $this->getPassword();
        
        //comprobar si existe el usuario
        
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $login = $this->db->query($sql);
        
        if($login && $login->num_rows == 1){
            
            $usuario = $login->fetch_object(); //para sacar el objeto que me devuelve la base de datos
            
            //verificar la contraseña
            
            $verify = password_verify($password, $usuario->password);
            
            if($verify){
                
                $result = $usuario;
            }
            
        }
        
        return $result;
    }

}
