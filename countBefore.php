<?php
    $db = new mysqli("localhost", "root", "", "fotobudka");     //connection with db
    $qSprInfo2 = 'SELECT COUNT(id) FROM info';
    $uchwyt1 = $db->query($qSprInfo2);
    $ilosc1Info = $uchwyt1 ->fetch_assoc();
    $db->close();

?>