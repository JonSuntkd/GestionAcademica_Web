<?php

include 'MainService.php';

class PlanificacionServicios extends MainService
{
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
    function encontrarPeriodo($codigo_periodo)
    {
        $result = $this->conexion->query("SELECT * FROM periodo_lectivo WHERE COD_PERIODO_LECTIVO='".$codigo_periodo."'");
        if($result->num_rows>0)
        {
            return $result->fetch_assoc();
        }
        else
        {
            return null;
        }
    }
    function modificarPeriodo($cod_periodo_lectivo, $estado, $fecha_inicio, $fecha_fin, $cod_comparar)
    {
        $stmt = $this->conexion->prepare("UPDATE periodo_lectivo SET COD_PERIODO_LECTIVO=?,ESTADO=?,FECHA_INICIO=?,FECHA_FIN=?
                                          WHERE COD_PERIODO_LECTIVO=?");
        $stmt->bind_param('sssss' ,$cod_periodo_lectivo, $estado, $fecha_inicio, $fecha_fin, $cod_comparar);
        $stmt->execute();
        $stmt->close();
    }
    function eliminarPeriodo($codigo_periodo)
    {
        $stmt = $this->conexion->prepare("DELETE FROM periodo_lectivo WHERE COD_PERIODO_LECTIVO=?");
        $stmt->bind_param('s',$codigo_periodo);
        $stmt->execute();
        $stmt->close();
    }

    //PARALELOS
    function mostrarParalelos()
    {
        return $this->conexion->query("SELECT * FROM paralelo");
    }
    function insertarParalelo($cod_paralelo,$cod_nivel_educativo,$nombre)
    {
        $stmt = $this->conexion->prepare("INSERT INTO paralelo (COD_PARALELO,COD_NIVEL_EDUCATIVO,NOMBRE) 
                                          VALUES (?,?,?)");
        $stmt->bind_param('sss',$cod_paralelo,$cod_nivel_educativo,$nombre);
        $stmt->execute();
        $stmt->close();
    }

    //PERIODO CON EL RESTO DE DATOS
    function nivelesEducativos()
    {
        return $this->conexion->query("SELECT * FROM nivel_educativo ");   
    }
    function asignaturas($cod_nivel_educativo)
    {
        return $this->conexion->query("SELECT * FROM asignatura WHERE  COD_NIVEL_EDUCATIVO='".$cod_nivel_educativo."'");
    }
    function periodo()
    {
        return $this->conexion->query("SELECT * FROM periodo_lectivo");
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

    //CONTAR TOTAL PERSONAS
    function contar($tipo_persona)
    {
        return $this->conexion->query("SELECT COUNT(*) FROM tipo_persona_persona WHERE COD_TIPO_PERSONA = '".$tipo_persona."'");
    }

    //TABLA PLANIFICACION
    function mostrarPlanificacion($cod_nivel_educativo,$cod_periodo_lectivo)
    {
        return $this->conexion->query("SELECT asignatura_periodo.COD_NIVEL_EDUCATIVO,nivel_educativo.NOMBRE as NIVEL, asignatura.NOMBRE as ASIGNATURA, asignatura_periodo.COD_PERIODO_LECTIVO, paralelo.NOMBRE as PARALELO, persona.NOMBRE, persona.APELLIDO,aula.COD_AULA
        FROM asignatura_periodo
        INNER JOIN nivel_educativo ON nivel_educativo.COD_NIVEL_EDUCATIVO = asignatura_periodo.COD_NIVEL_EDUCATIVO
        INNER JOIN asignatura ON asignatura.COD_ASIGNATURA = asignatura_periodo.COD_ASIGNATURA
        INNER JOIN paralelo ON paralelo.COD_PARALELO = asignatura_periodo.COD_PARALELO
        INNER JOIN persona ON persona.COD_PERSONA = asignatura_periodo.COD_DOCENTE
        INNER JOIN aula ON aula.COD_AULA = asignatura_periodo.COD_AULA
        WHERE asignatura_periodo.COD_NIVEL_EDUCATIVO='".$cod_nivel_educativo."' AND asignatura_periodo.COD_PERIODO_LECTIVO='".$cod_periodo_lectivo."'");
    }
}

?>