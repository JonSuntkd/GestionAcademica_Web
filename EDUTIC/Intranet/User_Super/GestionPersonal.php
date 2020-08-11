<?php

include '../services/PersonaServicios.php';
$persona = new PersonaServicios();
session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: ../../index.php');
    }
$tipo_persona="tipo_persona";

    if(isset($_POST['accion']) && ($_POST['accion']=='Añadir'))
    {
        $cod_tipo_persona = $_POST['cod_tipo_persona'];
        $persona->añadirPersonal($_POST['cedula'],$_POST['apellido'],$_POST['nombre'],
                                 $_POST['direccion'],$_POST['telefono'],$_POST['fecha_nacimiento'],
                                 $_POST['genero'],$_POST['correo'],$_POST['correo_personal']);
        
        $result = $persona->encontrarPersonal($_POST['cedula']);
        if($result!=null)
        {
            $cod_persona = $result['COD_PERSONA'];
            $estado = "ACT";
            $fecha_inicio = "";
            $persona->añadirTipoPersonal($cod_tipo_persona,$cod_persona,$estado,$fecha_inicio);
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
                    <li><a href="./GestionPersonaReporte.php"><i class="zmdi zmdi-trending-up zmdi-hc-fw"></i>&nbsp;&nbsp; Reportes de Personas</a></li>
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
                    <span class="all-tittles">Super Usuario <?php  echo $_SESSION['user']['NOMBRE_USUARIO']  ?></span>
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
              <h1 class="all-tittles">EduTic <small>Gestión de Personal</small></h1>
            </div>
        </div>
        <div class="container-fluid">
            <ul class="nav nav-tabs nav-justified"  style="font-size: 37px;">
              <li role="presentation" class="active"><a href="#">Personal Educativo</a></li>
            </ul>
        </div>
        <div class="container-fluid"  style="margin: 50px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="../assets/img/user.png" alt="user" class="img-responsive center-box" style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Funcionalidad que permite gestionar los datos del personal de la Unidad Educativo Oswaldo Guayasamín (Directivos, Administrativos, Docentes).                
                </div>
            </div>
        </div>
    <form action="GestionPersonal.php" method="post" id="formaPersonal" name="formaPersonal">
        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="page-header">
                    <h1 class="all-tittles"><small>Seleccion el tipo de persona a registrar</small></h1>
                </div>
                <div class="group-material">
                    <select name="cod_tipo_persona" class="material-control tooltips-general" data-toggle="tooltip" data-placement="top"
                            data-original-title="Elige el tipo de persona a registrar">
                        <option value="" disabled="" selected="">Selecciona un tipo de persona</option>
                        <option value="DIR">Directivo</option>
                        <option value="ADM">Administrativo</option>
                        <option value="PRO">Profesor</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue"><h1>Datos Personales</h1></div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Cédula de Identidad" required="" 
                                                   data-toggle="tooltip" data-placement="top" title="Escriba la cédula de la persona" 
                                                   name="cedula">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Cédula o Pasaporte</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Apellidos" required="" 
                                                   data-toggle="tooltip" data-placement="top" title="Escriba los apellidos de la persona" 
                                                   name="apellido">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Apellidos</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Nombres" required="" 
                                                   data-toggle="tooltip" data-placement="top" title="Escriba los nombres de la persona" 
                                                   name="nombre">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Nombres</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Dirección" required="" 
                                                   data-toggle="tooltip" data-placement="top" title="Escriba la dirección de la persona" 
                                                   name="direccion">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Dirección</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Teléfono" required="" 
                                                   data-toggle="tooltip" data-placement="top" title="Escriba el teléfono de la persona" 
                                                   name="telefono">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Teléfono</label>
                            </div>
                            <div class="group-material">
                                <input type="date" class="material-control tooltips-general" placeholder="Fecha de Nacimiento" required="" 
                                                   data-toggle="tooltip" data-placement="top" title="Escriba la fecha de nacimiento de la persona" 
                                                   name="fecha_nacimiento" onchange="obtenerFecha(this)">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Fecha de Nacimiento</label>
                            </div>
                            <div class="group-material">
                                <span style="color: #E34724;">Género</span>
                                <select name="genero" class="material-control tooltips-general" data-toggle="tooltip" data-placement="top"
                                data-original-title="Elige el género de la persona">
                                    <option value="" disabled="" selected="">Selecciona el género</option>
                                    <option value="MAS">Masculino</option>
                                    <option value="FEM">Femenino</option>
                                </select>
                            </div>
                            <div class="group-material">
                                <input type="email" class="material-control tooltips-general" placeholder="Correo Institucional" required="" 
                                                   data-toggle="tooltip" data-placement="top" title="Escriba el correo Institucional de la persona" 
                                                   name="correo">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Correo Institucional</label>
                            </div>
                            <div class="group-material">
                                <input type="email" class="material-control tooltips-general" placeholder="Correo Personal" required="" 
                                                   data-toggle="tooltip" data-placement="top" title="Escriba el correo Personal de la persona" 
                                                   name="correo_personal">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Correo Personal</label>
                            </div>
                            <p class="text-center">
                                <i class="zmdi zmdi-floppy"></i><input type="submit" name="accion" value="Añadir" class="btn btn-primary" style="margin-right: 20px;" >
                                <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar</button>
                            </p> 
                       </div>
                   </div>
               </form>
            </div>
        </div>
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