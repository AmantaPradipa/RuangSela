document.addEventListener('DOMContentLoaded', function () {
    // Example: Chart.js for session statistics
    const ctx = document.getElementById('sessionChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Sesi Selesai',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: 'var(--primary-color)',
                    borderColor: 'var(--primary-dark)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
});