<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2 id="mensaje"></h2>
    <fieldset>
        <legend>Login</legend>
    <form action="" method="post">
        <label for="user">Nom usuari</label>
        <input type="text" name="user" id="user">
        <br><br>
        <label for="psswd">Contraseña</label>
        <input type="password" name="psswd" id="psswd">
        <br><br>
        <button type="submit">Iniciar Sessió</button>
    </form>
    </fieldset>
    <?php
        $conn = mysqli_connect('localhost','super','1q2w·E4r5t6y');
        mysqli_select_db($conn, 'mylogin');
        if (isset($_POST["user"])) {
            $query = "select nom from users where nom='".$_POST["user"]."' and password='".(hash("sha512",$_POST["psswd"]))."'";
            echo "<p>".$query."</p>";
            $resultat = mysqli_query($conn, $query);
            if (!$resultat) {
                    $message  = 'Consulta invàlida: ' . mysqli_error($conn) . "\n";
                    $message .= 'Consulta realitzada: ' . $query;
                    die($message);
            }
        }
        while( $registre = mysqli_fetch_assoc($resultat) ){
            if (!$registre) {
                echo "<p>login incorrect</p>";
            } else {
                echo "<h2>Benvingut ".$registre['nom']."</h2>";
                $_POST["user"] = false;
                $_POST["psswd"] = false;
            }
            
         }
    ?>
</body>
</html>