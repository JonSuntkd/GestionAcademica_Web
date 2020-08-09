<?php

include 'MainService.php';

class AsistenciasServicios extends MainService
{
    function periodo()
    {
        return $this->conexion->query("SELECT * FROM periodo_lectivo WHERE ESTADO = 'ACT'");
    }
    function docenteAsistencia($cod_docente)
    {
        return $this->conexion->query("SELECT asignatura.NOMBRE, asignatura.COD_NIVEL_EDUCATIVO, 
        asignatura.COD_ASIGNATURA,asignatura_periodo.COD_DOCENTE,asignatura_periodo.COD_PARALELO 
        FROM asignatura INNER JOIN asignatura_periodo 
        ON asignatura.COD_ASIGNATURA = asignatura_periodo.COD_ASIGNATURA 
        WHERE asignatura_periodo.COD_DOCENTE ='".$cod_docente."'");
    }
    function listarEstudiantes($cod_nivel_educativo)
    {
        //OJO PARA DISCRIMINAR POR PARALELOS EN CASO DE QUE SEA 2 CURSOS DE LOS MISMOS
        //EL JOIN CON LA TABLA ASIGNATURA PERIODO Y MATRICULA PERIODO TE SIRVE PERO HAY QUE VER
        //LA FORMA PARA QUE TRAIGA LOS DATOS DEL ESTUDIANTE
        return $this->conexion->query("SELECT persona.COD_PERSONA, persona.APELLIDO, persona.NOMBRE
                                       FROM persona 
                                       INNER JOIN matricula_periodo
                                       ON persona.COD_PERSONA = matricula_periodo.COD_ALUMNO
                                       WHERE matricula_periodo.COD_NIVEL_EDUCATIVO='".$cod_nivel_educativo."'");
    }
    function ingresarAsistencia($cod_periodo_lectivo,$cod_alumno,$cod_nivel_educativo,$fecha,$estado)
    {
        $stmt = $this->conexion->prepare("INSERT INTO asistencia_periodo (COD_PERIODO_LECTIVO,COD_ALUMNO,COD_NIVEL_EDUCATIVO, 
        FECHA,ESTADO)
        VALUES (?,?,?,?,?)");
        $stmt->bind_param('sisss',$cod_periodo_lectivo,$cod_alumno,$cod_nivel_educativo,$fecha,$estado);
        $stmt->execute();
        $stmt->close();
    }
}
