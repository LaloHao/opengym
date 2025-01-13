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
$current_user = $row['email'];

// get user id from GET param
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $query = "SELECT id, nombre, email, expires_at FROM clients WHERE id = '$user_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    // redirect if no user found
    if (!$row) {
        header("Location: clients.php");
    }
    $nombre = $row['nombre'];
    $email = $row['email'];
}

// update user days
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once("conexion.php");
    $dias = $_POST['dias'];
    $consulta = "SELECT expires_at FROM clients WHERE id = '$user_id'";
    $result = mysqli_query($conn, $consulta);
    $row = mysqli_fetch_assoc($result);
    // if membership already expired use current time plus dias
    if (strtotime($row['expires_at']) < time()) {
        $expires_at = "DATE_ADD(NOW(), INTERVAL $dias DAY)";
    } else {
        $expires_at = "DATE_ADD(expires_at, INTERVAL $dias DAY)";
    }
    // update membership expiration date in database
    $consulta = "UPDATE clients SET expires_at = $expires_at WHERE id = '$user_id'";
    // echo $consulta;
    // exit;

    // ejecutar consulta
    if (mysqli_query($conn, $consulta)) {
        header("Location: clients.php");
    } else {
        echo "Error: " . $consulta . "<br>" . mysqli_error($conn);
    }
}

render_html_header('Usuarios');
render_menu('pay');
?>
<div class="content">
    <p>Usuario actual: <?php echo $current_user; ?></p>
    <div class="container">
        <div class="container-header">
            <h1>
                Pagar membresia
            </h1>
        </div>
        <form method="post" class="add-user-container">
            <div class="input-container">
                <span class="input-label">Usuario</span>
                <input
                    name="email"
                    value="<?php echo $email; ?>"
                    disabled
                    type="text" />
            </div>
            <div class="input-container">
                <span class="input-label">Nombre</span>
                <input
                    name="nombre"
                    value="<?php echo $nombre; ?>"
                    disabled
                    type="text" />
            </div>
            <div class="input-container">
                <span class="input-label">Dias a pagar</span>
                <input
                    name="dias"
                    pattern="\d+"
                    min="1"
                    type="number" />
            </div>
            <button
                type="submit"
                class="dark login-btn">
                Pagar
            </button>
        </form>
    </div>
</div>
</body>

</html>