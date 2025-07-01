document.addEventListener('DOMContentLoaded', function() {
    const filterTags = document.querySelectorAll('.filter-tags .filter-tag');
    const searchInput = document.getElementById('search-articles');
    const articleGrid = document.getElementById('article-grid');

    function filterArticles() {
        const searchTerm = searchInput.value.toLowerCase();
        const activeStatus = document.querySelector('.filter-tags .filter-tag.active').dataset.status;

        Array.from(articleGrid.children).forEach(articleCard => {
            const articleTitle = articleCard.dataset.title.toLowerCase();
            const articleExcerpt = articleCard.dataset.excerpt.toLowerCase();
            const articleStatus = articleCard.dataset.status.toLowerCase();

            const matchesSearch = articleTitle.includes(searchTerm) || articleExcerpt.includes(searchTerm);
            const matchesStatus = activeStatus === 'all' || articleStatus === activeStatus;

            if (matchesSearch && matchesStatus) {
                articleCard.style.display = '';
            } else {
                articleCard.style.display = 'none';
            }
        });
    }

    // Event Listeners for filter tags
    filterTags.forEach(tag => {
        tag.addEventListener('click', function(e) {
            e.preventDefault();
            filterTags.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            filterArticles();
        });
    });

    // Event Listener for search input
    searchInput.addEventListener('keyup', filterArticles);

    // Initial filter on page load
    filterArticles();
});