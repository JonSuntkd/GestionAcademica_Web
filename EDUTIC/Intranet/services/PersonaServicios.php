<?php

include 'MainService.php';

class PersonaServicios extends MainService
{
    function mostrarTipoPersona($nombreEntidad)
    {
        return $this->conexion->query("SELECT * FROM ".$nombreEntidad);
    }

    function mostrarPersonaCedula($cedula)
    {
        return $this->conexion->query("SELECT * FROM persona WHERE CEDULA='".$cedula."'");
    }

    function mostrarPersonal($tipo_personal)
    {
        return $this->conexion->query("SELECT CEDULA,APELLIDO,NOMBRE,DIRECCION,TELEFONO,FECHA_NACIMIENTO,GENERO,CORREO,CORREO_PERSONAL
                                       FROM persona P, tipo_persona_persona T
                                       WHERE T.COD_PERSONA = P.COD_PERSONA
                                       AND T.COD_TIPO_PERSONA='".$tipo_personal."'");
    }
    
    //PERSONAL (Administrativo, Directivo, Docente)
    function añadirPersonal($cedula,$apellido,$nombre,$direccion,$telefono,$fecha_nacimiento,$genero,$correo,$correo_personal)
    {
        $stmt = $this->conexion->prepare("INSERT INTO persona (CEDULA,APELLIDO,NOMBRE,DIRECCION,TELEFONO,FECHA_NACIMIENTO,
                                                              GENERO,CORREO,CORREO_PERSONAL) 
                                          VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param('sssssssss',$cedula,$apellido,$nombre,$direccion,$telefono,$fecha_nacimiento,$genero,$correo,$correo_personal);
        $stmt->execute();
        $stmt->close();
    }
    function encontrarPersonal($cedula)
    {
        $result = $this->conexion->query("SELECT * FROM persona WHERE CEDULA='".$cedula."'");
        if($result->num_rows>0)
        {
            return $result->fetch_assoc();
        }
        else
        {
            return null;
        }
    }
    function añadirTipoPersonal($cod_tipo_persona,$cod_persona,$estado,$fecha_inicio)
    {
        $stmt = $this->conexion->prepare("INSERT INTO tipo_persona_persona(COD_TIPO_PERSONA,COD_PERSONA,ESTADO,
                                                                          FECHA_INICIO) 
                                          VALUES (?,?,?,NOW())");
        $stmt->bind_param('sis',$cod_tipo_persona,$cod_persona,$estado);
        $stmt->execute();
        $stmt->close();
    }

    //ESTUDIANTES Y REPRESENTANTES
    function añadirEstudiante($cod_representante,$cedula,$apellido,$nombre,$direccion,$telefono,$fecha_nacimiento,$genero,$correo,$correo_personal)
    {
        $stmt = $this->conexion->prepare("INSERT INTO persona (COD_PERSONA_REPRESENTANTE,CEDULA,APELLIDO,NOMBRE,DIRECCION,TELEFONO,FECHA_NACIMIENTO,
                                                              GENERO,CORREO,CORREO_PERSONAL) 
                                          VALUES (?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param('isssssssss',$cod_representante,$cedula,$apellido,$nombre,$direccion,$telefono,$fecha_nacimiento,$genero,$correo,$correo_personal);
        $stmt->execute();
        $stmt->close();
    }
}

?>