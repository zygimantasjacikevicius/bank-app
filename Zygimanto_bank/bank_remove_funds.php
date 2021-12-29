<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Transfer funds from your account</h1>
    <?php


    use App\Form\Text;

    if (!isset($_POST['delete_funds'])) {
    ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            Personal number:
            <?php
            echo $_POST['id'];

            ?>
            <br><br>


            Type the amount of money you want to transfer from your account:
            <?php
            $textField = new Text;
            $textField->setName('balance');
            $textField->setValue($_POST['balance'] ?? '');
            $textField->setAttribute(['required' => '']);
            $textField->make();
            ?>
            <br><br>



            <input type="text" name="id" hidden value="<?php echo $_POST['id'] ?>">
            <input type="submit" value="Delete funds" name="delete_funds"><br><br>

        </form>
    <?php
    } else {

        $jsonArr = json_decode(file_get_contents('bank_json.json'), true);
        $id = $_POST['id'];

        if ($jsonArr[$id]['balance'] >= $_POST['balance']) {


            $jsonArr[$id]['balance'] -= $_POST['balance'] ?? 0;


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
            $err = 'Sąskaitoje likusi suma negali būti minusinė';
            echo $err;
        }
    } ?>

</body>

</html>