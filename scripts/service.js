function toggleText(texte) {
    var moreText = document.getElementById("moreText"+texte);
    var btnText = document.getElementById("viewMoreBtn"+texte);

    if (moreText.style.display === "none") {
        moreText.style.display = "block";
        btnText.innerHTML = "Voir moins";
    } else {
        moreText.style.display = "none";
        btnText.innerHTML = "Voir plus";
    }
}

