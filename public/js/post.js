//like
function likepost(postId){    
    $.get({
        url:"/like/post",
        data:{r_post:postId},
        success:function(e){     
        $('.like'+postId).text(e.post.p_favourite);
        $('.likes'+postId).text(e.post.p_favourite);
        if(e.action=='them'){
            if(e.post.p_favourite==1){
                $('#myBtn-'+e.post.id).prepend(`
                  <b class="like${e.post.id}">1</b> ${e.word}
                `);
            }
            $('.posts'+e.post.id).prepend(`
                <div class="clr users${e.user.id}${e.post.id}" style="height: 50px;">
                <a href="${e.user.user}" class="zx position-relative" style="width:75%">
                <img src="${e.avatar}" class="w-35 rounded-circle"> 
                <b class="zz">${e.user.user}</b><br>
                <b class="os zpo">${e.user.c_name}</b>
                </a>
                </div>
            `);
        }
        if(e.action=='bot'){
            if(!e.post.p_favourite)
            $('#myBtn-'+e.post.id).empty();
            $('.users'+e.user.id+e.post.id).remove();
        }
        }
    })
 }  
//folow 

function follow(followed){      
    $.post({
        url:"/follow",
        headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{followed:followed},
        beforeSend:function(){
            //welcome (Gợi ý cho bạn)
            $('.load'+followed).show();
            $('.follow'+followed).hide();
            //button gần user
            $('.follow').addClass('os');   
            $('.unfollow').addClass('os');  
            $('.text-follows'+followed).empty();
            $('.fa-user-times').addClass('d-none');
            
        },
        complete:function(){
            //welcome (Gợi ý cho bạn)
            $('.load'+followed).hide();
            $('.follow'+followed).show();
            //button gần user
            $('.follow').removeClass('os');
            $('.unfollow').removeClass('os');
        },
        success:function(data){  
            $('.list-follow').empty();
            $('.follower').text(data.user.follower);
            if(data.action =='bot'){
            //welcome (Gợi ý cho bạn)   
            $('.follow'+followed).addClass('text-blue');
            $('.follow'+followed).text(data.text_follow);
           //button gần user
           $('.list-follow').prepend(` 
           <button class="follow" onclick="follow('${data.user.id}')">
                 <img src="img/loading.gif" class="w-30 load${data.user.id}" style="display:none">
                 <p class="text-follows${data.user.id}">${data.text_follow}</p>
            </button>  
           `);
           //hiện user trong số người theo dõi
           if(!data.user.follower){
               $('.settingss').empty();
               $('.settingss').prepend(`
               <li class="k-none"><i class="fa fa-lg fa-user-plus"></i></li>
               <li class="k-none two">${data.user_follow}</li>
               <li class="k-none three">${data.see_user_follow}</li>
               `);
           }else    $('.user'+data.auth.id).remove();  
            }
            else{
            //welcome(gợi ý cho bạn)
            $('.follow'+followed).removeClass('text-blue');
            $('.follow'+followed).text(data.text_follow);
             //button gần user
            $('.list-follow').prepend(` 
            <a href="/direct/${data.user.id}" class="message">${data.see_user_follow}</a>
            <a class="unfollow follows${data.user.id} "href="javascript:;"  onclick="follow('${data.user.id}')"><i class="fa fa-user-times"></i>
            <img src="img/loading.gif" class="w-30 load${data.user.id}" style="display:none;margin-top: -11px;">
            </a>
            `);
            //user trong số người theo dõi
            if(data.user.follower==1) $('.settingss').empty();
            
            $('.settingss').prepend(`
                <li class="clr user${data.auth.id}" style="height: 50px;">
                     <a href="${data.auth.user}" class="zx position-relative ">
                     <img src="${data.avatar}" class="w-35 rounded-circle"> 
                     <b class="zz">${data.auth.user}</b><br>
                     <b class="os">${data.auth.c_name}</b>
                     </a>
            `);
             
            
            }
        
        }
    })
}
 
//user trong số người theo dõi trong trang của người khác
function follows(followed){      
    $.post({
        url:"/follow",
        headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{followed:followed},
        beforeSend:function(){
             
            $('.load'+followed).show(); 
            
            $('.zc'+followed).addClass('os'); 
            $('.cen'+followed).text('');
            
        },
        complete:function(){ 
            $('.load'+followed).hide();
            $('.zc'+followed).removeClass('os');
        },
        success:function(data){
            $('.zc'+followed).toggleClass('follows');
            $('.zc'+followed).toggleClass('followss'); 
            if(data.action=='bot'){ 
                $('.cen'+followed).text(data.text_follow);
            }
            else{ 
            $('.cen'+followed).text(data.text_follow);
            }
        }
    })
    }

    
 //user trong số  người đang theo dõi trong auth
function followss(followed){      
    $.post({
        url:"/follow",
        headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{followed:followed},
        beforeSend:function(){
             
            $('.load'+followed).show(); 
           
            $('.zc'+followed).addClass('os'); 
            $('.cen'+followed).text('');
            
        },
        complete:function(){
            //welcome (Gợi ý cho bạn)
            $('.load'+followed).hide();
            $('.zc'+followed).removeClass('os');
        },
        success:function(data){   
            $('.count').text(data.followed);
            $('.zc'+followed).toggleClass('follows');
            $('.zc'+followed).toggleClass('followss'); 
            if(data.action=='bot'){ 
                $('.cen'+followed).text(data.text_follow);
                if(!data.followed){
                    $('.list').empty();
                    $('.list').prepend(`
                    <li><i class="fa fa-lg fa-user-plus"></i></li>
                    <li class="two">${data.user_follow}</li>
                    <li class="three">${data.see_user_follow}</li>
                    `);
                }
                else  $('.users'+followed).remove(); 
            }
            else{ 
            $('.cen'+followed).text(data.text_follow);
            if(data.followed==1) $('.list').empty();
            $('.list').prepend(`
            <li class="clr users${followed}" style="height: 50px;">
            <a href="${data.user.user}" class="zx position-relative">
            <img src="uploads/user/${data.user.avatar}" class="w-35 rounded-circle"> 
            <b class="zz">${data.user.user}</b><br>
            <b class="os">${data.user.c_name}</b>
            </a>
            <button class="followss zc${followed}" onclick="followss('${followed}')" ><cen class="cen${followed}">${data.text_follow}</cen>
            <img src="img/loading.gif" class="w-30 load${followed}" style="display:none;margin-top: -11px;">
            `);
            }
        }
    })
    }
 