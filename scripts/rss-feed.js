const RSS_URL = "https://cors-anywhere.herokuapp.com/https://rss.app/feeds/njjCyjhVw4xKMLV5.xml";

async function fetchRSSFeed() {
    try {
        const response = await fetch(RSS_URL);
        if (!response.ok) throw new Error(`Erreur de chargement : ${response.status}`);

        const rssText = await response.text();
        const parser = new DOMParser();
        const xmlDoc = parser.parseFromString(rssText, "application/xml");

        if (xmlDoc.querySelector("parsererror")) {
            throw new Error("Erreur lors de l'analyse du flux RSS");
        }

        const items = xmlDoc.querySelectorAll("item");
        const rssContainer = document.querySelector(".rss-container");
        rssContainer.innerHTML = "";

        items.forEach((item, index) => {
            if (index >= 5) return; // Limite à 5 articles

            const title = item.querySelector("title").textContent;
            const link = item.querySelector("link").textContent;
            const description = item.querySelector("description").textContent.replace(/<\/?[^>]+(>|$)/g, "");
            const pubDate = item.querySelector("pubDate").textContent;

            const rssItem = document.createElement("div");
            rssItem.classList.add("rss-item");

            rssItem.innerHTML = `
                <h3><a href="${link}" target="_blank">${title}</a></h3>
                <p class="date">${new Date(pubDate).toLocaleDateString()}</p>
                <p>${description}</p>
            `;

            rssContainer.appendChild(rssItem);
        });
    } catch (error) {
        console.error("Erreur :", error);
        document.querySelector(".rss-container").textContent = "Impossible de charger les données du flux RSS.";
    }
}

document.addEventListener("DOMContentLoaded", fetchRSSFeed);
