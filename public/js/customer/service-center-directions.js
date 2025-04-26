let map, directionsRenderer;

async function loadMap() {
    const {AdvancedMarkerElement, PinElement} = await google.maps.importLibrary("marker");
    const {InfoWindow} = await google.maps.importLibrary("maps");
    const customerCoords = locations['customer_loc'];
    const serviceCenterCoords = locations['service_center_loc'];

    const infoWindow = new InfoWindow();

    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: Number(customerCoords.latitude), lng: Number(customerCoords.longitude)},
        zoom: 14,
        mapId: 'DEMO_MAP',
    });
    directionsRenderer = new google.maps.DirectionsRenderer({
        map: map,
    });

    const serviceCenterPin = new PinElement({
        background: "#f10c0c",
        borderColor: "#aa0202",
        glyphColor: "#f7f7f8",
    });
    const customerPin = new PinElement({
        background: "#248be4",
        borderColor: "#1b63b1",
        glyphColor: "#f7f7f8",
    });


    const customerMarker = new AdvancedMarkerElement({
        position: {lat: Number(customerCoords.latitude), lng: Number(customerCoords.longitude)},
        map: map,
        title: "You",
        content: customerPin.element,
    });
    const serviceCenterMarker = new AdvancedMarkerElement({
        position: {lat: Number(serviceCenterCoords.latitude), lng: Number(serviceCenterCoords.longitude)},
        map: map,
        title: "Service Center",
        content: serviceCenterPin.element,
    });

    customerMarker.addEventListener("click", ({domEvent, latLng}) => {

        infoWindow.close();
        infoWindow.setContent(customerMarker.title);
        infoWindow.open(customerMarker.map, customerMarker);
    })

    serviceCenterMarker.addEventListener("click", ({domEvent, latLng}) => {
        // const {target} = domEvent;
        infoWindow.close();
        infoWindow.setContent(serviceCenterMarker.title);
        infoWindow.open(serviceCenterMarker.map, serviceCenterMarker);
    })

    await fetchRoute('DRIVE', locations);
}


async function fetchRoute(mode) {
    const customerCoords = locations['customer_loc'];
    const serviceCenterCoords = locations['service_center_loc'];
    try {
        const response = await fetch('http://localhost:8080/get-service-center-route', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                origin: `${customerCoords.latitude}, ${customerCoords.longitude}`,
                destination: `${serviceCenterCoords.latitude}, ${serviceCenterCoords.longitude}`,
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

    const distanceElement = document.getElementById('travel-distance');
    const timeElement = document.getElementById('travel-time');

    distanceElement.textContent = `Distance: ${distanceKm} km`;
    timeElement.textContent = `Time: ${durationMinutes} minutes`;

}

loadMap();