<?php

include 'MainService.php';
class LoginServicio extends MainService
{
    function login ($username,$password)
    {
        $result = $this->conexion->query("SELECT * FROM usuario WHERE username = '$username'");
        if($result->num_rows>0)
        {
            $row = $result->fetch_assoc();
            if($row['password']==$password)
            {
                return $row;
            }
        }
        else
        {
            return null;
        }
    }
}

?>