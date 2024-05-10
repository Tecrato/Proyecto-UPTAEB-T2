<?php
	if (!is_file('../../Media/imagenes/'.$_GET['img'])) {
		echo "No existe la imagen ".$_GET['img'];
		exit(1);
	}
	header('Location:Media/imagenes/'.$_GET['img']);
	exit(0);

?>