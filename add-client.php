<?php
include_once("conexion.php");
require_once("common.php");

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: /proyecto/");
}
$user_id = $_SESSION['user'];

$query = "SELECT id, email FROM staff WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$user_id = $row['id'];
$email = $row['email'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once("conexion.php");
    $email = trim($_POST['email']);
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $consulta = "INSERT INTO clients (email, nombre, telefono, expires_at, created_at, created_by) VALUES ('$email', '$nombre', '$telefono', NOW(), NOW(), '$user_id')";
    if (mysqli_query($conn, $consulta)) {
        header("Location: clients.php");
    } else {
        echo "Error: " . $consulta . "<br>" . mysqli_error($conn);
    }
}

render_html_header('Usuarios');
render_menu('add-client');
?>
<div class="content">
    <p>Usuario actual: <?php echo $email; ?></p>
    <div class="container">
        <div class="container-header">
            <h1>
                Agregar cliente
            </h1>
        </div>
        <form method="post" class="add-user-container">
            <div class="input-container">
                <span class="input-label">Usuario</span>
                <input
                    name="email"
                    placeholder="email@email.com"
                    type="text" />
            </div>
            <div class="input-container">
                <span class="input-label">Nombre</span>
                <input
                    name="nombre"
                    placeholder="Felipe De Jesus"
                    type="text" />
            </div>
            <div class="input-container">
                <span class="input-label">Telefono</span>
                <input
                    name="telefono"
                    placeholder="+521234567890"
                    type="text" />
            </div>
            <button
                type="submit"
                class="dark login-btn">
                Agregar
            </button>
        </form>
    </div>
</div>
</body>

</html>