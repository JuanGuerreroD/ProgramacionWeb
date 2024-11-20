<?php
include("config.php");
include("firebaseRDB.php");

$email = $_POST['email'];
$password = $_POST['password'];
$edad = $_POST['edad'];

if ($email == "") {
    echo "Email is required";
} else if ($password == "") {
    echo "Password is required";
} else if ($edad == "") {
    echo "Edad is required";
} else {
    // Crear instancia de la clase firebaseRDB
    $rdb = new firebaseRDB($databaseURL);

    // Recuperar datos de usuario por email
    $retrieve = $rdb->retrieve("/user", "email", "EQUAL", $email);
    $data = json_decode($retrieve, true);

    if (isset($data['email'])) {
        echo "Email already used";
    } else {
        // Insertar nuevo usuario
        $insert = $rdb->insert("/user", [
            "name" => $name,
            "email" => $email,
            "password" => $password,
            "edad" => $edad
        ]);

        $result = json_decode($insert, true);

        if (isset($result['name'])) {
            echo "Signup success, please login";
        } else {
            echo "Signup failed";
        }
    }
}
?>
