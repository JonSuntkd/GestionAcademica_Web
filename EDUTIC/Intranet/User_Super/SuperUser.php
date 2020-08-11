<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: ../../index.php');
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Superusuario | EduTic</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="Shortcut Icon" type="image/x-icon" href="../assets/img/logolobo.png" />
    <script src="../js/sweet-alert.min.js"></script>
    <link rel="stylesheet" href="../css/sweet-alert.css">
    <link rel="stylesheet" href="../css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../js/jquery-1.11.2.min.js"><\/script>')</script>
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
                    <li><a href="./SuperUser.html"><i class="zmdi zmdi-home zmdi-hc-fw"></i>&nbsp;&nbsp; Gestion de Roles</a></li>
                    <li><a href="./GestionPersonas.html"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i>&nbsp;&nbsp; Gestión de Personas</a></li>
                    <li><a href="./ReportesPersonas.html"><i class="zmdi zmdi-trending-up zmdi-hc-fw"></i>&nbsp;&nbsp; Reportes Personas</a></li>
                    <li><a href="./GestionEstado.html"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i>&nbsp;&nbsp; Gestion de Estado</a></li>
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
                <li  class="tooltips-general exit-system-button" data-href="../../index.php" data-placement="bottom" title="Salir del sistema">
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
              <h1 class="all-tittles">EduTic <small>Gestión de Roles</small></h1>
            </div>
        </div>
        <div class="container-fluid">
            <ul class="nav nav-tabs nav-justified"  style="font-size: 17px;">
              <li role="presentation" class="active"><a href="admininstitution.php">Tipos de Usuarios</a></li>
            </ul>
        </div>
        <div class="container-fluid"  style="margin: 50px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="../assets/img/section.png" alt="user" class="img-responsive center-box" style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    
                    Funcionalidad que permite gestionar los usuarios que va a tener el sistema.
                
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">Creacion de Usuarios</div>
                <form>
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <!--<div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Nombre y Apellido" required="" data-toggle="tooltip" data-placement="top" title="Escriba su Nombre y su Apellido">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Nombre y Apellido</label>
                            </div>-->
                            <div class="group-material">
                                <input type="dni" class="material-control tooltips-general" placeholder="Número de Cédula" required="" data-toggle="tooltip" data-placement="top" title="Escribe su Número de Cédula">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Número de Cédula</label>
                            </div>
                            <!--<div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Correo electrónico" required="" data-toggle="tooltip" data-placement="top" title="Escriba la Dirección de su correo electrónico">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Correo electrónico</label>
                            </div>-->
                            <div class="selectUser">
                                <p style="color: rgb(212, 11, 11);" class="group-material" >Escoja el Tipo de Usuario:</p>
                                <select name="rol" class="group-material">
                                    <option value= "seleccion" disabled selected> > Tipo de Usuario</option>
                                    <option value="Usuario Directivo">Directivo</option>
                                    <option value="Usuario Administrativo">Administrativo</option>
                                    <option value="Usuario Docente">Docente</option>
                                    <option value="Usuario Estudiante">Estudiante</option>
                                    <option value="Usuario Representante">Representante</option>
                                </select>
                            </div>
                            <br>
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