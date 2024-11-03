<?php
	if (!is_file('src/Media/imagenes/'.$_GET['img'])) {
		echo "No existe la imagen ".$_GET['img'];
		exit(1);
	}
	header('Location:src/Media/imagenes/'.$_GET['img']);
	exit(0);

?>