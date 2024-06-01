// Initialize the map
const map = L.map('map').setView([0, 0], 2); // Set an initial view (default coordinates)

// Add a tile layer (You can choose any desired tile layer)
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
}).addTo(map);

// Function to handle form submission
// document.getElementById('search-form').addEventListener('submit', function(event) {
//     event.preventDefault(); // Prevent the default form submission

//     var cityInput = document.getElementById('city-input').value;
//     var stateInput = document.getElementById('state-input').value;

//     // Concatenate city and state to create the search query
//     var locationQuery = cityInput + ', ' + stateInput;

//     // Use a geocoding service (like Leaflet's built-in 'Nominatim') to get the coordinates of the location
//     // Here's a simple example using Leaflet's 'Nominatim'
//     var url = 'https://nominatim.openstreetmap.org/search?format=json&q=' + locationQuery;

//     fetch(url)
//         .then(function(response) {
//             return response.json();
//         })
//         .then(function(data) {
//             if (data.length > 0) {
//                 var lat = parseFloat(data[0].lat);
//                 var lon = parseFloat(data[0].lon);

//                 // Create a marker for the location
//                 var marker = L.marker([lat, lon]).addTo(map);

//                 // Zoom the map to the location entered by the user
//                 map.setView([lat, lon], 13);
//             } else {
//                 alert('Location not found. Please try again.');
//             }
//         })
//         .catch(function(error) {
//             console.log('Error:', error);
//         });
// });