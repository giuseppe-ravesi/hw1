//about prodotti esterni
document.addEventListener("DOMContentLoaded", () => {
    const reviewsContainer = document.getElementById("reviews-container");

    fetch("components/fetch_api.php")
        .then(response => response.json())
        .then(data => {
            data.slice(0, 20).forEach(product => {
                const slide = document.createElement("div");
                slide.classList.add("swiper-slide", "slide");

                const stars = '★'.repeat(Math.floor(product.rating.rate)) + '☆'.repeat(5 - Math.floor(product.rating.rate));

                slide.innerHTML = `
                    <img src="${product.image}" alt="${product.title}">
                    <h3>${product.title}</h3>
                    <div class="stars">${stars}</div>
                    <p>${product.description}</p>
                `;

                reviewsContainer.appendChild(slide);
            });

// Inizializzo Swiper
new Swiper(".reviews-slider", {
    loop: true,
    grabCursor: true,
    spaceBetween: 20,
    pagination: {
        el: ".swiper-pagination",
        dynamicBullets: true
    },
    breakpoints: {
        550: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 2,
        },
        1024: {
            slidesPerView: 3,
        },
    },
});
})
.catch(error => console.error("Errore nel recupero delle recensioni:", error));
});