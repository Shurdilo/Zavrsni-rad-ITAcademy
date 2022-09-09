// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
function myFunction(elmnt) {
    modal.style.display = "flex";
    modalImg.src = elmnt.src;
    captionText.innerHTML = elmnt.getAttribute('dataDesc');
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
var close = document.getElementsByClassName("close-outside")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
    modal.style.display = "none";
}
close.onclick = function() { 
    modal.style.display = "none";
}

function noscroll() {
    window.scrollTo(0, 0);
}

document.getElementsByClassName("close")[0].addEventListener('click', () => {
    window.removeEventListener("scroll", noscroll);
});

document.getElementsByClassName("close-outside")[0].addEventListener('click', () => {
    window.removeEventListener("scroll", noscroll);
});

document.getElementsByClassName("myImg")[0].addEventListener('click', () => {
    window.addEventListener("scroll", noscroll);  
});
