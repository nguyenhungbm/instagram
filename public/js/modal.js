$(function(){
    //qr code
    $('body').on('click', '#myBtn-1',function(){
        $('#myModal-1').show();
        var url ="/qr/login";
        console.log(url);
        $.get({
            url:url,
            success:function(e){
                $('.img-thumbnails').attr('src',e.img); 
            }
        })
    }) 
    $('body').on('click', '#exit1',function(){
        $('#myModal-1').hide();
    })
    $('#myModal-1').on('click',function(event){
        if(event.target == document.getElementById("myModal-1")) 
            $(this).hide()
    })
     //cài đặt
    $('body').on('click', '#myBtn-2',function(){
        $('#myModal-2').show();
    })
    $('body').on('click', '#exit2',function(){
        $('#myModal-2').hide();
    })
    $('#myModal-2').on('click',function(event){
        if(event.target == document.getElementById("myModal-2")) 
            $(this).hide()
    })
    //cài đặt
    $('body').on('click', '#myBtn-3',function(){
        $('#myModal-3').show();
    })
    $('body').on('click', '#exit3',function(){
        $('#myModal-3').hide();
    })
    $('#myModal-3').on('click',function(event){
        if(event.target == document.getElementById("myModal-3")) 
            $(this).hide()
    })

    //đăng bài
    $('body').on('click', '#myBtn-4',function(){
        $('#myModal-4').show();
            })
        $('body').on('click', '#exit4',function(){
        $('#myModal-4').hide();
            })
        $('#myModal-4').on('click',function(event){
            if(event.target == document.getElementById("myModal-4")) 
                $(this).hide()
        })

    //avatar
    $('body').on('click', '#myBtn-5',function(){
        $('#myModal-5').show();
    })
    $('body').on('click', '#exit5',function(){
        $('#myModal-5').hide();
    })
    $('body').on('click', '#myModal-5',function(event){
        if(event.target == document.getElementById("myModal-5")) 
        $(this).hide()
    })

    //theo dõi
    $('body').on('click', '#myBtn-6',function(){
        $('#myModal-6').show();
    })
    $('body').on('click', '#exit6',function(){
        $('#myModal-6').hide();
    })
    $('#myModal-6').on('click',function(event){
        if(event.target == document.getElementById("myModal-6")) 
            $(this).hide()
    })

    //đang theo dõi
    $('body').on('click', '#myBtn-7',function(){
        $('#myModal-7').show();
    })
    $('body').on('click', '#exit7',function(){
        $('#myModal-7').hide();
    })
    $('#myModal-7').on('click',function(event){
        if(event.target == document.getElementById("myModal-7")) 
            $(this).hide()
    })

    //thông tin bài viết
    $('body').on('click', '#myBtn-8',function(){
        $('#myModal-8').show();
    })
    $('body').on('click', '#exit8',function(){
        $('#myModal-8').hide();
    })
    $('#myModal-8').on('click',function(event){
        if(event.target == document.getElementById("myModal-8")) 
            $(this).hide()
    })
}) 
window.onclick = function(event) { 
   $('.list').addClass('d-none');
}  