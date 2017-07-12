$(document).ready(function(){
$(".password").focus(function(){
  $(".password-help").slideDown(500);
}).blur(function(){
  $(".password-help").slideUp(500);
});
});