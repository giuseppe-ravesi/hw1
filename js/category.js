navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
    profile.classList.remove('active');
}

profile = document.querySelector('.header .flex .profile');

document.querySelector('#user-btn').onclick = () =>{
    profile.classList.toggle('active');
    navbar.classList.remove('active');
}

window.onscroll = () =>{
    navbar.classList.remove('active');
    profile.classList.remove('active');
}

//user_header js

document.addEventListener('DOMContentLoaded', function () {
    if (typeof userId !== 'undefined' && userId !== '') {
        fetchCartCount(userId);
        fetchUserProfile(userId);
    }

    // Richiesta per ottenere il conteggio degli articoli nel carrello
    fetchCartCount(userId);

    // Richiesta per ottenere i dati del profilo utente
    fetchUserProfile(userId);
});

function fetchCartCount(userId) {
    fetch('components/user_handler.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=get_cart_count&user_id=${userId}`,
    })
    .then(response => response.json())
    .then(data => {
        const cartCountElement = document.querySelector('.fa-shopping-cart span');
        cartCountElement.textContent = `(${data.cart_count})`;
    })
    .catch(error => console.error('Errore:', error));
}

function fetchUserProfile(userId) {
    fetch('components/user_handler.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=get_user_profile&user_id=${userId}`,
    })
    .then(response => response.json())
    .then(data => {
        const profileContainer = document.querySelector('.profile');

        if (data.user_profile) {
            profileContainer.innerHTML = `
                <p class="name">${data.user_profile.name}</p>
                <div class="flex">
                    <a href="profile.php" class="btn">profilo</a>
                    <a href="components/user_logout.php" onclick="return confirm('Vuoi effettuare il logout?');" class="delete-btn">logout</a>
                </div>
                <p class="account">
                    <a href="login.php">login</a> or
                    <a href="register.php">registrati</a>
                </p>
            `;
        } else {
            profileContainer.innerHTML = `
                <p class="name">Effettua il login</p>
                <a href="login.php" class="btn">login</a>
            `;
        }
    })
    .catch(error => console.error('Errore:', error));
}


//------- Fetch Prodotti -------------

document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const category = urlParams.get('category');
    if (category) {
        fetchProducts(category);
    }
});

function fetchProducts(category) {
    fetch(`components/products_category.php?category=${encodeURIComponent(category)}`)
    .then(response => response.json())
    .then(data => {
        const container = document.getElementById('products-container');
        const title = document.querySelector('.title');
        if (data.empty) {
            container.innerHTML = `<p class="empty">${data.empty}</p>`;
        } else {
            title.textContent = category;
            container.innerHTML = data.map(product => `
                <form action="components/add_to_cart.php" method="post" class="box">
                    <input type="hidden" name="pid" value="${product.id}">
                    <input type="hidden" name="name" value="${product.name}">
                    <input type="hidden" name="price" value="${product.price}">
                    <input type="hidden" name="image" value="${product.image}">
                    <a href="quick_view.php?pid=${product.id}" class="fas fa-eye"></a>
                    <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
                    <img src="uploaded_img/${product.image}" alt="">
                    <div class="name">${product.name}</div>
                    <div class="flex">
                        <div class="price"><span>$</span>${product.price}</div>
                        <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                    </div>
                </form>
            `).join('');
        }
    })
    .catch(error => console.error('Errore:', error));
}