$(document).ready(()=>{
    if ($('#username').val() !== '') {
        $('placeholder-username').css('margin-top', -30);
    }
    if ($('#password').val() !== '') {
        $('placeholder-password').css('margin-top', -30);
    }

    $('#username').focus(()=>{
        $('.placeholder-username').css('margin-top', -30);
    });
    $('#username').focusout(()=>{ 
        if ($('#username').val() === '') {
            $('.placeholder-username').css('margin-top', 10);
        }
    });
    
    $('#password').focus(()=>{
        $('.placeholder-password').css('margin-top', -30);
    });
    $('#password').focusout(()=>{ 
        if ($('#password').val() === '') {
            $('.placeholder-password').css('margin-top', 10);
        }
    });
})


