function initMap() {
    // The location of Uluru
    const diteco = { lat: 48.9025994, lng: 2.4011896 };
    // The map, centered at Uluru
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 16,
        center: diteco,
    });
    // The marker, positioned at Uluru
    const marker = new google.maps.Marker({
        position: diteco,
        map: map,
    });
}
