$ = jQuery.noConflict();

/* Add class for user image  */

$('.user-profile-image').find('img').addClass('img-circle').attr("","");

$('#myTab a').click(function (e) {
    e.preventDefault()
    $(this).tab('show')
})