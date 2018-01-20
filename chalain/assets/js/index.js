$('#toggle').click(function() {
    $(this).toggleClass('active');
    $('#overlay').toggleClass('open');
});
$("a").click(function() {
    $("#toggle").removeClass("active");
    $("#overlay").removeClass("open");
});