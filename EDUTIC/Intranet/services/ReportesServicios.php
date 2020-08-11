<?php

include 'MainService.php';

class ReporteServicios extends MainService
{

     function persona()
    {
        return $this->conexion->query("SELECT * FROM persona");
    }
    
    function periodo()
    {
        return $this->conexion->query("SELECT * FROM periodo_lectivo WHERE ESTADO = 'ACT'");
    }

    function matricula()
    {
        return $this->conexion->query("SELECT persona.APELLIDO, persona.NOMBRE, matricula_periodo.COD_NIVEL_EDUCATIVO, matricula_periodo.COD_PERIODO_LECTIVO 
                                        FROM persona 
                                        INNER JOIN matricula_periodo ON persona.COD_PERSONA = matricula_periodo.COD_ALUMNO");
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


    function mostrarAspiranteCalificacione()
    {
        return $this->conexion->query("SELECT DISTINCT aspirante.COD_ASPIRANTE, aspirante.COD_PERIODO_LECTIVO, 
        aspirante.COD_NIVEL_EDUCATIVO, aspirante.CEDULA, aspirante.APELLIDO, aspirante.NOMBRE, 
        aspirante.DIRECCION, aspirante.TELEFONO,aspirante.FECHA_NACIMIENTO, aspirante.GENERO, 
        aspirante.CORREO_PERSONAL, calificacion_prueba_aspirante.CALIFICACION, 
        calificacion_prueba_aspirante.ESTADO 
        FROM aspirante 
        INNER JOIN calificacion_prueba_aspirante 
        ON aspirante.COD_ASPIRANTE = calificacion_prueba_aspirante.COD_ASPIRANTE 
        WHERE calificacion_prueba_aspirante.ESTADO='APR'");
    }
    

    function mostrarniveleducativoAspirante($nombreEntidad)
    {
        return $this->conexion->query("SELECT * FROM ".$nombreEntidad);
    }



    //Aspirantes
    function insertarAspirantes($cod_aspirante,$cod_periodo_lectivo,$cod_nivel_educativo,$cedula,$apellido,$nombre,$direccion,$telefono,$fecha_nacimiento,$genero,$correo_personal)
    {
       
        $stmt = $this->conexion->prepare("INSERT INTO aspirante
        (COD_ASPIRANTE,COD_PERIODO_LECTIVO,COD_NIVEL_EDUCATIVO,
        CEDULA,APELLIDO,NOMBRE,DIRECCION,TELEFONO,FECHA_NACIMIENTO,
        GENERO,CORREO_PERSONAL) 
                                          VALUES (?,?,?,?,?,?,?,?,?,?,?)");

        $stmt->bind_param('sssssssssss',$cod_aspirante,$cod_periodo_lectivo,$cod_nivel_educativo,$cedula,$apellido,$nombre,$direccion,$telefono,$fecha_nacimiento,$genero,$correo_personal);
        
        $stmt->execute();
        $stmt->close();
    }
    





    function insertarNotasAspirantes($cod_aspirante,$nota2,$nota1)
    {
        
		$stmt = $this->conexion->prepare("INSERT INTO calificacion_prueba_aspirante (COD_ASPIRANTE,COD_NIVEL_EDUCATIVO, 
        CALIFICACION,ESTADO)
        VALUES (?,?,?,?)");
        
        if($nota1==0){
        $estado="";
        }
        else if($nota1>13){
            $estado="APR";
        } else {
            $estado="REP";
        }
        $stmt->bind_param('ssds',$cod_aspirante,$nota2,$nota1,$estado);
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
        $stmt = $this->conexion->prepare("DELETE FROM aspirante WHERE COD_ASPIRANTE=?");
        $stmt->bind_param('s',$codigo_aspirante);
        $stmt->execute();
        $stmt->close();
    }
    
}

?>