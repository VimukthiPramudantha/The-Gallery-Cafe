document.addEventListener('DOMContentLoaded', function() {
    
    function removeItem(itemId) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'remove_from_cart.php', true); 
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        xhr.onload = function() {
            if (xhr.status === 200) {
                
                location.reload();
            } else {
                alert('An error occurred while removing the item. Please try again.');
            }
        };

        xhr.send('item_id=' + encodeURIComponent(itemId));
    }

   
    document.getElementById('cart-items').addEventListener('click', function(event) {
        if (event.target.classList.contains('remove')) {
            const itemId = event.target.getAttribute('data-id');
            if (confirm('Are you sure you want to remove this item from your cart?')) {
                removeItem(itemId);
            }
        }
    });
});
