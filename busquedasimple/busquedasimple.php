<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Resultats de cerca</title>
</head>
<?
require_once("conexion_pdo.php");
$expressio = $_GET["expr"];
?>
<body>
<form method="get" action="busquedasimple.php">
<label>Cerca<input type="text" name="expr" value="<?PHP echo $expressio; ?>"></label>
<input type="submit" value="cerca!">
</form>

<?PHP
$db = new Conexion();
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
</body>
</html>