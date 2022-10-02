<?php
    session_start();

    require 'database.php';

    if (isset($_SESSION['user_id'])){
        $records = $conn->prepare('SELECT id,email, password FROM user WHERE id = :id');
        $records->bindParam(':id',$_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        
        if (count($results) > 0) {
            $user = $results;
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assests/css/main.css">
    <title>Moon Cell</title>
</head>
<body>
   
    <header>
    <a href="/seraph">SE.RA.PH</a>
    </header>

    <?php if(!empty($user)): ?>
        <br>Bienvenido al infierno gusano. <?= $user['email'] ?>
        <br>Has entrado a la guerra del santo grial.
        <br>
        <a href="logout.php">Cerrar sesion</a>

    <?php else: ?>
        

        <h1>Bienvenido a SERAPH</h1>
        <h2>Participa en la guerra por el santo grial</h2>

        <a href="login.php">Ingresar</a>
        <br>
        <a href="signup.php">Registrarse</a>
    <?php endif; ?>

</body>
</html>