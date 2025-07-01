document.addEventListener('DOMContentLoaded', function() {
    const contentTabs = document.querySelectorAll('.content-tabs nav a');
    const searchInput = document.getElementById('search-clients');
    const filterCategory = document.getElementById('filter-category');
    const applyFilterBtn = document.getElementById('apply-filter');
    const clientsTableBody = document.getElementById('clients-table-body');

    function filterClients() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedCategory = filterCategory.value.toLowerCase();
        const activeTabStatus = document.querySelector('.content-tabs nav a.active').dataset.status;

        Array.from(clientsTableBody.children).forEach(row => {
            const fullName = row.children[1].textContent.toLowerCase();
            const email = row.children[2].textContent.toLowerCase();
            const rowCategory = row.dataset.category.toLowerCase();
            const rowStatus = row.dataset.status.toLowerCase();

            const matchesSearch = fullName.includes(searchTerm) || email.includes(searchTerm);
            const matchesCategory = selectedCategory === 'all' || rowCategory === selectedCategory;
            const matchesTabStatus = activeTabStatus === 'all' || rowStatus === activeTabStatus;

            if (matchesSearch && matchesCategory && matchesTabStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Event Listeners for tab clicks
    contentTabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            contentTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            filterClients();
        });
    });

    // Event Listeners for filter changes
    applyFilterBtn.addEventListener('click', filterClients);
    searchInput.addEventListener('keyup', filterClients);
    filterCategory.addEventListener('change', filterClients);

    // Initial filter on page load
    filterClients();
});