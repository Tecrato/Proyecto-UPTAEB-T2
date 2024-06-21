// let  BG = document.querySelectorAll(".uk-background-secondary");
// let ukLight = document.querySelectorAll(".uk-light");
// document.getElementById("html").style.backgroundColor = "#fff";
// document.querySelector(".Bg-Main-home").style.backgroundColor = "#fff";

// BG.forEach((b)=>{
//     b.classList.remove("uk-background-secondary");
//     b.classList.add("uk-background-muted");
// })


// ukLight.forEach((l)=>{
//     l.classList.remove("uk-light");
//     l.classList.add("uk-dark");
// })

// document.querySelector(".Nav-bg").classList.add("uk-light")


// const btnModeColorView = document.querySelector(".btn-ModeColorView");
// const btnModeColorView2 = document.querySelector(".btn-ModeColorView2");
// const ColorViewLight = () => {
//   document.querySelectorAll(".uk-background-secondary").forEach((element) => {
//     element.classList.remove("uk-background-secondary");
//     element.classList.add("uk-background-default");
//     document.querySelectorAll(".uk-light").forEach((element2) => {
//       element2.classList.remove("uk-light");
//       element2.classList.add("uk-dark");
//       document.querySelector(".Bg-Main-home").style.backgroundColor = "#f7f7f7";
//       if (
//         document.querySelector(".img1ProductSwitcher") ||
//         document.querySelector(".img2ProductSwitcher")
//       ) {
//         document.querySelector(".img1ProductSwitcher").src =
//           "./static/images/cajas (2) newColor.png";
//         document.querySelector(".img2ProductSwitcher").src =
//           "./static/images/suministrosNewColor.png";
//       }
//       document.querySelectorAll(".img_proveedor_container").forEach((el) => {
//         el.style.backgroundColor = "#fff";
//       });
//       document.querySelectorAll(".img3ProductSwitcher").forEach((img) => {
//         img.src = "./static/images/cajas (2) newColor.png";
//       });
//       if (
//         document.querySelector(".item_profile-target") ||
//         document.querySelector(".item_profile-target-2")
//       ) {
//         document.querySelector(".item_profile-target").style.backgroundColor =
//           "#fff";
//         document.querySelector(".item_profile-target-2").style.backgroundColor =
//           "#fff";
//       }

//       document.querySelector(".formSearchHeader").classList.add("uk-light");
//       document.querySelector(".iconNotification").classList.add("uk-light");
//     });
//   });

//   let iconMoon2 = ` <img class="iconMoon" src="static/images/moon-solid.svg" alt="" width="18px"> `;
//   btnModeColorView.innerHTML = iconMoon2;
//   btnModeColorView2.innerHTML = iconMoon2;
// };
// ColorViewLight();
// const ColorViewDark = () => {
//   document.querySelectorAll(".uk-background-default").forEach((element) => {
//     element.classList.add("uk-background-secondary");
//     element.classList.remove("uk-background-default");
//     document.querySelectorAll(".uk-dark").forEach((element2) => {
//       element2.classList.add("uk-light");
//       element2.classList.remove("uk-dark");
//       document.querySelector(".Bg-Main-home").style.backgroundColor = "#111";
//       if (
//         document.querySelector(".img1ProductSwitcher") ||
//         document.querySelector(".img2ProductSwitcher")
//       ) {
//         document.querySelector(".img1ProductSwitcher").src =
//           "./static/images/cajas (2).png";
//         document.querySelector(".img2ProductSwitcher").src =
//           "./static/images/suministros.png";
//       }
//       document.querySelectorAll(".img_proveedor_container").forEach((el) => {
//         el.style.backgroundColor = "rgb(62, 62, 62)";
//       });
//       document.querySelectorAll(".img3ProductSwitcher").forEach((img) => {
//         img.src = "./static/images/cajas (2).png";
//       });
//       if (
//         document.querySelector(".item_profile-target") ||
//         document.querySelector(".item_profile-target-2")
//       ) {
//         document.querySelector(".item_profile-target").style.backgroundColor =
//           "rgb(62, 62, 62)";
//         document.querySelector(".item_profile-target-2").style.backgroundColor =
//           "rgb(62, 62, 62)";
//       }

//       // document.querySelector(".formSearchHeader").classList.add("uk-light")
//       // document.querySelector(".iconNotification").classList.add("uk-light")
//     });
//   });
//   let iconSun = `<img class="iconSun" src="static/images/sun-solid.svg" alt="" width="23px">`;
//   btnModeColorView.innerHTML = iconSun;
//   btnModeColorView2.innerHTML = iconSun;
// };

// btnModeColorView.addEventListener("click", () => {
//   let light = btnModeColorView.classList.toggle("light");
//   localStorage.setItem("btnSwitch", light);

//   let valor = localStorage.getItem("btnSwitch");
//   if (valor == "false") {
//     ColorViewLight();
//   } else {
//     ColorViewDark();
//   }
// });
// btnModeColorView2.addEventListener("click", () => {
//   console.log('pul');
//   let light = btnModeColorView2.classList.toggle("light");
//   localStorage.setItem("btnSwitch", light);

//   let valor = localStorage.getItem("btnSwitch");
//   if (valor == "false") {
//     ColorViewLight();
//   } else {
//     ColorViewDark();
//   }
// });

// let valor = localStorage.getItem("btnSwitch");
//   if (valor == "false") {
//     ColorViewLight();
//   } else { 
//     ColorViewDark();
//   }