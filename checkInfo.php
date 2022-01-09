<?php
    $db = new mysqli("localhost", "root", "", "fotobudka");//polaczenie z baza danych
    $name = $_FILES['plik']['name'];//sciezka np: xd.png
    $roz = explode(".", $_FILES['plik']['name']);//podzielenie po kropce
    $roz2 = $roz[0];//sama nazwa np: xd
    $roz3 = $roz[count($roz)-1];//rozszerzenie np: png
    $sciezka = 'foto/'.basename($_FILES['plik']['name']);//siezka potrzebna do wyslania zdjecia do folderu
    $width = getimagesize($_FILES['plik']['tmp_name'])[0];//szerokosc np: 230px
    $height = getimagesize($_FILES['plik']['tmp_name'])[1];//wysokosc np: 333px
    $wycena = ($width * $height)/12;//cena
    $hashs = rand(100,999);//hash
    $hashsDoBazy = password_hash($hashs, PASSWORD_DEFAULT);//haszowanie hasla
    $newName = 0;//ciag cyfrowy
    for($x=1;$x<=5;$x++) {//losowanie 5liczb do csciezki pliku
        $newName.= rand(1,9);
    };
    $sciezkaWysylanie = '';
    $newName.=$roz2;// np:812xd
    $sciezkaWysylanie.=$newName.='.'.$roz3;//np: 812xd.png
    $q = "INSERT INTO users(firstName,lastName) VALUES('".$_POST['imie']."','".$_POST['nazwisko']."')";//piersze zapytanie uzytkownik
    $q2 = "INSERT INTO info(filName,x,y,hashs,sciezka,wycena)VALUES('".$newName."','".$width."','".$height."','".$hashsDoBazy."','".$sciezkaWysylanie."','".$wycena."')";//drugie zapytanie plik
    $db->query($q);//wyslanie zapytan do bay danych
    $db->query($q2);//wyslanie zapytan do bay danych
    $qSprInfo2 = 'SELECT COUNT(id) FROM info';//sprawdzenie ilosci rekordow w tabeli info
    $uchwyt1 = $db->query($qSprInfo2);//wykonanie zapytania
    $ilosc2Info = $uchwyt1 ->fetch_assoc();
    // echo $ilosc2Info['COUNT(id)'];
    if($_POST['ilosc1Info'] < $ilosc2Info){//jesli ilosc po dodaniu jest wieksza od ilosci rekordow przed dodaniem
        $maxUsers = 'SELECT MAX(id) FROM users';//ostatnie id z tabeli users
        $kotwicaUsers = $db->query($maxUsers);
        $test3User = $kotwicaUsers ->fetch_assoc();
        $maxInfo = 'SELECT MAX(id) FROM info';//ostatnie id z tabeli info
        $kotwicaInfo = $db->query($maxInfo);                    
        $testInfo = $kotwicaInfo ->fetch_assoc();
        $laczenie = "INSERT INTO laczenie(info_id, users_id) VALUES('".$testInfo['MAX(id)']."', '".$test3User['MAX(id)']."')";//uzupelnienie tabeli laczenie
        $db -> query($laczenie);
    }else{
        echo 'jakis blad';//jesli jest blad 
        header('Refresh: 3; URL=index.php');
    }
    move_uploaded_file($_FILES['plik']['tmp_name'], $sciezka);//wyslanie zdjecia do foledru foto//sciezka
    rename('foto/'.$name, 'foto/'.$sciezkaWysylanie);//zmiana nazwy w folderze na ten z hashem
    $db->close();//zamkniecie polaczenia z baza
?>