<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registro</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="process_register.php" method="post">
                    <h2>Registro</h2>
                    <div class="inputbox">
                        <ion-icon name="person-outline"></ion-icon>
                        <input type="text" name="nombre" required>
                        <label for="nombre">Nombre</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" name="email" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" required>
                        <label for="password">Contraseña</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="people-outline"></ion-icon>
                        <select name="role" required>
                            <option value="" disabled selected>Selecciona tu rol</option>
                            <option value="admin">Administrador</option>
                            <option value="cliente">Cliente</option>
                            <option value="personal">Personal</option>
                        </select>
                    </div>
                    <button type="submit">Registrarse</button>
                    <div class="register">
                        <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>