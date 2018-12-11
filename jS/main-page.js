var map;
function initMap() {
 map = new google.maps.Map(document.getElementById('map'), {
 center: {lat: 41.89474, lng: 12.4839},
 mapTypeId: 'satellite',
 zoom: 18
 });
 map.setTilt(45);
 //createMarker( map, 41.89474, 12.4839, "Rome" );
}

function createMarker(map, latitude, longitude, city) {
 let imageLatLong = {lat: latitude, lng: longitude };
 let marker = new google.maps.Marker({
 position: imageLatLong,
 title: city,
 map: map
 });
 map.setCenter(imageLatLong);
}

window.addEventListener('load', function() {
    const api = 'https://github.com/mhenlisia/comp3512-Assignment2/blob/master/services/gallery.php';
    
    fetch(api)
    .then(function(response){
        return response.json();
    })
    .then(function(data){
        document.querySelector("#loading-gif").style.display = "none";
        createGalleryList(data);
        console.log(data);
    });
    
    
    
    function createGalleryList(galleries){
        let list = document.querySelector("#galleryList");
        
        for (let g of galleries){
            let item = document.createElement("li");
            item.innerHTML = "<a href='single-gallery.php?GalleryID=" + g.GalleryID + "'>" + g.GalleryName + "</a>";
            list.appendChild(item);
        }
    }
    
});