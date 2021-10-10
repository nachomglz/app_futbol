$('.option-menu').hide();

$('.option-menu-button').click( function() {
    $(this).toggleClass('selected');
    if ($(this).next().css('display') === 'flex') {
        $('.option-menu').slideUp();
    } else {
        $(this).next().slideToggle();
    }
})

$('.player-container').click( (e)=> {
    var clicked = e.target.closest('.player');
    $(clicked).toggleClass('flipped');
})
