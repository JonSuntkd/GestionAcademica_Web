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

    //USUARIOS
    function añadirUsuario ($cod_persona,$nombre,$apellido,$clave,$estado)
    {
        $estado='ACT';
        $intentos = 0;
        $result_explode=array_map('trim',explode(' ',$nombre));
        $primer_nombre = $result_explode[0];
        $result_explode = array_map('trim',explode(' ',$apellido));
        $primer_apellido = $result_explode[0];
        $usuario = $primer_nombre." ".$primer_apellido;
        $stmt= $this->conexion->prepare("INSERT INTO usuario (COD_PERSONA,NOMBRE_USUARIO,CLAVE,ESTADO,INTENTOS_FALLIDOS)
                                         VALUES (?,?,?,?,?)");
        $stmt->bind_param('isssi',$cod_persona,$usuario,$clave,$estado,$intentos);
        $stmt->execute();
        $stmt->close();
    }
    function encontrarUsuario($cod_persona)
    {
        $result = $this->conexion->query("SELECT * FROM usuario WHERE COD_PERSONA='".$cod_persona."'");
        if($result->num_rows>0)
        {
            return $result->fetch_assoc();
        }
        else
        {
            return null;
        }
    }
    function añadirRolUsuario($cod_rol,$cod_usuario,$estado)
    {
        $stmt = $this->conexion->prepare("INSERT INTO rol_usuario(COD_ROL,COD_USUARIO,ESTADO) 
                                          VALUES (?,?,?)");
        $stmt->bind_param('sis',$cod_rol,$cod_usuario,$estado);
        $stmt->execute();
        $stmt->close();
    }
}

?>