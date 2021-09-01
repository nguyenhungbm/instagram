<script>
    var page = 1;
    infinteLoadMore(page);

    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            page++;
            infinteLoadMore(page);      
        }
    });

    function infinteLoadMore(page) {
        $.ajax({
            url: "?page=" + page,
            datatype: "html",
            type: "get",
            beforeSend: function () {
                $('.auto-load').show();
            }
        })
        .done(function (response) {
            if (response.length == 0) {
                $('.auto-load').html("Bạn đã xem hết tin");
                return;
            }
            $('.auto-load').hide();
            $(".postss").append(response);
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            console.log('Lỗi server');
        });
    }
</script>