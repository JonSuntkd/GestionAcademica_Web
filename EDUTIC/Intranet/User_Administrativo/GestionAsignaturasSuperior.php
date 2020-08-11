<?php
    include '../services/AsignaturaServicios.php';
    $asignatura = new AsignaturaServicios();
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: ../../index.php');
    }
    $mensaje = "Añadir Nueva asignatura";
    $accion = "Añadir";
    $codigoAsignatura = "";
    $nombreAsignatura = "";
    $creditosAsignatura = "";

    if(isset($_POST['accionAsignatura']) && ($_POST['accionAsignatura']=='Añadir'))
    {
        $imagen = $_FILES['imagen_asignatura']['name'];
        $archivo = $_FILES['imagen_asignatura']['tmp_name'];
        $ruta = "../assets/img/".$imagen;
        move_uploaded_file($archivo,$ruta);
      
        $asignatura->insertarAsignatura($_POST['codigo_nivel_educativo'],$_POST['codigo_asignatura'],$_POST['nombre_asignatura'],
                                        $_POST['creditos_asignatura'],$_POST['tipo_asignatura'],$imagen);
    }
    else if(isset($_POST["accionAsignatura"]) && ($_POST["accionAsignatura"]=="Modificar"))
    {
        $imagen = $_FILES['imagen_asignatura']['name'];
        $archivo = $_FILES['imagen_asignatura']['tmp_name'];
        $ruta = "../assets/img/".$imagen;
        move_uploaded_file($archivo,$ruta);
        $asignatura->modificarAsignatura($_POST['codigo_nivel_educativo'],$_POST['codigo_asignatura'],$_POST['nombre_asignatura'],
                            $_POST['creditos_asignatura'],$_POST['tipo_asignatura'],$_POST['cod_comparar'],$imagen);
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
        $asignatura->eliminarAsignatura2($_GET['eliminarAsignatura']);
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
                    <li><a href="./UsuarioAdministrativo.php"><i class="zmdi zmdi-home zmdi-hc-fw"></i>&nbsp;&nbsp;
                            Inicio</a></li>
                    <li>
                        <a href="./GestionInfraestructura.php"><i class="zmdi zmdi-balance zmdi-hc-fw"></i>&nbsp;&nbsp;Gestión Infraestructura</a>
                    </li>
                    <li>
                        <a href="./GestionAsignaturasInicial.php"><i class="zmdi zmdi-book zmdi-hc-fw"></i>&nbsp;&nbsp;Gestión Asignaturas</a>
                    </li>
                    <li>
                        <div class="dropdown-menu-button"><i class="zmdi zmdi-check-square zmdi-hc-fw"></i>&nbsp;&nbsp;
                            Planificación Académica<i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i>
                        </div>
                        <ul>
                            <li>
                                <a href="./GestionPlanificacion.php"><i class="zmdi zmdi-calendar-check zmdi-hc-fw"></i>Periodo Lectivo</a>
                            </li>
                            <li>
                                <a href="./GestionPlanificacionPeriodo.php"><i class="zmdi zmdi-collection-bookmark zmdi-hc-fw"></i>Asignaturas y Aulas</a>
                            </li>
                            <li>
                                <a href="./GestionPlanificacionParalelos.php"><i class="zmdi zmdi-home zmdi-hc-fw"></i>Paralelos</a>
                            </li>
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
                    <span class="all-tittles">Administrativo <?php  echo $_SESSION['user']['NOMBRE_USUARIO']  ?></span>
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
                    Bienvenido a la sección donde se encuentra el listado de asignaturas para el nivel básico superior registrados en el sistema,
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
                        <li><a href="./GestionAsignaturasBasica.php">Educación Básica Inicial</a></li>
                        <li class="active">Educación Básica Superior</li>
                        <li><a href="./GestionAsignaturasBachillerato.php">Educación de Bachillerato</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <!--GESTION ASIGNATURAS EDUCACION SUPERIOR-->

        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">
                    <a href="#asignaturas" class="btn btn-lg" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="asignaturas" style="margin-right: 20px; color:white; font-size:30px">Asignaturas para Educación de Bachillerato</a>
                </div>
                <div class="row">
                    <div class="grou-material col-md-2 mb-5">

                    </div>
                    <form name="asignaturasForm" id="asignaturasForm" method="post">
                        <div class="group-material col-md-8 mb-5 ml-4">
                            <span style="color: #E34724;"><h2>Seleccione un nivel</h2></span>
                            <select id="cod_nivel_educativo" name="cod_nivel_educativo" class="material-control tooltips-general" data-toggle="tooltip" data-placement="top"
                                        data-original-title="Elige el nivel educativo">
                                <option value="" disabled="" selected="">Selecciona un nivel educativo</option>
                                <option value="OCTAVO">Octavo año de educación básica</option>
                                <option value="NOVENO">Noveno año de educación básica</option>
                                <option value="DECIMO">Décimo año de educación básica</option>
                            </select><br>
                            <input type="submit" name="accionNivel" value="Aceptar" class="btn btn-primary" style="margin-right: 20px;" >
                        </div>
                    </form>
                </div>
                <?php
                
                   if(isset($_POST['accionNivel'])&& isset($_POST['accionNivel'])=="Aceptar")
                   {
                        $nivel = $_POST['cod_nivel_educativo'];
                    
                ?>
                    <form name="asignaturas" id="asignaturas" method="post" enctype="multipart/form-data">
                    <div class="row container-flat-form">
                        
                        <h1 style="text-align: center;"><?php echo $mensaje ?></h1><br><br>
                        <div class="col-xs-12 col-sm-8 col-sm-offset-2" id="asignaturasForm">
                            <input type="hidden" name="codigo_nivel_educativo" value="<?php echo $nivel ?>">
                            <input type="hidden" name="codigo_asignatura_comparar" value="<?php echo $codigoAsignatura ?>">
                            <input type="hidden" name="cod_comparar" value="<?php echo $codigoAsignatura ?>">
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
                            <div class="group-material">
                                <input type="file" class="material-control tooltips-general"
                                    placeholder="Imagen de la asignatura" required="" data-toggle="tooltip" data-placement="top"
                                    title="Ingrese una imagen de la asignatura" name="imagen_asignatura" value="">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Imagen de la Asignatura</label>
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

        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">
                    <a href="#asignaturasReportes" class="btn btn-lg" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="aulas" style="margin-right: 20px; color:white;font-size:30px;">Reportes de las asignaturas de <?php echo $nivel ?></a>
                </div>
                <form id="asignaturasReporte" name="asignaturasReporte" id="asignaturasReporte" method="post">
                    <input type="hidden" name="codigo_nivel_educativo" value="<?php echo $nivel ?>">
                    <div class="row container-flat-form collapse" id="asignaturasReportes">
                        <div class="table-responsive">
                            <table id="tablaEdificios" class="table-striped table-bordered table-condensed" style="width: 100%;">
                               <thead class="text-center">
                                    <tr>
                                        <th>Código de la asignatura</th>
                                        <th>Nombre de la asignatura</th>
                                        <th>Créditos de la asignatura</th>
                                        <th>Tipo asignatura</th>
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
                                                <a href="GestionAsignaturasSuperior.php?modificarAsignatura=<?php echo $row ["COD_ASIGNATURA"];?>" class="btn btn-success" type="button">
                                                    <i class="zmdi zmdi-refresh"></i>
                                                </a>
                                            </div>
                                            <input type="hidden" name="cod_comparar" value="<?php echo $row['COD_ASIGNATURA'] ?>">
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <a href="GestionAsignaturasSuperior.php?eliminarAsignatura=<?php echo $row ["COD_ASIGNATURA"];?>" class="btn btn-danger" role="button">
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
                    </div>
                </form>
            </div>
        </div>
        <?php } ?>

        <!--<div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">
                    <a href="#asignaturas" class="btn btn-lg" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="asignaturas" style="margin-right: 20px; color:white;font-size:30px">Asignaturas para Educación Superior (Octavo a Décimo)</a>
                </div>
                <div class="row">
                    <div class="grou-material col-md-2 mb-5">

                    </div>
                    <form name="asignaturasForm" id="asignaturasForm" method="post">
                        <div class="group-material col-md-8 mb-5 ml-4">
                            <span style="color: #E34724;"><h2>Seleccione un nivel</h2></span>
                            <select id="cod_nivel_educativo" name="cod_nivel_educativo" class="material-control tooltips-general" data-toggle="tooltip" data-placement="top"
                                        data-original-title="Elige el nivel educativo">
                                <option value="" disabled="" selected="">Selecciona un nivel educativo</option>
                                <option value="OCTAVO">Octavo año de educación superior</option>
                                <option value="NOVENO">Noveno año de educación superior</option>
                                <option value="DECIMO">Décimo año de educación superior</option>
                            </select><br>
                            <script type="text/javascript">
                                var nivel = document.getElementById('cod_nivel_educativo').value = "<?php echo $_GET['cod_nivel_educativo'];?>";
                            </script>
                        </div>
                </div>
                    <div class="row container-flat-form">
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
        </div>-->


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