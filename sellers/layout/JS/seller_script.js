$(document).ready(function() {


    // this is to change the position of admin edit
    var edit_out = document.querySelector('.edit_out');
    var edit_in = document.querySelector('.edit_in');
    var navbar_nav = document.querySelector('.navbar-nav');
    
    if ($('body').width() <= 990 ){
        $(edit_out).hide();
        $(navbar_nav).css("padding" , '0');
    } else {
        $(edit_in).hide();
    }

});