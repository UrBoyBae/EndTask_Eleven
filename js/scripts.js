/*!
 * Start Bootstrap - SB Admin v7.0.5 (https://startbootstrap.com/template/sb-admin)
 * Copyright 2013-2022 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
 */
//
// Scripts
//

window.addEventListener("DOMContentLoaded", (event) => {
  // Toggle the side navigation
  const sidebarToggle = document.body.querySelector("#sidebarToggle");
  if (sidebarToggle) {
    // Uncomment Below to persist sidebar toggle between refreshes
    // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
    //     document.body.classList.toggle('sb-sidenav-toggled');
    // }
    sidebarToggle.addEventListener("click", (event) => {
      event.preventDefault();
      document.body.classList.toggle("sb-sidenav-toggled");
      localStorage.setItem(
        "sb|sidebar-toggle",
        document.body.classList.contains("sb-sidenav-toggled")
      );
    });
  }
});

var statusPengiriman = document.querySelectorAll("select#status-pengiriman");
statusPengiriman.forEach((select) => {
  select.addEventListener("change", () => {
    var uniqueid = select.getAttribute("data-id");
    var qty = document.getElementById("qty" + uniqueid);
    var qty2 = document.getElementById("qty2" + uniqueid);
    var pengirim = document.getElementById("idpg" + uniqueid);

    // Jika Libur
    if (select.value != 0) {
      // menambah option 'tidak ada pengiriman'
      var opt = document.createElement("option");
      opt.value = 0;
      opt.innerHTML = "Tidak Ada Pengiriman";
      pengirim.appendChild(opt);

      qty.setAttribute("disabled", true);
      qty.value = 0;
      if (qty2) {
        qty2.setAttribute("disabled", true);
        qty2.value = 0;
      }
      pengirim.setAttribute("disabled", true);
      pengirim.value = 0;
    } else {
      qty.removeAttribute("disabled");
      qty.value = 60;
      if (qty2) {
        qty2.removeAttribute("disabled");
        qty2.value = 0;
      }
      pengirim.removeAttribute("disabled");
      pengirim.value = 1;

      // hapus option 'tidak ada pengiriman'
      for (let i = 0; i < pengirim.length; i++) {
        if (pengirim.options[i].value == 0) {
          pengirim.remove(i);
        }
      }
    }
  });
});
