if (localStorage.getItem("intro") == "true") {
    introJs().setOptions({
        exitOnOverlayClick: false,
        disableInteraction: true,
        nextLabel: 'Siguiente',
        prevLabel: 'Anterior',
        doneLabel: 'Hecho',
        'steps': [{
                'element': document.getElementById('inpSeed'),
                'title': 'Semilla.',
                'intro': 'Aqui puede visualizar su semilla unica, ESTA DEBE ALMACENARCE EN UN SITIO SEGURO. Con esta se realiza la recuperacion de su contraseña.',
                'position': 'left'
            }
        ]
    }).start();
    setTimeout(()=>{
        localStorage.setItem("intro", "false")
    },1000)
}
document.getElementById('seedInfo').addEventListener("click", function(event) {
    introJs().setOptions({
        exitOnOverlayClick: false,
        disableInteraction: true,
        nextLabel: 'Siguiente',
        prevLabel: 'Anterior',
        doneLabel: 'Hecho',
        'steps': [{
                'element': document.getElementById('inpSeed'),
                'title': 'Semilla.',
                'intro': 'Aqui puede visualizar su semilla unica, ESTA DEBE ALMACENARCE EN UN SITIO SEGURO. Con esta se realiza la recuperacion de su contraseña.',
                'position': 'left'
            }
        ]
    }).start();
});
