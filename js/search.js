function fetchProducts(query) {
    fetch('components/search_element.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'search_box=' + encodeURIComponent(query)
    })
    .then(response => response.json())
    .then(data => {
        const productsContainer = document.getElementById('products-container');
        productsContainer.innerHTML = '';
        if (data.length > 0) {
            data.forEach(product => {
                const productElement = document.createElement('div');
                productElement.innerHTML = `
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
                `;
                productsContainer.appendChild(productElement);
            });
        } else {
            productsContainer.innerHTML = '<p class="empty">nessun prodotto trovato!</p>';
        }
    });
}

document.getElementById('search_box').addEventListener('input', function() {
    const searchBox = this.value.toLowerCase(); 
    if (searchBox.length === 0) {
        document.getElementById('products-container').innerHTML = '<p class="empty">cerca un prodotto..</p>';
        return;
    }
    fetchProducts(searchBox);
});

document.getElementById('search-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const searchBox = document.getElementById('search_box').value.toLowerCase();
    fetchProducts(searchBox);
});
