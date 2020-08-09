<?php
    include '../services/AsistenciasServicios.php';
    $asistencia = new AsistenciasServicios();
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
                    <li><a href="./UserDocente.html"><i class="zmdi zmdi-home zmdi-hc-fw"></i>&nbsp;&nbsp;
                            Inicio</a></li>
                    <li><a href="./UserDocenteCalificaciones.html">
                            <i class="zmdi zmdi-trending-up zmdi-hc-fw">
                            </i>&nbsp;&nbsp;
                            Calificaciones</a></li>
                    <li><a href="./UserDocenteFaltas.html">
                            <i class="zmdi zmdi-face zmdi-hc-fw">
                            </i>&nbsp;&nbsp;
                            Faltas</a></li>
                    <li><a href="./UserDocenteTareas.html">
                            <i class="zmdi zmdi-face zmdi-hc-fw">
                            </i>&nbsp;&nbsp;
                            Tareas</a></li>
                    <li><a href="./UserDocenteComunicados.html">
                            <i class="zmdi zmdi-face zmdi-hc-fw">
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
                    <span class="all-tittles"><?php  echo $_SESSION['user']['NOMBRE_USUARIO']  ?></span>
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
                <h1 class="all-tittles">EduTic <small> Docente - Asistencias</small></h1>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 lead">
                    <ol class="breadcrumb">
                        <li class="active">Asistencias</li>
                    </ol>
                </div>
            </div>
        </div>

        <section class="full-reset text-center" style="padding: 40px 0;">

            <div class="container-fluid">
                <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Registrar Asistencias</div>
                    <form method="post">
                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                                
                            <div class="group-material">
                                    <span style="color: #E34724;"><h2>Seleccione el periodo lectivo</h2></span> 
                                    <select class="form-control" name="periodo">
                                        <option value="" disabled="" selected="">Selecciona el periodo</option>
                                            <?php 
                                                $result = $asistencia->periodo();
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
                                                $result = $asistencia->docenteAsistencia($cod_docente);
                                                foreach($result as $opciones):
                                            ?>
                                        <option value="<?php echo $opciones['COD_NIVEL_EDUCATIVO']?>|<?php echo $opciones['COD_ASIGNATURA']?>|<?php echo $opciones['COD_PARALELO']?>"><?php echo $opciones['NOMBRE'] ?>--<?php echo $opciones['COD_NIVEL_EDUCATIVO'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                            </div>

                            <div class="group-material">
                                    <span style="color: #E34724;"><h2>Seleccione el quimestre</h2></span> 
                                    <select class="form-control" name="quimestre">
                                        <option value="" disabled="" selected="">Selecciona el quimestre</option>
                                        <option value="PROMEDIOQ1">Primer Quimestre</option>
                                        <option value="PROMEDIOQ2">Segundo Quimestre</option>
                                    </select>
                            </div>
                                <p class="text-center">
                                    <input type="submit" name="accionAsistencia" value="<?php echo $accion ?>" class="btn btn-primary" style="margin-right: 20px;" >
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
                if(isset($_POST['accionAsistencia']) && ($_POST['accionAsistencia']=='Aceptar'))
                {
                    $valores = $_POST['asignatura'];
                    $result_explode = array_map('trim',explode('|',$valores));                    
                    $cod_nivel_educativo = $result_explode[0];
                    $cod_asignatura = $result_explode[1];
                    $cod_paralelo = $result_explode[2];
                    $cod_periodo_lectivo = $_POST['periodo'];
            ?>
                    <form action="" method="post" id="registroAsistencia" name="registroAsistencia">
                        <input type="hidden" name="cod_nivel_educativo" value="<?php echo $cod_nivel_educativo ?>">
                        <input type="hidden" name="cod_asignatura" value="<?php echo $cod_asignatura ?>">
                        <input type="hidden" name="cod_paralelo" value="<?php echo $cod_paralelo ?>">
                        <input type="hidden" name="cod_periodo_lectivo" value="<?php echo $cod_periodo_lectivo ?>">
            <?php
            ?>
                  
                    <div class="table-responsive">
                        <table id="tablaEstudiantesAsistencias" class="table-striped table-bordered table-condensed" style="width: 100%;">
                               <thead class="text-center">
                                    <tr>
                                        <th>Apellido</th>
                                        <th>Nombre</th>
                                        <th>Asistencia</th>
                                        <th>Falta Justificada</th>
                                        <th>Falta Injustificada</th>
                                    </tr>
                               </thead>
                               <tbody>
                                    <?php
                                        $contador=0;
                                        $result = $asistencia->listarEstudiantes($cod_nivel_educativo);
                                        if($result->num_rows>0)
                                        {
                                            while($row = $result->fetch_assoc())
                                            {     
                                    ?>
                                    <tr>
                                        <!--DATOS DE LA TABLA ASISTENCIAS-->
                                        <td><?php echo $row ["APELLIDO"];?></td>
                                        <td><?php echo $row ["NOMBRE"];?></td>
                                        <td>
                                            <input type="radio" name="asistencias[<?php echo $contador ?>][asistencia]" id="asistencia" value="">
                                        </td>
                                        <td>
                                            <input type="radio" name="asistencias[<?php echo $contador ?>][justificada]" id="justificada" value="">
                                        </td>
                                        <td>
                                            <input type="radio" name="asistencias[<?php echo $contador ?>][injustificada]" id="injustificada" value="">
                                        </td>
                                        <input type="hidden" name="cod_alumno[]" value="<?php echo $row['COD_PERSONA'] ?>">
                                    </tr>
                                    <?php   $contador ++;
                                            } 
                                        } 
                                        else
                                        {
                                    ?>
                                    <tr>
                                        <td colspan="5">NO HAY DATOS EN LA TABLA</td>
                                    </tr>        
                                    <?php } ?>
                                </tbody> 
                            </table>
                        </div>
                        <input type="submit" name="accionAsis" value="Hecho" class="btn btn-primary" style="margin-right: 20px;" >
                    </form>
                <?php
                } ?>              
            
        
            <?php
                    if(isset($_POST['accionAsis'])&& ($_POST['accionAsis']=='Hecho'))
                    {
                        $codigo_alumno = $_POST['cod_alumno'];
                        $asistencias = $_POST['asistencias'];
                        foreach (array_combine($codigo_alumno, $asistencias) as $alumno => $asistencias) 
                        {
                            $asistencia->ingresarAsistencia($_POST['cod_periodo_lectivo'],$alumno,$_POST['cod_nivel_educativo'],
                                                         $_POST['cod_asignatura'],$asistencias['asistencia'],
                                                         $asistencias['justificada'],$asistencias['injustificada']);
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