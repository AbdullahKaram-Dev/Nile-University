/*global $, console*/
$(function () {
    "use strict";
    // Start Loading
    var loading = document.getElementById("loader");
    document.onreadystatechange = function() {
        if (document.readyState !== "complete") {
            loading.style.visibility = "visible";
        } else {
            loading.style.visibility = "hidden";
        }
    };
    // End Loading
    // Signup & Login
    $('.go-to-signup-login').click(function(e){
        e.preventDefault();
        $(this).parent().parent().parent().hide();
        $(this).parent().parent().parent().siblings('.modal-body').show();
    });

    // Upload Deal Image 
    $('#deal_image').change(function() {
        $(this).siblings('label').text($(this)[0].files[0].name);
    });
});