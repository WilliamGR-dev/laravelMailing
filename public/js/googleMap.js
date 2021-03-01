function initMap() {
    const diteco = { lat: 48.9025994, lng: 2.4011896 };
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 16,
        center: diteco,
    });
    const marker = new google.maps.Marker({
        position: diteco,
        map: map,
    });
}
