<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> XSS</title>
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
        <div class="col-sm-12">
            <small><h3></h3></small>
            <label for="ortalama">İstenen Ortalama: </label>
            <form action="xsstest.php" method="GET" class="form-inline">
                <div class="form-group">
                    <input type="input" class="form-control" name="ortalama" placeholder="En dusuk ortalama" >
                </div>
                <button type="submit" value="click" name="submit" class="btn btn-default">Bul</button>

            </form>

            <?php


              function bul(){
                  include("config.php");
                  error_reporting(E_ALL);
                  ini_set('display_errors', 1);

                  $ort = $_REQUEST["ortalama"];
                  $sql = "SELECT NUMARA, NAME, CLASS, ORTALAMA FROM Ogrenciler WHERE ORTALAMA >= '".$ort."'";

                  echo "<br><br> <pre>Ortalaması ". $ort."'den büyük olan ogrenciler</pre>";
                  
                  if (is_numeric($ort)){
                    
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


            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog modal-lg">
                    
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            
                            <h4 class="modal-title">XSS Yardım</h4>
                        </div>
                        <div class="modal-body">
                            <h5><strong>Siteler Arası Betik Çalıştırma</strong></h5>
                            <p>Siteler Arası Betik Çalıştırma genelde web uygulamalarında karşılaşılan bir güvenlik açığıdır. Formlar (arama formları, giriş formları vb.) üzerinden alınan bilgiye saldırganın kendi komutlarını eklemesi sonucunda kaynak dosyalarını kalıcı veya geçici olarak değiştirilmesi veya bilgi toplamasındır. Temelde girdilerin filtreden geçirilmeden sitede kullanılmasından dolayı oluşur.</p>
                            <p>Bu sayfada bir arama işlemi kurgulanmıştır. Girilen ortalama değerine göre veritabanından ilgili öğrencileri göstermektedir.</p>

                            <h5><strong>Zafiyet</strong></h5>
                            <div class="zafiyet">
                                <div class="code_alan_zafiyet">
                                <p> <?php show_source("xsskod.php"); ?> </p>

                                </div>
                                <p> Yukarıda bu sayfa için kullanılan php kodu verilmiştir. Kod formdan aldığı ortalama verisini veritabanında sorgulayıp ekrana sonuçları basmaktadır. Ancak sorgulama yapılmadan önce ekrana aranan ortalamanın basıldığı satır nedeniyle Xss açığı oluşmaktadır. Form verisi filtreden geçirilmeden Ortalaması x'den büyük olan ogrenciler şeklinde ekrana basılması saldırganın bu veriye script kodlar ekleyerek işletebilmesine neden olmaktadır.  </p>
                            </div>

                            <h5><strong>Sömürü</strong></h5>
                            <div class="somuru">
                                <div class="code_alan">                                
                                <p><b>Link :</b> </p>
                                <p><b>1)</b> <?php echo htmlspecialchars('localhost/xsstest.php?ortalama=<script>alert("dışarıdan çalıştırılan script");</script>&submit=click'); ?> </p>
                                
                                <p><b>2)</b> <?php echo htmlspecialchars('localhost/xsstest.php?ortalama=<script>var x = document.getElementsByClassName("sidenav"); x[0].innerHTML = "Xss Acıgı Test!";</script> &submit=click');  ?> </p>
                                <br>
                                <p><b>Bul Kutusuna :</b> </p>
                                <p><b>1)</b><?php echo htmlspecialchars("<script>alert('dışarıdan çalıştırılan script');</script>"); ?>  </p>
                                <p><b>2)</b> <?php  echo htmlspecialchars('<script>var x = document.getElementsByClassName("sidenav");
    x[0].innerHTML = "Xss Acıgı Test!";</script>'); ?> </p>

                                </div>

                                <p>Form verisi içerisi script kodu olacak şekilde oluşturulursa sömürü örneğinde görüldüğü gibi geçici ya da kalıcı olarak script çalıştırılabilir ve kaynak değiştirilebilir.</p>
                                <p>Verilen örnek geçici ve zarar verici olmayan bir örnektir ancak saldırgan oturum verilerini veya başka bir çok bilgiyi çalabilir ve site yönlendirmesi yapabilir.</p>

                            </div>


                            <h5><strong>İyilestirme</strong></h5>
                            <div class="iyilestirme">
                                <div class="code_alan_zafiyet">
                                    <p> <?php show_source("cozumxss.php") ?> </p>
                                </div>
                                <p> Oluşan zafiyetin sebebi filtreleme yapmadan gelen verinin ekrana basılmasıydı. Veritabanı komutlarının ve ekrana basılma komutları uygulamadan önce php'nin is_numeric() fonksiyonunu kullanarak ortalama değerinin sayısal olup olmadığı kontrol edilirse saldırgan bu değere kendi kodlarını eklese bile sayısal olmadığı için herhangi bir işlem yapılmadan bul fonksiyonu bitecektir. Ayrıca htmlspecialchars() fonksiyonu kullanılarak ekrana basılması durumunda html'e özgü karakterler temizlenir ve yine güvenlik sağlanmış olur.</p>
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
