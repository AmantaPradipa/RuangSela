document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-tickets');
    const filterCategory = document.getElementById('filter-category');
    const filterStatus = document.getElementById('filter-status');
    const applyFilterBtn = document.getElementById('apply-filter');
    const ticketsTableBody = document.getElementById('tickets-table-body');

    function filterTickets() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedCategory = filterCategory.value.toLowerCase();
        const selectedStatus = filterStatus.value.toLowerCase();

        Array.from(ticketsTableBody.children).forEach(row => {
            const subject = row.children[1].textContent.toLowerCase();
            const category = row.dataset.category.toLowerCase();
            const status = row.dataset.status.toLowerCase();

            const matchesSearch = subject.includes(searchTerm);
            const matchesCategory = selectedCategory === 'all' || category === selectedCategory;
            const matchesStatus = selectedStatus === 'all' || status === selectedStatus;

            if (matchesSearch && matchesCategory && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    applyFilterBtn.addEventListener('click', filterTickets);
    searchInput.addEventListener('keyup', filterTickets);
    filterCategory.addEventListener('change', filterTickets);
    filterStatus.addEventListener('change', filterTickets);

    filterTickets();
});