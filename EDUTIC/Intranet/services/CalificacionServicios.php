<?php

include 'MainService.php';

class CalificacionServicios extends MainService
{
    function periodo()
    {
        return $this->conexion->query("SELECT * FROM periodo_lectivo WHERE ESTADO = 'ACT'");
    }
    function docenteCalificacion($cod_docente)
    {
        return $this->conexion->query("SELECT asignatura.NOMBRE, asignatura.COD_NIVEL_EDUCATIVO, 
        asignatura.COD_ASIGNATURA,asignatura_periodo.COD_DOCENTE,asignatura_periodo.COD_PARALELO 
        FROM asignatura INNER JOIN asignatura_periodo 
        ON asignatura.COD_ASIGNATURA = asignatura_periodo.COD_ASIGNATURA 
        WHERE asignatura_periodo.COD_DOCENTE ='".$cod_docente."'");
    }
    function listarEstudiantes($cod_nivel_educativo)
    {
        return $this->conexion->query("SELECT persona.COD_PERSONA, persona.APELLIDO, persona.NOMBRE
                                       FROM persona 
                                       INNER JOIN matricula_periodo
                                       ON persona.COD_PERSONA = matricula_periodo.COD_ALUMNO
                                       WHERE matricula_periodo.COD_NIVEL_EDUCATIVO='".$cod_nivel_educativo."'");
    }
    function ingresarNotas($cod_periodo_lectivo,$cod_alumno,$cod_nivel_educativo,$cod_asignatura,$cod_paralelo,$cod_docente,$nota1,$nota2,$nota3)
    {
        echo("PROBANDO VALORES-->TENGO PERIODO-->".$cod_periodo_lectivo).'<br>';
        echo("TENGO ALUMNO-->".$cod_alumno).'<br>';
        echo("TENGO NIVEL-->".$cod_nivel_educativo).'<br>';
        echo("TENGO ASIGNATURA-->".$cod_asignatura).'<br>';
        echo("TENGO PARALELO-->".$cod_paralelo).'<br>';
        echo("TENGO DOCENTE-->".$cod_docente).'<br>';
        echo("TENGO NOTA-->".$nota1).'<br>';
        echo("TENGO NOTA-->".$nota2).'<br>';
        echo("TENGO NOTA-->".$nota3).'<br>';
        $stmt = $this->conexion->prepare("INSERT INTO alumno_asignatura_periodo (COD_PERIODO_LECTIVO,COD_ALUMNO,COD_NIVEL_EDUCATIVO,
                                                                                COD_ASIGNATURA,COD_PARALELO,COD_DOCENTE,NOTA1,NOTA2,NOTA3) 
                                          VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param('sisssisss',$cod_periodo_lectivo,$cod_alumno,$cod_nivel_educativo,$cod_asignatura,$cod_paralelo,$cod_docente,$nota1,$nota2,$nota3);
        $stmt->execute();
        $stmt->close();
    }
    function prueba($cod_periodo_lectivo,$cod_alumno,$cod_nivel_educativo,$cod_asignatura,$cod_paralelo,$cod_docente,$nota1,$nota2,$nota3)
    {
        echo("PROBANDO VALORES-->TENGO PERIODO-->".$cod_periodo_lectivo).'<br>';
        echo("TENGO ALUMNO-->".$cod_alumno).'<br>';
        echo("TENGO NIVEL-->".$cod_nivel_educativo).'<br>';
        echo("TENGO ASIGNATURA-->".$cod_asignatura).'<br>';
        echo("TENGO PARALELO-->".$cod_paralelo).'<br>';
        echo("TENGO DOCENTE-->".$cod_docente).'<br>';
        echo("TENGO NOTA-->".$nota1).'<br>';
        echo("TENGO NOTA-->".$nota2).'<br>';
        echo("TENGO NOTA-->".$nota3).'<br>';
        $stmt = $this->conexion->prepare("INSERT INTO alumno_asignatura_periodo (COD_PERIODO_LECTIVO,COD_ALUMNO,COD_NIVEL_EDUCATIVO,
                                                                                COD_ASIGNATURA,COD_PARALELO,COD_DOCENTE,NOTA1,NOTA2,NOTA3) 
                                          VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param('sisssisss',$cod_periodo_lectivo,$cod_alumno,$cod_nivel_educativo,$cod_asignatura,$cod_paralelo,$cod_docente,$nota1,$nota2,$nota3);
        $stmt->execute();
        $stmt->close();
    }
}

/**INSERT INTO `alumno_asignatura_periodo` (`COD_PERIODO_LECTIVO`, `COD_ALUMNO`, `COD_NIVEL_EDUCATIVO`, `COD_ASIGNATURA`,
 `COD_PARALELO`, `COD_DOCENTE`, `NOTA1`, `NOTA2`, `NOTA3`, `NOTA4`, `NOTA5`, `NOTA6`, `NOTA7`, `NOTA8`,
  `NOTA9`, `NOTA10`, `NOTA11`, `NOTA12`, `NOTA13`, `NOTA14`, `NOTA15`) 
  VALUES ('SEP20-JUL21', '8', 'TERCERO', 'ASBI01', 'TER - A', '6', '12', '11', '10', 
  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);**/