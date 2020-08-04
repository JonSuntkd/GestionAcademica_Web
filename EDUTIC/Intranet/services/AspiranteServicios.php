<?php

include 'MainService.php';

class AspiranteServicios extends MainService
{
    function mostrarAspirante($nombreEntidad)
    {
        return $this->conexion->query("SELECT * FROM ".$nombreEntidad);
    }

    function mostrarniveleducativoAspirante($nombreEntidad)
    {
        return $this->conexion->query("SELECT * FROM ".$nombreEntidad);
    }



    //Aspirantes
    function insertarAspirantes($cod_aspirante,$cedula,$apellido,$nombre,$direccion,$telefono,$fecha_nacimiento,$genero,$correo_personal)
    {
       
        $stmt = $this->conexion->prepare("INSERT INTO aspirante(COD_ASPIRANTE,CEDULA,APELLIDO,NOMBRE,DIRECCION,TELEFONO,FECHA_NACIMIENTO,GENERO,CORREO_PERSONAL) 
                                          VALUES (?,?,?,?,?,?,?,?,?)");

        $stmt->bind_param('sssssssss',$cod_aspirante,$cedula,$apellido,$nombre,$direccion,$telefono,$fecha_nacimiento,$genero,$correo_personal);
        $stmt->execute();
        $stmt->close();
    }
    


    
    function encontrarAspirante($codigo_edificio)
    {
        $result = $this->conexion->query("SELECT * FROM edificio WHERE COD_EDIFICIO='".$codigo_edificio."'");
        if($result->num_rows>0)
        {
            return $result->fetch_assoc();
        }
        else
        {
            return null;
        }
    }
    function modificarAspirante($cod_edificio, $cod_sede, $nombre, $cantidad_pisos, $cod_comparar)
    {
        $stmt = $this->conexion->prepare("UPDATE edificio SET COD_EDIFICIO=?,COD_SEDE=?,NOMBRE=?,CANTIDAD_PISOS=?
                                          WHERE COD_EDIFICIO=?");
        $stmt->bind_param('sssis' ,$cod_edificio,$cod_sede, $nombre, $cantidad_pisos, $cod_comparar);
        $stmt->execute();
        $stmt->close();
    }
    function eliminarAspirante($codigo_aspirante)
    {
        $stmt = $this->conexion->prepare("DELETE FROM ASPIRANTE WHERE COD_ASPIRANTE=?");
        $stmt->bind_param('s',$codigo_aspirante);
        $stmt->execute();
        $stmt->close();
    }
    
}

?>