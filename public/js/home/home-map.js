async function loadMap() {
    const {Map, InfoWindow} = await google.maps.importLibrary("maps");
    const {AdvancedMarkerElement, PinElement} = await google.maps.importLibrary("marker");
    const infoWindow = new InfoWindow();

    let centerLat = 7.873054;
    let centerLng = 80.771797;

    /* Make the map focus into Sri Lanka */
    const map = new Map(document.getElementById("map"), {
        zoom: 10,
        center: {lat: centerLat, lng: centerLng},
        mapId: "DEMO_MAP_ID",
    });

    await fetch('http://localhost:8080/home-geolocation-technicians')
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
        .catch(error => console.error('Error fetching technician geo co-ordinates!'));

    await fetch('http://localhost:8080/home-geolocation-service-centres')
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
        .catch(error => console.error('Error fetching service centres geo co-ordinates!'));

}

window.onload = loadMap;