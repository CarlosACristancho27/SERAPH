<?php
    require 'database.php';

    $message = '';

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $sql = "INSERT INTO user (email, password) VALUES (:email, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password);
        
        if ($stmt->execute()) {
            $message = 'Ha sido creado con exito';

        } else {
            $message = 'Lo siento pero algo ha salido mal';
        }
    
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Registrate | Moon Cells</title>
    <link rel="stylesheet" href="./assests/css/main.css">

</head>
<body>

    <header>
    <a href="/seraph">SE.RA.PH</a>
    </header>
    
    <?php if(!empty($message)): ?>
        <p><?= $message ?></p>
    <?php endif; ?>

    <h1>Registro en SERAPH<h1>

    <form action="signup.php" method="post">
        <input type="text" name="email" placeholder="Tu Email">
        <input type="password" name="password" placeholder="Tu contraseña">
        <input type="password" name="confirm_password" placeholder="Confirma tu contraseña">
        <input type="submit" value="Enviar">
    </form>

    <span>¿Ya tienes una cuenta?<a href="login.php"> Inicia sesion</a></span>

</body>
</html>