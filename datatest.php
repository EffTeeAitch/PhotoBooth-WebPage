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
            if(($_FILES['plik']['type'] =='image/jpeg')||($_FILES['plik']['type'] =='image/jpg')||($_FILES['plik']['type'] =='image/png')){     //if thats file is a photo
                if(($_POST['imie'] !=null)&&($_POST['nazwisko'] !=null)){       //if name and surname was sent
                    require('checkInfo.php');
                    echo 'Your personal code for retrieving that particular photo: '.$hashs;
                    echo '<br><a href="index.php">Go back</a>';
                }else{
                    echo "You did not inserted any data";
                    header('Refresh: 3; URL=index.php');
                }
            }else{
                echo 'Wrong photo extension, acceptable: png,jpg,jpeg';
                header('Refresh: 3; URL=index.php');
            }
        }
        else{
            echo 'Error during uploading files!';
            header('Refresh: 3; URL=index.php');
        }
    ?>
</body>
</html>
