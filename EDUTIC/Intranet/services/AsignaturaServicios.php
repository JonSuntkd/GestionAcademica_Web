<?php

include 'MainService.php';

class AsignaturaServicios extends MainService
{
    function mostrarAsignaturas($nivel)
    {
        return $this->conexion->query("SELECT * FROM asignatura WHERE COD_NIVEL_EDUCATIVO='".$nivel."'");
    }
    function insertarAsignatura($cod_nivel_educativo,$cod_asignatura,$nombre,$creditos,$tipo,$imagen)
    {
        $stmt = $this->conexion->prepare("INSERT INTO asignatura(COD_NIVEL_EDUCATIVO,COD_ASIGNATURA,NOMBRE,CREDITOS,TIPO,IMAGEN) 
                                          VALUES (?,?,?,?,?,?)");
        $stmt->bind_param('sssiss',$cod_nivel_educativo,$cod_asignatura,$nombre,$creditos,$tipo,$imagen);
        $stmt->execute();
        $stmt->close();
    }
    function encontrarAsignatura($codigo_asignatura)
    {
        $result = $this->conexion->query("SELECT * FROM asignatura WHERE COD_ASIGNATURA='".$codigo_asignatura."'");
        if($result->num_rows>0)
        {
            return $result->fetch_assoc();
        }
        else
        {
            return null;
        }
    }
    function modificarAsignatura($cod_nivel_educativo,$cod_asignatura,$nombre,$creditos,$tipo,$codigo_comparar,$imagen)
    {
        $stmt = $this->conexion->prepare("UPDATE asignatura SET COD_ASIGNATURA=?,NOMBRE=?,CREDITOS=?,TIPO=?,IMAGEN=?
                                          WHERE COD_ASIGNATURA=? AND COD_NIVEL_EDUCATIVO=?");
        $stmt->bind_param('ssissss' ,$cod_asignatura,$nombre,$creditos,$tipo,$imagen,$codigo_comparar,$cod_nivel_educativo);
        $stmt->execute();
        $stmt->close();
    }
    function eliminarAsignatura($cod_nivel_educativo,$codigo_asignatura)
    {
        $stmt = $this->conexion->prepare("DELETE FROM asignatura WHERE COD_ASIGNATURA=? AND COD_NIVEL_EDUCATIVO=?");
        $stmt->bind_param('ss',$codigo_asignatura,$cod_nivel_educativo);
        $stmt->execute();
        $stmt->close();
    }
    function eliminarAsignatura2($codigo_asignatura)
    {
        $stmt = $this->conexion->prepare("DELETE FROM asignatura WHERE COD_ASIGNATURA=?");
        $stmt->bind_param('s',$codigo_asignatura);
        $stmt->execute();
        $stmt->close();
    }
}

?>