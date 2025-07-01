document.addEventListener('DOMContentLoaded', function() {
    const contentTabs = document.querySelectorAll('.content-tabs nav a');
    const searchInput = document.getElementById('search-posts');
    const filterTopic = document.getElementById('filter-topic');
    const applyFilterBtn = document.getElementById('apply-filter');
    const postFeed = document.getElementById('post-feed');

    function filterPosts() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedTopic = filterTopic.value.toLowerCase();
        const activeTabFilter = document.querySelector('.content-tabs nav a.active').dataset.filter;
        const currentUserId = 1; // Replace with actual logged-in user ID

        Array.from(postFeed.children).forEach(postCard => {
            const postTitle = postCard.querySelector('.post-title a').textContent.toLowerCase();
            const postContent = postCard.querySelector('.post-content').textContent.toLowerCase();
            const postTopic = postCard.dataset.topic ? postCard.dataset.topic.toLowerCase() : '';
            const postUserId = parseInt(postCard.dataset.userId);

            const matchesSearch = postTitle.includes(searchTerm) || postContent.includes(searchTerm);
            const matchesTopic = selectedTopic === 'all' || postTopic === selectedTopic;

            let matchesTab = true;
            if (activeTabFilter === 'my-posts') {
                matchesTab = postUserId === currentUserId;
            } else if (activeTabFilter === 'popular') {
                // Implement logic for popular posts if data is available (e.g., based on likes/comments)
                // For now, it will show all posts that match other filters
            }

            if (matchesSearch && matchesTopic && matchesTab) {
                postCard.style.display = '';
            } else {
                postCard.style.display = 'none';
            }
        });
    }

    // Event Listeners for tab clicks
    contentTabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            contentTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            filterPosts();
        });
    });

    // Event Listeners for filter changes
    applyFilterBtn.addEventListener('click', filterPosts);
    searchInput.addEventListener('keyup', filterPosts);
    filterTopic.addEventListener('change', filterPosts);

    // Initial filter on page load
    filterPosts();
});