document.addEventListener('DOMContentLoaded', () => {
    fetch('components/fetch_cart.php')
        .then(response => response.json())
        .then(data => {
            const product_container = document.querySelector(".products");
            const container = document.getElementById('box-container');
            let total = 0;
            if (data.length > 0) {
                data.forEach(product => {
                    const price = parseFloat(product.price);
                    const qty = parseInt(product.quantity, 10);
                    const subTot = price * qty;
                    total += subTot;
                    const productBox = document.createElement('div');       
                    productBox.innerHTML = `
                            <form action="components/delete_from_cart.php" method="post" class="box">
                                <input type="hidden" name="cart_id" value="${product.id}">
                                <a href="quick_view.php?pid=${product.pid}" class="fas fa-eye"></a>
                                <button type="submit" class="fas fa-times" name="delete"></button>
                                <img src="uploaded_img/${product.image}">
                                <div class="name">${product.name}</div>
                                <div class="flex">
                                    <div class="price"><span>$</span>${product.price}</div>
                                    <input type="number" name="qty" class="qty" min="1" max="99" value="${qty}" maxlength="2">
                                    <button type="submit" class="fas fa-edit" name="update_qty"></button>
                                </div>
                                <div class="sub-total">totale : <span>${subTot.toFixed(1)}</span></div>
                            </form>
                        `;
                    container.appendChild(productBox);
                });


                const moreBtn = document.createElement('div');
                moreBtn.classList.add('more-btn');
                moreBtn.innerHTML = `
                    <form action="components/delete_from_cart.php" method="post">
                        <button type="submit" class="delete-btn" name="delete_all" onclick="return confirm('vuoi svuotare il carrello?');">rimuovi tutto</button>
                    </form>
                `;
                product_container.appendChild(moreBtn);


                const priceTotal = document.createElement("div");
                priceTotal.classList.add('cart-total');
                priceTotal.innerHTML = `
                        <p>totale carrello: <span>${total.toFixed(1)}</span></p>
                        <a href="checkout.php" class="btn">paga</a>
                    `;
                product_container.appendChild(priceTotal);


            } else {
                container.innerHTML = '<p class="empty">Non ci sono prodotti nel carrello</p>';
            }
        })
        .catch(error => console.error('Errore:', error));
});

