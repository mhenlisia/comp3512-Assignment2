//creates rows with painting image, artist, title, and year and appends in paintingList table 
function paintingListTable(data) {
     
    // select the body tag of the table in paintings box and  remove all inner html 
    //to clear the list.
    const paintingList = document.getElementById('paintingList');
    paintingList.innerHTML = "";
    
    for (let painting of data) {
        console.dir(painting);

        //creating new row
        const paintingRow = document.createElement('tr');

        //creating a new td element for the immage of the row
        const paintingImage = document.createElement('td');
        const img = document.createElement('img');
        img.src = "images/square-small/" + painting.ImageFileName + ".jpg"; //adding a new src attribute
        paintingImage.appendChild(img); // inserting the immage tag in to the td 
        paintingRow.append(paintingImage); //inserting the td tag in to the row

        // creating a new column after immage column within the a table and appending artist's last name.
        const artistLstNme = paintingRow.insertCell(-1);
        artistLstNme.appendChild(document.createTextNode(painting.LastName));

        // // creating a new column after artistLstNme column within the a table and appending painting's name.
        const title = paintingRow.insertCell(-1);
        title.appendChild(document.createTextNode(painting.Title));

        // // creating a new column after title column within the a table and appending paintings year.
        const year = paintingRow.insertCell(-1);
        year.appendChild(document.createTextNode(painting.YearOfWork));

        //when the row is clicked, it will call the populateSinglePaintingView
        //to how more info about the painting.
        paintingRow.addEventListener('click', function() { populateSinglePaintingView(painting) });

        //paintingRow.style.backgroundColor = "grey";
        paintingRow.style.boxShadow = "0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)";
        paintingRow.style.backgroundColor = "lightblue"
        paddingOnMouseHover(paintingRow);

        //adding the row to the main table
        paintingList.append(paintingRow);
    }
}

//when called, it populates the painting list box grom the individual gallary passed in as a paramater.
function populatePaintings(gallery) {
    const api2 = 'https://www.randyconnolly.com/funwebdev/services/art/paintings.php?gallery=' + gallery.GalleryID;
    fetch(api2)
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            
            //Print painting list with default sourt
            paintingListTable(data);
            
            //when artist clicked, sourt data with artist last name and reprent painting list with that data. 
            document.getElementById("artist").addEventListener("click", function() { 
                const sortArtistList = sortWithArtist(data);
                paintingListTable(data);
            });
            //when title clicked, sourt data with painting title and reprent painting list with that data.
            document.getElementById("title").addEventListener("click", function(){
                const sortTitleList = sortWithTitle(data);
                paintingListTable(data);
            })
            //when year clicked, sourt data with painting year and reprent painting list with that data.
            document.getElementById("year").addEventListener("click", function(){
                const sortYearList = sortWithYear(data);
                paintingListTable(data);
            })
            
        });
}