<?php
if (!empty($_POST)) {
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        if ($_POST["username"] != "" && $_POST["password"] != "") {
            include "conexion.php";

            $user_id = null;
            $username = $_POST["username"];
            $password = $_POST["password"];

            $sql1 = "SELECT * FROM user WHERE (username=\"$username\" OR email=\"$username\") AND password=\"$password\"";
            $query = $con->query($sql1);
            $user = $query->fetch_assoc();
            
            if ($user) {
                $user_id = $user["id"];
                $username = $user["username"];
                
                // Registro de datos de sesión
                session_start();
                $_SESSION["user_id"] = $user_id;
                $_SESSION["username"] = $username;

                // Obtener datos de sesión
                $fecha = date("Y-m-d H:i:s");
                $ip = $_SERVER['REMOTE_ADDR'];
                $navegador = $_SERVER['HTTP_USER_AGENT'];
                $so = php_uname('s');
                $estado = 1; // Estado 1 para acceso válido

                // Insertar datos de sesión en la tabla "sesiones"
                $sql2 = "INSERT INTO sesiones (fecha, ip, navegador, so, estado, usuario) VALUES ('$fecha', '$ip', '$navegador', '$so', '$estado', '$username')";
                $con->query($sql2);

                print "<script>window.location='../home.php';</script>";
            } else {
                $estado = 0; // Estado 0 para acceso inválido

                // Insertar datos de sesión inválida en la tabla "sesiones"
                $sql2 = "INSERT INTO sesiones (fecha, ip, navegador, so, estado, usuario) VALUES (NOW(), '".$_SERVER['REMOTE_ADDR']."', '".$_SERVER['HTTP_USER_AGENT']."', '".php_uname('s')."', '$estado', '$username')";
                $con->query($sql2);

                print "<script>alert(\"Acceso inválido.\");window.location='../login.php';</script>";
            }
        }
    }
}
?>

