// public/assets/js/pages/therapists.js

document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.querySelector('.filter-form');
    const searchNameInput = document.getElementById('search-name');
    const specializationSelect = document.getElementById('specialization');
    const ratingSelect = document.getElementById('rating');
    const therapistGrid = document.querySelector('.therapist-grid');

    // Function to fetch and display therapists
    const fetchTherapists = async () => {
        const queryParams = new URLSearchParams();
        if (searchNameInput.value) {
            queryParams.append('name', searchNameInput.value);
        }
        if (specializationSelect.value && specializationSelect.value !== 'Semua Spesialisasi') {
            queryParams.append('specialization', specializationSelect.value);
        }
        if (ratingSelect.value && ratingSelect.value !== 'Semua Rating') {
            // Extract rating number from string like '★★★★☆ (4)'
            const ratingMatch = ratingSelect.value.match(/\((\d+)\)/);
            if (ratingMatch) {
                queryParams.append('rating', ratingMatch[1]);
            }
        }

        // Construct the URL for fetching filtered therapists
        // Assuming your controller has an endpoint like /api/therapists or similar
        // For now, we'll just reload the page with query parameters
        // In a real application, you'd use fetch() here to get JSON data
        window.location.href = window.location.pathname + '?' + queryParams.toString();
    };

    // Handle form submission
    filterForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission
        fetchTherapists();
    });

    // Optional: Add event listeners for change on select or keyup on input for instant filtering
    // specializationSelect.addEventListener('change', fetchTherapists);
    // ratingSelect.addEventListener('change', fetchTherapists);
    // searchNameInput.addEventListener('keyup', fetchTherapists);
});