<?php 
    include '../services/ReporteExcelServicios.php';
    $personaGestion = new ReporteExcelServicios();

 

    if(isset($_POST['generar_reporte']))
{
	// NOMBRE DEL ARCHIVO Y CHARSET
	header('Content-Type:text/csv; charset=latin1');
	header('Content-Disposition: attachment; filename="Reporte_Persona.csv"');

	// SALIDA DEL ARCHIVO
	$salida=fopen('php://output', 'w');
	// ENCABEZADOS
	fputcsv($salida, array('Codigo Persona', 'Cedula', 'Apellido', 'Nombre', 'Direccion', 'Telefono', 'Fecha de nacimiento', 'Genero', 'Correo', 'Correo Personal'));
	// QUERY PARA CREAR EL REPORTE
    
    
    $reporteCsv = $personaGestion->persona();
    
    while($filaR= $reporteCsv->fetch_assoc())
		fputcsv($salida, array($filaR['COD_PERSONA'], 
								$filaR['CEDULA'],
								$filaR['APELLIDO'],
                                $filaR['NOMBRE'],
   								$filaR['DIRECCION'],
								$filaR['TELEFONO'],
								$filaR['FECHA_NACIMIENTO'],
	                            $filaR['GENERO'],
								$filaR['CORREO'],
								$filaR['CORREO_PERSONAL']));
    
        
}

?>
