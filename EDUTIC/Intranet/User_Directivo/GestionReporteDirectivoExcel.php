<?php 
    include '../services/ReporteExcelServicios.php';
    $personaGestion = new ReporteExcelServicios();

 

    if(isset($_POST['generar_reporte']))
{
	// NOMBRE DEL ARCHIVO Y CHARSET
	header('Content-Type:text/csv; charset=latin1');
	header('Content-Disposition: attachment; filename="Reporte_Directivos.csv"');

	// SALIDA DEL ARCHIVO
	$salida=fopen('php://output', 'w');
	// ENCABEZADOS
	fputcsv($salida, array('Apellido', 'Nombre', 'Estado', 'Fecha inicio'));
	// QUERY PARA CREAR EL REPORTE
    
    
    $reporteCsv = $personaGestion->directivos();
    
    while($filaR= $reporteCsv->fetch_assoc())
		fputcsv($salida, array($filaR['APELLIDO'], 
								$filaR['NOMBRE'],
								$filaR['ESTADO'],
                                $filaR['FECHA_INICIO']
   								));
    
        
}

?>
