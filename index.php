<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>fotobudka</title>
</head>
<body>
<?php
    require('countBefore.php');
    require('indexForms.php');
    echo uploadFilee($ilosc1Info['COUNT(id)']);
    echo '<br>';
    echo checkJpg();
?>
</body>
</html>
