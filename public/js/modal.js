//open modal change avatar
$('body').on('click','#myBtn-5',function(){
    $('#myModal-5').show();
  })
  $('body').on('click','#exit5',function(){
    $('#myModal-5').hide();
  })
  
var modal6 = document.getElementById("myModal-6");
var btn6 = document.getElementById("myBtn-6");
var exit6 = document.getElementById("exit6");
btn6.onclick = function() {
   modal6.style.display = "block";
} 
exit6.onclick = function() {
   modal6.style.display = "none";
}
   
var modal7 = document.getElementById("myModal-7");
var btn7 = document.getElementById("myBtn-7");
var exit7 = document.getElementById("exit7");
   
btn7.onclick = function() {
   modal7.style.display = "block";
} 
exit7.onclick = function() {
   modal7.style.display = "none";
} 

var modal5 = document.getElementById("myModal-5");
window.onclick = function(event) { 
   if (event.target == modal) {    
      modal.style.display = "none";
   }
   if (event.target == modal2) {    
      modal2.style.display = "none";
   }
   if (event.target == modal5) {    
      modal5.style.display = "none";
   }
   if (event.target == modal6) {    
      modal6.style.display = "none";
   }
   if (event.target == modal7) {    
      modal7.style.display = "none";
   } 
   $('.list').addClass('d-none');
}
var modal = document.getElementById("myModal"); 
var btn = document.getElementById("myBtn"); 
btn.onclick = function() {
   modal.style.display = "block";
}  
   
var modal2 = document.getElementById("myModal-2");
var btn2 = document.getElementById("myBtn-2");
var exit = document.getElementById("exit");
   
btn2.onclick = function() {
   modal2.style.display = "block";
} 
exit.onclick = function(event) {
    event.preventDefault();    
    modal2.style.display = "none";
} 