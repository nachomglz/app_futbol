if (!$('.menu-btn').hasClass('open')) {
    $('.navegacion-movil').hide();
}




const menuBtn = document.querySelector('.menu-btn');
let menuOpen = false;

menuBtn.addEventListener('click', () => {
    $('.navegacion-movil').slideToggle();
    if (!menuOpen) {
        menuBtn.classList.add('open');
        menuOpen = true;
    } else {
        menuBtn.classList.remove('open');
        menuOpen = false;
    }
})