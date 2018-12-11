window.addEventListener('load', function() {
    
    let gallerySection = document.querySelector("div.galleries section");
    let loadingPic = document.createElement("img");
    loadingPic.setAttribute("src", "/images/lg.circle-slack-loading-icon.gif");
    gallerySection.appendChild(loadingPic);
    
    const api = "/services/gallery.php";
    // fetches the gallery service api
    fetch(api)
    .then(function(response) { return response.json(); })
    .then(function(data) {
        createGalleryList(data);
        loadingPic.style.display = "none";
    });
    
    const api2 = "/services/artist.php";
    
    // fetches the artist service api and saves the ArtistID 
    fetch(api2)
    .then(function(response) { return response.json(); })
    .then(function(data) {
       console.log(data);
       createArtistList(data);
    });
    
    const api3 = "/services/genre.php";
    
    fetch(api3)
    .then(function(response) { return response.json(); })
    .then(function(data) {
       console.log(data);
       createGenreList(data);
    });
    

    //console.log(localStorage.getItem("galaries"));
    
    // generates gallery list
    function createGalleryList(galleries){
        let list = document.querySelector("#galleryList");
        
        for (let g of galleries){
            //console.log(g);
            let item = document.createElement("li");
            item.innerHTML = "<a href='single-gallery.php?GalleryID=" + g.GalleryID + "'>" + g.GalleryName + "</a>";
            list.appendChild(item);
        }
    }
    
    // generates artist list
    function createArtistList(artists){
        let list = document.querySelector("#artist-list");
        for (let a of artists){
            let item = document.createElement("li");

            //mouseEnterPic(p);
            //mouseLeavePic();
            //let itemFigure = document.createElement("figure").innerHTML = "<br><img src = '../images/works/square-medium/" + a.ArtistID + ".jpg'><b";
            
            item.innerHTML = "<a href='single-artist.php?ArtistID=" + a.ArtistID + "'>" +"<figure><br><img src = '../images/artists/square/" + a.ArtistID + ".jpg'></br></figure>" + a.FirstName + " " + a.LastName + "</a>";
            list.appendChild(item);
        }
        //contentSlider();
    }
    
    function createGenreList(genres){
        let list = document.querySelector("#genre-list");
        for (let g of genres){
            let item = document.createElement("li");
            
            item.innerHTML = "<a href='/php/single-genre.php?GenreID=" + g.GenreID + "'> <figure><img src= '/images/genres/genres/square-medium/" + g.GenreID + ".jpg'><br> " + g.GenreName + "</br></figure></a>";
            list.appendChild(item);
            
        }
    }
  
//https://www.youtube.com/watch?v=C9EWifQ5xqA    
    function contentSlider(){
        const slide = document.querySelector("#artist-list li");
        let isDown = false;
        let startX;
        let scrollLeft;
        
        
        
        slide.addEventListener('mousedown',(e) =>{
            isDown = true;
            slide.classList.add('active');
            startX= e.pageX - slider.offsetLeft;
            scrollLeft = slide.scrollLeft;
        })
        
        slide.addEventListener('mouseleave',() =>{
            isDown = false;
        })
        
        slide.addEventListener('mouseup',() =>{
            isDown = false;
            slide.classList.add('active');
        })
        
        slide.addEventListener('mousemove',(e) =>{
            if(!isDown) return;
            e.preventDefault();
            const x = e.pageX - slide.offsetLeft;
            const move = x - startX;
            slide.scrollLeft = scrollLeft -move;
            console.log(move);
            
        })
    }
    

    
});