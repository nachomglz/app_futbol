function navegacionMovil() {
  if (!$(".menu-btn").hasClass("open")) {
    $(".navegacion-movil").hide();
  }

  const menuBtn = document.querySelector(".menu-btn");
  let menuOpen = false;

  menuBtn.addEventListener("click", () => {
    $(".navegacion-movil").slideToggle();
    if (!menuOpen) {
      menuBtn.classList.add("open");
      menuOpen = true;
    } else {
      menuBtn.classList.remove("open");
      menuOpen = false;
    }
  });
}
function logoHeader() {
  $("#logo").hover(function() {
    var src = $(this).attr('src')
    src = src.split('/');
    if (src[3] === 'logo_blanco.png') {

      $(this).attr("src","/build/img/logo_color_blanco.png").stop(true,true).hide().fadeIn()

    } else {

            // $(this).attr("src","/build/img/logo_blanco.png").stop(true,true).hide().fadeIn()


    }

  });
}

navegacionMovil();
logoHeader();