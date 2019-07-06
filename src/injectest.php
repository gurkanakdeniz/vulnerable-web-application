<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> Sql Injection</title>
        <link rel="stylesheet" href="main.css"> 
        <link rel="stylesheet" href="bootstrap.min.css">
        <script src="jquery.min.js"></script>
        <script src="bootstrap.min.js"></script>
    </head>
    
 <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.html">Kocaeli Üniversitesi <br> Zayıf Web Uygulaması</a>
    </div>
    <ul class="nav navbar-nav active">

      <li><a href="kurulum.php">Kurulum</a></li>
      <li><a href="injectest.php">Sql Injection</a></li>
      <li><a href="xsstest.php">Xss</a></li>
      <li><a href="komutinjectest.php">Komut Injection</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><button type="button" class="btn btn-success navbar-btn" data-toggle="modal" data-target="#myModal">Yardım</button></li>
      <li><span>  </span> </li>
    </ul>
  </div>
  <p class="yesillik">&nbsp;</p>
</nav>
<hr>
                
<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">
      <ul class="nav navbar-custom">
        <li class="active"><a href="index.html">Anasayfa</a></li>
        <li><a href="kurulum.php">Kurulum</a></li>
        <li class="bosluk">&nbsp;</li>  
        <li><a href="injectest.php">Sql Injection</a></li>
        <li><a href="xsstest.php">Xss</a></li>
        <li><a href="komutinjectest.php">Komut Injection</a></li>
          
      </ul><br>
   </div>

    <div class="col-sm-8">

        <div class="col-sm-10">
            <small><h3></h3></small>


            <form action="injectest.php" method="GET" class="col-sm-6">

                <div class="form-group">
                    <label for="username">Kullanıcı:</label>
                    <input type="input" class="form-control" name="username" placeholder="Ad">
                </div>

                <div class="form-group">
                    <label for="password">Şifre:</label>
                    <input type="password" class="form-control" name="password" placeholder="Şifre">
                </div>
                
                <button type="submit" value="click" name="submit" class="btn btn-default">Getir</button>
            </form>



            <?php
                function getir(){

                    include("config.php");
                    error_reporting(E_ALL);
                    ini_set('display_errors', 1);

                    if ($conn->connect_error) {
                         die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT NAME, PASS, EM, ADRES FROM KisiBilgileri WHERE name = '" .$_REQUEST['username']. "'" . "and PASS = '" .$_REQUEST['password']. "'" ;

                    $sonuc = $conn->query($sql);
 
                     if ($sonuc->num_rows > 0) {
                        echo "<br><br><br><br><br>".'<input type="checkbox" checked="checked" disabled="disabled"/> Giriş Onaylandı';

                        echo '<table class="table">' .'<thead>'.'<tr>' ;
                        echo "<caption>Kullanıcı Bilgileri</caption>";
                        echo '<th>'. 'ISIM'.'</th>'.'<th>'. 'SIFRE'.'</th>'.'<th>'. 'MAIL'.'</th>'.'<th>'. 'ADRES'.'</th>';
                        echo '</tr>'.'</thead>';
                        echo '<tbody>';
                        while($row = $sonuc->fetch_assoc()) {
        
                            echo '<tr>';
        
                            echo '<td>' .$row['NAME']. '</td>';
                            echo '<td>' .$row['PASS']. '</td>';
                            echo '<td>' .$row['EM']. '</td>';
                            echo '<td>' .$row['ADRES']. '</td>';
                  
                            echo '</tr>';
                        }

                        echo '</tbody>'.'</table>';

                     } else {
                        echo "<br><br><br><br><br>Giriş Onaylanmadı<br><br><br><br><br><p>Kullanıcı Bulunamadı</p>";
                     }

                    $sonuc = null;
                    $conn->close();
        
                }

                if(isset($_GET['submit']) && !empty($_GET['username'])&& !empty($_GET['password'])){
                    getir();
                } 

            ?>


            
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog modal-lg">
                    
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            
                            <h4 class="modal-title">Sql Enjeksiyon Yardım</h4>
                        </div>
                        <div class="modal-body">
                            <h5><strong>Sql Enjeksiyonu</strong></h5>
                            <p>SQL Enjeksiyonu , veri tabanına dayalı uygulamalara saldırmak için kullanılan bir kod enjeksiyon tekniğidir. SQL istekleri için kullanıcıdan girdi alınan bölümlerden (örnek giriş formları, arama formları vb.) alınan ifadelerin bitiş, başlangıç gibi karakter filtrelenmeden çalıştırılmasından dolayı oluşabilecek güvenlik açığından doğar. Girdilerde kontrol yapılmazsa form verisinine eklenen SQL ifadelerin çalıştırılmasından dolayı oluşur.</p>
                            <p>Bu sayfada bir giriş ekranı kurgulanmıştır.</p>
                            <p><b>örnek kullanıcı:</b>  isim: test1 şifre: 1234</p>
                            <h5><strong>Zafiyet</strong></h5>
                            <div class="zafiyet">
                                
                                <br>
                                <div class="code_alan_zafiyet">
                                    <p> <?php show_source("sqlinkod.php"); ?> </p>
                                </div>
                                <p>Proje kodunda görüldüğü gibi herhangi bir filtre uygulanmadan sql sorgusu çalıştırılmadan önce gelen veri sql ifadesine eklenmiş ve bu ifade çalıştırılmıştır. Böyle bir kodlama sonrası saldırgan giriş ekranında isim veya şifre bölümlerine sql ifadeleri ekleyerek istediği kodları çalıştırabilir. </p>
                                <p>Form verisine bir filtre uygulamadığı gibi veritabanı bağlantısı sırasında daha güvenli bağlantı araçları kullanılmamış veya bağlantı desteklenmemiştir. conn ifadesi config dosyasında bulunan mysqli bağlantının ismidir.</p>
                            
                            </div>

                            <h5><strong>Sömürü</strong></h5>
                            <div class="somuru">
                                <div class="code_alan">

                                <p><b>Link : </b></p>

                                <p><b>1)</b> localhost/injectest.php?username=test1&password=asdasda' or '1'='1&submit=click </p>
                                <p> <b>ya da</b> http://localhost/injectest.php?username=aer&password=+%27+or+%271%27%3D%271+&submit=click </p>

                                <p><b>Form Bölümüne: </b></p>
                                <p>pass bölümüne: ' or '1'='1 </p>
                                <p>kullanıcı bölümüne: ' or '1'='1 ' or '1'='1 </p>
                                

                            <br><br>

                                </div>
                                <p>Kullanıcı veya şifre bölümünün sonuna or 1=1 gibi bir eşitlik ekleyerek şifre aynı olmasa da tüm kullanıcı verilerine ulaşılabilmektedir.</p>
                                <p>Saldırgan Drop Delete gibi veritabanına zarar verici kodlar veya insert gibi eklemeler de yapabilir. Sömürü örneğinde açığı tekrar tekrar gösterebilmek için zarar verici örnek verilmemiştir. </p>

                            </div>


                            <h5><strong>İyilestirme</strong></h5>
                            <div class="iyilestirme">
                                <div class="code_alan_zafiyet">
                                    <p>  <?php show_source("cozumsqlin.php"); ?> </p>
                                </div>
                                <p>Zafiyetin kapatılması için işletilen sql ifadesinin düzenlemesi veya pdo gibi başka bağlantı yöntemleri kullanması gerekir. Sql ifadesini hazırlamak ve sınırlandırmak için prepare fonksiyonu kullanılarak öncelikle ? işareti ile parametreler belirtilir. Daha sonra bu ifadede kullanılacak parametrelerin kontrolu için bind_param fonksiyonu kullanılır. Daha sonra sorgu işletilir. Böylelikle php'de mysqli bağlantısı için sql injection'a karşı önlem alınmış olur. Saldırgan kendi kodlarını eklese bile çalıştıramayacaktır. </p>
                            </div>





                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                        </div>
                    </div>
      
                </div>
            </div>
        </div>

    </div>

    </div>
    <hr>

 </div>

    <footer class="navbar navbar-inverse">
      <div class="container-fluid">
          <div class="navbar-footer">
          <p>Kocaeli Üniversitesi Zayıf Web Uygulaması </p>
          </div>
      </div>
    </footer>
    
</html>
