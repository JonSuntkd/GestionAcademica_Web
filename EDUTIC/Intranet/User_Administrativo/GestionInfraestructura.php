<?php 
    include '../services/InfraestructuraServicios.php';
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: ../../index.php');
    }
    $infraestructura = new InfraestructuraServicios();
    $sede="sede";
    $edificio="edificio";
    $aula="aula";
    $codigoSede="";
    $nombreSede="";
    $direccionSede="";
    $telefonoSede="";
    $codPostalSede="";
    $codigoAula = "";
    $nombreAula="";
    $capacidadAula="";
    $pisoAula="";
    $codigoEdificio="";
    $nombreEdificio="";
    $cantidadPisos="";
    $accion="Añadir";
    $mensajeSede="Registrar Nueva Sede";
    $mensaje="Registro de Nueva Aula";
    $mensajeEdificios = "Registro de nuevo Edificio";
    //SEDE
    if(isset($_POST['accionSede']) && ($_POST['accionSede']=='Añadir'))
    {
        $infraestructura->insertarSede($_POST['codigo_sede'],$_POST['nombre_sede'],$_POST['direccion_sede'],
                                       $_POST['telefono_sede'],$_POST['cod_postal_sede']);
    }
    else if(isset($_POST["accionSede"]) && ($_POST["accionSede"]=="Modificar"))
    {
        $infraestructura->modificarSede($_POST['codigo_sede'],$_POST['nombre_sede'],$_POST['direccion_sede'],
        $_POST['telefono_sede'],$_POST['cod_postal_sede'],$_POST['codigo_sede_comparar']);
    }
    else if(isset($_GET["modificarSede"]))
    {
        $result = $infraestructura->encontrarSede($_GET['modificarSede']);
        if($result!=null)
        {
            $codigoSede = $result['COD_SEDE'];
            $nombreSede = $result['NOMBRE'];
            $direccionSede = $result['DIRECCION'];
            $telefonoSede = $result['TELEFONO'];
            $codPostalSede = $result['CODIGO_POSTAL'];
            $mensajeSede = "Modificar datos de la Sede";
            $accion="Modificar";
        }
    }

    //EDIFICIOS
    if(isset($_POST['accionEdificios']) && ($_POST['accionEdificios']=='Añadir'))
    {
        $infraestructura->insertarEdificio($_POST['codigo_edificio'],$_POST['sede'],$_POST['nombre_edificio'],$_POST['pisos']);
    }
    else if(isset($_POST["accionEdificios"]) && ($_POST["accionEdificios"]=="Modificar"))
    {
        $infraestructura->modificarEdicio($_POST['codigo_edificio'],$_POST['sede'],$_POST['nombre_edificio'],
                                        $_POST['pisos'],$_POST['codigo_edificio_comparar']);
    }
    else if(isset($_GET["modificarEdificio"]))
    {
        $result = $infraestructura->encontrarEdificio($_GET['modificarEdificio']);
        if($result!=null)
        {
            $codigoEdificio = $result['COD_EDIFICIO'];
            $nombreEdificio = $result['NOMBRE'];
            $cantidadPisos = $result['CANTIDAD_PISOS'];
            $mensajeEdificios = "ModificarEdificio";
            $accion="Modificar";
        }
    }
    else if(isset($_GET['eliminarEdificio']))
    {
        $infraestructura->eliminarEdificio($_GET['eliminarEdificio']);
    }

    //AULAS
    if(isset($_POST['accionAula']) && ($_POST['accionAula']=='Añadir'))
    {
        $infraestructura->insertarAula($_POST['codigo_aula'],$_POST['edificio'],$_POST['nombre_aula'],
                                       $_POST['capacidad_aula'],$_POST['tipo_aula'],$_POST['piso_aula']);
    }
    else if(isset($_POST["accionAula"]) && ($_POST["accionAula"]=="Modificar"))
    {
        $infraestructura->modificarAula($_POST['codigo_aula'],$_POST['edificio'],$_POST['nombre_aula'],
                                        $_POST['capacidad_aula'],$_POST['tipo_aula'],$_POST['piso_aula'],
                                        $_POST['codigo_aula_comparar']);
    }
    else if(isset($_GET["modificarAula"]))
    {
        $result = $infraestructura->encontrarAula($_GET['modificarAula']);
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
        $infraestructura->eliminarAula($_GET['eliminarAula']);
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
                <h1 class="all-tittles">EduTic <small>Gestión de Infraestructura</small></h1>
            </div>
        </div>
        <div class="container-fluid">
            <ul class="nav nav-tabs nav-justified" style="font-size: 17px;">
                <li role="presentation" class="active"><a href="admininstitution.php">Infraestructura</a></li>
            </ul>
        </div>
        <div class="container-fluid" style="margin: 50px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="../assets/img/institution.png" alt="user" class="img-responsive center-box"
                        style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Funcionalidad que permite gestionar la infraestructura de la institución educativa
                    como la sede, los edificios o las aulas.
                </div>
            </div>
        </div>
        <!--GESTIÓN DE SEDES-->
        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">
                    <a href="#sedes" class="btn btn-lg" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sedes" style="margin-right: 20px; color:white; font-size:30px;">Datos de la Sede de la Institución</a>
                </div>
                <form id="sedes" method="post" name="sedes" action="">
                    <div class="row container-flat-form">
                        <div class="table-responsive">
                            <table id="tablaSedes" class="table-striped table-bordered table-condensed" style="width: 100%;">
                               <thead class="text-center">
                                    <tr>
                                        <th>Código</th>
                                        <th>Nombre</th>
                                        <th>Dirección</th>
                                        <th>Teléfono</th>
                                        <th>Código Postal</th>
                                        <th>Actualizar</th>
                                    </tr>
                               </thead>
                               <tbody>
                                    <?php
                                        $result = $infraestructura->mostrarInfraectructura($sede);
                                        if($result->num_rows>0)
                                        {
                                            while($row = $result->fetch_assoc())
                                            {     
                                    ?>
                                    <tr>
                                        <!--DATOS DE LA TABLA SEDES-->
                                        <td><?php echo $row ["COD_SEDE"];?></td>
                                        <td><?php echo $row ["NOMBRE"];?></td>
                                        <td><?php echo $row ["DIRECCION"];?></td>
                                        <td><?php echo $row ["TELEFONO"];?></td>
                                        <td><?php echo $row ["CODIGO_POSTAL"];?></td>
                                        <td>
                                            <div class="text-center">
                                                <a href="GestionInfraestructura.php?modificarSede=<?php echo $row ["COD_SEDE"];?>#sedesForm" class="btn btn-success" type="button">
                                                    <i class="zmdi zmdi-refresh"></i>
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
                        </div><br><br>
                        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                        <h1 style="text-align: center;"><?php echo $mensajeSede ?></h1><br><br>
                            <input type="hidden" name="codigo_sede_comparar" value="<?php echo $codigoSede ?>">
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general"
                                    placeholder="Código de la sede" required="" data-toggle="tooltip" data-placement="top"
                                    title="Escriba el código de la sede" name="codigo_sede" value="<?php echo $codigoSede ?>">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Código de la Sede</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general"
                                    placeholder="Nombre de la sede" required="" data-toggle="tooltip" data-placement="top"
                                    title="Escriba el nombre de la sede" name="nombre_sede" value="<?php echo $nombreSede ?>">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Nombre de la Sede</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general"
                                    placeholder="Dirección de la Sede" required="" data-toggle="tooltip" data-placement="top"
                                    title="Escriba la dirección de la Sede" name="direccion_sede" value="<?php echo $direccionSede ?>">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Dirección de la Sede</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Teléfono de la Sede"
                                    required="" data-toggle="tooltip" data-placement="top"
                                    title="Escriba el teléfono de la Sede" name="telefono_sede" value="<?php echo $telefonoSede ?>">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Teléfono de la Sede</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general"
                                    placeholder="Código Postal" required="" data-toggle="tooltip" data-placement="top"
                                    title="Escriba el código postal de la sede" name="cod_postal_sede" value="<?php echo $codPostalSede ?>">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Código Postal</label>
                            </div>
                            <p class="text-center">
                                <input type="submit" name="accionSede" value="<?php echo $accion ?>" class="btn btn-primary" style="margin-right: 20px;" >
                                <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i
                                        class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar</button>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--GESTIÓN DE EDIFICIOS-->
        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">
                    <a href="#edificios" class="btn btn-lg" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="aulas" style="margin-right: 20px; color:white;font-size:30px;">Datos de los Edificios de la Institución</a>
                </div>
                <form id="edificios" name="edificios" id="edificios" method="post">
                    <div class="row container-flat-form">
                        <div class="table-responsive">
                            <table id="tablaEdificios" class="table-striped table-bordered table-condensed" style="width: 100%;">
                               <thead class="text-center">
                                    <tr>
                                        <th>Código</th>
                                        <th>Código Sede</th>
                                        <th>Nombre</th>
                                        <th>Cantidad Pisos</th>
                                        <th>Actualizar</th>
                                        <th>Eliminar</th>
                                    </tr>
                               </thead>
                               <tbody>
                                    <?php
                                        $result = $infraestructura->mostrarInfraectructura($edificio);
                                        if($result->num_rows>0)
                                        {
                                            while($row = $result->fetch_assoc())
                                            {     
                                    ?>
                                    <tr>
                                        <!--DATOS DE LA TABLA EDIFICIOS-->
                                        <td><?php echo $row ["COD_EDIFICIO"];?></td>
                                        <td><?php echo $row ["COD_SEDE"];?></td>
                                        <td><?php echo $row ["NOMBRE"];?></td>
                                        <td><?php echo $row ["CANTIDAD_PISOS"];?></td>
                                        <td>
                                            <div class="text-center">
                                                <a href="GestionInfraestructura.php?modificarEdificio=<?php echo $row ["COD_EDIFICIO"];?>#edificiosForm" class="btn btn-success" type="button">
                                                    <i class="zmdi zmdi-refresh"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <a href="GestionInfraestructura.php?eliminarEdificio=<?php echo $row ["COD_EDIFICIO"];?>#edificiosForm" class="btn btn-danger" role="button">
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
                        <h1 style="text-align: center;"><?php echo $mensajeEdificios ?></h1><br><br>
                        <div class="col-xs-12 col-sm-8 col-sm-offset-2" id="edificiosForm">
                            <input type="hidden" name="codigo_edificio_comparar" value="<?php echo $codigoEdificio ?>">
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general"
                                    placeholder="Código de Edificio" required="" data-toggle="tooltip" data-placement="top"
                                    title="Escriba el código del edificio" name="codigo_edificio" value="<?php echo $codigoEdificio ?>">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Código de Edificio</label>
                            </div>
                            <div class="group-material">
                                <span style="color: #E34724;">Código de la sede</span>
                                <select name="sede" class="material-control tooltips-general" data-toggle="tooltip" data-placement="top"
                                data-original-title="Elige la sede donde se encuentra el edificio">
                                    <option value="" disabled="" selected="">Selecciona una sede</option>
                                    <?php 
                                        $result2 = $infraestructura->mostrarInfraectructura($sede);
                                        foreach($result2 as $opciones):
                                    ?>
                                    <option value="<?php echo $opciones['COD_SEDE'] ?>"><?php echo $opciones['COD_SEDE'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Nombre del edificio"
                                    required="" data-toggle="tooltip" data-placement="top"
                                    title="Nombre del Edificio" name="nombre_edificio" value="<?php echo $nombreEdificio ?>">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Nombre del Edificio</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general"
                                    placeholder="Cantidad de Pisos" required="" data-toggle="tooltip" data-placement="top"
                                    title="Escriba la cantidad de pisos" name="pisos" value="<?php echo $cantidadPisos ?>">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Cantidad de Pisos</label>
                            </div>
                            <p class="text-center">
                                <input type="submit" name="accionEdificios" value="<?php echo $accion ?>" class="btn btn-primary" style="margin-right: 20px;" >
                                <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i
                                        class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar</button>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--GESTIÓN DE AULAS-->
        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">
                    <a href="#aulas" class="btn btn-lg" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="aulas" style="margin-right: 20px; color:white; font-size:30px;">Datos de las Aulas</a>
                </div>
                <form action="" name="aulas" id="aulas" method="post">
                    <div style="margin-left: 14px;">
                    </div>
                    <div class="row container-flat-form">
                        <div class="table-responsive">
                            <table id="tablaAulas" class="table-striped table-bordered table-condensed" style="width: 100%;">
                               <thead class="text-center">
                                    <tr>
                                        <th>Código</th>
                                        <th>Código Edificio</th>
                                        <th>Nombre</th>
                                        <th>Capacidad</th>
                                        <th>Tipo</th>
                                        <th>Piso</th>
                                        <th>Actualizar</th>
                                        <th>Eliminar</th>
                                    </tr>
                               </thead>
                               <tbody>
                                    <?php
                                        $result = $infraestructura->mostrarInfraectructura($aula);
                                        if($result->num_rows>0)
                                        {
                                            while($row = $result->fetch_assoc())
                                            {     
                                    ?>
                                    <tr>
                                        <!--DATOS DE LA TABLA EDIFICIOS-->
                                        <td><?php echo $row ["COD_AULA"];?></td>
                                        <td><?php echo $row ["COD_EDIFICIO"];?></td>
                                        <td><?php echo $row ["NOMBRE"];?></td>
                                        <td><?php echo $row ["CAPACIDAD"];?></td>
                                        <td><?php echo $row ["TIPO"];?></td>
                                        <td><?php echo $row ["PISO"];?></td>
                                        <td>
                                            <div class="text-center">
                                                <a href="GestionInfraestructura.php?modificarAula=<?php echo $row ["COD_AULA"];?>#aulasForm" class="btn btn-success" type="button">
                                                    <i class="zmdi zmdi-refresh"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <a href="GestionInfraestructura.php?eliminarAula=<?php echo $row ["COD_AULA"];?>" class="btn btn-danger" role="button">
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
                        <div class="col-xs-12 col-sm-8 col-sm-offset-2" >
                            <input type="hidden" name="codigo_aula_comparar" value="<?php echo $codigoAula ?>">
                            <div class="group-material" id="aulasForm">
                                <input type="text" class="material-control tooltips-general"
                                    placeholder="Código de Aula" required="" data-toggle="tooltip" data-placement="top"
                                    title="Escriba el código del Aula" name="codigo_aula" value="<?php echo $codigoAula ?>">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Código de Aula</label>
                            </div>
                            <div class="group-material">
                                <span style="color: #E34724;">Código del Edificio</span>
                                <select name="edificio" class="material-control tooltips-general" data-toggle="tooltip" data-placement="top"
                                data-original-title="Elige el edificio donde se encuentra el aula">
                                    <option value="" disabled="" selected="">Selecciona un edificio</option>
                                    <?php 
                                        $result3 = $infraestructura->mostrarInfraectructura($edificio);
                                        foreach($result3 as $opciones):
                                    ?>
                                    <option value="<?php echo $opciones['COD_EDIFICIO'] ?>"><?php echo $opciones['COD_EDIFICIO'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Nombre del Aula"
                                    required="" data-toggle="tooltip" data-placement="top"
                                    title="Nombre del Aula" name="nombre_aula" value="<?php echo $nombreAula ?>">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Nombre del Aula</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general"
                                    placeholder="Capacidad del aula" required="" data-toggle="tooltip" data-placement="top"
                                    title="Escriba la capacidad del aula" name="capacidad_aula" value="<?php echo $capacidadAula ?>">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Capacidad del aula</label>
                            </div>
                            <div class="group-material">
                                <span style="color: #E34724;">Tipo de Aula</span>
                                <select name="tipo_aula" class="material-control tooltips-general" data-toggle="tooltip" data-placement="top"
                                        data-original-title="Elige el tipo de aula">
                                    <option value="" disabled="" selected="">Selecciona un tipo de Aula</option>
                                    <option value="GEN">General</option>
                                    <option value="LAB">Laboratorio</option>
                                    <option value="AUD">Audivisuales</option>
                                </select>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general"
                                    placeholder="Piso del aula" required="" data-toggle="tooltip" data-placement="top"
                                    title="Escriba el piso donde se encuentra el aula" name="piso_aula" value="<?php echo $pisoAula ?>">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Piso del aula</label>
                            </div>
                            <p class="text-center">
                                <input type="submit" name="accionAula" value="<?php echo $accion ?>" class="btn btn-primary" style="margin-right: 20px;" >
                                <button type="reset" class="btn btn-info"><i
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