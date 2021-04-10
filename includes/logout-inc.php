<?php

session_start();
session_unset();
session_destroy();
$sessao = 0;

header("location: /index.php");
exit();
