window.addEventListener('load', function(){
    const api = '../services/painting.php?ArtistID=1';
    
    fetch(api)
    .then(function(response){
        return response.json();
    })
    .then(function(data){
        createPaintingTable(data);
    });
    
    function createPaintingTable(paintings){
        
        
        let artist = document.querySelector("#pArtist");
        sortByArtist(artist);
        
        let title = document.querySelector("#pTitle");
        sortByTitle(title);
        
        let year = document.querySelector("#pYear");
        sortByYear(year);
        
        let table = document.querySelector("#paintingTable");
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
            picTitle.innerHTML = "<a href=''>" + p.Title + "</a>"
            //picTitle.textContent = p.Title;
            row.appendChild(picTitle);
            
            let picYear = document.createElement("td");
            picYear.textContent = p.YearOfWork;
            row.appendChild(picYear);
            
            tableSort(1);
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
});