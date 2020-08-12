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
    $estadoaspirante="";

    $accion="Aceptar";
    

    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: ../../index.php');
    }

    //Aspirantes
    if(isset($_POST['accionAspirantes']) && ($_POST['accionAspirantes']=='Añadir'))
    {
        $aspiranteGestion->insertarAspirantes($_POST['codigo_aspirante'],$_POST['cedula_aspirante'],$_POST['apellido_aspirante'],$_POST['nombre_aspirante'],$_POST['direccion_aspirante'],$_POST['telefono_aspirante'],$_POST['fechanacimiento_aspirante'],$_POST['genero_aspirante'],$_POST['correopersonal_aspirante']);
    }
    
    
    elseif(isset($_POST['accionAspirantesNotas']) && ($_POST['accionAspirantesNotas']=='Añadir'))
    {
        $aspiranteGestion->insertarNotasAspirantes($_POST['cod_aspirante'],$_POST['cod_nivel_educativo'],$_POST['calificacion'],$_POST['estado']);
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















                   <div class="container-flat-form">
                        
                        <div class="container-fluid">
                <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Registrar Nota Aspirantes</div>
                    <form method="post">
                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                                
                            
                             <div class="group-material">
                                    <span style="color: #E34724;"><h2>Seleccione el periodo lectivo</h2></span> 
                                    <select class="form-control" name="periodo">
                                        <option value="" disabled="" selected="">Selecciona el periodo</option>
                                            <?php 
                                                $result = $aspiranteGestion->periodo();
                                                foreach($result as $opciones):
                                            ?>
                                        <option value="<?php echo $opciones['COD_PERIODO_LECTIVO'] ?>"><?php echo $opciones['COD_PERIODO_LECTIVO'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                            </div>

                            <div class="group-material">
                                    <span style="color: #E34724;"><h2>Seleccione la asignatura</h2></span> 
                                    <select class="form-control" name="asignatura">
                                        <option value="" disabled="" selected="">Selecciona la asignatura</option>
                                            <?php 
                                                $result = $aspiranteGestion->mostrarniveleducativoAspirante($niveleducativo);
                                                foreach($result as $opciones):
                                            ?>
                                        <option value="<?php echo $opciones['COD_NIVEL_EDUCATIVO']?>|<?php echo $opciones['COD_ASIGNATURA']?>|<?php echo $opciones['COD_PARALELO']?>"><?php echo $opciones['NOMBRE'] ?>--<?php echo $opciones['COD_NIVEL_EDUCATIVO'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                            </div>
                            
                      
                                <p class="text-center">
                                    <input type="submit" name="accionCalificacion" value="<?php echo $accion ?>" class="btn btn-primary" style="margin-right: 20px;" >
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
                if(isset($_POST['accionCalificacion']) && ($_POST['accionCalificacion']=='Aceptar'))
                {
                    $valores = $_POST['asignatura'];
                    $result_explode = array_map('trim',explode('|',$valores));                    
                    $cod_nivel_educativo = $result_explode[0];
                    $cod_periodo_lectivo = $_POST['periodo'];
                    
            ?>
                    <form action="" method="post" id="registroNotas" name="registroNotas">
                    <input type="hidden" name="cod_nivel_educativo" value="<?php echo $cod_nivel_educativo ?>">
                    <input type="hidden" name="cod_periodo_lectivo" value="<?php echo $cod_periodo_lectivo ?>">
                    
            <?php
            ?>
                  
                    <div class="table-responsive">
                        <table id="tablaEstudiantesCalificaciones" class="table-striped table-bordered table-condensed" style="width: 100%;">
                               <thead class="text-center">
                                    <tr>
                                        <th>Apellido</th>
                                        <th>Nombre</th>
                                        <th>Calificacion</th>
                                    </tr>
                               </thead>
                               <tbody>
                                    <?php
                                        $contador=0;
                                        $resultCal = $aspiranteGestion->mostrarAspiranteNotas($cod_nivel_educativo,$cod_periodo_lectivo);

                                        if($resultCal->num_rows>0)
                                        {
                                            while($row = $resultCal->fetch_assoc())
                                            {     
                                    ?>
                                    <tr>
                                        <!--DATOS DE LA TABLA SEDES-->
                                        <td><?php echo $row ["APELLIDO"];?></td>
                                        <td><?php echo $row ["NOMBRE"];?></td>
                                        <td>
                                            <input type="text" name="notas[<?php echo $contador ?>][nota1]" id="nota1" value="">
                                        </td>
                                        
                                        
                                        <input type="hidden" name="cod_aspirante[]" value="<?php echo $row['COD_ASPIRANTE'] ?>">
                                    
                                    </tr>
                                    <?php   $contador ++;
                                            } 
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
                        <input type="submit" name="accionNotas" value="Hecho" class="btn btn-primary" style="margin-right: 20px;" >
                    </form>
                <?php
                } ?>              
            
        
            <?php
                    if(isset($_POST['accionNotas'])&& ($_POST['accionNotas']=='Hecho'))
                    {
                        
                        
                        $codigo_aspirante = $_POST['cod_aspirante'];
                        
                        $notas = $_POST['notas'];
                        
                        
                        foreach (array_combine($codigo_aspirante, $notas) as $aspirante => $notas) 
                        {
                            $aspiranteGestion->insertarNotasAspirantes($aspirante,$_POST['cod_nivel_educativo'],
                                                         $notas['nota1']);
                        }
                    }
            ?>

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



</body>

</html>