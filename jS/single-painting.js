window.addEventListener('load', function(){
    
    //these lines of code get the PaintingID from the query string and where taken from https://www.codexworld.com/how-to/get-query-string-from-url-javascript/
    var urlParams = new URLSearchParams(location.search);
    var queryStringVal = urlParams.get('PaintingID');
    //console.log(queryStringVal);
    
    const api = "../services/painting.php?PaintingID=" + queryStringVal;
    
    fetch(api)
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            //console.log("fjskd;la");
            //outputPaintingImg(data);
        });
});

function outputPaintingImg(data){
    const paintingBox = document.getElementsByClassName('box largePaintingImg');
    const img = document.createElement('img');
    var src = "/images/works/square-medium/" + data[0].ImageFileName + ".jpg";
    img.src = src; //adding a new src attribute
    //paintingBox.innerHTML = "<img src = '../images/works/square-medium/" + data[0].ImageFileName + ".jpg'>";
    console.log(data);
    console.log(data[0].ImageFileName);
    paintingBox.appendChild(img);
}

//populate single painting view with required data
//Paramater: each individual painting object array that was originaly in galary array.
function populateSinglePaintingView(data) {

    //hiding all the boxes and setting the singlePainting box to show as grid
    //toggleBoxDisp("none", "grid");

    // putting immage in painting image section
    const paintingBox = document.getElementById('paintingImage');
    const img = document.createElement('img');
    var src = "images/medium/" + data.ImageFileName + ".jpg";
    img.src = src; //adding a new src attribute
    paintingBox.innerHTML = "";
    paintingBox.appendChild(img);
    var body = document.getElementsByName("body");
    //body.style.backgroundImage = "url('" + src + "')";

    // appending text node of title in paintingTitle header
    const title = document.getElementById('paintingTitle');
    title.innerHTML = data.Title;

    // adding text of artist first and last name in artistName header
    const artstNme = document.getElementById('artistName');
    artstNme.innerHTML = data.FirstName + " " + data.LastName;

    // adding year medium width and height in a "list"
    const pntInfo = document.getElementById("info");
    pntInfo.innerHTML = "Year:  " + data.YearOfWork +
        "<br>Medium:  " + data.Medium +
        "<br>width:  " + data.Width +
        "<br>Height:  " + data.Height;

    //adding links in link section
    const link = document.getElementById("links");
    link.innerHTML = "";
    const museumLinkText = data.MuseumLink;
    const museumLink = museumLinkText.link(data.MuseumLink);
    const wikkiLinkText = data.WikiLink;
    const wikkiLink = wikkiLinkText.link(data.WikiLink);
    link.innerHTML = "Museum Link: "  +museumLink + "<br> Wikki Link: " + wikkiLink;


    // adding description of the painting inside LinksInfo section
    const description = document.getElementById('linksInfo');
    description.innerHTML = data.Description;
    //description.appendChild(document.createTextNode(data.Description));

    //when close button is pressed, it calls toggleSinglePaintingView method
    const btn = document.getElementById("closeBtn");
    btn.addEventListener('click', function() { toggleBoxDisp("block", "none") });

    const titleBtn = document.getElementById("speakBtn1");
    titleBtn.addEventListener("click", function() {
        const utterance = new SpeechSynthesisUtterance(data.Title);
        //utterance.cancel();
        //speechSynthesis.cancel();
        speechSynthesis.speak(utterance);
    });

    const descBtn = document.getElementById("speakBtn2");
    descBtn.addEventListener("click", function() {
        const utterance = new SpeechSynthesisUtterance(data.Excerpt);
        speechSynthesis.speak(utterance);
    });
}