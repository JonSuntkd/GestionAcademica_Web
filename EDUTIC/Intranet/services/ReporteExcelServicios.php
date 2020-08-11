<?php

include 'MainService.php';

class ReporteExcelServicios extends MainService
{

    function persona()
    {
        return $this->conexion->query("SELECT * FROM persona");
    }

function docentes()
    {
        return $this->conexion->query("SELECT persona.APELLIDO, persona.NOMBRE, tipo_persona_persona.ESTADO, tipo_persona_persona.FECHA_INICIO, tipo_persona_persona.FECH_FIN 
        FROM persona 
        INNER JOIN tipo_persona_persona 
        ON persona.COD_PERSONA = tipo_persona_persona.COD_PERSONA 
        WHERE tipo_persona_persona.COD_TIPO_PERSONA='PRO'");
    }
    function alumnos()
    {
        return $this->conexion->query("SELECT persona.APELLIDO, persona.NOMBRE, tipo_persona_persona.ESTADO, tipo_persona_persona.FECHA_INICIO, tipo_persona_persona.FECH_FIN 
        FROM persona 
        INNER JOIN tipo_persona_persona 
        ON persona.COD_PERSONA = tipo_persona_persona.COD_PERSONA 
        WHERE tipo_persona_persona.COD_TIPO_PERSONA='EST'");
    }


    function administrativos()
    {
        return $this->conexion->query("SELECT persona.APELLIDO, persona.NOMBRE, tipo_persona_persona.ESTADO, tipo_persona_persona.FECHA_INICIO, tipo_persona_persona.FECH_FIN 
        FROM persona 
        INNER JOIN tipo_persona_persona 
        ON persona.COD_PERSONA = tipo_persona_persona.COD_PERSONA 
        WHERE tipo_persona_persona.COD_TIPO_PERSONA='ADM'");
    }

    function directivos()
    {
        return $this->conexion->query("SELECT persona.APELLIDO, persona.NOMBRE, tipo_persona_persona.ESTADO, tipo_persona_persona.FECHA_INICIO, tipo_persona_persona.FECH_FIN 
        FROM persona 
        INNER JOIN tipo_persona_persona 
        ON persona.COD_PERSONA = tipo_persona_persona.COD_PERSONA 
        WHERE tipo_persona_persona.COD_TIPO_PERSONA='DIR'");
    }



}
?>