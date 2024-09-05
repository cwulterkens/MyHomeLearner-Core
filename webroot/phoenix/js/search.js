$(document).ready(function() {
    $('.search-form').submit(function(e) {
        e.preventDefault();
        var searchValue = $('input[name="query"]').val();
        window.location.href = 'https://www.myhomelearner.com/search/' + searchValue;
    });
});
