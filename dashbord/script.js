document.addEventListener('DOMContentLoaded', function() {
    // Function to toggle the sidebar
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
        });
    }

    // Function to search the dashboard
    const searchInput = document.querySelector('header input[type="search"]');
    const cards = document.querySelectorAll('.card');

    if (searchInput) {
        searchInput.addEventListener('input', function(event) {
            const searchTerm = event.target.value.toLowerCase();
            cards.forEach(card => {
                const cardTitle = card.querySelector('h3').textContent.toLowerCase();
                if (cardTitle.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

    // Example function to update dashboard data
    function updateDashboard() {
        const usersCount = document.querySelector('.card:nth-child(1) p');
        const ordersCount = document.querySelector('.card:nth-child(2) p');
        const productsCount = document.querySelector('.card:nth-child(3) p');
        const reportsCount = document.querySelector('.card:nth-child(4) p');

        // Simulating data fetch
        const data = {
            users: 150,
            orders: 90,
            products: 60,
            reports: 40
        };

        usersCount.textContent = `Number of users: ${data.users}`;
        ordersCount.textContent = `Number of orders: ${data.orders}`;
        productsCount.textContent = `Number of products: ${data.products}`;
        reportsCount.textContent = `Number of reports: ${data.reports}`;
    }

    // Call the update function to set initial data
    updateDashboard();
});
