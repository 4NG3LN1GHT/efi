<?php
session_start();
session_unset();
session_destroy();
header('Location: login.php');
exit();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/../script.css">
</head>
<body>
    
</body>
</html>
