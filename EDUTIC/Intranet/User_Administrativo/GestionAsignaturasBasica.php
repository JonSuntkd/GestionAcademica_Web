<?php
    include '../services/AsignaturaServicios.php';
    $asignatura = new AsignaturaServicios();
    $nivel="BAI";
    $mensaje = "Añadir Nueva asignatura";
    $accion = "Añadir";
    $codigoAsignatura = "";
    $nombreAsignatura = "";
    $creditosAsignatura = "";

    if(isset($_POST['accionAsignatura']) && ($_POST['accionAsignatura']=='Añadir'))
    {
        $asignatura->insertarAsignatura($nivel,$_POST['codigo_asignatura'],$_POST['nombre_asignatura'],
                                        $_POST['creditos_asignatura'],$_POST['tipo_asignatura']);
    }
    else if(isset($_POST["accionAsignatura"]) && ($_POST["accionAsignatura"]=="Modificar"))
    {
        $asignatura->modificarAsignatura($nivel,$_POST['codigo_asignatura'],$_POST['nombre_asignatura'],
                            $_POST['creditos_asignatura'],$_POST['tipo_asignatura'],$_POST['codigo_asignatura_comparar']);
    }
    else if(isset($_GET["modificarAsignatura"]))
    {
        $result = $asignatura->encontrarAsignatura($_GET['modificarAsignatura']);
        if($result!=null)
        {
            $codigoAsignatura = $result['COD_ASIGNATURA'];
            $nombreAsignatura = $result['NOMBRE'];
            $creditosAsignatura = $result['CREDITOS'];
            $mensaje="Modificar Asignatura";
            $accion="Modificar";
        }
    }
    else if(isset($_GET['eliminarAsignatura']))
    {
        $asignatura->eliminarAsignatura($nivel,$_GET['eliminarAsignatura']);
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
                    <li><a href="./userAdministrativo.html"><i class="zmdi zmdi-home zmdi-hc-fw"></i>&nbsp;&nbsp;
                            Inicio</a></li>
                    <li>
                        <a href="./GestionInfraestructura.php"><i class="zmdi zmdi-balance zmdi-hc-fw"></i>&nbsp;&nbsp;Gestión Infraestructura</a>
                    </li>
                    <li>
                        <a href="./GestionAsignaturasInicial.php"><i class="zmdi zmdi-book zmdi-hc-fw"></i>&nbsp;&nbsp;Gestión Asignaturas</a>
                    </li>
                    <li>
                        <!------------------------------------ Periodo ---------------------------->
                        <div class="dropdown-menu-button"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i>&nbsp;&nbsp;
                            Periodo <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i></div>
                        <ul class="list-unstyled">
                            <li><a href="./GestionPeriodos.html">
                                    <i class="zmdi zmdi-face zmdi-hc-fw">
                                    </i>&nbsp;&nbsp;
                                    Gestión de Periodos</a></li>
                            <li><a href="./AsignacionDocente.html">
                                    <i class="zmdi zmdi-face zmdi-hc-fw">
                                    </i>&nbsp;&nbsp;
                                    Asignación de Docente</a></li>
                            <li><a href="./EsquemasEvaluacion.html">
                                    <i class="zmdi zmdi-face zmdi-hc-fw">
                                    </i>&nbsp;&nbsp;
                                    Esquemas de Evaluación</a></li>
                        </ul>
                    </li>
                    <!--ASPIRANTES-->
                    <li>
                        <a href="./GestionAspirantes.html"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i>&nbsp;&nbsp;Aspirantes</a> 
                    </li>
                    <li><a href="./reportAdministrativo.html"><i
                        class="zmdi zmdi-trending-up zmdi-hc-fw"></i>&nbsp;&nbsp; Reportes y estadísticas</a>
                    </li>
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
                    <span class="all-tittles">Administrativo</span>
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
                <h1 class="all-tittles">EduTic <small>Gestión asignaturas</small></h1>
            </div>
        </div>
        <div class="container-fluid" style="margin: 50px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="../assets/img/user02.png" alt="user" class="img-responsive center-box"
                        style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Bienvenido a la sección donde se encuentra el listado de asignaturas para el nivel básico inicial registrados en el sistema,
                    puedes actualizar algunos datos de las asignaturas o eliminar el registro completo de la asignatura
                    siempre.<br>
                    <strong class="text-danger"><i class="zmdi zmdi-alert-triangle"></i> &nbsp; ¡Importante! </strong>Si
                    eliminas la asignatura del sistema se borrarán todos los datos relacionados con él.
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 lead">
                    <ol class="breadcrumb">
                        <li><a href="./GestionAsignaturasInicial.php">Educación Inicial</a></li>
                        <li class="active">Educación Básica Inicial</li>
                        <li><a href="./GestionAsignaturasSuperior.php">Educación Básica Superior</a></li>
                        <li><a href="./GestionAsignaturasBachillerato.php">Educación de Bachillerato</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <!--GESTION ASIGNATURAS EDUCACION INICIAL-->
        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">
                    <a href="#asignaturas" class="btn btn-lg" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="asignaturas" style="margin-right: 20px; color:white;">Asignaturas para Educación Básica Inicial (1ero a 7mo de básica</a>
                </div>
                <form id="edificios" name="edificios" id="edificios" method="post">
                    <div class="row container-flat-form">
                        <div class="table-responsive">
                            <table id="tablaEdificios" class="table-striped table-bordered table-condensed" style="width: 100%;">
                               <thead class="text-center">
                                    <tr>
                                        <th>Código de la Asignatura</th>
                                        <th>Nombre</th>
                                        <th>Horas Semanales</th>
                                        <th>Tipo</th>
                                        <th>Actualizar</th>
                                        <th>Eliminar</th>
                                    </tr>
                               </thead>
                               <tbody>
                                    <?php
                                        $result = $asignatura->mostrarAsignaturas($nivel);
                                        if($result->num_rows>0)
                                        {
                                            while($row = $result->fetch_assoc())
                                            {     
                                    ?>
                                    <tr>
                                        <!--DATOS DE LA TABLA EDIFICIOS-->
                                        <td><?php echo $row ["COD_ASIGNATURA"];?></td>
                                        <td><?php echo $row ["NOMBRE"];?></td>
                                        <td><?php echo $row ["CREDITOS"];?></td>
                                        <td><?php echo $row ["TIPO"];?></td>
                                        <td>
                                            <div class="text-center">
                                                <a href="GestionAsignaturasBasica.php?modificarAsignatura=<?php echo $row ["COD_ASIGNATURA"];?>#asignaturasForm" class="btn btn-success" type="button">
                                                    <i class="zmdi zmdi-refresh"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <a href="GestionAsignaturasBasica.php?eliminarAsignatura=<?php echo $row ["COD_ASIGNATURA"];?>#asignaturasForm" class="btn btn-danger" role="button">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php   } 
                                        } 
                                        else
                                        {
                                    ?>
                                    <tr>
                                        <td>No hay datos en la tabla</td>
                                    </tr>        
                                    <?php } ?>
                                </tbody> 
                            </table>
                        </div><br>
                        <h1 style="text-align: center;"><?php echo $mensaje ?></h1><br><br>
                        <div class="col-xs-12 col-sm-8 col-sm-offset-2" id="asignaturasForm">
                            <input type="hidden" name="codigo_asignatura_comparar" value="<?php echo $codigoAsignatura ?>">
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general"
                                    placeholder="Código de la Asignatura" required="" data-toggle="tooltip" data-placement="top"
                                    title="Escriba el código de la Asignatura" name="codigo_asignatura" value="<?php echo $codigoAsignatura ?>">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Código de la Asignatura</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general"
                                    placeholder="Nombre de la Asignatura" required="" data-toggle="tooltip" data-placement="top"
                                    title="Escriba el nombre de la Asignatura" name="nombre_asignatura" value="<?php echo $nombreAsignatura ?>">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Nombre de la Asignatura</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general"
                                    placeholder="Créditos de la Asignatura" required="" data-toggle="tooltip" data-placement="top"
                                    title="Escriba los créditos de la Asignatura" name="creditos_asignatura" value="<?php echo $creditosAsignatura ?>">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Créditos de la Asignatura</label>
                            </div> 
                            <div class="group-material">
                                <span style="color: #E34724;">Tipo de Asignatura</span>
                                <select name="tipo_asignatura" class="material-control tooltips-general" data-toggle="tooltip" data-placement="top"
                                data-original-title="Elige el tipo de asignatura">
                                    <option value="" disabled="" selected="">Selecciona una opción</option>
                                    <option value="MIN">Ministerial</option>
                                    <option value="PRO">Institucional</option>
                                    <option value="OTR">Otra</option>
                                </select>
                            </div>
                            <p class="text-center">
                                <input type="submit" name="accionAsignatura" value="<?php echo $accion ?>" class="btn btn-primary" style="margin-right: 20px;" >
                                <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i
                                        class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar</button>
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
                        <h4 class="all-tittles">Desarrollador</h4>
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