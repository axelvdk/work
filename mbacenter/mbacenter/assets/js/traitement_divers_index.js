$(document).ready(function(){

$("#calendar_link").click(function(){
	
	if(!$("#session_active").val())
	{
		alert("Veuillez vous connecter avant d'accéder au calendrier");
	}
});

});