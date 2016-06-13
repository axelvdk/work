$(document).ready(function(){
console.log('hello');
alert();


$("#poitrine").change(function(){
	var poitrine = $("#poitrine").val();
	localStorage.setItem("poitrine",poitrine);
});

$("#poidsMin").change(function()
{
	var poidsMin = $("#poidsMin").val();
	localStorage.setItem("poidsMin", poidsMin);	
});

$("#poidsMax").change(function()
{
	var poidsMax=$("#poidsMax").val();
	localStorage.setItem("poidsMax", poidsMax);	
});

$("#tailleMin").change(function()
{
	var tailleMin=$("#tailleMin").val();
	localStorage.setItem("tailleMin",tailleMin);	
});
$("#tailleMax").change(function()
{
	var tailleMax=$("#tailleMax").val();
	localStorage.setItem("tailleMax", tailleMax);	
});
$("#salons").change(function()
{
	var salons=$("#salons").val();
	localStorage.setItem("salons",salons);	
});

$("#peau").change(function()
{
	var peau=$("#peau").val();
	localStorage.setItem("peau", peau);	
});

$("#ageMin").change(function()
{
	var ageMin=$("#ageMin").val();
	localStorage.setItem("ageMin",ageMin);	
});

$("#ageMax").change(function()
{
	var ageMax=$("#ageMax").val();
	localStorage.setItem("ageMax",ageMax);	
});

$("#prixMin").change(function()
{
	var prixMin=$("#prixMin").val();
	localStorage.setItem("prixMin",prixMin);	
});

$("#prixMax").change(function()
{
	var prixMax=$("#prixMax").val();
	localStorage.setItem("prixMax",prixMax);	
});

$("#poitrine").val(localStorage.setItem("poitrine",poitrine));
$("#poidsMin").val(localStorage.setItem("poidsMin",poidsMin));
$("#poidsMax").val(localStorage.setItem("poidsMax",poidsMax));
$("#salons").val(localStorage.setItem("salons",salons));
$("#peau").val(localStorage.setItem("peau",peau));
$("#ageMin").val(localStorage.setItem("ageMin",ageMin));
$("#ageMax").val(localStorage.setItem("ageMax",ageMax));
$("#prixMin").val(localStorage.setItem("prixMin",prixMin));
$("#prixMax").val(localStorage.setItem("prixMax",prixMax));


});



