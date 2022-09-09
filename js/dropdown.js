// Script for user menu
$(document).ready(function(){
    $('.toggler-user').click(function(event){
        event.stopPropagation();
        $(this).next("#dropdown-user").slideToggle(350);
        if($('.navigation').hasClass('active')){
            $('.navigation').removeClass('active');
            $('.opener').removeClass('active');
            $('.content').removeClass('active');
        }
    });
    $("#dropdown-user").on("click", function (event) {
        event.stopPropagation();
    });

    $(document).on("click", function () {
        if($('#dropdown-user').css('display') != 'none'){
            $("#dropdown-user").slideToggle(350);
        }
    });

    $('.toggler-notifications').click(function(event){
        if($('#dropdown-user').css('display') != 'none'){
            $("#dropdown-user").slideToggle(350);
        }
    });
    
});
// Script for notification menu
$(document).ready(function(){
    $('.toggler-notifications').click(function(event){
        event.stopPropagation();
        $(this).next("#dropdown-noti").slideToggle(350);
        if($('.navigation').hasClass('active')){
            $('.navigation').removeClass('active');
            $('.opener').removeClass('active');
            $('.content').removeClass('active');
        }
    });
    $("#dropdown-noti").on("click", function (event) {
        event.stopPropagation();
    });

    $(document).on("click", function () {
        if($('#dropdown-noti').css('display') != 'none'){
            $("#dropdown-noti").slideToggle(350);
        }
    });
    
    $('.toggler-user').click(function(event){
        if($('#dropdown-noti').css('display') != 'none'){
            $("#dropdown-noti").slideToggle(350);
        }
    });
    
    $('.dropdown-noti-link').click(function(){
        if($('#dropdown-noti').css('display') != 'none'){
            $("#dropdown-noti").slideToggle(350);
        }
    });

    $('.dropdown-noti-foot').click(function(){
        if($('#dropdown-noti').css('display') != 'none'){
            $("#dropdown-noti").slideToggle(350);
        }
    });
});