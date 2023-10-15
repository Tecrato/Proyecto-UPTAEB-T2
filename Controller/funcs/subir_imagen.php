<?php
	function subir_imagen($imagen,$inicial="", $replace=false){
		$extensiones = [0=>'image/jpg',1=>'image/jpeg',2=>'image/png'];
		if ($imagen['error']){
	        return 1;
	    }
	    elseif (!in_array($imagen['type'], $extensiones)) {
	        return 2;
	    }
	    elseif ($imagen['size'] > 20000000) {
	        return 5;
	    }
	    elseif (file_exists('../../Media/imagenes/'.$inicial) and $replace) {
	        return 3;
	    } 
	    elseif (!move_uploaded_file($imagen['tmp_name'],'../../Media/imagenes/'.$inicial)) {
	        return 4;
	    }
	    return false;
	}
?>