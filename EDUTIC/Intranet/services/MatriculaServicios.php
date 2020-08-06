<?php

include 'MainService.php';

class MatriculaServicios extends MainService
{
    function encontrarAlumno($cedula)
    {
        return $this->conexion->query("SELECT persona.COD_PERSONA,persona.DIRECCION, persona.NOMBRE, persona.APELLIDO
                                       FROM persona
                                       INNER JOIN tipo_persona_persona
                                       ON persona.COD_PERSONA = tipo_persona_persona.COD_PERSONA
                                       WHERE tipo_persona_persona.COD_TIPO_PERSONA='EST' AND persona.CEDULA='".$cedula."'");
    }
    function nivelesEducativos()
    {
        return $this->conexion->query("SELECT * FROM nivel_educativo ");   
    }


    function agregarMatricula($cod_periodo_lectivo,$cod_alumno,$cod_nivel_educativo)
    {
        $stmt = $this->conexion->prepare("INSERT INTO matricula_periodo (COD_PERIODO_LECTIVO,COD_ALUMNO,COD_NIVEL_EDUCATIVO) 
                                          VALUES (?,?,?)");
        $stmt->bind_param('sss',$cod_periodo_lectivo,$cod_alumno,$cod_nivel_educativo);
        $stmt->execute();
        $stmt->close();
    }
    function periodo()
    {
        return $this->conexion->query("SELECT * FROM periodo_lectivo WHERE ESTADO='ACT'");
    }

    function mostrarPeriodos()
    {
        return $this->conexion->query("SELECT * FROM periodo_lectivo ");
    }

    //PERIODO ACADEMICO
    function insertarPeriodo($cod_periodo_lectivo,$estado,$fecha_inicio,$fecha_fin)
    {
        $stmt = $this->conexion->prepare("INSERT INTO periodo_lectivo(COD_PERIODO_LECTIVO,ESTADO,FECHA_INICIO,FECHA_FIN) 
                                          VALUES (?,?,?,?)");
        $stmt->bind_param('ssss',$cod_periodo_lectivo,$estado,$fecha_inicio,$fecha_fin);
        $stmt->execute();
        $stmt->close();
    }

    //PARALELOS
    function insertarParalelo($cod_paralelo,$cod_nivel_educativo,$nombre)
    {
        $stmt = $this->conexion->prepare("INSERT INTO paralelo (COD_PARALELO,COD_NIVEL_EDUCATIVO,NOMBRE) 
                                          VALUES (?,?,?)");
        $stmt->bind_param('sss',$cod_paralelo,$cod_nivel_educativo,$nombre);
        $stmt->execute();
        $stmt->close();
    }

    //PERIODO CON EL RESTO DE DATOS
    
    function asignaturas($cod_nivel_educativo)
    {
        return $this->conexion->query("SELECT * FROM asignatura WHERE  COD_NIVEL_EDUCATIVO='".$cod_nivel_educativo."'");
    }
    function encontrarParalelo($cod_nivel_educativo)
    {
        return $this->conexion->query("SELECT * FROM paralelo WHERE  COD_NIVEL_EDUCATIVO='".$cod_nivel_educativo."'");
    }
    function encontrarAula()
    {
        return $this->conexion->query("SELECT * FROM aula");
    }
    function encontrarProfesor()
    {
        return $this->conexion->query("SELECT persona.COD_PERSONA, persona.NOMBRE, persona.APELLIDO
                                       FROM persona
                                       INNER JOIN tipo_persona_persona
                                       ON persona.COD_PERSONA = tipo_persona_persona.COD_PERSONA
                                       WHERE tipo_persona_persona.COD_TIPO_PERSONA='PRO'
                                       ORDER BY persona.APELLIDO");
    }

    //AGREGAR DATOS DEL PERIODO
    function agregarDatosPeriodo($cod_nivel_educativo,$cod_asignatura,$cod_periodo_lectivo,$cod_paralelo,$cod_docente,$cod_aula)
    {
        $stmt = $this->conexion->prepare("INSERT INTO asignatura_periodo (COD_NIVEL_EDUCATIVO,COD_ASIGNATURA,COD_PERIODO_LECTIVO,
                                                                          COD_PARALELO,COD_DOCENTE,COD_AULA) 
                                          VALUES (?,?,?,?,?,?)");
        $stmt->bind_param('ssssss',$cod_nivel_educativo,$cod_asignatura,$cod_periodo_lectivo,$cod_paralelo,$cod_docente,$cod_aula);
        $stmt->execute();
        $stmt->close();
    }
}

?>