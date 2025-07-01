document.addEventListener('DOMContentLoaded', function () {
    // --- Logika untuk Accordion ---
    const allFaqItems = document.querySelectorAll('.faq-item');

    allFaqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        question.addEventListener('click', () => {
            const answer = item.querySelector('.faq-answer');
            const isOpen = item.classList.contains('active');

            // Tutup semua item lain yang mungkin terbuka
            allFaqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                    otherItem.querySelector('.faq-answer').style.maxHeight = '0';
                }
            });

            // Buka atau tutup item yang diklik
            if (!isOpen) {
                item.classList.add('active');
                answer.style.maxHeight = answer.scrollHeight + 'px';
            } else {
                item.classList.remove('active');
                answer.style.maxHeight = '0';
            }
        });
    });

    // --- Logika untuk Tabs ---
    const tabLinks = document.querySelectorAll('.tab-link');
    const tabContents = document.querySelectorAll('.tab-content');

    tabLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            const tabId = link.getAttribute('data-tab');

            // Nonaktifkan semua link dan konten
            tabLinks.forEach(item => item.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));

            // Aktifkan link dan konten yang diklik
            link.classList.add('active');
            document.getElementById(tabId).classList.add('active');

            // Reset accordion di tab baru, buka yang pertama jika ada
            const newActiveTabContent = document.getElementById(tabId);
            const allItemsInNewTab = newActiveTabContent.querySelectorAll('.faq-item');
            allItemsInNewTab.forEach((item, index) => {
                item.classList.remove('active');
                item.querySelector('.faq-answer').style.maxHeight = '0';
                 // Buka item pertama di tab baru
                if(index === 0) {
                    item.classList.add('active');
                    item.querySelector('.faq-answer').style.maxHeight = item.querySelector('.faq-answer').scrollHeight + 'px';
                }
            });

            // Apply current search filter after tab change
            filterFaqItems(document.querySelector('.faq-search-form input[name="q"]').value);
        });
    });

    // Inisialisasi accordion pertama di tab pertama agar terbuka saat halaman dimuat
    const firstActiveItem = document.querySelector('.tab-content.active .faq-item.active .faq-answer');
    if (firstActiveItem) {
        firstActiveItem.style.maxHeight = firstActiveItem.scrollHeight + 'px';
    }

    // --- Logika untuk Pencarian FAQ ---
    const searchForm = document.querySelector('.faq-search-form');
    const searchInput = searchForm.querySelector('input[name="q"]');

    const filterFaqItems = (query) => {
        const lowerCaseQuery = query.toLowerCase();

        allFaqItems.forEach(item => {
            const questionText = item.querySelector('.faq-question span').textContent.toLowerCase();
            const answerText = item.querySelector('.faq-answer p').textContent.toLowerCase();

            if (questionText.includes(lowerCaseQuery) || answerText.includes(lowerCaseQuery)) {
                item.style.display = ''; // Show item
            } else {
                item.style.display = 'none'; // Hide item
            }
        });
    };

    searchInput.addEventListener('keyup', () => {
        filterFaqItems(searchInput.value);
    });

    searchForm.addEventListener('submit', (event) => {
        event.preventDefault(); // Prevent form submission
        filterFaqItems(searchInput.value);
    });
});