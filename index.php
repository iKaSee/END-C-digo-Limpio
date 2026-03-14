<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The News Archive | Buscador</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <h1>Buscador</h1>
    <p class="subtitle">Archivo Digital de Noticias</p>

    <form class="search-container" method="get" action="busquedasimple.php" target="resultados">
        <input type="text" name="expr" class="search-input" placeholder="Buscar titulares, temas..." required>
        
        <button type="submit" class="search-button" aria-label="Buscar">
            <svg viewBox="0 0 24 24">
                <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
            </svg>
        </button>
    </form>

    <div class="results-wrapper">
        <iframe name="resultados" frameborder="0"></iframe>
    </div>

</body>
</html>