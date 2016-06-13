function charger(){

    setTimeout( function(){

        var premierID = $('#messages p:first').attr('id'); // on récupère l'id le plus récent

        $.ajax({
            url : "charger.php?id=" + premierID, // on passe l'id le plus récent au fichier de chargement
            type : 'get',
            success : function(html){  console.log(html);
                $('#messages').prepend(html);
            },
            error : function()
            {
              console.log('what ?');
            }
        });

        charger();

    }, 3000);

}

charger();
