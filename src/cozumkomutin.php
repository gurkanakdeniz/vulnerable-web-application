<?php
    function pingAt(){
	
	$at = $_REQUEST["adres"];
        
	//url kontrolunun uygulanmasi
	if (!filter_var($at, FILTER_VALIDATE_URL) === false) {

		$pingadresi = "ping -c 5 ". $at;

	    //http://stackoverflow.com/questions/20107147/php-reading-shell-exec-live-output
        	while (@ob_end_flush());
        
        	$sonuc = popen($pingadresi, 'r');
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
	
	} else {
    		echo "adres yanlış";
	}
    }
    
    if(isset($_GET['submit']) && !empty($_GET['adres']) ){
        pingAt();
    }
?>
