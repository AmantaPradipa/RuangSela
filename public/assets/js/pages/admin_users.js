document.addEventListener('DOMContentLoaded', function() {
    const contentTabs = document.querySelectorAll('.content-tabs nav a');
    const searchInput = document.getElementById('search-users');
    const filterRole = document.getElementById('filter-role');
    const filterStatus = document.getElementById('filter-status');
    const applyFilterBtn = document.getElementById('apply-filter');
    const usersTableBody = document.getElementById('users-table-body');

    function filterUsers() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedRole = filterRole.value.toLowerCase();
        const selectedStatus = filterStatus.value.toLowerCase();
        let activeTabStatus = document.querySelector('.content-tabs nav a.active').dataset.status;

        Array.from(usersTableBody.children).forEach(row => {
            const fullName = row.children[1].textContent.toLowerCase();
            const email = row.children[2].textContent.toLowerCase();
            const role = row.dataset.role.toLowerCase();
            const status = row.dataset.status.toLowerCase();

            const matchesSearch = fullName.includes(searchTerm) || email.includes(searchTerm);
            const matchesRole = selectedRole === 'all' || role === selectedRole;
            const matchesStatus = selectedStatus === 'all' || status === selectedStatus;
            const matchesTab = activeTabStatus === 'all' || status === activeTabStatus;

            if (matchesSearch && matchesRole && matchesStatus && matchesTab) {
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
            filterUsers();
        });
    });

    // Event Listeners for filter changes
    applyFilterBtn.addEventListener('click', filterUsers);
    searchInput.addEventListener('keyup', filterUsers);
    filterRole.addEventListener('change', filterUsers);
    filterStatus.addEventListener('change', filterUsers);

    // Initial filter on page load
    filterUsers();
});