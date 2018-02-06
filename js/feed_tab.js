$(document).ready(function () {
    $('.box').ready(function () {
        $.getJSON('ajax.php', {},
            function (data) {
                if (data.STATUS == 250) {
                    for (var n in data.RESULT) {
                        for (var l in data.RESULT[n]) {
                            $('#feed_' + n + ' ul').append(data.RESULT[n][l]);
                        }
                    }
                }
                else {
                    alert(data.MESSAGE);
                }
            });
    });
    $('.feed_b').hover(
        function () {
            $(this).animate({'right': '+=' + $(this).width() + 'px'});
        },
        function () {
            $(this).animate({'right': '+=-' + $(this).width() + 'px'});
        }
    );
});