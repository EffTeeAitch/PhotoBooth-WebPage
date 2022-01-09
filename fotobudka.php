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
                        echo 'Photo of user: '.$row2['firstName'].' '.$row2['lastName'].'<br>';     //display data
                        echo 'Size: '.$row2['x'].'x'.$row2['y'].'px<br>';
                        echo 'Price: '.$row2['wycena'].'zł<br>';
                        echo 'path: '.$row2['sciezka'].'<br>';
                        echo '<a href="index.php">Go back</a><br>';
                        echo '<img src="'.'foto/'.$row2["sciezka"].'" alt="photo""/>';
                        
                    }else{
                        echo 'Incorrect hash/code';        //info about incorrect hash 
                        header('Refresh: 3; URL=index.php');
                    }
                }else{
                    echo 'Incorrect surname or hash';        //info about incorrect surname
                    header('Refresh: 3; URL=index.php');
                }
            }else{
                echo 'Error with query, probably file that you want to retrieve does not exist or his path has changed';        //error about no query correctness  
                header('Refresh: 3; URL=index.php');
            }
        }else{
            echo 'You have inserted no data';     //error about no data inserted
            header('Refresh: 3; URL=index.php');
        }
    ?>
</body>
</html>
