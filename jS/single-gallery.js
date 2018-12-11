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


// when called, it will populates the galary info box and 
//call teh functions that populates the other 2 boxex
//from the specific galary that is passed in as aparamater.
window.addEventListener('load', function() {
    //these lines of code get the GalleryID from the query string and where taken from https://www.codexworld.com/how-to/get-query-string-from-url-javascript/
    var urlParams = new URLSearchParams(location.search);
    var queryStringVal = urlParams.get('GalleryID');
    console.log(queryStringVal);
    
    
    const api = "/services/painting.php?GalleryID=" + queryStringVal;
    fetch(api)
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            console.log(data);
            // Populate gallery list box by calling function that creates the element.
            createMap(data,map);
            createPaintingTable(data);
            
            /*const galleryList = document.getElementById("galleryList");
            for (let d of data) {
                galleryList.appendChild(gallaryElement(d));
            }*/
        });
    
    function createMap(data, map){
        let lat = data.Latitude;
        let long = data.Longitude;
        let galCity = data.GalleryCity;
        
        createMarker(map,lat,long,galCity);
        
    }
        
    function createPaintingTable(paintings){
        let artist = document.querySelector("#pArtist");
        //sortByArtist(artist);
        
        let title = document.querySelector("#pTitle");
        //sortByTitle(title);
        
        let year = document.querySelector("#pYear");
        //sortByYear(year);
        
        let table = document.querySelector("#galleryPaintingTable");
        for (let p of paintings){
            let row = document.createElement("tr");
            table.appendChild(row);
            
            let picture = document.createElement("td");
            picture.innerHTML = "<img src = '../images/works/square-medium/" + p.ImageFileName + ".jpg'>";
            row.appendChild(picture);
            
            
            let name = document.createElement("td");
            name.textContent = p.LastName;
            row.appendChild(name);
            
            let picTitle = document.createElement("td");
            picTitle.textContent = p.Title;
            row.appendChild(picTitle);
            
            let picYear = document.createElement("td");
            picYear.textContent = p.YearOfWork;
            row.appendChild(picYear);
            
            row.addEventListener('click', function() {
                window.location.href = "/php/single-painting.php?PaintingID=" + p.PaintingID;
            });
            
            //tableSort(1);
        }
    }    

});


function populateBoxes(gallery) {
    document.getElementById("galleryName").innerHTML = gallery.GalleryName;
    document.getElementById("galleryNative").innerHTML = gallery.GalleryNativeName;
    document.getElementById("galleryCity").innerHTML = gallery.GalleryCity;
    document.getElementById("galleryAddress").innerHTML = gallery.GalleryAddress;
    document.getElementById("galleryCountry").innerHTML = gallery.GalleryCountry;
    document.getElementById("galleryHome").innerHTML = gallery.GalleryWebSite;

    populateMap(gallery.Latitude, gallery.Longitude);
    populatePaintings(gallery);

}

//populate map with the latitude and langitude values passed in.
function populateMap(lati, lngi) {
    var map;
    map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: lati, lng: lngi },
        mapTypeId: 'satellite',
        zoom: 18
    });
}