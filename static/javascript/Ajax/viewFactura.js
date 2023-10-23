let tarjetaFactura = document.querySelectorAll(".Target_factura");

tarjetaFactura.forEach((tj) => {
  tj.addEventListener("click", () => {
    tj.tabIndex = tj.getAttribute("id");

    let iframe = document.querySelector(".iframe");
    iframe.src = iframe.src;
  });
});
