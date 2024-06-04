document.addEventListener('DOMContentLoaded', fetchProducts());
 

function fetchProducts() {
    fetch('components/products_menu.php')
    .then(response => response.json())
    .then(data => {
        const container = document.getElementById('products-container');
        if (data.empty) {
            container.innerHTML = `<p class="empty">${data.empty}</p>`;
        } else {
            container.innerHTML = data.map(product => `
                <form action="components/add_to_cart.php" method="post" class="box">
                    <input type="hidden" name="pid" value="${product.id}">
                    <input type="hidden" name="name" value="${product.name}">
                    <input type="hidden" name="price" value="${product.price}">
                    <input type="hidden" name="image" value="${product.image}">
                    <a href="quick_view.php?pid=${product.id}" class="fas fa-eye"></a>
                    <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
                    <img src="uploaded_img/${product.image}" alt="">
                    <a href="category.php?category=${product.category}" class="cat">${product.category}</a>
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