<?php
$conexion = new mysqli("localhost", "root", "", "programaura");
// comentario del prof
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);

    if ($nombre != "") {
        $sql = $conexion->prepare(
            "INSERT INTO integrantes (nombre) VALUES (?)"
        );

        $sql->bind_param("s", $nombre);

        if ($sql->execute()) {
            $mensaje = "¡Integrante registrado correctamente!";
        } else {
            $mensaje = "Error al registrar.";
        }

        $sql->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de integrantes</title>
    <style>
        body {
            font-family: Arial;
            background: #f0f2f5;
            text-align: center;
            padding: 50px;
        }

        .contenedor {
            background: white;
            padding: 30px;
            margin: auto;
            width: 350px;
            border-radius: 12px;
        }

        input {
            padding: 12px;
            width: 90%;
            margin: 10px;
        }

        button {
            padding: 12px 25px;
            background: #2563eb;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 6px;
        }
    </style>
</head>

<body>

<div class="contenedor">
    <h2>Registro de integrantes</h2>

    <form method="POST">
        <input
            type="text"
            name="nombre"
            placeholder="Escribe tu nombre completo"
            required
        >

        <br>

        <button type="submit">Registrar</button>
    </form>

    <p><?php echo htmlspecialchars($mensaje); ?></p>
</div>

</body>
</html>

<?php $conexion->close(); ?>