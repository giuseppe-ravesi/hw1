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


document.addEventListener('DOMContentLoaded', function () {
 
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
        cartCountElement.textContent = '('+ data.cart_count +')';
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
                    <a href="logout.php" onclick="return confirm('Vuoi effettuare il logout?');" class="delete-btn">logout</a>
                </div>
            `;
        } else {
            profileContainer.innerHTML = `
                <p class="name">Effettua il login</p>
                <a href="login.php" class="btn">login</a>
                <p class="account">
                    <a href="register.php">registrati</a>
                </p>
            `;
        }
    })
    .catch(error => console.error('Errore:', error));
}



