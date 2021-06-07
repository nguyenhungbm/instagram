

//  add and update avatar  

function uploadUserAvatar(input,form){ 
   UpdateUserAvatar(form); 
}

function ReadUrl(input){
$('#myModal-5').hide();
 if(input.files && input.files[0]){
    var reader =new FileReader();
    reader.onload= function(e){
       $('.avatar_user_uploaded').attr('src',e.target.result); 
    }
 } 
 reader.readAsDataURL(input.files[0]);
}
function UpdateUserAvatar(form){
 let myForm = document.getElementById(form);
 let formData = new FormData(myForm);
 $('#myModal-5').hide();
  var url="/upload_user";
  $.ajax({
       type: 'POST',
       data: formData,
       dataType: 'JSON',
       contentType: false,
       cache: false,
       processData: false,
       url:url,
       beforeSend:function(){
         $('.imguser').show();
         $('.avatar_user_uploaded').addClass('constrast');
       },
       complete:function(){
         $('.avatar_user_uploaded').removeClass('constrast');
         $('.imguser').hide();
       },
       success:function(e){    
         $('.img').empty();
         $('.img').prepend(`
         <img src="uploads/user/'+${e.avatar}" class="rounded-circle user cs avatar_user_uploaded" id="myBtn-5">
         <img src="img/loading.gif" class="imguser" style="display:none;">
         `);
         $('.avatar_user_uploaded').attr('src','uploads/user/'+e.avatar);
       }
  })
} 

 $(function(){
   //upload into avatar
    $('#profiles').on('change',function(ev){ 
      var reader=new FileReader(); 
      reader.onload=function(ev){
        $('#image-post').attr('src',ev.target.result).css('width','350px').css('height','350px').css('margin-bottom','50px'); 
      }
      reader.readAsDataURL(this.files[0]);   
          $('#myModal-4').hide();   
          $('.image').removeClass('d-none');
      
    });
    //add to stories
    $('#stories').on('change',function(ev){ 
      var reader=new FileReader(); 
      reader.onload=function(ev){
        $('#image-post').attr('src',ev.target.result).css('width','350px').css('height','350px').css('margin-bottom','50px'); 
      }
      reader.readAsDataURL(this.files[0]);   
          $('#myModal-4').hide();   
          $('.image').removeClass('d-none');
      
    });
//remove_current_photo
$('.remove_current_photo').on('click',function(){
  var url="/delete"; 
  $('#myModal-5').hide();    
   $.get({
      url:url,
      beforeSend:function(){
        $('.imguser').show();
        $('.avatar_user_uploaded').addClass('constrast');
      },
      complete:function(){
        $('.imguser').hide();
        $('.avatar_user_uploaded').removeClass('constrast');
      },success:function(){
      $('.img').empty();
      $('.img').prepend(`
      <label for="upload_user_avatar"> <img src="/img/no-user.png" class="rounded-circle user cs avatar_user_uploaded"></label> 
      <img src="img/loading.gif" class="imguser" style="display:none;">
      `);
      $('.avatar_user_uploaded').attr('src','/img/no-user.png');
      }
   })
  }) 
       
  //update gender
    
  $('.update_gender').on('click',function(e){
    e.preventDefault();
    let URL =$(this).parents('form').attr('action');    
     $.ajax({
        url:URL,
        method:"POST",
        headers:{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
      },
        data:$('.form-question').serialize(),
        beforeSend:function(){
          $('.uploadavatars').show();
          $('.update_gender').addClass('os');
        },
        complete:function(){
          $('.uploadavatars').hide();
          $('.update_gender').removeClass('os');
        },success:function(data){
          $('#myBtn-6').val(data);
        $('#myModal-6').hide();    
        
        }
     })
    }) 
 })