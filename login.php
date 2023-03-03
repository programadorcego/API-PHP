<?php
session_start();
require __DIR__ . "/functions.php";

$login = login('willian', 'minhasenha');

if($login['status'] == 'error')
{
	die($login['message']);
}

$_SESSION['jwt'] = $login['jwt'];
die($login['message']);