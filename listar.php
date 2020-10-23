<?php

require 'conexion.php';
$conexion = conectarBD();

$query = "SELECT tb_inscripto.dni as dni,
				 tb_inscripto.apellido as apellido,
				 tb_inscripto.nombreinscripto as nombre,
				 tb_inscripto.email as email,
				 tb_inscripto.telefono as telefono,
				 tb_cursoinscripto.nombrecurso as curso,
				 tb_localidad.nombrelocalidad as localidad,
				 tb_inscriptoxcurso.fecha as fecha
		  FROM 
				 tb_cursoinscripto
		  INNER JOIN tb_inscriptoxcurso
		  ON tb_inscriptoxcurso.curso = tb_cursoinscripto.idcurso 
		  INNER JOIN tb_inscripto 
		  ON tb_inscripto.dni = tb_inscriptoxcurso.inscripto 
		  INNER JOIN tb_localidad 
		  ON tb_localidad.idlocalidad = tb_inscripto.localidad";

$resultado = pg_query($conexion, $query);

	$i=0;
	$tabla = "";
	while($row = pg_fetch_array($resultado))
	{
		$i++;
		$tabla.='{"dni":"'.$row['dni'].'","apellido":"'.strtoupper($row['apellido']).'","nombre":"'.strtoupper($row['nombre']).'","email":"'.strtoupper($row['email']).'","telefono":"'.strtoupper($row['telefono']).'","curso":"'.strtoupper($row['curso']).'","localidad":"'.strtoupper($row['localidad']).'","fecha":"'.strtoupper($row['fecha']).'"},';
	}
	$tabla = substr($tabla,0, strlen($tabla) - 1);
    echo '{"data":['.$tabla.']}';

pg_close($conexion);