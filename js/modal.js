
$( document ).ready(function() {
  //verifica se al caricamento il contenuto dell'ID è vuoto
  if (document.getElementById('good-job').innerHTML !== ""){
       $('.modal-wrapper').toggleClass('open');
       $('body> :not(.modal-wrapper)').toggleClass('blur-it');
       return false;
  }
});
//anche alla pressione delle classi trigger (tra cui la X del popup)
$( document ).ready(function() {
  $('.trigger').on('click', function() {
     $('.modal-wrapper').toggleClass('open');
     $('body> :not(.modal-wrapper)').toggleClass('blur-it');
     return false;
  });
});
