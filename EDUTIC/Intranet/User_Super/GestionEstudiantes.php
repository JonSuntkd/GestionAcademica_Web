<?php

include '../services/PersonaServicios.php';
$persona = new PersonaServicios();
session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: ../../index.php');
    }
$tipo_persona="tipo_persona";
$estudiante="EST";
$representante="REP";

    if(isset($_POST['accion']) && ($_POST['accion']=='Añadir'))
    {
        //AÑADO REPRESENTANTE
        $persona->añadirPersonal($_POST['cedula_representante'],$_POST['apellido_representante'],$_POST['nombre_representante'],
                                 $_POST['direccion_representante'],$_POST['telefono_representante'],$_POST['fecha_nacimiento_representante'],
                                 $_POST['genero_representante'],$_POST['correo_ins_representante'],$_POST['correo_per_representante']);
        //REPRESENTANTE A TIPO PERSONA PERSONA
        $result = $persona->encontrarPersonal($_POST['cedula_representante']);
        if($result!=null)
        {
            $cod_representante = $result['COD_PERSONA'];
            $estado = "ACT";
            $fecha_inicio = "";
            $persona->añadirTipoPersonal($representante,$cod_representante,$estado,$fecha_inicio);
            $persona->añadirUsuario($result['COD_PERSONA'],$result['NOMBRE'],$result['APELLIDO'],$result['CEDULA'],$estado);
            $result3 = $persona->encontrarUsuario($cod_representante);
            if($result3!=null)
            {
                $cod_usuario = $result3['COD_USUARIO'];
                $estado3='ACT';
                $persona->añadirRolUsuario($representante,$cod_usuario,$estado);
            }
            //AÑADO ESTUDIANTE
            $persona->añadirEstudiante($cod_representante,$_POST['cedula_estudiante'],$_POST['apellido_estudiante'],$_POST['nombre_estudiante'],
            $_POST['direccion_estudiante'],$_POST['telefono_estudiante'],$_POST['fecha_nacimiento_estudiante'],
            $_POST['genero_estudiante'],$_POST['correo_ins_estudiante'],$_POST['correo_per_estudiante']);
        }
        //ESTUDIANTE A TIPO PERSONA PERSONA
        $result2 = $persona->encontrarPersonal($_POST['cedula_estudiante']);
        if($result2!=null)
        {
            $cod_estudiante=$result2['COD_PERSONA'];
            $estado_estudiante="ACT";
            $fecha_ini_estudiante="";
            $persona->añadirTipoPersonal($estudiante,$cod_estudiante,$estado_estudiante,$fecha_ini_estudiante);
            $persona->añadirUsuario($result2['COD_PERSONA'],$result2['NOMBRE'],$result2['APELLIDO'],$result2['CEDULA'],$estado);
            $result4 = $persona->encontrarUsuario($cod_estudiante);
            if($result4!=null)
            {
                $cod_usuario = $result4['COD_USUARIO'];
                $estado4='ACT';
                $persona->añadirRolUsuario($estudiante,$cod_usuario,$estado);
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Superusuario | Edutic</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="Shortcut Icon" type="image/x-icon" href="../../images/logolobo.png" />
    <script src="../js/sweet-alert.min.js"></script>
    <link rel="stylesheet" href="../css/sweet-alert.css">
    <link rel="stylesheet" href="../css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')</script>
    <script src="../js/modernizr.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../js/main.js"></script>
</head>
<body>
    <div class="navbar-lateral full-reset">
        <div class="visible-xs font-movile-menu mobile-menu-button"></div>
        <div class="full-reset container-menu-movile custom-scroll-containers">
            <div class="logo full-reset all-tittles">
                <i class="visible-xs zmdi zmdi-close pull-left mobile-menu-button" style="line-height: 55px; cursor: pointer; padding: 0 10px; margin-left: 7px;"></i> 
                EduTic
            </div>
            <div class="full-reset" style="background-color:#2B3D51; padding: 10px 0; color:#fff;">
                <figure>
                    <img src="../assets/img/logo.png" alt="Biblioteca" class="img-responsive center-box" style="width:55%;">
                </figure>
                <p class="text-center" style="padding-top: 15px;">Unidad Educativa "Oswaldo Guayasamin"</p>
            </div>
            <div class="full-reset nav-lateral-list-menu">
                <ul class="list-unstyled">
                    <li>
                        <div class="dropdown-menu-button"><i class="zmdi zmdi-account-circle zmdi-hc-fw"></i>&nbsp;&nbsp; Gestión de Personas<i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i></div>
                        <ul class="list-unstyled">
                            <li><a href="./GestionPersonal.php"><i class="zmdi zmdi-accounts zmdi-hc-fw"></i>&nbsp;&nbsp;
                                    Gestion Personal</a></li>
                            <li><a href="./GestionEstudiantes.php"><i class="zmdi zmdi-accounts zmdi-hc-fw"></i>&nbsp;&nbsp;
                                    Gestion Estudiantes</a></li>
                        </ul>
                    </li>
                    <li><a href="./GestionPersonaReporte.php">
                            <i class="zmdi zmdi-trending-up zmdi-hc-fw">
                            </i>&nbsp;&nbsp; Reportes Personas</a></li>
                    
                </ul>
            </div>
        </div>
    </div>
    <div class="content-page-container full-reset custom-scroll-containers">
        <nav class="navbar-user-top full-reset">
            <ul class="list-unstyled full-reset">
                <figure>
                   <img src="../assets/img/user01.png" alt="user-picture" class="img-responsive img-circle center-box">
                </figure>
                <li style="color:#fff; cursor:default;">
                    <span class="all-tittles">Super Usuario - <?php  echo $_SESSION['user']['NOMBRE_USUARIO']  ?></span>
                </li>
                <li  class="tooltips-general exit-system-button" data-href="../../LogOut.php" data-placement="bottom" title="Salir del sistema">
                    <i class="zmdi zmdi-power"></i>
                </li>
                <li  class="tooltips-general btn-help" data-placement="bottom" title="Ayuda">
                    <i class="zmdi zmdi-help-outline zmdi-hc-fw"></i>
                </li>
                <li class="mobile-menu-button visible-xs" style="float: left !important;">
                    <i class="zmdi zmdi-menu"></i>
                </li>
            </ul>
        </nav>
        <div class="container">
            <div class="page-header">
              <h1 class="all-tittles">EduTic <small>Gestión de Estudiantes y Representantes</small></h1>
            </div>
        </div>
        <div class="container-fluid">
            <ul class="nav nav-tabs nav-justified"  style="font-size: 37px;">
              <li role="presentation" class="active"><a href="#">Estudiantes y Representantes</a></li>
            </ul>
        </div>
        <div class="container-fluid"  style="margin: 50px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="../assets/img/user.png" alt="user" class="img-responsive center-box" style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Funcionalidad que permite gestionar los datos de los estudiantes y representantes de la Unidad Educativo Oswaldo Guayasamín.                
                </div>
            </div>
        </div>
    <form action="GestionEstudiantes.php" method="post" id="formaEstudiantes" name="formaEstudiantes">
        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue"><h1>Datos del Representante</h1></div>
                   <div class="row">
                        <div class="group-material col-md-4 mb-3">
                            <input type="text" class="material-control" placeholder="Cédula del Representante" required="" 
                                   data-toggle="tooltip" data-placement="top" title="Escriba la cédula del representante" 
                                   name="cedula_representante">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label for="cedula_representante" class="col-md-6">Cédula</label>
                        </div>
                        <div class="group-material col-md-4 mb-3">
                            <input type="text" class="material-control" placeholder="Apellidos del Representante" required="" 
                                   data-toggle="tooltip" data-placement="top" title="Escriba los apellidos del representante" 
                                   name="apellido_representante">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label for="apellido_representante" class="col-md-6">Apellidos</label>
                        </div>
                        <div class="group-material col-md-4 mb-3">
                            <input type="text" class="material-control" placeholder="Nombres del Representante" required="" 
                                   data-toggle="tooltip" data-placement="top" title="Escriba los Nombres del representante" 
                                   name="nombre_representante">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label for="nombre_representante" class="col-md-6">Nombres</label>
                        </div>
                   </div><br>
                   <div class="row">
                        <div class="group-material col-md-6 mb-3">
                            <input type="text" class="material-control" placeholder="Dirección del Representante" required="" 
                                   data-toggle="tooltip" data-placement="top" title="Escriba la dirección del representante" 
                                   name="direccion_representante">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label for="direccion_representante" class="col-md-6">Dirección</label>
                        </div>
                        <div class="group-material col-md-4 mb-3">
                            <input type="text" class="material-control" placeholder="Teléfono del Representante" required="" 
                                   data-toggle="tooltip" data-placement="top" title="Escriba la Teléfono del representante" 
                                   name="telefono_representante">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label for="telefono_representante" class="col-md-6">Teléfono</label>
                        </div>
                   </div><br>
                   <div class="row">
                        <div class="group-material col-md-4 mb-3">
                            <input type="date" class="material-control" placeholder="Fecha de nacimiento del Representante" required="" 
                                   data-toggle="tooltip" data-placement="top" title="Escriba la Fecha de nacimiento del representante" 
                                   name="fecha_nacimiento_representante" onchange="obtenerFecha(this)">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label for="fecha_nacimiento_representante" class="col-md-6">Fecha Nacimiento</label>
                        </div>
                        <div class="group-material col-md-4 mb-3">
                            <select name="genero_representante" class="material-control" data-toggle="tooltip" data-placement="top"
                                    data-original-title="Elige el género de la persona">
                                <option value="" disabled="" selected="">Selecciona el género</option>
                                <option value="MAS">Masculino</option>
                                <option value="FEM">Femenino</option>
                            </select>
                        </div>
                   </div><br>
                   <div class="row">
                        <div class="group-material col-md-4 mb-3">
                            <input type="email" class="material-control" placeholder="Correo Institucional" required="" 
                                   data-toggle="tooltip" data-placement="top" title="Escriba el correo institucional para el representante" 
                                   name="correo_ins_representante">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label for="correo_ins_representante" class="col-md-6">Correo</label>
                        </div>
                        <div class="group-material col-md-4 mb-3">
                            <input type="text" class="material-control" placeholder="Correo Personal del Representante" required="" 
                                   data-toggle="tooltip" data-placement="top" title="Escriba el correo personal del representante" 
                                   name="correo_per_representante">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label for="correo_per_representante" class="col-md-6">Correo Personal</label>
                        </div>
                   </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue"><h1>Datos del Estudiante</h1></div>
                   <div class="row">
                        <div class="group-material col-md-4 mb-3">
                            <input type="text" class="material-control" placeholder="Cédula del Estudiante" required="" 
                                   data-toggle="tooltip" data-placement="top" title="Escriba la cédula del Estudiante" 
                                   name="cedula_estudiante">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label for="cedula_estudiante" class="col-md-6">Cédula</label>
                        </div>
                        <div class="group-material col-md-4 mb-3">
                            <input type="text" class="material-control" placeholder="Apellidos del estudiante" required="" 
                                   data-toggle="tooltip" data-placement="top" title="Escriba los apellidos del estudiante" 
                                   name="apellido_estudiante">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label for="apellido_estudiante" class="col-md-6">Apellidos</label>
                        </div>
                        <div class="group-material col-md-4 mb-3">
                            <input type="text" class="material-control" placeholder="Nombres del estudiante" required="" 
                                   data-toggle="tooltip" data-placement="top" title="Escriba los Nombres del estudiante" 
                                   name="nombre_estudiante">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label for="nombre_estudiante" class="col-md-6">Nombres</label>
                        </div>
                   </div><br>
                   <div class="row">
                        <div class="group-material col-md-6 mb-3">
                            <input type="text" class="material-control" placeholder="Dirección del estudiante" required="" 
                                   data-toggle="tooltip" data-placement="top" title="Escriba la dirección del estudiante" 
                                   name="direccion_estudiante">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label for="direccion_estudiante" class="col-md-6">Dirección</label>
                        </div>
                        <div class="group-material col-md-4 mb-3">
                            <input type="text" class="material-control" placeholder="Teléfono del estudiante" required="" 
                                   data-toggle="tooltip" data-placement="top" title="Escriba la Teléfono del estudiante" 
                                   name="telefono_estudiante">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label for="telefono_estudiante" class="col-md-6">Teléfono</label>
                        </div>
                   </div><br>
                   <div class="row">
                        <div class="group-material col-md-4 mb-3">
                            <input type="date" class="material-control" placeholder="Fecha de nacimiento del estudiante" required="" 
                                   data-toggle="tooltip" data-placement="top" title="Escriba la Fecha de nacimiento del estudiante" 
                                   name="fecha_nacimiento_estudiante" onchange="obtenerFecha(this)">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label for="fecha_nacimiento_estudiante" class="col-md-6">Fecha Nacimiento</label>
                        </div>
                        <div class="group-material col-md-4 mb-3">
                            <select name="genero_estudiante" class="material-control" data-toggle="tooltip" data-placement="top"
                                    data-original-title="Elige el género de la persona">
                                <option value="" disabled="" selected="">Selecciona el género</option>
                                <option value="MAS">Masculino</option>
                                <option value="FEM">Femenino</option>
                            </select>
                        </div>
                   </div><br>
                   <div class="row">
                        <div class="group-material col-md-4 mb-3">
                            <input type="email" class="material-control" placeholder="Correo Institucional" required="" 
                                   data-toggle="tooltip" data-placement="top" title="Escriba el correo institucional para el estudiante" 
                                   name="correo_ins_estudiante">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label for="correo_ins_estudiante" class="col-md-6">Correo</label>
                        </div>
                        <div class="group-material col-md-4 mb-3">
                            <input type="text" class="material-control" placeholder="Correo Personal del estudiante" required="" 
                                   data-toggle="tooltip" data-placement="top" title="Escriba el correo personal del estudiante" 
                                   name="correo_per_estudiante">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label for="correo_per_estudiante" class="col-md-6">Correo Personal</label>
                        </div>
                   </div>
            </div>
        </div>
        <p class="text-center">
            <i class="zmdi zmdi-floppy"></i><input type="submit" name="accion" value="Añadir" class="btn btn-primary" style="margin-right: 20px;" >
            <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar</button>
        </p>
    </form>
        <div class="modal fade" tabindex="-1" role="dialog" id="ModalHelp">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title text-center all-tittles">ayuda del sistema</h4>
                  </div>
                  <div class="modal-body">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore dignissimos qui molestias ipsum officiis unde aliquid consequatur, accusamus delectus asperiores sunt. Quibusdam veniam ipsa accusamus error. Animi mollitia corporis iusto.
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="zmdi zmdi-thumb-up"></i> &nbsp; De acuerdo</button>
                  </div>
              </div>
            </div>
          </div>
          <footer class="footer full-reset">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-xs-12 col-sm-6">
                          <h4 class="all-tittles">Acerca de</h4>
                          <p>
                              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam quam dicta et, ipsum quo. Est saepe deserunt, adipisci eos id cum, ducimus rem, dolores enim laudantium eum repudiandae temporibus sapiente.
                          </p>
                      </div>
                      <div class="col-xs-12 col-sm-6">
                          <h4 class="all-tittles">Desarrollado por:</h4>
                          <ul class="list-unstyled">
                              <li><i class="zmdi zmdi-check zmdi-hc-fw"></i>&nbsp; EspeSoft <i class="zmdi zmdi-facebook zmdi-hc-fw footer-social"></i><i class="zmdi zmdi-twitter zmdi-hc-fw footer-social"></i></li>
                          </ul>
                      </div>
                  </div>
              </div>
              <div class="footer-copyright full-reset all-tittles">© 2020 EspeSoft</div>
          </footer>
      </div>
  </body>
  <script>

    function obtenerFecha(e)
    {
        var fecha = moment(e.value);
        return fecha.format("YYYY/MM/DD")
    }
</script>
  </html>