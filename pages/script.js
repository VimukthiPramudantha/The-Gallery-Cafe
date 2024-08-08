document.addEventListener('DOMContentLoaded', function() {
    // Function to remove an item from the cart
    function removeItem(itemId) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'remove_from_cart.php', true); // Adjust URL if needed
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Reload the page to reflect the changes
                location.reload();
            } else {
                alert('An error occurred while removing the item. Please try again.');
            }
        };

        xhr.send('item_id=' + encodeURIComponent(itemId));
    }

    // Event delegation for remove buttons
    document.getElementById('cart-items').addEventListener('click', function(event) {
        if (event.target.classList.contains('remove')) {
            const itemId = event.target.getAttribute('data-id');
            if (confirm('Are you sure you want to remove this item from your cart?')) {
                removeItem(itemId);
            }
        }
    });
});
