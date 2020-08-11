<?php
    include '../services/TareaServicios.php';
    $tarea = new TareaServicios();
    session_start();
    $cod_representante=$_SESSION['user']['COD_PERSONA'];
    $datos = $tarea->datosEstudiante($cod_representante);
    $row = $datos->fetch_assoc();
    $cod_alumno = $row['COD_PERSONA']; 
    $nombre = $row['NOMBRE'];
    $apellido = $row['APELLIDO'];
    if (!isset($_SESSION['user'])) {
        header('Location: ../../index.php');
    }
    $accion="Aceptar";
    
    if(isset($_GET['finalizarTarea']))
    {
        //$tarea->tareaTerminada($_GET['finalizarTarea']);
    }

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>EduTic</title>
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
                <i class="visible-xs zmdi zmdi-close pull-left mobile-menu-button"
                    style="line-height: 55px; cursor: pointer; padding: 0 10px; margin-left: 7px;"></i>
                EduTic
            </div>
            <div class="full-reset" style="background-color:#2B3D51; padding: 10px 0; color:#fff;">
                <figure>
                    <img src="../assets/img/logo.png" alt="Biblioteca" class="img-responsive center-box"
                        style="width:55%;">
                </figure>
                <p class="text-center" style="padding-top: 15px;">Unidad Educativa "Oswaldo Guayasamin"</p>
            </div>
            <div class="full-reset nav-lateral-list-menu">
                <ul class="list-unstyled">
                    <li><a href="./UserAlumno.html"><i class="zmdi zmdi-home zmdi-hc-fw"></i>&nbsp;&nbsp;
                            Inicio</a>
                    </li>
                    <li><a href="./UserAlumnoTareas.php">
                            <i class="zmdi zmdi-file zmdi-hc-fw">
                            </i>&nbsp;&nbsp;
                            Tareas</a>
                    </li>
                    <li><a href="./UserAlumnoCalificaciones.php"><i class="zmdi zmdi-collection-item-9-plus zmdi-hc-fw"></i>&nbsp;&nbsp;
                            Calificaciones</a></li>
                    <li><a href="./UserAlumnoComunicados.php"><i class="zmdi zmdi-trending-up zmdi-hc-fw"></i>&nbsp;&nbsp;
                            Comunicados</a></li>
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
                    <span class="all-tittles"><?php echo $_SESSION['user']['NOMBRE_USUARIO'] ?></span>
                </li>
                <li class="tooltips-general exit-system-button" data-href="../../index.html" data-placement="bottom"
                    title="Salir del sistema">
                    <i class="zmdi zmdi-power"></i>
                </li>
                <li class="tooltips-general btn-help" data-placement="bottom" title="Ayuda">
                    <i class="zmdi zmdi-help-outline zmdi-hc-fw"></i>
                </li>
                <li class="mobile-menu-button visible-xs" style="float: left !important;">
                    <i class="zmdi zmdi-menu"></i>
                </li>
            </ul>
        </nav>
        <div class="container">
            <div class="page-header">
                <h1 class="all-tittles">EduTic <small>Alumno - Comunicados</small></h1>
            </div>
        </div>
        <div class="container-fluid"  style="margin: 50px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="../assets/img/book.png" alt="user" class="img-responsive center-box" style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Comunicados enviados por el docente                
                </div>
            </div>
        </div>

        <section class="full-reset text-center" style="padding: 40px 0;">
            
        <div class="container">
            <br><br><div class="" id="message"></div>
                <div class="row mt-2 pb-3">
                    <?php
                        $result2 = $tarea->verificarComunicado($cod_alumno);
                        if($result2->num_rows>0)
                        {
                          $cont=0;
                          while($row = $result2->fetch_assoc())
                          {
                    ?>
                            <div class="col-sm-6 col-md-4 col-lg-3 mb-2">
                                <div class="card-deck">
                                    <div class="card p-2 border-secondary mb-2">
                                        <img src="<?php echo "../assets/img/".$row['IMAGEN'] ?>" class="card-img-top" height="180 !important" width="250 !important">
                                        <div class="title-flat-form title-flat-blue">
                                            <button class="title-flat-form title-flat-blue btn btn-primary" type="button" data-toggle="collapse" data-target="#detallesTarea<?php echo $cont ?>" aria-expanded="false" aria-controls="detallesTarea<?php echo $cont ?>">
                                                <?php echo $row['NOMBRE'] ?>
                                            </button>
                                        </div>
                                        <div class="card-body p-1 collapse" id="detallesTarea<?php echo $cont ?>">
                                            <h1 class="card-title text-center text-info"><?= $row["TITULO_COMUNICADO"] ?></h1>
                                            <h2 class="card-text text-center text-danger"><?php echo $row["DETALLE_COMUNICADO"] ?></h2>
                                            <h3 class="card-text text-center text-success"><?php echo $row["FECHA_COMUNICADO"] ?></h3>
                                            <a href="../assets/files/<?php echo $row['ARCHIVO'] ?>" download="<?php echo $row['ARCHIVO'] ?>" class="btn btn-success" role="button">
                                                Descargar Archivo
                                            </a>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                 <?php $cont++; } 
                 }?>
            </div>
        </div>

        </section>

        <div class="modal fade" tabindex="-1" role="dialog" id="ModalHelp">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center all-tittles">ayuda del sistema</h4>
                    </div>
                    <div class="modal-body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore dignissimos qui molestias
                        ipsum officiis unde aliquid consequatur, accusamus delectus asperiores sunt. Quibusdam veniam
                        ipsa accusamus error. Animi mollitia corporis iusto.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i
                                class="zmdi zmdi-thumb-up"></i> &nbsp; De acuerdo</button>
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
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam quam dicta et, ipsum quo.
                            Est saepe deserunt, adipisci eos id cum, ducimus rem, dolores enim laudantium eum
                            repudiandae temporibus sapiente.
                        </p>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <h4 class="all-tittles">Desarrollado por:</h4>
                        <ul class="list-unstyled">
                            <li><i class="zmdi zmdi-check zmdi-hc-fw"></i>&nbsp; EspeSoft <i
                                    class="zmdi zmdi-facebook zmdi-hc-fw footer-social"></i><i
                                    class="zmdi zmdi-twitter zmdi-hc-fw footer-social"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-copyright full-reset all-tittles">© 2020 EspeSoft</div>
        </footer>
    </div>
</body>

</html>