const thumbnails = document.querySelectorAll('.thumbnail');
const modal = document.getElementById('modal');
const modalImg = document.getElementById('modal-img');
const closeBtn = document.getElementById('close');

thumbnails.forEach(thumbnail => {
    thumbnail.onclick = function() {
        modal.style.display = "block";
        modalImg.src = this.src;
    }
});

closeBtn.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}