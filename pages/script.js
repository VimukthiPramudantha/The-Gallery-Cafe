document.addEventListener("DOMContentLoaded", () => {
    const cartItemsContainer = document.getElementById("cart-items");
    const totalItemsContainer = document.getElementById("total-items");
    const totalPriceContainer = document.getElementById("total-price");
    const checkoutButton = document.getElementById("checkout");

    // Load cart items from localStorage
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    // Update the cart display
    function updateCart() {
        cartItemsContainer.innerHTML = "";
        let totalItems = 0;
        let totalPrice = 0;

        cart.forEach((item, index) => {
            const cartItemRow = document.createElement("tr");

            cartItemRow.innerHTML = `
                <td>${item.name}</td>
                <td><input type="number" class="cart-item-quantity" min="1" value="${item.quantity}" data-index="${index}"></td>
                <td>$${item.price.toFixed(2)}</td>
                <td>$${(item.price * item.quantity).toFixed(2)}</td>
                <td><button class="remove-item" data-index="${index}">Remove</button></td>
            `;

            cartItemsContainer.appendChild(cartItemRow);

            totalItems += item.quantity;
            totalPrice += item.price * item.quantity;
        });

        totalItemsContainer.textContent = totalItems;
        totalPriceContainer.textContent = totalPrice.toFixed(2);
    }

    // Save cart items to localStorage
    function saveCart() {
        localStorage.setItem("cart", JSON.stringify(cart));
    }

    // Add item to cart
    function addToCart(name, price) {
        const existingItemIndex = cart.findIndex(item => item.name === name);

        if (existingItemIndex > -1) {
            cart[existingItemIndex].quantity += 1;
        } else {
            cart.push({ name, price, quantity: 1 });
        }

        saveCart();
        updateCart();
    }

    // Remove item from cart
    function removeFromCart(index) {
        cart.splice(index, 1);
        saveCart();
        updateCart();
    }

    // Update item quantity in cart
    function updateQuantity(index, quantity) {
        cart[index].quantity = quantity;
        saveCart();
        updateCart();
    }

    // Event listener for removing items from cart
    cartItemsContainer.addEventListener("click", (event) => {
        if (event.target.classList.contains("remove-item")) {
            const index = event.target.dataset.index;
            removeFromCart(index);
        }
    });

    // Event listener for updating item quantity
    cartItemsContainer.addEventListener("change", (event) => {
        if (event.target.classList.contains("cart-item-quantity")) {
            const index = event.target.dataset.index;
            const quantity = parseInt(event.target.value);
            if (quantity > 0) {
                updateQuantity(index, quantity);
            }
        }
    });

    // Event listener for checkout button
    checkoutButton.addEventListener("click", () => {
        if (cart.length > 0) {
            alert("Proceeding to checkout...");
            // Here, you can add functionality to redirect to a checkout page
        } else {
            alert("Your cart is empty.");
        }
    });

    // Initialize the cart display
    updateCart();
});
