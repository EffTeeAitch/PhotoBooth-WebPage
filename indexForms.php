<?php
    function uploadFilee($ilosc){
        $form = '
        <div class="content">
            <div class = "upload">
                <div class="formInfo">
                        <i>Upload photo </i>
                </div>
                <div class="actuallUpload">
                    <form action="datatest.php" method="POST" ENCTYPE="multipart/form-data">
                        <input type="file" name="plik"/><br/>
                        <input type="text" name="imie" placeholder="Firstname..."/><br/>
                        <input type="text" name="nazwisko" placeholder="Lastname..."/><br/>
                        <input type="hidden" name="ilosc1Info" value = "'.$ilosc.'"/>
                        <input type="submit" value="Wyślij plik"/>
                    </form>
                </div>
            </div>';
        return $form;
    }
    function checkJpg(){
        $form2 = '
            <div class = "check">
                <div class="formInfo">
                    <i>Retrieve photo </i>
                </div>
                <div class="actuallCheck">
                    <form action="fotobudka.php" method="POST">
                        <input type="text" name="hashs" placeholder="Wprowadź hashs"/><br/>
                        <input type="text" name="nazwiskoS" placeholder="Wprowadź nazwisko"/><br/>
                        <input type="submit" value="Sprawdź"/>
                    </form>
                </div>
            </div>
        </div>';
        return $form2;
    }

?>