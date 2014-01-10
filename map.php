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
					$('#footer').hide();
					var name=$('.my-name').html();
					var lang="<?php echo $result['latitude']?>";
					var lat="<?php echo $result['longitude']?>";
					var locations = [
					[name, lang, lat , 4],
					['Coogee Beach', lang+0.2, lat+0.2, 5],
					['Cronulla Beach', lang+0.4, lat+0.4, 3],
					['Manly Beach', lang+0.6, lat+0.6, 2],
					['Maroubra Beach', lang+0.8, lat+0.8, 1]
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