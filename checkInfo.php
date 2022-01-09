<?php
    $db = new mysqli("localhost", "root", "", "fotobudka");     //db connection
    $name = $_FILES['plik']['name'];    //file's path eg.: xd.png
    $roz = explode(".", $_FILES['plik']['name']);       //split path name.extension
    $roz2 = $roz[0];        //only name eg. xd
    $roz3 = $roz[count($roz)-1];        //extension only .png
    $sciezka = 'foto/'.basename($_FILES['plik']['name']);   //path needed to send file to folder
    $width = getimagesize($_FILES['plik']['tmp_name'])[0];  //get width eg.: 230px
    $height = getimagesize($_FILES['plik']['tmp_name'])[1];//get height eg.: 333px
    $wycena = ($width * $height)/12;    //payment 
    $hashs = rand(100,999); //hash
    $hashsDoBazy = password_hash($hashs, PASSWORD_DEFAULT);     //encrypt hash
    $newName = 0;   //random numbers to change name of the file in the folder
    for($x=1;$x<=5;$x++) {  
        $newName.= rand(1,9);
    };
    $sciezkaWysylanie = '';
    $newName.=$roz2;    //change the name eg.:812xd
    $sciezkaWysylanie.=$newName.='.'.$roz3;     //glue all in together eg.: 812xd.png
    $q = "INSERT INTO users(firstName,lastName) VALUES('".$_POST['imie']."','".$_POST['nazwisko']."')";     //first query to user's data
    $q2 = "INSERT INTO info(filName,x,y,hashs,sciezka,wycena)VALUES('".$newName."','".$width."','".$height."','".$hashsDoBazy."','".$sciezkaWysylanie."','".$wycena."')";       //second query for file's data
    $db->query($q);     //enforce query
    $db->query($q2);        ////enforce query
    $qSprInfo2 = 'SELECT COUNT(id) FROM info';      //check quantity of records in db
    $uchwyt1 = $db->query($qSprInfo2);      //enforce query
    $ilosc2Info = $uchwyt1 ->fetch_assoc();

    if($_POST['ilosc1Info'] < $ilosc2Info){ //if photo has been aded, just check quantity before and after export
        $maxUsers = 'SELECT MAX(id) FROM users';    //retrieve last if from user
        $kotwicaUsers = $db->query($maxUsers);
        $test3User = $kotwicaUsers ->fetch_assoc();
        $maxInfo = 'SELECT MAX(id) FROM info';      //retrieve last if from info
        $kotwicaInfo = $db->query($maxInfo);                    
        $testInfo = $kotwicaInfo ->fetch_assoc();
        $laczenie = "INSERT INTO laczenie(info_id, users_id) VALUES('".$testInfo['MAX(id)']."', '".$test3User['MAX(id)']."')";      //insert values into 'laczenie' table in db ('laczenie' is just relation in db where every user has photo)
        $db -> query($laczenie);
    }else{
        echo 'jakis blad';      //error if any exists
        header('Refresh: 3; URL=index.php');
    }
    move_uploaded_file($_FILES['plik']['tmp_name'], $sciezka);      //send photo to folder in path
    rename('foto/'.$name, 'foto/'.$sciezkaWysylanie);       //change name in folder to new one with 'salt' (randomly generated nummbers line:14)
    $db->close();   //close connection with db
?>