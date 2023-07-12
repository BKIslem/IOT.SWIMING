$(".form").submit(function (evt) {
    var href = window.location.origin + window.location.pathname;
    evt.preventDefault();
    var form = $(this);
    var url = $(this).attr('action')
    $.ajax({
        type: 'POST',
        url: url,
        data: new FormData(this),
        contentType: false,
        processData: false,
        cache: false,
        beforeSend: function () {
        },
        success: function (resp) {
            console.log(resp)
            if (resp == "1") {
                href = href + '?user=home';
                location.reload(href);
            } else if (resp == "2"){
                href = href + '?user=coach';
                location.reload(href);
            }else if (resp == "3"){
                href = href + '?admin=home';
                location.reload(href);
            }
        }
    });
    return false
});