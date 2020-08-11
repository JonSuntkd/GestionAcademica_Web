<?php

include 'MainService.php';

class RolServicios extends MainService
{
    function mostrarPersonaCedula($cedula)
    {
        return $this->conexion->query("SELECT * FROM persona WHERE CEDULA='".$cedula."'");
    }
    
    function buscaRepetido($user){
        $sql="SELECT * FROM usuario WHERE usuario= '.$user'";
        $result=mysql_query($sql);

        if(mysql_num_rows($result > 0)){
            return 1;
        }else{
            return 0;
        }

    }

    function ingresarRol($cod_usuario,$cod_persona,$user,$password,$estado)
    {
        if(buscaRepetido($user)==1){
            echo 2;
        }else{

            $stmt = $this->conexion->prepare("INSERT INTO usuario (COD_USUARIO,COD_PERSONA,NOMBRE_USUARIO, 
            CLAVE,ESTADO)
            VALUES (?,?,?,?,?)");
            $stmt->bind_param('sisss',$rol,$cod_persona,$user,$password,$estado);
            $stmt->execute();
            $stmt->close();
        }
    }
}
