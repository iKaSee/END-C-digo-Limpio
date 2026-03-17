<link rel="stylesheet" href="css/results.css">
<?php
// Obtiene el parámetro 'expr' de la URL (buscar)
$busqueda = $_GET["expr"];

// Conexión con la BBDD
require_once("db/Conexion_MySQL.php");
$gestorBD  = new BaseDatos();
$baseDatos = $gestorBD ->Conexion();

// Tabla de la BBDD
$tablaBD='steam_games';

// Se realiza la consulta a la BBDD
$consulta = "SELECT * FROM $tablaBD WHERE app_name LIKE :e OR developer_name LIKE :e2 OR publisher_name LIKE :e3";
$resultado = $baseDatos->prepare($consulta);
$resultado->execute(array(":e" => "%$busqueda%", ":e2" => "%$busqueda%", ":e3" => "%$busqueda%"));

// Procesamiento de los datos y generación del contenido de salida
$total = $resultado->rowCount();

if ($total>0){ // Caso 1: Se han encontrado coincidencias en la base de datos

    print "<div class='header-fijo'><h2>Tenemos $total resultados para <b>$busqueda</b></h2></div>\n";

    print "<div class='scroll-resultados'><table>";
    print "<tr><th>Nombre</th><th>Desarrollador</th><th>Reviews positivas</th></tr>";
// Recorremos el conjunto de resultados para listar los juegos encontrados
    foreach( $resultado as $valor){
        print "<tr><td>".$valor["app_name"]."</td> <td>".$valor["developer_name"]."</td> <td>".$valor["positive_reviews"]."</td></tr>";
    }
    print "</table></div>";

}
else// Caso 2: la busqueda no ha encontrado resultados:
{
	print "<h2>No hay resultados para <b>$busqueda</b></h2>\n";
}

//Cerramos conexión para liberar recursos
$baseDatos=NULL;
?>