<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once("conexion.php");
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $hashed = hash('sha256', $password);
    $consulta = "SELECT id FROM staff WHERE email = '$email' AND hashed_password = '$hashed'";
    // echo $consulta;
    $resultado = mysqli_query($conn, $consulta);
    if ($resultado && $user = mysqli_fetch_assoc($resultado)) {
    // if ($user = mysqli_fetch_assoc($resultado)) {
        // echo "SI";
        $_SESSION['user'] = $user['id'];
    }
}
if (isset($_SESSION['user'])) {
    header("Location: clients.php");
}
?>
<body class="login">
    <form method="post" class="login-container">
        <div class="input-container">
            <span class="input-label">Usuario</span>
            <input 
                name="email"
                placeholder="email@email.com"
                type="text"
            />
        </div>
        <div class="input-container">
            <span class="input-label">Contraseña</span>
            <input 
                name="password"
                placeholder="********"
                type="password"
            />
        </div>
        <button 
            type="submit"
            class="dark login-btn"
        >
            Iniciar sesión
        </button>
    </form>
    <img src="logo.png" alt="OpenGym" class="logo" />
</body>