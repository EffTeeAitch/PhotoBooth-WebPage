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
        if(($_POST['hashs']!=null) && ($_POST['nazwiskoS']!=null)){     //if hash and surname was sent
            $db = new mysqli('localhost','root','','fotobudka');    //db connect
            if($row = $db->query('SELECT * FROM info,users,laczenie WHERE lastName = "'.$_POST['nazwiskoS'].'" AND laczenie.info_id = info.id AND laczenie.users_id = users.id')){      //query
                if($row ->num_rows>0){              //if query returns something = correct hash and surname
                    $row2 = $row->fetch_assoc();        //safe query select into variable
                    if(password_verify($_POST['hashs'],$row2['hashs']) && $row2['lastName']==$_POST['nazwiskoS'] ){
                        echo 'Obraz użytkownika: '.$row2['firstName'].' '.$row2['lastName'].'<br>';     //display data
                        echo 'Wymiary: '.$row2['x'].'x'.$row2['y'].'px<br>';
                        echo 'Wycena: '.$row2['wycena'].'zł<br>';
                        echo 'sciezka: '.$row2['sciezka'].'<br>';
                        echo '<a href="index.php">Wróć</a><br>';
                        echo '<img src="'.'foto/'.$row2["sciezka"].'" alt="obrazek""/>';
                        
                    }else{
                        echo 'Nieporawne dane1';        //info about incorrect hash or surname
                        header('Refresh: 3; URL=index.php');
                    }
                }else{
                    echo 'Nieporawne dane2';        //info about no returned data from query
                    header('Refresh: 3; URL=index.php');
                }
            }else{
                echo 'Nieporawne dane3';        //error about no query correctness  
                header('Refresh: 3; URL=index.php');
            }
        }else{
            echo 'Nie wprowadziles zadnych danych';     //error about no data inserted
            header('Refresh: 3; URL=index.php');
        }
    ?>
</body>
</html>
