document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-therapist-verification');
    const filterStatusSelect = document.getElementById('filter-verification-status');
    const listTabs = document.querySelectorAll('.list-tabs a');
    const therapistListContainer = document.getElementById('therapist-scroll-list');

    function filterTherapists() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedStatus = filterStatusSelect.value.toLowerCase();
        let activeTabStatus = document.querySelector('.list-tabs a.active').dataset.status;

        // If activeTabStatus is 'all', use the dropdown selection
        if (activeTabStatus === 'all') {
            activeTabStatus = selectedStatus;
        }

        Array.from(therapistListContainer.children).forEach(item => {
            const therapistName = item.dataset.name.toLowerCase();
            const therapistStatus = item.dataset.status.toLowerCase();

            const matchesSearch = therapistName.includes(searchTerm);
            const matchesStatus = activeTabStatus === 'all' || therapistStatus === activeTabStatus;

            if (matchesSearch && matchesStatus) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }

    // Event Listeners for tab clicks
    listTabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            listTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            filterTherapists();
        });
    });

    // Event Listeners for filter changes
    searchInput.addEventListener('keyup', filterTherapists);
    filterStatusSelect.addEventListener('change', filterTherapists);

    // Initial filter on page load
    filterTherapists();
});