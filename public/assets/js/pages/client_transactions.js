document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-transactions');
    const filterType = document.getElementById('filter-type');
    const filterStatus = document.getElementById('filter-status');
    const applyFilterBtn = document.getElementById('apply-filter');
    const transactionsTableBody = document.getElementById('transactions-table-body');

    function filterTransactions() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedType = filterType.value.toLowerCase();
        const selectedStatus = filterStatus.value.toLowerCase();

        Array.from(transactionsTableBody.children).forEach(row => {
            const transactionType = row.children[1].textContent.toLowerCase();
            const transactionStatus = row.dataset.status.toLowerCase();

            const matchesSearch = row.children[0].textContent.toLowerCase().includes(searchTerm) || row.children[2].textContent.toLowerCase().includes(searchTerm);
            const matchesType = selectedType === 'all' || transactionType === selectedType;
            const matchesStatus = selectedStatus === 'all' || transactionStatus === selectedStatus;

            if (matchesSearch && matchesType && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    applyFilterBtn.addEventListener('click', filterTransactions);
    searchInput.addEventListener('keyup', filterTransactions);
    filterType.addEventListener('change', filterTransactions);
    filterStatus.addEventListener('change', filterTransactions);

    filterTransactions();
});