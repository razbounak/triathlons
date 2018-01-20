$(document).ready(function (){
    $('ul li').click(function(){

        var text = $(this).children('div');

        if (text.is(':hidden')){
            text.slideDown('500');
            $(this).children('span').html('-');
        }

        else {
            text.slideUp('300');
            $(this).children('span').html('+');
        }
    });
});