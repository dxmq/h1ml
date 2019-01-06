$(document).ready(function() {
    FastClick.attach(document.body);
    $("img").lazyload({
        effect : "fadeIn"
    });
});