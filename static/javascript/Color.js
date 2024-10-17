const colorLight = () => {
    let BG = document.querySelectorAll(".uk-background-secondary");
    let ukLight = document.querySelectorAll(".uk-light");
    document.getElementById("html").style.backgroundColor = "#fff";
    document.querySelector(".Bg-Main-home").style.backgroundColor = "#fff";

    BG.forEach((b) => {
        b.classList.remove("uk-background-secondary");
        b.classList.add("uk-background-muted");
    })
    ukLight.forEach((l) => {
        l.classList.remove("uk-light");
        l.classList.add("uk-dark");
    })

    if (document.querySelector(".img1ProductSwitcher") || document.querySelector(".img2ProductSwitcher") || document.querySelector(".img3ProductSwitcher")) {
        document.querySelector(".img1ProductSwitcher").src = "./static/images/cajas (2) newColor.png";
        document.querySelector(".img2ProductSwitcher").src = "./static/images/suministrosNewColor.png";
        document.querySelector(".img4ProductSwitcher").src = "./static/images/menuNewColor.png";
    }

    if (document.querySelectorAll(".img_config_logo")) {
        document.querySelectorAll(".img_config_logo").forEach((k) => {
            k.src = "./static/images/logo_letras-minimarketNewColor.png";
        })
    }


    document.querySelectorAll(".img_proveedor_container").forEach((el) => {
        el.style.backgroundColor = "#fff";
    });
    document.querySelectorAll(".img3ProductSwitcher").forEach((img) => {
        img.src = "./static/images/cajas (2) newColor.png";
    });
    if (document.querySelector(".item_profile-target") || document.querySelector(".item_profile-target-2")) {
        document.querySelector(".item_profile-target").style.backgroundColor = "#fff";
        document.querySelector(".item_profile-target-2").style.backgroundColor = "#fff";
    }

    if (document.querySelector(".target_supplier")) {
        document.querySelectorAll(".target_supplier").forEach((l) => {
            l.style.backgroundColor = "#fff";
        })
    }

    if (document.querySelectorAll(".titleReport")) {
        document.querySelectorAll(".titleReport").forEach((k) => {
            k.style.backgroundColor = "rgb(242 241 241)"
        })
    }

    if (document.querySelectorAll(".target-detail-fact")) {
        document.querySelectorAll(".target-detail-fact").forEach((k) => {
            k.style.backgroundColor = "#fff"
        })
    }


    if (document.querySelectorAll(".cont1_tar_fact")) {
        document.querySelectorAll(".cont1_tar_fact").forEach((k) => {
            k.style.backgroundColor = "#fff"
        })
    }


    if (document.querySelectorAll(".Container-fact-price")) {
        document.querySelectorAll(".Container-fact-price").forEach((k) => {
            k.style.backgroundColor = "#fff"
        })
    }

    if (document.querySelector(".generate-fact")) {
        document.querySelector(".generate-fact").style.color = "#fff";
    }


    document.querySelector(".Nav-bg").classList.add("uk-light")
}

const colorDark = () => {
    let BG = document.querySelectorAll(".uk-background-muted");
    let ukLight = document.querySelectorAll(".uk-dark");
    document.getElementById("html").style.backgroundColor = "#111";
    document.querySelector(".Bg-Main-home").style.backgroundColor = "#111";

    if (document.querySelector(".img1ProductSwitcher") || document.querySelector(".img2ProductSwitcher") || document.querySelector(".img3ProductSwitcher")) {
        document.querySelector(".img1ProductSwitcher").src = "./static/images/cajas (2).png";
        document.querySelector(".img2ProductSwitcher").src = "./static/images/suministros.png";
        document.querySelector(".img4ProductSwitcher").src = "./static/images/menu.png";
    }


    BG.forEach((b) => {
        b.classList.remove("uk-background-muted");
        b.classList.add("uk-background-secondary");
    })
    ukLight.forEach((l) => {
        l.classList.remove("uk-dark");
        l.classList.add("uk-light");
    })
    document.querySelector(".Nav-bg").classList.add("uk-light")

    if (document.querySelector(".target_supplier")) {
        document.querySelectorAll(".target_supplier").forEach((l) => {
            l.style.backgroundColor = "#333";
        })
    }
    document.querySelectorAll(".img_proveedor_container").forEach((el) => {
        el.style.backgroundColor = "#383838";
    });

    if (document.querySelectorAll(".titleReport")) {
        document.querySelectorAll(".titleReport").forEach((k) => {
            k.style.backgroundColor = "#1e1e1e"
        })
    }

    if (document.querySelectorAll(".target-detail-fact")) {
        document.querySelectorAll(".target-detail-fact").forEach((k) => {
            k.style.backgroundColor = "#333"
        })
    }

    if (document.querySelectorAll(".cont1_tar_fact")) {
        document.querySelectorAll(".cont1_tar_fact").forEach((k) => {
            k.style.backgroundColor = "#333"
        })
    }

    if (document.querySelector(".item_profile-target") || document.querySelector(".item_profile-target-2")) {
        document.querySelector(".item_profile-target").style.backgroundColor = "transparent";
        document.querySelector(".item_profile-target-2").style.backgroundColor = "transparent";
    }


    if (document.querySelectorAll(".Container-fact-price")) {
        document.querySelectorAll(".Container-fact-price").forEach((k) => {
            k.style.backgroundColor = "#33333349"
        })
    }


    
    if (document.querySelectorAll(".img_config_logo")) {
        document.querySelectorAll(".img_config_logo").forEach((k) => {
            k.src = "./static/images/logo_letras-minimarket.png";
        })
    }

}

const colorDefault = () => {

    let theme_checkbox = document.getElementById("theme-checkbox");

    theme_checkbox.addEventListener("change", () => {
        if (theme_checkbox.checked) {
            localStorage.setItem("btnColor", "false")
            colorDark()
        } else {
            localStorage.setItem("btnColor", "true")
            colorLight()
        }
    })
    if (localStorage.getItem("btnColor") == "true") {
        theme_checkbox.checked = false
        colorLight()
    } else {
        theme_checkbox.checked = true
        colorDark()
    }
}

colorDefault()