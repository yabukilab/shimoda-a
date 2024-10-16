// モーダルを開く関数
function openModal(modalId, imgSrc) {
    var modal = document.getElementById(modalId);
    var modalImg = modal.querySelector(".modal-content"); // モーダル内の画像要素を取得
    modal.style.display = "block"; // モーダルを表示
    modalImg.src = imgSrc; // クリックされた画像のsrcをモーダルに設定
}

// モーダルを閉じる関数
function closeModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.style.display = "none"; // モーダルを非表示
}
