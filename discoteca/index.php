<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
    <link href="./css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    session_start();
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Discoteca</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Eventos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Reservas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <?php if (isset($_SESSION['username'])): ?>
            <h1>Bienvenido, <?php echo $_SESSION['username']; ?>!</h1>
        <?php else: ?>
            <h1>Bienvenido a la Discoteca</h1>
        <?php endif; ?>
        <p>¡Disfruta de nuestra música y eventos!</p>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2024 Discoteca. Todos los derechos reservados.</p>
    </footer>

</body>

</html>