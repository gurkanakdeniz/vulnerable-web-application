<?php
    function pingAt(){

	//filtre uygulanmadan gelen veriyi eklenmesi       
	$pingadresi = "ping -c 5 ". $_REQUEST["adres"];
        
        //http://stackoverflow.com/questions/20107147/php-reading-shell-exec-live-output
        while (@ob_end_flush());

        //filtre uygulanmamis ifadenin calistirilmasi
        $sonuc = popen($pingadresi, 'r');
        echo '<pre>';
        
        $i = 0;
        while (!feof($sonuc)){
            echo fread($sonuc, 4096);
            @flush();
            $i = $i + 1;
        }
        if($i<=1){
            echo "adres yanlış";
        }
        echo '</pre>';
        
        pclose($sonuc);
        $sonuc = null;
    }
    
    if(isset($_GET['submit']) && !empty($_GET['adres']) ){
        pingAt();
    }
?>
