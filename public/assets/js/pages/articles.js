// public/assets/js/pages/articles.js

document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-nav .filter-btn');
    const searchInput = document.querySelector('.search-bar .search-input');
    const articleCards = document.querySelectorAll('.articles-grid .article-card');

    // Function to filter articles
    const filterArticles = () => {
        const activeCategory = document.querySelector('.filter-nav .filter-btn.active').dataset.category;
        const searchQuery = searchInput.value.toLowerCase();

        articleCards.forEach(card => {
            const cardCategory = card.querySelector('.card-category').textContent.toLowerCase();
            const cardTitle = card.querySelector('.card-title a').textContent.toLowerCase();
            const cardExcerpt = card.querySelector('.card-excerpt').textContent.toLowerCase();

            const matchesCategory = (activeCategory === 'all' || cardCategory.includes(activeCategory));
            const matchesSearch = (cardTitle.includes(searchQuery) || cardExcerpt.includes(searchQuery));

            if (matchesCategory && matchesSearch) {
                card.style.display = ''; // Show article
            } else {
                card.style.display = 'none'; // Hide article
            }
        });
    };

    // Event listeners for filter buttons
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            filterArticles();
        });
    });

    // Event listener for search input
    searchInput.addEventListener('keyup', filterArticles);

    // Initial filter on page load
    filterArticles();
});