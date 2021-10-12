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

$.ajax({
    type: "GET",
    url: "/countries.php",
    dataType: "json",
    success: function (res) {
        res.forEach((pais) => {
            $("#country-filter").append(
              `<option value="${pais.Codigo}">${pais.Pais}</option>`
            );
          });
    }
});

$.ajax({
    type: "GET",
    url: "/positions.php",
    dataType: "json",
    success: function (res) {
        res.forEach(position => {
            $('#position-filter').append(
              `<option value="${position.id}">${position.name}</option>`
            )
        });
    }
});

$('.filter').on('change', (e) => {
    // e.target.value
    


  });



