jQuery(function ($) {

let modal = document.getElementById('myModal');
let btn = document.getElementById("menu-item-9");

btn.onclick = function() {
    modal.style.display = "flex";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
});