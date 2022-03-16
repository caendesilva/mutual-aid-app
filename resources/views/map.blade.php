<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
				<section>
					<h1 class="text-3xl font-bold mb-3">Interactive Map</h1>
					<div>
						<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
						<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
						<style>
							#map {
								/* configure the size of the map */
								width: 100%;
								height: 100%;
								min-height: 75vh;
							}
						</style>

						<div id="map"></div>

    					<script>
							// initialize Leaflet
							var map = L.map('map').setView({lon: -95, lat: 37}, 4);

							// add the OpenStreetMap tiles
							L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
								maxZoom: 19,
								attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
							}).addTo(map);

							// show the scale bar on the lower left corner
							L.control.scale({imperial: true, metric: true}).addTo(map);
						</script>
						<div class="markers">
							@foreach ($markers as $marker)
							<script>
								L.marker({lon: "{{ $marker['lon'] }}", lat: "{{ $marker['lat'] }}"}).bindPopup("{{ $marker['label'] }}").addTo(map);
							</script>
							@endforeach
						</div>
					</div>
					<small>
						The map uses a software called <a href="https://leafletjs.com/">LeafletJS</a> by  Vladimir Agafonkin, an Ukrainian citizen living in Kyiv.

						Vladimir is no longer in Kyiv, because Russian bombs are falling over the city. His family, his friends, his neighbours, thousands and thousands of absolutely wonderful people, are either seeking refuge or fighting for their lives.

						Read the full text on their website, <a href="https://leafletjs.com/">https://leafletjs.com/</a>.
					</small>
				</section>
            </div>
        </div>
    </div>
</x-app-layout>
