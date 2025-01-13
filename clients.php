<?php
include_once("conexion.php");
require_once("common.php");

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: /proyecto/");
}
$user_id = $_SESSION['user'];

$query = "SELECT email FROM staff WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$email = $row['email'];

$query = "SELECT * FROM clients";
$result = mysqli_query($conn, $query);

render_html_header('Usuarios');
render_menu('clients');
?>
<div class="content">
    <p>Usuario actual: <?php echo $email; ?></p>
    <div class="container">
        <div class="container-header">
            <h1>
                Lista de clientes
            </h1>
            <div>
                <!-- <button class="light">
                    Filtros
                </button> -->
                <button class="dark" onclick="window.location.href='add-client.php'">
                    + Agregar
                </button>
            </div>
        </div>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="user-container">
                <div class="user-info">
                    <img src="https://www.w3schools.com/howto/img_avatar.png" alt="<?php echo $row['nombre']; ?>">
                    <div class="user-details">
                        <span class="user-name">
                            <?php echo $row['nombre']; ?>
                        </span>
                        <span class="user-email">
                            <?php echo $row['email']; ?>
                        </span>
                    </div>
                </div>
                <span>
                    <?php
                    $expiration = strtotime($row['expires_at']);
                    $current_date = time();
                    if ($expiration < $current_date) {
                        echo '<span style="color: red;">Membresia finalizada</span>';
                    } else {
                        echo 'Membresia finaliza: '. date('M d, Y', $expiration);
                    }
                    ?>
                </span>
            </div>
        <?php endwhile; ?>
    </div>
</div>
</body>

</html>