$.ajax({
    url: "Controller/funcs_ajax/estadisticas.php",
    type: "GET",
    data: { select: "ratio_ventas" },
    success: function (response) {
        console.log(response);
    }
})