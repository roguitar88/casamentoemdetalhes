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
    if (window.location.href.indexOf("inicio") > -1) {
      $('#inicio').css('background-color', 'white');
     } else if (window.location.href.indexOf("meucasamento") > -1) {
      $('#meucasamento').css('background-color', 'white');
     } else if (window.location.href.indexOf("presentes") > -1) {
      $('#presentes').css('background-color', 'white');
     } else if (window.location.href.indexOf("site") > -1) {
      $('#site').css('background-color', 'white');
     } else if (window.location.href.indexOf("convidados") > -1) {
      $('#convidados').css('background-color', 'white');
     }
});
</script>