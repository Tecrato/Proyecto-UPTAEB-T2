function cambiar_pagina_php(dir) { // Esta funcion cambia la pagina de productos
    window.location.href = `Controller/funcs/cambiar_pagina.php?dir=` + dir + "&p="+num_page+"&type="+ type_page;
}