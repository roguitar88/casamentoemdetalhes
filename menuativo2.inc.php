<?php if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) header('Location: /orangeadex/casamentoemdetalhes');
?>
<script type="text/javascript">
/*
$(document).ready(function(){
 if (window.location.href.indexOf("myprofile") > -1) {
  $('#profile').css('background-color', 'green');
 } else if window.location.href.indexOf("dashboard") > -1) {
  $('#dashboard').css('background-color', 'green');
 } else if (window.location.href.indexOf("statistics") > -1) {
  $('#statistics').css('background-color', 'green');
 } else if (window.location.href.indexOf("reporting") > -1) {
  $('#reporting').css('background-color', 'green');
 } else if (window.location.href.indexOf("training") > -1) {
  $('#training').css('background-color', 'green');
 }
});
*/
$(document).each(function () {
    if (window.location.href.indexOf("home") > -1) {
      $('#home').css('border-bottom', '3px solid red');
     } else if (window.location.href.indexOf("nossahistoria") > -1) {
      $('#nossahistoria').css('border-bottom', '3px solid red');
     } else if (window.location.href.indexOf("fotos") > -1) {
      $('#fotos').css('border-bottom', '3px solid red');
     } else if (window.location.href.indexOf("enquetes") > -1) {
      $('#enquetes').css('border-bottom', '3px solid red');
     } else if (window.location.href.indexOf("localcasamento") > -1) {
      $('#localcasamento').css('border-bottom', '3px solid red');
     }
});
</script>