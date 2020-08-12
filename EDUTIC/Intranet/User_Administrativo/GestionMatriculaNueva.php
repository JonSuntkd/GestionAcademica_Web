<?php
    include '../services/MatriculaServicios.php';
    $matricula = new MatriculaServicios();
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: ../../index.php');
    }
    $codigoPeriodo = "";
    $cedula="";
    $cod_persona="";
    $fechaInicio="";
    $fechaFin="";
    $accion="Añadir";
    $mensaje="Matricula Nuevo Estudiante";

    if(isset($_POST['accionMatricula']))
    {
        $matricula->agregarMatricula($_POST['periodo'],$_POST['cod_persona'],$_POST['cod_nivel_educativo']);
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
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">-->
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
                    <li>
                        <div class="dropdown-menu-button"><i class="zmdi zmdi-assignment zmdi-hc-fw"></i>&nbsp;&nbsp;
                            Gestión de Matriculas<i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i>
                        </div>
                        <ul>
                            <li>
                                <a href="./GestionMatricula.php"><i class="zmdi zmdi-calendar-check zmdi-hc-fw"></i>Matrícula Estudiantes</a>
                            </li>
                            <li>
                                <a href="./GestionMatriculaNueva.php"><i class="zmdi zmdi-calendar-check zmdi-hc-fw"></i>Matrícula Estudiantes Nuevos</a>
                            </li>
                            <li>
                                <a href="./GestionMatriculaAntiguos.php"><i class="zmdi zmdi-collection-bookmark zmdi-hc-fw"></i>Matricula Estudiantes Antiguos</a>
                            </li>
                        </ul>
                    </li>
                    <!--ASPIRANTES-->
                    <li>
                        <a href="./GestionAspirantes.php"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i>&nbsp;&nbsp;Aspirantes</a> 
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
                <h1 class="all-tittles">EduTic <small>Gestión de Matrículas</small></h1>
            </div>
        </div>
        <div class="container-fluid">
            <ul class="nav nav-tabs nav-justified" style="font-size: 17px;">
                <li role="presentation" class="active"><a href="admininstitution.php">Planificación de Matriculas</a></li>
            </ul>
        </div>
        <div class="container-fluid" style="margin: 50px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="../assets/img/institution.png" alt="user" class="img-responsive center-box"
                        style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Funcionalidad que permite gestionar las matrículas de los estudiantes. 
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">
                    <a href="#asignaturaPeriodo" class="btn btn-lg" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sedes" style="margin-right: 20px; color:white; font-size:30px;">Datos para el registro de matrícula</a>
                </div>
            </div>
            
            
                    <div class="row container-flat-form">
                        <h1 style="text-align: center;"><?php echo $mensaje ?></h1><br><br>
                        <div class="col-xs-12 col-sm-8 col-sm-offset-2" id="asignaturasForm">
                            <form action="" method="post">
                                <div class="group-material">
                                    <input type="text" class="material-control tooltips-general"
                                        placeholder="Cédula del Estudiante" required="" data-toggle="tooltip" data-placement="top"
                                        title="Escriba la cédula del estudiante" name="cedula_estudiante" value="">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Cédula del Estudiante Nuevo</label><br>
                                    <input type="submit" name="verificarEstudiante" value="Verificar" class="btn btn-primary" style="margin-right: 20px;" >
                                </div>
                            </form>
                            <?php
                                if(isset($_POST['verificarEstudiante']))
                                {
                                    $cedula = $_POST['cedula_estudiante'];
                                }     
                            ?>
                 <form name="matricula" id="matricula" method="post">           
                            <div class="table-responsive">
                                <table id="tablaEdificios" class="table-striped table-bordered table-condensed" style="width: 100%;">
                                <thead class="text-center">
                                        <tr>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Dirección</th>
                                        </tr>
                                </thead>
                                <tbody>
                                        <?php
                                            $result = $matricula->encontrarAlumno($cedula);
                                            if($result->num_rows>0)
                                            {
                                                while($row = $result->fetch_assoc())
                                                {     
                                        ?>
                                        <tr>
                                            <!--DATOS DE LA TABLA EDIFICIOS-->
                                            <td><?php echo $row ["NOMBRE"];?></td>
                                            <td><?php echo $row ["APELLIDO"];?></td>
                                            <td><?php echo $row ["DIRECCION"];?></td>
                                            <input type="hidden" name="cod_persona" value="<?php echo $row['COD_PERSONA'] ?>">
                                        </tr>
                                        <?php   } ?> 
                                        
                                        <?php   } 
                                            else
                                            {
                                        ?>
                                        <tr>
                                            <td>La cédula no coincide con algún registro en la base</td>
                                        </tr>        
                                        <?php } ?>
                                    </tbody> 
                                </table>
                            </div><br>

                            <div class="group-material">
                                <span style="color: #E34724;"><h2>Seleccione el nivel educativo</h2></span> 
                                <select class="form-control" name="cod_nivel_educativo">
                                    <option value="" disabled="" selected="">Selecciona el nivel</option>
                                        <?php 
                                            $result2 = $matricula->nivelesEducativos();
                                            foreach($result2 as $opciones):
                                        ?>
                                    <option value="<?php echo $opciones['COD_NIVEL_EDUCATIVO'] ?>"><?php echo $opciones['NOMBRE'] ?></option>
                                        <?php endforeach ?>
                                </select>
                            </div>
                            <div class="group-material">
                                    <span style="color: #E34724;"><h2>Seleccione el periodo lectivo</h2></span> 
                                    <select class="form-control" name="periodo">
                                        <option value="" disabled="" selected="">Selecciona el periodo</option>
                                            <?php 
                                                $result4 = $matricula->periodo();
                                                foreach($result4 as $opciones):
                                            ?>
                                        <option value="<?php echo $opciones['COD_PERIODO_LECTIVO'] ?>"><?php echo $opciones['COD_PERIODO_LECTIVO'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                            </div>

                            <p class="text-center">
                                <input type="submit" name="accionMatricula" value="<?php echo $accion ?>" class="btn btn-primary" style="margin-right: 20px;" >
                                <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i
                                        class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar</button>
                            </p>
                        </div>
                    </div>
                </form>
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
    return fecha.format("YYYY/MM/DD")
}
</script>

</html>