require('./bootstrap');

$(document).ready(function() {

    $('.responsive').on('click', function(event) {
        
        $('.menu-list').slideToggle(400);
        event.preventDefault();
    });
});