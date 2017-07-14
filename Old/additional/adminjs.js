$(document).ready(function(){
$(".password").focus(function(){
  $(".password-help").slideDown();
}).blur(function(){
  $(".password-help").slideUp();
});
});