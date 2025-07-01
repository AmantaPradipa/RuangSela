document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-faq');
    const filterCategory = document.getElementById('filter-category');
    const filterStatus = document.getElementById('filter-status');
    const applyFilterBtn = document.getElementById('apply-filter');
    const faqTableBody = document.getElementById('faq-table-body');

    function filterFaqs() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedCategory = filterCategory.value.toLowerCase();
        const selectedStatus = filterStatus.value.toLowerCase();

        Array.from(faqTableBody.children).forEach(row => {
            const question = row.children[1].textContent.toLowerCase();
            const category = row.dataset.category.toLowerCase();
            const status = row.dataset.status.toLowerCase();

            const matchesSearch = question.includes(searchTerm);
            const matchesCategory = selectedCategory === 'all' || category === selectedCategory;
            const matchesStatus = selectedStatus === 'all' || status === selectedStatus;

            if (matchesSearch && matchesCategory && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    applyFilterBtn.addEventListener('click', filterFaqs);
    searchInput.addEventListener('keyup', filterFaqs);
    filterCategory.addEventListener('change', filterFaqs);
    filterStatus.addEventListener('change', filterFaqs);

    filterFaqs();
});