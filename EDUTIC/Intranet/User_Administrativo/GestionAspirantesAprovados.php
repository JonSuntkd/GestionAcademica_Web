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
    
    //Aspirantes
    if(isset($_POST['accionAspirantes']) && ($_POST['accionAspirantes']=='Añadir'))
    {
        $aspiranteGestion->insertarAspirantes($_POST['codigo_aspirante'],$_POST['cedula_aspirante'],$_POST['apellido_aspirante'],$_POST['nombre_aspirante'],$_POST['direccion_aspirante'],$_POST['telefono_aspirante'],$_POST['fechanacimiento_aspirante'],$_POST['genero_aspirante'],$_POST['correopersonal_aspirante']);
    }
    
    
    elseif(isset($_POST['accionAspirantesNotas']) && ($_POST['accionAspirantesNotas']=='Añadir'))
    {
        $aspiranteGestion->insertarNotasAspirantes($_POST['cod_aspirante'],$_POST['cod_nivel_educativo'],$_POST['calificacion'],$_POST['estado']);
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
                    <li><a href="./userAdministrativo.html"><i class="zmdi zmdi-home zmdi-hc-fw"></i>&nbsp;&nbsp;
                            Inicio</a></li>
                    
                    <!--ASPIRANTES-->
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
                <div class="title-flat-form title-flat-blue">Listado de Aspirantes</div>
                <form id="aspirantes" method="post">
                    <div class="row container-flat-form">
                        <div class="table-responsive">
                            <table id="tablaAspirantes" class="table-striped table-bordered table-condensed" style="width: 100%;">
                               <thead class="text-center">
                                    <tr>
                                        <th>NIVEL</th>
                                        <th>ASPIRANTE</th>
                                        <th>CALIFICACION</th>
                                        <th>ESTADO</th>
                                        
                                    </tr>
                               </thead>
                               <tbody>
                                    <?php
                                        $result = $aspiranteGestion->mostrarAspiranteCalificacione();
                                        if($result->num_rows>0)
                                        {
                                            while($row = $result->fetch_assoc())
                                            {     
                                        ?>
                                         <tr>
                                        <!--DATOS DE LA TABLA Aspirante-->
                                            <td><?php echo $row ["COD_NIVEL_EDUCATIVO"];?></td>
                                            <td><?php echo "{$row ["NOMBRE"]} ",$row ["APELLIDO"];?></td>
                                            <td><?php echo $row ["CALIFICACION"];?></td>
                                            <td><?php echo $row ["ESTADO"];?></td>
                                            <td>
                                            
                                            </td>
    <input type="hidden" name="cedula[]" value="<?php echo $row['CEDULA'] ?>">
    <input type="hidden" name="apellido[]" value="<?php echo $row['APELLIDO'] ?>">
    <input type="hidden" name="direccion[]" value="<?php echo $row['DIRECCION'] ?>">
    <input type="hidden" name="telefono[]" value="<?php echo $row['TELEFONO'] ?>">
    <input type="hidden" name="fecha_nacimiento[]" value="<?php echo $row['FECHA_NACIMIENTO'] ?>">
    <input type="hidden" name="genero[]" value="<?php echo $row['GENERO'] ?>">
    <input type="hidden" name="correo_personal[]" value="<?php echo $row['CORREO_PERSONAL'] ?>">
    

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




<div class="container-fluid">
                
           

</body>

</html>