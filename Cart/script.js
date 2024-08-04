document.addEventListener('DOMContentLoaded', function() {
    // Example cart items
    const cartItems = [
        { name: 'Product 1', price: 10.00, quantity: 1 },
        { name: 'Product 2', price: 20.00, quantity: 2 },
        { name: 'Product 3', price: 15.00, quantity: 1 }
    ];

    const cartItemsContainer = document.getElementById('cart-items');
    const totalItemsElement = document.getElementById('total-items');
    const totalPriceElement = document.getElementById('total-price');

    function renderCart() {
        cartItemsContainer.innerHTML = '';
        let totalItems = 0;
        let totalPrice = 0;

        cartItems.forEach((item, index) => {
            const row = document.createElement('tr');

            const nameCell = document.createElement('td');
            nameCell.textContent = item.name;
            row.appendChild(nameCell);

            const quantityCell = document.createElement('td');
            quantityCell.innerHTML = `
                <button onclick="updateQuantity(${index}, -1)">-</button>
                <span>${item.quantity}</span>
                <button onclick="updateQuantity(${index}, 1)">+</button>
            `;
            row.appendChild(quantityCell);

            const priceCell = document.createElement('td');
            priceCell.textContent = `$${item.price.toFixed(2)}`;
            row.appendChild(priceCell);

            const subtotalCell = document.createElement('td');
            subtotalCell.textContent = `$${(item.price * item.quantity).toFixed(2)}`;
            row.appendChild(subtotalCell);

            const actionCell = document.createElement('td');
            actionCell.innerHTML = `<button onclick="removeItem(${index})">Remove</button>`;
            row.appendChild(actionCell);

            cartItemsContainer.appendChild(row);

            totalItems += item.quantity;
            totalPrice += item.price * item.quantity;
        });

        totalItemsElement.textContent = totalItems;
        totalPriceElement.textContent = totalPrice.toFixed(2);
    }

    window.updateQuantity = function(index, change) {
        if (cartItems[index].quantity + change > 0) {
            cartItems[index].quantity += change;
            renderCart();
        }
    };

    window.removeItem = function(index) {
        cartItems.splice(index, 1);
        renderCart();
    };

    renderCart();
});
