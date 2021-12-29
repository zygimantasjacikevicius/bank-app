<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Create a new account</h1>
    <?php

    use App\Form\Text;

    if (!isset($_POST['create_acc'])) {
    ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            Name:
            <?php
            $textField = new Text;
            $textField->setName('name');
            $textField->setValue($_POST['name'] ?? '');
            $textField->setAttribute(['required' => '']);
            $textField->make();
            ?>
            <br><br>

            Surname:
            <?php

            $textField->setName('surname');
            $textField->setValue($_POST['surname'] ?? '');
            $textField->setAttribute(['required' => '']);
            $textField->make();
            ?>
            <br><br>

            Account number:
            <?php

            $textField->setName('accnum');
            $textField->setValue($_POST['accnum'] ?? '');
            $textField->setAttribute(['required' => '']);
            $textField->make();
            ?>
            <br><br>

            Identification number:
            <?php

            $textField->setName('id');
            $textField->setValue($_POST['id'] ?? '');
            $textField->setAttribute(['required' => '']);
            $textField->make();
            ?>
            <br><br>

            <input type="submit" value="Create new account" name="create_acc"><br><br>

        </form>
    <?php
    } else {

        $jsonArr = json_decode(file_get_contents('bank_json.json'), true);

        if (!array_key_exists($_POST['id'], $jsonArr)) {
            $id = $_POST['id'];
            $jsonArr[$id]['name'] = $_POST['name'] ?? '';
            $jsonArr[$id]['surname'] = $_POST['surname'] ?? '';
            $jsonArr[$id]['accnum'] = $_POST['accnum'] ?? '';
            $jsonArr[$id]['balance'] = 0;

            $jsonData = json_encode($jsonArr);
            file_put_contents('bank_json.json', $jsonData);

            function redirect($url, $statusCode = 303)
            {
                $header1 = 'Location: ' . $url;
                header($header1, true, $statusCode);
                die();
            }

            redirect('index.php');
        } else {

            $err = 'toks asmens kodas jau yra duombazėje';
            echo $err;
        }
    }

    ?>

</body>

</html>