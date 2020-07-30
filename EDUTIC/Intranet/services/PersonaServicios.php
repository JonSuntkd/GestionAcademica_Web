<?php

include 'MainService.php';

class PersonaServicios extends MainService
{
    function mostrarPersona($nombreEntidad)
    {
        return $this->conexion->query("SELECT * FROM ".$nombreEntidad);
    }
    //Personas
    function insertarPersona($cod_edificio,$cod_sede,$nombre,$cantidad_pisos)
    {
        $stmt = $this->conexion->prepare("INSERT INTO edificio(COD_EDIFICIO,COD_SEDE,NOMBRE,CANTIDAD_PISOS) 
                                          VALUES (?,?,?,?)");
        $stmt->bind_param('sssi',$cod_edificio,$cod_sede,$nombre,$cantidad_pisos);
        $stmt->execute();
        $stmt->close();
    }

    function modificarPersona($cod_aula, $cod_edificio, $nombre, $capacidad, $tipo, $piso)
    {
        $stmt = $this->conexion->prepare("UPDATE aula SET COD_AULA=?,COD_EDIFICIO=?,NOMBRE=?,CAPACIDAD=?,TIPO=?,PISO=?
                                          WHERE COD_AULA=?");
        $stmt->bind_param('sssisii',$cod_aula, $cod_edificio, $nombre, $capacidad, $tipo, $piso,$cod_aula);
        $stmt->execute();
        $stmt->close();
    }
    function eliminarPersona($codigo_aula)
    {
        $stmt = $this->conexion->prepare("DELETE FROM aula WHERE COD_AULA=?");
        $stmt->bind_param('s',$codigo_aula);
        $stmt->execute();
        $stmt->close();
    }
}

?>