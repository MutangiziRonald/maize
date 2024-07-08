<!DOCTYPE html>
<html>
<head>
  <title>Embed OpenStreetMap</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <style>
    #map {
      height: 400px; /* Set the height */
      width: 100%;   /* The width is the full width of the page */
    }
  </style>
</head>
<body>

  <div id="map"></div>
  <script>
    // Check if the browser supports Geolocation
if (navigator.geolocation) {
  // Get the current position
  navigator.geolocation.getCurrentPosition(
    (position) => {
      // Successfully retrieved the position
      const latitude = position.coords.latitude;
      const longitude = position.coords.longitude;
      console.log(`Latitude: ${latitude}, Longitude: ${longitude}`);
      var map = L.map('map').setView([latitude, longitude], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = L.marker([latitude, longitude]).addTo(map)
      .bindPopup('<?php echo $product['location'] ?>')
      .openPopup();
    },
    (error) => {
      // Handle errors
      switch (error.code) {
        case error.PERMISSION_DENIED:
          console.error("User denied the request for Geolocation.");
          break;
        case error.POSITION_UNAVAILABLE:
          console.error("Location information is unavailable.");
          break;
        case error.TIMEOUT:
          console.error("The request to get user location timed out.");
          break;
        case error.UNKNOWN_ERROR:
          console.error("An unknown error occurred.");
          break;
      }
    }
  );
} else {
  console.error("Geolocation is not supported by this browser.");
}

    
  </script>
</body>
</html>
