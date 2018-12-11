window.addEventListener('load', function(){

  
  //these lines of code GenreID from the query string and where taken from https://www.codexworld.com/how-to/get-query-string-from-url-javascript/
    var urlParams = new URLSearchParams(location.search);
    var queryStringVal = urlParams.get('GenreID');
    console.log(queryStringVal);
    
    const api = "/services/painting.php?GenreID=" + queryStringVal;
    
    fetch(api)
    .then(function(response){
        return response.json();
    })
    .then(function(data){
        console.log("hi");
        createPaintingTable(data);
    });
    
    function createPaintingTable(paintings){
        let artist = document.querySelector("#pArtist");
        sortByArtist(artist);
        
        let title = document.querySelector("#pTitle");
        sortByTitle(title);
        
        let year = document.querySelector("#pYear");
        sortByYear(year);
        
        let table = document.querySelector("#genrePaintingTable");
        for (let p of paintings){
            let row = document.createElement("tr");
            table.appendChild(row);
            
            let picture = document.createElement("td");
            picture.innerHTML = "<img src = '../images/works/square-medium/" + p.ImageFileName + ".jpg'>";
            row.appendChild(picture);
            //mouseEnterPic(p);
            //mouseLeavePic();
            
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
    
    //event handler to sort by artist name
    function sortByArtist(artistHeading){
        artistHeading.addEventListener("click", function(e){
            e.preventDefault();
            let artistHeadingNum = 1;
            tableSort(artistHeadingNum);
        });
    }
    
    //event handler to sort by title
    function sortByTitle(titleHeading){
        titleHeading.addEventListener("click", function(e){
            e.preventDefault();
            let titleHeadingNum = 2;
            tableSort(titleHeadingNum);
        });
    }
    
    //event handler to sort by year
    function sortByYear(yearHeading){
        yearHeading.addEventListener("click", function(e){
            e.preventDefault();
            let yearHeadingNum = 3;
            tableSort(yearHeadingNum);
        });
    }
    
    //this table sort function was taken from https://www.w3schools.com/howto/howto_js_sort_table.asp
    function tableSort(headingTagNum){
        let table = document.querySelector("#paintingTable");
        let rows, switching, i, x, y, shouldSwitch;
        switching = true;
        
        
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[headingTagNum];
                y = rows[i + 1].getElementsByTagName("TD")[headingTagNum];
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }
    /*
    function mouseEnterPic(picture){
        let item = document.querySelector("#artistPaintingTable img");
        item.addEventListener("onmouseover", function(){
            let hoverItem = document.querySelector("#hover-image");
            hoverItem.style.display = "block";
            let newImg = document.createElement("img");
            newImg.setAttribute("src", "<img src = '../images/works/square-medium/" + picture.ImageFileName + ".jpg'>");
            hoverItem.appendChild(newImg);
        });
    }
    
    function mouseLeavePic(){
        let item = document.querySelector("#artistPaintingTable img");
        item.addEventListener("onmouseout", function(){
            let hoverItem = document.querySelector("#hover-image");
            hoverItem.style.display = "none";
        });
    }
    
    function mouseMovePic(){
        
    }
    */
});