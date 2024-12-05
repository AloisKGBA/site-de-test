function toggleText(texte) {
    var moreText = document.getElementById("moreText"+texte);
    var btnText = document.getElementById("viewMoreBtn"+texte);

    if (moreText.style.display === "none") {
        moreText.style.display = "flex";
        btnText.innerHTML = "Voir moins";
    } else {
        moreText.style.display = "none";
        btnText.innerHTML = "Voir plus";
    }
}

document.getElementById("commentForm").addEventListener("submit", async (e) => {
    e.preventDefault();

    const data = {
        firstName: document.getElementById("firstName").value,
        lastName: document.getElementById("lastName").value,
        email: document.getElementById("email").value,
        subject: document.getElementById("subject").value,
        comment: document.getElementById("comment").value,
        profilePic: document.getElementById("profilePic").value || "https://via.placeholder.com/50",
    };

    const response = await fetch("http://localhost/add_comment.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
    });

    if (response.ok) {
        loadComments();
        e.target.reset();
    }
});

async function loadComments() {
    const response = await fetch("http://localhost/get_comments.php");
    const comments = await response.json();

    const commentsList = document.querySelector(".comments-list");
    commentsList.innerHTML = "";

    comments.forEach((comment) => {
        const commentElement = document.createElement("div");
        commentElement.classList.add("comment");
        commentElement.innerHTML = `
            <img src="${comment.profilePic}" alt="Photo de profil">
            <div class="comment-content">
                <h4>${comment.firstName} ${comment.lastName}</h4>
                <p><strong>Objet :</strong> ${comment.subject}</p>
                <p>${comment.comment}</p>
                <small>${comment.email}</small>
                <small>Posté le : ${new Date(comment.created_at).toLocaleString()}</small>
            </div>
        `;
        commentsList.appendChild(commentElement);
    });
}

// Charger les commentaires au démarrage
loadComments();
