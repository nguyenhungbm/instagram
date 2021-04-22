<script>
$(document).ready(function(){
    var limit = 6;
    var start = 0;
   
    var action = 'inactive';
    if(action == 'inactive'){
        action = 'active';
        loadData(limit,start);
    }
    $(window).scroll(function() {
        if($(window).scrollTop() == $(".post-image").height() - $(window).height()) {
            alert(2);
           action = 'active';
           start = start + limit;
           setTimeout(function(){
               loadData(limit,start);
           },1000)
    }
});
})
$.ajaxSetup({
    headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
function loadData(limit , start){
    var userId = "{{$user_id}}";
    var user = "{{$user}}";
    $.post({
        url : "{{ route('loadmore') }}",
        data:{ limit : limit , start : start , user_id : userId , user : user},
        cache:false,
        success:function(data){
                if(data == '' && start == 0){
                    $('.post-image').html(`
                    <div class="clr">
                        <br>
                        <div class="hea">
                            <b>{{ __('translate.Start capturing and sharing your moments.')}}</b>
                            <p>{{ __('translate.Get the app to share your first photo or video.')}}</p>
                            <br><br>
                            <img src="{{ asset('img/appstore.png')}}" class="cs" style="height:40px;width:135px">
                            <img src="{{ asset('img/chplay.png')}}" class="cs" style="height:40px;width:135px">
                        </div>
                    </div>
                    <div><img src="{{ asset('img/everything.png')}}" class="float-left hed"></div>
                    <br>
                    `);
                    action = 'active';
                }
                if(data == '' && start != 0){
                    action = "active";
                }
                if(data != ''){
                    $('.post-image .clr').prepend(data);
                    action = "inactive";
                }
              
            }
        })
}
    
</script>