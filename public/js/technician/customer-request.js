async function getOriginDestination() {
    const response = await fetch('http://localhost:8080/get-origin-destination');
    const locations = await response.json();

    const customerCoords = locations.customer_location;
    const technicianCoords = locations.technician_location;

    return {customerCoords, technicianCoords};

}

let map, directionsRenderer;

const travelModeDropdown = document.getElementById('travel-mode');

async function initMap() {
    const {AdvancedMarkerElement, PinElement} = await google.maps.importLibrary("marker");
    const {InfoWindow} = await google.maps.importLibrary("maps");
    const {customerCoords, technicianCoords} = await getOriginDestination();

    const infoWindow = new InfoWindow();

    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: Number(technicianCoords.latitude), lng: Number(technicianCoords.longitude)},
        zoom: 14,
        mapId: 'DEMO_MAP',
    });
    directionsRenderer = new google.maps.DirectionsRenderer({
        map: map,
    });

    const customerPin = new PinElement({
        background: "#f10c0c",
        borderColor: "#aa0202",
        glyphColor: "#f7f7f8",
    });
    const technicianPin = new PinElement({
        background: "#248be4",
        borderColor: "#1b63b1",
        glyphColor: "#f7f7f8",
    });

    const customerMarker = new AdvancedMarkerElement({
        position: {lat: Number(customerCoords.latitude), lng: Number(customerCoords.longitude)},
        map: map,
        title: "Customer",
        content: customerPin.element,
    });
    const technicianMarker = new AdvancedMarkerElement({
        position: {lat: Number(technicianCoords.latitude), lng: Number(technicianCoords.longitude)},
        map: map,
        title: "You",
        content: technicianPin.element,
    });

    customerMarker.addEventListener("click", ({domEvent, latLng}) => {

        infoWindow.close();
        infoWindow.setContent(customerMarker.title);
        infoWindow.open(customerMarker.map, customerMarker);
    })

    technicianMarker.addEventListener("click", ({domEvent, latLng}) => {
        // const {target} = domEvent;
        infoWindow.close();
        infoWindow.setContent(technicianMarker.title);
        infoWindow.open(technicianMarker.map, technicianMarker);
    })

    await fetchRoute('DRIVE');
}

async function fetchRoute(mode) {
    const {customerCoords, technicianCoords} = await getOriginDestination();
    try {
        const response = await fetch('http://localhost:8080/get-route', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                origin: `${technicianCoords.latitude}, ${technicianCoords.longitude}`,
                destination: `${customerCoords.latitude}, ${customerCoords.longitude}`,
                // convert mode to upper case
                mode: mode.toUpperCase(),
            }),
        });

        const result = await response.json();
        console.log(result);

        if (result.routes) {
            displayRoute(result.routes[0]);
        } else {
            console.error("No routes found", result);
        }

    } catch (error) {
        console.error('Error fetching route: ', error);
    }
}

function displayRoute(route) {
    const path = route.polyline.encodedPolyline;

    const decodedPath = google.maps.geometry.encoding.decodePath(path).map(latLng => {
        return {lat: latLng.lat(), lng: latLng.lng()};
    });

    const routePolyline = new google.maps.Polyline({
        path: decodedPath,
        geodesic: true,
        strokeColor: "#4285F4",
        strokeOpacity: 0.8,
        strokeWeight: 5,
    });

    routePolyline.setMap(map);

    const distanceMeters = route.distanceMeters;
    const durationSeconds = parseInt(route.duration.replace('s', ''), 10);

    // Convert distance to kilometers and duration to minutes/hours
    const distanceKm = (distanceMeters / 1000).toFixed(2);
    const durationMinutes = Math.ceil(durationSeconds / 60); // Round up to nearest minute

    const baseCost = 500;
    const distCostPerKm = 50;
    const timeCostPerHr = 600;
    let travelCost = baseCost + (distanceKm * distCostPerKm) + ((durationMinutes / 60) * timeCostPerHr);
    travelCost = travelCost.toFixed(2);

    // Select the HTML elements and update their content
    const distanceElement = document.getElementById('travel-distance');
    const timeElement = document.getElementById('travel-time');

    distanceElement.textContent = `Distance: ${distanceKm} km`;
    timeElement.textContent = `Time: ${durationMinutes} minutes`;
    document.getElementById('advance-payment').textContent = `Advance Payment: LKR ${travelCost}`;

    sendAdvancePaymentToBackend(requestId, travelCost);

}

function sendAdvancePaymentToBackend(requestId, advancePayment) {
    fetch('http://localhost:8080/store-advance-payment', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            req_id: requestId,
            advance_payment: advancePayment,
        }),
    })
        .then(response => response.json())
        .then(data => {
            console.log('Advance payment stored successfully.', data);
        })
        .catch(error => console.error('Error storing advance payment: ', error));
}

// travelModeDropdown.addEventListener("change", (e) => {
//     fetchRoute(e.target.value); // Get new route for selected travel mode
// });

initMap();