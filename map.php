<script type="text/javascript">
			$(document).ready(function(){
				$('#start-map').click(function(){
					if($('#is_fb_logged').val()==1){
						$('#banner').hide(200);
						$('#map').show(200);
					}else{
						$('#banner').hide(200);
						$('#map').show(200);
					}
					var name=$('.my-name').html();
					var locations = [
					[name, -33.723036, 151.269052, 4],
					['Coogee Beach', -33.923036, 151.259052, 5],
					['Cronulla Beach', -34.028249, 151.157507, 3],
					['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
					['Maroubra Beach', -33.950198, 151.259302, 1]
					];

					var map = new google.maps.Map(document.getElementById('map-div'), {
						zoom: 10,
						center: new google.maps.LatLng(-33.92, 151.25),
						mapTypeId: google.maps.MapTypeId.ROADMAP
					});

					var infowindow = new google.maps.InfoWindow();

					var marker, i;

					for (i = 0; i < locations.length; i++) {  
						marker = new google.maps.Marker({
							position: new google.maps.LatLng(locations[i][1], locations[i][2]),
							map: map
						});

						google.maps.event.addListener(marker, 'click', (function(marker, i) {
							return function() {
								infowindow.setContent(locations[i][0]);
								infowindow.open(map, marker);
							}
						})(marker, i));
					}
				});
});
</script>