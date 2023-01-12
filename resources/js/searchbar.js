import $ from "jquery"

$("#searchbar").on('keypress', function (e) {
    if (e.key === "Enter") {
        const url = '/search?q=' + encodeURI($(this).val());
        window.location.href = url;
    }
});