//DELETE
$('img[name="Supprimer"]').click(function(){
    if(confirm('Voulez vous vraiment supprimer l\'image: '+$(this).data('title')+' ?')){
        document.location="?menu=espace-client&delete="+$(this).data('image_id')+"&id="+$(this).data('user_id')+"&name="+$(this).data('name');
    }
});

//UPDATE
$('img[name="Modifier"]').click(function(){
    $('div#images_affiche form').css('display','none');
    $(this).parent().next().css('display','inline-block');
});

//ZOOM MINIATURE
$('div.image img.petite').click(function(){
   $('img.grande').remove();
   $(this).parent().prepend('<img class="grande" src="'+$(this).data('url')+'">'); 
});

$(document).keyup(function(e) {
     if (e.keyCode == 27) { 
        $('img.grande').remove();
    }
});

//COMPTEUR NOMBRE CARACTERES champ texte form contact
$(document).ready(function(e) {
    $('#message').keyup(function() {

      var nombreCaractere = $(this).val().length;
      
      $('#compteur').text(nombreCaractere + ' Caractere(s) / 500');
      
      if (nombreCaractere > 500) { $('#compteur').addClass("mauvais"); } else { $('#compteur').removeClass("mauvais"); }

    });
 });
