<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Result</title>
</head>
<body>
    <?php
        if(($_POST['hashs']!=null) && ($_POST['nazwiskoS']!=null)){//jesli przeslalismy hashs i nazwisko
            $db = new mysqli('localhost','root','','fotobudka');//polaczenie z baza danych
            if($row = $db->query('SELECT * FROM info,users,laczenie WHERE lastName = "'.$_POST['nazwiskoS'].'" AND laczenie.info_id = info.id AND laczenie.users_id = users.id')){//zapytanie do bazy danych z odpowiednimi parametrami
                if($row ->num_rows>0){//jesli zapytanie cos zwraca czyli podalismy poprawny hashs i nazwiso
                    $row2 = $row->fetch_assoc();//zapisanie do zmiennej danych z bay
                    if(password_verify($_POST['hashs'],$row2['hashs']) && $row2['lastName']==$_POST['nazwiskoS'] ){
                        echo 'Obraz użytkownika: '.$row2['firstName'].' '.$row2['lastName'].'<br>';//wyswietlenie danych
                        echo 'Wymiary: '.$row2['x'].'x'.$row2['y'].'px<br>';
                        echo 'Wycena: '.$row2['wycena'].'zł<br>';
                        echo 'sciezka: '.$row2['sciezka'].'<br>';
                        echo '<a href="index.php">Wróć</a><br>';
                        echo '<img src="'.'foto/'.$row2["sciezka"].'" alt="obrazek""/>';
                        
                    }else{
                        echo 'Nieporawne dane1';//komunikat o zlych danych
                        header('Refresh: 3; URL=index.php');
                    }
                }else{
                    echo 'Nieporawne dane2';//komunikat o zlych danych
                    header('Refresh: 3; URL=index.php');
                }
            }else{
                echo 'Nieporawne dane3';//komunikat o zlych danych
                header('Refresh: 3; URL=index.php');
            }
        }else{
            echo 'Nie wprowadziles zadnych danych';//komunikat o zlych danych
            header('Refresh: 3; URL=index.php');
        }
    ?>
</body>
</html>
