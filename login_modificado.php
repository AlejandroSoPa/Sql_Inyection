<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Modificado</title>
</head>
<body>
    <h1>LOGIN</h1>
    <form method="POST">
        <input type="text" name="userName" placeholder="Usuari">
        <input type="password" name="pwd" placeholder="Contrasenya">
        <button type="submit">Enviar</button>
    </form>

    <?php
        if(isset($_POST['userName']) && isset($_POST['pwd'])){
            try {
                $pwd = $_POST['pwd'];
                $userName = $_POST['userName'];
                $dsn = "mysql:host=localhost;dbname=mylogin";
                $pdo = new PDO($dsn, 'super', '1q2w·E4r5t6y');
                
                $query = $pdo->prepare("SELECT nom FROM users WHERE password = SHA2(:pwd, 512) AND nom = :userName");
                $query->bindParam(':pwd', $pwd, PDO::PARAM_STR);
                $query->bindParam(':userName', $userName, PDO::PARAM_STR);
                $query->execute();
                
                $row = $query->fetch();
                $correct = false;
                while ($row) {
                    echo "<h1>"."Bienvenido ". $row['nom']. "</h1>";
                    $row = $query->fetch();
                    $correct = true;
                }
                if (!$correct) {
                    echo "Login incorrecto";
                }

            } catch (PDOException $e){
                echo $e->getMessage();
            }
        }
    ?>

</body>
</html>