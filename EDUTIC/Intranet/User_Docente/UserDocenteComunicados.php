<?php
    include '../services/TareaServicios.php';
    $tarea = new TareaServicios();
    session_start();
    $cod_docente=$_SESSION['user']['COD_PERSONA'];
    if (!isset($_SESSION['user'])) {
        header('Location: ../../index.php');
    }
    $accion="Aceptar";

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
                    <li><a href="./UserDocente.php"><i class="zmdi zmdi-home zmdi-hc-fw"></i>&nbsp;&nbsp;
                            Inicio</a></li>
                    <li><a href="./UserDocenteCalificaciones.php">
                            <i class="zmdi zmdi-trending-up zmdi-hc-fw">
                            </i>&nbsp;&nbsp;
                            Calificaciones</a></li>
                    <li><a href="./UserDocenteAsistencias.php">
                            <i class="zmdi zmdi-face zmdi-hc-fw">
                            </i>&nbsp;&nbsp;
                            Asistencias</a></li>
                    <li>
                        <div class="dropdown-menu-button"><i class="zmdi zmdi-check-square zmdi-hc-fw"></i>&nbsp;&nbsp;
                            Tareas<i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i>
                        </div>
                        <ul>
                            <li>
                                <a href="./UserDocenteTareas.php"><i class="zmdi zmdi-file zmdi-hc-fw"></i>Registrar Nueva Tarea</a>
                            </li>
                            <li>
                                <a href="./UserDocenteTareasReporte.php"><i class="zmdi zmdi-file zmdi-hc-fw"></i>Tareas Asignadas</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="./UserDocenteComunicados.php">
                            <i class="zmdi zmdi-collection-text zmdi-hc-fw">
                            </i>&nbsp;&nbsp;
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
                    <span class="all-tittles">Docente <?php  echo $_SESSION['user']['NOMBRE_USUARIO']  ?></span>
                </li>
                <li class="tooltips-general exit-system-button" data-href="../../LogOut.php" data-placement="bottom"
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
                <h1 class="all-tittles">EduTic <small> Docente - Comunicados</small></h1>
            </div>
        </div>
        <div class="container-fluid"  style="margin: 50px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="../assets/img/book.png" alt="user" class="img-responsive center-box" style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Envie comunicados importantes a estudiantes o representantes                
                </div>
            </div>
        </div>

        <section class="full-reset text-center" style="padding: 40px 0;">
        <div class="container-fluid">
                <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Registrar Nuevo Comunicado</div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-sm-offset-1">
                                <div class="row">
                                    <div class="group-material col-md-6 mb-3">
                                        <span style="color: #E34724;"><h2>Seleccione el periodo lectivo</h2></span> 
                                        <select class="form-control" name="periodo">
                                            <option value="" disabled="" selected="">Selecciona el periodo</option>
                                                <?php 
                                                    $result2 = $tarea->periodo();
                                                    foreach($result2 as $opciones):
                                                ?>
                                            <option value="<?php echo $opciones['COD_PERIODO_LECTIVO'] ?>"><?php echo $opciones['COD_PERIODO_LECTIVO'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="group-material col-md-6 mb-5">
                                        <span style="color: #E34724;"><h2>Seleccione la asignatura</h2></span> 
                                        <select class="form-control" name="asignatura">
                                            <option value="" disabled="" selected="">Selecciona la asignatura</option>
                                                <?php 
                                                    $result = $tarea->asignaturaParaleloNivel($cod_docente);
                                                    foreach($result as $opciones):
                                                ?>
                                            <option value="<?php echo $opciones['COD_NIVEL_EDUCATIVO']?>|<?php echo $opciones['COD_ASIGNATURA']?>|<?php echo $opciones['COD_PARALELO']?>|<?php echo $opciones['NOMBRE']?>"><?php echo $opciones['NOMBRE'] ?>--<?php echo $opciones['NOMPARALELO'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div><br>
                                <p class="text-center">
                                    <input type="submit" name="accionTarea" value="<?php echo $accion ?>" class="btn btn-primary" style="margin-right: 20px;" >
                                    <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i
                                            class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar</button>
                                </p>                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="container-fluid">
                <?php
                    if(isset($_POST['accionTarea']) && ($_POST['accionTarea']=='Aceptar'))
                    {
                        $valores = $_POST['asignatura'];
                        $result_explode = array_map('trim',explode('|',$valores));                    
                        $cod_nivel_educativo = $result_explode[0];
                        $cod_asignatura = $result_explode[1];
                        $cod_paralelo = $result_explode[2];
                        $nombre_asignatura = $result_explode[3];
                        $cod_periodo_lectivo = $_POST['periodo'];
                ?>
                    <form action="" method="post" id="registroComunicados" name="registroComunicados" enctype="multipart/form-data">
                        <input type="hidden" name="cod_nivel_educativo" value="<?php echo $cod_nivel_educativo ?>">
                        <input type="hidden" name="cod_asignatura" value="<?php echo $cod_asignatura ?>">
                        <input type="hidden" name="cod_paralelo" value="<?php echo $cod_paralelo ?>">
                        <input type="hidden" name="cod_periodo_lectivo" value="<?php echo $cod_periodo_lectivo ?>">
                        <div class="title-flat-form title-flat-green">Nueva Comunicado para la asignatura <?php echo $nombre_asignatura ?></div>
                        <h1 class="all-tittles">Título/Tema del Comunicado</h1>
                        <div class="group-material col-xs-12 col-sm-8 col-sm-offset-2">
                            <input type="text" class="material-control tooltips-general" placeholder="Título del comunicado" required="" 
                                    data-toggle="tooltip" data-placement="top" title="Escriba el título del comunicado a enviar" 
                                    name="titulo_comunicado">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                        </div><br><br><br><br>
                        <h1 class="all-tittles">Detalles del comunicado</h1>
                        <div class="group-material col-xs-12 col-sm-8 col-sm-offset-2">
                            <input type="text" class="material-control tooltips-general" placeholder="Detalles de la comunicado" required="" 
                                    data-toggle="tooltip" data-placement="top" title="Escriba los detalles de la comunicado a realizar" 
                                    name="detalle_comunicado">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                        </div><br><br><br><br>
                        <h1 class="all-tittles">Fecha de envío</h1>
                        <div class="group-material col-xs-12 col-sm-8 col-sm-offset-2">
                            <input type="datetime-local" class="material-control tooltips-general" placeholder="Fecha de envío del comunicado" required="" 
                                    data-toggle="tooltip" data-placement="top" title="Seleccione la fecha de entrega" 
                                    name="fecha_comunicado" onchange="obtenerFecha(this)">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                        </div><br><br><br><br>
                        <h1 class="all-tittles">Archivos</h1>
                        <div class="group-material col-xs-12 col-sm-8 col-sm-offset-2">
                            <input type="file" class="material-control tooltips-general" placeholder="Archivos para el comunicado" required="" 
                                    data-toggle="tooltip" data-placement="top" title="Seleccione un archivo" 
                                    name="archivo">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                        </div>
                        <input type="submit" name="accionComunicados" value="Hecho" class="btn btn-primary" style="margin-right: 20px;" >
                    </form>
                <?php
                    } 
                ?>              
            
        
            <?php
                    if(isset($_POST['accionComunicados'])&& ($_POST['accionComunicados']=='Hecho'))
                    {
                        $archivoComunicado = $_FILES['archivo']['name'];
                        $archivo = $_FILES['archivo']['tmp_name'];
                        $ruta = "../assets/files/".$archivoComunicado;
                        move_uploaded_file($archivo,$ruta);
                        $tarea->ingresarComunicado($_POST['cod_nivel_educativo'],$_POST['cod_asignatura'],$_POST['cod_periodo_lectivo'],
                                                     $_POST['cod_paralelo'],$cod_docente,$_POST['titulo_comunicado'],$_POST['detalle_comunicado'],
                                                     $_POST['fecha_comunicado'],$archivoComunicado);
                    }
            ?>

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

<script>

    function obtenerFecha(e)
    {
        var fecha = moment(e.value);
        return fecha.format("YYYY/MM/DD HH:MM:SS")
    }
</script>

</html>