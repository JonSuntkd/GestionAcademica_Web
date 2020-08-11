<?php 
    include '../services/PersonaServicios.php';
    $persona = new PersonaServicios();
    $sede="sede";
    $edificio="edificio";
    $aula="aula";
    $codigoAula = "";
    $nombreAula="";
    $capacidadAula="";
    $pisoAula="";
    $accion="Añadir";
    $mensaje="Registro de Nueva Aula";

    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: ../../index.php');
    }
    
    //Personas
    if(isset($_POST['accionPersona']) && ($_POST['accionPersona']=='Añadir'))
    {
        $persona->insertarPersona($_POST['codigo_edificio'],$_POST['sede'],$_POST['nombre_edificio'],$_POST['pisos']);
    }

    else if(isset($_POST["accionAula"]) && ($_POST["accionAula"]=="Modificar"))
    {
        $persona->modificarAula($_POST['codigo_aula'],$_POST['edificio'],$_POST['nombre_aula'],
                                        $_POST['capacidad_aula'],$_POST['tipo_aula'],$_POST['piso_aula']);
    }
    else if(isset($_GET["modificarAula"]))
    {
        $result = $persona->encontrarAula($_GET['modificarAula']);
        if($result!=null)
        {
            $codigoAula = $result['COD_AULA'];
            $nombreAula = $result['NOMBRE'];
            $capacidadAula = $result['CAPACIDAD'];
            $pisoAula = $result['PISO'];
            $mensaje="Modificar Aula";
            $accion="Modificar";
        }
    }
    else if(isset($_GET['eliminarAula']))
    {
        $persona->eliminarAula($_GET['eliminarAula']);
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
                    <li><a href="./GestionRol.php"><i class="zmdi zmdi-home zmdi-hc-fw">
                            </i>&nbsp;&nbsp; Gestion de Roles</a></li>
                    <li><a href="./GestionPersonaReporte.php">
                            <i class="zmdi zmdi-trending-up zmdi-hc-fw">
                            </i>&nbsp;&nbsp; Reportes Personas</a></li>
                    <li><a href="./GestionEstado.php">
                            <i class="zmdi zmdi-account-add zmdi-hc-fw">
                            </i>&nbsp;&nbsp; Gestion de Estado</a></li>


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
              <h1 class="all-tittles">EduTic <small>Gestión de Personas</small></h1>
            </div>
        </div>
        <div class="container-fluid">
            <ul class="nav nav-tabs nav-justified"  style="font-size: 17px;">
              <li role="presentation" class="active"><a href="admininstitution.php">Personas</a></li>
            </ul>
        </div>
        <div class="container-fluid"  style="margin: 50px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="../assets/img/user.png" alt="user" class="img-responsive center-box" style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Funcionalidad que permite gestionar los datos personales de quienes vayan a realizar un registro.                
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">Datos Personales</div>
                <form>
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <!--<div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Código de persona" required="" data-toggle="tooltip" data-placement="top" title="Escriba el codigo de la persona">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Código de persona</label>
                            </div>-->
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Cédula o Pasaporte" required="" data-toggle="tooltip" data-placement="top" title="Escriba la cédula o pasaporte">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Cédula o Pasaporte</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Nombres" required="" data-toggle="tooltip" data-placement="top" title="Escriba los nombres de la Persona">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Nombres</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Apellidos" required="" data-toggle="tooltip" data-placement="top" title="Escriba los apellidos de la Persona">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Apellidos</label>
                            </div>
                            <div class="group-material">
                                <input type="date" class="material-control tooltips-general" placeholder="Fecha de Nacimiento" required="" data-toggle="tooltip" data-placement="top" title="Seleccione la fecha de nacimiento">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Fechas de Nacimiento</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Dirección de la persona" required="" data-toggle="tooltip" data-placement="top" title="Escriba la dirección de la persona">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Dirección</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Teléfono de la persona" required="" data-toggle="tooltip" data-placement="top" title="Escriba el teléfono de la persona">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Teléfono</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Correo de la persona" required="" data-toggle="tooltip" data-placement="top" title="Escriba el correo de la persona">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Correo Personal</label>
                            </div>
                            <p class="text-center">
                                <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar</button>
                                <button type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Guardar</button>
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
  </html>