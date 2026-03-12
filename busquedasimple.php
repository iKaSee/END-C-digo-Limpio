<?php
$expressio = $_GET["expr"];
require_once("conexion_pdo.php");
$dbClass = new Database();
$db = $dbClass->getConnection();
$dbTabla='noticiasFTInnodb';

$consulta = "SELECT COUNT(*) FROM $dbTabla WHERE MATCH(titulo, cuerpo) AGAINST (:e)";
$result = $db->prepare($consulta);
$result->execute(array(":e" => $expressio)); 

//Processament + output
$total = $result->fetchColumn();
if ($total>0){ //Tenim resultats per la cerca
	print "<h2>Tenemos $total de resultados para <b>$expressio</b> en la bbdd </h2>\n";
	//Fi Processament

	// En tres líneas 
	$consulta = "SELECT * FROM $dbTabla WHERE MATCH(titulo, cuerpo) AGAINST (:e)"; 
	$result = $db->prepare($consulta); 
	$result->execute(array(":e" => $expressio));

	//Processament + output
	if (!$result){ 
		print "<p> Error en la consulta. </p>\n";
	}else{ 
		print "<ol>";
		foreach( $result as $valor){
			print "<li>".$valor["titulo"]."</li>";
		} 
		print "</ol>";
	}
	//Fi Processament
}else{// No hi ha resultats per la cerca
	print "<h2>No hay resultados para <b>$expressio</b> en la bbdd </h2>\n";
}
//Cerramos conexión
$db=NULL;
?>