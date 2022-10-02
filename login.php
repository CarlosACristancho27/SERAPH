<?php 

    session_start();

    if(isset($_SESSION['user_id'])) {
        header('Location: /seraph');
    }

    require 'database.php';

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $records = $conn->prepare('SELECT id, email, password FROM user WHERE email=:email');
        $records->bindParam(':email',$_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $message = "";

        if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
            $_SESSION['user_id'] = $results['id'];
            header('Location: /seraph');
        } else {
            $message = "No coninciden";
        }
    }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Login | Moon Cell</title>
    <link rel="stylesheet" href="./assests/css/main.css">

</head>
<body>

    <header>
    <a href="/seraph">SE.RA.PH</a>
    </header>

    <h1>Ingresar a SERAPH</h1>

    <?php if (!empty($message)) :?>
        <p><?= $message ?></p>

    <?php endif;?>

    <form action="login.php" method="post">
        <input type="text" name="email" placeholder="Tu Email">
        <input type="password" name="password" placeholder="Tu contraseña">
        <input type="submit" value="Enviar">
    </form>

    <span>¿No tienes una cuenta?<a href="signup.php"> Registrate</a></span>

</body>
</html>