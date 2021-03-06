<?php
    include '../services/RolServicios.php';
    $rol = new RolServicios();
    $cedula="";
 
    $user="";
    $password="";
    $errors = '';
    session_start();
    

    $cod_docente=$_SESSION['user']['COD_PERSONA'];
    if (!isset($_SESSION['user'])) {
        header('Location: ../../index.php');
    }

    if(isset($_GET['encontrarPersona']))
    {
        $cedula=$_GET['cedula'];
    }

    $accion="Aceptar";
   
    $fecha = date("Y-m-d H:i:s"); // 2001-03-10 17:16:18 (el formato DATETIME de MySQL)
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
                
                    <li>
                        <div class="dropdown-menu-button"><i class="zmdi zmdi-account-circle zmdi-hc-fw"></i>&nbsp;&nbsp; Gestión de Personas<i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i></div>
                        <ul class="list-unstyled">
                            <li><a href="./GestionPersonal.php"><i class="zmdi zmdi-accounts zmdi-hc-fw"></i>&nbsp;&nbsp;
                                    Gestion Personal</a></li>
                            <li><a href="./GestionEstudiantes.php"><i class="zmdi zmdi-accounts zmdi-hc-fw"></i>&nbsp;&nbsp;
                                    Gestion Estudiantes</a></li>
                        </ul>
                    </li>
                    <li><a href="./GestionRol.php"><i class="zmdi zmdi-home zmdi-hc-fw">
                            </i>&nbsp;&nbsp; Gestion de Roles</a></li>
                    <li><a href="./GestionPersonaReporte.php">
                            <i class="zmdi zmdi-trending-up zmdi-hc-fw">
                            </i>&nbsp;&nbsp; Reportes Personas</a></li>
                    <li><a href="./GestionEstado.php">
                            <i class="zmdi zmdi-account-add zmdi-hc-fw">
                            </i>&nbsp;&nbsp; Gestion de Estado</a></li>


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
                    <span class="all-tittles">Super Usuario - <?php  echo $_SESSION['user']['NOMBRE_USUARIO']  ?></span>
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
                <h1 class="all-tittles">EduTic <small> Super Usuario - Gestion de Roles</small></h1>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 lead">
                    <ol class="breadcrumb">
                        <li class="active">Asignación de Roles por Persona</li>
                    </ol>
                </div>
            </div>
        </div>

        <section class="full-reset text-center" style="padding: 40px 0;">

        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">
                    <a href="#asignaturas" class="btn btn-lg" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="asignaturas" style="margin-right: 20px; color:white;">Ingrese la cédula de la persona</a>
                </div>
                <div class="row">
                    <div class="grou-material col-md-4 mb-5"></div>
                    <form action="" method="get">
                            <div class="row">
                                <div class="group-material col-md-4 mb-5">
                                    <input type="text" class="material-control" placeholder="Cedula de la persona" required="" 
                                        data-toggle="tooltip" data-placement="top" title="Escriba la cédula de la persona a buscar" 
                                        name="cedula">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label for="cedula" class="col-md-6">Cédula de la Persona</label><br>  
                                    <input type="submit" value="Aceptar" name="encontrarPersona">
                                </div>
                            </div>
                    </form>
                </div>
                
            <form action="" method="post" id="gestionRol" name="gestionRol">

                    <input type="hidden" name="cod_periodo_lectivo" value="<?php echo $cod_periodo_lectivo ?>">


                <div class="row container-flat-form">
                        <div class="table-responsive">
                            <table id="tablaPersonas" class="table-striped table-bordered table-condensed" style="width: 100%;">
                               <thead class="text-center">
                                    <tr>
                                        <th>Cédula de la persona</th>
                                        <th>Apellidos</th>
                                        <th>Nombres</th>
                                        <th>Asignar Rol</th>
                                        <th>Nombre Usuario</th>
                                        <th>Clave</th>
                                        <th>Estado</th>
                                    </tr>
                               </thead>
                               <tbody>
                                    <?php
                                        $result = $rol->mostrarPersonaCedula($cedula);
                                        if($result->num_rows>0)
                                        {
                                            while($row = $result->fetch_assoc())
                                            {     
                                    ?>
                                    <tr>
                                        <!--DATOS DE LA TABLA EDIFICIOS-->
                                        <td><?php echo $row ["CEDULA"];?></td>
                                        <td><?php echo $row ["APELLIDO"];?></td>
                                        <td><?php echo $row ["NOMBRE"];?></td>
                                        <td> 
                                            <div class="form-group row col-sm-12" id="roles">
                                                <select class="form-control" name="rol">
                                                    <option value="" disabled="" selected="">Selecciona un Rol</option>
                                                    <option value="2">Directivo</option>
                                                    <option value="3">Administrativo</option>
                                                    <option value="4">Docente</option>
                                                    <option value="5">Alumno</option>
                                                    <option value="6">Representante</option>
                                                </select>

                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="user[<?php echo $contador ?>][user]" id="user" value="">
                                        </td>
                                        <td>
                                            <input type="text" name="password[<?php echo $contador ?>][password]" id="password" value="">
                                        </td>
                                        <td> 
                                            <div class="form-group row col-sm-12" id="estados">
                                                <select class="form-control" name="estado">
                                                    <option value="" disabled="" selected="">Selecciona un Estado</option>
                                                    <option value="ACT">ACTIVO</option>
                                                    <option value="INA">INACTIVO</option>
                                                </select>

                                            </div>
                                        </td>
                                    </tr>
                                    <?php   } 
                                        } 
                                        else
                                        {
                                    ?>
                                    <tr>
                                        <td colspan=7>No hay datos en la tabla</td>
                                    </tr>        
                                    <?php } ?>
                                </tbody> 
                            </table>
                        </div>
                        <br>
                        <input type="submit" name="accionRoles" value="Hecho" class="btn btn-primary" style="margin-right: 20px;" >
                    </div>
                </form>                                            
            <?php
                    
                    if(isset($_POST['accionRoles'])&& ($_POST['accionRoles']==2)){
                        $errors .= "EL USUARIO YA EXISTE";
                        
                    }else if (isset($_POST['accionRoles'])&& ($_POST['accionRoles']=='Hecho'))
                    {
                        
                        $cod_persona = $_POST['cod_persona'];
                        $rol = $_POST['rol'];
                        $user = $_POST['user'];
                        $password = $_POST['password'];
                        $estado = $_POST['estado']; 

                        foreach (array_combine($cod_persona, $rol) as $persona => $rol) 
                        {
                            $rol->ingresarRol($rol['estado'],$persona,$user['user'],$password['password'],$estado['estado']);
                        }
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

</html>