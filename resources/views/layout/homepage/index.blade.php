<script>
    var page = 1;
    infinteLoadMore(page);

    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            page++;
            
            setTimeout( infinteLoadMore(page), 4000) 
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
                $('.auto-load').html("");
                return;
            }
            $('.auto-load').hide();
            $(".homepage").append(response);
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            console.log('Lỗi server');
        });
    }
</script>