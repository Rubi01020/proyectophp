<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['rol']) || ($_SESSION['rol'] !== 'admin' && $_SESSION['rol'] !== 'empleado')) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];
        $nombre = $_POST['nombre'] ?? '';
        $fecha = $_POST['fecha'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $id = $_POST['id'] ?? null;

        if ($accion === 'alta') {
            $query = "INSERT INTO eventos (nombre_evento, fecha_evento, precio_entrada, descripcion) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sss", $nombre, $fecha, $descripcion);
            $stmt->execute();
        } elseif ($accion === 'baja' && $id) {
            $query = "DELETE FROM eventos WHERE id_evento = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
        } elseif ($accion === 'modificacion' && $id) {
            $query = "UPDATE eventos SET nombre_evento = ?, fecha_evento = ?, precio_entrada = ?, descripcion = ?  WHERE id_evento = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssi", $nombre, $fecha, $descripcion, $id);
            $stmt->execute();
        }
        header('Location: gestion_eventos.php');
        exit();
    }
}

$result = $conn->query("SELECT * FROM eventos");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Eventos</title>
    <link rel="stylesheet" href="styles2.css">
</head>

<body>
    <div class="container">
        <h1>Gestión de Eventos</h1>

        <h2>Alta de Evento</h2>
        <form action="gestion_eventos.php" method="POST">
            <input type="hidden" name="accion" value="alta">
            <label>Nombre: <input type="text" name="nombre" required></label><br>
            <label>Fecha: <input type="date" name="fecha" required></label><br>
            <label>Descripción: <textarea name="descripcion" required></textarea></label><br>
            <button type="submit">Crear Evento</button>
        </form>

        <h2>Lista de Eventos</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
            <?php while ($evento = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $evento['id'] ?></td>
                    <td><?= htmlspecialchars($evento['nombre']) ?></td>
                    <td><?= $evento['fecha'] ?></td>
                    <td><?= htmlspecialchars($evento['descripcion']) ?></td>
                    <td>
                        <form action="gestion_eventos.php" method="POST" style="display:inline;">
                            <input type="hidden" name="accion" value="baja">
                            <input type="hidden" name="id" value="<?= $evento['id'] ?>">
                            <button type="submit">Eliminar</button>
                        </form>

                        <form action="gestion_eventos.php" method="POST" style="display:inline;">
                            <input type="hidden" name="accion" value="modificacion">
                            <input type="hidden" name="id" value="<?= $evento['id'] ?>">
                            <input type="text" name="nombre" value="<?= htmlspecialchars($evento['nombre']) ?>" required>
                            <input type="date" name="fecha" value="<?= $evento['fecha'] ?>" required>
                            <textarea name="descripcion" required><?= htmlspecialchars($evento['descripcion']) ?></textarea>
                            <button type="submit">Modificar</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>

</html>