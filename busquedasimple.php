<?php

$expressio = $_GET["expr"];

require_once("Conexion_MySQL.php");
$dbClass = new Database();
$db = $dbClass->getConnection();

$dbTabla='noticiasFTInnodb';

$consulta = "SELECT * FROM $dbTabla WHERE MATCH(titulo, cuerpo) AGAINST (:e)"; 
$result = $db->prepare($consulta); 
$result->execute(array(":e" => $expressio));

//Processament + output
$total = $result->rowCount();
if ($total>0){ //Tenim resultats per la cerca
	print "<h2>Tenemos $total de resultados para <b>$expressio</b> en la bbdd </h2>\n";
	print "<ol>";
	foreach( $result as $valor){
		print "<li>".$valor["titulo"]."</li>";
	} 
	print "</ol>";
}else{ // No hi ha resultats per la cerca
	print "<h2>No hay resultados para <b>$expressio</b> en la bbdd </h2>\n";
}
//Cerramos conexión
$db=NULL;
?>