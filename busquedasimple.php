<?php
// Obtiene el parámetro 'expr' de la URL (buscar)
$busqueda = $_GET["expr"];

// Conexión con la BBDD
require_once("db/Conexion_MySQL.php");
$gestorBD  = new BaseDatos();
$baseDatos = $gestorBD ->Conexion();

// Tabla de la BBDD
$tablaBD='noticiasFTInnodb';

// Se realiza la consulta a la BBDD
$consulta = "SELECT * FROM $tablaBD WHERE MATCH(titulo, cuerpo) AGAINST (:e)";
$resultado = $baseDatos->prepare($consulta);
$resultado->execute(array(":e" => $busqueda));

// Procesamiento de los datos y generación del contenido de salida
$total = $resultado->rowCount();

if ($total>0){ // Caso 1: Se han encontrado coincidencias en la base de datos

    print "<h2>Tenemos $total resultados para <b>$busqueda</b></h2>\n";

    print "<ol>";
// Recorremos el conjunto de resultados para listar los títulos encontrados
    foreach( $resultado as $valor){
        print "<li>".$valor["titulo"]."</li>";
    }
    print "</ol>";

}
else// Caso 2: la busqueda no ha encontrado resultados:
{ 
	print "<h2>No hay resultados para <b>$busqueda</b></h2>\n";
}

//Cerramos conexión para liberar recursos
$baseDatos=NULL;
?>