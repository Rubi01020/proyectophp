<?php
session_start();
require_once 'config.php';

// Consultar eventos próximos
$result = $conn->query("SELECT * FROM eventos WHERE fecha >= CURDATE() ORDER BY fecha ASC");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Próximos Eventos</title>
    <link rel="stylesheet" href="styles1.css">
</head>

<body>
    <div class="container">
        <h1>Próximos Eventos en Aurora Club</h1>
        <?php if ($result->num_rows > 0): ?>
            <ul>
                <?php while ($evento = $result->fetch_assoc()): ?>
                    <li>
                        <h2><?= htmlspecialchars($evento['nombre']) ?></h2>
                        <p><strong>Fecha:</strong> <?= $evento['fecha'] ?></p>
                        <p><strong>Descripción:</strong> <?= htmlspecialchars($evento['descripcion']) ?></p>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No hay eventos próximos.</p>
        <?php endif; ?>
    </div>
</body>

</html>