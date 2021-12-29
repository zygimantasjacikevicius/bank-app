<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';



if (!isset($_POST['to_create_acc']) && !isset($_POST['create_acc']) && !isset($_POST['to_add_funds']) && !isset($_POST['to_delete_funds'])) {
    require_once('bank_main_account.php');
}
if (isset($_POST['to_create_acc']) || isset($_POST['create_acc'])) {
    require_once('bank_new_account.php');
}

if (isset($_POST['to_delete_funds']) || isset($_POST['delete_funds'])) {
    require_once('bank_remove_funds.php');
}


if (isset($_POST['to_add_funds']) || isset($_POST['add_funds'])) {
    require_once('bank_add_funds.php');
}
