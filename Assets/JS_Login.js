$(document).ready(function(){

  $('.checkShowPassword').click(function(){
    if('password' == $('.test-input').attr('type')){
         $('.test-input').prop('type', 'text');
    }else{
         $('.test-input').prop('type', 'password');
    }
  });
})