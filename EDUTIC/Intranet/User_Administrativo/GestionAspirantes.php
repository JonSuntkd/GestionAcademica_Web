<?php 
    include '../services/AspiranteServicios.php';
    $aspiranteGestion = new AspiranteServicios();
    $aspirante="aspirante";
    $niveleducativo="nivel_educativo";

    $codigoAspirante = "";
    $nombreAspirante="";
    $cedulaAspirante="";
    $apellidoAspirante="";
    $direccionAspirante="";
    $telefonoAspirante="";
    $fechanacimientoAspirante="";
    $correopersonalAspirante="";
    
    $calificacionAspirante="";
    

    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: ../../index.php');
    }

    $accion="Añadir";
    
    //Aspirantes
    if(isset($_POST['accionAspirantes']) && ($_POST['accionAspirantes']=='Añadir'))
    {
        $aspiranteGestion->insertarAspirantes($_POST['codigo_aspirante'],$_POST['codigo_periodo_lectivo'],$_POST['cod_nivel'],$_POST['cedula_aspirante'],$_POST['apellido_aspirante'],$_POST['nombre_aspirante'],$_POST['direccion_aspirante'],$_POST['telefono_aspirante'],$_POST['fechanacimiento_aspirante'],$_POST['genero_aspirante'],$_POST['correopersonal_aspirante']);
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
    else if(isset($_GET['eliminarAspirante']))
    {
        $aspiranteGestion->eliminarAspirante($_GET['eliminarAspirante']);
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


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
                        <a href="./GestionAspirantes.php"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i>&nbsp;&nbsp;Aspirantes Registro</a> 
                    </li>

                    <li>
                        <a href="./GestionAspiranteCalificaciones.php"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i>&nbsp;&nbsp;Registro de Calificaciones Aspirantes</a> 
                    </li>
                    <li>
                        <a href="./GestionAspirantesAprovados.php"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i>&nbsp;&nbsp;Aspirantes Aprovados</a> 
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
                <h1 class="all-tittles">EduTic <small> - Gestión de Aspirantes</small></h1>
            </div>
        </div>

        <div class="container-fluid">
            <ul class="nav nav-tabs nav-justified" style="font-size: 17px;">
                <li role="presentation" class="active"><a href="admininstitution.php">Aspirante</a></li>
            </ul>
        </div>

        <div class="container-fluid" style="margin: 50px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="../assets/img/user01.png" alt="user" class="img-responsive center-box mCS_img_loaded" style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    <p style="margin-left: 100px;">Ingrese la información del aspirante</p> 
                </div>
            </div>
        </div>


        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">
                    <a href="#aspirante" class="btn btn-lg" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="aspirantes" style="margin-right: 20px; color:white;">Datos del Aspitente</a>
                </div>
                <form id="aspirantes" method="post">
                    <div class="row container-flat-form">
                        <br><br>
                        <div class="col-xs-12 col-sm-8 col-sm-offset-2" >
                            <div class="group-material" id="aspirantesForm">
                                <input type="text" class="material-control tooltips-general"
                                    placeholder="Código de aspirante" required="" data-toggle="tooltip" data-placement="top"
                                    title="Escriba el código del Aula" name="codigo_aspirante" value="<?php echo $codigoAspirante ?>">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Código de Aspirante</label>
                            </div>
                            <div class="group-material" id="aspirantesForm">
                                <input type="text" class="material-control tooltips-general"
                                    placeholder="Cedula de aspirante" required="" data-toggle="tooltip" data-placement="top"
                                    title="Escriba el numero de cedula" name="cedula_aspirante" value="<?php echo $cedulaAspirante ?>">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Cedula</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general"
                                    placeholder="Apellido" required="" data-toggle="tooltip" data-placement="top"
                                    title="Escriba su apellido" name="apellido_aspirante" value="<?php echo $apellidoAspirante ?>">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Apellidos</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general"
                                    placeholder="Nombre" required="" data-toggle="tooltip" data-placement="top"
                                    title="Escriba su nombre" name="nombre_aspirante" value="<?php echo $nombreAspirante ?>">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Nombres</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general"
                                    placeholder="Direccion" required="" data-toggle="tooltip" data-placement="top"
                                    title="Escriba su direccion" name="direccion_aspirante" value="<?php echo $direccionAspirante ?>">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Direccion</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general"
                                    placeholder="Telefono" required="" data-toggle="tooltip" data-placement="top"
                                    title="Escriba su numero de telefono" name="telefono_aspirante" value="<?php echo $telefonoAspirante ?>">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Telefono</label>
                            </div>
                            <div class="group-material">
                                <label for="start">Fechas de Nacimiento:</label>
                                <br></br>
                                <input type="date" id="start" name="fechanacimiento_aspirante" value="2020-01-01" min="1020-01-01"
                                    max="2020-12-31">
                                <p class="text-center">
                            </div>
                            <div class="group-material">
                                <span style="color: #E34724;">Genero</span>
                                <select name="genero_aspirante" class="material-control tooltips-general" data-toggle="tooltip" data-placement="top"
                                        data-original-title="Elige el genero">
                                    <option value="" disabled="" selected="">Selecciona un genero</option>
                                    <option value="MAS">Masculino</option>
                                    <option value="FEM">Femenino</option>
                                </select>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general"
                                    placeholder="Correo Personal" required="" data-toggle="tooltip" data-placement="top"
                                    title="Escriba el correo personal" name="correopersonal_aspirante" value="<?php echo $correopersonalAspirante ?>">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Correo personal</label>
                            </div>

                       

                            <div class="group-material">
                                    <span style="color: #E34724;">Seleccione el periodo lectivo</span> 
                                    <select name="codigo_periodo_lectivo" class="material-control tooltips-general" data-toggle="tooltip" data-placement="top"
                                                             data-original-title="Elige el genero">
                                                            <option value="" disabled="" selected="">Selecciona un periodo</option>
                                                                  <?php
                                                                    $result = $aspiranteGestion->periodo();
                                                                        if($result->num_rows>0)
                                                                        {
                                                                             while($row = $result->fetch_assoc())
                                                                        { 
                                                                    ?>
                                                            <option value="<?php echo $row ["COD_PERIODO_LECTIVO"];?>"><?php echo "{$row ["COD_PERIODO_LECTIVO"]} ";?></option>
                                                                  <?php } ?>
                                                                        } 
                                                                        else
                                                                        {
                                                                        ?>
                                                                            
                                                                  <?php } 
                                                                 
                                                                  ?>
                                                </select>
                            </div>



                                <div class="group-material">
                                <span style="color: #E34724;">Nivel Educativo</span>
                            
                                                <select name="cod_nivel" class="material-control tooltips-general" data-toggle="tooltip" data-placement="top"
                                                             data-original-title="Elige el genero">
                                                            <option value="" disabled="" selected="">Selecciona un nuvel educativo</option>
                                                                  <?php
                                                                    $resultNivel = $aspiranteGestion->mostrarniveleducativoAspirante($niveleducativo);
                                                                        if($resultNivel->num_rows>0)
                                                                        {
                                                                             while($row = $resultNivel->fetch_assoc())
                                                                        { 
                                                                    ?>
                                                            <option value="<?php echo $row ["COD_NIVEL_EDUCATIVO"];?>"><?php echo "{$row ["NOMBRE"]} ";?></option>
                                                                  <?php } ?>
                                                                        } 
                                                                        else
                                                                        {
                                                                        ?>
                                                                            
                                                                  <?php } 
                                                                 
                                                                  ?>
                                                </select>
                                </div>


                            <p class="text-center">
                                <input type="submit" name="accionAspirantes" value="<?php echo $accion ?>" class="btn btn-primary" style="margin-right: 20px;" >
                                <button type="reset" class="btn btn-info"><i
                                        class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar</button>
                            </p>
                        </div>                        
                    </div>
                </form>
            </div>
        </div>


        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">Listado de Aspirantes</div>
                <form id="aspirantes" method="post">
                    <div class="row container-flat-form">
                        <div class="table-responsive">
                            <table id="tablaAspirantes" class="table-striped table-bordered table-condensed" style="width: 100%;">
                               <thead class="text-center">
                                    <tr>
                                        <th>Código</th>
                                        <th>Apellido</th>
                                        <th>Nombre</th>
                                        <th>Correo personal</th>
                                        <th>Eliminar</th>
                                    </tr>
                               </thead>
                               <tbody>
                                    <?php
                                        $result = $aspiranteGestion->mostrarAspirante($aspirante);
                                        if($result->num_rows>0)
                                        {
                                            while($row = $result->fetch_assoc())
                                            {     
                                        ?>
                                         <tr>
                                        <!--DATOS DE LA TABLA Aspirante-->
                                            <td><?php echo $row ["COD_ASPIRANTE"];?></td>
                                            <td><?php echo $row ["APELLIDO"];?></td>
                                            <td><?php echo $row ["NOMBRE"];?></td>
                                            <td><?php echo $row ["CORREO_PERSONAL"];?></td>
                                            <td>
                                            <div class="text-center">
                                                <a href="GestionAspirantes.php?eliminarAspirante=<?php echo $row ["COD_ASPIRANTE"];?>#aspirantesForm" class="btn btn-danger" role="button">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </a>
                                            </div>
                                            </td>
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