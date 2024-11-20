async function loadMap() {
    const {Map, InfoWindow} = await google.maps.importLibrary("maps");
    const {AdvancedMarkerElement, PinElement} = await google.maps.importLibrary(
        "marker",
    );
    const infoWindow = new InfoWindow();

    let centerLat = 0;
    let centerLng = 0;

    await fetch('http://localhost:8080/customer-location')
        .then(response => response.json())
        .then(custLocation => {
            centerLat = parseFloat(custLocation.latitude);
            centerLng = parseFloat(custLocation.longitude)
        })
        .catch(error => console.error('Error fetching customer location! ', error));

    /* make the map focus directly into the customer location */
    const map = new Map(document.getElementById("map"), {
        zoom: 15,
        center: {lat: centerLat, lng: centerLng},
        mapId: "DEMO_MAP_ID",
    });

    /* Mark the position of the customer in the map */
    const pin = new PinElement({
        background: "#459ff8",
        borderColor: "#1b63b1",
        glyphColor: "#f7f7f8",
    });
    const customerMarker = new AdvancedMarkerElement({
        position: {lat: centerLat, lng: centerLng},
        map: map,
        title: `You`,
        content: pin.element,
    });
    customerMarker.addListener("click", ({domEvent, latLng}) => {
        const {target} = domEvent;

        infoWindow.close();
        infoWindow.setContent(customerMarker.title);
        infoWindow.open(customerMarker.map, customerMarker);
    });
    /* customer marker end */


    await fetch('http://localhost:8080/geolocation-technicians')
        .then(response => response.json())
        .then(technicians => {
            console.log(technicians);
            technicians.forEach(technician => {
                const pin = new PinElement({
                    background: "#0b7ff6",
                    borderColor: "#025ab8",
                    glyphColor: "#235c9a",
                });
                const marker = new AdvancedMarkerElement({
                    position: {lat: parseFloat(technician['latitude']), lng: parseFloat(technician['longitude'])},
                    map: map,
                    title: `${technician.fname} ${technician.lname}`,
                    content: pin.element,
                    //gmpClikable: true,
                });
                marker.addListener("click", ({domEvent, latLng}) => {
                    const {target} = domEvent;

                    infoWindow.close();
                    infoWindow.setContent(marker.title);
                    infoWindow.open(marker.map, marker);
                });
            });
        })
        .catch(error => console.error('Error fetching technician geo co-ordinates: ', error));

    await fetch('http://localhost:8080/geolocation-service-centres')
        .then(response => response.json())
        .then(serviceCentres => {
            console.log(serviceCentres);
            serviceCentres.forEach(serviceCentre => {
                const marker = new AdvancedMarkerElement({
                    position: {lat: parseFloat(serviceCentre['latitude']), lng: parseFloat(serviceCentre['longitude'])},
                    map: map,
                    title: `${serviceCentre['name']}`,
                });
                marker.addListener("click", ({domEvent, latLng}) => {
                    const {target} = domEvent;

                    infoWindow.close();
                    infoWindow.setContent(marker.title);
                    infoWindow.open(marker.map, marker);
                });
            });
        })
        .catch(error => console.error('Error fetching service centres geo co-ordinates: ', error));
}

window.onload = loadMap;