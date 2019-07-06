<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> Kurulum</title>
        <link rel="stylesheet" href="main.css"> 
        <link rel="stylesheet" href="bootstrap.min.css">
        <script src="jquery.min.js"></script>
        <script src="bootstrap.min.js"></script>
    </head>
    
 <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand active" href="index.html">Kocaeli Üniversitesi <br> Zayıf Web Uygulaması</a>
    </div>
    <ul class="nav navbar-nav active">
      <li><a href="kurulum.php">Kurulum</a></li>
      <li><a href="injectest.php">Sql Injection</a></li>
      <li><a href="xsstest.php">Xss</a></li>
      <li><a href="komutinjectest.php">Komut Injection</a></li>
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
            <h1>Kurulum Adımları</h1>
            <hr>
            <p>Kurulum <b>Ubuntu 16.04</b> dağıtımı için anlatılmıştır. Daha üst <b>Ubuntu</b> versiyonlarında veya <b>Debian</b> tabanlı dağıtımlarda da çalışacağı varsayılmaktadır. Verilen komutları <b>sıralı</b> ve <b>eksiksiz</b> uygulayın. Sudo ile başlayan komutların işletilmesi için kullanıcı şifreniz istenecektir.</p>

            
            <div class="adimlar">
                
                <h2>Yöntem 1: Sh kurulum</h2>
                <div class="adim">
                  <p>Bu yöntem sadece <strong>Ubuntu 16.04</strong> dağıtımı üzerinde denenmiştir.</p>
                  <p>Proje dosyalarında bulunan <strong><a href="kurulum.sh">kurulum.sh</a></strong> dosyasını terminal ekranından yönetici olarak çalıştırmanız kurulum için yeterli olacaktır. İnternet hızınıza göre süre değişkenlik gösterecektir kurulumun bir bölümünde mysql root şifresi istenecektir hatalı giriş yapılmamalıdır.</p>
                  <p>Kurulum dosyasını çalıştırmak için:</p>
                  <div class="code_alan">
                    <p>sudo sh dosyalarin_bulundugu_dizin/kurulum.sh </p>
                  </div>

                </div>

                <h2>Yöntem 2: Manuel Kurulum</h2>


                <h4><strong>0) Paketlerin Alınması </strong></h4>
                <div class="adim">
                  <div class="code_alan">
                    <p> sudo apt-get update </p>
                  </div>
                </div>


            	<h4><strong>1) Apache Kurulumu </strong></h4>
            	<div class="adim">
            		<div class="code_alan">
            			<p> sudo apt-get install apache2 </p>
           			</div>
            		<p><i>Çıkan sorulara dağıtım dilinize göre e ya da y demeniz gerekir.</i></p>
            	</div>
            	<h4><strong>2) Php Kurulumu </strong></h4>
            	<div class="adim">
            		<div class="code_alan">
            			<p> sudo apt-get install php7.0 </p>
           			</div>
            		<p><i>Çıkan sorulara dağıtım dilinize göre e ya da y demeniz gerekir.</i></p>
            		<div class="code_alan">
            			<p>sudo nano /etc/apache2/mods-available/dir.conf </p>
            		</div>
            		<p><i>açılan dosyayı,</i></p>
            		<div class="code_alan">
            			<p><?php
                      echo htmlspecialchars(" <IfModule mod_dir.c> DirectoryIndex index.html index.cgi index.pl index.php index.xhtml index.htm </IfModule>");
                   ?></p>
            		</div>
                <p>şeklinde düzenleyin ctrl+o ile kaydedip ctrl+x ile çıkın.</p>
                <div class="code_alan">
                    <p>sudo apt-get install php7.0-cli</p>
                </div>
                <div class="code_alan">
                    <p>sudo apt-get install libapache2-mod-php7.0</p>
                </div>
            	</div>

            	<h4><strong>3) Modullerin Başlatılması </strong></h4>
            	<div class="adim">
            		<div class="code_alan">
            			<p> sudo a2enmod ssl </p>
                  <p> sudo a2enmod rewrite </p>
                  <p> sudo a2enmod suexec </p>
                  <p> sudo a2enmod include </p>
           			</div>
            	</div>


              <h4><strong>4) Apache'nin Yeniden Başlatılması </strong></h4>
              <div class="adim">
                <div class="code_alan">
                  <p> sudo systemctl restart apache2 </p>
                </div>
              </div>

              <h4><strong>5) Mysql Kurulumu </strong></h4>
              <div class="adim">
                <div class="code_alan">
                  <p> sudo apt-get install mysql-server </p>
                </div>
                <p><i>Root şifresi için sizden şifre belirlenmesini isteyecektir. Çıkan sorulara dağıtım dilinize göre e ya da y demeniz gerekir.</i></p>
                <div class="code_alan">
                  <p>sudo apt-get install php7.0-mysql</p>
                </div>
                <div class="code_alan">
                  <p>sudo apt-get install php-mysql</p>
                </div>
                <div class="code_alan">
                  <p>sudo systemctl restart apache2 </p>
                </div>
              </div>

              <h4><strong>6) Veritabanı</strong></h4>
              <div class="adim">
               <p><b>A) Veritabanın dosyadan aktarılması</b></p>
                <p>Veritabanını dosyadan aktarmayı tercih ediyorsanız bu adımı uygulayıp B adımını atlayın C adımına geçin.</p>
                <p> <a href="data.sql">data.sql</a> dosyası proje dosyaları içindedir.</p>

                <div class="code_alan">
                  <p>mysql -u root -p -Bse "CREATE DATABASE vulsite"</p>
                </div>
                <p>Önceki adımda belirlediğini root şifresi istenecektir.</p>
                <div class="code_alan">
                    <p>mysql -u root -p vulsite < data.sql </p>
                </div>
                <p>Önceki adımda belirlediğini root şifresi istenecektir.</p>

               <p><b>B) Veritabanın sıfırdan oluşturulması</b></p>
                <p>Veritabanını dosyadan aktarmadıysanız bu adımı uygulayın.</p>
                <div class="code_alan">
                  <p> mysql -u root -p </p>
                </div>
                <p><i>Bir önceki adımda belirlediğiniz root şifresini isteyecektir.</i></p>
                <div class="code_alan">
                  <p> CREATE DATABASE vulsite; </p>
                </div>
                <p>Vulsite projede kullanılan veritabanı ismidir.</p>

                <div class="code_alan">
                  <p> USE vulsite; </p>
                  <p> CREATE TABLE KisiBilgileri (NAME VARCHAR(100) NOT NULL, PASS VARCHAR(20), EM VARCHAR(20), ADRES VARCHAR(20), PRIMARY KEY (NAME)); </p>
                  <p> INSERT INTO KisiBilgileri(NAME,PASS,EM,ADRES) VALUES ("test1","1234","test1@mail.com","ISTANBUL"); </p>
                  <p> INSERT INTO KisiBilgileri(NAME,PASS,EM,ADRES) VALUES ("test2","1234569","test2@mail.com","KOCAELI"); </p>
                  <p> CREATE TABLE Ogrenciler (NUMARA INTEGER NOT NULL, NAME VARCHAR(100), CLASS INTEGER, ORTALAMA FLOAT, PRIMARY KEY (NUMARA)); </p>
                  <p> INSERT INTO Ogrenciler(NUMARA, NAME, CLASS, ORTALAMA) VALUES (170201021, "Ahmet Demir", 3, 2.24); </p>
                  <p> INSERT INTO Ogrenciler(NUMARA, NAME, CLASS, ORTALAMA) VALUES (170201022, "Mehmet Tut", 4, 3.04); </p>
                  <p> INSERT INTO Ogrenciler(NUMARA, NAME, CLASS, ORTALAMA) VALUES (170201023, "Ayse Bak", 2, 3.96); </p>
                  <p> INSERT INTO Ogrenciler(NUMARA, NAME, CLASS, ORTALAMA) VALUES (170201024, "Zeliha Deniz", 3, 3.66); </p>
                  <p> INSERT INTO Ogrenciler(NUMARA, NAME, CLASS, ORTALAMA) VALUES (170201025, "Ali Pek", 2, 2.89); </p>
                  <p> INSERT INTO Ogrenciler(NUMARA, NAME, CLASS, ORTALAMA) VALUES (170201026, "Sudesu Pamuk", 3, 2.71); </p>
                  <p> INSERT INTO Ogrenciler(NUMARA, NAME, CLASS, ORTALAMA) VALUES (170201027, "Deniz Gök", 3, 3.89); </p>
                  <p> INSERT INTO Ogrenciler(NUMARA, NAME, CLASS, ORTALAMA) VALUES (170201028, "Alev Toprak", 4, 3.54); </p>
                  <p> INSERT INTO Ogrenciler(NUMARA, NAME, CLASS, ORTALAMA) VALUES (170201029, "Oguz Atay", 1, 3.42); </p>
                  <p> INSERT INTO Ogrenciler(NUMARA, NAME, CLASS, ORTALAMA) VALUES (170201030, "Orhan Veli", 3, 2.26); </p>
                </div>

                <div class="code_alan">
                    <p>exit</p>
                </div>
                <br>
                <p><b>C) Kullanıcı Oluşturulması</b></p>
                <div class="code_alan">
                  <p>mysql -u root -p -Bse "GRANT ALL PRIVILEGES ON vulsite.* To 'testkullanici'@'localhost' IDENTIFIED BY 'testkullanicisifre'"</p>
                </div>
                <p>Vulsite veritabanı için kullanıcı adı: testkullanici , şifresi: testkullanicisifre , olan localhost kullanıcı oluşturulur. Mysql root sifreniz istenir.</p>
                <p>Projede erişim root kullanıcı üzerinden değil bu kullanıcı üzerinden yapıldığı için oluşturulmak zorundadır.</p>
              </div>

              <h4><strong>7) Proje Dosyalarının Kopyalanması </strong></h4>
              <div class="adim">
                <p>Proje dosyalarının <b>/var/www/html/</b> dizinine kopyalanması gerekiyor.</p>
                <p>Grafik arayüz kullanarak kopyalama komutları:</p>
                <div class="code_alan">
                  <p> sudo -H nautilus </p>
                </div>
                <p><i>nautilus uygulamasını yönetici olarak başlattıktan sonra proje dosyalarını <b>/var/www/html/</b> dizini içerisine kopyalayın, dosya yöneticisini kapatın.</i></p>
                <div class="code_alan">
                  <p>sudo chmod -R 765 /var/www/html/*</p>
                </div>
                <p>Dosya izinlerinin değiştirilmesi.</p>
              </div>

              <h4><strong>8) Görüntüleme </strong></h4>
              <div class="adim">
                <p><i>İnternet tarayıcınızın adres çubuğuna <a href="http://127.0.0.1">127.0.0.1</a> ya da <a href="http://localhost">localhost</a> yazıp enter'a basın.</i></p>
              </div>
            	<br><br><br>

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
