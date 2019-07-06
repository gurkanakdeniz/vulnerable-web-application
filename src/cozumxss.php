<?php
    function bul(){
        include("config.php");
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        $ort = $_REQUEST["ortalama"];
        $sql = "SELECT NUMARA, NAME, CLASS, ORTALAMA FROM Ogrenciler WHERE ORTALAMA >= '".$ort."'";

        if (is_numeric($ort)){
	    //ort ekrana basildigi satir
	    echo "<br><br> <pre>Ortalaması ". htmlspecialchars($ort) ."'den büyük olan ogrenciler</pre>";
            
	    if ($connp->query($sql)->rowCount()>0) {
                
                echo '<table class="table">' .'<thead>'.'<tr>' ;
                echo '<th>'. 'SIRA'.'</th>'.'<th>'. 'NUMARA'.'</th>'.'<th>'. 'ISIM'.'</th>'.'<th>'. 'SINIF'.'</th>'.'<th>'. 'ORTALAMA'.'</th>';
                echo '</tr>'.'</thead>';
                echo '<tbody>';
                $i=0;
                foreach ($connp->query($sql) as $row) {
                    echo '<tr>';
                    $i = $i + 1;
                    echo '<td>' .$i. '</td>';
                    echo '<td>' .$row['NUMARA']. '</td>';
                    echo '<td>' .$row['NAME']. '</td>';
                    echo '<td>' .$row['CLASS']. '</td>';
                    echo '<td>' .$row['ORTALAMA']. '</td>';
                    echo '</tr>';
                }
                echo '</tbody>'.'</table>';
            }else{
                echo "<br><br> <p>Ogrenci Bulunamadı</p>";
            }
        }else{
            echo "<br><br> <p>Ogrenci Bulunamadı</p>";
        }
        
        $sql =null;
        $connp=null;
    }


    if(isset($_GET['submit']) && !empty($_GET['ortalama']) ){
	bul();
    } 
?>
