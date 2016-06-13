function load(){
      if (GBrowserIsCompatible()){
		function createMarker(point,html) {
        var marker = new GMarker(point);
        GEvent.addListener(marker, "load", function() {
          marker.openInfoWindowHtml(html);
        });
        return marker;
      }
        var map = new GMap2(document.getElementById("map"));
GEvent.addListener(map, "moveend", function() {
  var center = map.getCenter();
  document.getElementById("message").innerHTML = center.toString();
});


        
        map.setCenter(new GLatLng(50.823297, 4.378572),17,G_HYBRID_MAP);		/* controle du zoom G_NORMAL_MAP
		map.addControl(new GSmallMapControl());*/
		map.addControl(new GMapTypeControl());

		map.addControl(new GLargeMapControl());
		 map.enableContinuousZoom();
		/* type de zoom  map.addControl(new GMapTypeControl()); */
		/* fenetre d'information texte
		map.openInfoWindow(map.getCenter(),
		document.createTextNode("le Caire"));*/
	  var point = new GLatLng(50.823297, 4.378572);
	  var marker_text = "<div style=\"color:black\">Festi Rent:<br> Chaussée de Boondael, 152-154<br>Bruxelles 1050 <br></div>";
      var marker = createMarker(point,marker_text)
      map.addOverlay(marker);
	  marker.openInfoWindowHtml(marker_text);

      }
    }
//appel de google map de la sorte exemple:
 //<div align="center" id="map" style="width: 480px; height: 450px;margin-left:-45px"></div>
   //     <div id="message" class="texte" align="center"></div>