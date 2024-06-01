// script.js

// Sample data
const data = {
    totalPlaces: 5,
    places: [
        { name: "Place 1", ministry: "Ministry A" },
        { name: "Place 2", ministry: "Ministry B" },
        { name: "Place 3", ministry: "Ministry C" },
        { name: "Place 4", ministry: "Ministry D" },
        { name: "Place 5", ministry: "Ministry E" },
    ],
    mostVisited: [
        "Place 1",
        "Place 3",
        "Place 4"
    ]
};

// Populate total number of accessible places
document.getElementById('total-places').textContent = data.totalPlaces;

// Populate list of accessible places
const placesTableBody = document.querySelector('#places-table tbody');
data.places.forEach(place => {
    const row = document.createElement('tr');
    row.innerHTML = `<td>${place.name}</td><td>${place.ministry}</td>`;
    placesTableBody.appendChild(row);
});

// Populate most visited accessible places
const mostVisitedList = document.getElementById('most-visited-list');
data.mostVisited.forEach(place => {
    const listItem = document.createElement('li');
    listItem.textContent = place;
    mostVisitedList.appendChild(listItem);
});
