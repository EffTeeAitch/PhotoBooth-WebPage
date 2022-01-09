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
        if (is_uploaded_file($_FILES['plik']['tmp_name'])) {//jesli wysłalismy plik
            if(($_FILES['plik']['type'] =='image/jpeg')||($_FILES['plik']['type'] =='image/jpg')||($_FILES['plik']['type'] =='image/png')){//jeśli ten plik to zdjęcie
                if(($_POST['imie'] !=null)&&($_POST['nazwisko'] !=null)){//jeśli przeslalismy imie i nazwisko
                    require('checkInfo.php');
                    echo 'Twój osobisty kodzik do zdjęcia: '.$hashs;
                    echo '<br><a href="index.php">Wróć</a>';
                }else{
                    echo "Nie wprowadziles żadnych danych";
                    header('Refresh: 3; URL=index.php');
                }
            }else{
                echo 'Zły format pliku dopuszczany: png,jpg,jpeg';
                header('Refresh: 3; URL=index.php');
            }
        }
        else{
            echo 'Błąd przy przesyłaniu danych!';
            header('Refresh: 3; URL=index.php');
        }
    ?>
</body>
</html>
