<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    use App\Form\Password;
    use App\Form\Text;

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "car_forum";

    if (!isset($_POST['login'])) {
    ?>


        <form method="post" action="<?php



                                    echo $_SERVER['PHP_SELF'];
                                    ?>">



            Username:
            <?php
            $textField = new Text;
            $textField->setName('username');
            $textField->setValue($_POST['username'] ?? '');
            $textField->setAttribute(['required' => '']);
            $textField->makeText();

            ?>
            <br><br>

            Password:
            <?php
            $password = new Password;
            $password->setName('password');
            $password->setValue($_POST['password'] ?? '');
            $password->setAttribute([
                'required' => ''
            ]);
            $password->makePassword();
            ?><br><br>

            <input type="submit" value="Login" name="login">


        </form>

    <?php
    } else {

        $loginUsername = $_POST['username'];
        $loginPassword = $_POST['password'];
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM `users`
            WHERE username = '$loginUsername'
            AND password = '$loginPassword'");
            $stmt->execute();
            $result = $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        echo 'User data <br>';
        echo 'Your name: ' . $result['name'] . '<br>';
        echo 'Your email: ' . $result['email'] . '<br>';
        echo 'Your username: ' . $result['username'] . '<br>';
        echo 'Your car: ' . $result['car'] . '<br>';
        echo 'Your gender: ' . $result['gender'] . '<br>';
        echo 'Your Password: ' . $result['password']     . '<br>';
        $vehicles = json_decode($result['vehicles'], true);
        echo 'Vehicles you own: ' . (is_array($vehicles) ? implode(", ", $vehicles) : "")  . '<br>';
        echo 'Your Birthdate: ' . date('Y-m-d', $result['date']) . '<br>';
        echo 'Your Experience level: ' . $result['experience_range'] . '<br>';
    }
    ?>
</body>

</html>