Array.prototype.contains = function(a){
	for(var i = 0; i < this.length; i++){
		if(this[i] == a) return true;
	}
	return false;
};

(function($){
	
	var $container = $('#filles-ajax-loading');
	var root = '/';
	var page = 1;
	var exhausted = false;
	
	var loading = false;
	var filter = false;
	var search = '';
	
	
	function get(nb){
		
		if(exhausted || loading) return false;
		
		loading = true;
		
		var nb = nb || 10;
		$.ajax({
			url : '/fichiersAjax/scroll-rank.php',
			type :'POST',
			dataType :'json',
			data : '&action=rank&page='+page+'&nb='+nb,
			success : function(retour_php)
			{
				for(var i = 0; i < data.length; i++){
					createNode(data[i],i);
				}
			}
			error : function(retour_error)
			{
				alert(retour_error);
			}
			
		});/*
		$.post(
			root+'fichiersAjax/scroll-rank.php',
			{
				nb : nb,
				page : page,
				filter : filter,
				search : search
			},
			function(data){
				
				if(!filter && !search){
					loading = false;
					page++;
					
				}
				
				for(var i = 0; i < data.length; i++){
					createNode(data[i],i);
				}
				
			},
			'json'	
		);*/
		
		return false;
		
	}
	
	
	
	
	function createNode(data,i){
		
		if(!data.link)
			data.link = 'escorte-massage-tantrique-bruxelles-'+data.nom+'-'+data.id_fille;
		
		
		data.link_content = generateLinkText(data.nom,data.age,i);	
			
		var html = '<div class="col-lg-3 col-md-4 col-sm-6 fleet-grid layout-grid wow fadeInDownBig">';
		html += '<div class="thumb fleet-thumb">';
		
		
			html += '<div class="overlay">';
			
				html += '<img src="photos/'+data.id_fille+data.nom+'/'+data.id_fille+data.nom+'1.png" alt="Massage tantrique '+data.nom+'" width="270" height="390" />';
				
				html += '<div class="overlay-shadow"><div class="overlay-content">';
				
				html += '<a href="'+data.link+'" class="btn light" title="Massage tantrique '+data.nom+'" onClick="compteurFille('+data.id_fille+')">Escort Girl</a>';
				
				html += '</div></div>'; // .overlay-content > .overlay-shadow
			
			html += '</div>'; // .overlay
			
			
			html += '<div class="fleet-vechicle-content">';
				
				html += '<header class="fleet-vechicle-header">';
				
				html += '<h5><a href="'+data.link+'">'+data.link_content+'</a></h5>';
				
				html += '<span>Prix : '+data.prix+' € / h</span>';
				
				html += '</header>'; // .fleet-vehicle-header
				
				
				html += '<ul class="custom-list fleet-vechicle-properties">'
		        html += '<li>'+data.ville+' <strong>'+data.tel+'</strong> </li>';
				html += '</ul>';
				
				
			html += '</div>'; // .fleet-vechicle-content
			
		
		html += '</div>'; // .thumb.fleet-thumb
		html += '</div>'; // .col-lg-3
		
		
		$container.append(html);
		
	}
	
	
	function generateLinkText(nom,age,i){
		
		var link_content = "";
		
		if(!window.lang || window.lang == 'fr'){
			if(i%2 == 0) link_content = 'Escortes '+nom+' Bruxelles '+age+' ans';
			if(i%2 != 0 && i.length%3 == 0) link_content = 'Escorte &#224; Bruxelles '+nom+' '+age+' ans';
			if(i%2 != 0 && i.length%3 != 0) link_content = nom+' escorte &#224; Bruxelles '+age+' ans';
		}
		
		if(window.lang == 'en'){
			if(i%2 == 0) link_content = 'Escort Brussels '+nom+' '+age+' years old';
			else link_content = nom+' escort on Brussels '+age+' years old';
		}
		
		if(window.lang == 'es'){
			if(i%2 == 0) link_content = 'Escorte Brusselas '+nom+' '+age+' años';
			else link_content = nom+' escort en Brusselas '+age+' años';
		}
		
		
		
		return link_content;
		
	}
	
	
	/* Launch first AJAX Query */
	
	get();
	
	
	/* Infinite scroll */
	
	var footerHeight = $('#footer').height();
	
	
	$(window).scroll(function(e){

		var h = $(document).height() - $(window).height();
		if(h <= 0) return false;

		var top = $(window).scrollTop();

		if(h - top - footerHeight < 450 && !filter)
			get();


	});
	
	
	function reset(){
		page = 1;
		exhausted = false;
		loading = false;
		$container.empty();
		search ='';
	}
	
	/* Search */
	
	$('#ajax-search').click(function(){
		
		filter = {
	        prixMin : $('#prixMin').val(),
	        prixMax : $('#prixMax').val(),
	        ageMin : $('#ageMin').val(),
	        ageMax : $('#ageMax').val(),
	        tailleMin : $('#tailleMin').val(),
	        tailleMax : $('#tailleMax').val(),
	        poidsMin : $('#poidsMin').val(),
	        poidsMax : $('#poidsMax').val(),
	        salon : $('#salons').val(),
	        peau : $('#peau').val(),
	        poitrine : $('#poitrine').val()
	    }
		
		reset();
		
		get();
		
		return false;
		
		
	});
	
	
	$('#form_recherche').submit(function(e){
		e.preventDefault();
		
		reset();
		search = $(this).find('input[name=nom]').val();
		
		
		get();
		
		return false;
	});
	
	$('#clear').click(function(){
		
		
		loaded = [];
		exhausted = false;
		loading = false;
		$container.empty();
		filter = false;
		search = '';
		
		get();
		
		return false;
		
	});
	
	
	
})(jQuery);

function compteurFille(id)
{

$.ajax({
	url :'compteur.php',
	dataType:'json',
	type :'POST',
	data :'&action=compteur&id_fille='+id,
	success : function(retour_php)
	{
		//alert("ok"+retour_php);
	},
	error : function(retour_php)
	{
		//alert("pas ok"+retour_php);
	}
});

}