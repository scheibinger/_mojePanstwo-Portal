$(document).ready(function () {
    var $hackerList = $('#hacker-list'),
        options = {
            valueNames: [ 'title', 'desc', 'hidden' ]
        };

    var hackerList = new List('hacker-list', options);

    $hackerList.find('.searchInput').submit(function (event) {
        event.preventDefault();
    });
});