document.addEventListener('DOMContentLoaded', function() {
    const contentTabs = document.querySelectorAll('.content-tabs nav a');
    const searchInput = document.getElementById('search-articles');
    const filterCategory = document.getElementById('filter-category');
    const filterStatus = document.getElementById('filter-status');
    const applyFilterBtn = document.getElementById('apply-filter');
    const articlesTableBody = document.getElementById('articles-table-body');

    function filterArticles() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedCategory = filterCategory.value.toLowerCase();
        const selectedStatus = filterStatus.value.toLowerCase();
        let activeTabStatus = document.querySelector('.content-tabs nav a.active').dataset.status;

        // If activeTabStatus is 'all', consider the selectedStatus from dropdown
        if (activeTabStatus === 'all') {
            activeTabStatus = selectedStatus;
        }

        Array.from(articlesTableBody.children).forEach(row => {
            const title = row.children[1].textContent.toLowerCase();
            const category = row.dataset.category.toLowerCase();
            const status = row.dataset.status.toLowerCase();

            const matchesSearch = title.includes(searchTerm);
            const matchesCategory = selectedCategory === 'all' || category === selectedCategory;
            const matchesStatus = activeTabStatus === 'all' || status === activeTabStatus;

            if (matchesSearch && matchesCategory && matchesStatus) {
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
            filterArticles();
        });
    });

    // Event Listeners for filter changes
    applyFilterBtn.addEventListener('click', filterArticles);
    searchInput.addEventListener('keyup', filterArticles);
    filterCategory.addEventListener('change', filterArticles);
    filterStatus.addEventListener('change', filterArticles);

    // Initial filter on page load
    filterArticles();
});