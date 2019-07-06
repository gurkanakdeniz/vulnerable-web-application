<?php
    function getir(){
        include("config.php");
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
//gelen degerler isleme sokulmadan once tutuluyor
        $kullanici = $_REQUEST['username'];
        $sifre = $_REQUEST['password'];
//prepare kullaniliyor
        $sql = $conn->prepare("SELECT NAME, PASS, EM, ADRES FROM KisiBilgileri WHERE name = ? and pass = ?");
//bind_param kullanılıyor        
	$sql->bind_param("ss", $kullanici, $sifre);
//ifade isleme sokuluyor
        $sql->execute();
//sonuclar aliniyor
        $sonuc = $sql->get_result();
        if($sonuc->num_rows > 0){
            echo "<br><br><br><br><br>".'<input type="checkbox" checked="checked" disabled="disabled"/> Giriş Onaylandı';
            
            echo '<table class="table">' .'<thead>'.'<tr>' ;
            echo "<caption>Kullanıcı Bilgileri</caption>";
            echo '<th>'. 'ISIM'.'</th>'.'<th>'. 'SIFRE'.'</th>'.'<th>'. 'MAIL'.'</th>'.'<th>'. 'ADRES'.'</th>';
            echo '</tr>'.'</thead>';
            echo '<tbody>';
            while ($row = $sonuc->fetch_assoc()) {
                echo '<td>' .$row['NAME']. '</td>';
                echo '<td>' .$row['PASS']. '</td>';
                echo '<td>' .$row['EM']. '</td>';
                echo '<td>' .$row['ADRES']. '</td>';
            }
            echo '</tbody>'.'</table>';
        }else{
            echo "<br><br><br><br><br>Giriş Onaylanmadı<br><br><br><br><br><p>Kullanıcı Bulunamadı</p>";
        }
        
        $sonuc = null;
        $conn->close();
    }

    if(isset($_GET['submit']) && !empty($_GET['username'])&& !empty($_GET['password']){
        getir();
    } 
?>
