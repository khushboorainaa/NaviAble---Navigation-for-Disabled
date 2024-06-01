// script.js

// Function to handle click events and redirect to the specified page
function redirectTo(page) {
    window.location.href = page;
  }
  
  // Function to add click event listeners to navigation links
  function addClickEventListeners() {
    // Get all navigation links
    const navLinks = document.querySelectorAll('.nav-links a');
  
    // Add click event listener to each link
    navLinks.forEach(link => {
      link.addEventListener('click', function (event) {
        // Prevent the default behavior of the link (e.g., prevent page reload)
        event.preventDefault();
  
        // Get the value of the "href" attribute, which contains the page URL
        const page = this.getAttribute('href');
  
        // Call the redirectTo function to redirect to the specified page
        redirectTo(page);
      });
    });
  }
  
  // Call the addClickEventListeners function when the DOM is fully loaded
  document.addEventListener('DOMContentLoaded', addClickEventListeners);

  // script.js
function initMap() {
    // Initialize the map
    const map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 0, lng: 0 },
        zoom: 2,
    });

    // Fetch places data from the server (PHP script)
    fetchPlacesData();
}

function fetchPlacesData() {
    // You can use AJAX, Fetch API, or other methods to fetch data from the server
    // Example using Fetch API
    fetch('get_places.php')
        .then(response => response.json())
        .then(data => {
            // Process the data and add markers on the map
            addMarkers(data);
        })
        .catch(error => console.error('Error fetching places data:', error));
}

function addMarkers(places) {
    // Loop through places and add markers on the map
    places.forEach(place => {
        const marker = new google.maps.Marker({
            position: { lat: parseFloat(place.latitude), lng: parseFloat(place.longitude) },
            map: map,
            title: place.place_name,
        });

        // Add an info window for each marker with place details
        const infoWindow = new google.maps.InfoWindow({
            content: `<strong>${place.place_name}</strong><br>${place.location}`,
        });

        marker.addListener('click', () => {
            infoWindow.open(map, marker);
        });
    });
}