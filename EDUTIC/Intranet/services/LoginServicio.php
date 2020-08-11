<?php

include 'MainService.php';
class LoginServicio extends MainService {

    function login($userName, $password){

        $result = $this->conexion->query("SELECT * FROM USUARIO U, ROL_USUARIO R, PERSONA P, ROL S WHERE U.COD_USUARIO=R.COD_USUARIO AND S.COD_ROL=R.COD_ROL AND U.COD_PERSONA=P.COD_PERSONA AND U.NOMBRE_USUARIO='$userName' ");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['CLAVE'] == $password) {
                return $row;
            }else{
                header('Location: ./index.php?fallo=true');
            }
        }else{
            header('Location: ./index.php?row=true');
        }
        return null;
    }
}

?>