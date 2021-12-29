<?php
session_start();
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Test Bank account</title>

</head>

<body>
    <h1>Welcome to you main bank page</h1>

    <h2>Your current accounts:</h2>

    <?php

    use App\Bank\ValidateDeletion;

    $jsonArr = json_decode(file_get_contents('bank_json.json'), true);
    function cmp($a, $b)
    {
        return strcmp($a["surname"], $b["surname"]);
    }

    uasort($jsonArr, "cmp");

    $err = '';
    if (!empty($jsonArr)) {
        if (isset($_POST['delete_account'])) {
            $validate = new ValidateDeletion;
            $validate->validateBalance($jsonArr[$_POST['id']]['balance']);
            $err = $validate->getErrDeletion();
            if (empty($err)) {
                unset($jsonArr[$_POST['id']]);
                $jsonData = json_encode($jsonArr);
                file_put_contents('bank_json.json', $jsonData);
            } else {
                echo $err . '<br><br>';
            }
        }
        foreach ($jsonArr as $key => $value) {


            echo 'Account number: ' . $value['accnum'] . ' ' . 'Account owner: ' . $value['name'] . ' ' . $value['surname'] . ' Bank Balance: ' . $value['balance'];


    ?>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="text" name="id" hidden value="<?php echo $key ?>">

                <input type="submit" value="Add money" name="to_add_funds"> <input type="submit" value="Transfer money" name="to_delete_funds"> <input type="submit" value="Delete account" name="delete_account"> <br><br>
            </form>
    <?php

        }
    }


    ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <input type="submit" value="Create a new account" name="to_create_acc">
    </form>

</body>

</html>